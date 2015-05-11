-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 11 日 10:25
-- 服务器版本: 5.6.17
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `arkblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `ark_category`
--

CREATE TABLE IF NOT EXISTS `ark_category` (
  `id_ark_category` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `category_name` varchar(20) DEFAULT NULL,
  `d_tag` int(1) DEFAULT NULL,
  UNIQUE KEY `id_ark_catetory` (`id_ark_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ark_category`
--

INSERT INTO `ark_category` (`id_ark_category`, `parent_id`, `category_name`, `d_tag`) VALUES
(1, NULL, 'java', NULL),
(2, NULL, 'php', NULL),
(3, NULL, 'python', NULL),
(4, NULL, 'c', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
