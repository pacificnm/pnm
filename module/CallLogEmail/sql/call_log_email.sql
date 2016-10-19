SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `call_log_email`
--

CREATE TABLE IF NOT EXISTS `call_log_email` (
  `call_log_email_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `call_log_id` int(20) UNSIGNED NOT NULL,
  `email_id` int(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`call_log_email_id`),
  KEY `call_log_id` (`call_log_id`,`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `call_log_email`:
--
SET FOREIGN_KEY_CHECKS=1;
