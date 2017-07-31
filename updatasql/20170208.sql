CREATE TABLE `dferp_package_status` (
`id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
`pk_id`  int NULL COMMENT '包裹id' ,
`status`  int NULL COMMENT '包裹状态' ,
`content`  varchar(255) NULL COMMENT '状态描述内容' ,
PRIMARY KEY (`id`)
)


CREATE TABLE `dferp_package_log` (
`id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
`pk_id`  int NULL COMMENT '包裹id' ,
`content`  varchar(255) NULL COMMENT '操作内容' ,
PRIMARY KEY (`id`)
)


ALTER TABLE `dferp_package_status`
MODIFY COLUMN `status`  int(11) NULL DEFAULT NULL COMMENT '包裹执行状态（1待取单 -1创建运单失败 2 已取单，未验证 -2 验证失败  3 已验证，未确认 -3 确认失败 4 已确认，未获取费率  -4 获取费率失败  5 已确认，且获取费率）' AFTER `pk_id`




ALTER TABLE `dferp_package_status`
MODIFY COLUMN `status`  int(11) NULL DEFAULT NULL COMMENT '包裹执行状态（1未取单 -1创建运单失败 2 已取单，未验证 -2 验证失败  3 已验证，未确认 -3 确认失败 4 已确认）' AFTER `pk_id`


ALTER TABLE `dferp_package_status`
ADD COLUMN `lock`  tinyint NULL COMMENT '0解锁 1锁死' AFTER `content`

ALTER TABLE `dferp_package_status`
MODIFY COLUMN `lock`  tinyint(4) NULL DEFAULT 0 COMMENT '0解锁 1锁死' AFTER `content`


ALTER TABLE `dferp_fedex_pakge_log`
MODIFY COLUMN `id`  int(8) UNSIGNED NOT NULL AUTO_INCREMENT FIRST ,
ADD COLUMN `pk_id`  int NULL COMMENT '包裹id' AFTER `time`