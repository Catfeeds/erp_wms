<?php /* Smarty version 2.6.20, created on 2017-05-10 13:30:06
         compiled from order_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_edit.htm', 16, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="modal-body">
        <div class="tabbable tabbable-custom" id='tab_all'>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1_1" data-id='tab_1_1' data-toggle="tab">编辑订单</a></li>
                <li class=""><a href="#tab_1_2" data-id='tab_1_2' data-toggle="tab">添加运单号</a></li>
                <li class=""><a href="#tab_1_3" data-id='tab_1_3' data-toggle="tab">指定预估运费</a></li>
                <li class=""><a href="#tab_1_4" data-id='tab_1_4' data-toggle="tab">指定成本运费</a></li>
                <li class=""><a href="#tab_1_5" data-id='tab_1_5' data-toggle="tab">指定实收运费</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <iframe src="<?php echo ((is_array($_tmp='order/order_edit1')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
" style="width:98%;height:500px;" ></iframe>
                </div>

                <div class="tab-pane  " id="tab_1_2">
                    <iframe src="<?php echo ((is_array($_tmp='order/order_add_logis_no')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
" style="width:98%;height:500px;" ></iframe>
                </div>

                <div class="tab-pane  " id="tab_1_3">
                    <iframe  style=" width:100%; height:600px;" src="<?php echo ((is_array($_tmp='order/order_assign_fee')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
&act=1" > </iframe>
                </div>

                <div class="tab-pane  " id="tab_1_4">
                    <iframe  style=" width:100%; height:600px;" src="<?php echo ((is_array($_tmp='order/order_assign_fee')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
&act=2" > </iframe>
                </div>

                <div class="tab-pane  " id="tab_1_5">
                    <iframe  style=" width:100%; height:600px;" src="<?php echo ((is_array($_tmp='order/order_assign_fee')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
&act=3" > </iframe>
                </div>



            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/datepicker.css">
<script type="text/javascript" src="/static/js/bootstrap-datepicker.js"></script>