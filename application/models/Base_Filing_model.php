<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Filing_model  extends CI_Model
{

	//平台备案库 查询记录总条数
	/*
		传入参数
		$key          arr  关键字 普通搜索 
		$key_like     arr  关键字 模糊搜索
	*/
	public function filing_list_rows($key,$key_like)
	{
		if ( !empty($key) && is_array($key) )
		{
			$this->db->where($key);
		}
		if ( !empty($key_like) && is_array($key_like) )
		{
			$this->db->like($key_like);
		}
		return $this->db->count_all_results(tab_m('stock'));
	}

	//平台备案库 列表
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
	public function filing_list($fetchFields,$sort_field,$sort_order,$limit_list,$limit_first,$key,$key_like)
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
						->from(tab_m('stock'))
						->order_by($sort_field, $sort_order)
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}
	
    //查询指定关区指定内容
	public function get_filing_type_list($fetchFields='a.*',$filing_type,$filing_kjt_type,$wehre_arr,$where_like_arr='',$limit_arr,$orderby=' order by a.id desc')
	{
		if(!empty($wehre_arr))
			$this->db->where($wehre_arr);
		if(!empty($where_like_arr))
			$this->db->where($where_like_arr);

		return $this->db->select($fetchFields)
				->from(tab_m('stock').' as a')
				->join(tab_m('stock_filing_'.$filing_type).' as b','a.id=b.id','LEFT')
				->order_by($orderby)
				->limit($limit_arr[1],$limit_arr[0])
				->get()
				->result_array();
	}
	
	//查询指定总数
	public function get_filing_type_list_nums($filing_type,$filing_kjt_type,$wehre_arr,$where_like_arr='')
	{
		if(!empty($wehre_arr))
			$this->db->where($wehre_arr);
		if(!empty($where_like_arr))
			$this->db->where($where_like_arr);	
		return $this->db->select('a.id')
						->from(tab_m('stock').' as a')
						->join(tab_m('stock_filing_'.$filing_type).' as b','a.id=b.id','LEFT')
						->get()
						->num_rows;			
	}


	//平台备案库 列表 关联
	public function filing_list_ass($num,$where_arr,$fetchFields)
	{
		if(!is_numeric($num)||empty($num)) 
		{
			return array();
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return array();
		}
		if(empty($fetchFields))
		{
			return array();
		}
		return $this->db->select($fetchFields)
						->from(tab_m('stock_filing_'.$num.''))
						->where($where_arr)
						->get()
						->row_array();
	}

	//平台备案库 修改
	public function stock_uqdate($data,$where_arr)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		return $this->db->update(tab_m('stock'), $data,$where_arr);
	}

	//平台备案库 批量修改
	public function stock_uqdate_batch($data)
	{
		if(!is_array($data)||empty($data))
		{
			return array();
		}
		return $this->db->update_batch(tab_m('stock'), $data,'id');
	}

	//平台备案库 编辑前查询是否存在记录
	public function check_is_exist($where_arr,$num)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		if(!is_numeric($num)||empty($num)) 
		{
			return false;
		}
		$row = $this->db->where($where_arr)
		                ->count_all_results(tab_m('stock_filing_'.$num.''));
		if($row == '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//平台备案库 编辑 修改
	public function filing_uqdate($num,$data,$where_arr)
	{
		if(!is_numeric($num)||empty($num)) 
		{
			return false;
		}
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		return $this->db->update(tab_m('stock_filing_'.$num.''), $data,$where_arr);
	}

	//批量上传 添加前查询数据是否有重复
	public function check_is_repeat($where_arr)
	{
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		$row = $this->db->where($where_arr)
		                ->count_all_results(tab_m('stock'));
		if($row == '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//批量上传 根据上传序号获取商品id
	public function get_stock_id($upload_num)
	{
		if(!is_numeric($upload_num)||empty($upload_num))
		{
			return array();
		}
		return $this->db->select('id')
					->from(tab_m('stock'))
					->where('upload_num',$upload_num)
					->get()
					->row_array();
	}

	//获取商品表信息
	public function get_stock_info($fetchFields,$where_arr)
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
					->from(tab_m('stock'))
					->where($where_arr)
					->get()
					->row_array();
	}
	
	//获取是否备案
	public function get_stock_info1($fetchFields='a.*',$filing_type,$where_barcode)
	{

		return $this->db->select($fetchFields)
			->from(tab_m('stock').' as a')
			->join(tab_m('stock_filing_'.$filing_type).' as b','a.id=b.id','LEFT')
			->where('a.barcode',$where_barcode)
			->get()
			->row_array();

	}
	
	//批量上传 查询备案是否存在 不存在返回真
	public function check_filing_isexist($num,$where_arr)
	{
		if(!is_numeric($num)||empty($num))
		{
			return false;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return false;
		}
		$row = $this->db->where($where_arr)
		                ->count_all_results(tab_m('stock_filing_'.$num.''));
		if($row == '0')
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//批量上传 添加 表stock
	public function stock_add($data)
	{
		if(!is_array($data)||empty($data))
		{
			return 0;
		}
		$flag = $this->db->insert(tab_m('stock'), $data);
		if($flag == 1)
		{
			return $this->db->insert_id();
		}
		else
		{
			return 0;	
		}
	}

	//批量上传/平台备案库编辑 添加 表stock_filing
	public function stock_filing_add($data,$num)
	{
		if(!is_array($data)||empty($data))
		{
			return false;
		}
		if(!is_numeric($num)||empty($num)) 
		{
			return false;
		}
		return $this->db->insert(tab_m('stock_filing_'.$num.''), $data);
	}

}