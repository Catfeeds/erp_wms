<?php /* Smarty version 2.6.20, created on 2017-06-02 11:09:20
         compiled from order_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_list.htm', 152, false),array('modifier', 'f_get_status', 'order_list.htm', 220, false),array('modifier', 'get_img_auth', 'order_list.htm', 265, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>订单管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">订单列表</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">订单列表</a></li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><i class="icon-search"></i>订单列表搜素</div>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <form action="" method="get" onsubmit="return load_sub();">     
              <div class="row-fluid">             
                <span class="span1" style="display:block;">
                <div id="span_label">每页显示</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示</option>
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?>  value="1">15</option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?>  value="2">30</option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?>  value="3">50</option>
                  </select>
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label" style="margin-right:8px;">导入单号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input class="m-wrap small" type="text" name="search_import_id" value="<?php echo $_GET['search_import_id']; ?>
"> 
                </div>     
              </div>      
              
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">订单状态</div> 
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected = "selected"<?php endif; ?> value="1">待审核</option>
                    <option <?php if ($_GET['search_status'] == '2'): ?>selected = "selected"<?php endif; ?> value="2">已审核</option>
                    <option <?php if ($_GET['search_status'] == '3'): ?>selected = "selected"<?php endif; ?> value="3">待发货</option>
                    <option <?php if ($_GET['search_status'] == '4'): ?>selected = "selected"<?php endif; ?> value="4">已发货</option>
                    <option <?php if ($_GET['search_status'] == '5'): ?>selected = "selected"<?php endif; ?> value="5">国内已通关</option>
                    <option <?php if ($_GET['search_status'] == '-1'): ?>selected = "selected"<?php endif; ?> value="-1">订单取消</option>
                    <option <?php if ($_GET['search_status'] == '-2'): ?>selected = "selected"<?php endif; ?> value="-2">通关失败</option>
                  </select>
                </div> 

                <span class="span1" style="display:block;">
                <div id="span_label" style="margin-right:8px;">订单编号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input class="m-wrap small" type="text" name="search_id" value="<?php echo $_GET['search_id']; ?>
"> 
                </div>  
              </div> 

              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">证件状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_card_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>                   
                    <option <?php if ($_GET['search_card_status'] == '1'): ?>selected = "selected"<?php endif; ?> value = "1">未上传</option>
                    <option <?php if ($_GET['search_card_status'] == '2'): ?>selected = "selected"<?php endif; ?> value = "2">已上传</option> 
                    <option <?php if ($_GET['search_card_status'] == '3'): ?>selected = "selected"<?php endif; ?> value = "3">已审核</option>                                  
                  </select>
                </div> 

                <span class="span1" style="display:block;">
                <div id="span_label" style="margin-right:8px;">批次编号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input class="m-wrap small" type="text" name="search_batches_id" value="<?php echo $_GET['search_batches_id']; ?>
"> 
                </div>  
              </div> 
              
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label" style="margin-right:8px;">会员ID</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="input-append">
                    <input class="m-wrap small" type="text" name="search_userid" value="<?php echo $_GET['search_userid']; ?>
"> 
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>
              </div>            
            </form>
           </div>
        </div>
      </div>
      <div id='product_all'>
        <form action="" id='form_order_list' method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
            <thead>
              <tr role="heading">
                <th width="20"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/></th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单编号</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">会员ID</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">包裹状态</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单状态</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">证件状态</th> 
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">总价格</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">总税款</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">总重量</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国内总运费</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国外预估运费</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国外成本运费</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国外实收运费</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">国外运费币种</th>
                <th width="90" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批次编号</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人姓名</th>
                <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">身份证号</th>
                <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">省</th>
                <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">市</th>
                <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">区</th>
                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人地址</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人手机</th>           
                <th width="130" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">下单时间</th>
                <th width="130" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发货时间</th>
                <th width="130"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单号</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单类型</th>
                <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">导入订单号</th>
                <th style='display:none;' class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"></th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']['list']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
                <tr>
                  <td><input type="checkbox" name="<?php echo $this->_tpl_vars['item']['id']; ?>
" value="<?php echo $this->_tpl_vars['item']['batches_id']; ?>
" class="list-checkable" /></td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] != -1): ?>
                      <a href="#" onclick="alertWin('编辑订单',800,400,'<?php echo ((is_array($_tmp="order/order_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a>
                    <?php else: ?>
                      <a href="#" class="btn black mini"><i class="icon-edit"></i> 编辑</a>
                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
 <span style="margin-left:5px;" class="row-details row-details-close"></span></td>                  
                  <td><?php echo $this->_tpl_vars['item']['userid']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['package_status'] == 0): ?>
                      <span class="btn red mini">未确认</span>
                    <?php elseif ($this->_tpl_vars['item']['package_status'] == 1): ?>
                      <span class="btn blue mini">已确认</span>
                    <?php endif; ?>
                  </td>   
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <span class="btn blue mini">待审核</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                      <span class="btn yellow mini">已审核</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 3): ?>
                      <span class="btn blue mini">待发货</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 4): ?>
                      <span class="btn yellow mini">已发货</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 5): ?>
                      <span class="btn green mini">国内已通关</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == -1): ?>
                      <span class="btn black mini">订单取消</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == -2): ?>
                      <span class="btn black mini">通关失败</span>
                    <?php endif; ?>
                  </td>
                  <td>              
                    <?php if ($this->_tpl_vars['item']['card_status'] == 1): ?>
                      <span class="btn red mini">未上传</span>
                    <?php elseif ($this->_tpl_vars['item']['card_status'] == 2): ?>
                      <span class="btn blue mini">已上传</span>
                    <?php elseif ($this->_tpl_vars['item']['card_status'] == 3): ?>
                      <span class="btn green mini">已审核</span>
                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['total_price']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['total_rate']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['total_weight']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['total_freight']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['assign_fee']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['assign_cost_fee']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['assign_actual_fee']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['abroad_currency']; ?>
</td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['batches_id'] == '-1'): ?>
                      暂无添加批次
                    <?php else: ?>
                      <?php echo $this->_tpl_vars['item']['batches_id']; ?>

                      <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                        <a href="#" id="btn_batches" style="float:right;" class="btn red mini" data-import-id="<?php echo $this->_tpl_vars['item']['import_id']; ?>
" data-batches-id="<?php echo $this->_tpl_vars['item']['batches_id']; ?>
" data-total-rate="<?php echo $this->_tpl_vars['item']['total_rate']; ?>
" data-total-freight="<?php echo $this->_tpl_vars['item']['total_freight']; ?>
" data-total-freight-abroad="<?php echo $this->_tpl_vars['item']['total_freight_abroad']; ?>
" order-status="<?php echo $this->_tpl_vars['item']['status']; ?>
" ><i class="icon-remove"></i> 取消</a>
                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['consignee']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['card_no']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['province']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['city']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['area']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['consignee_address']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['consignee_mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['add_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['send_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['logistics_no']; ?>
</td>
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['logistics_type'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'order_logistics_type') : f_get_status($_tmp, 'order_logistics_type')); ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['import_id']; ?>
</td>
                  <td style='display:none;'>   
                    <table class="table table-striped table-hover table-bordered dataTable">
                      <thead>
                        <tr>
                          <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品编号</th>
                          <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th>
                          <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">导入名称</th>
                          <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">是否备案</th>
                          <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件价格</th>
                          <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件税价</th>
                          <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件重量</th> 
                          <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">数量</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $_from = $this->_tpl_vars['re']['list'][$this->_tpl_vars['k']]['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item_list']):
?>
                          <tr>
                            <td><?php echo $this->_tpl_vars['item_list']['stock_id']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['name']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['im_name']; ?>
</td>
                            <td>
                              <?php if ($this->_tpl_vars['item_list']['is_filing'] == -1): ?>
                                <span class="btn blue mini">待选择</span>
                              <?php elseif ($this->_tpl_vars['item_list']['is_filing'] == 1): ?>
                                <span class="btn green mini">已备案</span>
                              <?php elseif ($this->_tpl_vars['item_list']['is_filing'] == 2): ?>
                                <span class="btn red mini">未备案</span>
                              <?php endif; ?>
                            </td>
                            <td><?php echo $this->_tpl_vars['item_list']['price']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['rate']; ?>
</td> 
                            <td><?php echo $this->_tpl_vars['item_list']['weight']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['item_list']['num']; ?>
</td>
                          </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php if ($this->_tpl_vars['item']['tax_type'] == 1): ?>
                        	<tr>
                              <th colspan="2">身份证正面</th>
                              <th colspan="2">身份证反面</th>
                              <th colspan="99">商品小票</th>
                            </tr>
                            <tr>
                              <td colspan="2"> 
                                  <img width='100px'  src='<?php echo ((is_array($_tmp='card_1')) ? $this->_run_mod_handler('get_img_auth', true, $_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid']) : get_img_auth($_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid'])); ?>
' />
                              </td>
                              <td colspan="2">
                                  <img width='100px'  src='<?php echo ((is_array($_tmp='card_2')) ? $this->_run_mod_handler('get_img_auth', true, $_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid']) : get_img_auth($_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid'])); ?>
' />
                              </td>
                              <td colspan="99">
                                  <img width='100px' src="<?php echo ((is_array($_tmp='xiaopian')) ? $this->_run_mod_handler('get_img_auth', true, $_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid']) : get_img_auth($_tmp, $this->_tpl_vars['item']['id'], $this->_tpl_vars['item']['userid'])); ?>
" />
                              </td>
                            </tr> 
                        <?php endif; ?>
                      </tbody>
                    </table>
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
          <div class="row-fluid">
                        <div id='alert-error_1' class="alert alert-error hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交失败</span> 
            </div>
            <div id='alert-success_1' class="alert alert-success hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交成功</span> 
            </div>
            
            <div class="input-append">
            <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
            </div>
            <div class="input-append"> 
              <span class="span3" style="display:block;">
              <div id="span_label">批次名称:</div> 
              </span>
              <?php if (empty ( $_GET['search_userid'] )): ?>
                <input class="m-wrap small" type="text" value="请先输入会员ID" readonly="readonly">   
              <?php else: ?>
                <select name="add_batches" class="m-wrap span9">
                  <option value="choose" selected="selected" >请选择批次</option>
                  <?php $_from = $this->_tpl_vars['re']['batches_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                    <option value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['batches_name']; ?>
（ID：<?php echo $this->_tpl_vars['item']['id']; ?>
）</option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              <?php endif; ?>
              <button type="button" data-type="1" class="btn green df_submit">加入批次</button>
            </div> 
            <div class="clear"></div>
            <div class="span6">
              <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
            </div>
          </div>
        </form>
      </div>
      <!--show window--> 
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script> 
<link rel="stylesheet" type="text/css" href="/static/css/datepicker.css">
<script type="text/javascript" src="/static/js/bootstrap-datepicker.js"></script> 
<script>

function load_ini()
{
  bind_window();
  /* <?php if ($this->_tpl_vars['re']['list']): ?> */
  initTable1();
  /* <?php endif; ?> */
  checkchange();

  cancel_batches();
  
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

