<?php /* Smarty version 2.6.20, created on 2017-05-03 10:32:43
         compiled from fedex_config.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'fedex_config.htm', 56, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>FedEx对接账号列表</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">对接账号列表</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">列表</a></li>
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
                    <div class="caption"><i class="icon-search"></i>FedEx对接账号搜素</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
                </div>
                <div class="portlet-body" style="display: block;">
                    <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <form action="" method="get" onsubmit="return load_sub();">
                            <div class="row-fluid">
                                <div class="span3">
                                    <label> <span id="span_label" >每页显示</span>
                                        <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                                            <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示</option>
                                            <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?> value="1">15</option>
                                            <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?> value="2">30</option>
                                            <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?> value="3">50</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="span3">
                                    <label> <span id="span_label">账号</span>
                                        <input  type="text" name="search_AccountNumber" value="" class="m-wrap small" />
                                        <button class="btn green" type="submit">Search</button>
                                    </label>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div>
                        <form action="" method="post">
                            <a href="#" onclick="alertWin('添加FedEx对接账号',800,400,'<?php echo ((is_array($_tmp="package/fedex_config_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
')" class="btn red"><i class="icon-plus"></i> 添加对接账号</a>
                            <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                                <thead>
                                <tr role="heading">
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">编号</th>
                                    <!--<th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">秘钥</th>-->
                                    <!--<th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">密码</th>-->
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">账号</th>
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">Meter账号</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php if ($this->_tpl_vars['re']['list']): ?>
                                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td width="60"><a href="#" onclick="alertWin('添加基础配置',800,400,'<?php echo ((is_array($_tmp="package/fedex_config_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i>编辑</a></td>
                                    <td width="90"><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
                                    <!--<td width="60">-->
                                        <!--<?php echo $this->_tpl_vars['item']['Key']; ?>
-->
                                    <!--</td>-->
                                    <!--<td width="90"><?php echo $this->_tpl_vars['item']['Password']; ?>
</td>-->
                                    <td width="100">
                                       <?php echo $this->_tpl_vars['item']['AccountNumber']; ?>

                                    </td>
                                    <td width="*"><?php echo $this->_tpl_vars['item']['MeterNumber']; ?>
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
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>
<script>
    $('.form_2_select2').select2({
        placeholder: "请选择",
        allowClear: true
    });
    var bind_window=function()
    {
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
        var $modal = $('#ajax-modal');


        $('#product_1 .show_detail').each(function(index, element) {

            var  select_id=$(this).attr('data-id');
            $(this).on('click', function(){
                // create the backdrop and wait for next modal to be triggered
                $('body').modalmanager('loading');

                setTimeout(function(){
                    $modal.load('<?php echo ((is_array($_tmp="dosend/dosend_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+ select_id, '', function(){
                        $modal.modal();
                        //$modal.css('margin-top','0');
                    });
                }, 200);

            });

        });
    }
    //row-details row-details-close
    var initTable1 = function() {
        /* Formating function for row details */


        var oTable = $('#product_1').dataTable( {
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
            "sScrollX":'100%',
            //"sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
            //'sScrollXInner':true,
            //"bSortCellsTop":true,
        });
    }


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

</script>