--
-- Table structure for table `workorder_file`
--
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `workorder_file` (
  `workorder_file_id` int(20) NOT NULL AUTO_INCREMENT,
  `workorder_id` int(20) NOT NULL,
  `file_id` int(20) NOT NULL,
  PRIMARY KEY (`workorder_file_id`),
  KEY `workorder_id` (`workorder_id`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `workorder_file`:
--   `file_id`
--       `file` -> `file_id`
--   `workorder_id`
--       `workorder` -> `workorder_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workorder_file`
--
ALTER TABLE `workorder_file`
  ADD CONSTRAINT `fk_workorder_file_file_id` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_file_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorder` (`workorder_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
