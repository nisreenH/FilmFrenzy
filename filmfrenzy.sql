-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2024 at 09:55 AM
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
-- Database: `filmfrenzy`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `movie_id`) VALUES
(12, 0),
(12, 155),
(11, 238),
(12, 238),
(12, 240),
(11, 424),
(12, 424),
(12, 429),
(11, 680),
(11, 769),
(12, 38700),
(12, 150540),
(11, 496243),
(12, 573435),
(12, 614933),
(11, 693134),
(12, 693134),
(12, 719221),
(12, 746036),
(12, 872585),
(11, 929590),
(12, 929590),
(7, 934632),
(7, 1011985),
(11, 1011985),
(12, 1181678);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `list_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `list_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`list_id`, `user_id`, `list_name`, `created_at`) VALUES
(1, 11, 'Action', '2024-06-26 06:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `list_items`
--

CREATE TABLE `list_items` (
  `list_item_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_items`
--

INSERT INTO `list_items` (`list_item_id`, `list_id`, `movie_id`, `added_at`) VALUES
(1, 1, 573435, '2024-06-26 06:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `movie_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 11, 240, 2, '2024-06-24 08:13:37', '2024-06-24 18:48:49'),
(30, 11, 424, 4, '2024-06-24 18:49:20', '2024-06-24 18:49:20'),
(31, 11, 573435, 2, '2024-06-25 11:01:51', '2024-06-25 11:01:51'),
(32, 12, 573435, 4, '2024-06-25 11:11:44', '2024-06-25 11:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `movie_id`, `review_text`, `timestamp`) VALUES
(1, 11, 573435, 'bjhasbhbdhjsab', '2024-06-25 08:16:43'),
(2, 11, 573435, 'i really liked it. :)', '2024-06-25 08:23:46'),
(3, 11, 150540, 'jdnsjnsdnkf', '2024-06-25 10:29:36'),
(4, 12, 573435, 'wow what a movie!!!!', '2024-06-25 11:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `security_answer` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT 'default-avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `gender`, `dob`, `type`, `security_answer`, `avatar`) VALUES
(7, 'nisreenhamzah138@gmail.com', 'nisreen', '$2y$10$0ZThkFbFhZXokCFSMf7OHO5hGvS24cUVLDdmtGlnY/DfiTepFzP/i', 'Female', '2024-04-25', 'Member', 'manal', 'default-avatar.png'),
(8, 'ola@gmail.com', 'ola', '$2y$10$o1ZF56WNoZlCBUVLy4LXBOpKJGsKKtEMT4TgNGaM8fy5UrgZkuurK', 'Female', '2024-04-28', 'Member', 'up', 'default-avatar.png'),
(9, 'amir@gmail.com', 'amir', '$2y$10$CJwHOZcswMpXSbFVbW8R9OkIv0LxBWU3i8Wk3XJo7.yrgNTjXGDJi', '', '0000-00-00', 'Member', 'anna', 'default-avatar.png'),
(10, 'aram@gmail.com', 'aram', '$2y$10$tFklOQD441Iz4jO3KBjftO4/flWZEwCet1ksDftByIq.oRTevVhly', '', '0000-00-00', 'Member', 'anna', 'default-avatar.png'),
(11, 'mhmadiab20@gmail.com', 'mhmadiab', '$2y$10$wbVI1JcIp8OlmS34pO2B/OnSYFpFVF/1Pahl6ol0Bt9QHYW4rPIR.', '', '0000-00-00', 'Member', 'sahar', 'uploads/Capture.PNG'),
(12, 'reemdiab02@gmail.com', 'reemdiab', '$2y$10$/jZhJ3SKmg9JvGfMVAqXDenCuejzpQ8COfEXGNe3g6pXMtlXAgWLy', '', '0000-00-00', 'Member', 'mother', 'uploads/anatomy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`id`, `user_id`, `movie_id`, `date_added`) VALUES
(2, 11, 278, '2024-06-24 20:06:45'),
(4, 11, 240, '2024-06-24 21:26:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`movie_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `list_items`
--
ALTER TABLE `list_items`
  ADD PRIMARY KEY (`list_item_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_movie` (`user_id`,`movie_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `idx_movie_id` (`movie_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `list_items`
--
ALTER TABLE `list_items`
  MODIFY `list_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `list_items`
--
ALTER TABLE `list_items`
  ADD CONSTRAINT `list_items_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
