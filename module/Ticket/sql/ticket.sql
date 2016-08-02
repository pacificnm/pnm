SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `ticket_title` varchar(255) NOT NULL,
  `ticket_status` enum('New','Active','Closed') NOT NULL DEFAULT 'Active',
  `ticket_date_open` int(11) NOT NULL,
  `ticket_date_close` int(11) NOT NULL,
  `ticket_text` longtext NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `client_id` (`client_id`),
  KEY `user_id` (`user_id`),
  KEY `ticket_status` (`ticket_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `ticket`:
--   `client_id`
--       `client` -> `client_id`
--   `user_id`
--       `user` -> `user_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_ticket_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticket_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;