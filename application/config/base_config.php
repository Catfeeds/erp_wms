<?php
$config['order_status'] = array(	
	1 => '网站审核中',
	2 => '海关审核中',
	3 => '已发货',
   -1 => '已作废'
);

$config['order_payment_status'] = array(
	1 => '已付款',
	2 => '未付款',
	3 => '交易完成',
   -1 => '已退款'				
);			  
/*
$config['stock_d_status'] = array(
	1 => '开启订阅',
    0 => '关闭订阅'				
);			  


$config['stock_k_status'] = array(
	1 => '库存可申请',
	0 => '库存不可申请',
   -1 => '关闭销售'				
);	
*/
//关区
$config['customs_list'] = array(
	1 => '成都',
	2 => '北京',
	3 => '深圳',
	4 => '杭州',
    5 => '上海'				
);	

//包裹 投递状态
$config['package_request_status'] = array(
    0 => '初始化',
	1 => '未取单',
	2 => '已取单',
	3 => '正在取单',
	4 => '已验证',
	5 => '验证失败',
    6 => '已提交'				
);	

//关区
$config['customs_rate_type'] = array(
	1 => '行邮税',
	2 => '综合税',		
);

//申请备案 预计运货时间
$config['recoder_status'] = array(
	1=>'14|14天内完成备案',
	2=>'30|30天内完成备案',
	3=>'60|60天内完成备案'
);

//FedEx包裹执行状态
$config['fedex_package_status']=array(
	1=>'未取单',
   -1=>'创建运单失败',
	2=>'已取单，未验证',
   -2=>'验证失败',
	3=>'已验证，未确认',
   -3=>'确认失败',
	4=>'已确认'
);

//订单运单类型
$config['order_logistics_type']=array(
	1=>'EMS'
);

//FedEx服务类型
$config['ServiceType']=array(
	'INTERNATIONAL_ECONOMY_FREIGHT'=>'国际经济重货服务',
	'INTERNATIONAL_ECONOMY'=>'国际经济服务',
	'INTERNATIONAL_PRIORITY_FREIGHT'=>'国际优先重货服务',
	'INTERNATIONAL_PRIORITY'=>'国际优先服务',
);


//包裹运行状态
$config['run_status'] = array(
	0=>'未开启',
	1=>'创建运单中',
   -1=>'创建运单失败',
	2=>'预估运费中',
   -2=>'预估费率失败',
	3=>'再创运单中',
   -3=>'再创运单失败',
   10=>'运行完成'
);

//批次确认状态
$config['confirm_status']=array(
	0=>'未确认',
	1=>'已确认'
);


$config['batch_status']=array(
	1=>'初始化',
	2=>'待审核',
	3=>'已审核',
	4=>'待发货',
	5=>'已发货',
	6=>'国内已通关',
	7=>'批次作废'
);
$config['fedex_package_type']=array(
	'FEDEX_ENVELOPE'=>'FedEx快递封',
	'FEDEX_PAK'=>'FedEx快递袋',
	'FEDEX_BOX'=>'FedEx快递箱',
	'FEDEX_TUBE'=>'FedEx快递筒',
	'FEDEX_10KG_BOX'=>'FedEx10公斤快递箱',
	'FEDEX_25KG_BOX'=>'FedEx25公斤快递箱',
	'YOUR_PACKAGING'=>'自定义包裹',
);

