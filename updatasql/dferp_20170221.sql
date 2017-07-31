/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : 127.0.1.1:3306
Source Database       : zjh_product

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-02-21 09:44:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dferp_fedex_pakge_log
-- ----------------------------
DROP TABLE IF EXISTS `dferp_fedex_pakge_log`;
CREATE TABLE `dferp_fedex_pakge_log` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '返回内容',
  `time` datetime DEFAULT NULL COMMENT '时间',
  `pk_id` int(11) DEFAULT NULL COMMENT '包裹id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dferp_fedex_pakge_log
-- ----------------------------
INSERT INTO `dferp_fedex_pakge_log` VALUES ('14', '运单已确认', '2017-02-09 15:17:15', '41');
INSERT INTO `dferp_fedex_pakge_log` VALUES ('13', '运单已验证，未确认', '2017-02-09 15:17:11', '41');
INSERT INTO `dferp_fedex_pakge_log` VALUES ('11', '待创建运单', '2017-02-09 15:17:07', '41');
INSERT INTO `dferp_fedex_pakge_log` VALUES ('12', '创建运单成功，运单未验证', '2017-02-09 15:17:10', '41');
INSERT INTO `dferp_fedex_pakge_log` VALUES ('10', '待创建运单', '2017-02-09 15:16:06', '41');
INSERT INTO `dferp_fedex_pakge_log` VALUES ('15', '待创建运单', '2017-02-20 09:36:44', '55');
INSERT INTO `dferp_fedex_pakge_log` VALUES ('16', '创建运单成功，运单未验证', '2017-02-20 09:36:48', '55');
INSERT INTO `dferp_fedex_pakge_log` VALUES ('17', '验证运单失败错误码:6562错误信息:InternationalDetail CustomsValue - Invalid currency', '2017-02-20 09:36:49', '55');
