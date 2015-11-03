
USE rdmtoolkit;

ALTER TABLE `experiments` ADD `mouse_track` INT NOT NULL DEFAULT '0' AFTER `urllink`;

-- --------------------------------------------------------

--
-- Table structure for table `delayed_discount_que`
--

CREATE TABLE IF NOT EXISTS `delayed_discount_que` (
  `id` int(11) NOT NULL,
  `option_b` varchar(100) NOT NULL,
  `option_a` varchar(100) NOT NULL,
  `correct_option` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delayed_discount_que`
--

INSERT INTO `delayed_discount_que` (`id`, `option_b`, `option_a`, `correct_option`) VALUES
(1, '$44 10 years', '$22 now', 1),
(5, '$10 with 50% chance', '$3.5 for sure', 0),
(9, '$10 in 3 Days', '$1 now', 0),
(10, '$10 in 365 days', '$4.5 now', 0),
(11, '$10 in 2 days', '$1 now', 0),
(13, '$10 with 90% chance', '$0.5 for sure', 0),
(14, '$10 in 180 days', '$1.5 now', 0),
(15, '$10 in 30 days', '$2 now', 0),
(16, '$10 with 90% chance', '$0.5 for sure', 0),
(17, '$10 in 180 days', '$1.5 now', 0),
(18, '$10 in 30 days', '$2 now', 0),
(19, '$10 with 90% chance', '$0.5 for sure', 0),
(20, '$10 in 180 days', '$1.5 now', 0),
(21, '$10 in 30 days', '$2 now', 0),
(22, '$10 with 90% chance', '$0.5 for sure', 0),
(23, '$10 in 180 days', '$1.5 now', 0),
(24, '$10 in 30 days', '$2 now', 0),
(25, '$10 with 90% chance', '$0.5 for sure', 0),
(26, '$10 in 180 days', '$1.5 now', 0),
(27, '$10 in 30 days', '$2 now', 0),
(28, '$10 in 7 days', '$1 right now', 0),
(29, '$100 in 1 year', '$1 right now', 0);


-- --------------------------------------------------------

--
-- Table structure for table `mouse_offset_coords`
--

CREATE TABLE IF NOT EXISTS `mouse_offset_coords` (
  `id` int(11) NOT NULL,
  `exptype` varchar(100) NOT NULL,
  `coords` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mouse_track`
--

CREATE TABLE IF NOT EXISTS `mouse_track` (
  `id` int(11) NOT NULL,
  `expid` varchar(1000) NOT NULL,
  `expertype` varchar(100) NOT NULL,
  `mid` varchar(1000) NOT NULL,
  `x_coord` int(11) NOT NULL,
  `y_coord` int(11) NOT NULL,
  `time_spent` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `random_table`
--

CREATE TABLE IF NOT EXISTS `random_table` (
  `dorandom` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `random_table`
--

INSERT INTO `random_table` (`dorandom`) VALUES
(1);