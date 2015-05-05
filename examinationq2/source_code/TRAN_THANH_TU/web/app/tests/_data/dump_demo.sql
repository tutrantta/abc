-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.42 - Distributed by The IUS Community Project
-- Server OS:                    Linux
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for tav_etm
CREATE DATABASE IF NOT EXISTS `tav_etm` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tav_etm`;


-- Dumping structure for table tav_etm.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.departments: ~8 rows (approximately)
DELETE FROM `departments`;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`department_id`, `department_name`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'department 1', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'department 2', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'department 3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'department 4', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'department 5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'department 6', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, 'department 7', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 'department 8', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;


-- Dumping structure for table tav_etm.engineers
CREATE TABLE IF NOT EXISTS `engineers` (
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

-- Dumping data for table tav_etm.engineers: ~49 rows (approximately)
DELETE FROM `engineers`;
/*!40000 ALTER TABLE `engineers` DISABLE KEYS */;
INSERT INTO `engineers` (`engineer_id`, `employee_code`, `department_id`, `fullname`, `birthday`, `email`, `address`, `phone`, `other_information`, `gender`, `is_active`, `has_interview_form`, `created_at`, `updated_at`) VALUES
	(1, 'code1', 1, 'Engineer 1', NULL, 'engineer1@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'code2', 1, 'Engineer 2', NULL, 'engineer2@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'code3', 1, 'Engineer 3', NULL, 'engineer3@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'code4', 1, 'Engineer 4', NULL, 'engineer4@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'code5', 1, 'Engineer 5', NULL, 'engineer5@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'code6', 1, 'Engineer 6', NULL, 'engineer6@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, 'code7', 1, 'Engineer 7', NULL, 'engineer7@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 'code8', 1, 'Engineer 8', NULL, 'engineer8@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(9, 'code9', 1, 'Engineer 9', NULL, 'engineer9@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(10, 'code10', 1, 'Engineer 10', NULL, 'engineer10@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(11, 'code11', 1, 'Engineer 11', NULL, 'engineer11@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(12, 'code12', 1, 'Engineer 12', NULL, 'engineer12@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(13, 'code13', 1, 'Engineer 13', NULL, 'engineer13@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(14, 'code14', 1, 'Engineer 14', NULL, 'engineer14@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(15, 'code15', 1, 'Engineer 15', NULL, 'engineer15@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(16, 'code16', 1, 'Engineer 16', NULL, 'engineer16@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(17, 'code17', 1, 'Engineer 17', NULL, 'engineer17@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(18, 'code18', 1, 'Engineer 18', NULL, 'engineer18@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(19, 'code19', 1, 'Engineer 19', NULL, 'engineer19@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(20, 'code20', 1, 'Engineer 20', NULL, 'engineer20@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(21, 'code21', 1, 'Engineer 21', NULL, 'engineer21@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(22, 'code22', 1, 'Engineer 22', NULL, 'engineer22@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(23, 'code23', 1, 'Engineer 23', NULL, 'engineer23@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(24, 'code24', 1, 'Engineer 24', NULL, 'engineer24@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(25, 'code25', 1, 'Engineer 25', NULL, 'engineer25@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(26, 'code26', 1, 'Engineer 26', NULL, 'engineer26@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(27, 'code27', 1, 'Engineer 27', NULL, 'engineer27@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(28, 'code28', 1, 'Engineer 28', NULL, 'engineer28@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(29, 'code29', 1, 'Engineer 29', NULL, 'engineer29@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(30, 'code30', 1, 'Engineer 30', NULL, 'engineer30@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(31, 'code31', 1, 'Engineer 31', NULL, 'engineer31@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(32, 'code32', 1, 'Engineer 32', NULL, 'engineer32@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(33, 'code33', 1, 'Engineer 33', NULL, 'engineer33@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(34, 'code34', 1, 'Engineer 34', NULL, 'engineer34@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(35, 'code35', 1, 'Engineer 35', NULL, 'engineer35@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(36, 'code36', 1, 'Engineer 36', NULL, 'engineer36@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(37, 'code37', 1, 'Engineer 37', NULL, 'engineer37@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(38, 'code38', 1, 'Engineer 38', NULL, 'engineer38@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(39, 'code39', 1, 'Engineer 39', NULL, 'engineer39@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(40, 'code40', 1, 'Engineer 40', NULL, 'engineer40@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(41, 'code41', 1, 'Engineer 41', NULL, 'engineer41@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(42, 'code42', 1, 'Engineer 42', NULL, 'engineer42@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(43, 'code43', 1, 'Engineer 43', NULL, 'engineer43@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(44, 'code44', 1, 'Engineer 44', NULL, 'engineer44@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(45, 'code45', 1, 'Engineer 45', NULL, 'engineer45@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(46, 'code46', 1, 'Engineer 46', NULL, 'engineer46@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(47, 'code47', 1, 'Engineer 47', NULL, 'engineer47@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(48, 'code48', 1, 'Engineer 48', NULL, 'engineer48@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(49, 'code49', 1, 'Engineer 49', NULL, 'engineer49@tctav.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `engineers` ENABLE KEYS */;


-- Dumping structure for table tav_etm.engineer_position_history
CREATE TABLE IF NOT EXISTS `engineer_position_history` (
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

-- Dumping data for table tav_etm.engineer_position_history: ~0 rows (approximately)
DELETE FROM `engineer_position_history`;
/*!40000 ALTER TABLE `engineer_position_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `engineer_position_history` ENABLE KEYS */;


