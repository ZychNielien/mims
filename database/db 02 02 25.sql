-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 05:39 PM
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
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `dts` varchar(50) NOT NULL,
  `lot_id` varchar(50) NOT NULL,
  `part_desc` text NOT NULL,
  `part_name` varchar(50) NOT NULL,
  `part_qty` int(11) NOT NULL,
  `machine_no` varchar(50) NOT NULL,
  `with_reason` text NOT NULL,
  `req_by` varchar(50) NOT NULL,
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
  `part_qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `part_name`, `part_desc`, `part_qty`) VALUES
(6, 'Part Number 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.', 109),
(7, 'Part Number 2', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 11),
(8, 'Part Number 3', 'Curabitur fringilla, velit ac imperdiet tempor', 88),
(9, 'Part Number 4', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 68),
(10, 'Part Number 5', 'bibendum commodo ipsum dignissim sit amet.', 35),
(11, 'Part Number 6', 'Quisque mauris lectus, pellentesque blandit scelerisque vitae, pulvinar et ipsum.', 259),
(12, 'Part Number 7', 'Nunc vestibulum eu augue eu mollis. ', 178),
(13, 'Part Number 8', 'Curabitur dui erat, cursus sit amet nulla id, sagittis fermentum massa.', 197),
(14, 'Part Number 9', 'Cras accumsan sollicitudin risus, sed sodales urna fringilla non.', 368),
(15, 'Part Number 10', 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 354),
(16, 'Part Number 11', 'Suspendisse fermentum fringilla felis ut efficitur.', 167),
(17, 'Part Number 12', 'Nullam vestibulum ultricies tellus et imperdiet. Fusce tincidunt tempus quam', 145),
(18, 'Part Number 13', 'pellentesque nulla eleifend in. Pellentesque', 543),
(19, 'Part Number 14', 'morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 511),
(20, 'Part Number 15', 'Etiam elementum nulla eget diam consectetur suscipit.', 198),
(27, 'dsf', 'dsf', 3);

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
  `for_who` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notif`
--

INSERT INTO `tbl_notif` (`id`, `username`, `message`, `is_read`, `created_at`, `for_who`) VALUES
(1, 'user1', 'ediwow', 1, '2025-01-26 06:02:44', ''),
(2, 'may', 'trerfs', 1, '2025-01-26 06:41:01', ''),
(3, 'fvs', 'esfes', 1, '2025-01-26 06:43:50', ''),
(4, 'Ashley', 'The Ashley has requested 3 of Part Number 1. Click here for more details.', 1, '2025-01-26 07:28:28', ''),
(5, 'Ashley', 'The Ashley has requested 3 of Part Number 3. Click here for more details.', 1, '2025-01-26 07:29:27', ''),
(6, 'Ashley', 'The Ashley has requested 3 of Part Number 2. Click here for more details.', 1, '2025-01-26 07:53:07', 'admin'),
(7, 'Ashley', 'The Ashley has requested 34 of Part Number 4. Click here for more details.', 1, '2025-01-26 07:54:24', 'admin'),
(8, '', 'The Administraor has approved  of . Click here for more details.', 1, '0000-00-00 00:00:00', 'user'),
(9, '', 'The Administraor has approved  of . Click here for more details.', 1, '2025-01-26 08:02:19', 'user'),
(10, 'admin', 'The Administraor has approved  of . Click here for more details.', 1, '2025-01-26 08:03:34', 'user'),
(11, 'Array', 'The Administraor has approved Array of Array. Click here for more details.', 1, '2025-01-26 08:07:38', 'user'),
(12, 'Array', 'The Administrator has approved 43 of Part Number 9. Click here for more details.', 1, '2025-01-26 08:10:18', 'user'),
(13, 'Ashley', 'The Administrator has approved 3 of Part Number 1. Click here for more details.', 1, '2025-01-26 08:11:18', 'user'),
(14, 'Ashley', 'The Ashley has requested 44 of Part Number 4. Click here for more details.', 1, '2025-01-26 08:15:52', 'admin'),
(15, 'Ashley', 'The Ashley has requested 21 of Part Number 4. Click here for more details.', 1, '2025-01-26 08:21:20', 'admin'),
(16, 'Ashley', 'The Administrator has approved 44, 21 of Part Number 4, Part Number 4. Click here for more details.', 1, '2025-01-26 08:32:43', 'user'),
(17, 'Dominick', 'The Administrator has approved 32, 32 of Part Number 14, Part Number 15. Click here for more details.', 1, '2025-01-26 08:33:05', 'user'),
(18, 'Ashley', 'The Administrator has approved 44 of Part Number 4. Click here for more details.', 1, '2025-01-26 08:35:57', 'user'),
(19, 'Ashley', 'The Administrator has approved 21 of Part Number 4. Click here for more details.', 1, '2025-01-26 08:35:57', 'user'),
(20, 'Simon', 'The Administrator has rejected 23 of Part Number 4. Click here for more details.', 1, '2025-01-26 08:36:17', 'user'),
(21, 'Simon', 'The Administrator has rejected 23 of Part Number 6. Click here for more details.', 1, '2025-01-26 08:36:17', 'user'),
(22, 'Simon', 'The Simon has requested 14 of Part Number 1. Click here for more details.', 1, '2025-02-01 12:46:13', 'admin'),
(23, 'Simon', 'The Administrator has approved 14 of Part Number 1. Click here for more details.', 1, '2025-02-01 12:46:38', 'user'),
(24, '', ' has returned  of . Click here for more details.', 1, '2025-02-01 12:55:39', 'admin'),
(25, 'Simon', 'Simon has returned  of . Click here for more details.', 1, '2025-02-01 13:03:37', 'admin'),
(26, 'Simon', 'Simon has returned 21 of Part Number 2. Click here for more details.', 1, '2025-02-01 13:08:32', 'admin');

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
  `part_no` varchar(50) NOT NULL,
  `part_qty` int(11) NOT NULL,
  `machine_no` varchar(50) NOT NULL,
  `with_reason` text NOT NULL,
  `req_by` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `return_reason` text NOT NULL,
  `dts_return` varchar(255) NOT NULL,
  `return_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requested`
