-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2019 at 04:20 PM
-- Server version: 10.0.38-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.2.18-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `central_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_campaign_details`
--

CREATE TABLE `assign_campaign_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `groupskill_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_campaign_details`
--

INSERT INTO `assign_campaign_details` (`id`, `client_id`, `groupskill_id`, `campaign_id`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, '6', '5', 'Active', '2019-05-23 07:59:48', '2019-05-23 08:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `assign_role_privileges`
--

CREATE TABLE `assign_role_privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `roles_id` int(10) UNSIGNED NOT NULL,
  `pages_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_role_privileges`
--

INSERT INTO `assign_role_privileges` (`id`, `client_id`, `roles_id`, `pages_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(2, 1, 1, 2, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(3, 1, 1, 3, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(4, 1, 2, 6, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(5, 1, 2, 7, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(6, 1, 3, 1, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(7, 1, 3, 3, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(8, 1, 3, 5, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(9, 1, 3, 7, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(10, 1, 4, 1, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(11, 1, 4, 7, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(12, 2, 2, 1, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(13, 2, 2, 2, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(14, 2, 2, 6, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(15, 2, 2, 7, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(16, 1, 1, 10, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(17, 1, 1, 11, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(18, 1, 1, 12, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(19, 1, 1, 13, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(20, 1, 3, 10, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(21, 1, 3, 11, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(22, 1, 3, 12, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(23, 1, 3, 13, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(24, 2, 2, 10, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(25, 2, 2, 11, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(26, 2, 2, 12, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35'),
(27, 2, 2, 13, 'Active', '2019-05-17 07:02:35', '2019-05-17 07:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `campaign_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `users_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `client_id`, `campaign_name`, `status`, `users_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(5, 2, 'SLI mahila group', 'Active', '2,8,9,10,29,30', '2019-05-23 09:20:00', '2019-05-23 05:00:00', '2019-05-23 07:54:14', '2019-05-23 07:54:14'),
(6, 2, 'Dummy', 'Active', '2,8,9,10,29,30', '2019-05-31 10:15:00', '2019-05-23 05:20:00', '2019-05-23 07:55:31', '2019-05-23 07:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_sql_queries`
--

CREATE TABLE `campaign_sql_queries` (
  `id` int(10) UNSIGNED NOT NULL,
  `campaign_id` int(10) UNSIGNED NOT NULL,
  `query` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `select_col` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `where_con` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_queue` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_sql_queries`
--

INSERT INTO `campaign_sql_queries` (`id`, `campaign_id`, `query`, `select_col`, `where_con`, `current_queue`, `created_at`, `updated_at`) VALUES
(1, 6, 'Select * from records where status = "NEW" ', '*', 'status = "NEW" ', NULL, '2019-05-22 04:00:16', '2019-05-22 04:00:16'),
(2, 6, 'Select * from records where status = "New" ', '*', 'status = "New" ', NULL, '2019-05-22 07:12:14', '2019-05-22 07:12:14'),
(3, 6, 'Select * from records where status = "New" AND currentstatus = "ACTIVE" ', '*', 'status = "New" AND currentstatus = "ACTIVE" ', NULL, '2019-05-23 02:03:45', '2019-05-23 02:03:45'),
(4, 6, 'Select * from records where status = "New" ', '*', 'status = "New" ', NULL, '2019-05-23 05:51:01', '2019-05-23 05:51:01'),
(5, 6, 'Select * from records where status = "New" ', '*', 'status = "New" ', NULL, '2019-05-23 05:51:44', '2019-05-23 05:51:44'),
(6, 5, 'Select * from records where status = "New" ', '*', 'status = "New" ', NULL, '2019-05-23 08:08:40', '2019-05-23 08:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `central_users`
--

CREATE TABLE `central_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `admin_status` int(11) NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign_roles` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `central_users`
--

INSERT INTO `central_users` (`id`, `name`, `email`, `email_verified_at`, `Status`, `admin_status`, `password`, `client_id`, `assign_roles`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'central admin', 'central_admin@gmail.com', NULL, 'Active', 1, '$2y$10$kRmUDH2sREXPrQcc5C2LXOFk5bzqtdgzzKraaFLLQA97hKYXAbxqK', NULL, NULL, 'vXwz4cSeiXPYYOd2r3vOI9y1gX4iaZqAyQl8kvHS9nFHIFz5PjFwTRLfFY6W', NULL, NULL),
(4, 'Aishwariya', 'aishwariya@gmail.com', NULL, 'Active', 0, '$2y$10$iqMUrcv.LwnukUxAjv6rQOVeYVtJ/F4WM0Tlv9QF/fCvIMy9V4UFu', '1,2', '[{"clientid":"1","roleid":"1"},{"clientid":"2","roleid":"2"}]', 'OfqmZew4CZAaPAd8oPWepogsiQjD33VtSs41y76xUpOCC54SkG5zlwAZJo3P', NULL, NULL),
(5, 'Kratika', 'kratika@gmail.com', NULL, 'Active', 0, '$2y$10$hj3FZlPPGSjrydw/3.8kG.HPioxNsaA3WDuCX/k1z8ZYd/sw3H2JG', NULL, NULL, NULL, '2019-05-16 03:15:34', '2019-05-16 03:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `clientfeatures_details`
--

CREATE TABLE `clientfeatures_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `features_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subfeatures_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clientfeatures_details`
--

INSERT INTO `clientfeatures_details` (`id`, `client_id`, `features_id`, `subfeatures_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '1,2', 1, '2019-04-26 05:58:39', '2019-04-30 02:13:25'),
(2, 1, '2', '3,4', 1, '2019-04-26 05:58:39', '2019-04-30 02:13:25'),
(3, 2, '2', '3,4,5', 1, '2019-05-13 07:43:33', '2019-05-13 07:43:33'),
(4, 2, '31', '', 1, '2019-05-13 07:43:33', '2019-05-13 07:43:33'),
(5, 3, '2', '3,4', 1, '2019-05-13 07:43:52', '2019-05-13 07:43:52'),
(6, 5, '2', '3', 1, '2019-05-24 00:14:07', '2019-05-24 00:14:07'),
(7, 5, '31', '', 1, '2019-05-24 00:14:07', '2019-05-24 00:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `clientlocation_details`
--

CREATE TABLE `clientlocation_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `location_master_id` int(10) UNSIGNED NOT NULL,
  `location_server_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clientlocation_details`
--

INSERT INTO `clientlocation_details` (`id`, `client_id`, `location_master_id`, `location_server_id`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 3, '', 1, '2019-04-30 00:35:26', '2019-04-30 00:55:32'),
(9, 1, 2, '2', 1, '2019-04-30 00:53:35', '2019-04-30 00:55:32'),
(10, 1, 1, '4', 1, '2019-04-30 00:54:55', '2019-04-30 00:55:32'),
(14, 5, 1, '4', 1, '2019-05-23 06:51:39', '2019-05-23 06:51:39'),
(15, 5, 2, '1,2', 1, '2019-05-23 06:51:39', '2019-05-23 06:51:39'),
(17, 3, 5, '', 1, '2019-05-23 06:53:24', '2019-05-23 07:04:10'),
(18, 2, 817, '6', 1, '2019-05-24 00:21:11', '2019-05-24 00:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'VRM', 'VRM business', 1, '2019-04-26 05:58:14', '2019-04-30 00:55:32'),
(2, 'SLI', 'sli business', 1, '2019-04-26 06:01:45', '2019-04-26 06:01:45'),
(3, 'prime', 'prime business', 1, '2019-04-30 07:37:58', '2019-05-23 07:03:47'),
(5, 'BEU', 'BEU business application', 1, '2019-05-23 06:51:39', '2019-05-23 06:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `features_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `features_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Record', 0, '2019-04-26 05:56:06', '2019-05-23 07:04:41'),
(2, 'DialerMode', 1, '2019-04-26 05:57:27', '2019-04-26 05:57:27'),
(31, 'Notifications', 1, '2019-04-29 01:35:34', '2019-04-29 01:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `location_masters`
--

CREATE TABLE `location_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_masters`
--

INSERT INTO `location_masters` (`id`, `location`, `location_state`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kolhapur', 'Maharashtra', '1', NULL, NULL),
(2, 'Port Blair', 'Andaman & Nicobar Islands', '1', NULL, NULL),
(3, 'Adilabad', 'Andhra Pradesh', '1', NULL, NULL),
(4, 'Adoni', 'Andhra Pradesh', '1', NULL, NULL),
(5, 'Amadalavalasa', 'Andhra Pradesh', '1', NULL, NULL),
(6, 'Amalapuram', 'Andhra Pradesh', '1', NULL, NULL),
(7, 'Anakapalle', 'Andhra Pradesh', '1', NULL, NULL),
(8, 'Anantapur', 'Andhra Pradesh', '1', NULL, NULL),
(9, 'Badepalle', 'Andhra Pradesh', '1', NULL, NULL),
(10, 'Banganapalle', 'Andhra Pradesh', '1', NULL, NULL),
(11, 'Bapatla', 'Andhra Pradesh', '1', NULL, NULL),
(12, 'Bellampalle', 'Andhra Pradesh', '1', NULL, NULL),
(13, 'Bethamcherla', 'Andhra Pradesh', '1', NULL, NULL),
(14, 'Bhadrachalam', 'Andhra Pradesh', '1', NULL, NULL),
(15, 'Bhainsa', 'Andhra Pradesh', '1', NULL, NULL),
(16, 'Bheemunipatnam', 'Andhra Pradesh', '1', NULL, NULL),
(17, 'Bhimavaram', 'Andhra Pradesh', '1', NULL, NULL),
(18, 'Bhongir', 'Andhra Pradesh', '1', NULL, NULL),
(19, 'Bobbili', 'Andhra Pradesh', '1', NULL, NULL),
(20, 'Bodhan', 'Andhra Pradesh', '1', NULL, NULL),
(21, 'Chilakaluripet', 'Andhra Pradesh', '1', NULL, NULL),
(22, 'Chirala', 'Andhra Pradesh', '1', NULL, NULL),
(23, 'Chittoor', 'Andhra Pradesh', '1', NULL, NULL),
(24, 'Cuddapah', 'Andhra Pradesh', '1', NULL, NULL),
(25, 'Devarakonda', 'Andhra Pradesh', '1', NULL, NULL),
(26, 'Dharmavaram', 'Andhra Pradesh', '1', NULL, NULL),
(27, 'Eluru', 'Andhra Pradesh', '1', NULL, NULL),
(28, 'Farooqnagar', 'Andhra Pradesh', '1', NULL, NULL),
(29, 'Gadwal', 'Andhra Pradesh', '1', NULL, NULL),
(30, 'Gooty', 'Andhra Pradesh', '1', NULL, NULL),
(31, 'Gudivada', 'Andhra Pradesh', '1', NULL, NULL),
(32, 'Gudur', 'Andhra Pradesh', '1', NULL, NULL),
(33, 'Guntakal', 'Andhra Pradesh', '1', NULL, NULL),
(34, 'Guntur', 'Andhra Pradesh', '1', NULL, NULL),
(35, 'Hanuman Junction', 'Andhra Pradesh', '1', NULL, NULL),
(36, 'Hindupur', 'Andhra Pradesh', '1', NULL, NULL),
(37, 'Hyderabad', 'Andhra Pradesh', '1', NULL, NULL),
(38, 'Ichchapuram', 'Andhra Pradesh', '1', NULL, NULL),
(39, 'Jaggaiahpet', 'Andhra Pradesh', '1', NULL, NULL),
(40, 'Jagtial', 'Andhra Pradesh', '1', NULL, NULL),
(41, 'Jammalamadugu', 'Andhra Pradesh', '1', NULL, NULL),
(42, 'Jangaon', 'Andhra Pradesh', '1', NULL, NULL),
(43, 'Kadapa', 'Andhra Pradesh', '1', NULL, NULL),
(44, 'Kadiri', 'Andhra Pradesh', '1', NULL, NULL),
(45, 'Kagaznagar', 'Andhra Pradesh', '1', NULL, NULL),
(46, 'Kakinada', 'Andhra Pradesh', '1', NULL, NULL),
(47, 'Kalyandurg', 'Andhra Pradesh', '1', NULL, NULL),
(48, 'Kamareddy', 'Andhra Pradesh', '1', NULL, NULL),
(49, 'Kandukur', 'Andhra Pradesh', '1', NULL, NULL),
(50, 'Karimnagar', 'Andhra Pradesh', '1', NULL, NULL),
(51, 'Kavali', 'Andhra Pradesh', '1', NULL, NULL),
(52, 'Khammam', 'Andhra Pradesh', '1', NULL, NULL),
(53, 'Koratla', 'Andhra Pradesh', '1', NULL, NULL),
(54, 'Kothagudem', 'Andhra Pradesh', '1', NULL, NULL),
(55, 'Kothapeta', 'Andhra Pradesh', '1', NULL, NULL),
(56, 'Kovvur', 'Andhra Pradesh', '1', NULL, NULL),
(57, 'Kurnool', 'Andhra Pradesh', '1', NULL, NULL),
(58, 'Kyathampalle', 'Andhra Pradesh', '1', NULL, NULL),
(59, 'Macherla', 'Andhra Pradesh', '1', NULL, NULL),
(60, 'Machilipatnam', 'Andhra Pradesh', '1', NULL, NULL),
(61, 'Madanapalle', 'Andhra Pradesh', '1', NULL, NULL),
(62, 'Mahbubnagar', 'Andhra Pradesh', '1', NULL, NULL),
(63, 'Mancherial', 'Andhra Pradesh', '1', NULL, NULL),
(64, 'Mandamarri', 'Andhra Pradesh', '1', NULL, NULL),
(65, 'Mandapeta', 'Andhra Pradesh', '1', NULL, NULL),
(66, 'Manuguru', 'Andhra Pradesh', '1', NULL, NULL),
(67, 'Markapur', 'Andhra Pradesh', '1', NULL, NULL),
(68, 'Medak', 'Andhra Pradesh', '1', NULL, NULL),
(69, 'Miryalaguda', 'Andhra Pradesh', '1', NULL, NULL),
(70, 'Mogalthur', 'Andhra Pradesh', '1', NULL, NULL),
(71, 'Nagari', 'Andhra Pradesh', '1', NULL, NULL),
(72, 'Nagarkurnool', 'Andhra Pradesh', '1', NULL, NULL),
(73, 'Nandyal', 'Andhra Pradesh', '1', NULL, NULL),
(74, 'Narasapur', 'Andhra Pradesh', '1', NULL, NULL),
(75, 'Narasaraopet', 'Andhra Pradesh', '1', NULL, NULL),
(76, 'Narayanpet', 'Andhra Pradesh', '1', NULL, NULL),
(77, 'Narsipatnam', 'Andhra Pradesh', '1', NULL, NULL),
(78, 'Nellore', 'Andhra Pradesh', '1', NULL, NULL),
(79, 'Nidadavole', 'Andhra Pradesh', '1', NULL, NULL),
(80, 'Nirmal', 'Andhra Pradesh', '1', NULL, NULL),
(81, 'Nizamabad', 'Andhra Pradesh', '1', NULL, NULL),
(82, 'Nuzvid', 'Andhra Pradesh', '1', NULL, NULL),
(83, 'Ongole', 'Andhra Pradesh', '1', NULL, NULL),
(84, 'Palacole', 'Andhra Pradesh', '1', NULL, NULL),
(85, 'Palasa Kasibugga', 'Andhra Pradesh', '1', NULL, NULL),
(86, 'Palwancha', 'Andhra Pradesh', '1', NULL, NULL),
(87, 'Parvathipuram', 'Andhra Pradesh', '1', NULL, NULL),
(88, 'Pedana', 'Andhra Pradesh', '1', NULL, NULL),
(89, 'Peddapuram', 'Andhra Pradesh', '1', NULL, NULL),
(90, 'Pithapuram', 'Andhra Pradesh', '1', NULL, NULL),
(91, 'Pondur', 'Andhra pradesh', '1', NULL, NULL),
(92, 'Ponnur', 'Andhra Pradesh', '1', NULL, NULL),
(93, 'Proddatur', 'Andhra Pradesh', '1', NULL, NULL),
(94, 'Punganur', 'Andhra Pradesh', '1', NULL, NULL),
(95, 'Puttur', 'Andhra Pradesh', '1', NULL, NULL),
(96, 'Rajahmundry', 'Andhra Pradesh', '1', NULL, NULL),
(97, 'Rajam', 'Andhra Pradesh', '1', NULL, NULL),
(98, 'Ramachandrapuram', 'Andhra Pradesh', '1', NULL, NULL),
(99, 'Ramagundam', 'Andhra Pradesh', '1', NULL, NULL),
(100, 'Rayachoti', 'Andhra Pradesh', '1', NULL, NULL),
(101, 'Rayadurg', 'Andhra Pradesh', '1', NULL, NULL),
(102, 'Renigunta', 'Andhra Pradesh', '1', NULL, NULL),
(103, 'Repalle', 'Andhra Pradesh', '1', NULL, NULL),
(104, 'Sadasivpet', 'Andhra Pradesh', '1', NULL, NULL),
(105, 'Salur', 'Andhra Pradesh', '1', NULL, NULL),
(106, 'Samalkot', 'Andhra Pradesh', '1', NULL, NULL),
(107, 'Sangareddy', 'Andhra Pradesh', '1', NULL, NULL),
(108, 'Sattenapalle', 'Andhra Pradesh', '1', NULL, NULL),
(109, 'Siddipet', 'Andhra Pradesh', '1', NULL, NULL),
(110, 'Singapur', 'Andhra Pradesh', '1', NULL, NULL),
(111, 'Sircilla', 'Andhra Pradesh', '1', NULL, NULL),
(112, 'Srikakulam', 'Andhra Pradesh', '1', NULL, NULL),
(113, 'Srikalahasti', 'Andhra Pradesh', '1', NULL, NULL),
(115, 'Suryapet', 'Andhra Pradesh', '1', NULL, NULL),
(116, 'Tadepalligudem', 'Andhra Pradesh', '1', NULL, NULL),
(117, 'Tadpatri', 'Andhra Pradesh', '1', NULL, NULL),
(118, 'Tandur', 'Andhra Pradesh', '1', NULL, NULL),
(119, 'Tanuku', 'Andhra Pradesh', '1', NULL, NULL),
(120, 'Tenali', 'Andhra Pradesh', '1', NULL, NULL),
(121, 'Tirupati', 'Andhra Pradesh', '1', NULL, NULL),
(122, 'Tuni', 'Andhra Pradesh', '1', NULL, NULL),
(123, 'Uravakonda', 'Andhra Pradesh', '1', NULL, NULL),
(124, 'Venkatagiri', 'Andhra Pradesh', '1', NULL, NULL),
(125, 'Vicarabad', 'Andhra Pradesh', '1', NULL, NULL),
(126, 'Vijayawada', 'Andhra Pradesh', '1', NULL, NULL),
(127, 'Vinukonda', 'Andhra Pradesh', '1', NULL, NULL),
(128, 'Visakhapatnam', 'Andhra Pradesh', '1', NULL, NULL),
(129, 'Vizianagaram', 'Andhra Pradesh', '1', NULL, NULL),
(130, 'Wanaparthy', 'Andhra Pradesh', '1', NULL, NULL),
(131, 'Warangal', 'Andhra Pradesh', '1', NULL, NULL),
(132, 'Yellandu', 'Andhra Pradesh', '1', NULL, NULL),
(133, 'Yemmiganur', 'Andhra Pradesh', '1', NULL, NULL),
(134, 'Yerraguntla', 'Andhra Pradesh', '1', NULL, NULL),
(135, 'Zahirabad', 'Andhra Pradesh', '1', NULL, NULL),
(136, 'Rajampet', 'Andhra Pradesh', '1', NULL, NULL),
(137, 'Along', 'Arunachal Pradesh', '1', NULL, NULL),
(138, 'Bomdila', 'Arunachal Pradesh', '1', NULL, NULL),
(139, 'Itanagar', 'Arunachal Pradesh', '1', NULL, NULL),
(140, 'Naharlagun', 'Arunachal Pradesh', '1', NULL, NULL),
(141, 'Pasighat', 'Arunachal Pradesh', '1', NULL, NULL),
(142, 'Abhayapuri', 'Assam', '1', NULL, NULL),
(143, 'Amguri', 'Assam', '1', NULL, NULL),
(144, 'Anandnagaar', 'Assam', '1', NULL, NULL),
(145, 'Barpeta', 'Assam', '1', NULL, NULL),
(146, 'Barpeta Road', 'Assam', '1', NULL, NULL),
(147, 'Bilasipara', 'Assam', '1', NULL, NULL),
(148, 'Bongaigaon', 'Assam', '1', NULL, NULL),
(149, 'Dhekiajuli', 'Assam', '1', NULL, NULL),
(150, 'Dhubri', 'Assam', '1', NULL, NULL),
(151, 'Dibrugarh', 'Assam', '1', NULL, NULL),
(152, 'Digboi', 'Assam', '1', NULL, NULL),
(153, 'Diphu', 'Assam', '1', NULL, NULL),
(154, 'Dispur', 'Assam', '1', NULL, NULL),
(156, 'Gauripur', 'Assam', '1', NULL, NULL),
(157, 'Goalpara', 'Assam', '1', NULL, NULL),
(158, 'Golaghat', 'Assam', '1', NULL, NULL),
(159, 'Guwahati', 'Assam', '1', NULL, NULL),
(160, 'Haflong', 'Assam', '1', NULL, NULL),
(161, 'Hailakandi', 'Assam', '1', NULL, NULL),
(162, 'Hojai', 'Assam', '1', NULL, NULL),
(163, 'Jorhat', 'Assam', '1', NULL, NULL),
(164, 'Karimganj', 'Assam', '1', NULL, NULL),
(165, 'Kokrajhar', 'Assam', '1', NULL, NULL),
(166, 'Lanka', 'Assam', '1', NULL, NULL),
(167, 'Lumding', 'Assam', '1', NULL, NULL),
(168, 'Mangaldoi', 'Assam', '1', NULL, NULL),
(169, 'Mankachar', 'Assam', '1', NULL, NULL),
(170, 'Margherita', 'Assam', '1', NULL, NULL),
(171, 'Mariani', 'Assam', '1', NULL, NULL),
(172, 'Marigaon', 'Assam', '1', NULL, NULL),
(173, 'Nagaon', 'Assam', '1', NULL, NULL),
(174, 'Nalbari', 'Assam', '1', NULL, NULL),
(175, 'North Lakhimpur', 'Assam', '1', NULL, NULL),
(176, 'Rangia', 'Assam', '1', NULL, NULL),
(177, 'Sibsagar', 'Assam', '1', NULL, NULL),
(178, 'Silapathar', 'Assam', '1', NULL, NULL),
(179, 'Silchar', 'Assam', '1', NULL, NULL),
(180, 'Tezpur', 'Assam', '1', NULL, NULL),
(181, 'Tinsukia', 'Assam', '1', NULL, NULL),
(182, 'Amarpur', 'Bihar', '1', NULL, NULL),
(183, 'Araria', 'Bihar', '1', NULL, NULL),
(184, 'Areraj', 'Bihar', '1', NULL, NULL),
(185, 'Arrah', 'Bihar', '1', NULL, NULL),
(186, 'Asarganj', 'Bihar', '1', NULL, NULL),
(187, 'Aurangabad', 'Bihar', '1', NULL, NULL),
(188, 'Bagaha', 'Bihar', '1', NULL, NULL),
(189, 'Bahadurganj', 'Bihar', '1', NULL, NULL),
(190, 'Bairgania', 'Bihar', '1', NULL, NULL),
(191, 'Bakhtiarpur', 'Bihar', '1', NULL, NULL),
(192, 'Banka', 'Bihar', '1', NULL, NULL),
(193, 'Banmankhi Bazar', 'Bihar', '1', NULL, NULL),
(194, 'Barahiya', 'Bihar', '1', NULL, NULL),
(195, 'Barauli', 'Bihar', '1', NULL, NULL),
(196, 'Barbigha', 'Bihar', '1', NULL, NULL),
(197, 'Barh', 'Bihar', '1', NULL, NULL),
(198, 'Begusarai', 'Bihar', '1', NULL, NULL),
(199, 'Behea', 'Bihar', '1', NULL, NULL),
(200, 'Bettiah', 'Bihar', '1', NULL, NULL),
(201, 'Bhabua', 'Bihar', '1', NULL, NULL),
(202, 'Bhagalpur', 'Bihar', '1', NULL, NULL),
(203, 'Bihar Sharif', 'Bihar', '1', NULL, NULL),
(204, 'Bikramganj', 'Bihar', '1', NULL, NULL),
(205, 'Bodh Gaya', 'Bihar', '1', NULL, NULL),
(206, 'Buxar', 'Bihar', '1', NULL, NULL),
(207, 'Chandan Bara', 'Bihar', '1', NULL, NULL),
(208, 'Chanpatia', 'Bihar', '1', NULL, NULL),
(209, 'Chhapra', 'Bihar', '1', NULL, NULL),
(210, 'Colgong', 'Bihar', '1', NULL, NULL),
(211, 'Dalsinghsarai', 'Bihar', '1', NULL, NULL),
(212, 'Darbhanga', 'Bihar', '1', NULL, NULL),
(213, 'Daudnagar', 'Bihar', '1', NULL, NULL),
(214, 'Dehri-on-Sone', 'Bihar', '1', NULL, NULL),
(215, 'Dhaka', 'Bihar', '1', NULL, NULL),
(216, 'Dighwara', 'Bihar', '1', NULL, NULL),
(217, 'Dumraon', 'Bihar', '1', NULL, NULL),
(218, 'Fatwah', 'Bihar', '1', NULL, NULL),
(219, 'Forbesganj', 'Bihar', '1', NULL, NULL),
(220, 'Gaya', 'Bihar', '1', NULL, NULL),
(221, 'Gogri Jamalpur', 'Bihar', '1', NULL, NULL),
(222, 'Gopalganj', 'Bihar', '1', NULL, NULL),
(223, 'Hajipur', 'Bihar', '1', NULL, NULL),
(224, 'Hilsa', 'Bihar', '1', NULL, NULL),
(225, 'Hisua', 'Bihar', '1', NULL, NULL),
(226, 'Islampur', 'Bihar', '1', NULL, NULL),
(227, 'Jagdispur', 'Bihar', '1', NULL, NULL),
(228, 'Jamalpur', 'Bihar', '1', NULL, NULL),
(229, 'Jamui', 'Bihar', '1', NULL, NULL),
(230, 'Jehanabad', 'Bihar', '1', NULL, NULL),
(231, 'Jhajha', 'Bihar', '1', NULL, NULL),
(232, 'Jhanjharpur', 'Bihar', '1', NULL, NULL),
(233, 'Jogabani', 'Bihar', '1', NULL, NULL),
(234, 'Kanti', 'Bihar', '1', NULL, NULL),
(235, 'Katihar', 'Bihar', '1', NULL, NULL),
(236, 'Khagaria', 'Bihar', '1', NULL, NULL),
(237, 'Kharagpur', 'Bihar', '1', NULL, NULL),
(238, 'Kishanganj', 'Bihar', '1', NULL, NULL),
(239, 'Lakhisarai', 'Bihar', '1', NULL, NULL),
(240, 'Lalganj', 'Bihar', '1', NULL, NULL),
(241, 'Madhepura', 'Bihar', '1', NULL, NULL),
(242, 'Madhubani', 'Bihar', '1', NULL, NULL),
(243, 'Maharajganj', 'Bihar', '1', NULL, NULL),
(244, 'Mahnar Bazar', 'Bihar', '1', NULL, NULL),
(245, 'Makhdumpur', 'Bihar', '1', NULL, NULL),
(246, 'Maner', 'Bihar', '1', NULL, NULL),
(247, 'Manihari', 'Bihar', '1', NULL, NULL),
(248, 'Marhaura', 'Bihar', '1', NULL, NULL),
(249, 'Masaurhi', 'Bihar', '1', NULL, NULL),
(250, 'Mirganj', 'Bihar', '1', NULL, NULL),
(251, 'Mokameh', 'Bihar', '1', NULL, NULL),
(252, 'Motihari', 'Bihar', '1', NULL, NULL),
(253, 'Motipur', 'Bihar', '1', NULL, NULL),
(254, 'Munger', 'Bihar', '1', NULL, NULL),
(255, 'Murliganj', 'Bihar', '1', NULL, NULL),
(256, 'Muzaffarpur', 'Bihar', '1', NULL, NULL),
(257, 'Narkatiaganj', 'Bihar', '1', NULL, NULL),
(258, 'Naugachhia', 'Bihar', '1', NULL, NULL),
(259, 'Nawada', 'Bihar', '1', NULL, NULL),
(260, 'Nokha', 'Bihar', '1', NULL, NULL),
(261, 'Patna', 'Bihar', '1', NULL, NULL),
(262, 'Piro', 'Bihar', '1', NULL, NULL),
(263, 'Purnia', 'Bihar', '1', NULL, NULL),
(264, 'Rafiganj', 'Bihar', '1', NULL, NULL),
(265, 'Rajgir', 'Bihar', '1', NULL, NULL),
(266, 'Ramnagar', 'Bihar', '1', NULL, NULL),
(267, 'Raxaul Bazar', 'Bihar', '1', NULL, NULL),
(268, 'Revelganj', 'Bihar', '1', NULL, NULL),
(269, 'Rosera', 'Bihar', '1', NULL, NULL),
(270, 'Saharsa', 'Bihar', '1', NULL, NULL),
(271, 'Samastipur', 'Bihar', '1', NULL, NULL),
(272, 'Sasaram', 'Bihar', '1', NULL, NULL),
(273, 'Sheikhpura', 'Bihar', '1', NULL, NULL),
(274, 'Sheohar', 'Bihar', '1', NULL, NULL),
(275, 'Sherghati', 'Bihar', '1', NULL, NULL),
(276, 'Silao', 'Bihar', '1', NULL, NULL),
(277, 'Sitamarhi', 'Bihar', '1', NULL, NULL),
(278, 'Siwan', 'Bihar', '1', NULL, NULL),
(279, 'Sonepur', 'Bihar', '1', NULL, NULL),
(280, 'Sugauli', 'Bihar', '1', NULL, NULL),
(281, 'Sultanganj', 'Bihar', '1', NULL, NULL),
(282, 'Supaul', 'Bihar', '1', NULL, NULL),
(283, 'Warisaliganj', 'Bihar', '1', NULL, NULL),
(284, 'Ahiwara', 'Chhattisgarh', '1', NULL, NULL),
(285, 'Akaltara', 'Chhattisgarh', '1', NULL, NULL),
(286, 'Ambagarh Chowki', 'Chhattisgarh', '1', NULL, NULL),
(287, 'Ambikapur', 'Chhattisgarh', '1', NULL, NULL),
(288, 'Arang', 'Chhattisgarh', '1', NULL, NULL),
(289, 'Bade Bacheli', 'Chhattisgarh', '1', NULL, NULL),
(290, 'Balod', 'Chhattisgarh', '1', NULL, NULL),
(291, 'Baloda Bazar', 'Chhattisgarh', '1', NULL, NULL),
(292, 'Bemetra', 'Chhattisgarh', '1', NULL, NULL),
(293, 'Bhatapara', 'Chhattisgarh', '1', NULL, NULL),
(294, 'Bilaspur', 'Chhattisgarh', '1', NULL, NULL),
(295, 'Birgaon', 'Chhattisgarh', '1', NULL, NULL),
(296, 'Champa', 'Chhattisgarh', '1', NULL, NULL),
(297, 'Chirmiri', 'Chhattisgarh', '1', NULL, NULL),
(298, 'Dalli-Rajhara', 'Chhattisgarh', '1', NULL, NULL),
(299, 'Dhamtari', 'Chhattisgarh', '1', NULL, NULL),
(300, 'Dipka', 'Chhattisgarh', '1', NULL, NULL),
(301, 'Dongargarh', 'Chhattisgarh', '1', NULL, NULL),
(302, 'Durg-Bhilai Nagar', 'Chhattisgarh', '1', NULL, NULL),
(303, 'Gobranawapara', 'Chhattisgarh', '1', NULL, NULL),
(304, 'Jagdalpur', 'Chhattisgarh', '1', NULL, NULL),
(305, 'Janjgir', 'Chhattisgarh', '1', NULL, NULL),
(306, 'Jashpurnagar', 'Chhattisgarh', '1', NULL, NULL),
(307, 'Kanker', 'Chhattisgarh', '1', NULL, NULL),
(308, 'Kawardha', 'Chhattisgarh', '1', NULL, NULL),
(309, 'Kondagaon', 'Chhattisgarh', '1', NULL, NULL),
(310, 'Korba', 'Chhattisgarh', '1', NULL, NULL),
(311, 'Mahasamund', 'Chhattisgarh', '1', NULL, NULL),
(312, 'Mahendragarh', 'Chhattisgarh', '1', NULL, NULL),
(313, 'Mungeli', 'Chhattisgarh', '1', NULL, NULL),
(314, 'Naila Janjgir', 'Chhattisgarh', '1', NULL, NULL),
(315, 'Raigarh', 'Chhattisgarh', '1', NULL, NULL),
(316, 'Raipur', 'Chhattisgarh', '1', NULL, NULL),
(317, 'Rajnandgaon', 'Chhattisgarh', '1', NULL, NULL),
(318, 'Sakti', 'Chhattisgarh', '1', NULL, NULL),
(319, 'Tilda Newra', 'Chhattisgarh', '1', NULL, NULL),
(320, 'Amli', 'Dadra & Nagar Haveli', '1', NULL, NULL),
(321, 'Silvassa', 'Dadra & Nagar Haveli', '1', NULL, NULL),
(322, 'Daman and Diu', 'Daman & Diu', '1', NULL, NULL),
(323, 'Daman and Diu', 'Daman & Diu', '1', NULL, NULL),
(324, 'Asola', 'Delhi', '1', NULL, NULL),
(325, 'Delhi', 'Delhi', '1', NULL, NULL),
(326, 'Aldona', 'Goa', '1', NULL, NULL),
(327, 'Curchorem Cacora', 'Goa', '1', NULL, NULL),
(328, 'Madgaon', 'Goa', '1', NULL, NULL),
(329, 'Mapusa', 'Goa', '1', NULL, NULL),
(330, 'Margao', 'Goa', '1', NULL, NULL),
(331, 'Marmagao', 'Goa', '1', NULL, NULL),
(332, 'Panaji', 'Goa', '1', NULL, NULL),
(333, 'Ahmedabad', 'Gujarat', '1', NULL, NULL),
(334, 'Amreli', 'Gujarat', '1', NULL, NULL),
(335, 'Anand', 'Gujarat', '1', NULL, NULL),
(336, 'Ankleshwar', 'Gujarat', '1', NULL, NULL),
(337, 'Bharuch', 'Gujarat', '1', NULL, NULL),
(338, 'Bhavnagar', 'Gujarat', '1', NULL, NULL),
(339, 'Bhuj', 'Gujarat', '1', NULL, NULL),
(340, 'Cambay', 'Gujarat', '1', NULL, NULL),
(341, 'Dahod', 'Gujarat', '1', NULL, NULL),
(342, 'Deesa', 'Gujarat', '1', NULL, NULL),
(343, 'Dharampur', ' India', '1', NULL, NULL),
(344, 'Dholka', 'Gujarat', '1', NULL, NULL),
(345, 'Gandhinagar', 'Gujarat', '1', NULL, NULL),
(346, 'Godhra', 'Gujarat', '1', NULL, NULL),
(347, 'Himatnagar', 'Gujarat', '1', NULL, NULL),
(348, 'Idar', 'Gujarat', '1', NULL, NULL),
(349, 'Jamnagar', 'Gujarat', '1', NULL, NULL),
(350, 'Junagadh', 'Gujarat', '1', NULL, NULL),
(351, 'Kadi', 'Gujarat', '1', NULL, NULL),
(352, 'Kalavad', 'Gujarat', '1', NULL, NULL),
(353, 'Kalol', 'Gujarat', '1', NULL, NULL),
(354, 'Kapadvanj', 'Gujarat', '1', NULL, NULL),
(355, 'Karjan', 'Gujarat', '1', NULL, NULL),
(356, 'Keshod', 'Gujarat', '1', NULL, NULL),
(357, 'Khambhalia', 'Gujarat', '1', NULL, NULL),
(358, 'Khambhat', 'Gujarat', '1', NULL, NULL),
(359, 'Kheda', 'Gujarat', '1', NULL, NULL),
(360, 'Khedbrahma', 'Gujarat', '1', NULL, NULL),
(361, 'Kheralu', 'Gujarat', '1', NULL, NULL),
(362, 'Kodinar', 'Gujarat', '1', NULL, NULL),
(363, 'Lathi', 'Gujarat', '1', NULL, NULL),
(364, 'Limbdi', 'Gujarat', '1', NULL, NULL),
(365, 'Lunawada', 'Gujarat', '1', NULL, NULL),
(366, 'Mahesana', 'Gujarat', '1', NULL, NULL),
(367, 'Mahuva', 'Gujarat', '1', NULL, NULL),
(368, 'Manavadar', 'Gujarat', '1', NULL, NULL),
(369, 'Mandvi', 'Gujarat', '1', NULL, NULL),
(370, 'Mangrol', 'Gujarat', '1', NULL, NULL),
(371, 'Mansa', 'Gujarat', '1', NULL, NULL),
(372, 'Mehmedabad', 'Gujarat', '1', NULL, NULL),
(373, 'Modasa', 'Gujarat', '1', NULL, NULL),
(374, 'Morvi', 'Gujarat', '1', NULL, NULL),
(375, 'Nadiad', 'Gujarat', '1', NULL, NULL),
(376, 'Navsari', 'Gujarat', '1', NULL, NULL),
(377, 'Padra', 'Gujarat', '1', NULL, NULL),
(378, 'Palanpur', 'Gujarat', '1', NULL, NULL),
(379, 'Palitana', 'Gujarat', '1', NULL, NULL),
(380, 'Pardi', 'Gujarat', '1', NULL, NULL),
(381, 'Patan', 'Gujarat', '1', NULL, NULL),
(382, 'Petlad', 'Gujarat', '1', NULL, NULL),
(383, 'Porbandar', 'Gujarat', '1', NULL, NULL),
(384, 'Radhanpur', 'Gujarat', '1', NULL, NULL),
(385, 'Rajkot', 'Gujarat', '1', NULL, NULL),
(386, 'Rajpipla', 'Gujarat', '1', NULL, NULL),
(387, 'Rajula', 'Gujarat', '1', NULL, NULL),
(388, 'Ranavav', 'Gujarat', '1', NULL, NULL),
(389, 'Rapar', 'Gujarat', '1', NULL, NULL),
(390, 'Salaya', 'Gujarat', '1', NULL, NULL),
(391, 'Sanand', 'Gujarat', '1', NULL, NULL),
(392, 'Savarkundla', 'Gujarat', '1', NULL, NULL),
(393, 'Sidhpur', 'Gujarat', '1', NULL, NULL),
(394, 'Sihor', 'Gujarat', '1', NULL, NULL),
(395, 'Songadh', 'Gujarat', '1', NULL, NULL),
(396, 'Surat', 'Gujarat', '1', NULL, NULL),
(397, 'Talaja', 'Gujarat', '1', NULL, NULL),
(398, 'Thangadh', 'Gujarat', '1', NULL, NULL),
(399, 'Tharad', 'Gujarat', '1', NULL, NULL),
(400, 'Umbergaon', 'Gujarat', '1', NULL, NULL),
(401, 'Umreth', 'Gujarat', '1', NULL, NULL),
(402, 'Una', 'Gujarat', '1', NULL, NULL),
(403, 'Unjha', 'Gujarat', '1', NULL, NULL),
(404, 'Upleta', 'Gujarat', '1', NULL, NULL),
(405, 'Vadnagar', 'Gujarat', '1', NULL, NULL),
(406, 'Vadodara', 'Gujarat', '1', NULL, NULL),
(407, 'Valsad', 'Gujarat', '1', NULL, NULL),
(408, 'Vapi', 'Gujarat', '1', NULL, NULL),
(409, 'Vapi', 'Gujarat', '1', NULL, NULL),
(410, 'Veraval', 'Gujarat', '1', NULL, NULL),
(411, 'Vijapur', 'Gujarat', '1', NULL, NULL),
(412, 'Viramgam', 'Gujarat', '1', NULL, NULL),
(413, 'Visnagar', 'Gujarat', '1', NULL, NULL),
(414, 'Vyara', 'Gujarat', '1', NULL, NULL),
(415, 'Wadhwan', 'Gujarat', '1', NULL, NULL),
(416, 'Wankaner', 'Gujarat', '1', NULL, NULL),
(417, 'Adalaj', 'Gujrat', '1', NULL, NULL),
(418, 'Adityana', 'Gujrat', '1', NULL, NULL),
(419, 'Alang', 'Gujrat', '1', NULL, NULL),
(420, 'Ambaji', 'Gujrat', '1', NULL, NULL),
(421, 'Ambaliyasan', 'Gujrat', '1', NULL, NULL),
(422, 'Andada', 'Gujrat', '1', NULL, NULL),
(423, 'Anjar', 'Gujrat', '1', NULL, NULL),
(424, 'Anklav', 'Gujrat', '1', NULL, NULL),
(425, 'Antaliya', 'Gujrat', '1', NULL, NULL),
(426, 'Arambhada', 'Gujrat', '1', NULL, NULL),
(427, 'Atul', 'Gujrat', '1', NULL, NULL),
(428, 'Ballabhgarh', 'Hariyana', '1', NULL, NULL),
(429, 'Ambala', 'Haryana', '1', NULL, NULL),
(430, 'Ambala', 'Haryana', '1', NULL, NULL),
(431, 'Asankhurd', 'Haryana', '1', NULL, NULL),
(432, 'Assandh', 'Haryana', '1', NULL, NULL),
(433, 'Ateli', 'Haryana', '1', NULL, NULL),
(434, 'Babiyal', 'Haryana', '1', NULL, NULL),
(435, 'Bahadurgarh', 'Haryana', '1', NULL, NULL),
(436, 'Barwala', 'Haryana', '1', NULL, NULL),
(437, 'Bhiwani', 'Haryana', '1', NULL, NULL),
(438, 'Charkhi Dadri', 'Haryana', '1', NULL, NULL),
(439, 'Cheeka', 'Haryana', '1', NULL, NULL),
(440, 'Ellenabad 2', 'Haryana', '1', NULL, NULL),
(441, 'Faridabad', 'Haryana', '1', NULL, NULL),
(442, 'Fatehabad', 'Haryana', '1', NULL, NULL),
(443, 'Ganaur', 'Haryana', '1', NULL, NULL),
(444, 'Gharaunda', 'Haryana', '1', NULL, NULL),
(445, 'Gohana', 'Haryana', '1', NULL, NULL),
(446, 'Gurgaon', 'Haryana', '1', NULL, NULL),
(447, 'Haibat(Yamuna Nagar)', 'Haryana', '1', NULL, NULL),
(448, 'Hansi', 'Haryana', '1', NULL, NULL),
(449, 'Hisar', 'Haryana', '1', NULL, NULL),
(450, 'Hodal', 'Haryana', '1', NULL, NULL),
(451, 'Jhajjar', 'Haryana', '1', NULL, NULL),
(452, 'Jind', 'Haryana', '1', NULL, NULL),
(453, 'Kaithal', 'Haryana', '1', NULL, NULL),
(454, 'Kalan Wali', 'Haryana', '1', NULL, NULL),
(455, 'Kalka', 'Haryana', '1', NULL, NULL),
(456, 'Karnal', 'Haryana', '1', NULL, NULL),
(457, 'Ladwa', 'Haryana', '1', NULL, NULL),
(458, 'Mahendragarh', 'Haryana', '1', NULL, NULL),
(459, 'Mandi Dabwali', 'Haryana', '1', NULL, NULL),
(460, 'Narnaul', 'Haryana', '1', NULL, NULL),
(461, 'Narwana', 'Haryana', '1', NULL, NULL),
(462, 'Palwal', 'Haryana', '1', NULL, NULL),
(463, 'Panchkula', 'Haryana', '1', NULL, NULL),
(464, 'Panipat', 'Haryana', '1', NULL, NULL),
(465, 'Pehowa', 'Haryana', '1', NULL, NULL),
(466, 'Pinjore', 'Haryana', '1', NULL, NULL),
(467, 'Rania', 'Haryana', '1', NULL, NULL),
(468, 'Ratia', 'Haryana', '1', NULL, NULL),
(469, 'Rewari', 'Haryana', '1', NULL, NULL),
(470, 'Rohtak', 'Haryana', '1', NULL, NULL),
(471, 'Safidon', 'Haryana', '1', NULL, NULL),
(472, 'Samalkha', 'Haryana', '1', NULL, NULL),
(473, 'Shahbad', 'Haryana', '1', NULL, NULL),
(474, 'Sirsa', 'Haryana', '1', NULL, NULL),
(475, 'Sohna', 'Haryana', '1', NULL, NULL),
(476, 'Sonipat', 'Haryana', '1', NULL, NULL),
(477, 'Taraori', 'Haryana', '1', NULL, NULL),
(478, 'Thanesar', 'Haryana', '1', NULL, NULL),
(479, 'Tohana', 'Haryana', '1', NULL, NULL),
(480, 'Yamunanagar', 'Haryana', '1', NULL, NULL),
(481, 'Arki', 'Himachal Pradesh', '1', NULL, NULL),
(482, 'Baddi', 'Himachal Pradesh', '1', NULL, NULL),
(483, 'Bilaspur', 'Himachal Pradesh', '1', NULL, NULL),
(484, 'Chamba', 'Himachal Pradesh', '1', NULL, NULL),
(485, 'Dalhousie', 'Himachal Pradesh', '1', NULL, NULL),
(486, 'Dharamsala', 'Himachal Pradesh', '1', NULL, NULL),
(487, 'Hamirpur', 'Himachal Pradesh', '1', NULL, NULL),
(488, 'Mandi', 'Himachal Pradesh', '1', NULL, NULL),
(489, 'Nahan', 'Himachal Pradesh', '1', NULL, NULL),
(490, 'Shimla', 'Himachal Pradesh', '1', NULL, NULL),
(491, 'Solan', 'Himachal Pradesh', '1', NULL, NULL),
(492, 'Sundarnagar', 'Himachal Pradesh', '1', NULL, NULL),
(493, 'Jammu', 'Jammu & Kashmir', '1', NULL, NULL),
(494, 'Achabbal', 'Jammu & Kashmir', '1', NULL, NULL),
(495, 'Akhnoor', 'Jammu & Kashmir', '1', NULL, NULL),
(496, 'Anantnag', 'Jammu & Kashmir', '1', NULL, NULL),
(497, 'Arnia', 'Jammu & Kashmir', '1', NULL, NULL),
(498, 'Awantipora', 'Jammu & Kashmir', '1', NULL, NULL),
(499, 'Bandipore', 'Jammu & Kashmir', '1', NULL, NULL),
(500, 'Baramula', 'Jammu & Kashmir', '1', NULL, NULL),
(501, 'Kathua', 'Jammu & Kashmir', '1', NULL, NULL),
(502, 'Leh', 'Jammu & Kashmir', '1', NULL, NULL),
(503, 'Punch', 'Jammu & Kashmir', '1', NULL, NULL),
(504, 'Rajauri', 'Jammu & Kashmir', '1', NULL, NULL),
(505, 'Sopore', 'Jammu & Kashmir', '1', NULL, NULL),
(506, 'Srinagar', 'Jammu & Kashmir', '1', NULL, NULL),
(507, 'Udhampur', 'Jammu & Kashmir', '1', NULL, NULL),
(508, 'Amlabad', 'Jharkhand', '1', NULL, NULL),
(509, 'Ara', 'Jharkhand', '1', NULL, NULL),
(510, 'Barughutu', 'Jharkhand', '1', NULL, NULL),
(511, 'Bokaro Steel City', 'Jharkhand', '1', NULL, NULL),
(512, 'Chaibasa', 'Jharkhand', '1', NULL, NULL),
(513, 'Chakradharpur', 'Jharkhand', '1', NULL, NULL),
(514, 'Chandrapura', 'Jharkhand', '1', NULL, NULL),
(515, 'Chatra', 'Jharkhand', '1', NULL, NULL),
(516, 'Chirkunda', 'Jharkhand', '1', NULL, NULL),
(517, 'Churi', 'Jharkhand', '1', NULL, NULL),
(518, 'Daltonganj', 'Jharkhand', '1', NULL, NULL),
(519, 'Deoghar', 'Jharkhand', '1', NULL, NULL),
(520, 'Dhanbad', 'Jharkhand', '1', NULL, NULL),
(521, 'Dumka', 'Jharkhand', '1', NULL, NULL),
(522, 'Garhwa', 'Jharkhand', '1', NULL, NULL),
(523, 'Ghatshila', 'Jharkhand', '1', NULL, NULL),
(524, 'Giridih', 'Jharkhand', '1', NULL, NULL),
(525, 'Godda', 'Jharkhand', '1', NULL, NULL),
(526, 'Gomoh', 'Jharkhand', '1', NULL, NULL),
(527, 'Gumia', 'Jharkhand', '1', NULL, NULL),
(528, 'Gumla', 'Jharkhand', '1', NULL, NULL),
(529, 'Hazaribag', 'Jharkhand', '1', NULL, NULL),
(530, 'Hussainabad', 'Jharkhand', '1', NULL, NULL),
(531, 'Jamshedpur', 'Jharkhand', '1', NULL, NULL),
(532, 'Jamtara', 'Jharkhand', '1', NULL, NULL),
(533, 'Jhumri Tilaiya', 'Jharkhand', '1', NULL, NULL),
(534, 'Khunti', 'Jharkhand', '1', NULL, NULL),
(535, 'Lohardaga', 'Jharkhand', '1', NULL, NULL),
(536, 'Madhupur', 'Jharkhand', '1', NULL, NULL),
(537, 'Mihijam', 'Jharkhand', '1', NULL, NULL),
(538, 'Musabani', 'Jharkhand', '1', NULL, NULL),
(539, 'Pakaur', 'Jharkhand', '1', NULL, NULL),
(540, 'Patratu', 'Jharkhand', '1', NULL, NULL),
(541, 'Phusro', 'Jharkhand', '1', NULL, NULL),
(542, 'Ramngarh', 'Jharkhand', '1', NULL, NULL),
(543, 'Ranchi', 'Jharkhand', '1', NULL, NULL),
(544, 'Sahibganj', 'Jharkhand', '1', NULL, NULL),
(545, 'Saunda', 'Jharkhand', '1', NULL, NULL),
(546, 'Simdega', 'Jharkhand', '1', NULL, NULL),
(547, 'Tenu Dam-cum- Kathhara', 'Jharkhand', '1', NULL, NULL),
(548, 'Arasikere', 'Karnataka', '1', NULL, NULL),
(549, 'Bangalore', 'Karnataka', '1', NULL, NULL),
(550, 'Belgaum', 'Karnataka', '1', NULL, NULL),
(551, 'Bellary', 'Karnataka', '1', NULL, NULL),
(552, 'Chamrajnagar', 'Karnataka', '1', NULL, NULL),
(553, 'Chikkaballapur', 'Karnataka', '1', NULL, NULL),
(554, 'Chintamani', 'Karnataka', '1', NULL, NULL),
(555, 'Chitradurga', 'Karnataka', '1', NULL, NULL),
(556, 'Gulbarga', 'Karnataka', '1', NULL, NULL),
(557, 'Gundlupet', 'Karnataka', '1', NULL, NULL),
(558, 'Hassan', 'Karnataka', '1', NULL, NULL),
(559, 'Hospet', 'Karnataka', '1', NULL, NULL),
(560, 'Hubli', 'Karnataka', '1', NULL, NULL),
(561, 'Karkala', 'Karnataka', '1', NULL, NULL),
(562, 'Karwar', 'Karnataka', '1', NULL, NULL),
(563, 'Kolar', 'Karnataka', '1', NULL, NULL),
(564, 'Kota', 'Karnataka', '1', NULL, NULL),
(565, 'Lakshmeshwar', 'Karnataka', '1', NULL, NULL),
(566, 'Lingsugur', 'Karnataka', '1', NULL, NULL),
(567, 'Maddur', 'Karnataka', '1', NULL, NULL),
(568, 'Madhugiri', 'Karnataka', '1', NULL, NULL),
(569, 'Madikeri', 'Karnataka', '1', NULL, NULL),
(570, 'Magadi', 'Karnataka', '1', NULL, NULL),
(571, 'Mahalingpur', 'Karnataka', '1', NULL, NULL),
(572, 'Malavalli', 'Karnataka', '1', NULL, NULL),
(573, 'Malur', 'Karnataka', '1', NULL, NULL),
(574, 'Mandya', 'Karnataka', '1', NULL, NULL),
(575, 'Mangalore', 'Karnataka', '1', NULL, NULL),
(576, 'Manvi', 'Karnataka', '1', NULL, NULL),
(577, 'Mudalgi', 'Karnataka', '1', NULL, NULL),
(578, 'Mudbidri', 'Karnataka', '1', NULL, NULL),
(579, 'Muddebihal', 'Karnataka', '1', NULL, NULL),
(580, 'Mudhol', 'Karnataka', '1', NULL, NULL),
(581, 'Mulbagal', 'Karnataka', '1', NULL, NULL),
(582, 'Mundargi', 'Karnataka', '1', NULL, NULL),
(583, 'Mysore', 'Karnataka', '1', NULL, NULL),
(584, 'Nanjangud', 'Karnataka', '1', NULL, NULL),
(585, 'Pavagada', 'Karnataka', '1', NULL, NULL),
(586, 'Puttur', 'Karnataka', '1', NULL, NULL),
(587, 'Rabkavi Banhatti', 'Karnataka', '1', NULL, NULL),
(588, 'Raichur', 'Karnataka', '1', NULL, NULL),
(589, 'Ramanagaram', 'Karnataka', '1', NULL, NULL),
(590, 'Ramdurg', 'Karnataka', '1', NULL, NULL),
(591, 'Ranibennur', 'Karnataka', '1', NULL, NULL),
(592, 'Robertson Pet', 'Karnataka', '1', NULL, NULL),
(593, 'Ron', 'Karnataka', '1', NULL, NULL),
(594, 'Sadalgi', 'Karnataka', '1', NULL, NULL),
(595, 'Sagar', 'Karnataka', '1', NULL, NULL),
(596, 'Sakleshpur', 'Karnataka', '1', NULL, NULL),
(597, 'Sandur', 'Karnataka', '1', NULL, NULL),
(598, 'Sankeshwar', 'Karnataka', '1', NULL, NULL),
(599, 'Saundatti-Yellamma', 'Karnataka', '1', NULL, NULL),
(600, 'Savanur', 'Karnataka', '1', NULL, NULL),
(601, 'Sedam', 'Karnataka', '1', NULL, NULL),
(602, 'Shahabad', 'Karnataka', '1', NULL, NULL),
(603, 'Shahpur', 'Karnataka', '1', NULL, NULL),
(604, 'Shiggaon', 'Karnataka', '1', NULL, NULL),
(605, 'Shikapur', 'Karnataka', '1', NULL, NULL),
(606, 'Shimoga', 'Karnataka', '1', NULL, NULL),
(607, 'Shorapur', 'Karnataka', '1', NULL, NULL),
(608, 'Shrirangapattana', 'Karnataka', '1', NULL, NULL),
(609, 'Sidlaghatta', 'Karnataka', '1', NULL, NULL),
(610, 'Sindgi', 'Karnataka', '1', NULL, NULL),
(611, 'Sindhnur', 'Karnataka', '1', NULL, NULL),
(612, 'Sira', 'Karnataka', '1', NULL, NULL),
(613, 'Sirsi', 'Karnataka', '1', NULL, NULL),
(614, 'Siruguppa', 'Karnataka', '1', NULL, NULL),
(615, 'Srinivaspur', 'Karnataka', '1', NULL, NULL),
(616, 'Talikota', 'Karnataka', '1', NULL, NULL),
(617, 'Tarikere', 'Karnataka', '1', NULL, NULL),
(618, 'Tekkalakota', 'Karnataka', '1', NULL, NULL),
(619, 'Terdal', 'Karnataka', '1', NULL, NULL),
(620, 'Tiptur', 'Karnataka', '1', NULL, NULL),
(621, 'Tumkur', 'Karnataka', '1', NULL, NULL),
(622, 'Udupi', 'Karnataka', '1', NULL, NULL),
(623, 'Vijayapura', 'Karnataka', '1', NULL, NULL),
(624, 'Wadi', 'Karnataka', '1', NULL, NULL),
(625, 'Yadgir', 'Karnataka', '1', NULL, NULL),
(626, 'Adoor', 'Kerala', '1', NULL, NULL),
(627, 'Akathiyoor', 'Kerala', '1', NULL, NULL),
(628, 'Alappuzha', 'Kerala', '1', NULL, NULL),
(629, 'Ancharakandy', 'Kerala', '1', NULL, NULL),
(630, 'Aroor', 'Kerala', '1', NULL, NULL),
(631, 'Ashtamichira', 'Kerala', '1', NULL, NULL),
(632, 'Attingal', 'Kerala', '1', NULL, NULL),
(633, 'Avinissery', 'Kerala', '1', NULL, NULL),
(634, 'Chalakudy', 'Kerala', '1', NULL, NULL),
(635, 'Changanassery', 'Kerala', '1', NULL, NULL),
(636, 'Chendamangalam', 'Kerala', '1', NULL, NULL),
(637, 'Chengannur', 'Kerala', '1', NULL, NULL),
(638, 'Cherthala', 'Kerala', '1', NULL, NULL),
(639, 'Cheruthazham', 'Kerala', '1', NULL, NULL),
(640, 'Chittur-Thathamangalam', 'Kerala', '1', NULL, NULL),
(641, 'Chockli', 'Kerala', '1', NULL, NULL),
(642, 'Erattupetta', 'Kerala', '1', NULL, NULL),
(643, 'Guruvayoor', 'Kerala', '1', NULL, NULL),
(644, 'Irinjalakuda', 'Kerala', '1', NULL, NULL),
(645, 'Kadirur', 'Kerala', '1', NULL, NULL),
(646, 'Kalliasseri', 'Kerala', '1', NULL, NULL),
(647, 'Kalpetta', 'Kerala', '1', NULL, NULL),
(648, 'Kanhangad', 'Kerala', '1', NULL, NULL),
(649, 'Kanjikkuzhi', 'Kerala', '1', NULL, NULL),
(650, 'Kannur', 'Kerala', '1', NULL, NULL),
(651, 'Kasaragod', 'Kerala', '1', NULL, NULL),
(652, 'Kayamkulam', 'Kerala', '1', NULL, NULL),
(653, 'Kochi', 'Kerala', '1', NULL, NULL),
(654, 'Kodungallur', 'Kerala', '1', NULL, NULL),
(655, 'Kollam', 'Kerala', '1', NULL, NULL),
(656, 'Koothuparamba', 'Kerala', '1', NULL, NULL),
(657, 'Kothamangalam', 'Kerala', '1', NULL, NULL),
(658, 'Kottayam', 'Kerala', '1', NULL, NULL),
(659, 'Kozhikode', 'Kerala', '1', NULL, NULL),
(660, 'Kunnamkulam', 'Kerala', '1', NULL, NULL),
(661, 'Malappuram', 'Kerala', '1', NULL, NULL),
(662, 'Mattannur', 'Kerala', '1', NULL, NULL),
(663, 'Mavelikkara', 'Kerala', '1', NULL, NULL),
(664, 'Mavoor', 'Kerala', '1', NULL, NULL),
(665, 'Muvattupuzha', 'Kerala', '1', NULL, NULL),
(666, 'Nedumangad', 'Kerala', '1', NULL, NULL),
(667, 'Neyyattinkara', 'Kerala', '1', NULL, NULL),
(668, 'Ottappalam', 'Kerala', '1', NULL, NULL),
(669, 'Palai', 'Kerala', '1', NULL, NULL),
(670, 'Palakkad', 'Kerala', '1', NULL, NULL),
(671, 'Panniyannur', 'Kerala', '1', NULL, NULL),
(672, 'Pappinisseri', 'Kerala', '1', NULL, NULL),
(673, 'Paravoor', 'Kerala', '1', NULL, NULL),
(674, 'Pathanamthitta', 'Kerala', '1', NULL, NULL),
(675, 'Payyannur', 'Kerala', '1', NULL, NULL),
(676, 'Peringathur', 'Kerala', '1', NULL, NULL),
(677, 'Perinthalmanna', 'Kerala', '1', NULL, NULL),
(678, 'Perumbavoor', 'Kerala', '1', NULL, NULL),
(679, 'Ponnani', 'Kerala', '1', NULL, NULL),
(680, 'Punalur', 'Kerala', '1', NULL, NULL),
(681, 'Quilandy', 'Kerala', '1', NULL, NULL),
(682, 'Shoranur', 'Kerala', '1', NULL, NULL),
(683, 'Taliparamba', 'Kerala', '1', NULL, NULL),
(684, 'Thiruvalla', 'Kerala', '1', NULL, NULL),
(685, 'Thiruvananthapuram', 'Kerala', '1', NULL, NULL),
(686, 'Thodupuzha', 'Kerala', '1', NULL, NULL),
(687, 'Thrissur', 'Kerala', '1', NULL, NULL),
(688, 'Tirur', 'Kerala', '1', NULL, NULL),
(689, 'Vadakara', 'Kerala', '1', NULL, NULL),
(690, 'Vaikom', 'Kerala', '1', NULL, NULL),
(691, 'Varkala', 'Kerala', '1', NULL, NULL),
(692, 'Kavaratti', 'Lakshadweep', '1', NULL, NULL),
(693, 'Ashok Nagar', 'Madhya Pradesh', '1', NULL, NULL),
(694, 'Balaghat', 'Madhya Pradesh', '1', NULL, NULL),
(695, 'Betul', 'Madhya Pradesh', '1', NULL, NULL),
(696, 'Bhopal', 'Madhya Pradesh', '1', NULL, NULL),
(697, 'Burhanpur', 'Madhya Pradesh', '1', NULL, NULL),
(698, 'Chhatarpur', 'Madhya Pradesh', '1', NULL, NULL),
(699, 'Dabra', 'Madhya Pradesh', '1', NULL, NULL),
(700, 'Datia', 'Madhya Pradesh', '1', NULL, NULL),
(701, 'Dewas', 'Madhya Pradesh', '1', NULL, NULL),
(702, 'Dhar', 'Madhya Pradesh', '1', NULL, NULL),
(703, 'Fatehabad', 'Madhya Pradesh', '1', NULL, NULL),
(704, 'Gwalior', 'Madhya Pradesh', '1', NULL, NULL),
(705, 'Indore', 'Madhya Pradesh', '1', NULL, NULL),
(706, 'Itarsi', 'Madhya Pradesh', '1', NULL, NULL),
(707, 'Jabalpur', 'Madhya Pradesh', '1', NULL, NULL),
(708, 'Katni', 'Madhya Pradesh', '1', NULL, NULL),
(709, 'Kotma', 'Madhya Pradesh', '1', NULL, NULL),
(710, 'Lahar', 'Madhya Pradesh', '1', NULL, NULL),
(711, 'Lundi', 'Madhya Pradesh', '1', NULL, NULL),
(712, 'Maharajpur', 'Madhya Pradesh', '1', NULL, NULL),
(713, 'Mahidpur', 'Madhya Pradesh', '1', NULL, NULL),
(714, 'Maihar', 'Madhya Pradesh', '1', NULL, NULL),
(715, 'Malajkhand', 'Madhya Pradesh', '1', NULL, NULL),
(716, 'Manasa', 'Madhya Pradesh', '1', NULL, NULL),
(717, 'Manawar', 'Madhya Pradesh', '1', NULL, NULL),
(718, 'Mandideep', 'Madhya Pradesh', '1', NULL, NULL),
(719, 'Mandla', 'Madhya Pradesh', '1', NULL, NULL),
(720, 'Mandsaur', 'Madhya Pradesh', '1', NULL, NULL),
(721, 'Mauganj', 'Madhya Pradesh', '1', NULL, NULL),
(722, 'Mhow Cantonment', 'Madhya Pradesh', '1', NULL, NULL),
(723, 'Mhowgaon', 'Madhya Pradesh', '1', NULL, NULL),
(724, 'Morena', 'Madhya Pradesh', '1', NULL, NULL),
(725, 'Multai', 'Madhya Pradesh', '1', NULL, NULL),
(726, 'Murwara', 'Madhya Pradesh', '1', NULL, NULL),
(727, 'Nagda', 'Madhya Pradesh', '1', NULL, NULL),
(728, 'Nainpur', 'Madhya Pradesh', '1', NULL, NULL),
(729, 'Narsinghgarh', 'Madhya Pradesh', '1', NULL, NULL),
(730, 'Narsinghgarh', 'Madhya Pradesh', '1', NULL, NULL),
(731, 'Neemuch', 'Madhya Pradesh', '1', NULL, NULL),
(732, 'Nepanagar', 'Madhya Pradesh', '1', NULL, NULL),
(733, 'Niwari', 'Madhya Pradesh', '1', NULL, NULL),
(734, 'Nowgong', 'Madhya Pradesh', '1', NULL, NULL),
(735, 'Nowrozabad', 'Madhya Pradesh', '1', NULL, NULL),
(736, 'Pachore', 'Madhya Pradesh', '1', NULL, NULL),
(737, 'Pali', 'Madhya Pradesh', '1', NULL, NULL),
(738, 'Panagar', 'Madhya Pradesh', '1', NULL, NULL),
(739, 'Pandhurna', 'Madhya Pradesh', '1', NULL, NULL),
(740, 'Panna', 'Madhya Pradesh', '1', NULL, NULL),
(741, 'Pasan', 'Madhya Pradesh', '1', NULL, NULL),
(742, 'Pipariya', 'Madhya Pradesh', '1', NULL, NULL),
(743, 'Pithampur', 'Madhya Pradesh', '1', NULL, NULL),
(744, 'Porsa', 'Madhya Pradesh', '1', NULL, NULL),
(745, 'Prithvipur', 'Madhya Pradesh', '1', NULL, NULL),
(746, 'Raghogarh-Vijaypur', 'Madhya Pradesh', '1', NULL, NULL),
(747, 'Rahatgarh', 'Madhya Pradesh', '1', NULL, NULL),
(748, 'Raisen', 'Madhya Pradesh', '1', NULL, NULL),
(749, 'Rajgarh', 'Madhya Pradesh', '1', NULL, NULL),
(750, 'Ratlam', 'Madhya Pradesh', '1', NULL, NULL),
(751, 'Rau', 'Madhya Pradesh', '1', NULL, NULL),
(752, 'Rehli', 'Madhya Pradesh', '1', NULL, NULL),
(753, 'Rewa', 'Madhya Pradesh', '1', NULL, NULL),
(754, 'Sabalgarh', 'Madhya Pradesh', '1', NULL, NULL),
(755, 'Sagar', 'Madhya Pradesh', '1', NULL, NULL),
(756, 'Sanawad', 'Madhya Pradesh', '1', NULL, NULL),
(757, 'Sarangpur', 'Madhya Pradesh', '1', NULL, NULL),
(758, 'Sarni', 'Madhya Pradesh', '1', NULL, NULL),
(759, 'Satna', 'Madhya Pradesh', '1', NULL, NULL),
(760, 'Sausar', 'Madhya Pradesh', '1', NULL, NULL),
(761, 'Sehore', 'Madhya Pradesh', '1', NULL, NULL),
(762, 'Sendhwa', 'Madhya Pradesh', '1', NULL, NULL),
(763, 'Seoni', 'Madhya Pradesh', '1', NULL, NULL),
(764, 'Seoni-Malwa', 'Madhya Pradesh', '1', NULL, NULL),
(765, 'Shahdol', 'Madhya Pradesh', '1', NULL, NULL),
(766, 'Shajapur', 'Madhya Pradesh', '1', NULL, NULL),
(767, 'Shamgarh', 'Madhya Pradesh', '1', NULL, NULL),
(768, 'Sheopur', 'Madhya Pradesh', '1', NULL, NULL),
(769, 'Shivpuri', 'Madhya Pradesh', '1', NULL, NULL),
(770, 'Shujalpur', 'Madhya Pradesh', '1', NULL, NULL),
(771, 'Sidhi', 'Madhya Pradesh', '1', NULL, NULL),
(772, 'Sihora', 'Madhya Pradesh', '1', NULL, NULL),
(773, 'Singrauli', 'Madhya Pradesh', '1', NULL, NULL),
(774, 'Sironj', 'Madhya Pradesh', '1', NULL, NULL),
(775, 'Sohagpur', 'Madhya Pradesh', '1', NULL, NULL),
(776, 'Tarana', 'Madhya Pradesh', '1', NULL, NULL),
(777, 'Tikamgarh', 'Madhya Pradesh', '1', NULL, NULL),
(778, 'Ujhani', 'Madhya Pradesh', '1', NULL, NULL),
(779, 'Ujjain', 'Madhya Pradesh', '1', NULL, NULL),
(780, 'Umaria', 'Madhya Pradesh', '1', NULL, NULL),
(781, 'Vidisha', 'Madhya Pradesh', '1', NULL, NULL),
(782, 'Wara Seoni', 'Madhya Pradesh', '1', NULL, NULL),
(783, 'Ahmednagar', 'Maharashtra', '1', NULL, NULL),
(784, 'Akola', 'Maharashtra', '1', NULL, NULL),
(785, 'Amravati', 'Maharashtra', '1', NULL, NULL),
(786, 'Aurangabad', 'Maharashtra', '1', NULL, NULL),
(787, 'Baramati', 'Maharashtra', '1', NULL, NULL),
(788, 'Chalisgaon', 'Maharashtra', '1', NULL, NULL),
(789, 'Chinchani', 'Maharashtra', '1', NULL, NULL),
(790, 'Devgarh', 'Maharashtra', '1', NULL, NULL),
(791, 'Dhule', 'Maharashtra', '1', NULL, NULL),
(792, 'Dombivli', 'Maharashtra', '1', NULL, NULL),
(793, 'Durgapur', 'Maharashtra', '1', NULL, NULL),
(794, 'Ichalkaranji', 'Maharashtra', '1', NULL, NULL),
(795, 'Jalna', 'Maharashtra', '1', NULL, NULL),
(796, 'Kalyan', 'Maharashtra', '1', NULL, NULL),
(797, 'Latur', 'Maharashtra', '1', NULL, NULL),
(798, 'Loha', 'Maharashtra', '1', NULL, NULL),
(799, 'Lonar', 'Maharashtra', '1', NULL, NULL),
(800, 'Lonavla', 'Maharashtra', '1', NULL, NULL),
(801, 'Mahad', 'Maharashtra', '1', NULL, NULL),
(802, 'Mahuli', 'Maharashtra', '1', NULL, NULL),
(803, 'Malegaon', 'Maharashtra', '1', NULL, NULL),
(804, 'Malkapur', 'Maharashtra', '1', NULL, NULL),
(805, 'Manchar', 'Maharashtra', '1', NULL, NULL),
(806, 'Mangalvedhe', 'Maharashtra', '1', NULL, NULL),
(807, 'Mangrulpir', 'Maharashtra', '1', NULL, NULL),
(808, 'Manjlegaon', 'Maharashtra', '1', NULL, NULL),
(809, 'Manmad', 'Maharashtra', '1', NULL, NULL),
(810, 'Manwath', 'Maharashtra', '1', NULL, NULL),
(811, 'Mehkar', 'Maharashtra', '1', NULL, NULL),
(812, 'Mhaswad', 'Maharashtra', '1', NULL, NULL),
(813, 'Miraj', 'Maharashtra', '1', NULL, NULL),
(814, 'Morshi', 'Maharashtra', '1', NULL, NULL),
(815, 'Mukhed', 'Maharashtra', '1', NULL, NULL),
(816, 'Mul', 'Maharashtra', '1', NULL, NULL),
(817, 'Mumbai', 'Maharashtra', '1', NULL, NULL),
(818, 'Murtijapur', 'Maharashtra', '1', NULL, NULL),
(819, 'Nagpur', 'Maharashtra', '1', NULL, NULL),
(820, 'Nalasopara', 'Maharashtra', '1', NULL, NULL),
(821, 'Nanded-Waghala', 'Maharashtra', '1', NULL, NULL),
(822, 'Nandgaon', 'Maharashtra', '1', NULL, NULL),
(823, 'Nandura', 'Maharashtra', '1', NULL, NULL),
(824, 'Nandurbar', 'Maharashtra', '1', NULL, NULL),
(825, 'Narkhed', 'Maharashtra', '1', NULL, NULL),
(826, 'Nashik', 'Maharashtra', '1', NULL, NULL),
(827, 'Navi Mumbai', 'Maharashtra', '1', NULL, NULL),
(828, 'Nawapur', 'Maharashtra', '1', NULL, NULL),
(829, 'Nilanga', 'Maharashtra', '1', NULL, NULL),
(830, 'Osmanabad', 'Maharashtra', '1', NULL, NULL),
(831, 'Ozar', 'Maharashtra', '1', NULL, NULL),
(832, 'Pachora', 'Maharashtra', '1', NULL, NULL),
(833, 'Paithan', 'Maharashtra', '1', NULL, NULL),
(834, 'Palghar', 'Maharashtra', '1', NULL, NULL),
(835, 'Pandharkaoda', 'Maharashtra', '1', NULL, NULL),
(836, 'Pandharpur', 'Maharashtra', '1', NULL, NULL),
(837, 'Panvel', 'Maharashtra', '1', NULL, NULL),
(838, 'Parbhani', 'Maharashtra', '1', NULL, NULL),
(839, 'Parli', 'Maharashtra', '1', NULL, NULL),
(840, 'Parola', 'Maharashtra', '1', NULL, NULL),
(841, 'Partur', 'Maharashtra', '1', NULL, NULL),
(842, 'Pathardi', 'Maharashtra', '1', NULL, NULL),
(843, 'Pathri', 'Maharashtra', '1', NULL, NULL),
(844, 'Patur', 'Maharashtra', '1', NULL, NULL),
(845, 'Pauni', 'Maharashtra', '1', NULL, NULL),
(846, 'Pen', 'Maharashtra', '1', NULL, NULL),
(847, 'Phaltan', 'Maharashtra', '1', NULL, NULL),
(848, 'Pulgaon', 'Maharashtra', '1', NULL, NULL),
(849, 'Pune', 'Maharashtra', '1', NULL, NULL),
(850, 'Purna', 'Maharashtra', '1', NULL, NULL),
(851, 'Pusad', 'Maharashtra', '1', NULL, NULL),
(852, 'Rahuri', 'Maharashtra', '1', NULL, NULL),
(853, 'Rajura', 'Maharashtra', '1', NULL, NULL),
(854, 'Ramtek', 'Maharashtra', '1', NULL, NULL),
(855, 'Ratnagiri', 'Maharashtra', '1', NULL, NULL),
(856, 'Raver', 'Maharashtra', '1', NULL, NULL),
(857, 'Risod', 'Maharashtra', '1', NULL, NULL),
(858, 'Sailu', 'Maharashtra', '1', NULL, NULL),
(859, 'Sangamner', 'Maharashtra', '1', NULL, NULL),
(860, 'Sangli', 'Maharashtra', '1', NULL, NULL),
(861, 'Sangole', 'Maharashtra', '1', NULL, NULL),
(862, 'Sasvad', 'Maharashtra', '1', NULL, NULL),
(863, 'Satana', 'Maharashtra', '1', NULL, NULL),
(864, 'Satara', 'Maharashtra', '1', NULL, NULL),
(865, 'Savner', 'Maharashtra', '1', NULL, NULL),
(866, 'Sawantwadi', 'Maharashtra', '1', NULL, NULL),
(867, 'Shahade', 'Maharashtra', '1', NULL, NULL),
(868, 'Shegaon', 'Maharashtra', '1', NULL, NULL),
(869, 'Shendurjana', 'Maharashtra', '1', NULL, NULL),
(870, 'Shirdi', 'Maharashtra', '1', NULL, NULL),
(871, 'Shirpur-Warwade', 'Maharashtra', '1', NULL, NULL),
(872, 'Shirur', 'Maharashtra', '1', NULL, NULL),
(873, 'Shrigonda', 'Maharashtra', '1', NULL, NULL),
(874, 'Shrirampur', 'Maharashtra', '1', NULL, NULL),
(875, 'Sillod', 'Maharashtra', '1', NULL, NULL),
(876, 'Sinnar', 'Maharashtra', '1', NULL, NULL),
(877, 'Solapur', 'Maharashtra', '1', NULL, NULL),
(878, 'Soyagaon', 'Maharashtra', '1', NULL, NULL),
(879, 'Talegaon Dabhade', 'Maharashtra', '1', NULL, NULL),
(880, 'Talode', 'Maharashtra', '1', NULL, NULL),
(881, 'Tasgaon', 'Maharashtra', '1', NULL, NULL),
(882, 'Tirora', 'Maharashtra', '1', NULL, NULL),
(883, 'Tuljapur', 'Maharashtra', '1', NULL, NULL),
(884, 'Tumsar', 'Maharashtra', '1', NULL, NULL),
(885, 'Uran', 'Maharashtra', '1', NULL, NULL),
(886, 'Uran Islampur', 'Maharashtra', '1', NULL, NULL),
(887, 'Wadgaon Road', 'Maharashtra', '1', NULL, NULL),
(888, 'Wai', 'Maharashtra', '1', NULL, NULL),
(889, 'Wani', 'Maharashtra', '1', NULL, NULL),
(890, 'Wardha', 'Maharashtra', '1', NULL, NULL),
(891, 'Warora', 'Maharashtra', '1', NULL, NULL),
(892, 'Warud', 'Maharashtra', '1', NULL, NULL),
(893, 'Washim', 'Maharashtra', '1', NULL, NULL),
(894, 'Yevla', 'Maharashtra', '1', NULL, NULL),
(895, 'Uchgaon', 'Maharashtra', '1', NULL, NULL),
(896, 'Udgir', 'Maharashtra', '1', NULL, NULL),
(897, 'Umarga', 'Maharastra', '1', NULL, NULL),
(898, 'Umarkhed', 'Maharastra', '1', NULL, NULL),
(899, 'Umred', 'Maharastra', '1', NULL, NULL),
(900, 'Vadgaon Kasba', 'Maharastra', '1', NULL, NULL),
(901, 'Vaijapur', 'Maharastra', '1', NULL, NULL),
(902, 'Vasai', 'Maharastra', '1', NULL, NULL),
(903, 'Virar', 'Maharastra', '1', NULL, NULL),
(904, 'Vita', 'Maharastra', '1', NULL, NULL),
(905, 'Yavatmal', 'Maharastra', '1', NULL, NULL),
(906, 'Yawal', 'Maharastra', '1', NULL, NULL),
(907, 'Imphal', 'Manipur', '1', NULL, NULL),
(908, 'Kakching', 'Manipur', '1', NULL, NULL),
(909, 'Lilong', 'Manipur', '1', NULL, NULL),
(910, 'Mayang Imphal', 'Manipur', '1', NULL, NULL),
(911, 'Thoubal', 'Manipur', '1', NULL, NULL),
(912, 'Jowai', 'Meghalaya', '1', NULL, NULL),
(913, 'Nongstoin', 'Meghalaya', '1', NULL, NULL),
(914, 'Shillong', 'Meghalaya', '1', NULL, NULL),
(915, 'Tura', 'Meghalaya', '1', NULL, NULL),
(916, 'Aizawl', 'Mizoram', '1', NULL, NULL),
(917, 'Champhai', 'Mizoram', '1', NULL, NULL),
(918, 'Lunglei', 'Mizoram', '1', NULL, NULL),
(919, 'Saiha', 'Mizoram', '1', NULL, NULL),
(920, 'Dimapur', 'Nagaland', '1', NULL, NULL),
(921, 'Kohima', 'Nagaland', '1', NULL, NULL),
(922, 'Mokokchung', 'Nagaland', '1', NULL, NULL),
(923, 'Tuensang', 'Nagaland', '1', NULL, NULL),
(924, 'Wokha', 'Nagaland', '1', NULL, NULL),
(925, 'Zunheboto', 'Nagaland', '1', NULL, NULL),
(950, 'Anandapur', 'Orissa', '1', NULL, NULL),
(951, 'Anugul', 'Orissa', '1', NULL, NULL),
(952, 'Asika', 'Orissa', '1', NULL, NULL),
(953, 'Balangir', 'Orissa', '1', NULL, NULL),
(954, 'Balasore', 'Orissa', '1', NULL, NULL),
(955, 'Baleshwar', 'Orissa', '1', NULL, NULL),
(956, 'Bamra', 'Orissa', '1', NULL, NULL),
(957, 'Barbil', 'Orissa', '1', NULL, NULL),
(958, 'Bargarh', 'Orissa', '1', NULL, NULL),
(959, 'Bargarh', 'Orissa', '1', NULL, NULL),
(960, 'Baripada', 'Orissa', '1', NULL, NULL),
(961, 'Basudebpur', 'Orissa', '1', NULL, NULL),
(962, 'Belpahar', 'Orissa', '1', NULL, NULL),
(963, 'Bhadrak', 'Orissa', '1', NULL, NULL),
(964, 'Bhawanipatna', 'Orissa', '1', NULL, NULL),
(965, 'Bhuban', 'Orissa', '1', NULL, NULL),
(966, 'Bhubaneswar', 'Orissa', '1', NULL, NULL),
(967, 'Biramitrapur', 'Orissa', '1', NULL, NULL),
(968, 'Brahmapur', 'Orissa', '1', NULL, NULL),
(969, 'Brajrajnagar', 'Orissa', '1', NULL, NULL),
(970, 'Byasanagar', 'Orissa', '1', NULL, NULL),
(971, 'Cuttack', 'Orissa', '1', NULL, NULL),
(972, 'Debagarh', 'Orissa', '1', NULL, NULL),
(973, 'Dhenkanal', 'Orissa', '1', NULL, NULL),
(974, 'Gunupur', 'Orissa', '1', NULL, NULL),
(975, 'Hinjilicut', 'Orissa', '1', NULL, NULL),
(976, 'Jagatsinghapur', 'Orissa', '1', NULL, NULL),
(977, 'Jajapur', 'Orissa', '1', NULL, NULL),
(978, 'Jaleswar', 'Orissa', '1', NULL, NULL),
(979, 'Jatani', 'Orissa', '1', NULL, NULL),
(980, 'Jeypur', 'Orissa', '1', NULL, NULL),
(981, 'Jharsuguda', 'Orissa', '1', NULL, NULL),
(982, 'Joda', 'Orissa', '1', NULL, NULL),
(983, 'Kantabanji', 'Orissa', '1', NULL, NULL),
(984, 'Karanjia', 'Orissa', '1', NULL, NULL),
(985, 'Kendrapara', 'Orissa', '1', NULL, NULL),
(986, 'Kendujhar', 'Orissa', '1', NULL, NULL),
(987, 'Khordha', 'Orissa', '1', NULL, NULL),
(988, 'Koraput', 'Orissa', '1', NULL, NULL),
(989, 'Malkangiri', 'Orissa', '1', NULL, NULL),
(990, 'Nabarangapur', 'Orissa', '1', NULL, NULL),
(991, 'Paradip', 'Orissa', '1', NULL, NULL),
(992, 'Parlakhemundi', 'Orissa', '1', NULL, NULL),
(993, 'Pattamundai', 'Orissa', '1', NULL, NULL),
(994, 'Phulabani', 'Orissa', '1', NULL, NULL),
(995, 'Puri', 'Orissa', '1', NULL, NULL),
(996, 'Rairangpur', 'Orissa', '1', NULL, NULL),
(997, 'Rajagangapur', 'Orissa', '1', NULL, NULL),
(998, 'Raurkela', 'Orissa', '1', NULL, NULL),
(999, 'Rayagada', 'Orissa', '1', NULL, NULL),
(1000, 'Sambalpur', 'Orissa', '1', NULL, NULL),
(1001, 'Soro', 'Orissa', '1', NULL, NULL),
(1002, 'Sunabeda', 'Orissa', '1', NULL, NULL),
(1003, 'Sundargarh', 'Orissa', '1', NULL, NULL),
(1004, 'Talcher', 'Orissa', '1', NULL, NULL),
(1005, 'Titlagarh', 'Orissa', '1', NULL, NULL),
(1006, 'Umarkote', 'Orissa', '1', NULL, NULL),
(1007, 'Karaikal', 'Pondicherry', '1', NULL, NULL),
(1008, 'Mahe', 'Pondicherry', '1', NULL, NULL),
(1009, 'Pondicherry', 'Pondicherry', '1', NULL, NULL),
(1010, 'Yanam', 'Pondicherry', '1', NULL, NULL),
(1011, 'Ahmedgarh', 'Punjab', '1', NULL, NULL),
(1012, 'Amritsar', 'Punjab', '1', NULL, NULL),
(1013, 'Barnala', 'Punjab', '1', NULL, NULL),
(1014, 'Batala', 'Punjab', '1', NULL, NULL),
(1015, 'Bathinda', 'Punjab', '1', NULL, NULL),
(1016, 'Bhagha Purana', 'Punjab', '1', NULL, NULL),
(1017, 'Budhlada', 'Punjab', '1', NULL, NULL),
(1018, 'Chandigarh', 'Punjab', '1', NULL, NULL),
(1019, 'Dasua', 'Punjab', '1', NULL, NULL),
(1020, 'Dhuri', 'Punjab', '1', NULL, NULL),
(1021, 'Dinanagar', 'Punjab', '1', NULL, NULL),
(1022, 'Faridkot', 'Punjab', '1', NULL, NULL),
(1023, 'Fazilka', 'Punjab', '1', NULL, NULL),
(1024, 'Firozpur', 'Punjab', '1', NULL, NULL),
(1025, 'Firozpur Cantt.', 'Punjab', '1', NULL, NULL),
(1026, 'Giddarbaha', 'Punjab', '1', NULL, NULL),
(1027, 'Gobindgarh', 'Punjab', '1', NULL, NULL),
(1028, 'Gurdaspur', 'Punjab', '1', NULL, NULL),
(1029, 'Hoshiarpur', 'Punjab', '1', NULL, NULL),
(1030, 'Jagraon', 'Punjab', '1', NULL, NULL),
(1031, 'Jaitu', 'Punjab', '1', NULL, NULL),
(1032, 'Jalalabad', 'Punjab', '1', NULL, NULL),
(1033, 'Jalandhar', 'Punjab', '1', NULL, NULL),
(1034, 'Jalandhar Cantt.', 'Punjab', '1', NULL, NULL),
(1035, 'Jandiala', 'Punjab', '1', NULL, NULL),
(1036, 'Kapurthala', 'Punjab', '1', NULL, NULL),
(1037, 'Karoran', 'Punjab', '1', NULL, NULL),
(1038, 'Kartarpur', 'Punjab', '1', NULL, NULL),
(1039, 'Khanna', 'Punjab', '1', NULL, NULL),
(1040, 'Kharar', 'Punjab', '1', NULL, NULL),
(1041, 'Kot Kapura', 'Punjab', '1', NULL, NULL),
(1042, 'Kurali', 'Punjab', '1', NULL, NULL),
(1043, 'Longowal', 'Punjab', '1', NULL, NULL),
(1044, 'Ludhiana', 'Punjab', '1', NULL, NULL),
(1045, 'Malerkotla', 'Punjab', '1', NULL, NULL),
(1046, 'Malout', 'Punjab', '1', NULL, NULL),
(1047, 'Mansa', 'Punjab', '1', NULL, NULL),
(1048, 'Maur', 'Punjab', '1', NULL, NULL),
(1049, 'Moga', 'Punjab', '1', NULL, NULL),
(1050, 'Mohali', 'Punjab', '1', NULL, NULL),
(1051, 'Morinda', 'Punjab', '1', NULL, NULL),
(1052, 'Mukerian', 'Punjab', '1', NULL, NULL),
(1053, 'Muktsar', 'Punjab', '1', NULL, NULL),
(1054, 'Nabha', 'Punjab', '1', NULL, NULL),
(1055, 'Nakodar', 'Punjab', '1', NULL, NULL),
(1056, 'Nangal', 'Punjab', '1', NULL, NULL),
(1057, 'Nawanshahr', 'Punjab', '1', NULL, NULL),
(1058, 'Pathankot', 'Punjab', '1', NULL, NULL),
(1059, 'Patiala', 'Punjab', '1', NULL, NULL),
(1060, 'Patran', 'Punjab', '1', NULL, NULL),
(1061, 'Patti', 'Punjab', '1', NULL, NULL),
(1062, 'Phagwara', 'Punjab', '1', NULL, NULL),
(1063, 'Phillaur', 'Punjab', '1', NULL, NULL),
(1064, 'Qadian', 'Punjab', '1', NULL, NULL),
(1065, 'Raikot', 'Punjab', '1', NULL, NULL),
(1066, 'Rajpura', 'Punjab', '1', NULL, NULL),
(1067, 'Rampura Phul', 'Punjab', '1', NULL, NULL),
(1068, 'Rupnagar', 'Punjab', '1', NULL, NULL),
(1069, 'Samana', 'Punjab', '1', NULL, NULL),
(1070, 'Sangrur', 'Punjab', '1', NULL, NULL),
(1071, 'Sirhind Fatehgarh Sahib', 'Punjab', '1', NULL, NULL),
(1072, 'Sujanpur', 'Punjab', '1', NULL, NULL),
(1073, 'Sunam', 'Punjab', '1', NULL, NULL),
(1074, 'Talwara', 'Punjab', '1', NULL, NULL),
(1075, 'Tarn Taran', 'Punjab', '1', NULL, NULL),
(1076, 'Urmar Tanda', 'Punjab', '1', NULL, NULL),
(1077, 'Zira', 'Punjab', '1', NULL, NULL),
(1078, 'Zirakpur', 'Punjab', '1', NULL, NULL),
(1079, 'Bali', 'Rajasthan', '1', NULL, NULL),
(1080, 'Banswara', 'Rajastan', '1', NULL, NULL),
(1081, 'Ajmer', 'Rajasthan', '1', NULL, NULL),
(1082, 'Alwar', 'Rajasthan', '1', NULL, NULL),
(1083, 'Bandikui', 'Rajasthan', '1', NULL, NULL),
(1084, 'Baran', 'Rajasthan', '1', NULL, NULL);
INSERT INTO `location_masters` (`id`, `location`, `location_state`, `status`, `created_at`, `updated_at`) VALUES
(1085, 'Barmer', 'Rajasthan', '1', NULL, NULL),
(1086, 'Bikaner', 'Rajasthan', '1', NULL, NULL),
(1087, 'Fatehpur', 'Rajasthan', '1', NULL, NULL),
(1088, 'Jaipur', 'Rajasthan', '1', NULL, NULL),
(1089, 'Jaisalmer', 'Rajasthan', '1', NULL, NULL),
(1090, 'Jodhpur', 'Rajasthan', '1', NULL, NULL),
(1091, 'Kota', 'Rajasthan', '1', NULL, NULL),
(1092, 'Lachhmangarh', 'Rajasthan', '1', NULL, NULL),
(1093, 'Ladnu', 'Rajasthan', '1', NULL, NULL),
(1094, 'Lakheri', 'Rajasthan', '1', NULL, NULL),
(1095, 'Lalsot', 'Rajasthan', '1', NULL, NULL),
(1096, 'Losal', 'Rajasthan', '1', NULL, NULL),
(1097, 'Makrana', 'Rajasthan', '1', NULL, NULL),
(1098, 'Malpura', 'Rajasthan', '1', NULL, NULL),
(1099, 'Mandalgarh', 'Rajasthan', '1', NULL, NULL),
(1100, 'Mandawa', 'Rajasthan', '1', NULL, NULL),
(1101, 'Mangrol', 'Rajasthan', '1', NULL, NULL),
(1102, 'Merta City', 'Rajasthan', '1', NULL, NULL),
(1103, 'Mount Abu', 'Rajasthan', '1', NULL, NULL),
(1104, 'Nadbai', 'Rajasthan', '1', NULL, NULL),
(1105, 'Nagar', 'Rajasthan', '1', NULL, NULL),
(1106, 'Nagaur', 'Rajasthan', '1', NULL, NULL),
(1107, 'Nargund', 'Rajasthan', '1', NULL, NULL),
(1108, 'Nasirabad', 'Rajasthan', '1', NULL, NULL),
(1109, 'Nathdwara', 'Rajasthan', '1', NULL, NULL),
(1110, 'Navalgund', 'Rajasthan', '1', NULL, NULL),
(1111, 'Nawalgarh', 'Rajasthan', '1', NULL, NULL),
(1112, 'Neem-Ka-Thana', 'Rajasthan', '1', NULL, NULL),
(1113, 'Nelamangala', 'Rajasthan', '1', NULL, NULL),
(1114, 'Nimbahera', 'Rajasthan', '1', NULL, NULL),
(1115, 'Nipani', 'Rajasthan', '1', NULL, NULL),
(1116, 'Niwai', 'Rajasthan', '1', NULL, NULL),
(1117, 'Nohar', 'Rajasthan', '1', NULL, NULL),
(1118, 'Nokha', 'Rajasthan', '1', NULL, NULL),
(1119, 'Pali', 'Rajasthan', '1', NULL, NULL),
(1120, 'Phalodi', 'Rajasthan', '1', NULL, NULL),
(1121, 'Phulera', 'Rajasthan', '1', NULL, NULL),
(1122, 'Pilani', 'Rajasthan', '1', NULL, NULL),
(1123, 'Pilibanga', 'Rajasthan', '1', NULL, NULL),
(1124, 'Pindwara', 'Rajasthan', '1', NULL, NULL),
(1125, 'Pipar City', 'Rajasthan', '1', NULL, NULL),
(1126, 'Prantij', 'Rajasthan', '1', NULL, NULL),
(1127, 'Pratapgarh', 'Rajasthan', '1', NULL, NULL),
(1128, 'Raisinghnagar', 'Rajasthan', '1', NULL, NULL),
(1129, 'Rajakhera', 'Rajasthan', '1', NULL, NULL),
(1130, 'Rajaldesar', 'Rajasthan', '1', NULL, NULL),
(1131, 'Rajgarh (Alwar)', 'Rajasthan', '1', NULL, NULL),
(1132, 'Rajgarh (Churu', 'Rajasthan', '1', NULL, NULL),
(1133, 'Rajsamand', 'Rajasthan', '1', NULL, NULL),
(1134, 'Ramganj Mandi', 'Rajasthan', '1', NULL, NULL),
(1135, 'Ramngarh', 'Rajasthan', '1', NULL, NULL),
(1136, 'Ratangarh', 'Rajasthan', '1', NULL, NULL),
(1137, 'Rawatbhata', 'Rajasthan', '1', NULL, NULL),
(1138, 'Rawatsar', 'Rajasthan', '1', NULL, NULL),
(1139, 'Reengus', 'Rajasthan', '1', NULL, NULL),
(1140, 'Sadri', 'Rajasthan', '1', NULL, NULL),
(1141, 'Sadulshahar', 'Rajasthan', '1', NULL, NULL),
(1142, 'Sagwara', 'Rajasthan', '1', NULL, NULL),
(1143, 'Sambhar', 'Rajasthan', '1', NULL, NULL),
(1144, 'Sanchore', 'Rajasthan', '1', NULL, NULL),
(1145, 'Sangaria', 'Rajasthan', '1', NULL, NULL),
(1146, 'Sardarshahar', 'Rajasthan', '1', NULL, NULL),
(1147, 'Sawai Madhopur', 'Rajasthan', '1', NULL, NULL),
(1148, 'Shahpura', 'Rajasthan', '1', NULL, NULL),
(1149, 'Shahpura', 'Rajasthan', '1', NULL, NULL),
(1150, 'Sheoganj', 'Rajasthan', '1', NULL, NULL),
(1151, 'Sikar', 'Rajasthan', '1', NULL, NULL),
(1152, 'Sirohi', 'Rajasthan', '1', NULL, NULL),
(1153, 'Sojat', 'Rajasthan', '1', NULL, NULL),
(1154, 'Sri Madhopur', 'Rajasthan', '1', NULL, NULL),
(1155, 'Sujangarh', 'Rajasthan', '1', NULL, NULL),
(1156, 'Sumerpur', 'Rajasthan', '1', NULL, NULL),
(1157, 'Suratgarh', 'Rajasthan', '1', NULL, NULL),
(1158, 'Taranagar', 'Rajasthan', '1', NULL, NULL),
(1159, 'Todabhim', 'Rajasthan', '1', NULL, NULL),
(1160, 'Todaraisingh', 'Rajasthan', '1', NULL, NULL),
(1161, 'Tonk', 'Rajasthan', '1', NULL, NULL),
(1162, 'Udaipur', 'Rajasthan', '1', NULL, NULL),
(1163, 'Udaipurwati', 'Rajasthan', '1', NULL, NULL),
(1164, 'Vijainagar', 'Rajasthan', '1', NULL, NULL),
(1165, 'Gangtok', 'Sikkim', '1', NULL, NULL),
(1166, 'Calcutta', 'West Bengal', '1', NULL, NULL),
(1167, 'Arakkonam', 'Tamil Nadu', '1', NULL, NULL),
(1168, 'Arcot', 'Tamil Nadu', '1', NULL, NULL),
(1169, 'Aruppukkottai', 'Tamil Nadu', '1', NULL, NULL),
(1170, 'Bhavani', 'Tamil Nadu', '1', NULL, NULL),
(1171, 'Chengalpattu', 'Tamil Nadu', '1', NULL, NULL),
(1172, 'Chennai', 'Tamil Nadu', '1', NULL, NULL),
(1173, 'Chinna salem', 'Tamil nadu', '1', NULL, NULL),
(1174, 'Coimbatore', 'Tamil Nadu', '1', NULL, NULL),
(1175, 'Coonoor', 'Tamil Nadu', '1', NULL, NULL),
(1176, 'Cuddalore', 'Tamil Nadu', '1', NULL, NULL),
(1177, 'Dharmapuri', 'Tamil Nadu', '1', NULL, NULL),
(1178, 'Dindigul', 'Tamil Nadu', '1', NULL, NULL),
(1179, 'Erode', 'Tamil Nadu', '1', NULL, NULL),
(1180, 'Gudalur', 'Tamil Nadu', '1', NULL, NULL),
(1181, 'Gudalur', 'Tamil Nadu', '1', NULL, NULL),
(1182, 'Gudalur', 'Tamil Nadu', '1', NULL, NULL),
(1183, 'Kanchipuram', 'Tamil Nadu', '1', NULL, NULL),
(1184, 'Karaikudi', 'Tamil Nadu', '1', NULL, NULL),
(1185, 'Karungal', 'Tamil Nadu', '1', NULL, NULL),
(1186, 'Karur', 'Tamil Nadu', '1', NULL, NULL),
(1187, 'Kollankodu', 'Tamil Nadu', '1', NULL, NULL),
(1188, 'Lalgudi', 'Tamil Nadu', '1', NULL, NULL),
(1189, 'Madurai', 'Tamil Nadu', '1', NULL, NULL),
(1190, 'Nagapattinam', 'Tamil Nadu', '1', NULL, NULL),
(1191, 'Nagercoil', 'Tamil Nadu', '1', NULL, NULL),
(1192, 'Namagiripettai', 'Tamil Nadu', '1', NULL, NULL),
(1193, 'Namakkal', 'Tamil Nadu', '1', NULL, NULL),
(1194, 'Nandivaram-Guduvancheri', 'Tamil Nadu', '1', NULL, NULL),
(1195, 'Nanjikottai', 'Tamil Nadu', '1', NULL, NULL),
(1196, 'Natham', 'Tamil Nadu', '1', NULL, NULL),
(1197, 'Nellikuppam', 'Tamil Nadu', '1', NULL, NULL),
(1198, 'Neyveli', 'Tamil Nadu', '1', NULL, NULL),
(1199, 'O\' Valley', 'Tamil Nadu', '1', NULL, NULL),
(1200, 'Oddanchatram', 'Tamil Nadu', '1', NULL, NULL),
(1201, 'P.N.Patti', 'Tamil Nadu', '1', NULL, NULL),
(1202, 'Pacode', 'Tamil Nadu', '1', NULL, NULL),
(1203, 'Padmanabhapuram', 'Tamil Nadu', '1', NULL, NULL),
(1204, 'Palani', 'Tamil Nadu', '1', NULL, NULL),
(1205, 'Palladam', 'Tamil Nadu', '1', NULL, NULL),
(1206, 'Pallapatti', 'Tamil Nadu', '1', NULL, NULL),
(1207, 'Pallikonda', 'Tamil Nadu', '1', NULL, NULL),
(1208, 'Panagudi', 'Tamil Nadu', '1', NULL, NULL),
(1209, 'Panruti', 'Tamil Nadu', '1', NULL, NULL),
(1210, 'Paramakudi', 'Tamil Nadu', '1', NULL, NULL),
(1211, 'Parangipettai', 'Tamil Nadu', '1', NULL, NULL),
(1212, 'Pattukkottai', 'Tamil Nadu', '1', NULL, NULL),
(1213, 'Perambalur', 'Tamil Nadu', '1', NULL, NULL),
(1214, 'Peravurani', 'Tamil Nadu', '1', NULL, NULL),
(1215, 'Periyakulam', 'Tamil Nadu', '1', NULL, NULL),
(1216, 'Periyasemur', 'Tamil Nadu', '1', NULL, NULL),
(1217, 'Pernampattu', 'Tamil Nadu', '1', NULL, NULL),
(1218, 'Pollachi', 'Tamil Nadu', '1', NULL, NULL),
(1219, 'Polur', 'Tamil Nadu', '1', NULL, NULL),
(1220, 'Ponneri', 'Tamil Nadu', '1', NULL, NULL),
(1221, 'Pudukkottai', 'Tamil Nadu', '1', NULL, NULL),
(1222, 'Pudupattinam', 'Tamil Nadu', '1', NULL, NULL),
(1223, 'Puliyankudi', 'Tamil Nadu', '1', NULL, NULL),
(1224, 'Punjaipugalur', 'Tamil Nadu', '1', NULL, NULL),
(1225, 'Rajapalayam', 'Tamil Nadu', '1', NULL, NULL),
(1226, 'Ramanathapuram', 'Tamil Nadu', '1', NULL, NULL),
(1227, 'Rameshwaram', 'Tamil Nadu', '1', NULL, NULL),
(1228, 'Rasipuram', 'Tamil Nadu', '1', NULL, NULL),
(1229, 'Salem', 'Tamil Nadu', '1', NULL, NULL),
(1230, 'Sankarankoil', 'Tamil Nadu', '1', NULL, NULL),
(1231, 'Sankari', 'Tamil Nadu', '1', NULL, NULL),
(1232, 'Sathyamangalam', 'Tamil Nadu', '1', NULL, NULL),
(1233, 'Sattur', 'Tamil Nadu', '1', NULL, NULL),
(1234, 'Shenkottai', 'Tamil Nadu', '1', NULL, NULL),
(1235, 'Sholavandan', 'Tamil Nadu', '1', NULL, NULL),
(1236, 'Sholingur', 'Tamil Nadu', '1', NULL, NULL),
(1237, 'Sirkali', 'Tamil Nadu', '1', NULL, NULL),
(1238, 'Sivaganga', 'Tamil Nadu', '1', NULL, NULL),
(1239, 'Sivagiri', 'Tamil Nadu', '1', NULL, NULL),
(1240, 'Sivakasi', 'Tamil Nadu', '1', NULL, NULL),
(1241, 'Srivilliputhur', 'Tamil Nadu', '1', NULL, NULL),
(1242, 'Surandai', 'Tamil Nadu', '1', NULL, NULL),
(1243, 'Suriyampalayam', 'Tamil Nadu', '1', NULL, NULL),
(1244, 'Tenkasi', 'Tamil Nadu', '1', NULL, NULL),
(1245, 'Thammampatti', 'Tamil Nadu', '1', NULL, NULL),
(1246, 'Thanjavur', 'Tamil Nadu', '1', NULL, NULL),
(1247, 'Tharamangalam', 'Tamil Nadu', '1', NULL, NULL),
(1248, 'Tharangambadi', 'Tamil Nadu', '1', NULL, NULL),
(1249, 'Theni Allinagaram', 'Tamil Nadu', '1', NULL, NULL),
(1250, 'Thirumangalam', 'Tamil Nadu', '1', NULL, NULL),
(1251, 'Thirunindravur', 'Tamil Nadu', '1', NULL, NULL),
(1252, 'Thiruparappu', 'Tamil Nadu', '1', NULL, NULL),
(1253, 'Thirupuvanam', 'Tamil Nadu', '1', NULL, NULL),
(1254, 'Thiruthuraipoondi', 'Tamil Nadu', '1', NULL, NULL),
(1255, 'Thiruvallur', 'Tamil Nadu', '1', NULL, NULL),
(1256, 'Thiruvarur', 'Tamil Nadu', '1', NULL, NULL),
(1257, 'Thoothukudi', 'Tamil Nadu', '1', NULL, NULL),
(1258, 'Thuraiyur', 'Tamil Nadu', '1', NULL, NULL),
(1259, 'Tindivanam', 'Tamil Nadu', '1', NULL, NULL),
(1260, 'Tiruchendur', 'Tamil Nadu', '1', NULL, NULL),
(1261, 'Tiruchengode', 'Tamil Nadu', '1', NULL, NULL),
(1262, 'Tiruchirappalli', 'Tamil Nadu', '1', NULL, NULL),
(1263, 'Tirukalukundram', 'Tamil Nadu', '1', NULL, NULL),
(1264, 'Tirukkoyilur', 'Tamil Nadu', '1', NULL, NULL),
(1265, 'Tirunelveli', 'Tamil Nadu', '1', NULL, NULL),
(1266, 'Tirupathur', 'Tamil Nadu', '1', NULL, NULL),
(1267, 'Tirupathur', 'Tamil Nadu', '1', NULL, NULL),
(1268, 'Tiruppur', 'Tamil Nadu', '1', NULL, NULL),
(1269, 'Tiruttani', 'Tamil Nadu', '1', NULL, NULL),
(1270, 'Tiruvannamalai', 'Tamil Nadu', '1', NULL, NULL),
(1271, 'Tiruvethipuram', 'Tamil Nadu', '1', NULL, NULL),
(1272, 'Tittakudi', 'Tamil Nadu', '1', NULL, NULL),
(1273, 'Udhagamandalam', 'Tamil Nadu', '1', NULL, NULL),
(1274, 'Udumalaipettai', 'Tamil Nadu', '1', NULL, NULL),
(1275, 'Unnamalaikadai', 'Tamil Nadu', '1', NULL, NULL),
(1276, 'Usilampatti', 'Tamil Nadu', '1', NULL, NULL),
(1277, 'Uthamapalayam', 'Tamil Nadu', '1', NULL, NULL),
(1278, 'Uthiramerur', 'Tamil Nadu', '1', NULL, NULL),
(1279, 'Vadakkuvalliyur', 'Tamil Nadu', '1', NULL, NULL),
(1280, 'Vadalur', 'Tamil Nadu', '1', NULL, NULL),
(1281, 'Vadipatti', 'Tamil Nadu', '1', NULL, NULL),
(1282, 'Valparai', 'Tamil Nadu', '1', NULL, NULL),
(1283, 'Vandavasi', 'Tamil Nadu', '1', NULL, NULL),
(1284, 'Vaniyambadi', 'Tamil Nadu', '1', NULL, NULL),
(1285, 'Vedaranyam', 'Tamil Nadu', '1', NULL, NULL),
(1286, 'Vellakoil', 'Tamil Nadu', '1', NULL, NULL),
(1287, 'Vellore', 'Tamil Nadu', '1', NULL, NULL),
(1288, 'Vikramasingapuram', 'Tamil Nadu', '1', NULL, NULL),
(1289, 'Viluppuram', 'Tamil Nadu', '1', NULL, NULL),
(1290, 'Virudhachalam', 'Tamil Nadu', '1', NULL, NULL),
(1291, 'Virudhunagar', 'Tamil Nadu', '1', NULL, NULL),
(1292, 'Viswanatham', 'Tamil Nadu', '1', NULL, NULL),
(1293, 'Agartala', 'Tripura', '1', NULL, NULL),
(1294, 'Badharghat', 'Tripura', '1', NULL, NULL),
(1295, 'Dharmanagar', 'Tripura', '1', NULL, NULL),
(1296, 'Indranagar', 'Tripura', '1', NULL, NULL),
(1297, 'Jogendranagar', 'Tripura', '1', NULL, NULL),
(1298, 'Kailasahar', 'Tripura', '1', NULL, NULL),
(1299, 'Khowai', 'Tripura', '1', NULL, NULL),
(1300, 'Pratapgarh', 'Tripura', '1', NULL, NULL),
(1301, 'Udaipur', 'Tripura', '1', NULL, NULL),
(1302, 'Achhnera', 'Uttar Pradesh', '1', NULL, NULL),
(1303, 'Adari', 'Uttar Pradesh', '1', NULL, NULL),
(1304, 'Agra', 'Uttar Pradesh', '1', NULL, NULL),
(1305, 'Aligarh', 'Uttar Pradesh', '1', NULL, NULL),
(1306, 'Allahabad', 'Uttar Pradesh', '1', NULL, NULL),
(1307, 'Amroha', 'Uttar Pradesh', '1', NULL, NULL),
(1308, 'Azamgarh', 'Uttar Pradesh', '1', NULL, NULL),
(1309, 'Bahraich', 'Uttar Pradesh', '1', NULL, NULL),
(1310, 'Ballia', 'Uttar Pradesh', '1', NULL, NULL),
(1311, 'Balrampur', 'Uttar Pradesh', '1', NULL, NULL),
(1312, 'Banda', 'Uttar Pradesh', '1', NULL, NULL),
(1313, 'Bareilly', 'Uttar Pradesh', '1', NULL, NULL),
(1314, 'Chandausi', 'Uttar Pradesh', '1', NULL, NULL),
(1315, 'Dadri', 'Uttar Pradesh', '1', NULL, NULL),
(1316, 'Deoria', 'Uttar Pradesh', '1', NULL, NULL),
(1317, 'Etawah', 'Uttar Pradesh', '1', NULL, NULL),
(1318, 'Fatehabad', 'Uttar Pradesh', '1', NULL, NULL),
(1319, 'Fatehpur', 'Uttar Pradesh', '1', NULL, NULL),
(1320, 'Fatehpur', 'Uttar Pradesh', '1', NULL, NULL),
(1321, 'Greater Noida', 'Uttar Pradesh', '1', NULL, NULL),
(1322, 'Hamirpur', 'Uttar Pradesh', '1', NULL, NULL),
(1323, 'Hardoi', 'Uttar Pradesh', '1', NULL, NULL),
(1324, 'Jajmau', 'Uttar Pradesh', '1', NULL, NULL),
(1325, 'Jaunpur', 'Uttar Pradesh', '1', NULL, NULL),
(1326, 'Jhansi', 'Uttar Pradesh', '1', NULL, NULL),
(1327, 'Kalpi', 'Uttar Pradesh', '1', NULL, NULL),
(1328, 'Kanpur', 'Uttar Pradesh', '1', NULL, NULL),
(1329, 'Kota', 'Uttar Pradesh', '1', NULL, NULL),
(1330, 'Laharpur', 'Uttar Pradesh', '1', NULL, NULL),
(1331, 'Lakhimpur', 'Uttar Pradesh', '1', NULL, NULL),
(1332, 'Lal Gopalganj Nindaura', 'Uttar Pradesh', '1', NULL, NULL),
(1333, 'Lalganj', 'Uttar Pradesh', '1', NULL, NULL),
(1334, 'Lalitpur', 'Uttar Pradesh', '1', NULL, NULL),
(1335, 'Lar', 'Uttar Pradesh', '1', NULL, NULL),
(1336, 'Loni', 'Uttar Pradesh', '1', NULL, NULL),
(1337, 'Lucknow', 'Uttar Pradesh', '1', NULL, NULL),
(1338, 'Mathura', 'Uttar Pradesh', '1', NULL, NULL),
(1339, 'Meerut', 'Uttar Pradesh', '1', NULL, NULL),
(1340, 'Modinagar', 'Uttar Pradesh', '1', NULL, NULL),
(1341, 'Muradnagar', 'Uttar Pradesh', '1', NULL, NULL),
(1342, 'Nagina', 'Uttar Pradesh', '1', NULL, NULL),
(1343, 'Najibabad', 'Uttar Pradesh', '1', NULL, NULL),
(1344, 'Nakur', 'Uttar Pradesh', '1', NULL, NULL),
(1345, 'Nanpara', 'Uttar Pradesh', '1', NULL, NULL),
(1346, 'Naraura', 'Uttar Pradesh', '1', NULL, NULL),
(1347, 'Naugawan Sadat', 'Uttar Pradesh', '1', NULL, NULL),
(1348, 'Nautanwa', 'Uttar Pradesh', '1', NULL, NULL),
(1349, 'Nawabganj', 'Uttar Pradesh', '1', NULL, NULL),
(1350, 'Nehtaur', 'Uttar Pradesh', '1', NULL, NULL),
(1351, 'NOIDA', 'Uttar Pradesh', '1', NULL, NULL),
(1352, 'Noorpur', 'Uttar Pradesh', '1', NULL, NULL),
(1353, 'Obra', 'Uttar Pradesh', '1', NULL, NULL),
(1354, 'Orai', 'Uttar Pradesh', '1', NULL, NULL),
(1355, 'Padrauna', 'Uttar Pradesh', '1', NULL, NULL),
(1356, 'Palia Kalan', 'Uttar Pradesh', '1', NULL, NULL),
(1357, 'Parasi', 'Uttar Pradesh', '1', NULL, NULL),
(1358, 'Phulpur', 'Uttar Pradesh', '1', NULL, NULL),
(1359, 'Pihani', 'Uttar Pradesh', '1', NULL, NULL),
(1360, 'Pilibhit', 'Uttar Pradesh', '1', NULL, NULL),
(1361, 'Pilkhuwa', 'Uttar Pradesh', '1', NULL, NULL),
(1362, 'Powayan', 'Uttar Pradesh', '1', NULL, NULL),
(1363, 'Pukhrayan', 'Uttar Pradesh', '1', NULL, NULL),
(1364, 'Puranpur', 'Uttar Pradesh', '1', NULL, NULL),
(1365, 'Purquazi', 'Uttar Pradesh', '1', NULL, NULL),
(1366, 'Purwa', 'Uttar Pradesh', '1', NULL, NULL),
(1367, 'Rae Bareli', 'Uttar Pradesh', '1', NULL, NULL),
(1368, 'Rampur', 'Uttar Pradesh', '1', NULL, NULL),
(1369, 'Rampur Maniharan', 'Uttar Pradesh', '1', NULL, NULL),
(1370, 'Rasra', 'Uttar Pradesh', '1', NULL, NULL),
(1371, 'Rath', 'Uttar Pradesh', '1', NULL, NULL),
(1372, 'Renukoot', 'Uttar Pradesh', '1', NULL, NULL),
(1373, 'Reoti', 'Uttar Pradesh', '1', NULL, NULL),
(1374, 'Robertsganj', 'Uttar Pradesh', '1', NULL, NULL),
(1375, 'Rudauli', 'Uttar Pradesh', '1', NULL, NULL),
(1376, 'Rudrapur', 'Uttar Pradesh', '1', NULL, NULL),
(1377, 'Sadabad', 'Uttar Pradesh', '1', NULL, NULL),
(1378, 'Safipur', 'Uttar Pradesh', '1', NULL, NULL),
(1379, 'Saharanpur', 'Uttar Pradesh', '1', NULL, NULL),
(1380, 'Sahaspur', 'Uttar Pradesh', '1', NULL, NULL),
(1381, 'Sahaswan', 'Uttar Pradesh', '1', NULL, NULL),
(1382, 'Sahawar', 'Uttar Pradesh', '1', NULL, NULL),
(1383, 'Sahjanwa', 'Uttar Pradesh', '1', NULL, NULL),
(1384, 'Saidpur', ' Ghazipur', '1', NULL, NULL),
(1385, 'Sambhal', 'Uttar Pradesh', '1', NULL, NULL),
(1386, 'Samdhan', 'Uttar Pradesh', '1', NULL, NULL),
(1387, 'Samthar', 'Uttar Pradesh', '1', NULL, NULL),
(1388, 'Sandi', 'Uttar Pradesh', '1', NULL, NULL),
(1389, 'Sandila', 'Uttar Pradesh', '1', NULL, NULL),
(1390, 'Sardhana', 'Uttar Pradesh', '1', NULL, NULL),
(1391, 'Seohara', 'Uttar Pradesh', '1', NULL, NULL),
(1392, 'Shahabad', ' Hardoi', '1', NULL, NULL),
(1393, 'Shahabad', ' Rampur', '1', NULL, NULL),
(1394, 'Shahganj', 'Uttar Pradesh', '1', NULL, NULL),
(1395, 'Shahjahanpur', 'Uttar Pradesh', '1', NULL, NULL),
(1396, 'Shamli', 'Uttar Pradesh', '1', NULL, NULL),
(1397, 'Shamsabad', ' Agra', '1', NULL, NULL),
(1398, 'Shamsabad', ' Farrukhabad', '1', NULL, NULL),
(1399, 'Sherkot', 'Uttar Pradesh', '1', NULL, NULL),
(1400, 'Shikarpur', ' Bulandshahr', '1', NULL, NULL),
(1401, 'Shikohabad', 'Uttar Pradesh', '1', NULL, NULL),
(1402, 'Shishgarh', 'Uttar Pradesh', '1', NULL, NULL),
(1403, 'Siana', 'Uttar Pradesh', '1', NULL, NULL),
(1404, 'Sikanderpur', 'Uttar Pradesh', '1', NULL, NULL),
(1405, 'Sikandra Rao', 'Uttar Pradesh', '1', NULL, NULL),
(1406, 'Sikandrabad', 'Uttar Pradesh', '1', NULL, NULL),
(1407, 'Sirsaganj', 'Uttar Pradesh', '1', NULL, NULL),
(1408, 'Sirsi', 'Uttar Pradesh', '1', NULL, NULL),
(1409, 'Sitapur', 'Uttar Pradesh', '1', NULL, NULL),
(1410, 'Soron', 'Uttar Pradesh', '1', NULL, NULL),
(1411, 'Suar', 'Uttar Pradesh', '1', NULL, NULL),
(1412, 'Sultanpur', 'Uttar Pradesh', '1', NULL, NULL),
(1413, 'Sumerpur', 'Uttar Pradesh', '1', NULL, NULL),
(1414, 'Tanda', 'Uttar Pradesh', '1', NULL, NULL),
(1415, 'Tanda', 'Uttar Pradesh', '1', NULL, NULL),
(1416, 'Tetri Bazar', 'Uttar Pradesh', '1', NULL, NULL),
(1417, 'Thakurdwara', 'Uttar Pradesh', '1', NULL, NULL),
(1418, 'Thana Bhawan', 'Uttar Pradesh', '1', NULL, NULL),
(1419, 'Tilhar', 'Uttar Pradesh', '1', NULL, NULL),
(1420, 'Tirwaganj', 'Uttar Pradesh', '1', NULL, NULL),
(1421, 'Tulsipur', 'Uttar Pradesh', '1', NULL, NULL),
(1422, 'Tundla', 'Uttar Pradesh', '1', NULL, NULL),
(1423, 'Unnao', 'Uttar Pradesh', '1', NULL, NULL),
(1424, 'Utraula', 'Uttar Pradesh', '1', NULL, NULL),
(1425, 'Varanasi', 'Uttar Pradesh', '1', NULL, NULL),
(1426, 'Vrindavan', 'Uttar Pradesh', '1', NULL, NULL),
(1427, 'Warhapur', 'Uttar Pradesh', '1', NULL, NULL),
(1428, 'Zaidpur', 'Uttar Pradesh', '1', NULL, NULL),
(1429, 'Zamania', 'Uttar Pradesh', '1', NULL, NULL),
(1430, 'Almora', 'Uttarakhand', '1', NULL, NULL),
(1431, 'Bazpur', 'Uttarakhand', '1', NULL, NULL),
(1432, 'Chamba', 'Uttarakhand', '1', NULL, NULL),
(1433, 'Dehradun', 'Uttarakhand', '1', NULL, NULL),
(1434, 'Haldwani', 'Uttarakhand', '1', NULL, NULL),
(1435, 'Haridwar', 'Uttarakhand', '1', NULL, NULL),
(1436, 'Jaspur', 'Uttarakhand', '1', NULL, NULL),
(1437, 'Kashipur', 'Uttarakhand', '1', NULL, NULL),
(1438, 'kichha', 'Uttarakhand', '1', NULL, NULL),
(1439, 'Kotdwara', 'Uttarakhand', '1', NULL, NULL),
(1440, 'Manglaur', 'Uttarakhand', '1', NULL, NULL),
(1441, 'Mussoorie', 'Uttarakhand', '1', NULL, NULL),
(1442, 'Nagla', 'Uttarakhand', '1', NULL, NULL),
(1443, 'Nainital', 'Uttarakhand', '1', NULL, NULL),
(1444, 'Pauri', 'Uttarakhand', '1', NULL, NULL),
(1445, 'Pithoragarh', 'Uttarakhand', '1', NULL, NULL),
(1446, 'Ramnagar', 'Uttarakhand', '1', NULL, NULL),
(1447, 'Rishikesh', 'Uttarakhand', '1', NULL, NULL),
(1448, 'Roorkee', 'Uttarakhand', '1', NULL, NULL),
(1449, 'Rudrapur', 'Uttarakhand', '1', NULL, NULL),
(1450, 'Sitarganj', 'Uttarakhand', '1', NULL, NULL),
(1451, 'Tehri', 'Uttarakhand', '1', NULL, NULL),
(1452, 'Muzaffarnagar', 'Uttar Pradesh', '1', NULL, NULL),
(1453, 'Adra', ' Purulia', '1', NULL, NULL),
(1454, 'Alipurduar', 'West Bengal', '1', NULL, NULL),
(1455, 'Arambagh', 'West Bengal', '1', NULL, NULL),
(1456, 'Asansol', 'West Bengal', '1', NULL, NULL),
(1457, 'Baharampur', 'West Bengal', '1', NULL, NULL),
(1458, 'Bally', 'West Bengal', '1', NULL, NULL),
(1459, 'Balurghat', 'West Bengal', '1', NULL, NULL),
(1460, 'Bankura', 'West Bengal', '1', NULL, NULL),
(1461, 'Barakar', 'West Bengal', '1', NULL, NULL),
(1462, 'Barasat', 'West Bengal', '1', NULL, NULL),
(1463, 'Bardhaman', 'West Bengal', '1', NULL, NULL),
(1464, 'Bidhan Nagar', 'West Bengal', '1', NULL, NULL),
(1465, 'Chinsura', 'West Bengal', '1', NULL, NULL),
(1466, 'Contai', 'West Bengal', '1', NULL, NULL),
(1467, 'Cooch Behar', 'West Bengal', '1', NULL, NULL),
(1468, 'Darjeeling', 'West Bengal', '1', NULL, NULL),
(1469, 'Durgapur', 'West Bengal', '1', NULL, NULL),
(1470, 'Haldia', 'West Bengal', '1', NULL, NULL),
(1471, 'Howrah', 'West Bengal', '1', NULL, NULL),
(1472, 'Islampur', 'West Bengal', '1', NULL, NULL),
(1473, 'Jhargram', 'West Bengal', '1', NULL, NULL),
(1474, 'Kharagpur', 'West Bengal', '1', NULL, NULL),
(1475, 'Kolkata', 'West Bengal', '1', NULL, NULL),
(1476, 'Mainaguri', 'West Bengal', '1', NULL, NULL),
(1477, 'Mal', 'West Bengal', '1', NULL, NULL),
(1478, 'Mathabhanga', 'West Bengal', '1', NULL, NULL),
(1479, 'Medinipur', 'West Bengal', '1', NULL, NULL),
(1480, 'Memari', 'West Bengal', '1', NULL, NULL),
(1481, 'Monoharpur', 'West Bengal', '1', NULL, NULL),
(1482, 'Murshidabad', 'West Bengal', '1', NULL, NULL),
(1483, 'Nabadwip', 'West Bengal', '1', NULL, NULL),
(1484, 'Naihati', 'West Bengal', '1', NULL, NULL),
(1485, 'Panchla', 'West Bengal', '1', NULL, NULL),
(1486, 'Pandua', 'West Bengal', '1', NULL, NULL),
(1487, 'Paschim Punropara', 'West Bengal', '1', NULL, NULL),
(1488, 'Purulia', 'West Bengal', '1', NULL, NULL),
(1489, 'Raghunathpur', 'West Bengal', '1', NULL, NULL),
(1490, 'Raiganj', 'West Bengal', '1', NULL, NULL),
(1491, 'Rampurhat', 'West Bengal', '1', NULL, NULL),
(1492, 'Ranaghat', 'West Bengal', '1', NULL, NULL),
(1493, 'Sainthia', 'West Bengal', '1', NULL, NULL),
(1494, 'Santipur', 'West Bengal', '1', NULL, NULL),
(1495, 'Siliguri', 'West Bengal', '1', NULL, NULL),
(1496, 'Sonamukhi', 'West Bengal', '1', NULL, NULL),
(1497, 'Srirampore', 'West Bengal', '1', NULL, NULL),
(1498, 'Suri', 'West Bengal', '1', NULL, NULL),
(1499, 'Taki', 'West Bengal', '1', NULL, NULL),
(1500, 'Tamluk', 'West Bengal', '1', NULL, NULL),
(1501, 'Tarakeswar', 'West Bengal', '1', NULL, NULL),
(1502, 'Chikmagalur', 'Karnataka', '1', NULL, NULL),
(1503, 'Davanagere', 'Karnataka', '1', NULL, NULL),
(1504, 'Dharwad', 'Karnataka', '1', NULL, NULL),
(1505, 'Gadag', 'Karnataka', '1', NULL, NULL),
(1506, 'Chennai', 'Tamil Nadu', '1', NULL, NULL),
(1507, 'Coimbatore', 'Tamil Nadu', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location_servers`
--

CREATE TABLE `location_servers` (
  `id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `server_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prev_server_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_credentials` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_servers`
--

INSERT INTO `location_servers` (`id`, `location_id`, `server_ip`, `prev_server_ip`, `login_credentials`, `status`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, '127.67.9.8', '', 'eyJpdiI6Im9LYm83R2ExY1FsWFJKa0pUaUdhSkE9PSIsInZhbHVlIjoia3g5UFNlbENnakg0eGsyaml2eUNjQ1ZFZ0pxS1ZVZ2djWHlBXC9qU3FsbDYzUWtsTE1Lc2hoSEpCcHk2RVI4QllKUVl0Z2E4VDNhbEJ2MGI1eElpNUMzNHFPXC9iQ2dhdFFuNVlBd2dlNjFPODNYUW1BQUJmU0VZTUZ0bFJ1VCtwU3J4VjRjazZ3b0Q5bXhydXF3VDRnVEE9PSIsIm1hYyI6ImRiMTgwZGJlOWQzYjM1ZmFhMDQ5ZjI1MzYxODBhYzMxODcyMGEyNmE4ZjlkMDdkMDI3M2ZmYTM2Nzc5YWMwYzMifQ==', 1, 'Port Blair', '2019-04-26 05:38:00', '2019-05-14 00:15:57'),
(2, 2, '127.34.98.4', '', 'eyJpdiI6InN2cmdhRTlUbHN0WEZaYUxxbUl6TEE9PSIsInZhbHVlIjoiQWVOZmhcL3N1U012eEo3UWRaR29PQ2hueVB0c25vUkRHSklaYm5jMzJHMSttRVZqbWRtV3l3UXdYdlpRUDBFQ0JqR3U5UW5IYm5sa0tqNFY4YkprN1hlMUM1ZW5ONzVaMXdiR0RuXC9ZUllDS3R6dFBKWEFnZDVmZ2NhTlpLdnQ4a2NhVWZ0Q3VQXC9BVnFIZVBLU1VmZW9RPT0iLCJtYWMiOiIxNTkwNGJmMTFjMzcyMTNlMGYyZTQzY2Y0ZjUzZmFmMDJlYTY5ZjE4NTA4OGQ4ZWM2ZGI0NDE3ZGIyMDU5ZTE1In0=', 1, NULL, '2019-04-26 05:38:00', '2019-04-26 05:38:18'),
(4, 1, '127.89.56.7', '', 'eyJpdiI6Ikp0ZDN2UW9JNlZkVFcrMko0TlV6c1E9PSIsInZhbHVlIjoiaW5QenV3dmtZZjd6ODRTYndkakU0bldWR3F6XC9xb3BrNFdpQTQ4aHFnS3ZVNDl4dHBQeVwveldUbGMza08xT1wvQjdSVFBmdFpUeEJnTW9ZTmNaTlJLc2pIVll0dnFzbVplV3k3cWJOY3JXNWYzNElyUkN6dHhDanpoVEN0NEVSNXcyMEFnU2xiUFJUb0lDVndDVWJoYm53PT0iLCJtYWMiOiI5MTg3NTQyMDVlNWE3OGM3YWM4YzdkOTdhOTQ4MmEzZGE4MDBjMDMzMmUxNmFhNTA0YzJmZDY4OTRmNzM2MTc0In0=', 1, NULL, '2019-04-26 05:39:20', '2019-04-26 05:39:20'),
(5, 1, '127.90.76.8', '', 'eyJpdiI6Ikp0ZDN2UW9JNlZkVFcrMko0TlV6c1E9PSIsInZhbHVlIjoiaW5QenV3dmtZZjd6ODRTYndkakU0bldWR3F6XC9xb3BrNFdpQTQ4aHFnS3ZVNDl4dHBQeVwveldUbGMza08xT1wvQjdSVFBmdFpUeEJnTW9ZTmNaTlJLc2pIVll0dnFzbVplV3k3cWJOY3JXNWYzNElyUkN6dHhDanpoVEN0NEVSNXcyMEFnU2xiUFJUb0lDVndDVWJoYm53PT0iLCJtYWMiOiI5MTg3NTQyMDVlNWE3OGM3YWM4YzdkOTdhOTQ4MmEzZGE4MDBjMDMzMmUxNmFhNTA0YzJmZDY4OTRmNzM2MTc0In0=', 1, NULL, '2019-04-26 05:39:20', '2019-04-26 05:39:20'),
(6, 817, '192.168.3.246', '', 'eyJpdiI6IjhHTlVkQUpTQ1wva0YzVjREeWt6dCtRPT0iLCJ2YWx1ZSI6InhxbW9iU2NXeU90djZxOHB0d1JFNHlmdXJCbHkwSEgwTll5WGNOSFk2RTZ2UWEzTmdaaCtSN2o5b2Z0UTZzTkl2bFlWcW4zSGlwWlNkZ1dcL0d4bE45ZkpEK2xOekpkQkdRZlZaSFFSTWk0WUVXbnRhbXZIcUpoNFwvZVVtaTRvNE1mTHFcL0JRV3ltRFluUEU1T2NsSlY0THRCNzV6dmw3djlUY3JNRnJyb0lSMD0iLCJtYWMiOiIwZjg1YThiYzE2Yzk1MTg0YWRjMzUwYTBhZTQ4ZTYwOWM1MjU0YjBlOTEzM2ZiMzJhZTk5YWYzNWE4ZjcwOGE3In0=', 1, NULL, '2019-05-24 00:20:41', '2019-05-24 00:20:41');

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
(3, '2019_04_17_053021_all_tables_creation', 1),
(4, '2019_04_25_114612_create_tables_of_central_application', 1),
(5, '2019_04_26_061625_create_users_table', 2),
(6, '2019_04_30_095001_create_campaign', 3),
(7, '2019_04_30_115058_renamegroupskills', 4),
(8, '2019_05_02_095000_edit_roles_table', 5),
(10, '2019_05_09_072854_add_column_in-central_users_table', 7),
(11, '2019_05_10_103609_system_roles', 7),
(13, '2019_05_14_105050_create_pages_table', 9),
(14, '2019_05_08_122054_create_assignroleprivilages_table', 10),
(15, '2019_05_15_085648_create_phonebooks_table', 11),
(16, '2019_05_20_083252_create_campaign_sql_queries_table', 12),
(17, '2019_05_22_054335_create_customers_table', 13),
(18, '2019_05_22_061634_rename_customer_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_page` int(3) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `parent_page`, `url`, `status`) VALUES
(1, 'Dashboard', 0, '/home', 'Active'),
(2, 'Clients', 0, '/allclients', 'Active'),
(3, 'Client Features', 0, '/features', 'Active'),
(4, 'All Features', 0, '/allfeatures', 'Active'),
(5, 'Location Server', 0, '/locationserver', 'Active'),
(6, 'Client Users', 0, '/users', 'Active'),
(7, 'Roles', 0, '/roles', 'Active'),
(8, 'Assign privileges to roles', 0, '/privileges', 'Active'),
(9, 'Campaign', 0, '#', 'Active'),
(10, 'SkillGroup', 9, '/skillgroup', 'Active'),
(11, 'Create Campaign', 9, '/campaign', 'Active'),
(12, 'Assign Campaign', 9, '/assigncampaign', 'Active'),
(13, 'Phonebook', 9, '/phonebook', 'Active'),
(14, 'Campaign Query', 9, '/campaignquery', 'Active');

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
-- Table structure for table `phonebooks`
--

CREATE TABLE `phonebooks` (
  `id` int(10) UNSIGNED NOT NULL,
  `phonebookname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `campaign` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `callerid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_data_excel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `currentstatus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legalstatus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dialer_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dialer_substatus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyval_id` int(11) NOT NULL DEFAULT '0',
  `peopledata` longtext COLLATE utf8mb4_unicode_ci,
  `modifylog` longtext COLLATE utf8mb4_unicode_ci,
  `dirty` longtext COLLATE utf8mb4_unicode_ci,
  `camp_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clientinternalid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clientcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dialer_callback` datetime DEFAULT NULL,
  `dialer_lastcall` datetime DEFAULT NULL,
  `crm_id` int(11) DEFAULT NULL,
  `LeadID` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `currentstatus`, `legalstatus`, `mobile`, `status`, `dialer_status`, `dialer_substatus`, `firstname`, `lastname`, `email`, `keyval_id`, `peopledata`, `modifylog`, `dirty`, `camp_name`, `clientinternalid`, `clientcode`, `dialer_callback`, `dialer_lastcall`, `crm_id`, `LeadID`, `created_at`, `updated_at`) VALUES
(1, 'ACTIVE', NULL, '9078964532', 'New', NULL, NULL, 'Jerry', NULL, 'jerry@gmail.com', 0, NULL, NULL, NULL, 'Dummy', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL),
(2, 'ACTIVE', NULL, '0967450975', 'New', NULL, NULL, 'Alexa', 'jeans', 'alexa@gmail.com', 0, NULL, NULL, NULL, 'Dummy', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `rolename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `module_permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rolegroup` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `client_id`, `rolename`, `status`, `module_permission`, `group_permission`, `rolegroup`, `default`, `group`, `created_at`, `updated_at`) VALUES
(2, 2, 'Super Admin', 'Active', '{"admin":["2"],"write":["2","31"],"read":["2","31"]}', '{"admin":[],"write":[],"read":[]}', 'Default', '0', 'Default', '2019-05-02 00:25:33', '2019-05-24 04:59:55'),
(3, 3, 'Manager', 'Active', '{"admin":["2"],"write":["2"],"read":["2"]}', '{"admin":"Default","write":"Default","read":"Default"}', 'Default', '0', 'Default', '2019-05-10 00:37:35', '2019-05-24 04:50:27'),
(4, 1, 'Manager', 'Active', '{"admin":["2"],"write":["1","2"],"read":["1","2"]}', '{"admin":"Default","write":"Default","read":"Default"}', 'Default', '0', 'Default', '2019-05-10 00:38:16', '2019-05-10 00:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `skillgroups`
--

CREATE TABLE `skillgroups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `users_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skillgroups`
--

INSERT INTO `skillgroups` (`id`, `group_name`, `status`, `users_id`, `created_at`, `updated_at`, `client_id`) VALUES
(4, 'English', 'Active', '1,2', '2019-05-03 02:28:41', '2019-05-03 02:28:41', 2),
(6, 'Marathi', 'Active', '4', '2019-05-03 01:11:09', '2019-05-03 01:11:09', 1),
(19, 'Telgu', 'Active', '4', '2019-05-13 00:40:41', '2019-05-13 00:40:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_features`
--

CREATE TABLE `sub_features` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_features_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_features`
--

INSERT INTO `sub_features` (`id`, `sub_features_name`, `features_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Audio Record', 1, 1, '2019-04-26 05:56:06', '2019-04-30 03:41:00'),
(2, 'Video Record', 1, 1, '2019-04-26 05:56:06', '2019-04-30 03:41:00'),
(3, 'Manual', 2, 1, '2019-04-26 05:57:27', '2019-04-26 05:57:27'),
(4, 'Predictive', 2, 1, '2019-04-26 05:57:27', '2019-04-26 05:57:27'),
(5, 'Progressive', 2, 1, '2019-04-26 05:57:27', '2019-04-26 05:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `system_roles`
--

CREATE TABLE `system_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `rolename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_roles`
--

INSERT INTO `system_roles` (`id`, `rolename`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Active', NULL, NULL),
(2, 'Manager', 'Active', NULL, NULL),
(3, 'Supervisor', 'Active', NULL, NULL),
(4, 'User', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `server_id` int(11) NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `organization` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Default',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Default',
  `data` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presence` int(11) DEFAULT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '-330',
  `invisible` int(11) NOT NULL DEFAULT '0',
  `usertype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diskuse` int(11) DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reports_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passwordreset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numbers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exten` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extencontext` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dialmode_assign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sel_campaign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_dialmode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `client_id`, `location_id`, `server_id`, `username`, `password`, `fullname`, `email`, `status`, `organization`, `group`, `data`, `presence`, `timezone`, `invisible`, `usertype`, `diskuse`, `source`, `meta`, `reports_to`, `supervisor`, `passwordreset`, `remember_token`, `numbers`, `exten`, `extencontext`, `dialmode_assign`, `sel_campaign`, `current_dialmode`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 4, 'ABHG567', '$2y$10$j76oOdhN5vFYTE.6Jyt9jen1B7D.RVfkBJRrJPeMaPUUhax5alLaW', 'Dummyadmin12', 'dummyadmin12@gmail.com', 'Active', 'Default', 'Default', NULL, 0, '-330', 0, 'User', 0, '', NULL, '8', '8', NULL, '', NULL, NULL, NULL, NULL, '3', NULL, NULL, '2019-05-14 07:00:28'),
(4, 1, 2, 2, 'HKYT689', '$2y$10$XILO6v/gapwU2zExRURz..X6fNct4mzHhQ0mR0DbnbS1.sw8nDjPO', 'Allen alexa', 'flexydialdummy@gmail.com', 'Active', 'Default', 'Default', NULL, 0, '-330', 0, NULL, 0, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-14 07:02:07'),
(8, 2, 1, 4, 'ADB890', 'e10adc3949ba59abbe56e057f20f883e', 'dummyuser', 'dummyuser@gmail.com', 'Active', 'Default', 'Default', NULL, NULL, '-330', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 2, 1, 4, 'TYU9075', '3b1c506a723fb04ce6cd2ce96c34b4e9', 'kratika jain', 'kratika@gmail.com', 'Active', 'Default', 'Default', NULL, NULL, '-330', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 2, 1, 4, '9087GHUOL', '7f61e5dc04a36293e8d220090e92e1fe', 'aishwariya', 'aishwariya@gmail.com', 'Active', 'Default', 'Default', NULL, NULL, '-330', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 2, 1, 4, 'OPUY787', '63771e3e7738ed3048c3dc440023db38', 'Jazz ', 'jazz@gmail.com', 'Active', 'Default', 'Default', NULL, NULL, '-330', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-13 04:45:06', '2019-05-13 04:45:06'),
(30, 2, 1, 4, 'AGH0923K', 'e67543591827fd8d8788d103c04add6d', 'jasmin', 'jasmin@gmail.com', 'Active', 'Default', 'Default', NULL, NULL, '-330', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-13 04:45:06', '2019-05-13 04:45:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_campaign_details`
--
ALTER TABLE `assign_campaign_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_campaign_details_client_id_foreign` (`client_id`);

--
-- Indexes for table `assign_role_privileges`
--
ALTER TABLE `assign_role_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`,`roles_id`,`pages_id`) USING BTREE;

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_client_id_foreign` (`client_id`);

--
-- Indexes for table `campaign_sql_queries`
--
ALTER TABLE `campaign_sql_queries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_sql_queries_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `central_users`
--
ALTER TABLE `central_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `central_users_email_unique` (`email`);

--
-- Indexes for table `clientfeatures_details`
--
ALTER TABLE `clientfeatures_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientfeatures_details_client_id_foreign` (`client_id`);

--
-- Indexes for table `clientlocation_details`
--
ALTER TABLE `clientlocation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientlocation_details_client_id_foreign` (`client_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_masters`
--
ALTER TABLE `location_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_servers`
--
ALTER TABLE `location_servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `phonebooks`
--
ALTER TABLE `phonebooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_client_id_foreign` (`client_id`);

--
-- Indexes for table `skillgroups`
--
ALTER TABLE `skillgroups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skillgroups_client_id_foreign` (`client_id`);

--
-- Indexes for table `sub_features`
--
ALTER TABLE `sub_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_features_features_id_foreign` (`features_id`);

--
-- Indexes for table `system_roles`
--
ALTER TABLE `system_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_client_id_foreign` (`client_id`),
  ADD KEY `users_location_id_foreign` (`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_campaign_details`
--
ALTER TABLE `assign_campaign_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `assign_role_privileges`
--
ALTER TABLE `assign_role_privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `campaign_sql_queries`
--
ALTER TABLE `campaign_sql_queries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `central_users`
--
ALTER TABLE `central_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clientfeatures_details`
--
ALTER TABLE `clientfeatures_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `clientlocation_details`
--
ALTER TABLE `clientlocation_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `location_masters`
--
ALTER TABLE `location_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1508;
--
-- AUTO_INCREMENT for table `location_servers`
--
ALTER TABLE `location_servers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `phonebooks`
--
ALTER TABLE `phonebooks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `skillgroups`
--
ALTER TABLE `skillgroups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `sub_features`
--
ALTER TABLE `sub_features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `system_roles`
--
ALTER TABLE `system_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_campaign_details`
--
ALTER TABLE `assign_campaign_details`
  ADD CONSTRAINT `assign_campaign_details_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `campaign_sql_queries`
--
ALTER TABLE `campaign_sql_queries`
  ADD CONSTRAINT `campaign_sql_queries_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`);

--
-- Constraints for table `clientfeatures_details`
--
ALTER TABLE `clientfeatures_details`
  ADD CONSTRAINT `clientfeatures_details_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `clientlocation_details`
--
ALTER TABLE `clientlocation_details`
  ADD CONSTRAINT `clientlocation_details_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `skillgroups`
--
ALTER TABLE `skillgroups`
  ADD CONSTRAINT `skillgroups_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `sub_features`
--
ALTER TABLE `sub_features`
  ADD CONSTRAINT `sub_features_features_id_foreign` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `users_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `location_masters` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
