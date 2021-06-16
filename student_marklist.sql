-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2021 at 01:31 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_marklist`
--

-- --------------------------------------------------------

--
-- Table structure for table `stu_student`
--

DROP TABLE IF EXISTS `stu_student`;
CREATE TABLE IF NOT EXISTS `stu_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(150) NOT NULL,
  `studentNo` int(11) NOT NULL DEFAULT 0,
  `name` varchar(150) NOT NULL,
  `dob` varchar(25) NOT NULL,
  `age` int(11) NOT NULL,
  `mobile_no` varchar(25) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stu_student`
--

INSERT INTO `stu_student` (`id`, `regno`, `studentNo`, `name`, `dob`, `age`, `mobile_no`, `removed`) VALUES
(1, 'stu0001', 1, 'aravindh', '03/06/1997', 24, '8608896859', 0),
(2, 'stu0002', 2, 'arov', '17/07/1997', 23, '8072396968', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stu_student_files`
--

DROP TABLE IF EXISTS `stu_student_files`;
CREATE TABLE IF NOT EXISTS `stu_student_files` (
  `studentFileId` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` int(11) NOT NULL,
  `studentFileName` varchar(250) NOT NULL,
  `studentFileClient` varchar(500) NOT NULL,
  `studentFileExt` varchar(250) NOT NULL,
  `studentFileSize` varchar(150) NOT NULL,
  `studentFileFileType` varchar(150) NOT NULL,
  `studentFileHeight` varchar(150) NOT NULL,
  `studentFileWidth` varchar(150) NOT NULL,
  `studentFileType` varchar(150) NOT NULL,
  `studentFileIsImage` varchar(150) NOT NULL,
  `studentFileOrigName` varchar(250) NOT NULL,
  `studentFileRawName` varchar(250) NOT NULL,
  `studentFileDesc` text NOT NULL,
  `studentFileRemoved` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`studentFileId`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stu_student_files`
--

INSERT INTO `stu_student_files` (`studentFileId`, `studentId`, `studentFileName`, `studentFileClient`, `studentFileExt`, `studentFileSize`, `studentFileFileType`, `studentFileHeight`, `studentFileWidth`, `studentFileType`, `studentFileIsImage`, `studentFileOrigName`, `studentFileRawName`, `studentFileDesc`, `studentFileRemoved`) VALUES
(1, 1, '1623812432_4c674665c2c30fc061df2b4f63c77d35_Student.png', 'image_2021-06-14_17-41-43.png', '.png', '66.58', 'image/png', '1000', '1200', 'png', 'true', '1623812432_4c674665c2c30fc061df2b4f63c77d35_Student.png', '1623812432_4c674665c2c30fc061df2b4f63c77d35_Student', '', 1),
(2, 1, '1623812432_22fe4489ead74ebfcd2b1fafa90d1ff5_Student.png', 'image_2021-06-10_19-45-35.png', '.png', '143.91', 'image/png', '768', '1366', 'png', 'true', '1623812432_22fe4489ead74ebfcd2b1fafa90d1ff5_Student.png', '1623812432_22fe4489ead74ebfcd2b1fafa90d1ff5_Student', '', 1),
(3, 1, '1623812433_e64eaadfe625d2f859439df03adb811e_Student.png', 'image_2021-06-09_18-42-38.png', '.png', '240.01', 'image/png', '768', '1366', 'png', 'true', '1623812433_e64eaadfe625d2f859439df03adb811e_Student.png', '1623812433_e64eaadfe625d2f859439df03adb811e_Student', '', 1),
(4, 1, '1623812432_3e5a0cd88f9a1ee7f2d6f2d0354ab13a_Student.png', 'image_2021-06-09_18-22-52.png', '.png', '160.94', 'image/png', '768', '1366', 'png', 'true', '1623812432_3e5a0cd88f9a1ee7f2d6f2d0354ab13a_Student.png', '1623812432_3e5a0cd88f9a1ee7f2d6f2d0354ab13a_Student', '', 1),
(5, 1, '1623812433_f57b0616631411f2d5d756a4c540ec57_Student.png', 'image_2021-06-09_18-00-14.png', '.png', '216.06', 'image/png', '768', '1366', 'png', 'true', '1623812433_f57b0616631411f2d5d756a4c540ec57_Student.png', '1623812433_f57b0616631411f2d5d756a4c540ec57_Student', '', 1),
(6, 1, '1623812433_5d4d17bcf49644923e23ef0d61933bc4_Student.docx', 'Review june - 4.docx', '.docx', '19.67', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'null', 'null', '', 'false', '1623812433_5d4d17bcf49644923e23ef0d61933bc4_Student.docx', '1623812433_5d4d17bcf49644923e23ef0d61933bc4_Student', '', 1),
(7, 1, '1623812630_310042b7f1d1deb03d80d29fdabbbc60_Student.docx', 'Aravindhan-resume.docx', '.docx', '23.24', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'null', 'null', '', 'false', '1623812630_310042b7f1d1deb03d80d29fdabbbc60_Student.docx', '1623812630_310042b7f1d1deb03d80d29fdabbbc60_Student', '', 0),
(8, 1, '1623812630_e7cf887d6e118c901e66bdebd048a228_Student.png', 'image_2021-06-03_13-03-11.png', '.png', '97.29', 'image/png', '768', '1366', 'png', 'true', '1623812630_e7cf887d6e118c901e66bdebd048a228_Student.png', '1623812630_e7cf887d6e118c901e66bdebd048a228_Student', '', 0),
(9, 1, '1623812630_c66b0957fe0b2e36ecf592c68a383741_Student.png', 'image_2021-06-03_11-40-06.png', '.png', '62.34', 'image/png', '472', '679', 'png', 'true', '1623812630_c66b0957fe0b2e36ecf592c68a383741_Student.png', '1623812630_c66b0957fe0b2e36ecf592c68a383741_Student', '', 0),
(10, 2, '1623820298_ff0db607363abd565b245f2b51df105d_Student.png', 'image_2021-06-15_13-55-33.png', '.png', '261.17', 'image/png', '768', '1366', 'png', 'true', '1623820298_ff0db607363abd565b245f2b51df105d_Student.png', '1623820298_ff0db607363abd565b245f2b51df105d_Student', '', 0),
(11, 2, '1623820298_0d388a5c5ed35d0aea9c71a6c20f2c1a_Student.png', 'image_2021-06-14_17-41-43.png', '.png', '66.58', 'image/png', '1000', '1200', 'png', 'true', '1623820298_0d388a5c5ed35d0aea9c71a6c20f2c1a_Student.png', '1623820298_0d388a5c5ed35d0aea9c71a6c20f2c1a_Student', '', 0),
(12, 2, '1623820298_38107a1030c418c5b6220e1baeef3d52_Student.png', 'image_2021-06-10_19-45-35.png', '.png', '143.91', 'image/png', '768', '1366', 'png', 'true', '1623820298_38107a1030c418c5b6220e1baeef3d52_Student.png', '1623820298_38107a1030c418c5b6220e1baeef3d52_Student', '', 0),
(13, 2, '1623820298_db13712cb2560145dd1e889ae43e37d9_Student.png', 'image_2021-06-09_18-42-38.png', '.png', '240.01', 'image/png', '768', '1366', 'png', 'true', '1623820298_db13712cb2560145dd1e889ae43e37d9_Student.png', '1623820298_db13712cb2560145dd1e889ae43e37d9_Student', '', 0),
(14, 2, '1623820298_6b8daa52ce3f05d3da7aea4f1e0d750e_Student.png', 'image_2021-06-09_18-22-52.png', '.png', '160.94', 'image/png', '768', '1366', 'png', 'true', '1623820298_6b8daa52ce3f05d3da7aea4f1e0d750e_Student.png', '1623820298_6b8daa52ce3f05d3da7aea4f1e0d750e_Student', '', 0),
(15, 2, '1623820298_08da2a3dc9549363688e6100e4442ad8_Student.png', 'image_2021-06-09_18-00-14.png', '.png', '216.06', 'image/png', '768', '1366', 'png', 'true', '1623820298_08da2a3dc9549363688e6100e4442ad8_Student.png', '1623820298_08da2a3dc9549363688e6100e4442ad8_Student', '', 0),
(16, 2, '1623820299_b428eb6b84d55bb692108c810f133372_Student.png', 'image_2021-06-04_10-51-39.png', '.png', '93.09', 'image/png', '768', '1366', 'png', 'true', '1623820299_b428eb6b84d55bb692108c810f133372_Student.png', '1623820299_b428eb6b84d55bb692108c810f133372_Student', '', 0),
(17, 2, '1623820299_c2e8850d0b65b634122f5e178f585d65_Student.png', 'image_2021-06-04_10-48-02.png', '.png', '130.86', 'image/png', '768', '1366', 'png', 'true', '1623820299_c2e8850d0b65b634122f5e178f585d65_Student.png', '1623820299_c2e8850d0b65b634122f5e178f585d65_Student', '', 0),
(18, 2, '1623820299_fb83f62ddfe5d0bdd25144de7f9a98af_Student.png', 'image_2021-06-03_13-03-11.png', '.png', '97.29', 'image/png', '768', '1366', 'png', 'true', '1623820299_fb83f62ddfe5d0bdd25144de7f9a98af_Student.png', '1623820299_fb83f62ddfe5d0bdd25144de7f9a98af_Student', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stu_student_mark_list`
--

DROP TABLE IF EXISTS `stu_student_mark_list`;
CREATE TABLE IF NOT EXISTS `stu_student_mark_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` int(11) NOT NULL,
  `mark1` decimal(10,2) NOT NULL,
  `mark2` decimal(10,2) NOT NULL,
  `mark3` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `avg` decimal(10,2) NOT NULL,
  `rank` int(11) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stu_student_mark_list`
--

INSERT INTO `stu_student_mark_list` (`id`, `studentId`, `mark1`, `mark2`, `mark3`, `total`, `avg`, `rank`, `removed`) VALUES
(1, 1, '84.00', '95.00', '50.00', '229.00', '76.33', 2, 0),
(2, 2, '88.00', '90.00', '60.00', '238.00', '79.33', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
