<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Filing extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
	}

	
	
	

	//平台备案库 列表
	public function filing_list()
	{
		//model
		$this->load->model('Base_Filing_model');

		$base_filing_kjt_type=isset($_GET['search_tax_type'])&& is_numeric($_GET['search_tax_type'])?$_GET['search_tax_type']:1; //税的类型
		$base_filing_type=isset($_GET['search_customs'])&& is_numeric($_GET['search_customs'])?$_GET['search_customs']:1;  //关区
					 
		//搜索
		$key      = array();
		$key_like = array();
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('status','country','barcode');
			//模糊字段 搜索
			$search_key_like = array('ch_name','ch_brand');
			
			$search_b_key   = array('status_par','status_con');
			
			if($_GET['search_hg_status']!=-1)
			{
				if ($base_filing_kjt_type==1) 
					$_GET['search_status_par']=$_GET['search_hg_status'];
				else
					$_GET['search_status_con']=$_GET['search_hg_status'];
			}
			else
			{
				if ($base_filing_kjt_type==1) 
					$key["b.status_par"] ='';
				else
					$key["b.status_con"] ='';
			}
			
			
			foreach($_GET as $k => $v)
			{
				$skey = substr($k,7,strlen($k)-7);  
				
				if($k != 'search_page_num' && substr($k,0,7) == 'search_' && !in_array($v,array('all','')))
				{
					//非模糊字段
					if(in_array($skey,$search_key))
					{
						$key["a.".$skey] = $v;
					}
					
					//非模糊字段
					if(in_array($skey,$search_b_key))
					{
						$key["b.".$skey] = $v;
					}
					
					//模糊字段
					if(in_array($skey,$search_key_like))
					{
						$key_like["a.".$skey] = $v;	
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
			//$this->ci_page->totalRows = $this->Base_Filing_model->filing_list_rows($key,$key_like);
			$this->ci_page->totalRows = $this->Base_Filing_model->get_filing_type_list_nums($base_filing_type,$base_filing_kjt_type,$key ,$key_like);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$field='';
		
		if ($base_filing_kjt_type==1) 
			$field=',"'.$base_filing_kjt_type.'" as hg_tax_type,"'.$base_filing_type.'" as hg_customs ,b.name_par as hg_name,b.price_par  as hg_price ,b.status_par as hg_status';
		else
			$field=',"'.$base_filing_kjt_type.'" as hg_tax_type,"'.$base_filing_type.'" as hg_customs ,b.name_con as hg_name,b.price_con as hg_price,b.status_con as hg_status';
	   
		$limit=array(
					0=>$this->ci_page->firstRow,
					1=>$this->ci_page->listRows
			   );
		
		$res['list'] = $this->Base_Filing_model->get_filing_type_list('a.* '.$field
					   ,$base_filing_type
					   ,$base_filing_kjt_type
					   ,$key,$key_like,$limit," a.id  desc");
		
		if(isset($_GET['down']))
		{		
			$str="上传序号,商品中文名称,商品英文名称,条形码	,商品简述	,品牌（中文）,品牌（英文）,商品类别,产地,长度（厘米）,宽度（厘米）,高度（厘米）,规格/型号（中文）".
				 ",规格/型号（英文）,主要成份（中文）,主要成份（英文）,功能/用途（中文）,功能/用途（英文）,食品/非食品（1 食品 2 非食品）,毛重（克）,净重（克）".
				 ",行邮税编号,行邮税税率,综合税税率,备案名称,备案价格,备案状态（1 未通过 2 备案中 3 已通过）";
			$ar=explode(',',$str);
			
			$ar_list=array();
			foreach($res['list'] as $k=>$v)
			{
				$ar_list[$k][]=$v['upload_num'];
				$ar_list[$k][]=$v['ch_name'];
				$ar_list[$k][]=$v['en_name'];
				$ar_list[$k][]=$v['barcode'];
				$ar_list[$k][]=$v['desc'];
				$ar_list[$k][]=$v['ch_brand'];
				$ar_list[$k][]=$v['en_brand'];
				$ar_list[$k][]=$v['catname'];
				$ar_list[$k][]=$v['country'];
				$ar_list[$k][]=$v['length'];
				$ar_list[$k][]=$v['width'];
				$ar_list[$k][]=$v['height'];
				$ar_list[$k][]=$v['ch_spe'];
				$ar_list[$k][]=$v['en_spe'];
				$ar_list[$k][]=$v['ch_ing'];
				$ar_list[$k][]=$v['en_ing'];
				$ar_list[$k][]=$v['ch_pur'];
				$ar_list[$k][]=$v['en_pur'];
				$ar_list[$k][]=$v['type'];
				$ar_list[$k][]=$v['gw'];
				$ar_list[$k][]=$v['nw'];
				$ar_list[$k][]=$v['tax_id'];
				$ar_list[$k][]=$v['par_tax'];
				$ar_list[$k][]=$v['con_tax'];
				$ar_list[$k][]=$v['hg_name'];
				$ar_list[$k][]=$v['hg_price'];
				$ar_list[$k][]=$v['hg_status'];
			}

			get_explode_xls($ar,$ar_list,'备案库存');
			
			 
			die;	 
		}
					   		   
		$res['filing_type']=f_get_status($this->base_filing_type,'customs_list');
		$res['filing_kjt_type']=f_get_status($this->base_filing_kjt_type,'customs_rate_type');

		//获取商品类别、商品产地选项
		$this->load->model('Base_Cat_model');
		$res['cat'] = $this->Base_Cat_model->get_cat_all();
		$this->load->model('Base_Country_model');
		$res['country'] = $this->Base_Country_model->get_open_country();

		//关区
		require(APPPATH.'/config/base_config.php');
		$res['customs_list'] = $config['customs_list'];
		$res['customs_rate_type'] = $config['customs_rate_type'];

		


		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('filing_list.htm');

	}	

	//平台备案库 列表
	public function filing_list_bak()
	{
		//model
		$this->load->model('Base_Filing_model');
		//搜索
		$key      = array();
		$key_like = array();
		$type='';
		$customs='';
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('status','catname','country');
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
					
					// tax_type=1 行邮税
                    // tax_type=2 综合税
					
					if(substr($k,7)=='tax_type')
					{
						$type= $v;
					}
					
					//关区
					if(substr($k,7)=='customs')
					{
						$customs= $v;
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
			$this->ci_page->totalRows = $this->Base_Filing_model->filing_list_rows($key,$key_like);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Filing_model->filing_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);

		//关联查询 表dferp_stock_filing 根据字段customs（默认关区）、tax_type（计税方式）
		foreach ($res['list'] as $k => $v) {
			$res['list'][$k]['ass'] = array();
			if(isset($type) && isset($customs) && !empty($type) && !empty($customs))
			{
				$res['list'][$k]['customs']   =$customs;
			    $res['list'][$k]['tax_type']  = $type;
				
				if ($type == 1)
				{
					$row = $this->Base_Filing_model->filing_list_ass(
						$customs,
						array('id' => $v['id']),
						'name_par,price_par,status_par'
					);
					$res['list'][$k]['ass']['name']   = $row['name_par'];
					$res['list'][$k]['ass']['price']  = $row['price_par'];
					$res['list'][$k]['ass']['status'] = $row['status_par'];
				}
				elseif($type == 2)
				{
					$row = $this->Base_Filing_model->filing_list_ass(
						$customs,
						array('id' => $v['id']),
						'name_con,price_con,status_con');
					$res['list'][$k]['ass']['name']   = $row['name_con'];
					$res['list'][$k]['ass']['price']  = $row['price_con'];
					$res['list'][$k]['ass']['status'] = $row['status_con'];
				}
			}
			else
			{
				if ($v['tax_type'] == 1)
				{
					$row = $this->Base_Filing_model->filing_list_ass(
						$v['customs'],
						array('id' => $v['id']),
						'name_par,price_par,status_par'
					);
					$res['list'][$k]['ass']['name']   = $row['name_par'];
					$res['list'][$k]['ass']['price']  = $row['price_par'];
					$res['list'][$k]['ass']['status'] = $row['status_par'];
				}
				elseif($v['tax_type'] == 2)
				{
					$row = $this->Base_Filing_model->filing_list_ass(
						$v['customs'],
						array('id' => $v['id']),
						'name_con,price_con,status_con'
					);
					$res['list'][$k]['ass']['name']   = $row['name_con'];
					$res['list'][$k]['ass']['price']  = $row['price_con'];
					$res['list'][$k]['ass']['status'] = $row['status_con'];
				}
			}


		}	

		//获取商品类别、商品产地选项
		$this->load->model('Base_Cat_model');
		$res['cat'] = $this->Base_Cat_model->get_cat_all();
		$this->load->model('Base_Country_model');
		$res['country'] = $this->Base_Country_model->get_open_country();
		//关区
		require(APPPATH.'/config/base_config.php');
		$res['customs_list'] = $config['customs_list'];
		$res['customs_rate_type'] = $config['customs_rate_type'];

		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('filing_list.htm');

	}

	//平台备案库 编辑
	public function filing_edit()
	{	
		//model
		$this->load->model('Base_Filing_model');

		//查询备案信息
		if(!empty($_GET['id']))
		{
			//获取原始数据
			$res = array();
			$res['id']       = $_GET['id'];
			$res['customs']  = $_GET['customs'];
			$res['tax_type'] = $_GET['tax_type'];
			$res['par_tax']  = $_GET['par_tax'];
			$res['con_tax']  = $_GET['con_tax'];
			for ($i = 1; $i <= 5; $i++) { 
				$arr = $this->Base_Filing_model->filing_list_ass(
					$i,
					array('id' => $_GET['id']),
					'id,name_par,price_par,status_par,name_con,price_con,status_con'
				);
				if (!empty($arr)) 
				{
					$res['filing'][$i] = $arr;
				}
				else
				{
					$res['filing'][$i] = array();
				}
			}
			//关区
			require(APPPATH.'/config/base_config.php');
			$res['customs_list'] = $config['customs_list'];
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}
		
		//获取修改数据
		if(!empty($_POST['id']))
		{
			$stock_arr = array();
			$stock_arr['customs']  = $this->input->post('customs',true);
	        $stock_arr['tax_type'] = $this->input->post('tax_type',true);
	        $flag = $this->Base_Filing_model->stock_uqdate($stock_arr,array('id' => $this->input->post('id',true)));
	        if($flag == 1)
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

		//载入页面
		$this->ci_smarty->display_ini('filing_edit.htm');
	
	}

	//平台备案库 批量修改 状态、关区、计税方式
	public function filing_edit_more()
	{
		//model
		$this->load->model('Base_Filing_model');

		//批量修改
		if ( !empty($_GET['type']) ) 
		{
			
			$status   = $_POST['status'];
			$customs  = $_POST['customs'];
			$tax_type = $_POST['tax_type'];
			unset($_POST['status']);
			unset($_POST['customs']);
			unset($_POST['tax_type']);

			$stock_arr = array();

			foreach ( $_POST as $key => $value ) 
			{
				
				$v_arr = explode('|',$value); 
				//判断修改 状态 或者 默认关区
				if ( $_GET['type'] == 1 )
				{
					if ( $status != 'no' && $v_arr[0] != $status ) 
					{
						$stock_arr[$key] = array( 'id' => $key , 'status' => $status );
					}
				}
				elseif ( $_GET['type'] == 2 ) 
				{
					if ( $customs != 'no' && $tax_type != 'no' ) 
					{
						if ( $customs != $v_arr[1] || $tax_type != $v_arr[2] ) 
						{
							$stock_arr[$key] = array('id' => $key,'customs' => $customs,'tax_type' => $tax_type);
						}
					}
				}
				
			}

			//判断提交数据是否改变
			if(!empty($stock_arr))
			{
				$flag = $this->Base_Filing_model->stock_uqdate_batch($stock_arr);
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
					$msg=array(
						'msg'  => '操作失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}	
			}
			else
			{
				$msg=array(
					'msg'  => '操作成功',
					'type' => 3
				);
				echo json_encode($msg);
				die;
			}
		}
	}

	//平台备案库 编辑 更新
	public function filing_update()
	{
		//获取原始数据
		if(!empty($_POST['show_id']))
		{		
            $res = array();
			$res['id']       = $this->input->post('show_id',true);
			$res['tax_type'] = $this->input->post('tax_type',true);
			$res['customs']  = $this->input->post('customs',true);
			$res['status']   = $this->input->post('status',true);
			$res['name']     = $this->input->post('name',true);
			$res['price']    = $this->input->post('price',true);
			//返回结果
			$this->ci_smarty->assign('re_f',$res);
		}

		//获取修改数据
		if(!empty($_POST['edit_id']))
		{
			//model
			$this->load->model('Base_Filing_model');
			
			//表单验证
			$this->load->library('MY_form_validation');		
			$this->form_validation->set_rules('name', '备案名称', 'required');
			$this->form_validation->set_rules('price', '备案价格', 'required');
			$this->form_validation->set_rules('status', '备案状态', 'required'); 
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
				$filing_arr = array();
				if ($this->input->post('tax_type',true) == '1') 
        		{
        			$filing_arr['name_par']   = $this->input->post('name',true);
        			$filing_arr['price_par']  = $this->input->post('price',true);
        			$filing_arr['status_par'] = $this->input->post('status',true);
        		}
        		elseif($this->input->post('tax_type',true) == '2')
        		{
        			$filing_arr['name_con']   = $this->input->post('name',true);
        			$filing_arr['price_con']  = $this->input->post('price',true);
        			$filing_arr['status_con'] = $this->input->post('status',true);
        		}

				//判断数据是否存在 进行添加或者更新
				if ($this->Base_Filing_model->check_is_exist(array('id' => $this->input->post('edit_id',true)),$this->input->post('customs',true))) 
				{									
					$filing_arr['id'] = $this->input->post('edit_id',true);
					$flag = $this->Base_Filing_model->stock_filing_add($filing_arr,$this->input->post('customs',true));										
				}
				else
				{
					$flag = $this->Base_Filing_model->filing_uqdate($this->input->post('customs',true),$filing_arr,array('id' => $this->input->post('edit_id',true)));
				}
				if($flag == 1)
				{
					$msg = array(
						'msg'  => '操作成功',
						'type' => 2
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

		//载入页面
		$this->ci_smarty->display_ini('filing_update.htm');
	}
	
	//平台备案库 批量上传
	public function filing_upload()
	{
		
		if(isset($_FILES)&&!empty($_FILES))
		{
			@set_time_limit(0);
			//用户的断开，不终止脚本执行
			@ignore_user_abort(TRUE);
			
			//model
			$this->load->model('Base_Filing_model');
			//APPPATH."/cache/xls" 存放缓存xls文件的路径
			$da = $this->upload_xls(APPPATH."/cache/xls");
			/*
	            [1]  => 上传序号
	            [2]  => 商品中文名称
	            [3]  => 商品英文名称
	            [4]  => 条形码
	            [5]  => 商品简述
	            [6]  => 品牌（中文）
	            [7]  => 品牌（英文）
	            [8]  => 商品类别
	            [9]  => 产地
	            [10] => 长度（单位:厘米）
	            [11] => 宽度（单位:厘米）
	            [12] => 高度（单位:厘米）
	            [13] => 规格/型号（中文）
	            [14] => 规格/型号（英文）
	            [15] => 主要成份（中文）
	            [16] => 主要成份（英文）
	            [17] => 功能/用途（中文）
	            [18] => 功能/用途（英文）
	            [19] => 食品/非食品
	            [20] => 毛重（克）
	            [21] => 净重（克）
	            [22] => 行邮税编号
	            [23] => 行邮税税率
	            [24] => 综合税税率
	            [25] => 备案名称
	            [26] => 备案价格
	            [27] => 备案状态（1 未通过 2 备案中 3 已通过）
	        */
	        //验证提交内容
            if( !is_array( $da ) )
            {
            	$ar_url = array(site_url('filing/filing_upload') => '返回');
				usrl_back_msg( $da , $ar_url , $this->ci_smarty );
            }  
			//总共导入数据条数
			$data_num = count($da)-1;

			if(is_array($da))
			{
	            $stock_arr  = array();
	            $filing_arr = array();
	            $flag_all   = 0;
	            foreach ($da as $k => $v) 
	            {
	            	if ($k == 1) 
	            	{
	            		continue; 
	            	}

	            	//表 dferp_stock
	            	$stock_arr['upload_num'] = $v['1'];
            		$stock_arr['ch_name']    = $v['2'];
            		$stock_arr['en_name']    = $v['3'];
            		$stock_arr['barcode']    = $v['4'];
            		$stock_arr['desc']       = $v['5'];
            		$stock_arr['ch_brand']   = $v['6'];
            		$stock_arr['en_brand']   = $v['7'];
            		$stock_arr['catname']    = $v['8'];
            		$stock_arr['country']    = $v['9'];
            		$stock_arr['length']     = $v['10'];
            		$stock_arr['width']      = $v['11'];
            		$stock_arr['height']     = $v['12'];
            		$stock_arr['ch_spe']     = $v['13'];
            		$stock_arr['en_spe']     = $v['14'];
            		$stock_arr['ch_ing']     = $v['15'];
            		$stock_arr['en_ing']     = $v['16'];
            		$stock_arr['ch_pur']     = $v['17'];
            		$stock_arr['en_pur']     = $v['18'];
            		$stock_arr['type']       = $v['19'];
            		$stock_arr['gw']         = $v['20'];
            		$stock_arr['nw']         = $v['21'];
            		$stock_arr['customs']    = $this->input->post('customs',true);
            		$stock_arr['tax_type']   = $this->input->post('tax_type',true);
            		$stock_arr['tax_id']     = $v['22'];
            		$stock_arr['par_tax']    = $v['23'];
            		$stock_arr['con_tax']    = $v['24'];
            		
					
					//类型ID
					if(!empty($stock_arr['catname']))
					{
						$row=$this->db->query("select  id  from  ".tab_m('stock_cat')."  where  cat  like '%".mysql_escape_string($stock_arr['catname'])."%' limit 1  ")->row_array();
						$stock_arr['catid']=$row['id'];
					}
					
					//国家ID
					if(!empty($stock_arr['country']))
					{
						$row=$this->db->query("select c_id from ".tab_m('country')."  where  c_name like '%".mysql_escape_string($stock_arr['country'])."%' limit 1  ")->row_array();
						$stock_arr['countryid']=$row['c_id'];
					}
					
            		//表 dferp_stock_filing
            		if ($this->input->post('tax_type',true) == '1') 
            		{
            			$filing_arr['name_par']   = $v['25'];
            			$filing_arr['price_par']  = $v['26'];
            			$filing_arr['status_par'] = $v['27'];
            		}
            		elseif($this->input->post('tax_type',true) == '2')
            		{
            			$filing_arr['name_con']   = $v['25'];
            			$filing_arr['price_con']  = $v['26'];
            			$filing_arr['status_con'] = $v['27'];
            		}

	            	//插入前 查询上传序号是否存在 存在则更新修改数据
	            	if ($this->Base_Filing_model->check_is_repeat(array('upload_num' => $v['1']))) 
	            	{
	            		//添加到表dferp_stock，返回id
	            		$id = $this->Base_Filing_model->stock_add($stock_arr);
	            		if ($id != '0') 
	            		{
		            		$filing_arr['id'] = $id;
		            		$flag = $this->Base_Filing_model->stock_filing_add($filing_arr,$this->input->post('customs',true));	
		            		if ($flag == 1) 
		            		{
		            			$flag_all++;
		            		}
	            		}
	            	}
	            	else
	            	{
	            		//根据上传序号查询商品id
	            		$row = $this->Base_Filing_model->get_stock_id( $v['1'] );
	            		$id = $row['id'];
	            		//更新表 dferp_stock	      
	            		$flag_update = $this->Base_Filing_model->stock_uqdate( $stock_arr,array('id'=>$id) );

	            		if ( $flag_update ) 
	            		{
	            			//查询备案是否存在 存在更新备案 不存在添加新的备案
		            		if ( $this->Base_Filing_model->check_filing_isexist( $this->input->post('customs',true),array('id'=>$id) ) ) 
		            		{
			        			$filing_arr['id'] = $id;
			            		$flag = $this->Base_Filing_model->stock_filing_add($filing_arr,$this->input->post('customs',true));	
			            		if ($flag == 1) 
			            		{
			            			$flag_all++;
			            		}
		            		}
		            		else
		            		{
		            			$flag = $this->Base_Filing_model->filing_uqdate( $this->input->post('customs',true),$filing_arr,array('id'=>$id) );
		            			if ($flag == 1) 
			            		{
			            			$flag_all++;
			            		}
		            		}
	            		}
	            		
	            	}							            			            			
	            }
	            if ($flag_all == $data_num) 
        		{
        			$ar_url = array(site_url('filing/filing_upload') => '返回');
					usrl_back_msg('导入成功，一共导入'.$data_num.'条数据',$ar_url, $this->ci_smarty);
        		}
        		elseif($flag_all == 0)
        		{
        			$ar_url = array(site_url('filing/filing_upload') => '返回');
					usrl_back_msg('导入失败',$ar_url, $this->ci_smarty);
        		}
        		else
        		{
        			$ar_url = array(site_url('filing/filing_upload') => '返回');
					usrl_back_msg('导入成功，有'.($data_num-$flag_all).'条数据重复无法导入',$ar_url, $this->ci_smarty);
        		}
			}
		}

		//关区
		$res = array();
		require(APPPATH.'/config/base_config.php');
		$res['customs_list'] = $config['customs_list'];

		//返回结果
		$this->ci_smarty->assign('re',$res,1,'page');

		//载入页面
		$this->ci_smarty->display_ini('filing_upload.htm');
	}

	private function upload_xls($path)
	{
		setlocale(LC_ALL, 'en_US.UTF-8');
		if(!isset($_FILES['import_filing']['name']))
			return '未上传任何文件';
		if( $_FILES['import_filing']['name'] != 'filing.xls' )
			return '上传文件错误';	
		$namear=explode('.',$_FILES['import_filing']['name']);
		if($_FILES['import_filing']["size"]>1024*1024)
			return '导入文件不能超过1M';	
		if($namear[count($namear)-1]!='xls')
			return '导入文件非xls文件';	
		$f=0;
		$f1=$path."/".md5($this->user_id."import_filing").".xls";
		$do1 = copy($_FILES['import_filing']['tmp_name'],$f1);
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

}




