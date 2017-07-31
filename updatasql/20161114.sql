ALTER TABLE `dferp_order` ADD `fedex_pakge_id` INT( 8 ) NOT NULL DEFAULT '0' AFTER `id` ;


CREATE TABLE IF NOT EXISTS `dferp_fedex_pakge` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` int(8) NOT NULL DEFAULT '0',
  `batches_id` int(8) NOT NULL DEFAULT '0' COMMENT '批次号',
  `fedex_index` varchar(12) NOT NULL DEFAULT '0' COMMENT 'fedex 主单号',
  `fedex_index_sqnumber` varchar(12) NOT NULL DEFAULT '0' COMMENT 'fedex 分单号',
  `fedex_shipper_uid` int(8) NOT NULL DEFAULT '0' COMMENT '发货人账号',
  `fedex_recipient_uid` int(8) NOT NULL DEFAULT '0' COMMENT '收货账号',
  `fedex_weight` float(10,2) DEFAULT NULL COMMENT '重量',
  `fedex_weight_unit` char(3) DEFAULT NULL COMMENT '重量单位',
  `fedex_length` int(10) DEFAULT NULL COMMENT '长',
  `fedex_height` int(10) DEFAULT NULL COMMENT '高',
  `fedex_width` int(10) DEFAULT NULL COMMENT '宽',
  `fedex_lwh_unit` char(3) DEFAULT NULL COMMENT '长宽高计量单位',
  `fedex_send_price` float(10,2) DEFAULT NULL COMMENT '推送前计费总计',
  `fedex_end_price` float(10,2) DEFAULT NULL COMMENT '推送后计费',
  `fedex_price_unit` float(10,2) DEFAULT NULL,
  `fedex_rate_con` text COMMENT '收费项目内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=未确认 2=已确认',
  PRIMARY KEY (`id`),
  KEY `fedex_index` (`fedex_index`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='包裹管理' AUTO_INCREMENT=1 ;
