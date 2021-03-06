<?php /* Smarty version 2.6.20, created on 2017-04-26 17:18:23
         compiled from fedex_user_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'fedex_user_add.htm', 348, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->  
  <div class="row-fluid">
    <div class="span12"> 
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>网站管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">运费管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">添加发货地址</a></li>
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
              <div class="caption"><i class="icon-reorder"></i>添加发货地址</div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <form action=""  id="form_submit"  class="form-horizontal" method="post" >
               	               	<div id='alert-error_1' class="alert alert-error hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>提交失败</span>
                </div>
                <div id='alert-success_1' class="alert alert-success hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>提交成功</span>
                </div>	       

                <div class="control-group">
                  <label class="control-label">所属类型<span class="required">*</span></label>
                  <div class="controls">
                   	<select size="1" name="type" aria-controls="sample_1" class="form_2_select2 m-wrap span6">
	                    <option value="">请选择</option>
	                    <option value="1">发货地</option>
	                    <option value="2">收货地</option>                 
	                    <option value="3">第三方</option>
	                  </select>
                  </div>
                </div> 

                <div class="control-group">
                  <label class="control-label">真实姓名<span class="required">*</span></label>
                  <div class="controls">
                   	<input type="text" name="personName" class="span6 m-wrap"/><font color="red">必需填写英文姓名</font>
                  </div>
                </div>           

               	<div class="control-group">
                  <label class="control-label">公司<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="companyName" class="span6 m-wrap"/><font color="red">必需填写英文公司名</font>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">电话号码<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="phoneNumber" class="span6 m-wrap"/>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">地址<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="Address_streetLines" class="span6 m-wrap"/><font color="red">必需填写英文地址</font>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">城市<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="Address_City" class="span6 m-wrap"/><font color="red">必需填写英文城市名</font>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">城市缩写<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="Address_StateOrProvinceCode" class="span6 m-wrap"/><font color="red">必需填写英文城市名缩写</font>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">邮政编码<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="Address_PostalCode" class="span6 m-wrap"/>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">account<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="account" class="span6 m-wrap"/>
                  </div>
                </div>

				  <div class="control-group">
					  <label class="control-label">FedEx对接账号<span class="required">*</span></label>
					  <div class="controls">
						  <select size="1" name="fedex_account" aria-controls="sample_1" class="form_2_select2 m-wrap span6">
							  <option value="">请选择</option>
							  <?php $_from = $this->_tpl_vars['account']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							  <option value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['AccountNumber']; ?>
</option>
							  <?php endforeach; endif; unset($_from); ?>
						  </select>
					  </div>
				  </div>

			  	<div class="control-group">
				  <label class="control-label">国家地区<span class="required">*</span></label>
				  <div class="controls">
					  <select size="1" name="Address_CountryCode" aria-controls="sample_1" class="form_2_select2 m-wrap span6">
						  <option value="">请选择</option>
						  <?php $_from = $this->_tpl_vars['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						  <option value="<?php echo $this->_tpl_vars['item']['c_flag']; ?>
|<?php echo $this->_tpl_vars['item']['c_name']; ?>
|<?php echo $this->_tpl_vars['item']['c_id']; ?>
"><?php echo $this->_tpl_vars['item']['c_name']; ?>
</option>
						  <?php endforeach; endif; unset($_from); ?>
					  </select>
				  </div>
			  	</div>
                <div class="control-group">
                  <label class="control-label">是否是居民区<span class="required">*</span></label>
                  <div class="controls">
                   	<select size="1" name="Address_Residential" aria-controls="sample_1" class="form_2_select2 m-wrap span6">
	                    <option value="">请选择</option>
	                    <option value="true" >是</option>
	                    <option value="false">否</option>                 
	                  </select>
                  </div>
                </div>
                
                <div class="form-actions">
                  <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
                  <button type="button"  id='submit_add'  class="btn green">提交</button>
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
	
	var form1 = $('#form_submit');
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-inline', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "",
		rules: {
			type: {
				required: true
			}
			,
			personName: {
				required: true
			}
			,
			companyName: {
				required: true
			}
			,
			phoneNumber: {
				required: true
			}
			,
			Address_streetLines: {
				required: true
			}
			,
			Address_City: {
				required: true
			}
			,
			Address_StateOrProvinceCode: {
				required: true
			}
			,
			Address_PostalCode: {
				required: true
			}
			,
			account: {
				required: true
			}
			,
			fedex_account: {
				required: true
			}
			,
			Address_CountryCode: {
				required: true
			}
			,
			Address_Residential: {
				required: true
			}
		},
		messages : {
			type:{
				required: '所属类型不能为空'
			 }
			,
			personName: {
				required: '真实姓名不能为空'
			}
			,
			companyName: {
				required: '公司不能为空'
			}
			,
			phoneNumber: {
				required: '电话号码不能为空'
			}
			,
			Address_streetLines: {
				required: '地址不能为空'
			}
			,
			Address_City: {
				required: '城市不能为空'
			}
			,
			Address_StateOrProvinceCode: {
				required: '城市缩写不能为空'
			}
			,
			Address_PostalCode: {
				required: '邮政编码不能为空'
			}
			,
			account: {
				required: 'account不能为空'
			}
			,
			fedex_account: {
				required: 'FedEx对接账号不能为空'
			}
			,
			Address_CountryCode: {
				required: '国家编码缩写不能为空'
			}
			,
			Address_Residential: {
				required: '是否是居民区不能为空'
			}
		}
		,
		invalidHandler: function (event, validator) { //display error alert on form submit              
			success1.hide();
			error1.find('span').html('请完善提交内容再提交');
			error1.show();
			App.scrollTo(error1, -200);
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
	
	$("#submit_add").click(function(){
		if(form1.valid()==true)
		{
			//encodeURI(msg)
			$modal=$('#ajax-modal');
			error1.hide();
			success1.show();
			success1.find('span').html('正在提交...........');
			$('body').modalmanager('loading');
			$.post('1',form1.serialize(),function(msg){
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
					
					setTimeout(function(){
					 $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
						$modal.modal();
					 });
					}, 300);
				}catch(e){ 
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