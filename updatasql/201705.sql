ALTER TABLE `dferp_fedex_pakge`
ADD COLUMN `run_status`  tinyint(1) NULL DEFAULT 0 COMMENT '0 未开启  1 正在运行中  2 运行完成' AFTER `fedex_service_type`




ALTER TABLE `dferp_fedex_pakge`
ADD COLUMN `uptime`  int NULL COMMENT '创建运单时间戳' AFTER `run_status`



ALTER TABLE `dferp_batches`
ADD COLUMN `confirm_status`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '确认状态' AFTER `post_date`;



2017/05091116/新增

ALTER TABLE `dferp_fedex_pakge`
ADD COLUMN `cost`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '成本费用' AFTER `uptime`,
ADD COLUMN `actual_cost`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '实收费用' AFTER `cost`



ALTER TABLE `dferp_order`
ADD COLUMN `is_assign_fee`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否指定 国外段运费 0不指定 1指定' AFTER `package_status`,
ADD COLUMN `assign_fee`  decimal(10,2) NULL DEFAULT 0.00 COMMENT '指定运费' AFTER `is_assign_fee`

ALTER TABLE `dferp_order`
MODIFY COLUMN `assign_fee`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '指定预估运费' AFTER `is_assign_fee`,
ADD COLUMN `assign_cost_fee`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '指定成本运费' AFTER `assign_fee`,
ADD COLUMN `assign_actual_fee`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '指定实收费用' AFTER `assign_cost_fee`


2017/05101451/新增

ALTER TABLE `dferp_order`
ADD COLUMN `abroad_currency`  varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '币种' AFTER `assign_actual_fee`

2017/05180919/新增

ALTER TABLE `dferp_fedex_pakge`
MODIFY COLUMN `fedex_weight`  decimal(8,3) NULL DEFAULT 0 COMMENT '重量' AFTER `fedex_recipient_uid`


ALTER TABLE `dferp_fedex_pakge`
MODIFY COLUMN `fedex_length`  decimal(10,2) NULL DEFAULT 0 COMMENT '长' AFTER `fedex_weight_unit`,
MODIFY COLUMN `fedex_height`  decimal(10,2) NULL DEFAULT 0 COMMENT '高' AFTER `fedex_length`,
MODIFY COLUMN `fedex_width`  decimal(10,2) NULL DEFAULT 0 COMMENT '宽' AFTER `fedex_height`,