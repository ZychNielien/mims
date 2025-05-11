-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 01:25 PM
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
(11, 'MASMOJ', 'Assembly Ops Trim & Form (MASMOJ)', 'T00008', 'Mphil2 - QFN', 'A73072', '177074', 'Arthur Abitria Jr.', 'Marinel Zagala'),
(60, 'OBSTA new', 'Obstacles new', '4456 new', 'Pere new', '4564 new', '5666', 'Pako nre', 'Test');

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
  `item_code` varchar(255) NOT NULL,
  `kitting_id` varchar(255) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `dts`, `part_desc`, `part_name`, `part_qty`, `exp_date`, `batch_number`, `item_code`, `kitting_id`, `lot_id`, `updated_by`, `status`) VALUES
(1, '2025-05-08 20:14:39', 'test 1', 'p10001', 100, 'NA', '', '', 'Badge 2003', 'LOT 1002', 'Nikka', 'Received'),
(2, '2025-05-08 20:14:39', 'test 2', 'p20002', 200, '2025-05-23', '', '', 'Badge 2003', 'LOT 1002', 'Nikka', 'Received'),
(3, '2025-05-08 20:14:39', 'test 3', 'p30003', 300, 'NA', '', '', 'Badge 2003', 'LOT 1002', 'Nikka', 'Received'),
(4, '2025-05-08 20:17:54', 'test 1 new', 'p10001', 60, '2025-05-09', '', '', 'test', 'lot 1001', 'Nikka', 'Received'),
(5, '2025-05-09 15:24:00', 'Angle Decription', 'Angle', 50, 'NA', '', '', 'test', 'LOT 2', 'Nikka', 'Received'),
(6, '2025-05-09 15:24:00', 'Description of Material8', 'Material8', 150, '2025-05-16', '', '', 'test', 'LOT 2', 'Nikka', 'Received'),
(7, '2025-05-10 11:30:27', 'Description of Material1', 'Material1', 100, 'NA', 'Batch 23', 'Type A', 'Test 345', 'Lot 120', 'Nikka', 'Received'),
(8, '2025-05-10 11:30:27', 'Description of Material3', 'Material3', 200, '2025-05-24', 'Batch 26', 'Type C', 'Test 345', 'Lot 122', 'Nikka', 'Received'),
(9, '2025-05-10 12:46:48', 'Angle Decription', 'Angle', 100, 'NA', 'batch 5', 'TYPE A', 'test', 'LOT 10', 'Nikka', 'Received'),
(10, '2025-05-10 12:46:48', 'Description of Material1', 'Material1', 300, 'NA', 'batch 5', 'TYPE A', 'test', 'LOT 10', 'Nikka', 'Received'),
(11, '2025-05-10 12:46:48', 'Description of Material2', 'Material2', 200, 'NA', 'batch 5', 'TYPE A', 'stes', 'LOT 10', 'Nikka', 'Received'),
(12, '2025-05-10 12:46:49', 'Description of Material14', 'Material14', 400, 'NA', 'batch 5', 'TYPE A', 'tests', 'LOT 10', 'Nikka', 'Received'),
(13, '2025-05-10 12:46:49', 'Description of Material17', 'Material17', 200, 'NA', 'batch 5', 'TYPE A', 'etest', 'LOT 10', 'Nikka', 'Received'),
(14, '2025-05-10 12:46:49', 'Description of Material10', 'Material10', 300, 'NA', 'batch 5', 'TYPE A', 'este', 'LOT 10', 'Nikka', 'Received'),
(15, '2025-05-10 12:46:49', 'Description of Material6', 'Material6', 200, 'NA', 'batch 5', 'TYPE A', 'steste', 'LOT 10', 'Nikka', 'Received'),
(16, '2025-05-10 12:46:49', 'Description of Material50', 'Material50', 100, 'NA', 'batch 5', 'TYPE A', 'stest', 'LOT 10', 'Nikka', 'Received'),
(17, '2025-05-10 13:24:33', 'Angle Decription', 'Angle', 200, 'NA', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(18, '2025-05-10 13:24:33', 'Description of Material1', 'Material1', 200, 'NA', 'test', 'testtest', 'test', 'test', 'Nikka', 'Received'),
(19, '2025-05-10 13:24:33', 'Description of Material2', 'Material2', 200, '2025-05-29', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(20, '2025-05-10 13:24:33', 'Description of Material4', 'Material4', 200, '2025-05-29', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(21, '2025-05-10 13:24:33', 'Description of Material15', 'Material15', 200, 'NA', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(22, '2025-05-10 13:24:33', 'Description of Material17', 'Material17', 200, '2025-05-24', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(23, '2025-05-10 13:24:33', 'Description of Material51', 'Material51', 200, 'NA', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(24, '2025-05-10 13:24:33', 'Description of Material87', 'Material87', 200, '2025-05-30', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(25, '2025-05-10 13:24:33', 'Description of Material82', 'Material82', 200, 'NA', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(26, '2025-05-10 13:24:33', 'test 2 new', 'p20002', 200, '2025-05-22', 'test', 'test', 'test', 'test', 'Nikka', 'Received'),
(27, '2025-05-10 19:38:43', 'Description of Material5', 'Material5', 123, 'NA', 'test', 'test', 'test', 'test', 'Patrick', 'Received'),
(28, '2025-05-10 19:38:43', 'Description of Material11', 'Material11', 124, 'NA', 'test', 'test', 'test', 'test', 'Patrick', 'Received'),
(29, '2025-05-10 19:38:43', 'Description of Material12', 'Material12', 124, '2025-05-22', 'test', 'test', 'test', 'test', 'Patrick', 'Received'),
(30, '2025-05-10 19:38:43', 'Description of Material13', 'Material13', 154, '2025-05-31', 'test', 'test', 'test', 'test', 'Patrick', 'Received');

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
(203, 'p10001', 'test 1 new', 'MASMOB', 'Warehouse A new', '55', 'bt', 'Indirect', 'General Supply Material', 'Supervisor', 0),
(204, 'p20002', 'test 2 new', 'MASMOB', 'Warehouse B new', '65', 'bt', 'Indirect', 'General Supply Material', 'Supervisor', 0),
(205, 'p30003', 'test 3 new', 'MASMOB', 'Warehouse C new', '75', 'bt', 'Indirect', 'General Supply Material', 'Supervisor', 0),
(206, 'p40004', 'test 4', 'MASMOC', 'Warehouse D', '80', 'gal', 'Direct', 'Critical', 'Supervisor', 0),
(308, 'Material1', 'Description of Material1', 'MASMO1 (T00003)', 'Location A', '10', 'kg', 'Direct', 'Critical', 'Supervisor', 0),
(309, 'Material2', 'Description of Material2', 'MASMO1 (T00008)', 'Location B', '5', 'ea', 'Indirect', 'Non-critical', 'Kitting', 0),
(310, 'Material3', 'Description of Material3', 'MASMOA', 'Location C', '50', 'pc', 'Direct', 'General Supply Material', 'Supervisor', 0),
(311, 'Material4', 'Description of Material4', 'MASMOB', 'Location D', '20', 'spl', 'Indirect', 'Critical', 'Kitting', 0),
(312, 'Material5', 'Description of Material5', 'MASMOC', 'Location E', '15', 'bx', 'Direct', 'Non-critical', 'Supervisor', 0),
(313, 'Material6', 'Description of Material6', 'MASMOD', 'Location F', '30', 'rol', 'Indirect', 'General Supply Material', 'Kitting', 0),
(314, 'Material7', 'Description of Material7', 'MASMOG', 'Location G', '100', 'kg', 'Direct', 'Critical', 'Supervisor', 0),
(315, 'Material8', 'Description of Material8', 'MASMOK', 'Location H', '25', 'ea', 'Indirect', 'Non-critical', 'Kitting', 0),
(316, 'Material9', 'Description of Material9', 'MASMOL', 'Location I', '40', 'kg', 'Direct', 'General Supply Material', 'Supervisor', 0),
(317, 'Material10', 'Description of Material10', 'MASMO1 (T00003)', 'Location J', '60', 'm', 'Indirect', 'Critical', 'Supervisor', 0),
(318, 'Material11', 'Description of Material11', 'MASMO1 (T00008)', 'Location K', '8', 'kg', 'Direct', 'Non-critical', 'Kitting', 0),
(319, 'Material12', 'Description of Material12', 'MASMOA', 'Location L', '7', 'kg', 'Indirect', 'General Supply Material', 'Supervisor', 0),
(320, 'Material13', 'Description of Material13', 'MASMOB', 'Location M', '30', 'ea', 'Direct', 'Critical', 'Kitting', 0),
(321, 'Material14', 'Description of Material14', 'MASMOC', 'Location N', '12', 'kg', 'Indirect', 'Non-critical', 'Supervisor', 0),
(322, 'Material15', 'Description of Material15', 'MASMOD', 'Location O', '55', 'kg', 'Direct', 'General Supply Material', 'Kitting', 0),
(323, 'Material16', 'Description of Material16', 'MASMOG', 'Location P', '35', 'rol', 'Indirect', 'Critical', 'Supervisor', 0),
(324, 'Material17', 'Description of Material17', 'MASMOK', 'Location Q', '18', 'bx', 'Direct', 'Non-critical', 'Kitting', 0),
(325, 'Material18', 'Description of Material18', 'MASMOL', 'Location R', '22', 'spl', 'Indirect', 'General Supply Material', 'Supervisor', 0),
(326, 'Material19', 'Description of Material19', 'MASMO1 (T00003)', 'Location S', '70', 'kg', 'Direct', 'Critical', 'Supervisor', 0),
(327, 'Material20', 'Description of Material20', 'MASMO1 (T00008)', 'Location T', '40', 'ea', 'Indirect', 'Non-critical', 'Kitting', 0),
(328, 'Material21', 'Description of Material21', 'MASMOA', 'Location U', '15', 'kg', 'Direct', 'General Supply Material', 'Supervisor', 0),
(329, 'Material22', 'Description of Material22', 'MASMOB', 'Location V', '50', 'kg', 'Indirect', 'Critical', 'Kitting', 0),
(330, 'Material23', 'Description of Material23', 'MASMOC', 'Location W', '60', 'kg', 'Direct', 'Non-critical', 'Supervisor', 0),
(331, 'Material24', 'Description of Material24', 'MASMOD', 'Location X', '30', 'rol', 'Indirect', 'General Supply Material', 'Kitting', 0),
(332, 'Material25', 'Description of Material25', 'MASMOG', 'Location Y', '100', 'm', 'Direct', 'Critical', 'Supervisor', 0),
(333, 'Material26', 'Description of Material26', 'MASMOK', 'Location Z', '70', 'ea', 'Indirect', 'Non-critical', 'Kitting', 0),
(334, 'Material27', 'Description of Material27', 'MASMOL', 'Location AA', '90', 'kg', 'Direct', 'General Supply Material', 'Supervisor', 0),
(335, 'Material28', 'Description of Material28', 'MASMO1 (T00003)', 'Location AB', '40', 'kg', 'Indirect', 'Critical', 'Kitting', 0),
(336, 'Material29', 'Description of Material29', 'MASMO1 (T00008)', 'Location AC', '30', 'kg', 'Direct', 'Non-critical', 'Supervisor', 0),
(337, 'Material30', 'Description of Material30', 'MASMOA', 'Location AD', '20', 'spl', 'Indirect', 'General Supply Material', 'Kitting', 0),
(338, 'Material31', 'Description of Material31', 'MASMOB', 'Location AE', '10', 'rol', 'Direct', 'Critical', 'Supervisor', 0),
(339, 'Material32', 'Description of Material32', 'MASMOC', 'Location AF', '50', 'kg', 'Indirect', 'Non-critical', 'Kitting', 0),
(340, 'Material33', 'Description of Material33', 'MASMOD', 'Location AG', '60', 'bx', 'Direct', 'General Supply Material', 'Supervisor', 0),
(341, 'Material34', 'Description of Material34', 'MASMOG', 'Location AH', '70', 'kg', 'Indirect', 'Critical', 'Kitting', 0),
(342, 'Material35', 'Description of Material35', 'MASMOK', 'Location AI', '80', 'pc', 'Direct', 'Non-critical', 'Supervisor', 0),
(343, 'Material36', 'Description of Material36', 'MASMOL', 'Location AJ', '15', 'kg', 'Indirect', 'General Supply Material', 'Kitting', 0),
(344, 'Material37', 'Description of Material37', 'MASMO1 (T00003)', 'Location AK', '50', 'rol', 'Direct', 'Critical', 'Supervisor', 0),
(345, 'Material38', 'Description of Material38', 'MASMO1 (T00008)', 'Location AL', '30', 'bx', 'Indirect', 'Non-critical', 'Kitting', 0),
(346, 'Material39', 'Description of Material39', 'MASMOA', 'Location AM', '25', 'spl', 'Direct', 'General Supply Material', 'Supervisor', 0),
(347, 'Material40', 'Description of Material40', 'MASMOB', 'Location AN', '40', 'kg', 'Indirect', 'Critical', 'Kitting', 0),
(348, 'Material41', 'Description of Material41', 'MASMOC', 'Location AO', '15', 'm', 'Direct', 'Non-critical', 'Supervisor', 0),
(349, 'Material42', 'Description of Material42', 'MASMOD', 'Location AP', '30', 'kg', 'Indirect', 'General Supply Material', 'Kitting', 0),
(350, 'Material43', 'Description of Material43', 'MASMOG', 'Location AQ', '100', 'ea', 'Direct', 'Critical', 'Supervisor', 0),
(351, 'Material44', 'Description of Material44', 'MASMOK', 'Location AR', '50', 'kg', 'Indirect', 'Non-critical', 'Kitting', 0),
(352, 'Material45', 'Description of Material45', 'MASMOL', 'Location AS', '20', 'spl', 'Direct', 'General Supply Material', 'Supervisor', 0),
(353, 'Material46', 'Description of Material46', 'MASMO1 (T00003)', 'Location AT', '40', 'rol', 'Indirect', 'Critical', 'Kitting', 0),
(354, 'Material47', 'Description of Material47', 'MASMO1 (T00008)', 'Location AU', '60', 'ea', 'Direct', 'Non-critical', 'Supervisor', 0),
(355, 'Material48', 'Description of Material48', 'MASMOA', 'Location AV', '80', 'kg', 'Indirect', 'General Supply Material', 'Kitting', 0),
(356, 'Material49', 'Description of Material49', 'MASMOB', 'Location AW', '30', 'rol', 'Direct', 'Critical', 'Supervisor', 0),
(357, 'Material50', 'Description of Material50', 'MASMOC', 'Location AX', '50', 'bx', 'Indirect', 'Non-critical', 'Kitting', 0),
(358, 'Material51', 'Description of Material51', 'MASMOD', 'Location AY', '25', 'spl', 'Direct', 'General Supply Material', 'Supervisor', 0),
(359, 'Material52', 'Description of Material52', 'MASMOG', 'Location AZ', '40', 'kg', 'Indirect', 'Critical', 'Kitting', 0),
(360, 'Material53', 'Description of Material53', 'MASMOK', 'Location BA', '70', 'kg', 'Direct', 'Non-critical', 'Supervisor', 0),
(361, 'Material54', 'Description of Material54', 'MASMOL', 'Location BB', '50', 'pc', 'Indirect', 'General Supply Material', 'Kitting', 0),
(362, 'Material55', 'Description of Material55', 'MASMO1 (T00003)', 'Location BC', '60', 'ea', 'Direct', 'Critical', 'Supervisor', 0),
(363, 'Material56', 'Description of Material56', 'MASMO1 (T00008)', 'Location BD', '100', 'kg', 'Indirect', 'Non-critical', 'Kitting', 0),
(364, 'Material57', 'Description of Material57', 'MASMOA', 'Location BE', '80', 'kg', 'Direct', 'General Supply Material', 'Supervisor', 0),
(365, 'Material58', 'Description of Material58', 'MASMOB', 'Location BF', '50', 'bx', 'Indirect', 'Critical', 'Kitting', 0),
(366, 'Material59', 'Description of Material59', 'MASMOC', 'Location BG', '30', 'ea', 'Direct', 'Non-critical', 'Supervisor', 0),
(367, 'Material60', 'Description of Material60', 'MASMOD', 'Location BH', '40', 'm', 'Indirect', 'General Supply Material', 'Kitting', 0),
(368, 'Material61', 'Description of Material61', 'MASMOG', 'Location BI', '10', 'kg', 'Direct', 'Critical', 'Supervisor', 0),
(369, 'Material62', 'Description of Material62', 'MASMOK', 'Location BJ', '25', 'spl', 'Indirect', 'Non-critical', 'Kitting', 0),
(370, 'Material63', 'Description of Material63', 'MASMOL', 'Location BK', '15', 'rol', 'Direct', 'General Supply Material', 'Supervisor', 0),
(371, 'Material64', 'Description of Material64', 'MASMO1 (T00003)', 'Location BL', '30', 'bx', 'Indirect', 'Critical', 'Kitting', 0),
(372, 'Material65', 'Description of Material65', 'MASMO1 (T00008)', 'Location BM', '40', 'kg', 'Direct', 'Non-critical', 'Supervisor', 0),
(373, 'Material66', 'Description of Material66', 'MASMOA', 'Location BN', '50', 'kg', 'Indirect', 'General Supply Material', 'Kitting', 0),
(374, 'Material67', 'Description of Material67', 'MASMOB', 'Location BO', '60', 'kg', 'Direct', 'Critical', 'Supervisor', 0),
(375, 'Material68', 'Description of Material68', 'MASMOC', 'Location BP', '80', 'pc', 'Indirect', 'Non-critical', 'Kitting', 0),
(376, 'Material69', 'Description of Material69', 'MASMOD', 'Location BQ', '100', 'ea', 'Direct', 'General Supply Material', 'Supervisor', 0),
(377, 'Material70', 'Description of Material70', 'MASMOG', 'Location BR', '25', 'spl', 'Indirect', 'Critical', 'Kitting', 0),
(378, 'Material71', 'Description of Material71', 'MASMOK', 'Location BS', '50', 'rol', 'Direct', 'Non-critical', 'Supervisor', 0),
(379, 'Material72', 'Description of Material72', 'MASMOL', 'Location BT', '10', 'bx', 'Indirect', 'General Supply Material', 'Kitting', 0),
(380, 'Material73', 'Description of Material73', 'MASMO1 (T00003)', 'Location BU', '20', 'kg', 'Direct', 'Critical', 'Supervisor', 0),
(381, 'Material74', 'Description of Material74', 'MASMO1 (T00008)', 'Location BV', '30', 'kg', 'Indirect', 'Non-critical', 'Kitting', 0),
(382, 'Material75', 'Description of Material75', 'MASMOA', 'Location BW', '40', 'ea', 'Direct', 'General Supply Material', 'Supervisor', 0),
(383, 'Material76', 'Description of Material76', 'MASMOB', 'Location BX', '50', 'kg', 'Indirect', 'Critical', 'Kitting', 0),
(384, 'Material77', 'Description of Material77', 'MASMOC', 'Location BY', '60', 'spl', 'Direct', 'Non-critical', 'Supervisor', 0),
(385, 'Material78', 'Description of Material78', 'MASMOD', 'Location BZ', '70', 'kg', 'Indirect', 'General Supply Material', 'Kitting', 0),
(386, 'Material79', 'Description of Material79', 'MASMOG', 'Location CA', '30', 'kg', 'Direct', 'Critical', 'Supervisor', 0),
(387, 'Material80', 'Description of Material80', 'MASMOK', 'Location CB', '100', 'bx', 'Indirect', 'Non-critical', 'Kitting', 0),
(388, 'Material81', 'Description of Material81', 'MASMOL', 'Location CC', '60', 'm', 'Direct', 'General Supply Material', 'Supervisor', 0),
(389, 'Material82', 'Description of Material82', 'MASMO1 (T00003)', 'Location CD', '70', 'rol', 'Indirect', 'Critical', 'Kitting', 0),
(390, 'Material83', 'Description of Material83', 'MASMO1 (T00008)', 'Location CE', '40', 'bx', 'Direct', 'Non-critical', 'Supervisor', 0),
(391, 'Material84', 'Description of Material84', 'MASMOA', 'Location CF', '80', 'spl', 'Indirect', 'General Supply Material', 'Kitting', 0),
(392, 'Material85', 'Description of Material85', 'MASMOB', 'Location CG', '25', 'ea', 'Direct', 'Critical', 'Supervisor', 0),
(393, 'Material86', 'Description of Material86', 'MASMOC', 'Location CH', '10', 'kg', 'Indirect', 'Non-critical', 'Kitting', 0),
(394, 'Material87', 'Description of Material87', 'MASMOD', 'Location CI', '50', 'kg', 'Direct', 'General Supply Material', 'Supervisor', 0),
(395, 'Material88', 'Description of Material88', 'MASMOG', 'Location CJ', '40', 'ea', 'Indirect', 'Critical', 'Kitting', 0),
(396, 'Material89', 'Description of Material89', 'MASMOK', 'Location CK', '30', 'kg', 'Direct', 'Non-critical', 'Supervisor', 0),
(397, 'Material90', 'Description of Material90', 'MASMOL', 'Location CL', '60', 'bx', 'Indirect', 'General Supply Material', 'Kitting', 0),
(398, 'Material91', 'Description of Material91', 'MASMO1 (T00003)', 'Location CM', '25', 'spl', 'Direct', 'Critical', 'Supervisor', 0),
(399, 'Material92', 'Description of Material92', 'MASMO1 (T00008)', 'Location CN', '70', 'kg', 'Indirect', 'Non-critical', 'Kitting', 0),
(400, 'Material93', 'Description of Material93', 'MASMOA', 'Location CO', '20', 'ea', 'Direct', 'General Supply Material', 'Supervisor', 0),
(401, 'Material94', 'Description of Material94', 'MASMOB', 'Location CP', '50', 'kg', 'Indirect', 'Critical', 'Kitting', 0),
(402, 'Material95', 'Description of Material95', 'MASMOC', 'Location CQ', '60', 'm', 'Direct', 'Non-critical', 'Supervisor', 0),
(403, 'Material96', 'Description of Material96', 'MASMOD', 'Location CR', '70', 'bx', 'Indirect', 'General Supply Material', 'Kitting', 0),
(404, 'Material97', 'Description of Material97', 'MASMOG', 'Location CS', '10', 'kg', 'Direct', 'Critical', 'Supervisor', 0),
(405, 'Material98', 'Description of Material98', 'MASMOK', 'Location CT', '20', 'rol', 'Indirect', 'Non-critical', 'Kitting', 0),
(406, 'Material99', 'Description of Material99', 'MASMOL', 'Location CU', '30', 'ea', 'Direct', 'General Supply Material', 'Supervisor', 0),
(407, 'Material100', 'Description of Material100', 'MASMO1 (T00003)', 'Location CV', '50', 'bx', 'Indirect', 'Critical', 'Kitting', 0),
(408, 'Angle', 'Angle Decription', 'MASMO1 (T00008)', 'Warehouse A', '23', 'set', 'Direct', 'Non-critical', 'Kitting', 0);

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
(1, 'Nikka', 'Material Deletion', 'Nikka has deleted Material1', '2025-05-08 18:43:05', ''),
(2, 'Nikka', 'Material Deletion', 'Nikka has deleted Material10', '2025-05-08 18:43:05', ''),
(3, 'Nikka', 'Material Deletion', 'Nikka has deleted Material100', '2025-05-08 18:43:05', ''),
(4, 'Nikka', 'Material Deletion', 'Nikka has deleted Material11', '2025-05-08 18:43:05', ''),
(5, 'Nikka', 'Material Deletion', 'Nikka has deleted Material12', '2025-05-08 18:43:05', ''),
(6, 'Nikka', 'Material Deletion', 'Nikka has deleted Material13', '2025-05-08 18:43:05', ''),
(7, 'Nikka', 'Material Deletion', 'Nikka has deleted Material14', '2025-05-08 18:43:05', ''),
(8, 'Nikka', 'Material Deletion', 'Nikka has deleted Material15', '2025-05-08 18:43:05', ''),
(9, 'Nikka', 'Material Deletion', 'Nikka has deleted Material16', '2025-05-08 18:43:05', ''),
(10, 'Nikka', 'Material Deletion', 'Nikka has deleted Material17', '2025-05-08 18:43:05', ''),
(11, 'Nikka', 'Material Deletion', 'Nikka has deleted Material18', '2025-05-08 18:43:05', ''),
(12, 'Nikka', 'Material Deletion', 'Nikka has deleted Material19', '2025-05-08 18:43:05', ''),
(13, 'Nikka', 'Material Deletion', 'Nikka has deleted Material2', '2025-05-08 18:43:05', ''),
(14, 'Nikka', 'Material Deletion', 'Nikka has deleted Material20', '2025-05-08 18:43:05', ''),
(15, 'Nikka', 'Material Deletion', 'Nikka has deleted Material21', '2025-05-08 18:43:05', ''),
(16, 'Nikka', 'Material Deletion', 'Nikka has deleted Material22', '2025-05-08 18:43:05', ''),
(17, 'Nikka', 'Material Deletion', 'Nikka has deleted Material23', '2025-05-08 18:43:05', ''),
(18, 'Nikka', 'Material Deletion', 'Nikka has deleted Material24', '2025-05-08 18:43:05', ''),
(19, 'Nikka', 'Material Deletion', 'Nikka has deleted Material25', '2025-05-08 18:43:05', ''),
(20, 'Nikka', 'Material Deletion', 'Nikka has deleted Material26', '2025-05-08 18:43:05', ''),
(21, 'Nikka', 'Material Deletion', 'Nikka has deleted Material27', '2025-05-08 18:43:05', ''),
(22, 'Nikka', 'Material Deletion', 'Nikka has deleted Material28', '2025-05-08 18:43:05', ''),
(23, 'Nikka', 'Material Deletion', 'Nikka has deleted Material29', '2025-05-08 18:43:05', ''),
(24, 'Nikka', 'Material Deletion', 'Nikka has deleted Material3', '2025-05-08 18:43:05', ''),
(25, 'Nikka', 'Material Deletion', 'Nikka has deleted Material30', '2025-05-08 18:43:05', ''),
(26, 'Nikka', 'Material Deletion', 'Nikka has deleted Material31', '2025-05-08 18:43:05', ''),
(27, 'Nikka', 'Material Deletion', 'Nikka has deleted Material32', '2025-05-08 18:43:05', ''),
(28, 'Nikka', 'Material Deletion', 'Nikka has deleted Material33', '2025-05-08 18:43:05', ''),
(29, 'Nikka', 'Material Deletion', 'Nikka has deleted Material34', '2025-05-08 18:43:05', ''),
(30, 'Nikka', 'Material Deletion', 'Nikka has deleted Material35', '2025-05-08 18:43:05', ''),
(31, 'Nikka', 'Material Deletion', 'Nikka has deleted Material36', '2025-05-08 18:43:05', ''),
(32, 'Nikka', 'Material Deletion', 'Nikka has deleted Material37', '2025-05-08 18:43:05', ''),
(33, 'Nikka', 'Material Deletion', 'Nikka has deleted Material38', '2025-05-08 18:43:05', ''),
(34, 'Nikka', 'Material Deletion', 'Nikka has deleted Material39', '2025-05-08 18:43:05', ''),
(35, 'Nikka', 'Material Deletion', 'Nikka has deleted Material4', '2025-05-08 18:43:05', ''),
(36, 'Nikka', 'Material Deletion', 'Nikka has deleted Material40', '2025-05-08 18:43:05', ''),
(37, 'Nikka', 'Material Deletion', 'Nikka has deleted Material41', '2025-05-08 18:43:05', ''),
(38, 'Nikka', 'Material Deletion', 'Nikka has deleted Material42', '2025-05-08 18:43:05', ''),
(39, 'Nikka', 'Material Deletion', 'Nikka has deleted Material43', '2025-05-08 18:43:05', ''),
(40, 'Nikka', 'Material Deletion', 'Nikka has deleted Material44', '2025-05-08 18:43:05', ''),
(41, 'Nikka', 'Material Deletion', 'Nikka has deleted Material45', '2025-05-08 18:43:36', ''),
(42, 'Nikka', 'Material Deletion', 'Nikka has deleted Material46', '2025-05-08 18:43:36', ''),
(43, 'Nikka', 'Material Deletion', 'Nikka has deleted Material47', '2025-05-08 18:43:36', ''),
(44, 'Nikka', 'Material Deletion', 'Nikka has deleted Material48', '2025-05-08 18:43:36', ''),
(45, 'Nikka', 'Material Deletion', 'Nikka has deleted Material49', '2025-05-08 18:43:36', ''),
(46, 'Nikka', 'Material Deletion', 'Nikka has deleted Material5', '2025-05-08 18:43:36', ''),
(47, 'Nikka', 'Material Deletion', 'Nikka has deleted Material50', '2025-05-08 18:43:36', ''),
(48, 'Nikka', 'Material Deletion', 'Nikka has deleted Material51', '2025-05-08 18:43:36', ''),
(49, 'Nikka', 'Material Deletion', 'Nikka has deleted Material52', '2025-05-08 18:43:36', ''),
(50, 'Nikka', 'Material Deletion', 'Nikka has deleted Material53', '2025-05-08 18:43:36', ''),
(51, 'Nikka', 'Material Deletion', 'Nikka has deleted Material54', '2025-05-08 18:43:36', ''),
(52, 'Nikka', 'Material Deletion', 'Nikka has deleted Material55', '2025-05-08 18:43:36', ''),
(53, 'Nikka', 'Material Deletion', 'Nikka has deleted Material56', '2025-05-08 18:43:36', ''),
(54, 'Nikka', 'Material Deletion', 'Nikka has deleted Material57', '2025-05-08 18:43:36', ''),
(55, 'Nikka', 'Material Deletion', 'Nikka has deleted Material58', '2025-05-08 18:43:36', ''),
(56, 'Nikka', 'Material Deletion', 'Nikka has deleted Material59', '2025-05-08 18:43:36', ''),
(57, 'Nikka', 'Material Deletion', 'Nikka has deleted Material6', '2025-05-08 18:43:36', ''),
(58, 'Nikka', 'Material Deletion', 'Nikka has deleted Material60', '2025-05-08 18:43:36', ''),
(59, 'Nikka', 'Material Deletion', 'Nikka has deleted Material61', '2025-05-08 18:43:36', ''),
(60, 'Nikka', 'Material Deletion', 'Nikka has deleted Material62', '2025-05-08 18:43:36', ''),
(61, 'Nikka', 'Material Deletion', 'Nikka has deleted Material63', '2025-05-08 18:43:58', ''),
(62, 'Nikka', 'Material Deletion', 'Nikka has deleted Material64', '2025-05-08 18:43:58', ''),
(63, 'Nikka', 'Material Deletion', 'Nikka has deleted Material65', '2025-05-08 18:43:58', ''),
(64, 'Nikka', 'Material Deletion', 'Nikka has deleted Material66', '2025-05-08 18:43:58', ''),
(65, 'Nikka', 'Material Deletion', 'Nikka has deleted Material67', '2025-05-08 18:43:58', ''),
(66, 'Nikka', 'Material Deletion', 'Nikka has deleted Material68', '2025-05-08 18:43:58', ''),
(67, 'Nikka', 'Material Deletion', 'Nikka has deleted Material69', '2025-05-08 18:43:58', ''),
(68, 'Nikka', 'Material Deletion', 'Nikka has deleted Material7', '2025-05-08 18:43:58', ''),
(69, 'Nikka', 'Material Deletion', 'Nikka has deleted Material70', '2025-05-08 18:43:58', ''),
(70, 'Nikka', 'Material Deletion', 'Nikka has deleted Material71', '2025-05-08 18:43:58', ''),
(71, 'Nikka', 'Material Deletion', 'Nikka has deleted Material72', '2025-05-08 18:43:58', ''),
(72, 'Nikka', 'Material Deletion', 'Nikka has deleted Material73', '2025-05-08 18:43:58', ''),
(73, 'Nikka', 'Material Deletion', 'Nikka has deleted Material74', '2025-05-08 18:43:58', ''),
(74, 'Nikka', 'Material Deletion', 'Nikka has deleted Material75', '2025-05-08 18:43:58', ''),
(75, 'Nikka', 'Material Deletion', 'Nikka has deleted Material76', '2025-05-08 18:43:58', ''),
(76, 'Nikka', 'Material Deletion', 'Nikka has deleted Material77', '2025-05-08 18:43:58', ''),
(77, 'Nikka', 'Material Deletion', 'Nikka has deleted Material78', '2025-05-08 18:43:58', ''),
(78, 'Nikka', 'Material Deletion', 'Nikka has deleted Material79', '2025-05-08 18:43:58', ''),
(79, 'Nikka', 'Material Deletion', 'Nikka has deleted Material8', '2025-05-08 18:43:58', ''),
(80, 'Nikka', 'Material Deletion', 'Nikka has deleted Material80', '2025-05-08 18:43:58', ''),
(81, 'Nikka', 'Material Deletion', 'Nikka has deleted Material81', '2025-05-08 18:44:05', ''),
(82, 'Nikka', 'Material Deletion', 'Nikka has deleted Material82', '2025-05-08 18:44:05', ''),
(83, 'Nikka', 'Material Deletion', 'Nikka has deleted Material83', '2025-05-08 18:44:05', ''),
(84, 'Nikka', 'Material Deletion', 'Nikka has deleted Material84', '2025-05-08 18:44:05', ''),
(85, 'Nikka', 'Material Deletion', 'Nikka has deleted Material85', '2025-05-08 18:44:05', ''),
(86, 'Nikka', 'Material Deletion', 'Nikka has deleted Material86', '2025-05-08 18:44:05', ''),
(87, 'Nikka', 'Material Deletion', 'Nikka has deleted Material87', '2025-05-08 18:44:05', ''),
(88, 'Nikka', 'Material Deletion', 'Nikka has deleted Material88', '2025-05-08 18:44:05', ''),
(89, 'Nikka', 'Material Deletion', 'Nikka has deleted Material89', '2025-05-08 18:44:05', ''),
(90, 'Nikka', 'Material Deletion', 'Nikka has deleted Material9', '2025-05-08 18:44:05', ''),
(91, 'Nikka', 'Material Deletion', 'Nikka has deleted Material90', '2025-05-08 18:44:05', ''),
(92, 'Nikka', 'Material Deletion', 'Nikka has deleted Material91', '2025-05-08 18:44:05', ''),
(93, 'Nikka', 'Material Deletion', 'Nikka has deleted Material92', '2025-05-08 18:44:05', ''),
(94, 'Nikka', 'Material Deletion', 'Nikka has deleted Material93', '2025-05-08 18:44:05', ''),
(95, 'Nikka', 'Material Deletion', 'Nikka has deleted Material94', '2025-05-08 18:44:05', ''),
(96, 'Nikka', 'Material Deletion', 'Nikka has deleted Material95', '2025-05-08 18:44:05', ''),
(97, 'Nikka', 'Material Deletion', 'Nikka has deleted Material96', '2025-05-08 18:44:05', ''),
(98, 'Nikka', 'Material Deletion', 'Nikka has deleted Material97', '2025-05-08 18:44:05', ''),
(99, 'Nikka', 'Material Deletion', 'Nikka has deleted Material98', '2025-05-08 18:44:05', ''),
(100, 'Nikka', 'Material Deletion', 'Nikka has deleted Material99', '2025-05-08 18:44:05', ''),
(101, 'Nikka', 'Material Registration', 'Nikka has registered a new material p10006.', '2025-05-08 18:46:17', ''),
(102, 'Nikka', 'Material Registration', 'Nikka has registered a new material p10007.', '2025-05-08 18:46:17', ''),
(104, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Maan Del Mundo.', '2025-05-08 20:02:20', ''),
(105, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Pako Del Mundo.', '2025-05-08 20:03:35', ''),
(106, 'Nikka', 'Password changed', 'Nikka has updated the password for Pako account.', '2025-05-08 20:05:35', ''),
(107, 'Nikka', 'Account Registration', 'Nikka has created an account for Niel Del Mundo.', '2025-05-08 20:06:51', ''),
(108, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Maan Lacatan Del Mundo', '2025-05-08 20:07:46', ''),
(109, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of Pako Del Mundo.', '2025-05-08 20:08:03', 'Panget'),
(110, 'Nikka', 'Cost Center Registration', 'Nikka has successfully registered a new PAKO in the system.', '2025-05-08 20:08:53', ''),
(111, 'Nikka', 'Cost Center Modification', 'Nikka has successfully updated the details of the PAKO POGI in the system.', '2025-05-08 20:09:17', ''),
(113, 'Nikka', 'Material Deletion', 'Nikka has deleted Material1', '2025-05-08 20:09:59', ''),
(114, 'Nikka', 'Material Deletion', 'Nikka has deleted Material10', '2025-05-08 20:09:59', ''),
(115, 'Nikka', 'Material Deletion', 'Nikka has deleted Material100', '2025-05-08 20:09:59', ''),
(116, 'Nikka', 'Material Deletion', 'Nikka has deleted Material11', '2025-05-08 20:09:59', ''),
(117, 'Nikka', 'Material Deletion', 'Nikka has deleted Material12', '2025-05-08 20:09:59', ''),
(118, 'Nikka', 'Material Deletion', 'Nikka has deleted Material13', '2025-05-08 20:09:59', ''),
(119, 'Nikka', 'Material Deletion', 'Nikka has deleted Material14', '2025-05-08 20:09:59', ''),
(120, 'Nikka', 'Material Deletion', 'Nikka has deleted Material15', '2025-05-08 20:09:59', ''),
(121, 'Nikka', 'Material Deletion', 'Nikka has deleted Material16', '2025-05-08 20:09:59', ''),
(122, 'Nikka', 'Material Deletion', 'Nikka has deleted Material17', '2025-05-08 20:09:59', ''),
(123, 'Nikka', 'Material Deletion', 'Nikka has deleted Material18', '2025-05-08 20:09:59', ''),
(124, 'Nikka', 'Material Deletion', 'Nikka has deleted Material19', '2025-05-08 20:09:59', ''),
(125, 'Nikka', 'Material Deletion', 'Nikka has deleted Material2', '2025-05-08 20:09:59', ''),
(126, 'Nikka', 'Material Deletion', 'Nikka has deleted Material20', '2025-05-08 20:09:59', ''),
(127, 'Nikka', 'Material Deletion', 'Nikka has deleted Material21', '2025-05-08 20:09:59', ''),
(128, 'Nikka', 'Material Deletion', 'Nikka has deleted Material22', '2025-05-08 20:09:59', ''),
(129, 'Nikka', 'Material Deletion', 'Nikka has deleted Material23', '2025-05-08 20:09:59', ''),
(130, 'Nikka', 'Material Deletion', 'Nikka has deleted Material24', '2025-05-08 20:09:59', ''),
(131, 'Nikka', 'Material Deletion', 'Nikka has deleted Material25', '2025-05-08 20:09:59', ''),
(132, 'Nikka', 'Material Deletion', 'Nikka has deleted Material26', '2025-05-08 20:09:59', ''),
(133, 'Nikka', 'Material Deletion', 'Nikka has deleted Material27', '2025-05-08 20:09:59', ''),
(134, 'Nikka', 'Material Deletion', 'Nikka has deleted Material28', '2025-05-08 20:09:59', ''),
(135, 'Nikka', 'Material Deletion', 'Nikka has deleted Material29', '2025-05-08 20:09:59', ''),
(136, 'Nikka', 'Material Deletion', 'Nikka has deleted Material3', '2025-05-08 20:09:59', ''),
(137, 'Nikka', 'Material Deletion', 'Nikka has deleted Material30', '2025-05-08 20:09:59', ''),
(138, 'Nikka', 'Material Deletion', 'Nikka has deleted Material31', '2025-05-08 20:09:59', ''),
(139, 'Nikka', 'Material Deletion', 'Nikka has deleted Material32', '2025-05-08 20:09:59', ''),
(140, 'Nikka', 'Material Deletion', 'Nikka has deleted Material33', '2025-05-08 20:09:59', ''),
(141, 'Nikka', 'Material Deletion', 'Nikka has deleted Material34', '2025-05-08 20:09:59', ''),
(142, 'Nikka', 'Material Deletion', 'Nikka has deleted Material35', '2025-05-08 20:09:59', ''),
(143, 'Nikka', 'Material Deletion', 'Nikka has deleted Material36', '2025-05-08 20:09:59', ''),
(144, 'Nikka', 'Material Deletion', 'Nikka has deleted Material37', '2025-05-08 20:09:59', ''),
(145, 'Nikka', 'Material Deletion', 'Nikka has deleted Material38', '2025-05-08 20:09:59', ''),
(146, 'Nikka', 'Material Deletion', 'Nikka has deleted Material39', '2025-05-08 20:09:59', ''),
(147, 'Nikka', 'Material Deletion', 'Nikka has deleted Material4', '2025-05-08 20:09:59', ''),
(148, 'Nikka', 'Material Deletion', 'Nikka has deleted Material40', '2025-05-08 20:09:59', ''),
(149, 'Nikka', 'Material Deletion', 'Nikka has deleted Material41', '2025-05-08 20:09:59', ''),
(150, 'Nikka', 'Material Deletion', 'Nikka has deleted Material42', '2025-05-08 20:09:59', ''),
(151, 'Nikka', 'Material Deletion', 'Nikka has deleted Material43', '2025-05-08 20:09:59', ''),
(152, 'Nikka', 'Material Deletion', 'Nikka has deleted Material44', '2025-05-08 20:09:59', ''),
(153, 'Nikka', 'Material Deletion', 'Nikka has deleted Material45', '2025-05-08 20:09:59', ''),
(154, 'Nikka', 'Material Deletion', 'Nikka has deleted Material46', '2025-05-08 20:09:59', ''),
(155, 'Nikka', 'Material Deletion', 'Nikka has deleted Material47', '2025-05-08 20:09:59', ''),
(156, 'Nikka', 'Material Deletion', 'Nikka has deleted Material48', '2025-05-08 20:09:59', ''),
(157, 'Nikka', 'Material Deletion', 'Nikka has deleted Material49', '2025-05-08 20:09:59', ''),
(158, 'Nikka', 'Material Deletion', 'Nikka has deleted Material5', '2025-05-08 20:09:59', ''),
(159, 'Nikka', 'Material Deletion', 'Nikka has deleted Material50', '2025-05-08 20:09:59', ''),
(160, 'Nikka', 'Material Deletion', 'Nikka has deleted Material51', '2025-05-08 20:09:59', ''),
(161, 'Nikka', 'Material Deletion', 'Nikka has deleted Material52', '2025-05-08 20:09:59', ''),
(162, 'Nikka', 'Material Deletion', 'Nikka has deleted Material53', '2025-05-08 20:09:59', ''),
(163, 'Nikka', 'Material Deletion', 'Nikka has deleted Material54', '2025-05-08 20:09:59', ''),
(164, 'Nikka', 'Material Deletion', 'Nikka has deleted Material55', '2025-05-08 20:09:59', ''),
(165, 'Nikka', 'Material Deletion', 'Nikka has deleted Material56', '2025-05-08 20:09:59', ''),
(166, 'Nikka', 'Material Deletion', 'Nikka has deleted Material57', '2025-05-08 20:09:59', ''),
(167, 'Nikka', 'Material Deletion', 'Nikka has deleted Material58', '2025-05-08 20:09:59', ''),
(168, 'Nikka', 'Material Deletion', 'Nikka has deleted Material59', '2025-05-08 20:09:59', ''),
(169, 'Nikka', 'Material Deletion', 'Nikka has deleted Material6', '2025-05-08 20:09:59', ''),
(170, 'Nikka', 'Material Deletion', 'Nikka has deleted Material60', '2025-05-08 20:09:59', ''),
(171, 'Nikka', 'Material Deletion', 'Nikka has deleted Material61', '2025-05-08 20:09:59', ''),
(172, 'Nikka', 'Material Deletion', 'Nikka has deleted Material62', '2025-05-08 20:09:59', ''),
(173, 'Nikka', 'Material Deletion', 'Nikka has deleted Material63', '2025-05-08 20:09:59', ''),
(174, 'Nikka', 'Material Deletion', 'Nikka has deleted Material64', '2025-05-08 20:09:59', ''),
(175, 'Nikka', 'Material Deletion', 'Nikka has deleted Material65', '2025-05-08 20:09:59', ''),
(176, 'Nikka', 'Material Deletion', 'Nikka has deleted Material66', '2025-05-08 20:09:59', ''),
(177, 'Nikka', 'Material Deletion', 'Nikka has deleted Material67', '2025-05-08 20:09:59', ''),
(178, 'Nikka', 'Material Deletion', 'Nikka has deleted Material68', '2025-05-08 20:09:59', ''),
(179, 'Nikka', 'Material Deletion', 'Nikka has deleted Material69', '2025-05-08 20:09:59', ''),
(180, 'Nikka', 'Material Deletion', 'Nikka has deleted Material7', '2025-05-08 20:09:59', ''),
(181, 'Nikka', 'Material Deletion', 'Nikka has deleted Material70', '2025-05-08 20:09:59', ''),
(182, 'Nikka', 'Material Deletion', 'Nikka has deleted Material71', '2025-05-08 20:09:59', ''),
(183, 'Nikka', 'Material Deletion', 'Nikka has deleted Material72', '2025-05-08 20:09:59', ''),
(184, 'Nikka', 'Material Deletion', 'Nikka has deleted Material73', '2025-05-08 20:09:59', ''),
(185, 'Nikka', 'Material Deletion', 'Nikka has deleted Material74', '2025-05-08 20:09:59', ''),
(186, 'Nikka', 'Material Deletion', 'Nikka has deleted Material75', '2025-05-08 20:09:59', ''),
(187, 'Nikka', 'Material Deletion', 'Nikka has deleted Material76', '2025-05-08 20:09:59', ''),
(188, 'Nikka', 'Material Deletion', 'Nikka has deleted Material77', '2025-05-08 20:09:59', ''),
(189, 'Nikka', 'Material Deletion', 'Nikka has deleted Material78', '2025-05-08 20:09:59', ''),
(190, 'Nikka', 'Material Deletion', 'Nikka has deleted Material79', '2025-05-08 20:09:59', ''),
(191, 'Nikka', 'Material Deletion', 'Nikka has deleted Material8', '2025-05-08 20:09:59', ''),
(192, 'Nikka', 'Material Deletion', 'Nikka has deleted Material80', '2025-05-08 20:09:59', ''),
(193, 'Nikka', 'Material Deletion', 'Nikka has deleted Material81', '2025-05-08 20:09:59', ''),
(194, 'Nikka', 'Material Deletion', 'Nikka has deleted Material82', '2025-05-08 20:09:59', ''),
(195, 'Nikka', 'Material Deletion', 'Nikka has deleted Material83', '2025-05-08 20:09:59', ''),
(196, 'Nikka', 'Material Deletion', 'Nikka has deleted Material84', '2025-05-08 20:09:59', ''),
(197, 'Nikka', 'Material Deletion', 'Nikka has deleted Material85', '2025-05-08 20:09:59', ''),
(198, 'Nikka', 'Material Deletion', 'Nikka has deleted Material86', '2025-05-08 20:09:59', ''),
(199, 'Nikka', 'Material Deletion', 'Nikka has deleted Material87', '2025-05-08 20:09:59', ''),
(200, 'Nikka', 'Material Deletion', 'Nikka has deleted Material88', '2025-05-08 20:09:59', ''),
(201, 'Nikka', 'Material Deletion', 'Nikka has deleted Material89', '2025-05-08 20:09:59', ''),
(202, 'Nikka', 'Material Deletion', 'Nikka has deleted Material9', '2025-05-08 20:09:59', ''),
(203, 'Nikka', 'Material Deletion', 'Nikka has deleted Material90', '2025-05-08 20:09:59', ''),
(204, 'Nikka', 'Material Deletion', 'Nikka has deleted Material91', '2025-05-08 20:09:59', ''),
(205, 'Nikka', 'Material Deletion', 'Nikka has deleted Material92', '2025-05-08 20:09:59', ''),
(206, 'Nikka', 'Material Deletion', 'Nikka has deleted Material93', '2025-05-08 20:09:59', ''),
(207, 'Nikka', 'Material Deletion', 'Nikka has deleted Material94', '2025-05-08 20:09:59', ''),
(208, 'Nikka', 'Material Deletion', 'Nikka has deleted Material95', '2025-05-08 20:09:59', ''),
(209, 'Nikka', 'Material Deletion', 'Nikka has deleted Material96', '2025-05-08 20:09:59', ''),
(210, 'Nikka', 'Material Deletion', 'Nikka has deleted Material97', '2025-05-08 20:09:59', ''),
(211, 'Nikka', 'Material Deletion', 'Nikka has deleted Material98', '2025-05-08 20:09:59', ''),
(212, 'Nikka', 'Material Deletion', 'Nikka has deleted Material99', '2025-05-08 20:09:59', ''),
(213, 'Nikka', 'Material Deletion', 'Nikka has deleted p10006', '2025-05-08 20:09:59', ''),
(214, 'Nikka', 'Material Deletion', 'Nikka has deleted p10007', '2025-05-08 20:09:59', ''),
(215, 'Nikka', 'Material Registration', 'Nikka has registered a new material p10001.', '2025-05-08 20:12:40', ''),
(216, 'Nikka', 'Material Registration', 'Nikka has registered a new material p20002.', '2025-05-08 20:12:40', ''),
(217, 'Nikka', 'Material Registration', 'Nikka has registered a new material p30003.', '2025-05-08 20:12:40', ''),
(218, 'Nikka', 'Material Registration', 'Nikka has registered a new material p40004.', '2025-05-08 20:13:28', ''),
(219, 'Nikka', 'Material Registration', 'Nikka has registered a new material p50005.', '2025-05-08 20:13:28', ''),
(220, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p10001', '2025-05-08 20:15:48', ''),
(221, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p20002', '2025-05-08 20:15:48', ''),
(222, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p30003', '2025-05-08 20:15:48', ''),
(223, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p40004', '2025-05-08 20:15:48', ''),
(224, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p50005', '2025-05-08 20:15:48', ''),
(225, 'Nikka', 'Material Deletion', 'Nikka has deleted p50005', '2025-05-08 20:16:19', ''),
(226, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Niel Del Mundo', '2025-05-08 20:16:57', ''),
(227, 'Nikka', 'Material Deletion', 'Nikka has deleted Material1', '2025-05-09 00:07:01', ''),
(228, 'Nikka', 'Material Deletion', 'Nikka has deleted Material10', '2025-05-09 00:07:01', ''),
(229, 'Nikka', 'Material Deletion', 'Nikka has deleted Material100', '2025-05-09 00:07:01', ''),
(230, 'Nikka', 'Material Deletion', 'Nikka has deleted Material11', '2025-05-09 00:07:01', ''),
(231, 'Nikka', 'Material Deletion', 'Nikka has deleted Material12', '2025-05-09 00:11:49', ''),
(232, 'Nikka', 'Material Deletion', 'Nikka has deleted Material13', '2025-05-09 00:11:49', ''),
(233, 'Nikka', 'Material Deletion', 'Nikka has deleted Material14', '2025-05-09 00:11:49', ''),
(234, 'Nikka', 'Material Deletion', 'Nikka has deleted Material15', '2025-05-09 00:11:49', ''),
(235, 'Nikka', 'Material Deletion', 'Nikka has deleted Material16', '2025-05-09 00:11:49', ''),
(236, 'Nikka', 'Material Deletion', 'Nikka has deleted Material17', '2025-05-09 00:11:49', ''),
(237, 'Nikka', 'Material Deletion', 'Nikka has deleted Material18', '2025-05-09 00:11:49', ''),
(238, 'Nikka', 'Material Deletion', 'Nikka has deleted Material19', '2025-05-09 00:11:49', ''),
(239, 'Nikka', 'Material Deletion', 'Nikka has deleted Material2', '2025-05-09 00:11:49', ''),
(240, 'Nikka', 'Material Deletion', 'Nikka has deleted Material20', '2025-05-09 00:11:49', ''),
(241, 'Nikka', 'Material Deletion', 'Nikka has deleted Material21', '2025-05-09 00:11:49', ''),
(242, 'Nikka', 'Material Deletion', 'Nikka has deleted Material22', '2025-05-09 00:11:49', ''),
(243, 'Nikka', 'Material Deletion', 'Nikka has deleted Material23', '2025-05-09 00:11:49', ''),
(244, 'Nikka', 'Material Deletion', 'Nikka has deleted Material24', '2025-05-09 00:11:49', ''),
(245, 'Nikka', 'Material Deletion', 'Nikka has deleted Material25', '2025-05-09 00:11:49', ''),
(246, 'Nikka', 'Material Deletion', 'Nikka has deleted Material26', '2025-05-09 00:11:49', ''),
(247, 'Nikka', 'Material Deletion', 'Nikka has deleted Material27', '2025-05-09 00:11:49', ''),
(248, 'Nikka', 'Material Deletion', 'Nikka has deleted Material28', '2025-05-09 00:11:49', ''),
(249, 'Nikka', 'Material Deletion', 'Nikka has deleted Material29', '2025-05-09 00:11:49', ''),
(250, 'Nikka', 'Material Deletion', 'Nikka has deleted Material3', '2025-05-09 00:11:49', ''),
(251, 'Nikka', 'Material Deletion', 'Nikka has deleted Material30', '2025-05-09 00:11:49', ''),
(252, 'Nikka', 'Material Deletion', 'Nikka has deleted Material31', '2025-05-09 00:11:49', ''),
(253, 'Nikka', 'Material Deletion', 'Nikka has deleted Material32', '2025-05-09 00:11:49', ''),
(254, 'Nikka', 'Material Deletion', 'Nikka has deleted Material33', '2025-05-09 00:11:50', ''),
(255, 'Nikka', 'Material Deletion', 'Nikka has deleted Material34', '2025-05-09 00:11:50', ''),
(256, 'Nikka', 'Material Deletion', 'Nikka has deleted Material35', '2025-05-09 00:11:50', ''),
(257, 'Nikka', 'Material Deletion', 'Nikka has deleted Material36', '2025-05-09 00:11:50', ''),
(258, 'Nikka', 'Material Deletion', 'Nikka has deleted Material37', '2025-05-09 00:11:50', ''),
(259, 'Nikka', 'Material Deletion', 'Nikka has deleted Material38', '2025-05-09 00:11:50', ''),
(260, 'Nikka', 'Material Deletion', 'Nikka has deleted Material39', '2025-05-09 00:11:50', ''),
(261, 'Nikka', 'Material Deletion', 'Nikka has deleted Material4', '2025-05-09 00:11:50', ''),
(262, 'Nikka', 'Material Deletion', 'Nikka has deleted Material40', '2025-05-09 00:11:50', ''),
(263, 'Nikka', 'Material Deletion', 'Nikka has deleted Material41', '2025-05-09 00:11:50', ''),
(264, 'Nikka', 'Material Deletion', 'Nikka has deleted Material42', '2025-05-09 00:11:50', ''),
(265, 'Nikka', 'Material Deletion', 'Nikka has deleted Material43', '2025-05-09 00:11:50', ''),
(266, 'Nikka', 'Material Deletion', 'Nikka has deleted Material44', '2025-05-09 00:11:50', ''),
(267, 'Nikka', 'Material Deletion', 'Nikka has deleted Material45', '2025-05-09 00:11:50', ''),
(268, 'Nikka', 'Material Deletion', 'Nikka has deleted Material46', '2025-05-09 00:11:50', ''),
(269, 'Nikka', 'Material Deletion', 'Nikka has deleted Material47', '2025-05-09 00:11:50', ''),
(270, 'Nikka', 'Material Deletion', 'Nikka has deleted Material48', '2025-05-09 00:11:50', ''),
(271, 'Nikka', 'Material Deletion', 'Nikka has deleted Material49', '2025-05-09 00:11:50', ''),
(272, 'Nikka', 'Material Deletion', 'Nikka has deleted Material5', '2025-05-09 00:11:50', ''),
(273, 'Nikka', 'Material Deletion', 'Nikka has deleted Material50', '2025-05-09 00:11:50', ''),
(274, 'Nikka', 'Material Deletion', 'Nikka has deleted Material51', '2025-05-09 00:11:50', ''),
(275, 'Nikka', 'Material Deletion', 'Nikka has deleted Material52', '2025-05-09 00:11:50', ''),
(276, 'Nikka', 'Material Deletion', 'Nikka has deleted Material53', '2025-05-09 00:11:50', ''),
(277, 'Nikka', 'Material Deletion', 'Nikka has deleted Material54', '2025-05-09 00:11:50', ''),
(278, 'Nikka', 'Material Deletion', 'Nikka has deleted Material55', '2025-05-09 00:11:50', ''),
(279, 'Nikka', 'Material Deletion', 'Nikka has deleted Material56', '2025-05-09 00:11:50', ''),
(280, 'Nikka', 'Material Deletion', 'Nikka has deleted Material57', '2025-05-09 00:11:50', ''),
(281, 'Nikka', 'Material Deletion', 'Nikka has deleted Material58', '2025-05-09 00:11:50', ''),
(282, 'Nikka', 'Material Deletion', 'Nikka has deleted Material59', '2025-05-09 00:11:50', ''),
(283, 'Nikka', 'Material Deletion', 'Nikka has deleted Material6', '2025-05-09 00:11:50', ''),
(284, 'Nikka', 'Material Deletion', 'Nikka has deleted Material60', '2025-05-09 00:11:50', ''),
(285, 'Nikka', 'Material Deletion', 'Nikka has deleted Material61', '2025-05-09 00:11:50', ''),
(286, 'Nikka', 'Material Deletion', 'Nikka has deleted Material62', '2025-05-09 00:11:50', ''),
(287, 'Nikka', 'Material Deletion', 'Nikka has deleted Material63', '2025-05-09 00:11:50', ''),
(288, 'Nikka', 'Material Deletion', 'Nikka has deleted Material64', '2025-05-09 00:11:50', ''),
(289, 'Nikka', 'Material Deletion', 'Nikka has deleted Material65', '2025-05-09 00:11:50', ''),
(290, 'Nikka', 'Material Deletion', 'Nikka has deleted Material66', '2025-05-09 00:11:50', ''),
(291, 'Nikka', 'Material Deletion', 'Nikka has deleted Material67', '2025-05-09 00:11:50', ''),
(292, 'Nikka', 'Material Deletion', 'Nikka has deleted Material68', '2025-05-09 00:11:50', ''),
(293, 'Nikka', 'Material Deletion', 'Nikka has deleted Material69', '2025-05-09 00:11:50', ''),
(294, 'Nikka', 'Material Deletion', 'Nikka has deleted Material7', '2025-05-09 00:11:50', ''),
(295, 'Nikka', 'Material Deletion', 'Nikka has deleted Material70', '2025-05-09 00:11:50', ''),
(296, 'Nikka', 'Material Deletion', 'Nikka has deleted Material71', '2025-05-09 00:11:50', ''),
(297, 'Nikka', 'Material Deletion', 'Nikka has deleted Material72', '2025-05-09 00:11:50', ''),
(298, 'Nikka', 'Material Deletion', 'Nikka has deleted Material73', '2025-05-09 00:11:50', ''),
(299, 'Nikka', 'Material Deletion', 'Nikka has deleted Material74', '2025-05-09 00:11:50', ''),
(300, 'Nikka', 'Material Deletion', 'Nikka has deleted Material75', '2025-05-09 00:11:50', ''),
(301, 'Nikka', 'Material Deletion', 'Nikka has deleted Material76', '2025-05-09 00:11:50', ''),
(302, 'Nikka', 'Material Deletion', 'Nikka has deleted Material77', '2025-05-09 00:11:50', ''),
(303, 'Nikka', 'Material Deletion', 'Nikka has deleted Material78', '2025-05-09 00:11:50', ''),
(304, 'Nikka', 'Material Deletion', 'Nikka has deleted Material79', '2025-05-09 00:11:50', ''),
(305, 'Nikka', 'Material Deletion', 'Nikka has deleted Material8', '2025-05-09 00:11:50', ''),
(306, 'Nikka', 'Material Deletion', 'Nikka has deleted Material80', '2025-05-09 00:11:50', ''),
(307, 'Nikka', 'Material Deletion', 'Nikka has deleted Material81', '2025-05-09 00:11:50', ''),
(308, 'Nikka', 'Material Deletion', 'Nikka has deleted Material82', '2025-05-09 00:11:50', ''),
(309, 'Nikka', 'Material Deletion', 'Nikka has deleted Material83', '2025-05-09 00:11:50', ''),
(310, 'Nikka', 'Material Deletion', 'Nikka has deleted Material84', '2025-05-09 00:11:50', ''),
(311, 'Nikka', 'Material Deletion', 'Nikka has deleted Material85', '2025-05-09 00:11:50', ''),
(312, 'Nikka', 'Material Deletion', 'Nikka has deleted Material86', '2025-05-09 00:11:50', ''),
(313, 'Nikka', 'Material Deletion', 'Nikka has deleted Material87', '2025-05-09 00:11:50', ''),
(314, 'Nikka', 'Material Deletion', 'Nikka has deleted Material88', '2025-05-09 00:11:50', ''),
(315, 'Nikka', 'Material Deletion', 'Nikka has deleted Material89', '2025-05-09 00:11:50', ''),
(316, 'Nikka', 'Material Deletion', 'Nikka has deleted Material9', '2025-05-09 00:11:50', ''),
(317, 'Nikka', 'Material Deletion', 'Nikka has deleted Material90', '2025-05-09 00:11:50', ''),
(318, 'Nikka', 'Material Deletion', 'Nikka has deleted Material91', '2025-05-09 00:11:50', ''),
(319, 'Nikka', 'Material Deletion', 'Nikka has deleted Material92', '2025-05-09 00:11:50', ''),
(320, 'Nikka', 'Material Deletion', 'Nikka has deleted Material93', '2025-05-09 00:11:50', ''),
(321, 'Nikka', 'Material Deletion', 'Nikka has deleted Material94', '2025-05-09 00:11:50', ''),
(322, 'Nikka', 'Material Deletion', 'Nikka has deleted Material95', '2025-05-09 00:11:50', ''),
(323, 'Nikka', 'Material Deletion', 'Nikka has deleted Material96', '2025-05-09 00:11:50', ''),
(324, 'Nikka', 'Material Deletion', 'Nikka has deleted Material97', '2025-05-09 00:11:50', ''),
(325, 'Nikka', 'Material Deletion', 'Nikka has deleted Material98', '2025-05-09 00:11:50', ''),
(326, 'Nikka', 'Material Deletion', 'Nikka has deleted Material99', '2025-05-09 00:11:50', ''),
(327, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p10001', '2025-05-09 14:55:18', ''),
(328, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p20002', '2025-05-09 14:55:18', ''),
(329, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p30003', '2025-05-09 14:55:18', ''),
(330, 'Nikka', 'Edit Material Details', 'Nikka has updated the details of material p10001', '2025-05-09 14:55:18', ''),
(331, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Maan Lacatan Del Mundo', '2025-05-09 15:15:33', ''),
(332, 'Nikka', 'Material Registration', 'Nikka has registered a new material Angle.', '2025-05-09 15:19:12', ''),
(333, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of  Marinel Nikka Zagala', '2025-05-09 19:57:12', ''),
(334, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Maan Lacatan Del Mundo', '2025-05-09 19:57:12', ''),
(335, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Niel Del Mundo', '2025-05-09 19:57:12', ''),
(336, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of  Marinel Nikka Zagala', '2025-05-09 19:57:28', ''),
(337, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Maan Lacatan Del Mundo', '2025-05-09 19:57:28', ''),
(338, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Niel Del Mundo', '2025-05-09 19:57:28', ''),
(339, 'Nikka', 'Machine Number Registration', 'Nikka has successfully registered a new TEST PAKO in the system.', '2025-05-09 16:51:10', ''),
(340, 'Nikka', 'Machine Number Modification', 'Nikka has successfully updated the details of the TEST PAKO NEW in the system.', '2025-05-09 16:51:21', ''),
(341, 'Nikka', 'Machine Number Deletion', 'Nikka has successfully deleted the TEST PAKO NEW from the system.', '2025-05-09 16:51:28', ''),
(342, 'Nikka', 'Station Code Registration', 'Nikka has successfully registered a new PAKO BAGO in the system.', '2025-05-09 16:51:39', ''),
(343, 'Nikka', 'Station Code Modification', 'Nikka has successfully updated the details of the PAKO BAGO NEW in the system.', '2025-05-09 16:51:45', ''),
(344, 'Nikka', 'Station Code Deletion', 'Nikka has successfully deleted the PAKO BAGO NEW from the system.', '2025-05-09 16:51:52', ''),
(345, 'Nikka', 'Withdrawal Reason Registration', 'Nikka has successfully registered a new pako okaw in the system.', '2025-05-09 16:52:05', ''),
(346, 'Nikka', 'Withdrawal Reason Modification', 'Nikka has successfully updated the details of the PAKO OKAW BAGO in the system.', '2025-05-09 16:52:13', ''),
(347, 'Nikka', 'Withdrawal Reason Deletion', 'Nikka has successfully deleted the PAKO OKAW BAGO from the system.', '2025-05-09 16:52:19', ''),
(348, 'Nikka', 'Unit of Measure Registration', 'Nikka has successfully registered a new pako in the system.', '2025-05-09 16:52:29', ''),
(349, 'Nikka', 'Unit of Measure Modification', 'Nikka has successfully updated the details of the pako bago in the system.', '2025-05-09 16:52:38', ''),
(350, 'Nikka', 'Unit of Measure Deletion', 'Nikka has successfully deleted the PAKO BAGO from the system.', '2025-05-09 16:52:44', ''),
(351, 'Nikka', 'Unit of Measure Registration', 'Nikka has successfully registered a new test in the system.', '2025-05-09 16:52:55', ''),
(352, 'Nikka', 'Unit of Measure Modification', 'Nikka has successfully updated the details of the test test in the system.', '2025-05-09 16:53:02', ''),
(353, 'Nikka', 'Unit of Measure Deletion', 'Nikka has successfully deleted the TEST TEST from the system.', '2025-05-09 16:53:07', ''),
(354, 'Nikka', 'Account Registration', 'Nikka has created an account for Miguel Garcia.', '2025-05-10 11:03:37', ''),
(355, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Miguel Garcia New', '2025-05-10 11:03:57', ''),
(356, 'Nikka', 'Cost Center Registration', 'Nikka has successfully registered a new OBSTA in the system.', '2025-05-10 11:04:36', ''),
(357, 'Nikka', 'Cost Center Modification', 'Nikka has successfully updated the details of the OBSTA new in the system.', '2025-05-10 11:05:08', ''),
(358, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Patrick Del Mundo.', '2025-05-10 11:05:32', ''),
(359, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of Raffy Tulfo.', '2025-05-10 11:05:45', ''),
(360, 'Nikka', 'Password changed', 'Nikka has updated the password for Maan account.', '2025-05-10 11:05:56', ''),
(361, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Garreth Tulfo.', '2025-05-10 11:08:25', ''),
(362, 'Nikka', 'Account Registration', 'Nikka has created an account for Naruto.', '2025-05-10 14:32:16', ''),
(363, 'Nikka', 'Account Registration', 'Nikka has created an account for Sasuke.', '2025-05-10 14:32:16', ''),
(364, 'Nikka', 'Account Registration', 'Nikka has created an account for Sakura.', '2025-05-10 14:32:16', ''),
(365, 'Nikka', 'Account Registration', 'Nikka has created an account for Kakashi.', '2025-05-10 14:32:16', ''),
(366, 'Nikka', 'Account Registration', 'Nikka has created an account for Minato.', '2025-05-10 14:32:16', ''),
(367, 'Nikka', 'Account Registration', 'Nikka has created an account for Pein.', '2025-05-10 14:32:16', ''),
(368, 'Nikka', 'Account Registration', 'Nikka has created an account for Itachi.', '2025-05-10 14:32:16', ''),
(369, 'Nikka', 'Account Registration', 'Nikka has created an account for Deidara.', '2025-05-10 14:32:16', ''),
(370, 'Nikka', 'Account Registration', 'Nikka has created an account for Sasori.', '2025-05-10 14:32:16', ''),
(371, 'Nikka', 'Account Registration', 'Nikka has created an account for Obito.', '2025-05-10 14:32:16', ''),
(372, 'Nikka', 'Account Registration', 'Nikka has created an account for Zetsu.', '2025-05-10 14:32:16', ''),
(373, 'Nikka', 'Account Registration', 'Nikka has created an account for Kizame.', '2025-05-10 14:32:16', ''),
(374, 'Nikka', 'Account Registration', 'Nikka has created an account for Konan.', '2025-05-10 14:32:16', ''),
(375, 'Nikka', 'Account Registration', 'Nikka has created an account for Test.', '2025-05-11 18:38:07', ''),
(376, 'Nikka', 'Account Registration', 'Nikka has created an account for Test 1.', '2025-05-11 18:38:46', ''),
(377, 'Nikka', 'Account Registration', 'Nikka has created an account for Test 2.', '2025-05-11 18:38:46', ''),
(378, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Test bago', '2025-05-11 18:39:04', ''),
(379, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Test 1 bago', '2025-05-11 18:39:32', ''),
(380, 'Nikka', 'Account Modification', 'Nikka has made changes to the account of Test 2 bago', '2025-05-11 18:39:32', ''),
(381, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of Test bago.', '2025-05-11 18:39:44', 'test'),
(382, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of Test 1 bago.', '2025-05-11 18:42:15', 'test'),
(383, 'Nikka', 'Account Deletion', 'Nikka has deleted the account of Test 2 bago.', '2025-05-11 18:42:15', 'test'),
(384, 'Nikka', 'Cost Center Registration', 'Nikka has successfully registered a new test in the system.', '2025-05-11 18:42:37', ''),
(385, 'Nikka', 'Cost Center Registration', 'Nikka has successfully registered a new test 2 in the system.', '2025-05-11 18:42:57', ''),
(386, 'Nikka', 'Cost Center Registration', 'Nikka has successfully registered a new test 3 in the system.', '2025-05-11 18:42:57', ''),
(387, 'Nikka', 'Cost Center Modification', 'Nikka has successfully updated the details of the test bago in the system.', '2025-05-11 18:43:12', ''),
(388, 'Nikka', 'Cost Center Modification', 'Nikka has successfully updated the details of the test 2 bago in the system.', '2025-05-11 18:43:29', ''),
(389, 'Nikka', 'Cost Center Modification', 'Nikka has successfully updated the details of the test 3 bago in the system.', '2025-05-11 18:43:29', ''),
(390, 'Nikka', 'Cost Center Deletion', 'Nikka has successfully deleted the test bago from the system.', '2025-05-11 18:43:40', ''),
(391, 'Nikka', 'Cost Center Deletion', 'Nikka has successfully deleted the test 2 bago from the system.', '2025-05-11 18:43:48', 'test'),
(392, 'Nikka', 'Cost Center Deletion', 'Nikka has successfully deleted the test 3 bago from the system.', '2025-05-11 18:43:48', 'test'),
(393, 'Nikka', 'Account Registration', 'Nikka has created an account for test.', '2025-05-11 18:44:08', ''),
(394, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of test test.', '2025-05-11 18:46:37', 'test'),
(395, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of zasr.', '2025-05-11 18:46:55', 'tsets'),
(396, 'Nikka', 'Account Rejection Confirmed', 'Nikka has rejected the account registration request of tara.', '2025-05-11 18:46:55', 'testsaa'),
(397, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of Pakos.', '2025-05-11 18:47:08', ''),
(398, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of manila.', '2025-05-11 18:47:46', ''),
(399, 'Nikka', 'Account Approval Confirmed', 'Nikka has approved the account registration request of mike.', '2025-05-11 18:47:46', ''),
(400, 'Nikka', 'Password changed', 'Nikka has updated the password for manila account.', '2025-05-11 18:48:24', '');

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
(1, 'System', 'Maan Del Mundo account registration is awaiting approval.', 1, '2025-05-08 12:00:57', 'adminOnly', 'Account Registration Pending Approval'),
(2, 'System', 'Maan Del Mundo account registration is awaiting approval.', 1, '2025-05-08 12:02:06', 'adminOnly', 'Account Registration Pending Approval'),
(3, 'System', 'Pako Del Mundo account registration is awaiting approval.', 1, '2025-05-08 12:02:52', 'adminOnly', 'Account Registration Pending Approval'),
(4, 'Pako', 'Pako has requested a password change.', 1, '2025-05-08 12:05:16', 'adminOnly', 'Request password change'),
(5, 'Niel', 'Niel has requested 20 of p10001. Click here for more details.', 1, '2025-05-08 12:32:40', 'Kitting', 'Approval'),
(6, 'Niel', 'Niel has requested 20 of p10001. Click here for more details.', 1, '2025-05-08 12:33:11', 'Kitting', 'Approval'),
(7, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-08 12:33:11', 'admin', 'Inventory'),
(8, 'Niel', 'Niel has requested 12 of p30003. Click here for more details.', 1, '2025-05-08 15:32:05', 'Kitting', 'Approval'),
(9, 'Niel', 'Niel has requested 2 of p30003. Click here for more details.', 1, '2025-05-08 15:34:14', 'Kitting', 'Approval'),
(10, 'Niel', 'Niel has requested 220 of p30003. Click here for more details.', 1, '2025-05-08 15:34:54', 'Kitting', 'Approval'),
(11, 'System', 'p30003 has reached the minimum inventory level and needs restocking.', 1, '2025-05-08 15:34:54', 'admin', 'Inventory'),
(12, 'Niel', 'Niel has requested 30 of p10001. Click here for more details.', 1, '2025-05-08 15:48:56', 'Kitting', 'Approval'),
(13, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-08 15:48:56', 'admin', 'Inventory'),
(14, 'Niel', 'Niel has requested 20 of p20002. Click here for more details.', 1, '2025-05-08 15:50:46', 'Kitting', 'Approval'),
(15, 'Niel', 'Niel has requested 2 of p10001. Click here for more details.', 1, '2025-05-08 16:20:54', 'Kitting', 'Approval'),
(16, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-08 16:20:54', 'admin', 'Inventory'),
(17, 'Niel', 'Niel has requested 18 of p10001. Click here for more details.', 1, '2025-05-08 16:59:14', 'Kitting', 'Approval'),
(18, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-08 16:59:14', 'admin', 'Inventory'),
(19, 'Niel', 'Niel has requested 16 of p30003. Click here for more details.', 1, '2025-05-08 17:21:02', 'Kitting', 'Approval'),
(20, 'System', 'p30003 has reached the minimum inventory level and needs restocking.', 1, '2025-05-08 17:21:02', 'admin', 'Inventory'),
(21, 'Niel', 'Niel has requested 5 of p30003. Click here for more details.', 1, '2025-05-08 17:23:40', 'Kitting', 'Approval'),
(22, 'System', 'p30003 has reached the minimum inventory level and needs restocking.', 1, '2025-05-08 17:23:40', 'admin', 'Inventory'),
(23, 'Niel', 'Niel has requested 10 of p20002. Click here for more details.', 1, '2025-05-08 17:25:18', 'Kitting', 'Approval'),
(24, 'Niel', 'Niel has requested 10 of p20002. Click here for more details.', 1, '2025-05-08 17:26:01', 'Kitting', 'Approval'),
(25, 'Niel', 'Niel has requested 10 of p20002. Click here for more details.', 1, '2025-05-08 17:30:15', 'Kitting', 'Approval'),
(26, 'Niel', 'Niel has requested 10 of p20002. Click here for more details.', 1, '2025-05-08 17:32:54', 'Kitting', 'Approval'),
(27, 'Niel', 'Niel has requested 40 of p20002. Click here for more details.', 1, '2025-05-08 17:40:13', 'Kitting', 'Approval'),
(28, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 40.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(29, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 10.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(30, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 10.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(31, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 10.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(32, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 10.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(33, 'Niel', 'Niel has canceled the withdrawal request for the p30003 with a quantity of 5.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(34, 'Niel', 'Niel has canceled the withdrawal request for the p30003 with a quantity of 16.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(35, 'Niel', 'Niel has canceled the withdrawal request for the p10001 with a quantity of 18.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(36, 'Niel', 'Niel has canceled the withdrawal request for the p10001 with a quantity of 2.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(37, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 20.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(38, 'Niel', 'Niel has canceled the withdrawal request for the p10001 with a quantity of 30.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(39, 'Niel', 'Niel has canceled the withdrawal request for the p30003 with a quantity of 220.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(40, 'Niel', 'Niel has canceled the withdrawal request for the p30003 with a quantity of 2.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(41, 'Niel', 'Niel has canceled the withdrawal request for the p30003 with a quantity of 12.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(42, 'Niel', 'Niel has canceled the withdrawal request for the p10001 with a quantity of 20.', 1, '2025-05-08 17:40:31', 'Kitting', 'Inventory'),
(43, 'Niel', 'Niel has requested 50 of p10001. Click here for more details.', 1, '2025-05-08 17:42:55', 'Kitting', 'Approval'),
(44, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-08 17:42:55', 'admin', 'Inventory'),
(45, 'Niel', 'Niel has requested 30 of p20002. Click here for more details.', 1, '2025-05-08 18:00:33', 'Kitting', 'Approval'),
(46, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 30.', 1, '2025-05-08 18:00:45', 'Kitting', 'Inventory'),
(47, 'Niel', 'Niel has requested 20 of p20002. Click here for more details.', 1, '2025-05-09 04:24:49', 'Kitting', 'Approval'),
(48, 'Niel', 'Niel has requested 2 of p20002. Click here for more details.', 1, '2025-05-09 04:28:00', 'Kitting', 'Approval'),
(49, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 2.', 1, '2025-05-09 04:30:32', 'Kitting', 'Inventory'),
(50, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 20.', 1, '2025-05-09 04:30:32', 'Kitting', 'Inventory'),
(51, 'Niel', 'Niel has canceled the withdrawal request for the p10001 with a quantity of 50.', 1, '2025-05-09 04:30:32', 'Kitting', 'Inventory'),
(52, 'Niel', 'Niel has requested 15 of p20002. Click here for more details.', 1, '2025-05-09 04:35:57', 'Kitting', 'Approval'),
(53, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 15.', 1, '2025-05-09 04:38:22', 'Kitting', 'Inventory'),
(54, 'Niel', 'Niel has requested 15 of p10001. Click here for more details.', 1, '2025-05-09 04:41:19', 'Kitting', 'Approval'),
(55, 'Niel', 'Niel has canceled the withdrawal request for the p10001 with a quantity of 15.', 1, '2025-05-09 06:12:43', 'Kitting', 'Inventory'),
(56, 'Niel', 'Niel has requested 15 of p20002. Click here for more details.', 1, '2025-05-09 06:36:22', 'Kitting', 'Approval'),
(57, 'Niel', 'Niel has canceled the withdrawal request for the p20002 with a quantity of 15.', 1, '2025-05-09 06:54:52', 'Kitting', 'Inventory'),
(58, 'Niel', 'Niel has requested 10 of p10001. Click here for more details.', 1, '2025-05-09 06:55:34', 'Supervisor', 'Approval'),
(59, 'Nikka', 'Nikka has approved 10 of p10001. Click here for more details.', 1, '2025-05-09 06:55:51', 'Niel', 'Approved'),
(60, 'Niel', 'Niel is returning 10 of p10001. Click here for more details.', 1, '2025-05-09 06:56:26', 'Supervisor', 'Scrap'),
(61, 'Niel', 'Nikka has successfully received 5 of p10001. Click here for more details.', 1, '2025-05-09 06:56:54', 'Niel', 'Returned'),
(62, 'Niel', 'Niel has requested 65 of p10001. Click here for more details.', 1, '2025-05-09 07:08:06', 'Supervisor', 'Approval'),
(63, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-09 07:08:06', 'admin', 'Inventory'),
(64, 'Nikka', 'Nikka has rejected 65 of p10001. Click here for more details.', 1, '2025-05-09 07:12:17', 'Niel', 'Rejected'),
(65, 'Niel', 'Niel has requested 10 of p10001. Click here for more details.', 1, '2025-05-09 07:13:30', 'Supervisor', 'Approval'),
(66, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-09 07:13:30', 'admin', 'Inventory'),
(67, 'Nikka', 'Nikka has approved 10 of p10001. Click here for more details.', 1, '2025-05-09 07:13:45', 'Niel', 'Approved'),
(68, 'Niel', 'Niel is returning 10 of p10001. Click here for more details.', 1, '2025-05-09 07:14:08', 'Supervisor', 'Scrap'),
(69, 'Niel', 'Nikka has successfully received 10 of p10001. Click here for more details.', 1, '2025-05-09 07:14:20', 'Niel', 'Returned'),
(70, 'Niel', 'Niel has requested 12 of Material8. Click here for more details.', 1, '2025-05-09 07:28:10', 'Kitting', 'Approval'),
(71, 'Maan', 'Maan has approved 12 of Material8. Click here for more details.', 1, '2025-05-09 07:29:14', 'Niel', 'Approved'),
(72, 'Nikka', 'Nikka has requested 12 of Angle. Click here for more details.', 1, '2025-05-09 07:47:44', 'Kitting', 'Approval'),
(73, 'Maan', 'Maan has approved 12 of Angle. Click here for more details.', 1, '2025-05-09 07:48:20', 'Nikka', 'Approved'),
(74, 'System', 'Patrick Del Mundo account registration is awaiting approval.', 1, '2025-05-09 11:45:53', 'adminOnly', 'Account Registration Pending Approval'),
(75, 'System', 'Raffy Tulfo account registration is awaiting approval.', 1, '2025-05-09 11:46:19', 'adminOnly', 'Account Registration Pending Approval'),
(76, 'Maan', 'Maan has requested a password change.', 1, '2025-05-09 11:52:18', 'adminOnly', 'Request password change'),
(77, 'Nikka', 'Nikka has requested 2 of Angle. Click here for more details.', 1, '2025-05-09 15:45:59', 'Kitting', 'Approval'),
(78, 'Nikka', 'Nikka has requested 3 of Material8. Click here for more details.', 1, '2025-05-09 15:46:14', 'Kitting', 'Approval'),
(79, 'Nikka', 'Nikka has requested 3 of p10001. Click here for more details.', 1, '2025-05-09 15:46:30', 'Supervisor', 'Approval'),
(80, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-09 15:46:30', 'admin', 'Inventory'),
(81, 'Nikka', 'Nikka has requested 3 of p10001. Click here for more details.', 1, '2025-05-09 15:46:54', 'Supervisor', 'Approval'),
(82, 'Nikka', 'Nikka has requested 3 of p10001. Click here for more details.', 1, '2025-05-09 15:47:07', 'Supervisor', 'Approval'),
(83, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-09 15:47:07', 'admin', 'Inventory'),
(84, 'Nikka', 'Nikka has requested 3 of p30003. Click here for more details.', 1, '2025-05-09 15:47:17', 'Supervisor', 'Approval'),
(85, 'Nikka', 'Nikka has requested 3 of Angle. Click here for more details.', 1, '2025-05-09 15:47:31', 'Kitting', 'Approval'),
(86, 'Nikka', 'Nikka has approved 3 of p30003. Click here for more details.', 1, '2025-05-09 15:47:49', 'Nikka', 'Approved'),
(87, 'Nikka', 'Nikka has approved 3 of p10001. Click here for more details.', 1, '2025-05-09 15:47:49', 'Nikka', 'Approved'),
(88, 'Nikka', 'Nikka has approved 3 of p10001. Click here for more details.', 1, '2025-05-09 15:47:49', 'Nikka', 'Approved'),
(89, 'Nikka', 'Nikka has approved 3 of p10001. Click here for more details.', 1, '2025-05-09 15:47:49', 'Nikka', 'Approved'),
(90, 'Nikka', 'Nikka has approved 20 of p10001. Click here for more details.', 1, '2025-05-09 15:47:49', 'Niel', 'Approved'),
(91, 'Maan', 'Maan has rejected 3 of Angle. Click here for more details.', 1, '2025-05-09 15:48:31', 'Nikka', 'Rejected'),
(92, 'Maan', 'Maan has rejected 3 of Material8. Click here for more details.', 1, '2025-05-09 15:48:31', 'Nikka', 'Rejected'),
(93, 'Maan', 'Maan has rejected 2 of Angle. Click here for more details.', 1, '2025-05-09 15:48:31', 'Nikka', 'Rejected'),
(94, 'Nikka', 'Nikka has requested 2 of p10001. Click here for more details.', 1, '2025-05-09 15:52:32', 'Supervisor', 'Approval'),
(95, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-09 15:52:32', 'admin', 'Inventory'),
(96, 'Nikka', 'Nikka has requested 2 of p10001. Click here for more details.', 1, '2025-05-09 15:52:42', 'Supervisor', 'Approval'),
(97, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-09 15:52:42', 'admin', 'Inventory'),
(98, 'Nikka', 'Nikka has approved 2 of p10001. Click here for more details.', 1, '2025-05-09 15:53:05', 'Nikka', 'Approved'),
(99, 'Nikka', 'Nikka has approved 2 of p10001. Click here for more details.', 1, '2025-05-09 15:53:05', 'Nikka', 'Approved'),
(100, 'Nikka', 'Nikka has requested 2 of Material8. Click here for more details.', 1, '2025-05-09 16:02:45', 'Kitting', 'Approval'),
(101, 'Nikka', 'Nikka has requested 2 of p30003. Click here for more details.', 1, '2025-05-09 16:02:54', 'Supervisor', 'Approval'),
(102, 'Nikka', 'Nikka has requested 3 of p20002. Click here for more details.', 1, '2025-05-09 16:03:03', 'Supervisor', 'Approval'),
(103, 'Nikka', 'Nikka has approved 3 of p20002. Click here for more details.', 1, '2025-05-09 16:03:12', 'Nikka', 'Approved'),
(104, 'Nikka', 'Nikka has approved 2 of p30003. Click here for more details.', 1, '2025-05-09 16:03:12', 'Nikka', 'Approved'),
(105, 'Maan', 'Maan has approved 2 of Material8. Click here for more details.', 1, '2025-05-09 16:03:26', 'Nikka', 'Approved'),
(106, 'Nikka', 'Nikka is returning 2 of Material8. Click here for more details.', 1, '2025-05-10 02:10:37', 'Kitting', 'Scrap'),
(107, 'Nikka', 'Nikka is returning 2 of p30003. Click here for more details.', 1, '2025-05-10 02:10:37', 'Supervisor', 'Scrap'),
(108, 'Nikka', 'Nikka is returning 3 of p20002. Click here for more details.', 1, '2025-05-10 02:10:37', 'Supervisor', 'Scrap'),
(109, 'Nikka', 'Nikka is returning 2 of p10001. Click here for more details.', 1, '2025-05-10 02:10:37', 'Supervisor', 'Scrap'),
(110, 'Nikka', 'Nikka is returning 2 of p10001. Click here for more details.', 1, '2025-05-10 02:10:37', 'Supervisor', 'Scrap'),
(111, 'Nikka', 'Nikka is returning 3 of p10001. Click here for more details.', 1, '2025-05-10 02:10:37', 'Supervisor', 'Scrap'),
(112, 'Nikka', 'Nikka is returning 3 of p10001. Click here for more details.', 1, '2025-05-10 02:10:37', 'Supervisor', 'Scrap'),
(113, 'Nikka', 'Nikka is returning 3 of p10001. Click here for more details.', 1, '2025-05-10 02:10:37', 'Supervisor', 'Scrap'),
(114, 'Nikka', 'Nikka is returning 3 of p30003. Click here for more details.', 1, '2025-05-10 02:10:37', 'Supervisor', 'Scrap'),
(115, 'Nikka', 'Nikka is returning 12 of Angle. Click here for more details.', 1, '2025-05-10 02:10:37', 'Kitting', 'Scrap'),
(116, 'Nikka', 'Nikka has successfully received 3 of p10001. Click here for more details.', 1, '2025-05-10 02:11:11', 'Nikka', 'Returned'),
(117, 'Nikka', 'Nikka has successfully received 3 of p10001. Click here for more details.', 1, '2025-05-10 02:11:11', 'Nikka', 'Returned'),
(118, 'Nikka', 'Nikka has successfully received 3 of p10001. Click here for more details.', 1, '2025-05-10 02:11:11', 'Nikka', 'Returned'),
(119, 'Nikka', 'Nikka has successfully received 2 of p10001. Click here for more details.', 1, '2025-05-10 02:11:11', 'Nikka', 'Returned'),
(120, 'Nikka', 'Nikka has successfully received 2 of p10001. Click here for more details.', 1, '2025-05-10 02:11:11', 'Nikka', 'Returned'),
(121, 'Nikka', 'Nikka has successfully received 3 of p20002. Click here for more details.', 1, '2025-05-10 02:11:11', 'Nikka', 'Returned'),
(122, 'Nikka', 'Nikka has successfully received 3 of p30003. Click here for more details.', 1, '2025-05-10 02:11:11', 'Nikka', 'Returned'),
(123, 'Nikka', 'Nikka has successfully received 2 of p30003. Click here for more details.', 1, '2025-05-10 02:11:11', 'Nikka', 'Returned'),
(124, 'Niel', 'Niel has requested 60 of p10001. Click here for more details.', 1, '2025-05-10 02:55:06', 'Supervisor', 'Approval'),
(125, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-10 02:55:06', 'admin', 'Inventory'),
(126, 'System', 'Garreth Tulfo account registration is awaiting approval.', 1, '2025-05-10 03:08:09', 'adminOnly', 'Account Registration Pending Approval'),
(127, 'Garreth', 'Garreth has requested 34 of Angle. Click here for more details.', 1, '2025-05-10 06:55:29', 'Kitting', 'Approval'),
(128, 'Patrick', 'Patrick has requested 2 of Material1. Click here for more details.', 1, '2025-05-10 11:24:17', 'Supervisor', 'Approval'),
(129, 'Patrick', 'Patrick has requested 3 of Material2. Click here for more details.', 1, '2025-05-10 11:24:27', 'Kitting', 'Approval'),
(130, 'Patrick', 'Patrick has requested 2 of Material3. Click here for more details.', 1, '2025-05-10 11:24:38', 'Supervisor', 'Approval'),
(131, 'Patrick', 'Patrick has requested 2 of Material4. Click here for more details.', 1, '2025-05-10 11:24:48', 'Kitting', 'Approval'),
(132, 'Patrick', 'Patrick has requested 3 of Material6. Click here for more details.', 1, '2025-05-10 11:25:00', 'Kitting', 'Approval'),
(133, 'Patrick', 'Patrick has requested 2 of Material10. Click here for more details.', 1, '2025-05-10 11:25:10', 'Supervisor', 'Approval'),
(134, 'Patrick', 'Patrick has requested 2 of Material14. Click here for more details.', 1, '2025-05-10 11:25:20', 'Supervisor', 'Approval'),
(135, 'Patrick', 'Patrick has requested 2 of Material15. Click here for more details.', 1, '2025-05-10 11:25:29', 'Kitting', 'Approval'),
(136, 'Patrick', 'Patrick has requested 3 of Material17. Click here for more details.', 1, '2025-05-10 11:25:39', 'Kitting', 'Approval'),
(137, 'Patrick', 'Patrick has requested 2 of Material50. Click here for more details.', 1, '2025-05-10 11:25:49', 'Kitting', 'Approval'),
(138, 'Patrick', 'Patrick has requested 3 of Material51. Click here for more details.', 1, '2025-05-10 11:26:00', 'Supervisor', 'Approval'),
(139, 'Patrick', 'Patrick has requested 3 of Material82. Click here for more details.', 1, '2025-05-10 11:26:10', 'Kitting', 'Approval'),
(140, 'Patrick', 'Patrick has requested 3 of Material87. Click here for more details.', 1, '2025-05-10 11:26:47', 'Supervisor', 'Approval'),
(141, 'Patrick', 'Patrick has approved 3 of Material82. Click here for more details.', 1, '2025-05-10 11:27:06', 'Patrick', 'Approved'),
(142, 'Patrick', 'Patrick has approved 2 of Material50. Click here for more details.', 1, '2025-05-10 11:27:06', 'Patrick', 'Approved'),
(143, 'Patrick', 'Patrick has approved 3 of Material17. Click here for more details.', 1, '2025-05-10 11:27:06', 'Patrick', 'Approved'),
(144, 'Patrick', 'Patrick has approved 2 of Material15. Click here for more details.', 1, '2025-05-10 11:27:06', 'Patrick', 'Approved'),
(145, 'Patrick', 'Patrick has approved 3 of Material6. Click here for more details.', 1, '2025-05-10 11:27:06', 'Patrick', 'Approved'),
(146, 'Patrick', 'Patrick has approved 2 of Material4. Click here for more details.', 1, '2025-05-10 11:27:06', 'Patrick', 'Approved'),
(147, 'Patrick', 'Patrick has approved 3 of Material2. Click here for more details.', 1, '2025-05-10 11:27:06', 'Patrick', 'Approved'),
(148, 'Patrick', 'Patrick has approved 34 of Angle. Click here for more details.', 0, '2025-05-10 11:27:06', 'Garreth', 'Approved'),
(149, 'Nikka', 'Nikka has approved 3 of Material87. Click here for more details.', 1, '2025-05-10 11:27:32', 'Patrick', 'Approved'),
(150, 'Nikka', 'Nikka has approved 3 of Material51. Click here for more details.', 1, '2025-05-10 11:27:32', 'Patrick', 'Approved'),
(151, 'Nikka', 'Nikka has approved 2 of Material14. Click here for more details.', 1, '2025-05-10 11:27:32', 'Patrick', 'Approved'),
(152, 'Nikka', 'Nikka has approved 2 of Material10. Click here for more details.', 1, '2025-05-10 11:27:32', 'Patrick', 'Approved'),
(153, 'Nikka', 'Nikka has approved 2 of Material3. Click here for more details.', 1, '2025-05-10 11:27:32', 'Patrick', 'Approved'),
(154, 'Nikka', 'Nikka has approved 2 of Material1. Click here for more details.', 1, '2025-05-10 11:27:32', 'Patrick', 'Approved'),
(155, 'Nikka', 'Nikka has approved 60 of p10001. Click here for more details.', 1, '2025-05-10 11:27:32', 'Niel', 'Approved'),
(156, 'Patrick', 'Patrick has requested 3 of Material5. Click here for more details.', 1, '2025-05-10 11:39:04', 'Supervisor', 'Approval'),
(157, 'Patrick', 'Patrick has requested 3 of Material11. Click here for more details.', 1, '2025-05-10 11:39:13', 'Kitting', 'Approval'),
(158, 'Patrick', 'Patrick has requested 3 of Material12. Click here for more details.', 1, '2025-05-10 11:39:22', 'Supervisor', 'Approval'),
(159, 'Patrick', 'Patrick has requested 29 of Material13. Click here for more details.', 1, '2025-05-10 11:39:38', 'Kitting', 'Approval'),
(160, 'Patrick', 'Patrick has approved 29 of Material13. Click here for more details.', 1, '2025-05-10 11:39:48', 'Patrick', 'Approved'),
(161, 'Patrick', 'Patrick has approved 3 of Material11. Click here for more details.', 1, '2025-05-10 11:39:48', 'Patrick', 'Approved'),
(162, 'Nikka', 'Nikka has approved 3 of Material12. Click here for more details.', 1, '2025-05-10 11:39:53', 'Patrick', 'Approved'),
(163, 'Nikka', 'Nikka has approved 3 of Material5. Click here for more details.', 1, '2025-05-10 11:39:53', 'Patrick', 'Approved'),
(164, 'Niel', 'Niel has requested 3 of Angle. Click here for more details.', 1, '2025-05-11 05:03:51', 'Kitting', 'Approval'),
(165, 'Niel', 'Niel has requested 3 of Material1. Click here for more details.', 1, '2025-05-11 05:04:00', 'Supervisor', 'Approval'),
(166, 'Niel', 'Niel has requested 3 of Material2. Click here for more details.', 1, '2025-05-11 05:04:08', 'Kitting', 'Approval'),
(167, 'Niel', 'Niel has requested 3 of Material3. Click here for more details.', 1, '2025-05-11 05:04:20', 'Supervisor', 'Approval'),
(168, 'Niel', 'Niel has requested 5 of Material4. Click here for more details.', 1, '2025-05-11 05:04:29', 'Kitting', 'Approval'),
(169, 'Niel', 'Niel has requested 3 of Material5. Click here for more details.', 1, '2025-05-11 05:04:39', 'Supervisor', 'Approval'),
(170, 'Niel', 'Niel has requested 2 of Material6. Click here for more details.', 1, '2025-05-11 05:04:49', 'Kitting', 'Approval'),
(171, 'Niel', 'Niel has requested 3 of Material8. Click here for more details.', 1, '2025-05-11 05:05:01', 'Kitting', 'Approval'),
(172, 'Niel', 'Niel has requested 4 of Material10. Click here for more details.', 1, '2025-05-11 05:05:11', 'Supervisor', 'Approval'),
(173, 'Niel', 'Niel has requested 5 of Material11. Click here for more details.', 1, '2025-05-11 05:05:21', 'Kitting', 'Approval'),
(174, 'Niel', 'Niel has requested 4 of Material12. Click here for more details.', 1, '2025-05-11 05:05:31', 'Supervisor', 'Approval'),
(175, 'Niel', 'Niel has requested 4 of Material13. Click here for more details.', 1, '2025-05-11 05:05:40', 'Kitting', 'Approval'),
(176, 'Niel', 'Niel has requested 5 of Material14. Click here for more details.', 1, '2025-05-11 05:05:49', 'Supervisor', 'Approval'),
(177, 'Niel', 'Niel has requested 5 of Material15. Click here for more details.', 1, '2025-05-11 05:06:05', 'Kitting', 'Approval'),
(178, 'Niel', 'Niel has requested 2 of Material17. Click here for more details.', 1, '2025-05-11 05:06:15', 'Kitting', 'Approval'),
(179, 'Niel', 'Niel has requested 6 of Material50. Click here for more details.', 1, '2025-05-11 05:06:28', 'Kitting', 'Approval'),
(180, 'Niel', 'Niel has requested 6 of Material51. Click here for more details.', 1, '2025-05-11 05:06:38', 'Supervisor', 'Approval'),
(181, 'Niel', 'Niel has requested 6 of Material82. Click here for more details.', 1, '2025-05-11 05:06:47', 'Kitting', 'Approval'),
(182, 'Niel', 'Niel has requested 6 of Material87. Click here for more details.', 1, '2025-05-11 05:06:56', 'Supervisor', 'Approval'),
(183, 'Niel', 'Niel has requested 6 of p10001. Click here for more details.', 1, '2025-05-11 05:07:07', 'Supervisor', 'Approval'),
(184, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-11 05:07:07', 'admin', 'Inventory'),
(185, 'Niel', 'Niel has requested 6 of p20002. Click here for more details.', 1, '2025-05-11 05:07:21', 'Supervisor', 'Approval'),
(186, 'Niel', 'Niel has requested 6 of p30003. Click here for more details.', 1, '2025-05-11 05:07:30', 'Supervisor', 'Approval'),
(187, 'Nikka', 'Nikka has approved 6 of p30003. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(188, 'Nikka', 'Nikka has approved 6 of p20002. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(189, 'Nikka', 'Nikka has approved 6 of p10001. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(190, 'Nikka', 'Nikka has approved 6 of Material87. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(191, 'Nikka', 'Nikka has approved 6 of Material51. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(192, 'Nikka', 'Nikka has approved 5 of Material14. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(193, 'Nikka', 'Nikka has approved 4 of Material12. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(194, 'Nikka', 'Nikka has approved 4 of Material10. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(195, 'Nikka', 'Nikka has approved 3 of Material5. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(196, 'Nikka', 'Nikka has approved 3 of Material3. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(197, 'Nikka', 'Nikka has approved 3 of Material1. Click here for more details.', 1, '2025-05-11 05:07:53', 'Niel', 'Approved'),
(198, 'Patrick', 'Patrick has approved 6 of Material82. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(199, 'Patrick', 'Patrick has approved 6 of Material50. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(200, 'Patrick', 'Patrick has approved 2 of Material17. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(201, 'Patrick', 'Patrick has approved 5 of Material15. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(202, 'Patrick', 'Patrick has approved 4 of Material13. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(203, 'Patrick', 'Patrick has approved 5 of Material11. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(204, 'Patrick', 'Patrick has approved 3 of Material8. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(205, 'Patrick', 'Patrick has approved 2 of Material6. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(206, 'Patrick', 'Patrick has approved 5 of Material4. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(207, 'Patrick', 'Patrick has approved 3 of Material2. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(208, 'Patrick', 'Patrick has approved 3 of Angle. Click here for more details.', 1, '2025-05-11 05:08:27', 'Niel', 'Approved'),
(209, 'System', 'test test account registration is awaiting approval.', 1, '2025-05-11 10:44:53', 'adminOnly', 'Account Registration Pending Approval'),
(210, 'System', 'Pakos account registration is awaiting approval.', 1, '2025-05-11 10:45:11', 'adminOnly', 'Account Registration Pending Approval'),
(211, 'System', 'manila account registration is awaiting approval.', 1, '2025-05-11 10:45:28', 'adminOnly', 'Account Registration Pending Approval'),
(212, 'System', 'zasr account registration is awaiting approval.', 1, '2025-05-11 10:45:43', 'adminOnly', 'Account Registration Pending Approval'),
(213, 'System', 'mike account registration is awaiting approval.', 1, '2025-05-11 10:45:55', 'adminOnly', 'Account Registration Pending Approval'),
(214, 'System', 'tara account registration is awaiting approval.', 1, '2025-05-11 10:46:10', 'adminOnly', 'Account Registration Pending Approval'),
(215, 'manila', 'manila has requested a password change.', 1, '2025-05-11 10:48:13', 'adminOnly', 'Request password change'),
(216, 'Zetsu', 'Zetsu has requested 50 of Material10. Click here for more details.', 1, '2025-05-11 10:50:57', 'Supervisor', 'Approval'),
(217, 'Zetsu', 'Zetsu has requested 45 of Material1. Click here for more details.', 1, '2025-05-11 10:51:27', 'Supervisor', 'Approval'),
(218, 'Zetsu', 'Zetsu has requested 15 of Angle. Click here for more details.', 1, '2025-05-11 10:51:46', 'Kitting', 'Approval'),
(219, 'System', 'Angle has reached the minimum inventory level and needs restocking.', 1, '2025-05-11 10:51:46', 'admin', 'Inventory'),
(220, 'Zetsu', 'Zetsu has requested 25 of Material1. Click here for more details.', 1, '2025-05-11 11:02:21', 'Supervisor', 'Approval'),
(221, 'Zetsu', 'Zetsu has requested 75 of Material1. Click here for more details.', 1, '2025-05-11 11:02:57', 'Supervisor', 'Approval'),
(222, 'Zetsu', 'Zetsu has requested 1 of p10001. Click here for more details.', 1, '2025-05-11 11:03:29', 'Supervisor', 'Approval'),
(223, 'System', 'p10001 has reached the minimum inventory level and needs restocking.', 1, '2025-05-11 11:03:29', 'admin', 'Inventory'),
(224, 'Zetsu', 'Zetsu has requested 20 of Material1. Click here for more details.', 1, '2025-05-11 11:04:50', 'Supervisor', 'Approval'),
(225, 'Zetsu', 'Zetsu has requested 4 of Material10. Click here for more details.', 1, '2025-05-11 11:05:02', 'Supervisor', 'Approval'),
(226, 'Zetsu', 'Zetsu has requested 6 of Material11. Click here for more details.', 1, '2025-05-11 11:05:16', 'Kitting', 'Approval'),
(227, 'Zetsu', 'Zetsu has canceled the withdrawal request for the Material11 with a quantity of 6.', 1, '2025-05-11 11:05:26', 'Kitting', 'Inventory'),
(228, 'Zetsu', 'Zetsu has canceled the withdrawal request for the Material10 with a quantity of 4.', 1, '2025-05-11 11:05:37', 'Supervisor', 'Inventory'),
(229, 'Zetsu', 'Zetsu has canceled the withdrawal request for the Material1 with a quantity of 20.', 1, '2025-05-11 11:05:37', 'Supervisor', 'Inventory'),
(230, 'Nikka', 'Nikka has approved 6 of p10001. Click here for more details.', 1, '2025-05-11 11:06:18', 'Zetsu', 'Approved'),
(231, 'Nikka', 'Nikka has approved 40 of Material1. Click here for more details.', 1, '2025-05-11 11:08:05', 'Zetsu', 'Approved'),
(232, 'Nikka', 'Nikka has approved 20 of Material1. Click here for more details.', 1, '2025-05-11 11:08:05', 'Zetsu', 'Approved'),
(233, 'Patrick', 'Patrick has rejected 15 of Angle. Click here for more details.', 1, '2025-05-11 11:09:26', 'Zetsu', 'Rejected'),
(234, 'Nikka', 'Nikka has rejected 45 of Material1. Click here for more details.', 1, '2025-05-11 11:10:17', 'Zetsu', 'Rejected'),
(235, 'Nikka', 'Nikka has rejected 50 of Material10. Click here for more details.', 1, '2025-05-11 11:10:17', 'Zetsu', 'Rejected'),
(236, 'Zetsu', 'Zetsu is returning 20 of Material1. Click here for more details.', 1, '2025-05-11 11:12:39', 'Supervisor', 'Scrap'),
(237, 'Zetsu', 'Nikka has successfully received 20 of Material1. Click here for more details.', 1, '2025-05-11 11:12:52', 'Zetsu', 'Returned'),
(238, 'Zetsu', 'Zetsu is returning 40 of Material1. Click here for more details.', 1, '2025-05-11 11:13:07', 'Supervisor', 'Scrap'),
(239, 'Zetsu', 'Nikka has successfully received 40 of Material1. Click here for more details.', 1, '2025-05-11 11:13:27', 'Zetsu', 'Returned');

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

--
-- Dumping data for table `tbl_requested`
--

INSERT INTO `tbl_requested` (`id`, `dts`, `part_name`, `lot_id`, `part_desc`, `station_code`, `part_option`, `part_qty`, `exp_date`, `batch_number`, `item_code`, `machine_no`, `with_reason`, `req_by`, `status`, `cost_center`, `approved_by`, `dts_approve`, `rejected_by`, `rejected_reason`, `dts_rejected`, `return_reason`, `dts_return`, `return_qty`, `return_purpose`, `received_by`, `dts_receive`, `approved_qty`, `approved_reason`) VALUES
(2, '2025-05-08 20:33:11', 'p10001', 'test', 'test 1 new', 'MEE', 'Indirect', 20, '2025-05-09', 'Batch 3', 'type B', 'MP3A_SC001', 'Engineering Eval', 'Niel', 'Approved', 'MASMO1 (T00008)', 'Nikka', '2025-05-07 23:47:49', '', '', '', '', '', 0, '', '', '', 20, ''),
(24, '2025-05-09 14:55:34', 'p10001', 'test', 'test 1 new', 'MEE', 'Indirect', 10, 'NA', 'Batch 2', 'Type A', 'MP3A_PPM003', 'Change Cap', 'Niel', 'returned', 'MASMO1 (T00008)', 'Nikka', '2025-05-09 14:55:51', '', '', '', 'sobra', '2025-05-09 14:56:26', 10, 'Partial', 'Nikka', '2025-05-09 14:56:54', 10, ''),
(25, '2025-05-09 15:08:06', 'p10001', 'test', 'test 1 new', 'EDL', 'Indirect', 65, 'NA', 'Batch 2', 'Type A', 'MP3A_PPM003', 'Use for Packaging', 'Niel', 'Rejected', 'MASMO1 (T00008)', '', '', 'Nikka', '', '2025-05-09 15:12:17', '', '', 0, '', '', '', 0, ''),
(26, '2025-05-09 15:13:30', 'p10001', 'test', 'test 1 new', 'EDL', 'Indirect', 10, '2025-05-10', 'Batch 3', 'type B', 'MP3A_PPM003', 'Use for Packaging', 'Niel', 'returned', 'MASMO1 (T00008)', 'Nikka', '2025-05-09 15:13:45', '', '', '', 'defect', '2025-05-09 15:14:08', 10, 'Scrap', 'Nikka', '2025-05-09 15:14:20', 10, ''),
(27, '2025-05-09 15:28:10', 'Material8', 'test', 'Description of Material8', 'MEE', 'Indirect', 12, '2025-05-16', 'Batch 2', 'Type A', 'MP3A_PPM002', 'Dummy Use', 'Niel', 'Approved', 'MASMO1 (T00008)', 'Maan', '2025-05-06 15:29:14', '', '', '', '', '', 0, '', '', '', 12, ''),
(28, '2025-05-09 15:47:44', 'Angle', 'test', 'Angle Decription', 'MEE', 'Direct', 12, 'NA', 'Batch 2', 'NA', 'MP3A_PPM002', 'Engineering Eval', 'Nikka', 'returning', 'MASMOD', 'Maan', '2025-05-06 15:48:20', '', '', '', 'test', '2025-05-10 10:10:37', 12, 'Partial', '', '', 12, ''),
(29, '2025-05-09 23:45:59', 'Angle', 'test', 'Angle Decription', 'MEE', 'Direct', 2, 'NA', 'Batch 2', 'NA', 'MP3A_PPM003', 'Engineering Eval', 'Nikka', 'Rejected', 'MASMOA', '', '', 'Maan', '', '2025-05-09 23:48:31', '', '', 0, '', '', '', 0, ''),
(30, '2025-05-09 23:46:14', 'Material8', 'test', 'Description of Material8', 'EDL', 'Indirect', 3, '2025-05-16', 'Batch 2', 'Type A', 'MP3A_PPM003', 'Engineering Eval', 'Nikka', 'Rejected', 'MASMOA', '', '', 'Maan', '', '2025-05-06 23:48:31', '', '', 0, '', '', '', 0, ''),
(31, '2025-05-09 23:46:30', 'p10001', 'test', 'test 1 new', 'Engg', 'Indirect', 3, '2025-05-10', 'Batch 3', 'type B', 'MP3A_PPM003', 'Dummy Use', 'Nikka', 'returned', 'MASMOA', 'Nikka', '2025-05-05 23:47:49', '', '', '', 'test', '2025-05-10 10:10:37', 3, 'Partial', 'Nikka', '2025-05-10 10:11:11', 3, ''),
(32, '2025-05-09 23:46:54', 'p10001', 'test', 'test 1 new', 'Engg', 'Indirect', 3, 'NA', 'Batch 2', 'Type A', 'MP3A_PPM001', 'Engineering Eval', 'Nikka', 'returned', 'MASMOA', 'Nikka', '2025-05-09 23:47:49', '', '', '', 'test', '2025-05-10 10:10:37', 3, 'Scrap', 'Nikka', '2025-05-10 10:11:11', 3, ''),
(33, '2025-05-09 23:47:07', 'p10001', 'test', 'test 1 new', 'MEE', 'Indirect', 3, '2025-05-10', 'Batch 3', 'type B', 'MP3A_PPM003', 'Dummy Use', 'Nikka', 'returned', 'MASMOA', 'Nikka', '2025-05-09 23:47:49', '', '', '', 'test', '2025-05-10 10:10:37', 3, 'Partial', 'Nikka', '2025-05-10 10:11:11', 3, ''),
(34, '2025-05-09 23:47:17', 'p30003', 'test', 'test 3 new', 'MEE', 'Indirect', 3, 'NA', 'Batch 2', 'Type A', 'MP3A_SC001', 'Use for Packaging', 'Nikka', 'returned', 'MASMOA', 'Nikka', '2025-05-09 23:47:49', '', '', '', 'test', '2025-05-10 10:10:37', 3, 'Scrap', 'Nikka', '2025-05-10 10:11:11', 3, ''),
(35, '2025-05-09 23:47:31', 'Angle', 'test', 'Angle Decription', 'MEE', 'Direct', 3, 'NA', 'Batch 2', 'NA', 'MP3A_SC001', 'Engineering Eval', 'Nikka', 'Rejected', 'MASMOA', '', '', 'Maan', '', '2025-05-09 23:48:31', '', '', 0, '', '', '', 0, ''),
(36, '2025-05-09 23:52:32', 'p10001', 'test', 'test 1 new', 'MEE', 'Indirect', 2, '2025-05-10', 'Batch 3', 'type B', 'MP3A_PPM002', 'Engineering Eval', 'Nikka', 'returned', 'MASMOA', 'Nikka', '2025-05-09 23:53:05', '', '', '', 'test', '2025-05-10 10:10:37', 2, 'Partial', 'Nikka', '2025-05-10 10:11:11', 2, ''),
(37, '2025-05-09 23:52:42', 'p10001', 'test', 'test 1 new', 'EDL', 'Indirect', 2, '2025-05-10', 'Batch 3', 'type B', 'MP3A_PPM003', 'Engineering Eval', 'Nikka', 'returned', 'MASMOA', 'Nikka', '2025-05-09 23:53:05', '', '', '', 'test', '2025-05-08 10:10:37', 2, 'Scrap', 'Nikka', '2025-05-08 10:11:11', 2, ''),
(38, '2025-05-10 00:02:45', 'Material8', 'test', 'Description of Material8', 'Mold', 'Indirect', 2, '2025-05-16', 'Batch 2', 'Type A', 'MP3A_PPM001', 'Dummy Use', 'Nikka', 'returning', 'MASMOA', 'Maan', '2025-05-10 00:03:26', '', '', '', 'tes', '2025-05-08 10:10:37', 2, 'Partial', '', '', 2, ''),
(39, '2025-05-10 00:02:54', 'p30003', 'test', 'test 3 new', 'Engg', 'Indirect', 2, 'NA', 'Batch 2', 'Type A', 'MP3A_PPM002', 'Use for Packaging', 'Nikka', 'returned', 'MASMOA', 'Nikka', '2025-05-10 00:03:12', '', '', '', 'test', '2025-05-10 10:10:37', 2, 'Partial', 'Nikka', '2025-05-10 10:11:11', 2, ''),
(40, '2025-05-10 00:03:03', 'p20002', 'test', 'test 2 new', 'MEE', 'Indirect', 3, '2025-05-23', 'Batch 2', 'NA', 'MP3A_PPM003', 'Use for Packaging', 'Nikka', 'returned', 'MASMOA', 'Nikka', '2025-05-08 00:03:12', '', '', '', 'test', '2025-05-08 10:10:37', 3, 'Scrap', 'Nikka', '2025-05-05 10:11:11', 3, ''),
(41, '2025-05-10 10:55:06', 'p10001', 'test', 'test 1 new', 'EDL', 'Indirect', 60, 'NA', 'Batch 2', 'Type A', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-10 19:27:32', '', '', '', '', '', 0, '', '', '', 60, ''),
(42, '2025-05-10 14:55:29', 'Angle', 'test', 'Angle Decription', 'WB', 'Direct', 34, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM003', 'Dummy Use', 'Garreth', 'Approved', 'OBSTA new', 'Patrick', '2025-05-10 19:27:06', '', '', '', '', '', 0, '', '', '', 34, ''),
(43, '2025-05-10 19:24:17', 'Material1', 'test', 'Description of Material1', 'Engg', 'Direct', 2, 'NA', 'Batch 23', 'Type A', 'MP3A_PPM003', 'Dummy Use', 'Patrick', 'Approved', 'MASMOL', 'Nikka', '2025-05-10 19:27:32', '', '', '', '', '', 0, '', '', '', 2, ''),
(44, '2025-05-10 19:24:27', 'Material2', 'test', 'Description of Material2', 'Engg', 'Indirect', 3, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM002', 'Dummy Use', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:27:06', '', '', '', '', '', 0, '', '', '', 3, ''),
(45, '2025-05-10 19:24:38', 'Material3', 'test', 'Description of Material3', 'MEE', 'Direct', 2, '2025-05-24', 'Batch 26', 'Type C', 'MP3A_PPM003', 'Use for Cleaning', 'Patrick', 'Approved', 'MASMOL', 'Nikka', '2025-05-10 19:27:32', '', '', '', '', '', 0, '', '', '', 2, ''),
(46, '2025-05-10 19:24:48', 'Material4', 'test', 'Description of Material4', 'Engg', 'Indirect', 2, '2025-05-29', 'test', 'test', 'MP3A_PPM003', 'Dummy Use', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:27:06', '', '', '', '', '', 0, '', '', '', 2, ''),
(47, '2025-05-10 19:25:00', 'Material6', 'test', 'Description of Material6', 'Engg', 'Indirect', 3, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM002', 'Engineering Eval', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:27:06', '', '', '', '', '', 0, '', '', '', 3, ''),
(48, '2025-05-10 19:25:10', 'Material10', 'test', 'Description of Material10', 'MEE', 'Indirect', 2, 'NA', 'batch 5', 'TYPE A', 'MP3A_SC001', 'Engineering Eval', 'Patrick', 'Approved', 'MASMOL', 'Nikka', '2025-05-10 19:27:32', '', '', '', '', '', 0, '', '', '', 2, ''),
(49, '2025-05-10 19:25:20', 'Material14', 'test', 'Description of Material14', 'MEE', 'Indirect', 2, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM003', 'Use for Packaging', 'Patrick', 'Approved', 'MASMOL', 'Nikka', '2025-05-10 19:27:32', '', '', '', '', '', 0, '', '', '', 2, ''),
(50, '2025-05-10 19:25:29', 'Material15', 'test', 'Description of Material15', 'MEE', 'Direct', 2, 'NA', 'test', 'test', 'MP3A_PPM003', 'Engineering Eval', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:27:06', '', '', '', '', '', 0, '', '', '', 2, ''),
(51, '2025-05-10 19:25:39', 'Material17', 'test', 'Description of Material17', 'MEE', 'Direct', 3, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM003', 'Engineering Eval', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:27:06', '', '', '', '', '', 0, '', '', '', 3, ''),
(52, '2025-05-10 19:25:49', 'Material50', 'test', 'Description of Material50', 'MEE', 'Indirect', 2, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM003', 'Use for Packaging', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:27:06', '', '', '', '', '', 0, '', '', '', 2, ''),
(53, '2025-05-10 19:26:00', 'Material51', 'test', 'Description of Material51', 'Engg', 'Direct', 3, 'NA', 'test', 'test', 'MP3A_PPM002', 'Dummy Use', 'Patrick', 'Approved', 'MASMOL', 'Nikka', '2025-05-10 19:27:32', '', '', '', '', '', 0, '', '', '', 3, ''),
(54, '2025-05-10 19:26:10', 'Material82', 'test', 'Description of Material82', 'Engg', 'Indirect', 3, 'NA', 'test', 'test', 'MP3A_PPM003', 'Engineering Eval', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:27:06', '', '', '', '', '', 0, '', '', '', 3, ''),
(55, '2025-05-10 19:26:47', 'Material87', 'test', 'Description of Material87', 'EDL', 'Direct', 3, '2025-05-30', 'test', 'test', 'MP3A_PPM001', 'Engineering Eval', 'Patrick', 'Approved', 'MASMOL', 'Nikka', '2025-05-10 19:27:32', '', '', '', '', '', 0, '', '', '', 3, ''),
(56, '2025-05-10 19:39:04', 'Material5', 'test', 'Description of Material5', 'MEE', 'Direct', 3, 'NA', 'test', 'test', 'MP3A_PPM002', 'Dummy Use', 'Patrick', 'Approved', 'MASMOL', 'Nikka', '2025-05-10 19:39:53', '', '', '', '', '', 0, '', '', '', 3, ''),
(57, '2025-05-10 19:39:13', 'Material11', 'test', 'Description of Material11', 'Engg', 'Direct', 3, 'NA', 'test', 'test', 'MP3A_PPM002', 'Dummy Use', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:39:48', '', '', '', '', '', 0, '', '', '', 3, ''),
(58, '2025-05-10 19:39:22', 'Material12', 'test', 'Description of Material12', 'EDL', 'Indirect', 3, '2025-05-22', 'test', 'test', 'MP3A_SC001', 'Dummy Use', 'Patrick', 'Approved', 'MASMOL', 'Nikka', '2025-05-10 19:39:53', '', '', '', '', '', 0, '', '', '', 3, ''),
(59, '2025-05-10 19:39:38', 'Material13', 'tes', 'Description of Material13', 'Engg', 'Direct', 29, '2025-05-31', 'test', 'test', 'MP3A_PPM003', 'Engineering Eval', 'Patrick', 'Approved', 'MASMOL', 'Patrick', '2025-05-10 19:39:48', '', '', '', '', '', 0, '', '', '', 29, ''),
(60, '2025-05-11 13:03:51', 'Angle', 'test', 'Angle Decription', 'MEE', 'Direct', 3, 'NA', 'Batch 2', 'NA', 'MP3A_PPM002', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 3, ''),
(61, '2025-05-11 13:04:00', 'Material1', 'test', 'Description of Material1', 'Engg', 'Direct', 3, 'NA', 'Batch 23', 'Type A', 'MP3A_PPM003', 'Dummy Use', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 3, ''),
(62, '2025-05-11 13:04:08', 'Material2', 'test', 'Description of Material2', 'Engg', 'Indirect', 3, '2025-05-29', 'test', 'test', 'MP3A_PPM002', 'Use for Packaging', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 3, ''),
(63, '2025-05-11 13:04:20', 'Material3', 'test', 'Description of Material3', 'MEE', 'Direct', 3, '2025-05-24', 'Batch 26', 'Type C', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 3, ''),
(64, '2025-05-11 13:04:29', 'Material4', 'test', 'Description of Material4', 'Engg', 'Indirect', 5, '2025-05-29', 'test', 'test', 'MP3A_PPM003', 'Dummy Use', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 5, ''),
(65, '2025-05-11 13:04:39', 'Material5', 'test', 'Description of Material5', 'Engg', 'Direct', 3, 'NA', 'test', 'test', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 3, ''),
(66, '2025-05-11 13:04:49', 'Material6', 'test', 'Description of Material6', 'MEE', 'Indirect', 2, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 2, ''),
(67, '2025-05-11 13:05:01', 'Material8', 'test', 'Description of Material8', 'MEE', 'Indirect', 3, '2025-05-16', 'Batch 2', 'Type A', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 3, ''),
(68, '2025-05-11 13:05:11', 'Material10', 'test', 'Description of Material10', 'MEE', 'Indirect', 4, 'NA', 'batch 5', 'TYPE A', 'MP3A_SC001', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 4, ''),
(69, '2025-05-11 13:05:21', 'Material11', 'test', 'Description of Material11', 'MEE', 'Direct', 5, 'NA', 'test', 'test', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 5, ''),
(70, '2025-05-11 13:05:31', 'Material12', 'test', 'Description of Material12', 'MEE', 'Indirect', 4, '2025-05-22', 'test', 'test', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 4, ''),
(71, '2025-05-11 13:05:40', 'Material13', 'test', 'Description of Material13', 'Engg', 'Direct', 4, '2025-05-31', 'test', 'test', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 4, ''),
(72, '2025-05-11 13:05:49', 'Material14', 'test', 'Description of Material14', 'Engg', 'Indirect', 5, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM002', 'Dummy Use', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 5, ''),
(73, '2025-05-11 13:06:05', 'Material15', 'tset', 'Description of Material15', 'Engg', 'Direct', 5, 'NA', 'test', 'test', 'MP3A_PPM001', 'Use for Packaging', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 5, ''),
(74, '2025-05-11 13:06:15', 'Material17', 'test', 'Description of Material17', 'MFG', 'Direct', 2, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 2, ''),
(75, '2025-05-11 13:06:28', 'Material50', 'test', 'Description of Material50', 'Engg', 'Indirect', 6, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 6, ''),
(76, '2025-05-11 13:06:38', 'Material51', 'test', 'Description of Material51', 'Engg', 'Direct', 6, 'NA', 'test', 'test', 'MP3A_PPM003', 'Use for Packaging', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 6, ''),
(77, '2025-05-11 13:06:47', 'Material82', 'test', 'Description of Material82', 'Engg', 'Indirect', 6, 'NA', 'test', 'test', 'MP3A_PPM002', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Patrick', '2025-05-11 13:08:27', '', '', '', '', '', 0, '', '', '', 6, ''),
(78, '2025-05-11 13:06:56', 'Material87', 'test', 'Description of Material87', 'Engg', 'Direct', 6, '2025-05-30', 'test', 'test', 'MP3A_PPM002', 'Dummy Use', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 6, ''),
(79, '2025-05-11 13:07:07', 'p10001', 'test', 'test 1 new', 'Engg', 'Indirect', 6, 'NA', 'Batch 2', 'Type A', 'MP3A_PPM003', 'Dummy Use', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 6, ''),
(80, '2025-05-11 13:07:21', 'p20002', 'test', 'test 2 new', 'MEE', 'Indirect', 6, '2025-05-22', 'test', 'test', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 6, ''),
(81, '2025-05-11 13:07:30', 'p30003', 'test', 'test 3 new', 'MEE', 'Indirect', 6, 'NA', 'Batch 2', 'Type A', 'MP3A_PPM003', 'Engineering Eval', 'Niel', 'Approved', 'MASMOG', 'Nikka', '2025-05-11 13:07:53', '', '', '', '', '', 0, '', '', '', 6, ''),
(82, '2025-05-11 18:50:57', 'Material10', 'test', 'Description of Material10', 'EDL', 'Indirect', 50, 'NA', 'batch 5', 'TYPE A', 'MP3A_PPM001', 'Engineering Eval', 'Zetsu', 'Rejected', 'OBSTA new', '', '', 'Nikka', '', '2025-05-11 19:10:17', '', '', 0, '', '', '', 0, ''),
(83, '2025-05-11 18:51:27', 'Material1', 'test', 'Description of Material1', 'EDL', 'Direct', 45, 'NA', 'Batch 23', 'Type A', 'MP3A_PPM001', 'Dummy Use', 'Zetsu', 'Rejected', 'OBSTA new', '', '', 'Nikka', '', '2025-05-11 19:10:17', '', '', 0, '', '', '', 0, ''),
(84, '2025-05-11 18:51:46', 'Angle', 'test', 'Angle Decription', 'Engg', 'Direct', 15, 'NA', 'Batch 2', 'NA', 'MP3A_PPM001', 'Engineering Eval', 'Zetsu', 'Rejected', 'OBSTA new', '', '', 'Patrick', 'wag', '2025-05-11 19:09:26', '', '', 0, '', '', '', 0, ''),
(85, '2025-05-11 19:02:21', 'Material1', 'test', 'Description of Material1', 'EDL', 'Direct', 30, 'NA', 'Batch 23', 'Type A', 'MP3A_PPM002', 'Engineering Eval', 'Zetsu', 'returned', 'OBSTA new', 'Nikka', '2025-05-11 19:08:05', '', '', '', 'test', '2025-05-11 19:12:39', 20, 'Partial', 'Nikka', '2025-05-11 19:12:52', 20, ''),
(86, '2025-05-11 19:02:57', 'Material1', 'test', 'Description of Material1', 'MEE', 'Direct', 80, 'NA', 'test', 'testtest', 'MP3A_PPM002', 'Engineering Eval', 'Zetsu', 'returned', 'OBSTA new', 'Nikka', '2025-05-11 19:08:05', '', '', '', 'defect', '2025-05-11 19:13:07', 40, 'Scrap', 'Nikka', '2025-05-11 19:13:27', 40, ''),
(87, '2025-05-11 19:03:29', 'p10001', 'test', 'test 1 new', 'Engg', 'Indirect', 6, 'NA', 'Batch 2', 'Type A', 'MP3A_SC001', 'Replacement', 'Zetsu', 'Approved', 'OBSTA new', 'Nikka', '2025-05-11 19:06:18', '', '', '', '', '', 0, '', '', '', 6, '');

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

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`id`, `part_name`, `part_qty`, `exp_date`, `batch_number`, `item_code`, `kitting_id`, `lot_id`, `dts`, `updated_by`, `status`) VALUES
(1, 'p10001', '20', 'NA', 'Batch 2', 'Type A', 'Badge 2003', 'LOT 1002', '2025-05-08 20:14:39', 'Nikka', 'Active'),
(2, 'p20002', '197', '2025-05-23', 'Batch 2', 'NA', 'Badge 2003', 'LOT 1002', '2025-05-08 20:14:39', 'Nikka', 'Active'),
(3, 'p30003', '291', 'NA', 'Batch 2', 'Type A', 'Badge 2003', 'LOT 1002', '2025-05-08 20:14:39', 'Nikka', 'Active'),
(4, 'p10001', '28', '2025-05-10', 'Batch 3', 'type B', 'test', 'lot 1001', '2025-05-08 20:17:54', 'Nikka', 'Expired'),
(5, 'Angle', '35', 'NA', 'Batch 2', 'NA', 'test', 'LOT 2', '2025-05-09 15:24:00', 'Nikka', 'Active'),
(6, 'Material8', '133', '2025-05-16', 'Batch 2', 'Type A', 'test', 'LOT 2', '2025-05-09 15:24:00', 'Nikka', 'Active'),
(7, 'Material1', '95', 'NA', 'Batch 23', 'Type A', 'Test 345', 'Lot 120', '2025-05-10 11:30:27', 'Nikka', 'Active'),
(8, 'Material3', '195', '2025-05-24', 'Batch 26', 'Type C', 'Test 345', 'Lot 122', '2025-05-10 11:30:27', 'Nikka', 'Active'),
(9, 'Angle', '66', 'NA', 'batch 5', 'TYPE A', 'test', 'LOT 10', '2025-05-10 12:46:48', 'Nikka', 'Active'),
(10, 'Material1', '300', 'NA', 'batch 5', 'TYPE A', 'test', 'LOT 10', '2025-05-10 12:46:48', 'Nikka', 'Active'),
(11, 'Material2', '197', 'NA', 'batch 5', 'TYPE A', 'stes', 'LOT 10', '2025-05-10 12:46:48', 'Nikka', 'Active'),
(12, 'Material14', '393', 'NA', 'batch 5', 'TYPE A', 'tests', 'LOT 10', '2025-05-10 12:46:49', 'Nikka', 'Active'),
(13, 'Material17', '195', 'NA', 'batch 5', 'TYPE A', 'etest', 'LOT 10', '2025-05-10 12:46:49', 'Nikka', 'Active'),
(14, 'Material10', '294', 'NA', 'batch 5', 'TYPE A', 'este', 'LOT 10', '2025-05-10 12:46:49', 'Nikka', 'Active'),
(15, 'Material6', '195', 'NA', 'batch 5', 'TYPE A', 'steste', 'LOT 10', '2025-05-10 12:46:49', 'Nikka', 'Active'),
(16, 'Material50', '92', 'NA', 'batch 5', 'TYPE A', 'stest', 'LOT 10', '2025-05-10 12:46:49', 'Nikka', 'Active'),
(17, 'Angle', '200', 'NA', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(18, 'Material1', '160', 'NA', 'test', 'testtest', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(19, 'Material2', '197', '2025-05-29', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(20, 'Material4', '193', '2025-05-29', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(21, 'Material15', '193', 'NA', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(22, 'Material17', '200', '2025-05-24', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(23, 'Material51', '191', 'NA', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(24, 'Material87', '191', '2025-05-30', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(25, 'Material82', '191', 'NA', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(26, 'p20002', '194', '2025-05-22', 'test', 'test', 'test', 'test', '2025-05-10 13:24:33', 'Nikka', 'Active'),
(27, 'Material5', '117', 'NA', 'test', 'test', 'test', 'test', '2025-05-10 19:38:43', 'Patrick', 'Active'),
(28, 'Material11', '116', 'NA', 'test', 'test', 'test', 'test', '2025-05-10 19:38:43', 'Patrick', 'Active'),
(29, 'Material12', '117', '2025-05-22', 'test', 'test', 'test', 'test', '2025-05-10 19:38:43', 'Patrick', 'Active'),
(30, 'Material13', '121', '2025-05-31', 'test', 'test', 'test', 'test', '2025-05-10 19:38:43', 'Patrick', 'Active');

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
(1, 'Nikka', '$2y$10$iVskrTRnTHTpmGVWWKb4LucvcRo7QnMikkp65jv8.N/tF6kY1u6Xe', 2, ' Marinel Nikka Zagala', '10001', 'Supervisor', 'Supervisor', 'MASMOA', 'Cinderella Ricacho', 'Elaine Sanico', 0, ''),
(3, 'Maan', '$2y$10$X96LElZM2/PHtCIh4eECW.MIP1VnG6kviBxuuoobjK0Az3R3rFx6q', 2, 'Maan Lacatan Del Mundo', '10002', 'Kitting', 'Kitting', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 0, ''),
(5, 'Niel', '$2y$10$NYzx53pxtzQd1U5Bt274kO4ZcazAhdhsW5YLAhjE5wkBeu3OHSlgq', 2, 'Niel Del Mundo', '10004', 'Operator', 'User', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(6, 'Patrick', '$2y$10$LG1b/ZKHOZJTzAKY2CLm6.rpCV4xv3ReeHdoL81cdgzmHU7Z5bLQa', 2, 'Patrick Del Mundo', '12500', 'Kitting', 'Kitting', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(7, 'Raffy', '$2y$10$dlx/FDTPsGEf3JCtPJNhzu6mhZR2fMDDZX45pjfUKPX34ZlAgahaa', 3, 'Raffy Tulfo', '25441', 'Operator', 'User', 'MASMO1 (T00008)', 'Luisa Pelobello', '', 0, ''),
(8, 'Miguel', '$2y$10$RfHSKth8Tl1kqEkEmXGFFuE3sIZf.jNfbhIPn09BBehX6ATmIZpt6', 2, 'Miguel Garcia New', '50004', 'Kitting', 'Kitting', 'MASMO1 (T00003)', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(9, 'Garreth', '$2y$10$4aldFtP0pxaNgw1N3814juugD9xTKAVw.T.gSNGBsN4NbwlHMmbRS', 2, 'Garreth Tulfo', '12354', 'Supervisor', 'Supervisor', 'OBSTA new', 'Pako nre', 'Test', 0, ''),
(10, 'Naruto', '$2y$10$os47tn4VODi8GXqOmMTRn.m5E1WDMlQqvimrMJru7AiRxgFWO3EGS', 2, 'Naruto', '1515', 'Operator', 'User', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 0, ''),
(11, 'Sasuke', '$2y$10$CpTIaqnakzeyfRm4FuDPROnLGMzSWMcFalCwgRTF.rAUr4LwQxanO', 2, 'Sasuke', '1515', 'Operator', 'User', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(12, 'Sakura', '$2y$10$V9I9wdqBPhRq4KbddimwWOFmbGqF0gstzKXASrup8ZbH8mktE50S6', 2, 'Sakura', '1515', 'Kitting', 'Kitting', 'MASMOK', 'Cinderella Ricacho', 'Ellaine Sanico', 0, ''),
(13, 'Kakashi', '$2y$10$ic1YkhcuK3ZXSgXCG6Xlqu5utLorEXya/UXKFXy5N5z/F6uA7ieuG', 2, 'Kakashi', '1515', 'Supervisor', 'Supervisor', 'MASMO1 (T00003)', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(14, 'Minato', '$2y$10$FWqXVDWvkpygTss2DFw5S.lkeTcwdKY7xIuQjCyb9w2YppbBr2Q4i', 2, 'Minato', '1515', 'Supervisor', 'Supervisor', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(15, 'Pein', '$2y$10$jgiQmxRnxw2NFU.XFZnLTOw0tTvGGWB6Mcq4nAW7HX4vCEbSgXLaW', 2, 'Pein', '1515', 'Kitting', 'Kitting', 'MASMO1 (T00008)', 'Luisa Pelobello', '', 0, ''),
(16, 'Itachi', '$2y$10$a9H0.b/dl6GMsZzasn/jYuJgcFZ4PfoSjOgnbbphvYu4N/LpwnQGK', 2, 'Itachi', '1515', 'Operator', 'User', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 0, ''),
(17, 'Deidara', '$2y$10$y9.2Ru2ujahCMHVge9ilj.P8t8kuYiHJ1p0qUGOMpG3oSMcLUwvTC', 2, 'Deidara', '1515', 'Operator', 'User', 'MASMOC', 'Arthur Abitria Jr.', 'Marinel Zagala', 0, ''),
(18, 'Sasori', '$2y$10$kL3h7PUY0vFWUrtUPFeQVOvx2t298viUv4Qf9R7ci8dVzQhsIARDm', 2, 'Sasori', '1515', 'Kitting', 'Kitting', 'MASMOG', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(19, 'Obito', '$2y$10$qEc1Pyxytr/WAgRere4K7eBvpxd5FHPAiMpEw3hGIF7iuKegQp//.', 2, 'Obito', '1515', 'Supervisor', 'Supervisor', 'MASMOD', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(20, 'Zetsu', '$2y$10$hsRWREj1pRac8KzJYH77iOhhnfSSFGneCaK3ZmR3243ptooQ1JBGK', 2, 'Zetsu', '1515', 'Operator', 'User', 'OBSTA new', 'Pako nre', 'Test', 0, ''),
(21, 'Kizame', '$2y$10$e65zJxo3KFmvY3oUYHF2bOuRMqgNu1c2zJp1RZbUoyKMmeJgtHFji', 2, 'Kizame', '1515', 'Kitting', 'Kitting', 'MASMPE', 'Oliver Mabutas', '', 0, ''),
(22, 'Konan', '$2y$10$K3y6x9oB6oUI8Z6zxaRSpu2ROFmsvpXZT9.tzDfqZ3HvhPLvDGP0G', 2, 'Konan', '1515', 'Supervisor', 'Supervisor', 'MASMOK', 'Cinderella Ricacho', 'Ellaine Sanico', 0, ''),
(26, 'test', '$2y$10$5iMrhEWaiR52IyFBDttyTOog0Mdkz5S4hMwy3uVXBZNS.zroGndY6', 2, 'test', 'test', 'Supervisor', 'Supervisor', 'MASMO1 (T00003)', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(27, 'tests', '$2y$10$8AFOY07obr1LoBA6Vn03.e/AA6HslbvPAXMFgurz6pJAcST7QqHgC', 3, 'test test', 'test', 'Supervisor', 'Supervisor', 'MASMPE', 'Oliver Mabutas', '', 0, 'test'),
(28, 'Pakos', '$2y$10$I.x99q25RfSpfjIBwfQR5e0eb2wpjwE9CF3q3ldm40lcqBeYQtq/e', 2, 'Pakos', '213', 'Kitting', 'Kitting', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(29, 'manila', '$2y$10$Bnm9WfP3ad3QUUzZeR0i1O/dlZVzmvJIBEhmVtkyplss1cfdGK9.u', 2, 'manila', 'manila', 'Supervisor', 'Supervisor', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 0, ''),
(30, 'zasr', '$2y$10$UUfvOkzaAoWilqz9LgUX3uDNMCsJ0U1ccLKezJ1JvcqV8YJwwiUXe', 3, 'zasr', 'fasf', 'Supervisor', 'Kitting', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 0, 'tsets'),
(31, 'mike', '$2y$10$Mpqqph4WRRZBxjg/dGxbKeo0W6IQZKIXfDxJsMgXgdopk2LCimpYC', 2, 'mike', '432', 'Operator', 'User', 'MASMPE', 'Oliver Mabutas', '', 0, ''),
(32, 'tara', '$2y$10$sJxtfg14Wg6ufrDntIoq6eas63cE7Bwewi0JMOTay1fdUPiFDbqGq', 3, 'tara', 'tara', 'Kitting', 'Kitting', 'MASMOL', 'Luisa Pelobello', 'Dianne Salvatierra', 0, 'testsaa');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `tbl_machine`
--
ALTER TABLE `tbl_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `tbl_requested`
--
ALTER TABLE `tbl_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbl_station_code`
--
ALTER TABLE `tbl_station_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_withdrawal_reason`
--
ALTER TABLE `tbl_withdrawal_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
