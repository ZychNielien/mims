-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 12:18 PM
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
(47, '2025-03-06 14:54:47', 'Gear Assembly', '47L8X6T1', 50, '2025-03-15', 'FDS34F', 'LOT-3212', 'maan', 'Received'),
(48, '2025-03-06 15:05:17', 'Gear Assembly', '47L8X6T1', 32, '2025-03-22', 'FDS34F', 'LOT-3212', 'maan', 'Received'),
(49, '2025-03-06 15:12:08', 'Hydraulic Pump', 'MZ92G5X8', 90, '2025-03-08', 'FDS34F', 'LOT-3212', 'maan', 'Received'),
(50, '2025-03-06 15:17:09', 'Circuit Breaker', '9A2K1B4P', 120, '2025-03-29', 'FDS34F', 'LOT-3212', 'maan', 'Received'),
(51, '2025-03-06 15:18:10', 'Motor Coil', 'ZD1X8J7V', 130, '2025-03-28', 'FDS34F', 'LOT-3212', 'maan', 'Received'),
(52, '2025-03-06 15:18:32', 'Pressure Valve', '3Y6D9W2K', 150, '2025-03-27', 'DG342', 'G3WG3', 'maan', 'Received'),
(53, '2025-03-06 15:18:57', 'Electrical Connector', 'L4R1E5M3', 60, '2025-03-21', 'FGNT4', 'R43GV', 'maan', 'Received'),
(54, '2025-03-06 15:19:19', 'Cooling Fan', 'T8Q3V2H7', 30, '2025-04-05', 'GEW2', 'G3233', 'maan', 'Received'),
(55, '2025-03-06 15:19:34', 'Battery Pack', '1X5K9A3N', 60, '2025-03-31', 'BER33RE', 'BSDBS', 'maan', 'Received'),
(56, '2025-03-06 15:19:47', 'Control Module', 'B6M2D7S5', 90, '2025-04-03', 'EG22', 'GDGSE', 'maan', 'Received'),
(57, '2025-03-06 15:19:59', 'Filter Cartridge', 'R4F1C8Z9', 50, '2025-03-08', 'GE2', 'DSGDS', 'maan', 'Received'),
(58, '2025-03-10 10:42:20', 'Hydraulic Pump', 'MZ92G5X8', 23, '2025-04-05', 'Test', 'Test', 'Nikka', 'Received'),
(59, '2025-03-10 10:44:24', 'Filter Cartridge', 'R4F1C8Z9', 32, '2025-04-05', 'Tests', 'Tests', 'shadow', 'Received');

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
(64, '47L8X6T1', 'Gear Assembly', 'MASMO1', 'Warehouse A', '60', 'ea', 'Direct', '', '', 0),
(65, 'MZ92G5X8', 'Hydraulic Pump', 'MASMOA', 'Warehouse B', '10', 'rm', 'Direct', '', '', 0),
(66, '9A2K1B4P', 'Circuit Breaker', 'MASMO1', 'Warehouse C', '50', 'bag', 'Direct', '', '', 0),
(67, 'ZD1X8J7V', 'Motor Coil', 'MASMO1', 'Warehouse D', '60', 'bx', 'Direct', '', '', 0),
(68, '3Y6D9W2K', 'Pressure Valve', 'MASMOA', 'Warehouse E', '40', 'gal', 'Direct', '', '', 0),
(69, 'L4R1E5M3', 'Electrical Connector', 'MASMO1', 'Warehouse F', '8', 'pc', 'Direct', '', '', 0),
(70, 'T8Q3V2H7', 'Cooling Fan', 'MASMOD', 'Warehouse G', '10', 'ea', 'Indirect', '', '', 0),
(71, '1X5K9A3N', 'Battery Pack', 'MASMOB', 'Warehouse H', '30', 'kea', 'Indirect', '', '', 0),
(72, 'B6M2D7S5', 'Control Module', 'MASMO1', 'Warehouse I', '20', 'bx', 'Indirect', '', '', 0),
(73, 'R4F1C8Z9', 'Filter Cartridge', 'MASMOB', 'Warehouse J', '10', 'bag', 'Direct', '', '', 0);

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
(75, 'maan', 'Material Registration', 'maan has registered a new material 47L8X6T1', '2025-03-06 14:53:41'),
(76, 'maan', 'Update Inventory', 'maan has updated the inventory for 47L8X6T1with an addition of 32 items.', '2025-03-06 15:05:17'),
(77, 'maan', 'Material Registration', 'maan has registered a new material MZ92G5X8', '2025-03-06 15:07:29'),
(78, 'maan', 'Material Registration', 'maan has registered a new material 9A2K1B4P', '2025-03-06 15:09:07'),
(79, 'maan', 'Material Registration', 'maan has registered a new material ZD1X8J7V', '2025-03-06 15:09:27'),
(80, 'maan', 'Material Registration', 'maan has registered a new material 3Y6D9W2K', '2025-03-06 15:09:48'),
(81, 'maan', 'Material Registration', 'maan has registered a new material L4R1E5M3', '2025-03-06 15:10:09'),
(82, 'maan', 'Material Registration', 'maan has registered a new material T8Q3V2H7', '2025-03-06 15:10:32'),
(83, 'maan', 'Material Registration', 'maan has registered a new material 1X5K9A3N', '2025-03-06 15:10:53'),
(84, 'maan', 'Material Registration', 'maan has registered a new material B6M2D7S5', '2025-03-06 15:11:19'),
(85, 'maan', 'Material Registration', 'maan has registered a new material R4F1C8Z9', '2025-03-06 15:11:37'),
(86, 'maan', 'Update Inventory', 'maan has updated the inventory for MZ92G5X8 with an addition of 90 items.', '2025-03-06 15:12:08'),
(87, 'maan', 'Edit Material Details', 'maan has updated the details of material MZ92G5X8', '2025-03-06 15:15:54'),
(88, 'maan', 'Edit Material Details', 'maan has updated the details of material MZ92G5X8', '2025-03-06 15:16:01'),
(89, 'maan', 'Edit Material Details', 'maan has updated the details of material MZ92G5X8', '2025-03-06 15:16:09'),
(90, 'maan', 'Edit Material Details', 'maan has updated the details of material 47L8X6T1', '2025-03-06 15:16:22'),
(91, 'maan', 'Update Inventory', 'maan has updated the inventory for 9A2K1B4P with an addition of 120 items.', '2025-03-06 15:17:09'),
(92, 'maan', 'Update Inventory', 'maan has updated the inventory for ZD1X8J7V with an addition of 130 items.', '2025-03-06 15:18:10'),
(93, 'maan', 'Update Inventory', 'maan has updated the inventory for 3Y6D9W2K with an addition of 150 items.', '2025-03-06 15:18:32'),
(94, 'maan', 'Update Inventory', 'maan has updated the inventory for L4R1E5M3 with an addition of 60 items.', '2025-03-06 15:18:57'),
(95, 'maan', 'Update Inventory', 'maan has updated the inventory for T8Q3V2H7 with an addition of 30 items.', '2025-03-06 15:19:19'),
(96, 'maan', 'Update Inventory', 'maan has updated the inventory for 1X5K9A3N with an addition of 60 items.', '2025-03-06 15:19:34'),
(97, 'maan', 'Update Inventory', 'maan has updated the inventory for B6M2D7S5 with an addition of 90 items.', '2025-03-06 15:19:47'),
(98, 'maan', 'Update Inventory', 'maan has updated the inventory for R4F1C8Z9 with an addition of 50 items.', '2025-03-06 15:19:59'),
(99, 'maan', 'Material Registration', 'maan has registered a new material TRHTR', '2025-03-06 15:21:32'),
(100, 'maan', 'Material Deletion', 'maan has deleted TRHTR', '2025-03-06 15:21:42'),
(101, 'maan', 'Material Registration', 'maan has registered a new material 45Y4', '2025-03-06 15:22:07'),
(102, 'maan', 'Material Deletion', 'maan has deleted 45Y4', '2025-03-06 15:22:14'),
(103, 'maan', 'Edit Material Details', 'maan has updated the details of material R4F1C8Z9', '2025-03-06 15:23:01'),
(104, 'maan', 'Account Creation', 'maan has created an account for Shadow', '2025-03-06 15:54:54'),
(105, 'maan', 'Account Creation', 'maan has created an account for niel', '2025-03-06 16:00:37'),
(106, 'Nikka', 'Account Edit', 'Nikka has made changes to the account of Shadow', '2025-03-10 10:26:37'),
(107, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for MZ92G5X8 with an addition of 23 items.', '2025-03-10 10:42:20'),
(108, 'shadow', 'Update Inventory', 'shadow has updated the inventory for R4F1C8Z9 with an addition of 32 items.', '2025-03-10 10:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_machine`
--

CREATE TABLE `tbl_machine` (
  `id` int(11) NOT NULL,
  `machine_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_machine`
--

INSERT INTO `tbl_machine` (`id`, `machine_number`) VALUES
(1, 'MP3A_BG001'),
(2, 'MP3A_BG002'),
(3, 'MP3A_DA001'),
(4, 'MP3A_DA002'),
(5, 'MP3A_DA003'),
(6, 'MP3A_DA004'),
(7, 'MP3A_DA005'),
(8, 'MP3A_IR001'),
(9, 'MP3A_IR001'),
(10, 'MP3A_LM001'),
(11, 'MP3A_MO001'),
(12, 'MP3A_PLM002'),
(13, 'MP3A_PMC001'),
(14, 'MP3A_PMC002'),
(15, 'MP3A_PPM001'),
(16, 'MP3A_PPM002'),
(17, 'MP3A_PPM003'),
(18, 'MP3A_SC001'),
(19, 'MP3A_SC002'),
(20, 'MP3A_SC003'),
(21, 'MP3A_SC004'),
(22, 'MP3A_SC005'),
(23, 'MP3A_SW001'),
(24, 'MP3A_SW002'),
(25, 'MP3A_SW003'),
(26, 'MP3A_SW004'),
(27, 'MP3A_SW005'),
(28, 'MP3A_SW006'),
(29, 'MP3A_SW007'),
(30, 'MP3A_SW008'),
(31, 'MP3A_SW009'),
(32, 'MP3A_SW010'),
(33, 'MP3A_SW011'),
(34, 'MP3A_SW012'),
(35, 'MP3A_SWQ001'),
(36, 'MP3A_SWQ003'),
(37, 'MP3A_TNR001'),
(38, 'MP3A_TNR002'),
(39, 'MP3A_TP002'),
(40, 'MP3A_TP003'),
(41, 'MP3A_WB001L'),
(42, 'MP3A_WB001R'),
(43, 'MP3A_WB002L'),
(44, 'MP3A_WB002R'),
(45, 'MP3A_WB003L'),
(46, 'MP3A_WB003R'),
(47, 'MP3A_WB004L'),
(48, 'MP3A_WB004R'),
(49, 'MP3A_WB005L'),
(50, 'MP3A_WB005R'),
(51, 'MP3A_WB006L'),
(52, 'MP3A_WB006R'),
(53, 'MP3A_WB007L'),
(54, 'MP3A_WB007R'),
(55, 'MP3A_WB008L'),
(56, 'MP3A_WB008R'),
(57, 'MP3A_WB009L'),
(58, 'MP3A_WB009R'),
(59, 'MP3A_WB010L'),
(60, 'MP3A_WB010R'),
(61, 'MP3A_WB011L'),
(62, 'MP3A_WB011R'),
(63, 'MP3A_WB012L'),
(64, 'MP3A_WB012R'),
(65, 'MP3A_WB013L'),
(66, 'MP3A_WB013R'),
(67, 'MP3A_WB014L'),
(68, 'MP3A_WB014R'),
(69, 'MP3A_WB015L'),
(70, 'MP3A_WB015R'),
(71, 'MP3A_WB016L'),
(72, 'MP3A_WB016R'),
(73, 'MP3A_WB017L'),
(74, 'MP3A_WB017R'),
(75, 'MP3A_WB018L'),
(76, 'MP3A_WB018R'),
(77, 'MP3A_WB019L'),
(78, 'MP3A_WB019R'),
(79, 'MP3A_WB020L'),
(80, 'MP3A_WB020R'),
(81, 'MP3A_WM001'),
(82, 'MP3A_WM002'),
(83, 'MP3A_WM003'),
(84, 'MP3A_WM004'),
(85, 'MP3A_WM005'),
(86, 'MP3A_WM006'),
(87, 'MP3A_XR001');

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
(262, 'maan', 'maan has requested 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:24:19', 'admin', 'Approval'),
(263, 'maan', 'maan has requested 3 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 07:24:44', 'admin', 'Approval'),
(264, 'admin', 'admin has rejected 3 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 07:25:03', 'maan', ''),
(266, 'maan', 'maan has requested 3 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:27:17', 'admin', 'Approval'),
(267, 'admin', 'admin has approved 3 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:27:32', 'maan', ''),
(268, 'maan', 'maan is returning 2 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:28:26', 'admin', 'Scrap'),
(270, 'maan', 'maan is returning 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:31:57', 'admin', 'Scrap'),
(271, 'maan', 'admin has successfully received 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:32:28', 'maan', 'History'),
(272, 'admin', 'admin has requested 2 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:33:30', 'admin', 'Approval'),
(273, 'admin', 'admin has requested 2 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 07:33:39', 'admin', 'Approval'),
(274, 'maan', 'maan has approved 2 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 07:33:46', 'admin', ''),
(275, 'maan', 'maan has rejected 2 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:34:11', 'admin', ''),
(276, 'Marco', 'Marco has requested 23 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 07:53:42', 'admin', 'Approval'),
(277, 'System', '47L8X6T1 has reached the minimum inventory level and needs restocking.', 1, '2025-03-06 07:53:42', 'admin', 'Inventory'),
(278, 'Marco', 'Marco has canceled the withdrawal request for the 47L8X6T1 with a quantity of 23', 1, '2025-03-06 07:53:57', 'admin', 'Inventory'),
(279, 'shadow', 'shadow has requested 2 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 07:58:00', 'admin', 'Approval'),
(280, 'maan', 'maan has approved 2 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 07:58:11', 'shadow', ''),
(281, 'shadow', 'shadow is returning 1 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 07:59:32', 'admin', 'Scrap'),
(282, 'shadow', 'maan has successfully received 1 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 07:59:49', 'shadow', 'History'),
(283, 'maan', 'maan has requested 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 08:13:22', 'admin', 'Approval'),
(285, 'maan', 'maan has requested 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 08:15:34', 'admin', 'Approval'),
(286, 'maan', 'maan has canceled the withdrawal request for the 47L8X6T1 with a quantity of 1', 1, '2025-03-06 08:15:41', 'admin', 'Inventory'),
(287, 'Marco', 'Marco has requested 2 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 08:51:44', 'admin', 'Approval'),
(288, 'maan', 'maan has approved 2 of 47L8X6T1. Click here for more details.', 1, '2025-03-06 08:51:51', 'Marco', ''),
(289, 'Marco', 'Marco has requested 1 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 11:06:14', 'admin', 'Approval'),
(290, 'Nikka', 'Nikka has rejected 1 of MZ92G5X8. Click here for more details.', 1, '2025-03-06 11:06:53', 'Marco', ''),
(291, 'Nikka', 'Nikka has requested 3 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 03:26:33', 'admin', 'Approval'),
(292, 'Nikka', 'Nikka has rejected 3 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 03:26:39', 'Nikka', ''),
(293, 'Marco', 'Marco has requested 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 05:20:02', 'admin', 'Approval'),
(294, 'Marco', 'Marco has requested 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 05:21:22', 'admin', 'Approval'),
(295, 'Marco', 'Marco has requested 2 of 3Y6D9W2K. Click here for more details.', 1, '2025-03-07 05:26:42', 'admin', 'Approval'),
(296, 'Nikka', 'Nikka has approved 2 of 3Y6D9W2K. Click here for more details.', 1, '2025-03-07 05:28:03', 'Marco', ''),
(297, 'Nikka', 'Nikka has approved 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 05:32:55', 'Marco', ''),
(298, 'Nikka', 'Nikka has requested 2 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 05:38:42', 'admin', 'Approval'),
(299, 'admin', 'admin has approved 2 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 05:38:54', 'Nikka', ''),
(300, 'Nikka', 'Nikka is returning 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 05:47:02', 'admin', 'Scrap'),
(301, 'Nikka', 'Nikka has successfully received 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 05:47:10', 'Nikka', 'History'),
(302, 'Nikka', 'Nikka has requested 3 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 06:08:05', 'admin', 'Approval'),
(303, 'Nikka', 'Nikka has approved 3 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 06:08:12', 'Nikka', ''),
(304, 'Nikka', 'Nikka is returning 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 06:12:30', 'admin', 'Scrap'),
(305, 'Marco', 'Marco is returning 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 07:02:03', 'admin', 'Scrap'),
(306, 'Marco', 'Nikka has successfully received 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-07 07:02:46', 'Marco', 'History'),
(307, 'Nikka', 'Nikka has requested 2 of MZ92G5X8. Click here for more details.', 1, '2025-03-07 08:45:28', 'admin', 'Approval'),
(308, 'Nikka', 'Nikka has approved 2 of MZ92G5X8. Click here for more details.', 1, '2025-03-07 08:45:35', 'Nikka', 'Withdrawal'),
(309, 'System', 'MZ92G5X8 has expired. Total expired quantity: 84', 1, '2025-03-10 02:22:54', 'admin', 'Expired'),
(310, 'System', 'R4F1C8Z9 has expired. Total expired quantity: 50', 1, '2025-03-10 02:22:54', 'admin', 'Expired'),
(311, 'admin', 'admin has requested 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-10 02:24:24', 'admin', 'Approval'),
(312, 'admin', 'admin has requested 1 of 9A2K1B4P. Click here for more details.', 1, '2025-03-10 02:24:38', 'admin', 'Approval'),
(313, 'admin', 'admin has requested 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-10 02:25:03', 'admin', 'Approval'),
(314, 'Nikka', 'Nikka has approved 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-10 02:25:19', 'admin', 'Withdrawal'),
(315, 'Nikka', 'Nikka has approved 1 of 9A2K1B4P. Click here for more details.', 1, '2025-03-10 02:25:19', 'admin', 'Withdrawal'),
(316, 'shadow', 'shadow has requested 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-10 02:27:03', 'admin', 'Approval'),
(317, 'shadow', 'shadow has requested 1 of B6M2D7S5. Click here for more details.', 1, '2025-03-10 02:27:26', 'admin', 'Approval'),
(318, 'shadow', 'shadow has requested 1 of ZD1X8J7V. Click here for more details.', 1, '2025-03-10 02:27:36', 'admin', 'Approval'),
(319, 'shadow', 'shadow has requested 1 of 1X5K9A3N. Click here for more details.', 1, '2025-03-10 02:27:45', 'admin', 'Approval'),
(320, 'shadow', 'shadow has requested 1 of L4R1E5M3. Click here for more details.', 1, '2025-03-10 02:27:54', 'admin', 'Approval'),
(321, 'shadow', 'shadow has requested 1 of 3Y6D9W2K. Click here for more details.', 1, '2025-03-10 02:28:03', 'admin', 'Approval'),
(322, 'Nikka', 'Nikka has approved 1 of 3Y6D9W2K. Click here for more details.', 1, '2025-03-10 02:28:34', 'shadow', 'Withdrawal'),
(323, 'Nikka', 'Nikka has approved 1 of 1X5K9A3N. Click here for more details.', 1, '2025-03-10 02:28:34', 'shadow', 'Withdrawal'),
(324, 'Nikka', 'Nikka has rejected 1 of L4R1E5M3. Click here for more details.', 1, '2025-03-10 02:28:52', 'shadow', 'Withdrawal'),
(325, 'Nikka', 'Nikka has rejected 1 of ZD1X8J7V. Click here for more details.', 1, '2025-03-10 02:28:52', 'shadow', 'Withdrawal'),
(326, 'Nikka', 'Nikka has approved 1 of B6M2D7S5. Click here for more details.', 1, '2025-03-10 02:29:37', 'shadow', 'Withdrawal'),
(327, 'Nikka', 'Nikka has rejected 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-10 02:29:40', 'shadow', 'Withdrawal'),
(328, 'shadow', 'shadow is returning 1 of B6M2D7S5. Click here for more details.', 1, '2025-03-10 02:30:20', 'admin', 'Scrap'),
(329, 'shadow', 'Nikka has successfully received 1 of B6M2D7S5. Click here for more details.', 1, '2025-03-10 02:30:32', 'shadow', 'History'),
(330, 'shadow', 'shadow is returning 1 of 1X5K9A3N. Click here for more details.', 1, '2025-03-10 02:33:35', 'admin', 'Scrap'),
(331, 'shadow', 'Nikka has successfully received 1 of 1X5K9A3N. Click here for more details.', 1, '2025-03-10 02:33:42', 'shadow', 'Withdrawal'),
(332, 'Nikka', 'Nikka has rejected 1 of 47L8X6T1. Click here for more details.', 1, '2025-03-10 02:43:24', 'admin', 'Withdrawal'),
(333, 'Nikka', 'Nikka has rejected 1 of 47L8X6T1. Click here for more details.', 0, '2025-03-10 02:43:24', 'Marco', 'Withdrawal');

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
  `exp_date` text NOT NULL,
  `machine_no` varchar(50) NOT NULL,
  `with_reason` text NOT NULL,
  `req_by` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cost_center` varchar(255) NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `dts_approve` varchar(255) NOT NULL,
  `rejected_by` varchar(255) NOT NULL,
  `dts_rejected` varchar(255) NOT NULL,
  `return_reason` text NOT NULL,
  `dts_return` varchar(255) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `dts_receive` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requested`
--

INSERT INTO `tbl_requested` (`id`, `dts`, `part_name`, `lot_id`, `part_desc`, `station_code`, `part_option`, `part_qty`, `exp_date`, `machine_no`, `with_reason`, `req_by`, `status`, `cost_center`, `approved_by`, `dts_approve`, `rejected_by`, `dts_rejected`, `return_reason`, `dts_return`, `return_qty`, `received_by`, `dts_receive`) VALUES
(143, '2025-03-06 15:24:19', '47L8X6T1', 'LOT-3212', 'Gear Assembly', 'CDP 1', 'Direct', 1, '2025-03-15', 'MP3A_PPM002', 'Replacement', 'maan', 'returned', '<br />\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:xampphtdocsmimsviewadminModuleadminWithdrawal.php</b> on line <b>50</b><br />\n', 'admin', '2025-03-06 15:25:27', '', '', 'DEFECT', '2025-03-06 15:31:57', 1, 'admin', '2025-03-06 15:32:28'),
(144, '2025-03-06 15:24:44', 'MZ92G5X8', 'LOT-3212', 'Hydraulic Pump', 'CDP 1', 'Direct', 3, '2025-03-08', 'MP3A_PPM001', 'Change Cap', 'maan', 'rejected', '<br />\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:xampphtdocsmimsviewadminModuleadminWithdrawal.php</b> on line <b>50</b><br />\n', '', '', 'admin', '2025-03-06 15:25:03', '', '', 0, '', ''),
(145, '2025-03-06 15:27:17', '47L8X6T1', 'W3R2', 'Gear Assembly', 'CDP 1', 'Direct', 3, '2025-03-15', 'MP3A_PPM002', 'Dummy Use', 'maan', 'returned', '<br />\r\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:xampphtdocsmimsviewadminModuleadminWithdrawal.php</b> on line <b>50</b><br />\r\n', 'admin', '2025-03-06 15:27:32', '', '', 'DEFECT', '2025-03-06 15:28:26', 2, 'admin', '2025-03-06 15:28:38'),
(146, '2025-03-06 15:33:30', '47L8X6T1', '34324', 'Gear Assembly', 'CDP 3', 'Direct', 2, '2025-03-15', 'MP3A_PPM002', 'Change Cap', 'admin', 'rejected', '', '', '', 'maan', '2025-03-06 15:34:11', '', '', 0, '', ''),
(147, '2025-03-06 15:33:39', 'MZ92G5X8', 'EG32', 'Hydraulic Pump', 'CDP 3', 'Direct', 2, '2025-03-08', 'MP3A_PPM003', 'Dummy Use', 'admin', 'approved', '', 'maan', '2025-03-06 15:33:46', '', '', '', '', 0, '', ''),
(149, '2025-03-06 15:58:00', 'MZ92G5X8', 'ewr', 'Hydraulic Pump', 'CDP 1', 'Direct', 2, '2025-03-08', 'MP3A_PPM002', 'Dummy Use', 'shadow', 'returned', 'MASMOA', 'maan', '2025-03-06 15:58:11', '', '', 'ewf', '2025-03-06 15:59:32', 1, 'maan', '2025-03-06 15:59:49'),
(152, '2025-03-06 16:51:44', '47L8X6T1', 'LOT-3212', 'Gear Assembly', 'CDP 2', 'Direct', 2, '2025-03-15', 'MP3A_PPM001', 'Dummy Use', 'Marco', 'returned', 'MASMOC', 'maan', '2025-03-06 16:51:51', '', '', 'test', '2025-03-07 15:02:03', 1, 'Nikka', '2025-03-07 15:02:46'),
(153, '2025-03-06 19:06:14', 'MZ92G5X8', 'LOT-3212', 'Hydraulic Pump', 'CDP 1', 'Direct', 1, '2025-03-08', 'MP3A_PMC002', 'Change Cap', 'Marco', 'rejected', 'MASMOC', '', '', 'Nikka', '2025-03-06 19:06:53', '', '', 0, '', ''),
(154, '2025-03-07 11:26:33', '47L8X6T1', '234', 'Gear Assembly', 'CDP 2', 'Direct', 3, '2025-03-15', 'MP3A_PPM001', 'Dummy Use', 'Nikka', 'rejected', 'MASMOB', '', '', 'Nikka', '2025-03-07 11:26:39', '', '', 0, '', ''),
(155, '2025-03-07 13:20:02', '47L8X6T1', 'LOT-3212', 'Gear Assembly', 'CDP 1', 'Direct', 1, '2025-03-15', 'MP3A_PMC002', 'Change Cap', 'Marco', 'approved', 'MASMOC', 'Nikka', '2025-03-07 13:32:55', '', '', '', '', 0, '', ''),
(156, '2025-03-07 13:21:22', '47L8X6T1', 'LOT-3212', 'Gear Assembly', 'CDP 2', 'Direct', 1, '2025-03-15', 'MP3A_PPM003', 'General Use', 'Marco', 'rejected', 'MASMOC', '', '', 'Nikka', '2025-03-10 10:43:24', '', '', 0, '', ''),
(157, '2025-03-07 13:26:42', '3Y6D9W2K', 'LOT-3212', 'Pressure Valve', 'CDP 2', 'Direct', 2, '2025-03-27', 'MP3A_PPM001', 'General Use', 'Marco', 'approved', 'MASMOC', 'Nikka', '2025-03-07 13:28:03', '', '', '', '', 0, '', ''),
(158, '2025-03-07 13:38:42', '47L8X6T1', 'LOT-3212', 'Gear Assembly', 'CDP 2', 'Direct', 2, '2025-03-15', 'MP3A_PMC002', 'Engineering Eval', 'Nikka', 'returned', 'MASMOB', 'admin', '2025-03-07 13:38:54', '', '', 'test', '2025-03-07 13:47:02', 1, 'Nikka', '2025-03-07 13:47:10'),
(159, '2025-03-07 14:08:05', '47L8X6T1', 'LOT-3212', 'Gear Assembly', 'CDP 1', 'Direct', 3, '2025-03-15', 'MP3A_PPM002', 'Change Cap', 'Nikka', 'returning', 'MASMOB', 'Nikka', '2025-03-07 14:08:12', '', '', 'test', '2025-03-07 14:12:30', 1, '', ''),
(160, '2025-03-07 16:45:28', 'MZ92G5X8', 'LOT-3212', 'Hydraulic Pump', 'CDP 1', 'Direct', 2, '2025-03-08', 'MP3A_PMC002', 'General Use', 'Nikka', 'approved', 'MASMOB', 'Nikka', '2025-03-07 16:45:35', '', '', '', '', 0, '', ''),
(161, '2025-03-10 10:24:24', '47L8X6T1', 'test', 'Gear Assembly', 'CDP 2', 'Direct', 1, '2025-03-15', 'MP3A_PPM001', 'Replacement', 'admin', 'rejected', '', '', '', 'Nikka', '2025-03-10 10:43:24', '', '', 0, '', ''),
(162, '2025-03-10 10:24:38', '9A2K1B4P', 'test', 'Circuit Breaker', 'CDP 3', 'Direct', 1, '2025-03-29', 'MP3A_PPM001', 'Engineering Eval', 'admin', 'approved', '', 'Nikka', '2025-03-10 10:25:19', '', '', '', '', 0, '', ''),
(163, '2025-03-10 10:25:03', '47L8X6T1', 'test', 'Gear Assembly', 'Engg', 'Direct', 1, '2025-03-15', 'MP3A_PPM003', 'Dummy Use', 'admin', 'approved', '', 'Nikka', '2025-03-10 10:25:19', '', '', '', '', 0, '', ''),
(164, '2025-03-10 10:27:03', '47L8X6T1', '2', 'Gear Assembly', 'CDP 1', 'Direct', 1, '2025-03-15', 'MP3A_PPM002', 'Change Cap', 'shadow', 'rejected', 'MASMOA', '', '', 'Nikka', '2025-03-10 10:29:40', '', '', 0, '', ''),
(165, '2025-03-10 10:27:26', 'B6M2D7S5', 'rest', 'Control Module', 'CDP 2', 'Indirect', 1, '2025-04-03', 'MP3A_PPM002', 'Change Cap', 'shadow', 'returned', 'MASMOA', 'Nikka', '2025-03-10 10:29:37', '', '', 'test', '2025-03-10 10:30:20', 1, 'Nikka', '2025-03-10 10:30:32'),
(166, '2025-03-10 10:27:36', 'ZD1X8J7V', 'test', 'Motor Coil', 'CDP 1', 'Direct', 1, '2025-03-28', 'MP3A_PPM003', 'Dummy Use', 'shadow', 'rejected', 'MASMOA', '', '', 'Nikka', '2025-03-10 10:28:52', '', '', 0, '', ''),
(167, '2025-03-10 10:27:45', '1X5K9A3N', 'test', 'Battery Pack', 'CDP 2', 'Indirect', 1, '2025-03-31', 'MP3A_SC001', 'Dummy Use', 'shadow', 'returned', 'MASMOA', 'Nikka', '2025-03-10 10:28:34', '', '', 'test', '2025-03-10 10:33:35', 1, 'Nikka', '2025-03-10 10:33:42'),
(168, '2025-03-10 10:27:54', 'L4R1E5M3', 'test', 'Electrical Connector', 'DA', 'Direct', 1, '2025-03-21', 'MP3A_PPM003', 'Dummy Use', 'shadow', 'rejected', 'MASMOA', '', '', 'Nikka', '2025-03-10 10:28:52', '', '', 0, '', ''),
(169, '2025-03-10 10:28:03', '3Y6D9W2K', 'test', 'Pressure Valve', 'CDP 2', 'Direct', 1, '2025-03-27', 'MP3A_PPM001', 'Engineering Eval', 'shadow', 'approved', 'MASMOA', 'Nikka', '2025-03-10 10:28:34', '', '', '', '', 0, '', '');

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
(29, '47L8X6T1', '37', '2025-03-15', 'FDS34F', 'LOT-3212', '2025-03-06 14:54:47', 'maan', 'Active'),
(30, '47L8X6T1', '32', '2025-03-22', 'FDS34F', 'LOT-3212', '2025-03-06 15:05:17', 'maan', 'Active'),
(31, 'MZ92G5X8', '84', '2025-03-08', 'FDS34F', 'LOT-3212', '2025-03-06 15:12:08', 'maan', 'Expired'),
(32, '9A2K1B4P', '119', '2025-03-29', 'FDS34F', 'LOT-3212', '2025-03-06 15:17:09', 'maan', 'Active'),
(33, 'ZD1X8J7V', '130', '2025-03-28', 'FDS34F', 'LOT-3212', '2025-03-06 15:18:10', 'maan', 'Active'),
(34, '3Y6D9W2K', '147', '2025-03-27', 'DG342', 'G3WG3', '2025-03-06 15:18:32', 'maan', 'Active'),
(35, 'L4R1E5M3', '60', '2025-03-21', 'FGNT4', 'R43GV', '2025-03-06 15:18:57', 'maan', 'Active'),
(36, 'T8Q3V2H7', '30', '2025-04-05', 'GEW2', 'G3233', '2025-03-06 15:19:19', 'maan', 'Active'),
(37, '1X5K9A3N', '59', '2025-03-31', 'BER33RE', 'BSDBS', '2025-03-06 15:19:34', 'maan', 'Active'),
(38, 'B6M2D7S5', '89', '2025-04-03', 'EG22', 'GDGSE', '2025-03-06 15:19:47', 'maan', 'Active'),
(39, 'R4F1C8Z9', '50', '2025-03-08', 'GE2', 'DSGDS', '2025-03-06 15:19:59', 'maan', 'Expired'),
(40, 'MZ92G5X8', '23', '2025-04-05', 'Test', 'Test', '2025-03-10 10:42:20', 'Nikka', 'Active'),
(41, 'R4F1C8Z9', '32', '2025-04-05', 'Tests', 'Tests', '2025-03-10 10:44:24', 'shadow', 'Active');

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
(1, 'admin', 'admin11', 2, 'John Doe', '', '', 'Kitting', '', '', ''),
(45, 'Nikka', 'nikka', 2, 'Marinel Nikka Zagala', '1426', 'Kitting', 'Supervisor', 'MASMOB', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(46, 'Carlos', 'carlos', 2, 'Juan Carlos Dela Cruz', '1944', 'Kitting', 'User', 'MASMO1', 'Luisa Pelobello', 'Dianne Salvatierra'),
(47, 'Antonio', 'antonio', 1, 'Antonio Morales', '5071', 'Inspector', 'User', 'MASMOA', 'Cinderella Ricacho', 'Ellaine Sanico'),
(48, 'Eduardo', 'eduardo', 2, 'Eduardo Villanueva', '6328', 'Operator', 'User', 'MASMOB', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(49, 'Marco', 'marco', 2, 'Marco Antonio Reyes', '8490', 'Operator', 'User', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(50, 'Gabriel', 'gabriel', 2, 'Gabriel Santos', '3761', 'Inspector', 'User', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra'),
(51, 'Sofia', 'sofia', 2, 'Sofia Lopez', '1239', 'Kitting', 'User', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra'),
(52, 'Teresa', 'teresa', 2, 'Maria Teresa Alvarado', '5603', 'Inspector', 'User', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra'),
(53, 'Jessica', 'jessica', 2, 'Jessica Mendoza', '7425', 'Operator', 'User', 'MASMOK', 'Cinderella Ricacho', 'Ellaine Sanico'),
(54, 'Bianca', 'biance', 2, 'Bianca Rivera', '2739', 'Kitting', 'User', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra'),
(55, 'Isabel', 'isabel', 2, 'Isabel Perez', '3426', 'Inspector', 'User', 'MASMPE', 'Oliver Mabutas', ''),
(56, 'Luis', 'luis', 2, 'Luis Delos Santos', '5021', 'Operator', 'User', 'MASMOJ', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(67, 'shadow', 'shadow', 2, 'Shadow', 'f32f', 'Kitting', 'Kitting', 'MASMOA', 'Cinderella Ricacho', 'Elaine Sanico'),
(68, 'niel', 'niel', 2, 'niel', 'niel', 'Operator', 'User', 'MASMO1', 'Luisa Pelobello', 'Dianne Salvatierra');

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
-- Indexes for table `tbl_machine`
--
ALTER TABLE `tbl_machine`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tbl_machine`
--
ALTER TABLE `tbl_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
