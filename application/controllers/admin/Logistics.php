<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logistics extends MY_Controller {
    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->load->model('Base_Logistics_model');
	}

	//商户运费模版
	public function logistics_list()
	{
		$where = "`pid`!=0";
		$de=$this->Base_Logistics_model->logistics_list('*',$where);	
		$this->ci_smarty->assign("re",$de);
		//跳转页面
		$this->ci_smarty->display_ini('logistics_list.htm');   
	}
	
	//国内实际运费
	public function logistics_list_s()
	{
		$where = "`pid`=0";
		$de=$this->Base_Logistics_model->logistics_list('*',$where);	
		$this->ci_smarty->assign("re",$de);
		//跳转页面
		$this->ci_smarty->display_ini('logistics_list_s.htm');   
	}

	//添加运费模板
	public function logistics_add()
	{
		//城市表 返回城市id和name
        //添加到第一个表
        if(!empty($_POST))
        {
	        $logistics_arr1 = array();
			$logistics_arr1['title']   = $this->input->post('title',true);

			if ( !empty( $_POST['pid'] ) )
			{
				$logistics_arr1['pid']   = $this->input->post('pid',true);
			}

			$logistics_arr1['uptime']  = date('Y-m-d h:i:s');
			$_POST['id']*=1;

			//添加到表dferp_logistics_temp中

			//error_log(var_export($_POST,true),3,APPPATH.'/cache/1.log');
			//die;
			if(empty($_POST['id']))
			{
				$flag=$this->Base_Logistics_model->logistics_add($logistics_arr1);
				if(empty($flag))
				{		
					
					$msg=array(
						'msg'=>"操作失败",
						'type'=>1
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg=array(
						'msg'=>"操作成功",
						'type'=>3
					);
					echo json_encode($msg);
					die;
				}
			}
			else
			{
				
				$flag=$this->Base_Logistics_model->logistics_edit($logistics_arr1,$_POST['id']);
				if(empty($flag))
				{		
					$msg=array(
						'msg'=>"操作失败",
						'type'=>1
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					//关闭窗口刷新页面	
					//$this->ci_smarty->assign('close_msg',1);
					$msg=array(
						'msg'=>"操作成功",
						'type'=>3
					);
					echo json_encode($msg);
					die;
				}
			}
		}
		
		if(!empty($_GET['id']))
		{
			$de=$this->Base_Logistics_model->logistics_one($_GET['id']);
			$this->ci_smarty->assign('de',$de); 
			//更新
			$logistics_temp_con = $this->Base_Logistics_model->get_logistics_temp_con($_GET['id']);
			if(!empty($logistics_temp_con))
			{
				$this->ci_smarty->assign('logistics_temp_con',$logistics_temp_con); 
			}
			else
			{
				$this->load->model('Base_District_model');	
				$district = $this->Base_District_model->get_district('id,name',0);
				$this->ci_smarty->assign('district',$district); 
			}	
		}
		else
		{
			$this->load->model('Base_District_model');
			//添加	
			$district = $this->Base_District_model->get_district('id,name',0);
			$this->ci_smarty->assign('district',$district); 
		}
		if( !empty( $_GET['index'] ) )
		{
			$res['index'] = $_GET['index'];
		}
		//获取国内实际运费模版	
		$where = "`pid`=0";
		$res['logistics_temp'] = $this->Base_Logistics_model->logistics_list('id,title',$where);
		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		$this->ci_smarty->display_ini('logistics_add.htm');   
	}

	//发货地址 列表
	public function fedex_user()
	{
		//搜索
		$wsql='';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar      = array('country_id');
			//姓名模糊查询字段
			$search_key_ar_more = array();
			foreach ( $_GET as $k=>$v )
			{
				$skey = substr($k,7,strlen($k)-7);  
				
				if ( $k != 'search_page_num' && substr($k,0,7) == 'search_' && !in_array( $v , array('all','') ) )
				{
					//非模糊查询
					if ( in_array( $skey , $search_key_ar ) )
						$wsql .= " AND {$skey}='{$v}'";
					//模糊查询
					if ( in_array( $skey , $search_key_ar_more ) )
						$wsql .= " AND {$skey} like '%{$v}%'";	
				}
			}
		}
		
		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url = site_url($this->class."/".$this->method);
		$search_page_num = array('all'=>15,1=>15,2=>30,3=>50);
		$this->ci_page->listRows = !isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql = "SELECT * FROM ".tab_m('fedex_user')." WHERE 1=1 ".$wsql;
		if ( !$this->ci_page->__get('totalRows') )
		{
			$query = $this->db->query($sql);
			$this->ci_page->totalRows = $query->num_rows;
		}
		
		//列表查询
		$sql .= "ORDER BY `id` DESC LIMIT ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query = $this->db->query( $sql );
		
		//返回前台数据
		$res=array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $query->result_array();
		$sql="SELECT * FROM ".tab_m('country')." WHERE `c_display`=0 ";
		$res['country']=$this->db->query($sql)->result_array();
		$this->ci_smarty->assign('re',$res,1,'page');	

		//跳转页面
		$this->ci_smarty->display_ini('fedex_user.htm');
	}

	//发货地址 添加
	public function fedex_user_add()
	{
		if ( !empty( $_POST ) )
		{
			//model
			$this->load->model('Base_Logistics_model');

			//表单验证
			$this->load->library('MY_form_validation');	
			$this->form_validation->set_rules('type', '所属类型', 'required'); 	
			$this->form_validation->set_rules('personName', '真实姓名', 'required');
			$this->form_validation->set_rules('companyName', '公司', 'required'); 
			$this->form_validation->set_rules('phoneNumber', '电话号码', 'required'); 
			$this->form_validation->set_rules('Address_streetLines', '地址', 'required'); 
			$this->form_validation->set_rules('Address_City', '城市', 'required'); 
			$this->form_validation->set_rules('Address_StateOrProvinceCode', '城市缩写', 'required'); 
			$this->form_validation->set_rules('Address_PostalCode', '邮政编码', 'required');
			$this->form_validation->set_rules('account', 'account', 'required');
			$this->form_validation->set_rules('Address_CountryCode', '国家编码缩写', 'required'); 
			$this->form_validation->set_rules('Address_Residential', '是否是居民区', 'required');

			$this->form_validation->set_rules('fedex_account', 'FedEx对接账号', 'required');


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
				$fedex_user_arr = array();	
				$fedex_user_arr['type']                        = $this->input->post('type',true);			
    			$fedex_user_arr['personName']                  = $this->input->post('personName',true);			
				$fedex_user_arr['companyName']                 = $this->input->post('companyName',true);
				$fedex_user_arr['phoneNumber']                 = $this->input->post('phoneNumber',true);
				$fedex_user_arr['Address_streetLines']         = $this->input->post('Address_streetLines',true);
				$fedex_user_arr['Address_City']                = $this->input->post('Address_City',true);
				$fedex_user_arr['Address_StateOrProvinceCode'] = $this->input->post('Address_StateOrProvinceCode',true);
				$fedex_user_arr['Address_PostalCode']          = $this->input->post('Address_PostalCode',true);
				$fedex_user_arr['account']          = $this->input->post('account',true);


				$address=explode('|',$this->input->post('Address_CountryCode',true));

				$fedex_user_arr['Address_CountryCode']         = $address[0];
				$fedex_user_arr['Address_Country']			   = $address[1];
				$fedex_user_arr['country_id']			   	   = $address[2];
				$fedex_user_arr['Address_Residential']         = $this->input->post('Address_Residential',true);
				$fedex_user_arr['fedex_account']         = $this->input->post('fedex_account',true);
        		$flag = $this->Base_Logistics_model->add_fedex_user( $fedex_user_arr );
        		if( $flag )
				{
					$msg = array(
						'msg'  => '操作成功',
						'type' => 3
					);
					echo json_encode($msg);
			  	    die;
				}
				else
				{
					$msg = array(
						'msg'  => '操作失败',
						'type' => 1
					);	
					echo json_encode($msg);
					die;
				}
				
			}	
		}
		//加载fedex国家
		$this->load->model('Base_Logistics_model');

		$country=$this->Base_Logistics_model->get_fedex_country();

		$sql="SELECT * FROM ".tab_m('fedex_account');

		$account=$this->db->query($sql)->result_array();

		$this->ci_smarty->assign('country',$country);
		$this->ci_smarty->assign('account',$account);


		//跳转页面
		$this->ci_smarty->display_ini('fedex_user_add.htm');	
	}

	//发货地址 编辑
	public function fedex_user_edit()
	{
		//model
		$this->load->model('Base_Logistics_model');

		if ( !empty( $_GET['id'] ) )
		{
			$res = $this->Base_Logistics_model->get_fedex_user_info( '*' , array( 'id' => $_GET['id'] ) );
			$this->load->model('Base_Logistics_model');

			$country=$this->Base_Logistics_model->get_fedex_country();
			$this->ci_smarty->assign('country',$country);
			
			$this->ci_smarty->assign('re',$res,1,'page');
		}

		if ( !empty( $_POST['id'] ) )
		{
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('type', '所属类型', 'required'); 
			$this->form_validation->set_rules('personName', '真实姓名', 'required'); 
			$this->form_validation->set_rules('companyName', '公司', 'required'); 
			$this->form_validation->set_rules('phoneNumber', '电话号码', 'required'); 
			$this->form_validation->set_rules('Address_streetLines', '地址', 'required'); 
			$this->form_validation->set_rules('Address_City', '城市', 'required'); 
			$this->form_validation->set_rules('Address_StateOrProvinceCode', '城市缩写', 'required'); 
			$this->form_validation->set_rules('Address_PostalCode', '邮政编码', 'required'); 
			$this->form_validation->set_rules('account', 'account', 'required');
			$this->form_validation->set_rules('Address_CountryCode', '国家编码缩写', 'required'); 
			$this->form_validation->set_rules('Address_Residential', '是否是居民区', 'required'); 
			
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
    			$fedex_user_arr = array();
				$fedex_user_arr['type']                        = $this->input->post('type',true);
    			$fedex_user_arr['personName']                  = $this->input->post('personName',true);
				$fedex_user_arr['companyName']                 = $this->input->post('companyName',true);
				$fedex_user_arr['phoneNumber']                 = $this->input->post('phoneNumber',true);
				$fedex_user_arr['Address_streetLines']         = $this->input->post('Address_streetLines',true);
				$fedex_user_arr['Address_City']                = $this->input->post('Address_City',true);
				$fedex_user_arr['Address_StateOrProvinceCode'] = $this->input->post('Address_StateOrProvinceCode',true);
				
				$fedex_user_arr['Address_PostalCode']          = $this->input->post('Address_PostalCode',true);
				$fedex_user_arr['account']          = $this->input->post('account',true);
				$country=explode('|',$this->input->post('Address_CountryCode',true));
				$fedex_user_arr['Address_CountryCode']         = $country[2];
				$fedex_user_arr['country_id']         = $country[0];
				$fedex_user_arr['Address_Country']         = $country[1];
				$fedex_user_arr['Address_Residential']         = $this->input->post('Address_Residential',true);
 
        		$flag = $this->Base_Logistics_model->fedex_user_update( $fedex_user_arr, array( 'id' => $this->input->post('id',true) ) );
        		if( $flag )
				{
					$msg = array(
						'msg'  => '操作成功',
						'type' => 3
					);
					echo json_encode($msg);
			  	    die;
				}
				else
				{
					$msg = array(
						'msg'  => '操作失败',
						'type' => 1
					);	
					echo json_encode($msg);
					die;
				}
			}
		}

		//跳转页面
		$this->ci_smarty->display_ini('fedex_user_edit.htm');
	}
	


	
}


