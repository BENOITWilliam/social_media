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
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `ID_Post` int(11) NOT NULL,
  `ID_Emetteur` int(11) NOT NULL,
  `Lien` text NOT NULL,
  `Description` text,
  `Date` text,
  `Lieu` text,
  `Heure` text,
  `Privé` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`ID_Post`, `ID_Emetteur`, `Lien`, `Description`, `Date`, `Lieu`, `Heure`, `Privé`) VALUES
(1, 1, 'documents/emploi/did.mp4', 'Une image de paysage et je test des choses comme ça pour savoir si ça marche lalalilalaire', '', 'ECE', '11:28', 0),
(2, 2, '2', '2', '2', '222', '2', 0),
(3, 1, 'documents/post/post.jpg', 'z', 'z', 'z', 'z', 0),
(4, 1, 'documents/post/post.jpg', '', '', '', '', 0),
(5, 1, 'documents/emploi/teemo.png', '1', '', '1', '', 0),
(8, 1, 'documents/emploi/mc.png', 'Vieille photo de mon monde MC sur un serveur qui n\'existe plus. ', '2024-06-01', 'Serveur Mc', '13:33', 1),
(9, 3, 'documents/post/teemo.png', '', '', '', '', 1),
(10, 1, 'documents/post/fond2.png', 'test', '', '', '', 0),
(11, 5, 'documents/post/photo1 (2).jpg', '', '', '', '', 0),
(12, 5, 'documents/post/did.mp4', '', '', '', '', 1);

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
  MODIFY `ID_Post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
