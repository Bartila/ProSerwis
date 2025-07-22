-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 22, 2025 at 02:55 AM
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
-- Database: `wsb_2025`
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
(1, 2, 'add', 'Bike', 56, 'Dodano rower: TEST', '2025-07-21 22:54:14', '2025-07-21 22:54:14'),
(2, 16, 'add', 'Bike', 57, 'Dodano rower: TEST', '2025-07-21 22:55:08', '2025-07-21 22:55:08'),
(3, 16, 'add', 'Bike', 58, 'Dodano rower: TEST', '2025-07-21 22:55:27', '2025-07-21 22:55:27'),
(4, 16, 'status_change', 'Bike', 58, 'Oznaczono rower jako gotowy', '2025-07-21 22:55:31', '2025-07-21 22:55:31');

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
  `qr_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'oczekuje',
  `deadline` date DEFAULT NULL,
  `info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`id`, `name`, `type`, `user_id`, `phone`, `qr_code`, `created_at`, `updated_at`, `description`, `status`, `deadline`, `info`) VALUES
(56, 'TEST', 'cross', 2, '+48111111111', 'TEST', '2025-07-21 22:54:14', '2025-07-21 22:54:14', 'TEST', 'oczekuje', '2025-07-09', 'TEST'),
(57, 'TEST', 'cross', 16, '+48333333333', 'TEST1', '2025-07-21 22:55:08', '2025-07-21 22:55:08', 'TEST', 'w naprawie', '2025-07-24', 'TEST'),
(58, 'TEST', 'gravel', 16, '+48333333333', 'TEST3', '2025-07-21 22:55:27', '2025-07-21 22:55:31', 'TEST', 'gotowy', '2025-08-09', 'TEST');

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
-- Struktura tabeli dla tabeli `bike_stats`
--

CREATE TABLE `bike_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_added` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bike_stats`
--

INSERT INTO `bike_stats` (`id`, `total_added`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-07-15 21:08:58', '2025-07-21 22:55:27');

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
('laravel_cache_j.cieslinski02@wp.pl|2a09:bac3:4fb9:2f0::4b:6c', 'i:2;', 1752860253),
('laravel_cache_j.cieslinski02@wp.pl|2a09:bac3:4fb9:2f0::4b:6c:timer', 'i:1752860253;', 1752860253),
('laravel_cache_mateusz.z@wp.pl|83.3.169.197', 'i:1;', 1752924449),
('laravel_cache_mateusz.z@wp.pl|83.3.169.197:timer', 'i:1752924449;', 1752924449),
('laravel_cache_test3@test.pl|127.0.0.1', 'i:1;', 1752704465),
('laravel_cache_test3@test.pl|127.0.0.1:timer', 'i:1752704465;', 1752704465);

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
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(14, 2, 'test', '2025-07-21 22:53:54', '2025-07-21 22:53:54'),
(15, 16, 'test', '2025-07-21 22:54:51', '2025-07-21 22:54:51');

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
(11, '2025_06_05_204208_add_repair_info_to_bikes_table', 7),
(12, '2025_07_12_213412_add_qr_code_column_to_bikes_table', 8),
(13, '2025_07_15_215057_remove_components_and_weight_from_bikes_table', 9),
(14, '2025_07_15_220050_create_messages_table', 10),
(16, '2025_07_15_224957_create_bike_stats_table', 11);

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
('j9q5GtT6DPK9BJjJt0Xkv0EPcDYfsgCgVtY5YhUA', NULL, '185.177.72.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFk1UkFjYUZFUlprSlRLNko0czc1bVBmdTRMZ01sR2RTTndBWndoRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753139564),
('pe32d6PoIOotgzNXDeQip3s8iaAIfWXIKAkaudyd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWWwyRHRvcGhaNVladUZCaVdhQjdWQ1VwbWZYQTg1cEZkMzZnNXpreSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1753145735),
('TCX769zgsxXarZWlHo9DolCw31YuBVnSk4bdt1kf', NULL, '185.177.72.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicHVVOE02QmFlMUNoR3Q4T3JEMlJYZWd6TWJkbnVnMG44NzlzaXpKNiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753139564),
('ZDyjmxhas9ZvIyPyfQTNN04I533KGpPgf8EJfb3H', NULL, '79.186.222.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHV0T1RBZFhESzhqM1B2QzVISHZSSTREeWNOMUJPVlByZFZ6RjBBTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753143543);

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
(2, 'admin', 'admin@test.pl', NULL, '$2y$12$d2f2f8Tw/65TKOI7Ecu80uso1YWKqvk39Ew8coW2yKLfCc5dWrkZS', 'admin', NULL, '2025-06-01 19:37:50', '2025-07-21 22:08:15'),
(16, 'user', 'user@test.pl', NULL, '$2y$12$.9By.yjS1i9gZ5f.qNwrS.cj4Hd7uF0t5AaPv8twpg2LAmC8ntbqW', 'user', NULL, '2025-07-19 07:05:47', '2025-07-21 22:09:08'),
(20, 'owner', 'owner@test.pl', NULL, '$2y$12$nWbKXTXtkCcRoKBYxF/CseyNZATLoBTo/KPayokB1se9GH3uhCev.', 'owner', NULL, '2025-07-19 15:12:37', '2025-07-21 22:08:47');

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
  ADD UNIQUE KEY `bikes_qr_code_unique` (`qr_code`),
  ADD KEY `bikes_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `bike_components`
--
ALTER TABLE `bike_components`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bike_components_name_unique` (`name`);

--
-- Indeksy dla tabeli `bike_stats`
--
ALTER TABLE `bike_stats`
  ADD PRIMARY KEY (`id`);

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
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `bike_components`
--
ALTER TABLE `bike_components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bike_stats`
--
ALTER TABLE `bike_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bikes`
--
ALTER TABLE `bikes`
  ADD CONSTRAINT `bikes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
