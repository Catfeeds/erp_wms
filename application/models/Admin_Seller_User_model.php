<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Seller_User_model  extends CI_Model
{
	
	//添加分析用户
	function seller_add($seller_arr)
	{
		
		$flag = $this->db->insert(tab_m('seller_user'),$seller_arr);		
		if ($flag == 1) {
			return true;
		}	
		
			
	}

	//通过id查询信息
	function get_seller_user($id)
	{
		$this->db->where('id',$id);
		return	$this->db->select('id,user,mobile,company')
					 ->from(tab_m('seller_user'))
					 ->get()
					 ->row_array();
	}

	//通过id更新分销用户
	function seller_user_updata($id,$seller_arr)
	{
		$this->db->where('id',$id);
		$flag = $this->db->update(tab_m('seller_user'), $seller_arr);
		if ($flag == 1) {
			return true;
		}	
	}

	//分销帐户列表
	public function seller_user_list($fetchFields,$page_num,$page)
	{
		return $this->db->select($fetchFields)
						->from(tab_m('seller_user'))
						->limit($page_num,$page)
						->get()
						->result_array();
	}

	//分销帐户列表总共行数
	public function seller_user_totalRows()
	{ 
		return $this->db->count_all(tab_m('seller_user'));
	}

	//充值退款日志列表
	public function seller_cash_log_list($fetchFields,$page_num,$page)
	{
		return $this->db->select($fetchFields)
						->from(tab_m('seller_cash_pay'))
						->limit($page_num,$page)
						->get()
						->result_array();
	}

	//充值退款日志列表总共行数
	public function seller_cash_log_totalRows()
	{ 
		return $this->db->count_all(tab_m('seller_cash_pay'));
	}

	//订单消费日志列表
	public function seller_cash_order_list($fetchFields,$page_num,$page,$search_array)
	{
		return $this->db->select($fetchFields)
						->from(tab_m('seller_cash_log'))
						->where($search_array)
						->limit($page_num,$page)
						->get()
						->result_array();
	}

	//订单消费日志列表总共行数
	public function seller_cash_order_totalRows($search_array)
	{ 
		return $this->db->like($search_array)
						->from(tab_m('seller_cash_log'))
						->count_all_results();
	}

}