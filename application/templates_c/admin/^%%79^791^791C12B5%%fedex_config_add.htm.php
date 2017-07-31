<?php /* Smarty version 2.6.20, created on 2017-05-03 10:32:33
         compiled from fedex_config_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'fedex_config_add.htm', 204, false),)), $this); ?>
<div class="container-fluid">

    <!-- BEGIN PAGE HEADER-->

    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>包裹管理</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">FedEx基础配置</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#"><?php if (empty ( $this->_tpl_vars['de'] )): ?>添加基础配置<?php else: ?>修改基础配置<?php endif; ?></a></li>
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
                    <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['de'] )): ?>添加基础配置<?php else: ?>修改基础配置<?php endif; ?></div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action=""  id='admin_logistics_add' class="form-horizontal" method="post" >
                        <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span></div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span></div>

                        <div class="control-group">
                            <label class="control-label">秘钥<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="Key"   class="span6 m-wrap"/>
                                <?php if (! empty ( $this->_tpl_vars['de']['id'] )): ?>
                                <input type="hidden" name="id"  value="<?php echo $this->_tpl_vars['de']['id']; ?>
" />
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">密码<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="Password"   class="span6 m-wrap"/>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">账号<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="AccountNumber" value="<?php echo $this->_tpl_vars['de']['AccountNumber']; ?>
"  class="span6 m-wrap"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Meter账号<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="MeterNumber" value="<?php echo $this->_tpl_vars['de']['MeterNumber']; ?>
"  class="span6 m-wrap"/>
                                <input type="hidden" name="id"  value="<?php echo $this->_tpl_vars['de']['id']; ?>
" />
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="button"  id='submit_logistics_add' class="btn green">提交</button>
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
    var initTable1 = function() {
        /* Formating function for row details */
        /*
         * Insert a 'details' column to the table
         */
        var oTable = $('#product_2').dataTable( {
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
            "bAutoWidth":true,
            "bStateSave":false,
            "sScrollX":'1690px',
            "sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
            //'sScrollXInner':true,
            //"bSortCellsTop":true,
        });
    }

    function load_ini()
    {
        var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');
        var form1 = $('#admin_logistics_add');
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                AccountNumber:{
                    required: true
                },
                MeterNumber:{
                    required:true
                }


            },
            messages : {

                AccountNumber:{
                    required: '账号不能为空'
                },
                MeterNumber:{
                    required:'meter号不能为空'
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

        $("#submit_logistics_add").click(function(){
            if(form1.valid()==true)
            {
                //encodeURI(msg)
                $modal=$('#ajax-modal');
                error1.hide();
                success1.show();
                success1.find('span').html('正在提交...........');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="package/fedex_config_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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

        initTable1();

    }
</script>