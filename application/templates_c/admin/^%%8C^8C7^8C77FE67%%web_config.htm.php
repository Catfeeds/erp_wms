<?php /* Smarty version 2.6.20, created on 2017-02-27 15:45:24
         compiled from web_config.htm */ ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12">
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
      		<?php echo $this->_tpl_vars['select_admin_name']; ?>

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
          <div class="caption"><i class="icon-reorder"></i><?php echo $this->_tpl_vars['falg_name']; ?>
</div>
        </div>
        <div class="portlet-body form"> 
          <!-- BEGIN FORM-->
          <form action=""  class="form-horizontal" method="post" >
             <div class="control-group">
              <label class="control-label">网站名称<span class="required">*</span></label>
              <div class="controls">
                  <input type="text" name="config[web_name]" value="<?php echo $this->_tpl_vars['web_config']['web_name']; ?>
" data-required="1" class="span3 m-wrap"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">网站地址<span class="required">*</span></label>
              <div class="controls">
                  <input type="text" name="config[web_url]" value="<?php echo $this->_tpl_vars['web_config']['web_url']; ?>
" data-required="1" class="span3 m-wrap"/>
                  <p style="color:#F00;">如：http://www.abc.com  ,http://test.abc.com</p>
              </div>
            </div>
           <div class="control-group">
              <label class="control-label">网站域名<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="config[web_base]" value="<?php echo $this->_tpl_vars['web_config']['web_base']; ?>
" data-required="1" class="span3 m-wrap"/>
                 <p style="color:#F00;">如：非二级域名 .abc.com  二级域名 test.abc.com</p>
              </div>
           </div>

           <div class="control-group">
              <label class="control-label">Copyright <span class="required">*</span></label>
              <div class="controls">
                    <textarea name="config[copyright]"><?php echo $this->_tpl_vars['web_config']['copyright']; ?>
</textarea>
              </div>
            </div>
            
           
            <div class="form-actions">
              <button type="submit" class="btn green">提交</button>
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
<script>
var server_auth="<?php echo $this->_tpl_vars['ueditor_auth']; ?>
";

function  set_back_pic(pic)
{ 
	$('#upload_pic').val(pic);
	$('#upload_pic_bg').attr('src',pic);
	$('body').modalmanager('removeLoading');
}


</script> 