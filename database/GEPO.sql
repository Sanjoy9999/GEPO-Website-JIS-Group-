-- phpMyAdmin SQL Dump
-- version 5.2.1-4.fc40
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2025 at 12:18 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GEPO`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_applications`
--

CREATE TABLE `contact_applications` (
  `id` int NOT NULL,
  `name` text,
  `email` varchar(255) DEFAULT NULL,
  `inquiryType` text,
  `message` longtext,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_applications`
--

INSERT INTO `contact_applications` (`id`, `name`, `email`, `inquiryType`, `message`, `createdAt`, `updatedAt`) VALUES
(1, 'Subrata Mondal', 'doxal19973@fanicle.com', 'student', 'testing 1', '2025-02-01 07:07:32', '2025-02-01 07:07:32'),
(2, 'Subrata Mondal', 'titowit601@eluxeer.com', 'student', 'testing 2', '2025-02-01 07:10:05', '2025-02-01 07:10:05'),
(3, 'Subrata', 'subrata@dsd.cd', 'faculty', 'Testing 3', '2025-02-01 08:40:24', '2025-02-01 08:40:24'),
(4, 'Subrata Mondal', 'asgghf@sdhg.ds', 'faculty', 'Testing 4', '2025-02-01 08:41:56', '2025-02-01 08:41:56'),
(5, 'Subrata Mondal', 'aSAADF@sdf.fd', 'faculty', 'Testing 5', '2025-02-01 09:32:49', '2025-02-01 09:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_research_exchanges`
--

CREATE TABLE `faculty_research_exchanges` (
  `id` int NOT NULL,
  `image` int DEFAULT NULL,
  `title` text,
  `subtitle` text,
  `date` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `file` mediumblob,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `latest_news`
--

CREATE TABLE `latest_news` (
  `id` int NOT NULL,
  `title` text,
  `subtitle` text,
  `image` int DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int NOT NULL,
  `country` text,
  `user` int DEFAULT NULL,
  `institute` text,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `country`, `user`, `institute`, `createdAt`, `updatedAt`) VALUES
(1, 'USA', 5, 'partner univercity of engineering', '2025-01-31 18:13:00', '2025-01-31 18:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `partner_inquires`
--

CREATE TABLE `partner_inquires` (
  `id` int NOT NULL,
  `institute` text,
  `personName` text,
  `email` varchar(255) DEFAULT NULL,
  `partnershipType` text,
  `message` longtext,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `partner_inquires`
--

INSERT INTO `partner_inquires` (`id`, `institute`, `personName`, `email`, `partnershipType`, `message`, `createdAt`, `updatedAt`) VALUES
(1, 'asdsa', 'asdsad', 'titowit601@eluxeer.com', 'student-exchange', 'Testing 1', '2025-02-01 09:51:37', '2025-02-01 09:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` int NOT NULL,
  `image` int DEFAULT NULL,
  `title` text,
  `date` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_media_feeds`
--

CREATE TABLE `social_media_feeds` (
  `id` int NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `study_abroad_eligibility`
--

CREATE TABLE `study_abroad_eligibility` (
  `id` int NOT NULL,
  `name` text,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(15) DEFAULT NULL,
  `degree` text,
  `mode` enum('office','online') DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `study_abroad_programs`
--

CREATE TABLE `study_abroad_programs` (
  `id` int NOT NULL,
  `image` int DEFAULT NULL,
  `institute` text,
  `title` text,
  `country` text,
  `rating` float DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `study_tours`
--

CREATE TABLE `study_tours` (
  `id` int NOT NULL,
  `image` int DEFAULT NULL,
  `institute` text,
  `title` text,
  `country` text,
  `rating` float DEFAULT NULL,
  `type` enum('summer','winter') DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `success_stories`
--

CREATE TABLE `success_stories` (
  `id` int NOT NULL,
  `name` text,
  `image` int DEFAULT NULL,
  `institute` text,
  `course` text,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `story` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_events`
--

CREATE TABLE `upcoming_events` (
  `id` int NOT NULL,
  `dateTime` timestamp NULL DEFAULT NULL,
  `title` text,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` text,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('student','faculty','international_partner','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `institute` text,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `role`, `institute`, `createdAt`, `updatedAt`) VALUES
(1, 'Subrata Mondal', 'subrata@sm.com', 'subrata', '$2y$10$ryrxhVc1FNDyqYDU7dTTwOxopmHFzqRUcie4uQmQTB1ydYwtCANeO', 'faculty', 'subrata univercity of engineering', '2025-01-31 09:57:28', '2025-01-31 17:52:36'),
(4, 'test 1', 'test@one.com', 'test', '$2y$10$qV9kAOKNy6ga2T9uo8wpwutg3nl4nLtqzwbGWC4rHQ19QQZw7v6ri', 'admin', 'test univercity of engineering', '2025-01-31 18:08:40', '2025-02-01 04:58:43'),
(5, 'partner 1', 'partner@one.com', 'partner', '$2y$10$l5dLnp/I2dKZVQQwL9qMCOEknmDjC6Tc200sovqnNADo9ftSC4IIi', 'international_partner', 'partner univercity of engineering', '2025-01-31 18:11:43', '2025-02-01 12:13:47'),
(6, 'Subrata Mondal', 'student@test.com', 'student1', '$2y$10$KjcriFyHP01uPF4ToAOT3.nfUfKOK2yyXlNj2ah.2WP9nGM0B9DIq', 'student', 'something', '2025-02-01 11:37:43', '2025-02-01 11:37:43'),
(8, 'subrata mondal', 'faculty@test.com', 'faculty', '$2y$10$vOs7uUfW7PwTyQZiHEKZ6eyUEoilg/fRa4qahgKPZQrwaQnZfOPPy', 'faculty', 'something', '2025-02-01 11:56:43', '2025-02-01 11:56:43'),
(9, 'admin', 'admin@admin.com', 'admin', '$2y$10$xSLa1JPpBkd4fEHUarhjaeDIDaKJKraDd6t6DKxecKNprJuDFqJhq', 'admin', 'admin univercity of engineering', '2025-02-01 12:01:35', '2025-02-01 12:01:35'),
(10, 'student', 'student@student.com', 'student', '$2y$10$sDwUte7yXsYaOZbdfzsZOOCAyLpCXBwAPwtOd466ECulpz45r1klW', 'student', 'student', '2025-02-01 12:05:17', '2025-02-01 12:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` int NOT NULL,
  `title` text,
  `country` text,
  `department` text,
  `location` text,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int NOT NULL,
  `file` longblob,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_applications`
--
ALTER TABLE `contact_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_research_exchanges`
--
ALTER TABLE `faculty_research_exchanges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latest_news`
--
ALTER TABLE `latest_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `partner_inquires`
--
ALTER TABLE `partner_inquires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `social_media_feeds`
--
ALTER TABLE `social_media_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_abroad_eligibility`
--
ALTER TABLE `study_abroad_eligibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_abroad_programs`
--
ALTER TABLE `study_abroad_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `study_tours`
--
ALTER TABLE `study_tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `success_stories`
--
ALTER TABLE `success_stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_applications`
--
ALTER TABLE `contact_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculty_research_exchanges`
--
ALTER TABLE `faculty_research_exchanges`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `latest_news`
--
ALTER TABLE `latest_news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partner_inquires`
--
ALTER TABLE `partner_inquires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_media_feeds`
--
ALTER TABLE `social_media_feeds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_abroad_eligibility`
--
ALTER TABLE `study_abroad_eligibility`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_abroad_programs`
--
ALTER TABLE `study_abroad_programs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_tours`
--
ALTER TABLE `study_tours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `success_stories`
--
ALTER TABLE `success_stories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty_research_exchanges`
--
ALTER TABLE `faculty_research_exchanges`
  ADD CONSTRAINT `faculty_research_exchanges_ibfk_1` FOREIGN KEY (`image`) REFERENCES `images` (`id`);

--
-- Constraints for table `latest_news`
--
ALTER TABLE `latest_news`
  ADD CONSTRAINT `latest_news_ibfk_1` FOREIGN KEY (`image`) REFERENCES `images` (`id`);

--
-- Constraints for table `partners`
--
ALTER TABLE `partners`
  ADD CONSTRAINT `partners_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD CONSTRAINT `scholarships_ibfk_1` FOREIGN KEY (`image`) REFERENCES `images` (`id`);

--
-- Constraints for table `study_abroad_programs`
--
ALTER TABLE `study_abroad_programs`
  ADD CONSTRAINT `study_abroad_programs_ibfk_1` FOREIGN KEY (`image`) REFERENCES `images` (`id`);

--
-- Constraints for table `study_tours`
--
ALTER TABLE `study_tours`
  ADD CONSTRAINT `study_tours_ibfk_1` FOREIGN KEY (`image`) REFERENCES `images` (`id`);

--
-- Constraints for table `success_stories`
--
ALTER TABLE `success_stories`
  ADD CONSTRAINT `success_stories_ibfk_1` FOREIGN KEY (`image`) REFERENCES `images` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
