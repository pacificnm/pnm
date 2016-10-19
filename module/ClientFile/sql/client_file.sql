SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_file`
--

CREATE TABLE IF NOT EXISTS `client_file` (
  `client_file_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `file_id` int(20) NOT NULL,
  PRIMARY KEY (`client_file_id`),
  KEY `client_id` (`client_id`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `client_file`:
--   `client_id`
--       `client` -> `client_id`
--   `file_id`
--       `file` -> `file_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_file`
--
ALTER TABLE `client_file`
  ADD CONSTRAINT `fk_file_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_file_file_id` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
