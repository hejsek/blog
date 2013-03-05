/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50530
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50530
File Encoding         : 65001

Date: 2013-03-05 01:06:50
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) unsigned NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `prologue` text COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('2', '1', '1', '2012-12-12 23:25:19', 'Testovací článek', '2-testovaci-clanek', '<p>Úvod</p>', '<p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p><p>Obsah</p>.');
INSERT INTO `article` VALUES ('4', '1', '0', '2012-12-12 22:40:21', 'AHOJ', '', '', 'Dnes je ale krásný den, slunce svítí a na obloze není jedinný mráček.\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

-- ----------------------------
-- Table structure for `author`
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES ('1', 'heyduk2@seznam.cz', '', 'Jakub Heyduk');
INSERT INTO `author` VALUES ('2', 'hjkjhkj', '', 'jhkkh');

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL,
  `date` date NOT NULL,
  `author` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('7', '2', '2013-01-17', 'gfhgfhgf', 'hhffgh@ded.com', '127.0.0.1', 'ghgfh');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `password` char(60) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'test', '1234');
