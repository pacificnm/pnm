SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `client_favorite`
--

CREATE TABLE IF NOT EXISTS `client_favorite` (
  `client_favorite_id` int(20) NOT NULL AUTO_INCREMENT,
  `auth_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `client_favorite_time` int(11) NOT NULL,
  PRIMARY KEY (`client_favorite_id`),
  KEY `auth_id` (`auth_id`),
  KEY `fk_client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `client_favorite`:
--   `auth_id`
--       `auth` -> `auth_id`
--   `client_id`
--       `client` -> `client_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_favorite`
--
ALTER TABLE `client_favorite`
  ADD CONSTRAINT `fk_auth_id` FOREIGN KEY (`auth_id`) REFERENCES `auth` (`auth_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

