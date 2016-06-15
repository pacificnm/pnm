--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `phone_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `phone_type` enum('Primary','Fax') NOT NULL DEFAULT 'Primary',
  `phone_num` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`phone_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `phone_id` int(20) NOT NULL AUTO_INCREMENT;