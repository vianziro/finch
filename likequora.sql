-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2017 at 02:27 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `likequora`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(25) NOT NULL,
  `qkey` varchar(111) DEFAULT NULL,
  `content` longtext,
  `upvote_total` bigint(5) DEFAULT NULL,
  `downvote_total` bigint(5) DEFAULT NULL,
  `comment_total` bigint(5) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `ukey` varchar(100) DEFAULT NULL,
  `ckey` varchar(100) DEFAULT NULL,
  `tkey` varchar(111) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `qkey`, `content`, `upvote_total`, `downvote_total`, `comment_total`, `username`, `ukey`, `ckey`, `tkey`, `date`) VALUES
(14, 'a5bfc9e07964f8dddeb95fc584cd965d', 'meh', NULL, NULL, NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'b3e3e393c77e35a4a3f3cbd1e429b5dc', '37a749d808e46495a8da1e5352d03cae', '2017-01-22 12:16:41'),
(21, 'a5bfc9e07964f8dddeb95fc584cd965d', 'ah', NULL, NULL, NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '006f52e9102a8d3be2fe5614f42ba989', '5878a7ab84fb43402106c575658472fa', '2017-01-22 23:10:21'),
(22, 'a5bfc9e07964f8dddeb95fc584cd965d', 'aha', NULL, NULL, NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '149e9677a5989fd342ae44213df68868', '3636638817772e42b59d74cff571fbb3', '2017-01-22 23:10:40'),
(27, '1c383cd30b7c298ab50293adfecb7b18', 'saya belum pernah punya guru', NULL, NULL, NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '31fefc0e570cb3860f2a6d4b38c6490d', '9872ed9fc22fc182d371c3e9ed316094', '2017-01-23 00:08:36'),
(28, '85d8ce590ad8981ca2c8286f79f59954', 'Just touch it dude, oh my gosh, it ez', NULL, NULL, NULL, 'anezscarlet', '1385974ed5904a438616ff7bdb3f7439', '84d9ee44e457ddef7f2c4f25dc8fa865', '0e65972dce68dad4d52d063967f0a705', '2017-01-23 02:00:54');

