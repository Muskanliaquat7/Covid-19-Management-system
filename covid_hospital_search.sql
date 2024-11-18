-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 04:31 PM
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
-- Database: `covid_hospital_search`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_name`, `contact`, `hospital_name`, `appointment_date`, `status`) VALUES
(1, 'ashle', '12121212', 'times', '2024-11-20', 'Pending'),
(2, 'ashle', '12121212', 'times', '2024-11-20', 'Approved'),
(3, 'sara', '232 2323 34', 'patel', '2024-12-07', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `address`, `city`, `phone`, `type`) VALUES
(1, 'City Hospital', '123 Main St', 'Lahore', '042-1234567', 'Testing'),
(2, 'Health Center', '456 Market Rd', 'Karachi', '021-7654321', 'Vaccination'),
(3, 'Wellness Hospital', '789 Clinic Ave', 'Islamabad', '051-9876543', 'Testing'),
(4, 'Covid Care Center', '321 Service Ln', 'Lahore', '042-5551234', 'Vaccination');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `test_result` varchar(255) NOT NULL,
  `vaccination_suggestion` text NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `patient_name`, `test_result`, `vaccination_suggestion`, `report_date`) VALUES
(1, 'John Doe', 'Negative', 'You are safe. Please follow vaccination guidelines.', '2024-11-18 06:22:14'),
(2, 'Jane Smith', 'Positive', 'Please take immediate action and get vaccinated.', '2024-11-18 06:22:14'),
(3, 'Alice Brown', 'Negative', 'You are safe. Keep monitoring your health and take the vaccine as per guidelines.', '2024-11-18 06:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `city` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `patient_name`, `contact`, `city`, `status`) VALUES
(1, 'Ali Khan', '0300-1234567', 'Lahore', 'Approved'),
(2, 'rooha', '1111 111 111', 'karachi', 'Approved'),
(3, 'alice', '22 13 2232', 'lahore', 'Pending'),
(4, 'jhon', '1231 342 42', 'isl', 'Approved'),
(5, 'damsel', '112 324 564', 'chicago', 'Rejected'),
(6, 'damsel', '112 324 564', 'chicago', 'Rejected'),
(7, 'damsel', '112 324 564', 'chicago', 'Pending'),
(8, 'damsel', '112 324 564', 'chicago', 'Rejected'),
(9, 'damsel', '112 324 564', 'chicago', 'Rejected'),
(10, 'damsel', '112 324 564', 'chicago', 'Rejected'),
(11, 'damsel', '112 324 564', 'chicago', 'Rejected'),
(12, 'damsel', '112 324 564', 'chicago', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
