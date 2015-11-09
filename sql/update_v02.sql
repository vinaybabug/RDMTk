USE rdmtoolkit;

DROP TABLE IF EXISTS random_table;

--
-- Table structure for table `delayd_expr_data`
--

CREATE TABLE IF NOT EXISTS `delayd_expr_data` (
  `int` int(11) NOT NULL,
  `mid` varchar(60) NOT NULL,
  `experid` varchar(50) NOT NULL,
  `que_id` int(11) NOT NULL,
  `option_selected` varchar(30) NOT NULL,
  `trialno` int(11) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

