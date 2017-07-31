<?php /* Smarty version 2.6.20, created on 2016-12-21 14:50:55
         compiled from filing_update.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'filing_update.htm', 182, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;" >
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
  <h4 style="color:#fff; margin-top:5px;">备案内容修改</h4>
</div>
<div class="modal-body" >
  <div class="tab-content">
    <div style="height:210px; overflow-y:auto;" >
      <form action="" id="form_filing_update" class="form-horizontal" method="post">
        
                <div id='alert-error_1' class="alert alert-error hide">
          <button class="close" data-dismiss="alert"></button>
          <span>提交失败</span>
        </div>
        <div id='alert-success_1' class="alert alert-success hide">
          <button class="close" data-dismiss="alert"></button>
          <span>提交成功</span>
        </div>

        <div class="row-fluid">
          <label class="control-label span2">商品ID<span class="required">*</span></label>
          <div class="span2">
              <span id="span_label"><?php echo $this->_tpl_vars['re_f']['id']; ?>
</span>
          </div>
 
          <label class="control-label span2">关区<span class="required">*</span></label>
          <div class="span2" >
            <span id="span_label">
              <?php if ($this->_tpl_vars['re_f']['customs'] == 1): ?> 
                成都
              <?php elseif ($this->_tpl_vars['re_f']['customs'] == 2): ?> 
                北京
              <?php elseif ($this->_tpl_vars['re_f']['customs'] == 3): ?> 
                深圳
              <?php elseif ($this->_tpl_vars['re_f']['customs'] == 4): ?>
                杭州
              <?php elseif ($this->_tpl_vars['re_f']['customs'] == 5): ?> 
                上海
              <?php endif; ?>
            </span>
          </div>
          
          <label class="control-label span2">计税方式<span class="required">*</span></label>
          <div class="span2" >
            <span id="span_label">
              <?php if ($this->_tpl_vars['re_f']['tax_type'] == 1): ?> 
                行邮税
              <?php elseif ($this->_tpl_vars['re_f']['tax_type'] == 2): ?> 
                综合税
              <?php endif; ?>
            </span>
          </div>
        </div>
     
        <div class="row-fluid" style="margin-top:10px;">
          <div class="control-group">
            <label class="control-label span2">备案名称<span class="required">*</span></label>
            <div class="span7" >
              <input type="text" name="name" value="<?php echo $this->_tpl_vars['re_f']['name']; ?>
" class="m-wrap"/>
            </div>
          </div>
        </div>

        <div class="row-fluid" style="margin-top:5px;">
          <div class="control-group">
            <label class="control-label span2">备案价格<span class="required">*</span></label>
            <div class="span5">
              <input type="text" name="price" value="<?php echo $this->_tpl_vars['re_f']['price']; ?>
" class="m-wrap span7"/>
            </div> 
          </div>
        </div>

        <div class="row-fluid" style="margin-top:5px;">  
          <div class="control-group">
            <label class="control-label span2">备案状态<span class="required">*</span></label>
            <div class="span5">
              <select size="1" id="form_2_select2"  name="status" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                <option value="" selected="selected" >所有状态</option>
                <option <?php if ($this->_tpl_vars['re_f']['status'] == '1'): ?>selected="selected"<?php endif; ?> value='1'>不通过</option>
                <option <?php if ($this->_tpl_vars['re_f']['status'] == '2'): ?>selected="selected"<?php endif; ?> value='2'>备案中</option>
                <option <?php if ($this->_tpl_vars['re_f']['status'] == '3'): ?>selected="selected"<?php endif; ?> value='3'>已通过</option>
              </select>
            </div>        
          </div>
        </div>  
        <input type="hidden" name="edit_id" value="<?php echo $this->_tpl_vars['re_f']['id']; ?>
"/>
        <input type="hidden" name="customs" value="<?php echo $this->_tpl_vars['re_f']['customs']; ?>
"/>
        <input type="hidden" name="tax_type" value="<?php echo $this->_tpl_vars['re_f']['tax_type']; ?>
"/>    
      </form>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="submit" id='submit_filing_update' class="btn red">提交</button>
  <button type="button" data-dismiss="modal" class="btn">关闭</button>
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

function load_ini()
{
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  
  var form1 = $('#form_filing_update');
  form1.validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {
      name : {
        required: true
      },
      price: {
        required: true
      },
      status: {
        required: true
      }
    },
    messages : {
      name: {
         required:'请填写',
      },
      price: {
         required:'请填写',
      },
      status: {
         required:'请选择',
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
  
  $("#submit_filing_update").click(function(){
    if(form1.valid()==true)
    {
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="filing/filing_update")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg)
      {
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
            location.reload();
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