<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Filing extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->load_sp_menu(); 
	}

	//平台备案库
	
	//平台备案库 列表
	public function filing_list()
	{
		//model
		$this->load->model('Base_Filing_model');

		//搜索
		$key      = array();
		$key_like = array();
		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('status','country','customs','barcode');
			//模糊字段 搜索
			$search_key_like = array('ch_name','ch_brand');
			
			$search_b_key   = array('status_par','status_con');
			
			if($_GET['search_hg_status']!=-1)
			{
				if ($this->base_filing_kjt_type==1) 
					$_GET['search_status_par']=$_GET['search_hg_status'];
				else
					$_GET['search_status_con']=$_GET['search_hg_status'];
			}
			else
			{
				if ($this->base_filing_kjt_type==1) 
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
			$this->ci_page->totalRows = $this->Base_Filing_model->get_filing_type_list_nums($this->base_filing_type,$this->base_filing_kjt_type,$key ,$key_like);
		}
		
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$field='';
		
		if ($this->base_filing_kjt_type==1) 
			$field=',b.name_par as hg_name,b.price_par  as hg_price ,b.status_par as hg_status';
		else
			$field=',b.name_con as hg_name,b.price_con as hg_price,b.status_con as hg_status';
	    
		$limit=array(
					0=>$this->ci_page->firstRow,
					1=>$this->ci_page->listRows
			   );
		
		$res['list'] = $this->Base_Filing_model->get_filing_type_list('a.* '.$field
					   ,$this->base_filing_type
					   ,$this->base_filing_kjt_type
					   ,$key,$key_like,$limit," a.id  desc");
					   		   
		$res['filing_type']=f_get_status($this->base_filing_type,'customs_list');
		$res['filing_kjt_type']=f_get_status($this->base_filing_kjt_type,'customs_rate_type');
		if(isset($_GET['down']))
		{
			$str="商品编号,商品中文名称,商品英文名称,条形码,备案价格,千克,磅";
			$ar=explode(',',$str);

			$ar_list=array();
			foreach($res['list'] as $k=>$v)
			{
				$ar_list[$k][]=$v['id'];
				$ar_list[$k][]=$v['ch_name'];
				$ar_list[$k][]=$v['en_name'];
				$ar_list[$k][]=$v['barcode'];
				$ar_list[$k][]=$v['hg_price'];
				$ar_list[$k][]=bcdiv($v['gw'],1000,3);
				$ar_list[$k][]=bcmul($v['gw'],0.0022046,2);
			}

			get_explode_xls($ar,$ar_list,'备案库存');


			die;
		}
		
		//获取商品类别、商品产地选项
		$this->load->model('Base_Cat_model');
		$res['cat'] = $this->Base_Cat_model->get_cat_all();
		$this->load->model('Base_Country_model');
		$res['country'] = $this->Base_Country_model->get_open_country();

		//返回结果
		$this->ci_smarty->assign('re',$res,0);

		//载入页面
		$this->ci_smarty->display_ini('filing_list.htm');

	}

}




