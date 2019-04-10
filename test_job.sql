-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2019 at 03:48 AM
-- Server version: 5.7.23
-- PHP Version: 7.3.3-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_job`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', '2019-04-09 12:50:28', '2019-04-09 12:52:28'),
(2, 'Admins', '2019-04-08 17:58:56', '2019-04-09 15:07:35'),
(3, 'User', '2019-04-08 17:59:01', '2019-04-09 16:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Test 8', '2019-04-08 17:06:18', '2019-04-09 16:15:05'),
(3, 'Test 3', '2019-04-08 17:13:24', '2019-04-08 22:43:24'),
(4, 'Test 4', '2019-04-08 17:13:28', '2019-04-08 22:43:28'),
(5, 'Test 5', '2019-04-08 17:13:32', '2019-04-08 22:43:32'),
(6, 'Test 6', '2019-04-08 17:13:36', '2019-04-08 22:43:36'),
(7, 'Test 1', '2019-04-09 10:00:44', '2019-04-09 15:30:44'),
(8, 'Test', '2019-04-09 11:17:29', '2019-04-09 16:47:29'),
(9, 'Tean End', '2019-04-09 16:20:04', '2019-04-09 21:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` tinyint(1) NOT NULL DEFAULT '2',
  `assigned_teams` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assigned_team_owner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `role_id`, `assigned_teams`, `assigned_team_owner`, `created_at`, `updated_at`) VALUES
(1, 'yuvraj', 'yuvraj.singh@mobilyte.com', '$2y$10$OMT9K108LtGexxjFxpOeXOzagnlFmmq0RHa3Mdgiowacl6wKoDJQe', NULL, 1, NULL, NULL, '2018-10-30 14:25:59', '2018-10-30 14:25:59'),
(3, 'Yuvraj', 'yuvraj@mobilyte.com', '123456', NULL, 2, '2,5,3,8', '5', '2019-04-08 17:28:44', '2019-04-09 15:48:32'),
(10, 'Kumar', 'deepak@bigtoe.yoga', NULL, NULL, 7, '2', '2', '2019-04-09 15:35:16', '2019-04-09 15:35:16'),
(11, 'AAAA', 'new@gmail.com', NULL, NULL, 3, '2,4,3', '4', '2019-04-09 16:26:10', '2019-04-09 16:33:51');

--
-- Indexes for dumped tables
--



--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
