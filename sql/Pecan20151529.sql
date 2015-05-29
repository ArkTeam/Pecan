-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 22 日 08:22
-- 服务器版本: 5.5.20
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
-- 表的结构 `ark_article`
--

CREATE TABLE IF NOT EXISTS `ark_article` (
  `id_ark_article` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(20) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `tags` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `source` varchar(50) DEFAULT NULL,
  `blog_content` text,
  `is_verify` int(1) DEFAULT '0',
  `is_private` int(1) DEFAULT '0',
  `posttime` int(11) DEFAULT NULL,
  `updatetime` int(11) NOT NULL,
  `d_tag` int(1) DEFAULT '0',
  UNIQUE KEY `id_ark_article` (`id_ark_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;


-- --------------------------------------------------------

--
-- 表的结构 `ark_config_vars`
--

CREATE TABLE IF NOT EXISTS `ark_config_vars` (
  `id_ark_config_vars` int(11) NOT NULL AUTO_INCREMENT,
  `var_name` varchar(50) DEFAULT NULL,
  `var_value` varchar(50) DEFAULT NULL,
  `d_tag` int(1) DEFAULT '0',
  UNIQUE KEY `id_ark_config_vars` (`id_ark_config_vars`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;



-- --------------------------------------------------------

--
-- 表的结构 `ark_update_file`
--

CREATE TABLE IF NOT EXISTS `ark_update_file` (
  `id_ark_update_file` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(20) DEFAULT NULL,
  `path` varchar(20) DEFAULT NULL,
  `upload_time` int(11) DEFAULT NULL,
  `d_tag` int(1) DEFAULT NULL,
  UNIQUE KEY `id_ark_update_file` (`id_ark_update_file`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ark_upload_pic`
--

CREATE TABLE IF NOT EXISTS `ark_upload_pic` (
  `id_ark_upload_pic` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `path` varchar(20) DEFAULT NULL,
  `upload_time` int(11) DEFAULT NULL,
  `d_tag` int(1) DEFAULT NULL,
  UNIQUE KEY `id_ark_upload_pic` (`id_ark_upload_pic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ark_user`
--

CREATE TABLE IF NOT EXISTS `ark_user` (
  `id_ark_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `portraitpath` varchar(100) NOT NULL,
  `regtime` int(11) DEFAULT NULL,
  `d_tag` int(1) DEFAULT '0',
  UNIQUE KEY `id_ark_user` (`id_ark_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;


CREATE TABLE IF NOT EXISTS `ark_inspiration` (
  `id_ark_inspiration` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `inspiration_content` text,
  `is_verify` int(1) DEFAULT '0',
  `is_private` int(1) DEFAULT '0',
  `posttime` int(11) DEFAULT NULL,
  `updatetime` int(11) NOT NULL,
  `d_tag` int(1) DEFAULT '0',
  UNIQUE KEY `id_ark_inspiration` (`id_ark_inspiration`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
-- --------------------------------------------------------

 