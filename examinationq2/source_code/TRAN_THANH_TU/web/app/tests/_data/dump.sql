/*
Navicat MySQL Data Transfer

Source Server         : laraveltrain
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : tav_etm

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2015-04-23 09:26:58
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `areas`
-- ----------------------------
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas` (
  `area_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of areas
-- ----------------------------
INSERT INTO `areas` VALUES ('1', 'Technical', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `areas` VALUES ('2', 'Soft Skill', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `areas` VALUES ('3', 'Language', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `class_assignments`
-- ----------------------------
DROP TABLE IF EXISTS `class_assignments`;
CREATE TABLE `class_assignments` (
  `engineer_id` int(10) unsigned NOT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `examination_result` double(15,2) DEFAULT NULL,
  `pass_examination` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`engineer_id`,`class_id`),
  KEY `class_assignments_class_id_foreign` (`class_id`),
  CONSTRAINT `class_assignments_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE,
  CONSTRAINT `class_assignments_engineer_id_foreign` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`engineer_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of class_assignments
-- ----------------------------
INSERT INTO `class_assignments` VALUES ('1', '2', '64.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('2', '2', '87.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('3', '3', '67.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('4', '3', '73.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('5', '1', '85.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('6', '2', '66.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('7', '3', '80.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('8', '3', '81.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('9', '1', '63.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('10', '3', '77.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('11', '1', '66.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('12', '1', '84.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('13', '2', '81.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('14', '2', '71.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('15', '3', '76.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('16', '3', '90.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('17', '3', '84.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('18', '3', '83.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('19', '1', '61.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('20', '3', '90.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('21', '2', '61.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('22', '2', '66.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('23', '2', '83.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('24', '2', '67.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('25', '3', '62.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('26', '1', '89.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('27', '3', '84.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('28', '1', '78.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `class_assignments` VALUES ('29', '3', '80.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `classes`
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `trainer_id` int(10) unsigned DEFAULT NULL,
  `class_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `duration` double(15,2) DEFAULT NULL,
  `has_examination` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`class_id`),
  KEY `classes_course_id_foreign` (`course_id`),
  KEY `classes_trainer_id_foreign` (`trainer_id`),
  CONSTRAINT `classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  CONSTRAINT `classes_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES ('1', '1', '8', 'UML 1', '2015-04-23', '4.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `classes` VALUES ('2', '2', '9', 'How to lead small team 1', '2015-04-23', '4.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `classes` VALUES ('3', '3', '10', 'Everyday English 1', '2015-04-23', '4.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `classes` VALUES ('4', '4', '11', 'OOP/MVC 1', '2015-04-23', '4.00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `classes` VALUES ('5', '5', '12', 'Code Quality 1', '2015-04-23', '4.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `courses`
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `course_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(10) unsigned NOT NULL,
  `course_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`course_id`),
  KEY `courses_area_id_foreign` (`area_id`),
  CONSTRAINT `courses_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`area_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES ('1', '1', 'UML', 'UML is Undefined Modeling Language', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `courses` VALUES ('2', '2', 'How to lead small team', 'This course is about management a team with less than 10 members', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `courses` VALUES ('3', '3', 'Everyday English', 'English for daily usage', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `courses` VALUES ('4', '1', 'OOP/MVC', 'Everything about OOP and MVC', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `courses` VALUES ('5', '1', 'Code Quality', 'The Art of Readable Code', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `departments`
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `department_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', 'department 1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `departments` VALUES ('2', 'department 2', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `departments` VALUES ('3', 'department 3', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `departments` VALUES ('4', 'department 4', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `departments` VALUES ('5', 'department 5', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `departments` VALUES ('6', 'department 6', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `departments` VALUES ('7', 'department 7', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `departments` VALUES ('8', 'department 8', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `engineer_position_history`
-- ----------------------------
DROP TABLE IF EXISTS `engineer_position_history`;
CREATE TABLE `engineer_position_history` (
  `engineer_id` int(10) unsigned NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `updated_time` date NOT NULL,
  `is_current` tinyint(1) NOT NULL,
  `is_first_update` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`engineer_id`,`level_id`,`updated_time`),
  KEY `engineer_position_history_level_id_foreign` (`level_id`),
  CONSTRAINT `engineer_position_history_engineer_id_foreign` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`engineer_id`) ON DELETE CASCADE,
  CONSTRAINT `engineer_position_history_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`level_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of engineer_position_history
-- ----------------------------

-- ----------------------------
-- Table structure for `engineer_soft_skill_level_history`
-- ----------------------------
DROP TABLE IF EXISTS `engineer_soft_skill_level_history`;
CREATE TABLE `engineer_soft_skill_level_history` (
  `engineer_id` int(10) unsigned NOT NULL,
  `soft_skill_id` int(10) unsigned NOT NULL,
  `updated_time` date NOT NULL,
  `soft_skill_level` tinyint(4) NOT NULL,
  `is_current` tinyint(1) NOT NULL,
  `is_first_update` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`engineer_id`,`soft_skill_id`,`updated_time`),
  KEY `engineer_soft_skill_level_history_soft_skill_id_foreign` (`soft_skill_id`),
  CONSTRAINT `engineer_soft_skill_level_history_engineer_id_foreign` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`engineer_id`) ON DELETE CASCADE,
  CONSTRAINT `engineer_soft_skill_level_history_soft_skill_id_foreign` FOREIGN KEY (`soft_skill_id`) REFERENCES `soft_skills` (`soft_skill_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of engineer_soft_skill_level_history
-- ----------------------------

-- ----------------------------
-- Table structure for `engineer_technique_level_history`
-- ----------------------------
DROP TABLE IF EXISTS `engineer_technique_level_history`;
CREATE TABLE `engineer_technique_level_history` (
  `engineer_id` int(10) unsigned NOT NULL,
  `technique_id` int(10) unsigned NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `updated_time` date NOT NULL,
  `is_current` tinyint(1) NOT NULL,
  `is_first_update` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`engineer_id`,`technique_id`,`updated_time`),
  KEY `engineer_technique_level_history_technique_id_foreign` (`technique_id`),
  KEY `engineer_technique_level_history_level_id_foreign` (`level_id`),
  CONSTRAINT `engineer_technique_level_history_engineer_id_foreign` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`engineer_id`) ON DELETE CASCADE,
  CONSTRAINT `engineer_technique_level_history_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`level_id`) ON DELETE CASCADE,
  CONSTRAINT `engineer_technique_level_history_technique_id_foreign` FOREIGN KEY (`technique_id`) REFERENCES `techniques` (`technique_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of engineer_technique_level_history
-- ----------------------------

-- ----------------------------
-- Table structure for `engineers`
-- ----------------------------
DROP TABLE IF EXISTS `engineers`;
CREATE TABLE `engineers` (
  `engineer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(10) unsigned DEFAULT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_information` text COLLATE utf8_unicode_ci,
  `gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `has_interview_form` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`engineer_id`),
  KEY `engineers_department_id_foreign` (`department_id`),
  CONSTRAINT `engineers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of engineers
-- ----------------------------
INSERT INTO `engineers` VALUES ('1', 'TA01', '1', 'Engineer 1', null, 'engineer1@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('2', 'TA02', '1', 'Engineer 2', null, 'engineer2@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('3', 'TA03', '1', 'Engineer 3', null, 'engineer3@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('4', 'TA04', '1', 'Engineer 4', null, 'engineer4@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('5', 'TA05', '1', 'Engineer 5', null, 'engineer5@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('6', 'TA06', '1', 'Engineer 6', null, 'engineer6@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('7', 'TA07', '1', 'Engineer 7', null, 'engineer7@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('8', 'TA08', '1', 'Engineer 8', null, 'engineer8@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('9', 'TA09', '1', 'Engineer 9', null, 'engineer9@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('10', 'TA010', '1', 'Engineer 10', null, 'engineer10@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('11', 'TA011', '1', 'Engineer 11', null, 'engineer11@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('12', 'TA012', '1', 'Engineer 12', null, 'engineer12@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('13', 'TA013', '1', 'Engineer 13', null, 'engineer13@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('14', 'TA014', '1', 'Engineer 14', null, 'engineer14@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('15', 'TA015', '1', 'Engineer 15', null, 'engineer15@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('16', 'TA016', '1', 'Engineer 16', null, 'engineer16@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('17', 'TA017', '1', 'Engineer 17', null, 'engineer17@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('18', 'TA018', '1', 'Engineer 18', null, 'engineer18@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('19', 'TA019', '1', 'Engineer 19', null, 'engineer19@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('20', 'TA020', '1', 'Engineer 20', null, 'engineer20@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('21', 'TA021', '1', 'Engineer 21', null, 'engineer21@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('22', 'TA022', '1', 'Engineer 22', null, 'engineer22@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('23', 'TA023', '1', 'Engineer 23', null, 'engineer23@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('24', 'TA024', '1', 'Engineer 24', null, 'engineer24@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('25', 'TA025', '1', 'Engineer 25', null, 'engineer25@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('26', 'TA026', '1', 'Engineer 26', null, 'engineer26@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('27', 'TA027', '1', 'Engineer 27', null, 'engineer27@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('28', 'TA028', '1', 'Engineer 28', null, 'engineer28@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('29', 'TA029', '1', 'Engineer 29', null, 'engineer29@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('30', 'TA030', '1', 'Engineer 30', null, 'engineer30@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('31', 'TA031', '1', 'Engineer 31', null, 'engineer31@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('32', 'TA032', '1', 'Engineer 32', null, 'engineer32@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('33', 'TA033', '1', 'Engineer 33', null, 'engineer33@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('34', 'TA034', '1', 'Engineer 34', null, 'engineer34@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('35', 'TA035', '1', 'Engineer 35', null, 'engineer35@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('36', 'TA036', '1', 'Engineer 36', null, 'engineer36@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('37', 'TA037', '1', 'Engineer 37', null, 'engineer37@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('38', 'TA038', '1', 'Engineer 38', null, 'engineer38@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('39', 'TA039', '1', 'Engineer 39', null, 'engineer39@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('40', 'TA040', '1', 'Engineer 40', null, 'engineer40@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('41', 'TA041', '1', 'Engineer 41', null, 'engineer41@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('42', 'TA042', '1', 'Engineer 42', null, 'engineer42@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('43', 'TA043', '1', 'Engineer 43', null, 'engineer43@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('44', 'TA044', '1', 'Engineer 44', null, 'engineer44@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('45', 'TA045', '1', 'Engineer 45', null, 'engineer45@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('46', 'TA046', '1', 'Engineer 46', null, 'engineer46@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('47', 'TA047', '1', 'Engineer 47', null, 'engineer47@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('48', 'TA048', '1', 'Engineer 48', null, 'engineer48@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `engineers` VALUES ('49', 'TA049', '1', 'Engineer 49', null, 'engineer49@tctav.com', null, null, null, null, '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `interview_forms`
-- ----------------------------
DROP TABLE IF EXISTS `interview_forms`;
CREATE TABLE `interview_forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `engineer_id` int(10) unsigned NOT NULL,
  `technique_skill_feedback` tinyint(4) NOT NULL,
  `management_skill_feedback` tinyint(4) NOT NULL,
  `other_feedback` text COLLATE utf8_unicode_ci,
  `interview_date` date DEFAULT NULL,
  `working_area_id` int(10) unsigned NOT NULL,
  `interviewer` text COLLATE utf8_unicode_ci NOT NULL,
  `interviewer_department` text COLLATE utf8_unicode_ci NOT NULL,
  `is_approve` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `interview_forms_working_area_id_foreign` (`working_area_id`),
  KEY `interview_forms_engineer_id_foreign` (`engineer_id`),
  CONSTRAINT `interview_forms_engineer_id_foreign` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`engineer_id`) ON DELETE CASCADE,
  CONSTRAINT `interview_forms_working_area_id_foreign` FOREIGN KEY (`working_area_id`) REFERENCES `working_areas` (`working_area_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of interview_forms
-- ----------------------------

-- ----------------------------
-- Table structure for `levels`
-- ----------------------------
DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels` (
  `level_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of levels
-- ----------------------------
INSERT INTO `levels` VALUES ('1', 'PG1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `levels` VALUES ('2', 'PG2', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `levels` VALUES ('3', 'PG3', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `levels` VALUES ('4', 'PG4', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `levels` VALUES ('5', 'SE5', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `levels` VALUES ('6', 'SE6', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `levels` VALUES ('7', 'SE7', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `levels` VALUES ('8', 'SE8', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2015_03_24_024720_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000001_create_working_areas_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000002_create_soft_skills_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000003_create_departments_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000004_create_techniques_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000005_create_levels_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000006_create_engineers_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000007_create_interview_forms_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000008_create_monthly_utilizations_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000009_create_engineer_soft_skill_level_history_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000010_create_engineer_position_history_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_01_000011_create_engineer_technique_level_history_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_13_085145_create_areas_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_13_085444_create_courses_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_13_085833_create_trainers_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_13_090430_create_classes_table', '1');
INSERT INTO `migrations` VALUES ('2015_04_13_091319_create_class_assignments_table', '1');

-- ----------------------------
-- Table structure for `monthly_utilizations`
-- ----------------------------
DROP TABLE IF EXISTS `monthly_utilizations`;
CREATE TABLE `monthly_utilizations` (
  `engineer_id` int(10) unsigned NOT NULL,
  `working_area_id` int(10) unsigned NOT NULL,
  `month` date NOT NULL,
  `utilization` double(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`engineer_id`,`working_area_id`,`month`),
  KEY `monthly_utilizations_working_area_id_foreign` (`working_area_id`),
  CONSTRAINT `monthly_utilizations_engineer_id_foreign` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`engineer_id`) ON DELETE CASCADE,
  CONSTRAINT `monthly_utilizations_working_area_id_foreign` FOREIGN KEY (`working_area_id`) REFERENCES `working_areas` (`working_area_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of monthly_utilizations
-- ----------------------------

-- ----------------------------
-- Table structure for `soft_skills`
-- ----------------------------
DROP TABLE IF EXISTS `soft_skills`;
CREATE TABLE `soft_skills` (
  `soft_skill_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `soft_skill_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `soft_skill_description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`soft_skill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of soft_skills
-- ----------------------------
INSERT INTO `soft_skills` VALUES ('1', 'Communication', null, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `soft_skills` VALUES ('2', 'Leadership', null, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `soft_skills` VALUES ('3', 'Teamwork', null, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `techniques`
-- ----------------------------
DROP TABLE IF EXISTS `techniques`;
CREATE TABLE `techniques` (
  `technique_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `technique_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `technique_description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`technique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of techniques
-- ----------------------------
INSERT INTO `techniques` VALUES ('1', 'Understanding Requirement', null, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `techniques` VALUES ('2', 'OOP/MVC', null, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `techniques` VALUES ('3', 'UML', null, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `techniques` VALUES ('4', 'Coding', null, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `techniques` VALUES ('5', 'Testing', null, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `trainers`
-- ----------------------------
DROP TABLE IF EXISTS `trainers`;
CREATE TABLE `trainers` (
  `trainer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trainer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `employee_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`trainer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of trainers
-- ----------------------------
INSERT INTO `trainers` VALUES ('1', 'Engineer 1', 'TA01', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('2', 'Engineer 2', 'TA02', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('3', 'Engineer 3', 'TA03', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('4', 'Engineer 4', 'TA04', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('5', 'Engineer 5', 'TA05', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('6', 'Engineer 6', 'TA06', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('7', 'Engineer 7', 'TA07', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('8', 'Engineer 8', 'TA08', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('9', 'Engineer 9', 'TA09', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('10', 'External Trainer 1', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('11', 'External Trainer 2', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('12', 'External Trainer 3', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('13', 'External Trainer 4', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('14', 'External Trainer 5', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('15', 'External Trainer 6', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('16', 'External Trainer 7', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('17', 'External Trainer 8', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trainers` VALUES ('18', 'External Trainer 9', 'External', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('19', 'nguyen van 1', 'admin1', '$2y$10$fgmmNmVYLehopZP5Xz/e6eHpUkjyfcDS0sY.SCaLjNQyLO5ritQjm', 'admin1@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('20', 'nguyen van 2', 'admin2', '$2y$10$x5CfslMF73vxTFSUJOlXaODXLkaahXI/dzY7aHWrQmOOpEyNUPLG.', 'admin2@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('21', 'nguyen van 3', 'admin3', '$2y$10$SiIbcMBMNk6UTJZtf3dbpuY7kyIZUkdasJA8SLYiPhjVejkDo3OP.', 'admin3@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('22', 'nguyen van 4', 'admin4', '$2y$10$0TaOkG7874.a4G95b4V0M.kyE6oh8gHL/Z3F8wG9fUgI498zNi5lS', 'admin4@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('23', 'nguyen van 5', 'admin5', '$2y$10$6GnylaJFV5gAWd8pV6qpP.y0juJl61k4.zB/KNWmVPC95Qo7i4YF2', 'admin5@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('24', 'nguyen van 6', 'admin6', '$2y$10$C.gmhSL/SyVbNa4I7tW6..lbrG6udi9a.sBPW//JtAenaFhy967jm', 'admin6@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('25', 'nguyen van 7', 'admin7', '$2y$10$zDwaVVw4AasEC8HQqrdBseQqYASQHB3Vo5m5jKWObSZUz0u2g5s8S', 'admin7@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('26', 'nguyen van 8', 'admin8', '$2y$10$wulfnCbRqGUw.dHmgBzwRuRiS4GjymuUYQ.Jo3r8i9IjOB.Y6tmbe', 'admin8@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('27', 'nguyen van 9', 'admin9', '$2y$10$HCfpw6wY.vfmgS.S4Ln9duT7kWvma/5ZbWZdClk0AVpzEdz4xEwta', 'admin9@gmail.com', '1', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `working_areas`
-- ----------------------------
DROP TABLE IF EXISTS `working_areas`;
CREATE TABLE `working_areas` (
  `working_area_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `working_area_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`working_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of working_areas
-- ----------------------------
INSERT INTO `working_areas` VALUES ('1', 'PHP', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `working_areas` VALUES ('2', 'Java', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `working_areas` VALUES ('3', 'Mobile', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
