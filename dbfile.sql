-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 03:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_tb`
--

CREATE TABLE `category_tb` (
  `Id` int(11) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `CategoryType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_tb`
--

INSERT INTO `category_tb` (`Id`, `Category`, `CategoryType`) VALUES
(2, 'SALARY', 'Expense'),
(6, 'Test', 'Income'),
(7, 'SALARY', 'Income'),
(9, 'SALARY2', 'Income');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tb`
--

CREATE TABLE `transaction_tb` (
  `Id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Amount` int(11) NOT NULL,
  `TransactionType` varchar(50) NOT NULL,
  `TransactionDate` date NOT NULL,
  `RTransaction` varchar(50) NOT NULL,
  `ImageUrl` varchar(100) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_tb`
--

INSERT INTO `transaction_tb` (`Id`, `Title`, `Category`, `Amount`, `TransactionType`, `TransactionDate`, `RTransaction`, `ImageUrl`, `UserId`) VALUES
(28, '1', 'SALARY', 500, 'Income', '2022-04-14', 'False', '', 3),
(29, '2', 'Other', 500, 'Income', '2022-05-14', 'False', '', 3),
(30, '3', 'SALARY', 500, 'Income', '2022-06-14', 'False', '', 3),
(31, '1', 'FOOD', 400, 'Expense', '2022-04-14', 'False', '', 3),
(32, '2', 'BILLS', 500, 'Expense', '2022-04-14', 'False', '', 3),
(33, '3', 'BILLS', 500, 'Expense', '2022-06-14', 'False', '', 3),
(34, '4', 'SALARY2', 1000, 'Income', '2022-04-14', 'False', '', 3),
(35, '4', 'REPETITIVE', 500, 'Expense', '2022-06-15', 'False', '', 3),
(36, '5', 'SERVICES', 500, 'Expense', '2022-04-14', 'False', '', 3),
(37, '5', 'REPETITIVE', 700, 'Expense', '2022-04-15', 'False', 'home (3).png', 3),
(38, '6', 'ENTERTAINMENT', 500, 'Expense', '2022-04-15', 'False', 'sincerely-media-_-hjiem5TqI-unsplash.jpg', 3),
(39, '5', 'SALARY', 5000, 'Income', '2022-04-15', 'False', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `UserPassword` varchar(600) NOT NULL,
  `UserCode` int(11) NOT NULL,
  `UserStatus` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`UserId`, `UserName`, `UserEmail`, `UserPassword`, `UserCode`, `UserStatus`) VALUES
(3, 'Abubakar', 'f180207@nu.edu.pk', '$2y$10$Nll.Cx4qoxlcjzkmbgAz5.7yd2vMmRLx5RsMQipj1ELhNHiXB4IaO', 0, 'verified'),
(15, 'Abubakar', 'malikzada624@gmail.com', '$2y$10$dwaOop1UG6VGhqksORduS.vvoMkveHEJEYh/ZZIZX.RdY3mf7.hyC', 0, 'verified'),
(16, 'Ali', 'ma3800406@gmail.com', '$2y$10$zU92dCWm4CRIIrPrY95cG.dyIZFtOKNkh35Uiz/5p0fEMyXiSA23u', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_tb`
--
ALTER TABLE `category_tb`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `transaction_tb`
--
ALTER TABLE `transaction_tb`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_tb`
--
ALTER TABLE `category_tb`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_tb`
--
ALTER TABLE `transaction_tb`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction_tb`
--
ALTER TABLE `transaction_tb`
  ADD CONSTRAINT `transaction_tb_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users_tb` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
