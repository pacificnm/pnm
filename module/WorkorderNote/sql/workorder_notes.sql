--
-- Table structure for table `workorder_notes`
--

CREATE TABLE `workorder_notes` (
  `workorder_notes_id` int(11) NOT NULL,
  `workorder_id` int(11) NOT NULL,
  `workorder_notes_date` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `workorder_notes_note` longtext NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workorder_notes`
--
ALTER TABLE `workorder_notes`
  ADD PRIMARY KEY (`workorder_notes_id`),
  ADD KEY `workorder_id` (`workorder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workorder_notes`
--
ALTER TABLE `workorder_notes`
  MODIFY `workorder_notes_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `workorder_notes`
--
ALTER TABLE `workorder_notes`
  ADD CONSTRAINT `fk_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorder` (`workorder_id`);
