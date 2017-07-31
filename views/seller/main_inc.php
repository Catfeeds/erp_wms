<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="utf8" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="utf8" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="utf8">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title><{$config.title}></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="static/css/bootstrap.min.css?v=<{$vsersion}>" rel="stylesheet" type="text/css"/>
<link href="static/css/bootstrap-responsive.min.css?v=<{$vsersion}>" rel="stylesheet" type="text/css"/>
<link href="static/css/font-awesome.min.css?v=<{$vsersion}>" rel="stylesheet" type="text/css"/>
<link href="static/css/style-metro.css?v=<{$vsersion}>" rel="stylesheet" type="text/css"/>
<link href="static/css/style.css?v=<{$vsersion}>" rel="stylesheet" type="text/css"/>
<link href="static/css/style-responsive.css?v=<{$vsersion}>" rel="stylesheet" type="text/css"/>
<link href="static/css/default.css?v=<{$vsersion}>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="static/css/uniform.default.css?v=<{$vsersion}>" rel="stylesheet" type="text/css"/>
<link href="static/css/bootstrap-modal.css?v=<{$vsersion}>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="static/css/select2_metro.css?v=<{$vsersion}>" />
<link rel="stylesheet" href="static/css/DT_bootstrap.css?v=<{$vsersion}>" />
<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="media/favicon.ico?v=<{$vsersion}>" />
<!-- END FOOTER --> 
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) --> 
<!-- BEGIN CORE PLUGINS --> 
<script src="media/js/jquery-1.10.1.min.js?v=<{$vsersion}>" type="text/javascript"></script> 
<script src="media/js/jquery-migrate-1.2.1.min.js?v=<{$vsersion}>" type="text/javascript"></script> 
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip --> 
<script src="media/js/jquery-ui-1.10.1.custom.min.js?v=<{$vsersion}>" type="text/javascript"></script> 
<script src="media/js/bootstrap.min.js?v=<{$vsersion}>" type="text/javascript"></script> 
<!--[if lt IE 9]>

	<script src="media/js/excanvas.min.js?v=<{$vsersion}>"></script>

	<script src="media/js/respond.min.js?v=<{$vsersion}>"></script>  

	<![endif]--> 

<script src="media/js/jquery.slimscroll.min.js?v=<{$vsersion}>" type="text/javascript"></script> 
<script src="media/js/jquery.blockui.min.js?v=<{$vsersion}>" type="text/javascript"></script> 
<script src="media/js/jquery.cookie.min.js?v=<{$vsersion}>" type="text/javascript"></script> 
<script src="media/js/jquery.uniform.min.js?v=<{$vsersion}>" type="text/javascript" ></script> 

<!-- END CORE PLUGINS --> 

<!-- BEGIN PAGE LEVEL PLUGINS --> 

<script type="text/javascript" src="media/js/select2.min.js?v=<{$vsersion}>"></script> 
<script type="text/javascript" src="media/js/jquery.dataTables.js?v=<{$vsersion}>"></script> 
<script type="text/javascript" src="media/js/DT_bootstrap.js?v=<{$vsersion}>"></script> 

<!-- END PAGE LEVEL PLUGINS --> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<!-- END CORE PLUGINS --> 
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="media/js/bootstrap-modal.js?v=<{$vsersion}>" type="text/javascript" ></script> 
<script src="media/js/bootstrap-modalmanager.js?v=<{$vsersion}>" type="text/javascript" ></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 

<script src="media/js/app.js?v=<{$vsersion}>"></script> 
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
<body class="page-header-fixed">

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top"> 
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="container-fluid"> 
      <!-- BEGIN LOGO --> 
      <a class="brand" href="index.html"> <img src="media/logo.gif" alt="logo" /> </a> 
      <!-- END LOGO --> 
      <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
      <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse"> <img src="media/image/menu-toggler.png" alt="" /> </a> 
      <!-- END RESPONSIVE MENU TOGGLER --> 
      <!-- BEGIN TOP NAVIGATION MENU -->
      <ul class="nav pull-right">
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <li class="dropdown user"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img alt="" src="media/image/avatar1_small.jpg" /> <span class="username"><{$user}></span> <i class="icon-angle-down"></i> </a>
          <ul class="dropdown-menu">
            <li><a href="index.php?m=logout"><i class="icon-key"></i> 退出</a></li>
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
  <div class="page-sidebar nav-collapse collapse" id='nav-left-nav' > 
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
       
        <!-- END RESPONSIVE QUICK SEARCH FORM --> 
      </li>
      <{foreach item=v key=k from=$nva_menu}>
      <li class="<{$v.liclass}> <{if $v.m|check_m_flag:$smarty.get.m ==1}>active<{/if}>"> <{if $v.action}> <a href="<{$v.action}>"> <i class="<{$v.ico}>"></i> <span class="title"><{$v.name}></span> </a> <{else}> <a href="javascript:;"> <i class="<{$v.ico}>"></i> <span class="title"><{$v.name}></span> <span class="arrow"></span> </a>
        <ul class="sub-menu">
          <{foreach item=name key=kk from=$v.actions}>
          <{if $name!=''}>
          <li class="<{if $kk|check_m_flag==1}>active<{/if}>"> <a href="<{$kk}>"><{$name}></a> </li>
          <{/if}>
          <{/foreach}>
        </ul>
        <{/if}> </li>
      <{/foreach}>
    </ul>
    <!-- END SIDEBAR MENU --> 
  </div>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
  <div class="page-content"  id='body-page-content' style="min-height:900px;"  > 
    <!-- BEGIN PAGE CONTAINER--> 
     <{if !empty($output_cache)}>
        <{$output_cache}>
     <{elseif  !empty($output)}>
   		 <{include file=$output}> 
     <{/if}>
     
    <!-- END PAGE CONTAINER--> 
    <div id="ajax-modal" class="modal hide fade"   tabindex="-1"></div>
  </div>
  <!-- END PAGE --> 
</div>
<!-- END CONTAINER --> 
<!-- BEGIN FOOTER -->
<div class="footer">
  <div class="footer-inner"> 2016 &copy;<{$config.copyright}> </div>
  <div class="footer-tools"> <span class="go-top"> <i class="icon-angle-up"></i> </span> </div>
</div>

<script>
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