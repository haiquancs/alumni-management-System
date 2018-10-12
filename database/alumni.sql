-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 11, 2018 lúc 11:38 AM
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
  `type_company_id` int(11) DEFAULT NULL,
  `traning` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduce_source` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1: Quảng cáo, 2: Bạn bè/người thân',
  `time_have_job` int(11) DEFAULT NULL,
  `salary_id` int(11) DEFAULT NULL,
  `job_business` tinyint(4) DEFAULT NULL COMMENT '1: Đúng ngành 2: Sai ngành',
  `created_id` int(11) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, 'Tổ chức phi chính phủ', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_detail_companys`
--

CREATE TABLE `type_detail_companys` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Exp: trung ương, tổng công ty,...',
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
(10, 'Quốc tế', 3, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 1, 'Trịnh Hải', 'Quân', 'Trịnh Hải Quân', 1, NULL, NULL, NULL, NULL, NULL, 1, '2018-10-11 09:17:34', 'Do4N95d2HGM3pRgwyQBHt4VsNrMVqzxVn0qsfiVqX11nqTiUHdR35Q77xpxm', '$2y$10$zJtVK0iOsMv4YhZNdz9GTuZgpGiiz183WaSvtkmtAm3AyxfIZkHEW', 1, 1, NULL, '2018-10-11 02:17:34', '2018-10-11 02:17:34', NULL),
(2, 14020000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$/XhObbk3dd9ZAiVWuzjOhehbBMvBDSzKbUCaAuGTYIp6/9aAzh5YC', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-11 02:22:23', NULL),
(3, 14020001, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$aMwsPTuKEtCMnVeP0EwsPOkwalU33qDlYSckKB83wHpbT0Z./QIi6', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-11 02:22:23', NULL),
(4, 14020002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$Sh5vjjjTxVRcXqvLpCcTGuPaOODsuCTyTvT6YbrlbAZROi63JjVSq', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-11 02:22:23', NULL),
(5, 14020003, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$0tc53CBYTNJQH9Nnua2daeeHr20xweD6eHsjDvCxZfUqXXHUrKwUC', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-11 02:22:23', NULL),
(6, 14020004, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$/HPLQOAjorLppFzgK63Na..FUS6L31V4O5zBUz0eKDCCL.7DYRGJe', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-11 02:22:23', NULL),
(7, 14020005, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$y1q/gmjJPWcx3hHNTW.gieEA9HTI9zJgwI6yCNEBeEbGp7lbXW1PK', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-11 02:22:23', NULL),
(8, 14020006, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$AqMnAAvaJeip4izXkxMZZeDE00kY5UWYUpkwdgN.7A.44QOkCXQIu', NULL, NULL, NULL, '2018-10-11 02:22:23', '2018-10-11 02:22:23', NULL),
(9, 14020007, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:23', NULL, '$2y$10$TcBN1.E61amSHC/1XqGQGOr0hNclZGLGA0Z4Ev.sLuhbfypsZZvZa', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
(10, 14020008, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:24', NULL, '$2y$10$Ba7fgDq2glJzJwqBC6PIDOQF1U8ZVNKBDA.FUw.1FMPfQ03zPFAXe', NULL, NULL, NULL, '2018-10-11 02:22:24', '2018-10-11 02:22:24', NULL),
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
(21, 14020019, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-10-11 09:22:25', NULL, '$2y$10$sBFCMV/O5uijdZwNfldErulx7m4gRNO.b5eM.EXLVyXbgr5Ui7CwO', NULL, NULL, NULL, '2018-10-11 02:22:25', '2018-10-11 02:22:25', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `type_detail_companys`
--
ALTER TABLE `type_detail_companys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
