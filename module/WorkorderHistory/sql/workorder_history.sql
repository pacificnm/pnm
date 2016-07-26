SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `workorder_history`
--

CREATE TABLE IF NOT EXISTS `workorder_history` (
  `workorder_history_id` int(20) NOT NULL AUTO_INCREMENT,
  `workorder_id` int(20) NOT NULL,
  `history_id` int(20) NOT NULL,
  PRIMARY KEY (`workorder_history_id`),
  KEY `workorder_id` (`workorder_id`),
  KEY `history_id` (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `workorder_history`:
--   `history_id`
--       `history` -> `history_id`
--   `workorder_id`
--       `workorder` -> `workorder_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workorder_history`
--
ALTER TABLE `workorder_history`
  ADD CONSTRAINT `fk_workorder_history_history_id` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_history_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorder` (`workorder_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
