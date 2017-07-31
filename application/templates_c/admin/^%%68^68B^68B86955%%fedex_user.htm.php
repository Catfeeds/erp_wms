<?php /* Smarty version 2.6.20, created on 2017-04-19 14:04:34
         compiled from fedex_user.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'fedex_user.htm', 73, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>网站管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">运费管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">发货地址</a></li>
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
          <div class="caption"><i class="icon-search"></i>项目列表搜索</div>
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
                <div id="span_label">所属类型</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_type" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option selected="selected" value="all">所有状态</option>
                    <option <?php if ($_GET['search_type'] == '1'): ?>selected="selected"<?php endif; ?> value="1">国外</option>
                    <option <?php if ($_GET['search_type'] == '2'): ?>selected="selected"<?php endif; ?> value="2">国内</option>                           
                  </select>

                </div>        
              </div>
              <div  class="row-fluid" style="margin-top:20px;">
                 <span class="span1" style="display:block;">
                <div id="span_label">国家地区</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_country_id" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option selected="selected" value="all">所有国家</option>
                    <?php $_from = $this->_tpl_vars['re']['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <option <?php if ($_GET['search_country_id'] == $this->_tpl_vars['item']['c_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['c_id']; ?>
"><?php echo $this->_tpl_vars['item']['c_name']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                  <div class="input-append">
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>
              </div>
            </form>
           </div>
        </div>
      </div>
      <div id='product_all'>
        <span onclick="alertWin('添加发货地址',800,400,'<?php echo ((is_array($_tmp="logistics/fedex_user_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/')" class="btn red">添加发货地址</span>
        <form action="" id='form_filing_list' method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
            <thead>
              <tr role="heading">
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">所属类型</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">真实姓名</th>                
                <th width="160" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">公司</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">电话号码</th>
                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">地址</th>
                <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">城市</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">城市缩写</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">邮政编码</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">account</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国家地区</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国家编码缩写</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">是否是居民区</th>                    
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
              <tr>
                <td>
                  <a href="#" onclick="alertWin('修改发货地址',800,400,'<?php echo ((is_array($_tmp="logistics/fedex_user_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a>
                </td>
                <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
                <td>
                  <?php if ($this->_tpl_vars['item']['type'] == 1): ?>
                    <span class="btn green mini">发货地</span>
                  <?php elseif ($this->_tpl_vars['item']['type'] == 2): ?>
                    <span class="btn blue mini">收货地</span>
                  <?php elseif ($this->_tpl_vars['item']['type'] == 3): ?>
                  <span class="btn blue mini">第三方</span>
                  <?php endif; ?>
                </td> 
                <td><?php echo $this->_tpl_vars['item']['personName']; ?>
</td>                 
                <td><?php echo $this->_tpl_vars['item']['companyName']; ?>
</td>                 
                <td><?php echo $this->_tpl_vars['item']['phoneNumber']; ?>
</td>                 
                <td><?php echo $this->_tpl_vars['item']['Address_streetLines']; ?>
</td>                 
                <td><?php echo $this->_tpl_vars['item']['Address_City']; ?>
</td>                 
                <td><?php echo $this->_tpl_vars['item']['Address_StateOrProvinceCode']; ?>
</td>

                <td><?php echo $this->_tpl_vars['item']['Address_PostalCode']; ?>
</td>                 
                <td><?php echo $this->_tpl_vars['item']['account']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['Address_Country']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['Address_CountryCode']; ?>
</td>                  
                <td>
                  <?php if ($this->_tpl_vars['item']['Address_Residential'] == 'true'): ?>
                    <span class="btn green mini">是</span>
                  <?php elseif ($this->_tpl_vars['item']['Address_Residential'] == 'false'): ?>
                    <span class="btn red mini">否</span>
                  <?php endif; ?>
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