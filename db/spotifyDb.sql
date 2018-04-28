-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2018 at 08:03 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artists` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artists`, `genre`, `artworkPath`) VALUES
(1, 'Bacon and Eggs', 2, 4, 'assets/images/artwork/clearday.jpg'),
(2, 'Pizza Head', 5, 10, 'assets/images/artwork/energy.jpg'),
(3, 'Funky Element', 3, 6, 'assets/images/artwork/funkyelement.jpg'),
(4, 'Going Higher', 1, 1, 'assets/images/artwork/goinghigher.jpg'),
(5, 'Pop Dance', 4, 2, 'assets/images/artwork/popdance.jpg'),
(6, 'Sweet', 6, 4, 'assets/images/artwork/sweet.jpg'),
(7, 'Ukulele', 7, 5, 'assets/images/artwork/ukulele.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Mickey Mouse'),
(2, 'Goofy'),
(3, 'Bart Simpson'),
(4, 'Homer'),
(5, 'Bruce Lee'),
(6, 'Beyonce'),
(7, 'Jay z');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Hip Hop'),
(4, 'Rap'),
(5, 'R & B'),
(6, 'Classical'),
(7, 'Techno'),
(8, 'Jazz'),
(9, 'Folk'),
(10, 'Country');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(3, 'my playlist', 'tuvshinot', '2018-04-27 00:00:00'),
(4, 'classic', 'tuvshinot', '2018-04-28 00:00:00'),
(5, 'jazz', 'tuvshinot', '2018-04-28 00:00:00'),
(6, 'fav', 'tuvshinot', '2018-04-28 00:00:00'),
(7, 'My first One', 'anuka', '2018-04-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `id` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(4, 3, 3, 2),
(5, 36, 3, 3),
(8, 31, 3, 4),
(15, 23, 6, 0),
(16, 38, 6, 1),
(17, 16, 6, 2),
(18, 22, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artists` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artists`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'acoustic breeze', 2, 1, 4, '2:37', 'assets/music/bensound-acousticbreeze.mp3', 1, 8),
(2, 'a new beginning', 2, 1, 4, '2:34', 'assets/music/bensound-anewbeginning.mp3', 2, 12),
(3, 'better days', 2, 1, 4, '2:33', 'assets/music/bensound-betterdays.mp3', 3, 3),
(4, 'buddy', 2, 1, 4, '2:02', 'assets/music/bensound-buddy.mp3', 4, 2),
(5, 'clearday', 2, 1, 4, '1:29', 'assets/music/bensound-clearday.mp3', 5, 6),
(16, 'cute', 5, 2, 10, '3:14', 'assets/music/bensound-cute.mp3', 1, 5),
(17, 'dubster', 5, 2, 10, '2:04', 'assets/music/bensound-dubstep.mp3', 2, 5),
(18, 'energy', 5, 2, 10, '2:59', 'assets/music/bensound-energy.mp3', 3, 10),
(19, 'epic', 5, 2, 10, '2:58', 'assets/music/bensound-epic.mp3', 4, 7),
(20, 'extremeaction', 5, 2, 10, '8:03', 'assets/music/bensound-extremeaction.mp3', 5, 6),
(21, 'funkyelement', 3, 3, 6, '3:09', 'assets/music/bensound-funkyelement.mp3', 1, 8),
(22, 'funnysong', 3, 3, 6, '3:07', '		\r\nassets/music/bensound-funnysong.mp3\r\n', 2, 42),
(23, 'Go higher', 3, 3, 6, '4:04', '		\r\nassets/music/bensound-goinghigher.mp3\r\n', 3, 14),
(24, 'Happy', 3, 3, 6, '4:21', '		\r\nassets/music/bensound-happiness.mp3\r\n', 4, 6),
(25, 'Happy Rock', 3, 3, 6, '1:45', '		\r\nassets/music/bensound-happyrock.mp3\r\n', 5, 1),
(26, 'jazzy', 1, 4, 1, '1:44', 'assets/music/bensound-jazzyfrenchy.mp3', 1, 7),
(27, 'little idea', 1, 4, 1, '2:49', 'assets/music/bensound-littleidea.mp3', 2, 3),
(28, 'memories', 1, 4, 1, '3:50', 'assets/music/bensound-memories.mp3', 3, 12),
(29, 'moose', 1, 4, 1, '2:40', 'assets/music/bensound-moose.mp3', 4, 4),
(30, 'november', 1, 4, 1, '3:32', 'assets/music/bensound-november.mp3', 5, 10),
(31, 'Dream', 4, 5, 2, '4:58', 'assets/music/bensound-ofeliasdream.mp3', 1, 4),
(32, 'pop dance', 4, 5, 2, '2:42', 'assets/music/bensound-popdance.mp3', 2, 2),
(33, 'retro soul', 4, 5, 2, '3:36', 'assets/music/bensound-retrosoul.mp3', 3, 12),
(34, 'sadday', 4, 5, 2, '2:28', 'assets/music/bensound-sadday.mp3', 4, 5),
(35, 'scifi', 4, 5, 2, '4:44', 'assets/music/bensound-scifi.mp3', 5, 8),
(36, 'slowmotion', 6, 6, 4, '3:26', 'assets/music/bensound-slowmotion.mp3', 1, 15),
(37, 'sunny', 6, 6, 4, '2:20', 'assets/music/bensound-sunny.mp3', 2, 13),
(38, 'sweet', 6, 6, 4, '5:07', 'assets/music/bensound-sweet.mp3', 3, 7),
(39, 'tenderness', 6, 6, 4, '2:03', 'assets/music/bensound-tenderness.mp3', 4, 9),
(40, 'lounge', 6, 6, 4, '4:16', 'assets/music/bensound-thelounge.mp3', 5, 12),
(41, 'tommorrow', 7, 7, 5, '4:54', 'assets/music/bensound-tomorrow.mp3', 1, 5),
(42, 'ukulele', 7, 7, 5, '2:26', 'assets/music/bensound-ukulele.mp3', 2, 11),
(43, 'memories', 7, 7, 5, '3:50', 'assets/music/bensound-memories.mp3', 3, 10),
(44, 'moose', 7, 7, 5, '2:40', 'assets/music/bensound-moose.mp3', 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(1, 'tuvshinot', 'Tuvshin', 'Otgon', 'Ronin.xe@gmail.com', 'e99a18c428cb38d5f260853678922e03', '2018-04-15 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(2, 'donkey', 'Reece', 'Kenny', 'Reece@gmail.com', 'a141c47927929bc2d1fb6d336a256df4', '2018-04-15 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(4, 'Anuka', 'Anu', 'Ogton', 'anuka@gmail.com', 'd5d0a41c6fc08bec0cfa49d4eb9b1f11', '2018-04-15 00:00:00', 'assets/images/profile-pics/head_emerald.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
