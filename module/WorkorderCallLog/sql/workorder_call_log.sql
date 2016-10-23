SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `workorder_call_log`
--

CREATE TABLE IF NOT EXISTS `workorder_call_log` (
  `workorder_call_log_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `workorder_id` int(20) UNSIGNED NOT NULL,
  `call_log_id` int(20) UNSIGNED NOT NULL,
  `workorder_call_log_created` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`workorder_call_log_id`),
  UNIQUE KEY `workorder_id` (`workorder_id`,`call_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `workorder_call_log`:
--
SET FOREIGN_KEY_CHECKS=1;
