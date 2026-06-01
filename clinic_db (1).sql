-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 05:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `appointment_date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(27, 8, 3, '2026-05-10 14:00:13', 'cancelled', NULL, '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(29, 5, 3, '2026-07-01 17:00:13', 'completed', NULL, '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(34, 8, 13, '2026-05-18 10:49:00', 'pending', 'headache', '2026-05-18 06:49:11', '2026-05-18 06:49:11'),
(35, 18, 3, '2026-05-18 10:51:00', 'pending', 'asdfghjklzxcvb', '2026-05-18 06:51:46', '2026-05-18 06:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `name`, `specialization`, `phone`, `email`, `bio`, `created_at`, `updated_at`) VALUES
(3, 'Dr. Marcellus Bechtelar', 'General Surgery', '+1-563-916-9742', 'orn.alverta@example.com', 'Commodi maiores occaecati veritatis ipsam laboriosam quaerat. Vel qui omnis sunt omnis consectetur temporibus iusto. Sed sequi non cumque suscipit amet nihil cumque.', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(13, 'dr. evens', 'socialist', '07899999999', 'strong@gmail.com', 'qwrtyuiopsd', '2026-05-18 05:19:44', '2026-05-18 05:19:44'),
(14, 'dr. evens', 'socialist', '07899999998', 'stronh@gmail.com', 'dentist', '2026-05-18 06:30:18', '2026-05-18 06:30:18'),
(15, 'dr.placide', 'socila', '07899999997', 'placide@gmail.com', 'socialist', '2026-05-18 06:48:48', '2026-05-18 06:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"a66935e4-fa15-4fd6-bbc0-f2d24bfbe429\",\"displayName\":\"App\\\\Mail\\\\VerifyEmailMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\VerifyEmailMail\\\":3:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:16:\\\"verificationCode\\\";s:6:\\\"543349\\\";s:6:\\\"mailer\\\";s:3:\\\"log\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1779090121,\"delay\":null}', 0, NULL, 1779090121, 1779090121),
(2, 'default', '{\"uuid\":\"1187c11d-fcc9-4d4a-8611-a6b8d4f0ff14\",\"displayName\":\"App\\\\Mail\\\\VerifyEmailMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\VerifyEmailMail\\\":3:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:16:\\\"verificationCode\\\";s:6:\\\"913721\\\";s:6:\\\"mailer\\\";s:3:\\\"log\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1779090360,\"delay\":null}', 0, NULL, 1779090360, 1779090360),
(3, 'default', '{\"uuid\":\"1671ffe7-5b6e-4162-8ef1-c72dfc4c1514\",\"displayName\":\"App\\\\Mail\\\\VerifyEmailMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\VerifyEmailMail\\\":3:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:16:\\\"verificationCode\\\";s:6:\\\"902454\\\";s:6:\\\"mailer\\\";s:3:\\\"log\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1779090484,\"delay\":null}', 0, NULL, 1779090484, 1779090484);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
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
(4, '2026_04_30_121205_create_patients_table', 1),
(5, '2026_04_30_121206_create_doctors_table', 1),
(6, '2026_04_30_121208_create_appointments_table', 1),
(7, '2026_05_18_000000_add_email_verification_to_users', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `name`, `phone`, `email`, `address`, `date_of_birth`, `created_at`, `updated_at`) VALUES
(5, 'Daryl Shanahan', '+1.719.835.8236', 'vincent09@example.com', '9645 Cassie Heights\nGilesview, NE 38922', '1973-07-20', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(8, 'Jacynthe Feest', '(747) 758-6367', 'lindsey.ohara@example.com', '95606 Griffin Forge\nPort Reginald, TN 22612-3936', '1960-08-23', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(9, 'Laurence Bergnaum', '+13808265078', 'shields.elisabeth@example.org', '1167 Kelli Island\nGeorgettemouth, PA 82789-1616', '1954-08-11', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(13, 'Prof. Sydney Dickens', '(838) 617-9180', 'zziemann@example.net', '809 Alexandre Centers Suite 976\nSchmelerview, AL 78546', '1958-07-05', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(15, 'Piper Koelpin', '(820) 597-2687', 'blick.shana@example.net', '64380 Wuckert Pass Apt. 477\nFaemouth, TN 71309', '2002-03-04', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(17, 'ben xigo', '07988665438', 'ben@gmail.com', 'rubavu', '2025-10-02', '2026-05-17 07:16:33', '2026-05-17 07:16:33'),
(18, 'b xigo', '07988665478', 'jag@gmail.com', 'qwertyuiop', '2025-10-02', '2026-05-18 05:20:17', '2026-05-18 05:20:17'),
(19, 'b xigo', '07987665478', 'ja@gmail.com', '23476890wertyuio', '2025-10-02', '2026-05-18 06:29:27', '2026-05-18 06:29:27'),
(20, 'sim', '0793587979', 'wag@gmail.com', 'rubav', '2026-03-11', '2026-05-18 06:47:44', '2026-05-18 06:47:44'),
(21, 'strog', '07934567', 'vigo@gmail.com', 'musanze', '2006-11-02', '2026-05-18 06:50:15', '2026-05-18 06:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
('2GnNmbx7vjF1NAsZCRpplgyxX2ucMsK40GNVDVfT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.120.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2JmUUhyUkJFOHhCOTJOQnJyaFBaRUhFb3lWN3FZSTlkUU1FUkI3VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779113827),
('fl0fHeyKa6CgkozruR3OgwY8dgCUsbawjpgwlG67', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib29QdUc5d1pVMHZ5S0d3bVJDVkQ0UW12YjBmS0FQaVNOWjhheVdQaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcHBvaW50bWVudHMiO3M6NToicm91dGUiO3M6MTg6ImFwcG9pbnRtZW50cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1779113861),
('wEOIer8lCwanccZl2y2q0ee6qmqtYZgad2001Ag2', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiazB6UldXc3JhVXI4dU1yV1pVSW5naTF0WnBDQVc4c09Udm9sZmhZTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTM7fQ==', 1779113932);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verification_code` varchar(255) DEFAULT NULL,
  `verification_code_expires_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verification_code`, `verification_code_expires_at`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@clinic.com', NULL, NULL, '2026-05-04 11:06:10', '$2y$12$wjmToWLfdtyFNya9gPURuu3YkY6PddOpbOf3Vgk86glHbHhFQidUO', 'KXx164MU7m', '2026-05-04 11:06:12', '2026-05-04 11:06:12'),
