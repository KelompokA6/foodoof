-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2015 at 07:45 AM
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

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`recipe_id`, `name`) VALUES
(1, 'indonesian food'),
(1, 'meat'),
(1, 'rice'),
(2, 'desert'),
(2, 'indonesian food'),
(2, 'snack'),
(3, 'beverage'),
(3, 'desert'),
(3, 'other'),
(4, 'noodle'),
(4, 'western food'),
(5, 'chinese food'),
(5, 'vegetarian'),
(6, 'middle-east food'),
(6, 'other'),
(6, 'snack'),
(7, 'chinese food'),
(7, 'other'),
(7, 'vegetarian'),
(8, 'indonesian food'),
(8, 'snack'),
(9, 'indonesian food'),
(9, 'other'),
(9, 'snack'),
(10, 'indonesian food'),
(10, 'seafood'),
(11, 'beverage'),
(11, 'desert'),
(11, 'other'),
(12, 'other'),
(12, 'western food'),
(13, 'desert'),
(13, 'other'),
(13, 'snack'),
(14, 'desert'),
(14, 'other'),
(14, 'snack'),
(14, 'western food'),
(15, 'chinese food'),
(15, 'meat'),
(15, 'other'),
(15, 'rice'),
(15, 'vegetarian');

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
  `quantity` decimal(8,2) DEFAULT '0.00',
  `units` varchar(30) DEFAULT NULL,
  `info` text,
  PRIMARY KEY (`recipe_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`, `units`, `info`) VALUES
