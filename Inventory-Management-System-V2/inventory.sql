-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 09:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(7) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `purchase_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `property_number` varchar(40) NOT NULL,
  `serial_number` varchar(100) NOT NULL,
  `model_number` varchar(75) NOT NULL,
  `description` varchar(500) NOT NULL,
  `manufacturer_name` varchar(75) NOT NULL,
  `quantity_bought` int(6) NOT NULL,
  `designation` varchar(75) NOT NULL,
  `received_by` varchar(75) NOT NULL,
  `supplier_name` varchar(75) NOT NULL,
  `OR_number` varchar(50) NOT NULL,
  `amount` int(8) NOT NULL,
  `transfer_history` varchar(500) NOT NULL,
  `ordered_by` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `purchase_date`, `delivery_date`, `property_number`, `serial_number`, `model_number`, `description`, `manufacturer_name`, `quantity_bought`, `designation`, `received_by`, `supplier_name`, `OR_number`, `amount`, `transfer_history`, `ordered_by`) VALUES
(2, 'Laptop', '2023-07-07', '2023-08-07', 'OE-12345', 'E688A6E3-19AD-40C3-B30D-8B28612EBD19', 'G15', 'White, Backlit Keyboard', 'Dell', 1, 'New', 'George Isidro', 'Silicon Valley', '12345', 70000, 'None', 'ICT Department'),
(5, 'Laptop', '2023-07-18', '2023-08-07', 'OE-12346', '12345', 'Omen', 'Black, Backlit Keyboard', 'HP', 1, 'New', 'Jericho Isidro', 'Silicon Valley', '34567', 50000, 'None', 'GSO'),
(6, 'Desktop', '2022-11-07', '2022-12-07', 'OE-12347', 'R334GJ-GGT56HD-TrKO09-VVFR12', 'Pavilion', '500GB, Black, 8GB RAM, i7-8700K', 'HP', 1, 'Repaired', 'Juan De La Cruz', 'Silicon Valley', '45678', 30000, 'ES-GSO-ICT', 'Elementary Sector');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
