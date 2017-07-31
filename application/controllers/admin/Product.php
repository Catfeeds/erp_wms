<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
	}

	//产品订阅库列表
	public function product_list()
	{
		//***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','is_shop','warehouse_id','countryid');
			//姓名模糊查询字段
			$search_key_ar_more=array('company','cname');

			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and {$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and {$skey} like '%{$v}%'";
				}
				
			}
		}

		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		
		$sql="select  *  from  ".tab_m('stock')."  where  1=1  ".$wsql;
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();

		$res['list']=$query->result_array();
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
            
		$this->load->model('Admin_Country_model');

		require(APPPATH.'/config/base_config.php');
		
		$this->ci_smarty->assign('country',$this->Admin_Country_model->get_show_country());
		$this->ci_smarty->assign('stock_d_status',$config['stock_d_status']);
		$this->ci_smarty->assign('stock_k_status',$config['stock_k_status']);
		//查询结束
		//***************************      
		$this->ci_smarty->display_ini('product_list.htm');   
	}
	
	//编辑内容
	public function product_edit()
	{
		$id = $_GET['id']*1;
		if(!empty($id))
		{
			//平台产品库
			$this->load->model('Admin_Stock_model');
			$de['stock'] = $this->Admin_Stock_model->get_stock('id,warehouse_id,cname,max_num,price,mark_price,mz,rate,brand,gg,countryid,cat_id,is_split,type,gn,cf,con',
				array('id' => $id));
			
			//供应产品
			$this->load->model('Sp_Product_model');
			$de['sp_product'] = $this->Sp_Product_model->get_product('id,out_product_id,out_warehouse_id,name,c_num,online_num,send_num,sell_num,max_num,price,kjt_rate,is_split',
				array('stock_id' => $id));

			//获取商品类别、产地选项
			$this->ci_smarty->assign('res_stock_cat',$this->Sp_Product_model->get_stock_cat());
			$this->load->model('Admin_Country_model');
			$this->ci_smarty->assign('res_country',$this->Admin_Country_model->get_show_country());

			//供应产品详情
			$de['sp_product_content'] = $this->Sp_Product_model->get_product_content('shop_type,shop_addr,gg,mark_price,mz,country,gn,cf',
				$de['sp_product']['id']);

			if($_POST&&!empty($de['stock']))
			{
				$this->load->library('MY_form_validation');
				$this->form_validation->set_rules('cname','产品名称','required'); 
				$this->form_validation->set_rules('country','产地','required');
				$this->form_validation->set_rules('length','长度','required|numeric');
				$this->form_validation->set_rules('width','宽度','required|numeric');
				$this->form_validation->set_rules('height','高度','required|numeric'); 
				$this->form_validation->set_rules('brand','品牌','required');
				$this->form_validation->set_rules('catname','商品类型','required');
				$this->form_validation->set_rules('con','默认详情','required');	
				if ($this->form_validation->run() == FALSE)
				{
					$msg=array(
						'msg'=>validation_errors("<i class='icon-comment-alt'></i> "),
						'type'=>1
					);	
					echo json_encode($msg);
					die;
				}			
				else
				{
				    $falg=$this->Admin_Stock_model->update_stock(
							array(
								'cname'   => $_POST['cname'],
								'countryid' => $countryid,
								'country' => $country,
								'length'  => $_POST['length']*1,
								'width'   => $_POST['width']*1,
								'height'  => $_POST['height']*1,
								'brand'   => $_POST['brand'],
								'cat_id' =>  $cat_id,
								'catname' => $catname,
								'con'     => $_POST['con']						
							)
							,
							array(
								"id" => $id
							)
					);
					
					if($falg === FALSE)
					{		
						$msg=array(
							  'msg'=>"修改失败",
							  'type'=>1
						);
					}
					else
					{
						$msg=array(
							  'msg'=>"修改成功",
							  'type'=>3
						);	
					}
					
					$this->db->trans_off();
					echo json_encode($msg);
					die;
				}
			}
		}
		
		$this->ci_smarty->assign("de",$de);
		
		$this->ci_smarty->display_ini('product_edit.htm');   
	}
	
	//库存调拨
	public function product_stock()
	{
		$this->ci_smarty->display_ini('product_stock.htm');   
	}
	
	//修改订阅状态
	public function product_edit_status()
	{
		$this->load->model('Admin_Stock_model');
		if(!empty($_POST))
		{
			if ($_GET['status'] != 'no') 
			{
				$status_arr = array();
				
				foreach ($_POST['item'] as $k => $v) 
				{
					$status_arr[$k] = array('id' => $v,'status' => ($_GET['status']*1));
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
		if(!empty($status_arr))
		{
			$flag = $this->Admin_Stock_model->update_stock_status($status_arr);
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
		if($flag)
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
	
	
	//修改申请库存状态及禁止销售状态
	public function product_edit_shop_status()
	{
		$this->load->model('Admin_Stock_model');
		if(!empty($_POST))
		{
			if ($_GET['status'] != 'no') 
			{
				$is_shop_arr = array();
				
				foreach ($_POST['item'] as $k => $v) 
				{
					$is_shop_arr[$k] = array('id' => $v,'is_shop' => ($_GET['status']*1));
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
		if(!empty($is_shop_arr))
		{
			$flag = $this->Admin_Stock_model->update_stock_status($is_shop_arr);
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
		if($flag)
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
}




