<?php /* Smarty version 2.6.20, created on 2017-06-01 16:53:04
         compiled from package3_add.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package3_add.html', 53, false),)), $this); ?>
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
                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="control-group">
                                <label class="control-label">运输类型<span class="required">*</span></label>
                                <div class="controls span6">
                                    <select name="type">
                                        <option value='2'>空运模式</option>
                                        <option value="3">海运模式</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                                <div class="form-actions">

                                    <a href="<?php echo ((is_array($_tmp="package3/package_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                type: {
                    required: true,
                }

            },
            messages : {
               type:{
                    required: '运输模式必须选择',
                }

            }
            ,
            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.find('span').html('请完善提交内容再提交');
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                $(element)
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change dony by hightlight
                $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
            },

            success: function (label) {
                label.addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                        .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
            },
            submitHandler: function (form) {

            }
        });

        $("#submit_add").click(function(){
            if(form1.valid()==true)
            {
                modal_confirm('确定要创建此空海运包裹吗',function(){
                    //encodeURI(msg)
                    $modal=$('#ajax-modal');
                    error1.hide();
                    success1.show();
                    success1.find('span').html('正在提交...........');
                    $('body').modalmanager('loading');
                    $.post('<?php echo ((is_array($_tmp="package3/package_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
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
                                window.location='<?php echo ((is_array($_tmp="package3/package_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
                            setTimeout(modal_msg(str.msg),300);
                        }catch(e){
                            $('body').modalmanager('removeLoading');
                            success1.hide();
                            error1.find('span').html('系统异常');
                            error1.show();
                            setTimeout(modal_msg('系统异常'),300);
                        };
                    });
                })

            }



        });

    }

</script>