-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table astoncut.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint(20) unsigned NOT NULL,
  `time` datetime NOT NULL,
  `stylist_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.customers: ~11 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `phone`, `service_id`, `time`, `stylist_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Kenari Prabu Hakim', '85295937901', 3, '2022-07-02 03:24:59', 1, 1, '2022-07-08 10:49:25', '2022-07-08 14:37:30', NULL),
	(2, 'Kadir Saptono S.Pt', '85202177199', 6, '2022-07-13 00:19:02', 3, 3, '2022-07-08 10:49:25', '2022-07-08 10:49:25', NULL),
	(3, 'Abyasa Saiful Wibisono', '85206366840', 5, '2022-06-28 17:38:21', 2, 1, '2022-07-08 10:49:25', '2022-07-08 10:49:25', NULL),
	(4, 'Cahya Kambali Zulkarnain', '85260556328', 6, '2022-07-03 23:31:46', 5, 2, '2022-07-08 10:49:25', '2022-07-08 12:42:56', '2022-07-08 12:42:56'),
	(5, 'Lasmono Pratama', '85288878290', 3, '2022-06-14 16:05:17', 5, 2, '2022-07-08 10:49:25', '2022-07-08 10:49:25', NULL),
	(6, 'Nalar Harto Saefullah S.T.', '85298834888', 1, '2022-06-12 05:13:46', 2, 2, '2022-07-08 10:49:25', '2022-07-08 10:49:25', NULL),
	(7, 'Galih Jabal Latupono', '85213342016', 1, '2022-06-17 00:36:58', 1, 2, '2022-07-08 10:49:25', '2022-07-08 12:45:00', '2022-07-08 12:45:00'),
	(8, 'Tajul', '029 0673 401', 1, '2022-07-08 21:50:00', 1, 3, '2022-07-08 12:48:59', '2022-07-08 13:24:37', NULL),
	(9, 'Tajul', '029 0673 401', 3, '2022-07-08 20:27:00', 4, 1, '2022-07-08 13:27:18', '2022-07-08 13:27:18', NULL),
	(10, 'Aliando', '82134569012', 5, '2022-07-08 13:35:00', 5, 2, '2022-07-08 14:36:02', '2022-07-08 14:38:06', '2022-07-08 14:38:06'),
	(11, 'Syah Sury', '82313274894', 4, '2022-07-08 21:50:00', 4, 2, '2022-07-08 14:51:03', '2022-07-08 14:55:28', NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for table astoncut.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table astoncut.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.migrations: ~9 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_07_01_174955_create_customers_table', 1),
	(6, '2022_07_01_175154_create_services_table', 1),
	(7, '2022_07_03_105911_create_stylists_table', 1),
	(8, '2022_07_08_031112_create_transactions_table', 1),
	(9, '2022_07_08_034009_create_payment_methods_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table astoncut.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table astoncut.payment_methods
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.payment_methods: ~5 rows (approximately)
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` (`id`, `method`, `acc_number`, `created_at`, `updated_at`) VALUES
	(1, 'Cash', NULL, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(2, 'Shopeepay', '608082361002021', '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(3, 'Link Aja', '082361002021', '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(4, 'Bank BSI', '1169961919', '2022-07-08 11:05:44', '2022-07-08 11:42:30'),
	(5, 'Bank BCA', '12345678', '2022-07-08 11:55:39', '2022-07-08 11:55:39');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;

-- Dumping structure for table astoncut.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table astoncut.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.services: ~8 rows (approximately)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `service`, `price`, `created_at`, `updated_at`) VALUES
	(1, 'Regular Haircut', 40000, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(2, 'Kids Haircut', 35000, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(3, 'Shave', 20000, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(4, 'Basic Hair Colour', 60000, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(5, 'Hairstyling', 25000, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(6, 'Creambath/Mask', 45000, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(7, 'Facial Treatment', 75000, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(8, 'Full Treatment', 120000, '2022-07-08 14:41:35', '2022-07-08 14:41:45');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Dumping structure for table astoncut.stylists
CREATE TABLE IF NOT EXISTS `stylists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.stylists: ~5 rows (approximately)
/*!40000 ALTER TABLE `stylists` DISABLE KEYS */;
INSERT INTO `stylists` (`id`, `name`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Ivan Mansur', '85289692004', 'Jr. Bara No. 855, Padangsidempuan 38050, Jabar', 1, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(2, 'Hardana Aris Kusumo S.I.Kom', '85215341298', 'Dk. Radio No. 952, Jambi 51482, Banten', 2, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(3, 'Pranawa Anggriawan S.Psi', '85272184794', 'Jln. Supomo No. 256, Jayapura 37348, Sulsel', 2, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(4, 'Kasusra Salman Rajasa', '85272633960', 'Jln. Bappenas No. 611, Magelang 10055, Jatim', 1, '2022-07-08 10:49:25', '2022-07-08 10:49:25'),
	(5, 'Luthfi Santoso', '85286397439', 'Psr. Padma No. 770, Denpasar 86401, Sulut', 1, '2022-07-08 10:49:25', '2022-07-08 10:49:25');
/*!40000 ALTER TABLE `stylists` ENABLE KEYS */;

-- Dumping structure for table astoncut.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `time` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `payment_method` bigint(20) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.transactions: ~3 rows (approximately)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`id`, `order_id`, `time`, `price`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
	(1, 4, '2022-07-08 12:42:56', 45000, 4, 1, '2022-07-08 12:42:56', '2022-07-08 12:42:56'),
	(2, 7, '2022-07-08 12:45:00', 40000, 3, 1, '2022-07-08 12:45:00', '2022-07-08 12:45:00'),
	(3, 10, '2022-07-08 14:38:06', 25000, 2, 2, '2022-07-08 14:38:06', '2022-07-08 14:40:52');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Dumping structure for table astoncut.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table astoncut.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `photo`, `created_at`, `updated_at`, `is_admin`) VALUES
	(1, 'Muhammad Rizky', 'rizkysafdila@gmail.com', '0563 0170 5301', '2022-07-08 10:49:25', '$2y$10$sv2z6dmFcEgDoyQ7gllsGeTJzua.o309Z6vwswzZJtP3mMFKVi18O', 'axaImrNKrZdvjkVkieuvn411TRAtm4NYwfrKf2VIe3P6EwQIbWWGfbsSyFM7', NULL, '2022-07-08 10:49:25', '2022-07-08 11:40:49', 1),
	(2, 'Tajul', 'tajul@gmail.com', '029 0673 401', '2022-07-08 10:49:25', '$2y$10$DRFP.36Kj8IaORVgh06RE.pGWAEkJdrC0XUnB2vciwSirkpOUTfpW', 'SLjPN7gmLvmWtkhrYkt2C6TsPjH9FjqK0vbQULYioH8qQwI1RLKTpqwa9kH0', NULL, '2022-07-08 10:49:25', '2022-07-08 12:48:47', 0),
	(4, 'Syah Sury', 'sury@gmail.com', '82313274894', NULL, '$2y$10$ena8qJ9as0LiL03.LqtTJeYTzVffFZZ6eF.2aOo5Adc7M0HUIKbwG', NULL, NULL, '2022-07-08 13:56:19', '2022-07-08 13:56:19', 0),
	(5, 'Aliando', 'aliando@gmail.com', '82134569012', NULL, '$2y$10$o/ZfJad6cnIFGcJd41cAeu6rKN2NYuOB3UsgGzfQHRqOI6SVO0pk.', NULL, NULL, '2022-07-08 14:33:25', '2022-07-08 14:33:25', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
