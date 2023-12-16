-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 27, 2023 at 09:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_type` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_number` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_issue_date` date NOT NULL,
  `ID_expiry_date` date NOT NULL,
  `businessName` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `businessType` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `businessAddress` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenceFilePath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenceNumber` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issueDate` date NOT NULL,
  `expiryDate` date NOT NULL,
  `tinNumber` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `businessEstablishmentYear` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double(8,2) DEFAULT NULL,
  `longtude` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `user_id`, `address`, `mobile`, `id_file_path`, `ID_type`, `ID_number`, `ID_issue_date`, `ID_expiry_date`, `businessName`, `businessType`, `businessAddress`, `licenceFilePath`, `licenceNumber`, `issueDate`, `expiryDate`, `tinNumber`, `businessEstablishmentYear`, `latitude`, `longtude`, `created_at`, `updated_at`) VALUES
(1, 70, 'Hawassa', '0909090909', '1670579802.jfif', 'Wordera ID', '123456', '2022-01-09', '2022-12-28', 'Abebe', 'Retail', 'Hawassa', '1670579802.jfif', '123456', '2022-11-27', '2023-01-06', '1234567889', '2022', NULL, NULL, '2022-12-09 06:56:42', '2022-12-09 06:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `business_types`
--

CREATE TABLE `business_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `businessName` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_types`
--

INSERT INTO `business_types` (`id`, `businessName`, `created_at`, `updated_at`) VALUES
(1, 'Retail', NULL, NULL),
(2, 'Tailor', NULL, NULL),
(3, 'Mini-market', NULL, NULL),
(4, 'Super-market', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `QRPassword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PinCode` int(11) NOT NULL,
  `client_address` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_mobile` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_filepath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_type` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_businessName` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_businessType` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_BusinessRegisteration` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_yearsInBusiness` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_latitude` double(10,8) DEFAULT NULL,
  `client_longtude` double(11,8) DEFAULT NULL,
  `client_verificationData` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distro_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `QRPassword`, `PinCode`, `client_address`, `client_mobile`, `id_filepath`, `ID_type`, `client_businessName`, `client_businessType`, `client_BusinessRegisteration`, `client_yearsInBusiness`, `client_latitude`, `client_longtude`, `client_verificationData`, `distro_id`, `created_at`, `updated_at`) VALUES
