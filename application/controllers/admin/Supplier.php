<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Supplier extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		$this->load->model('Base_Supplier_model');
	}

	//供应商商品同步
	public function synchronize_product()
	{
		$method='search.productlist';
		$data['stime']=date("Ymd"); //开始时间
		$data['hg_type']=2; //直邮
		$data['startlimit']="1"; //开始页面
		$res=erp_tb_product($method,$data);
		//model

		if($res['code']==0 && $res['msg']=='SUCCESS')
		{

			$page_num=$res['data']['page_nums'];
			$goods_num=$res['data']['nums'];
			$g_num=0;
			echo '共需要同步'.$page_num.'页数据,'.$goods_num.'种商品<br>';
			for ($i=1;$i<=$page_num;$i++)
			{
				$data['startlimit']=$i;
				$re=erp_tb_product($method,$data);
				foreach ($re['data']['list'] as $v)
				{
					$product['userid']=0;
					$product['upload_num']='u'.$v['stock_id'];
					$product['ch_name']='u'.$v['name'];
					$product['price']=$v['price'];
					$product['mark_price']=99;
					$product['ch_brand']=$v['brand'];
					$product['country']=$v['country'];
					$product['con']=$v['con'];
					$product['con']=$v['con'];
					$product['ch_pur']=$v['function'];
					$product['gw']=$v['weight'];
					if($this->Base_Supplier_model->check_is_repeat(array('upload_num'=>$product['upload_num'])))
					{
						$res=$this->Base_Supplier_model->product_add($product);
						$g_num++;
					}else
					{
						echo $v['name'].'已经同步过,上传序号'.$product['upload_num'].'<br>';
					}

				}

				echo '第'.$data['startlimit'].'页数据已同步<br>';


			}
			echo '数据同步完毕,共同步商品'.$g_num.'种<br>';
		}
	}

	//供应商商品 列表
	public function sproduct_list()
	{
		  
		//model
		$this->load->model('Base_Supplier_model');

		//搜索
		$key      = array();
		$key_like = array();

		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('userid','country','catname','filing_status','barcode');
			//模糊字段 搜索
			$search_key_like = array('ch_name','ch_brand');
			$time_arr =array('deadline');
			foreach($_GET as $k => $v)
			{
				$skey = substr($k,7,strlen($k)-7);
				$time_sta = substr($k, 13, strlen($k) - 13);
				$time_end = substr($k, 13, strlen($k) - 13);
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

				if($k!='search_page_num' && substr($k,0,13)=='search_t_sta_' && !in_array($v,array('all','')))
				{
					
					if(in_array($time_sta,$time_arr))
					{
						$key["$time_sta >="] = $v;
					}

				}

				if($k!='search_page_num'&&substr($k,0,13)=='search_t_end_'&&!in_array($v,array('all','')))
				{
					if(in_array($time_end,$time_arr))
					{
						$key["$time_end <="] = $v;
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
			$this->ci_page->totalRows = $this->Base_Supplier_model->sproduct_list_rows($key,$key_like);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Supplier_model->sproduct_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);

		//获取商品类别、商品产地选项
		$this->load->model('Base_Cat_model');
		$res['cat'] = $this->Base_Cat_model->get_cat_all();
		$this->load->model('Base_Country_model');
		$res['country'] = $this->Base_Country_model->get_open_country();

		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('sproduct_list.htm');
	
	}

	//供应商商品 修改商品状态
	public function sproduct_change_status()
	{
		//model
		$this->load->model('Base_Supplier_model');

		//批量修改
		if (!empty($_POST)) 
		{
			if ( $_POST['filing_status'] == 'no' ) {
				$msg = array(
					'msg'  => '未选择备案状态',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}

			$filing_status = $_POST['filing_status'];
			unset($_POST['filing_status']);

			

			$product_arr = array();

			
			foreach ($_POST as $k => $v) 
			{											
				if ( $v != 2 ) 
				{
					$msg = array(
						'msg'  => '备案状态不能修改',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}	
				$product_arr[] = array('id' => $k,'filing_status' => $filing_status);
			}

			//判断提交数据是否提交
			if(!empty($product_arr))
			{
				$flag = $this->Base_Supplier_model->product_uqdate_status($product_arr);
				if($flag)
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
			else
			{
				$msg = array(
					'msg'  => '未勾选商品',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
		}
	}

	//商品回收站 列表
	public function sproduct_bin_list()
	{
		//model
		$this->load->model('Base_Supplier_model');

		//搜索
		$key      = array();
		$key_like = array();
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('userid','country','catname','filing_status');
			//模糊字段 搜索
			$search_key_like = array('ch_name','ch_brand');
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
			$this->ci_page->totalRows = $this->Base_Supplier_model->sproduct_bin_list_rows($key,$key_like,TRUE);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Supplier_model->sproduct_bin_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like,
			TRUE
		);

		//获取商品类别、商品产地选项
		$this->load->model('Base_Cat_model');
		$res['cat'] = $this->Base_Cat_model->get_cat_all();
		$this->load->model('Base_Country_model');
		$res['country'] = $this->Base_Country_model->get_open_country();

		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('sproduct_bin.htm');
	
	}

	//供应商商品 商品列表下载
	public function sproduct_download()
	{
		  //model
		  $this->load->model('Base_Supplier_model');
		  //搜索
		  $key      = array();
		  $key_like = array();
		  if(isset($_GET))
		  {
			  //非模糊字段 搜索
			  $search_key      = array('userid','country','catname','filing_status');
			  //模糊字段 搜索
			  $search_key_like = array('ch_name','ch_brand');
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
		  
		  $res=$this->db->select('*')
						->from(tab_m('sp_product'))
				        ->where($key)
						->like($key_like)
						->get()
						->result_array();	
						
		  if (!empty($res)) 
		  {
			  $ar=array('商品ID','商品中文名称','商品英文名称','条形码','商品简述'
				       ,'品牌（中文）','品牌（英文）','商品类别','产地','长度（厘米）'
					   ,'宽度（厘米）','高度（厘米）','规格/型号（中文）','规格/型号（英文）','主要成份（中文）'
					   ,'主要成份（英文）','功能/用途（中文）','功能/用途（英文）','食品/非食品','毛重（克）'
					   ,'净重（克）');

			  $ars=array();
			  foreach($res as $val)
			  {
				  $ars[]=array(
				              $val['id'],$val['ch_name'],$val['en_name'],$val['barcode'],$val['desc']
							  ,$val['ch_brand'],$val['en_brand'], $val['catname'],$val['country'], $val['length']
							  ,$val['width'], $val['height'], $val['ch_spe'], $val['en_spe'],$val['ch_ing'], $val['en_ing'], $val['ch_pur']
							  ,$val['en_pur'], $val['type']==1?'食品':'非食品', $val['gw'], $val['nw']
							  );
			  }	         
			              
			  get_explode_xls($ar,$ars,'待备案产品下载'. date('Y-m-d'));
		 }

	}

	//供应商商品 xls文件下载
	public function xls_download()
	{
		if (!empty($_GET['file'])) 
		{
			$this->load->helper('download');
			$data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$_GET['file']);
			$name = $_GET['file'];
			force_download($name, $data);
		}
	}

	//供应商 列表
	public function supplier_list()
	{
	
		//model
		$this->load->model('Base_Supplier_model');

		//搜索
		$key      = array();
		$key_like = array();
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('status');
			//模糊字段 搜索
			$search_key_like = array('user','company');
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
			$this->ci_page->totalRows = $this->Base_Supplier_model->supplier_list_rows($key,$key_like);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$list = $this->Base_Supplier_model->supplier_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);
		foreach ( $list as $k=>$v )
		{
			$res['list'][$k]=$v;
			if($v['send_addr_id'])
			{
				$sql = "SELECT `companyName` FROM  ".tab_m('fedex_user')." WHERE id=".$v['send_addr_id'];
				$company=$this->db->query($sql)->row_array();
				$res['list'][$k]['send_addr_id']=$company['companyName'];
			}
			if($v['end_addr_id'])
			{
				$sql = "SELECT `companyName` FROM  ".tab_m('fedex_user')." WHERE id=".$v['end_addr_id'];
				$company=$this->db->query($sql)->row_array();
				$res['list'][$k]['end_addr_id']=$company['companyName'];
			}

			if($v['dutiesPayment_id'])
			{
				$sql = "SELECT `companyName` FROM  ".tab_m('fedex_user')." WHERE id=".$v['dutiesPayment_id'];
				$company=$this->db->query($sql)->row_array();
				$res['list'][$k]['dutiesPayment_id']=$company['companyName'];
			}
			if($v['payor_id'])
			{
				$sql = "SELECT `companyName` FROM  ".tab_m('fedex_user')." WHERE id=".$v['payor_id'];
				$company=$this->db->query($sql)->row_array();
				$res['list'][$k]['payor_id']=$company['companyName'];
			}
		}
		
		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('supplier_list.htm');
	
	}

	//供应商 添加
	public function supplier_add()
	{
		//model
		$this->load->model('Base_Supplier_model');

		if(!empty($_POST))
		{

			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('user', '用户帐号', 'required|min_length[4]');
			$this->form_validation->set_rules('pass', '用户密码', 'required|min_length[6]');
			$this->form_validation->set_rules('act_pass', '操作密码', 'required|min_length[6]');
			$this->form_validation->set_rules('company', '公司名称', 'required|min_length[2]');
			$this->form_validation->set_rules('mobile', '手机号码', 'required|exact_length[11]');
			$this->form_validation->set_rules('en_addr', '国外拿货地址', 'required');
			$this->form_validation->set_rules('sp_addr', '商户模式', 'required');
			$this->form_validation->set_rules('send_addr_id', 'FedEx发件方', 'required');
			$this->form_validation->set_rules('end_addr_id', 'FedEx收件方', 'required');
			$this->form_validation->set_rules('payor_id', 'FedEx运费支付方', 'required');
			$this->form_validation->set_rules('dutiesPayment_id', 'FedEx清关方', 'required');
			if($_POST['sp_huoyunzhan'])
			{
				$this->form_validation->set_rules('sp_huoyunzhan','货运站','required');
			}
			$this->form_validation->set_rules('currency', 'FedEx币种', 'required');
			$this->form_validation->set_rules('filing_type', '关区类型', 'required');
			$this->form_validation->set_rules('filing_kjt_type', '交税类型必填', 'required');
			$this->form_validation->set_rules('status', '是否开启', 'required');
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
				$supplier_arr['user'] = $this->input->post('user',true);
				$supplier_arr['pass'] = md5($this->input->post('pass',true));
				$supplier_arr['act_pass'] = md5($this->input->post('act_pass',true));
				$supplier_arr['company'] = $this->input->post('company',true);
				$supplier_arr['mobile'] = $this->input->post('mobile',true);
				$supplier_arr['en_addr'] = $this->input->post('en_addr',true);
				$supplier_arr['send_addr_id'] = $this->input->post('send_addr_id',true);
				$supplier_arr['end_addr_id'] = $this->input->post('end_addr_id',true);
				$supplier_arr['payor_id'] = $this->input->post('payor_id',true);
				$supplier_arr['dutiesPayment_id'] = $this->input->post('dutiesPayment_id',true);
				$supplier_arr['dutiesPayment_id'] = $this->input->post('dutiesPayment_id',true);
				if(!empty($_POST['sp_huoyunzhan']))
				{
					$supplier_arr['huoyunzhan_uid'] = $this->input->post('sp_huoyunzhan',true);
				}
				$currency=explode('|',$this->input->post('currency',true));
				$supplier_arr['fedex_currency']=$currency[1];
				$supplier_arr['fedex_currency_id']=$currency[0];
				$sp_addr=explode('|',$this->input->post('sp_addr',true));
				$supplier_arr['addr_id']=$sp_addr[0];
				$supplier_arr['addr_name']=$sp_addr[1];
				$supplier_arr['filing_type'] = $this->input->post('filing_type',true);
				$supplier_arr['filing_kjt_type'] = $this->input->post('filing_kjt_type',true);
				$supplier_arr['fedex_account'] = $_POST['fedex_account'];
				$supplier_arr['status'] = $this->input->post('status',true);
				$supplier_arr['addtime']   = date('y-m-d h:i:s');

				//添加前判断登录帐号是否重复
				if ($this->Base_Supplier_model->check_supplier_user(array('user' => $this->input->post('user',true))))
				{
					$flag = $this->Base_Supplier_model->supplier_add($supplier_arr);
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
				else
				{
					$msg = array(
						'msg'  => '登录帐号已存在',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}


		}
	
		
		if(!empty($_GET['fedex_account']))
		{

			$account=explode('-',$_GET['fedex_account']);
			$res['fedex_account']=$account[1];
			$res['fedex_account_id']=$account[0];

			//获取币种列表
			$sql = "SELECT * FROM ".tab_m('currency');
			$res['currency']=$this->db->query($sql)->result_array();

			//获取发货地址列表

			$sql = "SELECT `companyName`,`id` ,`Address_City` FROM  ".tab_m('fedex_user')." WHERE `fedex_account`=".$account[0]." and `type`=1";

			$res['send_addr']=$this->db->query($sql)->result_array();


			//获取收货地址列表

			$sql = "SELECT `companyName`,`id` ,`Address_City` FROM  ".tab_m('fedex_user')." WHERE `fedex_account`=".$account[0]." and `type`=2";

			$res['end_addr']=$this->db->query($sql)->result_array();

			//获取运费支付方列表
			$sql = "SELECT `companyName`,`id` ,`Address_City` FROM  ".tab_m('fedex_user')." WHERE `fedex_account`=".$account[0]." and `type`=3";

			$res['billaccount']=$this->db->query($sql)->result_array();

			//获取清关支付方列表
			$sql = "SELECT `companyName`,`id` ,`Address_City` FROM  ".tab_m('fedex_user')." WHERE `fedex_account`=".$account[0]." and `type`=3";

			$res['dutyaccount']=$this->db->query($sql)->result_array();

			//获取货运站商户
			$res['huoyunzhan'] = $this->Base_Supplier_model->get_sp_user(array('id','company','mobile'),array('addr_id'=>'2'));
			//关区配置参数
			require(APPPATH.'/config/base_config.php');
			$res['customs_list'] = $config['customs_list'];
			$res['customs_rate_type'] = $config['customs_rate_type'];
			//获取商户模式
			$res['sp_addr'] = $this->Base_Supplier_model->get_sproduct_addr_all();
			//返回结果
			$this->ci_smarty->assign('addr',$res,1,'page');
			//载入页面
			$this->ci_smarty->display_ini('supplier_add.htm');

		}else
		{
			//FedEx对接账号
			$sql="SELECT * FROM ".tab_m('fedex_account');
			$fedex_account=$this->db->query($sql)->result_array();
			$this->ci_smarty->assign('fedex_account',$fedex_account);
			//载入页面
			$this->ci_smarty->display_ini('supplier_add.htm');
		}

	}

	public function supplier_edit()
	{
		//model
		$this->load->model('Base_Supplier_model');
		if(!empty($_GET))
		{
			$fetchFields = 'id,user,company,mobile,status';
			$re=$this->Base_Supplier_model->get_supplier($fetchFields,array('id' => $_GET['id']));

			$this->ci_smarty->assign('re',$re);
			//载入页面
			$this->ci_smarty->display_ini('supplier_edit.htm');
		}

		if(!empty($_POST))
		{
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('company', '公司名称', 'required|min_length[2]');
			$this->form_validation->set_rules('mobile', '手机号码', 'required|exact_length[11]');
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

				if($_POST['pass'])
				{
					$supplier_arr['pass'] = md5($_POST['pass']);
				}
				if($_POST['act_pass'])
				{
					$supplier_arr['act_pass'] = md5($_POST['act_pass']);
				}
				$supplier_arr['company'] =$_POST['company'];
				$supplier_arr['mobile'] = $_POST['mobile'];
				$flag = $this->Base_Supplier_model->supplier_update($supplier_arr,array('id' => $_POST['id']));
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
				{//编辑
					$msg = array(
						'msg'  => '更新失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}
		}




	}

	public function supplier_add_or_edit()
	{
		//model
		$this->load->model('Base_Supplier_model');

		$this->load->model('Base_Logistics_model');

		if (!empty($_POST)) 
		{
			//表单验证
			$this->load->library('MY_form_validation');
			if (!empty($_POST['id'])) 
			{
				if ($_POST['act'] == 1) 
				{
					$this->form_validation->set_rules('company', '公司名称', 'required|min_length[2]');
					$this->form_validation->set_rules('mobile', '手机号码', 'required|exact_length[11]');
				}
				if ($_POST['act'] == 2) 
				{
					if (!empty($_POST['pass_edit'])) 
					{
						$this->form_validation->set_rules('pass_edit', '用户密码', 'min_length[6]');
					}
					if (!empty($_POST['act_pass_edit'])) 
					{
						$this->form_validation->set_rules('act_pass_edit', '操作密码', 'min_length[6]');
					}	
					if (empty($_POST['pass_edit']) && empty($_POST['act_pass_edit'])) {
						$msg = array(
							'msg'  => '操作结束',
							'type' => 3
						);	
						echo json_encode($msg);
						die;
					}
				}
			}
			else
			{
				$this->form_validation->set_rules('user', '用户帐号', 'required|min_length[4]'); 
				$this->form_validation->set_rules('pass', '用户密码', 'required|min_length[6]');
				$this->form_validation->set_rules('act_pass', '操作密码', 'required|min_length[6]');
				$this->form_validation->set_rules('company', '公司名称', 'required|min_length[2]');
				$this->form_validation->set_rules('mobile', '手机号码', 'required|exact_length[11]');	
				$this->form_validation->set_rules('en_addr', '国外拿货地址', 'required');
				$this->form_validation->set_rules('sp_addr', '商户模式', 'required');

				if($_POST['sp_addr']==1 || $_POST['sp_addr']==2){
					$this->form_validation->set_rules('send_addr_id', '（fedex）发件方', 'required');
					$this->form_validation->set_rules('end_addr_id', '（fedex）收件方', 'required');
					$this->form_validation->set_rules('payor_id', '(fedex)运费支付方', 'required');
					$this->form_validation->set_rules('dutiesPayment_id', '(fedex)清关方', 'required');
				}
				if($_POST['sp_addr']==3){
					$this->form_validation->set_rules('sp_huoyunzhan','货运站','required');
				}
				
				//编辑不可修改关区
				if(empty($_POST['id']))
				{
					$this->form_validation->set_rules('filing_type', '关区类型', 'required');	
					$this->form_validation->set_rules('filing_kjt_type', '交税类型必填', 'required');	
				}
			}
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
				$supplier_arr = array();
				//判断 添加 或 编辑
				if(!empty($_POST['id']))
				{				
					if ($_POST['act'] == 1) 
					{
						if ( $_POST['company_ori'] != $this->input->post('company',true)) 
						{
							$supplier_arr['company'] = $this->input->post('company',true);
						}
						
						if ( $_POST['mobile_ori'] != $this->input->post('mobile',true)) 
						{
							$supplier_arr['mobile']  = $this->input->post('mobile',true);
						}
						
						if ( $_POST['en_addr_ori'] != $this->input->post('en_addr',true)) 
						{
							$supplier_arr['en_addr']  = $this->input->post('en_addr',true);
						}
						
						/*编辑不可切换商户模式
						if ( $_POST['sp_addr_ori'] != $this->input->post('sp_addr',true)) 
						{
							$sp_addr = explode('|', $this->input->post('sp_addr',true));
							$supplier_arr['addr_id']   = $sp_addr[0];
							$supplier_arr['addr_name'] = $sp_addr[1];
						}
						*/
						
						if ( $_POST['status_ori'] != $this->input->post('status',true)) 
						{
							$supplier_arr['status']  = $this->input->post('status',true);
						}

						if (empty($supplier_arr)) 
						{
							$msg = array(
								'msg'  => '操作结束',
								'type' => 3
							);	
							echo json_encode($msg);
							die;
						}	
					}
					elseif ($_POST['act'] == 2) 
					{
						if (!empty($_POST['pass_edit'])) 
						{
							$supplier_arr['pass']     = md5($this->input->post('pass_edit',true));
						}
						if (!empty($_POST['act_pass_edit'])) 
						{
							$supplier_arr['act_pass'] = md5($this->input->post('act_pass_edit',true));
						}	
					}			
				}
				else
				{
					//添加前判断登录帐号是否重复
					if ($this->Base_Supplier_model->check_supplier_user(array('user' => $this->input->post('user',true))))
					{
						$supplier_arr['user']      = $this->input->post('user',true);
						$supplier_arr['pass']      = md5($this->input->post('pass',true));
						$supplier_arr['act_pass']  = md5($this->input->post('act_pass',true));
						$supplier_arr['company']   = $this->input->post('company',true);
						$supplier_arr['mobile']    = $this->input->post('mobile',true);
						$supplier_arr['en_addr']   = $this->input->post('en_addr',true);
						$sp_addr = explode('|', $this->input->post('sp_addr',true));
						$supplier_arr['addr_id']   = $sp_addr[0];
						$supplier_arr['addr_name'] = $sp_addr[1];
						$supplier_arr['send_addr_id'] = $this->input->post('send_addr_id',true);
						$supplier_arr['end_addr_id'] = $this->input->post('end_addr_id',true);
						$supplier_arr['payor_id'] = $this->input->post('payor_id',true);
						$supplier_arr['dutiesPayment_id'] = $this->input->post('dutiesPayment_id',true);
						$supplier_arr['huoyunzhan_uid'] = $this->input->post('sp_huoyunzhan',true);
						$supplier_arr['filing_type'] = $this->input->post('filing_type',true);
						$supplier_arr['filing_kjt_type'] = $this->input->post('filing_kjt_type',true);
						$supplier_arr['addtime']   = date('y-m-d h:i:s');	
					}
					else
					{
						$msg = array(
							'msg'  => '登录帐号已存在',
							'type' => 1
						);	
						echo json_encode($msg);
						die;
					}
				}

				//判断 添加 或者 编辑
				if (!empty($_POST['id'])) 
				{//添加								
					$flag = $this->Base_Supplier_model->supplier_update($supplier_arr,array('id' => $_POST['id']));	
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
					{//编辑
						$msg = array(
							'msg'  => '更新失败',
							'type' => 1
						);	
						echo json_encode($msg);
						die;
					}									
				}
				else
				{//添加
					$flag = $this->Base_Supplier_model->supplier_add($supplier_arr);
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
		}

		//编辑操作时 返回表中原始数据
		if (!empty($_GET['id'])) 
		{     		
			if ($_GET['act'] == 1)
			{
				$fetchFields = 'id,user,company,mobile,addr_id,addr_name,en_addr,status,send_addr_id,end_addr_id,payor_id,dutiesPayment_id,filing_kjt_type,filing_type';
			}
			elseif ($_GET['act'] == 2) 
			{
				$fetchFields = 'id,user';
			}
			$re=$this->Base_Supplier_model->get_supplier($fetchFields,array('id' => $_GET['id']));
			$re['fedex_sender'] =  $this->Base_Logistics_model->get_fedex_user_info(array('Address_City','companyName'),array('id'=>$re['send_addr_id']));
			$re['fedex_ender'] =  $this->Base_Logistics_model->get_fedex_user_info(array('Address_City','companyName'),array('id'=>$re['end_addr_id']));
			$re['fedex_payor'] =  $this->Base_Logistics_model->get_fedex_user_info(array('Address_City','companyName','account'),array('id'=>$re['payor_id']));
			$re['fedex_dutyor'] =  $this->Base_Logistics_model->get_fedex_user_info(array('Address_City','companyName','account'),array('id'=>$re['dutiesPayment_id']));
			$this->ci_smarty->assign('re',$re,0);
			$this->ci_smarty->assign('act',$_GET['act']);
		}

		//获取商户地址
		$res['sp_addr'] = $this->Base_Supplier_model->get_sproduct_addr_all();
		//获取发货方地址
		$res['send_addr'] = $this->Base_Logistics_model->get_fedex_user(array('id','Address_City','companyName'),array('type'=>'1'));

		//获取收货方地址
		$res['end_addr'] = $this->Base_Logistics_model->get_fedex_user(array('id','Address_City','companyName'),array('type'=>'2'));

		//获取运费支付方
		$res['billaccount'] =$this->Base_Logistics_model->get_fedex_user(array('id','companyName','Address_City','account'),array('type'=>'3'));
		//获取清关方
		$res['dutyaccount'] = $this->Base_Logistics_model->get_fedex_user(array('id','companyName','Address_City','account'),'type = 3 or type =2');

		//获取货运站商户
		$res['huoyunzhan'] = $this->Base_Supplier_model->get_sp_user(array('id','company','mobile'),array('addr_id'=>'2'));
		//关区配置参数
		require(APPPATH.'/config/base_config.php');
		$res['customs_list'] = $config['customs_list'];
		$res['customs_rate_type'] = $config['customs_rate_type'];
		
		//返回结果
		$this->ci_smarty->assign('addr',$res,1,'page');
		//载入页面
		$this->ci_smarty->display_ini('supplier_add.htm');

	}

	//商户模式列表
	public function sproduct_addr()
	{
		//model
		$this->load->model('Base_Supplier_model');

		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url = site_url($this->class."/".$this->method);
		$search_page_num = array('all'=>15,1=>15,2=>30,3=>50);
		$this->ci_page->listRows =! isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows = $this->Base_Supplier_model->sproduct_addr_list_rows();
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Supplier_model->sproduct_addr_list(
			'id,addr_name',
			$this->ci_page->listRows,
			$this->ci_page->firstRow
		);

		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('sproduct_addr.htm');
	}

	//商户模式 添加 或 编辑
	public function sproduct_addr_add()
	{
		if (!empty($_POST) && !empty($_POST)) 
		{
			//model
			$this->load->model('Base_Supplier_model');

			//表单验证
			$this->load->library('MY_form_validation');		
			$this->form_validation->set_rules('addr_name', '商户模式', 'required');
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
				if( $this->Base_Supplier_model->sproduct_addr_list_rows( array( 'addr_name' => $this->input->post('addr_name',true) ) ) == 0 )
				{
					$sp_addr_arr = array();
					$sp_addr_arr['addr_name'] = $this->input->post('addr_name',true);
					//判断 添加 或者 编辑
					if ( !empty( $_POST['id'] ) ) 
					{									
						$flag = $this->Base_Supplier_model->sproduct_addr_update( $sp_addr_arr , array( 'id' => $_POST['id'] ) );	
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
						$flag = $this->Base_Supplier_model->sproduct_addr_add( $sp_addr_arr );
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
						'msg'  => '商户地址已存在',
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
			$this->load->model('Base_Supplier_model');
			$this->ci_smarty->assign( 're',$this->Base_Supplier_model->get_sproduct_addr( 'id,addr_name' , array( 'id' => $_GET['id'] ) ) );
		}

		//载入页面
		$this->ci_smarty->display_ini('sproduct_addr_add.htm');

	}

	public function product_edit()
	{
		if(!empty($_GET))
		{
			//model

			$this->load->model('Base_Supplier_model');
			//获取商品类别、商品产地选项
			$this->load->model('Base_Cat_model');
			$res['cat'] = $this->Base_Cat_model->get_cat_all();
			$this->load->model('Base_Country_model');
			$res['country'] = $this->Base_Country_model->get_open_country();
			$this->ci_smarty->assign('re',$this->Base_Supplier_model->get_product('*',array('id'=>$_GET['id'])));
			$this->ci_smarty->assign('res',$res);
			$this->ci_smarty->display_ini('sproduct_edit.htm');

		}
		if(!empty($_POST))
		{
			//model
			$this->load->model('Base_Supplier_model');
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('ch_name','商品中文名称','required');
			$this->form_validation->set_rules('en_name','商品英文名称','required');
			$this->form_validation->set_rules('barcode','商品条形码','required|numeric');
			$this->form_validation->set_rules('desc','商品简述','required');
			$this->form_validation->set_rules('ch_brand','品牌(中文)','required');
			$this->form_validation->set_rules('en_brand','品牌(英文)','required');
			$this->form_validation->set_rules('price','销售价','required|numeric');
			$this->form_validation->set_rules('mark_price','市场价','required|numeric');
			$this->form_validation->set_rules('cat','商品类别','required');
			$this->form_validation->set_rules('coun','商品产地','required');
			$this->form_validation->set_rules('length','长度','required|numeric');
			$this->form_validation->set_rules('width','宽度','required|numeric');
			$this->form_validation->set_rules('height','高度','required|numeric');
			$this->form_validation->set_rules('type','食品/非食品','required');
			$this->form_validation->set_rules('gw','毛重','required|numeric');
			$this->form_validation->set_rules('nw','净重','required|numeric');
			$this->form_validation->set_rules('ch_spe','规格/型号(中文)','required');
			$this->form_validation->set_rules('en_spe','规格/型号(英文)','required');
			$this->form_validation->set_rules('ch_ing','主要成分(中文)','required');
			$this->form_validation->set_rules('en_ing','主要成分(英文)','required');
			$this->form_validation->set_rules('ch_pur','功能/用途(中文)','required');
			$this->form_validation->set_rules('en_pur','功能/用途(英文)','required');

			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			else {
				$product_arr = array();
				$product_arr['ch_name'] = $this->input->post('ch_name', true);
				$product_arr['en_name'] = $this->input->post('en_name', true);
				$product_arr['barcode'] = $this->input->post('barcode', true);
				$product_arr['desc'] = $this->input->post('desc', true);
				$product_arr['ch_brand'] = $this->input->post('ch_brand', true);
				$product_arr['en_brand'] = $this->input->post('en_brand', true);
				$product_arr['price'] = $this->input->post('price', true);
				$product_arr['mark_price'] = $this->input->post('mark_price', true);
				$cat = explode('|', $this->input->post('cat', true));
				$product_arr['catname'] = urldecode($cat[0]);
				$product_arr['catid'] = $cat[1];
				$coun = explode('|', $this->input->post('coun', true));
				$product_arr['country'] = urldecode($coun[0]);
				$product_arr['countryid'] = $coun[1];
				$product_arr['length'] = $this->input->post('length', true);
				$product_arr['width'] = $this->input->post('width', true);
				$product_arr['height'] = $this->input->post('height', true);
				$product_arr['type'] = $this->input->post('type', true);
				$product_arr['gw'] = $this->input->post('gw', true);
				$product_arr['nw'] = $this->input->post('nw', true);
				$product_arr['ch_spe'] = $this->input->post('ch_spe', true);
				$product_arr['en_spe'] = $this->input->post('en_spe', true);
				$product_arr['ch_ing'] = $this->input->post('ch_ing', true);
				$product_arr['en_ing'] = $this->input->post('en_ing', true);
				$product_arr['ch_pur'] = $this->input->post('ch_pur', true);
				$product_arr['en_pur'] = $this->input->post('en_pur', true);
				$product_arr['id'] = $this->input->post('id', true);

				$flag = $this->Base_Supplier_model->product_update($product_arr,array('id' => $_POST['id']));
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
		}
	}

}