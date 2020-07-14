-- --------------------------------------------------------
-- Host:                         twittelab.mysql.database.azure.com
-- Server version:               5.7.29-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for view smart.advanalysis
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `advanalysis` (
	`screen_id` BIGINT(20) NOT NULL,
	`num_people` DECIMAL(32,0) NULL,
	`smilling` DECIMAL(32,0) NULL,
	`time_front` DECIMAL(32,0) NULL,
	`advertisement_id` BIGINT(20) NOT NULL,
	`adv_watcher` DECIMAL(25,0) NULL,
	`created` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`class_name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci'
) ENGINE=MyISAM;

-- Dumping structure for table smart.advertisements
CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.advertisements: ~4 rows (approximately)
/*!40000 ALTER TABLE `advertisements` DISABLE KEYS */;
INSERT INTO `advertisements` (`id`, `name`, `url`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(23, 'زيت اكسنت', 'https://caroildetection.azurewebsites.net/back/videos/1592209492.mp4', NULL, '2020-06-08 10:52:23', '2020-06-15 08:24:53'),
	(24, 'زيت تيوتا كرولا', 'https://caroildetection.azurewebsites.net/back/videos/1591799138.mp4', NULL, '2020-06-08 10:56:22', '2020-06-10 14:25:39'),
	(25, 'leux زيت', 'https://caroildetection.azurewebsites.net/back/videos/1592130475.mp4', NULL, '2020-06-14 09:28:03', '2020-06-17 13:08:30'),
	(26, 'sdsd', 'https://caroildetection.azurewebsites.net/back/videos/1592138248.mp4', '2020-06-14 12:39:13', '2020-06-14 12:09:29', '2020-06-14 12:39:13'),
	(27, 'jhnmn', 'https://caroildetection.azurewebsites.net/back/videos/1592138071.mp4', '2020-06-14 12:35:10', '2020-06-14 12:34:32', '2020-06-14 12:35:10');
/*!40000 ALTER TABLE `advertisements` ENABLE KEYS */;

-- Dumping structure for table smart.advertisement_model_classes
CREATE TABLE IF NOT EXISTS `advertisement_model_classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertisement_id` bigint(20) NOT NULL,
  `model_class_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.advertisement_model_classes: ~16 rows (approximately)
/*!40000 ALTER TABLE `advertisement_model_classes` DISABLE KEYS */;
INSERT INTO `advertisement_model_classes` (`id`, `advertisement_id`, `model_class_id`, `created_at`, `updated_at`) VALUES
	(15, 23, 4, NULL, NULL),
	(16, 23, 5, NULL, NULL),
	(30, 23, 6, NULL, NULL),
	(31, 23, 7, NULL, NULL),
	(32, 23, 8, NULL, NULL),
	(33, 24, 9, NULL, NULL),
	(34, 24, 10, NULL, NULL),
	(35, 24, 11, NULL, NULL),
	(36, 24, 12, NULL, NULL),
	(37, 24, 13, NULL, NULL),
	(38, 24, 14, NULL, NULL),
	(39, 24, 15, NULL, NULL),
	(40, 25, 18, NULL, NULL),
	(41, 25, 19, NULL, NULL),
	(42, 25, 20, NULL, NULL),
	(43, 25, 21, NULL, NULL);
/*!40000 ALTER TABLE `advertisement_model_classes` ENABLE KEYS */;

-- Dumping structure for table smart.consumptions
CREATE TABLE IF NOT EXISTS `consumptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  `used_ads` int(11) NOT NULL DEFAULT '0',
  `subscription_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.consumptions: ~10 rows (approximately)
/*!40000 ALTER TABLE `consumptions` DISABLE KEYS */;
INSERT INTO `consumptions` (`id`, `user_id`, `package_id`, `used_ads`, `subscription_date`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 5, '2020-01-22 10:45:11', '2020-01-12 10:45:12', '2020-01-14 08:09:59'),
	(2, 3, 1, 0, '2020-01-23 09:47:35', '2020-01-13 09:47:36', '2020-01-13 09:47:36'),
	(3, 4, 1, 3, '2020-01-26 08:12:10', '2020-01-16 08:12:10', '2020-01-16 08:46:18'),
	(4, 5, 1, 10, '2020-06-14 12:34:34', '2020-01-20 11:08:11', '2020-06-14 12:34:34'),
	(5, 6, 1, 0, '2020-02-05 12:01:52', '2020-01-26 12:01:52', '2020-01-26 12:01:52'),
	(6, 7, 1, 0, '2020-02-05 15:33:15', '2020-01-26 15:33:16', '2020-01-26 15:33:16'),
	(7, 8, 1, 4, '2020-02-06 10:55:33', '2020-01-27 10:55:34', '2020-01-27 11:22:28'),
	(8, 9, 1, 0, '2020-02-09 21:12:27', '2020-01-30 21:12:27', '2020-01-30 21:12:27'),
	(9, 10, 1, 5, '2020-02-21 18:59:14', '2020-02-11 18:59:14', '2020-02-11 19:23:33'),
	(10, 11, 2, 0, '2020-03-25 06:20:47', '2020-02-24 06:20:47', '2020-02-24 06:20:47');
/*!40000 ALTER TABLE `consumptions` ENABLE KEYS */;

-- Dumping structure for table smart.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table smart.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.migrations: ~14 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_07_012739_create_packages_table', 1),
	(5, '2019_12_07_143814_create_advertisements_table', 1),
	(6, '2019_12_08_131035_create_models_table', 1),
	(7, '2019_12_08_131058_create_screens_table', 1),
	(8, '2019_12_08_132613_screen_advertisement', 1),
	(9, '2019_12_22_184608_package_models', 1),
	(10, '2019_12_22_193255_model_class', 1),
	(11, '2019_12_22_203345_create_consumptions_table', 1),
	(12, '2019_12_22_211719_advertisement__model_classes', 1),
	(13, '2019_12_22_213329_viewer__model_classes', 1),
	(14, '2019_12_22_214210_viewers', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table smart.models
CREATE TABLE IF NOT EXISTS `models` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.models: ~0 rows (approximately)
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'car oil', 'موديل تحديد زيت السيارات', '2020-01-12 09:17:17', '2020-01-12 09:17:17');
/*!40000 ALTER TABLE `models` ENABLE KEYS */;

-- Dumping structure for table smart.model_class
CREATE TABLE IF NOT EXISTS `model_class` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.model_class: ~26 rows (approximately)
/*!40000 ALTER TABLE `model_class` DISABLE KEYS */;
INSERT INTO `model_class` (`id`, `class_name`, `model_id`, `created_at`, `updated_at`) VALUES
	(1, 'Chevrolet_Malibo', 1, '2020-06-25 16:12:41', '2020-06-25 16:12:41'),
	(2, 'Ford_Expdition', 1, '2020-06-25 16:12:42', '2020-06-25 16:12:42'),
	(3, 'GMC_Yukon', 1, '2020-06-25 16:12:42', '2020-06-25 16:12:42'),
	(4, 'Hyundai_Accent', 1, '2020-06-25 16:12:42', '2020-06-25 16:12:42'),
	(5, 'Hyundai_Elantra', 1, '2020-06-25 16:12:43', '2020-06-25 16:12:43'),
	(6, 'Hyundai_Santafe', 1, '2020-06-25 16:12:43', '2020-06-25 16:12:43'),
	(7, 'Hyundai_Sonata', 1, '2020-06-25 16:12:43', '2020-06-25 16:12:43'),
	(8, 'Hyundai_Tucson', 1, '2020-06-25 16:12:44', '2020-06-25 16:12:44'),
	(9, 'Nessan_Maxima', 1, '2020-06-25 16:12:44', '2020-06-25 16:12:44'),
	(10, 'Nessan_Patrol', 1, '2020-06-25 16:12:44', '2020-06-25 16:12:44'),
	(11, 'Nessan_Pickup', 1, '2020-06-25 16:12:45', '2020-06-25 16:12:45'),
	(12, 'Nessan__Altima', 1, '2020-06-25 16:12:45', '2020-06-25 16:12:45'),
	(13, 'Toyota_Camry', 1, '2020-06-25 16:12:46', '2020-06-25 16:12:46'),
	(14, 'Toyota_Corolla', 1, '2020-06-25 16:12:46', '2020-06-25 16:12:46'),
	(15, 'Toyota_FJ', 1, '2020-06-25 16:12:46', '2020-06-25 16:12:46'),
	(16, 'Toyota_Fortunter', 1, '2020-06-25 16:12:47', '2020-06-25 16:12:47'),
	(17, 'Toyota_Hilux', 1, '2020-06-25 16:12:47', '2020-06-25 16:12:47'),
	(18, 'Toyota_Landcruiser', 1, '2020-06-25 16:12:47', '2020-06-25 16:12:47'),
	(19, 'Toyota_Rava4', 1, '2020-06-25 16:12:48', '2020-06-25 16:12:48'),
	(20, 'Toyota_Yaris', 1, '2020-06-25 16:12:48', '2020-06-25 16:12:48'),
	(21, 'kia_Cerato', 1, '2020-06-25 16:12:48', '2020-06-25 16:12:48'),
	(22, 'kia_Sportage', 1, '2020-06-25 16:12:49', '2020-06-25 16:12:49'),
	(23, 'lexus_ES', 1, '2020-06-25 16:12:49', '2020-06-25 16:12:49'),
	(24, 'lexus_GS', 1, '2020-06-25 16:12:50', '2020-06-25 16:12:50'),
	(25, 'lexus_LS', 1, '2020-06-25 16:12:50', '2020-06-25 16:12:50'),
	(26, 'lexus_GX', 1, '2020-06-25 16:12:50', '2020-06-25 16:12:50');
/*!40000 ALTER TABLE `model_class` ENABLE KEYS */;

-- Dumping structure for table smart.packages
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `allowed_ads` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `allow_statistics` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.packages: ~2 rows (approximately)
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` (`id`, `name`, `price`, `allowed_ads`, `duration`, `description`, `allow_statistics`, `created_at`, `updated_at`) VALUES
	(1, 'everything', 100.00, 10, 10, 'باقة شاملة', 1, '2020-01-12 10:43:47', '2020-01-12 10:43:47');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;

-- Dumping structure for table smart.package_models
CREATE TABLE IF NOT EXISTS `package_models` (
  `package_id` bigint(20) NOT NULL,
  `model_id` bigint(20) NOT NULL,
  PRIMARY KEY (`package_id`,`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.package_models: ~2 rows (approximately)
/*!40000 ALTER TABLE `package_models` DISABLE KEYS */;
INSERT INTO `package_models` (`package_id`, `model_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `package_models` ENABLE KEYS */;

-- Dumping structure for table smart.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table smart.screens
CREATE TABLE IF NOT EXISTS `screens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `default_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waiting_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `screens_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.screens: ~2 rows (approximately)
/*!40000 ALTER TABLE `screens` DISABLE KEYS */;
INSERT INTO `screens` (`id`, `name`, `description`, `user_id`, `default_url`, `waiting_url`, `code`, `status`, `created_at`, `updated_at`) VALUES
	(5, 'Car Store', 'Car Store ', 5, 'https://wakeb-ads.azurewebsites.net/Adv-master/videos/Adv5dfa9add35b32.webm', 'https://wakeb-ads.azurewebsites.net/Adv-master/videos/Adv5dfa9add35b32.webm', 12345, 1, NULL, '2020-01-30 21:05:31');
/*!40000 ALTER TABLE `screens` ENABLE KEYS */;

-- Dumping structure for table smart.screen_advertisement
CREATE TABLE IF NOT EXISTS `screen_advertisement` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `screen_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advertisement_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.screen_advertisement: ~4 rows (approximately)
/*!40000 ALTER TABLE `screen_advertisement` DISABLE KEYS */;
INSERT INTO `screen_advertisement` (`id`, `screen_id`, `advertisement_id`, `created_at`, `updated_at`) VALUES
	(1, '5', '23', NULL, NULL),
	(2, '5', '24', NULL, NULL),
	(3, '5', '25', NULL, NULL);
/*!40000 ALTER TABLE `screen_advertisement` ENABLE KEYS */;

-- Dumping structure for table smart.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `package_id`, `is_admin`, `status`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Smart', 'admin@smartads.com', 0, 1, 1, NULL, '$2y$10$90ssO/pXHciTs8wA891g2OffFU6Wd.8sqgOGwI9razanyRrd27PRq', 'b2QixQQYf702f0j1RiuvtCeb52lnYEkqCCIGwCnkkr2dFoYtKLxsbSxT2KwI', NULL, '2020-01-07 22:23:02', '2020-01-07 22:23:02'),
	(5, 'Customer', 'customer@wakeb.tech', 1, 0, 1, NULL, '$2y$10$5cPQ2vJZrAGBvrN1HftQruJ5IxSVfj1Bs4rRfJFBx9aZSW1e0eGfG', 'l4Sv2cKxvUieDryNzbAyrQsUzc91CQqiFy4p3CQmEuBCzpF3OP5mD3tRPRJz', NULL, '2020-01-20 11:08:10', '2020-01-20 11:08:10'),
	(6, 'Hamad', 'hamad@wakeb.tech', 1, 0, 1, NULL, '$2y$10$MZ13ZOnW0MGZBTiZZteD.uGc1zM4ywVNRXH9Vc4AG3gQNWHJpGz2i', '13SdpfPGCOKGdsFs7Q9H6GfWFNowIzJXtsj60LnntwLLRAwEAJg1dsCXSR1m', '2020-01-30 21:10:41', '2020-01-26 12:01:52', '2020-01-30 21:10:41'),
	(11, 'mohamed hassan', 'mohamedfullstack@gmail.com', 2, 0, 1, NULL, '$2y$10$8WhVONaBeWje.kCkdvU8iOlhade4LjWdb9Wpw.XpCfmIZuhIHGQ3.', NULL, NULL, '2020-02-24 06:20:46', '2020-02-24 06:20:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table smart.viewers
CREATE TABLE IF NOT EXISTS `viewers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `screen_id` bigint(20) NOT NULL,
  `number_of_people` int(11) NOT NULL,
  `smiling_percentage` int(11) NOT NULL,
  `time_in_front_of_camera` int(11) NOT NULL,
  `advertisement_id` bigint(20) NOT NULL,
  `watcher` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.viewers: ~0 rows (approximately)
/*!40000 ALTER TABLE `viewers` DISABLE KEYS */;
/*!40000 ALTER TABLE `viewers` ENABLE KEYS */;

-- Dumping structure for table smart.viewer_model_classes
CREATE TABLE IF NOT EXISTS `viewer_model_classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `viewer_id` bigint(20) NOT NULL,
  `model_class_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smart.viewer_model_classes: ~0 rows (approximately)
/*!40000 ALTER TABLE `viewer_model_classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `viewer_model_classes` ENABLE KEYS */;

-- Dumping structure for view smart.advanalysis
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `advanalysis`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `advanalysis` AS select `v`.`screen_id` AS `screen_id`,sum(`v`.`number_of_people`) AS `num_people`,sum(`v`.`smiling_percentage`) AS `smilling`,sum(`v`.`time_in_front_of_camera`) AS `time_front`,`v`.`advertisement_id` AS `advertisement_id`,sum(`v`.`watcher`) AS `adv_watcher`,date_format(`v`.`created_at`,'%Y-%m-%d') AS `created`,`m`.`name` AS `name`,`mc`.`class_name` AS `class_name` from (((`viewers` `v` join `viewer_model_classes` `vmc` on((`vmc`.`viewer_id` = `v`.`id`))) join `model_class` `mc` on((`mc`.`id` = `vmc`.`model_class_id`))) join `models` `m` on((`m`.`id` = `mc`.`model_id`))) group by `v`.`screen_id`,`v`.`advertisement_id`,date_format(`v`.`created_at`,'%Y-%m-%d'),`m`.`name`,`mc`.`class_name`;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
