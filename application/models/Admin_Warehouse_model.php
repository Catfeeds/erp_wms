<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Warehouse_model  extends CI_Model
{
	
	//添加仓库
	function warehouse_add($warehouse_arr)
	{
		$flag = $this->db->insert(tab_m('stock_warehouse'),$warehouse_arr);		
		if ($flag == 1) {
			return true;
		}	
	}

	//通过id查询信息
	function get_warehouse($id,$fetchField='')
	{
		$this->db->where('id',$id);
		return	$this->db->select(!empty($fetchField)?$fetchField:'*')
					 ->from(tab_m('stock_warehouse'))
					 ->get()
					 ->row_array();
	}

	//通过id更新仓库
	function warehouse_updata($id,$warehouse_arr)
	{
		$this->db->where('id',$id);
		$flag = $this->db->update(tab_m('stock_warehouse'), $warehouse_arr);
		if ($flag == 1) {
			return true;
		}	
	}

	//仓库列表
	function warehouse_list()
	{
		return	$this->db->select('id,name,hg_name,type,logistics_temp_id')
					 ->from(tab_m('stock_warehouse'))
					 ->get()
					 ->result_array();
	}

}