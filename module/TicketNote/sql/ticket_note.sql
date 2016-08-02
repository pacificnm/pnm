SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticket_note`
--

CREATE TABLE IF NOT EXISTS `ticket_note` (
  `ticket_note_id` int(20) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(20) NOT NULL,
  `auth_id` int(20) NOT NULL,
  `ticket_note_client_view` int(3) NOT NULL,
  `ticket_note_date_create` int(11) NOT NULL,
  `ticket_note_text` longtext NOT NULL,
  PRIMARY KEY (`ticket_note_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `auth_id` (`auth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `ticket_note`:
--   `auth_id`
--       `auth` -> `auth_id`
--   `ticket_id`
--       `ticket` -> `ticket_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket_note`
--
ALTER TABLE `ticket_note`
  ADD CONSTRAINT `fk_ticket_note_auth_id` FOREIGN KEY (`auth_id`) REFERENCES `auth` (`auth_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticket_note_ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
