ALTER TABLE `dferp_sp_user`
ADD COLUMN `fedex_currency`  varchar(4) NULL COMMENT '币种缩写' AFTER `fedex_account`,
ADD COLUMN `fedex_currency_id`  int(4) NULL COMMENT '币种id' AFTER `fedex_currency`