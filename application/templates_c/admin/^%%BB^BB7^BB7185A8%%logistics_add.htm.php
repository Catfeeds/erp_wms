<?php /* Smarty version 2.6.20, created on 2017-06-08 13:49:33
         compiled from logistics_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'logistics_add.htm', 261, false),)), $this); ?>
<div class="container-fluid"> 
  
  <!-- BEGIN PAGE HEADER-->
  
  <div class="row-fluid">
    <div class="span12">
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>供应订阅管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">运费模板</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#"><?php if (empty ( $this->_tpl_vars['de'] )): ?>添加模板<?php else: ?>修改模板<?php endif; ?></a></li>
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
          <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['de'] )): ?>添加模板<?php else: ?>修改模板<?php endif; ?></div>
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
              <label class="control-label">运费模板名称<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="title" value="<?php echo $this->_tpl_vars['de']['title']; ?>
"  class="span6 m-wrap"/>
                <input type="hidden" name="id"  value="<?php echo $this->_tpl_vars['de']['id']; ?>
" />
               </div>
            </div>

            <?php if (empty ( $this->_tpl_vars['de'] ) && $this->_tpl_vars['re']['index'] == 1): ?>
	            <div class="control-group">
		            <label class="control-label">国内实际模版<span class="required">*</span></label>
		            <div class="controls">
	               		<select name="pid" class="form_2_select2 span4 m-wrap ">
		                    <option value="">选择国内模版</option>
		                    <?php $_from = $this->_tpl_vars['re']['logistics_temp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
		                    	<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</option>
		                    <?php endforeach; endif; unset($_from); ?>
		                 </select>
	                 </div>
	            </div>
            <?php endif; ?>

            <div class="control-group">
              <label class="control-label">全局修改<span class="required">*</span></label>
              <div class="controls">
                <div class="row-fluid">
                  <div class="span2">
                    <label> <span id="span_label" >首重(克)</span>
                      <input type="text" id='base_default_num' class="span6 m-wrap"/>
                    </label>
                  </div>
                  <div class="span2">
                    <label> <span id="span_label" >首重费(元)</span>
                      <input type="text" id='base_default_price'  class="span6 m-wrap"/>
                    </label>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span2">
                    <label> <span id="span_label" >续重(克)</span>
                      <input type="text" id='base_add_num'   class="span6 m-wrap"/>
                    </label>
                  </div>
                  <div class="span2">
                    <label> <span id="span_label" >续重费(元)</span>
                      <input type="text" id='base_add_price'  class="span6 m-wrap"/>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <table class="table table-striped table-bordered table-hover dataTable" id="product_2" >
              <thead>
                <tr role="heading">
                  <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">省名称</th>
                  <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">首重(克)</th>
                  <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">首重费(元)</th>
                  <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">续重（克）</th>
                  <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">续重费(元)</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                <!-- 添加 --> 
              <?php if (! empty ( $this->_tpl_vars['district'] )): ?>
              <?php $_from = $this->_tpl_vars['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['logistics']):
?>
              <tr >
                <td width="100"><?php echo $this->_tpl_vars['logistics']['name']; ?>

                  <input type="hidden" name="define_city_name[<?php echo $this->_tpl_vars['logistics']['id']; ?>
]" value="<?php echo $this->_tpl_vars['logistics']['name']; ?>
" />
                </td>
                <td width="150"><input type="text" name="default_num[<?php echo $this->_tpl_vars['logistics']['id']; ?>
]" class="base_default_num span6 m-wrap" value='0' /></td>
                <td width="150"><input type="text" name="default_price[<?php echo $this->_tpl_vars['logistics']['id']; ?>
]" class="base_default_price span6 m-wrap" value='0' /></td>
                <td width="150"><input type="text" name="add_num[<?php echo $this->_tpl_vars['logistics']['id']; ?>
]" class="base_add_num span6 m-wrap" value='0' /></td>
                <td width="*"><input type="text" name="add_price[<?php echo $this->_tpl_vars['logistics']['id']; ?>
]" class="base_add_price span1 m-wrap" value='0' /></td>
              </tr>
              <?php endforeach; endif; unset($_from); ?> 
              <!-- 更新 --> 
              <?php else: ?>
              <?php $_from = $this->_tpl_vars['logistics_temp_con']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['logistics']):
?>
              <tr >
                <td width="100"><?php echo $this->_tpl_vars['logistics']['define_city_name']; ?>

                    <input type="hidden" name="define_city_name[<?php echo $this->_tpl_vars['logistics']['define_cityid']; ?>
]" value="<?php echo $this->_tpl_vars['logistics']['define_city_name']; ?>
"  type="hidden" />
                 </td>
                <td width="150"><input type="text" name="default_num[<?php echo $this->_tpl_vars['logistics']['define_cityid']; ?>
]" class="base_default_num span6 m-wrap" value='<?php echo $this->_tpl_vars['logistics']['default_num']; ?>
' /></td>
                <td width="150"><input type="text" name="default_price[<?php echo $this->_tpl_vars['logistics']['define_cityid']; ?>
]" class="base_default_price span6 m-wrap" value='<?php echo $this->_tpl_vars['logistics']['default_price']; ?>
' /></td>
                <td width="150"><input type="text" name="add_num[<?php echo $this->_tpl_vars['logistics']['define_cityid']; ?>
]" class="base_add_num span6 m-wrap" value='<?php echo $this->_tpl_vars['logistics']['add_num']; ?>
' /></td>
                <td width="*"><input  type="text" name="add_price[<?php echo $this->_tpl_vars['logistics']['define_cityid']; ?>
]" class="base_add_price span1 m-wrap" value='<?php echo $this->_tpl_vars['logistics']['add_price']; ?>
' /></td>
              </tr>
              <?php endforeach; endif; unset($_from); ?>
              <?php endif; ?>
              </tboty>
              
            </table>
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
			title: {
				required: true
			},
			pid: {
				required: true
			}
		},
		messages : {
			title: {
				 required:'模板名称不能为空',
			},
			pid: {
				 required:'国内模板不能为空',
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
			$.post('<?php echo ((is_array($_tmp="logistics/logistics_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
					setTimeout(modal_msg(str.msg),300);
				}catch(e){ 
				  
					$('body').modalmanager('removeLoading');
					success1.hide();
					error1.find('span').html('系统异常');
					error1.show();
					setTimeout(modal_msg('系统异常'),300);
			    };
			});
		}
	});

	initTable1();
    $('#base_default_num,#base_default_price,#base_add_price,#base_add_num').bind('blur',function(){
		  var val=$(this).val();  
		  if(val!='')
		  {
			  var id=$(this).attr('id');
			  $('#product_2 .'+id).val(val);
		  }
	  });  
}
</script> 