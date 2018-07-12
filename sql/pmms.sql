-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2018 at 08:50 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `email`, `type`) VALUES
('admin_mini', 'mini_project', 'admin', 'admin_mini@xyz.com', 'mini_'),
('admin_proj1', 'project1', 'admin', 'admin_proj1@bvm.com', 'project1_'),
('admin_proj2', 'project2', 'admin', 'admin_proj2@bvm.com', 'project2_');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` varchar(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `email`, `password`) VALUES
('nbp', 'nilesh prajapati', 'nbp@bvm.com', 'nbp'),
('pks', 'prachi shah', 'pks@bvm.com', 'pks'),
('zhs', 'zankhana shah', 'zhs@bvm.com', 'zhs');

-- --------------------------------------------------------

--
-- Table structure for table `mini_dashboard`
--

CREATE TABLE `mini_dashboard` (
  `id` int(4) NOT NULL,
  `date` varchar(10) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_dashboard`
--

INSERT INTO `mini_dashboard` (`id`, `date`, `heading`, `content`) VALUES
(39, '08-03-2018', 'Mini project submission ', 'Students are requested to submit project report by this week'),
(40, '12-03-2018', 'Mini project submission details ', 'Students have to submit PPR1, PPR2 and Powerpoint Presentation explaining your project and you have to present presentation'),
(41, '04-05-2018', 'll', 'll'),
(42, '24-05-2018', 'qzs', 'za');

-- --------------------------------------------------------

--
-- Table structure for table `mini_disable_registration`
--

