
-- -----------------------------
-- Table structure for `admin`
-- -----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `ip` varchar(100) DEFAULT NULL COMMENT '登陆ip',
  `login_time` datetime DEFAULT NULL COMMENT '登陆时间',
  `role_id` int(10) DEFAULT NULL COMMENT '角色id',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- -----------------------------
-- Records of `admin`
-- -----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '::1', '2018-09-14 23:37:48', '1', '0');
INSERT INTO `admin` VALUES ('3', 'admin2', 'c84258e9c39059a89ab77d846ddab909', '127.0.0.1', '2017-09-27 09:29:51', '2', '0');
INSERT INTO `admin` VALUES ('4', 'wenan', 'e10adc3949ba59abbe56e057f20f883e', '', '0000-00-00 00:00:00', '3', '0');
INSERT INTO `admin` VALUES ('7', 'config', 'e10adc3949ba59abbe56e057f20f883e', '', '0000-00-00 00:00:00', '2', '0');

-- -----------------------------
-- Table structure for `admin_log`
-- -----------------------------
DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE `admin_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `admin_id` int(10) NOT NULL COMMENT '管理员id',
  `log_info` varchar(255) NOT NULL COMMENT '日志描述',
  `log_ip` varchar(50) NOT NULL COMMENT '日志ip',
  `log_time` int(11) NOT NULL COMMENT '日志日期',
  `log_url` varchar(255) NOT NULL COMMENT '时间地址',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='管理员日志';

-- -----------------------------
-- Records of `admin_log`
-- -----------------------------
INSERT INTO `admin_log` VALUES ('1', '1', '后台登录', '::1', '1524119388', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('2', '1', '后台登录', '::1', '1524120765', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('3', '1', '后台登录', '::1', '1524186284', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('4', '1', '后台登录', '::1', '1524211951', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('5', '1', '后台登录', '::1', '1524292027', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('6', '1', '后台登录', '::1', '1524452074', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('7', '1', '后台登录', '::1', '1524532707', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('8', '1', '后台登录', '192.168.2.110', '1524533281', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('9', '1', '后台登录', '192.168.2.199', '1524533996', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('10', '1', '后台登录', '192.168.2.110', '1524560091', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('11', '1', '后台登录', '::1', '1524618039', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('12', '1', '后台登录', '::1', '1524665905', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('13', '1', '后台登录', '::1', '1524666570', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('14', '1', '后台登录', '::1', '1524704849', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('15', '1', '后台登录', '::1', '1524791160', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('16', '1', '充值记录删除', '::1', '1524792592', '/public/admin.php/member/rechargedelete/id/4.html');
INSERT INTO `admin_log` VALUES ('17', '1', '后台登录', '::1', '1524880283', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('18', '1', '后台登录', '::1', '1525932321', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('19', '1', '后台登录', '::1', '1526365084', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('20', '1', '后台登录', '::1', '1526433600', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('21', '1', '后台登录', '::1', '1526466129', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('22', '1', '后台登录', '::1', '1526525123', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('23', '1', '后台登录', '::1', '1526609085', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('24', '1', '后台登录', '::1', '1526691870', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('25', '1', '后台登录', '::1', '1526864510', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('26', '1', '后台登录', '::1', '1526950677', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('27', '1', '后台登录', '::1', '1527061223', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('28', '1', '后台登录', '192.168.2.199', '1528185707', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('29', '1', '后台登录', '::1', '1528421491', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('30', '1', '后台登录', '::1', '1528852694', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('31', '1', '后台登录', '192.168.2.199', '1530004928', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('32', '1', '后台登录', '192.168.2.199', '1530069885', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('33', '1', '后台登录', '192.168.2.199', '1530148881', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('34', '1', '后台登录', '192.168.2.108', '1531211283', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('35', '1', '后台登录', '::1', '1531295443', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('36', '1', '后台登录', '192.168.2.199', '1531813890', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('37', '1', '后台登录', '192.168.2.199', '1531878278', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('38', '1', '后台登录', '192.168.2.199', '1531964897', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('39', '1', '余额调整删除', '::1', '1532762246', '/public/admin.php/member/balanceupdate.html');
INSERT INTO `admin_log` VALUES ('40', '1', '充值记录删除', '::1', '1532762356', '/public/admin.php/member/rechargedelete/id/73.html');
INSERT INTO `admin_log` VALUES ('41', '1', '后台登录', '192.168.2.104', '1534299760', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('42', '1', '后台登录', '::1', '1535615415', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('43', '1', '后台登录', '::1', '1535680862', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('44', '1', '后台登录', '::1', '1535811840', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('45', '1', '后台登录', '::1', '1535856545', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('46', '1', '后台登录', '::1', '1536574798', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('47', '1', '后台登录', '::1', '1536626239', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('48', '1', '后台登录', '::1', '1536657490', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('49', '1', '后台登录', '::1', '1536673166', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('50', '1', '后台登录', '::1', '1536722277', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('51', '1', '后台登录', '::1', '1536734050', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('52', '1', '后台登录', '::1', '1536808364', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('53', '1', '后台登录', '::1', '1536844760', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('54', '1', '后台登录', '::1', '1536890071', '/public/admin.php/admin/login.html');
INSERT INTO `admin_log` VALUES ('55', '1', '后台登录', '::1', '1536939468', '/public/admin.php/admin/login.html');

-- -----------------------------
-- Table structure for `admin_role`
-- -----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `role_name` varchar(50) NOT NULL COMMENT '角色名称',
  `role_description` varchar(100) NOT NULL COMMENT '角色描述',
  `right` varchar(255) NOT NULL COMMENT '权限列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- -----------------------------
-- Records of `admin_role`
-- -----------------------------
INSERT INTO `admin_role` VALUES ('1', '超级管理员', '超级管理员', '0');
INSERT INTO `admin_role` VALUES ('2', '系统设置', '网站基本设置管理和权限分配', '3,4,6');
INSERT INTO `admin_role` VALUES ('3', '网站编辑', '负责网站前台内容的编辑', '1,2,5');

-- -----------------------------
-- Table structure for `su_banner`
-- -----------------------------
DROP TABLE IF EXISTS `su_banner`;
CREATE TABLE `su_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL COMMENT '链接地址',
  `picture` varchar(200) NOT NULL COMMENT '图片',
  `name` varchar(100) NOT NULL COMMENT '图片名称',
  `order_id` decimal(6,0) NOT NULL DEFAULT '1000' COMMENT '排序id',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='广告图表';

-- -----------------------------
-- Records of `su_banner`
-- -----------------------------
INSERT INTO `su_banner` VALUES ('1', 'https://sujianbin.com', '/public/upload/banner/20180913/8ebe313061a1dba46e496bb802dbe54e.png', 'sujianbin blog', '1', '1');

-- -----------------------------
-- Table structure for `su_brand`
-- -----------------------------
DROP TABLE IF EXISTS `su_brand`;
CREATE TABLE `su_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(60) NOT NULL COMMENT '品牌名称',
  `order_id` decimal(6,0) NOT NULL DEFAULT '1000' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用0否1是',
  `logo` varchar(200) NOT NULL COMMENT 'logo',
  `description` varchar(200) DEFAULT NULL COMMENT '描述',
  `url` varchar(200) DEFAULT NULL COMMENT '品牌网址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='品牌表';


-- -----------------------------
-- Table structure for `su_cart`
-- -----------------------------
DROP TABLE IF EXISTS `su_cart`;
CREATE TABLE `su_cart` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车表',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `session_id` char(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'session',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_name` varchar(120) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `goods_num` smallint(5) unsigned DEFAULT '0' COMMENT '购买数量',
  `spec_key` varchar(64) DEFAULT '' COMMENT '商品规格key',
  `spec_key_name` varchar(64) DEFAULT '' COMMENT '商品规格组合名称',
  `selected` tinyint(1) DEFAULT '1' COMMENT '购物车选中状态',
  `add_time` int(11) DEFAULT '0' COMMENT '加入购物车的时间',
  `sku` varchar(128) DEFAULT '' COMMENT 'sku',
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `user_id` (`user_id`),
  KEY `goods_id` (`goods_id`),
  KEY `spec_key` (`spec_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物车表';


-- -----------------------------
-- Table structure for `su_category`
-- -----------------------------
DROP TABLE IF EXISTS `su_category`;
CREATE TABLE `su_category` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '父类id',
  `cat_name` varchar(200) DEFAULT NULL COMMENT '类别名称',
  `parent_id` int(10) DEFAULT '0',
  `class_id` int(5) DEFAULT '0' COMMENT '伪类id',
  `path_id` varchar(100) DEFAULT NULL COMMENT '路径',
  `cat_level` tinyint(1) DEFAULT '1' COMMENT '当前级别',
  `max_level` tinyint(1) DEFAULT '0' COMMENT '最大级别0不能添加-1无限制',
  `detail` text COMMENT '详细内容',
  `pic_list` varchar(5000) DEFAULT NULL COMMENT '多图片',
  `pic_list1` varchar(5000) DEFAULT NULL COMMENT '多图片',
  `cname` varchar(20) DEFAULT NULL COMMENT '别名',
  `seo_meta` text COMMENT '页面优化',
  `module_id` int(10) DEFAULT '0' COMMENT '模型id',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  `order_id` int(10) DEFAULT '1000' COMMENT '排序',
  `create_time` int(10) DEFAULT NULL COMMENT '发布时间',
  `picture` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '单图',
  `spec` varchar(50) DEFAULT NULL COMMENT '副标题',
  `controller` varchar(20) DEFAULT NULL COMMENT '控制器名称',
  `is_menu` int(1) DEFAULT '1' COMMENT '导航是否显示',
  `category_model` text COMMENT '类别存在字段',
  `content_model` text COMMENT '内容存在字段',
  `is_index` int(11) DEFAULT '0' COMMENT '是否推荐',
  `description` varchar(200) DEFAULT NULL COMMENT '简介',
  `file_url` varchar(200) DEFAULT NULL COMMENT '资料地址',
  `action_url` varchar(200) DEFAULT NULL COMMENT '跳转地址',
  `menu_icon` varchar(20) DEFAULT NULL COMMENT 'icon图标',
  `is_lock` int(1) DEFAULT '0' COMMENT '是否锁定',
  PRIMARY KEY (`cat_id`),
  KEY `module_id` (`module_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='类别表';

-- -----------------------------
-- Records of `su_category`
-- -----------------------------
INSERT INTO `su_category` VALUES ('1', '关于我们', '0', '0', ',0,', '1', '-1', '', '', '', '', 'a:3:{s:9:\"seo_title\";s:12:\"关于我们\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";}', '1', '1', '1', '', '', '', 'about', '1', ';dantu,picture,封面,图片建议大小100*100,;wenben,description,简述,;bianjiqiBaidu,detail,详细内容,', ',', '0', '', '', '', '', '1');
INSERT INTO `su_category` VALUES ('2', '经典案例', '0', '0', ',0,', '1', '0', '', '', '', '', 'a:3:{s:9:\"seo_title\";s:12:\"经典案例\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";}', '2', '1', '2', '', '', '', 'cases', '1', ';duotu,pic_list,相册,图片建议大小200*150,;bianjiqiBaidu,detail,详细内容,;riqi,create_time,发布日期,', ',', '0', '', '', '', '', '1');
INSERT INTO `su_category` VALUES ('3', '案例一', '2', '0', ',2,0,', '2', '0', '案例详情', '/public/upload/case/20180915/5be5c8d9b7f50ba49b62977ce0f54ca9.png;/public/upload/case/20180915/cb691db0f83c87838b35ed702006e8e3.png;/public/upload/case/20180915/ee72072ceb003f155d517b16bc12e181.png', '', '', 'a:3:{s:9:\"seo_title\";N;s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";}', '0', '1', '1000', '1536942373', '', '', '', '1', '', '', '0', '', '', '', '', '0');
INSERT INTO `su_category` VALUES ('4', '新闻中心', '0', '0', ',0,', '1', '-1', '', '', '', '', 'a:3:{s:9:\"seo_title\";s:12:\"新闻中心\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";}', '3', '1', '3', '', '', '', 'news', '1', ';biaoti,spec,标签,', ';dantu,picture,封面图,图片建议大小200*300,;bianjiqiBaidu,detail,详细内容,;riqi,create_time,发布日期,', '0', '', '', '', '', '1');
INSERT INTO `su_category` VALUES ('5', '国际新闻', '4', '0', ',4,0,', '2', '0', '', '', '', '', 'a:3:{s:9:\"seo_title\";N;s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";}', '0', '1', '1000', '1536942674', '', '国际', '', '1', '', '', '0', '', '', '', '', '0');
INSERT INTO `su_category` VALUES ('6', '公司新闻', '4', '0', ',4,0,', '2', '0', '', '', '', '', 'a:3:{s:9:\"seo_title\";N;s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";}', '0', '1', '1000', '1536942688', '', '国内', '', '1', '', '', '0', '', '', '', '', '0');

-- -----------------------------
-- Table structure for `su_comment`
-- -----------------------------
DROP TABLE IF EXISTS `su_comment`;
CREATE TABLE `su_comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '联系人',
  `address` varchar(200) DEFAULT NULL COMMENT '详细地址',
  `create_time` int(11) DEFAULT NULL COMMENT '咨询时间',
  `ip` varchar(50) DEFAULT NULL COMMENT '咨询ip',
  `title` varchar(200) DEFAULT NULL COMMENT '咨询标题',
  `content` varchar(500) DEFAULT NULL COMMENT '咨询内容',
  `phone` varchar(100) DEFAULT NULL COMMENT '联系电话',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='咨询表';

-- -----------------------------
-- Records of `su_comment`
-- -----------------------------
INSERT INTO `su_comment` VALUES ('1', 'sujianbin', '广东省惠州市', '1511080772', '127.0.0.1', '主题', '留言内容', '13266604379');

-- -----------------------------
-- Table structure for `su_config`
-- -----------------------------
DROP TABLE IF EXISTS `su_config`;
CREATE TABLE `su_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) DEFAULT NULL COMMENT '配置字段键值对',
  `value` varchar(500) DEFAULT NULL COMMENT '配置键值',
  `type` varchar(20) DEFAULT NULL COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='基本设置表';

