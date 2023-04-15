-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 02:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crowd_sourcing`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `points` int(11) NOT NULL DEFAULT 1,
  `inserted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `user_id`, `question_id`, `answer`, `rating`, `points`, `inserted_at`) VALUES
(1, 3, 1, 'This is a test answer', 0, 1, '2023-04-13 19:39:24'),
(5, 3, 2, 'This is a test answer', 0, 1, '2023-04-13 19:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `answer_method`
--

CREATE TABLE `answer_method` (
  `id` int(11) NOT NULL,
  `method_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer_method`
--

INSERT INTO `answer_method` (`id`, `method_name`) VALUES
(1, 'First-come-first-serve'),
(2, 'Best answer'),
(3, 'Mixed mode');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `inserted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `user_id`, `question_id`, `status`, `inserted_at`) VALUES
(1, 2, 1, 0, '2023-04-13 16:21:07'),
(2, 3, 1, 1, '2023-04-13 16:21:07'),
(3, 2, 2, 0, '2023-04-13 16:22:50'),
(4, 3, 2, 1, '2023-04-13 16:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `payment` int(10) NOT NULL,
  `waiting_time` varchar(255) NOT NULL,
  `inserted_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `user_id`, `question`, `type`, `tags`, `method`, `payment`, `waiting_time`, `inserted_at`, `updated_at`) VALUES
(1, 4, 'This is a test question', '1', 'Music,Reading,Revision', '1', 1, '0', '2023-04-13 16:21:07', '0000-00-00 00:00:00'),
(2, 4, 'This is another question', '3', 'Reading,Sports,Hiking', '2', 1, '30', '2023-04-13 16:22:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE `question_type` (
  `id` int(11) NOT NULL,
  `question_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`id`, `question_type`) VALUES
(1, 'Take Photo'),
(2, 'Physical'),
(3, 'Mental'),
(4, 'F2F');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `score_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`score_id`, `user_id`, `score`) VALUES
(1, 2, 6.00),
(2, 3, 3.00),
(3, 4, 3.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `college` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `hall` varchar(255) NOT NULL,
  `society` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(10) NOT NULL,
  `indoor` varchar(255) NOT NULL,
  `outdoor` varchar(255) NOT NULL,
  `request_type` varchar(255) NOT NULL,
  `user_type` int(10) NOT NULL DEFAULT 1,
  `status` int(10) NOT NULL DEFAULT 1,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `password`, `college`, `major`, `hall`, `society`, `gender`, `age`, `indoor`, `outdoor`, `request_type`, `user_type`, `status`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@crowdsourcing.com', '$argon2id$v=19$m=65536,t=4,p=1$ZzJ0THpxdUZ4enFYRUJmMQ$NbXXACojeX0fcZOYDg72BtMHHHrARSdREdFtFNoDYH4', 'Test', 'Test', 'Test', 'Test', 'male', 30, 'Revision', 'Social Work', 'Mental', 0, 1, '2023-03-26 13:13:27'),
(2, 'User 1', 'user1@test.com', '$argon2id$v=19$m=65536,t=4,p=1$ZTVTcWIyYmhiYjllcURLZg$ddruPGbnjM4f6bKrfjrk7BcO3G8NapCUcouskPJbNNE', 'Test', 'Test', 'Test', 'Test', 'male', 25, 'Reading', 'Hiking', 'Physical', 1, 1, '2023-03-26 13:15:03'),
(3, 'User 2', 'user2@test.com', '$argon2id$v=19$m=65536,t=4,p=1$dWVJeUkzME5BZks3dU9CSA$7OsUvJrGR7B44lfGYUbljj70mIZ1Q+669dE44nblO9Y', 'Test', 'Test', 'Test', 'Test', 'female', 30, 'Reading', 'Social Work', 'F2F', 1, 1, '2023-03-26 13:16:24'),
(4, 'user 3', 'user3@test.com', '$argon2id$v=19$m=65536,t=4,p=1$RmtNOEJBbW9UV0d2emRWZw$kzKfqpkqPhQ1m/NgB+7fq/yZi3ReUjjxeyT9MYd6BD4', 'Test', 'Test', 'Test', 'Test', 'male', 21, 'Music', 'Hiking', '3', 1, 1, '2023-04-13 13:03:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `answer_method`
--
ALTER TABLE `answer_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `answer_method`
--
ALTER TABLE `answer_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
