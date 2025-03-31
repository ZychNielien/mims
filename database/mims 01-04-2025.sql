-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 05:14 PM
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
(77, '2025-03-28 19:50:31', 'Bolt, 5mm', 'P12345', 800, '2025-04-02', 'KIT-001', 'LOT-1001', 'Nikka', 'Received'),
(78, '2025-03-28 19:53:12', 'Bolt, 5mm', 'P12345', 800, '2025-04-02', 'KIT-001', 'LOT-1001', 'Nikka', 'Received'),
(79, '2025-03-28 19:56:08', 'Bolt, 5mm', 'P12345', 800, '2025-04-02', 'KIT-001', 'LOT-1001', 'Nikka', 'Received'),
(80, '2025-03-28 19:56:31', 'Bolt, 5mm', 'P12345', 800, '2025-04-02', 'KIT-001', 'LOT-1001', 'Nikka', 'Received'),
(81, '2025-03-28 19:56:42', 'Bolt, 5mm', 'P12345', 800, '2025-04-02', 'KIT-001', 'LOT-1001', 'Nikka', 'Received'),
(82, '2025-03-28 19:58:33', 'Bolt, 5mm', 'P12345', 800, '2025-04-02', 'KIT-001', 'LOT-1001', 'Nikka', 'Received'),
(83, '2025-03-28 19:59:30', 'Bolt, 5mm', 'P12345', 800, '2025-04-02', 'KIT-001', 'LOT-1001', 'Nikka', 'Received'),
(84, '2025-03-28 20:18:48', 'Copper Wire, 50m', 'P67890', 500, '2025-04-05', 'KIT-002', 'LOT-1002', 'Nikka', 'Received'),
(85, '2025-03-28 20:19:23', 'Plastic Washer, 10mm', 'P54321', 1200, '2025-04-08', 'KIT-003', 'OT-1003', 'Nikka', 'Received'),
(86, '2025-03-28 20:19:48', 'Steel Plate, 2mm', 'P98765', 1400, '2025-04-14', 'KIT-004', 'LOT-1004', 'Nikka', 'Received'),
(87, '2025-03-28 20:20:16', 'Electrical Tape, Black', 'P45678', 750, '2025-04-03', 'KIT-005', 'LOT-1005', 'Nikka', 'Received'),
(88, '2025-03-28 20:20:41', 'Gasket, Rubber, 30mm', 'P11223', 980, '2025-04-02', 'KIT-006', 'LOT-1006', 'Nikka', 'Received'),
(89, '2025-03-28 20:21:01', 'Air Filter, HEPA', 'P99876', 890, '2025-04-05', 'KIT-007', 'LOT-1007', 'Nikka', 'Received'),
(90, '2025-03-28 20:21:23', 'LED Light Bulb, 10W', 'P33445', 560, '2025-04-04', 'KIT-008', 'LOT-1008', 'Nikka', 'Received'),
(91, '2025-03-28 20:21:47', 'Lubricant, Industrial', 'P55667', 930, '2025-05-07', 'KIT-009', 'LOT-1009', 'Nikka', 'Received'),
(92, '2025-03-28 20:22:06', 'Hydraulic Pump, 5000psi', 'P22334', 639, '2025-04-04', 'KIT-010', 'LOT-1010', 'Nikka', 'Received'),
(93, '2025-03-30 20:25:50', 'Bolt, 5mm', 'P12345', 32, '2025-03-30', '432', '432', 'Nikka', 'Received'),
(94, '2025-03-30 20:26:07', 'Plastic Washer, 10mm', 'P54321', 21, '2025-03-31', '5324', '5324', 'Nikka', 'Received');

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
  `kitting_id` varchar(255) NOT NULL,
  `part_qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `part_name`, `part_desc`, `cost_center`, `location`, `min_invent_req`, `unit`, `part_option`, `kitting_id`, `part_qty`) VALUES
(1, 'P12345', 'Bolt, 5mm', 'MASMO1', 'Warehouse A', '100', 'pc', 'Direct', '', 0),
(2, 'P67890', 'Copper Wire, 50m', 'MASMO1', 'Warehouse B', '200', 'm', 'Indirect', '', 0),
(3, 'P54321', 'Plastic Washer, 10mm', 'MASMOD', 'Warehouse C', '500', 'pc', 'Direct', '', 0),
(4, 'P98765', 'Steel Plate, 2mm', 'MASMOG', 'Warehouse A', '50', 'set', 'Direct', '', 0),
(5, 'P45678', 'Electrical Tape, Black', 'MASMOJ', 'Warehouse D', '150', 'rol', 'Direct', '', 0),
(6, 'P11223', 'Gasket, Rubber, 30mm', 'MASMO1', 'Warehouse B', '250', 'pc', 'Indirect', '', 0),
(7, 'P99876', 'Air Filter, HEPA', 'MASMOA', 'Warehouse C', '30', 'ea', 'Direct', '', 0),
(8, 'P33445', 'LED Light Bulb, 10W', 'MASMO1', 'Warehouse A', '300', 'pc', 'Indirect', '', 0),
(9, 'P55667', 'Lubricant, Industrial', 'MASMOK', 'Warehouse D', '100', 'bag', 'Direct', '', 0),
(10, 'P22334', 'Hydraulic Pump, 5000psi', 'MASMOA', 'Warehouse B', '20', 'pr', 'Direct', '', 0);

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
(149, 'Nikka', 'Material Registration', 'Nikka has registered a new material P12345', '2025-03-28 18:57:06'),
(150, 'Nikka', 'Material Registration', 'Nikka has registered a new material P67890', '2025-03-28 19:00:45'),
(151, 'Nikka', 'Material Registration', 'Nikka has registered a new material P54321', '2025-03-28 19:01:15'),
(152, 'Nikka', 'Material Registration', 'Nikka has registered a new material P98765', '2025-03-28 19:01:53'),
(153, 'Nikka', 'Material Registration', 'Nikka has registered a new material P45678', '2025-03-28 19:02:27'),
(154, 'Nikka', 'Material Registration', 'Nikka has registered a new material P11223', '2025-03-28 19:02:56'),
(155, 'Nikka', 'Material Registration', 'Nikka has registered a new material P99876', '2025-03-28 19:03:30'),
(156, 'Nikka', 'Material Registration', 'Nikka has registered a new material P33445', '2025-03-28 19:03:55'),
(157, 'Nikka', 'Material Registration', 'Nikka has registered a new material P55667', '2025-03-28 19:04:21'),
(158, 'Nikka', 'Material Registration', 'Nikka has registered a new material P22334', '2025-03-28 19:04:46'),
(165, 'Nikka', 'Account Registration', 'Nikka has created an account for Juan Reyes', '2025-03-28 19:22:03'),
(166, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of Juan Reyes', '2025-03-28 19:22:14'),
(167, 'Nikka', 'Account Registration', 'Nikka has created an account for Maria Santos', '2025-03-28 19:24:48'),
(168, 'Nikka', 'Account Registration', 'Nikka has created an account for Juan Reyes', '2025-03-28 19:25:17'),
(169, 'Nikka', 'Account Registration', 'Nikka has created an account for Pedro Garcia', '2025-03-28 19:26:41'),
(170, 'Nikka', 'Account Registration', 'Nikka has created an account for Laura Cruz', '2025-03-28 19:31:41'),
(171, 'Nikka', 'Account Registration', 'Nikka has created an account for Carlos Villanueva', '2025-03-28 19:32:10'),
(172, 'Nikka', 'Account Registration', 'Nikka has created an account for Sofia Rivera', '2025-03-28 19:32:35'),
(173, 'Nikka', 'Account Registration', 'Nikka has created an account for Eduardo Ortiz', '2025-03-28 19:33:02'),
(174, 'Nikka', 'Account Registration', 'Nikka has created an account for Roberto Diaz', '2025-03-28 19:33:30'),
(175, 'Nikka', 'Account Registration', 'Nikka has created an account for Isabel Gomez', '2025-03-28 19:33:57'),
(176, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:50:31'),
(177, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:53:12'),
(178, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:56:08'),
(179, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:56:31'),
(180, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:56:42'),
(181, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:58:33'),
(182, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:59:30'),
(183, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P67890 with an addition of 500 items.', '2025-03-28 20:18:48'),
(184, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P54321 with an addition of 1200 items.', '2025-03-28 20:19:23'),
(185, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P98765 with an addition of 1400 items.', '2025-03-28 20:19:48'),
(186, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P45678 with an addition of 750 items.', '2025-03-28 20:20:16'),
(187, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P11223 with an addition of 980 items.', '2025-03-28 20:20:41'),
(188, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P99876 with an addition of 890 items.', '2025-03-28 20:21:01'),
(189, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P33445 with an addition of 560 items.', '2025-03-28 20:21:23'),
(190, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P55667 with an addition of 930 items.', '2025-03-28 20:21:47'),
(191, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P22334 with an addition of 639 items.', '2025-03-28 20:22:06'),
(192, 'Nikka', 'Material Registration', 'Nikka has registered a new material P22734', '2025-03-28 20:23:14'),
(193, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material P12734', '2025-03-28 20:23:22'),
(194, 'Nikka', 'Material Deletion', 'Nikka has deleted P12734', '2025-03-28 20:23:46'),
(200, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Karen Lopez.', '2025-03-30 19:51:00'),
(201, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Luis Garcia.', '2025-03-30 19:51:15'),
(202, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Monica Santiago.', '2025-03-30 19:51:15'),
(203, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Fernando Alvarez.', '2025-03-30 19:51:15'),
(204, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of Jessica Ramirez.', '2025-03-30 19:51:27'),
(205, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of Daniel Morales.', '2025-03-30 19:51:49'),
(206, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of Patricia Cruz.', '2025-03-30 19:51:49'),
(207, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of David Bautista.', '2025-03-30 19:51:49'),
(208, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 32 items.', '2025-03-30 20:25:50'),
(209, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P54321 with an addition of 21 items.', '2025-03-30 20:26:07'),
(210, 'Nikka', 'Password changed', 'Nikka has updated the password for Pedro account.', '2025-03-31 19:27:40'),
(211, 'Nikka', 'Account Registration', 'Nikka has created an account for test', '2025-03-31 19:29:05'),
(212, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of teste', '2025-03-31 19:29:35'),
(213, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of teste', '2025-03-31 19:30:10'),
(214, 'Nikka', 'Cost Center Registration', 'Nikka has successfully registered a new test in the system.', '2025-03-31 13:31:00'),
(215, 'Nikka', 'Cost Center Modification', 'Nikka has successfully updated the details of the test in the system.', '2025-03-31 13:31:26'),
(216, 'Nikka', 'Cost Center Deletion', 'Nikka has successfully deleted the test from the system.', '2025-03-31 13:32:03');

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
(414, 'Roberto', 'Roberto has requested 2 of P12345. Click here for more details.', 1, '2025-03-28 12:43:51', 'admin', 'Approval'),
(415, 'Roberto', 'Roberto has requested 2 of P67890. Click here for more details.', 1, '2025-03-28 12:44:14', 'admin', 'Approval'),
(416, 'Roberto', 'Roberto has requested 2 of P33445. Click here for more details.', 1, '2025-03-28 12:44:27', 'admin', 'Approval'),
(417, 'Roberto', 'Roberto has requested 1 of P98765. Click here for more details.', 1, '2025-03-28 12:44:42', 'admin', 'Approval'),
(418, 'Roberto', 'Roberto has requested 5 of P45678. Click here for more details.', 1, '2025-03-28 12:45:08', 'admin', 'Approval'),
(419, 'Roberto', 'Roberto has requested 2 of P22334. Click here for more details.', 1, '2025-03-28 12:45:22', 'admin', 'Approval'),
(420, 'Roberto', 'Roberto has requested 2 of P99876. Click here for more details.', 1, '2025-03-28 12:45:36', 'admin', 'Approval'),
(421, 'Roberto', 'Roberto has requested 2 of P99876. Click here for more details.', 1, '2025-03-28 12:45:55', 'admin', 'Approval'),
(422, 'Roberto', 'Roberto has requested 2 of P33445. Click here for more details.', 1, '2025-03-28 12:46:08', 'admin', 'Approval'),
(423, 'Roberto', 'Roberto has requested 1 of P22334. Click here for more details.', 1, '2025-03-28 12:46:20', 'admin', 'Approval'),
(424, 'Carlos', 'Carlos has requested 2 of P12345. Click here for more details.', 1, '2025-03-28 12:49:56', 'admin', 'Approval'),
(425, 'Carlos', 'Carlos has requested 4 of P54321. Click here for more details.', 1, '2025-03-28 12:50:08', 'admin', 'Approval'),
(426, 'Carlos', 'Carlos has requested 5 of P99876. Click here for more details.', 1, '2025-03-28 12:50:18', 'admin', 'Approval'),
(427, 'Carlos', 'Carlos has requested 6 of P11223. Click here for more details.', 1, '2025-03-28 12:50:27', 'admin', 'Approval'),
(428, 'Carlos', 'Carlos has requested 3 of P55667. Click here for more details.', 1, '2025-03-28 12:50:38', 'admin', 'Approval'),
(429, 'Carlos', 'Carlos has requested 5 of P33445. Click here for more details.', 1, '2025-03-28 12:50:52', 'admin', 'Approval'),
(430, 'Carlos', 'Carlos has requested 5 of P12345. Click here for more details.', 1, '2025-03-28 12:51:03', 'admin', 'Approval'),
(431, 'Carlos', 'Carlos has requested 2 of P55667. Click here for more details.', 1, '2025-03-28 12:51:13', 'admin', 'Approval'),
(432, 'Carlos', 'Carlos has requested 5 of P12345. Click here for more details.', 1, '2025-03-28 12:51:24', 'admin', 'Approval'),
(433, 'Carlos', 'Carlos has requested 8 of P98765. Click here for more details.', 1, '2025-03-28 12:51:38', 'admin', 'Approval'),
(434, 'Sofia', 'Sofia has requested 2 of P12345. Click here for more details.', 1, '2025-03-28 13:07:26', 'admin', 'Approval'),
(435, 'Sofia', 'Sofia has requested 2 of P54321. Click here for more details.', 1, '2025-03-28 13:07:38', 'admin', 'Approval'),
(436, 'Sofia', 'Sofia has requested 2 of P98765. Click here for more details.', 1, '2025-03-28 13:07:55', 'admin', 'Approval'),
(437, 'Sofia', 'Sofia has requested 5 of P45678. Click here for more details.', 1, '2025-03-28 13:08:42', 'admin', 'Approval'),
(438, 'Sofia', 'Sofia has requested 3 of P22334. Click here for more details.', 1, '2025-03-28 13:08:56', 'admin', 'Approval'),
(439, 'Sofia', 'Sofia has requested 6 of P99876. Click here for more details.', 1, '2025-03-28 13:09:08', 'admin', 'Approval'),
(440, 'Sofia', 'Sofia has requested 9 of P55667. Click here for more details.', 1, '2025-03-28 13:09:21', 'admin', 'Approval'),
(441, 'Sofia', 'Sofia has requested 6 of P54321. Click here for more details.', 1, '2025-03-28 13:09:34', 'admin', 'Approval'),
(442, 'Sofia', 'Sofia has requested 9 of P33445. Click here for more details.', 1, '2025-03-28 13:09:45', 'admin', 'Approval'),
(443, 'Sofia', 'Sofia has requested 3 of P55667. Click here for more details.', 1, '2025-03-28 13:09:58', 'admin', 'Approval'),
(444, 'Laura', 'Laura has requested 2 of P67890. Click here for more details.', 1, '2025-03-28 13:11:00', 'admin', 'Approval'),
(445, 'Laura', 'Laura has requested 5 of P12345. Click here for more details.', 1, '2025-03-28 13:11:12', 'admin', 'Approval'),
(446, 'Laura', 'Laura has requested 3 of P55667. Click here for more details.', 1, '2025-03-28 13:11:27', 'admin', 'Approval'),
(447, 'Laura', 'Laura has requested 2 of P54321. Click here for more details.', 1, '2025-03-28 13:11:37', 'admin', 'Approval'),
(448, 'Laura', 'Laura has requested 1 of P55667. Click here for more details.', 1, '2025-03-28 13:11:51', 'admin', 'Approval'),
(449, 'Laura', 'Laura has requested 2 of P33445. Click here for more details.', 1, '2025-03-28 13:12:03', 'admin', 'Approval'),
(450, 'Laura', 'Laura has requested 2 of P12345. Click here for more details.', 1, '2025-03-28 13:12:13', 'admin', 'Approval'),
(451, 'Laura', 'Laura has requested 2 of P33445. Click here for more details.', 1, '2025-03-28 13:12:24', 'admin', 'Approval'),
(452, 'Laura', 'Laura has requested 2 of P54321. Click here for more details.', 1, '2025-03-28 13:12:35', 'admin', 'Approval'),
(453, 'Laura', 'Laura has requested 2 of P33445. Click here for more details.', 1, '2025-03-28 13:12:44', 'admin', 'Approval'),
(454, 'Isabel', 'Isabel has requested 2 of P12345. Click here for more details.', 1, '2025-03-28 13:14:41', 'admin', 'Approval'),
(455, 'Isabel', 'Isabel has requested 1 of P12345. Click here for more details.', 1, '2025-03-28 13:14:55', 'admin', 'Approval'),
(456, 'Isabel', 'Isabel has requested 2 of P98765. Click here for more details.', 1, '2025-03-28 13:15:05', 'admin', 'Approval'),
(457, 'Isabel', 'Isabel has requested 2 of P22334. Click here for more details.', 1, '2025-03-28 13:15:15', 'admin', 'Approval'),
(458, 'Isabel', 'Isabel has requested 5 of P99876. Click here for more details.', 1, '2025-03-28 13:15:27', 'admin', 'Approval'),
(459, 'Isabel', 'Isabel has requested 5 of P22334. Click here for more details.', 1, '2025-03-28 13:15:39', 'admin', 'Approval'),
(460, 'Isabel', 'Isabel has requested 2 of P33445. Click here for more details.', 1, '2025-03-28 13:15:48', 'admin', 'Approval'),
(461, 'Isabel', 'Isabel has requested 5 of P55667. Click here for more details.', 1, '2025-03-28 13:16:00', 'admin', 'Approval'),
(462, 'Isabel', 'Isabel has requested 5 of P33445. Click here for more details.', 1, '2025-03-28 13:16:11', 'admin', 'Approval'),
(463, 'Isabel', 'Isabel has requested 2 of P45678. Click here for more details.', 1, '2025-03-28 13:16:24', 'admin', 'Approval'),
(464, 'Juan', 'Juan has requested 2 of P12345. Click here for more details.', 1, '2025-03-28 13:37:56', 'admin', 'Approval'),
(465, 'Juan', 'Juan has requested 2 of P67890. Click here for more details.', 1, '2025-03-28 13:38:07', 'admin', 'Approval'),
(466, 'Juan', 'Juan has requested 2 of P54321. Click here for more details.', 1, '2025-03-28 13:38:16', 'admin', 'Approval'),
(467, 'Juan', 'Juan has requested 2 of P45678. Click here for more details.', 1, '2025-03-28 13:38:26', 'admin', 'Approval'),
(468, 'Juan', 'Juan has requested 2 of P55667. Click here for more details.', 1, '2025-03-28 13:38:36', 'admin', 'Approval'),
(469, 'Juan', 'Juan has requested 5 of P11223. Click here for more details.', 1, '2025-03-28 13:38:49', 'admin', 'Approval'),
(470, 'Juan', 'Juan has requested 4 of P45678. Click here for more details.', 1, '2025-03-28 13:39:05', 'admin', 'Approval'),
(471, 'Juan', 'Juan has requested 5 of P55667. Click here for more details.', 1, '2025-03-28 13:39:15', 'admin', 'Approval'),
(472, 'Juan', 'Juan has requested 2 of P98765. Click here for more details.', 1, '2025-03-28 13:39:25', 'admin', 'Approval'),
(473, 'Juan', 'Juan has requested 6 of P12345. Click here for more details.', 1, '2025-03-28 13:39:37', 'admin', 'Approval'),
(474, 'Maria', 'Maria has requested 5 of P67890. Click here for more details.', 1, '2025-03-30 11:07:14', 'admin', 'Approval'),
(475, 'Maria', 'Maria has requested 2 of P11223. Click here for more details.', 1, '2025-03-30 11:07:24', 'admin', 'Approval'),
(476, 'Maria', 'Maria has requested 3 of P54321. Click here for more details.', 1, '2025-03-30 11:07:34', 'admin', 'Approval'),
(477, 'Maria', 'Maria has requested 5 of P22334. Click here for more details.', 1, '2025-03-30 11:07:46', 'admin', 'Approval'),
(478, 'Maria', 'Maria has requested 5 of P55667. Click here for more details.', 1, '2025-03-30 11:07:57', 'admin', 'Approval'),
(479, 'Maria', 'Maria has requested 5 of P33445. Click here for more details.', 1, '2025-03-30 11:08:09', 'admin', 'Approval'),
(480, 'Maria', 'Maria has requested 9 of P99876. Click here for more details.', 1, '2025-03-30 11:08:23', 'admin', 'Approval'),
(481, 'Maria', 'Maria has requested 6 of P67890. Click here for more details.', 1, '2025-03-30 11:08:35', 'admin', 'Approval'),
(482, 'Maria', 'Maria has requested 2 of P45678. Click here for more details.', 1, '2025-03-30 11:08:50', 'admin', 'Approval'),
(483, 'Maria', 'Maria has requested 5 of P12345. Click here for more details.', 1, '2025-03-30 11:09:02', 'admin', 'Approval'),
(484, 'Eduardo', 'Eduardo has requested 2 of P12345. Click here for more details.', 1, '2025-03-30 11:09:46', 'admin', 'Approval'),
(485, 'Eduardo', 'Eduardo has requested 2 of P99876. Click here for more details.', 1, '2025-03-30 11:09:57', 'admin', 'Approval'),
(486, 'Eduardo', 'Eduardo has requested 6 of P98765. Click here for more details.', 1, '2025-03-30 11:10:08', 'admin', 'Approval'),
(487, 'Eduardo', 'Eduardo has requested 7 of P33445. Click here for more details.', 1, '2025-03-30 11:10:19', 'admin', 'Approval'),
(488, 'Eduardo', 'Eduardo has requested 2 of P45678. Click here for more details.', 1, '2025-03-30 11:10:30', 'admin', 'Approval'),
(489, 'Eduardo', 'Eduardo has requested 2 of P99876. Click here for more details.', 1, '2025-03-30 11:10:42', 'admin', 'Approval'),
(490, 'Eduardo', 'Eduardo has requested 2 of P45678. Click here for more details.', 1, '2025-03-30 11:10:54', 'admin', 'Approval'),
(491, 'Eduardo', 'Eduardo has requested 2 of P55667. Click here for more details.', 1, '2025-03-30 11:11:07', 'admin', 'Approval'),
(492, 'Eduardo', 'Eduardo has requested 3 of P33445. Click here for more details.', 1, '2025-03-30 11:11:19', 'admin', 'Approval'),
(493, 'Eduardo', 'Eduardo has requested 5 of P99876. Click here for more details.', 1, '2025-03-30 11:11:33', 'admin', 'Approval'),
(494, 'System', 'Karen Lopez account registration is awaiting approval.', 1, '2025-03-30 11:13:36', 'adminOnly', 'Account Registration Pending Approval'),
(495, 'System', 'Luis Garcia account registration is awaiting approval.', 1, '2025-03-30 11:14:03', 'adminOnly', 'Account Registration Pending Approval'),
(496, 'System', 'Monica Santiago account registration is awaiting approval.', 1, '2025-03-30 11:14:23', 'adminOnly', 'Account Registration Pending Approval'),
(497, 'System', 'Fernando Alvarez account registration is awaiting approval.', 1, '2025-03-30 11:14:45', 'adminOnly', 'Account Registration Pending Approval'),
(498, 'System', 'Jessica Ramirez account registration is awaiting approval.', 1, '2025-03-30 11:15:08', 'adminOnly', 'Account Registration Pending Approval'),
(499, 'System', 'Daniel Morales account registration is awaiting approval.', 1, '2025-03-30 11:15:32', 'adminOnly', 'Account Registration Pending Approval'),
(500, 'System', 'Patricia Cruz account registration is awaiting approval.', 1, '2025-03-30 11:15:56', 'adminOnly', 'Account Registration Pending Approval'),
(501, 'System', 'David Bautista account registration is awaiting approval.', 1, '2025-03-30 11:16:14', 'adminOnly', 'Account Registration Pending Approval'),
(502, 'System', 'Angela Ramos account registration is awaiting approval.', 1, '2025-03-30 11:16:37', 'adminOnly', 'Account Registration Pending Approval'),
(503, 'Nikka', 'Nikka has approved 5 of P99876. Click here for more details.', 1, '2025-03-30 11:58:27', 'Eduardo', 'Approved'),
(504, 'Nikka', 'Nikka has approved 3 of P33445. Click here for more details.', 1, '2025-03-30 11:58:27', 'Eduardo', 'Approved'),
(505, 'Nikka', 'Nikka has approved 2 of P45678. Click here for more details.', 0, '2025-03-30 11:58:27', 'Maria', 'Approved'),
(506, 'Nikka', 'Nikka has approved 9 of P99876. Click here for more details.', 0, '2025-03-30 11:58:27', 'Maria', 'Approved'),
(507, 'Nikka', 'Nikka has approved 6 of P12345. Click here for more details.', 1, '2025-03-30 11:58:27', 'Juan', 'Approved'),
(508, 'Nikka', 'Nikka has approved 2 of P98765. Click here for more details.', 1, '2025-03-30 11:58:27', 'Juan', 'Approved'),
(509, 'Nikka', 'Nikka has approved 5 of P11223. Click here for more details.', 1, '2025-03-30 11:58:27', 'Juan', 'Approved'),
(510, 'Nikka', 'Nikka has approved 5 of P33445. Click here for more details.', 0, '2025-03-30 11:58:27', 'Isabel', 'Approved'),
(511, 'Nikka', 'Nikka has approved 5 of P22334. Click here for more details.', 0, '2025-03-30 11:58:27', 'Isabel', 'Approved'),
(512, 'Nikka', 'Nikka has approved 2 of P22334. Click here for more details.', 0, '2025-03-30 11:58:27', 'Isabel', 'Approved'),
(513, 'Nikka', 'Nikka has approved 1 of P12345. Click here for more details.', 0, '2025-03-30 11:58:27', 'Isabel', 'Approved'),
(514, 'Nikka', 'Nikka has approved 1 of P55667. Click here for more details.', 1, '2025-03-30 11:58:27', 'Laura', 'Approved'),
(515, 'Nikka', 'Nikka has approved 2 of P54321. Click here for more details.', 1, '2025-03-30 11:58:27', 'Laura', 'Approved'),
(516, 'Nikka', 'Nikka has approved 9 of P55667. Click here for more details.', 0, '2025-03-30 11:58:27', 'Sofia', 'Approved'),
(517, 'Nikka', 'Nikka has approved 6 of P99876. Click here for more details.', 0, '2025-03-30 11:58:27', 'Sofia', 'Approved'),
(518, 'Nikka', 'Nikka has approved 5 of P45678. Click here for more details.', 0, '2025-03-30 11:58:27', 'Sofia', 'Approved'),
(519, 'Nikka', 'Nikka has approved 5 of P33445. Click here for more details.', 0, '2025-03-30 11:58:27', 'Carlos', 'Approved'),
(520, 'Nikka', 'Nikka has approved 3 of P55667. Click here for more details.', 0, '2025-03-30 11:58:27', 'Carlos', 'Approved'),
(521, 'Nikka', 'Nikka has approved 6 of P11223. Click here for more details.', 0, '2025-03-30 11:58:27', 'Carlos', 'Approved'),
(522, 'Nikka', 'Nikka has approved 2 of P99876. Click here for more details.', 0, '2025-03-30 11:58:27', 'Roberto', 'Approved'),
(523, 'Nikka', 'Nikka has approved 2 of P99876. Click here for more details.', 0, '2025-03-30 11:58:27', 'Roberto', 'Approved'),
(524, 'Nikka', 'Nikka has rejected 2 of P55667. Click here for more details.', 1, '2025-03-30 11:59:28', 'Eduardo', 'Rejected'),
(525, 'Nikka', 'Nikka has rejected 2 of P45678. Click here for more details.', 1, '2025-03-30 11:59:28', 'Eduardo', 'Rejected'),
(526, 'Nikka', 'Nikka has rejected 2 of P99876. Click here for more details.', 1, '2025-03-30 11:59:28', 'Eduardo', 'Rejected'),
(527, 'Nikka', 'Nikka has rejected 5 of P12345. Click here for more details.', 0, '2025-03-30 11:59:28', 'Maria', 'Rejected'),
(528, 'Nikka', 'Nikka has rejected 6 of P67890. Click here for more details.', 0, '2025-03-30 11:59:28', 'Maria', 'Rejected'),
(529, 'Nikka', 'Nikka has rejected 4 of P45678. Click here for more details.', 1, '2025-03-30 11:59:28', 'Juan', 'Rejected'),
(530, 'Nikka', 'Nikka has rejected 2 of P55667. Click here for more details.', 1, '2025-03-30 11:59:28', 'Juan', 'Rejected'),
(531, 'Nikka', 'Nikka has rejected 2 of P45678. Click here for more details.', 1, '2025-03-30 11:59:28', 'Juan', 'Rejected'),
(532, 'Nikka', 'Nikka has rejected 5 of P99876. Click here for more details.', 0, '2025-03-30 11:59:28', 'Isabel', 'Rejected'),
(533, 'Nikka', 'Nikka has rejected 2 of P98765. Click here for more details.', 0, '2025-03-30 11:59:28', 'Isabel', 'Rejected'),
(534, 'Nikka', 'Nikka has rejected 2 of P12345. Click here for more details.', 0, '2025-03-30 11:59:28', 'Isabel', 'Rejected'),
(535, 'Nikka', 'Nikka has rejected 2 of P12345. Click here for more details.', 1, '2025-03-30 11:59:28', 'Laura', 'Rejected'),
(536, 'Nikka', 'Nikka has rejected 2 of P33445. Click here for more details.', 1, '2025-03-30 11:59:28', 'Laura', 'Rejected'),
(537, 'Nikka', 'Nikka has rejected 3 of P22334. Click here for more details.', 0, '2025-03-30 11:59:28', 'Sofia', 'Rejected'),
(538, 'Nikka', 'Nikka has rejected 2 of P98765. Click here for more details.', 0, '2025-03-30 11:59:28', 'Sofia', 'Rejected'),
(539, 'Nikka', 'Nikka has rejected 5 of P12345. Click here for more details.', 0, '2025-03-30 11:59:28', 'Carlos', 'Rejected'),
(540, 'Nikka', 'Nikka has rejected 2 of P33445. Click here for more details.', 0, '2025-03-30 11:59:28', 'Roberto', 'Rejected'),
(541, 'Nikka', 'Nikka has rejected 2 of P22334. Click here for more details.', 0, '2025-03-30 11:59:28', 'Roberto', 'Rejected'),
(542, 'Nikka', 'Nikka has rejected 5 of P45678. Click here for more details.', 0, '2025-03-30 11:59:28', 'Roberto', 'Rejected'),
(543, 'Nikka', 'Nikka has rejected 1 of P98765. Click here for more details.', 0, '2025-03-30 11:59:28', 'Roberto', 'Rejected'),
(544, 'Pedro', 'Pedro has requested a password change.', 1, '2025-03-30 12:12:56', 'adminOnly', 'Request password change'),
(545, 'Sofia', 'Sofia has requested a password change.', 1, '2025-03-30 12:13:03', 'adminOnly', 'Request password change'),
(546, 'Isabel', 'Isabel has requested a password change.', 1, '2025-03-30 12:13:19', 'adminOnly', 'Request password change'),
(547, 'System', 'P12345 has expired. Total expired quantity: 32', 1, '2025-03-30 12:25:50', 'admin', 'Expired'),
(548, 'System', 'P54321 has expired. Total expired quantity: 21', 1, '2025-03-31 02:32:16', 'admin', 'Expired'),
(549, 'Nikka', 'Nikka has approved 2 of P45678. Click here for more details.', 1, '2025-03-31 11:49:47', 'Eduardo', 'Approved'),
(550, 'Nikka', 'Nikka has rejected 7 of P33445. Click here for more details.', 1, '2025-03-31 11:49:51', 'Eduardo', 'Rejected'),
(551, 'Eduardo', 'Eduardo is returning 1 of P45678. Click here for more details.', 1, '2025-03-31 14:30:04', 'admin', 'Scrap'),
(552, 'Eduardo', 'Eduardo has successfully received 1 of P45678. Click here for more details.', 1, '2025-03-31 14:30:15', 'Eduardo', 'Returned'),
(553, 'Juan', 'Juan is returning 1 of P11223. Click here for more details.', 1, '2025-03-31 14:45:18', 'admin', 'Scrap'),
(554, 'Juan', 'Eduardo has successfully received 1 of P11223. Click here for more details.', 1, '2025-03-31 14:45:32', 'Juan', 'Returned');

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
(176, '2025-03-28 20:43:51', 'P12345', 'LOT-1011', 'Bolt, 5mm', 'CDP 3', 'Direct', 2, '2025-04-02', 'MP3A_PMC002', 'Replacement', 'Roberto', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(177, '2025-03-28 20:44:14', 'P67890', 'LOT-1012', 'Copper Wire, 50m', 'CDP 2', 'Indirect', 2, '2025-04-05', 'MP3A_PPM001', 'Dummy Use', 'Roberto', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(178, '2025-03-28 20:44:27', 'P33445', 'LOT-1013', 'LED Light Bulb, 10W', 'CDP 1', 'Indirect', 2, '2025-04-04', 'MP3A_PMC002', 'Use for Packaging', 'Roberto', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(179, '2025-03-28 20:44:42', 'P98765', 'LOT-1014', 'Steel Plate, 2mm', 'EOL', 'Direct', 1, '2025-04-14', 'MP3A_LM001', 'Replacement', 'Roberto', 'rejected', 'MASMOD', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(180, '2025-03-28 20:45:08', 'P45678', 'LOT-1015', 'Electrical Tape, Black', 'EOL', 'Direct', 5, '2025-04-03', 'MP3A_PPM002', 'MC Setup', 'Roberto', 'rejected', 'MASMOD', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(181, '2025-03-28 20:45:22', 'P22334', 'LOT-1016', 'Hydraulic Pump, 5000psi', 'CDP 2', 'Direct', 2, '2025-04-04', 'MP3A_SC002', 'Use for Cleaning', 'Roberto', 'rejected', 'MASMOD', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(182, '2025-03-28 20:45:36', 'P99876', 'LOT-1017', 'Air Filter, HEPA', 'Mold', 'Direct', 2, '2025-04-05', 'MP3A_PPM002', 'General Use', 'Roberto', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(183, '2025-03-28 20:45:55', 'P99876', 'LOT-1018', 'Air Filter, HEPA', 'CDP 3', 'Direct', 2, '2025-04-05', 'MP3A_IR001', 'Dummy Use', 'Roberto', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(184, '2025-03-28 20:46:08', 'P33445', 'LOT-1019', 'LED Light Bulb, 10W', 'CDP 3', 'Indirect', 2, '2025-04-04', 'MP3A_PPM001', 'Use for Packaging', 'Roberto', 'rejected', 'MASMOD', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(185, '2025-03-28 20:46:20', 'P22334', 'LOT-1020', 'Hydraulic Pump, 5000psi', 'DA', 'Direct', 1, '2025-04-04', 'MP3A_PPM003', 'Dummy Use', 'Roberto', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(186, '2025-03-28 20:49:56', 'P12345', 'LOT-1021', 'Bolt, 5mm', 'CDP 2', 'Direct', 2, '2025-04-02', 'MP3A_PPM001', 'MC Setup', 'Carlos', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(187, '2025-03-28 20:50:08', 'P54321', 'LOT-1022', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 4, '2025-04-08', 'MP3A_PPM002', 'Use for Packaging', 'Carlos', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(188, '2025-03-28 20:50:18', 'P99876', 'LOT-1023', 'Air Filter, HEPA', 'CDP 3', 'Direct', 5, '2025-04-05', 'MP3A_PPM002', 'Engineering Eval', 'Carlos', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(189, '2025-03-28 20:50:27', 'P11223', 'LOT-1024', 'Gasket, Rubber, 30mm', 'CDP 2', 'Indirect', 6, '2025-04-02', 'MP3A_PPM003', 'Use for Packaging', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(190, '2025-03-28 20:50:38', 'P55667', 'LOT-1025', 'Lubricant, Industrial', 'CDP 3', 'Direct', 3, '2025-05-07', 'MP3A_PPM003', 'Engineering Eval', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(191, '2025-03-28 20:50:52', 'P33445', 'LOT-1026', 'LED Light Bulb, 10W', 'CDP 2', 'Indirect', 5, '2025-04-04', 'MP3A_SC001', 'General Use', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(192, '2025-03-28 20:51:03', 'P12345', 'LOT-1027', 'Bolt, 5mm', 'CDP 3', 'Direct', 5, '2025-04-02', 'MP3A_PPM002', 'Engineering Eval', 'Carlos', 'rejected', 'MASMOD', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(193, '2025-03-28 20:51:13', 'P55667', 'LOT-1028', 'Lubricant, Industrial', 'WB', 'Direct', 2, '2025-05-07', 'MP3A_PPM002', 'Engineering Eval', 'Carlos', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(194, '2025-03-28 20:51:24', 'P12345', 'LOT-1029', 'Bolt, 5mm', 'CDP 1', 'Direct', 5, '2025-04-02', 'MP3A_IR001', 'Use for Packaging', 'Carlos', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(195, '2025-03-28 20:51:38', 'P98765', 'LOT-1030', 'Steel Plate, 2mm', 'CDP 3', 'Direct', 8, '2025-04-14', 'MP3A_PPM002', 'Change Cap', 'Carlos', 'Pending', 'MASMOD', '', '', '', '', '', '', 0, '', ''),
(196, '2025-03-28 21:07:26', 'P12345', 'LOT-1031', 'Bolt, 5mm', 'CDP 1', 'Direct', 2, '2025-04-02', 'MP3A_PPM002', 'Use for Cleaning', 'Sofia', 'Pending', 'MASMOL', '', '', '', '', '', '', 0, '', ''),
(197, '2025-03-28 21:07:38', 'P54321', 'LOT-1032', 'Plastic Washer, 10mm', 'CDP 1', 'Direct', 2, '2025-04-08', 'MP3A_SC001', 'Use for Packaging', 'Sofia', 'Pending', 'MASMOL', '', '', '', '', '', '', 0, '', ''),
(198, '2025-03-28 21:07:55', 'P98765', 'LOT-1033', 'Steel Plate, 2mm', 'CDP 3', 'Direct', 2, '2025-04-14', 'MP3A_WM005', 'Use for Packaging', 'Sofia', 'rejected', 'MASMOL', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(199, '2025-03-28 21:08:42', 'P45678', 'LOT-1034', 'Electrical Tape, Black', 'WB', 'Direct', 5, '2025-04-03', 'MP3A_SC001', 'Use for Packaging', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(200, '2025-03-28 21:08:56', 'P22334', 'LOT-1035', 'Hydraulic Pump, 5000psi', 'Engg', 'Direct', 3, '2025-04-04', 'MP3A_WM003', 'Use for Packaging', 'Sofia', 'rejected', 'MASMOL', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(201, '2025-03-28 21:09:08', 'P99876', 'LOT-1036', 'Air Filter, HEPA', 'CDP 2', 'Direct', 6, '2025-04-05', 'MP3A_PPM003', 'Change Cap', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(202, '2025-03-28 21:09:21', 'P55667', 'LOT-1037', 'Lubricant, Industrial', 'CDP 3', 'Direct', 9, '2025-05-07', 'MP3A_SC001', 'Dummy Use', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(203, '2025-03-28 21:09:34', 'P54321', 'LOT-1038', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 6, '2025-04-08', 'MP3A_SC001', 'General Use', 'Sofia', 'Pending', 'MASMOL', '', '', '', '', '', '', 0, '', ''),
(204, '2025-03-28 21:09:45', 'P33445', 'LOT-1039', 'LED Light Bulb, 10W', 'CDP 3', 'Indirect', 9, '2025-04-04', 'MP3A_WM006', 'Use for Packaging', 'Sofia', 'Pending', 'MASMOL', '', '', '', '', '', '', 0, '', ''),
(205, '2025-03-28 21:09:58', 'P55667', 'LOT-1040', 'Lubricant, Industrial', 'CDP 2', 'Direct', 3, '2025-05-07', 'MP3A_PPM001', 'Use for Packaging', 'Sofia', 'Pending', 'MASMOL', '', '', '', '', '', '', 0, '', ''),
(206, '2025-03-28 21:11:00', 'P67890', 'LOT-1041', 'Copper Wire, 50m', 'WB', 'Indirect', 2, '2025-04-05', 'MP3A_PPM001', 'Use for Cleaning', 'Laura', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(207, '2025-03-28 21:11:12', 'P12345', 'LOT-1042', 'Bolt, 5mm', 'CDP 3', 'Direct', 5, '2025-04-02', 'MP3A_PPM003', 'Use for Cleaning', 'Laura', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(208, '2025-03-28 21:11:27', 'P55667', 'LOT-1043', 'Lubricant, Industrial', 'CDP 2', 'Direct', 3, '2025-05-07', 'MP3A_PPM001', 'Engineering Eval', 'Laura', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(209, '2025-03-28 21:11:37', 'P54321', 'LOT-1044', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 2, '2025-04-08', 'MP3A_MO001', 'General Use', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(210, '2025-03-28 21:11:51', 'P55667', 'LOT-1045', 'Lubricant, Industrial', 'DA', 'Direct', 1, '2025-05-07', 'MP3A_WM006', 'Dummy Use', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(211, '2025-03-28 21:12:03', 'P33445', 'LOT-1046', 'LED Light Bulb, 10W', 'CDP 1', 'Indirect', 2, '2025-04-04', 'MP3A_PMC002', 'Dummy Use', 'Laura', 'rejected', 'MASMOC', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(212, '2025-03-28 21:12:13', 'P12345', 'LOT-1047', 'Bolt, 5mm', 'CDP 3', 'Direct', 2, '2025-04-02', 'MP3A_PPM002', 'Change Cap', 'Laura', 'rejected', 'MASMOC', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(213, '2025-03-28 21:12:24', 'P33445', 'LOT-1048', 'LED Light Bulb, 10W', 'EOL', 'Indirect', 2, '2025-04-04', 'MP3A_PMC001', 'Replacement', 'Laura', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(214, '2025-03-28 21:12:35', 'P54321', 'LOT-1049', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 2, '2025-04-08', 'MP3A_LM001', 'Change Cap', 'Laura', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(215, '2025-03-28 21:12:44', 'P33445', 'LOT-1050', 'LED Light Bulb, 10W', 'EOL', 'Indirect', 2, '2025-04-04', 'MP3A_WM002', 'Dummy Use', 'Laura', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(216, '2025-03-28 21:14:41', 'P12345', 'LOT-1051', 'Bolt, 5mm', 'CDP 3', 'Direct', 2, '2025-04-02', 'MP3A_PPM002', 'Change Cap', 'Isabel', 'rejected', 'MASMOC', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(217, '2025-03-28 21:14:55', 'P12345', 'LOT-1052', 'Bolt, 5mm', 'CDP 2', 'Direct', 1, '2025-04-02', 'MP3A_PPM001', 'Engineering Eval', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(218, '2025-03-28 21:15:05', 'P98765', 'LOT-1053', 'Steel Plate, 2mm', 'CDP 3', 'Direct', 2, '2025-04-14', 'MP3A_PMC002', 'Change Cap', 'Isabel', 'rejected', 'MASMOC', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(219, '2025-03-28 21:15:15', 'P22334', 'LOT-1054', 'Hydraulic Pump, 5000psi', 'Mold', 'Direct', 2, '2025-04-04', 'MP3A_PPM001', 'Dummy Use', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(220, '2025-03-28 21:15:27', 'P99876', 'LOT-1055', 'Air Filter, HEPA', 'CDP 3', 'Direct', 5, '2025-04-05', 'MP3A_PMC002', 'Dummy Use', 'Isabel', 'rejected', 'MASMOC', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(221, '2025-03-28 21:15:39', 'P22334', 'LOT-1056', 'Hydraulic Pump, 5000psi', 'CDP 2', 'Direct', 5, '2025-04-04', 'MP3A_PPM001', 'Replacement', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(222, '2025-03-28 21:15:48', 'P33445', 'LOT-1057', 'LED Light Bulb, 10W', 'CDP 3', 'Indirect', 2, '2025-04-04', 'MP3A_PPM001', 'Engineering Eval', 'Isabel', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(223, '2025-03-28 21:16:00', 'P55667', 'LOT-1058', 'Lubricant, Industrial', 'CDP 3', 'Direct', 5, '2025-05-07', 'MP3A_PLM002', 'Change Cap', 'Isabel', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(224, '2025-03-28 21:16:11', 'P33445', 'LOT-1059', 'LED Light Bulb, 10W', 'CDP 2', 'Indirect', 5, '2025-04-04', 'MP3A_MO001', 'Change Cap', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(225, '2025-03-28 21:16:24', 'P45678', 'LOT-1060', 'Electrical Tape, Black', 'WB', 'Direct', 2, '2025-04-03', 'MP3A_MO001', 'Use for Cleaning', 'Isabel', 'Pending', 'MASMOC', '', '', '', '', '', '', 0, '', ''),
(226, '2025-03-28 21:37:56', 'P12345', 'LOT-1061', 'Bolt, 5mm', 'CDP 2', 'Direct', 2, '2025-04-02', 'MP3A_PMC002', 'Change Cap', 'Juan', 'Pending', 'MASMOA', '', '', '', '', '', '', 0, '', ''),
(227, '2025-03-28 21:38:07', 'P67890', 'LOT-1062', 'Copper Wire, 50m', 'CDP 3', 'Indirect', 2, '2025-04-05', 'MP3A_PMC001', 'General Use', 'Juan', 'Pending', 'MASMOA', '', '', '', '', '', '', 0, '', ''),
(228, '2025-03-28 21:38:16', 'P54321', 'LOT-1063', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 2, '2025-04-08', 'MP3A_PPM001', 'Dummy Use', 'Juan', 'Pending', 'MASMOA', '', '', '', '', '', '', 0, '', ''),
(229, '2025-03-28 21:38:26', 'P45678', 'LOT-1064', 'Electrical Tape, Black', 'CDP 2', 'Direct', 2, '2025-04-03', 'MP3A_XR001', 'Dummy Use', 'Juan', 'rejected', 'MASMOA', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(230, '2025-03-28 21:38:36', 'P55667', 'LOT-1065', 'Lubricant, Industrial', 'DA', 'Direct', 2, '2025-05-07', 'MP3A_PPM001', 'Dummy Use', 'Juan', 'rejected', 'MASMOA', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(231, '2025-03-28 21:38:49', 'P11223', 'LOT-1066', 'Gasket, Rubber, 30mm', 'CDP 3', 'Indirect', 5, '2025-04-02', 'MP3A_PMC002', 'General Use', 'Juan', 'returned', 'MASMOA', 'Nikka', '2025-03-30 19:58:27', '', '', 'test', '2025-03-31 22:45:18', 1, 'Eduardo', '2025-03-31 22:45:32'),
(232, '2025-03-28 21:39:05', 'P45678', 'LOT-1067', 'Electrical Tape, Black', 'Mold', 'Direct', 4, '2025-04-03', 'MP3A_PPM001', 'Dummy Use', 'Juan', 'rejected', 'MASMOA', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(233, '2025-03-28 21:39:15', 'P55667', 'LOT-1068', 'Lubricant, Industrial', 'WB', 'Direct', 5, '2025-05-07', 'MP3A_PPM001', 'Dummy Use', 'Juan', 'Pending', 'MASMOA', '', '', '', '', '', '', 0, '', ''),
(234, '2025-03-28 21:39:25', 'P98765', 'LOT-1069', 'Steel Plate, 2mm', 'DA', 'Direct', 2, '2025-04-14', 'MP3A_PPM003', 'Engineering Eval', 'Juan', 'approved', 'MASMOA', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(235, '2025-03-28 21:39:37', 'P12345', 'LOT-1070', 'Bolt, 5mm', 'WB', 'Direct', 6, '2025-04-02', 'MP3A_WM003', 'Replacement', 'Juan', 'approved', 'MASMOA', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(236, '2025-03-30 19:07:14', 'P67890', 'LOT-847362', 'Copper Wire, 50m', 'Mold', 'Indirect', 5, '2025-04-05', 'MP3A_PPM002', 'Engineering Eval', 'Maria', 'Pending', 'MASMO1', '', '', '', '', '', '', 0, '', ''),
(237, '2025-03-30 19:07:24', 'P11223', 'LOT-392847', 'Gasket, Rubber, 30mm', 'DA', 'Indirect', 2, '2025-04-02', 'MP3A_PPM001', 'Dummy Use', 'Maria', 'Pending', 'MASMO1', '', '', '', '', '', '', 0, '', ''),
(238, '2025-03-30 19:07:34', 'P54321', 'LOT-120394', 'Plastic Washer, 10mm', 'WB', 'Direct', 3, '2025-04-08', 'MP3A_PMC001', 'Engineering Eval', 'Maria', 'Pending', 'MASMO1', '', '', '', '', '', '', 0, '', ''),
(239, '2025-03-30 19:07:46', 'P22334', 'LOT-493827', 'Hydraulic Pump, 5000psi', 'DA', 'Direct', 5, '2025-04-04', 'MP3A_PPM001', 'Change Cap', 'Maria', 'Pending', 'MASMO1', '', '', '', '', '', '', 0, '', ''),
(240, '2025-03-30 19:07:57', 'P55667', 'LOT-758392', 'Lubricant, Industrial', 'Mold', 'Direct', 5, '2025-05-07', 'MP3A_PMC002', 'General Use', 'Maria', 'Pending', 'MASMO1', '', '', '', '', '', '', 0, '', ''),
(241, '2025-03-30 19:08:09', 'P33445', 'LOT-019384', 'LED Light Bulb, 10W', 'CDP 3', 'Indirect', 5, '2025-04-04', 'MP3A_PPM002', 'Dummy Use', 'Maria', 'Pending', 'MASMO1', '', '', '', '', '', '', 0, '', ''),
(242, '2025-03-30 19:08:23', 'P99876', 'LOT-573829', 'Air Filter, HEPA', 'DA', 'Direct', 9, '2025-04-05', 'MP3A_PPM002', 'Dummy Use', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(243, '2025-03-30 19:08:35', 'P67890', 'LOT-938472', 'Copper Wire, 50m', 'DA', 'Indirect', 6, '2025-04-05', 'MP3A_PPM002', 'Dummy Use', 'Maria', 'rejected', 'MASMO1', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(244, '2025-03-30 19:08:50', 'P45678', 'LOT-210394', 'Electrical Tape, Black', 'DA', 'Direct', 2, '2025-04-03', 'MP3A_PPM001', 'Engineering Eval', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(245, '2025-03-30 19:09:02', 'P12345', 'LOT-482910', 'Bolt, 5mm', 'WB', 'Direct', 5, '2025-04-02', 'MP3A_PPM001', 'Change Cap', 'Maria', 'rejected', 'MASMO1', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(246, '2025-03-30 19:09:46', 'P12345', 'LOT-382910', 'Bolt, 5mm', 'DA', 'Direct', 2, '2025-04-02', 'MP3A_PPM001', 'Use for Packaging', 'Eduardo', 'Pending', 'MASMPE', '', '', '', '', '', '', 0, '', ''),
(247, '2025-03-30 19:09:57', 'P99876', 'LOT-573829', 'Air Filter, HEPA', 'Mold', 'Direct', 2, '2025-04-05', 'MP3A_WM006', 'Engineering Eval', 'Eduardo', 'Pending', 'MASMPE', '', '', '', '', '', '', 0, '', ''),
(248, '2025-03-30 19:10:08', 'P98765', 'LOT-182910', 'Steel Plate, 2mm', 'DA', 'Direct', 6, '2025-04-14', 'MP3A_PPM001', 'Engineering Eval', 'Eduardo', 'Pending', 'MASMPE', '', '', '', '', '', '', 0, '', ''),
(249, '2025-03-30 19:10:19', 'P33445', 'LOT-573829', 'LED Light Bulb, 10W', 'DA', 'Indirect', 7, '2025-04-04', 'MP3A_WM005', 'Dummy Use', 'Eduardo', 'rejected', 'MASMPE', '', '', 'Nikka', '2025-03-31 19:49:51', '', '', 0, '', ''),
(250, '2025-03-30 19:10:30', 'P45678', 'LOT-291837', 'Electrical Tape, Black', 'Mold', 'Direct', 2, '2025-04-03', 'MP3A_PPM002', 'Use for Packaging', 'Eduardo', 'returned', 'MASMPE', 'Nikka', '2025-03-31 19:49:47', '', '', 'Test', '2025-03-31 22:30:04', 1, 'Eduardo', '2025-03-31 22:30:15'),
(251, '2025-03-30 19:10:42', 'P99876', 'LOT-492857', 'Air Filter, HEPA', 'CDP 3', 'Direct', 2, '2025-04-05', 'MP3A_WM005', 'Replacement', 'Eduardo', 'rejected', 'MASMPE', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(252, '2025-03-30 19:10:54', 'P45678', 'LOT-583920', 'Electrical Tape, Black', 'WB', 'Direct', 2, '2025-04-03', 'MP3A_PPM001', 'Dummy Use', 'Eduardo', 'rejected', 'MASMPE', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(253, '2025-03-30 19:11:07', 'P55667', 'LOT-183756', 'Lubricant, Industrial', 'DA', 'Direct', 2, '2025-05-07', 'MP3A_WM001', 'Dummy Use', 'Eduardo', 'rejected', 'MASMPE', '', '', 'Nikka', '2025-03-30 19:59:28', '', '', 0, '', ''),
(254, '2025-03-30 19:11:19', 'P33445', 'LOT-472019', 'LED Light Bulb, 10W', 'Engg', 'Indirect', 3, '2025-04-04', 'MP3A_WB017R', 'Engineering Eval', 'Eduardo', 'approved', 'MASMPE', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', ''),
(255, '2025-03-30 19:11:33', 'P99876', 'LOT-109384', 'Air Filter, HEPA', 'WB', 'Direct', 5, '2025-04-05', 'MP3A_PPM001', 'Use for Packaging', 'Eduardo', 'approved', 'MASMPE', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_station_code`
--

