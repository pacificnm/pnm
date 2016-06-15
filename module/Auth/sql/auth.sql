--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `auth_id` int(20) NOT NULL,
  `auth_role` varchar(100) NOT NULL,
  `auth_email` varchar(200) NOT NULL,
  `auth_password` varchar(100) NOT NULL,
  `auth_name` varchar(100) NOT NULL,
  `auth_type` enum('Employee','User') NOT NULL,
  `auth_last_login` int(11) NOT NULL,
  `auth_last_ip` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`auth_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `auth_id` int(20) NOT NULL AUTO_INCREMENT;