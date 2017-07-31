<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('erp_tb_product'))
{

	/*
		$data['stime']="20160719"; //开始时间 查询今天0点开始的时间
		$data['startlimit']=1; //开始页面
		$data['startlimit']=1; //开始页面
		erp_tb_product('search.productlist',$data);	
	*/
	
	function erp_tb_product($mothed,$data)
	{
		$post['sellerid']='2'; //渠道ID   必填
		$pass='a123456';
		$post['time']=time(); //时间戳  必填
		$post['num']=rand(1000,9999); //随机数  必填
		$post['method']=$mothed; //渠道ID  必填
		$post['data']=json_encode($data);
		$post['sign']=md5($post['sellerid'].$post['data'].$post['time'].$post['num'].$pass); //渠道ID  必填
		$post['data']=authcode($post['data'],'ENCODE',0,'zjx_ls'.$post['sellerid'].$post['time'].$post['num']);
		$d=http_post('http://www.test-zjh_product.com/spapi/zjx_51jiancang.php',$post);
		return $d;
	}
}

if ( ! function_exists('http_post'))
{
	//抓取数据
	function http_post($url,$ps)
	{
		$data = http_build_query($ps);  
		$opts = array(  
		 'http'=>array(  
		   'method'=>"POST",  
		   'header'=>"Content-type: application/x-www-form-urlencoded\r\n".  
					 "Content-length:".strlen($data)."\r\n" .   
					 "Cookie: foo=bar\r\n" .   
					 "\r\n",  
		   'content' => $data,  
		 )  
		);

		$cxContext = stream_context_create($opts);  
		$sFile = file_get_contents($url, false, $cxContext);
		return json_decode($sFile,true);
	}
}

if ( ! function_exists('get_explode_xls'))
{
	function get_explode_xls($xls_title,$xls_value=array(),$name='',$list_ar=array())
	{
		$CI = & get_instance();		
		$CI->load->library('CI_xls'); 
		$title=array();
		foreach($xls_title as $v)
		{
			$title[]=$v;
		}
		$CI->ci_xls->set_data($title,1,1,$name);
		if(!empty($xls_value))
		{
			$j=1;
			foreach($xls_value as $k=>$v)
			{
				$ar_v=array();
				foreach($v as $kfield=>$vv)
				{
					$ar_v[]=$vv;
				}
				$CI->ci_xls->set_data($ar_v,($j+1),1);
				$j++;
			}
		}
		else
		{
			$CI->ci_xls->set_data(array(1),2,1);
			$CI->ci_xls->set_data(array(2),3,1);
		}
		
		//第2表格是否存在
		
		$j=2;
		//第2个表格名称//数据//标题 
		/*   
		   $list_ar=array(
				0=>array(
					'收货人'
					,array(0=>array('name'=>'张三'))
					,array(a=>'姓名')
				)
			)
		*/	
		foreach($list_ar as $data)
		{
			//$data[0] string;//下一个表格下方名称
			//$data[1] array;//下一个表格数据内容
			//$data[2] array;//下一个表格数据标题
			//标题标题及下方名称
			$ar_v=array();
			//添加标题
			foreach($data[2] as $kfield=>$vv)
			{
				$ar_v[]=$vv;
			}
			//当前表开始行
			$j_data=1;
			$CI->ci_xls->set_data($ar_v,$j_data,$j,$data[0]);
			$j_data++;
			//添加数据
			foreach($data[1] as $vv)
			{
				$ar_v=array();
				foreach($vv as $kk=>$v)
				{
					$ar_v[]=$v;
				}
				$CI->ci_xls->set_data($ar_v,$j_data,$j);
				$j_data++;
			}
			//表格数据
			$j++;
		}
		
		
		
		$CI->ci_xls->get_down_xls($name);
		
		die;
		if(count($xls_value)>5000)
		{
			echo '导出内容不能大于5000条数';
			die;
		}
		
		header('Content-Type: text/html; charset=utf-8');
		header ( "Content-type:application/vnd.ms-excel" );
		header ( "Content-Disposition:filename=".$name.".xls" );
		$str="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			<title></title></head>";
		$str.="<body><table border='1'><tr><td>".implode('</td><td>',$xls_title)."</td></tr>";
		foreach($xls_value as $v)
		{
			$str.="<tr><td>".implode('</td><td>',$v)."</td></tr>";
		}
		$str.="</table></body></html>";
		echo $str;
		die;
	}
}
//传递数据以易于阅读的样式格式化后输出
if( ! function_exists('p'))
{
	function p($data){
		// 定义样式
		$str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
		// 如果是boolean或者null直接显示文字；否则print
		if (is_bool($data)) {
			$show_data=$data ? 'true' : 'false';
		}elseif (is_null($data)) {
			$show_data='null';
		}else{
			$show_data=print_r($data,true);
		}
		$str.=$show_data;
		$str.='</pre>';
		echo $str;
	}
}

