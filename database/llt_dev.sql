-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013-12-13 09:44:23
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
-- 表的结构 `adminsms`
--

CREATE TABLE IF NOT EXISTS `adminsms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ower_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isread` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `adminsms`
--

INSERT INTO `adminsms` (`id`, `ower_id`, `action`, `type`, `user_id`, `isread`, `obj_id`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '2', 1, 1, 1, 1386838698, 1386842334),
(7, 1, '发布了', '2', 1, 0, 1, 1386838698, 1386839963),
(8, 1, '发布了', '2', 1, 0, 1, 1386838698, 1386839963),
(9, 1, '发布了', '2', 1, 0, 1, 1386838698, 1386839963),
(10, 1, '发布了', '2', 1, 0, 1, 1386838698, 1386839963),
(11, 1, '发布了', '2', 1, 0, 1, 1386838698, 1386839963),
(12, 1, '发布了', '2', 1, 0, 1, 1386838698, 1386839963),
(13, 1, '发布了', '2', 1, 0, 1, 1386838698, 1386839963),
(14, 1, '发布了', '2', 1, 1, 1, 1386838698, 1386850486),
(15, 1, '发布了', '2', 1, 0, 1, 1386838698, 1386839963),
(16, 1, '发布了', '2', 1, 1, 1, 1386838698, 1386848913),
(17, 1, '发布了', '2', 1, 1, 1, 1386838698, 1386850382),
(18, 1, '发布了', '2', 2, 1, 1, 1386838698, 1386848785),
(19, 2, '发布了', '2', 2, 0, 1, 1386838698, 1386839963),
(20, 2, '发布了', '2', 2, 0, 1, 1386838698, 1386839963),
(21, 2, '发布了', '2', 2, 0, 1, 1386838698, 1386839963),
(22, 2, '发布了', '2', 2, 0, 1, 1386838698, 1386839963),
(23, 2, '发布了', '2', 2, 0, 1, 1386838698, 1386839963),
(24, 2, '发布了', '2', 2, 0, 1, 1386838698, 1386839963),
(25, 2, '发布了', '2', 2, 0, 1, 1386838698, 1386839963),
(26, 2, '发布了', '2', 2, 0, 1, 1386838698, 1386839963),
(27, 2, '发布了11111111111111', '2', 1, 0, 1, 1386838698, 1386839963),
(28, 1, '发布了11111111111111', '2', 1, 1, 1, 1386838698, 1386850021),
(29, 9, '发布了11111111111111', '2', 1, 1, 1, 1386838698, 1386846320),
(30, 9, '发布了11111111111111', '2', 1, 1, 1, 1386838698, 1386846322);

-- --------------------------------------------------------

--
-- 表的结构 `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `desc` text NOT NULL,
  `price` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `items`
--

INSERT INTO `items` (`id`, `title`, `image`, `images`, `desc`, `price`, `cate_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 'fffffffffffffffffffff', 'upload/item/origin/f5a1b366e94f798d914c51443be3de5a.png', 'a:1:{i:0;s:55:"upload/item/origin/f5a1b366e94f798d914c51443be3de5a.png";}', 'ffffffffffff', 342, 1, 0, 1386850568, 1386850568),
(4, 'ffffffffffffffffff222', 'upload/item/origin/009d8a31fc2ad46d19bfe5519507fa7d.png', 'a:1:{i:0;s:55:"upload/item/origin/009d8a31fc2ad46d19bfe5519507fa7d.png";}', '333333333333333', 113, 1, 0, 1386850598, 1386851616),
(5, 'bbbbbbbbbbbbbbbbbb', 'upload/item/origin/90bcde02f8b2f0bbe78bbd8d359686d6.png', 'a:1:{i:0;s:55:"upload/item/origin/90bcde02f8b2f0bbe78bbd8d359686d6.png";}', 'ffffffffffffffffff', 232, 1, 0, 1386850663, 1386850663),
(6, 'fffffffffffffffffffffffffffffff', 'upload/item/origin/7a261efda044d1e381b992f76c62216b.png', 'a:1:{i:0;s:55:"upload/item/origin/7a261efda044d1e381b992f76c62216b.png";}', 'ffffffffffffffffffffffffffffffff', 343, 4, 0, 1386850844, 1386850844),
(7, 'Ggggggggggggggg44', 'upload/item/origin/e77bc9751cdcf776b2ea0bc52d8f9101.png', 'a:1:{i:0;s:55:"upload/item/origin/e77bc9751cdcf776b2ea0bc52d8f9101.png";}', '33333333333333333333333333333333333', 343, 1, 0, 1386850862, 1386851766);

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
('app', 'default', '003_create_posts'),
('app', 'default', '004_create_tests'),
('app', 'default', '005_rename_table_users_to_accounts'),
('app', 'default', '006_add_bio_to_accounts'),
('app', 'default', '007_delete_bio_from_accounts'),
('app', 'default', '008_add_topimage_to_posts'),
('app', 'default', '009_add_images_to_posts'),
('app', 'default', '012_rename_table_accounts_to_users'),
('app', 'default', '013_delete_topimage_from_posts'),
('app', 'default', '014_add_topimage_to_posts'),
('app', 'default', '015_create_adminsms'),
('app', 'default', '016_delete_group_from_users'),
('app', 'default', '017_add_group_to_users');

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `status` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `topimage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `title`, `desc`, `status`, `item_id`, `user_id`, `type_id`, `phase_id`, `created_at`, `updated_at`, `images`, `topimage`) VALUES
(1, '1111', '22222', 1, 1, 1, 1, 1, 1386846103, 1386846103, 'asdfffffffffffffffffffffffffff', 'sddddddddddddd'),
(2, '非常值得', 'aaaaaaaaaaaaaaaaaaa', 1, 1, 1, 1, 1, 1386846123, 1386846123, '1111111111111123', '1111111111111111'),
(3, '非常值得', 'sdffffffffffffffffffffffff', 1, 1, 1, 1, 2, 1386846144, 1386846144, '3333333333333333333', '122222222222222222222');

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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_login` varchar(25) NOT NULL,
  `login_hash` varchar(255) NOT NULL,
  `profile_fields` text NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `last_login`, `login_hash`, `profile_fields`, `created_at`, `updated_at`, `group`) VALUES
