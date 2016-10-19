
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `panorama_client`
--

CREATE TABLE IF NOT EXISTS `panorama_client` (
  `panorama_client_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(20) UNSIGNED NOT NULL,
  `panorama_client_cid` int(20) UNSIGNED NOT NULL,
  `panorama_client_last_sync` int(11) NOT NULL,
  PRIMARY KEY (`panorama_client_id`),
  KEY `client_id` (`client_id`),
  KEY `panorama_client_cid` (`panorama_client_cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `panorama_client`:
--
SET FOREIGN_KEY_CHECKS=1;
