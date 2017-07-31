<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Country_model extends CI_Model
{
	//产地管理 查询记录总条数
	public function country_list_rows($key,$key_like)
	{
		if(!empty($key) && is_array($key))
		{
			$this->db->where($key);
		}
		if(!empty($key_like) && is_array($key_like))
		{
			$this->db->like($key_like);
		}
		return $this->db->count_all_results(tab_m('country'));
	}

	//产地管理 列表
	public function country_list($fetchFields,$limit_list,$limit_first,$key,$key_like)
	{
		if(empty($fetchFields))
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
						->from(tab_m('country'))
						->limit($limit_list,$limit_first)
						->get()
						->result_array();
	}

	//产地管理 修改产地状态
	public function update_country_display($data)
	{
		if(!is_array($data)||empty($data))
		{
			return array();
		}
		return $this->db->update_batch(tab_m('country'), $data,'c_id');
	}

	//获取开启的产地
	public function get_open_country($c_display = 0)
	{
		return $this->db->select('c_id,c_name')
					  	->from(tab_m('country'))
					 	->where('c_display',$c_display)
					 	->get()
					 	->result_array();		
	}
}