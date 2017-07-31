<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Package3 extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->load_sp_menu();
    }


    //包裹 列表
    public function package_list()
    {
        //model
        $this->load->model('Base_Package_model');
        $this->load->model('Base_Order_model');

        //搜索
        $key      = array();
        $key_like = array();

        //只显示会员包裹
        $key['userid'] = $this->user_id;
        $key['type!='] ='1';

        if( isset($_GET) )
        {
            //非模糊字段 搜索
            $search_key      = array( 'batches_id' , 'id' , 'status' , 'fedex_index' , 'fedex_index_sqnumber' );
            //模糊字段 搜索
            $search_key_like = array();
            foreach ( $_GET as $k => $v )
            {
                $skey = substr( $k , 7 , strlen($k)-7 );
                if ( $k != 'search_page_num' && substr( $k , 0 , 7 ) == 'search_' && !in_array( $v , array('all','') ) )
                {
                    //非模糊字段
                    if ( in_array( $skey , $search_key ) )
                    {
                        $key[$skey] = $v;
                    }
                    //模糊字段
                    if ( in_array( $skey , $search_key_like ) )
                    {
                        $key_like[$skey] = $v;
                    }
                }
            }
        }

        //分页
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url = site_url( $this->class."/".$this->method );
        $search_page_num = array( 'all' => 15, 1 => 15, 2 => 30 , 3 => 50 );
        $this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
        if ( !$this->ci_page->__get('totalRows') )
        {
            $this->ci_page->totalRows = $this->Base_Package_model->fedex_package_list_rows( $key , $key_like );
        }

        //列表
        $res = array();
        $res['page'] = $this->ci_page->prompt();
        $res['list'] = $this->Base_Package_model->fedex_package_list(
            '*',
            'id',
            'DESC',
            $this->ci_page->listRows,
            $this->ci_page->firstRow,
            $key,
            $key_like
        );



        //返回结果
        $this->ci_smarty->assign('re',$res,1,'page');

        //载入页面
        $this->ci_smarty->display_ini('package3_list.html');
    }

    //包裹 添加
    public function package_add()
    {

        if(!empty($_POST)){

            //model
            $this->load->model('Base_Package_model');
            //表单验证
            $this->load->library('MY_form_validation');

            $this->form_validation->set_rules('type','运输模式','required');

            if($this->form_validation->run()==FALSE){
                $msg = array(
                    'type' =>1,
                    'msg'=>validation_errors("<i class='icon-comment-alt'></i>"),
                );
                echo json_encode($msg);
                die;
            }else{
                $package_arr['type'] = $this->input->post('type',true);
                $package_arr['userid']= $this->user_id;
                $flag = $this->Base_Package_model->fedex_package_add( $package_arr );

                if( $flag ){
                    $msg = array(
                        'msg'  =>'操作成功',
                        'type' => 2
                    );
                    echo json_encode($msg);
                    die;
                }else{
                    $msg = array(
                        'msg'  =>'操作失败',
                        'type' =>1
                    );
                    echo json_encode($msg);
                    die;
                }
            }


        }
        $this->ci_smarty->display_ini('package3_add.html');




    }

    /**
     * 验证日期格式的回调方法
     */
    public function check_date($str)
    {
        $data=explode('-',$str);
        if(checkdate($data[1],$data[2],$data[0])){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //包裹 加入订单 或 查看订单
    public function package_add_order()
    {
        if ( !empty( $_POST['id'] ) )
        {
            $res = array();
            $res['id'] = $this->input->post('id',true);
            $res['type']=$_POST['action'];
            //返回结果
            $this->ci_smarty->assign('re',$res);
        }
        //加载页面

        //载入页面
        $this->ci_smarty->display('package3_add_order.html');
    }
    

    //包裹 订单查询
    public function package_order_list()
    {


        if ($_GET['type']=='list')
        {
            if ( $_GET['fedex_pakge_id'] )
            {
                //model
                $this->load->model('Base_Package_model');
                $this->load->model('Base_Batches_model');

                //包裹ID
                $res['fedex_pakge_id'] = $_GET['fedex_pakge_id'];

                //查询该包裹下的订单
                $this->load->model('Base_Order_model');

                //搜索
                $key = array();
                $key_like = array();
                $key['fedex_pakge_id'] = $_GET['fedex_pakge_id'];
                //分页
                $this->load->library('CI_page');
                $this->ci_page->Page();
                $this->ci_page->url = site_url($this->class."/".$this->method);
                $search_page_num = array( 'all' => 15 , 1 => 15 , 2 => 30 , 3 => 50 );
                $this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
                if(!$this->ci_page->__get('totalRows'))
                {
                    $this->ci_page->totalRows = $this->Base_Order_model->order_list_rows( $key , $key_like );
                }

                //列表
                $res['page'] = $this->ci_page->prompt();
                $res['list'] = $this->Base_Order_model->order_list(
                    'id,fedex_pakge_id,import_id,batches_id,consignee,province,city,area,consignee_address,consignee_mobile,logistics_no',
                    'id',
                    'DESC',
                    $this->ci_page->listRows,
                    $this->ci_page->firstRow,
                    $key,
                    $key_like
                );

                //返回结果
                $this->ci_smarty->assign('re',$res);
            }
            //加载页面
            $this->ci_smarty->assign('show_ajax',1);
            $this->ci_smarty->display_ini('package3_confirm_order_list.html');
        }else{
            $res = array();

            if ( $_GET['fedex_pakge_id'] )
            {
                //model
                $this->load->model('Base_Package_model');
                $this->load->model('Base_Batches_model');

                //包裹ID
                $res['fedex_pakge_id'] = $_GET['fedex_pakge_id'];
                //查询批次列表
                $res['batches']= $this->db->query('SELECT `id`, `batches_name`FROM `dferp_batches`WHERE (`userid` = '.$this->user_id.' AND `status` = 4) OR (`huoyunzhan_uid` = '.$this->user_id.' AND `status` = 4)')->result_array();
                //查询该包裹下的订单
                $this->load->model('Base_Order_model');

                //搜索
                $key = array();
                $key_like = array();
                $key['fedex_pakge_id'] = $_GET['fedex_pakge_id'];
                //分页
                $this->load->library('CI_page');
                $this->ci_page->Page();
                $this->ci_page->url = site_url($this->class."/".$this->method);
                $search_page_num = array( 'all' => 15 , 1 => 15 , 2 => 30 , 3 => 50 );
                $this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
                if(!$this->ci_page->__get('totalRows'))
                {
                    $this->ci_page->totalRows = $this->Base_Order_model->order_list_rows( $key , $key_like );
                }

                //列表
                $res['page'] = $this->ci_page->prompt();
                $res['list'] = $this->Base_Order_model->order_list(
                    'id,fedex_pakge_id,import_id,batches_id,consignee,province,city,area,consignee_address,consignee_mobile,logistics_no',
                    'id',
                    'DESC',
                    $this->ci_page->listRows,
                    $this->ci_page->firstRow,
                    $key,
                    $key_like
                );

                //返回结果
                $this->ci_smarty->assign('re',$res);
            }

            if ( $_GET['batches_id'] )
            {
                //model
                $this->load->model('Base_Order_model');

                //搜索
                $key      = array();
                $key_like = array();
                $key['batches_id']     = $_GET['batches_id'];
                $key['package_status'] = 0;

                if ( !empty( $_GET['order_status'] ) && $_GET['order_status'] == '-1' )
                {
                    $key['fedex_pakge_id'] = 0;
                }
                elseif ( !empty( $_GET['order_status'] ) && $_GET['order_status'] == '1' )
                {
                    $key['fedex_pakge_id !='] = 0;
                }

                if ( !empty( $_GET['consignee_mobile'] ) )
                {
                    $key['consignee_mobile'] = $_GET['consignee_mobile'];
                }

                //分页
                $this->load->library('CI_page');
                $this->ci_page->Page();
                $this->ci_page->url = site_url($this->class."/".$this->method);
                $search_page_num = array( 'all' => 15 , 1 => 15 , 2 => 30 , 3 => 50 );
                $this->ci_page->listRows =! isset( $_GET['search_page_num'] ) || empty( $search_page_num[$_GET['search_page_num']] ) ? 15 : $search_page_num[$_GET['search_page_num']];
                if(!$this->ci_page->__get('totalRows'))
                {
                    $this->ci_page->totalRows = $this->Base_Order_model->order_list_rows( $key , $key_like );
                }

                //列表
                $res['page'] = $this->ci_page->prompt();
                $res['list'] = $this->Base_Order_model->order_list(
                    'id,fedex_pakge_id,import_id,batches_id,consignee,province,city,area,consignee_address,consignee_mobile,logistics_no',
                    'id',
                    'DESC',
                    $this->ci_page->listRows,
                    $this->ci_page->firstRow,
                    $key,
                    $key_like
                );
                $res['fedex_pakge_id'] = $_GET['fedex_pakge_id'];
                $res['batches_id']     = $_GET['batches_id'];
                $this->ci_smarty->assign('re',$res,1,'page');
            }
            
            //加载页面
            $this->ci_smarty->assign('show_ajax',1);
            $this->ci_smarty->display_ini('package3_order_list.htm');
        }
        
        
        
    }

    //包裹 订单添加包裹
    public function package_fedex_pakge_id()
    {
        if ( $_POST )
        {
            //model
            $this->load->model('Base_Order_model');
            $this->load->model('Base_Package_model');

            $id = $_POST['fedex_pakge_id'];
            //加入包裹/取消包裹
            if ( $_GET['type'] == 1 )
            {
                $fedex_pakge_id = $_POST['fedex_pakge_id'];
            }
            elseif ( $_GET['type'] == 2 )
            {
                $fedex_pakge_id = 0;
            }

            unset( $_POST['fedex_pakge_id'] );
            unset( $_POST['batches_id'] );

            //整理修改数据
            $order_arr = array();
            foreach ( $_POST as $key => $value )
            {
                if ( $value != $fedex_pakge_id )
                {
                    $order_arr[] = array( 'id' => $key , 'fedex_pakge_id' => $fedex_pakge_id );
                }
            }

            //判断提交数据是否改变
            if( !empty($order_arr) )
            {
                //修改订单
                $flag1 = $this->Base_Order_model->order_update_batches( $order_arr );



                if( $flag1 )
                {
                    $msg=array(
                        'msg'=>'操作成功',
                        'type'=>3
                    );
                    echo json_encode($msg);
                    die;
                }
                else
                {
                    $msg=array(
                        'msg'=>'操作失败',
                        'type'=>1
                    );
                    echo json_encode($msg);
                    die;
                }
            }
            else
            {
                $msg=array(
                    'msg'=>'操作成功',
                    'type'=>3
                );
                echo json_encode($msg);
                die;
            }
        }
    }

    //包裹 确认包裹
    public function package_confirm()
    {
        //model
        $this->load->model('Base_Order_model');
        $this->load->model('Base_Package_model');
        $this->load->model('Base_Batches_model');

        if ( !empty( $_POST['id'] ) )
        {
            $res = array();
            //查询包裹信息
            $res = $this->Base_Package_model->get_fedex_package_info( 'id', array('id' => $_POST['id']) );
            //返回结果
            $this->ci_smarty->assign('re',$res);
        }

        if ( !empty( $_POST['fedex_pakge_id'] ) )
        {

            $package_info = $this->Base_Package_model->get_fedex_package_info( 'status,batches_id', array('id' => $_POST['fedex_pakge_id']) );
            //判断数据库的数据是否改变
            if ( $package_info['status'] != 1 )
            {
                $msg = array(
                    'msg'  => '提交失败',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
            //判断包裹内是否有订单
            $has_order=$this->Base_Order_model->get_orders('id',array('fedex_pakge_id'=>$_POST['fedex_pakge_id']));

            if ( empty($has_order) )
            {
                $msg = array(
                    'msg'  => '包裹内不存在订单',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }

            //表单验证
            $this->load->library('MY_form_validation');
            $this->my_form_validation->set_rules('airport','机场/港口','required');
            $this->my_form_validation->set_rules('flight_start_date','出发时间','required|check_date');
            $this->my_form_validation->set_rules('flight_end_date','到港时间','required|check_date');
            $this->my_form_validation->set_rules('flight_num','航班号','required');
            $this->my_form_validation->set_rules('pallet_no','托盘号','required');
            $this->my_form_validation->set_rules('tidan_num','提单号','required');
            if ($this->my_form_validation->run() == FALSE)
            {
                $msg = array(
                    'msg'  => $this->my_form_validation->error_string(),
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                //修改重量、重量单位、包裹状态
                $package_arr = array();
                $package_arr['airport']      = $this->input->post('airport',true);
                $package_arr['flight_start_date']      = $this->input->post('flight_start_date',true);
                $package_arr['flight_end_date']       = $this->input->post('flight_end_date',true);
                $package_arr['flight_num']    = $this->input->post('flight_num',true);
                $package_arr['pallet_no']      = $this->input->post('pallet_no',true);
                $package_arr['tidan_num'] = $this->input->post('tidan_num',true);
                $package_arr['status']            = 2;
                $flag1 = $this->Base_Package_model->fedex_package_update( $package_arr , array( 'id' => $_POST['fedex_pakge_id'] ) );

                //修改所有订单的包裹状态
                $flag2 = $this->Base_Order_model->update_order_info( array( 'package_status' => 1 ) , array( 'fedex_pakge_id' => $_POST['fedex_pakge_id'] ) );

                //查询所有订单所属批次，然后查询这些批次下的所有订单的包裹状态是否已经改为  已确认，如果是，将该批次状态修改为已发货 否则 不变
                $batches=$this->db->query('SELECT batches_id  FROM '.tab_m('order').'  where fedex_pakge_id ='.$_POST['fedex_pakge_id'].' GROUP BY batches_id ')->result_array();

                //查询这些批次下的所有订单



                foreach ($batches as $key =>$val){
                    $this->db->insert(tab_m('package_batches'),array('fedex_package_id'=>$_POST['fedex_pakge_id'],'batches_id'=>$val['batches_id']));
                    $package_arr=$this->Base_Order_model->get_orders('id',array('batches_id'=>$val['batches_id'],'package_status'=>0));
                    if(!$package_arr){//说明此批次下所有订单的包裹状态全部已经改为已确认
                        $this->Base_Batches_model->batches_uqdate(array('status'=>5),array('id'=>$val['batches_id']));
                    }
                }

                if( $flag1 && $flag2 )
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
        $this->ci_smarty->display('package3_confirm.html');
    }

    //包裹多选框 批量审批
    public function package_checkbox()
    {

        //model
        $this->load->model('Base_Package_model');



        if (!empty($_GET['type']))
        {
            //申请备案
            if ( $_GET['type'] == 1 )
            {
                $filing_status = array();
                foreach ( $_POST as $k => $v )
                {
                    $filing_status[] = array('id' => $k,'status' => 4);
                }
                $flag = $this->Base_Package_model->package_uqdate_status($filing_status);
                if ( !empty($flag) )
                {
                    $msg = array(
                        'msg'  => '操作成功',
                        'type' => 3
                    );
                    echo json_encode($msg);
                    die;
                }
                else
                {
                    $msg = array(
                        'msg'  => '操作失败',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }
            }
        }
    }



}