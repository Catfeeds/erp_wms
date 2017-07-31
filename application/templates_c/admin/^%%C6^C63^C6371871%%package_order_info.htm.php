<?php /* Smarty version 2.6.20, created on 2017-01-09 13:27:34
         compiled from package_order_info.htm */ ?>
<div class="modal-body">
    <!-- BEGIN PAGE CONTENT-->
    <div class="tab-content">
        <div class="span12">
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
            <!--show window-->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>