(2, 'Mrs. Orie Senger', 'izboncak@example.net', NULL, NULL, '2026-05-04 11:06:12', '$2y$12$wjmToWLfdtyFNya9gPURuu3YkY6PddOpbOf3Vgk86glHbHhFQidUO', 'JuwlwTcepW', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(3, 'Joe Purdy', 'lester48@example.com', NULL, NULL, '2026-05-04 11:06:12', '$2y$12$wjmToWLfdtyFNya9gPURuu3YkY6PddOpbOf3Vgk86glHbHhFQidUO', 'etwEspubBE', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(4, 'Kamille Fahey', 'colten.conn@example.com', NULL, NULL, '2026-05-04 11:06:12', '$2y$12$wjmToWLfdtyFNya9gPURuu3YkY6PddOpbOf3Vgk86glHbHhFQidUO', '3E1fPgsJAs', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(5, 'Addie Grimes', 'jeremie.miller@example.com', NULL, NULL, '2026-05-04 11:06:12', '$2y$12$wjmToWLfdtyFNya9gPURuu3YkY6PddOpbOf3Vgk86glHbHhFQidUO', 'uxcUuJlSNQ', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(6, 'Lukas Ritchie II', 'adrienne55@example.org', NULL, NULL, '2026-05-04 11:06:12', '$2y$12$wjmToWLfdtyFNya9gPURuu3YkY6PddOpbOf3Vgk86glHbHhFQidUO', 'kuDt89Jorr', '2026-05-04 11:06:13', '2026-05-04 11:06:13'),
(8, 'berthelot', 'berthelotstrong@gmail.com', NULL, NULL, NULL, '$2y$12$amd3rhxa5lT2d0mshLwFI.0zCvg3Ha5fhpfE09G9.jpBAjtgzqZMq', NULL, '2026-05-04 11:54:50', '2026-05-04 11:54:50'),
(9, 'admin', 'admin@gmail.com', NULL, NULL, NULL, '$2y$12$6X41OJwpkdojbQySAeOGyeK1myRwSuXJdWWzLuOp5sJOEsdEmgHGC', NULL, '2026-05-18 05:04:34', '2026-05-18 05:04:34'),
(10, 'strong', 'akuzweherve@gmail.com', '543349', '2026-05-18 06:41:59', NULL, '$2y$12$obXtE0PjH8UloipkE5UfGeaBtXK3CjHFoWhwbVfoQv5Q8Qqi31CJG', NULL, '2026-05-18 05:41:59', '2026-05-18 05:41:59'),
(11, 'strong', 'byiringiroplacide111@gmail.com', '902454', '2026-05-18 06:48:04', NULL, '$2y$12$p2K89YPoFfcHeUQrR1F/tOymupKWhgy8xzReRzSXq3xiJDuNGbLVi', NULL, '2026-05-18 05:45:59', '2026-05-18 05:48:04'),
(12, 'ishimwe', 'ishimwe@gmail.com', NULL, NULL, NULL, '$2y$12$59w83MeUrjfExNnJjZJz1uZhRzq3cWwvgQJ6RdL.yLbbgcxzUJmui', NULL, '2026-05-18 05:50:31', '2026-05-18 05:50:31'),
(13, 'strong Berthelot', 'berthelotstron@gmail.com', NULL, NULL, NULL, '$2y$12$zTgkr8pS.W2gx2t2Xw8kPuBRvmLbM8InhdN3q9Jo7Dj8WwKaGbdfy', NULL, '2026-05-18 12:18:52', '2026-05-18 12:18:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
