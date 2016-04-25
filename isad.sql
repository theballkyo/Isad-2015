-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2016 at 07:26 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isad_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `max_user` int(11) NOT NULL,
  `is_open` tinyint(1) NOT NULL,
  `type` int(11) NOT NULL,
  `on_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `img`, `price`, `max_user`, `is_open`, `type`, `on_day`, `start_at`, `end_at`, `start_time`, `end_time`, `created_at`, `updated_at`, `teacher_id`) VALUES
(1, 'Englist', 'English Course Test', '', 1500, 100, 1, 1, '[0,1,0,0,1,0,1]', '2016-04-22 17:00:00', '2016-04-29 17:00:00', '00:00:00', '00:00:00', '2016-04-14 07:36:59', '2016-04-22 21:12:43', 2),
(2, 'Python', 'Python', '', 99999, 1, 1, 2, '[1,1,1,1,1,1,1]', '2016-04-13 17:00:00', '2016-04-20 17:00:00', '09:00:00', '12:00:00', '2016-04-14 07:36:59', '2016-04-23 00:14:00', 2),
(37, 'C++', 'C every where', '', 5000, 10, 1, 1, '[0,0,0,1,1,0,0]', '2016-04-21 17:00:00', '2016-04-29 17:00:00', '10:00:00', '00:00:00', '2016-04-23 01:25:46', '2016-04-23 01:38:57', 2),
(38, '.Net', '.Net framework', '', 2700, 5, 1, 2, '[1,0,0,0,0,0,0]', '2016-04-26 17:00:00', '2016-05-06 17:00:00', '08:00:00', '00:00:00', '2016-04-23 01:29:46', '2016-04-23 01:39:49', 2),
(39, 'Ragnarok', 'Ragnarok online', 'C:\\xampp2\\tmp\\phpD86B.tmp', 200000, 1000, 1, 1, '[1,0,0,0,0,0,1]', '2016-04-22 17:00:00', '2016-06-29 17:00:00', '02:00:00', '10:00:00', '2016-04-23 01:34:30', '2016-04-23 01:34:30', 18);

-- --------------------------------------------------------

--
-- Table structure for table `course_room`
--

CREATE TABLE `course_room` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_room`
--

INSERT INTO `course_room` (`id`, `course_id`, `room_id`) VALUES
(1, 1, 1),
(9, 2, 1),
(16, 38, 1),
(2, 1, 2),
(10, 2, 2),
(14, 37, 2),
(17, 38, 2),
(11, 2, 3),
(15, 37, 3),
(18, 38, 3),
(19, 39, 3),
(12, 2, 4),
(20, 39, 4);

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

