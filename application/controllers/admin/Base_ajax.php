<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class base_ajax extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
	}
	
	//查询供应商
	public function search_spuser()
	{
		//查询---------
		if(isset($_POST['ajax']))
		{
			$sql="select  company,id  from  ".tab_m('sp_user')."  where  company like '%".$_POST['name']."%' order by id desc limit 10";
			$query=$this->db->query($sql);
			$res=array();
			foreach($query->result_array() as $v)
			{
				$res[]=array('userid'=>$v['id'],'name'=>$v['company']);
			}
			echo json_encode($res);
			die;
		}
		
		$this->ci_smarty->display('ajax_search_spuser.htm'); 
	}

}