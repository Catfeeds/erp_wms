<?php /* Smarty version 2.6.20, created on 2016-12-12 09:43:24
         compiled from order_upload.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_upload.htm', 32, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">订单管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">订单上传</a></li>
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
            <div class="caption"><i class="icon-reorder"></i>订单上传</div>
          </div>
          <div class="portlet-body form"> 
            <!-- BEGIN FORM-->
            <form action=""  class="form-horizontal" method="post"  id='form_1' enctype="multipart/form-data">
              <div class="row-fluid" style="margin-top:10px;">
                <div class="control-group">
                  <label class="control-label">上传订单下载<span class="required">*</span></label>
                  <div class="controls span6">
                    <span id="span_label">              
                      <a href="<?php echo ((is_array($_tmp='order/order_down_xls')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
">订单表格.xls </a> 
                      
                    </span>
                    <p style="color:#999; font-size:16px;"> <b style="color:red;">1.请按原表格模式上传 第1个表单必须是订单 第2个必须是清单 <br /> 2.订单与清单是一对多的关系以订单号为依据<br /> 3.订单中订单号不可重复上传,清单可以重复表示同一个订单 <br /> 4.表格必须另存为 Microsoft Excel 97-2003 工作表 (.xls)</b></p>             
                  </div>
                </div>
              </div>

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
                  <label class="control-label">导入订单<span class="required">*</span></label>
                  <div class="controls span3">
                    <input type="file" name="import_order" data-required="1" class="m-wrap"/>
                  </div>
                </div> 
              </div>

              <div class="control-group">
                  <label class="control-label">发货批次<span class="required">*</span></label>
                  <div class="controls span6">
                    <span id="span_label">              
                      <select name="batches_id">
                        <?php $_from = $this->_tpl_vars['batches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                      		<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
">批次号(<?php echo $this->_tpl_vars['item']['id']; ?>
) <?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                      </select>
                    </span>  
                    <a href="<?php echo ((is_array($_tmp="order/add_new_batches")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" class="btn red mini" >生成新批次</a>           
                  </div>
              </div>
              
              <div class="row-fluid" style="margin-top:10px;">
                <div class="control-group">
                  <label class="control-label">操作密码<span class="required">*</span></label>
                  <div class="controls span3">
                    <input type="text" name="act_pass" data-required="1" class="span7 m-wrap"/>
                  </div>
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

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

function load_ini()
{
  $('#form_1').validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {
      import_order: {
        required: true
      }
      ,
      import_list: {
        required: true
      }
      ,
      act_pass: {
        required: true
      }
    },
    messages: {
      import_order:{
        required:'请上传订单'
      }
      ,
      import_list: {
        required: '请上传清单'
      }
      ,
      act_pass: {
        required: '请输入密码'
      } 
    }
    ,
    invalidHandler: function (event, validator) { //display error alert on form submit              
      
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
    } ,
     
    submitHandler: function (form) {
      form.submit();
    }
  });
}

</script> 