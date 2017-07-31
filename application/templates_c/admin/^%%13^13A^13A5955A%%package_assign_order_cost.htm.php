<?php /* Smarty version 2.6.20, created on 2017-05-12 09:42:13
         compiled from package_assign_order_cost.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package_assign_order_cost.htm', 58, false),)), $this); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="form">
                <!-- BEGIN FORM-->
                <form action="" id="form_logis" class="form-horizontal" method="post" >
                    <table class="table table-bordered table-hover dataTable" id="table_1">
                     <thead>
                        <tr>
                            <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单ID</th>
                            <th width="300" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">是否指定</th>
                            <th width="300" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">预估运费</th>
                            <th width="300" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">成本运费</th>
                            <th width="300" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">实收运费</th>
                        </tr>
                     </thead>
                    <tbody>
                        <?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <tr>
                                <td>
                                    <?php echo $this->_tpl_vars['item']['id']; ?>

                                    <input type="hidden" name="id[]" value="<?php echo $this->_tpl_vars['item']['id']; ?>
">
                                </td>
                                <td>
                                    <select name="is_assign_fee[]">
                                        <option value="all">请选择</option>
                                        <option value="0" <?php if ($this->_tpl_vars['item']['is_assign_fee'] == 0): ?>selected<?php endif; ?>>不指定</option>
                                        <option value="1" <?php if ($this->_tpl_vars['item']['is_assign_fee'] == 1): ?>selected<?php endif; ?> >指定</option>
                                    </select>
                                </td>
                                <td><input type="text" name="assign_fee[]" value="<?php echo $this->_tpl_vars['item']['assign_fee']; ?>
"></td>
                                <td><input type="text" name="assign_cost_fee[]" value="<?php echo $this->_tpl_vars['item']['assign_cost_fee']; ?>
"></td>
                                <td><input type="text" name="assign_actual_fee[]" value="<?php echo $this->_tpl_vars['item']['assign_actual_fee']; ?>
"></td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                    </tbody>
                    </table>
                    <div class="form-actions">
                        <h3>注释</h3>
                        <p style="color: red;">1、如要指定具体某个订单的国外运费，请先将是否指定选择为指定，再做填写，否则提交无效</p>
                        <p style="color: red;">2、如果要指定，则后续的所有费用都需要指定（不必在同一时间）</p>
                        <button type="button" id='submit_order_eidt' class="btn red">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
    <script>


        $('#submit_order_eidt').bind('click',function(){

            $modal = $('#ajax-modal');
            $('body').modalmanager('loading');
            $.fn.modal.defaults.width='';
            $.fn.modal.defaults.height='';
            $.post('<?php echo ((is_array($_tmp="package/package_assign_order_cost")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$('#form_logis').serialize(),function(msg){
                //alert(msg)
                try
                {
                    eval("var str="+msg);
                    //操作成功
                    if(str.type==1)
                    {

                    }
                    else if(str.type==2)
                    {

                    }
                    else if(str.type==3)
                    {
                        //刷新主页面
                        window.parent.location.reload(true);
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

    </script>