-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 05:43 PM
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
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `event_date` varchar(8) DEFAULT NULL,
  `event_time` varchar(8) DEFAULT NULL,
  `host_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `event_date`, `event_time`, `host_id`) VALUES
(57, 'Проба', '', '2023-07-', '18:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sounds`
--

CREATE TABLE `sounds` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category` enum('Applause','Laugh','Booing','Bravo!','Whistle','Cheering','Disappointment','Distinct Chatter') NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sounds`
--

INSERT INTO `sounds` (`id`, `name`, `category`, `path`, `points`) VALUES
(1, 'applaus', 'Bravo!', './sounds/applaus.wav', 3),
(2, 'booing', 'Booing', './sounds/booing.mp3', 1),
(3, 'cheering', 'Cheering', './sounds/cheering.mp3', 5),
(4, 'child-laughing', 'Laugh', './sounds/child-laughing.wav', 3),
(5, 'clapping', 'Applause', './sounds/clapping.wav', 2),
(6, 'failfare', 'Disappointment', './sounds/failfare.mp3', 2),
(7, 'whispering', 'Distinct Chatter', './sounds/whispering.mp3', 1),
(8, 'whistle', 'Whistle', './sounds/whistle.wav', 4),
(9, 'laughing man', 'Laugh', './sounds/laughing-man.mp3', 4),
(10, 'laughing child', 'Laugh', './sounds/laughter.mp3', 1),
(11, 'soft-laughing', 'Laugh', './sounds/soft-laughing.mp3', 3),
(12, 'woman_laughs', 'Laugh', './sounds/woman_laughs.mp3', 5);

-- --------------------------------------------------------

--
-- Table structure for table `userevents`
--

CREATE TABLE `userevents` (
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userevents`
--

INSERT INTO `userevents` (`user_id`, `event_id`) VALUES
(18, 57),
(39, 57);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar_img_path` varchar(250) DEFAULT 'uploads/1.png',
  `user_points` int(10) UNSIGNED NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar_img_path`, `user_points`) VALUES
(1, 'milen', '$2y$10$cHv.pq8L91ri9SmYXwFoDeNUek2Uml8m0ELKKWn9meaHxipm6iz0q', 'pavla.mano5@gmail.com', './uploads/profile.jpg', 92),
(18, 'pavla', '$2y$10$uCdSiPkVijJHpSQDYZWrkeYiDXBLONpzcha7OYBLd84vowhXlFNwK', 'desislava.manova.dm@gmail.com', 'uploads/1633856377298.jpg', 146),
(37, 'desi', '$2y$10$YX478fZBbmawvXxqVu102eQv8aCeX3PvhWBdM8FgDXOhsHspSbgwq', 'pavla.mano5@gmail.com', 'uploads/1.png', 0),
(38, 'nikol', '$2y$10$xBwtYFiiMLe2J/HGNIi.GuZGGH74NwTg3gRVwqOETX.WyF.0F/ieq', 'higewih843@dotvilla.com', 'uploads/1.png', 0),
(39, 'mimi2', '$2y$10$EyMIGxJ8rUIb9KpSXbJP9eK51EelofnYo0G4SMQ7rlTlRFEGyICMy', 'a@a.b', 'uploads/1.png', 102);

-- --------------------------------------------------------

--
-- Table structure for table `usersounds`
--

CREATE TABLE `usersounds` (
  `user_id` int(11) DEFAULT NULL,
  `sound_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersounds`
--

INSERT INTO `usersounds` (`user_id`, `sound_id`) VALUES
(1, 1),
(1, 4),
(18, 2),
(18, 1),
(18, 3),
(18, 8),
(1, 5),
(1, 5),
(1, 8),
(1, 8),
(1, 3),
(1, 3),
(1, 6),
(1, 7),
(1, 2),
(1, 2),
(1, 2),
(1, 2),
(39, 5),
(18, 5),
(1, 9),
(1, 10),
(1, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sounds`
--
ALTER TABLE `sounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userevents`
--
ALTER TABLE `userevents`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersounds`
--
ALTER TABLE `usersounds`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sound_id` (`sound_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `sounds`
--
ALTER TABLE `sounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userevents`
--
ALTER TABLE `userevents`
  ADD CONSTRAINT `userevents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userevents_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `usersounds`
--
ALTER TABLE `usersounds`
  ADD CONSTRAINT `usersounds_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `usersounds_ibfk_2` FOREIGN KEY (`sound_id`) REFERENCES `sounds` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
