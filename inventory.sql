-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2023 at 03:39 AM
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
  `quantity_bought` int(5) NOT NULL,
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

INSERT INTO `inventory` (`id`, `item_name`, `purchase_date`, `delivery_date`, `property_number`, `serial_number`, `model_number`, `description`, `manufacturer_name`, `quantity_bought`, `designation`, `received_by`, `supplier_name`, `OR_number`, `amount`, `transfer_history`, `ordered_by`, `requesting_person`, `ordering_person`, `receipt_link`, `issuance_date`, `assigned_office`, `remarks`) VALUES
(18, 'Laptop', '2023-07-01', '2023-08-01', 'OE-12345', 'DD8B1197-CF61-46B8-91A8-D28845787A1E', 'G15', 'Black, Backlit Keyboard', 'Dell', 1, 'New', 'George Isidro', 'Silicon Valley', '123ABC', 50000, 'None', 'Support Sector', 'Juan De La Cruz', 'Leigh Isidro', 'google.com', '2023-08-03', 'GSO', 'Fixed Asset'),
(19, 'Laptop', '2023-06-21', '2023-07-04', 'OE-45678', 'D25LN134F8J7', 'M1', 'Silver, Backlit Keyboard', 'Apple', 1, 'Available', 'Juan De La Cruz', 'PowerMAC Store', '456DEF', 80000, 'HS Faculty', 'High School Sector', 'Humprey Agustin', 'Leigh Isidro', 'facebook.com', '2023-07-08', 'HS Faculty', 'Fixed Asset'),
(20, 'Laptop Charger', '2023-07-05', '2023-07-20', 'OE-14572', 'ADL170NDC3A', 'G4030 Charger', 'Black Adapter and Cord', 'Lenovo', 1, 'Available', 'Regan Bernabat', 'Abenson', 'QWER6789', 2000, 'SHS Faculty', 'SHS Sector', 'Jericho Isidro', 'Leigh Isidro', 'twitter.com', '2023-07-24', 'SHS Faculty', 'Fixed Asset'),
(21, 'Crimping Tool', '2023-07-10', '2023-07-31', 'OE-23236', 'CR1MP1N6TO0L', 'V1', 'Wire Cutter', 'Fluke', 1, 'New', 'Seth Gamboa', 'Store X', '9i8u7u', 5000, 'None', 'ICT Department', 'Arnold Palanog', 'Leigh Isidro', 'https://drive.google.com/drive/folders/1fhbQqQwwpkWsiUyyJq2NiTMI7lkW5wpa', '2023-08-04', 'ICT Office', 'Fixed Asset'),
(22, 'Speaker', '2023-06-30', '2023-07-06', 'OE-14433', 'DFBCJ78H54S', 'Bomba', 'Black, Bluetooth Speaker', 'Promate', 2, 'Borrowed', 'Lebron James', 'Villman', '958642', 1500, 'None', 'Elementary Sector', 'Kobe Bryant', 'Leigh Isidro', 'instagram.com', '2023-07-07', 'ES Faculty', 'Fixed Asset');

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
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
