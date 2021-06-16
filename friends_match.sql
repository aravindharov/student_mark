-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2021 at 04:56 PM
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
-- Database: `friends_match`
--

-- --------------------------------------------------------

--
-- Table structure for table `match_ci_session`
--

DROP TABLE IF EXISTS `match_ci_session`;
CREATE TABLE IF NOT EXISTS `match_ci_session` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `match_failure_log`
--

DROP TABLE IF EXISTS `match_failure_log`;
CREATE TABLE IF NOT EXISTS `match_failure_log` (
  `log_id` int(255) NOT NULL AUTO_INCREMENT,
  `log_entertime` datetime NOT NULL,
  `log_enter_ipaddress` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_result` int(11) NOT NULL DEFAULT 0,
  `log_valid_till` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_browser` int(11) NOT NULL,
  `log_time_of_sec` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_user` int(11) NOT NULL,
  `log_last_accessed` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_session_id` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `match_friends`
--

DROP TABLE IF EXISTS `match_friends`;
CREATE TABLE IF NOT EXISTS `match_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `friendId` int(11) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `match_log`
--

DROP TABLE IF EXISTS `match_log`;
CREATE TABLE IF NOT EXISTS `match_log` (
  `log_id` int(255) NOT NULL AUTO_INCREMENT,
  `log_entertime` datetime NOT NULL,
  `log_enter_ipaddress` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_result` int(11) NOT NULL DEFAULT 0,
  `log_valid_till` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_browser` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_time_of_sec` datetime NOT NULL,
  `log_user` int(11) NOT NULL,
  `log_last_accessed` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_session_id` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_removed` int(11) NOT NULL DEFAULT 0,
  `log_is_admin` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `match_log`
--

INSERT INTO `match_log` (`log_id`, `log_entertime`, `log_enter_ipaddress`, `log_result`, `log_valid_till`, `log_browser`, `log_time_of_sec`, `log_user`, `log_last_accessed`, `log_session_id`, `log_removed`, `log_is_admin`) VALUES
(1, '2021-05-31 00:56:20', '::1', 1, '1622753780', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36', '2021-05-31 00:56:39', 1, '1622393799', 'mdlm855rugiivdb1e16j3qgos7o7c8e6', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `match_reset`
--

DROP TABLE IF EXISTS `match_reset`;
CREATE TABLE IF NOT EXISTS `match_reset` (
  `resId` int(4) NOT NULL AUTO_INCREMENT,
  `resUserId` int(4) NOT NULL,
  `resUserEmail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resHashKey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resData` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resGenerated` datetime NOT NULL,
  `resType` int(1) NOT NULL DEFAULT 1 COMMENT '1-email verify,2-password reset',
  `resConfirmed` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`resId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `match_reset`
--

INSERT INTO `match_reset` (`resId`, `resUserId`, `resUserEmail`, `resHashKey`, `resData`, `resGenerated`, `resType`, `resConfirmed`) VALUES
(1, 1, 'testarov@exp.com', 'YorLhD8R2Q7TjgOc4As5WCP1Hab3tB', '', '2021-05-30 22:19:00', 1, 0),
(2, 2, 'test@exp.com', 'I349pwBN7sKeE6moHJducCbtYQgiqM', '', '2021-05-30 22:23:00', 1, 0),
(3, 3, 'test2@exp.com', 'UiYgsr8AIEj5hwN1zyd7V9Lu2XolSt', '', '2021-05-30 22:25:00', 1, 0),
(4, 4, 'test3@exp.com', 'RCLuafzx2o6bBeNQn7kFVqi1cDgZPJ', '', '2021-05-30 22:26:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `match_user`
--

DROP TABLE IF EXISTS `match_user`;
CREATE TABLE IF NOT EXISTS `match_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_fname` varchar(250) NOT NULL,
  `user_password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_dob` varchar(25) NOT NULL,
  `user_age` int(11) NOT NULL,
  `user_picture` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_designation` varchar(250) NOT NULL,
  `user_gender` varchar(15) NOT NULL,
  `user_country` varchar(50) NOT NULL,
  `user_fav_color` varchar(150) NOT NULL,
  `user_fav_actor` varchar(150) NOT NULL,
  `user_create_at` date NOT NULL DEFAULT current_timestamp(),
  `user_removed` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `match_user`
--

INSERT INTO `match_user` (`user_id`, `user_name`, `user_fname`, `user_password`, `user_email`, `user_dob`, `user_age`, `user_picture`, `user_designation`, `user_gender`, `user_country`, `user_fav_color`, `user_fav_actor`, `user_create_at`, `user_removed`) VALUES
(1, 'testarov@exp.com', 'aravindh', '$2y$10$We4B4/XhF2qH4I43B3nehOT5ID2wvDgU1.mVZ6sW3t3GI6NHk5Ovu', 'testarov@exp.com', '03/06/1997', 23, 'aravindh_da146e78b3.jpg', 'Developer', 'male', 'india', 'blue', 'vjs', '2021-05-30', 0),
(2, 'test@exp.com', 'test', '$2y$10$9D1TF.ShE9/GfbIv96tz0uDZx6foZYKPe/qZIMqwjuOrtRl6JtK8C', 'test@exp.com', '28/01/1997', 24, 'test_91afdc6703.jpg', 'test', 'male', 'India', 'blue', 'vj', '2021-05-30', 0),
(3, 'test2@exp.com', 'test again', '$2y$10$4fJfK2oDo/wczhkzsnWPs.UfCvZ52tUmnEGmsM0rZUi4X1OBNuqBO', 'test2@exp.com', '14/05/1996', 25, 'test_again_8e6df10c73.jpg', 'test', 'female', 'US', 'green', 'vjs', '2021-05-30', 0),
(4, 'test3@exp.com', 'tester', '$2y$10$VgvazIlWXcxQel.hg189NePlTiOIl0NtxrhGfz/otbZavGChzfuxu', 'test3@exp.com', '03/06/1997', 23, 'tester_07932e645d.jpg', 'testdes', 'male', 'India', 'vjs', 'green', '2021-05-30', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
