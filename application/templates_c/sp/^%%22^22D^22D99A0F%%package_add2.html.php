<?php /* Smarty version 2.6.20, created on 2016-12-30 12:05:25
         compiled from package_add2.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package_add2.html', 80, false),)), $this); ?>
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
                    <form action=""  class="form-horizontal" method="post"  id='form_1' enctype="multipart/form-data">
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
                                <label class="control-label">长<span class="required">*</span></label>
                                <div class="controls span3">
                                    <input type="text" name="fedex_length" data-required="1" class="span7 m-wrap"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="control-group">
                                <label class="control-label">高<span class="required">*</span></label>
                                <div class="controls span3">
                                    <input type="text" name="fedex_height" data-required="1" class="span7 m-wrap"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="control-group">
                                <label class="control-label">宽<span class="required">*</span></label>
                                <div class="controls span3">
                                    <input type="text" name="fedex_width" data-required="1" class="span7 m-wrap"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="control-group">
                                <label class="control-label">长宽高计量单位<span class="required">*</span></label>
                                <div class="controls span6">
                                    <select name="fedex_lwh_unit">
                                        <option value=''>请选择</option>
                                        <option value="cm">厘米</option>
                                        <option value="in">英寸</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="hidden" name="type" value="1">
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
<script>

    function load_ini()
    {
        var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');

        var form1 = $('#form_1');
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                fedex_length: {
                    required: true,
                    number:true,
                },
                fedex_height: {
                    required: true,
                    number:true,
                },
                fedex_width: {
                    required: true,
                    number:true,
                },
                fedex_lwh_unit:{
                    required:true,
                }


            },
            messages : {
                fedex_length:{
                    required: '包裹的长必须填写',
                    number:'长必须是数字'
                },
                fedex_height: {
                    required: '包裹的高必须填写',
                    number:'高必须是数字',
                },
                fedex_width: {
                    required: '包裹的宽必须填写',
                    number:'宽必须是数字',
                },
                fedex_lwh_unit:{
                    required:'包裹的单位必须填写',
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
                //encodeURI(msg)
                $modal=$('#ajax-modal');
                error1.hide();
                success1.show();
                success1.find('span').html('正在提交...........');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="package/package_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?fedex_model=1',form1.serialize(),function(msg){
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
                            error1.find('span').html(str.msg);
                        }
                        else if(str.type==2)
                        {
                            //提交成功
                            error1.hide();
                            success1.show();
                            success1.find('span').html('提交成功');
                            window.location='<?php echo ((is_array($_tmp="package/package_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
                        }
                        else if(str.type==3)
                        {
                            error1.hide();
                            success1.show();
                            window.location='';
                            return true;
                        }


                        setTimeout(function(){
                            $modal.load('<?php echo ((is_array($_tmp="sp_index/sp_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
                                $modal.modal();

                            });
                        }, 300);
                    }catch(e){
                        $('body').modalmanager('removeLoading');
                        success1.hide();
                        error1.find('span').html('系统异常');
                        error1.show();
                    };
                });
            }
        });

    }

</script>