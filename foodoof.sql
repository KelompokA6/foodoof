-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2015 at 08:06 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

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
  `price` int(11) DEFAULT '0',
  PRIMARY KEY (`name`,`units`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `recipe_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`recipe_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `recipe_id` int(10) unsigned NOT NULL,
  `description` text,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `recipe_id` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cooklater`
--

CREATE TABLE IF NOT EXISTS `cooklater` (
  `recipe_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`recipe_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `recipe_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`recipe_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `recipe_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `quantity` int(11) DEFAULT NULL,
  `units` varchar(30) DEFAULT NULL,
  `info` text,
  PRIMARY KEY (`recipe_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`, `units`, `info`) VALUES
(1, 'Air perasan jeruk nipis', 3, 'sdm', NULL),
(1, 'Ayam', 1, 'ekor', NULL),
(1, 'Bawang putih', 10, 'siung', NULL),
(1, 'Daun jeruk', 5, 'lembar', NULL),
(1, 'Daun salam', 2, 'lembar', NULL),
(1, 'Garam', NULL, 'secukupnya', NULL),
(1, 'Jahe', 2, 'ruas jari', NULL),
(1, 'Kemiri', 5, 'butir', NULL),
(1, 'Kunyit', 1, 'ruas jari', NULL),
(1, 'Lengkuas', 75, 'gram', NULL),
(1, 'Serai', 1, 'batang', NULL),
(2, 'air', 1, 'gelas', NULL),
(2, 'air jeruk nipis', 1, 'sdm', NULL),
(2, 'bawang merah', 4, 'siung', NULL),
(2, 'bawang putih', 6, 'siung', NULL),
(2, 'cabai merah besar', 3, 'buah', NULL),
(2, 'cabai rawit', NULL, 'sesuai selera', NULL),
(2, 'daun jeruk', 1, 'lembar', NULL),
(2, 'gula dan garam', NULL, 'secukupnya', NULL),
(2, 'kemangi', NULL, 'secukupnya', NULL),
(2, 'minyak goreng', 3, 'sdm', NULL),
(2, 'tepung terigu', 2, 'sdm', NULL),
(2, 'tomat', 1, 'buah', NULL),
(2, 'udang', 250, 'gram', NULL),
(3, 'air', NULL, 'secukupnya', NULL),
(3, 'bawang merah', 3, 'siung', NULL),
(3, 'bawang putih', 5, 'siung', NULL),
(3, 'gula garam', NULL, 'secukupnya', NULL),
(3, 'jinten', 1, 'sdt', NULL),
(3, 'kecap manis', 3, 'sdm', NULL),
(3, 'kekian', 150, 'gram', NULL),
(3, 'kemiri', 1, 'buah', NULL),
(3, 'kentang', 250, 'gram', NULL),
(3, 'kulit lumpia', 10, 'lembar', NULL),
(3, 'merica butiran', 1, 'sdt', NULL),
(3, 'saos tiram', 1, 'sdt', NULL),
(3, 'saos tomat', 4, 'sdm', NULL),
(4, 'keju parut', NULL, 'sesuka hati', NULL),
(4, 'minyak untuk menggoreng', NULL, 'secukupnya', NULL),
(4, 'palm sugar', NULL, 'sesuka hati', NULL),
(4, 'pisang sanggar', 7, 'buah', NULL),
(4, 'raw honey', NULL, 'secukupnya', NULL),
(4, 'tepung terigu/beras', NULL, 'secukupnya', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` int(10) unsigned NOT NULL,
  `description` mediumtext,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`,`conversation_id`),
  KEY `conversation_id` (`conversation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `value` decimal(3,2) unsigned NOT NULL,
  PRIMARY KEY (`recipe_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `portion` int(10) unsigned DEFAULT NULL,
  `duration` int(10) unsigned DEFAULT NULL,
  `author` int(10) unsigned NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rating` decimal(3,2) unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `photo` mediumtext,
  `highlight` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `author` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `portion`, `duration`, `author`, `create_date`, `last_update`, `rating`, `status`, `views`, `photo`, `highlight`) VALUES
(1, 'Ayam Goreng Bumbu Lengkuas', 'Ayam goreng bumbu lengkuas ini biasanya dihidangkan berdampingan dengan rendang pada acara-acara besar, seperti acara pernikahan dan perayaan khatam Al-Qur''an. Selain itu menu ini juga tersedia di rumah makan Padang yang bertebaran di seantero penjuru tanah air. Dengan resep ini kita pun bisa membuatnya di rumah tanpa harus menunggu ada hajatan ataupun pergi ke rumah makan.. ;)', 8, 1, 3, '2015-03-30 03:58:52', '2015-03-30 03:58:52', NULL, 1, 0, NULL, 0),
(2, 'Spices-Shrimp (udang balado)', 'Resep ini tercipta karna LAPAR :D *apaan sih* Lgsg simak aja,cekidot~', 3, 10, 4, '2015-03-30 04:15:34', '2015-03-30 04:15:34', NULL, 1, 0, NULL, 0),
(3, 'Mini Kebab Veggie', 'Saya tau kebab ini dari orang jualan kebab di SD dekat kampus. Berbekal ingatan "taste" rasanya,akhirnya nemu juga resep yg sesuai bahkan lebih enak jauuuuhhh~ *GR*', 10, 20, 4, '2015-03-30 04:24:21', '2015-03-30 04:24:21', NULL, 1, 0, NULL, 0),
(4, 'Pisang keju madu ala Diaz', 'ceritanya punya sisa pisang abis dibikin kolak, pengen bikin masakan yang gampang. akhirnya bikin pisang keju deh... hehee', 7, 20, 5, '2015-03-30 04:38:47', '2015-03-30 04:38:47', NULL, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `reason` text,
  `submit` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE IF NOT EXISTS `steps` (
  `recipe_id` int(10) unsigned NOT NULL,
  `no_step` tinyint(3) unsigned NOT NULL,
  `description` text,
  `photo` mediumtext,
  PRIMARY KEY (`recipe_id`,`no_step`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`recipe_id`, `no_step`, `description`, `photo`) VALUES
(1, 1, 'Cuci bersih ayam, kemudian lumuri dengan air jeruk nipis dan garam secukupnya. Diamkan sekitar 15 menit dan cuci lagi.', NULL),
(1, 2, 'Campur ayam dengan bumbu halus, lengkuas parut dan daun-daun kemudian rebus dengan air secukupnya.', NULL),
(1, 3, 'Rebus ayam sampai empuk dan airnya mengering. Langkah ini cukup dengan menggunakan api sedang saja.', NULL),
(1, 4, 'Panaskan minyak dalam wajan kemudian goreng ayam sampai berwarna kecoklatan.Angkat dan tiriskan.', NULL),
(1, 5, 'Kemudian goreng semua sisa bumbu rebusan tadi sampai kering dan berwarna kecoklatan. Angkat dan tiriskan.', NULL),
(1, 6, 'Ayam goreng siap dinikmati dengan bumbunya.', NULL),
(2, 1, 'cuci bersih udang,buang kotorannya. Beri perasan jeruk nipis dan sedikit garam lalu sisihkan', NULL),
(2, 2, 'haluskan bawang putih,bawang merah,cabai merah besar dan cabai rawit.', NULL),
(2, 3, 'campur udang dgn 1 sdm tepung terigu dan goreng sebentar (resep asli tanpa dgoreng dgn tepung,karna aku pngn ad crispy waktu dmakan,jd aku modifikasi sendiri resepku,"̮ ƗƗɐƗƗɐƗƗɐ "̮ ƗƗɐƗƗɐƗƗɐ "̮) lalu tiriskan', NULL),
(2, 4, 'tumis bumbu halus dgn sedikit minyak,aduk sampai wangi,tambahkan gula+garam dan daun jeruk.', NULL),
(2, 5, 'tambahkan air secukupnya,aduk sebentar,lalu masukkan udang.', NULL),
(2, 6, 'setelah sambal balado agak mengering,masukkan potongan tomat dan kemangi', NULL),
(2, 7, 'Udang balado ready to eat. NyamNyam~', NULL),
(3, 1, 'Kukus kentang dan kekian sampai matang. Haluskan kentang,sisihkan. Potong dadu kekian,sisihkan.', NULL),
(3, 2, 'Haluskan : bawang putih,bawang merah,kemiri,merica,jinten.', NULL),
(3, 3, 'Tumis bumbu halus,tambahkan sedikit air,aduk sampai wangi', NULL),
(3, 4, 'Masukkan kentang halus,aduk rata', NULL),
(3, 5, 'Bumbui dgn gula dan garam,masukkan kecap manis,saos tomat,saos tiram.', NULL),
(3, 6, 'Aduk sampai mengental,kalo dirasa terlalu kurang kalis bisa ditambah air sedikit. Sisihkan tunggu dingin', NULL),
(3, 7, 'Siapkan kulit lumpia,isi dengan kentang dan beri potongan kekian. Gulung dan ujungnya rekatkan dengan air (gak usah ditekuk seperti lumpia ya,cukup digulung aja)', NULL),
(3, 8, 'Panaskan sedikit mentega pada teflon,panggang kebab veggie sampai matang kecoklatan', NULL),
(3, 9, 'Mini kebab veggie ready to eat :) sajikan dgn mayones+saos tomat/saos sambal. NyamNyam~', NULL),
(4, 1, 'kupas pisang, potong memanjang menjadi dua bagian, sishkan', NULL),
(4, 2, 'buat adonan tepung celupan. campurkan tepung terigu, beri sedikir garam dan gula. celupkan pisang sanggar, goreng hingga kecoklatan. angkat dan tiriskan.', NULL),
(4, 3, 'saat pisang masih panas, beri taburan madu, palm sugar dan parutan keju. sajikan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` text,
  `password` text NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'MEMBER',
  `photo` mediumtext,
  `last_access` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `gplus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `gender`, `bdate`, `phone`, `status`, `photo`, `last_access`, `twitter`, `facebook`, `gplus`) VALUES
(1, '0', '0', 'jean', '0', '0000-00-00', '0', 'MEMBER', '0', '2015-03-28 08:27:44', NULL, NULL, ''),
(2, 'je.fathanah@gmail.com', 'jean', 'jeanjean', NULL, NULL, NULL, 'MEMBER', NULL, '2015-03-28 08:55:08', NULL, NULL, ''),
(3, 'Biyay.AtharSabai@gmail.com', 'Biyay AtharSabai', 'masakmasak', 'f', NULL, NULL, 'MEMBER', NULL, '2015-03-30 03:56:29', NULL, NULL, ''),
(4, 'amel@gmail.com', 'ameLicious~', 'masakmasak', 'f', NULL, NULL, 'MEMBER', NULL, '2015-03-30 04:12:59', NULL, NULL, ''),
(5, 'Diaz.Adzky@gmail.com', 'Diaz Adzky', 'masakmasak', 'm', NULL, NULL, 'MEMBER', NULL, '2015-03-30 04:36:30', NULL, NULL, '');

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
