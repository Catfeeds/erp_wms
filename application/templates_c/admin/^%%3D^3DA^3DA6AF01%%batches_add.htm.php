<?php /* Smarty version 2.6.20, created on 2017-01-05 09:43:57
         compiled from batches_add.htm */ ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>订单管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">批次管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">批次添加</a></li>
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
            <div class="caption"><i class="icon-reorder"></i>批次添加</div>
          </div>
          <div class="portlet-body form"> 
            <!-- BEGIN FORM-->
            <form action=""  class="form-horizontal" method="post"  id='form_1' enctype="multipart/form-data">

              <div class="row-fluid" style="margin-top:10px;">
                <div class="control-group">
                  <label class="control-label">会员<span class="required">*</span></label>
                  <div class="controls span3" >
                    <select name="userid" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                      <option value="" selected="selected" >请选择会员ID</option>
                      <?php $_from = $this->_tpl_vars['re']['supplier']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                        <option value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['company']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">批次名称<span class="required">*</span></label>
                  <div class="controls span3" >
                    <input type="text"  name="batches_name" class="m-wrap span5"/>
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
      userid: {
        required: true
      },
      batches_name: {
        required: true
      }
    },
    messages : {
      userid:{
        required:'请选择会员',
      },
      batches_name:{
        required:'请输入批次名称',
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