-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 02:54 AM
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
-- Database: `acad_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `code` varchar(16) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `code`, `name`, `user_id`) VALUES
(45, 'CS14101', 'Computer Networks', 40),
(46, 'CS14102', 'Operating System', 40),
(47, 'CS14103', 'Design and Analysis of Algorithms', 40),
(48, 'CS14104', 'Database Management Systems', 40),
(49, 'CS14105', 'Software Engineering', 40),
(50, 'CS14106', 'Computer Organization and Architecture', 40),
(51, 'CS14201', 'Computer Networks Laboratory', 40),
(52, 'CS14202', 'Operating System Laboratory', 40),
(53, 'CS14203', 'Design and Analysis of Algorithms Laboratory', 40),
(54, 'CS14204', 'Database Management Systems Laboratory', 40),
(55, 'ZZ14201', 'Professional Practice II', 40),
(56, 'ZZ14282', 'Behaviour and Discipline', 40);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`class_id`, `subject_id`, `user_id`, `day`, `start_time`, `end_time`) VALUES
(333, 49, 40, 'Monday', '09:30:00', '10:30:00'),
(334, 48, 40, 'Monday', '10:30:00', '11:30:00'),
(335, 50, 40, 'Monday', '11:30:00', '12:30:00'),
(336, 55, 40, 'Monday', '14:00:00', '15:00:00'),
(337, 54, 40, 'Monday', '15:00:00', '17:00:00'),
(338, 45, 40, 'Tuesday', '09:30:00', '10:30:00'),
(339, 50, 40, 'Tuesday', '10:30:00', '11:30:00'),
(340, 47, 40, 'Tuesday', '11:30:00', '12:30:00'),
(341, 55, 40, 'Tuesday', '12:30:00', '13:30:00'),
(342, 51, 40, 'Tuesday', '15:00:00', '17:00:00'),
(343, 45, 40, 'Wednesday', '09:30:00', '10:30:00'),
(344, 48, 40, 'Wednesday', '10:30:00', '11:30:00'),
(345, 47, 40, 'Wednesday', '11:30:00', '12:30:00'),
(346, 46, 40, 'Wednesday', '14:00:00', '15:00:00'),
(347, 52, 40, 'Wednesday', '15:00:00', '17:00:00'),
(348, 45, 40, 'Thursday', '09:30:00', '10:30:00'),
(349, 49, 40, 'Thursday', '10:30:00', '11:30:00'),
(350, 47, 40, 'Thursday', '11:30:00', '12:30:00'),
(351, 46, 40, 'Thursday', '12:30:00', '13:30:00'),
(352, 50, 40, 'Thursday', '15:00:00', '16:00:00'),
(353, 53, 40, 'Thursday', '16:00:00', '18:00:00'),
(354, 46, 40, 'Friday', '09:30:00', '10:30:00'),
(355, 48, 40, 'Friday', '10:30:00', '11:30:00'),
(356, 49, 40, 'Friday', '11:30:00', '12:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL DEFAULT 'Anon',
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`) VALUES
(40, 'Arsh Thanari', 'arsh.thanari@gmail.com', '$2y$10$dUY0W7K8c9HyxkfYOaaKdeDJwkuxBZM8XZlaT7ncckAWg84UgqBy.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `fk_subjects_user_id_users_id` (`user_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`day`,`start_time`,`end_time`),
  ADD KEY `fk_timetable_subject_id_subjects_subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `fk_subjects_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `fk_timetable_subject_id_subjects_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_timetable_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
