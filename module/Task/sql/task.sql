--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `task_date_start` int(20) NOT NULL,
  `task_date_end` int(20) NOT NULL,
  `task_status` varchar(60) NOT NULL,
  `task_priority` varchar(60) NOT NULL,
  `task_date_reminder` int(20) DEFAULT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(20) NOT NULL AUTO_INCREMENT;