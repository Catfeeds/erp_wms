<?php /* Smarty version 2.6.20, created on 2017-05-15 15:22:48
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/admin/html_ini.htm */ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="utf8" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="utf8" class="ie9"> <![endif]-->

<!--[if !IE]><!-->
<html lang="utf8">
<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>
<meta charset="utf-8" />
<title>ERP-多渠道管理系统</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href=/static/css/bootstrap.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/bootstrap-responsive.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/font-awesome.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/style-metro.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/style.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/style-responsive.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/default.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css" id="style_color"/>
<link href=/static/css/uniform.default.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/bootstrap-modal.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href=/static/css/select2_metro.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<link rel="stylesheet" href=/static/css/DT_bootstrap.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="/static/favicon.ico?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<!-- END FOOTER --> 
<script>
function f_main_index()
{
	window.parent.frames_reload();
	window.parent.closeWin();
}
<?php if ($this->_tpl_vars['close_msg'] == 1): ?>
	 f_main_index();
<?php endif; ?>
</script>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) --> 
<!-- BEGIN CORE PLUGINS --> 
<script src="/static/js/jquery-1.10.1.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/jquery-migrate-1.2.1.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip --> 
<script src="/static/js/jquery-ui-1.10.1.custom.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/bootstrap.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<!--[if lt IE 9]>

	<script src="/static/js/excanvas.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>

	<script src="/static/js/respond.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>  

	<![endif]--> 

<script src="/static/js/jquery.slimscroll.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/jquery.blockui.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/jquery.cookie.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/jquery.uniform.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script> 
<!-- END CORE PLUGINS --> 

<!-- BEGIN PAGE LEVEL PLUGINS --> 

<script type="text/javascript" src="/static/js/select2.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script type="text/javascript" src="/static/js/jquery.dataTables.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script type="text/javascript" src="/static/js/DT_bootstrap.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 

<!-- END PAGE LEVEL PLUGINS --> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<!-- END CORE PLUGINS --> 
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="/static/js/bootstrap-modal.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script> 
<script src="/static/js/bootstrap-modalmanager.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="/static/js/app.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>
function load_sub()
{
    $('form').append("<input type='hidden' name='form_rand_load' value='"+Math.ceil(Math.random()*100)+"'>");
	$('body').modalmanager('loading');
	return true;
}

//弹出窗口
function alertWin(title,w,h,src)
{
	window.parent.alertWin(title,w,h,src);
}
</script>
<style>
#span_label{width:100px; font-size:14px; font-weight: normal;line-height:34px;}
</style>
</head>
<body>

<div id="modal-container-confirm" class="modal hide fade"  data-backdrop='static' role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 id="myModalLabel" style=" font-weight:bold; color:red;font-size:18px;" >
           <i class="icon-edit"></i> 消息提示
        </h3>
    </div>
    <div class="modal-body" style="border-top:1px solid  #000;">
        <p>
           操作后不可修改
        </p>
    </div>
    <div class="modal-footer">
         <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button> <button class="act btn green btn-primary">确认提交</button>
    </div>
</div>

 <div id="modal-container-msg" class="modal hide fade"  data-backdrop='static' role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 id="myModalLabel" style=" font-weight:bold; color:blue; font-size:18px;" >
           <i class="icon-edit"></i> 消息提示
        </h3>
    </div>
    <div class="modal-body" style="border-top:1px solid  #000;">
        <p>
           操作后不可修改
        </p>
    </div>
    <div class="modal-footer">
         <button class="btn" data-dismiss="modal" aria-hidden="true">close</button> 
    </div>
</div>
     

  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
    <!-- BEGIN PAGE CONTAINER--> 
     <?php if (! empty ( $this->_tpl_vars['output_cache'] )): ?>
        <?php echo $this->_tpl_vars['output_cache']; ?>

     <?php elseif (! empty ( $this->_tpl_vars['output'] )): ?>
   		 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['output'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
     <?php endif; ?>
    <!-- END PAGE CONTAINER--> 
    <div id="ajax-modal" class="modal hide fade"   tabindex="-1"></div>
    <div id="ajax-modal_1" class="modal hide fade"   tabindex="1"></div>
    <div id="ajax-modal_2" class="modal hide fade"   tabindex="2"></div>
  <!-- END PAGE --> 
<!-- END CONTAINER --> 
<!-- BEGIN FOOTER -->
    <div class="footer">
    <div>执行查询:<?php echo $this->_tpl_vars['db_info_msg']['num']; ?>
条 总查询时间:<?php echo $this->_tpl_vars['db_info_msg']['tim']; ?>
 秒</div>
      <div class="footer-tools"> <span class="go-top"> <i class="icon-angle-up"></i> </span> </div>
    </div>
<script>

	//消息提示框
	function modal_confirm(msg,obj)
	{
		$.fn.modal.defaults.width  = '';
		$.fn.modal.defaults.height = '';
		$('#modal-container-confirm').modal('show');
		$('#modal-container-confirm .modal-body').html(msg);
		$('#modal-container-confirm .act').unbind('click').bind('click',function(){
			$('#modal-container-confirm').modal('hide');
			obj();
		});
	} 
	
	//消息提示框
	function modal_msg(msg)
	{
		$.fn.modal.defaults.width  = '';
		$.fn.modal.defaults.height = '';
		$('#modal-container-msg').modal('show');
		$('#modal-container-msg .modal-body').html(msg);
	}
 	
    //close关闭窗口刷新主页
    jQuery(document).ready(function() {  
       App.init();
       try{load_ini()}catch(e){};
       $('a').bind('click',function(){
            var df=$(this).attr('href');
            if(df!='#'&&df!=''&&df!='javascript:;'&&$(this).hasClass('fancybox-button')!=true)
                load_sub();
       });
    });	
    
</script> 

</body>
<!-- END BODY -->
</html>