CREATE TABLE `enrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`id`, `user_id`, `course_id`, `status`) VALUES
(1, 1, 1, 3),
(4, 4, 2, 1),
(5, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`user_id`) VALUES
(3),
(17);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_09_104659_create_course', 1),
('2016_04_09_105404_create_rooms', 1),
('2016_04_09_110848_course_user_table', 1),
('2016_04_09_111938_create_payment', 1),
('2016_04_09_112207_create_course_room', 1),
('2016_04_09_121646_add_time_to_course', 1),
('2016_04_11_091942_seat', 1),
('2016_04_11_092409_add_room_type', 1),
('2016_04_11_093226_add_course_type', 1),
('2016_04_11_100202_create_seat_book', 1),
('2016_04_11_112827_add_teacher_to_course', 1),
('2016_04_11_112937_create_teachers', 1),
('2016_04_11_114451_add_img_to_course', 1),
('2016_04_14_065723_rename_course_user_to_enrolled', 1);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `enroll_id` int(10) UNSIGNED NOT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pay_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `enroll_id`, `bank`, `pay_time`, `img_name`, `note`, `status`, `created_at`) VALUES
(1, 1, '', '2016-04-15 10:30:36', '', '', 3, '2016-04-14 08:47:05'),
(2, 1, '', '2016-04-15 10:30:36', '', '', 2, '2016-04-14 14:06:21'),
(9, 1, 'asdasdasd', '2016-04-22 07:30:00', '2014-03-06_22.34.27.png', '', 2, '2016-04-21 07:33:08'),
(10, 1, 'asdasd', '2016-04-29 05:00:00', '2014-03-06_22.34.27.png', '', 2, '2016-04-21 07:34:08'),
(11, 1, 'asdsad', '2016-04-30 05:00:00', '12779155_1133649243341910_5591400392778422743_o.png', '', 2, '2016-04-21 07:35:38'),
(13, 1, 'asdasd', '2016-04-29 05:10:00', 'Capture2.PNG', '', 2, '2016-04-21 07:37:16'),
(14, 1, 'dasd', '2016-04-22 05:15:00', 'think_python_comp2.medium.png', '', 2, '2016-04-21 07:53:16'),
(15, 1, 'eqweqw', '2016-04-22 05:00:00', '12779155_1133649243341910_5591400392778422743_o.png', '', 2, '2016-04-21 07:53:39'),
(16, 1, 'zxczxc', '2016-04-22 05:00:00', '12779155_1133649243341910_5591400392778422743_o.png', '', 2, '2016-04-21 07:54:13'),
(26, 1, 'abc', '2016-04-23 08:05:00', '12779155_1133649243341910_5591400392778422743_o.png', '', 3, '2016-04-22 17:57:57'),
(27, 1, 'asdasd', '2016-04-23 05:00:00', '12779155_1133649243341910_5591400392778422743_o.png', '', 3, '2016-04-22 17:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_open` tinyint(1) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `is_open`, `type`, `created_at`, `updated_at`) VALUES
(1, '101', 1, 1, NULL, NULL),
(2, '102', 1, 2, NULL, NULL),
(3, 'TEST', 0, 0, '2016-04-22 18:27:50', '2016-04-22 18:27:50'),
(4, 'asdas', 0, 0, '2016-04-22 18:29:16', '2016-04-22 18:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(10) UNSIGNED NOT NULL,
  `pattern` text COLLATE utf8_unicode_ci NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `pattern`, `room_id`) VALUES
(1, '[''aaaaaaaaaaaa'',''aaaaaaaaaaaa'',''bbb__bbbc_c_'',''bbbbbbbbbb__'',''bbbbbbbbbbbb'',''cccccccccccc'']', 1),
(2, '[''aa_a_a_aa'',''aaaa_aaaaa'',''aaaaaaaaa'',''___aaa____'',''aaaaaaaaa'',''aaaaaaaaaa'',''aaaaaaaa'']', 2),
(3, '[''aaa'',''aaa'',''aaa'']', 3),
(4, '[''___a___'']', 4);

-- --------------------------------------------------------

--
-- Table structure for table `seat_book`
--

