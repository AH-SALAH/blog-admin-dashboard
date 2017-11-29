-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2017 at 03:51 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_theme_option`
--

CREATE TABLE IF NOT EXISTS `admin_theme_option` (
  `theme_id` int(11) NOT NULL,
  `header_color` varchar(20) NOT NULL,
  `left_nav_color` varchar(20) NOT NULL,
  `left_nav_btns_bg_color` varchar(20) NOT NULL,
  `left_nav_btns_color` varchar(20) NOT NULL,
  `footer_color` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_theme_option`
--

INSERT INTO `admin_theme_option` (`theme_id`, `header_color`, `left_nav_color`, `left_nav_btns_bg_color`, `left_nav_btns_color`, `footer_color`, `user_id`) VALUES
(1, '7E77C8', '706FA2', 'FFBB25', '551625', '726FA4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `attach_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `attach_name` varchar(100) NOT NULL,
  `attach_tag` varchar(60) DEFAULT NULL,
  `attach_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`attach_id`, `user_id`, `post_id`, `attach_name`, `attach_tag`, `attach_date`) VALUES
(119, 7, NULL, 'admin_2017-03-18--03-41-33.jpg', NULL, '0000-00-00 00:00:00'),
(120, 7, NULL, 'gray-1366x768.jpg', NULL, '0000-00-00 00:00:00'),
(121, 7, NULL, 'power_symbol.jpg', NULL, '0000-00-00 00:00:00'),
(124, 7, NULL, 'admin2.jpg', NULL, '0000-00-00 00:00:00'),
(130, 8, NULL, 'admin_2017-03-19--05-01-45.jpg', NULL, '0000-00-00 00:00:00'),
(131, 8, NULL, 'gray-1366x768_2017-03-19--06-22-49.jpg', NULL, '2017-03-19 06:22:49'),
(132, 8, NULL, 'power_symbol_2017-03-19--07-29-31.jpg', NULL, '2017-03-19 07:29:31'),
(133, 8, NULL, 'admin2_2017-03-19--08-06-47.jpg', NULL, '2017-03-19 08:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_num` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_author` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `com_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'comment approval',
  `comment_date` datetime NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_num`, `post_id`, `comment_author`, `comment`, `com_status`, `comment_date`, `last_modified`) VALUES
(14, 1, 4, 8, 'ay comment keda wenaby..lkhvod khemdat levavy elyahu hanaby..', 1, '2017-03-21 06:08:15', '2017-03-31 23:32:25'),
(15, 2, 4, 8, 'ay komment in the sake of testing another comment row ..', 0, '2017-04-01 02:06:16', '2017-03-31 23:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL,
  `post_num` int(11) NOT NULL,
  `post_author` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` mediumtext NOT NULL,
  `attach_id` int(11) DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_likes_id` text NOT NULL COMMENT 'like / id',
  `post_likes` int(11) NOT NULL DEFAULT '0' COMMENT 'likes counter',
  `post_dislikes` int(11) NOT NULL DEFAULT '0' COMMENT 'dislikes counter',
  `post_views_date` date DEFAULT NULL COMMENT 'for every 1 day',
  `post_views_ip` text NOT NULL COMMENT 'unique views ips / day',
  `post_views` int(11) NOT NULL DEFAULT '0' COMMENT 'count views',
  `post_nonce` varchar(255) DEFAULT NULL,
  `post_nonce_expired` datetime DEFAULT NULL,
  `post_created_at` datetime NOT NULL,
  `post_last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_num`, `post_author`, `post_title`, `post_content`, `attach_id`, `post_tags`, `post_likes_id`, `post_likes`, `post_dislikes`, `post_views_date`, `post_views_ip`, `post_views`, `post_nonce`, `post_nonce_expired`, `post_created_at`, `post_last_updated`) VALUES
(2, 1, 8, 'ay title..', 'hay content..', 133, NULL, '', 0, 0, '2017-04-09', '::1 ', 1, NULL, NULL, '2017-03-19 05:20:25', '2017-04-09 21:45:12'),
(3, 2, 8, 'ay title..rabe3 marra', 'hay content..rabe3 marra', 131, NULL, '8_lk,', 1, 0, '2017-04-13', '::1 ::1 ', 2, NULL, NULL, '2017-03-19 05:33:55', '2017-04-13 08:33:55'),
(4, 3, 8, 'ay title..khames marra', '&lt;p&gt;ay conteny khames marra..... kaman marra..wekaman marra...&lt;/p&gt;\r\n&lt;div&gt;&lt;img class=&quot;img-responsive&quot; src=&quot;uploads/gallery/gray-1366x768.jpg&quot; width=&quot;200&quot; height=&quot;200&quot; /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;another extended content...&lt;/div&gt;', 121, 'test,tag1,tag2', '', 0, 0, NULL, '', 0, 'bef2ccf688fbc7194819a6c156d42c0e8d1055e4155e4c23c86c8568c9877ea56d0d382dec83ced3374758295e2210262ae679ab81533e1b31242515b83be4d4', '2017-04-12 06:27:10', '2017-03-19 07:32:02', '2017-04-12 04:25:10'),
(5, 4, 8, 'first post title', 'ay content keda 3ashan neshof', NULL, NULL, '', 0, 0, NULL, '', 0, NULL, NULL, '2017-03-21 07:43:35', '2017-04-09 19:26:30'),
(17, 5, 8, '&amp;#34;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&amp;#34;', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean semper congue neque non iaculis. Nulla lacinia venenatis vulputate. Donec feugiat, dui a vehicula cursus, dui enim mattis enim, sit amet accumsan risus lacus a nisi. Duis blandit dui velit. Ut in nibh auctor, lacinia ante eget, facilisis dolor. Etiam vitae nisi magna. Nulla libero urna, tempus id libero non, faucibus dapibus nulla. Aenean eget ante non lorem posuere vehicula ut posuere diam. Proin efficitur ligula vel semper eleifend. Sed sollicitudin ut tortor sit amet auctor. Donec at vulputate velit. Ut faucibus neque vitae lacus vestibulum placerat. Curabitur eu velit vitae ante volutpat commodo. Nulla dictum tortor at dapibus malesuada. Phasellus sagittis nunc risus, non pulvinar est tristique id.&lt;/div&gt;\r\n&lt;div&gt;&lt;img class=&quot;img-responsive&quot; style=&quot;display: block; margin-left: auto; margin-right: auto;&quot; src=&quot;uploads/gallery/gray-1366x768.jpg&quot; alt=&quot;polygon&quot; width=&quot;300&quot; height=&quot;200&quot; /&gt;&lt;/div&gt;\r\n&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean semper congue neque non iaculis. Nulla lacinia venenatis vulputate. Donec feugiat, dui a vehicula cursus, dui enim mattis enim, sit amet accumsan risus lacus a nisi. Duis blandit dui velit. Ut in nibh auctor, lacinia ante eget, facilisis dolor. Etiam vitae nisi magna. Nulla libero urna, tempus id libero non, faucibus dapibus nulla. Aenean eget ante non lorem posuere vehicula ut posuere diam. Proin efficitur ligula vel semper eleifend. Sed sollicitudin ut tortor sit amet auctor. Donec at vulputate velit. Ut faucibus neque vitae lacus vestibulum placerat. Curabitur eu velit vitae ante volutpat commodo. Nulla dictum tortor at dapibus malesuada. Phasellus sagittis nunc risus, non pulvinar est tristique id.&lt;/div&gt;', NULL, 'tag1,tag2', '', 0, 0, NULL, '', 0, NULL, NULL, '2017-04-04 06:32:16', '2017-04-09 19:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `user_num` int(11) NOT NULL COMMENT 'rearrange users',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT 'determine user group id',
  `user_type` enum('admin','publisher','user','') NOT NULL DEFAULT 'user' COMMENT 'defining user identity',
  `reg_status` smallint(6) DEFAULT '0' COMMENT 'user approval',
  `attach_id` int(11) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expired` datetime DEFAULT NULL,
  `registered` datetime NOT NULL,
  `last_logged_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_num`, `first_name`, `last_name`, `user_name`, `email`, `password`, `group_id`, `user_type`, `reg_status`, `attach_id`, `reset_token`, `token_expired`, `registered`, `last_logged_in`) VALUES