(1, 'Air', '200.00', 'ml', NULL),
(1, 'Bawang Putih (cincang halus)', '1.00', 'butir', NULL),
(1, 'Daging Ayam', '300.00', 'gram', NULL),
(1, 'Garam', '0.50', 'sdt', NULL),
(1, 'Kecap Asin', '2.00', 'tbs', NULL),
(1, 'Kecap Manis', '3.00', 'tbs', NULL),
(1, 'Olive Oil', '1.00', 'tbs', NULL),
(1, 'Saos Tiram', '1.00', 'sdt', NULL),
(2, 'Agar agar', '1.00', 'bungkus', NULL),
(2, 'Air', '1700.00', 'ml', NULL),
(2, 'Gula pasir (opsi)', '1.00', 'sdm', NULL),
(2, 'Oreo cookies', '20.00', 'buah', NULL),
(2, 'Susu kental manis', '1.00', 'kaleng', NULL),
(2, 'Vanilli', '0.50', 'sdt', NULL),
(3, 'agar-agar plain', '1.00', 'bungkus', NULL),
(3, 'garam', '1.00', 'sdt', NULL),
(3, 'Skm', '1.00', 'kaleng', NULL),
(3, 'sp/ovalet', '1.00', 'sdt', NULL),
(3, 'susu cair', '200.00', 'ml', NULL),
(3, 'telor', '1.00', 'butir', NULL),
(3, 'ubi ungu', '250.00', 'gram', NULL),
(4, 'bawang bombay', '0.50', 'buah', NULL),
(4, 'daging cincang', '100.00', 'gram', NULL),
(4, 'keju mozarela parut kasar', '50.00', 'gram', NULL),
(4, 'minyak goreng untuk menumis', '1.00', 'sdm', NULL),
(4, 'saos spaghetti instan', '8.00', 'sdm', NULL),
(4, 'spaghetti', '150.00', 'gram', NULL),
(5, 'Air', '7.00', 'sdm', NULL),
(5, 'Ayam fillet', '50.00', 'gram', NULL),
(5, 'Bawang merah', '5.00', 'siung', NULL),
(5, 'Bawang Putih', '2.00', 'siung', NULL),
(5, 'Daun bawang', '6.00', 'batang', NULL),
(5, 'Garam', '1.00', 'sdt', NULL),
(5, 'Kol ukuran kecil', '2.00', 'lembar', NULL),
(5, 'Lada', '0.50', 'sdt', NULL),
(5, 'Maizena', '5.00', 'sdm', NULL),
(5, 'Minyak Goreng', '1.00', 'cangkir', NULL),
(5, 'Saus tomat', '3.00', 'sdm', NULL),
(5, 'Telur Ayam', '3.00', 'butir', NULL),
(5, 'Tomat ukuran sedang', '1.00', 'buah', NULL),
(5, 'Wortel ukuran sedang', '0.50', 'buah', NULL),
(6, 'air', '0.00', 'secukupnya', NULL),
(6, 'bawang merah', '3.00', 'siung', NULL),
(6, 'bawang putih', '5.00', 'siung', NULL),
(6, 'gula+garam', '0.00', 'secukupnya', NULL),
(6, 'jinten', '0.50', 'sdt', NULL),
(6, 'kecap manis', '3.00', 'sdm', NULL),
(6, 'kekian', '150.00', 'gram', NULL),
(6, 'kemiri', '1.00', 'buah', NULL),
(6, 'kentang', '250.00', 'gram', NULL),
(6, 'kulit lumpia', '10.00', 'buah', NULL),
(6, 'merica butiran', '0.50', 'sdt', NULL),
(6, 'saos tiram', '1.00', 'sdt', NULL),
(6, 'saos tomat', '4.00', 'sdm', NULL),
(7, 'air', '50.00', 'ml', NULL),
(7, 'bawang putih', '4.00', 'buah', NULL),
(7, 'broccoli', '200.00', 'gram', NULL),
(7, 'cabe merah', '1.00', 'buah', NULL),
(7, 'garam', '0.50', 'sdt', NULL),
(7, 'gula', '0.50', 'sdt', NULL),
(7, 'merica', '0.00', 'sejumput', NULL),
(7, 'saus tiram', '2.00', 'sdm', NULL),
(7, 'tofu', '2.00', 'buah', NULL),
(8, 'Air', '2.00', 'liter', NULL),
(8, 'Asam kandis', '5.00', 'biji', NULL),
(8, 'Bawang goreng', '2.00', 'sdm', NULL),
(8, 'Bawang merah, iris halus', '50.00', 'gram', NULL),
(8, 'Bawang putih, dihaluskan', '15.00', 'siung', NULL),
(8, 'Cabe rawit', '100.00', 'gram', NULL),
(8, 'Garam halus', '5.00', 'sdm', NULL),
(8, 'Gula aren/gula batok', '750.00', 'gram', NULL),
(8, 'Ikan giling (tenggiri/gabus/kakap)', '500.00', 'gram', NULL),
(8, 'Merica bubuk', '0.50', 'sdt', NULL),
(8, 'Minyak sayur untuk menggoreng', '0.00', 'secukupnya', NULL),
(8, 'Santan dingin', '350.00', 'ml', NULL),
(8, 'Telur ayam', '1.00', 'butir', NULL),
(8, 'Tepung sagu', '250.00', 'gram', NULL),
(9, 'Air', '600.00', 'ml', NULL),
(9, 'Garam', '0.50', 'sdt', NULL),
(9, 'Lada', '0.00', 'secukupnya', NULL),
(9, 'Olive Oil', '2.00', 'tbs', NULL),
(9, 'Telur', '2.00', 'butir', NULL),
(9, 'Vegeroni', '3.00', 'genggam', NULL),
(10, 'Bango kecap manis', '0.00', 'secukupnya', NULL),
(10, 'Bawang Bombay', '2.00', 'buah', NULL),
(10, 'Garam', '0.00', 'secukupnya', NULL),
(10, 'Ikan Gurame', '1.00', 'ekor', NULL),
(10, 'Indofood saus sambal', '0.00', 'secukupnya', NULL),
(10, 'Indofood saus tomat (bisa diganti dengan 3 buah tomat merah)', '0.00', 'secukupnya', NULL),
(10, 'lengkuas digeprek', '0.00', 'sebesar ibu jari', NULL),
(11, 'batu es', '0.00', 'secukupnya', NULL),
(11, 'rambutans', '4.00', 'buah', NULL),
(11, 'yakult', '1.00', 'buah', NULL),
(12, 'Daging Kornet', '2.00', 'sendok makan', NULL),
(12, 'Keju Mozarella', '50.00', 'gram', NULL),
(12, 'Lasagna', '4.00', 'lembar', NULL),
(12, 'Minyak Goreng', '2.00', 'sendok makan', NULL),
(12, 'Saus Spaghetti', '4.00', 'sendok makan', NULL),
(13, 'Choco Chip', '0.00', 'secukupnya', NULL),
(13, 'Coklat bubuk', '15.00', 'gram', NULL),
(13, 'Garam', '0.00', 'sejumput', NULL),
(13, 'Gula Halus', '150.00', 'gram', NULL),
(13, 'Kuning Telor', '1.00', 'Butir', NULL),
(13, 'Mentega', '125.00', 'gram', NULL),
(13, 'Minyak Goreng', '56.00', 'ml', NULL),
(13, 'Telur', '1.00', 'butir', NULL),
(13, 'Tepung terigu', '300.00', 'gram', NULL),
(13, 'Vanili bubuk', '0.25', 'sdt', NULL),
(14, 'Air hangat', '125.00', 'ml', NULL),
(14, 'Fermipan', '1.00', 'sdm', NULL),
(14, 'Gula pasir', '100.00', 'gram', NULL),
(14, 'Keju parut', '0.00', 'secukupnya', NULL),
(14, 'Kuning telur', '2.00', 'butir', NULL),
(14, 'Minyak goreng', '62.00', 'ml', NULL),
(14, 'Tepung protein rendah', '75.00', 'gram', NULL),
(14, 'Tepung protein tinggi', '225.00', 'gram', NULL),
(15, 'Air Kalidu', '600.00', 'ml', NULL),
(15, 'Apel', '1.00', 'buah', NULL),
(15, 'Bawang Bombay', '2.00', 'buah', NULL),
(15, 'Bawang Putih cincang halus', '2.00', 'siung', NULL),
(15, 'Fillet Ayam (bisa diganti beef, seafood, atau tofu kalau untuk vegetarian)', '250.00', 'gram', NULL),
(15, 'garam', '0.00', 'secukupnya', NULL),
(15, 'Japanese Curry Roux', '1.00', 'pack', NULL),
(15, 'kecap', '1.00', 'sdm', NULL),
(15, 'Kentang (bisa ditambah lebih banyak kalau suka)', '2.00', 'buah', NULL),
(15, 'Lada Hitam', '0.00', 'secukupnya', NULL),
(15, 'madu/gula', '0.50', 'sdm', NULL),
(15, 'Minyak Goreng', '3.00', 'sdm', NULL),
(15, 'Soy Sauce (aku pakai kikkoman all purpose)', '1.50', 'sdm', NULL),
(15, 'Wortel (bisa ditambah lebih banyak kalau suka)', '2.00', 'buah', NULL);

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
(1),
(1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `recipe_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `value` decimal(2,1) unsigned NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`recipe_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `rating`
--
DROP TRIGGER IF EXISTS `avg_rating_delete`;
DELIMITER //
CREATE TRIGGER `avg_rating_delete` AFTER DELETE ON `rating`
 FOR EACH ROW UPDATE recipes SET rating = (SELECT AVG(rating.value) from rating where rating.recipe_id=recipes.id) WHERE recipes.id=OLD.recipe_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `avg_rating_insert`;
DELIMITER //
CREATE TRIGGER `avg_rating_insert` AFTER INSERT ON `rating`
 FOR EACH ROW UPDATE recipes SET rating = (SELECT AVG(rating.value) from rating where rating.recipe_id=recipes.id) WHERE recipes.id=NEW.recipe_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `avg_rating_update`;
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `highlight` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `portion`, `duration`, `author`, `create_date`, `last_update`, `rating`, `status`, `tmp_status`, `views`, `photo`, `highlight`) VALUES
(1, 'Minced Chicken with Soy Sauce', 'Sajikan dengan nasi yang dikukus bersama si ayam kecap. Luar Biasa :)', 2, 20, 1, '2015-04-15 04:50:52', '2015-04-15 04:50:52', '0.0', 1, 0, 0, 'images/recipe/1.jpg', 0),
(2, 'Oreo Pudding', 'Pudding yang satu ini memang selalu menjadi juara dessert dirumah, apalagi bila di dukung dengan cuaca yg panas ^_^', 20, 60, 1, '2015-04-15 05:01:56', '2015-04-15 05:01:56', '0.0', 1, 0, 2, 'images/recipe/2.jpg', 0),
(3, 'ES CREAM UBI UNGU', 'warnanya bagus dan tentunya lebih sehat tanpa bahan pewarna', 5, 240, 1, '2015-04-15 05:17:16', '2015-04-15 05:17:16', '0.0', 1, 0, 0, 'images/recipe/3.jpg', 1),
(4, 'spaghetti panggang', 'resep pasta yang mudah dan cepat, rasanya lebih mantap daripada spagheti biasa', 3, 30, 1, '2015-04-15 04:50:48', '2015-04-15 04:50:48', '0.0', 1, 0, 0, 'images/recipe/4.jpg', 0),
(5, 'Fuyunghai Authentic Chinese Style', 'fuyunghai #homemade', 3, 60, 1, '2015-04-15 04:50:46', '2015-04-15 04:50:46', '0.0', 1, 0, 1, 'images/recipe/5.jpg', 0),
(6, 'Mini Kebab Veggie', NULL, 10, 20, 1, '2015-04-15 04:45:32', '2015-04-15 04:45:32', '0.0', 1, 0, 1, 'images/recipe/6.jpg', 0),
(7, 'broccoli tofu saus tiram', 'Menu sayur super gampang :D', 4, 20, 1, '2015-04-15 05:17:16', '2015-04-15 05:17:16', '0.0', 1, 0, 0, 'images/recipe/7.jpg', 1),
(8, '"Pempek Adaan"', 'Membuatnya mudah dan cepat, adonannya langsung digoreng tanpa harus melewati proses perebusan lagi\r\nby Nova Rilandari', 5, 60, 1, '2015-04-15 05:17:16', '2015-04-15 05:17:16', '0.0', 1, 0, 0, 'images/recipe/8.jpg', 0),
(9, 'Dadar Vegeroni (Vegeroni Omelette)', 'Cepat, praktis, dan sehat. Cocok untuk menu sarapan, lauk makan siang, atau camilan =)\r\n_Papao', 2, 20, 1, '2015-04-15 04:50:40', '2015-04-15 04:50:40', '0.0', 1, 0, 0, 'images/recipe/9.jpg', 0),
(10, 'Gurame Pedas Manis Yummy', 'by Wattini Yudo', 3, 20, 1, '2015-04-15 04:50:41', '2015-04-15 04:50:41', '0.0', 1, 0, 0, 'images/recipe/10.jpg', 0),
(11, 'Yakulty-fresh', 'Yakulty-fresh siap mjd temen #minumansegar mu di weekend ceria :)\r\nby Andra Tersiana', 1, 2, 2, '2015-04-15 05:07:32', '2015-04-15 05:07:32', '0.0', 1, 0, 2, 'images/recipe/11.jpg', 0),
(12, 'LASAGNA GULUNG PRAKTIS', 'Resep praktis dan kilatnya pasta nih!\r\nby nining wahyoe\r\n', 2, 10, 2, '2015-04-15 05:16:25', '2015-04-15 05:16:25', '0.0', 1, 0, 1, 'images/recipe/12.jpg', 0),
(13, 'Pie brownies', 'Sip banget buat pecinta cemilan manis N gurih ^_^\r\nby Nita selpa', 6, 60, 2, '2015-04-15 05:40:03', '2015-04-15 05:40:03', '0.0', 1, 0, 0, 'images/recipe/13.jpg', 0),
(14, 'Cheese Bread', 'by Any S. Soetrisno', 12, 180, 2, '2015-04-15 05:40:06', '2015-04-15 05:40:06', '0.0', 1, 0, 0, 'images/recipe/14.jpg', 0),
(15, 'Simple Japanese Curry Rice', 'Japanese curry rice yang gampang dan enak tapi ngga kalah sama rasa restoran\r\nby Riska', 4, 60, 2, '2015-04-15 05:40:25', '2015-04-15 05:40:25', '0.0', 1, 0, 1, 'images/recipe/15.jpg', 0);

