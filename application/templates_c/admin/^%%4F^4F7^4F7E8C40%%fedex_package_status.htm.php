<?php /* Smarty version 2.6.20, created on 2017-03-28 13:51:26
         compiled from fedex_package_status.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_get_status', 'fedex_package_status.htm', 86, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>fedex包裹管理</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">fedex包裹状态列表</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">fedex包裹状态列表</a></li>
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
                <div id="span_label">包裹执行状态</div>
                </span>
                                <div class="span3" style="margin-left:0px;">
                                    <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                                        <option value="all">所有状态</option>
                                        <?php $_from = $this->_tpl_vars['fedex_package_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option <?php if ($_GET['search_status'] == $this->_tpl_vars['key']): ?>selected =$key "selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>

                <span class="span1" style="display:block;">
                <div id="span_label" style="margin-right:8px;">包裹id</div>
                </span>
                                <div class="span3" style="margin-left:0px;">
                                    <div class="input-append">
                                        <input class="m-wrap small" type="text" name="search_pkid" value="<?php echo $_GET['search_userid']; ?>
">
                                        <button class="btn green" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id='product_all'>
                <form action="" id='form_order_list' method="post">
                    <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
                        <thead>
                        <tr role="heading">
                            <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">id</th>
                            <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹id</th>
                            <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹执行状态</th>
                            <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作内容</th>

                        </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php if ($this->_tpl_vars['re']): ?>
                        <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        <tr>
                            <td>
                               <?php echo $this->_tpl_vars['item']['id']; ?>

                            </td>
                            <td><?php echo $this->_tpl_vars['item']['pk_id']; ?>
</td>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'fedex_package_status') : f_get_status($_tmp, 'fedex_package_status')); ?>
</td>
                            <td><?php echo $this->_tpl_vars['item']['content']; ?>
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
                                                <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span>
                        </div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span>
                        </div>


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

    function load_ini()
    {
        bind_window();
        /* <?php if ($this->_tpl_vars['re']['list']): ?> */
        initTable1();
        /* <?php endif; ?> */
        checkchange();

        cancel_batches();

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
            "bAutoWidth":true ,
            "bStateSave":false,
            "sScrollX":'1680px',
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
            var sOut = aData[23];
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


</script>