CREATE TABLE `tbl_station_code` (
  `id` int(11) NOT NULL,
  `station_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_station_code`
--

INSERT INTO `tbl_station_code` (`id`, `station_code`) VALUES
(21, 'CDP 1'),
(22, 'CDP 2'),
(23, 'CDP 3'),
(24, 'DA'),
(25, 'WB'),
(26, 'Mold'),
(27, 'EDL'),
(28, 'Engg'),
(29, 'MEE'),
(30, 'MFG');

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
(59, 'P12345', '5573', '2025-04-02', 'KIT-001', 'LOT-1001', '2025-03-28 19:59:30', 'Nikka', 'Active'),
(60, 'P67890', '489', '2025-04-05', 'KIT-002', 'LOT-1002', '2025-03-28 20:18:48', 'Nikka', 'Active'),
(61, 'P54321', '1179', '2025-04-08', 'KIT-003', 'OT-1003', '2025-03-28 20:19:23', 'Nikka', 'Active'),
(62, 'P98765', '1384', '2025-04-14', 'KIT-004', 'LOT-1004', '2025-03-28 20:19:48', 'Nikka', 'Active'),
(63, 'P45678', '739', '2025-04-03', 'KIT-005', 'LOT-1005', '2025-03-28 20:20:16', 'Nikka', 'Active'),
(64, 'P11223', '967', '2025-04-02', 'KIT-006', 'LOT-1006', '2025-03-28 20:20:41', 'Nikka', 'Active'),
(65, 'P99876', '859', '2025-04-05', 'KIT-007', 'LOT-1007', '2025-03-28 20:21:01', 'Nikka', 'Active'),
(66, 'P33445', '525', '2025-04-04', 'KIT-008', 'LOT-1008', '2025-03-28 20:21:23', 'Nikka', 'Active'),
(67, 'P55667', '894', '2025-05-07', 'KIT-009', 'LOT-1009', '2025-03-28 20:21:47', 'Nikka', 'Active'),
(68, 'P22334', '626', '2025-04-04', 'KIT-010', 'LOT-1010', '2025-03-28 20:22:06', 'Nikka', 'Active'),
(69, 'P12345', '32', '2025-03-30', '432', '432', '2025-03-30 20:25:50', 'Nikka', 'Expired'),
(70, 'P54321', '21', '2025-03-31', '5324', '5324', '2025-03-30 20:26:07', 'Nikka', 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `id` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `unit`) VALUES
(1, 'kea'),
(2, 'srn'),
(3, 'spl'),
(4, 'kg'),
(5, 'ea'),
(6, 'rol'),
(7, 'pc'),
(8, 'm'),
(9, 'pkg'),
(10, 'bx'),
(11, 'rm'),
(12, 'bag'),
(13, 'pr'),
(14, 'set'),
(15, 'gal'),
(16, 'bt');

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
  `supervisor_two` varchar(255) NOT NULL,
  `forgot_pass` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `usertype`, `employee_name`, `badge_number`, `designation`, `account_type`, `cost_center`, `supervisor_one`, `supervisor_two`, `forgot_pass`) VALUES
