-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql102.byetcluster.com
-- Generation Time: Jun 07, 2022 at 03:21 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_31470951_arabseed`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Arabic movies', ''),
(2, 'English movies', ''),
(3, 'turkish  movies', ''),
(4, 'indian  movies', ''),
(5, 'Netflix  movies', ''),
(6, 'مسلسلات رمضان 2020', ''),
(7, 'مسلسلات عربى', ''),
(8, 'مسلسلات رمضان 2020', ''),
(9, 'مسلسلات هندى', ''),
(10, 'مسلسلات اجنبى', ''),
(11, 'مسلسلات تركى', ''),
(12, 'برامج', ''),
(17, 'movies', ''),
(19, 'new category', ''),
(20, 'new category', '');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Egypt'),
(2, 'USA'),
(3, 'SAUDI ARABIA'),
(4, 'UK'),
(5, 'INDIA'),
(6, 'TURKEY');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`) VALUES
(1, 'ARABIC'),
(2, 'ENGLISH'),
(3, 'INDIAN'),
(4, 'TURKISH');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(112) NOT NULL,
  `description` varchar(112) DEFAULT NULL,
  `release_date` date NOT NULL,
  `country_id` smallint(5) UNSIGNED NOT NULL,
  `language_id` smallint(5) UNSIGNED NOT NULL,
  `image` varchar(45) NOT NULL,
  `label` varchar(60) DEFAULT NULL,
  `rate` decimal(4,2) DEFAULT NULL,
  `tags` varchar(222) DEFAULT NULL,
  `streaming_links` varchar(222) DEFAULT NULL,
  `download_links` varchar(222) DEFAULT NULL,
  `run_time` time DEFAULT NULL,
  `upload_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `category_id`, `name`, `description`, `release_date`, `country_id`, `language_id`, `image`, `label`, `rate`, `tags`, `streaming_links`, `download_links`, `run_time`, `upload_date`) VALUES
(1, 2, 'Doctor strange multiverse', 'New adventure of dr strange at the multiverse', '2022-05-06', 2, 2, 'pic.jpg', 'translated to arabic', '7.50', '1,2,3', 'www.stream1server.com', 'www.download1server.com', '00:50:45', '2022-05-06'),
(2, 1, 'Ismail Yaseen in army', 'New adventure of ismail yaseen in army', '1990-01-01', 1, 1, 'pic.jpg', NULL, NULL, NULL, 'www.stream2server.com', 'www.download2server.com', '02:30:00', '2022-05-06'),
(3, 8, 'مسلسل الكبير قوى الجزء السابع', 'مسلسل تدور احداثه الكوميدية فى المزاريطة', '2022-04-01', 1, 1, 'keber_pic.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 10, 'mandalorian', 'new saga of mandalorian', '2019-04-01', 2, 2, 'mando_pic.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `show_episodes`
--

CREATE TABLE `show_episodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `show_id` int(10) UNSIGNED NOT NULL,
  `episode_number` smallint(5) UNSIGNED NOT NULL,
  `episode_number_literally` varchar(112) NOT NULL,
  `label` varchar(60) DEFAULT NULL,
  `upload_date` date NOT NULL,
  `download_links` varchar(222) NOT NULL,
  `streaming_links` varchar(222) NOT NULL,
  `run_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `show_episodes`
--

INSERT INTO `show_episodes` (`id`, `show_id`, `episode_number`, `episode_number_literally`, `label`, `upload_date`, `download_links`, `streaming_links`, `run_time`) VALUES
(1, 3, 22, 'twenty two', 'last episode', '2022-05-06', 'www.series_download_server1.com', 'www.series_stream_server1.com', '01:10:00'),
(2, 4, 5, 'five', 'Translated to arabic', '2022-05-06', 'www.series_download_server2.com', 'www.series_stream_server2.com', '01:00:00'),
(3, 3, 30, 'الحلقة الثلاثون والاخيرة', 'الاخيرة', '2022-05-01', 'download_links.com', 'stream_links.com', '00:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Drama'),
(2, 'Action'),
(3, 'Comedy'),
(4, 'Romantic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movies_category_id` (`category_id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `show_episodes`
--
ALTER TABLE `show_episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `show_episodes`
--
ALTER TABLE `show_episodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `shows_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `shows_ibfk_4` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `show_episodes`
--
ALTER TABLE `show_episodes`
  ADD CONSTRAINT `show_episodes_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
