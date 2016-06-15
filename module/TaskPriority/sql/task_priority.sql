--
-- Table structure for table `task_priority`
--

CREATE TABLE `task_priority` (
  `task_priority_id` int(20) NOT NULL,
  `task_priority_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_priority`
--

INSERT INTO `task_priority` (`task_priority_id`, `task_priority_value`) VALUES
(1, 'Low'),
(2, 'Normal'),
(3, 'High');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task_priority`
--
ALTER TABLE `task_priority`
  ADD PRIMARY KEY (`task_priority_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task_priority`
--
ALTER TABLE `task_priority`
  MODIFY `task_priority_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;