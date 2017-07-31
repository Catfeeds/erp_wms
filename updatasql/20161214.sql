ALTER TABLE `dferp_sp_user` ADD `send_addr_id` INT( 8 ) NOT NULL DEFAULT '0' COMMENT '发货地 ID' AFTER `filling_select` ;
ALTER TABLE `dferp_sp_user` ADD `end_addr_id` INT( 8 ) NOT NULL DEFAULT '0' COMMENT '国内收到点ID' AFTER `send_addr_id` ;
ALTER TABLE `dferp_sp_user` ADD `filing_type` TINYINT( 2 ) NOT NULL DEFAULT '0' COMMENT '关区' AFTER `end_addr_id` ;
ALTER TABLE `dferp_sp_user` ADD `filing_kjt_type` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '1=行邮税 2=总额税' AFTER `filing_type` ;
ALTER TABLE `dferp_fedex_user` ADD `billaccount` INT( 9 ) NOT NULL DEFAULT '0' COMMENT '发货地必填' AFTER `Address_Residential` ;
ALTER TABLE `dferp_fedex_user` ADD `dutyaccount` INT( 9 ) NOT NULL DEFAULT '0' COMMENT '发货地必填' AFTER `billaccount` ;