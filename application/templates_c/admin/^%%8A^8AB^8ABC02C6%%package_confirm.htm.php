<?php /* Smarty version 2.6.20, created on 2016-12-21 14:15:00
         compiled from package_confirm.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package_confirm.htm', 165, false),)), $this); ?>
<div class="container-fluid">
<div class="row-fluid">
  <div class="span12">
    <div class="form"> 
      <!-- BEGIN FORM-->
        <table class="table table-bordered table-hover dataTable" id="table_1">
                    <div id='alert-error_1' class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交失败</span>
          </div>
          <div id='alert-success_1' class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交成功</span>
          </div>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">批次【<?php echo $this->_tpl_vars['re']['batches_id']; ?>
】订单信息</th>
            </tr>
          </thead>
          <tr>
            <th width="250px">订单总数：<?php echo $this->_tpl_vars['re']['order_num']; ?>
</th>
            <th width="250px">未加入包裹数量：<?php echo $this->_tpl_vars['re']['not_add_package_num']; ?>
</th>
            <th>已加入包裹数量：<?php echo $this->_tpl_vars['re']['add_package_num']; ?>
</th>
          </tr>
    
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
                <th width="20"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">
                  <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/>
                </th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>  
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹ID</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹状态</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">下载面单</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">fedex主单号</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">fedex分单号</th>
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
            <?php if ($this->_tpl_vars['re']['package_list']): ?>
              <?php $_from = $this->_tpl_vars['re']['package_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <?php if (! $this->_tpl_vars['item']['fedex_index']): ?>
                  <td>
                     <input type="checkbox" name="<?php echo $this->_tpl_vars['item']['id']; ?>
" value="<?php echo $this->_tpl_vars['item']['batches_id']; ?>
" class="list-checkable" /></td>
                  <td>

                    <a href="#"  data_id="<?php echo $this->_tpl_vars['item']['id']; ?>
"  class="btn green mini index">获取主单</a>
                    <?php else: ?>
                    <td></td>
                    <td>
                      <a href="#"  class="btn red mini delete" data_id="<?php echo $this->_tpl_vars['item']['id']; ?>
" batch_id="<?php echo $this->_tpl_vars['item']['batches_id']; ?>
">删除主单</a>
                    </td>

                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>                              
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <span class="btn red mini">未确认</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                      <span class="btn blue mini">已确认待审核</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 3): ?>
                      <span class="btn green mini">审核通过</span>
                    <?php endif; ?>
                  </td>

                  <td>
                    <?php if ($this->_tpl_vars['item']['package_request_status'] == 6): ?>
                       <a target="_blank" href="/fedex/<?php echo $this->_tpl_vars['item']['fedex_index']; ?>
__shiplabel.pdf"">下载面单</a>
                    <?php else: ?>
                     暂无面单
                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_index']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_index_sqnumber']; ?>
</td>
                  <td>
                    <?php $_from = $this->_tpl_vars['re']['package_request_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                      <?php if ($this->_tpl_vars['item']['package_request_status'] == $this->_tpl_vars['k']): ?><?php echo $this->_tpl_vars['i']; ?>
<?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                  </td>
                  <td></td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_weight']; ?>
<?php echo $this->_tpl_vars['item']['fedex_weight_unit']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_length']; ?>
<?php echo $this->_tpl_vars['item']['fedex_lwh_unit']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_height']; ?>
<?php echo $this->_tpl_vars['item']['fedex_lwh_unit']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['fedex_width']; ?>
<?php echo $this->_tpl_vars['item']['fedex_lwh_unit']; ?>
</td>        
                </tr>
              <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
              <tr>
                <td colspan="99">暂时无数据</td>
              </tr>
            <?php endif; ?>
            </tbody>
          </table>
          <div class="row-fluid" style="margin-top:20px;">
            <div class="input-append">
              <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
            </div>
            <div class="input-append">
              <select name="main_index" id="main_index" class="input-medium"  data_batch_num="<?php echo $this->_tpl_vars['item']['batches_id']; ?>
" >
                <option value="">请选择主单包裹</option>
                <?php $_from = $this->_tpl_vars['re']['package_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <?php if ($this->_tpl_vars['item']['fedex_index'] != 0): ?>
                <option value="<?php echo $this->_tpl_vars['item']['fedex_index']; ?>
"><?php echo $this->_tpl_vars['item']['fedex_index']; ?>
</option>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
              </select>
            </div>
            <div class="input-append">
              <!--<button type="button" class="btn green mini">获取分单</button>-->
            </div>
            <div class="input-append" style="margin-left:10px;">
              <button type="button" class="btn green mini" id="fedex_validate">提交验证</button>
            </div>
            <div class="input-append" style="margin-left:10px;">
              <button type="button" class="btn green mini" id="fedex_confirm">包裹确认</button>
            </div>
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

  modify_states();

  sel_change_search();
  var error1=$('#alert-error_1');
  var success1=$('#alert-success_1');
  $('#table_package_list .index').click(function(){
      var id=$(this).attr('data_id');
     //location.href='<?php echo ((is_array($_tmp="package/get_fedex_index")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+id;
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
            error1.show();
            success1.hide();
            error1.find('span').html(str.msg);
          }
          else if(str.type==2)
          {
            //错误提示
            $('body').modalmanager('removeLoading');
            error1.show();
            success1.hide();
            error1.find('span').html(str.msg);
          }
          else if(str.type==3)
          {
            //刷新主页面
            window.location='';
            return true;
          }

          setTimeout(function(){
            $modal.load('<?php echo ((is_array($_tmp="seller/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
              $modal.modal();
            });
          }, 300);
        }catch(e){
          alert(msg);
          $('body').modalmanager('removeLoading');
          success1.hide();
          error1.find('span').html('系统异常');
          error1.show();
        };
      });

  });

  $('#fedex_validate').click(function(){
    var main_index =$('#main_index').val();
    var batch_num =$('#main_index').attr('data_batch_num');
    //location.href='<?php echo ((is_array($_tmp="package/fedex_validate")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?index='+main_index+'&batch_num='+batch_num;
    $('body').modalmanager('loading');
    $.post('<?php echo ((is_array($_tmp="package/fedex_validate")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?index='+main_index+'&batch_num='+batch_num,function(msg){
      try
      {
        eval("var str="+msg);
        //操作成功
        if(str.type==1)
        {
          //错误提示
          $('body').modalmanager('removeLoading');
          error1.show();
          success1.hide();
          error1.find('span').html(str.msg);
        }
        else if(str.type==2)
        {
          //错误提示
          $('body').modalmanager('removeLoading');
          error1.show();
          success1.hide();
          error1.find('span').html(str.msg);
        }
        else if(str.type==3)
        {
          //刷新主页面
          window.location='';
          return true;
        }

        setTimeout(function(){
          $modal.load('<?php echo ((is_array($_tmp="seller/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
            $modal.modal();
          });
        }, 300);
      }catch(e){
        alert(msg);
        $('body').modalmanager('removeLoading');
        success1.hide();
        error1.find('span').html('系统异常');
        error1.show();
      };
    });

  });


  $('#fedex_confirm').click(function(){
    var main_index =$('#main_index').val();
    var batch_num =$('#main_index').attr('data_batch_num');
    //location.href='<?php echo ((is_array($_tmp="package/fedex_confirm")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?index='+main_index+'&batch_num='+batch_num;
    $('body').modalmanager('loading');
    $.post('<?php echo ((is_array($_tmp="package/fedex_confirm")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?index='+main_index+'&batch_num='+batch_num,function(msg){
      try
      {
        eval("var str="+msg);
        //操作成功
        if(str.type==1)
        {
          //错误提示
          $('body').modalmanager('removeLoading');
          error1.show();
          success1.hide();
          error1.find('span').html(str.msg);
        }
        else if(str.type==2)
        {
          //错误提示
          $('body').modalmanager('removeLoading');
          error1.show();
          success1.hide();
          error1.find('span').html(str.msg);
        }
        else if(str.type==3)
        {
          //刷新主页面
          window.location='';
          return true;
        }

        setTimeout(function(){
          $modal.load('<?php echo ((is_array($_tmp="seller/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
            $modal.modal();
          });
        }, 300);
      }catch(e){
        alert(msg);
        $('body').modalmanager('removeLoading');
        success1.hide();
        error1.find('span').html('系统异常');
        error1.show();
      };
    });

  });

  $('#table_package_list .delete').click(function(){
    var id=$(this).attr('data_id');
    var batch_id = $(this).attr('batch_id');
    //location.href='<?php echo ((is_array($_tmp="package/fedex_delete")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+id+'&batch_id='+batch_id;
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
          error1.show();
          success1.hide();
          error1.find('span').html(str.msg);
        }

        else if(str.type==3)
        {
          //刷新主页面
          window.location='';
          return true;
        }

        setTimeout(function(){
          $modal.load('<?php echo ((is_array($_tmp="seller/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
            $modal.modal();
          });
        }, 300);
      }catch(e){
        alert(msg);
        $('body').modalmanager('removeLoading');
        success1.hide();
        error1.find('span').html('系统异常');
        error1.show();
      };
    });

  });


  jQuery('.group-checkable').change(function () {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
      if (checked) {
        $(this).attr("checked", true);
      } else {
        $(this).attr("checked", false);
      }
    });
    jQuery.uniform.update(set);
  });

}

var modify_states = function()
{  
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  var form1 = $('#form_batches_eidt');
  $("#submit_batches_eidt").click(function(){
    if(form1.valid()==true)
    {
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="batches/batches_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg)
      {
        try
        {
          eval("var str="+msg);
          //操作成功
          if(str.type==1)
          {
            //错误提示
            error1.show();
            success1.hide();
            error1.find('span').html(str.msg);
          }
          else if(str.type==2)
          {
            //提交成功
            error1.hide();
            success1.show();
            success1.find('span').html('提交成功');
            location.reload();
          }
          else if(str.type==3)
          {
            //刷新主页面
            f_main_index();
            return true;
          }
          setTimeout(function()
          {
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
          success1.hide();
          error1.find('span').html('系统异常');
          error1.show();
        };
      });
    }
  }); 
}

var sel_change_search = function()
{

}
</script>