-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 oct. 2022 à 23:26
-- Version du serveur : 5.7.36-log
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `magasin`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_type` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_type` int(11) DEFAULT NULL,
  `quantity_type_value` int(11) DEFAULT NULL,
  `contenance` int(11) DEFAULT NULL,
  `quantity_bottle` int(11) DEFAULT NULL,
  `unity` int(11) DEFAULT NULL,
  `unit_price` decimal(8,2) DEFAULT NULL,
  `buying_price` decimal(8,2) DEFAULT NULL,
  `detail_price` decimal(8,2) DEFAULT NULL COMMENT 'prix detail',
  `wholesale_price` decimal(8,2) DEFAULT NULL COMMENT 'Prix de gros',
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_update_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles_categories`
--

DROP TABLE IF EXISTS `articles_categories`;
CREATE TABLE IF NOT EXISTS `articles_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(15, 'STAR', 29, '2022-09-20 18:21:48', '2022-09-20 18:21:48'),
(16, 'DZAMA', 29, '2022-09-20 18:43:04', '2022-09-20 18:43:04'),
(17, 'COMADIS', 29, '2022-09-20 19:12:17', '2022-09-20 19:12:17'),
(18, 'SODEAM', 29, '2022-09-20 19:37:12', '2022-09-20 19:37:12'),
(19, 'ROYAL', 29, '2022-09-20 20:21:09', '2022-09-20 20:21:09'),
(20, 'ETERIA', 29, '2022-09-20 20:42:12', '2022-09-20 20:42:12'),
(21, 'ANKARANA', 29, '2022-09-20 20:58:07', '2022-09-20 20:58:07'),
(22, 'AUTREE PRODUIT', 29, '2022-09-20 21:14:54', '2022-09-20 21:14:54'),
(23, 'DIVERS', 29, '2022-09-21 08:01:46', '2022-09-21 08:01:46');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `identification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Address',
  `note` text COLLATE utf8mb4_unicode_ci COMMENT 'description de l''utilisateur',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `code`, `status`, `identification`, `phone`, `address`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '859732', 1, 'Divers', '999', NULL, NULL, 5, '2022-10-05 14:52:57', '2022-10-05 14:52:57');

-- --------------------------------------------------------

--
-- Structure de la table `document_achats`
--

DROP TABLE IF EXISTS `document_achats`;
CREATE TABLE IF NOT EXISTS `document_achats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` decimal(10,0) DEFAULT NULL,
  `rest` decimal(10,0) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `received_at` datetime NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `document_ventes`
--

DROP TABLE IF EXISTS `document_ventes`;
CREATE TABLE IF NOT EXISTS `document_ventes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` decimal(20,2) DEFAULT NULL,
  `checkout` decimal(20,2) DEFAULT NULL COMMENT 'sortie de caisse',
  `payment_type` int(11) DEFAULT NULL,
  `received_at` datetime DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `document_ventes`
--

INSERT INTO `document_ventes` (`id`, `status`, `customer_id`, `number`, `paid`, `checkout`, `payment_type`, `received_at`, `comment`, `user_id`, `update_user_id`, `created_at`, `updated_at`) VALUES
(1, 3, '1', '7917191', '0.00', '58980.00', 2, '2022-10-18 10:34:11', NULL, 5, 5, '2022-10-18 08:30:57', '2022-10-18 08:43:34'),
(2, 3, '1', '7917191', '0.00', '58980.00', 2, '2022-10-18 10:34:11', NULL, 5, NULL, '2022-10-18 08:40:57', '2022-10-18 08:43:34'),
(3, 3, '1', '7917191', '0.00', '58980.00', 2, '2022-10-18 10:34:11', NULL, 5, NULL, '2022-10-18 08:43:34', '2022-10-18 08:43:34'),
(4, 2, '0', '7959338', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 08:50:24', '2022-10-18 08:50:24'),
(5, 1, '1', '3418867', '58980.00', '0.00', 1, '2022-10-18 10:55:38', NULL, 5, 5, '2022-10-18 08:51:42', '2022-10-18 08:56:37'),
(6, 2, '0', '8530080', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 09:33:00', '2022-10-18 09:33:00'),
(7, 2, '0', '5089925', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 09:59:48', '2022-10-18 09:59:48'),
(8, 2, '0', '7587003', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 12:09:56', '2022-10-18 12:09:56'),
(9, 2, '1', '7085862', NULL, NULL, NULL, '2022-10-18 14:22:49', NULL, 5, NULL, '2022-10-18 12:17:01', '2022-10-18 12:22:49'),
(10, 1, '1', '5138533', '0.00', '159120.00', 1, '2022-10-18 14:35:28', NULL, 5, 5, '2022-10-18 12:33:43', '2022-10-18 13:05:35'),
(11, 1, '1', '6360941', '123900.00', '0.00', 3, '2022-10-18 14:38:57', NULL, 5, 5, '2022-10-18 12:37:55', '2022-10-18 13:05:15'),
(12, 1, '1', '8580099', '0.00', '17700.00', 1, '2022-10-18 14:40:54', NULL, 5, 5, '2022-10-18 12:40:29', '2022-10-18 12:42:32'),
(13, 1, '1', '1492367', '15300.00', '0.00', 3, '2022-10-18 14:50:34', NULL, 5, 5, '2022-10-18 12:50:18', '2022-10-18 13:03:50'),
(14, 1, '1', '1813395', '177000.00', '0.00', 2, '2022-10-19 14:52:16', NULL, 5, 5, '2022-10-18 12:51:57', '2022-10-18 13:03:38'),
(15, 2, '0', '2829329', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 13:19:39', '2022-10-18 13:19:39'),
(16, 2, '0', '7442134', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 13:20:02', '2022-10-18 13:20:02'),
(17, 2, '0', '6953103', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 13:21:39', '2022-10-18 13:21:39'),
(18, 4, '1', '3606188', NULL, NULL, NULL, '2022-10-18 15:24:03', NULL, 5, NULL, '2022-10-18 13:22:47', '2022-10-18 13:24:58'),
(19, 2, '0', '9101198', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 13:28:05', '2022-10-18 13:28:05'),
(20, 2, '0', '6867850', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 13:32:03', '2022-10-18 13:32:03'),
(21, 2, '0', '8559234', NULL, NULL, NULL, NULL, NULL, 5, NULL, '2022-10-18 14:06:31', '2022-10-18 14:06:31'),
(22, 4, '1', '3797941', NULL, NULL, NULL, '2022-10-19 10:51:20', NULL, 5, NULL, '2022-10-19 08:50:04', '2022-10-19 08:51:43'),
(23, 4, '1', '4462122', NULL, NULL, NULL, '2022-10-19 10:53:59', NULL, 5, NULL, '2022-10-19 08:53:21', '2022-10-19 08:55:14'),
(24, 2, '1', '4268815', NULL, NULL, NULL, '2022-10-19 14:50:24', NULL, 19, NULL, '2022-10-19 12:45:36', '2022-10-19 12:50:24'),
(25, 2, '1', '1577823', NULL, NULL, NULL, '2022-10-19 19:57:16', NULL, 19, NULL, '2022-10-19 17:50:40', '2022-10-19 17:57:16'),
(26, 2, '1', '8853009', NULL, NULL, NULL, '2022-10-20 09:26:01', NULL, 5, NULL, '2022-10-20 07:24:45', '2022-10-20 07:26:01');

-- --------------------------------------------------------

--
-- Structure de la table `emballages`
--

DROP TABLE IF EXISTS `emballages`;
CREATE TABLE IF NOT EXISTS `emballages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(20,2) NOT NULL COMMENT 'Prix unitaire de vente',
  `buying_price` decimal(20,2) NOT NULL COMMENT 'prix d''achat',
  `content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL,
  `simpleOrGroup` tinyint(1) NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emballages`
--

