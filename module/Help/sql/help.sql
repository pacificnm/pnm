--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `help_id` int(20) NOT NULL,
  `help_chapter_id` int(20) NOT NULL,
  `help_section_id` int(20) NOT NULL,
  `help_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`help_id`),
  ADD KEY `chapter_id` (`help_chapter_id`,`help_section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `help_id` int(20) NOT NULL AUTO_INCREMENT;