-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 22, 2025 at 02:25 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wsb_2025_k05_9`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@test.pl', NULL, '$2y$12$AvjcqLj/Xr6jYsA5y10UDO0rngpi2q27mSaqcXAmewgB/BZm3CxbC', 'admin', NULL, '2025-06-01 19:37:50', '2025-06-01 19:37:50'),
(3, 'owner', 'owner@test.pl', NULL, '$2y$12$VNyYDnA32.QD0BGpoO/a6OL5c41/VwqUr7TpKccK2eHyQ2q25Pzka', 'owner', NULL, '2025-06-01 19:38:37', '2025-07-20 15:46:05'),
(10, 'serwisantTEST2', 'test2@test.pl', NULL, '$2y$12$R9Q1OOKC9jeqiDgF./pIC.Jm5L6/zoqfVpwXHRaZJxJTt0KSd9DgS', 'user', NULL, '2025-06-05 17:05:40', '2025-06-05 17:05:40'),
(11, 'serwisantTEST', 'user@test.pl', NULL, '$2y$12$qN.x5Y8PVgc8Gy8yvez7uOzkH/haxdaF61mQ6mVMkfKkkEQFRFpUC', 'user', NULL, '2025-06-05 17:06:59', '2025-07-21 22:24:56'),
(12, 'serwisantTEST3', 'test3@test.pl', NULL, '$2y$12$5kvutDHnZ1q7lCVy1hGJvOHSETw021uhtSSd6L4rJSTds7pxUG1L.', 'user', NULL, '2025-06-05 17:07:57', '2025-07-20 15:45:54');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
