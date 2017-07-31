<?php /* Smarty version 2.6.20, created on 2017-05-17 16:06:48
         compiled from package_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package_list.htm', 138, false),array('modifier', 'f_get_status', 'package_list.htm', 165, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">包裹管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">fedex包裹列表</a></li>
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
          <div class="caption"><i class="icon-search"></i>包裹列表搜素</div>
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
                <div id="span_label">会员ID</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input class="m-wrap small" type="text" name="search_userid" value="<?php echo $_GET['search_userid']; ?>
">
                </div>                         
              </div> 

              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">包裹ID</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_id" value="<?php echo $_GET['search_id']; ?>
" class="m-wrap small"/>
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label">包裹状态</div> 
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>                 
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected = "selected"<?php endif; ?> value="1">未确认</option>
                    <option <?php if ($_GET['search_status'] == '2'): ?>selected = "selected"<?php endif; ?> value="2">已确认待审核</option>
                    <option <?php if ($_GET['search_status'] == '3'): ?>selected = "selected"<?php endif; ?> value="3">审核通过</option>
                  </select>  
                </div>               
              </div>     

              <div class="row-fluid" style="margin-top:20px;">              
                <span class="span1" style="display:block;">
                <div id="span_label">FedEx主单号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_fedex_index" value="<?php echo $_GET['search_fedex_index']; ?>
" class="m-wrap small"/>
                </div>

                  <span class="span1" style="display:block;">
                <div id="span_label">FedEx请求状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_run_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <?php $_from = $this->_tpl_vars['run_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option <?php if ($_GET['search_run_status'] == $this->_tpl_vars['item']): ?>selected = "selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                  <button class="btn green" type="submit">Search</button>
                </div>
              </div>




            </form>
           </div>
        </div>
      </div>
      <div  id="product_all">
        <form id='form_product_select' action="" method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id='table_1' >
                        <div id='alert-error_1' class="alert alert-error hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交失败</span>
            </div>
            <div id='alert-success_1' class="alert alert-success hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交成功</span>
            </div>
            <thead>
              <tr role="heading">
                <th width="20" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#form_product_select .list-checkable'/></th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹ID</th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">会员ID</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹状态</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">FedEx请求状态</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">FedEx主单号</th>
                <th width="150" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">FedEx预估费用</th>
                <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">重量</th>
                <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">长</th>
                <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">高</th>
                <th width="60"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">宽</th>

                <th width="120"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹类型</th>
                <th width="120"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹业务类型</th>
                <th width="120"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">FedEx预收费用</th>
                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">FedEx操作日志</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']['list']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
                <tr>
                  <td><input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable"/></td>
                  <td>
                    <a href="#" onclick="alertWin('包裹编辑',800,400,'<?php echo ((is_array($_tmp="package/package_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"> 编辑</a>
                    <?php if ($this->_tpl_vars['item']['status'] != 1): ?>
                    <!--<a href="#" onclick="alertWin('包裹编辑',800,400,'<?php echo ((is_array($_tmp="package/package_get_fedex_index")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> fedex请求</a>-->
                    <!--<a href='#' data-url="<?php echo ((is_array($_tmp='package/test_fedex')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" class="btn green mini rate" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">创建运单</a>-->
                    <!--<a href='#' data-url="<?php echo ((is_array($_tmp='package/retest_fedex')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" class="btn red mini rate" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">重新创建</a>-->
                    <!--<?php if ($this->_tpl_vars['item']['estimated_rate'] == 0.00 || empty ( $this->_tpl_vars['item']['estimated_rate'] )): ?>-->
                    <!--<a href="#" data-url="<?php echo ((is_array($_tmp='package/get_fedex_rate')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" class="btn green mini rate" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">预估</a>-->
                    <!--<?php endif; ?>-->
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] != 1): ?>
                    <a href="#" onclick="alertWin('查看订单',800,400,'<?php echo ((is_array($_tmp="package/package_order_info")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn yellow mini"> 查看</a>
                    <?php endif; ?>
                    <?php echo $this->_tpl_vars['item']['id']; ?>


                  </td>
                  <td><?php echo $this->_tpl_vars['item']['userid']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <span class="btn red mini">未确认</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                      <span class="btn blue mini">已确认待审核</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 3): ?>
                      <span class="btn green mini">审核通过</span>
                    <?php endif; ?>
                  </td>
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['run_status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'run_status') : f_get_status($_tmp, 'run_status')); ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_index']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['estimated_rate'] != 0.00): ?><a href="#" onclick="alertWin('查看费用详情',800,400,'<?php echo ((is_array($_tmp="package/package_fee_info")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn yellow mini">查看</a><?php endif; ?>
                    <?php echo $this->_tpl_vars['item']['estimated_rate_currency']; ?>
<?php echo $this->_tpl_vars['item']['estimated_rate']; ?>


                  </td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_weight']; ?>
<?php echo $this->_tpl_vars['item']['fedex_weight_unit']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_length']; ?>
<?php echo $this->_tpl_vars['item']['fedex_lwh_unit']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_height']; ?>
<?php echo $this->_tpl_vars['item']['fedex_lwh_unit']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_width']; ?>
<?php echo $this->_tpl_vars['item']['fedex_lwh_unit']; ?>
</td>
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['fedex_package_type'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'fedex_package_type') : f_get_status($_tmp, 'fedex_package_type')); ?>
</td>
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['fedex_service_type'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'ServiceType') : f_get_status($_tmp, 'ServiceType')); ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['estimated_rate_currency']; ?>
<?php echo $this->_tpl_vars['item']['estimated_rate']*1.2; ?>
</td>
                  <td>
                    <a href="#" onclick="alertWin('查看日志',800,400,'<?php echo ((is_array($_tmp="package/fedex_package_log")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini">查看</a>
                    <?php echo $this->_tpl_vars['item']['log']['content']; ?>

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
          <div class="input-append">
            <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#form_product_select .list-checkable' />
          </div>
          <div class="input-append">
            <button type="button" data-url='<?php echo ((is_array($_tmp="package/package_batches_create")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-action="batches" data-act="2" data-box-size="800|500" class="modify_popup btn yellow">预估运费</button>
          </div>
          <div class="input-append">
            <button type="button" data-url='<?php echo ((is_array($_tmp="package/package_batches_create")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-action="batches"   data-act="1" data-box-size="800|500" class="modify_popup btn green">创建运单</button>
          </div>
          <div class="input-append">
            <button type="button" data-url='<?php echo ((is_array($_tmp="package/package_batches_create")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-action="batches"   data-act="3" data-box-size="800|500" class="modify_popup btn red">再建运单</button>
          </div>
          <div class="row-fluid" id='act_btn'>
            <div class="span6">
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
var msgggg=function(){

  $('#product_all .rate').click(function(){
    var id = $(this).attr('data-id');
    var url= $(this).attr('data-url');
    $modal=$('#ajax-modal_1');
    $('body').modalmanager('loading');
    $.post(url+"?id="+id,function(msg){
     // alert(msg);
      try
      {
        eval("var str="+msg);
        //操作成功
        if(str.type==1)
        {
          //错误提示
          $('body').modalmanager('removeLoading');

        }
        else if(str.type==2)
        {
          //错误提示
          $('body').modalmanager('removeLoading');

        }
        else if(str.type==3)
        {
          //错误提示
          $('body').modalmanager('removeLoading');
          //刷新主页面
          window.location='';
          return true;
        }
        setTimeout(modal_msg(str.msg),300);
      }catch(e){
      // alert(msg);
        $('body').modalmanager('removeLoading');
        setTimeout(modal_msg('系统异常'),300);
      };
    });
  })


};


var createOpenshipment_batch = function()
{
  $('.modify_popup').click(function(){
      var url= $(this).attr('data-url');
      var act=$(this).attr('data-act');
      var item='';
    $(":checkbox").each(function(){
      if($(this).attr("checked")){
        if($(this).val()!=0){
          item=item+$(this).val()+",";
        }
      }
    })
    if(act==1)
    {
      msg='确定要创建FedEx运单吗？请务必编辑FedEx业务类型';
    }else if(act==2)
    {
      $(":checkbox").each(function(){

      })
      msg='确定要预估FedEx运费吗？请务必编辑FedEx业务类型';
    }else if(act==3)
    {
      msg='确定要再次创建FedEx运单吗？请务必编辑FedEx业务类型，且包裹合规';
    }
    modal_confirm(msg,function(){
      $.post(url+'?act='+act+'&item='+item,function(msg){
        //alert(msg);
        try
        {
          eval("var str="+msg);
          //操作成功
          if(str.type==1)
          {
            //错误提示
            $('body').modalmanager('removeLoading');

          }
          else if(str.type==2)
          {
            //错误提示
            $('body').modalmanager('removeLoading');

          }
          else if(str.type==3)
          {
            //刷新主页面
            window.location='';
            return true;
          }
          setTimeout(function(){
            $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
              $modal.modal();
            });
          }, 300);
        }catch(e){
          //alert(msg);
          $('body').modalmanager('removeLoading');
          setTimeout(function(){
            $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
              $modal.modal();
            });
          }, 300);
        };
      });

    })

  })
}


var bind_window = function()
{
  App.initFancybox();
  $.fn.modalmanager.defaults.resize = true;
  $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
  var $modal = $('#ajax-modal');
  $('#table_1 .modify_popup').each(function(index, element) 
  {
    $(this).on('click', function()
    {
        
        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');
        var url  = $(this).attr('data-url');
        var id   = $(this).attr('data-id');
        var size = $(this).attr('data-box-size').split('|'); 
        
        setTimeout(function()
        {
          $.fn.modal.defaults.width  = size[0]+'px';
          $.fn.modal.defaults.height = size[1]+'px';
          $modal.load(
            url, 
            {
              id: id
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
    "sScrollX":'2100px',
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
    var sOut = aData[11];
    return sOut;
  }

//  $('#table_1').on('click', ' tbody td .row-details', function ()
//  {
//    var nTr = $(this).parents('tr')[0];
//    if ( oTable.fnIsOpen(nTr) )
//    {
//      /* This row is already open - close it */
//      $(this).addClass("row-details-close").removeClass("row-details-open");
//      oTable.fnClose( nTr );
//    }
//    else
//    {
//      /* Open this row */
//      $(this).addClass("row-details-open").removeClass("row-details-close");
//      oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
//    }
//  });
}

function load_ini()
{
  jQuery('.group-checkable').change(function () {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
      if (checked) {
        if(!$(this).attr('disabled'))
        {
          $(this).attr("checked", true);
        }

      } else {
        if(!$(this).attr('disabled'))
        {
          $(this).attr("checked", false);
        }

      }
    });
    jQuery.uniform.update(set);
  });
  msgggg();
  createOpenshipment_batch();
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