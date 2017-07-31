<?php /* Smarty version 2.6.20, created on 2016-12-12 10:49:59
         compiled from msg_url.htm */ ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12">
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a href="#">管理员后台</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">消息提示</a> </li>
      </ul>
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><i class="icon-reorder"></i>消息提示</div>
        </div>
        <div class="portlet-body" style="height:400px;"> 
          <!-- BEGIN FORM-->
          <table class="table" style="width:400px;">
            <tbody>
              <tr>
                <td colspan="2" style="font-size:12px;" ><p><?php echo $this->_tpl_vars['act_msg']; ?>
</p>
                  <p>................................</p></td>
              </tr>
            <?php $_from = $this->_tpl_vars['act_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['url'] => $this->_tpl_vars['v']):
?>
            <tr>
              <td width="20" ><i class="icon-bookmark"></i></td>
              <td><a  href='<?php echo $this->_tpl_vars['url']; ?>
'><?php echo $this->_tpl_vars['v']; ?>
</a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            </tbody>
            
          </table>
          <!-- END FORM--> 
        </div>
      </div>
      <!-- END VALIDATION STATES--> 
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
  
</div>
<script>
function load_ini()
{
	 
}

</script> 