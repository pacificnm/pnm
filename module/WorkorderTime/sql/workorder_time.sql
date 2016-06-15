--
-- Table structure for table `workorder_time`
--

CREATE TABLE `workorder_time` (
  `workorder_time_id` int(20) NOT NULL,
  `workorder_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `workorder_time_in` int(20) NOT NULL,
  `workorder_time_out` int(20) NOT NULL,
  `workorder_time_total` int(20) NOT NULL,
  `labor_id` int(20) NOT NULL,
  `labor_name` varchar(255) NOT NULL,
  `labor_rate` float(10,2) NOT NULL,
  `labor_total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workorder_time`
--
ALTER TABLE `workorder_time`
  ADD PRIMARY KEY (`workorder_time_id`),
  ADD KEY `workorder_id` (`workorder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workorder_time`
--
ALTER TABLE `workorder_time`
  MODIFY `workorder_time_id` int(20) NOT NULL AUTO_INCREMENT;