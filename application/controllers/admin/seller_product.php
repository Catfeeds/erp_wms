<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Seller_product extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		//$this->load->model('Admin_Seller_user_model'); 
	}
	
	//订阅产品列表
	public function seller_product_list()
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
			$search_key_ar_more=array('id','stock_id');
			//关联表模糊查询字段
			$search_key_ar_re=array('cname');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);  
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and a.{$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and a.{$skey} like '%{$v}%'";
					//关联表模糊查询
					if(in_array($skey,$search_key_ar_re))
						$wsql.=" and b.{$skey} like '%{$v}%'";	
				}
			}
		}
		
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  a.*,b.warehouse_id,b.cname,b.brand,b.is_shop,b.rate,b.is_shop,(b.price-b.cb_price) as s_price  
		      from  ".tab_m('seller_product')." as  a  
		      left join  ".tab_m('stock')."  as   b  on a.stock_id=b.id    where  1=1  ".$wsql;
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		foreach($query->result_array() as $v)
		{
			$res['list'][]=$v;
		}

		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('seller_product_list.htm');	
	}

	//分销库存日志
	public function seller_product_log()
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
			$search_key_ar=array('type','status');
			//姓名模糊查询字段
			$search_key_ar_more=array('seller_product_id','order_id');
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
		$sql="select  *  from  ".tab_m('seller_product_log')."  where  1=1  ".$wsql;
		
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" order by id desc limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		$res['list']=$query->result_array();
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('seller_product_log.htm');	
	}
	
	//审核上架
	public function seller_product_check()
	{
		$id=$_GET['id']*1;
		if(!empty($id))
		{
			//分销表
			$this->load->model('Seller_product_model');
			$de['seller_product']=$this->Seller_product_model
							->get_product_detail("c_num,online_num,sell_num
							,stock_id,mark_price,price,userid,status",array('id'=>$id));
				
			//平台产品库
			$this->load->model('Admin_Stock_model');
			$de['stock']=$this->Admin_Stock_model->get_stock("cname,barcode,gn,cf,gg,desc,warehouse_id,id,cb_price,mark_price,price,mz,jz,is_shop,rate"
						  ,array('id'=>$de['seller_product']['stock_id']));

			if($_POST&&!empty($de['seller_product']))
			{
				$this->load->library('MY_form_validation');
				$this->form_validation->set_rules('price', '分销价格', 'required|numeric'); 
				$this->form_validation->set_rules('mark_price', '市场价格', 'required|numeric');
				$this->form_validation->set_rules('status', '上架状态', 'required|in_list[1,0]');
				$this->form_validation->set_rules('con', '审核描述', 'max_length[50]');
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
					if($_POST['price']<$de['stock']['price'])
					{				
						$msg=array(
								'msg'=>"分销价格不能小于平台定价",
								'type'=>1
							 );	
						 echo json_encode($msg);
						 die;
					}
					

				    $this->Seller_product_model->update_product(
							array(
								"price"=>$_POST['price']*1,
								"mark_price"=>$_POST['mark_price']*1,
								"status"=>$_POST['status']*1,
							)
							,
							array(
								"id"=>$id
							)
					);
				    $this->Seller_product_model->add_product_log(
							array(
								"type"=>3,
								"seller_product_id"=>$id,
								"userid"=>$de['seller_product']['userid'],
								"stock_id"=>$de['seller_product']['stock_id'],
								"name"=>$de['stock']['cname'],
								"price"=>$_POST['price']*1,
								"con"=>"定价:".$_POST['price']." ".($_POST['status']==1?"上架":"下架"),
								"status"=>1,
								"adm"=>$this->user_id
							)
					);

					$msg=array(
								'msg'=>"修改成功",
								'type'=>3
							 );	

					echo json_encode($msg);
					die;
				}
			}							
			if(!empty($de['sp_product']['id']))	
			{						
				$d=$this->Sp_Product_model->get_product_content("mark_price",$de['sp_product']['id']);	
				if(!empty($d))
					$de['sp_product']=array_merge($de['sp_product'],$d);						
			}
			
			//供应产品
			$this->load->model('Sp_Product_model');
			$de['sp_product']=$this->Sp_Product_model->get_product("out_warehouse_id,send_num,max_num,id,out_product_id,c_num,online_num,sell_num,price",
										array('stock_id'=>$de['seller_product']['stock_id']));
			//仓库地址
			$this->load->model('Admin_Warehouse_model');
			$de['warehouse']=$this->Admin_Warehouse_model->get_warehouse($de['stock']['warehouse_id'],"hg_name,type");
		
		}
		else
			$de=array();
			
		$this->ci_smarty->assign("de",$de);
		$this->ci_smarty->display_ini('seller_product_check.htm');	
	}
	
	//审核库存
	public function seller_product_stock_check()
	{
		$id=$_GET['id']*1;
		$this->load->model('Seller_product_model');
		$de=$this->Seller_product_model->get_product_log("num,seller_product_id,stock_id,status",array('id'=>$id));

		if(!empty($de))
		{	
			if(isset($_POST['num'])&&isset($_POST['status']))
			{
				
				$num=$_POST['num']*1;//更新数量
				if($num<=0||$_POST['status']<0)
				{
					$con="审核描述:".$_POST['con'];	
					$this->db->query("update ".tab_m('seller_product_log')." set  
									status='-1'
									,uptime='".date("Y-m-d H:i:s")."'
									,con='".mysql_escape_string($con)."' 
									where   id='".$id."' and  status=0 ");
									
					$this->db->query("update ".tab_m('seller_product')." set  sq_status='1'  where   id='".$de['seller_product_id']."' ");
					$msg=array('msg'=>"提交成功",'type'=>3);	
					echo json_encode($msg);
					die;			 
				}
				else
				{
				
					//行更新锁	
					$row=$this->db->query("select  c_num,online_num  from  ".tab_m('sp_product')."  where  stock_id='"
							.$de['stock_id']."'  limit 1 FOR UPDATE")->result_array();	
							
					//行更新锁		
				   	$log=$this->db->query("select  status,num  from  ".tab_m('seller_product_log')
							."  where  id='".$id."'  limit 1  FOR UPDATE")->result_array();	

					if($row[0]['c_num']-$row[0]['online_num']>=$num&&$log[0]['status']==0)	
					{	 
					    $this->db->query("update  ".tab_m('sp_product')."   set  online_num=online_num+{$num}   
										  where stock_id='$de[stock_id]' limit 1 ");
										 
						$this->db->query("update  ".tab_m('seller_product')."   set  c_num=c_num+{$num},sq_status='1'   
										  where id='$de[seller_product_id]' limit 1  ");	 
						$con="实际申请".$log[0]['num'].",通过获取 ".$num;
						if(!empty($_POST['con']))
							$con.=",审核描述:".$_POST['con'];	
										 
						$this->db->query("update  ".tab_m('seller_product_log')."   set  num='".$num."'
										 ,con='".mysql_escape_string($con)."',status=1
										 ,adm='".$this->user_id."'
										 ,uptime='".date("Y-m-d H:i:s")."'
										 where  id='$id'  ");
					}

					$msg=array(
								'msg'=>"修改成功",
								'type'=>3
							 );	
					$this->db->trans_off();
					echo json_encode($msg);
					die;
				}
			}

			//分销表
			$this->load->model('Seller_product_model');
			$de['seller_product']=$this->Seller_product_model
							->get_product_detail("c_num,online_num,sell_num
							,stock_id,mark_price,price,userid,status",array('id'=>$de['seller_product_id']));
				
			//平台产品库
			$this->load->model('Admin_Stock_model');
			$de['stock']=$this->Admin_Stock_model->get_stock("cname,barcode,gn,cf,gg,desc,warehouse_id,id,cb_price,mark_price,price,mz,jz,is_shop,rate"
						  ,array('id'=>$de['seller_product']['stock_id']));
			
			
			//供应产品
			$this->load->model('Sp_Product_model');
			$de['sp_product']=$this->Sp_Product_model->get_product("out_warehouse_id,send_num,max_num,id,status
								   ,out_product_id,c_num,online_num,sell_num,price",
										array('stock_id'=>$de['seller_product']['stock_id']));
										
			//仓库地址
			$this->load->model('Admin_Warehouse_model');
			$de['warehouse']=$this->Admin_Warehouse_model->get_warehouse($de['stock']['warehouse_id'],"hg_name,type");
						  
		}
		
		$this->ci_smarty->assign('de',$de);
		$this->ci_smarty->display_ini('seller_log_check_stock.htm');	
	}
	
	//审核库存
	public function seller_product_check_gc()
	{
		


	}
}