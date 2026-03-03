-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2026 at 01:27 AM
-- Server version: 9.3.0
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinghts`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint UNSIGNED NOT NULL,
  `about_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` json DEFAULT NULL,
  `about_content` json DEFAULT NULL,
  `vision_title` json DEFAULT NULL,
  `vision_content` json DEFAULT NULL,
  `goals_title` json DEFAULT NULL,
  `goals_content` json DEFAULT NULL,
  `quote_text` json DEFAULT NULL,
  `services_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services_subtext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partners_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `knights_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sports_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sports_subtext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `about_image`, `about_title`, `about_content`, `vision_title`, `vision_content`, `goals_title`, `goals_content`, `quote_text`, `services_heading`, `services_subtext`, `partners_heading`, `knights_heading`, `sports_heading`, `sports_subtext`, `created_at`, `updated_at`) VALUES
(1, 'about-us/01KJNYSMCB450NY69BWSGT4B1Y.webp', '{\"ar\": \"من نحن\", \"en\": \"About Us\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور.\", \"en\": \"\"}', '{\"ar\": \"الرؤية\", \"en\": \"Vision\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.\", \"en\": \"\"}', '{\"ar\": \"الأهداف\", \"en\": \"Goals\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.\", \"en\": \"\"}', '{\"ar\": \"لخيلُ معقودٌ في نواصيها الخيرُ إلى يومِ القيامةِ\", \"en\": \"\"}', '{\"en\":\"\"}', '{\"en\":\"\"}', '{\"en\":\"\"}', '{\"en\":\"\"}', '{\"en\":\"\"}', '{\"en\":\"\"}', '2026-03-01 22:21:27', '2026-03-01 22:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `type`, `street`, `city`, `state`, `postal_code`, `country`, `latitude`, `longitude`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 1, 'Libero atque eligend', '22 Clarendon Avenue', 'Est aut labore et su', NULL, NULL, 'Excepturi id non eni', NULL, NULL, 0, '2026-01-28 16:28:17', '2026-01-28 16:28:26'),
(2, 1, 'Ea et quis adipisici', '151 West Old Boulevard', 'Velit quo in ut et p', NULL, NULL, 'Et dolor ut modi in', NULL, NULL, 1, '2026-01-28 16:28:26', '2026-01-28 16:28:26'),
(3, 2, 'المنزل', 'الرياض', 'الرياض', NULL, NULL, 'المملكة العربية السعودية', NULL, NULL, 1, '2026-01-28 17:15:40', '2026-01-28 17:16:07'),
(4, 2, 'العمل', 'جده', 'جده', NULL, NULL, 'المملكة العربية السعودية', NULL, NULL, 0, '2026-01-28 17:15:59', '2026-01-28 17:16:07'),
(5, 5, 'المنزل', 'المنزل ١١٢٩', 'رياض', NULL, NULL, 'المملكة العربية السعودية', NULL, NULL, 1, '2026-03-01 16:32:22', '2026-03-01 16:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'top',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `link`, `position`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"بنر علوي 1\",\"en\":\"Top Banner 1\"}', NULL, 'top', 1, 1, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(2, '{\"ar\":\"بنر علوي 2\",\"en\":\"Top Banner 2\"}', NULL, 'top', 2, 1, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(3, '{\"ar\":\"بنر وسطي\",\"en\":\"Middle Banner\"}', NULL, 'middle', 1, 1, '2026-01-28 16:16:55', '2026-01-28 16:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `title` json NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` json DEFAULT NULL,
  `content` json NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` json DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `views_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `author_id`, `category_id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `tags`, `is_published`, `is_featured`, `published_at`, `views_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 17, '{\"ar\": \"رحلة استكشافية في صحراء الربع الخالي\", \"en\": \"Exploratory Journey in the Empty Quarter Desert\"}', 'empty-quarter-expedition', '{\"ar\": \"انطلق معنا في رحلة مثيرة عبر أكبر صحراء رملية في العالم، حيث الكثبان الذهبية والسماء الصافية\", \"en\": \"Join us on an exciting journey through the largest sand desert in the world\"}', '{\"ar\": \"<p>تعتبر صحراء الربع الخالي واحدة من أكثر الأماكن سحراً على وجه الأرض. في هذه الرحلة الاستكشافية، قمنا بالتخييم تحت النجوم والتعرف على ثقافة البدو الأصيلة.</p>\\n<h3>ما يميز هذه الرحلة</h3>\\n<ul>\\n<li>ركوب الجمال عبر الكثبان الرملية الذهبية</li>\\n<li>السهرات البدوية التقليدية</li>\\n<li>مشاهدة شروق الشمس من قمة الكثبان</li>\\n<li>تذوق المأكولات التراثية</li>\\n</ul>\\n<p>إنها تجربة لا تُنسى تأخذك إلى عالم آخر من الهدوء والجمال الطبيعي.</p>\", \"en\": \"<p>The Empty Quarter desert is one of the most magical places on earth. In this expedition, we camped under the stars and learned about authentic Bedouin culture.</p>\"}', NULL, '[\"صحراء\", \"ربع خالي\", \"مغامرة\", \"تخييم\"]', 1, 1, '2026-01-23 16:16:55', 1250, '2026-01-28 16:16:55', '2026-01-28 16:16:55', NULL),
(2, 1, 17, '{\"ar\": \"الفروسية العربية: تراث عريق وفن أصيل\", \"en\": \"Arabian Horsemanship: Ancient Heritage and Authentic Art\"}', 'arabian-horsemanship-heritage', '{\"ar\": \"تعرف على تاريخ الفروسية العربية وأهم تقاليدها وكيف نحافظ عليها في خطى الفرسان\", \"en\": \"Learn about the history of Arabian horsemanship and its key traditions\"}', '{\"ar\": \"<p>الفروسية العربية ليست مجرد رياضة، بل هي فن وتراث يمتد لآلاف السنين. في خطى الفرسان، نعمل على الحفاظ على هذا التراث وتعليمه للأجيال الجديدة.</p>\\n<h3>أهمية الحصان العربي</h3>\\n<p>يتميز الحصان العربي بأصالته وذكائه وقوة تحمله، مما جعله رفيقاً مثالياً للفرسان عبر التاريخ.</p>\\n<h3>برامجنا التدريبية</h3>\\n<ul>\\n<li>دورات الفروسية للمبتدئين</li>\\n<li>تدريب متقدم على التقنيات التقليدية</li>\\n<li>رعاية وتغذية الخيول</li>\\n<li>مسابقات وعروض الفروسية</li>\\n</ul>\", \"en\": \"<p>Arabian horsemanship is not just a sport, but an art and heritage spanning thousands of years.</p>\"}', NULL, '[\"فروسية\", \"خيول\", \"تراث\", \"تدريب\"]', 1, 1, '2026-01-18 16:16:55', 980, '2026-01-28 16:16:55', '2026-01-28 16:16:55', NULL),
(3, 1, 17, '{\"ar\": \"أفضل 5 وجهات للتخييم في المملكة\", \"en\": \"Top 5 Camping Destinations in the Kingdom\"}', 'top-5-camping-destinations', '{\"ar\": \"اكتشف أجمل أماكن التخييم في المملكة العربية السعودية مع نصائح للتحضير لرحلتك\", \"en\": \"Discover the most beautiful camping spots in Saudi Arabia\"}', '{\"ar\": \"<p>المملكة العربية السعودية تزخر بأماكن رائعة للتخييم والاستمتاع بالطبيعة. إليكم قائمة بأفضل 5 وجهات:</p>\\n<h3>1. وادي لجب</h3>\\n<p>واحة خضراء وسط الجبال، مثالية للتخييم الصيفي.</p>\\n<h3>2. محمية الحرة</h3>\\n<p>تضاريس بركانية فريدة وليالٍ صافية لمشاهدة النجوم.</p>\\n<h3>3. جبال عسير</h3>\\n<p>أجواء معتدلة وطبيعة خلابة طوال العام.</p>\\n<h3>4. شاطئ أملج</h3>\\n<p>التخييم على البحر الأحمر بمياهه الفيروزية.</p>\\n<h3>5. صحراء نفود</h3>\\n<p>تجربة صحراوية أصيلة مع الكثبان الحمراء.</p>\\n<h3>نصائح للتخييم</h3>\\n<ul>\\n<li>تأكد من حمل كمية كافية من الماء</li>\\n<li>استخدم معدات تخييم عالية الجودة</li>\\n<li>تابع حالة الطقس قبل الانطلاق</li>\\n</ul>\", \"en\": \"<p>Saudi Arabia is full of amazing camping destinations.</p>\"}', NULL, '[\"تخييم\", \"سياحة\", \"طبيعة\", \"نصائح\"]', 1, 0, '2026-01-13 16:16:55', 2100, '2026-01-28 16:16:55', '2026-01-28 16:16:55', NULL),
(4, 1, 17, '{\"ar\": \"فعاليات موسم الصيف: رحلات وأنشطة حصرية\", \"en\": \"Summer Season Events: Exclusive Trips and Activities\"}', 'summer-season-events', '{\"ar\": \"تعرف على جدول فعالياتنا المميزة لموسم الصيف مع عروض خاصة للعائلات\", \"en\": \"Check out our special summer events schedule with family offers\"}', '{\"ar\": \"<p>نقدم لكم في خطى الفرسان مجموعة متميزة من الفعاليات والرحلات الصيفية:</p>\\n<h3>رحلات نهاية الأسبوع</h3>\\n<p>رحلات قصيرة للتخييم والمغامرة مناسبة للعائلات.</p>\\n<h3>معسكرات الفروسية الصيفية</h3>\\n<p>برامج متكاملة لتعلم الفروسية للأطفال والكبار.</p>\\n<h3>جولات السفاري الليلية</h3>\\n<p>استكشف الحياة البرية في الليل مع مرشدينا المتخصصين.</p>\\n<h3>العروض الخاصة</h3>\\n<ul>\\n<li>خصم 20% للعائلات</li>\\n<li>رحلة مجانية لكل 5 حجوزات</li>\\n<li>باقات شاملة بأسعار تنافسية</li>\\n</ul>\", \"en\": \"<p>We present a distinguished collection of summer events and trips at Knights Steps.</p>\"}', NULL, '[\"فعاليات\", \"صيف\", \"عروض\", \"عائلات\"]', 1, 0, '2026-01-25 16:16:55', 751, '2026-01-28 16:16:55', '2026-03-01 15:54:23', NULL),
(5, 1, 17, '{\"ar\": \"كيف تستعد لرحلة صحراوية ناجحة؟\", \"en\": \"How to Prepare for a Successful Desert Trip?\"}', 'prepare-desert-trip-guide', '{\"ar\": \"دليل شامل للتحضير لرحلتك الصحراوية مع قائمة بالمعدات الضرورية\", \"en\": \"A comprehensive guide to prepare for your desert trip\"}', '{\"ar\": \"<p>الرحلات الصحراوية تجربة فريدة تتطلب تحضيراً جيداً. إليكم دليلنا الشامل:</p>\\n<h3>الملابس المناسبة</h3>\\n<ul>\\n<li>ملابس قطنية فضفاضة</li>\\n<li>قبعة أو شماغ للحماية من الشمس</li>\\n<li>جاكيت خفيف للمساء</li>\\n<li>أحذية مريحة ومتينة</li>\\n</ul>\\n<h3>المعدات الأساسية</h3>\\n<ul>\\n<li>خيمة مناسبة للصحراء</li>\\n<li>كيس نوم ذو جودة عالية</li>\\n<li>مصباح يدوي قوي</li>\\n<li>أدوات الطبخ والتخييم</li>\\n</ul>\\n<h3>الصحة والسلامة</h3>\\n<ul>\\n<li>كمية كافية من الماء (4 لتر يومياً)</li>\\n<li>واقي شمس عالي الحماية</li>\\n<li>حقيبة إسعافات أولية</li>\\n<li>خريطة وبوصلة أو GPS</li>\\n</ul>\", \"en\": \"<p>Desert trips are a unique experience that requires good preparation.</p>\"}', NULL, '[\"صحراء\", \"تحضير\", \"دليل\", \"معدات\"]', 1, 0, '2026-01-08 16:16:55', 1500, '2026-01-28 16:16:55', '2026-01-28 16:16:55', NULL),
(6, 1, 17, '{\"ar\": \"قصص من التراث: حكايات الفرسان العرب\", \"en\": \"Stories from Heritage: Tales of Arab Knights\"}', 'arab-knights-tales', '{\"ar\": \"رحلة عبر الزمن مع أشهر قصص الفروسية والشجاعة في التراث العربي\", \"en\": \"A journey through time with the most famous stories of horsemanship and bravery\"}', '{\"ar\": \"<p>التراث العربي مليء بقصص البطولة والفروسية التي ألهمت الأجيال. نقدم لكم بعضاً من أشهر هذه القصص:</p>\\n<h3>عنترة بن شداد</h3>\\n<p>الفارس الشجاع الذي تحدى الصعاب وأصبح رمزاً للشجاعة والإقدام.</p>\\n<h3>الزير سالم</h3>\\n<p>البطل الذي خاض أشرس المعارك ولم يعرف الهزيمة طريقاً إليه.</p>\\n<h3>خالد بن الوليد</h3>\\n<p>سيف الله المسلول، القائد العسكري الفذ الذي لم يُهزم في معركة.</p>\\n<h3>دروس من التراث</h3>\\n<ul>\\n<li>الشجاعة في مواجهة التحديات</li>\\n<li>الكرم والنخوة العربية</li>\\n<li>الوفاء بالعهد</li>\\n<li>حب الخيل والعناية بها</li>\\n</ul>\", \"en\": \"<p>Arab heritage is full of stories of heroism and chivalry that inspired generations.</p>\"}', NULL, '[\"تراث\", \"فروسية\", \"قصص\", \"تاريخ\"]', 1, 1, '2026-01-03 16:16:55', 890, '2026-01-28 16:16:55', '2026-01-28 16:16:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bookable_id` bigint UNSIGNED DEFAULT NULL,
  `bookable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horse_id` bigint UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `provider_notes` text COLLATE utf8mb4_unicode_ci,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancellation_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `package_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_number`, `user_id`, `bookable_id`, `bookable_type`, `horse_id`, `date`, `start_time`, `end_time`, `duration`, `price`, `status`, `payment_status`, `payment_method`, `notes`, `provider_notes`, `confirmed_at`, `completed_at`, `cancelled_at`, `cancellation_reason`, `created_at`, `updated_at`, `deleted_at`, `package_type`, `package_id`) VALUES
