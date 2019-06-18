-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 04 juin 2019 à 13:32
-- Version du serveur :  10.1.40-MariaDB
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `userid` text NOT NULL,
  `genre` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `files`
--

INSERT INTO `files` (`id`, `name`, `file_url`, `userid`, `genre`) VALUES
(1, 'RELEVE SANTANDER FEVRIER 2019.pdf', 'files/RELEVE SANTANDER FEVRIER 2019.pdf', '', ''),
(2, 'WebPage.pdf', 'files/WebPage.pdf', '', ''),
(3, 'RELEVE SANTANDER FEVRIER 2019.pdf', 'files/RELEVE SANTANDER FEVRIER 2019.pdf', '13', ''),
(4, 'facture formation conduite .pdf', 'files/facture formation conduite .pdf', '13', ''),
(5, 'Facture AUSTUDIO v2.pdf', 'files/Facture AUSTUDIO v2.pdf', '13', ''),
(6, 'Facture AUSTUDIO.pdf', 'files/Facture AUSTUDIO.pdf', '14', ''),
(7, 'Facture Acting international V1 (1).pdf', 'files/Facture Acting international V1 (1).pdf', '14', ''),
(8, 'Facture AUSTUDIO.pdf', 'files/Facture AUSTUDIO.pdf', '13', 'documentperso');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
