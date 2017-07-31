ALTER TABLE `dferp_sp_product`
ADD COLUMN `recorder_apply_time`  datetime NOT NULL COMMENT '备案申请时间' AFTER `uptime`,
ADD COLUMN `recorder_status`  tinyint(2) NULL COMMENT '预计发货（备案紧急） 1->14天 2->30天 3 ->60天' AFTER `recorder_apply_time`,
ADD COLUMN `deadline`  datetime NULL COMMENT '截止日期  备案申请时间+ 预计发货日期' AFTER `recorder_status`