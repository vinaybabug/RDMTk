USE rdmtoolkit;

DROP TABLE IF EXISTS random_table;

--
-- Table structure for table `delayd_expr_data`
--

CREATE TABLE IF NOT EXISTS `delayd_expr_data` (
  `id` int(11) NOT NULL,
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

--
-- Indexes for table `delayd_expr_data`
--
ALTER TABLE `delayd_expr_data`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `delayd_expr_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;


ALTER TABLE `experiments` ADD `select_dataset` VARCHAR(100) NOT NULL DEFAULT 'DEFAULT' AFTER `mouse_track`;

DROP TABLE IF EXISTS `delayed_discount_que`;

-- --------------------------------------------------------

--
-- Table structure for table `delayed_discount_que`
--

CREATE TABLE IF NOT EXISTS `delayed_discount_que` (
  `id` int(11) NOT NULL,
  `option_b` varchar(100) NOT NULL,
  `option_a` varchar(100) NOT NULL,
  `dataset_name` varchar(100) NOT NULL DEFAULT 'DEFAULT',
  `created_by` varchar(200) NOT NULL DEFAULT 'ADMIN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delayed_discount_que`
--

INSERT INTO `delayed_discount_que` (`id`, `option_b`, `option_a`, `dataset_name`, `created_by`, `created_at`) VALUES
(1, '$44 10 years', '$22 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(5, '$10 with 50% chance', '$3.5 for sure', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(9, '$10 in 3 Days', '$1 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(10, '$10 in 365 days', '$4.5 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(11, '$10 in 2 days', '$1 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(13, '$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(14, '$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(15, '$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(16, '$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(17, '$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(18, '$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(19, '$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(20, '$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(21, '$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(22, '$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(23, '$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(24, '$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(25, '$10 with 90% chance', '$0.5 for sure', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(26, '$10 in 180 days', '$1.5 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(27, '$10 in 30 days', '$2 now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(28, '$10 in 7 days', '$1 right now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00'),
(29, '$100 in 1 year', '$1 right now', 'DEFAULT', 'ADMIN', '2015-11-09 19:27:00');

--
-- Indexes for table `delayed_discount_que`
--
ALTER TABLE `delayed_discount_que`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `delayed_discount_que`
--
ALTER TABLE `delayed_discount_que`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;