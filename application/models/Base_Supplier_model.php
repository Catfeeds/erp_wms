<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Supplier_model  extends CI_Model
{
	//供应商商品 查询记录总条数
	/*
		传入参数
		$key          arr  关键字 普通搜索 
		$key_like     arr  关键字 模糊搜索
	*/
	public function sproduct_list_rows($key,$key_like)
	{
		if ( !empty($key) && is_array($key) )
		{
			$this->db->where($key);
		}
		if ( !empty($key_like) && is_array($key_like) )
		{
			$this->db->like($key_like);
		}
		return $this->db->count_all_results(tab_m('sp_product'));
	}

	//供应商商品 列表
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
	public function sproduct_list($fetchFields,$sort_field,$sort_order,$limit_list,$limit_first,$key,$key_like)
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
						->from(tab_m('sp_product'))
						->order_by($sort_field, $sort_order)
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}

	//供应商商品下载
	public function sproduct_download($fetchFields,$where_arr)
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
						->from(tab_m('sp_product'))
						->where_in('id', $where_arr)
						->get()
						->result_array();
	}

	//我的商品/商品上传 添加
	public function product_add($data)
	{

		if(!is_array($data)||empty($data))
		{
			return false;
		}
		return $flag = $this->db->insert(tab_m('sp_product'), $data);
	}

	//我的商品 编辑前查询原始数据
	public function get_product($fetchFields,$where_arr)
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
					 	->from(tab_m('sp_product'))
					 	->where($where_arr)
					 	->get()
					 	->row_array();
	}

	//我的商品 编辑
	public function product_update($data,$where_arr)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		return $this->db->update(tab_m('sp_product'), $data,$where_arr);
	}

	//我的商品 备案状态修改(批量)
	public function product_uqdate_status($data)
	{
		if(!is_array($data)||empty($data))
		{
			return array();
		}
		return $this->db->update_batch(tab_m('sp_product'), $data,'id');
	}

	//商品上传 添加前查询是否有重复字段
	public function check_is_repeat($where_arr)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		$row = $this->db->where($where_arr)
		                ->count_all_results(tab_m('sp_product'));
		if($row == '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//供应商列表 查询记录总条数
	public function supplier_list_rows($key,$key_like)
	{
		if(!empty($key) && is_array($key))
		{
			$this->db->where($key);
		}
		if(!empty($key_like) && is_array($key_like))
		{
			$this->db->like($key_like);
		}
		return $this->db->count_all_results(tab_m('sp_user'));
	}

	//供应商列表 
	public function supplier_list($fetchFields,$sort_field,$sort_order,$limit_list,$limit_first,$key,$key_like)
	{
		if(empty($fetchFields)  && empty($sort_field) && empty($sort_order))
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
						->from(tab_m('sp_user'))
						->order_by($sort_field, $sort_order)
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}

	//供应商 编辑前查询原始数据
	public function get_supplier($fetchFields,$where_arr)
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
					 	->from(tab_m('sp_user'))
					 	->where($where_arr)
					 	->get()
					 	->row_array();
	}

	//供应商 编辑
	public function supplier_update($data,$where_arr)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		return $this->db->update(tab_m('sp_user'), $data,$where_arr);
	}

	//供应商 添加前查询登录帐号是否有重复
	public function check_supplier_user($where_arr)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		$row = $this->db->where($where_arr)
		                ->count_all_results(tab_m('sp_user'));
		if($row == '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//获取供应商单条信息
	/*
		传入参数
		$fetchFields  str  查询内容
		$where_arr    arr  关键字 搜索内容

		返回值：单条记录
	*/
	public function get_sp_user_info( $fetchFields , $where_arr )
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
			->from( tab_m('sp_user') )
			->where( $where_arr )
			->get()
			->row_array();
	}

	/**
	 * 获取供应商列表
	 * $where str     条件
	 */
	public  function get_sp_user($fetchFields,$where_arr)
	{
		if(empty($fetchFields) || !is_array($fetchFields)){
			return 0;
		}
		if(empty($where_arr)){
			return 0;
		}
		return $this->db->select($fetchFields)
			->from(tab_m('sp_user'))
			->where($where_arr)
			->get()->result_array();
		//->row_array();
	}

	//供应商 添加
	public function supplier_add($data)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		return $flag = $this->db->insert(tab_m('sp_user'), $data);
	}

	//供应商商品 回收 查询记录总条数
	public function sproduct_bin_list_rows($key,$key_like,$is_show = FALSE)
	{
		if ( !empty($key) && is_array($key) )
		{
			$this->db->where($key);
		}
		if ( !empty($key_like) && is_array($key_like) )
		{
			$this->db->like($key_like);
		}
		if ( $is_show === FALSE )
		{
			$this->db->where('filing_status !=', 5);
		}
		return $this->db->count_all_results(tab_m('sp_product_bin'));
	}

	//供应商商品 回收
	public function sproduct_bin_list($fetchFields,$sort_field,$sort_order,$limit_list,$limit_first,$key,$key_like,$is_show = FALSE)
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
		if ( $is_show === FALSE )
		{
			$this->db->where('filing_status !=', 5);
		}
		return $this->db->select($fetchFields)
						->from(tab_m('sp_product_bin'))
						->order_by($sort_field, $sort_order)
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}

	//供应商商品 添加至回收站
	public function add_sproduct_bin($where_arr)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		$res = $this->db->select('*')
						->from(tab_m('sp_product'))
						->where_in('id',$where_arr)
						->get()
						->result_array();
		if(!empty($res))
		{
		   	$f = 1;
		   	foreach ($res as $v) 
		   	{
				unset($v['recorder_apply_time']);
				unset($v['recorder_status']);
				unset($v['deadline']);
			   	$flag_add = $this->db->insert(tab_m('sp_product_bin'),$v);
				
				if ( $flag_add == 1 ) 
				{
					$flag = $this->db->delete(tab_m('sp_product'),array('id' => $v['id']));
					if ( $flag != 1 )
					{
						$f = -1;
					}
				}
				else
				{
					return false;
				}
		   	}
		   	if ( $f == 1 )
		   	{
		   		return true;
		   	}
		   	else
		   	{
		   		return false;
		   	}
		}
		else
		{
			return false;
		}
	}

	//商品回收 恢复
	public function sproduct_bin_recover($where_arr)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		$res = $this->db->select('*')
						->from(tab_m('sp_product_bin'))
						->where_in('id',$where_arr)
						->get()
						->result_array();							
		if(!empty($res))
		{
		   	$f = 1;
		   	foreach ($res as $v) 
		   	{
			   	$flag_add = $this->db->insert(tab_m('sp_product'),$v);
				
				if ( $flag_add == 1 ) 
				{
					$flag = $this->db->delete(tab_m('sp_product_bin'),array('id' => $v['id']));
					if ( $flag != 1 )
					{
						$f = -1;
					}
				}
				else
				{
					return false;
				}
		   	}
		   	if ( $f == 1 )
		   	{
		   		return true;
		   	}
		   	else
		   	{
		   		return false;
		   	}
		}
		else
		{
			return false;
		}
	}

	//商品回收 删除（不删除数据，将数据隐藏不显示）
	public function sproduct_bin_delete($data)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		return $this->db->update_batch(tab_m('sp_product_bin'), $data, 'id');	
	}

	//商户地址 查询记录总条数
	public function sproduct_addr_list_rows( $where_arr='' )
	{
		if ( is_array($where_arr) && !empty( $where_arr ) )
		{
			$this->db->where( $where_arr );
		}
		return $this->db->count_all_results(tab_m('sp_addr'));
	}

	//商户地址 列表
	public function sproduct_addr_list($fetchFields,$limit_list,$limit_first)
	{
		if ( empty($fetchFields) )
		{
			return array();
		}
		if ( !empty($key) && is_array($key) )
		{
			$this->db->where($key);
		}
		return $this->db->select($fetchFields)
						->from(tab_m('sp_addr'))
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}	

	//商户地址 添加
	public function sproduct_addr_add($data)
	{	
		if ( !is_array($data)||empty($data) )
		{
			return false;
		}
		return $this->db->insert(tab_m('sp_addr'),$data);				
	}

	//商户地址 编辑前查询原始数据
	public function get_sproduct_addr( $fetchFields , $where_arr )
	{
		if ( empty($fetchFields) )
		{
			return array();
		}
		if ( !is_array($where_arr) || empty($where_arr) )
		{
			return array();
		}
		return $this->db->select($fetchFields)
					 	->from(tab_m('sp_addr'))
					 	->where($where_arr)
					 	->get()
					 	->row_array();
	}

	//商户地址 编辑
	public function sproduct_addr_update($data,$where_arr)
	{
		if ( !is_array($data) || empty($data) )
		{
			return false;
		}
		if ( !is_array($where_arr) || empty($where_arr) )
		{
			return false;
		}
		return $this->db->update(tab_m('sp_addr'), $data,$where_arr);
	}

	//获取商户地址
	public function get_sproduct_addr_all()
	{
		return $this->db->select('id,addr_name')
					  	->from(tab_m('sp_addr'))
					 	->get()
					 	->result_array();		
	}
}