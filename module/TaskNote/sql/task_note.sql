--
-- Table structure for table `task_note`
--

CREATE TABLE `task_note` (
  `task_note_id` int(20) NOT NULL,
  `task_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `task_note_date` int(20) NOT NULL,
  `task_note_text` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task_note`
--
ALTER TABLE `task_note`
  ADD PRIMARY KEY (`task_note_id`),
  ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task_note`
--
ALTER TABLE `task_note`
  MODIFY `task_note_id` int(20) NOT NULL AUTO_INCREMENT;