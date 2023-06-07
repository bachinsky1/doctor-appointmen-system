-- --------------------------------------------------------
-- Сервер:                       127.0.0.1
-- Версія сервера:               8.0.33 - MySQL Community Server - GPL
-- ОС сервера:                   Linux
-- HeidiSQL Версія:              12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for doctor-appointment-system
CREATE DATABASE IF NOT EXISTS `doctor-appointment-system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `doctor-appointment-system`;

-- Dumping structure for таблиця doctor-appointment-system.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.failed_jobs: ~0 rows (приблизно)
DELETE FROM `failed_jobs`;

-- Dumping structure for таблиця doctor-appointment-system.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.migrations: ~0 rows (приблизно)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_06_07_113057_create_roles_table', 1),
	(6, '2023_06_07_113107_create_permissions_table', 1),
	(7, '2023_06_07_113225_create_users_permissions_table', 1),
	(8, '2023_06_07_113301_create_users_roles_table', 1),
	(9, '2023_06_07_113335_create_roles_permissions_table', 1);

-- Dumping structure for таблиця doctor-appointment-system.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.password_resets: ~0 rows (приблизно)
DELETE FROM `password_resets`;

-- Dumping structure for таблиця doctor-appointment-system.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.permissions: ~3 rows (приблизно)
DELETE FROM `permissions`;
INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Manage users', 'manage-users', '2023-06-07 20:40:01', '2023-06-07 20:40:01'),
	(2, 'Create Appointments', 'create-appointments', '2023-06-07 20:40:01', '2023-06-07 20:40:01'),
	(3, 'Manage Appointments', 'manage-appointments', '2023-06-07 20:40:01', '2023-06-07 20:40:01');

-- Dumping structure for таблиця doctor-appointment-system.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.personal_access_tokens: ~0 rows (приблизно)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for таблиця doctor-appointment-system.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.roles: ~3 rows (приблизно)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'administrator', '2023-06-07 20:40:01', '2023-06-07 20:40:01'),
	(2, 'Health professional', 'health-professional', '2023-06-07 20:40:01', '2023-06-07 20:40:01'),
	(3, 'Patient', 'patient', '2023-06-07 20:40:01', '2023-06-07 20:40:01');

-- Dumping structure for таблиця doctor-appointment-system.roles_permissions
CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `roles_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.roles_permissions: ~0 rows (приблизно)
DELETE FROM `roles_permissions`;

