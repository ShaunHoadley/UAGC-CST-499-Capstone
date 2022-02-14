-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 12:39 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cst499`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(10) NOT NULL,
  `courseName` varchar(250) NOT NULL,
  `maxStudents` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `courseName`, `maxStudents`) VALUES
(1, 'PSY 101: Intro to Psychology', 3),
(2, 'PSY 104: Child and Adolescent Development', 3),
(3, 'PSY 301: Social Psychology', 5),
(4, 'PSY 303: Abnormal Psychology', 5),
(5, 'PSY 307: The Journey of Adulthood', 3),
(6, 'PHY 101: Physics I for Science Students', 3),
(7, 'PHY 201: Physics II for Engineering and Physics Students', 3),
(8, 'PHY 303: Experimental Physics', 5),
(9, 'PHY 310: Physics III Modern Essentials', 5),
(10, 'BIO 120: Orientation to the Biology Major', 3),
(11, 'BIO 312: Evolution', 3),
(12, 'BIO 315: Genetics', 3),
(13, 'BIO 332: General Ecology', 5),
(14, 'BIO 341: Cell Biology', 5),
(15, 'SOC 101: Intro to Sociology', 3),
(16, 'SOC 120: Intro to Ethics & Social Responsibility', 3),
(17, 'SOC 203: Social Problems', 5),
(18, 'SOC 301: Identity & Social Inequality', 3),
(19, 'MAE 101: Intro to ME Design', 3),
(20, 'MAE 206: Engineering Statistics', 5),
(21, 'MAE 208: Engr Dynamics', 3),
(22, 'MAE 201: Engr Thermodynamics', 3),
(23, 'MAE 308: Fluid Mechanics', 3),
(24, 'ABS 200: Intro to Applied Behavioral Science', 3),
(25, 'ABS 300: Psychological Assessment', 5),
(26, 'ABS 415: Leadership & Ethics in a Changing World', 3),
(27, 'ABS 417: Community Organization and Development', 3),
(28, 'HIS 103: World Civilizations I', 3),
(29, 'HIS 104: World Civilizations II', 3),
(30, 'HIS 205: United States History I', 5),
(31, 'HIS 206: United States History II', 5),
(32, 'LIB 101: The Art of Being Human', 3),
(33, 'LIB 102: Human Questions', 5),
(34, 'LIB 202: Women, Culture, & Society', 3),
(35, 'LIB 332: Science & Culture', 5),
(36, 'CST 301: Software Technology & Design', 3),
(37, 'CST 304: Software Requirements & Analysis', 3),
(38, 'CST 307: Software Architecture & Design', 5),
(39, 'CST 310: Software Development', 5);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `offering_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `users_id`, `offering_id`) VALUES
(1, 1, 28),
(2, 1, 70),
(3, 1, 16),
(4, 1, 83),
(5, 2, 15),
(6, 2, 64),
(7, 2, 61),
(8, 2, 87),
(12, 3, 83),
(17, 3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `offering_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

CREATE TABLE `offering` (
  `offering_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `year` year(4) NOT NULL,
  `semester` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offering`
--

INSERT INTO `offering` (`offering_id`, `course_id`, `year`, `semester`) VALUES
(1, 1, 2021, 'Summer'),
(2, 1, 2021, 'Fall'),
(3, 1, 2022, 'Spring'),
(4, 1, 2022, 'Summer'),
(5, 1, 2022, 'Fall'),
(6, 2, 2021, 'Fall'),
(7, 2, 2022, 'Spring'),
(8, 2, 2022, 'Fall'),
(9, 3, 2021, 'Summer'),
(10, 3, 2022, 'Spring'),
(11, 3, 2022, 'Summer'),
(12, 4, 2021, 'Summer'),
(13, 4, 2021, 'Fall'),
(14, 4, 2022, 'Spring'),
(15, 4, 2022, 'Summer'),
(16, 4, 2022, 'Fall'),
(17, 5, 2021, 'Fall'),
(18, 5, 2022, 'Fall'),
(19, 6, 2021, 'Fall'),
(20, 6, 2022, 'Spring'),
(21, 6, 2022, 'Fall'),
(22, 7, 2021, 'Summer'),
(23, 7, 2021, 'Fall'),
(24, 7, 2022, 'Spring'),
(25, 7, 2022, 'Summer'),
(26, 7, 2022, 'Fall'),
(27, 8, 2021, 'Summer'),
(28, 8, 2022, 'Summer'),
(29, 9, 2021, 'Fall'),
(30, 9, 2022, 'Spring'),
(31, 9, 2022, 'Fall'),
(32, 10, 2021, 'Summer'),
(33, 10, 2021, 'Fall'),
(34, 10, 2022, 'Spring'),
(35, 10, 2022, 'Summer'),
(36, 10, 2022, 'Fall'),
(37, 11, 2021, 'Summer'),
(38, 11, 2021, 'Fall'),
(39, 11, 2022, 'Spring'),
(40, 11, 2022, 'Summer'),
(41, 11, 2022, 'Fall'),
(42, 12, 2021, 'Fall'),
(43, 12, 2022, 'Spring'),
(44, 12, 2022, 'Fall'),
(45, 13, 2021, 'Summer'),
(46, 13, 2022, 'Spring'),
(47, 13, 2022, 'Summer'),
(48, 14, 2021, 'Summer'),
(49, 14, 2021, 'Fall'),
(50, 14, 2022, 'Spring'),
(51, 14, 2022, 'Summer'),
(52, 14, 2022, 'Fall'),
(53, 15, 2021, 'Fall'),
(54, 15, 2022, 'Fall'),
(55, 16, 2021, 'Fall'),
(56, 16, 2022, 'Spring'),
(57, 16, 2022, 'Fall'),
(58, 17, 2021, 'Summer'),
(59, 17, 2021, 'Fall'),
(60, 17, 2022, 'Spring'),
(61, 17, 2022, 'Summer'),
(62, 17, 2022, 'Fall'),
(63, 18, 2021, 'Summer'),
(64, 18, 2022, 'Summer'),
(65, 19, 2021, 'Fall'),
(66, 19, 2022, 'Spring'),
(67, 19, 2022, 'Fall'),
(68, 20, 2021, 'Summer'),
(69, 20, 2021, 'Fall'),
(70, 20, 2022, 'Spring'),
(71, 20, 2022, 'Summer'),
(72, 20, 2022, 'Fall'),
(73, 21, 2021, 'Summer'),
(74, 21, 2021, 'Fall'),
(75, 21, 2022, 'Spring'),
(76, 21, 2022, 'Summer'),
(77, 21, 2022, 'Fall'),
(78, 22, 2021, 'Fall'),
(79, 22, 2022, 'Spring'),
(80, 22, 2022, 'Fall'),
(81, 23, 2021, 'Summer'),
(82, 23, 2022, 'Spring'),
(83, 23, 2022, 'Summer'),
(84, 24, 2021, 'Summer'),
(85, 24, 2021, 'Fall'),
(86, 24, 2022, 'Spring'),
(87, 24, 2022, 'Summer'),
(88, 24, 2022, 'Fall'),
(89, 25, 2021, 'Fall'),
(90, 25, 2022, 'Fall');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(10) NOT NULL,
  `users_email` varchar(50) NOT NULL,
  `users_pwd` varchar(20) NOT NULL,
  `users_firstName` varchar(50) NOT NULL,
  `users_lastName` varchar(50) NOT NULL,
  `users_address` varchar(250) DEFAULT NULL,
  `users_phone` varchar(13) DEFAULT NULL,
  `users_degree` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_email`, `users_pwd`, `users_firstName`, `users_lastName`, `users_address`, `users_phone`, `users_degree`) VALUES
