<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Spapi_model extends CI_Model
{
	function get_api_list()
	{
		return	$this->db->select('*')
					 ->from(tab_m('sp_openapi'))
					 ->get()
					 ->result_array();
	
	}

	//通过id查询供应商接口
	function get_api_one($id)
	{
		$this->db->where('id',$id);
		return	$this->db->select('id,api_id,userid,get_product_num_status,get_product_desc_status,get_order_status,send_order_status')
					 ->from(tab_m('sp_openapi'))
					 ->get()
					 ->row_array();
	}

	//通过id更新供应商接口
	function openapi_updata($id,$spuser_arr)
	{
		$this->db->where('id',$id);
		$flag = $this->db->update(tab_m('sp_openapi'), $spuser_arr);
		if ($flag == 1) {
			return true;
		}	
	}	
}