<?php
$nva_menu=array(
	  			0=>array(
					"name"=>'首页',
					"action"=>"sp_index/index",
					"m"=>"sp_index",
					"ico"=>'icon-home',
					'liclass'=>'start', //开始
					"actions"=>array(
					)	
				),
				1=>array(
					"name"=>'平台备案库',
					"action"=>"",
					"m"=>"filing",
					"ico"=>'icon-gift',
					'liclass'=>'', //开始
					"actions"=>array(
					    "filing/filing_list"=>"备案库列表", 
						//"product/product_log"=>"商品日志",
						"stock/ajax_order_sub"=>""  //审核订单 批量作废 
					)	
				),
				2=>array(
					"name"=>'商品管理',
					"action"=>"",
					"m"=>"product",
					"ico"=>'icon-gift',
					'liclass'=>'', //开始
					"actions"=>array(
					    "product/product_list"=>"我的商品", 
						"product/product_add_or_edit"=>"添加商品", 
						"product/product_upload"=>"商品上传",
						"product/product_bin_list"=>"商品回收",
						"product/ajax_order_sub"=>"",  //审核订单 批量作废 
						"product/product_checkbox"=>'',
						"product/product_bin_list"=>'',
						"product/product_bin_checkbox"=>'',
						"product/error_msg"=>''
					 )	
				),
				3=>array(
					"name"=>'订单管理',
					"action"=>"",
					"m"=>"order",
					"ico"=>'icon-gift',
					'liclass'=>'', //开始
					"actions"=>array(
					    "order/order_list"=>"订单列表",   
						"order/order_upload"=>"订单上传",
						"order/order_upload_code"=>"扫码生成订单",
						"order/order_down_xls"=>'',
						"order/add_new_batches"=>''
					)	
				)
				,
				4=>array(
					"name"=>'包裹管理',
					"action"=>"",
					"m"=>"package",
					"ico"=>'icon-gift',
					'liclass'=>'', //开始
					"actions"=>array(
					    "package/package_list"=>"包裹列表",
						"package/package_add"=>''
					)	
				)
				,
				5=>array(
					 "name"=>'发货批次',
					 "action"=>"",
					 "m"=>"batches",
					 "ico"=>'icon-truck',
					'liclass'=>'', //开始
					"actions"=>array(
					    "batches/batches_list"=>"批次列表", 
						"batches/batches_edit"=>""
					)	
				)
				,
				6=>array(
					"name"=>'账户管理',
					"ico"=>'icon-male',
					"m"=>"user",
					"action"=>"",
					'liclass'=>'', //结束的
					"actions"=>array(
						"user/info_passwd"=>"修改登陆密码",
						"user/logout"=>"",
						"user/login"=>''
					)	
				)
			);
