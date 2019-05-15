-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2019 at 06:21 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finzad`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `meno` varchar(255) NOT NULL,
  `predmet` varchar(100) NOT NULL,
  `rok` varchar(20) NOT NULL,
  `hlavicka` varchar(512) NOT NULL,
  `hodnoty` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `id_student`, `meno`, `predmet`, `rok`, `hlavicka`, `hodnoty`) VALUES
(32, 12345, 'Priezvisko1 Meno1', 'Webtech', '2018/2019', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!3!4!3!3!2!2!!2!1,25!6!6!8!14,9!16!73,77!D'),
(33, 24598, 'Priezvisko2 Meno2', 'Webtech', '2018/2019', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!4!3!3!2!2!2!3!2!2!10!7!8!20!14!85,05!B'),
(34, 54187, 'Priezvisko3 Meno3', 'Webtech', '2018/2019', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!3!4!3!3!2!2!2!2!1,5!10!7!7!14,5!24!88,28!B'),
(35, 23581, 'Priezvisko4 Meno4', 'Webtech', '2018/2019', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!3!3!4!3!3!2!2!3!2!2!9!10!8!20!30!107!A'),
(40, 12345, 'Priezvisko1 Meno1', 'Matematika', '2018/2019', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!3!4!3!3!2!2!!2!1,25!6!6!8!14,9!16!73,77!D'),
(41, 24598, 'Priezvisko2 Meno2', 'Matematika', '2018/2019', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!4!3!3!2!2!2!3!2!2!10!7!8!20!14!85,05!B'),
(42, 54187, 'Priezvisko3 Meno3', 'Matematika', '2018/2019', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!3!4!3!3!2!2!2!2!1,5!10!7!7!14,5!24!88,28!B'),
(43, 23581, 'Priezvisko4 Meno4', 'Matematika', '2018/2019', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!3!3!4!3!3!2!2!3!2!2!9!10!8!20!30!107!A');

-- --------------------------------------------------------

--
-- Table structure for table `history_login`
--

CREATE TABLE `history_login` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `datetime_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `history_login`
--

INSERT INTO `history_login` (`id`, `id_user`, `datetime_login`) VALUES
(1, 1, '2019-05-10 14:48:38'),
(2, 2, '2019-05-10 14:49:25'),
(3, 10, '2019-05-10 21:22:54'),
(4, 10, '2019-05-11 09:59:30'),
(5, 10, '2019-05-11 11:59:34'),
(6, 10, '2019-05-11 13:34:50'),
(7, 10, '2019-05-12 08:13:39'),
(8, 10, '2019-05-12 08:46:41'),
(9, 10, '2019-05-12 08:58:34'),
(10, 10, '2019-05-15 07:00:59'),
(11, 10, '2019-05-15 08:50:47'),
(12, 10, '2019-05-15 09:47:18'),
(13, 10, '2019-05-15 11:51:06'),
(14, 10, '2019-05-15 14:11:14'),
(15, 80, '2019-05-15 14:20:50'),
(16, 10, '2019-05-15 14:28:57'),
(17, 80, '2019-05-15 14:29:58'),
(18, 80, '2019-05-15 16:11:56'),
(19, 10, '2019-05-15 17:20:26'),
(20, 80, '2019-05-15 17:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `tim` int(11) NOT NULL,
  `body` int(11) DEFAULT NULL,
  `odsuhlasenie` enum('Áno','Nie','Nevyjadril') COLLATE utf8_slovak_ci NOT NULL DEFAULT 'Nevyjadril'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `id_student`, `tim`, `body`, `odsuhlasenie`) VALUES