INSERT INTO `emballages` (`id`, `reference`, `designation`, `price`, `buying_price`, `content_id`, `quantity`, `simpleOrGroup`, `note`, `user_id`, `update_user_id`, `created_at`, `updated_at`) VALUES
(52, '26435', 'CONSI STAR 65 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:38:12', '2022-10-08 08:13:39'),
(53, '73844', 'CONSI STAR  100 CL', '700.00', '700.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:38:37', '2022-10-08 08:09:27'),
(54, '43284', 'CONSI STAR 30 CL', '400.00', '400.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:38:52', '2022-10-08 08:09:54'),
(55, '15029', 'CONSI CGT STAR DE 24', '8000.00', '8000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:39:09', '2022-10-08 08:58:05'),
(56, '49664', 'CONSI DZAMA VIS 100 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:39:35', '2022-10-08 08:10:20'),
(57, '36334', 'CONSI DZAMA VIS 50 CL', '960.00', '960.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:40:03', '2022-10-08 08:10:42'),
(58, '31519', 'CONSI DZAMA ICE 35 CL', '840.00', '840.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:40:17', '2022-10-08 08:11:08'),
(59, '15014', 'CONSI ANITA 100 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:40:34', '2022-10-08 08:11:40'),
(60, '39103', 'CONSI ANITA 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:41:01', '2022-10-08 08:12:40'),
(61, '57855', 'CONSI CARA 120 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:41:24', '2022-10-08 08:12:01'),
(62, '43313', 'CONSI CARA 60 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:41:44', '2022-10-08 08:13:08'),
(63, '11983', 'CONSI DZ CARRE 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:42:02', '2022-10-08 08:05:49'),
(64, '53300', 'CONSI DZ CARRE 35 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:42:26', '2022-10-08 08:06:17'),
(65, '77033', 'CONSI CARA 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:42:43', '2022-10-08 08:06:40'),
(66, '52004', 'CONSI CASTEL ECOVA 35 CL', '0.00', '0.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:43:02', '2022-10-08 08:07:07'),
(67, '61562', 'CONSI RN7 75 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:43:36', '2022-10-08 08:07:35'),
(68, '24655', 'CONSI CGT DZAMA DE 24', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:45:10', '2022-10-08 08:57:37'),
(69, '90267', 'CONSI CGT DZAMA DE 12', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:45:23', '2022-10-08 08:57:09'),
(70, '93622', 'CONSI COM 100 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:45:57', '2022-10-08 08:08:00'),
(71, '35705', 'CONSI COM 70 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:46:33', '2022-10-08 08:08:26'),
(72, '59347', 'CONSI COM 35 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:46:50', '2022-10-08 08:09:03'),
(73, '60934', 'CONSI JOHN 70 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:47:07', '2022-10-08 08:00:56'),
(74, '21479', 'CONSI CGT COMADIS DE 12', '6500.00', '6500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:48:12', '2022-10-08 08:56:48'),
(75, '70856', 'CONSI CGT COMADIS DE 24', '6500.00', '6500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:48:22', '2022-10-08 08:56:25'),
(76, '96448', 'CONSI ETOILE 100 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:48:49', '2022-10-08 08:01:41'),
(77, '33639', 'CONSI GRAYS 100 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:49:14', '2022-10-08 08:02:02'),
(78, '84592', 'CONSI SODEAM 33 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:49:35', '2022-10-08 08:02:27'),
(79, '58188', 'CONSI SODEAM 37,5 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:49:55', '2022-10-08 08:02:49'),
(80, '38359', 'CONSI SODEAM 150 CL', '3000.00', '3000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:50:12', '2022-10-08 08:03:13'),
(81, '76956', 'CONSI ECO VERT 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:50:29', '2022-10-08 08:04:29'),
(82, '37993', 'CONSI ECO BLANC 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:50:47', '2022-10-08 08:05:20'),
(83, '80303', 'CONSI PRADO 100 CL', '1600.00', '1600.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:51:03', '2022-10-08 07:53:22'),
(84, '90938', 'CONSI PRADO 50 CL', '0.00', '0.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:51:16', '2022-10-08 07:54:33'),
(85, '26512', 'CONSI ROXY 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:51:41', '2022-10-08 07:54:59'),
(86, '61428', 'CONSI TALON 70 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:52:10', '2022-10-08 07:56:43'),
(87, '35818', 'CONSI TALON 35 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:52:21', '2022-10-08 07:58:33'),
(88, '50733', 'CONSI MGTAN 70 CL', '3200.00', '3200.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:52:44', '2022-10-08 07:58:58'),
(89, '79698', 'CONSI MGTAN 35 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:53:18', '2022-10-08 07:59:24'),
(90, '13250', 'CONSI GOLDEN 70 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:53:37', '2022-10-08 08:00:05'),
(91, '46738', 'CONSI GIN 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:53:56', '2022-10-08 08:00:29'),
(92, '26599', 'CONSI TEQUILA', '3000.00', '3000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:54:22', '2022-10-08 07:53:57'),
(93, '66657', 'CONSI DARBEL 100 CL', '1800.00', '1800.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:54:38', '2022-10-08 07:49:50'),
(94, '45383', 'CONSI CGT SODEAM', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:54:57', '2022-10-08 07:50:11'),
(95, '65450', 'CONSI ROYAL 150 CL', '1200.00', '1200.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:55:15', '2022-10-08 07:50:33'),
(96, '73556', 'CONSI ROYAL BLANC 70 CL', '1200.00', '1200.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:55:32', '2022-10-08 07:52:00'),
(97, '11438', 'CONSI ROYAL BLANC 35 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:55:51', '2022-10-08 07:52:31'),
(98, '84238', 'CONSI ROYAL VERT 35 CL', '1200.00', '1200.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:56:55', '2022-10-08 07:52:57'),
(99, '23222', 'CONSI ETERIA 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:57:11', '2022-10-08 07:46:26'),
(100, '64945', 'CONSI ETERIA 35 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:57:29', '2022-10-08 07:46:00'),
(101, '23868', 'CONSI PASTAGA 100 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:57:50', '2022-10-08 07:45:12'),
(102, '65773', 'CONSI ANKARANA 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:58:06', '2022-10-08 07:44:21'),
(103, '56169', 'CONSI FUT 250 L', '300000.00', '300000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:58:25', '2022-10-08 07:24:58'),
(104, '34156', 'CONSI CGT STAR DE 20', '8000.00', '8000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:59:34', '2022-10-08 08:56:04'),
(105, '27036', 'CONSI CGT STAR DE 12', '8000.00', '8000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 07:59:50', '2022-10-08 08:55:43'),
(106, '72630', 'CONSI SCANLAN 70 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 12:22:45', '2022-10-08 07:23:29'),
(107, '32019', 'CONSI ROYAL VERT 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 12:36:15', '2022-10-08 07:22:54'),
(108, '69629', 'CONSI CGT SODEAM DE 12', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 13:58:08', '2022-10-08 08:55:20'),
(109, '30799', 'CONSI CGT SODEAM DE 24', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 13:58:19', '2022-10-08 08:54:59'),
(110, '96322', 'CONSI CGT SODEAM DE 30', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-04 13:58:40', '2022-10-08 08:54:36'),
(111, '81975', 'CONSI LONNECK', '500.00', '500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-05 09:45:28', '2022-10-08 07:22:16'),
(112, '60354', 'CONSI ECO BLANC', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-05 09:55:56', '2022-10-07 13:43:33'),
(113, '94503', 'AVOIR STAR 65 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:17:53', '2022-10-08 08:17:53'),
(114, '79426', 'AVOIR STAR  100 CL', '700.00', '700.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:18:24', '2022-10-08 08:18:24'),
(115, '46001', 'AVOIR STAR 30 CL', '400.00', '400.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:18:54', '2022-10-08 08:18:54'),
(116, '75636', 'VOIR CGT STAR DE 24', '8000.00', '8000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:19:36', '2022-10-08 08:53:51'),
(117, '11879', 'AVOIR DZAMA VIS 100 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:19:59', '2022-10-08 08:19:59'),
(118, '47251', 'AVOIR DZAMA VIS 50 CL', '960.00', '960.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:20:27', '2022-10-08 08:20:27'),
(119, '42676', 'AVOIR DZAMA ICE 35 CL', '840.00', '840.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:20:53', '2022-10-08 08:20:53'),
(120, '80698', 'AVOIR ANITA 100 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:21:18', '2022-10-08 08:21:18'),
(121, '19460', 'AVOIR ANITA 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:21:44', '2022-10-08 08:21:44'),
(122, '99960', 'AVOIR CARA 120 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:22:10', '2022-10-08 08:22:10'),
(123, '83678', 'AVOIR CARA 60 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:22:41', '2022-10-08 08:22:41'),
(124, '63047', 'AVOIR DZ CARRE 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:23:11', '2022-10-08 08:23:11'),
(125, '69330', 'AVOIR DZ CARRE 35 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:23:40', '2022-10-08 08:23:40'),
(126, '16607', 'AVOIR CARA 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:24:07', '2022-10-08 08:24:07'),
(127, '97010', 'AVOIR RN7 75 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:24:37', '2022-10-08 08:24:37'),
(128, '63650', 'AVOIR CGT DZAMA 24', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:25:30', '2022-10-08 08:53:13'),
(129, '99289', 'AVOIR COM 100 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:25:56', '2022-10-08 08:25:56'),
(130, '61118', 'AVOIR COM 70 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:26:20', '2022-10-08 08:26:20'),
(131, '35740', 'AVOIR COM 35 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:26:44', '2022-10-08 08:26:44'),
(132, '73245', 'AVOIR JOHN 70 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:27:11', '2022-10-08 08:27:11'),
(133, '83430', 'AVOIR CGT COM 24', '6500.00', '6500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:27:51', '2022-10-08 08:52:03'),
(134, '19742', 'AVOIR ETOILE 100 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:28:17', '2022-10-08 08:28:17'),
(135, '23388', 'AVOIR GRAYS 100 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:28:41', '2022-10-08 08:28:41'),
(136, '52206', 'AVOIR SODEAM 33 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:29:05', '2022-10-08 08:29:05'),
(137, '72758', 'AVOIR SODEAM 37,5 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:29:37', '2022-10-08 08:29:37'),
(138, '53350', 'AVOIR SODEAM 150 CL', '3000.00', '3000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:30:17', '2022-10-08 08:30:17'),
(139, '18535', 'AVOIR ECO VERT 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:30:47', '2022-10-08 08:30:47'),
(140, '83655', 'AVOIR ECO BLANC 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:31:14', '2022-10-08 08:31:14'),
(141, '40091', 'AVOIR PRADO 100 CL', '1600.00', '1600.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:31:38', '2022-10-08 08:31:38'),
(142, '43289', 'AVOIR ROXY 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:32:07', '2022-10-08 08:32:07'),
(143, '92693', 'AVOIR PRADO 50 CL', '800.00', '800.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:32:44', '2022-10-08 08:32:44'),
(144, '98008', 'AVOIR TALON 70 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:33:40', '2022-10-08 08:33:40'),
(145, '61017', 'AVOIR TALON 35 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:34:10', '2022-10-08 08:34:10'),
(146, '35037', 'AVOIR MGTAN 70 CL', '3200.00', '3200.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:34:37', '2022-10-08 08:34:37'),
(147, '36250', 'AVOIR MGTAN 35 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:35:06', '2022-10-08 08:35:06'),
(148, '45485', 'AVOIR GOLDEN 70 CL', '2500.00', '2500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:35:31', '2022-10-08 08:35:31'),
(149, '16030', 'AVOIR GIN 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:35:59', '2022-10-08 08:35:59'),
(150, '22113', 'AVOIR TEQUILA', '3000.00', '3000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:36:23', '2022-10-08 08:36:23'),
(151, '54790', 'AVOIR DARBEL 100 CL', '1800.00', '1800.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:36:47', '2022-10-08 08:36:47'),
(152, '82252', 'AVOIR CGT SODEAM 24', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:37:28', '2022-10-08 08:37:28'),
(153, '25764', 'AVOIR ROYAL 150 CL', '1200.00', '1200.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:37:57', '2022-10-08 08:37:57'),
(154, '52865', 'AVOIR ROYAL BLANC 70 CL', '1200.00', '1200.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:38:22', '2022-10-08 08:38:22'),
(155, '75131', 'AVOIR ROYAL BLANC 35 CL', '500.00', '500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:38:51', '2022-10-08 08:38:51'),
(156, '94811', 'AVOIR ROYAL VERT  70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:39:16', '2022-10-08 08:39:16'),
(157, '78132', 'AVOIR ROYAL VERT 35 CL', '1200.00', '1200.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:39:40', '2022-10-08 08:39:40'),
(158, '21707', 'AVOIR ETERIA 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:40:04', '2022-10-08 08:40:04'),
(159, '41436', 'AVOIR ETERIA 35 CL', '1500.00', '1500.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:40:28', '2022-10-08 08:40:28'),
(160, '13778', 'AVOIR PASTAGA 100 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:40:54', '2022-10-08 08:40:54'),
(161, '78673', 'AVOIR ANKARANA 70 CL', '2000.00', '2000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:41:19', '2022-10-08 08:41:19'),
(162, '66039', 'AVOIR FUT 250 L', '300000.00', '300000.00', NULL, 0, 0, NULL, 5, NULL, '2022-10-08 08:41:49', '2022-10-08 08:41:49'),
(163, '86659', 'AVOIR CGT STAR DE 20', '8000.00', '8000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:42:59', '2022-10-08 08:51:35'),
(164, '33686', 'AVOIR CGT STAR DE 12', '8000.00', '8000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:43:24', '2022-10-08 08:51:13'),
(165, '45311', 'AVOIR CGT COM 12', '6500.00', '6500.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:44:04', '2022-10-08 08:50:53'),
(166, '47030', 'AVOIR CGT SODEAM DE 12', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:45:17', '2022-10-08 08:50:25'),
(167, '67063', 'AVOIR CGT SODEAM DE 30', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:45:30', '2022-10-08 08:49:45'),
(168, '43498', 'AVOIR CGT SODEAM DE 24', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:46:43', '2022-10-08 08:49:23'),
(169, '23862', 'AOIR CGT DZAMA DE 24', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:47:36', '2022-10-08 08:48:56'),
(170, '21346', 'AVOIR CGT DZAMA DE 12', '5000.00', '5000.00', NULL, 0, 0, NULL, 5, 5, '2022-10-08 08:47:53', '2022-10-08 08:48:34');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
CREATE TABLE IF NOT EXISTS `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `article_reference` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `article_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `real_quantity` decimal(11,2) NOT NULL COMMENT 'quantité réelle',
  `difference` decimal(11,2) NOT NULL,
  `motif` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inventories`
--

INSERT INTO `inventories` (`id`, `unique_id`, `status`, `article_reference`, `article_id`, `article_type`, `date`, `real_quantity`, `difference`, `motif`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '85683117', 2, 865379, 498, 'App\\Models\\Product', '2022-10-20', '1.00', '-7.00', 'VERY', 5, '2022-10-20 07:53:53', '2022-10-20 07:53:53'),
(2, '27084802', 1, 915551, 502, 'App\\Models\\Product', '2022-10-20', '100.00', '-371.00', 'DDSD', 5, '2022-10-20 08:08:52', '2022-10-20 08:09:57');

-- --------------------------------------------------------

--
-- Structure de la table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT '0',
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `model_type` int(11) NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_update_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2022_05_15_215846_create_suppliers_table', 2),
(12, '2022_05_17_094634_create_customers_table', 4),
(17, '2022_05_18_171358_create_articles_table', 7),
(14, '2022_05_19_162956_create_categories_table', 5),
(15, '2022_05_19_163035_create_articles_categories_table', 5),
(16, '2022_05_23_143237_create_invoices_table', 6),
(32, '2022_05_17_081237_create_products_table', 7),
(33, '2022_06_05_153232_create_packages_table', 8),
(34, '2022_06_07_083558_create_emballages_table', 9),
(48, '2022_06_07_164722_create_document_achats_table', 18),
(105, '2022_08_27_231349_create_inventories_table', 32),
(104, '2022_06_08_161338_create_stocks_table', 32),
(38, '2022_06_11_223041_create_document_ventes_table', 13),
(42, '2022_06_11_220107_create_sales_table', 12),
(100, '2022_06_22_095804_create_pricing_supliers_table', 31),
(47, '2022_06_23_071748_create_supplier_orders_table', 17),
(62, '2022_08_28_192515_add_adjustment_column_sup_orders', 21),
(66, '2022_08_29_091835_create_settings_table', 22),
(72, '2022_09_02_225536_add_column_to_product', 23),
(74, '2022_09_05_121124_add_action_type_to_sale', 24),
(77, '2022_09_07_095330_drop_rest_from_doc_sales', 25),
(81, '2022_09_08_170917_add_sale_status_column', 27),
(106, '2022_09_12_004349_add_is_adjustment_col_to_stock', 33),
(91, '2022_09_16_223346_create_permission_tables', 29),
(99, '2022_09_24_224640_add_out_collumn_to_inventory', 30),
(114, '2022_09_26_103845_add_purchase_order_col_to_stock', 34),
(115, '2022_09_27_092443_add_buying_price_to_product', 34),
(119, '2022_09_27_092507_add_buying_price_to_emballage', 35),
(123, '2022_10_04_221331_change_price_type_product', 36),
(124, '2022_10_04_221702_change_price_type_emballage', 36),
(125, '2022_10_04_222107_change_money_type', 36),
(126, '2022_10_10_095021_change_qty_col_to_inventory', 37),
(127, '2022_10_10_095327_change_qty_col_to_sales', 37),
(128, '2022_10_10_095940_change_qty_col_to_stock', 37);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 8),
(1, 'App\\Models\\User', 12),
(1, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 16),
(1, 'App\\Models\\User', 17),
(1, 'App\\Models\\User', 19),
(1, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 19),
(4, 'App\\Models\\User', 20),
(5, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 14),
(5, 'App\\Models\\User', 19),
(5, 'App\\Models\\User', 20),
(6, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 5),
(6, 'App\\Models\\User', 8),
(6, 'App\\Models\\User', 14),
(6, 'App\\Models\\User', 19),
(6, 'App\\Models\\User', 20),
(7, 'App\\Models\\User', 2),
(7, 'App\\Models\\User', 3),
(7, 'App\\Models\\User', 4),
(7, 'App\\Models\\User', 5),
(7, 'App\\Models\\User', 7),
(7, 'App\\Models\\User', 8),
(7, 'App\\Models\\User', 11),
(7, 'App\\Models\\User', 12),
(7, 'App\\Models\\User', 14),
(7, 'App\\Models\\User', 15),
(7, 'App\\Models\\User', 16),
(7, 'App\\Models\\User', 17),
(7, 'App\\Models\\User', 18),
(7, 'App\\Models\\User', 19),
(7, 'App\\Models\\User', 20),
(8, 'App\\Models\\User', 4),
(8, 'App\\Models\\User', 5),
(8, 'App\\Models\\User', 8),
(8, 'App\\Models\\User', 14),
(8, 'App\\Models\\User', 19),
(8, 'App\\Models\\User', 20),
(9, 'App\\Models\\User', 4),
(9, 'App\\Models\\User', 5),
(9, 'App\\Models\\User', 8),
(9, 'App\\Models\\User', 14),
(9, 'App\\Models\\User', 19),
(9, 'App\\Models\\User', 20),
(10, 'App\\Models\\User', 4),
(10, 'App\\Models\\User', 5),
(10, 'App\\Models\\User', 8),
(10, 'App\\Models\\User', 14),
(10, 'App\\Models\\User', 19),
(10, 'App\\Models\\User', 20),
(11, 'App\\Models\\User', 4),
(11, 'App\\Models\\User', 5),
(11, 'App\\Models\\User', 8),
(11, 'App\\Models\\User', 14),
(11, 'App\\Models\\User', 19),
(11, 'App\\Models\\User', 20),
(12, 'App\\Models\\User', 4),
(12, 'App\\Models\\User', 5),
(12, 'App\\Models\\User', 8),
(12, 'App\\Models\\User', 14),
(12, 'App\\Models\\User', 19),
(12, 'App\\Models\\User', 20),
(13, 'App\\Models\\User', 4),
(13, 'App\\Models\\User', 5),
(13, 'App\\Models\\User', 8),
(13, 'App\\Models\\User', 14),
(13, 'App\\Models\\User', 19),
(13, 'App\\Models\\User', 20),
(14, 'App\\Models\\User', 4),
(14, 'App\\Models\\User', 5),
(14, 'App\\Models\\User', 8),
(14, 'App\\Models\\User', 14),
(14, 'App\\Models\\User', 19),
(14, 'App\\Models\\User', 20),
(15, 'App\\Models\\User', 2),
(15, 'App\\Models\\User', 3),
(15, 'App\\Models\\User', 4),
(15, 'App\\Models\\User', 5),
(15, 'App\\Models\\User', 7),
(15, 'App\\Models\\User', 8),
(15, 'App\\Models\\User', 14),
(15, 'App\\Models\\User', 15),
(15, 'App\\Models\\User', 16),
(15, 'App\\Models\\User', 19),
(15, 'App\\Models\\User', 20),
(16, 'App\\Models\\User', 4),
(16, 'App\\Models\\User', 5),
(16, 'App\\Models\\User', 8),
(16, 'App\\Models\\User', 14),
(16, 'App\\Models\\User', 19),
(16, 'App\\Models\\User', 20),
(17, 'App\\Models\\User', 4),
(17, 'App\\Models\\User', 5),
(17, 'App\\Models\\User', 8),
(17, 'App\\Models\\User', 14),
(17, 'App\\Models\\User', 19),
(17, 'App\\Models\\User', 20),
(18, 'App\\Models\\User', 4),
(18, 'App\\Models\\User', 5),
(18, 'App\\Models\\User', 8),
(18, 'App\\Models\\User', 11),
(18, 'App\\Models\\User', 14),
(18, 'App\\Models\\User', 18),
(18, 'App\\Models\\User', 19),
(18, 'App\\Models\\User', 20),
(19, 'App\\Models\\User', 4),
(19, 'App\\Models\\User', 5),
(19, 'App\\Models\\User', 8),
(19, 'App\\Models\\User', 14),
(19, 'App\\Models\\User', 19),
(19, 'App\\Models\\User', 20),
(20, 'App\\Models\\User', 4),
(20, 'App\\Models\\User', 5),
(20, 'App\\Models\\User', 8),
(20, 'App\\Models\\User', 14),
(20, 'App\\Models\\User', 19),
(20, 'App\\Models\\User', 20),
(21, 'App\\Models\\User', 4),
(21, 'App\\Models\\User', 5),
(21, 'App\\Models\\User', 8),
(21, 'App\\Models\\User', 12),
(21, 'App\\Models\\User', 14),
(21, 'App\\Models\\User', 17),
(21, 'App\\Models\\User', 19),
(21, 'App\\Models\\User', 20),
(22, 'App\\Models\\User', 4),
(22, 'App\\Models\\User', 5),
(22, 'App\\Models\\User', 8),
(22, 'App\\Models\\User', 14),
(22, 'App\\Models\\User', 19),
(22, 'App\\Models\\User', 20),
(23, 'App\\Models\\User', 2),
(23, 'App\\Models\\User', 3),
(23, 'App\\Models\\User', 4),
(23, 'App\\Models\\User', 5),
(23, 'App\\Models\\User', 7),
(23, 'App\\Models\\User', 8),
(23, 'App\\Models\\User', 11),
(23, 'App\\Models\\User', 12),
(23, 'App\\Models\\User', 14),
(23, 'App\\Models\\User', 15),
(23, 'App\\Models\\User', 16),
(23, 'App\\Models\\User', 17),
(23, 'App\\Models\\User', 18),
(23, 'App\\Models\\User', 19),
(23, 'App\\Models\\User', 20),
(24, 'App\\Models\\User', 4),
(24, 'App\\Models\\User', 5),
(24, 'App\\Models\\User', 8),
(24, 'App\\Models\\User', 12),
(24, 'App\\Models\\User', 14),
(24, 'App\\Models\\User', 17),
(24, 'App\\Models\\User', 19),
(24, 'App\\Models\\User', 20),
(25, 'App\\Models\\User', 4),
(25, 'App\\Models\\User', 5),
(25, 'App\\Models\\User', 8),
(25, 'App\\Models\\User', 14),
(25, 'App\\Models\\User', 19),
(25, 'App\\Models\\User', 20),
(26, 'App\\Models\\User', 4),
(26, 'App\\Models\\User', 5),
(26, 'App\\Models\\User', 8),
(26, 'App\\Models\\User', 11),
(26, 'App\\Models\\User', 14),
(26, 'App\\Models\\User', 18),
(26, 'App\\Models\\User', 19),
(26, 'App\\Models\\User', 20),
(27, 'App\\Models\\User', 4),
(27, 'App\\Models\\User', 5),
(27, 'App\\Models\\User', 8),
(27, 'App\\Models\\User', 12),
(27, 'App\\Models\\User', 14),
(27, 'App\\Models\\User', 17),
(27, 'App\\Models\\User', 19),
(27, 'App\\Models\\User', 20),
(28, 'App\\Models\\User', 4),
(28, 'App\\Models\\User', 5),
(28, 'App\\Models\\User', 8),
(28, 'App\\Models\\User', 11),
(28, 'App\\Models\\User', 14),
(28, 'App\\Models\\User', 18),
(28, 'App\\Models\\User', 19),
(28, 'App\\Models\\User', 20),
(29, 'App\\Models\\User', 4),
(29, 'App\\Models\\User', 5),
(29, 'App\\Models\\User', 8),
(29, 'App\\Models\\User', 11),
(29, 'App\\Models\\User', 14),
(29, 'App\\Models\\User', 18),
(29, 'App\\Models\\User', 19),
(29, 'App\\Models\\User', 20),
(30, 'App\\Models\\User', 4),
(30, 'App\\Models\\User', 5),
(30, 'App\\Models\\User', 8),
(30, 'App\\Models\\User', 14),
(30, 'App\\Models\\User', 19),
(30, 'App\\Models\\User', 20),
(31, 'App\\Models\\User', 4),
(31, 'App\\Models\\User', 5),
(31, 'App\\Models\\User', 8),
(31, 'App\\Models\\User', 11),
(31, 'App\\Models\\User', 14),
(31, 'App\\Models\\User', 18),
(31, 'App\\Models\\User', 19),
(31, 'App\\Models\\User', 20),
(32, 'App\\Models\\User', 4),
(32, 'App\\Models\\User', 5),
(32, 'App\\Models\\User', 8),
(32, 'App\\Models\\User', 11),
(32, 'App\\Models\\User', 14),
(32, 'App\\Models\\User', 18),
(32, 'App\\Models\\User', 19),
(32, 'App\\Models\\User', 20),
(33, 'App\\Models\\User', 5),
(33, 'App\\Models\\User', 12),
(33, 'App\\Models\\User', 15),
(33, 'App\\Models\\User', 16),
(33, 'App\\Models\\User', 17),
(33, 'App\\Models\\User', 19),
(33, 'App\\Models\\User', 20);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 17),
(4, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 18);

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `contenance` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL COMMENT 'Prix de vente, pris de gros',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_customer', 'web', '2022-10-03 20:56:15', '2022-10-03 20:56:15'),
(2, 'create_customer', 'web', '2022-10-03 20:56:15', '2022-10-03 20:56:15'),
(3, 'update_customer', 'web', '2022-10-03 20:56:15', '2022-10-03 20:56:15'),
(4, 'view all', 'web', '2022-10-03 20:56:16', '2022-10-03 20:56:16'),
(5, 'create user', 'web', '2022-10-03 20:56:16', '2022-10-03 20:56:16'),
(6, 'create emballage', 'web', '2022-10-03 20:56:16', '2022-10-03 20:56:16'),
(7, 'view article', 'web', '2022-10-03 20:56:16', '2022-10-03 20:56:16'),
(8, 'create article', 'web', '2022-10-03 20:56:17', '2022-10-03 20:56:17'),
(9, 'edit article', 'web', '2022-10-03 20:56:17', '2022-10-03 20:56:17'),
(10, 'update article', 'web', '2022-10-03 20:56:17', '2022-10-03 20:56:17'),
(11, 'delete article', 'web', '2022-10-03 20:56:17', '2022-10-03 20:56:17'),
(12, 'edit articles', 'web', '2022-10-03 20:56:17', '2022-10-03 20:56:17'),
(13, 'edit selling price', 'web', '2022-10-03 20:56:18', '2022-10-03 20:56:18'),
(14, 'edit sales', 'web', '2022-10-03 20:56:18', '2022-10-03 20:56:18'),
(15, 'make sale', 'web', '2022-10-03 20:56:18', '2022-10-03 20:56:18'),
(16, 'delete articles', 'web', '2022-10-03 20:56:18', '2022-10-03 20:56:18'),
(17, 'cancel sales', 'web', '2022-10-03 20:56:18', '2022-10-03 20:56:18'),
(18, 'make inventory', 'web', '2022-10-03 20:56:19', '2022-10-03 20:56:19'),
(19, 'valid inventory', 'web', '2022-10-03 20:56:19', '2022-10-03 20:56:19'),
(20, 'delete one line article', 'web', '2022-10-03 20:56:19', '2022-10-03 20:56:19'),
(21, 'make payment', 'web', '2022-10-03 20:56:19', '2022-10-03 20:56:19'),
(22, 'print sale invoice', 'web', '2022-10-03 20:56:19', '2022-10-03 20:56:19'),
(23, 'view stock', 'web', '2022-10-03 20:56:19', '2022-10-03 20:56:19'),
(24, 'view dashboard', 'web', '2022-10-03 20:56:20', '2022-10-03 20:56:20'),
(25, 'view articles', 'web', '2022-10-03 20:56:20', '2022-10-03 20:56:20'),
(26, 'view inventory', 'web', '2022-10-03 20:56:20', '2022-10-03 20:56:20'),
(27, 'print sale', 'web', '2022-10-03 20:56:20', '2022-10-03 20:56:20'),
(28, 'enter_stock', 'web', '2022-10-03 20:56:21', '2022-10-03 20:56:21'),
(29, 'out_stock', 'web', '2022-10-03 20:56:21', '2022-10-03 20:56:21'),
(30, 'valid_stock', 'web', '2022-10-03 20:56:21', '2022-10-03 20:56:21'),
(31, 'print_stock', 'web', '2022-10-03 20:56:21', '2022-10-03 20:56:21'),
(32, 'view_intern_doc', 'web', '2022-10-03 22:14:11', '2022-10-03 22:14:11'),
(33, 'view sale', 'web', '2022-10-16 23:42:38', '2022-10-16 23:42:38');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pricing_supliers`
--

DROP TABLE IF EXISTS `pricing_supliers`;
CREATE TABLE IF NOT EXISTS `pricing_supliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `article_reference` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `article_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buying_price` decimal(8,2) NOT NULL COMMENT 'prix d''achat',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(20,2) NOT NULL COMMENT 'Prix unitaire de vente',
  `wholesale_price` decimal(20,2) NOT NULL COMMENT 'Prix de gros',
  `buying_price` decimal(20,2) NOT NULL COMMENT 'prix d''achat',
  `unity` int(11) NOT NULL,
  `package_type` int(11) NOT NULL COMMENT 'Type de Collisage D''Article',
  `contenance` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Nombre de colisage',
  `condition` bigint(20) UNSIGNED DEFAULT NULL,
  `simple_package_id` bigint(20) DEFAULT NULL,
  `big_package_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=580 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `reference`, `designation`, `price`, `wholesale_price`, `buying_price`, `unity`, `package_type`, `contenance`, `condition`, `simple_package_id`, `big_package_id`, `category_id`, `note`, `user_id`, `update_user_id`, `created_at`, `updated_at`) VALUES
(271, '370019', 'STAR THB 65 CL', '2920.00', '2920.00', '2781.00', 1, 1, 20, NULL, 52, NULL, 15, NULL, 5, NULL, '2022-10-04 08:02:19', '2022-10-04 08:02:19'),
(272, '432782', 'STAR THB 30 CL', '1890.00', '1890.00', '1796.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-04 08:03:20', '2022-10-04 08:03:20'),
(273, '409414', 'STAR THB CAN 50 CL', '3700.00', '3700.00', '3520.00', 1, 1, 24, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-04 08:04:07', '2022-10-04 08:04:07'),
(274, '770432', 'STAR THB CAN 33 CL', '2760.00', '2760.00', '2624.00', 1, 3, 24, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-04 08:05:10', '2022-10-04 08:05:10'),
(275, '465246', 'STAR QUEENS 65 CL', '2680.00', '2680.00', '2556.00', 1, 1, 20, NULL, 52, NULL, 15, NULL, 5, NULL, '2022-10-04 08:05:58', '2022-10-04 08:05:58'),
(276, '287319', 'STAR FRESH 65 CL', '2320.00', '2320.00', '2210.00', 1, 1, 20, NULL, 52, NULL, 15, NULL, 5, NULL, '2022-10-04 08:07:19', '2022-10-04 08:07:19'),
(277, '180249', 'STAR GOLD 50 CL', '2840.00', '2840.00', '2700.00', 1, 1, 20, NULL, 52, NULL, 15, NULL, 5, NULL, '2022-10-04 08:07:55', '2022-10-04 08:07:55'),
(278, '877908', 'STAR GOLD 8 % 50 CL', '2680.00', '2680.00', '2530.00', 1, 1, 20, NULL, 52, NULL, 15, NULL, 5, NULL, '2022-10-04 08:08:43', '2022-10-04 08:08:43'),
(279, '678180', 'STAR GOLD BLANCE 50 CL', '2840.00', '2840.00', '2700.00', 1, 2, 20, NULL, 52, NULL, 15, NULL, 5, NULL, '2022-10-04 08:09:25', '2022-10-04 08:09:25'),
(280, '767710', 'STAR GOLD BANCHE 30 CL', '1980.00', '1980.00', '1884.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-04 08:10:09', '2022-10-04 08:10:09'),
(281, '912406', 'STAR GOLD BANCHE CANETTE 50 CL', '3940.00', '3940.00', '3720.00', 1, 3, 24, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-04 08:11:02', '2022-10-04 08:11:02'),
(282, '255807', 'STAR BEAUFORT 30 CL', '2680.00', '2680.00', '2530.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-04 08:11:43', '2022-10-04 08:11:43'),
(283, '260909', 'STAR BEAUFORT CAN 50 CL', '4720.00', '4720.00', '4450.00', 1, 3, 24, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-04 08:12:22', '2022-10-04 08:12:22'),
(284, '596186', 'STAR BOOSTER 30 CL', '1800.00', '1800.00', '1610.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, 5, '2022-10-04 08:13:03', '2022-10-07 07:14:40'),
(285, '299891', 'STAR CHILL 50 CL', '2200.00', '2200.00', '2100.00', 1, 1, 24, NULL, 52, NULL, 15, NULL, 5, NULL, '2022-10-04 08:14:40', '2022-10-04 08:14:40'),
(286, '876605', 'STAR COCA 100 CL', '2700.00', '2700.00', '2540.00', 1, 1, 12, NULL, 53, NULL, 15, NULL, 5, 5, '2022-10-04 08:15:31', '2022-10-08 09:04:05'),
(287, '917953', 'STAR COCA  30 CL', '970.00', '970.00', '882.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-04 08:16:12', '2022-10-04 08:16:12'),
(288, '834526', 'STAR BBA 100 CL', '2700.00', '2700.00', '2540.00', 1, 1, 12, NULL, 53, NULL, 15, NULL, 5, NULL, '2022-10-04 08:16:55', '2022-10-04 08:16:55'),
(289, '664234', 'STAR BBA 30 CL', '970.00', '970.00', '882.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-04 08:17:56', '2022-10-04 08:17:56'),
(290, '169255', 'STAR SODA 100 CL', '2700.00', '2700.00', '2540.00', 1, 1, 12, NULL, 53, NULL, 15, NULL, 5, NULL, '2022-10-04 08:18:42', '2022-10-04 08:18:42'),
(291, '169565', 'STAR SODA 30 CL', '970.00', '970.00', '882.00', 1, 1, 24, NULL, 54, NULL, 18, NULL, 5, NULL, '2022-10-04 08:19:20', '2022-10-04 08:19:20'),
(292, '962969', 'STAR CRISTAL 100 CL', '2700.00', '2700.00', '2540.00', 1, 1, 12, NULL, 53, NULL, 15, NULL, 5, NULL, '2022-10-04 08:20:08', '2022-10-04 08:20:08'),
(293, '361386', 'STAR CRISTAL 30 CL', '970.00', '970.00', '882.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-04 08:20:49', '2022-10-04 08:20:49'),
(294, '250458', 'STAR TONIC 100 CL', '2700.00', '2700.00', '2540.00', 1, 1, 12, NULL, 53, NULL, 15, NULL, 5, NULL, '2022-10-04 08:21:35', '2022-10-04 08:21:35'),
(295, '672722', 'STAR TONIC  30 CL', '970.00', '970.00', '882.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-04 08:22:20', '2022-10-04 08:22:20'),
(296, '623300', 'STAR XXL 30 CL', '1760.00', '1760.00', '1656.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-04 08:25:39', '2022-10-04 08:25:39'),
(297, '769214', 'STAR EAU VIVE 150 CL', '2060.00', '2060.00', '1862.00', 1, 3, 6, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-04 08:26:23', '2022-10-04 08:26:23'),
(298, '153568', 'STAR EAU VIVE 50 CL', '950.00', '950.00', '860.00', 1, 3, 12, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-04 08:27:04', '2022-10-04 08:27:04'),
(299, '305271', 'STAR PET 150 CL', '4230.00', '4230.00', '3992.00', 1, 3, 6, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-04 08:27:41', '2022-10-04 08:27:41'),
(300, '288718', 'STAR PET 35 CL', '1860.00', '1860.00', '1756.00', 1, 3, 12, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-04 08:28:13', '2022-10-04 08:28:13'),
(301, '478549', 'DZ 42 100L', '7800.00', '7520.00', '7310.00', 1, 2, 12, NULL, 59, NULL, 16, NULL, 5, 5, '2022-10-04 08:31:26', '2022-10-07 07:37:02'),
(302, '231302', 'DZ 42 70CL', '6550.00', '6300.00', '6140.00', 1, 2, 12, NULL, 60, NULL, 16, NULL, 5, 5, '2022-10-04 08:32:20', '2022-10-07 07:38:48'),
(303, '906560', 'DZ 42 ICE 35 CL', '3500.00', '3375.00', '3290.00', 1, 1, 24, NULL, 58, NULL, 16, NULL, 5, 5, '2022-10-04 08:33:10', '2022-10-07 07:41:40'),
(304, '343588', 'DZ 42 PET 25 CL', '2520.00', '2438.00', '2370.00', 1, 2, 48, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:33:48', '2022-10-07 07:43:14'),
(305, '531729', 'DZ 42 PRESTIGE 70 CL', '34200.00', '34200.00', '26680.00', 1, 2, 6, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-04 08:34:28', '2022-10-04 08:34:28'),
(306, '856212', 'DZ CLUB  100 CL', '7690.00', '7420.00', '7210.00', 1, 1, 12, NULL, 56, NULL, 16, NULL, 5, 5, '2022-10-04 08:35:39', '2022-10-07 07:44:51'),
(307, '127867', 'DZ CLUB ICE 35 CL', '3100.00', '2975.00', '2960.00', 1, 1, 24, NULL, 58, NULL, 16, NULL, 5, 5, '2022-10-04 08:36:30', '2022-10-07 07:47:16'),
(308, '837857', 'DZ CLUB PET 100 CL', '7730.00', '7460.00', '7250.00', 1, 1, 12, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:37:16', '2022-10-07 07:48:21'),
(309, '313374', 'DZ CLUB PET 50CL', '3910.00', '3780.00', '3670.00', 1, 1, 24, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:37:59', '2022-10-07 07:49:34'),
(310, '408452', 'DZ CLUB PET 25CL', '2320.00', '2238.00', '2170.00', 1, 2, 48, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:38:55', '2022-10-07 07:51:19'),
(311, '456835', 'DZ CVN 120CL', '13980.00', '13460.00', '12940.00', 1, 2, 6, NULL, 61, NULL, 16, NULL, 5, NULL, '2022-10-04 08:39:54', '2022-10-04 08:39:54'),
(312, '901757', 'DZ CVN 70 CL', '7500.00', '7200.00', '7000.00', 1, 2, 12, NULL, 65, NULL, 16, NULL, 5, 5, '2022-10-04 08:40:42', '2022-10-07 08:02:09'),
(313, '552913', 'DZ CVN 60 CL', '6900.00', '6650.00', '6470.00', 1, 2, 12, NULL, 62, NULL, 16, NULL, 5, 5, '2022-10-04 08:41:31', '2022-10-07 08:18:47'),
(314, '471026', 'DZ CVN 35 CL', '4530.00', '4380.00', '4250.00', 1, 2, 24, NULL, 58, NULL, 16, NULL, 5, 5, '2022-10-04 08:43:50', '2022-10-07 08:03:17'),
(315, '139992', 'DZ CVN 30 CL', '4200.00', '4050.00', '3930.00', 1, 2, 24, NULL, 58, NULL, 16, NULL, 5, 5, '2022-10-04 08:44:37', '2022-10-07 08:19:16'),
(316, '161802', 'DZ CVN PET 25 CL', '3040.00', '3040.00', '2850.00', 1, 2, 48, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:45:15', '2022-10-07 08:04:06'),
(317, '265765', 'DZ CVB 120 CL', '13800.00', '13300.00', '11500.00', 1, 2, 6, NULL, 61, NULL, 16, NULL, 5, 5, '2022-10-04 08:46:13', '2022-10-07 08:18:19'),
(318, '465771', 'DZ CVB 70 CL', '6950.00', '6700.00', '6520.00', 1, 1, 12, NULL, 65, NULL, 16, NULL, 5, 5, '2022-10-04 08:46:58', '2022-10-07 07:55:16'),
(319, '287277', 'DZ CVB 60 CL', '6140.00', '5900.00', '5750.00', 1, 1, 12, NULL, 62, NULL, 16, NULL, 5, 5, '2022-10-04 08:47:53', '2022-10-07 08:17:16'),
(320, '547088', 'DZ CVB 35 CL', '3800.00', '3680.00', '3570.00', 1, 2, 24, NULL, 58, NULL, 16, NULL, 5, 5, '2022-10-04 08:48:43', '2022-10-07 07:56:31'),
(321, '846739', 'DZ CVB 30 CL', '3670.00', '3540.00', '3450.00', 1, 1, 24, NULL, 58, NULL, 16, NULL, 5, 5, '2022-10-04 08:49:26', '2022-10-07 08:17:44'),
(322, '531325', 'DZ CVB PET 25 CL', '2620.00', '2538.00', '2460.00', 1, 2, 48, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:50:10', '2022-10-07 07:57:29'),
(323, '997690', 'DZ VALISTOF CITRON 70 CL', '6170.00', '5900.00', '5870.00', 1, 2, 12, NULL, 63, NULL, 16, NULL, 5, 5, '2022-10-04 08:50:59', '2022-10-07 08:07:46'),
(324, '161786', 'DZ VALISTOF CITRON 35 CL', '3110.00', '2980.00', '2960.00', 1, 2, 24, NULL, 64, NULL, 16, NULL, 5, 5, '2022-10-04 08:51:43', '2022-10-07 08:09:53'),
(325, '533128', 'DZ VALISTOF CITRON PET 20 CL', '2080.00', '2020.00', '1940.00', 1, 2, 48, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-04 08:52:22', '2022-10-04 08:52:22'),
(326, '469335', 'DZ VALISTOF FRAISE 70 CL', '6170.00', '5900.00', '5870.00', 1, 2, 12, NULL, 63, NULL, 16, NULL, 5, 5, '2022-10-04 08:53:09', '2022-10-07 08:08:33'),
(327, '668307', 'DZ VALISTOF FRAISE 35 CL', '3170.00', '3080.00', '2960.00', 1, 1, 24, NULL, 64, NULL, 16, NULL, 5, NULL, '2022-10-04 08:53:54', '2022-10-04 08:53:54'),
(328, '817781', 'DZ VALISTOF FRAISE PET 20 CL', '2020.00', '1940.00', '1940.00', 1, 1, 48, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:54:39', '2022-10-07 08:11:34'),
(329, '319240', 'DZ NAMAKI NY ANTSIKA 35 CL', '2080.00', '2016.00', '1936.00', 1, 2, 24, NULL, 58, NULL, 16, NULL, 5, 5, '2022-10-04 08:55:45', '2022-10-07 08:21:42'),
(330, '221256', 'DZ NAMAKI ICE 35 CL', '2690.00', '2640.00', '2565.00', 1, 1, 24, NULL, 58, NULL, 16, NULL, 5, 5, '2022-10-04 08:56:43', '2022-10-07 08:20:12'),
(331, '784306', 'DZ NAMAKI PET 35 CL', '3540.00', '3440.00', '3380.00', 1, 2, 24, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:57:34', '2022-10-07 08:20:44'),
(332, '402117', 'DZ NAMAKI PET 25 CL', '2040.00', '1960.00', '1921.00', 1, 2, 48, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 08:58:17', '2022-10-07 08:21:05'),
(333, '892374', 'DZ RN7 75 CL', '6600.00', '6300.00', '5990.00', 1, 2, 6, NULL, 67, NULL, 16, NULL, 5, NULL, '2022-10-04 08:59:18', '2022-10-04 08:59:18'),
(334, '129304', 'DZ SOA VIN 30 CL', '5200.00', '5000.00', '4730.00', 1, 2, 48, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-04 09:00:20', '2022-10-04 09:00:20'),
(335, '413664', 'DZ MATSIATRA ROUGE 75 CL', '18600.00', '17750.00', '16910.00', 1, 2, 12, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-04 09:01:02', '2022-10-04 09:01:02'),
(336, '411023', 'DZ MATSIATRA BLANC 75 CL', '18600.00', '17750.00', '16910.00', 1, 2, 12, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-04 09:01:42', '2022-10-04 09:01:42'),
(337, '923857', 'DZ MATSIATRA NECTAR 75 CL', '20240.00', '19320.00', '18400.00', 1, 2, 12, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-04 09:02:30', '2022-10-04 09:02:30'),
(338, '514261', 'DZ BIG 200 CL', '4260.00', '4220.00', '3702.00', 1, 2, 6, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-04 09:03:14', '2022-10-07 08:28:59'),
(339, '427517', 'DZ BIG 40 CL', '1900.00', '1880.00', '1650.00', 1, 1, 8, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-04 09:03:56', '2022-10-07 08:29:34'),
(340, '520504', 'COMA IVST CITRON 70 CL', '6490.00', '6490.00', '6120.00', 1, 2, 12, NULL, 71, NULL, 17, NULL, 5, 5, '2022-10-04 09:05:53', '2022-10-08 12:57:24'),
(341, '923257', 'COMA IVST CITRON 35 CL', '3370.00', '3370.00', '3178.00', 1, 2, 24, NULL, 72, NULL, 17, NULL, 5, 5, '2022-10-04 09:06:37', '2022-10-08 12:56:18'),
(342, '228029', 'COMA IVST CITRON PET 25 CL', '2330.00', '2330.00', '1668.00', 1, 2, 48, NULL, NULL, NULL, 17, NULL, 5, 5, '2022-10-04 09:07:22', '2022-10-08 12:55:51'),
(343, '430928', 'COMA IVST 70 CL', '6490.00', '6490.00', '6120.00', 1, 1, 12, NULL, 71, NULL, 17, NULL, 5, 5, '2022-10-04 09:08:10', '2022-10-08 12:55:26'),
(344, '520311', 'COMA IVST  35 CL', '3370.00', '3370.00', '3178.00', 1, 2, 24, NULL, 72, NULL, 17, NULL, 5, 5, '2022-10-04 09:08:57', '2022-10-08 12:53:39'),
(345, '547851', 'COMA IVST GINGER 70 CL', '6490.00', '6490.00', '6120.00', 1, 1, 12, NULL, 71, NULL, 17, NULL, 5, 5, '2022-10-04 09:09:40', '2022-10-08 12:53:17'),
(346, '659612', 'COMA IVST GINGER 35 CL', '3370.00', '3370.00', '3178.00', 1, 1, 24, NULL, 72, NULL, 17, NULL, 5, 5, '2022-10-04 09:10:25', '2022-10-08 12:52:53'),
(347, '900833', 'COMA AMBILOBE 100 CL', '7350.00', '7178.00', '6940.00', 1, 2, 12, NULL, 70, NULL, 17, NULL, 5, NULL, '2022-10-04 09:11:09', '2022-10-04 09:11:09'),
(348, '705052', 'COMA AMBILOBE 35 CL', '2780.00', '2780.00', '2624.00', 1, 2, 24, NULL, 72, NULL, 17, NULL, 5, 5, '2022-10-04 09:11:59', '2022-10-08 13:00:50'),
(349, '869733', 'COMA AMBILOBE PET L', '7930.00', '7742.00', '7482.00', 1, 2, 15, NULL, NULL, NULL, 17, NULL, 5, NULL, '2022-10-04 09:12:44', '2022-10-04 09:12:44'),
(350, '693434', 'COMA AMBILOBE PET 25 CL', '2230.00', '2230.00', '2104.00', 1, 2, 48, NULL, NULL, NULL, 17, NULL, 5, 5, '2022-10-04 09:13:29', '2022-10-07 08:50:12'),
(351, '394458', 'COMA AMBILOBE BLEU 100 CL', '5440.00', '5340.00', '5132.00', 1, 1, 12, NULL, 70, NULL, 17, NULL, 5, NULL, '2022-10-04 09:14:17', '2022-10-04 09:14:17'),
(352, '132388', 'COMA AMBILOBE BLEU 35 CL', '2070.00', '2030.00', '1956.00', 1, 2, 24, NULL, 72, NULL, 17, NULL, 5, NULL, '2022-10-04 09:15:01', '2022-10-04 09:15:01'),
(353, '777656', 'COMA AMBILOBE BLEU PET 25 CL', '1770.00', '1730.00', '1668.00', 1, 2, 48, NULL, NULL, NULL, 22, NULL, 5, NULL, '2022-10-04 09:15:54', '2022-10-04 09:15:54'),
(354, '937926', 'COMA ST CLAUDE 100 CL', '8400.00', '8200.00', '7924.00', 1, 2, 12, NULL, 70, NULL, 22, NULL, 5, NULL, '2022-10-04 09:16:43', '2022-10-04 09:16:43'),
(355, '234873', 'COMA ST CLAUDE 35 CL', '3120.00', '3050.00', '2944.00', 1, 1, 24, NULL, 72, NULL, 17, NULL, 5, NULL, '2022-10-04 09:17:34', '2022-10-04 09:17:34'),
(356, '825415', 'COMA ST CLAUDE PET 25 CL', '2510.00', '2450.00', '2366.00', 1, 2, 48, NULL, NULL, NULL, 17, NULL, 5, NULL, '2022-10-04 09:18:10', '2022-10-04 09:18:10'),
(357, '888931', 'COMA JOHN 100 CL', '33150.00', '33150.00', '31570.00', 1, 2, 6, NULL, 73, NULL, 17, NULL, 5, 5, '2022-10-04 09:19:18', '2022-10-08 12:58:35'),
(358, '935399', 'COMA JOHN 70 CL', '23510.00', '23510.00', '22384.00', 1, 2, 12, NULL, 73, NULL, 17, NULL, 5, 5, '2022-10-04 09:20:12', '2022-10-08 12:58:58'),
(359, '131178', 'COMA JOHN 35 CL', '11900.00', '11900.00', '11316.00', 1, 1, 24, NULL, 72, NULL, 17, NULL, 5, 5, '2022-10-04 09:20:58', '2022-10-08 12:59:17'),
(360, '356324', 'COMA GREEN 100 CL', '43240.00', '43240.00', '41170.00', 1, 2, 6, NULL, 73, NULL, 17, NULL, 5, 5, '2022-10-04 09:21:42', '2022-10-08 12:59:57'),
(361, '463464', 'COMA GREEN 70 CL', '30450.00', '30450.00', '28990.00', 1, 1, 12, NULL, 73, NULL, 17, NULL, 5, 5, '2022-10-04 09:22:28', '2022-10-08 12:59:37'),
(362, '565494', 'COMA JACKSON 70 CL', '13240.00', '13050.00', '12610.00', 1, 1, 12, NULL, 73, NULL, 22, NULL, 5, NULL, '2022-10-04 09:23:12', '2022-10-04 09:23:12'),
(363, '182690', 'COMA JACKSON 35 CL', '6720.00', '6620.00', '6392.00', 1, 2, 24, NULL, 72, NULL, 22, NULL, 5, NULL, '2022-10-04 09:24:03', '2022-10-04 09:24:03'),
(364, '952599', 'SODE SAMBO 100 CL', '6650.00', '6580.00', '6210.00', 1, 2, 12, NULL, 76, NULL, 18, NULL, 5, NULL, '2022-10-04 11:53:11', '2022-10-04 11:53:11'),
(365, '811526', 'SODE SAMBO 33 CL', '2370.00', '2324.00', '2234.00', 1, 2, 30, NULL, 78, NULL, 18, NULL, 5, NULL, '2022-10-04 11:53:54', '2022-10-04 11:53:54'),
(366, '837819', 'SODE SAMBO PET 25CL', '2090.00', '2044.00', '1947.00', 1, 1, 48, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 11:54:43', '2022-10-04 11:54:43'),
(367, '133080', 'SODE SAMBO PET 20 CL', '1840.00', '1800.00', '1718.00', 1, 2, 50, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 11:55:19', '2022-10-04 11:55:19'),
(368, '563789', 'SODE SAMBO PET 100CL', '7850.00', '7780.00', '7410.00', 1, 2, 12, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 11:56:01', '2022-10-04 11:56:01'),
(369, '868503', 'SODE TROPIC PUNCH 70 CL', '9540.00', '9350.00', '8820.00', 1, 2, 12, NULL, 85, NULL, 18, NULL, 5, NULL, '2022-10-04 11:56:44', '2022-10-04 11:56:44'),
(370, '710188', 'SODE TROPIC PUNCH 35 CL', '5180.00', '5100.00', '4800.00', 1, 1, 12, NULL, 79, NULL, 18, NULL, 5, NULL, '2022-10-04 11:57:25', '2022-10-04 11:57:25'),
(371, '398698', 'SODE GR RHUM NOIR 150 CL', '12550.00', '12430.00', '11730.00', 1, 2, 6, NULL, 80, NULL, 18, NULL, 5, NULL, '2022-10-04 11:58:14', '2022-10-04 11:58:14'),
(372, '201009', 'SODE GR RHUM NOIR 100 CL', '7970.00', '7900.00', '7450.00', 1, 2, 12, NULL, 77, NULL, 18, NULL, 5, NULL, '2022-10-04 11:59:01', '2022-10-04 11:59:01'),
(373, '262932', 'SODE GR RHUM OR 150 CL', '13330.00', '13200.00', '12460.00', 1, 2, 6, NULL, 80, NULL, 18, NULL, 5, NULL, '2022-10-04 11:59:43', '2022-10-04 11:59:43'),
(374, '997226', 'SODE MASTER 150 CL', '20640.00', '20250.00', '19290.00', 1, 2, 6, NULL, 80, NULL, 18, NULL, 5, NULL, '2022-10-04 12:00:31', '2022-10-04 12:00:31'),
(375, '941792', 'SODE MASTER 100 CL', '13100.00', '12850.00', '12240.00', 1, 2, 12, NULL, 77, NULL, 18, NULL, 5, NULL, '2022-10-04 12:01:23', '2022-10-04 12:01:23'),
(376, '719874', 'SODE MASTER 70 CL', '9520.00', '9340.00', '8900.00', 1, 1, 12, NULL, 81, NULL, 18, NULL, 5, NULL, '2022-10-04 12:02:03', '2022-10-04 12:02:03'),
(377, '905927', 'SODE MASTER 37,5 CL', '5330.00', '5230.00', '4980.00', 1, 2, 24, NULL, 79, NULL, 18, NULL, 5, NULL, '2022-10-04 12:02:44', '2022-10-04 12:02:44'),
(378, '547514', 'SODE GUARD 150 CL', '15560.00', '15270.00', '14540.00', 1, 2, 6, NULL, 80, NULL, 18, NULL, 5, NULL, '2022-10-04 12:03:40', '2022-10-04 12:03:40'),
(379, '984643', 'SODE GUARD 100 CL', '9430.00', '9260.00', '8820.00', 1, 1, 12, NULL, 77, NULL, 18, NULL, 5, NULL, '2022-10-04 12:04:32', '2022-10-04 12:04:32'),
(380, '475998', 'SODE GUARD 70 CL', '6900.00', '6740.00', '6420.00', 1, 2, 12, NULL, 82, NULL, 18, NULL, 5, NULL, '2022-10-04 12:05:26', '2022-10-04 12:05:26'),
(381, '475480', 'SODE GUARD 37,5 CL', '4100.00', '3980.00', '3790.00', 1, 2, 24, NULL, 79, NULL, 18, NULL, 5, NULL, '2022-10-04 12:06:10', '2022-10-04 12:06:10'),
(382, '245240', 'SODE GUARD PET 25 CL', '2570.00', '2500.00', '2410.00', 1, 2, 48, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:06:47', '2022-10-04 12:06:47'),
(383, '398055', 'SODE GUARD PET 20 CL', '2250.00', '2180.00', '2100.00', 1, 1, 50, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:07:26', '2022-10-04 12:07:26'),
(384, '224335', 'SODE CUVEE SPECIAL PET 25 CL', '2310.00', '2250.00', '2160.00', 1, 2, 48, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:08:10', '2022-10-04 12:08:10'),
(385, '450586', 'SODE CUVEE SPECIALE PET 20 CL', '1970.00', '1910.00', '1840.00', 1, 2, 50, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:08:52', '2022-10-04 12:08:52'),
(386, '319920', 'SODE PEPERMINT 70 CL', '8100.00', '7950.00', '7500.00', 1, 2, 12, NULL, 86, NULL, 18, NULL, 5, NULL, '2022-10-04 12:09:37', '2022-10-04 12:09:37'),
(387, '528327', 'SODE PEPERMINT 35 CL', '4800.00', '4700.00', '4430.00', 1, 2, 12, NULL, 87, NULL, 18, NULL, 5, NULL, '2022-10-04 12:10:16', '2022-10-04 12:10:16'),
(388, '298665', 'SODE MANGOUSTAN 100 CL', '14600.00', '14340.00', '13530.00', 1, 2, 12, NULL, 88, NULL, 18, NULL, 5, NULL, '2022-10-04 12:11:06', '2022-10-04 12:11:06'),
(389, '633134', 'SODE MANGOUSTAN 70 CL', '9920.00', '9740.00', '9190.00', 1, 2, 12, NULL, 89, NULL, 18, NULL, 5, NULL, '2022-10-04 12:11:47', '2022-10-04 12:11:47'),
(390, '653164', 'SODE MANGOUSTAN 35 CL', '5860.00', '5750.00', '5424.00', 1, 2, 20, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:12:49', '2022-10-04 12:12:49'),
(391, '901736', 'SODE PRADO 100 CL', '14400.00', '14260.00', '13450.00', 1, 2, 12, NULL, 83, NULL, 18, NULL, 5, 5, '2022-10-04 12:13:28', '2022-10-04 12:13:46'),
(392, '909906', 'SODE PRADO 50 CL', '7800.00', '7730.00', '7300.00', 1, 2, 24, NULL, 84, NULL, 18, NULL, 5, NULL, '2022-10-04 12:14:46', '2022-10-04 12:14:46'),
(393, '347521', 'SODE PASTANIS PET 100 CL', '0.00', '0.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:15:24', '2022-10-04 12:15:24'),
(394, '616558', 'SODE PASTANIS PET 25 CL', '2850.00', '2770.00', '2640.00', 1, 1, 48, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:16:03', '2022-10-04 12:16:03'),
(395, '224641', 'SODE PASTANIS PET 20 CL', '2440.00', '2420.00', '2280.00', 1, 2, 50, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:16:37', '2022-10-04 12:16:37'),
(396, '787364', 'SODE PARADISE', '19800.00', '19100.00', '18010.00', 1, 1, 6, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:17:15', '2022-10-04 12:17:15'),
(397, '190705', 'SODE BEST CLUB 70 CL', '7200.00', '7020.00', '6620.00', 1, 2, 12, NULL, 82, NULL, 18, NULL, 5, NULL, '2022-10-04 12:18:00', '2022-10-04 12:18:00'),
(398, '767768', 'SODE BEST CLUB 37,5 CL', '4300.00', '4220.00', '3980.00', 1, 1, 24, NULL, 79, NULL, 18, NULL, 5, NULL, '2022-10-04 12:18:40', '2022-10-04 12:18:40'),
(399, '737733', 'SODE NAPOLEON 70 CL', '29320.00', '28780.00', '27150.00', 1, 2, 12, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:19:15', '2022-10-04 12:19:15'),
(400, '440914', 'SODE EPERON 70 CL', '11000.00', '10780.00', '10170.00', 1, 1, 12, NULL, 82, NULL, 18, NULL, 5, NULL, '2022-10-04 12:19:59', '2022-10-04 12:19:59'),
(401, '776542', 'SODE BACK HEAD 70 CL', '12340.00', '12110.00', '11430.00', 1, 2, 12, NULL, 82, NULL, 18, NULL, 5, NULL, '2022-10-04 12:20:43', '2022-10-04 12:20:43'),
(402, '480970', 'SODE GIN HARPOON 70 CL', '37460.00', '36800.00', '34700.00', 1, 2, 12, NULL, 91, NULL, 18, NULL, 5, NULL, '2022-10-04 12:21:25', '2022-10-04 12:21:25'),
(403, '742604', 'SODE SCANLAN 70 CL', '12800.00', '12500.00', '11800.00', 1, 1, 12, NULL, 106, NULL, 18, NULL, 5, 5, '2022-10-04 12:22:26', '2022-10-04 12:22:59'),
(404, '518954', 'SODE GLENN MARY 70 CL', '11800.00', '11550.00', '10900.00', 1, 2, 6, NULL, 106, NULL, 18, NULL, 5, NULL, '2022-10-04 12:23:56', '2022-10-04 12:23:56'),
(405, '692877', 'SODE TEQUILA MUNICION 70 CL', '66200.00', '65000.00', '31310.00', 1, 2, 12, NULL, 92, NULL, 18, NULL, 5, NULL, '2022-10-04 12:24:47', '2022-10-04 12:24:47'),
(406, '815716', 'SODE CAZANOVE 100 CL', '10160.00', '9970.00', '9410.00', 1, 2, 12, NULL, 77, NULL, 18, NULL, 5, NULL, '2022-10-04 12:25:28', '2022-10-04 12:25:28'),
(407, '172325', 'SODE CAZANAOVE PET L', '0.00', '0.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-04 12:25:52', '2022-10-04 12:25:52'),
(408, '713051', 'SODE DARBEL MENTHE VERRE 100 CL', '6730.00', '6600.00', '6010.00', 1, 2, 12, NULL, 93, NULL, 18, NULL, 5, NULL, '2022-10-04 12:26:50', '2022-10-04 12:26:50'),
(409, '918598', 'SODE DARBEL MENTHE PET 100 CL', '6480.00', '6350.00', '5880.00', 1, 2, 12, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:27:33', '2022-10-07 12:59:51'),
(410, '876126', 'SODE DARBEL GRENADINE VERRE 100 CL', '6120.00', '6010.00', '5460.00', 1, 2, 12, NULL, 93, NULL, 18, NULL, 5, NULL, '2022-10-04 12:28:19', '2022-10-04 12:28:19'),
(411, '744223', 'SODE DARBEL GRENADINE PET 100 CL', '580.00', '5700.00', '5270.00', 1, 2, 12, NULL, NULL, NULL, 18, NULL, 5, 5, '2022-10-04 12:28:57', '2022-10-07 13:00:35'),
(412, '837082', 'SODE DARBEL CANNE PET 100 CL', '5540.00', '5440.00', '5030.00', 1, 2, 12, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:29:37', '2022-10-07 12:58:42'),
(413, '965486', 'ROYAL BRIGHTON 150 CL', '17700.00', '17700.00', '17700.00', 1, 2, 6, NULL, 95, NULL, 19, NULL, 5, NULL, '2022-10-04 12:30:49', '2022-10-04 12:30:49'),
(414, '863912', 'ROYAL BRIGHTON 70 CL', '8900.00', '8900.00', '8900.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-04 12:31:45', '2022-10-04 12:31:45'),
(415, '278086', 'ROYAL BRIGHTON 35 CL', '4700.00', '4700.00', '4700.00', 1, 2, 24, NULL, 97, NULL, 19, NULL, 5, NULL, '2022-10-04 12:32:21', '2022-10-04 12:32:21'),
(416, '657313', 'ROYAL BRIGHTON SPICED 70', '6000.00', '6000.00', '6000.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-04 12:33:05', '2022-10-04 12:33:05'),
(417, '443068', 'ROYAL BRIGHTON SPICED 35 CL', '3500.00', '3500.00', '3500.00', 1, 2, 24, NULL, 97, NULL, 19, NULL, 5, NULL, '2022-10-04 12:33:56', '2022-10-04 12:33:56'),
(418, '714047', 'ROYAL MAC NEIL 150 CL', '29500.00', '29500.00', '29500.00', 1, 2, 6, NULL, 95, NULL, 19, NULL, 5, NULL, '2022-10-04 12:34:51', '2022-10-04 12:34:51'),
(419, '234105', 'ROYAL MAC NEIL 70 CL', '8900.00', '8900.00', '8900.00', 1, 1, 12, NULL, 107, NULL, 19, NULL, 5, 5, '2022-10-04 12:35:50', '2022-10-04 12:36:26'),
(420, '997627', 'ROYAL MAC NEIL 35 CL', '4800.00', '4800.00', '4800.00', 1, 1, 24, NULL, 98, NULL, 19, NULL, 5, NULL, '2022-10-04 12:37:24', '2022-10-04 12:37:24'),
(421, '401483', 'ROYAL ADU MACKAY 70', '6600.00', '6600.00', '6600.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-04 12:38:06', '2022-10-04 12:38:06'),
(422, '910897', 'ROYAL ADU MACKAY 35', '3600.00', '3600.00', '3600.00', 1, 2, 24, NULL, 97, NULL, 19, NULL, 5, NULL, '2022-10-04 12:38:51', '2022-10-04 12:38:51'),
(423, '291526', 'ROYAL CAY BRAVA 70 CL', '0.00', '0.00', '0.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-04 12:39:25', '2022-10-04 12:39:25'),
(424, '567656', 'ROYAL WILSON 70 CL', '20600.00', '20600.00', '20600.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-04 12:40:10', '2022-10-04 12:40:10'),
(425, '511801', 'ROYAL WILSON 35 CL', '10700.00', '10700.00', '10700.00', 1, 2, 24, NULL, 97, NULL, 19, NULL, 5, NULL, '2022-10-04 12:40:59', '2022-10-04 12:40:59'),
(426, '935559', 'ROYAL WILSON NOIRE 100 CL', '73200.00', '73200.00', '73200.00', 1, 1, 12, NULL, NULL, NULL, 19, NULL, 5, NULL, '2022-10-04 12:41:34', '2022-10-04 12:41:34'),
(427, '116429', 'ROYAL VOLKOV 70 CL', '7900.00', '7900.00', '7900.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-04 12:42:19', '2022-10-04 12:42:19'),
(428, '607443', 'ROYAL VOLKOV 35 CL', '3950.00', '3950.00', '3950.00', 1, 2, 24, NULL, 97, NULL, 19, NULL, 5, NULL, '2022-10-04 12:43:01', '2022-10-04 12:43:01'),
(429, '347954', 'ROYAL MARCKO CITRON 70 CL', '8200.00', '8200.00', '8200.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-04 12:43:53', '2022-10-04 12:43:53'),
(430, '528608', 'ROYAL MARCKO CITRON 35 CL', '4600.00', '4600.00', '4600.00', 1, 2, 24, NULL, 98, NULL, 19, NULL, 5, NULL, '2022-10-04 12:44:37', '2022-10-04 12:44:37'),
(431, '184250', 'ROYAL DON PEDRO 50 CL', '17700.00', '17700.00', '17700.00', 1, 2, 12, NULL, NULL, NULL, 19, NULL, 5, NULL, '2022-10-04 12:45:21', '2022-10-04 12:45:21'),
(432, '254366', 'ROYAL JC DOMAINE 75 CL', '64400.00', '64400.00', '64400.00', 1, 2, 6, NULL, NULL, NULL, 19, NULL, 5, NULL, '2022-10-04 12:45:58', '2022-10-04 12:45:58'),
(433, '135049', 'ROYAL JC VIBRAZIO 75 CL', '64400.00', '64400.00', '0.00', 1, 2, 6, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:46:24', '2022-10-07 09:15:23'),
(434, '691333', 'ROYAL JC FLEURETTE 75 CL', '65670.00', '65670.00', '59700.00', 1, 2, 6, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:46:57', '2022-10-07 09:14:26'),
(435, '795487', 'ROYAL MAROMAMY PETILLANT', '21800.00', '20000.00', '18150.00', 1, 2, 6, NULL, NULL, NULL, 19, NULL, 5, NULL, '2022-10-04 12:47:39', '2022-10-04 12:47:39'),
(436, '942228', 'ROYAL RDV BLUE 75 CL', '14000.00', '14000.00', '11430.00', 1, 2, 6, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:48:19', '2022-10-07 09:12:42'),
(437, '861514', 'ROYAL RDV PINK 75 CL', '14000.00', '14000.00', '11430.00', 1, 2, 6, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:48:59', '2022-10-07 09:13:22'),
(438, '217759', 'ROYAL RDV POMME 75 CL', '14000.00', '14000.00', '11430.00', 1, 1, 6, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:49:36', '2022-10-07 09:13:04'),
(439, '978248', 'ROYAL RDV RAISIN BLANC 75 CL', '14000.00', '14000.00', '11430.00', 1, 2, 6, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:50:11', '2022-10-07 09:11:53'),
(440, '392904', 'ROYAL RDV RAISIN ROUGE 75 CL', '14000.00', '14000.00', '11430.00', 1, 2, 6, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:50:49', '2022-10-07 09:11:30'),
(441, '314941', 'ROYAL RDV MOJITO 75 CL', '14000.00', '14000.00', '11430.00', 1, 1, 6, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:51:22', '2022-10-07 09:12:20'),
(442, '491957', 'ROYAL ST ANNA 75 CL', '23000.00', '23000.00', '17280.00', 1, 2, 12, NULL, NULL, NULL, 19, NULL, 5, 5, '2022-10-04 12:51:55', '2022-10-07 09:02:45'),
(443, '400003', 'ETER SYLVER 70 CL', '6740.00', '6680.00', '6360.00', 1, 2, 12, NULL, 99, NULL, 20, NULL, 5, NULL, '2022-10-04 12:53:05', '2022-10-04 12:53:05'),
(444, '538524', 'ETER SYLVER 35 CL', '3440.00', '3410.00', '3244.00', 1, 2, 24, NULL, 100, NULL, 20, NULL, 5, NULL, '2022-10-04 12:53:52', '2022-10-04 12:53:52'),
(445, '974479', 'ETER SYLVER 25 CL', '2570.00', '2492.00', '2420.00', 1, 2, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 12:54:32', '2022-10-04 12:54:32'),
(446, '817882', 'ETER SYLVER 20 CL', '2250.00', '2230.00', '2118.00', 1, 1, 50, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 12:55:04', '2022-10-04 12:55:04'),
(447, '370198', 'ETER PASTAGA 100 CL', '11240.00', '11030.00', '10480.00', 1, 2, 12, NULL, 101, NULL, 16, NULL, 5, NULL, '2022-10-04 12:55:46', '2022-10-04 12:55:46'),
(448, '580135', 'ETER PASTAGA 25CL', '2780.00', '2740.00', '2596.00', 1, 2, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 12:56:29', '2022-10-04 12:56:29'),
(449, '814195', 'ETER PASTAGA 20 CL', '2380.00', '2330.00', '2220.00', 1, 2, 50, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 12:57:06', '2022-10-04 12:57:06'),
(450, '892980', 'ETER KALAK CITRON 70 CL', '4740.00', '4642.00', '4510.00', 1, 2, 12, NULL, 99, NULL, 20, NULL, 5, NULL, '2022-10-04 12:58:00', '2022-10-04 12:58:00'),
(451, '166631', 'ETER KALAK CITRON 35 CL', '2370.00', '2321.00', '2254.00', 1, 2, 24, NULL, 100, NULL, 16, NULL, 5, NULL, '2022-10-04 12:58:50', '2022-10-04 12:58:50'),
(452, '276346', 'ETER KALAK CITRON 25 CL', '1860.00', '1820.00', '1770.00', 1, 2, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 12:59:48', '2022-10-04 12:59:48'),
(453, '574316', 'ETER KALAK CLASSIC 70 CL', '4310.00', '4290.00', '4160.00', 1, 2, 12, NULL, 99, NULL, 20, NULL, 5, 5, '2022-10-04 13:00:30', '2022-10-07 13:26:24'),
(454, '471537', 'ETER KALAK CLASSIC 35 CL', '2310.00', '2270.00', '2200.00', 1, 2, 24, NULL, 100, NULL, 20, NULL, 5, NULL, '2022-10-04 13:01:14', '2022-10-04 13:01:14'),
(455, '734049', 'ETER KALAK CLASSIC 25 CL', '1800.00', '1760.00', '1710.00', 1, 2, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 13:01:56', '2022-10-04 13:01:56'),
(456, '168018', 'ETER KALAK POMME 70 CL', '4740.00', '4642.00', '4510.00', 1, 2, 12, NULL, 100, NULL, 20, NULL, 5, NULL, '2022-10-04 13:03:29', '2022-10-04 13:03:29'),
(457, '506566', 'ETER KALAK POMME 35 CL', '2370.00', '2321.00', '2254.00', 1, 2, 24, NULL, 100, NULL, 20, NULL, 5, NULL, '2022-10-04 13:04:08', '2022-10-04 13:04:08'),
(458, '399541', 'ETER KALAK POMME 25 CL', '1860.00', '1820.00', '1770.00', 1, 1, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 13:05:03', '2022-10-04 13:05:03'),
(459, '269315', 'ETER RIO BLANC 25 CL', '2140.00', '2080.00', '2000.00', 1, 2, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 13:05:43', '2022-10-04 13:05:43'),
(460, '747955', 'ETER RIO ROUGE 30 CL', '2180.00', '2130.00', '2036.00', 1, 2, 30, NULL, 100, NULL, 20, NULL, 5, 5, '2022-10-04 13:06:29', '2022-10-07 13:11:29'),
(461, '643060', 'ETER RIO ROUGE 25 CL', '2160.00', '2092.00', '2012.00', 1, 1, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 13:07:14', '2022-10-04 13:07:14'),
(462, '400748', 'ETER POUSS BLANC 25 CL', '2130.00', '2090.00', '2000.00', 1, 1, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 13:07:54', '2022-10-04 13:07:54'),
(463, '622636', 'ETER POUSS BLANC 20 CL', '1860.00', '1820.00', '1746.00', 1, 2, 50, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 13:08:31', '2022-10-04 13:08:31'),
(464, '798250', 'ETER POUSS ROUGE 25 CL', '2140.00', '2100.00', '2012.00', 1, 1, 48, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 13:09:13', '2022-10-04 13:09:13'),
(465, '814103', 'ETER TENTATION MENTHE  75 CL', '4830.00', '4750.00', '3820.00', 1, 1, 12, NULL, NULL, NULL, 20, NULL, 5, 5, '2022-10-04 13:09:48', '2022-10-07 13:25:30'),
(466, '468014', 'ETER TENTATION GRENADINE 75 CL', '4390.00', '4120.00', '3820.00', 1, 1, 12, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-04 13:10:27', '2022-10-04 13:10:27'),
(467, '461261', 'ANKAR SOMA PET 100 CL', '9640.00', '9460.00', '9092.00', 1, 2, 12, NULL, NULL, NULL, 21, NULL, 5, 5, '2022-10-04 13:11:46', '2022-10-07 08:32:38'),
(468, '129908', 'ANKAR SOMA PET 25 CL', '2510.00', '2452.00', '2370.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:12:29', '2022-10-04 13:12:29'),
(469, '461395', 'ANKAR GASIKARA PET 100 CL', '8440.00', '8242.00', '7964.00', 1, 1, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:13:02', '2022-10-04 13:13:02'),
(470, '782037', 'ANKAR GASIKARA PET 25 CL', '2110.00', '2060.00', '1992.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:13:44', '2022-10-04 13:13:44'),
(471, '498932', 'ANKAR VOLAMENA PET 100 CL', '8440.00', '8242.00', '7964.00', 1, 2, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:14:50', '2022-10-04 13:14:50'),
(472, '912612', 'ANKAR VOLAMENA PET 25 CL', '2110.00', '2060.00', '1992.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:15:30', '2022-10-04 13:15:30'),
(473, '415117', 'ANKAR TSARAJORO PET 100 CL', '8440.00', '8242.00', '7964.00', 1, 1, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:16:11', '2022-10-04 13:16:11'),
(474, '530951', 'ANKAR TSARAJORO PET 25 CL', '2110.00', '2060.00', '1992.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, 5, '2022-10-04 13:16:48', '2022-10-05 12:09:06'),
(475, '957673', 'ANKAR CAP D\'AMBRE 70 CL', '9200.00', '8870.00', '8530.00', 1, 2, 12, NULL, 102, NULL, 21, NULL, 5, NULL, '2022-10-04 13:17:31', '2022-10-04 13:17:31'),
(476, '130538', 'ANKAR CAP D\'AMBRE 25 CL', '3070.00', '2950.00', '2840.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:19:07', '2022-10-04 13:19:07'),
(477, '204972', 'ANKAR LORD BARTON 70 CL', '9570.00', '9220.00', '8866.00', 1, 1, 12, NULL, 102, NULL, 21, NULL, 5, NULL, '2022-10-04 13:19:51', '2022-10-04 13:19:51'),
(478, '637687', 'ANKAR LORD BARTON 25 CL', '3490.00', '3374.00', '3240.00', 1, 1, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:20:31', '2022-10-04 13:20:31'),
(479, '420333', 'ANKAR  JOE BLANC 25 CL', '2260.00', '2210.00', '2132.00', 1, 1, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:21:18', '2022-10-04 13:21:18'),
(480, '442410', 'ANKAR NAKA 70 CL', '6950.00', '6782.00', '6556.00', 1, 2, 12, NULL, 102, NULL, 21, NULL, 5, NULL, '2022-10-04 13:21:56', '2022-10-04 13:21:56'),
(481, '807536', 'ANKAR NAKA PET 25 CL', '2510.00', '2450.00', '2370.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:22:32', '2022-10-04 13:22:32'),
(482, '350445', 'ANKAR RAVINALA PET 100 CL', '4950.00', '4770.00', '4500.00', 1, 1, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:23:11', '2022-10-04 13:23:11'),
(483, '978346', 'ANKAR RAVINALA PET 25 CL', '1760.00', '1728.00', '1600.00', 1, 1, 24, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:24:01', '2022-10-04 13:24:01'),
(484, '480748', 'ANKAR TOAMASINA 100 CL', '4950.00', '4770.00', '4500.00', 1, 2, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:24:41', '2022-10-04 13:24:41'),
(485, '155449', 'ANKAR TOAMASINA 25 CL', '1680.00', '1643.00', '1550.00', 1, 1, 24, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:25:14', '2022-10-04 13:25:14'),
(486, '450666', 'ANKAR JAZZ 25 CL', '1970.00', '1970.00', '1856.00', 1, 1, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:25:46', '2022-10-04 13:25:46'),
(487, '634378', 'ANKAR RHUM 303 75 CL', '22600.00', '22150.00', '21500.00', 1, 2, 6, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:26:22', '2022-10-04 13:26:22'),
(488, '753256', 'ANKAR RHUM 303 25 CL', '3070.00', '3000.00', '2920.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:27:01', '2022-10-04 13:27:01'),
(489, '906895', 'ANKAR RHUM BETSY 75 CL', '12100.00', '11850.00', '11500.00', 1, 2, 6, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:27:44', '2022-10-04 13:27:44'),
(490, '920052', 'ANKAR RHUM BETSY 25 CL', '2400.00', '2370.00', '2300.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:28:28', '2022-10-04 13:28:28'),
(491, '780828', 'ANKAR MAXIMUM 70 CL', '19800.00', '19250.00', '18340.00', 1, 2, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:29:08', '2022-10-04 13:29:08'),
(492, '938012', 'ANKAR LAZANI ROUGE', '11500.00', '11000.00', '10000.00', 1, 1, 12, NULL, NULL, NULL, 21, NULL, 5, 5, '2022-10-04 13:29:45', '2022-10-04 13:30:01'),
(493, '631112', 'ANKAR LAZANI BLANC', '10400.00', '9900.00', '9000.00', 1, 1, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:30:57', '2022-10-04 13:30:57'),
(494, '450230', 'ANKAR LAZANI ROUGE DOUX', '14900.00', '14300.00', '13000.00', 1, 2, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:31:38', '2022-10-04 13:31:38'),
(495, '576590', 'ANKAR LAZANI BLANC DOUX', '14900.00', '14300.00', '13000.00', 1, 2, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-04 13:32:11', '2022-10-04 13:32:11'),
(496, '831340', 'ANKAR PELANDROVA BLANC DOUX', '16100.00', '15400.00', '11000.00', 1, 1, 12, NULL, NULL, NULL, 21, NULL, 5, 5, '2022-10-04 13:32:46', '2022-10-07 08:46:04'),
(497, '749056', 'RHUM VRAC', '4800.00', '4700.00', '4530.00', 2, 4, NULL, 150, NULL, NULL, 22, NULL, 5, NULL, '2022-10-04 13:34:03', '2022-10-04 13:34:03'),
(498, '865379', 'RHD 98 FUT', '3000000.00', '3000000.00', '2900000.00', 1, 4, 250, NULL, NULL, NULL, 22, NULL, 5, 5, '2022-10-04 13:35:19', '2022-10-20 07:21:44'),
(499, '841833', 'RHD 98 DETAIL', '13000.00', '13000.00', '11600.00', 2, 4, NULL, 250, NULL, NULL, 22, NULL, 5, 5, '2022-10-04 13:37:55', '2022-10-18 13:00:27'),
(501, '866955', 'RHD 90 DETAIL', '10000.00', '10000.00', '8750.00', 2, 4, NULL, 250, NULL, NULL, 22, NULL, 5, 5, '2022-10-04 13:39:54', '2022-10-18 13:00:54'),
(502, '915551', 'VIN VRAC', '1250.00', '1200.00', '1040.00', 2, 4, NULL, 200, NULL, NULL, 22, NULL, 5, 5, '2022-10-04 13:41:14', '2022-10-18 13:21:16'),
(503, '524317', 'SUCRES', '172000.00', '172000.00', '161200.00', 1, 2, 1, NULL, NULL, NULL, 22, NULL, 5, 5, '2022-10-04 13:42:18', '2022-10-08 12:58:07'),
(504, '454610', 'RHD 90 FUT', '2375000.00', '2375000.00', '2187500.00', 1, 4, 250, NULL, NULL, NULL, 22, NULL, 5, 5, '2022-10-04 13:48:14', '2022-10-20 07:22:04'),
(505, '998803', 'STAR YOUZOU 100 CL', '2700.00', '2700.00', '0.00', 1, 1, 12, NULL, 53, NULL, 15, NULL, 5, NULL, '2022-10-05 09:28:33', '2022-10-05 09:28:33'),
(506, '199190', 'STAR YOUZOU 30CL', '970.00', '970.00', '0.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-05 09:29:39', '2022-10-05 09:29:39'),
(507, '469476', 'STAR GRENADINE 30CL', '970.00', '970.00', '0.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-05 09:31:12', '2022-10-05 09:31:12'),
(508, '748067', 'ETER TENTATION CANNE', '4200.00', '4120.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 20, NULL, 5, 5, '2022-10-05 09:32:49', '2022-10-07 13:38:52'),
(509, '829212', 'ETER TENTANTION MOJITO', '4960.00', '4750.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-05 09:34:04', '2022-10-05 09:34:04'),
(510, '910723', 'ETER TENTATION CITRON', '4960.00', '4750.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-05 09:35:28', '2022-10-05 09:35:28'),
(511, '740776', 'SODEAM DARBEL FRAISE PET 100CL', '6550.00', '6440.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 18, NULL, 5, 5, '2022-10-05 09:36:47', '2022-10-07 13:01:22'),
(512, '493010', 'DZ FREEZE', '3500.00', '3420.00', '0.00', 1, 2, 24, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-05 09:38:24', '2022-10-07 08:22:15'),
(513, '746049', 'DZ RHUM AMBRE', '57800.00', '56700.00', '0.00', 1, 2, 1, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-05 09:39:32', '2022-10-05 09:40:07'),
(514, '855897', 'DZ RHUM BLANC 70CL', '57800.00', '56700.00', '0.00', 1, 2, 1, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-05 09:41:11', '2022-10-05 09:41:11'),
(515, '901630', 'DZ RHUM DU CHENE', '78800.00', '77300.00', '0.00', 1, 2, 1, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-05 09:42:29', '2022-10-05 09:42:29'),
(516, '817762', 'DZ CARTA BLANC 33CL', '2350.00', '2270.00', '0.00', 1, 2, 24, NULL, 111, NULL, 16, NULL, 5, NULL, '2022-10-05 09:46:30', '2022-10-05 09:46:30'),
(517, '663057', 'DZ CARTA BLANC PET 33CL', '2730.00', '2630.00', '0.00', 1, 2, 24, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-05 09:48:07', '2022-10-05 09:48:07'),
(518, '120163', 'BZ CARTA AMBRE PET 33CL', '3810.00', '3740.00', '0.00', 1, 2, 24, NULL, NULL, NULL, 16, NULL, 5, 5, '2022-10-05 09:49:06', '2022-10-05 09:50:00'),
(519, '820899', 'DZ CARTA AMBRE 33CL', '3440.00', '3370.00', '0.00', 1, 2, 24, NULL, 111, NULL, 16, NULL, 5, NULL, '2022-10-05 09:51:19', '2022-10-05 09:51:19'),
(520, '896575', 'DZ VIEUX RHUM 8 ANS', '166700.00', '166700.00', '0.00', 1, 2, 1, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-05 09:53:13', '2022-10-05 09:53:13'),
(521, '293821', 'SODEAM SMIRNOFF 70CL', '11940.00', '11820.00', '0.00', 1, 2, 12, NULL, 112, NULL, 18, NULL, 5, NULL, '2022-10-05 09:57:20', '2022-10-05 09:57:20'),
(522, '467365', 'SODEAM SMIRNOFF 37.5CL', '6600.00', '6520.00', '0.00', 1, 2, 24, NULL, 79, NULL, 18, NULL, 5, NULL, '2022-10-05 09:58:30', '2022-10-05 09:58:30'),
(523, '836769', 'SODEAM CUBA', '10200.00', '10200.00', '0.00', 1, 2, 1, NULL, 85, NULL, 18, NULL, 5, 5, '2022-10-05 09:59:33', '2022-10-07 12:48:48'),
(524, '750738', 'SODEAM MARGARITA', '14100.00', '14100.00', '0.00', 1, 2, 1, NULL, 85, NULL, 18, NULL, 5, 5, '2022-10-05 10:01:21', '2022-10-05 10:02:36'),
(525, '651251', 'SODEAM CAPIRINA', '14900.00', '14900.00', '0.00', 1, 2, 1, NULL, 85, NULL, 18, NULL, 5, 5, '2022-10-05 10:02:23', '2022-10-07 12:49:18'),
(527, '884186', 'SODEAM NAPOLEON PET 20CL', '5480.00', '5380.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 18, NULL, 5, 5, '2022-10-05 11:47:05', '2022-10-05 11:48:55'),
(528, '149383', 'SODEAM VIEAUX RHUM', '94400.00', '94400.00', '0.00', 1, 2, 1, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-05 11:50:54', '2022-10-05 11:50:54'),
(529, '883163', 'SODEAM STARNOFF CITRON 70CL', '5300.00', '5190.00', '0.00', 1, 1, 12, NULL, 82, NULL, 18, NULL, 5, 5, '2022-10-05 11:52:20', '2022-10-07 12:44:43'),
(530, '459498', 'SODEAM STARNOFF CITRON 35CL', '2880.00', '2820.00', '0.00', 1, 1, 24, NULL, 79, NULL, 18, NULL, 5, NULL, '2022-10-05 11:53:32', '2022-10-05 11:53:32'),
(531, '905434', 'SODEAM BLACK HEAD 70CL', '12340.00', '12110.00', '0.00', 1, 2, 12, NULL, 82, NULL, 18, NULL, 5, NULL, '2022-10-05 11:54:45', '2022-10-05 11:54:45'),
(532, '345094', 'ROYAL GIN BURTON 70CL', '10100.00', '10100.00', '0.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-05 11:55:55', '2022-10-05 11:55:55'),
(533, '680255', 'ROYAL MARKO FRAISE 35CL', '4600.00', '4600.00', '0.00', 1, 2, 24, NULL, 98, NULL, 18, NULL, 5, NULL, '2022-10-05 11:57:12', '2022-10-05 11:57:12'),
(534, '555650', 'ROYAL MARKO FRAISE 70CL', '8200.00', '8200.00', '0.00', 1, 2, 12, NULL, 96, NULL, 18, NULL, 5, NULL, '2022-10-05 11:58:28', '2022-10-05 11:58:28'),
(535, '946006', 'ROYAL MARKO PASSION 70CL', '8200.00', '8200.00', '0.00', 1, 2, 12, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-05 11:59:46', '2022-10-05 11:59:46'),
(536, '420505', 'ROYAL WILSON NOIR 70CL', '73200.00', '73200.00', '0.00', 1, 2, 1, NULL, 96, NULL, 19, NULL, 5, NULL, '2022-10-05 12:01:07', '2022-10-05 12:01:07'),
(537, '157986', 'ETERIA RIO BLANC 20CL', '1880.00', '1838.00', '0.00', 1, 2, 50, NULL, NULL, NULL, 20, NULL, 5, NULL, '2022-10-05 12:04:21', '2022-10-05 12:04:21'),
(538, '692327', 'ANKAR TOAMASINA PET 25CL', '1680.00', '1643.00', '0.00', 1, 2, 24, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-05 12:08:39', '2022-10-05 12:08:39'),
(539, '778180', 'TEST GADREMAKA', '115000000.00', '1200000000.00', '0.00', 2, 4, NULL, 5, NULL, NULL, 22, NULL, 5, 5, '2022-10-06 14:35:59', '2022-10-06 14:36:41'),
(540, '435686', 'STAR FANTA 100CL', '2690.00', '2690.00', '0.00', 1, 1, 12, NULL, 53, NULL, 15, NULL, 5, NULL, '2022-10-07 07:20:28', '2022-10-07 07:20:28'),
(541, '245766', 'STAR FANTA 30CL', '970.00', '970.00', '0.00', 1, 1, 24, NULL, 54, NULL, 15, NULL, 5, NULL, '2022-10-07 07:22:22', '2022-10-07 07:22:22'),
(542, '379793', 'STAR ANANAS 100CL', '2690.00', '2690.00', '0.00', 1, 1, 12, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-07 07:23:08', '2022-10-07 07:23:08'),
(543, '252380', 'STAR ANANAS 30CL', '970.00', '970.00', '0.00', 1, 1, 24, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-07 07:23:55', '2022-10-07 07:23:55'),
(544, '292240', 'STAR GRENADINE 100CL', '2700.00', '2700.00', '0.00', 1, 1, 12, NULL, NULL, NULL, 15, NULL, 5, NULL, '2022-10-07 07:28:44', '2022-10-07 07:28:44'),
(545, '789678', 'DZ 52 PRESTIGE 70CL', '51380.00', '51380.00', '0.00', 1, 2, 6, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-07 07:53:49', '2022-10-07 07:53:49'),
(546, '563804', 'DZ CVB 52 PRESTIGE 70CL', '39500.00', '39500.00', '0.00', 1, 2, 6, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-07 08:00:51', '2022-10-07 08:00:51'),
(547, '583460', 'DZ CVN 52 PRESTIGE 70CL', '44780.00', '44780.00', '0.00', 1, 2, 6, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-07 08:05:55', '2022-10-07 08:05:55'),
(548, '284635', 'DZ CLIP VIEUX RHUM', '6600.00', '6500.00', '0.00', 1, 2, 4, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-07 08:13:24', '2022-10-07 08:13:24'),
(549, '546618', 'DZ PUNCH COCO 70CL', '14950.00', '14400.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-07 08:23:32', '2022-10-07 08:23:32'),
(550, '564800', 'DZ PUNCH COCO 35CL', '11650.00', '11250.00', '0.00', 1, 2, 6, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-07 08:24:42', '2022-10-07 08:24:42'),
(551, '169088', 'DZ VIEUX RHUM 5ANS', '63900.00', '61094.00', '0.00', 1, 2, 2, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-07 08:27:04', '2022-10-07 08:27:04'),
(552, '805949', 'DZ VIEUX RHUM LOPAL 70CL', '50700.00', '50700.00', '0.00', 1, 2, 1, NULL, NULL, NULL, 16, NULL, 5, NULL, '2022-10-07 08:28:30', '2022-10-07 08:28:30'),
(553, '722544', 'ANKAR CAPITAIN JOE 25CL', '2260.00', '2210.00', '0.00', 1, 2, 48, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-07 08:31:50', '2022-10-07 08:31:50'),
(554, '498786', 'ANKAR PELANDROVA ROUGE', '13800.00', '13200.00', '0.00', 1, 2, 12, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-07 08:47:56', '2022-10-07 08:47:56'),
(555, '249237', 'ROYAL MARCKO FRAISE 70CL', '8200.00', '8200.00', '0.00', 1, 2, 12, NULL, 85, NULL, 19, NULL, 5, NULL, '2022-10-07 09:05:13', '2022-10-07 09:05:13'),
(556, '169628', 'ROYAL MARCKO FRAISE 35CL', '4600.00', '4600.00', '0.00', 1, 2, 24, NULL, 98, NULL, 19, NULL, 5, NULL, '2022-10-07 09:06:03', '2022-10-07 09:06:03'),
(558, '157947', 'SODEAM VIEUX RHUM VANILLE', '94400.00', '94400.00', '0.00', 1, 2, 1, NULL, NULL, NULL, 18, NULL, 5, NULL, '2022-10-07 12:07:37', '2022-10-07 12:07:37'),
(559, '125899', 'ANKAR LA COTE GRAND ROUGE', '26800.00', '26800.00', '0.00', 1, 2, 6, NULL, NULL, NULL, 21, NULL, 5, NULL, '2022-10-07 12:15:30', '2022-10-07 12:15:30'),
(560, '278986', 'NAMAQUA ROUGE', '25450.00', '24800.00', '0.00', 1, 2, 6, NULL, NULL, NULL, 22, NULL, 5, NULL, '2022-10-07 12:17:28', '2022-10-07 12:17:28'),
(561, '801193', 'NAMAQUA SOVINGION 70CL', '34300.00', '33420.00', '0.00', 1, 2, 6, NULL, NULL, NULL, 22, NULL, 5, NULL, '2022-10-07 12:18:25', '2022-10-07 12:18:25'),
(562, '261095', 'SODEAM GRAND CARRE BLANC 150CL', '12550.00', '12430.00', '0.00', 1, 2, 6, NULL, 80, NULL, 18, NULL, 5, NULL, '2022-10-07 12:32:05', '2022-10-07 12:32:05'),
(563, '236933', 'SODEAM GRAND CARRE BLANC 100CL', '7970.00', '7970.00', '0.00', 1, 1, 12, NULL, 77, NULL, 18, NULL, 5, 5, '2022-10-07 12:34:57', '2022-10-08 12:54:39'),
(564, '648987', 'SODEAM GRAND CARRE ROUGE 150CL', '13330.00', '13200.00', '0.00', 1, 2, 6, NULL, 80, NULL, 18, NULL, 5, NULL, '2022-10-07 12:36:33', '2022-10-07 12:36:33'),
(565, '552153', 'CGT DZAMA DE 12', '5000.00', '5000.00', '5000.00', 1, 1, 2000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:33:23', '2022-10-19 09:01:06'),
(566, '295463', 'CGT DZAMA DE 24', '5000.00', '5000.00', '5000.00', 1, 1, 2000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:33:59', '2022-10-19 09:00:35'),
(567, '124404', 'CGT SODEAM DE 24', '5000.00', '5000.00', '5000.00', 1, 1, 2000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:34:33', '2022-10-19 09:00:07'),
(568, '983481', 'CGT SODEAM DE 30', '5000.00', '5000.00', '5000.00', 1, 1, 2000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:35:09', '2022-10-19 08:59:50'),
(569, '823258', 'CGT SODEAM DE 12', '5000.00', '5000.00', '5000.00', 1, 1, 2000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:35:42', '2022-10-19 08:59:28'),
(570, '764928', 'CGT COM 12', '6500.00', '6500.00', '6500.00', 1, 1, 20000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:36:25', '2022-10-19 08:58:43'),
(571, '860730', 'CGT STAR DE 12', '8000.00', '8000.00', '8000.00', 1, 1, 20000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:37:02', '2022-10-19 08:58:16'),
(572, '621964', 'CGT STAR DE 20', '8000.00', '8000.00', '8000.00', 1, 1, 20000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:37:55', '2022-10-19 08:59:01'),
(574, '126600', 'CGT SODEAM 24', '5000.00', '5000.00', '5000.00', 1, 1, 20000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:40:04', '2022-10-19 08:58:00'),
(575, '936452', 'CGT COM 24', '6500.00', '6500.00', '6500.00', 1, 1, 20000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:42:07', '2022-10-19 08:57:26'),
(576, '210120', 'CGT DZAMA 24', '5000.00', '5000.00', '5000.00', 1, 1, 20000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:44:07', '2022-10-19 08:57:08'),
(577, '648569', 'CGT STAR DE 24', '8000.00', '8000.00', '8000.00', 1, 1, 20000, NULL, NULL, NULL, 23, NULL, 5, 5, '2022-10-19 08:44:39', '2022-10-19 08:56:39'),
(578, '389299', 'FUT', '300000.00', '300000.00', '300000.00', 1, 1, 1000, NULL, NULL, NULL, 22, NULL, 5, NULL, '2022-10-20 07:12:11', '2022-10-20 07:12:11'),
(579, '861168', 'CAPSUL', '1000.00', '1000.00', '1000.00', 1, 1, 2000, NULL, NULL, NULL, 22, NULL, 5, NULL, '2022-10-20 07:16:07', '2022-10-20 07:16:07');

-- --------------------------------------------------------

--
-- Structure de la table `prod_emballages`
--

DROP TABLE IF EXISTS `prod_emballages`;
CREATE TABLE IF NOT EXISTS `prod_emballages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL COMMENT 'Prix unitaire de vente',
  `content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL,
  `simpleOrGroup` tinyint(1) NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prod_products`
--

DROP TABLE IF EXISTS `prod_products`;
CREATE TABLE IF NOT EXISTS `prod_products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL COMMENT 'Prix unitaire de vente',
  `wholesale_price` decimal(10,2) NOT NULL COMMENT 'Prix de gros',
  `unity` int(11) NOT NULL,
  `package_type` int(11) NOT NULL COMMENT 'Type de Collisage D''Article',
  `contenance` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Nombre de colisage',
  `condition` bigint(20) UNSIGNED DEFAULT NULL,
  `simple_package_id` bigint(20) DEFAULT NULL,
  `big_package_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '2022-10-03 20:56:14', '2022-10-03 20:56:14'),
(2, 'admin', 'web', '2022-10-03 20:56:14', '2022-10-03 20:56:14'),
(3, 'caisse', 'web', '2022-10-03 20:56:14', '2022-10-03 20:56:14'),
(4, 'facturation', 'web', '2022-10-03 20:56:15', '2022-10-03 20:56:15'),
(5, 'responsable stock', 'web', '2022-10-03 20:56:15', '2022-10-03 20:56:15');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 2),
(2, 3),
(2, 4),
(3, 2),
(3, 3),
(3, 4),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(15, 4),
(16, 2),
(17, 2),
(18, 2),
(18, 5),
(19, 2),
(20, 2),
(21, 2),
(21, 3),
(22, 2),
(23, 2),
(23, 3),
(23, 4),
(23, 5),
(24, 2),
(24, 3),
(25, 2),
(26, 2),
(26, 5),
(27, 2),
(27, 3),
(28, 2),
(28, 5),
(29, 2),
(29, 5),
(30, 2),
(31, 2),
(31, 5),
(32, 2),
(32, 5),
(33, 2),
(33, 3),
(33, 4);

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_reference` bigint(20) UNSIGNED NOT NULL,
  `saleable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `saleable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` decimal(11,2) NOT NULL COMMENT 'quantité d''article',
  `action_type` int(10) UNSIGNED NOT NULL,
  `isWithEmballage` tinyint(1) NOT NULL DEFAULT '0',
  `received_at` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `status`, `invoice_number`, `article_reference`, `saleable_id`, `saleable_type`, `quantity`, `action_type`, `isWithEmballage`, `received_at`, `user_id`, `update_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '4995695', 38328, 25, 'App\\Models\\Emballage', '5.00', 2, 1, '2022-10-17', 5, NULL, '2022-10-17 13:23:53', '2022-10-17 13:32:27'),
(2, 1, '4995695', 74573, 24, 'App\\Models\\Emballage', '4.00', 2, 1, '2022-10-17', 5, NULL, '2022-10-17 13:24:13', '2022-10-17 13:32:27'),
(3, 1, '4995695', 12570, 9, 'App\\Models\\Emballage', '2.00', 2, 1, '2022-10-17', 5, NULL, '2022-10-17 13:24:30', '2022-10-17 13:32:27'),
(4, 1, '4995695', 79113, 20, 'App\\Models\\Emballage', '3.00', 2, 1, '2022-10-17', 5, NULL, '2022-10-17 13:24:50', '2022-10-17 13:32:27'),
(5, 1, '4995695', 797556, 107, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:25:16', '2022-10-17 13:32:27'),
(6, 1, '4995695', 25320, 43, 'App\\Models\\Emballage', '3.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:25:17', '2022-10-17 13:32:27'),
(7, 1, '4995695', 595749, 111, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:25:49', '2022-10-17 13:32:27'),
(8, 1, '4995695', 25320, 43, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:25:49', '2022-10-17 13:32:27'),
(9, 1, '4995695', 776115, 95, 'App\\Models\\Product', '4.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:26:09', '2022-10-17 13:32:27'),
(10, 1, '4995695', 12236, 42, 'App\\Models\\Emballage', '4.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:26:09', '2022-10-17 13:32:27'),
(11, 1, '4995695', 480813, 51, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:26:26', '2022-10-17 13:32:27'),
(12, 1, '4995695', 78232, 26, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:26:26', '2022-10-17 13:32:27'),
(13, 1, '4995695', 485694, 71, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:26:47', '2022-10-17 13:32:27'),
(14, 1, '4995695', 49459, 38, 'App\\Models\\Emballage', '3.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:26:47', '2022-10-17 13:32:27'),
(15, 1, '4995695', 894649, 52, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-17', 5, NULL, '2022-10-17 13:27:20', '2022-10-17 13:32:27'),
(16, 1, '7917191', 72758, 137, 'App\\Models\\Emballage', '5.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 08:30:57', '2022-10-18 08:34:11'),
(17, 1, '7917191', 52206, 136, 'App\\Models\\Emballage', '4.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 08:31:19', '2022-10-18 08:34:11'),
(18, 1, '7917191', 42676, 119, 'App\\Models\\Emballage', '2.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 08:31:32', '2022-10-18 08:34:11'),
(19, 1, '7917191', 35740, 131, 'App\\Models\\Emballage', '3.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 08:31:48', '2022-10-18 08:34:11'),
(20, 1, '7917191', 905927, 377, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:32:18', '2022-10-18 08:34:11'),
(21, 1, '7917191', 58188, 79, 'App\\Models\\Emballage', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:32:18', '2022-10-18 08:34:11'),
(22, 1, '7917191', 475480, 381, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:32:40', '2022-10-18 08:34:11'),
(23, 1, '7917191', 58188, 79, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:32:40', '2022-10-18 08:34:11'),
(24, 1, '7917191', 811526, 365, 'App\\Models\\Product', '4.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:32:55', '2022-10-18 08:34:11'),
(25, 1, '7917191', 84592, 78, 'App\\Models\\Emballage', '4.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:32:55', '2022-10-18 08:34:11'),
(26, 1, '7917191', 846739, 321, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:33:11', '2022-10-18 08:34:11'),
(27, 1, '7917191', 31519, 58, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:33:11', '2022-10-18 08:34:11'),
(28, 1, '7917191', 923257, 341, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:33:40', '2022-10-18 08:34:11'),
(29, 1, '7917191', 59347, 72, 'App\\Models\\Emballage', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:33:40', '2022-10-18 08:34:11'),
(30, 1, '7917191', 531325, 322, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:33:57', '2022-10-18 08:34:11'),
(34, 1, '3418867', 905927, 377, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:51:42', '2022-10-18 08:55:38'),
(35, 1, '3418867', 58188, 79, 'App\\Models\\Emballage', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:51:42', '2022-10-18 08:55:38'),
(36, 1, '3418867', 72758, 137, 'App\\Models\\Emballage', '3.00', 1, 1, '2022-10-18', 5, NULL, '2022-10-18 08:51:42', '2022-10-18 08:55:38'),
(37, 1, '3418867', 475480, 381, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:52:55', '2022-10-18 08:55:38'),
(38, 1, '3418867', 58188, 79, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:52:56', '2022-10-18 08:55:38'),
(39, 1, '3418867', 72758, 137, 'App\\Models\\Emballage', '2.00', 1, 1, '2022-10-18', 5, NULL, '2022-10-18 08:52:56', '2022-10-18 08:55:38'),
(40, 1, '3418867', 811526, 365, 'App\\Models\\Product', '4.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:53:46', '2022-10-18 08:55:38'),
(41, 1, '3418867', 84592, 78, 'App\\Models\\Emballage', '4.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:53:46', '2022-10-18 08:55:38'),
(42, 1, '3418867', 52206, 136, 'App\\Models\\Emballage', '4.00', 1, 1, '2022-10-18', 5, NULL, '2022-10-18 08:53:46', '2022-10-18 08:55:38'),
(43, 1, '3418867', 846739, 321, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:54:21', '2022-10-18 08:55:38'),
(44, 1, '3418867', 31519, 58, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:54:21', '2022-10-18 08:55:38'),
(45, 1, '3418867', 42676, 119, 'App\\Models\\Emballage', '2.00', 1, 1, '2022-10-18', 5, NULL, '2022-10-18 08:54:21', '2022-10-18 08:55:38'),
(46, 1, '3418867', 923257, 341, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:55:07', '2022-10-18 08:55:38'),
(47, 1, '3418867', 59347, 72, 'App\\Models\\Emballage', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:55:07', '2022-10-18 08:55:38'),
(48, 1, '3418867', 35740, 131, 'App\\Models\\Emballage', '3.00', 1, 1, '2022-10-18', 5, NULL, '2022-10-18 08:55:07', '2022-10-18 08:55:38'),
(49, 1, '3418867', 531325, 322, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 08:55:26', '2022-10-18 08:55:38'),
(57, 1, '7085862', 21707, 158, 'App\\Models\\Emballage', '12.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 12:17:01', '2022-10-18 12:22:49'),
(58, 1, '7085862', 41436, 159, 'App\\Models\\Emballage', '24.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 12:17:30', '2022-10-18 12:22:49'),
(59, 1, '7085862', 23222, 99, 'App\\Models\\Emballage', '12.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:18:35', '2022-10-18 12:22:49'),
(60, 1, '7085862', 400003, 443, 'App\\Models\\Product', '12.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:18:35', '2022-10-18 12:22:49'),
(61, 1, '7085862', 64945, 100, 'App\\Models\\Emballage', '24.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:20:48', '2022-10-18 12:22:49'),
(62, 1, '7085862', 538524, 444, 'App\\Models\\Product', '24.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:20:48', '2022-10-18 12:22:49'),
(63, 1, '5138533', 19742, 134, 'App\\Models\\Emballage', '12.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 12:33:43', '2022-10-18 12:35:28'),
(64, 1, '5138533', 21707, 158, 'App\\Models\\Emballage', '12.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 12:34:03', '2022-10-18 12:35:28'),
(65, 1, '5138533', 96448, 76, 'App\\Models\\Emballage', '12.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:34:36', '2022-10-18 12:35:28'),
(66, 1, '5138533', 952599, 364, 'App\\Models\\Product', '12.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:34:36', '2022-10-18 12:35:28'),
(67, 1, '5138533', 23222, 99, 'App\\Models\\Emballage', '12.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:34:55', '2022-10-18 12:35:28'),
(68, 1, '5138533', 400003, 443, 'App\\Models\\Product', '12.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:34:55', '2022-10-18 12:35:28'),
(69, 1, '6360941', 965486, 413, 'App\\Models\\Product', '5.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:37:55', '2022-10-18 12:38:57'),
(70, 1, '6360941', 65450, 95, 'App\\Models\\Emballage', '5.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:37:55', '2022-10-18 12:38:57'),
(71, 1, '6360941', 25764, 153, 'App\\Models\\Emballage', '5.00', 1, 1, '2022-10-18', 5, NULL, '2022-10-18 12:37:55', '2022-10-18 12:38:57'),
(72, 1, '6360941', 965486, 413, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:38:40', '2022-10-18 12:38:57'),
(73, 1, '6360941', 65450, 95, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:38:40', '2022-10-18 12:38:57'),
(74, 1, '6360941', 25764, 153, 'App\\Models\\Emballage', '2.00', 1, 1, '2022-10-18', 5, NULL, '2022-10-18 12:38:40', '2022-10-18 12:38:57'),
(75, 1, '8580099', 25764, 153, 'App\\Models\\Emballage', '1.00', 2, 1, '2022-10-18', 5, NULL, '2022-10-18 12:40:29', '2022-10-18 12:40:54'),
(76, 1, '8580099', 965486, 413, 'App\\Models\\Product', '1.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:40:44', '2022-10-18 12:40:54'),
(77, 1, '8580099', 65450, 95, 'App\\Models\\Emballage', '1.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:40:44', '2022-10-18 12:40:54'),
(78, 1, '1492367', 965486, 413, 'App\\Models\\Product', '1.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:50:18', '2022-10-18 12:50:34'),
(79, 1, '1492367', 65450, 95, 'App\\Models\\Emballage', '1.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 12:50:18', '2022-10-18 12:50:34'),
(80, 1, '1492367', 25764, 153, 'App\\Models\\Emballage', '3.00', 1, 1, '2022-10-18', 5, NULL, '2022-10-18 12:50:18', '2022-10-18 12:50:34'),
(81, 1, '1813395', 965486, 413, 'App\\Models\\Product', '4.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-18 12:51:57', '2022-10-18 12:52:16'),
(82, 1, '1813395', 65450, 95, 'App\\Models\\Emballage', '10.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-18 12:51:57', '2022-10-18 12:52:16'),
(83, 1, '1813395', 965486, 413, 'App\\Models\\Product', '6.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-18 12:51:57', '2022-10-18 12:52:16'),
(84, 1, '1813395', 25764, 153, 'App\\Models\\Emballage', '10.00', 1, 1, '2022-10-19', 5, NULL, '2022-10-18 12:51:57', '2022-10-18 12:52:16'),
(88, 1, '3606188', 915551, 502, 'App\\Models\\Product', '200.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 13:22:47', '2022-10-18 13:24:03'),
(89, 1, '3606188', 915551, 502, 'App\\Models\\Product', '100.00', 1, 0, '2022-10-18', 5, NULL, '2022-10-18 13:23:01', '2022-10-18 13:24:03'),
(90, 1, '3797941', 26435, 52, 'App\\Models\\Emballage', '20.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-19 08:50:04', '2022-10-19 08:51:21'),
(91, 1, '3797941', 370019, 271, 'App\\Models\\Product', '20.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-19 08:50:04', '2022-10-19 08:51:21'),
(92, 1, '3797941', 94503, 113, 'App\\Models\\Emballage', '15.00', 1, 1, '2022-10-19', 5, NULL, '2022-10-19 08:50:04', '2022-10-19 08:51:21'),
(93, 1, '3797941', 621964, 572, 'App\\Models\\Product', '1.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-19 08:50:15', '2022-10-19 08:51:21'),
(94, 1, '3797941', 915551, 502, 'App\\Models\\Product', '200.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-19 08:50:39', '2022-10-19 08:51:21'),
(95, 1, '3797941', 915551, 502, 'App\\Models\\Product', '3.50', 1, 0, '2022-10-19', 5, NULL, '2022-10-19 08:50:57', '2022-10-19 08:51:21'),
(96, 1, '4462122', 370019, 271, 'App\\Models\\Product', '5.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-19 08:53:21', '2022-10-19 08:53:59'),
(97, 1, '4462122', 26435, 52, 'App\\Models\\Emballage', '5.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-19 08:53:21', '2022-10-19 08:53:59'),
(98, 1, '4462122', 94503, 113, 'App\\Models\\Emballage', '2.00', 1, 1, '2022-10-19', 5, NULL, '2022-10-19 08:53:21', '2022-10-19 08:53:59'),
(99, 1, '4462122', 621964, 572, 'App\\Models\\Product', '1.00', 1, 0, '2022-10-19', 5, NULL, '2022-10-19 08:53:45', '2022-10-19 08:53:59'),
(100, 1, '4268815', 952599, 364, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-19', 19, NULL, '2022-10-19 12:45:36', '2022-10-19 12:50:24'),
(101, 1, '4268815', 96448, 76, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-19', 19, NULL, '2022-10-19 12:45:36', '2022-10-19 12:50:24'),
(104, 1, '4268815', 400003, 443, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-19', 19, NULL, '2022-10-19 12:47:59', '2022-10-19 12:50:24'),
(105, 1, '4268815', 23222, 99, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-19', 19, NULL, '2022-10-19 12:47:59', '2022-10-19 12:50:24'),
(106, 1, '4268815', 21707, 158, 'App\\Models\\Emballage', '2.00', 1, 1, '2022-10-19', 19, NULL, '2022-10-19 12:47:59', '2022-10-19 12:50:24'),
(107, 1, '4268815', 430928, 343, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-19', 19, NULL, '2022-10-19 12:49:23', '2022-10-19 12:50:24'),
(108, 1, '4268815', 35705, 71, 'App\\Models\\Emballage', '2.00', 1, 0, '2022-10-19', 19, NULL, '2022-10-19 12:49:23', '2022-10-19 12:50:24'),
(109, 1, '4268815', 61118, 130, 'App\\Models\\Emballage', '2.00', 1, 1, '2022-10-19', 19, NULL, '2022-10-19 12:49:24', '2022-10-19 12:50:24'),
(110, 1, '1577823', 749056, 497, 'App\\Models\\Product', '5.50', 1, 0, '2022-10-19', 19, NULL, '2022-10-19 17:50:40', '2022-10-19 17:57:16'),
(111, 1, '8853009', 454610, 504, 'App\\Models\\Product', '3.00', 1, 0, '2022-10-20', 5, NULL, '2022-10-20 07:24:45', '2022-10-20 07:26:01'),
(112, 1, '8853009', 865379, 498, 'App\\Models\\Product', '2.00', 1, 0, '2022-10-20', 5, NULL, '2022-10-20 07:25:03', '2022-10-20 07:26:01'),
(113, 1, '8853009', 861168, 579, 'App\\Models\\Product', '5.00', 1, 0, '2022-10-20', 5, NULL, '2022-10-20 07:25:18', '2022-10-20 07:26:01'),
(114, 1, '8853009', 915551, 502, 'App\\Models\\Product', '25.50', 1, 0, '2022-10-20', 5, NULL, '2022-10-20 07:25:45', '2022-10-20 07:26:01');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `min_stock_day` bigint(20) UNSIGNED NOT NULL COMMENT 'Minumum jour pour le stock',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `min_stock_day`, `created_at`, `updated_at`) VALUES
(1, 8, 15, '2022-10-13 21:42:51', '2022-10-13 21:45:43');

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '2',
  `invoice_number` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_reference` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stockable_id` bigint(20) UNSIGNED NOT NULL,
  `stockable_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_facture` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'N®Facture n''a Bl fournisseur',
  `entry` decimal(11,2) DEFAULT '0.00',
  `out` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT 'quantité a sorti',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action_type` int(11) NOT NULL DEFAULT '1' COMMENT 'type d''action',
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'commentaire',
  `date` date NOT NULL DEFAULT '2022-09-26',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stocks_inventory_id_foreign` (`inventory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stocks`
--

INSERT INTO `stocks` (`id`, `status`, `invoice_number`, `article_reference`, `stockable_id`, `stockable_type`, `supplier_id`, `reference_facture`, `entry`, `out`, `user_id`, `inventory_id`, `action_type`, `comment`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, '6158357', '797556', 107, 'App\\Models\\Product', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:43:23', '2022-10-17 12:59:27'),
(2, 2, '6158357', '25320', 43, 'App\\Models\\Emballage', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:43:23', '2022-10-17 12:59:27'),
(3, 2, '6158357', '595749', 111, 'App\\Models\\Product', 1, 'TEST', '2.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:47:10', '2022-10-17 12:59:27'),
(4, 2, '6158357', '25320', 43, 'App\\Models\\Emballage', 1, 'TEST', '2.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:47:10', '2022-10-17 12:59:27'),
(5, 2, '6158357', '776115', 95, 'App\\Models\\Product', 1, 'TEST', '4.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:47:55', '2022-10-17 12:59:27'),
(6, 2, '6158357', '12236', 42, 'App\\Models\\Emballage', 1, 'TEST', '4.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:47:56', '2022-10-17 12:59:27'),
(7, 2, '6158357', '480813', 51, 'App\\Models\\Product', 1, 'TEST', '2.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:48:48', '2022-10-17 12:59:27'),
(8, 2, '6158357', '78232', 26, 'App\\Models\\Emballage', 1, 'TEST', '2.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:48:48', '2022-10-17 12:59:27'),
(9, 2, '6158357', '485694', 71, 'App\\Models\\Product', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:49:49', '2022-10-17 12:59:27'),
(10, 2, '6158357', '49459', 38, 'App\\Models\\Emballage', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:49:49', '2022-10-17 12:59:28'),
(11, 2, '6158357', '894649', 52, 'App\\Models\\Product', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-17', '2022-10-17 12:51:19', '2022-10-17 12:59:28'),
(14, 2, '4109200', '905927', 377, 'App\\Models\\Product', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:25:42', '2022-10-18 08:28:54'),
(15, 2, '4109200', '58188', 79, 'App\\Models\\Emballage', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:25:42', '2022-10-18 08:28:54'),
(16, 2, '4109200', '475480', 381, 'App\\Models\\Product', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:26:17', '2022-10-18 08:28:54'),
(17, 2, '4109200', '58188', 79, 'App\\Models\\Emballage', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:26:17', '2022-10-18 08:28:54'),
(18, 2, '4109200', '811526', 365, 'App\\Models\\Product', 1, 'TEST', '4.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:26:34', '2022-10-18 08:28:54'),
(19, 2, '4109200', '84592', 78, 'App\\Models\\Emballage', 1, 'TEST', '4.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:26:34', '2022-10-18 08:28:54'),
(20, 2, '4109200', '846739', 321, 'App\\Models\\Product', 1, 'TEST', '2.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:26:54', '2022-10-18 08:28:54'),
(21, 2, '4109200', '31519', 58, 'App\\Models\\Emballage', 1, 'TEST', '2.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:26:54', '2022-10-18 08:28:54'),
(22, 2, '4109200', '923257', 341, 'App\\Models\\Product', 1, 'TEST', '2.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:27:26', '2022-10-18 08:28:54'),
(23, 2, '4109200', '59347', 72, 'App\\Models\\Emballage', 1, 'TEST', '2.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:27:26', '2022-10-18 08:28:54'),
(24, 2, '4109200', '531325', 322, 'App\\Models\\Product', 1, 'TEST', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:28:04', '2022-10-18 08:28:54'),
(25, 2, '4109200', '923257', 341, 'App\\Models\\Product', 1, 'TEST', '1.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:28:36', '2022-10-18 08:28:54'),
(26, 2, '4109200', '59347', 72, 'App\\Models\\Emballage', 1, 'TEST', '1.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:28:36', '2022-10-18 08:28:54'),
(27, 2, '1850095', '905927', 377, 'App\\Models\\Product', 1, 'TEST ENTREE', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:46:35', '2022-10-18 08:48:16'),
(28, 2, '1850095', '58188', 79, 'App\\Models\\Emballage', 1, 'TEST ENTREE', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:46:35', '2022-10-18 08:48:16'),
(29, 2, '1850095', '475480', 381, 'App\\Models\\Product', 1, 'TEST ENTREE', '2.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:46:54', '2022-10-18 08:48:16'),
(30, 2, '1850095', '58188', 79, 'App\\Models\\Emballage', 1, 'TEST ENTREE', '2.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:46:54', '2022-10-18 08:48:16'),
(31, 2, '1850095', '811526', 365, 'App\\Models\\Product', 1, 'TEST ENTREE', '4.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:47:07', '2022-10-18 08:48:17'),
(32, 2, '1850095', '84592', 78, 'App\\Models\\Emballage', 1, 'TEST ENTREE', '4.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:47:07', '2022-10-18 08:48:17'),
(33, 2, '1850095', '846739', 321, 'App\\Models\\Product', 1, 'TEST ENTREE', '2.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:47:17', '2022-10-18 08:48:17'),
(34, 2, '1850095', '31519', 58, 'App\\Models\\Emballage', 1, 'TEST ENTREE', '2.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:47:18', '2022-10-18 08:48:17'),
(35, 2, '1850095', '923257', 341, 'App\\Models\\Product', 1, 'TEST ENTREE', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:47:32', '2022-10-18 08:48:17'),
(36, 2, '1850095', '59347', 72, 'App\\Models\\Emballage', 1, 'TEST ENTREE', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:47:32', '2022-10-18 08:48:17'),
(37, 2, '1850095', '531325', 322, 'App\\Models\\Product', 1, 'TEST ENTREE', '3.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 08:47:53', '2022-10-18 08:48:17'),
(38, 2, '8678008', '952599', 364, 'App\\Models\\Product', 1, '564', '6.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 09:38:36', '2022-10-18 09:49:22'),
(39, 2, '8678008', '96448', 76, 'App\\Models\\Emballage', 1, '564', '6.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 09:38:36', '2022-10-18 09:49:22'),
(40, 2, '8678008', '811526', 365, 'App\\Models\\Product', 1, '564', '12.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 09:39:24', '2022-10-18 09:49:22'),
(41, 2, '8678008', '84592', 78, 'App\\Models\\Emballage', 1, '564', '12.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 09:39:24', '2022-10-18 09:49:22'),
(46, 2, '4098628', '23222', 99, 'App\\Models\\Emballage', 1, '21', '12.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 11:56:47', '2022-10-18 11:58:36'),
(47, 2, '4098628', '400003', 443, 'App\\Models\\Product', 1, '21', '12.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 11:56:47', '2022-10-18 11:58:36'),
(48, 2, '4098628', '64945', 100, 'App\\Models\\Emballage', 1, '21', '24.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 11:57:03', '2022-10-18 11:58:36'),
(49, 2, '4098628', '538524', 444, 'App\\Models\\Product', 1, '21', '24.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 11:57:03', '2022-10-18 11:58:36'),
(50, 2, '4962151', '96448', 76, 'App\\Models\\Emballage', 2, 'BE202', '12.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:28:36', '2022-10-18 12:31:39'),
(51, 2, '4962151', '952599', 364, 'App\\Models\\Product', 2, 'BE202', '12.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:28:36', '2022-10-18 12:31:39'),
(52, 2, '4962151', '23222', 99, 'App\\Models\\Emballage', 2, 'BE202', '12.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:28:58', '2022-10-18 12:31:39'),
(53, 2, '4962151', '400003', 443, 'App\\Models\\Product', 2, 'BE202', '12.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:28:58', '2022-10-18 12:31:39'),
(54, 2, '3069470', '965486', 413, 'App\\Models\\Product', 1, '8884', '4.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:37:02', '2022-10-18 12:37:14'),
(55, 2, '3069470', '65450', 95, 'App\\Models\\Emballage', 1, '8884', '10.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:37:02', '2022-10-18 12:37:14'),
(56, 2, '3069470', '965486', 413, 'App\\Models\\Product', 1, '8884', '6.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:37:02', '2022-10-18 12:37:14'),
(57, 2, '4621954', '65450', 95, 'App\\Models\\Emballage', 2, '12', '96.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:51:11', '2022-10-18 12:51:29'),
(58, 2, '4621954', '965486', 413, 'App\\Models\\Product', 2, '12', '96.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 12:51:11', '2022-10-18 12:51:29'),
(59, 2, '2724672', '915551', 502, 'App\\Models\\Product', 2, '5454', '1000.00', '0.00', 5, NULL, 1, '', '2022-10-18', '2022-10-18 13:18:53', '2022-10-18 13:19:05'),
(60, 2, NULL, '552153', 565, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:33:24', '2022-10-19 08:33:24'),
(61, 2, NULL, '295463', 566, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:33:59', '2022-10-19 08:33:59'),
(62, 2, NULL, '124404', 567, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:34:35', '2022-10-19 08:34:35'),
(63, 2, NULL, '983481', 568, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:35:09', '2022-10-19 08:35:09'),
(64, 2, NULL, '823258', 569, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:35:42', '2022-10-19 08:35:42'),
(65, 2, NULL, '764928', 570, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:36:25', '2022-10-19 08:36:25'),
(66, 2, NULL, '860730', 571, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:37:02', '2022-10-19 08:37:02'),
(67, 2, NULL, '621964', 572, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:37:55', '2022-10-19 08:37:55'),
(68, 2, NULL, '141229', 573, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:40:04', '2022-10-19 08:40:04'),
(69, 2, NULL, '126600', 574, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:40:04', '2022-10-19 08:40:04'),
(70, 2, NULL, '936452', 575, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:42:08', '2022-10-19 08:42:08'),
(71, 2, NULL, '210120', 576, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:44:08', '2022-10-19 08:44:08'),
(72, 2, NULL, '648569', 577, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:44:39', '2022-10-19 08:44:39'),
(73, 2, '5435325', '26435', 52, 'App\\Models\\Emballage', 1, 'TEST ENTREE', '40.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:45:08', '2022-10-19 08:48:16'),
(74, 2, '5435325', '370019', 271, 'App\\Models\\Product', 1, 'TEST ENTREE', '40.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:45:08', '2022-10-19 08:48:16'),
(75, 2, '5435325', '43284', 54, 'App\\Models\\Emballage', 1, 'TEST ENTREE', '24.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:46:31', '2022-10-19 08:48:16'),
(76, 2, '5435325', '432782', 272, 'App\\Models\\Product', 1, 'TEST ENTREE', '24.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:46:31', '2022-10-19 08:48:16'),
(77, 2, '5435325', '621964', 572, 'App\\Models\\Product', 1, 'TEST ENTREE', '2.00', '0.00', 5, NULL, 1, '', '2022-10-19', '2022-10-19 08:47:44', '2022-10-19 08:48:16'),
(78, 2, '8066409', '952599', 364, 'App\\Models\\Product', 2, '17/BE202', '2.00', '0.00', 19, NULL, 1, '', '2022-10-19', '2022-10-19 12:41:41', '2022-10-19 12:43:13'),
(79, 2, '8066409', '96448', 76, 'App\\Models\\Emballage', 2, '17/BE202', '2.00', '0.00', 19, NULL, 1, '', '2022-10-19', '2022-10-19 12:41:41', '2022-10-19 12:43:13'),
(80, 2, '8066409', '400003', 443, 'App\\Models\\Product', 2, '17/BE202', '2.00', '0.00', 19, NULL, 1, '', '2022-10-19', '2022-10-19 12:42:00', '2022-10-19 12:43:13'),
(81, 2, '8066409', '23222', 99, 'App\\Models\\Emballage', 2, '17/BE202', '2.00', '0.00', 19, NULL, 1, '', '2022-10-19', '2022-10-19 12:42:00', '2022-10-19 12:43:13'),
(82, 2, '8066409', '430928', 343, 'App\\Models\\Product', 2, '17/BE202', '2.00', '0.00', 19, NULL, 1, '', '2022-10-19', '2022-10-19 12:42:19', '2022-10-19 12:43:13'),
(83, 2, '8066409', '35705', 71, 'App\\Models\\Emballage', 2, '17/BE202', '2.00', '0.00', 19, NULL, 1, '', '2022-10-19', '2022-10-19 12:42:19', '2022-10-19 12:43:13'),
(84, 2, '4118353', '749056', 497, 'App\\Models\\Product', 2, 'BE203', '5.50', '0.00', 19, NULL, 1, '', '2022-10-19', '2022-10-19 17:46:58', '2022-10-19 17:48:35'),
(85, 2, NULL, '389299', 578, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-20', '2022-10-20 07:12:11', '2022-10-20 07:12:11'),
(86, 2, NULL, '861168', 579, 'App\\Models\\Product', NULL, NULL, '0.00', '0.00', 5, NULL, 1, '', '2022-10-20', '2022-10-20 07:16:08', '2022-10-20 07:16:08'),
(87, 2, '3043805', '454610', 504, 'App\\Models\\Product', 2, 'BL014785', '5.00', '0.00', 5, NULL, 1, '', '2022-10-20', '2022-10-20 07:22:34', '2022-10-20 07:23:39'),
(88, 2, '3043805', '865379', 498, 'App\\Models\\Product', 2, 'BL014785', '10.00', '0.00', 5, NULL, 1, '', '2022-10-20', '2022-10-20 07:22:50', '2022-10-20 07:23:39'),
(89, 2, '3043805', '861168', 579, 'App\\Models\\Product', 2, 'BL014785', '50.00', '0.00', 5, NULL, 1, '', '2022-10-20', '2022-10-20 07:23:18', '2022-10-20 07:23:39'),
(90, 2, NULL, '915551', 502, 'App\\Models\\Product', NULL, NULL, '0.00', '371.00', 5, 2, 1, '', '2022-10-20', '2022-10-20 08:09:56', '2022-10-20 08:09:56'),
(91, 2, '8835483', '915551', 502, 'App\\Models\\Product', NULL, NULL, '0.00', '50.00', 5, NULL, 2, 'SORTIE PATRON', '2022-10-20', '2022-10-20 08:15:37', '2022-10-20 08:17:14');

-- --------------------------------------------------------

--
-- Structure de la table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `suppliers`
--

INSERT INTO `suppliers` (`id`, `code`, `bank_number`, `identification`, `email`, `phone`, `address`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '429111', NULL, 'Sodeame', NULL, '00', 'Tamatave', NULL, 5, '2022-10-04 19:54:27', '2022-10-04 19:54:27'),
(2, '655858', NULL, 'T/BAO V', 'chan.yann@yahoo.fr', '+261341588788', '11 Rue Amiral Billard', NULL, 5, '2022-10-18 12:30:40', '2022-10-18 12:30:40');

-- --------------------------------------------------------

--
-- Structure de la table `supplier_orders`
--

DROP TABLE IF EXISTS `supplier_orders`;
CREATE TABLE IF NOT EXISTS `supplier_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `article_reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL COMMENT 'quantité d''article',
  `pricing_id` bigint(20) NOT NULL,
  `isWithEmballage` tinyint(1) NOT NULL DEFAULT '0',
  `received_at` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `isAdjustment` tinyint(1) NOT NULL DEFAULT '0',
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-Actif 1-Passif',
  `permission_access` int(191) NOT NULL DEFAULT '3' COMMENT '1->Super Admin | 2->Admin | 3->Facturation 1 | 4->...',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CIN',
  `birth_date` date DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'giriş yapacak kullanıcının telefon numarası',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'photo de profil',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Adres',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci COMMENT 'description de l''utilisateur',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `status`, `permission_access`, `name`, `surname`, `identity_number`, `birth_date`, `email`, `phone`, `image`, `address`, `password`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'super', 'admin', '268', '2022-05-16', 'superadmin@gmail.com', '0340000000', 'storage/users/17052022070535-2730.jpg', 'demo', '$2y$10$j.g3OMHnZDn79O8YKp5D3OGpqt9MjTyWmly9WHK9LjwaE1nhxBS.C', 'demo', '2022-05-11 11:58:09', '2022-05-17 04:46:35'),
(18, 1, 5, 'AIME', 'AIME', '00', '2022-03-03', 'stock@gmail.com', '0', NULL, 'TAMATAVE', '$2y$10$g4ggBwHW8fARrlEHmD1NJus4Eb/ZabR5K8Xti4T//A1DiK/zOQpHu', NULL, '2022-10-05 13:03:41', '2022-10-05 13:03:41'),
(19, 1, 2, 'PATRON', 'PATRON', '00', '2022-03-05', 'patron@gmail.com', '00', NULL, 'TAMATAVE', '$2y$10$s0em6RhPKp.PD/laTeGpQ.lzf3EY0a9UAtYN/KUBV37txDnJmzclS', NULL, '2022-10-05 13:04:48', '2022-10-05 13:04:48'),
(17, 1, 3, 'AIME', 'AIME', '00', '2022-03-07', 'aime@gmail.com', '00', NULL, 'TAMATAVE', '$2y$10$UQswZBoWyMo2eHapNTmDfePHwA1vE7yx1k2dJqS8MfxEPXQdPbPIW', NULL, '2022-10-05 12:59:34', '2022-10-05 12:59:34'),
(5, 1, 2, 'BOTOUDI', 'VIRGINO', '00101456', '0008-09-14', 'michelvirgino032@gmail.com', '+261204479337', NULL, 'TAMATAVE', '$2y$10$wRuUfWrE9FgrJcahMW9fpea6Wo97TnZ7qscqIjtDWRx6r3za.qheC', NULL, '2022-06-20 09:45:33', '2022-10-04 02:56:57'),
(6, 1, 1, 'RANDRIANJANDRY', 'Jonathan', '3000', '2021-12-28', 'jonths@outlook.com', '33', 'storage/users/20062022210635-1916.jpg', 'rerer', '$2y$10$NYMCrIht/8TMRhML7TEnJ.8jn7PRhCpezKcbnqS7hEAYpc6qLfYkS', NULL, '2022-06-20 18:54:35', '2022-10-04 02:42:42'),
(14, 1, 1, 'Ramarokoto', 'JeanFrançois', '3434343', '2002-11-22', 'francoisjean807@gmail.com', '03422', NULL, 'mangarano', '$2y$10$0MCLVh/qrviXlC2zwxhsmuu3q.PC8mW7f8NZmWyNrlNzUEMt1mWVa', NULL, '2022-10-04 03:26:46', '2022-10-04 03:26:46'),
(20, 1, 2, 'MADAME', 'MADAME', '00', '2022-03-06', 'madame@gmail.com', '00', NULL, 'TAMATAVE', '$2y$10$OI/mzzhYbD8AYZst3AfFhueXhkp/3ejrQ/CbnO8BcKo3qkcKkO.SW', NULL, '2022-10-05 13:08:50', '2022-10-05 13:08:50'),
(15, 1, 4, 'ANGELINE', 'ANGELINE', '00', '2022-03-01', 'angeline@gmail.com', '00', NULL, 'tamatave', '$2y$10$nEAvwftBqiKylv8lw440y.Hykz5127LshrlJpoOEk9jd9XSOwSfum', NULL, '2022-10-05 12:56:01', '2022-10-05 12:56:01'),
(16, 1, 4, 'PATRICIA', 'PATRICIA', '00', '2022-02-28', 'patricia@gmail.com', '00', 'uploads/users/061020222310215494.jpg', 'tamatave', '$2y$10$ItQEu6A1DpQ15YtFALxjL.tKvNfVPNiLPZAaVw1lXNOSK.iGLzGJ2', NULL, '2022-10-05 12:57:38', '2022-10-06 21:15:22'),
(12, 1, 3, 'Rafael Deleon', 'Morrow', '822', '1982-01-25', 'caisse@magasin.com', '+1 (831) 273-6982', NULL, 'Aut necessitatibus q', '$2y$10$GcwrKhX7aRJXcAOwKgmdzeyvO3JxJfS4m6K4Z7EroZ8haLcK7ZIiy', 'Sunt nisi natus odit', '2022-10-03 22:26:35', '2022-10-03 22:26:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
