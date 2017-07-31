<?php /* Smarty version 2.6.20, created on 2017-02-28 11:32:51
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/package3_confirm.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/package3_confirm.html', 189, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">包裹【<?php echo $this->_tpl_vars['re']['id']; ?>
】确认</h4>
</div>
<div class="modal-body" >
    <div class="tab-content">
        <div  >
            <form action="" id="form_confirm" class="form-horizontal" method="post">

                                <div id='alert-error_1' class="alert alert-error hide">
                    <button class="close" data-dismiss="alert"></button>
                    <span>提交失败</span>
                </div>
                <div id='alert-success_1' class="alert alert-success hide">
                    <button class="close" data-dismiss="alert"></button>
                    <span>提交成功</span>
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

                <div style="color:red; margin-left:80px;">* 提示：请确认所有信息后，最后确认提交</div>

                <input type="hidden" name="fedex_pakge_id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
            </form>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" id='btn_confirm' class="btn green">确认</button>
    <button type="button" data-dismiss="modal" class="btn">关闭</button>
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>


<script>

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
    var error1      =$('#alert-error_1');
    var success1    =$('#alert-success_1');
    var form1       =$('#form_confirm');
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

    $("#btn_confirm").click(function()
    {
        if(form1.valid()==true){
            $.post('<?php echo ((is_array($_tmp="package3/package_confirm")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$("#form_confirm").serialize(),function(msg)
            {
                //alert(msg);
                try
                {
                    eval("var str="+msg);
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
                        success1.find('span').html(str.msg);
                        location.reload();
                    }
                }catch(e){
                   // alert(e);
                    error1.show();
                    success1.hide();
                    error1.find('span').html('系统异常');
                };
            });
        }

    });

</script>