(131, 12345, 22, NULL, 'Nevyjadril'),
(132, 24598, 23, 49, 'Áno'),
(133, 54187, 23, 45, 'Áno'),
(134, 23581, 23, 56, 'Áno'),
(135, 86145, 24, 1, 'Áno'),
(136, 86151, 24, 199, 'Áno'),
(137, 12345, 25, NULL, 'Nevyjadril'),
(138, 24598, 26, NULL, 'Nevyjadril'),
(139, 54187, 26, NULL, 'Nevyjadril'),
(140, 23581, 26, NULL, 'Nevyjadril'),
(141, 86145, 27, 50, 'Nevyjadril'),
(142, 86151, 27, 60, 'Nevyjadril'),
(143, 79704, 27, 20, 'Nie');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id_timu` int(11) NOT NULL,
  `cislo_timu` int(11) NOT NULL,
  `body` int(11) DEFAULT NULL,
  `predmet` varchar(255) NOT NULL,
  `odsuhlasene` enum('Áno','Nie','Nevyjadril') NOT NULL DEFAULT 'Nevyjadril'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id_timu`, `cislo_timu`, `body`, `predmet`, `odsuhlasene`) VALUES
(22, 1, NULL, 'Webtech', 'Nevyjadril'),
(23, 5, 150, 'Webtech', 'Nie'),
(24, 15, 200, 'Webtech', 'Áno'),
(25, 1, NULL, 'Webtech2', 'Nevyjadril'),
(26, 5, NULL, 'Webtech2', 'Nevyjadril'),
(27, 15, 130, 'Webtech2', 'Nevyjadril');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ais` int(11) DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_ais`, `login`, `name`, `email`, `password`, `type`, `role`, `created_at`) VALUES
(1, 0, '', 'denis', 'deniszuffa@gmail.com', '$2y$10$v37Q4uXvwL08lJepKlP2ROKzRvdeKJh5gjLN5/Cu7mFgQHhuiuVom', 'regular', 'admin', '2019-04-28 06:57:00'),
(7, 0, '', 'test1', 'test@stuba.sk', NULL, 'ldap', 'student', '2019-05-07 12:54:36'),
(9, 86184, 'xzuffad1', 'xzuffad1', 'xzuffad1@is.stuba.sk', NULL, 'ldap', 'student', '2019-05-07 13:44:26'),
(10, NULL, 'admin', 'admin', 'admin@admin.sk', '$2y$10$CTshxGUGwdDlRU.RGUIoVeOCWYhX7hkpWqkyaF.S1ig2b6PCA/5Rq', 'regular', 'admin', '2019-05-07 14:32:06'),
(68, 12345, 'xpriezvisko1', 'Priezvisko1 Meno1', 'xpriezvisko1@is.stuba.sk', '$2y$10$dPZfc8EZhcnOyaai5fF9keiJ4k4gggcNQvGXTwJjD2fw6KUWo6ggS', 'regular', 'student', '2019-05-12 08:58:40'),
(69, 24598, 'xpriezvisko2', 'Priezvisko2 Meno2', 'xpriezvisko2@is.stuba.sk', '$2y$10$9zkSSyr7lqrVCBjA1rHnke4F3NJ2vJJrm/Mnt.v3DxU3LakV/VsUC', 'regular', 'student', '2019-05-12 08:58:40'),
(70, 54187, 'xpriezvisko3', 'Priezvisko3 Meno3', 'xpriezvisko3@is.stuba.sk', '$2y$10$TA9zxHjDZPGXpm7.yrERLe1FvzXHR6yCK4h6lCOhKzegFiKAmIz8.', 'regular', 'student', '2019-05-12 08:58:41'),
(71, 23581, 'xpriezvisko4', 'Priezvisko4 Meno4', 'xpriezvisko4@is.stuba.sk', '$2y$10$sNlFdnGaCaHHoDF4Xq..pen.v5VYDtzyD6qGQMuSqEM9UxkHiY7Qm', 'regular', 'student', '2019-05-12 08:58:41'),
(72, 86145, 'xraslavsky', 'Raslavský Dominik', 'xraslavsky@is.stuba.sk', NULL, 'ldap', 'student', '2019-05-12 08:58:41'),
(73, 86151, 'xskachova', 'Skachová Anna', 'xskachova@is.stuba.sk', NULL, 'ldap', 'student', '2019-05-12 08:58:41'),
(80, 79704, 'xpichlik', 'Pichlík Zdenek', 'xpichlik@is.stuba.sk', NULL, 'ldap', 'student', '2019-05-15 14:20:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_login`
--
ALTER TABLE `history_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tim` (`tim`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id_timu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_ais` (`id_ais`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_login`
--
ALTER TABLE `history_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id_timu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
