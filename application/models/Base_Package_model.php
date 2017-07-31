<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Package_model  extends CI_Model
{
	//包裹管理 查询记录总条数
	/*
		传入参数
		$key          arr  关键字 普通搜索 
		$key_like     arr  关键字 模糊搜索

		返回值：查询记录总条数
	*/
	public function fedex_package_list_rows( $key , $key_like )
	{
		if ( !empty($key) && is_array($key) )
		{
			$this->db->where($key);
		}
		if ( !empty($key_like) && is_array($key_like) )
		{
			$this->db->like($key_like);
		}
		return $this->db->count_all_results( tab_m('fedex_pakge') );
	}

	//包裹管理 列表
	/*
		传入参数
		$fetchFields  str  查询内容
		$sort_field   str  排序字段
		$sort_order   str  排序规则（升序、降序、随机）
		$limit_list   int  分页 限制行数
		$limit_first  int  分页 开始行数
		$key          arr  关键字 普通搜索 
		$key_like     arr  关键字 模糊搜索

		返回值：多条记录
	*/
	public function fedex_package_list( $fetchFields , $sort_field , $sort_order , $limit_list , $limit_first , $key , $key_like )
	{
		if ( empty($fetchFields) && empty($sort_field) && empty($sort_order) )
		{
			return array();
		}
		if ( !empty($key) && is_array($key) )
		{
			$this->db->where($key);
		}
		if ( !empty($key_like) && is_array($key_like) )
		{
			$this->db->like($key_like);
		}
		return $this->db->select( $fetchFields )
						->from( tab_m('fedex_pakge') )
						->order_by( $sort_field , $sort_order )
						->limit( $limit_list , $limit_first )
						->get()
						->result_array();
	}

	//获取包裹单条信息
	/*
		传入参数
		$fetchFields  str  查询内容
		$where_arr    arr  关键字 搜索内容

		返回值：单条记录
	*/
	public function get_fedex_package_info( $fetchFields , $where_arr )
	{
		if ( empty($fetchFields) )
		{
			return array();
		}
		if ( !is_array($where_arr) || empty($where_arr) )
		{
			return array();
		}	
		return $this->db->select( $fetchFields )
					->from( tab_m('fedex_pakge') )
					->where( $where_arr )
					->get()
					->row_array();
	}

	//获取包裹多条信息
	/*
		传入参数
		$fetchFields  str  查询内容
		$where_arr    arr  关键字 搜索内容

		返回值：多条记录
	*/
	public function get_fedex_packages( $fetchFields , $where_arr = array() )
	{
		if( empty($fetchFields) )
		{
			return array();
		}
		if ( !empty($where_arr) && is_array($where_arr) )
		{
			$this->db->where( $where_arr );
		}
		return $this->db->select( $fetchFields )
					->from( tab_m('fedex_pakge') )
					->get()
					->result_array();
	}

	//包裹管理 添加
	/*
		传入参数
		$data  arr  添加数据

		返回值：执行条数
	*/
	public function fedex_package_add( $data )
	{
		if ( !is_array($data) || empty($data) )
		{
			return 0;
		}
		return $this->db->insert(tab_m('fedex_pakge'), $data);
	}

	//包裹管理 修改
	/*
		传入参数
		$data       arr   修改数据
		$where_arr  arr   关键字 搜索内容

		返回值：执行条数
	*/
	public function fedex_package_update( $data , $where_arr )
	{
		if ( !is_array($data) || empty($data) )
		{
			return 0;
		}
		if ( !is_array($where_arr) || empty($where_arr) )
		{
			return 0;
		}	
		return $this->db->update( tab_m('fedex_pakge') , $data , $where_arr );
	}

	//我的包裹 包裹状态修改(批量)
	public function package_uqdate_status($data)
	{
		if(!is_array($data)||empty($data))
		{
			return array();
		}
		return $this->db->update_batch(tab_m('fedex_pakge'), $data,'id');
	}

	//获取包裹费用单条信息
	/*
		传入参数
		$fetchFields  str  查询内容
		$where_arr    arr  关键字 搜索内容

		返回值：单条记录
	*/
	public function get_fedex_package_rate_info( $fetchFields , $where_arr )
	{
		if ( empty($fetchFields) )
		{
			return array();
		}
		if ( !is_array($where_arr) || empty($where_arr) )
		{
			return array();
		}
		return $this->db->select( $fetchFields )
			->from( tab_m('fedex_package_rateinfo') )
			->where( $where_arr )
			->get()
			->row_array();
	}

	//获取包裹多条信息
	/*
		传入参数
		$fetchFields  str  查询内容
		$where_arr    arr  关键字 搜索内容

		返回值：多条记录
	*/
	public function get_fedex_packages_fee( $fetchFields , $where_arr = array() )
	{
		if( empty($fetchFields) )
		{
			return array();
		}
		if ( !empty($where_arr) && is_array($where_arr) )
		{
			$this->db->where( $where_arr );
		}
		return $this->db->select( $fetchFields )
			->from( tab_m('fedex_package_rateinfo') )
			->get()
			->result_array();
	}

	//包裹费用管理 添加
	/*
		传入参数
		$data  arr  添加数据

		返回值：执行条数
	*/
	public function fedex_package_rate_add( $data )
	{
		if ( !is_array($data) || empty($data) )
		{
			return 0;
		}
		return $this->db->insert(tab_m('fedex_package_rateinfo'), $data);
	}
}