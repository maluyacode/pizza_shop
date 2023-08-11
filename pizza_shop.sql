-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 07:44 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `detail`, `img_path`, `created_at`, `updated_at`) VALUES
(1, 'VEGETARIAN', 'VEGGIES', 'C:\\xampp\\tmp\\php6710.tmp', '2023-07-02 07:35:11', '2023-07-02 15:26:58'),
(3, 'NON-VEGETARIAN', 'VEGGIES & MEAT', 'C:\\xampp\\tmp\\php8BBA.tmp', '2023-07-02 15:27:35', '2023-08-07 00:04:54'),
(4, 'BEVERAGES', 'LIPTON ICE TEA | MIRINDA | PEPSI | 7UP | MINERAL WATER', '/storage/images/1688340537_card-5.jpg', '2023-07-02 15:28:57', '2023-07-02 15:28:57');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_02_120646_customer', 1),
(7, '2023_07_02_120700_product', 1),
(8, '2023_07_02_120720_category', 1),
(11, '2023_08_11_171450_create_payments_table', 2),
(12, '2023_08_11_171708_create_orders_table', 3),
(13, '2023_08_11_172602_create_order_product_table', 4),
(14, '2023_08_11_173335_create_stocks_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_date` date NOT NULL,
  `status` enum('pending','confirmed','recieved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(255) NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `detail`, `img_path`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'MARGHERITA', 99, 'A hugely popular margherita, with a deliciously tangy single cheese topping', 'C:\\xampp\\tmp\\phpA7A9.tmp', '2023-07-02 07:38:55', '2023-07-02 08:17:24', 0),
(2, 'DOUBLE CHEESE MARGHERITA', 199, 'The ever-popular Margherita - loaded with extra cheese...', 'C:\\xampp\\tmp\\php10A5.tmp', '2023-07-02 15:00:24', '2023-07-02 15:00:24', 0),
(3, 'FARM HOUSE', 149, 'A pizza that goes ballistic on veggies! Check out this mouth watering overload of crunchy, crisp capsicum, succulent mushrooms and fresh tomatoes.', 'C:\\xampp\\tmp\\php63A3.tmp', '2023-07-02 15:01:50', '2023-07-02 15:01:50', 0),
(4, 'PEPPY PANEER', 249, 'Chunky paneer with crisp capsicum and spicy red pepper - quite a mouthful!', 'C:\\xampp\\tmp\\phpA79E.tmp', '2023-07-02 15:03:13', '2023-07-02 15:03:13', 0),
(5, 'MEXICAN GREEN WAVE', 149, 'A pizza loaded with crunchy onions, crisp capsicum, juicy tomatoes and jalapeno with a liberal sprinkling of exotic Mexican herbs.', 'C:\\xampp\\tmp\\php2D06.tmp', '2023-07-02 15:04:52', '2023-07-02 15:04:52', 0),
(6, 'DELUXE VEGGIE', 319, 'For a vegetarian looking for a BIG treat that goes easy on the spices, this one\'s got it all.. The onions, the capsicum, those delectable \r\nmushrooms - with paneer and golden corn to top it all.', 'C:\\xampp\\tmp\\phpC51C.tmp', '2023-07-02 15:06:37', '2023-07-02 15:06:37', 0),
(7, 'CHEESE N CORN', 199, 'Cheese | Golden Corn', 'C:\\xampp\\tmp\\phpBCBB.tmp', '2023-07-02 15:07:40', '2023-07-02 15:07:40', 0),
(8, 'VEGGIE PARADISE', 299, 'Golden Corn | Black Olives | Capsicum & Red Paprika', 'C:\\xampp\\tmp\\php7FAA.tmp', '2023-07-02 15:09:36', '2023-07-02 15:09:36', 0),
(9, 'PEPPER BARBEQUE CHICKEN', 199, 'Pepper Barbeque Chicken | Cheese', 'C:\\xampp\\tmp\\php4FD2.tmp', '2023-07-02 15:12:40', '2023-07-02 15:12:40', 0),
(10, 'CHICKEN SAUSAGE', 249, 'Chicken Sausage | Cheese', 'C:\\xampp\\tmp\\php3ADF.tmp', '2023-07-02 15:13:40', '2023-07-02 15:13:40', 0),
(11, 'CHICKEN GOLDEN DELIGHT', 249, 'Barbeque chicken with a topping of golden corn loaded with extra cheese. Worth its weight in gold!', 'C:\\xampp\\tmp\\php87D3.tmp', '2023-07-02 15:15:06', '2023-07-02 15:15:06', 0),
(12, 'CHICKEN DOMINATOR', 319, 'Treat your taste buds with Double Pepper Barbecue Chicken, Peri-Peri Chicken, Chicken Tikka & Grilled Chicken Rashers', 'C:\\xampp\\tmp\\phpC34C.tmp', '2023-07-02 15:17:32', '2023-07-02 15:17:32', 0),
(13, 'CHICKEN FIESTA', 199, 'Grilled Chicken Rashers | Peri-Peri Chicken | Onion | Capsicum', 'C:\\xampp\\tmp\\phpE2D7.tmp', '2023-07-02 15:18:45', '2023-07-02 15:18:45', 0),
(14, 'INDI CHICKEN TIKKA', 349, 'The wholesome flavor of tandoori masala with Chicken tikka I onion I red paprika I \r\nmint mayo', 'C:\\xampp\\tmp\\php7678.tmp', '2023-07-02 15:20:29', '2023-07-02 15:20:29', 0),
(15, 'LIPTON ICE TEA', 25, '250ml', 'C:\\xampp\\tmp\\php5E78.tmp', '2023-07-02 15:21:28', '2023-07-02 15:21:28', 0),
(16, 'MIRINDA', 35, '500ml', 'C:\\xampp\\tmp\\phpF375.tmp', '2023-07-02 15:22:06', '2023-07-02 15:22:06', 0),
(17, 'PEPSI', 52, '500ml', 'C:\\xampp\\tmp\\php7B82.tmp', '2023-07-02 15:22:41', '2023-07-02 15:22:41', 0),
(18, '7UP', 52, '500ml', 'C:\\xampp\\tmp\\phpF641.tmp', '2023-07-02 15:23:12', '2023-07-02 15:23:12', 0),
(19, 'MINERAL WATER', 20, '100ml', 'C:\\xampp\\tmp\\phpA9F2.tmp', '2023-07-02 15:23:58', '2023-07-02 15:23:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `address`, `phone`, `role`) VALUES
(1, 'User1', 'user1@example.com', NULL, '$2y$10$XS1aQQEAZjEzT7ga3TI1eePcScHZ.8bt4UuPjKAhDO2WFZfil0zgG', NULL, '2023-07-02 04:39:30', '2023-07-02 04:39:30', NULL, NULL, 'user'),
(2, 'User2', 'user2@example.com', NULL, '$2y$10$CUuTfxjybh3.BSZc/mBQ2OT93l7ksUcdMZbd/w73bgyS5kNBXOutm', NULL, '2023-07-29 22:06:28', '2023-07-29 22:06:28', NULL, NULL, 'user'),
(3, 'Admin', 'admin@example.com', NULL, '$2y$10$xQql2yvqOKaoOXvzD7V27eTYAbDHR57qMhl2U6EYxNFc40.aoW10i', NULL, '2023-08-06 23:51:34', '2023-08-06 23:51:34', NULL, NULL, 'user'),
(4, 'Jurome', 'jurome@gmail.com', NULL, '$2y$10$CvJXWAHGG0b8TcFlg4ky6.L2IbV53gdFG4fBim7/vDkGAJF9Nr2y.', NULL, '2023-08-11 08:50:15', '2023-08-11 08:50:15', NULL, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
