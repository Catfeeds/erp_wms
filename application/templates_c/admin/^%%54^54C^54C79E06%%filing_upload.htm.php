<?php /* Smarty version 2.6.20, created on 2016-12-21 17:05:44
         compiled from filing_upload.htm */ ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>备案管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">平台备案库管理  </a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">批量上传</a></li>
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
            <div class="caption"><i class="icon-reorder"></i>批量上传</div>
          </div>
          <div class="portlet-body form"> 
            <!-- BEGIN FORM-->
            <form action=""  class="form-horizontal" method="post"  id='form_1' enctype="multipart/form-data">
              <div class="row-fluid" style="margin-top:10px;">
                <div class="control-group">
                  <label class="control-label">表格下载<span class="required">*</span></label>
                  <div class="controls span6">
                    <span id="span_label">              
                      <a href="/static/filing.xls">备案表格.xls</a> 
                    </span>             
                  </div>
                </div>
              </div>

              <div class="row-fluid" style="margin-top:10px;">
                <div id='alert-error_1' class="alert alert-error hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>请上传商品</span>
                </div>
                <div id='alert-success_1' class="alert alert-success hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>通过正在提交......</span>
                </div>

                <div class="control-group">
                  <label class="control-label">导入表格<span class="required">*</span></label>
                  <div class="controls span3">
                    <input type="file" name="import_filing" data-required="1" class="span7 m-wrap"/>
                  </div>
                </div> 
              </div> 

              <div class="row-fluid" style="margin-top:10px;">
                <div class="control-group">
                  <label class="control-label">关区选择<span class="required">*</span></label>
                  <div class="controls span3" >
                    <select size="1" name="customs" aria-controls="sample_1" class="form_2_select2 m-wrap ">
                      <option value=''>关区选择</option>
                      <?php $_from = $this->_tpl_vars['re']['customs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value=<?php echo $this->_tpl_vars['key']; ?>
 ><?php echo $this->_tpl_vars['item']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>
                  </div>
                </div>
              </div>
                
              <div class="row-fluid" style="margin-top:10px;">
                <div class="control-group">  
                  <label class="control-label">计税方式<span class="required">*</span></label>
                  <div class="controls span3">    
                    <select size="1" name="tax_type" aria-controls="sample_1" class="form_2_select2 m-wrap">
                      <option value=''>计税方式</option>
                      <option value='1'>行邮税</option>
                      <option value='2'>综合税</option>
                    </select>
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
      import_table: {
        required: true
      },
      customs: {
        required: true
      },
      tax_type: {
        required: true
      }
    },
    messages : {
      import_table:{
        required:'请上传商品',
      },
      customs:{
        required:'请选择关区',
      },
      tax_type:{
        required:'请选择计税方式',
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