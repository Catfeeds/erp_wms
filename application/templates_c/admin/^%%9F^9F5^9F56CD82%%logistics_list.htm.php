<?php /* Smarty version 2.6.20, created on 2016-12-12 17:41:05
         compiled from logistics_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'logistics_list.htm', 20, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>网站管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">运费管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">商户模版列表</a></li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12">
      <div>
        <a href="#" onclick="alertWin('添加运费模版',800,400,'<?php echo ((is_array($_tmp="logistics/logistics_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?index=1')" class="btn red"><i class="icon-plus"></i> 添加运费模版</a>
        <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
          <thead>
            <tr role="heading">
              <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
              <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">模版ID</th>
              <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国内模版ID</th>
              <th width="150" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费模版名称</th>
              <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">最后更新时间</th>
            </tr>
          </thead>
          <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']): ?>
              <?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td><a href="#" onclick="alertWin('编辑运费模版',800,400,'<?php echo ((is_array($_tmp="logistics/logistics_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a></td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>                  
                  <td><?php echo $this->_tpl_vars['item']['pid']; ?>
</td>                  
                  <td><?php echo $this->_tpl_vars['item']['title']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['uptime']; ?>
</td>
                </tr>
              <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
              <tr>
                <td colspan="99">暂时无数据</td>
              </tr>
            <?php endif; ?>
          </tbody> 
        </table>
      </div>
      <!--show window-->         
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script> 
<script>
$('.form_2_select2').select2({
            placeholder: "请选择",
            allowClear: true
});
var bind_window=function()
{
	 App.initFancybox();
	$.fn.modalmanager.defaults.resize = true;
	$.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
	var $modal = $('#ajax-modal');
	$('#product_1 .show_detail').each(function(index, element) {
		  var  select_id=$(this).attr('data-id');
		  $(this).on('click', function(){
			  // create the backdrop and wait for next modal to be triggered
			  $('body').modalmanager('loading');
				setTimeout(function(){
				 $modal.load('?m=product&s=bs_pro&select_id='+ select_id, '', function(){
					$modal.modal();
					//$modal.css('margin-top','0');
				 });
				}, 200);
		});
	});
}
//row-details row-details-close
var initTable1 = function() {
        /* Formating function for row details */
      
        /*
         * Insert a 'details' column to the table
         */

         
		var oTable = $('#product_1').dataTable( {
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
            "iDisplayLength": 10,
			//'sScrollXInner':true,
			//"bSortCellsTop":true,
        });
        
      
    }


function load_ini()
{
	bind_window();
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

</script> 