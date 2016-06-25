
--
-- Table structure for table `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `help_id` int(20) NOT NULL AUTO_INCREMENT,
  `help_chapter_id` int(20) NOT NULL,
  `help_section_id` int(20) NOT NULL,
  `help_content` text NOT NULL,
  PRIMARY KEY (`help_id`),
  KEY `chapter_id` (`help_chapter_id`,`help_section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;