-- -----------------------------
-- Records of `su_config`
-- -----------------------------
INSERT INTO `su_config` VALUES ('1', 'seo_title', 'sujianbin study', 'config');
INSERT INTO `su_config` VALUES ('2', 'seo_keywords', 'sujianbin study', 'config');
INSERT INTO `su_config` VALUES ('3', 'seo_description', 'sujianbin study', 'config');
INSERT INTO `su_config` VALUES ('4', 'address', '广东省惠州市惠城区', 'config');
INSERT INTO `su_config` VALUES ('5', 'phone', '132****4379', 'config');
INSERT INTO `su_config` VALUES ('6', 'email', 'sujianbin891547860@163.com', 'config');
INSERT INTO `su_config` VALUES ('7', 'copyright', '版权所有2017-2018', 'config');
INSERT INTO `su_config` VALUES ('8', 'other_code', '', 'config');
INSERT INTO `su_config` VALUES ('9', 'water_type', '1', 'water');
INSERT INTO `su_config` VALUES ('10', 'water_picture', '/public/upload/tmp/20180426\\1919095530822fbd93ee35196afbee56.png', 'water');
INSERT INTO `su_config` VALUES ('11', 'water_degree', '80', 'water');
INSERT INTO `su_config` VALUES ('12', 'water_quality', '100', 'water');
INSERT INTO `su_config` VALUES ('13', 'water_localtion', '9', 'water');
INSERT INTO `su_config` VALUES ('14', 'water_text', 'author：sujianbin', 'water');
INSERT INTO `su_config` VALUES ('15', 'water_size', '12', 'water');
INSERT INTO `su_config` VALUES ('16', 'water_color', '#fa0707', 'water');
INSERT INTO `su_config` VALUES ('17', 'logo', '/public/upload/tmp/20180913/e00bdd03ffc4b30c04a0332ddaf04f68.png', 'config');
INSERT INTO `su_config` VALUES ('18', 'ico', '/public/upload/tmp/20180426\\89f7665eea4c1e2dc9924d7807efec17.ico', 'config');
INSERT INTO `su_config` VALUES ('19', 'is_water', '0', 'water');
INSERT INTO `su_config` VALUES ('20', 'smtp_server', 'smtp.163.com', 'smtp');
INSERT INTO `su_config` VALUES ('21', 'smtp_port', '25', 'smtp');
INSERT INTO `su_config` VALUES ('22', 'smtp_name', '苏剑斌', 'smtp');
INSERT INTO `su_config` VALUES ('23', 'smtp_user', 'sujianbin891547860@163.com', 'smtp');
INSERT INTO `su_config` VALUES ('24', 'smtp_pwd', 'ESaVmRhfe5tlmpPh', 'smtp');
INSERT INTO `su_config` VALUES ('25', 'smtp_test_email', '891547860@qq.com', 'smtp');

-- -----------------------------
-- Table structure for `su_content`
-- -----------------------------
DROP TABLE IF EXISTS `su_content`;
CREATE TABLE `su_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL COMMENT '类别id',
  `cid` int(10) DEFAULT NULL COMMENT '一级类别',
  `path_id` varchar(100) DEFAULT NULL COMMENT '路径id',
  `title` varchar(200) DEFAULT NULL COMMENT '新闻标题',
  `detail` text COMMENT '新闻内容',
  `picture` varchar(255) DEFAULT NULL COMMENT '图片',
  `create_time` int(100) DEFAULT NULL COMMENT '发布时间',
  `pic_list` varchar(5000) DEFAULT NULL COMMENT '图片',
  `pic_list1` varchar(5000) DEFAULT NULL COMMENT '多图2',
  `is_index` int(2) DEFAULT '0' COMMENT '是否推荐',
  `is_indexs` int(2) DEFAULT '0' COMMENT '是否特荐为2级菜单',
  `seo_meta` text COMMENT '页面优化',
  `order_id` int(10) DEFAULT '1000' COMMENT '排序id',
  `is_show` int(2) DEFAULT '1' COMMENT '是否显示',
  `spec` varchar(100) DEFAULT NULL COMMENT '简短词组',
  `description` varchar(500) DEFAULT NULL COMMENT '简短描述',
  `click` int(10) DEFAULT '0' COMMENT '点击量',
  `file_url` varchar(255) DEFAULT NULL COMMENT '文件路径',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='详情表';

-- -----------------------------
-- Records of `su_content`
-- -----------------------------
INSERT INTO `su_content` VALUES ('1', '5', '4', ',5,4,0,', '新闻1', '详细内容', '/public/upload/news/20180915/89890e1f9fb4df6e34629d9c29e5fc43.png', '1536942693', '', '', '0', '0', 'a:3:{s:9:\"seo_title\";N;s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";}', '1000', '1', '', '', '0', '');

-- -----------------------------
-- Table structure for `su_goods`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods`;
CREATE TABLE `su_goods` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_name` varchar(200) NOT NULL COMMENT '商品名称',
  `cat_id` int(10) NOT NULL COMMENT '分类id',
  `goods_click` int(10) DEFAULT '0' COMMENT '点击次数',
  `brand_id` int(10) DEFAULT '0' COMMENT '品牌id',
  `store_count` smallint(5) NOT NULL DEFAULT '0' COMMENT '库存数量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品出售价',
  `cost_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `goods_detail` text COMMENT '商品详细描述',
  `goods_description` varchar(255) DEFAULT NULL COMMENT '商品简介',
  `goods_picture` varchar(500) DEFAULT NULL COMMENT '商品列表图',
  `goods_image` varchar(2000) DEFAULT NULL COMMENT '商品库图集',
  `is_sale` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否上架1是0否',
  `order_id` decimal(6,0) NOT NULL DEFAULT '1000' COMMENT '排序',
  `create_time` int(11) NOT NULL COMMENT '发布日期',
  `is_index` tinyint(1) DEFAULT '0' COMMENT '是否推荐1是0否',
  `update_time` int(11) NOT NULL COMMENT '最后更新时间',
  `goods_model` smallint(5) NOT NULL COMMENT '所属模型',
  `goods_spec` int(5) DEFAULT NULL COMMENT '规格项',
  `is_new` tinyint(1) DEFAULT '0' COMMENT '是否新品',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- -----------------------------
-- Records of `su_goods`
-- -----------------------------
INSERT INTO `su_goods` VALUES ('1', '小米手机', '1', '0', '0', '8000', '150.00', '0.00', '2121', '111', '/public/upload/goods/20180521/17671f889b9fbfecf766b64e96182422.png', '/public/upload/goods/20180521/c9e95c61a33067f245fc2fba777dc4bd.jpg;/public/upload/goods/20180521/53057e1d49764f353924f09c9ed0ee8d.jpg;/public/upload/goods/20180521/26128436953a4985da1417894377445e.jpg', '1', '1', '1526957598', '1', '1526957598', '1', '0', '0');
INSERT INTO `su_goods` VALUES ('2', '苹果', '3', '0', '0', '300', '4900.00', '0.00', '11', '11', '/public/upload/goods/20180521/6179d6de42b18ab621f28ea1bd005bb8.jpg', '/public/upload/goods/20180521/492301cfdcd2e3c706e6b2b76718c24c.gif;/public/upload/goods/20180521/f8fc7950e6c1a6a8b581640814c53648.jpg;/public/upload/goods/20180521/cb1eaef26a377cabfb5b63b558b8d63e.jpg;/public/upload/goods/20180521/f68f2a71b6f82e0264e5481ddd7bb27f.jpg', '1', '2', '1526957598', '1', '1526957598', '1', '', '0');
INSERT INTO `su_goods` VALUES ('3', 'Apple iPhone 6s Plus 16G 玫瑰金 移动联通电信4G手机', '3', '0', '0', '335', '6007.00', '0.00', '&lt;img src=&quot;http://localhost:83/public/upload/goods/2016/03-09/56e01a6586cd0.jpg&quot; title=&quot;4.jpg&quot; style=&quot;text-align: center; white-space: normal;&quot;/&gt;', '选择【联通合约机0元购机】，购机款仅需4066\r\n选择【移动合约机】，锯惠5588，不换号，购机入网返高额话费~\r\n选【电信合约机】，买手机送话费！激活到账100元，实付低至29元/月，月享4GB大流量', '/public/upload/goods/20180521/52f5d0952af9ed0f9fc95e4a44ce3f68.jpg', '/public/upload/goods/20180521/8315eb2e0f7f6c7d410d32ab68132e7c.jpg;/public/upload/goods/20180521/96b98dee29db9b2bba48a0520b9c4de8.jpg;/public/upload/goods/20180521/d598483daff07237c4165b2509962308.jpg;/public/upload/goods/20180521/5e384d7110fbe65901d23b66ecfbd863.jpg', '1', '3', '1526957672', '1', '1526957672', '1', '', '1');

-- -----------------------------
-- Table structure for `su_goods_attr`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_attr`;
CREATE TABLE `su_goods_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品属性id自增',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `attr_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '属性id',
  `attr_value` text NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='商品属性值表';

-- -----------------------------
-- Records of `su_goods_attr`
-- -----------------------------
INSERT INTO `su_goods_attr` VALUES ('22', '1', '3', '联通，电信，移动');
INSERT INTO `su_goods_attr` VALUES ('24', '2', '1', '4G');
INSERT INTO `su_goods_attr` VALUES ('21', '1', '2', '安卓');
INSERT INTO `su_goods_attr` VALUES ('20', '1', '1', '4G');
INSERT INTO `su_goods_attr` VALUES ('23', '1', '4', '支持nfc');
INSERT INTO `su_goods_attr` VALUES ('25', '2', '2', '苹果');
INSERT INTO `su_goods_attr` VALUES ('26', '2', '3', '移动');
INSERT INTO `su_goods_attr` VALUES ('27', '2', '4', '不支持nfc');
INSERT INTO `su_goods_attr` VALUES ('28', '3', '1', '4G');
INSERT INTO `su_goods_attr` VALUES ('29', '3', '2', 'IOS');
INSERT INTO `su_goods_attr` VALUES ('30', '3', '3', '联通，电信，移动');
INSERT INTO `su_goods_attr` VALUES ('31', '3', '4', 'FDD-LTE (频段 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 18, 19, 20, 25, 26, 27, 28, 29)');

-- -----------------------------
-- Table structure for `su_goods_attribute`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_attribute`;
CREATE TABLE `su_goods_attribute` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `attr_name` varchar(50) NOT NULL,
  `model_id` smallint(5) NOT NULL COMMENT '属性id',
  `attr_search` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否检索1是0否',
  `attr_input_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '输入方式0手动1列表选择2多行文本',
  `attr_values` text COMMENT '属性可选择列表',
  `order_id` decimal(6,0) NOT NULL DEFAULT '1000' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='商品属性表';

-- -----------------------------
-- Records of `su_goods_attribute`
-- -----------------------------
INSERT INTO `su_goods_attribute` VALUES ('1', '内存容量', '1', '1', '1', '4G\r\n8G\r\n16G\r\n32G\r\n64G\r\n128G\r\n256G', '1');
INSERT INTO `su_goods_attribute` VALUES ('2', '操作系统', '1', '1', '0', '', '2');
INSERT INTO `su_goods_attribute` VALUES ('3', '数据业务', '1', '0', '0', '', '3');
INSERT INTO `su_goods_attribute` VALUES ('4', '其他参数', '1', '1', '2', '', '4');
INSERT INTO `su_goods_attribute` VALUES ('5', '容量', '2', '1', '1', '100ml\r\n200ml', '1000');

-- -----------------------------
-- Table structure for `su_goods_category`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_category`;
CREATE TABLE `su_goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(90) NOT NULL COMMENT '分类名称',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '父类id',
  `path_id` varchar(255) NOT NULL COMMENT '路径id',
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分类级别',
  `order_id` decimal(6,0) NOT NULL COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用0否1是',
  `is_index` tinyint(1) DEFAULT '0' COMMENT '是否推荐0否1是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- -----------------------------
-- Records of `su_goods_category`
-- -----------------------------
INSERT INTO `su_goods_category` VALUES ('1', '电脑、办公', '0', ',0,', '1', '1', '1', '0');
INSERT INTO `su_goods_category` VALUES ('2', '手机 、 数码 、 通信', '1', ',1,0,', '2', '2', '1', '0');
INSERT INTO `su_goods_category` VALUES ('3', '手机', '2', ',2,1,0,', '3', '3', '1', '0');
INSERT INTO `su_goods_category` VALUES ('4', '手机配件', '2', ',2,1,0,', '3', '4', '1', '0');

-- -----------------------------
-- Table structure for `su_goods_collect`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_collect`;
CREATE TABLE `su_goods_collect` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `member_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品收藏表';


-- -----------------------------
-- Table structure for `su_goods_model`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_model`;
CREATE TABLE `su_goods_model` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) DEFAULT NULL COMMENT '模型名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品模型';

-- -----------------------------
-- Records of `su_goods_model`
-- -----------------------------
INSERT INTO `su_goods_model` VALUES ('1', '手机');
INSERT INTO `su_goods_model` VALUES ('2', '香水');
INSERT INTO `su_goods_model` VALUES ('3', '国画');
INSERT INTO `su_goods_model` VALUES ('4', '酒水');

-- -----------------------------
-- Table structure for `su_goods_rush_buy`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_rush_buy`;
CREATE TABLE `su_goods_rush_buy` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '活动标题',
  `goods_id` int(10) NOT NULL COMMENT '参团商品ID',
  `item_id` bigint(20) DEFAULT '0' COMMENT '商品规格id',
  `price` float(10,2) NOT NULL COMMENT '活动价格',
  `goods_num` int(10) DEFAULT '1' COMMENT '商品参加活动数',
  `buy_limit` int(11) NOT NULL DEFAULT '1' COMMENT '每人限购数',
  `buy_num` int(11) NOT NULL DEFAULT '0' COMMENT '已购买人数',
  `order_num` int(10) DEFAULT '0' COMMENT '已下单数',
  `description` text COMMENT '活动描述',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `is_end` tinyint(1) DEFAULT '0' COMMENT '是否已结束',
  `goods_name` varchar(255) DEFAULT NULL COMMENT '商品名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='商品促销表';

-- -----------------------------
-- Records of `su_goods_rush_buy`
-- -----------------------------
INSERT INTO `su_goods_rush_buy` VALUES ('13', '苹果抢购', '105', '173', '3000', '10', '1', '0', '0', '数量有限欢迎参加', '1526947200', '1526954400', '0', '原封国行【优惠套餐】Apple/苹果 iPhone 6s 4.7英寸 4G手机网络:4G 内存:16G 颜色:玫瑰金');
INSERT INTO `su_goods_rush_buy` VALUES ('12', 'Canon/佳能 EOS 700D套机', '126', '0', '3200', '10', '1', '0', '0', 'Canon/佳能 EOS 700D套机（18-55mm)数码单反相机 苏宁易购', '1486787160', '1527004740', '0', 'Canon/佳能 EOS 700D套机（18-55mm)数码单反相机 苏宁易购');
INSERT INTO `su_goods_rush_buy` VALUES ('10', '三星 Galaxy A9高配版 (A9100) 精灵黑 全网通4G手机 双卡双待', '141', '0', '3400', '100', '10', '0', '0', '三星 Galaxy A9高配版 (A9100) 精灵黑 全网通4G手机 双卡双待', '1486454400', '1517997600', '0', '三星 Galaxy A9高配版 (A9100) 精灵黑 全网通4G手机 双卡双待');
INSERT INTO `su_goods_rush_buy` VALUES ('9', '靓号0元送广东联通4G/3G手机卡上网卡', '136', '0', '50', '50', '3', '0', '0', '', '1486454400', '1517997600', '0', '靓号0元送广东联通4G/3G手机卡上网卡大流量套餐全国无漫游选号');
INSERT INTO `su_goods_rush_buy` VALUES ('11', '520闪购', '119', '0', '59', '50', '1', '0', '0', '电视广告的风格', '1501689600', '1581156000', '0', '小米旗舰店正品手机平板通用迷你充电宝 移动电源10000毫安大容量');

-- -----------------------------
-- Table structure for `su_goods_spec`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_spec`;
CREATE TABLE `su_goods_spec` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `spec_name` varchar(50) NOT NULL COMMENT '规格名称',
  `model_id` int(10) NOT NULL COMMENT '模型id',
  `order_id` decimal(6,0) NOT NULL DEFAULT '1000' COMMENT '排序',
  `spec_search` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否检索0否1是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品规格项表';

-- -----------------------------
-- Records of `su_goods_spec`
-- -----------------------------
INSERT INTO `su_goods_spec` VALUES ('1', '网络', '1', '1', '1');
INSERT INTO `su_goods_spec` VALUES ('2', '颜色', '1', '2', '1');
INSERT INTO `su_goods_spec` VALUES ('3', '内存容量', '1', '1000', '1');

-- -----------------------------
-- Table structure for `su_goods_spec_image`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_spec_image`;
CREATE TABLE `su_goods_spec_image` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_id` int(10) NOT NULL COMMENT '商品id',
  `goods_image_id` int(10) NOT NULL COMMENT '规格item id',
  `goods_image_url` varchar(500) NOT NULL COMMENT '图片路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='规格图像表';

-- -----------------------------
-- Records of `su_goods_spec_image`
-- -----------------------------
INSERT INTO `su_goods_spec_image` VALUES ('6', '3', '4', '/public/upload/goods/20180521/175b184e36cb24e3babce7d3faeb8c06.jpg');
INSERT INTO `su_goods_spec_image` VALUES ('5', '1', '6', '/public/upload/goods/20180519\\6591251c6954094cb3d4a56cc7b38882.png');
INSERT INTO `su_goods_spec_image` VALUES ('4', '1', '5', '/public/upload/goods/20180519\\ab935626d1305644eb420ac7f6d83c56.png');
INSERT INTO `su_goods_spec_image` VALUES ('7', '3', '7', '/public/upload/goods/20180521/e6742e667966788c9f5d65c9c8db5175.jpg');
INSERT INTO `su_goods_spec_image` VALUES ('8', '3', '8', '/public/upload/goods/20180521/b277f619e4801db7a90d22fa8e7542cf.jpg');

-- -----------------------------
-- Table structure for `su_goods_spec_item`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_spec_item`;
CREATE TABLE `su_goods_spec_item` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `spec_id` int(10) NOT NULL COMMENT '规格id',
  `value` varchar(50) NOT NULL COMMENT '规格值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='规格对应值表';

-- -----------------------------
-- Records of `su_goods_spec_item`
-- -----------------------------
INSERT INTO `su_goods_spec_item` VALUES ('1', '1', '3G');
INSERT INTO `su_goods_spec_item` VALUES ('2', '1', '4G');
INSERT INTO `su_goods_spec_item` VALUES ('4', '2', '黑色');
INSERT INTO `su_goods_spec_item` VALUES ('5', '2', '白色');
INSERT INTO `su_goods_spec_item` VALUES ('6', '2', '金色');
INSERT INTO `su_goods_spec_item` VALUES ('7', '2', '银色');
INSERT INTO `su_goods_spec_item` VALUES ('8', '2', '玫瑰金');
INSERT INTO `su_goods_spec_item` VALUES ('9', '1', '5G');
INSERT INTO `su_goods_spec_item` VALUES ('10', '3', '16G');
INSERT INTO `su_goods_spec_item` VALUES ('11', '3', '32G');
INSERT INTO `su_goods_spec_item` VALUES ('12', '3', '64G');
INSERT INTO `su_goods_spec_item` VALUES ('13', '3', '128G');
INSERT INTO `su_goods_spec_item` VALUES ('14', '3', '256G');

-- -----------------------------
-- Table structure for `su_goods_spec_price`
-- -----------------------------
DROP TABLE IF EXISTS `su_goods_spec_price`;
CREATE TABLE `su_goods_spec_price` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_id` int(10) NOT NULL COMMENT '产品id',
  `key` varchar(255) DEFAULT NULL COMMENT '规格键名',
  `key_name` varchar(255) DEFAULT NULL COMMENT '规格键名对应值',
  `price` decimal(10,2) DEFAULT NULL COMMENT '商品价格',
  `store_count` int(10) DEFAULT NULL COMMENT '库存',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `key` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='商品规格价格表';

-- -----------------------------
-- Records of `su_goods_spec_price`
-- -----------------------------
INSERT INTO `su_goods_spec_price` VALUES ('5', '1', '1#5#11', '网络:3G 颜色:白色 内存容量:32G', '1200.00', '1000');
INSERT INTO `su_goods_spec_price` VALUES ('6', '1', '1#5#12', '网络:3G 颜色:白色 内存容量:64G', '1500.00', '1000');
INSERT INTO `su_goods_spec_price` VALUES ('7', '1', '1#6#11', '网络:3G 颜色:金色 内存容量:32G', '1200.00', '1000');
INSERT INTO `su_goods_spec_price` VALUES ('8', '1', '1#6#12', '网络:3G 颜色:金色 内存容量:64G', '1500.00', '1000');
INSERT INTO `su_goods_spec_price` VALUES ('9', '1', '2#5#11', '网络:4G 颜色:白色 内存容量:32G', '2000.00', '1000');
INSERT INTO `su_goods_spec_price` VALUES ('10', '1', '2#5#12', '网络:4G 颜色:白色 内存容量:64G', '2500.00', '1000');
INSERT INTO `su_goods_spec_price` VALUES ('11', '1', '2#6#11', '网络:4G 颜色:金色 内存容量:32G', '2200.00', '1000');
INSERT INTO `su_goods_spec_price` VALUES ('12', '1', '2#6#12', '网络:4G 颜色:金色 内存容量:64G', '2700.00', '1000');
INSERT INTO `su_goods_spec_price` VALUES ('13', '2', '6#9#12', '颜色:金色 网络:5G 内存容量:64G', '4900.00', '100');
INSERT INTO `su_goods_spec_price` VALUES ('14', '2', '8#9#12', '颜色:玫瑰金 网络:5G 内存容量:64G', '5100.00', '200');
INSERT INTO `su_goods_spec_price` VALUES ('15', '3', '2#4#13', '网络:4G 颜色:黑色 内存容量:128G', '6008.00', '105');
INSERT INTO `su_goods_spec_price` VALUES ('16', '3', '2#7#13', '网络:4G 颜色:银色 内存容量:128G', '5808.00', '110');
INSERT INTO `su_goods_spec_price` VALUES ('17', '3', '2#8#13', '网络:4G 颜色:玫瑰金 内存容量:128G', '6208.00', '120');

-- -----------------------------
-- Table structure for `su_link`
-- -----------------------------
DROP TABLE IF EXISTS `su_link`;
CREATE TABLE `su_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '连接名',
  `url` varchar(150) NOT NULL COMMENT '链接地址',
  `order_id` decimal(6,0) NOT NULL DEFAULT '1000' COMMENT '排序id',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- -----------------------------
