--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `user_status` enum('Active','Deleted') NOT NULL,
  `user_name_first` varchar(60) NOT NULL,
  `user_name_last` varchar(60) DEFAULT NULL,
  `user_job_title` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_type` enum('Primary','Logon','Staff') NOT NULL DEFAULT 'Primary'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT;