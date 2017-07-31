<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosend extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
	}

	//队列信息列表
	public function dsend_list()
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
			$search_key_ar_more=array();
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
		$sql="select  *  from  ".tab_m('dosend')."  where  1=1  ".$wsql;
		
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
		$this->ci_smarty->display_ini('dosend_list.htm');   
	}

	//编辑队列信息
	public function dosend_edit()
	{
		$this->load->model('Admin_Dosend_model');
		if(!empty($_POST['id']))
		{
				$dosend_arr = array();
				$dosend_arr['type']   = $this->input->post('type',true);
				$dosend_arr['status'] = $this->input->post('status',true);
				
				$flag = $this->Admin_Dosend_model->dosend_updata($_POST['id'],$dosend_arr);	
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
			$re=$this->Admin_Dosend_model->get_dosend($_GET['id']*1);
			$this->ci_smarty->assign("re",$re);
		}
		$this->ci_smarty->display('dosend_edit.htm');
	}
}




