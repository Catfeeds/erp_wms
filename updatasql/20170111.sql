ALTER TABLE `dferp_fedex_pakge`
ADD COLUMN `estimated_rate_currency`  varchar(255) NULL COMMENT '预估费用货币单位' AFTER `estimated_rate`;


CREATE TABLE `dferp_fedex_package_rateinfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fedex_package_id` int(11) NOT NULL COMMENT 'fedex包裹id',
  `fee_item` varchar(50) DEFAULT NULL COMMENT '费用项',
  `fee_value` decimal(10,2) DEFAULT NULL,
  `surcharge_desc` varchar(255) DEFAULT NULL COMMENT '杂项描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;