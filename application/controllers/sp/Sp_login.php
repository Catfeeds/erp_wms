<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sp_login extends MY_Controller {
   
    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		  
	}
	
	public function index()
	{

	}

	public function login()
	{
		$data=array(
			 'name'=> $this->input->post('name'),
			 'age'=> $this->input->post('age'),
			 'sex'=> $this->input->post('sex')
        );
        $this->db->insert('users', $data);
	    $this->ci_smarty->assign('test', 'smarty');            
		$this->ci_smarty->display('login.htm');   
		//$this->load->view(WEB_NAME.'/login');
	}
}
