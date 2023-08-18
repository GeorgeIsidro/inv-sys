-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 05:40 AM
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
  `item_name` varchar(50) NOT NULL,
  `purchase_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `property_number` varchar(30) NOT NULL,
  `serial_number` varchar(50) NOT NULL,
  `model_number` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `manufacturer_name` varchar(50) NOT NULL,
  `quantity_bought` int(7) NOT NULL,
  `quantity_assigned` int(7) NOT NULL,
  `quantity_remaining` int(7) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `received_by` varchar(50) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `OR_number` varchar(30) NOT NULL,
  `amount` int(8) NOT NULL,
  `transfer_history` varchar(255) NOT NULL,
  `ordered_by` varchar(50) NOT NULL,
  `requesting_person` varchar(75) NOT NULL,
  `ordering_person` varchar(75) NOT NULL,
  `receipt_link` varchar(100) NOT NULL,
  `issuance_date` date NOT NULL,
  `assigned_office` varchar(50) NOT NULL,
  `remarks` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `purchase_date`, `delivery_date`, `property_number`, `serial_number`, `model_number`, `description`, `manufacturer_name`, `quantity_bought`, `quantity_assigned`, `quantity_remaining`, `designation`, `received_by`, `supplier_name`, `OR_number`, `amount`, `transfer_history`, `ordered_by`, `requesting_person`, `ordering_person`, `receipt_link`, `issuance_date`, `assigned_office`, `remarks`) VALUES
(24, 'Laptop', '2023-08-15', '2023-08-16', 'OE-12345', 'DD8B1197-CF61-46B8-91A8-D28845787A1E', 'G15', 'Black, Backlit Keyboard', 'Dell', 2, 1, 1, 'Borrowed', 'Juan De La Cruz', 'Silicon Valley', '4r5t6y', 50000, 'None', 'ICT Department', 'George Isidro', 'Leigh Isidro', 'youtube.com', '2023-08-17', 'ICT Department', 'Fixed Asset'),
(25, 'Crimping Tool', '2023-08-02', '2023-08-03', 'OE-12456', '12343', 'Sample', 'Used for wire cutting', 'SAmple', 1, 1, 0, 'Assigned', 'George', 'Sample', '21314', 5000, 'None', 'Sample', 'George', 'Leigh Isidro', 'sample.com', '2023-08-04', 'ICT', 'Fixed Asset');

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
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
