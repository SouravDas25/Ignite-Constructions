-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2018 at 04:39 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ignite_constructions`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_types`
--

CREATE TABLE `api_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paginate` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '', 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '', 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '', 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '', 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '', 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '', 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\"}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'locale', 'text', 'Locale', 0, 1, 1, 1, 1, 0, '', 12),
(12, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '', 12),
(13, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
(14, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
(15, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '', 3),
(16, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '', 4),
(17, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
(18, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
(19, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '', 3),
(20, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '', 4),
(21, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, '', 5),
(22, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, '', 9),
(23, 4, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(24, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(25, 4, 'location', 'coordinates', 'Location', 1, 1, 1, 1, 1, 1, NULL, 3),
(26, 4, 'address', 'text_area', 'Address', 1, 1, 1, 1, 1, 1, NULL, 4),
(27, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 5),
(28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 6),
(29, 5, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(30, 5, 'godown_id', 'number', 'Godown Id', 1, 0, 0, 0, 0, 0, NULL, 2),
(31, 5, 'purchase_id', 'number', 'Purchase Id', 1, 0, 0, 0, 0, 0, NULL, 3),
(32, 5, 'date', 'date', 'Date', 1, 1, 1, 1, 1, 1, NULL, 4),
(33, 5, 'quantity', 'number', 'Quantity', 1, 1, 1, 1, 1, 1, NULL, 5),
(34, 5, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 6),
(35, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(36, 6, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(37, 6, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(38, 6, 'details', 'text_area', 'Details', 1, 1, 1, 1, 1, 1, NULL, 3),
(39, 6, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 4),
(40, 6, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 5),
(41, 7, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(42, 7, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(43, 7, 'password', 'password', 'Password', 1, 1, 1, 1, 1, 1, NULL, 3),
(44, 7, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 4),
(45, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 5),
(46, 8, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(47, 8, 'seller_id', 'hidden', 'Seller Id', 1, 0, 0, 0, 0, 0, NULL, 2),
(48, 8, 'goods_id', 'hidden', 'Goods Id', 1, 0, 0, 0, 0, 0, NULL, 3),
(49, 8, 'date', 'date', 'Date', 1, 1, 1, 1, 1, 1, NULL, 4),
(50, 8, 'quantity', 'number', 'Quantity', 1, 1, 1, 1, 1, 1, NULL, 5),
(51, 8, 'cost', 'number', 'Cost', 1, 1, 1, 1, 1, 1, NULL, 6),
(52, 8, 'purchase_due', 'number', 'Purchase Due', 1, 1, 1, 1, 1, 1, NULL, 7),
(53, 8, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 8),
(54, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 9),
(55, 9, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(56, 9, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(57, 9, 'contact_no', 'number', 'Contact No', 1, 1, 1, 1, 1, 1, NULL, 3),
(58, 9, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 4),
(59, 9, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 5),
(60, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 6),
(61, 10, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(62, 10, 'site_transfer_id', 'hidden', 'Site Transfer Id', 1, 0, 0, 0, 0, 0, NULL, 2),
(63, 10, 'onset_datetime', 'timestamp', 'Onset Datetime', 1, 1, 1, 1, 1, 1, NULL, 3),
(64, 10, 'quantity', 'number', 'Quantity', 1, 1, 1, 1, 1, 1, NULL, 4),
(65, 10, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 5),
(66, 10, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 6),
(67, 11, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(68, 11, 'site_id', 'hidden', 'Site Id', 1, 0, 0, 0, 0, 0, NULL, 2),
(69, 11, 'godown_transfer_id', 'hidden', 'Godown Transfer Id', 1, 0, 0, 0, 0, 0, NULL, 3),
(70, 11, 'date', 'text', 'Date', 1, 1, 1, 1, 1, 1, NULL, 6),
(71, 11, 'quantity', 'text', 'Quantity', 1, 1, 1, 1, 1, 1, NULL, 7),
(72, 11, 'labour_id', 'hidden', 'Labour Id', 1, 0, 0, 0, 0, 0, NULL, 4),
(73, 11, 'status_id', 'hidden', 'Status Id', 1, 0, 0, 0, 0, 0, NULL, 5),
(74, 11, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 8),
(75, 11, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 9),
(76, 12, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(77, 12, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(78, 12, 'location', 'hidden', 'Location', 1, 1, 1, 1, 1, 1, NULL, 3),
(79, 12, 'address', 'text_area', 'Address', 1, 1, 1, 1, 1, 1, NULL, 4),
(80, 12, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 5),
(81, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 6),
(82, 13, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(83, 13, 'details', 'text_area', 'Details', 1, 1, 1, 1, 1, 1, NULL, 2),
(84, 13, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(85, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(86, 8, 'purchase_belongsto_seller_relationship', 'relationship', 'sellers', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Seller\",\"table\":\"sellers\",\"type\":\"belongsTo\",\"column\":\"seller_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"data_rows\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(87, 8, 'purchase_belongsto_good_relationship', 'relationship', 'goods', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Good\",\"table\":\"goods\",\"type\":\"belongsTo\",\"column\":\"goods_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"data_rows\",\"pivot\":\"0\",\"taggable\":\"0\"}', 11);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', '', '', 1, 0, NULL, '2018-06-28 07:44:12', '2018-06-28 07:44:12'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2018-06-28 07:44:13', '2018-06-28 07:44:13'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, '', '', 1, 0, NULL, '2018-06-28 07:44:13', '2018-06-28 07:44:13'),
(4, 'godowns', 'godowns', 'Godown', 'Godowns', 'voyager-treasure', 'App\\Godown', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:42:36', '2018-06-27 04:42:36'),
(5, 'godown_transfers', 'godown-transfers', 'Godown Transfer', 'Godown Transfers', NULL, 'App\\GodownTransfer', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:45:40', '2018-06-27 04:45:40'),
(6, 'goods', 'goods', 'Good', 'Goods', NULL, 'App\\Good', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:46:11', '2018-06-27 04:46:11'),
(7, 'labours', 'labours', 'Labour', 'Labours', NULL, 'App\\Labour', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:46:39', '2018-06-27 04:46:39'),
(8, 'purchases', 'purchases', 'Purchase', 'Purchases', NULL, 'App\\Purchase', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:47:46', '2018-06-27 04:47:46'),
(9, 'sellers', 'sellers', 'Seller', 'Sellers', NULL, 'App\\Seller', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:48:30', '2018-06-27 04:48:30'),
(10, 'site_transfer_details', 'site-transfer-details', 'Site Transfer Detail', 'Site Transfer Details', NULL, 'App\\SiteTransferDetail', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:49:41', '2018-06-27 04:49:41'),
(11, 'site_transfers', 'site-transfers', 'Site Transfer', 'Site Transfers', NULL, 'App\\SiteTransfer', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:53:05', '2018-06-27 04:53:05'),
(12, 'sites', 'sites', 'Site', 'Sites', NULL, 'App\\Site', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:58:45', '2018-06-27 04:58:45'),
(13, 'statuses', 'statuses', 'Status', 'Statuses', NULL, 'App\\Status', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-27 04:59:11', '2018-06-27 04:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `godowns`
--

CREATE TABLE `godowns` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` geometry NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `godowns`
--

INSERT INTO `godowns` (`id`, `name`, `location`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ignite Godown', '', 'asdfghjkl;hjklhc', NULL, NULL),
(2, 'Hacienda Godown', '', 'rfyghnjdacxhjkm', NULL, NULL),
(3, 'Pecado Godown', '', 'asdfghjkl', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `godown_transfers`
--

CREATE TABLE `godown_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `godown_id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labours`
--

CREATE TABLE `labours` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2018-06-28 07:44:14', '2018-06-28 07:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2018-06-28 07:44:14', '2018-06-28 07:44:14', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 5, '2018-06-28 07:44:14', '2018-06-28 07:44:14', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 3, '2018-06-28 07:44:14', '2018-06-28 07:44:14', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 2, '2018-06-28 07:44:14', '2018-06-28 07:44:14', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 9, '2018-06-28 07:44:15', '2018-06-28 07:44:15', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 10, '2018-06-28 07:44:15', '2018-06-28 07:44:15', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 11, '2018-06-28 07:44:15', '2018-06-28 07:44:15', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 12, '2018-06-28 07:44:15', '2018-06-28 07:44:15', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 13, '2018-06-28 07:44:15', '2018-06-28 07:44:15', 'voyager.bread.index', NULL),
(10, 1, 'Api Builder', '', '_self', 'fa fa-cloud', NULL, 5, 14, '2018-06-28 07:44:15', '2018-06-28 07:44:15', 'voyager.api.builder.index', NULL),
(11, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 15, '2018-06-28 07:44:15', '2018-06-28 07:44:15', 'voyager.settings.index', NULL),
(12, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 13, '2018-06-28 07:44:20', '2018-06-28 07:44:20', 'voyager.hooks', NULL),
(13, 1, 'Godowns', '', '_self', 'voyager-treasure', NULL, NULL, 16, '2018-06-27 04:42:36', '2018-06-27 04:42:36', 'voyager.godowns.index', NULL),
(14, 1, 'Godown Transfers', '', '_self', NULL, NULL, NULL, 17, '2018-06-27 04:45:41', '2018-06-27 04:45:41', 'voyager.godown-transfers.index', NULL),
(15, 1, 'Goods', '', '_self', NULL, NULL, NULL, 18, '2018-06-27 04:46:12', '2018-06-27 04:46:12', 'voyager.goods.index', NULL),
(16, 1, 'Labours', '', '_self', NULL, NULL, NULL, 19, '2018-06-27 04:46:39', '2018-06-27 04:46:39', 'voyager.labours.index', NULL),
(17, 1, 'Purchases', '', '_self', NULL, NULL, NULL, 20, '2018-06-27 04:47:46', '2018-06-27 04:47:46', 'voyager.purchases.index', NULL),
(18, 1, 'Sellers', '', '_self', NULL, NULL, NULL, 21, '2018-06-27 04:48:30', '2018-06-27 04:48:30', 'voyager.sellers.index', NULL),
(19, 1, 'Site Transfer Details', '', '_self', NULL, NULL, NULL, 22, '2018-06-27 04:49:41', '2018-06-27 04:49:41', 'voyager.site-transfer-details.index', NULL),
(20, 1, 'Site Transfers', '', '_self', NULL, NULL, NULL, 23, '2018-06-27 04:53:05', '2018-06-27 04:53:05', 'voyager.site-transfers.index', NULL),
(21, 1, 'Sites', '', '_self', NULL, NULL, NULL, 24, '2018-06-27 04:58:46', '2018-06-27 04:58:46', 'voyager.sites.index', NULL),
(22, 1, 'Statuses', '', '_self', NULL, NULL, NULL, 25, '2018-06-27 04:59:11', '2018-06-27 04:59:11', 'voyager.statuses.index', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2018_06_16_082309_create_notifications_table', 1),
(24, '2018_06_25_000000_create_seller_table', 1),
(25, '2018_06_25_000001_create_goods_table', 1),
(26, '2018_06_25_000002_create_purchase_table', 1),
(27, '2018_06_25_000003_create_godown_table', 1),
(28, '2018_06_25_000004_create_site_table', 1),
(29, '2018_06_25_000005_create_godown_transfer_table', 1),
(30, '2018_06_25_000006_create_status_table', 1),
(31, '2018_06_25_000007_create_labour_table', 1),
(32, '2018_06_25_000008_create_site_transfer_table', 1),
(33, '2018_06_25_000009_create_site_transfer_details_table', 1),
(34, '2018_06_28_114433_create_api_types_table', 1),
(35, '2018_06_28_114627_create_api_keys_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2018-06-28 07:44:15', '2018-06-28 07:44:15'),
(2, 'browse_bread', NULL, '2018-06-28 07:44:15', '2018-06-28 07:44:15'),
(3, 'browse_database', NULL, '2018-06-28 07:44:15', '2018-06-28 07:44:15'),
(4, 'browse_media', NULL, '2018-06-28 07:44:15', '2018-06-28 07:44:15'),
(5, 'browse_compass', NULL, '2018-06-28 07:44:15', '2018-06-28 07:44:15'),
(6, 'browse_api', NULL, '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(7, 'browse_menus', 'menus', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(8, 'read_menus', 'menus', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(9, 'edit_menus', 'menus', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(10, 'add_menus', 'menus', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(11, 'delete_menus', 'menus', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(12, 'browse_roles', 'roles', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(13, 'read_roles', 'roles', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(14, 'edit_roles', 'roles', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(15, 'add_roles', 'roles', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(16, 'delete_roles', 'roles', '2018-06-28 07:44:16', '2018-06-28 07:44:16'),
(17, 'browse_users', 'users', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(18, 'read_users', 'users', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(19, 'edit_users', 'users', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(20, 'add_users', 'users', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(21, 'delete_users', 'users', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(22, 'browse_settings', 'settings', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(23, 'read_settings', 'settings', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(24, 'edit_settings', 'settings', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(25, 'add_settings', 'settings', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(26, 'delete_settings', 'settings', '2018-06-28 07:44:17', '2018-06-28 07:44:17'),
(27, 'browse_hooks', NULL, '2018-06-28 07:44:20', '2018-06-28 07:44:20'),
(28, 'read_godowns', 'godowns', '2018-06-27 04:42:36', '2018-06-27 04:42:36'),
(29, 'edit_godowns', 'godowns', '2018-06-27 04:42:36', '2018-06-27 04:42:36'),
(30, 'add_godowns', 'godowns', '2018-06-27 04:42:36', '2018-06-27 04:42:36'),
(31, 'delete_godowns', 'godowns', '2018-06-27 04:42:36', '2018-06-27 04:42:36'),
(32, 'browse_godown_transfers', 'godown_transfers', '2018-06-27 04:45:41', '2018-06-27 04:45:41'),
(33, 'read_godown_transfers', 'godown_transfers', '2018-06-27 04:45:41', '2018-06-27 04:45:41'),
(34, 'edit_godown_transfers', 'godown_transfers', '2018-06-27 04:45:41', '2018-06-27 04:45:41'),
(35, 'add_godown_transfers', 'godown_transfers', '2018-06-27 04:45:41', '2018-06-27 04:45:41'),
(36, 'delete_godown_transfers', 'godown_transfers', '2018-06-27 04:45:41', '2018-06-27 04:45:41'),
(37, 'browse_goods', 'goods', '2018-06-27 04:46:12', '2018-06-27 04:46:12'),
(38, 'read_goods', 'goods', '2018-06-27 04:46:12', '2018-06-27 04:46:12'),
(39, 'edit_goods', 'goods', '2018-06-27 04:46:12', '2018-06-27 04:46:12'),
(40, 'add_goods', 'goods', '2018-06-27 04:46:12', '2018-06-27 04:46:12'),
(41, 'delete_goods', 'goods', '2018-06-27 04:46:12', '2018-06-27 04:46:12'),
(42, 'browse_labours', 'labours', '2018-06-27 04:46:39', '2018-06-27 04:46:39'),
(43, 'read_labours', 'labours', '2018-06-27 04:46:39', '2018-06-27 04:46:39'),
(44, 'edit_labours', 'labours', '2018-06-27 04:46:39', '2018-06-27 04:46:39'),
(45, 'add_labours', 'labours', '2018-06-27 04:46:39', '2018-06-27 04:46:39'),
(46, 'delete_labours', 'labours', '2018-06-27 04:46:39', '2018-06-27 04:46:39'),
(47, 'browse_purchases', 'purchases', '2018-06-27 04:47:46', '2018-06-27 04:47:46'),
(48, 'read_purchases', 'purchases', '2018-06-27 04:47:46', '2018-06-27 04:47:46'),
(49, 'edit_purchases', 'purchases', '2018-06-27 04:47:46', '2018-06-27 04:47:46'),
(50, 'add_purchases', 'purchases', '2018-06-27 04:47:46', '2018-06-27 04:47:46'),
(51, 'delete_purchases', 'purchases', '2018-06-27 04:47:46', '2018-06-27 04:47:46'),
(52, 'browse_sellers', 'sellers', '2018-06-27 04:48:30', '2018-06-27 04:48:30'),
(53, 'read_sellers', 'sellers', '2018-06-27 04:48:30', '2018-06-27 04:48:30'),
(54, 'edit_sellers', 'sellers', '2018-06-27 04:48:30', '2018-06-27 04:48:30'),
(55, 'add_sellers', 'sellers', '2018-06-27 04:48:30', '2018-06-27 04:48:30'),
(56, 'delete_sellers', 'sellers', '2018-06-27 04:48:30', '2018-06-27 04:48:30'),
(57, 'browse_site_transfer_details', 'site_transfer_details', '2018-06-27 04:49:41', '2018-06-27 04:49:41'),
(58, 'read_site_transfer_details', 'site_transfer_details', '2018-06-27 04:49:41', '2018-06-27 04:49:41'),
(59, 'edit_site_transfer_details', 'site_transfer_details', '2018-06-27 04:49:41', '2018-06-27 04:49:41'),
(60, 'add_site_transfer_details', 'site_transfer_details', '2018-06-27 04:49:41', '2018-06-27 04:49:41'),
(61, 'delete_site_transfer_details', 'site_transfer_details', '2018-06-27 04:49:41', '2018-06-27 04:49:41'),
(62, 'browse_site_transfers', 'site_transfers', '2018-06-27 04:53:05', '2018-06-27 04:53:05'),
(63, 'read_site_transfers', 'site_transfers', '2018-06-27 04:53:05', '2018-06-27 04:53:05'),
(64, 'edit_site_transfers', 'site_transfers', '2018-06-27 04:53:05', '2018-06-27 04:53:05'),
(65, 'add_site_transfers', 'site_transfers', '2018-06-27 04:53:05', '2018-06-27 04:53:05'),
(66, 'delete_site_transfers', 'site_transfers', '2018-06-27 04:53:05', '2018-06-27 04:53:05'),
(67, 'browse_sites', 'sites', '2018-06-27 04:58:46', '2018-06-27 04:58:46'),
(68, 'read_sites', 'sites', '2018-06-27 04:58:46', '2018-06-27 04:58:46'),
(69, 'edit_sites', 'sites', '2018-06-27 04:58:46', '2018-06-27 04:58:46'),
(70, 'add_sites', 'sites', '2018-06-27 04:58:46', '2018-06-27 04:58:46'),
(71, 'delete_sites', 'sites', '2018-06-27 04:58:46', '2018-06-27 04:58:46'),
(72, 'browse_statuses', 'statuses', '2018-06-27 04:59:11', '2018-06-27 04:59:11'),
(73, 'read_statuses', 'statuses', '2018-06-27 04:59:11', '2018-06-27 04:59:11'),
(74, 'edit_statuses', 'statuses', '2018-06-27 04:59:11', '2018-06-27 04:59:11'),
(75, 'add_statuses', 'statuses', '2018-06-27 04:59:11', '2018-06-27 04:59:11'),
(76, 'delete_statuses', 'statuses', '2018-06-27 04:59:11', '2018-06-27 04:59:11'),
(77, 'browse_godowns', 'godowns', '2018-06-27 04:42:36', '2018-06-27 04:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `goods_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` decimal(50,2) NOT NULL,
  `purchase_due` decimal(50,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2018-06-28 07:44:15', '2018-06-28 07:44:15'),
(2, 'user', 'Normal User', '2018-06-28 07:44:15', '2018-06-28 07:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', '', '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Voyager', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', '', '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` geometry NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_transfers`
--

CREATE TABLE `site_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_id` int(10) UNSIGNED NOT NULL,
  `godown_transfer_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `labour_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_transfer_details`
--

CREATE TABLE `site_transfer_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_transfer_id` int(10) UNSIGNED NOT NULL,
  `onset_datetime` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@admin.com', 'users/default.png', '$2y$10$lRUkbwXdUpeSbzT5VIRC9.mYi3KBXZBCM1T6XxO3uPLSrp43TabrS', NULL, NULL, '2018-06-28 07:45:05', '2018-06-28 07:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_types`
--
ALTER TABLE `api_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_types_name_unique` (`name`),
  ADD UNIQUE KEY `api_types_slug_unique` (`slug`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `godowns`
--
ALTER TABLE `godowns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `godown_transfers`
--
ALTER TABLE `godown_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_godown_transfer_godown` (`godown_id`),
  ADD KEY `fk_purchase_godown` (`purchase_id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labours`
--
ALTER TABLE `labours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_seller_purchase` (`seller_id`),
  ADD KEY `fk_seller_goods` (`goods_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_no` (`contact_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_transfers`
--
ALTER TABLE `site_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_site_transfer_site` (`site_id`),
  ADD KEY `fk_site_transfer_godown_transfer` (`godown_transfer_id`),
  ADD KEY `fk_site_transfer_labour` (`labour_id`),
  ADD KEY `fk_site_transfer_status` (`status_id`);

--
-- Indexes for table `site_transfer_details`
--
ALTER TABLE `site_transfer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_site_transfer_details_site_transfer` (`site_transfer_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_types`
--
ALTER TABLE `api_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `godowns`
--
ALTER TABLE `godowns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `godown_transfers`
--
ALTER TABLE `godown_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labours`
--
ALTER TABLE `labours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_transfers`
--
ALTER TABLE `site_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_transfer_details`
--
ALTER TABLE `site_transfer_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `godown_transfers`
--
ALTER TABLE `godown_transfers`
  ADD CONSTRAINT `fk_godown_transfer_godown` FOREIGN KEY (`godown_id`) REFERENCES `godowns` (`id`),
  ADD CONSTRAINT `fk_purchase_godown` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`);

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `fk_seller_goods` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `fk_seller_purchase` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);

--
-- Constraints for table `site_transfers`
--
ALTER TABLE `site_transfers`
  ADD CONSTRAINT `fk_site_transfer_godown_transfer` FOREIGN KEY (`godown_transfer_id`) REFERENCES `godown_transfers` (`id`),
  ADD CONSTRAINT `fk_site_transfer_labour` FOREIGN KEY (`labour_id`) REFERENCES `labours` (`id`),
  ADD CONSTRAINT `fk_site_transfer_site` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`),
  ADD CONSTRAINT `fk_site_transfer_status` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Constraints for table `site_transfer_details`
--
ALTER TABLE `site_transfer_details`
  ADD CONSTRAINT `fk_site_transfer_details_site_transfer` FOREIGN KEY (`site_transfer_id`) REFERENCES `site_transfers` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