(1, 'admin', '/ReKio0EZ6joCBm17Dzom8cHmwNh4ybvh6mZSf7Jq4E=', 'admin@admin.com', '1386898974', '423e1c04afbc8704564976a897c6b1570751b8a5', 'a:0:{}', 1386827637, 1386848761, 100),
(2, 'test1', 'kVT4gz//W0+Ar6ozP+tmud3UM+0+jLKsWC8aLiUos74=', 'test1@admin.com', '1386827768', '89d9fb9d1d3b4182939e76c1eafd6b90b71e3bf0', 'a:0:{}', 1386827652, 1386847491, 50),
(3, 'test2', 'kVT4gz//W0+Ar6ozP+tmud3UM+0+jLKsWC8aLiUos74=', 'test2@admin.com', '1386827776', 'f82d723afc92bf24c0de912b3f769a284825d267', 'a:0:{}', 1386827660, 1386848243, 50),
(6, 'test5', 'kVT4gz//W0+Ar6ozP+tmud3UM+0+jLKsWC8aLiUos74=', '1@2.com', '1386835855', 'a06785ecb101106533007933b16d88dcb8c5cf1e', 'a:0:{}', 1386832538, 1386850622, 100),
(7, 'test6', 'kVT4gz//W0+Ar6ozP+tmud3UM+0+jLKsWC8aLiUos74=', '11@2.com', '0', '', 'a:0:{}', 1386832837, 1386848232, 100),
(8, 'test7', 'kVT4gz//W0+Ar6ozP+tmud3UM+0+jLKsWC8aLiUos74=', '111@2.com', '0', '', 'a:0:{}', 1386832984, NULL, 1),
(9, 'test8', 'kVT4gz//W0+Ar6ozP+tmud3UM+0+jLKsWC8aLiUos74=', '113@2.com', '1386846258', '86b0f2774e6ed8cd205e86ee180bfb9329505d61', 'a:10:{s:2:"id";s:1:"9";s:8:"username";s:5:"test8";s:8:"password";s:44:"kVT4gz//W0+Ar6ozP+tmud3UM+0+jLKsWC8aLiUos74=";s:5:"group";s:2:"50";s:5:"email";s:9:"113@2.com";s:10:"last_login";s:1:"0";s:10:"login_hash";s:0:"";s:14:"profile_fields";s:288:"a:9:{s:2:"id";s:1:"9";s:8:"username";s:5:"test8";s:8:"password";s:44:"kVT4gz//W0+Ar6ozP+tmud3UM+0+jLKsWC8aLiUos74=";s:5:"group";s:2:"50";s:5:"email";s:9:"113@2.com";s:10:"last_login";s:1:"0";s:10:"login_hash";s:0:"";s:14:"profile_fields";s:6:"a:0:{}";s:10:"created_at";s:10:"1386833052";}";s:10:"created_at";s:10:"1386833052";s:10:"updated_at";s:10:"1386833951";}', 1386833052, 1386848330, 1);

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
