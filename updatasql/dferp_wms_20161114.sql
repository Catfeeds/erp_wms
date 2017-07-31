--
-- 数据库: `zjh_product`
--

-- --------------------------------------------------------

--
-- 表的结构 `dferp_order_list`
--

CREATE TABLE IF NOT EXISTS `dferp_order_list` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` int(8) NOT NULL COMMENT '商户ID',
  `import_id` varchar(30) NOT NULL COMMENT '导入订单号',
  `stock_id` int(8) NOT NULL DEFAULT '0' COMMENT '商品编号',
  `order_id` int(8) NOT NULL COMMENT '订单表ID',
  `name` varchar(100) NOT NULL COMMENT '商品名称',
  `im_name` varchar(100) NOT NULL COMMENT '导入商品名称',
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品单价',
  `rate` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品税价',
  `weight` int(8) NOT NULL DEFAULT '0' COMMENT '重量（g）',
  `num` mediumint(8) unsigned NOT NULL DEFAULT '1' COMMENT ' 数量',
  `is_filing` tinyint(1) NOT NULL DEFAULT '-1' COMMENT '添加批次后选择关区是否备案（-1 待选择 1 已备案 2 未备案）',
  `abroad_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '国外段价格',
  `abroad_currency` varchar(3) NOT NULL COMMENT '币种',
  `abroad_weight` int(8) NOT NULL COMMENT '国外段重量',
  `abroad_weight_unit` varchar(2) NOT NULL COMMENT '重量单位（ kg=千克 lb=磅 ）',
  `name_en` varchar(100) NOT NULL COMMENT '导入英文名称',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='导入清单表（订单商品表）' AUTO_INCREMENT=86 ;