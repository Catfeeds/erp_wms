ALTER TABLE `dferp_sp_user` ADD `addr_id`   VARCHAR( 255 ) NULL DEFAULT NULL COMMENT '仓库ID' ;
ALTER TABLE `dferp_sp_user` ADD `addr_name` VARCHAR( 255 ) NULL DEFAULT NULL COMMENT '仓库名称' ;
ALTER TABLE `dferp_sp_user` ADD `en_addr`   VARCHAR( 255 ) NULL DEFAULT NULL COMMENT '国外计费地址' ;

CREATE TABLE IF NOT EXISTS `dferp_sp_addr` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `addr_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商列表' AUTO_INCREMENT=1 ;
