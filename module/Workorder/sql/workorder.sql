--
-- Table structure for table `workorder`
--

CREATE TABLE `workorder` (
  `workorder_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `phone_id` int(20) NOT NULL,
  `workorder_status` enum('Active','Closed','Deleted') NOT NULL DEFAULT 'Active',
  `workorder_description` longtext NOT NULL,
  `workorder_labor` float(10,2) DEFAULT '0.00',
  `workorder_parts` float(10,2) DEFAULT '0.00',
  `workorder_date_create` int(20) NOT NULL,
  `workorder_date_scheduled` int(11) NOT NULL,
  `workorder_date_end` int(20) NOT NULL,
  `workorder_date_close` int(20) DEFAULT NULL,
  `invoice_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workorder`
--
ALTER TABLE `workorder`
  ADD PRIMARY KEY (`workorder_id`),
  ADD KEY `location_id` (`location_id`,`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workorder`
--
ALTER TABLE `workorder`
  MODIFY `workorder_id` int(20) NOT NULL AUTO_INCREMENT;