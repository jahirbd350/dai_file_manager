-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2021 at 10:48 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dai_file_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `authority` varchar(255) NOT NULL,
  `file_info` varchar(255) NOT NULL,
  `from_section` varchar(100) NOT NULL,
  `to_section` varchar(100) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `section_name`, `password`) VALUES
(1, 'techsec', 'Technical Section, Dte AI', '12345'),
(2, 'issec', 'IS Section, Dte AI', '12345'),
(3, 'daior', 'Orderly Room, Dte AI', '12345'),
(4, 'pubsec', 'Pub Sec, Dte AI', '12345'),
(5, 'opssec', 'Ops Sec, Dte AI', '12345'),
(6, 'photosec', 'Photo Sec, Dte AI', '12345'),
(7, 'sysec', 'Sy Sec, Dte AI', '12345'),
(8, 'cisec', 'CI Sec, Dte AI', '12345'),
(9, 'no1fu', 'No 1 FU, BAF', '12345'),
(10, 'no2fu', 'No 2 FU, BAF', '12345'),
(11, 'no3fu', 'No 3 FU, BAF', '12345'),
(12, 'no4fu', 'No 4 FU, BAF', '12345'),
(13, 'no5fu', 'No 5 FU, BAF', '12345'),
(14, 'no6fu', 'No 6 FU, BAF', '12345'),
(15, 'adis', 'ADAI (IS), Dte AI', '12345'),
(16, 'dai', 'Director, Dte AI', '12345'),
(17, 'ddaici', 'DDAI (CI), Dte AI', '12345'),
(18, 'ddaiops', 'DDAI (Ops), Dte AI', '12345'),
(19, 'adaici', 'ADAI (CI), Dte AI', '12345'),
(20, 'adaiops', 'ADAI (Ops), Dte AI', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
