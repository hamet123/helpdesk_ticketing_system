-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 07:36 PM
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
-- Database: `helpdesk_123`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department`) VALUES
(4002, 'B.Ed. Online Counseling		'),
(4921, 'Miscellaneous Fee Portal'),
(5386, 'Alumni'),
(5715, 'Hostel'),
(5894, 'Admissions'),
(6424, 'Registration and Migration'),
(6666, 'Examinations'),
(7705, 'Recruitment');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_no` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `department` varchar(255) NOT NULL,
  `attached_file` varchar(255) NOT NULL,
  `created_by_user` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `assigned_to` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `closed_on` timestamp NULL DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_no`, `username`, `title`, `description`, `department`, `attached_file`, `created_by_user`, `created_on`, `assigned_to`, `status`, `closed_on`, `duration`) VALUES
(347388, 'banita330@gmail.com', 'B.Ed. form issue', 'Hi, I am unable to fill the online application form !', 'Admissions', '../uploads/4960-pic.jpg', 50, '2023-07-17 13:54:28', 'hpu.ccentre@gmail.com', 'closed', '2023-07-26 13:53:14', '8 days 23 hours 58 minutes '),
(505300, 'banita330@gmail.com', 'counseling issues in maths', 'merit list not downloading', 'Admissions', '../uploads/9290-bgmain.jpg', 50, '2023-07-21 18:25:58', 'hpu.ccentre@gmail.com', 'closed', '2023-07-23 11:07:40', '1 days 16 hours 41 minutes '),
(622702, 'banita330@gmail.com', 'Miscallaneous fee issues', 'Unable to pay fee online', 'Admissions', '../uploads/7128-img1.png', 50, '2023-07-20 16:26:10', 'hpu.ccentre@gmail.com', 'closed', '2023-07-25 18:14:04', '5 days 1 hours 47 minutes '),
(626628, '123@hochha.com', 'asdfgh', 'ljlkjlljljljlkjklj', 'Admissions', '../uploads/2023-img2.png', 49, '2023-07-25 18:29:38', 'hpu.ccentre@gmail.com', 'open', NULL, NULL),
(704656, 'banita330@gmail.com', 'new titile', 'my agent booking', 'Admissions', '../uploads/6446-bgmain.jpg', 50, '2023-07-23 11:07:04', 'hpu.ccentre@gmail.com', 'open', NULL, NULL),
(816541, '123@hochha.com', 'finally a exam', 'this ticket belongs to exams', 'Examinations', '../uploads/6020-dry-fruit-mart-credentials.jpg', 49, '2023-07-18 18:40:41', 'exams.ccentre@gmail.com', 'closed', '2023-07-26 15:38:40', '7 days 20 hours 57 minutes '),
(828608, 'banita330@gmail.com', 'B.Ed. online counseling', 'merit list showing wrong numbers', 'Registration and Migration', '../uploads/7510-img2.png', 50, '2023-07-20 16:29:40', 'rme.ccentre@gmail.com', 'closed', '2023-07-23 07:00:29', '2 days 14 hours 30 minutes '),
(901821, 'banita330@gmail.com', 'unable to upload the documents', 'pic, sign not uploading ', 'Examinations', '../uploads/3585-img4.png', 50, '2023-07-20 16:29:00', 'exams.ccentre@gmail.com', 'Re Opened', NULL, '5 days 1 hours 49 minutes ');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `ticket_no` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `comment_id` int(100) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_comments`
--

INSERT INTO `ticket_comments` (`ticket_no`, `user_id`, `comment_id`, `comment_text`, `created_on`) VALUES
(347388, 49, 12, 'Please resolve it as soon as possible !!', '2023-07-18 18:03:02'),
(347388, 49, 13, 'Sure I will !\r\n', '2023-07-18 18:03:16'),
(347388, 50, 14, 'Thank You !!!', '2023-07-18 18:14:10'),
(816541, 56, 15, 'hello', '2023-07-18 19:16:01'),
(622702, 55, 16, 'this is good', '2023-07-21 16:44:30'),
(622702, 50, 17, ' this is good this is good this is good this is good this is good this is good this is goodthis is good this is good this is good  this is good this is goodthis is good  this is good this is good this is good this is good this is good this is good this is', '2023-07-21 18:19:06'),
(816541, 49, 18, 'Hi', '2023-07-25 18:30:39'),
(347388, 49, 19, 'ok', '2023-07-26 19:48:41'),
(347388, 49, 20, 'what ?', '2023-07-26 20:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `serialno` int(9) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone_no` varchar(10) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `account_createdon` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo_uploaded` varchar(255) DEFAULT NULL,
  `associated_department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`serialno`, `firstname`, `lastname`, `username`, `phone_no`, `role`, `password`, `account_createdon`, `photo_uploaded`, `associated_department`) VALUES
(49, 'admin', 'admin', 'admin@helpdesk.com', NULL, 'admin', '$2y$10$8TxkL.FDTVmm22hyE5lKt.z6Ex/7dV.ZsV6Txj.xh1lvVjSZajSui', '2023-07-13 20:10:50', '../uploads/photos/9528-pic.jpg', NULL),
(50, 'user', 'user', 'user@helpdesk.com', '7018010410', 'user', '$2y$10$F9r97Xn1j580HEdvML7kaO2Y9TaufRQRzBo0iNl2fFAhjsbqVRccm', '2023-07-16 10:44:30', '../uploads/photos/9805-img2.png', NULL),
(55, 'ayush', 'sood', 'hpu.ccentre@gmail.com', NULL, 'agent', '$2y$10$cEoIYGaiWUih6OxNP795qesSdm3w1sEDxNFnIyMpgbd00PHfgpVbW', '2023-07-16 18:56:31', NULL, 'Admissions'),
(56, 'ayush', 'sood', 'exams.ccentre@gmail.com', NULL, 'agent', '$2y$10$zBWwzE4J0ejXjyC3USmogO41sdY4djgLv.AUK1J7uQYzWhGtFnEAC', '2023-07-17 13:46:02', NULL, 'Examinations'),
(57, 'RME', 'Branch', 'rme.ccentre@gmail.com', NULL, 'agent', '$2y$10$z8DcPA.68U8yszw6R10GoeKwFd93fzrs31RGIUWMeP4cnB9qo2cmq', '2023-07-17 13:47:25', NULL, 'Registration and Migration');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_no`);

--
-- Indexes for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`comment_id`,`ticket_no`,`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`serialno`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7706;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=999389;

--
-- AUTO_INCREMENT for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `comment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `serialno` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
