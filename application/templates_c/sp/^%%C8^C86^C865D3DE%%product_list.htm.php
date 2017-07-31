<?php /* Smarty version 2.6.20, created on 2017-05-11 16:17:41
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_list.htm', 172, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">商品管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">我的商品</a></li>
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
          <div class="caption"><i class="icon-search"></i>我的商品搜素</div>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <form action="" method="get" onsubmit="return load_sub();">
              <div class="row-fluid">
                <span class="span1" style="display:block;">
                <div id="span_label">每页显示</div>
                </span>
                <div class="span4" style="margin-left:0px;">
                  <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示</option>
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?> value="1">15</option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?> value="2">30</option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?> value="3">50</option>
                  </select>
                </div>
                  
                <span class="span1" style="display:block;">
                <div id="span_label">备案状态</div>
                </span>
                <div class="span4" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_filing_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <option <?php if ($_GET['search_filing_status'] == '1'): ?>selected="selected"<?php endif; ?> value="1">未申请</option>
                    <option <?php if ($_GET['search_filing_status'] == '2'): ?>selected="selected"<?php endif; ?> value="2">网站审核中</option>
                    <option <?php if ($_GET['search_filing_status'] == '3'): ?>selected="selected"<?php endif; ?> value="3">审核通过</option>
                    <option <?php if ($_GET['search_filing_status'] == '4'): ?>selected="selected"<?php endif; ?> value="4">不通过</option>  
                  </select>
                </div>


              </div>
              <div class="row-fluid" style="margin-top:20px;">
                    <span class="span1" style="display:block;">
                <div id="span_label">商品条形码</div>
                </span>
                <div class="span4" style="margin-left:0px;">
                  <input type="text" name="search_barcode" value="<?php echo $_GET['search_barcode']; ?>
" class="m-wrap span5"/>
                </div>
                 <span class="span1" style="display:block;">
                <div id="span_label">商品名称</div>
                </span>
                <div class="span4" style="margin-left:0px;">
                  <input type="text" name="search_ch_name" value="<?php echo $_GET['search_ch_name']; ?>
" class="m-wrap span5"/>
                </div>
              </div >
              
              <div class="row-fluid" style="margin-top:20px;">

                <span class="span1" style="display:block;">
                <div id="span_label">商品品牌</div>
                </span>
                <div class="span4" style="margin-left:0px;">
                  <input type="text" name="search_ch_brand" value="<?php echo $_GET['search_ch_brand']; ?>
" class="m-wrap  span5"/>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品产地</div>
                </span>
                <div class="span4" style="margin-left:0px;">
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

              </div>
              <div class="row-fluid" style="margin-top:20px;" >
                <span class="span1">
                              <div id="span_label">截止日期开始</div>
                            </span>
                <div  class="span4 input-append date date-picker" style="margin-left:0px;" data-date="" data-date-format="yyyy-mm-dd" data-date-viewmode="years" >
                  <input type="text" name="search_t_sta_deadline" value="<?php echo $_GET['search_t_sta_deadline']; ?>
" class="m-wrap m-ctrl-medium date-picker span5">
                  <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
                            <span class="span1" >
                              <div id="span_label">截止日期结束</div>
                            </span>
                <div class="span4 input-append date date-picker" style="margin-left:0px;" data-date="" data-date-format="yyyy-mm-dd" data-date-viewmode="years" >
                  <input type="text" name="search_t_end_deadline" value="<?php echo $_GET['search_t_end_deadline']; ?>
" class="m-wrap m-ctrl-medium date-picker span5">
                  <span class="add-on"><i class="icon-calendar"></i></span>
                </div>


              </div>
              <div class="row-fluid" style="margin-top:20px;">
                 <span class="span1" style="display:block;">
                <div id="span_label">商品类别</div>
                </span>
                <div class="span4" style="margin-left:0px;">
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
                <th width="20"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">
                  <input value="0" type="checkbox" class="group-checkable list-checkable" data-set='#product_all .list-checkable'/>
                </th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
                <th width="120"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案状态</th>
                <th width="180" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th>
                <th width="80"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品简述</th>
                <th width="150" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品品牌</th>        
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品类别</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品产地</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">销售价</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">市场价</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">规格/型号</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">食品/非食品</th>
                <th width="130" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">上传时间</th>
                <th width="130" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案申请时间</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案紧急</th>
                <th width="130" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">截止日期</th>

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
" value="<?php echo $this->_tpl_vars['item']['filing_status']; ?>
" data-status[]="<?php echo $this->_tpl_vars['item']['filing_status']; ?>
" id="list-checkable" class="list-checkable" /></td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['filing_status'] == 1 || $this->_tpl_vars['item']['filing_status'] == 4): ?>
                      <a href="<?php echo ((is_array($_tmp="product/product_add_or_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
" class="btn green mini"><i class="icon-edit"></i> 编辑</a>
                    <?php elseif ($this->_tpl_vars['item']['filing_status'] == 2 || $this->_tpl_vars['item']['filing_status'] == 3): ?>
                      <a href="#" class="btn green mini disabled"><i class="icon-edit"></i> 编辑</a>
                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
 <span style="margin-left:5px;" class="row-details row-details-close"></span> </td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['filing_status'] == 1): ?>
                      <span class="btn red mini">未申请</span>
                    <?php elseif ($this->_tpl_vars['item']['filing_status'] == 2): ?>
                      <span class="btn blue mini">网站审核中</span>
                    <?php elseif ($this->_tpl_vars['item']['filing_status'] == 3): ?>
                      <span class="btn green mini">审核通过</span>
                    <?php elseif ($this->_tpl_vars['item']['filing_status'] == 4): ?>
                      <span class="btn yellow mini">不通过</span>
                    <?php endif; ?>
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
                  <td><?php echo $this->_tpl_vars['item']['price']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['mark_price']; ?>
</td>  
                  <td><?php echo $this->_tpl_vars['item']['ch_spe']; ?>
</td>
                  <td><?php if ($this->_tpl_vars['item']['type'] == 1): ?>食品<?php elseif ($this->_tpl_vars['item']['type'] == 2): ?>非食品<?php endif; ?></td>  
                  <td><?php echo $this->_tpl_vars['item']['uptime']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['recorder_apply_time']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['recorder_status'] == 1): ?>
                    14天内完成备案
                    <?php elseif ($this->_tpl_vars['item']['recorder_status'] == 2): ?>
                    30天内完成备案
                    <?php elseif ($this->_tpl_vars['item']['recorder_status'] == 3): ?>
                    60天内完成备案
                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['deadline']; ?>
</td>
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
                        <div id='alert-error_1' class="alert alert-error hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交失败</span> 
            </div>
            <div id='alert-success_1' class="alert alert-success hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交成功</span> 
            </div>

            <div class="input-append">
              <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
            </div>
            <div class="input-append"> 
              <button type="button" data-type="1" data-url="<?php echo ((is_array($_tmp='product/recoder_status')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" data-box-size="400|150" class="btn green df_submit">申请备案</button>
            </div>
            <div class="input-append"> 
              <button type="button" data-type="2" class="btn red df_submit">回收站</button>
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
  $('.date-picker').datepicker({
    format:'yyyy-mm-dd',
    language: 'cn',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 0,
    startView: 0,
    forceParse: 0,
    showMeridian: 1
  });
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
        sOut += '<tr><td width="80">条形码:</td><td >'+aData[17]+'</td></tr>';
        sOut += '<tr><td>主要成分:</td><td>'+aData[18]+'</td></tr>';
        sOut += '<tr><td>功能/用途:</td><td>'+aData[19]+'</td></tr>';
        sOut += '<tr><td>长度:</td><td>'+aData[20]+'</td></tr>';
        sOut += '<tr><td>宽度:</td><td>'+aData[21]+'</td></tr>';
        sOut += '<tr><td>高度:</td><td>'+aData[22]+'</td></tr>';
        sOut += '<tr><td>毛重(g):</td><td>'+aData[23]+'</td></tr>';
        sOut += '<tr><td>净重(g):</td><td>'+aData[24]+'</td></tr>';
        sOut += '</table>';
    return sOut;
  }

}

var checkchange = function()
{
  $('.df_submit').bind('click',function()
  {
    var type = $(this).attr('data-type');
    if(type==1)
    {//申请备案
      $.fn.modalmanager.defaults.resize = true;
      var size = $(this).attr('data-box-size').split('|');
      var url = $(this).attr('data-url');
      $modal=$('#ajax-modal');
      $('body').modalmanager('loading');
      setTimeout(function(){
        $.fn.modal.defaults.width  = size[0]+'px';
        $.fn.modal.defaults.height = size[1]+'px';
        $modal.load(url,'',function(){
          $modal.modal();
        });
      },100)

    }else if(type==2)
    {//回收站
      $modal=$('#ajax-modal');
      $('body').modalmanager('loading');
      $.fn.modal.defaults.width='';
      $.fn.modal.defaults.height='';
      var error1 = $('#alert-error_1');
      var success1 = $('#alert-success_1');

      $.post('<?php echo ((is_array($_tmp='product/product_checkbox')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?type='+type,$('#form_product_list').serialize(),function(msg){
      try
      {
        //alert(msg);
        eval("var str="+msg);
        if(str.type==1)
        {
          //错误提示
          error1.show();
          success1.hide();
          error1.find('span').html(str.msg);
        }
        else if(str.type==2)
        {

        }
        else if(str.type==3)
        {
          location.reload();
        }

        setTimeout(
          modal_msg(encodeURI(str.msg))
        , 300);
      }
      catch(e)
      {
        $('body').modalmanager('removeLoading');
        setTimeout(
          modal_msg(encodeURI('系统异常'))
        , 300);
      };
    });
    }
  });
};

</script> 