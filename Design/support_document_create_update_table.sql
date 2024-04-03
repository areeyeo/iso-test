-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 08:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iso_optimize`
--

-- --------------------------------------------------------

--
-- Table structure for table `support_document_create_update_table`
--

CREATE TABLE `support_document_create_update_table` (
  `id_document_create_update` int(10) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `document_abbreviation` varchar(100) NOT NULL,
  `name_th` varchar(200) NOT NULL,
  `name_eng` varchar(200) NOT NULL,
  `secret_level` varchar(200) NOT NULL,
  `document_owner` varchar(200) DEFAULT NULL,
  `create_update_upload` varchar(200) NOT NULL,
  `review` varchar(200) NOT NULL,
  `approval` varchar(200) NOT NULL,
  `status` int(10) NOT NULL,
  `version` varchar(100) NOT NULL,
  `release_date` datetime DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `created_by` varchar(200) DEFAULT NULL,
  `last_modified_time` datetime DEFAULT NULL,
  `last_modified_by` varchar(200) DEFAULT NULL,
  `review_time` datetime DEFAULT NULL,
  `review_by` varchar(100) DEFAULT NULL,
  `approval_time` datetime DEFAULT NULL,
  `approver_by` varchar(200) DEFAULT NULL,
  `id_file` int(10) DEFAULT NULL,
  `rejection_details` varchar(200) DEFAULT NULL,
  `request_details` varchar(200) DEFAULT NULL,
  `id_version` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `support_document_create_update_table`
--

INSERT INTO `support_document_create_update_table` (`id_document_create_update`, `document_type`, `document_abbreviation`, `name_th`, `name_eng`, `secret_level`, `document_owner`, `create_update_upload`, `review`, `approval`, `status`, `version`, `release_date`, `creation_time`, `created_by`, `last_modified_time`, `last_modified_by`, `review_time`, `review_by`, `approval_time`, `approver_by`, `id_file`, `rejection_details`, `request_details`, `id_version`) VALUES
(21, 'Management system manaul', 'MS_001', 'asdasd', 'sadsadas', 'Top secret', NULL, '5', '1', '1', 1, 'v.0.0.1', NULL, '2024-03-29 11:07:47', 'TNET test', '2024-03-29 11:07:47', 'TNET test', NULL, NULL, NULL, NULL, 113, NULL, NULL, 57),
(22, 'Policy', 'PO_001', 'asdas', 'asdasd', 'Secret', NULL, '5', '5', '5', 1, 'v.0.0.1', NULL, '2024-03-29 11:08:24', 'TNET test', '2024-03-29 11:08:24', 'TNET test', NULL, NULL, NULL, NULL, 114, NULL, NULL, 57),
(23, 'Management system manaul', 'MS_001', 'asdasd', 'sadsadas', 'Top secret', NULL, '5', '1', '1', 1, 'v.0.0.1', NULL, '2024-03-29 11:07:47', 'TNET test', '2024-03-29 11:07:47', 'TNET test', NULL, NULL, NULL, NULL, 115, NULL, NULL, 58),
(24, 'Policy', 'PO_001', 'asdas', 'asdasd', 'Secret', NULL, '5', '5', '5', 1, 'v.0.0.1', NULL, '2024-03-29 11:08:24', 'TNET test', '2024-03-29 11:08:24', 'TNET test', NULL, NULL, NULL, NULL, 116, NULL, NULL, 58),
(25, 'Policy', 'PO_002', 'กหฟก', 'ฟหกฟหก', 'Secret', NULL, '5', '1', '5', 1, 'v.0.0.1', NULL, '2024-03-29 14:20:25', 'TNET test', '2024-03-29 14:20:25', 'TNET test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 58),
(26, 'Management system manaul', 'MS_001', 'asdasd', 'sadsadas', 'Top secret', NULL, '5', '1', '1', 1, 'v.0.0.1', NULL, '2024-03-29 11:07:47', 'TNET test', '2024-03-29 11:07:47', 'TNET test', NULL, NULL, NULL, NULL, 117, NULL, NULL, 59),
(27, 'Policy', 'PO_001', 'asdas', 'asdasd', 'Secret', NULL, '5', '5', '5', 1, 'v.0.0.1', NULL, '2024-03-29 11:08:24', 'TNET test', '2024-03-29 11:08:24', 'TNET test', NULL, NULL, NULL, NULL, 118, NULL, NULL, 59),
(28, 'Policy', 'PO_002', 'กหฟก', 'ฟหกฟหก', 'Secret', NULL, '5', '1', '5', 1, 'v.0.0.1', NULL, '2024-03-29 14:20:25', 'TNET test', '2024-03-29 14:20:25', 'TNET test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `support_document_create_update_table`
--
ALTER TABLE `support_document_create_update_table`
  ADD PRIMARY KEY (`id_document_create_update`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `support_document_create_update_table`
--
ALTER TABLE `support_document_create_update_table`
  MODIFY `id_document_create_update` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