if ( ! function_exists('admin_to_login'))
{
	function admin_to_login($id)
	{
		if(!empty($id))
		$tm=time();
		return "/index.php/user/login"."?id=".$id."&auth=".md5($id."zjx_11asd".$tm."zjx_oo7")."&tm=".$tm;
	}
}


if ( ! function_exists('get_xlsdata'))
{
	//xls上传	
	function get_xlsdata($filename,$f=0)
	{
		global $config;
		if(!class_exists('Spreadsheet_Excel_Reader'))
			require APPPATH.'/libraries/xls/reader.php';	
			
		$data = new Spreadsheet_Excel_Reader ();
		$data->setOutputEncoding('gbk');
		$data->read($filename);
		$d=$data->sheets [$f];
		for($i = 1; $i <=  $d['numRows']; $i ++) {
			for($j = 1; $j <= $d['numCols']; $j ++) {
				if(isset($d['cells'] [$i] [$j]))
				{
					$str=iconv("gbk","UTF-8//IGNORE",$d['cells'] [$i] [$j]);
					$d['cells'] [$i] [$j]=is_numeric($str)?$str:mysql_escape_string($str);
				}
			}
		}
		return $d['cells'];
	}
}

if( !  function_exists('get_img_auth') )
{
	function get_img_auth($name,$oid,$uid,$type=false,$get_file=false)
	{
		$imgpath='/pt_img/'.$uid.'/'.$oid."_".md5('zjx_'.$oid).'_'.$name.".jpg";
		if($type===false)
		{
			if(file_exists(APPPATH.'/../web'.$imgpath))
			{
				return ($get_file===false?config_item('base_url'):(APPPATH.'/../web')).$imgpath;
			}
			else
				return ($get_file===false?config_item('base_url'):(APPPATH.'/../web')).'/pt_img/default.png';
		}
		else
		{
			if(file_exists(APPPATH.'/../web'.$imgpath))
				return true;
			else
				return false;
		}
	}
}

if ( ! function_exists('get_product_image'))
{
	//获取主图
	function get_product_image($id='')
	{
		if(!empty($id))
		{
			if(file_exists(BASEPATH."/../web/pt_img/".$id.".jpg"))
				return config_item('base_url')."/pt_img/".$id.".jpg";
			else
				return config_item('base_url')."/pt_img/default.png";
		}
		else
			return config_item('base_url')."/pt_img/default.png";
	}
}

if ( ! function_exists('get_explode_xls'))
{
	function get_explode_xls($xls_title,$xls_value,$name='')
	{
		header ( "Content-type:application/vnd.ms-excel" );
		header ( "Content-Disposition:filename=".$name.".xls" );
		$str="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			<title></title></head>";
			$str.="<body><table border='1'><tr><td>".implode('</td><td>',$xls_title)."</td></tr>";
			foreach($xls_value as $v)
			{
				$str.="<tr><td>".implode('</td><td>',$v)."</td></tr>";
			}
			$str.="</table></body></html>";
		echo $str;
		die;
	}
}

if ( ! function_exists('get_ueditor_auth'))
{
	//获取上传图片权限
	function get_ueditor_auth($uid='',$mod='')
	{
		$tm=time();
		$str='?userid='.$uid.'&mod='.$mod.'&tm='.$tm.'&auth='.md5($uid."erp12123!@#".$mod.$tm."erp12123!@#");
		return $str;
	}	
}

if ( ! function_exists('check_ueditor_auth'))
{
	//验证上传权限
	function check_ueditor_auth()
	{
		$userid=isset($_GET['userid'])?$_GET['userid']:'';
		$mod=isset($_GET['mod'])?$_GET['mod']:'';
		$tm=isset($_GET['tm'])?$_GET['tm']:'';
		$auth=isset($_GET['auth'])?$_GET['auth']:'';
		if(empty($userid)||empty($tm)||empty($mod)||empty($auth)||$_GET['auth']!=md5($userid."erp12123!@#".$mod.$tm."erp12123!@#"))
			return false;
		else
		{
			$uid=authcode(get_cookie('user_id',NULL,$mod.config_item('cookie_prefix_tag')));
			if($uid==$userid)
				return array('userid'=>$uid,'mod'=>$mod);
			else
				return false;
		}
	}	
}

	if ( ! function_exists('array_remove')) 
	{

		function array_remove($data, $key)
		{

			if (!array_key_exists($key, $data)) {
				return $data;
			}

			$keys = array_keys($data);
			$index = array_search($key, $keys);
			if ($index !== FALSE) {
				array_splice($data, $index, 1);
			}
			
			return $data;

		}
	}
if ( ! function_exists('f_get_status'))
{
	function f_get_status($v='',$tag='order_status',$type=0)
	{
		require(APPPATH.'/config/base_config.php');

		if($type==1)
			return $config[$tag];
		$ar[10]='label-success';
		$ar[4]='label-success';
		$ar[3]='label-important';
		$ar[2]='label-success';
		$ar[1]='label-info';
		$ar[-1]='';
		$ar[-2]='label-danger';
		$ar[-3]='label-important';
		if(!is_numeric($v))
		{
			$ar[$v]='label-success';
		}
			$ar[0]='label-inverse';


		if($type==0)
			return isset($config[$tag][$v])?('<span class="label '.$ar[$v].'">'.$config[$tag][$v].'</span>'):'';
		else
			return isset($config[$tag][$v])?$config[$tag][$v]:'';
	}
}

