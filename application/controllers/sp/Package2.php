<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Package2 extends MY_Controller
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
        $key['type'] = 1;

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
        $this->ci_smarty->display_ini('package2_list.html');
    }

    //包裹 添加
    public function package_add()
    {

        //载入页面
        if ( !empty( $_POST )  )
        {
            //model
            $this->load->model('Base_Package_model');

            //表单验证
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('fedex_type','fedex包裹类型','required');
            $this->form_validation->set_rules('ship_timestamp','fedex预计寄件日期','required');
            $this->form_validation->set_rules('fedex_service_type','包裹服务类型','required');
            if ($this->form_validation->run() == FALSE)
            {
                $msg = array(
                    'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }else{
                if($_POST['fedex_type']=='YOUR_PACKAGING')
                {
                    $this->form_validation->set_rules('fedex_length','长','required');

                    $this->form_validation->set_rules('fedex_height','高','required');
                    $this->form_validation->set_rules('fedex_width','宽','required');
                    $this->form_validation->set_rules('fedex_lwh_unit','长宽高计量单位','required');
                    $this->form_validation->set_rules('fedex_service_type','包裹服务类型','required');
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
                        $package_arr = array();
                        $package_arr['fedex_length']    = $this->input->post('fedex_length',true)*1;
                        $package_arr['fedex_height']    = $this->input->post('fedex_height',true)*1;
                        $package_arr['fedex_width']     = $this->input->post('fedex_width',true)*1;
                        $package_arr['fedex_lwh_unit']  = $this->input->post('fedex_lwh_unit',true);
                        $package_arr['userid']          = $this->user_id;
                        $package_arr['fedex_package_type'] =$this->input->post('fedex_type',true);
                        $package_arr['ship_timestamp']  =$this->input->post('ship_timestamp',true);
                        $package_arr['fedex_service_type']  =$this->input->post('fedex_service_type',true);
                        $package_arr['type'] = $this->input->post('type');

                        $flag = $this->Base_Package_model->fedex_package_add( $package_arr );
                        if ( $flag == 1 )
                        {
                            $msg=array(
                                'msg'  => "操作成功",
                                'type' => 2
                            );
                            echo json_encode($msg);
                            die;
                        }
                        else
                        {
                            $msg = array(
                                'msg'  => '添加失败',
                                'type' => 1
                            );
                            echo json_encode($msg);
                            die;
                        }
                }
            }else{
                    $package_arr = array();
                    $package_arr['fedex_package_type']  = $this->input->post('fedex_type',true);
                    //根据不同的包装类型,如果是自定义包裹，则长宽高自己填写。
                    //其他类型根据文档设置
                    switch ($package_arr['fedex_package_type']) {
                        case 'FEDEX_ENVELOPE':
                            $package_arr['fedex_length']    = 25.1;
                            $package_arr['fedex_width']     = 34.3;
                            $package_arr['fedex_height']     = 1;
                            $package_arr['fedex_lwh_unit']  = 'cm';
                            break;
                        case 'FEDEX_PAK':
                            $package_arr['fedex_length']    = 30.48;
                            $package_arr['fedex_width']     = 39.37;
                            $package_arr['fedex_height']     =1;
                            $package_arr['fedex_lwh_unit']  = 'cm';
                            break;
                        case 'FEDEX_BOX':
                            $package_arr['fedex_length']    = 45.40;
                            $package_arr['fedex_width']     = 31.43;
                            $package_arr['fedex_height']     = 7.62;
                            $package_arr['fedex_lwh_unit']  = 'cm';
                            break;
                        case 'FEDEX_TUBE':
                            $package_arr['fedex_length']    = 96.52;
                            $package_arr['fedex_width']     = 15.24;
                            $package_arr['fedex_height']     = 15.24;
                            $package_arr['fedex_lwh_unit']  = 'cm';
                            break;
                        case 'FEDEX_10KG_BOX':
                            $package_arr['fedex_length']    = 40.16;
                            $package_arr['fedex_width']     = 32.86;
                            $package_arr['fedex_height']     = 25.88;
                            $package_arr['fedex_lwh_unit']  = 'cm';
                            break;
                        case 'FEDEX_25KG_BOX':
                            $package_arr['fedex_length']    = 54.8;
                            $package_arr['fedex_width']     = 42.1;
                            $package_arr['fedex_height']     = 33.5;
                            $package_arr['fedex_lwh_unit']  = 'cm';
                            break;
                    }

                    $package_arr['ship_timestamp']  =$this->input->post('ship_timestamp',true);
                    $package_arr['fedex_service_type']  =$this->input->post('fedex_service_type',true);
                    $package_arr['userid']              = $this->user_id;
                    $package_arr['type'] = $this->input->post('type');

                    $flag = $this->Base_Package_model->fedex_package_add( $package_arr );
                    if ( $flag == 1 )
                    {
                        $msg=array(
                            'msg'  => "操作成功",
                            'type' => 2
                        );
                        echo json_encode($msg);
                        die;
                    }
                    else
                    {
                        $msg = array(
                            'msg'  => '添加失败',
                            'type' => 1
                        );
                        echo json_encode($msg);
                        die;
                    }
                }

            }
        }

        //获取服务类型
        $this->load->config('base_config',true);
        $ServiceType=$this->config->item('ServiceType','base_config');
        $this->ci_smarty->assign('ServiceType',$ServiceType);
        $this->ci_smarty->display_ini('package2_add.html');




    }


    //包裹 加入订单
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

        //载入页面
        $this->ci_smarty->display('package2_add_order.html');
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
            $this->ci_smarty->display_ini('package2_confirm_order_list.html');
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
            $this->ci_smarty->display_ini('package2_order_list.htm');
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

    //包裹 加入订单
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
            $res = $this->Base_Package_model->get_fedex_package_info( 'id,fedex_length,fedex_height,fedex_width,fedex_lwh_unit,fedex_weight,fedex_weight_unit,fedex_service_type,fedex_package_type', array('id' => $_POST['id']) );
            //获取服务类型
            $this->load->config('base_config',true);
            $ServiceType=$this->config->item('ServiceType','base_config');
            $this->ci_smarty->assign('ServiceType',$ServiceType);
            //返回结果
            $this->ci_smarty->assign('re',$res);
        }

        if ( !empty( $_POST['fedex_pakge_id'] ) )
        {

            $package_info = $this->Base_Package_model->get_fedex_package_info( 'status,batches_id,fedex_package_type', array('id' => $_POST['fedex_pakge_id']) );
            //判断数据库的数据是否改变
            if ( $package_info['status'] != 1 )
            {
                $msg = array(
                    'msg'  => '请刷新页面后继续操作',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
            //判断包裹中是否有订单
            $order_info=$this->Base_Order_model->get_orders('id',array('fedex_pakge_id'=>$_POST['fedex_pakge_id'] ));
            if ( !$order_info )
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
            if($package_info['fedex_package_type']==='YOUR_PACKAGING')
            {
                $this->form_validation->set_rules('fedex_length','长','required');
                $this->form_validation->set_rules('fedex_height','高','required');
                $this->form_validation->set_rules('fedex_width','宽','required');
                $this->form_validation->set_rules('fedex_lwh_unit','长宽高计量单位','required');
            }


                $this->form_validation->set_rules('fedex_weight','包裹重量','required');
                $this->form_validation->set_rules('fedex_weight_unit','重量单位','required');



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
                //修改重量、重量单位、包裹状态
                $package_arr = array();
                if($package_info['fedex_package_type']==='YOUR_PACKAGING')
                {
                    $package_arr['fedex_length']      = $this->input->post('fedex_length',true);
                    $package_arr['fedex_height']      = $this->input->post('fedex_height',true);
                    $package_arr['fedex_width']       = $this->input->post('fedex_width',true);
                    $package_arr['fedex_lwh_unit']    = $this->input->post('fedex_lwh_unit',true);
                }


                $package_arr['fedex_weight']      = $this->input->post('fedex_weight',true);
                $package_arr['fedex_weight_unit'] = $this->input->post('fedex_weight_unit',true);
                $package_arr['status']            = 2;
                $flag1 = $this->Base_Package_model->fedex_package_update( $package_arr , array( 'id' => $_POST['fedex_pakge_id'] ) );

                //修改所有订单的包裹状态  将package_status包裹状态改为 已确认  将 status 订单状态改为 已发货
                $flag2 = $this->Base_Order_model->update_order_info( array( 'package_status' => 1,'status'=> 4) , array( 'fedex_pakge_id' => $_POST['fedex_pakge_id'] ) );

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
        $this->ci_smarty->display('package2_confirm.html');
    }

    //包裹预估费用
    public function package_estimated_rate()
    {
        //model
        $this->load->model('Base_Order_model');
        $this->load->model('Base_Package_model');
        $this->load->model('Base_Batches_model');
        if ( !empty( $_POST['fedex_pakge_id'] ) )
        {

            $package_info = $this->Base_Package_model->get_fedex_package_info( 'status,batches_id', array('id' => $_POST['fedex_pakge_id']) );

            //判断数据库的数据是否改变
            if ( $package_info['status'] != 1 )
            {
                $msg = array(
                    'msg'  => '请刷新页面后继续操作',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
            //判断包裹中是否有订单
            $order_info=$this->Base_Order_model->get_orders('id',array('fedex_pakge_id'=>$_POST['fedex_pakge_id'] ));
            if ( !$order_info )
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
            if($package_info['fedex_package_type']==='YOUR_PACKAGING')
            {
                $this->form_validation->set_rules('fedex_length','长','required');
                $this->form_validation->set_rules('fedex_height','高','required');
                $this->form_validation->set_rules('fedex_width','宽','required');
                $this->form_validation->set_rules('fedex_lwh_unit','长宽高计量单位','required');
            }


            $this->form_validation->set_rules('fedex_weight','包裹重量','required');
            $this->form_validation->set_rules('fedex_weight_unit','重量单位','required');
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
                //修改重量、重量单位、包裹状态
                $package_arr = array();
                if($package_info['fedex_package_type']==='YOUR_PACKAGING')
                {
                    $package_arr['fedex_length']      = $this->input->post('fedex_length',true);
                    $package_arr['fedex_height']      = $this->input->post('fedex_height',true);
                    $package_arr['fedex_width']       = $this->input->post('fedex_width',true);
                    $package_arr['fedex_lwh_unit']    = $this->input->post('fedex_lwh_unit',true);
                }
                
                $package_arr['fedex_weight']      = $this->input->post('fedex_weight',true);
                $package_arr['fedex_weight_unit'] = $this->input->post('fedex_weight_unit',true);
                $flag1 = $this->Base_Package_model->fedex_package_update( $package_arr , array( 'id' => $_POST['fedex_pakge_id'] ) );
                if( $flag1  )
                {

                   $res=$this->estimated_cost($_POST['fedex_pakge_id']);

                    if($res==0)
                    {
                        $msg = array(
                            'msg'  => '操作失败',
                            'type' => 1
                        );
                        echo json_encode($msg);
                        die;
                    }
                    elseif($res==1)
                    {
                        $msg = array(
                            'msg'  => '操作成功',
                            'type' => 3
                        );
                        echo json_encode($msg);
                        die;
                    }
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

    /**
     * 预估费率
     *
     */
    private function estimated_cost($id)
    {

        //model
        $this->load->model('Base_Package_model');
        $this->load->model('Admin_Spuser_model');
        $this->load->model('Base_Logistics_model');
        $this->load->model('Base_Order_model');
        $this->load->model('Base_Package_Status_model');
        $this->load->model('Base_Fedex_Package_log_model');
        //查询包裹费率详情表 如果有先删除
        $sql="SELECT * FROM ".tab_m('fedex_package_rateinfo')." WHERE `fedex_package_id`=".$id;
        $rateinfo=$this->db->query($sql);
        if(!empty($rateinfo))
        {
            $sql="DELETE FROM ".tab_m('fedex_package_rateinfo')." WHERE `fedex_package_id`=".$id;
            $this->db->query($sql);
        }

        $packageInfo=$this->Base_Package_model-> get_fedex_packages('id,batches_id,userid,fedex_length,fedex_width,fedex_height,fedex_lwh_unit,fedex_weight,fedex_weight_unit,fedex_service_type,ship_timestamp,fedex_package_type',array('id'=>$id));
        //获取供应商信息 包含
        $user_id_info=$this->Admin_Spuser_model->get_spuser_info('send_addr_id,end_addr_id,dutiesPayment_id,payor_id,fedex_account',array('id'=>$packageInfo[0]['userid']));
        //获取基础配置信息
        $sql="SELECT * FROM ".tab_m('fedex_account')." WHERE id=".$user_id_info['fedex_account'];
        $fedex_account=$this->db->query($sql)->row_array();

        $UserCredential=array();
        $UserCredential['CustomerTransactionId']=$this->user_id.'-'.$packageInfo['id'];
        $UserCredential['Key']=$fedex_account['Key'];
        $UserCredential['Password']=$fedex_account['Password'];
        $UserCredential['AccountNumber']=$fedex_account['AccountNumber'];
        $UserCredential['MeterNumber']=$fedex_account['MeterNumber'];

        //加载普通服务费率插件
        $this->load->library('CI_FedexRate');
        //设置保额
        $insuredvalue = array(
            'ammount' => 100,
            'currency'=>'USD'
        );

        //绑定基础信息
        $this->ci_fedexrate->UserCredential=$UserCredential;
        $this->ci_fedexrate->addTotalInsuredValue($insuredvalue);

        //设置服务类型
        $this->ci_fedexrate->service_type=$packageInfo[0]['fedex_service_type'];
        //设置包裹类型
        $this->ci_fedexrate->package=$packageInfo[0]['fedex_package_type'];

        //设置预估寄件时间
        $this->ci_fedexrate->ship_timestamp=strtotime($packageInfo[0]['ship_timestamp']);

        //绑定发件方信息
        $shiper=$this->Base_Logistics_model->get_fedex_user_info('personName,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode',
            array('id'=>$user_id_info['send_addr_id']));

        //绑定收件方信息
        $reci =$this->Base_Logistics_model->get_fedex_user_info('personName,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode,Address_Residential',
            array('id'=>$user_id_info['end_addr_id']));
        $this->ci_fedexrate->addRecipient($reci);
        $this->ci_fedexrate->addShipper($shiper);

        //设置运费信息
        $payor = $this->Base_Logistics_model->get_fedex_user_info('type,personName,account,companyName,phoneNumber,Address_streetLines,Address_City,Address_StateOrProvinceCode,Address_PostalCode,Address_CountryCode',
            array('id'=>$user_id_info['payor_id']));
        //介于FedEx费率无法返回第三方账户的费用，都暂时使用发货方
        $payor['paymentType']='SENDER';
        $payor['account']=$this->config->item('AccountNumber','fedex_config');
        $this->ci_fedexrate->addShippingChargesPayment($payor);

        //设置包裹描述
        foreach ( $packageInfo as $key => $value){
            $addPackageLineItem[$key]['SequenceNumber']= $key+1;
            $addPackageLineItem[$key]['GroupPackageCount']= $key+1;
            $addPackageLineItem[$key]['Weight']['Value'] = $value['fedex_weight'];
            $addPackageLineItem[$key]['Weight']['Units'] =$value['Units']= strtoupper($value['fedex_weight_unit']);
            $addPackageLineItem[$key]['Dimensions']['Length'] = $value['fedex_length'];
            $addPackageLineItem[$key]['Dimensions']['Width'] = $value['fedex_width'];
            $addPackageLineItem[$key]['Dimensions']['Height'] = $value['fedex_height'];
            $addPackageLineItem[$key]['Dimensions']['Units'] = strtoupper($value['fedex_lwh_unit']);
        }
        $this->ci_fedexrate->packageLineItem = $addPackageLineItem;



        $this->ci_fedexrate->createFedexRateRequest();

        $res=$this->ci_fedexrate->getRate();


        if($res===0){
            $fee = $this->ci_fedexrate->response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount;
            $currency =$this->ci_fedexrate->response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Currency;

            $flag1=$this->Base_Package_model->fedex_package_update(array('estimated_rate'=>$fee,'estimated_rate_currency'=>$currency),array('id'=>$id));
            $list = json_encode($this->ci_fedexrate->response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail);
            $list = json_decode($list,true);
            $data1=array();
            $data=array();
            foreach ($list as $key=>$val){
                if(is_array($val) &&  array_key_exists('Amount',$val) && !is_array($val['Amount'])){

                    $data['fedex_package_id'] = $id;
                    $data['fee_item']=$key;
                    $data['fee_value']=$val['Amount'];
                    $data['fee_currency']=$val['Currency'];
                    $flag=$this->Base_Package_model->fedex_package_rate_add($data);
                }
            }

            if($flag){

                $this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"FedEx预估费用成功"));
                $this->assign_estimated_fee($id,$fee,$currency);
                return 1;
            }else{

                $this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"FedEx预估费用成功,插入数据库数据出错，请联系管理员"));
                return 0;
            }

        }
        elseif($res ===1)
        {
            $error=json_encode($this->ci_fedexrate->response->Notifications);
            $error=json_decode($error,true);
            if(array_key_exists(0,$error)){
                $failreason='错误码:【'.$error[0]['Code'].'】错误信息:【'.$error[0]['Message'].'】';
                $this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"预估FedEx费用失败:".$failreason));
                return 0;

            }else{

                $failreason='错误码:【'.$error['Code'].'】错误信息:【'.$error['Message'].'】';
                $this->Base_Fedex_Package_log_model->fedex_package_log_add(array('pk_id'=>$id,'time'=>date('Y-m-d H:i:s',time()),'content'=>"预估FedEx费用失败:".$failreason));
                return 0;
            }

        }

    }


    /**
     * 预估订单 运费
     * @param $package_id		包裹id
     * @param $estimated_rate	包裹预估费用
     * @param $abroad_currency  币种
     */
    private function assign_estimated_fee($package_id,$estimated_rate,$abroad_currency)
    {
        //查询该包裹下所有的订单
        $this->load->model('Base_Order_model');
        $order_arr=$this->Base_Order_model->get_orders('id,status,is_assign_fee,assign_fee,total_weight',array('fedex_pakge_id'=>$package_id));
        $total_weight=0;//总重量
        foreach( $order_arr as $key=>$value)
        {
            if($value['is_assign_fee']==1)
            {
                $estimated_rate=$estimated_rate-$value['assign_fee'];

            }
            else
            {
                $total_weight+=$value['total_weight'];
            }
        }

        $per_fee=bcdiv($estimated_rate,$total_weight,5);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       		$per_cost_fee=bcdiv($cost,$total_weight,5)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ;


        foreach ( $order_arr as $k=>$v)
        {
            $this->db->query("UPDATE ".tab_m('order')." SET `abroad_currency`='".$abroad_currency."' WHERE `id`=".$v['id']);
            if($v['is_assign_fee']==0)
            {
                $this->db->query("UPDATE ".tab_m('order')." SET `assign_fee`=".ceil(bcmul($per_fee,$v['total_weight'],2))." WHERE `id`=".$v['id']);
            }

        }
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

    //包裹批量投递
    public function  package_batches_date()
    {
        if(!empty($_POST))
        {
            $data=$_POST['data'];
            $data='&'.$data;
            $this->ci_smarty->assign('data',$data);
            $this->ci_smarty->display('package2_batches_date.htm');
        }
    }
    
    //包裹批量投递
    public function package_batches_date1()
    {
        if(!empty($_GET))
        {
            $item=$_GET['item'];
            $item=implode('&',$item);

            $this->ci_smarty->assign('item',$item);
            $this->ci_smarty->assign('show_ajax',1);
            $this->ci_smarty->display_ini('package2_batches_date1.htm');
        }

        if(!empty($_POST))
        {
            //model
            $this->load->model('Base_Package_model');
            //先查询包裹的状态
            $item=$_POST['item'];

            $item_arr=explode('&',$item);

            //防止并发
            $flag=1;
            foreach ( $item_arr as $key=>$value)
            {
                $pack_status=$this->Base_Package_model->get_fedex_package_info('status',array('id'=>$value));
                if($pack_status['status']==3)
                {
                    $flag=2;
                }
            }

            if($flag==1)
            {
                //表单验证
                $this->load->library('MY_form_validation');
                $this->form_validation->set_rules('ship_timestamp','FedEx寄件时间','required');
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
                    $ship_timestamp=$this->input->post('ship_timestamp',true);
                    foreach ( $item_arr as $key=>$value)
                    {
                        $res=$pack_status=$this->Base_Package_model->fedex_package_update(array('ship_timestamp'=>$ship_timestamp),array('id'=>$value));

                    }

                    if ( $res )
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
            elseif($flag==2)
            {

                $msg = array(
                    'msg'  => '请刷新页面后操作',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }



        }
    }



}