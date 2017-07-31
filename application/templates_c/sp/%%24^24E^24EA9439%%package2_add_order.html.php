<?php /* Smarty version 2.6.20, created on 2017-01-04 09:48:21
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/package2_add_order.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/sp/package2_add_order.html', 6, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">包裹【<?php echo $this->_tpl_vars['re']['id']; ?>
】<?php if ($this->_tpl_vars['re']['type'] == 'add'): ?>添加<?php elseif ($this->_tpl_vars['re']['type'] == 'list'): ?>查看<?php endif; ?>订单</h4>
</div>

<iframe src="<?php echo ((is_array($_tmp="package2/package_order_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?fedex_pakge_id=<?php echo $this->_tpl_vars['re']['id']; ?>
&type=<?php echo $this->_tpl_vars['re']['type']; ?>
" style="width:100%; height:500px; border:none;" > </iframe>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script>



</script>