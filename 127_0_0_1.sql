-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2014 at 05:26 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tnhs_archive2013`
--
CREATE DATABASE IF NOT EXISTS `tnhs_archive2013` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tnhs_archive2013`;

-- --------------------------------------------------------

--
-- Table structure for table `election_categories_position`
--

DROP TABLE IF EXISTS `election_categories_position`;
CREATE TABLE IF NOT EXISTS `election_categories_position` (
  `PositionID` varchar(40) NOT NULL,
  `PositionName` varchar(40) NOT NULL,
  `NomineeCount` int(40) NOT NULL,
  `ElectableCount` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `election_categories_position`
--

INSERT INTO `election_categories_position` (`PositionID`, `PositionName`, `NomineeCount`, `ElectableCount`) VALUES
('POS000', 'President', 3, 1),
('POS001', 'Vice-President', 2, 1),
('', 'PRO', 4, 2),
('', 'Secretary', 2, 1),
('', 'Magdalo', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `election_nominated_students`
--

DROP TABLE IF EXISTS `election_nominated_students`;
CREATE TABLE IF NOT EXISTS `election_nominated_students` (
  `AccountID` varchar(40) NOT NULL,
  `PositionName` varchar(40) NOT NULL,
  `PartyName` varchar(40) NOT NULL,
  `VoteCount` int(11) NOT NULL,
  PRIMARY KEY (`AccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `election_nominated_students`
--

INSERT INTO `election_nominated_students` (`AccountID`, `PositionName`, `PartyName`, `VoteCount`) VALUES
('S20060000', 'President', 'Magdiwang', 10),
('S20060001', 'President', 'Magdalo', 24),
('S20140001', 'President', 'Magdiwang', 11),
('S20140002', 'Vice-President', 'Magdiwang', 5),
('S20140003', 'Vice-President', 'Magdalo', 65),
('S20140004', 'PRO', 'Magdalo', 2),
('S20140007', 'PRO', 'Magdiwang', 4),
('S20140023', 'Secretary', 'Magdiwang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_enrollees`
--

DROP TABLE IF EXISTS `enrollment_enrollees`;
CREATE TABLE IF NOT EXISTS `enrollment_enrollees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_name` text NOT NULL,
  `gender` text NOT NULL,
  `type` text NOT NULL,
  `_education` text NOT NULL,
  `_info` text NOT NULL,
  `_parents` text NOT NULL,
  `ETC` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mis_accounts`
--

DROP TABLE IF EXISTS `mis_accounts`;
CREATE TABLE IF NOT EXISTS `mis_accounts` (
  `AccountID` varchar(40) NOT NULL,
  `AccountUsername` varchar(40) NOT NULL,
  `AccountPassword` varchar(40) NOT NULL,
  `Privilege` varchar(40) NOT NULL,
  `Status` varchar(40) NOT NULL,
  UNIQUE KEY `AccountUsername` (`AccountUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mis_accounts`
--

INSERT INTO `mis_accounts` (`AccountID`, `AccountUsername`, `AccountPassword`, `Privilege`, `Status`) VALUES
('T20060000', 'admin', 'admin', 'Admin', ''),
('T20060001', 'qwe', 'qwe', 'Admin', 'Active'),
('T20060003', 't3', 't3', 'Admin', 'Active'),
('T20060004', 't4', 't4', 'Admin', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `mis_campus_variables`
--

DROP TABLE IF EXISTS `mis_campus_variables`;
CREATE TABLE IF NOT EXISTS `mis_campus_variables` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mis_campus_variables`
--

INSERT INTO `mis_campus_variables` (`id`, `data`, `value`) VALUES
(1, 'yearBegin', '2013'),
(2, 'yearEnd', '2014'),
(3, 'sectionMax', '5');

-- --------------------------------------------------------

--
-- Table structure for table `mis_content_info`
--

DROP TABLE IF EXISTS `mis_content_info`;
CREATE TABLE IF NOT EXISTS `mis_content_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `page` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mis_content_info`
--

INSERT INTO `mis_content_info` (`id`, `title`, `content`, `page`) VALUES
(1, 'Welcome Page', 'this is the welcome screen text fetched from database. feel free to navigate anywhere.', 'home');

-- --------------------------------------------------------

--
-- Table structure for table `mis_grades`
--

DROP TABLE IF EXISTS `mis_grades`;
CREATE TABLE IF NOT EXISTS `mis_grades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountID` varchar(40) NOT NULL,
  `AverageGrade` varchar(40) NOT NULL,
  `SchoolYearBegin` varchar(40) NOT NULL,
  `SchoolYearEnd` varchar(40) NOT NULL,
  `YearLevel` varchar(40) NOT NULL,
  `SectionID` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mis_grades`
--

INSERT INTO `mis_grades` (`ID`, `AccountID`, `AverageGrade`, `SchoolYearBegin`, `SchoolYearEnd`, `YearLevel`, `SectionID`) VALUES
(1, 'S20060000', '90', '2006', '2007', '1', 'T20060000'),
(2, 'S20060000', '90', '2007', '2008', '2', 'T20060002'),
(3, 'S20060000', '90', '2008', '2009', '3', 'T20060003'),
(4, 'S20060000', '90', '2009', '2010', '4', 'T20060004');

-- --------------------------------------------------------

--
-- Table structure for table `mis_privileges`
--

DROP TABLE IF EXISTS `mis_privileges`;
CREATE TABLE IF NOT EXISTS `mis_privileges` (
  `Privilege` varchar(40) NOT NULL,
  `PrivilegeLevel` int(40) NOT NULL,
  `PrivilegeDescription` varchar(40) NOT NULL,
  `AllowedActions` varchar(80) NOT NULL,
  `AccessLevels` text NOT NULL,
  PRIMARY KEY (`Privilege`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mis_privileges`
--

INSERT INTO `mis_privileges` (`Privilege`, `PrivilegeLevel`, `PrivilegeDescription`, `AllowedActions`, `AccessLevels`) VALUES
('Admin', 6, 'School ICT Coordinators or Principal', 'read and write pages that requires level 6 privilege', '{"0":"home","1":"events","2":"profiles","3":"reports","4":"settings"}'),
('Facilitator', 2, 'Com Lab Peer Facilitators', 'read and write pages that requires level 2 privilege', '{"0":"home","1":"events","2":"profiles","3":"reports","4":"settings"}'),
('SuperUser', 3, 'Registered Teachers/Faculty', 'read and write pages that requires level 3 privilege', '{"0":"home","1":"events","2":"profiles","3":"reports"}'),
('Tech', 7, 'WebMasters', 'Full Control', '{"0":"home","1":"events","2":"profiles","3":"reports","4":"settings"}'),
('User', 1, 'Enrolled Students', 'read and write level 1 pages', '{"0":"home","1":"events","2":"profiles"}');

-- --------------------------------------------------------

--
-- Table structure for table `mis_school_advisory`
--

DROP TABLE IF EXISTS `mis_school_advisory`;
CREATE TABLE IF NOT EXISTS `mis_school_advisory` (
  `AdvisoryID` int(30) NOT NULL AUTO_INCREMENT,
  `roomSectionName` text NOT NULL,
  `starSection` text NOT NULL,
  `roomYearLevel` text NOT NULL,
  `AccountID` text NOT NULL,
  `roomID` text NOT NULL,
  `schoolYearBegin` text NOT NULL,
  `schoolYearEnd` text NOT NULL,
  PRIMARY KEY (`AdvisoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mis_school_advisory`
--

INSERT INTO `mis_school_advisory` (`AdvisoryID`, `roomSectionName`, `starSection`, `roomYearLevel`, `AccountID`, `roomID`, `schoolYearBegin`, `schoolYearEnd`) VALUES
(2, 'Hope', '', '1', 'T20060001', '1', '2013', '2014'),
(3, 'Love', '', '1', 'T20060000', '2', '2013', '2014'),
(4, 'Hope', '', '2', 'T20060003', '3', '2013', '2014'),
(5, 'Pardo', 'yes', '1', 'T20060004', '9', '2013', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `mis_school_info`
--

DROP TABLE IF EXISTS `mis_school_info`;
CREATE TABLE IF NOT EXISTS `mis_school_info` (
  `SchoolID` varchar(40) NOT NULL,
  `SchoolName` text NOT NULL,
  `Region` text NOT NULL,
  `Division` text NOT NULL,
  `History` text NOT NULL,
  `YearFounded` text NOT NULL,
  PRIMARY KEY (`SchoolID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mis_school_section`
--

DROP TABLE IF EXISTS `mis_school_section`;
CREATE TABLE IF NOT EXISTS `mis_school_section` (
  `roomID` int(11) NOT NULL AUTO_INCREMENT,
  `roomYearLevel` text NOT NULL,
  `roomSectionName` text NOT NULL,
  `starSection` text NOT NULL,
  PRIMARY KEY (`roomID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mis_school_section`
--

INSERT INTO `mis_school_section` (`roomID`, `roomYearLevel`, `roomSectionName`, `starSection`) VALUES
(1, '3', 'Love', 'yes'),
(2, '1', 'love', ''),
(3, '2', 'Love', ''),
(4, '2', 'Hope', 'yes'),
(5, '1', 'michael', ''),
(6, '2', 'Loves', ''),
(7, '3', 'jappy', ''),
(8, '4', 'Pardo', ''),
(9, '1', 'Pardo', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `mis_student_profile`
--

DROP TABLE IF EXISTS `mis_student_profile`;
CREATE TABLE IF NOT EXISTS `mis_student_profile` (
  `accountID` varchar(40) NOT NULL,
  `_name` text NOT NULL,
  `gender` text NOT NULL,
  `type` text NOT NULL,
  `_education` text NOT NULL,
  `_info` text NOT NULL,
  `_parents` text NOT NULL,
  `_siblings` text NOT NULL,
  `_enrolled` text NOT NULL,
  `year` text NOT NULL,
  `AverageGrade` text NOT NULL,
  `section` text NOT NULL,
  `Voted` text NOT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mis_sys_settings`
--

DROP TABLE IF EXISTS `mis_sys_settings`;
CREATE TABLE IF NOT EXISTS `mis_sys_settings` (
  `triggerName` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`triggerName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mis_sys_settings`
--

INSERT INTO `mis_sys_settings` (`triggerName`, `value`) VALUES
('accounts_active', '{"0":"1","1":"Admin","2":"Facilitator","3":"SuperUser","4":"Tech","5":"User"}'),
('liveEvents', '["","home","enrollment","election","electionresults"]');

-- --------------------------------------------------------

--
-- Table structure for table `mis_teacher_profile`
--

DROP TABLE IF EXISTS `mis_teacher_profile`;
CREATE TABLE IF NOT EXISTS `mis_teacher_profile` (
  `AccountID` varchar(40) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `MiddleName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `PoB` varchar(40) NOT NULL,
  `DoB` varchar(40) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `YearRegistered` varchar(40) NOT NULL,
  `Gender` varchar(40) NOT NULL,
  PRIMARY KEY (`AccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mis_teacher_profile`
--

INSERT INTO `mis_teacher_profile` (`AccountID`, `FirstName`, `MiddleName`, `LastName`, `PoB`, `DoB`, `Address`, `YearRegistered`, `Gender`) VALUES
('T20060000', 'James', 'Ejercito', 'Flores', 'Kamunggayan', '2014-02-21', 'Kamunggayan', '2006', 'Male'),
('T20060001', 'Vergel', 'Melendres', 'Epe', 'Talabahan', '2014-02-21', 'Talabahan', '2006', 'Male'),
('T20060002', 'Michael', 'Igot', 'Pradia', 'Kawayanan', '2014-02-21', 'Kawayanan', '2006', 'Male'),
('T20060003', 'Rannnie', 'Empoy', 'Empic', 'Sambagan', '2014-02-21', 'Sambagan', '2006', 'Male'),
('T20060004', 'Raffy', 'Jay', 'Teves', 'Mandaue', '2014-02-21', 'Mandaue', '2006', 'Male');
--
-- Database: `tnhs_settings`
--
CREATE DATABASE IF NOT EXISTS `tnhs_settings` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tnhs_settings`;

-- --------------------------------------------------------

--
-- Table structure for table `mis_config`
--

DROP TABLE IF EXISTS `mis_config`;
CREATE TABLE IF NOT EXISTS `mis_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` text NOT NULL,
  `val` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mis_config`
--

INSERT INTO `mis_config` (`id`, `key`, `val`) VALUES
(1, 'current_year', '2013');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
