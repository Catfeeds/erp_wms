<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Cat_model extends CI_Model
{
	//商品类型 查询记录总条数
	public function cat_list_rows($key,$key_like)
	{
		if(!empty($key) && is_array($key))
		{
			$this->db->where($key);
		}
		if(!empty($key_like) && is_array($key_like))
		{
			$this->db->like($key_like);
		}
		return $this->db->count_all_results(tab_m('stock_cat'));
	}

	//商品类型 列表
	public function cat_list($fetchFields,$limit_list,$limit_first,$key,$key_like)
	{
		if(empty($fetchFields))
		{
			return array();
		}
		if(!empty($key) && is_array($key))
		{
			$this->db->where($key);
		}
		if(!empty($key_like) && is_array($key_like))
		{
			$this->db->like($key_like);
		}
		return $this->db->select($fetchFields)
						->from(tab_m('stock_cat'))
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}

	//商品类型 查询是否重复
	public function check_is_repeat($where_arr)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		$row = $this->db->where($where_arr)
		                ->count_all_results(tab_m('stock_cat'));
		if($row == '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//商品类型 添加
	public function cat_add($data)
	{	
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		return $this->db->insert(tab_m('stock_cat'),$data);				
	}

	
	//商品类型 编辑前查询原始数据
	public function get_cat($fetchFields,$where_arr)
	{
		if(empty($fetchFields))
		{
			return array();
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return array();
		}
		return $this->db->select($fetchFields)
					 	->from(tab_m('stock_cat'))
					 	->where($where_arr)
					 	->get()
					 	->row_array();
	}

	//商品类型 编辑
	public function cat_update($data,$where_arr)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		return $this->db->update(tab_m('stock_cat'), $data,$where_arr);
	}

	//获取商品类型
	public function get_cat_all()
	{
		return $this->db->select('id,cat')
					  	->from(tab_m('stock_cat'))
					 	->get()
					 	->result_array();		
	}
}