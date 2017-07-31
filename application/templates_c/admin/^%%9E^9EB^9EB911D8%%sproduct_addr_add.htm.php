<?php /* Smarty version 2.6.20, created on 2016-12-14 13:41:54
         compiled from sproduct_addr_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'sproduct_addr_add.htm', 134, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>备案管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">商户管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#"><?php if (empty ( $this->_tpl_vars['re'] )): ?>添加商户模式<?php else: ?>编辑商户模式<?php endif; ?></a></li>
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
          <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['re'] )): ?>添加商户模式<?php else: ?>编辑商户模式<?php endif; ?></div>
        </div>
        <div class="portlet-body form"> 
          <!-- BEGIN FORM-->
          <form action="" id="form_cat_add" class="form-horizontal" method="post" >               
            
                        <div id='alert-error_1' class="alert alert-error hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交失败</span>
            </div>
            <div id='alert-success_1' class="alert alert-success hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交成功</span>
            </div>

            <div class="row-fluid" style="margin-top:10px;">
              <div class="control-group">
                <label class="control-label">商户模式<span class="required">*</span></label>
                <div class="controls span3" >
                  <input type="text" name="addr_name" value="<?php echo $this->_tpl_vars['re']['addr_name']; ?>
" class="m-wrap"/>
                </div>
              </div>
            </div>
            
            <div class="form-actions">
              <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
">			  
              <button type="submit" id='submit_cat_add' class="btn green">提交</button>
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
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  
  var form1 = $('#form_cat_add');
  form1.validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {
      addr_name: {
        required: true
      }
    },
    messages : {
      addr_name: {
         required:'请填写商户地址',
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
    },
    submitHandler: function (form) {
      /*
      $.post("?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&act_ajax=1",form1.serialize(),function(msg){
          success1.hide();
          if(msg==1)
          {
            success1.find('span').html('订阅成功');
            success1.show();  
          }
          else
          {
            error1.find('span').html(msg);
            error1.show();
          }
      });
      */
    }
  });
  
  $("#submit_cat_add").click(function(){
    if(form1.valid()==true)
    {
      //encodeURI(msg)
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="supplier/sproduct_addr_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
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