-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 24, 2019 at 07:38 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progress_plus`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_subject`
--

DROP TABLE IF EXISTS `assign_subject`;
CREATE TABLE IF NOT EXISTS `assign_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `batch_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_subject`
--

INSERT INTO `assign_subject` (`id`, `class_id`, `staff_id`, `subject_id`, `batch_name`) VALUES
(10, 11, 30, 15, 'Full'),
(11, 11, 31, 16, 'Py'),
(12, 11, 31, 17, 'H2'),
(13, 11, 32, 18, 'Wdm'),
(14, 11, 32, 19, 'H1'),
(15, 12, 33, 21, 'Full'),
(16, 12, 33, 22, 'G1'),
(17, 12, 33, 22, 'G2'),
(18, 12, 33, 22, 'G3'),
(19, 12, 34, 23, 'Cg'),
(20, 12, 34, 24, 'G2'),
(21, 12, 35, 25, 'Full'),
(22, 12, 35, 26, 'G1'),
(23, 12, 35, 26, 'G2'),
(24, 12, 35, 26, 'G3'),
(25, 12, 36, 27, 'Full'),
(26, 12, 36, 28, 'G1'),
(27, 12, 36, 28, 'G2'),
(28, 12, 36, 28, 'G3'),
(29, 12, 37, 29, 'Full'),
(30, 12, 37, 30, 'G1'),
(31, 12, 37, 30, 'G2'),
(32, 12, 37, 30, 'G3'),
(33, 12, 38, 31, '.Net'),
(34, 12, 38, 32, 'G1'),
(35, 11, 39, 33, 'H1'),
(36, 11, 39, 33, 'H2'),
(37, 11, 39, 33, 'H3'),
(38, 11, 41, 20, 'Full');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time` int(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `batch_name` varchar(50) NOT NULL,
  `acadamic_year` varchar(20) NOT NULL,
  `datetime` datetime NOT NULL,
  `modify_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `staff_id`, `class_id`, `subject_id`, `time`, `type`, `batch_name`, `acadamic_year`, `datetime`, `modify_date`) VALUES
(1, 35, 12, 25, 1, 'Full', 'Full', '2018-19', '2019-04-11 15:30:32', '2019-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_list`
--

DROP TABLE IF EXISTS `attendance_list`;
CREATE TABLE IF NOT EXISTS `attendance_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_list`
--

INSERT INTO `attendance_list` (`id`, `attendance_id`, `student_id`, `attendance`, `date`) VALUES
(1, 1, 38, 'Present', '2019-04-11 15:32:18'),
(2, 1, 39, 'Absent', '2019-04-11 15:32:18'),
(3, 1, 40, 'Present', '2019-04-11 15:32:18'),
(4, 1, 41, 'Absent', '2019-04-11 15:32:18'),
(5, 1, 42, 'Present', '2019-04-11 15:32:18'),
(6, 1, 43, 'Absent', '2019-04-11 15:32:18'),
(7, 1, 44, 'Present', '2019-04-11 15:32:18'),
(8, 1, 45, 'Present', '2019-04-11 15:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

DROP TABLE IF EXISTS `batch`;
CREATE TABLE IF NOT EXISTS `batch` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `batch_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `class_id`, `batch_name`) VALUES
(28, 12, 'G1'),
(29, 12, 'G2'),
(30, 12, 'G3'),
(31, 12, '.Net'),
(32, 12, 'Cg'),
(33, 11, 'H1'),
(34, 11, 'H2'),
(35, 11, 'H3'),
(36, 11, 'Py'),
(37, 11, 'Wdm');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `division` varchar(10) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `dept_id`, `semester`, `division`, `class_name`) VALUES
(11, 16, 8, '', 'IT Sem8 '),
(12, 16, 6, '', 'IT Sem6 '),
(13, 16, 4, '', 'IT Sem4 ');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_code` int(10) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_sort_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_code`, `department_name`, `department_sort_name`) VALUES
(1, 2, 'AUTOMOBILE ENGINEERING', 'Auto'),
(2, 6, 'CIVIL ENGINEERING', 'Civil'),
(3, 31, 'COMPUTER SCIENCE & ENGG.', 'CSE'),
(4, 9, 'ELECTRICAL ENGINEERING', 'EE'),
(5, 11, 'ELECTRONICS & COMMUNICATION ENGG.', 'EC'),
(6, 16, 'INFORMATION TECHNOLOGY', 'IT'),
(7, 19, 'MECHANICAL ENGINEERING', 'Mech');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `exam_name`) VALUES
(2, 'Mid-1'),
(3, 'Mid-2');

-- --------------------------------------------------------

--
-- Table structure for table `exam_sub`
--

DROP TABLE IF EXISTS `exam_sub`;
CREATE TABLE IF NOT EXISTS `exam_sub` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `exam_id` int(10) NOT NULL,
  `assign_id` int(10) NOT NULL,
  `total_mark` int(10) NOT NULL,
  `passing_mark` int(10) NOT NULL,
  `date` date NOT NULL,
  `added` varchar(20) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_sub`
--

INSERT INTO `exam_sub`(`id`, `exam_id`, `assign_id`, `total_mark`, `passing_mark`, `date`, `added`, `added_date`, `status`) VALUES
(3, 2, 10, 20, 8, '2019-04-08','No','2019-04-11 15:32:18', 'Done'),
(4, 3, 10, 20, 8, '2019-04-09','No','2019-04-11 15:32:18', 'Pending'),
(5, 2, 11, 20, 8, '2019-04-10','No','2019-04-11 15:32:18', 'Pending'),
(6, 3, 11, 20, 8, '2019-04-11','No','2019-04-11 15:32:18', 'Pending'),
(7, 2, 13, 20, 8, '2019-04-12','No','2019-04-11 15:32:18', 'Pending'),
(8, 3, 13, 20, 8, '2019-04-13','No','2019-04-11 15:32:18', 'Pending'),
(9, 2, 15, 20, 8, '2019-04-06','No','2019-04-11 15:32:18', 'Pending'),
(10, 3, 15, 20, 8, '2019-04-07','No','2019-04-11 15:32:18', 'Pending'),
(11, 2, 19, 20, 8, '2019-04-08','No','2019-04-11 15:32:18', 'Pending'),
(12, 2, 33, 20, 8, '2019-04-08','No','2019-04-11 15:32:18', 'Pending'),
(13, 3, 19, 20, 8, '2019-04-09','No','2019-04-11 15:32:18', 'Pending'),
(14, 3, 33, 20, 8, '2019-04-09','No','2019-04-11 15:32:18', 'Pending'),
(15, 2, 21, 20, 8, '2019-04-10','No','2019-04-11 15:32:18', 'Pending'),
(16, 3, 21, 20, 8, '2019-04-11','No','2019-04-11 15:32:18', 'Pending'),
(17, 2, 25, 20, 8, '2019-04-12','No','2019-04-11 15:32:18', 'Pending'),
(18, 3, 25, 20, 8, '2019-04-13','No','2019-04-11 15:32:18', 'Pending'),
(19, 2, 29, 20, 8, '2019-04-14','No','2019-04-11 15:32:18', 'Pending'),
(20, 3, 29, 20, 8, '2019-04-15','No','2019-04-11 15:32:18', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `role`, `user_id`, `date`) VALUES
(1, 'Devdeep', 'Barad', 'devdeep_9988@yahoo.com', '9898949649', 'e10adc3949ba59abbe56e057f20f88', 'SuperAdmin', 0, '2018-04-09 12:00:00'),
(2, 'Sagar', 'Jagani', 'sagarjagani9@gmail.com', '8160954195', 'e10adc3949ba59abbe56e057f20f88', 'SuperAdmin', 0, '2018-10-11 12:00:00'),
(3, 'axay', 'patel', 'ap44556677@gmail.com', '9726923050', '25d55ad283aa400af464c76d713c07', 'SuperAdmin', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notice_board`
--

DROP TABLE IF EXISTS `notice_board`;
CREATE TABLE IF NOT EXISTS `notice_board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `notice_for` varchar(5000) NOT NULL,
  `department` varchar(200) NOT NULL,
  `class_list` varchar(500) NOT NULL,
  `attatchment1` varchar(200) NOT NULL,
  `attatchment2` varchar(200) NOT NULL,
  `attatchment3` varchar(200) NOT NULL,
  `attatchment4` varchar(200) NOT NULL,
  `attatchment5` varchar(200) NOT NULL,
  `send_sms` varchar(10) NOT NULL,
  `sms_text` varchar(200) NOT NULL,
  `add_by` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice_board`
--

INSERT INTO `notice_board` (`id`, `title`, `message`, `from_date`, `to_date`, `notice_for`, `department`, `class_list`, `attatchment1`, `attatchment2`, `attatchment3`, `attatchment4`, `attatchment5`, `send_sms`, `sms_text`, `add_by`, `user_id`, `date`) VALUES
(2, 'Test', 'test is English chapter 1`', '2019-04-10', '2018-04-15', 'Student', '', '11;12;', '', '', '', '', '', 'No', 'Test', 'Staff', 35, '2019-04-11 13:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

DROP TABLE IF EXISTS `otp`;
CREATE TABLE IF NOT EXISTS `otp` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `user_id` int(5) NOT NULL,
  `otp` int(6) NOT NULL,
  `date` datetime(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `password` varchar(30) NOT NULL,
  `card_no` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `designation` varchar(100) NOT NULL,
  `joining_date` date NOT NULL,
  `experience` varchar(200) NOT NULL,
  `education` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `department` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `mobile`, `password`, `card_no`, `gender`, `birthdate`, `designation`, `joining_date`, `experience`, `education`, `address`, `city`, `state`, `zipcode`, `department`, `photo`, `date`, `status`) VALUES
(30, 'krunal', 'a', 'gandhi', 'krunal.a.lit@laxmi.edu.in ', '982553030', 'e10adc3949ba59abbe56e057f20f88', '86589', 'male', '2008-02-01', 'Profressor', '1998-05-01', '5', 'M.E', 'valsad', 'valsad', 'Gujarat', '396521', '16', '86589.jpg', '2019-04-07', 'Active'),
(31, 'Manoj', 'm', 'Patel', 'manoj@gmail.com', '873656334', 'e10adc3949ba59abbe56e057f20f88', '4757', 'male', '2009-02-03', 'Profressor', '1998-06-01', '3', 'M.E', 'surat', 'suart', 'Gujarat', '347575', '16', '4757.jpg', '2019-04-07', 'Active'),
(32, 'akash', 't', 'patel', 'akash@gmail.com', '983575838', 'e10adc3949ba59abbe56e057f20f88', '3533', 'male', '2008-03-01', 'Profressor', '1998-07-01', '4', 'M.E', 'navsari', 'navsari', 'Gujarat', '377474', '16', '3533.jpg', '2019-04-07', 'Active'),
(33, 'dhanraj', 's', 'patel', 'dhanraj@gmail.com', '3489432873', 'e10adc3949ba59abbe56e057f20f88', '342', 'Male', '2010-06-03', 'Profressor', '1998-08-01', '2', 'M.E', 'vapi', 'vapi', 'Gujarat', '348538', '6', '342.jpg', '2019-04-23', 'Active'),
(34, 'dhaval', 'a', 'patel', 'dhaval@gmail.com', '3489432883', 'e10adc3949ba59abbe56e057f20f88', '343', 'Male', '2010-06-04', 'Profressor', '1998-09-01', '3', 'M.E', 'vapi', 'vapi', 'Gujarat', '348539', '6', '343.jpg', '2019-04-23', 'Active'),
(35, 'tejash', 'b', 'patel', 'tejash@gmail.com', '348943289', 'e10adc3949ba59abbe56e057f20f88', '344', 'male', '2010-06-05', 'Profressor', '1998-10-01', '4', 'M.E', 'vapi', 'vapi', 'Gujarat', '348540', '16', '344.jpg', '2019-04-07', 'Active'),
(36, 'bhumit', 'c', 'patel', 'bhumitpatel58@gmail.com', '348943290', 'e10adc3949ba59abbe56e057f20f88', '345', 'male', '2010-06-06', 'Profressor', '1998-11-01', '5', 'M.E', 'vapi', 'vapi', 'Gujarat', '348541', '16', '345.jpg', '2019-04-07', 'Active'),
(37, 'sagar', 'j', 'patel', 'sagar@gmail.com', '348943291', 'e10adc3949ba59abbe56e057f20f88', '346', 'male', '2010-06-07', 'Profressor', '1998-12-01', '6', 'M.E', 'vapi', 'vapi', 'Gujarat', '348542', '16', '346.jpg', '2019-04-07', 'Active'),
(38, 'nitesh', 't', 'patel', 'nitesh@gmail.com', '348943292', 'e10adc3949ba59abbe56e057f20f88', '347', 'male', '2010-06-08', 'Profressor', '1999-01-01', '7', 'M.E', 'vapi', 'vapi', 'Gujarat', '348543', '16', '347.jpg', '2019-04-07', 'Active'),
(39, 'pratik', 's', 'patel', 'pratik@gmail.com', '348943293', 'e10adc3949ba59abbe56e057f20f88', '348', 'male', '2010-06-09', 'Profressor', '1999-02-01', '8', 'M.E', 'vapi', 'vapi', 'Gujarat', '348544', '16', '348.jpg', '2019-04-07', 'Active'),
(40, 'mehul', 'i', 'patel', 'mehul@gmail.com', '348943294', 'e10adc3949ba59abbe56e057f20f88', '349', 'male', '2010-06-10', 'Profressor', '1999-03-01', '9', 'M.E', 'vapi', 'vapi', 'Gujarat', '348545', '16', '349.jpg', '2019-04-07', 'Active'),
(41, 'devang', 'p', 'patel', 'devang@gmail.com', '348943295', 'e10adc3949ba59abbe56e057f20f88', '350', 'male', '2010-06-11', 'Profressor', '1999-04-01', '10', 'M.E', 'vapi', 'vapi', 'Gujarat', '348546', '16', '350.jpg', '2019-04-07', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `admission_date` date NOT NULL,
  `enrollment_no` varchar(50) NOT NULL,
  `parent_first_name` varchar(50) NOT NULL,
  `parent_last_name` varchar(50) NOT NULL,
  `parent_email` varchar(50) NOT NULL,
  `parent_mobile` varchar(12) NOT NULL,
  `parent_password` varchar(30) NOT NULL,
  `class_id` int(11) NOT NULL,
  `batch_name` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `photo` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `mobile`, `password`, `gender`, `birthdate`, `address`, `city`, `state`, `zipcode`, `academic_year`, `admission_date`, `enrollment_no`, `parent_first_name`, `parent_last_name`, `parent_email`, `parent_mobile`, `parent_password`, `class_id`, `batch_name`, `date`, `photo`, `user_id`, `status`) VALUES
(28, 'Mehul', 'Maganbhai', 'Ahir', 'mehul@gmail.com', '8155814089', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1995-08-01', 'dungra', 'vapi', 'Gujrat', '395001', '2018-19', '2014-03-08', '140860116001', 'maganbhai', 'Ahir', 'maganbhai@gmail.com', '8155814089', 'e10adc3949ba59abbe56e057f20f88', 11, 'H1,Wdm', '2019-04-23', '140860116001.jpg', 2, 'Active'),
(29, 'kalrav', 'Rajendrabhai', 'shah', 'kalrav@gmail.com', '8155814090', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1995-08-08', 'valsad', 'valsad', 'Gujrat', '395002', '2018-19', '2014-08-03', '140860116044', 'Rajendrabahi', 'Shah', 'Rajendrabhai@gmail.com', '8155814090', 'e10adc3949ba59abbe56e057f20f88', 11, 'H1,Wdm', '2019-04-07', '140860116044.jpg', 2, 'Active'),
(30, 'Jaynesh', 'Rajendrabhai', 'Tailoar', 'jaynesh@gmail.com', '8155814091', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1995-03-04', 'nasari bazar', 'Navsari', 'Gujrat', '395003', '2018-19', '2014-08-04', '140860116050', 'Rajendrabahi', 'Tailor', 'Rajendrabhai@gmail.com', '8155814091', 'e10adc3949ba59abbe56e057f20f88', 11, 'H1,Wdm', '2019-04-07', '140860116050.jpg', 2, 'Active'),
(31, 'Bhavyaben', 'balukumar', 'Patel', 'Bhaviya@gmail.com', '8155814092', 'e10adc3949ba59abbe56e057f20f88', 'Female', '1998-05-08', 'balitha', 'vapi', 'Gujrat', '395001', '2018-19', '2015-08-03', '150860116003', 'Balukumar', 'Patel', 'Balukumar@gmail.com', '8155814092', 'e10adc3949ba59abbe56e057f20f88', 11, 'H1,Wdm', '2019-04-07', '150860116003.jpg', 2, 'Active'),
(32, 'Bansari', 'Piyushkumar', 'Gandhi', 'bansari@gmail.com', '8155814093', 'e10adc3949ba59abbe56e057f20f88', 'Female', '1998-06-21', 'Amalsad', 'Amalsad', 'Gujrat', '395003', '2018-19', '2015-08-03', '150860116007', 'Piyushkumar', 'Gandhi', 'Piyushkumar@gmail.com', '8155814093', 'e10adc3949ba59abbe56e057f20f88', 11, 'H1,Wdm', '2019-04-07', '150860116007.jpg', 2, 'Active'),
(33, 'Gautamee', 'Mukeshbhai', 'Patel', 'gautamee@gmail.com', '8155814094', 'e10adc3949ba59abbe56e057f20f88', 'Female', '1997-01-20', 'Chala', 'vapi', 'Gujrat', '395001', '2018-19', '2015-08-03', '150860116008', 'Mukeshbhai', 'Patel', 'Mukeshbhai@gmail.com', '8155814094', 'e10adc3949ba59abbe56e057f20f88', 11, 'H2,Py', '2019-04-07', '150860116008.jpg', 2, 'Active'),
(34, 'Hemali', 'Pareshbhai', 'Patel', 'hemali@gmail.com', '8155814095', 'e10adc3949ba59abbe56e057f20f88', 'Female', '1997-12-31', 'Chala', 'vapi', 'Gujrat', '395001', '2018-19', '2015-08-03', '150860116009', 'Pareshbhai', 'Patel', 'pareshbhai@gail.com', '8155814095', 'e10adc3949ba59abbe56e057f20f88', 11, 'H2,Py', '2019-04-07', '150860116009.jpg', 2, 'Active'),
(35, 'Sagar', 'Sanjaybhai', 'Jagani', 'sagarjagani9@gmail.com', '9429933279', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1997-06-09', 'sarthana jakatnaka', 'suarat', 'Gujrat', '395006', '2018-19', '2015-08-03', '150860116010', 'Sunjaybhai', 'Jagani', 'sanjaybhai@gmail.com', '942993327', 'e10adc3949ba59abbe56e057f20f88', 11, 'H2,Py', '2019-04-07', '150860116010.jpg', 2, 'Active'),
(36, 'Viren', 'Vijaybhai', 'Kapadiya', 'viran@gmail.com', '7069238141', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1998-01-05', 'gandevi', 'navsari', 'Gujrat', '395008', '2018-19', '2015-08-03', '150860116011', 'Vijaybhai', 'Kapadiya', 'vijay@gmail.com', '7069238141', 'e10adc3949ba59abbe56e057f20f88', 11, 'H2,Py', '2019-04-07', '150860116011.jpg', 2, 'Active'),
(37, 'Sujeet', 'Roshanlal', 'Lohar', 'sujeetlohar121@gmail.com', '9825584517', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1996-09-16', 'Balitha', 'Vapi', 'Gujrat', '395002', '2018-19', '2015-08-03', '150860116012', 'Roshanlal', 'Lohar', 'roshan@gmail.com', '9825584517', 'e10adc3949ba59abbe56e057f20f88', 11, 'H2,Py', '2019-04-07', '150860116012.jpg', 2, 'Active'),
(38, 'Parimal', 'Paulushbhai', 'Bhoya', 'parimalbh@gmail.com', '8160860416', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1994-05-19', 'selvasa', 'Vapi', 'Gujarat', '395002', '2018-19', '2016-09-08', '160863116002', 'Paulushbhai', 'Bhoya', 'Paulush@gmail.com', '8160860417', 'e10adc3949ba59abbe56e057f20f88', 12, 'G1', '2019-04-07', '160863116002.jpg', 2, 'Active'),
(39, 'Axay', 'Sumanbhai', 'Patel', 'ap44556677@gmail.com', '9726923050', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1994-09-05', 'Balvada', 'Bilimora', 'Gujarat', '395007', '2018-19', '2016-09-08', '160863116005', 'Sumanbhai', 'Patel', 'suman@gmail.com', '9726923050', 'e10adc3949ba59abbe56e057f20f88', 12, 'G1', '2019-04-07', '160863116005.jpg', 2, 'Active'),
(40, 'Bhumit', 'Maheshbhai', 'Patel', 'bhumitpatel58@gmail.com', '8160860417', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1998-08-05', 'Nanidaman', 'Daman', 'Gujarat', '394508', '2018-19', '2016-09-08', '160863116006', 'Maheshbhai', 'Patel', 'mahesh@gmail.com', '8160860417', 'e10adc3949ba59abbe56e057f20f88', 12, 'G1', '2019-04-07', '160863116006.jpg', 2, 'Active'),
(41, 'Rishikesh', 'Bhimrao', 'More', 'rishi@hmail.com', '7878529635', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1997-05-31', 'GIDC', 'Vapi', 'Gujarat', '395002', '2018-19', '2015-08-03', '150860116019', 'Bhimrao', 'More', 'more@gmail.com', '7878529635', 'e10adc3949ba59abbe56e057f20f88', 12, 'G1', '2019-04-07', '150860116019.jpg', 2, 'Active'),
(42, ' Hardik', 'Mansukhbhai', 'Tanti', 'hardi@gmail.com', '9106865298', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1998-11-10', 'Jalalpor', 'Navsari', 'Gujarat', '395009', '2018-19', '2016-08-03', '160860131041', 'Mansukhbhai', 'Tanti', 'tanti@gmail.com', '9106865298', 'e10adc3949ba59abbe56e057f20f88', 12, 'G2,Cg', '2019-04-07', '160860131041.jpg', 2, 'Active'),
(43, 'Priyanka', 'B', 'Bayee', 'priyankabayee05@gmail.com', '8160860415', 'e10adc3949ba59abbe56e057f20f88', 'Female', '1996-12-08', 'Selvash', 'Vapi', 'Gujarat', '395002', '2018-19', '2016-09-08', '160863116007', 'B', 'Bayee', 'bayee@gmail.com', '8160860415', 'e10adc3949ba59abbe56e057f20f88', 12, 'G2,Cg', '2019-04-07', '160863116007.jpg', 2, 'Active'),
(44, 'Krishna', 'Harishbhai', 'Rana', 'krishnarana5500@gmail.com', '8160860414', 'e10adc3949ba59abbe56e057f20f88', 'Female', '1995-11-28', 'Umargaun', 'Vapi', 'Gujarat', '395002', '2018-19', '2016-09-08', '160863116008', 'Harishbhai', 'Rana', 'harish@gmail.com', '8160860414', 'e10adc3949ba59abbe56e057f20f88', 12, 'G2,Cg', '2019-04-07', '160863116008.jpg', 2, 'Active'),
(45, 'Pratik', 'Gunvatbhai', 'Surati', 'pratiks6043@gmail.com', '9484838649', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1996-10-23', 'Sachin', 'Surat', 'Gujarat', '395007', '2018-19', '2016-09-08', '160863116009', 'Gunvatbhai', 'Surati', 'gunvat@gmail.com', '9484838649', 'e10adc3949ba59abbe56e057f20f88', 12, 'G2,Cg', '2019-04-07', '160863116009.jpg', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `subject_code` int(20) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `attendance_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `class_id`, `subject_code`, `sub_name`, `attendance_type`) VALUES
(15, 11, 2180703, 'Artificial Intelligence', 'Full'),
(16, 11, 2180711, 'Python Programming', 'Batch_wise'),
(17, 11, 2180711, 'Python Programming(Pra)', 'Batch_wise'),
(18, 11, 2180713, 'Web Data Management', 'Batch_wise'),
(19, 11, 2180713, 'Web Data Management(Pra)', 'Batch_wise'),
(20, 11, 2181606, 'Project-2', 'Full'),
(21, 12, 2160701, 'Software Engineering', 'Full'),
(22, 12, 2160701, 'Software Engineering(Pra)', 'Batch_wise'),
(23, 12, 2160703, 'Computer Graphics', 'Batch_wise'),
(24, 12, 2160703, 'Computer Graphics(Pra)', 'Batch_wise'),
(25, 12, 2160704, 'Theory of Computation', 'Full'),
(26, 12, 2160704, 'Theory of Computation(Pra)', 'Batch_wise'),
(27, 12, 2160707, 'Advanced Java', 'Full'),
(28, 12, 2160707, 'Advanced Java(Pra)', 'Batch_wise'),
(29, 12, 2160708, 'Web Technology', 'Full'),
(30, 12, 2160708, 'Web Technology(Pra)', 'Batch_wise'),
(31, 12, 2160711, 'Net Technology', 'Batch_wise'),
(32, 12, 2160711, 'Net Technology(Pra)', 'Batch_wise'),
(33, 11, 2180703, 'Artificial Intelligence(Pra)', 'Batch_wise');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no` int(10) NOT NULL,
  `timing` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`id`, `no`, `timing`, `status`) VALUES
(1, 1, '8:20 to 9:10', 'Active'),
(2, 2, '9:10 to 10:00', 'Active'),
(3, 3, '10:10 to 11:00', 'Active'),
(4, 4, '11:00 to 11:50', 'Active'),
(5, 5, '12:00 to 12:45', 'Active'),
(6, 6, '12:45 to 1:35', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

DROP TABLE IF EXISTS `time_table`;
CREATE TABLE IF NOT EXISTS `time_table` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time` int(10) NOT NULL,
  `assign_id` int(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`id`, `time`, `assign_id`, `day`) VALUES
(31, 1, 29, 'Monday'),
(32, 2, 19, 'Monday'),
(33, 2, 33, 'Monday'),
(34, 3, 25, 'Monday'),
(35, 4, 15, 'Monday'),
(36, 5, 30, 'Monday'),
(37, 5, 28, 'Monday'),
(38, 6, 30, 'Monday'),
(39, 6, 28, 'Monday'),
(40, 1, 29, 'Tuesday'),
(41, 1, 25, 'Tuesday'),
(42, 2, 19, 'Tuesday'),
(43, 3, 33, 'Tuesday'),
(44, 4, 29, 'Tuesday'),
(45, 5, 16, 'Tuesday'),
(46, 5, 27, 'Tuesday'),
(47, 6, 16, 'Tuesday'),
(48, 6, 27, 'Tuesday'),
(49, 1, 26, 'Wednesday'),
(50, 1, 31, 'Wednesday'),
(51, 1, 18, 'Wednesday'),
(52, 2, 26, 'Wednesday'),
(53, 2, 31, 'Wednesday'),
(54, 2, 18, 'Wednesday'),
(55, 3, 21, 'Wednesday'),
(56, 5, 21, 'Wednesday'),
(57, 6, 15, 'Wednesday'),
(58, 1, 19, 'Thursday'),
(59, 1, 33, 'Thursday'),
(60, 2, 25, 'Thursday'),
(61, 3, 20, 'Thursday'),
(62, 3, 16, 'Thursday'),
(63, 4, 32, 'Thursday'),
(64, 5, 21, 'Thursday'),
(65, 6, 29, 'Thursday'),
(66, 1, 15, 'Friday'),
(67, 2, 21, 'Friday'),
(68, 3, 15, 'Friday'),
(69, 4, 29, 'Friday'),
(70, 5, 25, 'Friday'),
(71, 6, 19, 'Friday'),
(72, 6, 33, 'Friday'),
(73, 1, 21, 'Saturday'),
(74, 2, 19, 'Saturday'),
(75, 2, 33, 'Saturday'),
(76, 6, 25, 'Saturday'),
(77, 5, 15, 'Saturday'),
(78, 1, 37, 'Monday'),
(79, 1, 12, 'Monday'),
(80, 1, 14, 'Monday'),
(81, 2, 37, 'Monday'),
(82, 2, 12, 'Monday'),
(83, 2, 14, 'Monday'),
(84, 3, 38, 'Monday'),
(85, 4, 38, 'Monday'),
(86, 5, 11, 'Monday'),
(87, 5, 13, 'Monday'),
(88, 6, 10, 'Monday'),
(89, 1, 10, 'Tuesday'),
(90, 2, 11, 'Tuesday'),
(91, 2, 13, 'Tuesday'),
(92, 3, 14, 'Tuesday'),
(93, 3, 37, 'Tuesday'),
(94, 3, 12, 'Tuesday'),
(95, 4, 12, 'Tuesday'),
(96, 4, 14, 'Tuesday'),
(97, 4, 37, 'Tuesday'),
(98, 5, 10, 'Tuesday'),
(99, 6, 11, 'Tuesday'),
(100, 6, 13, 'Tuesday'),
(101, 1, 11, 'Wednesday'),
(102, 1, 13, 'Wednesday'),
(103, 2, 10, 'Wednesday'),
(104, 3, 11, 'Wednesday'),
(105, 3, 13, 'Wednesday'),
(106, 4, 10, 'Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `total_mark`
--

DROP TABLE IF EXISTS `total_mark`;
CREATE TABLE IF NOT EXISTS `total_mark` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `exam_sub_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `mark` varchar(10) NOT NULL,
  `present` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
