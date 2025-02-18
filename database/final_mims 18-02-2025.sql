-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2025 at 04:05 AM
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
-- Database: `mims`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ccs`
--

CREATE TABLE `tbl_ccs` (
  `id` int(11) NOT NULL,
  `ccid` varchar(255) NOT NULL,
  `ccid_name` text NOT NULL,
  `project_code` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `badge_one` varchar(255) NOT NULL,
  `badge_two` varchar(255) NOT NULL,
  `supervisor_one` varchar(255) NOT NULL,
  `supervisor_two` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ccs`
--

INSERT INTO `tbl_ccs` (`id`, `ccid`, `ccid_name`, `project_code`, `project_name`, `badge_one`, `badge_two`, `supervisor_one`, `supervisor_two`) VALUES
(1, 'MASMO1', 'Assembly Ops', 'T00003', 'Mphil2 - CHIPLINE', 'A30107', 'A78362', 'Luisa Pelobello', 'Dianne Salvatierra'),
(2, 'MASMO1', 'Assembly Ops', 'T00008', 'Mphil2 - QFN', 'A30107', '', 'Luisa Pelobello', ''),
(3, 'MASMOA', 'Assembly Ops Die Attach', 'T00008', 'Mphil2 - QFN', 'A73088', 'A76820', 'Cinderella Ricacho', 'Elaine Sanico'),
(4, 'MASMOB', 'Assembly Ops Mark', 'T00008', 'Mphil2 - QFN', 'A73072', 'A77074', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(5, 'MASMOC', 'Assembly Ops Mold', 'T00008', 'Mphil2 - QFN', 'A73072', 'A77074', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(6, 'MASMOD', 'Assembly Ops Mount/Saw', 'T00009', 'Mphil2 - QFN', 'A30107', 'A78362', 'Luisa Pelobello', 'Dianne Salvatierra'),
(7, 'MASMOG', 'Assembly Ops SAW QFN', 'T00008', 'Mphil2 - QFN', 'A30107', 'A78362', 'Luisa Pelobello', 'Dianne Salvatierra'),
(8, 'MASMOK', 'Assembly Ops Wire Bond', 'T00008', 'Mphil2 - QFN', 'A73088', 'A76820', 'Cinderella Ricacho', 'Ellaine Sanico'),
(9, 'MASMOL', 'Assembly Ops Backgrind', 'T00008', 'Mphil2 - QFN', 'A30107', 'A78362', 'Luisa Pelobello', 'Dianne Salvatierra'),
(10, 'MASMPE', 'Assembly Process Eng', 'T00008', 'Mphil2 - QFN', 'B13145', '', 'Oliver Mabutas', ''),
(11, 'MASMOJ', 'Assembly Ops Trim & Form (MASMOJ)', 'T00008', 'Mphil2 - QFN', 'A73072', '177074', 'Arthur Abitria Jr.', 'Marinel Zagala');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `dts` varchar(50) NOT NULL,
  `part_desc` text NOT NULL,
  `part_name` varchar(50) NOT NULL,
  `part_qty` int(11) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `kitting_id` varchar(255) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `dts`, `part_desc`, `part_name`, `part_qty`, `exp_date`, `kitting_id`, `lot_id`, `updated_by`, `status`) VALUES
(25, '2025-02-07 17:56:33', 'Engine Oil Filter', 'PN-1024', 50, '2025-02-10', 'KIT-1001', '', 'Nikka', 'Received'),
(26, '2025-02-07 17:56:58', 'Spark Plug', 'PN-2048', 75, '2025-02-15', 'KIT-1002', '', 'Nikka', 'Received'),
(27, '2025-02-07 17:57:45', 'Air Filter', 'PN-3072', 85, '2025-03-01', 'KIT-1003', '', 'Nikka', 'Received'),
(28, '2025-02-07 17:58:03', 'Brake Pads', 'PN-4096', 90, '2025-02-27', 'KIT-1004', '', 'Nikka', 'Received'),
(29, '2025-02-07 17:58:20', 'Timing Belt', 'PN-5120', 50, '2025-02-22', 'KIT-1005', '', 'Nikka', 'Received'),
(30, '2025-02-07 17:58:42', 'Fuel Pump', 'PN-6144', 75, '2025-02-24', 'KIT-1006', '', 'Nikka', 'Received'),
(31, '2025-02-07 17:58:57', 'Transmission Fluid', 'PN-10240', 65, '2025-02-08', 'KIT-1008', '', 'Nikka', 'Received'),
(32, '2025-02-13 13:13:30', 'Spark Plug', 'PN-2048', 32, '2025-02-14', 'FDS34F', 'HFE673', 'Nikka', 'Received'),
(33, '2025-02-13 13:14:06', 'Transmission Fluid', 'PN-10240', 12, '2025-02-22', 'FDS34F', 'RF3F', 'Nikka', 'Received'),
(34, '2025-02-18 10:34:02', 'Engine Oil Filter', 'PN-1024', 12, '2025-03-01', 'FDS34F', 'LOT-3212', 'Nikka', 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id` int(11) NOT NULL,
  `part_name` varchar(50) NOT NULL,
  `part_desc` text NOT NULL,
  `cost_center` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `min_invent_req` text NOT NULL,
  `unit` varchar(255) NOT NULL,
  `part_option` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `kitting_id` varchar(255) NOT NULL,
  `part_qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `part_name`, `part_desc`, `cost_center`, `location`, `min_invent_req`, `unit`, `part_option`, `exp_date`, `kitting_id`, `part_qty`) VALUES
(37, 'PN-1024', 'Engine Oil Filter', 'MASMO1', 'Warehouse A', '50', 'pc', 'Direct', '', '', 1),
(38, 'PN-2048', 'Spark Plug', 'MASMOA', 'Warehouse B', '100', 'pc', 'Indirect', '', '', 0),
(39, 'PN-3072', 'Air Filter', 'MASMOB', 'Warehouse C', '30', 'pc', 'Direct', '', '', 0),
(40, 'PN-4096', 'Brake Pads', 'MASMOC', 'Warehouse A', '20', 'set', 'Indirect', '', '', 0),
(41, 'PN-5120', 'Timing Belt', 'MASMOD', 'Warehouse D', '15', 'pc', 'Direct', '', '', 0),
(42, 'PN-6144', 'Fuel Pump', 'MASMOG', 'Warehouse B', '10', 'pc', 'Direct', '', '', 0),
(47, 'PN-10240', 'Transmission Fluid', 'MASMOA', 'Warehouse B', '75', 'gal', 'Direct', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `dts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`id`, `username`, `action`, `description`, `dts`) VALUES
(3, 'Nikka', 'Account Creation', 'Nikka has created an account for Juan Carlos Dela Cruz', '2025-02-07 16:49:31'),
(4, 'Nikka', 'Account Creation', 'Nikka has created an account for Antonio Morales', '2025-02-07 16:50:12'),
(5, 'Nikka', 'Account Creation', 'Nikka has created an account for Eduardo Villanueva', '2025-02-07 16:50:35'),
(6, 'Nikka', 'Account Creation', 'Nikka has created an account for Marco Antonio Reyes', '2025-02-07 16:51:05'),
(7, 'Nikka', 'Account Creation', 'Nikka has created an account for Gabriel Santos', '2025-02-07 16:51:29'),
(8, 'Nikka', 'Account Creation', 'Nikka has created an account for Sofia Lopez', '2025-02-07 16:51:53'),
(9, 'Nikka', 'Account Creation', 'Nikka has created an account for Maria Teresa Alvarado', '2025-02-07 16:52:17'),
(10, 'Nikka', 'Account Creation', 'Nikka has created an account for Jessica Mendoza', '2025-02-07 16:52:41'),
(11, 'Nikka', 'Account Creation', 'Nikka has created an account for Bianca Rivera', '2025-02-07 16:53:10'),
(12, 'Nikka', 'Account Creation', 'Nikka has created an account for Isabel Perez', '2025-02-07 16:53:37'),
(13, 'Nikka', 'Account Creation', 'Nikka has created an account for Luis Santos', '2025-02-07 16:54:00'),
(14, 'Nikka', 'Account Edit', 'Nikka has made changes to the account of Luis Delos Santos', '2025-02-07 16:56:25'),
(15, 'Nikka', 'Account Edit', 'Nikka has made changes to the account of Juan Carlos Dela Cruz', '2025-02-07 16:57:09'),
(19, 'Nikka', 'Account Creation', 'Nikka has created an account for Ana Patricia Lopez', '2025-02-07 17:05:02'),
(20, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of Ana', '2025-02-07 17:05:25'),
(21, 'Nikka', 'Account Creation', 'Nikka has created an account for Miguel Reyes', '2025-02-07 17:06:44'),
(22, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of Miguel', '2025-02-07 17:06:54'),
(23, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-1024', '2025-02-07 17:15:52'),
(24, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-2048', '2025-02-07 17:16:56'),
(25, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-3072', '2025-02-07 17:17:29'),
(26, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-4096', '2025-02-07 17:17:59'),
(27, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-5120', '2025-02-07 17:18:38'),
(28, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-6144', '2025-02-07 17:19:07'),
(29, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-7168', '2025-02-07 17:19:30'),
(30, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material PN-2048', '2025-02-07 17:21:20'),
(31, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material PN-7168', '2025-02-07 17:21:50'),
(32, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material PN-7168', '2025-02-07 17:22:11'),
(33, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-10240', '2025-02-07 17:34:52'),
(34, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material PN-10240', '2025-02-07 17:35:02'),
(35, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-9216', '2025-02-07 17:35:42'),
(36, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-8192', '2025-02-07 17:36:15'),
(38, 'Nikka', 'Item Deletion', 'Nikka has deleted the part: PN-10240', '2025-02-07 17:50:33'),
(39, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-10240', '2025-02-07 17:53:16'),
(40, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-9216', '2025-02-07 17:53:41'),
(41, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-8192', '2025-02-07 17:54:08'),
(42, 'Nikka', 'Material Registration', 'Nikka has registered a new material PN-7168', '2025-02-07 17:54:35'),
(43, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material PN-7168', '2025-02-07 17:54:54'),
(44, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material PN-10240', '2025-02-07 17:55:09'),
(45, 'Nikka', 'Material Deletion', 'Nikka has deleted PN-7168', '2025-02-07 17:55:19'),
(46, 'Nikka', 'Material Deletion', 'Nikka has deleted PN-9216', '2025-02-07 17:55:31'),
(47, 'Nikka', 'Material Deletion', 'Nikka has deleted PN-8192', '2025-02-07 17:55:31'),
(48, 'Nikka', 'Account Creation', 'Nikka has created an account for Nikka User', '2025-02-12 19:30:51'),
(49, 'admin', 'Account Creation', 'admin has created an account for Harry Robles', '2025-02-12 20:34:08'),
(50, 'admin', 'Material Registration', 'admin has registered a new material Test', '2025-02-18 09:11:11'),
(51, 'admin', 'Material Registration', 'admin has registered a new material gsdgds', '2025-02-18 09:13:03'),
(52, 'admin', 'Material Deletion', 'admin has deleted gsdgds', '2025-02-18 09:13:54'),
(53, 'admin', 'Material Registration', 'admin has registered a new material test', '2025-02-18 09:14:19'),
(54, 'admin', 'Edit Material Details', 'admin has updated the details of material test', '2025-02-18 09:52:31'),
(55, 'admin', 'Material Registration', 'admin has registered a new material sfsafs', '2025-02-18 09:53:45'),
(56, 'admin', 'Material Registration', 'admin has registered a new material PN-7168dsvs', '2025-02-18 09:54:24'),
(57, 'admin', 'Material Registration', 'admin has registered a new material xcvcxv', '2025-02-18 09:55:05'),
(58, 'admin', 'Material Registration', 'admin has registered a new material dsgsds', '2025-02-18 10:00:24'),
(59, 'admin', 'Material Registration', 'admin has registered a new material fdb', '2025-02-18 10:00:44'),
(60, 'Nikka', 'Material Deletion', 'Nikka has deleted test', '2025-02-18 10:14:38'),
(61, 'Nikka', 'Material Deletion', 'Nikka has deleted sfsafs', '2025-02-18 10:14:38'),
(62, 'Nikka', 'Material Deletion', 'Nikka has deleted dsgsds', '2025-02-18 10:14:38'),
(63, 'Nikka', 'Material Deletion', 'Nikka has deleted fdb', '2025-02-18 10:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notif`
--

CREATE TABLE `tbl_notif` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `for_who` varchar(20) NOT NULL,
  `destination` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notif`
--

INSERT INTO `tbl_notif` (`id`, `username`, `message`, `is_read`, `created_at`, `for_who`, `destination`) VALUES
(145, 'System', 'PN-1024 has expired. Total expired quantity: 50', 1, '2025-02-12 08:01:56', 'admin', 'Expired'),
(146, 'System', 'PN-10240 has expired. Total expired quantity: 65', 1, '2025-02-12 08:01:56', 'admin', 'Expired'),
(147, 'System', 'PN-1024 has expired. Total expired quantity: 50', 1, '2025-02-13 00:36:38', 'admin', 'Expired'),
(148, 'System', 'PN-10240 has expired. Total expired quantity: 65', 1, '2025-02-13 00:36:38', 'admin', 'Expired'),
(149, 'admin', 'admin has requested 32 of PN-2048. Click here for more details.', 1, '2025-02-13 04:45:25', 'admin', 'Approval'),
(150, 'System', 'PN-2048 has reached the minimum inventory level and needs restocking.', 1, '2025-02-13 04:45:25', 'admin', 'Inventory'),
(151, 'admin', 'Nikka has approved 32 of PN-2048. Click here for more details.', 1, '2025-02-13 05:16:47', 'user', ''),
(152, 'Nikka', 'Nikka has requested 21 of PN-2048. Click here for more details.', 1, '2025-02-13 05:25:04', 'admin', 'Approval'),
(153, 'System', 'PN-2048 has reached the minimum inventory level and needs restocking.', 1, '2025-02-13 05:25:04', 'admin', 'Inventory'),
(154, 'Nikka', 'Nikka has approved 21 of PN-2048. Click here for more details.', 1, '2025-02-13 05:27:27', 'user', ''),
(155, 'System', 'PN-1024 has expired. Total expired quantity: 50', 1, '2025-02-18 00:46:06', 'admin', 'Expired'),
(156, 'System', 'PN-2048 has expired. Total expired quantity: 65', 1, '2025-02-18 00:46:06', 'admin', 'Expired'),
(157, 'System', 'PN-10240 has expired. Total expired quantity: 65', 1, '2025-02-18 00:46:06', 'admin', 'Expired'),
(158, 'Marco', 'Marco has requested 1 of PN-1024. Click here for more details.', 1, '2025-02-18 02:35:13', 'admin', 'Approval'),
(159, 'System', 'PN-1024 has reached the minimum inventory level and needs restocking.', 1, '2025-02-18 02:35:13', 'admin', 'Inventory'),
(160, 'Marco', 'Nikka has rejected 1 of PN-1024. Click here for more details.', 1, '2025-02-18 02:38:32', 'user', ''),
(161, 'Marco', 'Marco has requested 1 of PN-1024. Click here for more details.', 1, '2025-02-18 02:39:07', 'admin', 'Approval'),
(162, 'System', 'PN-1024 has reached the minimum inventory level and needs restocking.', 1, '2025-02-18 02:39:07', 'admin', 'Inventory'),
(163, 'Marco', 'Nikka has approved 1 of PN-1024. Click here for more details.', 1, '2025-02-18 03:04:08', 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requested`
--

CREATE TABLE `tbl_requested` (
  `id` int(11) NOT NULL,
  `dts` varchar(50) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `lot_id` varchar(50) NOT NULL,
  `part_desc` text NOT NULL,
  `station_code` varchar(255) NOT NULL,
  `part_option` varchar(50) NOT NULL,
  `part_qty` int(11) NOT NULL,
  `machine_no` varchar(50) NOT NULL,
  `with_reason` text NOT NULL,
  `req_by` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cost_center` varchar(255) NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `dts_approve` varchar(255) NOT NULL,
  `rejected_by` varchar(255) NOT NULL,
  `return_reason` text NOT NULL,
  `dts_return` varchar(255) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `dts_receive` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requested`
--

INSERT INTO `tbl_requested` (`id`, `dts`, `part_name`, `lot_id`, `part_desc`, `station_code`, `part_option`, `part_qty`, `machine_no`, `with_reason`, `req_by`, `status`, `cost_center`, `approved_by`, `dts_approve`, `rejected_by`, `return_reason`, `dts_return`, `return_qty`, `received_by`, `dts_receive`) VALUES
(87, '2025-02-13 12:45:25', 'PN-2048', 'test', 'Spark Plug', 'CDP 1', 'No option available', 32, 'Test', 'MC Setup', 'admin', 'approved', 'MASMOA', 'Nikka', '2025-02-13 13:16:47', '', '', '', 0, '', ''),
(88, '2025-02-13 13:25:04', 'PN-2048', '2F43', 'Spark Plug', 'DA', 'No option available', 21, '3423', 'MC Setup', 'Nikka', 'approved', 'MASMOB', 'Nikka', '2025-02-13 13:27:27', '', '', '', 0, '', ''),
(89, '2025-02-18 10:35:13', 'PN-1024', 'LOT-3212', 'Engine Oil Filter', 'CDP 1', 'Direct', 1, '3423', 'MC Setup', 'Marco', 'rejected', 'MASMOC', '', '', 'Nikka', '', '', 0, '', ''),
(90, '2025-02-18 10:39:07', 'PN-1024', 'sadfasd', 'Engine Oil Filter', 'CDP 1', 'Direct', 1, '3423', 'MC Setup', 'Marco', 'approved', 'MASMOC', 'Nikka', '2025-02-18 11:04:08', '', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `id` int(11) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `part_qty` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `kitting_id` varchar(255) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `dts` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`id`, `part_name`, `part_qty`, `exp_date`, `kitting_id`, `lot_id`, `dts`, `updated_by`, `status`) VALUES
(8, 'PN-1024', '50', '2025-02-10', 'KIT-1001', '', '2025-02-07 17:56:33', 'Nikka', 'Expired'),
(9, 'PN-2048', '43', '2025-02-15', 'KIT-1002', '', '2025-02-07 17:56:58', 'Nikka', 'Expired'),
(10, 'PN-3072', '85', '2025-03-01', 'KIT-1003', '', '2025-02-07 17:57:45', 'Nikka', 'Active'),
(11, 'PN-4096', '90', '2025-02-27', 'KIT-1004', '', '2025-02-07 17:58:03', 'Nikka', 'Active'),
(12, 'PN-5120', '50', '2025-02-22', 'KIT-1005', '', '2025-02-07 17:58:20', 'Nikka', 'Active'),
(13, 'PN-6144', '75', '2025-02-24', 'KIT-1006', '', '2025-02-07 17:58:42', 'Nikka', 'Active'),
(14, 'PN-10240', '65', '2025-02-08', 'KIT-1008', '', '2025-02-07 17:58:57', 'Nikka', 'Expired'),
(15, 'PN-2048', '11', '2025-02-14', 'FDS34F', 'HFE673', '2025-02-13 13:13:16', 'Nikka', 'Expired'),
(16, 'PN-2048', '11', '2025-02-14', 'FDS34F', 'HFE673', '2025-02-13 13:13:30', 'Nikka', 'Expired'),
(17, 'PN-10240', '12', '2025-02-22', 'FDS34F', 'RF3F', '2025-02-13 13:14:06', 'Nikka', 'Active'),
(18, 'PN-1024', '10', '2025-03-01', 'FDS34F', 'LOT-3212', '2025-02-18 10:34:02', 'Nikka', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` int(2) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `badge_number` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `cost_center` varchar(255) NOT NULL,
  `supervisor_one` varchar(255) NOT NULL,
  `supervisor_two` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `usertype`, `employee_name`, `badge_number`, `designation`, `account_type`, `cost_center`, `supervisor_one`, `supervisor_two`) VALUES
(1, 'admin', 'admin11', 1, 'John Doe', '', '', 'Kitting', '', '', ''),
(45, 'Nikka', 'nikka', 2, 'Marinel Nikka Zagala', '1426', 'Kitting', 'Supervisor', 'MASMOB', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(46, 'Carlos', 'carlos', 2, 'Juan Carlos Dela Cruz', '1944', 'Kitting', 'User', 'MASMO1', 'Luisa Pelobello', 'Dianne Salvatierra'),
(47, 'Antonio', 'antonio', 2, 'Antonio Morales', '5071', 'Inspector', 'User', 'MASMOA', 'Cinderella Ricacho', 'Ellaine Sanico'),
(48, 'Eduardo', 'eduardo', 2, 'Eduardo Villanueva', '6328', 'Operator', 'User', 'MASMOB', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(49, 'Marco', 'marco', 2, 'Marco Antonio Reyes', '8490', 'Operator', 'User', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(50, 'Gabriel', 'gabriel', 2, 'Gabriel Santos', '3761', 'Inspector', 'User', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra'),
(51, 'Sofia', 'sofia', 2, 'Sofia Lopez', '1239', 'Kitting', 'User', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra'),
(52, 'Teresa', 'teresa', 2, 'Maria Teresa Alvarado', '5603', 'Inspector', 'User', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra'),
(53, 'Jessica', 'jessica', 2, 'Jessica Mendoza', '7425', 'Operator', 'User', 'MASMOK', 'Cinderella Ricacho', 'Ellaine Sanico'),
(54, 'Bianca', 'biance', 2, 'Bianca Rivera', '2739', 'Kitting', 'User', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra'),
(55, 'Isabel', 'isabel', 2, 'Isabel Perez', '3426', 'Inspector', 'User', 'MASMPE', 'Oliver Mabutas', ''),
(56, 'Luis', 'luis', 2, 'Luis Delos Santos', '5021', 'Operator', 'User', 'MASMOJ', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(60, 'Nikkauser', 'Nikka14', 2, 'Nikka User', 'A77074', 'Operator', 'User', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(61, 'Harry', 'Harry', 2, 'Harry Robles', '123321', 'Operator', 'Supervisor', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_ccs`
--
ALTER TABLE `tbl_ccs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_ccs`
--
ALTER TABLE `tbl_ccs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
