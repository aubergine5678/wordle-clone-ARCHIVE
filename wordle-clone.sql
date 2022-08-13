-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2022 at 05:51 PM
-- Server version: 10.6.7-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordle-clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(64) NOT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_520_ci NOT NULL,
  `attempts` int(64) NOT NULL,
  `time` int(64) NOT NULL,
  `game_type` varchar(255) COLLATE utf8mb3_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `username` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `success_rate` float NOT NULL DEFAULT 0,
  `avg_attempts` float NOT NULL DEFAULT 0,
  `avg_time` time(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `surname`, `dob`, `password`, `success_rate`, `avg_attempts`, `avg_time`) VALUES
(1, 'testing-user', 'Testing', 'User', '1995-07-11', '$2y$10$GQBu9L7MCU9So0BwykrCMOZGX7S3CN.sTxv5JIa1nfn4zb1vjWfFO', 0, 0, NULL),
(3, 'willyuhm', 'will', 'cummings', '2001-08-27', '$2y$10$cGkTgUfsSCQgu4IQgBe/.e69RR6SygYWsozQz11qLC7tRVLG5NsrC', 0, 0, NULL),
(4, 'sneaky-potato', 'Snake', 'Potato', '1995-04-05', '$2y$10$pedyCMNAG1fVb6UOQIlHR.n7OFvoLu5mxpHzwapK/wXlHCz/pD7PO', 0, 0, NULL),
(5, 'Answashe', 'Phoebe', 'Lynch', '1993-04-19', '$2y$10$E8M8TIfA1Pq5r4XiMeN7Be4wdtdEU12YM0WGbVNfgHNzNJ3D2Ovjm', 0, 0, NULL),
(6, 'Youtre', 'Peter', 'Savage', '1992-04-13', '$2y$10$conzLCOkbBkyMtm/eGuY8OEFcXYUqnbLT3Ykxi/A4oBP.cyPWinVG', 0, 0, NULL),
(7, 'Geory2000', 'Thomas', 'Nicholson', '1966-04-05', '$2y$10$jsP6Ek/zNmH4fwLocD2jueXCactHsr.bNImKMIJAbU1u4Q5lEeXkS', 0, 0, NULL),
(8, 'Prawn1954', 'Leon', 'Wythenshawe', '1954-11-17', '$2y$10$jsP6Ek/zNmH4fwLocD2jueXCactHsr.bNImKMIJAbU1u4Q5lEeXkS', 0, 0, NULL),
(9, 'Proccomped', 'Alfie', 'Dunn', '2000-04-05', '$2y$10$xqjsojOAwUzj9Hp8clDon.P/eFoBvywfbiTeyBqtdvWZInggaUDFq', 0, 0, NULL),
(10, 'Gessookin', 'Dominic', 'Nixon', '1992-04-08', '$2y$10$LjAoHIsyfUFrRvTbr9MKkeAv.479o8nFVJGJchR0mNtSWtoPbD0wy', 0, 0, NULL),
(11, 'Seseely', 'Cerys', 'Watson', '2001-04-16', '$2y$10$eZ8IraC0G07WOEA7AGm25.m1iic7j0K90mMmaFcpnMBE7/3HXc3C2', 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=635;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
