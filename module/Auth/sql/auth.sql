
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `auth_id` int(20) NOT NULL AUTO_INCREMENT,
  `auth_role` varchar(100) NOT NULL,
  `auth_email` varchar(200) NOT NULL,
  `auth_password` varchar(100) NOT NULL,
  `auth_name` varchar(100) NOT NULL,
  `auth_type` enum('Employee','User') NOT NULL,
  `auth_last_login` int(11) NOT NULL,
  `auth_last_ip` varchar(100) NOT NULL,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `employee_id` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`auth_id`),
  KEY `user_id` (`user_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- needed to change user_id to user for oauth2 to be able to use auth table
-- it uses user_id as its identification field.
--


ALTER TABLE `auth` CHANGE `user` `user_id` INT(20) UNSIGNED NOT NULL DEFAULT '0';
--
-- RELATIONS FOR TABLE `auth`:
--
SET FOREIGN_KEY_CHECKS=1;

