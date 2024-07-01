-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2024 at 04:10 PM
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
-- Database: `it_alert`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_items`
--

CREATE TABLE `db_items` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_day` int(11) NOT NULL,
  `day_left` int(11) NOT NULL,
  `day_alert` int(11) NOT NULL,
  `more_detail` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_items`
--

INSERT INTO `db_items` (`id`, `title`, `start_date`, `end_date`, `total_day`, `day_left`, `day_alert`, `more_detail`, `status`) VALUES
(24, 'asdasdasd', '2024-07-05', '2024-08-08', 34, 38, 1, '', 'off'),
(25, 'ASUS ROG STRIX GEFORCE RTX 4070TI 12GB GDDR6X OC EDITION', '2024-07-01', '2024-09-29', 90, 90, 7, '• GeForce RTX 4070 Ti\r\n• 12GB GDDR6X\r\n• 3 x DP\r\n• 2 x HDMI\r\n• Aura Sync RGB', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `db_token`
--

CREATE TABLE `db_token` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_token`
--

INSERT INTO `db_token` (`id`, `token`) VALUES
(1, '4OFdSHaA3ieSDESK1gr8EGUtkhea3vXpoiV45reScwX');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_items`
--
ALTER TABLE `db_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_token`
--
ALTER TABLE `db_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_items`
--
ALTER TABLE `db_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `db_token`
--
ALTER TABLE `db_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
