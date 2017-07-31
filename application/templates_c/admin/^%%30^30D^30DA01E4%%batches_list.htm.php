<?php /* Smarty version 2.6.20, created on 2017-05-08 17:02:02
         compiled from batches_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'batches_list.htm', 149, false),array('modifier', 'f_get_status', 'batches_list.htm', 165, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>订单管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">批次管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">批次列表</a></li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><i class="icon-search"></i>批次列表搜素</div>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <form action="" method="get" onsubmit="return load_sub();">     
              <div class="row-fluid">             
                <span class="span1" style="display:block;">
                <div id="span_label">每页显示</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示</option>
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?>  value="1">15</option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?>  value="2">30</option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?>  value="3">50</option>
                  </select>
                </div>                
                
                <span class="span1" style="display:block;">
                <div id="span_label">批次状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>      
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected = "selected"<?php endif; ?> value="1">初始化</option>
                    <option <?php if ($_GET['search_status'] == '2'): ?>selected = "selected"<?php endif; ?> value="2">待审核</option>
                    <option <?php if ($_GET['search_status'] == '3'): ?>selected = "selected"<?php endif; ?> value="3">已审核</option>
                    <option <?php if ($_GET['search_status'] == '4'): ?>selected = "selected"<?php endif; ?> value="4">待发货</option>
                    <option <?php if ($_GET['search_status'] == '5'): ?>selected = "selected"<?php endif; ?> value="5">已发货</option>
                    <option <?php if ($_GET['search_status'] == '6'): ?>selected = "selected"<?php endif; ?> value="6">国内已通关</option>
                  </select>
                </div> 
              </div>
              
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">税款状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_tax_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <option <?php if ($_GET['search_tax_status'] == '1'): ?>selected = "selected"<?php endif; ?> value="1">初始化</option>
                    <option <?php if ($_GET['search_tax_status'] == '2'): ?>selected = "selected"<?php endif; ?> value="2">未付款</option>
                    <option <?php if ($_GET['search_tax_status'] == '3'): ?>selected = "selected"<?php endif; ?> value="3">已付款</option>
                  </select>
                </div>

                <span class="span1" style="display:block;">
                <div id="span_label">运费状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_freight_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <option <?php if ($_GET['search_freight_status'] == '1'): ?>selected = "selected"<?php endif; ?> value="1">初始化</option>
                    <option <?php if ($_GET['search_freight_status'] == '2'): ?>selected = "selected"<?php endif; ?> value="2">未付款</option>
                    <option <?php if ($_GET['search_freight_status'] == '3'): ?>selected = "selected"<?php endif; ?> value="3">已付款</option>
                  </select>
                </div> 
              </div>
              
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">批次ID</div>
                </span>
                <div class="span3" style="margin-left:0px;">           
                  <input type="text"  name="search_id"  value="<?php echo $_GET['search_id']; ?>
" class="m-wrap small"/>  
                </div>  

                <span class="span1" style="display:block;">
                <div id="span_label">会员ID</div>
                </span>
                <div class="span2" style="margin-left:0px;">
                  <div class="input-append">
                    <input class="m-wrap small" type="text" name="search_userid" value="<?php echo $_GET['search_userid']; ?>
">
                  </div>
                </div>

              </div>
              <div class="row-fluid" style="margin-top:20px;">
                   <span class="span1" style="display:block;">
                <div id="span_label">确认状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_confirm_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <?php $_from = $this->_tpl_vars['confirm_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option <?php if (isset ( $_GET['search_confirm_status'] ) && $_GET['search_confirm_status'] != 'all' && $_GET['search_confirm_status'] == $this->_tpl_vars['key']): ?>selected = "selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                  <div class="input-append">
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>

              </div>
              </div>
            </form>
           </div>
        </div>
      </div>
      <div id='product_all'>
        <form action="" method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
            <thead>
              <tr role="heading">                
                <th width="220" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">会员ID</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次ID</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次名称</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次状态</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">确认状态</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单总数</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">未通过数</th>
                <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">关区（计税方式）</th>

                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">税款总额</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">税款支付</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费总额</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费支付</th>
                <th width="*" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费模版</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']['list']): ?>
            <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <tr>              
              <td>
                <a href="#" onclick="alertWin('编辑批次',800,400,'<?php echo ((is_array($_tmp="batches/batches_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
&batches_name=<?php echo $this->_tpl_vars['item']['batches_name']; ?>
&userid=<?php echo $this->_tpl_vars['item']['userid']; ?>
&status=<?php echo $this->_tpl_vars['item']['status']; ?>
&tax_status=<?php echo $this->_tpl_vars['item']['tax_status']; ?>
&freight_status=<?php echo $this->_tpl_vars['item']['freight_status']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a>  
                <!--<a href="#" onclick="alertWin('包裹确认',800,400,'<?php echo ((is_array($_tmp="package/package_confirm")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 包裹确认</a>-->

                <?php if ($this->_tpl_vars['item']['order_num'] == 0): ?>
                <a href="#" class="btn black mini"><i class="icon-edit"></i> 选择</a>
                <?php elseif (( $this->_tpl_vars['item']['status'] == 2 || $this->_tpl_vars['item']['status'] == 3 ) && $this->_tpl_vars['item']['confirm_status'] == 1): ?>
                <a href="#" onclick="alertWin('选择关区',800,400,'<?php echo ((is_array($_tmp="batches/batches_customs_choose")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 选择</a>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['item']['tax_type'] == 1): ?>
                <a href="#"  onclick="alertWin('下载',800,400,'<?php echo ((is_array($_tmp="batches/down_card")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?batches_id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-download-alt"></i> 下载</a>
                <?php endif; ?>
              </td>
              <td><?php echo $this->_tpl_vars['item']['userid']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>                  
              <td><?php echo $this->_tpl_vars['item']['batches_name']; ?>
</td>
              <td>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'batch_status') : f_get_status($_tmp, 'batch_status')); ?>

              </td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['confirm_status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'confirm_status') : f_get_status($_tmp, 'confirm_status')); ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['order_num']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['fail_order_num']; ?>
</td>
              <td>

                <?php if ($this->_tpl_vars['item']['customs'] == 0): ?> 
                  <span class="btn red mini">未选择</span>
                <?php else: ?> 
                  <?php $_from = $this->_tpl_vars['re']['customs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>                    
                    <?php if ($this->_tpl_vars['item']['customs'] == $this->_tpl_vars['k']): ?>
                      <span class="btn green mini"><?php echo $this->_tpl_vars['i']; ?>
</span>
                    <?php endif; ?>
                  <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['item']['tax_type'] == 0): ?> 
                  <span class="btn red mini">未选择</span>
                <?php elseif ($this->_tpl_vars['item']['tax_type'] == 1): ?> 
                  <span class="btn blue mini">行邮税</span>
                <?php elseif ($this->_tpl_vars['item']['tax_type'] == 2): ?> 
                  <span class="btn blue mini">综合税</span>
                <?php endif; ?>
              </td>

              <td><?php echo $this->_tpl_vars['item']['tax_total']; ?>
</td>
              <td>
                <?php if ($this->_tpl_vars['item']['tax_status'] == 1): ?> 
                  <span class="btn black mini">初始化</span>
                <?php elseif ($this->_tpl_vars['item']['tax_status'] == 2): ?> 
                  <span class="btn red mini">未付款</span>
                <?php elseif ($this->_tpl_vars['item']['tax_status'] == 3): ?> 
                  <span class="btn green mini">已付款</span>
                <?php endif; ?>
              </td>
              <td><?php echo $this->_tpl_vars['item']['freight_total']+$this->_tpl_vars['item']['freight_total_abroad']; ?>
</td>
              <td>
                <?php if ($this->_tpl_vars['item']['freight_status'] == 1): ?> 
                  <span class="btn black mini">初始化</span>
                <?php elseif ($this->_tpl_vars['item']['freight_status'] == 2): ?> 
                  <span class="btn red mini">未付款</span>
                <?php elseif ($this->_tpl_vars['item']['freight_status'] == 3): ?> 
                  <span class="btn green mini">已付款</span>
                <?php endif; ?>
              </td>
              <td><?php echo $this->_tpl_vars['item']['freight_template']; ?>
|<?php echo $this->_tpl_vars['item']['freight_template_abroad']; ?>
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
  bind_window();
  /* <?php if ($this->_tpl_vars['re']['list']): ?> */
  initTable1();
  /* <?php endif; ?> */
  
 /* jQuery('.group-checkable').change(function () {
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
  });*/
   
}

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

var initTable1 = function() 
{
  /*
   * Insert a 'details' column to the table
   */
	var oTable = $('#table_1').dataTable( {
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
		"sScrollX":'2000px',
		//"sScrollY":"300px",
    // set the initial value
    "iDisplayLength": 10,
		//'sScrollXInner':true,
		//"bSortCellsTop":true,
  });

}

</script> 