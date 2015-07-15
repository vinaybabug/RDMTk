#refresh db to make clean slate

CREATE SCHEMA IF NOT EXISTS `rdmtoolkit` ;
USE rdmtoolkit;

DROP TABLE IF EXISTS `rdm_user`;
DROP TABLE IF EXISTS `experiments`;
DROP TABLE IF EXISTS `experconfirmation`;
DROP TABLE IF EXISTS `tasks`;

DROP TABLE IF EXISTS `bart_expr_data`;

DROP TABLE IF EXISTS `cups_expr_data`;

DROP TABLE IF EXISTS `igt_score_cards`;
DROP TABLE IF EXISTS `igt_expr_data`;

DROP TABLE IF EXISTS `stroop_expr_data`;

DROP TABLE IF EXISTS `nback_expr_data`;
DROP TABLE IF EXISTS `nback_score_practice`;
DROP TABLE IF EXISTS `nback_score_values`;
DROP TABLE IF EXISTS `delayed_discount_que`;

# RDM_USER Table to keep track of users ROLE can be  
# admin - ADMIN
# researcher - RDM_RESEARCHER
# participants - END_USER
CREATE TABLE IF NOT EXISTS `rdm_user` (
  `id` int(10) unsigned NOT NULL  AUTO_INCREMENT,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `role` varchar(500) NOT NULL DEFAULT 'END_USER',
  `email` varchar(300) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `remember_token` varchar(100),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


# RDM_USER Table to keep track of users ROLE can be  
# expertype - column will store game name or task name BART, CUPS, IGT, STROOP and NBACK
# nooftrials - maximum number of trials in the game
# expertrial_outcome_type - trial outcome can be FIXED or RANDOM
# confirmationcode - confirmation code if needed, fixed per experiment
# experend_conf_page_type - this can be unique code to identify a page 
# e.g. CONFIRMATION_01 - its for mturk with a confirmation code. Corresponding page 
# is configured in exper_confim_page_config table
# 	   CUSTOM_TXT - Custom text stored in experend_conf_customtext column
# url - url to the experiment with mid url parameter


CREATE TABLE IF NOT EXISTS `experiments` (
  `id` varchar(50) NOT NULL,
  `expername` varchar(150) NOT NULL,
  `expertype` varchar(100) NOT NULL,  
  `nooftrials` int(10) NOT NULL,
  `expertrial_outcome_type` varchar(50) NOT NULL,  
  `confirmationcode` varchar(100),
  `experend_conf_page_type` varchar(200) NOT NULL,  
  `experend_conf_customtext` varchar(1000),
  `urllink` varchar(350) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,  
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00', 
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# table to keep track of tasks 
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` varchar(50) NOT NULL,
  `taskname` varchar(150) NOT NULL, 
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,  
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00', 
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table bart task
--

CREATE TABLE IF NOT EXISTS `bart_expr_data` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
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
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `experid` (`experid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=231 ;

-- ----------------------------------------------------------

--
-- Table structure for table cups task
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
  `tracktime` double NOT NULL,
  `cup_color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261 ;

# table to keep track of experiment confirmation page url 
CREATE TABLE IF NOT EXISTS `experconfirmation` (
  `id` int(10) unsigned NOT NULL  AUTO_INCREMENT,
  `confirmation_type` varchar(150) NOT NULL, 
  `confirmation_page_route` varchar(150) NOT NULL, 
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(60) NOT NULL,  
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00', 
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table cups task
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
  PRIMARY KEY (`s.no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=144 ;

CREATE TABLE IF NOT EXISTS `igt_expr_data` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `tracktime` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;


-- --------------------------------------------------------

--
-- Table structure for table `stroop_expr_data`
--

CREATE TABLE IF NOT EXISTS `stroop_expr_data` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `mid` varchar(100) NOT NULL,
  `experid` char(36) NOT NULL,  
  `trialno` int(100) NOT NULL,
  `word` varchar(50) NOT NULL,
  `corres` varchar(100) NOT NULL,
  `response` varchar(100) NOT NULL,
  `score` int(200) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `exp_flag` varchar(50) NOT NULL,
  `tracktime` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
-- --------------------------------------------------------

--
-- Table structure for table `nback_expr_data`
--
CREATE TABLE IF NOT EXISTS `nback_expr_data` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `mid` varchar(100) NOT NULL,
  `experid` char(36) NOT NULL,  
  `trialno` int(100) NOT NULL,
  `stimuli` char(1) NOT NULL,
  `corres` int(100) NOT NULL,
  `response` int(100) NOT NULL,
  `score` int(200) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `exp_flag` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Table structure for table `nback_score_practice`
--

CREATE TABLE IF NOT EXISTS `nback_score_practice` (
  `s.no` int(11) DEFAULT NULL,
  `score_values` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `nback_score_values`
--

CREATE TABLE IF NOT EXISTS `nback_score_values` (
  `s.no` int(11) NOT NULL AUTO_INCREMENT,
  `char_value` char(1) NOT NULL,
  PRIMARY KEY (`s.no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `nback_score_practice`
--

INSERT INTO `nback_score_practice` (`s.no`, `score_values`) VALUES
(1, 'a'),
(2, 'm'),
(3, 'e'),
(4, 'm'),
(5, 'y'),
(6, 'p'),
(7, 'v'),
(8, 'w'),
(9, 'v'),
(10, 't'),
(11, 'r'),
(12, 't'),
(13, 'o'),
(14, 'd'),
(15, 'b'),
(16, 'd'),
(17, 'o'),
(18, 'c'),
(19, 'o'),
(20, 'u'),
(21, 'o');

--
-- Dumping data for table `nback_score_values`
--

INSERT INTO `nback_score_values` (`s.no`, `char_value`) VALUES
(1, 'a'),
(2, 'y'),
(3, 's'),
(4, 'f'),
(5, 'k'),
(6, 'f'),
(7, 'p'),
(8, 'w'),
(9, 'o'),
(10, 'e'),
(11, 'o'),
(12, 'r'),
(13, 'n'),
(14, 'v'),
(15, 'x'),
(16, 'a'),
(17, 'x'),
(18, 'c'),
(19, 'k'),
(20, 'p'),
(21, 'q'),
(22, 'p'),
(23, 'f'),
(24, 'a'),
(25, 'y'),
(26, 'h'),
(27, 'y'),
(28, 'r'),
(29, 'e'),
(30, 'u'),
(31, 'm'),
(32, 'a'),
(33, 'i'),
(34, 'f'),
(35, 'e'),
(36, 'f'),
(37, 'j'),
(38, 'a'),
(39, 'r'),
(40, 'e'),
(41, 'r'),
(42, 'k'),
(43, 'y'),
(44, 'e'),
(45, 'a'),
(46, 'c'),
(47, 'q'),
(48, 'n'),
(49, 'q'),
(50, 'f'),
(51, 'c'),
(52, 'a'),
(53, 'k'),
(54, 'd'),
(55, 'k'),
(56, 'j'),
(57, 'v'),
(58, 's'),
(59, 'a'),
(60, 'e'),
(61, 'a'),
(62, 'e'),
(63, 'd'),
(64, 'y'),
(65, 'b'),
(66, 'm'),
(67, 'w'),
(68, 'p'),
(69, 'w'),
(70, 'm'),
(71, 'x'),
(72, 'o'),
(73, 'g'),
(74, 'h'),
(75, 'g'),
(76, 'r'),
(77, 's'),
(78, 'f'),
(79, 'y'),
(80, 'f'),
(81, 'o'),
(82, 'j'),
(83, 'm'),
(84, 'n'),
(85, 'f'),
(86, 't'),
(87, 'b'),
(88, 't'),
(89, 'd'),
(90, 'f'),
(91, 'g'),
(92, 'h'),
(93, 'g'),
(94, 'k'),
(95, 't'),
(96, 'i');

CREATE TABLE IF NOT EXISTS `delayed_discount_que` (
  `id` int(11) NOT NULL,
  `option_b` varchar(100) NOT NULL,
  `option_a` varchar(100) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delayed_discount_que`
--

INSERT INTO `delayed_discount_que` (`id`, `option_b`, `option_a`) VALUES
(1, '$10 in 365 days', '$1.5 Now'),
(2, '$7.5 in 10 days', '$1 now'),
(3, '$10 with 50% chance', '$3.5 for sure'),
(4, '$10 with 100% chance', '$7.5 for sure'),
(5, '$10 with 90% chance', '$0.5 for sure'),
(6, '$10 in 2 days', '$1 now'),
(7, '$10 in 365 days', '$4.5 now'),
(8, '$10 in 2 days', '$1 now'),
(9, '$10 with 90% chance', '$0.5 for sure'),
(10, '$10 in 180 days', '$1.5 now'),
(11, '$10 in 30 days', '$2 now'),
(12, '$10 with 90% chance', '$0.5 for sure'),
(13, '$10 in 180 days', '$1.5 now'),
(14, '$10 in 30 days', '$2 now'),
(15, '$10 with 90% chance', '$0.5 for sure'),
(16, '$10 in 180 days', '$1.5 now'),
(17, '$10 in 30 days', '$2 now'),
(18, '$10 with 90% chance', '$0.5 for sure'),
(19, '$10 in 180 days', '$1.5 now'),
(20, '$10 in 30 days', '$2 now');


# Insert VALUES
INSERT INTO `tasks`
(`id`,
`taskname`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
('BART',
'Balloon Task',
'ADMIN',
'ADMIN',
now(),
now());


INSERT INTO `tasks`
(`id`,
`taskname`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
('CUPS',
'Cups Task',
'ADMIN',
'ADMIN',
now(),
now());


INSERT INTO `tasks`
(`id`,
`taskname`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
('IGT',
'Iowa Gambling Task',
'ADMIN',
'ADMIN',
now(),
now());

INSERT INTO `tasks`
(`id`,
`taskname`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
('STROOP',
'Stroop',
'ADMIN',
'ADMIN',
now(),
now());

INSERT INTO `tasks`
(`id`,
`taskname`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
('NBACK',
'N Back',
'ADMIN',
'ADMIN',
now(),
now());

INSERT INTO `tasks`
(`id`,
`taskname`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
('DelayD',
'Delayed Discounting Task',
'ADMIN',
'ADMIN',
now(),
now());

INSERT INTO `experconfirmation`
(`confirmation_type`,
`confirmation_page_route`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
(
'CUSTOM_TXT',
'#',
'ADMIN',
'ADMIN',
now(),
now());


INSERT INTO `experconfirmation`
(`confirmation_type`,
`confirmation_page_route`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
(
'DEFAULT',
'end.php',
'ADMIN',
'ADMIN',
now(),
now());


--
-- Data for table `igt_score_cards`
--

INSERT INTO `igt_score_cards` (`s.no`, `card_A_win`, `card_A_lose`, `card_B_win`, `card_B_lose`, `card_C_win`, `card_C_lose`, `card_D_win`, `card_D_lose`) VALUES
(1, 80, -350, 100, -1250, 60, -25, 60, -250),
(2, 90, 0, 80, 0, 50, 0, 55, 0),
(3, 100, -250, 110, 0, 60, 0, 45, 0),
(4, 80, -350, 100, -1250, 60, -25, 60, -250),
(5, 90, 0, 80, 0, 50, 0, 55, 0),
(6, 100, -250, 110, 0, 60, 0, 45, 0),
(7, 120, 0, 120, 0, 45, -25, 55, 0),
(8, 100, -300, 90, 0, 50, -50, 60, 0),
(9, 110, 0, 100, 0, 45, 0, 60, 0),
(10, 80, -200, 90, 0, 55, -50, 40, 0),
(11, 120, 0, 120, 0, 45, 0, 45, 0),
(12, 110, 0, 110, 0, 50, -50, 50, 0),
(13, 90, -150, 80, 0, 40, -50, 40, 0),
(14, 110, -350, 110, -1500, 70, 0, 55, 0),
(15, 130, 0, 100, 0, 55, -25, 60, -275),
(16, 90, -300, 90, 0, 65, -75, 40, 0),
(17, 100, 0, 130, 0, 45, 0, 40, 0),
(18, 120, -200, 120, 0, 55, -25, 45, 0),
(19, 110, 0, 130, 0, 40, 0, 55, 0),
(20, 90, -250, 110, 0, 70, -25, 65, 0),
(21, 130, -150, 90, 0, 60, -75, 70, 0),
(22, 120, -250, 100, 0, 50, 0, 50, 0),
(23, 100, 0, 120, 0, 40, -50, 70, 0),
(24, 120, -250, 120, 0, 60, 0, 60, 0),
(25, 140, -300, 110, -1750, 65, -25, 55, 0),
(26, 110, 0, 140, 0, 55, 0, 65, 0),
(27, 110, -350, 130, 0, 80, -50, 80, 0),
(28, 100, 0, 100, 0, 40, -25, 40, 0),
(29, 120, -200, 110, 0, 60, -50, 80, 0),
(30, 130, -250, 120, 0, 55, 0, 40, 0),
(31, 110, -150, 120, 0, 65, -25, 65, 0),
(32, 140, -250, 140, 0, 40, -75, 55, -300),
(33, 120, 0, 110, 0, 80, -50, 60, 0),
(34, 130, -350, 130, 0, 65, -25, 65, 0),
(35, 120, -200, 140, 0, 75, 0, 75, 0),
(36, 140, -250, 120, -2000, 55, -25, 60, 0),
(37, 130, -250, 110, 0, 60, -25, 65, 0),
(38, 110, -150, 130, 0, 70, -25, 75, -325),
(39, 150, 0, 150, 0, 65, 0, 85, 0),
(40, 140, -150, 110, 0, 55, -75, 45, 0),
(41, 120, -300, 150, 0, 75, -25, 55, 0),
(42, 150, -350, 120, 0, 45, -50, 70, 0),
(43, 110, 0, 140, 0, 85, -75, 55, 0),
(44, 140, -350, 140, 0, 70, -25, 70, 0),
(45, 130, -200, 150, 0, 80, 0, 80, 0),
(46, 150, -250, 130, 0, 60, -25, 65, 0),
(47, 140, -250, 120, 0, 65, -25, 70, 0),
(48, 120, -150, 140, 0, 75, -25, 80, -350),
(49, 160, 0, 160, -2250, 70, -25, 90, 0),
(50, 150, -150, 120, 0, 60, -75, 50, 0),
(51, 130, -300, 160, 0, 80, -25, 60, 0),
(52, 160, -350, 130, 0, 50, -50, 75, 0),
(53, 120, -250, 150, 0, 90, -75, 60, 0),
(54, 150, -350, 150, 0, 75, -25, 75, 0),
(55, 140, -200, 160, 0, 85, -25, 85, 0),
(56, 160, -250, 140, 0, 65, -25, 70, 0),
(57, 150, -250, 130, 0, 70, -25, 75, 0),
(58, 130, -150, 150, 0, 80, -25, 85, 0),
(59, 170, -250, 170, 0, 75, -25, 95, 0),
(60, 160, -150, 130, 0, 65, -75, 55, 0),
(61, 140, -300, 170, -2500, 85, -25, 65, -375),
(62, 170, -350, 140, 0, 55, -50, 80, 0),
(63, 130, -250, 160, 0, 95, -75, 65, 0),
(64, 170, -350, 140, 0, 65, -25, 95, 0),
(65, 130, -200, 140, 0, 95, -75, 65, -375),
(66, 130, -250, 150, -2500, 65, -25, 75, 0),
(67, 140, -150, 130, 0, 55, -25, 65, 0),
(68, 150, -350, 160, 0, 70, -25, 80, 0),
(69, 160, -300, 170, 0, 80, -25, 85, 0),
(70, 160, -250, 170, 0, 75, -25, 80, 0),
(71, 150, -150, 170, 0, 75, -25, 75, 0),
(72, 170, -150, 150, 0, 55, -25, 55, 0),
(73, 140, -300, 160, 0, 75, -25, 75, 0),
(74, 130, -350, 140, 0, 70, -75, 55, 0),
(75, 160, -250, 160, -2500, 85, -25, 65, -375),
(76, 140, -350, 140, 0, 95, -25, 85, 0),
(77, 150, -250, 130, 0, 85, -50, 65, 0),
(78, 130, -250, 150, 0, 75, -50, 70, 0),
(79, 140, -200, 160, 0, 85, -25, 85, 0),
(80, 170, -250, 130, 0, 65, -75, 70, 0),
(81, 160, -250, 130, 0, 80, -25, 75, 0),
(82, 150, -150, 170, 0, 65, -25, 85, 0),
(83, 170, -250, 150, 0, 85, -75, 95, 0),
(84, 140, -300, 160, 0, 80, -25, 85, 0),
(85, 170, -300, 150, 0, 75, -25, 65, 0),
(86, 160, -150, 140, 0, 75, -75, 75, -375),
(87, 130, -150, 130, 0, 55, -25, 95, 0),
(88, 130, -200, 150, 0, 80, -25, 75, 0),
(89, 130, -250, 130, 0, 65, -25, 65, 0),
(90, 170, -250, 130, 0, 95, -25, 80, 0),
(91, 160, -150, 160, -2500, 70, -75, 85, 0),
(92, 150, -250, 150, 0, 75, -25, 95, 0),
(93, 160, -350, 170, 0, 85, -75, 65, 0),
(94, 140, -250, 140, 0, 85, -25, 70, 0),
(95, 150, -250, 140, 0, 65, -50, 85, 0),
(96, 130, -250, 150, 0, 55, -75, 85, -375),
(97, 170, -350, 170, -2500, 95, -25, 75, 0),
(98, 140, -200, 130, 0, 65, -25, 65, 0),
(99, 150, -250, 170, 0, 85, -25, 75, 0),
(100, 160, -350, 140, 0, 65, -25, 55, 0),
(101, 170, -250, 160, 0, 75, -25, 70, 0),
(102, 140, -350, 160, 0, 70, -25, 55, 0),
(103, 150, -150, 170, 0, 85, -50, 80, 0),
(104, 170, -350, 140, 0, 65, -25, 95, 0),
(105, 130, -200, 140, 0, 95, -75, 65, -375),
(106, 130, -250, 150, -2500, 65, -25, 75, 0),
(107, 140, -150, 130, 0, 55, -25, 65, 0),
(108, 150, -350, 160, 0, 70, -25, 80, 0),
(109, 160, -300, 170, 0, 80, -25, 85, 0),
(110, 160, -250, 170, 0, 75, -25, 80, 0),
(111, 150, -150, 170, 0, 75, -25, 75, 0),
(112, 170, -150, 150, 0, 55, -25, 55, 0),
(113, 140, -300, 160, 0, 75, -25, 75, 0),
(114, 130, -350, 140, 0, 70, -75, 55, 0),
(115, 160, -250, 160, -2500, 85, -25, 65, -375),
(116, 140, -350, 140, 0, 95, -25, 85, 0),
(117, 150, -250, 130, 0, 85, -50, 65, 0),
(118, 130, -250, 150, 0, 75, -50, 70, 0),
(119, 140, -200, 160, 0, 85, -25, 85, 0),
(120, 170, -250, 130, 0, 65, -75, 70, 0),
(121, 160, -250, 130, 0, 80, -25, 75, 0),
(122, 150, -150, 170, 0, 65, -25, 85, 0),
(123, 170, -250, 150, 0, 85, -75, 95, 0),
(124, 140, -300, 160, 0, 80, -25, 85, 0),
(125, 170, -300, 150, 0, 75, -25, 65, 0),
(126, 160, -150, 140, 0, 75, -75, 75, -375),
(127, 130, -150, 130, 0, 55, -25, 95, 0),
(128, 130, -200, 150, 0, 80, -25, 75, 0),
(129, 130, -250, 130, 0, 65, -25, 65, 0),
(130, 170, -250, 130, 0, 95, -25, 80, 0),
(131, 160, -150, 160, -2500, 70, -75, 85, 0),
(132, 150, -250, 150, 0, 75, -25, 95, 0),
(133, 160, -350, 170, 0, 85, -75, 65, 0),
(134, 140, -250, 140, 0, 85, -25, 70, 0),
(135, 150, -250, 140, 0, 65, -50, 85, 0),
(136, 130, -250, 150, 0, 55, -75, 85, -375),
(137, 170, -350, 170, -2500, 95, -25, 75, 0),
(138, 140, -200, 130, 0, 65, -25, 65, 0),
(139, 150, -250, 170, 0, 85, -25, 75, 0),
(140, 160, -350, 140, 0, 65, -25, 55, 0),
(141, 170, -250, 160, 0, 75, -25, 70, 0),
(142, 140, -350, 160, 0, 70, -25, 55, 0),
(143, 150, -150, 170, 0, 85, -50, 80, 0);