<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Package extends MY_Controller 
{
	public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->load_sp_menu();  
	}


	//包裹 列表
	public function package_list()
	{
		//model
		$this->load->model('Base_Package_model');
		$this->load->model('Base_Order_model');

		//搜索
		$key      = array();
		$key_like = array();

		//只显示会员包裹
		$key['userid'] = $this->user_id;
		$key['type'] = 1;
		
		if( isset($_GET) )
		{
			//非模糊字段 搜索
			$search_key      = array( 'batches_id' , 'id' , 'status' , 'fedex_index' , 'fedex_index_sqnumber' );
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
		$this->ci_smarty->display_ini('package_list.htm');
	}

	//包裹 添加
	public function package_add()
	{

		//载入页面
		if ( !empty( $_POST )  )
		{
			//model
			$this->load->model('Base_Package_model');

			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('fedex_type','fedex包裹类型','required');
			$this->form_validation->set_rules('ship_timestamp','fedex预计寄件日期','required');
			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}else{
				if($_POST['fedex_type']=='YOUR_PACKAGING')
				{
					$this->form_validation->set_rules('fedex_length','长','required');

					$this->form_validation->set_rules('fedex_height','高','required');
					$this->form_validation->set_rules('fedex_width','宽','required');
					$this->form_validation->set_rules('fedex_lwh_unit','长宽高计量单位','required');
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
						$package_arr['fedex_length']    = $this->input->post('fedex_length',true)*1;
						$package_arr['fedex_height']    = $this->input->post('fedex_height',true)*1;
						$package_arr['fedex_width']     = $this->input->post('fedex_width',true)*1;
						$package_arr['fedex_lwh_unit']  = $this->input->post('fedex_lwh_unit',true);
						$package_arr['userid']          = $this->user_id;
						$package_arr['fedex_package_type'] =$this->input->post('fedex_type',true);
						$time=explode('-',$this->input->post('ship_timestamp',true));
						$package_arr['ship_timestamp']  =mktime(0,0,0,$time[1],$time[2],$time[3]);
						$package_arr['type'] = $this->input->post('type');

						$flag = $this->Base_Package_model->fedex_package_add( $package_arr );
						if ( $flag == 1 )
						{
							$msg=array(
								'msg'  => "操作成功",
								'type' => 2
							);
							echo json_encode($msg);
							die;
						}
						else
						{
							$msg = array(
								'msg'  => '添加失败',
								'type' => 1
							);
							echo json_encode($msg);
							die;
						}
					}
				}else{
					$package_arr = array();
					$package_arr['fedex_package_type']  = $this->input->post('fedex_type',true);
					$time=explode('-',$this->input->post('ship_timestamp',true));
					$package_arr['ship_timestamp']  =mktime(0,0,0,$time[1],$time[2],$time[3]);
					$package_arr['userid']              = $this->user_id;
					$package_arr['type'] = $this->input->post('type');

					$flag = $this->Base_Package_model->fedex_package_add( $package_arr );
					if ( $flag == 1 )
					{
						$msg=array(
							'msg'  => "操作成功",
							'type' => 2
						);
						echo json_encode($msg);
						die;
					}
					else
					{
						$msg = array(
							'msg'  => '添加失败',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
				}

			}
		}
			$this->ci_smarty->display_ini('package_add.htm');





	}



	//包裹 加入订单
	public function package_add_order()
	{
		if ( !empty( $_POST['id'] ) )
		{
			$res = array();
			$res['id'] = $this->input->post('id',true);
			$res['type']=$this->input->post('action',true);
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}
	
		//载入页面
		$this->ci_smarty->display('package_add_order.htm');
	}

	//包裹 订单查询
	public function package_order_list()
	{

		if ($_GET['type']=='list')
		{
			if ( $_GET['fedex_pakge_id'] )
			{
				//model
				$this->load->model('Base_Package_model');
				$this->load->model('Base_Batches_model');

				//包裹ID
				$res['fedex_pakge_id'] = $_GET['fedex_pakge_id'];

				//查询该包裹下的订单
				$this->load->model('Base_Order_model');

				//搜索
				$key = array();
				$key_like = array();
				$key['fedex_pakge_id'] = $_GET['fedex_pakge_id'];
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
			//加载页面
			$this->ci_smarty->assign('show_ajax',1);
			$this->ci_smarty->display_ini('package_confirm_order_list.html');
		}else {

			$res = array();

			if ($_GET['fedex_pakge_id']) {
				//model
				$this->load->model('Base_Package_model');
				$this->load->model('Base_Batches_model');

				//包裹ID
				$res['fedex_pakge_id'] = $_GET['fedex_pakge_id'];

				//是否存在批次
				$package_info = $this->Base_Package_model->get_fedex_package_info('batches_id', array('id' => $res['fedex_pakge_id']));
				$res['batches_id_index'] = $package_info['batches_id'];

				//查询可添加批次
				if ($res['batches_id_index'] == 0) {
					$res['batches'] = $this->Base_Batches_model->get_batches('id,batches_name', array('status' => 4));
				}

				//查询该包裹下的订单
				$this->load->model('Base_Order_model');

				//搜索
				$key = array();
				$key_like = array();
				$key['fedex_pakge_id'] = $_GET['fedex_pakge_id'];
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
				$this->ci_smarty->assign('re', $res);
			}

			if ($_GET['batches_id']) {
				//model
				$this->load->model('Base_Order_model');

				//搜索
				$key = array();
				$key_like = array();
				$key['userid'] = $this->user_id;
				$key['batches_id'] = $_GET['batches_id'];
				$key['package_status'] = 0;

				if (!empty($_GET['order_status']) && $_GET['order_status'] == '-1') {
					$key['fedex_pakge_id'] = 0;
				} elseif (!empty($_GET['order_status']) && $_GET['order_status'] == '1') {
					$key['fedex_pakge_id !='] = 0;
				}

				if (!empty($_GET['consignee_mobile'])) {
					$key['consignee_mobile'] = $_GET['consignee_mobile'];
				}

				//分页
				$this->load->library('CI_page');
				$this->ci_page->Page();
				$this->ci_page->url = site_url($this->class . "/" . $this->method);
				$search_page_num = array('all' => 15, 1 => 15, 2 => 30, 3 => 50);
				$this->ci_page->listRows = !isset($_GET['search_page_num']) || empty($search_page_num[$_GET['search_page_num']]) ? 15 : $search_page_num[$_GET['search_page_num']];
				if (!$this->ci_page->__get('totalRows')) {
					$this->ci_page->totalRows = $this->Base_Order_model->order_list_rows($key, $key_like);
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
				$res['fedex_pakge_id'] = $_GET['fedex_pakge_id'];
				$res['batches_id'] = $_GET['batches_id'];
				$this->ci_smarty->assign('re', $res, 1, 'page');
			}

			//加载页面
			$this->ci_smarty->display('package_order_list.htm');
		}	
	}

	//包裹 订单添加包裹
	public function package_fedex_pakge_id()
	{	
		if ( $_POST ) 
		{
			//model
			$this->load->model('Base_Order_model');
			$this->load->model('Base_Package_model');

			$id = $_POST['fedex_pakge_id'];
			//加入包裹/取消包裹
			if ( $_GET['type'] == 1 ) 
			{	
				$fedex_pakge_id = $_POST['fedex_pakge_id'];
			}
			elseif ( $_GET['type'] == 2 )
			{
				$fedex_pakge_id = 0;
			}
			$batches_id = $_POST['batches_id'];
			unset( $_POST['fedex_pakge_id'] );
			unset( $_POST['batches_id'] );

			//整理修改数据
			$order_arr = array();	
			foreach ( $_POST as $key => $value ) 
			{
				if ( $value != $fedex_pakge_id )
				{
					$order_arr[] = array( 'id' => $key , 'fedex_pakge_id' => $fedex_pakge_id );
				}
			}

			//判断提交数据是否改变
			if( !empty($order_arr) )
			{
				//修改订单
				$flag1 = $this->Base_Order_model->order_update_batches( $order_arr );

				//包裹中是否还有订单
				$order_num = $this->Base_Order_model->order_list_rows( array( 'fedex_pakge_id' => $id ) , '' );
				if ( $order_num == 0 )
				{
					$batches_id = 0;
				}

				//修改包
				$flag2 = $this->Base_Package_model->fedex_package_update( array( 'batches_id' => $batches_id ) , array( 'id' => $id ) );
				
				if( $flag1 && $flag2 )
				{
					$msg=array(
						'msg'=>'操作成功',
						'type'=>3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg=array(
						'msg'=>'操作失败',
						'type'=>1
					);
					echo json_encode($msg);
					die;
				}	
			}
			else
			{
				$msg=array(
					'msg'=>'操作成功',
					'type'=>3
				);
				echo json_encode($msg);
				die;
			}
		}
	}

	//包裹 加入订单
	public function package_confirm()
	{
		//model
		$this->load->model('Base_Order_model');
		$this->load->model('Base_Package_model');
		$this->load->model('Base_Batches_model');

		if ( !empty( $_POST['id'] ) )
		{
			$res = array();
			//查询包裹信息
			$res = $this->Base_Package_model->get_fedex_package_info( 'id,fedex_length,fedex_height,fedex_width,fedex_lwh_unit', array('id' => $_POST['id']) );
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}

		if ( !empty( $_POST['fedex_pakge_id'] ) )
		{
			
			$package_info = $this->Base_Package_model->get_fedex_package_info( 'status,batches_id', array('id' => $_POST['fedex_pakge_id']) );
			//判断数据库的数据是否改变
			if ( $package_info['status'] != 1 ) 
			{
				$msg = array(
					'msg'  => '提交失败',
					'type' => 1
				);	
				echo json_encode($msg);
				die;
			}
			//判断是否添加包裹
			if ( $package_info['batches_id'] == 0 ) 
			{
				$msg = array(
					'msg'  => '包裹内不存在订单',
					'type' => 1
				);	
				echo json_encode($msg);
				die;
			}

			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('fedex_length','长','required');
			$this->form_validation->set_rules('fedex_height','高','required');
			$this->form_validation->set_rules('fedex_width','宽','required');
			$this->form_validation->set_rules('fedex_lwh_unit','长宽高计量单位','required');	
			$this->form_validation->set_rules('fedex_weight','包裹重量','required'); 
			$this->form_validation->set_rules('fedex_weight_unit','重量单位','required');	
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
				//修改重量、重量单位、包裹状态
				$package_arr = array();
				$package_arr['fedex_length']      = $this->input->post('fedex_length',true);
				$package_arr['fedex_height']      = $this->input->post('fedex_height',true);
				$package_arr['fedex_width']       = $this->input->post('fedex_width',true);
				$package_arr['fedex_lwh_unit']    = $this->input->post('fedex_lwh_unit',true);
				$package_arr['fedex_weight']      = $this->input->post('fedex_weight',true);
				$package_arr['fedex_weight_unit'] = $this->input->post('fedex_weight_unit',true);
				$package_arr['status']            = 2;
				$flag1 = $this->Base_Package_model->fedex_package_update( $package_arr , array( 'id' => $_POST['fedex_pakge_id'] ) );
				
				//修改所有订单的包裹状态
				$flag2 = $this->Base_Order_model->update_order_info( array( 'package_status' => 1 ) , array( 'fedex_pakge_id' => $_POST['fedex_pakge_id'] ) );

				$batches=$this->db->query('SELECT batches_id  FROM '.tab_m('order').'  where fedex_pakge_id ='.$_POST['fedex_pakge_id'].' GROUP BY batches_id ')->result_array();

				//查询这些批次下的所有订单

				foreach ($batches as $key =>$val){
					$package_arr=$this->Base_Order_model->get_orders('id',array('batches_id'=>$val['batches_id'],'package_status'=>0));
					if(!$package_arr){//说明此批次下所有订单的包裹状态全部已经改为已确认
						$this->Base_Batches_model->batches_uqdate(array('status'=>5),array('id'=>$val['batches_id']));
					}
				}
				if( $flag1 && $flag2 )
				{
					$msg = array(
						'msg'  => "操作成功",
						'type' => 2
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
		$this->ci_smarty->display('package_confirm.htm');
	}

	//包裹多选框 批量审批
	public function package_checkbox()
	{

		//model
		$this->load->model('Base_Package_model');



		if (!empty($_GET['type']))
		{
			//申请备案
			if ( $_GET['type'] == 1 )
			{
				$filing_status = array();
				foreach ( $_POST as $k => $v )
				{
					$filing_status[] = array('id' => $k,'status' => 4);
				}
				$flag = $this->Base_Package_model->package_uqdate_status($filing_status);
				if ( !empty($flag) )
				{
					$msg = array(
						'msg'  => '操作成功',
						'type' => 3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg = array(
						'msg'  => '操作失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}
		}
	}



}