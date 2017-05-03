-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2016 at 02:31 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `dominion_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `set` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `draw` int(11) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `attack` int(11) DEFAULT NULL,
  `buy` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `interaction` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `set`, `name`, `price`, `draw`, `action`, `attack`, `buy`, `money`, `interaction`) VALUES
(1, 'base', 'cellar', 2, 1, 1, 0, 0, 0, 0),
(2, 'base', 'chapel', 2, 0, 0, 0, 0, 0, 0),
(3, 'base', 'moat', 2, 2, 2, 0, 0, 0, 0),
(4, 'base', 'chancellor', 3, 0, 2, 0, 0, 0, 0),
(5, 'base', 'village', 3, 1, 2, 0, 0, 0, 0),
(6, 'base', 'woodcutter', 3, 0, 2, 0, 0, 0, 0),
(7, 'base', 'workshop', 3, 0, 0, 0, 0, 0, 0),
(8, 'base', 'bureaucrat', 4, 0, 1, 0, 0, 0, 0),
(9, 'base', 'feast', 4, 0, 0, 0, 0, 0, 0),
(10, 'base', 'gardens', 4, 0, 0, 0, 0, 0, 0),
(11, 'base', 'militia', 4, 0, 2, 0, 0, 0, 0),
(12, 'base', 'money lender', 4, 0, 2, 0, 0, 0, 0),
(13, 'base', 'remodel', 4, 0, 0, 0, 0, 0, 0),
(14, 'base', 'smithy', 4, 3, 0, 0, 0, 0, 0),
(15, 'base', 'spy', 4, 1, 1, 0, 0, 0, 0),
(16, 'base', 'thief', 4, 0, 2, 0, 0, 0, 0),
(17, 'base', 'throne room', 4, 0, 1, 0, 0, 0, 0),
(18, 'base', 'council room', 5, 5, 2, 0, 0, 0, 0),
(19, 'base', 'festival', 5, 0, 2, 0, 0, 0, 0),
(20, 'base', 'laboratory', 5, 2, 1, 0, 0, 0, 0),
(21, 'base', 'library', 5, 3, 0, 0, 0, 0, 0),
(22, 'base', 'market', 5, 1, 1, 0, 0, 0, 0),
(23, 'base', 'mine', 5, 0, 3, 0, 0, 0, 0),
(24, 'base', 'witch', 5, 2, 3, 0, 0, 0, 0),
(25, 'base', 'adventurer', 6, 0, 3, 0, 0, 0, 0),
(76, 'intrigue', 'courtyard', 2, 2, 0, 0, 0, 0, 0),
(77, 'intrigue', 'pawn', 2, 1, 1, 0, 0, 0, 0),
(78, 'intrigue', 'secret chamber', 2, 0, 2, 0, 0, 0, 0),
(79, 'intrigue', 'great hall', 3, 1, 1, 0, 0, 0, 0),
(80, 'intrigue', 'masquerade', 3, 2, 2, 0, 0, 0, 0),
(81, 'intrigue', 'shanty town', 3, 1, 1, 0, 0, 0, 0),
(82, 'intrigue', 'steward', 3, 1, 1, 0, 0, 0, 0),
(83, 'intrigue', 'swindler', 3, 0, 2, 0, 0, 0, 0),
(84, 'intrigue', 'wishing well', 3, 0, 1, 0, 0, 0, 0),
(85, 'intrigue', 'baron', 4, 0, 3, 0, 0, 0, 0),
(86, 'intrigue', 'bridge', 4, 0, 2, 0, 0, 0, 0),
(87, 'intrigue', 'conspirator', 4, 0, 2, 0, 0, 0, 0),
(88, 'intrigue', 'coppersmith', 3, 0, 2, 0, 0, 0, 0),
(89, 'intrigue', 'ironworks', 4, 1, 1, 0, 0, 0, 0),
(90, 'intrigue', 'mining village', 4, 1, 1, 0, 0, 0, 0),
(91, 'intrigue', 'scout', 4, 0, 1, 0, 0, 0, 0),
(92, 'intrigue', 'duke', 5, 0, 0, 0, 0, 0, 0),
(93, 'intrigue', 'minion', 5, 0, 1, 0, 0, 0, 0),
(94, 'intrigue', 'saboteur', 5, 0, 3, 0, 0, 0, 0),
(95, 'intrigue', 'torturer', 5, 3, 3, 0, 0, 0, 0),
(96, 'intrigue', 'trading post', 5, 0, 1, 0, 0, 0, 0),
(97, 'intrigue', 'tribute', 5, 2, 2, 0, 0, 0, 0),
(98, 'intrigue', 'upgrade', 5, 1, 1, 0, 0, 0, 0),
(99, 'intrigue', 'harem', 6, 0, 2, 0, 0, 0, 0),
(100, 'intrigue', 'nobles', 6, 2, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `savored_games`
--

CREATE TABLE `savored_games` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_played` date NOT NULL,
  `game_length` int(11) NOT NULL,
  `winner` varchar(200) DEFAULT NULL,
  `commentary` varchar(2000) DEFAULT NULL,
  `game_cards` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savored_games`
--

INSERT INTO `savored_games` (`id`, `name`, `date_played`, `game_length`, `winner`, `commentary`, `game_cards`) VALUES
(1, 'Game of Throne Rooms', '2016-07-07', 45, 'Charles*', 'No duchy time...chain heavy...swindler is key...throne/draw chain... everyone within 1 point of each other', 'a:10:{i:101;s:6:"cellar";i:122;s:6:"market";i:103;s:4:"moat";i:117;s:11:"throne room";i:105;s:7:"village";i:201;s:9:"courtyard";i:204;s:10:"great hall";i:225;s:6:"nobles";i:202;s:4:"pawn";i:208;s:8:"swindler";}'),
(2, 'Bridge to Terebithia', '2016-07-12', 45, 'Charles', 'Slower than expected; Highly Expected Outcomes otherwise; Boring; Maybe a good starter; no attack', 'a:10:{i:125;s:10:"adventurer";i:104;s:10:"chancellor";i:102;s:6:"chapel";i:103;s:4:"moat";i:114;s:6:"smithy";i:117;s:11:"throne room";i:105;s:7:"village";i:211;s:6:"bridge";i:224;s:5:"harem";i:225;s:6:"nobles";}'),
(3, 'Marshal Law', '2016-07-12', 30, 'Charles', 'Faster than expected; A little too fast for Gardens; Militia totally key', 'a:10:{i:108;s:10:"bureaucrat";i:118;s:12:"council room";i:110;s:7:"gardens";i:111;s:7:"militia";i:107;s:8:"workshop";i:210;s:5:"baron";i:215;s:14:"mining village";i:218;s:6:"minion";i:225;s:6:"nobles";i:219;s:8:"saboteur";}'),
(4, 'Trashman', '2016-07-12', 60, 'Charles and Ari', 'Race against time until the decks are gummed up by curse cards', 'a:10:{i:102;s:6:"chapel";i:112;s:12:"money lender";i:113;s:7:"remodel";i:114;s:6:"smithy";i:124;s:5:"witch";i:213;s:11:"coppersmith";i:217;s:4:"duke";i:215;s:14:"mining village";i:220;s:8:"torturer";i:223;s:7:"upgrade";}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `savored_games`
--
ALTER TABLE `savored_games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `savored_games`
--
ALTER TABLE `savored_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;