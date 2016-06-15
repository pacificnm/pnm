--
-- Table structure for table `network`
--

CREATE TABLE `network` (
  `network_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `network_attribute_id` int(11) NOT NULL,
  `network_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `network`
--
ALTER TABLE `network`
  ADD PRIMARY KEY (`network_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `network`
--
ALTER TABLE `network`
  MODIFY `network_id` int(20) NOT NULL AUTO_INCREMENT;