<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Package_Status_model extends CI_Model
{

    //包裹状态管理 查询记录总条数
    /*
        传入参数
        $key          arr  关键字 普通搜索
        $key_like     arr  关键字 模糊搜索
    */
    public function package_status_list_rows($key,$key_like)
    {
        if ( !empty($key) && is_array($key) )
        {
            $this->db->where($key);
        }
        if ( !empty($key_like) && is_array($key_like) )
        {
            $this->db->like($key_like);
        }
        return $this->db->count_all_results(tab_m('package_status'));
    }


    //订单管理 列表
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
    public function package_status_list($fetchFields,$sort_field,$sort_order,$limit_list,$limit_first,$key,$key_like)
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
            ->from(tab_m('package_status'))
            ->order_by($sort_field, $sort_order)
            ->limit($limit_list,$limit_first)
            ->get()
            ->result_array();
    }


    //包裹执行状态管理 添加
    /*
        传入参数
        $data  arr  添加数据

        返回值：执行条数
    */
    public function package_status_add( $data )
    {
        if ( !is_array($data) || empty($data) )
        {
            return 0;
        }
        return $this->db->insert(tab_m('package_status'), $data);
    }


    //包裹执行状态管理 修改
    /*
        传入参数
        $data       arr   修改数据
        $where_arr  arr   关键字 搜索内容

        返回值：执行条数
    */
    public function package_status_update( $data , $where_arr )
    {
        if ( !is_array($data) || empty($data) )
        {
            return 0;
        }
        if ( !is_array($where_arr) || empty($where_arr) )
        {
            return 0;
        }
        return $this->db->update( tab_m('package_status') , $data , $where_arr );
    }


    //获取包裹执行状态单条信息
    /*
        传入参数
        $fetchFields  str  查询内容
        $where_arr    arr  关键字 搜索内容

        返回值：单条记录
    */
    public function get_fedex_package_status_info( $fetchFields , $where_arr )
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
            ->from( tab_m('package_status') )
            ->where( $where_arr )
            ->get()
            ->row_array();
    }
}