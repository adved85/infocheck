-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2019 at 03:43 PM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.2.11-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara_infocheck`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `body`, `created_at`, `updated_at`) VALUES
(1, 'Ոչ, Մր․ Բինը, էն որ ասում են, մաքրամաքուր բրիտանացի է։', '2019-05-04 11:03:06', '2019-05-13 07:19:11'),
(9, 'Թող մնա, քեզ ինչա խանգառում ՞', '2019-05-17 20:06:19', '2019-05-17 20:06:19'),
(10, 'Չի աղմկում, հոսումա․', '2019-05-17 20:09:08', '2019-05-17 20:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(10) UNSIGNED DEFAULT NULL,
  `layout` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `lang_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `item_id`, `name`, `position`, `layout`, `status`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Հայաստան', 1, 'A', 1, 1, NULL, NULL),
(2, 1, 'Armenia', 1, 'A', 1, 2, NULL, NULL),
(3, 1, 'Армения', 1, 'A', 1, 3, NULL, NULL),
(4, 2, 'Միջազգային', 2, 'B', 1, 1, NULL, NULL),
(5, 2, 'International', 2, 'B', 1, 2, NULL, NULL),
(6, 2, 'Международные', 2, 'B', 1, 3, NULL, NULL),
(7, 3, 'Տարածաշրջանային', 3, 'C', 1, 1, NULL, NULL),
(8, 3, 'Regional', 3, 'C', 1, 2, NULL, NULL),
(9, 3, 'Региональный', 3, 'C', 1, 3, NULL, NULL),
(10, 4, 'Գծային', 4, 'D', 1, 1, NULL, NULL),
(11, 4, 'Linear', 4, 'D', 1, 2, NULL, NULL),
(12, 4, 'Линейный', 4, 'D', 1, 3, NULL, NULL),
(13, 5, 'Գարնանային', 5, 'C', 1, 1, NULL, NULL),
(14, 5, 'Spring', 5, 'C', 1, 2, NULL, NULL),
(15, 5, 'Весенний', 5, 'C', 1, 3, NULL, NULL),
(16, 6, 'Ամառային', 6, 'A', 1, 1, NULL, NULL),
(17, 6, 'Summer', 6, 'A', 1, 2, NULL, NULL),
(18, 6, 'Летний', 6, 'A', 1, 3, NULL, NULL),
(19, 7, 'Աշնանային', 7, 'B', 1, 1, NULL, NULL),
(20, 7, 'Outumn', 7, 'B', 1, 2, NULL, NULL),
(21, 7, 'Осенний', 7, 'B', 1, 3, NULL, NULL),
(22, 8, 'Ձմեռային', 8, 'D', 1, 1, NULL, NULL),
(23, 8, 'Winter', 8, 'D', 1, 2, NULL, NULL),
(24, 8, 'Зимний', 8, 'D', 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `approved`, `post_id`, `user_id`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, 'Վայ էս ինչ լավ փոստա #1 - post-id#1', 1, 1, 3, 1, '2019-05-04 11:03:06', '2019-05-16 07:00:01'),
(2, 'Վայ շատ լավ փոստա #2 - post-id#1', 1, 1, 3, 1, '2019-05-04 11:03:06', '2019-05-08 12:13:57'),
(3, 'Սա ընտիր փոստա #3 - post-id#1', 1, 1, 3, 1, '2019-05-04 11:03:06', '2019-05-17 18:16:32'),
(4, 'Really cool post #1 - post-id#2', 1, 2, 3, 2, '2019-05-04 11:03:06', '2019-05-04 11:03:06'),
(5, 'Wery nice post #2 - post-id#2', 1, 2, 3, 2, '2019-05-04 11:03:06', '2019-05-04 11:03:06'),
(6, 'I will never forget this post #3 - post-id#2', 1, 2, 3, 2, '2019-05-04 11:03:06', '2019-05-04 11:03:06'),
(7, 'Отлисная статья спасибо #1 - post-id#3', 1, 3, 3, 3, '2019-05-04 11:03:06', '2019-05-14 09:21:22'),
(8, 'Это лучшее что может произойти с человеком #2 - post-id#3', 1, 3, 3, 3, '2019-05-04 11:03:06', '2019-05-14 09:21:25'),
(9, 'Я не забуду этот пост никогда, спасибо #3 - post-id#3', 1, 3, 3, 3, '2019-05-04 11:03:06', '2019-05-14 09:21:31'),
(10, 'Я не забуду этот пост никогда номер-4', 0, 7, 3, 3, '2019-05-04 11:26:44', '2019-05-14 09:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentable_id` bigint(20) UNSIGNED NOT NULL,
  `documentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isused` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `link`, `type`, `documentable_id`, `documentable_type`, `isused`, `created_at`, `updated_at`) VALUES
