SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(20) NOT NULL AUTO_INCREMENT,
  `config_version` varchar(20) NOT NULL,
  `config_copy_year` int(4) NOT NULL,
  `config_company_name` varchar(200) NOT NULL,
  `config_company_name_short` varchar(60) NOT NULL,
  `config_company_name_abv` varchar(20) NOT NULL,
  `config_company_street` varchar(200) NOT NULL,
  `config_company_street_cont` varchar(200) DEFAULT NULL,
  `config_company_city` varchar(200) NOT NULL,
  `config_company_state` varchar(200) NOT NULL,
  `config_company_postal` varchar(60) NOT NULL,
  `config_company_phone` varchar(60) NOT NULL,
  `config_company_phone_alt` varchar(60) DEFAULT NULL,
  `config_http_address` varchar(200) NOT NULL,
  `config_date_long` varchar(60) NOT NULL,
  `config_date_short` varchar(60) NOT NULL,
  `config_lang` varchar(20) NOT NULL,
  `config_currency` varchar(20) NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- updated 
ALTER TABLE `config` ADD `config_google_api_key` VARCHAR(100) NOT NULL AFTER `config_currency`;


ALTER TABLE `config` ADD `config_smtp_host` VARCHAR(255) NULL AFTER `config_google_api_key`;
ALTER TABLE `config` ADD `config_smtp_port` INT(4) NULL AFTER `config_smtp_host`;
ALTER TABLE `config` ADD `config_smtp_security` VARCHAR(60) NULL AFTER `config_smtp_port`;
ALTER TABLE `config` ADD `config_smtp_display` VARCHAR(255) NULL AFTER `config_smtp_security`;
ALTER TABLE `config` ADD `config_smtp_email` VARCHAR(255) NULL AFTER `config_smtp_display`;
ALTER TABLE `config` ADD `config_smtp_password` VARCHAR(255) NOT NULL AFTER `config_smtp_email`;

--
-- RELATIONS FOR TABLE `config`:
--

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_id`, `config_version`, `config_copy_year`, `config_company_name`, `config_company_name_short`, `config_company_name_abv`, `config_company_street`, `config_company_street_cont`, `config_company_city`, `config_company_state`, `config_company_postal`, `config_company_phone`, `config_company_phone_alt`, `config_http_address`, `config_date_long`, `config_date_short`, `config_lang`, `config_currency`, `config_google_api_key`) VALUES
(1, '2.5.0', 2013, 'Pacific Network Management', 'PacificNM', 'PNM', '323 SE Riverside AV', '', 'Grants Pass', 'Oregon', '97526', '(541) 237-4655', '', '', 'm/d/Y h:i a', 'm/d/Y', 'en_US', 'USD', '');
SET FOREIGN_KEY_CHECKS=1;


