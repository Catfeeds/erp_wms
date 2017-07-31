<?php /* Smarty version 2.6.20, created on 2017-05-15 09:41:42
         compiled from package2_batches_date1.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package2_batches_date1.htm', 149, false),)), $this); ?>
<div class="container-fluid">

    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <form action="" id="form_1">
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
                        <label class="control-label span2">FedEx寄件时间<span class="required">*</span></label>
                        <div class="span7" >
                            <div class="input-append date date-picker" >
                                <input name="ship_timestamp" class="m-wrap m-ctrl-medium date-picker" id="date-picker" type="text"  >
                                <span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="hidden" name="item" value="<?php echo $this->_tpl_vars['item']; ?>
">
                    <button type="button" id='submit_add' class="btn green">提交</button>
                </div>
            </form>
            <h1>注释</h1>
            <p style="color: red;">此寄件时间，是指将包裹交给FedEx的时间</p>
                <!--show window-->
        </div>

    </div>
    <!-- END PAGE CONTENT-->
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<link type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/static/css/jquery-ui-timepicker-addon.min.css">
<script type="text/javascript" src="/static/js/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/static/js/jquery-ui-timepicker-zh-CN.js"></script>
<script>
    $('#date-picker').datetimepicker({
    timeFormat: "HH:mm:ss",
    dateFormat: "yy-mm-dd",
    language:  'zh-CN',
    minDate:CurentTime(),

    });
    function CurentTime() {
    var now = new Date();

    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();

    var hh = now.getHours();
    var mm = now.getMinutes();

    var clock = year + "-";

    if (month < 10)
    clock += "0";

    clock += month + "-";

    if (day < 10)
    clock += "0";

    clock += day + " ";

    if (hh < 10)
    clock += "0";

    clock += hh + ":";
    if (mm < 10) clock += '0';
    clock += mm;
    return (clock);
    }

    function load_ini()
    {


        var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');

        var form1 = $('#form_1');
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: ":hidden",
            rules: {
                ship_timestamp:{
                    required:true,
                }

            },
            messages : {
                ship_timestamp:{
                    required:"寄件时间必须填写",
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
                $.post('<?php echo ((is_array($_tmp="package2/package_batches_date1")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
                    //alert(msg);
                    try
                    {
                        eval("var str="+msg);
                        //操作成功
                        if(str.type==1)
                        {
                            error1.show();
                            success1.hide();
                            error1.find('span').html(str.msg);
                            $('body').modalmanager('removeLoading');
                        }
                        else if(str.type==2)
                        {
                            //提交成功
                            error1.hide();
                            success1.show();
                            success1.find('span').html('提交成功');
                            window.location='<?php echo ((is_array($_tmp="package2/package_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
                        }
                        else if(str.type==3)
                        {
                            error1.hide();
                            success1.show();
                            success1.find('span').html('提交成功');
                            $('body').modalmanager('removeLoading');
                            return true;
                        }

                    }catch(e){
                        alert(msg);
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