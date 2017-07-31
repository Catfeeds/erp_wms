ALTER TABLE `dferp_fedex_pakge`
ADD COLUMN `estimated_rate`  decimal(10,2) NULL DEFAULT 0.00 COMMENT '预估费率' AFTER `page_pid`;



CREATE TABLE `dferp_package_batches` (
`id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
`fedex_package_id`  int NULL ,
`batches_id`  int NULL ,
PRIMARY KEY (`id`)
)