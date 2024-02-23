-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 04:21 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kitchen_spurs`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` varchar(120) DEFAULT NULL,
  `description` varchar(499) DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `status` varchar(120) NOT NULL,
  `assignUser` varchar(120) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifiedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `description`, `dueDate`, `status`, `assignUser`, `createdOn`, `modifiedOn`, `isDeleted`) VALUES
(1, 'demo-task', 'Exercitationem voluptatem Omnis et cupidatat modi nihil possimus accusamus nostrum sed magnam minus ullamco', '2024-02-20', 'Pending', '2', '2024-02-20 10:45:54', '2024-02-22 14:25:09', b'0'),
(2, 'work-task', 'ncdnchdndjcndcdjdjdndnvdnv', '2024-02-23', 'completed', '2', '2024-02-22 12:03:08', '2024-02-23 12:11:14', b'0'),
(3, 'practise', 'Non ut est cupidatat voluptatem nisi sit beatae cupiditate qui explicabo Voluptatum nesciunt', '2024-02-29', 'In Progress', '4', '2024-02-22 13:06:15', '2024-02-22 13:23:54', b'0'),
(4, 'Task', 'Sunt dolores voluptatem Itaque inventore quis adipisicing exercitationem pariatur Et tenetur blanditiis odio', '2024-12-31', 'Pending', '5', '2024-02-22 14:34:45', '2024-02-23 14:59:24', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifiedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `createdOn`, `modifiedOn`, `isDeleted`) VALUES
(1, 'John', 'john@gmail.com', '123456', '2024-02-20 08:55:06', '2024-02-21 13:34:02', b'0'),
(2, 'Fahad Qureshi', 'fahad@gmail.com', '123456', '2024-02-20 08:55:06', '2024-02-21 13:34:02', b'0'),
(3, 'peter', 'peter@gmail.com', '123456', '2024-02-21 15:06:14', '2024-02-21 15:06:14', b'0'),
(4, 'henry', 'henry@gmail.com', '123456', '2024-02-21 15:42:07', '2024-02-21 15:42:07', b'0'),
(5, 'Spiderman', 'sp@gmail.com', '12345', '2024-02-22 14:33:56', '2024-02-22 14:33:56', b'0'),
(6, 'jack', 'jack@gmail.com', '123456', '2024-02-23 14:43:10', '2024-02-23 14:43:10', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
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
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
