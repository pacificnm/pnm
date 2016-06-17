--
-- Table structure for table `host`
--

CREATE TABLE `host` (
  `host_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `host_type` int(20) NOT NULL,
  `host_name` varchar(100) NOT NULL,
  `host_ip` varchar(60) NOT NULL,
  `host_status` enum('Active','Retired','Deleted') NOT NULL DEFAULT 'Active',
  `host_health` enum('Not Enabled','Ok','Warning','Alert') NOT NULL,
  `host_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`host_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `host`
--
ALTER TABLE `host`
  MODIFY `host_id` int(20) NOT NULL AUTO_INCREMENT;