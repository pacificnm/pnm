CREATE TABLE IF NOT EXISTS `call_log` (
  `call_log_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `call_log_time` int(11) NOT NULL,
  `call_log_detail` text NOT NULL,
  `call_log_require_call_back` int(3) NOT NULL,
  `call_log_will_call_back` int(3) NOT NULL,
  `call_log_voice_mail` int(3) NOT NULL,
  `call_log_urgent` int(3) NOT NULL,
  `call_log_read` int(3) NOT NULL,
  `call_log_created_by` int(20) NOT NULL,
  PRIMARY KEY (`call_log_id`),
  KEY `client_id` (`client_id`),
  KEY `employee_id` (`employee_id`),
  KEY `call_log_created_by` (`call_log_created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `call_log`:
--   `client_id`
--       `client` -> `client_id`
--   `employee_id`
--       `employee` -> `employee_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `call_log`
--
ALTER TABLE `call_log`
  ADD CONSTRAINT `fk_call_log_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_call_log_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;
