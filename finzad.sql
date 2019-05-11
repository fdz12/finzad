-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:3306
-- Čas generovania: So 11.Máj 2019, 12:08
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
(5, 10, '2019-05-11 11:59:34');

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
(80, 123345, 1, NULL, 'Nevyjadril'),
(81, 24598, 5, NULL, 'Nevyjadril'),
(82, 54187, 5, NULL, 'Nevyjadril'),
(83, 23581, 5, NULL, 'Nevyjadril'),
(84, 86145, 15, 1, 'Áno'),
(85, 86151, 15, 198, 'Áno');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `body` int(11) DEFAULT NULL,
  `predmet` varchar(255) NOT NULL,
  `odsuhlasene` enum('Áno','Nie','Nevyjadril') NOT NULL DEFAULT 'Nevyjadril'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `team`
--

INSERT INTO `team` (`id`, `body`, `predmet`, `odsuhlasene`) VALUES
(1, 150, 'Webtech', 'Nevyjadril'),
(5, 96, 'Webtech', 'Nevyjadril'),
(15, 199, 'Webtech', 'Áno');

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
(17, 123345, 'xpriezvisko1@is.stuba.sk', 'Priezvisko1 Meno1', 'xpriezvisko1@is.stuba.sk', '$2y$10$i1/ahvFs9/kWNvkG2QSSHOqVX8bWYMGhZF7z0AikO5dBOoK/NjpLK', 'regular', 'student', '2019-05-11 11:50:13'),
(18, 24598, 'xpriezvisko2@is.stuba.sk', 'Priezvisko2 Meno2', 'xpriezvisko2@is.stuba.sk', '$2y$10$w5HC0LzS5O03FJUsUKG2e.O//h59ViVVYGV3MR5POxfs.bbDOefMG', 'regular', 'student', '2019-05-11 11:50:13'),
(19, 54187, 'xpriezvisko3@is.stuba.sk', 'Priezvisko3 Meno3', 'xpriezvisko3@is.stuba.sk', '$2y$10$K26YMtZDGC4nb9of/rKaHe//InFLqYNWb04wLMsVAJ2IPH67tkStC', 'regular', 'student', '2019-05-11 11:50:13'),
(20, 23581, 'xpriezvisko4@is.stuba.sk', 'Priezvisko4 Meno4', 'xpriezvisko4@is.stuba.sk', '$2y$10$GzK9awWC07b7es5ysuOSU.jdmPoTBgO/cPjdJz7F9hlynZtQgZr4q', 'regular', 'student', '2019-05-11 11:50:13'),
(21, 86145, 'xraslavsky@is.stuba.sk', 'Raslavský Dominik', 'xraslavsky@is.stuba.sk', NULL, 'ldap', 'student', '2019-05-11 11:50:13'),
(22, 86151, 'xskachova@is.stuba.sk', 'Skachová Anna', 'xskachova@is.stuba.sk', NULL, 'ldap', 'student', '2019-05-11 11:50:13');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `history_login`
--
ALTER TABLE `history_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pre tabuľku `history_login`
--
ALTER TABLE `history_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pre tabuľku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pre tabuľku `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
