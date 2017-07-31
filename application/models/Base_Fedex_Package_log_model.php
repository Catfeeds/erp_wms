<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Fedex_Package_log_model extends CI_Model
{

    //包裹执行状态管理 某个包裹 查询记录总条数
    /*
        传入参数
        $where_arr    arr  关键字 包裹id

        返回值：查询记录总条数
    */
    public function fedex_package_log_list_rows($where_arr )
    {

        if ( !empty($where_arr) && is_array($where_arr) )
        {
            $this->db->where($where_arr);
        }
        return $this->db->count_all_results( tab_m('fedex_pakge_log') );
    }


    //包裹管理 列表
    /*
        传入参数
        $fetchFields  str  查询内容
        $sort_field   str  排序字段
        $sort_order   str  排序规则（升序、降序、随机）
        $limit_list   int  分页 限制行数
        $limit_first  int  分页 开始行数
        $where_arr    arr  条件

        返回值：多条记录
    */
    public function fedex_package_log_list( $fetchFields , $sort_field , $sort_order , $limit_list , $limit_first ,$where_arr )
    {
        if ( empty($fetchFields) && empty($sort_field) && empty($sort_order) )
        {
            return array();
        }
        if ( !empty($where_arr) && is_array($where_arr) )
        {
            $this->db->where($where_arr);
        }

        return $this->db->select( $fetchFields )
            ->from( tab_m('fedex_pakge_log') )
            ->order_by( $sort_field , $sort_order )
            ->limit( $limit_list , $limit_first )
            ->get()
            ->result_array();
    }

    //fedex包裹执行日志管理 添加
    /*
        传入参数
        $data  arr  添加数据

        返回值：执行条数
    */
    public function fedex_package_log_add( $data )
    {
        if ( !is_array($data) || empty($data) )
        {
            return 0;
        }
        return $this->db->insert(tab_m('fedex_pakge_log'), $data);
    }

    //获取包裹执行日志多条信息
    /*
        传入参数
        $fetchFields  str  查询内容
        $where_arr    arr  关键字 搜索内容

        返回值：多条记录
    */
    public function get_fedex_packages_log( $fetchFields , $where_arr = array() )
    {
        if( empty($fetchFields) )
        {
            return array();
        }
        if ( !empty($where_arr) && is_array($where_arr) )
        {
            $this->db->where( $where_arr );
        }
        return $this->db->select( $fetchFields )
            ->from( tab_m('fedex_pakge_log') )
            ->get()
            ->result_array();
    }
}