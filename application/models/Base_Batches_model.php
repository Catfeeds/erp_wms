<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Batches_model  extends CI_Model
{

	//批次管理 查询记录总条数
	/*
		传入参数
		$key          arr  关键字 普通搜索 
		$key_like     arr  关键字 模糊搜索
	*/
	public function batches_list_rows($key,$key_like)
	{
		if ( !empty($key) && is_array($key) )
		{
			$this->db->where($key);
		}
		if ( !empty($key_like) && is_array($key_like) )
		{
			$this->db->like($key_like);
		}
		return $this->db->count_all_results(tab_m('batches'));
	}

	//批次管理 列表
	/*
		传入参数
		$fetchFields  str  查询内容
		$sort_field   str  排序字段
		$sort_order   str  排序规则（升序、降序、随机）
		$limit_list   int  分页 限制行数
		$limit_first  int  分页 开始行数
		$key          arr  关键字 普通搜索 
		$key_like     arr  关键字 模糊搜索
	*/
	public function batches_list($fetchFields,$sort_field,$sort_order,$limit_list,$limit_first,$key,$key_like)
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
		return $this->db->select($fetchFields)
						->from(tab_m('batches'))
						->order_by($sort_field, $sort_order)
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}

	//批次管理 列表 批次的订单信息/通过批次查询所有订单
	public function batches_list_order($fetchFields,$where_arr)
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
						->from(tab_m('order'))
						->where($where_arr)
						->get()
						->result_array();
	}

	//查询批次信息
	public function get_batches_info($fetchFields,$where_arr)
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
						->from(tab_m('batches'))
						->where($where_arr)
						->get()
						->row_array();
	}

	//获取批次多条信息
	/*
		传入参数
		$fetchFields  str  查询内容
		$where_arr    arr  关键字 搜索内容

		返回值：多条记录
	*/
	public function get_batches( $fetchFields , $where_arr = array())
	{
		if(empty($fetchFields))
		{
			return array();
		}
		if ( !empty($where_arr) && is_array($where_arr) )
		{
			$this->db->where( $where_arr );
		}
		
		return $this->db->select( $fetchFields )
					->from( tab_m('batches') )
					->get()
					->result_array();
	}

	//批次管理 编辑 修改状态/订单管理 修改批次内容
	public function batches_uqdate($data,$where_arr)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		return $this->db->update(tab_m('batches'), $data,$where_arr);
	}

	//批次添加 获取所有供应商id
	public function get_supplier_info()
	{
		return $this->db->select('id,company')
					  	->from(tab_m('sp_user'))
					 	->get()
					 	->result_array();	
	}

	//批次管理 添加
	public function batches_add($data)
	{
		if(!is_array($data)||empty($data))
		{
			return 0;
		}
		return $this->db->insert(tab_m('batches'), $data);
	}

	//运单表查询一条空数据
	public function get_one_emsno()
	{
		return $this->db->select('ems_no')
						->from(tab_m('emsno'))
						->where('status',0)
						->order_by('ems_no', 'ASC')
						->limit(1,0)
						->get()
						->result_array();
	}

	//修改运单表
	public function update_emsno( $where_arr )
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}	
		return $this->db->update( tab_m('emsno') , array( 'status' => 1 ) , $where_arr );
	}
}