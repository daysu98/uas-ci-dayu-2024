-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2025 at 06:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `pomodoro_time` int DEFAULT '25',
  `is_completed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `pomodoro_time`, `is_completed`, `created_at`, `updated_at`) VALUES
(6, 2, 'selesaikan tugas uas', 'selesai nok', 15, 0, '2025-01-07 05:00:19', '2025-01-09 00:45:36'),
(7, 2, 'yu i', 'etg', 25, 0, '2025-01-08 10:22:53', '2025-01-08 10:22:53'),
(8, 4, 'aa', 'aa', 25, 0, '2025-01-08 13:17:07', '2025-01-08 13:17:07'),
(9, 5, 'hay', 'ay', 9, 0, '2025-01-08 22:59:18', '2025-01-08 22:59:18'),
(11, 7, 'testing 2', 'anjay', 22, 0, '2025-01-12 01:47:03', '2025-01-12 01:47:03'),
(12, 8, 'hay', 'aloo', 25, 0, '2025-01-12 01:49:56', '2025-01-12 01:49:56'),
(13, 8, 'aaa', 'aa8ujjjjjjjjjjjj', 25, 0, '2025-01-12 01:50:08', '2025-01-12 01:51:11'),
(15, 8, 'aaa', 'aaa', 25, 0, '2025-01-12 01:50:26', '2025-01-12 01:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'Contoh 1', 'gungary123@gmail.com', '$2y$10$Tq6nDwOp/BX6vIhWRf3Yu.WcmBtvwVRSK3JE.1dSIBQ04kQAJawT6', '1735401370_74c788f4668ac304b1c2.jpg', '2024-12-28 15:56:10', '2024-12-28 15:56:10'),
(2, 'isnaa', 'isna@gmail.com', '$2y$10$HVPi2DJk5uw9lYdqs0/wierVudchC7bYcjefCZcdnEyo3uXacFbDi', '1736421738_4644ca48c82a020930f3.png', '2024-12-28 15:59:04', '2025-01-09 11:22:18'),
(3, 'day', 'sucid2916@gmail.com', '$2y$10$kTXrat8x5WEvuk3GTH5ZBeIqGx9pMPpAYI9SR/8YDi45dnlHs3f5K', '1735893567_5b094990353c775baa25.png', '2025-01-03 08:39:27', '2025-01-03 08:39:27'),
(4, 'yuni', 'yuni@gmail.com', '$2y$10$vnupTDxwlEVqAq2FMm8lOusYvg3itD0q/pF/36rFm8SpXu/s8YULq', '1736371059_29938808fb32b33c59e3.png', '2025-01-08 21:16:45', '2025-01-08 21:17:39'),
(5, 'yun', 'babi@gmail.com', '$2y$10$HQO5SocbOCg2iMAaQUMF2u5SH7lhgi2/4TII.2HJWh.ugxcM/6Yp2', '1736400509_e6fd3f11e8edc3aa7538.png', '2025-01-08 21:22:14', '2025-01-09 06:57:16'),
(6, 'elsa', 'henbukstore@gmail.com', '$2y$10$eoUJy6zsRyA3zt3D3jU1/OzybbOtMq3gSOTyLKb0pfc8UR5hMCIjG', '1736410972_06f00f523e57e55a811c.jpg', '2025-01-09 08:21:41', '2025-01-09 08:22:52'),
(7, 'pengguna1', 'pengguna1@gmail.com', '$2y$10$131FmpBBSV3xajhhnST6ROubMHKLeuyHGWqcHPgD0pMarrz1KujNq', '1736675297_b875a7506e60f598dabb.png', '2025-01-12 09:45:59', '2025-01-12 09:48:17'),
(8, 'pengguna2', 'pengguna2@gmail.com', '$2y$10$c/pLGUhRk8RFvj5z0EsVSO21ci9PyL8HOzPt.oSoo1rvOXExCEeL6', '1736675363_97017b8a6ec84e6824dd.png', '2025-01-12 09:49:23', '2025-01-12 09:49:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
