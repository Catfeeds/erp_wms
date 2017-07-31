ALTER TABLE `dferp_sp_user` ADD `dutiesPayment_id` INT( 8 ) NOT NULL DEFAULT '0' COMMENT '清关账号' AFTER `end_addr_id` ;
ALTER TABLE `dferp_sp_user` ADD `payor_id` INT( 8 ) NOT NULL DEFAULT '0' COMMENT '运费支付账号' AFTER `dutiesPayment_id` ;
ALTER TABLE `dferp_fedex_user` CHANGE `billaccount` `account` INT( 9 ) NOT NULL DEFAULT '0' COMMENT '发货地必填';