<?php /* Smarty version 2.6.20, created on 2017-04-19 13:58:29
         compiled from test.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'test.htm', 24, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>网站管理</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">运费管理</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">添加发货地址</a></li>
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
                    <div class="caption"><i class="icon-reorder"></i>添加发货地址</div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action='<?php echo ((is_array($_tmp="logistics/test")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
'  id="form_submit"  class="form-horizontal" method="post" >
                                                <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span>
                        </div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span>
                        </div>
                        <div class="control-group">
                            <label class="control-label">真实姓名<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="personName" class="span6 m-wrap"/><font color="red">必需填写英文姓名</font>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">公司<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="companyName" class="span6 m-wrap"/><font color="red">必需填写英文公司名</font>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">电话号码<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="phoneNumber" class="span6 m-wrap"/>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
                            <button type="submit"  id='submit_add'  class="btn green">提交</button>
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