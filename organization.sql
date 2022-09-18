-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 03:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organization`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `sign_in` datetime NOT NULL,
  `sign_out` datetime DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'open',
  `sign_in_location` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sign_out_location` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sign_in_lat` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sign_out_lat` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sign_in_long` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sign_out_long` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `emp_id`, `sign_in`, `sign_out`, `status`, `sign_in_location`, `sign_out_location`, `sign_in_lat`, `sign_out_lat`, `sign_in_long`, `sign_out_long`, `created_date`, `created_by`, `updated_date`, `updated_by`, `deleted`, `deleted_by`, `deleted_date`, `sort_order`) VALUES
(1, 1, '2022-09-14 21:18:24', NULL, 'open', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-14 21:18:24', NULL, '2022-09-14 21:18:24', NULL, 0, NULL, NULL, 0),
(2, 1, '2022-09-15 21:19:33', NULL, 'open', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-15 21:19:33', NULL, '2022-09-15 21:19:33', NULL, 0, NULL, NULL, 0),
(3, 2, '2022-09-15 21:19:33', NULL, 'open', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-15 21:19:33', NULL, '2022-09-15 21:43:51', NULL, 0, NULL, NULL, 0),
(4, 3, '2022-09-15 21:46:37', NULL, 'open', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-15 21:46:37', NULL, '2022-09-15 21:46:37', NULL, 0, NULL, NULL, 0),
(5, 4, '2022-09-15 21:59:32', NULL, 'open', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-15 21:59:32', NULL, '2022-09-15 21:59:32', NULL, 0, NULL, NULL, 0),
(6, 1, '2022-09-17 11:45:41', '2022-09-17 11:45:41', 'closed', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-17 11:45:41', NULL, '2022-09-17 12:22:30', NULL, 0, NULL, NULL, 0),
(7, 2, '2022-09-17 11:56:21', '2022-09-17 12:30:46', 'closed', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-17 11:56:21', NULL, '2022-09-17 12:30:46', NULL, 0, NULL, NULL, 0),
(8, 3, '2022-09-17 12:35:41', '2022-09-17 12:36:02', 'closed', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-17 12:35:41', NULL, '2022-09-17 12:36:02', NULL, 0, NULL, NULL, 0),
(9, 14, '2022-09-17 12:37:22', '2022-09-17 12:37:25', 'closed', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-17 12:37:22', NULL, '2022-09-17 12:37:25', NULL, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unique_token` int(11) NOT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `portal` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'service',
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'in_active',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `unique_token`, `mobile`, `email`, `image`, `portal`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`, `deleted`, `deleted_by`, `deleted_date`, `sort_order`) VALUES
(1, 'Monika Dialani', 111111, '0545350402', 'reach.monika.dialani@gmail.com', NULL, 'service', 'active', '2022-09-13 21:03:07', NULL, '2022-09-13 21:03:07', NULL, 0, NULL, NULL, 0),
(2, 'monika Dialani', 538207, NULL, 'kkrishna.dialani@gmail.com', NULL, 'service', 'active', '2022-09-13 21:03:45', NULL, '2022-09-13 21:03:45', NULL, 0, NULL, NULL, 0),
(3, 'Mosnika Dialani', 286704, '0545350402', 'reach.monika.dialani@gmail.com', NULL, 'service', 'active', '2022-09-13 21:53:44', NULL, '2022-09-13 21:53:44', NULL, 0, NULL, NULL, 0),
(4, 'Monika Dialani', 587029, '0545350402', 'reach.monika.dialani@gmail.com', NULL, 'service', 'in_active', '2022-09-13 22:04:27', NULL, '2022-09-13 22:04:27', NULL, 0, NULL, NULL, 0),
(5, 'ky re', 968037, '0545350402', 'reach.monika.dialani@gmail.com', NULL, 'service', 'in_active', '2022-09-13 22:06:12', NULL, '2022-09-14 14:17:51', NULL, 0, NULL, NULL, 0),
(9, 'sfgh thrhesh', 152740, NULL, NULL, NULL, 'service', 'active', '2022-09-14 13:02:01', NULL, '2022-09-14 13:02:01', NULL, 1, NULL, '2022-09-14 15:11:46', 0),
(10, 'test employee', 507463, '654321212', 'test@test.com', NULL, 'service', 'in_active', '2022-09-14 15:32:10', NULL, '2022-09-14 15:32:10', NULL, 0, NULL, NULL, 0),
(11, 'test2', 513294, '', 'test2@eee2', NULL, 'service', 'in_active', '2022-09-14 15:32:34', NULL, '2022-09-14 15:33:19', NULL, 0, NULL, NULL, 0),
(12, 'umesh katariya', 682054, '666666666', NULL, NULL, 'service', 'active', '2022-09-14 19:23:22', NULL, '2022-09-14 19:23:53', NULL, 0, NULL, NULL, 0),
(13, 'retwqwe', 897032, '', NULL, NULL, 'service', 'active', '2022-09-15 22:03:39', NULL, '2022-09-15 22:04:56', NULL, 0, NULL, NULL, 0),
(14, 'roc', 682750, '', NULL, NULL, 'service', 'active', '2022-09-15 22:05:50', NULL, '2022-09-15 22:06:22', NULL, 0, NULL, NULL, 0),
(15, 'yash agrawal', 807964, '', 'yash@gmail.com', NULL, 'service', 'in_active', '2022-09-15 22:07:15', NULL, '2022-09-15 22:08:24', NULL, 1, NULL, '2022-09-15 22:09:29', 0),
(17, 'new one', 543678, NULL, NULL, NULL, 'service', 'active', '2022-09-18 13:52:56', NULL, '2022-09-18 13:52:56', NULL, 0, NULL, NULL, 0),
(18, 'another new', 751649, NULL, NULL, NULL, 'service', 'in_active', '2022-09-18 13:53:30', NULL, '2022-09-18 13:53:30', NULL, 0, NULL, NULL, 0),
(19, 'testing some more', 527369, NULL, NULL, NULL, 'service', 'in_active', '2022-09-18 13:56:32', NULL, '2022-09-18 13:56:32', NULL, 0, NULL, NULL, 0),
(20, 'new test', 370482, NULL, NULL, NULL, 'service', 'active', '2022-09-18 13:56:54', NULL, '2022-09-18 13:56:54', NULL, 0, NULL, NULL, 0),
(21, 'checking', 843956, NULL, NULL, NULL, 'service', 'active', '2022-09-18 13:58:14', NULL, '2022-09-18 13:58:14', NULL, 0, NULL, NULL, 0),
(22, 'hello', 765842, NULL, NULL, NULL, 'service', 'active', '2022-09-18 14:01:13', NULL, '2022-09-18 14:01:13', NULL, 0, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
