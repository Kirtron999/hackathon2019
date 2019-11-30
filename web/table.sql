CREATE DATABASE `hackathon`;
USE DATABASE `hackathon`;

# users
DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
    `id` int(11) NOT NULL auto_increment,
    `username` varchar(255) NOT NULL collate utf8_bin,
    `email` varchar(255) NOT NULL collate utf8_bin,
    `hash_bcrypt` varchar(64) NOT NULL collate utf8_bin,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
SET character_set_client = @saved_cs_client;