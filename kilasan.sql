-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 10:00 AM
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
-- Database: `kilasan`
--

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
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `reported_at` date NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kontak` varchar(255) NOT NULL,
  `wilayah` text NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `usia` varchar(255) NOT NULL,
  `tingkat_khawatir` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `jenis_pelapor` varchar(255) DEFAULT NULL,
  `tempat_kejadian` varchar(255) DEFAULT NULL,
  `waktu_kejadian` varchar(255) DEFAULT NULL,
  `pelaku` varchar(255) DEFAULT NULL,
  `kronologi` text DEFAULT NULL,
  `saran` text DEFAULT NULL,
  `status` enum('Belum Diproses','Sedang Diproses','Selesai','Ditolak') NOT NULL DEFAULT 'Belum Diproses',
  `handled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `ticket_number`, `reported_at`, `nama`, `kontak`, `wilayah`, `jenis_kelamin`, `usia`, `tingkat_khawatir`, `kategori`, `jenis_pelapor`, `tempat_kejadian`, `waktu_kejadian`, `pelaku`, `kronologi`, `saran`, `status`, `handled_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'C001', '2026-05-10', 'Ani', '08123456789', 'Jakarta Barat, Kec. Kembangan, Kel. Meruya Utara, RT 03, RW 08', 'Wanita', 'Dewasa', 'Sangat Khawatir', 'KDRT', 'diri-sendiri', 'Rumah', 'Malam', 'Suami', 'Kekerasan dalam rumah tangga berulang kali.', NULL, 'Selesai', 1, '2026-05-11 15:11:37', '2026-05-12 07:47:06', NULL),
(2, 'C002', '2026-05-11', 'fadel', '08214618251025', 'Jakarta Barat, Kec. Kembangan, Kel. Meruya Utara, RT 01, RW 01', 'Pria', 'Dewasa', 'Khawatir', 'Penelantaran', 'diri-sendiri', 'Rumah', 'Sore', 'Pengasuh', 'asd', 'asd', 'Sedang Diproses', 1, '2026-05-11 15:15:07', '2026-05-12 07:47:08', NULL),
(3, 'C003', '2026-05-12', 'aurisa rabina', '08712641', 'Jakarta Barat, Kec. Tambora, Kel. Roa Malaka, RT 17, RW 18', 'Wanita', 'Dewasa', 'Sedikit Khawatir', 'Kekerasan Fisik', 'orang-lain', 'Rumah', 'Siang', 'Pacar', 'SAYA MENGALAMI PEMUKULAN TERHADAP WAJAH SAYA KETIKA SEDANG BERDEBAT DENGAN  PACAR SAYA', 'SAYA INGIN KASUS INI DENGAN CEPAT DITANGANI', 'Belum Diproses', NULL, '2026-05-12 07:47:00', '2026-05-12 07:47:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_attachments`
--

CREATE TABLE `complaint_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `complaint_id` bigint(20) UNSIGNED NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaint_attachments`
--

INSERT INTO `complaint_attachments` (`id`, `complaint_id`, `original_name`, `path`, `mime_type`, `size`, `created_at`, `updated_at`) VALUES
(1, 2, 'hrdEx4C3K7K7FfYHDVoJrQ.mp4', 'complaint-attachments/C002/I2ocii6YIsYshjsFF2d4CG7v19SJDfw5HjPmCbHj.mp4', 'video/mp4', 7195997, '2026-05-11 15:15:07', '2026-05-11 15:15:07'),
(2, 3, 'kilasan.png', 'complaint-attachments/C003/gnA3a1Nc4pWNXRIO5M33FDycR2DhNYtqJcA9pLmo.png', 'image/png', 1621221, '2026-05-12 07:47:00', '2026-05-12 07:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'User', 'user@test.com', 'Terima kasih, layanannya sangat membantu.', '2026-05-11 15:11:37', '2026-05-11 15:11:37', NULL);

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
(17, '0001_01_01_000000_create_users_table', 1),
(18, '0001_01_01_000001_create_cache_table', 1),
(19, '2026_05_10_000000_create_complaints_table', 1),
(20, '2026_05_10_000001_create_complaint_attachments_table', 1),
(21, '2026_05_10_000002_create_feedback_table', 1),
(22, '2026_05_11_000000_create_sessions_table', 1),
(23, '2026_05_11_000001_add_soft_deletes_to_complaints', 1),
(24, '2026_05_11_000002_add_soft_deletes_to_feedback', 1),
(25, '2026_05_11_000003_add_password_reset_tokens_table', 2);

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
('Benp48CK8ld3BeTu65rGcmw9OP4UwDn5mNTugUj7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0JvbDc2SU9SelUzYnY2cmNuWko2Y0kxNUtaZHhwdTcybXZZbTdQMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778571861),
('MngZVDOIqEyQQ0LSEQR9lPHyfGavbMAXohpbnnuO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.119.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWks1VXhGcEdKdnFqWHJwZXRYSDZJeUZxUWN0eWIwOXphOGoyWk9FdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778571884),
('uwombinF72mkTy5W0MYot8xcVFaWk6QAXSvXN1Q3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia053YTFXaXRTMVhQVWE2ZU00SW9jcnp2U01HQW9rR0tuNzk1eGdNTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZXR1Z2FzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1778572739);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin') NOT NULL DEFAULT 'admin',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `role`, `last_login_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Superadmin', 'super@kilasan.id', '$2y$12$a8HHnPBact5E7iTQFz4bh.VGKHQcw/EHMBD9/SITz2M6g7xymYkoG', 'superadmin', '2026-05-12 07:45:14', NULL, '2026-05-11 15:11:37', '2026-05-12 07:45:14'),
(2, 'admin', 'Admin', 'admin@kilasan.id', '$2y$12$U3gqHfTYfWBOeWt4CIUMXuoLDP/jhPA0oNgbNw7KhG0ZoM6ysJXwW', 'admin', NULL, NULL, '2026-05-11 15:11:37', '2026-05-11 15:11:37'),
(3, 'fadelpriyatna', NULL, 'fadelpriyatnaa@gmail.com', '$2y$12$DhUpXKboGAIyxJhNlUoIW.TEvhjwXSYefJvJcBVemXvIkQraA2X4m', 'admin', '2026-05-11 15:16:07', NULL, '2026-05-11 15:15:47', '2026-05-11 15:16:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `complaints_ticket_number_unique` (`ticket_number`),
  ADD KEY `complaints_handled_by_foreign` (`handled_by`);

--
-- Indexes for table `complaint_attachments`
--
ALTER TABLE `complaint_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_attachments_complaint_id_foreign` (`complaint_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
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
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaint_attachments`
--
ALTER TABLE `complaint_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `complaint_attachments`
--
ALTER TABLE `complaint_attachments`
  ADD CONSTRAINT `complaint_attachments_complaint_id_foreign` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
