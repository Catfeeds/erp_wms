<?php /* Smarty version 2.6.20, created on 2017-03-27 15:56:30
         compiled from package3_confirm_order_list.html */ ?>

<div class="modal-body" >
    <div class="tab-content">
        <div style="overflow-y:auto;" >
            <form action="" method="get" onsubmit="return load_sub();">
                <input type="hidden" name="fedex_pakge_id" value="<?php echo $this->_tpl_vars['re']['fedex_pakge_id']; ?>
"/>

                <div class="row-fluid">


                </div>
            </form>
        </div>

        <div  id="product_all">
            <form id='form_list' action="" method="post">
                <table class="table table-striped table-bordered table-hover dataTable" id='table_1' >
                    <thead>
                    <tr role="heading">

                        <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单编号</th>
                        <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹编号</th>
                        <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次编号</th>
                        <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人姓名</th>
                        <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人手机</th>
                        <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人地址</th>
                        <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">导入订单号</th>
                    </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
                    <tr>

                        <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
                        <td>
                            <?php echo $this->_tpl_vars['item']['fedex_pakge_id']; ?>

                        </td>
                        <td><?php echo $this->_tpl_vars['item']['batches_id']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['item']['consignee']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['item']['consignee_mobile']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['item']['province']; ?>
<?php echo $this->_tpl_vars['item']['city']; ?>
<?php echo $this->_tpl_vars['item']['area']; ?>
<?php echo $this->_tpl_vars['item']['consignee_address']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['item']['import_id']; ?>
</td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                    </tbody>
                </table>
                <div class="row-fluid" id='act_btn'>
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


</body>
<!-- END BODY -->
</html>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script>

    function load_ini()
    {
        /* <?php if ($this->_tpl_vars['re']['list']): ?> */
        initTable1();
        /* <?php endif; ?> */


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
            "sScrollX":'100%',
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
            var sOut = aData[15];
            return sOut;
        }


    }
</script>
