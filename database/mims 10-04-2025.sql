-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 01:32 PM
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
(94, '2025-03-30 20:26:07', 'Plastic Washer, 10mm', 'P54321', 21, '2025-03-31', '5324', '5324', 'Nikka', 'Received'),
(95, '2025-04-01 19:58:26', 'test', 'test', 214, '2025-04-02', 'test', 'test', 'Nikka', 'Received'),
(96, '2025-04-04 22:28:05', 'dvs', 'dsv', 35, '2025-04-05', 'gt', 'egw', 'Nikka', 'Received'),
(97, '2025-04-04 23:18:26', 'Gasket, Rubber, 30mm', 'P11223', 3, '2025-04-09', 'tew', 'twe', 'Nikka', 'Received'),
(98, '2025-04-05 12:00:06', 'Lubricant, Industrial', 'P55667', 54, '2025-04-16', 'gf43', 'g43g', 'Nikka', 'Received'),
(99, '2025-04-05 12:16:47', 'Plastic Washer, 10mm', 'P54321', 2, '2025-04-12', '15', '2561', 'Nikka', 'Received'),
(100, '2025-04-08 15:32:44', 'dvs', 'dvs', 421, '2025-04-10', 'ewrwe', 'fewwe', 'Nikka', 'Received'),
(101, '2025-04-08 15:37:43', 'gdfgdf', 'dfgdf', 54, '2025-04-11', 'rgere', 'reger', 'Nikka', 'Received'),
(102, '', 'Air Filter, HEPA', 'P99876', 200, '', 'fes', 'fesf', 'Laura', 'Received'),
(103, '', 'Air Filter, HEPA', 'P99876', 200, '', 'fes', 'fesf', 'Laura', 'Received'),
(104, '2025-04-08 17:31:27', 'Air Filter, HEPA', 'P99876', 43, '', 'fes', 'fsefse', 'Laura', 'Received'),
(105, '2025-04-08 17:32:37', 'Steel Plate, 2mm', 'P98765', 43, '2025-04-09', 'fe', 'ewfw', 'Laura', 'Received'),
(106, '2025-04-08 17:33:19', 'Copper Wire, 50m', 'P67890', 13, '2025-04-17', 'sdg', 'dsgs', 'Laura', 'Received'),
(107, '2025-04-08 17:34:35', 'Hydraulic Pump, 5000psi', 'P22334', 300, '2025-04-11', 'sav', 'savasv', 'Laura', 'Received'),
(108, '2025-04-08 17:34:35', 'LED Light Bulb, 10W', 'P33445', 300, '2025-04-25', 'asvsav', 'savv', 'Laura', 'Received'),
(109, '2025-04-08 17:36:04', 'Hydraulic Pump, 5000psi', 'P22334', 200, '2025-04-18', 'fasf', 'safas', 'Laura', 'Received'),
(110, '2025-04-08 17:36:04', 'Steel Plate, 2mm', 'P98765', 12, '2025-04-02', 'sfaf', 'fsafas', 'Laura', 'Received'),
(111, '2025-04-08 17:36:32', 'Hydraulic Pump, 5000psi', 'P22334', 200, '2025-04-18', 'fasf', 'safas', 'Laura', 'Received'),
(112, '2025-04-08 17:36:32', 'Steel Plate, 2mm', 'P98765', 12, '2025-04-02', 'sfaf', 'fsafas', 'Laura', 'Received'),
(113, '2025-04-08 17:38:41', 'Electrical Tape, Black', 'P45678', 200, '2025-04-10', 'saf', 'fsa', 'Laura', 'Received'),
(114, '2025-04-08 17:38:41', 'Air Filter, HEPA', 'P99876', 355, '2025-04-07', 'gesg', 'gesges', 'Laura', 'Received'),
(115, '2025-04-08 17:38:41', 'Copper Wire, 50m', 'P67890', 3, '2025-04-11', 'ewf', 'ewf', 'Laura', 'Received'),
(116, '2025-04-08 17:39:47', 'Bolt, 5mm', 'P12345', 325, '2025-04-01', 'erg', 'rg', 'Laura', 'Received'),
(117, '2025-04-08 17:39:47', 'Copper Wire, 50m', 'P67890', 532, '2025-03-30', 'reg', 'gre', 'Laura', 'Received'),
(118, '2025-04-08 17:50:29', 'few', 'efw', 4000, '2025-04-10', 'fsd', 'fds', 'Laura', 'Received'),
(119, '2025-04-09 10:57:28', 'test', 'test', 432, '2025-04-10', 'test', 'test', 'Nikka', 'Received'),
(120, '2025-04-09 16:08:34', 'sdb', 'dbsb', 0, '', '', '', 'Nikka', 'Received'),
(121, '2025-04-09 16:08:53', 'sdb', 'dbsb', 543, '2025-04-10', 't43t', 't43', 'Nikka', 'Received'),
(122, '2025-04-09 16:08:53', 'sdb', 'dbsb', 0, '', '', '', 'Nikka', 'Received'),
(123, '2025-04-09 19:14:28', '', '', 0, '', '', '', 'Nikka', 'Received'),
(124, '2025-04-09 19:15:58', '', '', 0, '', '', '', 'Nikka', 'Received'),
(125, '2025-04-09 19:35:52', 'sdb', 'dbsb', 43, '', 'test', 'test', 'Nikka', 'Received'),
(126, '2025-04-09 19:36:59', '', '', 0, '', '', '', 'Nikka', 'Received'),
(127, '2025-04-09 19:40:22', 'sdb', 'dbsb', 43, 'NA', 'tets', 'test', 'Nikka', 'Received'),
(128, '2025-04-09 19:40:46', 'sdb', 'dbsb', 54, '2025-04-10', 'trdt', 'trdt', 'Nikka', 'Received'),
(129, '2025-04-09 19:49:19', 'sdb', 'dbsb', 123, '2025-04-11', 'test', 'test', 'Nikka', 'Received'),
(130, '2025-04-09 19:49:55', 'sdb', 'dbsb', 233, 'NA', 'resr', 'serse', 'Nikka', 'Received'),
(131, '2025-04-09 20:07:49', '', '', 0, '', '', '', 'Nikka', 'Received'),
(132, '2025-04-09 20:08:20', '', '', 0, '', '', '', 'Nikka', 'Received'),
(133, '2025-04-09 20:09:58', '', '', 0, '', '', '', 'Nikka', 'Received'),
(134, '2025-04-09 20:10:01', '', '', 0, '', '', '', 'Nikka', 'Received'),
(135, '2025-04-09 20:33:03', '', '', 0, '', '', '', 'Nikka', 'Received'),
(136, '2025-04-10 11:23:01', '', '', 0, '', '', '', 'Nikka', 'Received'),
(137, '2025-04-10 11:27:57', 'sdb', 'dbsb', 5, 'NA', 'test', 'test', 'Nikka', 'Received'),
(138, '2025-04-10 11:28:43', 'sdb', 'dbsb', 45, '2025-04-24', 'test', 'test', 'Nikka', 'Received'),
(139, '2025-04-10 14:24:17', 'test 4', 'test 2', 50, 'NA', 'test', 'test', 'Nikka', 'Received');

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
  `part_category` varchar(255) NOT NULL,
  `approver` varchar(255) NOT NULL,
  `part_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `part_name`, `part_desc`, `cost_center`, `location`, `min_invent_req`, `unit`, `part_option`, `part_category`, `approver`, `part_qty`) VALUES
(113, 'test 1', 'test 3', 'MASMOB', 'test5', '11', 'gal', 'Direct', 'Critical', 'Kitting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `dts` varchar(255) NOT NULL,
  `reasons` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`id`, `username`, `action`, `description`, `dts`, `reasons`) VALUES
(149, 'Nikka', 'Material Registration', 'Nikka has registered a new material P12345', '2025-03-28 18:57:06', ''),
(150, 'Nikka', 'Material Registration', 'Nikka has registered a new material P67890', '2025-03-28 19:00:45', ''),
(151, 'Nikka', 'Material Registration', 'Nikka has registered a new material P54321', '2025-03-28 19:01:15', ''),
(152, 'Nikka', 'Material Registration', 'Nikka has registered a new material P98765', '2025-03-28 19:01:53', ''),
(153, 'Nikka', 'Material Registration', 'Nikka has registered a new material P45678', '2025-03-28 19:02:27', ''),
(154, 'Nikka', 'Material Registration', 'Nikka has registered a new material P11223', '2025-03-28 19:02:56', ''),
(155, 'Nikka', 'Material Registration', 'Nikka has registered a new material P99876', '2025-03-28 19:03:30', ''),
(156, 'Nikka', 'Material Registration', 'Nikka has registered a new material P33445', '2025-03-28 19:03:55', ''),
(157, 'Nikka', 'Material Registration', 'Nikka has registered a new material P55667', '2025-03-28 19:04:21', ''),
(158, 'Nikka', 'Material Registration', 'Nikka has registered a new material P22334', '2025-03-28 19:04:46', ''),
(165, 'Nikka', 'Account Registration', 'Nikka has created an account for Juan Reyes', '2025-03-28 19:22:03', ''),
(166, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of Juan Reyes', '2025-03-28 19:22:14', ''),
(167, 'Nikka', 'Account Registration', 'Nikka has created an account for Maria Santos', '2025-03-28 19:24:48', ''),
(168, 'Nikka', 'Account Registration', 'Nikka has created an account for Juan Reyes', '2025-03-28 19:25:17', ''),
(169, 'Nikka', 'Account Registration', 'Nikka has created an account for Pedro Garcia', '2025-03-28 19:26:41', ''),
(170, 'Nikka', 'Account Registration', 'Nikka has created an account for Laura Cruz', '2025-03-28 19:31:41', ''),
(171, 'Nikka', 'Account Registration', 'Nikka has created an account for Carlos Villanueva', '2025-03-28 19:32:10', ''),
(172, 'Nikka', 'Account Registration', 'Nikka has created an account for Sofia Rivera', '2025-03-28 19:32:35', ''),
(173, 'Nikka', 'Account Registration', 'Nikka has created an account for Eduardo Ortiz', '2025-03-28 19:33:02', ''),
(174, 'Nikka', 'Account Registration', 'Nikka has created an account for Roberto Diaz', '2025-03-28 19:33:30', ''),
(175, 'Nikka', 'Account Registration', 'Nikka has created an account for Isabel Gomez', '2025-03-28 19:33:57', ''),
(176, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:50:31', ''),
(177, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:53:12', ''),
(178, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:56:08', ''),
(179, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:56:31', ''),
(180, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:56:42', ''),
(181, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:58:33', ''),
(182, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 800 items.', '2025-03-28 19:59:30', ''),
(183, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P67890 with an addition of 500 items.', '2025-03-28 20:18:48', ''),
(184, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P54321 with an addition of 1200 items.', '2025-03-28 20:19:23', ''),
(185, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P98765 with an addition of 1400 items.', '2025-03-28 20:19:48', ''),
(186, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P45678 with an addition of 750 items.', '2025-03-28 20:20:16', ''),
(187, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P11223 with an addition of 980 items.', '2025-03-28 20:20:41', ''),
(188, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P99876 with an addition of 890 items.', '2025-03-28 20:21:01', ''),
(189, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P33445 with an addition of 560 items.', '2025-03-28 20:21:23', ''),
(190, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P55667 with an addition of 930 items.', '2025-03-28 20:21:47', ''),
(191, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P22334 with an addition of 639 items.', '2025-03-28 20:22:06', ''),
(192, 'Nikka', 'Material Registration', 'Nikka has registered a new material P22734', '2025-03-28 20:23:14', ''),
(193, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material P12734', '2025-03-28 20:23:22', ''),
(194, 'Nikka', 'Material Deletion', 'Nikka has deleted P12734', '2025-03-28 20:23:46', ''),
(200, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Karen Lopez.', '2025-03-30 19:51:00', ''),
(201, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Luis Garcia.', '2025-03-30 19:51:15', ''),
(202, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Monica Santiago.', '2025-03-30 19:51:15', ''),
(203, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Fernando Alvarez.', '2025-03-30 19:51:15', ''),
(204, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of Jessica Ramirez.', '2025-03-30 19:51:27', ''),
(205, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of Daniel Morales.', '2025-03-30 19:51:49', ''),
(206, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of Patricia Cruz.', '2025-03-30 19:51:49', ''),
(207, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of David Bautista.', '2025-03-30 19:51:49', ''),
(208, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P12345 with an addition of 32 items.', '2025-03-30 20:25:50', ''),
(209, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P54321 with an addition of 21 items.', '2025-03-30 20:26:07', ''),
(210, 'Nikka', 'Password changed', 'Nikka has updated the password for Pedro account.', '2025-03-31 19:27:40', ''),
(211, 'Nikka', 'Account Registration', 'Nikka has created an account for test', '2025-03-31 19:29:05', ''),
(212, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of teste', '2025-03-31 19:29:35', ''),
(213, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of teste', '2025-03-31 19:30:10', ''),
(214, 'Nikka', 'Cost Center Registration', 'Nikka has successfully registered a new test in the system.', '2025-03-31 13:31:00', ''),
(215, 'Nikka', 'Cost Center Modification', 'Nikka has successfully updated the details of the test in the system.', '2025-03-31 13:31:26', ''),
(216, 'Nikka', 'Cost Center Deletion', 'Nikka has successfully deleted the test from the system.', '2025-03-31 13:32:03', ''),
(217, 'Nikka', 'Machine Number Registration', 'Nikka has successfully registered a new TEST in the system.', '2025-04-01 05:13:14', ''),
(218, 'Nikka', 'Machine Number Modification', 'Nikka has successfully updated the details of the TEST TEST in the system.', '2025-04-01 05:13:37', ''),
(219, 'Nikka', 'Machine Number Deletion', 'Nikka has successfully deleted the TEST TEST from the system.', '2025-04-01 05:13:47', ''),
(220, 'Nikka', 'Station Code Registration', 'Nikka has successfully registered a new TEST in the system.', '2025-04-01 05:13:55', ''),
(221, 'Nikka', 'Station Code Modification', 'Nikka has successfully updated the details of the TEST TEST in the system.', '2025-04-01 05:14:04', ''),
(222, 'Nikka', 'Station Code Deletion', 'Nikka has successfully deleted the TEST TEST from the system.', '2025-04-01 05:14:12', ''),
(223, 'Nikka', 'Withdrawal Reason Registration', 'Nikka has successfully registered a new TEST in the system.', '2025-04-01 05:14:25', ''),
(224, 'Nikka', 'Withdrawal Reason Modification', 'Nikka has successfully updated the details of the TEST test in the system.', '2025-04-01 05:14:36', ''),
(225, 'Nikka', 'Withdrawal Reason Deletion', 'Nikka has successfully deleted the TEST test from the system.', '2025-04-01 05:14:53', ''),
(226, 'Nikka', 'Unit of Measure Registration', 'Nikka has successfully registered a new test in the system.', '2025-04-01 05:16:46', ''),
(227, 'Nikka', 'Unit of Measure Modification', 'Nikka has successfully updated the details of the test test in the system.', '2025-04-01 05:16:59', ''),
(228, 'Nikka', 'Unit of Measure Deletion', 'Nikka has successfully deleted the test test from the system.', '2025-04-01 05:17:26', ''),
(229, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of test.', '2025-04-01 12:10:50', ''),
(230, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of test.', '2025-04-01 19:34:38', ''),
(231, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of test.', '2025-04-01 19:35:01', ''),
(232, 'Nikka', 'Password changed', 'Nikka has updated the password for test account.', '2025-04-01 19:35:26', ''),
(233, 'Nikka', 'Material Registration', 'Nikka has registered a new material test', '2025-04-01 19:58:08', ''),
(234, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for test with an addition of 214 items.', '2025-04-01 19:58:26', ''),
(235, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material test', '2025-04-01 19:58:35', ''),
(236, 'Nikka', 'Machine Number Registration', 'Nikka has successfully registered a new TEST in the system.', '2025-04-01 14:00:06', ''),
(237, 'Nikka', 'Station Code Registration', 'Nikka has successfully registered a new TEST1 in the system.', '2025-04-01 14:00:12', ''),
(238, 'Nikka', 'Withdrawal Reason Registration', 'Nikka has successfully registered a new TEST2 in the system.', '2025-04-01 14:00:18', ''),
(239, 'Nikka', 'Unit of Measure Registration', 'Nikka has successfully registered a new test3 in the system.', '2025-04-01 14:00:25', ''),
(240, 'Nikka', 'Material Deletion', 'Nikka has deleted sdf', '2025-04-04 20:19:30', ''),
(241, 'Nikka', 'Material Deletion', 'Nikka has deleted test', '2025-04-04 20:19:33', ''),
(242, 'Nikka', 'Material Deletion', 'Nikka has deleted test', '2025-04-04 20:19:36', ''),
(243, 'Nikka', 'Material Deletion', 'Nikka has deleted test2', '2025-04-04 20:19:39', ''),
(244, 'Nikka', 'Material Deletion', 'Nikka has deleted test', '2025-04-04 20:19:42', ''),
(245, 'Nikka', 'Material Deletion', 'Nikka has deleted test3', '2025-04-04 20:19:46', ''),
(246, 'Nikka', 'Material Deletion', 'Nikka has deleted test3', '2025-04-04 20:19:51', ''),
(247, 'Nikka', 'Material Deletion', 'Nikka has deleted test4', '2025-04-04 20:19:53', ''),
(248, 'Nikka', 'Material Deletion', 'Nikka has deleted zxczx', '2025-04-04 20:19:56', ''),
(249, 'Nikka', 'Material Deletion', 'Nikka has deleted test4', '2025-04-04 20:20:01', ''),
(250, 'Nikka', 'Material Deletion', 'Nikka has deleted test3', '2025-04-04 20:20:04', ''),
(251, 'Nikka', 'Material Deletion', 'Nikka has deleted test2', '2025-04-04 20:20:07', ''),
(252, 'Nikka', 'Material Deletion', 'Nikka has deleted test3', '2025-04-04 20:20:10', ''),
(253, 'Nikka', 'Material Deletion', 'Nikka has deleted test2', '2025-04-04 20:20:13', ''),
(254, 'Nikka', 'Material Deletion', 'Nikka has deleted test4', '2025-04-04 20:20:15', ''),
(255, 'Nikka', 'Material Deletion', 'Nikka has deleted test2', '2025-04-04 20:20:45', ''),
(256, 'Nikka', 'Material Deletion', 'Nikka has deleted test4', '2025-04-04 20:20:47', ''),
(257, 'Nikka', 'Material Deletion', 'Nikka has deleted fas', '2025-04-04 20:21:11', ''),
(258, 'Nikka', 'Material Deletion', 'Nikka has deleted test2', '2025-04-04 20:59:19', ''),
(259, 'Nikka', 'Material Deletion', 'Nikka has deleted test3', '2025-04-04 20:59:22', ''),
(260, 'Nikka', 'Material Deletion', 'Nikka has deleted test4', '2025-04-04 20:59:24', ''),
(261, 'Nikka', 'Material Deletion', 'Nikka has deleted test2', '2025-04-04 22:24:16', ''),
(262, 'Nikka', 'Material Deletion', 'Nikka has deleted test3', '2025-04-04 22:24:18', ''),
(263, 'Nikka', 'Material Deletion', 'Nikka has deleted test4', '2025-04-04 22:24:21', ''),
(264, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for dsv with an addition of 35 items.', '2025-04-04 22:28:05', ''),
(265, 'Nikka', 'Password changed', 'Nikka has updated the password for Sofia account.', '2025-04-04 23:18:03', ''),
(266, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P11223 with an addition of 3 items.', '2025-04-04 23:18:26', ''),
(267, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P55667 with an addition of 54 items.', '2025-04-05 12:00:06', ''),
(268, 'Nikka', 'Update Inventory', 'Nikka has updated the inventory for P54321 with an addition of 2 items.', '2025-04-05 12:16:47', ''),
(269, 'Nikka', 'Password changed', 'Nikka has updated the password for Isabel account.', '2025-04-05 12:38:17', ''),
(270, 'Nikka', 'Material Deletion', 'Nikka has deleted test', '2025-04-05 22:24:32', ''),
(271, 'Nikka', 'Material Deletion', 'Nikka has deleted test4', '2025-04-08 15:05:52', ''),
(272, 'Nikka', 'Material Deletion', 'Nikka has deleted test3f', '2025-04-08 15:05:55', ''),
(273, 'Nikka', 'Material Deletion', 'Nikka has deleted test3', '2025-04-08 15:05:58', ''),
(274, 'Nikka', 'Material Deletion', 'Nikka has deleted test22', '2025-04-08 15:06:01', ''),
(275, 'Nikka', 'Material Deletion', 'Nikka has deleted test2', '2025-04-08 15:06:04', ''),
(276, 'Nikka', 'Material Deletion', 'Nikka has deleted test', '2025-04-08 15:06:07', ''),
(277, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material testtest', '2025-04-10 13:58:44', ''),
(278, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material test 1', '2025-04-10 14:00:36', ''),
(279, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material test 2', '2025-04-10 14:00:36', ''),
(280, 'Nikka', 'Material Deletion', 'Nikka has deleted test 2', '2025-04-10 14:24:47', 'delete ko lang'),
(281, 'Nikka', 'Material Deletion', 'Nikka has deleted test 2', '2025-04-10 14:25:40', ''),
(282, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:34:29', ''),
(283, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:36:54', ''),
(284, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:22', ''),
(285, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:23', ''),
(286, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:24', ''),
(287, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:24', ''),
(288, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:24', ''),
(289, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:25', ''),
(290, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:25', ''),
(291, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:25', ''),
(292, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:26', ''),
(293, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:26', ''),
(294, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:26', ''),
(295, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:40:26', ''),
(296, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:43:26', ''),
(297, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:45:15', ''),
(298, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:50:31', ''),
(299, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:53:36', ''),
(300, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of David Bautista.', '2025-04-10 17:55:43', ''),
(301, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Angela Ramos.', '2025-04-10 17:59:01', ''),
(302, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of test.', '2025-04-10 18:12:51', 'Test lang din');

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
(87, 'MP3A_XR001'),
(97, 'TEST');

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
(554, 'Juan', 'Eduardo has successfully received 1 of P11223. Click here for more details.', 1, '2025-03-31 14:45:32', 'Juan', 'Returned'),
(555, 'System', 'test account registration is awaiting approval.', 1, '2025-04-01 04:10:43', 'adminOnly', 'Account Registration Pending Approval'),
(556, 'System', 'test account registration is awaiting approval.', 1, '2025-04-01 11:34:29', 'adminOnly', 'Account Registration Pending Approval'),
(557, 'System', 'test account registration is awaiting approval.', 1, '2025-04-01 11:34:54', 'adminOnly', 'Account Registration Pending Approval'),
(558, 'test', 'test has requested a password change.', 1, '2025-04-01 11:35:15', 'adminOnly', 'Request password change'),
(559, 'test', 'test has requested 3 of P54321. Click here for more details.', 1, '2025-04-01 11:35:47', 'admin', 'Approval'),
(560, 'test', 'test has requested 1 of P98765. Click here for more details.', 1, '2025-04-01 11:35:56', 'admin', 'Approval'),
(561, 'test', 'test has requested 1 of P22334. Click here for more details.', 1, '2025-04-01 11:36:06', 'admin', 'Approval'),
(562, 'Nikka', 'Nikka has approved 1 of P22334. Click here for more details.', 1, '2025-04-01 11:36:21', 'test', 'Approved'),
(563, 'Nikka', 'Nikka has approved 1 of P98765. Click here for more details.', 1, '2025-04-01 11:36:21', 'test', 'Approved'),
(564, 'Nikka', 'Nikka has rejected 3 of P54321. Click here for more details.', 1, '2025-04-01 11:36:31', 'test', 'Rejected'),
(565, 'test', 'test is returning 1 of P98765. Click here for more details.', 1, '2025-04-01 11:57:35', 'admin', 'Scrap'),
(566, 'test', 'Nikka has successfully received 1 of P98765. Click here for more details.', 1, '2025-04-01 11:57:44', 'test', 'Returned'),
(567, 'test', 'test has requested 32 of P98765. Click here for more details.', 1, '2025-04-01 12:00:46', 'admin', 'Approval'),
(568, 'test', 'test has requested 200 of test. Click here for more details.', 1, '2025-04-01 12:42:50', 'admin', 'Approval'),
(569, 'System', 'test has reached the minimum inventory level and needs restocking.', 1, '2025-04-01 12:42:50', 'admin', 'Inventory'),
(570, 'System', 'P45678 has expired. Total expired quantity: 739', 1, '2025-04-03 05:44:52', 'admin', 'Expired'),
(571, 'Nikka', 'Nikka has approved 200 of test. Click here for more details.', 0, '2025-04-03 07:08:25', 'test', 'Approved'),
(572, 'Nikka', 'Nikka has approved 32 of P98765. Click here for more details.', 0, '2025-04-03 07:08:25', 'test', 'Approved'),
(573, 'Nikka', 'Nikka has approved 6 of P98765. Click here for more details.', 0, '2025-04-03 07:08:25', 'Eduardo', 'Approved'),
(574, 'Nikka', 'Nikka has approved 2 of P99876. Click here for more details.', 0, '2025-04-03 07:08:25', 'Eduardo', 'Approved'),
(575, 'Nikka', 'Nikka has approved 2 of P12345. Click here for more details.', 0, '2025-04-03 07:08:25', 'Eduardo', 'Approved'),
(576, 'Nikka', 'Nikka has approved 5 of P33445. Click here for more details.', 0, '2025-04-03 07:08:25', 'Maria', 'Approved'),
(577, 'Nikka', 'Nikka has approved 5 of P55667. Click here for more details.', 0, '2025-04-03 07:08:25', 'Maria', 'Approved'),
(578, 'Nikka', 'Nikka has approved 5 of P22334. Click here for more details.', 0, '2025-04-03 07:08:25', 'Maria', 'Approved'),
(579, 'Nikka', 'Nikka has approved 3 of P54321. Click here for more details.', 0, '2025-04-03 07:08:25', 'Maria', 'Approved'),
(580, 'Nikka', 'Nikka has approved 2 of P11223. Click here for more details.', 0, '2025-04-03 07:08:25', 'Maria', 'Approved'),
(581, 'Nikka', 'Nikka has approved 5 of P67890. Click here for more details.', 0, '2025-04-03 07:08:25', 'Maria', 'Approved'),
(582, 'Nikka', 'Nikka has approved 5 of P55667. Click here for more details.', 0, '2025-04-03 07:08:25', 'Juan', 'Approved'),
(583, 'Nikka', 'Nikka has approved 2 of P54321. Click here for more details.', 0, '2025-04-03 07:08:25', 'Juan', 'Approved'),
(584, 'Nikka', 'Nikka has approved 2 of P67890. Click here for more details.', 0, '2025-04-03 07:08:25', 'Juan', 'Approved'),
(585, 'Nikka', 'Nikka has approved 2 of P12345. Click here for more details.', 0, '2025-04-03 07:08:25', 'Juan', 'Approved'),
(586, 'Nikka', 'Nikka has approved 2 of P45678. Click here for more details.', 0, '2025-04-03 07:08:25', 'Isabel', 'Approved'),
(587, 'Nikka', 'Nikka has approved 5 of P55667. Click here for more details.', 0, '2025-04-03 07:08:25', 'Isabel', 'Approved'),
(588, 'Nikka', 'Nikka has approved 2 of P33445. Click here for more details.', 0, '2025-04-03 07:08:25', 'Isabel', 'Approved'),
(589, 'Nikka', 'Nikka has approved 2 of P33445. Click here for more details.', 1, '2025-04-03 07:08:25', 'Laura', 'Approved'),
(590, 'Nikka', 'Nikka has approved 2 of P54321. Click here for more details.', 1, '2025-04-03 07:08:25', 'Laura', 'Approved'),
(591, 'Nikka', 'Nikka has approved 2 of P33445. Click here for more details.', 1, '2025-04-03 07:08:25', 'Laura', 'Approved'),
(592, 'Nikka', 'Nikka has approved 3 of P55667. Click here for more details.', 1, '2025-04-03 07:08:25', 'Laura', 'Approved'),
(593, 'Nikka', 'Nikka has approved 5 of P12345. Click here for more details.', 1, '2025-04-03 07:08:25', 'Laura', 'Approved'),
(594, 'Nikka', 'Nikka has approved 2 of P67890. Click here for more details.', 1, '2025-04-03 07:08:25', 'Laura', 'Approved'),
(595, 'Nikka', 'Nikka has approved 3 of P55667. Click here for more details.', 0, '2025-04-03 07:08:25', 'Sofia', 'Approved'),
(596, 'Nikka', 'Nikka has approved 9 of P33445. Click here for more details.', 0, '2025-04-03 07:08:25', 'Sofia', 'Approved'),
(597, 'Nikka', 'Nikka has approved 6 of P54321. Click here for more details.', 0, '2025-04-03 07:08:25', 'Sofia', 'Approved'),
(598, 'Nikka', 'Nikka has approved 2 of P54321. Click here for more details.', 0, '2025-04-03 07:08:25', 'Sofia', 'Approved'),
(599, 'Nikka', 'Nikka has approved 2 of P12345. Click here for more details.', 0, '2025-04-03 07:08:25', 'Sofia', 'Approved'),
(600, 'Nikka', 'Nikka has approved 8 of P98765. Click here for more details.', 0, '2025-04-03 07:08:25', 'Carlos', 'Approved'),
(601, 'Nikka', 'Nikka has approved 5 of P12345. Click here for more details.', 0, '2025-04-03 07:08:25', 'Carlos', 'Approved'),
(602, 'Nikka', 'Nikka has approved 2 of P55667. Click here for more details.', 0, '2025-04-03 07:08:25', 'Carlos', 'Approved'),
(603, 'Nikka', 'Nikka has approved 5 of P99876. Click here for more details.', 0, '2025-04-03 07:08:25', 'Carlos', 'Approved'),
(604, 'Nikka', 'Nikka has approved 4 of P54321. Click here for more details.', 0, '2025-04-03 07:08:25', 'Carlos', 'Approved'),
(605, 'Nikka', 'Nikka has approved 2 of P12345. Click here for more details.', 0, '2025-04-03 07:08:25', 'Carlos', 'Approved'),
(606, 'Nikka', 'Nikka has approved 1 of P22334. Click here for more details.', 0, '2025-04-03 07:08:25', 'Roberto', 'Approved'),
(607, 'Nikka', 'Nikka has approved 2 of P33445. Click here for more details.', 0, '2025-04-03 07:08:25', 'Roberto', 'Approved'),
(608, 'Nikka', 'Nikka has approved 2 of P67890. Click here for more details.', 0, '2025-04-03 07:08:25', 'Roberto', 'Approved'),
(609, 'Nikka', 'Nikka has approved 2 of P12345. Click here for more details.', 0, '2025-04-03 07:08:25', 'Roberto', 'Approved'),
(610, 'Nikka', 'Nikka has approved 200 of test. Click here for more details.', 0, '2025-04-03 07:09:12', 'test', 'Approved'),
(611, 'Nikka', 'Nikka has approved 32 of P98765. Click here for more details.', 0, '2025-04-03 07:09:12', 'test', 'Approved'),
(612, 'Nikka', 'Nikka has approved 1 of P22334. Click here for more details.', 0, '2025-04-03 07:09:12', 'test', 'Approved'),
(613, 'Nikka', 'Nikka has approved 1 of P98765. Click here for more details.', 0, '2025-04-03 07:09:12', 'test', 'Approved'),
(614, 'Nikka', 'Nikka has approved 3 of P54321. Click here for more details.', 0, '2025-04-03 07:09:12', 'test', 'Approved'),
(615, 'Nikka', 'Nikka has approved 5 of P99876. Click here for more details.', 0, '2025-04-03 07:09:12', 'Eduardo', 'Approved'),
(616, 'Nikka', 'Nikka has approved 3 of P33445. Click here for more details.', 0, '2025-04-03 07:09:12', 'Eduardo', 'Approved'),
(617, 'Nikka', 'Nikka has requested 1 of P67890. Click here for more details.', 1, '2025-04-03 08:32:34', 'admin', 'Approval'),
(618, 'Nikka', 'Nikka has requested 1 of P67890. Click here for more details.', 1, '2025-04-03 08:32:52', 'admin', 'Approval'),
(619, 'Nikka', 'Nikka has requested 1 of P67890. Click here for more details.', 1, '2025-04-03 08:47:20', 'admin', 'Approval'),
(620, 'Nikka', ' has approved 1 of P67890. Click here for more details.', 1, '2025-04-03 08:47:30', 'Nikka', 'Approved'),
(621, 'Nikka', ' has approved 1 of P67890. Click here for more details.', 1, '2025-04-03 08:47:43', 'Nikka', 'Approved'),
(622, 'Nikka', 'Nikka has approved 1 of P67890. Click here for more details.', 1, '2025-04-03 08:48:13', 'Nikka', 'Approved'),
(623, 'Nikka', 'Nikka has requested 200 of P67890. Click here for more details.', 1, '2025-04-03 09:02:04', 'admin', 'Approval'),
(624, 'Nikka', 'Nikka has rejected 200 of P67890. Click here for more details.', 0, '2025-04-03 09:02:26', '', 'Rejected'),
(625, 'Nikka', 'Nikka has rejected 200 of P67890. Click here for more details.', 0, '2025-04-03 09:05:43', '', 'Rejected'),
(626, 'Nikka', 'Nikka has rejected 200 of P67890. Click here for more details.', 1, '2025-04-03 09:06:58', 'Nikka', 'Rejected'),
(627, 'Nikka', 'Nikka has requested 1 of P67890. Click here for more details.', 1, '2025-04-03 09:46:44', 'admin', 'Approval'),
(628, 'Nikka', 'Nikka has approved 1 of P67890. Click here for more details.', 1, '2025-04-03 09:46:52', 'Nikka', 'Approved'),
(629, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:47:07', 'admin', 'Scrap'),
(630, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:29', 'admin', 'Scrap'),
(631, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:29', 'admin', 'Scrap'),
(632, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:29', 'admin', 'Scrap'),
(633, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:30', 'admin', 'Scrap'),
(634, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:30', 'admin', 'Scrap'),
(635, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:30', 'admin', 'Scrap'),
(636, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:30', 'admin', 'Scrap'),
(637, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:31', 'admin', 'Scrap'),
(638, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:31', 'admin', 'Scrap'),
(639, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:31', 'admin', 'Scrap'),
(640, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:31', 'admin', 'Scrap'),
(641, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:32', 'admin', 'Scrap'),
(642, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:32', 'admin', 'Scrap'),
(643, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:32', 'admin', 'Scrap'),
(644, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:32', 'admin', 'Scrap'),
(645, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:32', 'admin', 'Scrap'),
(646, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:33', 'admin', 'Scrap'),
(647, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:33', 'admin', 'Scrap'),
(648, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:33', 'admin', 'Scrap'),
(649, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:33', 'admin', 'Scrap'),
(650, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:34', 'admin', 'Scrap'),
(651, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:34', 'admin', 'Scrap'),
(652, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:34', 'admin', 'Scrap'),
(653, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:35', 'admin', 'Scrap'),
(654, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:35', 'admin', 'Scrap'),
(655, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:35', 'admin', 'Scrap'),
(656, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:50', 'admin', 'Scrap'),
(657, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:50', 'admin', 'Scrap'),
(658, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:50', 'admin', 'Scrap'),
(659, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:50', 'admin', 'Scrap'),
(660, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:51', 'admin', 'Scrap'),
(661, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:51', 'admin', 'Scrap'),
(662, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:51', 'admin', 'Scrap'),
(663, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:51', 'admin', 'Scrap'),
(664, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:52', 'admin', 'Scrap'),
(665, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:52', 'admin', 'Scrap'),
(666, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:52', 'admin', 'Scrap'),
(667, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:52', 'admin', 'Scrap'),
(668, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:52', 'admin', 'Scrap'),
(669, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:53', 'admin', 'Scrap'),
(670, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:53', 'admin', 'Scrap'),
(671, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:53', 'admin', 'Scrap'),
(672, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:53', 'admin', 'Scrap'),
(673, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:54', 'admin', 'Scrap'),
(674, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:54', 'admin', 'Scrap'),
(675, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:54', 'admin', 'Scrap'),
(676, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:54', 'admin', 'Scrap'),
(677, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:55', 'admin', 'Scrap'),
(678, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:55', 'admin', 'Scrap'),
(679, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:55', 'admin', 'Scrap'),
(680, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:49:55', 'admin', 'Scrap'),
(681, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:50:46', 'admin', 'Scrap'),
(682, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:53:02', 'admin', 'Scrap'),
(683, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:56:43', 'admin', 'Scrap'),
(684, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:57:49', 'admin', 'Scrap'),
(685, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:58:03', 'admin', 'Scrap'),
(686, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:59:03', 'admin', 'Scrap'),
(687, 'Nikka', 'Nikka is returning 1 of P67890. Click here for more details.', 1, '2025-04-03 09:59:33', 'admin', 'Scrap'),
(688, 'Nikka', 'Nikka has successfully received 1 of P67890. Click here for more details.', 1, '2025-04-03 09:59:51', 'Nikka', 'Returned'),
(689, 'Nikka', 'Nikka has requested 23 of P98765. Click here for more details.', 1, '2025-04-03 10:00:11', 'admin', 'Approval'),
(690, 'Nikka', 'Nikka has approved 10 of P98765. Click here for more details.', 1, '2025-04-03 10:00:24', 'Nikka', 'Approved'),
(691, 'Nikka', 'Nikka is returning 9 of P98765. Click here for more details.', 1, '2025-04-03 10:02:24', 'admin', 'Scrap'),
(692, 'Luis', 'Luis has requested 2 of P98765. Click here for more details.', 1, '2025-04-03 10:04:14', 'admin', 'Approval'),
(693, 'Nikka', 'Nikka has approved 2 of P98765. Click here for more details.', 1, '2025-04-03 10:04:23', 'Luis', 'Approved'),
(694, 'Luis', 'Luis is returning 1 of P98765. Click here for more details.', 1, '2025-04-03 10:05:39', 'admin', 'Scrap'),
(695, 'Luis', 'Nikka has successfully received 1 of P98765. Click here for more details.', 1, '2025-04-03 10:06:39', 'Luis', 'Returned'),
(696, 'Luis', 'Luis has requested 23 of P98765. Click here for more details.', 1, '2025-04-03 10:07:30', 'admin', 'Approval'),
(697, 'Nikka', 'Nikka has approved 2 of P98765. Click here for more details.', 1, '2025-04-03 10:07:41', 'Luis', 'Approved'),
(698, 'Luis', 'Luis has requested 2 of P98765. Click here for more details.', 1, '2025-04-03 10:09:21', 'admin', 'Approval'),
(699, 'Nikka', 'Nikka has rejected 2 of P98765. Click here for more details.', 1, '2025-04-03 10:09:34', 'Luis', 'Rejected'),
(700, 'System', 'P22334 has expired. Total expired quantity: 625', 1, '2025-04-03 23:12:18', 'admin', 'Expired'),
(701, 'System', 'P33445 has expired. Total expired quantity: 525', 1, '2025-04-03 23:12:18', 'admin', 'Expired'),
(702, 'Nikka', 'Nikka has requested 5 of P67890. Click here for more details.', 1, '2025-04-03 23:16:22', 'admin', 'Approval'),
(703, 'Nikka', 'Nikka has requested 35 of P67890. Click here for more details.', 1, '2025-04-03 23:16:46', 'admin', 'Approval'),
(704, 'Nikka', 'Nikka has requested 4 of P99876. Click here for more details.', 1, '2025-04-03 23:17:01', 'admin', 'Approval'),
(705, 'Nikka', 'Nikka has approved 2 of P99876. Click here for more details.', 1, '2025-04-03 23:18:10', 'Nikka', 'Approved'),
(706, 'Nikka', 'Nikka has approved 30 of P67890. Click here for more details.', 1, '2025-04-03 23:18:10', 'Nikka', 'Approved'),
(707, 'Nikka', 'Nikka has approved 2 of P67890. Click here for more details.', 1, '2025-04-03 23:18:10', 'Nikka', 'Approved'),
(708, 'System', 'dsv has expired. Total expired quantity: 35', 1, '2025-04-04 16:00:05', 'admin', 'Expired'),
(709, 'System', 'P67890 has expired. Total expired quantity: 853', 1, '2025-04-04 16:00:05', 'admin', 'Expired'),
(710, 'System', 'P99876 has expired. Total expired quantity: 860', 1, '2025-04-04 16:00:05', 'admin', 'Expired'),
(711, 'Nikka', 'Nikka has requested 4 of P98765. Click here for more details.', 1, '2025-04-05 13:51:06', 'admin', 'Approval'),
(712, 'Nikka', 'Nikka has approved 2 of P98765. Click here for more details.', 1, '2025-04-05 13:51:33', 'Nikka', 'Approved'),
(713, 'Nikka', 'Nikka has requested 6 of P98765. Click here for more details.', 1, '2025-04-07 04:31:34', 'admin', 'Approval'),
(714, 'Luis', 'Luis has requested 4 of P98765. Click here for more details.', 1, '2025-04-07 04:32:02', 'admin', 'Approval'),
(715, 'Nikka', 'Nikka has approved 1 of P98765. Click here for more details.', 1, '2025-04-07 04:32:16', 'Luis', 'Approved'),
(716, 'Luis', 'Luis is returning 1 of P98765. Click here for more details.', 1, '2025-04-07 04:32:32', 'admin', 'Scrap'),
(717, 'Luis', 'Nikka has successfully received 1 of P98765. Click here for more details.', 1, '2025-04-07 04:32:40', 'Luis', 'Returned'),
(718, 'Nikka', 'Nikka has requested 4 of P98765. Click here for more details.', 1, '2025-04-07 06:03:36', 'admin', 'Approval'),
(719, 'Nikka', 'Nikka has canceled the withdrawal request for the P98765 with a quantity of 6.', 1, '2025-04-07 06:03:45', 'admin', 'Inventory'),
(720, 'Luis', 'Luis has requested 3 of P98765. Click here for more details.', 1, '2025-04-08 02:30:45', 'admin', 'Approval'),
(721, 'Luis', 'Luis has canceled the withdrawal request for the P98765 with a quantity of 3.', 1, '2025-04-08 02:50:55', 'admin', 'Inventory'),
(722, 'Luis', 'Luis has requested 3 of P98765. Click here for more details.', 1, '2025-04-08 02:51:40', 'admin', 'Approval'),
(723, 'Luis', 'Luis has canceled the withdrawal request for the P98765 with a quantity of 3.', 1, '2025-04-08 02:51:45', 'admin', 'Inventory'),
(724, 'Luis', 'Luis has requested 5 of P98765. Click here for more details.', 1, '2025-04-08 02:53:40', 'admin', 'Approval'),
(725, 'Luis', 'Luis has requested 35 of P98765. Click here for more details.', 1, '2025-04-08 04:39:20', 'admin', 'Approval'),
(726, 'Luis', 'Luis has canceled the withdrawal request for the P98765 with a quantity of 35.', 1, '2025-04-08 04:39:25', 'admin', 'Inventory'),
(727, 'System', 'P54321 has expired. Total expired quantity: 1179', 1, '2025-04-08 04:43:16', 'admin', 'Expired'),
(728, 'Luis', 'Luis has requested 300 of P98765. Click here for more details.', 1, '2025-04-08 04:43:26', 'admin', 'Approval'),
(729, 'Luis', 'Luis has canceled the withdrawal request for the P98765 with a quantity of 300.', 1, '2025-04-08 04:43:49', 'admin', 'Inventory'),
(730, 'Luis', 'Luis has requested 5 of P98765. Click here for more details.', 1, '2025-04-08 04:51:42', 'admin', 'Approval'),
(731, 'Luis', 'Luis has requested 4 of P98765. Click here for more details.', 1, '2025-04-08 05:22:36', 'admin', 'Approval'),
(732, 'Luis', 'Luis has requested 5 of P98765. Click here for more details.', 1, '2025-04-08 05:22:53', 'admin', 'Approval'),
(733, 'Luis', 'Luis has requested 2 of P54321. Click here for more details.', 1, '2025-04-08 06:39:08', 'admin', 'Approval'),
(734, 'System', 'P54321 has reached the minimum inventory level and needs restocking.', 1, '2025-04-08 06:39:08', 'admin', 'Inventory'),
(735, 'Luis', 'Luis has canceled the withdrawal request for the P54321 with a quantity of 2.', 1, '2025-04-08 06:41:28', 'admin', 'Inventory'),
(736, 'Luis', 'Luis has requested 4 of P54321. Click here for more details.', 1, '2025-04-08 06:41:42', 'admin', 'Approval'),
(737, 'System', 'P54321 has reached the minimum inventory level and needs restocking.', 1, '2025-04-08 06:41:42', 'admin', 'Inventory'),
(738, 'Luis', 'Luis has requested 4 of dvs. Click here for more details.', 1, '2025-04-08 07:33:02', 'admin', 'Approval'),
(739, 'Nikka', 'Nikka has requested 34 of dfgdf. Click here for more details.', 1, '2025-04-08 07:37:53', 'admin', 'Approval'),
(740, 'System', 'P99876 has expired. Total expired quantity: 200', 1, '0000-00-00 00:00:00', 'admin', 'Expired'),
(741, 'System', 'P99876 has expired. Total expired quantity: 200', 1, '0000-00-00 00:00:00', 'admin', 'Expired'),
(742, 'System', 'P99876 has expired. Total expired quantity: 43', 1, '2025-04-08 09:31:27', 'admin', 'Expired'),
(743, 'System', 'P98765 has expired. Total expired quantity: 12', 1, '2025-04-08 09:36:04', 'admin', 'Expired'),
(744, 'System', 'P98765 has expired. Total expired quantity: 12', 1, '2025-04-08 09:36:32', 'admin', 'Expired'),
(745, 'System', 'P99876 has expired. Total expired quantity: 355', 1, '2025-04-08 09:38:41', 'admin', 'Expired'),
(746, 'System', 'P12345 has expired. Total expired quantity: 325', 1, '2025-04-08 09:39:47', 'admin', 'Expired'),
(747, 'System', 'P67890 has expired. Total expired quantity: 532', 1, '2025-04-08 09:39:47', 'admin', 'Expired'),
(748, 'Laura', 'Laura has requested 42 of dvs. Click here for more details.', 1, '2025-04-08 09:49:47', 'admin', 'Approval'),
(749, 'Laura', 'Laura has requested 34 of efw. Click here for more details.', 1, '2025-04-08 09:50:44', 'admin', 'Approval'),
(750, 'Laura', 'Laura has approved 2 of efw. Click here for more details.', 1, '2025-04-08 09:50:56', 'Laura', 'Approved'),
(751, 'Laura', 'Laura has canceled the withdrawal request for the dvs with a quantity of 100.', 1, '2025-04-08 10:19:03', 'admin', 'Inventory'),
(752, 'Laura', 'Laura has requested 1400 of dvs. Click here for more details.', 1, '2025-04-08 10:19:15', 'admin', 'Approval'),
(753, 'System', 'dvs has expired. Total expired quantity: 23420', 1, '2025-04-09 02:56:40', 'admin', 'Expired'),
(754, 'System', 'P11223 has expired. Total expired quantity: 3', 1, '2025-04-09 02:56:40', 'admin', 'Expired'),
(755, 'System', 'P12345 has expired. Total expired quantity: 43', 1, '2025-04-09 02:56:40', 'admin', 'Expired'),
(756, 'System', 'P98765 has expired. Total expired quantity: 43', 1, '2025-04-09 02:56:40', 'admin', 'Expired'),
(757, 'Nikka', 'Nikka has requested 3 of test. Click here for more details.', 1, '2025-04-09 02:57:44', 'admin', 'Approval'),
(758, 'System', 'dbsb has expired. Total expired quantity: ', 1, '2025-04-09 08:08:34', 'admin', 'Expired'),
(759, 'System', 'dbsb has expired. Total expired quantity: ', 1, '2025-04-09 08:08:53', 'admin', 'Expired'),
(760, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-09 11:14:28', 'admin', 'Expired'),
(761, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-09 11:15:58', 'admin', 'Expired'),
(762, 'System', 'dbsb has expired. Total expired quantity: 43', 1, '2025-04-09 11:35:52', 'admin', 'Expired'),
(763, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-09 11:36:59', 'admin', 'Expired'),
(764, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-09 12:07:49', 'admin', 'Expired'),
(765, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-09 12:08:20', 'admin', 'Expired'),
(766, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-09 12:09:58', 'admin', 'Expired'),
(767, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-09 12:10:01', 'admin', 'Expired'),
(768, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-09 12:33:03', 'admin', 'Expired'),
(769, 'System', 'dbsb has expired. Total expired quantity: 597', 1, '2025-04-10 03:19:22', 'admin', 'Expired'),
(770, 'System', 'dfgdf has expired. Total expired quantity: 4322', 1, '2025-04-10 03:19:22', 'admin', 'Expired'),
(771, 'System', 'dvs has expired. Total expired quantity: 20', 1, '2025-04-10 03:19:22', 'admin', 'Expired'),
(772, 'System', 'efw has expired. Total expired quantity: 3998', 1, '2025-04-10 03:19:22', 'admin', 'Expired'),
(773, 'System', 'P12345 has expired. Total expired quantity: 1000', 1, '2025-04-10 03:19:22', 'admin', 'Expired'),
(774, 'System', 'P45678 has expired. Total expired quantity: 200', 1, '2025-04-10 03:19:22', 'admin', 'Expired'),
(775, 'System', 'test has expired. Total expired quantity: 429', 1, '2025-04-10 03:19:22', 'admin', 'Expired'),
(776, 'System', ' has expired. Total expired quantity: ', 1, '2025-04-10 03:23:01', 'admin', 'Expired'),
(777, 'Nikka', 'Nikka has requested 1 of dbsb. Click here for more details.', 1, '2025-04-10 03:35:15', 'admin', 'Approval'),
(778, 'Nikka', 'Nikka has requested 2 of dbsb. Click here for more details.', 1, '2025-04-10 03:39:44', 'admin', 'Approval');

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
  `batch_number` varchar(255) NOT NULL,
  `machine_no` varchar(50) NOT NULL,
  `with_reason` text NOT NULL,
  `req_by` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cost_center` varchar(255) NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `dts_approve` varchar(255) NOT NULL,
  `rejected_by` varchar(255) NOT NULL,
  `rejected_reason` text NOT NULL,
  `dts_rejected` varchar(255) NOT NULL,
  `return_reason` text NOT NULL,
  `dts_return` varchar(255) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `dts_receive` varchar(255) NOT NULL,
  `approved_qty` int(11) NOT NULL,
  `approved_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requested`
