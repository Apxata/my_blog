-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.34-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных blog
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `blog`;

-- Дамп структуры для таблица blog.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edit_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `preview_text` text CHARACTER SET utf8 NOT NULL,
  `full_text` text CHARACTER SET utf8 NOT NULL,
  `subject` varchar(256) CHARACTER SET utf8 NOT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы blog.articles: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `author_id`, `create_date`, `last_edit_date`, `preview_text`, `full_text`, `subject`, `visible`) VALUES
	(1, 20, '2018-07-23 22:39:37', '2018-07-24 07:27:11', 'Тут должен быть текст', 'Интересно для чего вообще вести блог. У меня есть две идеи по этому поводу. Основная идея - это поделиться своим опытом, если бы каждый делал это, то было бы очень много разных данных и можно было бы черпать оттуда много информации, мир на самом деле стремится к этому. Конечно в такой куче нужен поиск и тут конечно есть проблемы, как найти нужное, но в целом механизмы уже достаточно крутые. Второе, по-моему, искать сторонников своих идей и взглядов, получать обратную связь на какие-то волнующие темы, особенно круто, когда уже большая аудитория есть.', 'Мой новый блог', 1),
	(2, 20, '2018-07-13 04:27:02', '2018-07-13 04:27:02', 'Изучать рнр я начал из-за того что мне постоянно нужно что-то доделать по интернет магазину.', ' Изучать рнр я начал из-за того что мне постоянно нужно что-то доделать по интернет магазину. Сейчас нужно искать программиста для доделки внутренней части админки нашего сайта, я подумал что неплохо бы разбираться в этом немного и решил подтянуть свои знания, с этого все и началось. ', 'Как я изучал рнр', 1),
	(3, 20, '2018-01-15 16:02:14', '2018-01-15 17:43:17', '  Интересно для чего вообще вести блог. У меня есть две идеи по этому поводу.\r\n\r\n Основная идея - это поделиться своим опытом, если бы каждый делал это, то было бы очень много разных данных и можно было бы черпать оттуда много информации.', '   Интересно для чего вообще вести блог. У меня есть две идеи по этому поводу.\r\n\r\n Основная идея - это поделиться своим опытом, если бы каждый делал это, то было бы очень много разных данных и можно было бы черпать оттуда много информации, мир на самом деле стремится к этому. Конечно в такой куче нужен поиск и тут конечно есть проблемы, как найти нужное, но в целом механизмы уже достаточно крутые.\r\n\r\nВторое, по-моему, искать сторонников своих идей и взглядов, получать обратную связь на какие-то волнующие темы, особенно круто, когда уже большая аудитория есть. \r\n\r\n', 'Зачем вообще вести блог', 1),
	(6, 20, '2018-07-26 08:07:57', '2018-07-26 08:07:57', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum', 1),
	(7, 20, '2018-07-26 08:23:30', '2018-07-28 08:22:05', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum eeeee', 1),
	(8, 20, '2018-07-26 08:36:30', '2018-07-28 08:27:56', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n', 'Why do we are', 1),
	(9, 20, '2018-07-28 08:41:34', '2018-07-28 09:04:14', '', 'Лучшая статья года', 'Новая статья ', 1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Дамп структуры для таблица blog.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы blog.users: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
