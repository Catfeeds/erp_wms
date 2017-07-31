<?php /* Smarty version 2.6.20, created on 2016-12-21 14:50:52
         compiled from filing_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'filing_edit.htm', 55, false),)), $this); ?>
<div class="container-fluid">
<div class="row-fluid">
  <div class="span12">
    <div class="form"> 
      <!-- BEGIN FORM-->
      <form action="" id="form_filing_eidt" class="form-horizontal" method="post" >
        <table class="table table-bordered table-hover dataTable" id="table_1">
                    <div id='alert-error_1' class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交失败</span> </div>
          <div id='alert-success_1' class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交成功</span> </div>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">平台商品备案信息</th>
            </tr>
          </thead>
          <tr>
            <th colspan="3">商品ID：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>
            <th>行邮税税率：<?php echo $this->_tpl_vars['re']['par_tax']; ?>
</th>
            <th colspan="99">综合税税率：<?php echo $this->_tpl_vars['re']['con_tax']; ?>
</th>
          </tr>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">备案方式</th>
            </tr>
          </thead>
          <thead>
            <tr>
              <th width="50" rowspan="2">关区</th>
              <th colspan="4">行邮税</th>
              <th colspan="4">综合税</th>
            </tr>
            <tr>
              <th width="70" >操作</td>
              <th width="70" >备案状态</td>
              <th width="300">备案名称</td>
              <th width="80" >备案价格</td>
              <th width="70" >操作</td>
              <th width="70" >备案状态</td>
              <th width="300">备案名称</td>
              <th width="*"  >备案价格</td>
            </tr>
          </thead>
          <?php $_from = $this->_tpl_vars['re']['filing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <tr>
              <td>
                <?php $_from = $this->_tpl_vars['re']['customs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                  <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['k']): ?><?php echo $this->_tpl_vars['i']; ?>
<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
              </td>
              <td>
                <span data-url='<?php echo ((is_array($_tmp="filing/filing_update")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-id='<?php echo $this->_tpl_vars['re']['id']; ?>
' tax-type='1' data-customs='<?php echo $this->_tpl_vars['key']; ?>
' filing-status='<?php echo $this->_tpl_vars['item']['status_par']; ?>
' filing-name='<?php echo $this->_tpl_vars['item']['name_par']; ?>
' filing-price='<?php echo $this->_tpl_vars['item']['price_par']; ?>
' class="modify_popup btn green mini"><i class="icon-edit"></i> 编辑</span>
              </td>
              <?php if ($this->_tpl_vars['item']['name_par']): ?>
                <td>
                  <?php if ($this->_tpl_vars['item']['status_par'] == 1): ?>
                    <span class="btn black mini">不通过</span>
                  <?php elseif ($this->_tpl_vars['item']['status_par'] == 2): ?>
                    <span class="btn blue mini">备案中</span>
                  <?php elseif ($this->_tpl_vars['item']['status_par'] == 3): ?>
                    <span class="btn green mini">已通过</span>
                  <?php endif; ?>
                </td>
                <td><?php echo $this->_tpl_vars['item']['name_par']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['price_par']; ?>
</td>
              <?php else: ?>
                <td colspan="3">暂无添加数据</td>
              <?php endif; ?>
              <td>
                <span data-url='<?php echo ((is_array($_tmp="filing/filing_update")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-id='<?php echo $this->_tpl_vars['re']['id']; ?>
' tax-type='2' data-customs='<?php echo $this->_tpl_vars['key']; ?>
' filing-status='<?php echo $this->_tpl_vars['item']['status_con']; ?>
' filing-name='<?php echo $this->_tpl_vars['item']['name_con']; ?>
' filing-price='<?php echo $this->_tpl_vars['item']['price_con']; ?>
' class="modify_popup btn green mini"><i class="icon-edit"></i> 编辑</span>
              </td>
              <?php if ($this->_tpl_vars['item']['name_con']): ?>
                <td>
                  <?php if ($this->_tpl_vars['item']['status_con'] == 1): ?>
                    <span class="btn black mini">不通过</span>
                  <?php elseif ($this->_tpl_vars['item']['status_con'] == 2): ?>
                    <span class="btn blue mini">备案中</span>
                  <?php elseif ($this->_tpl_vars['item']['status_con'] == 3): ?>
                    <span class="btn green mini">已通过</span>
                  <?php endif; ?>
                </td>
                <td><?php echo $this->_tpl_vars['item']['name_con']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['price_con']; ?>
</td>
              <?php else: ?>
                <td colspan="3">暂无添加数据</td>
              <?php endif; ?>
            </tr>
          <?php endforeach; endif; unset($_from); ?>   
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">备案选择</th>
            </tr>
          </thead>
          <tr>
            <th colspan="99"> 
              <div class="control-group">
                <label class="control-label">关区选择<span class="required">*</span></label>
                <div class="controls">
                  <select name="customs" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                    <?php $_from = $this->_tpl_vars['re']['customs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                      <option <?php if ($this->_tpl_vars['re']['customs'] == $this->_tpl_vars['key']): ?>selected="selected"<?php endif; ?> value=<?php echo $this->_tpl_vars['key']; ?>
 ><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">计税方式<span class="required">*</span></label>
                <div class="controls">
                  <select name="tax_type" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                    <option <?php if ($this->_tpl_vars['re']['tax_type'] == '1'): ?>selected="selected"<?php endif; ?> value="1">行邮税</option>
                    <option <?php if ($this->_tpl_vars['re']['tax_type'] == '2'): ?>selected="selected"<?php endif; ?> value="2">综合税</option>
                  </select>
                </div>
              </div>
            </th>
          </tr>
          <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
        </table>
        <div class="form-actions">
          <button type="button" id='submit_filing_eidt' class="btn red">提交</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

function load_ini()
{
  bind_window();

  modify_states();
  
}

var bind_window = function()
{
  App.initFancybox();
  $.fn.modalmanager.defaults.resize = true;
  $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
  var $modal = $('#ajax-modal');
  $('#table_1 .modify_popup').each(function(index, element) 
  {
    $(this).on('click', function()
    {
        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');
        var url = $(this).attr('data-url');
        var id = $(this).attr('data-id'); 
        var tax_type = $(this).attr('tax-type');
        var customs = $(this).attr('data-customs');
        var status = $(this).attr('filing-status');
        var name = $(this).attr('filing-name');
        var price = $(this).attr('filing-price');
        setTimeout(function()
        {
          $modal.load(
            url, 
            {
              show_id:id,
              tax_type:tax_type,
              customs:customs,
              status:status,
              name:name,
              price:price
            }, 
          function()
          {
            $modal.modal();
            //$modal.css('margin-top','0');
          });
        }, 100);
    });   
  });
}

var modify_states = function()
{
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  
  var form1 = $('#form_filing_eidt');
  form1.validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules : {
      customs: {
        required: true
      },
      tax_type: {
        required: true
      }
    },
    messages : {
      customs: {
        required:'请选择',
      },
      tax_type: {
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
  
  $("#submit_filing_eidt").click(function(){
    if(form1.valid()==true)
    {
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="filing/filing_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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