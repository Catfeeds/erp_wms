<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Warehouse extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->load->model('Admin_Warehouse_model'); 
	}
	
	//仓库列表
	public function warehouse_list()
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
			$search_key_ar_more=array('sp_uid');
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
		$sql="select  *  from  ".tab_m('stock_warehouse')."  where  1=1  ".$wsql;
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
		$this->ci_smarty->display_ini('warehouse_list.htm');	
	}
	
	//添加或者修改仓库
	public function warehouse_add()
	{     
		
		//判断是否有数据提交
		if (!empty($_POST)) 
		{					
			//表单验证
			$this->load->library('MY_form_validation');		
			$this->form_validation->set_rules('name', '仓库别称', 'required|max_length[50]'); 
			$this->form_validation->set_rules('company', '供应商名称', 'required|max_length[50]');
			$this->form_validation->set_rules('sp_uid', '供应商UID', 'required|max_length[8]');
			$this->form_validation->set_rules('logistics_temp_id', '运费模板ID', 'required');

			$msg='';
			//供应商
			$this->load->model('Sp_User_model'); 
			$row=$this->Sp_User_model->get_user_one(array('company'),$_POST['sp_uid']*1);
			
			if(empty($row))
			{
				$msg="<p><i class='icon-comment-alt'></i> 供应商不存在</p>";
			}
			
			//运费模板
			$this->load->model('Base_Logistics_model');
			$row=$this->Base_Logistics_model->logistics_one($_POST['logistics_temp_id']*1);	
			if(empty($row))
			{
				$msg="<p><i class='icon-comment-alt'></i> 运费模板不存</p>";
			}

			//表单验证，通过进行赋值，不通过提示错误并返回
			if ($this->form_validation->run() == FALSE||!empty($msg))
			{
				$msg=array(
					'msg'=>validation_errors("<i class='icon-comment-alt'></i> ").$msg,
					'type'=>1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				//以数组类型添加或者修改数据库
				$warehouse_arr = array();
				$warehouse_arr['name']             = $this->input->post('name',true);
				$warehouse_arr['hg_name']          = $this->input->post('hg_name',true);
				$warehouse_arr['type']             = isset($_POST['type'])?$_POST['type']*1:1;
				$warehouse_arr['company']          = $this->input->post('company',true);
				$warehouse_arr['sp_uid'] 		   = $_POST['sp_uid']*1;
				$warehouse_arr['out_warehouse_id'] = $_POST['out_warehouse_id']*1;
				
				$warehouse_arr['logistics_temp_id'] = isset($_POST['logistics_temp_id'])?$_POST['logistics_temp_id']*1:0;

				//判断是否存在id，没有进行添加，有进行修改
				if (!empty($_POST['id'])) 
				{					
					$flag = $this->Admin_Warehouse_model->warehouse_updata($_POST['id'],$warehouse_arr);	
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
							'msg'=>'添加失败',
							'type'=>1
						);
						echo json_encode($msg);
						die;
					}									
				}
				else
				{
					$flag = $this->Admin_Warehouse_model->warehouse_add($warehouse_arr);
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
							'msg'=>'添加失败',
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
     		$wa_res = $this->Admin_Warehouse_model->get_warehouse($_GET['id']);
     		$this->ci_smarty->assign('wa_res',$wa_res);
		}

		//防止csrf攻击
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->ci_smarty->assign('csrf',$csrf);
		$this->ci_smarty->display_ini('warehouse_add.htm'); 
	}
	
}