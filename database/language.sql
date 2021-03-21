-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2021 at 03:33 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `language`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryImage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `countryImage`, `created_at`, `updated_at`) VALUES
(1, 'English', 'assets/flag/English.png', NULL, NULL),
(2, 'Spanish', 'assets/flag/Spanish.png', NULL, NULL),
(3, 'French', 'assets/flag/French.png', NULL, NULL),
(4, 'Japan', 'assets/flag/Japan.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_keys`
--

CREATE TABLE `language_keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language_keys`
--

INSERT INTO `language_keys` (`id`, `key`, `created_at`, `updated_at`) VALUES
(1, 'Enter Full Name', NULL, NULL),
(2, 'Enter Father\'s name', NULL, NULL),
(3, 'Enter Mother\'s name', NULL, NULL),
(4, 'Enter Your address', NULL, NULL),
(5, 'Enter your Password', NULL, NULL),
(6, 'Forget your password?', NULL, NULL),
(7, 'Choose your image', NULL, NULL),
(8, 'Enter Present address', NULL, NULL),
(9, 'Re-enter password', NULL, NULL),
(10, 'How are you?', NULL, NULL),
(11, 'who are you ?', NULL, NULL),
(12, 'Hellow, how are you?', NULL, NULL),
(13, 'welcome back', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_03_13_102612_create_languages_table', 2),
(6, '2021_03_13_105223_create_language_keys_table', 3),
(7, '2021_03_13_172851_create_subtitles_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subtitles`
--

CREATE TABLE `subtitles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `languageKey_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subtitles`
--

INSERT INTO `subtitles` (`id`, `languageKey_id`, `language_id`, `subtitle`, `created_at`, `updated_at`) VALUES
(1, 12, 4, 'こんにちは、元気ですか？', NULL, NULL),
(2, 2, 1, 'Enter Father\'s name', NULL, NULL),
(3, 13, 1, 'welcome back', NULL, NULL),
(4, 1, 4, 'フルネームを入力してください', NULL, NULL),
(5, 1, 3, 'Entrez le nom complet', NULL, NULL),
(6, 1, 2, 'Ingrese su nombre completo', NULL, NULL),
(7, 2, 2, 'Ingrese el nombre del padre', NULL, NULL),
(8, 2, 3, 'Entrez le nom du père', NULL, NULL),
(9, 2, 4, '父の名前を入力してください', NULL, NULL),
(10, 10, 1, 'How are you?', NULL, NULL),
(11, 11, 1, 'who are you', NULL, NULL),
(12, 12, 1, 'Hellow, how are you?', NULL, NULL),
(13, 3, 1, 'Enter Mother\'s name', NULL, NULL),
(14, 4, 1, 'Enter Your address', NULL, NULL),
(15, 5, 1, 'Enter your Password', NULL, NULL),
(16, 6, 1, 'Forget your password?', NULL, NULL),
(17, 7, 1, 'Choose your image', NULL, NULL),
(18, 8, 1, 'Enter Present address', NULL, NULL),
(19, 9, 1, 'Re-enter password', NULL, NULL),
(20, 3, 3, 'Entrez le nom de la mère', NULL, NULL),
(21, 3, 4, '母の名前を入力してください', NULL, NULL),
(22, 3, 2, 'Ingrese el nombre de la madre', NULL, NULL),
(23, 4, 2, 'Ingrese su dirección', NULL, NULL),
(24, 4, 3, 'Entrez votre adresse', NULL, NULL),
(25, 4, 4, 'あなたの住所を入力してください', NULL, NULL),
(26, 5, 4, 'パスワードを入力してください', NULL, NULL),
(27, 5, 3, 'Tapez votre mot de passe', NULL, NULL),
(28, 5, 2, 'Ingresa tu contraseña', NULL, NULL),
(29, 6, 2, '¿Olvidaste tu contraseña?', NULL, NULL),
(30, 6, 3, 'Mot de passe oublié?', NULL, NULL),
(31, 6, 4, 'パスワードを忘れましたか？', NULL, NULL),
(32, 8, 4, '現在の住所を入力してください', NULL, NULL),
(33, 8, 2, 'Ingrese la dirección actual', NULL, NULL),
(34, 8, 3, 'Entrez l\'adresse actuelle', NULL, NULL),
(35, 11, 3, 'qui es-tu', NULL, NULL),
(36, 11, 4, 'あなたは誰', NULL, NULL),
(37, 11, 2, '¿Quién es usted?', NULL, NULL),
(38, 12, 2, '¿Hola como estas?', NULL, NULL),
(39, 12, 3, 'Bonjour comment vas-tu?', NULL, NULL),
(40, 1, 1, 'Enter Full Name', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_keys`
--
ALTER TABLE `language_keys`
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
-- Indexes for table `subtitles`
--
ALTER TABLE `subtitles`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `language_keys`
--
ALTER TABLE `language_keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subtitles`
--
ALTER TABLE `subtitles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