(3, 2, 'ahmed', 'sass', 'welly lelly', 'allt@sda.com', '$2y$10$.2yZABJ0j9chtLxKL1SPnurujywj3oa9cuW81NGnilZDitlt1z4uO', 2, 'publisher', 0, NULL, NULL, NULL, '2017-03-02 13:08:04', '2017-03-27 23:50:57'),
(7, 3, 'm', 's', 'mohamed', 'mohamed@we.com', '$2y$10$bGpqaWlvdXk2NTY3NTQ0Mu4BiYrmAKwIj0xJODQXbwuJ6PGUUB1Yy', 1, 'admin', 1, 124, NULL, NULL, '2017-03-16 22:59:36', '2017-03-27 17:45:28'),
(8, 4, 'aaaaa', 'sasss', 'ahmed', 'ahmed@we.com', '$2y$10$bGpqaWlvdXk2NTY3NTQ0Mu8v5OiHEC57wCQbAzdAaG6bHll3uUgbm', 1, 'admin', 1, 130, NULL, NULL, '2017-03-19 03:57:16', '2017-03-28 15:51:40'),
(20, 5, 'ssss', 'ssss', 'haim', 'haim@moshe.com', '$2y$10$bGpqaWlvdXk2NTY3NTQ0MuCyI3ctzx/XO8murD1QJf.PZ2iKsHowe', 0, 'user', 0, NULL, NULL, NULL, '2017-03-27 02:40:23', '2017-03-27 23:50:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_theme_option`
--
ALTER TABLE `admin_theme_option`
  ADD PRIMARY KEY (`theme_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`attach_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `comment_author` (`comment_author`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_views_date` (`post_views_date`),
  ADD KEY `post_author` (`post_author`),
  ADD KEY `attach_id` (`attach_id`),
  ADD KEY `post_num` (`post_num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `profile_pic` (`attach_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_theme_option`
--
ALTER TABLE `admin_theme_option`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `attach_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_theme_option`
--
ALTER TABLE `admin_theme_option`
  ADD CONSTRAINT `admin_theme` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `post_attach_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`attach_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_comment` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`comment_author`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_attach` FOREIGN KEY (`attach_id`) REFERENCES `attachments` (`attach_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `post_user` FOREIGN KEY (`post_author`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_attach_id` FOREIGN KEY (`attach_id`) REFERENCES `attachments` (`attach_id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
