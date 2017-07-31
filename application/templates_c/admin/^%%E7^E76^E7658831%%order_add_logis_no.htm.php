<?php /* Smarty version 2.6.20, created on 2017-05-19 09:47:54
         compiled from order_add_logis_no.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_add_logis_no.htm', 72, false),)), $this); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="form">
                <!-- BEGIN FORM-->
                <form action="" id="form_logis" class="form-horizontal" method="post" >
                    <table class="table table-bordered table-hover dataTable" id="table_1">
                                                <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span> </div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span> </div>
                        <thead>
                        <tr>
                            <th bgcolor="#E2EEFE" colspan="99">订单信息</th>
                        </tr>
                        </thead>
                        <tr>
                            <th width="250px">订单编号：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>
                            <th width="*">会员ID：<?php echo $this->_tpl_vars['re']['userid']; ?>
</th>
                        </tr>

                        <thead>
                        <tr>
                            <th bgcolor="#E2EEFE" colspan="99">添加运单号</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="row-fluid" style="margin-top: 10px">
                                    <label for="logistics_no" class="control-label">运单号</label>
                                    <div class="controls span3">
                                        <input type="text" name="logistics_no" value="<?php echo $this->_tpl_vars['re']['logistics_no']; ?>
" id="logistics_no">
                                    </div>
                                </div>
                                <div class="row-fluid" style="margin-top: 10px">
                                    <label for="logistics_type" class="control-label">运单类型</label>
                                    <div class="controls span3">
                                        <select  id="logistics_type" name="logistics_type" >
                                            <option value="">请选择类型</option>
                                            <?php $_from = $this->_tpl_vars['logistics_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option <?php if ($this->_tpl_vars['re']['logistics_type'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </div>

                                </div>
                            </td>

                        </tr>
                        </thead>
                        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
                    </table>
                    <div class="form-actions">
                        <button type="button" id='submit_order_eidt' class="btn red">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
    <script>


        $('#submit_order_eidt').bind('click',function(){

            $modal = $('#ajax-modal');
            $('body').modalmanager('loading');
            $.fn.modal.defaults.width='';
            $.fn.modal.defaults.height='';
            $.post('<?php echo ((is_array($_tmp="order/order_add_logis")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$('#form_logis').serialize(),function(msg){
                try
                {
                    eval("var str="+msg);
                    //操作成功
                    if(str.type==1)
                    {

                    }
                    else if(str.type==2)
                    {

                    }
                    else if(str.type==3)
                    {
                        //刷新主页面
                        window.location='';
                        //f_main_index();
                        return true;
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

    </script>