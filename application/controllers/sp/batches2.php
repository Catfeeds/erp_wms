<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Batches2 extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->load_sp_menu();
    }

    //订单管理

    //批次管理 列表
    public function batches_list()
    {

        //model
        $this->load->model('Base_Batches_model');

        //搜索
        $key      = array();
        $key_like = array();

        //只显示会员批次
        $key['userid'] = $this->user_id;

        if(isset($_GET))
        {
            //非模糊字段 搜索
            $search_key      = array('id','status','tax_status','freight_status','confirm_status');
            //模糊字段 搜索
            $search_key_like = array();
            foreach($_GET as $k => $v)
            {
                $skey = substr($k,7,strlen($k)-7);
                if($k != 'search_page_num' && substr($k,0,7) == 'search_' && !in_array($v,array('all','')))
                {
                    //非模糊字段
                    if(in_array($skey,$search_key))
                    {
                        $key[$skey] = $v;
                    }
                    //模糊字段
                    if(in_array($skey,$search_key_like))
                    {
                        $key_like[$skey] = $v;
                    }
                }
            }
        }

        //分页
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url = site_url($this->class."/".$this->method);
        $search_page_num = array('all'=>15,1=>15,2=>30,3=>50);
        $this->ci_page->listRows =! isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
        if(!$this->ci_page->__get('totalRows'))
        {
            $this->ci_page->totalRows = $this->Base_Batches_model->batches_list_rows($key,$key_like);
        }

        //列表
        $res = array();
        $res['page'] = $this->ci_page->prompt();
        $res['list'] = $this->Base_Batches_model->batches_list(
            '*',
            'id',
            'DESC',
            $this->ci_page->listRows,
            $this->ci_page->firstRow,
            $key,
            $key_like
        );
        //引入
        $this->config->load('base_config',TRUE);
        $confirm_status=$this->config->item('confirm_status','base_config');

        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->assign('confirm_status',$confirm_status);

        //载入页面
        $this->ci_smarty->display_ini('batches2_list.htm');

    }

    //批次管理 编辑
    public function batches_edit()
    {
        //model
        $this->load->model('Base_Batches_model');
        $this->load->model('Base_Order_model');

        //获取原始数据
        if ( !empty( $_POST['show_id'] ) )
        {
            $res = array();
            $res['id']           = $this->input->post('show_id',true);
            $res['batches_name'] = $this->input->post('batches_name',true);
            $res['post_date'] = $this->input->post('post_date',true);
            //返回结果
            $this->ci_smarty->assign('re',$res);
        }

        if ( !empty( $_POST['id'] ) )
        {
            //判断数据库的数据是否改变
            $batches_info = $this->Base_Batches_model->get_batches_info( 'airport', array('id' => $_POST['id']) );
            if ( !empty( $batches_info['airport'] ) )
            {
                $msg = array(
                    'msg'  => '提交失败',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }

            //表单验证
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('post_date','投递时间','required');
            $this->form_validation->set_rules('post_order_num','投递订单数','required');

            if ($this->form_validation->run() == FALSE)
            {
                $msg = array(
                    'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                //判断批次中的订单数
                $order_num=$this->Base_Batches_model->get_batches_info('order_num',array('id'=>$_POST['id']));
                if($this->input->post('post_order_num',true)!=$order_num['order_num']){
                    $msg = array(
                        'msg'  => '订单数量与上传订单不一致，请核实',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }


                //批次状态与订单状态同步修改
                //通过批次号获取所有订单号
                $order_id_arr = $this->Base_Batches_model->batches_list_order( 'id' , array( 'batches_id' => $_POST['id'] ) );
                //数据整理
                $order_status_arr = array();
                foreach ( $order_id_arr as $value )
                {
                    $order_status_arr[] = array(
                        'id'         => $value['id'],
                        'status' 	 => 3
                    );
                }
                //修改所有订单状态
                $this->Base_Order_model->order_update_batches( $order_status_arr );

                $batches_arr = array();
                $batches_arr['post_date']     = $this->input->post('post_date',true);
                $batches_arr['status']      = 4;

                $flag = $this->Base_Batches_model->batches_uqdate( $batches_arr , array( 'id' => $this->input->post('id',true) ) );
                if($flag == 1)
                {
                    $msg = array(
                        'msg'  => "操作成功",
                        'type' => 2
                    );
                    echo json_encode($msg);
                    die;
                }
                else
                {
                    $msg = array(
                        'msg'  => '提交失败',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }

            }
        }

        //载入页面
        $this->ci_smarty->display('batches_edit.htm');
    }

    /**
     * 收到批次
     */
    public function other_batches_list()
    {
        //model
        $this->load->model('Base_Batches_model');

        //搜索
        $key      = array();
        $key_like = array();

        if(isset($_GET))
        {
            //非模糊字段 搜索
            $search_key      = array('id','status','tax_status');
            //模糊字段 搜索
            $search_key_like = array();
            foreach($_GET as $k => $v)
            {
                $skey = substr($k,7,strlen($k)-7);
                if($k != 'search_page_num' && substr($k,0,7) == 'search_' && !in_array($v,array('all','')))
                {
                    //非模糊字段
                    if(in_array($skey,$search_key))
                    {
                        $key[$skey] = $v;
                    }
                    //模糊字段
                    if(in_array($skey,$search_key_like))
                    {
                        $key_like[$skey] = $v;
                    }
                }
            }
        }
        $key['huoyunzhan_uid'] =$this->user_id;
        $key['status']= 5;

        //分页
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url = site_url($this->class."/".$this->method);
        $search_page_num = array('all'=>15,1=>15,2=>30,3=>50);
        $this->ci_page->listRows =! isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
        if(!$this->ci_page->__get('totalRows'))
        {
            $this->ci_page->totalRows = $this->Base_Batches_model->batches_list_rows($key,$key_like);
        }

        //列表
        $res = array();
        $res['page'] = $this->ci_page->prompt();
        $res['list'] = $this->Base_Batches_model->batches_list(
            '*',
            'id',
            'DESC',
            $this->ci_page->listRows,
            $this->ci_page->firstRow,
            $key,
            $key_like
        );

        $this->ci_smarty->assign('re',$res,1,'page');

        //载入页面
        $this->ci_smarty->display_ini('other_batches_list.html');
    }

    /**
     * 确认批次/取消批次
     */
    public function confirm_batch()
    {


        if(!empty($_GET['batch_id']) && !empty($_GET['action']))
        {


            $batch_id=$_GET['batch_id'];
            $action=$_GET['action'];
            /**
             * 确认批次的意义就是 一个批次的订单添加完毕。
             * 所以在确认之前要做一些判断，
             * 1、如果该批次状态必须为待审核 status=2,即批次内有订单，但是批次还没有审核
             *
             */
            if($action=='confirm')
            {
                $sql="UPDATE ".tab_m('batches')." SET `confirm_status`=1 WHERE `status`=2 AND id =".$batch_id;
                $res=$this->db->query($sql);

            }
            else if($action=='cancle')
            {
                $sql="UPDATE ".tab_m('batches')." SET `confirm_status`=0 WHERE `status`=2 AND id =".$batch_id;
                $res=$this->db->query($sql);
               
            }

            if($res)
            {
                $msg = array(
                    'msg'  => "操作成功",
                    'type' => 3
                );
                echo json_encode($msg);
                die;
            }else
            {
                $msg = array(
                    'msg'  => '提交失败',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }



        }
    }

}