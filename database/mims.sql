-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 12:29 PM
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
(6, 'Part Number 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 103),
(7, 'Part Number 2', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 14),
(8, 'Part Number 3', 'Curabitur fringilla, velit ac imperdiet tempor', 91),
(9, 'Part Number 4', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 144),
(10, 'Part Number 5', 'bibendum commodo ipsum dignissim sit amet.', 35),
(11, 'Part Number 6', 'Quisque mauris lectus, pellentesque blandit scelerisque vitae, pulvinar et ipsum.', 236),
(12, 'Part Number 7', 'Nunc vestibulum eu augue eu mollis. ', 178),
(13, 'Part Number 8', 'Curabitur dui erat, cursus sit amet nulla id, sagittis fermentum massa.', 197),
(14, 'Part Number 9', 'Cras accumsan sollicitudin risus, sed sodales urna fringilla non.', 368),
(15, 'Part Number 10', 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 232),
(16, 'Part Number 11', 'Suspendisse fermentum fringilla felis ut efficitur.', 167),
(17, 'Part Number 12', 'Nullam vestibulum ultricies tellus et imperdiet. Fusce tincidunt tempus quam', 145),
(18, 'Part Number 13', 'pellentesque nulla eleifend in. Pellentesque', 543),
(19, 'Part Number 14', 'morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 511),
(20, 'Part Number 15', 'Etiam elementum nulla eget diam consectetur suscipit.', 198);

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
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requested`
--

INSERT INTO `tbl_requested` (`id`, `dts`, `part_name`, `lot_id`, `part_desc`, `station_code`, `part_no`, `part_qty`, `machine_no`, `with_reason`, `req_by`, `status`) VALUES
(25, '2025-01-25 16:31:47', 'Part Number 1', 'X6CX6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'MA234D', '', 3, 'MP3A_WSDFD', 'SETUP', 'Dominick', 'approved'),
(26, '2025-01-25 16:32:39', 'Part Number 2', 'MKDFMG97', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 'FDS867', '', 12, 'FJE939', 'SETUP', 'Dominick', 'Pending'),
(27, '2025-01-25 16:33:03', 'Part Number 9', 'G3643NH', 'Cras accumsan sollicitudin risus, sed sodales urna fringilla non.', 'EN83', '', 43, 'NFEHW7', 'SETUP', 'Dominick', 'Pending'),
(28, '2025-01-25 16:33:21', 'Part Number 14', 'EF234F', 'morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 'EWFW', '', 32, 'SDFGR3', 'SETUP', 'Dominick', 'Pending'),
(29, '2025-01-25 16:33:41', 'Part Number 15', 'LJKSJDIA08', 'Etiam elementum nulla eget diam consectetur suscipit.', 'EWFE2', '', 32, 'FE2387', 'SETUP', 'Dominick', 'Pending'),
(30, '2025-01-25 16:34:13', 'Part Number 5', 'YG73642', 'bibendum commodo ipsum dignissim sit amet.', 'EKWH', '', 21, 'POEIWR', 'SETUP', 'Dominick', 'approved'),
(31, '2025-01-25 16:35:05', 'Part Number 2', 'FH8439', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 'TU3826', '', 42, 'HE76W3', 'SETUP', 'Ortega', 'Pending'),
(32, '2025-01-25 16:35:19', 'Part Number 11', 'DU84JF3', 'Suspendisse fermentum fringilla felis ut efficitur.', 'EWF27', '', 32, '54352', 'SETUP', 'Ortega', 'Pending'),
(33, '2025-01-25 16:35:34', 'Part Number 6', 'RD5R32', 'Quisque mauris lectus, pellentesque blandit scelerisque vitae, pulvinar et ipsum.', 'BFSHDBF', '', 73, 'D6E5W', 'SETUP', 'Ortega', 'approved'),
(34, '2025-01-25 16:35:48', 'Part Number 15', '346R263', 'Etiam elementum nulla eget diam consectetur suscipit.', 'HYFGEWY5', '', 23, '655364TG', 'SETUP', 'Ortega', 'Pending'),
(35, '2025-01-25 16:36:00', 'Part Number 7', 'F2F234', 'Nunc vestibulum eu augue eu mollis. ', 'SF23', '', 12, 'D3254FR', 'SETUP', 'Ortega', 'Pending'),
(36, '2025-01-25 16:36:39', 'Part Number 8', '3D2DE3', 'Curabitur dui erat, cursus sit amet nulla id, sagittis fermentum massa.', 'FSE3R', '', 23, 'F32FD3', 'SETUP', 'Ortega', 'Pending'),
(37, '2025-01-25 16:37:10', 'Part Number 12', 'F4333W', 'Nullam vestibulum ultricies tellus et imperdiet. Fusce tincidunt tempus quam', 'WFE323', '', 32, 'WQ3RQ', 'SETUP', 'Ortega', 'Pending'),
(38, '2025-01-25 16:38:25', 'Part Number 1', 'D36', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'FWE236', '', 12, 'RD532F5', 'SETUP', 'Ashley', 'Pending'),
(39, '2025-01-25 16:38:34', 'Part Number 3', '24D3', 'Curabitur fringilla, velit ac imperdiet tempor', 'FWEEW', '', 32, 'VSE23', 'SETUP', 'Ashley', 'Pending'),
(40, '2025-01-25 16:38:46', 'Part Number 5', 'D32F', 'bibendum commodo ipsum dignissim sit amet.', 'SVEE4', '', 12, '322D', 'SETUP', 'Ashley', 'Pending'),
(41, '2025-01-25 16:39:12', 'Part Number 9', 'WA3E23', 'Cras accumsan sollicitudin risus, sed sodales urna fringilla non.', 'SVES4', '', 21, 'D56D', 'SETUP', 'Ashley', 'approved'),
(42, '2025-01-25 16:39:45', 'Part Number 7', 'E45E4', 'Nunc vestibulum eu augue eu mollis. ', 'EWFW34', '', 32, 'W34FR344', 'SETUP', 'Ashley', 'approved'),
(43, '2025-01-25 16:39:59', 'Part Number 11', 'WFGTF5', 'Suspendisse fermentum fringilla felis ut efficitur.', 'EWFS4E4', '', 32, '34WWR3', 'SETUP', 'Ashley', 'Pending'),
(44, '2025-01-25 16:40:26', 'Part Number 2', 'E45E345', 'Donec risus nibh, egestas vitae nisi ut, elementum dictum odio. ', 'FEW4R3R2', '', 32, '34DF43', 'SETUP', 'Simon', 'approved'),
(45, '2025-01-25 16:40:35', 'Part Number 4', 'W34RWE', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 'FWEFW34', '', 23, '3R4R3', 'SETUP', 'Simon', 'Pending'),
(46, '2025-01-25 16:40:46', 'Part Number 6', 'TGD5TE4', 'Quisque mauris lectus, pellentesque blandit scelerisque vitae, pulvinar et ipsum.', 'FEWE4EW', '', 23, 'E454F4F', 'SETUP', 'Simon', 'Pending'),
(47, '2025-01-25 16:40:58', 'Part Number 8', 'EW44WE', 'Curabitur dui erat, cursus sit amet nulla id, sagittis fermentum massa.', 'EW4WE4', '', 12, 'T5G43R', 'SETUP', 'Simon', 'approved'),
(48, '2025-01-25 16:41:12', 'Part Number 10', '453WRT43', 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 'FDE45RES4', '', 2, 'EW4F43', 'SETUP', 'Simon', 'Pending'),
(49, '2025-01-25 16:41:22', 'Part Number 12', 'TE65TG', 'Nullam vestibulum ultricies tellus et imperdiet. Fusce tincidunt tempus quam', 'FWE4WE5T', '', 23, 'E45GF4E', 'GTE4T', 'Simon', 'approved'),
(50, '2025-01-25 16:42:21', 'Part Number 1', '3452RF4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'EW4EWS4W', '', 32, 'W3R23QR4', 'SETUP', 'Gonzales', 'Pending'),
(51, '2025-01-25 16:42:34', 'Part Number 4', 'E4554', 'ligula justo eleifend mi, id dapibus odio nisl ut dui. Proin mattis condimentum sapien', 'EW4ERF', '', 23, 'E4534', 'SETUP', 'Gonzales', 'Pending'),
(52, '2025-01-25 16:42:45', 'Part Number 5', 'T3WT4T34', 'bibendum commodo ipsum dignissim sit amet.', 'E4S43', '', 32, 'F43FEW432', 'SETUP', 'Gonzales', 'Pending'),
(53, '2025-01-25 16:42:54', 'Part Number 7', '453543', 'Nunc vestibulum eu augue eu mollis. ', 'SE4FEF43', '', 32, 'S4F3F3', 'SETUP', 'Gonzales', 'approved'),
(54, '2025-01-25 16:43:05', 'Part Number 12', '3RF455', 'Nullam vestibulum ultricies tellus et imperdiet. Fusce tincidunt tempus quam', 'EW45SE5T', '', 32, 'E453TFR435', 'SETUP', 'Gonzales', 'Pending'),
(55, '2025-01-25 16:43:16', 'Part Number 15', '3WS4342', 'Etiam elementum nulla eget diam consectetur suscipit.', 'RW3R32', '', 21, 'W344535', 'SETUP', 'Gonzales', 'approved');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
