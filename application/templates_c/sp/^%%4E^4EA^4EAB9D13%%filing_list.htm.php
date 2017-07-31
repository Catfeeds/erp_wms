<?php /* Smarty version 2.6.20, created on 2017-05-12 14:34:38
         compiled from filing_list.htm */ ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">平台备案库</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">备案库列表</a></li>
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
          <div class="caption"><i class="icon-search"></i>备案库列表搜素</div>
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
                <div id="span_label">商品条形码</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_barcode" value="<?php echo $_GET['search_barcode']; ?>
" class="m-wrap small"/>
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
                <div id="span_label">商品产地</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_country" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有产地</option>
                    <?php $_from = $this->_tpl_vars['re']['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?> 
                    <option <?php if ($_GET['search_country'] == $this->_tpl_vars['v']['c_name']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['v']['c_name']; ?>
"><?php echo $this->_tpl_vars['v']['c_name']; ?>

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
                  <div class="input-append"> 
                    <button class="btn green" type="submit">Search</button>
                  </div>

                </div>
                <div class="span3" style="margin-left:0px;">
                  <button class="btn green"  name="down"  type="submit">下载表格</button>
                </div>
              </div>
            </form>
           </div>
        </div>
      </div>
      <div id='product_all'>
        <form action="" id='form_product_list' method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
            <thead>
              <tr role="heading">
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品备案编号</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品状态</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案状态</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">中国关区</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">中国模式</th>
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
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
 <span style="margin-left:5px;" class="row-details row-details-close"></span> </td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <span class="btn red mini">上架</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                      <span class="btn blue mini">下架</span>
                    <?php endif; ?>
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
                  <td> <?php echo $this->_tpl_vars['re']['filing_type']; ?>
</td>
                  <td> <?php echo $this->_tpl_vars['re']['filing_kjt_type']; ?>
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
   chang_status(); 

}

$('.form_2_select2').select2({
            placeholder: "请选择",
            allowClear: true
});

var bind_window =function()
{
  App.initFancybox();
  $.fn.modalmanager.defaults.resize = true;
  $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
  var $modal = $('#ajax-modal');
  $('#filing_1 .modify_popup').each(function(index, element) 
  {
    $(this).on('click', function()
    {
        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');
        var url = $(this).attr('data-url');
        var id = $(this).attr('data-id'); 
        var filing_status = $(this).attr('filing-status');
        var tax_status = $(this).attr('tax-status'); 
        setTimeout(function()
        {
          $modal.load(
            url, 
            {
              show_id:id,
              filing_status:filing_status,
              tax_status:tax_status
            }, 
          function()
          {
            $modal.modal();
            //$modal.css('margin-top','0');
          });
        }, 100);
    });   
  });
}


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
			"bAutoWidth":false,
			"bStateSave":false,
			"sScrollX":'1635px',
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
        sOut += '<tr><td width="80">条形码:</td><td >'+aData[14]+'</td></tr>';
        sOut += '<tr><td>主要成分:</td><td>'+aData[15]+'</td></tr>';
        sOut += '<tr><td>功能/用途:</td><td>'+aData[16]+'</td></tr>';
        sOut += '<tr><td>长度:</td><td>'+aData[17]+'</td></tr>';
        sOut += '<tr><td>宽度:</td><td>'+aData[18]+'</td></tr>';
        sOut += '<tr><td>高度:</td><td>'+aData[19]+'</td></tr>';
        sOut += '<tr><td>毛重(g):</td><td>'+aData[20]+'</td></tr>';
        sOut += '<tr><td>净重(g):</td><td>'+aData[21]+'</td></tr>';
        sOut += '</table>';
    return sOut;
  }

}

var chang_status=function(){
    $('.btn_from_status').bind('click',function(){
		$modal=$('#ajax-modal');
		$('body').modalmanager('loading');
		$.fn.modal.defaults.width='';
		$.fn.modal.defaults.height='';
		var url=$(this).attr('data-url');   
		$.post(url+"?status="+$($(this).attr('data-id')).val(),$('#form_product_list').serialize(),function(msg){
		  try
		  {
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
		  }catch(e){ 
			
			$('body').modalmanager('removeLoading');
            setTimeout(modal_msg('系统异常'),300);
		  };
		});
    });
}
</script> 