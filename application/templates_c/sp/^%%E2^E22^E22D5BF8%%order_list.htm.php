<?php /* Smarty version 2.6.20, created on 2017-06-21 16:31:20
         compiled from order_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_list.htm', 140, false),array('modifier', 'escape', 'order_list.htm', 180, false),array('modifier', 'get_img_auth', 'order_list.htm', 241, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">订单管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">订单列表</a></li>
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
          <div class="caption"><i class="icon-search"></i>订单列表搜素</div>
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
                <div id="span_label" style="margin-right:8px;">导入单号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input class="m-wrap small" type="text" name="search_import_id" value="<?php echo $_GET['search_import_id']; ?>
"> 
                </div> 
                
            
              </div>      
              
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">订单状态</div> 
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>                 
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected = "selected"<?php endif; ?> value="1">待审核</option>
                    <option <?php if ($_GET['search_status'] == '2'): ?>selected = "selected"<?php endif; ?> value="2">已审核</option>
                    <option <?php if ($_GET['search_status'] == '3'): ?>selected = "selected"<?php endif; ?> value="3">待发货</option>
                    <option <?php if ($_GET['search_status'] == '4'): ?>selected = "selected"<?php endif; ?> value="4">已收货</option>
                    <option <?php if ($_GET['search_status'] == '5'): ?>selected = "selected"<?php endif; ?> value="5">已通关</option>
                    <option <?php if ($_GET['search_status'] == '-1'): ?>selected = "selected"<?php endif; ?> value="-1">订单取消</option>
                    <option <?php if ($_GET['search_status'] == '-2'): ?>selected = "selected"<?php endif; ?> value="-2">通关失败</option>
                  </select>
                </div> 
                
                <span class="span1" style="display:block;">
                <div id="span_label" style="margin-right:8px;">批次编号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input class="m-wrap small" type="text" name="search_batches_id" value="<?php echo $_GET['search_batches_id']; ?>
">  <div class="input-append">
                    <button class="btn green" type="submit">导出某批的未备案产品</button>
                  </div>
                </div>  
              </div> 
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">  <?php if ($this->_tpl_vars['re']['filing_kjt_type'] == 1): ?>三证状态<?php endif; ?></div>
                </span>
                <div class="span3" style="margin-left:0px;">
                 <?php if ($this->_tpl_vars['re']['filing_kjt_type'] == 1): ?>
                  <select size="1" id="form_2_select2" name="search_card_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>                                   
                    <option <?php if ($_GET['search_card_status'] == '1'): ?>selected = "selected"<?php endif; ?> value = "1">未上传</option>
                    <option <?php if ($_GET['search_card_status'] == '2'): ?>selected = "selected"<?php endif; ?> value = "2">已上传</option>
                    <option <?php if ($_GET['search_card_status'] == '3'): ?>selected = "selected"<?php endif; ?> value = "3">已审核</option>                                  
                  </select>
                  <div class="input-append">
                    <button class="btn green" type="submit">Search</button>
                  </div>
                  <?php else: ?>
                  	<button class="btn green" type="submit">Search</button>
                  <?php endif; ?> 
                </div> 
                <span class="span1" style="display:block;">
                <div id="span_label" style="margin-right:8px;"></div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  
                </div>  
              </div>
            </form>
           </div>
        </div>
      </div>
      <div  id="product_all">
        <form id='form_product_select' action="" method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id='table_1' >
            <thead>
              <tr role="heading">
                <th width="90" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/> 选择操作</th>
                <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单ID</th>
                <th width="40" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">导入订单号</th>
                <th width="70" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">所属包裹</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹状态</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单状态</th>

                <?php if ($this->_tpl_vars['re']['filing_kjt_type'] == 1): ?>
               	 <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">三证状态</th>
                <?php endif; ?> 
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">总金额</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">总税</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国内总运费</th>
                <th width="70" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次编号</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人姓名</th>
                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人地址</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人手机</th>            
                <th width="140" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">上传时间</th>
                <th width="140" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发货时间</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单号</th>
                <th style='display:none;' class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"></th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']['list']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
                <tr>
                  <td>
                   <input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable" />
                   <a href="<?php echo ((is_array($_tmp="order/order_ems_point")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?ids=<?php echo $this->_tpl_vars['item']['id']; ?>
" target="_blank" class="btn green mini"> 打印</a>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
 <span style="margin-left:5px;" class="row-details row-details-close"></span></td>                
                  <td><?php echo $this->_tpl_vars['item']['import_id']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['fedex_pakge_id'] == 0): ?>
                    <span class="btn blue mini">未打包</span>
                    <?php else: ?>
                    <?php echo $this->_tpl_vars['item']['fedex_pakge_id']; ?>

                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['package_status'] == 0): ?>
                      <span class="btn red mini">未确认</span>
                    <?php elseif ($this->_tpl_vars['item']['package_status'] == 1): ?>
                      <span class="btn blue mini">已确认</span>
                    <?php endif; ?>
                  </td>
                  <td> 
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <span class="btn blue mini">待审核</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                      <span class="btn blue mini">已审核</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 3): ?>
                      <span class="btn red mini">待发货</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 4): ?>
                      <span class="btn green mini">已发货</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 5): ?>
                      <span class="btn green mini">已通过</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == -1): ?>
                      <span class="btn black mini">已作废</span>
                   <?php elseif ($this->_tpl_vars['item']['status'] == -2): ?>
                      <span class="btn black mini">未通关</span>
                    <?php endif; ?>
                  </td>
                  
                  <?php if ($this->_tpl_vars['re']['filing_kjt_type'] == 1): ?>
                  <td>

                    <?php if ($this->_tpl_vars['item']['card_status'] == 1): ?>
                      <span  data-url='<?php echo ((is_array($_tmp="order/order_card_upload")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
&import_id=<?php echo $this->_tpl_vars['item']['import_id']; ?>
&consignee=<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['consignee'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&card_no=<?php echo $this->_tpl_vars['item']['card_no']; ?>
' 
                             class="btn blue mini modify_popup">未上传</span>

                    <?php elseif ($this->_tpl_vars['item']['card_status'] == 2): ?>
                      <span  data-url='<?php echo ((is_array($_tmp="order/order_card_upload")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
&import_id=<?php echo $this->_tpl_vars['item']['import_id']; ?>
&consignee=<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['consignee'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&card_no=<?php echo $this->_tpl_vars['item']['card_no']; ?>
'  class="btn green mini modify_popup">已上传</span>
                    <?php elseif ($this->_tpl_vars['item']['card_status'] == 3): ?>
                      <span class="btn red mini">已审核</span>
                    <?php endif; ?>
                  </td>
                  <?php endif; ?>
                  
                  <td><?php echo $this->_tpl_vars['item']['total_price']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['total_rate']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['total_freight']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['batches_id'] == -1): ?>
                      暂无添加批次
                    <?php else: ?>
                      <?php echo $this->_tpl_vars['item']['batches_id']; ?>

                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['consignee']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['province']; ?>
<?php echo $this->_tpl_vars['item']['city']; ?>
<?php echo $this->_tpl_vars['item']['area']; ?>
<?php echo $this->_tpl_vars['item']['consignee_address']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['consignee_mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['add_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['send_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['logistics_no']; ?>
</td>
                  <td style='display:none;'>   
                    <table class="table table-striped table-hover table-bordered dataTable">
                      <thead>
                        <tr>
                          <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品编号</th>
                          <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th>
                          <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">导入名称</th>
                          <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件价格</th>
                          <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件税价</th>
                          <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件重量</th> 
                          <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">数量</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $_from = $this->_tpl_vars['re']['list'][$this->_tpl_vars['k']]['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item_list']):
?>
                          <tr>
                            <td><?php echo $this->_tpl_vars['item_list']['stock_id']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['name']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['im_name']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['price']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['rate']; ?>
</td> 
                            <td><?php echo $this->_tpl_vars['item_list']['weight']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['num']; ?>
</td>
                          </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        
                        <?php if ($this->_tpl_vars['re']['filing_kjt_type'] == 1): ?>
                        <tr>
                          <th colspan="2">身份证正面</th>
                          <th colspan="2">身份证反面</th>
                          <th colspan="99">商品小票</th>
                        </tr>
                        <tr>
                          <td colspan="2">
                              <img width='100px'  src='<?php echo ((is_array($_tmp='card_1')) ? $this->_run_mod_handler('get_img_auth', true, $_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid']) : get_img_auth($_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid'])); ?>
' />
                          </td>
                          <td colspan="2">
                              <img width='100px'  src='<?php echo ((is_array($_tmp='card_2')) ? $this->_run_mod_handler('get_img_auth', true, $_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid']) : get_img_auth($_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid'])); ?>
' />
                          </td>
                          <td colspan="99">
                              <img width='100px' src="<?php echo ((is_array($_tmp='xiaopian')) ? $this->_run_mod_handler('get_img_auth', true, $_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid']) : get_img_auth($_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid'])); ?>
" />
                          </td>
                        </tr> 
                        <?php endif; ?>
                      </tbody>
                    </table>
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
          <div class="row-fluid" id='act_btn'>
            <div class="span6">
            <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/>
            <span  data-type=0 data-url='<?php echo ((is_array($_tmp="order/order_ems_point")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' class="btn green mini"><i class="icon-print"></i> 打印</span>
            <?php if ($this->_tpl_vars['re']['filing_kjt_type'] == 1): ?> <span  data-type=1 data-url='<?php echo ((is_array($_tmp="order/order_card")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' class="btn red mini">证件通过</span><?php endif; ?>
            <span  data-type=1 data-url='<?php echo ((is_array($_tmp="order/order_del")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' class="btn red mini">删除</span>
            </div>
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

$('.form_2_select2').select2({
  placeholder: "请选择",
  allowClear: true
});

var bind_window = function()
{
  App.initFancybox();
  $.fn.modalmanager.defaults.resize = true;
  $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
  var $modal = $('#ajax-modal');
  $('#table_1 .modify_popup').each(function(index, element) 
  {
    $(this).bind('click', function()
    {
        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');
        var url       = $(this).attr('data-url');
        setTimeout(function()
        {
          $.fn.modal.defaults.width='600px';
          $.fn.modal.defaults.height='300px';
          $modal.load(
            url, '', 
          function()
          {
            $modal.modal();
            //$modal.css('margin-top','0');
          });
        }, 100);
    });   
  });
  
  
  $("#act_btn .btn").bind('click',function(){
		var type=$(this).attr('data-type');
		var url=$(this).attr('data-url');
	    $modal=$('#ajax-modal');
		$('body').modalmanager('loading');
		$.fn.modal.defaults.width='';
		$.fn.modal.defaults.height='';
		if(type==1)
		{
			$.post(url,$('#form_product_select').serialize(),function(msg){
              //alert(msg);
		    $('body').modalmanager('removeLoading');
			   try
			   {
					window.location='';
					
				}catch(e){ 
					 
					window.location='';
				};
			});
		}
		else
		{
			var str ='';
			jQuery('#product_all .list-checkable').each(function () {
			  if (jQuery(this).is(":checked")) {
				  str+=(str==''?'':',')+$(this).val();
			  }
			});
			
			window.location=url+"?ids="+str;
		}	
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
    "sScrollX":'1690px',
    //"sScrollY":"300px",
    // set the initial value
    "iDisplayLength": 10,
    //'sScrollXInner':true,
    //"bSortCellsTop":true,
  });   

  /* Formating function for row details */
  function fnFormatDetails ( oTable, nTr )
  {
    var aData = oTable.fnGetData( nTr );
    alert(aData);
    /*<?php if ($this->_tpl_vars['re']['filing_kjt_type'] == 1): ?>*/
   		 var sOut = aData[17];
	 /*<?php else: ?> */
		  var sOut = aData[16];
	/*<?php endif; ?>*/
    return sOut;
  }

  $('#table_1').on('click', ' tbody td .row-details', function () 
  {
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
}

function load_ini()
{
  bind_window();
  /* <?php if ($this->_tpl_vars['re']['list']): ?> */
  initTable1();
  /* <?php endif; ?> */

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
</script> 