<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sp_User_model extends CI_Model
{
	function is_login($time=60)
	{
		$uid=get_decode_cookie("user_id");
		if(!empty($uid))
		{
			set_encode_cookie("username",get_decode_cookie("username"),$time); 
			set_encode_cookie("user_id",get_decode_cookie("user_id"),$time);  
			return true; 
		}
		return false;
	}
		
	function login($user,$passwd)
	{
		$row=$this->get_user_one(array('user','id','pass'),'',$user);
		if(!empty($row)&&md5($passwd)==$row['pass'])
		{
			set_encode_cookie("username",$row['user'],60); 
			set_encode_cookie("user_id",$row['id'],60);  
			return true;
		}
		else
	   		return false;
	}	

	//获取当前管理员字段内容
	function get_user_one($fetchFields=array(),$user_id='',$user='')
	{
		if(empty($user_id)&&empty($user))
			return '';
		if(!is_array($fetchFields)||empty($fetchFields))	
			return '';
	    $sql="select  `".implode('`,`',$fetchFields)."`  from  ".tab_m('sp_user')."  where ".(!empty($user_id)?"id='$user_id'":"user='$user'");
		$query=$this->db->query($sql);
	    $row = $query->row_array();//row()对象
		return isset($row)?$row:'';
	}

	//检验登录密码或者操作密码
	function check_pass($id)
	{
		$this->db->where('id',$id);
		return	$this->db->select('pass,act_pass')
					 ->from(tab_m('sp_user'))
					 ->get()
					 ->row_array();
	}

	//修改登录密码或者操作密码
	function updata_passwd($id,$pwd)
	{
		$this->db->where('id',$id);
		return $this->db->update(tab_m('sp_user'), $pwd);
	}

}

