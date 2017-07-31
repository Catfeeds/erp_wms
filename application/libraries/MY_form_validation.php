<?php
defined('APPPATH') or die('Access restricted!'); 
$CI = get_instance();
$CI->load->library('Form_validation');
class MY_Form_validation extends CI_Form_validation{  
    public function __construct(){  
        parent::__construct();
	}


    public function check_date($str)
    {

        $data=explode('-',$str);
        if(checkdate($data[1],$data[2],$data[0])){
            return TRUE;
        }else{
            $this->set_message('check_date','%s格式不正确');
            return FALSE;
        }
    }

	

}