-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2015 at 11:49 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `foodoof`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalogs`
--

CREATE TABLE IF NOT EXISTS `catalogs` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `units` varchar(30) NOT NULL DEFAULT '',
  `price` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `recipe_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `recipe_id` int(10) unsigned NOT NULL,
  `description` text,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cooklater`
--

CREATE TABLE IF NOT EXISTS `cooklater` (
  `recipe_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `recipe_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `recipe_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `quantity` decimal(2,1) DEFAULT '0.0',
  `units` varchar(30) DEFAULT NULL,
  `info` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`, `units`, `info`) VALUES
(12, 'Air', '3.0', 'sdm', NULL),
(12, 'Air perasan jeruk nipis', '3.0', 'sdm', NULL),
(13, 'Air perasan jeruk nipis', '3.0', 'sdm', NULL),
(15, 'caos', '3.0', 'a', NULL),
(15, 'kambing', '3.0', 'sdm', NULL),
(16, 'Air perasan jeruk nipis', '3.0', 'sdm', NULL),
(17, 'kambing', '3.0', 'sdm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`message_id` bigint(20) unsigned NOT NULL,
  `conversation_id` int(10) unsigned NOT NULL,
  `description` mediumtext,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `recipe_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `value` decimal(2,1) unsigned NOT NULL DEFAULT '0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `rating`
--
DELIMITER //
CREATE TRIGGER `avg_rating_delete` AFTER DELETE ON `rating`
 FOR EACH ROW UPDATE recipes SET rating = (SELECT AVG(rating.value) from rating where rating.recipe_id=recipes.id) WHERE recipes.id=OLD.recipe_id
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `avg_rating_insert` AFTER INSERT ON `rating`
 FOR EACH ROW UPDATE recipes SET rating = (SELECT AVG(rating.value) from rating where rating.recipe_id=recipes.id) WHERE recipes.id=NEW.recipe_id
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `avg_rating_update` AFTER UPDATE ON `rating`
 FOR EACH ROW UPDATE recipes SET rating = (SELECT AVG(rating.value) from rating where rating.recipe_id=recipes.id) WHERE recipes.id=NEW.recipe_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
`id` int(10) unsigned NOT NULL,
  `name` text,
  `description` text,
  `portion` int(10) unsigned DEFAULT '1',
  `duration` int(10) unsigned DEFAULT '0',
  `author` int(10) unsigned NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rating` decimal(2,1) unsigned NOT NULL DEFAULT '0.0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `tmp_status` tinyint(1) NOT NULL DEFAULT '1',
  `views` int(11) NOT NULL DEFAULT '0',
  `photo` text,
  `highlight` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `portion`, `duration`, `author`, `create_date`, `last_update`, `rating`, `status`, `tmp_status`, `views`, `photo`, `highlight`) VALUES
(12, 'Ayam Goreng Bumbu Lengkuas', 'Ayam bakar', 1, 5, 1, '2015-04-11 08:12:02', '2015-04-10 17:00:00', '0.0', 0, 1, 0, 'images/recipe/12.jpg', 0),
(13, 'Ayam godog', 'masak', 4, 5, 1, '2015-04-11 08:13:59', '2015-04-10 17:00:00', '0.0', 0, 1, 0, 'images/recipe/13.jpg', 0),
(15, 'Kambing guling', 'ayam guling', 4, 12, 1, '2015-04-11 08:21:00', '2015-04-10 17:00:00', '0.0', 0, 1, 0, 'images/recipe/15.jpg', 0),
(16, 'Ayam Goreng Bumbu Lengkuas', 'dskripsi', 1, 4, 1, '2015-04-11 08:23:22', '2015-04-10 17:00:00', '0.0', 0, 1, 0, 'images/recipe/16.jpg', 0),
(17, 'Ayam Goreng Bumbu', 'deskripsi', 4, 9, 1, '2015-04-11 09:13:37', '2015-04-11 09:13:37', '0.0', 0, 1, 0, 'assets/img/recipe-default.jpg', 0),
(18, NULL, NULL, 1, 0, 1, '2015-04-11 08:56:21', '2015-04-11 08:56:21', '0.0', 0, 1, 0, '/assets/img/recipe-default.jpg', 0),
(19, NULL, NULL, 1, 0, 1, '2015-04-11 09:38:51', '2015-04-11 09:38:51', '0.0', 0, 1, 0, '/assets/img/recipe-default.jpg', 0);

--
-- Triggers `recipes`
--
DELIMITER //
CREATE TRIGGER `add_recipe_default` BEFORE INSERT ON `recipes`
 FOR EACH ROW if (NEW.photo is null ) then set NEW.photo = '/assets/img/recipe-default.jpg'; end if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `reason` text,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE IF NOT EXISTS `steps` (
  `recipe_id` int(10) unsigned NOT NULL,
  `no_step` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `description` text,
  `photo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`recipe_id`, `no_step`, `description`, `photo`) VALUES
