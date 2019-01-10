-- MySQL dump 10.11
--
-- Host: localhost    Database: carpool
-- ------------------------------------------------------
-- Server version	5.0.45-Debian_1ubuntu3.4-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `resets`
--

DROP TABLE IF EXISTS `resets`;
CREATE TABLE `resets` (
  `user_id` mediumint(11) unsigned NOT NULL auto_increment,
  `code` char(24) character set utf8 NOT NULL default '',
  `expiration` varchar(20) character set utf8 NOT NULL default '',
  `attempts` tinyint(1) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `user_id` mediumint(9) NOT NULL,
  `token` char(128) character set utf8 NOT NULL default '',
  `expiration` varchar(20) character set utf8 NOT NULL default '',
  `lastused` varchar(20) character set utf8 NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE `trips` (
  `id` mediumint(9) NOT NULL auto_increment,
  `userid` mediumint(11) NOT NULL,
  `date` varchar(8) character set utf8 NOT NULL default '',
  `time` varchar(5) character set utf8 NOT NULL default '',
  `startingLatitude` varchar(10) character set utf8 NOT NULL default '',
  `startingLongitude` varchar(11) character set utf8 NOT NULL default '',
  `startingAddress` varchar(100) character set utf8 NOT NULL default '',
  `endingLatitude` varchar(10) character set utf8 NOT NULL default '',
  `endingLongitude` varchar(11) character set utf8 NOT NULL default '',
  `endingAddress` varchar(100) character set utf8 NOT NULL default '',
  `distance` varchar(11) character set utf8 NOT NULL,
  `maxPassengers` int(11) default NULL,
  `passenger` varchar(256) character set utf8 default NULL,
  `driver` varchar(256) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Table structure for table `trips_test`
--

DROP TABLE IF EXISTS `trips_test`;
CREATE TABLE `trips_test` (
  `id` mediumint(9) NOT NULL auto_increment,
  `userid` mediumint(11) NOT NULL,
  `date` varchar(8) character set utf8 NOT NULL default '',
  `time` varchar(5) character set utf8 NOT NULL default '',
  `startingLatitude` varchar(10) character set utf8 NOT NULL default '',
  `startingLongitude` varchar(11) character set utf8 NOT NULL default '',
  `startingAddress` varchar(100) character set utf8 NOT NULL default '',
  `endingLatitude` varchar(10) character set utf8 NOT NULL default '',
  `endingLongitude` varchar(11) character set utf8 NOT NULL default '',
  `endingAddress` varchar(100) character set utf8 NOT NULL default '',
  `maxPassengers` int(11) default NULL,
  `passenger` varchar(256) character set utf8 default NULL,
  `driver` varchar(256) character set utf8 default NULL,
  `distance` varchar(11) character set utf8 NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20001 DEFAULT CHARSET=latin1;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(100) character set utf8 NOT NULL,
  `birthday` varchar(10) character set utf8 NOT NULL,
  `username` varchar(20) character set utf8 NOT NULL,
  `password` varchar(32) character set utf8 NOT NULL default '',
  `email` varchar(254) character set utf8 NOT NULL default '',
  `verified` varchar(1) character set utf8 NOT NULL default '',
  `verificationCode` varchar(10) character set utf8 NOT NULL default '',
  `verificationAttempts` tinyint(1) NOT NULL,
  `rating` int(1) NOT NULL default '0',
  `driverCount` mediumint(4) NOT NULL default '0',
  `passengerCount` mediumint(4) NOT NULL default '0',
  `status` varchar(10) character set utf8 NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Table structure for table `users_test`
--

DROP TABLE IF EXISTS `users_test`;
CREATE TABLE `users_test` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(100) character set utf8 NOT NULL,
  `birthday` varchar(10) character set utf8 NOT NULL,
  `username` varchar(20) character set utf8 NOT NULL,
  `password` varchar(32) character set utf8 NOT NULL default '',
  `email` varchar(254) character set utf8 NOT NULL default '',
  `verified` varchar(1) character set utf8 NOT NULL default '',
  `verificationCode` varchar(10) character set utf8 NOT NULL default '',
  `verificationAttempts` tinyint(1) NOT NULL,
  `rating` int(1) NOT NULL default '0',
  `driverCount` mediumint(4) NOT NULL default '0',
  `passengerCount` mediumint(4) NOT NULL default '0',
  `status` varchar(10) character set utf8 NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-03 22:23:51
