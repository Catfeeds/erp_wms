<?php /* Smarty version 2.6.20, created on 2016-12-28 14:30:03
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/order_card_upload.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/order_card_upload.htm', 12, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
  <h4 style="color:#fff; margin-top:5px;">证件上传-【<?php echo $_GET['id']; ?>
】-【<?php echo $_GET['import_id']; ?>
】</h4>
</div>
<div class="modal-body">
  <div class="tabbable tabbable-custom">
    <div class="tab-content">
        <div class="container-fluid"> 
  <!-- BEGIN PAGE CONTENT-->
<div class="portlet-body form"> 
            <!-- BEGIN FORM-->
            <form action="<?php echo ((is_array($_tmp="order/order_card_upload")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"  class="form-horizontal" method="post"  id='form_1' enctype="multipart/form-data">
              <div class="row-fluid">
                <div id='alert-error_1' class="alert alert-error">
                  <button class="close" data-dismiss="alert"></button>
                  <span>如果某项已上传,不需要再次上传</span>
                </div>
              </div>

              <div class="row-fluid" style="margin-top:10px;">
                <div class="control-group">
                  <label class="control-label">身份证正面<span class="required">*</span></label>
                  <div class="controls span3">
                    <input type="file" name="upload_card_1"  id='uploadFile' data-required="1" class="m-wrap"/>
                  </div>
                </div> 
              </div>

              <div class="row-fluid" style="margin-top:10px;">  
                <div class="control-group">
                  <label class="control-label">身份证反面<span class="required">*</span></label>
                  <div class="controls span3">
                    <input type="file" name="upload_card_2" data-required="1" class="m-wrap"/>
                  </div>
                </div> 
              </div>

              <div class="row-fluid" style="margin-top:10px;">  
                <div class="control-group">
                  <label class="control-label">上传小票<span class="required">*</span></label>
                  <div class="controls span3">
                    <input type="file" name="upload_xiaopian" data-required="1" class="m-wrap"/>
                  </div>
                </div> 
              </div> 
              
              <input type="hidden" name="auth_id" value="<?php echo $this->_tpl_vars['re']['auth_id']; ?>
"/>
 			  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>

              <div class="form-actions">
                <button type="submit" class="btn green">提交上传</button>
              </div>
              
               <div class="row-fluid" style="margin-top:10px;">
                <div class="control-group">
                  <label class="control-label">导入订单号<span class="required">*</span></label>
                  <div class="controls span6">
                    <span id="span_label">              
                      <?php echo $this->_tpl_vars['re']['import_id']; ?>

                    </span>             
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">真实姓名<span class="required">*</span></label>
                  <div class="controls span6">
                    <span id="span_label">              
                      <?php echo $this->_tpl_vars['re']['consignee']; ?>

                    </span>             
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">证件号<span class="required">*</span></label>
                  <div class="controls span6">
                    <span id="span_label">              
                      <?php echo $_GET['card_no']; ?>

                    </span>             
                  </div>
                </div>
              </div>
            </form>
            <!-- END FORM--> 
          </div>
  <!-- END PAGE CONTENT--> 
</div>
     
    </div>
  </div>
</div>

<div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>
