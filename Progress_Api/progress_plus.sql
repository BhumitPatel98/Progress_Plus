-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2019 at 11:08 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `progress_plus`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_subject`
--

CREATE TABLE IF NOT EXISTS `assign_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `batch_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `assign_subject`
--

INSERT INTO `assign_subject` (`id`, `class_id`, `staff_id`, `subject_id`, `batch_name`) VALUES
(1, 26, 1, 4, ''),
(2, 26, 2, 2, 'H2');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_list`
--

CREATE TABLE IF NOT EXISTS `attendance_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `batch_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `class_id`, `batch_name`) VALUES
(22, 26, 'H3'),
(21, 26, 'H2'),
(20, 26, 'H1');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `division` varchar(10) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `dept_id`, `semester`, `division`, `class_name`) VALUES
(19, 2, 2, '', 'Auto Sem2 '),
(20, 2, 4, '', 'Auto Sem4 '),
(21, 2, 6, '', 'Auto Sem6 '),
(22, 2, 8, '', 'Auto Sem8 '),
(23, 16, 2, '', 'IT Sem2 '),
(24, 16, 4, '', 'IT Sem4 '),
(25, 16, 6, '', 'IT Sem6 '),
(26, 16, 8, '', 'IT Sem8 '),
(27, 19, 2, 'A', 'Mech Sem2 A'),
(28, 6, 2, 'C', 'Civil Sem2 C');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_code` int(10) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_sort_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_code`, `department_name`, `department_sort_name`) VALUES
(18, 2, 'AUTOMOBILE ENGINEERING', 'Auto'),
(19, 6, 'CIVIL ENGINEERING', 'Civil'),
(20, 31, 'COMPUTER SCIENCE & ENGG.', 'CSE'),
(21, 9, 'ELECTRICAL ENGINEERING', 'EE'),
(22, 11, 'ELECTRONICS & COMMUNICATION ENGG.', 'EC'),
(23, 16, 'INFORMATION TECHNOLOGY', 'IT'),
(24, 19, 'MECHANICAL ENGINEERING', 'Mech');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_sub`
--

CREATE TABLE IF NOT EXISTS `exam_sub` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `exam_id` int(10) NOT NULL,
  `assign_id` int(10) NOT NULL,
  `total_mark` int(10) NOT NULL,
  `passing_mark` int(10) NOT NULL,
  `date` datetime(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `notice_board`
--

INSERT INTO `notice_board` (`id`, `title`, `message`, `from_date`, `to_date`, `notice_for`, `department`, `class_list`, `attatchment1`, `attatchment2`, `attatchment3`, `attatchment4`, `attatchment5`, `send_sms`, `sms_text`, `add_by`, `user_id`, `date`) VALUES
(2, '', '', '1970-01-01', '1970-01-01', 'All_dept', '', '', '', '', '', '', '', '', '', 'Admin', 2, '2019-02-24 00:00:00'),
(3, '', '', '1970-01-01', '1970-01-01', 'All', '16', 'All', '', '', '', '', '', '', '', 'Admin', 2, '2019-02-24 00:00:00'),
(4, 'student', 'you tok to student came in college  every day', '2019-02-24', '2019-02-25', 'Staff', '16', '23,24', '', '', '', '', '', '', '', 'Admin', 2, '2019-02-24 00:00:00'),
(5, 'student', 'you tok to student came in college  every day', '2019-02-24', '2019-02-25', 'Staff', '16', '23,24', '', '', '', '', '', '', '', 'Admin', 2, '2019-02-24 00:00:00'),
(6, 'Edlish test', 'chepaer test ', '2018-11-09', '2018-11-19', 'Student', '', '26;27;', 'C:\\wamp\\www\\Progress_Api\\img\\Aboutus.jpg', '', '', '', '', 'No', '', 'Staff', 1, '2019-03-29 10:15:11'),
(7, 'Edlish test', 'chepaer test ', '2018-11-09', '2018-11-19', 'Student', '', '26;27;', 'C:\\wamp\\www\\Progress_Api\\img\\Aboutus.jpg', '', '', '', '', 'No', '', 'Staff', 1, '2019-03-29 10:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE IF NOT EXISTS `otp` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `user_id` int(5) NOT NULL,
  `otp` int(6) NOT NULL,
  `date` datetime(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `type`, `user_id`, `otp`, `date`) VALUES
(1, 'Staff', 1, 346551, '0000-00-00 00:00:00.00000'),
(2, 'Staff', 1, 346551, '0000-00-00 00:00:00.00000'),
(3, 'Staff', 1, 423788, '0000-00-00 00:00:00.00000'),
(4, 'Staff', 1, 423788, '0000-00-00 00:00:00.00000'),
(5, 'Staff', 1, 303761, '0000-00-00 00:00:00.00000'),
(6, 'Staff', 1, 303761, '0000-00-00 00:00:00.00000'),
(7, 'Staff', 1, 697919, '0000-00-00 00:00:00.00000'),
(8, 'Staff', 1, 697919, '0000-00-00 00:00:00.00000'),
(9, 'Staff', 1, 757737, '0000-00-00 00:00:00.00000'),
(10, 'Staff', 1, 757737, '0000-00-00 00:00:00.00000'),
(11, 'Student', 5, 775698, '0000-00-00 00:00:00.00000'),
(12, 'Student', 5, 775698, '0000-00-00 00:00:00.00000'),
(13, 'Praent', 5, 907771, '0000-00-00 00:00:00.00000'),
(14, 'Praent', 5, 907771, '0000-00-00 00:00:00.00000'),
(15, 'Staff', 1, 154131, '2019-03-16 10:26:00.00000'),
(16, 'Staff', 1, 154131, '2019-03-16 10:26:00.00000'),
(17, 'Staff', 1, 40426, '2019-03-16 14:58:00.00000'),
(18, 'Staff', 1, 40426, '2019-03-16 14:58:00.00000'),
(19, 'Staff', 1, 106039, '2019-03-16 14:59:00.00000'),
(20, 'Staff', 1, 106039, '2019-03-16 14:59:00.00000'),
(21, 'Staff', 1, 431087, '2019-03-16 15:01:00.00000'),
(22, 'Staff', 1, 431087, '2019-03-16 15:01:00.00000'),
(23, 'Staff', 1, 609491, '2019-03-16 15:02:00.00000');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `mobile`, `password`, `card_no`, `gender`, `birthdate`, `designation`, `joining_date`, `experience`, `education`, `address`, `city`, `state`, `zipcode`, `department`, `photo`, `date`, `status`) VALUES
(1, 'akshay', 's', 'patel', 'ap44556677@gmail.com', '982553030', '123456', '86589', 'Male', '2008-02-01', 'profressor', '1998-05-01', '5', 'b.e', 'balvada', 'navsari', 'guj', '396521', '16', '', '2019-03-14', ''),
(2, 'Manoj', 'm', 'Patel', 'manoj@gmail.com', '873656334', '123456', '4757', 'Male', '2009-02-03', 'profressor', '1998-06-01', '3', 'M.E', 'surat', 'suart', 'guj', '347575', '16', '', '2019-03-14', ''),
(3, 'akash', 't', 'patel', 'aksah@gmail.vom', '983575838', '123456', '3533', 'Male', '2008-03-01', 'profressor', '1998-07-01', '4', 'm.e', 'navsari', 'navsari', 'guj', '377474', '16', '', '2019-03-14', ''),
(4, 'dhanraj', 's', 'patel', 'dhanraj@gmail.com', '348943287', '123456', '342', 'Male', '2010-06-03', 'profressor', '1998-08-01', '2', 'm.e', 'vapi', 'vapi', 'guj', '348538', '16', '', '2019-03-14', ''),
(5, 'dhaval', 'a', 'patel', 'dhaval@gmail.com', '348943288', '123456', '343', 'Male', '2010-06-04', 'profressor', '1998-09-01', '3', 'm.e', 'vapi', 'vapi', 'guj', '348539', '16', '', '2019-03-14', ''),
(6, 'tejash', 'b', 'patel', 'tejash@gmail.com', '348943289', '123456', '344', 'Male', '2010-06-05', 'profressor', '1998-10-01', '4', 'm.e', 'vapi', 'vapi', 'guj', '348540', '16', '', '2019-03-14', ''),
(7, 'bhumit', 'c', 'patel', 'bhumit@gmail.com', '348943290', '123456', '345', 'Male', '2010-06-06', 'profressor', '1998-11-01', '5', 'm.e', 'vapi', 'vapi', 'guj', '348541', '16', '', '2019-03-14', ''),
(8, 'sagar', 'j', 'patel', 'sagar@gmail.com', '348943291', '123456', '346', 'Male', '2010-06-07', 'profressor', '1998-12-01', '6', 'm.e', 'vapi', 'vapi', 'guj', '348542', '16', '', '2019-03-14', ''),
(9, 'nitesh', 't', 'patel', 'nitesh@gmail.com', '348943292', '123456', '347', 'Male', '2010-06-08', 'profressor', '1999-01-01', '7', 'm.e', 'vapi', 'vapi', 'guj', '348543', '16', '', '2019-03-14', ''),
(10, 'pratik', 's', 'patel', 'pratik@gmail.com', '348943293', '123456', '348', 'Male', '2010-06-09', 'profressor', '1999-02-01', '8', 'm.e', 'vapi', 'vapi', 'guj', '348544', '16', '', '2019-03-14', ''),
(11, 'mehul', 'i', 'patel', 'mehul@gmail.com', '348943294', '123456', '349', 'Male', '2010-06-10', 'profressor', '1999-03-01', '9', 'm.e', 'vapi', 'vapi', 'guj', '348545', '16', '', '2019-03-14', ''),
(12, 'devang', 'p', 'patel', 'devang@gmail.com', '348943295', '123456', '350', 'Male', '2010-06-11', 'profressor', '1999-04-01', '10', 'm.e', 'vapi', 'vapi', 'guj', '348546', '16', '', '2019-03-14', ''),
(13, 'mahendra', 'a', 'patel', 'mahendra@gmail.com', '348943296', '123456', '351', 'Male', '2010-06-12', 'profressor', '1999-05-01', '11', 'm.e', 'vapi', 'vapi', 'guj', '348547', '16', '', '2019-03-14', ''),
(14, 'fenil', 'a', 'patel', 'fenil@gmail.com', '348943297', '123456', '352', 'Male', '2010-06-13', 'profressor', '1999-06-01', '12', 'm.e', 'vapi', 'vapi', 'guj', '348548', '16', '', '2019-03-14', ''),
(15, 'ajay', 'a', 'patel', 'ajay@gmail.com', '348943298', '123456', '353', 'Male', '2010-06-14', 'profressor', '1999-07-01', '13', 'm.e', 'vapi', 'vapi', 'guj', '348549', '16', '', '2019-03-14', ''),
(16, 'vijay', 'd', 'patel', 'viay@gmail.com', '348943299', '123456', '354', 'Male', '2010-06-15', 'profressor', '1999-08-01', '14', 'm.e', 'vapi', 'vapi', 'guj', '348550', '16', '', '2019-03-14', ''),
(17, 'shashi', 's', 'patel', 'shashi@gmail.com', '348943300', '123456', '355', 'Male', '2010-06-16', 'profressor', '1999-09-01', '15', 'm.e', 'vapi', 'vapi', 'guj', '348551', '16', '', '2019-03-14', ''),
(18, 'vikas', 'z', 'patel', 'vikas@gmail.com', '348943301', '123456', '356', 'Male', '2010-06-17', 'profressor', '1999-10-01', '16', 'm.e', 'vapi', 'vapi', 'guj', '348552', '16', '', '2019-03-14', ''),
(19, 'deevdep', 'v', 'patel', 'deevdep@gmail.com', '348943302', '123456', '357', 'Male', '2010-06-18', 'profressor', '1999-11-01', '17', 'm.e', 'vapi', 'vapi', 'guj', '348553', '16', '', '2019-03-14', ''),
(20, 'jay', 'b', 'patel', 'jay@gmail.com', '348943303', '123456', '358', 'Male', '2010-06-19', 'profressor', '1999-12-01', '18', 'm.e', 'vapi', 'vapi', 'guj', '348554', '16', '', '2019-03-14', ''),
(21, 'kalpesh', 'n', 'patel', 'kalpesh@gmail.com', '348943304', '123456', '359', 'Male', '2010-06-20', 'profressor', '2000-01-01', '19', 'm.e', 'vapi', 'vapi', 'guj', '348555', '16', '', '2019-03-14', ''),
(22, 'nimesh', 'm', 'patel', 'nimesh@gmail.com', '348943305', '123456', '360', 'Male', '2010-06-21', 'profressor', '2000-02-01', '20', 'm.e', 'vapi', 'vapi', 'guj', '348556', '16', '', '2019-03-14', ''),
(23, 'jigar', 'k', 'patel', 'jigar@gmail.com', '348943306', '123456', '361', 'Male', '2010-06-22', 'profressor', '2000-03-01', '21', 'm.e', 'vapi', 'vapi', 'guj', '348557', '16', '', '2019-03-14', ''),
(24, 'umesh', 'j', 'patel', 'umesh@gmail.com', '348943307', '123456', '362', 'Male', '2010-06-23', 'profressor', '2000-04-01', '22', 'm.e', 'vapi', 'vapi', 'guj', '348558', '16', '', '2019-03-14', ''),
(25, 'lokesh', 'l', 'patel', 'lokesh@gmail.com', '348943308', '123456', '363', 'Male', '2010-06-24', 'profressor', '2000-05-01', '23', 'm.e', 'vapi', 'vapi', 'guj', '348559', '16', '', '2019-03-14', ''),
(26, 'pranav', 'u', 'patel', 'pranav@gmail.com', '348943309', '123456', '364', 'Male', '2010-06-25', 'profressor', '2000-06-01', '24', 'm.e', 'vapi', 'vapi', 'guj', '348560', '16', '', '2019-03-14', ''),
(27, 'mehul', 'r', 'patel', 'mehul1@gmail.com', '348943310', '123456', '365', 'Male', '2010-06-26', 'profressor', '2000-07-01', '25', 'm.e', 'vapi', 'vapi', 'guj', '348561', '16', '', '2019-03-14', ''),
(28, 'divyesh', 'd', 'patel', 'divyesh@gmail.com', '348943311', '123456', '366', 'Male', '2010-06-27', 'profressor', '2000-08-01', '26', 'm.e', 'vapi', 'vapi', 'guj', '348562', '16', '', '2019-03-14', ''),
(29, 'dhaval', 's', 'patel', 'dhaval23@gmail.com', '348943312', '123456', '367', 'Male', '2010-06-28', 'profressor', '2000-09-01', '27', 'm.e', 'vapi', 'vapi', 'guj', '348563', '16', '', '2019-03-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

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
  `photo` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `mobile`, `password`, `gender`, `birthdate`, `address`, `city`, `state`, `zipcode`, `academic_year`, `admission_date`, `enrollment_no`, `parent_first_name`, `parent_last_name`, `parent_email`, `parent_mobile`, `parent_password`, `class_id`, `batch_name`, `date`, `photo`, `user_id`, `status`) VALUES
(1, 'sagar', 'a', 'jagani', 'akshay@gmail.com', '8160944195', 'e10adc3949ba59abbe56e057f20f88', 'Male', '1997-06-09', 'surat', 'surat', 'guj', '368520', '2015', '2012-01-08', '150860116010', 'xyx', 'abc', 'xyz@gmail.com', '8698774258', 'e10adc3949ba59abbe56e057f20f88', 26, 'H1', '2019-03-14', '', 1, ''),
(2, 'akshay', 'm', 'patel', 'manoj@gmail.com', '9825647264', '123456', 'Male', '1994-06-05', 'balvada', 'nasari', 'guj', '396521', '2015', '2016-08-02', '150860116011', 'sub12', 'pki', 'sub12@gmail.com', '98567431', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(3, 'dhaval', 'a', 'patel', 'aksah@gmail.vom', '9825647265', '123456', 'Male', '1994-07-05', 'vapi', 'vapi', 'guj', '396522', '2015', '2016-09-02', '150860116012', 'sub13', 'pki', 'sub13@gmail.com', '98567432', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(4, 'tejash', 'b', 'patel', 'dhanraj@gmail.com', '9825647266', '123456', 'Male', '1994-08-05', 'vapi', 'vapi', 'guj', '396523', '2015', '2016-10-02', '150860116013', 'sub14', 'pki', 'sub14@gmail.com', '98567433', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(5, 'bhumit', 'm', 'patel', 'bhumitpatel58@gmail.com', '9825647267', '123456', 'Male', '1994-09-05', 'vapi', 'vapi', 'guj', '396524', '2015', '2016-11-02', '150860116014', 'sub15', 'pki', 'bhumitpatel58@gmail.com', '98567434', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(6, 'sagar', 'j', 'patel', 'tejash@gmail.com', '9825647268', '123456', 'Male', '1994-10-05', 'vapi', 'vapi', 'guj', '396525', '2015', '2016-12-02', '150860116015', 'sub16', 'pki', 'sub16@gmail.com', '98567435', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(7, 'nitesh', 't', 'patel', 'bhumit@gmail.com', '9825647269', '123456', 'Male', '1994-11-05', 'vapi', 'vapi', 'guj', '396526', '2015', '2017-01-02', '150860116016', 'sub17', 'pki', 'sub17@gmail.com', '98567436', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(8, 'pratik', 's', 'patel', 'sagar@gmail.com', '9825647270', '123456', 'Male', '1994-12-05', 'vapi', 'vapi', 'guj', '396527', '2015', '2017-02-02', '150860116017', 'sub18', 'pki', 'sub18@gmail.com', '98567437', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(9, 'mehul', 'i', 'patel', 'nitesh@gmail.com', '9825647271', '123456', 'Male', '1995-01-05', 'vapi', 'vapi', 'guj', '396528', '2015', '2017-03-02', '150860116018', 'sub19', 'pki', 'sub19@gmail.com', '98567438', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(10, 'devang', 'p', 'patel', 'pratik@gmail.com', '9825647272', '123456', 'Male', '1995-02-05', 'vapi', 'vapi', 'guj', '396529', '2015', '2017-04-02', '150860116019', 'sub20', 'pki', 'sub20@gmail.com', '98567439', '123456', 26, 'H1', '2019-03-14', '', 1, ''),
(11, 'mahendra', 'a', 'patel', 'mehul@gmail.com', '9825647273', '123456', 'Male', '1995-03-05', 'vapi', 'vapi', 'guj', '396530', '2015', '2017-05-02', '150860116020', 'sub21', 'pki', 'sub21@gmail.com', '98567440', '123456', 26, 'H2', '2019-03-14', '', 1, ''),
(12, 'fenil', 'a', 'patel', 'devang@gmail.com', '9825647274', '123456', 'Male', '1995-04-05', 'vapi', 'vapi', 'guj', '396531', '2015', '2017-06-02', '150860116021', 'sub22', 'pki', '22sub@gmail.com', '98567441', '123456', 26, 'H2', '2019-03-14', '', 1, ''),
(13, 'ajay', 'a', 'patel', 'mahendra@gmail.com', '9825647275', '123456', 'Male', '1995-05-05', 'vapi', 'vapi', 'guj', '396532', '2015', '2017-07-02', '150860116022', 'sub23', 'pki', '23sub@gmail.com', '98567442', '123456', 26, 'H2', '2019-03-14', '', 1, ''),
(14, 'vijay', 'd', 'patel', 'fenil@gmail.com', '9825647276', '123456', 'Male', '1995-06-05', 'vapi', 'vapi', 'guj', '396533', '2015', '2017-08-02', '150860116023', 'sub24', 'pki', '24sub@gmail.com', '98567443', '123456', 26, 'H2', '2019-03-14', '', 1, ''),
(15, 'shashi', 's', 'patel', 'ajay@gmail.com', '9825647277', '123456', 'Male', '1995-07-05', 'vapi', 'vapi', 'guj', '396534', '2015', '2017-09-02', '150860116024', 'sub25', 'pki', '25sub@gmail.com', '98567444', '123456', 26, 'H2', '2019-03-14', '', 1, ''),
(16, 'vikas', 'z', 'patel', 'viay@gmail.com', '9825647278', '123456', 'Male', '1995-08-05', 'vapi', 'vapi', 'guj', '396535', '2015', '2017-10-02', '150860116025', 'sub26', 'pki', '26sub@gmail.com', '98567445', '123456', 26, 'H2', '2019-03-14', '', 1, ''),
(17, 'deevdep', 'v', 'patel', 'shashi@gmail.com', '9825647279', '123456', 'Male', '1995-09-05', 'vapi', 'vapi', 'guj', '396536', '2015', '2017-11-02', '150860116026', 'sub27', 'pki', '27sub@gmail.com', '98567446', '123456', 26, 'H2', '2019-03-14', '', 1, ''),
(18, 'jay', 'b', 'patel', 'vikas@gmail.com', '9825647280', '123456', 'Male', '1995-10-05', 'vapi', 'vapi', 'guj', '396537', '2015', '2017-12-02', '150860116027', 'sub28', 'pki', '28sub@gmail.com', '98567447', '123456', 26, 'H2', '2019-03-14', '', 1, ''),
(19, 'kalpesh', 'n', 'patel', 'deevdep@gmail.com', '9825647281', '123456', 'Male', '1995-11-05', 'vapi', 'vapi', 'guj', '396538', '2015', '2018-01-02', '150860116028', 'sub29', 'pki', '29sub@gmail.com', '98567448', '123456', 26, 'H3', '2019-03-14', '', 1, ''),
(20, 'nimesh', 'm', 'patel', 'jay@gmail.com', '9825647282', '123456', 'Male', '1995-12-05', 'vapi', 'vapi', 'guj', '396539', '2015', '2018-02-02', '150860116029', 'sub30', 'pki', '30sub@gmail.com', '98567449', '123456', 26, 'H3', '2019-03-14', '', 1, ''),
(21, 'jigar', 'k', 'patel', 'kalpesh@gmail.com', '9825647283', '123456', 'Male', '1996-01-05', 'vapi', 'vapi', 'guj', '396540', '2015', '2018-03-02', '150860116030', 'sub31', 'pki', '31sub@gmail.com', '98567450', '123456', 26, 'H3', '2019-03-14', '', 1, ''),
(22, 'umesh', 'j', 'patel', 'nimesh@gmail.com', '9825647284', '123456', 'Male', '1996-02-05', 'vapi', 'vapi', 'guj', '396541', '2015', '2018-04-02', '150860116031', 'sub32', 'pki', '32sub@gmail.com', '98567451', '123456', 26, 'H3', '2019-03-14', '', 1, ''),
(23, 'lokesh', 'l', 'patel', 'jigar@gmail.com', '9825647285', '123456', 'Male', '1996-03-05', 'vapi', 'vapi', 'guj', '396542', '2015', '2018-05-02', '150860116032', 'sub33', 'pki', '33sub@gmail.com', '98567452', '123456', 26, 'H3', '2019-03-14', '', 1, ''),
(24, 'pranav', 'u', 'patel', 'umesh@gmail.com', '9825647286', '123456', 'Male', '1996-04-05', 'vapi', 'vapi', 'guj', '396543', '2015', '2018-06-02', '150860116033', 'sub34', 'pki', '34sub@gmail.com', '98567453', '123456', 26, 'H3', '2019-03-14', '', 1, ''),
(25, 'mehul', 'r', 'patel', 'lokesh@gmail.com', '9825647287', '123456', 'Male', '1996-05-05', 'vapi', 'vapi', 'guj', '396544', '2015', '2018-07-02', '150860116034', 'sub35', 'pki', '35sub@gmail.com', '98567454', '123456', 26, 'H3', '2019-03-14', '', 1, ''),
(26, 'divyesh', 'd', 'patel', 'pranav@gmail.com', '9825647288', '123456', 'Male', '1996-06-05', 'vapi', 'vapi', 'guj', '396545', '2015', '2018-08-02', '150860116035', 'sub36', 'pki', '36sub@gmail.com', '98567455', '123456', 26, 'H3', '2019-03-14', '', 1, ''),
(27, 'dhaval', 's', 'patel', 'mehul1@gmail.com', '9825647289', '123456', 'Male', '1996-07-05', 'vapi', 'vapi', 'guj', '396546', '2015', '2018-09-02', '150860116036', 'sub37', 'pki', '37sub@gmail.com', '98567456', '123456', 26, 'H3', '2019-03-14', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `subject_code` int(15) NOT NULL,
  `sub_name` varchar(25) NOT NULL,
  `attendance_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `class_id`, `subject_code`, `sub_name`, `attendance_type`) VALUES
(1, 26, 2180703, 'Artificial Intelligence', 'Full'),
(2, 26, 2180703, 'Artificial Intelligence(P', 'Batch_wise'),
(3, 26, 2180706, 'Project-2', 'Full'),
(4, 26, 2180711, 'Python Programming ', 'Full'),
(5, 26, 2180711, 'Python Programming(Pra)', 'Batch_wise'),
(6, 26, 2180713, 'Web Data Management', 'Full'),
(7, 26, 2180713, 'Web Data Management(Pra)', 'Batch_wise');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE IF NOT EXISTS `time` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no` int(10) NOT NULL,
  `timing` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE IF NOT EXISTS `time_table` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time` int(10) NOT NULL,
  `assign_id` int(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `total_mark`
--

CREATE TABLE IF NOT EXISTS `total_mark` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `exam_sub_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `mark` int(10) NOT NULL,
  `present` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
