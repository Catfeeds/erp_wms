/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : 127.0.1.1:3306
Source Database       : zjh_product

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-02-21 10:08:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dferp_fedex_user
-- ----------------------------
DROP TABLE IF EXISTS `dferp_fedex_user`;
CREATE TABLE `dferp_fedex_user` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=发货方 2=国内 3=第三方',
  `personName` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `companyName` varchar(150) DEFAULT NULL COMMENT '公司',
  `phoneNumber` varchar(20) DEFAULT NULL COMMENT '电话号码',
  `Address_streetLines` varchar(60) DEFAULT NULL COMMENT '地址',
  `Address_City` varchar(50) DEFAULT NULL COMMENT '城市',
  `Address_StateOrProvinceCode` char(6) DEFAULT NULL COMMENT '城市缩写',
  `Address_PostalCode` varchar(6) DEFAULT NULL COMMENT '邮政编码',
  `Address_CountryCode` varchar(10) DEFAULT NULL COMMENT '国家编码缩写',
  `Address_Residential` enum('true','false') NOT NULL DEFAULT 'false' COMMENT '是否是居民区',
  `account` int(9) NOT NULL DEFAULT '0' COMMENT '发货地必填',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='收发人信息';

-- ----------------------------
-- Records of dferp_fedex_user
-- ----------------------------
INSERT INTO `dferp_fedex_user` VALUES ('1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'true', '0');
INSERT INTO `dferp_fedex_user` VALUES ('2', '1', '真实姓名', '公司', '13810004321', '1', '城市', '1', '1', '1', 'true', '0');
INSERT INTO `dferp_fedex_user` VALUES ('3', '1', 'james', 'abc.ltd', '13810004321', 'Warehouse B, No.628 Sui Ning Road', 'Shanghai', 'SH', '201106', 'CN', 'true', '0');
INSERT INTO `dferp_fedex_user` VALUES ('4', '2', 'Peter Pan', 'Toy Store', '(310) 832-6211', '18115 S Main Street', 'Gardena', 'CA', '90248', 'US', 'true', '2147483647');
INSERT INTO `dferp_fedex_user` VALUES ('5', '1', 'perter', 'pc.ltd', '123456', '18115 S Main Street', 'Gardena', 'CA', '90248', 'US', 'true', '510051408');
INSERT INTO `dferp_fedex_user` VALUES ('6', '3', 'David', 'ccc.ltd', '123456', '18115 S Main Street', 'Gardena', 'CA', '90248', 'CN', 'true', '510051408');
INSERT INTO `dferp_fedex_user` VALUES ('7', '3', 'aaa', 'aaaa.company', '12345678911', 'test street test', 'Shanghai', 'SH', '212000', 'CN', 'true', '2124511');
INSERT INTO `dferp_fedex_user` VALUES ('8', '1', 'Jack', 'abcompany', '123456789', '18115 S Main Street', 'Gardena', 'CA', '90248', 'US', 'false', '510051408');
INSERT INTO `dferp_fedex_user` VALUES ('9', '2', 'Tony', 'bbbcompany', '123456789', 'Warehouse B, No.628 Sui Ning Road', 'Shanghai', 'SH', '201106', 'CN', 'false', '510051408');
INSERT INTO `dferp_fedex_user` VALUES ('10', '3', 'tom', 'disanfangcompany', '123456789', 'big street', 'Gardena', 'CA', '90248', 'US', 'false', '510087968');
