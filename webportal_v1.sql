-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2017 at 12:05 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webportal_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `advocacies`
--

CREATE TABLE `advocacies` (
  `advocacy_id` int(11) NOT NULL,
  `advocacy_name` text NOT NULL,
  `advocacy_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_description` text NOT NULL,
  `event_location` text NOT NULL,
  `event_start` datetime NOT NULL,
  `event_end` datetime NOT NULL,
  `event_age_req` int(11) NOT NULL,
  `event_gender_req` int(11) NOT NULL,
  `event_partner_org` text NOT NULL,
  `event_img` text NOT NULL,
  `event_category` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_feedback`
--

CREATE TABLE `event_feedback` (
  `event_feedback_id` int(11) NOT NULL,
  `event_rating` int(5) NOT NULL,
  `event_comment` text NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_preregistration`
--

CREATE TABLE `event_preregistration` (
  `event_preregistration_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_trainings`
--

CREATE TABLE `list_trainings` (
  `training_id` int(5) NOT NULL,
  `trainingName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_trainings`
--

INSERT INTO `list_trainings` (`training_id`, `trainingName`) VALUES
(1, 'Aid to Persons with Disabilities '),
(2, 'Alumni Association or Group'),
(3, 'Arts Education'),
(4, 'Arts Service'),
(5, 'Community Health Planning'),
(6, 'Emergency or Disaster Aid Fund'),
(7, 'Faculty Group'),
(8, 'Farming Seminar'),
(9, 'Farmland Preservation Seminar'),
(10, 'Health Clinic'),
(11, 'Mental Health care Awareness Seminar'),
(12, 'Missionary Activities'),
(13, 'Parent or Parent-teachers Association'),
(14, 'Performing Arts Schools'),
(15, 'Preservation of Natural Resources'),
(16, 'Radio or Television Broadcasting'),
(17, 'Religious Publishing Activities'),
(18, 'Remedial Reading and Encouragement '),
(19, 'Rescue and Emergency Service'),
(20, 'Scientific Research (diseases)'),
(21, 'Scouting '),
(22, 'Student Exchange with Foreign Country'),
(23, 'Vocation or Technical Seminar'),
(24, 'Wildlife Sanctuary or Refuge'),
(25, 'Youth Development Programs');

-- --------------------------------------------------------

--
-- Table structure for table `organization_details`
--

CREATE TABLE `organization_details` (
  `organization_details_id` int(11) NOT NULL,
  `oranization_mission` text NOT NULL,
  `organization_vission` text NOT NULL,
  `organization_date_established` text NOT NULL,
  `organization_certificate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email_address` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  `no_missed_activities` int(11) NOT NULL,
  `advocacies` text NOT NULL,
  `user_occupation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_type`, `first_name`, `middle_name`, `last_name`, `email_address`, `status`, `blocked`, `no_missed_activities`, `advocacies`, `user_occupation`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', '', 0, 0, 0, '', ''),
(2, 'kris', 'kris', 'volunteer', 'f_kris', 'm_kris', 'l_kris', '', 0, 0, 0, '', ''),
(3, 'org', 'org', 'organization', 'org_f_name', 'org_m_name', 'org_l_name', '', 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_details`
--

CREATE TABLE `volunteer_details` (
  `volunteer_details_id` int(11) NOT NULL,
  `volunteer_birthday` date NOT NULL,
  `volunteer_occupation` text NOT NULL,
  `volunteer_schedule` text NOT NULL,
  `volunteer_about_me` text NOT NULL,
  `volunteer_hobbies` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_resources`
--

CREATE TABLE `volunteer_resources` (
  `volunteer_resources_id` int(11) NOT NULL,
  `resources_name` text NOT NULL,
  `resources_description` text NOT NULL,
  `resources_photo` text NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advocacies`
--
ALTER TABLE `advocacies`
  ADD PRIMARY KEY (`advocacy_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `event_feedback`
--
ALTER TABLE `event_feedback`
  ADD PRIMARY KEY (`event_feedback_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_preregistration`
--
ALTER TABLE `event_preregistration`
  ADD PRIMARY KEY (`event_preregistration_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_fk` (`user_id`);

--
-- Indexes for table `organization_details`
--
ALTER TABLE `organization_details`
  ADD PRIMARY KEY (`organization_details_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `volunteer_details`
--
ALTER TABLE `volunteer_details`
  ADD PRIMARY KEY (`volunteer_details_id`);

--
-- Indexes for table `volunteer_resources`
--
ALTER TABLE `volunteer_resources`
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advocacies`
--
ALTER TABLE `advocacies`
  MODIFY `advocacy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_feedback`
--
ALTER TABLE `event_feedback`
  MODIFY `event_feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_preregistration`
--
ALTER TABLE `event_preregistration`
  MODIFY `event_preregistration_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization_details`
--
ALTER TABLE `organization_details`
  MODIFY `organization_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `volunteer_details`
--
ALTER TABLE `volunteer_details`
  MODIFY `volunteer_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_feedback`
--
ALTER TABLE `event_feedback`
  ADD CONSTRAINT `event_feedback_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_feedback_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_preregistration`
--
ALTER TABLE `event_preregistration`
  ADD CONSTRAINT `event_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer_resources`
--
ALTER TABLE `volunteer_resources`
  ADD CONSTRAINT `volunteer_resources_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volunteer_resources_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
