-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 09:49 AM
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
(1, 'MASMO1 (T00003)', 'Assembly Ops', 'T00003', 'Mphil2 - CHIPLINE', 'A30107', 'A78362', 'Luisa Pelobello', 'Dianne Salvatierra'),
(2, 'MASMO1 (T00008)', 'Assembly Ops', 'T00008', 'Mphil2 - QFN', 'A30107', '', 'Luisa Pelobello', ''),
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
  `batch_number` varchar(255) NOT NULL,
  `kitting_id` varchar(255) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `item_code` varchar(255) NOT NULL,
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
  `return_purpose` varchar(255) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `dts_receive` varchar(255) NOT NULL,
  `approved_qty` int(11) NOT NULL,
  `approved_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `batch_number` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `kitting_id` varchar(255) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `dts` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `password` varchar(255) NOT NULL,
  `usertype` int(2) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `badge_number` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `cost_center` varchar(255) NOT NULL,
  `supervisor_one` varchar(255) NOT NULL,
  `supervisor_two` varchar(255) NOT NULL,
  `forgot_pass` int(11) NOT NULL DEFAULT 0,
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `usertype`, `employee_name`, `badge_number`, `designation`, `account_type`, `cost_center`, `supervisor_one`, `supervisor_two`, `forgot_pass`, `reason`) VALUES
(1, 'Nikka', '$2y$10$TEKz97kTdgP6X0CkfhyQkup4/u28RlYufAYPRop7fByOk5zEaCUzC', 2, ' Marinel Nikka Zagala', '10001', 'Supervisor', 'Supervisor', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra', 0, '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_machine`
--
ALTER TABLE `tbl_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_station_code`
--
ALTER TABLE `tbl_station_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_withdrawal_reason`
--
ALTER TABLE `tbl_withdrawal_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
