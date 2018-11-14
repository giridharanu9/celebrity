-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2018 at 03:14 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.1.23-2+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lr_celebrity`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `name`, `points`, `created_at`, `updated_at`) VALUES
(1, 'Invite Facebook Friends', '10', '2018-09-27 02:33:14', '2018-09-27 02:33:14'),
(2, 'Follow A Celebrity', '10', '2018-09-27 02:33:43', '2018-09-28 00:41:41'),
(3, 'Unfollow A Celebrity', '-10', '2018-09-27 02:33:51', '2018-09-28 00:42:20'),
(4, 'Email Registration', '10', '2018-09-27 02:34:14', '2018-09-27 02:34:14'),
(5, 'Twitter Registration', '10', '2018-09-27 02:34:23', '2018-09-27 02:34:23'),
(6, 'Instagram Registration', '10', '2018-09-27 02:34:37', '2018-09-27 02:34:37'),
(7, 'Facebook Registration', '10', '2018-09-27 02:34:46', '2018-09-27 02:34:46'),
(8, 'Google Registration', '10', '2018-09-27 02:35:00', '2018-09-27 02:35:00'),
(10, 'Daily Login', '0.5', '2018-09-27 02:35:54', '2018-09-27 02:35:54'),
(11, 'User Profile Followers', '1', '2018-09-27 02:37:19', '2018-09-27 02:37:19'),
(12, 'Follow A User', '1', '2018-09-27 02:37:34', '2018-09-27 02:37:34'),
(15, 'Celebrity Skill Rating', '1', '2018-09-28 06:26:40', '2018-09-28 06:26:40'),
(13, 'User Profile Unfollowers', '-1', '2018-09-28 03:09:02', '2018-09-28 03:09:02'),
(14, 'Unfollow A User', '-1', '2018-09-28 03:09:17', '2018-09-28 03:09:17'),
(16, 'Answering Polls', '1', '2018-09-28 08:08:35', '2018-09-28 08:08:35'),
(17, 'Subscription', '10', '2018-10-01 07:38:40', '2018-10-01 07:38:40'),
(18, 'Sign Up Using Reference', '10', '2018-10-02 00:44:20', '2018-10-02 00:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categorytitle` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `category_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categorytitle`, `status`, `category_parent`, `created_at`, `updated_at`) VALUES
(1, 'Artist', 1, 0, '2018-04-16 10:21:56', '2018-04-16 05:39:22'),
(2, 'Sports', 1, 0, '2018-04-16 10:23:42', '2018-04-16 05:39:28'),
(3, 'Actor', 1, 0, '2018-04-16 10:23:51', '2018-04-16 13:04:45'),
(4, 'Politician', 1, 0, '2018-04-16 05:31:59', '2018-04-16 05:49:12'),
(5, 'Singer', 1, 0, '2018-04-16 05:32:29', '2018-04-16 05:41:57'),
(6, 'Actress', 1, 0, '2018-10-02 06:54:01', '2018-10-02 12:24:16'),
(9, 'testcat', 1, 0, '2018-11-03 00:21:58', '2018-11-03 00:21:58'),
(10, 'test sb cat', 1, 9, '2018-11-03 00:23:09', '2018-11-03 00:49:31'),
(11, 'test sb cat 2', 1, 9, '2018-11-03 05:01:29', '2018-11-03 05:01:29'),
(12, 'Test200', 1, 9, '2018-11-05 08:02:34', '2018-11-05 08:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `celebrities`
--

CREATE TABLE `celebrities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categoryid` int(11) NOT NULL,
  `parent_category_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `skills` varchar(255) NOT NULL,
  `gender` varchar(225) DEFAULT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `like_count` int(11) DEFAULT '0',
  `follow_count` int(11) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `image` varchar(255) NOT NULL,
  `twitter_id` varchar(255) NOT NULL,
  `insta_frame` varchar(500) NOT NULL,
  `fb_frame` varchar(500) NOT NULL,
  `uniqueurl` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `celebrities`
--

INSERT INTO `celebrities` (`id`, `name`, `description`, `categoryid`, `parent_category_id`, `skills`, `gender`, `date_of_birth`, `age`, `like_count`, `follow_count`, `status`, `image`, `twitter_id`, `insta_frame`, `fb_frame`, `uniqueurl`, `created_at`, `updated_at`) VALUES
(15, 'Virat Kohli', 'ssas asdsad asdasd', 2, 0, '6,7', 'Male', '1989-10-01', 28, 1, 0, 1, '1537357488_virat-kohli.jpeg', 'imVkohli', 'https://web.stagram.com/virat.kohli', 'virat.kohli', 'virat-kohli', '2018-10-15 14:18:26', '2018-10-15 14:18:26'),
(14, 'Anushka Sharma', 'sdfsdf sdf sdf sd', 6, 0, '4', 'Female', '1989-10-01', 28, -1, 0, 1, '1538384189_anushka-sharma.jpeg', 'AnushkaSharma', 'https://web.stagram.com/anushkasharma', 'AnushkaSharmaOfficial', 'anushka-sharma', '2018-10-15 14:04:35', '2018-10-15 14:04:35'),
(13, 'Tiger Shroff', 'asdasdasd dasdasd', 3, 0, '4', 'Male', '1989-10-01', 28, 1, 1, 1, '1537353946_tiger-shroff.jpeg', 'iTIGERSHROFF', 'https://web.stagram.com/tigerjackieshroff', 'TigerShroff', 'tiger-shroff', '2018-10-19 13:05:57', '2018-10-19 13:05:57'),
(12, 'Sushant Singh Rajput', 'an actor he is', 3, 0, '2', 'Male', '1989-10-01', 28, 0, 0, 1, '1537353917_sushant-singh-rajput.jpeg', 'ItsSSRworld', 'https://web.stagram.com/sushantsinghrajput', 'SushantSinghRajput', 'sushant-singh-rajput', '2018-09-19 05:15:17', '2018-10-04 08:52:47'),
(11, 'Disha Patani', 'she is an actress', 6, 0, '3', 'Female', '1989-10-01', 28, 1, 0, 1, '1537351865_disha-patani.jpeg', 'DishPatani', 'https://web.stagram.com/dishapatani', 'dishap00', 'disha-patani', '2018-10-15 13:58:55', '2018-10-15 13:58:55'),
(10, 'Alia Bhat', 'she is an actress', 6, 0, '1', 'Female', '1992-10-01', 19, 0, -1, 1, '1537351835_alia-bhat.jpeg', 'aliaa08', 'https://web.stagram.com/aliaabhatt', 'ImAliaaBhatt', 'alia-bhat', '2018-09-19 04:40:35', '2018-10-05 04:03:49'),
(16, 'Sindhu', 'erfwer werwerwer', 2, 0, '2', 'Female', '1989-10-01', 28, 0, 0, 1, '1537357517_sindhu.jpeg', 'Pvsindhu1', 'https://web.stagram.com/pvsindhu1', 'PVSindhu.OGQ', 'sindhu', '2018-09-19 06:15:17', '2018-10-04 08:55:07'),
(18, 'Shirley Setia', 'fghdfhsfsdfdfsdf', 5, 0, '3', 'Female', '1989-10-01', 28, 0, 0, 1, '1538384362_sharley-sethi.jpeg', 'ShirleySetia', 'https://web.stagram.com/shirleysetia', 'shirleysetia', 'sharley-sethi', '2018-09-19 07:24:24', '2018-10-04 08:55:11'),
(20, 'Varun Dhawan', 'sadsa adsdsd sdfasdffdf', 3, 0, '4', 'Male', '1989-10-01', 28, 0, 2, 1, '1538384066_varun-dhawan.jpeg', 'varun_dvn', 'https://web.stagram.com/varundvn', 'VarunDhawan.co', 'varun-dhawan', '2018-09-20 02:07:34', '2018-10-05 04:16:14'),
(21, 'Kriti Sanon', 'dsad sadsadas sdsad', 6, 0, '4', 'Female', '1989-10-01', 28, 1, 0, 1, '1537429209_kriti-sanon.jpeg', 'kritisanon', 'https://web.stagram.com/kritisanon', 'OfficialKS10', 'kriti-sanon', '2018-10-14 18:09:36', '2018-10-14 18:09:36'),
(22, 'Shraddha Kapoor', 'dfsdf fsdf sdfs sdfsdfsdf sd', 6, 0, '4', 'Female', '1989-10-01', 28, 0, 0, 1, '1537430035_shraddha-kapoor.jpeg', 'ShraddhaKapoor', 'https://web.stagram.com/shraddhakapoor', 'ShraddhaKapoor', 'shraddha-kapoor', '2018-09-20 02:23:55', '2018-10-04 08:55:17'),
(29, 'Mohammed Irfan', 'Young Singer With Huge Singing Quality', 5, 0, '2', 'Male', '1989-10-01', 28, 4, 7, 1, '1538457279_mohammed-irfan.jpeg', 'Md_Irfan17', 'https://web.stagram.com/mohammedirfanali', 'Mohammed-Irfan-215325028479116', 'mohammed-irfan', '2018-10-15 14:18:11', '2018-10-15 14:18:11'),
(28, 'Arijit Singh', 'Best singer of blllywood', 5, 0, '1', 'Male', '1980-10-01', 37, 0, 0, 1, '1538385273_arijit-singh.jpeg', 'TheArijitSingh', 'https://web.stagram.com/arijitsingh', 'Arijitsingh', 'arijit-singh', '2018-10-01 03:44:33', '2018-10-04 08:53:06'),
(30, 'Siddhart Malhotra', 'Siddhart Malhotra Siddhart Malhotra Siddhart Malhotra', 3, 0, '2', 'Male', '1985-10-01', 32, 0, 0, 1, '1538568251_siddhart-malhotra.jpeg', 'imVkohli', 'https://web.stagram.com/virat.kohli', 'virat.kohli', 'siddhart-malhotra', '2018-10-03 06:34:11', '2018-10-04 08:53:08'),
(31, 'Sooraj Pancholi', 'Sooraj Pancholi Sooraj Pancholi Sooraj Pancholi', 3, 0, '2', 'Male', '1990-10-31', 27, 0, 0, 1, '1538570795_sooraj-pancholi.jpeg', 'iTIGERSHROFF', 'https://web.stagram.com/tigerjackieshroff', 'TigerShroff', 'sooraj-pancholi', '2018-10-03 07:16:35', '2018-10-04 08:53:11'),
(60, 'Anmol', 'director', 11, 9, '1', 'Male', '1990-10-07', 28, 0, 0, 1, '1541423285_partenr-logo2.png', 'anmolTw', 'https://web.stagram.com/arijitsingh', 'fb-2', 'anmol', '2018-11-05 13:08:05', '2018-11-05 07:38:05'),
(53, 'asgusyh', 'fsdffsdfsdfsdfsdfsd', 11, 9, '2', 'Male', '2018-11-30', 0, 0, 0, 1, '1541236395_asgusyh.png', '14', '12', '15', 'asgusyh', '2018-11-03 10:31:41', '2018-11-03 05:01:41'),
(59, 'Virat Kohli', 'she is an actress', 9, 0, '2', 'Female', '1992-10-01', 26, 0, 0, 1, '1541076828_demo-logo.png', 'aliaa08', 'https://web.stagram.com/aliaabhatt', 'fb-1', 'virat-kohli-1', '2018-11-05 13:08:04', '2018-11-05 07:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `celeb_activity`
--

CREATE TABLE `celeb_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `celebrity_id` int(11) NOT NULL,
  `total_likes` int(11) DEFAULT NULL,
  `total_followers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `celeb_activity`
--

INSERT INTO `celeb_activity` (`id`, `user_id`, `celebrity_id`, `total_likes`, `total_followers`, `created_at`, `updated_at`) VALUES
(3, 17, 20, NULL, 0, '2018-10-05 04:14:18', '2018-10-05 04:16:14'),
(4, 16, 21, 1, NULL, '2018-10-14 18:09:36', '2018-10-14 18:09:36'),
(5, 19, 11, 1, NULL, '2018-10-15 13:58:55', '2018-10-15 13:58:55'),
(6, 19, 14, 0, NULL, '2018-10-15 14:04:35', '2018-10-15 14:04:35'),
(7, 19, 29, 1, NULL, '2018-10-15 14:18:11', '2018-10-15 14:18:11'),
(8, 19, 15, 1, NULL, '2018-10-15 14:18:26', '2018-10-15 14:18:26'),
(9, 16, 13, 1, 1, '2018-10-19 13:05:57', '2018-10-19 13:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(10) UNSIGNED NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `parent_id`, `body`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`) VALUES
(17, 46, NULL, 'test comment', 14, 'App\\Celebrity', '2018-11-14 04:07:59', '2018-11-14 04:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `celebrity_id` int(11) NOT NULL,
  `favorite` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `celebrity_id`, `favorite`, `created_at`, `updated_at`) VALUES
