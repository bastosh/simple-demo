-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  db764224269.hosting-data.io
-- Généré le :  Mar 04 Décembre 2018 à 10:04
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP :  7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db764224269`
--

-- --------------------------------------------------------

--
-- Structure de la table `demos`
--

CREATE TABLE `demos` (
  `id` int(3) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `image` varchar(30) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `demos`
--

INSERT INTO `demos` (`id`, `title`, `image`, `published`, `created_at`, `updated_at`) VALUES
(1, 'landing', 'demo-landing.png', 1, '2018-12-04 07:13:44', '2018-12-04 09:42:08');

-- --------------------------------------------------------

--
-- Structure de la table `features`
--

CREATE TABLE `features` (
  `id` int(3) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `features`
--

INSERT INTO `features` (`id`, `title`, `description`, `published`, `created_at`, `updated_at`) VALUES
(1, 'MVC structure', 'Models, views, controllers, well orgazined in their&nbsp;folders', 1, '2018-11-28 09:49:27', '2018-11-28 10:51:20'),
(2, 'Core features', 'Autoloading, dependency injection, request handling, routing, CRUD methods, flash&nbsp;messages', 1, '2018-11-28 09:49:27', '2018-11-28 10:49:27'),
(3, 'Frontend helpers', 'Foundation and Twig to quickly craft nice web&nbsp;pages', 1, '2018-11-28 09:49:27', '2018-11-28 10:49:27'),
(4, 'Assets compilation', 'A Gulpfile to compile (saas), minify (cssnano) and clean (purgecss) your&nbsp;CSS', 1, '2018-11-28 09:49:27', '2018-11-28 10:49:27'),
(5, 'Clean code', 'Well structured, and namespaced&nbsp;project', 1, '2018-11-28 09:49:27', '2018-11-28 10:49:27'),
(6, 'Documentation', 'A nice documentation to get&nbsp;started', 1, '2018-11-28 09:49:27', '2018-11-28 10:49:27'),
(7, 'Unpublished feature', 'This one is a draft', 0, '2018-11-28 09:49:27', '2018-11-30 16:16:51');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(3) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `published`, `image`, `created_at`, `updated_at`) VALUES
(1, 'New kids on the blog!', '<h2>This is the first one</h2>\r\n\r\n<p>A first post is always an event. For sure.</p>\r\n', 1, '', '2018-11-26 10:15:37', '2018-11-28 11:16:52'),
(2, 'An article', '<h2>This is a title</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 1, 'laptop.jpg', '2018-11-27 09:16:25', '2018-12-03 20:33:19'),
(3, 'Another article', '<h2>A title</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 1, 'laptop2.jpg', '2018-11-28 09:16:30', '2018-12-03 17:36:50');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `demos`
--
ALTER TABLE `demos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `demos`
--
ALTER TABLE `demos`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
