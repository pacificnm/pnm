--
-- Table structure for table `workorder_employee`
--

CREATE TABLE `workorder_employee` (
  `workorder_employee_id` int(20) NOT NULL,
  `workorder_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workorder_employee`
--
ALTER TABLE `workorder_employee`
  ADD PRIMARY KEY (`workorder_employee_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workorder_employee`
--
ALTER TABLE `workorder_employee`
  MODIFY `workorder_employee_id` int(20) NOT NULL AUTO_INCREMENT;