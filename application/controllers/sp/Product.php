<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		$this->load_sp_menu();  
	}

	//我的商品

	//我的商品 列表
	public function product_list()
	{
		//model
		$this->load->model('Base_Supplier_model');
		
		//搜索
		$key      = array();
		$key_like = array();
		
		//只显示会员商品
		$key['userid'] = $this->user_id;
		
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('country','catname','filing_status','barcode');
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
		$this->ci_smarty->display_ini('product_list.htm');
	
	}

	//我的商品 添加 或 修改
	public function product_add_or_edit()
	{
		if (!empty($_POST)) 
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
			else
			{
				$product_arr = array();
				$product_arr['ch_name']    = $this->input->post('ch_name',true);
				$product_arr['en_name']    = $this->input->post('en_name',true);
				$product_arr['barcode']    = $this->input->post('barcode',true);
				$product_arr['desc']       = $this->input->post('desc',true);
				$product_arr['ch_brand']   = $this->input->post('ch_brand',true);
				$product_arr['en_brand']   = $this->input->post('en_brand',true);
				$product_arr['price']      = $this->input->post('price',true);
				$product_arr['mark_price'] = $this->input->post('mark_price',true);
				$cat = explode('|', $this->input->post('cat',true));
				$product_arr['catname']    = urldecode($cat[0]);
				$product_arr['catid']      = $cat[1];
				$coun = explode('|', $this->input->post('coun',true));
				$product_arr['country']    = urldecode($coun[0]);
				$product_arr['countryid']  = $coun[1];
				$product_arr['length']     = $this->input->post('length',true);
				$product_arr['width']      = $this->input->post('width',true);
				$product_arr['height']     = $this->input->post('height',true);
				$product_arr['type']       = $this->input->post('type',true);
				$product_arr['gw']         = $this->input->post('gw',true);
				$product_arr['nw']         = $this->input->post('nw',true);
				$product_arr['ch_spe']     = $this->input->post('ch_spe',true);
				$product_arr['en_spe']     = $this->input->post('en_spe',true);
				$product_arr['ch_ing']     = $this->input->post('ch_ing',true);
				$product_arr['en_ing']     = $this->input->post('en_ing',true);
				$product_arr['ch_pur']     = $this->input->post('ch_pur',true);
				$product_arr['en_pur']     = $this->input->post('en_pur',true);
				//更新 不能修改product_sp_id,userid
				if(empty($_POST['id']))
				{
					$product_arr['userid'] = $this->user_id;
					$product_arr['uptime'] = date('Y-m-d H:i:s');
				}

				//判断 添加 或者 编辑
				if (!empty($_POST['id'])) 
				{									
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
				else
				{
					//查询是否备过案以及备案状态
					$filing_status=$this->check_product_filing($product_arr['barcode']);
					if($filing_status==3)
					{
						$product_arr['filing_status'] =3;
					}
					elseif($filing_status==2)
					{
						$product_arr['filing_status'] =2;
					}
					elseif($filing_status==1)
					{
						$product_arr['filing_status'] =4;
					}
					elseif($filing_status==0)
					{
						$product_arr['filing_status'] =1;
					}
					//查询商品是否已经上传
					$goods_id=$this->check_product($product_arr['barcode']);

					if($goods_id ==FASLE)
					{
						$flag = $this->Base_Supplier_model->product_add($product_arr);
						if($flag == 1)
						{
							$msg=array(
								'msg'  => "操作成功",
								'type' => 2
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
						if($product_arr['filing_status'] ==1 || $product_arr['filing_status'] ==4)
						{
							$flag = $this->Base_Supplier_model->product_update($product_arr,array('id' =>$goods_id));
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
							$msg = array(
								'msg'  => '商品已经通过备案',
								'type' => 1
							);
							echo json_encode($msg);
							die;
						}

					}

				}
				
			}
		}

		//编辑操作时 返回表中原始数据
		if (!empty($_GET['id'])) 
		{     		
     		//model
			$this->load->model('Base_Supplier_model');
			$this->ci_smarty->assign('re',$this->Base_Supplier_model->get_product('*',array('id' => $_GET['id'])));
		}

		//获取商品类别、商品产地选项
		$this->load->model('Base_Cat_model');
		$res['cat'] = $this->Base_Cat_model->get_cat_all();
		$this->load->model('Base_Country_model');
		$res['country'] = $this->Base_Country_model->get_open_country();
		$this->ci_smarty->assign('res',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('product_add.htm');
	}



	//商品多选框 申请备案/回收站
	public function product_checkbox()
	{
		//model
		$this->load->model('Base_Supplier_model');

		if (!empty($_GET['type']))
		{
			//申请备案
			if ( $_GET['type'] == 1 ) 
			{



				//表单验证
				$this->load->library('MY_form_validation');
				$this->form_validation->set_rules('recoder_status', '预计发货日期', 'required');
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
					$filing_status = array();
					$recoder_status = $this->input->post('recoder_status',true);
					$a=explode('|',$recoder_status);
					$r_status = $a[0];
					$t=$a[1];
					$recorder_apply_time = date('Y-m-d H:i:s',time());
					$deadline = date('Y-m-d H:i:s',strtotime("+$t"."days",strtotime($recorder_apply_time)));
					$list = $_POST;
					unset($list['recoder_status']);
					foreach ( $list as $k => $v )
					{
						if ( $v == 2 || $v == 3 )
						{//防止并发
							$msg = array(
								'msg'  => '商品已经申请备案',
								'type' => 1
							);
							echo json_encode($msg);
							die;
						}
						$filing_status[] = array('id' => $k,'filing_status' => 2,'recorder_apply_time'=>$recorder_apply_time,'recorder_status'=>$r_status,'deadline'=>$deadline);
					}
					$flag = $this->Base_Supplier_model->product_uqdate_status($filing_status);
					if ( !empty($flag) )
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
			//回收站
			elseif ( $_GET['type'] == 2 ) 
			{
				$product_id = array();
				foreach ( $_POST as $k => $v ) 
				{
					if ( $v == 2 || $v == 3 ) 
					{
						$msg = array(
							'msg'  => '商品信息无法删除',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
					$product_id[] = $k;
				}
				
				$flag = $this->Base_Supplier_model->add_sproduct_bin($product_id);
				if ( $flag )
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
	}

	//上传商品时 查询商品是否已经上传过
	/**
	 * @param $barcode  商品
	 * return 如果没有  返回 FALSE ; 如果有  返回商品id;
	 */
	private function  check_product($barcode)
	{
	   if(empty($barcode)) return;
		//通过uid和barcode 查询
		//model
		$this->load->model('Sp_Product_model');
		$goods_info=$this->Sp_Product_model->get_product_info('*',array('barcode'=>$barcode,'userid'=>$this->user_id));
		if(empty($goods_info))
		{
			return FALSE;
		}
		else
		{
			return $goods_info['id'];
		}
	}

	//上传商品时  查看商品是否已经备过案
	/**
	 * @param $barcode 					商品条形码
	 */
	private  function  check_product_filing($barcode)
	{
		//model
		$this->load->model('Base_Filing_model');

		if ($this->base_filing_kjt_type==1)
		{
			$field=',b.name_par as hg_name,b.price_par  as hg_price ,b.status_par as hg_status';
		}
		else
		{
			$field=',b.name_con as hg_name,b.price_con as hg_price,b.status_con as hg_status';
		}

		$goods=$this->Base_Filing_model->get_stock_info1('a.*'.$field,$this->base_filing_type,$barcode);
		if(empty($goods))
		{
			//未备案
			return 0;
		}
		else
		{
			if($goods['hg_status']==3)
			{
				//备案通过
				return 3;
			}
			elseif ($goods['hg_status']==2)
			{
				//备案中
				return 2;
			}
			elseif ($goods['hg_status']==2)
			{
				//备案未通过
				return 1;
			}
		}


	}

	//勾选备案状态
	public function recoder_status()
	{
		$this->config->load('base_config',true);
		$res['recoder_status'] = $this->config->item('recoder_status','base_config');
		$this->ci_smarty->assign('re',$res);
		$this->ci_smarty->display('recoder_status.htm');
	}

	//商品上传
	public function product_upload()
	{
		if(isset($_FILES)&&!empty($_FILES))
		{
			@set_time_limit(0);
			//用户的断开，不终止脚本执行
			@ignore_user_abort(TRUE);
			
			//model
			$this->load->model('Base_Supplier_model');

			$da = $this->upload_xls(APPPATH."/cache/xls");
			/*
	            [1]  => 上传序号
	            [2]  => 商品中文名称
	            [3]  => 商品英文名称
	            [4]  => 条形码
	            [5]  => 商品简述
	            [6]  => 品牌（中文）
	            [7]  => 品牌（英文）
	            [8]  => 销售价
	            [9]  => 市场价
	            [10] => 商品类别
	            [11] => 商品产地
	            [12] => 长度（单位:厘米）
	            [13] => 宽度（单位:厘米）
	            [14] => 高度（单位:厘米）
	            [15] => 规格/型号（中文）
	            [16] => 规格/型号（英文）
	            [17] => 主要成份（中文）
	            [18] => 主要成份（英文）
	            [19] => 功能/用途（中文）
	            [20] => 功能/用途（英文）
	            [21] => 食品/非食品
	            [22] => 毛重（克）
	            [23] => 净重（克）	   
	        */
	        //验证提交内容
            if( !is_array( $da ) )
            {
            	$ar_url = array(site_url('product/product_upload') => '返回');
				usrl_back_msg( $da , $ar_url , $this->ci_smarty );
            }  

			//总共导入数据条数
			$data_num = count($da)-1;
			if(is_array($da))
			{
	            $product_arr = array();
	            $flag_all   = 0;
	            foreach ($da as $k => $v) 
	            {
	            	if ($k == 1) 
	            	{
	            		continue; 
	            	}
	            	//插入前 查询上传序号是否重复  查询条形码是否重复
	            	if ($this->Base_Supplier_model->check_is_repeat(array('upload_num' => $v['1'])))
	            	{
	            		//导入 添加到表 dferp_stock
	            		$product_arr['userid']     = $this->user_id;
	            		$product_arr['upload_num'] = $v['1'];
	            		$product_arr['ch_name']    = $v['2'];
	            		$product_arr['en_name']    = $v['3'];
	            		$product_arr['barcode']    = $v['4'];
	            		$product_arr['desc']       = $v['5'];
	            		$product_arr['ch_brand']   = $v['6'];
	            		$product_arr['en_brand']   = $v['7'];
	            		$product_arr['price']      = $v['8']*1;
	            		$product_arr['mark_price'] = $v['9']*1;
	            		$product_arr['catname']    = $v['10'];
	            		$product_arr['country']    = $v['11'];
	            		$product_arr['length']     = $v['12']*1;
	            		$product_arr['width']      = $v['13']*1;
	            		$product_arr['height']     = $v['14']*1;
	            		$product_arr['ch_spe']     = $v['15'];
	            		$product_arr['en_spe']     = $v['16'];
	            		$product_arr['ch_ing']     = $v['17'];
	            		$product_arr['en_ing']     = $v['18'];
	            		$product_arr['ch_pur']     = $v['19'];
	            		$product_arr['en_pur']     = $v['20'];
	            		$product_arr['type']       = $v['21']*1;
	            		$product_arr['gw']         = $v['22']*1;
	            		$product_arr['nw']         = $v['23']*1;		
	            		$product_arr['uptime']     = date('Y-m-d H:i:s');

						//查询是否备过案以及备案状态
						$filing_status=$this->check_product_filing($v['4']);
						if($filing_status==3)
						{
							$product_arr['filing_status'] =3;
						}
						elseif($filing_status==2)
						{
							$product_arr['filing_status'] =2;
						}
						elseif($filing_status==1)
						{
							$product_arr['filing_status'] =4;
						}
						elseif($filing_status==0)
						{
							$product_arr['filing_status'] =1;
						}
						//查询商品是否已经上传
						$goods_id=$this->check_product($v['4']);

						if($goods_id ==FAlSE)
						{
							$flag = $this->Base_Supplier_model->product_add($product_arr);
							$flag_all++;
						}
						else
						{
							if($product_arr['filing_status'] ==1 || $product_arr['filing_status'] ==4)
							{
								$flag = $this->Base_Supplier_model->product_update($product_arr,array('id' =>$goods_id));
								$flag_all++;
							}

						}

	            	}
	            }
	            if ($flag_all == $data_num) 
        		{
        			$ar_url = array(site_url('product/product_upload') => '返回');
					usrl_back_msg('导入成功，有'.$data_num.'条数据导入成功',$ar_url, $this->ci_smarty);
        		}
        		elseif($flag_all == 0)
        		{
        			$ar_url = array(site_url('product/product_upload') => '返回');
					usrl_back_msg('导入失败',$ar_url, $this->ci_smarty);
        		}
        		else
        		{
        			$ar_url = array(site_url('product/product_upload') => '返回');
					usrl_back_msg('导入成功，有'.$flag_all.'条数据导入成功，有'.($data_num-$flag_all).'条数据无法导入',$ar_url, $this->ci_smarty);
        		}
			}	
		}
		//载入页面
		$this->ci_smarty->display_ini('product_upload.htm');

	}

	private function upload_xls($path)
	{
		setlocale(LC_ALL, 'en_US.UTF-8');
		if(!isset($_FILES['import_product']['name']))
			return '未上传任何文件';
		//if( $_FILES['import_product']['name'] != 'product.xls' )
		//	return '上传文件错误';
		
		$namear=explode('.',$_FILES['import_product']['name']);
		if($_FILES['import_product']["size"]>1024*1024)
			return '导入文件不能超过1M';	
		if($namear[count($namear)-1]!='xls')
			return '导入文件非xls文件';	
		$f=0;
		$f1=$path."/".md5($this->user_id."import_product").".xls";
		$do1 = copy($_FILES['import_product']['tmp_name'],$f1);
		unset($_FILES);
		if($do1)
			$f=1;	
		else
			$f=-1;	
		unset($_FILES);	
		if($f==0)
			return "正在导入请稍等";
		if($f==-1)
			return "上传文件失败";
		$pro=array();	
		return get_xlsdata($f1);
	}

	//商品回收 列表
	public function product_bin_list()
	{
		//model
		$this->load->model('Base_Supplier_model');

		//搜索
		$key      = array();
		$key_like = array();

		//只显示会员商品
		$key['userid'] = $this->user_id;

		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('country','catname','filing_status');
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
			$this->ci_page->totalRows = $this->Base_Supplier_model->sproduct_bin_list_rows($key,$key_like);
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
		$this->ci_smarty->display_ini('product_bin.htm');

	}

	//商品回收 恢复/删除
	public function product_bin_checkbox()
	{
		//model
		$this->load->model('Base_Supplier_model');

		if (!empty($_GET['type']))
		{
			//恢复
			if ( $_GET['type'] == 1 ) 
			{
				$product_id = array();
				foreach ( $_POST as $k => $v ) 
				{
					$product_id[] = $k;
				}
				$flag = $this->Base_Supplier_model->sproduct_bin_recover($product_id);
				if ( $flag )
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
			//删除
			elseif ( $_GET['type'] == 2 ) 
			{
				$filing_status = array();
				foreach ( $_POST as $k => $v ) 
				{
					$filing_status[] = array('id' => $k,'filing_status' => 5);
				}		
				$flag = $this->Base_Supplier_model->sproduct_bin_delete($filing_status);
				if ( $flag )
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
	}
	
}