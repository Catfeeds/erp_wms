<?php /* Smarty version 2.6.20, created on 2017-04-18 14:03:55
         compiled from supplier_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'supplier_edit.htm', 105, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>备案管理</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">商户管理</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">编辑商户</a></li>
            </ul>
        </div>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>编辑商户</div>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="" id="form_supplier_add" class="form-horizontal" method="get" onsubmit="return load_sub();">
                                        <div id='alert-error_1' class="alert alert-error hide">
                        <button class="close" data-dismiss="alert"></button>
                        <span>提交失败</span> </div>
                    <div id='alert-success_1' class="alert alert-success hide">
                        <button class="close" data-dismiss="alert"></button>
                        <span>提交成功</span> </div>
                    <div class="control-group">
                        <label class="control-label">用户账号<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" name="user"  value="<?php echo $this->_tpl_vars['re']['user']; ?>
" disabled="disabled" class="span6 m-wrap"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">用户密码<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" name="pass" data-required="1" class="span6 m-wrap"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">操作密码<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" name="act_pass" data-required="1" class="span6 m-wrap"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">公司名称<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" name="company" value="<?php echo $this->_tpl_vars['re']['company']; ?>
" data-required="1" class="span6 m-wrap"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">手机号码<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" name="mobile" value="<?php echo $this->_tpl_vars['re']['mobile']; ?>
" data-required="1" class="span6 m-wrap"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">是否关闭<span class="required">*</span></label>
                        <div class="controls">
                            <select size="1" id="form_2_select2"  name="status" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                                <option <?php if ($this->_tpl_vars['re']['status'] == '1'): ?>selected="selected"<?php endif; ?> value='1'>开启
                                </option>
                                <option <?php if ($this->_tpl_vars['re']['status'] == '2'): ?>selected="selected"<?php endif; ?> value='2'>关闭
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
">
                        <button type="button" id='submit_supplier_add' class="btn green">提交</button>
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
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script>
    $('.form_2_select2').select2({
        placeholder: "请选择",
        allowClear: true
    });
    function load_ini()
    {

        var form1=$('#form_supplier_add');
        $("#submit_supplier_add").click(function(){
             //encodeURI(msg)
                $modal=$('#ajax-modal');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="supplier/supplier_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
                    try
                    {
                        eval("var str="+msg);
                        //操作成功
                        if(str.type==1)
                        {
                            //错误提示

                        }
                        else if(str.type==2)
                        {
                            //提交成功

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
                    };
                });

        });


    }

</script>