-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2014 at 04:16 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `llt_bro`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `zone` int(1) NOT NULL,
  `type` int(1) NOT NULL,
  `sort` int(3) NOT NULL,
  `start_at` int(11) NOT NULL,
  `end_at` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `identifier` varchar(100) NOT NULL,
  `contents` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

-- --------------------------------------------------------

--
-- Table structure for table `cates`
--

CREATE TABLE IF NOT EXISTS `cates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `is_delete` int(1) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `source` varchar(255) DEFAULT 'web' COMMENT '来源',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invitcodes`
--

CREATE TABLE IF NOT EXISTS `invitcodes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(8) NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `award` int(11) unsigned DEFAULT '0' COMMENT '礼品奖励',
  `status` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) unsigned DEFAULT '0',
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=188 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `desc` text NOT NULL,
  `price` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `phase` int(11) NOT NULL DEFAULT '0' COMMENT '运行期数，0为不限制',
  `status` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `is_recommend` tinyint(1) unsigned DEFAULT '0',
  `is_delete` int(1) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cate_id` (`cate_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4917 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '用户类型',
  `nickname` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `last_login` int(11) NOT NULL,
  `ip` varchar(15) DEFAULT '' COMMENT '用户地址',
  `email` varchar(255) NOT NULL,
  `login_hash` varchar(255) NOT NULL,
  `profile_fields` text NOT NULL,
  `is_mobile` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_disable` int(1) DEFAULT '0',
  `is_delete` int(1) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10267 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_addresses`
--

CREATE TABLE IF NOT EXISTS `member_addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_brokerages`
--

CREATE TABLE IF NOT EXISTS `member_brokerages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(1) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `target_id` int(10) unsigned NOT NULL,
  `points` int(10) NOT NULL DEFAULT '0',
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_emails`
--

CREATE TABLE IF NOT EXISTS `member_emails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_delete` int(11) NOT NULL,
  `deadtime` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_infos`
--

CREATE TABLE IF NOT EXISTS `member_infos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birth` varchar(255) NOT NULL,
  `qq` varchar(255) NOT NULL,
  `horoscope` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_invits`
--

CREATE TABLE IF NOT EXISTS `member_invits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) NOT NULL,
  `invit_id` int(10) NOT NULL,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_mobiles`
--

CREATE TABLE IF NOT EXISTS `member_mobiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `code` varchar(6) NOT NULL,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_moneylogs`
--

CREATE TABLE IF NOT EXISTS `member_moneylogs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phase_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `sum` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `source` text NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=280 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_sms`
--

CREATE TABLE IF NOT EXISTS `member_sms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `is_top` int(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `is_delete` int(1) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phase_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `codes` mediumtext NOT NULL,
  `code_count` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `area` varchar(20) NOT NULL,
  `ordered_at` decimal(13,3) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `phase_id` (`phase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=176 ;

-- --------------------------------------------------------

--
-- Table structure for table `phases`
--

CREATE TABLE IF NOT EXISTS `phases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `remain` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `joined` int(11) NOT NULL,
  `hots` int(11) NOT NULL,
  `code` varchar(12) NOT NULL,
  `codes` mediumtext NOT NULL,
  `code_count` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_recommend` tinyint(1) unsigned DEFAULT '0',
  `is_delete` int(1) NOT NULL,
  `opentime` int(11) NOT NULL,
  `total` varchar(20) NOT NULL,
  `results` text NOT NULL,
  `item_created_at` int(11) NOT NULL,
  `order_created_at` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `cate_id` (`cate_id`),
  KEY `brand_id` (`brand_id`),
  KEY `cost` (`cost`),
  KEY `remain` (`remain`),
  KEY `hots` (`hots`),
  KEY `opentime` (`opentime`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `status` int(11) DEFAULT '0',
  `item_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT '0',
  `phase_id` int(11) NOT NULL,
  `lottery_id` int(11) NOT NULL,
  `topimage` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `up` int(11) DEFAULT '0',
  `comment_count` int(11) DEFAULT '0',
  `comment_top` int(11) DEFAULT '0',
  `award` tinyint(1) DEFAULT '0',
  `post_point` int(11) unsigned DEFAULT '0' COMMENT '晒单奖励',
  `award_point` int(11) unsigned DEFAULT '0' COMMENT '爆照奖励',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `reason` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `member_id` (`member_id`),
  KEY `phase_id` (`phase_id`),
  KEY `lottery_id` (`lottery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE IF NOT EXISTS `shippings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `excode` varchar(20) NOT NULL,
  `exname` varchar(255) NOT NULL,
  `exdesc` text NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `suggests`
--

CREATE TABLE IF NOT EXISTS `suggests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` int(12) DEFAULT '0' COMMENT '手机',
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `text` text NOT NULL COMMENT '建议内容',
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_delete` int(2) DEFAULT '0' COMMENT '假删除',
  `email` varchar(256) DEFAULT '''''' COMMENT '邮箱',
  `nickname` varchar(256) DEFAULT '''''' COMMENT '昵称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `last_login` varchar(25) NOT NULL,
  `login_hash` varchar(255) NOT NULL,
  `profile_fields` text NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(2) DEFAULT '0' COMMENT '假删除',
  `mobile` varchar(12) DEFAULT '0' COMMENT '管理员手机',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