(12, 1, 'asdasd', 'assets/img/step-default.jpg'),
(12, 2, 'Sampah', 'images/step/12-2.jpg'),
(13, 1, 'asdasd', 'assets/img/step-default.jpg'),
(15, 1, 'asdasd', 'assets/img/step-default.jpg'),
(16, 1, 'asdasd', 'assets/img/step-default.jpg'),
(17, 1, 'asdasd', 'assets/img/step-default.jpg');

--
-- Triggers `steps`
--
DELIMITER //
CREATE TRIGGER `add_step_default` BEFORE INSERT ON `steps`
 FOR EACH ROW if (NEW.photo is null ) then set NEW.photo = 'assets/img/step-default.jpg'; end if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` text,
  `password` text NOT NULL,
  `gender` varchar(1) DEFAULT 'f',
  `bdate` date DEFAULT '1970-01-01',
  `phone` varchar(20) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'MEMBER',
  `photo` text,
  `facebook` text,
  `twitter` text,
  `googleplus` text,
  `path` text,
  `last_access` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `gender`, `bdate`, `phone`, `status`, `photo`, `facebook`, `twitter`, `googleplus`, `path`, `last_access`) VALUES
(1, 'admin', 'admin', 'lAXRpW8GKBPmIENej39btL8ggO+ckmqoimiTTOhGS1BMcINPgzDfeFPu6eCfoPcE2o8m8wK/GSzzqPDRFcpGMA==', 'F', '1970-01-01', NULL, 'MEMBER', 'assets/img/user-female.jpg', NULL, NULL, NULL, NULL, '2015-04-11 07:38:27');

--
-- Triggers `users`
--
DELIMITER //
CREATE TRIGGER `add_user_default` BEFORE INSERT ON `users`
 FOR EACH ROW if (LOWER(NEW.gender) = 'f' ) then set NEW.photo = 'assets/img/user-female.jpg'; elseif (LOWER(NEW.gender) = 'm' ) then set NEW.photo = 'assets/img/user-male.jpg'; end if
//
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalogs`
--
ALTER TABLE `catalogs`
 ADD PRIMARY KEY (`name`,`units`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`recipe_id`,`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
 ADD PRIMARY KEY (`id`,`user_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cooklater`
--
ALTER TABLE `cooklater`
 ADD PRIMARY KEY (`recipe_id`,`user_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
 ADD PRIMARY KEY (`recipe_id`,`user_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
 ADD PRIMARY KEY (`recipe_id`,`name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`message_id`,`conversation_id`), ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
 ADD PRIMARY KEY (`recipe_id`,`user_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
 ADD PRIMARY KEY (`id`), ADD KEY `author` (`author`), ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `steps`
--
ALTER TABLE `steps`
 ADD PRIMARY KEY (`recipe_id`,`no_step`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`,`email`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `message_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cooklater`
--
ALTER TABLE `cooklater`
ADD CONSTRAINT `cooklater_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `cooklater_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `steps`
--
ALTER TABLE `steps`
ADD CONSTRAINT `steps_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
