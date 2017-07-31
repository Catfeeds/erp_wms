<?php /* Smarty version 2.6.20, created on 2016-12-12 14:45:19
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/package_confirm.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/package_confirm.htm', 90, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;" >
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
  <h4 style="color:#fff; margin-top:5px;">包裹【<?php echo $this->_tpl_vars['re']['id']; ?>
】确认</h4>
</div>
<div class="modal-body" >
  <div class="tab-content">
    <div style="height:350px; overflow-y:auto;" >
      <form action="" id="form_confirm" class="form-horizontal" method="post">
        
                <div id='alert-error_1' class="alert alert-error hide">
          <button class="close" data-dismiss="alert"></button>
          <span>提交失败</span>
        </div>
        <div id='alert-success_1' class="alert alert-success hide">
          <button class="close" data-dismiss="alert"></button>
          <span>提交成功</span>
        </div>

        <div class="row-fluid" style="margin-top:20px;">
          <div class="control-group">
            <label class="control-label span2">长<span class="required">*</span></label>
            <div class="span3" >
              <input type="text" name="fedex_length" value="<?php echo $this->_tpl_vars['re']['fedex_length']; ?>
" class="m-wrap"/>
            </div>

            <label class="control-label span2">高<span class="required">*</span></label>
            <div class="span3" >
              <input type="text" name="fedex_height" value="<?php echo $this->_tpl_vars['re']['fedex_height']; ?>
" class="m-wrap"/>
            </div>
          </div>
        </div>

        <div class="row-fluid" style="margin-top:20px;">
          <div class="control-group">
            <label class="control-label span2">宽<span class="required">*</span></label>
            <div class="span3" >
              <input type="text" name="fedex_width" value="<?php echo $this->_tpl_vars['re']['fedex_width']; ?>
" class="m-wrap"/>
            </div>

            <label class="control-label span2">长宽高计量单位<span class="required">*</span></label>
            <div class="span3">             
              <select name="fedex_lwh_unit">                    
                <option value=''>请选择</option>
                <option <?php if ($this->_tpl_vars['re']['fedex_lwh_unit'] == 'cm'): ?>selected="selected"<?php endif; ?> value="cm">厘米</option>
                <option <?php if ($this->_tpl_vars['re']['fedex_lwh_unit'] == 'in'): ?>selected="selected"<?php endif; ?> value="in">英寸</option>                  
              </select>            
            </div>
          </div>
        </div>
     
        <div class="row-fluid" style="margin-top:20px;">
          <div class="control-group">
            <label class="control-label span2">包裹重量<span class="required">*</span></label>
            <div class="span3" >
              <input type="text" name="fedex_weight" class="m-wrap"/>
            </div>

            <label class="control-label span2">重量单位<span class="required">*</span></label>
            <div class="span3">             
              <select name="fedex_weight_unit">                    
                <option value=''>请选择</option>
                <option value="kg">千克</option>
                <option value="lb">磅</option>                  
              </select>            
            </div>
          </div>
        </div>

        <div style="color:red; margin-left:80px;">* 提示：请确认包裹长、宽、高、计量单位后，输入包裹实际总重量、选择重量单位，最后确认提交</div>

        <input type="hidden" name="fedex_pakge_id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>        
      </form>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" id='btn_confirm' class="btn green">确认</button>
  <button type="button" data-dismiss="modal" class="btn">关闭</button>
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

var error1      =$('#alert-error_1'); 
var success1    =$('#alert-success_1'); 

$("#btn_confirm").click(function()
{
  $.post('<?php echo ((is_array($_tmp='package/package_confirm')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$("#form_confirm").serialize(),function(msg)
  {
    try
    {
      eval("var str="+msg);
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
        success1.find('span').html(str.msg);
        location.reload();
      }
    }catch(e){ 
      error1.show();    
      success1.hide();
      error1.find('span').html('系统异常');
    };
  });
});

</script>