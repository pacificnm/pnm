--
-- Table structure for table `call_log_note`
--

CREATE TABLE IF NOT EXISTS `call_log_note` (
  `call_log_note_id` int(20) NOT NULL AUTO_INCREMENT,
  `call_log_id` int(20) NOT NULL,
  `call_log_note_text` text NOT NULL,
  `call_log_note_create_by` int(20) NOT NULL,
  `call_log_created` int(11) NOT NULL,
  PRIMARY KEY (`call_log_note_id`),
  KEY `call_log_id` (`call_log_id`),
  KEY `call_log_note_create_by` (`call_log_note_create_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `call_log_note`:
--   `call_log_id`
--       `call_log` -> `call_log_id`
--   `call_log_note_create_by`
--       `employee` -> `employee_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `call_log_note`
--
ALTER TABLE `call_log_note`
  ADD CONSTRAINT `fk_call_log_note_call_log_id` FOREIGN KEY (`call_log_id`) REFERENCES `call_log` (`call_log_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_call_log_note_employee_id` FOREIGN KEY (`call_log_note_create_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;