--
-- Triggers `recipes`
--
DROP TRIGGER IF EXISTS `add_recipe_default`;
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
  `no_step` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `description` text,
  `photo` text,
  PRIMARY KEY (`recipe_id`,`no_step`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`recipe_id`, `no_step`, `description`, `photo`) VALUES
(1, 1, 'Cuci daging ayam dan cincang kasar (sesuai selera). Balurkan daging ayam tsb dengan garam. Sisihkan sesaat.', 'assets/img/step-default.jpg'),
(1, 2, 'Panaskan olive oil di pan dengan api sedang. Tumis bawang putih hingga harum dan agak kecoklatan.', 'assets/img/step-default.jpg'),
(1, 3, 'Kemudian tiriskan daging ayam dari air dan garam tadi. Setelah itu, masukkan daging ayam, tumis sesaat bersama dengan bawang putih tadi hingga daging ayam tidak terlihat mentah lagi.', 'assets/img/step-default.jpg'),
(1, 4, 'Masukkan air, kecap manis, kecap asin dan saos tiram. Aduk kembali dan biarkan hingga semua bumbu meresap ke dalam daging ayam. Jika dirasa airnya terlalu sedikit bisa ditambahkan, tapi jangan lupa koreksi rasa.', 'assets/img/step-default.jpg'),
(1, 5, 'Ambil sebuah mangkuk kosong, sajikan daging ayam yang sudah matang tadi di bagian dalam mangkuk, kemudian masukkan nasi, padatkan.', 'assets/img/step-default.jpg'),
(1, 6, 'Kukus mangkuk yang telah terisi daging ayam dan nasi tsb kurang lebih 15menit agar benar-benar meresap.', 'assets/img/step-default.jpg'),
(1, 7, 'Sajikan. Selamat menikmati :)\r\n_Papao', 'assets/img/step-default.jpg'),
(2, 1, 'Buang isi / cream oreo, dan blender hingga halus. Bisa jg dihancurkan dengan cara di tumbuk kasar. Basahkan cetakan pudding dgn sedikit air, agar mudah pd saat dikeluarkan nanti.', 'assets/img/step-default.jpg'),
(2, 2, 'Campurkan susu, air, gula, vanili, agar2, aduk rata sampai tidak ada gumpalan bubuk puding', 'assets/img/step-default.jpg'),
(2, 3, 'Masak di atas kompor dengan api sedang sambil sesekali diaduk searah jarum jam, sampai terlihat letupan pertama.', 'assets/img/step-default.jpg'),
(2, 4, 'Matikan api, aduk2 dan biarkan sebentar sampai hilang uap panasnya. Tuang pudding kesetengah bagian cup, biarkan setengah beku.', 'assets/img/step-default.jpg'),
(2, 5, 'Taburkan remahan oreo di atas pudding , dan siram kembali dgn pudding. Simpan pudding di dalam lemari es selama 3 jam, dan sajikan dengan taburan oreo diatasnya. Hhmm ,,, yummy\r\n-Iien Soegie-', 'assets/img/step-default.jpg'),
(3, 1, 'Kukus ubi ungu,haluskan', 'assets/img/step-default.jpg'),
(3, 2, 'Campur semua bahan ,tambahkan air jika terlalu kental,masukan ubi ungu yg telah dihaluskan,,', 'assets/img/step-default.jpg'),
(3, 3, 'Masak diatas api kecil sampai meletup letup,sambil diaduk Tunggu sampai adonan dingin', 'assets/img/step-default.jpg'),
(3, 4, 'Setelah dingin,Mix atau blender adonan sampai lembut', 'images/step/3-4.jpg'),
(4, 1, 'Panaskan oven dengan suhu 180 derqjat celcius.', 'assets/img/step-default.jpg'),
(4, 2, 'Panaskan minyak goreng. Tumis bawang bombay dan daging cincang Hingga matang.', 'assets/img/step-default.jpg'),
(4, 3, 'Campur spaghetti rebus dengan saos spagheti instan. Masukkan dalam pinggan tahan panas', 'assets/img/step-default.jpg'),
(4, 4, 'Atur daging cincang tumis diatas spagheti.', 'assets/img/step-default.jpg'),
(4, 5, 'Tabur keju mozarela.', 'assets/img/step-default.jpg'),
(4, 6, 'Panggang 10-15 menit sampai keju meleleh', 'images/step/4-6.jpg'),
(5, 1, 'Goreng bawang merah hingga kuning lalu angkat sisihkan (lupa difoto), cincang halus bawang putih, wortel dipotong korek api, kol iris memanjang, fillet ayam dan tomat dipotong dadu kecil', 'images/step/5-1.jpg'),
(5, 2, 'kocok telur ayam didalam mangkuk besar. lalu campurkan wortel, kol, ayam, daun bawang, bawang merah goreng, garam dan lada', 'images/step/5-2.jpg'),
(5, 3, 'Masukkan 4 sdm makan tepung maizena lalu aduk rata adonan fuyunghai', 'images/step/5-3.jpg'),
(5, 4, 'Panaskan minyak diatas panci teflon dengan api sedang. Jika panci mulai mengeluarkan asap putih tandanya minyak sudah benar benar panas. baru tuangkan adonan fuyunghai. Minyak yang digunakan harus banyak agar bagian atas fuyunghai tergoreng merata', 'images/step/5-4.jpg'),
(5, 5, 'Intip bagian bawah fuyunghai jika sudah kecoklatan saatnya membalik adonan agar tidak gosong. Supaya waktu dibalik adonan tidak terbelah tips saya gunakan golok dibagian bawah spatula dibagian atas. jepit kedua sisi balik perlahan', 'images/step/5-5.jpg'),
(5, 6, 'goreng sampai bagian lainnya matang. Intip sesekali supaya tidak terlalu gosong.', 'images/step/5-6.jpg'),
(5, 7, 'Tiriskan diatas piring, gunakan tisu dapur dengan menekan perlahan fuyunghai agar minyak terserap', 'images/step/5-7.jpg'),
(5, 8, 'Sementara itu kita buat sausnya dengan menumis bawang putih dan tomat dengan 2 sdm minyak. tunggu hingga tomat mulai mengeluarkan air', 'images/step/5-8.jpg'),
(5, 9, 'Tambahkan air dan saus tomat aduk rata dengan api kecil', 'images/step/5-9.jpg'),
(5, 10, 'Tuang larutan maizena. Aduk rata hingga mengental matikan api. Siram diatas fuyunghai', 'images/step/5-10.jpg'),
(6, 1, 'Kukus kentang dan kekian sampai matang. Haluskan kentang,sisihkan. Potong dadu kekian,sisihkan.', 'assets/img/step-default.jpg'),
(6, 2, 'Haluskan : bawang putih,bawang merah,kemiri,merica,jinten.', 'assets/img/step-default.jpg'),
(6, 3, 'Tumis bumbu halus,tambahkan sedikit air,aduk sampai wangi', 'assets/img/step-default.jpg'),
(6, 4, 'Masukkan kentang halus,aduk rata', 'assets/img/step-default.jpg'),
(6, 5, 'Bumbui dgn gula dan garam,masukkan kecap manis,saos tomat,saos tiram.', 'assets/img/step-default.jpg'),
(6, 6, 'Aduk sampai mengental,kalo dirasa terlalu kurang kalis bisa ditambah air sedikit. Sisihkan tunggu dingin', 'assets/img/step-default.jpg'),
(6, 7, 'Siapkan kulit lumpia,isi dengan kentang dan beri potongan kekian. Gulung dan ujungnya rekatkan dengan air (gak usah ditekuk seperti lumpia ya,cukup digulung aja)', 'assets/img/step-default.jpg'),
(6, 8, 'Panaskan sedikit mentega pada teflon,panggang kebab veggie sampai matang kecoklatan', 'assets/img/step-default.jpg'),
(6, 9, 'Mini kebab veggie ready to eat :) sajikan dgn mayones+saos tomat/saos sambal. NyamNyam~', 'assets/img/step-default.jpg'),
(7, 1, 'Cuci brokoli lalu rendam di air garam 15menit, kemudian tiriskan lalu potong2. Sisihkan', 'assets/img/step-default.jpg'),
(7, 2, 'Potong2 tofu, kemudian goreng hingga agak berkulit dikedua sisinya kemudian sisihkan', 'assets/img/step-default.jpg'),
(7, 3, 'Iris tipis cabe & bawang putih lalu tumis hingga harum, masukan brokoli beri saus tiram, gula, garam, merica, sdikit air aduk rata, cicipi kemudian masukan tofu aduk rata lalu kecilkan api, tutup wajan selama 5 menit hingga brokoli lunak, siap disajikan', 'assets/img/step-default.jpg'),
(8, 1, 'Campurkan ikan giling dan santan dingin. Aduk hingga tercampur rata menggunakan tangan', 'assets/img/step-default.jpg'),
(8, 2, 'Masukkan telur, garam, dan merica. Aduk rata', 'assets/img/step-default.jpg'),
(8, 3, 'Tambahkan sagu, bawang merah iris, dan bawang goreng. Aduk kembali hingga tercampur rata.', 'assets/img/step-default.jpg'),
(8, 4, 'Bentuk adonan menjadi bulatan. Bisa menggunakan scoop ice cream atau bisa juga dengan tehnik membuat bakso yaitu ambil adonan menggunakan tangan lalu remas hingga adonan keluar diantara ibu jari dan telunjuk membentuk bulatan lalu ambil menggunakan sendok', 'assets/img/step-default.jpg'),
(8, 5, 'Goreng dalam minyak panas dan banyak dengan api sedang hingga kuning kecoklatan. Angkat dan tiriskan. Sajikan dengan kuah cuko.', 'assets/img/step-default.jpg'),
(8, 6, 'Cuko :  Campurkan semua bahan. Masak di atas api sedang sambil diaduk sesekali hingga mengental. Angkat dan dinginkan, lalu saring', 'assets/img/step-default.jpg'),
(9, 1, 'Rebus vegeroni dalam air mendidih selama kurleb 10 menit atau hingga al dente (empuk). Kemudian tiriskan.', 'assets/img/step-default.jpg'),
(9, 2, 'Sediakan sebuah mangkuk, kocok lepas telur, masukkan garam dan lada, kocok hingga merata dan mengembang.', 'assets/img/step-default.jpg'),
(9, 3, '\r\n4\r\nW1siziisijiwmtuvmdqvmdevmdyvntuvmdqvmjc2lzmynjk2njuynta1mzjlmji1yzbjlmpwzyjdlfsiccisimnvbnzlcnqilcityxv0by1vcmllbnqgil0swyjwiiwidgh1bwiilcixodb4il1d?sha=da67e616\r\nSelamat menikmati =)\r\nBagikan via:Fac', 'assets/img/step-default.jpg'),
(9, 4, 'Selamat menikmati =)', 'images/step/9-4.jpg'),
(10, 1, 'Cuci bersih ikan gurame dan bumbui dengan bawang putih dan garam, lalu goreng, jangan sampai kering banget. Angkat.', 'assets/img/step-default.jpg'),
(10, 2, 'Panaskan minyak goreng, tumis Bawang Bombay, Bawang Putih, Saus Sambal, Saus tomat, Kecap manis, Lengkuas. Aduk-aduk.', 'assets/img/step-default.jpg'),
(10, 3, 'Masukkan ikan gurame, cukup 2 kali balik saja agar ikan tidak hancur. Angkat dan sajikan selagi hangat.', 'assets/img/step-default.jpg'),
(11, 1, 'Siapkan buah rambutan, ambil dagingnya. Cuci bersih, sisihkan.', 'images/step/11-1.jpg'),
(11, 2, 'Tuang batu es dlm gelas saji, masukan daging buah. Siram dg yakult. Sajikan.', 'assets/img/step-default.jpg'),
(12, 1, 'rebus lasagna instan dengan menambahkan 2sdm minyak goreng agar lasagna tidak lengket satu sama lain, tiriskan\r\n', 'assets/img/step-default.jpg'),
(12, 2, 'tumis saus spagheti instan dengan daging kornet, sampai tercampur rata', 'assets/img/step-default.jpg'),
(12, 3, 'isi lasagna dengan tumisan saus dan beri parutan keju mozarella, lalu gulung, lakukan sampai habis', 'assets/img/step-default.jpg'),
(12, 4, 'panggang sebentar lasagna yang telah diisi', 'assets/img/step-default.jpg'),
(12, 5, 'terakhir tata dipiring lalu beri sisa saus dan beri parutan keju, selamat menikmati...praktis bukan?', 'assets/img/step-default.jpg'),
(13, 1, 'Untuk membuat kulit pie nya . Campurkan tepung terigu, mentega, telor dan gula halus sampai Kalis bs menggunakan wisk balon ato langsung remes2 pake tangan. Setelah Kalis olesi cetakan pie ( dsni saya pake yg diameter 18) dengan mentega secara merata.', 'assets/img/step-default.jpg'),
(13, 2, 'Jgn lupa ya setelah dicetak adonan kulit pie nya bagian dasarnya di tusuk pake garpu.', 'assets/img/step-default.jpg'),
(13, 3, 'Utk fla browniess aduk telur ,gula halus dgn wisk sampe halus. Masukkan campuran terigu,garam,Vanili bubuk, & cokelat bubuk scr brthp aduk rata.masukkan minyak goreng aduk rata. Tuang ke adonan pie 3/4 penuh taburi choco Chip oven d suhu 150-160 dercel', 'assets/img/step-default.jpg'),
(13, 4, 'Panggang selama 45 menit atau sampe kulit pie terlihat keemasan . Keluarkan dari oven diinginkan sebentar lalu keluarkan dari cetakan. Pie brownies siap dihidangkan :)', 'assets/img/step-default.jpg'),
(14, 1, 'Campurkan fermipan dengan air hangat. Tambahkan gula, tunggu sampai fermipan aktif.', 'assets/img/step-default.jpg'),
(14, 2, 'Kocok sebentar kuning telur, campurkan larutan fermipan. Tuang minyak goreng.', 'assets/img/step-default.jpg'),
(14, 3, 'Masukkan tepung secara bertahap. Aduk sebentar. Gunakan mixer untuk menguleni hingga kalis.', 'assets/img/step-default.jpg'),
(14, 4, 'Bulatkan adonan, oles dengan minyak goreng lalu tutup rapat menggunakan plastik selama 1 jam.', 'assets/img/step-default.jpg'),
(14, 5, 'Setelah adonan mengembang, pukul bagian tengahnya kemudian uleni kembali untuk menghilangkan udara di dalamnya.', 'assets/img/step-default.jpg'),
(14, 6, 'Bentuk bulat, letakkan pada loyang yang sudah diolesi mentega. Taburi atasnya dengan keju.', 'assets/img/step-default.jpg'),
(14, 7, 'Biarkan mengembang lagi hingga double size. kemudian panggang selama kurang lebih 40 menit dengan suhu 180c sampai matang. Happy baking ^^', 'assets/img/step-default.jpg'),
(15, 1, 'Siapkan semua bahan masakan dan kupas wortel, kentang, dan apel. Aku pakai pisau peeler supaya lebih cepat mengupasnya', 'images/step/15-1.jpg'),
(15, 2, 'Cuci daging ayam, keringkan dengan tissue dapur lalu taburkan garam dan lada di kedua sisi diamkan sebentar kemudian potong kotak-kotak kurang lebih 2x2 cm', 'images/step/15-2.jpg'),
(15, 3, 'Cincang halus bawang putih, dan juga iris bawang bombay. aku iris bawang bombay dengan bentuk wedges.', 'images/step/15-3.jpg'),
(15, 4, 'Untuk wortelnya aku potong - potong bentuk segitiga, kentang dipotong kotak-kotak agak besar karena kalau terlalu kecil nanti jadi hancur waktu dimasak\r\n', 'images/step/15-4.jpg'),
(15, 5, 'Panaskan minyak goreng dengan api sedang, lalu tumis bawang bombay sampai berwarna transparan lalu masukkan bawang putih. Tumis sampai harum baru masukkan ayam', 'images/step/15-5.jpg'),
(15, 6, 'Masukkan wortel, tumis sebentar lalu tambahkan air kaldu tunggu sampai agak mendidih masukkan kentang', 'images/step/15-6.jpg'),
(15, 7, 'Setelah mendidih parut apel, tambahkan kedalam panci. Tuang soy sauce & gula (madu). Aduk-aduk hinga rata.', 'images/step/15-7.jpg'),
(15, 8, 'Untuk curry roux atau kari blok nya disarankan jangan langsung dimasukkan ke panci karena takut menggumpal. sebaiknya. ambil 2 blok larutkan di mangkok kecil dengan air kaldu. Setelah larut tuang kedalam panci. Ulangi sampai kari blok habis\r\n', 'images/step/15-8.jpg'),
(15, 9, 'Kecilkan api supaya kari tidak cepat gosong. Tambahkan lada, koreksi rasa dengan garam. Lalu aduk-aduk sampai kari mengental dan wortel juga kentang lembut. Matikan api.', 'images/step/15-9.jpg'),
(15, 10, 'Sajikan Chicken Curry dengan nasi putih panas. Jika masih ada sisa curry, dapat disimpan di kulkas 2-3 hari atau di freezer sampai 1 bulan.', 'images/step/15-10.jpg');

