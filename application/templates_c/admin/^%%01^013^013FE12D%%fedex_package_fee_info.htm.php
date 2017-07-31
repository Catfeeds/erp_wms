<?php /* Smarty version 2.6.20, created on 2017-01-12 10:55:57
         compiled from fedex_package_fee_info.htm */ ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="form">
                <!-- BEGIN FORM-->
                <table class="table table-bordered table-hover dataTable" id="table_1">
                    <thead>
                    <thead>
                    <tr>
                        <th bgcolor="#E2EEFE" colspan="99">fedex包裹费用明细</th>
                    </tr>
                    </thead>
                </table>
                <div  id="product_all">
                    <form id='form_product_select' action="" method="post">
                        <table class="table table-striped table-bordered table-hover dataTable" id='table_1' >
                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="table_package_list">
                                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                    <tr>
                                        <td><?php echo $this->_tpl_vars['item']['fee_item']; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['item']['fee_value']; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['item']['fee_currency']; ?>
</td>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                            </tbody>
                        </table>
                        <div class="clear"></div>
                        <div class="span6">
                            <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>