SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `workorder_host`
--

CREATE TABLE IF NOT EXISTS `workorder_host` (
  `workorder_host_id` int(20) NOT NULL AUTO_INCREMENT,
  `host_id` int(20) NOT NULL,
  `workorder_id` int(20) NOT NULL,
  PRIMARY KEY (`workorder_host_id`),
  KEY `host_id` (`host_id`),
  KEY `workorder_id` (`workorder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `workorder_host`:
--   `host_id`
--       `host` -> `host_id`
--   `workorder_id`
--       `workorder` -> `workorder_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workorder_host`
--
ALTER TABLE `workorder_host`
  ADD CONSTRAINT `fk_workorder_host_host_id` FOREIGN KEY (`host_id`) REFERENCES `host` (`host_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_host_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorder` (`workorder_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