--

INSERT INTO `tbl_requested` (`id`, `dts`, `part_name`, `lot_id`, `part_desc`, `station_code`, `part_option`, `part_qty`, `exp_date`, `batch_number`, `machine_no`, `with_reason`, `req_by`, `status`, `cost_center`, `approved_by`, `dts_approve`, `rejected_by`, `rejected_reason`, `dts_rejected`, `return_reason`, `dts_return`, `return_qty`, `received_by`, `dts_receive`, `approved_qty`, `approved_reason`) VALUES
(176, '2025-03-28 20:43:51', 'P12345', 'LOT-1011', 'Bolt, 5mm', 'CDP 3', 'Direct', 2, '2025-04-02', '', 'MP3A_PMC002', 'Replacement', 'Roberto', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(177, '2025-03-28 20:44:14', 'P67890', 'LOT-1012', 'Copper Wire, 50m', 'CDP 2', 'Indirect', 2, '2025-04-05', '', 'MP3A_PPM001', 'Dummy Use', 'Roberto', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(178, '2025-03-28 20:44:27', 'P33445', 'LOT-1013', 'LED Light Bulb, 10W', 'CDP 1', 'Indirect', 2, '2025-04-04', '', 'MP3A_PMC002', 'Use for Packaging', 'Roberto', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(179, '2025-03-28 20:44:42', 'P98765', 'LOT-1014', 'Steel Plate, 2mm', 'EOL', 'Direct', 1, '2025-04-14', '', 'MP3A_LM001', 'Replacement', 'Roberto', 'rejected', 'MASMOD', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(180, '2025-03-28 20:45:08', 'P45678', 'LOT-1015', 'Electrical Tape, Black', 'EOL', 'Direct', 5, '2025-04-03', '', 'MP3A_PPM002', 'MC Setup', 'Roberto', 'rejected', 'MASMOD', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(181, '2025-03-28 20:45:22', 'P22334', 'LOT-1016', 'Hydraulic Pump, 5000psi', 'CDP 2', 'Direct', 2, '2025-04-04', '', 'MP3A_SC002', 'Use for Cleaning', 'Roberto', 'rejected', 'MASMOD', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(182, '2025-03-28 20:45:36', 'P99876', 'LOT-1017', 'Air Filter, HEPA', 'Mold', 'Direct', 2, '2025-04-05', '', 'MP3A_PPM002', 'General Use', 'Roberto', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(183, '2025-03-28 20:45:55', 'P99876', 'LOT-1018', 'Air Filter, HEPA', 'CDP 3', 'Direct', 2, '2025-04-05', '', 'MP3A_IR001', 'Dummy Use', 'Roberto', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(184, '2025-03-28 20:46:08', 'P33445', 'LOT-1019', 'LED Light Bulb, 10W', 'CDP 3', 'Indirect', 2, '2025-04-04', '', 'MP3A_PPM001', 'Use for Packaging', 'Roberto', 'rejected', 'MASMOD', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(185, '2025-03-28 20:46:20', 'P22334', 'LOT-1020', 'Hydraulic Pump, 5000psi', 'DA', 'Direct', 1, '2025-04-04', '', 'MP3A_PPM003', 'Dummy Use', 'Roberto', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(186, '2025-03-28 20:49:56', 'P12345', 'LOT-1021', 'Bolt, 5mm', 'CDP 2', 'Direct', 2, '2025-04-02', '', 'MP3A_PPM001', 'MC Setup', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(187, '2025-03-28 20:50:08', 'P54321', 'LOT-1022', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 4, '2025-04-08', '', 'MP3A_PPM002', 'Use for Packaging', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(188, '2025-03-28 20:50:18', 'P99876', 'LOT-1023', 'Air Filter, HEPA', 'CDP 3', 'Direct', 5, '2025-04-05', '', 'MP3A_PPM002', 'Engineering Eval', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(189, '2025-03-28 20:50:27', 'P11223', 'LOT-1024', 'Gasket, Rubber, 30mm', 'CDP 2', 'Indirect', 6, '2025-04-02', '', 'MP3A_PPM003', 'Use for Packaging', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(190, '2025-03-28 20:50:38', 'P55667', 'LOT-1025', 'Lubricant, Industrial', 'CDP 3', 'Direct', 3, '2025-05-07', '', 'MP3A_PPM003', 'Engineering Eval', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(191, '2025-03-28 20:50:52', 'P33445', 'LOT-1026', 'LED Light Bulb, 10W', 'CDP 2', 'Indirect', 5, '2025-04-04', '', 'MP3A_SC001', 'General Use', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(192, '2025-03-28 20:51:03', 'P12345', 'LOT-1027', 'Bolt, 5mm', 'CDP 3', 'Direct', 5, '2025-04-02', '', 'MP3A_PPM002', 'Engineering Eval', 'Carlos', 'rejected', 'MASMOD', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(193, '2025-03-28 20:51:13', 'P55667', 'LOT-1028', 'Lubricant, Industrial', 'WB', 'Direct', 2, '2025-05-07', '', 'MP3A_PPM002', 'Engineering Eval', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(194, '2025-03-28 20:51:24', 'P12345', 'LOT-1029', 'Bolt, 5mm', 'CDP 1', 'Direct', 5, '2025-04-02', '', 'MP3A_IR001', 'Use for Packaging', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(195, '2025-03-28 20:51:38', 'P98765', 'LOT-1030', 'Steel Plate, 2mm', 'CDP 3', 'Direct', 8, '2025-04-14', '', 'MP3A_PPM002', 'Change Cap', 'Carlos', 'approved', 'MASMOD', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(196, '2025-03-28 21:07:26', 'P12345', 'LOT-1031', 'Bolt, 5mm', 'CDP 1', 'Direct', 2, '2025-04-02', '', 'MP3A_PPM002', 'Use for Cleaning', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(197, '2025-03-28 21:07:38', 'P54321', 'LOT-1032', 'Plastic Washer, 10mm', 'CDP 1', 'Direct', 2, '2025-04-08', '', 'MP3A_SC001', 'Use for Packaging', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(198, '2025-03-28 21:07:55', 'P98765', 'LOT-1033', 'Steel Plate, 2mm', 'CDP 3', 'Direct', 2, '2025-04-14', '', 'MP3A_WM005', 'Use for Packaging', 'Sofia', 'rejected', 'MASMOL', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(199, '2025-03-28 21:08:42', 'P45678', 'LOT-1034', 'Electrical Tape, Black', 'WB', 'Direct', 5, '2025-04-03', '', 'MP3A_SC001', 'Use for Packaging', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(200, '2025-03-28 21:08:56', 'P22334', 'LOT-1035', 'Hydraulic Pump, 5000psi', 'Engg', 'Direct', 3, '2025-04-04', '', 'MP3A_WM003', 'Use for Packaging', 'Sofia', 'rejected', 'MASMOL', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(201, '2025-03-28 21:09:08', 'P99876', 'LOT-1036', 'Air Filter, HEPA', 'CDP 2', 'Direct', 6, '2025-04-05', '', 'MP3A_PPM003', 'Change Cap', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(202, '2025-03-28 21:09:21', 'P55667', 'LOT-1037', 'Lubricant, Industrial', 'CDP 3', 'Direct', 9, '2025-05-07', '', 'MP3A_SC001', 'Dummy Use', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(203, '2025-03-28 21:09:34', 'P54321', 'LOT-1038', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 6, '2025-04-08', '', 'MP3A_SC001', 'General Use', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(204, '2025-03-28 21:09:45', 'P33445', 'LOT-1039', 'LED Light Bulb, 10W', 'CDP 3', 'Indirect', 9, '2025-04-04', '', 'MP3A_WM006', 'Use for Packaging', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(205, '2025-03-28 21:09:58', 'P55667', 'LOT-1040', 'Lubricant, Industrial', 'CDP 2', 'Direct', 3, '2025-05-07', '', 'MP3A_PPM001', 'Use for Packaging', 'Sofia', 'approved', 'MASMOL', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(206, '2025-03-28 21:11:00', 'P67890', 'LOT-1041', 'Copper Wire, 50m', 'WB', 'Indirect', 2, '2025-04-05', '', 'MP3A_PPM001', 'Use for Cleaning', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(207, '2025-03-28 21:11:12', 'P12345', 'LOT-1042', 'Bolt, 5mm', 'CDP 3', 'Direct', 5, '2025-04-02', '', 'MP3A_PPM003', 'Use for Cleaning', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(208, '2025-03-28 21:11:27', 'P55667', 'LOT-1043', 'Lubricant, Industrial', 'CDP 2', 'Direct', 3, '2025-05-07', '', 'MP3A_PPM001', 'Engineering Eval', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(209, '2025-03-28 21:11:37', 'P54321', 'LOT-1044', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 2, '2025-04-08', '', 'MP3A_MO001', 'General Use', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(210, '2025-03-28 21:11:51', 'P55667', 'LOT-1045', 'Lubricant, Industrial', 'DA', 'Direct', 1, '2025-05-07', '', 'MP3A_WM006', 'Dummy Use', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(211, '2025-03-28 21:12:03', 'P33445', 'LOT-1046', 'LED Light Bulb, 10W', 'CDP 1', 'Indirect', 2, '2025-04-04', '', 'MP3A_PMC002', 'Dummy Use', 'Laura', 'rejected', 'MASMOC', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(212, '2025-03-28 21:12:13', 'P12345', 'LOT-1047', 'Bolt, 5mm', 'CDP 3', 'Direct', 2, '2025-04-02', '', 'MP3A_PPM002', 'Change Cap', 'Laura', 'rejected', 'MASMOC', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(213, '2025-03-28 21:12:24', 'P33445', 'LOT-1048', 'LED Light Bulb, 10W', 'EOL', 'Indirect', 2, '2025-04-04', '', 'MP3A_PMC001', 'Replacement', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(214, '2025-03-28 21:12:35', 'P54321', 'LOT-1049', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 2, '2025-04-08', '', 'MP3A_LM001', 'Change Cap', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(215, '2025-03-28 21:12:44', 'P33445', 'LOT-1050', 'LED Light Bulb, 10W', 'EOL', 'Indirect', 2, '2025-04-04', '', 'MP3A_WM002', 'Dummy Use', 'Laura', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(216, '2025-03-28 21:14:41', 'P12345', 'LOT-1051', 'Bolt, 5mm', 'CDP 3', 'Direct', 2, '2025-04-02', '', 'MP3A_PPM002', 'Change Cap', 'Isabel', 'rejected', 'MASMOC', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(217, '2025-03-28 21:14:55', 'P12345', 'LOT-1052', 'Bolt, 5mm', 'CDP 2', 'Direct', 1, '2025-04-02', '', 'MP3A_PPM001', 'Engineering Eval', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(218, '2025-03-28 21:15:05', 'P98765', 'LOT-1053', 'Steel Plate, 2mm', 'CDP 3', 'Direct', 2, '2025-04-14', '', 'MP3A_PMC002', 'Change Cap', 'Isabel', 'rejected', 'MASMOC', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(219, '2025-03-28 21:15:15', 'P22334', 'LOT-1054', 'Hydraulic Pump, 5000psi', 'Mold', 'Direct', 2, '2025-04-04', '', 'MP3A_PPM001', 'Dummy Use', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(220, '2025-03-28 21:15:27', 'P99876', 'LOT-1055', 'Air Filter, HEPA', 'CDP 3', 'Direct', 5, '2025-04-05', '', 'MP3A_PMC002', 'Dummy Use', 'Isabel', 'rejected', 'MASMOC', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(221, '2025-03-28 21:15:39', 'P22334', 'LOT-1056', 'Hydraulic Pump, 5000psi', 'CDP 2', 'Direct', 5, '2025-04-04', '', 'MP3A_PPM001', 'Replacement', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(222, '2025-03-28 21:15:48', 'P33445', 'LOT-1057', 'LED Light Bulb, 10W', 'CDP 3', 'Indirect', 2, '2025-04-04', '', 'MP3A_PPM001', 'Engineering Eval', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(223, '2025-03-28 21:16:00', 'P55667', 'LOT-1058', 'Lubricant, Industrial', 'CDP 3', 'Direct', 5, '2025-05-07', '', 'MP3A_PLM002', 'Change Cap', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(224, '2025-03-28 21:16:11', 'P33445', 'LOT-1059', 'LED Light Bulb, 10W', 'CDP 2', 'Indirect', 5, '2025-04-04', '', 'MP3A_MO001', 'Change Cap', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(225, '2025-03-28 21:16:24', 'P45678', 'LOT-1060', 'Electrical Tape, Black', 'WB', 'Direct', 2, '2025-04-03', '', 'MP3A_MO001', 'Use for Cleaning', 'Isabel', 'approved', 'MASMOC', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(226, '2025-03-28 21:37:56', 'P12345', 'LOT-1061', 'Bolt, 5mm', 'CDP 2', 'Direct', 2, '2025-04-02', '', 'MP3A_PMC002', 'Change Cap', 'Juan', 'approved', 'MASMOA', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(227, '2025-03-28 21:38:07', 'P67890', 'LOT-1062', 'Copper Wire, 50m', 'CDP 3', 'Indirect', 2, '2025-04-05', '', 'MP3A_PMC001', 'General Use', 'Juan', 'approved', 'MASMOA', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(228, '2025-03-28 21:38:16', 'P54321', 'LOT-1063', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 2, '2025-04-08', '', 'MP3A_PPM001', 'Dummy Use', 'Juan', 'approved', 'MASMOA', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(229, '2025-03-28 21:38:26', 'P45678', 'LOT-1064', 'Electrical Tape, Black', 'CDP 2', 'Direct', 2, '2025-04-03', '', 'MP3A_XR001', 'Dummy Use', 'Juan', 'rejected', 'MASMOA', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(230, '2025-03-28 21:38:36', 'P55667', 'LOT-1065', 'Lubricant, Industrial', 'DA', 'Direct', 2, '2025-05-07', '', 'MP3A_PPM001', 'Dummy Use', 'Juan', 'rejected', 'MASMOA', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(231, '2025-03-28 21:38:49', 'P11223', 'LOT-1066', 'Gasket, Rubber, 30mm', 'CDP 3', 'Indirect', 5, '2025-04-02', '', 'MP3A_PMC002', 'General Use', 'Juan', 'returned', 'MASMOA', 'Nikka', '2025-03-30 19:58:27', '', '', '', 'test', '2025-03-31 22:45:18', 0, 'Eduardo', '2025-03-31 22:45:32', 0, ''),
(232, '2025-03-28 21:39:05', 'P45678', 'LOT-1067', 'Electrical Tape, Black', 'Mold', 'Direct', 4, '2025-04-03', '', 'MP3A_PPM001', 'Dummy Use', 'Juan', 'rejected', 'MASMOA', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(233, '2025-03-28 21:39:15', 'P55667', 'LOT-1068', 'Lubricant, Industrial', 'WB', 'Direct', 5, '2025-05-07', '', 'MP3A_PPM001', 'Dummy Use', 'Juan', 'approved', 'MASMOA', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(234, '2025-03-28 21:39:25', 'P98765', 'LOT-1069', 'Steel Plate, 2mm', 'DA', 'Direct', 2, '2025-04-14', '', 'MP3A_PPM003', 'Engineering Eval', 'Juan', 'approved', 'MASMOA', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(235, '2025-03-28 21:39:37', 'P12345', 'LOT-1070', 'Bolt, 5mm', 'WB', 'Direct', 6, '2025-04-02', '', 'MP3A_WM003', 'Replacement', 'Juan', 'approved', 'MASMOA', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(236, '2025-03-30 19:07:14', 'P67890', 'LOT-847362', 'Copper Wire, 50m', 'Mold', 'Indirect', 5, '2025-04-05', '', 'MP3A_PPM002', 'Engineering Eval', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(237, '2025-03-30 19:07:24', 'P11223', 'LOT-392847', 'Gasket, Rubber, 30mm', 'DA', 'Indirect', 2, '2025-04-02', '', 'MP3A_PPM001', 'Dummy Use', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(238, '2025-03-30 19:07:34', 'P54321', 'LOT-120394', 'Plastic Washer, 10mm', 'WB', 'Direct', 3, '2025-04-08', '', 'MP3A_PMC001', 'Engineering Eval', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(239, '2025-03-30 19:07:46', 'P22334', 'LOT-493827', 'Hydraulic Pump, 5000psi', 'DA', 'Direct', 5, '2025-04-04', '', 'MP3A_PPM001', 'Change Cap', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(240, '2025-03-30 19:07:57', 'P55667', 'LOT-758392', 'Lubricant, Industrial', 'Mold', 'Direct', 5, '2025-05-07', '', 'MP3A_PMC002', 'General Use', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(241, '2025-03-30 19:08:09', 'P33445', 'LOT-019384', 'LED Light Bulb, 10W', 'CDP 3', 'Indirect', 5, '2025-04-04', '', 'MP3A_PPM002', 'Dummy Use', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(242, '2025-03-30 19:08:23', 'P99876', 'LOT-573829', 'Air Filter, HEPA', 'DA', 'Direct', 9, '2025-04-05', '', 'MP3A_PPM002', 'Dummy Use', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(243, '2025-03-30 19:08:35', 'P67890', 'LOT-938472', 'Copper Wire, 50m', 'DA', 'Indirect', 6, '2025-04-05', '', 'MP3A_PPM002', 'Dummy Use', 'Maria', 'rejected', 'MASMO1', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(244, '2025-03-30 19:08:50', 'P45678', 'LOT-210394', 'Electrical Tape, Black', 'DA', 'Direct', 2, '2025-04-03', '', 'MP3A_PPM001', 'Engineering Eval', 'Maria', 'approved', 'MASMO1', 'Nikka', '2025-03-30 19:58:27', '', '', '', '', '', 0, '', '', 0, ''),
(245, '2025-03-30 19:09:02', 'P12345', 'LOT-482910', 'Bolt, 5mm', 'WB', 'Direct', 5, '2025-04-02', '', 'MP3A_PPM001', 'Change Cap', 'Maria', 'rejected', 'MASMO1', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 0, ''),
(246, '2025-03-30 19:09:46', 'P12345', 'LOT-382910', 'Bolt, 5mm', 'DA', 'Direct', 2, '2025-04-02', '', 'MP3A_PPM001', 'Use for Packaging', 'Eduardo', 'approved', 'MASMPE', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(247, '2025-03-30 19:09:57', 'P99876', 'LOT-573829', 'Air Filter, HEPA', 'Mold', 'Direct', 2, '2025-04-05', '', 'MP3A_WM006', 'Engineering Eval', 'Eduardo', 'approved', 'MASMPE', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(248, '2025-03-30 19:10:08', 'P98765', 'LOT-182910', 'Steel Plate, 2mm', 'DA', 'Direct', 6, '2025-04-14', '', 'MP3A_PPM001', 'Engineering Eval', 'Eduardo', 'approved', 'MASMPE', 'Nikka', '2025-04-03 15:08:25', '', '', '', '', '', 0, '', '', 0, ''),
(249, '2025-03-30 19:10:19', 'P33445', 'LOT-573829', 'LED Light Bulb, 10W', 'DA', 'Indirect', 7, '2025-04-04', '', 'MP3A_WM005', 'Dummy Use', 'Eduardo', 'rejected', 'MASMPE', '', '', 'Nikka', '', '2025-03-31 19:49:51', '', '', 0, '', '', 0, ''),
(250, '2025-03-30 19:10:30', 'P45678', 'LOT-291837', 'Electrical Tape, Black', 'Mold', 'Direct', 2, '2025-04-03', '', 'MP3A_PPM002', 'Use for Packaging', 'Eduardo', 'returned', 'MASMPE', 'Nikka', '2025-03-31 19:49:47', '', '', '', 'Test', '2025-03-31 22:30:04', 0, 'Eduardo', '2025-03-31 22:30:15', 0, ''),
(251, '2025-03-30 19:10:42', 'P99876', 'LOT-492857', 'Air Filter, HEPA', 'CDP 3', 'Direct', 2, '2025-04-05', '', 'MP3A_WM005', 'Replacement', 'Eduardo', 'Approved', 'MASMPE', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 2, ''),
(252, '2025-03-30 19:10:54', 'P45678', 'LOT-583920', 'Electrical Tape, Black', 'WB', 'Direct', 2, '2025-04-03', '', 'MP3A_PPM001', 'Dummy Use', 'Eduardo', 'Approved', 'MASMPE', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 2, ''),
(253, '2025-03-30 19:11:07', 'P55667', 'LOT-183756', 'Lubricant, Industrial', 'DA', 'Direct', 2, '2025-05-07', '', 'MP3A_WM001', 'Dummy Use', 'Eduardo', 'Approved', 'MASMPE', '', '', 'Nikka', '', '2025-03-30 19:59:28', '', '', 0, '', '', 2, ''),
(254, '2025-03-30 19:11:19', 'P33445', 'LOT-472019', 'LED Light Bulb, 10W', 'Engg', 'Indirect', 3, '2025-04-04', '', 'MP3A_WB017R', 'Engineering Eval', 'Eduardo', 'Approved', 'MASMPE', 'Nikka', '2025-04-03 15:09:12', '', '', '', '', '', 0, '', '', 3, ''),
(255, '2025-03-30 19:11:33', 'P99876', 'LOT-109384', 'Air Filter, HEPA', 'WB', 'Direct', 5, '2025-04-05', '', 'MP3A_PPM001', 'Use for Packaging', 'Eduardo', 'Approved', 'MASMPE', 'Nikka', '2025-04-03 15:09:12', '', '', '', '', '', 0, '', '', 2, ''),
(256, '2025-04-01 19:35:47', 'P54321', 'test', 'Plastic Washer, 10mm', 'CDP 3', 'Direct', 3, '2025-04-08', '', 'MP3A_PMC001', 'General Use', 'test', 'Rejected', 'MASMOD', 'Nikka', '2025-04-03 15:09:12', 'Nikka', 'test', '2025-04-01 19:36:31', '', '', 0, '', '', 3, ''),
(257, '2025-04-01 19:35:56', 'P98765', 'test', 'Steel Plate, 2mm', 'CDP 3', 'Direct', 1, '2025-04-14', '', 'MP3A_MO001', 'Dummy Use', 'test', 'Approved', 'MASMOD', 'Nikka', '2025-04-03 15:09:12', '', '', '', 'test', '2025-04-01 19:57:35', 1, 'Nikka', '2025-04-01 19:57:44', 1, ''),
(258, '2025-04-01 19:36:06', 'P22334', 'test', 'Hydraulic Pump, 5000psi', 'DA', 'Direct', 1, '2025-04-04', '', 'MP3A_PMC001', 'Dummy Use', 'test', 'Approved', 'MASMOD', 'Nikka', '2025-04-03 15:09:12', '', '', '', '', '', 0, '', '', 1, ''),
(259, '2025-04-01 20:00:46', 'P98765', 'test', 'Steel Plate, 2mm', 'TEST1', 'Direct', 32, '2025-04-14', '', 'TEST', 'TEST2', 'test', 'Approved', 'MASMOD', 'Nikka', '2025-04-03 15:09:12', '', '', '', '', '', 0, '', '', 14, 'test'),
(260, '2025-04-01 20:42:50', 'test', 'test', 'test', 'EDL', 'Direct', 200, '2025-04-02', '', 'MP3A_PMC001', 'Use for Packaging', 'test', 'Approved', 'MASMOD', 'Nikka', '2025-04-03 15:09:12', '', '', '', '', '', 0, '', '', 200, ''),
(261, '2025-04-03 16:32:34', 'P67890', '4214', 'Copper Wire, 50m', 'CDP 1', 'Indirect', 1, '2025-04-05', '', 'MP3A_SC001', 'Use for Packaging', 'Nikka', 'Rejected', 'MASMOB', '', '', 'Nikka', 'wala lang', '2025-04-03 16:33:09', '', '', 0, '', '', 0, ''),
(262, '2025-04-03 16:32:52', 'P67890', '1', 'Copper Wire, 50m', 'CDP 3', 'Indirect', 1, '2025-04-05', '', 'MP3A_PMC002', 'Engineering Eval', 'Nikka', 'returned', 'MASMOB', 'Nikka', '2025-04-03 16:33:01', '', '', '', 'test', '2025-04-03 17:59:33', 1, 'Nikka', '2025-04-03 17:59:51', 1, 'test'),
(263, '2025-04-03 16:47:20', 'P67890', 'test', 'Copper Wire, 50m', 'MEE', 'Indirect', 1, '2025-04-05', '', 'MP3A_PPM002', 'Use for Packaging', 'Nikka', 'Approved', 'MASMOB', 'Nikka', '2025-04-03 16:48:13', '', '', '', '', '', 0, '', '', 1, ''),
(264, '2025-04-03 17:02:04', 'P67890', 'Lot-1002', 'Copper Wire, 50m', 'DA', 'Indirect', 200, '2025-04-05', '', 'MP3A_PPM001', 'Change Cap', 'Nikka', 'Rejected', 'MASMOB', '', '', 'Nikka', 'wag muna', '2025-04-03 17:06:58', '', '', 0, '', '', 0, ''),
(265, '2025-04-03 17:46:44', 'P67890', '1', 'Copper Wire, 50m', 'Engg', 'Indirect', 1, '2025-04-05', '', 'MP3A_PPM002', 'Engineering Eval', 'Nikka', 'Approved', 'MASMOB', 'Nikka', '2025-04-03 17:46:52', '', '', '', '', '', 0, '', '', 1, ''),
(266, '2025-04-03 18:00:11', 'P98765', '523', 'Steel Plate, 2mm', 'DA', 'Direct', 23, '2025-04-14', '', 'MP3A_PPM003', 'Engineering Eval', 'Nikka', 'returning', 'MASMOB', 'Nikka', '2025-04-03 18:00:24', '', '', '', 'test', '2025-04-03 18:02:24', 9, '', '', 10, ''),
(267, '2025-04-03 18:04:14', 'P98765', 'tewt', 'Steel Plate, 2mm', 'MEE', 'Direct', 2, '2025-04-14', '', 'MP3A_PPM002', 'Use for Packaging', 'Luis', 'returned', 'MASMOG', 'Nikka', '2025-04-03 18:04:23', '', '', '', 'test', '2025-04-03 18:05:39', 1, 'Nikka', '2025-04-03 18:06:39', 2, '1'),
(268, '2025-04-03 18:07:30', 'P98765', 'esgesg', 'Steel Plate, 2mm', 'EDL', 'Direct', 23, '2025-04-14', '', 'MP3A_PPM002', 'Use for Packaging', 'Luis', 'Approved', 'MASMOG', 'Nikka', '2025-04-03 18:07:41', '', '', '', '', '', 0, '', '', 2, ''),
(269, '2025-04-03 18:09:21', 'P98765', 'tewtw', 'Steel Plate, 2mm', 'EDL', 'Direct', 2, '2025-04-14', '', 'MP3A_PPM002', 'Engineering Eval', 'Luis', 'Rejected', 'MASMOG', '', '', 'Nikka', 'Wag muna ikaw', '2025-04-03 18:09:34', '', '', 0, '', '', 0, ''),
(270, '2025-04-04 07:16:22', 'P67890', 'Lot-315', 'Copper Wire, 50m', 'Engg', 'Indirect', 5, '2025-04-05', '', 'MP3A_PMC002', 'Use for Packaging', 'Nikka', 'Approved', 'MASMOB', 'Nikka', '2025-04-04 07:18:10', '', '', '', '', '', 0, '', '', 2, ''),
(271, '2025-04-04 07:16:46', 'P67890', 'wtet', 'Copper Wire, 50m', 'EDL', 'Indirect', 35, '2025-04-05', '', 'MP3A_PPM001', 'Engineering Eval', 'Nikka', 'Approved', 'MASMOB', 'Nikka', '2025-04-04 07:18:10', '', '', '', '', '', 0, '', '', 30, ''),
(272, '2025-04-04 07:17:01', 'P99876', 'ewtwe', 'Air Filter, HEPA', 'MEE', 'Direct', 4, '2025-04-05', '', 'MP3A_PPM003', 'Dummy Use', 'Nikka', 'Approved', 'MASMOB', 'Nikka', '2025-04-04 07:18:10', '', '', '', '', '', 0, '', '', 2, ''),
(273, '2025-04-05 21:51:06', 'P98765', 'gre', 'Steel Plate, 2mm', 'CDP 3', 'Direct', 4, '2025-04-14', '', 'MP3A_PPM001', 'Dummy Use', 'Nikka', 'Approved', 'MASMOB', 'Nikka', '2025-04-05 21:51:33', '', '', '', '', '', 0, '', '', 2, ''),
(275, '2025-04-07 12:32:02', 'P98765', 'dgfgdf', 'Steel Plate, 2mm', 'MEE', 'Direct', 4, '2025-04-14', '', 'MP3A_PPM001', 'Use for Packaging', 'Luis', 'returned', 'MASMOG', 'Nikka', '2025-04-07 12:32:16', '', '', '', 'test', '2025-04-07 12:32:32', 1, 'Nikka', '2025-04-07 12:32:40', 1, ''),
(276, '2025-04-07 14:03:36', 'P98765', '6346', 'Steel Plate, 2mm', 'MEE', 'Direct', 4, '2025-04-14', '', 'MP3A_PPM002', 'Use for Packaging', 'Nikka', 'Pending', 'MASMOB', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(282, '2025-04-08 12:51:42', 'P98765', 't43', 'Steel Plate, 2mm', 'EDL', 'Direct', 1, '2025-04-14', '', 'MP3A_SC002', 'General Use', 'Luis', 'Pending', 'MASMOG', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(283, '2025-04-08 13:22:36', 'P98765', 'gregre', 'Steel Plate, 2mm', 'MEE', 'Direct', 2, '2025-04-14', '', 'TEST', 'General Use', 'Luis', 'Pending', 'MASMOG', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(284, '2025-04-08 13:22:53', 'P98765', 'regerg', 'Steel Plate, 2mm', 'MEE', 'Direct', 4, '2025-04-14', '', 'MP3A_DA001', 'TEST2', 'Luis', 'Pending', 'MASMOG', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(286, '2025-04-08 14:41:42', 'P54321', 'fghdfg', 'Plastic Washer, 10mm', 'Engg', 'Direct', 2, '2025-04-12', '', 'MP3A_PMC002', 'Dummy Use', 'Luis', 'Pending', 'MASMOG', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(287, '2025-04-08 15:33:02', 'dvs', 'gsdg', 'dvs', 'Engg', 'Direct', 4, '2025-04-10', '', 'MP3A_PPM002', 'Change Cap', 'Luis', 'Pending', 'MASMOG', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(288, '2025-04-08 15:37:53', 'dfgdf', 'sgd', 'gdfgdf', 'MFG', 'Direct', 34, '2025-04-11', '', 'MP3A_SC002', 'Use for Packaging', 'Nikka', 'Pending', 'MASMOB', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(290, '2025-04-08 17:50:44', 'efw', 'dsf', 'few', 'MEE', 'Direct', 34, '2025-04-10', '', 'MP3A_PPM001', 'Use for Packaging', 'Laura', 'Approved', 'MASMOC', 'Laura', '2025-04-08 17:50:56', '', '', '', '', '', 0, '', '', 2, ''),
(291, '2025-04-08 18:19:15', 'dvs', 'fdgs', 'dvs', 'MFG', 'Direct', 400, '2025-04-10', '', 'MP3A_PPM002', 'Use for Packaging', 'Laura', 'Pending', 'MASMOC', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(292, '2025-04-08 18:19:15', 'dvs', 'fdgs', 'dvs', 'MFG', 'Direct', 1000, '2025-04-17', '', 'MP3A_PPM002', 'Use for Packaging', 'Laura', 'Pending', 'MASMOC', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(293, '2025-04-09 10:57:44', 'test', 'test', 'test', 'Engg', 'Direct', 3, '2025-04-10', 'test', 'MP3A_PPM001', 'Engineering Eval', 'Nikka', 'Pending', 'MASMOB', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(294, '2025-04-10 11:35:15', 'dbsb', 'resr', 'sdb', 'Engg', 'Direct', 1, '2025-04-24', 'test', 'MP3A_PMC002', 'Engineering Eval', 'Nikka', 'Pending', 'MASMOB', '', '', '', '', '', '', '', 0, '', '', 0, ''),
(295, '2025-04-10 11:39:44', 'dbsb', 'test', 'sdb', 'Engg', 'Direct', 2, '2025-04-24', 'test', 'MP3A_PPM003', 'Use for Packaging', 'Nikka', 'Pending', 'MASMOB', '', '', '', '', '', '', '', 0, '', '', 0, '');

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
(30, 'MFG'),
(40, 'TEST1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `id` int(11) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `part_qty` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `batch_number` varchar(255) NOT NULL,
  `kitting_id` varchar(255) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `dts` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`id`, `part_name`, `part_qty`, `exp_date`, `batch_number`, `kitting_id`, `lot_id`, `dts`, `updated_by`, `status`) VALUES
(59, 'P12345', '5573', '2025-04-02', '', 'KIT-001', 'LOT-1001', '2025-03-28 19:59:30', 'Nikka', 'Expired'),
(60, 'P67890', '853', '2025-04-05', '', 'KIT-002', 'LOT-1002', '2025-03-28 20:18:48', 'Nikka', 'Expired'),
(61, 'P54321', '1179', '2025-04-08', '', 'KIT-003', 'OT-1003', '2025-03-28 20:19:23', 'Nikka', 'Expired'),
(62, 'P98765', '1326', '2025-04-14', '', 'KIT-004', 'LOT-1004', '2025-03-28 20:19:48', 'Nikka', 'Active'),
(63, 'P45678', '739', '2025-04-03', '', 'KIT-005', 'LOT-1005', '2025-03-28 20:20:16', 'Nikka', 'Expired'),
(64, 'P11223', '967', '2025-04-02', '', 'KIT-006', 'LOT-1006', '2025-03-28 20:20:41', 'Nikka', 'Expired'),
(65, 'P99876', '860', '2025-04-05', '', 'KIT-007', 'LOT-1007', '2025-03-28 20:21:01', 'Nikka', 'Expired'),
(66, 'P33445', '525', '2025-04-04', '', 'KIT-008', 'LOT-1008', '2025-03-28 20:21:23', 'Nikka', 'Expired'),
(67, 'P55667', '894', '2025-05-07', '', 'KIT-009', 'LOT-1009', '2025-03-28 20:21:47', 'Nikka', 'Active'),
(68, 'P22334', '625', '2025-04-04', '', 'KIT-010', 'LOT-1010', '2025-03-28 20:22:06', 'Nikka', 'Expired'),
(69, 'P12345', '32', '2025-03-30', '', '432', '432', '2025-03-30 20:25:50', 'Nikka', 'Expired'),
(70, 'P54321', '21', '2025-03-31', '', '5324', '5324', '2025-03-30 20:26:07', 'Nikka', 'Expired'),
(72, 'dsv', '35', '2025-04-05', '', 'gt', 'egw', '2025-04-04 22:28:05', 'Nikka', 'Expired'),
(73, 'P11223', '3', '2025-04-09', '', 'tew', 'twe', '2025-04-04 23:18:26', 'Nikka', 'Expired'),
(74, 'P55667', '54', '2025-04-16', '', 'gf43', 'g43g', '2025-04-05 12:00:06', 'Nikka', 'Active'),
(75, 'P54321', '13', '2025-04-12', '', '15', '2561', '2025-04-05 12:16:47', 'Nikka', 'Active'),
(76, 'dvs', '20', '2025-04-10', '', 'ewrwe', 'fewwe', '2025-04-08 15:32:44', 'Nikka', 'Expired'),
(77, 'dfgdf', '20', '2025-04-11', '', 'rgere', 'reger', '2025-04-08 15:37:43', 'Nikka', 'Active'),
(78, 'dfgdf', '4322', '2025-04-10', '', 'sdfsd', 'sdf', '', '', 'Expired'),
(79, 'dvs', '23420', '2025-04-09', '', 'fsdf', 'sdfsdf', '', '', 'Expired'),
(80, 'P12345', '43', '2025-04-09', '', 'ewfew', 'efwf', '', '', 'Expired'),
(81, 'P11223', '43', '2025-04-02', '', 'efwfe', 'fewfw', '', '', 'Expired'),
(82, 'dfgdf', '1000', '2025-04-03', '', 'saf', 'fa', '2025-04-08', 'Laura', 'Expired'),
(83, 'dvs', '0', '2025-04-17', '', 'fsaf', 'asf', '2025-04-08', 'Laura', 'Active'),
(84, 'dfgdf', '4111', '2025-04-17', '', 'fas', 'safsaf', '2025-04-08', 'Laura', 'Active'),
(85, 'P12345', '1000', '2025-04-10', '', 'sdf', 'dsfsd', '2025-04-08', 'Laura', 'Expired'),
(86, 'P11223', '1000', '2025-04-17', '', 'sfsdf', 'fdsf', '2025-04-08', 'Laura', 'Active'),
(87, 'P99876', '200', '', '', 'fes', 'fesf', '', 'Laura', 'Expired'),
(88, 'P99876', '200', '', '', 'fes', 'fesf', '', 'Laura', 'Expired'),
(89, 'P99876', '43', '', '', 'fes', 'fsefse', '2025-04-08 17:31:27', 'Laura', 'Expired'),
(90, 'P98765', '43', '2025-04-09', '', 'fe', 'ewfw', '2025-04-08 17:32:37', 'Laura', 'Expired'),
(91, 'P67890', '13', '2025-04-17', '', 'sdg', 'dsgs', '2025-04-08 17:33:19', 'Laura', 'Active'),
(92, 'P22334', '300', '2025-04-11', '', 'sav', 'savasv', '2025-04-08 17:34:35', 'Laura', 'Active'),
(93, 'P33445', '300', '2025-04-25', '', 'asvsav', 'savv', '2025-04-08 17:34:35', 'Laura', 'Active'),
(94, 'P22334', '400', '2025-04-18', '', 'fasf', 'safas', '2025-04-08 17:36:32', 'Laura', 'Active'),
(95, 'P98765', '12', '2025-04-02', '', 'sfaf', 'fsafas', '2025-04-08 17:36:04', 'Laura', 'Expired'),
(96, 'P98765', '12', '2025-04-02', '', 'sfaf', 'fsafas', '2025-04-08 17:36:32', 'Laura', 'Expired'),
(97, 'P45678', '200', '2025-04-10', '', 'saf', 'fsa', '2025-04-08 17:38:41', 'Laura', 'Expired'),
(98, 'P99876', '355', '2025-04-07', '', 'gesg', 'gesges', '2025-04-08 17:38:41', 'Laura', 'Expired'),
(99, 'P67890', '3', '2025-04-11', '', 'ewf', 'ewf', '2025-04-08 17:38:41', 'Laura', 'Active'),
(100, 'P12345', '325', '2025-04-01', '', 'erg', 'rg', '2025-04-08 17:39:47', 'Laura', 'Expired'),
(101, 'P67890', '532', '2025-03-30', '', 'reg', 'gre', '2025-04-08 17:39:47', 'Laura', 'Expired'),
(102, 'efw', '3998', '2025-04-10', '', 'fsd', 'fds', '2025-04-08 17:50:29', 'Laura', 'Expired'),
(103, 'test', '429', '2025-04-10', 'test', 'test', 'test', '2025-04-09 10:57:28', 'Nikka', 'Expired'),
(119, 'dbsb', '5', 'NA', 'test', 'test', 'test', '2025-04-10 11:27:57', 'Nikka', 'Active'),
(120, 'dbsb', '42', '2025-04-24', 'test', 'test', 'test', '2025-04-10 11:28:43', 'Nikka', 'Active');

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
(16, 'bt'),
(21, 'test3');

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
(86, 'Sofia', 'test', 2, 'Sofia Rivera', '1006', 'Operator', 'User', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(87, 'Eduardo', 'eduardo', 2, 'Eduardo Ortiz', '1007', 'Supervisor', 'Supervisor', 'MASMPE', 'Oliver Mabutas', '', 0),
(88, 'Roberto', 'roberto', 2, 'Roberto Diaz', '1008', 'Inspector', 'Kitting', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(89, 'Isabel', 'test', 2, 'Isabel Gomez', '1009', 'Kitting', 'Kitting', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 0),
(90, 'Karen', 'karen', 2, 'Karen Lopez', '384756', 'Kitting', 'Kitting', 'MASMOK', 'Cinderella Ricacho', 'Ellaine Sanico', 0),
(91, 'Luis', 'luis', 2, 'Luis Garcia', '938475', 'Operator', 'User', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(92, 'Monica', 'monica', 2, 'Monica Santiago', '192837', 'Supervisor', 'Supervisor', 'MASMOA', 'Cinderella Ricacho', 'Elaine Sanico', 0),
(93, 'Fernando', 'fernando', 2, 'Fernando Alvarez', '573829', 'Kitting', 'Kitting', 'MASMOK', 'Cinderella Ricacho', 'Ellaine Sanico', 0),
(94, 'Jessica', 'jessica', 3, 'Jessica Ramirez', '485729', 'Supervisor', 'Supervisor', 'MASMPE', 'Oliver Mabutas', '', 0),
(95, 'Daniel', 'daniel', 3, 'Daniel Morales', '928374', 'Operator', 'User', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(96, 'Patricia', 'patricia', 3, 'Patricia Cruz', '573829', 'Kitting', 'Kitting', 'MASMO1', 'Luisa Pelobello', '', 0),
(97, 'David', 'david', 2, 'David Bautista', '192837', 'Kitting', 'User', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra', 0),
(98, 'Angela', 'angela', 2, 'Angela Ramos', '573829', 'Supervisor', 'Supervisor', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 0),
(102, 'test', 'test1', 3, 'test', 'test', 'Operator', 'User', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra', 0);

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
(8, 'Use for Cleaning'),
(13, 'TEST2');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `tbl_machine`
--
ALTER TABLE `tbl_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=779;

--
-- AUTO_INCREMENT for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT for table `tbl_station_code`
--
ALTER TABLE `tbl_station_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tbl_withdrawal_reason`
--
ALTER TABLE `tbl_withdrawal_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
