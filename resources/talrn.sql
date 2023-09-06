-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 15, 2022 at 06:16 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talrn`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'Talrn', '2', '13', 'READING', '234234235', 'India', 'This is just an testing', 'INR');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Super Administrator', 'a:15:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createStore\";i:9;s:11:\"updateStore\";i:10;s:9:\"viewStore\";i:11;s:11:\"deleteStore\";i:12;s:13:\"updateCompany\";i:13;s:13:\"updateSetting\";i:14;s:11:\"viewProfile\";}'),
(10, 'Manager', 'a:11:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"updateStore\";i:8;s:9:\"viewStore\";i:9;s:13:\"updateSetting\";i:10;s:11:\"viewProfile\";}'),
(11, 'User', 'a:2:{i:0;s:13:\"updateSetting\";i:1;s:11:\"viewProfile\";}');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `english` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `skills` json NOT NULL,
  `exp` varchar(255) NOT NULL,
  `comittment` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `userPhoto` varchar(255) NOT NULL,
  `userResume` varchar(255) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `vendor_id`, `first_name`, `last_name`, `country`, `citizenship`, `english`, `reason`, `skills`, `exp`, `comittment`, `linkedin`, `github`, `userPhoto`, `userResume`, `bio`) VALUES
(2, 1, 'Suresh', 'Kumsr', 'Bangalore', 'indian', 'native', 'I want the freedom and flexibility of remote work.', '[\"Xcode\", \"Coderunner\"]', '2 to 5 years', 'Part-time', 'http://linkedin.com/in/sureshkutti', 'github.com/2suresh', '1644434314989.jpg', 'DIS Request Form.pdf', 'test bio'),
(3, 1, 'Suresh', 'Kumar', 'Bangalore', 'Indina', 'basic', 'I need extra work or income opportunities.', '[\"Xcode\", \"Flawless (App design)\"]', '2 to 5 years', 'Part-time', 'linkedin.com/in/sureshkutti', 'github.com/2suresh', '1*I0vZtAl_Km-6BAMYK1k2lg.jpeg', 'document.pdf', 'this is short bio...');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `website`, `active`) VALUES
(1, 'BlueStone Pvt Ltd', NULL, 1),
(6, 'ABC Consultant', NULL, 1),
(7, 'test', NULL, 1),
(8, 'test', NULL, 1),
(9, 'test', NULL, 1),
(10, 'test', NULL, 1),
(11, 'test', NULL, 1),
(12, 'test', NULL, 1),
(13, 'test', NULL, 1),
(14, 'BMW', NULL, 1),
(15, 'BMW', NULL, 1),
(16, 'BMW', NULL, 1),
(17, 'benz', NULL, 1),
(18, 'test', 'http://in.com', 1),
(19, 'weare', 'http://weare.com', 1),
(20, 'weare2', 'weare2.in', 1),
(21, 'test000', 'test000.in', 1),
(22, 'test001', 'test010.in', 1),
(23, 'test0010', 'test0110.in', 1),
(24, 'test0019', 'test0190.in', 1),
(25, 'test001999999', 'test019980.in', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`, `store_id`) VALUES
(1, 'admin', '$2y$10$NvC.69j6/HTyikh7DhCYv.8u1qA1bkaSSFZgHFYQSP4UP24ybaRua', 'admin@admin.com', 'Bala', 'Chandran', '8078999811', 1, 1),
(2, 'manager', '$2y$10$tGDcp.SNUFG4t5rf0fYwX.kItdiyhbd5nCDeuZWmcAYJwjLkSLSRq', 'manager@manager.com', 'manager', '', '9876543210', 1, 6),
(11, 'BMW', '$2y$10$5KOo8IQomW4mWS584WFlHeExRAFBxkIwc5OqdDBYy4jcx/fAizsoS', 'sureshkutti@gmail.com', 'Suresh', 'Kumar', '9886089959', 1, 16),
(12, 'benz', '$2y$10$x8NRPX.HVrRlyX0sQ0QyMObn85fj03nyll8eoAGPm4nOlAdW5TtAG', 'burnwed@gmail.com', 'Suresh', 'Kumar', '9000012345', 1, 17),
(13, 'test', '$2y$10$yiEA65SEsTHxJHXbhQKrAOD94q6fFek5N/x7IGYFQ1bW46A73zLA.', 'test@in.com', 'test', 'test', '7654321890', 1, 18),
(14, 'weare', '$2y$10$dfS3AgjCnSXZp7T7RzjeaOEVAg.F8S1D8wQsdNSHPdeNhwKfBWhry', 'test@weare.com', 'we', 'are', '8765400001', 1, 19),
(15, 'weare2', '$2y$10$dw1ShjSeSSGrQtBMgqOlDePzSiTou.xejz/E8E12dztwfN3pRwIVu', 'test@weare2.in', 'we', 'are', '8760001234', 1, 20),
(16, 'bebold', '$2y$10$c2WRq3wmNHQ7M98QbJC2zO.A4.dRpBTkaP0woc8lorsNFRYvLQauO', 'beold@gmail.com', 'be', 'bold', '9876543210', 2, 16),
(17, 'test000', '$2y$10$UDmhEO1AMAUz6MXnhg8ZfOMfkzozUJGuAcKra4CP0pYFIZDflkg5e', 'test000@gmail.com', 'test00', 'test00', '9876511110', 1, 21),
(18, 'test001', '$2y$10$eXJcUyiJZJ1ewJu737TIMemTlZzR.mHPKaqWtAOw75wP2SxAt/cxm', 'test001@gmail.com', 'test00', 'test00', '9876511111', 1, 22),
(19, 'test0010', '$2y$10$Cuhnbu4KfAbU55uevPWf0.Jw1L//Wm.qEKCVs49xEI2Ojyz0TMpW6', 'test0010@gmail.com', 'test00', 'test00', '9876511100', 1, 23),
(20, 'test0019', '$2y$10$okM0lLjBvthV2/R36xp6tO6xtdkPnqQmXQSInRxY6Dyr7F4CWMpRi', 'test0019@gmail.com', 'test00', 'test00', '9876511109', 1, 24),
(21, 'test001999999', '$2y$10$hMt6nrvG30mO8yw725W6PeNHyhmuraf6/xfWWArOUo7srK1RBpN0G', 'test0019999@gmail.com', 'test00999', 'test0000000', '9876511198', 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(11, 10, 10),
(12, 11, 10),
(13, 2, 10),
(14, 3, 11),
(15, 4, 11),
(16, 5, 11),
(17, 6, 11),
(18, 7, 11),
(19, 8, 11),
(20, 9, 11),
(21, 10, 11),
(22, 11, 11),
(23, 12, 11),
(24, 13, 11),
(25, 14, 11),
(26, 15, 11),
(27, 16, 11),
(28, 17, 11),
(29, 18, 11),
(30, 19, 11),
(31, 20, 11),
(32, 21, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `stores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
