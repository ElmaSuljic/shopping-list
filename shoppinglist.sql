-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2019 at 07:22 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppinglist`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `articleId` bigint(20) NOT NULL AUTO_INCREMENT,
  `categoryId` bigint(20) NOT NULL,
  `articlename` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`articleId`),
  KEY `articles_categoryid_foreign` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articleId`, `categoryId`, `articlename`, `created_at`, `updated_at`) VALUES
(2, 3, 'Apples', '2019-10-16 12:26:28', '2019-10-16 13:40:41'),
(3, 6, 'Milk', '2019-10-16 12:46:14', '2019-10-16 12:46:14'),
(5, 3, 'Oranges', '2019-10-17 15:17:55', '2019-10-17 15:17:55'),
(6, 3, 'Bananas', '2019-10-17 15:18:03', '2019-10-17 15:18:03'),
(7, 4, 'Potatos', '2019-10-17 15:18:12', '2019-10-17 15:18:12'),
(8, 6, 'Gauda cheese', '2019-10-17 15:18:26', '2019-10-17 15:18:26'),
(9, 6, 'Gauda cheese', '2019-10-17 15:18:26', '2019-10-17 15:18:26'),
(10, 6, 'Mozzarela', '2019-10-17 15:18:37', '2019-10-17 15:18:37'),
(11, 5, 'Chicken', '2019-10-17 15:19:00', '2019-10-17 15:19:00'),
(12, 5, 'Fish', '2019-10-17 15:19:07', '2019-10-17 15:19:07'),
(13, 4, 'Onion', '2019-10-18 15:14:46', '2019-10-18 15:14:46'),
(14, 4, 'Tomato', '2019-10-18 15:14:56', '2019-10-18 15:14:56'),
(15, 4, 'Carrot', '2019-10-18 15:15:04', '2019-10-18 15:15:04'),
(16, 7, 'Shampoo', '2019-10-19 17:24:44', '2019-10-19 17:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryId` bigint(20) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryname`, `created_at`, `updated_at`) VALUES
(3, 'Fruits', '2019-10-16 09:37:28', '2019-10-16 13:12:17'),
(4, 'Veggies', '2019-10-16 10:06:55', '2019-10-16 10:06:55'),
(5, 'Meat', '2019-10-16 10:07:41', '2019-10-16 10:07:41'),
(6, 'Dairy', '2019-10-16 10:07:49', '2019-10-16 10:07:49'),
(7, 'Cosmetics', '2019-10-19 17:15:13', '2019-10-19 17:15:13'),
(8, 'Cleaning supplies', '2019-10-19 17:15:27', '2019-10-19 17:15:27'),
(9, 'Clothes', '2019-10-19 17:15:34', '2019-10-19 17:15:34'),
(10, 'Shoes', '2019-10-19 17:15:39', '2019-10-19 17:15:39'),
(13, 'New category 2', '2019-10-20 14:36:46', '2019-10-20 14:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listarticles`
--

DROP TABLE IF EXISTS `listarticles`;
CREATE TABLE IF NOT EXISTS `listarticles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `listId` bigint(20) NOT NULL,
  `articleId` bigint(10) NOT NULL,
  `quantity` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checked` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articleId` (`articleId`),
  KEY `listarticles_listid_foreign` (`listId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listarticles`
--

INSERT INTO `listarticles` (`id`, `listId`, `articleId`, `quantity`, `checked`, `created_at`, `updated_at`) VALUES
(31, 16, 14, '0', 0, '2019-10-18 16:06:44', '2019-10-18 16:07:33'),
(32, 16, 13, '0', 0, '2019-10-18 16:07:00', '2019-10-18 16:07:00'),
(33, 16, 6, '0', 0, '2019-10-19 17:37:05', '2019-10-19 17:37:05'),
(34, 17, 2, '0', 0, '2019-10-19 17:46:01', '2019-10-19 17:46:01'),
(35, 17, 5, '0', 0, '2019-10-19 17:46:01', '2019-10-19 17:46:01'),
(36, 17, 6, '0', 0, '2019-10-19 17:46:01', '2019-10-19 17:46:01'),
(37, 18, 7, '0', 0, '2019-10-19 17:48:19', '2019-10-19 17:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `listes`
--

DROP TABLE IF EXISTS `listes`;
CREATE TABLE IF NOT EXISTS `listes` (
  `listId` bigint(20) NOT NULL AUTO_INCREMENT,
  `listname` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`listId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listes`
--

INSERT INTO `listes` (`listId`, `listname`, `userId`, `created_at`, `updated_at`) VALUES
(16, 'test', 6, '2019-10-18 16:06:44', '2019-10-18 16:06:44'),
(17, 'Lista 2', 6, '2019-10-19 17:46:01', '2019-10-19 17:46:01'),
(18, 'list 3', 6, '2019-10-19 17:48:19', '2019-10-19 17:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_10_14_153348_create_userdetails_table', 2),
(5, '2019_10_14_153433_create_categories_table', 2),
(6, '2019_10_14_153519_create_articles_table', 2),
(7, '2019_10_14_153555_create_lists_table', 2),
(8, '2019_10_14_153740_create_listarticles_table', 2),
(9, '2019_10_15_103931_add_type_to_users', 3),
(10, '2019_10_15_105305_delete_userdetails', 4),
(11, '2019_10_17_172805_change_name_to_table_lists', 5),
(12, '2019_10_17_173852_change_column_name_in_listarticles', 6),
(13, '2019_10_17_175855_change_name_of_column_list_articles', 6),
(14, '2019_10_18_163122_add_foreign_key_on_listes', 7),
(15, '2019_10_18_163752_foreign_key_on_listarticles', 8),
(16, '2019_10_18_165450_change_db_engine', 9),
(17, '2019_10_18_165855_add_foregn_keys', 10),
(18, '2019_10_19_205727_foreign_key_on_articles', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usertype` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `usertype`) VALUES
(6, 'Elma Suljic', 'elmasuljic91@gmail.com', NULL, '$2y$10$Z1pQvdI0Ft9PiEn1r3Vq1eGsqJ526Ve.L355YYgMVUWc.6aur9xNe', NULL, '2019-10-16 17:17:43', '2019-10-16 17:17:43', 'administrator'),
(14, 'Test Admin', 'testadmin@mail.com', NULL, '$2y$10$LQmlADzu.8KwySzR7AYip.F3dlAFej1k1KcoJz534zbQ0hvCw9.hC', NULL, '2019-10-20 08:59:44', '2019-10-20 08:59:44', 'administrator'),
(16, 'Test User', 'testuser2@website.com', NULL, '$2y$10$Z4ls6Dr/8NUt/8bwbP5SJORXaNS9Fb.aqkSRomcJML69qfw65AAkm', NULL, '2019-10-20 14:36:49', '2019-10-20 14:36:49', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE;

--
-- Constraints for table `listarticles`
--
ALTER TABLE `listarticles`
  ADD CONSTRAINT `listarticles_ibfk_1` FOREIGN KEY (`articleId`) REFERENCES `articles` (`articleId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `listarticles_listid_foreign` FOREIGN KEY (`listId`) REFERENCES `listes` (`listId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
