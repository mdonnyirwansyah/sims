-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2023 at 12:37 AM
-- Server version: 10.3.37-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `addressable_type` varchar(255) NOT NULL,
  `addressable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `address`, `email`, `phone`, `addressable_type`, `addressable_id`, `created_at`, `updated_at`) VALUES
(1, 'Pekanbaru', 'example@test.com', '082208977989', 'App\\Models\\User', 43, '2023-03-06 09:40:04', '2023-03-06 09:52:23'),
(2, 'Pekanbaru', 'example2@test.com', '082284240515', 'App\\Models\\User', 2, '2023-03-06 10:04:44', '2023-03-16 10:16:04'),
(7, 'Yogyakarta', NULL, '087899890921', 'App\\Models\\Family', 15, '2023-03-07 07:35:31', '2023-03-16 10:16:04'),
(8, 'Sleman', NULL, '082287980900', 'App\\Models\\Family', 17, '2023-03-07 07:38:11', '2023-03-16 10:16:04'),
(9, 'Pekanbaru', 'example3@test.com', '082208977988', 'App\\Models\\User', 1, '2023-03-08 09:05:21', '2023-03-08 09:06:00'),
(10, 'Pekanbaru', 'edmawati@gmail.com', '082208977987', 'App\\Models\\User', 50, '2023-03-09 10:19:49', '2023-03-09 10:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_year_id` bigint(20) UNSIGNED NOT NULL,
  `class` enum('X','XI','XII') NOT NULL,
  `name` varchar(255) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`id`, `school_year_id`, `class`, `name`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'X', 'X 1', 1, '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(2, 1, 'X', 'X 2', 2, '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(3, 1, 'X', 'X 3', 3, '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(4, 1, 'X', 'X 4', 4, '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(5, 1, 'X', 'X 5', 5, '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(6, 1, 'XI', 'XI IPA 1', 6, '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(7, 1, 'XI', 'XI IPA 2', 7, '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(8, 1, 'XI', 'XI IPA 3', 8, '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(9, 1, 'XI', 'XI IPS 1', 9, '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(10, 1, 'XI', 'XI IPS 2', 10, '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(11, 1, 'XII', 'XII IPS 1', 11, '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(12, 1, 'XII', 'XII IPS 2', 12, '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(13, 1, 'XII', 'XII IPS 3', 13, '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(14, 1, 'XII', 'XII IPA 1', 14, '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(15, 1, 'XII', 'XII IPA 2', 15, '2023-02-22 09:16:53', '2023-02-22 09:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `class_room_student`
--

CREATE TABLE `class_room_student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_room_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_room_student`
--

INSERT INTO `class_room_student` (`id`, `class_room_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 10, 1, '2023-02-22 10:47:56', '2023-02-22 10:47:56'),
(2, 10, 2, '2023-02-22 10:47:56', '2023-02-22 10:47:56'),
(3, 10, 3, '2023-02-22 10:47:56', '2023-02-22 10:47:56'),
(4, 10, 4, '2023-02-22 10:47:56', '2023-02-22 10:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Senin', '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(2, 'Selasa', '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(3, 'Rabu', '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(4, 'Kamis', '2023-02-22 09:16:53', '2023-02-22 09:16:53'),
(5, 'Jum\'at', '2023-02-22 09:16:53', '2023-02-22 09:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Father','Mother','Guardian') NOT NULL,
  `name` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`id`, `student_id`, `type`, `name`, `occupation`, `created_at`, `updated_at`) VALUES
(15, 1, 'Father', 'Budi', 'Petani', '2023-03-07 07:35:31', '2023-03-07 07:35:31'),
(16, 1, 'Mother', 'Ana', 'IRT', '2023-03-07 07:35:31', '2023-03-07 07:35:31'),
(17, 1, 'Guardian', 'Agus', 'Programmer', '2023-03-07 07:38:11', '2023-03-07 07:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `subjects_id` bigint(20) UNSIGNED NOT NULL,
  `value` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `report_id`, `subjects_id`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 80, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(2, 1, 2, 86, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(3, 1, 3, 90, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(4, 1, 4, 87, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(5, 1, 5, 85, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(6, 1, 6, 90, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(7, 1, 7, 87, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(8, 1, 8, 89, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(9, 1, 9, 82, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(10, 1, 10, 88, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(11, 1, 11, 83, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(12, 1, 12, 82, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(13, 1, 13, 92, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(14, 1, 14, 90, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(15, 1, 15, 88, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(16, 1, 16, 89, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(17, 2, 1, 89, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:56', '2023-02-22 11:26:56'),
(18, 2, 2, 89, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:56', '2023-02-22 11:26:56'),
(19, 2, 3, 88, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:56', '2023-02-22 11:26:56'),
(20, 2, 4, 80, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:56', '2023-02-22 11:26:56'),
(21, 2, 5, 90, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(22, 2, 6, 89, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(23, 2, 7, 86, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(24, 2, 8, 88, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(25, 2, 9, 90, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(26, 2, 10, 87, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(27, 2, 11, 88, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(28, 2, 12, 90, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(29, 2, 13, 92, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(30, 2, 14, 87, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(31, 2, 15, 89, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57'),
(32, 2, 16, 90, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas laboriosam qui repellendus deserunt, possimus pariatur beatae quia deleniti saepe cumque!', '2023-02-22 11:26:57', '2023-02-22 11:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_schedules`
--

CREATE TABLE `lesson_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_year_id` bigint(20) UNSIGNED NOT NULL,
  `semester` enum('1 (satu)','2 (dua)') NOT NULL,
  `class_room_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `subjects_id` bigint(20) UNSIGNED NOT NULL,
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_schedules`
--

INSERT INTO `lesson_schedules` (`id`, `school_year_id`, `semester`, `class_room_id`, `teacher_id`, `subjects_id`, `day_id`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 1, '2 (dua)', 10, 2, 1, 1, '08:00:00', '09:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(2, 1, '2 (dua)', 10, 3, 2, 1, '09:45:00', '12:00:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(3, 1, '2 (dua)', 10, 4, 3, 1, '12:45:00', '13:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(4, 1, '2 (dua)', 10, 5, 4, 1, '13:30:00', '15:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(5, 1, '2 (dua)', 10, 6, 5, 2, '08:00:00', '09:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(6, 1, '2 (dua)', 10, 7, 6, 2, '09:45:00', '12:00:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(7, 1, '2 (dua)', 10, 8, 7, 2, '12:45:00', '15:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(8, 1, '2 (dua)', 10, 9, 8, 3, '08:00:00', '09:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(9, 1, '2 (dua)', 10, 10, 9, 3, '09:45:00', '12:00:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(10, 1, '2 (dua)', 10, 11, 10, 3, '12:45:00', '15:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(11, 1, '2 (dua)', 10, 12, 11, 4, '08:00:00', '09:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(12, 1, '2 (dua)', 10, 13, 12, 4, '09:45:00', '12:00:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(13, 1, '2 (dua)', 10, 14, 13, 4, '12:45:00', '15:30:00', '2023-02-22 09:16:54', '2023-02-22 09:16:54'),
(14, 1, '2 (dua)', 10, 15, 14, 5, '08:00:00', '09:30:00', '2023-02-22 09:16:55', '2023-02-22 09:16:55'),
(15, 1, '2 (dua)', 10, 16, 15, 5, '09:45:00', '12:00:00', '2023-02-22 09:16:55', '2023-02-22 09:16:55'),
(16, 1, '2 (dua)', 10, 17, 16, 5, '12:45:00', '15:30:00', '2023-02-22 09:16:55', '2023-02-22 09:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `semester` enum('1 (satu)','2 (dua)') NOT NULL,
  `class_room_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Pengetahuan','Keterampilan') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `student_id`, `semester`, `class_room_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, '2 (dua)', 10, 'Pengetahuan', '2023-02-22 11:24:29', '2023-02-22 11:24:29'),
(2, 1, '2 (dua)', 10, 'Keterampilan', '2023-02-22 11:26:56', '2023-02-22 11:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` enum('Administrator','Teacher','Student') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2023-02-22 09:16:37', '2023-02-22 09:16:37'),
(2, 'Teacher', '2023-02-22 09:16:37', '2023-02-22 09:16:37'),
(3, 'Student', '2023-02-22 09:16:37', '2023-02-22 09:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022/2023', '1', '2023-02-22 09:16:51', '2023-02-22 10:48:45'),
(4, '2025/2026', '', '2023-02-22 10:12:29', '2023-02-22 10:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nisn` varchar(255) NOT NULL,
  `class_at` varchar(255) NOT NULL,
  `registered_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `nis`, `nisn`, `class_at`, `registered_at`, `created_at`, `updated_at`) VALUES
(1, 2, '48711', '15088415', 'X', '2020-06-05', '2023-02-22 09:16:38', '2023-02-22 09:16:38'),
(2, 3, '97855', '22658942', 'X', '2020-06-05', '2023-02-22 09:16:38', '2023-02-22 09:16:38'),
(3, 4, '31247', '45006636', 'X', '2020-06-05', '2023-02-22 09:16:39', '2023-02-22 09:16:39'),
(4, 5, '73508', '86987992', 'X', '2020-06-05', '2023-02-22 09:16:39', '2023-02-22 09:16:39'),
(8, 9, '22798', '70740689', 'X', '2020-06-05', '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(9, 10, '44313', '23904303', 'X', '2020-06-05', '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(10, 11, '40449', '12084473', 'X', '2020-06-05', '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(11, 12, '39406', '47827296', 'X', '2020-06-05', '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(12, 13, '60035', '12304118', 'X', '2020-06-05', '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(17, 18, '76537', '69187916', 'X', '2020-06-05', '2023-02-22 09:16:41', '2023-02-22 09:16:41'),
(20, 21, '68080', '44982929', 'X', '2020-06-05', '2023-02-22 09:16:42', '2023-02-22 09:16:42'),
(21, 22, '36145', '57364019', 'X', '2020-06-05', '2023-02-22 09:16:42', '2023-02-22 09:16:42'),
(22, 23, '59482', '27249909', 'X', '2020-06-05', '2023-02-22 09:16:42', '2023-02-22 09:16:42'),
(24, 25, '13108', '39490793', 'X', '2020-06-05', '2023-02-22 09:16:43', '2023-02-22 09:16:43'),
(26, 27, '95778', '28614664', 'X', '2020-06-05', '2023-02-22 09:16:43', '2023-02-22 09:16:43'),
(27, 28, '46986', '77945656', 'X', '2020-06-05', '2023-02-22 09:16:43', '2023-02-22 09:16:43'),
(28, 29, '45282', '35161996', 'X', '2020-06-05', '2023-02-22 09:16:44', '2023-02-22 09:16:44'),
(31, 32, '20377', '24947229', 'X', '2020-06-05', '2023-02-22 09:16:44', '2023-02-22 09:16:44'),
(35, 36, '93305', '23262720', 'X', '2020-06-05', '2023-02-22 09:16:45', '2023-02-22 09:16:45'),
(36, 37, '56141', '58466745', 'X', '2020-06-05', '2023-02-22 09:16:45', '2023-02-22 09:16:45'),
(37, 38, '31003', '56470282', 'X', '2020-06-05', '2023-02-22 09:16:46', '2023-02-22 09:16:46'),
(40, 41, '74489', '23950156', 'X', '2020-06-05', '2023-02-22 09:16:46', '2023-02-22 09:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `group` enum('Kelompok A (Umum)','Kelompok B (Umum)','Kelompok C (Peminatan)') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `group`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan Agama dan Budi Pekerti', 'Kelompok A (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(2, 'Pendidikan Pencasila dan Kewarganegaraan', 'Kelompok A (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(3, 'Bahasa Indonesia', 'Kelompok A (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(4, 'Matematika', 'Kelompok A (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(5, 'Sejarah Indonesia', 'Kelompok A (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(6, 'Bahasa Inggris', 'Kelompok A (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(7, 'Seni Budaya', 'Kelompok B (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(8, 'Pendidikan Jasmani, Olah Raga, dan Kesehatan', 'Kelompok B (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(9, 'Prakarya dan Kewirausahaan', 'Kelompok B (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(10, 'Budaya Melayu Riau', 'Kelompok B (Umum)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(11, 'Geografi', 'Kelompok C (Peminatan)', '2023-02-22 09:16:51', '2023-02-22 09:16:51'),
(12, 'Sejarah', 'Kelompok C (Peminatan)', '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(13, 'Sosiologi', 'Kelompok C (Peminatan)', '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(14, 'Ekonomi', 'Kelompok C (Peminatan)', '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(15, 'Biologi', 'Kelompok C (Peminatan)', '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(16, 'Kimia', 'Kelompok C (Peminatan)', '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(17, 'Matematika', 'Kelompok C (Peminatan)', '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(18, 'Fisika', 'Kelompok C (Peminatan)', '2023-02-22 09:16:52', '2023-02-22 09:16:52'),
(19, 'Bahasa dan Sastra Inggris', 'Kelompok C (Peminatan)', '2023-02-22 09:16:52', '2023-02-22 09:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `nip`, `education`, `created_at`, `updated_at`) VALUES
(1, 1, '11223344', 'S1 Pendidikan Matematika', '2023-02-22 09:16:38', '2023-03-07 08:58:49'),
(2, 42, '197312122003121001', '-', '2023-02-22 09:16:46', '2023-02-22 09:16:46'),
(3, 43, '197312122003121002', 'S1 Pendidikan Matematika', '2023-02-22 09:16:47', '2023-03-06 08:59:36'),
(4, 44, '197312122003121003', 'S1 Pendidikan Matematika', '2023-02-22 09:16:47', '2023-03-06 09:00:58'),
(5, 45, '197312122003121004', 'S1 Pendidikan Matematika', '2023-02-22 09:16:47', '2023-03-06 09:02:16'),
(6, 46, '197312122003121005', '-', '2023-02-22 09:16:47', '2023-02-22 09:16:47'),
(7, 47, '197312122003121006', '-', '2023-02-22 09:16:47', '2023-02-22 09:16:47'),
(8, 48, '197312122003121007', '-', '2023-02-22 09:16:48', '2023-02-22 09:16:48'),
(9, 49, '197312122003121008', '-', '2023-02-22 09:16:48', '2023-02-22 09:16:48'),
(10, 50, '197312122003121009', 'S1 Pendidikan Matematika', '2023-02-22 09:16:48', '2023-03-09 10:18:13'),
(11, 51, '197312122003121010', '-', '2023-02-22 09:16:48', '2023-02-22 09:16:48'),
(12, 52, '197312122003121011', '-', '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(13, 53, '197312122003121012', '-', '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(14, 54, '197312122003121013', '-', '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(15, 55, '197312122003121014', '-', '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(16, 56, '197312122003121015', '-', '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(17, 57, '197312122003121016', '-', '2023-02-22 09:16:50', '2023-02-22 09:16:50'),
(19, 59, '197312122003121018', '-', '2023-02-22 09:16:50', '2023-02-22 09:16:50'),
(20, 60, '197312122003121019', '-', '2023-02-22 09:16:50', '2023-02-22 09:16:50'),
(21, 61, '197312122003121020', '-', '2023-02-22 09:16:51', '2023-02-22 09:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `name`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, '11223344', 'Budi, S. Kom.', NULL, '$2y$10$qS2r3UHbFAE1bwN70d3y9uVKBsMyjIv92EfFuTtWqVQl.ioSrr8Yu', NULL, '2023-02-22 09:16:37', '2023-03-07 08:48:02'),
(2, 3, '15088415', 'Padmi Yolanda', NULL, '$2y$10$6QPGnVgAj20zzLz72LDQguBpAZfaQxJTaIT06XqHdSJ85AD6cD4BS', NULL, '2023-02-22 09:16:38', '2023-03-16 10:16:04'),
(3, 3, '22658942', 'Nova Uchita Wijayanti', NULL, '$2y$10$AsxAHqjo2oaKJZnakxjzE.toXpY.U0rComD1ihsu85cx0KZW.qh7e', NULL, '2023-02-22 09:16:38', '2023-02-22 09:16:38'),
(4, 3, '45006636', 'Gaduh Perkasa Prasasta', NULL, '$2y$10$hInVStVUS6O3wmXevTFJ.ue8mBsh5Af47Mj21XhoPfBCGwU59.ZEO', NULL, '2023-02-22 09:16:39', '2023-02-22 09:16:39'),
(5, 3, '86987992', 'Farhunnisa Salwa Farida', NULL, '$2y$10$J5J95GgfE.EZx3tELD8/5ur8CBfjbr3AtJF2xWfYoxDo19Krf54g.', NULL, '2023-02-22 09:16:39', '2023-02-22 09:16:39'),
(9, 3, '70740689', 'Gangsar Budiyanto', NULL, '$2y$10$E/pAC1Kv.9iqW.dZebeCPeT2fKppATqOJQR6uHTh48LxXr3khOWba', NULL, '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(10, 3, '23904303', 'Yahya Hasim Sihombing', NULL, '$2y$10$9qhJEml/FTTYjrM9mmDzZ.DzcjEi317W3T/KebSbG11lmF4KLqLhy', NULL, '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(11, 3, '12084473', 'Garda Winarno', NULL, '$2y$10$n3EvdEW1toIPJGVmq8cTZeC4ywJnGvu3rJCzEjQRi2w5bModaoIt.', NULL, '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(12, 3, '47827296', 'Endah Wulandari', NULL, '$2y$10$eWXjO1Kg/TsWNYbvVXK.buSf/1XIRELYFDfxFsNZ0fyvz6YzxzrKG', NULL, '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(13, 3, '12304118', 'Alika Nova Purnawati', NULL, '$2y$10$EZsO7mlbqMK5.XqxKaV3YumbmsP.J8NzMb/3iAvh6UPFCIhB0YbXK', NULL, '2023-02-22 09:16:40', '2023-02-22 09:16:40'),
(18, 3, '69187916', 'Silvia Sudiati', NULL, '$2y$10$MXWnvPb8jcDaWcvaqE.YC.udwAucaf8uF.NCr9kDhzwq4IRmnRjlW', NULL, '2023-02-22 09:16:41', '2023-02-22 09:16:41'),
(21, 3, '44982929', 'Yusuf Nardi Dabukke', NULL, '$2y$10$N0eTY6hWY.gEHpzALoaZ6e37PHQSU4A2VCx8d125IN4idg1ObJ//O', NULL, '2023-02-22 09:16:42', '2023-02-22 09:16:42'),
(22, 3, '57364019', 'Chelsea Palastri', NULL, '$2y$10$sGmld77yk0eAsj2zMcwSwuoLDQ4unlagea26hdHFEg503V8QADJG6', NULL, '2023-02-22 09:16:42', '2023-02-22 09:16:42'),
(23, 3, '27249909', 'Ifa Permata', NULL, '$2y$10$Nhmz.x4M42OSPEn.CCmmP.Ssv2HWap/pVYZD6Ttk75xrb7zrDJSHu', NULL, '2023-02-22 09:16:42', '2023-02-22 09:16:42'),
(25, 3, '39490793', 'Bagus Winarno', NULL, '$2y$10$oTKt49gC9ltvKwRVMyxHYewZl4IVttr2Tg/x9SJnjj8itjRhSXlgG', NULL, '2023-02-22 09:16:43', '2023-02-22 09:16:43'),
(27, 3, '28614664', 'Jarwadi Artawan Uwais', NULL, '$2y$10$aFT/5wHEw/zj1bnUhYozFuUJikvlhETJCY90cxdIaBxqAisKQhriK', NULL, '2023-02-22 09:16:43', '2023-02-22 09:16:43'),
(28, 3, '77945656', 'Restu Humaira Laksita', NULL, '$2y$10$YLteI6NzgdPGw3XmHmr.a.zSDpmjyTXWSaFU85.NdgivUlid7uK6K', NULL, '2023-02-22 09:16:43', '2023-02-22 09:16:43'),
(29, 3, '35161996', 'Laksana Luwar Santoso', NULL, '$2y$10$F9YYo1XeMsiKSwNCBmnjG.hj/TjdRqLS/c5HO9LgAu7b89M4HZIcK', NULL, '2023-02-22 09:16:44', '2023-02-22 09:16:44'),
(32, 3, '24947229', 'Adhiarja Nashiruddin', NULL, '$2y$10$2b/fTzSvfwfgRRHftUDQgePz3tc0jO9adHxUJrftAniMo0D0XsPUS', NULL, '2023-02-22 09:16:44', '2023-02-22 09:16:44'),
(36, 3, '23262720', 'Mujur Wahyudin', NULL, '$2y$10$Dcda1MLOyvH6H1Nb5QglUOYG/IIkbmX1D.qaGn/2/r/N7GgPE6cPq', NULL, '2023-02-22 09:16:45', '2023-02-22 09:16:45'),
(37, 3, '58466745', 'Sari Utami', NULL, '$2y$10$9cWNz7rBs8.jOoiVubazY.NzqJlNbPACH3N/Kf5lK.MbOqBInjKNO', NULL, '2023-02-22 09:16:45', '2023-02-22 09:16:45'),
(38, 3, '56470282', 'Lasmono Pradipta', NULL, '$2y$10$ptAEBbJGwPyA.M7Hl01wKePm7rQRFXoLfwmHB8UY8Bkm5h6.yrJAS', NULL, '2023-02-22 09:16:45', '2023-02-22 09:16:45'),
(41, 3, '23950156', 'Ikin Kayun Mustofa', NULL, '$2y$10$XTwQRZxArZWNklIuFNhlLugbvcYEEJja6GF0m7126ZgWU7GPFJBS2', NULL, '2023-02-22 09:16:46', '2023-02-22 09:16:46'),
(42, 2, '197312122003121001', 'Thomas Abiansah, M. Pd.', NULL, '$2y$10$/OfOv7q21RssM.kHVm7w/.31uanFyU9Rbixmki1kGx0BO6MKnSy36', NULL, '2023-02-22 09:16:46', '2023-03-04 21:00:44'),
(43, 2, '197312122003121002', 'Fitri Handayani, S. Pd.', NULL, '$2y$10$sXOyPKaBWqFPP.2C/F8XFO7yZBApDAQy60gdnoYzYSP5z.5wfRUaa', NULL, '2023-02-22 09:16:47', '2023-03-06 09:52:23'),
(44, 2, '197312122003121003', 'Rifa Suryasi, S. Pd.', NULL, '$2y$10$N2ZFJBG1zNQIdNqjGc3HOeMcjH4ianU8awwgDXYw6RwIMghqcXaGy', NULL, '2023-02-22 09:16:47', '2023-03-06 09:00:58'),
(45, 2, '197312122003121004', 'Rahmawati, S. Pd.', NULL, '$2y$10$j3e89lOTEyVj6kqc0WNuaOuYTiaz8mT7aE11WJsB.drwMulDGy3z.', NULL, '2023-02-22 09:16:47', '2023-03-06 09:02:16'),
(46, 2, '197312122003121005', 'Rifa\'i, S. Pd.', NULL, '$2y$10$/NVpi1yk4TheHW7Fvo.QGOI9xRPp/IpEYTkxTg/J7g69JuivBrMEu', NULL, '2023-02-22 09:16:47', '2023-02-22 09:16:47'),
(47, 2, '197312122003121006', 'Mislinawati, S. Pd.', NULL, '$2y$10$EnHlptXM8oYufFF/hqRW0ef2mTOIgstwncCc4tAAZFj0q7UWz6tSG', NULL, '2023-02-22 09:16:47', '2023-02-22 09:16:47'),
(48, 2, '197312122003121007', 'Sri Wahyuni, S. Pd.', NULL, '$2y$10$15WPZQEDrSmdWNGZtTltM.p3bQrnzxwOWZ.9M/LvPFfq7p0d/1JQq', NULL, '2023-02-22 09:16:48', '2023-02-22 09:16:48'),
(49, 2, '197312122003121008', 'Yossi Media Feri S, S. Pd.', NULL, '$2y$10$R2GqoQeJ6AetFQZHVw648.8.qziJ1GLB6Rds1OEgVgvhsDte3aDpW', NULL, '2023-02-22 09:16:48', '2023-02-22 09:16:48'),
(50, 2, '197312122003121009', 'Edmawati, S. Sos.', NULL, '$2y$10$MZ02UvG9a7F62bePdzKrGex6qlqxA9I3XqM4xWEZPJltNIxvLbcY.', NULL, '2023-02-22 09:16:48', '2023-02-22 09:16:48'),
(51, 2, '197312122003121010', 'Risna Vondewi, S. Kom.', NULL, '$2y$10$nSTwedFbi7C8J.UoSnG5V.6O0uoB/515EV38RhAQo2ASc5IMT6Kl2', NULL, '2023-02-22 09:16:48', '2023-02-22 09:16:48'),
(52, 2, '197312122003121011', 'Eci Suryani, S. Pd.', NULL, '$2y$10$NMljPOQ7paf0Qo8TwUbGneb0l1qOuwaHncFp14ZYbxWPTwG.D1dDe', NULL, '2023-02-22 09:16:48', '2023-02-22 09:16:48'),
(53, 2, '197312122003121012', 'Peni Novia P, S. Pd.', NULL, '$2y$10$jJL7.Sr.XwHM9pkYn7.x/OrPwOiGGHk9ByI86m.e47QH6GrgDRIcu', NULL, '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(54, 2, '197312122003121013', 'Rita Erdat, S. Pd.', NULL, '$2y$10$hu0Ew65BjE5VLz8zAVakQeMw/D1pnYt5TpiHh4DP2/Id6X/hBEXHC', NULL, '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(55, 2, '197312122003121014', 'Riska Firmanila, S. Pd.', NULL, '$2y$10$T1ITipwcVK6.DALLfT0xxerBkF6sJRRlZv5P2wRqcpoS6n22m8s9.', NULL, '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(56, 2, '197312122003121015', 'Nurfitri, S. Pd.', NULL, '$2y$10$TkHLQwpqS7Qq6afRYciPNeX7KQ0xtfjDD18oLC5RIpuz1qCShakdq', NULL, '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(57, 2, '197312122003121016', 'Anita Linda Julita S, S. Pd.', NULL, '$2y$10$fSL9vZyjXMGyTDuxRQZuSeq980Thd8ispte1E.mqC506F96CuwiQu', NULL, '2023-02-22 09:16:49', '2023-02-22 09:16:49'),
(59, 2, '197312122003121018', 'Lela Fetriani, S. Sos.', NULL, '$2y$10$tgtw1jHB/PYlMZB1CE.mT.qTCVvmW.4Y5w6cZG1zE3Y8B/BZhmWt2', NULL, '2023-02-22 09:16:50', '2023-02-22 09:16:50'),
(60, 2, '197312122003121019', 'Sri Puja Astuti, S. Pd.', NULL, '$2y$10$DmIsxG165SUldC7b9v5/wugUJF2ahDGNNqQa4fm3.7mEKY8Eq7WCC', NULL, '2023-02-22 09:16:50', '2023-02-22 09:16:50'),
(61, 2, '197312122003121020', 'Seria BR Sitepu, S. S.', NULL, '$2y$10$iQdE4fSf6h83fLK6R5b.NOR1MVnqGiPAmHFseqOlfXKzu0X6xHivu', NULL, '2023-02-22 09:16:51', '2023-02-22 09:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `religion` enum('Islam','Kristen','Hindu','Budha','Katolik','Kong Hu Chu') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `place_of_birth`, `date_of_birth`, `gender`, `religion`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 43, 'Pekanbaru', '2023-03-01', 'Female', 'Islam', NULL, '2023-03-06 09:40:04', '2023-03-06 09:52:23'),
(2, 2, 'Pekanbaru', '2023-03-01', 'Female', 'Islam', NULL, '2023-03-06 10:04:44', '2023-03-16 10:16:04'),
(3, 1, 'Pekanbaru', '2023-03-01', 'Male', 'Kong Hu Chu', NULL, '2023-03-07 08:47:37', '2023-03-07 08:58:49'),
(4, 50, 'Pekanbaru', '1997-01-08', 'Female', 'Islam', NULL, '2023-03-09 10:18:13', '2023-03-09 10:18:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `addresses_phone_unique` (`phone`),
  ADD UNIQUE KEY `addresses_email_unique` (`email`),
  ADD KEY `addresses_addressable_type_addressable_id_index` (`addressable_type`,`addressable_id`);

--
-- Indexes for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_rooms_school_year_id_foreign` (`school_year_id`),
  ADD KEY `class_rooms_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `class_room_student`
--
ALTER TABLE `class_room_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_room_student_class_room_id_foreign` (`class_room_id`),
  ADD KEY `class_room_student_student_id_foreign` (`student_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`id`),
  ADD KEY `families_student_id_foreign` (`student_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_report_id_foreign` (`report_id`),
  ADD KEY `grades_subjects_id_foreign` (`subjects_id`);

--
-- Indexes for table `lesson_schedules`
--
ALTER TABLE `lesson_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_schedules_school_year_id_foreign` (`school_year_id`),
  ADD KEY `lesson_schedules_class_room_id_foreign` (`class_room_id`),
  ADD KEY `lesson_schedules_teacher_id_foreign` (`teacher_id`),
  ADD KEY `lesson_schedules_subjects_id_foreign` (`subjects_id`),
  ADD KEY `lesson_schedules_day_id_foreign` (`day_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_student_id_foreign` (`student_id`),
  ADD KEY `reports_class_room_id_foreign` (`class_room_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_years_name_unique` (`name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_nis_unique` (`nis`),
  ADD UNIQUE KEY `students_nisn_unique` (`nisn`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_nip_unique` (`nip`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `class_room_student`
--
ALTER TABLE `class_room_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lesson_schedules`
--
ALTER TABLE `lesson_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD CONSTRAINT `class_rooms_school_year_id_foreign` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_rooms_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_room_student`
--
ALTER TABLE `class_room_student`
  ADD CONSTRAINT `class_room_student_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_room_student_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `families`
--
ALTER TABLE `families`
  ADD CONSTRAINT `families_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_subjects_id_foreign` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_schedules`
--
ALTER TABLE `lesson_schedules`
  ADD CONSTRAINT `lesson_schedules_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_schedules_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_schedules_school_year_id_foreign` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_schedules_subjects_id_foreign` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_schedules_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
