CREATE DATABASE IF NOT EXISTS `hackathon`;
USE `hackathon`;

SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
# users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(11) NOT NULL auto_increment,
    `username` varchar(255) NOT NULL collate utf8_bin,
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
    `title` varchar(255) NOT NULL collate utf8_bin,
	`description` text collate utf8_bin,
	`category` int(11) NOT NULL,
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

SET character_set_client = @saved_cs_client;