

/**
* Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
*Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>
*/


-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2014 at 09:22 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cupgame`
--

-- --------------------------------------------------------

--
-- Table structure for table `oe_experiments`
--

CREATE TABLE IF NOT EXISTS `oe_experiments` (
  `id` varchar(50) NOT NULL,
  `experimentname` varchar(100) NOT NULL,
  `nooftrials` varchar(100) NOT NULL,
  `experimentselect` varchar(50) NOT NULL,
  `confirmationcode` varchar(100) NOT NULL,
  `urllink` varchar(350) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oe_experiments`
--

INSERT INTO `oe_experiments` (`id`, `experimentname`, `nooftrials`, `experimentselect`, `confirmationcode`, `urllink`, `created_by`, `modified_by`, `date_modified`, `date_created`) VALUES
('ce256fe5-eb64-14f8-f1e7-c773cbb46c49', '5', '5', 'CupGameApp', '5', 'http://localhost/cupgame_try/demo.php?exp=ce256fe5-eb64-14f8-f1e7-c773cbb46c49&MID=MID', 'admin', 'admin', '2014-09-19 08:06:27', '2014-09-19 08:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `oe_participants`
--

CREATE TABLE IF NOT EXISTS `cups_expr_data` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `mid` varchar(60) NOT NULL,
  `experid` varchar(50) NOT NULL,  
  `cupsnumber` int(5) NOT NULL,
  `amountshown` varchar(5) NOT NULL,
  `paychoice` int(5) NOT NULL,
  `position` varchar(5) NOT NULL,
  `participantchoice` int(5) NOT NULL,
  `participantposition` varchar(5) NOT NULL,  
  `trialno` int(5) NOT NULL,
  `trial_pts` varchar(50) NOT NULL,
  `total_pts` varchar(50) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `time_taken` double NOT NULL,
  `cup_color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261 ;



-- --------------------------------------------------------

--
-- Table structure for table `oe_users`
--

CREATE TABLE IF NOT EXISTS `oe_users` (
  `id` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oe_users`
--

INSERT INTO `oe_users` (`id`, `user_name`, `password`, `user_role`, `created_by`, `modified_by`, `date_modified`, `date_created`) VALUES
('8885a6a0-e385-277a-a3d7-938213209e0a', 'admin', 'admin', 'Admin', 'admin', 'admin', '2014-09-12 13:49:48', '2014-09-12 13:49:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
