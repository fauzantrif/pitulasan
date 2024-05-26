-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 01:13 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pitulasan`
--
CREATE DATABASE IF NOT EXISTS `db_pitulasan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_pitulasan`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(5) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `superuser` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `fullname`, `superuser`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Fauzan Tripath', 1),
(7, 'dolam', 'e10adc3949ba59abbe56e057f20f883e', 'Nurudlolam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `id` int(5) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('team','classified') COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `higher_point` int(3) NOT NULL DEFAULT 100,
  `lower_point` int(3) NOT NULL DEFAULT 15,
  `steping` int(3) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`id`, `name`, `type`, `terms`, `higher_point`, `lower_point`, `steping`) VALUES
(2, 'Balap Kelereng', 'classified', 'SMP: 3 match\r\nSD: @ 1 match', 100, 15, 5),
(3, 'Balap Karung', 'classified', 'SMP: 3 match\r\nSD: @ 1 match', 100, 15, 5),
(4, 'Estafet Kardus', 'classified', 'SMP: 3 match\r\nSD: @ 1 match', 100, 15, 5),
(6, 'Cerdas Cermat', 'team', '3 anak / regu', 100, 15, 5),
(7, 'Estafet Sarung', 'team', 'Semua peserta bermain', 100, 15, 5),
(8, 'Estafet Air', 'team', 'Semua peserta bermain', 100, 15, 5),
(9, 'Memasukkan Benang ke dalam Jarum', 'classified', 'SMP: 3 match\r\nSD: @ 1 match', 100, 15, 5),
(10, 'Memindahkan Gelas menggunakan Balon', 'classified', 'SMP: 3 match\r\nSD: @ 1 match', 100, 15, 5),
(11, 'Estafet Bola menggunakan Gelas', 'team', 'Semua peserta bermain', 100, 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `competition_transactions`
--

CREATE TABLE `competition_transactions` (
  `id` int(10) NOT NULL,
  `id_comp` int(5) NOT NULL,
  `id_participant` int(5) DEFAULT NULL,
  `id_team` int(5) DEFAULT NULL,
  `grouping` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` int(3) NOT NULL DEFAULT 1,
  `point` int(3) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competition_transactions`
--

INSERT INTO `competition_transactions` (`id`, `id_comp`, `id_participant`, `id_team`, `grouping`, `copy`, `point`, `date_added`) VALUES
(8, 11, NULL, 3, NULL, 1, 100, '2023-08-13 01:30:36'),
(9, 11, NULL, 6, NULL, 1, 95, '2023-08-13 01:30:36'),
(10, 11, NULL, 1, NULL, 1, 90, '2023-08-13 01:30:36'),
(11, 11, NULL, 4, NULL, 1, 85, '2023-08-13 01:30:36'),
(12, 11, NULL, 5, NULL, 1, 85, '2023-08-13 01:30:36'),
(13, 11, NULL, 7, NULL, 1, 85, '2023-08-13 01:30:36'),
(15, 10, 35, 3, 'SMP', 1, 100, '2023-08-13 01:30:36'),
(16, 10, 34, 1, 'SMP', 1, 100, '2023-08-13 01:30:36'),
(17, 10, 36, 6, 'SMP', 1, 100, '2023-08-13 01:30:36'),
(18, 10, 30, 4, 'SMP', 1, 95, '2023-08-13 01:30:36'),
(19, 10, 31, 5, 'SMP', 1, 95, '2023-08-13 01:30:36'),
(21, 10, 37, 6, 'SMP', 2, 100, '2023-08-13 01:30:36'),
(22, 10, 38, 1, 'SMP', 2, 95, '2023-08-13 01:30:36'),
(23, 10, 32, 3, 'SMP', 2, 95, '2023-08-13 01:30:36'),
(24, 10, 33, 5, 'SMP', 2, 90, '2023-08-13 01:30:36'),
(25, 10, 39, 4, 'SMP', 2, 90, '2023-08-13 01:30:36'),
(27, 10, 44, 6, 'SMP', 3, 100, '2023-08-13 01:30:36'),
(28, 10, 41, 1, 'SMP', 3, 95, '2023-08-13 01:30:36'),
(29, 10, 43, 5, 'SMP', 3, 95, '2023-08-13 01:30:36'),
(31, 10, 23, 4, 'SD - Senior', 1, 100, '2023-08-13 01:30:36'),
(32, 10, 29, 5, 'SD - Senior', 1, 95, '2023-08-13 01:30:36'),
(33, 10, 28, 1, 'SD - Senior', 1, 90, '2023-08-13 01:30:36'),
(34, 10, 24, 6, 'SD - Senior', 1, 90, '2023-08-13 01:30:36'),
(35, 10, 25, 3, 'SD - Senior', 1, 85, '2023-08-13 01:30:36'),
(37, 10, 52, 7, 'SD - Junior', 1, 100, '2023-08-13 01:30:36'),
(38, 10, 21, 6, 'SD - Junior', 1, 95, '2023-08-13 01:30:36'),
(39, 10, 15, 4, 'SD - Junior', 1, 95, '2023-08-13 01:30:36'),
(40, 10, 19, 3, 'SD - Junior', 1, 95, '2023-08-13 01:30:36'),
(41, 10, 16, 5, 'SD - Junior', 1, 90, '2023-08-13 01:30:36'),
(42, 10, 22, 1, 'SD - Junior', 1, 85, '2023-08-13 01:30:36'),
(44, 10, 14, 4, 'SD - Fresh', 1, 100, '2023-08-13 01:30:36'),
(45, 10, 11, 1, 'SD - Fresh', 1, 95, '2023-08-13 01:30:36'),
(46, 8, NULL, 6, NULL, 1, 100, '2023-08-13 01:30:36'),
(47, 8, NULL, 7, NULL, 1, 95, '2023-08-13 01:30:36'),
(48, 8, NULL, 3, NULL, 1, 90, '2023-08-13 01:30:36'),
(49, 8, NULL, 1, NULL, 1, 85, '2023-08-13 01:30:36'),
(50, 8, NULL, 4, NULL, 1, 80, '2023-08-13 01:30:36'),
(51, 8, NULL, 5, NULL, 1, 75, '2023-08-13 01:30:36'),
(53, 2, 34, 1, 'SMP', 1, 100, '2023-08-13 09:23:07'),
(54, 2, 36, 6, 'SMP', 1, 95, '2023-08-13 09:23:07'),
(55, 2, 33, 5, 'SMP', 1, 90, '2023-08-13 09:23:07'),
(56, 2, 30, 4, 'SMP', 1, 85, '2023-08-13 09:23:07'),
(57, 2, 46, 7, 'SMP', 1, 80, '2023-08-13 09:23:07'),
(58, 2, 32, 3, 'SMP', 1, 75, '2023-08-13 09:23:07'),
(61, 2, 23, 4, 'SD - Senior', 1, 100, '2023-08-13 09:32:13'),
(62, 2, 25, 3, 'SD - Senior', 1, 95, '2023-08-13 09:32:13'),
(63, 2, 26, 5, 'SD - Senior', 1, 90, '2023-08-13 09:32:13'),
(64, 2, 24, 6, 'SD - Senior', 1, 85, '2023-08-13 09:32:13'),
(65, 2, 28, 1, 'SD - Senior', 1, 80, '2023-08-13 09:32:13'),
(66, 2, 48, 7, 'SD - Senior', 1, 75, '2023-08-13 09:32:13'),
(70, 2, 52, 7, 'SD - Junior', 1, 100, '2023-08-13 09:38:53'),
(71, 2, 16, 5, 'SD - Junior', 1, 95, '2023-08-13 09:38:53'),
(72, 2, 20, 6, 'SD - Junior', 1, 90, '2023-08-13 09:38:53'),
(73, 2, 15, 4, 'SD - Junior', 1, 85, '2023-08-13 09:38:53'),
(75, 2, 38, 1, 'SMP', 2, 100, '2023-08-13 09:41:27'),
(76, 2, 37, 6, 'SMP', 2, 95, '2023-08-13 09:41:27'),
(77, 2, 39, 4, 'SMP', 2, 90, '2023-08-13 09:41:27'),
(79, 2, 43, 5, 'SMP', 3, 100, '2023-08-13 09:45:21'),
(80, 2, 44, 6, 'SMP', 3, 95, '2023-08-13 09:45:21'),
(81, 2, 49, 7, 'SMP', 3, 90, '2023-08-13 09:45:21'),
(83, 9, 34, 1, 'SMP', 1, 100, '2023-08-13 10:00:51'),
(84, 9, 30, 4, 'SMP', 1, 95, '2023-08-13 10:00:51'),
(85, 9, 36, 6, 'SMP', 1, 90, '2023-08-13 10:00:51'),
(86, 9, 32, 3, 'SMP', 1, 85, '2023-08-13 10:00:51'),
(88, 9, 37, 6, 'SMP', 2, 100, '2023-08-13 10:08:15'),
(89, 9, 35, 3, 'SMP', 2, 95, '2023-08-13 10:08:15'),
(90, 9, 33, 5, 'SMP', 2, 90, '2023-08-13 10:08:15'),
(91, 9, 38, 1, 'SMP', 2, 85, '2023-08-13 10:08:15'),
(92, 9, 39, 4, 'SMP', 2, 80, '2023-08-13 10:08:15'),
(94, 9, 43, 5, 'SMP', 3, 100, '2023-08-13 10:13:06'),
(95, 9, 49, 7, 'SMP', 3, 95, '2023-08-13 10:13:06'),
(96, 9, 44, 6, 'SMP', 3, 90, '2023-08-13 10:13:06'),
(98, 9, 28, 1, 'SD - Senior', 1, 100, '2023-08-13 10:18:11'),
(99, 9, 26, 5, 'SD - Senior', 1, 95, '2023-08-13 10:18:11'),
(100, 9, 23, 4, 'SD - Senior', 1, 90, '2023-08-13 10:18:11'),
(101, 9, 24, 6, 'SD - Senior', 1, 85, '2023-08-13 10:18:11'),
(102, 9, 25, 3, 'SD - Senior', 1, 80, '2023-08-13 10:18:11'),
(103, 9, 48, 7, 'SD - Senior', 1, 75, '2023-08-13 10:18:11'),
(105, 9, 20, 6, 'SD - Junior', 1, 100, '2023-08-13 10:24:07'),
(106, 9, 15, 4, 'SD - Junior', 1, 95, '2023-08-13 10:24:07'),
(107, 9, 52, 7, 'SD - Junior', 1, 90, '2023-08-13 10:24:07'),
(108, 9, 16, 5, 'SD - Junior', 1, 85, '2023-08-13 10:24:07'),
(109, 9, 18, 1, 'SD - Junior', 1, 80, '2023-08-13 10:24:07'),
(111, 9, 13, 7, 'SD - Fresh', 1, 100, '2023-08-13 10:33:19'),
(112, 9, 14, 4, 'SD - Fresh', 1, 95, '2023-08-13 10:33:19'),
(113, 9, 11, 1, 'SD - Fresh', 1, 90, '2023-08-13 10:33:19'),
(115, 3, 34, 1, 'SMP', 1, 100, '2023-08-13 11:48:56'),
(116, 3, 36, 6, 'SMP', 1, 95, '2023-08-13 11:48:56'),
(117, 3, 30, 4, 'SMP', 1, 90, '2023-08-13 11:48:56'),
(118, 3, 32, 3, 'SMP', 1, 85, '2023-08-13 11:48:56'),
(120, 3, 37, 6, 'SMP', 2, 100, '2023-08-13 11:55:24'),
(121, 3, 39, 4, 'SMP', 2, 95, '2023-08-13 11:55:24'),
(122, 3, 33, 5, 'SMP', 2, 90, '2023-08-13 11:55:24'),
(123, 3, 38, 1, 'SMP', 2, 85, '2023-08-13 11:55:24'),
(125, 3, 44, 6, 'SMP', 3, 100, '2023-08-13 12:02:05'),
(126, 3, 49, 7, 'SMP', 3, 95, '2023-08-13 12:02:05'),
(127, 3, 43, 5, 'SMP', 3, 90, '2023-08-13 12:02:07'),
(128, 3, 35, 3, 'SMP', 3, 85, '2023-08-13 12:02:07'),
(130, 3, 16, 5, 'SD - Junior', 1, 100, '2023-08-13 12:12:57'),
(131, 3, 17, 4, 'SD - Junior', 1, 95, '2023-08-13 12:12:57'),
(132, 3, 19, 3, 'SD - Junior', 1, 90, '2023-08-13 12:12:57'),
(134, 3, 29, 5, 'SD - Senior', 1, 100, '2023-08-13 12:18:32'),
(135, 3, 24, 6, 'SD - Senior', 1, 95, '2023-08-13 12:18:32'),
(136, 3, 28, 1, 'SD - Senior', 1, 90, '2023-08-13 12:18:32'),
(137, 3, 23, 4, 'SD - Senior', 1, 85, '2023-08-13 12:18:32'),
(138, 7, NULL, 6, NULL, 1, 100, '2023-08-13 15:35:24'),
(139, 7, NULL, 1, NULL, 1, 95, '2023-08-13 15:35:24'),
(140, 7, NULL, 4, NULL, 1, 90, '2023-08-13 15:35:24'),
(141, 7, NULL, 7, NULL, 1, 85, '2023-08-13 15:35:24'),
(142, 7, NULL, 3, NULL, 1, 80, '2023-08-13 15:35:24'),
(143, 7, NULL, 5, NULL, 1, 75, '2023-08-13 15:35:24'),
(145, 4, 28, 1, 'SD - Senior', 1, 100, '2023-08-13 15:37:10'),
(146, 4, 29, 5, 'SD - Senior', 1, 95, '2023-08-13 15:37:10'),
(147, 4, 23, 4, 'SD - Senior', 1, 90, '2023-08-13 15:37:10'),
(148, 4, 48, 7, 'SD - Senior', 1, 85, '2023-08-13 15:37:10'),
(149, 4, 25, 3, 'SD - Senior', 1, 80, '2023-08-13 15:37:10'),
(151, 4, 19, 3, 'SD - Junior', 1, 100, '2023-08-13 15:37:56'),
(152, 4, 17, 4, 'SD - Junior', 1, 95, '2023-08-13 15:37:56'),
(153, 4, 52, 7, 'SD - Junior', 1, 90, '2023-08-13 15:37:56'),
(154, 4, 16, 5, 'SD - Junior', 1, 85, '2023-08-13 15:37:56'),
(155, 4, 20, 6, 'SD - Junior', 1, 80, '2023-08-13 15:37:56'),
(156, 4, 22, 1, 'SD - Junior', 1, 75, '2023-08-13 15:37:56'),
(172, 4, 13, 7, 'SD - Fresh', 1, 100, '2023-08-13 15:48:36'),
(173, 4, 14, 4, 'SD - Fresh', 1, 95, '2023-08-13 15:48:36'),
(174, 4, 11, 1, 'SD - Fresh', 1, 90, '2023-08-13 15:48:36'),
(187, 6, NULL, 6, NULL, 1, 700, '2023-08-13 17:44:41'),
(188, 6, NULL, 1, NULL, 1, 300, '2023-08-13 17:44:41'),
(189, 6, NULL, 4, NULL, 1, 600, '2023-08-13 17:44:41'),
(190, 6, NULL, 5, NULL, 1, 600, '2023-08-13 17:44:41'),
(191, 6, NULL, 3, NULL, 1, 500, '2023-08-13 17:44:41'),
(192, 6, NULL, 7, NULL, 1, 300, '2023-08-13 17:44:41'),
(193, 4, 34, 1, 'SMP', 1, 100, '2023-08-14 07:55:32'),
(194, 4, 30, 4, 'SMP', 1, 95, '2023-08-14 07:55:32'),
(195, 4, 37, 6, 'SMP', 1, 90, '2023-08-14 07:55:32'),
(196, 4, 32, 3, 'SMP', 1, 85, '2023-08-14 07:55:32'),
(197, 4, 49, 7, 'SMP', 1, 80, '2023-08-14 07:55:32'),
(198, 4, 33, 5, 'SMP', 1, 75, '2023-08-14 07:55:32'),
(223, 4, 44, 6, 'SMP', 2, 100, '2023-08-14 08:05:50'),
(224, 4, 43, 5, 'SMP', 2, 95, '2023-08-14 08:05:50'),
(225, 4, 49, 7, 'SMP', 2, 90, '2023-08-14 08:05:50'),
(226, 4, 35, 3, 'SMP', 2, 85, '2023-08-14 08:05:50'),
(227, 4, 38, 1, 'SMP', 2, 80, '2023-08-14 08:05:50'),
(228, 4, 39, 4, 'SMP', 2, 75, '2023-08-14 08:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int(5) NOT NULL,
  `fullname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `callname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grouping` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team` int(5) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `added_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`id`, `fullname`, `callname`, `grouping`, `team`, `date_added`, `added_by`) VALUES