(1, 16, 13, 1, '2018-10-19 13:06:01', '2018-10-19 13:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `celebrity_id` int(11) NOT NULL,
  `follow` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `user_id`, `celebrity_id`, `follow`, `created_at`, `updated_at`) VALUES
(29, 16, 13, 1, '2018-10-19 13:05:57', '2018-10-19 13:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `celebrity_id` int(11) NOT NULL,
  `likes` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `celebrity_id`, `likes`, `created_at`, `updated_at`) VALUES
(1, 16, 21, 1, '2018-10-14 18:09:36', '2018-10-14 18:09:36'),
(2, 19, 11, 1, '2018-10-15 13:58:55', '2018-10-15 13:58:55'),
(3, 19, 14, 0, '2018-10-15 14:04:35', '2018-10-15 14:04:35'),
(4, 19, 29, 1, '2018-10-15 14:18:11', '2018-10-15 14:18:11'),
(5, 19, 15, 1, '2018-10-15 14:18:26', '2018-10-15 14:18:26'),
(6, 16, 13, 1, '2018-10-19 13:02:06', '2018-10-19 13:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_11_13_091139_create_comments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `image` varchar(255) NOT NULL,
  `uniqueurl` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `description`, `status`, `image`, `uniqueurl`, `created_at`, `updated_at`) VALUES
