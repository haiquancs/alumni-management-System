-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 26, 2018 lúc 04:25 AM
-- Phiên bản máy phục vụ: 10.1.35-MariaDB
-- Phiên bản PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `alumni`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `business`
--

CREATE TABLE `business` (
  `id` int(10) UNSIGNED NOT NULL,
  `business` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Exp:  Khoa học máy tính, Công nghệ thông tin, ...',
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `business`
--

INSERT INTO `business` (`id`, `business`, `created_id`, `updated_id`, `deleted_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Công nghệ thông tin', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Khoa học máy tính', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Hệ thống thông tin', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Truyền thông và mạng máy tính', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Kỹ thuật phần mềm', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Công nghệ kỹ thuật cơ điện tử', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Công nghệ kỹ thuật điện tử, truyền thông', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Cơ kỹ thuật', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Kỹ thuật máy tính', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Kỹ thuật điều khiển và tự động hóa', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Vật lý kỹ thuật', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Kỹ thuật năng lượng', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Công nghệ vũ trụ', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Kỹ thuật sinh học', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_users`
--

CREATE TABLE `job_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `job` tinyint(3) UNSIGNED NOT NULL COMMENT '1: Có việc 2: Chưa có việc',
  `name_job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll_job_id` int(11) DEFAULT NULL,
  `type_company_detail_id` int(11) DEFAULT NULL,
  `traning` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduce_source` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1: Quảng cáo, 2: Bạn bè/người thân',
  `time_have_job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_id` int(11) DEFAULT NULL,
  `job_business` tinyint(4) DEFAULT NULL COMMENT '1: Đúng ngành 2: Sai ngành',
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `job_users`
--

INSERT INTO `job_users` (`id`, `job`, `name_job`, `roll_job_id`, `type_company_detail_id`, `traning`, `introduce_source`, `time_have_job`, `salary_id`, `job_business`, `created_id`, `updated_id`, `deleted_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 1, 'Lập trình viên', 4, 4, 'Ngoại ngữ', 1, '2', 1, NULL, NULL, NULL, NULL, '2018-10-29 05:33:01', '2018-10-29 05:33:01', NULL),
(18, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-31 09:48:47', '2018-11-25 02:34:38', NULL),
(20, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-31 09:57:07', '2018-10-31 09:57:07', NULL),
(21, 1, 'grap', 4, 11, 'Kỹ năng mềm', 2, '1', 1, NULL, NULL, NULL, NULL, '2018-11-03 07:48:59', '2018-11-03 07:48:59', NULL),
(22, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-03 07:50:22', '2018-11-03 07:50:22', NULL),
(23, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-03 07:52:28', '2018-11-03 07:52:28', NULL),
(24, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-03 07:53:20', '2018-11-03 07:53:20', NULL),
(25, 1, 'Kĩ sư', 3, 6, 'Kỹ năng mềm', 1, '3', 3, NULL, NULL, NULL, NULL, '2018-11-03 07:54:42', '2018-11-03 07:54:42', NULL),
(26, 1, 'nhân viên', 4, 5, 'Văn bằng hai', 1, '2', 4, NULL, NULL, NULL, NULL, '2018-11-03 07:55:46', '2018-11-03 07:55:46', NULL),
(27, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-03 07:58:43', '2018-11-03 07:58:43', NULL),
(28, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-03 07:59:24', '2018-11-03 07:59:24', NULL),
(29, 1, 'nghiên cứu viên', 2, 1, 'Đi du học', 2, '2', 3, NULL, NULL, NULL, NULL, '2018-11-03 08:00:37', '2018-11-03 08:00:37', NULL),
(30, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-03 08:01:21', '2018-11-03 08:01:21', NULL),
(32, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-03 08:04:27', '2018-11-03 08:04:27', NULL),
(33, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-03 08:06:29', '2018-11-03 08:06:29', NULL),
(34, 1, 'Sửađiện', 1, 5, NULL, 1, '1', 1, NULL, NULL, NULL, NULL, '2018-11-03 08:09:15', '2018-11-03 08:09:15', NULL),
(35, 1, 'nhân viên', 1, 2, NULL, 1, '1', 2, NULL, NULL, NULL, NULL, '2018-11-04 08:57:34', '2018-11-04 08:57:34', NULL),
(36, 1, 'developer', 4, 6, 'Ngoại ngữ', 2, '2', 1, NULL, NULL, NULL, NULL, '2018-11-07 08:18:51', '2018-11-07 08:18:51', NULL),
(37, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-18 18:24:29', '2018-11-18 18:24:29', NULL),
(40, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-18 18:30:27', '2018-11-18 18:30:27', NULL),
(41, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-18 18:32:29', '2018-11-18 18:32:29', NULL),
(42, 1, 'tester', 1, 3, 'Ngoại ngữ', 2, '3', 2, NULL, NULL, NULL, NULL, '2018-11-18 18:34:39', '2018-11-18 18:34:39', NULL),
(43, 1, 'tester', 3, 9, 'Ngoại ngữ', 2, '2', 1, NULL, NULL, NULL, NULL, '2018-11-25 00:47:55', '2018-11-25 01:18:01', NULL),
(44, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-25 02:26:08', '2018-11-25 02:26:08', NULL),
(45, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-25 18:12:04', '2018-11-25 18:42:45', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_09_25_100920_create_salarys_table', 1),
(2, '2018_09_25_100921_create_type_companys_table', 1),
(3, '2018_09_25_100922_create_type_detail_companys_table', 1),
(4, '2018_09_25_101000_create_roll_jobs_table', 1),
(5, '2018_09_25_101220_create_business_table', 1),
(6, '2018_09_25_101601_create_job_users_table', 1),
(7, '2018_09_25_103553_create_users_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roll_jobs`
--

CREATE TABLE `roll_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `roll` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Exp:  Tập sự, Quản lý cấp bộ phận ,...',
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roll_jobs`
--

INSERT INTO `roll_jobs` (`id`, `roll`, `created_id`, `updated_id`, `deleted_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thực tập', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Cộng tác viên', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Thử việc', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Quản lý cấp bộ phận', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Quản lý cấp đơn vị', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Cán bộ thực thi(nhân viên)', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salarys`
--

CREATE TABLE `salarys` (
  `id` int(10) UNSIGNED NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `salarys`
--

INSERT INTO `salarys` (`id`, `salary`, `created_id`, `updated_id`, `deleted_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Trong khoảng 2000000vnđ - 5000000vnđ', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Trong khoảng 5000000vnđ - 8000000vnđ', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Trong khoảng 8000000vnđ - 10000000vnđ', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Trên 10000000vnđ', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_companys`
--

CREATE TABLE `type_companys` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Exp: nhà nước, cơ quan/doanh nghiệp,..',
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_companys`
--

INSERT INTO `type_companys` (`id`, `type`, `created_id`, `updated_id`, `deleted_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nhà nước', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Cơ quan/Doanh nghiệp', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Tổ chức phi chính phủ', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'tự do', NULL, NULL, NULL, '2018-11-03 07:48:59', '2018-11-03 07:48:59', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_detail_companys`
--

CREATE TABLE `type_detail_companys` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Exp: trung ương, tổng công ty,...',
  `type_company_id` int(10) UNSIGNED NOT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_detail_companys`
--

INSERT INTO `type_detail_companys` (`id`, `type_detail`, `type_company_id`, `created_id`, `updated_id`, `deleted_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cấp trung ương', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Cấp địa phương', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Cơ quan/Doanh nghiệp', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Tập đoàn/Tổng công ty', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Tự kinh doanh', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Doanh nghiệp 100% vốn nước ngoài', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Doanh nghiệp vừa và nhỏ', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Liên doanh', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Trong nước', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Quốc tế', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, 4, NULL, NULL, NULL, '2018-11-03 07:48:59', '2018-11-03 07:48:59', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'Graduation sex: 1: Nam, 2: Nữ',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `graduation_year` int(10) UNSIGNED DEFAULT NULL,
  `graduation_business` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'Graduation Business user: 1: Khoa học máy tính, 2: Công nghệ thông tin, ...',
  `job_id` int(10) UNSIGNED DEFAULT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Role user: 1: Admin, 2: SV',
  `last_access_at` datetime DEFAULT NULL,
  `remember_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `code`, `first_name`, `last_name`, `full_name`, `sex`, `email`, `phone`, `graduation_year`, `graduation_business`, `job_id`, `role`, `last_access_at`, `remember_token`, `password`, `created_id`, `updated_id`, `deleted_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Trịnh', 'Hải Quân', 'Trịnh Hải Quân', 1, 'a@gmail.com', '0900000', NULL, NULL, NULL, 1, '2018-10-11 09:17:34', 'hPw4zhlJ7yDbwWXBJyY5Uq46hZehU6Iiri1dxJhLsoE7FJVo6wfeRFukPbEx', '$2y$10$zJtVK0iOsMv4YhZNdz9GTuZgpGiiz183WaSvtkmtAm3AyxfIZkHEW', 1, 1, NULL, '2018-10-11 02:17:34', '2018-11-18 18:26:06', NULL),
(2, 16020000, 'Nguyễn ', 'A', 'Nguyễn A', NULL, NULL, NULL, 2003, 1, 17, 1, '2018-10-11 09:22:23', 'C0Ys5o7dLeePncBoiG43mfNYAhGMlj60kAAz8Ku6hP0o1EfNt1T7dCdSRFzZ', '$2y$10$/XhObbk3dd9ZAiVWuzjOhehbBMvBDSzKbUCaAuGTYIp6/9aAzh5YC', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-29 05:33:01', NULL),
(3, 14020001, 'Nguyễn', 'A', 'Nguyễn A', NULL, NULL, NULL, NULL, NULL, 45, 2, '2018-10-11 09:22:23', 'BsMVRBoDwejJCn7IJl87cEiiMVLdNgQU10GIHIdceXIBUmBiN2xX6aCtG2XR', '$2y$10$aMwsPTuKEtCMnVeP0EwsPOkwalU33qDlYSckKB83wHpbT0Z./QIi6', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-11-25 18:12:05', NULL),
(4, 14020002, NULL, NULL, ' ', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', 'Fc6dvIzXPnsDkK9ZwlOgGhXx4lqq6dXd0TY721HdxeN6O93nSkwyZWUwebYA', '$2y$10$Sh5vjjjTxVRcXqvLpCcTGuPaOODsuCTyTvT6YbrlbAZROi63JjVSq', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-23 21:08:29', NULL),
(5, 14020003, NULL, NULL, ' ', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', 'uu12JKPqls0VJ1sJADIldzrnDSi9pExVMPN77doCaIrVdGhfjf2VBfY7A7kU', '$2y$10$0tc53CBYTNJQH9Nnua2daeeHr20xweD6eHsjDvCxZfUqXXHUrKwUC', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-23 21:20:20', NULL),
(6, 14020004, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', 'BG8xOFeCe7aEjJwvVTUGBsrf8ZSn4Xt37tCPMmAfRUxzYhvQbHSpthTfs3ty', '$2y$10$/HPLQOAjorLppFzgK63Na..FUS6L31V4O5zBUz0eKDCCL.7DYRGJe', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-11 02:22:23', NULL),
(7, 14020005, NULL, NULL, ' ', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$y1q/gmjJPWcx3hHNTW.gieEA9HTI9zJgwI6yCNEBeEbGp7lbXW1PK', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-24 03:34:13', NULL),
(8, 14020006, NULL, NULL, ' ', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', '7rHV7XVGx7asnLoOqUg88cFLCIo5GDNQYlI5pwfbd9KGEpgdnimGLSD02iYg', '$2y$10$AqMnAAvaJeip4izXkxMZZeDE00kY5UWYUpkwdgN.7A.44QOkCXQIu', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-24 19:48:02', NULL),
(9, 14020007, NULL, NULL, ' ', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', 'ErnGYpq6kTav7uw7mTvuF243MmZceF7sufpYZNln0i02IYGgKVXt9l1Xutf7', '$2y$10$TcBN1.E61amSHC/1XqGQGOr0hNclZGLGA0Z4Ev.sLuhbfypsZZvZa', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-24 20:25:41', NULL),
(10, 14020008, NULL, NULL, ' ', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$Ba7fgDq2glJzJwqBC6PIDOQF1U8ZVNKBDA.FUw.1FMPfQ03zPFAXe', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-27 10:16:06', NULL),
(11, 14020009, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$PcvovCS1/KdI4xoqDpxEM.JY8n/p8MljGBbntjMqVmB3QcXYRXx2W', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(12, 14020010, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$k05h8MK1IAHX7y1zHK9Hf.vdDvz2EbySx1XQulego3YfJ1846w6dK', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(13, 14020011, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$EzUWB0JCONr9a6/6gxR4AOMCCkxac.9zuAvJcsgSM5Zbo26L8x6p6', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(14, 14020012, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$jXarAMc/7QKTttWy2WIR2urMFVvBer2cCbb.bxc0.Y7k8umdLuuEy', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(15, 14020013, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$Z6v7j2CsId4vuWMZrxniUObuSMpu35J6cDWrD3mOBhKDm9pbC.Qv6', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(16, 14020014, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$RDQSO2Km3w5s4jk7jA4Rnu5WCJjkBQUPdV8ER4B3hA7.U7ACJapcu', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(17, 14020015, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$3p8/gWR9jZz5bR0u/0xb4.pgGdHKzwjL2ffzMQ4SbNZQEhxTzeuGq', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(18, 14020016, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$iddiq98Bx2EcpnIsXuLxeOH01QvQXkR7CL8EBIyyGYI7eN3dl7P7q', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(19, 14020017, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$0vOWImKuHVTwoEfP6/9u4eEgIp/zsNTS.rR.dpXMY3GCpRVxsPf/G', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(20, 14020018, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:25', NULL, '$2y$10$2rtvyF6.xfWPZFu.CsvQ2.6WrjKv/7cmq5wtUl18ivQhVohOGMfqy', NULL, NULL, NULL, '2018-10-11 02:22:25', '2018-10-11 02:22:25', NULL),
(21, 14020019, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:25', NULL, '$2y$10$sBFCMV/O5uijdZwNfldErulx7m4gRNO.b5eM.EXLVyXbgr5Ui7CwO', NULL, NULL, NULL, '2018-10-11 02:22:25', '2018-10-11 02:22:25', NULL),
(22, 14020020, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:03', NULL, '$2y$10$DVahZFIPHK4KSfk/IhEgEOnQwe5NUWT0un3stLXszOcRB.rETXStO', NULL, NULL, NULL, '2018-10-29 05:27:03', '2018-10-29 05:27:03', NULL),
(23, 14020021, 'Lê Anh', 'Thư', 'Lê Anh Thư', NULL, NULL, NULL, NULL, 10, 18, 2, '2018-10-29 12:27:04', '33O7n5U3DqGWPCKwA1w6f4CpmtWXLLNt1X6AOpwJSclfzicvOY4YlvKjSP9R', '$2y$10$GyUuC.fLGXjBJ7D0yE5NqOag4GHWWqnb.YgQ5lMfQGtLqPvh72mtm', NULL, NULL, NULL, '2018-10-29 05:27:04', '2018-11-25 02:34:38', NULL),
(24, 14020022, 'Lê Ngọc', 'Hân', 'Lê Ngọc Hân', NULL, NULL, NULL, NULL, 1, 43, 2, '2018-10-29 12:27:04', 'wptdw5JBuMBGqdJTBaGJCdNi5umu62D4rBWwBHOf6z5vBPd1h2wUfs08pG1m', '$2y$10$jSES9Nu/ZdZonUiXKoaZtOtorkjpFkhscJEIwf2zqFk/FahqIv52C', NULL, NULL, NULL, '2018-10-29 05:27:04', '2018-11-25 00:47:55', NULL),
(25, 14020023, 'Trần Công', 'Minh', 'Trần Công Minh', 2, 'minhtran@gmail.com', NULL, 2015, 4, 20, 2, '2018-10-29 12:27:04', 'cvG8udzV6NZsmBiFkbGvqKxyQrz00zAQ9oPlG5bLKmSIypb5BZjbXsDekuLN', '$2y$10$fD.uR1a1tHrAySfExK9tWOLr98ATYu6r.Eouf/71QXZFmfOBUQe/u', NULL, NULL, NULL, '2018-10-29 05:27:04', '2018-10-31 09:57:07', NULL),
(26, 14020024, 'Lê', 'Minh', 'Lê Minh', 1, 'mnhle@gmail.com', NULL, 2009, 8, 21, 2, '2018-10-29 12:27:04', 'r0zwHB3OLLRuBCrr4WaUOSVm74s0XvNonuD7eiShrexaq3rZJO4Ve55WqPk7', '$2y$10$uiT/rrF5f9Lb8gdK21e.fOliZ9SJ4a1NDuBi/mXPW4Y5ynVHEBVEW', NULL, NULL, NULL, '2018-10-29 05:27:04', '2018-11-03 07:49:00', NULL),
(27, 14020025, 'Phạm Bảo', 'Sơn', 'Phạm Bảo Sơn', 1, 'son@gmail.com', NULL, 2012, 6, 22, 2, '2018-10-29 12:27:04', 'L28WpmEPUG5nakGk8gW5bOPbneNCcXGNlcQpIicHhGntBEPZgJpPzLK3Muwd', '$2y$10$g1wKnxHS5e1jqfDXw2YkJu.9yXBGsmHlBNn6UDF0xNRTWvgWwCvH.', NULL, NULL, NULL, '2018-10-29 05:27:04', '2018-11-03 07:50:22', NULL),
(28, 14020026, 'Dương Văn', 'Minh', 'Dương Văn Minh', 1, 'aa@gmail.com', '0974111222', 2016, 2, 40, 2, '2018-10-29 12:27:04', 'zKS6r0ajZF7Tl8RgFAFj6TPs3yokQrf4y4pP1sRHYwYKCwGGrew4yWcq0u7s', '$2y$10$NL.7zhzkkHOHQTySlgnuNOIh/MRbVbI0duL6zSrgaknQSBCP19Qmq', NULL, NULL, NULL, '2018-10-29 05:27:04', '2018-11-18 18:31:16', NULL),
(29, 14020027, 'nguyễn Ngọc', 'lam', 'nguyễn Ngọc lam', 2, 'lam@gmail.com', NULL, 2010, 3, 23, 2, '2018-10-29 12:27:05', 'vo0RPFD5x3vds5XGFZ4TtPyCcCXF9KMa2KOjkUgWpVKHuLdzAzb84tIAGzW5', '$2y$10$J4HbV7u7.xXR0XpsXKWy9uictZJSw8iiEOmdV0HcNwDY7azyb76aC', NULL, NULL, NULL, '2018-10-29 05:27:05', '2018-11-03 07:52:28', NULL),
(30, 14020028, 'trần lan', 'hương', 'trần lan hương', 2, 'huongmaiglan@gmail.com', NULL, 2017, 3, 24, 2, '2018-10-29 12:27:05', '68OkB9AwQH5HE1e8Plq9acmwnuuyFLMTYUohg6jchGJXuahNpx8Ti2pfzZdQ', '$2y$10$5PMXEhLFqBxPcmB9/qZLhOgSJKQEh0qYTnrfGJE/.Mm.4zNBc2IF.', NULL, NULL, NULL, '2018-10-29 05:27:05', '2018-11-03 07:53:20', NULL),
(31, 14020029, 'Lê Phương Lan', 'Minh', 'Lê Phương Lan Minh', 2, 'minh@gmail.com', NULL, 2013, 2, 25, 2, '2018-10-29 12:27:05', 'QsYHdpVSKhPcKWY5Ep1kvs7f3qmC3AWuMt5rDKEnuVYwnOncn6gmBtFPefCj', '$2y$10$wSpHFre0HCOcHNLBpI1KVOVOgmkCihv7vEwyHk.9s20cD8FKYHMFK', NULL, NULL, NULL, '2018-10-29 05:27:05', '2018-11-03 07:54:42', NULL),
(32, 14020030, 'Đào Thị', 'Hảo', 'Đào Thị Hảo', 2, 'hao@gmail.com', NULL, 2016, 6, 26, 2, '2018-10-29 12:27:05', 'CP1sAOJOSz7RtHvdhJTOQj0GbkwpXphLukSvNvz4LHaLEWRzuSbXbzbwNMxz', '$2y$10$.br9ZBLZSsm6SQIoXmhNHOY/83YGJKBLuJIA1dHklhzlejNUVxKv2', NULL, NULL, NULL, '2018-10-29 05:27:05', '2018-11-03 07:55:46', NULL),
(33, 14020031, 'Lê anh', 'Thư', 'Lê anh Thư', 2, 'thu@gmail.com', NULL, 2016, 7, 27, 2, '2018-10-29 12:27:05', 'jCjyAURYnYezQ6sh8BcX89cNXoTa8mKe4hGtteLNwEUhzlqocIQStcwQlV3O', '$2y$10$e7lii6QjH.rO7nBpJ6cr2.fEb3BfUIY835u3pb0l7RVTAI8OPL/tS', NULL, NULL, NULL, '2018-10-29 05:27:06', '2018-11-03 07:58:43', NULL),
(34, 14020032, 'Nguyễn Thị', 'Mai', 'Nguyễn Thị Mai', 2, 'mai@gmail.com', NULL, 2011, 10, 28, 2, '2018-10-29 12:27:06', 'PtsSS2ICCZp9g7RB8AnHwN9w2iAC6ciSIVFBNjQfxNQbDWQEyb3GyaI81JeT', '$2y$10$Af6HrxJv/bOxLFm4bRyRDeftSp8UWXyUE21DlT0./QJIO9G1owlca', NULL, NULL, NULL, '2018-10-29 05:27:06', '2018-11-03 07:59:24', NULL),
(35, 14020033, 'Ngô Thị', 'Hương', 'Ngô Thị Hương', 2, 'huong@gmail.com', '034455', 2012, 13, 29, 2, '2018-10-29 12:27:06', 'CiOyvN3CgRd5OrVVLCTP5lEOavgdsNDIuyHSYTjnTja1P9ISiaGffhMmKfOa', '$2y$10$RNB1a3dXlgaLleq1v/.59eWUQWcWoN6fw6mIeSIBCutBqyNDaouiO', NULL, NULL, NULL, '2018-10-29 05:27:06', '2018-11-03 08:00:37', NULL),
(36, 14020034, 'Đào Thị', 'Trang', 'Đào Thị Trang', 2, 'trang@gmail.com', '032855', 2013, 11, 30, 2, '2018-10-29 12:27:06', 'tagCaXGrJ6Y0bIjRfYbnucMdV0KwIdVNNjCDCFLbu1k0fGZH10jb409c5Hsi', '$2y$10$A75wgoWXBh062BxwveAPFuxAfwR/tW6ANZEJFkVgMLSz0V9TgbPG2', NULL, NULL, NULL, '2018-10-29 05:27:06', '2018-11-03 08:01:21', NULL),
(37, 14020035, 'Lê Duy', 'Tùng', 'Lê Duy Tùng', 1, 'tung@gmail.com', '0324662', 2013, 12, 35, 2, '2018-10-29 12:27:06', 'kVBPjKO7ejXy2pHC0w8s9NMYQixvpm8qcgMICnyLnJhpMSV7Y0iDPDV4Ib31', '$2y$10$LNpRds2PeoeZU0tSodEaiu5BYo7xfovWnVgIGgC7yWZENWyrgZ/f6', NULL, NULL, NULL, '2018-10-29 05:27:07', '2018-11-04 08:57:34', NULL),
(38, 14020036, 'Nguyễn Thị', 'Nga', 'Nguyễn Thị Nga', NULL, NULL, NULL, 2011, 3, 41, 2, '2018-10-29 12:27:07', 'YyuY8OMX4h7yeqtt0affBJr5yYjo861caEjW9ZltHrxV13tkkVANM2Tnikum', '$2y$10$scusmdsGxJUpJX5bhL.2me.Z/69fDnbh3f/PRRDnIYPD/2cHZHxLm', NULL, NULL, NULL, '2018-10-29 05:27:07', '2018-11-18 18:32:29', NULL),
(39, 14020037, 'Nguyễn Minh', 'Hiếu', 'Nguyễn Minh Hiếu', 1, 'hieu@gmail.com', '325362', 2012, 8, 34, 2, '2018-10-29 12:27:07', 'CfIqDQZN2SQl03nOIbe81kj4f8FPIyu1sh2uI7FOBqkNDKlB4vrPdXVjGNtd', '$2y$10$Y2htTfR4zUdAdfSla6HYbeP0boeUH.kIsRTTrJGhEwvy5HV10Xw32', NULL, NULL, NULL, '2018-10-29 05:27:07', '2018-11-03 08:09:15', NULL),
(40, 14020038, 'Hoàng Quốc', 'Khánh', 'Hoàng Quốc Khánh', 1, 'khanh@gmail.com', '23623', 2011, 6, 32, 2, '2018-10-29 12:27:07', 'GTdYCO7YXGOeP3S9ausc1KAwNyuJgYiJkWCp40vXGbCwHXOxPKCcgrUYV9eV', '$2y$10$HnYOcJ3Y14/NXq5jOAKZLeQfvExmLPARiJFu/E/U03Ya7Rh1uj5/O', NULL, NULL, NULL, '2018-10-29 05:27:07', '2018-11-03 08:04:27', NULL),
(41, 14020039, 'Nguyễn Thanh', 'Tùng', 'Nguyễn Thanh Tùng', 1, 'tung555@gmail.com', '09711', 2015, 9, 42, 2, '2018-10-29 12:27:07', '9g4tedXlI4zKfTUScW65JWjAzXEEFYNPE4jc9FwUVhvRMj6rlUdcNaou6hl5', '$2y$10$raPKI3qlqc0dqGaNiQLt5uNuP6A3VN9ffDNhRbzoBhNizI62juGja', NULL, NULL, NULL, '2018-10-29 05:27:07', '2018-11-18 18:35:21', NULL),
(42, 14020040, 'Nguyễn Quang', 'Anh', 'Nguyễn Quang Anh', 1, 'anhquang@gmail.com', '4632762', 2012, 14, 33, 2, '2018-10-29 12:27:07', 'BLTAiQUZGXDvKJNjnc2ByXAOHFU4y8fs5pSrZp0LYsM7f6CHNyU9y2SXlk4x', '$2y$10$fBWF6sTari6Vx3Lc9uhVluTrgd/OOSM5QGe1aVFkRnxMZlYQrHpvC', NULL, NULL, NULL, '2018-10-29 05:27:08', '2018-11-03 08:06:29', NULL),
(43, 14020041, 'Nguyễn Văn', 'Bảo', 'Nguyễn Văn Bảo', NULL, NULL, NULL, 2015, 6, 37, 2, '2018-10-29 12:27:08', 'Ydx0Sm9GwQJN4xR1g4rey8pJASS8QI7sIQgMVCmW395zarro4FoC4EacV1pw', '$2y$10$5oPS8gKQ6F7EZkcjqfSJiOiZDG2CZ9JXup3Kdh8QRbWTEfWlFb4ey', NULL, NULL, NULL, '2018-10-29 05:27:08', '2018-11-18 18:24:29', NULL),
(44, 14020042, 'Nguyễn Bảo', 'Ngọc', 'Nguyễn Bảo Ngọc', NULL, NULL, NULL, 2004, 2, 36, 2, '2018-10-29 12:27:08', NULL, '$2y$10$u6/B0ht6k9A3DvX/u2azHuS6J0BUcEYoYL/dV5v/48tx4ZBtO9ZdC', NULL, NULL, NULL, '2018-10-29 05:27:08', '2018-11-07 08:18:52', NULL),
(45, 14020043, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:08', NULL, '$2y$10$qJB5TjJjWpJf8VyMPwd5H.aaG4FN.3U.FNfQkLW.NpBFrKWrj/sTm', NULL, NULL, NULL, '2018-10-29 05:27:08', '2018-10-29 05:27:08', NULL),
(46, 14020044, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:08', NULL, '$2y$10$rVQHedrQi3DZZ816tvW.Wux2GeTsel9ANZZ7u/WG.n8RPDKEIUWVy', NULL, NULL, NULL, '2018-10-29 05:27:08', '2018-10-29 05:27:08', NULL),
(47, 14020045, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:08', NULL, '$2y$10$SeuvXdNImJxopMb/WswU9eu2mzEAE/azhYDqEdMQ0Dqz109Ppg34.', NULL, NULL, NULL, '2018-10-29 05:27:08', '2018-10-29 05:27:08', NULL),
(48, 14020046, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:08', NULL, '$2y$10$gAUCtmHCFllfWw48iv77/uNTQRnP7PhuoBHuC932CZWGzGAr/jrfS', NULL, NULL, NULL, '2018-10-29 05:27:09', '2018-10-29 05:27:09', NULL),
(49, 14020047, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:09', NULL, '$2y$10$chJ1M0iVN4YLMBIkI9nq2.wgjBG/RVIDGShsTwmn3zPrk9uxvLgfK', NULL, NULL, NULL, '2018-10-29 05:27:09', '2018-10-29 05:27:09', NULL),
(50, 14020048, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:09', NULL, '$2y$10$n.DXh6NmVGlDkiEUPM3fUeqy9ze7MsGuh8vI3MySxE8FlEvhtO1L2', NULL, NULL, NULL, '2018-10-29 05:27:09', '2018-10-29 05:27:09', NULL),
(51, 14020049, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:09', NULL, '$2y$10$FDkQNucHIdc1Kf/qVnrUkO/IggdRQ3n1OrA0djS490yrtfFUeVOKm', NULL, NULL, NULL, '2018-10-29 05:27:09', '2018-10-29 05:27:09', NULL),
(52, 14020050, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:09', NULL, '$2y$10$r0FsLXL7/KM79JXYaiIvBe0OE3cmLPe7Wf0DYJmmsNN2OB6tFGd5u', NULL, NULL, NULL, '2018-10-29 05:27:09', '2018-10-29 05:27:09', NULL),
(53, 14020051, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:09', NULL, '$2y$10$0dhYzxyhpBFa072w.EwX6ObULU3nWsv7Nxv05gmR/ZsvjAvJYeBsq', NULL, NULL, NULL, '2018-10-29 05:27:10', '2018-10-29 05:27:10', NULL),
(54, 14020052, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:10', NULL, '$2y$10$KCKthNn7M5BlRqLGUa9AI.Sye1H/lCHsqJRZ6TTohfLaT6qt8CoH6', NULL, NULL, NULL, '2018-10-29 05:27:10', '2018-10-29 05:27:10', NULL),
(55, 14020053, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:10', NULL, '$2y$10$DDoVgpyCKC6jcCFlCQT0seqCbHmoi33OzAMtQgxjguUwljsjdY/nW', NULL, NULL, NULL, '2018-10-29 05:27:10', '2018-10-29 05:27:10', NULL),
(56, 14020054, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:10', NULL, '$2y$10$q3EDI11sJViJ4D5TjudhHeRS8eBjA1IPisUEeERvTF9lU2HemFlhy', NULL, NULL, NULL, '2018-10-29 05:27:10', '2018-10-29 05:27:10', NULL),
(57, 14020055, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:10', NULL, '$2y$10$/AttBFD6m.D5QiDLKxMq1eAjHbDdC4zM1Sbz74TLfpf1FjCvazdjW', NULL, NULL, NULL, '2018-10-29 05:27:10', '2018-10-29 05:27:10', NULL),
(58, 14020056, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:10', NULL, '$2y$10$H/4ieNf.2SmxylkRQVoxF.Q9VVjD08d2bdqntejFqVRyaKdzQlFlC', NULL, NULL, NULL, '2018-10-29 05:27:10', '2018-10-29 05:27:10', NULL),
(59, 14020057, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:11', NULL, '$2y$10$hQApVf6cbuPN3.JivtgKI.c/EpLLgKCB031y3d3l1P0JWut.BIHoy', NULL, NULL, NULL, '2018-10-29 05:27:11', '2018-10-29 05:27:11', NULL),
(60, 14020058, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:11', NULL, '$2y$10$oFu5AjbxXP8W9EB8Rk9Fg.viuUGuYOsc2ZFX4IOkGW0mliX.6QWfG', NULL, NULL, NULL, '2018-10-29 05:27:11', '2018-10-29 05:27:11', NULL),
(61, 14020059, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:11', NULL, '$2y$10$wYhNlBtCCuwwG/wzYe2j5e8Ta63dYjVxM9Byl/1ASaZW0DSwQyjIa', NULL, NULL, NULL, '2018-10-29 05:27:11', '2018-10-29 05:27:11', NULL),
(62, 14020060, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:11', NULL, '$2y$10$g5fyU/vkIp0tiPX8kWm0N.QuzACbneHqhg87nu0FEL.wxua5sGiTm', NULL, NULL, NULL, '2018-10-29 05:27:11', '2018-10-29 05:27:11', NULL),
(63, 14020061, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:11', NULL, '$2y$10$saUVgxAOKeVxmsNIV2sEVuW5xcKQrMtZ0sFgnOw8fw.zrapPSwgtq', NULL, NULL, NULL, '2018-10-29 05:27:11', '2018-10-29 05:27:11', NULL),
(64, 14020062, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:11', NULL, '$2y$10$bukff03NQ6Q6LRkoOIjiy.B.e6iZahNc9QHrLFkSMuuGWBDkHkn3C', NULL, NULL, NULL, '2018-10-29 05:27:12', '2018-10-29 05:27:12', NULL),
(65, 14020063, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:12', NULL, '$2y$10$DKrnckJfFFsrCKSdr4YIfe3.BNp8u78KDieUSJflnIb3Y21FFpKFO', NULL, NULL, NULL, '2018-10-29 05:27:12', '2018-10-29 05:27:12', NULL),
(66, 14020064, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:12', NULL, '$2y$10$tyvnpan.igTasNRvrvjqIeRO.X8DHqATYSFsRZf0/rVM0omE45GOS', NULL, NULL, NULL, '2018-10-29 05:27:12', '2018-10-29 05:27:12', NULL),
(67, 14020065, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:12', NULL, '$2y$10$rshSO58lb0j4P8xMZTrlt.j.QYxguSiONjlRrCsQ4W5gGJirHPwo6', NULL, NULL, NULL, '2018-10-29 05:27:12', '2018-10-29 05:27:12', NULL),
(68, 14020066, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:12', NULL, '$2y$10$ujRYmxuiiV0Zsv.vSl6duOzZ4OjUxWowN6sAci4x36Rc5LzF3mwiu', NULL, NULL, NULL, '2018-10-29 05:27:12', '2018-10-29 05:27:12', NULL),
(69, 14020067, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:13', NULL, '$2y$10$uBBnUWUd0xyyRzrKX8Lb7uHzhkd2PkmkyzSkHeWkYFcCiX10ZFRJm', NULL, NULL, NULL, '2018-10-29 05:27:13', '2018-10-29 05:27:13', NULL),
(70, 14020068, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:13', NULL, '$2y$10$M2gW.liza6B2BfPiwBw3XeR5PFCJmoKaRF3J93tw5tJkUQQ3tp2T.', NULL, NULL, NULL, '2018-10-29 05:27:13', '2018-10-29 05:27:13', NULL),
(71, 14020069, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:13', NULL, '$2y$10$N23XHgHLqD3sGaY9mN.NMOY88e/nQpitupLbSUR0tIAXMsQvitfDm', NULL, NULL, NULL, '2018-10-29 05:27:13', '2018-10-29 05:27:13', NULL),
(72, 14020070, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:13', NULL, '$2y$10$OnwJk4BMQoqx03MCxanx5esBPoLM2z.7k/XWfO2ZZMZPxV5iMdGSm', NULL, NULL, NULL, '2018-10-29 05:27:13', '2018-10-29 05:27:13', NULL),
(73, 14020071, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:13', NULL, '$2y$10$A1zylYwwyunGII50X9HA0uykn6XyvFFNJ4.RzHpM9Smib6wXHd.EW', NULL, NULL, NULL, '2018-10-29 05:27:14', '2018-10-29 05:27:14', NULL),
(74, 14020072, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:14', NULL, '$2y$10$zYk835pG9R56DkLEW/Zt1eUXWMt2T8QLOvqHZMW1SsMxQS.DPJ3Hm', NULL, NULL, NULL, '2018-10-29 05:27:14', '2018-10-29 05:27:14', NULL),
(75, 14020073, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:14', NULL, '$2y$10$azIU0MBIkl5Za.7fmvE9xuDUrPcsvSYB9AOR4wMYhL8VbXiwxErPK', NULL, NULL, NULL, '2018-10-29 05:27:14', '2018-10-29 05:27:14', NULL),
(76, 14020074, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:14', NULL, '$2y$10$iCCirtbzyA1uWxXecl8CyuxnR0wVq4yTQx0nHEid8lBgkWRhcFCkO', NULL, NULL, NULL, '2018-10-29 05:27:14', '2018-10-29 05:27:14', NULL),
(77, 14020075, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:14', NULL, '$2y$10$z0ZX2CB8UYIgaN.DV7Jrw.5RsBuDDqUrctiEDItOW9n11x4sUS2gm', NULL, NULL, NULL, '2018-10-29 05:27:14', '2018-10-29 05:27:14', NULL),
(78, 14020076, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:15', NULL, '$2y$10$IWuC5.zKTkZNo2ymLxvsGO6ljBF1jCZZ.EqL/jjkhvo3DUqTdSCby', NULL, NULL, NULL, '2018-10-29 05:27:15', '2018-10-29 05:27:15', NULL),
(79, 14020077, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:15', NULL, '$2y$10$6FgeXMNZr/.BD1UHUfB8ye07vL7XHYPla8J8isVH9iNQwmRgzMo5C', NULL, NULL, NULL, '2018-10-29 05:27:15', '2018-10-29 05:27:15', NULL),
(80, 14020078, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:15', NULL, '$2y$10$ZQO61zZjJ4afOm7DgvboTedpg2NpjmmLny8fqkYv7UVpxVb9Y6qG6', NULL, NULL, NULL, '2018-10-29 05:27:15', '2018-10-29 05:27:15', NULL),
(81, 14020079, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:15', NULL, '$2y$10$zErHZBOesucHRRID9.oH7e8qXW44ouVcakwWPed.tQhcy3RFv3m5i', NULL, NULL, NULL, '2018-10-29 05:27:15', '2018-10-29 05:27:15', NULL),
(82, 14020080, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:15', NULL, '$2y$10$oBqb0pYN0aq6kx1z2B5PBeUsfuSuqaED5EabkvOrrIA/NexYXy3B.', NULL, NULL, NULL, '2018-10-29 05:27:15', '2018-10-29 05:27:15', NULL),
(83, 14020081, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:16', NULL, '$2y$10$saHCvydrxWxG.ERG2es82ODB6gwUypVLC/eAA0bBfnxxUVAm6JYdG', NULL, NULL, NULL, '2018-10-29 05:27:16', '2018-10-29 05:27:16', NULL),
(84, 14020082, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:16', NULL, '$2y$10$K6S57MSOJlflF49N1AR1VugCz3zBkxOA3x7XbGENFlqstrXOZq.pS', NULL, NULL, NULL, '2018-10-29 05:27:16', '2018-10-29 05:27:16', NULL),
(85, 14020083, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:16', NULL, '$2y$10$8.kxDC1Jxmtf2CP0kgnAt.VcGmmILK4HBgsu2dF6a1hxsAjPtbyZ2', NULL, NULL, NULL, '2018-10-29 05:27:16', '2018-10-29 05:27:16', NULL),
(86, 14020084, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:16', NULL, '$2y$10$fFaeqpD4Uwlg6GHItZe/y.fdTLqnuNQmofkv8EyEETLrcNm2ymT4i', NULL, NULL, NULL, '2018-10-29 05:27:16', '2018-10-29 05:27:16', NULL),
(87, 14020085, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:16', NULL, '$2y$10$5XAa3FO54lK9Mwqe5qVI.uawwTV12J.o07bv6bDlVkKBlc8SJ.6zK', NULL, NULL, NULL, '2018-10-29 05:27:16', '2018-10-29 05:27:16', NULL),
(88, 14020086, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:16', NULL, '$2y$10$9Tr/RZIKCLV.BBC3yzqjS.SdwGOzbm4zwdu9CtuhlGxlTGoa3nN0y', NULL, NULL, NULL, '2018-10-29 05:27:17', '2018-10-29 05:27:17', NULL),
(89, 14020087, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:17', NULL, '$2y$10$oUOD6BeYdFcovQDbBzt68O52Yrp5p2TZPCgFzikufONT66MKVUNw.', NULL, NULL, NULL, '2018-10-29 05:27:17', '2018-10-29 05:27:17', NULL),
(90, 14020088, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:17', NULL, '$2y$10$QytktxBqcx9jfSZDwyIW4ehQZJCZuCs1CR8UeI.S4zX5usaQDZpkS', NULL, NULL, NULL, '2018-10-29 05:27:17', '2018-10-29 05:27:17', NULL),
(91, 14020089, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:17', NULL, '$2y$10$91HTrWzkExXhvWjO/JoMZ.NuK1qeuwwxTTKeun4palyuNgcUG1Xpq', NULL, NULL, NULL, '2018-10-29 05:27:17', '2018-10-29 05:27:17', NULL),
(92, 14020090, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:17', NULL, '$2y$10$nH8w/TU9UGYP1ZvsdVkl4uw1dwrPlpwkfqWT.E5Wcfnz5MCgaseLS', NULL, NULL, NULL, '2018-10-29 05:27:17', '2018-10-29 05:27:17', NULL),
(93, 14020091, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:17', NULL, '$2y$10$tCk5DvsEaSrdUiD5qTvEFOpbmLjFuuTvkh0ShFNqaXdeXcYFrYEYi', NULL, NULL, NULL, '2018-10-29 05:27:18', '2018-10-29 05:27:18', NULL),
(94, 14020092, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:18', NULL, '$2y$10$UgblAAOaI4ClOlAnig4ugO06SmQ3djQeRqtbNd5SFaewQdOcURXym', NULL, NULL, NULL, '2018-10-29 05:27:18', '2018-10-29 05:27:18', NULL),
(95, 14020093, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:18', NULL, '$2y$10$x7zyJCydjf9/WXLu80WNluu73ykmKenT9Ewx/Kg1otymSOTDhOrNu', NULL, NULL, NULL, '2018-10-29 05:27:18', '2018-10-29 05:27:18', NULL),
(96, 14020094, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:18', NULL, '$2y$10$FiqOfrm.mIo/OqKZiSzV0enbDGKO0FxpJELxnu65Ivv/EBfb5C3aS', NULL, NULL, NULL, '2018-10-29 05:27:18', '2018-10-29 05:27:18', NULL),
(97, 14020095, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:18', NULL, '$2y$10$weVJZbVNuJJJR3Su6PiPouM7WxHjVrnjJO/uhnRC5DcORysiRUG1i', NULL, NULL, NULL, '2018-10-29 05:27:18', '2018-10-29 05:27:18', NULL),
(98, 14020096, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:19', NULL, '$2y$10$Bkfv4sHE.aETIMbG1w1.M.UVhCE9HhKwZ2agCqERNF1yiP80RJMry', NULL, NULL, NULL, '2018-10-29 05:27:19', '2018-10-29 05:27:19', NULL),
(99, 14020097, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:19', NULL, '$2y$10$xGJHYX8OMJsTjqOvL7t48OCXqxYmLAN2LwuXWBsXYWcNrCGZ8lIYS', NULL, NULL, NULL, '2018-10-29 05:27:19', '2018-10-29 05:27:19', NULL),
(100, 14020098, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:19', NULL, '$2y$10$1A0Q/5c8EHPX7Xu4ONUSxecOaEUEg7rHOq921oMBVDJTMYaBcw9Se', NULL, NULL, NULL, '2018-10-29 05:27:19', '2018-10-29 05:27:19', NULL),
(101, 14020099, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-29 12:27:19', NULL, '$2y$10$hNdzrXeT89YcZG/3Ql8Byu6IVCnnRwhyfLkenm5WLM5tHlqgS1M7i', NULL, NULL, NULL, '2018-10-29 05:27:20', '2018-10-29 05:27:20', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `job_users`
--
ALTER TABLE `job_users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roll_jobs`
--
ALTER TABLE `roll_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `salarys`
--
ALTER TABLE `salarys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `type_companys`
--
ALTER TABLE `type_companys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `type_detail_companys`
--
ALTER TABLE `type_detail_companys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_detail_companys_type_company_id_foreign` (`type_company_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_code_unique` (`code`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `business`
--
ALTER TABLE `business`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `job_users`
--
ALTER TABLE `job_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `roll_jobs`
--
ALTER TABLE `roll_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `salarys`
--
ALTER TABLE `salarys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `type_companys`
--
ALTER TABLE `type_companys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `type_detail_companys`
--
ALTER TABLE `type_detail_companys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `type_detail_companys`
--
ALTER TABLE `type_detail_companys`
  ADD CONSTRAINT `type_detail_companys_type_company_id_foreign` FOREIGN KEY (`type_company_id`) REFERENCES `type_companys` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