CREATE TABLE `mini_disable_registration` (
  `team_disable` tinyint(4) NOT NULL,
  `project_disable` tinyint(4) NOT NULL,
  `report_disable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_disable_registration`
--

INSERT INTO `mini_disable_registration` (`team_disable`, `project_disable`, `report_disable`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mini_faq`
--

CREATE TABLE `mini_faq` (
  `id` int(11) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_faq`
--

INSERT INTO `mini_faq` (`id`, `heading`, `content`) VALUES
(14, 'When is the mini project mid semester examination?', 'Exams are on 12th March 2018,  Monday'),
(17, 'what should the final submission content? ', 'Final submission contain:<br>\r\n1. Final Report<br>\r\n2. PPT<br>\r\n3. Implemented project\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `mini_notice`
--

CREATE TABLE `mini_notice` (
  `id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `gid` int(11) NOT NULL,
  `fid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_notice`
--

INSERT INTO `mini_notice` (`id`, `date`, `heading`, `content`, `gid`, `fid`) VALUES
(4, '04-05-2018', 'hello this is a trial notice', 'h', 2, 'pks'),
(6, '04-05-2018', 'q', 'q', 1, 'nbp'),
(7, '04-05-2018', 'q', 'q', 5, 'nbp'),
(8, '04-05-2018', 'q', 'q', 6, 'nbp'),
(9, '24-05-2018', '1', '1', 2, 'pks'),
(10, '24-05-2018', '123', '123', 2, 'pks'),
(11, '24-05-2018', '1111', '1113', 6, 'pks'),
(12, '24-05-2018', 'qw', 'qw', 2, 'pks'),
(13, '24-05-2018', 'qz', 'qa', 1, 'nbp');

-- --------------------------------------------------------

--
-- Table structure for table `mini_project`
--

CREATE TABLE `mini_project` (
  `gid` int(11) NOT NULL,
  `ppr1` tinyint(1) NOT NULL,
  `ppr1_approved` tinyint(1) NOT NULL,
  `ppr1_disapproved` tinyint(1) NOT NULL,
  `ppr2` tinyint(1) NOT NULL,
  `ppr2_approved` tinyint(1) NOT NULL,
  `ppr2_disapproved` tinyint(1) NOT NULL,
  `ppr3` tinyint(1) NOT NULL,
  `ppr3_approved` tinyint(1) NOT NULL,
  `ppr3_disapproved` tinyint(1) NOT NULL,
  `ppr4` tinyint(1) NOT NULL,
  `ppr4_approved` tinyint(1) NOT NULL,
  `ppr4_disapproved` tinyint(1) NOT NULL,
  `plag_report` tinyint(1) NOT NULL,
  `plag_approved` tinyint(1) NOT NULL,
  `plag_disapproved` tinyint(1) NOT NULL,
  `final_report` tinyint(1) NOT NULL,
  `final_approved` tinyint(1) NOT NULL,
  `final_disapproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_project`
--

INSERT INTO `mini_project` (`gid`, `ppr1`, `ppr1_approved`, `ppr1_disapproved`, `ppr2`, `ppr2_approved`, `ppr2_disapproved`, `ppr3`, `ppr3_approved`, `ppr3_disapproved`, `ppr4`, `ppr4_approved`, `ppr4_disapproved`, `plag_report`, `plag_approved`, `plag_disapproved`, `final_report`, `final_approved`, `final_disapproved`) VALUES
(1, 1, 1, 0, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, 0),
(2, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mini_remark`
--

CREATE TABLE `mini_remark` (
  `id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `head` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_remark`
--

INSERT INTO `mini_remark` (`id`, `gid`, `head`, `type`) VALUES
(1, 2, 'jksd', 'ppr1'),
(2, 1, 'blah... blahh', 'plag'),
(3, 1, 'jkashkjashd shkjdhakh', 'ppr1'),
(4, 1, 'khjh', 'ppr1'),
(5, 1, 'nhwhjwh', 'final');

-- --------------------------------------------------------

--
-- Table structure for table `mini_report`
--

CREATE TABLE `mini_report` (
  `ppr` int(11) NOT NULL,
  `team_min` int(11) NOT NULL,
  `team_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_report`
--

INSERT INTO `mini_report` (`ppr`, `team_min`, `team_max`) VALUES
(2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mini_student`
--

CREATE TABLE `mini_student` (
  `id` varchar(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_student`
--

INSERT INTO `mini_student` (`id`, `name`, `email`, `password`) VALUES
('15it001', 'raj ambani', 'harshilshah186@gmail.com', '123456'),
('15it002', 'karan', 'kran@bvm.com', ''),
('15it004', 'Darshit', 'darshit@bvm.com', ''),
('15it007', 'Asmita ', 'harshilshah186@gmail.com', '123456'),
('15it020', '', '', ''),
('15it021', '', '', ''),
('15it022', '', '', ''),
('15it023', '', '', ''),
('15it024', '', '', ''),
('15it025', '', 'harshilshah186@gmail.com', '123456'),
('15it026', '', '', ''),
('15it027', '', '', ''),
('15it039', 'Harsh', 'harsh@bvm.com', ''),
('15it048', 'Raj', 'kadhi@bvm.com', ''),
('15it049', 'Rahul', 'rahul@bvm.com', ''),
('15it050', 'Dhvanit', 'dhavnit@bvm.com', ''),
('15it061', 'Bhairavi', 'bhairavi@gmail.com', 'bhairavi'),
('15it062', 'nidhish', 'nidhish@bvm.com', ''),
('15it064', 'sanket', 'sanket@bvm.com', ''),
('15it067', 'Richa', '1@1.com', 'richa12'),
('15it068', 'nishit', 'harshilshah186@gmail.com', '123456'),
('15it069', 'harshil', 'harshilshah186@gmail.com', 'hs2310'),
('15it072', 'vinesh', 'vinesh@bvm.com', ''),
('16it601', '', '', ''),
('16it603', 'Jay', 'jay@bvm.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `mini_team`
--

CREATE TABLE `mini_team` (
  `gid` int(11) NOT NULL,
  `id1` varchar(8) NOT NULL,
  `id2` varchar(8) DEFAULT NULL,
  `id3` varchar(8) DEFAULT NULL,
  `id4` varchar(8) DEFAULT NULL,
  `id5` varchar(8) DEFAULT NULL,
  `fid` varchar(3) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `disapproved` tinyint(1) NOT NULL,
  `definition` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `def_approved` tinyint(1) NOT NULL,
  `def_disapproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_team`
--

INSERT INTO `mini_team` (`gid`, `id1`, `id2`, `id3`, `id4`, `id5`, `fid`, `approved`, `disapproved`, `definition`, `description`, `def_approved`, `def_disapproved`) VALUES
(1, '15it069', '15it048', '15it049', NULL, NULL, 'nbp', 1, 0, '1', 'zzzzzzzzzz', 1, 0),
(2, '15it001', '15it067', '15it061', NULL, NULL, 'pks', 1, 0, 'blahh', 'blahhh', 1, 0),
(3, '15it007', '15it002', '15it039', NULL, NULL, 'zhs', 1, 0, 'oifgoii', 'oidfugodu', 1, 0),
(4, '16it603', '15it050', '15it004', NULL, NULL, '', 1, 0, '', '', 0, 0),
(5, '16it601', '15it064', '15it062', NULL, NULL, '', 1, 0, '', '', 0, 0),
(6, '15it068', '15it072', '', '', '', 'pks', 1, 0, 'jkasd', 'khjhkhd', 1, 0),
(7, '15it020', '15it021', '', '', '', '', 1, 1, '', '', 0, 0),
(8, '15it022', '15it023', '15it024', '', '', 'nbp', 1, 0, '1', '1', 0, 1),
(9, '15it025', '15it026', '', '', '', '', 1, 0, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project1_dashboard`
--

CREATE TABLE `project1_dashboard` (
  `id` int(4) NOT NULL,
  `date` varchar(10) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project1_dashboard`
--

INSERT INTO `project1_dashboard` (`id`, `date`, `heading`, `content`) VALUES
(1, '26-04-2018', 'ahdjh', 'hjsdfjhg');

-- --------------------------------------------------------

--
-- Table structure for table `project1_disable_registration`
--

CREATE TABLE `project1_disable_registration` (
  `team_disable` tinyint(4) NOT NULL,
  `project_disable` tinyint(4) NOT NULL,
  `report_disable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project1_disable_registration`
--

INSERT INTO `project1_disable_registration` (`team_disable`, `project_disable`, `report_disable`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project1_faq`
--

CREATE TABLE `project1_faq` (
  `id` int(11) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project1_notice`
--

CREATE TABLE `project1_notice` (
  `id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `gid` int(11) NOT NULL,
  `fid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project1_project`
--

CREATE TABLE `project1_project` (
  `gid` int(11) NOT NULL,
  `ppr1` tinyint(1) NOT NULL,
  `ppr1_approved` tinyint(1) NOT NULL,
  `ppr1_disapproved` tinyint(1) NOT NULL,
  `ppr2` tinyint(1) NOT NULL,
  `ppr2_approved` tinyint(1) NOT NULL,
  `ppr2_disapproved` tinyint(1) NOT NULL,
  `ppr3` tinyint(1) NOT NULL,
  `ppr3_approved` tinyint(1) NOT NULL,
  `ppr3_disapproved` tinyint(1) NOT NULL,
  `ppr4` tinyint(1) NOT NULL,
  `ppr4_approved` tinyint(1) NOT NULL,
  `ppr4_disapproved` tinyint(1) NOT NULL,
  `plag_report` tinyint(1) NOT NULL,
  `plag_approved` tinyint(1) NOT NULL,
  `plag_disapproved` tinyint(1) NOT NULL,
  `final_report` tinyint(1) NOT NULL,
  `final_approved` tinyint(1) NOT NULL,
  `final_disapproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project1_project`
--

INSERT INTO `project1_project` (`gid`, `ppr1`, `ppr1_approved`, `ppr1_disapproved`, `ppr2`, `ppr2_approved`, `ppr2_disapproved`, `ppr3`, `ppr3_approved`, `ppr3_disapproved`, `ppr4`, `ppr4_approved`, `ppr4_disapproved`, `plag_report`, `plag_approved`, `plag_disapproved`, `final_report`, `final_approved`, `final_disapproved`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project1_remark`
--

CREATE TABLE `project1_remark` (
  `id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `head` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project1_report`
--

CREATE TABLE `project1_report` (
  `ppr` int(11) NOT NULL,
  `team_min` int(11) NOT NULL,
  `team_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project1_report`
--

INSERT INTO `project1_report` (`ppr`, `team_min`, `team_max`) VALUES
(2, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `project1_student`
--

CREATE TABLE `project1_student` (
  `id` varchar(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project1_student`
--

INSERT INTO `project1_student` (`id`, `name`, `email`, `password`) VALUES
('15it001', 'raj', 'raj@bvm.com', ''),
('15it002', 'karan', '', ''),
('15it004', 'Darshit', '', ''),
('15it007', 'Asmita', '', ''),
('15it010', 'Prarthana', '', ''),
('15it051', '', '', ''),
('15it052', '', '', ''),
('15it053', '', '', ''),
('15it054', '', '', ''),
('15it055', '', '', ''),
('15it069', 'Harshil', 'harshil@bvm.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `project1_team`
--

CREATE TABLE `project1_team` (
  `gid` int(11) NOT NULL,
  `id1` varchar(8) NOT NULL,
  `id2` varchar(8) DEFAULT NULL,
  `id3` varchar(8) DEFAULT NULL,
  `id4` varchar(8) DEFAULT NULL,
  `id5` varchar(8) DEFAULT NULL,
  `fid` varchar(3) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `disapproved` tinyint(1) NOT NULL,
  `definition` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `def_approved` tinyint(1) NOT NULL,
  `def_disapproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project1_team`
--

INSERT INTO `project1_team` (`gid`, `id1`, `id2`, `id3`, `id4`, `id5`, `fid`, `approved`, `disapproved`, `definition`, `description`, `def_approved`, `def_disapproved`) VALUES
(1, '15it069', '15it001', '15it002', '15it004', '15it007', 'nbp', 1, 0, '', '', 0, 0),
(2, '15it051', '15it052', '15it053', '15it054', '15it055', 'nbp', 0, 0, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project2_dashboard`
--

CREATE TABLE `project2_dashboard` (
  `id` int(4) NOT NULL,
  `date` varchar(10) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project2_dashboard`
--

INSERT INTO `project2_dashboard` (`id`, `date`, `heading`, `content`) VALUES
(1, '17-03-2018', 'gfsgsssd', 'fdfg');

-- --------------------------------------------------------

--
-- Table structure for table `project2_disable_registration`
--

CREATE TABLE `project2_disable_registration` (
  `team_disable` tinyint(4) NOT NULL,
  `project_disable` tinyint(4) NOT NULL,
  `report_disable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project2_disable_registration`
--

INSERT INTO `project2_disable_registration` (`team_disable`, `project_disable`, `report_disable`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project2_faq`
--

CREATE TABLE `project2_faq` (
  `id` int(11) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project2_notice`
--

CREATE TABLE `project2_notice` (
  `id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `gid` int(11) NOT NULL,
  `fid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project2_project`
--

CREATE TABLE `project2_project` (
  `gid` int(11) NOT NULL,
  `ppr1` tinyint(1) NOT NULL,
  `ppr1_approved` tinyint(1) NOT NULL,
  `ppr1_disapproved` tinyint(1) NOT NULL,
  `ppr2` tinyint(1) NOT NULL,
  `ppr2_approved` tinyint(1) NOT NULL,
  `ppr2_disapproved` tinyint(1) NOT NULL,
  `ppr3` tinyint(1) NOT NULL,
  `ppr3_approved` tinyint(1) NOT NULL,
  `ppr3_disapproved` tinyint(1) NOT NULL,
  `ppr4` tinyint(1) NOT NULL,
  `ppr4_approved` tinyint(1) NOT NULL,
  `ppr4_disapproved` tinyint(1) NOT NULL,
  `plag_report` tinyint(1) NOT NULL,
  `plag_approved` tinyint(1) NOT NULL,
  `plag_disapproved` tinyint(1) NOT NULL,
  `final_report` tinyint(1) NOT NULL,
  `final_approved` tinyint(1) NOT NULL,
  `final_disapproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project2_project`
--

INSERT INTO `project2_project` (`gid`, `ppr1`, `ppr1_approved`, `ppr1_disapproved`, `ppr2`, `ppr2_approved`, `ppr2_disapproved`, `ppr3`, `ppr3_approved`, `ppr3_disapproved`, `ppr4`, `ppr4_approved`, `ppr4_disapproved`, `plag_report`, `plag_approved`, `plag_disapproved`, `final_report`, `final_approved`, `final_disapproved`) VALUES
(1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project2_remark`
--

CREATE TABLE `project2_remark` (
  `id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `head` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project2_remark`
--

INSERT INTO `project2_remark` (`id`, `gid`, `head`, `type`) VALUES
(0, 1, 'Your report is incomplete ', 'ppr2');

-- --------------------------------------------------------

--
-- Table structure for table `project2_report`
--

CREATE TABLE `project2_report` (
  `ppr` int(11) NOT NULL,
  `team_min` int(11) NOT NULL,
  `team_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project2_report`
--

INSERT INTO `project2_report` (`ppr`, `team_min`, `team_max`) VALUES
(3, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `project2_student`
--

CREATE TABLE `project2_student` (
  `id` varchar(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project2_student`
--

INSERT INTO `project2_student` (`id`, `name`, `email`, `password`) VALUES
('15it001', '', '', ''),
('15it002', '', '', ''),
('15it003', '', '', ''),
('15it004', '', '', ''),
('15it005', '', '', ''),
('15it006', '', '', ''),
('15it007', '', '', ''),
('15it008', '', '', ''),
('15it009', '', '', ''),
('15it010', '', '', ''),
('15it011', '', '', ''),
('15it012', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project2_team`
--

CREATE TABLE `project2_team` (
  `gid` int(11) NOT NULL,
  `id1` varchar(8) NOT NULL,
  `id2` varchar(8) DEFAULT NULL,
  `id3` varchar(8) DEFAULT NULL,
  `id4` varchar(8) DEFAULT NULL,
  `id5` varchar(8) DEFAULT NULL,
  `fid` varchar(3) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `disapproved` tinyint(1) NOT NULL,
  `definition` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `def_approved` tinyint(1) NOT NULL,
  `def_disapproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project2_team`
--

INSERT INTO `project2_team` (`gid`, `id1`, `id2`, `id3`, `id4`, `id5`, `fid`, `approved`, `disapproved`, `definition`, `description`, `def_approved`, `def_disapproved`) VALUES
(1, '15it001', '15it002', '15it003', '15it004', '15it005', 'nbp', 1, 0, '', '', 0, 0),
(2, '15it006', '15it008', '15it009', '15it012', '15it007', 'nbp', 0, 0, '', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mini_dashboard`
--
ALTER TABLE `mini_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mini_faq`
--
ALTER TABLE `mini_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mini_notice`
--
ALTER TABLE `mini_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mini_project`
--
ALTER TABLE `mini_project`
  ADD PRIMARY KEY (`gid`),
  ADD UNIQUE KEY `gid` (`gid`);

--
-- Indexes for table `mini_remark`
--
ALTER TABLE `mini_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mini_student`
--
ALTER TABLE `mini_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mini_team`
--
ALTER TABLE `mini_team`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `project1_dashboard`
--
ALTER TABLE `project1_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project1_faq`
--
ALTER TABLE `project1_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project1_project`
--
ALTER TABLE `project1_project`
  ADD PRIMARY KEY (`gid`),
  ADD UNIQUE KEY `gid` (`gid`);

--
-- Indexes for table `project1_student`
--
ALTER TABLE `project1_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project1_team`
--
ALTER TABLE `project1_team`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `project2_dashboard`
--
ALTER TABLE `project2_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project2_faq`
--
ALTER TABLE `project2_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project2_project`
--
ALTER TABLE `project2_project`
  ADD PRIMARY KEY (`gid`),
  ADD UNIQUE KEY `gid` (`gid`);

--
-- Indexes for table `project2_student`
--
ALTER TABLE `project2_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project2_team`
--
ALTER TABLE `project2_team`
  ADD PRIMARY KEY (`gid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mini_dashboard`
--
ALTER TABLE `mini_dashboard`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `mini_faq`
--
ALTER TABLE `mini_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mini_notice`
--
ALTER TABLE `mini_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mini_remark`
--
ALTER TABLE `mini_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mini_team`
--
ALTER TABLE `mini_team`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project1_dashboard`
--
ALTER TABLE `project1_dashboard`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project1_faq`
--
ALTER TABLE `project1_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project1_team`
--
ALTER TABLE `project1_team`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project2_dashboard`
--
ALTER TABLE `project2_dashboard`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project2_faq`
--
ALTER TABLE `project2_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project2_team`
--
ALTER TABLE `project2_team`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
