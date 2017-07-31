<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Stock_model  extends CI_Model
{
	function add_stock($data=array())
	{
		if(!is_array($data)||empty($data))
			return false;
		$flag = $this->db->insert(tab_m('stock'),$data);		
		if ($flag == 1) 
			return $this->db->insert_id();
		else
			return false;	
	}
	
	function update_stock($data,$where_ar)
	{
		if(!is_array($data)||empty($data))
			return false;
		if(!is_array($where_ar)||empty($where_ar))
			return false;	
			
		foreach($where_ar as $k=>$v)
			$this->db->where($k,$v);
			
		$flag = $this->db->update(tab_m('stock'),$data);
		if ($flag == 1) 
			return true;
		else
			return false;	
	}
	
	function get_stock($fetchFields,$where_ar)
	{
		if(!is_array($where_ar)||empty($where_ar))
			return false;	
			
		foreach($where_ar as $k=>$v)
			$this->db->where($k,$v);
		
		$row=$this->db->select($fetchFields)
					   ->from(tab_m('stock'))
					   ->get()
					   ->row_array();
		if(empty($row))
			return array();
		else
			return $row;
	}

	public function update_stock_status($status_arr)
	{
		return $this->db->update_batch(tab_m('stock'), $status_arr,'id');
	}
}
