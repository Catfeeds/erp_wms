<?php
class MY_Controller extends CI_Controller{  
    public function __construct(){  
        parent::__construct();
		ob_clean();
		global $class,$method;  
		$this->class=$class;
		$this->method=$method;
		$this->db = $this->load->database('default', TRUE);
		header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");	
		//$this->benchmark->mark('my_mark_start');
		//http://codeigniter.org.cn/user_guide/database/utilities.html
		//$this->db->cache_on();
		//$query = $this->db->query("SELECT * FROM  ecs_admin_action");
		//$this->db->cache_off();
		
		//$this->db->cache_delete()
		//下面列出的方法是无法在缓存的结果对象上使用的：
		//num_fields()
		//field_names()
		//field_data()
		//free_result()
		//同时，result_id 和 conn_id 这两个 id 也无法使用，因为这两个 id 只适用于实时的数据库操作。
		$this->load->helper("cookie");  
		$this->load->helper("basefunction"); 
		$this->load->helper("url"); 
		
		if(WEB_NAME=='admin'&&$this->method=='act_api')
		{
			$this->user_id=1;
			$this->user='sys';
			$this->user_group_id=1;
			$this->user_type=1;
		}
		elseif(!in_array(WEB_NAME,array('img','api','ueditor')))
		{
			$this->load->model("Base_User_model");//user_model模型类实例化对象
			$this->cur_user=$this->Base_User_model->is_login(720000);//50分钟无任何操作退出
			
			//检测是否登陆，如果登陆，返回登陆用户信息，否则返回false
			if($this->cur_user === false&&$this->method!='login'){  
				header("location:".site_url("user/login"));  
				die;
			}
			else
			{
				if($this->cur_user)
				{
					$this->user_id=get_decode_cookie("user_id");
					$this->user=get_decode_cookie("username");;
					if(WEB_NAME=='admin')
					{	
						$this->user_group_id=$this->get_group_id();
						$this->user_type=get_decode_cookie("user_type");
						if($this->user_type==1)
						{
							//if($this->check_admin()===false)
								//die("无权限");
						}
					}
				}
				else
					$this->user='';
			}
		}
    }
	
	//加载供应商菜单
	public function load_sp_menu()
	{
		//-------------------选中标志-----------------------
		$this->ci_smarty->assign('select_class',strtolower($this->class));	
		$this->ci_smarty->assign('select_method',strtolower($this->method));
		//===================菜单===========================
		//判断断菜单
		$de=$this->db->query("select   addr_id,filing_type,filing_kjt_type  from  ".tab_m('sp_user')."   where   id='".$this->user_id."'  ")->row_array();
		if(!empty($de['addr_id']))
			require(APPPATH.'/config/menu_config_'.WEB_NAME.'_'.$de['addr_id'].'.php');
		else
			require(APPPATH.'/config/menu_config_'.WEB_NAME.'.php');
		//关区类型	
        $this->base_filing_type= $de['filing_type'];
		//交税类型
	    $this->base_filing_kjt_type= $de['filing_kjt_type'];
		$seo_tltie='';
		$flag=false;
		foreach($nva_menu as $k=>$v)
		{
			if(strtolower($v['action'])==strtolower($this->class.'/'.$this->method))
			{
				$seo_tltie=$v['name'];
				$flag=true;
				break;
			}
			
			foreach($v['actions'] as $kk=>$vv)
			{
				if(strtolower($kk)==strtolower($this->class.'/'.$this->method))
				{
					$seo_tltie=$v['name']."|".$vv;
					$flag=true;
					break;
				}
			}
			if($flag==true)
				break;
		}

		//加载菜单
		if(in_array(WEB_NAME,array('seller','sp')))
			$this->ci_smarty->assign('nva_menu',$nva_menu);	
		
		if($flag===false)
		{
			usrl_back_msg('无权操作',array(site_url('sp_index/index')=>'返回'),$this->ci_smarty);
		}
		
		//用户账户
		$this->ci_smarty->assign('admin',$this->user." (".$this->base_filing_type."|".$this->base_filing_kjt_type.')');	
		$this->ci_smarty->assign('seo_tltie',$seo_tltie);	

	}
	
	//检测后台菜单权限
	private function check_admin()
	{
		$this->load->model('Admin_User_model');
		$row=$this->Admin_User_model->get_group_one(array('group_perms'),$this->user_group_id);
		$str=md5(strtolower($this->class.'/'.$this->method));
		if(in_array($str,explode(',',$row['group_perms'])))
			return true;
		else
			return false;
	}
	
	//检测后台菜单权限
	private function  get_group_id()
	{
		$this->load->model('Admin_User_model');
		$row=$this->Admin_User_model->get_user(array('group_id'),$this->user_id);
		return $row['group_id'];
	}
}
?>   