-- Dumping structure for таблиця doctor-appointment-system.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.users: ~34 rows (приблизно)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Clint Eastwood', 'clint.eastwood@mail.com', NULL, '$2y$10$qFSn76RY9dfxoCWWtb7Xd.MA4l9yqme5vGdjILpfkNKRqRp/Z/.Ju', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(2, 'Lee Van Cliff', 'lee.van.cliff@mail.com', NULL, '$2y$10$BhkVAQaEgtWYvEl4we6dAuj8cTx7gTtro6lf7X2C5j69g8vrNWWm6', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(3, 'Jean Maria Volonte', 'jean.maria.volonte@mail.com', NULL, '$2y$10$fS.ltUapbyRFOdAhpdswFetfJcziQ.FAeRZSSohBhZxwWZoPIuRqe', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(4, 'Elly Wallah', 'elly.wallah@mail.com', NULL, '$2y$10$AkvQb7QivJRLcl/3HL/HHugyc7tG79i.WOwliZlyfPWdM8MD2uEXS', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(5, 'Hope Walter Jr.', 'mcglynn.jayce@example.org', NULL, '$2y$10$ch.K1TK.zh.YVoHBRMx0L.CDdH8CyvQy5wIsM.oo3uqY628qkImYS', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(6, 'Mrs. Graciela Schumm', 'bella23@example.com', NULL, '$2y$10$N.K/D4NLDT3tB7owGQkUa.2VCre7gBODTuK4S44GBY49RFBNVUZ36', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(7, 'Bianka Hoppe', 'annamarie.dibbert@example.com', NULL, '$2y$10$0FML2fAKbViMa0GmyXC4Teh0Ev1fcxJPdo/Bc9kzZdbN2IrRLjmOi', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(8, 'Prof. Walter Willms V', 'candida.walter@example.net', NULL, '$2y$10$OhZM3W0x.xcSkWZu7ju82uKhQYhga3QLwpO92UP9XnigQCjGukwii', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(9, 'Alfonzo Boyle III', 'lkeeling@example.net', NULL, '$2y$10$7iaIG3wPOXaohwAdzHOVvOEaymKtzAlrc1Uw6H8gXwQ2Ywjs70sfa', NULL, '2023-06-07 20:40:01', '2023-06-07 20:40:01', NULL),
	(10, 'Miss Elena Watsica DVM', 'alicia53@example.com', NULL, '$2y$10$owajtbPz2EzVEzba83g0g.0f/lsOcYDv4QgyLwSX7.WTVX5cmNh4m', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(11, 'Xavier Oberbrunner', 'gpredovic@example.com', NULL, '$2y$10$Ketegcan3hmnR0vXumXuruKnLmKNq5MggcIyphY3yMsjDbccmxjd6', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(12, 'Britney Legros', 'bradtke.marianne@example.com', NULL, '$2y$10$0ONtP1IHb2dnMfOkVe7OkODwOLaRzX2DfGe6xfNeoDDkGXvxbEXOu', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(13, 'Prof. Orlando Rolfson III', 'jakob.lind@example.org', NULL, '$2y$10$4jgEzewwMYgZhs3w8sxrZeawewuy3gYTojyvFk6y2bYC5L1p0mhhK', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(14, 'Mrs. Ashly Mann I', 'jarrod93@example.org', NULL, '$2y$10$tozJIUyzR8M.XzvGXIatSeDBcEii7DqBKcGu.UMCzra7nfcPajpIy', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(15, 'Gabriella Wilderman', 'veum.chadd@example.org', NULL, '$2y$10$GkJtLtb/JM.RQxrAbDJH1OQgUBjHWlplwrKwCGidz63Ex8D2mjqMK', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(16, 'Dr. Reed Collins Sr.', 'wendy.gleason@example.org', NULL, '$2y$10$Ex24fr2ZYw1bONYqfQd1IeuvwrtxMr94PtpkseUxvr/k6ejuMP8yy', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(17, 'Eli Durgan III', 'pfritsch@example.com', NULL, '$2y$10$TB2p4VuZkuNsPjThQzWrYOj8eQx5MGLQXX./qKaTimVEt1mgf/eGe', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(18, 'Samara Friesen PhD', 'fharvey@example.net', NULL, '$2y$10$FdUpxjuyxwVzI1R425eVieIKhv7q6r3kNiRkPwTlcJ0RWqJGfePPy', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(19, 'Prof. Effie Altenwerth', 'yessenia17@example.org', NULL, '$2y$10$A3zlVIEhv.77KozPVraAYOTqPfqLNRbxi4VdhhoK09aR6Ug1o/Qqa', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(20, 'Dr. Marianna Stracke Sr.', 'rogahn.leonor@example.net', NULL, '$2y$10$aLF4uLXPjxP.0w/LNFk4ves1LI8.cOV0C9fpXkeE6WzqNdnsUWtHm', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(21, 'Dannie Heathcote', 'rosa.rath@example.com', NULL, '$2y$10$0aErXUI6qF/Vb5SMOTltjOWLjViXn4bwLHj1J9sKJj0guDrZ5wu/W', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(22, 'Prof. Bennett Gutkowski', 'doyle.bethel@example.net', NULL, '$2y$10$YI36goznOkOkERrqjkiUsuyn33qY2LSEOzVsBRMw6faZrZDfH8Vlu', NULL, '2023-06-07 20:40:02', '2023-06-07 20:40:02', NULL),
	(23, 'Leilani Halvorson', 'schowalter.elody@example.org', NULL, '$2y$10$i1wSdUklPdTLYzy1GGCNYuojVuThu3RKbUckAXEW0DOQh2mGpkt4u', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(24, 'Prof. Alejandra Stokes', 'noble.labadie@example.org', NULL, '$2y$10$Em2bIWRd4h.wLhCmmHNYLuy1MTHWZBT73pZNm008VUOSrKNfzM9U2', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(25, 'Clotilde Rempel Jr.', 'leuschke.tianna@example.com', NULL, '$2y$10$03DJS26ZwUrDEKnoXpN4I.pUUJrIYKIJ/gk7jltgxck1RCJVrjXJq', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(26, 'Duncan Nikolaus', 'hartmann.shyann@example.com', NULL, '$2y$10$rYWmT6LjJ2Yg9AAgGm9exuC7WzJUbjXUTIJmOrC0qhxdCHaWk9JXa', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(27, 'Keeley Bode', 'grady.wuckert@example.org', NULL, '$2y$10$T7CaGgTK5oT0.uQeFoXto.QPWNKBT51eJeYyXf4MQ1ylxwT4iCadm', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(28, 'Arlie Cremin', 'norris79@example.org', NULL, '$2y$10$ioVppBHJW4ERrzwhhD6jJuLNVFlaOSOO.p0gOn0FTfW4tj.AklO8q', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(29, 'Durward Cronin', 'lehner.vicente@example.net', NULL, '$2y$10$jRkoIjXwPSbxUx1DL4Bwc.sIfN0vFX9pyS/WM.rk/hYCQwEbVa5s2', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(30, 'Darrion Schmeler', 'kirlin.alta@example.net', NULL, '$2y$10$qc/dtFGc0BN2us1dL7bkCO3NaE//GtUfOXf6KUUl/b4n57YrbXytu', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(31, 'Angel Schuster', 'kschoen@example.com', NULL, '$2y$10$cSpq1Z9a/9xSwioSRcWUqeOyXMFWqxsdkoVmz3/hbp7wwSVGR7z.K', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(32, 'Joshuah Gorczany', 'ruecker.carolyn@example.net', NULL, '$2y$10$Ml/oo/.b1.py3JptaUm5aOhXwdzVju5il5Q8f5rltQpby4iqKFCZ6', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(33, 'Laverne Batz', 'ufranecki@example.com', NULL, '$2y$10$aI9Fv9N/aD8kW4Ss6pVh8uLSv6s2BI8DtrkcvgDhFuxN0ntCVlnRW', NULL, '2023-06-07 20:40:03', '2023-06-07 20:40:03', NULL),
	(34, 'Lexie Keebler', 'lindsay.morissette@example.org', NULL, '$2y$10$jHdPmd.JbvoFExkK4N.vsecMkYLIvDZjIBikhwFcrQKtfDxPJsltS', NULL, '2023-06-07 20:40:04', '2023-06-07 20:40:04', NULL);

-- Dumping structure for таблиця doctor-appointment-system.users_permissions
CREATE TABLE IF NOT EXISTS `users_permissions` (
  `user_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `users_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.users_permissions: ~35 rows (приблизно)
DELETE FROM `users_permissions`;
INSERT INTO `users_permissions` (`user_id`, `permission_id`) VALUES
	(1, 1),
	(2, 2),
	(4, 2),
	(5, 2),
	(6, 2),
	(7, 2),
	(8, 2),
	(9, 2),
	(10, 2),
	(11, 2),
	(12, 2),
	(13, 2),
	(14, 2),
	(15, 2),
	(16, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(21, 2),
	(22, 2),
	(23, 2),
	(24, 2),
	(25, 2),
	(26, 2),
	(27, 2),
	(28, 2),
	(29, 2),
	(30, 2),
	(31, 2),
	(32, 2),
	(33, 2),
	(34, 2),
	(2, 3),
	(3, 3);

-- Dumping structure for таблиця doctor-appointment-system.users_roles
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `users_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doctor-appointment-system.users_roles: ~34 rows (приблизно)
DELETE FROM `users_roles`;
INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 2),
	(4, 3),
	(5, 3),
	(6, 3),
	(7, 3),
	(8, 3),
	(9, 3),
	(10, 3),
	(11, 3),
	(12, 3),
	(13, 3),
	(14, 3),
	(15, 3),
	(16, 3),
	(17, 3),
	(18, 3),
	(19, 3),
	(20, 3),
	(21, 3),
	(22, 3),
	(23, 3),
	(24, 3),
	(25, 3),
	(26, 3),
	(27, 3),
	(28, 3),
	(29, 3),
	(30, 3),
	(31, 3),
	(32, 3),
	(33, 3),
	(34, 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