(5, 'Nafiza Humaira', 'Fiza', 'PAUD - TK', NULL, '2023-08-07 23:08:15', 1),
(6, 'Lala', 'Lala', 'PAUD - TK', NULL, '2023-08-07 23:08:25', 1),
(7, 'Muhammad Hajid Al Falah', 'Hajid', 'PAUD - TK', NULL, '2023-08-07 23:09:00', 1),
(8, 'Muhammad Danish Nusa Bakti', 'Danish', 'PAUD - TK', NULL, '2023-08-07 23:09:23', 1),
(9, 'Alinoy Rafasya Nafis', 'Al', 'PAUD - TK', NULL, '2023-08-07 23:10:00', 1),
(10, 'Faret', 'Faret', 'PAUD - TK', NULL, '2023-08-07 23:10:07', 1),
(11, 'Eling Nausha Aulia', 'Eling', 'SD - Fresh', 1, '2023-08-07 23:10:54', 1),
(12, 'Wildan', 'Wildan', 'SD - Fresh', 3, '2023-08-07 23:11:15', 1),
(13, 'Anjani Nasyifa', 'Anjani', 'SD - Fresh', 7, '2023-08-07 23:13:32', 1),
(14, 'Lisa Romadhona', 'Lisa', 'SD - Fresh', 4, '2023-08-07 23:13:44', 1),
(15, 'Nafiis Atharizz Bilfaqih', 'Nafiis', 'SD - Junior', 4, '2023-08-07 23:14:21', 1),
(16, 'Bayu', 'Bayu', 'SD - Junior', 5, '2023-08-07 23:14:29', 1),
(17, 'Atief Aufa Syarif', 'Oa', 'SD - Junior', 4, '2023-08-07 23:14:40', 1),
(18, 'Defkan', 'Defkan', 'SD - Junior', 1, '2023-08-07 23:14:48', 1),
(19, 'Afiq', 'Afiq', 'SD - Junior', 3, '2023-08-07 23:14:58', 1),
(20, 'Khalisa Fidela', 'Icha', 'SD - Junior', 6, '2023-08-07 23:15:12', 1),
(21, 'Aulia Kanza Musayamah', 'Kanza', 'SD - Junior', 6, '2023-08-07 23:15:26', 1),
(22, 'Yasmine Feodora Calista', 'Yasmine', 'SD - Junior', 1, '2023-08-07 23:15:38', 1),
(23, 'Monika Putri Zahrana', 'Monik', 'SD - Senior', 4, '2023-08-07 23:26:46', 1),
(24, 'Nadhin Aulia Kirana', 'Nadhin', 'SD - Senior', 6, '2023-08-07 23:27:01', 1),
(25, 'Naura Nadhifa', 'Naura', 'SD - Senior', 3, '2023-08-07 23:27:12', 1),
(26, 'Aldebaran M. Irsyad', 'Irsyad', 'SD - Senior', 5, '2023-08-07 23:27:28', 1),
(27, 'Novandi', 'Nopan', 'SD - Senior', 3, '2023-08-07 23:27:36', 1),
(28, 'Firdan', 'Firdan', 'SD - Senior', 1, '2023-08-07 23:27:52', 1),
(29, 'Zaeniatul Maghfiroh R.', 'Nia', 'SD - Senior', 5, '2023-08-07 23:28:06', 1),
(30, 'Ghina Callista', 'Gina', 'SMP', 4, '2023-08-07 23:28:32', 1),
(31, 'Putri Dwi Rahayu', 'Putri', 'SMP', 5, '2023-08-07 23:28:50', 1),
(32, 'Hana Isnaini', 'Hana', 'SMP', 3, '2023-08-07 23:29:01', 1),
(33, 'Ananda Tisya Putri Regina', 'Tisya', 'SMP', 5, '2023-08-07 23:29:15', 1),
(34, 'Falih Hafiz Ramadhan', 'Hafiz', 'SMP', 1, '2023-08-07 23:29:31', 1),
(35, 'Fardan Ilham Fauzi', 'Fardan', 'SMP', 3, '2023-08-07 23:29:42', 1),
(36, 'Faiz Abdul Majid', 'Faiz', 'SMP', 6, '2023-08-07 23:29:52', 1),
(37, 'Dede Indra Yuliawan', 'Dede', 'SMP', 6, '2023-08-07 23:30:03', 1),
(38, 'Rafa Dwi Setiawan', 'Rafa', 'SMP', 1, '2023-08-07 23:31:48', 1),
(39, 'Yusuf Bahtiar', 'Yusuf', 'SMP', 4, '2023-08-07 23:31:58', 1),
(40, 'Miftahul Manan', 'Manan', 'SMP', 3, '2023-08-07 23:35:36', 1),
(41, 'Yogi', 'Yogi', 'SMP', 1, '2023-08-07 23:39:13', 1),
(42, 'Bita', 'Bita', 'SMP', 4, '2023-08-07 23:40:50', 1),
(43, 'Azril', 'Azril', 'SMP', 5, '2023-08-07 23:42:36', 1),
(44, 'Maman', 'Maman', 'SMP', 6, '2023-08-07 23:44:11', 1),
(45, 'M. Azwar Gustavio', 'Vio', 'PAUD - TK', NULL, '2023-08-10 08:34:14', 1),
(46, 'Vavian Hafiz Alfatih', 'Ole', 'SMP', 7, '2023-08-10 09:01:35', 1),
(47, 'Nindia Safa Agustinoval', 'Safa', 'SMP', 7, '2023-08-10 09:22:44', 1),
(48, 'Nathan Rauf Subekti', 'Rauf', 'SD - Senior', 7, '2023-08-10 09:22:57', 1),
(49, 'Alviano Krisna Saputra', 'Vian', 'SMP', 7, '2023-08-10 09:24:55', 1),
(50, 'Elvareta', 'Reta', 'SD - Fresh', 5, '2023-08-10 09:25:13', 1),
(51, 'Elenia', 'Elen', 'SD - Senior', 7, '2023-08-10 09:25:24', 1),
(52, 'Haura Nazhifa', 'Haura', 'SD - Junior', 7, '2023-08-10 09:27:23', 1),
(53, 'Mikaila', 'Kaila', 'SD - Fresh', 6, '2023-08-10 09:27:42', 1),
(54, 'Syafik Zayan Arifin', 'Apick', 'PAUD - TK', NULL, '2023-08-10 10:32:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(3) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `logo`) VALUES
(1, 'Garuda', 'team_garuda.png'),
(3, 'Gajah', 'team_gajah.png'),
(4, 'Jago', 'team_jago.png'),
(5, 'Jaguar', 'team_jaguar.png'),
(6, 'Singa', 'team_singa.png'),
(7, 'Jerapah', 'team_jerapah.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competition_transactions`
--
ALTER TABLE `competition_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `competition_transactions`
--
ALTER TABLE `competition_transactions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