(8, 'Nikka', 'nikka', 2, 'Marinel Nikka Zagala', '32523', 'Supervisor', 'Supervisor', 'MASMOB', 'Arthur Abitria Jr.', 'Marinel Zagala', 0),
(81, 'Maria', 'maria', 2, 'Maria Santos', '1001', 'Kitting', 'Kitting', 'MASMO1', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(82, 'Juan', 'Juan', 2, 'Juan Reyes', '1002', 'Operator', 'User', 'MASMOA', 'Cinderella Ricacho', 'Elaine Sanico', 0),
(83, 'Pedro', 'pedro', 2, 'Pedro Garcia', '1003', 'Supervisor', 'Supervisor', 'MASMOB', 'Arthur Abitria Jr.', 'Marinel Zagala', 0),
(84, 'Laura', 'laura', 2, 'Laura Cruz', '1004', 'Inspector', 'Kitting', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 0),
(85, 'Carlos', 'carlos', 2, 'Carlos Villanueva', '1005', 'Kitting', 'Kitting', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(86, 'Sofia', 'sofia', 2, 'Sofia Rivera', '1006', 'Operator', 'User', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 1),
(87, 'Eduardo', 'eduardo', 2, 'Eduardo Ortiz', '1007', 'Supervisor', 'Supervisor', 'MASMPE', 'Oliver Mabutas', '', 0),
(88, 'Roberto', 'roberto', 2, 'Roberto Diaz', '1008', 'Inspector', 'Kitting', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(89, 'Isabel', 'isabel', 2, 'Isabel Gomez', '1009', 'Kitting', 'Kitting', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 1),
(90, 'Karen', 'karen', 2, 'Karen Lopez', '384756', 'Kitting', 'Kitting', 'MASMOK', 'Cinderella Ricacho', 'Ellaine Sanico', 0),
(91, 'Luis', 'luis', 2, 'Luis Garcia', '938475', 'Operator', 'User', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(92, 'Monica', 'monica', 2, 'Monica Santiago', '192837', 'Supervisor', 'Supervisor', 'MASMOA', 'Cinderella Ricacho', 'Elaine Sanico', 0),
(93, 'Fernando', 'fernando', 2, 'Fernando Alvarez', '573829', 'Kitting', 'Kitting', 'MASMOK', 'Cinderella Ricacho', 'Ellaine Sanico', 0),
(94, 'Jessica', 'jessica', 3, 'Jessica Ramirez', '485729', 'Supervisor', 'Supervisor', 'MASMPE', 'Oliver Mabutas', '', 0),
(95, 'Daniel', 'daniel', 3, 'Daniel Morales', '928374', 'Operator', 'User', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(96, 'Patricia', 'patricia', 3, 'Patricia Cruz', '573829', 'Kitting', 'Kitting', 'MASMO1', 'Luisa Pelobello', '', 0),
(97, 'David', 'david', 3, 'David Bautista', '192837', 'Kitting', 'Kitting', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(98, 'Angela', 'angela', 1, 'Angela Ramos', '573829', 'Operator', 'User', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdrawal_reason`
--

CREATE TABLE `tbl_withdrawal_reason` (
  `id` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_withdrawal_reason`
--

INSERT INTO `tbl_withdrawal_reason` (`id`, `reason`) VALUES
(1, 'MC Setup'),
(2, 'Replacement'),
(3, 'General Use'),
(4, 'Change Cap'),
(5, 'Dummy Use'),
(6, 'Engineering Eval'),
(7, 'Use for Packaging'),
(8, 'Use for Cleaning');

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
-- Indexes for table `tbl_station_code`
--
ALTER TABLE `tbl_station_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_withdrawal_reason`
--
ALTER TABLE `tbl_withdrawal_reason`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_ccs`
--
ALTER TABLE `tbl_ccs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `tbl_machine`
--
ALTER TABLE `tbl_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=555;

--
-- AUTO_INCREMENT for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `tbl_station_code`
--
ALTER TABLE `tbl_station_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_withdrawal_reason`
--
ALTER TABLE `tbl_withdrawal_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
