<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sp_Product_model  extends CI_Model
{
	//我的商品列表
	public function product_list($page_num,$page,$search_array,$search_array_like)
	{
		if(is_array($search_array)&&!empty($search_array))
		{
			$this->db->where($search_array);	
		}
		if(is_array($search_array_like)&&!empty($search_array_like))
		{
			$this->db->like($search_array_like);
		}		
		return $this->db->select('a.stock_id,a.status,a.id,a.name,a.c_num,a.online_num,a.price,b.brand,b.catname,b.gg,b.mark_price,b.mz')
						->from(tab_m('sp_product').' as a')
						->join(tab_m('sp_product_content').' as b', 'a.id = b.product_sp_id', 'left')
						->limit($page_num,$page)
						->get()
						->result_array();
	}

	public function product_totalRows($search_array,$search_array_like)
	{
		if(is_array($search_array)&&!empty($search_array))
		{
			$this->db->where($search_array);	
		}
		if(is_array($search_array_like)&&!empty($search_array_like))
		{
			$this->db->like($search_array_like);
		}	
		return $this->db->select('product_sp_id')
						->from(tab_m('sp_product').' as a')
						->join(tab_m('sp_product_content').' as b', 'a.id = b.product_sp_id','left')
						->get()
						->num_rows();
	}

	//添加产品到表sp_product
	function product_add($product_arr)
	{
		$flag = $this->db->insert(tab_m('sp_product'),$product_arr);		
		if($flag == 1)
		{
			return $this->db->insert_id();
		}
		else
		{
			return 0;	
		}		
	}

	//添加产品到表sp_product_content
	function product_content_add($product_content_arr)
	{
		$flag = $this->db->insert(tab_m('sp_product_content'),$product_content_arr);		
		if($flag == 1)
		{
			return true;
		}			
	}

    //更新内容
    function update_product($data,$where_ar)
	{
		if(!is_array($data)||empty($data))
			return false;
		if(!is_array($where_ar)||empty($where_ar))
			return false;	

		$this->db->where($where_ar);
			
		$flag = $this->db->update(tab_m('sp_product'),$data);
		if ($flag == 1) 
			return true;
		else
			return false;	
	}
	
	 //更新内容
    function update_product_content($data,$where_ar)
	{
		if(!is_array($data)||empty($data))
			return false;
		if(!is_array($where_ar)||empty($where_ar))
			return false;	
			
		$this->db->where($where_ar);
			
		$flag = $this->db->update(tab_m('sp_product_content'),$data);
		if ($flag == 1) 
			return true;
		else
			return false;	
	}
	
	
		
	//获取商品类别
	function get_stock_cat()
	{
		return	$this->db->select('id,cat')
					 ->from(tab_m('stock_cat'))
					 ->get()
					 ->result_array();		
	}

	//获取商品基本信息
	function get_product($fechfields,$id,$uid='')
	{
		if(!is_numeric($id)&&!is_array($id))
			return array();
			
		if(!is_array($id))	
			$this->db->where('id',$id);
		else
			$this->db->where($id);
			
		if(!empty($uid))
			$this->db->where('userid',$uid);
		return	$this->db->select($fechfields)
					 ->from(tab_m('sp_product'))
					 ->get()
					 ->row_array();		
	}
	
	//获取商品基本信息
	function get_product_info($fechfields,$where_arr)
	{
		if(empty($fechfields))
			return array();
		if(empty($where_arr) || !is_array($where_arr))
			return array();
		$this->db->where($where_arr);
		return  $this->db->select($fechfields)
					 ->from(tab_m('sp_product'))
			    	 ->get()
					 ->row_array();
	}
	
	//获取商品详情
	function get_product_content($fechfields,$id,$uid='')
	{
		if(!is_numeric($id))
			return array();
		$this->db->where('product_sp_id',$id);
		if(!empty($uid))
			$this->db->where('userid',$uid);
		return	$this->db->select($fechfields)
					 ->from(tab_m('sp_product_content'))
					 ->get()
					 ->row_array();		
	}

}