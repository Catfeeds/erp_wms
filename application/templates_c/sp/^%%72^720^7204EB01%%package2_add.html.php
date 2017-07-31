<?php /* Smarty version 2.6.20, created on 2017-05-18 09:48:59
         compiled from package2_add.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package2_add.html', 130, false),)), $this); ?>
<div class="container-fluid">
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12">
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">包裹管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">包裹创建</a></li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><i class="icon-reorder"></i>包裹创建</div>
        </div>
        <div class="portlet-body form">
          <!-- BEGIN FORM-->
          <form action=""  class="form-horizontal" method="post"  id='form_1' enctype="multipart/form-data">
            <div class="row-fluid">
              <div id='alert-error_1' class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                <span>请上传订单</span>
              </div>
              <div id='alert-success_1' class="alert alert-success hide">
                <button class="close" data-dismiss="alert"></button>
                <span>通过正在提交......</span>
              </div>
            </div>
            <div class="row-fluid" style="margin-top:10px;">
              <div class="control-group">
                <label class="control-label">fedex包裹类型<span class="required">*</span></label>
                <div class="controls span6 ">
                  <select name="fedex_type" id="fedex_type" class="form_2_select2 m-wrap span3">
                    <option value=''>请选择</option>
                    <option value="FEDEX_ENVELOPE">FedEx快递封</option>
                    <option value="FEDEX_PAK">FedEx快递袋</option>
                    <option value="FEDEX_BOX">FedEx快递箱</option>
                    <option value="FEDEX_TUBE">FedEx快递筒</option>
                    <option value="FEDEX_10KG_BOX">FedEx10公斤快递箱</option>
                    <option value="FEDEX_25KG_BOX">FedEx25公斤快递箱</option>
                    <option value="YOUR_PACKAGING">自定义包裹</option>

                  </select>
                </div>
              </div>
            </div>
            <div class="row-fluid" style="margin-top:10px;">
              <div class="control-group">
                <label class="control-label">预计寄件日期<span class="required">*</span></label>
                <div class="span7" >
                  <div class="input-append date date-picker">
                    <input name="ship_timestamp" class="m-wrap m-ctrl-medium " id="date-picker" type="text" >
                    <span class="add-on"><i class="icon-calendar"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="control-group" style="margin-top:20px;">
              <label class="control-label">FedEx服务类型<span class="required">*</span></label>
              <div class="controls span6">
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
              <div class="controls span6">
                <h4>注释</h4>
                <p style="color: red;height: 30px;line-height: 30px">1、注意：周长超过130英寸，约330.2厘米，请选择重货服务。周长计算公式【（宽+高）*2+长 】</p>
                <p style="color: red;height: 30px;line-height: 30px">2、注意：重量超过150磅，约68公斤，请选择重货服务</p>
                <p style="color: red;height: 30px;line-height: 30px">3、注意：除自定义包裹外，其他均为经济或优先服务</p>
              </div>
            </div>
            <div class="your_packaging" style="display: none">


            <div class="row-fluid" style="margin-top:10px;">
              <div class="control-group">
                <label class="control-label">长<span class="required">*</span></label>
                <div class="controls span3">
                  <input type="text" name="fedex_length" data-required="1" class="span7 m-wrap"/>
                </div>
              </div>
            </div>

            <div class="row-fluid" style="margin-top:10px;">
              <div class="control-group">
                <label class="control-label">高<span class="required">*</span></label>
                <div class="controls span3">
                  <input type="text" name="fedex_height" data-required="1" class="span7 m-wrap"/>
                </div>
              </div>
            </div>

            <div class="row-fluid" style="margin-top:10px;">
              <div class="control-group">
                <label class="control-label">宽<span class="required">*</span></label>
                <div class="controls span3">
                  <input type="text" name="fedex_width" data-required="1" class="span7 m-wrap"/>
                </div>
              </div>
            </div>

            <div class="row-fluid" style="margin-top:10px;">
              <div class="control-group">
                <label class="control-label">长宽高计量单位<span class="required">*</span></label>
                <div class="controls span6">
                  <select name="fedex_lwh_unit" class="form_2_select2 m-wrap span3">
                    <option value=''>请选择</option>
                    <option value="cm">厘米</option>
                    <option value="in">英寸</option>
                  </select>
                </div>
              </div>
            </div>


            </div>
            <div class="form-actions">
              <input type="hidden" name="type" value="1">
              <a href="<?php echo ((is_array($_tmp="package2/package_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" class="btn red">返回</a>
              <button type="button" id='submit_add' class="btn green">提交</button>
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
<link type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<link rel="stylesheet" type="text/css" href="/static/css/jquery-ui-timepicker-addon.min.css">
<script type="text/javascript" src="/static/js/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/static/js/jquery-ui-timepicker-zh-CN.js"></script>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script>



<script>
  $('.form_2_select2').select2({
    placeholder: "请选择",
    allowClear: true
  });
  $('#date-picker').datetimepicker({
    timeFormat: "HH:mm:ss",
    dateFormat: "yy-mm-dd",
    language:  'zh-CN',
    minDate:CurentTime(),

  });
  function CurentTime() {
    var now = new Date();

    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();

    var hh = now.getHours();
    var mm = now.getMinutes();

    var clock = year + "-";

    if (month < 10)
      clock += "0";

    clock += month + "-";

    if (day < 10)
      clock += "0";

    clock += day + " ";

    if (hh < 10)
      clock += "0";

    clock += hh + ":";
    if (mm < 10) clock += '0';
    clock += mm;
    return (clock);
  }
  function load_ini()
  {


    var error1=$('#alert-error_1');
    var success1=$('#alert-success_1');

    var form1 = $('#form_1');
    form1.validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-inline', // default input error message class
      focusInvalid: false, // do not focus the last invalid input
      ignore: ":hidden",
      rules: {
        fedex_type:{
          required:true,
        },
        ship_timestamp:{
          required:true,
        },
        fedex_length: {
          required: true,
          number:true,
        },
        fedex_height: {
          required: true,
          number:true,
        },
        fedex_width: {
          required: true,
          number:true,
        },
        fedex_lwh_unit:{
          required:true,
        }


      },
      messages : {
        fedex_type:{
          required:"包裹类型必须选择",
        },
        ship_timestamp:{
          required:"寄件时间必须填写",
        },
        fedex_length:{
          required: '包裹的长必须填写',
          number:'长必须是数字'
        },
        fedex_height: {
          required: '包裹的高必须填写',
          number:'高必须是数字',
        },
        fedex_width: {
          required: '包裹的宽必须填写',
          number:'宽必须是数字',
        },
        fedex_lwh_unit:{
          required:'包裹的单位必须填写',
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

      }
    });

    $("#submit_add").click(function(){
      if(form1.valid()==true)
      {
        modal_confirm('确认要创建此FedEx包裹吗？',function(){
          //encodeURI(msg)
          $modal=$('#ajax-modal');
          error1.hide();
          success1.show();
          success1.find('span').html('正在提交...........');
          $('body').modalmanager('loading');
          $.post('<?php echo ((is_array($_tmp="package2/package_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
            //alert(msg);
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
                window.location='<?php echo ((is_array($_tmp="package2/package_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
              }
              else if(str.type==3)
              {
                error1.hide();
                success1.show();
                window.location='';
                return true;
              }
              setTimeout(modal_msg(str.msg),300);
            }catch(e){
              $('body').modalmanager('removeLoading');
              success1.hide();
              error1.find('span').html('系统异常');
              error1.show();
              setTimeout(modal_msg('系统异常'),300);

            };
          });
        })

      }
    });

    $('#fedex_type').change(function(){
      if($('#fedex_type').val()=='YOUR_PACKAGING')
      {
        $('.your_packaging').show();
      }
      else
      {
        $('.your_packaging').hide();
      }
    })


  }

</script>