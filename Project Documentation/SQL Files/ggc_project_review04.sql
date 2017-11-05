-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2017 at 01:31 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ggc_project_review`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempted_logins`
--

CREATE TABLE `attempted_logins` (
  `login_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempted_logins`
--

INSERT INTO `attempted_logins` (`login_id`, `user`, `time`) VALUES
(1, 1, '838:59:59.999999');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `course_id`, `student_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 1, 3),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `section` varchar(32) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `semester` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `name`, `section`, `professor_id`, `semester`) VALUES
(1, 'Software Development II', '3870-01', 1, 'f2017'),
(2, 'Professional Ethics', '3900-04', 1, 'f2017');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `professor_id`, `course_id`, `name`, `due_date`) VALUES
(1, 1, 1, 'Project 1', '2017-10-23'),
(2, 1, 1, 'Project 2', '2017-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `time` date NOT NULL,
  `first` int(2) NOT NULL,
  `second` int(2) NOT NULL,
  `comment` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `submission_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `time` date NOT NULL,
  `link` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `carrier` varchar(16) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `s_code` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `phone`, `carrier`, `password`, `salt`, `s_code`) VALUES
(1, 'Norman', 'Soucie', 'nsoucie@ggc.edu', '4047880106', '@vtext.com', 'a714c22d9fb962adf18bd7e6c9a0aef35659f4da3f3b275012a423cad61fa6f1d33167b4c2b0e061e740928ae63ec5714af81b351bf67fedaf510b1b0e3f651c', '074ca5714c9d2131607324968cc57e1d8c823488f98537fecca4e80e50ddae779d758fd3223618a5d0db387c0b4fa01948aefb21930013e6e99706f8b0973417', 1),
(2, 'Matthew', 'Coker', 'mcoker@ggc.edu', '6782099178', '@vtext.com', '56c50891c0e1fc911d029d80e19016392c3fc5a5e121c4808665a0a14775af1951fb2ae44ffbe6d322c312f575e92cf997bb177524118d478c5e88e4345c10fe', '57bb081dd1851453c2efb4a568e4e8eb9df8e29fcc823423529d5c3d922cbd4cb541f11b15dcde0b522a2590faa283d189efd554d75948902409c1bee1f4ba54', 3),
(3, 'Jerry', 'Chambers', 'jchambers2@ggc.edu', '6787079531', '@vtext.com', '8de561273a76a5dcb658bb164ee807a197fdd9bf95312d5a87102f0e1658766af1dcae870877fc77ea993992f07fce04ab8bc33e137f2c34e68fab977433652d', '7e86e83451ad703fbfd024b123b9339101d2a6edcc9f3f44f0511391e5c4040861b284ec89808211e529d8482d80482d99320e72aeee6ca9495f296a7f7cc06b', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempted_logins`
--
ALTER TABLE `attempted_logins`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attempted_logins`
--
ALTER TABLE `attempted_logins`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