if ( ! function_exists('f_explode'))
{
	function f_explode($str,$tag=',')
	{
		$ar=explode($tag,$str);
		return $ar;
	}	
}

if ( ! function_exists('get_hg_name'))
{
	function get_hg_name($type=1)
	{
		$ar=array(1=>'保税',2=>'直邮',3=>'一般贸易');
		return $ar[$type];
	}	
}


if ( ! function_exists('usrl_back_msg'))
{
	/**
	 * 错误返回页面
	 * @param	string	
	 * @return	string
	 */
	function usrl_back_msg($msg,$ar_url=array(),$smarty_class)
	{
		$smarty_class->assign('act_msg',$msg,0);
		$smarty_class->assign('act_url',$ar_url);
		$smarty_class->display_ini('msg_url.htm');
		die;
	}
}

if ( ! function_exists('get_post_sql'))
{
	/**
	 * 获取post 提交更新的字段内容
	 * @param	$check_data      array
	 * @param	$no_xss  		 array
	 * @param	$empty_continue  array
	 * @param	$tag             string
	 * @return	array
	 * @desc    如果某字段需要处理请提前处理
	 */
	function get_post_sql_data($check_data,$empty_continue=array(),$tag='ps_')
	{
	   if(empty($_POST)||empty($check_data)||!is_array($check_data))
	     	return array();	
	   $wsql=array();
	   foreach($_POST as $k=>$v)
	   {
		  $tag_len=strlen($tag);   
		  $name=substr($k,$tag_len,strlen($k)-$tag_len);
		  //如果是非法自动过滤
		  if(!in_array($name,$check_data)&&substr($k,0,$tag_len)==$tag)
			 continue;
			
		  //如果为空不更新	 
		  if(is_array($empty_continue)&&in_array($name,$empty_continue)&&empty($v))   	
			 continue;
			 
		  //组合
		  if(substr($k,0,$tag_len)==$tag)
		  {
			  $wsql[$name]=$v;
		  }
	   }
	   return $wsql;
	}
}


if ( ! function_exists('tab_m'))
{
	/**
	 * 获取订单号
	 * @param	string	''
	 * @return	string
	 */
	function tab_m($table)
	{
		
		return 'dferp_'.$table;
	}
}

if ( ! function_exists('get_order'))
{
	/**
	 * 获取订单号
	 * @param	string	''
	 * @return	string
	 */
	function get_order()
	{
		
		return 1;
	}
}

if ( ! function_exists('get_admin_name'))
{
	/**
	 * 获取菜单名称
	 * @param	string	
	 * @return	string
	 */
	function get_admin_name()
	{
		
		return 1;
	}
}


if ( ! function_exists('smarty_session'))
{
	function smarty_session($index='')
	{
		return isset($_SESSION[$index])?$_SESSION[$index]:'';
	}
}

if ( ! function_exists('smarty_cookie'))
{
	function smarty_cookie($index='')
	{
		return get_decode_cookie($index);
	}
}

if ( ! function_exists('smarty_post'))
{
	function smarty_post($index='')
	{
		return isset($_POST[$index])?$_POST[$index]:'';
	}
}

if ( ! function_exists('smarty_get'))
{
	function smarty_get($index='')
	{
		return isset($_GET[$index])?$_GET[$index]:'';
	}
}

if ( ! function_exists('authcode'))
{
	function authcode($string, $operation = 'DECODE', $expiry = 0,$exkey='')
	{
		$ckey_length = 4;
		$key = $exkey?md5($exkey):md5(md5(config_item('cookie_authkey').$_SERVER['HTTP_USER_AGENT']).config_item('baseurl').$_SERVER['SERVER_SIGNATURE']);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	
		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);
	
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);
	
		$result = '';
		$box = range(0, 255);
	
		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
	
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
	
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
	
		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	
	}
}


if ( ! function_exists('set_encode_cookie'))
{
	/**
	 * 加密cookie
	 * @return	string
	 */
	function set_encode_cookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = FALSE, $httponly = FALSE)
	{
		if(!empty($value))
			$value=authcode($value,'ENCODE');
		set_cookie($name, $value , $expire , $domain , $path , $prefix , $secure, $httponly);
	}
}


if ( ! function_exists('get_decode_cookie'))
{
	/**
	 * 解密cookie
	 * @return	string
	 */
	function get_decode_cookie($index = '')
	{
		$str=authcode(get_cookie($index,true));
		if(empty($str))			
			delete_cookie($index);
		return $str;
	}
}

if ( ! function_exists('dateformat'))
{
	function dateformat($time)
	{
		if(is_numeric($time))
			return date("Y-m-d H:i:s",$time);
		else
			return date("Y-m-d H:i:s",strtotime($time));
	}
}	