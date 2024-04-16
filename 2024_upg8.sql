-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 10:32 AM
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
-- Database: `2024_upg8`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_role`
--

CREATE TABLE `table_role` (
  `r_id` int(11) NOT NULL,
  `r_name` varchar(255) NOT NULL,
  `r_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_role`
--

INSERT INTO `table_role` (`r_id`, `r_name`, `r_level`) VALUES
(1, 'User', 10),
(2, 'Moderator', 50),
(3, 'Administrator', 500),
(4, 'guest', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(512) NOT NULL,
  `u_role_fk` int(11) NOT NULL,
  `u_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`u_id`, `u_name`, `u_email`, `u_password`, `u_role_fk`, `u_status`) VALUES
(1, 'asd', 'asdads@asd', 'asd', 0, 0),
(3, 'Dan', 'dan@gmail.com', '$2y$10$A7m1HkAvZY0XTVmO/2231.Sxq06BtHCDudv8HKjnl0aSfPQYxOBTu', 0, 0),
(4, 'Dan', 'dan@gmail.com', '$2y$10$aFp1mO24Dk9SrfrDxY30x.FRJ1.qMAswAJ9L6YzJnOu5hOkSpjJC.', 0, 0),
(5, 'Dan', 'dan@gmail.com', '$2y$10$fL4yETAWLMHzAH/qRey45e25M3Z9JQkTmxYsb0.EAkAfILxPBpm/y', 0, 0),
(6, 'Ben', 'ben@gmail.com', '$2y$10$4zajw7nGy9OE61/.H/k6I.7b8FLATABgihR0ZDytdeIveSRXz3D..', 0, 0),
(7, 'asdad', 'asdaasd@asdasd.asdasd', '$2y$10$nUMoVo39I9XO8BuDvggfX.KBT5r5zCSizlUqf8ugXbQoXYHkvpSie', 1, 1),
(8, 'oioioi', 'oioi@oioi.com', '$2y$10$GOopfjS6bgeG28s.U3pdhO.pq.tyCT2svM7fG3uKfugXwFy0lbCCu', 1, 1),
(9, 'axel', 'axel@gmail.com', '$2y$10$z1ecYgqcXZGFJvzO0B1b8OH5XIa4qvov.KBMUzlebYo6WUYOMDS8e', 3, 1),
(10, 'bam', 'bam@bam.com', '$2y$10$Q7UsOx6YF6F.viWyxBfWLOsoneqJcwu9/okO0mtQQt05bKr1n8SU.', 1, 1),
(11, 'daniel', 'daniel@gmail.com', '$2y$10$QT085AzIWy017zd1OGs4Fuw53MhRVE6k4j00L/J4ltxm5/RPb.KWG', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_role`
--
ALTER TABLE `table_role`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_role_fk` (`u_role_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_role`
--
ALTER TABLE `table_role`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
