<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seller_product_model extends CI_Model
{
	//选品
	function add_product($updata)
	{
		$flag = $this->db->insert(tab_m('seller_product'),$updata);		
		if ($flag == 1) 
			return true;
		else
			return false;	
	}
	
	//获取产品详情
	function get_product_detail($fetchFields,$where_ar)
	{
		if(empty($fetchFields))
			return array();
			
		if(!is_array($where_ar)||empty($where_ar))
			return array();	
			
		$this->db->where($where_ar);
		return $this->db->select($fetchFields)
		 	     ->from(tab_m('seller_product'))
				 ->get()->row_array();
				
	}
	
	//修改产品
	function update_product($data,$where_ar)
	{
		if(!is_array($data)||empty($data))
			return false;
		if(!is_array($where_ar)||empty($where_ar))
			return false;	
			
		$this->db->where($where_ar);
		$flag = $this->db->update(tab_m('seller_product'),$data);
		if ($flag == 1) 
			return true;
		else
			return false;	
	}
	
	
	//产品日志
	function add_product_log($data)
	{
		if(!is_array($data)||empty($data))
			return false;
		//$status= array(0=>'待审核',1=>'审核通过',-1=>'审核不通过');
		//$type= array(1=>'订购',2=>'订单推送',3=>'平台调整',4=>'订单作废');
		$data['add_time']=date("Y-m-d H:i:s");	
		$flag = $this->db->insert(tab_m('seller_product_log'),$data);
		if ($flag == 1) 
			return true;
		else
			return false;			
	}
	
	
	//查询日志
	function get_product_log($fechFields,$where_ar)
	{
		if(empty($fechFields))
			return array();
		if(!is_array($where_ar)||empty($where_ar))
			return array();	
			
		$this->db->where($where_ar);	
		$data['add_time']=date("Y-m-d H:i:s");	
		$row = $this->db
				->select()
				->from(tab_m('seller_product_log'))
				->get()
				->row_array();
		if(!empty($row))
			return $row;
		else
			return array();	
	}
	
}