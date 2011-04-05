-- phpMyAdmin SQL Dump
-- version 3.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2010 at 08:22 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.4-2ubuntu5.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lf_ppma`
--

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

DROP TABLE IF EXISTS `milestones`;
CREATE TABLE IF NOT EXISTS `milestones` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) collate utf8_bin NOT NULL,
  `description` varchar(10000) collate utf8_bin NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `milestones`
--


-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_bin NOT NULL,
  `description` varchar(10000) collate utf8_bin NOT NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  `status` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `start_date`, `end_date`, `status`) VALUES
(1, 'testProject', 'this is a test', '2010-11-02', '2010-11-30', 4);

-- --------------------------------------------------------

--
-- Table structure for table `projects2milestones`
--

DROP TABLE IF EXISTS `projects2milestones`;
CREATE TABLE IF NOT EXISTS `projects2milestones` (
  `pid` int(11) unsigned NOT NULL,
  `mid` int(11) NOT NULL,
  KEY `pid` (`pid`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `projects2milestones`
--


-- --------------------------------------------------------

--
-- Table structure for table `projects2roles`
--

DROP TABLE IF EXISTS `projects2roles`;
CREATE TABLE IF NOT EXISTS `projects2roles` (
  `pid` int(11) unsigned NOT NULL,
  `rid` int(11) unsigned NOT NULL,
  KEY `pid` (`pid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `projects2roles`
--


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(20) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(100) collate utf8_bin NOT NULL,
  `description` varchar(1000) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `description`) VALUES
(1, 'Strategic', 'Strategisch'),
(2, 'Sponsored', 'I need Money'),
(3, 'Accepted', 'Angenommen!'),
(4, 'Requested', 'Anfrage fuer ein Project'),
(5, 'Denied', 'Abgelehnt!');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `firstname` varchar(100) collate utf8_bin NOT NULL,
  `name` varchar(30) collate utf8_bin NOT NULL,
  `password` varchar(32) collate utf8_bin NOT NULL,
  `email` varchar(30) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `name`, `password`, `email`) VALUES
(2, 'Hans', 'Peter', 'f2a0ffe83ec8d44f2be4b624b0f47dde', 'resterle@lichtflut.de'),
(3, 'Peter', 'Mueller', '51dc30ddc473d43a6011e9ebba6ca770', 'rknox@lichtflut.de');

-- --------------------------------------------------------

--
-- Table structure for table `user2roles`
--

DROP TABLE IF EXISTS `user2roles`;
CREATE TABLE IF NOT EXISTS `user2roles` (
  `uid` int(11) unsigned NOT NULL,
  `rid` int(11) unsigned NOT NULL,
  KEY `uid` (`uid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user2roles`
--

INSERT INTO `user2roles` (`uid`, `rid`) VALUES
(2, 1),
(2, 2),
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `votings`
--

DROP TABLE IF EXISTS `votings`;
CREATE TABLE IF NOT EXISTS `votings` (
  `pid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  KEY `pid` (`pid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `votings`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`status`) REFERENCES `statuses` (`id`);

--
-- Constraints for table `projects2milestones`
--
ALTER TABLE `projects2milestones`
  ADD CONSTRAINT `projects2milestones_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `milestones` (`id`),
  ADD CONSTRAINT `projects2milestones_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `projects` (`id`);

--
-- Constraints for table `projects2roles`
--
ALTER TABLE `projects2roles`
  ADD CONSTRAINT `projects2roles_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `projects2roles_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `projects` (`id`);

--
-- Constraints for table `user2roles`
--
ALTER TABLE `user2roles`
  ADD CONSTRAINT `user2roles_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user2roles_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);

--
-- Constraints for table `votings`
--
ALTER TABLE `votings`
  ADD CONSTRAINT `votings_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `votings_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `projects` (`id`);
