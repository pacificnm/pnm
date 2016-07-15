--
-- Table structure for table `estimate`
--

CREATE TABLE IF NOT EXISTS `estimate` (
  `estimate_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `estimate_date_create` int(20) NOT NULL,
  `estimate_date_due` int(20) NOT NULL,
  `estimate_title` varchar(255) NOT NULL,
  `estimate_overview` text NOT NULL,
  `estimate_description` text NOT NULL,
  PRIMARY KEY (`estimate_id`),
  KEY `client_id` (`client_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `estimate`:
--   `client_id`
--       `client` -> `client_id`
--   `employee_id`
--       `employee` -> `employee_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estimate`
--
ALTER TABLE `estimate`
  ADD CONSTRAINT `fk_estimate_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estimate_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE;
