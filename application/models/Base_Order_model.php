<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Order_model  extends CI_Model
{

	//订单管理 查询记录总条数
	/*
		传入参数
		$key          arr  关键字 普通搜索 
		$key_like     arr  关键字 模糊搜索
	*/
	public function order_list_rows($key,$key_like)
	{
		if ( !empty($key) && is_array($key) )
		{
			$this->db->where($key);
		}
		if ( !empty($key_like) && is_array($key_like) )
		{
			$this->db->like($key_like);
		}
		return $this->db->count_all_results(tab_m('order'));
	}

	//订单管理 列表
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
	public function order_list($fetchFields,$sort_field,$sort_order,$limit_list,$limit_first,$key,$key_like)
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
						->from(tab_m('order'))
						->order_by($sort_field, $sort_order)
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}

	//订单管理 列表 订单的商品信息
	public function order_list_list($fetchFields,$where_arr)
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
						->from(tab_m('order_list'))
						->where($where_arr)
						->get()
						->result_array();
	}
	//订单管理  订单  订单单条更新
	public function order_row_update($data,$where_arr)
	{
		if(!is_array($data) ||empty($data)){
			return array();
		}
		if(!is_array($where_arr) || empty($where_arr))
		{
			return array();
		}
		return $this->db->update(tab_m('order'),$data,$where_arr);
	}

	//订单管理 查询批次号
	public function get_batches_id($where_arr)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return array();
		}
		return $this->db->select('id,batches_name')
						->from(tab_m('batches'))
						->where($where_arr)
						->where_in('status', array(1,2))
						->get()
						->result_array();
	}
	

	//订单管理 批量更新
	public function order_update_batches( $data )
	{
		if ( !is_array($data) || empty($data) )
		{
			return false;
		}	
		return $this->db->update_batch( tab_m('order') , $data , 'id' );
	}

	//订单上传 检验操作密码是否正确
	public function check_act_pass($where_arr,$pass)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		if(empty($pass))
		{
			return false;
		}
		$row = $this->db->select('act_pass')
				 		->from(tab_m('sp_user'))
						->where($where_arr)
						->get()
						->row_array();
		if ($row['act_pass'] != md5($pass)) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//订单上传 添加前查询导入订单号是否存在
	public function check_is_exist($where_arr)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		$row = $this->db->where($where_arr)
		                ->count_all_results(tab_m('order'));
		if($row == '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//订单上传 通过商品id获取商品信息
	public function get_stock_info($fetchFields,$where_arr,$stock_filing_fields='')
	{
		if(empty($fetchFields))
		{
			return array();
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return array();
		}		
		$row = $this->db->select($fetchFields)
				 		->from(tab_m('stock'))
						->where($where_arr)
						->get()
						->row_array();
		if ( $row['tax_type'] == '1' ) 
		{
			$keyword = $stock_filing_fields?$stock_filing_fields:'name_par,price_par,status_par';
		}
		elseif ( $row['tax_type'] == '2' )
		{
			$keyword = $stock_filing_fields?$stock_filing_fields:'name_con,price_con,status_con';
		}
		
		if(empty($row['customs']))
		{
			return array();
		}
		
	    $price = $this->db->select($keyword)
				 		->from(tab_m('stock_filing_'.$row['customs'].''))
						->where('id',$row['id'])
						->get()
						->row_array();
        if(empty($price))
		{
			return array();
		}
		
		$res = array_merge($row,$price);
		return $res;

	}
	
	//扫码上传订单  通过商品id ，关区，税务类型 获取商品信息
	public function get_stock_info1($fetchFields='a.*',$filing_type,$where_id)
	{

		return $this->db->select($fetchFields)
			->from(tab_m('stock').' as a')
			->join(tab_m('stock_filing_'.$filing_type).' as b','a.id=b.id','LEFT')
			->where('a.id',$where_id)
			->get()
			->row_array();

	}

	//订单上传 添加
	public function order_add($data)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		$flag = $this->db->insert(tab_m('order'), $data);
		if ($flag == 1)
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	//清单上传 添加
	public function order_list_add($data)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if ($this->db->insert_batch(tab_m('order_list'), $data)) 
		{
			return true;
		}
		else
		{
			return false;
		}			 			
	}

	//修改清单表
	public function order_list_update($data,$where_arr)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}	
		return $this->db->update(tab_m('order_list'), $data,$where_arr);
	}

	//订单上传 添加（更新）总价、总税、总重/订单 修改订单内容
	public function update_order_info($data,$where_arr)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}	
		return $this->db->update(tab_m('order'), $data,$where_arr);
	}

	//获取订单单条信息
	public function get_order_info($fetchFields,$where_arr)
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
					->row_array();
	}

	//获取订单单条信息
	public function get_order_list_info($fetchFields,$where_arr)
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
			->from(tab_m('order_list'))
			->where($where_arr)
			->get()
			->row_array();
	}

	//获取订单多条信息
	/*
		传入参数
		$fetchFields  str  查询内容
		$where_arr    arr  关键字 搜索内容

		返回值：多条记录
	*/
	public function get_orders( $fetchFields , $where_arr = array() )
	{
		if ( empty($fetchFields) )
		{
			return array();
		}
		if ( !empty($where_arr) && is_array($where_arr) )
		{
			$this->db->where( $where_arr );
		}
		return $this->db->select( $fetchFields )
					->from( tab_m('order') )
					->get()
					->result_array();
	}
	
	//获取订单所属
	
}