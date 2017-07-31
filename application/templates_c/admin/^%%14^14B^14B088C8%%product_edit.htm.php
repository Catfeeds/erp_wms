<?php /* Smarty version 2.6.20, created on 2017-03-24 15:51:17
         compiled from product_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_edit.htm', 311, false),)), $this); ?>
<div class="container-fluid">
<div class="row-fluid">
  <div class="span12">
    <div class="form"> 
      <!-- BEGIN FORM-->
      <form action="" id="form_logccom_add" class="form-horizontal" method="post" >
        <table class="table table-bordered table-hover dataTable">
                    <div id='alert-error_1' class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交失败</span> </div>
          <div id='alert-success_1' class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交成功</span> </div>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="4">供应商同步产品信息</th>
            </tr>
            <tr>
              <th width="120">供应对接编号</th>
              <td width="220"><?php echo $this->_tpl_vars['de']['sp_product']['out_product_id']; ?>
</td>
              <th width="120">供应商仓库号</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product']['out_warehouse_id']; ?>
</td>
            </tr>
            <tr>
              <th>产品名称</th>
              <td colspan="3"><?php echo $this->_tpl_vars['de']['sp_product']['name']; ?>
</td>
            </tr>
            <tr>
              <th>贸易类型</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product_content']['shop_type']; ?>
</td>
              <th>仓库地址</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product_content']['shop_addr']; ?>
</td>
            </tr>
            <tr>
              <th style="color:red;">同步库存</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product']['c_num']; ?>
</td>
              <th style="color:red;">已分配库存</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product']['online_num']; ?>
</td>
            </tr>
            <tr>
              <th style="color:red;">正在发货库存</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product']['send_num']; ?>
</td>
              <th>已发货</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product']['sell_num']; ?>
</td>
            </tr>
            <tr>
              <th>规格</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product_content']['gg']; ?>
</td>
              <th>购买上限</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product']['max_num']; ?>
</td>
            </tr>
            <tr>
              <th>供应拿货价</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product']['price']; ?>
</td>
              <th>供应商指导价</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product_content']['mark_price']; ?>
</td>
            </tr>
             <tr>
              <th>供应税率</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product']['kjt_rate']; ?>
</td>
              <th>供应提供毛重</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product_content']['mz']; ?>
</td>
            </tr>
            <tr>
              <th>产地</th>
              <td><?php echo $this->_tpl_vars['de']['sp_product_content']['country']; ?>
</td>
              <th>是否独立销售</th>
              <td><?php if ($this->_tpl_vars['de']['sp_product']['is_split'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
            </tr>
          
            <tr>
              <th>功能/用途</th>
              <td colspan="3"><?php echo $this->_tpl_vars['de']['sp_product_content']['gn']; ?>
</td>
            </tr>
            <tr>
              <th>成分</th>
              <td colspan="3"><?php echo $this->_tpl_vars['de']['sp_product_content']['cf']; ?>
</td>
            </tr>
          </thead>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="4">平台产品信息</th>
            </tr>
          </thead>
          <tr>
            <th>平台编号</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['id']; ?>
</td>
            <th>平台仓库号</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="warehouse_id" value="<?php echo $this->_tpl_vars['de']['stock']['warehouse_id']; ?>
"/></td>
          </tr>
          <tr>
            <th>产品名称</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="cname" value="<?php echo $this->_tpl_vars['de']['stock']['cname']; ?>
"/></td>
            <th>购买上限</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="max_num" value="<?php echo $this->_tpl_vars['de']['stock']['max_num']; ?>
"/></td>
          </tr>
          <tr>
            <th style="color:red;">平台定价</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="price" value="<?php echo $this->_tpl_vars['de']['stock']['price']; ?>
"/></td>
            <th>平台市场指导价</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="mark_price" value="<?php echo $this->_tpl_vars['de']['stock']['mark_price']; ?>
"/></td>
          </tr>
          <tr>
            <th style="color:red;">平台毛重</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="mz" value="<?php echo $this->_tpl_vars['de']['stock']['mz']; ?>
"/></td>
            <th>平台定税率</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="rate" value="<?php echo $this->_tpl_vars['de']['stock']['rate']; ?>
"/></td>
          </tr>
          <tr>
            <th>品牌</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="brand" value="<?php echo $this->_tpl_vars['de']['stock']['brand']; ?>
"/></td>
            <th>规格</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="gg" value="<?php echo $this->_tpl_vars['de']['stock']['gg']; ?>
"/></td>
          </tr>
          <tr>
            <th>产地</th>
            <td>
              <select size="1" id="form_2_select2"  name="country" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                <option value="all" selected="selected" >所有产地</option>
                <?php $_from = $this->_tpl_vars['res_country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                  <option <?php if ($this->_tpl_vars['de']['stock']['countryid'] == $this->_tpl_vars['item']['c_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['c_id']; ?>
">
                    <?php echo $this->_tpl_vars['item']['c_name']; ?>

                  </option>
                <?php endforeach; endif; unset($_from); ?>
              </select>
            </td>
            <th>商品类型</th>
            <td>
              <select size="1" id="form_2_select2"  name="cat_id" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                <option value="all" selected="selected" >所有类别</option>
                <?php $_from = $this->_tpl_vars['res_stock_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                  <option <?php if ($this->_tpl_vars['de']['stock']['cat_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
">
                    <?php echo $this->_tpl_vars['item']['cat']; ?>

                  </option>
                <?php endforeach; endif; unset($_from); ?>
              </select>
            </td>
          </tr>
          <tr>
            <th>是否独立销售</th>
            <td><?php if ($this->_tpl_vars['de']['stock']['is_split'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
            <th>是否是食品</th>
            <td><input type="text" class="m-wrap small" style="border:1px solid black;" name="type" value="<?php echo $this->_tpl_vars['de']['stock']['type']; ?>
"/></td>
          </tr>
          <tr>
            <th>功能/用途</th>
            <td colspan="3"><input type="text" class="m-wrap small" style="border:1px solid black;" name="gn" value="<?php echo $this->_tpl_vars['de']['stock']['gn']; ?>
"/></td>
          </tr>
          <tr>
            <th>成分</th>
            <td colspan="3"><input type="text" class="m-wrap small" style="border:1px solid black;" name="cf" value="<?php echo $this->_tpl_vars['de']['stock']['cf']; ?>
"/></td>
          </tr>
          <tr>
            <th>默认详情</th>
            <td colspan="3"><script>
                var server_auth="<?php echo $this->_tpl_vars['ueditor_auth']; ?>
";
              </script> 
              <script type="text/javascript" charset="utf-8" src="/lib/ueditor/ueditor.config.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
              <script type="text/javascript" charset="utf-8" src="/lib/ueditor/ueditor.all.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"> </script> 
              <script type="text/javascript" charset="utf-8" src="/lib/ueditor/lang/zh-cn/zh-cn.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
              <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败--> 
              <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
              <textarea id="editor" style="width:100%; height:200px" name="con"><?php echo $this->_tpl_vars['de']['stock']['con']; ?>
</textarea>
              <script>
                UE.getEditor('editor').setHeight(300);
              </script></td>
          </tr>
        </table>
        <div class="form-actions">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
          <button type="submit" id='submit_logccom_edit' class="btn red">修改</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

function load_ini()
{
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  
  var form1 = $('#form_logccom_add');
  form1.validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {
      cname: {
        required: true
      }
      ,
      country: {
        required: true
      }
      ,
      length: {
        required: true
      }
      ,
      width: {
        required: true
      }
      ,
      height: {
        required: true
      }
      ,
      brand: {
        required: true
      }
      ,
      catname: {
        required: true
      }
      ,
      con: {
        required: true
      }
    },
    messages : {
      cname:{
         required:'产品名称不能为空',
       }
      ,
      country: {
        required: '产地不能为空'
      }
      ,
      length: {
        required: '长度不能为空'
      }
      ,
      width: {
        required: '宽度不能为空'
      }
      ,
      height: {
        required: '高度不能为空'
      }
      ,
      brand: {
        required: '品牌不能为空'
      }
      ,
      catname: {
        required: '商品类型不能为空'
      }
      ,
      con: {
        required: '默认详情不能为空'
      }
    }
    ,
    invalidHandler: function (event, validator) { //display error alert on form submit              
       success1.hide();
        error1.find('span').html('请完善提交内容再提交');
        error1.show();
        App.scrollTo(error1, -200);
    },
  
    highlight: function (element) { // hightlight error inputs
      $(element)
        .closest('.help-inline').removeClass('ok'); // display OK icon
      $(element)
        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
    },
  
    unhighlight: function (element) { // revert the change dony by hightlight
      $(element)
        .closest('.control-group').removeClass('error'); // set error class to the control group
    },
  
    success: function (label) {
      label.addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
      .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
    },
    submitHandler: function (form) {
      /*
      $.post("?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&act_ajax=1",form1.serialize(),function(msg){
          success1.hide();
          if(msg==1)
          {
            success1.find('span').html('订阅成功');
            success1.show();  
          }
          else
          {
            error1.find('span').html(msg);
            error1.show();
          }
      });
      */
    }
  });
  
  $("#submit_logccom_edit").click(function(){
    if(form1.valid()==true)
    {
      //encodeURI(msg)
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="product/product_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $_GET['id']; ?>
',form1.serialize(),function(msg){
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
        }
        else if(str.type==3)
        {
        //刷新主页面
        f_main_index();
        return true;
        }
        setTimeout(function(){
        $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
        $modal.modal();
         });
        }, 300);
      }catch(e){ 
        $('body').modalmanager('removeLoading');
        success1.hide();
        error1.find('span').html('系统异常');
        error1.show();
        };
      });
    }
  });
 
}

</script>