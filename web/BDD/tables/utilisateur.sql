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
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID` int(11) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `NC` int(11) NOT NULL,
  `Image` varchar(255) DEFAULT 'documents/site/fond.jpg',
  `Photo` varchar(255) DEFAULT 'documents/site/photo.jpg',
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `Pseudo`, `Email`, `MDP`, `NC`, `Image`, `Photo`, `Description`) VALUES
(1, 'Sowgan', 's.g@gmail.com', '123', 1, 'documents/fond/test.jpg', 'documents/photo/photo.jpg', 'Je peux changer la description :)'),
(2, 'Teemo', 'Teemo.demon@faille.invocateur', '456', 1, 'documents/fond/teemo.png', 'documents/photo/17018.jpg', 'Je suis un vrai démon qui flash Q pour voler des kills'),
(3, 'test', 'test@gmail.com', '789', 0, 'documents/fond/baby-groot-4k-hd-superheroes-wallpaper-preview.jpg', 'documents/photo/photo1 (2).jpg', ''),
(5, 'TestFinal', 'Testfinal@gmail.com', '123', 1, 'documents/site/fond.jpg', 'documents/site/photo.jpg', 'Je suis le test final');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
