SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `panorama_host`
--

CREATE TABLE IF NOT EXISTS `panorama_host` (
  `panorama_host_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `host_id` int(20) UNSIGNED NOT NULL,
  `panorama_device_id` varchar(255) NOT NULL,
  `panorama_host_last_sync` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`panorama_host_id`),
  UNIQUE KEY `host_id` (`host_id`,`panorama_device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `panorama_host`:
--
SET FOREIGN_KEY_CHECKS=1;
