-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2017 at 12:53 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Norman', 'Soucie', 'nsoucie@ggc.edu', '4047880106', '@vtext.com', 'a714c22d9fb962adf18bd7e6c9a0aef35659f4da3f3b275012a423cad61fa6f1d33167b4c2b0e061e740928ae63ec5714af81b351bf67fedaf510b1b0e3f651c', '074ca5714c9d2131607324968cc57e1d8c823488f98537fecca4e80e50ddae779d758fd3223618a5d0db387c0b4fa01948aefb21930013e6e99706f8b0973417', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempted_logins`
--
ALTER TABLE `attempted_logins`
  ADD PRIMARY KEY (`login_id`);

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