--

INSERT INTO `tbl_requested` (`id`, `dts`, `part_name`, `lot_id`, `part_desc`, `station_code`, `part_no`, `part_qty`, `machine_no`, `with_reason`, `req_by`, `status`, `return_reason`, `dts_return`, `return_qty`) VALUES
(25, '2025-01-25 16:31:47', 'Part Number 1', 'X6CX6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'MA234D', '', 3, 'MP3A_WSDFD', 'SETUP', 'Dominick', 'approved', '', '', 0),
(26, '2025-01-25 16:32:39', 'Part Number 2', 'MKDFMG97', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 'FDS867', '', 12, 'FJE939', 'SETUP', 'Dominick', 'approved', '', '', 0),
(27, '2025-01-25 16:33:03', 'Part Number 9', 'G3643NH', 'Cras accumsan sollicitudin risus, sed sodales urna fringilla non.', 'EN83', '', 43, 'NFEHW7', 'SETUP', 'Dominick', 'approved', '', '', 0),
(28, '2025-01-25 16:33:21', 'Part Number 14', 'EF234F', 'morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'EWFW', '', 32, 'SDFGR3', 'SETUP', 'Dominick', 'approved', '', '', 0),
(29, '2025-01-25 16:33:41', 'Part Number 15', 'LJKSJDIA08', 'Etiam elementum nulla eget diam consectetur suscipit.', 'EWFE2', '', 32, 'FE2387', 'SETUP', 'Dominick', 'approved', '', '', 0),
(30, '2025-01-25 16:34:13', 'Part Number 5', 'YG73642', 'bibendum commodo ipsum dignissim sit amet.', 'EKWH', '', 21, 'POEIWR', 'SETUP', 'Dominick', 'approved', '', '', 0),
(31, '2025-01-25 16:35:05', 'Part Number 2', 'FH8439', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 'TU3826', '', 42, 'HE76W3', 'SETUP', 'Ortega', 'Pending', '', '', 0),
(32, '2025-01-25 16:35:19', 'Part Number 11', 'DU84JF3', 'Suspendisse fermentum fringilla felis ut efficitur.', 'EWF27', '', 32, '54352', 'SETUP', 'Ortega', 'Pending', '', '', 0),
(33, '2025-01-25 16:35:34', 'Part Number 6', 'RD5R32', 'Quisque mauris lectus, pellentesque blandit scelerisque vitae, pulvinar et ipsum.', 'BFSHDBF', '', 73, 'D6E5W', 'SETUP', 'Ortega', 'approved', '', '', 0),
(34, '2025-01-25 16:35:48', 'Part Number 15', '346R263', 'Etiam elementum nulla eget diam consectetur suscipit.', 'HYFGEWY5', '', 23, '655364TG', 'SETUP', 'Ortega', 'Pending', '', '', 0),
(35, '2025-01-25 16:36:00', 'Part Number 7', 'F2F234', 'Nunc vestibulum eu augue eu mollis. ', 'SF23', '', 12, 'D3254FR', 'SETUP', 'Ortega', 'Pending', '', '', 0),
(36, '2025-01-25 16:36:39', 'Part Number 8', '3D2DE3', 'Curabitur dui erat, cursus sit amet nulla id, sagittis fermentum massa.', 'FSE3R', '', 23, 'F32FD3', 'SETUP', 'Ortega', 'Pending', '', '', 0),
(37, '2025-01-25 16:37:10', 'Part Number 12', 'F4333W', 'Nullam vestibulum ultricies tellus et imperdiet. Fusce tincidunt tempus quam', 'WFE323', '', 32, 'WQ3RQ', 'SETUP', 'Ortega', 'Pending', '', '', 0),
(39, '2025-01-25 16:38:34', 'Part Number 3', '24D3', 'Curabitur fringilla, velit ac imperdiet tempor', 'FWEEW', '', 32, 'VSE23', 'SETUP', 'Ashley', 'Pending', '', '', 0),
(40, '2025-01-25 16:38:46', 'Part Number 5', 'D32F', 'bibendum commodo ipsum dignissim sit amet.', 'SVEE4', '', 12, '322D', 'SETUP', 'Ashley', 'Pending', '', '', 0),
(41, '2025-01-25 16:39:12', 'Part Number 9', 'WA3E23', 'Cras accumsan sollicitudin risus, sed sodales urna fringilla non.', 'SVES4', '', 21, 'D56D', 'SETUP', 'Ashley', 'approved', '', '', 0),
(42, '2025-01-25 16:39:45', 'Part Number 7', 'E45E4', 'Nunc vestibulum eu augue eu mollis. ', 'EWFW34', '', 32, 'W34FR344', 'SETUP', 'Ashley', 'approved', '', '', 0),
(43, '2025-01-25 16:39:59', 'Part Number 11', 'WFGTF5', 'Suspendisse fermentum fringilla felis ut efficitur.', 'EWFS4E4', '', 32, '34WWR3', 'SETUP', 'Ashley', 'Pending', '', '', 0),
(44, '2025-01-25 16:40:26', 'Part Number 2', 'E45E345', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 'FEW4R3R2', '', 32, '34DF43', 'SETUP', 'Simon', 'returned', 'tssts', '2025-02-01 21:08:32', 21),
(45, '2025-01-25 16:40:35', 'Part Number 4', 'W34RWE', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 'FWEFW34', '', 23, '3R4R3', 'SETUP', 'Simon', 'rejected', '', '', 0),
(46, '2025-01-25 16:40:46', 'Part Number 6', 'TGD5TE4', 'Quisque mauris lectus, pellentesque blandit scelerisque vitae, pulvinar et ipsum.', 'FEWE4EW', '', 23, 'E454F4F', 'SETUP', 'Simon', 'rejected', '', '', 0),
(47, '2025-01-25 16:40:58', 'Part Number 8', 'EW44WE', 'Curabitur dui erat, cursus sit amet nulla id, sagittis fermentum massa.', 'EW4WE4', '', 12, 'T5G43R', 'SETUP', 'Simon', 'approved', 'ewfe', '2025-02-01 20:55:39', 1),
(48, '2025-01-25 16:41:12', 'Part Number 10', '453WRT43', 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 'FDE45RES4', '', 2, 'EW4F43', 'SETUP', 'Simon', 'Pending', '', '', 0),
(49, '2025-01-25 16:41:22', 'Part Number 12', 'TE65TG', 'Nullam vestibulum ultricies tellus et imperdiet. Fusce tincidunt tempus quam', 'FWE4WE5T', '', 23, 'E45GF4E', 'GTE4T', 'Simon', 'approved', 'sdfsd', '2025-02-01 20:29:50', 2),
(50, '2025-01-25 16:42:21', 'Part Number 1', '3452RF4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'EW4EWS4W', '', 32, 'W3R23QR4', 'SETUP', 'Gonzales', 'Pending', '', '', 0),
(51, '2025-01-25 16:42:34', 'Part Number 4', 'E4554', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 'EW4ERF', '', 23, 'E4534', 'SETUP', 'Gonzales', 'Pending', '', '', 0),
(52, '2025-01-25 16:42:45', 'Part Number 5', 'T3WT4T34', 'bibendum commodo ipsum dignissim sit amet.', 'E4S43', '', 32, 'F43FEW432', 'SETUP', 'Gonzales', 'Pending', '', '', 0),
(53, '2025-01-25 16:42:54', 'Part Number 7', '453543', 'Nunc vestibulum eu augue eu mollis. ', 'SE4FEF43', '', 32, 'S4F3F3', 'SETUP', 'Gonzales', 'approved', '', '', 0),
(54, '2025-01-25 16:43:05', 'Part Number 12', '3RF455', 'Nullam vestibulum ultricies tellus et imperdiet. Fusce tincidunt tempus quam', 'EW45SE5T', '', 32, 'E453TFR435', 'SETUP', 'Gonzales', 'Pending', '', '', 0),
(55, '2025-01-25 16:43:16', 'Part Number 15', '3WS4342', 'Etiam elementum nulla eget diam consectetur suscipit.', 'RW3R32', '', 21, 'W344535', 'SETUP', 'Gonzales', 'approved', '', '', 0),
(56, '2025-01-26 15:28:05', 'Part Number 1', '23RF2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'FFF2332', '', 3, 'F342F23', 'SETUP', 'Ashley', 'approved', '', '', 0),
(57, '2025-01-26 15:28:28', 'Part Number 1', '23RF2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'FFF2332', '', 3, 'F342F23', 'SETUP', 'Ashley', 'approved', '', '', 0),
(58, '2025-01-26 15:29:27', 'Part Number 3', 'WFEFE23', 'Curabitur fringilla, velit ac imperdiet tempor', 'FEW32', '', 3, 'EDWFEWSF32', 'SETUP', 'Ashley', 'Pending', '', '', 0),
(59, '2025-01-26 15:53:07', 'Part Number 2', '32F23F3', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 'F4334F', '', 3, 'FWEFW3', 'SETUP', 'Ashley', 'approved', '', '', 0),
(60, '2025-01-26 15:54:24', 'Part Number 4', 'F3223F', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 'FEW2323', '', 34, 'F3232', 'SETUP', 'Ashley', 'approved', '', '', 0),
(61, '2025-01-26 16:15:52', 'Part Number 4', 'ergre', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 'gregr', '', 44, '34534', '43t3gt', 'Ashley', 'approved', '', '', 0),
(62, '2025-01-26 16:21:20', 'Part Number 4', 'ew', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 'fwee', '', 21, 'f323', 'fwefew', 'Ashley', 'approved', '', '', 0),
(63, '2025-02-01 20:46:13', 'Part Number 1', 'g43g34g', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.', 'efe2', '', 14, 'g43g34', 'SETUP', 'Simon', 'returned', 'defect', '2025-02-01 20:48:58', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `usertype`) VALUES
(1, 'admin', 'admin11', 1),
(15, 'Zamora', 'Zamora', 2),
(16, 'Ortega', 'Ortega', 2),
(17, 'Henry', 'Henry', 2),
(18, 'Ashley', 'Ashley', 2),
(19, 'Gonzales', 'Gonzales', 2),
(20, 'Simon', 'Simon', 2),
(21, 'Baldwin', 'Baldwin', 2),
(22, 'Glenn', 'Glenn', 2),
(23, 'Claud', 'Claud', 2),
(24, 'Dominick', 'Dominick', 2);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
