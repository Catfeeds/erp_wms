<?php /* Smarty version 2.6.20, created on 2017-05-17 16:31:19
         compiled from package2_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package2_list.html', 83, false),array('modifier', 'f_get_status', 'package2_list.html', 146, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">集货站fedex包裹管理</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">集货站fedex包裹列表</a></li>
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
                    <div class="caption"><i class="icon-search"></i>集货站fedex包裹列表搜素</div>
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
                <div id="span_label">fedex主单号</div>
                </span>
                                <div class="span3" style="margin-left:0px;">
                                    <input type="text" name="search_fedex_index" value="<?php echo $_GET['search_fedex_index']; ?>
" class="m-wrap small"/>

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
                                    <button class="btn green" type="submit">Search</button>
                                </div>
                            </div>

                            <div class="row-fluid" style="margin-top:20px;">





                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div  id="product_all">
                <a href="<?php echo ((is_array($_tmp="package2/package_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" class="btn red">创建包裹</a>
                <form id='form_product_list' action="" method="post">
                    <table class="table table-striped table-bordered table-hover dataTable" id='table_1' >
                        <thead>
                        <tr role="heading">
                            <th width="20" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#form_product_list .list-checkable'/></th>
                            <th width="150" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                            <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹ID</th>
                            <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹状态</th>
                            <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">下载面单</th>
                            <th width="180" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">fedex主单号</th>
                            <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">重量</th>
                            <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">长</th>
                            <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">高</th>
                            <th width="100"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">宽</th>
                            <th width="120"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹类型</th>
                            <th width="120"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹业务类型</th>
                            <th width="120"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">FedEx预收费用</th>
                            <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹模式</th>

                        </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">

                        <?php if ($this->_tpl_vars['re']['list']): ?>
                        <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
                        <tr>
                            <td><input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable"  <?php if ($this->_tpl_vars['item']['status'] != 2): ?> disabled="disabled"<?php endif; ?>/></td>
                            <td>
                                <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                                <span data-url='<?php echo ((is_array($_tmp="package2/package_add_order")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-action="add"  data-box-size="1200|600" class="modify_popup btn yellow mini"><i class="icon-edit"></i>添加</span>
                                <span data-url='<?php echo ((is_array($_tmp="package2/package_confirm")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-box-size="900|400" class="modify_popup btn green mini"><i class="icon-edit"></i> 预估/确认</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 4 && $this->_tpl_vars['item']['package_request_status'] == 6): ?>
                                <span class="btn green mini"><i class="icon-ok"></i> 已投递</span>
                                <?php else: ?>
                                <span data-url='<?php echo ((is_array($_tmp="package2/package_add_order")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-action="list" data-box-size="1200|600" class="modify_popup btn yellow mini"><i class="icon-list"></i> 查看</span>
                                <?php endif; ?>

                            </td>
                            <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
                            <td>
                                <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                                <span class="btn red mini">未确认</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                                <span class="btn blue mini">已确认待审核</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 3): ?>
                                <span class="btn green mini">审核通过</span>
                                <?php elseif ($this->_tpl_vars['item']['status'] == 4): ?>
                                <span class="btn green mini">已投递</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($this->_tpl_vars['item']['package_request_status'] == 6): ?>
                                <a target="_blank" href="/fedex/<?php echo $this->_tpl_vars['item']['fedex_index']; ?>
__shiplabel.pdf"">下载面单</a>
                                <?php else: ?>
                                暂无面单
                                <?php endif; ?>
                            </td>
                            <td><?php echo $this->_tpl_vars['item']['fedex_index']; ?>
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
                            <?php if ($this->_tpl_vars['item']['type'] == 1): ?>
                            <td>fedex模式</td>
                            <?php elseif ($this->_tpl_vars['item']['type'] == 2): ?>
                            <td>空运模式</td>
                            <?php elseif ($this->_tpl_vars['item']['type'] == 3): ?>
                            <td>海运模式</td>
                            <?php endif; ?>

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
                        <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                    </div>
                    <div class="input-append">
                        <button type="button" data-url='<?php echo ((is_array($_tmp="package2/package_batches_date")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-action="batches"  data-box-size="800|500" class="modify_popup btn green">批量投递</button>
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


<script>

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
        checkchange();

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
        $('.modify_popup').each(function(index, element)
        {
            $(this).on('click', function()
            {

                // create the backdrop and wait for next modal to be triggered
                $('body').modalmanager('loading');
                var url  = $(this).attr('data-url');
                var id   = $(this).attr('data-id');
                var action = $(this).attr('data-action');
                var size = $(this).attr('data-box-size').split('|');
                if(action=='batches')
                {

                    setTimeout(function()
                    {
                        $.fn.modal.defaults.width  = size[0]+'px';
                        $.fn.modal.defaults.height = size[1]+'px';
                        $modal.load(
                                url,
                                {
                                    data:$('#form_product_list').serialize()
                                },
                                function()
                                {
                                    $modal.modal();
                                    //$modal.css('margin-top','0');
                                });
                    }, 100);
                }
                else
                {
                    setTimeout(function()
                    {
                        $.fn.modal.defaults.width  = size[0]+'px';
                        $.fn.modal.defaults.height = size[1]+'px';
                        $modal.load(
                                url,
                                {
                                    id: id,
                                    action:action
                                },
                                function()
                                {
                                    $modal.modal();
                                    //$modal.css('margin-top','0');
                                });
                    }, 100);
                }

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
            "iDisplayLength": 10
            //'sScrollXInner':true,
            //"bSortCellsTop":true,
        });

        /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = aData[10];
            return sOut;
        }
//
//        $('#table_1').on('click', ' tbody td .row-details', function ()
//        {
//            var nTr = $(this).parents('tr')[0];
//            if ( oTable.fnIsOpen(nTr) )
//            {
//                /* This row is already open - close it */
//                $(this).addClass("row-details-close").removeClass("row-details-open");
//                oTable.fnClose( nTr );
//            }
//            else
//            {
//                /* Open this row */
//                $(this).addClass("row-details-open").removeClass("row-details-close");
//                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
//            }
//        });
    }
    var checkchange = function()
    {
        $('.df_submit').bind('click',function()
        {
            //alert(1);
            $modal=$('#ajax-modal');
            $('body').modalmanager('loading');
            $.fn.modal.defaults.width='';
            $.fn.modal.defaults.height='';
            var type = $(this).attr('data-type');
            $.post('<?php echo ((is_array($_tmp='Package2/package_checkbox')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?type='+type,$('#form_product_list').serialize(),function(msg){
            try
            {
                eval("var str="+msg);

                if(str.type==1)
                {

                }
                else if(str.type==2)
                {

                }
                else if(str.type==3)
                {
                    location.reload();
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