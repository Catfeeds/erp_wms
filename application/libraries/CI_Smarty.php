<?php defined('APPPATH') or die('Access restricted!'); 
require(APPPATH . 'libraries/smarty/Smarty.class.php'); 
class CI_Smarty extends Smarty {    
    public function __construct($template_dir = '', $compile_dir = '', $config_dir = '', $cache_dir = '') {      
	parent::__construct();     
    
		if (is_array($template_dir)) {           
		  foreach ($template_dir as $key => $value) {               
		   $this->$key = $value;           
		   }        
		} else {            //ROOT是Codeigniter在入口文件index.php定义的本web应用的根目录    
			  $this->template_dir = $template_dir ? $template_dir :  APPPATH. 'templates/'.WEB_NAME."/";           
			  $this->compile_dir = $compile_dir ? $compile_dir :  APPPATH. 'templates_c/'.WEB_NAME."/";          
			  $this->config_dir = $config_dir ? $config_dir :  APPPATH. 'config';          
			  $this->cache_dir = $cache_dir ? $cache_dir :APPPATH. 'cache/'.WEB_NAME;   
		}   
			  $this-> left_delimiter  = "<{";
			  $this-> right_delimiter = "}>";
			  $this->assign('vsersion','1.20');
   } 
   
   public function display_ini($filename,$flag='',$full_htm=false)
   { 
   	  if(in_array(WEB_NAME,array('seller','sp')))
	  {	
		  //require(APPPATH.'/config/menu_config_'.WEB_NAME.'.php');
		  
		  //$this->assign('nva_menu',$nva_menu);		
	  }
	  $this->assign('output',$filename);
	   $CI = & get_instance();
	   $ar['num']=$CI->db->query_count ;
	   $ar['tim']=$CI->db->benchmark;
	   $this->assign('db_info_msg',$ar);
	   $this->assign('db_info_msg',$ar);
     // echo microtime(true)-RUN_START_TIME;
	  $this->display('html_ini.htm',$flag,$full_htm);

   }
   
}