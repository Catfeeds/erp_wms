<?php /* Smarty version 2.6.20, created on 2017-05-12 14:34:49
         compiled from order_upload_code.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_upload_code.htm', 212, false),)), $this); ?>
<div class="container-fluid" style="overflow-y: auto; HEIGHT: 100%" >
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">订单管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">扫码生成订单</a></li>
      </ul>
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid" >
      <div class="span12" >
          <div class="portlet box blue">
              <div class="portlet-title">
                  <div class="caption"><i class="icon-search"></i>扫码生成订单</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
              </div>
              <div class="portlet-body" style="display: block;">
                  <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                      <form action="" method="get"  id="form_barcode">
                          <div class="row-fluid">
                                      <span class="span1" style="display:block;">
                                            <div id="span_label">扫码枪扫码</div>
                                      </span>
                                      <div class="span3" style="margin-left:0px;">
                                          <textarea name="barcode" id="bcode"></textarea>
                                          <button class="btn green" id="df_submit" type="button">Search</button>
                                      </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="row-fluid portlet-body form" style="">
              <form action="" id="product_all" method="post" class="form-horizontal">

                  <table class="table table-striped table-bordered table-hover " id="product_1"  >
                      <thead>
                      <th width="20" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">
                          <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set="#product_all .list-checkable"/>
                      </th>
                      <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                      <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案编号</th>
                      <th width="*" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th>
                      <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">英文名称</th>
                      <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">购买数量</th>
                      <th width="90" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">当地申报价</th>
                      <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">币种</th>
                      <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">毛重</th>
                      <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">重量单位</th>
                      </thead>
                      <tbody role="alert" aria-live="polite" aria-relevant="all" id="tb"></tbody>
                  </table>
                  <div style="height: 500px;">
                      <table id="order_input"  class="table  table-bordered table-hover" style="height: 800px;" >
                          <thead>
                          <th colspan="5" style="background:  #668bff;color: white">生成订单</th>
                          </thead>
                          <tr>
                              <td colspan="99" style="background: white;">
                                  <div class="control-group">
                                      <label class="control-label">批次信息<span class="required">*</span></label>
                                      <div class="controls">
                                          <select name="batches" id="fedex_type">
                                              <option value=''>请选择</option>
                                              <?php $_from = $this->_tpl_vars['batches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                              <option value="<?php echo $this->_tpl_vars['item']['id']; ?>
">批次号(<?php echo $this->_tpl_vars['item']['id']; ?>
)<?php echo $this->_tpl_vars['item']['batches_name']; ?>
</option>
                                              <?php endforeach; endif; unset($_from); ?>

                                          </select>
                                          <button type="button" id="new_batches" class="btn red mini" >生成新批次</button>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label">FedEx重量单位<span class="required">*</span></label>
                                      <div class="controls">
                                          <select name="abroad_weight_unit" >
                                              <option value=''>请选择</option>
                                              <option value="KG">千克</option>
                                              <option value="LB">磅</option>

                                          </select>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label">收货姓名<span class="required">*</span></label>
                                      <div class="controls">
                                          <input type="text" name="consignee"   class="span4 m-wrap">
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label">收货电话<span class="required">*</span></label>
                                      <div class="controls">
                                          <input type="text" name="consignee_mobile"   class="span4 m-wrap">
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label">身份证号<span class="required">*</span></label>
                                      <div class="controls">
                                          <input type="text" name="card_no"   class="span4 m-wrap">
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label">省<span class="required">*</span></label>
                                      <div class="controls">
                                          <input type="text" name="province"  value="<?php echo $this->_tpl_vars['re']['address']['consignee_address']; ?>
" class="span4 m-wrap">
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label">市<span class="required">*</span></label>
                                      <div class="controls">
                                          <input type="text" name="city"   class="span4 m-wrap">
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label">县区<span class="required">*</span></label>
                                      <div class="controls">
                                          <input type="text" name="area" class="span4 m-wrap">
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label">收货地址<span class="required">*</span></label>
                                      <div class="controls">
                                          <input type="text" name="consignee_address" class="span4 m-wrap">
                                      </div>
                                  </div>
                                  <div class="form-actions">
                                      <button type="button" id='order_done' class="btn green">生成订单</button>
                                  </div>
                              </td>
                          </tr>
                      </table>
                  </div>

              </form>
          </div>

          </div>
      </div>
  <!-- END PAGE CONTENT--> 
</div>
<script src="/static/js/autosize.min.js"></script>
<script>
    autosize($('#bcode'));
    function load_ini()
    {

        checkchange();
        order_done();
        new_batches();
        jQuery('.group-checkable').live('change',function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    if(!$(this).attr('disabled'))
                    {
                        $(this).attr("checked", true);
                    }

                } else {
                    if(!$(this).attr('disabled'))
                    {
                        $(this).attr("checked", false);
                    }

                }
            });
            jQuery.uniform.update(set);
        });

    }


    var checkchange = function()
    {
        var stock_arr=[];
        $('#df_submit').bind('click',function()
        {
            var barcode=$.trim($('#bcode').val());
            //不能为空
            if(barcode=='')
            {
                return;
            }
            //判断是一个条码还是多个
            var barcode_arr=barcode.split(/[\\s]|[  ]|[\r\n]|[,][，]/);
            //判断商品是否已经有了

            for(var a=barcode_arr.length;a>0;a--)
            {
                var index=$.inArray(barcode_arr[a-1],stock_arr);
                if(index!=-1)
                {
                    barcode_arr.splice($.inArray(barcode_arr[a-1],barcode_arr),1);
                }
            }
            //如果为空
            if(barcode_arr.length==0)
            {
                return;
            }

                $modal=$('#ajax-modal');
                $('body').modalmanager('loading');
                $.fn.modal.defaults.width='';
                $.fn.modal.defaults.height='';
                $.post('<?php echo ((is_array($_tmp="order/order_upload_barcode")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',{barcode:barcode_arr},function(msg){
                try
                {
                   // alert(msg);
                    eval("var str="+msg);

                    if(str.type==1)
                    {

                    }
                    else if(str.type==2)
                    {

                        eval("var stock="+str.stock);
                        if(stock_arr.length==0)
                        {
                            var stock_div=$('#product_all');
                            //创建表格
                          //  var table=$('<table class="table table-striped table-bordered table-hover dataTable" id="product_1" ></table> ');
                            //批量按钮
                           // var table_after=$(' <div class="input-append"> <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set="#product_all .list-checkable" /> </div> <div class="input-append"> <button type="button" data-url="<?php echo ((is_array($_tmp="package2/package_batches_date")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" data-action="batches"  data-box-size="800|500" class="modify_popup btn green">下一步</button> </div>');
                            //创建表头
                          //  var thead=$('<thead><th width="20" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set="#product_all .list-checkable"/></th> <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th> <th width="30" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备案编号</th> <th width="*" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th> <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">英文名称</th> <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">购买数量</th> <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">当地申报价</th> <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">币种</th> <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">毛重</th> <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">重量单位</th> </tr> </thead>');
                            //创建表体
                           // var tbody=$(' <tbody role="alert" aria-live="polite" aria-relevant="all"></tbody>');

                            //创建表行
                            var tbody=$('#tb');
                            for(var i=0;i<stock.length;i++)
                            {
                                var tr =$('<tr style="height: 30px;"><td><input type="checkbox" barcode="'+stock[i].barcode+'" name="item[]"  value="'+stock[i].id+'" class="list-checkable" /></td><td><button type="button" class="btn mini green del">删除</button></td><td>'+stock[i].id+'</td><td>'+stock[i].ch_name+'</td>  <td>'+stock[i].en_name+'</td> <td><input type="text" name="num[]"></td> <td><input type="text" name="local_price[]"></td> <td><input type="text" name="currency[]" value="<?php echo $this->_tpl_vars['fedex_currency']; ?>
" readonly="readonly"></td><td>'+stock[i].gw+'</td><td>g</td></tr>')
                                tbody.append(tr);
                                stock_arr.push(stock[i].barcode);
                            }
                            $('body').modalmanager('removeLoading');

                            //创建订单信息
                           // var  order_in=$('#order_input');

                           // table.append(thead);
                           // table.append(tbody);


                            //stock_div.append(table);
                            //stock_div.append(table_after);
                            //stock_div.append(order_in);
                           // order_in.show();

                        }
                        else
                        {
                            $('body').modalmanager('removeLoading');
                            for(var c=0;c<stock.length;c++)
                            {
                                var tr =$('<tr><td><input type="checkbox" barcode="'+stock[c].barcode+'" name="item[]"  value="'+stock[c].id+'" class="list-checkable" /></td><td><button type="button" class="btn mini green del">删除</button></td><td>'+stock[c].id+'</td><td>'+stock[c].ch_name+'</td>  <td>'+stock[c].en_name+'</td> <td><input type="text" name="num[]"></td> <td><input type="text" name="local_price[]"></td> <td><input type="text" name="currency[]" value="<?php echo $this->_tpl_vars['fedex_currency']; ?>
" readonly="readonly"></td><td>'+stock[c].gw+'</td><td>g</td></tr>')
                                $('#product_1 tbody').append(tr);
                                stock_arr.push(stock[c].barcode);
                            }
                            $('body').modalmanager('removeLoading');
                        }

                        return;
                    }
                    else if(str.type==3)
                    {
                        location.reload();
                    }
                    setTimeout(function(){
                        $modal.load('<?php echo ((is_array($_tmp="sp_index/sp_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function()
                        {
                            $modal.modal();
                        });
                    }, 300);
                }
                catch(e)
                {
                    alert(e);

                    $('body').modalmanager('removeLoading');
                    setTimeout(function(){
                        $modal.load('<?php echo ((is_array($_tmp="sp_index/sp_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function()
                        {
                            $modal.modal();
                        });
                    }, 300);
                };
            });


        });

        $('#product_all .del').live('click',function(){

            //获取当前的stokc_id
            var stock_id=$(this).parents('tr').find('.list-checkable').attr('barcode');
            stock_arr.splice($.inArray(stock_id,stock_arr),1);
            $(this).parents('tr').remove();
//            if(stock_arr.length==0)
//            {
//                $('#product_1').remove();
//                $('#order_input').hide();
//            }
        })

    };


    var order_done=function()
    {
        var  form1=$('#product_all');
        $('#order_done').bind('click',function()
        {
            modal_confirm('请务必确认所有信息填写完毕',function(){
                //encodeURI(msg)
                $modal=$('#ajax-modal');

                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="order/order_upload_barcode_done")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
                    try
                    {
                        eval("var str="+msg);
                        //操作成功
                        if(str.type==1)
                        {
                            $('body').modalmanager('removeLoading');
                        }
                        else if(str.type==2)
                        {
                            $('body').modalmanager('removeLoading');
                        }
                        else if(str.type==3)
                        {
                            $('body').modalmanager('removeLoading');
                        }
                        setTimeout(modal_msg(str.msg),300);
                    }catch(e){
                        $('body').modalmanager('removeLoading');
                        setTimeout(modal_msg('系统异常'),300);
                    };
                });
            })

        })
    }
    var new_batches=function()
    {
        $('#new_batches').click(function(){
            modal_confirm('确定要生成新批次么？',function(){
                $modal=$('#ajax-modal');

                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="order/add_new_batches1")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',function(msg){
                    //alert(msg);
                    try
                    {
                        eval("var str="+msg);
                        //操作成功
                        if(str.type==1)
                        {
                            $('body').modalmanager('removeLoading');
                        }
                        else if(str.type==2)
                        {
                            $('body').modalmanager('removeLoading');
                            eval("var batches="+str.batches);
                            $('#fedex_type').empty();
                            for(var d=0;d<batches.length;d++)
                            {
                                var option=$('<option value="'+batches[d].id+'">批次号('+batches[d].id+')'+batches[d].name+'</option>');
                                $('#fedex_type').append(option);
                            }


                        }
                        else if(str.type==3)
                        {
                            $('body').modalmanager('removeLoading');
                        }
                        setTimeout(modal_msg(str.msg),300);
                    }catch(e){
                        $('body').modalmanager('removeLoading');
                        setTimeout(modal_msg('系统异常'),300);
                    };
                });
            })
        })
    }
</script> 