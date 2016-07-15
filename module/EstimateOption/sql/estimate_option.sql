--
-- Table structure for table `estimate_option`
--

CREATE TABLE IF NOT EXISTS `estimate_option` (
  `estimate_option_id` int(20) NOT NULL AUTO_INCREMENT,
  `estimate_id` int(20) NOT NULL,
  `estimate_option_title` varchar(255) NOT NULL,
  `estimate_option_decription` text NOT NULL,
  PRIMARY KEY (`estimate_option_id`),
  KEY `estimate_id` (`estimate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `estimate_option`:
--   `estimate_id`
--       `estimate` -> `estimate_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estimate_option`
--
ALTER TABLE `estimate_option`
  ADD CONSTRAINT `fk_estimate_option_estimate_id` FOREIGN KEY (`estimate_id`) REFERENCES `estimate` (`estimate_id`) ON UPDATE CASCADE;
