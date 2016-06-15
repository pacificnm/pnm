--
-- Table structure for table `milage`
--

CREATE TABLE `milage` (
  `mileage_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `date` int(20) NOT NULL,
  `start_location` varchar(200) NOT NULL,
  `end_location` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `odometer_start` float(10,2) NOT NULL,
  `odometer_end` float(10,2) NOT NULL,
  `mileage` float(10,2) NOT NULL,
  `reimbursement` float(10,2) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `milage`
--
ALTER TABLE `milage`
  ADD PRIMARY KEY (`mileage_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `milage`
--
ALTER TABLE `milage`
  MODIFY `mileage_id` int(20) NOT NULL AUTO_INCREMENT;