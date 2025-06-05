-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 06, 2025 at 12:41 AM
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
-- Struktura tabeli dla tabeli `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `model_type` varchar(255) DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `model_type`, `model_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'status_change', 'Bike', 16, 'Oznaczono rower jako gotowy', '2025-06-05 20:06:06', '2025-06-05 20:06:06'),
(2, 2, 'status_change', 'Bike', 22, 'Oznaczono rower jako gotowy', '2025-06-05 20:06:12', '2025-06-05 20:06:12'),
(3, 2, 'status_change', 'Bike', 22, 'Oznaczono rower jako odebrany', '2025-06-05 20:06:15', '2025-06-05 20:06:15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bikes`
--

CREATE TABLE `bikes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `components` varchar(255) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'oczekuje',
  `deadline` date DEFAULT NULL,
  `info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`id`, `name`, `type`, `user_id`, `phone`, `created_at`, `updated_at`, `components`, `weight`, `description`, `status`, `deadline`, `info`) VALUES
(12, 'Scott', 'szosowy', 2, NULL, '2025-06-03 18:33:44', '2025-06-03 18:33:44', 'Shimano', 7.9, 'Bartek', 'oczekuje', '2025-06-19', NULL),
(13, 'Canyon', 'gravel', 2, NULL, '2025-06-03 18:34:23', '2025-06-03 18:34:23', 'SRAM', 9, 'Janusz', 'oczekuje', '2025-06-23', NULL),
(14, 'Bianchi', 'szosowy', 2, NULL, '2025-06-03 18:34:52', '2025-06-05 18:00:23', 'Campagnolo', 7.6, 'Mateusz', 'odebrany', '2025-06-20', NULL),
(15, 'Bergamont', 'gravel', 2, NULL, '2025-06-03 18:37:52', '2025-06-03 18:37:52', 'Shimano', 9.5, 'Katarzyna', 'oczekuje', '2025-06-11', NULL),
(16, 'Focus', 'gravel', 2, '+48754344332', '2025-06-03 18:39:10', '2025-06-05 20:06:06', 'Shimano', 10, 'Marcin', 'gotowy', '2025-06-09', NULL),
(18, 'scott', 'mtb', 3, '+48444444444', '2025-06-04 17:30:54', '2025-06-04 20:38:23', 'Campagnolo', 35, 'sdafg', 'w naprawie', '2025-06-10', NULL),
(22, 'Scott scale 970', 'mtb', 11, '+48654453345', '2025-06-05 17:12:01', '2025-06-05 20:06:15', 'SRAM', 13.5, 'Michał', 'odebrany', '2025-06-15', NULL),
(23, 'Trek madone SLR', 'szosowy', 11, '+48604326517', '2025-06-05 17:13:24', '2025-06-05 18:55:21', 'SRAM', 7.6, 'Mateusz', 'oczekuje', '2025-06-04', 'Naprawa przerzutek'),
(24, 'Canyon roadmachine', 'szosowy', 10, '+48723153933', '2025-06-05 17:14:40', '2025-06-05 17:14:40', 'Shimano', 7.7, 'Bartek', 'w naprawie', '2025-06-10', NULL),
(25, 'KTM myroon', 'mtb', 10, '+48738888351', '2025-06-05 17:16:26', '2025-06-05 17:16:26', 'Shimano', 11, 'Janusz', 'oczekuje', '2025-06-04', NULL),
(26, 'Giant Propel', 'szosowy', 10, '+48546212233', '2025-06-05 17:23:05', '2025-06-05 17:23:05', 'Shimano', 8, 'Damian', 'oczekuje', '2025-06-12', NULL),
(27, 'Scott Sub', 'trekking', 10, '+48523764544', '2025-06-05 17:23:34', '2025-06-05 17:23:34', 'Shimano', 17, 'Marek', 'oczekuje', '2025-06-16', NULL),
(28, 'trek', 'szosowy', 10, '+48444444444', '2025-06-05 17:33:18', '2025-06-05 17:37:30', 'Campagnolo', 3, 'dgsadgsadg', 'oczekuje', '2025-06-12', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bike_components`
--

CREATE TABLE `bike_components` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bike_types`
--

CREATE TABLE `bike_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_test@test.pl|127.0.0.1', 'i:1;', 1749163250),
('laravel_cache_test@test.pl|127.0.0.1:timer', 'i:1749163250;', 1749163250);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_01_180414_create_bikes_table', 1),
(5, '2025_06_01_224429_add_details_to_bikes_table', 2),
(6, '2025_06_01_231530_add_status_deadline_to_bikes_table', 3),
(7, '2025_06_02_212833_create_bike_types_table', 4),
(8, '2025_06_02_212839_create_bike_components_table', 4),
(9, '2025_06_04_184205_add_phone_to_bikes_table', 5),
(10, '2025_06_04_221622_create_activity_logs_table', 6),
(11, '2025_06_05_204208_add_repair_info_to_bikes_table', 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1zVQxzHkvX2drXndyELOPds3MzG5xCct77D4Yhlw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0VHMUMwQUF6eTd2V0gyTzlTRktycDBsMXRlRDNRUGlmUGxJc1lSaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1749163190);

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
(3, 'owner1', 'owner@test.pl', NULL, '$2y$12$VNyYDnA32.QD0BGpoO/a6OL5c41/VwqUr7TpKccK2eHyQ2q25Pzka', 'owner', NULL, '2025-06-01 19:38:37', '2025-06-04 19:45:33'),
(10, 'serwisantTEST2', 'test2@test.pl', NULL, '$2y$12$R9Q1OOKC9jeqiDgF./pIC.Jm5L6/zoqfVpwXHRaZJxJTt0KSd9DgS', 'user', NULL, '2025-06-05 17:05:40', '2025-06-05 17:05:40'),
(11, 'serwisantTEST', 'test@test.pl', NULL, '$2y$12$7bD/vZen5GanLOI4u.pu9O3eYRyfjOMF/CEWrC8vXTM39Hjecc0Z6', 'user', NULL, '2025-06-05 17:06:59', '2025-06-05 17:06:59'),
(12, 'serwisantTEST3', 'test3@test.pl', NULL, '$2y$12$5kvutDHnZ1q7lCVy1hGJvOHSETw021uhtSSd6L4rJSTds7pxUG1L.', 'user', NULL, '2025-06-05 17:07:57', '2025-06-05 17:07:57');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bikes_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `bike_components`
--
ALTER TABLE `bike_components`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bike_components_name_unique` (`name`);

--
-- Indeksy dla tabeli `bike_types`
--
ALTER TABLE `bike_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bike_types_name_unique` (`name`);

--
-- Indeksy dla tabeli `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeksy dla tabeli `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeksy dla tabeli `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeksy dla tabeli `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeksy dla tabeli `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `bike_components`
--
ALTER TABLE `bike_components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bike_types`
--
ALTER TABLE `bike_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bikes`
--
ALTER TABLE `bikes`
  ADD CONSTRAINT `bikes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
