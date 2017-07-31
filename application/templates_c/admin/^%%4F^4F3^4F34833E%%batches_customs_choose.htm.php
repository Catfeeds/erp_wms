<?php /* Smarty version 2.6.20, created on 2017-05-12 14:52:32
         compiled from batches_customs_choose.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'batches_customs_choose.htm', 175, false),)), $this); ?>
<div class="container-fluid">
<div class="row-fluid">
  <div class="span12">
    <div class="form"> 
      <!-- BEGIN FORM-->
      <form action="" id="form_batches_customs_choose" class="form-horizontal" method="post" >
        <table class="table table-bordered table-hover dataTable" id="table_1">
                    <div id='alert-error_1' class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交失败</span> </div>
          <div id='alert-success_1' class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交成功</span> </div>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">批次信息</th>
            </tr>
          </thead>
          <tr>
            <td width="250px">批次ID：<?php echo $this->_tpl_vars['re']['id']; ?>
</td>
            <td width="250px">批次名称：<?php echo $this->_tpl_vars['re']['batches_name']; ?>
</td>
            <td>会员ID：<?php echo $this->_tpl_vars['re']['userid']; ?>
</td>
          </tr>
          <tr>
            <td width="250px">
              当前选择关区：                
              <?php if ($this->_tpl_vars['re']['customs'] == 0): ?> 
                <span class="btn red mini">未选择</span>
              <?php elseif ($this->_tpl_vars['re']['customs'] == 1): ?> 
                <span class="btn green mini">成都</span>
              <?php elseif ($this->_tpl_vars['re']['customs'] == 2): ?> 
                <span class="btn green mini">北京</span>
              <?php elseif ($this->_tpl_vars['re']['customs'] == 3): ?> 
                <span class="btn green mini">深圳</span>
              <?php elseif ($this->_tpl_vars['re']['customs'] == 4): ?>
                <span class="btn green mini">杭州</span>
              <?php elseif ($this->_tpl_vars['re']['customs'] == 5): ?> 
                <span class="btn green mini">上海</span>
              <?php endif; ?>
            </td>
            <td>
              当前计税方式：
              <?php if ($this->_tpl_vars['re']['tax_type'] == 0): ?> 
                <span class="btn red mini">未选择</span>
              <?php elseif ($this->_tpl_vars['re']['tax_type'] == 1): ?> 
                <span class="btn green mini">行邮税</span>
              <?php elseif ($this->_tpl_vars['re']['tax_type'] == 2): ?> 
                <span class="btn green mini">综合税</span>
              <?php endif; ?>
            </td>
            <td>
              当前运费模版：<?php echo $this->_tpl_vars['re']['freight_template']; ?>
|<?php echo $this->_tpl_vars['re']['freight_template_abroad']; ?>

            </td>
          </tr>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">选择关区</th>
            </tr>
          </thead>
          <tr>
            <td colspan="99"> 
              <div class="control-group" style="margin:5px 0 5px 0;">
                <label class="control-label">关区选择<span class="required">*</span></label>
                <div class="controls"> 
                  <select name="customs" id="sel_customs" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                    <option selected="selected" value="choose">修改关区</option>
                    <option <?php if ($this->_tpl_vars['re']['customs_type']['filing_type'] == 1): ?>selected="selected"<?php endif; ?> value="1">成都</option>
                    <option <?php if ($this->_tpl_vars['re']['customs_type']['filing_type'] == 2): ?>selected="selected"<?php endif; ?> value="2">北京</option>
                    <option <?php if ($this->_tpl_vars['re']['customs_type']['filing_type'] == 3): ?>selected="selected"<?php endif; ?> value="3">深圳</option>
                    <option <?php if ($this->_tpl_vars['re']['customs_type']['filing_type'] == 4): ?>selected="selected"<?php endif; ?> value="4">杭州</option>
                    <option <?php if ($this->_tpl_vars['re']['customs_type']['filing_type'] == 5): ?>selected="selected"<?php endif; ?> value="5">上海</option>
                  </select>
                </div>
              </div>  

              <div class="control-group" style="margin:10px 0 5px 0;">
                <label class="control-label">计税方式<span class="required">*</span></label>
                <div class="controls">     
                  <select name="tax_type" id="sel_tax_type" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                    <option selected="selected" value="choose">修改计税方式</option>
                    <option <?php if ($this->_tpl_vars['re']['customs_type']['filing_kjt_type'] == 1): ?>selected="selected"<?php endif; ?> value="1">行邮税</option>
                    <option <?php if ($this->_tpl_vars['re']['customs_type']['filing_kjt_type'] == 2): ?>selected="selected"<?php endif; ?> value="2">综合税</option>
                  </select>
                </div>
              </div>
            </td>
          </tr>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">选择运费模版</th>
            </tr>
          </thead>
          <tr>
            <td colspan="99">
              <div class="control-group" style="margin:5px 0 5px 0;">
                <label class="control-label">国内实际运费<span class="required">*</span></label>
                <div class="controls">     
                  <select name="freight_template" id="sel_template" aria-controls="sample_1" class="form_2_select2 m-wrap span2">
                    <option value="choose">修改运费模版</option>
                    <?php $_from = $this->_tpl_vars['re']['template']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                      <option <?php if ($this->_tpl_vars['re']['template_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
|<?php echo $this->_tpl_vars['item']['title']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>

              <div class="control-group" style="margin:10px 0 5px 0;">
                <label class="control-label">商户运费模版<span class="required">*</span></label>
                <div class="controls">     
                  <select name="freight_template_abroad" id="sel_template_abroad" aria-controls="sample_1" class="form_2_select2 m-wrap span2">
                    <option value="choose">修改运费模版</option>
                    <?php if (! empty ( $this->_tpl_vars['re']['template_abroad'] )): ?>
                      <?php $_from = $this->_tpl_vars['re']['template_abroad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                        <option <?php if ($this->_tpl_vars['re']['template_abroad_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
|<?php echo $this->_tpl_vars['item']['title']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </td>
          </tr>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">计算结果</th>
            </tr>
          </thead>
          <tr>
            <td colspan="99"> 
              <div class="control-group" style="margin:5px 0 5px 0;">
                <label class="control-label">税款总金额<span class="required">*</span></label>
                <div class="controls">
                <input class="m-wrap small" type="text" name="tax_total" value="<?php echo $this->_tpl_vars['re']['tax_total']; ?>
" readonly="readonly"> 
                </div>
              </div>

              <div class="control-group" style="margin:10px 0 5px 0;">
                <label class="control-label">运费总金额<span class="required">*</span></label>
                <div class="controls">
                 <input class="m-wrap small" type="text" name="freight_total" value="<?php echo $this->_tpl_vars['re']['freight_total']+$this->_tpl_vars['re']['freight_total_abroad']; ?>
" readonly="readonly">
                </div>
              </div>
            </td>
          </tr>
          <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
        </table>
        <div class="form-actions">
          <!-- <button type="button" id='' class="btn green">计算结果</button> -->
          <button type="button" id='submit_batches_customs_choose' class="btn red">确认提交</button>
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

  modify_states();

  freight_template_choose();
  
}

var freight_template_choose = function()
{
  
 
  $('#sel_template').change(function()
  {
    var freight_template = $("#sel_template option:selected").val();
    var freight_template_abroad = $('#sel_template_abroad');
    $.post('<?php echo ((is_array($_tmp='batches/freight_template_choose')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',
    { 
      freight_template:freight_template
    },
    function(msg)
    { 
      var sel = eval(msg);
      freight_template_abroad.empty();
      freight_template_abroad.append("<option value='choose'>修改运费模版</option>");
      
      for ( var i = 0 ; i < sel.length ; i++ )
      {       
        freight_template_abroad.append("<option value='"+sel[i].id+"|"+sel[i].title+"'>"+sel[i].title+"</option>");     
      } 
    });
  });
}

var modify_states = function()
{  
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  var form1 = $('#form_batches_customs_choose');
  $("#submit_batches_customs_choose").click(function(){
    if(form1.valid()==true)
    {
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="batches/batches_customs_choose")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
          setTimeout(modal_msg(str.msg),300);
        }
        catch(e)
        {
          $('body').modalmanager('removeLoading');
          success1.hide();
          error1.find('span').html('系统异常');
          error1.show();

          setTimeout(modal_msg('系统异常'),300);
        };
      });
    }
  }); 
}

</script>