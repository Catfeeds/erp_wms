<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Batches extends MY_Controller 
{
	public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');   
	}

    //身份证小票下载
	public function down_card()
	{
		$this->load->library('zip');
		$_GET['batches_id']*=1;
		if(!empty($_GET['batches_id']))
		{
			$de=$this->db->query("select  count(*) as num  from  ".tab_m('order')." where  batches_id='".$_GET['batches_id']."' and card_status=1 ")  ->row_array();
			
			$d=$this->db->query("select  count(*) as num  from  ".tab_m('order')." where  batches_id='".$_GET['batches_id']."'  ")  ->row_array();

			if($de['num']==0&&$d['num']>0)
			{
				//创建路径
				
				
				$this->db->where(array('batches_id',$_GET['batches_id']));
				$de=$this->db->select("id,userid")
						 ->from(tab_m('order'))
						 ->order_by('id','asc')
						 ->get()
						 ->result_array();
						 
				foreach($de as $V)
				{
					get_img_auth('card_1',$V['id'],$V['userid'],false,true);
					get_img_auth('card_2',$V['id'],$V['userid'],false,true);
					get_img_auth('xiaopian',$V['id'],$V['userid'],false,true);
				}
				
				$this->zip->read_dir(FCPATH.'/pt_img',false,FCPATH.'\\pt_img');//开始压缩指定路径的文件夹，清除里面的结构。
				$this->zip->download('my_backup.zip');//下载压缩后的的文件。
			}
			else
			{
				echo "该批次有".$de['num']."个订单未上传证件和小票";
				die;
			}
		}
		else
		{
			echo "无效批次";
			die;
		}	
	}


	//批次管理 列表
	public function batches_list()
	{
		//model
		$this->load->model('Base_Batches_model');

		//搜索
		$key      = array();
		$key_like = array();
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('id','status','tax_status','freight_status','userid','confirm_status');
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
			$this->ci_page->totalRows = $this->Base_Batches_model->batches_list_rows($key,$key_like);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Batches_model->batches_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);

		//关区
		require(APPPATH.'/config/base_config.php');
		$res['customs_list'] = $config['customs_list'];


		$this->config->load('base_config',TRUE);
		$confirm_status=$this->config->item('confirm_status','base_config');
		$this->ci_smarty->assign('confirm_status',$confirm_status);
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('batches_list.htm');

	}

	//批次管理 编辑
	public function batches_edit()
	{
		//model
		$this->load->model('Base_Batches_model');
		$this->load->model('Base_Order_model');

		//批次编辑
		if(!empty($_GET['id']))
		{
			//获取原始数据
			$res = array();
			$res['id']              = $_GET['id'];
			$res['batches_name']    = $_GET['batches_name'];
			$res['userid']          = $_GET['userid'];
			$res['status']          = $_GET['status'];
			$res['tax_status']      = $_GET['tax_status'];
			$res['freight_status']  = $_GET['freight_status'];
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}

		//获取修改数据
		if(!empty($_POST['id']))
		{
			$batches_arr = array();
			if ( $_POST['status'] != 'choose' ) 
			{
				$batches_arr['status'] = $this->input->post('status',true);
				//查询批次状态
				$status_batches = $this->Base_Batches_model->get_batches_info( 'status', array('id' => $_POST['id']) );
				//批次状态与订单状态同步修改
				//通过批次号获取所有订单号
				if ( in_array( $batches_arr['status'] , array( 4,5,6 ) ) ) 
				{
					//判断数据库数据是否已经改变
					if ( $batches_arr['status']-1 == $status_batches['status'] )
					{
						$order_id_arr = $this->Base_Batches_model->batches_list_order( 'id' , array( 'batches_id'=> $_POST['id'] , 'status' => $batches_arr['status']-2 ) );
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
				elseif ( $batches_arr['status'] == 3 )
				{
					//判断数据库数据是否已经改变
					if ( $status_batches['status'] == 2 || $status_batches['status'] == 4 ) 
					{
						$order_id_arr = $this->Base_Batches_model->batches_list_order( 'id' , array( 'batches_id'=> $_POST['id'] ) );
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
						
				$order_status_arr = array();
				foreach ($order_id_arr as $value) 
				{
					$order_status_arr[] = array(
	        			'id'         => $value['id'],
	            		'status' 	 => $this->input->post('status',true)-1
	        		);
				}
				//修改所有订单状态
				$this->Base_Order_model->order_update_batches( $order_status_arr );

			}
			if ( $_POST['tax_status'] != 'choose' ) 
			{
				$batches_arr['tax_status'] = $this->input->post('tax_status',true);
			}
			if ( $_POST['freight_status'] != 'choose' ) 
			{
				$batches_arr['freight_status'] = $this->input->post('freight_status',true);
			}
			
			//有数据修改时，才修改批次
			if ( !empty($batches_arr) )
			{
				$flag = $this->Base_Batches_model->batches_uqdate($batches_arr,array('id' => $this->input->post('id',true)));
			}		       
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
		$this->ci_smarty->display_ini('batches_edit.htm');
	}

	//批次管理 关区选择
	public function batches_customs_choose()
	{
		//model
		$this->load->model('Base_Filing_model');
		$this->load->model('Base_Batches_model');
		$this->load->model('Base_Order_model');
		$this->load->model('Base_Logistics_model');
		$this->load->model('Admin_Spuser_model');

		//批次编辑
		if( !empty($_GET['id']) )
		{
			//通过id 查询原始数据
			$res = $this->Base_Batches_model->get_batches_info( '*', array('id' => $_GET['id']) );
			//通过批次的userid  查询sp_user表中关区 以及税务类型
			$res['customs_type']=$this->Admin_Spuser_model->get_spuser_info('filing_type,filing_kjt_type',array('id'=>$res['userid']));


			//获取国内实际运费模版	
			$where = "`pid`=0";
			$res['template'] = $this->Base_Logistics_model->logistics_list('id,title',$where);

			if ( $res['template_id'] != 0 ) 
			{
				$where_pid = "`pid`=".$res['template_id'];
				$res['template_abroad'] = $this->Base_Logistics_model->logistics_list('id,title',$where_pid);
			}
			
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}

		//获取修改数据
		if(!empty($_POST['id']))
		{
			$id              = $this->input->post('id',true);
			$customs         = $this->input->post('customs',true);
			$tax_type        = $this->input->post('tax_type',true);
			$freight         = $this->input->post('freight_template',true);
			$freight_abroad  = $this->input->post('freight_template_abroad',true);

			$batches_arr = array();
			if ( $customs != 'choose' && $tax_type != 'choose' && $freight != 'choose' && $freight_abroad != 'choose') 
			{
				$batches_arr['customs']  = $customs;
				$batches_arr['tax_type'] = $tax_type;
				$freight_exp = explode('|',$freight);
				$temp_id = $freight_exp[0];
				$batches_arr['template_id']      = $freight_exp[0];
				$batches_arr['freight_template'] = $freight_exp[1];
				$freight_abroad_exp = explode('|',$freight_abroad);
				$temp_id_abroad = $freight_abroad_exp[0];
				$batches_arr['template_abroad_id']      = $freight_abroad_exp[0];
				$batches_arr['freight_template_abroad'] = $freight_abroad_exp[1];

			}

			//查询批次状态
			$status_batches = $this->Base_Batches_model->get_batches_info( 'status', array('id' => $_POST['id']) );

			if (!in_array($status_batches['status'],array(2,3)))
            {
            	$msg = array(
					'msg'  => '操作失败',
					'type' => 1
				);	
				echo json_encode($msg);
				die;
            } 
			//正确提交关区、计税方式、运费模版
			if ( !empty($batches_arr)  )
			{
				//查询该批次下的所有订单（id、省ID、总重）
				$res_order_id = $this->Base_Batches_model->batches_list_order( 'id,province_id,total_weight',array( 'batches_id' => $id ) );

				//通过计税方式判断查询备案价格、税率
				if ( $tax_type == '1' ) 
				{
					$key_price = 'price_par';
					$key_tax   = 'par_tax';
				}
				elseif ( $tax_type == '2' )
				{
					$key_price = 'price_con';
					$key_tax   = 'con_tax';
				}

				//获取运费模版（首重，首重价，续重，续重价，省ID），加入数组
				$freight_temp_con = $this->Base_Logistics_model->get_freight_template_con('default_num,default_price,add_num,add_price,define_cityid', array( 'temp_id' => $temp_id ) );
				$freight_temp_con_abroad = $this->Base_Logistics_model->get_freight_template_con('default_num,default_price,add_num,add_price,define_cityid', array( 'temp_id' => $temp_id_abroad ) );

				//标志 未通过订单数量
				$flag_fail_order = 0;

				//批次总税款
				$tax_total = 0;
				//批次总运费
				$freight_total        = 0;
				$freight_total_abroad = 0;
				
				foreach ( $res_order_id as $value ) 
				{
					//查询订单中的清单
					$res_order_list_info = $this->Base_Order_model->order_list_list( 'id,stock_id,num' , array( 'order_id' => $value['id'] ) );

					//标志 如果商品全部存在备案 订单状态变成‘已审核’ 否则变成‘待审核’
					$flag_filing = -1;
					//订单总价
					$total_price = 0;
					//订单总税价
					$total_rate  = 0;

					$order_arr = array();

					//判断清单中的商品备案是否通过
					foreach ($res_order_list_info as $v) 
					{
						$order_list_arr = array();
						
						//查询商品税率
						$tax = $this->Base_Filing_model->get_stock_info( $key_tax , array( 'id' => $v['stock_id'] ) );
						//查询备案价格
						$row = $this->Base_Filing_model->filing_list_ass( $customs , array( 'id' => $v['stock_id'] ),$key_price );

						$order_list_arr['price'] = $row[$key_price];

						//不为空 备案存在 修改清单表is_filing（是否备案），计算商品单个税价
						if ( $row[$key_price] != 0 ) 
						{
							$order_list_arr['rate']      = round($row[$key_price]*$tax[$key_tax],2) ;
							$order_list_arr['is_filing'] = 1;
						}
						else
						{
							$flag_filing = 1;
							$order_list_arr['rate']      = 0;
							$order_list_arr['is_filing'] = 2;
						}
						
						//导入商品单价，商品税价，是否备案
						$this->Base_Order_model->order_list_update( $order_list_arr , array( 'id' => $v['id'] ) );
						//订单总价等于商品单价乘以数量，累加
						$total_price += $order_list_arr['price']*$v['num'];
						//订单总税价等于商品单个税价乘以数量，累加
						$total_rate  += $order_list_arr['rate']*$v['num'];
						unset($row);
					}
					
					if($tax_type==1)
						$total_rate=$total_rate>50?$total_rate:0;
					
					$order_arr['total_price'] = $total_price;
					
					$order_arr['total_rate']  = $total_rate;


					//批次总税价等于订单总税价累加
					$tax_total += $total_rate;

					//计算运费
					foreach ($freight_temp_con as $v) 
					{
						//通过省ID查询
						if ( in_array( $value['province_id'], $v) ) 
						{
							//订单总运费
							$total_freight = 0;

							//总重是否小于首重
							if ( $value['total_weight'] <= $v['default_num'] ) 
							{
								$total_freight = $v['default_price'];
							}
							else
							{
								//价格= 向上取整（（总重-首重）/续重）*续重价+首重价
								$total_freight = ceil( ($value['total_weight']-$v['default_num'])/$v['add_num'] )*$v['add_price']+$v['default_price'];
							}
						}
					}

					//计算运费(国外)
					foreach ($freight_temp_con_abroad as $v) 
					{
						//通过省ID查询
						if ( in_array( $value['province_id'], $v) ) 
						{
							//订单总运费
							$total_freight_abroad = 0;

							//总重是否小于首重
							if ( $value['total_weight'] <= $v['default_num'] ) 
							{
								$total_freight_abroad = $v['default_price'];
							}
							else
							{
								//价格= 向上取整（（总重-首重）/续重）*续重价+首重价
								$total_freight_abroad = ceil( ($value['total_weight']-$v['default_num'])/$v['add_num'] )*$v['add_price']+$v['default_price'];
							}
						}
					}

					$order_arr['total_freight']         = $total_freight;
					$order_arr['total_freight_abroad']  = $total_freight_abroad;

					//批次运费等于订单运费累加
					$freight_total        += $total_freight;
					$freight_total_abroad += $total_freight_abroad;

					//修改订单状态、总运费 
					if ( $flag_filing == -1 ) 
					{
						$order_arr['status'] = 2;
					}
					elseif ( $flag_filing == 1 ) 
					{
						$order_arr['status'] = 1;
						$flag_fail_order++;
					}
					//修改订单状态、总价、总税、总运费
					$this->Base_Order_model->update_order_info( $order_arr , array( 'id' => $value['id'] ) );
					
					unset($res_order_list_info);
				}
				//修改修改关区、计税方式、运费模版、批次总税价、批次总运费、未通过订单数、批次状态
				$batches_arr['tax_total']             = $tax_total;
				$batches_arr['freight_total']         = $freight_total;
				$batches_arr['freight_total_abroad']  = $freight_total_abroad;
				$batches_arr['fail_order_num']        = $flag_fail_order;
				if ( $flag_fail_order != 0 )
				{
					$batches_arr['status'] = 2;
				}
				else
				{
					$batches_arr['status'] = 3;
				}
				$msg = array(
					'msg'  => var_export($batches_arr,true),
					'type' => 1
				);	
				
				$flag = $this->Base_Batches_model->batches_uqdate( $batches_arr , array( 'id' => $id ) );
			}
	        
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
		$this->ci_smarty->display_ini('batches_customs_choose.htm');
	}

	//批次管理 添加
	public function batches_add()
	{
		//model
		$this->load->model('Base_Batches_model');

		if( !empty($_POST) && $_POST['userid'] != '' )
		{
			$batches_arr = array();
			$batches_arr['userid']       = $this->input->post('userid',true);
			$batches_arr['batches_name'] = $this->input->post('batches_name',true);
			$batches_arr['status']       = 1;
			$flag = $this->Base_Batches_model->batches_add($batches_arr);
			if ($flag == 1) 
    		{
    			$ar_url = array(site_url('batches/batches_add') => '返回');
				usrl_back_msg('添加成功',$ar_url, $this->ci_smarty);
    		}
    		else
    		{
    			$ar_url = array(site_url('batches/batches_add') => '返回');
				usrl_back_msg('添加失败',$ar_url, $this->ci_smarty);
    		}

		}

		$res['supplier'] = $this->Base_Batches_model->get_supplier_info();
		$this->ci_smarty->assign('re',$res);

		//载入页面
		$this->ci_smarty->display_ini('batches_add.htm');
	}


	//订单编辑 添加运单号
	public function batches_add_logistics_no()
	{
		//model
		$this->load->model('Base_Batches_model');
		$this->load->model('Base_Order_model');

		if ( !empty( $_POST['id'] ) ) 
		{
			$batches_id = $_POST['id'];
			//查询批次下的所有订单
			$res_order_arr = $this->Base_Batches_model->batches_list_order( 'id,logistics_type' , array( 'batches_id' => $batches_id ) );
			//统计订单数量
			$order_num = count( $res_order_arr );
			//运单号已经存在的订单数量
			$repeat_num = 0;

			foreach ($res_order_arr as $value) 
			{
				//判断订单是否存在
				if ( $value['logistics_type'] == 1 ) 
				{
					$repeat_num++;
				}
				else
				{
					//运单表查询一条空数据
					$res_ems = $this->Base_Batches_model->get_one_emsno();
					//修改订单信息
					$this->Base_Order_model->update_order_info( array( 'logistics_no'=>$res_ems[0]['ems_no'] , 'logistics_type' => 1 ) , array( 'id' => $value['id'] ) );
					//修改运单信息
					$this->Base_Batches_model->update_emsno( array( 'ems_no' => $res_ems[0]['ems_no'] ) );
				}
			}
			if ( $order_num == $repeat_num ) 
			{
				$msg = array(
					'msg'  => '运单号已经添加',
					'type' => 1
				);	
				echo json_encode($msg);
				die;
			}
			elseif ( $repeat_num == 0 ) 
			{
				$msg = array(
					'msg'  => '有'.$order_num.'个订单成功添加运单号',
					'type' => 2
				);	
				echo json_encode($msg);
				die;
			}
			else
			{
				$msg = array(
					'msg'  => '有'.($order_num-$repeat_num).'个订单成功添加运单号,有'.$repeat_num.'个订单的运单号已经存在',
					'type' => 2
				);	
				echo json_encode($msg);
				die;
			}
		}
	}

	//运费模版选择
	public function freight_template_choose()
	{
		if ( !empty($_POST) && $_POST['freight_template'] != 'choose' ) 
		{
			//model
			$this->load->model('Base_Logistics_model');
			$freight_template = explode( '|', $_POST['freight_template'] );
			$id = $freight_template[0];
			$sel = $this->Base_Logistics_model->get_freight_template( array( 'pid' => $id ) );
			echo json_encode($sel);

		}
	}

}