--
-- Table structure for table `estimate_option_item`
--

CREATE TABLE IF NOT EXISTS `estimate_option_item` (
  `estimate_option_item_id` int(20) NOT NULL AUTO_INCREMENT,
  `estimate_option_id` int(20) NOT NULL,
  `estimate_option_item_qty` int(11) NOT NULL,
  `estimate_option_title` varchar(255) NOT NULL,
  `estimate_option_item_type` enum('Labor','Part') NOT NULL,
  `estimate_option_item_amount` float(11,2) NOT NULL,
  `estimate_option_item_total` float(11,2) NOT NULL,
  `estimate_option_item_description` text NOT NULL,
  PRIMARY KEY (`estimate_option_item_id`),
  KEY `estimate_option_id` (`estimate_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `estimate_option_item`:
--   `estimate_option_id`
--       `estimate_option` -> `estimate_option_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estimate_option_item`
--
ALTER TABLE `estimate_option_item`
  ADD CONSTRAINT `fk_estimate_option_id` FOREIGN KEY (`estimate_option_id`) REFERENCES `estimate_option` (`estimate_option_id`) ON UPDATE CASCADE;