(1, 'shaun@test.com', 'password', 'Shaun', 'Hoadley', '1111 coding way', '111-111-1111', 'B.S. Computer Software Technology'),
(2, 'Mickey.Hermanos@noreply.com', 'F33tlicker', 'Mickey', 'Hermanos', '123 Maim St', '817-618-4240', 'J.D. with a focus in Transnational Law'),
(3, 'britt@test.com', 'testing', 'Brittney', 'Brighton', '5555 placed dr', '555-555-5555', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `waitlist`
--

CREATE TABLE `waitlist` (
  `waitlist_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `offering_id` int(10) NOT NULL,
  `dateTimeAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `offering_id` (`offering_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `offering_id` (`offering_id`);

--
-- Indexes for table `offering`
--
ALTER TABLE `offering`
  ADD PRIMARY KEY (`offering_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `waitlist`
--
ALTER TABLE `waitlist`
  ADD PRIMARY KEY (`waitlist_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `offering_id` (`offering_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offering`
--
ALTER TABLE `offering`
  MODIFY `offering_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `waitlist`
--
ALTER TABLE `waitlist`
  MODIFY `waitlist_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

--
-- Constraints for table `offering`
--
ALTER TABLE `offering`
  ADD CONSTRAINT `offering_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `waitlist`
--
ALTER TABLE `waitlist`
  ADD CONSTRAINT `waitlist_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `waitlist_ibfk_2` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
