-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 05:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eljohn_perez`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_levels`
--

CREATE TABLE `access_levels` (
  `access_level_id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_levels`
--

INSERT INTO `access_levels` (`access_level_id`, `description`) VALUES
(1, 'Super User'),
(2, 'Normal User');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `birth_date` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `job_title` varchar(45) DEFAULT NULL,
  `access_level_id` varchar(45) DEFAULT NULL,
  `date_modified` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `firstname`, `lastname`, `age`, `birth_date`, `email`, `password`, `date_created`, `job_title`, `access_level_id`, `date_modified`) VALUES
(1, 'Eljohn', 'Perez', '27', '1996-09-19', 'eljohnp417@gmail.com', '$2y$10$UhFrIFsI.4bMBi.Ij20Bo.MZ4zAqSgAXfQzNYtXvxbOmA6/.otH0O', '2024-03-07 10:54:39', 'Web developer', '1', '24-03-07'),
(2, 'John', 'Doe', '22', '2024-03-01', 'johndose@mail.com', '$2y$10$NOMJmmmAvUbrq7BFZcZCh.GAfhB/OJavKCKGcc7ZoA/54u4oZ2VlK', '2024-03-07 10:55:37', 'Web developer', '1', '24-03-07'),
(5, 'Chris', 'Towe', '33', '2024-03-15', 'testmail@mail.com', '$2y$10$NOMJmmmAvUbrq7BFZcZCh.GAfhB/OJavKCKGcc7ZoA/54u4oZ2VlK', '2024-03-07 11:07:51', 'Web developer', '2', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_levels`
--
ALTER TABLE `access_levels`
  ADD PRIMARY KEY (`access_level_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_levels`
--
ALTER TABLE `access_levels`
  MODIFY `access_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
