/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-01-15 23:54:05
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `prologue` text COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '1', '2012-12-01 23:23:56', 'Testovací článek', '1-testovaci-clanek', '<p>Úvod</p>', '<p>Obsah</p>');
INSERT INTO `article` VALUES ('2', '1', '2012-12-12 23:25:19', 'Testovací článek', '2-testovaci-clanek', '<p>Úvod</p>', '<p>Obsah</p>');
INSERT INTO `article` VALUES ('3', '1', '2012-12-13 23:25:13', 'Testovací článek', '3-testovaci-clanek', '<p>Úvod</p>', '<p>Obsah</p>');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES ('1', 'heyduk2@seznam.cz', '', 'Jakub Heyduk');

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
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('1', '1', '2012-12-27', 'Hejsánek', 'jaykub@heyduk.cz', '127.0.0.1', 'hello world!');
INSERT INTO `comment` VALUES ('2', '1', '2012-12-29', 'Hejsánek', 'something', '127.0.0.1', 'tu sem tu sám? :(');
INSERT INTO `comment` VALUES ('4', '1', '2013-01-03', 'sadsad', 'adasdasd@test.cz', '127.0.0.1', 'sadasd');
INSERT INTO `comment` VALUES ('5', '1', '2013-01-03', 'sadsad', 'adasdasd@test.cz', '127.0.0.1', 'sadasd');
INSERT INTO `comment` VALUES ('6', '1', '2013-01-03', 'sadsad', 'adasdasd@test.cz', '127.0.0.1', 'sadasd');
