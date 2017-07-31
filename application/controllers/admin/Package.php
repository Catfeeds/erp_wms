<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Package extends MY_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->library('CI_Smarty');
	}
	
	// 0未开始   1 运行中  2 完成 
	public function act_api()
	{
		
		if(empty($_GET['auth'])||empty($_GET['tm'])||empty($_GET['act']))
		{
			echo 404;
			die;
		}
		
		$tm=$_GET['tm'];
		$auth=md5('tests'.$tm);
		if($auth!=$_GET['auth'])
		{
			echo 404;
			die;
		}
		
		ignore_user_abort(TRUE);
		set_time_limit(0);
		$this->load->library('MY_memcachelock');
		$this->my_memcachelock->tm=120;//锁定时间

		$act=$_GET['act'];
		$package_id=$_GET['package_id'];
	    $this->my_memcachelock->unlock('order_start_'.$act);
		//判断是否已经开启
		if($this->my_memcachelock->lock('order_start_'.$act)===true)
		{
			while(1)
			{

				//memcache ......崩溃出现时...............
				if($this->my_memcachelock->get('order_start_'.$act)===false)
					break;

				if($act==1)
				{//创建运单

					$sql="SELECT id FROM ".tab_m('fedex_pakge')." WHERE `run_status`=1 ORDER BY  `uptime`,`id`  ASC LIMIT 1 ";
					$res=$this->db->query($sql)->row_array();
					if(empty($res['id']))
					{
						break;
					}
					$result=$this->createShipmentFedex($res['id']);


					//model
					$this->load->model('Base_Package_model');
					if($result===1)
					{
						$this->Base_Package_model->fedex_package_update(array('run_status'=>10),array('id'=>$res['id']));
					}
					elseif ($result===0)
					{
						$this->Base_Package_model->fedex_package_update(array('run_status'=>-1),array('id'=>$res['id']));
					}

				}
				
				if($act==2)
				{//预估费率

					$sql="SELECT id FROM ".tab_m('fedex_pakge')." WHERE `run_status`=2 ORDER BY  `uptime`,`id`  ASC LIMIT 1 ";
					$res=$this->db->query($sql)->row_array();
					if(empty($res['id']))
					{
						break;
					}
					$result=$this->estimated_cost($res['id']);


					//model
					$this->load->model('Base_Package_model');
					if($result===1)
					{
						$this->Base_Package_model->fedex_package_update(array('run_status'=>10),array('id'=>$res['id']));
					}elseif($result===0)
					{
						$this->Base_Package_model->fedex_package_update(array('run_status'=>-2),array('id'=>$res['id']));
					}

				
				}

				if($act==3)
				{
					$sql="SELECT id FROM ".tab_m('fedex_pakge')." WHERE `run_status`=3 ORDER BY  `uptime`,`id`  ASC LIMIT 1 ";
					$res=$this->db->query($sql)->row_array();
					if(empty($res['id']))
					{
						break;
					}
					$result=$this->recreate_shipment($res['id']);
					//model
					$this->load->model('Base_Package_model');
					if($result===1)
					{
						$this->Base_Package_model->fedex_package_update(array('run_status'=>10),array('id'=>$res['id']));
					}
					elseif($result===0)
					{
						$this->Base_Package_model->fedex_package_update(array('run_status'=>-3),array('id'=>$res['id']));
					}

				}
			    
				//--------------------
				
				//刷新锁定时间
				$flash=$this->my_memcachelock->flush_lock('order_start_'.$act);
				sleep(1);
			}
			$this->my_memcachelock->unlock('order_start_'.$act);
		}
		else
			echo '系统繁忙......';
		
	}
	
	
	private function act($act)
	{
		$this->load->library('MY_memcachelock');
		//判断是否已经开启
		if($this->my_memcachelock->get('order_start_'.$act)===false)
		{	
			$tm=time();
			$context = stream_context_create(array(
						 'http' => array(
						 'timeout' =>2//超时时间，单位为秒
						 ) 
					));
		    return @file_get_contents(site_url("package/act_api")."?auth=".md5('tests'.$tm)."&tm=".$tm."&act=".$act, 0, $context);
		}
		return 2;
	}
	
	public function package_batches_create()
	{

		//act=1 为创建运单
		$act=$_GET['act'];

		$item=array_filter(explode(',',$_GET['item']));

		//model
		$this->load->model('Base_Package_model');
		if($act==1)
		{//创建运单

			//创建运单之前要确定已经预估费率
			/**
			 * 创建运单之前必须要确认的是
			 * 1、已经预估了费用
			 * 2、包裹的状态 为已确认 待审核
			 * 3、包裹的投递状态为 1
			 */
			$item=implode(",",$item);
			$sql ="UPDATE ".tab_m('fedex_pakge')." SET `run_status`=1,`uptime`=".time()." WHERE `estimated_rate`!=0.00  AND `status`=2 AND `package_request_status`=1 AND `run_status`=0 AND `id` IN (".$item.")";
			$this->db->query($sql);
		}

		if($act==2)
		{//预估费率
			/**
			 * 什么情况下可以预估费率
			 * 1、没有预估费用的时候，即estimated_rate==0.00时
			 * 2、包裹状态为已确认待审核  status==2
			 * 3、包裹的投递状态为 package_request_status!=6,
			 * package_request_status=array(
			 *			1=>'未投递',
			 * 			2=>'已取单',
			 * 			3=>'正在验证',
			 * 			4=>'已验证',
			 * 			5=>'验证失败',
			 * 			6=>'已提交'
			 * )
			*/
			$estimated_rate=0.00;
			$status=implode(",",array(2));
			$package_request_status=implode(",",array(1,2,3,4,5));
			$item=implode(",",$item);
			$sql="UPDATE ".tab_m('fedex_pakge')." SET `run_status`=2,`uptime`=".time()." WHERE `status` IN (".$status.") AND `package_request_status` IN (".$package_request_status.") AND `id` IN (".$item.")";
			$this->db->query($sql);
		}

		if($act==3)
		{//再次创建运单
			/**
			 * 什么情况下可以再次创建运单？
			 * 一般为创建运单失败后，包裹经过修改调整后，再次创建
			 *
			 */
			//包裹run_status
			$run_status=array(0,10);
			$run_status=implode(",",$run_status);
			//包裹package_request_status
			$package_request_status=array(6);
			$package_request_status=implode(",",$package_request_status);
			//包裹status
			$status=array(3);
			$status=implode(",",$status);
			//包裹id
			$item=implode(",",$item);
			$sql="UPDATE ".tab_m('fedex_pakge')." SET `run_status`=3, `uptime`=".time()." WHERE `run_status` not IN (".$run_status.") AND `package_request_status` NOT IN (".$package_request_status.") AND `status` NOT IN (".$status.") AND `id` IN (".$item.")";
			$this->db->query($sql);

		}
		$this->act($act);

	}

	//fedex包裹 列表
	public function package_list()
	{
		//model
		$this->load->model('Base_Package_model');
		$this->load->model('Base_Order_model');

		//搜索
		$key      = array();
		$key_like = array();

		$key['type'] = 1;
		if( isset($_GET) )
		{
			//非模糊字段 搜索
			$search_key      = array(  'id' , 'status' ,'run_status', 'fedex_index','userid' );
			//模糊字段 搜索
			$search_key_like = array();
			foreach ( $_GET as $k => $v )
			{
				$skey = substr( $k , 7 , strlen($k)-7 );
				if ( $k != 'search_page_num' && substr( $k , 0 , 7 ) == 'search_' && !in_array( $v , array('all','') ) )
				{
					//非模糊字段
					if ( in_array( $skey , $search_key ) )
					{
						$key[$skey] = $v;
					}
					//模糊字段
					if ( in_array( $skey , $search_key_like ) )
					{
						$key_like[$skey] = $v;
					}
				}
			}
		}

		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url = site_url( $this->class."/".$this->method );
		$search_page_num = array( 'all' => 15, 1 => 15, 2 => 30 , 3 => 50 );
		$this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
		if ( !$this->ci_page->__get('totalRows') )
		{
			$this->ci_page->totalRows = $this->Base_Package_model->fedex_package_list_rows( $key , $key_like );
		}

		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Package_model->fedex_package_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);

		//加入订单信息
		foreach ($res['list'] as $k => $v)
		{
			$sql="SELECT `time`,`content` FROM ".tab_m('fedex_pakge_log')." WHERE `pk_id`=".$v['id']." ORDER BY `id` DESC LIMIT 1";
			$row=$this->db->query($sql)->row_array();
			$res['list'][$k]['log'] = $row;
		}
		require(APPPATH.'/config/base_config.php');
		$this->ci_smarty->assign('run_status',$config['run_status']);

		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('package_list.htm');
	}

	//海运 空运  包裹列表
	public function  package2_list()
	{
		//model
		$this->load->model('Base_Package_model');
		$this->load->model('Base_Order_model');

		//搜索
		$key      = array();
		$key_like = array();

		$key['type'] = '2 or 3';
		if( isset($_GET) )
		{
			//非模糊字段 搜索
			$search_key      = array( 'airport' , 'id' , 'status' , 'pallet_no' , 'tidan_num' );
			//模糊字段 搜索
			$search_key_like = array();
			foreach ( $_GET as $k => $v )
			{
				$skey = substr( $k , 7 , strlen($k)-7 );
				if ( $k != 'search_page_num' && substr( $k , 0 , 7 ) == 'search_' && !in_array( $v , array('all','') ) )
				{
					//非模糊字段
					if ( in_array( $skey , $search_key ) )
					{
						$key[$skey] = $v;
					}
					//模糊字段
					if ( in_array( $skey , $search_key_like ) )
					{
						$key_like[$skey] = $v;
					}
				}
			}
		}

		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url = site_url( $this->class."/".$this->method );
		$search_page_num = array( 'all' => 15, 1 => 15, 2 => 30 , 3 => 50 );
		$this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
		if ( !$this->ci_page->__get('totalRows') )
		{
			$this->ci_page->totalRows = $this->Base_Package_model->fedex_package_list_rows( $key , $key_like );
		}

		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Package_model->fedex_package_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);

		//加入订单信息
		foreach ($res['list'] as $k => $v)
		{
			$row = $this->Base_Order_model->get_orders( 'id,import_id,batches_id,consignee,province,city,area,consignee_address,consignee_mobile' , array('fedex_pakge_id' => $v['id']) );
			$res['list'][$k]['order_list'] = $row;
		}



		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('package2_list.htm');
	}
	//fedex包裹管理 操作
	public function package_edit()
	{
		//model
		$this->load->model('Base_Package_model');

		if ( !empty($_GET['id']) )
		{
			//获取服务类型
			$this->load->config('base_config',true);
			$ServiceType=$this->config->item('ServiceType','base_config');
			//获取包裹信息
			$res = $this->Base_Package_model->get_fedex_package_info( '*' , array( 'id' => $_GET['id'] ) );
			//返回结果
			$this->ci_smarty->assign('ServiceType',$ServiceType);
			$this->ci_smarty->assign('re',$res);
			//载入页面
			$this->ci_smarty->display_ini('package_edit.htm');

		}

	}


	//fedex包裹 编辑
	public function package_edit1()
	{
		//model
		$this->load->model('Base_Package_model');

		if ( !empty($_GET['id']) )
		{
			//获取服务类型
			$this->load->config('base_config',true);
			$ServiceType=$this->config->item('ServiceType','base_config');
			//获取包裹信息
			$res = $this->Base_Package_model->get_fedex_package_info( '*' , array( 'id' => $_GET['id'] ) );
			//获取包裹所属的公司名
			$this->load->model('Base_Supplier_model');
			$info=$this->Base_Supplier_model->get_sp_user_info('company',array('id'=>$res['userid']));
			//返回结果
			$this->ci_smarty->assign('company',$info['company']);
			$this->ci_smarty->assign('ServiceType',$ServiceType);
			$this->ci_smarty->assign('re',$res);

		}

		if ( !empty( $_POST ) )
		{
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('fedex_length','长','required');
			$this->form_validation->set_rules('fedex_height','高','required');
			$this->form_validation->set_rules('fedex_width','宽','required');
			$this->form_validation->set_rules('fedex_lwh_unit','长宽高计量单位','required');
			$this->form_validation->set_rules('fedex_weight','重量','required');
			$this->form_validation->set_rules('fedex_weight_unit','重量单位','required');
			$this->form_validation->set_rules('fedex_service_type','FedEx服务类型','required');

			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				$package_arr = array();
				$package_arr['fedex_length']      = $this->input->post('fedex_length',true);
				$package_arr['fedex_height']      = $this->input->post('fedex_height',true);
				$package_arr['fedex_width']       = $this->input->post('fedex_width',true);
				$package_arr['fedex_lwh_unit']    = $this->input->post('fedex_lwh_unit',true);
				$package_arr['fedex_weight']      = $this->input->post('fedex_weight',true);
				$package_arr['fedex_weight_unit'] = $this->input->post('fedex_weight_unit',true);
				$package_arr['fedex_service_type'] = $this->input->post('fedex_service_type',true);

				//修改所有订单的包裹状态
				$flag = $this->Base_Package_model->fedex_package_update( $package_arr , array( 'id' => $this->input->post('id',true) ) );

				if( $flag )
				{
					$msg = array(
						'msg'  => "操作成功",
						'type' => 3
					);
					echo json_encode($msg);
			  	    die;
				}
				else
				{
					$msg = array(
						'msg'  => '提交失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}
		}

		//载入页面
		$this->ci_smarty->display_ini('package_edit1.htm');
	}
	
	public  function package_assign_cost()
	{
		//model
		$this->load->model('Base_Package_model');
		if(!empty($_GET['id']))
		{

			//获取包裹信息
			$res = $this->Base_Package_model->get_fedex_package_info( '*' , array( 'id' => $_GET['id'] ) );
			$this->ci_smarty->assign('re',$res);
			//载入页面
			$this->ci_smarty->display_ini('package_assign_cost.htm');
		}

		if(!empty($_POST['id']))
		{

			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('cost','成本运费','required|numeric');
			$this->form_validation->set_rules('actual_cost','实收运费','required|numeric');
			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				$package_arr = array();
				$package_arr['cost']      = $this->input->post('cost',true);
				$package_arr['actual_cost']      = $this->input->post('actual_cost',true);
				//修改所有订单的包裹状态
				$flag = $this->Base_Package_model->fedex_package_update( $package_arr , array( 'id' => $this->input->post('id',true) ) );

				$this->assign_fee($_POST['id'],$package_arr['cost'],$package_arr['actual_cost']);

				if( $flag )
				{
					$msg = array(
						'msg'  => "操作成功",
						'type' => 3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg = array(
						'msg'  => '提交失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}
		}

	}

	/**
	 * 计算订单国外成本和实收运费
	 * @param $package_id 	包裹id
	 * @param $cost		  	包裹成本运费
	 * @param $actual_cost	包裹实际运费
	 */
	private  function assign_fee($package_id,$cost,$actual_cost)
	{
		//查询该包裹下所有的订单
		$this->load->model('Base_Order_model');

		$order_arr=$this->Base_Order_model->get_orders('id,status,is_assign_fee,assign_cost_fee,assign_actual_fee,total_weight',array('fedex_pakge_id'=>$package_id));

		$total_weight=0;//总重量
		foreach( $order_arr as $key=>$value)
		{
			if($value['is_assign_fee']==1)
			{
				$cost=$cost-$value['assign_cost_fee'];
				$actual_cost=$actual_cost-$value['assign_actual_fee'];
			}
			else
			{
				$total_weight+=$value['total_weight'];
			}
		}


		$per_cost_fee=bcdiv($cost,$total_weight,5);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       		$per_cost_fee=bcdiv($cost,$total_weight,5)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ;
		$per_actual_fee=bcdiv($actual_cost,$total_weight,5);

		foreach ( $order_arr as $k=>$v)
		{
			if($v['is_assign_fee']==0)
			{
				$this->db->query("UPDATE ".tab_m('order')." SET `assign_cost_fee`=".ceil(bcmul($per_cost_fee,$v['total_weight'],2)).",`assign_actual_fee`=".ceil(bcmul($per_actual_fee,$v['total_weight'],2))." WHERE `id`=".$v['id']);
			}

		}
	}

	/**
	 * 预估订单 运费
	 * @param $package_id		包裹id
	 * @param $estimated_rate	包裹预估费用
	 * @param $abroad_currency  币种
	 */
	private function assign_estimated_fee($package_id,$estimated_rate,$abroad_currency)
	{
		//查询该包裹下所有的订单
		$this->load->model('Base_Order_model');
		$order_arr=$this->Base_Order_model->get_orders('id,status,is_assign_fee,assign_fee,total_weight',array('fedex_pakge_id'=>$package_id));
		$total_weight=0;//总重量
		foreach( $order_arr as $key=>$value)
		{
			if($value['is_assign_fee']==1)
			{
				$estimated_rate=$estimated_rate-$value['assign_fee'];

			}
			else
			{
				$total_weight+=$value['total_weight'];
			}
		}

		$per_fee=bcdiv($estimated_rate,$total_weight,5);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       		$per_cost_fee=bcdiv($cost,$total_weight,5)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ;


		foreach ( $order_arr as $k=>$v)
		{
			$this->db->query("UPDATE ".tab_m('order')." SET `abroad_currency`='".$abroad_currency."' WHERE `id`=".$v['id']);
			if($v['is_assign_fee']==0)
			{
				$this->db->query("UPDATE ".tab_m('order')." SET `assign_fee`=".ceil(bcmul($per_fee,$v['total_weight'],2))." WHERE `id`=".$v['id']);
			}

		}
	}

	//指定包裹下所有订单费用
	public  function package_assign_order_cost()
	{
		if(!empty($_GET['id']))
		{
			//查询该包裹下所有的订单
			$this->load->model('Base_Order_model');
			$order_arr=$this->Base_Order_model->get_orders('id,status,is_assign_fee,assign_fee,total_weight,assign_cost_fee,assign_actual_fee',array('fedex_pakge_id'=>$_GET['id']));
			
			$this->ci_smarty->assign('re',$order_arr);
			$this->ci_smarty->display_ini('package_assign_order_cost.htm');
		}
		if(!empty($_POST))
		{
			$data=array();
			for ($i=0;$i<count($_POST['id']);$i++)
			{
				if($_POST['is_assign_fee'][$i]==1)
				{
					$data[$i]['id']=$_POST['id'][$i];
					$data[$i]['is_assign_fee']=$_POST['is_assign_fee'][$i];
					$data[$i]['assign_fee']=$_POST['assign_fee'][$i];
					$data[$i]['assign_cost_fee']=$_POST['assign_cost_fee'][$i];
					$data[$i]['assign_actual_fee']=$_POST['assign_actual_fee'][$i];
				}


			}
			$this->load->model('Base_Order_model');
			$res=$this->Base_Order_model->order_update_batches($data);
			if( $res )
			{
				$msg = array(
					'msg'  => "操作成功",
					'type' => 3
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				$msg = array(
					'msg'  => '提交失败',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
		}
	}


	//海运空运  包裹编辑
	public  function package2_edit()
	{
		//model
		$this->load->model('Base_Package_model');

		if ( !empty($_GET['id']) )
		{
			//获取包裹信息
			$res = $this->Base_Package_model->get_fedex_package_info( '*' , array( 'id' => $_GET['id'] ) );
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}

		if(!empty($_POST))
		{
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('airport','机场港口','required');
			$this->form_validation->set_rules('flight_start_date','出港时间','required');
			$this->form_validation->set_rules('flight_end_date','到港时间','required');
			$this->form_validation->set_rules('flight_num','航班号','required');
			$this->form_validation->set_rules('pallet_no','托盘号','required');
			$this->form_validation->set_rules('tidan_num','提单号','required');

			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				$package_arr = array();
				$package_arr['airport']      = $this->input->post('airport',true);
				$package_arr['flight_start_date']      = $this->input->post('flight_start_date',true);
				$package_arr['flight_end_date']       = $this->input->post('flight_end_date',true);
				$package_arr['flight_num']    = $this->input->post('flight_num',true);
				$package_arr['pallet_no']      = $this->input->post('pallet_no',true);
				$package_arr['tidan_num'] = $this->input->post('tidan_num',true);

				//修改所有订单的包裹状态
				$flag = $this->Base_Package_model->fedex_package_update( $package_arr , array( 'id' => $this->input->post('id',true) ) );

				if( $flag )
				{
					$msg = array(
						'msg'  => "操作成功",
						'type' => 3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg = array(
						'msg'  => '提交失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}
	
		}
		//载入页面
		$this->ci_smarty->display_ini('package2_edit.htm');
	}

	//查看包裹中订单列表
	public function package_order_info()
	{
		//model
		$this->load->model('Base_Order_model');
		if(!empty($_GET['id'])){
			//model
			$this->load->model('Base_Package_model');
			$this->load->model('Base_Batches_model');

			//包裹ID
			$res['fedex_pakge_id'] = $_GET['id'];

			//查询该包裹下的订单
			$this->load->model('Base_Order_model');

			//搜索
			$key = array();
			$key_like = array();
			$key['fedex_pakge_id'] = $_GET['id'];
			//分页
			$this->load->library('CI_page');
			$this->ci_page->Page();
			$this->ci_page->url = site_url($this->class."/".$this->method);
			$search_page_num = array( 'all' => 15 , 1 => 15 , 2 => 30 , 3 => 50 );
			$this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
			if(!$this->ci_page->__get('totalRows'))
			{
				$this->ci_page->totalRows = $this->Base_Order_model->order_list_rows( $key , $key_like );
			}

			//列表
			$res['page'] = $this->ci_page->prompt();
			$res['list'] = $this->Base_Order_model->order_list(
				'id,fedex_pakge_id,import_id,batches_id,consignee,province,city,area,consignee_address,consignee_mobile,logistics_no',
				'id',
				'DESC',
				$this->ci_page->listRows,
				$this->ci_page->firstRow,
				$key,
				$key_like
			);

			//返回结果
			$this->ci_smarty->assign('re',$res);
		}


		$this->ci_smarty->display_ini('package_order_info.htm');
	}

	//包裹 确认
	public function package_confirm()
	{
		if ( !empty( $_GET['id'] ) )
		{
			//model
			$this->load->model('Base_Batches_model');
			$this->load->model('Base_Order_model');
			$this->load->model('Base_Package_model');

			$res = array();
			$res['batches_id'] = $_GET['id'];

			//订单总数
			$batches = $this->Base_Batches_model->get_batches_info( 'order_num' , array( 'id' => $res['batches_id'] ) );
			$res['order_num'] = $batches['order_num'];
			//未加入包裹数
            $res['not_add_package_num'] = $this->Base_Order_model->order_list_rows( array( 'batches_id' => $res['batches_id'] , 'fedex_pakge_id' => 0 ) , '' );
			//已加入包裹数
            $res['add_package_num'] = $this->Base_Order_model->order_list_rows( array( 'batches_id' => $res['batches_id'] , 'fedex_pakge_id !=' => 0 ) , '' );
			//包裹列表
			$res['package_list'] = $this->Base_Package_model->get_fedex_packages( '*' , array( 'batches_id' => $res['batches_id'] ) );
			//包裹 投递状态
			require(APPPATH.'/config/base_config.php');
			$res['package_request_status'] = $config['package_request_status'];

			//返回结果
			$this->ci_smarty->assign('re',$res);
		}

		//载入页面
		$this->ci_smarty->display_ini('package_confirm.htm');
	}

	//包裹 状态搜索
	public function package_ajax_search()
	{
		if ( !empty($_POST) )
		{
			//model
			$this->load->model('Base_Package_model');

			$res = array();
			$where_arr = array();
			$where_arr['batches_id'] = $_POST['batches_id'];
			if(  $_POST['package_request_status'] != 'all' )
			{
				$where_arr['package_request_status'] = $_POST['package_request_status'];
			}			
			//包裹列表
			$res = $this->Base_Package_model->get_fedex_packages( '*' , $where_arr );
			//包裹 投递状态
			require(APPPATH.'/config/base_config.php');
			$package_request_status = $config['package_request_status'];

			$msg = array(
				'list'           => $res,
				'package_status' => $package_request_status,
				'num' 			 => count($package_request_status)				
			);	
			echo json_encode( $msg );
			
		
			die;
		}
	}

	

	public function package_fee_info()
	{
		if(!empty($_GET['id'])){
			//加载分页类
			$this->load->library('CI_page');
			$this->ci_page->Page();
			$this->ci_page->url=site_url($this->class."/".$this->method);


			$this->ci_page->listRows=15;

			$sql="select  *  from  ".tab_m('fedex_package_rateinfo')." where `fedex_package_id`=$_GET[id]";

			if(!$this->ci_page->__get('totalRows'))
			{
				$query=$this->db->query($sql);
				$this->ci_page->totalRows =$query->num_rows;
			}
			$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
			$res['list']=$this->db->query($sql)->result_array();
			$res['page']=$this->ci_page->prompt();
			$this->ci_smarty->assign('re',$res,1,'page');
		}
		$this->ci_smarty->display_ini('fedex_package_fee_info.htm');
	}


	/**
	 * 查看fedex操作日志
	 */
	public  function fedex_package_log()
	{
		//model
		$this->load->model('Base_Fedex_Package_log_model');
		if(!empty($_GET['id']))
		{
			//分页
			$this->load->library('CI_page');
			$this->ci_page->Page();
			$this->ci_page->url = site_url( $this->class."/".$this->method );
			$this->ci_page->listRows = 10;
			if ( !$this->ci_page->__get('totalRows') )
			{
				$this->ci_page->totalRows = $this->Base_Fedex_Package_log_model->fedex_package_log_list_rows(array('pk_id'=>$_GET['id']));
			}

			//列表
			$res = array();
			$res['page'] = $this->ci_page->prompt();
			$res['list'] = $this->Base_Fedex_Package_log_model->fedex_package_log_list(
				'*',
				'id',
				'DESC',
				$this->ci_page->listRows,
				$this->ci_page->firstRow,
				array('pk_id'=>$_GET['id'])
			);
			$this->ci_smarty->assign('re',$res,1,'page');
			
		}
		$this->ci_smarty->display_ini('fedex_package_log_info.htm');

		
	}


	public  function package_status()
	{
		//model
		$this->load->model('Base_Package_Status_model');
		//搜索
		$key      = array();
		$key_like = array();

		if( isset($_GET) )
		{
			//非模糊字段 搜索
			$search_key      = array( 'pkid','status' );
			//模糊字段 搜索
			$search_key_like = array();
			foreach ( $_GET as $k => $v )
			{
				$skey = substr( $k , 7 , strlen($k)-7 );
				if ( $k != 'search_page_num' && substr( $k , 0 , 7 ) == 'search_' && !in_array( $v , array('all','') ) )
				{
					//非模糊字段
					if ( in_array( $skey , $search_key ) )
					{
						$key[$skey] = $v;
					}
					//模糊字段
					if ( in_array( $skey , $search_key_like ) )
					{
						$key_like[$skey] = $v;
					}
				}
			}
		}

		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url = site_url( $this->class."/".$this->method );
		$search_page_num = array( 'all' => 15, 1 => 15, 2 => 30 , 3 => 50 );
		$this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
		if ( !$this->ci_page->__get('totalRows') )
		{
			$this->ci_page->totalRows = $this->Base_Package_Status_model->package_status_list_rows( $key , $key_like );
		}

		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Package_Status_model->package_status_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);
		$this->load->config('base_config',true);
		$fedex_package_status=$this->config->item('fedex_package_status','base_config');
		
		
		//返回结果
		
		$this->ci_smarty->assign('re',$res,1,'page');
		$this->ci_smarty->assign('fedex_package_status',$fedex_package_status);
		
		$this->ci_smarty->display_ini('fedex_package_status.htm');
	}
	/**
	 *  创建fedex运单
	 *
	 */
	private  function createShipmentFedex($packageId)
	{
		if(empty($packageId))
		{
			show_404();
		}
		//model
		$this->load->model('Base_Package_Status_model');
		$id=$packageId;
		$this->package_fedex_action0($id);
		//查询数据库
		$status=$this->Base_Package_Status_model-> get_fedex_package_status_info('status',array('pk_id'=>$id));
		$status=$status['status'];
		if($status==1)
		{
			$this->package_fedex_action1($id);
		}
		else
		{
			return 0;
		}
		//查询数据库
		$status=$this->Base_Package_Status_model-> get_fedex_package_status_info('status',array('pk_id'=>$id));
		$status=$status['status'];
		if($status==2)
		{
			$this->package_fedex_action2($id);
		}
		else
		{
			return 0;
		}

		//查询数据库
		$status=$this->Base_Package_Status_model-> get_fedex_package_status_info('status',array('pk_id'=>$id));
		$status=$status['status'];
		if($status==3)
		{
			$this->package_fedex_action3($id);
			return 1;
		}
		else
		{
			return 0;
		}
	}


	/**
	 * 预估费率
	 *
	 */
	private function estimated_cost($id)
	{

		//model
		$this->load->model('Base_Package_model');
		$this->load->model('Admin_Spuser_model');
		$this->load->model('Base_Logistics_model');
		$this->load->model('Base_Order_model');
		$this->load->model('Base_Package_Status_model');
		$this->load->model('Base_Fedex_Package_log_model');
		//查询包裹费率详情表 如果有先删除
		$sql="SELECT * FROM ".tab_m('fedex_package_rateinfo')." WHERE `fedex_package_id`=".$id;
		$rateinfo=$this->db->query($sql);
		if(!empty($rateinfo))
		{
			$sql="DELETE FROM ".tab_m('fedex_package_rateinfo')." WHERE `fedex_package_id`=".$id;
			$this->db->query($sql);
		}

		$packageInfo=$this->Base_Package_model-> get_fedex_packages('id,batches_id,userid,fedex_length,fedex_width,fedex_height,fedex_lwh_unit,fedex_weight,fedex_weight_unit,fedex_service_type,ship_timestamp,fedex_package_type',array('id'=>$id));
		//获取供应商信息 包含
		$user_id_info=$this->Admin_Spuser_model->get_spuser_info('send_addr_id,end_addr_id,dutiesPayment_id,payor_id,fedex_account',array('id'=>$packageInfo[0]['userid']));
		//获取基础配置信息
		$sql="SELECT * FROM ".tab_m('fedex_account')." WHERE id=".$user_id_info['fedex_account'];
		$fedex_account=$this->db->query($sql)->row_array();

		$UserCredential=array();
		$UserCredential['CustomerTransactionId']=$this->user_id.'-'.$packageInfo['id'];
		$UserCredential['Key']=$fedex_account['Key'];
		$UserCredential['Password']=$fedex_account['Password'];
		$UserCredential['AccountNumber']=$fedex_account['AccountNumber'];
		$UserCredential['MeterNumber']=$fedex_account['MeterNumber'];

		//加载普通服务费率插件
		$this->load->library('CI_FedexRate');
		//设置保额
		$insuredvalue = array(
			'ammount' => 100,
			'currency'=>'USD'
		);

		//绑定基础信息
		$this->ci_fedexrate->UserCredential=$UserCredential;
		$this->ci_fedexrate->addTotalInsuredValue($insuredvalue);

		//设置服务类型
		$this->ci_fedexrate->service_type=$packageInfo[0]['fedex_service_type'];
		//设置包裹类型
		$this->ci_fedexrate->package=$packageInfo[0]['fedex_package_type'];

		//设置预估寄件时间
		$this->ci_fedexrate->ship_timestamp=strtotime($packageInfo[0]['ship_timestamp']);

		//绑定发件方信息
		$shiper=$this->Base_Logistics_model->get_fedex_user_info('personName,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode',
			array('id'=>$user_id_info['send_addr_id']));

		//绑定收件方信息
		$reci =$this->Base_Logistics_model->get_fedex_user_info('personName,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode,Address_Residential',
			array('id'=>$user_id_info['end_addr_id']));
		$this->ci_fedexrate->addRecipient($reci);
		$this->ci_fedexrate->addShipper($shiper);

		//设置运费信息
		$payor = $this->Base_Logistics_model->get_fedex_user_info('type,personName,account,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode',
			array('id'=>$user_id_info['payor_id']));
		//介于FedEx费率无法返回第三方账户的费用，都暂时使用发货方
		$payor['paymentType']='SENDER';
		$payor['account']=$this->config->item('AccountNumber','fedex_config');
		$this->ci_fedexrate->addShippingChargesPayment($payor);

		//设置包裹描述
		foreach ( $packageInfo as $key => $value){
			$addPackageLineItem[$key]['SequenceNumber']= $key+1;
			$addPackageLineItem[$key]['GroupPackageCount']= $key+1;
			$addPackageLineItem[$key]['Weight']['Value'] = $value['fedex_weight'];
			$addPackageLineItem[$key]['Weight']['Units'] =$value['Units']= strtoupper($value['fedex_weight_unit']);
			$addPackageLineItem[$key]['Dimensions']['Length'] = $value['fedex_length'];
			$addPackageLineItem[$key]['Dimensions']['Width'] = $value['fedex_width'];
			$addPackageLineItem[$key]['Dimensions']['Height'] = $value['fedex_height'];
			$addPackageLineItem[$key]['Dimensions']['Units'] = strtoupper($value['fedex_lwh_unit']);
		}
		$this->ci_fedexrate->packageLineItem = $addPackageLineItem;



		$this->ci_fedexrate->createFedexRateRequest();

		$res=$this->ci_fedexrate->getRate();


		if($res===0){
			$fee = $this->ci_fedexrate->response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount;
			$currency =$this->ci_fedexrate->response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Currency;

			$flag1=$this->Base_Package_model->fedex_package_update(array('estimated_rate'=>$fee,'estimated_rate_currency'=>$currency),array('id'=>$id));
			$list = json_encode($this->ci_fedexrate->response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail);
			$list = json_decode($list,true);
			$data1=array();
			$data=array();
			foreach ($list as $key=>$val){
				if(is_array($val) &&  array_key_exists('Amount',$val) && !is_array($val['Amount'])){

					$data['fedex_package_id'] = $id;
					$data['fee_item']=$key;
					$data['fee_value']=$val['Amount'];
					$data['fee_currency']=$val['Currency'];
					$flag=$this->Base_Package_model->fedex_package_rate_add($data);
				}
			}

			if($flag){

				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"FedEx预估费用成功"));
				$this->assign_estimated_fee($id,$fee,$currency);
				return 1;
			}else{

				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"FedEx预估费用成功,插入数据库数据出错，请联系管理员"));
				return 0;
			}

		}
		elseif($res ===1)
		{
			$error=json_encode($this->ci_fedexrate->response->Notifications);
			$error=json_decode($error,true);
			if(array_key_exists(0,$error)){
				$failreason='错误码:【'.$error[0]['Code'].'】错误信息:【'.$error[0]['Message'].'】';
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"预估FedEx费用失败:".$failreason));
				return 0;

			}else{

				$failreason='错误码:【'.$error['Code'].'】错误信息:【'.$error['Message'].'】';
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"预估FedEx费用失败:".$failreason));
				return 0;
			}

		}

	}

	/**
	 * 重新创建运单
	 *
	 */

	private function recreate_shipment($id)
	{
		$this->package_fedex_action4($id);

		//查询数据库
		$status=$this->Base_Package_Status_model-> get_fedex_package_status_info('status',array('pk_id'=>$id));
		$status=$status['status'];
		if($status==1)
		{
			$this->package_fedex_action1($id);
		}
		else
		{
			return 0;
		}
		//查询数据库
		$status=$this->Base_Package_Status_model-> get_fedex_package_status_info('status',array('pk_id'=>$id));
		$status=$status['status'];
		if($status==2)
		{
			$this->package_fedex_action2($id);
		}
		else
		{
			return 0;
		}

		//查询数据库
		$status=$this->Base_Package_Status_model-> get_fedex_package_status_info('status',array('pk_id'=>$id));
		$status=$status['status'];
		if($status==3)
		{
			$this->package_fedex_action3($id);
			return 1;
		}
		else
		{
			return 0;
		}
	}




	/**
	 * 发起feded创建运单请求第一步
	 */
	private function package_fedex_action0($id)
	{
		//model
		$this->load->model('Base_Package_model');
		$this->load->model('Base_Package_Status_model');
		$this->load->model('Base_Fedex_Package_log_model');

		$package_request_status = $this->Base_Package_model->get_fedex_package_info('package_request_status',array('id'=>$id));
		$package_request_status=$package_request_status['package_request_status'];
		if($package_request_status==1)
		{
			$this->Base_Package_Status_model->package_status_add(array('pk_id'=>$id,'status'=>1,'content'=>'待创建运单'));
			$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"待创建运单"));
		}
		else
		{
			$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>'创建运单失败:包裹状态未达到待取单状态'));
		}


	}


	/**
	 * 创建运单操作
	 * param $id   int  包裹id
	 */
	private function package_fedex_action1($id)
	{
		//加载类库
		$this->load->library('CI_Fedex');
		//model
		$this->load->model('Base_Package_model');
		$this->load->model('Admin_Spuser_model');
		$this->load->model('Base_Logistics_model');
		$this->load->model('Base_Order_model');
		$this->load->model('Base_Package_Status_model');
		$this->load->model('Base_Fedex_Package_log_model');

		
		$packageInfo=$this->Base_Package_model-> get_fedex_packages('id,batches_id,package_request_status,userid,fedex_length,fedex_width,fedex_height,fedex_lwh_unit,fedex_weight,fedex_weight_unit,fedex_package_type,fedex_service_type,ship_timestamp',array('id'=>$id));

		//判断包裹状态是否为待取单状态
		if($packageInfo[0]['package_request_status']==1)
		{
			//获取供应商信息 包含
			$user_id_info=$this->Admin_Spuser_model->get_spuser_info('send_addr_id,end_addr_id,dutiesPayment_id,payor_id,fedex_account',array('id'=>$packageInfo[0]['userid']));

			//获取基础配置信息
			$sql="SELECT * FROM ".tab_m('fedex_account')." WHERE id=".$user_id_info['fedex_account'];
			$fedex_account=$this->db->query($sql)->row_array();


			$arr['CustomerTransactionId']=$this->user_id.'-'.$packageInfo[0]['id'];
			$arr['Key']=$fedex_account['Key'];
			$arr['Password']=$fedex_account['Password'];
			$arr['AccountNumber']=$fedex_account['AccountNumber'];
			$arr['MeterNumber']=$fedex_account['MeterNumber'];
			//加载配置项

			//a、获取CustomerTransactionId
			
			//b、绑定交易详情的基础信息，包含基本账号等信息
			$this->ci_fedex->buildTransactionDetail($arr);
			//绑定服务类型
			$this->ci_fedex->service_type=$packageInfo[0]['fedex_service_type'];
			//绑定发送fedex包裹类型
			$this->ci_fedex->packge_type=$packageInfo[0]['fedex_package_type'];
			//绑定寄件时间
			$this->ci_fedex->ship_timestamp=strtotime($packageInfo[0]['ship_timestamp']);


			//c、绑定发件方信息
			$shiper=$this->Base_Logistics_model->get_fedex_user_info('personName,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode',
				array('id'=>$user_id_info['send_addr_id']));

			$this->ci_fedex->addShipper($shiper);

			//d、绑定收件方信息
			$reci =$this->Base_Logistics_model->get_fedex_user_info('personName,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode,Address_Residential',
				array('id'=>$user_id_info['end_addr_id']));
			$this->ci_fedex->addRecipient($reci);

			//e、设置运费信息
			$payor = $this->Base_Logistics_model->get_fedex_user_info('personName,account,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode',
				array('id'=>$user_id_info['payor_id']));
			$payor['paymentType']='THIRD_PARTY';

			$this->ci_fedex->addShippingChargesPayment($payor);

			//f、设置标签信息
			$this->ci_fedex->addLabelSpecification();

			//g、设置清关信息
			$customClearce = $this->Base_Logistics_model->get_fedex_user_info('type,Address_CountryCode,account',
				array('id'=>$user_id_info['dutiesPayment_id']));
			$customClearceAccount = array();
			if($customClearce['type']==1){
				$customClearceAccount['paymentType']='SENDER';
			}elseif($customClearce['type']==3){
				$customClearceAccount['paymentType']='SENDER';
			}
			$customClearceAccount['dutyaccount'] =$customClearce['account'];
			$customClearceAccount['Address_CountryCode'] =$customClearce['Address_CountryCode'];

			//获取结算货币以及总额


			//通过包裹ID查找该包裹下的订单
			$order_arr = $this->Base_Order_model->get_orders('id',array('fedex_pakge_id'=>$id));

			//根据订单id,查询order_list
			$amount = 0;
			$currency = $this->Base_Order_model->get_order_list_info('abroad_currency',array('order_id'=>$order_arr[0]['id']));
			$currency =$currency['abroad_currency'];
			foreach($order_arr as $key =>$value){
				$arr=$this->Base_Order_model->order_list_list('abroad_price,abroad_currency,num,name_en,abroad_weight,abroad_weight_unit',array('order_id'=>$value['id']));
				$amount =$arr[0]['num']*$arr[0]['abroad_price'];
			}
			$customValue['currency'] = $currency;
			$customValue['amount'] = $amount;
			$commdity = array();
			foreach ($arr as $key => $value){
				$commdity[$key]['NumberOfPieces'] = $value['num'];
				$commdity[$key]['Description'] = $value['name_en'];
				$commdity[$key]['CountryOfManufacture']='CA';
				$commdity[$key]['Weight']['Units'] = strtoupper($value['abroad_weight_unit']);
				$commdity[$key]['Weight']['Value'] = $value['abroad_weight'];
				$commdity[$key]['Quantity'] = $value['num'];
				$commdity[$key]['QuantityUnits'] = 'PCS';
				$commdity[$key]['UnitPrice']['Currency'] = $value['abroad_currency'];
				$commdity[$key]['UnitPrice']['Amount'] = $value['abroad_price'];
				$commdity[$key]['CustomsValue']['Currency'] = $value['abroad_currency'];
				$commdity[$key]['CustomsValue']['Amount'] = $value['num'] * $value['abroad_price'];
			}
			$this->ci_fedex->addCustomClearanceDetail($customClearceAccount,$customValue,$commdity);
			//设置包裹数量
			$this->ci_fedex->packageNum = 1;

			//设置包裹描述
			foreach ( $packageInfo as $key => $value){
				$addPackageLineItem[$key]['SequenceNumber']= $key+1;
				$addPackageLineItem[$key]['Weight']['Value'] = $value['fedex_weight'];
				$addPackageLineItem[$key]['Weight']['Units'] =$value['Units']= strtoupper($value['fedex_weight_unit']);
				$addPackageLineItem[$key]['Dimensions']['Length'] = $value['fedex_length'];
				$addPackageLineItem[$key]['Dimensions']['Width'] = $value['fedex_width'];
				$addPackageLineItem[$key]['Dimensions']['Height'] = $value['fedex_height'];
				$addPackageLineItem[$key]['Dimensions']['Units'] = strtoupper($value['fedex_lwh_unit']);
			}
			$this->ci_fedex->requestedPackageLineItems = $addPackageLineItem;

			$this->ci_fedex->buildCreateOpenShipmentRequest();
			//创建运单
			$result=$this->ci_fedex->createOpenShipment();

			if($result ==0)
			{//创建运单成功
				$arr=array();
				$arr['JobId'] = $this->ci_fedex->responseCreateOpenShipment->JobId;
				$arr['FormId'] = $this->ci_fedex->responseCreateOpenShipment->CompletedShipmentDetail->MasterTrackingId->FormId;
				$fedex_back_con=json_encode($arr);
				$res=$this->Base_Package_model->fedex_package_update(array('fedex_index' =>$this->ci_fedex->responseCreateOpenShipment->Index,'fedex_back_con'=>$fedex_back_con,'package_request_status'=>2),array('id'=>$id));
				$this->Base_Package_Status_model->package_status_update(array('status'=>2,'content'=>'创建运单成功,运单未验证'),array('pk_id'=>$id));
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"创建运单成功，运单未验证"));
			}
			elseif($result==1)
			{//创建运单失败
				$failreason='错误码:【'.$this->ci_fedex->responseCreateOpenShipment->Notifications->Code.'】错误信息:【'.$this->ci_fedex->responseCreateOpenShipment->Notifications->Code->Message.'】';
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"创建运单失败:".$failreason));
				$this->Base_Package_Status_model->package_status_update(array('status'=>-1,'content'=>'创建运单失败:'.$failreason),array('pk_id'=>$id));
			}
			else
			{
				$failreason='错误码：【'.$result->faultcode.'】错误信息：【'.$result->faultstring.'】';
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"创建运单失败:".$failreason));
				$this->Base_Package_Status_model->package_status_update(array('status'=>-1,'content'=>'创建运单失败:'.$failreason),array('pk_id'=>$id));
			}
		}
		else
		{
			$this->Base_Package_Status_model->package_status_update(array('status'=>-1,'content'=>'创建运单失败：包裹状态未达到待取单状态'),array('pk_id'=>$id));
			$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>'创建运单失败,包裹状态未达到待取单状态'));
		}


	}

	/**
	 * 验证运单操作
	 * param $id   int  包裹id
	 */
	private function package_fedex_action2($id)
	{
			//model
			$this->load->model('Base_Package_model');
			$this->load->model('Admin_Spuser_model');
			$this->load->model('Base_Logistics_model');
			$this->load->model('Base_Order_model');
			$this->load->model('Base_Package_Status_model');
			$this->load->model('Base_Fedex_Package_log_model');

			$package_request_status = $this->Base_Package_model->get_fedex_package_info('package_request_status',array('id'=>$id));
			$package_request_status=$package_request_status['package_request_status'];
			if($package_request_status==2)
			{

				//加载类库
				$this->load->library('CI_Fedex');

				$packageInfo=$this->Base_Package_model-> get_fedex_packages('id,batches_id,fedex_index,package_request_status,userid,fedex_length,fedex_width,fedex_height,fedex_lwh_unit,fedex_weight,fedex_weight_unit,fedex_package_type,fedex_service_type,ship_timestamp',array('id'=>$id));

				//获取供应商信息 包含
				$user_id_info=$this->Admin_Spuser_model->get_spuser_info('send_addr_id,end_addr_id,dutiesPayment_id,payor_id,fedex_account',array('id'=>$packageInfo[0]['userid']));
				//获取基础配置信息
				$sql="SELECT * FROM ".tab_m('fedex_account')." WHERE id=".$user_id_info['fedex_account'];
				$fedex_account=$this->db->query($sql)->row_array();

				$index=$packageInfo[0]['fedex_index'];
				$arr['CustomerTransactionId']=$this->user_id.'-'.$packageInfo[0]['id'];
				$arr['Key']=$fedex_account['Key'];
				$arr['Password']=$fedex_account['Password'];
				$arr['AccountNumber']=$fedex_account['AccountNumber'];
				$arr['MeterNumber']=$fedex_account['MeterNumber'];
				$arr['Index']=$packageInfo[0]['fedex_index'];
				$this->ci_fedex->buildTransactionDetail($arr);

				$this->ci_fedex->buildValidateOpenShipmentRequest($index);

				$result = $this->ci_fedex->validateOpenShipment();
				if($result == 0){
					$res=$this->Base_Package_model->fedex_package_update(array('package_request_status'=>4),array('fedex_index'=>$index));

					$this->Base_Package_Status_model->package_status_update(array('status'=>3,'content'=>'运单已验证，未确认'),array('pk_id'=>$id));
					$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"运单已验证，未确认"));

				}elseif ($result ==1){
					$res=$this->Base_Package_model->fedex_package_update(array('package_request_status'=>5,),array('fedex_index'=>$index));
					$error=json_encode($this->ci_fedex->responseValidateOpenShipment->Notifications);
					$error=json_decode($error,true);
					if(array_key_exists(0,$error)){
						$failreason='错误码:【'.$error[0]['Code'].'】错误信息:【'.$error[0]['Message'].'】';
					}else{
						$failreason='错误码:【'.$error['Code'].'】错误信息:【'.$error['Message'].'】';
					}
					$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"验证运单失败".$failreason));
					$this->Base_Package_Status_model->package_status_update(array('status'=>-2,'content'=>'验证运单失败'.$failreason),array('pk_id'=>$id));

				}else{
					$failreason='错误码：【'.$result->faultcode.'】错误信息：【'.$result->faultstring.'】';
					$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"验证运单失败:".$failreason));
					$this->Base_Package_Status_model->package_status_update(array('status'=>-2,'content'=>'验证运单失败:'.$failreason),array('pk_id'=>$id));

				}
			}
			else
			{
				$this->Base_Package_Status_model->package_status_update(array('status'=>-2,'content'=>'验证运单失败：包裹状态未达到已取单（创建运单）状态'),array('pk_id'=>$id));
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>'验证运单失败：包裹状态未达到已取单（创建运单）状态'));
			}


	}

	/**
	 * 确认运单单操作
	 * param $id   int  包裹id
	 */
	private function package_fedex_action3($id)
	{

			//model
			$this->load->model('Base_Package_model');
			$this->load->model('Admin_Spuser_model');
			$this->load->model('Base_Logistics_model');
			$this->load->model('Base_Order_model');
			$this->load->model('Base_Package_Status_model');
			$this->load->model('Base_Fedex_Package_log_model');

			$package_request_status = $this->Base_Package_model->get_fedex_package_info('package_request_status',array('id'=>$id));
			$package_request_status=$package_request_status['package_request_status'];
			if($package_request_status==4)
			{

				//加载类库
				$this->load->library('CI_Fedex');
				$packageInfo=$this->Base_Package_model-> get_fedex_packages('id,batches_id,fedex_index,package_request_status,userid,fedex_length,fedex_width,fedex_height,fedex_lwh_unit,fedex_weight,fedex_weight_unit,fedex_package_type,fedex_service_type,ship_timestamp',array('id'=>$id));

				//获取供应商信息 包含
				$user_id_info=$this->Admin_Spuser_model->get_spuser_info('send_addr_id,end_addr_id,dutiesPayment_id,payor_id,fedex_account',array('id'=>$packageInfo[0]['userid']));
				//获取基础配置信息
				$sql="SELECT * FROM ".tab_m('fedex_account')." WHERE id=".$user_id_info['fedex_account'];
				$fedex_account=$this->db->query($sql)->row_array();

				$index=$packageInfo[0]['fedex_index'];
				$arr['CustomerTransactionId']=$this->user_id.'-'.$packageInfo[0]['id'];
				$arr['Key']=$fedex_account['Key'];
				$arr['Password']=$fedex_account['Password'];
				$arr['AccountNumber']=$fedex_account['AccountNumber'];
				$arr['MeterNumber']=$fedex_account['MeterNumber'];
				$arr['Index']=$packageInfo[0]['fedex_index'];

				$this->ci_fedex->buildTransactionDetail($arr);

				$this->ci_fedex->buildConfirmOpenShipmentRequest($index);

				$res = $this->ci_fedex->confirmOpenShipment();
				if($res == 0)
				{
					$result=$this->Base_Package_model->fedex_package_update(array('package_request_status'=>6,'status'=>3),array('fedex_index'=>$index));
					$this->Base_Package_Status_model->package_status_update(array('status'=>4,'content'=>'运单已确认'),array('pk_id'=>$id));
					$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"运单已确认"));
				}
				elseif($res == 1)
				{
					$error=json_encode($this->ci_fedex->responseConfirmOpenShipment->Notifications);
					$error=json_decode($error,true);
					if(array_key_exists(0,$error)){
						$failreason='错误码:【'.$error[0]['Code'].'】错误信息:【'.$error[0]['Message'].'】';
					}else{

						$failreason='错误码:【'.$error['Code'].'】错误信息:【'.$error['Message'].'】';
					}
					$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"确认运单失败：".$failreason));
					$this->Base_Package_Status_model->package_status_update(array('status'=>-3,'content'=>'确认运单失败：'.$failreason),array('pk_id'=>$id));
				}else
				{
					$failreason='错误码：【'.$result->faultcode.'】错误信息：【'.$result->faultstring.'】';
					$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"确认运单失败:".$failreason));
					$this->Base_Package_Status_model->package_status_update(array('status'=>-3,'content'=>'确认运单失败:'.$failreason),array('pk_id'=>$id));
				}
			}
			else
			{
				$this->Base_Package_Status_model->package_status_update(array('status'=>-3,'content'=>'确认运单失败：包裹状态未达到已验证（运单已经验证）状态'),array('pk_id'=>$id));
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>'验证运单失败：包裹状态未达到已验证（运单已经验证）状态'));
			}



	}

	/**
	 * 删除运单单操作
	 * param $id   int  包裹id
	 */
	private function package_fedex_action4($id)
	{
			//加载类库
			$this->load->library('CI_Fedex');

			//model
			$this->load->model('Base_Package_model');
			$this->load->model('Admin_Spuser_model');
			$this->load->model('Base_Logistics_model');
			$this->load->model('Base_Order_model');
			$this->load->model('Base_Package_Status_model');
			$this->load->model('Base_Fedex_Package_log_model');

			$packageInfo=$this->Base_Package_model-> get_fedex_packages('id,batches_id,fedex_index,package_request_status,userid,fedex_length,fedex_width,fedex_height,fedex_lwh_unit,fedex_weight,fedex_weight_unit,fedex_package_type,fedex_service_type,ship_timestamp',array('id'=>$id));

			//获取供应商信息 包含
			$user_id_info=$this->Admin_Spuser_model->get_spuser_info('send_addr_id,end_addr_id,dutiesPayment_id,payor_id,fedex_account',array('id'=>$packageInfo[0]['userid']));
			//获取基础配置信息
			$sql="SELECT * FROM ".tab_m('fedex_account')." WHERE id=".$user_id_info['fedex_account'];
			$fedex_account=$this->db->query($sql)->row_array();
	

			$arr['CustomerTransactionId']=$this->user_id.'-'.$packageInfo[0]['id'];
			$arr['Key']=$fedex_account['Key'];
			$arr['Password']=$fedex_account['Password'];
			$arr['AccountNumber']=$fedex_account['AccountNumber'];
			$arr['MeterNumber']=$fedex_account['MeterNumber'];
			$arr['Index']=$packageInfo[0]['fedex_index'];
			$result =$this->ci_fedex->delete_fedex_index($arr);
			if($result == 0){
				$res=$this->Base_Package_model->fedex_package_update(array('fedex_index'=>0,'package_request_status'=>1,'status'=>2),array('id'=>$id));
				$this->Base_Package_Status_model->package_status_update(array('status'=>1,'content'=>'待创建运单'),array('pk_id'=>$id));
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"待创建运单"));
			}
			elseif($result ==1)
			{
				$failreason = '删除主单请求失败，请再次尝试';

				$error=json_encode($this->ci_fedex->responseDeleteOpenShipment->Notifications);
				$error=json_decode($error,true);
				if(array_key_exists(0,$error)){
					$failreason='错误码:【'.$error[0]['Code'].'】错误信息:【'.$error[0]['Message'].'】';
				}else{

					$failreason='错误码:【'.$error['Code'].'】错误信息:【'.$error['Message'].'】';
				}
				$this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"删除运单失败：".$failreason));

			
			}
	}

	/**
	 * FedEx 基础信息配置列表
	 */
    public  function  fedex_config()
	{
		//model
		$this->load->model('Base_Logistics_model');

		if( isset($_GET) )
		{
			//非模糊字段 搜索
			$search_key      = array(  'AccountNumber' );
			//模糊字段 搜索
			$search_key_like = array();
			$wsql='1=1';
			foreach ( $_GET as $k => $v )
			{
				$skey = substr( $k , 7 , strlen($k)-7 );
				if ( $k != 'search_page_num' && substr( $k , 0 , 7 ) == 'search_' && !in_array( $v , array('all','') ) )
				{
					//非模糊字段
					if ( in_array( $skey , $search_key ) )
					{
						$wsql.=" and {$skey}='{$v}'";
					}
					//模糊字段
					if ( in_array( $skey , $search_key_like ) )
					{
						$wsql.=" and {$skey} like '%{$v}%'";
					}
				}
			}
		}

		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url = site_url( $this->class."/".$this->method );
		$search_page_num = array( 'all' => 15, 1 => 15, 2 => 30 , 3 => 50 );
		$this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
		$sql="SELECT * FROM ".tab_m('fedex_account')." WHERE ".$wsql."  order by id DESC ";
		if ( !$this->ci_page->__get('totalRows') )
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows = $query->num_rows;
		}

		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();

		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $query->result_array();


		$this->ci_smarty->assign('re',$res);
		$this->ci_smarty->display_ini('fedex_config.htm');
	}


	//添加 或者编辑
	public function  fedex_config_add()
	{
		if(!empty($_POST))
		{
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('Key','秘钥','required');
			$this->form_validation->set_rules('Password','密码','required');
			$this->form_validation->set_rules('AccountNumber','账号','required');
			$this->form_validation->set_rules('MeterNumber','Meter账号','required');
			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				$package_arr = array();
				$package_arr['Key'] = $this->input->post('Key', true);
				$package_arr['Password'] = $this->input->post('Password', true);
				$package_arr['AccountNumber'] = $this->input->post('AccountNumber', true);
				$package_arr['MeterNumber'] = $this->input->post('MeterNumber', true);

				if(empty($_POST['id']))
				{//添加
					$res=$this->db->insert(tab_m('fedex_account'),$package_arr);
				}
				else
				{//编辑
					$res=$this->db->update(tab_m('fedex_account'),$package_arr,array('id'=>$this->input->post('id',true)));
				}

				if( $res )
				{
					$msg = array(
						'msg'  => "操作成功",
						'type' => 3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg = array(
						'msg'  => '提交失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}


			}
		}
		
		if(!empty($_GET))
		{
			$sql="SELECT * FROM ".tab_m('fedex_account')." WHERE id=".$_GET['id'];
			$de=$this->db->query($sql)->row_array();
			$this->ci_smarty->assign('de',$de);
		}

		$this->ci_smarty->display_ini('fedex_config_add.htm');
	}

}