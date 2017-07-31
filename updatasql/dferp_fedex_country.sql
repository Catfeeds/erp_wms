/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : 127.0.1.1:3306
Source Database       : zjh_product

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-04-18 17:03:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dferp_fedex_country
-- ----------------------------
DROP TABLE IF EXISTS `dferp_fedex_country`;
CREATE TABLE `dferp_fedex_country` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(64) DEFAULT NULL COMMENT '国家地区名',
  `c_flag` varchar(255) DEFAULT NULL COMMENT '国家地区简称',
  `is_destination` tinyint(1) DEFAULT NULL COMMENT '是否是目的地 1是  0 不是',
  `is_place_of_delivery` tinyint(1) DEFAULT NULL COMMENT '是否是始发地 1是  0 不是',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=372 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dferp_fedex_country
-- ----------------------------
INSERT INTO `dferp_fedex_country` VALUES ('101', '阿尔巴尼亚', 'AL', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('102', '阿尔及利亚', 'DZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('103', '阿富汗', 'AF', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('104', '阿根廷', 'AR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('105', '阿拉伯联合酋长国', 'AE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('106', '阿鲁巴', 'AW', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('107', '阿曼', 'OM', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('109', '阿塞拜疆', 'AZ', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('110', '埃及', 'EG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('111', '埃塞俄比亚', 'ET', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('112', '爱尔兰', 'IE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('113', '爱沙尼亚', 'EE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('114', '安道尔', 'AD', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('115', '安哥拉', 'AO', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('116', '安圭拉', 'AI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('117', '安提瓜', 'AG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('118', '奥地利', 'AT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('119', '澳大利亚', 'AU', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('120', '澳门', 'MO', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('121', '巴巴多斯', 'BB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('122', '巴布达', 'AG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('123', '巴布亚新几内亚', 'PG', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('124', '巴哈马', 'BS', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('125', '巴基斯坦', 'PK', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('126', '巴拉圭', 'PY', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('127', '巴勒斯坦', 'PS', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('128', '巴林', 'BH', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('129', '巴拿马', 'PA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('130', '巴西', 'BR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('131', '白俄罗斯', 'BY', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('132', '百慕大', 'BM', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('133', '保加利亚', 'BG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('134', '北爱尔兰', 'GB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('135', '北马里亚纳群岛', 'MP', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('136', '贝宁', 'BJ', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('137', '比利时', 'BE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('138', '秘鲁', 'PE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('139', '冰岛', 'IS', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('140', '波多黎各', 'PR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('141', '波兰', 'PL', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('142', '波斯尼亚和黑塞哥维那', 'BA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('143', '玻利维亚', 'BO', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('144', '伯利兹', 'BZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('145', '博茨瓦那', 'BW', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('146', '博内尔', 'BQ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('147', '不丹', 'BT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('148', '布基纳法索', 'BF', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('149', '布隆迪', 'BI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('150', '布韦岛', 'BV', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('151', '朝鲜', 'KP', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('152', '赤道几内亚', 'GQ', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('153', '大不列颠岛', 'GB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('154', '大多巴哥岛', 'VG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('155', '大开曼岛', 'KY', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('156', '大茅屋岛', 'VG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('157', '丹麦', 'DK', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('158', '德国', 'DE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('159', '东帝汶', 'TL', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('160', '多哥', 'TG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('161', '多米尼加', 'DM', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('162', '俄罗斯', 'RU', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('163', '厄瓜多尔', 'EC', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('164', '厄立特里亚', 'ER', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('165', '法国', 'FR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('166', '法罗群岛', 'FO', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('167', '法属波利尼西亚', 'PF', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('168', '法属圭亚那', 'GF', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('169', '法属南部领土', 'TF', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('170', '法属圣马丁', 'MF', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('171', '梵蒂冈', 'IT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('172', '菲律宾', 'PH', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('173', '斐济', 'FJ', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('174', '芬兰', 'FI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('175', '佛得角', 'CV', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('176', '福克兰群岛', 'FK', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('177', '冈比亚', 'GM', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('178', '刚果', 'CG', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('179', '刚果民主共和国', 'CD', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('180', '哥伦比亚', 'CO', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('181', '哥斯达黎加', 'CR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('182', '格林纳达', 'GD', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('183', '格陵兰岛', 'GL', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('184', '格鲁吉亚', 'GE', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('185', '古巴', 'CU', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('186', '瓜德罗普岛', 'GP', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('187', '关岛', 'GU', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('188', '圭亚那', 'GY', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('189', '哈萨克斯坦', 'KZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('190', '海地', 'HT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('192', '海峡群岛', 'GB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('193', '韩国', 'KR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('194', '荷兰', 'NL', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('195', '荷兰加勒比海属地', 'BQ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('196', '荷属圣马丁', 'SX', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('197', '赫德岛和麦克唐纳岛', 'HM', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('198', '黑山共和国', 'ME', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('199', '洪都拉斯', 'HN', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('200', '基里巴斯', 'KI', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('201', '吉布提', 'DJ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('202', '吉尔吉斯斯坦', 'KG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('203', '几内亚', 'GN', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('204', '几内亚比绍', 'GW', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('205', '加拿大', 'CA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('206', '加那利群岛', 'ES', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('207', '加纳', 'GH', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('208', '加蓬', 'GA', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('209', '柬埔寨', 'KH', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('210', '捷克共和国', 'CZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('211', '津巴布韦', 'ZW', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('212', '喀麦隆', 'CM', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('213', '卡塔尔', 'QA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('214', '开曼群岛', 'KY', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('215', '科科斯群岛', 'CC', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('216', '科摩罗', 'KM', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('217', '科特迪瓦', 'CI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('218', '科威特', 'KW', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('219', '克罗地亚', 'HR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('220', '肯尼亚', 'KE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('221', '库克群岛', 'CK', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('222', '库拉索', 'CW', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('223', '拉脱维亚', 'LV', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('224', '莱索托', 'LS', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('225', '老挝', 'LA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('226', '黎巴嫩', 'LB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('227', '立陶宛', 'LT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('228', '利比里亚', 'LR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('229', '利比亚', 'LY', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('230', '列支敦士登', 'LI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('231', '留尼汪岛', 'RE', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('232', '卢森堡', 'LU', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('233', '卢旺达', 'RW', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('234', '罗马尼亚', 'RO', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('235', '罗塔岛', 'MP', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('236', '马达加斯加', 'MG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('237', '马尔代夫', 'MV', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('238', '马耳他', 'MT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('239', '马拉维', 'MW', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('240', '马来西亚', 'MY', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('241', '马里', 'ML', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('242', '马其顿', 'MK', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('243', '马绍尔群岛', 'MH', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('244', '马提尼克岛', 'MQ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('245', '马约特岛', 'YT', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('246', '毛里求斯', 'MU', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('247', '毛里塔尼亚', 'MR', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('248', '美国', 'US', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('249', '美国本土外小岛屿', 'UM', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('250', '美属萨摩亚', 'AS', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('251', '美属维尔京群岛', 'VI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('252', '蒙古', 'MN', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('253', '蒙特塞拉特', 'MS', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('254', '孟加拉国', 'BD', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('255', '密克罗尼西亚', 'FM', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('256', '缅甸', '', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('257', '摩尔多瓦', 'MD', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('258', '摩洛哥', 'MA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('259', '摩纳哥', 'MC', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('260', '莫桑比克', 'MZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('261', '墨西哥', 'MX', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('262', '纳米比亚', 'NA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('263', '南非', 'ZA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('264', '南极洲', 'AQ', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('265', '南乔治亚和南桑威奇群岛', 'GS', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('266', '瑙鲁', 'NR', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('267', '尼泊尔', 'NP', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('268', '尼加拉瓜', 'NI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('269', '尼日尔', 'NE', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('270', '尼日利亚', 'NG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('271', '纽埃', 'NU', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('272', '挪威', 'NO', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('273', '诺福克岛', 'NF', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('274', '诺曼岛', 'VG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('275', '帕劳', 'PW', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('276', '皮特凯恩', 'PN', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('277', '葡萄牙', 'PT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('278', '日本', 'JP', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('279', '瑞典', 'SE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('280', '瑞士', 'CH', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('281', '萨尔瓦多', 'SV', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('282', '萨摩亚', 'WS', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('283', '塞班岛', 'MP', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('284', '塞尔维亚', 'RS', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('285', '塞拉利昂', 'SL', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('286', '塞内加尔', 'SN', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('287', '塞浦路斯', 'CY', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('288', '塞舌尔', 'SC', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('289', '沙巴岛', 'BQ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('290', '沙特阿拉伯', 'SA', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('291', '圣巴尔德勒米', 'GP', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('292', '圣诞岛', 'CX', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('293', '圣多美和普林西比', 'ST', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('294', '圣赫勒拿岛', 'SH', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('295', '圣基茨和尼维斯', 'KN', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('296', '圣克里斯托弗', 'KN', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('297', '圣克洛伊岛', 'VI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('298', '圣卢西亚', 'LC', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('299', '圣马力诺', 'IT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('300', '圣皮埃尔岛', 'PM', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('301', '圣托马斯', 'VI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('302', '圣文森特', 'VC', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('303', '圣尤斯特歇斯岛', 'BQ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('304', '圣约翰', 'VI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('305', '斯里兰卡', 'LK', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('306', '斯洛伐克共和国', 'SK', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('307', '斯洛文尼亚', 'SI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('308', '斯瓦尔巴岛和扬马延岛', 'SJ', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('309', '斯威士兰', 'SZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('310', '苏丹', 'SD', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('311', '苏格兰', 'GB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('312', '苏里南', 'SR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('313', '所罗门群岛', 'SB', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('314', '索马里', 'SO', '0', '1');
INSERT INTO `dferp_fedex_country` VALUES ('315', '塔吉克斯坦', 'TJ', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('316', '塔希提', 'PF', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('317', '台湾', 'TW', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('318', '泰国', 'TH', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('319', '坦桑尼亚', 'TZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('320', '汤加', 'TO', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('321', '特克斯和凯科斯群岛', 'TC', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('322', '特立尼达和多巴哥', 'TT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('323', '提尼安岛', 'MP', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('324', '突尼斯', 'TN', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('325', '图瓦卢', 'TV', '0', '1');
INSERT INTO `dferp_fedex_country` VALUES ('326', '土耳其', 'TR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('327', '土库曼斯坦', 'TM', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('328', '托尔托拉岛', 'VG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('329', '托克劳', 'TK', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('330', '瓦利斯和富图纳群岛', 'WF', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('331', '瓦努阿图', 'VU', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('332', '危地马拉', 'GT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('333', '威尔士', 'GB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('334', '委内瑞拉', 'VE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('335', '文莱', 'BN', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('336', '乌干达', 'UG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('337', '乌克兰', 'UA', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('338', '乌拉圭', 'UY', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('339', '乌兹别克斯坦', 'UZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('340', '西班牙', 'ES', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('341', '西撒哈拉', 'EH', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('342', '希腊', 'GR', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('343', '香港', 'HK', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('344', '新加坡', 'SG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('345', '新喀里多尼亚', 'NC', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('346', '新西兰', 'NZ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('347', '匈牙利', 'HU', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('348', '叙利亚', 'SY', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('349', '牙买加', 'JM', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('350', '亚美尼亚', '', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('351', '也门', 'YE', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('352', '伊拉克', 'IQ', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('353', '伊朗', 'IR', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('354', '以色列', 'IL', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('355', '意大利', 'IT', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('356', '印度', 'IN', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('357', '印度尼西亚', 'ID', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('358', '英格兰', 'GB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('359', '英国', 'GB', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('360', '英属维尔京群岛', 'VG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('361', '英属印度洋领地', 'IO', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('362', '尤宁岛', 'VC', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('363', '约旦', 'JO', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('364', '约斯特范代克岛', 'VG', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('365', '越南', 'VN', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('366', '赞比亚', 'ZM', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('367', '乍得', 'TD', '1', '0');
INSERT INTO `dferp_fedex_country` VALUES ('368', '直布罗陀', 'GI', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('369', '智利', 'CL', '1', '1');
INSERT INTO `dferp_fedex_country` VALUES ('370', '中非共和国', 'CF', '0', '0');
INSERT INTO `dferp_fedex_country` VALUES ('371', '中国', 'CN', '1', null);
