-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 07:51 PM
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
(1, '', '', '', NULL, 0),
(2, 'sdfcwf', '', '', '', 0),
(5, 'ppp', '', '', '', 0),
(10, '123', '', '', '', 1),
(11, '123', '', '', '', 1),
(12, 'unique', '', '', '', 1),
(13, 'unique', '', '', '', 1),
(14, 'uni', '', '', '', 1),
(15, '1', '11111111111111', '', '', 1),
(16, 'swqsq', '', '', '', 1),
(17, 'w', '', '', '', 1),
(23, 'ddddddd', '', '', '', 1),
(24, 'sdsd', '', '', '', 1),
(25, 'edecwedc', 'sdxsd', '2023-06-', '20:00', 1),
(26, '123123151515', '', '', '', 37),
(27, 'Павла Манова', '', '', '', 1),
(28, 'Павла Манова', '', '', '', 1),
(29, 'hh', '', '', '', 1);

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
(8, 'whistle', 'Whistle', './sounds/whistle.wav', 4);

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
(5, 1),
(2, 1),
(5, 1),
(5, 15),
(1, 5),
(18, 10),
(19, 10),
(18, 26),
(18, 27);

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
  `user_points` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar_img_path`, `user_points`) VALUES
(1, 'pmmanova', '$2y$10$cHv.pq8L91ri9SmYXwFoDeNUek2Uml8m0ELKKWn9meaHxipm6iz0q', 'pavla.mano5@gmail.com', 'uploads/1.png', 100),
(2, 'pmmanova12', '$2y$10$liWUChqNpjMozqOCA7F7gOo/G.pxdjSKoY/Cu8WflvY7T63ggKkoi', 'pmanova@weband.bg', 'uploads/1.png', 0),
(3, 'pavli_manova', '$2y$10$fxw2jhOP6e0OvtN1UELtT.8DnCwrtRzrdIIObuISU1d/PmF3wlfD2', 'liya.manova@gmail.com', 'uploads/1.png', 0),
(4, '1', '$2y$10$dFEBwQlpm9.1FnPjOiR2pOeOB265YuLZl0frJiecXiJepKRBRnfoS', '1@abv.bg', 'uploads/1.png', 0),
(5, 'pmmanovaqedw', '$2y$10$gS1uGWTgLWxOeO/bQsKHle7Be.d8NbwsRkRejCfR34p5rn.zARuhO', 'pavla.mano5@gmail.com', 'uploads/pmmanovaqedw_', 200),
(12, 'plsstani', '$2y$10$IW/ixXBwxYZ3Iwy9w3sQ/uOG42meeqtSn16a1czUTAi6RQUj7ji8O', 'pavla.mano5@gmail.com', 'uploads/received_500659280724091.jpeg', 0),
(14, 'pmmanova123123', '$2y$10$UeyVU5ISpBFP7fBOj7F2zuyTH2dv0hZgJNAzCgTkZ4.ni9XxWvr4W', 'pavla.mano5@gmail.com', 'uploads/output_1576761682533.jpg', 0),
(16, 'Pavli', '$2y$10$TbQUUIyX3ug8K2aa5KWpQ.ZJGXGsl2CT0.hqIRIYaGXjr9EuCevxC', 'pavla.mano5@gmail.com', 'uploads/15.jpg', 0),
(17, 'pesho', '$2y$10$F6sdEWU2QLKB816PahbgWeVU2u.jeuKTXF6eI4CJ4B3DhqLzCSY3G', 'pavla.mano5@gmail.com', 'uploads/received_2597892083767790.jpeg', 0),
(18, 'tedo', '$2y$10$uCdSiPkVijJHpSQDYZWrkeYiDXBLONpzcha7OYBLd84vowhXlFNwK', 'desislava.manova.dm@gmail.com', 'uploads/1633856377298.jpg', 123),
(19, 'proba', '$2y$10$AOkw06rsMtwl72VwL0tUSeftz8sRzfYnfVhUDJBlSG1bpwrhiGvNq', 'pavla.mano5@gmail.com', 'uploads/IMG_20190912_205556_457.jpg', 0),
(34, ',,,,,,,', '$2y$10$UsdblBFt/QMCBUx0eKOh7.1Q5DaDdqvBm.uEORsETVLsHH1AcYXtG', 'pavla.mano5@gmail.com', 'uploads/1.png', 0),
(35, 'pmmanova', '$2y$10$HDFXs3Sgkc/tMT.aKoGiaugidvyw0emrmrQxlBi/6JuZS2S.SKuWy', 'pavla.mano5@gmail.com', 'uploads/1.png', 0),
(36, 'azazazaz', '$2y$10$f.RCEbsByCpQ7jAiIKtiDORjTe4sb4Bgf1j1xtgeuXk8/92VIwX6.', 'pavla.mano5@gmail.com', 'uploads/1.png', 0),
(37, 'desi', '$2y$10$YX478fZBbmawvXxqVu102eQv8aCeX3PvhWBdM8FgDXOhsHspSbgwq', 'pavla.mano5@gmail.com', 'uploads/1.png', 0);

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
(18, 8);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sounds`
--
ALTER TABLE `sounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