$('.form_2_select2').select2({
  placeholder: "请选择",
  allowClear: true
});

/* 点击批次编号中的取消 */
var cancel_batches = function()
{ 
  $("#btn_batches").click(function()
  { 
    var import_id            = $(this).attr('data-import-id');
    var batches_id           = $(this).attr('data-batches-id');
    var total_rate           = $(this).attr('data-total-rate'); 
    var total_freight        = $(this).attr('data-total-freight'); 
    var total_freight_abroad = $(this).attr('data-total-freight-abroad'); 
    var status               = $(this).attr('order-status'); 
    $.post('<?php echo ((is_array($_tmp='order/order_cancel_batches')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',
    { 
      import_id:import_id,
      batches_id:batches_id,
      total_rate:total_rate,
      total_freight:total_freight,
      total_freight_abroad:total_freight_abroad,
      status:status
    },
    function(msg)
    {
      location.reload();
    });
  });

}

var bind_window=function()
{
	 App.initFancybox();
	$.fn.modalmanager.defaults.resize = true;
	$.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
	var $modal = $('#ajax-modal');
	$('.logis_no').each(function(index, element) {
		  var  id=$(this).attr('data-id');
          var size = $(this).attr('data-box-size').split('|');
          var url  = $(this).attr('data-url');
		  $(this).on('click', function(){
			  // create the backdrop and wait for next modal to be triggered
			  $('body').modalmanager('loading');
				setTimeout(function(){
                  $.fn.modal.defaults.width  = size[0]+'px';
                  $.fn.modal.defaults.height = size[1]+'px';
				 $modal.load(
                         url,
                         {},
                         function(){
					$modal.modal();
					//$modal.css('margin-top','0');
				 });
				}, 100);
		});
	});
}

