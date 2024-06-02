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
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `ID_Event` int(11) NOT NULL,
  `ID_Emetteur` int(11) NOT NULL,
  `Lien` varchar(255) NOT NULL DEFAULT 'documents/event/event.jpg',
  `Nom` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Heure` varchar(255) NOT NULL,
  `Lieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`ID_Event`, `ID_Emetteur`, `Lien`, `Nom`, `Description`, `Date`, `Heure`, `Lieu`) VALUES
(3, 1, 'documents/event/17018.jpg', 'test', '', '2024-05-31', '', ''),
(4, 5, 'documents/event/event.jpg', 'TestFinal', 'TestFinal', '2024-06-02', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ID_Event`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `ID_Event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
