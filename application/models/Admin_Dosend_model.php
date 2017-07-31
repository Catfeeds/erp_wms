<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Dosend_model extends CI_Model
{
	//通过id查询列队信息
	function get_dosend($id)
	{
		$this->db->where('id',$id);
		return	$this->db->select('id,order_id,status,type')
					 ->from(tab_m('dosend'))
					 ->get()
					 ->row_array();
	}

	//通过id更新列队信息
	function dosend_updata($id,$dosend_arr)
	{
		$this->db->where('id',$id);
		$flag = $this->db->update(tab_m('dosend'), $dosend_arr);
		if ($flag == 1) {
			return true;
		}	
	}	
}