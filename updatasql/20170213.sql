ALTER TABLE `dferp_fedex_pakge`
ADD COLUMN `fedex_package_type`  varchar(255) NULL COMMENT 'fedex包裹类型' AFTER `estimated_rate_currency`


ALTER TABLE `dferp_fedex_pakge`
ADD COLUMN `ship_timestamp`  int NULL COMMENT '指定包裹交给fedex的事件日期' AFTER `fedex_package_type`