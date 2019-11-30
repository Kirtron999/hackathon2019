CREATE DATABASE IF NOT EXISTS `hackathon`;
USE `hackathon`;

SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
# users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(11) NOT NULL auto_increment,
    `username` varchar(32) NOT NULL collate utf8_bin,
    `email` varchar(255) NOT NULL collate utf8_bin,
    `hash_bcrypt` varchar(64) NOT NULL collate utf8_bin,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
	`id` int(11) NOT NULL auto_increment,
    `user_id` int(11) NOT NULL,
	FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    `category_id` int(11) NOT NULL,
	FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`),
    `title` varchar(255) NOT NULL collate utf8_bin,
	`description` text collate utf8_bin,
    `price` int(11) NOT NULL CHECK (`price` >= 0),
    `is_task` BOOL NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#replies
DROP TABLE IF EXISTS `replies`;
CREATE TABLE `replies` (
	`id` int(11) NOT NULL auto_increment,
    `post_id` int(11) NOT NULL,
    FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`),
    `user_id` int(11) NOT NULL,
	FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    `message` text collate utf8_bin,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
	`id` int(11) NOT NULL UNIQUE KEY,
	`name` varchar(50) NOT NULL collate utf8_bin,
	`parent_id` int(11)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

Start transaction;
	INSERT INTO `categories` VALUES (1, "Аудио и видео", NULL);
	INSERT INTO `categories` VALUES (7, "Видеомонтаж, Видеосъемка", 1);
	INSERT INTO `categories` VALUES (8, "Аудиомонтаж", 1);
	INSERT INTO `categories` VALUES (9, "Создание субтитров", 1);
	INSERT INTO `categories` VALUES (2, "Дизайн", NULL);
	INSERT INTO `categories` VALUES (10, "Дизайн сайтов", 2);
	INSERT INTO `categories` VALUES (11, "Логотипы", 2);
	INSERT INTO `categories` VALUES (12, "Векторная графика", 2);
	INSERT INTO `categories` VALUES (41, "Презентации", 2);
	INSERT INTO `categories` VALUES (13, "3D графика", 2);
	INSERT INTO `categories` VALUES (14, "Дизайн выставочных стендов", 2);
	INSERT INTO `categories` VALUES (15, "Разработка шрифтов", 2);
	INSERT INTO `categories` VALUES (3, "Другое", NULL);
	INSERT INTO `categories` VALUES (16, "Фотография", 3);
	INSERT INTO `categories` VALUES (17, "Обучение", 3);
	INSERT INTO `categories` VALUES (18, "Бытовые услуги", 3);
	INSERT INTO `categories` VALUES (19, "Курьерские поручиения", 3);
	INSERT INTO `categories` VALUES (20, "Няни, сиделки", 3);
	INSERT INTO `categories` VALUES (21, "Уход за животными", 3);
	INSERT INTO `categories` VALUES (22, "Перевозки", 3);
	INSERT INTO `categories` VALUES (23, "Уборка", 3);
	INSERT INTO `categories` VALUES (24, "Ремонт и обслуживание техники", 3);
	INSERT INTO `categories` VALUES (25, "Ремонт и строительство", 3);
	INSERT INTO `categories` VALUES (26, "Организация праздников", 3);
	INSERT INTO `categories` VALUES (4, "Программирование", NULL);
	INSERT INTO `categories` VALUES (27, "Разработка сайтов", 4);
	INSERT INTO `categories` VALUES (28, "Мобильные приложения", 4);
	INSERT INTO `categories` VALUES (29, "1С-программирование", 4);
	INSERT INTO `categories` VALUES (30, "QA (тестирование)", 4);
	INSERT INTO `categories` VALUES (31, "Защита информации", 4);
	INSERT INTO `categories` VALUES (5, "Реклама и маркетинг", NULL);
	INSERT INTO `categories` VALUES (32, "SMM (маркетинг в соцсетях)", 5);
	INSERT INTO `categories` VALUES (33, "Контекстная реклама", 5);
	INSERT INTO `categories` VALUES (34, "PR-менеджмент", 5);
	INSERT INTO `categories` VALUES (35, "Исследования рынка и опросы", 5);
	INSERT INTO `categories` VALUES (6, "Тексты", NULL);
	INSERT INTO `categories` VALUES (36, "Копирайтинг, Рерайтинг", 6);
	INSERT INTO `categories` VALUES (37, "Сканирование и распознавание", 6);
	INSERT INTO `categories` VALUES (38, "Стихи, Поэмы, Эссе", 6);
	INSERT INTO `categories` VALUES (39, "Тексты на иностранных языках", 6);
	INSERT INTO `categories` VALUES (40, "Новости, Пресс-релизы", 6);
commit;

Start transaction;
	INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 7, "custom_title_1", "custom_desc_1", 1000, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 14, "custom_title_2", "custom_desc_2", 2000, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 36, "custom_title_3", "custom_desc_3", 2000, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 36, "custom_title_4", "custom_desc_4", 2000, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 36, "custom_title_5", "custom_desc_5", 3000, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 27, "custom_title_6", "custom_desc_6", 3000, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 37, "custom_title_7", "custom_desc_7", 4500, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 18, "custom_title_8", "custom_desc_8", 7500, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 18, "custom_title_9", "custom_desc_9", 7500, 1);
    INSERT INTO `posts` (`user_id`, `category_id`, `title`, `description`, `price`, `is_task`) VALUES (0, 39, "custom_title_10", "custom_desc_10", 9000, 1);
commit; 

SET character_set_client = @saved_cs_client;