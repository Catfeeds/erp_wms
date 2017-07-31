<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Logistics_model  extends CI_Model
{
	//添加运费模版名到表dferp_logistics_temp
	public function logistics_add($logistics_arr1)
	{
	    $falg=$this->db->insert(tab_m('logistics_temp'),$logistics_arr1);
		if(!empty($falg))
		{
			$temp_id=$this->db->insert_id();
			$sql = "INSERT INTO ".tab_m('logistics_temp_con')." (`temp_id`,`default_num`,`default_price`,`add_num`,`add_price`,`define_cityid`,`define_city_name`) VALUES";
			$vsql='';
			//添加到表dferp_logistics_temp_con中
			foreach ($_POST['define_city_name'] as $cityid => $value) 
			{				
				$temp_id          = $temp_id;
				$default_num      = $_POST['default_num'][$cityid]*1;
				$default_price    = $_POST['default_price'][$cityid]*1;
				$add_num          = $_POST['add_num'][$cityid]*1;
				$add_price        = $_POST['add_price'][$cityid]*1;
				$define_city_name = urldecode($value);
				$define_cityid    = $cityid;
				$vsql.=(!empty($vsql)?',':'')."('$temp_id','$default_num','$default_price','$add_num','$add_price','$define_cityid','$define_city_name')";				
			}
			$this->db->query($sql.$vsql);
			return true;
		}
		else
			return false;
	}
	
	//添加运费模版名到表dferp_logistics_temp
	public function logistics_edit($logistics_arr1,$temp_id)
	{
		$flag=$this->db->update(tab_m('logistics_temp'),$logistics_arr1,array('id'=>$temp_id));
		if($flag==1)
		{
			$this->db->query("delete   from  ".tab_m('logistics_temp_con')."   where  temp_id='$temp_id' ");
			$sql = "INSERT INTO ".tab_m('logistics_temp_con')." (`temp_id`,`default_num`,`default_price`,`add_num`,`add_price`,`define_cityid`,`define_city_name`) VALUES";
			$vsql='';
			//添加到表dferp_logistics_temp_con中
			foreach ($_POST['define_city_name'] as $cityid => $value) 
			{				
				$temp_id          = $temp_id;
				$default_num      = $_POST['default_num'][$cityid]*1;
				$default_price    = $_POST['default_price'][$cityid]*1;
				$add_num          = $_POST['add_num'][$cityid]*1;
				$add_price        = $_POST['add_price'][$cityid]*1;
				$define_city_name = urldecode($value);
				$define_cityid    = $cityid;
				$vsql.=(!empty($vsql)?',':'')."('$temp_id','$default_num','$default_price','$add_num','$add_price','$define_cityid','$define_city_name')";				
			}
			$this->db->query($sql.$vsql);
			return true;
		}
		else
			return false;
	}

	public function logistics_list($fetchFields,$where)
	{
		if( empty($fetchFields) || empty($where) )
		{
			return array();
		}
		return	$this->db->select($fetchFields)
					 ->from(tab_m('logistics_temp'))
					 ->where($where)
					 ->get()
					 ->result_array();
	}
	
	public function get_logistics_temp_con($id,$define_cityid=0)
	{
		$this->db->where("temp_id",$id);
		if(empty($define_cityid))
			return	$this->db->select(array('a.default_num','a.default_price','a.add_num','a.add_price','a.define_cityid','a.define_city_name'))
						 ->from(tab_m('logistics_temp_con')." as a")
						 ->get()
						 ->result_array();
		else
		{
			//返回指定模板单条运费模板的规则
			$this->db->where("define_cityid",$define_cityid);
			return	$this->db->select(array('a.default_num','a.default_price','a.add_num','a.add_price','a.define_cityid','a.define_city_name'))
						 ->from(tab_m('logistics_temp_con')." as a")
						 ->get()
						 ->row_array();
		}
	}

	//在表dferp_logistics_temp中通过title查询id
	public function logistics_one($id)
	{
		$this->db->where("id",$id);
		return	$this->db->select(array('title','id','pid'))
					 ->from(tab_m('logistics_temp'))
					 ->get()
					 ->row_array();
					
	}

	//物流企业列表
	function logccom_list()
	{
		return	$this->db->select('id,type,company')
					 ->from(tab_m('logistics_company'))
					 ->get()
					 ->result_array();
	}

	//通过id查询物流企业
	function get_logccom($id)
	{
		$this->db->where('id',$id);
		return	$this->db->select('id,type,company')
					 ->from(tab_m('logistics_company'))
					 ->get()
					 ->row_array();
	}

	//添加供应商
	function logccom_add($logccom_arr)
	{
		$flag = $this->db->insert(tab_m('logistics_company'),$logccom_arr);		
		if ($flag == 1) {
			return true;
		}		
	}

	//通过id更新供应商
	function logccom_updata($id,$logccom_arr)
	{
		$this->db->where('id',$id);
		$flag = $this->db->update(tab_m('logistics_company'),$logccom_arr);
		if ($flag == 1) {
			return true;
		}	
	}

	//通过登录id获取所有仓库名
	public function get_warehouse_name($sp_uid){
		$this->db->where('sp_uid',$sp_uid);
		return	$this->db->select('name,logistics_temp_id')
					 ->from(tab_m('stock_warehouse'))
					 ->get()
					 ->result_array();
	}

	//通过仓库查询运费模版	
	public function get_logistics_temp($temp_id){
		$this->db->where('temp_id',$temp_id);
		return	$this->db->select('default_num,default_price,add_num,add_price,define_city_name')
					 ->from(tab_m('logistics_temp_con'))
					 ->get()
					 ->result_array();
	}

	/*
		分割线以上为原始function，以下为本项目所需要function
	*/

	//获取运费模版名称
	public function get_freight_template( $where_arr='' )
	{
		if( is_array($where_arr) && !empty($where_arr) )
		{
			$this->db->where( $where_arr );
		}
		return $this->db->select('id,title')
					  	->from(tab_m('logistics_temp'))
					 	->get()
					 	->result_array();		
	}

	//获取运费模版价格信息
	public function get_freight_template_con($fetchFields,$where_arr)
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
					  	->from(tab_m('logistics_temp_con'))
					  	->where($where_arr)
					 	->get()
					 	->result_array();		
	}

	//发货地址 添加
	/*
		传入参数
		$data  arr  添加数据

		返回值：执行条数
	*/
	public function add_fedex_user( $data )
	{
		if ( !is_array( $data ) || empty( $data ) )
		{
			return 0;
		}
		return $this->db->insert( tab_m('fedex_user') , $data );
	}
	
	//获取fedex 国家地区
	public function get_fedex_country()
	{
		return	$this->db->select('*')
			->from(tab_m('country'))
			->get()
			->result_array();
	}
	

	//获取发货地址单条信息
	/*
		传入参数
		$fetchFields  str  查询内容
		$where_arr    arr  关键字 搜索内容

		返回值：单条记录
	*/
	public function get_fedex_user_info( $fetchFields , $where_arr )
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
					->from( tab_m('fedex_user') )
					->where( $where_arr )
					->get()
					->row_array();
	}

	/**
	 * 获取收发货地址列表
	 * $where str     发货地址 1   收货地址 2
	 */
	public  function get_fedex_user($fetchFields,$where_arr)
	{	
		if(empty($fetchFields) || !is_array($fetchFields)){
				return 0;
		}
		if(empty($where_arr)){
				return 0;
		}
		return $this->db->select($fetchFields)
					->from(tab_m('fedex_user'))
					->where($where_arr)
					->get()->result_array();
					//->row_array();
	}

	//发货地址 修改
	/*
		传入参数
		$data       arr   修改数据
		$where_arr  arr   关键字 搜索内容

		返回值：执行条数
	*/
	public function fedex_user_update( $data , $where_arr )
	{
		if ( !is_array($data) || empty($data) )
		{
			return 0;
		}
		if ( !is_array($where_arr) || empty($where_arr) )
		{
			return 0;
		}	
		return $this->db->update( tab_m('fedex_user') , $data , $where_arr );
	}

}