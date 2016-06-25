
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `acl_role`
--

CREATE TABLE IF NOT EXISTS `acl_role` (
  `acl_role_id` int(20) NOT NULL AUTO_INCREMENT,
  `acl_role` varchar(100) NOT NULL,
  PRIMARY KEY (`acl_role_id`),
  UNIQUE KEY `acl_role` (`acl_role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `acl_role`:
--

--
-- Dumping data for table `acl_role`
--

INSERT INTO `acl_role` (`acl_role_id`, `acl_role`) VALUES
(4, 'accountant'),
(5, 'administrator'),
(3, 'employee'),
(1, 'guest'),
(2, 'user');
SET FOREIGN_KEY_CHECKS=1;
