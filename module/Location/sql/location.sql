--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `location_type` enum('Primary','Branch Office','Billing','Shipping','Service') NOT NULL DEFAULT 'Primary',
  `location_street` varchar(100) NOT NULL,
  `location_street_2` varchar(100) DEFAULT NULL,
  `location_city` varchar(60) NOT NULL,
  `location_state` varchar(60) NOT NULL,
  `location_zip` varchar(60) NOT NULL,
  `location_Status` enum('Active','Closed') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
