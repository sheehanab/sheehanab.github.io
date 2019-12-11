-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2019 at 04:19 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `dueDate` date NOT NULL,
  `descr` varchar(256) NOT NULL,
  `assignID` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `crsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`dueDate`, `descr`, `assignID`, `completed`, `crsID`) VALUES
('2019-12-05', 'Complete Databases Project', 1, 0, 0),
('2019-12-31', 'Calc Final', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `crsID` int(11) NOT NULL,
  `InstructorId` int(11) NOT NULL,
  `creditHours` int(11) NOT NULL,
  `crsName` varchar(64) NOT NULL,
  `semester` varchar(32) NOT NULL,
  `year` int(11) NOT NULL,
  `time` time NOT NULL,
  `days` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`crsID`, `InstructorId`, `creditHours`, `crsName`, `semester`, `year`, `time`, `days`) VALUES
(0, 6, 3, 'Introduction to Databases', 'Fall', 2019, '11:00:00', 't,r'),
(1, 7, 4, 'Analytical Geometry and Calculus 2', 'Fall', 2019, '09:55:00', 'm,t,w,r,f');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `enID` int(11) NOT NULL,
  `crsID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`enID`, `crsID`, `userID`) VALUES
(1, 0, 5),
(2, 0, 1),
(3, 0, 3),
(4, 0, 2),
(5, 0, 4),
(6, 0, 0),
(7, 1, 1),
(8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `instrFlag` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `instrFlag`) VALUES
(0, 'woeffner', 'Howdy', 'woeffner@kent.edu', 0),
(1, 'bboggia', 'Meowdy', 'bboggia@kent.edu', 0),
(2, 'iwhitesel', 'Nowdy', 'iwhitesel@kent.edu', 0),
(3, 'dhebenthal', 'Lowdy', 'dhebenthal@kent.edu', 0),
(4, 'jmnkenna', 'Yowdy', 'jmckenna@kent.edu', 0),
(5, 'asheehan', 'Rowdy', 'asheehan@kent.edu', 0),
(6, 'ahossin', 'Zowdy', 'ahossain@kent.edu', 1),
(7, 'jli', 'Powdy', 'jli@kent.edu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignID`),
  ADD KEY `crsID` (`crsID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`crsID`),
  ADD KEY `course_instructor` (`InstructorId`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`enID`),
  ADD KEY `crsID` (`crsID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrolled`
--
ALTER TABLE `enrolled`
  MODIFY `enID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`crsID`) REFERENCES `course` (`crsID`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_instructor` FOREIGN KEY (`InstructorId`) REFERENCES `users` (`userID`);

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`crsID`) REFERENCES `course` (`crsID`),
  ADD CONSTRAINT `enrolled_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
