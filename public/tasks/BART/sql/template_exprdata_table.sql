CREATE SCHEMA IF NOT EXISTS `rdmtoolkit` ;
USE rdmtoolkit;

DROP TABLE IF EXISTS `template_exprdata_table`;

DROP TABLE IF EXISTS `experiments`;

CREATE TABLE IF NOT EXISTS `template_exprdata_table` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `mid` varchar(100) NOT NULL,
  `experid` char(36) NOT NULL,  
  `trialno` int(100) NOT NULL, 
  `modified_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,  
  `tracktime` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;


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


INSERT INTO `rdmtoolkit`.`experiments`
(`id`,
`expername`,
`expertype`,
`nooftrials`,
`expertrial_outcome_type`,
`confirmationcode`,
`experend_conf_page_type`,
`experend_conf_customtext`,
`urllink`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`)
VALUES
('dummyexperiment',
'dummyexperiment',
'DUMMY',
10,
'FIXED',
'123456789',
'MTURK',
null,
'http://localhost/bart/task.php?exp=dummyexperiment&MID=MID',
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
'MTURK',
'#',
'ADMIN',
'ADMIN',
now(),
now());
