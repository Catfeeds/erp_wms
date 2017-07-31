<?php /* Smarty version 2.6.20, created on 2017-05-11 17:20:26
         compiled from filing_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'filing_list.htm', 185, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>备案管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">平台备案库管理  </a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">平台备案库</a></li>
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
          <div class="caption"><i class="icon-search"></i>平台备案库搜素</div>
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
                <div id="span_label">商品状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected="selected"<?php endif; ?> value="1">上架</option>
                    <option <?php if ($_GET['search_status'] == '2'): ?>selected="selected"<?php endif; ?> value="2">下架</option> 
                  </select>
                </div> 
                <span class="span1" style="display:block;">
               	 <div id="span_label">备案状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_hg_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有状态</option>
                    <option <?php if ($_GET['search_hg_status'] == 1): ?>selected="selected"<?php endif; ?> value="1">不通过</option>
                    <option <?php if ($_GET['search_hg_status'] == 2): ?>selected="selected"<?php endif; ?> value="2">备案中</option>
                    <option <?php if ($_GET['search_hg_status'] == 3): ?>selected="selected"<?php endif; ?> value="3">已通过</option>
                    <option <?php if ($_GET['search_hg_status'] == -1): ?>selected="selected"<?php endif; ?> value="-1">未备案</option>
                  </select>
                </div>
              </div>
              
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">商品名称</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_ch_name" value="<?php echo $_GET['search_ch_name']; ?>
" class="m-wrap small"/>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品品牌</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_ch_brand" value="<?php echo $_GET['search_ch_brand']; ?>
" class="m-wrap small"/>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">条形码</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_barcode" value="<?php echo $_GET['search_barcode']; ?>
" class="m-wrap small"/>
                </div>
              </div>

              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">商品产地</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_country" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有产地</option>
                    <?php $_from = $this->_tpl_vars['re']['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                    <option <?php if ($_GET['search_country'] == $this->_tpl_vars['item']['c_name']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['c_name']; ?>
"><?php echo $this->_tpl_vars['item']['c_name']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div> 
                <span class="span1" style="display:block;">
                <div id="span_label">商品类别</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_catname" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" >所有类别</option>
                      <?php $_from = $this->_tpl_vars['re']['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        <option <?php if ($_GET['search_catname'] == $this->_tpl_vars['item']['cat']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['cat']; ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</option>
				              <?php endforeach; endif; unset($_from); ?>	
                  </select>
                </div>
                
              </div>

              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                   <div id="span_label">关税类型</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                    <select size="1" id="form_2_select2" name="search_tax_type" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有关区</option>
                    <option <?php if ($_GET['search_tax_type'] == 1): ?>selected="selected"<?php endif; ?> value='1' >行邮税</option>
                    <option <?php if ($_GET['search_tax_type'] == 2): ?>selected="selected"<?php endif; ?> value='2' >综合税</option>
                  </select>
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label">进口关区</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_customs" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有关区</option>
                    <?php $_from = $this->_tpl_vars['re']['customs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                      <option <?php if ($_GET['search_customs'] == $this->_tpl_vars['key']): ?>selected="selected"<?php endif; ?> value=<?php echo $this->_tpl_vars['key']; ?>
 ><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                  <div class="input-append"> 
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>  
                <div class="span3" style="margin-left:0px;">
                    <button class="btn green"  name="down" type="submit">下载表格</button>
                </div>  
              </div>
            </form>
           </div>
        </div>
      </div>
      <div id='product_all'>
        <form action="" id='form_filing_list' method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
            <thead>
              <tr role="heading">
                <th width="20"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/></th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品编号</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">上传序号</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品状态</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">默认关区</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">计税方式</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">行邮税税率</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">综合税税率</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案状态</th>
                <th width="150" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案名称</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案价格</th>
                <th width="180" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th>
                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品简述</th> 
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品品牌</th>     
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品类别</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品产地</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">规格/型号</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">食品/非食品</th>                
                <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">条形码</th>
                <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">主要成分</th>
                <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">功能/用途</th>
                <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">长度</th>
                <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">宽度</th>
                <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">高度</th>
                <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">毛重(g)</th>
                <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">净重(g)</th> 
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']['list']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td><input type="checkbox" name="<?php echo $this->_tpl_vars['item']['id']; ?>
" value="<?php echo $this->_tpl_vars['item']['status']; ?>
|<?php echo $this->_tpl_vars['item']['customs']; ?>
|<?php echo $this->_tpl_vars['item']['tax_type']; ?>
" class="list-checkable" /></td>
                  <td>
                    <a href="#" onclick="alertWin('编辑商品备案信息',800,400,'<?php echo ((is_array($_tmp="filing/filing_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
&customs=<?php echo $this->_tpl_vars['item']['customs']; ?>
&tax_type=<?php echo $this->_tpl_vars['item']['tax_type']; ?>
&par_tax=<?php echo $this->_tpl_vars['item']['par_tax']; ?>
&con_tax=<?php echo $this->_tpl_vars['item']['con_tax']; ?>
')" class="btn green mini"><i class="icon-edit"></i>编辑</a>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
 <span style="margin-left:5px;" class="row-details row-details-close"></span> </td>
                  <td><?php echo $this->_tpl_vars['item']['upload_num']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <span class="btn red mini">上架</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                      <span class="btn blue mini">下架</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['hg_customs'] == 0): ?> 
                      未选择
                    <?php else: ?>
                      <?php $_from = $this->_tpl_vars['re']['customs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                        <?php if ($this->_tpl_vars['item']['hg_customs'] == $this->_tpl_vars['k']): ?><?php echo $this->_tpl_vars['i']; ?>
<?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?>
                    <?php endif; ?>
                    
                  </td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['hg_tax_type'] == 1): ?> 
                      行邮税
                    <?php elseif ($this->_tpl_vars['item']['hg_tax_type'] == 2): ?> 
                      综合税
                    <?php endif; ?>
                    
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['par_tax']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['con_tax']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['hg_status'] == 1): ?>
                      <span class="btn black mini">不通过</span>
                    <?php elseif ($this->_tpl_vars['item']['hg_status'] == 2): ?>
                      <span class="btn blue mini">备案中</span>
                    <?php elseif ($this->_tpl_vars['item']['hg_status'] == 3): ?>
                      <span class="btn green mini">已通过</span>
                    <?php else: ?> 
                      <span class="btn black mini">未备案</span>
                    <?php endif; ?>
                    
                  </td> 
                  <td><?php echo $this->_tpl_vars['item']['hg_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['hg_price']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['ch_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['desc']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['ch_brand']; ?>
</td>                                                              
                  <td><?php echo $this->_tpl_vars['item']['catname']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['country']; ?>
</td> 
                  <td><?php echo $this->_tpl_vars['item']['ch_spe']; ?>
</td>
                  <td><?php if ($this->_tpl_vars['item']['type'] == 1): ?>食品<?php elseif ($this->_tpl_vars['item']['type'] == 2): ?>非食品<?php endif; ?></td>              
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['barcode']; ?>
</td>
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['ch_ing']; ?>
</td>
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['ch_pur']; ?>
</td> 
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['length']; ?>
</td> 
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['width']; ?>
</td>  
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['height']; ?>
</td> 
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['gw']; ?>
</td> 
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['nw']; ?>
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
            <div class="input-append">
            <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
            </div>
            <div class="input-append"> 
              <select name="status" class="m-wrap small">
                <option value="no">商品状态</option>
                <option value="1">上架</option>
                <option value="2">下架</option>
              </select>
              <button type="button" data-type="1" class="btn green df_submit">修改</button>
            </div> 
            <div class="input-append">
              <select name="customs" class="m-wrap small">
                <option value="no">默认关区</option>
                <option value="1">成都</option>
                <option value="2">北京</option>
                <option value="3">深圳</option>
                <option value="4">杭州</option>
                <option value="5">上海</option>
              </select>
              <select name="tax_type" class="m-wrap small">
                <option value="no">计税方式</option>
                <option value="1">行邮税</option>
                <option value="2">综合税</option>
              </select>
              <button type="button" data-type="2" class="btn green df_submit">修改</button> 
            </div>
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
  checkchange();

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
			"sScrollX":'2000px',
			//"sScrollY":"300px",
      // set the initial value
      "iDisplayLength": 10,
			//'sScrollXInner':true,
			//"bSortCellsTop":true,    
  });
        
  $('#table_1').on('click', ' tbody td .row-details', function () {
      var nTr = $(this).parents('tr')[0];
      if ( oTable.fnIsOpen(nTr) )
      {
          /* This row is already open - close it */
          $(this).addClass("row-details-close").removeClass("row-details-open");
          oTable.fnClose( nTr );
      }
      else
      {
          /* Open this row */                
          $(this).addClass("row-details-open").removeClass("row-details-close");
          oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
      }
  });

  /* Formating function for row details */
    function fnFormatDetails ( oTable, nTr )
  {
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table width="100%">';
        sOut += '<tr><td width="80">条形码:</td><td >'+aData[19]+'</td></tr>';
        sOut += '<tr><td>主要成分:</td><td>'+aData[20]+'</td></tr>';
        sOut += '<tr><td>功能/用途:</td><td>'+aData[21]+'</td></tr>';
        sOut += '<tr><td>长度:</td><td>'+aData[22]+'</td></tr>';
        sOut += '<tr><td>宽度:</td><td>'+aData[23]+'</td></tr>';
        sOut += '<tr><td>高度:</td><td>'+aData[24]+'</td></tr>';
        sOut += '<tr><td>毛重(g):</td><td>'+aData[25]+'</td></tr>';
        sOut += '<tr><td>净重(g):</td><td>'+aData[26]+'</td></tr>';
        sOut += '</table>';
    return sOut;
  }

}

var checkchange = function()
{
  $('.df_submit').bind('click',function()
  {
    $modal=$('#ajax-modal');
    $('body').modalmanager('loading');
    $.fn.modal.defaults.width='';
    $.fn.modal.defaults.height='';
    var type = $(this).attr('data-type');
    $.post('<?php echo ((is_array($_tmp='filing/filing_edit_more')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?type='+type,$('#form_filing_list').serialize(),function(msg){
      try
      {
        alert(msg);
        eval("var str="+msg);
        //操作成功
        if(str.type==1)
        {

        }
        else if(str.type==2)
        {

        }
        else if(str.type==3)
        {
          //刷新主页面
          f_main_index();
          return true;
        }
        setTimeout(modal_msg(str.msg),300);
      }
      catch(e)
      { 
        $('body').modalmanager('removeLoading');
        setTimeout(modal_msg('系统异常'),300);
      };
    });
  });
};
</script> 