(65, 'Advertisement With Us', '<span style="color: rgb(51, 51, 51); font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; text-align: center;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset</span>', 1, '', 'advertisement-with-us', '2018-11-12 08:13:18', '2018-11-12 08:13:18'),
(66, 'Partner With Us', '<span style="color: rgb(51, 51, 51); font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; text-align: center;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset</span>', 1, '', 'partner-with-us', '2018-11-12 08:14:43', '2018-11-12 08:14:43'),
(67, 'Social Media', '<span style="color: rgb(51, 51, 51); font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; text-align: center;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset</span>', 1, '', 'social-media', '2018-11-12 08:17:22', '2018-11-12 08:17:22'),
(68, 'About Us', '<span style="color: rgb(51, 51, 51); font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; text-align: center;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset</span>', 1, '', 'about-us', '2018-11-12 08:17:33', '2018-11-12 08:17:33'),
(69, 'Contact Us', '<span style="color: rgb(51, 51, 51); font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; text-align: center;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset</span>', 1, '', 'contact-us', '2018-11-12 08:17:44', '2018-11-12 08:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `poll_subject` text NOT NULL,
  `poll_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=deleted,0=notdeleted'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `poll_subject`, `poll_status`, `created_at`, `updated_at`, `isactive`, `isdelete`) VALUES
(1, 'Who will win the IPL this season?', 1, '2018-04-09 15:22:13', '2018-04-09 15:23:16', 1, 0),
(2, 'WHo is the most responsible country?', 1, '2018-04-10 09:14:47', '2018-10-03 09:26:53', 1, 0),
(3, 'When the date for vote?', 1, '2018-04-10 09:15:25', '2018-10-03 09:27:17', 0, 0),
(14, 'Which of the following has been stopped by the Supreme Court?', 1, '2018-10-03 07:12:28', '2018-10-03 09:26:51', 1, 0),
(15, 'How many new project are inagurated between India and Bangladesh recently?', 1, '2018-10-03 07:13:49', '2018-10-03 07:13:49', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `polls_respond`
--

CREATE TABLE `polls_respond` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `poll_option` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls_respond`
--

INSERT INTO `polls_respond` (`id`, `poll_id`, `user_id`, `poll_option`, `created_at`, `updated_at`) VALUES
(3, 2, 16, 'India', '2018-10-14 18:10:19', '2018-10-14 18:10:19'),
(4, 15, 19, '05', '2018-10-15 14:21:32', '2018-10-15 14:21:32'),
(5, 14, 19, 'linking bank account', '2018-10-15 14:22:04', '2018-10-15 14:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE `poll_options` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `poll_option` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`id`, `poll_id`, `poll_option`) VALUES
(1, 1, 'Delhi'),
(2, 1, 'Chennai'),
(3, 1, 'Kolkata'),
(4, 1, 'Gujrat'),
(6, 2, 'US'),
(5, 2, 'India'),
(7, 2, 'UK'),
(8, 2, 'Japan'),
(9, 3, '11 Aug 2017'),
(10, 3, '22 Dec 2000'),
(11, 3, '21 Jan 2010'),
(12, 3, '12 Apr 2020'),
(18, 14, 'linking bank account'),
(17, 14, 'linking mobile phone'),
(19, 14, 'e-KYC'),
(20, 14, 'None of the above'),
(21, 15, '05'),
(22, 15, '02'),
(23, 15, '03'),
(24, 15, '06');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `celebrity_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `ratings` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `celebrity_id`, `question_id`, `ratings`, `created_at`, `updated_at`) VALUES
(1, 17, 20, 3, 3, '2018-10-05 04:17:28', '2018-10-05 04:17:36'),
(2, 17, 20, 4, 4, '2018-10-05 04:17:42', '2018-10-05 04:17:42'),
(3, 17, 20, 5, 5, '2018-10-05 04:17:44', '2018-10-05 04:17:44'),
(4, 17, 20, 8, 5, '2018-10-05 04:17:47', '2018-10-05 04:17:47'),
(5, 16, 21, 30, 5, '2018-10-14 18:10:29', '2018-10-14 18:10:29'),
(6, 16, 21, 31, 5, '2018-10-14 18:10:36', '2018-10-14 18:10:36'),
(7, 16, 21, 33, 4, '2018-10-14 18:11:04', '2018-10-14 18:11:04'),
(8, 16, 21, 34, 5, '2018-10-14 18:11:18', '2018-10-14 18:11:18'),
(9, 16, 21, 35, 5, '2018-10-14 18:11:18', '2018-10-14 18:11:18'),
(10, 16, 21, 36, 5, '2018-10-14 18:11:24', '2018-10-14 18:11:24'),
(11, 16, 21, 32, 5, '2018-10-14 18:11:27', '2018-10-14 18:11:27'),
(12, 19, 14, 30, 4, '2018-10-15 13:59:28', '2018-10-15 13:59:28'),
(13, 19, 14, 33, 2, '2018-10-15 13:59:51', '2018-10-15 13:59:51'),
(14, 19, 14, 36, 4, '2018-10-15 14:02:52', '2018-10-15 14:02:52'),
(15, 19, 14, 31, 5, '2018-10-15 14:03:38', '2018-10-15 14:03:38'),
(16, 16, 20, 10, 4, '2018-10-19 13:05:23', '2018-10-19 13:05:23'),
(17, 16, 20, 5, 4, '2018-10-19 13:05:30', '2018-10-19 13:05:30'),
(18, 16, 13, 5, 5, '2018-10-19 13:05:52', '2018-10-19 13:05:52'),
(19, 16, 13, 4, 5, '2018-10-19 13:11:14', '2018-10-19 13:11:14'),
(20, 16, 13, 8, 3, '2018-10-19 13:11:19', '2018-10-19 13:11:19'),
(21, 16, 13, 11, 3, '2018-10-19 13:11:52', '2018-10-19 13:11:52'),
(22, 16, 10, 31, 1, '2018-10-19 13:14:38', '2018-10-19 13:14:38'),
(23, 20, 14, 30, 1, '2018-11-05 14:00:50', '2018-11-05 08:30:50'),
(24, 20, 14, 31, 5, '2018-10-29 09:04:46', '2018-10-29 03:34:46'),
(25, 20, 14, 32, 5, '2018-10-29 09:08:15', '2018-10-29 03:38:15'),
(26, 20, 14, 35, 3, '2018-11-02 09:57:07', '2018-11-02 04:27:07'),
(27, 20, 14, 36, 1, '2018-10-29 09:08:24', '2018-10-29 03:38:24'),
(28, 20, 14, 33, 5, '2018-10-29 09:14:06', '2018-10-29 03:44:06'),
(29, 20, 14, 34, 4, '2018-11-02 09:57:07', '2018-11-02 04:27:07'),
(30, 20, 11, 30, 5, '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(31, 20, 11, 31, 1, '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(32, 20, 11, 32, 1, '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(33, 20, 11, 33, 1, '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(34, 20, 11, 34, 1, '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(35, 20, 11, 35, 1, '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(36, 20, 11, 36, 1, '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(37, 20, 15, 15, 5, '2018-11-02 04:51:34', '2018-11-02 04:51:34'),
(38, 20, 15, 17, 5, '2018-11-02 04:51:34', '2018-11-02 04:51:34'),
(39, 20, 15, 28, 1, '2018-11-02 04:51:34', '2018-11-02 04:51:34'),
(40, 20, 15, 29, 1, '2018-11-02 04:51:34', '2018-11-02 04:51:34'),
(41, 2, 11, 30, 5, '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(42, 2, 11, 31, 5, '2018-11-05 13:34:42', '2018-11-05 08:04:42'),
(43, 2, 11, 32, 1, '2018-11-05 13:35:00', '2018-11-05 08:05:00'),
(44, 2, 11, 33, 1, '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(45, 2, 11, 34, 1, '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(46, 2, 11, 35, 1, '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(47, 2, 11, 36, 1, '2018-11-05 12:38:36', '2018-11-05 07:08:36'),
(48, 54, 11, 30, 5, '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(49, 54, 11, 31, 5, '2018-11-06 05:40:50', '2018-11-06 00:10:50'),
(50, 54, 11, 32, 1, '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(51, 54, 11, 33, 1, '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(52, 54, 11, 34, 1, '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(53, 54, 11, 35, 1, '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(54, 54, 11, 36, 5, '2018-11-06 05:40:44', '2018-11-06 00:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `rating_question`
--

CREATE TABLE `rating_question` (
  `id` int(11) NOT NULL,
  `category` varchar(225) NOT NULL,
  `skill` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_question`
--

INSERT INTO `rating_question` (`id`, `category`, `skill`, `created_at`, `updated_at`) VALUES
(3, 'Actor', 'Acting', '2018-10-01 02:03:29', '2018-10-01 02:03:29'),
(4, 'Actor', 'Dancing', '2018-10-01 02:33:11', '2018-10-01 02:33:11'),
(5, 'Actor', 'Emotional Drama', '2018-10-01 02:34:09', '2018-10-01 02:34:09'),
(6, 'Singer', 'Singing', '2018-10-01 02:34:20', '2018-10-01 02:34:20'),
(13, 'Singer', 'Voice Quality', '2018-10-01 03:00:20', '2018-10-01 03:00:20'),
(8, 'Actor', 'Confidence', '2018-10-01 02:58:29', '2018-10-01 02:58:29'),
(9, 'Actor', 'Expression', '2018-10-01 02:58:46', '2018-10-01 02:58:46'),
(10, 'Actor', 'Looks And Facing', '2018-10-01 02:59:05', '2018-10-01 02:59:05'),
(11, 'Actor', 'Height', '2018-10-01 02:59:14', '2018-10-01 02:59:14'),
(12, 'Singer', 'Looks', '2018-10-01 02:59:29', '2018-10-01 02:59:29'),
(14, 'Singer', 'Confidence', '2018-10-01 03:02:10', '2018-10-01 03:02:10'),
(15, 'Sports', 'Dedication Towards Game', '2018-10-01 03:02:37', '2018-10-01 03:02:37'),
(18, 'Politician', 'Dedication Toward Country Wealth', '2018-10-01 03:05:02', '2018-10-01 03:05:02'),
(17, 'Sports', 'Game Representation', '2018-10-01 03:03:07', '2018-10-01 03:03:07'),
(19, 'Politician', 'Honesty And Integrity', '2018-10-01 03:08:23', '2018-10-01 03:08:23'),
(20, 'Politician', 'Responsibility Oriented', '2018-10-01 03:08:45', '2018-10-01 03:08:45'),
(21, 'Politician', 'Intelligence', '2018-10-01 03:09:02', '2018-10-01 03:09:02'),
(22, 'Politician', 'Diplomacy', '2018-10-01 03:10:15', '2018-10-01 03:10:15'),
(23, 'Artist', 'Creativity', '2018-10-01 03:12:24', '2018-10-01 03:12:24'),
(24, 'Artist', 'Vision', '2018-10-01 03:12:38', '2018-10-01 03:12:38'),
(25, 'Artist', 'Beauty in Art', '2018-10-01 03:13:07', '2018-10-01 03:13:07'),
(26, 'Artist', 'Skill and Technique', '2018-10-01 03:13:25', '2018-10-01 03:13:25'),
(27, 'Artist', 'Uniqueness', '2018-10-01 03:13:53', '2018-10-01 03:13:53'),
(28, 'Sports', 'Competitiveness.', '2018-10-01 03:17:44', '2018-10-01 03:17:44'),
(29, 'Sports', 'Focus', '2018-10-01 03:18:17', '2018-10-01 03:18:17'),
(30, 'Actress', 'Acting', '2018-10-03 00:21:17', '2018-10-03 00:21:17'),
(31, 'Actress', 'Dancing', '2018-10-03 00:21:27', '2018-10-03 00:21:27'),
(32, 'Actress', 'Emotional Drama', '2018-10-03 00:21:36', '2018-10-03 00:21:36'),
(33, 'Actress', 'Confidence', '2018-10-03 00:22:14', '2018-10-03 00:22:14'),
(34, 'Actress', 'Expression', '2018-10-03 00:22:23', '2018-10-03 00:22:23'),
(35, 'Actress', 'Looks And Facing', '2018-10-03 00:22:32', '2018-10-03 00:22:32'),
(36, 'Actress', 'Height', '2018-10-03 00:22:41', '2018-10-03 00:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `host_name` varchar(255) DEFAULT NULL,
  `host_email` varchar(255) DEFAULT NULL,
  `host_password` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `host_enc` varchar(255) DEFAULT NULL,
  `FACEBOOK_ID` varchar(255) NOT NULL,
  `FACEBOOK_SECRET` varchar(255) NOT NULL,
  `FACEBOOK_URL` varchar(255) NOT NULL,
  `INSTAGRAM_KEY` varchar(255) NOT NULL,
  `INSTAGRAM_SECRET` varchar(255) NOT NULL,
  `INSTAGRAM_REDIRECT_URI` varchar(255) NOT NULL,
  `TWITTER_ID` varchar(255) NOT NULL,
  `TWITTER_SECRET` varchar(255) NOT NULL,
  `TWITTER_URL` varchar(255) NOT NULL,
  `GOOGLE_CLIENT_ID` varchar(255) NOT NULL,
  `GOOGLE_CLIENT_SECRET` varchar(255) NOT NULL,
  `GOOGLE_REDIRECT` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `host_name`, `host_email`, `host_password`, `host`, `port`, `host_enc`, `FACEBOOK_ID`, `FACEBOOK_SECRET`, `FACEBOOK_URL`, `INSTAGRAM_KEY`, `INSTAGRAM_SECRET`, `INSTAGRAM_REDIRECT_URI`, `TWITTER_ID`, `TWITTER_SECRET`, `TWITTER_URL`, `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT`) VALUES
(1, 'Celebrity', 'dellnaruto1@gmail.com', 'Xander Cage', 'smtp.gmail.com', '587', 'tls', '153586761739300', '6a90257c7d3ccf5cf450c8722a1994a2', 'http://localhost/celebrity/auth/facebook/callback', 'bc7e84b0876246a8adb079971898e7f4', '3b4d8742c79f4ae8810589f7d8bd3673', 'http://localhost/celebrity/auth/instagram/callback', '', '', '//localhost/celebrity/auth/instagram/callback', '1017507374021-4rdtpv47t1mkdtij8cr2vsn2vpf2fd79 ', 'qbdsHyC4PaZROBkx28NlNm_C', 'http://localhost/celebrity/auth/google/callback');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `skilltitle` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skilltitle`, `status`, `created_at`, `updated_at`) VALUES
(1, 'online advertising', 1, '2018-04-16 10:21:56', '2018-04-16 06:17:28'),
(2, 'e-learning', 1, '2018-04-16 10:23:42', '2018-04-16 11:38:10'),
(3, 'Email marketing', 1, '2018-04-16 10:23:51', '2018-04-16 06:18:09'),
(4, 'Web development', 1, '2018-04-16 05:31:59', '2018-04-16 11:39:09'),
(5, 'Business', 1, '2018-04-16 05:32:29', '2018-04-16 06:09:43'),
(6, 'bowling', 1, '2018-04-16 06:12:34', '2018-04-16 06:17:38'),
(7, 'betting', 1, '2018-04-16 06:13:05', '2018-04-16 06:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `user_id`, `email`, `created_at`, `updated_at`) VALUES
(11, 17, 'aishulanke6@gmail.com', '2018-10-05 04:10:02', '2018-10-05 04:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referel_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `referel_code`, `reference_code`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(16, 'Abhi', 'user@gmail.com', '$2y$10$OqSfPL17Px7W6/7mAOcii.nhsOTzcQS6aDG9uy2P4Jc..alMV7mdu', '2', '5bb72d6c5903e', NULL, NULL, NULL, 'j5QyjjjyBX879Auk4C4VEcmQWw92VZMYUJOwBxbE1pKWmFD6ztJmJen4t1IP', '2018-10-05 03:52:52', '2018-10-05 03:52:52'),
(2, 'Admin', 'admin@gmail.com', '$2y$10$1kgWd3kXbuMTrAEywjo7suTaL2A4DO/2mS/C.WmGOd.CpUlXPclAO', '1', '5ba8a3f063bce', '', NULL, NULL, 'LGdO8ucWdYodzcVkihaUp6Gq5zTUAiqtuaqlnZhhg8Nrn0zACBm3Oem2kveX', '2018-09-24 03:14:32', '2018-10-30 02:06:13'),
(6, 'Abhay', 'abhay@gmail.com', '$2y$10$85.a2PfpZcfHTt9SWUoEL.N.QQiGy6YAIXcZpdnbtbZk4HZ8AMMOq', '2', '5bacab3fb3783', '', NULL, NULL, 'xv1By7Z5GfAOkarkQB4odWwIFXAPwpXWjGpQo6SI7tcOKD2Bc8e8jRcPxj7Y', '2018-09-27 04:34:47', '2018-09-27 04:34:47'),
(5, 'Nikhil Pansare', 'npansare0@gmail.com', '', '', '', '', 'facebook', '1748197041927784', '5EEfkTc8ci3Q2MG2w5o7S7fx0h6pvrhzjaBuIBOsU7iR3UDMKzB36q0bioZR', '2018-09-27 00:30:10', '2018-09-27 00:30:10'),
(17, 'Aishwarya', 'aishulanke6@gmail.com', '$2y$10$aPkWFFMUBRgnUSxwde.AneJlMHuDb22EDDQBnLUCMOY2tFxDDmncq', '2', '5bb73081b594c', '5bacab3fb3783', NULL, NULL, 'NQd0HniGRWeeAT1GWKYPe3pmzxLw4lucNUYnwtYmO8StYo5NIthrDU1deDKA', '2018-10-05 04:06:01', '2018-10-05 04:10:54'),
(12, 'Vishwa', 'vishwa@gmail.com', '$2y$10$MP181uTTKOwOtCxAvODKAugYeBTaCzFCXV9k32kacXwQnnS7x0jVm', '2', '5bb44cc8d0699', NULL, NULL, NULL, 'gbVEaOVNgkSAvuL6Iak6vWIFfbY9Ei0ArJNbU4aDPtilCma1AAtXpw5MxWzI', '2018-10-02 23:29:52', '2018-10-02 23:29:52'),
(18, 'mume@patonce.com', 'mume@patonce.com', '$2y$10$stjONTh9xZQoidnZESncDO/bQ50RpMNhwS./VYxs3SGggbWB8Ox92', '2', '5bc1f74da1506', NULL, NULL, NULL, '9a7dHBCCbwtv0pZC61OcIWwD9ZyncpNeIAEuT8Uc5u3hLH8otrPo8QgL8ach', '2018-10-13 13:46:53', '2018-10-13 13:46:53'),
(19, 'anbu', 'anburabindra@gmail.com', '$2y$10$d03qOHUX4HtZrSe8VXhXfumI.y0pOkO.89vTt8iMKhbvLr0h04XDm', '2', '5bc49d0ec0580', NULL, NULL, NULL, NULL, '2018-10-15 13:58:38', '2018-10-15 13:58:38'),
(53, 'ashish', '11test12322111wer1@test.com', '$2y$10$x7pblfLCOq28UmscrJpn.ufbWP.WYUHHKryZClV2HPpkR6xUniPZK', '2', '5be128c9868a0', NULL, NULL, NULL, NULL, '2018-11-06 00:08:17', '2018-11-06 00:08:17'),
(54, 'ashish', '11test12322g111wer1@test.com', '$2y$10$q/U7tyhrrK28lDfh2XHW8eDQ5ZRslTNLHDhdKi3l4Soydo6QoOarG', '2', '5be129150b98a', NULL, NULL, NULL, NULL, '2018-11-06 00:09:33', '2018-11-06 00:09:33'),
(52, 'ashish', '11test123221111@test.com', '$2y$10$TP5P2wu.sS/8U8VzKKeJr.CV96aovlHCfbV1rNhK0LySiVG9NxuC.', '2', '5be128588fdd6', NULL, NULL, NULL, NULL, '2018-11-06 00:06:24', '2018-11-06 00:06:24'),
(51, 'ashish', '11test1232211@test.com', '$2y$10$MKzagKuW0y7H92xPX7hdUOqpeJhJveNVP16gIRuUik6gl.r/UIvqy', '2', '5be1283183c5b', NULL, NULL, NULL, NULL, '2018-11-06 00:05:45', '2018-11-06 00:05:45'),
(50, 'ashish', 'test1232211@test.com', '$2y$10$9elFo0R.Sg6xNOOUK2bvYOGnPg8WtIMWHTuFXBVVHhf0JSQxqFuZG', '2', '5be1282745265', NULL, NULL, NULL, NULL, '2018-11-06 00:05:35', '2018-11-06 00:05:35'),
(49, 'ashish', '111ashishk.upadhyaya@synergytop.com', '$2y$10$LJuU0miFEIwBjHhjr1gd8uF.zJkrlQXPbnrQ27wkvZeMzVo/JhfTW', '2', '5be1277e9e0bf', NULL, NULL, NULL, NULL, '2018-11-06 00:02:46', '2018-11-06 00:02:46'),
(48, 'ashish', 'ashishk.upadhyaya11@synergytop.com', '$2y$10$AixybnKF2Sp7Ughfs7xP9uREoieiLyk.8tv8LWYPFedqlHiaO418.', '2', '5be127248509f', NULL, NULL, NULL, NULL, '2018-11-06 00:01:16', '2018-11-06 00:01:16'),
(46, 'ashish', 'ashishk.synergytop@gmail.com', '$2y$10$IihC2LmvZNpl/snPBt2UgOr6b3snUiR3lG.aFAqPZk6/TROerj0Na', '2', '5be123dfcb89e', NULL, NULL, NULL, 'mPqN2otEuedb7fds1Qk0Wd9Oh0B1FFvuXir7JZGC6oLzRsImRWJtFJXGIK0B', '2018-11-05 23:47:19', '2018-11-05 23:47:19'),
(47, 'ashish', 'ashishk.upadhyaya@synergytop.com', '$2y$10$fhBbKlPrctB4vZ1VWGuQB.a4h1D.CbPbWftAuCUM5gx/cOw1kU/0G', '2', '5be126bb5d867', NULL, NULL, NULL, NULL, '2018-11-05 23:59:31', '2018-11-05 23:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `users_follow`
--

CREATE TABLE `users_follow` (
  `id` int(11) NOT NULL,
  `follow_to` int(11) NOT NULL,
  `followed_by` int(11) NOT NULL,
  `follow` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `fb_frame` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `insta_frame` varchar(255) DEFAULT NULL,
  `total_points` float NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `user_id`, `gender`, `date_of_birth`, `city`, `pin_code`, `mobile`, `profile`, `fb_frame`, `twitter`, `insta_frame`, `total_points`, `created_at`, `updated_at`) VALUES
(16, 6, 'Male', '2018-08-01', 'Amravati', NULL, '9552385996', 'images/1538043699.jpg', NULL, NULL, NULL, 0, '2018-09-27 04:51:11', '2018-10-05 04:19:45'),
(62, 16, 'Male', NULL, 'Amravati', '444101', NULL, NULL, NULL, NULL, NULL, 56.5, '2018-10-19 13:14:38', '2018-10-19 13:14:38'),
(64, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-05 04:06:01', '2018-10-05 04:21:18'),
(65, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.5, '2018-10-13 13:46:53', '2018-10-13 13:46:53'),
(66, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.5, '2018-10-15 14:22:04', '2018-10-15 14:22:04'),
(67, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.5, '2018-11-05 12:38:02', '2018-11-05 07:08:02'),
(72, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.5, '2018-11-06 05:40:40', '2018-11-06 00:10:40'),
(71, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.5, '2018-11-06 05:24:28', '2018-11-05 23:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `celebrity_id` int(11) DEFAULT NULL,
  `points` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `activity_id`, `celebrity_id`, `points`, `created_at`, `updated_at`) VALUES
(1, 17, 2, NULL, '10', '2018-10-05 04:14:18', '2018-10-05 04:14:18'),
(2, 17, 3, NULL, '-10', '2018-10-05 04:14:24', '2018-10-05 04:14:24'),
(3, 17, 2, NULL, '10', '2018-10-05 04:15:44', '2018-10-05 04:15:44'),
(4, 17, 3, NULL, '-10', '2018-10-05 04:15:50', '2018-10-05 04:15:50'),
(5, 17, 2, NULL, '10', '2018-10-05 04:16:04', '2018-10-05 04:16:04'),
(6, 17, 3, NULL, '-10', '2018-10-05 04:16:14', '2018-10-05 04:16:14'),
(7, 17, 13, NULL, '-1', '2018-10-05 04:16:56', '2018-10-05 04:16:56'),
(8, 17, 14, NULL, '-1', '2018-10-05 04:16:56', '2018-10-05 04:16:56'),
(9, 17, 12, NULL, '1', '2018-10-05 04:17:03', '2018-10-05 04:17:03'),
(10, 17, 11, NULL, '1', '2018-10-05 04:17:03', '2018-10-05 04:17:03'),
(11, 17, 15, NULL, '1', '2018-10-05 04:17:28', '2018-10-05 04:17:28'),
(12, 17, 15, NULL, '1', '2018-10-05 04:17:36', '2018-10-05 04:17:36'),
(13, 17, 15, NULL, '1', '2018-10-05 04:17:42', '2018-10-05 04:17:42'),
(14, 17, 15, NULL, '1', '2018-10-05 04:17:44', '2018-10-05 04:17:44'),
(15, 17, 15, NULL, '1', '2018-10-05 04:17:47', '2018-10-05 04:17:47'),
(16, 17, 10, NULL, '0.5', '2018-10-05 04:19:03', '2018-10-05 04:19:03'),
(17, 17, 4, NULL, '10', '2018-10-05 04:19:03', '2018-10-05 04:19:03'),
(18, 17, 11, NULL, '1', '2018-10-05 04:19:39', '2018-10-05 04:19:39'),
(19, 17, 14, NULL, '-1', '2018-10-05 04:19:45', '2018-10-05 04:19:45'),
(20, 17, 16, NULL, '1', '2018-10-05 04:21:11', '2018-10-05 04:21:11'),
(21, 17, 16, NULL, '1', '2018-10-05 04:21:18', '2018-10-05 04:21:18'),
(22, 16, 10, NULL, '0.5', '2018-10-09 06:56:01', '2018-10-09 06:56:01'),
(23, 16, 4, NULL, '10', '2018-10-09 06:56:01', '2018-10-09 06:56:01'),
(24, 16, 10, NULL, '0.5', '2018-10-13 13:44:04', '2018-10-13 13:44:04'),
(25, 16, 4, NULL, '10', '2018-10-13 13:44:04', '2018-10-13 13:44:04'),
(26, 18, 10, NULL, '0.5', '2018-10-13 13:46:53', '2018-10-13 13:46:53'),
(27, 18, 4, NULL, '10', '2018-10-13 13:46:53', '2018-10-13 13:46:53'),
(28, 16, 10, NULL, '0.5', '2018-10-14 18:09:13', '2018-10-14 18:09:13'),
(29, 16, 4, NULL, '10', '2018-10-14 18:09:13', '2018-10-14 18:09:13'),
(30, 16, 16, NULL, '1', '2018-10-14 18:10:19', '2018-10-14 18:10:19'),
(31, 16, 15, NULL, '1', '2018-10-14 18:10:29', '2018-10-14 18:10:29'),
(32, 16, 15, NULL, '1', '2018-10-14 18:10:36', '2018-10-14 18:10:36'),
(33, 16, 15, NULL, '1', '2018-10-14 18:11:04', '2018-10-14 18:11:04'),
(34, 16, 15, NULL, '1', '2018-10-14 18:11:18', '2018-10-14 18:11:18'),
(35, 16, 15, NULL, '1', '2018-10-14 18:11:18', '2018-10-14 18:11:18'),
(36, 16, 15, NULL, '1', '2018-10-14 18:11:24', '2018-10-14 18:11:24'),
(37, 16, 15, NULL, '1', '2018-10-14 18:11:27', '2018-10-14 18:11:27'),
(38, 19, 10, NULL, '0.5', '2018-10-15 13:58:39', '2018-10-15 13:58:39'),
(39, 19, 4, NULL, '10', '2018-10-15 13:58:39', '2018-10-15 13:58:39'),
(40, 19, 15, NULL, '1', '2018-10-15 13:59:28', '2018-10-15 13:59:28'),
(41, 19, 15, NULL, '1', '2018-10-15 13:59:51', '2018-10-15 13:59:51'),
(42, 2, 10, NULL, '0.5', '2018-10-15 14:02:12', '2018-10-15 14:02:12'),
(43, 2, 4, NULL, '10', '2018-10-15 14:02:12', '2018-10-15 14:02:12'),
(44, 19, 15, NULL, '1', '2018-10-15 14:02:52', '2018-10-15 14:02:52'),
(45, 19, 15, NULL, '1', '2018-10-15 14:03:38', '2018-10-15 14:03:38'),
(46, 19, 16, NULL, '1', '2018-10-15 14:21:32', '2018-10-15 14:21:32'),
(47, 19, 16, NULL, '1', '2018-10-15 14:22:04', '2018-10-15 14:22:04'),
(48, 16, 15, NULL, '1', '2018-10-19 13:05:23', '2018-10-19 13:05:23'),
(49, 16, 15, NULL, '1', '2018-10-19 13:05:30', '2018-10-19 13:05:30'),
(50, 16, 15, NULL, '1', '2018-10-19 13:05:52', '2018-10-19 13:05:52'),
(51, 16, 2, NULL, '10', '2018-10-19 13:05:57', '2018-10-19 13:05:57'),
(52, 16, 15, NULL, '1', '2018-10-19 13:11:14', '2018-10-19 13:11:14'),
(53, 16, 15, NULL, '1', '2018-10-19 13:11:19', '2018-10-19 13:11:19'),
(54, 16, 15, NULL, '1', '2018-10-19 13:11:52', '2018-10-19 13:11:52'),
(55, 16, 15, NULL, '1', '2018-10-19 13:14:38', '2018-10-19 13:14:38'),
(56, 20, 10, NULL, '0.5', '2018-10-26 01:18:08', '2018-10-26 01:18:08'),
(57, 20, 4, NULL, '10', '2018-10-26 01:18:08', '2018-10-26 01:18:08'),
(58, 20, 15, NULL, '1', '2018-10-26 01:20:17', '2018-10-26 01:20:17'),
(59, 20, 15, NULL, '1', '2018-10-26 01:20:22', '2018-10-26 01:20:22'),
(60, 20, 15, NULL, '1', '2018-10-26 01:20:28', '2018-10-26 01:20:28'),
(61, 20, 15, NULL, '1', '2018-10-26 01:20:31', '2018-10-26 01:20:31'),
(62, 20, 15, NULL, '1', '2018-10-26 01:20:47', '2018-10-26 01:20:47'),
(63, 20, 15, NULL, '1', '2018-10-26 01:20:57', '2018-10-26 01:20:57'),
(64, 20, 15, NULL, '1', '2018-10-26 01:21:10', '2018-10-26 01:21:10'),
(65, 20, 15, NULL, '1', '2018-10-26 01:21:20', '2018-10-26 01:21:20'),
(66, 21, 10, NULL, '0.5', '2018-10-26 04:11:44', '2018-10-26 04:11:44'),
(67, 21, 4, NULL, '10', '2018-10-26 04:11:44', '2018-10-26 04:11:44'),
(68, 23, 10, NULL, '0.5', '2018-10-26 04:36:52', '2018-10-26 04:36:52'),
(69, 23, 4, NULL, '10', '2018-10-26 04:36:52', '2018-10-26 04:36:52'),
(70, 20, 15, NULL, '1', '2018-10-28 23:52:58', '2018-10-28 23:52:58'),
(71, 20, 15, NULL, '1', '2018-10-28 23:53:10', '2018-10-28 23:53:10'),
(72, 20, 15, NULL, '1', '2018-10-29 00:06:32', '2018-10-29 00:06:32'),
(73, 20, 15, NULL, '1', '2018-10-29 00:12:17', '2018-10-29 00:12:17'),
(74, 20, 15, NULL, '1', '2018-10-29 01:35:09', '2018-10-29 01:35:09'),
(75, 20, 15, NULL, '1', '2018-10-29 01:45:47', '2018-10-29 01:45:47'),
(76, 20, 15, NULL, '1', '2018-10-29 01:45:59', '2018-10-29 01:45:59'),
(77, 20, 15, NULL, '1', '2018-10-29 01:46:57', '2018-10-29 01:46:57'),
(78, 20, 15, NULL, '1', '2018-10-29 01:46:57', '2018-10-29 01:46:57'),
(79, 20, 15, NULL, '1', '2018-10-29 01:46:57', '2018-10-29 01:46:57'),
(80, 20, 15, NULL, '1', '2018-10-29 01:46:57', '2018-10-29 01:46:57'),
(81, 20, 15, NULL, '1', '2018-10-29 01:46:57', '2018-10-29 01:46:57'),
(82, 20, 15, NULL, '1', '2018-10-29 01:46:57', '2018-10-29 01:46:57'),
(83, 20, 15, NULL, '1', '2018-10-29 01:46:57', '2018-10-29 01:46:57'),
(84, 20, 15, NULL, '1', '2018-10-29 01:47:03', '2018-10-29 01:47:03'),
(85, 20, 15, NULL, '1', '2018-10-29 01:47:03', '2018-10-29 01:47:03'),
(86, 20, 15, NULL, '1', '2018-10-29 01:47:03', '2018-10-29 01:47:03'),
(87, 20, 15, NULL, '1', '2018-10-29 01:47:03', '2018-10-29 01:47:03'),
(88, 20, 15, NULL, '1', '2018-10-29 01:47:03', '2018-10-29 01:47:03'),
(89, 20, 15, NULL, '1', '2018-10-29 01:47:03', '2018-10-29 01:47:03'),
(90, 20, 15, NULL, '1', '2018-10-29 01:47:03', '2018-10-29 01:47:03'),
(91, 20, 15, NULL, '1', '2018-10-29 01:47:15', '2018-10-29 01:47:15'),
(92, 20, 15, NULL, '1', '2018-10-29 01:47:15', '2018-10-29 01:47:15'),
(93, 20, 15, NULL, '1', '2018-10-29 01:47:15', '2018-10-29 01:47:15'),
(94, 20, 15, NULL, '1', '2018-10-29 01:47:15', '2018-10-29 01:47:15'),
(95, 20, 15, NULL, '1', '2018-10-29 01:47:15', '2018-10-29 01:47:15'),
(96, 20, 15, NULL, '1', '2018-10-29 01:47:15', '2018-10-29 01:47:15'),
(97, 20, 15, NULL, '1', '2018-10-29 01:47:15', '2018-10-29 01:47:15'),
(98, 20, 15, NULL, '1', '2018-10-29 01:49:05', '2018-10-29 01:49:05'),
(99, 20, 15, NULL, '1', '2018-10-29 01:49:05', '2018-10-29 01:49:05'),
(100, 20, 15, NULL, '1', '2018-10-29 01:49:05', '2018-10-29 01:49:05'),
(101, 20, 15, NULL, '1', '2018-10-29 01:49:05', '2018-10-29 01:49:05'),
(102, 20, 15, NULL, '1', '2018-10-29 01:49:05', '2018-10-29 01:49:05'),
(103, 20, 15, NULL, '1', '2018-10-29 01:49:05', '2018-10-29 01:49:05'),
(104, 20, 15, NULL, '1', '2018-10-29 01:49:05', '2018-10-29 01:49:05'),
(105, 20, 15, NULL, '1', '2018-10-29 02:10:05', '2018-10-29 02:10:05'),
(106, 20, 15, NULL, '1', '2018-10-29 02:10:05', '2018-10-29 02:10:05'),
(107, 20, 15, NULL, '1', '2018-10-29 02:10:05', '2018-10-29 02:10:05'),
(108, 20, 15, NULL, '1', '2018-10-29 02:10:05', '2018-10-29 02:10:05'),
(109, 20, 15, NULL, '1', '2018-10-29 02:10:05', '2018-10-29 02:10:05'),
(110, 20, 15, NULL, '1', '2018-10-29 02:10:05', '2018-10-29 02:10:05'),
(111, 20, 15, NULL, '1', '2018-10-29 02:10:05', '2018-10-29 02:10:05'),
(112, 20, 15, NULL, '1', '2018-10-29 03:31:42', '2018-10-29 03:31:42'),
(113, 20, 15, NULL, '1', '2018-10-29 03:31:42', '2018-10-29 03:31:42'),
(114, 20, 15, NULL, '1', '2018-10-29 03:31:42', '2018-10-29 03:31:42'),
(115, 20, 15, NULL, '1', '2018-10-29 03:31:42', '2018-10-29 03:31:42'),
(116, 20, 15, NULL, '1', '2018-10-29 03:31:42', '2018-10-29 03:31:42'),
(117, 20, 15, NULL, '1', '2018-10-29 03:31:42', '2018-10-29 03:31:42'),
(118, 20, 15, NULL, '1', '2018-10-29 03:31:42', '2018-10-29 03:31:42'),
(119, 20, 15, NULL, '1', '2018-10-29 03:31:53', '2018-10-29 03:31:53'),
(120, 20, 15, NULL, '1', '2018-10-29 03:31:53', '2018-10-29 03:31:53'),
(121, 20, 15, NULL, '1', '2018-10-29 03:31:53', '2018-10-29 03:31:53'),
(122, 20, 15, NULL, '1', '2018-10-29 03:31:53', '2018-10-29 03:31:53'),
(123, 20, 15, NULL, '1', '2018-10-29 03:31:53', '2018-10-29 03:31:53'),
(124, 20, 15, NULL, '1', '2018-10-29 03:31:53', '2018-10-29 03:31:53'),
(125, 20, 15, NULL, '1', '2018-10-29 03:31:53', '2018-10-29 03:31:53'),
(126, 20, 15, NULL, '1', '2018-10-29 03:31:58', '2018-10-29 03:31:58'),
(127, 20, 15, NULL, '1', '2018-10-29 03:31:58', '2018-10-29 03:31:58'),
(128, 20, 15, NULL, '1', '2018-10-29 03:31:58', '2018-10-29 03:31:58'),
(129, 20, 15, NULL, '1', '2018-10-29 03:31:58', '2018-10-29 03:31:58'),
(130, 20, 15, NULL, '1', '2018-10-29 03:31:58', '2018-10-29 03:31:58'),
(131, 20, 15, NULL, '1', '2018-10-29 03:31:58', '2018-10-29 03:31:58'),
(132, 20, 15, NULL, '1', '2018-10-29 03:31:58', '2018-10-29 03:31:58'),
(133, 20, 15, NULL, '1', '2018-10-29 03:32:08', '2018-10-29 03:32:08'),
(134, 20, 15, NULL, '1', '2018-10-29 03:32:08', '2018-10-29 03:32:08'),
(135, 20, 15, NULL, '1', '2018-10-29 03:32:08', '2018-10-29 03:32:08'),
(136, 20, 15, NULL, '1', '2018-10-29 03:32:08', '2018-10-29 03:32:08'),
(137, 20, 15, NULL, '1', '2018-10-29 03:32:08', '2018-10-29 03:32:08'),
(138, 20, 15, NULL, '1', '2018-10-29 03:32:08', '2018-10-29 03:32:08'),
(139, 20, 15, NULL, '1', '2018-10-29 03:32:08', '2018-10-29 03:32:08'),
(140, 20, 15, NULL, '1', '2018-10-29 03:32:18', '2018-10-29 03:32:18'),
(141, 20, 15, NULL, '1', '2018-10-29 03:32:18', '2018-10-29 03:32:18'),
(142, 20, 15, NULL, '1', '2018-10-29 03:32:18', '2018-10-29 03:32:18'),
(143, 20, 15, NULL, '1', '2018-10-29 03:32:18', '2018-10-29 03:32:18'),
(144, 20, 15, NULL, '1', '2018-10-29 03:32:18', '2018-10-29 03:32:18'),
(145, 20, 15, NULL, '1', '2018-10-29 03:32:18', '2018-10-29 03:32:18'),
(146, 20, 15, NULL, '1', '2018-10-29 03:32:18', '2018-10-29 03:32:18'),
(147, 20, 15, NULL, '1', '2018-10-29 03:34:46', '2018-10-29 03:34:46'),
(148, 20, 15, NULL, '1', '2018-10-29 03:34:46', '2018-10-29 03:34:46'),
(149, 20, 15, NULL, '1', '2018-10-29 03:34:46', '2018-10-29 03:34:46'),
(150, 20, 15, NULL, '1', '2018-10-29 03:34:46', '2018-10-29 03:34:46'),
(151, 20, 15, NULL, '1', '2018-10-29 03:34:46', '2018-10-29 03:34:46'),
(152, 20, 15, NULL, '1', '2018-10-29 03:34:46', '2018-10-29 03:34:46'),
(153, 20, 15, NULL, '1', '2018-10-29 03:34:46', '2018-10-29 03:34:46'),
(154, 20, 15, NULL, '1', '2018-10-29 03:34:54', '2018-10-29 03:34:54'),
(155, 20, 15, NULL, '1', '2018-10-29 03:34:54', '2018-10-29 03:34:54'),
(156, 20, 15, NULL, '1', '2018-10-29 03:34:54', '2018-10-29 03:34:54'),
(157, 20, 15, NULL, '1', '2018-10-29 03:34:54', '2018-10-29 03:34:54'),
(158, 20, 15, NULL, '1', '2018-10-29 03:34:54', '2018-10-29 03:34:54'),
(159, 20, 15, NULL, '1', '2018-10-29 03:34:54', '2018-10-29 03:34:54'),
(160, 20, 15, NULL, '1', '2018-10-29 03:34:54', '2018-10-29 03:34:54'),
(161, 20, 15, NULL, '1', '2018-10-29 03:35:02', '2018-10-29 03:35:02'),
(162, 20, 15, NULL, '1', '2018-10-29 03:35:02', '2018-10-29 03:35:02'),
(163, 20, 15, NULL, '1', '2018-10-29 03:35:02', '2018-10-29 03:35:02'),
(164, 20, 15, NULL, '1', '2018-10-29 03:35:02', '2018-10-29 03:35:02'),
(165, 20, 15, NULL, '1', '2018-10-29 03:35:02', '2018-10-29 03:35:02'),
(166, 20, 15, NULL, '1', '2018-10-29 03:35:02', '2018-10-29 03:35:02'),
(167, 20, 15, NULL, '1', '2018-10-29 03:35:02', '2018-10-29 03:35:02'),
(168, 20, 15, NULL, '1', '2018-10-29 03:38:01', '2018-10-29 03:38:01'),
(169, 20, 15, NULL, '1', '2018-10-29 03:38:02', '2018-10-29 03:38:02'),
(170, 20, 15, NULL, '1', '2018-10-29 03:38:02', '2018-10-29 03:38:02'),
(171, 20, 15, NULL, '1', '2018-10-29 03:38:02', '2018-10-29 03:38:02'),
(172, 20, 15, NULL, '1', '2018-10-29 03:38:02', '2018-10-29 03:38:02'),
(173, 20, 15, NULL, '1', '2018-10-29 03:38:02', '2018-10-29 03:38:02'),
(174, 20, 15, NULL, '1', '2018-10-29 03:38:02', '2018-10-29 03:38:02'),
(175, 20, 15, NULL, '1', '2018-10-29 03:38:15', '2018-10-29 03:38:15'),
(176, 20, 15, NULL, '1', '2018-10-29 03:38:15', '2018-10-29 03:38:15'),
(177, 20, 15, NULL, '1', '2018-10-29 03:38:15', '2018-10-29 03:38:15'),
(178, 20, 15, NULL, '1', '2018-10-29 03:38:15', '2018-10-29 03:38:15'),
(179, 20, 15, NULL, '1', '2018-10-29 03:38:15', '2018-10-29 03:38:15'),
(180, 20, 15, NULL, '1', '2018-10-29 03:38:15', '2018-10-29 03:38:15'),
(181, 20, 15, NULL, '1', '2018-10-29 03:38:15', '2018-10-29 03:38:15'),
(182, 20, 15, NULL, '1', '2018-10-29 03:38:24', '2018-10-29 03:38:24'),
(183, 20, 15, NULL, '1', '2018-10-29 03:38:24', '2018-10-29 03:38:24'),
(184, 20, 15, NULL, '1', '2018-10-29 03:38:24', '2018-10-29 03:38:24'),
(185, 20, 15, NULL, '1', '2018-10-29 03:38:24', '2018-10-29 03:38:24'),
(186, 20, 15, NULL, '1', '2018-10-29 03:38:24', '2018-10-29 03:38:24'),
(187, 20, 15, NULL, '1', '2018-10-29 03:38:24', '2018-10-29 03:38:24'),
(188, 20, 15, NULL, '1', '2018-10-29 03:38:24', '2018-10-29 03:38:24'),
(189, 20, 15, NULL, '1', '2018-10-29 03:38:43', '2018-10-29 03:38:43'),
(190, 20, 15, NULL, '1', '2018-10-29 03:38:43', '2018-10-29 03:38:43'),
(191, 20, 15, NULL, '1', '2018-10-29 03:38:43', '2018-10-29 03:38:43'),
(192, 20, 15, NULL, '1', '2018-10-29 03:38:43', '2018-10-29 03:38:43'),
(193, 20, 15, NULL, '1', '2018-10-29 03:38:43', '2018-10-29 03:38:43'),
(194, 20, 15, NULL, '1', '2018-10-29 03:38:43', '2018-10-29 03:38:43'),
(195, 20, 15, NULL, '1', '2018-10-29 03:38:43', '2018-10-29 03:38:43'),
(196, 20, 15, NULL, '1', '2018-10-29 03:44:06', '2018-10-29 03:44:06'),
(197, 20, 15, NULL, '1', '2018-10-29 03:44:06', '2018-10-29 03:44:06'),
(198, 20, 15, NULL, '1', '2018-10-29 03:44:06', '2018-10-29 03:44:06'),
(199, 20, 15, NULL, '1', '2018-10-29 03:44:06', '2018-10-29 03:44:06'),
(200, 20, 15, NULL, '1', '2018-10-29 03:44:06', '2018-10-29 03:44:06'),
(201, 20, 15, NULL, '1', '2018-10-29 03:44:06', '2018-10-29 03:44:06'),
(202, 20, 15, NULL, '1', '2018-10-29 03:44:06', '2018-10-29 03:44:06'),
(203, 20, 15, NULL, '1', '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(204, 20, 15, NULL, '1', '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(205, 20, 15, NULL, '1', '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(206, 20, 15, NULL, '1', '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(207, 20, 15, NULL, '1', '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(208, 20, 15, NULL, '1', '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(209, 20, 15, NULL, '1', '2018-11-02 04:24:42', '2018-11-02 04:24:42'),
(210, 20, 15, NULL, '1', '2018-11-02 04:27:07', '2018-11-02 04:27:07'),
(211, 20, 15, NULL, '1', '2018-11-02 04:27:07', '2018-11-02 04:27:07'),
(212, 20, 15, NULL, '1', '2018-11-02 04:27:07', '2018-11-02 04:27:07'),
(213, 20, 15, NULL, '1', '2018-11-02 04:27:07', '2018-11-02 04:27:07'),
(214, 20, 15, NULL, '1', '2018-11-02 04:27:07', '2018-11-02 04:27:07'),
(215, 20, 15, NULL, '1', '2018-11-02 04:27:07', '2018-11-02 04:27:07'),
(216, 20, 15, NULL, '1', '2018-11-02 04:27:07', '2018-11-02 04:27:07'),
(217, 20, 15, NULL, '1', '2018-11-02 04:27:12', '2018-11-02 04:27:12'),
(218, 20, 15, NULL, '1', '2018-11-02 04:27:12', '2018-11-02 04:27:12'),
(219, 20, 15, NULL, '1', '2018-11-02 04:27:12', '2018-11-02 04:27:12'),
(220, 20, 15, NULL, '1', '2018-11-02 04:27:12', '2018-11-02 04:27:12'),
(221, 20, 15, NULL, '1', '2018-11-02 04:27:12', '2018-11-02 04:27:12'),
(222, 20, 15, NULL, '1', '2018-11-02 04:27:12', '2018-11-02 04:27:12'),
(223, 20, 15, NULL, '1', '2018-11-02 04:27:12', '2018-11-02 04:27:12'),
(224, 20, 15, NULL, '1', '2018-11-02 04:27:20', '2018-11-02 04:27:20'),
(225, 20, 15, NULL, '1', '2018-11-02 04:27:20', '2018-11-02 04:27:20'),
(226, 20, 15, NULL, '1', '2018-11-02 04:27:20', '2018-11-02 04:27:20'),
(227, 20, 15, NULL, '1', '2018-11-02 04:27:20', '2018-11-02 04:27:20'),
(228, 20, 15, NULL, '1', '2018-11-02 04:27:20', '2018-11-02 04:27:20'),
(229, 20, 15, NULL, '1', '2018-11-02 04:27:20', '2018-11-02 04:27:20'),
(230, 20, 15, NULL, '1', '2018-11-02 04:27:20', '2018-11-02 04:27:20'),
(231, 20, 15, NULL, '1', '2018-11-02 04:51:34', '2018-11-02 04:51:34'),
(232, 20, 15, NULL, '1', '2018-11-02 04:51:34', '2018-11-02 04:51:34'),
(233, 20, 15, NULL, '1', '2018-11-02 04:51:34', '2018-11-02 04:51:34'),
(234, 20, 15, NULL, '1', '2018-11-02 04:51:34', '2018-11-02 04:51:34'),
(235, 20, 15, NULL, '1', '2018-11-02 05:16:37', '2018-11-02 05:16:37'),
(236, 20, 15, NULL, '1', '2018-11-02 05:16:37', '2018-11-02 05:16:37'),
(237, 20, 15, NULL, '1', '2018-11-02 05:16:37', '2018-11-02 05:16:37'),
(238, 20, 15, NULL, '1', '2018-11-02 05:16:37', '2018-11-02 05:16:37'),
(239, 20, 15, NULL, '1', '2018-11-02 05:16:37', '2018-11-02 05:16:37'),
(240, 20, 15, NULL, '1', '2018-11-02 05:16:37', '2018-11-02 05:16:37'),
(241, 20, 15, NULL, '1', '2018-11-02 05:16:37', '2018-11-02 05:16:37'),
(242, 2, 15, NULL, '1', '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(243, 2, 15, NULL, '1', '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(244, 2, 15, NULL, '1', '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(245, 2, 15, NULL, '1', '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(246, 2, 15, NULL, '1', '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(247, 2, 15, NULL, '1', '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(248, 2, 15, NULL, '1', '2018-11-05 07:08:02', '2018-11-05 07:08:02'),
(249, 2, 15, NULL, '1', '2018-11-05 07:08:07', '2018-11-05 07:08:07'),
(250, 2, 15, NULL, '1', '2018-11-05 07:08:07', '2018-11-05 07:08:07'),
(251, 2, 15, NULL, '1', '2018-11-05 07:08:07', '2018-11-05 07:08:07'),
(252, 2, 15, NULL, '1', '2018-11-05 07:08:07', '2018-11-05 07:08:07'),
(253, 2, 15, NULL, '1', '2018-11-05 07:08:07', '2018-11-05 07:08:07'),
(254, 2, 15, NULL, '1', '2018-11-05 07:08:07', '2018-11-05 07:08:07'),
(255, 2, 15, NULL, '1', '2018-11-05 07:08:07', '2018-11-05 07:08:07'),
(256, 2, 15, NULL, '1', '2018-11-05 07:08:13', '2018-11-05 07:08:13'),
(257, 2, 15, NULL, '1', '2018-11-05 07:08:13', '2018-11-05 07:08:13'),
(258, 2, 15, NULL, '1', '2018-11-05 07:08:13', '2018-11-05 07:08:13'),
(259, 2, 15, NULL, '1', '2018-11-05 07:08:13', '2018-11-05 07:08:13'),
(260, 2, 15, NULL, '1', '2018-11-05 07:08:13', '2018-11-05 07:08:13'),
(261, 2, 15, NULL, '1', '2018-11-05 07:08:13', '2018-11-05 07:08:13'),
(262, 2, 15, NULL, '1', '2018-11-05 07:08:13', '2018-11-05 07:08:13'),
(263, 2, 15, NULL, '1', '2018-11-05 07:08:35', '2018-11-05 07:08:35'),
(264, 2, 15, NULL, '1', '2018-11-05 07:08:35', '2018-11-05 07:08:35'),
(265, 2, 15, NULL, '1', '2018-11-05 07:08:35', '2018-11-05 07:08:35'),
(266, 2, 15, NULL, '1', '2018-11-05 07:08:36', '2018-11-05 07:08:36'),
(267, 2, 15, NULL, '1', '2018-11-05 07:08:36', '2018-11-05 07:08:36'),
(268, 2, 15, NULL, '1', '2018-11-05 07:08:36', '2018-11-05 07:08:36'),
(269, 2, 15, NULL, '1', '2018-11-05 07:08:36', '2018-11-05 07:08:36'),
(270, 2, 15, NULL, '1', '2018-11-05 08:04:42', '2018-11-05 08:04:42'),
(271, 2, 15, NULL, '1', '2018-11-05 08:04:42', '2018-11-05 08:04:42'),
(272, 2, 15, NULL, '1', '2018-11-05 08:04:42', '2018-11-05 08:04:42'),
(273, 2, 15, NULL, '1', '2018-11-05 08:04:42', '2018-11-05 08:04:42'),
(274, 2, 15, NULL, '1', '2018-11-05 08:04:42', '2018-11-05 08:04:42'),
(275, 2, 15, NULL, '1', '2018-11-05 08:04:42', '2018-11-05 08:04:42'),
(276, 2, 15, NULL, '1', '2018-11-05 08:04:42', '2018-11-05 08:04:42'),
(277, 2, 15, NULL, '1', '2018-11-05 08:04:50', '2018-11-05 08:04:50'),
(278, 2, 15, NULL, '1', '2018-11-05 08:04:50', '2018-11-05 08:04:50'),
(279, 2, 15, NULL, '1', '2018-11-05 08:04:50', '2018-11-05 08:04:50'),
(280, 2, 15, NULL, '1', '2018-11-05 08:04:50', '2018-11-05 08:04:50'),
(281, 2, 15, NULL, '1', '2018-11-05 08:04:50', '2018-11-05 08:04:50'),
(282, 2, 15, NULL, '1', '2018-11-05 08:04:50', '2018-11-05 08:04:50'),
(283, 2, 15, NULL, '1', '2018-11-05 08:04:50', '2018-11-05 08:04:50'),
(284, 2, 15, NULL, '1', '2018-11-05 08:05:00', '2018-11-05 08:05:00'),
(285, 2, 15, NULL, '1', '2018-11-05 08:05:00', '2018-11-05 08:05:00'),
(286, 2, 15, NULL, '1', '2018-11-05 08:05:00', '2018-11-05 08:05:00'),
(287, 2, 15, NULL, '1', '2018-11-05 08:05:00', '2018-11-05 08:05:00'),
(288, 2, 15, NULL, '1', '2018-11-05 08:05:00', '2018-11-05 08:05:00'),
(289, 2, 15, NULL, '1', '2018-11-05 08:05:00', '2018-11-05 08:05:00'),
(290, 2, 15, NULL, '1', '2018-11-05 08:05:00', '2018-11-05 08:05:00'),
(291, 20, 15, NULL, '1', '2018-11-05 08:30:38', '2018-11-05 08:30:38'),
(292, 20, 15, NULL, '1', '2018-11-05 08:30:38', '2018-11-05 08:30:38'),
(293, 20, 15, NULL, '1', '2018-11-05 08:30:38', '2018-11-05 08:30:38'),
(294, 20, 15, NULL, '1', '2018-11-05 08:30:38', '2018-11-05 08:30:38'),
(295, 20, 15, NULL, '1', '2018-11-05 08:30:38', '2018-11-05 08:30:38'),
(296, 20, 15, NULL, '1', '2018-11-05 08:30:38', '2018-11-05 08:30:38'),
(297, 20, 15, NULL, '1', '2018-11-05 08:30:38', '2018-11-05 08:30:38'),
(298, 20, 15, NULL, '1', '2018-11-05 08:30:50', '2018-11-05 08:30:50'),
(299, 20, 15, NULL, '1', '2018-11-05 08:30:50', '2018-11-05 08:30:50'),
(300, 20, 15, NULL, '1', '2018-11-05 08:30:50', '2018-11-05 08:30:50'),
(301, 20, 15, NULL, '1', '2018-11-05 08:30:50', '2018-11-05 08:30:50'),
(302, 20, 15, NULL, '1', '2018-11-05 08:30:50', '2018-11-05 08:30:50'),
(303, 20, 15, NULL, '1', '2018-11-05 08:30:50', '2018-11-05 08:30:50'),
(304, 20, 15, NULL, '1', '2018-11-05 08:30:50', '2018-11-05 08:30:50'),
(305, 46, 10, NULL, '0.5', '2018-11-05 23:54:28', '2018-11-05 23:54:28'),
(306, 46, 4, NULL, '10', '2018-11-05 23:54:28', '2018-11-05 23:54:28'),
(307, 52, 10, NULL, '0.5', '2018-11-06 00:06:24', '2018-11-06 00:06:24'),
(308, 53, 10, NULL, '0.5', '2018-11-06 00:08:17', '2018-11-06 00:08:17'),
(309, 54, 10, NULL, '0.5', '2018-11-06 00:09:33', '2018-11-06 00:09:33'),
(310, 54, 4, NULL, '10', '2018-11-06 00:09:33', '2018-11-06 00:09:33'),
(311, 54, 15, NULL, '1', '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(312, 54, 15, NULL, '1', '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(313, 54, 15, NULL, '1', '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(314, 54, 15, NULL, '1', '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(315, 54, 15, NULL, '1', '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(316, 54, 15, NULL, '1', '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(317, 54, 15, NULL, '1', '2018-11-06 00:10:40', '2018-11-06 00:10:40'),
(318, 54, 15, NULL, '1', '2018-11-06 00:10:44', '2018-11-06 00:10:44'),
(319, 54, 15, NULL, '1', '2018-11-06 00:10:44', '2018-11-06 00:10:44'),
(320, 54, 15, NULL, '1', '2018-11-06 00:10:44', '2018-11-06 00:10:44'),
(321, 54, 15, NULL, '1', '2018-11-06 00:10:44', '2018-11-06 00:10:44'),
(322, 54, 15, NULL, '1', '2018-11-06 00:10:44', '2018-11-06 00:10:44'),
(323, 54, 15, NULL, '1', '2018-11-06 00:10:44', '2018-11-06 00:10:44'),
(324, 54, 15, NULL, '1', '2018-11-06 00:10:44', '2018-11-06 00:10:44'),
(325, 54, 15, NULL, '1', '2018-11-06 00:10:50', '2018-11-06 00:10:50'),
(326, 54, 15, NULL, '1', '2018-11-06 00:10:50', '2018-11-06 00:10:50'),
(327, 54, 15, NULL, '1', '2018-11-06 00:10:50', '2018-11-06 00:10:50'),
(328, 54, 15, NULL, '1', '2018-11-06 00:10:50', '2018-11-06 00:10:50'),
(329, 54, 15, NULL, '1', '2018-11-06 00:10:50', '2018-11-06 00:10:50'),
(330, 54, 15, NULL, '1', '2018-11-06 00:10:50', '2018-11-06 00:10:50'),
(331, 54, 15, NULL, '1', '2018-11-06 00:10:50', '2018-11-06 00:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_poll`
--

CREATE TABLE `user_poll` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `poll_option` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `celebrities`
--
ALTER TABLE `celebrities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `celeb_activity`
--
ALTER TABLE `celeb_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls_respond`
--
ALTER TABLE `polls_respond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_question`
--
ALTER TABLE `rating_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_follow`
--
ALTER TABLE `users_follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `celebrities`
--
ALTER TABLE `celebrities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `celeb_activity`
--
ALTER TABLE `celeb_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `polls_respond`
--
ALTER TABLE `polls_respond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `rating_question`
--
ALTER TABLE `rating_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `users_follow`
--
ALTER TABLE `users_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
