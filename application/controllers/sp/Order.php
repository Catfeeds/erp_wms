<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Order extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->load_sp_menu();  
	}
	
	
	//证件通过
	public function order_card()
	{
		if(is_array($_POST['item']))
		{
			foreach($_POST['item'] as $k=>$v)
			{
				$row=$this->db->select('card_status')->from(tab_m('order'))->where(array('id'=>$v*1,"userid"=>$this->user_id))->get()->row_array();
				if($row['card_status']==2)
				{
					$this->db->query("update    ".tab_m('order')."   set   card_status=3   where  id='".($v*1)."' ");
				}
			}
		}
	}
	
	//下载订单
	public function order_down_xls()
	{
		$this->load->library('CI_xls');
		
		$this->ci_xls->set_data(array(
				"导入订单号（不可重复）","收货人姓名","省","城市","区","收货地址","联系手机"
				,"身份证","（行邮税模式不填）支付单号"
				,"（行邮税模式不填）支付类型 (2 支付宝 3 微信支付 4 财付通 5 银联支付)"),1,1,'订单列表');
		$this->ci_xls->set_data(array("201612080001","张三","上海","上海","普陀区","XXX路XX号","1878222001","18位数"),2,1);

		$this->ci_xls->set_data(
			 array("导入订单号","商品编号（商品编号必须真实，备案通过的商品有效）","商品名称"
			 ,"英文名称","购买数量","当地申报价格"
			 ,"当地申报币种（英文简写）","实际单件重量 (fedex模式必填)","重量单位（ kg = 千克 ,lb = 磅 ） fedex模式必填"),1,2,'订单清单');
		
		$this->ci_xls->set_data(array("201612080001","产品1","product 1","1","","",""),2,2);
		$this->ci_xls->set_data(array("201612080001","产品2","product 2","1","","",""),3,2);
		$this->ci_xls->get_down_xls('订单上传');
	}
	
	//证件上传
	public function order_card_upload()
	{
		//获取原始数据
		if ( !empty( $_GET ) )
		{		
            $res = array();
			$import_id=$_POST['import_id']*1;
			$row=$this->db->select("id,import_id,consignee")
			          ->from(tab_m('order'))
			          ->where(array('id'=>$_GET['id']*1,'userid'=>$this->user_id))->get()->row_array();
					  
			if(empty($row))
				header("location:".site_url('order/order_list'));

			$res=$row;
			$res['auth_id']=md5($row['id'].config_item('cookie_authkey'));
			$res['id']=$row['id'];
			//返回结果
			$this->ci_smarty->assign('re',$res);
		}
		
		if(isset($_FILES)&&!empty($_FILES)&&!empty($_POST['id'])&&$_POST['auth_id']==md5($_POST['id'].config_item('cookie_authkey')))
		{
			//model
			$this->load->model('Base_Order_model');
			@set_time_limit(0);
			//用户的断开，不终止脚本执行
			@ignore_user_abort(TRUE);
			$da = $this->upload_img(APPPATH."/../web/pt_img/".$this->user_id."",$_POST['id']);

			if (is_array($da)) 
    		{
    			$order_arr = array(); 
				//判断3个文件存在
    			$order_arr['card_status']= 2;
				$this->Base_Order_model->update_order_info( $order_arr , array( 'id' => $_POST['id'] ) );
    			//$ar_url = array(site_url('order/order_list') => '返回');
				//usrl_back_msg('上传成功',$ar_url, $this->ci_smarty);		
    		}
    		else
    		{
    			//$ar_url = array(site_url('order/order_list') => '返回');
				//usrl_back_msg('上传失败',$ar_url, $this->ci_smarty);
    		}
			header("location:".site_url('order/order_list'));
			
		}
		
		if(!empty($_POST))
		{
			$ar_url = array(site_url('order/order_list') => '返回');
			usrl_back_msg('上传失败',$ar_url, $this->ci_smarty);
		}
		
		//载入页面
		$this->ci_smarty->display('order_card_upload.htm');
	
	}
	
	//扫码生成订单
	public function order_upload_code()
	{
		
		//查询该用户的FedEx申报币种
		$sql = "SELECT `fedex_currency` FROM ".tab_m('sp_user')." WHERE id=".$this->user_id;
		$fedex_curreny=$this->db->query($sql)->row_array();

		//查询用户下  没有审核的批次
		$batches=$this->db->query("select  batches_name ,id   from   ".tab_m('batches')."    where     userid='".$this->user_id."'   and  status<=2  and `confirm_status`=0 ")->result_array();

		$this->ci_smarty->assign('batches',$batches);
		$this->ci_smarty->assign('fedex_currency',$fedex_curreny['fedex_currency']);
		$this->ci_smarty->display_ini('order_upload_code.htm');
	}
	
	

	private  function rmkdir($path, $mode = 0755) {
		$path = rtrim(preg_replace(array("/\\\\/", "/\/{2,}/"), "/", $path), "/");
		$e = explode("/", ltrim($path, "/"));
		if(substr($path, 0, 1) == "/") {
			$e[0] = "/".$e[0];
		}
		$c = count($e);
		$cp = $e[0];
		for($i = 1; $i < $c; $i++) {
			if(!is_dir($cp) && !@mkdir($cp, $mode)) {
				return false;
			}
			$cp .= "/".$e[$i];
		}
		return @mkdir($path, $mode);
	}

	private function upload_img($path,$order_id)
	{
        if( !(!empty($_FILES['upload_card_1']['tmp_name'])||!empty( $_FILES['upload_card_2']['tmp_name'])||!empty( $_FILES['upload_xiaopian']['tmp_name'])))
			return '未上传任何文件';	
	
	     $this->rmkdir($path);
		$file_tag=array("png","jpg","jpeg","gif","bmp");
		if(!empty($_FILES['upload_card_1']['tmp_name']))
		{
			if($_FILES['upload_card_1']["size"] > 1024*1024)
				return '身份证正面超过1M';
			$exp1 = explode('.',$_FILES['upload_card_1']['name']);
			$file_extension_1 = $exp1[count($exp1)-1];
			if(!in_array($file_extension_1,$file_tag))
				return '导入文件非'.implode(" | ",$file_tag).'文件';
				
			$f1 = $path."/".$order_id."_".md5("zjx_".$order_id)."_card_1";
			$do1 = copy($_FILES['upload_card_1']['tmp_name'],$f1.".jpg");
		}
		
		if(!empty($_FILES['upload_card_2']['tmp_name']))
		{
			if($_FILES['upload_card_2']["size"] > 1024*1024)
				return '身份证反面超过1M';	
			$exp2 = explode('.',$_FILES['upload_card_2']['name']);
			$file_extension_2 = $exp2[count($exp2)-1];	
			if(!in_array($file_extension_2,$file_tag))
				return '导入文件非'.implode(" | ",$file_tag).'文件';
				
			$f2 = $path."/".$order_id."_".md5("zjx_".$order_id)."_card_2";
			$do2 = copy($_FILES['upload_card_2']['tmp_name'],$f2.".jpg");	
		}
		
		if(!empty($_FILES['upload_xiaopian']['tmp_name']))
		{
			if($_FILES['upload_xiaopian']["size"] > 1024*1024)
				return '小票超过1M';
			$exp3 = explode('.',$_FILES['upload_xiaopian']['name']);
			$file_extension_3 = $exp3[count($exp3)-1];	
			if(!in_array($file_extension_2,$file_tag))
				return '导入文件非'.implode(" | ",$file_tag).'文件';
				
			$f3 = $path."/".$order_id."_".md5("zjx_".$order_id)."_xiaopian";
			$do3 = copy($_FILES['upload_xiaopian']['tmp_name'],$f3.".jpg");	
		}
		unset($_FILES);
		return array();
	}

	//删除订单
	/**
	 *  删除订单,就是将订单状态改为-1，批次id改为-1
	 *  只有订单状态为待审核状态（1）时,可以删除
	 *
	 */
	public function order_del()
	{
		if(is_array($_POST['item']))
		{

			$change=1;//标记 是否删除该订单
			foreach($_POST['item'] as $k=>$v)
			{
				$row=$this->db->select('status,batches_id')->from(tab_m('order'))->where(array('id'=>$v*1,"userid"=>$this->user_id))->get()->row_array();
				//判断批次是否已经被确认？批次是否被审核？
				$row1=$this->db->query("SELECT `status`,`confirm_status` FROM ".tab_m('batches')." WHERE id=".$row['batches_id'])->row_array();

				if($row['status']==1 && $row1['status']<=2 && $row1['comfirm_status']==0)
				{
					$this->db->query("update ".tab_m('order')."   set  status=-1,batches_id=-1   where  id='".($v*1)."'  and status=1 ");
					$change=2;
				}
				if($change==2)
				{
					//将批次下订单数目减去1
					$this->db->query("UPDATE ".tab_m('batches')." SET `order_num`=`order_num`-1 WHERE id=".$row['batches_id']);

					//判断该批次下是否还有订单
					$sql="SELECT `id` FROM ".tab_m('order')." WHERE `batches_id`=".$row['batches_id'];
					$res=$this->db->query($sql)->result_array();
					if(empty($res)){
						$this->db->query("UPDATE ".tab_m('batches')." SET `status`=1 WHERE id=".$row['batches_id']);
					}
					$change=1;
				}

			}
		}
	}
	
	
	//订单打印
	public function order_ems_point()
	{

		if($_GET['ids'])
		{
			$sql="select * from ".tab_m('order')."  where  id in (".$_GET['ids'].")  order by id asc";
			$ore= $this->db->query($sql)->result_array();
			foreach($ore as $k=>$v)
			{
				$row=$this->db->query("select  name,num  from  ".tab_m('order_list')."   where   order_id='".$v['id']."' ")->result_array();
				foreach($row as $kk=>$vv)
					$ore[$k]['con'].=(empty($ore[$k]['con'])?'':' , ').$vv['name']."*".$vv['num'];
			}
			
			$this->ci_smarty->assign("re",$ore);
			//$ems="邮政报关部,028-85885850";
			//$ems="成都市双流航空港黄河中路一段149号";
			//$sql="select company,mobile  from   ".tab_m('sp_user')."   where  id=".$this->user_id;
			//$de= $this->db->query($sql)->result_array();
		    //$this->ci_smarty->assign("member",$de);
			$this->ci_smarty->assign("time",date('Y').",".date('m').",".date('d'));
			$this->ci_smarty->assign("config",$config);
			$this->ci_smarty->assign("lang",$lang);
			$this->ci_smarty->display("ems_point.htm");
		}
		else
		{
			$ar_url=array(site_url('order/order_list') => '返回');
			usrl_back_msg('无任何订单数据',$ar_url, $this->ci_smarty);
		}
	}

	//订单管理 列表
	public function order_list()
	{         
        //model
		$this->load->model('Base_Order_model');
      
		//搜索
		$key      = array('status!='=>-1);
		$key_like = array();

		//只显示会员订单
		$key['userid'] = $this->user_id;

		if(isset($_GET))
		{
			//非模糊字段 搜索
			$search_key      = array('import_id','batches_id','status','card_status');
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
					if($skey=='status' && $v==-1)
					{

						$key=array_remove($key,'status!=');
						$key['status']=$v;
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
			$this->ci_page->totalRows = $this->Base_Order_model->order_list_rows($key,$key_like);
		}
		 
		//列表
		$res = array();
		$res['page'] = $this->ci_page->prompt();
		$res['list'] = $this->Base_Order_model->order_list(
			'*',
			'id',
			'DESC',
			$this->ci_page->listRows,
			$this->ci_page->firstRow,
			$key,
			$key_like
		);
		
		//加入商品信息
		foreach ($res['list'] as $k => $v) 
		{
			$row = $this->Base_Order_model->order_list_list('*',array('order_id' => $v['id']));
			$res['list'][$k]['order_list'] = $row;
		}
		
		//是否是行邮税
		$res['filing_kjt_type']=$this->base_filing_kjt_type;
		$this->ci_smarty->assign('re',$res,1,'page');
		//载入页面
		$this->ci_smarty->display_ini('order_list.htm');

	}

	//订单上传
	public function order_upload()
	{
		if(isset($_FILES)&&!empty($_FILES))
		{
			
			@set_time_limit(0);
			//用户的断开，不终止脚本执行
			@ignore_user_abort(TRUE);
			
			//model
			$this->load->model('Base_Order_model');
			$this->load->model('Base_Batches_model');
			$this->load->model('Base_District_model');
			
			$da = $this->upload_xls(APPPATH."/cache/xls");
			
			/*
	            [order] 订单
		            [1]  => 订单编码（导入订单号）
	                [2]  => 收货人姓名
	                [3]  => 省
	                [4]  => 市
	                [5]  => 区
	                [6]  => 收货地址
	                [7]  => 联系手机
	                [8]  => 身份证
	                [9]  => (暂时为空)支付单号
	                [10] => (暂时为空)支付类型 (2 支付宝 3 微信支付 4 财付通 5 银联支付)

	            [list] 清单
	            	[1]  => 订单编号（导入订单号）
                    [2]  => 商品编号
                    [3]  => 商品名称（导入商品名称）
                    [4]  => 英文名称
                    [5]  => 购买数量
                    [6]  => 当地申报价格
                    [7]  => 当地申报币种（英文简写）
                    [8]  => 实际单件重量
                    [9]  => 重量单位（kg=千克,lb=磅）
	        */
            //验证提交内容

            if ( !is_array( $da ) )
            {
            	$this->back_msg( $da );
            }       
			if ( count($da['order']) <= 1 )
			{
				$this->back_msg('订单文件无效');
			}
			if ( count($da['list']) <= 1 )
			{
				$this->back_msg('清单文件无效');
			}
			if($this->Base_Order_model->check_act_pass(array('id' => $this->user_id),$this->input->post('act_pass',true)))
			{
				$this->back_msg('操作密码错误');
			}

            //总共导入数据条数（订单数）
           	$data_num = count($da['order'])-1;
			if(is_array($da))
			{
	            //导入 表order 数据
	            $order_arr = array();
	            //导入 表order_list 数据
	            $list_arr  = array();
	            //记录重复上传序号
	            $import_id_arr  = array();
	            //计数 导入一条数据成功
	            $flag_all = 0;
				
				//=============导入数据检查==============
				$ords=array();
				$order_list_array=array();
				foreach($da['order'] as $k => $v) 
				{
					if ($k == 1) 
	            	{
	            		continue; 
	            	}

					for($a=1;$a<18;$a++)
					{
						$b=!empty($v[$a])?$v[$a]:'';
						$b=str_ireplace("\\'",'',$b);
						$b=str_ireplace("\\，",'',$b);
						$b=str_ireplace("'",'',$b);
						$b=str_ireplace("’",'',$b);
						$b=str_ireplace(" ",'',$b);
						$v[$a]=trim($b);
					}
					
					if(empty($v[1]))
						break;
					
					//检查收货地址
					$addr=$this->Base_District_model->check_addrtcode($v['3'].','.$v['4'].','.$v['5']);
					$province_id=$addr[0][0];
					if(!is_array($addr))
					{
						$this->back_msg('订单行--【'.$k.'】,'.$addr);
					}
					
					//订单号无效
					if($this->check_api_name(1,$v[1])===false)
					{
						$this->back_msg('订单行--【'.$k.'】,订单编号只能是英文和数字');
					}
					
					//身份证号
					if($this->check_api_name(3,$v[8])===false)
					{
						$this->back_msg('订单行--【'.$k.'】,身份证错误'.$v[8]);
					}
					
					if(!empty($ords[$v[1]]))
					{
						$this->back_msg('订单行--【'.$k.'】导入订单号'.$v[1].'出现两次');
					}
					$ords[$v[1]]=1;
					
					$row=$this->db->select('id')->from(tab_m('order'))->where(array('userid'=>$this->user_id,'import_id'=>$v['1']))->get()->row_array();
					if(!empty($row))
				   		 $this->back_msg('订单行--【'.$k.'】导入订单号'.$v[1].'已经存在');
				
					
					$userid            = $this->user_id;
					$import_id         = $v['1'];
					$batches_id        = $_POST['batches_id']*1?$_POST['batches_id']*1:'-1';	
					$consignee         = mysql_real_escape_string($v['2']);
					$province          = mysql_real_escape_string($v['3']);
					$city              = mysql_real_escape_string($v['4']);
					$area              = mysql_real_escape_string($v['5']);
					$consignee_address = mysql_real_escape_string($v['6']);
					$consignee_mobile  = mysql_real_escape_string($v['7']);
					$province_id       = $province_id;
					$card_no           = mysql_real_escape_string($v['8']);
					$add_time          = date('Y-m-d H:i:s');
					$order_array_list[]="('$userid','$import_id','$batches_id','$consignee','$province','$province_id','$city','$area','$consignee_address'
					,'$consignee_mobile','$card_no','0','$add_time') ";	
				} 
				 
				//
				$pro_array=array(); 
				$pwsql='';
				$pwsql_str=array();

				foreach ($da['list'] as $k => $v) 
				{
					if ($k == 1) 
	            	{
	            		continue; 
	            	}
					
					for($a=1;$a<13;$a++)
					{
						$b=!empty($v[$a])?$v[$a]:'';
						$b=str_ireplace("\\'",'',$b);
						$b=str_ireplace("\\，",'',$b);
						$b=str_ireplace("'",'',$b);
						$b=str_ireplace("’",'',$b);
						$b=str_ireplace(" ",'',$b);
						$v[$a]=trim($b);
					}
					
					if(empty($v[1]))
						break;

					//关区类型
					$filing_type=$this->base_filing_type;
					//交税类型
					$filing_kjt_type=$this->base_filing_kjt_type;
					if ($this->base_filing_kjt_type==1)
					{
						$field=',b.name_par as hg_name,b.price_par  as hg_price ,b.status_par as hg_status';
						$tax_rate='par_tax';
					}
					else
					{
						$field=',b.name_con as hg_name,b.price_con as hg_price,b.status_con as hg_status';
						$tax_rate='con_tax';
					}

					$stock_info=$this->Base_Order_model->get_stock_info1( 'a.*'.$field,$filing_type,$v['2']);
					if(empty($stock_info)||($stock_info['tax_type']==1&&$stock_info['hg_status']!=3)||($stock_info['tax_type']==2&&$stock_info['hg_status']!=3))
					{	
						$this->back_msg('订单产品行--【'.$k.'】,产品未备案');
					}
					
					if(!empty($ords[$v[1]]))	
						$ords[$v[1]]+=1;
					else
						$this->back_msg('订单产品行--【'.$k.'】,无匹配订单'."--".$v[1].var_export($ords,true));
					
					//匹配订单产品是否重复	
					if(empty($pro_array[$v[1]."_".$v[2]]))	
				    	$pro_array[$v[1]."_".$v[2]]=1;		
					else
						$this->back_msg('订单产品行--【'.$k.'】,同一个订单中产品重复');	
						
					$val['1']=mysql_real_escape_string($v['1']);
					$val['2']=mysql_real_escape_string($v['2']);
					$val['3']=mysql_real_escape_string($v['3']);	
					$stock_info['ch_name']=mysql_real_escape_string($stock_info['ch_name']);
					$val['4']=mysql_real_escape_string($v['4']);	
					$val['5']=$v['5']*1;
					$val['6']=mysql_real_escape_string($v['6']);
					$val['7']=mysql_real_escape_string($v['7']);
					$val['8']=mysql_real_escape_string($v['8']);
					$val['9']=mysql_real_escape_string($v['9']);
					$pwsql[$v['1']]=1;	
					
					$pwsql_str[]="('".$this->user_id."','".$val['1']."','".$val['2']."','0','".$stock_info['ch_name']."','".$val['3']."','".$stock_info['gw']."','".$val['4']."','".$val['5']."','".$val['6']."','".$val['7']."','".$val['8']."','".$val['9']."')";	
					
					$ords[$v[1]."_w"]+=$stock_info['gw']*$val['5'];
					$ords[$v[1]."_num"]+=$val['5'];
				}

				$ords_ids=array();
				foreach($ords as $k=>$v)
				{
					$ar=explode('_',$k);
					if(count($ar)==1)
					{
						if(empty($pwsql[$k]))	
						{
							$this->back_msg('订单--【'.$k.'】无匹配产品');	
						}
						$ords_ids[]=$k;
					}
				}

				$sql="INSERT INTO `dferp_order`(`userid`, `import_id`, `batches_id`, `consignee`, `province`, `province_id`, `city`,
				      `area`,`consignee_address`, `consignee_mobile`,`card_no`, `total_weight`, `add_time`) 
				VALUES ".implode(',',$order_array_list);
				$nums=$this->db->query($sql);
				
				unset($order_array_list);
				$sql="INSERT INTO `dferp_order_list`(`userid`,`import_id`, `stock_id`,`order_id`,`name`, `im_name`, `weight`,`name_en`, `num`, `abroad_price`, `abroad_currency`, `abroad_weight`, `abroad_weight_unit`) 
				       VALUES ".implode(',',$pwsql_str);
				$num=$this->db->query($sql);
				
				foreach($ords_ids as $im_order_id)
				{
					$row=$this->db->select('id')->from(tab_m('order'))->where(array('userid'=>$this->user_id,'import_id'=>$im_order_id))->get()->row_array();
					$this->db->query("update  ".tab_m('order_list')."  set   order_id='".$row['id']."'  where   userid='"
					                 .$this->user_id."'  and  import_id='".$im_order_id."' "); 
					$this->db->query("update  ".tab_m('order')."  set   total_weight='".$ords[$im_order_id."_w"]."',total_num='".$ords[$im_order_id."_num"]."'    where   id='".$row['id']."' ");				 
				}
				//查询该批次号下的订单数量，然后更新批次
			    $order_num = $this->Base_Order_model->order_list_rows(array( 'batches_id' => $batches_id),'');
			    $this->Base_Batches_model->batches_uqdate( array( 'order_num' => $order_num , 'status' => 2 , 'tax_status' => 2 , 'freight_status' => 2 ) , array( 'id' => $batches_id ) );
			    $this->back_msg('导入成功，有'.(count($ords)/3).'条数据导入成功');   
			}
		}

		$batches=$this->db->query("select  batches_name as name,id   from   ".tab_m('batches')."    where     userid='".$this->user_id."'   and  status<=2   ")->result_array();
		$this->ci_smarty->assign('batches',$batches);
		
		//载入页面
		$this->ci_smarty->display_ini('order_upload.htm');

	}
	
	private function check_api_name($num,$str)
	{	
	    if($num==1) 	
			return !preg_match("/^[a-z0-9A-Z]{1,32}$/ix", $str) ? FALSE : TRUE;
			
		if($num==2)//大于0的数字
			return is_numeric($str)&&$str>0;
			
		$City = array(11=>"北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",21=>"辽宁",22=>"吉林",23=>"黑龙江",31=>"上海",32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",46=>"海南",50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",71=>"台湾",81=>"香港",82=>"澳门",91=>"国外");

		if($num==3)   //身份证
		{
			$arrExp = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);//加权因子  
			$arrValid = array(1, 0,'x', 9, 8, 7, 6, 5, 4, 3, 2,1, 0,'x', 9, 8, 7, 6, 5, 4, 3, 2);//校验码  
			$sum = 0;  
			for($j=0;$j<17;$j++)
			{
				$sum += ($str[$j]+10) * $arrExp[$j];  
			}
			// 计算模（固定算法）  
			$idx = $sum % 11;  
			// 检验第18为是否与校验码相等
			$falg=$arrValid[$idx+1].""===strtolower(substr($str,17,1)).""?true:false; 
			
			return ( !preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/",$str)
			||!array_key_exists(substr($str,0,2),$City))||!$falg?FALSE:TRUE;
		}
		
		if($num==4) //手机
			return ( !preg_match("/^1[1-9]{1}[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$str))?FALSE:TRUE; 
			
		if($num==5) 
			return ( !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
			
		return true;	
	}
    
	public function add_new_batches()
	{
		$this->load->model('Base_Supplier_model');
		$huoyunzhan_id=$this->Base_Supplier_model->get_sp_user_info('huoyunzhan_uid',array('id'=>$this->user_id));
		if(!empty($huoyunzhan_id['huoyunzhan_uid'])){
			//生成新批次
			$this->db->query("insert into ".tab_m('batches')." ( `batches_name`, `userid`,`huoyunzhan_uid`) VALUES ('".date("Y年m月d日")."','".$this->user_id."','".$huoyunzhan_id['huoyunzhan_uid']."')");
		}else{
			//生成新批次
			$this->db->query("insert into ".tab_m('batches')." ( `batches_name`, `userid`) VALUES ('".date("Y年m月d日")."','".$this->user_id."')");

		}
		$ar_url = array(site_url('order/order_upload') => '返回');
		usrl_back_msg('批次添加成功',$ar_url, $this->ci_smarty);

	}

	public function add_new_batches1()
	{

		$this->load->model('Base_Supplier_model');
		$huoyunzhan_id=$this->Base_Supplier_model->get_sp_user_info('huoyunzhan_uid',array('id'=>$this->user_id));
		if(!empty($huoyunzhan_id['huoyunzhan_uid'])){
			//生成新批次
			$res=$this->db->query("insert into ".tab_m('batches')." ( `batches_name`, `userid`,`huoyunzhan_uid`) VALUES ('".date("Y年m月d日")."','".$this->user_id."','".$huoyunzhan_id['huoyunzhan_uid']."')");

		}else{
			//生成新批次
			$res=$this->db->query("insert into ".tab_m('batches')." ( `batches_name`, `userid`) VALUES ('".date("Y年m月d日")."','".$this->user_id."')");

		}

		if($res)
		{
			//查找所有批次
			$batches=$this->db->query("select  batches_name as name,id   from   ".tab_m('batches')."    where     userid='".$this->user_id."'   and  status<=2   ")->result_array();
			$msg = array(
				'msg'  => '批次生成成功',
				'type' => 2,
				'batches'=> json_encode($batches)
			);
			echo json_encode($msg);
			die;
		}
		else
		{

			$msg = array(
				'msg'  => '批次生成失败',
				'type' => 1
			);
			echo json_encode($msg);
			die;
		}


	}
	
	private function back_msg($msg)
	{
		$ar_url = array(site_url('order/order_upload') => '返回');
		usrl_back_msg($msg,$ar_url, $this->ci_smarty);
		die;
	}

	private function upload_xls($path)
	{
		setlocale(LC_ALL, 'en_US.UTF-8');
		if(!isset($_FILES['import_order']['name']) )
			return '未上传任何文件';
		$name_order = explode('.',$_FILES['import_order']['name']);
		if($_FILES['import_order']["size"] > 1024*1024)
			return '导入文件不能超过1M';
		if($name_order[count($name_order)-1] != 'xls')
			return '导入文件非xls文件';	
		$f = 0;
		$f1 = $path."/".md5($this->user_id."import_order").".xls";
		$do1 = copy($_FILES['import_order']['tmp_name'],$f1);	
		if($do1)
		{	
			$this->load->library('CI_xls');
			$import['order'] = $this->ci_xls-> get_data($f1,1);
			$import['list'] = $this->ci_xls-> get_data($f1,2);
			return $import;
		}
		else
			return "上传文件失败";
		
	}

	//扫码查询
	public function order_upload_barcode()
	{
		if(!empty($_POST))
		{	
			//model
			$this->load->model('Admin_Stock_model');
			$fields="id,ch_name,en_name,gw,barcode";


			$stock=array();
			foreach ($_POST['barcode'] as $k=>$v)
			{
				$stock[$k]=$this->Admin_Stock_model->get_stock($fields,array('barcode'=>$v));
			}
			$stock=array_filter($stock);
			if($stock)
			{
				$msg = array(
					'msg'  => '查询成功',
					'type' => 2,
					'stock'=> json_encode($stock)
				);
				echo json_encode($msg);
				die;
			}
			else
			{

				$msg = array(
					'msg'  => '查询无结果，请确认条形码',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}



		}
	}

	//扫码生成订单
	public function order_upload_barcode_done()
	{

		//model
		$this->load->model('Base_Order_model');
		$this->load->model('Base_Batches_model');
		$this->load->model('Base_District_model');
		if(!empty($_POST))
		{


			//检查是否有商品数据
			if(!empty($_POST['item']))
			{
				//验证
				//表单验证
				$this->load->library('MY_form_validation');
				$this->form_validation->set_rules('batches','批次信息','required');
				$this->form_validation->set_rules('abroad_weight_unit','FedEx重量单位','required');
				$this->form_validation->set_rules('consignee','收货人姓名','required');
				$this->form_validation->set_rules('card_no','身份证号码','required');
				$this->form_validation->set_rules('province','省','required');
				$this->form_validation->set_rules('city','市','required');
				$this->form_validation->set_rules('area','县区','required');
				$this->form_validation->set_rules('consignee_address','收货地址','required');

				//检查收货地址
				$addr=$this->Base_District_model->check_addrtcode($this->input->post('province',true).','.$this->input->post('city',true).','.$this->input->post('area',true));

				if(!is_array($addr))
				{
					$msg = array(
						'msg'  => $addr,
						'type' => 1
					);
					echo json_encode($msg);
					die;

				}
				$province_id=$addr[0][0];

				//身份证号
				if($this->check_api_name(3,$this->input->post('card_no',true))===false)
				{
					$msg = array(
						'msg'  => '身份证号码信息错误',
						'type' => 1
					);
					echo json_encode($msg);
					die;
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
					//导入订单号
					$order_arr['import_id']=date('YmdHis',time()).mt_rand(100000,999999);
					$order_arr['batches_id']=$this->input->post('batches',true);
					$order_arr['consignee']=$this->input->post('consignee',true);
					$order_arr['province']=$this->input->post('province',true);
					$order_arr['province_id']=$province_id;
					$order_arr['city']=$this->input->post('city',true);
					$order_arr['area']=$this->input->post('area',true);
					$order_arr['consignee_address']=$this->input->post('consignee_address',true);
					$order_arr['consignee_mobile']=$this->input->post('consignee_mobile',true);
					$order_arr['card_no']=$this->input->post('card_no',true);
					$order_arr['add_time']=dateformat(time());
					$order_arr['userid']=$this->user_id;


					$goods_arr=array();
					//关区类型
					$filing_type=$this->base_filing_type;
					//交税类型
					$filing_kjt_type=$this->base_filing_kjt_type;
					if ($this->base_filing_kjt_type==1)
					{
						$field=',b.name_par as hg_name,b.price_par  as hg_price ,b.status_par as hg_status';
						$tax_rate='par_tax';
					}
					else
					{
						$field=',b.name_con as hg_name,b.price_con as hg_price,b.status_con as hg_status';
						$tax_rate='con_tax';
					}

					if($this->input->post('abroad_weight_unit',true)=='KG')
					{
						$trans=0.001;
					}
					else
					{
						$trans=0.0022046;
					}

					foreach ($_POST['item'] as $k=>$v)
					{
						$goods_arr[$k]=$this->Base_Order_model->get_stock_info1( 'a.*'.$field,$filing_type,$v);

						$goods_arr[$k]['abroad_weight_unit']=$this->input->post('abroad_weight_unit',true);



					}

					foreach ($goods_arr as $k=>$v)
					{
						if(empty($_POST['local_price'][$k]))
						{
							$msg = array(
								'msg'  => '请填写商品的当地申报价',
								'type' => 1
							);
							echo json_encode($msg);
							die;
						}
						else{
							$goods_arr[$k]['num']=($_POST['num'][$k]<=0 ) ? 1 : $_POST['num'][$k];
							$goods_arr[$k]['abroad_price']=$_POST['local_price'][$k];
							$goods_arr[$k]['abroad_weight']=bcmul($v['gw'],$trans,3);
							$goods_arr[$k]['abroad_currency']=$_POST['currency'][$k];
						}

					}


					$order_arr['total_price'] =0.00;
					$order_arr['total_rate']  =0.00;
					$order_arr['total_weight']=0;
					$order_arr['total_num']   =0;
					//计算总价  总税  总重  总数
					foreach ($goods_arr as $k=>$v)
					{
						$order_arr['total_price'] +=$v['hg_price']*$v['num'];
						$order_arr['total_rate']  +=$v[$tax_rate]*$v['hg_price']*$v['num'];
						$order_arr['total_weight']+=$v['gw']*$v['num'];
						$order_arr['total_num']   +=$v['num'];
					}

					

					//添加订单
					$this->db->insert(tab_m('order'),$order_arr);
					$order_id=$this->db->insert_id();

					//添加订单列表
					$order_list_arr=array();
					foreach($goods_arr as $k=>$v)
					{
						$order_list_arr[$k]['userid']=$this->user_id;
						$order_list_arr[$k]['import_id']=$order_arr['import_id'];
						$order_list_arr[$k]['stock_id']=$v['id'];
						$order_list_arr[$k]['order_id']=$order_id;
						$order_list_arr[$k]['name']=$v['ch_name'];
						$order_list_arr[$k]['price']=$v['hg_price'];
						$order_list_arr[$k]['rate']=$v['hg_price']*$v[$tax_rate];
						$order_list_arr[$k]['weight']=$v['gw'];
						$order_list_arr[$k]['num']=$v['num'];
						$order_list_arr[$k]['abroad_price']=$v['abroad_price'];
						$order_list_arr[$k]['abroad_currency']=$v['abroad_currency'];
						$order_list_arr[$k]['abroad_weight']=$v['abroad_weight'];
						$order_list_arr[$k]['abroad_weight_unit']=$v['abroad_weight_unit'];
						$order_list_arr[$k]['name_en']=$v['en_name'];

					}

					//添加订单列表
					$this->db->insert_batch(tab_m('order_list'),$order_list_arr);

					//添加批次
					$this->db->where('id',$this->input->post('batches',true));
					$this->db->set('order_num',"order_num+1",FALSE);
					$this->db->set('status',2);
					$res=$this->db->update(tab_m('batches'));

					if($res)
					{
						$msg = array(
							'msg'  => '生成订单成功',
							'type' => 2,
							'stock'=> json_encode($stock)
						);
						echo json_encode($msg);
						die;
					}
					else
					{

						$msg = array(
							'msg'  => '生成订单失败',
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
					'msg'  => '请选择商品后，生成订单',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}






		}
	}

}