-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 01 juin 2024 à 17:19
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
-- Structure de la table `emploi`
--

CREATE TABLE `emploi` (
  `ID_Emploi` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Desc_courte` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL DEFAULT 'documents/site/emploi.jpg',
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `emploi`
--

INSERT INTO `emploi` (`ID_Emploi`, `Nom`, `Desc_courte`, `Description`, `Image`, `Date`) VALUES
(1, 'Jgl teemo', 'simple teemo flash', 'un ptit demon', 'documents/emploi/teemo.png', NULL),
(3, 'Pilote F1', 'Cherche Pilote de F1', 'Cherche un pilote de F1 pour remplacer Ocon. Ce pilote doit avoir un talent et des sponsors qui le suivent. On cherche quelqu\'un qui suis les consignes d\'équipes et qui ne dive pas par folie son coéquipier car on aimerait gagner des points.', 'documents/emploi/alpine.png', NULL);

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
-- Index pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`ID_Emploi`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ID_Event`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_Post`);

--
-- Index pour la table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`ID_relation`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `ID_Emploi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `ID_Event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `ID_Post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `relation`
--
ALTER TABLE `relation`
  MODIFY `ID_relation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
