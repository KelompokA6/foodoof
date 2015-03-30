-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2015 at 09:54 AM
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
  `quantity` decimal(3,2) DEFAULT NULL,
  `units` varchar(30) DEFAULT NULL,
  `info` text,
  PRIMARY KEY (`recipe_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`, `units`, `info`) VALUES
(1, 'Air perasan jeruk nipis', '3.00', 'sdm', NULL),
(1, 'Ayam', '1.00', 'ekor', NULL),
(1, 'Bawang putih', '9.99', 'siung', NULL),
(1, 'Daun jeruk', '5.00', 'lembar', NULL),
(1, 'Daun salam', '2.00', 'lembar', NULL),
(1, 'Garam', NULL, 'secukupnya', NULL),
(1, 'Jahe', '2.00', 'ruas jari', NULL),
(1, 'Kemiri', '5.00', 'butir', NULL),
(1, 'Kunyit', '1.00', 'ruas jari', NULL),
(1, 'Lengkuas', '9.99', 'gram', NULL),
(1, 'Serai', '1.00', 'batang', NULL),
(2, 'air', '1.00', 'gelas', NULL),
(2, 'air jeruk nipis', '1.00', 'sdm', NULL),
(2, 'bawang merah', '4.00', 'siung', NULL),
(2, 'bawang putih', '6.00', 'siung', NULL),
(2, 'cabai merah besar', '3.00', 'buah', NULL),
(2, 'cabai rawit', NULL, 'sesuai selera', NULL),
(2, 'daun jeruk', '1.00', 'lembar', NULL),
(2, 'gula dan garam', NULL, 'secukupnya', NULL),
(2, 'kemangi', NULL, 'secukupnya', NULL),
(2, 'minyak goreng', '3.00', 'sdm', NULL),
(2, 'tepung terigu', '2.00', 'sdm', NULL),
(2, 'tomat', '1.00', 'buah', NULL),
(2, 'udang', '9.99', 'gram', NULL),
(3, 'air', NULL, 'secukupnya', NULL),
(3, 'bawang merah', '3.00', 'siung', NULL),
(3, 'bawang putih', '5.00', 'siung', NULL),
(3, 'gula garam', NULL, 'secukupnya', NULL),
(3, 'jinten', '1.00', 'sdt', NULL),
(3, 'kecap manis', '3.00', 'sdm', NULL),
(3, 'kekian', '9.99', 'gram', NULL),
(3, 'kemiri', '1.00', 'buah', NULL),
(3, 'kentang', '9.99', 'gram', NULL),
(3, 'kulit lumpia', '9.99', 'lembar', NULL),
(3, 'merica butiran', '1.00', 'sdt', NULL),
(3, 'saos tiram', '1.00', 'sdt', NULL),
(3, 'saos tomat', '4.00', 'sdm', NULL),
(4, 'keju parut', NULL, 'sesuka hati', NULL),
(4, 'minyak untuk menggoreng', NULL, 'secukupnya', NULL),
(4, 'palm sugar', NULL, 'sesuka hati', NULL),
(4, 'pisang sanggar', '7.00', 'buah', NULL),
(4, 'raw honey', NULL, 'secukupnya', NULL),
(4, 'tepung terigu/beras', NULL, 'secukupnya', NULL),
(5, 'air es', '9.99', 'ml', NULL),
(5, 'baking powder', '1.00', 'sdt', NULL),
(5, 'bubuk wippecream instant', '9.99', 'gram', NULL),
(5, 'garam', '1.00', 'sdt', NULL),
(5, 'gula', '9.99', 'gram', NULL),
(5, 'sp/ovalet/tbm', '2.00', 'sdt', NULL),
(5, 'strawberry fresh', '1.00', 'kotak', NULL),
(5, 'susu bubuk', '9.99', 'gram', NULL),
(5, 'susu cair', '9.99', 'ml', NULL),
(5, 'telur', '1.00', 'btir', NULL),
(5, 'tepung terigu', '9.99', 'gram', NULL),
(5, 'vanili esssence', '2.00', 'sth', NULL),
(6, 'air untuk rebus pasta', '2.00', 'gelas', NULL),
(6, 'garam', '1.00', 'sdt', NULL),
(6, 'keju bubuk instant', '1.00', 'sachet', NULL),
(6, 'keju cheddar', NULL, 'secukupnya', NULL),
(6, 'macaroni/spaghetti', '2.00', 'cup', NULL),
(6, 'olive oil/vegie oil', '3.00', 'sdm', NULL),
(6, 'saus', NULL, 'secukupnya', NULL),
(6, 'sosis kaleng', NULL, 'secukupnya', NULL),
(6, 'susu bubuk', '2.00', 'sachet', NULL),
(7, 'air', '2.00', 'sdm', NULL),
(7, 'air jeruk lemon', '3.00', 'sdm', NULL),
(7, 'biskuit regal', '1.00', 'bungkus', NULL),
(7, 'butter', '9.99', 'gram', NULL),
(7, 'cream cheese', '1.00', 'kotak', NULL),
(7, 'gelatin', '1.00', 'sdm', NULL),
(7, 'simple syrup', NULL, 'secukupnya', NULL),
(7, 'strawberry', NULL, 'secukupnya', NULL),
(7, 'strawberry pure', '2.00', 'cup', NULL),
(7, 'wippecream', '9.99', 'gram', NULL),
(7, 'yogurt strawberry flavour', '5.00', 'sdm', NULL);

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
  `rating` decimal(3,2) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `views` int(11) NOT NULL,
  `photo` text,
  `highlight` tinyint(1) DEFAULT '0',
  `status_temp` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `portion`, `duration`, `author`, `create_date`, `last_update`, `rating`, `status`, `views`, `photo`, `highlight`, `status_temp`) VALUES
