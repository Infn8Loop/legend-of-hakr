-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 25, 2018 at 10:20 AM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hakr`
--

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enemy_info` text NOT NULL,
  `player_id` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `turn` int(11) NOT NULL,
  `opponent` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `dollars` int(11) NOT NULL,
  `coins` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2669 ;

-- --------------------------------------------------------

--
-- Table structure for table `Market`
--

CREATE TABLE IF NOT EXISTS `Market` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL DEFAULT '50000',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(24) NOT NULL,
  `system_yn` tinyint(1) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

-- --------------------------------------------------------

--
-- Table structure for table `Players`
--

CREATE TABLE IF NOT EXISTS `Players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hp` float NOT NULL DEFAULT '100',
  `max_hp` float NOT NULL DEFAULT '100',
  `xp` float DEFAULT '100',
  `power` float NOT NULL DEFAULT '50',
  `karma` int(11) NOT NULL DEFAULT '0',
  `dollars` float NOT NULL DEFAULT '200',
  `coins` float NOT NULL DEFAULT '0',
  `shares` int(11) NOT NULL DEFAULT '1',
  `level` int(11) NOT NULL DEFAULT '1',
  `dead_stamp` datetime DEFAULT NULL,
  `pvp_death` tinyint(1) DEFAULT '0',
  `event_id` int(11) NOT NULL,
  `next_level` float NOT NULL DEFAULT '300',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
