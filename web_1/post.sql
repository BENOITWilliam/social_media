-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 28 mai 2024 à 15:33
-- Version du serveur : 5.7.24
-- Version de PHP : 8.2.14

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
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `ID_Post` int(11) NOT NULL,
  `ID_Emetteur` int(11) NOT NULL,
  `Lien` text NOT NULL,
  `Description` text,
  `Date` text,
  `Lieu` text,
  `Heure` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`ID_Post`, `ID_Emetteur`, `Lien`, `Description`, `Date`, `Lieu`, `Heure`) VALUES
(1, 1, 'documents/post/post.jpg', 'Une image de paysage et je test des choses comme ça pour savoir si ça marche lalalilalaire', '28/05/2024', 'ECE', '11:28'),
(2, 2, '2', '2', '2', '222', '2'),
(3, 1, 'documents/post/post.jpg', 'z', 'z', 'z', 'z'),
(4, 1, 'documents/post/post.jpg', NULL, NULL, NULL, NULL),
(5, 1, '', '1', NULL, '1', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_Post`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `ID_Post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