CREATE TABLE `seat_book` (
  `id` int(10) UNSIGNED NOT NULL,
  `enroll_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `seat_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seat_book`
--

INSERT INTO `seat_book` (`id`, `enroll_id`, `room_id`, `seat_name`) VALUES
(34, 1, 2, '4_5'),
(35, 5, 2, '4_6');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `school` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`user_id`, `school`, `level`) VALUES
(1, '', ''),
(4, '', ''),
(9, '', ''),
(11, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `prestige` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`user_id`, `prestige`) VALUES
(2, ''),
(18, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `birthday` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_card` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `profile_img`, `first_name`, `last_name`, `address`, `birthday`, `id_card`, `password`, `remember_token`, `created_at`, `updated_at`, `type`) VALUES
(1, 'student@ezdev.me', '', 'Student ABC', 'TEST', 'dwqeqweqwewqesadasdd', '2016-04-23 05:25:20', '1234567890111', '$2y$10$EDf3q0m71D.YcLj41z3qSezLRaz6xK.2DLdIn0Oi4J2MJqjlkVsSa', 'HAGfbIY9eE1HEcKlyVT91SFdLYG6hHMXflm2zYVQADWgpye6IK0YRQ4fNEhW', '2016-04-14 00:33:28', '2016-04-23 05:25:20', 1),
(2, 'teacher@ezdev.me', '', 'Teacher', 'TEST', '', '2016-04-23 05:23:11', '', '$2y$10$EDf3q0m71D.YcLj41z3qSezLRaz6xK.2DLdIn0Oi4J2MJqjlkVsSa', 'ypUO7uDvx0TQ8kS8iZm42KH5HYGHHaqsLCnvKNz07SnrSFNVnA7He6UEsHld', '2016-04-14 00:33:28', '2016-04-23 05:23:11', 3),
(3, 'manager@ezdev.me', '', 'Manager', 'TEST', '', '2016-04-23 05:24:22', '', '$2y$10$EDf3q0m71D.YcLj41z3qSezLRaz6xK.2DLdIn0Oi4J2MJqjlkVsSa', 'SyEIAfn9TaWoesJWlzmwlEYhpx4Kbu2qTV5ayilozv8IOD8j4Nwii74hlGbD', '2016-04-14 00:33:28', '2016-04-23 05:24:22', 2),
(4, 'student2@ezdev.me', '', 'Student2', 'TEST', '', '2016-04-22 08:40:57', '', '$2y$10$EDf3q0m71D.YcLj41z3qSezLRaz6xK.2DLdIn0Oi4J2MJqjlkVsSa', 'SPCdBIqutRjqOUN3pKnc6KYHPRb8JWZPYZo1h6aIC4HzUxJm7hDp0QKQx7Qx', '2016-04-14 00:33:28', '2016-04-22 08:40:57', 1),
(8, 'admin@ezdev.me', '', 'admin', 'admin', '', '2016-04-23 05:22:05', '1234567890123', '$2y$10$EDf3q0m71D.YcLj41z3qSezLRaz6xK.2DLdIn0Oi4J2MJqjlkVsSa', 'n54seHY6lGPfoRmPeCBnY2w8qHt0aL0Rbb8QrIep7NOtU5yUmbqR2nStWteG', NULL, '2016-04-23 05:22:05', 5),
(9, 'std3@ezdev.me', '', 'asdasd', 'wqeqwewq', 'wqeqweqwe', '2016-04-22 22:34:01', '1234560654', '$2y$10$tQZeH7/EHOqjBX3aJlPhL.XQNuQ0TkCapmR/tHqBHhPMgYhTL7J72', 'eqXhLOAdVNLkOuQF2fLzmmqEUGpkCFSWs7jJ7tvRrMzxal7d7n9AoSNwZ8s4', '2016-04-22 22:31:59', '2016-04-22 22:34:01', 1),
(11, 'abc@ezdev.me', '', 'abc', 'def', 'asdasdqweqw', '0000-00-00 00:00:00', '1234567890111', '123456', NULL, '2016-04-23 00:15:24', '2016-04-23 00:15:24', 1),
(17, 'wqe@ezdev.me', '', '1sad', 'asd123', '1sa23d132asd1', '2016-04-23 01:23:49', '1234567890111', '$2y$10$r564fVkzNSmfxZz.g028NecWKJMa8oBHlzRL2ea7rgZeLUqbEcC6G', 'Jg7dxCGwp366N7zYm9QTdMPZN4OgcNOItJgECPHDijoqAp3XUGnhMMCOo824', '2016-04-23 01:22:45', '2016-04-23 01:23:49', 2),
(18, 'rag@ezdev.me', '', 'Ragnarok', 'online', '4564085640', '0000-00-00 00:00:00', '1234567890000', '$2y$10$Aw3MT6dQOSG6RULMyiLHpuVcukzhQfgXdBg0nzCVLg4kw.sMquacG', NULL, '2016-04-23 01:33:45', '2016-04-23 01:33:45', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `course_room`
--
ALTER TABLE `course_room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_room_room_id_course_id_unique` (`room_id`,`course_id`),
  ADD KEY `course_room_course_id_foreign` (`course_id`);

--
-- Indexes for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_user_user_id_course_id_unique` (`user_id`,`course_id`),
  ADD KEY `course_user_course_id_foreign` (`course_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_course_user_id_foreign` (`enroll_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_title_unique` (`title`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_id` (`room_id`);

--
-- Indexes for table `seat_book`
--
ALTER TABLE `seat_book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enroll_id` (`enroll_id`,`seat_name`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`user_id`);

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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `course_room`
--
ALTER TABLE `course_room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `enrolls`
--
ALTER TABLE `enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `seat_book`
--
ALTER TABLE `seat_book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_room`
--
ALTER TABLE `course_room`
  ADD CONSTRAINT `course_room_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_room_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `user_id_fk2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `user_id_owner_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_course_user_id_foreign` FOREIGN KEY (`enroll_id`) REFERENCES `enrolls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seat_book`
--
ALTER TABLE `seat_book`
  ADD CONSTRAINT `room_id_fk` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seat_book_course_user_id_foreign` FOREIGN KEY (`enroll_id`) REFERENCES `enrolls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