--
-- Triggers `steps`
--
DROP TRIGGER IF EXISTS `add_step_default`;
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `last_access` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`email`),
  UNIQUE KEY `email` (`email`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `gender`, `bdate`, `phone`, `status`, `photo`, `facebook`, `twitter`, `googleplus`, `path`, `last_access`) VALUES
(1, 'je.fathanah@gmail.com', 'admin_jean', 'H+E4bPq8B0Lum7MAz+q7FDPpapuBZLlsWi5lM2Iv+6YzJstDRpC85IzNLh8EF0wa7TYJnFB4Pv1sdzsjmrfZYw==', 'F', '1994-06-19', '085762112191', 'ADMIN', 'images/user/1.jpg', '', '', '', '', '2015-04-15 04:45:09'),
(2, 'aagustinamora@gmail.com', 'admin_mora', 'im7fiUftv1nU1CYkaW7zOPzZ0ZBRwRnibtzpv1HuLbmV2zmn3CXa2HBslgVxPhYG3BQlrKpMNDhWSSgHhmaE4g==', 'F', '1970-01-01', NULL, 'ADMIN', 'assets/img/user-female.png', NULL, NULL, NULL, NULL, '2015-04-14 10:57:14'),
(3, 'abidnurulhakim@gmail.com', 'admin_abid', 'GJrHN3jOqpxqKNa7IvYm45pWSQ6U8pb1FIEoJRrH8TMLsDDHV52ZXpOVBYHJf/JY/3XN5sTGhR9e6lqzaLPJng==', 'M', '1970-01-01', NULL, 'ADMIN', 'assets/img/user-male.png', NULL, NULL, NULL, NULL, '2015-04-14 10:57:33'),
(4, 'alpancs@gmail.com', 'admin_alfan', 'hiaPR4oPdj/f3mayvd867Rgyoe21g/FomoZJ7MT/lQ67caJ5203zasrOTf40XzDTv6xA1x5jqWU4duDV3xhJsg==', 'M', '1970-01-01', NULL, 'ADMIN', 'assets/img/user-male.png', NULL, NULL, NULL, NULL, '2015-04-14 10:57:59'),
(5, 'ffahmii@gmail.com', 'admin_fahmi', '0xM2tXywIkE28tUINicuWXZw2Cu3dC07/+pJE0+ZGEiTRToLAmTJRf34rZ0/pYYXVBU1GHy+/fMb4KIed79cZw==', 'M', '1970-01-01', NULL, 'ADMIN', 'assets/img/user-male.png', NULL, NULL, NULL, NULL, '2015-04-14 10:58:08'),
(6, 'admin@foodoof.com', 'admin', 'rHGyPwnjxf9m4V/xGFd8ATcH6MylOR2niUNXwgCLolDZcHONjcDl/Q+jFB47dCxysBF8vyAHlOSid8qhVBKBgA==', 'M', '1970-01-01', NULL, 'admin', 'assets/img/user-male.png', NULL, NULL, NULL, NULL, '2015-04-15 05:45:07');

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `add_user_default`;
DELIMITER //
CREATE TRIGGER `add_user_default` BEFORE INSERT ON `users`
 FOR EACH ROW if (LOWER(NEW.gender) = 'f' ) then set NEW.photo = 'assets/img/user-female.png'; elseif (LOWER(NEW.gender) = 'm' ) then set NEW.photo = 'assets/img/user-male.png'; end if
//
DELIMITER ;

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
