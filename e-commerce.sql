-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2024 at 04:50 AM
-- Server version: 5.7.33
-- PHP Version: 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_03_063238_create_products_table', 1),
(5, '2024_11_03_063617_create_orders_table', 1),
(6, '2024_11_03_063726_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `status` enum('pending','paid','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `snaptoken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `snaptoken`, `created_at`, `updated_at`) VALUES
(1, 2, '300.00', 'pending', NULL, '2024-11-05 09:39:43', '2024-11-05 09:39:43'),
(2, 2, '200.00', 'paid', NULL, '2024-11-05 09:39:43', '2024-11-05 09:39:43'),
(3, 2, '15000000.00', 'pending', NULL, '2024-11-05 09:40:25', '2024-11-05 09:40:25'),
(12, 2, '999999.00', 'pending', NULL, NULL, NULL),
(13, 2, '2000000.00', 'paid', '381e768f-986e-41ee-9adf-f4be34a3c9d5', '2024-11-05 09:44:12', '2024-11-05 09:44:57'),
(16, 2, '88888.00', 'pending', NULL, NULL, NULL),
(17, 2, '999999.00', 'paid', '137114b1-5d7e-4e24-82c2-97395a8091b7', '2024-11-06 07:03:49', '2024-11-06 07:05:14'),
(18, 2, '15000000.00', 'pending', '805e6866-fe4e-44b6-8a42-5ef486de262c', '2024-11-06 07:16:07', '2024-11-06 07:16:09'),
(19, 2, '100000.00', 'pending', 'fba393c8-9cac-4591-9165-9eb17001e789', '2024-11-06 07:31:05', '2024-11-06 07:31:07'),
(20, 2, '100000.00', 'paid', 'df8f23a3-cbdc-48fb-94ac-e3b3f6ac418a', '2024-11-06 07:37:05', '2024-11-06 07:37:47'),
(21, 2, '400000.00', 'paid', 'fc6fd238-8d44-4104-9d26-1bc96c667035', '2024-11-06 07:41:25', '2024-11-06 07:42:06'),
(22, 2, '350000.00', 'paid', 'daf74733-f022-436c-8761-4ebe411c109d', '2024-11-06 07:58:36', '2024-11-06 07:59:24'),
(23, 2, '320000.00', 'paid', 'cb333286-2bf4-4865-bf64-e3f7acaa3923', '2024-11-06 21:04:38', '2024-11-06 21:05:42'),
(24, 2, '325000.00', 'paid', 'a4aad3e9-1724-4881-89f3-27111d779064', '2024-11-06 21:21:51', '2024-11-06 21:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 100, '2024-11-05 09:39:43', '2024-11-05 09:39:43'),
(2, 1, 2, 1, 200, '2024-11-05 09:39:43', '2024-11-05 09:39:43'),
(3, 2, 1, 1, 100, '2024-11-05 09:39:43', '2024-11-05 09:39:43'),
(4, 3, 2, 1, 15000000, '2024-11-05 09:40:25', '2024-11-05 09:40:25'),
(5, 13, 1, 1, 2000000, '2024-11-05 09:44:12', '2024-11-05 09:44:12'),
(6, 17, 5, 1, 999999, '2024-11-06 07:03:49', '2024-11-06 07:03:49'),
(7, 18, 2, 1, 15000000, '2024-11-06 07:16:07', '2024-11-06 07:16:07'),
(8, 19, 2, 1, 100000, '2024-11-06 07:31:05', '2024-11-06 07:31:05'),
(9, 20, 2, 1, 100000, '2024-11-06 07:37:05', '2024-11-06 07:37:05'),
(10, 21, 2, 1, 100000, '2024-11-06 07:41:25', '2024-11-06 07:41:25'),
(11, 21, 1, 1, 300000, '2024-11-06 07:41:25', '2024-11-06 07:41:25'),
(12, 22, 2, 1, 100000, '2024-11-06 07:58:36', '2024-11-06 07:58:36'),
(13, 22, 6, 1, 250000, '2024-11-06 07:58:36', '2024-11-06 07:58:36'),
(14, 23, 1, 1, 300000, '2024-11-06 21:04:38', '2024-11-06 21:04:38'),
(16, 24, 10, 1, 25000, '2024-11-06 21:21:51', '2024-11-06 21:21:51'),
(17, 24, 1, 1, 300000, '2024-11-06 21:21:51', '2024-11-06 21:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `is_active` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `gambar`, `description`, `price`, `stock`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'MICROPHONE', 'images/BnP2Nq3SibSFdpx4jWCSkFyOIt4u5ksrFtelgJSL.jpg', 'USB Microphone - logitech', 300000, 46, 'active', '2024-11-05 09:39:43', '2024-11-06 21:22:58'),
(2, 'HEADPHONE', 'images/gwa8MsPVZ7Co5e9jUDEBzBEqgu04ame87D8mMpIf.png', 'Headphone Bluetooth', 100000, 27, 'inactive', '2024-11-05 09:39:43', '2024-11-06 21:02:33'),
(3, 'MOUSE', 'images/SEw8VI2XE7AX3EPniEYOJI3hnGMk74L8Guuf5dZd.jpg', 'Prodigy Gaming House', 250000, 0, 'active', '2024-11-05 09:39:43', '2024-11-06 21:26:09'),
(5, 'Kasur', 'images/YyCN2WGZIV9d8ouWU0b3EpgHFZzC6se4BXox8Z4W.jpg', 'bahan halus, tebal dan nyaman', 999999, 19, 'inactive', '2024-11-06 06:14:21', '2024-11-06 07:53:49'),
(6, 'AIR JORDAN', 'images/N4pQHHf3ZYk6hHUVlAbYS13H7ojGR1GmwrGB1KSn.png', 'Sepatu Air Jordan', 250000, 14, 'active', '2024-11-06 07:53:17', '2024-11-06 19:58:56'),
(10, 'Baju', 'images/dwOgdyOjN9X6DDbbUph92VdGeozvwxo1vE0LIool.jpg', 'baju nyaman digunakan', 25000, 14, 'active', '2024-11-06 21:19:05', '2024-11-06 21:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NjEXJMV78yb3uhhEtwBJ8HW99liKlHbgfovnB3uT', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ1REa2ZUTkgyeUk3RnRLekJFMzJkNkJBdWFzajNVeDNNUktjZGRMTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1730953572),
('wn5ZnS7iDfHAfmQ6vtO3KW0nYNQ2k0RUotzKnKup', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQW5tamNJYWpzd09oR1UyRXZzbFdGSnJpbVQwRHE0ank3ejc4Y0RRcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWsiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1730953570);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin1@example.com', '2024-11-05 09:39:42', '$2y$12$FlNyGgy5xGgy7QH85M2PWuCCyUNimyzhFAYYeZXfKHBFJwNUuT7MG', 'admin', 'zGq7wgY4CCbgFLt4s9KwHmG2mtbEyiUiTBxlUsdoG8ytcc19MSp9fGxAlN1O', '2024-11-05 09:39:43', '2024-11-05 09:39:43'),
(2, 'Customer User', 'customer1@example.com', '2024-11-05 09:39:43', '$2y$12$ctgkxWIWHMYhaZVg4URvouRvdQHLM7/s5PnBhDQWGkvef8QJX8VD6', 'customer', 'cqTkBJplDZWxYLSnUQpglRIDb2PICImWjXEbAnEpQz9FRI1ydrIJ2g9VZIsi', '2024-11-05 09:39:43', '2024-11-05 09:39:43');

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
