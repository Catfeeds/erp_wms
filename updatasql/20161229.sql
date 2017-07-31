ALTER TABLE `dferp_sp_user`
ADD COLUMN `huoyunzhan_id`  int NULL COMMENT '货运站商户id' AFTER `filing_kjt_type`


ALTER TABLE `dferp_batches`
ADD COLUMN `huoyunzhan_uid`  int NULL COMMENT '货运站用户id' AFTER `pallet_no`



ALTER TABLE `dferp_fedex_pakge`
ADD COLUMN `airport`  varchar(255) NULL COMMENT '机场/港口名称' AFTER `package_request_status`,
ADD COLUMN `flight_date`  date NULL COMMENT '航班日期' AFTER `airport`,
ADD COLUMN `flight_num`  varchar(255) NULL COMMENT '航班号' AFTER `flight_date`,
ADD COLUMN `pallet_no`  int NULL COMMENT '托盘编号' AFTER `flight_num`,
ADD COLUMN `ditan_num`  int NULL COMMENT '提单号' AFTER `pallet_no`


ALTER TABLE `dferp_fedex_pakge`
CHANGE COLUMN `flight_date` `flight_start_date`  date NULL DEFAULT NULL COMMENT '航班出发日期' AFTER `airport`,
ADD COLUMN `flight_end_date`  datetime NULL COMMENT '到港时间' AFTER `type`