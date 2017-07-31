<?php /* Smarty version 2.6.20, created on 2017-05-12 14:52:46
         compiled from batches_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'batches_edit.htm', 147, false),)), $this); ?>
<div class="container-fluid">
<div class="row-fluid">
  <div class="span12">
    <div class="form"> 
      <!-- BEGIN FORM-->
      <form action="" id="form_batches_eidt" class="form-horizontal" method="post" >
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
            <th width="250px">批次ID：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>
            <th width="250px">批次名称：<?php echo $this->_tpl_vars['re']['batches_name']; ?>
</th>
            <th>会员ID：<?php echo $this->_tpl_vars['re']['userid']; ?>
</th>
          </tr>
    
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">状态修改</th>
            </tr>
          </thead>
          <tr>
            <td colspan="99"> 
              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">批次状态<span class="required">*</span></label>
                <div class="controls">
                  <?php if ($this->_tpl_vars['re']['status'] == 1): ?>
                    <span class="btn black mini">初始化</span>
                  <?php elseif ($this->_tpl_vars['re']['status'] == 2): ?>
                    <span class="btn blue mini">待审核</span>
                  <?php elseif ($this->_tpl_vars['re']['status'] == 3): ?>
                    <span class="btn yellow mini">已审核</span>
                  <?php elseif ($this->_tpl_vars['re']['status'] == 4): ?>
                    <span class="btn blue mini">待发货</span>
                  <?php elseif ($this->_tpl_vars['re']['status'] == 5): ?>
                    <span class="btn yellow mini">已发货</span>
                  <?php elseif ($this->_tpl_vars['re']['status'] == 6): ?>
                    <span class="btn green mini">国内已通关</span>
                  <?php endif; ?>
                  
                  
                  <?php if ($this->_tpl_vars['re']['status'] == 2): ?>
                    <select name="status" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                      <option selected="selected" value="choose">修改状态</option>
                      <option value="3">已审核</option>
                    </select>
                  <?php elseif ($this->_tpl_vars['re']['status'] == 3): ?>
                    <select name="status" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                      <option selected="selected" value="choose">修改状态</option>
                      <option value="4">待发货</option>
                    </select>
                  <?php elseif ($this->_tpl_vars['re']['status'] == 4): ?>
                    <select name="status" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                      <option selected="selected" value="choose">修改状态</option>
                      <option value="3">已审核</option>
                      <option value="5">已发货</option>
                    </select>

                    <!--<button type="button" id="add_logistics_no" data-id="<?php echo $this->_tpl_vars['re']['id']; ?>
" class="btn red">添加运单号</button>-->
                  <?php elseif ($this->_tpl_vars['re']['status'] == 5): ?>
                    <select name="status" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                      <option selected="selected" value="choose">修改状态</option>
                      <option value="6">国内已通关</option>
                    </select>
                  <?php endif; ?>
                </div>
              </div>  

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">税款支付<span class="required">*</span></label>
                <div class="controls">
                  <?php if ($this->_tpl_vars['re']['tax_status'] == 1): ?> 
                    <span class="btn black mini">初始化</span>
                  <?php elseif ($this->_tpl_vars['re']['tax_status'] == 2): ?> 
                    <span class="btn red mini">未付款</span>
                  <?php elseif ($this->_tpl_vars['re']['tax_status'] == 3): ?> 
                    <span class="btn green mini">已付款</span>
                  <?php endif; ?>
                  <select name="tax_status" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                    <option selected="selected" value="choose">修改状态</option>
                    <option value="2">未付款</option>
                    <option value="3">已付款</option>
                  </select>
                </div>
              </div>

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">运费支付<span class="required">*</span></label>
                <div class="controls">
                  <?php if ($this->_tpl_vars['re']['freight_status'] == 1): ?> 
                    <span class="btn black mini">初始化</span>
                  <?php elseif ($this->_tpl_vars['re']['freight_status'] == 2): ?> 
                    <span class="btn red mini">未付款</span>
                  <?php elseif ($this->_tpl_vars['re']['freight_status'] == 3): ?> 
                    <span class="btn green mini">已付款</span>
                  <?php endif; ?>
                  <select name="freight_status" aria-controls="sample_1"  class="form_2_select2 m-wrap span2">
                    <option selected="selected" value="choose">修改状态</option>
                    <option value="2">未付款</option>
                    <option value="3">已付款</option>
                  </select>
                </div>
              </div>
            </td>
          </tr>
      
          <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
        </table>
        <div class="form-actions">
          <button type="button" id='submit_batches_eidt' class="btn red">提交</button>
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
  add_logistics_no();
}

var modify_states = function()
{  
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  var form1 = $('#form_batches_eidt');
  $("#submit_batches_eidt").click(function(){
    if(form1.valid()==true)
    {
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="batches/batches_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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

/* 点击添加运单号 */
var add_logistics_no = function()
{ 
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1');
  $("#add_logistics_no").click(function()
  {
    var id = $(this).attr('data-id');
    $.post('<?php echo ((is_array($_tmp='batches/batches_add_logistics_no')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',
    { 
      id: id,
    },
    function(msg)
    {
      try
      {
        eval("var str="+msg);        
        if ( str.type == 1 )
        {
          //错误提示       
          success1.hide();
          error1.find('span').html(str.msg);
          error1.show();
        }
        else if( str.type == 2 )
          {
            //添加成功
            error1.hide();
            success1.find('span').html(str.msg);
            success1.show();
          }
      }
      catch ( e )
      { 
        success1.hide();
        error1.find('span').html('系统异常');
        error1.show();
      };
    });
  });

}

</script>