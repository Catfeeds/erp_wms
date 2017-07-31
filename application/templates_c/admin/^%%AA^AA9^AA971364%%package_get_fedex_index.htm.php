<?php /* Smarty version 2.6.20, created on 2017-01-13 10:24:05
         compiled from package_get_fedex_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package_get_fedex_index.htm', 119, false),)), $this); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="form">
                <!-- BEGIN FORM-->
                <table class="table table-bordered table-hover dataTable" id="table_1">
                    <thead>
                    <thead>
                    <tr>
                        <th bgcolor="#E2EEFE" colspan="99">包裹信息</th>
                    </tr>
                    </thead>
                </table>
                <div  id="product_all">
                    <form id='form_product_select' action="" method="post">
                        <table class="table table-striped table-bordered table-hover dataTable" id='table_1' >
                            <thead>
                            <tr role="heading">
                                <th width="230"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹ID</th>
                                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹状态</th>
                                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">下载面单</th>
                                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">fedex主单号</th>
                                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">fedex预估费用</th>
                                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">
                                    <select style='width:92px;margin:0;' name="package_request_status" id="sel_package_request_status" data-batches="<?php echo $this->_tpl_vars['re']['batches_id']; ?>
" >
                                        <option value="all">对接状态</option>
                                        <?php $_from = $this->_tpl_vars['re']['package_request_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value=<?php echo $this->_tpl_vars['key']; ?>
 ><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </th>
                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">投递状态</th>
                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">重量</th>
                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">长</th>
                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">高</th>
                                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">宽</th>
                            </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all" id="table_package_list">
                            <?php if (! empty ( $this->_tpl_vars['re']['package_info'] )): ?>
                            <tr>
                                <?php if (! $this->_tpl_vars['re']['package_info']['fedex_index']): ?>
                                <td>
                                    <a href="#"  data_id="<?php echo $this->_tpl_vars['re']['package_info']['id']; ?>
"  class="btn green mini index">获取主单</a>
                                </td>
                                    <?php elseif ($this->_tpl_vars['re']['package_info']['package_request_status'] == 4): ?>
                                <td>
                                    <button type="button" class="btn green mini" data_id="<?php echo $this->_tpl_vars['re']['package_info']['id']; ?>
"  id="fedex_confirm">包裹确认</button>
                                </td>
                                    <?php elseif ($this->_tpl_vars['re']['package_info']['package_request_status'] == 2 || $this->_tpl_vars['re']['package_info']['package_request_status'] == 5): ?>
                                <td>
                                    <a href="#"  class="btn red mini delete" data_id="<?php echo $this->_tpl_vars['re']['package_info']['id']; ?>
" batch_id="<?php echo $this->_tpl_vars['item']['batches_id']; ?>
">删除主单</a>
                                    <button type="button" class="btn green mini" data_id="<?php echo $this->_tpl_vars['re']['package_info']['id']; ?>
" id="fedex_validate">提交验证</button>
                                </td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                </td>
                                <td><?php echo $this->_tpl_vars['re']['package_info']['id']; ?>
</td>
                                <td>
                                    <?php if ($this->_tpl_vars['re']['package_info']['status'] == 1): ?>
                                    <span class="btn red mini">未确认</span>
                                    <?php elseif ($this->_tpl_vars['re']['package_info']['status'] == 2): ?>
                                    <span class="btn blue mini">已确认待审核</span>
                                    <?php elseif ($this->_tpl_vars['re']['package_info']['status'] == 3): ?>
                                    <span class="btn green mini">审核通过</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ($this->_tpl_vars['re']['package_info']['package_request_status'] == 6): ?>
                                    <a target="_blank" href="/fedex/<?php echo $this->_tpl_vars['re']['package_info']['fedex_index']; ?>
__shiplabel.pdf"">下载面单</a>
                                    <?php else: ?>
                                    暂无面单
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $this->_tpl_vars['re']['package_info']['fedex_index']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['re']['package_info']['estimated_rate']; ?>
</td>
                                <td>
                                    <?php $_from = $this->_tpl_vars['re']['package_request_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                    <?php if ($this->_tpl_vars['re']['package_info']['package_request_status'] == $this->_tpl_vars['k']): ?><?php echo $this->_tpl_vars['i']; ?>
<?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?>
                                </td>
                                <td></td>
                                <td><?php echo $this->_tpl_vars['re']['package_info']['fedex_weight']; ?>
<?php echo $this->_tpl_vars['re']['package_info']['fedex_weight_unit']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['re']['package_info']['fedex_length']; ?>
<?php echo $this->_tpl_vars['re']['package_info']['fedex_lwh_unit']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['re']['package_info']['fedex_height']; ?>
<?php echo $this->_tpl_vars['re']['package_info']['fedex_lwh_unit']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['re']['package_info']['fedex_width']; ?>
<?php echo $this->_tpl_vars['re']['package_info']['fedex_lwh_unit']; ?>
</td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td colspan="99">暂时无数据</td>
                            </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="row-fluid" style="margin-top:20px;">

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
    </div>
    <script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
    <script>

        function load_ini()
        {


            $('#table_package_list .index').click(function(){
                var id=$(this).attr('data_id');
                //location.href='<?php echo ((is_array($_tmp="package/get_fedex_index")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+id;
                $modal=$('#ajax-modal_1');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="package/get_fedex_index")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+id,function(msg){
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
                        alert(msg);
                        $('body').modalmanager('removeLoading');
                        setTimeout(function(){
                            $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function(){
                                $modal.modal();
                            });
                        }, 300);
                    };
                });

            });

            $('#fedex_validate').click(function(){
                var id =$(this).attr('data_id');
                //location.href='<?php echo ((is_array($_tmp="package/fedex_validate")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?index='+main_index+'&batch_num='+batch_num;
                $modal=$('#ajax-modal_1');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="package/fedex_validate")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+id,function(msg){
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
                        alert(msg);
                        $('body').modalmanager('removeLoading');
                        setTimeout(function(){
                            $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function(){
                                $modal.modal();
                            });
                        }, 300);
                    };
                });

            });


            $('#fedex_confirm').click(function(){
                var id = $(this).attr('data_id');
                $modal=$('#ajax-modal_1');
                //location.href='<?php echo ((is_array($_tmp="package/fedex_confirm")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?index='+main_index+'&batch_num='+batch_num;
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="package/fedex_confirm")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+id,function(msg){
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
                        alert(msg);
                        $('body').modalmanager('removeLoading');
                        setTimeout(function(){
                            $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function(){
                                $modal.modal();
                            });
                        }, 300);
                    };
                });

            });

            $('#table_package_list .delete').click(function(){
                var id=$(this).attr('data_id');
                $modal=$('#ajax-modal_1');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="package/fedex_delete")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+id,function(msg){
                    try
                    {
                        eval("var str="+msg);
                        //操作成功
                        if(str.type==1)
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
                        alert(msg);
                        $('body').modalmanager('removeLoading');
                        setTimeout(function(){
                            $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function(){
                                $modal.modal();
                            });
                        }, 300);
                    };
                });

            });

        }




    </script>