<?php /* Smarty version 2.6.20, created on 2017-04-20 13:29:04
         compiled from supplier_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'supplier_list.htm', 75, false),array('modifier', 'admin_to_login', 'supplier_list.htm', 103, false),array('modifier', 'f_get_status', 'supplier_list.htm', 116, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>备案管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">商户管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">商户列表</a></li>
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
          <div class="caption"><i class="icon-search"></i>商户搜素</div>
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
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?> value="1">15</option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?> value="2">30</option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?> value="3">50</option>
                  </select>
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label">状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected="selected"<?php endif; ?> value="1">开启</option>
                    <option <?php if ($_GET['search_status'] == '2'): ?>selected="selected"<?php endif; ?> value="2">关闭</option> 
                  </select>
                </div> 
              </div>
              
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">登录帐号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_user" value="<?php echo $_GET['search_user']; ?>
" class="m-wrap small"/>
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label">公司名称</div>
                </span>
                <div class="span3" style="margin-left:0px;"> 
                  <div class="input-append">
                    <input type="text" name="search_company" value="<?php echo $_GET['search_company']; ?>
" class="m-wrap small"/> 
                    <button class="btn green" type="submit">Search</button>  
                  </div>
                </div>
              </div>
            </form>
           </div>
        </div>
      </div>
      <div id='product_all'>
        <span onclick="alertWin('添加商户',800,400,'<?php echo ((is_array($_tmp="supplier/supplier_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/')" class="btn red">添加商户</span>
        <form action="" id='form_filing_list' method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
            <thead>
              <tr role="heading">      
                <th width="240" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
                <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">登录帐号</th>
                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">公司名称</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">手机</th>
                <th width="70" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">进口关区</th>
                <th width="70" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">交税类型</th>
                <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国外拿货地址</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发件方</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收件方</th>
                <th width="150" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">fedex运费支付</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">fedex清关</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商户模式</th>
                <th width="130" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">添加时间</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']['list']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td>
                    <a href="#" onclick="alertWin('编辑供应商',800,400,'<?php echo ((is_array($_tmp="supplier/supplier_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a>
                  	<a target="_blank" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('admin_to_login', true, $_tmp) : admin_to_login($_tmp)); ?>
"  class="btn red mini"> 登陆</a> 
                  </td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <span class="btn green mini">开启</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                      <span class="btn red mini">关闭</span>
                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>                  
                  <td><?php echo $this->_tpl_vars['item']['user']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['company']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['mobile']; ?>
</td> 
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['filing_type'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'customs_list') : f_get_status($_tmp, 'customs_list')); ?>
</td> 
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['filing_kjt_type'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'customs_rate_type') : f_get_status($_tmp, 'customs_rate_type')); ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['en_addr']; ?>
</td> 
                  <td><?php echo $this->_tpl_vars['item']['send_addr_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['end_addr_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['payor_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['dutiesPayment_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['addr_name']; ?>
</td> 
                  <td><?php echo $this->_tpl_vars['item']['addtime']; ?>
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
          <div class="row-fluid">
            <div class="clear"></div>
            <div class="span6">
              <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
            </div>
          </div>
        </form>
      </div> 
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
  /* <?php if ($this->_tpl_vars['re']['list']): ?> */
  initTable1();
  /* <?php endif; ?> */
  bind_window();

  /*jQuery('.group-checkable').change(function () {
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
 
//row-details row-details-close
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
			"sScrollX":'1690px',
			//"sScrollY":"300px",
      // set the initial value
      "iDisplayLength": 10,
			//'sScrollXInner':true,
			//"bSortCellsTop":true,    
  });
    
}

</script> 