--
-- Triggers `answers`
--
DELIMITER $$
CREATE TRIGGER `do_answers` BEFORE INSERT ON `answers`
 FOR EACH ROW BEGIN
  INSERT INTO dohash () VALUES ();
  SET NEW.ckey = MD5(LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `answers_comments`
--

CREATE TABLE IF NOT EXISTS `answers_comments` (
  `id` bigint(25) NOT NULL,
  `qkey` varchar(111) DEFAULT NULL,
  `akey` varchar(111) DEFAULT NULL,
  `content` longtext,
  `like_total` int(50) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `ckey` varchar(111) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers_comments`
--

INSERT INTO `answers_comments` (`id`, `qkey`, `akey`, `content`, `like_total`, `username`, `ukey`, `ckey`, `date`) VALUES
(9, NULL, 'eb160de1de89d9058fcb0b968dbbbd68', 'lah elu kerjaan nya ngakak aja', NULL, 'tararara', '3c59dc048e8850243be8079a5c74d079', '07e1cd7dca89a1678042477183b7ac3f', '2017-01-20 08:52:29'),
(10, NULL, '42a0e188f5033bc65bf8d78622277c4e', 'dunno', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '7ef605fc8dba5425d6965fbd4c8fbe1f', '2017-01-21 06:09:44'),
(11, NULL, '42a0e188f5033bc65bf8d78622277c4e', 'Cool shit', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'a8f15eda80c50adb0e71943adc8015cf', '2017-01-21 06:21:53'),
(12, NULL, '149e9677a5989fd342ae44213df68868', 'haha', NULL, 'jokowi', '1d7f7abc18fcb43975065399b0d1e48e', 'a4a042cf4fd6bfb47701cbc8a1653ada', '2017-01-22 23:16:53'),
(13, NULL, '006f52e9102a8d3be2fe5614f42ba989', 'meh', NULL, 'jokowi', '1d7f7abc18fcb43975065399b0d1e48e', '4c5bde74a8f110656874902f07378009', '2017-01-22 23:29:55'),
(14, NULL, '31fefc0e570cb3860f2a6d4b38c6490d', 'iya', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '9dcb88e0137649590b755372b040afad', '2017-01-23 00:09:10'),
(15, NULL, '31fefc0e570cb3860f2a6d4b38c6490d', 'tes', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'a2557a7b2e94197ff767970b67041697', '2017-01-23 00:09:19'),
(16, NULL, 'b3e3e393c77e35a4a3f3cbd1e429b5dc', 'meh?', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '0aa1883c6411f7873cb83dacb17b0afc', '2017-01-23 00:12:39'),
(17, NULL, 'b3e3e393c77e35a4a3f3cbd1e429b5dc', 'what do you mean?', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '58a2fc6ed39fd083f55d4182bf88826d', '2017-01-23 00:12:44'),
(18, NULL, 'fa7cdfad1a5aaf8370ebeda47a1ff1c3', 'wow great answer  mr Joko', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'a597e50502f5ff68e3e25b9114205d4a', '2017-01-23 01:48:15'),
(19, NULL, 'fa7cdfad1a5aaf8370ebeda47a1ff1c3', 'really great answer', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '0336dcbab05b9d5ad24f4333c7658a0e', '2017-01-23 01:48:24'),
(20, NULL, '84d9ee44e457ddef7f2c4f25dc8fa865', 'nope', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '757b505cfd34c64c85ca5b5690ee5293', '2017-02-14 10:17:26'),
(21, NULL, '84d9ee44e457ddef7f2c4f25dc8fa865', 'isnt simple dude', NULL, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '854d6fae5ee42911677c739ee1734486', '2017-02-14 10:17:30');

--
-- Triggers `answers_comments`
--
DELIMITER $$
CREATE TRIGGER `do_ac` BEFORE INSERT ON `answers_comments`
 FOR EACH ROW BEGIN
  INSERT INTO dohash () VALUES ();
  SET NEW.ckey = MD5('fa'+LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `answers_comments_reply`
--

CREATE TABLE IF NOT EXISTS `answers_comments_reply` (
  `id` bigint(25) NOT NULL,
  `ackey` varchar(111) DEFAULT NULL,
  `akey` varchar(111) DEFAULT NULL,
  `qkey` varchar(111) DEFAULT NULL,
  `content` text,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `ckey` varchar(111) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers_comments_reply`
--

INSERT INTO `answers_comments_reply` (`id`, `ackey`, `akey`, `qkey`, `content`, `username`, `ukey`, `ckey`, `date`) VALUES
(1, '7ef605fc8dba5425d6965fbd4c8fbe1f', '42a0e188f5033bc65bf8d78622277c4e', NULL, 'meh', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', NULL, '2017-01-21 06:14:20'),
(2, 'a4a042cf4fd6bfb47701cbc8a1653ada', '149e9677a5989fd342ae44213df68868', NULL, 'how cool is that', 'jokowi', '1d7f7abc18fcb43975065399b0d1e48e', NULL, '2017-01-22 23:17:00'),
(3, '9dcb88e0137649590b755372b040afad', '31fefc0e570cb3860f2a6d4b38c6490d', NULL, 'kenapa?', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', NULL, '2017-01-23 00:09:16'),
(4, 'a2557a7b2e94197ff767970b67041697', '31fefc0e570cb3860f2a6d4b38c6490d', NULL, 'gak kenapa"', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', NULL, '2017-01-23 00:09:24'),
(5, '58a2fc6ed39fd083f55d4182bf88826d', 'b3e3e393c77e35a4a3f3cbd1e429b5dc', NULL, 'meh', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', NULL, '2017-01-23 00:12:47'),
(6, '0336dcbab05b9d5ad24f4333c7658a0e', 'fa7cdfad1a5aaf8370ebeda47a1ff1c3', NULL, 'thanks', 'huaha', 'bd686fd640be98efaae0091fa301e613', NULL, '2017-01-23 01:49:38'),
(7, '0336dcbab05b9d5ad24f4333c7658a0e', 'fa7cdfad1a5aaf8370ebeda47a1ff1c3', NULL, 'u welcome', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', NULL, '2017-01-23 01:49:52'),
(8, '854d6fae5ee42911677c739ee1734486', '84d9ee44e457ddef7f2c4f25dc8fa865', NULL, 'ho they do that ?', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', NULL, '2017-02-14 10:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `answers_votes`
--

CREATE TABLE IF NOT EXISTS `answers_votes` (
  `id` bigint(25) NOT NULL,
  `qkey` varchar(111) DEFAULT NULL,
  `akey` varchar(111) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '1 = upvoted, 0 = downvoted, 2 = likes',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers_votes`
--

INSERT INTO `answers_votes` (`id`, `qkey`, `akey`, `username`, `ukey`, `status`, `date`) VALUES
(78, 'fc490ca45c00b1249bbe3554a4fdf6fb', 'fc490ca45c00b1249bbe3554a4fdf6fb', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 0, '2017-01-19 16:07:35'),
(92, 'fc490ca45c00b1249bbe3554a4fdf6fb', 'fc490ca45c00b1249bbe3554a4fdf6fb', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 2, '2017-01-19 16:12:12'),
(182, '35f4a8d465e6e1edc05f3d8ab658c551', '35f4a8d465e6e1edc05f3d8ab658c551', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 2, '2017-01-19 20:15:16'),
(185, 'c9e1074f5b3f9fc8ea15d152add07294', 'c9e1074f5b3f9fc8ea15d152add07294', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 2, '2017-01-20 00:18:28'),
(187, 'c9e1074f5b3f9fc8ea15d152add07294', 'c9e1074f5b3f9fc8ea15d152add07294', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 0, '2017-01-20 00:19:32'),
(207, '65ded5353c5ee48d0b7d48c591b8f430', '65ded5353c5ee48d0b7d48c591b8f430', 'tararara', '3c59dc048e8850243be8079a5c74d079', 0, '2017-01-20 11:35:18'),
(222, '31fefc0e570cb3860f2a6d4b38c6490d', '31fefc0e570cb3860f2a6d4b38c6490d', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 0, '2017-01-23 00:08:45'),
(224, 'b3e3e393c77e35a4a3f3cbd1e429b5dc', 'b3e3e393c77e35a4a3f3cbd1e429b5dc', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 2, '2017-01-23 00:12:50'),
(225, '31fefc0e570cb3860f2a6d4b38c6490d', '31fefc0e570cb3860f2a6d4b38c6490d', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 2, '2017-01-24 07:57:24'),
(226, '84d9ee44e457ddef7f2c4f25dc8fa865', '84d9ee44e457ddef7f2c4f25dc8fa865', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 2, '2017-02-14 10:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `dohash`
--

CREATE TABLE IF NOT EXISTS `dohash` (
  `id` bigint(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dohash`
--

INSERT INTO `dohash` (`id`) VALUES
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86),
(87),
(88),
(89),
(90),
(91),
(92),
(93),
(94),
(95),
(96),
(97),
(98),
(99),
(100),
(101),
(102),
(103),
(104),
(105),
(106),
(107),
(108),
(109),
(110),
(111),
(112),
(113),
(114),
(115),
(116),
(117),
(118),
(119),
(120),
(121),
(122),
(123),
(124),
(125),
(126),
(127),
(128),
(129),
(130),
(131),
(132),
(133),
(134),
(135),
(136),
(137),
(138),
(139),
(140),
(141),
(142),
(143),
(144),
(145),
(146),
(147),
(148),
(149),
(150),
(151),
(152),
(153),
(154),
(155),
(156),
(157),
(158),
(159),
(160),
(161),
(162),
(163),
(164),
(165),
(166),
(167),
(168),
(169),
(170),
(171),
(172),
(173),
(174),
(175),
(176),
(177),
(178),
(179),
(180),
(181),
(182),
(183),
(184),
(185),
(186),
(187),
(188),
(189),
(190),
(191),
(192),
(193),
(194),
(195),
(196),
(197),
(198),
(199),
(200),
(201),
(202);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `lftp`
--

CREATE TABLE IF NOT EXISTS `lftp` (
  `id` bigint(25) NOT NULL COMMENT 'Log From This Place',
  `ip_address` text,
  `browser` text,
  `username` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_follow`
--

CREATE TABLE IF NOT EXISTS `log_follow` (
  `id` bigint(25) NOT NULL,
  `identity` varchar(100) DEFAULT NULL,
  `tkey` varchar(111) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `last_content` varchar(100) DEFAULT NULL,
  `last_user` varchar(100) DEFAULT NULL,
  `log_info` enum('1','2','3','4','5','6') DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint(20) NOT NULL,
  `title` varchar(111) DEFAULT NULL,
  `content` longtext,
  `downvote_total` text,
  `viewer_total` text,
  `passed_total` text,
  `topic` varchar(50) DEFAULT NULL,
  `address` text,
  `username` varchar(100) DEFAULT NULL,
  `ukey` varchar(100) DEFAULT NULL,
  `ckey` varchar(100) DEFAULT NULL,
  `tkey` varchar(111) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `content`, `downvote_total`, `viewer_total`, `passed_total`, `topic`, `address`, `username`, `ukey`, `ckey`, `tkey`, `date`) VALUES
(8, 'Siapa guru yang paling galak yang pernah anda kenal?', 'How To Truss A Turkey Nah?', NULL, NULL, NULL, 'Social', 'Jakarta', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '1c383cd30b7c298ab50293adfecb7b18', 'e369853df766fa44e1ed0ff613f563bd', '2017-01-18 11:24:18'),
(9, 'Siapa teman terbaik anda pada masa sekolah dasar?', '', NULL, NULL, NULL, 'Social', 'Jakarta', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'a5bfc9e07964f8dddeb95fc584cd965d', '19ca14e7ea6328a42e0eb13d585e4c22', '2017-01-18 11:38:49'),
(10, 'how to touch an alien', '', NULL, NULL, NULL, 'Social', '', 'anezscarlet', '1385974ed5904a438616ff7bdb3f7439', '85d8ce590ad8981ca2c8286f79f59954', '084b6fbb10729ed4da8c3d3f5a3ae7c9', '2017-01-23 02:00:28');

--
-- Triggers `questions`
--
DELIMITER $$
CREATE TRIGGER `do_questions` BEFORE INSERT ON `questions`
 FOR EACH ROW BEGIN
  INSERT INTO dohash () VALUES ();
  SET NEW.ckey = MD5('fa'+LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `questions_comments`
--

CREATE TABLE IF NOT EXISTS `questions_comments` (
  `id` bigint(25) NOT NULL,
  `qkey` varchar(100) DEFAULT NULL,
  `content` text,
  `username` varchar(100) DEFAULT NULL,
  `ukey` varchar(100) DEFAULT NULL,
  `ckey` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions_comments`
--

INSERT INTO `questions_comments` (`id`, `qkey`, `content`, `username`, `ukey`, `ckey`, `date`) VALUES
(2, 'a5bfc9e07964f8dddeb95fc584cd965d', 'lah, ya malah keren kaya gitu', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'f7177163c833dff4b38fc8d2872f1ec6', '2017-01-19 08:56:15'),
(3, 'a5bfc9e07964f8dddeb95fc584cd965d', 'sebenar nya itu sudah bagus, namun masih kurang bagus', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '6c8349cc7260ae62e3b1396831a8398f', '2017-01-19 08:56:05'),
(4, 'a5bfc9e07964f8dddeb95fc584cd965d', 'ya udah lah, keren kaya gitu mah, tapi ya tinggal gimana nanti nya aja', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'f457c545a9ded88f18ecee47145a72c0', '2017-01-19 08:58:05'),
(5, '1c383cd30b7c298ab50293adfecb7b18', 'sayang nya saya belum pernah punya guru', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'c0c7c76d30bd3dcaefc96f40275bdc0a', '2017-01-19 11:30:25'),
(6, 'a5bfc9e07964f8dddeb95fc584cd965d', 'tak ada', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '2838023a778dfaecdc212708f721b788', '2017-01-19 14:16:57'),
(7, 'a5bfc9e07964f8dddeb95fc584cd965d', 'hahaha', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '9f61408e3afb633e50cdf1b20de6f466', '2017-01-19 14:21:20'),
(8, 'a5bfc9e07964f8dddeb95fc584cd965d', 'wtf', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '7f39f8317fbdb1988ef4c628eba02591', '2017-01-19 16:03:52'),
(9, 'a5bfc9e07964f8dddeb95fc584cd965d', 'hahaha', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'a3f390d88e4c41f2747bfa2f1b5f87db', '2017-01-19 16:38:32'),
(10, '1c383cd30b7c298ab50293adfecb7b18', 'haha', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '8d5e957f297893487bd98fa830fa6413', '2017-01-21 05:11:43'),
(11, 'a5bfc9e07964f8dddeb95fc584cd965d', 'kelenn', 'jokowi', '1d7f7abc18fcb43975065399b0d1e48e', '045117b0e0a11a242b9765e79cbf113f', '2017-01-22 23:28:04'),
(12, 'a5bfc9e07964f8dddeb95fc584cd965d', 'fa', 'jokowi', '1d7f7abc18fcb43975065399b0d1e48e', 'fc221309746013ac554571fbd180e1c8', '2017-01-22 23:28:24'),
(13, 'a5bfc9e07964f8dddeb95fc584cd965d', 'haha', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'cedebb6e872f539bef8c3f919874e9d7', '2017-01-22 23:34:55'),
(14, 'a5bfc9e07964f8dddeb95fc584cd965d', 'gaga', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '6cdd60ea0045eb7a6ec44c54d29ed402', '2017-01-22 23:36:37'),
(15, '1c383cd30b7c298ab50293adfecb7b18', 'bagus', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'cfecdb276f634854f3ef915e2e980c31', '2017-01-23 00:12:09');

--
-- Triggers `questions_comments`
--
DELIMITER $$
CREATE TRIGGER `do_qc` BEFORE INSERT ON `questions_comments`
 FOR EACH ROW BEGIN
  INSERT INTO dohash () VALUES ();
  SET NEW.ckey = MD5('fa'+LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `questions_edits`
--

CREATE TABLE IF NOT EXISTS `questions_edits` (
  `id` bigint(25) NOT NULL,
  `qkey` varchar(111) DEFAULT NULL,
  `title` varchar(111) DEFAULT NULL,
  `content` longtext,
  `topic` varchar(111) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `for_username` varchar(111) DEFAULT NULL,
  `for_ukey` varchar(111) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isapprove` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions_edits`
--

INSERT INTO `questions_edits` (`id`, `qkey`, `title`, `content`, `topic`, `username`, `ukey`, `for_username`, `for_ukey`, `date`, `isapprove`) VALUES
(2, '1c383cd30b7c298ab50293adfecb7b18', 'Gak ada yang kenal aku', 'How To Truss A Turkey Nah?', 'social', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '2017-01-21 12:36:15', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `questions_files`
--

CREATE TABLE IF NOT EXISTS `questions_files` (
  `id` bigint(25) NOT NULL,
  `identity` varchar(100) DEFAULT NULL,
  `tkey` varchar(100) DEFAULT NULL COMMENT 'timeline key',
  `ckey` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `ukey` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions_pass`
--

CREATE TABLE IF NOT EXISTS `questions_pass` (
  `id` bigint(25) NOT NULL,
  `qkey` varchar(111) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions_places`
--

CREATE TABLE IF NOT EXISTS `questions_places` (
  `id` bigint(25) NOT NULL,
  `image` text,
  `identity` varchar(111) DEFAULT NULL,
  `title` text,
  `total_visit` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions_topics`
--

CREATE TABLE IF NOT EXISTS `questions_topics` (
  `id` bigint(25) NOT NULL,
  `identity` varchar(111) DEFAULT NULL,
  `title` varchar(111) DEFAULT NULL,
  `description` text,
  `image` text,
  `total_question` int(50) DEFAULT NULL,
  `total_interest` int(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions_topics`
--

INSERT INTO `questions_topics` (`id`, `identity`, `title`, `description`, `image`, `total_question`, `total_interest`) VALUES
(1, 'social', 'Social', 'Social  & Life Style', '#', 31, 22);

-- --------------------------------------------------------

--
-- Table structure for table `questions_votes`
--

CREATE TABLE IF NOT EXISTS `questions_votes` (
  `id` bigint(25) NOT NULL,
  `qkey` varchar(111) DEFAULT NULL,
  `tkey` varchar(111) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1 = Upvoted, 0 = Downvoted',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions_votes`
--

INSERT INTO `questions_votes` (`id`, `qkey`, `tkey`, `username`, `ukey`, `status`, `date`) VALUES
(36, 'd67d8ab4f4c10bf22aa353e27879133c', 'a5771bce93e200c36f7cd9dfd0e5deaa', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 0, '2017-01-18 19:25:20'),
(37, 'a5bfc9e07964f8dddeb95fc584cd965d', '19ca14e7ea6328a42e0eb13d585e4c22', 'jokowi', '1d7f7abc18fcb43975065399b0d1e48e', 0, '2017-01-22 23:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `saved_timeline`
--

CREATE TABLE IF NOT EXISTS `saved_timeline` (
  `id` bigint(25) NOT NULL,
  `tkey` varchar(111) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE IF NOT EXISTS `timeline` (
  `id` bigint(25) NOT NULL,
  `title` varchar(111) DEFAULT NULL,
  `identity` varchar(111) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL COMMENT '0 = questions, 1 = answer',
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `ckey` varchar(111) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `viewer` binary(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id`, `title`, `identity`, `type`, `username`, `ukey`, `ckey`, `date`, `viewer`) VALUES
(4, 'Cara menjadi superman', NULL, '0', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'e369853df766fa44e1ed0ff613f563bd', '0000-00-00 00:00:00', 0x3500000000000000000000000000000000000000),
(5, 'cara menjadi jadi', NULL, '0', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '19ca14e7ea6328a42e0eb13d585e4c22', '0000-00-00 00:00:00', 0x3434000000000000000000000000000000000000),
(19, NULL, NULL, '1', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '37a749d808e46495a8da1e5352d03cae', NULL, NULL),
(26, NULL, NULL, '1', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '5878a7ab84fb43402106c575658472fa', NULL, NULL),
(27, NULL, NULL, '1', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '3636638817772e42b59d74cff571fbb3', NULL, NULL),
(32, NULL, NULL, '1', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '9872ed9fc22fc182d371c3e9ed316094', NULL, NULL),
(33, NULL, NULL, '0', 'anezscarlet', '1385974ed5904a438616ff7bdb3f7439', '084b6fbb10729ed4da8c3d3f5a3ae7c9', NULL, NULL),
(34, NULL, NULL, '1', 'anezscarlet', '1385974ed5904a438616ff7bdb3f7439', '0e65972dce68dad4d52d063967f0a705', NULL, NULL);

--
-- Triggers `timeline`
--
DELIMITER $$
CREATE TRIGGER `do_timeline` BEFORE INSERT ON `timeline`
 FOR EACH ROW BEGIN
  INSERT INTO dohash () VALUES ();
  SET NEW.ckey = MD5(LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `identity` varchar(100) DEFAULT NULL,
  `image` text,
  `coverimage` text NOT NULL,
  `bio` text,
  `gender` int(1) DEFAULT NULL,
  `borndate` varchar(50) DEFAULT NULL,
  `address` text,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `last_activity` varchar(50) DEFAULT NULL,
  `issubscribe` varchar(2) DEFAULT NULL,
  `agreetos` varchar(2) DEFAULT NULL,
  `mykey` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `identity`, `image`, `coverimage`, `bio`, `gender`, `borndate`, `address`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `last_activity`, `issubscribe`, `agreetos`, `mykey`) VALUES
(1, '127.0.0.1', 'ruby', 'ruby', 'gtfo.gif', 'rci.jpg', 'Professional Web & App Developer, Scientist, Introverted Boy, Etc', 1, '', '', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1489783627, 1, 'Rubi', 'Jihantoro', 'ADMIN', '0', '17-03-18 03:47:07', 'on', 'on', 'a87xff679a2f32e71d9181a667b7542xg122c'),
(22, '::1', 'tararara', 'tararara', '463fa099dc3da4c2db5530ae73194e57.jpg', '', 'tararara', 1, 'tararara', 'tararara', '$2y$08$Zl3RtohOQYYfSbd37Ot6pu2vGtqPg2.5SNlIoLHwV90oULjRciqIi', NULL, 'tararara@fa.s', NULL, NULL, NULL, NULL, 1484632080, 1485086804, 1, 'tararara', '', NULL, NULL, '17-01-22 19:06:44', 'on', 'on', '3c59dc048e8850243be8079a5c74d079'),
(23, '::1', 'Jimmy', 'Jimmy', 'a0fee4dac5e2233b46ab6521d650d855.jpg', '', 'Jimmy', 1, 'dua belas', 'Jimmy', '$2y$08$quiy9LQlcuI9tsUPwpB7dOCjyWb48meP3PZzYTknNZ4qXSGc3NB1a', NULL, 'jimmy@fa.s', NULL, NULL, NULL, NULL, 1484632736, 1484632736, 1, 'Jimmy', '', NULL, NULL, '17-01-17 12:58:56', 'on', 'on', 'b6d767d2f8ed5d21a44b0e5886680cb9'),
(24, '::1', 'handokoga', 'handokoga', '11bf105d5f65b23ca216b89cb30a9c11.jpg', '', 'handoko', 1, '12', 'handoko', '$2y$08$dhw2isdAvM3tm7bV3oysneyGTbR.h9tMnCN/2BWKIvkqVkWeNhjMO', NULL, 'handoko@fafa.gag', NULL, NULL, NULL, NULL, 1484633272, 1484633272, 1, 'handoko suseno', '', NULL, NULL, '17-01-17 13:07:52', 'on', 'on', '37693cfc748049e45d87b8c7d8b9aacd'),
(25, '::1', 'anezscarlet', 'anezscarlet', '9f49a5bba26026b817ab379e532f545d.jpg', 'anez.jpg', 'Great Dancer, An Artisant', 1, '09-06-1996', 'Depok, Indonesia', '$2y$08$c4xk93HgJn7E5SOptEWGIOa1EeZVKC7SAX8gLeSTUhxN5nbRJMAO2', NULL, 'anez@gmail.com', NULL, NULL, NULL, NULL, 1484914526, 1487723036, 1, 'Anez', 'Scarlet', NULL, NULL, '17-02-22 07:23:57', 'on', 'on', '1385974ed5904a438616ff7bdb3f7439'),
(26, '::1', 'jokowi', 'jokowi', '26b2897dddb533217a5becc2d01e163b.jpg', '', 'Halo, nama saya joko widodo,', 1, '13 Sep', 'Istana Negara', '$2y$08$2dfnJRg/A2PELiSnGR7xCuIkq/DYDMDaRWsKA/yIpXlSRgG/Exk8a', NULL, 'jokowi@joko.wi', NULL, NULL, NULL, NULL, 1485126279, 1485158518, 1, 'Joko', 'Widodo', NULL, NULL, '17-01-23 15:01:58', 'on', 'on', '1d7f7abc18fcb43975065399b0d1e48e'),
(27, '::1', 'huhu', 'huhu', '8bab315d81018529fac0fcc3f52d0da0.jpg', '', 'bla bla bla hubla ', 1, '23 Jan', 'Jl. Cendrawasih, Kemanggis Mastin, Ujung Kulon.', '$2y$08$kn.2FTWaQbzqcneay2A5fuQ/SXYB1UFuA/7D.mW8o51EHDx86HOvu', NULL, 'mosrur@gmail.com', NULL, NULL, NULL, NULL, 1485128420, 1485128483, 1, 'haHA', 'HEHE', NULL, NULL, '17-01-23 06:41:23', 'on', 'on', 'eecca5b6365d9607ee5a9d336962c534'),
(28, '::1', 'huaha', 'huaha', '5a330c65fd48a3d4c5bfdecaf9f41d18.jpg', '', 'Hi Nama Saya Suketi, Saya bersalah dari dunia lain', 1, '13 September 1998', 'Jl. Cendrawasih, Kemanggis Mastin, Ujung Kulon.', '$2y$08$F6hb3W5hfRJHB94PMUVxV.23bCGUyMQbkxblxCedniKYr1RxnWLeq', NULL, 'huaha@fa.s', NULL, NULL, NULL, NULL, 1485131864, 1485136158, 1, 'huaha', 'huaha', NULL, NULL, '17-01-23 08:49:18', 'on', 'on', 'bd686fd640be98efaae0091fa301e613'),
(29, '::1', 'suseno', 'suseno', '323506bca9ab2eca6ce00d8776fbc951.png', '', 'FAWFAWFAWF', 0, '13 12 2001', 'Atas', '$2y$08$xLQ8NcprNJchaRRgt6izsONC4Zu90HCC8VhHq2dsK4/MQ4wonioPG', NULL, 'suseno@gmail.com', NULL, NULL, NULL, NULL, 1485953460, 1485953461, 1, 'Suseno', 'Sidi', NULL, NULL, '17-02-01 19:51:00', 'on', 'on', '3644a684f98ea8fe223c713b77189a77');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `do_users` BEFORE INSERT ON `users`
 FOR EACH ROW BEGIN
  INSERT INTO dohash () VALUES ();
  SET NEW.mykey = MD5('fa'+LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_follow`
--

CREATE TABLE IF NOT EXISTS `users_follow` (
  `id` bigint(25) NOT NULL,
  `followed_username` varchar(111) DEFAULT NULL,
  `followed_ukey` varchar(111) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_follow`
--

INSERT INTO `users_follow` (`id`, `followed_username`, `followed_ukey`, `username`, `ukey`, `date`) VALUES
(20, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'anezscarlet', '1385974ed5904a438616ff7bdb3f7439', '2017-01-20 16:37:15'),
(25, 'anezscarlet', '1385974ed5904a438616ff7bdb3f7439', 'jokowi', '1d7f7abc18fcb43975065399b0d1e48e', '2017-01-22 23:08:48'),
(26, 'anezscarlet', '1385974ed5904a438616ff7bdb3f7439', 'huhu', 'eecca5b6365d9607ee5a9d336962c534', '2017-01-22 23:49:33'),
(28, 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'jokowi', '1d7f7abc18fcb43975065399b0d1e48e', '2017-01-23 10:47:23'),
(32, 'anezscarlet', '1385974ed5904a438616ff7bdb3f7439', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '2017-02-14 10:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(23, 22, 2),
(24, 23, 2),
(25, 24, 2),
(26, 25, 2),
(27, 26, 2),
(28, 27, 2),
(29, 28, 2),
(30, 29, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_paw`
--

CREATE TABLE IF NOT EXISTS `users_paw` (
  `id` bigint(25) NOT NULL,
  `paw_point` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `ukey` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_post`
--

CREATE TABLE IF NOT EXISTS `users_post` (
  `id` bigint(25) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `url` varchar(225) DEFAULT NULL,
  `image` text,
  `description` text,
  `content` longtext,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL,
  `ckey` varchar(111) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `viewer` bigint(25) DEFAULT NULL,
  `ispublish` enum('Y','N') DEFAULT 'Y',
  `tkey` varchar(111) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_post`
--

INSERT INTO `users_post` (`id`, `title`, `url`, `image`, `description`, `content`, `username`, `ukey`, `ckey`, `date`, `viewer`, `ispublish`, `tkey`) VALUES
(1, 'Membaca Tulisan', 'membaca-tulisan', 'df3ef449387bb2ff0617630af8cade06.png', '', '<p>beginilah cara membaca tulisan Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'fzx', '2017-01-22 01:42:47', 52, 'Y', NULL),
(2, 'Cara Membuat Ayam Goreng Enak', 'cara-membuat-ayam-goreng-enak', 'eb8a8ab926c18988615b3ab28d0ed6ea.jpg', 'Cara Membuat Ayam Goreng Enak', '<p>beginilah ayam di beginikan dengan cara beginilah cara membaca tulisan Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', '23tqwtra', '2017-01-24 08:40:41', 56, 'Y', NULL),
(6, 'Bagaimana Manusia Bernafas Didalam Air', 'bagaimana-manusia-bernafas-didalam-air', '254cd3bd22d92eb19c3bbb7e7561d6fb.png', 'Bagaimana cara manusia bernafas didalam air, dan bagaimana cara mengubah plankton menjadi oksigen secara tepat', '<p>Bagaimana <strong>cara manusia</strong> bernafas didalam air, dan <strong>bagaimana </strong>cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipuip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.afas didalam air, dan bagaimana cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Bagaimana cara manusia bernafas didalam air, dan bagaimana cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipuip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.afas didalam air, dan bagaimana cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Bagaimana cara manusia bernafas didalam air, dan bagaimana cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.ation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Bagaimana cara manusia bernafas didalam air, dan bagaimana cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipuip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.afas didalam air, dan bagaimana cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Bagaimana cara manusia bernafas didalam air, dan bagaimana cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.ation ullamco laboris</p>\r\n\r\n<p>Bagaimana <strong>cara manusia</strong> bernafas didalam air, dan <strong>bagaimana </strong>cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.ation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Bagaimana <strong>cara manusia</strong> bernafas didalam air, dan <strong>bagaimana </strong>cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipuip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.afas didalam air, dan <strong>bagaimana </strong>cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Bagaimana <strong>cara manusia</strong> bernafas didalam air, dan <strong>bagaimana </strong>cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.ation ullamco laboris nisi ut aliquip ex ea commodo  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Bagaimana <strong>cara manusia</strong> bernafas didalam air, dan <strong>bagaimana </strong>cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectere eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Bagaimana <strong>cara manusia</strong> bernafas didalam air, dan <strong>bagaimana </strong>cara mengubah plankton menjadi oksigen secara tepat<br>\r\nLorem ipsum dolor sit amet, consectere eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c', 'faw', '2017-03-17 20:47:24', 16, 'Y', NULL);

--
-- Triggers `users_post`
--
DELIMITER $$
CREATE TRIGGER `do_post` BEFORE INSERT ON `users_post`
 FOR EACH ROW BEGIN
  INSERT INTO dohash () VALUES ();
  SET NEW.ckey = MD5('fa'+LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_topics`
--

CREATE TABLE IF NOT EXISTS `users_topics` (
  `id` bigint(25) NOT NULL,
  `topic_id` varchar(111) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `ukey` varchar(111) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_topics`
--

INSERT INTO `users_topics` (`id`, `topic_id`, `username`, `ukey`) VALUES
(1, 'social', 'ruby', 'a87xff679a2f32e71d9181a667b7542xg122c');

-- --------------------------------------------------------

--
-- Table structure for table `whoactwhat`
--

CREATE TABLE IF NOT EXISTS `whoactwhat` (
  `id` bigint(25) NOT NULL,
  `type` int(2) DEFAULT NULL,
  `ckey` varchar(224) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `todo` text
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `whoactwhat`
--

INSERT INTO `whoactwhat` (`id`, `type`, `ckey`, `date`, `todo`) VALUES
(1, 0, 'eb160de1de89d9058fcb0b968dbbbd68', '20170120160345', NULL),
(2, 0, '65ded5353c5ee48d0b7d48c591b8f430', '20170120183553', NULL),
(3, 0, '9b8619251a19057cff70779273e95aa6', '20170120185159', NULL),
(4, 0, '42a0e188f5033bc65bf8d78622277c4e', '20170121132329', NULL),
(5, 0, '149e9677a5989fd342ae44213df68868', '20170123061653', NULL),
(6, 0, '006f52e9102a8d3be2fe5614f42ba989', '20170123062955', NULL),
(7, 0, '8f53295a73878494e9bc8dd6c3c7104f', '20170123065357', NULL),
(8, 0, '31fefc0e570cb3860f2a6d4b38c6490d', '20170123070920', NULL),
(9, 0, 'b3e3e393c77e35a4a3f3cbd1e429b5dc', '20170123071244', NULL),
(10, 0, 'fa7cdfad1a5aaf8370ebeda47a1ff1c3', '20170123084824', NULL),
(11, 0, '84d9ee44e457ddef7f2c4f25dc8fa865', '20170214171730', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `answers_comments`
--
ALTER TABLE `answers_comments`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `answers_comments_reply`
--
ALTER TABLE `answers_comments_reply`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `answers_votes`
--
ALTER TABLE `answers_votes`
  ADD KEY `id` (`id`);

--
-- Indexes for table `dohash`
--
ALTER TABLE `dohash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lftp`
--
ALTER TABLE `lftp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_follow`
--
ALTER TABLE `log_follow`
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions_comments`
--
ALTER TABLE `questions_comments`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions_edits`
--
ALTER TABLE `questions_edits`
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions_files`
--
ALTER TABLE `questions_files`
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions_pass`
--
ALTER TABLE `questions_pass`
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions_places`
--
ALTER TABLE `questions_places`
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions_topics`
--
ALTER TABLE `questions_topics`
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions_votes`
--
ALTER TABLE `questions_votes`
  ADD KEY `id` (`id`);

--
-- Indexes for table `saved_timeline`
--
ALTER TABLE `saved_timeline`
  ADD KEY `id` (`id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_follow`
--
ALTER TABLE `users_follow`
  ADD KEY `id` (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `users_paw`
--
ALTER TABLE `users_paw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_post`
--
ALTER TABLE `users_post`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users_topics`
--
ALTER TABLE `users_topics`
  ADD KEY `id` (`id`);

--
-- Indexes for table `whoactwhat`
--
ALTER TABLE `whoactwhat`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `answers_comments`
--
ALTER TABLE `answers_comments`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `answers_comments_reply`
--
ALTER TABLE `answers_comments_reply`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `answers_votes`
--
ALTER TABLE `answers_votes`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=227;
--
-- AUTO_INCREMENT for table `dohash`
--
ALTER TABLE `dohash`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lftp`
--
ALTER TABLE `lftp`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT COMMENT 'Log From This Place';
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_follow`
--
ALTER TABLE `log_follow`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `questions_comments`
--
ALTER TABLE `questions_comments`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `questions_edits`
--
ALTER TABLE `questions_edits`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `questions_files`
--
ALTER TABLE `questions_files`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions_pass`
--
ALTER TABLE `questions_pass`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions_places`
--
ALTER TABLE `questions_places`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions_topics`
--
ALTER TABLE `questions_topics`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions_votes`
--
ALTER TABLE `questions_votes`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `saved_timeline`
--
ALTER TABLE `saved_timeline`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `users_follow`
--
ALTER TABLE `users_follow`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users_paw`
--
ALTER TABLE `users_paw`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_post`
--
ALTER TABLE `users_post`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users_topics`
--
ALTER TABLE `users_topics`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `whoactwhat`
--
ALTER TABLE `whoactwhat`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
