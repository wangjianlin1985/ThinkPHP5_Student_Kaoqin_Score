/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : php_db

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2018-10-12 14:32:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_admin`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `username` varchar(20) NOT NULL default '',
  `password` varchar(32) default NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('a', 'a');

-- ----------------------------
-- Table structure for `t_attendance`
-- ----------------------------
DROP TABLE IF EXISTS `t_attendance`;
CREATE TABLE `t_attendance` (
  `attendanceId` int(11) NOT NULL auto_increment COMMENT '记录编号',
  `studentObj` varchar(20) NOT NULL COMMENT '学生',
  `courseObj` varchar(20) NOT NULL COMMENT '课程',
  `timeInfoObj` int(11) NOT NULL COMMENT '时间',
  `attendanceStateObj` varchar(20) NOT NULL COMMENT '状态',
  PRIMARY KEY  (`attendanceId`),
  KEY `studentObj` (`studentObj`),
  KEY `courseObj` (`courseObj`),
  KEY `timeInfoObj` (`timeInfoObj`),
  KEY `attendanceStateObj` (`attendanceStateObj`),
  CONSTRAINT `t_attendance_ibfk_4` FOREIGN KEY (`attendanceStateObj`) REFERENCES `t_attendancestate` (`stateId`),
  CONSTRAINT `t_attendance_ibfk_1` FOREIGN KEY (`studentObj`) REFERENCES `t_student` (`studentNumber`),
  CONSTRAINT `t_attendance_ibfk_2` FOREIGN KEY (`courseObj`) REFERENCES `t_course` (`courseNo`),
  CONSTRAINT `t_attendance_ibfk_3` FOREIGN KEY (`timeInfoObj`) REFERENCES `t_timeinfo` (`timeInfoId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_attendance
-- ----------------------------
INSERT INTO `t_attendance` VALUES ('1', 'STU001', 'KC001', '1', '1');
INSERT INTO `t_attendance` VALUES ('2', 'STU002', 'KC002', '1', '2');
INSERT INTO `t_attendance` VALUES ('3', 'STU002', 'KC002', '2', '3');

