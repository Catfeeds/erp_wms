<?php /* Smarty version 2.6.20, created on 2017-03-24 16:30:03
         compiled from sproduct_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'sproduct_edit.htm', 111, false),array('modifier', 'site_url', 'sproduct_edit.htm', 320, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">我的商品</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#"><?php if (empty ( $this->_tpl_vars['re'] )): ?>添加商品<?php else: ?>编辑商品<?php endif; ?></a></li>
            </ul>
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['re'] )): ?>添加商品<?php else: ?>编辑商品<?php endif; ?></div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="" id="form_product_add" class="form-horizontal" method="post" >

                                                <div class="row-fluid">
                            <div id='alert-error_1' class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                <span>提交失败</span>
                            </div>
                            <div id='alert-success_1' class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                                <span>提交成功</span>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span4" >
                                <label class="control-label">商品中文名称</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="ch_name" value="<?php echo $this->_tpl_vars['re']['ch_name']; ?>
"/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">商品英文名称</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="en_name" value="<?php echo $this->_tpl_vars['re']['en_name']; ?>
"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">商品条形码</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="barcode" value="<?php echo $this->_tpl_vars['re']['barcode']; ?>
"/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">商品简述</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="desc" value="<?php echo $this->_tpl_vars['re']['desc']; ?>
"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">品牌(中文)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="ch_brand" value="<?php echo $this->_tpl_vars['re']['ch_brand']; ?>
"/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">品牌(英文)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="en_brand" value="<?php echo $this->_tpl_vars['re']['en_brand']; ?>
"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">销售价</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="price" <?php if (empty ( $this->_tpl_vars['re'] )): ?>value='0.00'<?php else: ?>value="<?php echo $this->_tpl_vars['re']['price']; ?>
"<?php endif; ?>/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">市场价</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="mark_price" <?php if (empty ( $this->_tpl_vars['re'] )): ?>value='0.00'<?php else: ?>value="<?php echo $this->_tpl_vars['re']['mark_price']; ?>
"<?php endif; ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4">
                                <label class="control-label">商品类别</label>
                                <div class="controls">
                                    <select size="1" id="form_2_select2" name="cat" aria-controls="sample_1" class="form_2_select2 m-wrap span12">
                                        <option value=''>请选择商品类别</option>
                                        <?php $_from = $this->_tpl_vars['res']['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option <?php if ($this->_tpl_vars['item']['cat'] == $this->_tpl_vars['re']['catname']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['cat']; ?>
|<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="span4">
                                <label class="control-label">商品产地</label>
                                <div class="controls">
                                    <select size="1" id="form_2_select2" name="coun" aria-controls="sample_1" class="form_2_select2 m-wrap span12">
                                        <option value=''>请选择商品产地</option>
                                        <?php $_from = $this->_tpl_vars['res']['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option <?php if ($this->_tpl_vars['item']['c_name'] == $this->_tpl_vars['re']['country']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['c_name']; ?>
|<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['c_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo $this->_tpl_vars['item']['c_name']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">长度</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="length" <?php if (empty ( $this->_tpl_vars['re'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['re']['length']; ?>
"<?php endif; ?>/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">宽度</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="width" <?php if (empty ( $this->_tpl_vars['re'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['re']['width']; ?>
"<?php endif; ?>/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">高度</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="height" <?php if (empty ( $this->_tpl_vars['re'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['re']['height']; ?>
"<?php endif; ?>/>
                                </div>
                            </div>

                            <div class="span4">
                                <label class="control-label">食品/非食品</label>
                                <div class="controls">
                                    <label class="radio inline">
                                        <input type="radio" name="type" value="1" <?php if ($this->_tpl_vars['re']['type'] == '1'): ?>checked="checked"<?php endif; ?> >食品</label>
                                    <label class="radio inline">
                                        <input type="radio" name="type" value="2" <?php if ($this->_tpl_vars['re']['type'] == '2'): ?>checked="checked"<?php endif; ?> >非食品</label>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">毛重(g)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="gw" <?php if (empty ( $this->_tpl_vars['re'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['re']['gw']; ?>
"<?php endif; ?>/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">净重(g)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="nw" <?php if (empty ( $this->_tpl_vars['re'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['re']['nw']; ?>
"<?php endif; ?>/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">规格/型号(中文)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="ch_spe" value="<?php echo $this->_tpl_vars['re']['ch_spe']; ?>
"/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">规格/型号(英文)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="en_spe" value="<?php echo $this->_tpl_vars['re']['en_spe']; ?>
"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">主要成分(中文)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="ch_ing" value="<?php echo $this->_tpl_vars['re']['ch_ing']; ?>
"/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">主要成分(英文)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="en_ing" value="<?php echo $this->_tpl_vars['re']['en_ing']; ?>
"/>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top:10px;">
                            <div class="span4" >
                                <label class="control-label">功能/用途(中文)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="ch_pur" value="<?php echo $this->_tpl_vars['re']['ch_pur']; ?>
"/>
                                </div>
                            </div>

                            <div class="span4" >
                                <label class="control-label">功能/用途(英文)</label>
                                <div class="controls">
                                    <input type="text" class="span12 m-wrap" name="en_pur" value="<?php echo $this->_tpl_vars['re']['en_pur']; ?>
"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
                            <button type="submit" id='submit_product_add' class="btn green">提交</button>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script>

    $('.form_2_select2').select2({
        placeholder: "请选择",
        allowClear: true
    });

    function load_ini()
    {
        var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');

        var form1 = $('#form_product_add');
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

            },
            messages : {

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

        $("#submit_product_add").click(function(){
            if(form1.valid()==true)
            {
                //encodeURI(msg)
                $modal=$('#ajax-modal');
                error1.hide();
                success1.show();
                success1.find('span').html('正在提交...........');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="supplier/product_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
                    //alert(msg);
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
                            error1.hide();
                            success1.show();
                            window.parent.f_main_index();
                            return true;
                        }


                        setTimeout(function(){
                            $modal.load('<?php echo ((is_array($_tmp="sp_index/sp_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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