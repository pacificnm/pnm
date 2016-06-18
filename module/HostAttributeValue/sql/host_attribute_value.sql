--
-- Table structure for table `host_attribute_value`
--

CREATE TABLE `host_attribute_value` (
  `host_attribute_value_id` int(20) NOT NULL,
  `host_attribute_id` int(20) NOT NULL,
  `host_attribute_value_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `host_attribute_value`
--
ALTER TABLE `host_attribute_value`
  ADD PRIMARY KEY (`host_attribute_value_id`),
  ADD KEY `host_attribute` (`host_attribute_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `host_attribute_value`
--
ALTER TABLE `host_attribute_value`
  MODIFY `host_attribute_value_id` int(20) NOT NULL AUTO_INCREMENT;