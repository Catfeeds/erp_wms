-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 10 月 13 日 12:02
-- 服务器版本: 5.5.40
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库: `zjh_product`
--

-- --------------------------------------------------------

--
-- 表的结构 `dferp_batches`
--

CREATE TABLE IF NOT EXISTS `dferp_batches` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `batches_name` varchar(50) DEFAULT NULL COMMENT '批次名称',
  `userid` int(8) NOT NULL COMMENT '会员ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（1 初始化 2 待审核 3 已审核 4 待发货 5 已发货 6 国内已通关 7 批次作废）',
  `freight_template` varchar(30) NOT NULL DEFAULT '未选择' COMMENT '运费模版名称（国内）',
  `template_id` int(11) NOT NULL DEFAULT '0' COMMENT '运费模版ID（国内）',
  `freight_template_abroad` varchar(30) NOT NULL DEFAULT '未选择' COMMENT '运费模版名称（国外）',
  `template_abroad_id` int(11) NOT NULL DEFAULT '0' COMMENT '运费模版ID（国外）',
  `customs` tinyint(1) NOT NULL DEFAULT '0' COMMENT '关区（0 未选择 1 成都 2 北京 3 深圳 4 杭州 5 上海 ）',
  `tax_type` tinyint(1) DEFAULT '0' COMMENT '计税方式（0 未选择 1 行邮税 2 综合税）',
  `tax_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT ' 税支付状态（1 初始化 2 未付款 3 已付款）',
  `tax_total` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '税总金额',
  `freight_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '运费支付状态（1 初始化 2 未付款 3 已付款）',
  `freight_total` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费总金额',
  `freight_total_abroad` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费总金额（国外）',
  `order_num` int(5) NOT NULL DEFAULT '0' COMMENT '订单总数',
  `fail_order_num` int(5) NOT NULL DEFAULT '0' COMMENT '备案未通过订单数',
  `airport` varchar(20) DEFAULT NULL COMMENT '机场名称（国内）',
  `flight_date` date DEFAULT '0000-00-00' COMMENT '航班日期',
  `flight_num` varchar(15) DEFAULT NULL COMMENT '航班号',
  `pallet_no` varchar(30) DEFAULT NULL COMMENT '托盘编号',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='批次号管理' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `dferp_batches`
--



-- --------------------------------------------------------

--
-- 表的结构 `dferp_logistics_temp`
--

CREATE TABLE IF NOT EXISTS `dferp_logistics_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pid` int(11) DEFAULT '0' COMMENT '国内实际运费模版ID',
  `title` varchar(50) DEFAULT NULL COMMENT '模板名',
  `uptime` datetime NOT NULL COMMENT '最后编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='自定义物流模板表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `dferp_logistics_temp`
--



-- --------------------------------------------------------

--
-- 表的结构 `dferp_order`
--

CREATE TABLE IF NOT EXISTS `dferp_order` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '订单编号',
  `userid` int(8) NOT NULL COMMENT '会员编号',
  `import_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '导入订单号',
  `batches_id` int(8) NOT NULL DEFAULT '-1' COMMENT '批次编号（-1 未添加批次）',
  `consignee` varchar(50) NOT NULL COMMENT '收货人姓名',
  `province` varchar(10) NOT NULL DEFAULT '0' COMMENT '省',
  `province_id` int(6) NOT NULL DEFAULT '0' COMMENT '省ID（6位）',
  `city` varchar(10) NOT NULL DEFAULT '0' COMMENT '市',
  `area` varchar(10) NOT NULL DEFAULT '0' COMMENT '区',
  `consignee_address` varchar(100) NOT NULL COMMENT '收货人地址（逗号分隔）',
  `consignee_mobile` varchar(11) NOT NULL COMMENT '收货人手机',
  `consignee_email` varchar(100) DEFAULT NULL COMMENT '收货人邮箱',
  `card_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '证件类型（1 身份证）',
  `card_no` varchar(18) NOT NULL COMMENT '证件号码',
  `total_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价格',
  `total_rate` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '总税',
  `total_weight` float(10,0) NOT NULL DEFAULT '0' COMMENT '总重（g）',
  `total_num` float(10,0) NOT NULL DEFAULT '0' COMMENT '商品总数',
  `payment_id` varchar(30) DEFAULT NULL COMMENT '支付单号',
  `payment_type` tinyint(1) DEFAULT '1' COMMENT '支付类型（2 支付宝 3 微信支付 4 财付通 5 银联支付）',
  `payment_money` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '付款总额',
  `logistics_no` varchar(18) DEFAULT NULL COMMENT '运单号',
  `logistics_type` tinyint(3) DEFAULT '0' COMMENT '运单类型',
  `total_freight` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '总运费',
  `total_freight_abroad` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '总运费（国外）',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单状态（1 待审核 2 已审核 3 待发货 4 已发货 5 国内已通关 -1 订单取消 -2 通关失败 ）',
  `card_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '证件状态（1 未上传  2 已上传 3 已审核）',
  `return_con` varchar(255) DEFAULT NULL COMMENT '备注',
  `add_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '下单时间',
  `submit_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '提交时间',
  `send_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '发货时间',
  `upload_card_1` varchar(255) NOT NULL DEFAULT '0' COMMENT '身份证正面（ 图片路径 不存在时为0）',
  `upload_card_2` varchar(255) NOT NULL DEFAULT '0' COMMENT '身份证反面（ 图片路径 不存在时为0）',
  `upload_xiaopian` varchar(255) NOT NULL DEFAULT '0' COMMENT '小票（ 图片路径 不存在时为0）',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `payment_type` (`payment_type`),
  KEY `logistics_no` (`logistics_no`),
  KEY `batches_id` (`batches_id`) USING BTREE,
  KEY `import_id` (`import_id`) USING BTREE,
  KEY `userid` (`userid`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='导入订单表' AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `dferp_order`
--

