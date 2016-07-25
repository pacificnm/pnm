--
-- Table structure for table `workorder_option`
--

CREATE TABLE IF NOT EXISTS `workorder_option` (
  `workorder_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `workorder_option_disclaimer` text NOT NULL,
  PRIMARY KEY (`workorder_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `workorder_option`:
--
SET FOREIGN_KEY_CHECKS=1;
