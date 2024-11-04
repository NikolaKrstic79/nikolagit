-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.10.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for library_db
CREATE DATABASE IF NOT EXISTS `library_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `library_db`;

-- Dumping structure for table library_db.approved_comments
CREATE TABLE IF NOT EXISTS `approved_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table library_db.approved_comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `approved_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `approved_comments` ENABLE KEYS */;

-- Dumping structure for table library_db.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `bio` varchar(2000) NOT NULL,
  `releases` varchar(50) NOT NULL,
  `pages` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table library_db.books: ~3 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `title`, `author`, `category`, `image_url`, `description`, `bio`, `releases`, `pages`) VALUES
	(1, 'Dune', 'Frank Herbert', 'Science fiction', 'https://m.media-amazon.com/images/I/81nq+ewtkcL._AC_UF1000,1000_QL80_.jpg', 'Dune is set in the distant future in a feudal interstellar society in which various noble houses control planetary fiefs. It tells the story of young Paul Atreides, whose family accepts the stewardship of the planet Arrakis. While the planet is an inhospitable and sparsely populated desert wasteland, it is the only source of melange, or "spice", a drug that extends life and enhances mental abilities.', 'Franklin Patrick Herbert Jr. (October 8, 1920 February 11, 1986) was an American science-fiction author who wrote the 1965 novel Dune and its five sequels. He also wrote short stories and worked as a newspaper journalist, photographer, book reviewer, ecological consultant, and lecturer.', '1965', '896'),
	(2, 'The Teacher', 'Freida McFadden', 'Thriller', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1693401496i/195967140.jpg', 'Eve has a good life. She gets up each day, gets a kiss from her husband Nate, and heads off to teach math at the local high school. All is as it should be. Except.. Last year, Caseham High was rocked by a scandal, with one student, Addie, at its center. And this year, Eve is dismayed to find the girl in her class. Addie can\'t be trusted. She lies. She hurts people. She destroys lives. At least, that\'s what everyone says.', 'McFadden self-published her first book through Amazon KDP in 2013. Her 2022 book The Housemaid was an international bestseller. A movie adaptation of the book is set to be adapted for Lionsgate with Rebecca Sonnenshine to pen the screenplay, and Hidden Pictures\' Todd Lieberman and Alex Young to produce.', '2024', '400');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping structure for table library_db.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table library_db.comments: ~3 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `username`, `comment`, `created_at`) VALUES
	(1, 'user1', 'This is the first comment.', '2024-03-13 21:10:17'),
	(2, 'user2', 'Here is another comment.', '2024-03-13 21:10:17'),
	(3, 'user3', 'And one more comment.', '2024-03-13 21:10:17');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table library_db.held_comments
CREATE TABLE IF NOT EXISTS `held_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  KEY `fk_book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table library_db.held_comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `held_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `held_comments` ENABLE KEYS */;

-- Dumping structure for table library_db.notes
CREATE TABLE IF NOT EXISTS `notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_book_id` int(11) DEFAULT NULL,
  `note_user_id` int(11) DEFAULT NULL,
  `note_content` text DEFAULT NULL,
  `note_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`note_id`),
  KEY `note_book_id` (`note_book_id`),
  KEY `note_user_id` (`note_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table library_db.notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;

-- Dumping structure for table library_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `if_admin` int(6) unsigned DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
