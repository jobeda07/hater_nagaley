-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 30, 2024 at 04:41 PM
-- Server version: 10.6.18-MariaDB-cll-lve
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haternagaley_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_heads`
--

CREATE TABLE `account_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_heads`
--

INSERT INTO `account_heads` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Product Purchase', 'product-purchase', 1, '2022-06-22 03:49:01', '2023-03-25 01:07:48'),
(2, 'Product Sell', 'product-sell', 1, '2020-07-28 13:09:05', '2020-07-28 13:09:05'),
(3, 'Product Return', 'product-return', 1, '2021-09-14 05:59:26', '2021-09-14 05:59:26'),
(4, 'Cash Fund', 'cash-fund', 1, '2021-08-26 17:18:26', '2021-08-26 17:18:26'),
(6, 'Transport Cost', 'transport-cost', 1, '2020-09-04 11:51:38', '2020-09-04 11:51:38'),
(7, 'House rent', 'house-rent', 1, '2021-07-02 21:26:46', '2021-07-02 21:26:46'),
(8, 'Electricity Bill', 'electricity-bill', 1, '2021-07-04 23:54:29', '2021-07-04 23:54:29'),
(9, 'Courier Charge', 'courier-charge', 1, '2021-07-04 23:55:15', '2023-04-03 03:36:19'),
(10, 'Refreshment', 'refreshment', 1, '2021-07-04 23:55:34', '2021-07-04 23:55:34'),
(11, 'Market Bill', 'market-bill', 1, '2021-07-04 23:55:44', '2021-07-04 23:55:44'),
(12, 'Purchase Materials', 'purchase-materials', 1, '2021-07-04 23:56:08', '2021-07-04 23:56:08'),
(13, 'Packaging Cost', 'packaging-cost', 1, '2021-07-11 06:08:00', '2021-07-11 06:08:00'),
(14, 'Repair Materials', 'repair-materials', 1, '2021-07-11 06:08:55', '2021-07-11 06:08:55'),
(15, 'Damage/Loss', 'damage/loss', 1, '2021-07-19 08:34:00', '2022-10-16 01:45:54'),
(16, 'Web maintenance', 'web-maintenance', 1, '2021-07-19 08:34:34', '2021-07-19 08:34:34'),
(17, 'Others', 'others', 1, '2021-08-26 17:18:26', '2021-08-26 17:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `account_ledgers`
--

CREATE TABLE `account_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_head_id` bigint(20) UNSIGNED NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `debit` double NOT NULL DEFAULT 0,
  `credit` double NOT NULL DEFAULT 0,
  `balance` double NOT NULL DEFAULT 0,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Debit, 2=>Credit',
  `order_id` bigint(20) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_ledgers`
--

