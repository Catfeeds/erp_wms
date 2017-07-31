<?php /* Smarty version 2.6.20, created on 2017-01-04 17:25:33
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/batches_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/batches_edit.htm', 91, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;" >
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
  <h4 style="color:#fff; margin-top:5px;">确认已经送至货运站</h4>
</div>
<div class="modal-body" >
  <div class="tab-content">
    <div  >
      <form action="" id="form_batches_edit" class="form-horizontal" method="post">
        
                <div id='alert-error_1' class="alert alert-error hide">
          <button class="close" data-dismiss="alert"></button>
          <span>提交失败</span>
        </div>
        <div id='alert-success_1' class="alert alert-success hide">
          <button class="close" data-dismiss="alert"></button>
          <span>提交成功</span>
        </div>

        <div class="row-fluid">
          <label class="control-label span2">批次ID<span class="required">*</span></label>
          <div class="span3">
              <span id="span_label"><?php echo $this->_tpl_vars['re']['id']; ?>
</span>
          </div>
 
          <label class="control-label span2">批次名称<span class="required">*</span></label>
          <div class="span3">
              <span id="span_label"><?php echo $this->_tpl_vars['re']['batches_name']; ?>
</span>
          </div>  
        </div>
     

        
        <div class="row-fluid" style="margin-top:10px;">
          <div class="control-group">
            <label class="control-label span2">投递时间<span class="required">*</span></label>
            <div class="span7" >
              <div class="input-append date date-picker" data-date="<?php echo $_GET['flight_date']; ?>
" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                <input name="post_date" class="m-wrap m-ctrl-medium date-picker" type="text" <?php if ($this->_tpl_vars['re']['flight_date'] == '0000-00-00'): ?>value="<?php echo $_GET['search_stime']; ?>
"<?php else: ?>value="<?php echo $this->_tpl_vars['re']['flight_date']; ?>
"<?php endif; ?> >
                <span class="add-on"><i class="icon-calendar"></i></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row-fluid" style="margin-top:10px;">
          <div class="control-group">
            <label class="control-label span2">投递订单数<span class="required">*</span></label>
            <div class="span7" >
              <div class="input-append ">
                <input name="post_order_num" class="m-wrap m-ctrl-medium " type="text" >
                <span class="add-on"><i class="icon-num"></i></span>
              </div>
            </div>
          </div>



        </div>

        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>        
      </form>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" id='button_batches_edit' class="btn red">提交</button>
  <button type="button" data-dismiss="modal" class="btn">关闭</button>
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

/*日期选择*/
$('.date-picker').datepicker({
  format:'yyyy-mm-dd',
  language: 'cn',
  weekStart: 1,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 0,
  startView: 0,
  forceParse: 0,
  showMeridian: 1
});

var error1      =$('#alert-error_1'); 
var success1    =$('#alert-success_1'); 

$("#button_batches_edit").click(function()
{
  $.post('<?php echo ((is_array($_tmp='batches/batches_edit')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$("#form_batches_edit").serialize(),function(msg)
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