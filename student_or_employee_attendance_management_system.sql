-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2020 at 09:14 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_or_employee_attendance_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

DROP TABLE IF EXISTS `tbl_attendance`;
CREATE TABLE IF NOT EXISTS `tbl_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll` int(11) NOT NULL COMMENT 'roll here foreign key',
  `attend` varchar(255) NOT NULL,
  `attend_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `roll`, `attend`, `attend_time`) VALUES
(1, 1, '', '0000-00-00'),
(2, 2, '', '0000-00-00'),
(3, 3, '', '0000-00-00'),
(4, 4, '', '0000-00-00'),
(5, 5, '', '0000-00-00'),
(6, 1, 'present', '2020-08-25'),
(7, 2, 'present', '2020-08-25'),
(8, 3, 'present', '2020-08-25'),
(9, 4, 'present', '2020-08-25'),
(10, 5, 'present', '2020-08-25'),
(11, 1, 'absent', '2020-08-26'),
(12, 2, 'present', '2020-08-26'),
(13, 3, 'absent', '2020-08-26'),
(14, 4, 'present', '2020-08-26'),
(15, 5, 'present', '2020-08-26'),
(16, 1, 'absent', '2020-08-27'),
(17, 2, 'absent', '2020-08-27'),
(18, 3, 'absent', '2020-08-27'),
(19, 4, 'absent', '2020-08-27'),
(20, 5, 'absent', '2020-08-27'),
(21, 1, 'present', '2020-08-28'),
(22, 2, 'absent', '2020-08-28'),
(23, 3, 'absent', '2020-08-28'),
(24, 4, 'present', '2020-08-28'),
(25, 5, 'present', '2020-08-28'),
(26, 1, 'present', '2020-08-29'),
(27, 2, 'present', '2020-08-29'),
(28, 3, 'present', '2020-08-29'),
(29, 4, 'present', '2020-08-29'),
(30, 5, 'present', '2020-08-29'),
(31, 1, 'present', '2020-08-29'),
(32, 2, 'present', '2020-08-29'),
(33, 3, 'present', '2020-08-29'),
(34, 4, 'present', '2020-08-29'),
(35, 5, 'present', '2020-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto and primary',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `roll` int(11) NOT NULL COMMENT 'roll is unique',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roll` (`roll`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `name`, `roll`) VALUES
(1, 'Selim Reza Swadhin', 1),
(2, 'Zannatul Ferdous Bonna', 2),
(3, 'hamidul islam', 3),
(4, 'swadhin', 4),
(5, 'Selim', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
