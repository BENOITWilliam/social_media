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
-- Structure de la table `reaction`
--

CREATE TABLE `reaction` (
  `ID` int(11) NOT NULL,
  `ID_Post` int(11) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `ID_Emetteur` int(11) NOT NULL,
  `aime` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reaction`
--

INSERT INTO `reaction` (`ID`, `ID_Post`, `Description`, `ID_Emetteur`, `aime`) VALUES
(2, 129, NULL, 4, 1),
(3, 131, NULL, 1, 0),
(4, 132, NULL, 1, 0),
(5, 132, 'azerty\r\n', 4, 0),
(6, 129, NULL, 10, 1),
(7, 129, NULL, 11, 1),
(8, 129, NULL, 13, 1),
(42, 130, 'lil', 4, 0),
(43, 131, NULL, 4, 0),
(44, 131, 'test', 2, 0),
(45, 129, NULL, 666, 55),
(46, 135, NULL, 4, 1),
(47, 138, 'test 1', 4, 0),
(48, 130, 'test', 2, 0),
(49, 135, NULL, 2, 0),
(50, 129, 'Ceci est la vérité ', 2, 0),
(53, 129, 'wallah c vrai', 1, 0),
(54, 1, 'Merci à tous', 1, 1),
(55, 1, 'Un beau couché de soleil !', 2, 1),
(56, 1, 'Pas mal', 3, 1),
(57, 5, NULL, 3, 1),
(58, 9, NULL, 3, 1),
(59, 3, NULL, 1, 0),
(60, 8, NULL, 1, 0),
(61, 3, NULL, 3, 0),
(62, 8, 'Magnifique sa mère (de Kyliann) !', 2, 0),
(63, 5, 'Une belle image de moi !', 2, 0),
(64, 4, NULL, 2, 0),
(65, 3, NULL, 2, 0),
(66, 2, NULL, 2, 0),
(67, 5, NULL, 1, 0),
(68, 3, NULL, 5, 1),
(69, 1, 'C\'est beau !', 5, 1),
(70, 10, '\'a\'', 5, 0),
(71, 5, '\"', 5, 0),
(72, 10, 'cuzhczba', 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
