<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Cat extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
	}
	

	//商品类型列表
	public function cat_list()
	{         
		//model
		$this->load->model('Base_Cat_model');

		//搜索
		$key      = array();
		$key_like = array();
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array();
			//模糊字段 搜索
			$search_key_like = array();
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
			$this->ci_page->totalRows = $this->Base_Cat_model->cat_list_rows($key,$key_like);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Cat_model->cat_list(
			'id,cat',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);

		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('cat_list.htm');
 
	}

	//商品类型 添加 或 编辑
	public function cat_add_or_edit()
	{
		if (!empty($_POST) && !empty($_POST)) 
		{
			//model
			$this->load->model('Base_Cat_model');

			//表单验证
			$this->load->library('MY_form_validation');		
			$this->form_validation->set_rules('cat', '分类名', 'required'); 
			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				//查询分类名是否重复
				if($this->Base_Cat_model->check_is_repeat(array('cat' => $this->input->post('cat',true))))
				{
					$cat_arr = array();
					$cat_arr['cat'] = $this->input->post('cat',true);
					//判断 添加 或者 编辑
					if (!empty($_POST['id'])) 
					{									
						$flag = $this->Base_Cat_model->cat_update($cat_arr,array('id' => $_POST['id']));	
						if($flag == 1)
						{
							$msg = array(
								'msg'  => "操作成功",
								'type' => 3
							);
							echo json_encode($msg);
					  	    die;
						}
						else
						{
							$msg = array(
								'msg'  => '更新失败',
								'type' => 1
							);	
							echo json_encode($msg);
							die;
						}									
					}
					else
					{
						$flag = $this->Base_Cat_model->cat_add($cat_arr);
						if($flag == 1)
						{
							$msg=array(
								'msg'  => "操作成功",
								'type' => 3
							);
							echo json_encode($msg);
					  	    die;
						}
						else
						{
							$msg = array(
								'msg'  => '添加失败',
								'type' => 1
							);
							echo json_encode($msg);
							die;
						}
					}
				}
				else
				{
					$msg = array(
						'msg'  => '分类名称已存在',
						'type' => 1
					);
					echo json_encode($msg);
					die;	
				}	
			}
		}

		//编辑操作时 返回表中原始数据
		if (!empty($_GET['id'])) 
		{     		
     		//model
			$this->load->model('Base_Cat_model');
			$this->ci_smarty->assign('re',$this->Base_Cat_model->get_cat('id,cat',array('id' => $_GET['id'])));
		}



		//载入页面
		$this->ci_smarty->display_ini('cat_add.htm');

	}

}