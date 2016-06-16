--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `location_type` enum('Primary','Branch Office','Billing','Shipping','Service') NOT NULL DEFAULT 'Primary',
  `location_street` varchar(100) NOT NULL,
  `location_street_cont` varchar(100) DEFAULT NULL,
  `location_city` varchar(60) NOT NULL,
  `location_state` varchar(60) NOT NULL,
  `location_zip` varchar(60) NOT NULL,
  `location_Status` enum('Active','Closed') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(20) NOT NULL AUTO_INCREMENT;