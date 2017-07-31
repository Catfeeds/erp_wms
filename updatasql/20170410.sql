ALTER TABLE `dferp_fedex_pakge`
MODIFY COLUMN `fedex_package_type`  varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'fedex包裹类型' AFTER `estimated_rate_currency`,
MODIFY COLUMN `ship_timestamp`  datetime NULL DEFAULT NULL COMMENT '指定包裹交给fedex的事件日期' AFTER `fedex_package_type`,
ADD COLUMN `fedex_service_type`  varchar(32) NULL AFTER `ship_timestamp`