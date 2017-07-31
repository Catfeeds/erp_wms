<?php /* Smarty version 2.6.20, created on 2017-04-19 11:03:21
         compiled from fedex_user_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'fedex_user_edit.htm', 179, false),)), $this); ?>
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
              <th bgcolor="#E2EEFE" colspan="99">修改发货地址</th>
            </tr>
          </thead>
          <tr>
            <th>发货地址ID：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>         
          </tr>          
          <tr>
            <td colspan="99">  
              <div class="row-fluid">  
                <div class="control-group">                 
                  <label class="control-label span2">所属类型<span class="required">*</span></label>
                  <div class="controls span7">
                    <select size="1" name="type" aria-controls="sample_1" class="form_2_select2 m-wrap span9">
                      <option value="">请选择</option>
                      <option <?php if ($this->_tpl_vars['re']['type'] == '1'): ?>selected="selected"<?php endif; ?> value="1">发货地</option>
                      <option <?php if ($this->_tpl_vars['re']['type'] == '2'): ?>selected="selected"<?php endif; ?> value="2">收货地</option>                 
                      <option <?php if ($this->_tpl_vars['re']['type'] == '3'): ?>selected="selected"<?php endif; ?> value="3">第三方</option>
                    </select>
                  </div>
                </div>
              </div> 

              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">真实姓名<span class="required">*</span></label>
                  <div class="span7" >
                    <input type="text" name="personName" value="<?php echo $this->_tpl_vars['re']['personName']; ?>
" class="m-wrap span9"/>
                  </div>
                </div>
              </div>

              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">公司<span class="required">*</span></label>
                  <div class="span7" >
                    <input type="text" name="companyName" value="<?php echo $this->_tpl_vars['re']['companyName']; ?>
" class="m-wrap span9"/>
                  </div>
                </div>
              </div>

              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">电话号码<span class="required">*</span></label>
                  <div class="span7" >
                    <input type="text" name="phoneNumber" value="<?php echo $this->_tpl_vars['re']['phoneNumber']; ?>
" class="m-wrap span9"/>
                  </div>
                </div>
              </div>

              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">地址<span class="required">*</span></label>
                  <div class="span7" >
                    <input type="text" name="Address_streetLines" value="<?php echo $this->_tpl_vars['re']['Address_streetLines']; ?>
" class="m-wrap span9"/>
                  </div>
                </div>
              </div>

              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">城市<span class="required">*</span></label>
                  <div class="span7" >
                    <input type="text" name="Address_City" value="<?php echo $this->_tpl_vars['re']['Address_City']; ?>
" class="m-wrap span9"/>
                  </div>
                </div>
              </div>

              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">城市缩写<span class="required">*</span></label>
                  <div class="span7" >
                    <input type="text" name="Address_StateOrProvinceCode" value="<?php echo $this->_tpl_vars['re']['Address_StateOrProvinceCode']; ?>
" class="m-wrap span9"/>
                  </div>
                </div>
              </div>

              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">邮政编码<span class="required">*</span></label>
                  <div class="span7" >
                    <input type="text" name="Address_PostalCode" value="<?php echo $this->_tpl_vars['re']['Address_PostalCode']; ?>
" class="m-wrap span9"/>
                  </div>
                </div>
              </div>

              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">account<span class="required">*</span></label>
                  <div class="span7" >
                    <input type="text" name="account" value="<?php echo $this->_tpl_vars['re']['account']; ?>
" class="m-wrap span9"/>
                  </div>
                </div>
              </div>



              <div class="row-fluid">
                <div class="control-group">
                  <label class="control-label span2">国家地区<span class="required">*</span></label>
                  <div class="controls span7">
                    <select size="1" name="Address_CountryCode" aria-controls="sample_1" class="form_2_select2 m-wrap span7">
                      <option value="">请选择</option>
                      <?php $_from = $this->_tpl_vars['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                      <option <?php if ($this->_tpl_vars['re']['country_id'] == $this->_tpl_vars['item']['c_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['c_id']; ?>
|<?php echo $this->_tpl_vars['item']['c_name']; ?>
|<?php echo $this->_tpl_vars['item']['c_flag']; ?>
" ><?php echo $this->_tpl_vars['item']['c_name']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>
                  </div>

                </div>
              </div>

              <div class="row-fluid">  
                <div class="control-group">
                  <label class="control-label span2">是否是居民区<span class="required">*</span></label>
                  <div class="controls span7">
                    <select size="1" name="Address_Residential" aria-controls="sample_1" class="form_2_select2 m-wrap span7">
                      <option value="">请选择</option>
                      <option <?php if ($this->_tpl_vars['re']['Address_Residential'] == 'true'): ?>selected="selected"<?php endif; ?> value="true">是</option>
                      <option <?php if ($this->_tpl_vars['re']['Address_Residential'] == 'false'): ?>selected="selected"<?php endif; ?> value="false">否</option>
                    </select>
                  </div>
                </div>
              </div> 
            </td>
          </tr> 
          <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
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
  $('.form_2_select2').select2({
    placeholder: "请选择",
    allowClear: true
  });
function load_ini()
{

  modify_states();
  
}

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
      $.post('<?php echo ((is_array($_tmp="logistics/fedex_user_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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