SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `panorama_issue`
--

CREATE TABLE IF NOT EXISTS `panorama_issue` (
  `panorama_issue_id` varchar(100) NOT NULL,
  `client_id` int(20) UNSIGNED NOT NULL,
  `panorama_issue_area` varchar(100) NOT NULL,
  `panorama_issue_category` varchar(100) NOT NULL,
  `panorama_issue_type` varchar(100) NOT NULL,
  `panorama_issue_message` varchar(100) NOT NULL,
  `panorama_issue_first_seen` int(11) UNSIGNED NOT NULL,
  `panorama_issue_last_seen` int(11) UNSIGNED NOT NULL,
  `panorama_issue_resolved` int(3) UNSIGNED NOT NULL,
  `panorama_issue_resolved_time` int(11) UNSIGNED NOT NULL,
  `panorama_issue_snoozed` int(3) UNSIGNED NOT NULL,
  `panorama_issue_item_id` varchar(100) DEFAULT NULL,
  `panorama_issue_vulnerability` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`panorama_issue_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `panorama_issue`:
--
SET FOREIGN_KEY_CHECKS=1;