var initTable1 = function() 
{        
  /*
   * Insert a 'details' column to the table
   */     
	var oTable = $('#table_1').dataTable( {
    "aoColumnDefs": [
      {"bSortable": false, "aTargets": [ 0 ] }
    ],
    "aaSorting": [[1, 'asc']],
    "aLengthMenu": [
       [5, 15, 20, -1],
        [5, 15, 20, "All"] // change per page values here
    ],
    "oLanguage": {
			"sProcessing": "正在加载中......",
			"sLengthMenu": "每页显示 _MENU_ 条记录",
			"sZeroRecords": "正在加载中......",
			"sEmptyTable": "查询无数据！",
			"sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
			"sInfoEmpty": "显示0到0条记录",
			"sInfoFiltered": "数据表中共为 _MAX_ 条记录",
			"sSearch": "当前页数据搜索",
			"oPaginate": {
			 "sFirst": "首页",
			 "sPrevious": "上一页",
			 "sNext": "下一页",
			 "sLast": "末页"
			}
		},
		"bSort":false,
		"bInfo":false,
		"bPaginate":false,
		"bAutoWidth":true ,
		"bStateSave":false,
		"sScrollX":'2500px',
		//"sScrollY":"300px",
    // set the initial value
    "iDisplayLength": 10,
		//'sScrollXInner':true,
		//"bSortCellsTop":true,
  }); 

  /* Formating function for row details */
  function fnFormatDetails ( oTable, nTr )
  {
    var aData = oTable.fnGetData( nTr );
    var sOut = aData[28];
    alert(sOut);
    return sOut;
  }

  $('#table_1').on('click', ' tbody td .row-details', function () 
  {
    var nTr = $(this).parents('tr')[0];
    if ( oTable.fnIsOpen(nTr) )
    {
      /* This row is already open - close it */
      $(this).addClass("row-details-close").removeClass("row-details-open");
      oTable.fnClose( nTr );
    }
    else
    {
      /* Open this row */                
      $(this).addClass("row-details-open").removeClass("row-details-close");
      oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
    }
  });  

}

var checkchange = function()
{
  $('.df_submit').bind('click',function()
  {
    $modal=$('#ajax-modal');
    $('body').modalmanager('loading');
    $.fn.modal.defaults.width='';
    $.fn.modal.defaults.height='';
    var error1 = $('#alert-error_1'); 
    var success1 = $('#alert-success_1');
    var type = $(this).attr('data-type');
    $.post('<?php echo ((is_array($_tmp='order/order_add_batches')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?type='+type,$('#form_order_list').serialize(),function(msg){
      try
      {
        eval("var str="+msg);
        if(str.type==1)
        {
          //错误提示
          error1.show();
          success1.hide();
          error1.find('span').html(str.msg);
        }
        else if(str.type==2)
        {

        }
        else if(str.type==3)
        {
          //刷新主页面
          f_main_index();
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
};

</script> 