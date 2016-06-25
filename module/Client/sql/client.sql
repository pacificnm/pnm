SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_status` enum('Active','Closed') NOT NULL,
  `client_created` int(20) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_name` (`client_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `client`:
--
SET FOREIGN_KEY_CHECKS=1;

