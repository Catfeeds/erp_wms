<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sp_index extends MY_Controller {

	public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->load_sp_menu();				
	}
	
	//菜单
	public function index()
	{
		
		$this->ci_smarty->display_ini('info.htm');   
	}

	//错误提示页面  sp_index/sp_msg
	public function sp_msg()
	{
		$this->ci_smarty->display('sp_msg.htm');
	}

}
