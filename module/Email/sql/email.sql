CREATE TABLE `email` (
  `email_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `email_date_created` int(11) NOT NULL,
  `email_date_sent` int(11) DEFAULT NULL,
  `email_to_address` varchar(200) NOT NULL,
  `email_to_name` varchar(200) NOT NULL,
  `email_from_address` varchar(200) NOT NULL,
  `email_from_name` varchar(200) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_body` text NOT NULL,
  `email_log` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `email_id` int(20) NOT NULL AUTO_INCREMENT;