-- Records of `su_link`
-- -----------------------------
INSERT INTO `su_link` VALUES ('1', '苏剑斌', 'https://sujianbin.com', '1', '1');
INSERT INTO `su_link` VALUES ('4', '虎三网络', 'https://www.husan.com.cn', '2', '1');

-- -----------------------------
-- Table structure for `su_member`
-- -----------------------------
DROP TABLE IF EXISTS `su_member`;
CREATE TABLE `su_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '昵称',
  `realname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '真是姓名',
  `openid` varchar(64) DEFAULT NULL COMMENT '微信openid',
  `head` varchar(255) DEFAULT NULL COMMENT '会员头像',
  `invite_id` int(10) DEFAULT '0' COMMENT '邀请人id',
  `balance` decimal(10,2) DEFAULT '0.00' COMMENT '用户余额',
  `recharge` decimal(10,2) DEFAULT '0.00' COMMENT '总充值金额',
  `phone` varchar(11) DEFAULT NULL COMMENT '手机号码',
  `paypwd` varchar(64) DEFAULT NULL COMMENT '支付密码',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `province` varchar(50) DEFAULT NULL COMMENT '所在省份',
  `city` varchar(50) DEFAULT NULL COMMENT '所在城市',
  `m_name` varchar(50) DEFAULT NULL COMMENT '收货人',
  `m_phone` varchar(50) DEFAULT NULL COMMENT '收货联系电话',
  `m_address` varchar(200) DEFAULT NULL COMMENT '收货地区',
  `m_address_info` varchar(200) DEFAULT NULL COMMENT '收货详细地址',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '持卡人',
  `bank_card` varchar(100) DEFAULT NULL COMMENT '银行卡号',
  `bank_type` varchar(50) DEFAULT NULL COMMENT '卡类型',
  `bank_phone` varchar(11) DEFAULT NULL COMMENT '银行卡手机号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- -----------------------------
