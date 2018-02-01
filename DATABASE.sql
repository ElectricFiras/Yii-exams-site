-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2018 at 05:34 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 5.6.33-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Yii_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `term_order` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `user_id`, `exam`, `term_order`) VALUES
(33, 4, '{"title":"dfhfg","exam":{"question1":{"text":"dfh","right":"answer1","answers":{"answer1":"dfh","answer2":"dfhdfg","answer3":"dfh","answer4":"dfh"}}}}', NULL),
(34, 4, '{"title":"ghfh","exam":{"question1":{"text":"dfh","right":"answer1","answers":{"answer1":"dfhdfh","answer2":"dfhdf","answer3":"dfhh","answer4":"dfhfh"}}}}', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1516260290),
('m130524_201442_init', 1516260305);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `isadmin` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `age`, `gender`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `isadmin`, `created_at`, `updated_at`) VALUES
(1, 'asdfsd', 'fdgdfg', 'dfgsdsdf', 'sdfsdf@dfg.com', '987654321', 54, '0', 'k1lwQfu71Dpnhg9QNP_pNqccTDvR-JjC', '$2y$13$yPzqPfi.i05sPck5Hv9pD.Jsn47rhwXiK/rKFBiitOJ8ofjIym3MS', NULL, 10, NULL, 1516546756, 1516546756),
(2, 'Firas', 'Ghanem', 'firas_ghanem', 'ghanem.firas@live.com', '780785433', 24, '0', 'rgpBhjpRwyEz5xfu01zyNsEKq7KH8qkQ', '$2y$13$VXNhoJ3WoLl7ehNuOdR2menoPEv6YYvYT.ZFJR82xNUjzulTYJ8m2', NULL, 10, NULL, 1516608914, 1516608914),
(4, 'dfgd', 'dfgsdfgsdfg', 'firass', 'sdfds@sdfsd.com', '987654328', 24, '0', 'wgqokY1DL8MH7l8WMtmhR5Z6PeYQoaVs', '$2y$13$pbpzdrVSt3hGngt1ibIuu.aPJsVjfUCkdPzh.iHFVlXyorq/Otnpq', NULL, 10, 1, 1516623930, 1516623930),
(5, 'Firas', 'Ghanem', 'ffr', 'firss.as@gmail.com', '458765478', 19, '0', 'fCu-7cnRtrEbaD2M3NrSTkYlVUKSKZw8', '$2y$13$XRqSY/Cf2nwfDAjQMXP/B.ysKMYV1A9bhC8usikKeibLVptiEqzoO', NULL, 10, NULL, 1516630864, 1516630864),
(6, 'Mohammd', 'Mohamm', 'mmm', 'asdasd@sdfsd.com', '799848900', 42, '0', '5WpxgMEdFY2zPDF7og3LO0SHN6AgJh5L', '$2y$13$doqjrCDh5Ipgl5FUGNGBeei4TzzyOYU8GwVBMcexdqtJtUYmoMevm', NULL, 10, NULL, 1516633567, 1516633567),
(7, 'Mazen', 'Mazen', 'Mazen', 'Mazen@aa.com', '07854567850', 23, '0', 'OLGK4tNaIXdeG_bqbn8HAqRAWkyvDEuI', '$2y$13$TZD7Z.kpfQ43Xkj4Tj7TC.chBy71otXJm52L32sOUSU2Yt/Q9OAwi', NULL, 10, NULL, 1517497485, 1517497485);

-- --------------------------------------------------------

--
-- Table structure for table `userExam`
--

CREATE TABLE `userExam` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `answers` longtext,
  `mark` varchar(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `failed` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userExam`
--

INSERT INTO `userExam` (`id`, `user_id`, `exam_id`, `answers`, `mark`, `end`, `failed`) VALUES
(26, 4, 33, '{"1":"answer4"}', '0/1', 1517481635, 1),
(27, 2, 33, '{"1":"answer3"}', '0/1', 1517481661, 1),
(28, 2, 34, '{"1":"answer1"}', '1/1', 1517481695, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usersSessions`
--

CREATE TABLE `usersSessions` (
  `id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersSessions`
--

INSERT INTO `usersSessions` (`id`, `user_id`, `start`, `end`) VALUES
('054si333q51a7ias3c4orrt482', 2, 1517470743, 1517470776),
('7fesaunl8d1kd6eepv8975q114', 2, 1517470444, 1517470453),
('80lmbv3al1sjhs5mih79q84rl3', 2, 1517470260, 1517470300),
('81c3clai87h5diub248g0u2bg4', 2, 1517470474, 1517470495),
('9ot0ugu1hq085ul421lkf46721', 2, 1517470468, 1517470469),
('a4iqq7cprm1cb8d5ku29ap59i4', 7, 1517497485, 1517497545),
('aiv3rtjfs2rh7oqdav50dbc5m6', 2, 1517479334, 1517479353),
('c7i6ki9ustbbce4r29q5sja026', 4, 1517481195, 1517481645),
('d47a61cec69b3ova9vdtjna2d3', 2, 1517479862, 0),
('e215nnmhauhurk85cponbffm84', 2, 1517481657, 0),
('efgbolnq48q6d6gkacnn2q3ti6', 2, 1517404676, 1517404693),
('g9cjm32o3q9hnlgc5rig84tql2', 2, 1517470696, 1517470710),
('ra15lvjk6e5bqg032s0q0ho3e0', 2, 1517470338, 1517470343),
('tmndmbrdjhg238qk3s9sdpqtr2', 4, 1517481650, 1517481653),
('u03elo7tp7pql1mcrvndnt3ld7', 4, 1517479357, 1517479857);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `userExam`
--
ALTER TABLE `userExam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersSessions`
--
ALTER TABLE `usersSessions`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `userExam`
--
ALTER TABLE `userExam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `usersSessions`
--
ALTER TABLE `usersSessions`
  ADD CONSTRAINT `usersSessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
