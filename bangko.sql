-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 06:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangko`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `account_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_number`, `user_id`, `balance`) VALUES
(1, 434567890, 2, 1500000),
(2, 142654859, 4, 100516),
(3, 548716145, 3, 1505167),
(4, 154265567, 1, 1405167),
(5, 165245104, 10, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `deposit_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`deposit_id`, `account_id`, `amount`, `date`) VALUES
(1, 2, 6000.00, '2024-09-28 14:55:52'),
(2, 1, 1000.00, '2024-09-29 14:01:27'),
(3, 4, 20000.00, '2024-09-29 14:10:19'),
(4, 3, 2000.00, '2024-09-29 14:11:27'),
(5, 5, 10000.00, '2024-10-05 15:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `login_attempt_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `success` tinyint(1) NOT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`login_attempt_id`, `user_id`, `username`, `ip_address`, `timestamp`, `success`, `user_agent`) VALUES
(75, 11, 'adminmiguel', '::1', '2024-10-07 16:23:22', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(76, 11, 'adminmiguel', '::1', '2024-10-07 16:36:02', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(77, 11, 'adminmiguel', '::1', '2024-10-07 20:48:59', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(78, 1, 'adminsean', '::1', '2024-10-07 20:49:33', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(79, 1, 'adminsean', '::1', '2024-10-08 10:05:06', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(80, 1, 'adminsean', '::1', '2024-10-08 10:07:48', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(81, 11, 'adminmiguel', '::1', '2024-10-09 15:52:22', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(82, 13, 'admin2', '::1', '2024-10-09 15:54:50', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(83, 13, 'admin2', '::1', '2024-10-10 00:04:04', 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(84, 13, 'admin2', '::1', '2024-10-10 00:08:05', 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(85, 13, 'admin2', '::1', '2024-10-10 00:12:34', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),
(86, 13, 'admin2', '::1', '2024-10-10 00:14:37', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `otp_requests`
--

CREATE TABLE `otp_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_requests`
--

INSERT INTO `otp_requests` (`id`, `user_id`, `otp`, `created_at`) VALUES
(119, 1, '590975', '2024-10-07 22:49:44'),
(120, 1, '486591', '2024-10-08 09:23:03'),
(121, 1, '281477', '2024-10-08 09:34:33'),
(122, 1, '980960', '2024-10-08 09:35:47'),
(123, 1, '616989', '2024-10-08 09:57:03'),
(124, 1, '723956', '2024-10-08 10:00:48'),
(125, 1, '156553', '2024-10-08 10:01:33'),
(126, 1, '397320', '2024-10-08 10:04:26'),
(127, 1, '423643', '2024-10-08 10:05:43'),
(128, 1, '913401', '2024-10-09 15:26:24'),
(129, 1, '312169', '2024-10-09 15:32:14'),
(130, 1, '250442', '2024-10-09 15:40:00'),
(131, 1, '332104', '2024-10-09 15:43:08'),
(132, 1, '123190', '2024-10-09 15:55:24'),
(133, 6, '175564', '2024-10-09 16:21:23'),
(134, 6, '216737', '2024-10-09 16:27:40'),
(135, 6, '243710', '2024-10-09 16:37:36'),
(136, 6, '378604', '2024-10-09 16:44:59'),
(137, 6, '547139', '2024-10-09 21:13:56'),
(138, 6, '436674', '2024-10-09 21:37:08'),
(139, 6, '157205', '2024-10-09 21:38:56'),
(140, 6, '296820', '2024-10-09 21:42:13'),
(141, 6, '272649', '2024-10-09 21:56:07'),
(142, 6, '609049', '2024-10-09 22:07:46'),
(143, 6, '425863', '2024-10-09 22:19:58'),
(144, 6, '713626', '2024-10-09 22:27:47'),
(145, 6, '117017', '2024-10-09 22:28:45'),
(146, 13, '670981', '2024-10-09 22:45:14'),
(147, 13, '294qzM4xE9zFgkP61qew', '2024-10-09 23:12:35'),
(150, 13, 'TWUyxz2zRxHEKb9CUbYb', '2024-10-09 23:14:15'),
(151, 13, '1m6xfI21kKaBDtikuQdM', '2024-10-10 00:13:18'),
(152, 13, '1m6xfI21kKaBDtikuQdM', '2024-10-10 00:13:18'),
(153, 13, 'FAc3z7eaMcKvjvUhNC7b', '2024-10-10 00:14:07'),
(154, 13, 'FAc3z7eaMcKvjvUhNC7b', '2024-10-10 00:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `email`) VALUES
(1, 'adminsean', '$2y$10$ES48ki0a0Iw5oG2Pm52bLux2UE8ycI4u1MstxdCoCCI1LpSv.uBHW', 'sean manaog', 'seanmanaog22@gmail.com'),
(2, 'adminclifford', '$2y$10$9NGfZImfalsfMkZFZLLIA.aJc6dsFVXCbj36md5CU5.J4orO2lrOS', 'clifford monteras', ''),
(3, 'adminadam', '$2y$10$JugnOSeP5RMlRqIz0EzNRObGErLyoEfDwxNkUsYkk5e36wH20mQr6', 'Adam Vergara', ''),
(4, 'adminPNB', '$2y$10$FQ8uoIKf0wBlqsMQzAUHnO7pLk0OeZn4.Uu0TJrlvs.LDpbtDUzNu', 'PNB', ''),
(5, 'adminangel', '$2y$10$Cni/Ih3LTI9IjFafniJEm.yEqfxWgQOqasc8teRHbSJosOSWVc/AS', 'Angel Laspinas', ''),
(6, 'adminsean2', '$2y$10$DU/5zHAtSi6mawTNR.k15uNxqLCbzhtDcXclhSEhJOTxQJROkzdaW', 'michael manaog', 'seanmanaog07@gmail.com'),
(7, 'sean123', '$2y$10$3UuFDBbGrOjgMmTrIsK1u.bzYhg78aj58jmrvkckAxNk9HVhTXCCe', 'sean michael', ''),
(8, 'Sean23', '$2y$10$iGaISuGOcVsdD5FHOlFcGOwMk1fGhwri8V8v8K2IgL6VCzTkWLwaS', 'sean Michael', ''),
(9, 'sean1234', '$2y$10$Au/zXivMrHcaqUFWZAgd5.wd31hcfExLxx18P3G6NEK21soaoZ6d6', 'Sean Michael Manaog', ''),
(10, 'admintristan', '$2y$10$vb/FNSato1z0sEJLOd91UuhgkeE1HDnuLgKtzcDe1FRjpmJXL31ou', 'tristan mamangon', 'tristanmamangon@gmail.com'),
(11, 'adminmiguel', '$2y$10$5iVbZbWPaIYL8aXz36lABeDvd2KUmp8DvXPdbCT2F23uvAYQQj902', 'miguel tanfelix', ''),
(12, 'adminjerome', '$2y$10$.g.amOBznlWpDiI7oJrpZejL0.Kw4AT9YNwSOZPttxGNOQpHPz2.a', 'jerome bernante', ''),
(13, 'admin2', '$2y$10$RMtTAJL.0CHZ5Axr/x6zVus39pjmqeaCxRPht7C3PNAfgzSaCXdca', 'jerome bernante', 'jeromebernante@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `withdrawal_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`withdrawal_id`, `account_id`, `amount`, `date`) VALUES
(1, 1, 2000.00, '2024-09-28 14:41:28'),
(2, 2, 1000.00, '2024-09-29 14:03:44'),
(3, 3, 15000.00, '2024-09-29 14:07:26'),
(4, 4, 10000.00, '2024-09-29 14:08:05'),
(5, 5, 25000.00, '2024-10-05 15:27:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`deposit_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`login_attempt_id`);

--
-- Indexes for table `otp_requests`
--
ALTER TABLE `otp_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`withdrawal_id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `login_attempt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `otp_requests`
--
ALTER TABLE `otp_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `withdrawal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE;

--
-- Constraints for table `otp_requests`
--
ALTER TABLE `otp_requests`
  ADD CONSTRAINT `otp_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
