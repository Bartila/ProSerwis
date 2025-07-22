-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Lip 22, 2025 at 12:39 AM
-- Wersja serwera: 10.11.10-MariaDB-log
-- Wersja PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u842046922_wsb_2025_k05_9`
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
(1, 0, '2025-07-15 21:08:58', '2025-07-21 22:09:31');

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
('1EoHbuNcgNLKkR0wHAjgH6H9bJ18MU2LvJ4rf5xV', NULL, '2a02:4780:40:c0de::2a', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWW9vdENUZzdaYkp6MGFOQjdvMXFzbU1ZMzRzaEd3V3FaRzRuR3FvYSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753060198),
('69nW2PGU7A5vVuvR3ZHAlyzdq1sWFRFi3EVKOOIN', NULL, '54.90.200.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXB0cFVaTXE5N3NVbjIwM0lweWRBeWZlQjBBWHZybWt0NTJLQzhVTyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753081357),
('6Ka3ezngBOCPk73JKi4KpeipyZq0PtOPGdMTuFVd', NULL, '35.89.150.246', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmdHM1VPWnM4TFh6OFNLbjN6djFwTGRpazhwZWlkZGdkWU5USFUybyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753131757),
('6sD4wui2z7iL3WbngaoXIKMFWzGxfYgOZBIk1FdC', NULL, '52.55.247.251', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/138.0.7204.23 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidFhtVElWMjd6dGVSb1dRVmJGcVppS1RCOXRQVGtCa203dEJvdEdCMSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753101314),
('87U4ZpV9OfoEWM0sb3PLocpjTylwHYednX2Ox1Ky', NULL, '2a02:4780:40:c0de::2a', 'Go-http-client/2.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicEpWUEJsWGtIaXh0M3J2N3Rqem1xMGlDZ3BxQlpybjZ1M3hKVmtBZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753060198),
('AaW2lo6SAyjhZzuOtl68Xm7PzOaEFQnBVxJo4hwK', NULL, '79.186.238.21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUEMzWmZMblhadzJSS2JjSk5QMWZZa3k5Q2o2RUhyd040M2gxNnAzVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753032047),
('bIMDNV2oJzO96WBKgdAcixkt04mtsPuNTR9oxjiq', NULL, '35.166.194.103', '', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibmRYZ1BLVEFSdG9lTGhYbU84RWYwWjNKYVJiTlFGcUhZN2lYeHB1VCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753055648),
('bYxaxWRtZ6nhXCax9OKNDNMYIHSmRZ9WDfs7cZ9X', NULL, '79.186.222.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDVqUmhOMG9Bd2VzNjUyMFIwSnVTMHBwN0NobTNhU3h6TDRsVHBuRSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753123799),
('d7HK3Ys09S9qsoXR5ULiPxkku6rwBs9FVYb5N4c5', NULL, '34.169.243.70', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTN1eWs3cGN4TjB4SW9lamhLdWlHRWl0Y0R3azZLMTVCc3JwcFIwMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753038698),
('DkKXw6wHgbnow6G5PAnCjBCH4xPLq5OYurGUNpMM', NULL, '35.173.244.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVU9pUGJyQkdmUWs3NmxWSHg1R1liWEpQc3R0NFZsOXBzZG8xS2NLMSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753081355),
('DLmy0Yfy4VZj96YVtBbuEpkMfBcyZI9Ih1ya66Jh', NULL, '34.83.186.117', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHpPMGJyeVdVb2xyaVRJbFJXak9OZzZTdnoxQzFBazMzdXR2amJLdSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753033155),
('DtCzjQvrgHzXRidazEfPGxNROdPjU1hGReFqzl5i', NULL, '52.55.247.251', 'okhttp/4.9.2', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2JYSnZaZ1AxdGYyN0hIc2ZPVXNUWEJKT1ROOGJIWDRCcDRmQ2owaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753101311),
('EcRvmLFT8WUPh5tvbgPrARUL19iRHxagHxjBXkE4', NULL, '170.83.177.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36 Vivaldi/3.8', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidm5TZzkzR0VSM09HUnd4bXZUeHZBWkJlRk43bjBHcjk5TFE3TWFHWCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753081315),
('Gu1L2XaCxXuocrpdH2QaAQcLiaJrM5paRdOZvw3l', NULL, '34.217.126.36', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWlpUY2FkSURTRTJ0azhpMExqd0xIbWFtUVIyd0FzS2tUVkpJa1FpNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753095071),
('IwOW8NSHBET6eT2iSmdNjusWaiAJmjjsoxn1NFXH', NULL, '79.186.222.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2Z6clpkZXp4VnpyZmJERElIdG8xZU9QcW1iU0ZtbmRxRWZWWEcwSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwvbG9naW4iO319', 1753135994),
('J89FddFkoxWrs4BrajYoFRvS7xu4QvHclPOPkGc1', NULL, '34.169.243.70', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicUtSNTlDYzVhS3RRdkxMSmpnQXlZQkJGbHBaTWJhMTFFemZoclBJbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753038698),
('j9q5GtT6DPK9BJjJt0Xkv0EPcDYfsgCgVtY5YhUA', NULL, '185.177.72.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFk1UkFjYUZFUlprSlRLNko0czc1bVBmdTRMZ01sR2RTTndBWndoRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753139564),
('kNAnBit5kOxCD8qR6cdq7ph32pZTWhJ0Qphuf145', NULL, '34.83.186.117', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0xDb3dxQnNWMklSQ2p0SEpUa0Vaa2daU3N3R1lhbHllZkhXSnF5dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753033155),
('LMfx5EdAhvdTJ0OX5DJOBTXPuorcJJQaZnY5U6rE', NULL, '173.233.148.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXJCNkJiVVRaQzJtMXc4TUFMektWUG5Hb0pBN0dBRDNOMnFCbnhYTyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753043009),
('lofNizAivWb1fLDEqS6dswOam6ULPfO5um7RvMOI', NULL, '207.32.152.32', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:82.0) Gecko/20100101 Firefox/82.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibTBBdk5IM2MyWlRxa0RJYVdPTXdKTHZ2bG5oVTlybDF3UGVHRlQxSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753043015),
('NJxzAflesKmRW4PHzl1UaRHjzsFXWEm0QUvnc1oY', NULL, '52.55.247.251', 'okhttp/4.9.2', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaW81UXNxd0F1QkdtTkFRYnJsZ1BmaHJKS2JlR3hQN0J4NVJ1S3UyaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753101311),
('puOJyeqVOYhc0LnfarGETR5dSmtCV1hgmPEB9K4T', NULL, '35.166.194.103', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTFJdHdqaEdSYlFFdXhmYjZkVEN0THpQOFdoVDZPcUVjUnNoUjluZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753055649),
('pxbwEbzl2oiKUEspfBNdfx6Dkf4mSYNkOKraan4B', NULL, '173.233.148.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibkFPUndnUHpJVEJxbWlqSFczeE5ocDBld212RFdTeGtydkpjSktyaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753043010),
('qA67RHbBZU8LiW8eXXfRUV1nAI9OXvcTgXtgsBmt', NULL, '207.32.152.32', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:82.0) Gecko/20100101 Firefox/82.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiazhTY1BSNGdLNzFOajFoNHZRV2h5VWtPQ0FwR21lcDhvdzFIbTNvNCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753043015),
('qDoo4LLEqzj24i39x80fK6mN8Vckw3xQXnQH2R0g', NULL, '34.217.126.36', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibVpqNXlhRW9FUEp2aXFmdE9ReklTT3JjRWhkMTBwTDFpTXNhemo4UiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753095070),
('TCX769zgsxXarZWlHo9DolCw31YuBVnSk4bdt1kf', NULL, '185.177.72.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicHVVOE02QmFlMUNoR3Q4T3JEMlJYZWd6TWJkbnVnMG44NzlzaXpKNiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753139564),
('U8JCsUQfkRehTneT2atvcJEW9GMKSKkoauEiRneq', NULL, '204.101.161.15', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3JremtDeVVzWTVDOVlXajBjdTdzTDNidmc2TjFwcUtBcEY3NTJZSiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753046062),
('vDxKvPMwdCglPNBrGCToaocNY6CHgABug50NhmZR', NULL, '170.83.177.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36 Vivaldi/3.8', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzM3c09EMVBBbGpQUm5vWFo4Q2lMV3RMTXl5aExYTm1pUVpOU2FiUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcHJvc2Vyd2lzLm15cGtwLnBsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753081316),
('vET369K2MsjHnRMGbdnOK2NJyX7rbjW1Z5H7LO4f', NULL, '52.12.172.68', 'Mozilla/5.0 (Macintosh; PPC Mac OS X 10.12; rv:46.0) Gecko/20100101 Firefox/46.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzd5YlE1R0dZVVJMRVhIT1dpOWhtUWU2N1RnT2dYOGNGQkU3c3RKSyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cHM6Ly9wcm9zZXJ3aXMubXlwa3AucGwvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753055646),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
