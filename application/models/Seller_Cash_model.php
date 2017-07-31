<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seller_Cash_model extends CI_Model
{
	//通过用户帐号查询账户余额和冻结资金
	function get_seller_money($fetchFields,$where)
	{
		if(empty($fetchFields)||!is_array($where))
			return array();
			
		$this->db->where($where);
		return	$this->db->select($fetchFields)
					 ->from(tab_m('seller_user'))
					 ->get()
					 ->row_array();
	}

	//充值及操作日志
	function get_cash_pay()
	{
		return	$this->db->select('*')
					 ->from(tab_m('seller_cash_pay'))
					 ->get()
					 ->result_array();
	}

}

