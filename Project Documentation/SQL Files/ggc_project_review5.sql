-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2017 at 06:32 AM
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
(4, 2, 3),
(5, 3, 4),
(6, 3, 5),
(7, 3, 6),
(8, 3, 7),
(9, 3, 8),
(10, 4, 4),
(11, 4, 5),
(12, 4, 6),
(13, 4, 7),
(14, 4, 8);

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
(2, 'Professional Ethics', '3900-04', 1, 'f2017'),
(3, 'Biodiversity in Floriculture', '05', 2, 'f2017'),
(4, 'Postmodern Neo-Irony in Poetry', '01', 3, 'f2017');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `professor_id`, `course_id`, `name`, `due_date`) VALUES
(1, 1, 1, 'Project 1', '2017-10-23'),
(2, 1, 1, 'Project 2', '2017-11-23'),
(3, 1, 2, 'Practicing Ethics', '2017-11-10'),
(4, 2, 3, 'Cross pollination', '2017-11-16'),
(5, 3, 4, 'Haikus that are Wrong but Necessary', '2017-11-15'),
(6, 3, 4, 'Haikus that may be Correct but completely Unnecessary', '2017-11-16');

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

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `submission_id`, `student_id`, `time`, `first`, `second`, `comment`) VALUES
(2, 3, 2, '2017-11-09', 3, 5, 'This tofu looks tasty but why is there only one?'),
(3, 3, 3, '2017-11-08', 1, 1, 'I\'m reviewing my own submission and I will be the first to admit that it\'s terrible'),
(4, 4, 5, '2017-11-09', 4, 5, 'I love shiba!!'),
(5, 4, 6, '2017-11-09', 3, 4, 'why dog so angry... :('),
(6, 5, 6, '2017-11-09', 4, 5, 'I love that they all have different colored collars'),
(7, 5, 7, '2017-11-09', 5, 5, '11 puppies! so adorable!'),
(8, 6, 7, '2017-11-09', 5, 4, 'camera\'s too shaky but it meets the requirememts'),
(9, 6, 8, '2017-11-09', 4, 5, 'That squirrel is amazing.'),
(10, 7, 8, '2017-11-09', 3, 5, 'It\'s really cute but I don\'t think it meets the requirements'),
(11, 7, 4, '2017-11-10', 4, 5, 'I love dogs! babies are only okay though'),
(12, 8, 4, '2017-11-09', 4, 4, 'I relate to this mouse so much'),
(13, 8, 5, '2017-11-09', 5, 5, 'I want one!'),
(14, 9, 5, '2017-11-11', 3, 2, 'You got this from google images...'),
(15, 9, 6, '2017-11-11', 4, 5, 'good explanation!! lovely drawing'),
(16, 10, 6, '2017-11-11', 5, 5, 'Good flower diagram. i did my reviews can I get an A now'),
(17, 10, 7, '2017-11-11', 2, 1, 'I guess it meets like... one requirement??'),
(18, 11, 7, '2017-11-11', 4, 5, 'Not the bees!!!'),
(19, 11, 8, '2017-11-11', 3, 4, 'good photo but I hate memes. also you did like only half of the requirements'),
(20, 12, 8, '2017-11-11', 5, 4, 'I hate grapefruits but it still looks rad'),
(21, 12, 4, '2017-11-11', 5, 5, 'That looks so cool!! I wonder what else you can combine oranges with'),
(22, 13, 4, '2017-11-11', 3, 5, 'This is super neat but I think the author says he avoided cross-pollination for these peppers'),
(23, 13, 5, '2017-11-11', 5, 5, 'Wow, I learned a lot! Great job finding this.');

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

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`submission_id`, `student_id`, `project_id`, `time`, `link`) VALUES
(3, 3, 1, '2017-11-08', 'http://static.tumblr.com/vosc2oh/LGDlsfguw/tofu.png'),
(4, 4, 2, '2017-11-08', 'https://giant.gfycat.com/AdeptEmotionalHawaiianmonkseal.webm'),
(5, 5, 2, '2017-11-08', 'https://imgur.com/a/dxnKE'),
(6, 6, 2, '2017-11-08', 'https://i.imgur.com/QUyvL5I.gifv'),
(7, 7, 2, '2017-11-08', 'https://i.imgur.com/M44sDQL.gifv'),
(8, 8, 2, '2017-11-08', 'https://i.imgur.com/yppi6kW.gifv'),
(9, 4, 4, '2017-11-09', 'https://media1.britannica.com/eb-media/88/95388-004-6E2508A9.jpg'),
(10, 5, 4, '2017-11-10', 'http://biology-igcse.weebly.com/uploads/1/5/0/7/15070316/3367290_orig.png'),
(11, 6, 4, '2017-11-09', 'https://i.imgur.com/XwoaLBb.jpg'),
(12, 7, 4, '2017-11-08', 'https://imgur.com/gallery/IpyEJ'),
(13, 8, 4, '2017-11-09', 'https://imgur.com/gallery/pwAuZ'),
(14, 4, 6, '2017-11-14', 'this is a haiku\r\nnot a very good haiku\r\nbut still a haiku'),
(15, 4, 5, '2017-11-14', 'hmmm a deja vu\r\nit happens when they change things\r\nwhirlybird go boom'),
(16, 5, 5, '2017-11-10', 'words\r\ninspiring other words\r\nmockingbird'),
(17, 6, 5, '2017-11-15', 'mockingbird\r\nwhy is this chick\r\nmaking fun of me'),
(18, 5, 6, '2017-11-09', 'the hunter tags\r\nhis 200 lb deer kill\r\nplease don\'t take it'),
(19, 6, 6, '2017-11-10', 'shave\r\nand a haircut...\r\ncourting rituals'),
(20, 7, 5, '2017-11-09', 'leaf pile\r\nparallel parking\r\ncurbside'),
(21, 7, 6, '2017-11-17', 'Antibiotics\r\nMost were found while cleaning out\r\nRefrigerators'),
(22, 8, 5, '2017-11-13', '\"thanks missed connections\"\r\ndivorce attorney makes bank, \r\ncredited affairs'),
(23, 8, 6, '2017-11-12', 'good soil\r\ngreat with earthworms\r\nkeep the clean indoors');

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
(3, 'Jerry', 'Chambers', 'jchambers2@ggc.edu', '6787079531', '@vtext.com', '8de561273a76a5dcb658bb164ee807a197fdd9bf95312d5a87102f0e1658766af1dcae870877fc77ea993992f07fce04ab8bc33e137f2c34e68fab977433652d', '7e86e83451ad703fbfd024b123b9339101d2a6edcc9f3f44f0511391e5c4040861b284ec89808211e529d8482d80482d99320e72aeee6ca9495f296a7f7cc06b', 3),
(4, 'user0', 'lastname', 'user0@url.com', '458-505-5495', '@vtext.com', 'fb8271e7af9f7b5772c083595e61aecdacfba447370c547666a7a678470fde8d51c9f1bd2ec4c92711f09cd1824e921298a068ff9a0e385c2d2de960a5919cdb', 'efcead2ee7b97c319dd99a3d5b000ff2285d08bdbe6e64fdfccb6b91b48b5240306d1f768e601aa18970bdd2dfb79aaf685d22df3e478a0f416d06c45482cfa3', 5),
(5, 'user1143', 'autogenerated', 'user1143@url.com', '6788739999', '@vtext.com', 'ccc3d2e4612ccc6dc0f3be2c2b95120c269919092167fbe99693a4c200b85ced16eccf1d4397d0c692ed41280964f6c60506a62a7684745d306c4bd9ce8fbf49', '0acb0bfa1411ea4061065db58f24019b7022f7082640840662d54af172cde0c086aca6dfaf03221b2c4fd9ba136fae2e1a90f9e8ee21e131f161e9b26797fda8', 5),
(6, 'user9066', 'autogenerated', 'user9066@url.com', '6783069999', '@vtext.com', 'af8a2e53659919c0631408f6ce7aa4265dc516abe11f2e8ae1a95680f031588d89c9016e7ad6f7224dbd54f3ea66d2445d51e21020eb52b977398e70bc2c0e27', 'ec88e79487d26e4b6573df4b0e809ed9a29e03f553d4924c9c14ec230e1a9034771c555db2e8d8176f0140af77ad7bea6279c9dcdee64a02ea766cc5a350147d', 5),
(7, 'user6371', 'autogenerated', 'user6371@url.com', '6785649999', '@vtext.com', '6cbafac69d952fbf03e111ae93ec8768b9e7ae4aadefab60d8c9e79c629298642a093e8aed0d1556e11cd89d206045f18218f5ca34503e5c5a3d346e09780609', '38df2cb97ef785d5604b2f15601cc27a9eeb9a000aba32575b075f9622abc65b58e220678295b001c19553eacc1baa843e9750b6ccbeb683bbdf2e1c67fc31af', 5),
(8, 'user8920', 'autogenerated', 'user8920@url.com', '6786279999', '@vtext.com', 'd9f2b0e7121ab2604e4b7ca50fb079fe43caabb2059957bfe7ae96c08f6c11db99cf5c82702edda16b6a49c5ace5e0b24bb5f9bb5583938246c4824135b7c10c', 'ea1ec084b0e0c8270168c1e3d7b5936a00d1147450a775c5a6f992c3d805cc633514e2efaaf4c44f005d796d35422b8f68a28bd92ada641a24c3a5e7674f2edd', 5),
(9, 'user9007', 'autogenerated', 'user9007@url.com', '6784979999', '@vtext.com', '6d978c3fb91968b2c09ace8abc0fb9c63a18951599c5ba90463d73ff0838950cb583c299aa3e1fb007a4e1ba459d2ddfdcaa86ec305d9c8810b840068f61c2e1', 'a63b52509fb7c95d67d5cd554daa835daba40b95c1fb2577d29b4ded3d85b94eea520bfbb0b411429091456aa1282f4567eac99d7fcd134e429a867580960f31', 0),
(10, 'user840', 'autogenerated', 'user840@url.com', '6789139999', '@vtext.com', 'b3e9183485239719550a7da02e35103b8e8a8c645dd6ce1eb82e848f1ca9034a594b13547db3dd767bea6683ac19ea0a0615a8cb8308bb237979ec3905d15288', '4d06c0c658d57ddca8fff0cd52d6e0dd67bbeb4bd91164de133517a21df7ccffd9e29c3093db93db4ea51c577ea68951cceb2449504c30c5b76b4c2ca9f8de6e', 0);

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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
