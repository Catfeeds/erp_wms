ALTER TABLE `dferp_sp_user`
ADD COLUMN `fedex_account`  int(11) NULL AFTER `huoyunzhan_uid`

ALTER TABLE `dferp_fedex_user`
ADD COLUMN `Address_Country`  varchar(64) NULL COMMENT '国家地区' AFTER `fedex_account`