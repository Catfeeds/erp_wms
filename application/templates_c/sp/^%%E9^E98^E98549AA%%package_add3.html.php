<?php /* Smarty version 2.6.20, created on 2016-12-30 12:09:50
         compiled from package_add3.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package_add3.html', 98, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">包裹管理</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">包裹创建</a></li>
            </ul>
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>包裹创建</div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action=""  class="form-horizontal" onsubmit="return false;" method="post"  id='form_1' enctype="multipart/form-data">
                        <div class="row-fluid">
                            <div id='alert-error_1' class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                <span>请上传订单</span>
                            </div>
                            <div id='alert-success_1' class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                                <span>通过正在提交......</span>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:20px;">
                            <div class="control-group">
                                <label class="control-label span2">机场<span class="required">*</span></label>
                                <div class="span7" >
                                    <input type="text" name="airport" value="<?php echo $this->_tpl_vars['re']['airport']; ?>
" class="m-wrap"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="control-group">
                                <label class="control-label span2">出发时间<span class="required">*</span></label>
                                <div class="span7" >
                                    <div class="input-append date date-picker" data-date="<?php echo $_GET['flight_date']; ?>
" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                        <input name="flight_start_date" class="m-wrap m-ctrl-medium date-picker" type="text"  >
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row-fluid" style="margin-top:10px;">
                                <div class="control-group">
                                    <label class="control-label span2">到港时间<span class="required">*</span></label>
                                    <div class="span7" >
                                        <div class="input-append date date-picker" data-date="<?php echo $_GET['flight_date']; ?>
" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input name="flight_end_date" class="m-wrap m-ctrl-medium date-picker" type="text" >
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row-fluid" style="margin-top:10px;">
                                    <div class="control-group">
                                        <label class="control-label span2">船名航次<span class="required">*</span></label>
                                        <div class="span7" >
                                            <input type="text" name="flight_num" value="<?php echo $this->_tpl_vars['re']['flight_num']; ?>
" class="m-wrap"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row-fluid" style="margin-top:10px;">
                                    <div class="control-group">
                                        <label class="control-label span2">托盘号<span class="required">*</span></label>
                                        <div class="span7" >
                                            <input type="text" name="pallet_no"  class="m-wrap"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row-fluid" style="margin-top:10px;">
                                    <div class="control-group">
                                        <label class="control-label span2">提单号<span class="required">*</span></label>
                                        <div class="span7" >
                                            <input type="text" name="tidan_num"  class="m-wrap"/>
                                        </div>
                                    </div>
                                </div>

                        <div class="form-actions">
                            <input type="hidden" name="type" value="2">
                            <a href="<?php echo ((is_array($_tmp="package/package_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" class="btn red">返回</a>
                            <button type="submit" id='submit_add' class="btn green">提交</button>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<link rel="stylesheet" type="text/css" href="/static/css/datepicker.css">
<script type="text/javascript" src="/static/js/bootstrap-datepicker.js"></script>

<script>

    function load_ini()
    {
        $('.date-picker').datepicker({
            format:'yyyy-mm-dd',
            language: 'cn',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 0,
            startView: 0,
            forceParse: 0,
            showMeridian: 1
        });
        var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');

        var form1 = $('#form_1');


        $("#submit_add").click(function(){
                //encodeURI(msg)
                $modal=$('#ajax-modal');
                error1.hide();
                success1.show();
                success1.find('span').html('正在提交...........');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="package/package_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?fedex_model=2',form1.serialize(),function(msg){
                    //alert(msg);
                    try
                    {
                        eval("var str="+msg);
                        //操作成功
                        if(str.type==1)
                        {
                            //错误提示
                            error1.show();
                            success1.hide();
                            $('body').modalmanager('removeLoading');
                            error1.find('span').html(str.msg);
                        }
                        else if(str.type==2)
                        {
                            //提交成功
                            error1.hide();
                            success1.show();
                            $('body').modalmanager('removeLoading');
                            success1.find('span').html('提交成功');
                            window.location='<?php echo ((is_array($_tmp="package/package_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
                        }
                        else if(str.type==3)
                        {
                            error1.hide();
                            success1.show();
                            $('body').modalmanager('removeLoading');
                            window.location='';
                            return true;
                        }


//                        setTimeout(function(){
//                            $modal.load('<?php echo ((is_array($_tmp="sp_index/sp_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
//                                $modal.modal();
//
//                            });
//                        }, 300);
                    }catch(e){
                        alert(msg);
                        $('body').modalmanager('removeLoading');
                        success1.hide();
                        error1.find('span').html('系统异常');
                        error1.show();
                    };
                });

        });

    }

</script>