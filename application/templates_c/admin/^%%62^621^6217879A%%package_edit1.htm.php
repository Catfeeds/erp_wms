<?php /* Smarty version 2.6.20, created on 2017-05-15 11:35:27
         compiled from package_edit1.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package_edit1.htm', 147, false),)), $this); ?>
<div class="container-fluid">
<div class="row-fluid">
  <div class="span12">
    <div class="form"> 
      <!-- BEGIN FORM-->
      <form action="" id="form_eidt" class="form-horizontal" method="post" >
        <table class="table table-bordered table-hover dataTable" id="table_1">
                    <div id='alert-error_1' class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交失败</span> </div>
          <div id='alert-success_1' class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交成功</span> </div>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">包裹信息</th>
            </tr>
          </thead>
          <tr>
            <th width="250px">包裹编号：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>
            <th width="250px">会员ID：<?php echo $this->_tpl_vars['re']['userid']; ?>
</th>
            <th width="250px">会员公司：<?php echo $this->_tpl_vars['company']; ?>
</th>
          </tr>
   
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">包裹信息修改</th>
            </tr>
          </thead>
          <tr>
            <td colspan="99"> 
              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">长<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="fedex_length" value="<?php echo $this->_tpl_vars['re']['fedex_length']; ?>
" class="m-wrap span3" >
                </div>
              </div> 

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">高<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="fedex_height" value="<?php echo $this->_tpl_vars['re']['fedex_height']; ?>
" class="m-wrap span3" >
                </div>
              </div>  

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">宽<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="fedex_width" value="<?php echo $this->_tpl_vars['re']['fedex_width']; ?>
" class="m-wrap span3" >

                </div>
              </div>

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">周长<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="" value="<?php echo $this->_tpl_vars['re']['fedex_width']*2+$this->_tpl_vars['re']['fedex_height']*2+$this->_tpl_vars['re']['fedex_length']; ?>
" class="m-wrap span3" >
                  <p style="color: red;display: inline-block;height: 30px;line-height: 30px">注意：周长超过130英寸，约330.2厘米，请选择重货服务</p>
                </div>
              </div>

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">长宽高计量单位<span class="required">*</span></label>
                <div class="controls">
                  <select name="fedex_lwh_unit" class="form_2_select2 m-wrap span3">
                  <option value=''>请选择</option>
                  <option <?php if ($this->_tpl_vars['re']['fedex_lwh_unit'] == 'cm'): ?>selected="selected"<?php endif; ?> value="cm">厘米</option>
                  <option <?php if ($this->_tpl_vars['re']['fedex_lwh_unit'] == 'in'): ?>selected="selected"<?php endif; ?> value="in">英寸</option>                  
                </select>  
                </div>
              </div>  

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">重量<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="fedex_weight" value="<?php echo $this->_tpl_vars['re']['fedex_weight']; ?>
" class="m-wrap span3" >
                  <p style="color: red;display: inline-block;height: 30px;line-height: 30px">注意：重量超过150磅，约68公斤，请选择重货服务</p>
                </div>

              </div>  

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">重量单位<span class="required">*</span></label>
                <div class="controls">
                  <select name="fedex_weight_unit" class="form_2_select2 m-wrap span3">
                    <option value=''>请选择</option>
                    <option <?php if ($this->_tpl_vars['re']['fedex_weight_unit'] == 'kg'): ?>selected="selected"<?php endif; ?> value="kg">千克</option>
                    <option <?php if ($this->_tpl_vars['re']['fedex_weight_unit'] == 'lb'): ?>selected="selected"<?php endif; ?> value="lb">磅</option>                  
                  </select>

                </div>
              </div>

              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">FedEx服务类型<span class="required">*</span></label>
                <div class="controls">
                  <select name="fedex_service_type" class="form_2_select2 m-wrap span3">
                    <option value=''>请选择</option>
                    <?php $_from = $this->_tpl_vars['ServiceType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option <?php if ($this->_tpl_vars['re']['fedex_service_type'] == $this->_tpl_vars['key']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>
            </td>
          </tr>
      
          <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
          <input type="hidden" name="status" value="<?php echo $this->_tpl_vars['re']['status']; ?>
"/>
        </table>
        <div class="form-actions">
          <button type="button" id='submit_eidt' class="btn red">提交</button>
        </div>
      </form>
    </div>
  </div>
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

function load_ini()
{

  modify_states();
  
}
$('.form_2_select2').select2({
  placeholder: "请选择",
  allowClear: true
});
var modify_states = function()
{  
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  var form1 = $('#form_eidt');
  $("#submit_eidt").click(function(){
    if(form1.valid()==true)
    {
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="package/package_edit1")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg)
      {
       // alert(msg);
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
            window.parent.location.reload(true);
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