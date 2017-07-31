/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : 127.0.1.1:3306
Source Database       : zjh_product

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-02-21 13:49:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dferp_sp_user
-- ----------------------------
DROP TABLE IF EXISTS `dferp_sp_user`;
CREATE TABLE `dferp_sp_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user` varchar(30) NOT NULL COMMENT '登录帐号',
  `pass` varchar(32) NOT NULL COMMENT '登录密码',
  `act_pass` varchar(32) NOT NULL COMMENT '操作密码',
  `company` varchar(50) NOT NULL COMMENT '公司名称',
  `mobile` varchar(11) NOT NULL COMMENT '手机',
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（1 开启 2 关闭）',
  `addr_id` varchar(255) DEFAULT NULL COMMENT '仓库ID',
  `addr_name` varchar(255) DEFAULT NULL COMMENT '仓库名称',
  `en_addr` varchar(255) DEFAULT NULL COMMENT '国外计费地址',
  `send_addr_id` int(8) NOT NULL DEFAULT '0' COMMENT '发货地 ID',
  `end_addr_id` int(8) NOT NULL DEFAULT '0' COMMENT '国内收到点ID',
  `dutiesPayment_id` int(8) NOT NULL DEFAULT '0' COMMENT '清关账号',
  `payor_id` int(8) NOT NULL DEFAULT '0' COMMENT '运费支付账号',
  `filing_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '关区',
  `filing_kjt_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=行邮税 2=总额税',
  `huoyunzhan_uid` int(11) DEFAULT '0' COMMENT '货运站商户id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='供应商列表';

-- ----------------------------
-- Records of dferp_sp_user
-- ----------------------------
INSERT INTO `dferp_sp_user` VALUES ('15', 'jingfs', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'jingcompany111', '13526834708', '2016-12-29 09:57:36', '1', '1', '商户自发货fedex', 'shanghai', '5', '9', '10', '6', '1', '1', null);
INSERT INTO `dferp_sp_user` VALUES ('16', 'jingfsaaa', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'jingcompany', '13526834708', '2016-12-29 09:59:07', '1', '3', '运往货运站', 'shanghai', '0', '0', '0', '0', '1', '1', '17');
INSERT INTO `dferp_sp_user` VALUES ('17', 'jinjinjin', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'aaacompany', '13526834708', '2016-12-29 10:03:58', '1', '2', '货运站', 'gardera', '5', '9', '10', '6', '1', '1', null);
INSERT INTO `dferp_sp_user` VALUES ('19', 'jingjingjing1', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'dasda', '12345678901', '2016-12-29 11:39:08', '1', '3', '运往货运站', 'shanghai', '0', '0', '0', '0', '1', '1', '17');
