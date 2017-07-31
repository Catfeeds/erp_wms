<?php /* Smarty version 2.6.20, created on 2017-03-29 09:34:19
         compiled from other_batches_list.html */ ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>订单管理</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">批次管理</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">收到批次</a></li>
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
                <div id="span_label">批次ID</div>
                </span>
                                <div class="span3" style="margin-left:0px;">
                                    <input type="text"  name="search_id"  value="<?php echo $_GET['search_id']; ?>
" class="m-wrap small"/>
                                </div>
                            </div>




                            <div class="row-fluid" style="margin-top:20px;">

                                    <div class="input-append">
                                        <button class="btn green" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <form action="" method="post">
                    <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
                        <thead>
                        <tr role="heading">
                            <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次ID</th>
                            <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次名称</th>
                            <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次状态</th>
                            <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单总数</th>
                            <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">未通过数</th>
                            <!--<th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">关区</th>-->
                            <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">税总金额</th>
                            <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">税款支付</th>
                            <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费总金额</th>
                            <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费支付</th>
                            <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">投递时间</th>
                        </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php if ($this->_tpl_vars['re']['list']): ?>
                        <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item']['batches_name']; ?>
</td>
                            <td>
                                <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                                <span class="btn black mini">初始化</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                                <span class="btn blue mini">待审核</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 3): ?>
                                <span class="btn yellow mini">已审核</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 4): ?>
                                <span class="btn blue mini">待发货</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 5): ?>
                                <span class="btn yellow mini">已发货</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 6): ?>
                                <span class="btn green mini">国内已通关</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $this->_tpl_vars['item']['order_num']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item']['fail_order_num']; ?>
</td>
                            <!--<td>-->
                            <!--<?php if ($this->_tpl_vars['item']['customs'] == 0): ?> -->
                            <!--<span class="btn red mini">未选择</span>-->
                            <!--<?php elseif ($this->_tpl_vars['item']['customs'] == 1): ?> -->
                            <!--<span class="btn green mini">成都</span>-->
                            <!--<?php elseif ($this->_tpl_vars['item']['customs'] == 2): ?> -->
                            <!--<span class="btn green mini">北京</span>-->
                            <!--<?php elseif ($this->_tpl_vars['item']['customs'] == 3): ?> -->
                            <!--<span class="btn green mini">深圳</span>-->
                            <!--<?php elseif ($this->_tpl_vars['item']['customs'] == 4): ?>-->
                            <!--<span class="btn green mini">杭州</span>-->
                            <!--<?php elseif ($this->_tpl_vars['item']['customs'] == 5): ?> -->
                            <!--<span class="btn green mini">上海</span>-->
                            <!--<?php endif; ?>-->
                            <!--<?php if ($this->_tpl_vars['item']['tax_type'] == 0): ?> -->
                            <!--<span class="btn red mini">未选择</span>-->
                            <!--<?php elseif ($this->_tpl_vars['item']['tax_type'] == 1): ?> -->
                            <!--<span class="btn blue mini">行邮税</span>-->
                            <!--<?php elseif ($this->_tpl_vars['item']['tax_type'] == 2): ?> -->
                            <!--<span class="btn blue mini">综合税</span>-->
                            <!--<?php endif; ?>-->
                            <!--</td>-->
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
                            <td><?php echo $this->_tpl_vars['item']['freight_total']; ?>
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
                            <td></td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="99">暂时无数据</td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <div class="row-fluid">
                        <div class="span6"> </div>
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
                var url          = $(this).attr('data-url');
                var show_id      = $(this).attr('data-id');
                var batches_name = $(this).attr('batches-name');
                var airport      = $(this).attr('data-airport');
                var flight_date  = $(this).attr('flight-date');
                var flight_num   = $(this).attr('flight-num');
                var pallet_no    = $(this).attr('pallet-no');
                setTimeout(function()
                {
                    $.fn.modal.defaults.width='600px';
                    $.fn.modal.defaults.height='350px';
                    $modal.load(
                            url,
                            {
                                show_id: show_id,
                                batches_name: batches_name,
                                airport: airport,
                                flight_date: flight_date,
                                flight_num: flight_num,
                                pallet_no: pallet_no
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
            "bAutoWidth":true,
            "bStateSave":false,
            "sScrollX":'1800px',
            //"sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
            //'sScrollXInner':true,
            //"bSortCellsTop":true,
        });

    }

</script>