-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 30, 2024 at 12:40 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tennancyhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenant_id` int NOT NULL,
  `property_id` int NOT NULL,
  `user_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('pending','confirmed','canceled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tenant_id` (`tenant_id`),
  KEY `property_id` (`property_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenant_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `type_id` int NOT NULL,
  `agent_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tenant_id` (`tenant_id`),
  KEY `type_id` (`type_id`),
  KEY `agent_id` (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `tenant_id`, `name`, `description`, `image`, `location`, `price`, `type_id`, `agent_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sunny Apartments', 'Spacious 2-bedroom apartment with a balcony', 'sunnyApartments.jpg', '123 Sunshine St, Sunnyvale, CA', 1200.00, 1, 1, '2024-08-05 06:30:00', '2024-08-30 11:23:02'),
(3, 103, 'Industrial Warehouse', 'Large warehouse suitable for storage and distribution', 'industrialWarehouse.jpg', '789 Industrial Rd, San Jose, CA', 8000.00, 3, 3, '2024-08-05 06:30:00', '2024-08-07 10:40:26'),
(4, 104, 'Main Street Retail', 'Prime retail location with high foot traffic', 'mainStreetRetail.jpg', '101 Main St, Los Angeles, CA', 10000.00, 4, 4, '2024-08-05 06:30:00', '2024-08-07 10:40:35'),
(5, 105, 'Suburban Family Home', 'Cozy 3-bedroom home in a quiet neighborhood', 'suburbanFamilyHome.jpg', '202 Elm St, Delhi, CA', 2500.00, 5, 5, '2024-08-05 06:30:00', '2024-08-07 10:40:46'),
(6, 106, 'City Condos', 'Luxury condo with city views and amenities', 'cityCondos.jpg\r\n', '303 Cityview Dr, New York, NY', 3000.00, 6, 6, '2024-08-05 06:30:00', '2024-08-29 13:24:41'),
(7, 107, 'Riverside Townhouse', 'Townhouse with 3 floors and riverside view', 'riversidTownhouse.jpg', '404 River Rd, Mumbai, OR', 2800.00, 7, 7, '2024-08-05 06:30:00', '2024-08-29 13:25:25'),
(8, 108, 'Luxury Villa', 'Exclusive villa with private pool and garden', 'luxuryVilla.jpg', '505 Beverly Hills, CA', 15000.00, 8, 8, '2024-08-05 06:30:00', '2024-08-29 13:25:59'),
(9, 109, 'Seaside Vacation Rental', 'Beautiful vacation rental close to the beach', 'seasideVacationRental.jpg', '606 Seaside Ave, surat, FL', 2000.00, 9, 9, '2024-08-05 06:30:00', '2024-08-29 13:26:32'),
(10, 110, 'Downtown Co-Working Space', 'Modern co-working space with all amenities', 'downtownCo-WorkingSpace.jpg', '707 Business Plaza, Chicago, IL', 4000.00, 10, 10, '2024-08-05 06:30:00', '2024-08-29 13:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `propertyagents`
--

DROP TABLE IF EXISTS `propertyagents`;
CREATE TABLE IF NOT EXISTS `propertyagents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenant_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tenant_id` (`tenant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `propertyagents`
--

INSERT INTO `propertyagents` (`id`, `tenant_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 102, 'Rosalina D. William', 'rosalina@gmail.com', '2343256789', '2024-08-08 03:44:19', '2024-08-08 14:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `propertytypes`
--

DROP TABLE IF EXISTS `propertytypes`;
CREATE TABLE IF NOT EXISTS `propertytypes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenant_id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tenant_id` (`tenant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `propertytypes`
--

INSERT INTO `propertytypes` (`id`, `tenant_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 101, 'Residential Apartment', 'A multi-unit apartment building for residential purposes', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(2, 102, 'Commercial Office', 'Office space designed for business activities', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(3, 103, 'Industrial Warehouse', 'A large building for storing goods and materials', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(4, 104, 'Retail Store', 'Space designed for selling goods to consumers', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(5, 105, 'Single-Family Home', 'A standalone house designed for one family', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(6, 106, 'Condominium', 'A building with individual owned units', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(7, 107, 'Townhouse', 'A multi-story house that shares one or more walls with adjacent properties', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(8, 108, 'Luxury Villa', 'A high-end residential property with premium amenities', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(9, 109, 'Vacation Rental', 'A property rented out for short-term stays, typically for vacations', '2024-08-05 06:30:00', '2024-08-05 06:30:00'),
(10, 110, 'Co-Working Space', 'A shared office environment for independent workers or small teams', '2024-08-05 06:30:00', '2024-08-05 06:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `tenant_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`),
  KEY `tenant_id` (`tenant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `tenant_id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(5, 0, 'prinsi', 'prinsi@gmail.com', '$2y$10$XDRnctCjvaFE0nsqMGjxROPnzzzFWZMJk3D0Yk0otQtJsmZZaT.Qe', 'user', '2024-08-02 05:42:21', '2024-08-02 05:42:21'),
(2, 102, 'arti', 'arti@gmail.com', '445365ad804c1afe78ad5a5f3bd1fa83', 'user', '2024-08-02 04:58:05', '2024-08-02 05:34:00'),
(3, 0, 'aaa', 'aaa@gmail.com', '$2y$10$.IW2dhtlFkuJuTC7Sin8ZeVBN7AAWeiW6uMY0vugPwO.k/0Sd0h4u', 'user', '2024-08-02 05:24:12', '2024-08-02 05:24:12'),
(4, 0, 'vishva', 'vishva@gmail.com', '$2y$10$j2V7WlIeJyE2FJeVl3lJ5.E2wO3Sn3/K/i67AIC/pqOa8qgd.8Sri', 'admin', '2024-08-02 05:29:27', '2024-08-02 05:29:27'),
(6, 0, 'dhruvii', 'dhruvii@gmail.com', '$2y$10$j1izGm1kb94E855q.qEdxO6/hIcpVTEMWu0CS4CJZBrHiH2fywMku', 'user', '2024-08-02 06:09:51', '2024-08-02 06:09:51'),
(7, 0, 'dhruvii', 'dhruvii@gmail.com', '$2y$10$VvOx3jcf7/aSOyweGzz85ew29855W/LkaQIHzMPkUAcB7r00/34i.', 'user', '2024-08-02 06:22:10', '2024-08-02 06:22:10'),
(8, 0, 'dhruvii', 'dhruvii@gmail.com', '$2y$10$5NH/7P39TyF2/2fZhzZmZ.dD/1O1YaP2Sb4Z16R/3qZMLDvdFqKwe', 'user', '2024-08-02 06:22:20', '2024-08-02 06:22:20'),
(9, 0, 'kkk', 'kkk@gmail.com', '$2y$10$.ZRSNbPDnQmfObmESZky9.lnbmWAAJu1YtCRpfw9nYDwXRB.UyQdW', 'user', '2024-08-13 09:02:53', '2024-08-13 09:02:53'),
(10, 0, 'gupta', 'tinadiv2@gmail.com', '$2y$10$e.S1FBPgARW3U8GBtYP5y.Y7izfe94FtdTe8Td.FvI6AEHL1Vg3dS', 'user', '2024-08-13 09:21:44', '2024-08-13 09:21:44'),
(11, 0, 'asas', 'asas@gmail.com', '$2y$10$eZWMRoya2HsIzFlcjauCueDe0rolKSft/qnKHbHQuIarBKTJGhVdS', 'admin', '2024-08-28 10:19:30', '2024-08-28 10:19:30'),
(12, 0, 'tina', 'tina@gmail.com', '$2y$10$rPUSPUfSTOY2nN8iC.iKiept78DTYix1bjOQqnsfg8Dwubcf4UBCu', 'admin', '2024-08-28 10:57:17', '2024-08-28 10:57:17'),
(13, 0, 'tinass', 'tinass@gmail.com', '$2y$10$sESG0QFZr2dmNJU18LhKvuYCmNsg5SGv/6oA51eYTE/Us0Mb37HDi', 'user', '2024-08-28 11:01:05', '2024-08-28 11:01:05'),
(14, 0, 'aaaa', 'aaaa@gmail.com', '$2y$10$i2QvM6AlnDgp5KjgYxPwW.l50VeCEJClpRSobHSGQ23V4zfLEi5sG', 'user', '2024-08-28 11:46:16', '2024-08-28 11:46:16'),
(15, 0, 'aaaaa', 'aaaaa@gmail.com', '$2y$10$05yI.vc0vpCDELowXj0q0.3MysxNoxnO//OjKQKPvVmSOADNoaYOC', 'user', '2024-08-28 11:51:08', '2024-08-28 11:51:08'),
(16, 0, 'tinaaaa', 'tinaaaa@gmail.com', '$2y$10$ITw1vXP.UyGOTscoh5uJ5e8Cf4FSD9qqo1zXH34zk27Oa1vzboSYe', 'user', '2024-08-28 11:52:43', '2024-08-28 11:52:43'),
(17, 0, 'xyz', 'xyz@gmail.com', '$2y$10$SGEGMylx8xIi34j1xfRLvOi5ofyq1pPqcxXKObVd1Oe0lvgLG0/pW', 'user', '2024-08-28 11:59:49', '2024-08-28 11:59:49'),
(18, 0, 'xyza', 'xya@gmail.com', '$2y$10$B3utzIeuqwWK/mV1kLmvBerA2ng6yT2QST6NIRUlQ2nBz85lKvwM6', 'user', '2024-08-28 12:03:37', '2024-08-28 12:03:37'),
(19, 0, 'artiasa', 'artiasa@gmail.com', '$2y$10$rtkU0mhL0WZ5HaA3gn2hZeX20ArPgDBNNIHQocVmq28WxFqZL06m6', 'user', '2024-08-28 12:04:03', '2024-08-28 12:04:03'),
(20, 0, 'azaz', 'azaz@gmail.com', '$2y$10$3/gT.JyDmcTCv4k2ZhcSVe65GHcQnOQ2m.9Z6nyaHhy/wLeGIDnJa', 'user', '2024-08-28 13:10:52', '2024-08-28 13:10:52');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
