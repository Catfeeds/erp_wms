<?php /* Smarty version 2.6.20, created on 2016-12-21 14:35:14
         compiled from cat_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'cat_list.htm', 25, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>网站管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">公共参数管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">类型列表</a></li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12">     
      <form action="" method="post">
        <table class="table table-striped table-bordered table-hover dataTable" id="table_1">
          <thead>
            <tr role="heading">
              <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
              <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
              <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">分类名 <span class="btn red mini" onclick="alertWin('添加分类',800,400,'<?php echo ((is_array($_tmp="cat/cat_add_or_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')">添加分类</span></th>
              
              
            </tr>
          </thead>
          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php if ($this->_tpl_vars['re']): ?>
          <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <tr>
            <td><a href="#" onclick="alertWin('编辑商品类型',800,400,'<?php echo ((is_array($_tmp="cat/cat_add_or_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a></td>
            <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>                  
            <td><?php echo $this->_tpl_vars['item']['cat']; ?>
</td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
          <?php else: ?>
          <tr>
            <td colspan="99">暂时无数据</td>
          </tr>
          <?php endif; ?>
        </table>
        <div class="row-fluid">
          <div class="span6"> </div>
          <div class="clear"></div>
          <div class="span6">
            <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
          </div>
        </div>
      </form>
    </div>
    <!--show window-->   
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script> 
<link rel="stylesheet" type="text/css" href="/static/css/datepicker.css">
<script type="text/javascript" src="/static/js/bootstrap-datepicker.js"></script> 
<script>

function load_ini()
{
	/* <?php if ($this->_tpl_vars['re']['list']): ?> */
	initTable1();
	/* <?php endif; ?> */
	/*
	jQuery('.group-checkable').change(function () {
	  var set = jQuery(this).attr("data-set");
	  var checked = jQuery(this).is(":checked");
	  jQuery(set).each(function () {
		  if (checked) {
			  $(this).attr("checked", true);
		  } else {
			  $(this).attr("checked", false);
		  }
	  });
	  jQuery.uniform.update(set);
	});
	*/	
}

var initTable1 = function() 
{        
  $('#table_1').dataTable( {
    "aoColumnDefs": [
      {"bSortable": false, "aTargets": [ 0 ] }
    ],
    "aaSorting": [[1, 'asc']],
    "aLengthMenu": [
      [5, 15, 20, -1],
      [5, 15, 20, "All"] // change per page values here
    ],
    "oLanguage": {
      "sProcessing": "正在加载中......",
      "sLengthMenu": "每页显示 _MENU_ 条记录",
      "sZeroRecords": "正在加载中......",
      "sEmptyTable": "查询无数据！",
      "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
      "sInfoEmpty": "显示0到0条记录",
      "sInfoFiltered": "数据表中共为 _MAX_ 条记录",
      "sSearch": "当前页数据搜索",
      "oPaginate": {
       "sFirst": "首页",
       "sPrevious": "上一页",
       "sNext": "下一页",
       "sLast": "末页"
      }
    },
    "bSort":false,
    "bInfo":false,
    "bPaginate":false,
    "bAutoWidth":true,
    "bStateSave":false,
    "sScrollX":'1690px',
    //"sScrollY":"300px",
    // set the initial value
    //"iDisplayLength": 10,
    //'sScrollXInner':true,
    //"bSortCellsTop":true,
  }); 
}

</script> 