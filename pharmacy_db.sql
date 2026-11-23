-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2026 at 06:34 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

DROP TABLE IF EXISTS `medicines`;
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `quantity` int NOT NULL,
  `manufacture_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `price`, `quantity`, `manufacture_date`, `expiry_date`) VALUES
(8, 'dolo ', 30, 0, '2026-01-01', '2027-01-01'),
(14, 'paracetamol', 10, 10, '2025-01-01', '2027-02-01'),
(11, 'crocin', 25, 70, '2025-03-20', '2027-03-15'),
(16, 'Vitamin C Tablets', 35, 10, '2025-02-01', '2027-01-11'),
(17, 'Aspirin', 40, 20, '2026-11-11', '2027-01-01'),
(18, 'Allegra', 10, 50, '2021-01-01', '2022-01-01'),
(19, 'ors', 10, 40, '2026-01-01', '2027-01-01'),
(20, 'cipla', 10, 50, '2025-10-17', '2026-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `medicine_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `total` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `medicine_name`, `price`, `quantity`, `total`, `date`) VALUES
(1, 'dolo ', 30, 50, 1500, '2026-04-12 12:47:11'),
(2, 'paracetamol', 10, 30, 300, '2026-04-12 12:51:22'),
(3, 'paracetamol', 10, 30, 300, '2026-04-12 12:55:16'),
(4, 'dolo ', 30, 30, 900, '2026-04-12 13:17:46'),
(5, 'dolo ', 30, 50, 1500, '2026-04-12 13:29:58'),
(6, 'dolo ', 30, 30, 900, '2026-04-12 13:55:50'),
(7, 'Vitamin C Tablets', 35, 10, 350, '2026-04-13 08:32:45'),
(8, 'paracetamol', 10, 20, 200, '2026-04-13 09:47:44'),
(9, 'Vitamin C Tablets', 35, 100, 3500, '2026-04-13 10:05:51'),
(10, 'Vitamin C Tablets', 35, 10, 350, '2026-04-13 10:06:14'),
(11, 'paracetamol', 10, 10, 100, '2026-04-27 08:55:35'),
(12, 'Vitamin C Tablets', 35, 10, 350, '2026-04-27 09:14:29'),
(13, 'dolo ', 30, 20, 600, '2026-04-27 09:17:53'),
(14, 'dolo ', 30, 20, 600, '2026-04-27 09:21:18'),
(15, 'dolo ', 30, 50, 1500, '2026-04-27 09:24:29'),
(16, 'paracetamol', 10, 10, 100, '2026-04-27 10:11:08'),
(17, 'Vitamin C Tablets', 35, 10, 350, '2026-05-06 10:31:10'),
(18, 'Aspirin', 40, 40, 1600, '2026-05-13 14:45:05'),
(19, 'ors', 10, 10, 100, '2026-05-19 05:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company`, `phone`, `address`) VALUES
(1, 'Health pharma', 'sun pharma', '9999999999', 'Electronic City Bangalore'),
(2, 'Apollo Suppliers', 'Dr Reddy', '9888888888', 'indiranagar,Bangalore'),
(3, 'Sri Sai Suppliers', 'mankind pharma', '8899776655', 'BTM Layout,Bangalore'),
(4, 'HealthFirst Pharma', 'Torrent Pharmaceut', '9871200345', 'Yelahanka ,Bangalore');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '1234', 'admin'),
(2, 'pharma', '1234', 'pharmacist');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
