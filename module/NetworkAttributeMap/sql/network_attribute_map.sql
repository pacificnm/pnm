--
-- Table structure for table `network_attribute_map`
--

CREATE TABLE `network_attribute_map` (
  `network_attribute_map_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `network_attribute_id` int(20) NOT NULL,
  `network_attribute_map_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `network_attribute_map`
--
ALTER TABLE `network_attribute_map`
  ADD PRIMARY KEY (`network_attribute_map_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `network_attribute_map`
--
ALTER TABLE `network_attribute_map`
  MODIFY `network_attribute_map_id` int(20) NOT NULL AUTO_INCREMENT;