<?php /* Smarty version 2.6.20, created on 2017-04-12 15:54:04
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/package2_batches_date.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/package2_batches_date.htm', 6, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">批量投递包裹</h4>
</div>
<div class="modal-body" >
    <iframe src="<?php echo ((is_array($_tmp="package2/package_batches_date1")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?data=<?php echo $this->_tpl_vars['data']; ?>
" style="width:100%; height:500px; border:none;" > </iframe>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">关闭</button>
</div>

<script>
    function closeW()
    {
        window.closeWin();
    }
</script>