(1, 3, '3bd4017318837e92a66298c7855f4427', 1122, 'Yirgalem', '0916927134/0968650251', NULL, NULL, 'Gelaye', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:06:25', '2022-12-07 10:06:25'),
(2, 4, 'd790c9e6c0b5e02c87b375e782ac01bc', 1133, 'Yirgalem', '0909495600', NULL, NULL, 'Meron', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:10:39', '2022-12-07 10:10:39'),
(3, 5, '110eec23201d80e40d0c4a48954e2ff5', 1144, 'Mulunesh', '0926052715/0953360035', NULL, NULL, 'Mulunesh', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:21:02', '2022-12-07 10:21:02'),
(4, 6, '577fd60255d4bb0f466464849ffe6d8e', 1155, 'Yirgalem', '0900000000', NULL, NULL, 'Shitaye', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:24:22', '2022-12-07 10:24:22'),
(5, 7, '362387494f6be6613daea643a7706a42', 1166, 'Wenisho', '0938076415', NULL, NULL, 'Hiwot', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:33:57', '2022-12-07 10:33:57'),
(6, 8, '33267e5dc58fad346e92471c43fcccdc', 1177, 'wenisho', '0904106881/0945634131', NULL, NULL, 'Debritu', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:37:55', '2022-12-07 10:37:55'),
(7, 9, '058d6f2fbe951a5a56d96b1f1a6bca1c', 1188, 'Wenisho', '0924653502/0913364802', NULL, NULL, 'Aberashi', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:43:14', '2022-12-07 10:43:14'),
(8, 10, '$2y$10$oToX01dX2s.w6NspWzWSK.HWJ4UEwPkib', 1199, 'wenisho', '0937282995/0926989111', NULL, NULL, 'Zelalem', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:51:09', '2022-12-07 10:51:09'),
(9, 11, 'c315f0320b7cd4ec85756fac52d78076', 1211, 'wenisho', '0928588546/0953376847', NULL, NULL, 'Almaz', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 10:56:50', '2022-12-07 10:56:50'),
(10, 12, 'cdd96eedd7f695f4d61802f8105ba2b0', 1212, 'wenisho', '0924655797', NULL, NULL, 'Bekelech', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:00:54', '2022-12-07 11:00:54'),
(11, 13, 'fa2e8c4385712f9a1d24c363a2cbe5b8', 1213, 'wenisho', '0996787136', NULL, NULL, 'Birke', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:03:22', '2022-12-07 11:03:22'),
(12, 14, 'b628386c9b92481fab68fbf284bd6a64', 1214, 'Chiko', '0901582556/0916950508', NULL, NULL, 'Abebu', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:07:31', '2022-12-07 11:07:31'),
(13, 15, 'ff2cc3b8c7caeaa068f2abbc234583f5', 1215, 'Chiko', '0927808555/0925645310', NULL, NULL, 'Hirut', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:11:14', '2022-12-07 11:11:14'),
(14, 16, 'de594ef5c314372edec29b93cab9d72e', 1216, 'Chiko', '0905211891/0916433682', NULL, NULL, 'Gedamnesh', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:16:13', '2022-12-07 11:16:13'),
(15, 17, '5a99158e0c52f9e7d290906c9d08268d', 1217, 'Chiko', '0916942095', NULL, NULL, 'Aynalem', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:20:35', '2022-12-07 11:20:35'),
(16, 18, '65f2a94c8c2d56d5b43a1a3d9d811102', 1218, 'Chiko', '0905092696', NULL, NULL, 'Lemlem', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:23:51', '2022-12-07 11:23:51'),
(17, 19, '825f9cd5f0390bc77c1fed3c94885c87', 1219, 'Chiko', '0916141132/0925154945', NULL, NULL, 'Abebu', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:26:54', '2022-12-07 11:26:54'),
(18, 20, 'b38e5ff5f816ac6e4169bce9314b2996', 1200, 'leku', '0961624956/09165018005', NULL, NULL, 'Zewditu', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:30:04', '2022-12-07 11:30:04'),
(19, 21, '220c77af02f8ad8561b150d93000ddff', 1234, 'Wondogenet', '0989926704', NULL, NULL, 'Aster', 'Retail', 'New', '2002', 7.11195330, 38.61186530, NULL, 2, '2022-12-07 11:33:06', '2022-12-07 11:33:06'),
(20, 22, '403ea2e851b9ab04a996beab4a480a30', 1234, 'Chiko', '0916435546', NULL, NULL, 'Hana', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:42:57', '2022-12-07 11:42:57'),
(21, 23, 'dbbf603ff0e99629dda5d75b6f75f966', 1313, 'wondogenet', '0986152264/0935941962', NULL, NULL, 'Lamrot', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:47:21', '2022-12-07 11:47:21'),
(22, 24, 'df0e09d6f25a15a815563df9827f48fa', 1314, 'wondogenet', '0976670057', NULL, NULL, 'Wegaye', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:50:03', '2022-12-07 11:50:03'),
(23, 25, '2e7ceec8361275c4e31fee5fe422740b', 1315, 'Wondogent', '0936531729/0912191929', NULL, NULL, 'Birtukan', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:53:18', '2022-12-07 11:53:18'),
(24, 26, '0415740eaa4d9decbc8da001d3fd805f', 1316, 'wondogenet', '0985099764', NULL, NULL, 'Tsehay', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:55:55', '2022-12-07 11:55:55'),
(25, 27, 'ab452534c5ce28c4fbb0e102d4a4fb2e', 1317, 'Wondogenet', '0910523857', NULL, NULL, 'Etenesh', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 11:59:46', '2022-12-07 11:59:46'),
(26, 28, 'fb4ab556bc42d6f0ee0f9e24ec4d1af0', 1318, 'Wondogenet', '0928437120', NULL, NULL, 'Beletech', 'Retail', 'New', '2002', NULL, NULL, NULL, 2, '2022-12-07 12:05:56', '2022-12-07 12:05:56'),
(28, 38, '03fa2f7502f5f6b9169e67d17cbf51bb', 9946, 'Chiko', '0916169232', NULL, NULL, 'Bizuayehu', 'Retail', 'new', '1999', NULL, NULL, NULL, 2, '2022-12-08 08:56:31', '2022-12-08 08:56:31'),
(29, 39, '2e74c2cf88f68a68c84e9509abc7ea56', 2689, 'Hawassa International Airport - AWA, Hawassa, Ethiopia', '0926434214', NULL, NULL, 'Tejtu', 'Retail', 'new', '2002', 7.09464040, 38.40046930, NULL, 2, '2022-12-08 09:09:58', '2022-12-08 09:09:58'),
(30, 40, '81c2f886f91e18fe16d6f4e865877cb6', 6704, 'Wondo Genet Hot water and recreation ወንዶ ገነት ፍል ውሃ እና መዝናኛ, Wondo Genet, Ethiopia', '0989926704', NULL, NULL, 'Firehiwot', 'Retail', 'new', '2002', 7.08127530, 38.63780190, NULL, 2, '2022-12-08 09:14:39', '2022-12-08 09:14:39'),
(31, 43, 'cf9b2d0406020c56599f9a93708832b5', 7981, 'Wondo Genet Hot water and recreation ወንዶ ገነት ፍል ውሃ እና መዝናኛ, Wondo Genet, Ethiopia', '0995517981', NULL, NULL, 'Mestawot', 'Retail', 'new', '2002', 7.08127530, 38.63780190, NULL, 2, '2022-12-08 09:17:31', '2022-12-08 09:17:31'),
(32, 44, 'f6185f0ef02dcaec414a3171cd01c697', 8018, 'Wondo Genet Hot water and recreation ወንዶ ገነት ፍል ውሃ እና መዝናኛ, Wondo Genet, Ethiopia', '0984028018', NULL, NULL, 'Asnakech', 'Retail', 'new', '2002', 7.08127530, 38.63780190, NULL, 2, '2022-12-08 09:19:34', '2022-12-08 09:19:34'),
(33, 46, 'dc2b690516158a874dd8aabe1365c6a0', 1534, 'Wondo Genet Hot water and recreation ወንዶ ገነት ፍል ውሃ እና መዝናኛ, Wondo Genet, Ethiopia', '0916840534', NULL, NULL, 'Tizita', 'Retail', 'new', '2002', 7.08127530, 38.63780190, NULL, 2, '2022-12-08 09:23:31', '2022-12-08 09:23:31'),
(34, 48, 'bbeb0c1b1fd44e392c7ce2fdbd137e87', 9738, 'Chiko', '0972779738', NULL, NULL, 'Meseret', 'Retail', 'new', '2002', 7.05105040, 38.49698750, NULL, 2, '2022-12-08 09:28:21', '2022-12-08 09:28:21'),
(35, 51, 'ad47a008a2f806aa6eb1b53852cd8b37', 5797, 'wenisho', '0924655797', NULL, NULL, 'Wereke', 'Retail', 'new', '2002', NULL, NULL, NULL, 2, '2022-12-08 09:33:28', '2022-12-08 09:33:28'),
(36, 52, 'xyz', 2808, 'Yirgalem Agro Industrail Park(YIAIP), Yirga Alem, Ethiopia', '0937282808', NULL, NULL, 'Woyneshet', 'Retail', 'new', '2002', 6.74681640, 38.41399220, NULL, 2, '2022-12-08 10:23:56', '2022-12-08 10:23:56'),
(37, 53, '2d95666e2649fcfc6e3af75e09f5adb9', 1149, 'wenisho', '0905560149', NULL, NULL, 'Woyneshet', 'Retail', 'new', '2002', NULL, NULL, NULL, 2, '2022-12-08 10:27:25', '2022-12-08 10:27:25'),
(38, 54, 'asd', 8952, 'Chiko', '0979618952', NULL, NULL, 'Sisay', 'Retail', 'new', '2002', NULL, NULL, NULL, 2, '2022-12-08 10:29:25', '2022-12-08 10:29:25'),
(39, 55, 'asdf', 9049, 'Wondo Genet Hot water and recreation ወንዶ ገነት ፍል ውሃ እና መዝናኛ, Wondo Genet, Ethiopia', '0924289049', NULL, NULL, 'Mulatw', 'Retail', 'new', '2002', 7.08127530, 38.63780190, NULL, 2, '2022-12-08 10:31:27', '2022-12-08 10:31:27'),
(40, 56, 'c315f0320b7cd4ec85756fac52d78076', 6130, 'Wenisho', '0954806130', NULL, NULL, 'Marta', 'Retail', 'new', '2002', NULL, NULL, NULL, 2, '2022-12-08 10:33:48', '2022-12-08 10:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `delivery1s`
--

CREATE TABLE `delivery1s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_id` bigint(20) UNSIGNED NOT NULL,
  `rom_id` bigint(20) UNSIGNED NOT NULL,
  `confirmationStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unconfirmed',
  `handoverStatus` enum('confirmed','unconfirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unconfirmed',
  `deliveryTotalPrice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery1s`
--

INSERT INTO `delivery1s` (`id`, `kd_id`, `rom_id`, `confirmationStatus`, `handoverStatus`, `deliveryTotalPrice`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 2, 67, 'confirmed', 'confirmed', '6106.34', 2, '2023-01-30 10:09:22', '2023-01-30 11:04:27'),
(2, 2, 67, 'confirmed', 'confirmed', '7012.34', 3, '2023-01-30 10:10:37', '2023-01-30 11:05:54'),
(3, 2, 67, 'confirmed', 'confirmed', '6106.34', 4, '2023-01-30 10:11:41', '2023-01-30 11:06:53'),
(4, 2, 67, 'confirmed', 'confirmed', '5494.34', 5, '2023-01-30 10:12:53', '2023-01-30 11:07:48'),
(5, 2, 67, 'confirmed', 'confirmed', '17399.78', 6, '2023-01-30 10:16:03', '2023-01-30 11:09:02'),
(6, 2, 67, 'confirmed', 'confirmed', '6275.42', 7, '2023-01-30 10:17:38', '2023-01-30 11:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `delivery1_products`
--

CREATE TABLE `delivery1_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `delivered_quantity` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subTotal` double DEFAULT NULL,
  `delivery1_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery1_products`
--

INSERT INTO `delivery1_products` (`id`, `product_id`, `delivered_quantity`, `subTotal`, `delivery1_id`, `created_at`, `updated_at`) VALUES
(1, 3, '72', 1699.92, 1, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(2, 4, '72', 1699.92, 1, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(3, 1, '120', 294, 1, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(4, 19, '72', 612, 1, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(5, 15, '50', 1800.5, 1, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(6, 3, '72', 1699.92, 2, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(7, 4, '72', 1699.92, 2, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(8, 15, '50', 1800.5, 2, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(9, 1, '240', 588, 2, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(10, 19, '144', 1224, 2, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(11, 3, '72', 1699.92, 3, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(12, 4, '72', 1699.92, 3, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(13, 1, '120', 294, 3, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(14, 15, '50', 1800.5, 3, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(15, 19, '72', 612, 3, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(16, 3, '72', 1699.92, 4, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(17, 4, '72', 1699.92, 4, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(18, 1, '120', 294, 4, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(19, 15, '50', 1800.5, 4, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(20, 3, '72', 1699.92, 5, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(21, 4, '72', 1699.92, 5, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(22, 1, '240', 588, 5, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(23, 19, '72', 612, 5, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(24, 15, '50', 1800.5, 5, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(25, 17, '72', 10999.44, 5, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(26, 3, '72', 1699.92, 6, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(27, 4, '72', 1699.92, 6, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(28, 15, '50', 1800.5, 6, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(29, 19, '72', 612, 6, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(30, 1, '120', 294, 6, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(31, 20, '2', 169.08, 6, '2023-01-30 10:17:38', '2023-01-30 10:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `delivery2s`
--

CREATE TABLE `delivery2s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rom_id` bigint(20) UNSIGNED NOT NULL,
  `rsp_id` bigint(20) UNSIGNED NOT NULL,
  `confirmationStatus` enum('confirmed','unconfirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unconfirmed',
  `deliveryTotalPrice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery2s`
--

INSERT INTO `delivery2s` (`id`, `rom_id`, `rsp_id`, `confirmationStatus`, `deliveryTotalPrice`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 67, 71, 'confirmed', '6106.34', 2, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(2, 67, 71, 'confirmed', '7012.34', 3, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(3, 67, 71, 'confirmed', '6106.34', 4, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(4, 67, 71, 'confirmed', '5494.34', 5, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(5, 67, 71, 'confirmed', '17399.78', 6, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(6, 67, 71, 'confirmed', '6275.42', 7, '2023-01-30 11:10:11', '2023-01-30 11:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `delivery2_products`
--

CREATE TABLE `delivery2_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `delivered_quantity` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subTotal` double DEFAULT NULL,
  `delivery2_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery2_products`
--

INSERT INTO `delivery2_products` (`id`, `product_id`, `delivered_quantity`, `subTotal`, `delivery2_id`, `created_at`, `updated_at`) VALUES
(2, 3, '72', 1699.92, 1, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(3, 4, '72', 1699.92, 1, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(4, 1, '120', 294, 1, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(5, 19, '72', 612, 1, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(6, 15, '50', 1800.5, 1, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(7, 3, '72', 1699.92, 2, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(8, 4, '72', 1699.92, 2, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(9, 15, '50', 1800.5, 2, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(10, 1, '240', 588, 2, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(11, 19, '144', 1224, 2, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(12, 3, '72', 1699.92, 3, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(13, 4, '72', 1699.92, 3, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(14, 1, '120', 294, 3, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(15, 15, '50', 1800.5, 3, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(16, 19, '72', 612, 3, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(17, 3, '72', 1699.92, 4, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(18, 4, '72', 1699.92, 4, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(19, 1, '120', 294, 4, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(20, 15, '50', 1800.5, 4, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(21, 3, '72', 1699.92, 5, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(22, 4, '72', 1699.92, 5, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(23, 1, '240', 588, 5, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(24, 19, '72', 612, 5, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(25, 15, '50', 1800.5, 5, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(26, 17, '72', 10999.44, 5, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(27, 3, '72', 1699.92, 6, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(28, 4, '72', 1699.92, 6, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(29, 15, '50', 1800.5, 6, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(30, 19, '72', 612, 6, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(31, 1, '120', 294, 6, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(32, 20, '2', 169.08, 6, '2023-01-30 11:10:11', '2023-01-30 11:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `delivery3s`
--

CREATE TABLE `delivery3s` (
  `id` bigint(20) NOT NULL,
  `rsp_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery3s`
--

INSERT INTO `delivery3s` (`id`, `rsp_id`, `order_id`, `client_id`, `delivery_status`, `createdAt`) VALUES
(20, 71, 7, 56, 'delivered', '2022-12-15 13:47:29'),
(21, 71, 3, 9, 'delivered', '2022-12-15 13:33:49'),
(22, 71, 5, 12, 'delivered', '2022-12-15 13:36:40'),
(23, 71, 4, 13, 'delivered', '2022-12-15 13:33:48'),
(24, 71, 6, 11, 'delivered', '2022-12-15 13:33:55'),
(25, 71, 2, 53, 'delivered', '2022-12-15 13:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `delivery3_products`
--

CREATE TABLE `delivery3_products` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `delivered_quantity` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subTotal` double DEFAULT NULL,
  `delivery3_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_4products`
--

CREATE TABLE `delivery_4products` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `delivered_quantity` char(255) NOT NULL,
  `subTotal` double NOT NULL,
  `delivery4_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_4s`
--

CREATE TABLE `delivery_4s` (
  `id` bigint(20) NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `confirmation_status` enum('confirmed','unconfirmed') DEFAULT NULL,
  `deliveryTotalPrice` varchar(255) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `handover_hierarchies`
--

CREATE TABLE `handover_hierarchies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hierarchyName` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `handover_hierarchies`
--

INSERT INTO `handover_hierarchies` (`id`, `hierarchyName`, `created_at`, `updated_at`) VALUES
(1, 'hierarchy1', NULL, NULL),
(2, 'hierarchy2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `handover_hierarchy`
--

CREATE TABLE `handover_hierarchy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `id_types`
--

CREATE TABLE `id_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idTypeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `id_types`
--

INSERT INTO `id_types` (`id`, `idTypeName`, `created_at`, `updated_at`) VALUES
(1, 'Wordera ID', NULL, NULL),
(2, 'Passport', NULL, NULL),
(3, 'Driving Licence', NULL, NULL),
(4, 'Temporary ID', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `key_distros`
--

CREATE TABLE `key_distros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_type` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_number` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_issue_date` date NOT NULL,
  `ID_expiry_date` date NOT NULL,
  `businessName` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `businessType` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `businessAddress` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenceFilePath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licenceNumber` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issueDate` date NOT NULL,
  `expiryDate` date NOT NULL,
  `tinNumber` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `businessEstablishmentYear` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double(8,2) DEFAULT NULL,
  `longtude` double(8,2) DEFAULT NULL,
  `verificationData` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `key_distros`
--

INSERT INTO `key_distros` (`id`, `user_id`, `address`, `mobile`, `id_file_path`, `ID_type`, `ID_number`, `ID_issue_date`, `ID_expiry_date`, `businessName`, `businessType`, `businessAddress`, `licenceFilePath`, `licenceNumber`, `issueDate`, `expiryDate`, `tinNumber`, `businessEstablishmentYear`, `latitude`, `longtude`, `verificationData`, `created_at`, `updated_at`) VALUES
(1, 2, 'Blue-hora', '0911152025', '1675088727.jpg', 'Wordera ID', '123456', '2022-11-01', '2022-12-10', 'Ke', 'Mini-market', 'Addis Ababa Bole International Airport, Addis Ababa, Ethiopia', '1675088727.jpg', '000000', '2022-11-01', '2022-11-30', '123456', '2002', NULL, NULL, NULL, '2022-11-29 03:22:14', '2023-01-30 11:25:27');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_15_184412_create_key_distros_table', 1),
(6, '2022_08_15_185258_create_clients_table', 1),
(7, '2022_08_18_125359_create_roms_table', 1),
(8, '2022_08_18_162636_create_rsps_table', 1),
(9, '2022_08_18_175040_create_agents_table', 1),
(10, '2022_08_19_193209_create_business_types_table', 1),
(11, '2022_08_24_235435_create_product_catagories_table', 1),
(12, '2022_08_25_000209_create_products_table', 1),
(13, '2022_08_25_190225_create_orders_table', 1),
(14, '2022_08_25_190437_create_ordered_products_table', 1),
(15, '2022_08_29_172420_create_delivery1s_table', 1),
(16, '2022_08_29_173446_create_delivery1_products_table', 1),
(17, '2022_08_31_180810_create_delivery2s_table', 1),
(18, '2022_08_31_181203_create_delivery2_products_table', 1),
(19, '2022_09_05_124146_create_undelivered_orders_table', 1),
(20, '2022_09_05_124307_create_undelivered1_products_table', 1),
(21, '2022_09_05_185401_create_undelivered2_orders_table', 1),
(22, '2022_09_05_185416_create_undelivered2_products_table', 1),
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_15_184412_create_key_distros_table', 1),
(6, '2022_08_15_185258_create_clients_table', 1),
(7, '2022_08_18_125359_create_roms_table', 1),
(8, '2022_08_18_162636_create_rsps_table', 1),
(9, '2022_08_18_175040_create_agents_table', 1),
(10, '2022_08_19_193209_create_business_types_table', 1),
(11, '2022_08_24_235435_create_product_catagories_table', 1),
(12, '2022_08_25_000209_create_products_table', 1),
(13, '2022_08_25_190225_create_orders_table', 1),
(14, '2022_08_25_190437_create_ordered_products_table', 1),
(15, '2022_08_29_172420_create_delivery1s_table', 1),
(16, '2022_08_29_173446_create_delivery1_products_table', 1),
(17, '2022_08_31_180810_create_delivery2s_table', 1),
(18, '2022_08_31_181203_create_delivery2_products_table', 1),
(19, '2022_09_05_124146_create_undelivered_orders_table', 1),
(20, '2022_09_05_124307_create_undelivered1_products_table', 1),
(21, '2022_09_05_185401_create_undelivered2_orders_table', 1),
(22, '2022_09_05_185416_create_undelivered2_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `ordered_quantity` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subTotal` double DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `product_id`, `ordered_quantity`, `subTotal`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 3, '72', 1699.92, 2, '2023-01-30 09:08:19', '2023-01-30 09:08:19'),
(2, 4, '72', 1699.92, 2, '2023-01-30 09:08:19', '2023-01-30 09:08:19'),
(3, 1, '120', 294, 2, '2023-01-30 09:08:19', '2023-01-30 09:08:19'),
(4, 19, '72', 612, 2, '2023-01-30 09:08:19', '2023-01-30 09:08:19'),
(5, 15, '50', 1800.5, 2, '2023-01-30 09:08:19', '2023-01-30 09:08:19'),
(6, 3, '72', 1699.92, 3, '2023-01-30 09:14:08', '2023-01-30 09:14:08'),
(7, 4, '72', 1699.92, 3, '2023-01-30 09:14:08', '2023-01-30 09:14:08'),
(8, 15, '50', 1800.5, 3, '2023-01-30 09:14:08', '2023-01-30 09:14:08'),
(9, 1, '240', 588, 3, '2023-01-30 09:14:08', '2023-01-30 09:14:08'),
(10, 19, '144', 1224, 3, '2023-01-30 09:14:09', '2023-01-30 09:14:09'),
(11, 3, '72', 1699.92, 4, '2023-01-30 09:17:21', '2023-01-30 09:17:21'),
(12, 4, '72', 1699.92, 4, '2023-01-30 09:17:21', '2023-01-30 09:17:21'),
(13, 1, '120', 294, 4, '2023-01-30 09:17:21', '2023-01-30 09:17:21'),
(14, 15, '50', 1800.5, 4, '2023-01-30 09:17:21', '2023-01-30 09:17:21'),
(15, 19, '72', 612, 4, '2023-01-30 09:17:21', '2023-01-30 09:17:21'),
(16, 3, '72', 1699.92, 5, '2023-01-30 09:19:17', '2023-01-30 09:19:17'),
(17, 4, '72', 1699.92, 5, '2023-01-30 09:19:17', '2023-01-30 09:19:17'),
(18, 1, '120', 294, 5, '2023-01-30 09:19:17', '2023-01-30 09:19:17'),
(19, 15, '50', 1800.5, 5, '2023-01-30 09:19:17', '2023-01-30 09:19:17'),
(20, 3, '72', 1699.92, 6, '2023-01-30 09:24:21', '2023-01-30 09:24:21'),
(21, 4, '72', 1699.92, 6, '2023-01-30 09:24:21', '2023-01-30 09:24:21'),
(22, 1, '240', 588, 6, '2023-01-30 09:24:21', '2023-01-30 09:24:21'),
(23, 19, '72', 612, 6, '2023-01-30 09:24:21', '2023-01-30 09:24:21'),
(24, 15, '50', 1800.5, 6, '2023-01-30 09:24:21', '2023-01-30 09:24:21'),
(25, 17, '72', 10999.44, 6, '2023-01-30 09:24:21', '2023-01-30 09:24:21'),
(26, 3, '72', 1699.92, 7, '2023-01-30 09:30:49', '2023-01-30 09:30:49'),
(27, 4, '72', 1699.92, 7, '2023-01-30 09:30:49', '2023-01-30 09:30:49'),
(28, 15, '50', 1800.5, 7, '2023-01-30 09:30:49', '2023-01-30 09:30:49'),
(29, 19, '72', 612, 7, '2023-01-30 09:30:49', '2023-01-30 09:30:49'),
(30, 1, '120', 294, 7, '2023-01-30 09:30:49', '2023-01-30 09:30:49'),
(31, 20, '2', 169.08, 7, '2023-01-30 09:30:49', '2023-01-30 09:30:49'),
(32, 15, '100', 3601, 8, '2023-01-30 09:37:49', '2023-01-30 09:37:49'),
(33, 4, '216', 5099.76, 8, '2023-01-30 09:37:49', '2023-01-30 09:37:49'),
(34, 19, '72', 612, 8, '2023-01-30 09:37:49', '2023-01-30 09:37:49'),
(35, 4, '216', 5099.76, 9, '2023-01-30 09:42:55', '2023-01-30 09:42:55'),
(36, 15, '150', 5401.5, 9, '2023-01-30 09:42:55', '2023-01-30 09:42:55'),
(37, 1, '1440', 3528, 9, '2023-01-30 09:42:55', '2023-01-30 09:42:55'),
(38, 19, '72', 612, 9, '2023-01-30 09:42:55', '2023-01-30 09:42:55'),
(39, 4, '216', 5099.76, 10, '2023-01-30 09:45:45', '2023-01-30 09:45:45'),
(40, 1, '1440', 3528, 10, '2023-01-30 09:45:45', '2023-01-30 09:45:45'),
(41, 19, '72', 612, 10, '2023-01-30 09:45:45', '2023-01-30 09:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `KD_id` bigint(20) UNSIGNED NOT NULL,
  `createdDate` date NOT NULL,
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `totalPrice` double DEFAULT NULL,
  `confirmStatus` enum('confirmed','unconfirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unconfirmed',
  `paymentStatus` enum('Confirm','Unconfirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unconfirmed',
  `deliveryStatus` enum('Delivered','Not-Delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not-Delivered',
  `handoverStatus` enum('confirmed','unconfirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unconfirmed',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `KD_id`, `createdDate`, `createdBy`, `totalPrice`, `confirmStatus`, `paymentStatus`, `deliveryStatus`, `handoverStatus`, `created_at`, `updated_at`) VALUES
(2, 53, 2, '2023-01-30', 69, 6106.34, 'confirmed', 'Confirm', 'Delivered', 'confirmed', '2021-12-10 03:25:47', '2023-01-30 10:09:22'),
(3, 9, 2, '2023-01-30', 69, 7012.34, 'confirmed', 'Confirm', 'Delivered', 'confirmed', '2022-12-10 03:24:13', '2023-01-30 10:10:37'),
(4, 13, 2, '2023-01-30', 69, 6106.34, 'confirmed', 'Confirm', 'Delivered', 'confirmed', '2022-12-10 03:15:31', '2023-01-30 10:11:41'),
(5, 12, 2, '2023-01-30', 69, 5494.34, 'confirmed', 'Confirm', 'Delivered', 'confirmed', '2022-12-10 03:16:22', '2023-01-30 10:12:53'),
(6, 11, 2, '2023-01-30', 69, 17399.78, 'confirmed', 'Confirm', 'Delivered', 'confirmed', '2022-12-10 03:12:13', '2023-01-30 10:16:03'),
(7, 56, 2, '2023-01-30', 69, 6275.42, 'confirmed', 'Confirm', 'Delivered', 'confirmed', '2022-12-10 03:11:13', '2023-01-30 10:17:38'),
(8, 15, 2, '2023-01-30', 72, 9312.76, 'unconfirmed', 'Unconfirmed', 'Not-Delivered', 'unconfirmed', '2023-01-30 09:37:49', '2023-01-30 09:37:49'),
(9, 16, 2, '2023-01-30', 72, 14641.26, 'unconfirmed', 'Unconfirmed', 'Not-Delivered', 'unconfirmed', '2023-01-30 09:42:55', '2023-01-30 09:42:55'),
(10, 22, 2, '2023-01-30', 72, 9239.76, 'unconfirmed', 'Unconfirmed', 'Not-Delivered', 'unconfirmed', '2023-01-30 09:45:45', '2023-01-30 09:45:45');

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
  `Qty` int(11) NOT NULL DEFAULT 0,
  `price` double NOT NULL,
  `catagory_id` bigint(20) UNSIGNED NOT NULL,
  `productType_id` bigint(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packsize` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KD_ID` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `Qty`, `price`, `catagory_id`, `productType_id`, `description`, `image`, `packsize`, `KD_ID`, `created_at`, `updated_at`) VALUES
(1, 'KNORR ALL IN ONE CUBE FORT', 996160, 2.45, 1, 1, 'UNIT PER CASE :  1440', '1669646029.jpg', '8 g', 2, '2022-11-28 06:34:42', '2023-01-30 09:45:45'),
(2, 'KNORR CUBE CHICKEN FORT', 1000000, 2.45, 1, 1, 'UNIT PER CASE : 1440', '1669640330.jfif', '8 g', 2, '2022-11-28 06:58:50', '2022-11-29 08:27:10'),
(3, 'LIFEBUOY SOAP BAR LEMON', 999352, 23.61, 4, 5, 'UNIT PER CASE : 72', '1669640588.jfif', '70 g', 2, '2022-11-28 07:03:08', '2023-01-30 09:37:49'),
(4, 'LIFEBUOY SOAP TOTAL', 999136, 23.61, 4, 5, 'UNIT PER CASE : 72', '1669640781.jfif', '70 g', 2, '2022-11-28 07:06:21', '2023-01-30 09:45:45'),
(5, 'LIFEBUOY SOAP BAR LEMON', 1000000, 47.15, 4, 5, 'UNIT PER CASE : 36', '1669640901.jfif', '150 g', 2, '2022-11-28 07:07:54', '2022-11-28 08:05:36'),
(6, 'LIFEBUOY SOAP BAR TOTAL', 1000000, 47.15, 4, 5, 'UNIT PER CASE : 36', '1669641068.jfif', '150 g', 2, '2022-11-28 07:11:08', '2022-11-28 08:05:55'),
(7, 'LUX SOAP SOFT CARESS', 1000000, 21.67, 4, 6, 'UNIT PER CASE : 72', '1669641181.jfif', '70 g', 2, '2022-11-28 07:13:01', '2022-11-28 07:13:01'),
(8, 'LUX SOAP SOFT TOUCH', 1000000, 21.67, 4, 6, 'UNIT PER CASE : 70 g', '1669641255.jfif', '70 g', 2, '2022-11-28 07:14:15', '2022-11-30 00:54:36'),
(9, 'OMO HW POWDER GAIA', 1000000, 8.5, 2, 7, 'UNIT PER CASE : 100', '1669641458.jfif', '40 g', 2, '2022-11-28 07:17:38', '2022-12-09 02:50:19'),
(10, 'OMO HW POWDER GAIA', 1000000, 17.99, 2, 7, 'UNIT PER CASE : 72', '1669641838.jpg', '100 g', 2, '2022-11-28 07:20:50', '2022-11-28 07:23:58'),
(11, 'OMO HW POWDER GAIA', 1000000, 5.64, 2, 7, 'UNIT PER CASE : 120', '1669641988.jpg', '27 G', 2, '2022-11-28 07:26:28', '2022-11-28 07:26:28'),
(12, 'SIGNAL TP CAVITY FIGHTER', 1000000, 12.71, 5, 8, 'UNIT PER CASE : 144', '1669642070.png', '30 G', 2, '2022-11-28 07:27:50', '2022-12-01 08:54:46'),
(13, 'SIGNAL TP CAVITY FIGHTER', 1000000, 27.58, 5, 8, 'UNIT PER CASE : 72', '1669642177.png', '60 g', 2, '2022-11-28 07:29:37', '2022-11-29 06:46:36'),
(14, 'SUNLIGHT POWDER HW CHEETAH', 1000000, 16.99, 2, 2, 'UNIT PER CASE : 72', '1669642418.jfif', '110 g', 2, '2022-11-28 07:33:38', '2022-12-08 10:17:03'),
(15, 'SUNLIGHT YELLOW BAR SOAP', 999450, 36.01, 3, 2, 'UNIT PER CASE : 50', '1669642550.jfif', '200 g', 2, '2022-11-28 07:35:50', '2023-01-30 09:42:55'),
(16, 'SUNLIGHT POWDER HW CHEETAH', 1000000, 5.77, 2, 2, 'UNIT PER CASE : 120', '1669642712.jfif', '27 g', 2, '2022-11-28 07:38:32', '2022-11-28 08:07:16'),
(17, 'SUNLIGHT HW POWDER YELLOW', 999928, 152.77, 2, 2, 'UNIT PER CASE : 12', '1669642831.jfif', '950 g', 2, '2022-11-28 07:40:31', '2023-01-30 09:24:21'),
(18, 'SUNLIGHT POWDER', 1000000, 594, 2, 2, 'UNIT PER CASE : 1', '1669642928.jfif', '5 kg', 2, '2022-11-28 07:42:08', '2022-12-01 06:37:58'),
(19, 'SUNLIGHT POWDER YELLOW', 999352, 8.5, 2, 2, 'UNIT PER CASE : 72', '1669643041.jfif', '50 g', 2, '2022-11-28 07:44:01', '2023-01-30 09:45:45'),
(20, 'SUNSILK CONDITIONER AVOCADO', 999998, 84.54, 6, 10, 'UNIT PER CASE : 12', '1669643142.jpg', '350 ml', 2, '2022-11-28 07:45:42', '2023-01-30 09:30:49'),
(21, 'SUNSILK SHAMPOO AVOCADO', 1000000, 84.54, 6, 9, 'UNIT PER CASE : 12', '1669643216.jfif', '350 ml', 2, '2022-11-28 07:46:56', '2022-11-29 08:04:18'),
(22, 'SUNSILK CONDITIONER COCONUT', 1000000, 84.54, 6, 10, 'UNIT PER CASE : 12', '1669643949.jfif', '350 ml', 2, '2022-11-28 07:59:09', '2022-11-28 08:09:56'),
(23, 'SUNSILK SHAMPOO COCONUT', 1000000, 84.54, 6, 9, 'UNIT PER CASE : 12', '1669644017.jfif', '350 ml', 2, '2022-11-28 08:00:17', '2022-11-28 08:00:17'),
(24, 'SUNSILK CONDITIONER COCONUT', 1000000, 4.16, 6, 10, 'UNIT PER CASE : 360', '1669644107.jpg', '15 ml', 2, '2022-11-28 08:01:47', '2022-11-28 08:10:14'),
(25, 'SUNSILK SHAMPOO COCONUT', 1000000, 4.16, 6, 9, 'UNIT PER CASE : 360', '1669644223.jfif', '15 ml', 2, '2022-11-28 08:03:43', '2022-11-28 08:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `product_catagories`
--

CREATE TABLE `product_catagories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catagoryName` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_catagories`
--

INSERT INTO `product_catagories` (`id`, `catagoryName`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SAVOURY', '1669647239.jfif', 'ingredients', NULL, '2022-11-28 08:53:59'),
(2, 'LAUNDRY', '1669647272.jfif', 'used for cleaning clothes', NULL, '2022-11-28 08:54:32'),
(3, 'HOUSEHOLD CARE', '1669647341.jfif', 'used for cleaning house', NULL, '2022-11-28 08:55:41'),
(4, 'SKIN CLEANSING', '1669647373.jfif', 'used for cleaning our skin', NULL, '2022-11-28 08:56:13'),
(5, 'ORAL CARE', '1669647418.jfif', 'used to treat our oral hygiene', NULL, '2022-11-28 08:56:58'),
(6, 'HAIR CARE', '1669647589.jfif', 'used for treating our hair', NULL, '2022-11-28 08:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productTypeName` char(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catagory_id` bigint(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `productTypeName`, `image`, `catagory_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'knorr', NULL, 2, 'sdgfgsdfgs', '2022-11-16 11:28:29', '2022-11-16 09:36:37'),
(2, 'SUNLIGHT POWDER', NULL, 2, 'adfwd', '2022-11-16 09:22:16', '2022-11-16 09:40:47'),
(3, 'SUNLIGHT BAR', NULL, 2, 'gsdf', '2022-11-16 09:22:16', '2022-11-16 09:42:12'),
(4, 'VIM', NULL, 3, 'Test', '2022-11-16 09:22:16', '2022-11-16 09:42:39'),
(5, 'LIFEBOUY - SOAPS', NULL, 4, 'lifebuoy soaps', '2022-11-16 09:22:16', '2022-11-28 09:01:16'),
(6, 'LUX - SOAPS', NULL, 0, '', '2022-11-16 09:22:16', '2022-11-16 09:22:16'),
(7, 'OMO', NULL, 0, 'OMO Laundry Detergent', '2022-11-16 09:22:16', '2022-11-16 09:22:16'),
(8, 'SIGNAL', NULL, 0, 'a toothpaste', '2022-11-16 09:22:16', '2022-11-16 09:22:16'),
(9, 'SUNSILK -SHAMPOO', NULL, 0, '', '2022-11-16 09:22:16', '2022-11-16 09:22:16'),
(10, 'SUNSILK - CONDITIONER', NULL, 6, 'hair care', '2022-11-16 09:22:16', '2022-11-28 09:02:37'),
(12, 'Tooth Paste', NULL, 5, 'Tooth paste', '2022-11-23 07:34:15', '2022-11-23 07:34:15'),
(13, 'OMOO', NULL, 2, 'mcskj', '2022-11-23 07:36:02', '2022-11-23 07:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `roms`
--

CREATE TABLE `roms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_filepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_type` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_number` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_issue_date` date NOT NULL,
  `ID_expiry_date` date NOT NULL,
  `latitude` double DEFAULT NULL,
  `longtude` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roms`
--

INSERT INTO `roms` (`id`, `user_id`, `address`, `mobile`, `id_filepath`, `ID_type`, `ID_number`, `ID_issue_date`, `ID_expiry_date`, `latitude`, `longtude`, `created_at`, `updated_at`) VALUES
(1, 64, 'Hawassa', '0911211387', '1670576707.png', 'Passport', '1223', '2022-12-04', '2022-12-31', NULL, NULL, '2022-12-09 06:05:07', '2022-12-09 06:05:07'),
(2, 68, 'Bulehora', '0911809271', '1670580364.jpg', 'Driving Licence', '0101098', '2021-11-13', '2025-12-12', NULL, NULL, '2022-12-09 07:06:04', '2022-12-09 07:06:04'),
(3, 67, 'Hawassa', '0916037439', '1675083968.jpg', 'Driving Licence', '01-05238', '2020-01-17', '2024-01-16', NULL, NULL, '2023-01-30 10:06:08', '2023-01-30 10:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `rsps`
--

CREATE TABLE `rsps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_filepath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_type` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_number` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_issue_date` date NOT NULL,
  `ID_expiry_date` date NOT NULL,
  `latitude` double DEFAULT NULL,
  `longtude` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rsps`
--

INSERT INTO `rsps` (`id`, `user_id`, `address`, `mobile`, `id_filepath`, `ID_type`, `ID_number`, `ID_issue_date`, `ID_expiry_date`, `latitude`, `longtude`, `created_at`, `updated_at`) VALUES
(1, 63, 'fj', '0932456312', '1670574218.jpg', 'Wordera ID', '1111', '2022-12-03', '2022-12-03', NULL, NULL, '2022-12-09 05:23:38', '2022-12-09 05:23:38'),
(2, 66, 'Hawassa', '0979807507', '1670578647.png', 'Passport', '2356', '2022-11-27', '2022-12-31', NULL, NULL, '2022-12-09 06:37:27', '2022-12-09 06:37:27'),
(3, 71, 'Cheko', '0919662505', '1675087368.jpg', 'Wordera ID', '1035', '2022-07-12', '2025-07-06', NULL, NULL, '2023-01-30 11:02:48', '2023-01-30 11:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `undelivered1_products`
--

CREATE TABLE `undelivered1_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `undelivered_quantity` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `undelivered1_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `undelivered1_products`
--

INSERT INTO `undelivered1_products` (`id`, `product_id`, `undelivered_quantity`, `undelivered1_id`, `created_at`, `updated_at`) VALUES
(2, 3, '0', 6, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(3, 4, '0', 6, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(4, 1, '0', 6, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(5, 19, '0', 6, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(6, 15, '0', 6, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(7, 3, '0', 7, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(8, 4, '0', 7, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(9, 15, '0', 7, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(10, 1, '0', 7, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(11, 19, '0', 7, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(12, 3, '0', 8, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(13, 4, '0', 8, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(14, 1, '0', 8, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(15, 15, '0', 8, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(16, 19, '0', 8, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(17, 3, '0', 9, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(18, 4, '0', 9, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(19, 1, '0', 9, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(20, 15, '0', 9, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(21, 3, '0', 10, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(22, 4, '0', 10, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(23, 1, '0', 10, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(24, 19, '0', 10, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(25, 15, '0', 10, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(26, 17, '0', 10, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(27, 3, '0', 11, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(28, 4, '0', 11, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(29, 15, '0', 11, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(30, 19, '0', 11, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(31, 1, '0', 11, '2023-01-30 10:17:38', '2023-01-30 10:17:38'),
(32, 20, '0', 11, '2023-01-30 10:17:38', '2023-01-30 10:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `undelivered2_orders`
--

CREATE TABLE `undelivered2_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rsp_id` bigint(20) UNSIGNED NOT NULL,
  `rom_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `undelivered2_orders`
--

INSERT INTO `undelivered2_orders` (`id`, `rsp_id`, `rom_id`, `order_id`, `created_at`, `updated_at`) VALUES
(6, 71, 67, 2, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(7, 71, 67, 3, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(8, 71, 67, 4, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(9, 71, 67, 5, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(10, 71, 67, 6, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(11, 71, 67, 7, '2023-01-30 11:10:11', '2023-01-30 11:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `undelivered2_products`
--

CREATE TABLE `undelivered2_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `undelivered_quantity` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `undelivered2_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `undelivered2_products`
--

INSERT INTO `undelivered2_products` (`id`, `product_id`, `undelivered_quantity`, `undelivered2_id`, `created_at`, `updated_at`) VALUES
(6, 3, '0', 6, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(7, 4, '0', 6, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(8, 1, '0', 6, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(9, 19, '0', 6, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(10, 15, '0', 6, '2023-01-30 11:04:27', '2023-01-30 11:04:27'),
(11, 3, '0', 7, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(12, 4, '0', 7, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(13, 15, '0', 7, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(14, 1, '0', 7, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(15, 19, '0', 7, '2023-01-30 11:05:54', '2023-01-30 11:05:54'),
(16, 3, '0', 8, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(17, 4, '0', 8, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(18, 1, '0', 8, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(19, 15, '0', 8, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(20, 19, '0', 8, '2023-01-30 11:06:53', '2023-01-30 11:06:53'),
(21, 3, '0', 9, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(22, 4, '0', 9, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(23, 1, '0', 9, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(24, 15, '0', 9, '2023-01-30 11:07:48', '2023-01-30 11:07:48'),
(25, 3, '0', 10, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(26, 4, '0', 10, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(27, 1, '0', 10, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(28, 19, '0', 10, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(29, 15, '0', 10, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(30, 17, '0', 10, '2023-01-30 11:09:02', '2023-01-30 11:09:02'),
(31, 3, '0', 11, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(32, 4, '0', 11, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(33, 15, '0', 11, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(34, 19, '0', 11, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(35, 1, '0', 11, '2023-01-30 11:10:11', '2023-01-30 11:10:11'),
(36, 20, '0', 11, '2023-01-30 11:10:11', '2023-01-30 11:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `undelivered_orders`
--

CREATE TABLE `undelivered_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_id` bigint(20) UNSIGNED NOT NULL,
  `rom_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `undelivered_orders`
--

INSERT INTO `undelivered_orders` (`id`, `kd_id`, `rom_id`, `order_id`, `created_at`, `updated_at`) VALUES
(6, 2, 67, 2, '2023-01-30 10:09:22', '2023-01-30 10:09:22'),
(7, 2, 67, 3, '2023-01-30 10:10:37', '2023-01-30 10:10:37'),
(8, 2, 67, 4, '2023-01-30 10:11:41', '2023-01-30 10:11:41'),
(9, 2, 67, 5, '2023-01-30 10:12:53', '2023-01-30 10:12:53'),
(10, 2, 67, 6, '2023-01-30 10:16:03', '2023-01-30 10:16:03'),
(11, 2, 67, 7, '2023-01-30 10:17:38', '2023-01-30 10:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPhoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `middleName`, `lastName`, `userName`, `userPhoto`, `email`, `userType`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'admin', '1668244934.jpg', 'admin@gmail.com', 'admin', NULL, '$2y$10$4bXsqs0BOQ2swEx9AIOgkeRIE8YaN8g7plK2i536hVn.mueOHeG36', 1, 'mIi0Pi3BRc3njzA83ssyVF3P3yaRuUVC9Uvdx2JlrdX7E9Ng0wdopz5nBpna', '2022-09-08 06:35:56', '2022-11-12 03:22:14'),
(2, 'Goshime', 'Deribe', 'Jemaw', 'Goshimme2022', '1675088727.jpg', 'Be@gmail.com', 'key distributor', NULL, '$2y$10$zrknRJCxUVKIosj/OaWVoerdCY5k/KUTqSBlMPh3L4O1eWn4B3xCi', 1, NULL, '2022-11-29 03:15:54', '2023-04-27 07:51:36'),
(3, 'Gelaye', 'Gebeyehu', '.', 'Gelaye', NULL, NULL, 'client', NULL, '$2y$10$wFwTvoy.cQvVbFPOQQAf/ulkF/tdgUQA9XHkFffeHSrUmBNteRFtC', 1, NULL, '2022-12-07 10:06:25', '2023-04-27 07:51:35'),
(4, 'Meron', 'Ashenafi', '.', 'Meron', NULL, NULL, 'client', NULL, '$2y$10$h47lqIm.a82YyM3XhGpdWOr1AMmcXaf/4RxB2z.FsFSUZw5HZJbFG', 1, NULL, '2022-12-07 10:10:39', '2023-04-27 07:51:34'),
(5, 'Mulunesh', 'Assfaw', '.', 'Mulunesh', NULL, NULL, 'client', NULL, '$2y$10$coX/CovYT9AdZx7m7Kzlh.cGSxur7nVKeNN1rMypDYeSw72zD1N7q', 1, NULL, '2022-12-07 10:21:02', '2023-04-27 07:51:34'),
(6, 'Shitaye', 'Birhanu', '.', 'Shitaye', NULL, NULL, 'client', NULL, '$2y$10$W0C2XjGZ5k1tsNgwM2iOOuzNqAaV1lTt7MBuPe.FTHkrYGEUSQvuS', 1, NULL, '2022-12-07 10:24:22', '2023-04-27 07:51:33'),
(7, 'Hiwot', 'Getachew', '.', 'Hiwot', NULL, NULL, 'client', NULL, '$2y$10$.6dva2yQpS/soZ2Qwl9Ow.yovIzBbVp7tXdKYGjWSvoCDBvmib/im', 1, NULL, '2022-12-07 10:33:57', '2023-04-27 07:51:32'),
(8, 'Debritu', 'Tesgaye', '.', 'Debritu', NULL, NULL, 'client', NULL, '$2y$10$i4o4Z6CvOSF1/HHkoeER5.Z6jyO5gpMosdOrE42ggtSsKztVbczS6', 1, NULL, '2022-12-07 10:37:55', '2023-04-27 07:51:32'),
(9, 'Aberashi', 'Tadisho', '.', 'Aberashi', NULL, NULL, 'client', NULL, '$2y$10$hn1vbkQg784b/1/uvtlt4OplbkAFq.Muq3QZfPIloRGMoYi1l.rjy', 1, NULL, '2022-12-07 10:43:14', '2023-04-27 07:51:31'),
(10, 'Zelalem', 'Kewate', '.', 'Zelalem', NULL, NULL, 'client', NULL, '$2y$10$karsOB6X4.LSfASAYCpxmebP4L6a5lXDS6862I6inHSIBNMHWGRkW', 1, NULL, '2022-12-07 10:51:09', '2023-04-27 07:51:27'),
(11, 'Almaz', 'Lalemo', '.', 'Almaz', NULL, NULL, 'client', NULL, '$2y$10$kFCokc/ozl756Ar9CXOv2uA/8aIlgDPlE77dUk.tmzii12WLOVMWa', 1, NULL, '2022-12-07 10:56:50', '2023-04-27 07:51:26'),
(12, 'Bekelech', 'Bantora', '.', 'Bekelech', NULL, NULL, 'client', NULL, '$2y$10$h6jdccnuXMtoVR2kAbQYwOtGQQIHnQWOczZGMt7jt2Zeach9gbOU6', 1, NULL, '2022-12-07 11:00:54', '2023-04-27 07:51:25'),
(13, 'Birke', 'Mume', '.', 'Birke', NULL, NULL, 'client', NULL, '$2y$10$VR8K0lH51tXOwIoi3tLIzuS7i6kLQmcRY6WaE9tVaoops355r98V.', 1, NULL, '2022-12-07 11:03:22', '2023-04-27 07:51:24'),
(14, 'Abebu', 'Abebe', '.', 'Abebu', NULL, NULL, 'client', NULL, '$2y$10$rDfinXXaqd3nFAKL5zl.JeBKA8K/Z1yM.YAU//xTzdjawz5xI6MU6', 1, NULL, '2022-12-07 11:07:31', '2023-04-27 07:51:24'),
(15, 'Hirut', 'Danieal', '.', 'Hirut', NULL, NULL, 'client', NULL, '$2y$10$fqFPBMAjwITtSL3.q/yq9e.v5eaPncHLq7X5o9mubssyw98YZ9Aq2', 1, NULL, '2022-12-07 11:11:14', '2023-04-27 07:51:23'),
(16, 'Gedamnesh', 'Getu', '.', 'Gedamnesh', NULL, NULL, 'client', NULL, '$2y$10$3goWeZcJh.zSTI/Ap0QRde4sv5MWRmhtidKTs25P1GJo3eqb7qJBy', 1, NULL, '2022-12-07 11:16:13', '2023-04-27 07:51:22'),
(17, 'Aynalem', 'Fkadu', '.', 'Aynalem', NULL, NULL, 'client', NULL, '$2y$10$QcLn7r8DJoJsERc/DXEBBOhyUUfiTvG0UqwiWGVrTbLVq3DSAwTsS', 1, NULL, '2022-12-07 11:20:35', '2023-04-27 07:51:21'),
(18, 'Lemlem', 'Asefaw', '.', 'Lemlem', NULL, NULL, 'client', NULL, '$2y$10$xMEFZ3.GVmCuhx9XQDZLTujveAfh8YPEIyhDtpIzmNj4ixMdDB0Ka', 1, NULL, '2022-12-07 11:23:51', '2023-04-27 07:51:20'),
(19, 'Adanech', 'Desta', '.', 'Adanech', NULL, NULL, 'client', NULL, '$2y$10$oWgTp9XHbmBIn7ST88wYzuOyT8.E99movR39rEP2Hm0tD9tCbUr9W', 1, NULL, '2022-12-07 11:26:54', '2023-04-27 07:51:20'),
(20, 'Zewditu', 'Zenebe', '.', 'Zewditu', NULL, NULL, 'client', NULL, '$2y$10$JKcbnQfoxXgfHV5n/QgdquvFU0g3PwZC6ZWqXbK2Wu/Z8gb2Nzm..', 1, NULL, '2022-12-07 11:30:04', '2023-04-27 07:51:19'),
(21, 'Aster', 'Baramo', '.', 'Aster', NULL, NULL, 'client', NULL, '$2y$10$.4EasE25DgfnmxQaGwfdYOsjSPe9TfvHWOsQ2.sCBOAgzHrPv1dN6', 1, NULL, '2022-12-07 11:33:06', '2023-04-27 07:51:14'),
(22, 'Hana', 'Eyasu', '.', 'Hana', NULL, NULL, 'client', NULL, '$2y$10$EnQJzZuPh8vIXliXzazFmetjbQv2.Qn4lZyN.5EBt6mqe4.fAUcoC', 1, NULL, '2022-12-07 11:42:57', '2023-04-27 07:51:15'),
(23, 'Lamrot', 'Endale', '.', 'Lamrot', NULL, NULL, 'client', NULL, '$2y$10$JI1JWfbDQKDBdlziVjtlR.SBlxxwYLSLFcWlsz3/4WMxIXcXLTpVK', 1, NULL, '2022-12-07 11:47:21', '2023-04-27 07:51:13'),
(24, 'Wagaye', 'Demisse', '.', 'Wegaye', NULL, NULL, 'client', NULL, '$2y$10$qkMFs1Apc02munQ0hDycZuCC8tTbfyo6hfVZ.uO1akhGfL1uz3KfW', 1, NULL, '2022-12-07 11:50:03', '2023-04-27 07:51:12'),
(25, 'Birtukan', 'Dawit', '.', 'Birtukan', NULL, NULL, 'client', NULL, '$2y$10$3XtJ0e5r9UD7.cdnsVCPveM2/wBvvnlLeJ.jEJrWzJftsk9QmPaXe', 1, NULL, '2022-12-07 11:53:18', '2023-04-27 07:51:11'),
(26, 'Tsehay', 'Demse', '.', 'Tsehay', NULL, NULL, 'client', NULL, '$2y$10$TTzTsFhCtY5unpsSiFEZQ.8DpYrMzQrE9O3CRDX4YEYd.hNg08fvK', 1, NULL, '2022-12-07 11:55:55', '2023-04-27 07:51:10'),
(27, 'Etenesh', 'Tamene', '.', 'Etenesh', NULL, NULL, 'client', NULL, '$2y$10$fNUfStgeIdu6HmoGaywOa.K9SVJtfj6AP0DXueyuXK2VRPDKlMzBG', 1, NULL, '2022-12-07 11:59:46', '2023-04-27 07:51:09'),
(28, 'Beletech', 'Sefu', '.', 'Beletech', NULL, NULL, 'client', NULL, '$2y$10$1SVV2gpEfEhv2fh.E24q2uDH30rz7UrtV0sYvFQnwtqGdv6mvrXV6', 1, NULL, '2022-12-07 12:05:56', '2023-04-27 07:51:08'),
(33, 'Hiwot', 'Getachew', '.', 'Hiwott', NULL, NULL, 'client', NULL, '$2y$10$OmH57dFaychiP2gdKzoeYOkc4XvDi.rQchMvbxx/shez4F73qU7Qe', 1, NULL, '2022-12-08 04:20:37', '2023-04-27 07:51:07'),
(38, 'Bizuayehu', 'Tsegaye', 'LastName', 'Bizuayehu', NULL, NULL, 'client', NULL, '$2y$10$QoeGZmOHdXT3sZ9ee0hyPeMeiGRwyQeY5tyndF47dRjONn7pQ610q', 1, NULL, '2022-12-08 08:56:31', '2023-04-27 07:51:07'),
(39, 'Tejtu', 'Seyoum', 'sdf', 'Tejtu', NULL, NULL, 'client', NULL, '$2y$10$YrttDf9VD41B5wgMHBgVbOFUaqVudTMjjf7KuQfpO3T5HHY724V.q', 1, NULL, '2022-12-08 09:09:58', '2023-04-27 07:51:06'),
(40, 'Firehiwot', 'Yohannes', '.', 'Firehiwot', NULL, NULL, 'client', NULL, '$2y$10$WNPU7B6qTNybZEVSrlIO..dNbarvZQr3vHIoNIjrIkmMcYHcPj53e', 1, NULL, '2022-12-08 09:14:39', '2023-04-27 07:51:03'),
(43, 'Mestawot', 'Kassa', '.', 'Mestawott', NULL, NULL, 'client', NULL, '$2y$10$2tRHKt1gCERTr.ILKR6rCuLMsPhqPDT2QL4lf1TzlVpOqFtVKcbEy', 1, NULL, '2022-12-08 09:17:31', '2023-04-27 07:51:03'),
(44, 'Asnakech', 'Demeke', '.', 'Asnakech', NULL, NULL, 'client', NULL, '$2y$10$EQ3aKT732H.sA3Ys9cPPcOO0aB3T7fgLpNQYugvJqAKaTAFxvRsQW', 1, NULL, '2022-12-08 09:19:34', '2023-04-27 07:51:02'),
(46, 'Tizita', 'Gonelamo', '.', 'Tizita', NULL, NULL, 'client', NULL, '$2y$10$N8b9yw/sdFuGfidvEO23Du5qx7ry1ADJOPvClwFuNYMUmq4nxM2EK', 1, NULL, '2022-12-08 09:23:31', '2023-04-27 07:51:01'),
(48, 'Meseret', 'Yuma', '.', 'Meserett', NULL, NULL, 'client', NULL, '$2y$10$RszCndk3me.SIUB6A0MNKOvG9RZn5iZtBWTrJCiHejXT8zlqZN45O', 1, NULL, '2022-12-08 09:28:21', '2023-04-27 07:51:00'),
(51, 'Wereke', 'Beta', '.', 'Wereke', NULL, NULL, 'client', NULL, '$2y$10$PReJkCSGsT5Tm5.lF/iHF.Xv8C5Xgk9NV1Rjfr47z.hAAR2W5dpJq', 1, NULL, '2022-12-08 09:33:28', '2023-04-27 07:51:00'),
(52, 'Woyneshet', 'Herd', '.', 'Woyneshet', NULL, NULL, 'client', NULL, '$2y$10$LJgQT2LxgSQAjzIUV7CbsuaVSkaGcgABrIDdQy1dnD73jF.P7phuO', 1, NULL, '2022-12-08 10:23:56', '2023-04-27 07:50:59'),
(53, 'Woyneshet', 'Worku', '.', 'Woyn', NULL, NULL, 'client', NULL, '$2y$10$FvBHajI15H.6npS0WpZMKOR/JVvexG09CK9C4UlyisuCeWQFoIkJa', 1, NULL, '2022-12-08 10:27:25', '2023-04-27 07:50:58'),
(54, 'Sisay', 'Belay', '.', 'Sisay', NULL, NULL, 'client', NULL, '$2y$10$6k2zLHkWFPeOn0w/ero4SeVJWZm3cIX181OpVU0g07eqfWePo6R9u', 1, NULL, '2022-12-08 10:29:25', '2023-04-27 07:50:57'),
(55, 'Mulatw', 'Gela', '.', 'Mulatw', NULL, NULL, 'client', NULL, '$2y$10$vgC22LHtkkR9f5ls.7QegeQvAAkllRg4D9F7pjDvxIqyZwwINavfm', 1, NULL, '2022-12-08 10:31:27', '2023-04-27 07:50:57'),
(56, 'Marta', 'Lemiso', '.', 'Marta', NULL, NULL, 'client', NULL, '$2y$10$/IwLzu97kjaVz1tt9B4tEe0H2KWISj4.cA442nCih/nKXXEdwpADO', 1, NULL, '2022-12-08 10:33:48', '2023-04-27 07:50:56'),
(62, 'rsp', 'rsp', 'rsp', 'rsp', '1670573198.jpg', 'rsp1@gmail.com', 'RSP', NULL, '$2y$10$ivjEjwji4cwbUhB6MrlFheBhT1h627VcYHTCUHMiwtF8haIk6VBZq', 1, NULL, '2022-12-09 05:05:48', '2023-04-27 07:50:55'),
(63, 'pa', 'pa', 'pa', 'pa', '1670574218.jpg', 'pa@gmail.com', 'RSP', NULL, '$2y$10$dnjikLi3jDO0WXlaYNg7wu477m/7R7qeQz1SFe1YpJAm2A07VaiTK', 1, NULL, '2022-12-09 05:22:40', '2023-04-27 07:50:53'),
(64, 'test', 'test', 'test', 'test', '1670576707.png', 'test@elebatsolution.com', 'ROM', NULL, '$2y$10$lB//Ric13O1KiTeijRAqrOIOjO5Xcq8A.2XLDUEpLcBu6UNJ1vYCG', 1, NULL, '2022-12-09 05:57:38', '2023-04-27 07:50:52'),
(65, 'abebash', 'melese', 'keshena', 'ab', NULL, 'ab@elebatsoolution.com', 'RSP', NULL, '$2y$10$zrknRJCxUVKIosj/OaWVoerdCY5k/KUTqSBlMPh3L4O1eWn4B3xCi', 1, NULL, '2022-12-09 06:20:14', '2023-04-27 07:50:51'),
(66, 'Etalemahu', 'Yetneberk', 'Tadesse', 'konjo', '1670578647.png', 'RSPkonjo@elebatsolution.com', 'RSP', NULL, '$2y$10$gq51Dqv4tIkrLfsPTzMb7uBmienz1DhDP3BCqhJ8yKmqfR3qoquHC', 1, NULL, '2022-12-09 06:24:25', '2023-04-27 07:50:50'),
(67, 'Wagaye', 'Bekele', 'Basha', 'WagayeB', '1675083968.jpg', 'wagich.bekele@gmail.com', 'ROM', NULL, '$2y$10$3XtJ0e5r9UD7.cdnsVCPveM2/wBvvnlLeJ.jEJrWzJftsk9QmPaXe', 1, NULL, '2022-12-09 06:28:42', '2023-04-27 07:50:50'),
(68, 'Demis', 'Dejene', 'Hurisa', 'Demis', '1670580364.jpg', 'demisdejene2010@gmail.com', 'ROM', NULL, '$2y$10$AjrqIVamFy0OVODHs.c8iea7d0CdE5G0/LyDfC9DHd70ydPJRbsfy', 1, 'p2xsd7cFxPTi7cXovNMAXvGSOUGTemJ9vA9ZDt6agRFTG8Ga4KYG1vd566nH', '2022-12-09 06:34:31', '2023-04-27 07:50:49'),
(69, 'Agent', 'Agent', 'Agent', 'Agent', NULL, 'nabdulsemed@gmail.com', 'agent', NULL, '$2y$10$mMppCnZLlbykdRtn4.IVLOCtu7zTPQmQkakLwm2Sw5qyeCdWie.aW', 1, NULL, '2022-12-09 06:48:09', '2023-04-27 07:50:48'),
(70, 'abebe', 'ke', 'kebede', 'abebe', '1670579802.jfif', 'abebe@gmail.com', 'agent', NULL, '$2y$10$CJSUcyWAo0w5uH/.l.YKN.n7hTXhVQe6Qn.mgronsKEJhebqoLqUC', 1, NULL, '2022-12-09 06:54:17', '2023-04-27 07:50:47'),
(71, 'Addisalem', 'Shudura', 'Hayesso', 'AddisChu', '1675087368.jpg', 'addishiwoyt@elebatsolution.com', 'RSP', NULL, '$2y$10$HCMDQGEQxPFXCbpWkLqJzOBTpvyzy/KLDQsU0Hu1aBil86GA7jB22', 1, NULL, '2022-12-10 05:51:11', '2023-04-27 07:50:47'),
(72, 'Sofiyan', 'Etalla', 'Shikure', 'sofian22', NULL, 'sofianetalla@gmail.com', 'agent', NULL, '$2y$10$fC7.UUSiEoO9W6rlVYTQuelUypcdOz8UuLi/pI8oM.ho5srGTaljK', 1, NULL, '2023-01-30 06:18:48', '2023-04-27 07:50:46'),
(73, 'meseret', 'ayele', 'balcha', 'meseret123', NULL, 'merseret@epace.com', 'RSP', NULL, '$2y$10$DAQeU/BSa6k6joQYASs9duJy8dfBY0D8d1yKrTFUpEfl8r5NZn.BW', 1, 'dQuR4dEpcsQzHoUBhE4JWoYY8TDwGEFwk9lndgAGX3AlDZdJ18RvrUCL4gRM', '2023-04-27 08:04:54', '2023-04-27 08:04:54'),
(74, 'haile', 'befikadu', 'belete', 'haile123', NULL, 'haile@epace.com', 'agent', NULL, '$2y$10$TJ11xi.fYVt.l9odVMOw/uZ/CKPneYzuYa3Yj0UHX1wFib8bfzY9O', 1, NULL, '2023-04-27 08:06:05', '2023-04-27 08:06:05'),
(75, '🔥Get 400FS & 750$ deposit bonus at the following link ➡️ 🔥 https://bit.ly/turkbonus 🔥 ⬅️ Hurry up, the bonus time is limited! 🔥', 'Let\'s', 'Go', 'aster11', NULL, 'salavat.esengaliev@yandex.com', 'RSP', NULL, '$2y$10$dnqKEQILczj6aTgIX9CZiOCSSxJwRVkXDRRia7piRcgPzh9fuBDi.', 0, NULL, '2023-05-01 08:29:42', '2023-05-01 08:29:42'),
(76, '🔥Get 400FS & 750$ deposit bonus at the following link ➡️ 🔥 https://bit.ly/turkbonus 🔥 ⬅️ Hurry up, the bonus time is limited! 🔥', 'Let\'s', 'Go', 'as23456811', NULL, 'gekkanospa@gufum.com', 'RSP', NULL, '$2y$10$bV63Pr8A9xtCKAj7LgYaDu.wm8N9m/9HfBrxRz/cvlK3dGfJggkg.', 0, NULL, '2023-05-01 08:29:59', '2023-05-01 08:29:59'),
(77, '🔥Get 400FS & 750$ deposit bonus at the following link ➡️ 🔥 https://bit.ly/turkbonus 🔥 ⬅️ Hurry up, the bonus time is limited! 🔥', 'Let\'s', 'Go', 'as23456781', NULL, 'bropand39@gmail.com', 'RSP', NULL, '$2y$10$SiZi8.WPvIwcVGgQ3IxJBuYy3zXNO1vDt9kSgwnEAO9FiE1r31v.2', 0, NULL, '2023-05-01 08:30:00', '2023-05-01 08:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_user_id_unique` (`user_id`);

--
-- Indexes for table `business_types`
--
ALTER TABLE `business_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`),
  ADD KEY `clients_distro_id_foreign` (`distro_id`);

--
-- Indexes for table `delivery1s`
--
ALTER TABLE `delivery1s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery1s_kd_id_foreign` (`kd_id`),
  ADD KEY `delivery1s_rom_id_foreign` (`rom_id`),
  ADD KEY `delivery1s_order_id_foreign` (`order_id`);

--
-- Indexes for table `delivery1_products`
--
ALTER TABLE `delivery1_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery1_products_product_id_foreign` (`product_id`),
  ADD KEY `delivery1_products_delivery1_id_foreign` (`delivery1_id`);

--
-- Indexes for table `delivery2s`
--
ALTER TABLE `delivery2s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery2s_rom_id_foreign` (`rom_id`),
  ADD KEY `delivery2s_rsp_id_foreign` (`rsp_id`),
  ADD KEY `delivery2s_order_id_foreign` (`order_id`);

--
-- Indexes for table `delivery2_products`
--
ALTER TABLE `delivery2_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery2_products_product_id_foreign` (`product_id`),
  ADD KEY `delivery2_products_delivery2_id_foreign` (`delivery2_id`);

--
-- Indexes for table `delivery3s`
--
ALTER TABLE `delivery3s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery3_products`
--
ALTER TABLE `delivery3_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_4products`
--
ALTER TABLE `delivery_4products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery4_id` (`delivery4_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `delivery_4s`
--
ALTER TABLE `delivery_4s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `handover_hierarchies`
--
ALTER TABLE `handover_hierarchies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handover_hierarchy`
--
ALTER TABLE `handover_hierarchy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `key_distros`
--
ALTER TABLE `key_distros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `key_distros_user_id_foreign` (`user_id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_catagories`
--
ALTER TABLE `product_catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roms`
--
ALTER TABLE `roms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rsps`
--
ALTER TABLE `rsps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `undelivered1_products`
--
ALTER TABLE `undelivered1_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `undelivered2_orders`
--
ALTER TABLE `undelivered2_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `undelivered2_products`
--
ALTER TABLE `undelivered2_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `undelivered_orders`
--
ALTER TABLE `undelivered_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `delivery1s`
--
ALTER TABLE `delivery1s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `delivery_4products`
--
ALTER TABLE `delivery_4products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_4s`
--
ALTER TABLE `delivery_4s`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