(1, 'BK-697A546A6C7F0', 1, 1, 'App\\Models\\Photography', NULL, '2026-01-31', '10:00:00', NULL, 60, 1000.00, 'pending', 'pending', NULL, 'test', NULL, NULL, NULL, NULL, NULL, '2026-01-28 16:24:42', '2026-01-28 16:24:42', NULL, 'App\\Models\\PhotographyPackage', 1),
(2, 'BK-697A54D1BBE0D', 1, 2, 'App\\Models\\HorseReview', NULL, '2026-01-30', '13:00:00', NULL, 60, 500.00, 'pending', 'pending', NULL, 'test', NULL, NULL, NULL, NULL, NULL, '2026-01-28 16:26:25', '2026-01-28 16:26:25', NULL, NULL, NULL),
(3, 'BK-697A5D1935652', 2, 3, 'App\\Models\\HorseReview', NULL, '2026-01-28', '16:00:00', NULL, 60, 1000.00, 'pending', 'pending', NULL, 'notes', NULL, NULL, NULL, NULL, NULL, '2026-01-28 17:01:45', '2026-01-28 17:01:45', NULL, NULL, NULL),
(4, 'BK-69A4D5CFE0D31', 5, 1, 'App\\Models\\Stable', NULL, '2026-03-03', '09:00:00', NULL, 240, 1200.00, 'pending', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-01 22:11:59', '2026-03-01 22:11:59', NULL, 'App\\Models\\StablePackage', 1),
(5, 'BK-69A4D61C1D946', 5, 1, 'App\\Models\\Stable', NULL, '2026-03-11', '09:00:00', NULL, 60, 0.00, 'pending', 'pending', NULL, 'test', NULL, NULL, NULL, NULL, NULL, '2026-03-01 22:13:16', '2026-03-01 22:13:16', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1772412412),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1772412412;', 1772412412),
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1772409999),
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1772409999;', 1772409999),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:0:{}s:11:\"permissions\";a:0:{}s:5:\"roles\";a:0:{}}', 1772473835);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `session_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'zUFn8Y3AbiWc1epQ5bFmMW9WUWGWStfOsMnXJUxN', '2026-01-29 12:31:59', '2026-01-29 12:31:59'),
(2, NULL, 'AK2zGTONTpFD80vNVNfylIODF4gLL4uchd81YQZA', '2026-03-01 15:41:38', '2026-03-01 15:41:38'),
(3, 1, NULL, '2026-03-01 15:53:06', '2026-03-01 15:53:06'),
(4, 5, NULL, '2026-03-01 16:31:44', '2026-03-01 16:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `options` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `options`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '[]', '2026-01-29 12:31:59', '2026-01-29 12:31:59'),
(2, 1, 4, 3, '[]', '2026-01-29 13:00:55', '2026-01-29 13:00:55'),
(3, 2, 3, 1, '[]', '2026-03-01 15:41:46', '2026-03-01 15:41:46'),
(7, 4, 1, 1, '[]', '2026-03-01 16:56:32', '2026-03-01 16:56:32'),
(8, 4, 3, 2, '[]', '2026-03-01 16:56:37', '2026-03-01 22:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `parent_id`, `type`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"معدات الخيل\", \"en\": \"Horse Equipment\"}', 'horse-equipment', NULL, NULL, NULL, 'product', 1, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(2, '{\"ar\": \"ملابس الفروسية\", \"en\": \"Riding Apparel\"}', 'riding-apparel', NULL, NULL, NULL, 'product', 2, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(3, '{\"ar\": \"أدوات العناية\", \"en\": \"Grooming Tools\"}', 'grooming-tools', NULL, NULL, NULL, 'product', 3, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(4, '{\"ar\": \"السروج\", \"en\": \"Saddles\"}', 'saddles', NULL, NULL, NULL, 'product', 4, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(5, '{\"ar\": \"اللجامات\", \"en\": \"Bridles\"}', 'bridles', NULL, NULL, NULL, 'product', 5, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(6, '{\"ar\": \"أعلاف ومكملات\", \"en\": \"Feed & Supplements\"}', 'feed-supplements', NULL, NULL, NULL, 'product', 6, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(7, '{\"ar\": \"خدمات طبية بيطرية\", \"en\": \"Veterinary Services\"}', 'veterinary-services', NULL, NULL, NULL, 'service', 7, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(8, '{\"ar\": \"تدريب الخيول\", \"en\": \"Horse Training\"}', 'horse-training', NULL, NULL, NULL, 'service', 8, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(9, '{\"ar\": \"تدريب الفرسان\", \"en\": \"Rider Training\"}', 'rider-training', NULL, NULL, NULL, 'service', 9, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(10, '{\"ar\": \"نقل الخيول\", \"en\": \"Horse Transport\"}', 'horse-transport', NULL, NULL, NULL, 'service', 10, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(11, '{\"ar\": \"خدمات التصوير\", \"en\": \"Photography Services\"}', 'photography', NULL, NULL, NULL, 'service', 11, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(12, '{\"ar\": \"صالون العناية\", \"en\": \"Grooming Salon\"}', 'grooming-salon', NULL, NULL, NULL, 'service', 12, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(13, '{\"ar\": \"تنظيم الفعاليات\", \"en\": \"Event Organization\"}', 'events', NULL, NULL, NULL, 'service', 13, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(14, '{\"ar\": \"تأمين الخيول\", \"en\": \"Horse Insurance\"}', 'insurance', NULL, NULL, NULL, 'service', 14, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(15, '{\"ar\": \"استشارات\", \"en\": \"Consultations\"}', 'consultations', NULL, NULL, NULL, 'service', 15, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(16, '{\"ar\": \"رحلات\", \"en\": \"Trips\"}', 'trips', NULL, NULL, NULL, 'service', 16, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(17, '{\"ar\": \"مدونات\", \"en\": \"Blogs\"}', 'blog', '{\"ar\": \"مقالات ومدونات متنوعة\", \"en\": \"Various articles and blogs\"}', NULL, NULL, 'blog', 1, 1, '2026-01-28 16:16:27', '2026-01-28 16:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'Kareem omar', 'dev.kareemomar@gmail.com', '01094976280', 'sub', 'test messages', NULL, '2026-03-01 22:45:42', '2026-03-01 22:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_one_id` bigint UNSIGNED NOT NULL,
  `user_two_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user_one_id`, `user_two_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-01-28 17:22:34', '2026-01-28 17:22:34'),
(2, 2, 3, '2026-01-28 19:19:21', '2026-01-28 19:19:21'),
(3, 2, 4, '2026-01-28 19:24:35', '2026-01-28 19:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `horses`
--

CREATE TABLE `horses` (
  `id` bigint UNSIGNED NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
  `stable_id` bigint UNSIGNED DEFAULT NULL,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `breed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(6,2) DEFAULT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `microchip_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `rent_price_per_day` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `disciplines` json DEFAULT NULL,
  `health_records` json DEFAULT NULL,
  `achievements` json DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pedigree` text COLLATE utf8mb4_unicode_ci,
  `is_for_sale` tinyint(1) NOT NULL DEFAULT '0',
  `is_for_rent` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `views_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `horses`
--

INSERT INTO `horses` (`id`, `owner_id`, `stable_id`, `name`, `description`, `breed`, `color`, `gender`, `birth_date`, `age`, `height`, `weight`, `registration_number`, `passport_number`, `microchip_number`, `price`, `rent_price_per_day`, `status`, `disciplines`, `health_records`, `achievements`, `father_name`, `mother_name`, `pedigree`, `is_for_sale`, `is_for_rent`, `is_featured`, `is_active`, `views_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, '{\"ar\": \"الحصان العربي 1\", \"en\": \"Arabian Horse 1\"}', NULL, 'عربي اصيل', 'بني', 'male', NULL, 6, NULL, NULL, NULL, NULL, NULL, 27998.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 3, '2026-01-28 16:16:56', '2026-03-01 16:51:24', NULL),
(2, 1, 4, '{\"ar\": \"الحصان العربي 2\", \"en\": \"Arabian Horse 2\"}', NULL, 'عربي اصيل', 'بني', 'female', NULL, 10, NULL, NULL, NULL, NULL, NULL, 45740.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 6, '2026-01-28 16:16:56', '2026-03-01 16:56:44', NULL),
(3, 1, 3, '{\"ar\": \"الحصان العربي 3\", \"en\": \"Arabian Horse 3\"}', NULL, 'عربي اصيل', 'بني', 'male', NULL, 9, NULL, NULL, NULL, NULL, NULL, 12825.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 0, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(4, 1, 5, '{\"ar\": \"الحصان العربي 4\", \"en\": \"Arabian Horse 4\"}', NULL, 'عربي اصيل', 'بني', 'female', NULL, 5, NULL, NULL, NULL, NULL, NULL, 32064.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 0, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(5, 1, 2, '{\"ar\": \"الحصان العربي 5\", \"en\": \"Arabian Horse 5\"}', NULL, 'عربي اصيل', 'بني', 'male', NULL, 8, NULL, NULL, NULL, NULL, NULL, 29481.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 0, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(6, 1, 5, '{\"ar\": \"الحصان العربي 6\", \"en\": \"Arabian Horse 6\"}', NULL, 'عربي اصيل', 'بني', 'female', NULL, 9, NULL, NULL, NULL, NULL, NULL, 25282.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 0, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(7, 1, 5, '{\"ar\": \"الحصان العربي 7\", \"en\": \"Arabian Horse 7\"}', NULL, 'عربي اصيل', 'بني', 'male', NULL, 7, NULL, NULL, NULL, NULL, NULL, 5559.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 0, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(8, 1, 5, '{\"ar\": \"الحصان العربي 8\", \"en\": \"Arabian Horse 8\"}', NULL, 'عربي اصيل', 'بني', 'female', NULL, 5, NULL, NULL, NULL, NULL, NULL, 8457.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 4, '2026-01-28 16:16:57', '2026-03-01 22:22:35', NULL),
(9, 5, NULL, '{\"ar\": \"حصان عربي اصيل\"}', '{\"ar\": \"حصان عربي اصيل حصان عربي اصيل\"}', 'عربي', 'اسود', 'male', '1998-01-11', NULL, NULL, NULL, NULL, NULL, NULL, 10000.00, NULL, 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 0, '2026-03-01 23:11:41', '2026-03-01 23:13:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"3a44fc8e-f113-4bf1-a8e0-b7eb5b3a9d86\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:1:{i:0;a:21:{s:4:\\\"name\\\";s:4:\\\"view\\\";s:5:\\\"color\\\";N;s:5:\\\"event\\\";N;s:9:\\\"eventData\\\";a:0:{}s:17:\\\"dispatchDirection\\\";b:0;s:19:\\\"dispatchToComponent\\\";N;s:15:\\\"extraAttributes\\\";a:0:{}s:4:\\\"icon\\\";N;s:12:\\\"iconPosition\\\";E:42:\\\"Filament\\\\Support\\\\Enums\\\\IconPosition:Before\\\";s:8:\\\"iconSize\\\";N;s:10:\\\"isOutlined\\\";b:0;s:10:\\\"isDisabled\\\";b:0;s:5:\\\"label\\\";s:17:\\\"عرض الحجز\\\";s:11:\\\"shouldClose\\\";b:0;s:16:\\\"shouldMarkAsRead\\\";b:0;s:18:\\\"shouldMarkAsUnread\\\";b:0;s:21:\\\"shouldOpenUrlInNewTab\\\";b:0;s:4:\\\"size\\\";E:39:\\\"Filament\\\\Support\\\\Enums\\\\ActionSize:Small\\\";s:7:\\\"tooltip\\\";N;s:3:\\\"url\\\";s:43:\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/bookings\\/1\\/edit\\\";s:4:\\\"view\\\";s:29:\\\"filament-actions::link-action\\\";}}s:4:\\\"body\\\";s:68:\\\"تم إنشاء حجز جديد بواسطة مسؤول النظام\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:23:\\\"heroicon-o-check-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:15:\\\"حجز جديد\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"5eecca42-c9c2-4f81-a482-6927167a718b\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"},\"createdAt\":1769624682,\"delay\":null}', 0, NULL, 1769624682, 1769624682),
(2, 'default', '{\"uuid\":\"24da6f23-38eb-4727-9799-dcc884f48c3d\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:1:{i:0;a:21:{s:4:\\\"name\\\";s:4:\\\"view\\\";s:5:\\\"color\\\";N;s:5:\\\"event\\\";N;s:9:\\\"eventData\\\";a:0:{}s:17:\\\"dispatchDirection\\\";b:0;s:19:\\\"dispatchToComponent\\\";N;s:15:\\\"extraAttributes\\\";a:0:{}s:4:\\\"icon\\\";N;s:12:\\\"iconPosition\\\";E:42:\\\"Filament\\\\Support\\\\Enums\\\\IconPosition:Before\\\";s:8:\\\"iconSize\\\";N;s:10:\\\"isOutlined\\\";b:0;s:10:\\\"isDisabled\\\";b:0;s:5:\\\"label\\\";s:17:\\\"عرض الحجز\\\";s:11:\\\"shouldClose\\\";b:0;s:16:\\\"shouldMarkAsRead\\\";b:0;s:18:\\\"shouldMarkAsUnread\\\";b:0;s:21:\\\"shouldOpenUrlInNewTab\\\";b:0;s:4:\\\"size\\\";E:39:\\\"Filament\\\\Support\\\\Enums\\\\ActionSize:Small\\\";s:7:\\\"tooltip\\\";N;s:3:\\\"url\\\";s:43:\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/bookings\\/2\\/edit\\\";s:4:\\\"view\\\";s:29:\\\"filament-actions::link-action\\\";}}s:4:\\\"body\\\";s:68:\\\"تم إنشاء حجز جديد بواسطة مسؤول النظام\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:23:\\\"heroicon-o-check-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:15:\\\"حجز جديد\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"c67332d2-768f-4aad-b7a0-817ad8375a1e\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"},\"createdAt\":1769624785,\"delay\":null}', 0, NULL, 1769624785, 1769624785),
(3, 'default', '{\"uuid\":\"7559f6e9-2a21-48c0-b463-54088f7380ba\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:1:{i:0;a:21:{s:4:\\\"name\\\";s:4:\\\"view\\\";s:5:\\\"color\\\";N;s:5:\\\"event\\\";N;s:9:\\\"eventData\\\";a:0:{}s:17:\\\"dispatchDirection\\\";b:0;s:19:\\\"dispatchToComponent\\\";N;s:15:\\\"extraAttributes\\\";a:0:{}s:4:\\\"icon\\\";N;s:12:\\\"iconPosition\\\";E:42:\\\"Filament\\\\Support\\\\Enums\\\\IconPosition:Before\\\";s:8:\\\"iconSize\\\";N;s:10:\\\"isOutlined\\\";b:0;s:10:\\\"isDisabled\\\";b:0;s:5:\\\"label\\\";s:17:\\\"عرض الحجز\\\";s:11:\\\"shouldClose\\\";b:0;s:16:\\\"shouldMarkAsRead\\\";b:0;s:18:\\\"shouldMarkAsUnread\\\";b:0;s:21:\\\"shouldOpenUrlInNewTab\\\";b:0;s:4:\\\"size\\\";E:39:\\\"Filament\\\\Support\\\\Enums\\\\ActionSize:Small\\\";s:7:\\\"tooltip\\\";N;s:3:\\\"url\\\";s:43:\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/bookings\\/3\\/edit\\\";s:4:\\\"view\\\";s:29:\\\"filament-actions::link-action\\\";}}s:4:\\\"body\\\";s:53:\\\"تم إنشاء حجز جديد بواسطة عميل\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:23:\\\"heroicon-o-check-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:15:\\\"حجز جديد\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"4fa5be75-0a9f-4b93-8142-386df4088a1c\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"},\"createdAt\":1769626905,\"delay\":null}', 0, NULL, 1769626905, 1769626905),
(4, 'default', '{\"uuid\":\"b9cb196c-f1f9-407e-94dd-351143ff5b2e\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:1:{i:0;a:21:{s:4:\\\"name\\\";s:4:\\\"view\\\";s:5:\\\"color\\\";N;s:5:\\\"event\\\";N;s:9:\\\"eventData\\\";a:0:{}s:17:\\\"dispatchDirection\\\";b:0;s:19:\\\"dispatchToComponent\\\";N;s:15:\\\"extraAttributes\\\";a:0:{}s:4:\\\"icon\\\";N;s:12:\\\"iconPosition\\\";E:42:\\\"Filament\\\\Support\\\\Enums\\\\IconPosition:Before\\\";s:8:\\\"iconSize\\\";N;s:10:\\\"isOutlined\\\";b:0;s:10:\\\"isDisabled\\\";b:0;s:5:\\\"label\\\";s:17:\\\"عرض الحجز\\\";s:11:\\\"shouldClose\\\";b:0;s:16:\\\"shouldMarkAsRead\\\";b:0;s:18:\\\"shouldMarkAsUnread\\\";b:0;s:21:\\\"shouldOpenUrlInNewTab\\\";b:0;s:4:\\\"size\\\";E:39:\\\"Filament\\\\Support\\\\Enums\\\\ActionSize:Small\\\";s:7:\\\"tooltip\\\";N;s:3:\\\"url\\\";s:43:\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/bookings\\/4\\/edit\\\";s:4:\\\"view\\\";s:29:\\\"filament-actions::link-action\\\";}}s:4:\\\"body\\\";s:56:\\\"تم إنشاء حجز جديد بواسطة Kareem omar\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:23:\\\"heroicon-o-check-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:15:\\\"حجز جديد\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"0cef061c-6583-4b26-bc44-076650be079a\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"},\"createdAt\":1772410319,\"delay\":null}', 0, NULL, 1772410319, 1772410319),
(5, 'default', '{\"uuid\":\"0782b83b-a917-4373-b926-68391f0f61e6\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:1:{i:0;a:21:{s:4:\\\"name\\\";s:4:\\\"view\\\";s:5:\\\"color\\\";N;s:5:\\\"event\\\";N;s:9:\\\"eventData\\\";a:0:{}s:17:\\\"dispatchDirection\\\";b:0;s:19:\\\"dispatchToComponent\\\";N;s:15:\\\"extraAttributes\\\";a:0:{}s:4:\\\"icon\\\";N;s:12:\\\"iconPosition\\\";E:42:\\\"Filament\\\\Support\\\\Enums\\\\IconPosition:Before\\\";s:8:\\\"iconSize\\\";N;s:10:\\\"isOutlined\\\";b:0;s:10:\\\"isDisabled\\\";b:0;s:5:\\\"label\\\";s:17:\\\"عرض الحجز\\\";s:11:\\\"shouldClose\\\";b:0;s:16:\\\"shouldMarkAsRead\\\";b:0;s:18:\\\"shouldMarkAsUnread\\\";b:0;s:21:\\\"shouldOpenUrlInNewTab\\\";b:0;s:4:\\\"size\\\";E:39:\\\"Filament\\\\Support\\\\Enums\\\\ActionSize:Small\\\";s:7:\\\"tooltip\\\";N;s:3:\\\"url\\\";s:43:\\\"http:\\/\\/127.0.0.1:8000\\/admin\\/bookings\\/5\\/edit\\\";s:4:\\\"view\\\";s:29:\\\"filament-actions::link-action\\\";}}s:4:\\\"body\\\";s:56:\\\"تم إنشاء حجز جديد بواسطة Kareem omar\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:23:\\\"heroicon-o-check-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:15:\\\"حجز جديد\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"f88617c3-d20d-4fd3-8590-16c6c365324b\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"},\"createdAt\":1772410396,\"delay\":null}', 0, NULL, 1772410396, 1772410396);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knights`
--

CREATE TABLE `knights` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL COMMENT 'translatable',
  `description` json DEFAULT NULL COMMENT 'translatable',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'رابط صفحة أو خارجي',
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `knights`
--

INSERT INTO `knights` (`id`, `name`, `description`, `slug`, `link`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"الفارس الاول\"}', '{\"ar\": \"الفارس الاول الفارس الاول الفارس الاول الفارس الاول الفارس الاول الفارس الاول الفارس الاول\"}', 'alfars-alaol', NULL, 0, 1, '2026-03-01 22:29:48', '2026-03-01 22:29:48'),
(2, '{\"ar\": \"الفارس الثاني\"}', '{\"ar\": \"الفارس الثاني\"}', 'alfars-althany', NULL, 0, 1, '2026-03-01 22:30:30', '2026-03-01 22:30:30'),
(3, '{\"ar\": \"الفارس الثالث\"}', '{\"ar\": \"الفارس الثالث. الفارس الثالث الفارس الثالثالفارس الثالث الفارس الثالث\"}', 'alfars-althalth', NULL, 0, 1, '2026-03-01 22:30:59', '2026-03-01 22:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(14, 'App\\Models\\Stable', 1, '6d68a5b6-07f1-4cde-8fa4-ee1859346f22', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:28', '2026-01-28 16:16:28'),
(15, 'App\\Models\\Stable', 2, 'cb229a86-c6ac-4634-abce-f1c04b94a18f', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:28', '2026-01-28 16:16:28'),
(16, 'App\\Models\\Stable', 3, 'e755a878-7964-445e-8180-c77403b5553a', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:28', '2026-01-28 16:16:28'),
(17, 'App\\Models\\Stable', 4, '618c6b76-8371-444d-b7b1-e7ba5d2b5963', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:28', '2026-01-28 16:16:28'),
(18, 'App\\Models\\Stable', 5, '95591204-e3f4-402c-ab7b-0c493890ed91', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:28', '2026-01-28 16:16:28'),
(19, 'App\\Models\\Stable', 6, 'b835b03e-a69c-4e57-a9f8-181ff8ddb63c', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:28', '2026-01-28 16:16:28'),
(20, 'App\\Models\\Blog', 1, '22798a1b-4ce5-4089-a6d4-ff4408652d0f', 'featured_image', '1', '1.webp', 'image/webp', 'public', 'public', 4644112, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(21, 'App\\Models\\Blog', 2, 'd0bcfd92-2e65-4e7e-b0f4-62cca7f79749', 'featured_image', '2', '2.webp', 'image/webp', 'public', 'public', 180534, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(22, 'App\\Models\\Blog', 3, '1f1d277e-fca8-4645-8208-abf7a42b0171', 'featured_image', '3', '3.webp', 'image/webp', 'public', 'public', 13256212, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(23, 'App\\Models\\Blog', 4, '181b8828-32b4-40ce-8419-ef5a8abe9633', 'featured_image', '4', '4.webp', 'image/webp', 'public', 'public', 12042060, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(24, 'App\\Models\\Blog', 5, '7d757e08-08d3-4e62-b556-aa3c6a1c8c11', 'featured_image', '5', '5.webp', 'image/webp', 'public', 'public', 11136886, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(25, 'App\\Models\\Blog', 6, '0a90c313-3689-4732-82ab-a995befbb744', 'featured_image', '6', '6.webp', 'image/webp', 'public', 'public', 15226222, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(26, 'App\\Models\\Banner', 1, '3cd6ecf1-8caa-4439-8dd9-7033e2a86675', 'image', 'banner1', 'banner1.svg', 'image/svg+xml', 'public', 'public', 7270481, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(27, 'App\\Models\\Banner', 2, '4ec9c493-8452-4c82-bba6-46b6a65b376e', 'image', 'banner2', 'banner2.svg', 'image/svg+xml', 'public', 'public', 6239935, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(28, 'App\\Models\\Banner', 3, '48f10e0c-6304-46d9-99d8-65b2a7c13862', 'image', 'banner3', 'banner3.svg', 'image/svg+xml', 'public', 'public', 8966357, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(29, 'App\\Models\\Slider', 1, 'f55dca39-9eaa-4c8a-807f-3485bfe91958', 'image', 'slider', 'slider.svg', 'image/svg+xml', 'public', 'public', 3894641, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(30, 'App\\Models\\Slider', 2, 'cf00a22d-06c1-4632-8fba-0c18ca623253', 'image', 'slider', 'slider.svg', 'image/svg+xml', 'public', 'public', 3894641, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(31, 'App\\Models\\Slider', 3, '28fa2dd3-24bd-472f-8f6c-b96a4a2169e2', 'image', 'slider', 'slider.svg', 'image/svg+xml', 'public', 'public', 3894641, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(32, 'App\\Models\\Slider', 4, '04ddefa2-e2fd-4946-88cc-8de0253ae270', 'image', 'slider', 'slider.svg', 'image/svg+xml', 'public', 'public', 3894641, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(33, 'App\\Models\\Stable', 1, '416c94d8-9da6-4872-a0c3-141bc97f0cdf', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(34, 'App\\Models\\Stable', 2, '55a66d03-12f6-4193-89c6-9ddbea3b79a3', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(35, 'App\\Models\\Stable', 3, 'c69ac42b-f087-460f-8899-765d2a3122c7', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(36, 'App\\Models\\Stable', 4, '02242772-75fb-47a5-b112-54eb03b7da77', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(37, 'App\\Models\\Stable', 5, '40481565-e723-4e85-9fe1-3786afcf7420', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(38, 'App\\Models\\Stable', 6, '78db636d-29fc-45ad-885a-aa328a66849f', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 10313464, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(39, 'App\\Models\\Horse', 1, '2e9eca55-7e28-444b-b5f5-86c93873573c', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 15195718, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(40, 'App\\Models\\Horse', 1, '45b92d8f-2711-477f-af1b-e54f0246e39c', 'gallery', '1', '1.webp', 'image/webp', 'public', 'public', 15195718, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(41, 'App\\Models\\Horse', 2, '89012058-ad5a-4049-8838-c0a5697edcad', 'main_image', '2', '2.webp', 'image/webp', 'public', 'public', 6227460, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(42, 'App\\Models\\Horse', 2, '583303cc-14f7-44b1-8da8-986655c651ee', 'gallery', '2', '2.webp', 'image/webp', 'public', 'public', 6227460, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(43, 'App\\Models\\Horse', 3, 'ca4142ee-43c2-4bc9-989e-e3874eddfe56', 'main_image', '3', '3.webp', 'image/webp', 'public', 'public', 10330040, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(44, 'App\\Models\\Horse', 3, '9c721578-afb6-4d19-b282-467938264593', 'gallery', '3', '3.webp', 'image/webp', 'public', 'public', 10330040, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(45, 'App\\Models\\Horse', 4, '3ba8cef2-6852-4298-a741-050755b390ac', 'main_image', '4', '4.webp', 'image/webp', 'public', 'public', 11006668, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(46, 'App\\Models\\Horse', 4, '175687af-b75b-4e40-8487-5c691c63cf4f', 'gallery', '4', '4.webp', 'image/webp', 'public', 'public', 11006668, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(47, 'App\\Models\\Horse', 5, '2b941bcb-8bf8-45b7-b635-596acc6ec915', 'main_image', '5', '5.webp', 'image/webp', 'public', 'public', 521258, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(48, 'App\\Models\\Horse', 5, '6624e24b-0ff8-4028-976e-c4bdf1390ade', 'gallery', '5', '5.webp', 'image/webp', 'public', 'public', 521258, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(49, 'App\\Models\\Horse', 6, '4b5667ba-ded2-41a2-a1f9-7feeb7403513', 'main_image', '6', '6.webp', 'image/webp', 'public', 'public', 9633562, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(50, 'App\\Models\\Horse', 6, 'e921f960-345c-4128-b5d8-6f9533165544', 'gallery', '6', '6.webp', 'image/webp', 'public', 'public', 9633562, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(51, 'App\\Models\\Horse', 7, 'f0ec6655-b13b-4bb7-9840-0f6c89ee9ae4', 'main_image', '7', '7.webp', 'image/webp', 'public', 'public', 11955644, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(52, 'App\\Models\\Horse', 7, 'ea4463d0-b685-41fa-b2c4-2936714fc45f', 'gallery', '7', '7.webp', 'image/webp', 'public', 'public', 11955644, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(53, 'App\\Models\\Horse', 8, '1d4ae6ec-c548-41ec-9595-988c504ece97', 'main_image', '8', '8.webp', 'image/webp', 'public', 'public', 540030, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(54, 'App\\Models\\Horse', 8, 'f78f4dcf-9256-4db2-8824-231f796c0879', 'gallery', '8', '8.webp', 'image/webp', 'public', 'public', 540030, '[]', '[]', '[]', '[]', 2, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(55, 'App\\Models\\Product', 1, 'ab9b7247-a9ce-4054-bbbd-2f4fa669b06d', 'main_image', '1', '1.webp', 'image/webp', 'public', 'public', 7599848, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(56, 'App\\Models\\Product', 2, '993bae18-14cf-449e-8b4f-51e24b47a744', 'main_image', '2', '2.webp', 'image/webp', 'public', 'public', 13524098, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(57, 'App\\Models\\Product', 3, 'c4ed19b8-0d22-48d3-99dc-9b695c1b8a1c', 'main_image', '3', '3.webp', 'image/webp', 'public', 'public', 14253620, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(58, 'App\\Models\\Product', 4, 'df2201db-6430-4eda-941b-a2c6be59d06b', 'main_image', '4', '4.webp', 'image/webp', 'public', 'public', 12042060, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(59, 'App\\Models\\Product', 5, 'c9a62532-e131-4e75-9c19-927c49561827', 'main_image', '5', '5.webp', 'image/webp', 'public', 'public', 13204718, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(60, 'App\\Models\\Product', 6, 'ace04b5e-c421-4767-87bc-aa9ba3375fd0', 'main_image', '6', '6.webp', 'image/webp', 'public', 'public', 15226222, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(61, 'App\\Models\\Product', 7, '517f0a7f-2e6e-4ca8-91f8-e795db717d2f', 'main_image', '7', '7.webp', 'image/webp', 'public', 'public', 14138518, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(62, 'App\\Models\\Product', 8, '34178b56-a4b1-41ac-b3cc-6f2133f71711', 'main_image', '8', '8.webp', 'image/webp', 'public', 'public', 5184536, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(63, 'App\\Models\\Sponsor', 1, '4dd2e79a-4908-4d30-8747-b03fff0da881', 'logo', '1', '1.webp', 'image/webp', 'public', 'public', 39126, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(64, 'App\\Models\\Sponsor', 2, 'a955350d-2f8e-40dd-8dd1-bbbe8fe6be9f', 'logo', '2', '2.webp', 'image/webp', 'public', 'public', 11400, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(65, 'App\\Models\\Sponsor', 3, '124c3676-130d-4451-b683-b7d228574193', 'logo', '3', '3.webp', 'image/webp', 'public', 'public', 16638, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(66, 'App\\Models\\Sponsor', 4, '2d27e98e-df17-4821-b570-c1edbe9d8798', 'logo', '4', '4.webp', 'image/webp', 'public', 'public', 17662, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(67, 'App\\Models\\Sponsor', 5, '8c10fd08-0d6a-41f1-bee6-cd85640725ae', 'logo', '5', '5.webp', 'image/webp', 'public', 'public', 4120, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(68, 'App\\Models\\Sponsor', 6, '37b97725-0970-44e5-9dd7-16c509666665', 'logo', '6', '6.webp', 'image/webp', 'public', 'public', 5040, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(69, 'App\\Models\\Photography', 1, 'e4b9aa42-fd7f-43c1-a9d1-177af2638a88', 'image', '3', '01KG2X8PMMCSHW9J9B3N6VNN6V.webp', 'image/webp', 'public', 'public', 11136886, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:18:48', '2026-01-28 16:18:48'),
(70, 'App\\Models\\Photography', 1, '2b53c0dd-d164-441b-be03-ed8b94e64973', 'gallery', '5', '01KG2X8PN9WZ510NW64F9GJZJN.webp', 'image/webp', 'public', 'public', 10330040, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:18:48', '2026-01-28 16:18:48'),
(71, 'App\\Models\\User', 1, 'f5ae6e41-3996-4ce2-b3b8-7eeaf3a7df88', 'avatar', 'dynamic-desert-scene-horseback-riding-across-sandy-terrain', 'dynamic-desert-scene-horseback-riding-across-sandy-terrain.webp', 'image/webp', 'public', 'public', 39320, '[]', '[]', '[]', '[]', 1, '2026-01-28 16:56:34', '2026-01-28 16:56:34'),
(72, 'App\\Models\\HorseReview', 3, '4f25440e-d9c0-4fbc-aa14-0523a398fcff', 'image', '6', '01KG302Q1FEYNBX7RJG6RPR2RR.jpg', 'image/webp', 'public', 'public', 215162, '[]', '[]', '[]', '[]', 1, '2026-01-28 17:07:58', '2026-01-28 17:07:58'),
(73, 'App\\Models\\Store', 1, '7007b5b1-02fe-4fae-af55-7cf19c2de833', 'gallery', 'dynamic-desert-scene-horseback-riding-across-sandy-terrain', '01KG3AEK5JAK06BJK7TRGCEPN1.webp', 'image/webp', 'public', 'public', 39320, '[]', '[]', '[]', '[]', 1, '2026-01-28 20:09:13', '2026-01-28 20:09:13'),
(74, 'App\\Models\\Store', 1, '5ccc8339-6ace-44d7-b31e-a6ad7bf23e6f', 'logo', 'dynamic-desert-scene-horseback-riding-across-sandy-terrain', '01KG3AHHZJD98SB3CWR3Y9KTF7.webp', 'image/webp', 'public', 'public', 39320, '[]', '[]', '[]', '[]', 2, '2026-01-28 20:10:50', '2026-01-28 20:10:50'),
(75, 'App\\Models\\Store', 1, '90f638d7-ea21-4de3-b09a-52e1e17e5edd', 'cover', 'dynamic-desert-scene-horseback-riding-across-sandy-terrain', '01KG3AHJ01V128WGJY4A5ZPEVW.webp', 'image/webp', 'public', 'public', 39320, '[]', '[]', '[]', '[]', 3, '2026-01-28 20:10:50', '2026-01-28 20:10:50'),
(76, 'App\\Models\\HorseReview', 1, 'ad8175cc-6dd8-418e-92a0-56233f9cdb8b', 'image', 'authentication', '01KG50TCKNZB4KKJ6VD327XY1S.jpg', 'image/webp', 'public', 'public', 135048, '[]', '[]', '[]', '[]', 1, '2026-01-29 11:59:23', '2026-01-29 11:59:23'),
(77, 'App\\Models\\HorseReview', 2, 'cac1907f-288e-4b72-b0f2-211633c760bf', 'image', 'banner', '01KG50TYW2ZCPJF4CMWTKKSQ0A.jpg', 'image/webp', 'public', 'public', 532784, '[]', '[]', '[]', '[]', 1, '2026-01-29 11:59:41', '2026-01-29 11:59:41'),
(78, 'App\\Models\\HorseReview', 4, '1427db2e-8d1f-4275-b631-87de64c06ed9', 'image', 'about-us', '01KG50VD92DKJ0SGAB08VHTKKN.jpg', 'image/webp', 'public', 'public', 192836, '[]', '[]', '[]', '[]', 1, '2026-01-29 11:59:56', '2026-01-29 11:59:56'),
(79, 'App\\Models\\Photography', 2, '3ab95c18-e8dd-42cb-8b47-b0cce9c19419', 'image', 'authentication', '01KG51BEBTZ9TPSXF9NSWGWA89.webp', 'image/webp', 'public', 'public', 5201034, '[]', '[]', '[]', '[]', 1, '2026-01-29 12:08:41', '2026-01-29 12:08:41'),
(80, 'App\\Models\\Stable', 1, 'eb8b524a-f7c4-4534-bba9-ad98071087de', 'cover', '3', '01KJNCWV4C9P3TMZH238RAQ0ZN.webp', 'image/webp', 'public', 'public', 10330040, '[]', '[]', '[]', '[]', 3, '2026-03-01 17:09:40', '2026-03-01 17:09:40'),
(81, 'App\\Models\\Stable', 1, 'b3816d83-cfaa-4733-ac6e-19f2c1c0e237', 'gallery', '9', '01KJNCWV6P7AG99MM8MJ35K75Z.webp', 'image/webp', 'public', 'public', 511806, '[]', '[]', '[]', '[]', 4, '2026-03-01 17:09:40', '2026-03-01 17:09:40'),
(82, 'App\\Models\\Stable', 1, '9a1a43ad-182f-423d-b814-6af5d5a84ef2', 'gallery', '2', '01KJNCXW5XA0YMNM7R4MM8FA0G.webp', 'image/webp', 'public', 'public', 6227460, '[]', '[]', '[]', '[]', 5, '2026-03-01 17:10:14', '2026-03-01 17:10:14'),
(83, 'App\\Models\\Stable', 1, 'ea66400c-c2e6-444e-a462-f30a30a337e0', 'gallery', '3', '01KJNCXW6C0YNN3YAA6MPSCANJ.webp', 'image/webp', 'public', 'public', 10330040, '[]', '[]', '[]', '[]', 6, '2026-03-01 17:10:14', '2026-03-01 17:10:14'),
(84, 'App\\Models\\Stable', 1, '6c8ffb16-51db-4093-9b25-8413ea5e4d37', 'gallery', '4', '01KJNCXW6ZZFBD771QD4PG0RNE.webp', 'image/webp', 'public', 'public', 11006668, '[]', '[]', '[]', '[]', 7, '2026-03-01 17:10:14', '2026-03-01 17:10:14'),
(85, 'App\\Models\\Knight', 1, '85d3f0a6-fa21-4a9f-aed3-0bcb345b196b', 'image', '9', '01KJNZ70855XD44GF1ADXWNE4C.webp', 'image/webp', 'public', 'public', 511806, '[]', '[]', '[]', '[]', 1, '2026-03-01 22:29:48', '2026-03-01 22:29:48'),
(86, 'App\\Models\\Knight', 2, '1777b386-d28e-4f3f-b55b-0edc87990454', 'image', '9', '01KJNZ89J61F3T1BZSANTC1Y90.webp', 'image/webp', 'public', 'public', 511806, '[]', '[]', '[]', '[]', 1, '2026-03-01 22:30:30', '2026-03-01 22:30:30'),
(87, 'App\\Models\\Knight', 3, 'a370a32b-0d16-43a5-901d-dcbec0247b11', 'image', '9', '01KJNZ95H71P1PS005XW6ZFQ26.webp', 'image/webp', 'public', 'public', 511806, '[]', '[]', '[]', '[]', 1, '2026-03-01 22:30:59', '2026-03-01 22:30:59'),
(88, 'App\\Models\\Horse', 9, 'a6ff35ba-0fc1-46a0-9069-d63570563534', 'main_image', '5', '5.webp', 'image/webp', 'public', 'public', 521258, '[]', '[]', '[]', '[]', 1, '2026-03-01 23:15:41', '2026-03-01 23:15:41'),
(89, 'App\\Models\\Horse', 9, '897f585a-86fe-40a8-b757-4b6fc70bf3c2', 'gallery', '5', '5.webp', 'image/webp', 'public', 'public', 521258, '[]', '[]', '[]', '[]', 2, '2026-03-01 23:15:56', '2026-03-01 23:15:56'),
(90, 'App\\Models\\Horse', 9, 'f122d4df-28ee-4958-b8fb-eca9b3e0657f', 'gallery', '8', '8.webp', 'image/webp', 'public', 'public', 540030, '[]', '[]', '[]', '[]', 3, '2026-03-01 23:15:56', '2026-03-01 23:15:56'),
(91, 'App\\Models\\Horse', 9, 'a820d55d-bca8-47c5-b8f5-a57c1116fae1', 'gallery', '9', '9.webp', 'image/webp', 'public', 'public', 511806, '[]', '[]', '[]', '[]', 4, '2026-03-01 23:15:56', '2026-03-01 23:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `conversation_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `content`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Hello! How can I help you today?', 1, '2026-01-28 17:12:34', '2026-03-01 15:57:56'),
(2, 1, 1, 'Hi, I have a question about my booking.', 1, '2026-01-28 17:17:34', '2026-01-28 17:23:06'),
(3, 1, 2, 'Sure, go ahead.', 1, '2026-01-28 17:21:34', '2026-03-01 15:57:56'),
(4, 1, 2, 'Totam ipsa ipsum du', 1, '2026-01-28 18:46:21', '2026-03-01 15:57:56'),
(5, 1, 2, 'Do dicta sunt vero l', 1, '2026-01-28 18:46:42', '2026-03-01 15:57:56'),
(6, 1, 2, 'Do dicta sunt vero l', 1, '2026-01-28 18:50:36', '2026-03-01 15:57:56'),
(7, 2, 2, 'Do dicta sunt vero l', 0, '2026-01-28 19:19:30', '2026-01-28 19:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_06_173552_create_permission_tables', 1),
(5, '2025_12_06_173553_create_media_table', 1),
(6, '2025_12_06_174920_create_personal_access_tokens_table', 1),
(7, '2025_12_06_180001_add_fields_to_users_table', 1),
(8, '2025_12_06_180002_create_categories_table', 1),
(9, '2025_12_06_180003_create_stables_table', 1),
(10, '2025_12_06_180004_create_stores_table', 1),
(11, '2025_12_06_180005_create_horses_table', 1),
(12, '2025_12_06_180006_create_products_table', 1),
(13, '2025_12_06_180008_create_trainers_table', 1),
(14, '2025_12_06_180009_create_veterinarians_table', 1),
(15, '2025_12_06_180010_create_orders_table', 1),
(16, '2025_12_06_180011_create_order_items_table', 1),
(17, '2025_12_06_180012_create_bookings_table', 1),
(18, '2025_12_06_180013_create_blogs_table', 1),
(19, '2025_12_06_180014_create_pages_table', 1),
(20, '2025_12_06_180015_create_sliders_table', 1),
(21, '2025_12_06_180016_create_sponsors_table', 1),
(22, '2025_12_06_180017_create_addresses_table', 1),
(23, '2025_12_06_180018_create_wallets_table', 1),
(24, '2025_12_06_180019_create_carts_table', 1),
(25, '2025_12_06_180020_create_wishlists_table', 1),
(26, '2026_01_14_134413_create_banners_table', 1),
(27, '2026_01_28_152751_create_horse_reviews_table', 2),
(28, '2026_01_28_172840_create_notifications_table', 2),
(29, '2026_01_28_173847_create_photographies_table', 2),
(30, '2026_01_28_173847_create_photography_packages_table', 2),
(31, '2026_01_28_184500_make_bookings_polymorphic', 2),
(32, '2026_01_28_182003_add_package_to_bookings_table', 3),
(33, '2026_01_28_184746_rename_name_to_title_in_horse_reviews_table', 4),
(34, '2026_01_28_191420_simplify_addresses_table', 5),
(35, '2026_01_28_191840_create_conversations_table', 6),
(36, '2026_01_28_191841_create_messages_table', 6),
(37, '2026_01_29_140421_rename_photographies_to_service_photographies_and_add_featured', 7),
(38, '2026_03_01_add_stable_type_to_stables_table', 8),
(39, '2026_03_01_create_stable_packages_table', 9),
(40, '2026_01_29_141242_add_slug_to_service_horse_reviews_table', 10),
(41, '2026_03_02_create_about_us_table', 11),
(42, '2026_03_02_120000_create_knights_table', 12),
(43, '2026_03_02_140000_create_contact_messages_table', 13),
(44, '2026_03_02_160000_create_site_settings_table', 14),
(45, '2026_03_02_170000_add_favicon_to_site_settings_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `store_id` bigint UNSIGNED DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` json DEFAULT NULL,
  `billing_address` json DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `paid_at` timestamp NULL DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `store_id`, `subtotal`, `discount`, `tax`, `shipping_cost`, `total`, `status`, `payment_status`, `payment_method`, `transaction_id`, `shipping_address`, `billing_address`, `notes`, `admin_notes`, `paid_at`, `shipped_at`, `delivered_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ORD-69A483F32EE57', 1, 1, 2000.00, 0.00, 300.00, 0.00, 2300.00, 'pending', 'pending', 'cod', NULL, '{\"id\": 1, \"city\": \"Est aut labore et su\", \"type\": \"Libero atque eligend\", \"state\": null, \"street\": \"22 Clarendon Avenue\", \"country\": \"Excepturi id non eni\", \"user_id\": 1, \"latitude\": null, \"longitude\": null, \"created_at\": \"2026-01-28T18:28:17.000000Z\", \"is_default\": false, \"updated_at\": \"2026-01-28T18:28:26.000000Z\", \"postal_code\": null}', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-01 16:22:43', '2026-03-01 16:22:43', NULL),
(2, 'ORD-69A4864243679', 5, 1, 1000.00, 0.00, 150.00, 0.00, 1150.00, 'pending', 'pending', 'cod', NULL, '{\"id\": 5, \"city\": \"رياض\", \"type\": \"المنزل\", \"state\": null, \"street\": \"المنزل ١١٢٩\", \"country\": \"المملكة العربية السعودية\", \"user_id\": 5, \"latitude\": null, \"longitude\": null, \"created_at\": \"2026-03-01T18:32:22.000000Z\", \"is_default\": true, \"updated_at\": \"2026-03-01T18:32:22.000000Z\", \"postal_code\": null}', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-01 16:32:34', '2026-03-01 16:32:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `options` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `options`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, 1000.00, 2000.00, '[]', '2026-03-01 16:22:43', '2026-03-01 16:22:43'),
(2, 2, 3, 1, 1000.00, 1000.00, '[]', '2026-03-01 16:32:34', '2026-03-01 16:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json NOT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `meta` json DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photography_packages`
--

CREATE TABLE `photography_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `photography_id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` json DEFAULT NULL,
  `features` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photography_packages`
--

INSERT INTO `photography_packages` (`id`, `photography_id`, `name`, `price`, `description`, `features`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"ar\": \"الباقة الأساسية\", \"en\": \"Basic Package\"}', 1000.00, '{\"ar\": \"باقة تشمل الأساسيات.\", \"en\": \"Package includes basics.\"}', '{\"ar\": [\"عدد 10 صور\", \"ساعة تصوير\"], \"en\": [\"10 Photos\", \"1 Hour Shooting\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(2, 1, '{\"ar\": \"الباقة المميزة\", \"en\": \"Premium Package\"}', 1500.00, '{\"ar\": \"باقة شاملة ومميزة.\", \"en\": \"Comprehensive premium package.\"}', '{\"ar\": [\"عدد 30 صور\", \"3 ساعات تصوير\", \"ألبوم\"], \"en\": [\"30 Photos\", \"3 Hours Shooting\", \"Album\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(3, 2, '{\"ar\": \"الباقة الأساسية\", \"en\": \"Basic Package\"}', 1500.00, '{\"ar\": \"باقة تشمل الأساسيات.\", \"en\": \"Package includes basics.\"}', '{\"ar\": [\"عدد 10 صور\", \"ساعة تصوير\"], \"en\": [\"10 Photos\", \"1 Hour Shooting\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(4, 2, '{\"ar\": \"الباقة المميزة\", \"en\": \"Premium Package\"}', 2250.00, '{\"ar\": \"باقة شاملة ومميزة.\", \"en\": \"Comprehensive premium package.\"}', '{\"ar\": [\"عدد 30 صور\", \"3 ساعات تصوير\", \"ألبوم\"], \"en\": [\"30 Photos\", \"3 Hours Shooting\", \"Album\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(5, 3, '{\"ar\": \"الباقة الأساسية\", \"en\": \"Basic Package\"}', 1200.00, '{\"ar\": \"باقة تشمل الأساسيات.\", \"en\": \"Package includes basics.\"}', '{\"ar\": [\"عدد 10 صور\", \"ساعة تصوير\"], \"en\": [\"10 Photos\", \"1 Hour Shooting\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(6, 3, '{\"ar\": \"الباقة المميزة\", \"en\": \"Premium Package\"}', 1800.00, '{\"ar\": \"باقة شاملة ومميزة.\", \"en\": \"Comprehensive premium package.\"}', '{\"ar\": [\"عدد 30 صور\", \"3 ساعات تصوير\", \"ألبوم\"], \"en\": [\"30 Photos\", \"3 Hours Shooting\", \"Album\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(7, 4, '{\"ar\": \"الباقة الأساسية\", \"en\": \"Basic Package\"}', 2000.00, '{\"ar\": \"باقة تشمل الأساسيات.\", \"en\": \"Package includes basics.\"}', '{\"ar\": [\"عدد 10 صور\", \"ساعة تصوير\"], \"en\": [\"10 Photos\", \"1 Hour Shooting\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(8, 4, '{\"ar\": \"الباقة المميزة\", \"en\": \"Premium Package\"}', 3000.00, '{\"ar\": \"باقة شاملة ومميزة.\", \"en\": \"Comprehensive premium package.\"}', '{\"ar\": [\"عدد 30 صور\", \"3 ساعات تصوير\", \"ألبوم\"], \"en\": [\"30 Photos\", \"3 Hours Shooting\", \"Album\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(9, 5, '{\"ar\": \"الباقة الأساسية\", \"en\": \"Basic Package\"}', 2500.00, '{\"ar\": \"باقة تشمل الأساسيات.\", \"en\": \"Package includes basics.\"}', '{\"ar\": [\"عدد 10 صور\", \"ساعة تصوير\"], \"en\": [\"10 Photos\", \"1 Hour Shooting\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(10, 5, '{\"ar\": \"الباقة المميزة\", \"en\": \"Premium Package\"}', 3750.00, '{\"ar\": \"باقة شاملة ومميزة.\", \"en\": \"Comprehensive premium package.\"}', '{\"ar\": [\"عدد 30 صور\", \"3 ساعات تصوير\", \"ألبوم\"], \"en\": [\"30 Photos\", \"3 Hours Shooting\", \"Album\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(11, 6, '{\"ar\": \"الباقة الأساسية\", \"en\": \"Basic Package\"}', 3000.00, '{\"ar\": \"باقة تشمل الأساسيات.\", \"en\": \"Package includes basics.\"}', '{\"ar\": [\"عدد 10 صور\", \"ساعة تصوير\"], \"en\": [\"10 Photos\", \"1 Hour Shooting\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(12, 6, '{\"ar\": \"الباقة المميزة\", \"en\": \"Premium Package\"}', 4500.00, '{\"ar\": \"باقة شاملة ومميزة.\", \"en\": \"Comprehensive premium package.\"}', '{\"ar\": [\"عدد 30 صور\", \"3 ساعات تصوير\", \"ألبوم\"], \"en\": [\"30 Photos\", \"3 Hours Shooting\", \"Album\"]}', '2026-01-28 16:16:57', '2026-01-28 16:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `store_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `low_stock_threshold` int NOT NULL DEFAULT '5',
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dimensions` json DEFAULT NULL,
  `attributes` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `track_inventory` tinyint(1) NOT NULL DEFAULT '1',
  `views_count` int NOT NULL DEFAULT '0',
  `sales_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `store_id`, `category_id`, `name`, `description`, `sku`, `price`, `compare_price`, `cost`, `stock`, `low_stock_threshold`, `weight`, `dimensions`, `attributes`, `is_active`, `is_featured`, `track_inventory`, `views_count`, `sales_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, '{\"ar\": \"اسم المنتج\", \"en\": \"Product Name\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا\", \"en\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\"}', '23dd2', 1000.00, 1800.00, NULL, 50, 5, NULL, NULL, '{\"sizes\": [\"34-XS\", \"36-S\", \"38-M\", \"40-L\", \"42-XL\", \"44-XXL\"], \"colors\": [\"#FAEBD7\", \"#F0FFFF\", \"#F5F5DC\", \"#000000\", \"#8A2BE2\", \"#A52A2A\", \"#DEB887\"]}', 1, 1, 1, 1, 0, '2026-01-28 16:16:57', '2026-01-29 12:51:01', NULL),
(2, 1, NULL, '{\"ar\": \"اسم المنتج\", \"en\": \"Product Name\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا\", \"en\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\"}', NULL, 1000.00, 1800.00, NULL, 50, 5, NULL, NULL, '{\"sizes\": [\"34-XS\", \"36-S\", \"38-M\", \"40-L\", \"42-XL\", \"44-XXL\"], \"colors\": [\"#FAEBD7\", \"#F0FFFF\", \"#F5F5DC\", \"#000000\", \"#8A2BE2\", \"#A52A2A\", \"#DEB887\"]}', 1, 1, 1, 10, 0, '2026-01-28 16:16:57', '2026-01-29 13:17:26', NULL),
(3, 1, NULL, '{\"ar\": \"اسم المنتج\", \"en\": \"Product Name\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا\", \"en\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\"}', NULL, 1000.00, 1800.00, NULL, 47, 5, NULL, NULL, '{\"sizes\": [\"34-XS\", \"36-S\", \"38-M\", \"40-L\", \"42-XL\", \"44-XXL\"], \"colors\": [\"#FAEBD7\", \"#F0FFFF\", \"#F5F5DC\", \"#000000\", \"#8A2BE2\", \"#A52A2A\", \"#DEB887\"]}', 1, 1, 1, 7, 3, '2026-01-28 16:16:57', '2026-03-01 16:32:34', NULL),
(4, 1, NULL, '{\"ar\": \"اسم المنتج\", \"en\": \"Product Name\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا\", \"en\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\"}', NULL, 1000.00, 1800.00, NULL, 50, 5, NULL, NULL, '{\"sizes\": [\"34-XS\", \"36-S\", \"38-M\", \"40-L\", \"42-XL\", \"44-XXL\"], \"colors\": [\"#FAEBD7\", \"#F0FFFF\", \"#F5F5DC\", \"#000000\", \"#8A2BE2\", \"#A52A2A\", \"#DEB887\"]}', 1, 1, 1, 3, 0, '2026-01-28 16:16:57', '2026-01-29 13:00:55', NULL),
(5, 1, NULL, '{\"ar\": \"اسم المنتج\", \"en\": \"Product Name\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا\", \"en\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\"}', NULL, 1000.00, 1800.00, NULL, 50, 5, NULL, NULL, '{\"sizes\": [\"34-XS\", \"36-S\", \"38-M\", \"40-L\", \"42-XL\", \"44-XXL\"], \"colors\": [\"#FAEBD7\", \"#F0FFFF\", \"#F5F5DC\", \"#000000\", \"#8A2BE2\", \"#A52A2A\", \"#DEB887\"]}', 1, 1, 1, 0, 0, '2026-01-28 16:16:57', '2026-01-29 12:51:01', NULL),
(6, 1, NULL, '{\"ar\": \"اسم المنتج\", \"en\": \"Product Name\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا\", \"en\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\"}', NULL, 1000.00, 1800.00, NULL, 50, 5, NULL, NULL, '{\"sizes\": [\"34-XS\", \"36-S\", \"38-M\", \"40-L\", \"42-XL\", \"44-XXL\"], \"colors\": [\"#FAEBD7\", \"#F0FFFF\", \"#F5F5DC\", \"#000000\", \"#8A2BE2\", \"#A52A2A\", \"#DEB887\"]}', 1, 1, 1, 0, 0, '2026-01-28 16:16:57', '2026-01-29 12:51:01', NULL),
(7, 1, NULL, '{\"ar\": \"اسم المنتج\", \"en\": \"Product Name\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا\", \"en\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\"}', NULL, 1000.00, 1800.00, NULL, 50, 5, NULL, NULL, '{\"sizes\": [\"34-XS\", \"36-S\", \"38-M\", \"40-L\", \"42-XL\", \"44-XXL\"], \"colors\": [\"#FAEBD7\", \"#F0FFFF\", \"#F5F5DC\", \"#000000\", \"#8A2BE2\", \"#A52A2A\", \"#DEB887\"]}', 1, 1, 1, 0, 0, '2026-01-28 16:16:57', '2026-01-29 12:51:01', NULL),
(8, 1, NULL, '{\"ar\": \"اسم المنتج\", \"en\": \"Product Name\"}', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا\", \"en\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\"}', NULL, 1000.00, 1800.00, NULL, 50, 5, NULL, NULL, '{\"sizes\": [\"34-XS\", \"36-S\", \"38-M\", \"40-L\", \"42-XL\", \"44-XXL\"], \"colors\": [\"#FAEBD7\", \"#F0FFFF\", \"#F5F5DC\", \"#000000\", \"#8A2BE2\", \"#A52A2A\", \"#DEB887\"]}', 1, 1, 1, 0, 0, '2026-01-28 16:16:57', '2026-01-29 12:51:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(2, 'admin', 'web', '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(3, 'horse_owner', 'web', '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(4, 'stable_owner', 'web', '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(5, 'store_owner', 'web', '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(6, 'trainer', 'web', '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(7, 'veterinarian', 'web', '2026-01-28 16:16:27', '2026-01-28 16:16:27'),
(8, 'customer', 'web', '2026-01-28 16:16:27', '2026-01-28 16:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_horse_reviews`
--

CREATE TABLE `service_horse_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` json NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `trainer_info` json DEFAULT NULL,
  `video_gallery` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_horse_reviews`
--

INSERT INTO `service_horse_reviews` (`id`, `title`, `slug`, `description`, `price`, `trainer_info`, `video_gallery`, `is_active`, `is_featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"ar\": \"استعراض الخيول العربية الأصيلة\", \"en\": \"Arabian Purebred Horse Show\"}', 'arabian-purebred-horse-show', '{\"ar\": \"لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نو برفوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور\", \"en\": \"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\"}', 1000.00, '{\"ar\": \"تعتبر تنظيم وإدارة الفعاليات الخاصة بالفروسية من المجالات الحيوية التي تجمع بين الشغف والاحترافية. تشمل هذه الفعاليات مسابقات متنوعة، مثل سباقات القفز وسباقات القدرة، التي تتطلب تخطيطًا دقيقًا وإعدادًا مسبقًا. بالإضافة إلى ذلك، تُقام معارض كبرى تعرض أحدث المعدات والتقنيات في عالم الفروسية، مما يوفر منصة مثالية للتواصل بين الفارس والمربين والمهتمين. يتطلب تنظيم هذه الفعاليات تنسيقًا محكمًا بين مختلف الأطراف، من المشاركين إلى الرعاة، لضمان تجربة مميزة للجميع.\", \"en\": \"<p>Organizing and managing equestrian events is a vital field combining passion and professionalism. These events include various competitions, such as show jumping and endurance races, which require careful planning and preparation. In addition, major exhibitions showcasing the latest equipment and technologies in the equestrian world provide an ideal platform for networking between riders, breeders, and enthusiasts.</p>\"}', '[{\"thumbnail\": null, \"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}, {\"thumbnail\": null, \"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}, {\"thumbnail\": null, \"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}, {\"thumbnail\": null, \"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}]', 1, 1, '2026-01-28 16:50:21', '2026-01-29 12:24:36', NULL),
(2, '{\"ar\": \"عرض خيل رقم 1\", \"en\": \"Horse Show #1\"}', 'horse-show-1', '{\"ar\": \"وصف مختصر...\", \"en\": \"<p>Short description...</p>\"}', 500.00, '{\"ar\": \"\"}', '[]', 1, 0, '2026-01-28 16:50:21', '2026-01-29 12:24:59', NULL),
(3, '{\"ar\": \"عرض خيل رقم 2\", \"en\": \"Horse Show #2\"}', 'Horse-Show-2', '{\"ar\": \"وصف مختصر...\", \"en\": \"<p>Short description...</p>\"}', 1000.00, '{\"ar\": \"\"}', '[]', 1, 0, '2026-01-28 16:50:21', '2026-01-29 12:25:15', NULL),
(4, '{\"ar\": \"عرض خيل رقم 3\", \"en\": \"Horse Show #3\"}', 'horse-show-3', '{\"ar\": \"وصف مختصر...\", \"en\": \"<p>Short description...</p>\"}', 1500.00, '{\"ar\": \"\"}', '[]', 1, 0, '2026-01-28 16:50:21', '2026-01-29 12:25:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_photographies`
--

CREATE TABLE `service_photographies` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` json DEFAULT NULL,
  `features` json DEFAULT NULL,
  `video_gallery` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_photographies`
--

INSERT INTO `service_photographies` (`id`, `title`, `slug`, `price`, `description`, `features`, `video_gallery`, `is_active`, `is_featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"ar\": \"التصوير الكلاسيكي\", \"en\": \"Classical Photography\"}', 'classical-photography', 1000.00, '{\"ar\": \"خدمة التصوير الكلاسيكي توفر تجربة فريدة لالتقاط صور فنية رائعة.\", \"en\": \"Classical photography service providing unique artistic photos.\"}', '{\"ar\": [], \"en\": \"\"}', '[{\"thumbnail\": \"services/videos/01KG2X8PKY6S56EA2F5FE5KBSM.webp\", \"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}, {\"thumbnail\": \"services/videos/01KG2X8PM6ZBP45Z4GYG78XFYQ.webp\", \"video_url\": \"https://www.youtube.com/watch?v=dQw4w9WgXcQ\"}]', 1, 1, '2026-01-28 16:16:57', '2026-01-29 12:08:21', NULL),
(2, '{\"ar\": \"التصوير حسب الطلب\", \"en\": \"Photography on Demand\"}', 'photography-on-demand', 1500.00, '{\"ar\": \"خدمة تصوير مخصصة حسب رغبة العميل واختياره للمكان والوقت.\", \"en\": \"Custom photography service based on client preference.\"}', '{\"ar\": [], \"en\": \"\"}', '[{\"thumbnail\": null, \"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}]', 1, 1, '2026-01-28 16:16:57', '2026-01-29 12:20:25', NULL),
(3, '{\"ar\": \"خدمات تصوير الخيل\", \"en\": \"Horse Photography\"}', 'horse-photography', 1200.00, '{\"ar\": \"التقاط صور احترافية للخيول تبرز جمالها وقوتها.\", \"en\": \"Professional horse photography highlighting beauty and strength.\"}', NULL, '[{\"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}, {\"video_url\": \"https://www.youtube.com/watch?v=dQw4w9WgXcQ\"}]', 1, 0, '2026-01-28 16:16:57', '2026-01-28 16:16:57', NULL),
(4, '{\"ar\": \"تصوير الفعاليات\", \"en\": \"Event Photography\"}', 'event-photography', 2000.00, '{\"ar\": \"تغطية شاملة للفعاليات والمناسبات بجودة عالية.\", \"en\": \"Comprehensive event coverage with high quality.\"}', NULL, '[{\"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}]', 1, 0, '2026-01-28 16:16:57', '2026-01-28 16:16:57', NULL),
(5, '{\"ar\": \"تصوير البطولات\", \"en\": \"Championship Photography\"}', 'championship-photography', 2500.00, '{\"ar\": \"توثيق لحظات البطولات والمنافسات الرياضية.\", \"en\": \"Documenting championship moments and sports competitions.\"}', NULL, '[{\"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}]', 1, 0, '2026-01-28 16:16:57', '2026-01-28 16:16:57', NULL),
(6, '{\"ar\": \"خدمات التصوير للفيديوهات\", \"en\": \"Video Services\"}', 'video-services', 3000.00, '{\"ar\": \"إنتاج فيديوهات احترافية للأفلام والفعاليات.\", \"en\": \"Professional video production for films and events.\"}', NULL, '[{\"video_url\": \"https://www.youtube.com/watch?v=Ok180YwX8yA\"}, {\"video_url\": \"https://www.youtube.com/watch?v=dQw4w9WgXcQ\"}, {\"video_url\": \"https://www.youtube.com/watch?v=jNQXAC9IVRw\"}]', 1, 0, '2026-01-28 16:16:57', '2026-01-28 16:16:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_tabs`
--

CREATE TABLE `service_tabs` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_variations`
--

CREATE TABLE `service_variations` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cqwUBwZQbyGtkwPnoUosF96c8shgl7quL0axdPQK', 5, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiSFBieVJjdGpRekdtVTB5MDRsRHdlQnRSVU5vbmdQejhPUVp1aUpqSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlL2hvcnNlcyI7czo1OiJyb3V0ZSI7czoxNDoicHJvZmlsZS5ob3JzZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6NjoibG9jYWxlIjtzOjI6ImFyIjtzOjE2OiJjb21wYXJlX3Byb2R1Y3RzIjthOjE6e2k6MDtzOjE6IjIiO31zOjE3OiJ3aXNobGlzdF9wcm9kdWN0cyI7YToxOntpOjA7czoxOiIyIjt9czoxNDoiY29tcGFyZV9ob3JzZXMiO2E6MTp7aTowO3M6MToiMSI7fX0=', 1772414175),
('t5WlGT40g1Dp37yjtORUA5k7Qk4PAJCLKxf58Fsp', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiN25YVE1ESFhjS2xSbEFkN1dWVUx1T2dQT1A3ejQ0eDJUZnhNZDhncSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vaG9yc2VzIjtzOjU6InJvdXRlIjtzOjM3OiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMuaG9yc2VzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJGQ3WGtXWUIwblFYMFBkckRxVVBOWWVaY0l0bzVBaFJDWFd6ek1wNlg2aUgvV0tVd3VzRlFtIjtzOjg6ImZpbGFtZW50IjthOjA6e319', 1772413951);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `contact_banner_heading` json DEFAULT NULL COMMENT 'عنوان بانر اتصل بنا ar/en',
  `contact_address` json DEFAULT NULL COMMENT 'عنوان الموقع أسطر متعددة ar/en',
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_hours` json DEFAULT NULL COMMENT 'ساعات العمل ar/en',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'مسار اللوجو',
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'مسار الفافيكون',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `contact_banner_heading`, `contact_address`, `contact_phone`, `contact_whatsapp`, `contact_email`, `working_hours`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"نتطلع إلى الاستماع إليك دائماً. تواصل معنا وسنكون سعداء بالإجابة على استفسارك\", \"en\": \"We look forward to hearing from you. Contact us and we will be happy to answer your inquiry\"}', '{\"ar\": \"المملكة العربية السعودية\\nالرياض، حي العليا\\nشارع الأمير محمد بن عبد العزيز\", \"en\": \"Kingdom of Saudi Arabia\\nRiyadh, Al Olaya District\\nPrince Mohammed bin Abdulaziz Street\"}', '+966500000003', '966500000000', 'info@knights.com', '{\"ar\": \"السبت - الخميس: 9:30 صباحاً - 9:00 مساءً\\nالجمعة: مغلق\", \"en\": \"Saturday - Thursday: 9:00 AM - 9:00 PM\\nFriday: Closed\"}', 'site/01KJP02MF0WRK081QRK2T9H28W.webp', 'site/01KJP04ETTVHBGQV7Z66BDH95V.webp', '2026-03-01 22:42:49', '2026-03-01 22:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `subtitle` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `image`, `mobile_image`, `link`, `button_text`, `order`, `is_active`, `starts_at`, `ends_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"عنوان السلايدر 1\", \"en\": \"Slider Title 1\"}', NULL, 'slider.svg', NULL, '#', NULL, 1, 1, NULL, NULL, '2026-01-28 16:16:55', '2026-01-28 16:16:55'),
(2, '{\"ar\": \"عنوان السلايدر 2\", \"en\": \"Slider Title 2\"}', NULL, 'slider.svg', NULL, '#', NULL, 2, 1, NULL, NULL, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(3, '{\"ar\": \"عنوان السلايدر 3\", \"en\": \"Slider Title 3\"}', NULL, 'slider.svg', NULL, '#', NULL, 3, 1, NULL, NULL, '2026-01-28 16:16:56', '2026-01-28 16:16:56'),
(4, '{\"ar\": \"عنوان السلايدر 4\", \"en\": \"Slider Title 4\"}', NULL, 'slider.svg', NULL, '#', NULL, 4, 1, NULL, NULL, '2026-01-28 16:16:56', '2026-01-28 16:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `name`, `logo`, `website`, `description`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Sponsor 1\"}', 'brands/1.webp', '#', NULL, 1, 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(2, '{\"en\":\"Sponsor 2\"}', 'brands/2.webp', '#', NULL, 2, 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(3, '{\"en\":\"Sponsor 3\"}', 'brands/3.webp', '#', NULL, 3, 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(4, '{\"en\":\"Sponsor 4\"}', 'brands/4.webp', '#', NULL, 4, 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(5, '{\"en\":\"Sponsor 5\"}', 'brands/5.webp', '#', NULL, 5, 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57'),
(6, '{\"en\":\"Sponsor 6\"}', 'brands/6.webp', '#', NULL, 6, 1, '2026-01-28 16:16:57', '2026-01-28 16:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `stables`
--

CREATE TABLE `stables` (
  `id` bigint UNSIGNED NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'نوع الإسطبل مثل: قفز، ركوب، إلخ',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `working_hours` json DEFAULT NULL,
  `facilities` json DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `reviews_count` int NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stables`
--

INSERT INTO `stables` (`id`, `owner_id`, `name`, `description`, `phone`, `email`, `website`, `address`, `city`, `country`, `stable_type`, `latitude`, `longitude`, `working_hours`, `facilities`, `capacity`, `rating`, `reviews_count`, `is_verified`, `is_active`, `is_featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '{\"ar\": \"اسطبل 1\", \"en\": \"Stable 1\"}', '{\"ar\": \"وصف للاسطبل رقم 1\", \"en\": \"Description for stable 1\"}', NULL, 'kareem.kotb@bevatel.com', NULL, 'Giza', 'giza', 'Egypt', NULL, 24.71360000, 46.67530000, NULL, NULL, NULL, 0.00, 0, 1, 1, 1, '2026-01-28 16:16:56', '2026-03-01 17:08:12', NULL),
(2, 1, '{\"ar\": \"اسطبل 2\", \"en\": \"Stable 2\"}', '{\"ar\": \"وصف للاسطبل رقم 2\", \"en\": \"Description for stable 2\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.71360000, 46.67530000, NULL, NULL, NULL, 0.00, 0, 0, 1, 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(3, 1, '{\"ar\": \"اسطبل 3\", \"en\": \"Stable 3\"}', '{\"ar\": \"وصف للاسطبل رقم 3\", \"en\": \"Description for stable 3\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.71360000, 46.67530000, NULL, NULL, NULL, 0.00, 0, 0, 1, 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(4, 1, '{\"ar\": \"اسطبل 4\", \"en\": \"Stable 4\"}', '{\"ar\": \"وصف للاسطبل رقم 4\", \"en\": \"Description for stable 4\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.71360000, 46.67530000, NULL, NULL, NULL, 0.00, 0, 0, 1, 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(5, 1, '{\"ar\": \"اسطبل 5\", \"en\": \"Stable 5\"}', '{\"ar\": \"وصف للاسطبل رقم 5\", \"en\": \"Description for stable 5\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.71360000, 46.67530000, NULL, NULL, NULL, 0.00, 0, 0, 1, 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL),
(6, 1, '{\"ar\": \"اسطبل 6\", \"en\": \"Stable 6\"}', '{\"ar\": \"وصف للاسطبل رقم 6\", \"en\": \"Description for stable 6\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.71360000, 46.67530000, NULL, NULL, NULL, 0.00, 0, 0, 1, 1, '2026-01-28 16:16:56', '2026-01-28 16:16:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stable_packages`
--

CREATE TABLE `stable_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `stable_id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL COMMENT 'translatable',
  `description` json DEFAULT NULL COMMENT 'translatable',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `features` json DEFAULT NULL COMMENT 'قائمة المزايا - مصفوفة نصوص',
  `is_recommended` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stable_packages`
--

INSERT INTO `stable_packages` (`id`, `stable_id`, `name`, `description`, `price`, `features`, `is_recommended`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"ar\": \"باقه ١\", \"en\": \"باقه ١\"}', '{\"ar\": \"باقه ١باقه ١باقه ١باقه ١باقه ١باقه ١باقه ١باقه ١باقه ١\", \"en\": \"باقه ١باقه ١باقه ١باقه ١باقه ١باقه ١باقه ١باقه ١باقه ١\"}', 1200.00, '[\"test\", \"test2\", \"test3\"]', 1, 1, 1, '2026-03-01 22:06:32', '2026-03-01 22:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint UNSIGNED NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `description` json DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `working_hours` json DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `reviews_count` int NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `owner_id`, `name`, `description`, `phone`, `email`, `website`, `address`, `city`, `country`, `latitude`, `longitude`, `working_hours`, `rating`, `reviews_count`, `is_verified`, `is_active`, `is_featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '{\"ar\": \"متجر افتراضي\", \"en\": \"Default Store\"}', '{\"ar\": \"نبذة عن المتجر - محلي\\nنوع المتجر : اكسسوارات\\nلوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور\", \"en\": \"\"}', '259863214', 'shop@gmail.com', NULL, 'العقاريه ٣ - شارع العليا العام - الرياض', 'رياض', 'Egypt', NULL, NULL, NULL, 0.00, 0, 1, 1, 1, '2026-01-28 16:16:57', '2026-01-29 12:38:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stable_id` bigint UNSIGNED DEFAULT NULL,
  `bio` json DEFAULT NULL,
  `specializations` json DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_expiry` date DEFAULT NULL,
  `experience_years` int DEFAULT NULL,
  `hourly_rate` decimal(10,2) DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `reviews_count` int NOT NULL DEFAULT '0',
  `students_count` int NOT NULL DEFAULT '0',
  `availability` json DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `bio` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `type`, `bio`, `avatar`, `is_active`, `email_verified_at`, `phone_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'مسؤول النظام', 'admin@knights.com', '01094976280', 'admin', 'test', NULL, 1, '2026-01-28 16:16:27', NULL, '$2y$12$d7XkWYB0nQX0PdrDqUPNYeZcIto5AhRCXWzzMp6X6iH/WKUwusFQm', NULL, '2026-01-28 16:16:27', '2026-01-28 16:29:03'),
(2, 'customer', 'customer@app.com', NULL, 'customer', NULL, NULL, 1, NULL, NULL, '$2y$12$8m7fZNJRk7jAO06mB/rv9.D5/Drl7vFJ.XuIEhepax/tvgtemjjkG', NULL, '2026-01-28 17:00:07', '2026-01-28 18:24:30'),
(3, 'horse owner', 'horse_owner@app.com', NULL, 'horse_owner', NULL, NULL, 1, NULL, NULL, '$2y$12$IBHbxkJGBIfSZ/4T0VhU6.t2G/30IyWpZ6fWgU4mHdaUxNNjTbcMO', NULL, '2026-01-28 18:23:41', '2026-01-28 18:23:45'),
(4, 'stable owner', 'stable_owner@app.com', NULL, 'stable_owner', NULL, NULL, 1, NULL, NULL, '$2y$12$pXZ0dlwEBa6A0mET.D239umexE5edb3Q4brt6V31wTO0rTF24.EPq', NULL, '2026-01-28 18:24:19', '2026-01-28 18:24:19'),
(5, 'Kareem omar', 'dev.kareemomar@gmail.com', '01094976280', 'customer', NULL, NULL, 1, NULL, NULL, '$2y$12$Daj10RotLk39EnMLygzqwekqkrWdyyff1dIe2d6C0amICIwZBlfe2', NULL, '2026-03-01 16:29:56', '2026-03-01 16:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `veterinarians`
--

CREATE TABLE `veterinarians` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bio` json DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_expiry` date DEFAULT NULL,
  `specializations` json DEFAULT NULL,
  `clinic_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clinic_address` text COLLATE utf8mb4_unicode_ci,
  `clinic_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_years` int DEFAULT NULL,
  `consultation_fee` decimal(10,2) DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `reviews_count` int NOT NULL DEFAULT '0',
  `availability` json DEFAULT NULL,
  `home_visits` tinyint(1) NOT NULL DEFAULT '0',
  `emergency_available` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SAR',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `currency`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 5, 0.00, 'SAR', 1, '2026-03-01 16:29:56', '2026-03-01 16:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `wallet_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `balance_after` decimal(12,2) NOT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` bigint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `wishlistable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wishlistable_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`),
  ADD KEY `blogs_author_id_foreign` (`author_id`),
  ADD KEY `blogs_category_id_foreign` (`category_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_booking_number_unique` (`booking_number`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_horse_id_foreign` (`horse_id`),
  ADD KEY `bookings_bookable_id_bookable_type_index` (`bookable_id`,`bookable_type`),
  ADD KEY `bookings_package_index` (`package_type`,`package_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `conversations_user_one_id_user_two_id_unique` (`user_one_id`,`user_two_id`),
  ADD KEY `conversations_user_two_id_foreign` (`user_two_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `horses`
--
ALTER TABLE `horses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horses_owner_id_foreign` (`owner_id`),
  ADD KEY `horses_stable_id_foreign` (`stable_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knights`
--
ALTER TABLE `knights`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `knights_slug_unique` (`slug`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_store_id_foreign` (`store_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `photography_packages`
--
ALTER TABLE `photography_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photography_packages_photography_id_foreign` (`photography_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_store_id_foreign` (`store_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `service_horse_reviews`
--
ALTER TABLE `service_horse_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_photographies`
--
ALTER TABLE `service_photographies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photographies_slug_unique` (`slug`);

--
-- Indexes for table `service_tabs`
--
ALTER TABLE `service_tabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_variations`
--
ALTER TABLE `service_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stables`
--
ALTER TABLE `stables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stables_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `stable_packages`
--
ALTER TABLE `stable_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stable_packages_stable_id_foreign` (`stable_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainers_user_id_foreign` (`user_id`),
  ADD KEY `trainers_stable_id_foreign` (`stable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `veterinarians`
--
ALTER TABLE `veterinarians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `veterinarians_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transactions_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_wishlistable_type_wishlistable_id_unique` (`user_id`,`wishlistable_type`,`wishlistable_id`),
  ADD KEY `wishlists_wishlistable_type_wishlistable_id_index` (`wishlistable_type`,`wishlistable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `horses`
--
ALTER TABLE `horses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `knights`
--
ALTER TABLE `knights`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photography_packages`
--
ALTER TABLE `photography_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service_horse_reviews`
--
ALTER TABLE `service_horse_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_photographies`
--
ALTER TABLE `service_photographies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_tabs`
--
ALTER TABLE `service_tabs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_variations`
--
ALTER TABLE `service_variations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stables`
--
ALTER TABLE `stables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stable_packages`
--
ALTER TABLE `stable_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `veterinarians`
--
ALTER TABLE `veterinarians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_horse_id_foreign` FOREIGN KEY (`horse_id`) REFERENCES `horses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_user_one_id_foreign` FOREIGN KEY (`user_one_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_user_two_id_foreign` FOREIGN KEY (`user_two_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `horses`
--
ALTER TABLE `horses`
  ADD CONSTRAINT `horses_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `horses_stable_id_foreign` FOREIGN KEY (`stable_id`) REFERENCES `stables` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photography_packages`
--
ALTER TABLE `photography_packages`
  ADD CONSTRAINT `photography_packages_photography_id_foreign` FOREIGN KEY (`photography_id`) REFERENCES `service_photographies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stables`
--
ALTER TABLE `stables`
  ADD CONSTRAINT `stables_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stable_packages`
--
ALTER TABLE `stable_packages`
  ADD CONSTRAINT `stable_packages_stable_id_foreign` FOREIGN KEY (`stable_id`) REFERENCES `stables` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainers`
--
ALTER TABLE `trainers`
  ADD CONSTRAINT `trainers_stable_id_foreign` FOREIGN KEY (`stable_id`) REFERENCES `stables` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trainers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `veterinarians`
--
ALTER TABLE `veterinarians`
  ADD CONSTRAINT `veterinarians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
