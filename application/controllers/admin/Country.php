<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Country extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');   
	}
	
	//公共参数管理

	//产地管理 列表
	public function country_list()
	{         
        //model
		$this->load->model('Base_Country_model');

		//搜索
		$key      = array();
		$key_like = array();
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array();
			//模糊字段 搜索
			$search_key_like = array('c_name');
			foreach($_GET as $k => $v)
			{
				$skey = substr($k,7,strlen($k)-7);  
				if($k != 'search_page_num' && substr($k,0,7) == 'search_' && !in_array($v,array('all','')))
				{
					//非模糊字段
					if(in_array($skey,$search_key))
					{
						$key[$skey] = $v;
					}
					//模糊字段
					if(in_array($skey,$search_key_like))
					{
						$key_like[$skey] = $v;
					}	
				}
			}
		}

		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url = site_url($this->class."/".$this->method);
		$search_page_num = array('all'=>15,1=>15,2=>30,3=>50);
		$this->ci_page->listRows =! isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows = $this->Base_Country_model->country_list_rows($key,$key_like);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Country_model->country_list(
			'c_id,c_name,c_flag,c_display,is_destination,is_place_of_delivery',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);

		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('country_list.htm');
 
	}

	//产地管理 修改产地状态
	public function update_country_display()
	{
		//model
		$this->load->model('Base_Country_model');
		
		if ($_POST) 
		{
			$country_arr = array();
			foreach ($_POST as $key => $value) 
			{
				if($value != $_GET['type'])
				{
					$country_arr[$key] = array('c_id' => $key,'c_display' => ($_GET['type']));
				}
			}
			//判断提交数据是否改变
			if(!empty($country_arr))
			{
				$flag = $this->Base_Country_model->update_country_display($country_arr);
				if($flag)
				{
					$msg=array(
						'msg'=>'操作成功',
						'type'=>3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg=array(
						'msg'=>'操作失败',
						'type'=>1
					);
					echo json_encode($msg);
					die;
				}	
			}
			else
			{
				$msg=array(
					'msg'=>'操作成功',
					'type'=>3
				);
				echo json_encode($msg);
				die;
			}
		}
	}

}