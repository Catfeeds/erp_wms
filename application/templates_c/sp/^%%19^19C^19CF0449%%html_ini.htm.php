<?php /* Smarty version 2.6.20, created on 2017-05-15 15:20:32
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/html_ini.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/html_ini.htm', 107, false),)), $this); ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="utf8" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="utf8" class="ie9"> <![endif]-->

<!--[if !IE]><!-->
<html lang="utf8">
<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>
<meta charset="utf-8" />
<title>挚捷行ERP物流系统-<?php echo $this->_tpl_vars['seo_tltie']; ?>
</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="/static/css/bootstrap.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/bootstrap-responsive.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/font-awesome.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/style-metro.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/style.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/style-responsive.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/default.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css" id="style_color"/>
<link href="/static/css/uniform.default.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/bootstrap-modal.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="/static/css/select2_metro.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<link rel="stylesheet" href="/static/css/DT_bootstrap.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="/static/favicon.ico?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />

<!-- END FOOTER --> 
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
	$('body').modalmanager('loading');
	return true;
}
</script>
<style>
#span_label{width:100px; font-size:14px; font-weight: normal;line-height:34px;}
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<?php if ($this->_tpl_vars['show_ajax'] != 1): ?>
<body class="page-header-fixed" style=" background:#3d3d3d ;background:#3d3d3d  !important; " >

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top"> 
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="container-fluid"> 
      <!-- BEGIN LOGO --> 
      <a class="brand" href="index.html"> <img src="/static/logo.gif" alt="logo" /> </a> 
      <!-- END LOGO --> 
      <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
      <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse"> <img src="/static/image/menu-toggler.png" alt="" /> </a> 
      <!-- END RESPONSIVE MENU TOGGLER --> 
      <!-- BEGIN TOP NAVIGATION MENU -->
      <ul class="nav pull-right">
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <li class="dropdown user"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img alt="" src="/static/image/avatar1_small.jpg" /> <span class="username"><?php echo $this->_tpl_vars['admin']; ?>
</span> <i class="icon-angle-down"></i> </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo ((is_array($_tmp="user/logout")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"><i class="icon-key"></i> 退出</a></li>
          </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
      </ul>
      <!-- END TOP NAVIGATION MENU --> 
    </div>
  </div>
  <!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid"> 
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar nav-collapse collapse" > 
    <!-- BEGIN SIDEBAR MENU -->
    <div style="display:block; clear:both;"></div>
    <ul class="page-sidebar-menu" style="margin-top:30px;">
      <li> 
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler hidden-phone"></div>
        <!-- BEGIN SIDEBAR TOGGLER BUTTON --> 
      </li>
      <li> 
        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
        <form class="sidebar-search" action="" method="post">
          <div class="input-box"> <a href="javascript:;" class="remove"></a>
            <input type="text" placeholder="搜索订单号" />
            <input type="button" class="submit" value="" />
          </div>
        </form>
        <!-- END RESPONSIVE QUICK SEARCH FORM --> 
      </li>
      <?php $_from = $this->_tpl_vars['nva_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
      <li class="<?php echo $this->_tpl_vars['v']['liclass']; ?>
 <?php if ($this->_tpl_vars['v']['m'] === $this->_tpl_vars['select_class']): ?>active<?php endif; ?>"> <?php if ($this->_tpl_vars['v']['action']): ?> <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['action'])) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"> <i class="<?php echo $this->_tpl_vars['v']['ico']; ?>
"></i> <span class="title"><?php echo $this->_tpl_vars['v']['name']; ?>
</span> </a> <?php else: ?> <a href="javascript:;"> <i class="<?php echo $this->_tpl_vars['v']['ico']; ?>
"></i> <span class="title"><?php echo $this->_tpl_vars['v']['name']; ?>
</span> <span class="arrow"></span> </a>
        <ul class="sub-menu">
          <?php $_from = $this->_tpl_vars['v']['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kk'] => $this->_tpl_vars['name']):
?>
          <?php if ($this->_tpl_vars['name'] != ''): ?>
         		 <li class="<?php if ($this->_tpl_vars['kk'] == ($this->_tpl_vars['select_class'])."/".($this->_tpl_vars['select_method'])): ?>active<?php endif; ?>"> <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['kk'])) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"><?php echo $this->_tpl_vars['name']; ?>
</a> </li>
          <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        </ul>
        <?php endif; ?> </li>
      <?php endforeach; endif; unset($_from); ?>
    </ul>
    <!-- END SIDEBAR MENU --> 
  </div>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
  <div class="page-content"  id='body-page-content' style="min-height:900px;"  >


    <?php else: ?>
    <body>
    <?php endif; ?>
    
    
    <div id="modal-container-confirm" class="modal hide fade"  data-backdrop='static' role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 id="myModalLabel" style=" font-weight:bold; color:red;" >
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

    <?php if ($this->_tpl_vars['show_ajax'] != 1): ?>
    <!-- END PAGE CONTAINER--> 
    <div id="ajax-modal" class="modal hide fade"   tabindex="-1"></div>
    <div id="ajax-modal_1" class="modal hide fade"   tabindex="1"></div>
    <div id="ajax-modal_2" class="modal hide fade"   tabindex="2"></div>
  </div>
  <!-- END PAGE --> 
</div>
<!-- END CONTAINER --> 
<!-- BEGIN FOOTER -->
<div class="footer">
  <div class="footer-inner"> 2016 &copy;<?php echo $this->_tpl_vars['config']['copyright']; ?>
 </div>
  <div class="footer-tools"> <span class="go-top"> <i class="icon-angle-up"></i> </span> </div>
</div>

<?php endif; ?>
<script>

//消息提示框
function modal_confirm(msg,obj)
{
	$.fn.modal.defaults.width  = '';
	$.fn.modal.defaults.height = '';
	$('#modal-container-confirm').modal('show');
	$('#modal-container-confirm .modal-body').html(msg);
	$('#modal-container-confirm .act').unbind('click').bind('click',function(e){
		$('#modal-container-confirm').modal('hide');
		obj(e);
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

	
jQuery(document).ready(function() {  
   function  set_page_content()
   {
	    if(document.documentElement && document.documentElement.clientHeight) 
		{ var d_Height = document.documentElement.clientHeight;} 
		else if(document.body) 
		{var d_Height = document.body.clientHeight;} 
		var Height=parseInt(d_Height)-80;  
   	   $('#body-page-content').css('min-height',Height+"px"); 
   }
   
   window.onresize=function(){
	    set_page_content();
   }
   window.onchange=function(){
	    set_page_content();
   }
   
   window.onclick=function(){
	    set_page_content();
   }
   
   set_page_content();
   $('.sidebar-toggler').bind('click',function(){
		if($('body').hasClass('page-sidebar-closed')==false)
			$.cookie('pagesidebarclosed', '1', { expires: 7, path: '/' }); 
		else
			$.cookie('pagesidebarclosed', null); 
   });
   
   if($.cookie('pagesidebarclosed')==1)
   {
	 	$('body').addClass('page-sidebar-closed'); 
   }

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