-- ----------------------------
-- Table structure for `t_attendancestate`
-- ----------------------------
DROP TABLE IF EXISTS `t_attendancestate`;
CREATE TABLE `t_attendancestate` (
  `stateId` varchar(20) NOT NULL COMMENT 'stateId',
  `stateName` varchar(20) NOT NULL COMMENT '状态名称',
  PRIMARY KEY  (`stateId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_attendancestate
-- ----------------------------
INSERT INTO `t_attendancestate` VALUES ('1', '迟到');
INSERT INTO `t_attendancestate` VALUES ('2', '已到');
INSERT INTO `t_attendancestate` VALUES ('3', '早退');
INSERT INTO `t_attendancestate` VALUES ('4', '旷课');
INSERT INTO `t_attendancestate` VALUES ('5', '请假');

-- ----------------------------
-- Table structure for `t_classinfo`
-- ----------------------------
DROP TABLE IF EXISTS `t_classinfo`;
CREATE TABLE `t_classinfo` (
  `classNo` varchar(20) NOT NULL COMMENT 'classNo',
  `className` varchar(20) NOT NULL COMMENT '班级名称',
  `banzhuren` varchar(20) default NULL COMMENT '班主任姓名',
  `beginDate` varchar(20) default NULL COMMENT '成立日期',
  PRIMARY KEY  (`classNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_classinfo
-- ----------------------------
INSERT INTO `t_classinfo` VALUES ('BJ001', '计算机1班', '宋静怡', '2018-10-11');
INSERT INTO `t_classinfo` VALUES ('BJ002', '计算机2班', '王小波', '2018-10-02');

-- ----------------------------
-- Table structure for `t_course`
-- ----------------------------
DROP TABLE IF EXISTS `t_course`;
CREATE TABLE `t_course` (
  `courseNo` varchar(20) NOT NULL COMMENT 'courseNo',
  `courseName` varchar(20) NOT NULL COMMENT '课程名称',
  `teacherName` varchar(20) default NULL COMMENT '任课教师',
  `coursePlace` varchar(20) NOT NULL COMMENT '上课地点',
  `courseCount` int(11) NOT NULL COMMENT '总课时',
  `courseScore` float NOT NULL COMMENT '总学分',
  PRIMARY KEY  (`courseNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_course
-- ----------------------------
INSERT INTO `t_course` VALUES ('KC001', 'HTML5网站前端设计', '王大国', '6A-203', '38', '3.5');
INSERT INTO `t_course` VALUES ('KC002', 'php网站开发编程', '李明涛', '7B-301', '40', '4');

-- ----------------------------
-- Table structure for `t_scoreinfo`
-- ----------------------------
DROP TABLE IF EXISTS `t_scoreinfo`;
CREATE TABLE `t_scoreinfo` (
  `scoreId` int(11) NOT NULL auto_increment COMMENT '成绩编号',
  `studentNumber` varchar(20) NOT NULL COMMENT '学生姓名',
  `courseNo` varchar(20) NOT NULL COMMENT '课程名称',
  `termId` int(11) NOT NULL COMMENT '所在学期',
  `score` float NOT NULL COMMENT '成绩得分',
  PRIMARY KEY  (`scoreId`),
  KEY `studentNumber` (`studentNumber`),
  KEY `courseNo` (`courseNo`),
  KEY `termId` (`termId`),
  CONSTRAINT `t_scoreinfo_ibfk_3` FOREIGN KEY (`termId`) REFERENCES `t_terminfo` (`termId`),
  CONSTRAINT `t_scoreinfo_ibfk_1` FOREIGN KEY (`studentNumber`) REFERENCES `t_student` (`studentNumber`),
  CONSTRAINT `t_scoreinfo_ibfk_2` FOREIGN KEY (`courseNo`) REFERENCES `t_course` (`courseNo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_scoreinfo
-- ----------------------------
INSERT INTO `t_scoreinfo` VALUES ('1', 'STU001', 'KC001', '1', '98');
INSERT INTO `t_scoreinfo` VALUES ('2', 'STU002', 'KC002', '1', '94.5');

-- ----------------------------
-- Table structure for `t_student`
-- ----------------------------
DROP TABLE IF EXISTS `t_student`;
CREATE TABLE `t_student` (
  `studentNumber` varchar(20) NOT NULL COMMENT 'studentNumber',
  `studentName` varchar(20) NOT NULL COMMENT '姓名',
  `sex` varchar(2) NOT NULL COMMENT '性别',
  `classInfoId` varchar(20) NOT NULL COMMENT '所在班级',
  `birthday` varchar(20) default NULL COMMENT '出生日期',
  `zzmm` varchar(10) default NULL COMMENT '政治面貌',
  `telephone` varchar(20) default NULL COMMENT '联系电话',
  `address` varchar(50) default NULL COMMENT '家庭地址',
  `photoUrl` varchar(60) NOT NULL COMMENT '学生照片',
  PRIMARY KEY  (`studentNumber`),
  KEY `classInfoId` (`classInfoId`),
  CONSTRAINT `t_student_ibfk_1` FOREIGN KEY (`classInfoId`) REFERENCES `t_classinfo` (`classNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_student
-- ----------------------------
INSERT INTO `t_student` VALUES ('STU001', '李明', '男', 'BJ001', '2018-10-03', '团员', '13598083432', '四川成都红星路', 'upload/72cc9b41522669ebb1d7c8905d712ddc.jpg');
INSERT INTO `t_student` VALUES ('STU002', '王萌萌', '女', 'BJ002', '2018-10-01', '党员', '13985083941', '四川省南充市滨江路', 'upload/9c20c478e62825cb1e9936a7e10b4936.jpg');

-- ----------------------------
-- Table structure for `t_terminfo`
-- ----------------------------
DROP TABLE IF EXISTS `t_terminfo`;
CREATE TABLE `t_terminfo` (
  `termId` int(11) NOT NULL auto_increment COMMENT '学期编号',
  `termName` varchar(20) default NULL COMMENT '学期名称',
  PRIMARY KEY  (`termId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_terminfo
-- ----------------------------
INSERT INTO `t_terminfo` VALUES ('1', '2017-2018下学期');
INSERT INTO `t_terminfo` VALUES ('2', '2018-2019上学期');

-- ----------------------------
-- Table structure for `t_timeinfo`
-- ----------------------------
DROP TABLE IF EXISTS `t_timeinfo`;
CREATE TABLE `t_timeinfo` (
  `timeInfoId` int(11) NOT NULL auto_increment COMMENT '记录编号',
  `timeInfoName` varchar(20) NOT NULL COMMENT '学时名称',
  PRIMARY KEY  (`timeInfoId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_timeinfo
-- ----------------------------
INSERT INTO `t_timeinfo` VALUES ('1', '第1课时');
INSERT INTO `t_timeinfo` VALUES ('2', '第2课时');
INSERT INTO `t_timeinfo` VALUES ('3', '第3课时');
INSERT INTO `t_timeinfo` VALUES ('4', '第4课时');
INSERT INTO `t_timeinfo` VALUES ('5', '第5课时');
INSERT INTO `t_timeinfo` VALUES ('6', '第6课时');
INSERT INTO `t_timeinfo` VALUES ('7', '第7课时');
INSERT INTO `t_timeinfo` VALUES ('8', '第8课时');
INSERT INTO `t_timeinfo` VALUES ('9', '第9课时');
INSERT INTO `t_timeinfo` VALUES ('10', '第10课时');
INSERT INTO `t_timeinfo` VALUES ('11', '第11课时');
INSERT INTO `t_timeinfo` VALUES ('12', '第12课时');
INSERT INTO `t_timeinfo` VALUES ('13', '第13课时');
INSERT INTO `t_timeinfo` VALUES ('14', '第14课时');
INSERT INTO `t_timeinfo` VALUES ('15', '第15课时');
INSERT INTO `t_timeinfo` VALUES ('16', '第16课时');
INSERT INTO `t_timeinfo` VALUES ('17', '第17课时');
INSERT INTO `t_timeinfo` VALUES ('18', '第18课时');
INSERT INTO `t_timeinfo` VALUES ('19', '第19课时');
INSERT INTO `t_timeinfo` VALUES ('20', '第20课时');