INSERT INTO `account_ledgers` (`id`, `account_head_id`, `particulars`, `debit`, `credit`, `balance`, `type`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'One-shoulder bag, fresh small bag, ladies purse bag, chain bag', 5990, 0, -5990, 1, 0, 1, '2024-03-14 23:26:22', '2024-03-14 23:26:22'),
(2, 1, 'Women Shoulder Bag', 11550, 0, -11550, 1, 0, 2, '2024-03-15 02:35:20', '2024-03-15 02:35:20'),
(3, 1, 'FASHIONABLE SHOULDER BAG, TRENDY BAG', 6000, 0, -6000, 1, 0, 3, '2024-03-15 03:05:43', '2024-03-15 03:05:43'),
(4, 1, 'handheld one-shoulder bag for leisure', 8000, 0, -8000, 1, 0, 4, '2024-03-15 04:03:16', '2024-03-15 04:03:16'),
(5, 1, 'Retro capacious one-shoulder bag, shoulder bag', 5000, 0, -5000, 1, 0, 5, '2024-03-15 05:50:07', '2024-03-15 05:50:07'),
(6, 1, 'Fashionable One Shoulder Bag', 5200, 0, -5200, 1, 0, 6, '2024-03-15 06:59:30', '2024-03-15 06:59:30'),
(7, 1, 'LADIES PURSE BAG,KOREAN STYLISH PURSE', 5600, 0, -5600, 1, 0, 7, '2024-03-15 10:53:37', '2024-03-15 10:53:37'),
(8, 1, 'Handhold fashionable small bag,KOREAN STYLISH PURSE', 5760, 0, -5760, 1, 0, 8, '2024-03-15 12:59:45', '2024-03-15 12:59:45'),
(9, 1, 'WOMEN FASHIONABLE ALLOY EARRINGS', 2800, 0, -2800, 1, 0, 9, '2024-03-16 03:02:29', '2024-03-16 03:02:29'),
(10, 1, 'K10 smart watch', 18000, 0, -18000, 1, 0, 10, '2024-03-16 04:19:32', '2024-03-16 04:19:32'),
(11, 1, 'Riversong', 17000, 0, -17000, 1, 0, 11, '2024-03-16 04:28:00', '2024-03-16 04:28:00'),
(12, 1, 'TWS M10', 7000, 0, -7000, 1, 0, 12, '2024-03-16 05:21:26', '2024-03-16 05:21:26'),
(13, 1, 'Nokia E3102 Essential True Wireless Earbuds', 66000, 0, -66000, 1, 0, 13, '2024-03-17 13:28:05', '2024-03-17 13:28:05'),
(14, 1, 'Nokia E3100 Plus Essential True Wireless Earbuds. 6 month warranty .', 60000, 0, -60000, 1, 0, 14, '2024-03-17 13:48:56', '2024-03-17 13:48:56'),
(15, 1, 'Nokia E3110 Essential True Wireless Earbuds  .    6 months warranty', 69000, 0, -69000, 1, 0, 15, '2024-03-17 14:00:30', '2024-03-17 14:00:30'),
(16, 1, 'Nokia E1502 Essential Wireless Neckband.6 months warranty', 36000, 0, -36000, 1, 0, 16, '2024-03-17 14:20:10', '2024-03-17 14:20:10'),
(17, 1, 'Nokia Essential Wireless Headphones E1200 ANC', 94000, 0, -94000, 1, 0, 17, '2024-03-17 17:07:03', '2024-03-17 17:07:03'),
(18, 1, 'Nokia Essential Wireless Earphones White E3106', 50000, 0, -50000, 1, 0, 18, '2024-03-17 17:33:38', '2024-03-17 17:33:38'),
(19, 1, 'Nokia Pro True Wireless Earphones P3802A .. 6months warranty', 87800, 0, -87800, 1, 0, 19, '2024-03-17 18:04:06', '2024-03-17 18:04:06'),
(20, 1, 'Xiaomi Mijia Smart IPX7 Waterproof Hair Trimmer', 64000, 0, -64000, 1, 0, 20, '2024-03-17 18:32:06', '2024-03-17 18:32:06'),
(21, 1, ' Oraimo FreePods Lite OTW-330 True Wireless Earbuds', 37500, 0, -37500, 1, 0, 21, '2024-03-18 13:50:27', '2024-03-18 13:50:27'),
(22, 1, 'Oraimo FreePods 3C OEB-E104DC Wireless Earbuds', 48000, 0, -48000, 1, 0, 23, '2024-03-18 14:33:11', '2024-03-18 14:33:11'),
(23, 1, 'Oraimo Charger Single Port USB Tank 3 Fast Charging 5V 1A OCW-E37SP', 12000, 0, -12000, 1, 0, 24, '2024-03-18 15:14:59', '2024-03-18 15:14:59'),
(24, 1, 'Oraimo Rover OBS-53D RGB Portable Wireless Speaker', 52500, 0, -52500, 1, 0, 25, '2024-03-18 15:24:36', '2024-03-18 15:24:36'),
(25, 1, 'Oraimo Boom Portable Wireless Speaker OBS-75D', 100000, 0, -100000, 1, 0, 26, '2024-03-18 15:36:00', '2024-03-18 15:36:00'),
(26, 1, 'Oraimo OEB-E105D FreePods 4 - ANC Noise Cancellation APP Control - True Wireless Earbuds- Black', 90000, 0, -90000, 1, 0, 27, '2024-03-18 15:50:17', '2024-03-18 15:50:17'),
(27, 1, 'Kieslect Calling Smartwatch Kr Pro Ltd', 100500, 0, -100500, 1, 0, 28, '2024-03-19 08:04:18', '2024-03-19 08:04:18'),
(28, 1, 'Riversong Motive 6C Pro Bluetooth Calling Smart Watch', 105000, 0, -105000, 1, 0, 29, '2024-03-19 08:40:54', '2024-03-19 08:40:54'),
(29, 1, 'Riversong Motive 7s Bluetooth Calling Smart Watch', 91290, 0, -91290, 1, 0, 32, '2024-03-19 11:32:24', '2024-03-19 11:32:24'),
(30, 1, 'Amazfit Bip 5 Bluetooth Calling 1.91” Ultra-big Screen Smart Watch', 238500, 0, -238500, 1, 0, 33, '2024-03-19 14:15:18', '2024-03-19 14:15:18'),
(31, 1, 'Redmi Watch 3 Active', 117600, 0, -117600, 1, 0, 34, '2024-03-19 15:00:58', '2024-03-19 15:00:58'),
(32, 1, 'NOKIA E3101| Essential True Wireless Earphone/ENC Noise Reduction/13mm Speaker/20H Battery | Black', 48000, 0, -48000, 1, 0, 35, '2024-03-19 15:22:47', '2024-03-19 15:22:47'),
(33, 1, 'Anker PowerPort III 20W Cube', 7500, 0, -7500, 1, 0, 36, '2024-03-19 15:31:17', '2024-03-19 15:31:17'),
(34, 1, 'Nokia Essential Power Bank E6205-1 10000mAh', 30000, 0, -30000, 1, 0, 37, '2024-03-19 15:31:43', '2024-03-19 15:31:43'),
(35, 1, 'Nokia Essential True Wireless E3103. Bluetooth ear buds.', 50000, 0, -50000, 1, 0, 38, '2024-03-19 15:39:42', '2024-03-19 15:39:42'),
(36, 1, 'Anker 313 GaN 30W PIQ 3.0 – Foldable Fast Charger', 31800, 0, -31800, 1, 0, 40, '2024-03-20 04:34:32', '2024-03-20 04:34:32'),
(37, 1, 'Oraimo OCD-M53 2A 1M Data Cable- Black', 4500, 0, -4500, 1, 0, 43, '2024-03-20 04:58:15', '2024-03-20 04:58:15'),
(38, 1, 'Oraimo OCD-M12 2A 1M Data Cable-White/Black', 15000, 0, -15000, 1, 0, 44, '2024-03-20 05:10:01', '2024-03-20 05:10:01'),
(39, 1, 'Oraimo OCD-M32 2A 1M Data Cable-Black', 7500, 0, -7500, 1, 0, 45, '2024-03-20 11:15:00', '2024-03-20 11:15:00'),
(40, 1, 'Orimo OCD-C53 2A Fast Charging USB Data Cable Type C', 7000, 0, -7000, 1, 0, 46, '2024-03-20 11:24:03', '2024-03-20 11:24:03'),
(41, 1, 'Oraimo FastLine 2 OCD-C54 5V 3A 1M Type-C Data Cable', 30000, 0, -30000, 1, 0, 48, '2024-03-20 11:37:39', '2024-03-20 11:37:39'),
(42, 1, 'Oraimo OCD-C54P Fastline2 Type-C Data Cable', 8500, 0, -8500, 1, 0, 49, '2024-03-20 12:54:35', '2024-03-20 12:54:35'),
(43, 1, 'Oraimo OCD-C32 3A Data Cable 1M-Black', 10000, 0, -10000, 1, 0, 51, '2024-03-20 13:29:24', '2024-03-20 13:29:24'),
(44, 1, 'Smart Watch Ultra 02', 31000, 0, -31000, 1, 0, 52, '2024-03-22 12:57:07', '2024-03-22 12:57:07'),
(45, 1, 'Unique Design Premium Quality Loffer For Men\'s Loafer For Wedding Party Fashion Daily Functional Use Elegant', 24000, 0, -24000, 1, 0, 53, '2024-03-22 17:36:28', '2024-03-22 17:36:28'),
(46, 1, 'Superb Quality - Loafer Styles\' Rubber Sole Winter and Summer Wind Proof Shoe For Men - Trend and Needful - Understated Sophistication', 24000, 0, -24000, 1, 0, 54, '2024-03-22 17:44:18', '2024-03-22 17:44:18'),
(47, 1, 'For stylist men formal Artificial Leather Loafers', 24000, 0, -24000, 1, 0, 55, '2024-03-22 17:52:09', '2024-03-22 17:52:09'),
(48, 1, 'Jeorjet embroi stone work 4 peace', 10950, 0, -10950, 1, 0, 56, '2024-03-24 12:13:45', '2024-03-24 12:13:45'),
(49, 1, 'Soft Georgette Embroidery & Sequence Work. Replica', 35000, 0, -35000, 1, 0, 57, '2024-03-24 12:30:49', '2024-03-24 12:30:49'),
(50, 1, 'Soft Georgette Embroidery & Sequence Work. Replica', 19350, 0, -19350, 1, 0, 58, '2024-03-24 12:36:48', '2024-03-24 12:36:48'),
(51, 1, 'Soft Georgette Embroidery & Sequence Work. Replica', 26250, 0, -26250, 1, 0, 59, '2024-03-24 12:40:43', '2024-03-24 12:40:43'),
(52, 1, 'Soft Georgette Embroidery & Sequence Work. Replica', 26250, 0, -26250, 1, 0, 60, '2024-03-24 12:43:55', '2024-03-24 12:43:55'),
(53, 1, 'Party Dress for Girls. Indian gujrati Dress', 29250, 0, -29250, 1, 0, 66, '2024-03-24 13:22:09', '2024-03-24 13:22:09'),
(54, 1, '❤️Pom pom gown❤️ Long 52/54 Body 34-44 Fabric Georgette', 24000, 0, -24000, 1, 0, 67, '2024-03-24 13:31:07', '2024-03-24 13:31:07'),
(55, 1, 'সম্পূর্ণ লেটেস্ট ডিজাইনের রেডি থ্রি পিস কালেকশন', 10500, 0, -10500, 1, 0, 68, '2024-03-24 13:35:48', '2024-03-24 13:35:48'),
(56, 1, 'Combo watch for women new fashion 2024', 18000, 0, -18000, 1, 0, 70, '2024-03-25 03:26:42', '2024-03-25 03:26:42'),
(57, 1, 'Watch combo for womens', 34000, 0, -34000, 1, 0, 71, '2024-03-25 03:33:36', '2024-03-25 03:33:36'),
(58, 1, 'Braclet watch available . New Fashion for women 20204', 7350, 0, -7350, 1, 0, 72, '2024-03-25 04:11:29', '2024-03-25 04:11:29'),
(59, 1, 'কুইন প্রিন্সেস  হেড', 3450, 0, -3450, 1, 0, 73, '2024-03-25 04:19:46', '2024-03-25 04:19:46'),
(60, 1, '🌸𝐉𝐚𝐩𝐚𝐧 𝐒𝐚𝐤𝐮𝐫𝐚 𝐒𝐤𝐢𝐧 𝐂𝐚𝐫𝐞 𝐂𝐨𝐦𝐛𝐨 𝐒𝐞𝐭 🌸', 8400, 0, -8400, 1, 0, 74, '2024-03-25 05:12:18', '2024-03-25 05:12:18'),
(61, 1, '💎𝘿𝙞𝙢𝙤𝙢𝙙 𝙒𝙝𝙞𝙩𝙚𝙣𝙞𝙣𝙜 𝘽𝙤𝙤𝙨𝙩𝙚𝙧 𝙉𝙞𝙜𝙝𝙩 𝘾𝙧𝙚𝙖𝙢 +  𝙁𝙖𝙘𝙞𝙖𝙡 𝙎𝙚𝙧𝙪𝙢  👉𝐌𝐚𝐝𝐞 𝐢𝐧 𝐓𝐡𝐚𝐢𝐥𝐚𝐧𝐝🇨🇷', 12400, 0, -12400, 1, 0, 75, '2024-03-25 05:20:13', '2024-03-25 05:20:13'),
(62, 1, 'Face Care combo package 2024', 5000, 0, -5000, 1, 0, 76, '2024-03-25 05:25:32', '2024-03-25 05:25:32'),
(63, 1, 'Face and full Body whitening combo', 0, 0, 0, 1, 0, 77, '2024-03-25 05:28:47', '2024-03-25 05:28:47'),
(64, 1, 'Premium Saffron Combo🥰', 6400, 0, -6400, 1, 0, 78, '2024-03-25 05:33:58', '2024-03-25 05:33:58'),
(65, 1, '10 in one. যারা শুধুমাত্র ফর্সা হতে চাচ্ছেন কোন ধরনের সাইড ইফেক্ট ছাড়া এই কম্বোটি তাদের জন্য।', 11000, 0, -11000, 1, 0, 79, '2024-03-25 05:38:10', '2024-03-25 05:38:10'),
(66, 1, 'ভাইরাল বাদশা সিরাম💞 Osufi Collagen Face Serum 💞 Made In Korea.', 11500, 0, -11500, 1, 0, 80, '2024-03-25 05:47:15', '2024-03-25 05:47:15'),
(67, 1, 'Portable & Rechargable Battery Juice Blender', 11760, 0, -11760, 1, 0, 81, '2024-03-25 05:55:56', '2024-03-25 05:55:56'),
(68, 1, 'Makeup  item Combo package 2024', 13188, 0, -13188, 1, 0, 82, '2024-03-25 05:59:49', '2024-03-25 05:59:49'),
(69, 1, 'Viral Makeup Combo 2024', 7200, 0, -7200, 1, 0, 83, '2024-03-25 06:03:47', '2024-03-25 06:03:47'),
(70, 1, 'Lace Flower headpiece.', 2500, 0, -2500, 1, 0, 84, '2024-03-25 06:09:39', '2024-03-25 06:09:39'),
(71, 1, 'Pure tensil cotton with ambrodari work', 35400, 0, -35400, 1, 0, 85, '2024-03-26 01:28:12', '2024-03-26 01:28:12'),
(72, 1, 'Eid package Saree combo package', 23000, 0, -23000, 1, 0, 86, '2024-03-26 01:39:53', '2024-03-26 01:39:53'),
(73, 1, '𝐄𝐈𝐃 𝐂𝐎𝐋𝐋𝐄𝐂𝐓𝐈𝐎𝐍 𝟐𝐊𝟐𝟒 || 𝐍𝐄𝐖 𝐀𝐑𝐑𝐈𝐕𝐀𝐋||Panjabis', 156000, 0, -156000, 1, 0, 89, '2024-03-26 14:21:59', '2024-03-26 14:21:59'),
(74, 1, '2024 New Bag Women\'s Fashion Woven Shoulder Bag Large Capacity Casual Color Contrast Straw Tote Bag', 21900, 0, -21900, 1, 0, 90, '2024-03-26 14:31:26', '2024-03-26 14:31:26'),
(75, 1, 'New Half Silk Screen Print Saree for Women\'s', 28000, 0, -28000, 1, 0, 91, '2024-03-26 14:50:59', '2024-03-26 14:50:59'),
(76, 1, 'Fabric details - Pure Soft Organza Beautiful print with foil outline allover saree', 28000, 0, -28000, 1, 0, 94, '2024-03-26 16:40:13', '2024-03-26 16:40:13'),
(77, 1, 'High quality r skin print Flw full details  Full katan silk sari', 10500, 0, -10500, 1, 0, 95, '2024-03-26 16:45:59', '2024-03-26 16:45:59'),
(78, 1, 'Valentine Combo package', 37500, 0, -37500, 1, 0, 96, '2024-03-26 23:24:01', '2024-03-26 23:24:01'),
(79, 1, 'Fashion pu leather premium quality tote shoulder bag', 34800, 0, -34800, 1, 0, 97, '2024-03-26 23:41:18', '2024-03-26 23:41:18'),
(80, 1, 'Letter Patch Chain Decor Tote Bag – Women Tote Bags', 22800, 0, -22800, 1, 0, 98, '2024-03-26 23:56:33', '2024-03-26 23:56:33'),
(81, 1, 'Shirt + Pants Combo. Cotton shirt Kaiser Cotton Gabardine.', 127500, 0, -127500, 1, 0, 101, '2024-03-27 00:21:04', '2024-03-27 00:21:04'),
(82, 1, 'Premium Sequence Jari Sutar Embroidery Punjabi', 308000, 0, -308000, 1, 0, 102, '2024-03-27 00:46:25', '2024-03-27 00:46:25'),
(83, 1, 'Fabric:-  Dubai cherry - Burkha. New fashion 2024', 20400, 0, -20400, 1, 0, 103, '2024-03-27 07:07:52', '2024-03-27 07:07:52'),
(84, 1, 'Crusher', 19000, 0, -19000, 1, 0, 104, '2024-03-27 12:10:02', '2024-03-27 12:10:02'),
(85, 1, 'Scented Candles Jar Vintage Flower Candle', 18000, 0, -18000, 1, 0, 105, '2024-03-28 02:16:57', '2024-03-28 02:16:57'),
(86, 1, 'Bluetooth  earbuds raba B10 new Model', 4950, 0, -4950, 1, 0, 106, '2024-03-28 02:23:47', '2024-03-28 02:23:47'),
(87, 1, 'Ball Gown 2 Materials. Womens new Fashion', 17800, 0, -17800, 1, 0, 107, '2024-03-28 02:29:55', '2024-03-28 02:29:55'),
(88, 1, 'Indian jeorjet sharee with blouse', 35000, 0, -35000, 1, 0, 108, '2024-03-28 02:46:14', '2024-03-28 02:46:14'),
(89, 1, 'আড়ং কটন নকশি পাইর শাড়ি  রানিং ব্লাউস পিস সহ।', 10200, 0, -10200, 1, 0, 109, '2024-03-28 02:52:57', '2024-03-28 02:52:57'),
(90, 1, 'New white Fassion saree', 7500, 0, -7500, 1, 0, 110, '2024-03-28 03:04:47', '2024-03-28 03:04:47'),
(91, 1, 'Embrace your femininity & make a statement  with our stunning cut work visca slub silk saree.', 23600, 0, -23600, 1, 0, 111, '2024-03-28 03:14:09', '2024-03-28 03:14:09'),
(92, 1, 'Eid special!!!  Saree Combo package.', 6495, 0, -6495, 1, 0, 112, '2024-03-28 03:21:31', '2024-03-28 03:21:31'),
(93, 1, 'Shirt Combo Package', 37000, 0, -37000, 1, 0, 113, '2024-03-28 13:19:33', '2024-03-28 13:19:33'),
(94, 2, 'Newest M10 TWS With Digital Indicator True Wireless Earbuds', 0, 2280, 2280, 2, 9, 0, '2024-03-29 02:12:09', '2024-03-29 02:12:09'),
(95, 2, 'Newest M10 TWS With Digital Indicator True Wireless Earbuds', 0, 610, 610, 2, 10, 0, '2024-03-29 02:19:45', '2024-03-29 02:19:45'),
(96, 2, 'Bluetooth  earbuds raba B10 new Model', 0, 1140, 1140, 2, 11, 0, '2024-03-30 08:04:28', '2024-03-30 08:04:28'),
(97, 1, 'New  Makeup  item . Eid special offer!!', 3400, 0, -3400, 1, 0, 115, '2024-03-30 15:18:41', '2024-03-30 15:18:41'),
(98, 1, 'Cute & Gorgeous Brush set for Makeup. Makeup Brush combo set all in one', 11750, 0, -11750, 1, 0, 116, '2024-03-30 15:22:28', '2024-03-30 15:22:28'),
(99, 1, 'Clobetamil-G Skin Care Cream Combo. Made in Thailand.', 0, 0, 0, 1, 0, 117, '2024-03-30 15:26:57', '2024-03-30 15:26:57'),
(100, 1, 'প্রিমিয়াম কোয়ালিটি পাঞ্জাবি', 23400, 0, -23400, 1, 0, 120, '2024-04-01 14:40:43', '2024-04-01 14:40:44'),
(101, 1, 'প্রিমিয়াম কোয়ালিটি পাঞ্জাবি  সাইজ', 21240, 0, -21240, 1, 0, 121, '2024-04-01 14:47:50', '2024-04-01 14:47:50'),
(102, 1, 'Dubai Cherry Fabric borkha', 20250, 0, -20250, 1, 0, 122, '2024-04-01 14:53:16', '2024-04-01 14:53:16'),
(103, 1, 'AC cotton  Size-free. soft butter silk 3peace', 10950, 0, -10950, 1, 0, 123, '2024-04-01 14:58:18', '2024-04-01 14:58:18'),
(104, 1, 'Handiyan 6 peice lipp', 7500, 0, -7500, 1, 0, 124, '2024-04-01 15:03:30', '2024-04-01 15:03:30'),
(105, 1, 'New viral cosmetics  combo package.', 30000, 0, -30000, 1, 0, 125, '2024-04-02 11:57:04', '2024-04-02 11:57:04'),
(106, 2, 'Nokia Essential Power Bank E6205-1 10000mAh', 0, 2059, 2059, 2, 12, 0, '2024-04-03 02:02:35', '2024-04-03 02:02:35'),
(107, 2, 'Nokia Essential Power Bank E6205-1 10000mAh', 0, 4058, 4058, 2, 13, 0, '2024-04-03 02:43:31', '2024-04-03 02:43:31'),
(108, 1, 'New fashionable bags for women.', 10500, 0, -10500, 1, 0, 126, '2024-04-03 12:34:27', '2024-04-03 12:34:27'),
(109, 1, 'Nokia Essential Wireless Headphones E1200 ANC', 12000, 0, -12000, 1, 0, 127, '2024-04-04 00:17:26', '2024-04-04 00:17:26'),
(110, 1, 'জীবন বদলে দেয়ার মতো ১০টি বই সেট।', 9600, 0, -9600, 1, 0, 128, '2024-04-07 09:32:33', '2024-04-07 09:32:33'),
(111, 1, 'Xiaomi Mi Automatic Soap Dispenser', 99950, 0, -99950, 1, 0, 129, '2024-04-08 16:50:49', '2024-04-08 16:50:49'),
(112, 1, 'Xiaomi Mi MDZ-28-DI Compact Mini Bluetooth Speaker 2 Global Version White', 36000, 0, -36000, 1, 0, 130, '2024-04-08 17:01:08', '2024-04-08 17:01:08'),
(113, 1, 'Vitamin C siram', 11000, 0, -11000, 1, 0, 131, '2024-04-14 01:17:46', '2024-04-14 01:17:46'),
(114, 1, 'RICE CERAM', 7500, 0, -7500, 1, 0, 132, '2024-04-14 01:24:49', '2024-04-14 01:24:49'),
(115, 2, 'Women Shoulder Bag', 0, 694, 694, 2, 14, 0, '2024-04-16 11:57:56', '2024-04-16 11:57:56'),
(116, 1, 'JISULIFE FA13P Rechargeable Desk Fan 8000mAh – White Color', 71500, 0, -71500, 1, 0, 133, '2024-04-17 10:27:30', '2024-04-17 10:27:30'),
(117, 2, 'JISULIFE FA13P Rechargeable Desk Fan 8000mAh – White Color', 0, 3670, 3670, 2, 15, 0, '2024-04-17 10:45:42', '2024-04-17 10:45:42'),
(118, 2, 'Handhold fashionable small bag,KOREAN STYLISH PURSE', 0, 420, 420, 2, 16, 0, '2024-04-17 12:27:58', '2024-04-17 12:27:58'),
(119, 1, 'ডায়মন্ড কাট ব্রেসলেট', 1400, 0, -1400, 1, 0, 134, '2024-04-18 07:29:25', '2024-04-18 07:29:25'),
(120, 1, 'পুতির ওয়ালমেট', 0, 0, 0, 1, 0, 135, '2024-04-20 01:52:07', '2024-04-20 01:52:07'),
(121, 1, 'Homemade pithas', 0, 0, 0, 1, 0, 136, '2024-04-20 02:02:25', '2024-04-20 02:02:25'),
(122, 2, 'Pure tensil cotton with ambrodari work', 0, 870, 870, 2, 17, 0, '2024-05-09 05:06:18', '2024-05-09 05:06:18'),
(123, 2, 'ডায়মন্ড কাট ব্রেসলেট', 0, 260, 260, 2, 19, 0, '2024-05-13 04:56:41', '2024-05-13 04:56:41'),
(124, 2, 'Invoice No: 0000020', 0, 250, 250, 2, 20, 0, '2024-05-13 05:33:08', '2024-05-13 05:33:08'),
(125, 1, 'Teddy Bear Pendant Necklace', 7000, 0, -7000, 1, 0, 137, '2024-05-15 01:21:52', '2024-05-15 01:21:52'),
(126, 2, 'Teddy Bear Pendant Necklace', 0, 570, 570, 2, 1, 0, '2024-05-18 01:13:33', '2024-05-18 01:13:33'),
(127, 1, 'Tws Ultra Pods Max White Transparent Design, 30 Hrs Playtime with Fast Charging, Bluetooth 5.3 + ENC, 13mm HD BASS Drivers, Built-in Mic', 10400, 0, -10400, 1, 0, 139, '2024-05-26 02:24:33', '2024-05-26 02:24:33'),
(128, 1, 'M28 TWS Wireless Gaming Earbuds', 5800, 0, -5800, 1, 0, 140, '2024-05-26 10:32:19', '2024-05-26 10:32:19'),
(129, 1, 'Tws mms68', 10800, 0, -10800, 1, 0, 141, '2024-05-26 23:57:17', '2024-05-26 23:57:17'),
(130, 1, 'MMS-66', 16000, 0, -16000, 1, 0, 142, '2024-05-27 00:15:39', '2024-05-27 00:15:39'),
(131, 1, 'Bt-2301', 17000, 0, -17000, 1, 0, 143, '2024-05-27 09:36:43', '2024-05-27 09:36:43'),
(132, 1, 'SX9 Mini Dual Microphone. Wireless microphone', 56000, 0, -56000, 1, 0, 144, '2024-05-27 09:55:27', '2024-05-27 09:55:27'),
(133, 1, 'মহুয়া বোরকা', 29000, 0, -29000, 1, 0, 145, '2024-06-12 08:13:41', '2024-06-12 08:13:41'),
(134, 1, 'মহুয়া বোরকা', 29000, 0, -29000, 1, 0, 146, '2024-06-12 08:13:42', '2024-06-12 08:13:42'),
(135, 1, 'KXD GS8 Ultra pro Smart watch', 31000, 0, -31000, 1, 0, 147, '2024-07-25 08:33:12', '2024-07-25 08:33:12'),
(136, 1, 'S9 Ultra Sports Pedometer 1.75 Inch 3PCS Straps Wireless Charger Health Smart Watch', 17000, 0, -17000, 1, 0, 148, '2024-07-25 08:51:23', '2024-07-25 08:51:23'),
(137, 1, 'Smart Sound Machine Wake Up Light Alarm Clocks Smart Table Lamp', 32500, 0, -32500, 1, 0, 149, '2024-07-25 09:50:10', '2024-07-25 09:50:10'),
(138, 1, 'Ultrapods Pro True Wireless Earbuds Water Proof', 5200, 0, -5200, 1, 0, 150, '2024-07-26 08:09:04', '2024-07-26 08:09:04'),
(139, 1, '10000mah Transparent Power Bank / 22.5w Fast charging', 115000, 0, -115000, 1, 0, 151, '2024-07-28 12:39:57', '2024-07-28 12:39:57'),
(140, 2, 'VIRAL BADSHAH SERUM💞 Osufi Collagen Face Serum 💞 Made In Korea.', 0, 1410, 1410, 2, 2, 0, '2024-08-18 21:25:32', '2024-08-18 21:25:32'),
(141, 2, 'VIRAL BADSHAH SERUM💞 Osufi Collagen Face Serum 💞 Made In Korea.', 0, 1410, 1410, 2, 4, 0, '2024-08-18 21:25:38', '2024-08-18 21:25:38'),
(142, 1, 'Xiaomi Mi P1 L55M6-6AEU/6ARG 55 Inch Smart Android 4K TV with Netflix (Global Version)', 559000, 0, -559000, 1, 0, 152, '2024-08-21 21:35:08', '2024-08-21 21:35:08'),
(143, 2, 'Shirt + Pants Combo. Cotton shirt Kaiser Cotton Gabardine.', 0, 1120, 1120, 2, 5, 0, '2024-09-10 02:53:54', '2024-09-10 02:53:54'),
(144, 2, 'Braclet watch available . New Fashion for women 20204', 0, -1000, -1000, 2, 6, 0, '2024-09-10 03:00:59', '2024-09-10 03:00:59'),
(145, 2, 'Xiaomi Mi P1 L55M6-6AEU/6ARG 55 Inch Smart Android 4K TV with Netflix (Global Version)', 0, 70, 70, 2, 7, 0, '2024-09-10 03:03:48', '2024-09-10 03:03:48'),
(146, 1, 'vendor product1', 474000, 0, -474000, 1, 0, 153, '2024-09-24 03:03:24', '2024-09-24 03:03:24'),
(147, 2, 'vendor product1', 0, 575, 575, 2, 8, 0, '2024-09-24 03:04:44', '2024-09-24 03:04:44'),
(148, 1, 'Cyrus Bird', 367200, 0, -367200, 1, 0, 1, '2024-09-24 04:12:51', '2024-09-24 04:12:51'),
(149, 1, 'Jennifer Herring', 445560, 0, -445560, 1, 0, 2, '2024-09-24 04:18:46', '2024-09-24 04:18:46'),
(150, 1, 'Jocelyn Robertson', 410624, 0, -410624, 1, 0, 1, '2024-09-24 05:09:06', '2024-09-24 05:09:06'),
(151, 1, 'Chadwick Mckee', 274550, 0, -274550, 1, 0, 2, '2024-09-24 05:09:26', '2024-09-24 05:09:26'),
(152, 2, 'Chadwick Mckee', 0, 707, 707, 2, 1, 0, '2024-09-24 05:10:17', '2024-09-24 05:10:17'),
(153, 2, 'Chadwick Mckee', 0, 787, 787, 2, 2, 0, '2024-09-24 05:10:52', '2024-09-24 05:10:52'),
(154, 2, 'Jocelyn Robertson', 0, 508, 508, 2, 5, 0, '2024-09-25 04:26:02', '2024-09-25 04:26:02'),
(155, 1, 'MOXX 20W  Power PD  Gan Adapter', 7000, 0, -7000, 1, 0, 3, '2024-09-25 04:50:24', '2024-09-25 04:50:24'),
(156, 1, 'MOXX AIR 17 EARBUDS', 0, 0, 0, 1, 0, 4, '2024-09-25 04:53:40', '2024-09-25 04:53:40'),
(157, 1, 'MOXX 20W Power USB & PD GaN Adapter [MC-20]', 14000, 0, -14000, 1, 0, 5, '2024-09-25 04:56:02', '2024-09-25 04:56:02'),
(158, 1, 'MOXX AIR 16 EARBUDS', 0, 0, 0, 1, 0, 6, '2024-09-25 05:01:23', '2024-09-25 05:01:23'),
(159, 1, 'MOXX MPOD PRO ANC', 0, 0, 0, 1, 0, 7, '2024-09-25 05:05:29', '2024-09-25 05:05:29'),
(160, 1, 'MOXX AIR 15 EARBUDS', 0, 0, 0, 1, 0, 8, '2024-09-25 05:11:42', '2024-09-25 05:11:42'),
(161, 1, 'MOXX GAME BUDS EARBUDS', 0, 0, 0, 1, 0, 9, '2024-09-25 05:14:28', '2024-09-25 05:14:28'),
(162, 1, 'MOXX 30W Power USB & PD GaN Adapter [MC-30]', 0, 0, 0, 1, 0, 10, '2024-09-25 05:15:16', '2024-09-25 05:15:16'),
(163, 1, 'MOXX FIREBUDS', 0, 0, 0, 1, 0, 11, '2024-09-25 05:16:54', '2024-09-25 05:16:54'),
(164, 1, 'MOXX MPOD ANC & ENC TWS Wireless Earbuds', 0, 0, 0, 1, 0, 12, '2024-09-25 05:19:58', '2024-09-25 05:19:58'),
(165, 1, 'MOXX MPOD ENC TWS Wireless Earbuds', 0, 0, 0, 1, 0, 13, '2024-09-25 05:22:28', '2024-09-25 05:22:28'),
(166, 1, 'MOXX Wireless TWS LED Display Earbuds', 0, 0, 0, 1, 0, 14, '2024-09-25 05:37:52', '2024-09-25 05:37:52'),
(167, 1, 'MOXX Wireless TWS Headset', 0, 0, 0, 1, 0, 15, '2024-09-25 05:41:42', '2024-09-25 05:41:42'),
(168, 1, 'MOXX WIRELESS NECKBAND | VOICE CHANGER | HD CALL', 0, 0, 0, 1, 0, 16, '2024-09-25 06:29:54', '2024-09-25 06:29:54'),
(169, 1, 'MOXX PREMIUM WIRELESS NECKBAND | SUPER BASS | 40 HOURS MUSIC TIME', 4500, 0, -4500, 1, 0, 17, '2024-09-25 06:33:06', '2024-09-25 06:33:06'),
(170, 1, 'MOXX WIRELESS NECKBAND HEADPHONE | TWO CHANNEL POWERFUL STEREO SOUND | 40 HOURS MUSIC TIME', 5000, 0, -5000, 1, 0, 18, '2024-09-25 06:34:37', '2024-09-25 06:34:37'),
(171, 1, 'MOXX Wireless ENC Premium Neckband [BN300] | Super Touching Control | Environmental Noise Cancellation [ENC] Active', 11000, 0, -11000, 1, 0, 19, '2024-09-25 06:36:05', '2024-09-25 06:36:05'),
(172, 1, 'MOXX Wireless BT Neckband [BN100] | 35 Hours Music Time | 200 Hours Standby Time', 6000, 0, -6000, 1, 0, 20, '2024-09-25 06:37:26', '2024-09-25 06:37:26'),
(173, 1, 'MOXX Metal Wireless BT Neckband [MN200] | 35 Hours Music Time | Music-Rock-Gaming Mode', 9000, 0, -9000, 1, 0, 21, '2024-09-25 06:38:41', '2024-09-25 06:38:41'),
(174, 1, 'MOXX 22.5W 20000mAh POWERBANK | LED DISPLAY', 19000, 0, -19000, 1, 0, 22, '2024-09-25 06:42:14', '2024-09-25 06:42:14'),
(175, 1, 'MOXX 10000mAh 22.5w POWERBANK | BUILD TYPE-C & LIGHTNING | FAST CHARGING', 15000, 0, -15000, 1, 0, 23, '2024-09-25 06:43:21', '2024-09-25 06:43:21'),
(176, 1, 'MOXX 20000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 20000, 0, -20000, 1, 0, 24, '2024-09-25 06:44:32', '2024-09-25 06:44:32'),
(177, 1, 'MOXX 10000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 15000, 0, -15000, 1, 0, 25, '2024-09-25 06:45:55', '2024-09-25 06:45:55'),
(178, 1, 'MOXX 10000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 15000, 0, -15000, 1, 0, 26, '2024-09-25 06:47:17', '2024-09-25 06:47:17'),
(179, 1, 'MOXX WIRELESS MICROPHONE | DUALMICROPHONE | 100% NOISE CANCELLATION', 13000, 0, -13000, 1, 0, 27, '2024-09-25 06:49:50', '2024-09-25 06:49:50'),
(180, 1, 'MOXX WIRELESS MICROPHONE', 0, 0, 0, 1, 0, 28, '2024-09-25 06:50:33', '2024-09-25 06:50:33'),
(181, 1, 'MOXX RGB Portable Wireless Speaker | RGB Light | Waterproof (IPX6)', 12000, 0, -12000, 1, 0, 29, '2024-09-25 06:53:17', '2024-09-25 06:53:17'),
(182, 1, 'MOXX RGB Wireless Speaker | RGB Light | BT Speaker', 12000, 0, -12000, 1, 0, 30, '2024-09-25 06:54:08', '2024-09-25 06:54:08'),
(183, 2, 'MOXX WIRELESS MICROPHONE | DUALMICROPHONE | 100% NOISE CANCELLATION', 0, 3470, 3470, 2, 6, 0, '2024-09-26 06:34:41', '2024-09-26 06:34:41'),
(184, 1, 'drop shoulder', 3000, 0, -3000, 1, 0, 31, '2024-09-26 12:15:23', '2024-09-26 12:15:23'),
(185, 2, 'drop shoulder', 0, 790, 790, 2, 7, 0, '2024-09-26 15:10:52', '2024-09-26 15:10:52'),
(186, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 32, '2024-09-26 23:59:04', '2024-09-26 23:59:04'),
(187, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 33, '2024-09-27 00:07:28', '2024-09-27 00:07:28'),
(188, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 34, '2024-09-27 00:23:50', '2024-09-27 00:23:50'),
(189, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 35, '2024-09-27 00:34:37', '2024-09-27 00:34:37'),
(190, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 36, '2024-09-27 00:38:29', '2024-09-27 00:38:29'),
(191, 1, 'T-shirt', 270, 0, -270, 1, 0, 37, '2024-09-27 00:42:38', '2024-09-27 00:42:38'),
(192, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 38, '2024-09-27 00:44:48', '2024-09-27 00:44:48'),
(193, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 39, '2024-09-27 00:47:15', '2024-09-27 00:47:15'),
(194, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 40, '2024-09-27 00:53:41', '2024-09-27 00:53:41'),
(195, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 41, '2024-09-27 00:56:57', '2024-09-27 00:56:57'),
(196, 1, 'T-shirt', 2700, 0, -2700, 1, 0, 42, '2024-09-27 00:59:41', '2024-09-27 00:59:41'),
(197, 1, 'T-shirt', 3700, 0, -3700, 1, 0, 43, '2024-09-27 02:33:41', '2024-09-27 02:33:41'),
(198, 2, 'T-shirt', 0, 470, 470, 2, 8, 0, '2024-09-27 04:29:04', '2024-09-27 04:29:04'),
(199, 2, 'T-shirt', 0, 470, 470, 2, 9, 0, '2024-09-27 05:50:47', '2024-09-27 05:50:47'),
(200, 1, 'test1', 196448, 0, -196448, 1, 0, 46, '2024-09-28 03:10:01', '2024-09-28 03:10:01'),
(201, 1, 'Yetta Henderson', 85050, 0, -85050, 1, 0, 47, '2024-09-28 03:10:44', '2024-09-28 03:10:44'),
(202, 1, 'Drop shoulder T-shirt', 3300, 0, -3300, 1, 0, 48, '2024-09-28 03:43:31', '2024-09-28 03:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `division_name` varchar(50) DEFAULT NULL,
  `district_name` varchar(50) DEFAULT NULL,
  `upazilla_name` varchar(50) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `upazilla_id` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Default, 0=>Not Default',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Size', 1, 1, '2024-09-28 00:36:24', '2024-09-28 00:36:24'),
(2, 'color', 1, 1, '2024-09-28 00:37:28', '2024-09-28 00:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_product`
--

CREATE TABLE `attribute_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(100) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'L', 1, 1, '2024-09-28 00:36:36', '2024-09-28 00:36:36'),
(2, 1, 'M', 1, 1, '2024-09-28 00:36:43', '2024-09-28 00:36:43'),
(3, 1, 'XL', 1, 1, '2024-09-28 00:36:57', '2024-09-28 00:36:57'),
(4, 1, 'XXL', 1, 1, '2024-09-28 00:37:01', '2024-09-28 00:37:01'),
(5, 2, 'Black', 1, 1, '2024-09-28 00:37:41', '2024-09-28 00:37:41'),
(6, 2, 'Merun', 1, 1, '2024-09-28 00:37:49', '2024-09-28 00:37:49'),
(7, 1, 'M / L / XL /XXL', 1, 1, '2024-09-28 01:41:52', '2024-09-28 01:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value_product_price`
--

CREATE TABLE `attribute_value_product_price` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_price_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(50) NOT NULL,
  `title_bn` varchar(50) DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_bn` text DEFAULT NULL,
  `position` varchar(255) NOT NULL DEFAULT '1' COMMENT '1=>Home Banner, 0=>Footer Banner',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title_en`, `title_bn`, `banner_img`, `banner_url`, `description_en`, `description_bn`, `position`, `status`, `created_at`, `updated_at`) VALUES
(27, 'Hater Nagaley', 'Hater Nagaley', 'upload/banner/1811375620438278.jpg', 'https://haternagaley.com/category-product/Mens--Fashion-O7aKL', 'Hater Nagaley', 'Hater Nagaley', '1', 1, '2024-09-27 12:40:06', '2024-09-27 12:40:06');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `title_bn` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `blog_img` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `name_bn` varchar(50) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `description_en` text DEFAULT NULL,
  `description_bn` text DEFAULT NULL,
  `brand_image` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name_en`, `name_bn`, `slug`, `description_en`, `description_bn`, `brand_image`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Basil Reid', 'Phoebe Salas', 'basil-reid', 'Laudantium quia rer', 'Est in dolore pariat', 'upload/brand/1811075411480331.png', 1, 1, '2024-09-24 05:08:25', '2024-09-24 05:08:25'),
(2, 'MOXX', 'MOXX', 'moxx', 'Chinese brand', 'Chinese brand', 'upload/brand/1811165434615937.jpg', 1, 1, '2024-09-25 04:59:17', '2024-09-25 04:59:17'),
(3, 'sempai outfitters', 'sempai outfitters', 'sempai-outfitters-6lHxN', NULL, NULL, '', 1, 1, '2024-09-26 11:58:40', '2024-09-26 11:58:40'),
(4, 'sempai outfitters', 'sempai outfitters', 'sempai-outfitters-JX0mR', NULL, NULL, '', 1, 1, '2024-09-26 12:02:20', '2024-09-26 12:02:20'),
(5, 'anime t-shirt', 'anime t-shirt', 'anime-t-shirt-vC0A1', NULL, NULL, '', 1, 1, '2024-09-26 23:53:32', '2024-09-26 23:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `campaings`
--

CREATE TABLE `campaings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `name_bn` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `campaing_image` varchar(255) DEFAULT NULL,
  `flash_start` varchar(100) DEFAULT NULL,
  `flash_end` varchar(100) DEFAULT NULL,
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Featured, 0=>Not Featured	',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaings`
--

INSERT INTO `campaings` (`id`, `name_en`, `name_bn`, `slug`, `campaing_image`, `flash_start`, `flash_end`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(3, 'sempai outfitters', 'sempai outfitters', 'sempai-outfitters', 'upload/campaing/1811375966736415.png', '23-09-2024 16:00:00', '17-10-2024 00:00:00', 1, 1, '2024-09-27 12:45:36', '2024-09-30 04:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `campaing_products`
--

CREATE TABLE `campaing_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaing_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `discount_price` double NOT NULL DEFAULT 0,
  `discount_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Flat, 2=>Percentage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaing_products`
--

INSERT INTO `campaing_products` (`id`, `campaing_id`, `product_id`, `product_name`, `discount_price`, `discount_type`, `created_at`, `updated_at`) VALUES
(62, 3, 42, NULL, 30, 2, '2024-09-30 04:39:39', '2024-09-30 04:39:39'),
(63, 3, 41, NULL, 30, 2, '2024-09-30 04:39:39', '2024-09-30 04:39:39'),
(64, 3, 40, NULL, 30, 2, '2024-09-30 04:39:39', '2024-09-30 04:39:39'),
(65, 3, 39, NULL, 30, 2, '2024-09-30 04:39:39', '2024-09-30 04:39:39'),
(66, 3, 38, NULL, 30, 2, '2024-09-30 04:39:39', '2024-09-30 04:39:39'),
(67, 3, 5, NULL, 0, 1, '2024-09-30 04:39:39', '2024-09-30 04:39:39'),
(68, 3, 4, NULL, 0, 1, '2024-09-30 04:39:39', '2024-09-30 04:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `name_bn` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `description_en` text DEFAULT NULL,
  `description_bn` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Category, 2=>SubCategory, 3=> SubSubCategory',
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Featured, 0=>Not Featured',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_en`, `name_bn`, `slug`, `description_en`, `description_bn`, `image`, `parent_id`, `type`, `is_featured`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'Adapter', 'Adapter', 'Adapter-OHTCj', NULL, NULL, 'upload/category/17273358361709465057-02.jpg', 9, 2, 0, 1, 1, '2024-09-25 04:38:11', '2024-09-26 14:45:37'),
(3, 'Earbud', 'Earbud', 'Earbud-AKw5B', NULL, NULL, 'upload/category/17273362901709465295-01.jpg', 9, 2, 0, 1, 1, '2024-09-25 04:42:06', '2024-09-26 14:45:29'),
(4, 'Powerbank', 'Powerbank', 'Powerbank-wvkhM', NULL, NULL, 'upload/category/17273358261711877375-01.jpg', 9, 2, 0, 1, 1, '2024-09-25 04:46:49', '2024-09-26 14:51:28'),
(6, 'NeckBand', 'NeckBand', 'NeckBand-T49B3', NULL, NULL, 'upload/category/17273358081709468816-11.jpg', 9, 2, 0, 1, 1, '2024-09-25 06:28:22', '2024-09-26 14:52:15'),
(7, 'Microphone', 'Microphone', 'Microphone-XmWj1', NULL, NULL, 'upload/category/17273362541719296377-05.jpg', 9, 2, 0, 1, 1, '2024-09-25 06:48:51', '2024-09-26 14:52:20'),
(8, 'Speaker', 'Speaker', 'Speaker-b2Wlu', NULL, NULL, 'upload/category/17273357911711878501-01.jpg', 9, 2, 0, 1, 1, '2024-09-25 06:51:38', '2024-09-26 14:52:26'),
(9, 'Mobile  Accessories', 'Mobile', 'Mobile--Accessories-V8AXp', NULL, NULL, 'upload/category/1727383850download.jpeg', 0, 1, 1, 1, 1, '2024-09-26 05:58:42', '2024-09-26 14:50:50'),
(10, 'Mens  Fashion', 'Mens  Fashion', 'Mens--Fashion-O7aKL', NULL, NULL, 'upload/category/1811281693508604.jpg', 0, 1, 1, 1, 1, '2024-09-26 11:47:10', '2024-09-26 14:19:34'),
(11, 'anime t-shirt', 'anime t-shirt', 'anime-t-shirt-jdqez', NULL, NULL, '', 10, 2, 0, 1, 1, '2024-09-27 00:02:29', '2024-09-27 00:02:29'),
(13, 'Drop shoulder T-shirt men', 'Drop shoulder T-shirt men', 'Drop-shoulder-T-shirt-men-M5DZz', NULL, NULL, '', 10, 2, 0, 1, 1, '2024-09-28 03:36:27', '2024-09-28 03:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `discount_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Fixed Amount, 0=>Percent',
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `limit_per_user` double(20,2) NOT NULL DEFAULT 0.00,
  `total_use_limit` double(20,2) NOT NULL DEFAULT 0.00,
  `expire_date` date DEFAULT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>All Customers, 0=>Specific Customer',
  `user_id` varchar(255) DEFAULT NULL,
  `producttype` int(11) NOT NULL DEFAULT 1 COMMENT '1=All Product,0=Specific Product',
  `product_id` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `discount_type`, `discount`, `limit_per_user`, `total_use_limit`, `expire_date`, `type`, `user_id`, `producttype`, `product_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '003344', 0, 234.00, 5.00, 3.00, '2222-02-22', 1, '', 0, '30', NULL, 1, '2024-09-26 22:38:02', '2024-09-26 22:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `division_name_bn` varchar(150) NOT NULL,
  `district_name_bn` varchar(130) NOT NULL,
  `district_name_en` text NOT NULL,
  `division_name_en` text NOT NULL,
  `division_id` varchar(210) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0:Blocked, 1:Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_name_bn`, `district_name_bn`, `district_name_en`, `division_name_en`, `division_id`, `status`) VALUES
(1, 'চট্টগ্রাম', 'কুমিল্লা', 'cumilla', 'chattogram', '2', 1),
(2, 'চট্টগ্রাম', 'ফেনী', 'feni', 'chattogram', '2', 1),
(3, 'চট্টগ্রাম', 'ব্রাহ্মণবাড়িয়া', 'brahmanbaria', 'chattogram', '2', 1),
(4, 'চট্টগ্রাম', 'রাঙ্গামাটি', 'rangamati', 'chattogram', '2', 1),
(5, 'চট্টগ্রাম', 'নোয়াখালী', 'noakhali', 'chattogram', '2', 1),
(6, 'চট্টগ্রাম', 'চাঁদপুর', 'chandpur', 'chattogram', '2', 1),
(7, 'চট্টগ্রাম', 'লক্ষ্মীপুর', 'lakshmipur', 'chattogram', '2', 1),
(8, 'চট্টগ্রাম', 'চট্টগ্রাম', 'chattogram', 'chattogram', '2', 1),
(9, 'চট্টগ্রাম', 'কক্সবাজার', 'coxsbazar', 'chattogram', '2', 1),
(10, 'চট্টগ্রাম', 'খাগড়াছড়ি', 'khagrachari', 'chattogram', '2', 1),
(11, 'চট্টগ্রাম', 'বান্দরবান', 'bandarban', 'chattogram', '2', 1),
(12, 'রাজশাহী', 'সিরাজগঞ্জ', 'sirajganj', 'rajshahi', '3', 1),
(13, 'রাজশাহী', 'পাবনা', 'pabna', 'rajshahi', '3', 1),
(14, 'রাজশাহী', 'বগুড়া', 'bogura', 'rajshahi', '3', 1),
(15, 'রাজশাহী', 'রাজশাহী', 'rajshahi', 'rajshahi', '3', 1),
(16, 'রাজশাহী', 'নাটোর', 'natore', 'rajshahi', '3', 1),
(17, 'রাজশাহী', 'জয়পুরহাট', 'jaipurhat', 'rajshahi', '3', 1),
(18, 'রাজশাহী', 'চাঁপাইনবাবগঞ্জ', 'nawabganj', 'rajshahi', '3', 1),
(19, 'রাজশাহী', 'নওগাঁ', 'naogaon', 'rajshahi', '3', 1),
(20, 'খুলনা', 'যশোর', 'jashore', 'khulna', '4', 1),
(21, 'খুলনা', 'সাতক্ষীরা', 'satkhira', 'khulna', '4', 1),
(22, 'খুলনা', 'মেহেরপুর', 'meherpur', 'khulna', '4', 1),
(23, 'খুলনা', 'নড়াইল', 'narail', 'khulna', '4', 1),
(24, 'খুলনা', 'চুয়াডাঙ্গা', 'chuadanga', 'khulna', '4', 1),
(25, 'খুলনা', 'কুষ্টিয়া', 'kushtia', 'khulna', '4', 1),
(26, 'খুলনা', 'মাগুরা', 'magura', 'khulna', '4', 1),
(27, 'খুলনা', 'খুলনা', 'khulna', 'khulna', '4', 1),
(28, 'খুলনা', 'বাগেরহাট', 'bagerhat', 'khulna', '4', 1),
(29, 'খুলনা', 'ঝিনাইদহ', 'jhenaidah', 'khulna', '4', 1),
(30, 'বরিশাল', 'বরিশাল', 'barishal', 'barishal', '5', 1),
(31, 'বরিশাল', 'ঝালকাঠি', 'jhalokati', 'barishal', '5', 1),
(32, 'বরিশাল', 'পটুয়াখালী', 'patuakhali', 'barishal', '5', 1),
(33, 'বরিশাল', 'পিরোজপুর', 'pirojpur', 'barishal', '5', 1),
(34, 'বরিশাল', 'ভোলা', 'bhola', 'barishal', '5', 1),
(35, 'বরিশাল', 'বরগুনা', 'barguna', 'barishal', '5', 1),
(36, 'সিলেট', 'সিলেট', 'sylhet', 'sylhet', '6', 1),
(37, 'সিলেট', 'মৌলভীবাজার', 'moulvibazar', 'sylhet', '6', 1),
(38, 'সিলেট', 'হবিগঞ্জ', 'habiganj', 'sylhet', '6', 1),
(39, 'সিলেট', 'সুনামগঞ্জ', 'sunamganj', 'sylhet', '6', 1),
(40, 'রংপুর', 'রংপুর', 'rangpur', 'rangpur', '7', 1),
(41, 'রংপুর', 'পঞ্চগড়', 'panchagarh', 'rangpur', '7', 1),
(42, 'রংপুর', 'দিনাজপুর', 'dinajpur', 'rangpur', '7', 1),
(43, 'রংপুর', 'লালমনিরহাট', 'lalmonirhat', 'rangpur', '7', 1),
(44, 'রংপুর', 'নীলফামারী', 'nilphamari', 'rangpur', '7', 1),
(45, 'রংপুর', 'ঠাকুরগাঁও', 'thakurgaon', 'rangpur', '7', 1),
(46, 'রংপুর', 'গাইবান্ধা', 'gaibandha', 'rangpur', '7', 1),
(47, 'রংপুর', 'কুড়িগ্রাম', 'kurigram', 'rangpur', '7', 1),
(48, 'ময়মনসিংহ', 'ময়মনসিংহ', 'mymensingh', 'mymensingh', '8', 1),
(49, 'ময়মনসিংহ', 'জামালপুর', 'jamalpur', 'mymensingh', '8', 1),
(50, 'ময়মনসিংহ', 'নেত্রকোণা', 'netrokona', 'mymensingh', '8', 1),
(51, 'ময়মনসিংহ', 'শেরপুর', 'sherpur', 'mymensingh', '8', 1),
(52, 'ঢাকা', 'ঢাকা', 'dhaka', 'dhaka', '1', 1),
(53, 'ঢাকা', 'নরসিংদী', 'narsingdi', 'dhaka', '1', 1),
(54, 'ঢাকা', 'গাজীপুর', 'gazipur', 'dhaka', '1', 1),
(55, 'ঢাকা', 'শরীয়তপুর', 'shariatpur', 'dhaka', '1', 1),
(56, 'ঢাকা', 'নারায়ণগঞ্জ', 'narayanganj', 'dhaka', '1', 1),
(57, 'ঢাকা', 'টাঙ্গাইল', 'tangail', 'dhaka', '1', 1),
(58, 'ঢাকা', 'কিশোরগঞ্জ', 'kishoreganj', 'dhaka', '1', 1),
(59, 'ঢাকা', 'মানিকগঞ্জ', 'manikganj', 'dhaka', '1', 1),
(60, 'ঢাকা', 'মুন্সিগঞ্জ', 'munshiganj', 'dhaka', '1', 1),
(61, 'ঢাকা', 'রাজবাড়ী', 'rajbari', 'dhaka', '1', 1),
(62, 'ঢাকা', 'মাদারীপুর', 'madaripur', 'dhaka', '1', 1),
(63, 'ঢাকা', 'ফরিদপুর', 'faridpur', 'dhaka', '1', 1),
(64, 'ঢাকা', 'গোপালগঞ্জ', 'gopalganj', 'dhaka', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `division_id` varchar(30) NOT NULL,
  `division_name_bn` varchar(30) NOT NULL,
  `division_name_en` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0:Blocked, 1:Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `division_id`, `division_name_bn`, `division_name_en`, `country_id`, `status`) VALUES
(1, '1', 'ঢাকা', 'dhaka', 22, 1),
(2, '2', 'চট্টগ্রাম', 'chattogram', 22, 1),
(3, '3', 'রাজশাহী', 'rajshahi', 22, 1),
(4, '4', 'খুলনা', 'khulna', 22, 1),
(5, '5', 'বরিশাল', 'barishal', 22, 1),
(6, '6', 'সিলেট', 'sylhet', 22, 1),
(7, '7', 'রংপুর', 'rangpur', 22, 1),
(8, '8', 'ময়মনসিংহ', 'mymensingh', 22, 1);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2022_07_24_074842_create_multi_imgs_table', 1),
(27, '2022_02_04_061801_create_product_prices_table', 6),
(28, '2022_02_04_065518_create_attribute_product_table', 6),
(29, '2022_05_20_152549_create_attribute_value_product_price_table', 6),
(47, '2022_07_23_114405_create_sliders_table', 7),
(51, '2022_07_28_064437_create_campaings_table', 7),
(53, '2022_07_31_095124_create_blogs_table', 7),
(54, '2022_08_01_045408_create_pages_table', 7),
(56, '2022_08_10_105324_create_addresses_table', 7),
(57, '2022_08_14_045916_create_settings_table', 7),
(60, '2022_08_19_201539_create_product_stocks_table', 8),
(61, '2022_09_03_062044_create_shippings_table', 9),
(62, '2022_08_14_105209_create_order_details_table', 10),
(63, '2022_09_03_055707_create_coupons_table', 11),
(65, '2022_07_30_093841_create_banners_table', 12),
(67, '2022_09_17_111303_create_campaing_products_table', 13),
(68, '2022_09_27_050816_create_subscribers_table', 14),
(69, '2022_09_28_103615_create_roles_table', 15),
(71, '2022_09_28_110124_create_staff_table', 16),
(72, '2022_07_24_111956_create_vendors_table', 17),
(73, '2022_07_19_132400_create_brands_table', 18),
(74, '2022_07_20_105632_create_categories_table', 18),
(75, '2022_07_21_140629_create_suppliers_table', 18),
(76, '2022_07_24_063334_create_products_table', 18),
(77, '2022_08_04_073752_create_attributes_table', 18),
(78, '2022_08_06_053505_create_attribute_values_table', 18),
(79, '2022_08_14_105132_create_orders_table', 18),
(80, '2022_10_16_060400_create_account_heads_table', 19),
(82, '2022_10_16_082419_create_account_ledgers_table', 20),
(84, '2022_12_31_055130_create_units_table', 21),
(85, '2024_01_25_053758_create_pos_carts_table', 22),
(86, '2024_02_03_053719_create_withdraws_table', 23),
(87, '2023_09_02_071710_create_reviews_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `multi_imgs`
--

CREATE TABLE `multi_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `photo_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_imgs`
--

INSERT INTO `multi_imgs` (`id`, `product_id`, `photo_name`, `created_at`, `updated_at`) VALUES
(1, 5, 'upload/products/multi-image/1811165229434413.jpg', '2024-09-25 04:56:02', NULL),
(8, 30, 'upload/products/multi-image/1811351905321465.jpg', '2024-09-27 06:23:10', NULL),
(9, 30, 'upload/products/multi-image/1811351905652918.jpg', '2024-09-27 06:23:10', NULL),
(10, 30, 'upload/products/multi-image/1811351905811708.jpg', '2024-09-27 06:23:10', NULL),
(11, 29, 'upload/products/multi-image/1811352109355614.jpg', '2024-09-27 06:26:24', NULL),
(12, 29, 'upload/products/multi-image/1811352109464305.jpg', '2024-09-27 06:26:24', NULL),
(13, 29, 'upload/products/multi-image/1811352109584069.jpg', '2024-09-27 06:26:25', NULL),
(14, 27, 'upload/products/multi-image/1811352490834925.jpg', '2024-09-27 06:32:28', NULL),
(15, 27, 'upload/products/multi-image/1811352491129226.jpg', '2024-09-27 06:32:29', NULL),
(16, 26, 'upload/products/multi-image/1811352676404186.jpg', '2024-09-27 06:35:25', NULL),
(17, 26, 'upload/products/multi-image/1811352676598604.jpg', '2024-09-27 06:35:25', NULL),
(18, 26, 'upload/products/multi-image/1811352676736606.jpg', '2024-09-27 06:35:25', NULL),
(19, 25, 'upload/products/multi-image/1811352813792116.jpg', '2024-09-27 06:37:36', NULL),
(20, 25, 'upload/products/multi-image/1811352813927703.jpg', '2024-09-27 06:37:36', NULL),
(21, 25, 'upload/products/multi-image/1811352814050827.jpg', '2024-09-27 06:37:36', NULL),
(22, 24, 'upload/products/multi-image/1811353069885778.jpg', '2024-09-27 06:41:40', NULL),
(23, 24, 'upload/products/multi-image/1811353555813220.jpg', '2024-09-27 06:49:24', NULL),
(24, 24, 'upload/products/multi-image/1811353555942268.jpg', '2024-09-27 06:49:24', NULL),
(25, 23, 'upload/products/multi-image/1811353726125251.jpg', '2024-09-27 06:52:06', NULL),
(26, 23, 'upload/products/multi-image/1811353726194161.jpg', '2024-09-27 06:52:06', NULL),
(27, 23, 'upload/products/multi-image/1811353726260232.jpg', '2024-09-27 06:52:06', NULL),
(28, 21, 'upload/products/multi-image/1811354638934917.jpg', '2024-09-27 07:06:37', NULL),
(29, 21, 'upload/products/multi-image/1811354639168388.jpg', '2024-09-27 07:06:37', NULL),
(30, 21, 'upload/products/multi-image/1811354639286664.jpg', '2024-09-27 07:06:37', NULL),
(31, 20, 'upload/products/multi-image/1811355073340136.jpg', '2024-09-27 07:13:31', NULL),
(32, 20, 'upload/products/multi-image/1811355073458597.jpg', '2024-09-27 07:13:31', NULL),
(33, 20, 'upload/products/multi-image/1811355073553326.jpg', '2024-09-27 07:13:31', NULL),
(34, 20, 'upload/products/multi-image/1811355073642160.jpg', '2024-09-27 07:13:31', NULL),
(35, 18, 'upload/products/multi-image/1811355320029213.jpg', '2024-09-27 07:17:26', NULL),
(36, 18, 'upload/products/multi-image/1811355320312843.jpg', '2024-09-27 07:17:27', NULL),
(37, 18, 'upload/products/multi-image/1811355320861668.jpg', '2024-09-27 07:17:27', NULL),
(38, 18, 'upload/products/multi-image/1811355321019587.jpg', '2024-09-27 07:17:27', NULL),
(39, 17, 'upload/products/multi-image/1811355588946087.jpg', '2024-09-27 07:21:43', NULL),
(40, 17, 'upload/products/multi-image/1811355589037964.jpg', '2024-09-27 07:21:43', NULL),
(41, 16, 'upload/products/multi-image/1811355729276547.jpg', '2024-09-27 07:23:57', NULL),
(42, 16, 'upload/products/multi-image/1811355729607703.jpg', '2024-09-27 07:23:57', NULL),
(43, 16, 'upload/products/multi-image/1811355729883694.jpg', '2024-09-27 07:23:57', NULL),
(44, 15, 'upload/products/multi-image/1811355882154240.jpg', '2024-09-27 07:26:22', NULL),
(45, 15, 'upload/products/multi-image/1811355882282411.jpg', '2024-09-27 07:26:22', NULL),
(46, 15, 'upload/products/multi-image/1811355882348022.jpg', '2024-09-27 07:26:22', NULL),
(47, 14, 'upload/products/multi-image/1811355984697751.jpg', '2024-09-27 07:28:00', NULL),
(48, 14, 'upload/products/multi-image/1811355984766260.jpg', '2024-09-27 07:28:00', NULL),
(49, 13, 'upload/products/multi-image/1811356150290892.jpg', '2024-09-27 07:30:38', NULL),
(50, 13, 'upload/products/multi-image/1811356150362421.jpg', '2024-09-27 07:30:38', NULL),
(51, 12, 'upload/products/multi-image/1811356434560517.jpg', '2024-09-27 07:35:09', NULL),
(52, 12, 'upload/products/multi-image/1811356434689207.jpg', '2024-09-27 07:35:09', NULL),
(53, 12, 'upload/products/multi-image/1811356434809332.jpg', '2024-09-27 07:35:09', NULL),
(54, 11, 'upload/products/multi-image/1811356597346732.jpg', '2024-09-27 07:37:44', NULL),
(55, 11, 'upload/products/multi-image/1811356597511892.jpg', '2024-09-27 07:37:45', NULL),
(56, 10, 'upload/products/multi-image/1811356824590380.jpg', '2024-09-27 07:41:21', NULL),
(57, 10, 'upload/products/multi-image/1811356824662631.jpg', '2024-09-27 07:41:21', NULL),
(58, 10, 'upload/products/multi-image/1811356824725586.jpg', '2024-09-27 07:41:21', NULL),
(59, 9, 'upload/products/multi-image/1811356995797674.png', '2024-09-27 07:44:04', NULL),
(60, 9, 'upload/products/multi-image/1811356996009173.jpg', '2024-09-27 07:44:05', NULL),
(61, 9, 'upload/products/multi-image/1811356996183053.jpg', '2024-09-27 07:44:05', NULL),
(62, 7, 'upload/products/multi-image/1811357175745090.png', '2024-09-27 07:46:56', NULL),
(63, 6, 'upload/products/multi-image/1811357320849002.jpg', '2024-09-27 07:49:15', NULL),
(64, 6, 'upload/products/multi-image/1811357321903143.jpg', '2024-09-27 07:49:15', NULL),
(65, 6, 'upload/products/multi-image/1811357322106963.jpg', '2024-09-27 07:49:16', NULL),
(66, 5, 'upload/products/multi-image/1811357460696534.jpg', '2024-09-27 07:51:28', NULL),
(67, 5, 'upload/products/multi-image/1811357460783558.jpg', '2024-09-27 07:51:28', NULL),
(68, 5, 'upload/products/multi-image/1811357460831116.jpg', '2024-09-27 07:51:28', NULL),
(69, 4, 'upload/products/multi-image/1811357616136463.jpg', '2024-09-27 07:53:56', NULL),
(70, 4, 'upload/products/multi-image/1811357616265225.jpg', '2024-09-27 07:53:56', NULL),
(71, 4, 'upload/products/multi-image/1811357616434645.jpg', '2024-09-27 07:53:56', NULL),
(72, 4, 'upload/products/multi-image/1811357616566544.jpg', '2024-09-27 07:53:56', NULL),
(73, 3, 'upload/products/multi-image/1811357878530743.jpg', '2024-09-27 07:58:06', NULL),
(74, 3, 'upload/products/multi-image/1811357878598264.jpg', '2024-09-27 07:58:06', NULL),
(79, 48, 'upload/products/multi-image/1811432457805309.jpg', '2024-09-28 03:43:31', NULL),
(80, 48, 'upload/products/multi-image/1811432457926288.jpg', '2024-09-28 03:43:31', NULL),
(81, 48, 'upload/products/multi-image/1811432457990485.jpg', '2024-09-28 03:43:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `upazilla_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_method` varchar(25) NOT NULL DEFAULT 'cash',
  `payment_status` varchar(50) NOT NULL DEFAULT 'unpaid',
  `payment_details` text DEFAULT NULL,
  `shipping_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_type` varchar(100) DEFAULT NULL,
  `shipping_name` varchar(150) DEFAULT NULL,
  `pur_sub_total` decimal(10,2) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_discount` decimal(11,2) DEFAULT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `viewed` varchar(255) NOT NULL DEFAULT '0',
  `staff_id` int(11) DEFAULT NULL,
  `staff_commission` varchar(255) DEFAULT NULL,
  `delivery_viewed` varchar(255) NOT NULL DEFAULT '1',
  `payment_status_viewed` varchar(255) NOT NULL DEFAULT '1',
  `commission_calculated` varchar(255) NOT NULL DEFAULT '0',
  `comment` text DEFAULT NULL,
  `delivery_status` varchar(255) NOT NULL DEFAULT 'pending',
  `tracking_code` varchar(100) DEFAULT NULL,
  `confirmed_date` varchar(30) DEFAULT NULL,
  `processing_date` varchar(30) DEFAULT NULL,
  `picked_date` varchar(30) DEFAULT NULL,
  `shipped_date` varchar(30) DEFAULT NULL,
  `delivered_date` varchar(30) DEFAULT NULL,
  `cancel_date` varchar(30) DEFAULT NULL,
  `return_date` varchar(30) DEFAULT NULL,
  `return_reason` text DEFAULT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Not guest order, 2=>Guest Order, 3=>Reseller order, 4=>Manual Order',
  `sale_type` int(10) UNSIGNED DEFAULT 1 COMMENT '1=>Manual Sale, 2=>Guest Order',
  `prepaid_amount` decimal(10,2) DEFAULT 0.00,
  `collectable_amount` decimal(10,2) DEFAULT 0.00,
  `vendor_show_status` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `v_comission` decimal(10,0) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `is_varient` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Varient Product, 0=>Normal Product',
  `variation` longtext DEFAULT NULL,
  `qty` varchar(100) DEFAULT NULL,
  `price` double(20,2) NOT NULL DEFAULT 0.00,
  `tax` double(20,2) NOT NULL DEFAULT 0.00,
  `shipping_cost` double(20,2) NOT NULL DEFAULT 0.00,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `shipping_type` varchar(255) DEFAULT NULL,
  `pickup_point_id` int(11) DEFAULT NULL,
  `product_referral_code` varchar(255) DEFAULT NULL,
  `delivery_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `name_bn` varchar(50) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `description_en` text DEFAULT NULL,
  `description_bn` text DEFAULT NULL,
  `position` varchar(255) NOT NULL DEFAULT 'nav',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name_en`, `name_bn`, `title`, `slug`, `description_en`, `description_bn`, `position`, `status`, `created_at`, `updated_at`) VALUES
(5, 'About us', 'আমাদের সম্পর্কে', 'About us', 'about-us', 'Now shopping is easier, faster and always joyous. We help you make the best choice here.  estoreclassic.com  is the biggest online market platform for Dhaka City offering completely hassle-free shopping experience through secure and trusted gateways. We offer you easy and reliable shopping with all your favorite brands, local brand in Dhaka and more. E-storeClassic provides products from all categories such as appliance, clothing, cosmetics, electronics, footwear, jewellery, health & beauty, medicine, repair service, car rent and still counting! Our collection combines the latest in fashion trends as well as the all-time favorites. Our products collections are exclusively selected for you. We have all that you need under one Platform.\r\n\r\nIn consistency with the vision of Digital Bangladesh, E-storeClassic provide service/product to the doorway over the Internet. We constantly update with lot of new products, services and special offers. \r\n\r\n\r\n\r\nE-storeclassic gives you the best market experience possible so you can save your valuable time and money. You can pay using all types of payment gateways. If you want to return a product or service for any reason after receiving it, you will get an easy return system. So let\'s go to the estoreclassic.com .\r\n\r\nestoreclassic.com  is a one of the largest online shop for Grocery, Fashion, Electronics, Health, Beauty & Much More..', 'এখন কেনাকাটা সহজ, দ্রুত এবং সর্বদা আনন্দদায়ক। আমরা আপনাকে এখানে সেরা পছন্দ করতে সাহায্য করি। estoreclassic.com হল ঢাকা শহরের সবচেয়ে বড় অনলাইন মার্কেট প্লাটফর্ম যা নিরাপদ এবং বিশ্বস্ত গেটওয়ের মাধ্যমে সম্পূর্ণ ঝামেলামুক্ত কেনাকাটার অভিজ্ঞতা প্রদান করে। আমরা আপনাকে আপনার সমস্ত প্রিয় ব্র্যান্ড, ঢাকার স্থানীয় ব্র্যান্ড এবং আরও অনেক কিছুর সাথে সহজ এবং নির্ভরযোগ্য কেনাকাটার অফার করি। E-storeClassic সমস্ত বিভাগ থেকে পণ্য সরবরাহ করে যেমন যন্ত্রপাতি, পোশাক, প্রসাধনী, ইলেকট্রনিক্স, পাদুকা, গয়না, স্বাস্থ্য ও সৌন্দর্য, ওষুধ, মেরামত পরিষেবা, গাড়ি ভাড়া এবং এখনও গণনা করা হচ্ছে! আমাদের সংগ্রহে ফ্যাশন ট্রেন্ডের সাথে সাথে সর্বকালের পছন্দের সর্বশেষতমগুলিকে একত্রিত করা হয়েছে৷ আমাদের পণ্য সংগ্রহ একচেটিয়াভাবে আপনার জন্য নির্বাচিত করা হয়. একটি প্ল্যাটফর্মের অধীনে আপনার যা প্রয়োজন তা আমাদের কাছে রয়েছে। ডিজিটাল বাংলাদেশের রূপকল্পের সাথে সামঞ্জস্য রেখে, ইকোহাট ইন্টারনেটের মাধ্যমে দরজায় সেবা/পণ্য সরবরাহ করে। আমরা ক্রমাগত অনেক নতুন পণ্য, পরিষেবা এবং বিশেষ অফার সহ আপডেট করি। E-storeClassic  আপনাকে সম্ভাব্য সেরা বাজার অভিজ্ঞতা দেয় যাতে আপনি আপনার মূল্যবান সময় এবং অর্থ বাঁচাতে পারেন। আপনি সব ধরনের পেমেন্ট গেটওয়ে ব্যবহার করে অর্থ প্রদান করতে পারেন। প্রাপ্তির পর কোনো কারণে কোনো পণ্য বা সেবা ফেরত দিতে চাইলে আপনি একটি সহজ রিটার্ন সিস্টেম পাবেন। তো চলুন estoreclassic.com এ যাই। estoreclassic.com হল মুদি, ফ্যাশন, ইলেকট্রনিক্স, স্বাস্থ্য, সৌন্দর্য এবং আরও অনেক কিছুর জন্য একটি বৃহত্তম অনলাইন শপ।', 'Both', 1, '2022-09-19 06:38:47', '2022-11-06 04:25:11'),
(6, 'Return Policy', 'প্রত্যাবর্তন নীতিমালা', 'Return Policy', 'return-policy', 'Delivery Policy:\r\n \r\nEStoreClassic opens the doorway shop over the Internet. We (eStoreClassic) provide any amount of parched product order at your doorsteps with low delivery charge. We process all deliveries through EStoreClassic delivery service or reputed courier services. We deliver products all over the area as well as the Dhaka City. If there is any modification in delivery charge for a particular item, it is mentioned in product details. Order confirmation and delivery completion are subject to product availability. Delivery time may differ from one item to another. It can differ from standard delivery to beyond that.\r\n\r\n\r\nStandard Delivery: \r\nIf your delivery address is within Dhaka City, products will be delivered by within 1 working day. If it is outside Dhaka, it will take 2-5 business days. If you order after 6 PM, it will be considered as an order of next business day. Our Business Day: Saturday to Thursday except public holidays.\r\n\r\n\r\n\r\nDelivery from out side of Dhaka:\r\nThere are some exceptional product that we provide from outside Dhaka(Vendors from Dhaka or Other area). These Product can take 3 or more days to reach you. However, you will receive your order within the time specified.\r\n\r\nYou can make your purchases on Kafela.com.bd and get delivery from anywhere in the Dhaka City. Delivery charge varies according to customers\' place. In case of paid order, EStoreClassic cannot be held liable if customer does not receive it within 4 weeks.\r\n\r\n\r\n\r\nReplacement Policy:\r\n\r\nWe provide great customer experience each time you shop with your EStoreClassic . If you are not satisfied with your purchase, we ensure â€˜Replacementâ€™. Change of mind is not applicable for replacement of product and Our refunds and replacements do not apply to Flash Sale Product. We will replace your purchased product if the product has any defect by its supplier or if the product is not the same one you ordered. Please check your products in front of delivery man or courier service agents.\r\n\r\n\r\n\r\nAll you need to do is give us a call or drop an email at estoreclassic.com within a period of 6 hours from the time of delivery. However, please return the product with the tags intact and in their original packaging, in an unwashed and undamaged condition. Replacement for products is subject to inspection and checking by moom team. Replacement cannot be possible if the product is burnt, damaged by short circuit, or broken by customer. We give the option of taking back the product from your doorstep at Mymensingh providing our delivery man where you need to pay charge for it. Other wise, you need to send it by courier/yourself to our office address ( House no # 37(3rd floor), Road-8, Sector-12, Uttara). Damages due to neglect, improper usage or application will not be covered under our \'Replacementâ€™.\r\n\r\n\r\n\r\nIn case of product\'s sold out at merchant\'s end, customer can choose any other product from our website or can keep the amount refund to his/her wallet account.\r\n\r\n\r\n\r\nNote: Product Change or warranty of product is depend on policy of Seller/Manufacturer.', 'ডেলিভারি নীতি:  ই-স্টোরক্লাসিক ইন্টারনেটের মাধ্যমে দরজার দোকান খুলেছে। আমরা (ই-স্টোরক্লাসিক) কম ডেলিভারি চার্জ সহ আপনার দোরগোড়ায় যে কোনও পরিমাণ পার্চড পণ্যের অর্ডার সরবরাহ করি। আমরা ই-স্টোরক্লাসিক ডেলিভারি পরিষেবা বা নামী কুরিয়ার পরিষেবার মাধ্যমে সমস্ত ডেলিভারি প্রক্রিয়া করি। আমরা ঢাকা শহরের পাশাপাশি পুরো এলাকায় পণ্য সরবরাহ করি। যদি কোনো নির্দিষ্ট আইটেমের জন্য ডেলিভারি চার্জে কোনো পরিবর্তন থাকে, তবে তা পণ্যের বিবরণে উল্লেখ করা হয়। অর্ডার নিশ্চিতকরণ এবং বিতরণ সমাপ্তি পণ্য প্রাপ্যতা সাপেক্ষে. ডেলিভারি সময় এক আইটেম থেকে অন্য ভিন্ন হতে পারে. এটি স্ট্যান্ডার্ড ডেলিভারি থেকে এর বাইরেও আলাদা হতে পারে। স্ট্যান্ডার্ড ডেলিভারি: আপনার ডেলিভারির ঠিকানা যদি ঢাকা শহরের মধ্যে হয়, পণ্যগুলি 1 কার্যদিবসের মধ্যে ডেলিভারি করা হবে। ঢাকার বাইরে হলে ২-৫ কার্যদিবস লাগবে। আপনি যদি সন্ধ্যা 6 টার পরে অর্ডার করেন তবে এটি পরবর্তী ব্যবসায়িক দিনের অর্ডার হিসাবে বিবেচিত হবে। আমাদের ব্যবসার দিন: সরকারি ছুটির দিন ছাড়া শনিবার থেকে বৃহস্পতিবার। ঢাকার বাইরে থেকে ডেলিভারি: কিছু ব্যতিক্রমী পণ্য রয়েছে যা আমরা ঢাকার বাইরে থেকে সরবরাহ করি (ঢাকা বা অন্যান্য এলাকার বিক্রেতারা)। এই পণ্যগুলি আপনার কাছে পৌঁছাতে 3 বা তার বেশি দিন সময় নিতে পারে। যাইহোক, আপনি নির্দিষ্ট সময়ের মধ্যে আপনার অর্ডার পাবেন। আপনি estoreclassic.com-এ আপনার কেনাকাটা করতে পারেন এবং ঢাকা শহরের যেকোনো স্থান থেকে ডেলিভারি পেতে পারেন। ডেলিভারি চার্জ গ্রাহকদের স্থান অনুযায়ী পরিবর্তিত হয়। পেইড অর্ডারের ক্ষেত্রে, গ্রাহক 4 সপ্তাহের মধ্যে না পেলে ই-স্টোরক্লাসিককে দায়ী করা যাবে না। প্রতিস্থাপন নীতি: আপনি যখনই আপনার ই-স্টোরক্লাসিকের সাথে কেনাকাটা করেন তখন আমরা গ্রাহকদের দুর্দান্ত অভিজ্ঞতা প্রদান করি। আপনি যদি আপনার ক্রয়ের সাথে সন্তুষ্ট না হন তবে আমরা \"প্রতিস্থাপন\" নিশ্চিত করি৷ মন পরিবর্তন পণ্যের প্রতিস্থাপনের জন্য প্রযোজ্য নয় এবং আমাদের ফেরত এবং প্রতিস্থাপন ফ্ল্যাশ বিক্রয় পণ্যের জন্য প্রযোজ্য নয়। যদি পণ্যটির সরবরাহকারীর দ্বারা পণ্যটিতে কোনো ত্রুটি থাকে বা পণ্যটি আপনার অর্ডার করা একই না হয় তবে আমরা আপনার কেনা পণ্যটি প্রতিস্থাপন করব। ডেলিভারি ম্যান বা কুরিয়ার সার্ভিস এজেন্টদের সামনে আপনার পণ্য চেক করুন. আপনাকে যা করতে হবে তা হল ডেলিভারির সময় থেকে 6 ঘন্টার মধ্যে estoreclassic.com-এ আমাদের একটি কল বা একটি ইমেল ড্রপ করুন৷ যাইহোক, অনুগ্রহ করে অক্ষত ট্যাগ সহ পণ্যটি এবং তাদের আসল প্যাকেজিংয়ে, একটি ধোয়া ও ক্ষয়বিহীন অবস্থায় ফেরত দিন। পণ্যের প্রতিস্থাপন মুম টিম দ্বারা পরিদর্শন এবং চেক সাপেক্ষে। পণ্যটি পুড়ে গেলে, শর্ট সার্কিটের কারণে ক্ষতিগ্রস্ত হলে বা গ্রাহকের দ্বারা ভেঙে গেলে প্রতিস্থাপন সম্ভব নয়। আমরা ময়মনসিংহে আমাদের ডেলিভারি ম্যান সরবরাহ করে আপনার দোরগোড়া থেকে পণ্যটি ফেরত নেওয়ার বিকল্প দিই যেখানে আপনাকে এটির জন্য চার্জ দিতে হবে। অন্যথায়, আপনাকে আমাদের অফিসের ঠিকানায় (বাড়ি নং # ৩0(৩য় তলা), রোড-৩/ডি, সেক্টর-৯, উত্তরা) কুরিয়ারের মাধ্যমে পাঠাতে হবে। অবহেলা, অনুপযুক্ত ব্যবহার বা প্রয়োগের কারণে ক্ষতি আমাদের \'প্রতিস্থাপন\'-এর অধীনে কভার করা হবে না। মার্চেন্টের শেষে পণ্য বিক্রি হয়ে গেলে, গ্রাহক আমাদের ওয়েবসাইট থেকে অন্য কোনো পণ্য বেছে নিতে পারেন বা তার ওয়ালেট অ্যাকাউন্টে অর্থ ফেরত রাখতে পারেন। দ্রষ্টব্য: পণ্য পরিবর্তন বা পণ্যের ওয়ারেন্টি বিক্রেতা / প্রস্তুতকারকের নীতির উপর নির্ভর করে।', 'Both', 1, '2022-09-19 06:31:58', '2022-09-19 06:31:58'),
(7, 'Support & Policy', 'সমর্থন এবং নীতি', 'Support & Policy', 'support--policy', 'Now shopping is easier, faster and always joyous. We help you make the best choice here. estoreclassic.com  is the biggest online market platform for Dhaka City offering completely hassle-free shopping experience through secure and trusted gateways. We offer you easy and reliable shopping with all your favorite brands, local brand in Dhaka and more. E-storeClassic provides products from all categories such as appliance, clothing, cosmetics, electronics, footwear, jewellery, health & beauty, medicine, repair service, car rent and still counting! Our collection combines the latest in fashion trends as well as the all-time favorites. Our products collections are exclusively selected for you. We have all that you need under one Platform.\r\n\r\n \r\n\r\nIn consistency with the vision of Digital Bangladesh, E-storeClassic provide service/product to the doorway over the Internet. We constantly update with lot of new products, services and special offers.\r\n\r\n \r\n\r\nWe provide our customers with memorable online shopping experience. We provide on-time delivery of products and quick resolution of any concerns. You can choose whatever you like. We deliver it right at your address across Dhaka City. Our services are at your doorsteps all the time. Select the best products for you or your family with the best online marketing experience every time. You will fell love online marketing with estoreclassic.com.', 'এখন কেনাকাটা সহজ, দ্রুত এবং সর্বদা আনন্দদায়ক। আমরা আপনাকে এখানে সেরা পছন্দ করতে সাহায্য করি। estoreclassic.com হল ঢাকা শহরের সবচেয়ে বড় অনলাইন মার্কেট প্লাটফর্ম যা নিরাপদ এবং বিশ্বস্ত গেটওয়ের মাধ্যমে সম্পূর্ণ ঝামেলামুক্ত কেনাকাটার অভিজ্ঞতা প্রদান করে। আমরা আপনাকে আপনার সমস্ত প্রিয় ব্র্যান্ড, ঢাকার স্থানীয় ব্র্যান্ড এবং আরও অনেক কিছুর সাথে সহজ এবং নির্ভরযোগ্য কেনাকাটার অফার করি। e-storeclassic সমস্ত বিভাগ থেকে পণ্য সরবরাহ করে যেমন যন্ত্রপাতি, পোশাক, প্রসাধনী, ইলেকট্রনিক্স, পাদুকা, গহনা, স্বাস্থ্য ও সৌন্দর্য, ওষুধ, মেরামত পরিষেবা, গাড়ি ভাড়া এবং এখনও গণনা! আমাদের সংগ্রহে ফ্যাশন ট্রেন্ডের সাথে সাথে সর্বকালের পছন্দের সর্বশেষতমগুলিকে একত্রিত করা হয়েছে৷ আমাদের পণ্য সংগ্রহ একচেটিয়াভাবে আপনার জন্য নির্বাচিত করা হয়. একটি প্ল্যাটফর্মের অধীনে আপনার যা প্রয়োজন তা আমাদের কাছে রয়েছে। ডিজিটাল বাংলাদেশের রূপকল্পের সাথে সামঞ্জস্য রেখে, ইকোহাট ইন্টারনেটের মাধ্যমে দরজায় সেবা/পণ্য সরবরাহ করে। আমরা ক্রমাগত অনেক নতুন পণ্য, পরিষেবা এবং বিশেষ অফার সহ আপডেট করি। আমরা আমাদের গ্রাহকদের স্মরণীয় অনলাইন কেনাকাটার অভিজ্ঞতা প্রদান করি। আমরা পণ্যের সময়মতো ডেলিভারি এবং যেকোনো উদ্বেগের দ্রুত সমাধান প্রদান করি। আপনি যা খুশি চয়ন করতে পারেন। আমরা ঢাকা শহরে আপনার ঠিকানায় পৌঁছে দিই। আমাদের সেবা সব সময় আপনার দোরগোড়ায় আছে. প্রতিবার সেরা অনলাইন মার্কেটিং অভিজ্ঞতা সহ আপনার বা আপনার পরিবারের জন্য সেরা পণ্যগুলি নির্বাচন করুন৷ আপনি estoreclassic.com এর সাথে অনলাইন মার্কেটিং প্রেমে পড়বেন', 'Both', 1, '2022-09-19 06:35:44', '2022-09-19 06:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('akterferdous27@gmail.com', '$2y$10$/pgery.tQ2er7OQPrTEgJ.LHCKlCJqUUaL6sS3savFT9M2sukwdvC', '2024-03-14 03:09:43'),
('johirul6320415@gmail.com', '$2y$10$aMnFaggdt4TMS7BHNukGq.zL0ZZYbWS.28cHRe8v1Du6fDrPj2m2y', '2024-03-29 02:37:06'),
('mahim.mohammed14@gmail.com', '$2y$10$5FHZJHcg6omvifwha6xVlO5Q78bvx9E5pgS30KJy3FJPV1a88WMdy', '2024-04-16 11:53:55'),
('expro2024@gmail.com', '$2y$10$etkGooz4.gwB88Xxoyeh5evEa1Svn.Mbliki.LxL1MlZakjlPPgf6', '2024-05-18 00:42:53'),
('stephanie68colemanzzx@outlook.com', '$2y$10$7X0KcF9rk7z.7EYEtqVBzOgH60kTB0QlZudAe5qXmAslZaynNlwZq', '2024-09-26 22:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_carts`
--

CREATE TABLE `pos_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `stock_id` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `sub_sub_category_id` int(11) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `campaing_id` int(11) DEFAULT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_bn` varchar(255) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `unit_weight` varchar(255) DEFAULT NULL,
  `purchase_price` double NOT NULL DEFAULT 0,
  `is_wholesell` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Wholesell, 0=>Not Wholesell',
  `wholesell_price` double NOT NULL DEFAULT 0,
  `wholesell_minimum_qty` int(11) NOT NULL DEFAULT 0,
  `regular_price` double NOT NULL DEFAULT 0,
  `discount_price` double NOT NULL DEFAULT 0,
  `discount_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Flat, 2=>Percentage',
  `reseller_price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `reseller_discount_variant` decimal(8,5) NOT NULL DEFAULT 0.00000,
  `minimum_buy_qty` int(11) NOT NULL DEFAULT 1,
  `stock_qty` int(11) NOT NULL DEFAULT 0,
  `product_thumbnail` varchar(255) DEFAULT NULL,
  `product_video` varchar(255) DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_bn` text DEFAULT NULL,
  `attributes` varchar(255) DEFAULT NULL,
  `is_varient` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Varient, 0=>Not Varient',
  `attribute_values` varchar(255) DEFAULT NULL,
  `variations` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Featured, 0=>Not Featured',
  `is_deals` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Deals, 0=>Not Deals',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `is_approved` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Approved, 0=>Not Approved',
  `is_digital` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Digital, 0=>Not Digital',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `tags`, `vendor_id`, `supplier_id`, `unit_id`, `campaing_id`, `name_en`, `name_bn`, `slug`, `product_code`, `unit_weight`, `purchase_price`, `is_wholesell`, `wholesell_price`, `wholesell_minimum_qty`, `regular_price`, `discount_price`, `discount_type`, `reseller_price`, `reseller_discount_variant`, `minimum_buy_qty`, `stock_qty`, `product_thumbnail`, `product_video`, `description_en`, `description_bn`, `attributes`, `is_varient`, `attribute_values`, `variations`, `is_featured`, `is_deals`, `status`, `is_approved`, `is_digital`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 2, 2, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX 20W Power PD GaN ADAPTER [MC-25]', 'MOXX 20W Power PD GaN ADAPTER [MC-25]', 'MOXX-20W-Power-PD-GaN-ADAPTER-MC-25-Q5Rgy', '82363', NULL, 700, 0, 0, 0, 850, 0, 1, 900.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811164875258020.jpg', NULL, '<ul><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><br></span></li></ul><table class=\"table table-bordered\"><tbody><tr><td><span style=\"font-weight: bolder; color: rgb(34, 34, 34); font-family: &quot;Times New Roman&quot;; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\">MODEL: MC25</span><br></td></tr></tbody></table><ul><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Power: 20w</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Input: 100-240V 50/60HZ 0.6A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Output: 5v-3A, 9v-3A, 12v-2.25A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Output type: type-c</span></li></ul><div><br style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif;\"></div>', '<ul><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><br></span></li></ul><table class=\"table table-bordered\"><tbody><tr><td><span style=\"font-weight: bolder; color: rgb(34, 34, 34); font-family: &quot;Times New Roman&quot;; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\">MODEL: MC25</span><br></td></tr></tbody></table><ul><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Power: 20w</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Input: 100-240V 50/60HZ 0.6A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Output: 5v-3A, 9v-3A, 12v-2.25A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Output type: type-c</span></li></ul><div><br style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif;\"></div>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 04:50:24', '2024-09-27 07:58:06'),
(4, 2, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX AIR 17 EARBUDS | HIFI LOOKING | HD MUSIC SOUND', 'MOXX AIR 17 EARBUDS | HIFI LOOKING | HD MUSIC SOUND', 'MOXX-AIR-17-EARBUDS--HIFI-LOOKING--HD-MUSIC-SOUND-Q0Z4k', '94442', '10', 1450, 0, 0, 0, 1450, 0, 1, 1400.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811165080650453.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Wireless Version : 5.4</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time : 5 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Charging Time : 4 Time (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Dock Battery Capacity : 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time : 200 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range : 10m</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Plug Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 10m&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Audio Decoding Protocol: SBC, AAC</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Wireless Version : 5.4</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time : 5 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Charging Time : 4 Time (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Dock Battery Capacity : 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time : 200 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range : 10m</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Plug Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 10m&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Audio Decoding Protocol: SBC, AAC</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 04:53:40', '2024-09-27 07:53:56'),
(5, 2, 2, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX 20W Power USB & PD GaN Adapter [MC-20]', 'MOXX 20W Power USB & PD GaN Adapter [MC-20]', 'MOXX-20W-Power-USB--PD-GaN-Adapter-MC-20-1JGuX', '89275', NULL, 1400, 0, 0, 0, 1600, 0, 1, 1800.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811165229395730.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Input: 100-240V 50/60Hz 0.6A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">USB-A Output: 5V-3A, 9V-2A, 12V-1.5A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">USB-C Output: 5V-3A, 9V-2.22A, 12V-1.67A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"background-color: var(--ct-card-bg); font-family: &quot;Times New Roman&quot;; font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">USB-A+USB-C Output: 5V-3A</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Input: 100-240V 50/60Hz 0.6A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">USB-A Output: 5V-3A, 9V-2A, 12V-1.5A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">USB-C Output: 5V-3A, 9V-2.22A, 12V-1.67A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"background-color: var(--ct-card-bg); font-family: &quot;Times New Roman&quot;; font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">USB-A+USB-C Output: 5V-3A</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 04:56:02', '2024-09-27 07:51:28'),
(6, 2, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX AIR 16 EARBUDS | PREMIUM LOOKING | SUPER SOUND', 'MOXX AIR 16 EARBUDS | PREMIUM LOOKING | SUPER SOUND', 'MOXX-AIR-16-EARBUDS--PREMIUM-LOOKING--SUPER-SOUND-4jzmH', '87742', NULL, 1350, 0, 0, 0, 1350, 0, 1, 1000.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811165565570241.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: Air-16</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 4.5 [Approx.]&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 5 Hours [Approx.]</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Battery Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Plug Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 10m&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Audio Decoding Protocol: SBC, AAC</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: Air-16</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 4.5 [Approx.]&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 5 Hours [Approx.]</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Battery Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Plug Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 10m&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Audio Decoding Protocol: SBC, AAC</span></li></ul>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 1, '2024-09-25 05:01:22', '2024-09-27 07:49:14'),
(7, 2, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX MPOD PRO ANC | UNIVERSAL ANC ACTIVE | PREMIUM MICROPHONE BUILD', 'MOXX MPOD PRO ANC | UNIVERSAL ANC ACTIVE | PREMIUM MICROPHONE BUILD', 'MOXX-MPOD-PRO-ANC--UNIVERSAL-ANC-ACTIVE--PREMIUM-MICROPHONE-BUILD-TT4A7', '12998', '12', 1900, 0, 0, 0, 1950, 0, 1, 2100.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811165824578168.png', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: Mpod Pro</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version:5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 06 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Charging Time: 05 Times</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Battery Capacity: 300mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Charging Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 12m</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Universal Active Noise Cancellation [ANC] Supported&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Environmental Noise Cancellation [ENC] Active&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Build In Dual HD Microphone Noise Reduction&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Smooth Sound &amp; Super Bass Quality&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Premium Touch Sensor&nbsp;</span></span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: Mpod Pro</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version:5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 06 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Charging Time: 05 Times</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Battery Capacity: 300mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Charging Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 12m</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Universal Active Noise Cancellation [ANC] Supported&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Environmental Noise Cancellation [ENC] Active&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Build In Dual HD Microphone Noise Reduction&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Smooth Sound &amp; Super Bass Quality&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Premium Touch Sensor&nbsp;</span></span></li></ul>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 1, '2024-09-25 05:05:29', '2024-09-27 07:46:56'),
(8, NULL, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX AIR 15 EARBUDS', 'MOXX AIR 15 EARBUDS', 'MOXX-AIR-15-EARBUDS-6Kubk', '23223', '10', 1200, 0, 0, 0, 1400, 0, 1, 1600.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811166215099800.jpg', NULL, '<div class=\"product-short-desc\" style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><p style=\"margin-bottom: 0px; color: rgb(34, 34, 34);\"><span style=\"background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">Model -Maxx Air 15</span></p><p style=\"margin-bottom: 0px; color: rgb(34, 34, 34);\">Wireless Version: 5.4</p><p style=\"margin-bottom: 0px; color: rgb(34, 34, 34);\">Buds music time: 06 hrs</p><p style=\"margin-bottom: 0px; color: rgb(34, 34, 34);\">Standby time: 100 Hours</p><p style=\"color: rgb(34, 34, 34);\">Case battery capacity: 300mAh<br></p></div><form action=\"https://www.moxx.com.bd/cart/store\" method=\"POST\" name=\"formName\" style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><div class=\"row\" style=\"margin-top: calc(-1 * var(--bs-gutter-y)); margin-right: calc(-.5 * var(--bs-gutter-x)); margin-left: calc(-.5 * var(--bs-gutter-x)); --bs-gutter-x: 1.5rem; --bs-gutter-y: 0;\"><div class=\"pro-color\" style=\"margin-top: var(--bs-gutter-y); padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5); width: 628px;\"><div class=\"color_inner\"><p style=\"color: rgb(34, 34, 34);\">Color -</p></div></div></div></form>', '<div class=\"product-short-desc\" style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><p style=\"margin-bottom: 0px; color: rgb(34, 34, 34);\"><span style=\"background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">Model -Maxx Air 15</span></p><p style=\"margin-bottom: 0px; color: rgb(34, 34, 34);\">Wireless Version: 5.4</p><p style=\"margin-bottom: 0px; color: rgb(34, 34, 34);\">Buds music time: 06 hrs</p><p style=\"margin-bottom: 0px; color: rgb(34, 34, 34);\">Standby time: 100 Hours</p><p style=\"color: rgb(34, 34, 34);\">Case battery capacity: 300mAh<br></p></div><form action=\"https://www.moxx.com.bd/cart/store\" method=\"POST\" name=\"formName\" style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><div class=\"row\" style=\"margin-top: calc(-1 * var(--bs-gutter-y)); margin-right: calc(-.5 * var(--bs-gutter-x)); margin-left: calc(-.5 * var(--bs-gutter-x)); --bs-gutter-x: 1.5rem; --bs-gutter-y: 0;\"><div class=\"pro-color\" style=\"margin-top: var(--bs-gutter-y); padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5); width: 628px;\"><div class=\"color_inner\"><p style=\"color: rgb(34, 34, 34);\">Color -</p></div></div></div></form>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 1, '2024-09-25 05:11:42', '2024-09-27 06:12:56'),
(9, 0, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX GAME BUDS EARBUDS | GAMING MODE | SUPER BASS MUSIC', 'MOXX GAME BUDS EARBUDS | GAMING MODE | SUPER BASS MUSIC', 'MOXX-GAME-BUDS-EARBUDS--GAMING-MODE--SUPER-BASS-MUSIC-5roSm', '46411', NULL, 1000, 0, 0, 0, 1700, 0, 1, 2000.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811166389683326.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Model: Game Buds</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version: V5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 05 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 04 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Charging Times: 03 Times</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Battery Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Type:&nbsp; Polymer li-ion battery</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 12M</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Model: Game Buds</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version: V5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 05 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 04 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Charging Times: 03 Times</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Battery Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Type:&nbsp; Polymer li-ion battery</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 12M</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 05:14:28', '2024-09-27 07:44:04'),
(10, 2, 2, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX 30W Power USB & PD GaN Adapter [MC-30]', 'MOXX 30W Power USB & PD GaN Adapter [MC-30]', 'MOXX-30W-Power-USB--PD-GaN-Adapter-MC-30-MEwzz', '62807', NULL, 1200, 0, 0, 0, 1700, 0, 1, 1900.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811166439871491.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"></li><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"><h5 style=\"font-weight: 500; line-height: 1.2; color: var(--bs-heading-color,inherit); font-size: 1.25rem; font-family: Poppins, sans-serif;\"><font face=\"Poppins, Arial, Helvetica, sans-serif\"><span style=\"font-size: 28px; font-family: &quot;Times New Roman&quot;;\">Input: 100-240V 50/60Hz 0.8A</span></font></h5></li><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"><h5 style=\"font-weight: 500; line-height: 1.2; color: var(--bs-heading-color,inherit); font-size: 1.25rem; font-family: Poppins, sans-serif;\"><font face=\"Poppins, Arial, Helvetica, sans-serif\"><span style=\"font-size: 28px; font-family: &quot;Times New Roman&quot;;\">USB-A Output: 5V-3A, 9V-3A, 12V-2.25A</span></font><font face=\"Poppins, Arial, Helvetica, sans-serif\"><span style=\"font-size: 28px; font-family: &quot;Times New Roman&quot;;\">USB-C Output: 5V-3A, 9V-3A, 15V-2A, 20V-1.5A</span></font><font face=\"Poppins, Arial, Helvetica, sans-serif\"><span style=\"font-size: 28px; font-family: &quot;Times New Roman&quot;;\">USB-A+USB-C Output: 5V-3A</span></font></h5></li><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"><br></li><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"><br></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"></li><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"><h5 style=\"font-weight: 500; line-height: 1.2; color: var(--bs-heading-color,inherit); font-size: 1.25rem; font-family: Poppins, sans-serif;\"><font face=\"Poppins, Arial, Helvetica, sans-serif\"><span style=\"font-size: 28px; font-family: &quot;Times New Roman&quot;;\">Input: 100-240V 50/60Hz 0.8A</span></font></h5></li><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"><h5 style=\"font-weight: 500; line-height: 1.2; color: var(--bs-heading-color,inherit); font-size: 1.25rem; font-family: Poppins, sans-serif;\"><font face=\"Poppins, Arial, Helvetica, sans-serif\"><span style=\"font-size: 28px; font-family: &quot;Times New Roman&quot;;\">USB-A Output: 5V-3A, 9V-3A, 12V-2.25A</span></font><font face=\"Poppins, Arial, Helvetica, sans-serif\"><span style=\"font-size: 28px; font-family: &quot;Times New Roman&quot;;\">USB-C Output: 5V-3A, 9V-3A, 15V-2A, 20V-1.5A</span></font><font face=\"Poppins, Arial, Helvetica, sans-serif\"><span style=\"font-size: 28px; font-family: &quot;Times New Roman&quot;;\">USB-A+USB-C Output: 5V-3A</span></font></h5></li><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"><br></li><li style=\"display: var(--page-title-display); list-style: inside square; font-size: 16px; line-height: 1.2; overflow-wrap: break-word; --page-title-display: block;\"><br></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 05:15:16', '2024-09-27 07:41:21'),
(11, 2, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX FIREBUDS | ACTIVE ENC | HD CALLING SYSTEM', 'MOXX FIREBUDS | ACTIVE ENC | HD CALLING SYSTEM', 'MOXX-FIREBUDS--ACTIVE-ENC--HD-CALLING-SYSTEM-VKcw3', '75942', '12', 1000, 0, 0, 0, 1720, 0, 1, 2000.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811166542257351.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: Firebuds</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version: 5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 05 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 04 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Charging Time: 04 Times (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Battery Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Charging Time: 45 min (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 12m</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: Firebuds</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version: 5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 05 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 04 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Buds Charging Time: 04 Times (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Battery Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Case Charging Time: 45 min (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operation Range: 12m</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 05:16:54', '2024-09-27 07:37:44'),
(12, 0, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX MPOD ANC & ENC TWS Wireless Earbuds', 'MOXX MPOD ANC & ENC TWS Wireless Earbuds', 'MOXX-MPOD-ANC--ENC-TWS-Wireless-Earbuds-fv02m', '31002', '12', 1200, 0, 0, 0, 1750, 0, 1, 2000.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811166735948755.jpg', NULL, '<p style=\"margin-bottom: 0px; color: rgb(34, 34, 34); font-family: Jost, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MPOD ANC-3</span></span></p><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Wireless Version: v5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 06 hours (Approx..)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 3.5 hours (Approx..)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Charging Time: 05 Times (Approx..)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Case battery capacity: 300mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Standby time: 100 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Audio Decoding Protocol: SBC,AAC</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Operating Range: 10 Miters</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Frequency Response: 20-20KHz NC:&lt;-25db</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Charging Plug Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Active Noise Cancellation&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Environmental Noise Cancellation (ENC)</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Touch sensor function</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Dual Microphone Noise Reduction</span></span></li></ul>', '<p style=\"margin-bottom: 0px; color: rgb(34, 34, 34); font-family: Jost, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MPOD ANC-3</span></span></p><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Wireless Version: v5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 06 hours (Approx..)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 3.5 hours (Approx..)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Charging Time: 05 Times (Approx..)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Case battery capacity: 300mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Standby time: 100 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Audio Decoding Protocol: SBC,AAC</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Operating Range: 10 Miters</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Frequency Response: 20-20KHz NC:&lt;-25db</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Charging Plug Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Active Noise Cancellation&nbsp;</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Environmental Noise Cancellation (ENC)</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Touch sensor function</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Dual Microphone Noise Reduction</span></span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 05:19:58', '2024-09-27 07:35:09'),
(13, 2, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX MPOD ENC TWS Wireless Earbuds', 'MOXX MPOD ENC TWS Wireless Earbuds', 'MOXX-MPOD-ENC-TWS-Wireless-Earbuds-1Hu2S', '15256', NULL, 1500, 0, 0, 0, 1750, 0, 1, 2100.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811166892778387.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MPOD ENC</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Wireless Version: V5.3+EDR</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 05 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 2.5 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Charging Dock Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Charging Time: 05 Times (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Power Source: Rechargeable Li-ion Battery</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Operation Range: 12 Miters</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Support Profile: HSP1.2/HFP1.6/A2DP1.3/AVRCP1.60</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">HD Microphone Build</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Environmental Noise Cancellation (ENC) Active</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MPOD ENC</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Wireless Version: V5.3+EDR</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Music Time: 05 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: 2.5 Hours (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Charging Dock Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Charging Time: 05 Times (Approx.)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Power Source: Rechargeable Li-ion Battery</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Operation Range: 12 Miters</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Support Profile: HSP1.2/HFP1.6/A2DP1.3/AVRCP1.60</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">HD Microphone Build</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Environmental Noise Cancellation (ENC) Active</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 05:22:28', '2024-09-27 07:30:38'),
(14, 2, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX Wireless TWS LED Display Earbuds', 'MOXX Wireless TWS LED Display Earbuds', 'MOXX-Wireless-TWS-LED-Display-Earbuds-HPeLc', '88077', NULL, 900, 0, 0, 0, 1100, 0, 1, 1400.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811167862107895.jpg', NULL, '<p style=\"margin-bottom: 0px; color: rgb(34, 34, 34); font-family: Jost, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MA-Pro3S</span></span></p><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Wireless Version: V5.2</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;; background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">Buds Music Play Time: Up to 5 hours [approx.]</span></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Buds Talk Time: 3.5 hours [approx.]</font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Buds Charging Times: up to 3 times.</font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Charging Case Battery Capacity: 360mAh.</font><span style=\"font-family: &quot;Times New Roman&quot;; background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Power Source: Build in Rechargeable Li-ion Battery.</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;; background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">Main functions:○Play/pause ○previous track ○next track ○LED display.</span></li></ul>', '<p style=\"margin-bottom: 0px; color: rgb(34, 34, 34); font-family: Jost, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MA-Pro3S</span></span></p><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Wireless Version: V5.2</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;; background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">Buds Music Play Time: Up to 5 hours [approx.]</span></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Buds Talk Time: 3.5 hours [approx.]</font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Buds Charging Times: up to 3 times.</font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Charging Case Battery Capacity: 360mAh.</font><span style=\"font-family: &quot;Times New Roman&quot;; background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Power Source: Build in Rechargeable Li-ion Battery.</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;; background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align);\">Main functions:○Play/pause ○previous track ○next track ○LED display.</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 05:37:52', '2024-09-27 07:28:18');
INSERT INTO `products` (`id`, `brand_id`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `tags`, `vendor_id`, `supplier_id`, `unit_id`, `campaing_id`, `name_en`, `name_bn`, `slug`, `product_code`, `unit_weight`, `purchase_price`, `is_wholesell`, `wholesell_price`, `wholesell_minimum_qty`, `regular_price`, `discount_price`, `discount_type`, `reseller_price`, `reseller_discount_variant`, `minimum_buy_qty`, `stock_qty`, `product_thumbnail`, `product_video`, `description_en`, `description_bn`, `attributes`, `is_varient`, `attribute_values`, `variations`, `is_featured`, `is_deals`, `status`, `is_approved`, `is_digital`, `created_by`, `created_at`, `updated_at`) VALUES
(15, 0, 3, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX Wireless TWS Headset', 'MOXX Wireless TWS Headset', 'MOXX-Wireless-TWS-Headset-SGgEg', '83085', NULL, 900, 0, 0, 0, 1050, 0, 1, 1500.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811168102925128.jpg', NULL, '<p style=\"margin-bottom: 0px; color: rgb(34, 34, 34); font-family: Jost, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MA-Pro2</span></span></p><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Wireless Version: V5.2</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Music Play Time : up to 4 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: up to 2.5 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Standby Time: up to 24 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Charging Case Battery: 360mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Case Charging Ti</span>me: 1.5 Hours</li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Power Source: Build in Rechargeable Li-ion Battery</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align); font-family: &quot;Times New Roman&quot;;\">Main functions:&nbsp;</span><span style=\"font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align); background-color: var(--ct-card-bg); font-family: &quot;Times New Roman&quot;;\">○Play/pause ○Previous track ○Next track</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align); background-color: var(--ct-card-bg); font-family: &quot;Times New Roman&quot;;\">Auto Pairing<br></span></li></ul>', '<p style=\"margin-bottom: 0px; color: rgb(34, 34, 34); font-family: Jost, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MA-Pro2</span></span></p><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Wireless Version: V5.2</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Music Play Time : up to 4 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Talk Time: up to 2.5 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Buds Standby Time: up to 24 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Charging Case Battery: 360mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Case Charging Ti</span>me: 1.5 Hours</li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Power Source: Build in Rechargeable Li-ion Battery</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"background-color: var(--ct-card-bg); font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align); font-family: &quot;Times New Roman&quot;;\">Main functions:&nbsp;</span><span style=\"font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align); background-color: var(--ct-card-bg); font-family: &quot;Times New Roman&quot;;\">○Play/pause ○Previous track ○Next track</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: var(--ct-body-font-size); font-weight: var(--ct-body-font-weight); text-align: var(--ct-body-text-align); background-color: var(--ct-card-bg); font-family: &quot;Times New Roman&quot;;\">Auto Pairing<br></span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 05:41:42', '2024-09-27 07:26:22'),
(16, 2, 6, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX WIRELESS NECKBAND | VOICE CHANGER | HD CALL', 'MOXX WIRELESS NECKBAND | VOICE CHANGER | HD CALL', 'MOXX-WIRELESS-NECKBAND--VOICE-CHANGER--HD-CALL-LGdZH', '47214', NULL, 800, 0, 0, 0, 1050, 0, 1, 1200.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811171135594115.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: BN-400</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version: 5.3</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Cell Voltage: 3.7v</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Call Time: 18 Hours&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music Time: 20 Hours&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time: 200 Hours&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Impedance: 32Ω</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Sensitivity: 101±3dB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Active 5 Voice Changer&nbsp;</span></span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: BN-400</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version: 5.3</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity: 200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Cell Voltage: 3.7v</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Call Time: 18 Hours&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music Time: 20 Hours&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time: 200 Hours&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Impedance: 32Ω</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Sensitivity: 101±3dB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Active 5 Voice Changer&nbsp;</span></span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:29:54', '2024-09-27 07:23:56'),
(17, 2, 6, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX PREMIUM WIRELESS NECKBAND | SUPER BASS | 40 HOURS MUSIC TIME', 'MOXX PREMIUM WIRELESS NECKBAND | SUPER BASS | 40 HOURS MUSIC TIME', 'MOXX-PREMIUM-WIRELESS-NECKBAND--SUPER-BASS--40-HOURS-MUSIC-TIME-8CwRL', '17582', NULL, 900, 0, 0, 0, 1100, 0, 1, 1200.00, 5.00000, 1, 5, 'upload/products/thumbnails/1811171336430003.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\"><span style=\"font-weight: bolder;\">Model: BN-310</span></span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Wireless Version: 5.3</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Battery Capacity: 250mAh</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Cell Voltage: 3.7v</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Call Time: 25 Hours&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Music Time: 30 Hours&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Standby Time: 200 Hours&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Impedance: 32Ω</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Sensitivity: 101±3dB</span></font></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\"><span style=\"font-weight: bolder;\">Model: BN-310</span></span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Wireless Version: 5.3</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Battery Capacity: 250mAh</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Cell Voltage: 3.7v</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Call Time: 25 Hours&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Music Time: 30 Hours&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Standby Time: 200 Hours&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Impedance: 32Ω</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Sensitivity: 101±3dB</span></font></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:33:06', '2024-09-27 07:21:43'),
(18, 2, 6, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX WIRELESS NECKBAND HEADPHONE | TWO CHANNEL POWERFUL STEREO SOUND | 40 HOURS MUSIC TIME', 'MOXX WIRELESS NECKBAND HEADPHONE | TWO CHANNEL POWERFUL STEREO SOUND | 40 HOURS MUSIC TIME', 'MOXX-WIRELESS-NECKBAND-HEADPHONE--TWO-CHANNEL-POWERFUL-STEREO-SOUND--40-HOURS-MUSIC-TIME-CKg4F', '43904', NULL, 500, 0, 0, 0, 850, 0, 1, 1000.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811171432189162.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: BN50</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Wireless Version: 5.3</font></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music Time: 25 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Talk Time: 30 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time: 10 Days</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity: 250mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Active ENC Noise Cancellation</span></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Incoming Vibrates</font></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: BN50</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Wireless Version: 5.3</font></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music Time: 25 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Talk Time: 30 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time: 10 Days</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity: 250mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Active ENC Noise Cancellation</span></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\">Incoming Vibrates</font></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:34:37', '2024-09-27 07:17:26'),
(19, 2, 6, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX Wireless ENC Premium Neckband [BN300] | Super Touching Control | Environmental Noise Cancellation [ENC] Active', 'MOXX Wireless ENC Premium Neckband [BN300] | Super Touching Control | Environmental Noise Cancellation [ENC] Active', 'MOXX-Wireless-ENC-Premium-Neckband-BN300--Super-Touching-Control--Environmental-Noise-Cancellation-ENC-Active-3MQOe', '75483', NULL, 1100, 0, 0, 0, 1550, 0, 1, 1700.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811171523817379.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version:5.2</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music Time: 22 HOurs</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Talking Time: 18 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging Time:1.5 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity:210mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time: 200 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency Response: 20Hz-20kHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Transmission Distance: ≥12Meters</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Environmental Noise Cancellation [ENC]</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Magnetic Control</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Super Bass &amp; Smtooh Sound&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Biuld in HD Microphone&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">HD Calling Feature&nbsp;</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version:5.2</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music Time: 22 HOurs</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Talking Time: 18 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging Time:1.5 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity:210mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time: 200 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency Response: 20Hz-20kHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Transmission Distance: ≥12Meters</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Environmental Noise Cancellation [ENC]</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Magnetic Control</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Super Bass &amp; Smtooh Sound&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Biuld in HD Microphone&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">HD Calling Feature&nbsp;</span></li></ul>', '[]', 0, '[]', NULL, 1, 0, 1, 1, 0, 1, '2024-09-25 06:36:04', '2024-09-27 07:14:18'),
(20, 2, 6, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX Wireless BT Neckband [BN100] | 35 Hours Music Time | 200 Hours Standby Time', 'MOXX Wireless BT Neckband [BN100] | 35 Hours Music Time | 200 Hours Standby Time', 'MOXX-Wireless-BT-Neckband-BN100--35-Hours-Music-Time--200-Hours-Standby-Time-wUuRk', '71761', NULL, 600, 0, 0, 0, 900, 0, 1, 1100.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811171608945042.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><br></span></li></ul><table class=\"table table-bordered\"><tbody><tr><td><span style=\"color: rgb(34, 34, 34); font-family: &quot;Arial Black&quot;; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\">Model: BN100</span><br></td></tr></tbody></table><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version:5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music Time:35 HOurs</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Talking Time:30 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging Time:1.5 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity:200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time: 200 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency Response: 20Hz-20kHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Transmission Distance: ≥10Meters</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Biuld in HD Microphone&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Calling Feature&nbsp;</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><br></span></li></ul><table class=\"table table-bordered\"><tbody><tr><td><span style=\"color: rgb(34, 34, 34); font-family: &quot;Arial Black&quot;; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\">Model: BN100</span><br></td></tr></tbody></table><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Wireless Version:5.4</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music Time:35 HOurs</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Talking Time:30 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging Time:1.5 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging Type: Type-C</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity:200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Standby Time: 200 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency Response: 20Hz-20kHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Transmission Distance: ≥10Meters</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Biuld in HD Microphone&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Calling Feature&nbsp;</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:37:26', '2024-09-27 07:13:31'),
(21, 2, 6, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX Metal Wireless BT Neckband [MN200] | 35 Hours Music Time | Music-Rock-Gaming Mode', 'MOXX Metal Wireless BT Neckband [MN200] | 35 Hours Music Time | Music-Rock-Gaming Mode', 'MOXX-Metal-Wireless-BT-Neckband-MN200--35-Hours-Music-Time--Music-Rock-Gaming-Mode-jG4fG', '77990', NULL, 900, 0, 0, 0, 1250, 0, 1, 1400.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811171687880568.jpg', NULL, '<ol style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\"><br></span></font></li></ol><table class=\"table table-bordered\"><tbody><tr><td><span style=\"font-weight: bolder; color: rgb(33, 37, 41); font-family: &quot;Times New Roman&quot;; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\">Model: MN200</span><br></td><td><br></td></tr></tbody></table><ol style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Wireless Version:5.3</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Talking Time:30 Hours</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Music Time:35 Hours</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Charging Time:1.5 Hours</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Charging Type: Type-C</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Battery Capacity:200mAh</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Standby Time:300 Hours</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Mode: Normal, Music, Rock, Gaming</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Transmission Distance: ≥10Meters</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Build in HD Microphone&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">HD Calling Feature&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Metal &amp; Magnet</span></font></li></ol>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\"><br></span></font></li></ul><table class=\"table table-bordered\"><tbody><tr><td><span style=\"font-weight: bolder; color: rgb(33, 37, 41); font-family: &quot;Times New Roman&quot;; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;\">Model: MN200</span><br></td></tr></tbody></table><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Wireless Version:5.3</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Talking Time:30 Hours</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Music Time:35 Hours</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Charging Time:1.5 Hours</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Charging Type: Type-C</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Battery Capacity:200mAh</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Standby Time:300 Hours</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Mode: Normal, Music, Rock, Gaming</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Transmission Distance: ≥10Meters</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Build in HD Microphone&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">HD Calling Feature&nbsp;</span></font></li><li style=\"list-style: inside square; font-size: 16px;\"><font face=\"Times New Roman\"><span style=\"font-size: 14px;\">Metal &amp; Magnet</span></font></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:38:41', '2024-09-27 07:10:42'),
(22, 2, 4, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX 22.5W 20000mAh POWERBANK | LED DISPLAY', 'MOXX 22.5W 20000mAh POWERBANK | LED DISPLAY', 'MOXX-225W-20000mAh-POWERBANK--LED-DISPLAY-iDvJi', '74372', NULL, 1900, 0, 0, 0, 2300, 0, 1, 2500.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811171910945216.jpg', NULL, NULL, NULL, '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:42:14', '2024-09-27 06:57:59'),
(23, 2, 4, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX 10000mAh 22.5w POWERBANK | BUILD TYPE-C & LIGHTNING | FAST CHARGING', 'MOXX 10000mAh 22.5w POWERBANK | BUILD TYPE-C & LIGHTNING | FAST CHARGING', 'MOXX-10000mAh-225w-POWERBANK--BUILD-TYPE-C--LIGHTNING--FAST-CHARGING-iJzD3', '35548', NULL, 1500, 0, 0, 0, 1950, 0, 1, 2100.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811171981988707.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Capacity: 10000mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Type: Polymer Battery&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5v-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Output: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Input: DC9V-2A, 5</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Output: DC4.5V-5A, 9V-2A, 12V-1.5A(MAXX22.5W)</span></li></ul><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Direct Baoding | QC 3.0 | 10000mAh</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Capacity: 10000mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Type: Polymer Battery&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5v-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Output: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Input: DC9V-2A, 5</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Output: DC4.5V-5A, 9V-2A, 12V-1.5A(MAXX22.5W)</span></li></ul><ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Direct Baoding | QC 3.0 | 10000mAh</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:43:21', '2024-09-27 06:52:06'),
(24, 2, 4, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX 20000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 'MOXX 20000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 'MOXX-20000-mAh-225W-POWERBANK--SUPER-FAST-CHARGING--LED-DISPLAY-mYLtE', '46340', NULL, 2000, 0, 0, 0, 2200, 0, 1, 2300.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811172055968754.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MP-20</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Power: 22.5w</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Capacity: 20000 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Rated Capacity: 14000 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Output: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Input: DC9V-2A 5V-3A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Output: DC4.5V-2A, 9V-2A, 12V-1.5A(22.5w)</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MP-20</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Power: 22.5w</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Capacity: 20000 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Rated Capacity: 14000 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Output: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Input: DC9V-2A 5V-3A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Output: DC4.5V-2A, 9V-2A, 12V-1.5A(22.5w)</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:44:32', '2024-09-27 06:49:24'),
(25, 2, 4, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX 10000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 'MOXX 10000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 'MOXX-10000-mAh-225W-POWERBANK--SUPER-FAST-CHARGING--LED-DISPLAY-zdy8b', '35837', NULL, 1500, 0, 0, 0, 1700, 0, 1, 1900.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811172143399699.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MP-19</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Power: 22.5w</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Capacity: 10000 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Rated Capacity: 6500 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Output: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Input: DC9V-2A 5V-3A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Output: DC4.5V-2A, 9V-2A, 12V-1.5A(22.5w)</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MP-19</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Power: 22.5w</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Capacity: 10000 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Rated Capacity: 6500 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Output: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Input: DC9V-2A 5V-3A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Output: DC4.5V-2A, 9V-2A, 12V-1.5A(22.5w)</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:45:55', '2024-09-27 06:43:27');
INSERT INTO `products` (`id`, `brand_id`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `tags`, `vendor_id`, `supplier_id`, `unit_id`, `campaing_id`, `name_en`, `name_bn`, `slug`, `product_code`, `unit_weight`, `purchase_price`, `is_wholesell`, `wholesell_price`, `wholesell_minimum_qty`, `regular_price`, `discount_price`, `discount_type`, `reseller_price`, `reseller_discount_variant`, `minimum_buy_qty`, `stock_qty`, `product_thumbnail`, `product_video`, `description_en`, `description_bn`, `attributes`, `is_varient`, `attribute_values`, `variations`, `is_featured`, `is_deals`, `status`, `is_approved`, `is_digital`, `created_by`, `created_at`, `updated_at`) VALUES
(26, 2, 4, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX 10000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 'MOXX 10000 mAh 22.5W POWERBANK | SUPER FAST CHARGING | LED DISPLAY', 'MOXX-10000-mAh-225W-POWERBANK--SUPER-FAST-CHARGING--LED-DISPLAY-OznQI', '17848', NULL, 1500, 0, 0, 0, 1750, 0, 1, 1900.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811172229276342.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MP-10</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Power: 22.5w</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Capacity: 10000 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Rated Capacity: 6500 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Output: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Input: DC9V-2A 5V-3A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Output: DC4.5V-2A, 9V-2A, 12V-1.5A(22.5w)</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MP-10</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Power: 22.5w</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Capacity: 10000 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Rated Capacity: 6500 mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Output: DC5V-2A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Input: DC9V-2A 5V-3A</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Fast Output: DC4.5V-2A, 9V-2A, 12V-1.5A(22.5w)</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:47:17', '2024-09-27 06:35:25'),
(27, 2, 7, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX WIRELESS MICROPHONE | DUALMICROPHONE | 100% NOISE CANCELLATION', 'MOXX WIRELESS MICROPHONE | DUALMICROPHONE | 100% NOISE CANCELLATION', 'MOXX-WIRELESS-MICROPHONE--DUALMICROPHONE--100-NOISE-CANCELLATION-PEUQq', '66590', NULL, 1300, 0, 0, 0, 1600, 0, 1, 1800.00, 5.00000, 1, 8, 'upload/products/thumbnails/1811172389358363.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: K35</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Microphone Type: Double Microphone</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Function: Noise Canceling, Lightweight</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Usage: Sound equipment, Camera, Speakers, Camera, Cell phone, PC, Laptop</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Communication: Wireless</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Receiver: auxiliary 3.5mm</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency: 2.4GHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Life: 6 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Max SPL: 110db</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Sensitivity: -42dB±2dB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging port: TYPE-C</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: K35</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Microphone Type: Double Microphone</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Function: Noise Canceling, Lightweight</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Usage: Sound equipment, Camera, Speakers, Camera, Cell phone, PC, Laptop</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Communication: Wireless</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Receiver: auxiliary 3.5mm</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency: 2.4GHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Life: 6 Hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Max SPL: 110db</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Sensitivity: -42dB±2dB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging port: TYPE-C</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:49:50', '2024-09-27 06:32:28'),
(28, 2, 7, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX WIRELESS MICROPHONE', 'MOXX WIRELESS MICROPHONE', 'MOXX-WIRELESS-MICROPHONE-t1t1j', '87760', NULL, 2000, 0, 0, 0, 2600, 0, 1, 2700.00, 5.00000, 1, 0, 'upload/products/thumbnails/1811172434176385.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operating frequency: 2.4GHz&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">sensitivity: 26DB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Transmission delay: 15ms&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency response range: 20-20KHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Signal-to-noise ratio: 64DBM&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Transmission distance: 20 meters (accessible)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery capacity: 200mAh&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging time: About 1.5 hours.</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Working time: 11 hours&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging voltage: DC5V</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operating voltage: 3.7V&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Automatic paring upon startup</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operating frequency: 2.4GHz&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">sensitivity: 26DB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Transmission delay: 15ms&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency response range: 20-20KHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Signal-to-noise ratio: 64DBM&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Transmission distance: 20 meters (accessible)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery capacity: 200mAh&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging time: About 1.5 hours.</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Working time: 11 hours&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging voltage: DC5V</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Operating voltage: 3.7V&nbsp;</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Automatic paring upon startup</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:50:33', '2024-09-27 06:31:39'),
(29, 2, 8, NULL, NULL, '', 3, 0, 0, NULL, 'MOXX RGB Portable Wireless Speaker | RGB Light | Waterproof (IPX6)', 'MOXX RGB Portable Wireless Speaker | RGB Light | Waterproof (IPX6)', 'MOXX-RGB-Portable-Wireless-Speaker--RGB-Light--Waterproof-IPX6-3nItd', '64004', NULL, 1200, 0, 0, 0, 1550, 0, 1, 1700.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811172606213143.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MS-60</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity:500mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Playtime: 4 Hours (approximately)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">output power: 5W</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5V</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency response: 85Hz-20kHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging time: 2 Hours (approximately)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Playback modes: TF Card/U disk/Bluetooth</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Sensitivity: 400mV</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music format: MP3/WMA</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Net Weight: 315g</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model: MS-60</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery Capacity:500mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Playtime: 4 Hours (approximately)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">output power: 5W</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input: DC5V</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency response: 85Hz-20kHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging time: 2 Hours (approximately)</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Playback modes: TF Card/U disk/Bluetooth</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Sensitivity: 400mV</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Music format: MP3/WMA</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Net Weight: 315g</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:53:17', '2024-09-27 06:26:24'),
(30, 2, 8, NULL, NULL, '', 0, 0, 0, NULL, 'MOXX RGB Wireless Speaker | RGB Light | BT Speaker', 'MOXX RGB Wireless Speaker | RGB Light | BT Speaker', 'MOXX-RGB-Wireless-Speaker--RGB-Light--BT-Speaker-Z9FBm', '53943', '6', 1200, 0, 0, 0, 1400, 0, 1, 1500.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811172659705760.jpg', NULL, '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model:MS-50</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">BT Version: V5.3</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency response: 85Hz-20KHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input Sensitivity: 400mV</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Separation degree: ≥ 90dB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Signal to noise ratio: ≥ 80dB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging: DC 5V 500mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery: 1200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging time: 2.5 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Playback time: 2-5 hours</span></li></ul>', '<ul style=\"color: rgb(33, 37, 41); font-family: Jost, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\"><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\"><span style=\"font-weight: bolder;\">Model:MS-50</span></span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">BT Version: V5.3</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Frequency response: 85Hz-20KHz</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Input Sensitivity: 400mV</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Separation degree: ≥ 90dB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Signal to noise ratio: ≥ 80dB</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging: DC 5V 500mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Battery: 1200mAh</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Charging time: 2.5 hours</span></li><li style=\"list-style: inside square; font-size: 16px;\"><span style=\"font-size: 14px; font-family: &quot;Times New Roman&quot;;\">Playback time: 2-5 hours</span></li></ul>', '[]', 0, '[]', NULL, 1, 1, 1, 1, 0, 1, '2024-09-25 06:54:08', '2024-09-27 06:23:10'),
(32, 0, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-hHS24', '48538', NULL, 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811327740584095.png', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-26 23:59:04', '2024-09-28 03:28:26'),
(33, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-etlag', '73241', '1', 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811328268188027.png', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-27 00:07:28', '2024-09-28 03:26:29'),
(34, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-Dj8eT', '21901', NULL, 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811329298426453.png', NULL, NULL, NULL, '[]', 0, '[]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-27 00:23:50', '2024-09-27 01:01:14'),
(36, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-ezoLH', '30626', NULL, 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811330220006367.png', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-27 00:38:29', '2024-09-28 03:23:57'),
(37, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-y8Qpv', '92433', NULL, 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811330480621767.png', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 0, 1, 1, 0, 1, '2024-09-27 00:42:37', '2024-09-28 03:22:01'),
(38, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-RNRY6', '81538', NULL, 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811330617435783.png', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-27 00:44:48', '2024-09-28 03:20:18'),
(39, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-RoZWi', '80068', NULL, 270, 0, 420, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811330771370846.png', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-27 00:47:15', '2024-09-28 03:18:37'),
(40, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-lrNI5', '18108', NULL, 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811331176141352.png', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-27 00:53:41', '2024-09-28 03:17:12'),
(41, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-plWYv', '44064', NULL, 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811331381528815.png', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-27 00:56:57', '2024-09-28 02:59:58'),
(42, 5, 11, NULL, NULL, '', 3, 0, 0, NULL, 'T-shirt', 't-shirt', 'T-shirt-kdWIb', '37028', NULL, 270, 0, 300, 1, 520, 30, 2, 420.00, 5.00000, 1, 10, 'upload/products/thumbnails/1811331553962798.png', NULL, NULL, '<p>TYR5R</p>', '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-27 00:59:41', '2024-09-28 03:14:19'),
(48, 0, 13, NULL, NULL, '', 3, 0, 0, NULL, 'Drop shoulder T-shirt', 'Drop shoulder T-shirt', 'Drop-shoulder-T-shirt-Utyee', '89468', NULL, 330, 0, 0, 0, 650, 30, 2, 370.00, 5.00000, 1, 9, 'upload/products/thumbnails/1811432457759181.jpg', NULL, NULL, NULL, '[\"2\",\"1\"]', 1, '[{\"attribute_id\":\"2\",\"values\":[\"Black\"]},{\"attribute_id\":\"1\",\"values\":[\"L\",\"M\",\"XL\",\"XXL\"]}]', NULL, 1, 1, 1, 1, 1, 1, '2024-09-28 03:43:30', '2024-09-30 04:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `varient` varchar(50) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `price` double(20,2) NOT NULL DEFAULT 0.00,
  `qty` mediumint(9) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `product_id`, `varient`, `sku`, `price`, `qty`, `image`, `created_at`, `updated_at`) VALUES
(14, 41, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811429718183683.png', '2024-09-28 02:59:58', '2024-09-28 02:59:58'),
(15, 41, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811429718242912.png', '2024-09-28 02:59:58', '2024-09-28 02:59:58'),
(16, 41, 'Black-XL', 'sku-Black-XL', 520.00, 9, 'upload/products/variations/1811429718303645.png', '2024-09-28 02:59:58', '2024-09-30 04:01:47'),
(27, 42, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811430621633634.png', '2024-09-28 03:14:19', '2024-09-28 03:14:19'),
(28, 42, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811430621691656.png', '2024-09-28 03:14:19', '2024-09-28 03:14:19'),
(29, 42, 'Black-XL', 'sku-Black-XL', 520.00, 10, 'upload/products/variations/1811430621746858.png', '2024-09-28 03:14:19', '2024-09-28 03:14:20'),
(30, 42, 'Black-XXL', 'sku-Black-XXL', 520.00, 10, 'upload/products/variations/1811430621852333.png', '2024-09-28 03:14:20', '2024-09-28 03:14:20'),
(31, 40, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811430802599929.png', '2024-09-28 03:17:12', '2024-09-28 03:17:12'),
(32, 40, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811430802661730.png', '2024-09-28 03:17:12', '2024-09-28 03:17:12'),
(33, 40, 'Black-XL', 'sku-Black-XL', 520.00, 10, 'upload/products/variations/1811430802726141.png', '2024-09-28 03:17:12', '2024-09-28 03:17:12'),
(34, 40, 'Black-XXL', 'sku-Black-XXL', 520.00, 10, 'upload/products/variations/1811430802784734.png', '2024-09-28 03:17:12', '2024-09-28 03:17:12'),
(35, 39, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811430891670653.png', '2024-09-28 03:18:37', '2024-09-28 03:18:37'),
(36, 39, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811430891738141.png', '2024-09-28 03:18:37', '2024-09-28 03:18:37'),
(37, 39, 'Black-XL', 'sku-Black-XL', 520.00, 10, 'upload/products/variations/1811430891793481.png', '2024-09-28 03:18:37', '2024-09-28 03:18:37'),
(38, 39, 'Black-XXL', 'sku-Black-XXL', 520.00, 10, 'upload/products/variations/1811430891859582.png', '2024-09-28 03:18:37', '2024-09-28 03:18:37'),
(39, 38, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811430997434738.png', '2024-09-28 03:20:18', '2024-09-28 03:20:18'),
(40, 38, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811430997493139.png', '2024-09-28 03:20:18', '2024-09-28 03:20:18'),
(41, 38, 'Black-XL', 'sku-Black-XL', 520.00, 10, 'upload/products/variations/1811430997557704.png', '2024-09-28 03:20:18', '2024-09-28 03:20:18'),
(42, 38, 'Black-XXL', 'sku-Black-XXL', 520.00, 10, 'upload/products/variations/1811430997613871.png', '2024-09-28 03:20:18', '2024-09-28 03:20:18'),
(43, 37, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811431105264543.png', '2024-09-28 03:22:01', '2024-09-28 03:22:01'),
(44, 37, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811431105324513.png', '2024-09-28 03:22:01', '2024-09-28 03:22:01'),
(45, 37, 'Black-XL', 'sku-Black-XL', 520.00, 10, 'upload/products/variations/1811431105396073.png', '2024-09-28 03:22:01', '2024-09-28 03:22:01'),
(46, 37, 'Black-XXL', 'sku-Black-XXL', 520.00, 10, 'upload/products/variations/1811431105461962.png', '2024-09-28 03:22:01', '2024-09-28 03:22:01'),
(47, 36, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811431226975495.png', '2024-09-28 03:23:57', '2024-09-28 03:23:57'),
(48, 36, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811431227033311.png', '2024-09-28 03:23:57', '2024-09-28 03:23:57'),
(49, 36, 'Black-XL', 'sku-Black-XL', 520.00, 10, 'upload/products/variations/1811431227089535.png', '2024-09-28 03:23:57', '2024-09-28 03:23:57'),
(50, 36, 'Black-XXL', 'sku-Black-XXL', 520.00, 10, 'upload/products/variations/1811431227311099.png', '2024-09-28 03:23:57', '2024-09-28 03:23:57'),
(51, 33, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811431386729172.png', '2024-09-28 03:26:29', '2024-09-28 03:26:29'),
(52, 33, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811431386840995.png', '2024-09-28 03:26:29', '2024-09-28 03:26:29'),
(53, 33, 'Black-XL', 'sku-Black-XL', 520.00, 10, 'upload/products/variations/1811431386941264.png', '2024-09-28 03:26:29', '2024-09-28 03:26:29'),
(54, 33, 'Black-XXL', 'sku-Black-XXL', 520.00, 10, 'upload/products/variations/1811431387060109.png', '2024-09-28 03:26:29', '2024-09-28 03:26:29'),
(55, 32, 'Black-L', 'sku-Black-L', 520.00, 10, 'upload/products/variations/1811431508961683.png', '2024-09-28 03:28:26', '2024-09-28 03:28:26'),
(56, 32, 'Black-M', 'sku-Black-M', 520.00, 10, 'upload/products/variations/1811431509034957.png', '2024-09-28 03:28:26', '2024-09-28 03:28:26'),
(57, 32, 'Black-XL', 'sku-Black-XL', 520.00, 10, 'upload/products/variations/1811431509104206.png', '2024-09-28 03:28:26', '2024-09-28 03:28:26'),
(58, 32, 'Black-XXL', 'sku-Black-XXL', 520.00, 10, 'upload/products/variations/1811431509172663.png', '2024-09-28 03:28:26', '2024-09-28 03:28:26'),
(60, 48, 'Black-L', 'sku-Black-L', 650.00, 10, 'upload/products/variations/1811432631345019.jpg', '2024-09-28 03:46:16', '2024-09-28 03:46:16'),
(61, 48, 'Black-M', 'sku-Black-M', 650.00, 10, 'upload/products/variations/1811432631396591.jpg', '2024-09-28 03:46:16', '2024-09-28 03:46:16'),
(62, 48, 'Black-XL', 'sku-Black-XL', 650.00, 10, 'upload/products/variations/1811432631436131.jpg', '2024-09-28 03:46:16', '2024-09-28 03:46:16'),
(63, 48, 'Black-XXL', 'sku-Black-XXL', 650.00, 10, 'upload/products/variations/1811432631482312.jpg', '2024-09-28 03:46:16', '2024-09-28 03:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `review` text DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `permissions` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Hater Nagaley', '2022-08-22 02:57:04', '2024-09-24 01:11:29'),
(2, 'site_logo', 'upload/setting/logo/1727174419assvsvcscv.png', '2022-08-03 12:46:20', '2024-09-24 04:40:19'),
(3, 'site_favicon', 'upload/setting/favicon/1727331724LOGO.jpg', '2022-08-04 12:46:20', '2024-09-26 00:22:04'),
(4, 'site_footer_logo', 'upload/setting/logo/1727177067assvsvcscv.png', '2022-08-03 12:46:20', '2024-09-24 05:24:27'),
(5, 'phone', '01600783291', '2022-08-04 12:47:27', '2024-09-26 21:44:58'),
(6, 'email', 'haternagaley@gmail.com', '2022-08-12 12:47:52', '2024-09-26 21:53:42'),
(7, 'business_name', 'Hater Nagaley', '2022-08-08 12:48:27', '2024-09-25 22:42:32'),
(8, 'business_address', 'Narayanganj', '2022-08-04 12:48:53', '2024-09-28 08:12:02'),
(9, 'business_hours', 'Always Open', '2022-08-01 12:49:29', '2023-02-20 06:36:26'),
(10, 'copy_right', 'Hater Nagaley 2024', '2022-08-05 12:49:58', '2024-09-28 08:23:02'),
(11, 'developed_by', 'Classic IT & Sky Mart Ltd.', '2022-08-14 12:50:24', NULL),
(12, 'developer_link', 'https://www.classicit.com.bd/', '2022-08-13 12:50:56', NULL),
(13, 'facebook_url', 'https://www.facebook.com/profile.php?id=61561681735988', '2022-08-18 12:51:19', '2024-09-26 07:06:07'),
(14, 'twitter_url', '#', '2022-08-17 12:51:45', '2024-02-12 00:16:41'),
(15, 'linkedin_url', '#', '2022-08-12 12:52:12', '2024-02-12 00:16:41'),
(16, 'youtube_url', 'https://www.youtube.com/', '2022-08-04 12:52:42', '2024-09-25 22:42:32'),
(17, 'instagram_url', '#', '2022-08-11 12:53:11', '2024-02-12 00:16:41'),
(18, 'pinterest_url', '#', '2022-08-05 12:53:45', '2024-02-12 00:16:41'),
(19, 'guest_checkout', '1', '2022-09-21 05:45:31', '2024-09-28 02:40:53'),
(20, 'otp_system', '0', '2022-09-21 05:45:31', '2024-09-28 03:02:10'),
(21, 'multi_vendor', '1', '2022-10-08 04:08:02', '2024-09-27 02:58:03'),
(22, 'reseller_discount_percent', '5', '2023-02-22 11:58:09', '2024-03-16 17:00:44'),
(23, 'vendor_comission', '10', '2024-03-13 05:13:53', '2024-09-27 23:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Inside Dhaka, 2=>Outside Dhaka',
  `shipping_charge` double(20,2) NOT NULL DEFAULT 0.00,
  `time` varchar(50) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `name`, `type`, `shipping_charge`, `time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Redex', 1, 70.00, '2-3 day', 1, '2022-09-03 03:40:16', '2024-04-17 09:37:45'),
(2, 'Sundarban Courier', 2, 150.00, '7 day', 1, '2022-09-03 03:39:25', '2024-04-17 09:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_img` varchar(255) DEFAULT NULL,
  `title_en` varchar(50) NOT NULL,
  `title_bn` varchar(50) DEFAULT NULL,
  `slider_url` text DEFAULT NULL,
  `description_bn` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_img`, `title_en`, `title_bn`, `slider_url`, `description_bn`, `description_en`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'upload/slider/1811247514345135.jpg', 'Accessories', 'Accessories', 'https://haternagaley.com/category-product/Microphone-J85I3', 'Accessories', 'Accessories', 'accessories', 1, '2024-09-26 22:30:19', '2024-09-27 12:31:30'),
(2, 'upload/slider/1811247573363603.jpg', 'Accessories 2', 'Accessories 2', 'https://haternagaley.com/category-product/Microphone-J85I3', 'Accessories 2', 'Accessories 2', 'accessories-2', 1, '2024-09-26 14:42:31', '2024-09-27 12:31:33'),
(3, 'upload/slider/1811247623118194.jpg', 'Mobile--Accessories-V8AXp', 'Mobile--Accessories-V8AXp', 'https://haternagaley.com/product-details/T-shirt-plWYv', 'Accessories 3', 'Accessories 3', 'mobile--accessories-v8axp', 1, '2024-09-28 00:33:45', '2024-09-28 00:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `sms_providers`
--

CREATE TABLE `sms_providers` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=>Active, 0=>Inactive',
  `url` varchar(100) NOT NULL,
  `api_key` varchar(100) NOT NULL,
  `sender_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_providers`
--

INSERT INTO `sms_providers` (`id`, `name`, `status`, `url`, `api_key`, `sender_id`, `created_at`, `updated_at`) VALUES
(1, 'Classic IT', 1, 'http://sms.classicit.com.bd/smsapi', 'R6001640623a9516bf1f71.13295352', 'Classic IT', '2022-04-25 15:27:37', '2022-05-24 05:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `sms_templates`
--

CREATE TABLE `sms_templates` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `body` varchar(250) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_templates`
--

INSERT INTO `sms_templates` (`id`, `name`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'registration_verification', '[[ExPro]] রেজিস্ট্রেশন ভেরিফিকেশন কোডঃ [[code]]', 1, '2022-04-25 16:02:02', '2024-03-13 09:31:38'),
(2, 'login_verification', '[[ExPro]] লগিন ভেরিফিকেশন কোডঃ [[code]]', 1, '2022-04-25 16:02:46', '2024-03-13 09:30:57'),
(3, 'order_message', 'আপনার অর্ডার সম্পন্ন হয়েছে। অর্ডার  আইডিঃ [[order_code]], মূল্যঃ [[order_amount]] টাকা। - [[site_name]]', 1, '2022-04-25 16:03:12', '2022-05-24 05:38:23'),
(5, 'password_reset', 'আপনার নতুন পাসওয়ার্ডঃ [[code]]', 1, '2022-06-22 00:42:46', '2022-06-22 00:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'stephanie68colemanzzx@outlook.com', '2024-09-26 22:38:07', '2024-09-26 22:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `name_bn` varchar(50) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Featured, 0=>Not Featured',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_categories`
--

CREATE TABLE `sub_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `name_en` varchar(50) NOT NULL,
  `name_bn` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `subsubcategory_image` varchar(255) DEFAULT NULL,
  `is_feature` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Active, 0=>Inactive',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `email`, `address`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'MD SH', '01980265035', 'admin@gmail.com', 'narayanganj', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `name_bn` varchar(255) DEFAULT NULL,
  `tag_slug_en` varchar(255) DEFAULT NULL,
  `tag_slug_bn` varchar(255) DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `description_bn` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_orders`
--

CREATE TABLE `temp_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `division_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `upazilla_id` int(11) NOT NULL,
  `address` text DEFAULT NULL,
  `payment_method` varchar(25) NOT NULL DEFAULT 'cash',
  `payment_status` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>paid, 0=>Unpaid',
  `payment_details` text DEFAULT NULL,
  `shipping_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_type` varchar(100) DEFAULT NULL,
  `shipping_name` varchar(150) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT 0.00,
  `grand_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invoice_no` varchar(255) NOT NULL,
  `viewed` varchar(255) NOT NULL DEFAULT '0',
  `delivery_viewed` varchar(255) NOT NULL DEFAULT '1',
  `payment_status_viewed` varchar(255) NOT NULL DEFAULT '1',
  `commission_calculated` varchar(255) NOT NULL DEFAULT '0',
  `comment` text DEFAULT NULL,
  `delivery_status` varchar(255) NOT NULL DEFAULT 'pending',
  `tracking_code` varchar(100) DEFAULT NULL,
  `confirmed_date` varchar(30) DEFAULT NULL,
  `processing_date` varchar(30) DEFAULT NULL,
  `picked_date` varchar(30) DEFAULT NULL,
  `shipped_date` varchar(30) DEFAULT NULL,
  `delivered_date` varchar(30) DEFAULT NULL,
  `cancel_date` varchar(30) DEFAULT NULL,
  `return_date` varchar(30) DEFAULT NULL,
  `return_reason` text DEFAULT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Not guest order, 2=>Guest Order',
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upazillas`
--

CREATE TABLE `upazillas` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name_en` varchar(25) NOT NULL,
  `name_bn` varchar(25) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `upazillas`
--

INSERT INTO `upazillas` (`id`, `district_id`, `name_en`, `name_bn`, `url`) VALUES
(1, 1, 'Debidwar', 'দেবিদ্বার', 'debidwar.comilla.gov.bd'),
(2, 1, 'Barura', 'বরুড়া', 'barura.comilla.gov.bd'),
(3, 1, 'Brahmanpara', 'ব্রাহ্মণপাড়া', 'brahmanpara.comilla.gov.bd'),
(4, 1, 'Chandina', 'চান্দিনা', 'chandina.comilla.gov.bd'),
(5, 1, 'Chauddagram', 'চৌদ্দগ্রাম', 'chauddagram.comilla.gov.bd'),
(6, 1, 'Daudkandi', 'দাউদকান্দি', 'daudkandi.comilla.gov.bd'),
(7, 1, 'Homna', 'হোমনা', 'homna.comilla.gov.bd'),
(8, 1, 'Laksam', 'লাকসাম', 'laksam.comilla.gov.bd'),
(9, 1, 'Muradnagar', 'মুরাদনগর', 'muradnagar.comilla.gov.bd'),
(10, 1, 'Nangalkot', 'নাঙ্গলকোট', 'nangalkot.comilla.gov.bd'),
(11, 1, 'Comilla Sadar', 'কুমিল্লা সদর', 'comillasadar.comilla.gov.bd'),
(12, 1, 'Meghna', 'মেঘনা', 'meghna.comilla.gov.bd'),
(13, 1, 'Monohargonj', 'মনোহরগঞ্জ', 'monohargonj.comilla.gov.bd'),
(14, 1, 'Sadarsouth', 'সদর দক্ষিণ', 'sadarsouth.comilla.gov.bd'),
(15, 1, 'Titas', 'তিতাস', 'titas.comilla.gov.bd'),
(16, 1, 'Burichang', 'বুড়িচং', 'burichang.comilla.gov.bd'),
(17, 1, 'Lalmai', 'লালমাই', 'lalmai.comilla.gov.bd'),
(18, 2, 'Chhagalnaiya', 'ছাগলনাইয়া', 'chhagalnaiya.feni.gov.bd'),
(19, 2, 'Feni Sadar', 'ফেনী সদর', 'sadar.feni.gov.bd'),
(20, 2, 'Sonagazi', 'সোনাগাজী', 'sonagazi.feni.gov.bd'),
(21, 2, 'Fulgazi', 'ফুলগাজী', 'fulgazi.feni.gov.bd'),
(22, 2, 'Parshuram', 'পরশুরাম', 'parshuram.feni.gov.bd'),
(23, 2, 'Daganbhuiyan', 'দাগনভূঞা', 'daganbhuiyan.feni.gov.bd'),
(24, 3, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর', 'sadar.brahmanbaria.gov.bd'),
(25, 3, 'Kasba', 'কসবা', 'kasba.brahmanbaria.gov.bd'),
(26, 3, 'Nasirnagar', 'নাসিরনগর', 'nasirnagar.brahmanbaria.gov.bd'),
(27, 3, 'Sarail', 'সরাইল', 'sarail.brahmanbaria.gov.bd'),
(28, 3, 'Ashuganj', 'আশুগঞ্জ', 'ashuganj.brahmanbaria.gov.bd'),
(29, 3, 'Akhaura', 'আখাউড়া', 'akhaura.brahmanbaria.gov.bd'),
(30, 3, 'Nabinagar', 'নবীনগর', 'nabinagar.brahmanbaria.gov.bd'),
(31, 3, 'Bancharampur', 'বাঞ্ছারামপুর', 'bancharampur.brahmanbaria.gov.bd'),
(32, 3, 'Bijoynagar', 'বিজয়নগর', 'bijoynagar.brahmanbaria.gov.bd    '),
(33, 4, 'Rangamati Sadar', 'রাঙ্গামাটি সদর', 'sadar.rangamati.gov.bd'),
(34, 4, 'Kaptai', 'কাপ্তাই', 'kaptai.rangamati.gov.bd'),
(35, 4, 'Kawkhali', 'কাউখালী', 'kawkhali.rangamati.gov.bd'),
(36, 4, 'Baghaichari', 'বাঘাইছড়ি', 'baghaichari.rangamati.gov.bd'),
(37, 4, 'Barkal', 'বরকল', 'barkal.rangamati.gov.bd'),
(38, 4, 'Langadu', 'লংগদু', 'langadu.rangamati.gov.bd'),
(39, 4, 'Rajasthali', 'রাজস্থলী', 'rajasthali.rangamati.gov.bd'),
(40, 4, 'Belaichari', 'বিলাইছড়ি', 'belaichari.rangamati.gov.bd'),
(41, 4, 'Juraichari', 'জুরাছড়ি', 'juraichari.rangamati.gov.bd'),
(42, 4, 'Naniarchar', 'নানিয়ারচর', 'naniarchar.rangamati.gov.bd'),
(43, 5, 'Noakhali Sadar', 'নোয়াখালী সদর', 'sadar.noakhali.gov.bd'),
(44, 5, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.noakhali.gov.bd'),
(45, 5, 'Begumganj', 'বেগমগঞ্জ', 'begumganj.noakhali.gov.bd'),
(46, 5, 'Hatia', 'হাতিয়া', 'hatia.noakhali.gov.bd'),
(47, 5, 'Subarnachar', 'সুবর্ণচর', 'subarnachar.noakhali.gov.bd'),
(48, 5, 'Kabirhat', 'কবিরহাট', 'kabirhat.noakhali.gov.bd'),
(49, 5, 'Senbug', 'সেনবাগ', 'senbug.noakhali.gov.bd'),
(50, 5, 'Chatkhil', 'চাটখিল', 'chatkhil.noakhali.gov.bd'),
(51, 5, 'Sonaimori', 'সোনাইমুড়ী', 'sonaimori.noakhali.gov.bd'),
(52, 6, 'Haimchar', 'হাইমচর', 'haimchar.chandpur.gov.bd'),
(53, 6, 'Kachua', 'কচুয়া', 'kachua.chandpur.gov.bd'),
(54, 6, 'Shahrasti', 'শাহরাস্তি	', 'shahrasti.chandpur.gov.bd'),
(55, 6, 'Chandpur Sadar', 'চাঁদপুর সদর', 'sadar.chandpur.gov.bd'),
(56, 6, 'Matlab South', 'মতলব দক্ষিণ', 'matlabsouth.chandpur.gov.bd'),
(57, 6, 'Hajiganj', 'হাজীগঞ্জ', 'hajiganj.chandpur.gov.bd'),
(58, 6, 'Matlab North', 'মতলব উত্তর', 'matlabnorth.chandpur.gov.bd'),
(59, 6, 'Faridgonj', 'ফরিদগঞ্জ', 'faridgonj.chandpur.gov.bd'),
(60, 7, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', 'sadar.lakshmipur.gov.bd'),
(61, 7, 'Kamalnagar', 'কমলনগর', 'kamalnagar.lakshmipur.gov.bd'),
(62, 7, 'Raipur', 'রায়পুর', 'raipur.lakshmipur.gov.bd'),
(63, 7, 'Ramgati', 'রামগতি', 'ramgati.lakshmipur.gov.bd'),
(64, 7, 'Ramganj', 'রামগঞ্জ', 'ramganj.lakshmipur.gov.bd'),
(65, 8, 'Rangunia', 'রাঙ্গুনিয়া', 'rangunia.chittagong.gov.bd'),
(66, 8, 'Sitakunda', 'সীতাকুন্ড', 'sitakunda.chittagong.gov.bd'),
(67, 8, 'Mirsharai', 'মীরসরাই', 'mirsharai.chittagong.gov.bd'),
(68, 8, 'Patiya', 'পটিয়া', 'patiya.chittagong.gov.bd'),
(69, 8, 'Sandwip', 'সন্দ্বীপ', 'sandwip.chittagong.gov.bd'),
(70, 8, 'Banshkhali', 'বাঁশখালী', 'banshkhali.chittagong.gov.bd'),
(71, 8, 'Boalkhali', 'বোয়ালখালী', 'boalkhali.chittagong.gov.bd'),
(72, 8, 'Anwara', 'আনোয়ারা', 'anwara.chittagong.gov.bd'),
(73, 8, 'Chandanaish', 'চন্দনাইশ', 'chandanaish.chittagong.gov.bd'),
(74, 8, 'Satkania', 'সাতকানিয়া', 'satkania.chittagong.gov.bd'),
(75, 8, 'Lohagara', 'লোহাগাড়া', 'lohagara.chittagong.gov.bd'),
(76, 8, 'Hathazari', 'হাটহাজারী', 'hathazari.chittagong.gov.bd'),
(77, 8, 'Fatikchhari', 'ফটিকছড়ি', 'fatikchhari.chittagong.gov.bd'),
(78, 8, 'Raozan', 'রাউজান', 'raozan.chittagong.gov.bd'),
(79, 8, 'Karnafuli', 'কর্ণফুলী', 'karnafuli.chittagong.gov.bd'),
(80, 9, 'Coxsbazar Sadar', 'কক্সবাজার সদর', 'sadar.coxsbazar.gov.bd'),
(81, 9, 'Chakaria', 'চকরিয়া', 'chakaria.coxsbazar.gov.bd'),
(82, 9, 'Kutubdia', 'কুতুবদিয়া', 'kutubdia.coxsbazar.gov.bd'),
(83, 9, 'Ukhiya', 'উখিয়া', 'ukhiya.coxsbazar.gov.bd'),
(84, 9, 'Moheshkhali', 'মহেশখালী', 'moheshkhali.coxsbazar.gov.bd'),
(85, 9, 'Pekua', 'পেকুয়া', 'pekua.coxsbazar.gov.bd'),
(86, 9, 'Ramu', 'রামু', 'ramu.coxsbazar.gov.bd'),
(87, 9, 'Teknaf', 'টেকনাফ', 'teknaf.coxsbazar.gov.bd'),
(88, 10, 'Khagrachhari Sadar', 'খাগড়াছড়ি সদর', 'sadar.khagrachhari.gov.bd'),
(89, 10, 'Dighinala', 'দিঘীনালা', 'dighinala.khagrachhari.gov.bd'),
(90, 10, 'Panchari', 'পানছড়ি', 'panchari.khagrachhari.gov.bd'),
(91, 10, 'Laxmichhari', 'লক্ষীছড়ি', 'laxmichhari.khagrachhari.gov.bd'),
(92, 10, 'Mohalchari', 'মহালছড়ি', 'mohalchari.khagrachhari.gov.bd'),
(93, 10, 'Manikchari', 'মানিকছড়ি', 'manikchari.khagrachhari.gov.bd'),
(94, 10, 'Ramgarh', 'রামগড়', 'ramgarh.khagrachhari.gov.bd'),
(95, 10, 'Matiranga', 'মাটিরাঙ্গা', 'matiranga.khagrachhari.gov.bd'),
(96, 10, 'Guimara', 'গুইমারা', 'guimara.khagrachhari.gov.bd'),
(97, 11, 'Bandarban Sadar', 'বান্দরবান সদর', 'sadar.bandarban.gov.bd'),
(98, 11, 'Alikadam', 'আলীকদম', 'alikadam.bandarban.gov.bd'),
(99, 11, 'Naikhongchhari', 'নাইক্ষ্যংছড়ি', 'naikhongchhari.bandarban.gov.bd'),
(100, 11, 'Rowangchhari', 'রোয়াংছড়ি', 'rowangchhari.bandarban.gov.bd'),
(101, 11, 'Lama', 'লামা', 'lama.bandarban.gov.bd'),
(102, 11, 'Ruma', 'রুমা', 'ruma.bandarban.gov.bd'),
(103, 11, 'Thanchi', 'থানচি', 'thanchi.bandarban.gov.bd'),
(104, 12, 'Belkuchi', 'বেলকুচি', 'belkuchi.sirajganj.gov.bd'),
(105, 12, 'Chauhali', 'চৌহালি', 'chauhali.sirajganj.gov.bd'),
(106, 12, 'Kamarkhand', 'কামারখন্দ', 'kamarkhand.sirajganj.gov.bd'),
(107, 12, 'Kazipur', 'কাজীপুর', 'kazipur.sirajganj.gov.bd'),
(108, 12, 'Raigonj', 'রায়গঞ্জ', 'raigonj.sirajganj.gov.bd'),
(109, 12, 'Shahjadpur', 'শাহজাদপুর', 'shahjadpur.sirajganj.gov.bd'),
(110, 12, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', 'sirajganjsadar.sirajganj.gov.bd'),
(111, 12, 'Tarash', 'তাড়াশ', 'tarash.sirajganj.gov.bd'),
(112, 12, 'Ullapara', 'উল্লাপাড়া', 'ullapara.sirajganj.gov.bd'),
(113, 13, 'Sujanagar', 'সুজানগর', 'sujanagar.pabna.gov.bd'),
(114, 13, 'Ishurdi', 'ঈশ্বরদী', 'ishurdi.pabna.gov.bd'),
(115, 13, 'Bhangura', 'ভাঙ্গুড়া', 'bhangura.pabna.gov.bd'),
(116, 13, 'Pabna Sadar', 'পাবনা সদর', 'pabnasadar.pabna.gov.bd'),
(117, 13, 'Bera', 'বেড়া', 'bera.pabna.gov.bd'),
(118, 13, 'Atghoria', 'আটঘরিয়া', 'atghoria.pabna.gov.bd'),
(119, 13, 'Chatmohar', 'চাটমোহর', 'chatmohar.pabna.gov.bd'),
(120, 13, 'Santhia', 'সাঁথিয়া', 'santhia.pabna.gov.bd'),
(121, 13, 'Faridpur', 'ফরিদপুর', 'faridpur.pabna.gov.bd'),
(122, 14, 'Kahaloo', 'কাহালু', 'kahaloo.bogra.gov.bd'),
(123, 14, 'Bogra Sadar', 'বগুড়া সদর', 'sadar.bogra.gov.bd'),
(124, 14, 'Shariakandi', 'সারিয়াকান্দি', 'shariakandi.bogra.gov.bd'),
(125, 14, 'Shajahanpur', 'শাজাহানপুর', 'shajahanpur.bogra.gov.bd'),
(126, 14, 'Dupchanchia', 'দুপচাচিঁয়া', 'dupchanchia.bogra.gov.bd'),
(127, 14, 'Adamdighi', 'আদমদিঘি', 'adamdighi.bogra.gov.bd'),
(128, 14, 'Nondigram', 'নন্দিগ্রাম', 'nondigram.bogra.gov.bd'),
(129, 14, 'Sonatala', 'সোনাতলা', 'sonatala.bogra.gov.bd'),
(130, 14, 'Dhunot', 'ধুনট', 'dhunot.bogra.gov.bd'),
(131, 14, 'Gabtali', 'গাবতলী', 'gabtali.bogra.gov.bd'),
(132, 14, 'Sherpur', 'শেরপুর', 'sherpur.bogra.gov.bd'),
(133, 14, 'Shibganj', 'শিবগঞ্জ', 'shibganj.bogra.gov.bd'),
(134, 15, 'Paba', 'পবা', 'paba.rajshahi.gov.bd'),
(135, 15, 'Durgapur', 'দুর্গাপুর', 'durgapur.rajshahi.gov.bd'),
(136, 15, 'Mohonpur', 'মোহনপুর', 'mohonpur.rajshahi.gov.bd'),
(137, 15, 'Charghat', 'চারঘাট', 'charghat.rajshahi.gov.bd'),
(138, 15, 'Puthia', 'পুঠিয়া', 'puthia.rajshahi.gov.bd'),
(139, 15, 'Bagha', 'বাঘা', 'bagha.rajshahi.gov.bd'),
(140, 15, 'Godagari', 'গোদাগাড়ী', 'godagari.rajshahi.gov.bd'),
(141, 15, 'Tanore', 'তানোর', 'tanore.rajshahi.gov.bd'),
(142, 15, 'Bagmara', 'বাগমারা', 'bagmara.rajshahi.gov.bd'),
(143, 16, 'Natore Sadar', 'নাটোর সদর', 'natoresadar.natore.gov.bd'),
(144, 16, 'Singra', 'সিংড়া', 'singra.natore.gov.bd'),
(145, 16, 'Baraigram', 'বড়াইগ্রাম', 'baraigram.natore.gov.bd'),
(146, 16, 'Bagatipara', 'বাগাতিপাড়া', 'bagatipara.natore.gov.bd'),
(147, 16, 'Lalpur', 'লালপুর', 'lalpur.natore.gov.bd'),
(148, 16, 'Gurudaspur', 'গুরুদাসপুর', 'gurudaspur.natore.gov.bd'),
(149, 16, 'Naldanga', 'নলডাঙ্গা', 'naldanga.natore.gov.bd'),
(150, 17, 'Akkelpur', 'আক্কেলপুর', 'akkelpur.joypurhat.gov.bd'),
(151, 17, 'Kalai', 'কালাই', 'kalai.joypurhat.gov.bd'),
(152, 17, 'Khetlal', 'ক্ষেতলাল', 'khetlal.joypurhat.gov.bd'),
(153, 17, 'Panchbibi', 'পাঁচবিবি', 'panchbibi.joypurhat.gov.bd'),
(154, 17, 'Joypurhat Sadar', 'জয়পুরহাট সদর', 'joypurhatsadar.joypurhat.gov.bd'),
(155, 18, 'Chapainawabganj Sadar', 'চাঁপাইনবাবগঞ্জ সদর', 'chapainawabganjsadar.chapainawabganj.gov.bd'),
(156, 18, 'Gomostapur', 'গোমস্তাপুর', 'gomostapur.chapainawabganj.gov.bd'),
(157, 18, 'Nachol', 'নাচোল', 'nachol.chapainawabganj.gov.bd'),
(158, 18, 'Bholahat', 'ভোলাহাট', 'bholahat.chapainawabganj.gov.bd'),
(159, 18, 'Shibganj', 'শিবগঞ্জ', 'shibganj.chapainawabganj.gov.bd'),
(160, 19, 'Mohadevpur', 'মহাদেবপুর', 'mohadevpur.naogaon.gov.bd'),
(161, 19, 'Badalgachi', 'বদলগাছী', 'badalgachi.naogaon.gov.bd'),
(162, 19, 'Patnitala', 'পত্নিতলা', 'patnitala.naogaon.gov.bd'),
(163, 19, 'Dhamoirhat', 'ধামইরহাট', 'dhamoirhat.naogaon.gov.bd'),
(164, 19, 'Niamatpur', 'নিয়ামতপুর', 'niamatpur.naogaon.gov.bd'),
(165, 19, 'Manda', 'মান্দা', 'manda.naogaon.gov.bd'),
(166, 19, 'Atrai', 'আত্রাই', 'atrai.naogaon.gov.bd'),
(167, 19, 'Raninagar', 'রাণীনগর', 'raninagar.naogaon.gov.bd'),
(168, 19, 'Naogaon Sadar', 'নওগাঁ সদর', 'naogaonsadar.naogaon.gov.bd'),
(169, 19, 'Porsha', 'পোরশা', 'porsha.naogaon.gov.bd'),
(170, 19, 'Sapahar', 'সাপাহার', 'sapahar.naogaon.gov.bd'),
(171, 20, 'Manirampur', 'মণিরামপুর', 'manirampur.jessore.gov.bd'),
(172, 20, 'Abhaynagar', 'অভয়নগর', 'abhaynagar.jessore.gov.bd'),
(173, 20, 'Bagherpara', 'বাঘারপাড়া', 'bagherpara.jessore.gov.bd'),
(174, 20, 'Chougachha', 'চৌগাছা', 'chougachha.jessore.gov.bd'),
(175, 20, 'Jhikargacha', 'ঝিকরগাছা', 'jhikargacha.jessore.gov.bd'),
(176, 20, 'Keshabpur', 'কেশবপুর', 'keshabpur.jessore.gov.bd'),
(177, 20, 'Jessore Sadar', 'যশোর সদর', 'sadar.jessore.gov.bd'),
(178, 20, 'Sharsha', 'শার্শা', 'sharsha.jessore.gov.bd'),
(179, 21, 'Assasuni', 'আশাশুনি', 'assasuni.satkhira.gov.bd'),
(180, 21, 'Debhata', 'দেবহাটা', 'debhata.satkhira.gov.bd'),
(181, 21, 'Kalaroa', 'কলারোয়া', 'kalaroa.satkhira.gov.bd'),
(182, 21, 'Satkhira Sadar', 'সাতক্ষীরা সদর', 'satkhirasadar.satkhira.gov.bd'),
(183, 21, 'Shyamnagar', 'শ্যামনগর', 'shyamnagar.satkhira.gov.bd'),
(184, 21, 'Tala', 'তালা', 'tala.satkhira.gov.bd'),
(185, 21, 'Kaliganj', 'কালিগঞ্জ', 'kaliganj.satkhira.gov.bd'),
(186, 22, 'Mujibnagar', 'মুজিবনগর', 'mujibnagar.meherpur.gov.bd'),
(187, 22, 'Meherpur Sadar', 'মেহেরপুর সদর', 'meherpursadar.meherpur.gov.bd'),
(188, 22, 'Gangni', 'গাংনী', 'gangni.meherpur.gov.bd'),
(189, 23, 'Narail Sadar', 'নড়াইল সদর', 'narailsadar.narail.gov.bd'),
(190, 23, 'Lohagara', 'লোহাগড়া', 'lohagara.narail.gov.bd'),
(191, 23, 'Kalia', 'কালিয়া', 'kalia.narail.gov.bd'),
(192, 24, 'Chuadanga Sadar', 'চুয়াডাঙ্গা সদর', 'chuadangasadar.chuadanga.gov.bd'),
(193, 24, 'Alamdanga', 'আলমডাঙ্গা', 'alamdanga.chuadanga.gov.bd'),
(194, 24, 'Damurhuda', 'দামুড়হুদা', 'damurhuda.chuadanga.gov.bd'),
(195, 24, 'Jibannagar', 'জীবননগর', 'jibannagar.chuadanga.gov.bd'),
(196, 25, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 'kushtiasadar.kushtia.gov.bd'),
(197, 25, 'Kumarkhali', 'কুমারখালী', 'kumarkhali.kushtia.gov.bd'),
(198, 25, 'Khoksa', 'খোকসা', 'khoksa.kushtia.gov.bd'),
(199, 25, 'Mirpur', 'মিরপুর', 'mirpurkushtia.kushtia.gov.bd'),
(200, 25, 'Daulatpur', 'দৌলতপুর', 'daulatpur.kushtia.gov.bd'),
(201, 25, 'Bheramara', 'ভেড়ামারা', 'bheramara.kushtia.gov.bd'),
(202, 26, 'Shalikha', 'শালিখা', 'shalikha.magura.gov.bd'),
(203, 26, 'Sreepur', 'শ্রীপুর', 'sreepur.magura.gov.bd'),
(204, 26, 'Magura Sadar', 'মাগুরা সদর', 'magurasadar.magura.gov.bd'),
(205, 26, 'Mohammadpur', 'মহম্মদপুর', 'mohammadpur.magura.gov.bd'),
(206, 27, 'Paikgasa', 'পাইকগাছা', 'paikgasa.khulna.gov.bd'),
(207, 27, 'Fultola', 'ফুলতলা', 'fultola.khulna.gov.bd'),
(208, 27, 'Digholia', 'দিঘলিয়া', 'digholia.khulna.gov.bd'),
(209, 27, 'Rupsha', 'রূপসা', 'rupsha.khulna.gov.bd'),
(210, 27, 'Terokhada', 'তেরখাদা', 'terokhada.khulna.gov.bd'),
(211, 27, 'Dumuria', 'ডুমুরিয়া', 'dumuria.khulna.gov.bd'),
(212, 27, 'Botiaghata', 'বটিয়াঘাটা', 'botiaghata.khulna.gov.bd'),
(213, 27, 'Dakop', 'দাকোপ', 'dakop.khulna.gov.bd'),
(214, 27, 'Koyra', 'কয়রা', 'koyra.khulna.gov.bd'),
(215, 28, 'Fakirhat', 'ফকিরহাট', 'fakirhat.bagerhat.gov.bd'),
(216, 28, 'Bagerhat Sadar', 'বাগেরহাট সদর', 'sadar.bagerhat.gov.bd'),
(217, 28, 'Mollahat', 'মোল্লাহাট', 'mollahat.bagerhat.gov.bd'),
(218, 28, 'Sarankhola', 'শরণখোলা', 'sarankhola.bagerhat.gov.bd'),
(219, 28, 'Rampal', 'রামপাল', 'rampal.bagerhat.gov.bd'),
(220, 28, 'Morrelganj', 'মোড়েলগঞ্জ', 'morrelganj.bagerhat.gov.bd'),
(221, 28, 'Kachua', 'কচুয়া', 'kachua.bagerhat.gov.bd'),
(222, 28, 'Mongla', 'মোংলা', 'mongla.bagerhat.gov.bd'),
(223, 28, 'Chitalmari', 'চিতলমারী', 'chitalmari.bagerhat.gov.bd'),
(224, 29, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর', 'sadar.jhenaidah.gov.bd'),
(225, 29, 'Shailkupa', 'শৈলকুপা', 'shailkupa.jhenaidah.gov.bd'),
(226, 29, 'Harinakundu', 'হরিণাকুন্ডু', 'harinakundu.jhenaidah.gov.bd'),
(227, 29, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.jhenaidah.gov.bd'),
(228, 29, 'Kotchandpur', 'কোটচাঁদপুর', 'kotchandpur.jhenaidah.gov.bd'),
(229, 29, 'Moheshpur', 'মহেশপুর', 'moheshpur.jhenaidah.gov.bd'),
(230, 30, 'Jhalakathi Sadar', 'ঝালকাঠি সদর', 'sadar.jhalakathi.gov.bd'),
(231, 30, 'Kathalia', 'কাঠালিয়া', 'kathalia.jhalakathi.gov.bd'),
(232, 30, 'Nalchity', 'নলছিটি', 'nalchity.jhalakathi.gov.bd'),
(233, 30, 'Rajapur', 'রাজাপুর', 'rajapur.jhalakathi.gov.bd'),
(234, 31, 'Bauphal', 'বাউফল', 'bauphal.patuakhali.gov.bd'),
(235, 31, 'Patuakhali Sadar', 'পটুয়াখালী সদর', 'sadar.patuakhali.gov.bd'),
(236, 31, 'Dumki', 'দুমকি', 'dumki.patuakhali.gov.bd'),
(237, 31, 'Dashmina', 'দশমিনা', 'dashmina.patuakhali.gov.bd'),
(238, 31, 'Kalapara', 'কলাপাড়া', 'kalapara.patuakhali.gov.bd'),
(239, 31, 'Mirzaganj', 'মির্জাগঞ্জ', 'mirzaganj.patuakhali.gov.bd'),
(240, 31, 'Galachipa', 'গলাচিপা', 'galachipa.patuakhali.gov.bd'),
(241, 31, 'Rangabali', 'রাঙ্গাবালী', 'rangabali.patuakhali.gov.bd'),
(242, 32, 'Pirojpur Sadar', 'পিরোজপুর সদর', 'sadar.pirojpur.gov.bd'),
(243, 32, 'Nazirpur', 'নাজিরপুর', 'nazirpur.pirojpur.gov.bd'),
(244, 32, 'Kawkhali', 'কাউখালী', 'kawkhali.pirojpur.gov.bd'),
(245, 32, 'Zianagar', 'জিয়ানগর', 'zianagar.pirojpur.gov.bd'),
(246, 32, 'Bhandaria', 'ভান্ডারিয়া', 'bhandaria.pirojpur.gov.bd'),
(247, 32, 'Mathbaria', 'মঠবাড়ীয়া', 'mathbaria.pirojpur.gov.bd'),
(248, 32, 'Nesarabad', 'নেছারাবাদ', 'nesarabad.pirojpur.gov.bd'),
(249, 33, 'Barisal Sadar', 'বরিশাল সদর', 'barisalsadar.barisal.gov.bd'),
(250, 33, 'Bakerganj', 'বাকেরগঞ্জ', 'bakerganj.barisal.gov.bd'),
(251, 33, 'Babuganj', 'বাবুগঞ্জ', 'babuganj.barisal.gov.bd'),
(252, 33, 'Wazirpur', 'উজিরপুর', 'wazirpur.barisal.gov.bd'),
(253, 33, 'Banaripara', 'বানারীপাড়া', 'banaripara.barisal.gov.bd'),
(254, 33, 'Gournadi', 'গৌরনদী', 'gournadi.barisal.gov.bd'),
(255, 33, 'Agailjhara', 'আগৈলঝাড়া', 'agailjhara.barisal.gov.bd'),
(256, 33, 'Mehendiganj', 'মেহেন্দিগঞ্জ', 'mehendiganj.barisal.gov.bd'),
(257, 33, 'Muladi', 'মুলাদী', 'muladi.barisal.gov.bd'),
(258, 33, 'Hizla', 'হিজলা', 'hizla.barisal.gov.bd'),
(259, 34, 'Bhola Sadar', 'ভোলা সদর', 'sadar.bhola.gov.bd'),
(260, 34, 'Borhan Sddin', 'বোরহান উদ্দিন', 'borhanuddin.bhola.gov.bd'),
(261, 34, 'Charfesson', 'চরফ্যাশন', 'charfesson.bhola.gov.bd'),
(262, 34, 'Doulatkhan', 'দৌলতখান', 'doulatkhan.bhola.gov.bd'),
(263, 34, 'Monpura', 'মনপুরা', 'monpura.bhola.gov.bd'),
(264, 34, 'Tazumuddin', 'তজুমদ্দিন', 'tazumuddin.bhola.gov.bd'),
(265, 34, 'Lalmohan', 'লালমোহন', 'lalmohan.bhola.gov.bd'),
(266, 35, 'Amtali', 'আমতলী', 'amtali.barguna.gov.bd'),
(267, 35, 'Barguna Sadar', 'বরগুনা সদর', 'sadar.barguna.gov.bd'),
(268, 35, 'Betagi', 'বেতাগী', 'betagi.barguna.gov.bd'),
(269, 35, 'Bamna', 'বামনা', 'bamna.barguna.gov.bd'),
(270, 35, 'Pathorghata', 'পাথরঘাটা', 'pathorghata.barguna.gov.bd'),
(271, 35, 'Taltali', 'তালতলি', 'taltali.barguna.gov.bd'),
(272, 36, 'Balaganj', 'বালাগঞ্জ', 'balaganj.sylhet.gov.bd'),
(273, 36, 'Beanibazar', 'বিয়ানীবাজার', 'beanibazar.sylhet.gov.bd'),
(274, 36, 'Bishwanath', 'বিশ্বনাথ', 'bishwanath.sylhet.gov.bd'),
(275, 36, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.sylhet.gov.bd'),
(276, 36, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 'fenchuganj.sylhet.gov.bd'),
(277, 36, 'Golapganj', 'গোলাপগঞ্জ', 'golapganj.sylhet.gov.bd'),
(278, 36, 'Gowainghat', 'গোয়াইনঘাট', 'gowainghat.sylhet.gov.bd'),
(279, 36, 'Jaintiapur', 'জৈন্তাপুর', 'jaintiapur.sylhet.gov.bd'),
(280, 36, 'Kanaighat', 'কানাইঘাট', 'kanaighat.sylhet.gov.bd'),
(281, 36, 'Sylhet Sadar', 'সিলেট সদর', 'sylhetsadar.sylhet.gov.bd'),
(282, 36, 'Zakiganj', 'জকিগঞ্জ', 'zakiganj.sylhet.gov.bd'),
(283, 36, 'Dakshinsurma', 'দক্ষিণ সুরমা', 'dakshinsurma.sylhet.gov.bd'),
(284, 36, 'Osmaninagar', 'ওসমানী নগর', 'osmaninagar.sylhet.gov.bd'),
(285, 37, 'Barlekha', 'বড়লেখা', 'barlekha.moulvibazar.gov.bd'),
(286, 37, 'Kamolganj', 'কমলগঞ্জ', 'kamolganj.moulvibazar.gov.bd'),
(287, 37, 'Kulaura', 'কুলাউড়া', 'kulaura.moulvibazar.gov.bd'),
(288, 37, 'Moulvibazar Sadar', 'মৌলভীবাজার সদর', 'moulvibazarsadar.moulvibazar.gov.bd'),
(289, 37, 'Rajnagar', 'রাজনগর', 'rajnagar.moulvibazar.gov.bd'),
(290, 37, 'Sreemangal', 'শ্রীমঙ্গল', 'sreemangal.moulvibazar.gov.bd'),
(291, 37, 'Juri', 'জুড়ী', 'juri.moulvibazar.gov.bd'),
(292, 38, 'Nabiganj', 'নবীগঞ্জ', 'nabiganj.habiganj.gov.bd'),
(293, 38, 'Bahubal', 'বাহুবল', 'bahubal.habiganj.gov.bd'),
(294, 38, 'Ajmiriganj', 'আজমিরীগঞ্জ', 'ajmiriganj.habiganj.gov.bd'),
(295, 38, 'Baniachong', 'বানিয়াচং', 'baniachong.habiganj.gov.bd'),
(296, 38, 'Lakhai', 'লাখাই', 'lakhai.habiganj.gov.bd'),
(297, 38, 'Chunarughat', 'চুনারুঘাট', 'chunarughat.habiganj.gov.bd'),
(298, 38, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 'habiganjsadar.habiganj.gov.bd'),
(299, 38, 'Madhabpur', 'মাধবপুর', 'madhabpur.habiganj.gov.bd'),
(300, 39, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 'sadar.sunamganj.gov.bd'),
(301, 39, 'South Sunamganj', 'দক্ষিণ সুনামগঞ্জ', 'southsunamganj.sunamganj.gov.bd'),
(302, 39, 'Bishwambarpur', 'বিশ্বম্ভরপুর', 'bishwambarpur.sunamganj.gov.bd'),
(303, 39, 'Chhatak', 'ছাতক', 'chhatak.sunamganj.gov.bd'),
(304, 39, 'Jagannathpur', 'জগন্নাথপুর', 'jagannathpur.sunamganj.gov.bd'),
(305, 39, 'Dowarabazar', 'দোয়ারাবাজার', 'dowarabazar.sunamganj.gov.bd'),
(306, 39, 'Tahirpur', 'তাহিরপুর', 'tahirpur.sunamganj.gov.bd'),
(307, 39, 'Dharmapasha', 'ধর্মপাশা', 'dharmapasha.sunamganj.gov.bd'),
(308, 39, 'Jamalganj', 'জামালগঞ্জ', 'jamalganj.sunamganj.gov.bd'),
(309, 39, 'Shalla', 'শাল্লা', 'shalla.sunamganj.gov.bd'),
(310, 39, 'Derai', 'দিরাই', 'derai.sunamganj.gov.bd'),
(311, 53, 'Belabo', 'বেলাবো', 'belabo.narsingdi.gov.bd'),
(312, 53, 'Monohardi', 'মনোহরদী', 'monohardi.narsingdi.gov.bd'),
(313, 53, 'Narsingdi Sadar', 'নরসিংদী সদর', 'narsingdisadar.narsingdi.gov.bd'),
(314, 53, 'Palash', 'পলাশ', 'palash.narsingdi.gov.bd'),
(315, 53, 'Raipura', 'রায়পুরা', 'raipura.narsingdi.gov.bd'),
(316, 53, 'Shibpur', 'শিবপুর', 'shibpur.narsingdi.gov.bd'),
(317, 54, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.gazipur.gov.bd'),
(318, 54, 'Kaliakair', 'কালিয়াকৈর', 'kaliakair.gazipur.gov.bd'),
(319, 54, 'Kapasia', 'কাপাসিয়া', 'kapasia.gazipur.gov.bd'),
(320, 54, 'Gazipur Sadar', 'গাজীপুর সদর', 'sadar.gazipur.gov.bd'),
(321, 54, 'Sreepur', 'শ্রীপুর', 'sreepur.gazipur.gov.bd'),
(322, 55, 'Shariatpur Sadar', 'শরিয়তপুর সদর', 'sadar.shariatpur.gov.bd'),
(323, 55, 'Naria', 'নড়িয়া', 'naria.shariatpur.gov.bd'),
(324, 55, 'Zajira', 'জাজিরা', 'zajira.shariatpur.gov.bd'),
(325, 55, 'Gosairhat', 'গোসাইরহাট', 'gosairhat.shariatpur.gov.bd'),
(326, 55, 'Bhedarganj', 'ভেদরগঞ্জ', 'bhedarganj.shariatpur.gov.bd'),
(327, 55, 'Damudya', 'ডামুড্যা', 'damudya.shariatpur.gov.bd'),
(328, 56, 'Araihazar', 'আড়াইহাজার', 'araihazar.narayanganj.gov.bd'),
(329, 56, 'Bandar', 'বন্দর', 'bandar.narayanganj.gov.bd'),
(330, 56, 'Narayanganj Sadar', 'নারায়নগঞ্জ সদর', 'narayanganjsadar.narayanganj.gov.bd'),
(331, 56, 'Rupganj', 'রূপগঞ্জ', 'rupganj.narayanganj.gov.bd'),
(332, 56, 'Sonargaon', 'সোনারগাঁ', 'sonargaon.narayanganj.gov.bd'),
(333, 57, 'Basail', 'বাসাইল', 'basail.tangail.gov.bd'),
(334, 57, 'Bhuapur', 'ভুয়াপুর', 'bhuapur.tangail.gov.bd'),
(335, 57, 'Delduar', 'দেলদুয়ার', 'delduar.tangail.gov.bd'),
(336, 57, 'Ghatail', 'ঘাটাইল', 'ghatail.tangail.gov.bd'),
(337, 57, 'Gopalpur', 'গোপালপুর', 'gopalpur.tangail.gov.bd'),
(338, 57, 'Madhupur', 'মধুপুর', 'madhupur.tangail.gov.bd'),
(339, 57, 'Mirzapur', 'মির্জাপুর', 'mirzapur.tangail.gov.bd'),
(340, 57, 'Nagarpur', 'নাগরপুর', 'nagarpur.tangail.gov.bd'),
(341, 57, 'Sakhipur', 'সখিপুর', 'sakhipur.tangail.gov.bd'),
(342, 57, 'Tangail Sadar', 'টাঙ্গাইল সদর', 'tangailsadar.tangail.gov.bd'),
(343, 57, 'Kalihati', 'কালিহাতী', 'kalihati.tangail.gov.bd'),
(344, 57, 'Dhanbari', 'ধনবাড়ী', 'dhanbari.tangail.gov.bd'),
(345, 58, 'Itna', 'ইটনা', 'itna.kishoreganj.gov.bd'),
(346, 58, 'Katiadi', 'কটিয়াদী', 'katiadi.kishoreganj.gov.bd'),
(347, 58, 'Bhairab', 'ভৈরব', 'bhairab.kishoreganj.gov.bd'),
(348, 58, 'Tarail', 'তাড়াইল', 'tarail.kishoreganj.gov.bd'),
(349, 58, 'Hossainpur', 'হোসেনপুর', 'hossainpur.kishoreganj.gov.bd'),
(350, 58, 'Pakundia', 'পাকুন্দিয়া', 'pakundia.kishoreganj.gov.bd'),
(351, 58, 'Kuliarchar', 'কুলিয়ারচর', 'kuliarchar.kishoreganj.gov.bd'),
(352, 58, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', 'kishoreganjsadar.kishoreganj.gov.bd'),
(353, 58, 'Karimgonj', 'করিমগঞ্জ', 'karimgonj.kishoreganj.gov.bd'),
(354, 58, 'Bajitpur', 'বাজিতপুর', 'bajitpur.kishoreganj.gov.bd'),
(355, 58, 'Austagram', 'অষ্টগ্রাম', 'austagram.kishoreganj.gov.bd'),
(356, 58, 'Mithamoin', 'মিঠামইন', 'mithamoin.kishoreganj.gov.bd'),
(357, 58, 'Nikli', 'নিকলী', 'nikli.kishoreganj.gov.bd'),
(358, 59, 'Harirampur', 'হরিরামপুর', 'harirampur.manikganj.gov.bd'),
(359, 59, 'Saturia', 'সাটুরিয়া', 'saturia.manikganj.gov.bd'),
(360, 59, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', 'sadar.manikganj.gov.bd'),
(361, 59, 'Gior', 'ঘিওর', 'gior.manikganj.gov.bd'),
(362, 59, 'Shibaloy', 'শিবালয়', 'shibaloy.manikganj.gov.bd'),
(363, 59, 'Doulatpur', 'দৌলতপুর', 'doulatpur.manikganj.gov.bd'),
(364, 59, 'Singiar', 'সিংগাইর', 'singiar.manikganj.gov.bd'),
(365, 52, 'Savar', 'সাভার', 'savar.dhaka.gov.bd'),
(366, 52, 'Dhamrai', 'ধামরাই', 'dhamrai.dhaka.gov.bd'),
(367, 52, 'Keraniganj', 'কেরাণীগঞ্জ', 'keraniganj.dhaka.gov.bd'),
(368, 52, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dhaka.gov.bd'),
(369, 52, 'Dohar', 'দোহার', 'dohar.dhaka.gov.bd'),
(370, 60, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর', 'sadar.munshiganj.gov.bd'),
(371, 60, 'Sreenagar', 'শ্রীনগর', 'sreenagar.munshiganj.gov.bd'),
(372, 60, 'Sirajdikhan', 'সিরাজদিখান', 'sirajdikhan.munshiganj.gov.bd'),
(373, 60, 'Louhajanj', 'লৌহজং', 'louhajanj.munshiganj.gov.bd'),
(374, 60, 'Gajaria', 'গজারিয়া', 'gajaria.munshiganj.gov.bd'),
(375, 60, 'Tongibari', 'টংগীবাড়ি', 'tongibari.munshiganj.gov.bd'),
(376, 61, 'Rajbari Sadar', 'রাজবাড়ী সদর', 'sadar.rajbari.gov.bd'),
(377, 61, 'Goalanda', 'গোয়ালন্দ', 'goalanda.rajbari.gov.bd'),
(378, 61, 'Pangsa', 'পাংশা', 'pangsa.rajbari.gov.bd'),
(379, 61, 'Baliakandi', 'বালিয়াকান্দি', 'baliakandi.rajbari.gov.bd'),
(380, 61, 'Kalukhali', 'কালুখালী', 'kalukhali.rajbari.gov.bd'),
(381, 62, 'Madaripur Sadar', 'মাদারীপুর সদর', 'sadar.madaripur.gov.bd'),
(382, 62, 'Shibchar', 'শিবচর', 'shibchar.madaripur.gov.bd'),
(383, 62, 'Kalkini', 'কালকিনি', 'kalkini.madaripur.gov.bd'),
(384, 62, 'Rajoir', 'রাজৈর', 'rajoir.madaripur.gov.bd'),
(385, 64, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', 'sadar.gopalganj.gov.bd'),
(386, 64, 'Kashiani', 'কাশিয়ানী', 'kashiani.gopalganj.gov.bd'),
(387, 64, 'Tungipara', 'টুংগীপাড়া', 'tungipara.gopalganj.gov.bd'),
(388, 64, 'Kotalipara', 'কোটালীপাড়া', 'kotalipara.gopalganj.gov.bd'),
(389, 64, 'Muksudpur', 'মুকসুদপুর', 'muksudpur.gopalganj.gov.bd'),
(390, 63, 'Faridpur Sadar', 'ফরিদপুর সদর', 'sadar.faridpur.gov.bd'),
(391, 63, 'Alfadanga', 'আলফাডাঙ্গা', 'alfadanga.faridpur.gov.bd'),
(392, 63, 'Boalmari', 'বোয়ালমারী', 'boalmari.faridpur.gov.bd'),
(393, 63, 'Sadarpur', 'সদরপুর', 'sadarpur.faridpur.gov.bd'),
(394, 63, 'Nagarkanda', 'নগরকান্দা', 'nagarkanda.faridpur.gov.bd'),
(395, 63, 'Bhanga', 'ভাঙ্গা', 'bhanga.faridpur.gov.bd'),
(396, 63, 'Charbhadrasan', 'চরভদ্রাসন', 'charbhadrasan.faridpur.gov.bd'),
(397, 63, 'Madhukhali', 'মধুখালী', 'madhukhali.faridpur.gov.bd'),
(398, 63, 'Saltha', 'সালথা', 'saltha.faridpur.gov.bd'),
(399, 40, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 'panchagarhsadar.panchagarh.gov.bd'),
(400, 40, 'Debiganj', 'দেবীগঞ্জ', 'debiganj.panchagarh.gov.bd'),
(401, 40, 'Boda', 'বোদা', 'boda.panchagarh.gov.bd'),
(402, 40, 'Atwari', 'আটোয়ারী', 'atwari.panchagarh.gov.bd'),
(403, 40, 'Tetulia', 'তেতুলিয়া', 'tetulia.panchagarh.gov.bd'),
(404, 41, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dinajpur.gov.bd'),
(405, 41, 'Birganj', 'বীরগঞ্জ', 'birganj.dinajpur.gov.bd'),
(406, 41, 'Ghoraghat', 'ঘোড়াঘাট', 'ghoraghat.dinajpur.gov.bd'),
(407, 41, 'Birampur', 'বিরামপুর', 'birampur.dinajpur.gov.bd'),
(408, 41, 'Parbatipur', 'পার্বতীপুর', 'parbatipur.dinajpur.gov.bd'),
(409, 41, 'Bochaganj', 'বোচাগঞ্জ', 'bochaganj.dinajpur.gov.bd'),
(410, 41, 'Kaharol', 'কাহারোল', 'kaharol.dinajpur.gov.bd'),
(411, 41, 'Fulbari', 'ফুলবাড়ী', 'fulbari.dinajpur.gov.bd'),
(412, 41, 'Dinajpur Sadar', 'দিনাজপুর সদর', 'dinajpursadar.dinajpur.gov.bd'),
(413, 41, 'Hakimpur', 'হাকিমপুর', 'hakimpur.dinajpur.gov.bd'),
(414, 41, 'Khansama', 'খানসামা', 'khansama.dinajpur.gov.bd'),
(415, 41, 'Birol', 'বিরল', 'birol.dinajpur.gov.bd'),
(416, 41, 'Chirirbandar', 'চিরিরবন্দর', 'chirirbandar.dinajpur.gov.bd'),
(417, 42, 'Lalmonirhat Sadar', 'লালমনিরহাট সদর', 'sadar.lalmonirhat.gov.bd'),
(418, 42, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.lalmonirhat.gov.bd'),
(419, 42, 'Hatibandha', 'হাতীবান্ধা', 'hatibandha.lalmonirhat.gov.bd'),
(420, 42, 'Patgram', 'পাটগ্রাম', 'patgram.lalmonirhat.gov.bd'),
(421, 42, 'Aditmari', 'আদিতমারী', 'aditmari.lalmonirhat.gov.bd'),
(422, 43, 'Syedpur', 'সৈয়দপুর', 'syedpur.nilphamari.gov.bd'),
(423, 43, 'Domar', 'ডোমার', 'domar.nilphamari.gov.bd'),
(424, 43, 'Dimla', 'ডিমলা', 'dimla.nilphamari.gov.bd'),
(425, 43, 'Jaldhaka', 'জলঢাকা', 'jaldhaka.nilphamari.gov.bd'),
(426, 43, 'Kishorganj', 'কিশোরগঞ্জ', 'kishorganj.nilphamari.gov.bd'),
(427, 43, 'Nilphamari Sadar', 'নীলফামারী সদর', 'nilphamarisadar.nilphamari.gov.bd'),
(428, 44, 'Sadullapur', 'সাদুল্লাপুর', 'sadullapur.gaibandha.gov.bd'),
(429, 44, 'Gaibandha Sadar', 'গাইবান্ধা সদর', 'gaibandhasadar.gaibandha.gov.bd'),
(430, 44, 'Palashbari', 'পলাশবাড়ী', 'palashbari.gaibandha.gov.bd'),
(431, 44, 'Saghata', 'সাঘাটা', 'saghata.gaibandha.gov.bd'),
(432, 44, 'Gobindaganj', 'গোবিন্দগঞ্জ', 'gobindaganj.gaibandha.gov.bd'),
(433, 44, 'Sundarganj', 'সুন্দরগঞ্জ', 'sundarganj.gaibandha.gov.bd'),
(434, 44, 'Phulchari', 'ফুলছড়ি', 'phulchari.gaibandha.gov.bd'),
(435, 45, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', 'thakurgaonsadar.thakurgaon.gov.bd'),
(436, 45, 'Pirganj', 'পীরগঞ্জ', 'pirganj.thakurgaon.gov.bd'),
(437, 45, 'Ranisankail', 'রাণীশংকৈল', 'ranisankail.thakurgaon.gov.bd'),
(438, 45, 'Haripur', 'হরিপুর', 'haripur.thakurgaon.gov.bd'),
(439, 45, 'Baliadangi', 'বালিয়াডাঙ্গী', 'baliadangi.thakurgaon.gov.bd'),
(440, 46, 'Rangpur Sadar', 'রংপুর সদর', 'rangpursadar.rangpur.gov.bd'),
(441, 46, 'Gangachara', 'গংগাচড়া', 'gangachara.rangpur.gov.bd'),
(442, 46, 'Taragonj', 'তারাগঞ্জ', 'taragonj.rangpur.gov.bd'),
(443, 46, 'Badargonj', 'বদরগঞ্জ', 'badargonj.rangpur.gov.bd'),
(444, 46, 'Mithapukur', 'মিঠাপুকুর', 'mithapukur.rangpur.gov.bd'),
(445, 46, 'Pirgonj', 'পীরগঞ্জ', 'pirgonj.rangpur.gov.bd'),
(446, 46, 'Kaunia', 'কাউনিয়া', 'kaunia.rangpur.gov.bd'),
(447, 46, 'Pirgacha', 'পীরগাছা', 'pirgacha.rangpur.gov.bd'),
(448, 47, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 'kurigramsadar.kurigram.gov.bd'),
(449, 47, 'Nageshwari', 'নাগেশ্বরী', 'nageshwari.kurigram.gov.bd'),
(450, 47, 'Bhurungamari', 'ভুরুঙ্গামারী', 'bhurungamari.kurigram.gov.bd'),
(451, 47, 'Phulbari', 'ফুলবাড়ী', 'phulbari.kurigram.gov.bd'),
(452, 47, 'Rajarhat', 'রাজারহাট', 'rajarhat.kurigram.gov.bd'),
(453, 47, 'Ulipur', 'উলিপুর', 'ulipur.kurigram.gov.bd'),
(454, 47, 'Chilmari', 'চিলমারী', 'chilmari.kurigram.gov.bd'),
(455, 47, 'Rowmari', 'রৌমারী', 'rowmari.kurigram.gov.bd'),
(456, 47, 'Charrajibpur', 'চর রাজিবপুর', 'charrajibpur.kurigram.gov.bd'),
(457, 49, 'Sherpur Sadar', 'শেরপুর সদর', 'sherpursadar.sherpur.gov.bd'),
(458, 49, 'Nalitabari', 'নালিতাবাড়ী', 'nalitabari.sherpur.gov.bd'),
(459, 49, 'Sreebordi', 'শ্রীবরদী', 'sreebordi.sherpur.gov.bd'),
(460, 49, 'Nokla', 'নকলা', 'nokla.sherpur.gov.bd'),
(461, 49, 'Jhenaigati', 'ঝিনাইগাতী', 'jhenaigati.sherpur.gov.bd'),
(462, 50, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbaria.mymensingh.gov.bd'),
(463, 50, 'Trishal', 'ত্রিশাল', 'trishal.mymensingh.gov.bd'),
(464, 50, 'Bhaluka', 'ভালুকা', 'bhaluka.mymensingh.gov.bd'),
(465, 50, 'Muktagacha', 'মুক্তাগাছা', 'muktagacha.mymensingh.gov.bd'),
(466, 50, 'Mymensingh Sadar', 'ময়মনসিংহ সদর', 'mymensinghsadar.mymensingh.gov.bd'),
(467, 50, 'Dhobaura', 'ধোবাউড়া', 'dhobaura.mymensingh.gov.bd'),
(468, 50, 'Phulpur', 'ফুলপুর', 'phulpur.mymensingh.gov.bd'),
(469, 50, 'Haluaghat', 'হালুয়াঘাট', 'haluaghat.mymensingh.gov.bd'),
(470, 50, 'Gouripur', 'গৌরীপুর', 'gouripur.mymensingh.gov.bd'),
(471, 50, 'Gafargaon', 'গফরগাঁও', 'gafargaon.mymensingh.gov.bd'),
(472, 50, 'Iswarganj', 'ঈশ্বরগঞ্জ', 'iswarganj.mymensingh.gov.bd'),
(473, 50, 'Nandail', 'নান্দাইল', 'nandail.mymensingh.gov.bd'),
(474, 50, 'Tarakanda', 'তারাকান্দা', 'tarakanda.mymensingh.gov.bd'),
(475, 47, 'Jamalpur Sadar', 'জামালপুর সদর', 'jamalpursadar.jamalpur.gov.bd'),
(476, 47, 'Melandah', 'মেলান্দহ', 'melandah.jamalpur.gov.bd'),
(477, 47, 'Islampur', 'ইসলামপুর', 'islampur.jamalpur.gov.bd'),
(478, 47, 'Dewangonj', 'দেওয়ানগঞ্জ', 'dewangonj.jamalpur.gov.bd'),
(479, 47, 'Sarishabari', 'সরিষাবাড়ী', 'sarishabari.jamalpur.gov.bd'),
(480, 47, 'Madarganj', 'মাদারগঞ্জ', 'madarganj.jamalpur.gov.bd'),
(481, 47, 'Bokshiganj', 'বকশীগঞ্জ', 'bokshiganj.jamalpur.gov.bd'),
(482, 0, 'Barhatta', 'বারহাট্টা', 'barhatta.netrokona.gov.bd'),
(483, 0, 'Durgapur', 'দুর্গাপুর', 'durgapur.netrokona.gov.bd'),
(484, 51, 'Kendua', 'কেন্দুয়া', 'kendua.netrokona.gov.bd'),
(485, 51, 'Atpara', 'আটপাড়া', 'atpara.netrokona.gov.bd'),
(486, 51, 'Madan', 'মদন', 'madan.netrokona.gov.bd'),
(487, 51, 'Khaliajuri', 'খালিয়াজুরী', 'khaliajuri.netrokona.gov.bd'),
(488, 51, 'Kalmakanda', 'কলমাকান্দা', 'kalmakanda.netrokona.gov.bd'),
(489, 51, 'Mohongonj', 'মোহনগঞ্জ', 'mohongonj.netrokona.gov.bd'),
(490, 51, 'Purbadhala', 'পূর্বধলা', 'purbadhala.netrokona.gov.bd'),
(491, 51, 'Netrokona Sadar', 'নেত্রকোণা সদর', 'netrokonasadar.netrokona.gov.bd'),
(492, 52, 'Ramna', 'রমনা', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL DEFAULT 3 COMMENT '1=>Admin, 2=>Vendor,3=>User,4=>Guest User, 7=>Reseller',
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(256) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_image` varchar(256) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `is_approved` tinyint(4) NOT NULL DEFAULT 1,
  `reseller_discount_percent` decimal(11,2) NOT NULL DEFAULT 0.00,
  `prepaid_amount` decimal(11,2) NOT NULL DEFAULT 0.00,
  `wallet_balance` decimal(11,2) NOT NULL DEFAULT 0.00,
  `wallet_default_amount` int(255) NOT NULL DEFAULT 0,
  `income` decimal(11,2) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `phone`, `email`, `address`, `profile_image`, `email_verified_at`, `password`, `status`, `is_approved`, `reseller_discount_percent`, `prepaid_amount`, `wallet_balance`, `wallet_default_amount`, `income`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'MD SHISHIR', 'admin', '01600783291', 'haternagaley@gmail.com', 'narayanganj', '202409261732449396602_446226111598269_8789756751067222360_n.jpg', NULL, '$2y$10$2y71f6k3PyoQypbz1YzXz.UX4kcipGAFbzJhNUQ6AFb1nteCeagxG', 1, 1, 0.00, 0.00, 0.00, 0, NULL, NULL, '2024-09-24 09:33:07', '2024-09-26 11:32:42'),
(2, 3, 'liza', 'liza', '01755555555', 'liza@gmail.com', NULL, NULL, NULL, '$2y$10$dBI5BpfBF7R25Y6PNIFaxO.kRgQ/6ePT3jJhIVIx0tpiZamTYveWy', 1, 1, 0.00, 0.00, 0.00, 0, NULL, NULL, '2024-09-24 04:23:03', '2024-09-24 04:23:03'),
(3, 2, 'Hater Nagale', 'Hater-Nagale-HDVcY', '01526789432', 'ea.hossainclassicit@gmail.com', 'gkj@ yraar', NULL, NULL, '$2y$10$.wDzPqtEcbkzs.AKx93plejMnSDCnyB88l6qVtARg1m94VISMWVAy', 1, 1, 0.00, 0.00, 0.00, 0, NULL, NULL, '2024-09-25 04:47:50', '2024-09-25 04:47:50'),
(4, 3, 'Md soyshob', 'Soyshob', '01908840279', 'soyshob4205@gmail.com', NULL, NULL, NULL, '$2y$10$AerbwK7VsEQDDSAjwL8hR.svA8OswrtyrTu5oo.kLHKyA5lqGJ6fa', 1, 1, 0.00, 0.00, 0.00, 0, NULL, NULL, '2024-09-25 07:07:01', '2024-09-25 07:07:01'),
(5, 7, 'test', 'test', '01406787378', 'test@gamil.com', NULL, NULL, NULL, '$2y$10$KW6wvBEqS5BFoQBbziufL.4MicFzPkso7XqBjjon3W03TGNWO/U2C', 1, 1, 5.00, 0.00, 0.00, 400, NULL, NULL, '2024-09-25 22:45:48', '2024-09-25 23:52:34'),
(6, 7, 'test2', 'test2', '01911045596', 'test2@gmail.com', NULL, NULL, NULL, '$2y$10$4JfLYCBJA5unYAGZKfQZ4OmJBjiM4lk8.Cf7A.dv461vGerFrylki', 1, 1, 5.00, 0.00, 500.00, 300, NULL, NULL, '2024-09-26 01:26:54', '2024-09-26 06:20:26'),
(7, 3, 'Jitu', 'Jitu', '01811910595', 'im.shishir22.421@gmail.com', NULL, NULL, NULL, '$2y$10$VKeCv6B7iH7fQbrGMISiTukjXlC7URptusQZxwAjSAM06IFCYF66S', 1, 1, 0.00, 0.00, 0.00, 0, NULL, NULL, '2024-09-26 15:09:31', '2024-09-26 15:09:31'),
(8, 7, 'MD', 'eee', '01980265035', 'admin@gmail.com', NULL, NULL, NULL, '$2y$10$m0bDKvvkSOJOBZnUaC8I9urMy3RE9k4gMSR4ruZieyaWL.Ol5UN2S', 1, 1, 5.00, 0.00, 200.00, 500, NULL, NULL, '2024-09-26 22:06:21', '2024-09-26 22:07:36'),
(9, 7, 'OBYifEKujpBDT', 'VGgEkVPD', '3216486689', 'stephanie68colemanzzx@outlook.com', NULL, NULL, NULL, '$2y$10$3bKxfZHzLITBs7zRXQ8fhuNQmv.q21Piq1HKCCkDiD/unjCXXAtI6', 1, 1, 5.00, 0.00, 0.00, 500, NULL, NULL, '2024-09-26 22:38:02', '2024-09-27 03:13:04'),
(10, 1, 'admin1', 'admin1', '01755555551', 'admin1@gmail.com', NULL, NULL, NULL, '$2y$10$1HURvvNBC0ApHs3AIIVmrOEH192UAEsePuvpKjmfHla0sLJCJQRMG', 1, 1, 0.00, 0.00, 0.00, 0, NULL, NULL, '2024-09-28 05:14:54', '2024-09-28 05:14:54'),
(11, 3, 'Amar World', 'eaminhossain', '01406787379', 'ea.hossain75@gmail.com', NULL, NULL, NULL, '$2y$10$SAv/A5SKBC.jRTKVpDDIHe91RQVt2lJYiV3Un./pNH9dBsNEpxMwm', 1, 1, 0.00, 0.00, 0.00, 0, NULL, NULL, '2024-09-28 01:24:37', '2024-09-28 01:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `fb_url` varchar(100) DEFAULT NULL,
  `bank_information` varchar(255) DEFAULT NULL,
  `bank_account` varchar(80) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `holder_name` varchar(100) DEFAULT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `routing_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `commission` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `shop_profile` varchar(255) DEFAULT NULL,
  `shop_cover` varchar(255) DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `trade_license` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `user_id`, `vendor_name`, `shop_name`, `slug`, `fb_url`, `bank_information`, `bank_account`, `bank_name`, `holder_name`, `branch_name`, `routing_name`, `address`, `commission`, `description`, `shop_profile`, `shop_cover`, `nid`, `trade_license`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'Hater Nagale', 'Hater Nagale', 'Hater-Nagale-HDVcY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gkj@ yraar', '10', NULL, '', '', 'upload/vendor/1811164714100271.jpg', '', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL DEFAULT 0,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>Pending, 1=>Complete, 2=>Processing, 3=>Intransit',
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>Out, 1=>In',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` bigint(20) UNSIGNED DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_brunch` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_heads`
--
ALTER TABLE `account_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_ledgers`
--
ALTER TABLE `account_ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_ledgers_account_head_id_foreign` (`account_head_id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_product_product_id_foreign` (`product_id`),
  ADD KEY `attribute_product_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `attribute_value_product_price`
--
ALTER TABLE `attribute_value_product_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_value_product_price_product_price_id_foreign` (`product_price_id`),
  ADD KEY `attribute_value_product_price_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaings`
--
ALTER TABLE `campaings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaing_products`
--
ALTER TABLE `campaing_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaing_products_campaing_id_foreign` (`campaing_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
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
-- Indexes for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pos_carts`
--
ALTER TABLE `pos_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_prices_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_stocks_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `value` (`value`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_user_id_foreign` (`user_id`),
  ADD KEY `staff_role_id_foreign` (`role_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_phone_unique` (`phone`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_orders`
--
ALTER TABLE `temp_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazillas`
--
ALTER TABLE `upazillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `account_ledgers`
--
ALTER TABLE `account_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_product`
--
ALTER TABLE `attribute_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attribute_value_product_price`
--
ALTER TABLE `attribute_value_product_price`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `campaings`
--
ALTER TABLE `campaings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campaing_products`
--
ALTER TABLE `campaing_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_carts`
--
ALTER TABLE `pos_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_orders`
--
ALTER TABLE `temp_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upazillas`
--
ALTER TABLE `upazillas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=493;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_ledgers`
--
ALTER TABLE `account_ledgers`
  ADD CONSTRAINT `account_ledgers_account_head_id_foreign` FOREIGN KEY (`account_head_id`) REFERENCES `account_heads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD CONSTRAINT `attribute_product_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_value_product_price`
--
ALTER TABLE `attribute_value_product_price`
  ADD CONSTRAINT `attribute_value_product_price_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_value_product_price_product_price_id_foreign` FOREIGN KEY (`product_price_id`) REFERENCES `product_prices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campaing_products`
--
ALTER TABLE `campaing_products`
  ADD CONSTRAINT `campaing_products_campaing_id_foreign` FOREIGN KEY (`campaing_id`) REFERENCES `campaings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD CONSTRAINT `product_stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `temp_orders`
--
ALTER TABLE `temp_orders`
  ADD CONSTRAINT `temp_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
