<?php /* Smarty version 2.6.20, created on 2017-04-20 13:43:42
         compiled from supplier_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'supplier_add.htm', 404, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12">
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>备案管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">商户管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">添加商户</a></li>
      </ul>
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><i class="icon-reorder"></i>添加商户</div>
        </div>
      </div>
      <?php if (! empty ( $this->_tpl_vars['fedex_account'] )): ?>
        <form action="" method="get" onsubmit="return load_sub();">
          <div class="row-fluid" style="margin-top:10px;">
                  <span class="span1" style="display:block;">
                    <div id="span_label">FedEx对接账号</div>
                  </span>
            <div class="span4" style="margin-left:0px;">
              <select size="1" id="form_2_select2" name="fedex_account" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                <option  value="all">请选择账号</option>
                <?php $_from = $this->_tpl_vars['fedex_account']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
-<?php echo $this->_tpl_vars['item']['AccountNumber']; ?>
"><?php echo $this->_tpl_vars['item']['AccountNumber']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
              </select>
              <div class="input-append">
                <button class="btn green" name="btn" value="btn_search" type="submit">下一步</button>
              </div>
            </div>
          </div>
        </form>
      <?php endif; ?>
        <div class="portlet-body form"> 
          <!-- BEGIN FORM-->
          <?php if (! empty ( $this->_tpl_vars['addr'] )): ?>
          <form action="" id="form_supplier_add" class="form-horizontal" method="get" onsubmit="return load_sub();">
                        <div id='alert-error_1' class="alert alert-error hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交失败</span> </div>
            <div id='alert-success_1' class="alert alert-success hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交成功</span> </div>
            <div class="control-group">
              <label class="control-label">FedEx对接账号<span class="required">*</span></label>
              <div class="controls">
                <input type="text"  value="<?php echo $this->_tpl_vars['addr']['fedex_account']; ?>
" disabled="disabled" class="span5 m-wrap"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">用户账号<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="user"  class="span5 m-wrap"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">用户密码<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="pass" data-required="1" class="span5 m-wrap"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">操作密码<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="act_pass" data-required="1" class="span5 m-wrap"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">公司名称<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="company" value="<?php echo $this->_tpl_vars['re']['company']; ?>
" data-required="1" class="span5 m-wrap"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">手机号码<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="mobile" value="<?php echo $this->_tpl_vars['re']['mobile']; ?>
" data-required="1" class="span5 m-wrap"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">FedEx发货方<span class="required">*</span></label>
              <div class="controls">

                <select name="send_addr_id"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                  <option value="">请选择发货地址</option>
                  <?php $_from = $this->_tpl_vars['addr']['send_addr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
">City:<?php echo $this->_tpl_vars['item']['Address_City']; ?>
|
                  Company:<?php echo $this->_tpl_vars['item']['companyName']; ?>

                </option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">FedEx申报币种<span class="required">*</span></label>
              <div class="controls">

                <select name="currency"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                  <option value="">请选择币种</option>
                  <?php $_from = $this->_tpl_vars['addr']['currency']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                  <option  value="<?php echo $this->_tpl_vars['item']['c_id']; ?>
|<?php echo $this->_tpl_vars['item']['code']; ?>
"><?php echo $this->_tpl_vars['item']['currency']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">FedEx签收方<span class="required">*</span></label>
              <div class="controls">
                <select name="end_addr_id"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                  <option value="">请选择收货地址</option>
                  <?php $_from = $this->_tpl_vars['addr']['end_addr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <option <?php if ($this->_tpl_vars['re']['end_addr_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
">City:<?php echo $this->_tpl_vars['item']['Address_City']; ?>
|
                  Company:<?php echo $this->_tpl_vars['item']['companyName']; ?>

                  </option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">FedEx运费支付方<span class="required">*</span> </label>
              <div class="controls">
                <select name="payor_id" aria-controls="sample_1" class="form_2_select2 m-wrap span5" >
                  <option value="">请选择运费支付方</option>
                  <?php $_from = $this->_tpl_vars['addr']['billaccount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <option <?php if ($this->_tpl_vars['re']['payor_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
">Company:<?php echo $this->_tpl_vars['item']['companyName']; ?>

                  |City:<?php echo $this->_tpl_vars['item']['Address_City']; ?>
|Account:<?php echo $this->_tpl_vars['item']['account']; ?>

                  </option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">FedEx清关方<span class="required">*</span> </label>
              <div class="controls">
                <select name="dutiesPayment_id" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                  <option value="">请选择清关费用支付方</option>
                  <?php $_from = $this->_tpl_vars['addr']['dutyaccount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <option <?php if ($this->_tpl_vars['re']['dutiesPayment_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
">Company:<?php echo $this->_tpl_vars['item']['companyName']; ?>

                  |City:<?php echo $this->_tpl_vars['item']['Address_City']; ?>
|Account:<?php echo $this->_tpl_vars['item']['account']; ?>

                  </option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">国外拿货地址<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="en_addr" value="<?php echo $this->_tpl_vars['re']['en_addr']; ?>
" data-required="1" class="span5 m-wrap"/>
              </div>
            </div>


            
            <div class="control-group">
              <label class="control-label">所属关区<span class="required">*</span></label>
              <div class="controls">

                <select name="filing_type"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                  <option value="">请选择关区</option>
                  <?php $_from = $this->_tpl_vars['addr']['customs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                  <option value="<?php echo $this->_tpl_vars['key']; ?>
" ><?php echo $this->_tpl_vars['item']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
               
               </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">通关交税类型<span class="required">*</span></label>
             <div class="controls">
                <select name="filing_kjt_type" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                  <option value="">请选择交税类型</option>
                  <?php $_from = $this->_tpl_vars['addr']['customs_rate_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                  <option value="<?php echo $this->_tpl_vars['key']; ?>
" ><?php echo $this->_tpl_vars['item']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>

               </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">商户模式<span class="required">*</span></label>
              <div class="controls">
                    <select name="sp_addr"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                      <option value="">选择商户模式</option>
                      <?php $_from = $this->_tpl_vars['addr']['sp_addr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                      <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
|<?php echo $this->_tpl_vars['item']['addr_name']; ?>
"><?php echo $this->_tpl_vars['item']['addr_name']; ?>
 </option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>
               </div>
                
            </div>

            <div class="control-group" style="display: none;">
              <label class="control-label">货运站选择<span class="required">*</span></label>
              <div class="controls">
                <select name="sp_huoyunzhan"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                  <option value="">选择指定货运站</option>
                  <?php $_from = $this->_tpl_vars['addr']['huoyunzhan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                  <option <?php if ($this->_tpl_vars['re']['addr_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['company']; ?>
 </option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>

              </div>

            </div>

            <div class="control-group">
              <label class="control-label">是否关闭<span class="required">*</span></label>
              <div class="controls">
                <select size="1" id="form_2_select2"  name="status" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                  <option <?php if ($this->_tpl_vars['re']['status'] == '1'): ?>selected="selected"<?php endif; ?> value='1'>开启
                  </option>
                  <option <?php if ($this->_tpl_vars['re']['status'] == '2'): ?>selected="selected"<?php endif; ?> value='2'>关闭
                  </option>
                </select>
              </div>
            </div>

            <div class="form-actions">
              <input type="hidden" name="fedex_account" value="<?php echo $this->_tpl_vars['addr']['fedex_account_id']; ?>
">
              <button type="button" id='submit_supplier_add' class="btn green">提交</button>
            </div>
          </form>
          <?php endif; ?>
          <!-- END FORM--> 
        </div>
      </div>
      <!-- END VALIDATION STATES--> 
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
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
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  var form1 = $('#form_supplier_add');
  form1.validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {
      user: {
        required: true,
        minlength: 4
      }
      ,
      company: {
        required: true,
        minlength: 2
      }
      ,
      pass: {
        required: true,
        minlength: 6
      }
      ,
      act_pass: {
        required: true,
        minlength: 6
      }
      ,
      mobile: {
        required: true,
        number: true,
        rangelength: [11,11]
      }
      ,
      pass_edit: {
        minlength: 6
      }
      ,
      act_pass_edit: {
        minlength: 6
      },
      en_addr: {
        required: true
      },
      sp_addr: {
        required: true
      },
	  filing_kjt_type: {
        required: true
      },
	  filing_type: {
        required: true
      }
    },
    messages: {
      user: {
        required: '登录账号不能为空',
        minlength: '登录帐号不能小于4个字符'
       }
      ,
      company: {
        required: '公司名称不能为空',
        minlength: '公司名称不能小于2个字符'
      }
      ,
      pass: {
        required: '登录密码不能为空',
        minlength: '登录密码不能小于6位'
      }
      ,
      act_pass: {
        required: '操作密码不能为空',
        minlength: '操作密码不能小于6位'
      }
      ,
      mobile: {
        required: '手机号码不能为空',
        number: '手机号码必须是数字',
        rangelength: '手机号码必须是11位'
      }
      ,
      pass_edit: {
        minlength: '登录密码不能小于6位'
      }
      ,
      act_pass_edit: {
        minlength: '操作密码不能小于6位'
      }
      ,
      en_addr: {
        required: '国外拿货地址不能为空'
      }
      ,
      sp_addr: {
        required: '商户模式必须填写'
      },
	  filing_kjt_type: {
        required: '交税类型必须选择'
      },
	  filing_type: {
        required: '申报关区必须选择'
      }
    }
    ,

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
  
  $("#submit_supplier_add").click(function(){
    if(form1.valid()==true)
    {
      //encodeURI(msg)
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="supplier/supplier_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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

  $('select[name=sp_addr]').change(function(){

      if($(this).val().split('|')[0]==3){
          $('select[name=sp_huoyunzhan]').parents('div.control-group').show();
      }else{
        $('select[name=sp_huoyunzhan]').parents('div.control-group').hide();
      }
   
  })

}

</script> 