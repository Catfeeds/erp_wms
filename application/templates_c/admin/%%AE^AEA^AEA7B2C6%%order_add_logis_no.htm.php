<?php /* Smarty version 2.6.20, created on 2017-05-09 14:23:49
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/admin/order_add_logis_no.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/admin/order_add_logis_no.htm', 61, false),)), $this); ?>

<div class="modal-header" style="height:30px; background:#000;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">
       订单添加国内运单
    </h4>
</div>
<div class="modal-body">
    <div class="tabbable tabbable-custom">
        <div class="tab-content">
            <div class="container-fluid">
                <!-- BEGIN PAGE CONTENT-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action=""  class="form-horizontal" method="post"  id='form_logis'>
                        <div class="row-fluid">
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

                            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
">
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
                <!-- END PAGE CONTENT-->
            </div>

        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn green df_submit">提交</button>
    <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>

<script>

    $('.df_submit').bind('click',function(){

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
                setTimeout(function(){
                    $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function()
                    {
                        $modal.modal();
                    });
                }, 300);
            }
            catch(e)
            {

                $('body').modalmanager('removeLoading');
                alert(msg);
                setTimeout(function(){
                    $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function()
                    {
                        $modal.modal();
                    });
                }, 300);
            };
        });
    });




</script>
