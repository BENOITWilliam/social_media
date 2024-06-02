-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 01 juin 2024 à 17:18
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `likedin`
--

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE `relation` (
  `ID_relation` int(11) NOT NULL,
  `ID_demandeur_ami` int(11) DEFAULT NULL,
  `ID_ami` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`ID_relation`, `ID_demandeur_ami`, `ID_ami`) VALUES
(1, 2, 1),
(2, 1, 2),
(3, 18, 1),
(4, 18, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`ID_relation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `relation`
--
ALTER TABLE `relation`
  MODIFY `ID_relation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
