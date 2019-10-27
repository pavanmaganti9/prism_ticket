-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2019 at 08:02 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `desc` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `title`, `logo`, `desc`, `created`) VALUES
(4, 'Google', '1572199917_google_logo.png', 'Search Engine', '2019-10-27 19:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `desc`) VALUES
(4, 'Python Tutorial', 'Python is an interpreted, high-level, general-purpose programming language. Created by Guido van Rossum and first released in 1991, Python''s design philosophy emphasizes code readability with its notable use of significant whitespace.'),
(5, 'PHP', 'Hypertext Preprocessor is a general-purpose programming language originally designed for web development. It was originally created by Rasmus Lerdorf in 1994; the PHP reference implementation is now produced by The PHP Group.');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `desc` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `desc`, `created`) VALUES
(1, 'Python Tutorial123', 'qweqweqwe12345', '2019-10-26 06:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `userfileuploads`
--

CREATE TABLE IF NOT EXISTS `userfileuploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `userfileuploads`
--

INSERT INTO `userfileuploads` (`id`, `filename`, `user_email`, `user_id`, `created`) VALUES
(1, '1572198681_1.jpg', 'pavanmaganti9@gmail.com', '1', '2019-10-27 18:51:21'),
(2, '1572198744_google_logo.png', 'bindu@gmail.com', '2', '2019-10-27 18:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive',
  `user_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `phone`, `created`, `modified`, `status`, `user_type`, `company`) VALUES
(1, 'Pavan', 'Maganti', 'pavanmaganti9@gmail.com', 'cd84d683cc5612c69efe115c80d0b7dc', 'Male', '8099049823', '2019-10-14 20:42:08', '2019-10-14 20:42:08', 1, 'superadmin', ''),
(2, 'Bindu', 'Maganti', 'bindu@gmail.com', 'cd84d683cc5612c69efe115c80d0b7dc', 'Female', '9849105202', '2019-10-15 20:42:23', '2019-10-15 20:42:23', 1, 'user', ''),
(3, 'oiuiu', 'oiuoiu', 'oiuoiu@g.com', 'cd84d683cc5612c69efe115c80d0b7dc', 'Male', '2345678', '2019-10-17 21:40:45', '2019-10-17 21:40:45', 1, 'user', ''),
(4, 'laksjd', 'lkjasd', 'lkj@g.com', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'Female', '98127987123', '2019-10-17 21:42:29', '2019-10-17 21:42:29', 1, 'user', ''),
(8, 'Pavan', 'Maganti', 'pavanmaganti87@gmail.com', 'cd84d683cc5612c69efe115c80d0b7dc', 'Male', '1234567890', '2019-10-27 19:31:30', '2019-10-27 19:31:30', 1, 'user', 'Google'),
(9, 'Pavanqw', 'asd', 'pavanmaganti9@gasdmail.com', 'cd84d683cc5612c69efe115c80d0b7dc', 'Female', '8099049823', '2019-10-27 19:38:23', '2019-10-27 19:38:23', 1, 'user', 'Google');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
