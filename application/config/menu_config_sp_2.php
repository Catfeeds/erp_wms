<?php
//货运站模式
$nva_menu=array(
	  			0=>array(
					"name"=>'首页',
					"action"=>"sp_index/index",
					"m"=>"sp_index",
					"ico"=>'icon-home',
					'liclass'=>'start', //开始
					"actions"=>array(
						"sp_index/sp_msg"=>''
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
						"product/error_msg"=>'',
						"product/recoder_status"=>''
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
						"order/order_ems_point"=>'',
						"order/add_new_batches"=>'',
						"order/order_card_upload"=>'',
						"order/order_ems_point"=>'',
						"order/order_upload_barcode"=>'',
						"order/order_upload_barcode_done"=>'',
						"order/add_new_batches1"=>'',
						"order/order_del"=>""

					)	
				)
				,
				
			    5=>array(
					"name"=>'集货站fedex包裹',
					"action"=>"",
					"m"=>"package2",
					"ico"=>'icon-gift',
					'liclass'=>'', //开始
					"actions"=>array(
						"package2/package_list"=>"fedex包裹列表",   //单批次fedex 只能用于模式1
						"package2/package_add"=>'',
						"package2/package_add_order"=>'',
						"package2/package_checkbox"=>'',
						"package2/package_confirm"=>'',
						"package2/package_fedex_pakge_id"=>'',   //加入包裹  取消包裹
						"package2/package_order_list"=>'',
						"package2/package_batches_date"=>'',
						"package2/package_batches_date1"=>'',
						"package2/package_estimated_rate"=>'',

					)
				)
				,
			    6=>array(
					"name"=>'空海运包裹管理',
					"action"=>"",
					"m"=>"package3",
					"ico"=>'icon-gift',
					'liclass'=>'', //开始
					"actions"=>array(
						"package3/package_list"=>"空海运包裹列表",   //单批次fedex 只能用于模式1
						"package3/package_add"=>'',
						"package3/package_add_order"=>'',
						"package3/package_checkbox"=>'',
						"package3/package_confirm"=>'',
						"package3/package_fedex_pakge_id"=>'',   //加入包裹  取消包裹
						"package3/package_order_list"=>'',

					)
				)
				,
				8=>array(
					 "name"=>'发货批次',
					 "action"=>"",
					 "m"=>"batches",
					 "ico"=>'icon-truck',
					 'liclass'=>'', //开始
					 "actions"=>array(
					    "batches2/batches_list"=>"批次列表",
						"batches2/batches_edit"=>"",
						 "batches/other_batches_list"=>"收到批次",
						 "batches2/confirm_batch"=>""
					)	
				)
				,
				9=>array(
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
