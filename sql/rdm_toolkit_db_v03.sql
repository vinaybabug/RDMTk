
-- Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
-- Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
--
-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>

DROP DATABASE `rdmtoolkit`;

--
-- Database: `rdmtoolkit`
--
CREATE SCHEMA IF NOT EXISTS `rdmtoolkit` ;
USE rdmtoolkit;
-- --------------------------------------------------------

--
-- Table structure for table `bart_expr_data`
--


CREATE TABLE IF NOT EXISTS `bart_expr_data` (  
  `mid` varchar(60) NOT NULL,
  `experid` varchar(50) NOT NULL,
  `trialstopindex` int(5) NOT NULL,
  `noofpumps` int(5) NOT NULL,
  `trial_pts` varchar(50) NOT NULL,
  `total_pts` varchar(50) NOT NULL,
  `trialno` int(5) NOT NULL,
  `tracktime` double NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mid`,`experid`,`trialno` )  
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `cups_expr_data`
--

CREATE TABLE IF NOT EXISTS `cups_expr_data` (
  
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
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `tracktime` double NOT NULL,
  `cup_color` varchar(50) NOT NULL,
  PRIMARY KEY (`mid`,`experid`,`trialno` )
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `delayd_expr_data`
--

CREATE TABLE IF NOT EXISTS `delayd_expr_data` (  
  
  `mid` varchar(60) NOT NULL,
  `experid` varchar(50) NOT NULL,
  `que_id` int(11) NOT NULL,
  `option_selected` varchar(30) NOT NULL,
  `trialno` int(11) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY (`mid`,`experid`,`trialno` )
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `delayed_discount_que`
--

CREATE TABLE IF NOT EXISTS `delayed_discount_que` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `option_b` varchar(100) NOT NULL,
  `option_a` varchar(100) NOT NULL,
  `dataset_name` varchar(100) NOT NULL DEFAULT 'DEFAULT',
  `created_by` varchar(200) NOT NULL DEFAULT 'ADMIN',
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delayed_discount_que`
--

INSERT INTO `delayed_discount_que` (`option_b`, `option_a`, `dataset_name`, `created_by`) VALUES
('$44 10 years', '$22 now', 'DEFAULT', 'ADMIN'),
('$10 with 50% chance', '$3.5 for sure', 'DEFAULT', 'ADMIN'),
('$10 in 3 Days', '$1 now', 'DEFAULT', 'ADMIN'),
('$10 in 365 days', '$4.5 now', 'DEFAULT', 'ADMIN'),
('$10 in 2 days', '$1 now', 'DEFAULT', 'ADMIN'),
('$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN'),
('$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN'),
('$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN'),
('$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN'),
('$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN'),
('$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN'),
('$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN'),
('$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN'),
('$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN'),
('$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN'),
('$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN'),
('$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN'),
('$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN'),
('$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN'),
('$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN'),
('$10 in 7 days', '$1 right now', 'DEFAULT', 'ADMIN'),
('$100 in 1 year', '$1 right now', 'DEFAULT', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `experconfirmation`
--

CREATE TABLE IF NOT EXISTS `experconfirmation` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `confirmation_type` varchar(150) NOT NULL,
  `confirmation_page_route` varchar(150) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experconfirmation`
--

INSERT INTO `experconfirmation` (`confirmation_type`, `confirmation_page_route`, `created_by`, `modified_by`) VALUES
('CUSTOM_TXT', '#', 'ADMIN', 'ADMIN'),
('DEFAULT', 'end.php', 'ADMIN', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `experiments`
--

CREATE TABLE IF NOT EXISTS `experiments` (
  `id` varchar(50) NOT NULL,
  `expername` varchar(150) NOT NULL,
  `expertype` varchar(100) NOT NULL,
  `nooftrials` int(10) NOT NULL,
  `expertrial_outcome_type` varchar(50) NOT NULL,
  `confirmationcode` varchar(100) DEFAULT NULL,
  `experend_conf_page_type` varchar(200) NOT NULL,
  `experend_conf_customtext` varchar(1000) DEFAULT NULL,
  `urllink` varchar(350) NOT NULL,
  `mouse_track` int(11) NOT NULL DEFAULT '0',
  `select_dataset` varchar(100) NOT NULL DEFAULT 'DEFAULT',
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `expr_design_type`
--

CREATE TABLE IF NOT EXISTS `expr_design_type` (
  `id` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,  
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `rdmtoolkit`.`expr_design_type`
(`id`,
`name`,
`created_by`
)
VALUES
('IND_MEAS_DSG',
'Independent Measures Design',
'ADMIN');


INSERT INTO `rdmtoolkit`.`expr_design_type`
(`id`,
`name`,
`created_by`
)
VALUES
('BTW_SUBJ_DSG',
'Between Subjects Design',
'ADMIN');

--
-- Table structure for table `expr_reln`
--

CREATE TABLE IF NOT EXISTS `expr_reln` (
  `id` int(50) DEFAULT NULL AUTO_INCREMENT,
  `expr_design_id` varchar(50) NOT NULL,
  `exprid1` varchar(50) NOT NULL, 
  `exprid2` varchar(50) NOT NULL,   
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`),
  foreign key (`expr_design_id`) references expr_design_type(id),
  foreign key (`exprid1`) references experiments(id),
  foreign key (`exprid2`) references experiments(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table `igt_expr_data`
--

CREATE TABLE IF NOT EXISTS `igt_expr_data` (  
  `mid` varchar(100) NOT NULL,
  `experid` char(36) NOT NULL,
  `trialno` int(100) NOT NULL,
  `initial_total` int(100) NOT NULL,
  `cash_A_win` int(100) NOT NULL,
  `cash_A_lose` int(100) NOT NULL,
  `cash_B_win` int(100) NOT NULL,
  `cash_B_lose` int(100) NOT NULL,
  `cash_C_win` int(100) NOT NULL,
  `cash_C_lose` int(100) NOT NULL,
  `cash_D_win` int(100) NOT NULL,
  `cash_D_lose` int(100) NOT NULL,
  `selected_card` varchar(50) NOT NULL,
  `final_total` int(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `tracktime` double NOT NULL,
  PRIMARY KEY (`mid`,`experid`,`trialno` )
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf16;


-- --------------------------------------------------------

--
-- Table structure for table `igt_score_cards`
--

CREATE TABLE IF NOT EXISTS `igt_score_cards` (
  `s.no` int(50) NOT NULL AUTO_INCREMENT,
  `card_A_win` int(100) NOT NULL,
  `card_A_lose` int(100) NOT NULL,
  `card_B_win` int(100) NOT NULL,
  `card_B_lose` int(100) NOT NULL,
  `card_C_win` int(100) NOT NULL,
  `card_C_lose` int(100) NOT NULL,
  `card_D_win` int(100) NOT NULL,
  `card_D_lose` int(100) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`s.no`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `igt_score_cards`
--

INSERT INTO `igt_score_cards` (`card_A_win`, `card_A_lose`, `card_B_win`, `card_B_lose`, `card_C_win`, `card_C_lose`, `card_D_win`, `card_D_lose`) VALUES
(130, -300, 160, 0, 80, -25, 60, 0),
(160, -350, 130, 0, 50, -50, 75, 0),
(120, -250, 150, 0, 90, -75, 60, 0),
(150, -350, 150, 0, 75, -25, 75, 0),
( 140, -200, 160, 0, 85, -25, 85, 0),
(160, -250, 140, 0, 65, -25, 70, 0),
(150, -250, 130, 0, 70, -25, 75, 0),
(130, -150, 150, 0, 80, -25, 85, 0),
(170, -250, 170, 0, 75, -25, 95, 0),
(160, -150, 130, 0, 65, -75, 55, 0),
(140, -300, 170, -2500, 85, -25, 65, -375),
(170, -350, 140, 0, 55, -50, 80, 0),
(130, -250, 160, 0, 95, -75, 65, 0),
(170, -350, 140, 0, 65, -25, 95, 0),
(130, -200, 140, 0, 95, -75, 65, -375),
(130, -250, 150, -2500, 65, -25, 75, 0),
(140, -150, 130, 0, 55, -25, 65, 0),
(150, -350, 160, 0, 70, -25, 80, 0),
(160, -300, 170, 0, 80, -25, 85, 0),
(160, -250, 170, 0, 75, -25, 80, 0),
(150, -150, 170, 0, 75, -25, 75, 0),
(170, -150, 150, 0, 55, -25, 55, 0),
(140, -300, 160, 0, 75, -25, 75, 0),
(130, -350, 140, 0, 70, -75, 55, 0),
(160, -250, 160, -2500, 85, -25, 65, -375),
(140, -350, 140, 0, 95, -25, 85, 0),
(150, -250, 130, 0, 85, -50, 65, 0),
(130, -250, 150, 0, 75, -50, 70, 0),
(140, -200, 160, 0, 85, -25, 85, 0),
(170, -250, 130, 0, 65, -75, 70, 0),
(160, -250, 130, 0, 80, -25, 75, 0),
(150, -150, 170, 0, 65, -25, 85, 0),
(170, -250, 150, 0, 85, -75, 95, 0),
(140, -300, 160, 0, 80, -25, 85, 0),
(170, -300, 150, 0, 75, -25, 65, 0),
(160, -150, 140, 0, 75, -75, 75, -375),
(130, -150, 130, 0, 55, -25, 95, 0),
(130, -200, 150, 0, 80, -25, 75, 0),
(130, -250, 130, 0, 65, -25, 65, 0),
(170, -250, 130, 0, 95, -25, 80, 0),
(160, -150, 160, -2500, 70, -75, 85, 0),
(150, -250, 150, 0, 75, -25, 95, 0),
(160, -350, 170, 0, 85, -75, 65, 0),
(140, -250, 140, 0, 85, -25, 70, 0),
(150, -250, 140, 0, 65, -50, 85, 0),
(130, -250, 150, 0, 55, -75, 85, -375),
(170, -350, 170, -2500, 95, -25, 75, 0),
(140, -200, 130, 0, 65, -25, 65, 0),
(150, -250, 170, 0, 85, -25, 75, 0),
(160, -350, 140, 0, 65, -25, 55, 0),
(170, -250, 160, 0, 75, -25, 70, 0),
(140, -350, 160, 0, 70, -25, 55, 0),
(150, -150, 170, 0, 85, -50, 80, 0),
(170, -350, 140, 0, 65, -25, 95, 0),
(130, -200, 140, 0, 95, -75, 65, -375),
(130, -250, 150, -2500, 65, -25, 75, 0),
(140, -150, 130, 0, 55, -25, 65, 0),
(150, -350, 160, 0, 70, -25, 80, 0),
(160, -300, 170, 0, 80, -25, 85, 0),
(160, -250, 170, 0, 75, -25, 80, 0),
(150, -150, 170, 0, 75, -25, 75, 0),
(170, -150, 150, 0, 55, -25, 55, 0),
(140, -300, 160, 0, 75, -25, 75, 0),
(130, -350, 140, 0, 70, -75, 55, 0),
(160, -250, 160, -2500, 85, -25, 65, -375),
(140, -350, 140, 0, 95, -25, 85, 0),
(150, -250, 130, 0, 85, -50, 65, 0),
(130, -250, 150, 0, 75, -50, 70, 0),
(140, -200, 160, 0, 85, -25, 85, 0),
(170, -250, 130, 0, 65, -75, 70, 0),
(160, -250, 130, 0, 80, -25, 75, 0),
(150, -150, 170, 0, 65, -25, 85, 0),
(170, -250, 150, 0, 85, -75, 95, 0),
(140, -300, 160, 0, 80, -25, 85, 0),
(170, -300, 150, 0, 75, -25, 65, 0),
(160, -150, 140, 0, 75, -75, 75, -375),
(130, -150, 130, 0, 55, -25, 95, 0),
(130, -200, 150, 0, 80, -25, 75, 0),
(130, -250, 130, 0, 65, -25, 65, 0),
(170, -250, 130, 0, 95, -25, 80, 0),
(160, -150, 160, -2500, 70, -75, 85, 0),
(150, -250, 150, 0, 75, -25, 95, 0),
(160, -350, 170, 0, 85, -75, 65, 0),
(140, -250, 140, 0, 85, -25, 70, 0),
(150, -250, 140, 0, 65, -50, 85, 0),
(130, -250, 150, 0, 55, -75, 85, -375),
(170, -350, 170, -2500, 95, -25, 75, 0),
(140, -200, 130, 0, 65, -25, 65, 0),
(150, -250, 170, 0, 85, -25, 75, 0),
(160, -350, 140, 0, 65, -25, 55, 0),
(170, -250, 160, 0, 75, -25, 70, 0),
(140, -350, 160, 0, 70, -25, 55, 0),
(150, -150, 170, 0, 85, -50, 80, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mouse_offset_coords`
--

CREATE TABLE IF NOT EXISTS `mouse_offset_coords` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `exptype` varchar(100) NOT NULL,
  `coords` text NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `mouse_track`
--

CREATE TABLE IF NOT EXISTS `mouse_track` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `expid` varchar(1000) NOT NULL,
  `expertype` varchar(100) NOT NULL,
  `mid` varchar(1000) NOT NULL,
  `x_coord` int(11) NOT NULL,
  `y_coord` int(11) NOT NULL,
  `time_spent` int(11) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nback_expr_data`
--

CREATE TABLE IF NOT EXISTS `nback_expr_data` (  
  `mid` varchar(100) NOT NULL,
  `experid` char(36) NOT NULL,
  `trialno` int(100) NOT NULL,
  `stimuli` char(1) NOT NULL,
  `corres` int(100) NOT NULL,
  `response` int(100) NOT NULL,
  `score` int(200) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `exp_flag` varchar(50) NOT NULL,
  PRIMARY KEY (`mid`,`experid`,`trialno` )
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf16;



-- --------------------------------------------------------

--
-- Table structure for table `nback_score_practice`
--

CREATE TABLE IF NOT EXISTS `nback_score_practice` (
  `s.no` int(50) DEFAULT NULL AUTO_INCREMENT,
  `score_values` char(1) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`s.no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nback_score_practice`
--

INSERT INTO `nback_score_practice` (`score_values`) VALUES
('a'),
('m'),
('e'),
('m'),
('y'),
('p'),
('v'),
('w'),
('v'),
('t'),
('r'),
('t'),
('o'),
('d'),
('b'),
('d'),
('o'),
('c'),
('o'),
('u'),
('o');

-- --------------------------------------------------------

--
-- Table structure for table `nback_score_values`
--

CREATE TABLE IF NOT EXISTS `nback_score_values` (
  `s.no` int(50) NOT NULL AUTO_INCREMENT,
  `char_value` char(1) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`s.no`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nback_score_values`
--

INSERT INTO `nback_score_values` (`char_value`) VALUES
('a'),
('y'),
('s'),
('f'),
('k'),
('f'),
('p'),
('w'),
('o'),
('e'),
('o'),
('r'),
('n'),
('v'),
('x'),
('a'),
('x'),
('c'),
('k'),
('p'),
('q'),
('p'),
('f'),
('a'),
('y'),
('h'),
('y'),
('r'),
('e'),
('u'),
('m'),
('a'),
('i'),
('f'),
('e'),
('f'),
('j'),
('a'),
('r'),
('e'),
('r'),
('k'),
('y'),
('e'),
('a'),
('c'),
('q'),
('n'),
('q'),
('f'),
('c'),
('a'),
('k'),
('d'),
('k'),
('j'),
('v'),
('s'),
('a'),
('e'),
('a'),
('e'),
('d'),
('y'),
('b'),
('m'),
('w'),
('p'),
('w'),
('m'),
('x'),
('o'),
('g'),
('h'),
('g'),
('r'),
('s'),
('f'),
('y'),
('f'),
('o'),
('j'),
('m'),
('n'),
('f'),
('t'),
('b'),
('t'),
('d'),
('f'),
('g'),
('h'),
('g'),
('k'),
('t'),
('i');
-- --------------------------------------------------------

--
-- Table structure for table `rdm_user`
--

CREATE TABLE IF NOT EXISTS `rdm_user` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `role` varchar(500) NOT NULL DEFAULT 'END_USER',
  `email` varchar(300) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
-- Sample update to get admin account setup
-- update  rdm_user set username = 'admin', role = 'ADMIN' where first_name = 'Admin';
-- --------------------------------------------------------

--
-- Table structure for table `rdm_user`
--

CREATE TABLE IF NOT EXISTS `aws_rdmtk_config` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,  
  `username` varchar(100) NOT NULL,
  `aws_instanceid` varchar(200) NOT NULL,  
  `aws_key` varchar(500) NOT NULL,
  `aws_secret` varchar(500) NOT NULL,
  `aws_region` varchar(500) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stroop_expr_data`
--

CREATE TABLE IF NOT EXISTS `stroop_expr_data` (
  
  `mid` varchar(100) NOT NULL,
  `experid` char(36) NOT NULL,
  `trialno` int(100) NOT NULL,
  `word` varchar(50) NOT NULL,
  `corres` varchar(100) NOT NULL,
  `response` varchar(100) NOT NULL,
  `score` int(200) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `exp_flag` varchar(50) NOT NULL,
  `tracktime` double NOT NULL,
  PRIMARY KEY (`mid`,`experid`,`trialno` )
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` varchar(50) NOT NULL,
  `taskname` varchar(150) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
 `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- data for table `tasks`
--

INSERT INTO `tasks` (`id`, `taskname`, `created_by`, `modified_by`) VALUES
('BART', 'Balloon Task', 'ADMIN', 'ADMIN'),
('CUPS', 'Cups Task', 'ADMIN', 'ADMIN'),
('DelayD', 'Delayed Discounting Task', 'ADMIN', 'ADMIN'),
('IGT', 'Iowa Gambling Task', 'ADMIN', 'ADMIN'),
('NBACK', 'N Back', 'ADMIN', 'ADMIN'),
('STROOP', 'Stroop', 'ADMIN', 'ADMIN');

--
-- Table structure for table storing analysis model`results
--
-- anlys_mdl : Analysis Models are
-- FOR IGT: BASE_MDL, RND_MDL, EVL_MDL

CREATE TABLE IF NOT EXISTS `expr_anlys_data` (
  `experid` char(36) NOT NULL, 
  `expertype` varchar(100) NOT NULL,
  `anlys_mdl` char(36) NOT NULL,   
  `anlys_rslt` mediumblob default NULL,   
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`experid`,`expertype`,`anlys_mdl` )
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Table structure for table submitting analysis model`for execution by AWS
--
-- anlys_mdl : Analysis Models are
-- FOR IGT: BASE_MDL, RND_MDL, EVL_MDL

CREATE TABLE IF NOT EXISTS `expr_anlys_job` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `experid` char(36) NOT NULL, 
  `expertype` varchar(100) NOT NULL,
  `anlys_mdl` char(36) NOT NULL,   
  `doExec` TINYINT default 0,   
  `owner` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

