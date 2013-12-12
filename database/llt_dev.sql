-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013-12-12 09:50:51
-- 服务器版本: 5.5.34-0ubuntu0.13.10.1
-- PHP 版本: 5.5.3-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `llt_dev`
--

-- --------------------------------------------------------

--
-- 表的结构 `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`type`, `name`, `migration`) VALUES
('package', 'auth', '001_auth_create_usertables'),
('package', 'auth', '002_auth_create_grouptables'),
('package', 'auth', '003_auth_create_roletables'),
('package', 'auth', '004_auth_create_permissiontables'),
('package', 'auth', '005_auth_create_authdefaults'),
('package', 'auth', '006_auth_add_authactions'),
('package', 'auth', '007_auth_add_permissionsfilter'),
('package', 'auth', '008_auth_create_providers'),
('package', 'auth', '009_auth_create_oauth2tables'),
('package', 'auth', '010_auth_fix_jointables'),
('app', 'default', '001_create_project_entries'),
('app', 'default', '002_create_users'),
('app', 'default', '003_create_items');

-- --------------------------------------------------------

--
-- 表的结构 `project_entries`
--

CREATE TABLE IF NOT EXISTS `project_entries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `abstract` text NOT NULL,
  `full_text` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `is_draft` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users`
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `group`, `email`, `last_login`, `login_hash`, `profile_fields`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '/ReKio0EZ6joCBm17Dzom8cHmwNh4ybvh6mZSf7Jq4E=', 100, '', '1386812417', '364337bad04ac46399255cb5a31124ba852a8036', '', 1386746289, 1386746289);

-- --------------------------------------------------------

--
-- 表的结构 `users_clients`
--

CREATE TABLE IF NOT EXISTS `users_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `client_id` varchar(32) NOT NULL DEFAULT '',
  `client_secret` varchar(32) NOT NULL DEFAULT '',
  `redirect_uri` varchar(255) NOT NULL DEFAULT '',
  `auto_approve` tinyint(1) NOT NULL DEFAULT '0',
  `autonomous` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('development','pending','approved','rejected') NOT NULL DEFAULT 'development',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `notes` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users_providers`
--

CREATE TABLE IF NOT EXISTS `users_providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `provider` varchar(50) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `expires` int(12) DEFAULT '0',
  `refresh_token` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users_scopes`
--

CREATE TABLE IF NOT EXISTS `users_scopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `scope` (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users_sessions`
--

CREATE TABLE IF NOT EXISTS `users_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL DEFAULT '',
  `redirect_uri` varchar(255) NOT NULL DEFAULT '',
  `type_id` varchar(64) NOT NULL,
  `type` enum('user','auto') NOT NULL DEFAULT 'user',
  `code` text NOT NULL,
  `access_token` varchar(50) NOT NULL DEFAULT '',
  `stage` enum('request','granted') NOT NULL DEFAULT 'request',
  `first_requested` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  `limited_access` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `oauth_sessions_ibfk_1` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users_sessionscopes`
--

CREATE TABLE IF NOT EXISTS `users_sessionscopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `access_token` varchar(50) NOT NULL DEFAULT '',
  `scope` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `access_token` (`access_token`),
  KEY `scope` (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `users_sessions`
--
ALTER TABLE `users_sessions`
  ADD CONSTRAINT `oauth_sessions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users_clients` (`client_id`) ON DELETE CASCADE;

--
-- 限制表 `users_sessionscopes`
--
ALTER TABLE `users_sessionscopes`
  ADD CONSTRAINT `oauth_sessionscopes_ibfk_1` FOREIGN KEY (`scope`) REFERENCES `users_scopes` (`scope`),
  ADD CONSTRAINT `oauth_sessionscopes_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `users_sessions` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
