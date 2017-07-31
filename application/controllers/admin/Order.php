<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Order extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');   
	}

	//订单管理 列表
	public function order_list()
	{
		
        //model
		$this->load->model('Base_Order_model');

		//搜索
		$key      = array('status!='=>-1);
		$key_like = array();
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('id','import_id','status','card_status','batches_id','userid');
			//模糊字段 搜索
			$search_key_like = array();
			foreach($_GET as $k => $v)
			{
				$skey = substr($k,7,strlen($k)-7);  
				if($k != 'search_page_num' && substr($k,0,7) == 'search_' && !in_array($v,array('all','')))
				{
					//非模糊字段
					if(in_array($skey,$search_key))
						$key[$skey] = $v;
					if($skey=='status' && $v==-1)
					{

						$key=array_remove($key,'status!=');
						$key['status']=$v;
					}
					//模糊字段
					if(in_array($skey,$search_key_like))
						$key_like[$skey] = $v;	
				}
			}
		}

		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url = site_url($this->class."/".$this->method);
		$search_page_num = array('all'=>15,1=>15,2=>30,3=>50);
		$this->ci_page->listRows =! isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows = $this->Base_Order_model->order_list_rows($key,$key_like);
		}
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Order_model->order_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);
		
		//加入商品信息及关区信息
		foreach ($res['list'] as $k => $v)
		{
			$row = $this->Base_Order_model->order_list_list('*',array('order_id' => $v['id']));
			$res['list'][$k]['order_list'] = $row;
			
			//通过批次查询关区及备案税率信息
			$row=$this->db->query("select  tax_type from  ".tab_m('batches')."  where  id='$v[batches_id]'  ")->row_array();
			$res['list'][$k]['tax_type']=$row['tax_type'];
		}	
		
		//加入批次
		if ( !empty($_GET['search_userid']) ) 
		{
			$res['batches_id'] = $this->Base_Order_model->get_batches_id(array('userid' => $_GET['search_userid']));
		}
		
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('order_list.htm');
 
	}

	//订单管理 
	public function order_edit()
	{

		//model
		$this->load->model('Base_Order_model');
		$this->load->model('Base_District_model');

		//获取原始数据
		if(!empty($_GET['id']))
		{
			//获取原始数据
			$res = $this->Base_Order_model->get_order_info( 'id,status,userid,consignee,province,city,area,consignee_address,consignee_mobile,card_no,return_con' , array( 'id' => $_GET['id'] ) );
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}
		//载入页面
		$this->ci_smarty->display_ini('order_edit.htm');
	}
	//订单管理 编辑
	public function order_edit1()
	{
		//model
		$this->load->model('Base_Order_model');
		$this->load->model('Base_District_model');

		//获取原始数据
		if(!empty($_GET['id']))
		{
			//获取原始数据
			$res = $this->Base_Order_model->get_order_info( 'id,status,userid,consignee,province,city,area,consignee_address,consignee_mobile,card_no,return_con' , array( 'id' => $_GET['id'] ) );
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}

		//获取修改数据
		if(!empty($_POST['id']))
		{
			//通过订单状态判断操作内容
			if ( $_POST['status'] > 0 && $_POST['status'] < 4 )
			{
				//表单验证
				$this->load->library('MY_form_validation');
				$this->form_validation->set_rules('consignee', '收获人姓名', 'required');
				$this->form_validation->set_rules('province', '省', 'required');
				$this->form_validation->set_rules('city', '市', 'required');
				$this->form_validation->set_rules('area', '区', 'required');
				$this->form_validation->set_rules('consignee_address', '收获人地址', 'required');
				$this->form_validation->set_rules('consignee_mobile', '收获人手机', 'required|exact_length[11]');
				$this->form_validation->set_rules('card_no', '身份证', 'required|exact_length[18]');
				if ($this->form_validation->run() == FALSE)
				{
					$msg = array(
						'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}

				$order_arr = array();
				$order_arr['consignee']         = $this->input->post('consignee',true);
				$order_arr['province']          = $this->input->post('province',true);
				$order_arr['city']              = $this->input->post('city',true);
				$order_arr['area']              = $this->input->post('area',true);
				$order_arr['consignee_address'] = $this->input->post('consignee_address',true);
				$order_arr['consignee_mobile']  = $this->input->post('consignee_mobile',true);
				$order_arr['card_no']           = $this->input->post('card_no',true);
				$order_arr['return_con']        = $this->input->post('return_con',true);
				//省ID获取
				$addr = $this->Base_District_model->check_addrtcode( $order_arr['province'].','.$order_arr['city'].','.$order_arr['area'] );
				$order_arr['province_id'] = $addr[0][0];
			}
			else
			{
				if ( $_POST['status_modify'] == 'choose' )
				{
					$msg = array(
						'msg'  => '未选择修改状态',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
				//获取订单状态
				$order_info = $this->Base_Order_model->get_order_info( 'status' , array( 'id' => $_POST['id'] ) );
				//判断数据是否已经修改
				if ( $_POST['status_modify'] == '5' )
				{
					if ( $order_info['status'] != -2 && $order_info['status'] != 4 )
					{
						$msg = array(
							'msg'  => '操作失败',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
				}
				elseif ( $_POST['status_modify'] == '-2' )
				{
					if ( $order_info['status'] != 5 && $order_info['status'] != 4 )
					{
						$msg = array(
							'msg'  => '操作失败',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
				}

				$order_arr = array();
				$order_arr['status']     = $this->input->post('status_modify',true);
				$order_arr['return_con'] = $this->input->post('return_con',true);
			}

			//修改订单信息
			$flag = $this->Base_Order_model->update_order_info( $order_arr ,array( 'id' => $this->input->post('id',true) ) );
			if($flag == 1)
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

		//载入页面
		$this->ci_smarty->display_ini('order_edit1.htm');
	}

	//订单管理 添加批次
	public function order_add_batches()
	{
		//model
		$this->load->model('Base_Order_model');
		$this->load->model('Base_Batches_model');

		if (!empty($_GET['type']))
		{			
			if (empty($_POST['add_batches'])) 
			{
				$msg = array(
					'msg'  => '未填写批次编号',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			
			//从$_POST中取出 添加的批次编号，然后释放
			$batches = $_POST['add_batches'];
			unset($_POST['add_batches']);

			if (count($_POST) < 1) 
			{
				$msg = array(
					'msg'  => '未勾选订单',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}				
			
			//从$_POST中取出 订单号、批次号，然后释放
			foreach ($_POST as $k => $v) 
			{
				if ( $v != '-1')
				{
					$msg = array(
						'msg'  => '订单已添加批次',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
				$orderid_arr[] = $k;
			}
			unset($_POST);
				
			//查询添加批次原始信息：订单总数
			$res_batches = $this->Base_Batches_model->get_batches_info('order_num',array('id' => $batches));			
			//添加（原始）批次中的订单总数，本次添加的订单的订单总数，两者相加
			$order_num = $res_batches['order_num']+count($orderid_arr);

			//订单号，批次号加入数组
			$order_arr = array();
			foreach ($orderid_arr as $value) 
			{
				$order_arr[] = array(
        			'id'         => $value,
            		'batches_id' => $batches
        		);
			}
			//订单添加批次号
			$flag1 = $this->Base_Order_model->order_update_batches($order_arr);
			
			if ($flag1) 
			{
				//批次状态、税款状态、运费状态、订单数修改
				$flag2 = $this->Base_Batches_model->batches_uqdate(
							array('status' => 2 , 'tax_status' => 2 , 'freight_status' => 2 , 'order_num' => $order_num),
							array('id' => $batches)
						);
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

			if ($flag2)
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

	//订单管理 取消批次
	public function order_cancel_batches()
	{
		//model
		$this->load->model('Base_Order_model');
		$this->load->model('Base_Batches_model');

		if ( !empty($_POST) ) 
		{			
			//订单在待审核的状态下可以取消
			if ( $_POST['status'] == 1 )
			{
				$import_id            = $_POST['import_id'];
				$batches_id           = $_POST['batches_id'];
				$total_rate           = $_POST['total_rate'];
				$total_freight        = $_POST['total_freight'];
				$total_freight_abroad = $_POST['total_freight_abroad'];

				//该订单的批次编号重置，总价、总税、运费清零
				$this->Base_Order_model->update_order_info( array('batches_id' => -1 , 'total_price' => 0 , 'total_rate' => 0 , 'total_freight' => 0 , 'total_freight_abroad' => $total_freight_abroad ) , array('import_id' => $import_id) );

				//该订单的下的所有清单的‘单价、税、是否备案状态’重置
				$this->Base_Order_model->order_list_update( array( 'price' => 0 , 'rate' => 0 ,'is_filing' => -1 ) , array( 'import_id' => $import_id ) );

				//查询批次原始信息：总税款、总运费、订单总数
				$res_batches = $this->Base_Batches_model->get_batches_info('tax_total,freight_total,freight_total_abroad,order_num,fail_order_num',array('id' => $batches_id));			
				
				$batches_arr = array();
				//批次中的总税款，减去，取消订单的总税款
				$batches_arr['tax_total'] = $res_batches['tax_total']-$total_rate;
				//批次中的总运费，减去，取消订单的总运费
				$batches_arr['freight_total'] = $res_batches['freight_total']-$total_freight;
				$batches_arr['freight_total_abroad'] = $res_batches['freight_total_abroad']-$total_freight_abroad;
				//批次中的订单总数，减一
				$batches_arr['order_num'] = $res_batches['order_num']-1;
				//如果订单运费存在，备案未通过订单数，减一
				if ( $total_freight != 0 )
				{
					$batches_arr['fail_order_num'] = $res_batches['fail_order_num']-1;
				}

				//修改批次中的总税款、总运费、订单总数、备案未通过订单数
				$this->Base_Batches_model->batches_uqdate( $batches_arr , array('id' => $batches_id) );

				$msg = '操作成功';	
				echo json_encode($msg);
				die;
			}			
		}
	}

	/**
	 * 订单添加 国内运单页面显示
	 */
	public function order_add_logis_no()
	{

		if(!empty($_GET['id']))
		{
			
			//加载配置项
			$this->load->config('base_config',true);

			$logistics_type=$this->config->item('order_logistics_type','base_config');
			//model
			$this->load->model('Base_Order_model');
			$res=$this->Base_Order_model->get_order_info('*',array('id'=>$_GET['id']));
			$res['id'] =$_GET['id'];

			$this->ci_smarty->assign('logistics_type',$logistics_type);
			$this->ci_smarty->assign('re',$res);
		}
		$this->ci_smarty->display_ini('order_add_logis_no.htm');
	}
	
	/**
	 * 订单添加  国内运单操作
	 */
	public function order_add_logis()
	{
		if(!empty($_POST))
		{
			//model
			$this->load->model('Base_Order_model');
			//数据验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('logistics_no', '运单号', 'required');
			$this->form_validation->set_rules('logistics_type', '运单类型', 'required');
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
				$order_arr['logistics_no']= $this->input->post('logistics_no',true);
				$order_arr['logistics_type']= $this->input->post('logistics_type',true);

				$res=$this->Base_Order_model->order_row_update($order_arr,array('id'=>$_POST['id']));


				if ( !empty($res) )
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

	/**
	 * 订单是否指定费用
	 */
	public function order_assign_fee()
	{

		if(!empty($_GET['id']))
		{


			//model
			$this->load->model('Base_Order_model');
			$res=$this->Base_Order_model->get_order_info('*',array('id'=>$_GET['id']));
			$res['id'] =$_GET['id'];

			$this->ci_smarty->assign('re',$res);
			if($_GET['act']==1)
			{//指定预估费率
				$this->ci_smarty->display_ini('order_assign_fee.htm');
			}
			elseif($_GET['act']==2)
			{
				$this->ci_smarty->display_ini('order_assign_fee1.htm');
			}
			elseif ($_GET['act']==3)
			{
				$this->ci_smarty->display_ini('order_assign_fee2.htm');
			}
			
		}

		if(!empty($_POST['id']))
		{
			$this->load->model('Base_Order_model');
			//数据验证
			if($_POST['act']==1)
			{
				$this->load->library('MY_form_validation');
				$this->form_validation->set_rules('is_assign_fee', '是否指定运费', 'required');
				$this->form_validation->set_rules('assign_fee', '指定预估运费', 'required|numeric');
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
					$order_arr['is_assign_fee']= $this->input->post('is_assign_fee',true);
					$order_arr['assign_fee']= $this->input->post('assign_fee',true);

					$res=$this->Base_Order_model->order_row_update($order_arr,array('id'=>$_POST['id']));


					if ( !empty($res) )
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
			elseif($_POST['act']==2)
			{
				$this->load->library('MY_form_validation');
				$this->form_validation->set_rules('is_assign_fee', '是否指定运费', 'required');
				$this->form_validation->set_rules('assign_cost_fee', '指定实际运费', 'required|numeric');
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
					$order_arr['is_assign_fee']= $this->input->post('is_assign_fee',true);
					$order_arr['assign_cost_fee']= $this->input->post('assign_cost_fee',true);

					$res=$this->Base_Order_model->order_row_update($order_arr,array('id'=>$_POST['id']));


					if ( !empty($res) )
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
			elseif ($_POST['act']==3)
			{
				$this->load->library('MY_form_validation');
				$this->form_validation->set_rules('is_assign_fee', '是否指定运费', 'required');
				$this->form_validation->set_rules('assign_actual_fee', '指定实收运费', 'required|numeric');
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
					$order_arr['is_assign_fee']= $this->input->post('is_assign_fee',true);
					$order_arr['assign_actual_fee']= $this->input->post('assign_actual_fee',true);

					$res=$this->Base_Order_model->order_row_update($order_arr,array('id'=>$_POST['id']));


					if ( !empty($res) )
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
	
}