-- Dumping structure for table tav_etm.engineer_soft_skill_level_history
CREATE TABLE IF NOT EXISTS `engineer_soft_skill_level_history` (
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

-- Dumping data for table tav_etm.engineer_soft_skill_level_history: ~0 rows (approximately)
DELETE FROM `engineer_soft_skill_level_history`;
/*!40000 ALTER TABLE `engineer_soft_skill_level_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `engineer_soft_skill_level_history` ENABLE KEYS */;


-- Dumping structure for table tav_etm.engineer_technique_level_history
CREATE TABLE IF NOT EXISTS `engineer_technique_level_history` (
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

-- Dumping data for table tav_etm.engineer_technique_level_history: ~0 rows (approximately)
DELETE FROM `engineer_technique_level_history`;
/*!40000 ALTER TABLE `engineer_technique_level_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `engineer_technique_level_history` ENABLE KEYS */;


-- Dumping structure for table tav_etm.interview_forms
CREATE TABLE IF NOT EXISTS `interview_forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `engineer_id` int(10) unsigned NOT NULL,
  `technique_skill_feedback` tinyint(4) NOT NULL,
  `management_skill_feedback` tinyint(4) NOT NULL,
  `other_feedback` text COLLATE utf8_unicode_ci,
  `interview_date` date DEFAULT NULL,
  `working_area_id` int(10) unsigned NOT NULL,
  `interviewer` text COLLATE utf8_unicode_ci NOT NULL,
  `interviewer_department` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `interview_forms_working_area_id_foreign` (`working_area_id`),
  KEY `interview_forms_engineer_id_foreign` (`engineer_id`),
  CONSTRAINT `interview_forms_engineer_id_foreign` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`engineer_id`) ON DELETE CASCADE,
  CONSTRAINT `interview_forms_working_area_id_foreign` FOREIGN KEY (`working_area_id`) REFERENCES `working_areas` (`working_area_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.interview_forms: ~0 rows (approximately)
DELETE FROM `interview_forms`;
/*!40000 ALTER TABLE `interview_forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `interview_forms` ENABLE KEYS */;


-- Dumping structure for table tav_etm.levels
CREATE TABLE IF NOT EXISTS `levels` (
  `level_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.levels: ~8 rows (approximately)
DELETE FROM `levels`;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` (`level_id`, `level_name`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'PG1', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'PG2', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'PG3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'PG4', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'SE5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'SE6', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, 'SE7', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 'SE8', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;


-- Dumping structure for table tav_etm.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.migrations: ~12 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2015_03_24_024720_create_users_table', 1),
	('2015_04_01_000001_create_working_areas_table', 1),
	('2015_04_01_000002_create_soft_skills_table', 1),
	('2015_04_01_000003_create_departments_table', 1),
	('2015_04_01_000004_create_techniques_table', 1),
	('2015_04_01_000005_create_levels_table', 1),
	('2015_04_01_000006_create_engineers_table', 1),
	('2015_04_01_000007_create_interview_forms_table', 1),
	('2015_04_01_000008_create_monthly_utilizations_table', 1),
	('2015_04_01_000009_create_engineer_soft_skill_level_history_table', 1),
	('2015_04_01_000010_create_engineer_position_history_table', 1),
	('2015_04_01_000011_create_engineer_technique_level_history_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table tav_etm.monthly_utilizations
CREATE TABLE IF NOT EXISTS `monthly_utilizations` (
  `engineer_id` int(10) unsigned NOT NULL,
  `working_area_id` int(10) unsigned NOT NULL,
  `month` date NOT NULL,
  `utilization` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`engineer_id`,`working_area_id`,`month`),
  KEY `monthly_utilizations_working_area_id_foreign` (`working_area_id`),
  CONSTRAINT `monthly_utilizations_engineer_id_foreign` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`engineer_id`) ON DELETE CASCADE,
  CONSTRAINT `monthly_utilizations_working_area_id_foreign` FOREIGN KEY (`working_area_id`) REFERENCES `working_areas` (`working_area_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.monthly_utilizations: ~0 rows (approximately)
DELETE FROM `monthly_utilizations`;
/*!40000 ALTER TABLE `monthly_utilizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `monthly_utilizations` ENABLE KEYS */;


-- Dumping structure for table tav_etm.soft_skills
CREATE TABLE IF NOT EXISTS `soft_skills` (
  `soft_skill_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `soft_skill_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `soft_skill_description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`soft_skill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.soft_skills: ~3 rows (approximately)
DELETE FROM `soft_skills`;
/*!40000 ALTER TABLE `soft_skills` DISABLE KEYS */;
INSERT INTO `soft_skills` (`soft_skill_id`, `soft_skill_name`, `soft_skill_description`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Communication', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'Leadership', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'Teamwork', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `soft_skills` ENABLE KEYS */;


-- Dumping structure for table tav_etm.techniques
CREATE TABLE IF NOT EXISTS `techniques` (
  `technique_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `technique_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `technique_description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`technique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.techniques: ~5 rows (approximately)
DELETE FROM `techniques`;
/*!40000 ALTER TABLE `techniques` DISABLE KEYS */;
INSERT INTO `techniques` (`technique_id`, `technique_name`, `technique_description`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Understang Requirement', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'OOP/MVC', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'UML', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'Coding', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'Testing', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `techniques` ENABLE KEYS */;


-- Dumping structure for table tav_etm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.users: ~9 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_active`, `is_admin`, `created_at`, `updated_at`) VALUES
	(1, 'admin1', '$2y$10$.kUxM5grfsiR2fP3NPIB8eg72m/NFje3Cak1Jw/Boi/ti/QunFyoC', 'admin1@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'admin2', '$2y$10$qFn6LoaMpM8vzZ3loNZwae3OtqgV5QAoArl3Hw9Ilu8r/K4ygwSCK', 'admin2@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'admin3', '$2y$10$mhqOi/.IKLTrBslof976L.REvxdrECqi/qq2qehEsQ4wvO0CHS80O', 'admin3@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'admin4', '$2y$10$0S.72t5JP7falDeDdiy86ektct6mrkQw4SVUNOIEx32TofU79QGHW', 'admin4@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'admin5', '$2y$10$kM6uG1keFIFkiltrGHAbQ.is0n6wDPeXN9xrBuVxDwJAWk5/iCfr6', 'admin5@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'admin6', '$2y$10$fJgOW/VlQSxnRHiKcVTrcOqe2bovByb.94RIDT9HyVlqTJtbHrYem', 'admin6@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, 'admin7', '$2y$10$Z2OkNes8wsp/SWXHt62FluegmECBtPdJOk/mbcuS2LLESWTMt7ITC', 'admin7@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 'admin8', '$2y$10$lsKfFoF5aWajXwMQQNXdk.I0U0XoQp/R0Tkc7aopmh1UWr0nF7bdC', 'admin8@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(9, 'admin9', '$2y$10$yf7vBL/3q.YhiCdN98WqT.TachcH.MYOIgXddqzLVkhxlmc96nZ52', 'admin9@gmail.com', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table tav_etm.working_areas
CREATE TABLE IF NOT EXISTS `working_areas` (
  `working_area_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `working_area_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`working_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tav_etm.working_areas: ~3 rows (approximately)
DELETE FROM `working_areas`;
/*!40000 ALTER TABLE `working_areas` DISABLE KEYS */;
INSERT INTO `working_areas` (`working_area_id`, `working_area_name`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'PHP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'Java', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'Mobile', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `working_areas` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
