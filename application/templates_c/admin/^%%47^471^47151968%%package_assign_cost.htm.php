<?php /* Smarty version 2.6.20, created on 2017-05-12 09:42:13
         compiled from package_assign_cost.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'package_assign_cost.htm', 74, false),)), $this); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="form">
                <!-- BEGIN FORM-->
                <form action="" id="form_logis" class="form-horizontal" method="post" >
                    <table class="table table-bordered table-hover dataTable" id="table_1">
                                                <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span> </div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span> </div>
                        <thead>
                        <tr>
                            <th bgcolor="#E2EEFE" colspan="99">包裹信息</th>
                        </tr>
                        </thead>
                        <tr>
                            <th width="250px">包裹编号：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>
                            <th width="*">会员ID：<?php echo $this->_tpl_vars['re']['userid']; ?>
</th>
                        </tr>

                        <thead>
                        <tr>
                            <th bgcolor="#E2EEFE" colspan="99">指定包裹运费</th>
                        </tr>
                        <tr>
                            <td colspan="99">
                                <div class="row-fluid" style="margin-top: 10px">
                                    <label  class="control-label">成本运费</label>
                                    <div class="controls span7">
                                        <input type="text" name="cost" value="<?php echo $this->_tpl_vars['re']['cost']; ?>
" \>
                                        <p style="color: red;display: inline-block;">注：是指FedEx收取的实际运费</p>
                                    </div>
                                </div>

                                <div class="row-fluid" style="margin-top: 10px">
                                    <label  class="control-label">实收运费</label>
                                    <div class="controls span7">
                                        <input type="text" name="actual_cost" value="<?php echo $this->_tpl_vars['re']['actual_cost']; ?>
" \>
                                        <p style="color: red;display: inline-block;">注：是指我们向客户收取的运费</p>
                                    </div>
                                </div>
                                <div class="row-fluid" style="margin-top: 10px">
                                    <h3>注释</h3>
                                    <p style="color: red;">1、在对包裹指定运费之前，请先确认包裹下是否有订单需要指定运费。</p>
                                    <p style="color: red;">2、如果不指定具体运费，则包裹下所有订单依据重量平摊运费。</p>
                                </div>
                            </td>

                        </tr>
                        </thead>
                        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
                    </table>
                    <div class="form-actions">
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
            $.post('<?php echo ((is_array($_tmp="package/package_assign_cost")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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