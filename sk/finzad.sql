-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:3306
-- Čas generovania: Ne 19.Máj 2019, 17:22
-- Verzia serveru: 5.7.25-0ubuntu0.18.04.2
-- Verzia PHP: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `finzad`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `meno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `predmet` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rok` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hlavicka` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hodnoty` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `grade`
--

INSERT INTO `grade` (`id`, `id_student`, `meno`, `predmet`, `rok`, `hlavicka`, `hodnoty`) VALUES
(1, 12345, 'Priezvisko1 Meno1', 'Webtechy', '2016/2017', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!3!4!3!3!2!2!!2!1,25!6!6!8!14,9!16!73,77!D'),
(2, 24598, 'Priezvisko2 Meno2', 'Webtechy', '2016/2017', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!4!3!3!2!2!2!3!2!2!10!7!8!20!14!85,05!B'),
(3, 54187, 'Priezvisko3 Meno3', 'Webtechy', '2016/2017', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!3!4!3!3!2!2!2!2!1,5!10!7!7!14,5!24!88,28!B'),
(4, 23581, 'Priezvisko4 Meno4', 'Webtechy', '2016/2017', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!3!3!4!3!3!2!2!3!2!2!9!10!8!20!30!107!A'),
(5, 12345, 'Priezvisko1 Meno1', 'Matematika', '2017/2018', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!3!4!3!3!2!2!!2!1,25!6!6!8!14,9!16!73,77!D'),
(6, 24598, 'Priezvisko2 Meno2', 'Matematika', '2017/2018', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!4!3!3!2!2!2!3!2!2!10!7!8!20!14!85,05!B'),
(7, 54187, 'Priezvisko3 Meno3', 'Matematika', '2017/2018', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!2!3!4!3!3!2!2!2!2!1,5!10!7!7!14,5!24!88,28!B'),
(8, 23581, 'Priezvisko4 Meno4', 'Matematika', '2017/2018', 'ID!Meno!cv1!cv2!cv3!cv4!cv5!cv6!cv7!cv8!cv9!cv10!cv11!Z1!Z2!VT!SK-T!SK-P!Spolu!Známka', '3!3!3!4!3!3!2!2!3!2!2!9!10!8!20!30!107!A'),
(10, 12345, 'Priezvisko1 Meno1', 'Mikropocitace', '2016/2017', 'ID!Meno!Zápočet!Projekt!Test!Dotazník!Bonus!Súčet!Známka', '31!2!3!1!1!93!A'),
(11, 24598, 'Priezvisko2 Meno2', 'Mikropocitace', '2016/2017', 'ID!Meno!Zápočet!Projekt!Test!Dotazník!Bonus!Súčet!Známka', '3!42!4!0!5!82!B'),
(12, 54187, 'Priezvisko3 Meno3', 'Mikropocitace', '2016/2017', 'ID!Meno!Zápočet!Projekt!Test!Dotazník!Bonus!Súčet!Známka', '3!5!35!1!3!73!C'),
(13, 23581, 'Priezvisko4 Meno4', 'Mikropocitace', '2016/2017', 'ID!Meno!Zápočet!Projekt!Test!Dotazník!Bonus!Súčet!Známka', '3!23!3!0!8!63!D');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `history_login`
--

CREATE TABLE `history_login` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `datetime_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `history_login`
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
(20, 80, '2019-05-15 17:20:58'),
(21, 10, '2019-05-18 19:36:55'),
(22, 10, '2019-05-19 07:13:51'),
(23, 10, '2019-05-19 10:26:05'),
(24, 10, '2019-05-19 11:56:30'),
(25, 10, '2019-05-19 12:16:48'),
(26, 10, '2019-05-19 13:41:05'),
(27, 68, '2019-05-19 14:17:34'),
(28, 10, '2019-05-19 14:25:20'),
(29, 10, '2019-05-19 16:35:38');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `meno` varchar(255) NOT NULL,
  `predmet` varchar(255) NOT NULL,
  `id_sablon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `mail`
--

INSERT INTO `mail` (`id`, `datum`, `meno`, `predmet`, `id_sablon`) VALUES
(1, '2019-05-19', 'Pichlík Zdenek', 'aaa', 1),
(2, '2019-05-19', 'Pichlík Zdenek', 'aaa', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `sablon`
--

CREATE TABLE `sablon` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Sablona` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `sablon`
--

INSERT INTO `sablon` (`ID`, `Sablona`, `name`) VALUES
(1, 'Dobrý deň,\r\nna predmete Webové technológie 2 budete mať k dispozícii vlastný virtuálny linux server, ktorý budete\r\npoužívať počas semestra, a na ktorom budete vypracovávať zadania. Prihlasovacie údaje k Vašemu serveru\r\nsu uvedené nižšie.\r\nip adresa: {{verejnaIP}}\r\nprihlasovacie meno: {{login}}\r\nheslo: {{heslo}}\r\nVaše web stránky budú dostupné na: http:// {{verejnaIP}}:{{http}}\r\nS pozdravom,\r\n{{sender}}', 'Webte2 login');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `tim` int(11) NOT NULL,
  `body` int(11) DEFAULT NULL,
  `odsuhlasenie` enum('Áno','Nie','Nevyjadril') COLLATE utf8_slovak_ci NOT NULL DEFAULT 'Nevyjadril'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `student`
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
-- Štruktúra tabuľky pre tabuľku `team`
--

CREATE TABLE `team` (
  `id_timu` int(11) NOT NULL,
  `cislo_timu` int(11) NOT NULL,
  `body` int(11) DEFAULT NULL,
  `predmet` varchar(255) NOT NULL,
  `rok` varchar(20) NOT NULL,
  `odsuhlasene` enum('Áno','Nie','Nevyjadril') NOT NULL DEFAULT 'Nevyjadril'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `team`
--

INSERT INTO `team` (`id_timu`, `cislo_timu`, `body`, `predmet`, `rok`, `odsuhlasene`) VALUES
(22, 1, NULL, 'Webtech', '2018/2019', 'Nevyjadril'),
(23, 5, 150, 'Webtech', '2018/2019', 'Nie'),
(24, 15, 200, 'Webtech', '2018/2019', 'Áno'),
(25, 1, NULL, 'Webtech2', '2018/2019', 'Nevyjadril'),
(26, 5, NULL, 'Webtech2', '2018/2019', 'Nevyjadril'),
(27, 15, 130, 'Webtech2', '2018/2019', 'Nevyjadril');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
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
-- Sťahujem dáta pre tabuľku `users`
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
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `history_login`
--
ALTER TABLE `history_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexy pre tabuľku `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexy pre tabuľku `sablon`
--
ALTER TABLE `sablon`
  ADD PRIMARY KEY (`ID`);

--
-- Indexy pre tabuľku `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tim` (`tim`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexy pre tabuľku `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id_timu`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_ais` (`id_ais`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pre tabuľku `history_login`
--
ALTER TABLE `history_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pre tabuľku `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pre tabuľku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pre tabuľku `sablon`
--
ALTER TABLE `sablon`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT pre tabuľku `team`
--
ALTER TABLE `team`
  MODIFY `id_timu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