(1, 'example.docx', '/storage/posts/7/27/example.docx', 'docx', 27, 'App\\Post', 1, '2019-05-08 10:57:54', '2019-05-08 10:58:18'),
(2, 'LIFTROLL.xls', '/storage/posts/7/27/LIFTROLL.xls', 'xls', 27, 'App\\Post', 1, '2019-05-08 10:57:54', '2019-05-08 10:58:18'),
(3, 'js7.zip', '/storage/posts/7/28/js7.zip', 'zip', 28, 'App\\Post', 1, '2019-05-08 10:59:12', '2019-05-08 10:59:12'),
(4, 'example.docx', '/storage/questions/2/example.docx', 'docx', 2, 'App\\Question', 1, '2019-05-14 10:59:12', '2019-05-14 10:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_date`, `end_date`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, '', '2019-04-19', '2019-04-19', 1, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(2, '', '2019-04-19', '2019-04-19', 2, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(3, '', '2019-04-19', '2019-04-19', 3, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(4, '', '2019-04-20', '2019-04-20', 1, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(5, '', '2019-04-20', '2019-04-20', 2, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(6, '', '2019-04-20', '2019-04-20', 3, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(7, '', '2019-04-21', '2019-04-21', 1, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(8, '', '2019-04-21', '2019-04-21', 2, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(9, '', '2019-04-21', '2019-04-21', 3, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(10, '', '2019-04-22', '2019-04-22', 1, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(11, '', '2019-04-21', '2019-04-21', 1, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(12, '', '2019-04-21', '2019-04-21', 2, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(13, '', '2019-04-21', '2019-04-21', 3, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(14, '', '2019-04-21', '2019-04-21', 1, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(15, '', '2019-04-21', '2019-04-21', 2, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(16, '', '2019-04-21', '2019-04-21', 3, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(18, '', '2019-05-07', '2019-05-07', 2, '2019-05-07 09:31:02', '2019-05-07 09:31:02'),
(19, '', '2019-05-10', '2019-05-10', 1, '2019-05-10 09:39:29', '2019-05-10 09:39:29'),
(20, '', '2019-05-11', '2019-05-11', 1, '2019-05-11 07:50:31', '2019-05-11 07:50:31'),
(23, '', '2019-05-18', '2019-05-18', 1, '2019-05-17 18:38:38', '2019-05-17 18:38:38'),
(24, '', '2019-05-18', '2019-05-18', 2, '2019-05-17 18:51:24', '2019-05-17 18:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `langs`
--

CREATE TABLE `langs` (
  `id` int(10) UNSIGNED NOT NULL,
  `lng` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `langs`
--

INSERT INTO `langs` (`id`, `lng`, `lng_name`, `created_at`, `updated_at`) VALUES
(1, 'am', 'Armenian', '2019-05-04 11:03:02', '2019-05-04 11:03:02'),
(2, 'en', 'English', '2019-05-04 11:03:02', '2019-05-04 11:03:02'),
(3, 'ru', 'Russian', '2019-05-04 11:03:02', '2019-05-04 11:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(325, '0000_00_00_000000_create_taggable_table', 1),
(326, '2014_10_12_000000_create_users_table', 1),
(327, '2014_10_12_100000_create_password_resets_table', 1),
(328, '2019_04_12_114225_create_roles_table', 1),
(329, '2019_04_12_115329_create_role_user_table', 1),
(330, '2019_04_16_000755_create_social_identities_table', 1),
(331, '2019_04_18_083106_create_langs_table', 1),
(332, '2019_04_18_083559_create_categories_table', 1),
(333, '2019_04_18_084637_create_posts_table', 1),
(334, '2019_04_18_092600_create_comments_table', 1),
(335, '2019_04_18_093845_create_documents_table', 1),
(336, '2019_04_18_095435_create_questions_table', 1),
(337, '2019_04_18_121138_create_answers_table', 1),
(338, '2019_04_25_090710_create_posters_table', 1),
(339, '2019_04_29_220737_create_post_layouts_table', 1),
(340, '2019_05_02_112739_create_events_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posters`
--

CREATE TABLE `posters` (
  `id` int(10) UNSIGNED NOT NULL,
  `layout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`id`, `layout`, `status`, `created_at`, `updated_at`) VALUES
(1, 'four', 1, NULL, NULL),
(2, 'five', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `html_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_k` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_d` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `date` date NOT NULL,
  `view` bigint(20) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `unique_id`, `title`, `short_text`, `html_code`, `img`, `meta_k`, `meta_d`, `status`, `date`, `view`, `category_id`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Փոստ համար 1', '\n        1--- Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է:\n        ', '\n        1... Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n        Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n        ', '/storage/posts/1/1.jpg', 'փոստ,համար,մեկ', 'Սա համար մեկ փոստն է', 'published', '2019-04-19', 1, 1, 1, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(2, 1, 'Post number 1', '\n        1--- It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.\n        ', '\n        1... There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n        ', '/storage/posts/1/1.jpg', 'post,number,one', 'This is post number one', 'published', '2019-04-19', 10, 2, 2, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(3, 1, 'Это пост номер 1', '\n        1--- Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.\n        ', '\n        1... Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n        Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n        ', '/storage/posts/1/1.jpg', 'пост, номер, один', 'это пост номер один', 'published', '2019-04-19', 17, 3, 3, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(4, 2, 'Փոստ համար 2', '\n         2--- Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է:\n         ', '\n         2... Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n         Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n         ', '/storage/posts/2/2.jpg', 'փոստ,համար,երկու', 'Սա համար երկու փոստն է', 'published', '2019-04-20', 2, 1, 1, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(5, 2, 'Post number 2', '\n         2--- It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.\n         ', '\n         2... There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n         There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n         ', '/storage/posts/2/2.jpg', 'post,number,two', 'This is post number two', 'published', '2019-04-20', 3, 2, 2, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(6, 2, 'Это пост номер 2', '\n         2--- Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.\n         ', '\n         2... Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n         Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n         ', '/storage/posts/2/2.jpg', 'пост, номер, два', 'это пост номер два', 'published', '2019-04-20', 4, 3, 3, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(7, 3, 'Փոստ համար 3', '\n        3--- Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է:\n        ', '\n        3... Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n        Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n        ', '/storage/posts/3/3.jpg', 'փոստ,համար,երեք', 'Սա համար երեք փոստն է', 'published', '2019-04-21', 34, 1, 1, '2019-05-04 11:03:04', '2019-05-04 11:03:04'),
(8, 3, 'Post number 3', '\n        3--- It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.\n        ', '\n        3... There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n        ', '/storage/posts/3/3.jpg', 'post,number,three', 'This is post number three', 'published', '2019-04-21', 35, 2, 2, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(9, 3, 'Это пост номер 3', '\n        3--- Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.\n        ', '\n        3... Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n        Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n        ', '/storage/posts/3/3.jpg', 'пост, номер, три', 'это пост номер три', 'published', '2019-04-21', 20, 3, 3, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(10, 4, 'Փոստ համար 4', '\n         4--- Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է:\n         ', '\n         4... Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n         Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n         ', '/storage/posts/4/4.jpg', 'փոստ,համար,չորս', 'Սա համար չորս փոստն է', 'published', '2019-04-22', 43, 7, 1, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(11, 5, 'Փոստ համար 5', '\n         3--- Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է:\n         ', '\n         3... Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n         Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n         ', '/storage/posts/5/5.jpg', 'փոստ,համար,երեք', 'Սա համար երեք փոստն է', 'published', '2019-04-21', 11, 1, 1, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(12, 5, 'Post number 5', '\n         3--- It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.\n         ', '\n         3... There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n         There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n         ', '/storage/posts/5/5.jpg', 'post,number,three', 'This is post number three', 'published', '2019-04-21', 9, 2, 2, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(13, 5, 'Это пост номер 5', '\n         3--- Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.\n         ', '\n         3... Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n         Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n         ', '/storage/posts/5/5.jpg', 'пост, номер, три', 'это пост номер три', 'published', '2019-04-21', 6, 3, 3, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(14, 6, 'Փոստ համար 6', '\n         3--- Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է:\n         ', '\n         3... Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n         Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):\n         ', '/storage/posts/6/6.jpg', 'փոստ,համար,երեք', 'Սա համար երեք փոստն է', 'published', '2019-04-21', 26, 4, 1, '2019-05-04 11:03:05', '2019-05-10 09:53:00'),
(15, 6, 'Post number 6', '\n         3--- It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.\n         ', '\n         3... There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n         There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n         ', '/storage/posts/6/6.jpg', 'post,number,three', 'This is post number three', 'published', '2019-04-21', 16, 5, 2, '2019-05-04 11:03:05', '2019-05-07 09:31:02'),
(16, 6, 'Это пост номер 6', '\n         3--- Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.\n         ', '\n         3... Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n         Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).\n         ', '/storage/posts/6/6.jpg', 'пост, номер, три', 'это пост номер три', 'main', '2019-04-21', 9, 6, 3, '2019-05-04 11:03:05', '2019-05-04 11:03:05'),
(27, 7, 'Փոստ 77', '<p>77-Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն &laquo;Բովանդակություն, բովանդակություն&raquo; սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):</p>', '<p>77-Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն &laquo;Բովանդակություն, բովանդակություն&raquo; սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):</p>\r\n\r\n<p><img alt="/omega_white" src="/storage/posts/7/omega_white_back1.png" style="float:left; height:672px; margin-left:10px; margin-right:10px; width:801px" />Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն &laquo;Բովանդակություն, բովանդակություն&raquo; սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն &laquo;Բովանդակություն, բովանդակություն&raquo; սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):</p>\r\n\r\n<p>Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն &laquo;Բովանդակություն, բովանդակություն&raquo; սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>new</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img src="moz-extension://e379a05a-59a4-4880-b1d7-d722276bb48c/res/images/flags/en@2x.png" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img src="moz-extension://e379a05a-59a4-4880-b1d7-d722276bb48c/res/images/flags/ru@2x.png" /></p>\r\n\r\n<p>/omega_white</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>/ omega_white</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Transliteration</p>\r\n\r\n<p>/ omega_white</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>SAVE</p>\r\n\r\n<p>CONTINUE</p>\r\n\r\n<p>view saved words &rarr;</p>\r\n\r\n<p>Don&#39;t translate on double-click</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Don&#39;t show floating button</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Check the localized version of the site</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>No Internet Connection</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Add to Phrasebook\r\n	<p>&nbsp;</p>\r\n\r\n	<ul>\r\n		<li>No word lists for English -&gt; Russian...\r\n		<p>&nbsp;</p>\r\n		</li>\r\n		<li>Create a new word list...</li>\r\n	</ul>\r\n	</li>\r\n	<li>Copy</li>\r\n</ul>', '/storage/posts/7/omega_white_back1.png', 'էլեկտրոնային,շրջան,անվտանգություն,77բարև', 'Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային բարև', 'main', '2019-05-10', 0, 10, 1, '2019-05-07 06:05:04', '2019-05-10 09:53:00'),
(28, 7, 'Post 7', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)...</p>', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p><img alt="omega_white" src="/storage/posts/7/omega_white_back3.png" style="float:left; height:538px; margin-left:10px; margin-right:10px; width:790px" />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '/storage/posts/7/omega_white_back3.png', 'this,is, post,seven', 'this is post seven', 'main', '2019-05-07', 0, 8, 2, '2019-05-07 09:31:02', '2019-05-07 09:31:02'),
(29, 8, 'Փոստ 29', '<p>Նոր պատասխան 3-րդ հացին</p>', '<p>Նոր պատասխան 3-րդ հացին</p>', '/storage/posts/8/html_screen1.png', 'նոր, պատասխան,երեքին', 'նոր պատասխան երեքին', 'published', '2019-05-17', 6, 1, 1, '2019-05-17 11:21:07', '2019-05-17 11:21:07'),
(33, 9, 'Փոստ 33-9 ի պատասխան հարց 3-ի', '<p>Փոստ 33/9- Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն &laquo;Բովանդակություն, բովանդակություն&raquo; սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):</p>', '<p>Փոստ 33/9- Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն &laquo;Բովանդակություն, բովանդակություն&raquo; սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն &laquo;Բովանդակություն, բովանդակություն&raquo; սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):</p>', '/storage/posts/9/omega_white_back1.png', 'նոր, պատասխան,երեքին', 'նոր պատասխան երեքին', 'published', '2019-05-17', 4, 1, 1, '2019-05-17 18:38:37', '2019-05-17 18:46:34'),
(34, 10, 'Create new Post №-34-10', '<p>It is reply for Question N-4</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '<p><em><strong>It is reply for Question N-4</strong></em> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '/storage/posts/9/omega_white_back1.png', 'this,post,34', 'this is post 34', 'published', '2019-05-18', 1, 14, 2, '2019-05-17 18:51:23', '2019-05-18 06:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `post_layouts`
--

CREATE TABLE `post_layouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_layouts`
--

INSERT INTO `post_layouts` (`id`, `class_name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, NULL, NULL),
(2, 'B', 1, NULL, NULL),
(3, 'C', 1, NULL, NULL),
(4, 'D', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `link` text COLLATE utf8mb4_unicode_ci,
  `questionable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `questionable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `body`, `visible`, `link`, `questionable_id`, `questionable_type`, `lang_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Խնդրում եմ ասեք, Ճիշտ է՞, որ Մր․ Բինը հայա', 1, NULL, 1, 'App\\Answer', 1, 3, '2019-05-04 11:03:03', '2019-05-04 11:03:06'),
(2, 'Խնդրում եմ ասեք, Ճիշտ է՞, որ Մր․ Դարտանյանը հայա', 1, 'localhost::8000/am/posts/10', 10, 'App\\Post', 1, 3, '2019-05-04 11:03:03', '2019-05-08 19:29:44'),
(3, 'Ո՞րն է ապարանցու սիրած գույնը', 1, 'posts/9/%D5%93%D5%B8%D5%BD%D5%BF+33%2F9+%D5%AB+%D5%BA%D5%A1%D5%BF%D5%A1%D5%BD%D5%AD%D5%A1%D5%B6+%D5%B0%D5%A1%D6%80%D6%81+3-%D5%AB', 33, 'App\\Post', 1, 11, '2019-05-04 11:03:04', '2019-05-17 18:39:37'),
(4, 'What is your favorite color?', 1, 'posts/10/Create+new+Post+%E2%84%96-34-10', 34, 'App\\Post', 2, 11, '2019-05-04 11:03:04', '2019-05-17 19:14:00'),
(5, 'Ինչու է աղմկում գետը՞', 1, NULL, 10, 'App\\Answer', 1, 11, '2019-05-13 11:03:04', '2019-05-18 04:47:20'),
(6, 'Я хотел вьехать в город на белом коне ?', 1, 'posts/1/%D0%AD%D1%82%D0%BE+%D0%BF%D0%BE%D1%81%D1%82+%D0%BD%D0%BE%D0%BC%D0%B5%D1%80+1', 3, 'App\\Post', 3, 11, '2019-05-18 11:03:04', '2019-05-18 05:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'employee', 'An employee user', '2019-05-04 11:03:01', '2019-05-04 11:03:01'),
(2, 'manager', 'A manager user', '2019-05-04 11:03:01', '2019-05-04 11:03:01'),
(3, 'i_user', 'A simple user', '2019-05-04 11:03:01', '2019-05-04 11:03:01'),
(4, 'i_admin', 'An administrator', '2019-05-04 11:03:01', '2019-05-04 11:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-05-04 11:03:01', '2019-05-04 11:03:01'),
(2, 2, 2, '2019-05-04 11:03:01', '2019-05-04 11:03:01'),
(3, 3, 3, '2019-05-04 11:03:02', '2019-05-04 11:03:02'),
(4, 4, 4, '2019-05-04 11:03:02', '2019-05-04 11:03:02'),
(11, 3, 11, '2019-05-14 12:15:48', '2019-05-14 12:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `social_identities`
--

CREATE TABLE `social_identities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_identities`
--

INSERT INTO `social_identities` (`id`, `user_id`, `provider_name`, `provider_id`, `created_at`, `updated_at`) VALUES
(4, 11, 'facebook', '2249725818620244', '2019-05-14 12:15:59', '2019-05-14 12:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `taggable_taggables`
--

CREATE TABLE `taggable_taggables` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggable_taggables`
--

INSERT INTO `taggable_taggables` (`id`, `tag_id`, `taggable_id`, `taggable_type`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'App\\Post', 1, NULL, NULL),
(2, 2, 6, 'App\\Post', 3, NULL, NULL),
(3, 3, 2, 'App\\Post', 2, NULL, NULL),
(4, 1, 2, 'App\\Post', 1, NULL, NULL),
(6, 2, 3, 'App\\Post', 3, NULL, NULL),
(7, 5, 6, 'App\\Post', 3, NULL, NULL),
(8, 2, 9, 'App\\Post', 3, NULL, NULL),
(9, 2, 13, 'App\\Post', 3, NULL, NULL),
(10, 4, 3, 'App\\Post', 3, NULL, NULL),
(11, 5, 3, 'App\\Post', 3, NULL, NULL),
(12, 4, 6, 'App\\Post', 3, NULL, NULL),
(13, 4, 9, 'App\\Post', 3, NULL, NULL),
(14, 5, 9, 'App\\Post', 3, NULL, NULL),
(15, 5, 13, 'App\\Post', 3, NULL, NULL),
(16, 4, 13, 'App\\Post', 3, NULL, NULL),
(42, 3, 28, 'App\\Post', 2, '2019-05-07 09:31:02', '2019-05-07 09:31:02'),
(43, 16, 28, 'App\\Post', 2, '2019-05-07 09:31:02', '2019-05-07 09:31:02'),
(44, 17, 28, 'App\\Post', 2, '2019-05-07 09:31:02', '2019-05-07 09:31:02'),
(54, 1, 27, 'App\\Post', 1, '2019-05-10 09:53:00', '2019-05-10 09:53:00'),
(55, 13, 27, 'App\\Post', 1, '2019-05-10 09:53:00', '2019-05-10 09:53:00'),
(56, 19, 29, 'App\\Post', 1, '2019-05-17 11:21:07', '2019-05-17 11:21:07'),
(57, 20, 29, 'App\\Post', 1, '2019-05-17 11:21:07', '2019-05-17 11:21:07'),
(62, 1, 33, 'App\\Post', 1, '2019-05-17 18:46:34', '2019-05-17 18:46:34'),
(63, 18, 33, 'App\\Post', 1, '2019-05-17 18:46:34', '2019-05-17 18:46:34'),
(68, 3, 34, 'App\\Post', 2, '2019-05-18 06:32:04', '2019-05-18 06:32:04'),
(69, 21, 34, 'App\\Post', 2, '2019-05-18 06:32:04', '2019-05-18 06:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `taggable_tags`
--

CREATE TABLE `taggable_tags` (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `normalized` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggable_tags`
--

INSERT INTO `taggable_tags` (`tag_id`, `name`, `normalized`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, 'Հայաստան', 'Հայաստան', 1, NULL, NULL),
(2, 'Ереван', 'Ереван', 3, NULL, NULL),
(3, 'USA', 'USA', 2, NULL, NULL),
(4, 'исправный', 'исправный', 3, NULL, NULL),
(5, 'годный', 'годный', 3, NULL, NULL),
(6, 'старательный', 'старательный', 3, NULL, NULL),
(13, 'փոստ', 'փոստ', 1, '2019-05-07 05:42:05', '2019-05-07 05:42:05'),
(14, 'յոթ', 'յոթ', 1, '2019-05-07 05:42:05', '2019-05-07 05:42:05'),
(15, 'յոթ֊յոթ', 'յոթ֊յոթ', 1, '2019-05-07 05:45:45', '2019-05-07 05:45:45'),
(16, 'post', 'post', 2, '2019-05-07 09:31:02', '2019-05-07 09:31:02'),
(17, 'seven', 'seven', 2, '2019-05-07 09:31:02', '2019-05-07 09:31:02'),
(18, 'հարց3', 'հարց3', 1, '2019-05-11 07:50:31', '2019-05-11 07:50:31'),
(19, 'պատ', 'պատ', 1, '2019-05-17 11:21:07', '2019-05-17 11:21:07'),
(20, 'երեքին', 'երեքին', 1, '2019-05-17 11:21:07', '2019-05-17 11:21:07'),
(21, 'post34', 'post34', 2, '2019-05-17 18:51:23', '2019-05-17 18:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `avatar` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Employee Name', 'employee@mail.ru', NULL, '$2y$10$iGaATY06AvZZtFwudNRwwOlcgEa6rb7AYWksZcjHfhsRKdt8fDIFy', 0, NULL, NULL, '2019-05-04 11:03:01', '2019-05-15 10:01:50'),
(2, 'Manager Name', NULL, NULL, '$2y$10$bi8LKEJjwaFHMyoKDvzUEO8HjTBx9PGaNDFY/lwouhRSwUaz5f//m', 1, NULL, NULL, '2019-05-04 11:03:01', '2019-05-15 10:00:18'),
(3, 'User Name', 'user@mail.ru', '2019-05-03 20:00:00', '$2y$10$O93sB.NOgWmCGZ6nbSP0H.fbtH6YpQFG/sopXfHXsVfX6XvF06TRO', 1, NULL, NULL, '2019-05-04 11:03:02', '2019-05-15 10:00:14'),
(4, 'Admin Name', 'admin@mail.ru', NULL, '$2y$10$HY3.FnsrG2MbDXSmLpwGJeV5YYBEFjIm908JyecShDHbS5s7hVjxe', 1, NULL, NULL, '2019-05-04 11:03:02', '2019-05-15 09:43:50'),
(11, 'արմատա թեւ', 'armenarakelyan85@gmail.com', '2019-05-16 20:00:00', NULL, 1, '/storage/profiles/11/2249725818620244.jpg', 'QqUOdsoJeyZ5ILXYmG1OMACmaN97AUz89hK3ebPF23yZIFmo40vQkm8RWaG5', '2019-05-14 12:15:48', '2019-05-18 07:42:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langs`
--
ALTER TABLE `langs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_lang_id_foreign` (`lang_id`),
  ADD KEY `posts_category_id_index` (`category_id`);

--
-- Indexes for table `post_layouts`
--
ALTER TABLE `post_layouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_lang_id_foreign` (`lang_id`),
  ADD KEY `questions_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_identities`
--
ALTER TABLE `social_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_identities_provider_id_unique` (`provider_id`);

--
-- Indexes for table `taggable_taggables`
--
ALTER TABLE `taggable_taggables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_taggable_fwd` (`tag_id`,`taggable_id`),
  ADD KEY `i_taggable_rev` (`taggable_id`,`tag_id`),
  ADD KEY `i_taggable_type` (`taggable_type`);

--
-- Indexes for table `taggable_tags`
--
ALTER TABLE `taggable_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD KEY `taggable_tags_normalized_index` (`normalized`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `langs`
--
ALTER TABLE `langs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;
--
-- AUTO_INCREMENT for table `posters`
--
ALTER TABLE `posters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `post_layouts`
--
ALTER TABLE `post_layouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `social_identities`
--
ALTER TABLE `social_identities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `taggable_taggables`
--
ALTER TABLE `taggable_taggables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `taggable_tags`
--
ALTER TABLE `taggable_tags`
  MODIFY `tag_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`),
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`),
  ADD CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
