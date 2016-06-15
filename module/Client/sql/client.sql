--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(20) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_status` enum('Active','Closed') NOT NULL,
  `client_created` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_name` (`client_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(20) NOT NULL AUTO_INCREMENT;