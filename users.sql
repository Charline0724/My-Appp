-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 05:30 AM
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
-- Database: `app1`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','lgu') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `age`, `gender`, `address`, `username`, `password`, `profile_picture`, `email`, `role`) VALUES
(1, 'oo', 23, 'Female', 'pilar', 'oo', '$2y$10$tZhPhYh1bMk3pspjK5THfu.m/8DlvCBJpzVV6HT.DNRFf/DeijybG', 'uploads/cofeeee.png', NULL, 'user'),
(2, 'ikaw', 22, 'Female', 'Onion', 'ikaw@gmail.com', '$2y$10$EyZXwx1pzAnzQlRC3OGBxOgceP68ZUCTaPmwT3QeRj./17WLdzPlC', 'uploads/tri.jpg', 'yang@gmail.com', 'user'),
(4, 'Charline Salvaloza', 20, 'Female', 'Pilar', 'charline1', '$2y$10$iBDOwXcvw2aniKWIQLuJuecLsywxkLzLygx.LagtWG8fG.eKpuTXy', 'uploads/pic.jpg', NULL, 'user'),
(5, 'Elthea Lyn', 18, 'Female', 'Pilar', 'Elthea Lyn', '$2y$10$F/sN9bTofpf1BFCU0yg/Ou1p7pxT1liIWzdtvCXBga9L0qxYO3vQ.', 'uploads/Guyam, Siargao Island, Philippines….jpg', NULL, 'user'),
(6, '', 0, 'Male', '', 'admin', 'hashed_password_here', NULL, 'admin@example.com', 'lgu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
