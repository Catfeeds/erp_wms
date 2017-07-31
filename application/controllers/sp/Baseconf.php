<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baseconf extends MY_Controller {

	public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->load_sp_menu();
		$this->load->model('Base_Logistics_model');				
	}
	
	public function logistics_company()
	{
		
		$this->ci_smarty->assign('company',$this->Base_Logistics_model->logccom_list());
		//显示页面
		$this->ci_smarty->display_ini('logistics_company.htm');   
	}
	
	public function logistics_list()
	{
		//获取登录id
		$sp_uid = $this->user_id;
		//通过登录id获取所有仓库名
		$this->ci_smarty->assign('warehouse',$this->Base_Logistics_model->get_warehouse_name($sp_uid));
		//通过仓库查询运费模版
		if (!empty($_GET['warehouse'])) {
			if ($_GET['warehouse'] != 'all') {
				$temp_id = $_GET['warehouse'];
				$this->ci_smarty->assign('logistics_temp',$this->Base_Logistics_model->get_logistics_temp($temp_id));
			}
		}
		//显示页面
		$this->ci_smarty->display_ini('logistics_list.htm');   
	}

}
