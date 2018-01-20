-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2017 at 08:30 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `advocacies`
--

CREATE TABLE `advocacies` (
  `advocacy_id` int(20) NOT NULL,
  `advocacy_name` varchar(250) NOT NULL,
  `advocacy_icon` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advocacies`
--

INSERT INTO `advocacies` (`advocacy_id`, `advocacy_name`, `advocacy_icon`) VALUES
(7, 'hunger', '1_blue.jpg'),
(8, 'LGBT', '680.JPG'),
(9, 'Education', '022.jpg'),
(10, 'Risk Reduction', '1051.JPG'),
(11, 'Environment', 'MK3197-0622_1.jpg'),
(12, 'LGBT', 'IMG_9632.JPG'),
(13, 'Women', '17904519_1507967185901965_4510532028051496920_n.jpg'),
(14, 'Sample', '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `occupation_event`
--

CREATE TABLE `occupation_event` (
  `occupation_id` int(5) NOT NULL,
  `event_id` int(5) NOT NULL,
  `organization_id` int(5) NOT NULL,
  `occupationName` text NOT NULL,
  `noVolunteers` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `organization_id` int(5) NOT NULL,
  `orgName` text NOT NULL,
  `emailAdd` text NOT NULL,
  `city` text NOT NULL,
  `password` int(100) NOT NULL,
  `advocacies` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organization_id`, `orgName`, `emailAdd`, `city`, `password`, `advocacies`) VALUES
(18, 'Philippine Red Cross', 'redcross@gmail.com', 'Cebu', 123, 'Education, Risk Reduction, Environment'),
(19, 'This is a test', 'daphnecomendador@gmail.com', 'Cebu', 123, 'LGBT, Education, Risk Reduction, Environment, LGBT, Women'),
(20, 'This is a test', 'daphnecomendador@gmail.com', 'Cebu', 123, 'LGBT, Education, Risk Reduction, Environment, LGBT, Women'),
(21, 'test2', 'daphnecomendador@gmail.com', 'Madnaue', 123, 'LGBT, Education, Risk Reduction');

-- --------------------------------------------------------

--
-- Table structure for table `organization_event`
--

CREATE TABLE `organization_event` (
  `event_id` int(5) NOT NULL,
  `organization_id` int(5) NOT NULL,
  `eventTitle` text NOT NULL,
  `eventDesc` text NOT NULL,
  `eventLocation` text NOT NULL,
  `eventStart` datetime NOT NULL,
  `eventEnd` datetime NOT NULL,
  `eventMatReq` text NOT NULL,
  `eventAgeReqMin` int(2) NOT NULL,
  `eventAgeReqMax` int(2) NOT NULL,
  `eventGenderReq` text NOT NULL,
  `eventPartnerOrg` text NOT NULL,
  `eventImage` longtext NOT NULL
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
-- Indexes for table `occupation_event`
--
ALTER TABLE `occupation_event`
  ADD PRIMARY KEY (`occupation_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`organization_id`);

--
-- Indexes for table `organization_event`
--
ALTER TABLE `organization_event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advocacies`
--
ALTER TABLE `advocacies`
  MODIFY `advocacy_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `organization_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
