<?php /* Smarty version 2.6.20, created on 2017-05-11 16:17:01
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/recoder_status.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'explode', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/recoder_status.htm', 17, false),array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/recoder_status.htm', 50, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">
        预计备案完成时间
    </h4>
</div>
<div class="modal-body">
    <div class="tabbable tabbable-custom">
        <div class="tab-content">
            <div class="container-fluid">
                <!-- BEGIN PAGE CONTENT-->
                    <!-- BEGIN FORM-->
                    <div class="row-fluid">
                        <form action="" id='form_recoder' method="post">
                                <div class="control-group">
                                            <?php $_from = $this->_tpl_vars['re']['recoder_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <?php $this->assign('a', ((is_array($_tmp=($this->_tpl_vars['item']))) ? $this->_run_mod_handler('explode', true, $_tmp, "|") : smarty_modifier_explode($_tmp, "|"))); ?>

                                             <label class="radio" >
                                                 <input type="radio" name="recoder_status" value="<?php echo $this->_tpl_vars['key']; ?>
|<?php echo $this->_tpl_vars['a'][0]; ?>
">
                                                 <?php echo $this->_tpl_vars['a'][1]; ?>

                                             </label>


                                            <?php endforeach; endif; unset($_from); ?>
                                </div>
                        </form>
                        </div>
                    </div>
                    <!-- END FORM-->
                </div>
                <!-- END PAGE CONTENT-->
            </div>

        </div>

<div class="modal-footer">
    <button type="button" data-dismiss="modal" id="sub_re" class="btn green" >提交</button>
    <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>
<script>
    $('#sub_re').click(function(){
        var $modal = $('#ajax-modal');
        $('body').modalmanager('loading');
        $.fn.modal.defaults.width='';
        $.fn.modal.defaults.height='';
        var recorder_status= $('#form_recoder').serialize();
        var product = $('#form_product_list').serialize();
        var c = recorder_status+'&'+product;
        $.post("<?php echo ((is_array($_tmp='product/product_checkbox')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?type=1", c ,function(msg){
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
                    //location.reload();
                }
				
			   setTimeout(function(){
				modal_msg(str.msg);
			   }, 300);
				/*
                setTimeout(function(){
                    $modal.load('<?php echo ((is_array($_tmp="sp_index/sp_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function()
                    {
                        $modal.modal();
                    });
                }, 1000);
				*/
            }
            catch(e)
            {
                $('body').modalmanager('removeLoading');
				
				setTimeout(function(){
					modal_msg('系统异常');
			    }, 300);
				/*
                setTimeout(function(){
                    $modal.load('<?php echo ((is_array($_tmp="sp_index/sp_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function()
                    {
                        $modal.modal();
                    });
                },1000);
				*/
            };
        });
    })

</script>
