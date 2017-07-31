<?php /* Smarty version 2.6.20, created on 2016-12-30 10:17:42
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/sp_msg.htm */ ?>
<div class="modal-header" style="height:30px; background:#000;">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
  <h4 style="color:#fff; margin-top:5px;">消息提示</h4>
</div>
<div class="modal-body">
  <div class="tabbable tabbable-custom">
    <div class="tab-content">
          <?php if ($_GET['msg']): ?><?php echo $_GET['msg']; ?>
<?php else: ?>操作成功<?php endif; ?>
     
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>