-- Records of `su_member`
-- -----------------------------
INSERT INTO `su_member` VALUES ('1', '苏剑斌', '苏剑斌', 'ogYE0xPwxN5wRDTIkSaKf9RGxZtc', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKeyUbjNDMwq9sGXGRKKG5cwrZ4yYSrlKJn44XFVaicOQIiaW63UTqZgopznziaexcTfCbEyTibmWnwuQ/132', '4', '92799.00', '0.07', '', 'e10adc3949ba59abbe56e057f20f883e', '1528883640', '891547860@qq.com', '广东', '深圳', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '苏剑斌', '622700060090172788', '建设银行', '13266604379');
INSERT INTO `su_member` VALUES ('2', '陈展涛', '陈展涛', 'ogYE0xMLVOiSjsBvmmkE-ZsGUzXE', 'http://thirdwx.qlogo.cn/mmopen/vi_32/AdBrteV1ab7uw6Iesq00ic9tdBcl0iaTB5nicjfUSchfLtNjfyFmiausHSicXGTyoPwe8hwxhqW5ibjMCVDaxN3banwQ/132', '1', '100.00', '0.00', '', '', '1529063245', '', '', '', '陈曦', '13802872071', '深圳宝安', '广兴源互联网产业基地', '', '', '', '');
INSERT INTO `su_member` VALUES ('3', '海波Haibo', '海波Haibo', 'ogYE0xBr7fxUmfyobXYO_vEKN-Bw', 'http://thirdwx.qlogo.cn/mmopen/vi_32/lsYr43Q7micnNZzCAwmibvBGn6my4bbwbJaPHrNmjLhM999ib6Xib7wlUSReQ0dia3IsyhzVzXG3iag2FSJ8nr3vfTuw/132', '0', '0.00', '0.00', '', '', '1529333804', '', '', '', '陈生', '18588267009', '广东', '努力', '张三', '4000588000154545', '中国银行', '18588267009');
INSERT INTO `su_member` VALUES ('4', 'lyq', 'lyq', 'ogYE0xLpLaHcaAk6HSsRh_smVk58', 'http://thirdwx.qlogo.cn/mmopen/vi_32/wv67xrZEKIgt1e07yWHua1eUr3ke8nBZbB7x8sZrEsEAfW3kJOPtqd2ObLTDjEx2txia9yf1ciawR9mAHrR2a2TA/132', '1', '100.00', '0.00', '', '', '1529384776', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `su_member` VALUES ('5', '袁俊', '袁俊', 'ogYE0xBT4BMht8DkjaV7udLrCs20', 'http://thirdwx.qlogo.cn/mmopen/vi_32/xJc5f5Wqy75nw7UliaKdWqmX6dXftic8j7F1exHn6PbrdbQA2OBRkdxaB1EzJd6TiaawXJGE5gntdXO8UAErVDkRw/132', '0', '0.00', '0.00', '', '', '1529406429', '', '', '', '袁俊', '18607559625', '深圳福田', '赛格广场', '袁俊', '4392260807895733', '招商银行', '18607559625');
INSERT INTO `su_member` VALUES ('6', '陈小卷哈 ^_^', '陈小卷哈 ^_^', 'ogYE0xJurCTulZbFd--4qFmeUmKk', 'http://thirdwx.qlogo.cn/mmopen/vi_32/oSHBQNvvYrH93jYP25q4K1SD69GW9uPd8j00icMaia6KicW9rIuXcZDchgc2t6vmojGjc6pKibpf7mK7JYytJSibDHA/132', '0', '0.00', '0.00', '', '', '1529458023', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `su_member` VALUES ('7', 'Aolong', 'Aolong', 'ogYE0xI4_ACyXQZUajNrOI2riTnc', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJ3LOTyxeSQ6j3ib2VzjBsX1fpheZHKLu3E2c8ZdYDgaECPvrlrrlaSTPnYM3rqyqT6WoEFVOxWDog/132', '0', '0.00', '0.00', '', '', '1529458201', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `su_member` VALUES ('8', '马正明', '马正明', 'ogYE0xA-rIAqmcRcQQTNeQzCpp0A', 'http://thirdwx.qlogo.cn/mmopen/vi_32/L2TQ8yG4E4bxfPcT1SR8fkq47eq98DweRfdib83Jofq6oeMGgKSJxpD05rzjEbib7IuoyverxFXW5RJAFbJ1weGQ/132', '0', '0.00', '0.00', '', '', '1529476383', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `su_member` VALUES ('13', '邢志刚', '邢志刚', 'ogYE0xBfiV8Zc5Wb48psCFi9iTlA', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ACwHWEIHbew8KNdPtiaIdYgFCMDKwQkFAKbYzet5DkLyvRzJbVMGTryzzOucoE9Ydfx3EhgMeiasPOy8nRorEoHQ/132', '0', '0.00', '0.00', '', '', '1530164538', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `su_member` VALUES ('14', 'Gyct-小飞', 'Gyct-小飞', 'ogYE0xBT61UhEXqlvnPD7G1gIiJQ', 'http://thirdwx.qlogo.cn/mmopen/vi_32/IAB6HpiccflHCRldErGUA5qUhR7U0qNxvuZsqogEz6MfkYb2eCcTEz7HdT79SsZgeokM4yQygjyToPKYBqYKflw/132', '0', '0.00', '0.00', '', '', '1530166956', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `su_member` VALUES ('15', '鑫蚂蚁财税', '鑫蚂蚁财税', 'ogYE0xEykbYKpPvtTadxTvPuG-as', 'http://thirdwx.qlogo.cn/mmopen/vi_32/oPlbITrZcaXrTuEZRTpIv4e8x86YTOPGWePPkZGz98ELsND401uzR6gZ9xFuWB1I8mpAwvsZdSobUa5HOsdlaQ/132', '5', '0.00', '0.00', '', '', '1530167228', '', '', '', '', '', '', '', '', '', '', '');

-- -----------------------------
-- Table structure for `su_member_income`
-- -----------------------------
DROP TABLE IF EXISTS `su_member_income`;
CREATE TABLE `su_member_income` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `member_id` int(10) DEFAULT NULL COMMENT '会员ID',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '金额',
  `title` varchar(100) DEFAULT NULL COMMENT '收益主题',
  `orders_id` int(10) DEFAULT NULL COMMENT '订单id',
  `type` tinyint(1) DEFAULT '1' COMMENT '1表示收入2表示支出',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否预售益1是2否',
  `is_deal` tinyint(1) DEFAULT '0' COMMENT '提现处理0未处理1已处理',
  `create_time` int(11) DEFAULT NULL COMMENT '创建日期',
  `goods_id` int(10) DEFAULT NULL COMMENT '关联产品',
  `picture` varchar(255) DEFAULT NULL COMMENT '凭证图',
  `bank_type` varchar(50) DEFAULT NULL COMMENT '银行类别',
  `bank_name` varchar(100) DEFAULT NULL COMMENT '持卡人',
  `bank_card` varchar(100) DEFAULT NULL COMMENT '银行卡号',
  `bank_phone` varchar(50) DEFAULT NULL COMMENT '手机号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='收益表';

-- -----------------------------
-- Records of `su_member_income`
-- -----------------------------
INSERT INTO `su_member_income` VALUES ('1', '4', '18.40', '订单收益', '37', '1', '1', '0', '1529402773', '23', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('2', '4', '12.00', '订单收益', '37', '1', '1', '0', '1529402773', '15', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('3', '1', '0.05', '订单收益', '38', '1', '2', '0', '1529403056', '1', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('4', '1', '0.01', '收益提现', '0', '2', '1', '1', '1529403371', '0', '/public/upload/income/20180715/d3ca218fb16ca3de27a0c84d655c7571.jpg', '建设银行', '苏剑斌', '622700060090172788', '13266604379');
INSERT INTO `su_member_income` VALUES ('5', '4', '2400.00', '订单收益', '48', '1', '1', '0', '1529460802', '22', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('6', '4', '1600.00', '订单收益', '48', '1', '1', '0', '1529460802', '20', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('7', '4', '2400.00', '订单收益', '49', '1', '1', '0', '1529461073', '21', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('8', '4', '1600.00', '订单收益', '49', '1', '1', '0', '1529461073', '20', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('9', '4', '80.00', '订单收益', '50', '1', '1', '0', '1529461337', '3', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('10', '4', '2400.00', '订单收益', '51', '1', '1', '0', '1529467182', '23', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('11', '4', '60.00', '订单收益', '28', '1', '1', '0', '1529467273', '4', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('12', '4', '2400.00', '订单收益', '28', '1', '1', '0', '1529467273', '21', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('13', '4', '60.00', '订单收益', '27', '1', '1', '0', '1529467588', '4', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('14', '4', '2400.00', '订单收益', '27', '1', '1', '0', '1529467588', '21', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('15', '4', '60.00', '订单收益', '26', '1', '1', '0', '1529468799', '4', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('16', '4', '2400.00', '订单收益', '26', '1', '1', '0', '1529468799', '21', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('17', '4', '1600.00', '订单收益', '52', '1', '1', '0', '1529468828', '19', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('18', '4', '800.00', '订单收益', '53', '1', '1', '0', '1529469393', '16', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('19', '4', '5280.00', '订单收益', '54', '1', '1', '0', '1529651628', '24', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('20', '4', '799.20', '订单收益', '65', '1', '1', '0', '1530343687', '19', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('21', '4', '10560.00', '订单收益', '66', '1', '2', '0', '1531230045', '24', '', '', '', '', '');
INSERT INTO `su_member_income` VALUES ('22', '1', '50.00', '商机转成功', '', '1', '2', '0', '1531706514', '', '', '', '', '', '');

-- -----------------------------
-- Table structure for `su_member_notice`
-- -----------------------------
DROP TABLE IF EXISTS `su_member_notice`;
CREATE TABLE `su_member_notice` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `title` varchar(100) NOT NULL COMMENT '消息标题',
  `create_time` int(11) NOT NULL COMMENT '消息日期',
  `url` varchar(200) NOT NULL COMMENT '地址',
  `member_id` int(10) NOT NULL COMMENT '会员id',
  PRIMARY KEY (`id`),
  KEY `staff_id` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='员工消息表';

-- -----------------------------
-- Records of `su_member_notice`
-- -----------------------------
INSERT INTO `su_member_notice` VALUES ('1', '您好，您成功充值金额0.01元', '1529458935', '{\"url\":\"member\\/income\",\"param\":{\"type\":2}}', '1');
INSERT INTO `su_member_notice` VALUES ('2', '您好，您已成功下单', '1529460562', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"43\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('3', '您好，您已成功下单', '1529460590', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"44\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('4', '您好，您已成功下单', '1529460635', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"45\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('5', '您好，您已成功下单', '1529460656', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"46\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('6', '您好，您已成功下单', '1529460729', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"47\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('7', '您好，您已成功下单', '1529460801', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"48\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('8', '您好，您已成功下单', '1529461072', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"49\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('9', '您好，您已成功下单', '1529461336', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"50\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('10', '您的团队有一笔消费，您成功获取收益', '1529461337', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('11', '您好，您已成功下单', '1529467182', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"51\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('12', '您的团队有一笔消费，您成功获取收益', '1529467182', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('13', '您好，您已成功下单', '1529467272', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"28\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('14', '您的团队有一笔消费，您成功获取收益', '1529467273', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('15', '您的团队有一笔消费，您成功获取收益', '1529467273', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('16', '您好，您已成功下单', '1529467587', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"27\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('17', '您的团队有一笔消费，您成功获取收益', '1529467588', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('18', '您的团队有一笔消费，您成功获取收益', '1529467588', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('19', '您好，您已成功下单', '1529468798', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"26\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('20', '您的团队有一笔消费，您成功获取收益', '1529468799', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('21', '您的团队有一笔消费，您成功获取收益', '1529468799', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('22', '您好，您已成功下单', '1529468827', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"52\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('23', '您的团队有一笔消费，您成功获取收益', '1529468828', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('24', '您好，您已成功下单', '1529469393', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"53\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('25', '您的团队有一笔消费，您成功获取收益', '1529469393', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('26', '您好，您已成功下单', '1529651628', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"54\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('27', '您的团队有一笔消费，您成功获取收益', '1529651628', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('28', '您好，您已成功下单', '1530166855', '{\"url\":\"order\\/detail\",\"param\":{\"id\":55}}', '3');
INSERT INTO `su_member_notice` VALUES ('29', '您好，您已成功下单', '1530167092', '{\"url\":\"order\\/detail\",\"param\":{\"id\":57}}', '3');
INSERT INTO `su_member_notice` VALUES ('30', '您好，您已成功下单', '1530167103', '{\"url\":\"order\\/detail\",\"param\":{\"id\":58}}', '5');
INSERT INTO `su_member_notice` VALUES ('31', '您好，您已成功下单', '1530168457', '{\"url\":\"order\\/detail\",\"param\":{\"id\":59}}', '5');
INSERT INTO `su_member_notice` VALUES ('32', '您好，您已成功下单', '1530168895', '{\"url\":\"order\\/detail\",\"param\":{\"id\":62}}', '5');
INSERT INTO `su_member_notice` VALUES ('33', '您好，您已成功下单', '1530328995', '{\"url\":\"order\\/detail\",\"param\":{\"id\":64}}', '5');
INSERT INTO `su_member_notice` VALUES ('34', '您好，您已成功下单', '1530343687', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"65\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('35', '您的团队有一笔消费，您成功获取收益', '1530343687', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');
INSERT INTO `su_member_notice` VALUES ('36', '您好，您已成功下单', '1531230044', '{\"url\":\"order\\/detail\",\"param\":{\"id\":\"66\"}}', '1');
INSERT INTO `su_member_notice` VALUES ('37', '您的团队有一笔消费，您成功获取收益', '1531230045', '{\"url\":\"member\\/income\",\"param\":{\"type\":1}}', '4');

-- -----------------------------
-- Table structure for `su_member_recharge`
-- -----------------------------
DROP TABLE IF EXISTS `su_member_recharge`;
CREATE TABLE `su_member_recharge` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `title` varchar(50) DEFAULT NULL COMMENT '主题',
  `member_id` int(10) NOT NULL COMMENT '会员id',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `create_time` int(11) DEFAULT NULL COMMENT '充值时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '充值状态1充值成功2充值失败',
  `type` tinyint(1) DEFAULT '1' COMMENT '1代表收入2表示支出',
  `out_trade_no` varchar(100) DEFAULT NULL COMMENT '支付单号',
  `orders_id` varchar(100) DEFAULT NULL COMMENT '订单号',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='充值记录表';

-- -----------------------------
-- Records of `su_member_recharge`
-- -----------------------------
INSERT INTO `su_member_recharge` VALUES ('1', '余额充值', '1', '0.01', '1529035452', '1', '1', '1529035194231835', '');
INSERT INTO `su_member_recharge` VALUES ('2', '余额充值', '1', '0.01', '1529035501', '1', '1', '1529035483927764', '');
INSERT INTO `su_member_recharge` VALUES ('3', '余额充值', '1', '0.01', '1529035571', '1', '1', '1529035560128564', '');
INSERT INTO `su_member_recharge` VALUES ('4', '余额充值', '1', '0.02', '1529035706', '1', '1', '1529035694318243', '');
INSERT INTO `su_member_recharge` VALUES ('5', '余额充值', '1', '0.01', '1529035887', '1', '1', '1529035875839434', '');
INSERT INTO `su_member_recharge` VALUES ('6', '余额充值', '1', '0.01', '1529042934', '1', '1', '1529042918412313', '');
INSERT INTO `su_member_recharge` VALUES ('7', '余额充值', '1', '0.02', '1529043062', '1', '1', '1529043042190335', '');
INSERT INTO `su_member_recharge` VALUES ('8', '订单支付', '1', '0.01', '1529373513', '1', '2', '1529373509432336', '31');
INSERT INTO `su_member_recharge` VALUES ('9', '订单支付', '1', '0.01', '1529373581', '1', '2', '1529373578259494', '33');
INSERT INTO `su_member_recharge` VALUES ('10', '订单支付', '1', '0.01', '1529373988', '1', '2', '1529373985474029', '35');
INSERT INTO `su_member_recharge` VALUES ('11', '订单支付', '1', '0.01', '1529402773', '1', '2', '1529402756169818', '37');
INSERT INTO `su_member_recharge` VALUES ('12', '余额充值', '1', '0.01', '1529458115', '1', '1', '1529458109864813', '');
INSERT INTO `su_member_recharge` VALUES ('13', '余额充值', '1', '0.01', '1529458220', '1', '1', '1529458215321649', '');
INSERT INTO `su_member_recharge` VALUES ('14', '余额充值', '1', '0.01', '1529458851', '1', '1', '1529458838724957', '');
INSERT INTO `su_member_recharge` VALUES ('15', '余额充值', '1', '0.01', '1529458934', '1', '1', '1529458914881457', '');
INSERT INTO `su_member_recharge` VALUES ('16', '订单支付', '1', '0.01', '1529460802', '1', '2', '1529460797339941', '48');
INSERT INTO `su_member_recharge` VALUES ('17', '订单支付', '1', '0.01', '1529461073', '1', '2', '1529461067605645', '49');
INSERT INTO `su_member_recharge` VALUES ('18', '订单支付', '1', '0.01', '1529461337', '1', '2', '1529461333890576', '50');
INSERT INTO `su_member_recharge` VALUES ('19', '订单支付', '1', '0.01', '1529467182', '1', '2', '1529467163697628', '51');
INSERT INTO `su_member_recharge` VALUES ('20', '订单支付', '1', '3600.00', '1529467273', '1', '2', '1529373254264465', '28');
INSERT INTO `su_member_recharge` VALUES ('21', '订单支付', '1', '3600.00', '1529467588', '1', '2', '1529373209655523', '27');
INSERT INTO `su_member_recharge` VALUES ('22', '订单支付', '1', '0.01', '1529468799', '1', '2', '1529373175903787', '26');
INSERT INTO `su_member_recharge` VALUES ('23', '订单支付', '1', '0.01', '1529468828', '1', '2', '1529468822670080', '52');
INSERT INTO `su_member_recharge` VALUES ('24', '订单支付', '1', '0.01', '1529469393', '1', '2', '1529469372357107', '53');
INSERT INTO `su_member_recharge` VALUES ('25', '订单支付', '1', '0.01', '1529651628', '1', '2', '1529651623356118', '54');
INSERT INTO `su_member_recharge` VALUES ('26', '订单支付', '1', '0.01', '1530343687', '1', '2', '1530343682851739', '65');
INSERT INTO `su_member_recharge` VALUES ('27', '订单支付', '1', '0.01', '1531230045', '1', '2', '1531230039808480', '66');
INSERT INTO `su_member_recharge` VALUES ('28', '系统调整', '1', '0.07', '1531878571', '1', '1', '153187857194017', '');
INSERT INTO `su_member_recharge` VALUES ('29', '系统调整', '1', '1.00', '1531878593', '1', '2', '153187859364184', '');

-- -----------------------------
-- Table structure for `su_orders`
-- -----------------------------
DROP TABLE IF EXISTS `su_orders`;
CREATE TABLE `su_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `member_id` int(10) DEFAULT NULL COMMENT '会员id',
  `status` int(1) DEFAULT '1' COMMENT '订单状态1未付款2服务中3已完成',
  `true_money` double(10,2) DEFAULT '0.00' COMMENT '订单金额',
  `pay_money` double(10,2) DEFAULT '0.00' COMMENT '支付金额',
  `orders_id` varchar(100) DEFAULT NULL COMMENT '订单编号',
  `out_trade_no` varchar(100) DEFAULT NULL COMMENT '微信订单号',
  `discount` double(10,2) DEFAULT '10.00' COMMENT '折扣',
  `is_delete` int(1) DEFAULT '1' COMMENT '是否删除1否2是',
  `is_invoice` int(1) DEFAULT '1' COMMENT '是否需要发票1是2否',
  `invoice_header` varchar(200) DEFAULT NULL COMMENT '发票抬头',
  `invoice_meg` varchar(255) DEFAULT NULL COMMENT '发票信息',
  `mark` varchar(255) DEFAULT NULL COMMENT '备注',
  `m_name` varchar(50) DEFAULT NULL COMMENT '联系人',
  `m_phone` varchar(50) DEFAULT NULL COMMENT '联系电话',
  `m_address` varchar(200) DEFAULT NULL COMMENT '收获地区',
  `m_address_info` varchar(200) DEFAULT NULL COMMENT '地址详情',
  `pay_type` int(1) DEFAULT '1' COMMENT '1微信支付2余额支付',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `complete_time` int(10) DEFAULT NULL COMMENT '完成时间',
  `remark` varchar(200) DEFAULT NULL COMMENT '订单备注',
  `expire_time` int(10) DEFAULT NULL COMMENT '到期时间',
  `is_pay` tinyint(1) DEFAULT '0' COMMENT '是否支付0否1是',
  `pay_time` int(11) DEFAULT NULL COMMENT '支付时间',
  `is_info` tinyint(1) DEFAULT '0' COMMENT '是否提交资料',
  `is_notice` tinyint(1) DEFAULT '0' COMMENT '续费提醒',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- -----------------------------
-- Records of `su_orders`
-- -----------------------------
INSERT INTO `su_orders` VALUES ('1', '1', '1', '5000', '0', '1529053551248013', '1529053551248013', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529053551', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('2', '1', '1', '800', '0', '1529053644397921', '1529053644397921', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529053644', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('3', '1', '1', '800', '0', '1529053781888983', '1529053781888983', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529053781', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('4', '1', '1', '800', '0', '1529053866900436', '1529053866900436', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529053866', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('5', '1', '1', '800', '0', '1529053890143450', '1529053890143450', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529053890', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('6', '1', '1', '3800', '0', '1529053945884396', '1529053945884396', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529053945', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('7', '1', '1', '3800', '0', '1529053955594961', '1529053955594961', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529053955', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('8', '1', '1', '3800', '0', '1529054081563348', '1529054081563348', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529054081', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('9', '1', '1', '6800', '0', '1529055255806860', '1529055255806860', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529055255', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('10', '1', '1', '6800', '0', '1529055272301132', '1529055272301132', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529055272', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('11', '1', '1', '6800', '0', '1529055327421652', '1529055327421652', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529055327', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('12', '1', '1', '6800', '0', '1529055394101373', '1529055394101373', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529055394', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('13', '1', '1', '6800', '0', '1529055871461175', '1529055871461175', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529055871', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('14', '1', '1', '6800', '0', '1529055906938668', '1529055906938668', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529055906', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('15', '1', '1', '1800', '0.01', '1529056268132986', '1529056268132986', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529056268', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('16', '1', '1', '8000', '0.01', '1529057591526681', '1529057591526681', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529057591', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('17', '1', '1', '3800', '0.01', '1529057964894229', '1529057964894229', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529057964', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('18', '1', '1', '3800', '0.01', '1529058027160232', '1529058027160232', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529058027', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('19', '1', '1', '3000', '0.01', '1529058452239251', '1529058452239251', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529058452', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('20', '1', '1', '3000', '0', '1529061972416433', '1529061972416433', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529061972', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('21', '1', '1', '3600', '0', '1529161127712240', '1529161127712240', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529161127', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('22', '2', '1', '800', '0', '1529335461175091', '1529335461175091', '10', '1', '0', '', '', '', '陈曦', '13802872071', '深圳宝安', '广兴源互联网产业基地', '2', '1529335461', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('23', '2', '1', '0.01', '0', '1529335496588204', '1529335496588204', '10', '1', '0', '', '', '', '陈曦', '13802872071', '深圳宝安', '广兴源互联网产业基地', '2', '1529335496', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('24', '2', '1', '1600', '0.01', '1529335586819961', '1529335586819961', '10', '1', '0', '', '', '', '陈曦', '13802872071', '深圳宝安', '广兴源互联网产业基地', '2', '1529335586', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('25', '1', '1', '3600', '0', '1529373046164050', '1529373046164050', '10', '1', '1', '1', '2', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373046', '0', '备注', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('26', '1', '1', '0.01', '0.01', '1529373175903787', '1529373175903787', '10', '1', '1', '哈哈', '可以的', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373175', '0', '备注内容', '0', '1', '1529468798', '0', '0');
INSERT INTO `su_orders` VALUES ('27', '1', '1', '3600', '3600', '1529373209655523', '1529373209655523', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373209', '0', '', '0', '1', '1529467587', '0', '0');
INSERT INTO `su_orders` VALUES ('28', '1', '1', '3600', '3600', '1529373254264465', '1529373254264465', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373254', '0', '', '0', '1', '1529467272', '0', '0');
INSERT INTO `su_orders` VALUES ('29', '1', '1', '3600', '0', '1529373317391220', '1529373317391220', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373317', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('30', '1', '1', '3600', '0', '1529373379862808', '1529373379862808', '10', '2', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373379', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('31', '1', '1', '0.01', '0.01', '1529373509432336', '1529373509432336', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373509', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('32', '1', '1', '0.01', '0.01', '1529373541207473', '1529373541207473', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529373541', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('33', '1', '1', '0.01', '0.01', '1529373578259494', '1529373578259494', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373578', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('34', '3', '1', '0.01', '0', '1529373970524127', '1529373970524127', '10', '1', '0', '', '', '', '陈生', '18588267009', '广东', '努力', '2', '1529373970', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('35', '1', '1', '0.01', '0.01', '1529373985474029', '1529373985474029', '10', '1', '1', '苏', '剑斌', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529373985', '0', '我是备注内容', '0', '1', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('36', '1', '1', '0.01', '0.01', '1529382609444174', '1529382609444174', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '2', '1529382609', '0', '', '0', '1', '1529382623', '0', '0');
INSERT INTO `su_orders` VALUES ('37', '1', '1', '0.01', '0.01', '1529402756169818', '1529402756169818', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529402756', '0', '', '0', '1', '1529402773', '0', '0');
INSERT INTO `su_orders` VALUES ('38', '2', '1', '0.01', '0.01', '1529403044861077', '1529403044861077', '10', '1', '0', '', '', '', '陈曦', '13802872071', '深圳宝安', '广兴源互联网产业基地', '2', '1529403044', '0', '', '0', '1', '1529403056', '0', '0');
INSERT INTO `su_orders` VALUES ('39', '1', '1', '0.01', '0.01', '1529460430392538', '1529460430392538', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460430', '0', '', '0', '1', '1529460433', '0', '0');
INSERT INTO `su_orders` VALUES ('40', '1', '1', '0.01', '0.01', '1529460445258093', '1529460445258093', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460445', '0', '', '0', '1', '1529460451', '0', '0');
INSERT INTO `su_orders` VALUES ('41', '1', '1', '0.01', '0.01', '1529460501675958', '1529460501675958', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460501', '0', '', '0', '1', '1529460504', '0', '0');
INSERT INTO `su_orders` VALUES ('42', '1', '1', '0.01', '0.01', '1529460516603997', '1529460516603997', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460516', '0', '', '0', '1', '1529460519', '0', '0');
INSERT INTO `su_orders` VALUES ('43', '1', '1', '0.01', '0.01', '1529460558155453', '1529460558155453', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460558', '0', '', '0', '1', '1529460561', '0', '0');
INSERT INTO `su_orders` VALUES ('44', '1', '1', '0.01', '0.01', '1529460584155947', '1529460584155947', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460584', '0', '', '0', '1', '1529460588', '0', '0');
INSERT INTO `su_orders` VALUES ('45', '1', '1', '0.01', '0.01', '1529460632129141', '1529460632129141', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460632', '0', '', '0', '1', '1529460634', '0', '0');
INSERT INTO `su_orders` VALUES ('46', '1', '1', '0.01', '0.01', '1529460653407809', '1529460653407809', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460653', '0', '', '0', '1', '1529460656', '0', '0');
INSERT INTO `su_orders` VALUES ('47', '1', '1', '0.01', '0.01', '1529460725569665', '1529460725569665', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460725', '0', '', '0', '1', '1529460728', '0', '0');
INSERT INTO `su_orders` VALUES ('48', '1', '2', '0.01', '0.01', '1529460797339941', '1529460797339941', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529460797', '0', '', '0', '1', '1529460801', '0', '0');
INSERT INTO `su_orders` VALUES ('49', '1', '3', '0.01', '0.01', '1529461067605645', '1529461067605645', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529461067', '0', '', '0', '1', '1529461070', '0', '0');
INSERT INTO `su_orders` VALUES ('50', '1', '3', '0.01', '0.01', '1529461333890576', '1529461333890576', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529461333', '0', '', '0', '1', '1529461336', '0', '0');
INSERT INTO `su_orders` VALUES ('51', '1', '1', '0.01', '0.01', '1529467163697628', '1529467163697628', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529467163', '0', '', '0', '1', '1529467181', '0', '0');
INSERT INTO `su_orders` VALUES ('52', '1', '1', '0.01', '0.01', '1529468822670080', '1529468822670080', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529468822', '0', '', '0', '1', '1529468827', '0', '0');
INSERT INTO `su_orders` VALUES ('53', '1', '1', '0.01', '0.01', '1529469372357107', '1529469372357107', '10', '1', '1', '21', '21', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529469372', '0', '备注', '0', '1', '1529469392', '0', '0');
INSERT INTO `su_orders` VALUES ('54', '1', '1', '0.01', '0.01', '1529651623356118', '1529651623356118', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1529651623', '0', '', '0', '1', '1529651626', '0', '0');
INSERT INTO `su_orders` VALUES ('55', '3', '1', '0.01', '0.01', '1530166844751956', '1530166844751956', '10', '1', '0', '', '', '', '陈生', '18588267009', '广东', '努力', '2', '1530166844', '0', '', '0', '1', '1530166854', '0', '0');
INSERT INTO `su_orders` VALUES ('56', '3', '1', '0.01', '0', '1530166952695376', '1530166952695376', '10', '1', '0', '', '', '', '陈生', '18588267009', '广东', '努力', '2', '1530166952', '0', '美丽说', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('57', '3', '1', '0.01', '0.01', '1530167082626876', '1530167082626876', '10', '1', '0', '', '', '', '陈生', '18588267009', '广东', '努力', '2', '1530167082', '0', '', '0', '1', '1530167091', '0', '0');
INSERT INTO `su_orders` VALUES ('58', '5', '1', '0.01', '0.01', '1530167091671646', '1530167091671646', '10', '1', '0', '', '', '', '袁俊', '18607559625', '深圳福田', '赛格广场', '2', '1530167091', '0', '', '0', '1', '1530167103', '0', '0');
INSERT INTO `su_orders` VALUES ('59', '5', '1', '0.01', '0.01', '1530168448308355', '1530168448308355', '10', '1', '0', '', '', '', '袁俊', '18607559625', '深圳福田', '赛格广场', '2', '1530168448', '0', '', '0', '1', '1530168456', '0', '0');
INSERT INTO `su_orders` VALUES ('60', '3', '1', '0.01', '0', '1530168807668981', '1530168807668981', '10', '1', '0', '', '', '', '陈生', '18588267009', '广东', '努力', '2', '1530168807', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('61', '5', '1', '0.01', '0', '1530168857202804', '1530168857202804', '10', '2', '0', '', '', '', '袁俊', '18607559625', '深圳福田', '赛格广场', '2', '1530168857', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('62', '5', '1', '0.01', '0.01', '1530168886217224', '1530168886217224', '10', '1', '0', '', '', '', '袁俊', '18607559625', '深圳福田', '赛格广场', '2', '1530168886', '0', '', '0', '1', '1530168894', '0', '0');
INSERT INTO `su_orders` VALUES ('63', '3', '1', '0.01', '0', '1530168904643905', '1530168904643905', '10', '1', '0', '', '', '', '陈生', '18588267009', '广东', '努力', '2', '1530168904', '0', '', '0', '0', '0', '0', '0');
INSERT INTO `su_orders` VALUES ('64', '5', '1', '0.01', '0.01', '1530328972470266', '1530328972470266', '10', '1', '0', '', '', '', '袁俊', '18607559625', '深圳福田', '赛格广场', '2', '1530328972', '0', '', '0', '1', '1530328994', '0', '0');
INSERT INTO `su_orders` VALUES ('65', '1', '1', '0.01', '0.01', '1530343682851739', '1530343682851739', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1530343682', '0', '', '0', '1', '1530343685', '0', '0');
INSERT INTO `su_orders` VALUES ('66', '1', '2', '0.01', '0.01', '1531230039808480', '1531230039808480', '10', '1', '0', '', '', '', '苏剑斌', '13266604379', '广东省惠州市', '佳兆业中心', '1', '1531230039', '0', '', '1531929600', '1', '1531230042', '1', '1');

-- -----------------------------
-- Table structure for `su_orders_assess`
-- -----------------------------
DROP TABLE IF EXISTS `su_orders_assess`;
CREATE TABLE `su_orders_assess` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `parent_id` int(10) DEFAULT '0' COMMENT '父id',
  `member_id` int(10) DEFAULT NULL COMMENT '会员id',
  `username` varchar(60) DEFAULT NULL COMMENT '用户名称',
  `orders_id` int(10) DEFAULT NULL COMMENT '订单id',
  `goods_id` mediumint(8) DEFAULT NULL COMMENT '产品id',
  `goods_name` varchar(200) DEFAULT NULL COMMENT '商品名称',
  `num` int(1) DEFAULT '1' COMMENT '评星数量',
  `pic_list` varchar(1000) DEFAULT NULL COMMENT '晒图',
  `content` text COMMENT '评价内容',
  `create_time` int(11) DEFAULT NULL COMMENT '评价日期',
  `ip_address` varchar(15) DEFAULT NULL COMMENT '评价ip',
  `cryptonym` int(1) DEFAULT '0' COMMENT '是否匿名0否1是',
  `is_show` int(1) DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `orders_id` (`orders_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='评价表';

-- -----------------------------
-- Records of `su_orders_assess`
-- -----------------------------
INSERT INTO `su_orders_assess` VALUES ('1', '0', '1', '匿名用户', '50', '3', '增资减资', '5', '', '服务好，专业度高，效率快', '1529464268', '14.112.230.193', '1', '1');
INSERT INTO `su_orders_assess` VALUES ('2', '0', '1', '苏剑斌', '49', '21', '商标变更', '3', '', '总体不错', '1529465093', '14.112.230.193', '0', '1');
INSERT INTO `su_orders_assess` VALUES ('3', '1', '0', 'admin', '50', '3', '增资减资', '1', '', '谢谢', '1529891180', '14.112.231.226', '0', '1');
INSERT INTO `su_orders_assess` VALUES ('4', '2', '', 'admin', '49', '21', '商标变更', '1', '', '1', '1532763109', '::1', '0', '1');

-- -----------------------------
-- Table structure for `su_orders_info`
-- -----------------------------
DROP TABLE IF EXISTS `su_orders_info`;
CREATE TABLE `su_orders_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id自增',
  `orders_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_name` varchar(120) NOT NULL DEFAULT '' COMMENT '视频名称',
  `goods_num` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '购买数量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `spec_key` varchar(128) DEFAULT '' COMMENT '商品规格key',
  `spec_key_name` varchar(128) DEFAULT '' COMMENT '规格对应的中文名字',
  `is_comment` tinyint(1) DEFAULT '0' COMMENT '是否评价',
  `is_send` tinyint(1) DEFAULT '0' COMMENT '0未发货，1已发货，2已换货，3已退货',
  `delivery_id` int(11) DEFAULT '0' COMMENT '发货单ID',
  `staff_id` int(10) DEFAULT NULL COMMENT '会计id',
  `status` tinyint(1) DEFAULT '0' COMMENT '0抢单中1服务中2已完成',
  `income_price` decimal(10,2) DEFAULT NULL COMMENT '奖励金额',
  PRIMARY KEY (`id`),
  KEY `order_id` (`orders_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COMMENT='订单详情表';

-- -----------------------------
-- Records of `su_orders_info`
-- -----------------------------
INSERT INTO `su_orders_info` VALUES ('1', '11', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '1', '1', '160.00');
INSERT INTO `su_orders_info` VALUES ('2', '11', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('3', '11', '9', '股权变更', '2', '1000.00', '', '', '0', '0', '0', '1', '1', '100.00');
INSERT INTO `su_orders_info` VALUES ('4', '11', '11', '注册资本变更', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('5', '12', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('6', '12', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('7', '12', '9', '股权变更', '2', '1000.00', '', '', '0', '0', '0', '0', '0', '100.00');
INSERT INTO `su_orders_info` VALUES ('8', '12', '11', '注册资本变更', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('9', '13', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('10', '13', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('11', '13', '9', '股权变更', '2', '1000.00', '', '', '0', '0', '0', '0', '0', '100.00');
INSERT INTO `su_orders_info` VALUES ('12', '13', '11', '注册资本变更', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('13', '14', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('14', '14', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('15', '14', '9', '股权变更', '2', '1000.00', '', '', '0', '0', '0', '0', '0', '100.00');
INSERT INTO `su_orders_info` VALUES ('16', '14', '11', '注册资本变更', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('17', '15', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('18', '15', '11', '注册资本变更', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('19', '16', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('20', '16', '22', '商标续展', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('21', '16', '9', '股权变更', '2', '1000.00', '', '', '0', '0', '0', '0', '0', '100.00');
INSERT INTO `su_orders_info` VALUES ('22', '17', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('23', '17', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('24', '18', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('25', '18', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('26', '19', '22', '商标续展', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('27', '20', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('28', '21', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('29', '21', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('30', '22', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('31', '23', '1', '注册公司', '2', '800.00', '', '', '0', '0', '0', '0', '0', '80.00');
INSERT INTO `su_orders_info` VALUES ('32', '24', '1', '注册公司', '2', '800.00', '', '', '0', '0', '0', '0', '0', '80.00');
INSERT INTO `su_orders_info` VALUES ('33', '25', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('34', '25', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('35', '26', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('36', '26', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('37', '27', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('38', '27', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('39', '28', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('40', '28', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('41', '29', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('42', '29', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('43', '30', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('44', '30', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('45', '31', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('46', '31', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('47', '32', '9', '股权变更', '2', '1000.00', '', '', '0', '0', '0', '0', '0', '100.00');
INSERT INTO `su_orders_info` VALUES ('48', '32', '11', '注册资本变更', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('49', '33', '12', '法人变更', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('50', '34', '4', '变更法人', '1', '600.00', '', '', '0', '0', '0', '0', '0', '120.00');
INSERT INTO `su_orders_info` VALUES ('51', '35', '10', '经营范围变更', '2', '1000.00', '', '', '0', '0', '0', '0', '0', '100.00');
INSERT INTO `su_orders_info` VALUES ('52', '35', '3', '增资减资', '3', '1000.00', '', '', '0', '0', '0', '0', '0', '66.67');
INSERT INTO `su_orders_info` VALUES ('53', '36', '8', '地址变更', '2', '1000.00', '', '', '0', '0', '0', '0', '0', '100.00');
INSERT INTO `su_orders_info` VALUES ('54', '37', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('55', '37', '15', '外资公司注销', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('56', '38', '1', '注册公司', '2', '800.00', '', '', '0', '0', '0', '0', '0', '80.00');
INSERT INTO `su_orders_info` VALUES ('57', '39', '3', '增资减资', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('58', '39', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('59', '40', '3', '增资减资', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('60', '40', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('61', '41', '3', '增资减资', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('62', '41', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('63', '42', '3', '增资减资', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('64', '42', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('65', '43', '3', '增资减资', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('66', '43', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('67', '44', '3', '增资减资', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('68', '44', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('69', '45', '22', '商标续展', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('70', '45', '21', '商标变更', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('71', '46', '16', '财务审计', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('72', '47', '20', '商标设计', '1', '2000.00', '', '', '0', '0', '0', '0', '0', '400.00');
INSERT INTO `su_orders_info` VALUES ('73', '47', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('74', '48', '22', '商标续展', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('75', '48', '20', '商标设计', '1', '2000.00', '', '', '0', '0', '0', '0', '0', '400.00');
INSERT INTO `su_orders_info` VALUES ('76', '49', '21', '商标变更', '1', '3000.00', '', '', '1', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('77', '49', '20', '商标设计', '1', '2000.00', '', '', '0', '0', '0', '0', '0', '400.00');
INSERT INTO `su_orders_info` VALUES ('78', '50', '3', '增资减资', '1', '1000.00', '', '', '1', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('79', '51', '23', '专利申请', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('80', '52', '19', '商标注册', '1', '2000.00', '', '', '0', '0', '0', '0', '0', '400.00');
INSERT INTO `su_orders_info` VALUES ('81', '53', '16', '财务审计', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('82', '54', '24', '香港公司注册', '1', '6600.00', '', '', '0', '0', '0', '0', '0', '1320.00');
INSERT INTO `su_orders_info` VALUES ('83', '55', '27', '香港公司报税', '1', '12000.00', '', '', '0', '0', '0', '0', '0', '2400.00');
INSERT INTO `su_orders_info` VALUES ('84', '56', '3', '增资减资', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('85', '56', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('86', '56', '16', '财务审计', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('87', '57', '2', '代理记账', '1', '2380.00', '', '', '0', '0', '0', '2', '1', '476.00');
INSERT INTO `su_orders_info` VALUES ('88', '57', '18', '升级一般纳税人', '1', '1800.00', '', '', '0', '0', '0', '0', '0', '360.00');
INSERT INTO `su_orders_info` VALUES ('89', '57', '3', '增资减资', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('90', '57', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('91', '57', '16', '财务审计', '1', '3000.00', '', '', '0', '0', '0', '0', '0', '600.00');
INSERT INTO `su_orders_info` VALUES ('92', '58', '1', '注册公司', '1', '800.00', '', '', '0', '0', '0', '0', '0', '160.00');
INSERT INTO `su_orders_info` VALUES ('93', '59', '2', '代理记账', '1', '2380.00', '', '', '0', '0', '0', '2', '1', '476.00');
INSERT INTO `su_orders_info` VALUES ('94', '60', '4', '变更法人', '2', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('95', '60', '26', '香港公司年审', '1', '2000.00', '', '', '0', '0', '0', '0', '0', '400.00');
INSERT INTO `su_orders_info` VALUES ('96', '60', '27', '香港公司报税', '2', '12000.00', '', '', '0', '0', '0', '0', '0', '2400.00');
INSERT INTO `su_orders_info` VALUES ('97', '61', '2', '代理记账', '2', '2380.00', '', '', '0', '0', '0', '0', '0', '476.00');
INSERT INTO `su_orders_info` VALUES ('98', '62', '2', '代理记账', '1', '2380.00', '', '', '0', '0', '0', '2', '2', '476.00');
INSERT INTO `su_orders_info` VALUES ('99', '63', '28', '香港公司变更', '1', '8000.00', '', '', '0', '0', '0', '0', '0', '1600.00');
INSERT INTO `su_orders_info` VALUES ('100', '63', '4', '变更法人', '1', '1000.00', '', '', '0', '0', '0', '0', '0', '200.00');
INSERT INTO `su_orders_info` VALUES ('101', '63', '26', '香港公司年审', '1', '2000.00', '', '', '0', '0', '0', '0', '0', '400.00');
INSERT INTO `su_orders_info` VALUES ('102', '63', '27', '香港公司报税', '1', '12000.00', '', '', '0', '0', '0', '0', '0', '2400.00');
INSERT INTO `su_orders_info` VALUES ('103', '64', '2', '代理记账', '1', '2380.00', '', '', '0', '0', '0', '0', '0', '476.00');
INSERT INTO `su_orders_info` VALUES ('104', '65', '19', '商标注册', '1', '999.00', '', '', '0', '0', '0', '0', '0', '199.80');
INSERT INTO `su_orders_info` VALUES ('105', '66', '24', '香港公司注册', '2', '6600.00', '', '', '0', '0', '0', '0', '0', '1320.00');

-- -----------------------------
-- Table structure for `su_orders_log`
-- -----------------------------
DROP TABLE IF EXISTS `su_orders_log`;
CREATE TABLE `su_orders_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `orders_id` int(10) DEFAULT NULL COMMENT '订单id',
  `admin_id` int(10) DEFAULT NULL COMMENT '操作人',
  `mark` varchar(200) DEFAULT NULL COMMENT '操作备注',
  `create_time` int(10) DEFAULT NULL COMMENT '操作时间',
  `ip` varchar(50) DEFAULT NULL COMMENT '操作ip',
  `status` tinyint(1) DEFAULT '1' COMMENT '订单状态',
  `is_pay` tinyint(1) DEFAULT '0' COMMENT '付款状态',
  `is_notice` tinyint(1) DEFAULT '0' COMMENT '微信通知',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='订单操作日志';

-- -----------------------------
-- Records of `su_orders_log`
-- -----------------------------
INSERT INTO `su_orders_log` VALUES ('1', '66', '1', '客户已经提交资料', '1531534949', '::1', '2', '1', '0');
INSERT INTO `su_orders_log` VALUES ('3', '66', '1', '订单已完成', '1531537381', '::1', '3', '1', '1');
INSERT INTO `su_orders_log` VALUES ('10', '66', '1', '111', '1531639917', '::1', '3', '1', '0');
INSERT INTO `su_orders_log` VALUES ('9', '66', '1', '收益转正', '1531639841', '::1', '3', '1', '0');
INSERT INTO `su_orders_log` VALUES ('11', '66', '1', '服务中，测试发送消息', '1531729322', '::1', '2', '1', '1');
INSERT INTO `su_orders_log` VALUES ('12', '66', '1', '11', '1531729395', '::1', '2', '1', '1');
INSERT INTO `su_orders_log` VALUES ('13', '66', '1', '111', '1531876287', '::1', '2', '1', '0');

-- -----------------------------
-- Table structure for `su_plugin`
-- -----------------------------
DROP TABLE IF EXISTS `su_plugin`;
CREATE TABLE `su_plugin` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) DEFAULT NULL COMMENT '插件名称',
  `code` varchar(50) DEFAULT NULL COMMENT '标识',
  `version` varchar(10) DEFAULT NULL COMMENT '版本号',
  `author` varchar(20) DEFAULT NULL COMMENT '作者',
  `type` varchar(20) DEFAULT NULL COMMENT '插件类型',
  `desc` varchar(50) DEFAULT NULL COMMENT '插件描述',
  `icon` varchar(100) DEFAULT NULL COMMENT '插件图标',
  `data` text COMMENT '配置值',
  `order_id` decimal(6,0) DEFAULT '1000' COMMENT '排序id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- -----------------------------
-- Records of `su_plugin`
-- -----------------------------
INSERT INTO `su_plugin` VALUES ('1', '微信支付', 'weixin', '1.0', 'sujianbin', 'payment', '微信支付,包含扫码支付和js支付', '/public/static/plugins/plugin/image/payment_weixin.jpg', 'a:6:{s:5:\"appid\";s:18:\"wx09e6ffd09f9bbdd0\";s:10:\"appsecrect\";s:32:\"737a8b0f94acb3bb86e65155a17eac6f\";s:5:\"mchid\";s:10:\"1505882811\";s:3:\"key\";s:32:\"u0GJtYZ4tuJTbvFEaQxlltmCxcMtE6D1\";s:6:\"smchid\";s:0:\"\";s:2:\"id\";s:1:\"1\";}', '1');
INSERT INTO `su_plugin` VALUES ('2', '支付宝支付', 'alipay', '1.0', 'sujianbin', 'payment', '支付宝电脑、手机支付', '/public/static/plugins/plugin/image/payment_alipay.jpg', 'a:6:{s:6:\"app_id\";s:16:\"2018081561040548\";s:9:\"sign_type\";s:4:\"RSA2\";s:17:\"alipay_public_key\";s:392:\"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtQqTzpIvHiAw32Z8xD0EEP7y9fGVG63bRWFr5RuP0z5Q4+2Kolm7+GeAQOLF72O8oafw9QPU5ZvoquEpI5XHxl/ST6+chL8u25hZAuUrQDz/Gy/4MwY2n1dIWwfjjE9C0b3NLPY5mLh5zeBA3a1PhhXHW1uj6PdUxVjUQ0T26WNYiA72WB7PQCv9IR4ZWTyRG6RIWr3MVVYuHRRAVppeBiDDZQzDA4cNG4EYZn7p/4PDQvPCSUzvlZMyGjBdl9h9tBtxEihCAP5TlzOvs5ziy+49qqdM2Za92wejP7co/arE0+03NL2JtJp4ShaPadQhV1eSKxHjl4cYdN3JlVNGRQIDAQAB\";s:20:\"merchant_private_key\";s:1588:\"MIIEowIBAAKCAQEAtQqTzpIvHiAw32Z8xD0EEP7y9fGVG63bRWFr5RuP0z5Q4+2Kolm7+GeAQOLF72O8oafw9QPU5ZvoquEpI5XHxl/ST6+chL8u25hZAuUrQDz/Gy/4MwY2n1dIWwfjjE9C0b3NLPY5mLh5zeBA3a1PhhXHW1uj6PdUxVjUQ0T26WNYiA72WB7PQCv9IR4ZWTyRG6RIWr3MVVYuHRRAVppeBiDDZQzDA4cNG4EYZn7p/4PDQvPCSUzvlZMyGjBdl9h9tBtxEihCAP5TlzOvs5ziy+49qqdM2Za92wejP7co/arE0+03NL2JtJp4ShaPadQhV1eSKxHjl4cYdN3JlVNGRQIDAQABAoIBAFb2FbmMDoXyAIfOuu+oP2PKkvoAaRc6k7Dn8uPCMXvO2xwg5g7F+7x+OuTwCRPMXLdp7BxFEuaX1VL/hLtLHwLy1Brix9Qb4W4p59e0LOpWYlO03wvjWCmBy4euambjS71j5kJKo6/wLNHvfjj9Hs3ReEkx47Hr3BRPbuZBIjlIZxq5eYEtQra5iKlCScbKBX7osxbLJL0tsGpmANeZty7o8ZVM/yYagrLZpLYctauIEe2+23d4EDywzLfqrz2ObxBfGKOd+d7OvLP7U9ZbU0MLTQqLHK5qCYgvIYaFuTsdJx4w2eJ19uashG2P4igDArdmMRzTmknMggDq8zzQeqECgYEA8AQsZSiQ5UnuNbvsdNmILWCpDcU5e4pI5MmiMiQMaC+1wcd1+p7w9eEgzk3GDPLUIBHwE6e/NXzBnXxWZzPLLqlo0JYddkXVTxLuXqA/u6LgH4dNLkCRRFyC3eBRMrhjyMeSbz2g44OS3avSDO9pil4ScboKOUZvJUykE8fWCcMCgYEAwRj9yqy8AgApGH+2mEJj0F5KIIAP9vJTof+I3TqZz4OIu8IppU1IRpxycadAN3ohcXDDl0oF49My9a0UZAKdgMFUBomFMFXtIvD7JypFVDF1jtWsKbXJfge4BasQ3oSXT+E40hZXMIfJxkEzZuURcHC1JqmXYkEqEeKS71Ct51cCgYA1DkceCWyWMtSEbkkjv15Z4Y8dKya8x2G7qVLAULWpZjqAXm4W+4F6aMyOriSEgj0f5bczMRaUZUKLZIvY/lsAspQn37cdiOxRMXcd1cCg4q02avtFqSIzgVuwXkC0vIvaOzuEeZQSFuilNbEWCOpEmuzq1Nwjsw0oqptuf/MxbwKBgFqhiD0gZf3qZV+CUgmU35RlLRWkBdo6UtauQWbUomyrp/m4YCOd6lZ6B50gixt+z0OXUbYooCsWbcyxt+hY8eQE2ZNX6JOPQQYtZTQ0uuWRcUPhNjU9hZ0Jsm22pOxL/1kWtLymj7XPhfzvjVi2G0FTJTNIVi1fuIc8eQqqK3VxAoGBAMUtrLvxqDcFYQmY/99Tanuam2HS3GtEhwxdYa05PrlSKH/2PRBSSh17Km7W/RlSxsuTwruYY0yp2fMiETgxDg5G3DvKtVFREliJ2+Evx++XMaLoXpb4hRXiKk7Dmvq5lvbCLUgkCyX6HnrYgMQ00xkKVPPa/8pLwD9+AzRhMCfx\";s:7:\"charset\";s:5:\"UTF-8\";s:2:\"id\";s:1:\"2\";}', '2');
INSERT INTO `su_plugin` VALUES ('3', '微信授权登陆', 'weixin', '1.0', 'sujianbin', 'login', '微信授权', '/public/static/plugins/plugin/image/login_weixin.png', 'a:8:{s:5:\"appid\";s:18:\"wxd732cb023f944e43\";s:10:\"appsecrect\";s:32:\"4ab6fe267d142bb2179f3309efef14c2\";s:11:\"appcallback\";s:14:\"login/callback\";s:9:\"appscopes\";s:15:\"snsapi_userinfo\";s:12:\"appsubscribe\";s:1:\"0\";s:16:\"appsubscribetype\";s:1:\"0\";s:15:\"appsubscribeurl\";s:14:\"login/subscrib\";s:2:\"id\";s:1:\"3\";}', '3');
INSERT INTO `su_plugin` VALUES ('4', '微信小程序授权登陆', 'miniprogram', '1.0', 'sujianbin', 'login', '微信小程序授权', '/public/static/plugins/plugin/image/login_miniprogram.jpg', 'a:3:{s:5:\"appid\";s:3:\"111\";s:10:\"appsecrect\";s:4:\"2121\";s:2:\"id\";s:1:\"4\";}', '4');
INSERT INTO `su_plugin` VALUES ('5', 'qq授权登陆', 'qq', '1.0', 'sujianbin', 'login', 'qq授权', '/public/static/plugins/plugin/image/login_qq.png', 'a:4:{s:5:\"appid\";s:9:\"101369579\";s:6:\"appkey\";s:32:\"89a84bc59ecd31f736201f057c356d57\";s:11:\"appcallback\";s:14:\"login/callback\";s:2:\"id\";s:1:\"5\";}', '5');
INSERT INTO `su_plugin` VALUES ('6', '阿里大于', 'aliyundy', '1.0', 'sujianbin', 'sms', '阿里云大于短信', '/public/static/plugins/plugin/image/sms_aliyundy.jpg', 'a:3:{s:11:\"accessKeyId\";s:5:\"11212\";s:15:\"accessKeySecret\";s:10:\"2121212121\";s:2:\"id\";s:1:\"6\";}', '6');

-- -----------------------------
-- Table structure for `su_system_right`
-- -----------------------------
DROP TABLE IF EXISTS `su_system_right`;
CREATE TABLE `su_system_right` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `group` varchar(50) DEFAULT NULL COMMENT '分组',
  `right` text COMMENT '权限集合',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否展示',
  `type` tinyint(1) DEFAULT '1' COMMENT '模型类型1admin',
  `order_id` decimal(6,0) DEFAULT '1000' COMMENT '排序id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='权限列表';

-- -----------------------------
-- Records of `su_system_right`
-- -----------------------------
INSERT INTO `su_system_right` VALUES ('1', '管理员管理', 'system', 'Admin@admin,Admin@adminmodify,Admin@adminupdate,Admin@admindelete,Admin@admindels,Admin@adminlog', '1', '1', '1');
INSERT INTO `su_system_right` VALUES ('2', '数据库管理', 'system', 'Database@index,Database@optimize,Database@repair,Database@backup,Database@restore,Database@download,Database@delete', '1', '1', '2');
INSERT INTO `su_system_right` VALUES ('3', '角色管理', 'system', 'Admin@role,Admin@rolemodify,Admin@roleupdate,Admin@roledelete,Admin@roledels', '1', '1', '1000');
INSERT INTO `su_system_right` VALUES ('4', '基本设置', 'system', 'Config@index', '1', '1', '1000');
INSERT INTO `su_system_right` VALUES ('5', '轮播图管理', 'content', 'Banner@index,Banner@modify,Banner@update,Banner@delete,Banner@dels', '1', '1', '1000');
INSERT INTO `su_system_right` VALUES ('6', '友情链接管理', 'content', 'Link@index,Link@modify,Link@update,Link@delete,Link@dels', '1', '1', '1000');
INSERT INTO `su_system_right` VALUES ('7', '在线留言管理', 'content', 'Comment@index,Comment@delete,Comment@dels', '1', '1', '1000');

-- -----------------------------
-- Table structure for `su_wechat_article`
-- -----------------------------
DROP TABLE IF EXISTS `su_wechat_article`;
CREATE TABLE `su_wechat_article` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `title` varchar(200) DEFAULT NULL COMMENT '文章标题',
  `detail` text COMMENT '详细内容',
  `description` varchar(255) DEFAULT NULL COMMENT '简介',
  `picture` varchar(200) DEFAULT NULL COMMENT '封面图',
  `order_id` decimal(6,0) DEFAULT '1000' COMMENT '排序id',
  `create_time` int(11) DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='微信文章表';

-- -----------------------------
-- Records of `su_wechat_article`
-- -----------------------------
INSERT INTO `su_wechat_article` VALUES ('2', '网站建设需要注意什么', '&lt;p&gt;如何优美的建站一个网站&lt;/p&gt;', '网站建设注意事项', '/public/upload/wechat/20180912/c1ff252032c51ec3f71955f273114df0.png', '1', '1524299840');

-- -----------------------------
-- Table structure for `su_wechat_menu`
-- -----------------------------
DROP TABLE IF EXISTS `su_wechat_menu`;
CREATE TABLE `su_wechat_menu` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) DEFAULT NULL COMMENT '菜单名称',
  `data` text COMMENT '菜单数据',
  `status` tinyint(1) DEFAULT '0' COMMENT '是否使用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='微信菜单表';

-- -----------------------------
-- Records of `su_wechat_menu`
-- -----------------------------
INSERT INTO `su_wechat_menu` VALUES ('1', '默认菜单', '[{\"type\":\"click\",\"name\":\"\\u4eca\\u65e5\\u6b4c\\u66f2\",\"key\":\"col_2\",\"sub_button\":[]},{\"type\":\"view\",\"name\":\"\\u767e\\u5ea6\\u4e00\\u4e0b\",\"url\":\"http:\\/\\/www.baidu.com\\/\",\"sub_button\":[]},{\"name\":\"\\u7b2c\\u4e09\\u83dc\\u5355\",\"sub_button\":[{\"type\":\"view\",\"name\":\"\\u641c\\u7d22\",\"url\":\"http:\\/\\/www.soso.com\\/\"},{\"type\":\"view\",\"name\":\"\\u89c6\\u9891\",\"url\":\"http:\\/\\/v.qq.com\\/\"},{\"type\":\"click\",\"name\":\"\\u8d5e\\u4e00\\u4e0b\\u6211\\u4eec\",\"key\":\"col_1\"},{\"name\":\"\\u4e2a\\u4eba\\u535a\\u5ba2\",\"type\":\"view\",\"url\":\"https:\\/\\/sujianbin.com\"}]}]', '1');
INSERT INTO `su_wechat_menu` VALUES ('2', '默认菜单2', '[{\"name\":\"\\u9996\\u9875\",\"sub_button\":[],\"type\":\"view\",\"url\":\"https:\\/\\/sujianbin.com\"},{\"name\":\"\\u5173\\u4e8e\\u6211\\u4eec\",\"sub_button\":[],\"url\":\"https:\\/\\/sujianbin.com\\/about.html\",\"type\":\"view\"}]', '0');
