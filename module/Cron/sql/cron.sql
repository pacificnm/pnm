SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cron`
--

CREATE TABLE IF NOT EXISTS `cron` (
  `cron_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cron_minute` int(3) UNSIGNED NOT NULL,
  `cron_hour` int(3) UNSIGNED NOT NULL,
  `cron_dom` int(3) UNSIGNED NOT NULL,
  `cron_month` int(3) NOT NULL,
  `cron_command` varchar(255) NOT NULL,
  `cron_run_once` int(3) NOT NULL,
  `cron_last_run` int(11) NOT NULL,
  `cron_status` int(3) NOT NULL DEFAULT '0',
  `cron_enabled` int(3) NOT NULL,
  PRIMARY KEY (`cron_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `cron`:
--

--
-- Dumping data for table `cron`
--

INSERT INTO `cron` (`cron_id`, `cron_minute`, `cron_hour`, `cron_dom`, `cron_month`, `cron_command`, `cron_run_once`, `cron_last_run`, `cron_status`, `cron_enabled`) VALUES
(1, 0, 0, 0, 0, 'console.php update --install', 1, 1477356542, 0, 0),
(2, 25, 0, 0, 0, 'console.php panorama-client --sync', 0, 1477355101, 1, 1),
(3, 45, 0, 0, 0, 'console.php panorama-host --sync', 0, 1477356303, 0, 1),
(4, 1, 0, 0, 0, 'console.php panorama-issue --sync', 1, 1477354442, 1, 0);

INSERT INTO `cron` (`cron_id`, `cron_minute`, `cron_hour`, `cron_dom`, `cron_month`, `cron_command`, `cron_run_once`, `cron_last_run`, `cron_status`, `cron_enabled`) VALUES
(5, 0, 23, 0, 0, 'console.php subscription --create-invoices', 0, 0, 0, 1);


INSERT INTO `cron` (`cron_id`, `cron_minute`, `cron_hour`, `cron_dom`, `cron_month`, `cron_command`, `cron_run_once`, `cron_last_run`, `cron_status`, `cron_enabled`) VALUES
(6, 0, 6, 0, 0, 'console.php report-profit --run', 0, 0, 0, 1);

SET FOREIGN_KEY_CHECKS=1;
