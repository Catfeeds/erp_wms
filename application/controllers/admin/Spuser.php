<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Spuser extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
	}

	//接口列表
	public function spuser_openapi()
	{
		$this->load->model('Admin_Spapi_model');
		if(empty($_GET['id'])&&empty($_POST['id']))
		{
			$de=$this->Admin_Spapi_model->get_api_list();
			$this->ci_smarty->assign("re",$de);
			$this->ci_smarty->display_ini('spuser_openapi_list.htm');   	
		}
		else
		{
			if(!empty($_POST['id']))
			{
				$openapi_arr = array();
				$openapi_arr['get_product_num_status']  = $this->input->post('get_product_num_status',true);
				$openapi_arr['get_product_desc_status'] = $this->input->post('get_product_desc_status',true);
				$openapi_arr['get_order_status']        = $this->input->post('get_order_status',true);
				$openapi_arr['send_order_status']       = $this->input->post('send_order_status',true);
				$flag = $this->Admin_Spapi_model->openapi_updata($_POST['id'],$openapi_arr);	
				if($flag===true)
				{
					//关闭窗口刷新页面	
					$msg=array(
						'msg'=>"操作成功",
						'type'=>3
					);
					echo json_encode($msg);
			  	    die;
				}
				else
				{
					$msg=array(
						'msg'=>validation_errors("<i class='icon-comment-alt'></i> ").$str_msg,
						'type'=>1
					);	
					echo json_encode($msg);
					die;
				}									
			}
			else
			{
				$sp=$this->Admin_Spapi_model->get_api_one($_GET['id']*1);
				$this->ci_smarty->assign("sp",$sp);
			}
			$this->ci_smarty->display_ini('spuser_openapi_edit.htm');  
		}
	}
	
	//审核供应产品
	public function spuser_product_check()
	{
		$this->load->model('Sp_Product_model');
		$de=$this->Sp_Product_model->get_product("id,out_warehouse_id,stock_id,name
				,barcode,userid,c_num,online_num,send_num,sell_num
				,price,kjt_rate, out_product_id,is_split,max_num,status",$_GET['id']);
				
		$de['pro']=$this->Sp_Product_model->get_product_content("product_sp_id,name,desc,brand,catname,cat_id,country,countryid,length, width,height,barcode,mark_price, cf,gn,type,mz,jz,gg,con, shop_addr,shop_type",$_GET['id']);		
		
		$this->ci_smarty->assign('de',$de);
		$this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
		$this->ci_smarty->display_ini('spuser_product_check.htm');  
	}
	
	//批量审核
	public function spuser_product_check_list()
	{
		$this->load->model('Admin_Stock_model');
		$this->load->model('Sp_Product_model');	
		$this->load->model('Seller_product_model');	
		
		$query=$this->db->query("select  `id`, `stock_id`, `name`, `barcode`, `userid`, `c_num`
		                        ,`online_num`, `send_num`, `sell_num`, `price`,`status`
		                        from  ".tab_m('sp_product')."  where id in(".$_GET['ids'].") ");				
			
		if(isset($_POST['item'])&&is_array($_POST['item']))
		{
			$up_num=0;
			foreach($query->result_array() as  $k=>$v)
			{
				if($_POST['status'][$v['id']]==1)
				{
					$pro=$this->Sp_Product_model->get_product_content("product_sp_id,name,desc,brand,catname
									,cat_id,country,countryid,length,
									width,height,barcode,mark_price,
									cf,gn,type,mz,jz,gg,con,shop_addr,shop_type",$v['id']);	
				   $ar=array();
				   $ar['warehouse_id']=$_POST['warehouse_id'][$v['id']];  //
				   $ar['cname']=mysql_escape_string($v['name']);
				   $ar['ename']= ''; 
				   $ar['desc']= ''; 
				   $ar['brand']=$pro['brand']; 
				   $ar['catname']=$pro['catname']; 
				   $ar['cat_id']=$pro['cat_id']; 
				   $ar['country']=$pro['country']; 
				   $ar['countryid']=$pro['countryid']; 
				   $ar['length']=$pro['length']*1; 
				   $ar['width']=$pro['width']*1; 
				   $ar['height']=$pro['height']*1; 
				   $ar['barcode']=$pro['barcode']; 
				   $ar['mark_price']=$pro['mark_price']*1; 
				   $ar['cb_price']=0; 
				   $ar['price']=$_POST['item'][$v['id']]*1;
				   $ar['cf']=$pro['cf']; 
				   $ar['gn']= $pro['gn']; 
				   $ar['type']= $pro['type']; 
				   $ar['mz']=$pro['mz']*1; 
				   $ar['jz']=$pro['jz']*1;
				   $ar['gg']=$pro['gg'];
				   $ar['is_split']=$v['is_split'];
				   $ar['con']=$pro['con'];
				   $ar['status']='1'; 
				   $ar['is_shop']='1'; 
					//未绑定入库
					if(empty($v['stock_id']))
					{
						 $id=$this->Admin_Stock_model->add_stock($ar);
						 if(!empty($id))
						 {
							$this->Sp_Product_model->update_product(array('stock_id'=>$id,'status'=>1,'c_num'=>$_POST['num'][$v['id']]*1),array('id'=>$v['id']));
							$up_num++;
						 }
						 unset($ar);
					}
					else
					{
						$this->Sp_Product_model->update_product(array('status'=>1,'c_num'=>$_POST['num'][$v['id']]*1),array('id'=>$v['id']));
						$this->Admin_Stock_model->update_stock($ar,array('id'=>$v['stock_id']));	
					}
					$this->Seller_product_model->update_product(array('status'=>1),array('stock_id'=>$v['stock_id']));
				}
				else
				{
					//下架
					$this->Sp_Product_model->update_product(array('status'=>0),array('id'=>$v['id']));
					//停止销售
					$this->Admin_Stock_model->update_stock(array('status'=>0,'is_shop'=>-1),array('id'=>$v['stock_id']));
					//下架
					$this->Seller_product_model->update_product(array('status'=>0),array('stock_id'=>$v['stock_id']));
				}
					
			}
			//关闭窗口刷新页面	
			$msg=array(
				'msg'=>"成功更新 (".$up_num.") 条数据 ",
				'type'=>3
			);
			echo json_encode($msg);
			die;
		}						
		$re=array();
		foreach($query->result_array() as  $k=>$v)
		{   
			$pro=$this->Sp_Product_model->get_product_content("gg",$v['id']);	
			$v['gg']=$pro['gg'];
			$v['stock']=$this->db->query("select  price  from  ".tab_m('stock')."  
			                   where id='$v[stock_id]' limit 1 ")->row_array();				   
			$re[$k]=$v;
		}
		$this->ci_smarty->assign('re',$re);
		$this->ci_smarty->display('spuser_product_check_list.htm');  
	}

	//供应商列表
	public function spuser_list()
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
			$search_key_ar=array('status');
			//姓名模糊查询字段
			$search_key_ar_more=array('user','company');
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
		$sql="select  *  from  ".tab_m('sp_user')."  where  1=1  ".$wsql;
		
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
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('spuser_list.htm');
	}
	
	//添加或者修改供应商
	public function spuser_add()
	{
		$this->load->model('Admin_Spuser_model');				
		//判断是否有数据提交
		if (!empty($_POST)) 
		{					
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('user', '用户帐号', 'required|min_length[4]'); 
			$this->form_validation->set_rules('mobile', '手机号码', 'required|exact_length[11]');
			$this->form_validation->set_rules('company', '公司名称', 'required|min_length[2]');			
			
			//id存在可以不验证user_pwd,act_pwd
			if (!empty($_POST['id'])) 
			{
				if(!empty($_POST['user_pwd']))
					$this->form_validation->set_rules('user_pwd', '用户密码', 'required|min_length[6]');
				if(!empty($_POST['act_pwd']))
					$this->form_validation->set_rules('act_pwd', '操作密码', 'required|min_length[6]');
			}
			else
			{
				$this->form_validation->set_rules('user_pwd', '用户密码', 'required|min_length[6]');
				$this->form_validation->set_rules('act_pwd', '操作密码', 'required|min_length[6]');
			}	

			//表单验证，通过进行赋值，不通过提示错误并返回
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
				//以数组类型添加或者修改数据库
				$spuser_arr = array();
				$spuser_arr['mobile']   = $this->input->post('mobile',true);
				$spuser_arr['company']  = $this->input->post('company',true);
				
				//判断user_pwd，act_pass，status是否存在，存在就修改
				if(!empty($_POST['id']))
				{
					if (!empty($_POST['user_pwd'])) 
					{
						$spuser_arr['pass']     = md5($this->input->post('user_pwd',true));
					}

					if (!empty($_POST['act_pwd'])) 
					{
						$spuser_arr['act_pass'] = md5($this->input->post('act_pwd',true));
					}

					if (isset($_POST['status'])) 
					{
						$spuser_arr['status']   = $this->input->post('status',true);
					}			
				}
				else
				{
					$spuser_arr['user']      = $this->input->post('user',true);
					$spuser_arr['pass']      = md5($this->input->post('user_pwd',true));
					$spuser_arr['act_pass']  = md5($this->input->post('act_pwd',true));
					$spuser_arr['addtime']   = date('y-m-d h:i:s');
					$spuser_arr['status']    = 1;
				}

				//判断是否存在id，没有进行添加，有进行修改
				if (!empty($_POST['id'])) 
				{									
					$flag = $this->Admin_Spuser_model->spuser_updata($_POST['id'],$spuser_arr);	
					if($flag===true)
					{
						//关闭窗口刷新页面	
						//$this->ci_smarty->assign('close_msg',1);
						$msg=array(
							'msg'=>"操作成功",
							'type'=>3
						);
						echo json_encode($msg);
				  	    die;
					}
					else
					{
						$msg=array(
							'msg'=>validation_errors("<i class='icon-comment-alt'></i> ").$str_msg,
							'type'=>1
						);	
						echo json_encode($msg);
						die;
					}									
				}
				else
				{
					
					$flag = $this->Admin_Spuser_model->spuser_add($spuser_arr);
					if($flag===true)
					{
						$msg=array(
							'msg'=>"操作成功",
							'type'=>2
						);
						echo json_encode($msg);
				  	    die;
					}
					else
					{
						$msg=array(
							'msg'=>validation_errors("<i class='icon-comment-alt'></i> ").$str_msg,
							'type'=>1
						);	
						echo json_encode($msg);
						die;
					}
				}
				usrl_back_msg($str_msg,$url_ar,$this->ci_smarty);
			}		
		}

		//判断是否存在id，没有进行添加，有进行修改
		if (!empty($_GET['id'])) 
		{     		
     		$this->ci_smarty->assign('sp_res',$this->Admin_Spuser_model->get_spuser($_GET['id']));
		}

		//防止csrf攻击
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->ci_smarty->assign('csrf',$csrf);
		
		//加载页面
		$this->ci_smarty->display_ini('spuser_add.htm');
	}

	//供应商品列表
	public function spuser_product()
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
			$search_key_ar=array('status');
			//姓名模糊查询字段
			$search_key_ar_more=array('user','company');
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
		$sql="select  *  from  ".tab_m('sp_product')."  where  1=1  ".$wsql;
		
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
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('spuser_product.htm');
	}
}