(1, 'Ayam Goreng Bumbu Lengkuas', 'Ayam goreng bumbu lengkuas ini biasanya dihidangkan berdampingan dengan rendang pada acara-acara besar, seperti acara pernikahan dan perayaan khatam Al-Qur''an. Selain itu menu ini juga tersedia di rumah makan Padang yang bertebaran di seantero penjuru tanah air. Dengan resep ini kita pun bisa membuatnya di rumah tanpa harus menunggu ada hajatan ataupun pergi ke rumah makan.. ;)', 8, 60, 3, '2015-03-29 23:23:56', '2015-03-29 23:23:56', '0.00', 1, 0, NULL, 0, 1),
(2, 'Spices-Shrimp (udang balado)', 'Resep ini tercipta karna LAPAR :D *apaan sih* Lgsg simak aja,cekidot~', 3, 10, 4, '2015-03-29 21:15:34', '2015-03-29 21:15:34', '0.00', 1, 0, NULL, 0, 1),
(3, 'Mini Kebab Veggie', 'Saya tau kebab ini dari orang jualan kebab di SD dekat kampus. Berbekal ingatan "taste" rasanya,akhirnya nemu juga resep yg sesuai bahkan lebih enak jauuuuhhh~ *GR*', 10, 20, 4, '2015-03-29 21:24:21', '2015-03-29 21:24:21', '0.00', 1, 0, NULL, 0, 1),
(4, 'Pisang keju madu ala Diaz', 'ceritanya punya sisa pisang abis dibikin kolak, pengen bikin masakan yang gampang. akhirnya bikin pisang keju deh... hehee', 7, 20, 5, '2015-03-29 21:38:47', '2015-03-29 21:38:47', '0.00', 0, 0, NULL, 0, 1),
(5, 'Japanese Strawberry Shortcake', 'Ini cake dadakan untuk valentine kemarin bareng calon suami ^^. Alhamdulillah coment keluarga calon positif semua. Maaf berantakan baru belajar', 6, 60, 6, '2015-03-29 23:23:24', '2015-03-29 23:23:24', '0.00', 1, 0, NULL, 0, 1),
(6, 'mac n cheese sederhana', 'Ini inspirasi dari mac n cheese instant yg ada di minimarket. Tp porsinya sedikit bagi saya ^^ . Cocok untuk sarapan cepat dan enak tentunya #sarapancepat #harike1', 2, 30, 6, '2015-03-29 23:35:08', '2015-03-29 23:35:08', '0.00', 1, 0, NULL, 0, 1),
(7, 'Strawberry Cheesecake (No Baked)', 'Pas jaman SMA hangout ke toko buku nemu resep ini. Saya foto resepnya *bukan di beli bukunya* ^^ dan saya praktekin. Ini adalah Cake pertama yg pernah saya buat dengan menggunakan cream keju . Kebetulan ke foto dan masih ada resepnya. ^^', 6, 90, 6, '2015-03-29 23:41:49', '2015-03-29 23:41:49', '0.00', 1, 0, NULL, 0, 1);

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
  `photo` text,
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
(4, 3, 'saat pisang masih panas, beri taburan madu, palm sugar dan parutan keju. sajikan', NULL),
(5, 1, 'Masukan telur , vanili, sp/ovalet/tbm, gula, susu cair kocok dengan mixer sampai mengembang. Matikan mixer. Masukan garam aduk dengam spatula', NULL),
(5, 2, 'Masukan baking powder ke tepung terigu. Ayak . Masukan ke adonan secara bertahap aduk dengan spatula.', NULL),
(5, 3, 'Tuang adonam ke happy call ratakan. Pastikan happy call sudah diolesin dengan minyak/butter/margarin. Masak di atas api sedang selama 5 menit. Kemudian kecilkan api. Sering lah di lihat agar tidak gosong. Setelah matang. Angkat .', NULL),
(5, 4, 'Wippcream: bubuk Wippcream , susu bubuk, air kocok dgn mixer sampai kaku. Simple syrup : air, gula, madu sampai tercampur. Potong strawberry sesuai selera', NULL),
(5, 5, 'Setelah cake dingin potong menjadi 2 bagian. Bagian dasar basahi dengan simple syrup. Kemudian beri Wippcream dan strawberry. tutup dengan cake basahi kembali dengan syrup. HIAS sesuai selera', NULL),
(6, 1, 'Masukan ke panci macaroni *pasta sesuai selera, garam, air, oil rebus sampai pasta matang istilahnya al dente ^^.', NULL),
(6, 2, 'langsung masukan Macaroni yang sudah matang ke bowl tambahkan susu bubuk , keju bubuk aduk sampai rata.', NULL),
(6, 3, 'Time to plating.. macaroni berbalur keju tabur dengan keju parut dan potongan sosis. Sajikan dengan saus tomat dan saus sambal', NULL),
(7, 1, '*hancurkan biskuit. *lelehkan butter. campur dan tuang ke mika sebagai cetakan pastikan tekan tekan sampai benar benar padat.Dan masukan di freezer', NULL),
(7, 2, '*Rendam gelatin dengan air. *Kocok Wippcream sampai kaku', NULL),
(7, 3, 'Kocok Wippcream, cream cheese , yogurt sampai rata. Kemudian masukan gelatin, pure , air lemon. Aduk rata.', NULL),
(7, 4, 'Tuang ke atas crust biskuit yg sudah jd. Kemudian dinginkan di kulkas.', NULL),
(7, 5, 'Hiasi dengan strawberry dan siram dengan simple syrup', NULL);

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
  `photo` text,
  `facebook` text,
  `twitter` text,
  `googleplus` text,
  `path` text,
  `last_access` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `gender`, `bdate`, `phone`, `status`, `photo`, `facebook`, `twitter`, `googleplus`, `path`, `last_access`) VALUES
(3, 'Biyay.AtharSabai@gmail.com', 'Biyay AtharSabai', 'masakmasak', 'f', NULL, NULL, 'MEMBER', NULL, NULL, NULL, NULL, NULL, '2015-03-29 20:56:29'),
(4, 'amel@gmail.com', 'ameLicious~', 'masakmasak', 'f', '1997-03-30', '080808080808', 'MEMBER', NULL, 'Amel', '@amel', 'Amel', NULL, '2015-03-30 07:53:43'),
(5, 'Diaz@gmail.com', 'Diaz', 'masakmasak', 'm', '1988-03-30', '081234567890', 'MEMBER', NULL, 'Diaz', '@diaz', 'Diaz', NULL, '2015-03-30 07:52:53'),
(6, 'queen@gmail.com', 'queen', 'masakmasak', 'f', '1990-03-30', '085712345678', 'MEMBER', NULL, NULL, NULL, NULL, NULL, '2015-03-29 23:18:19');

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
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cooklater`
--
ALTER TABLE `cooklater`
  ADD CONSTRAINT `cooklater_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooklater_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
