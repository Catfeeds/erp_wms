<?php /* Smarty version 2.6.20, created on 2017-01-09 14:39:44
         compiled from package2_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package2_edit.htm', 215, false),)), $this); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="form">
                <!-- BEGIN FORM-->
                <form action="" id="form_eidt" class="form-horizontal" method="post" >
                    <table class="table table-bordered table-hover dataTable" id="table_1">
                                                <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span> </div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span> </div>
                        <thead>
                        <tr>
                            <th bgcolor="#E2EEFE" colspan="99">包裹信息</th>
                        </tr>
                        </thead>
                        <tr>
                            <th width="250px">包裹编号：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>
                            <th width="250px">会员ID：<?php echo $this->_tpl_vars['re']['userid']; ?>
</th>
                        </tr>

                        <thead>
                        <tr>
                            <th bgcolor="#E2EEFE" colspan="99">包裹信息修改</th>
                        </tr>
                        </thead>
                        <tr>
                            <td colspan="99">
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
                                                <input name="flight_start_date" class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php echo $this->_tpl_vars['re']['flight_start_date']; ?>
" >
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
                                                    <input name="flight_end_date" class="m-wrap m-ctrl-medium date-picker" type="text"  value="<?php echo $this->_tpl_vars['re']['flight_end_date']; ?>
">
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
                                                    <input type="text" name="pallet_no" value="<?php echo $this->_tpl_vars['re']['pallet_no']; ?>
" class="m-wrap"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row-fluid" style="margin-top:10px;">
                                            <div class="control-group">
                                                <label class="control-label span2">提单号<span class="required">*</span></label>
                                                <div class="span7" >
                                                    <input type="text" name="tidan_num"   value="<?php echo $this->_tpl_vars['re']['tidan_num']; ?>
" class="m-wrap"/>
                                                </div>
                                            </div>
                                        </div>


                            </td>
                        </tr>

                        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
                        <input type="hidden" name="status" value="<?php echo $this->_tpl_vars['re']['status']; ?>
"/>
                    </table>
                    <div class="form-actions">
                        <button type="button" id='submit_eidt' class="btn red">提交</button>
                    </div>
                </form>
            </div>
        </div>
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
            modify_states();

        }



        var modify_states = function()
        {
            var error1=$('#alert-error_1');
            var success1=$('#alert-success_1');
            var form1 = $('#form_eidt');
            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    airport: {
                        required: true,
                    },
                    flight_start_date: {
                        required: true,
                    },
                    flight_end_date: {
                        required: true,
                    },
                    flight_num:{
                        required:true,
                    },
                    pallet_no:{
                        required:true,
                    },
                    tidan_num:{
                        required:true,
                    },
                },
                messages : {
                    airport:{
                        required: '机场/港口必须填写',
                    },
                    flight_start_date: {
                        required: '出港时间必须填写',
                    },
                    flight_end_date: {
                        required: '到港时间必须填写',
                    },
                    pallet_no:{
                        required:'托盘号必须填写',
                    },
                    flight_num:{
                        required:'航班号必须填写',
                    },
                    tidan_num:{
                        required:'提单号必须填写',
                    },

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
            $("#submit_eidt").click(function(){
                if(form1.valid()==true)
                {
                    $modal=$('#ajax-modal');
                    error1.hide();
                    success1.show();
                    success1.find('span').html('正在提交...........');
                    $('body').modalmanager('loading');
                    $.post('<?php echo ((is_array($_tmp="package/package2_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg)
                    {
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
                                location.reload();
                            }
                            else if(str.type==3)
                            {
                                //刷新主页面
                                f_main_index();
                                return true;
                            }
                            setTimeout(function()
                            {
                                $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function()
                                {
                                    $modal.modal();
                                });
                            }, 300);
                        }
                        catch(e)
                        {
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