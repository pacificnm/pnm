SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `workorder_parts`
--

CREATE TABLE IF NOT EXISTS `workorder_parts` (
  `workorder_parts_id` int(20) NOT NULL AUTO_INCREMENT,
  `workorder_id` int(20) NOT NULL,
  `workorder_parts_qty` int(8) NOT NULL,
  `workorder_parts_description` varchar(255) NOT NULL,
  `workorder_parts_amount` float(10,2) NOT NULL,
  `workorder_parts_total` float(10,2) NOT NULL,
  PRIMARY KEY (`workorder_parts_id`),
  KEY `workorder_id` (`workorder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `workorder_parts`
--
ALTER TABLE `workorder_parts`
  ADD CONSTRAINT `fk_workorder_parts_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorder` (`workorder_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
