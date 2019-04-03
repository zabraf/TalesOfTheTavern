-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 03 avr. 2019 à 11:21
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_tales`
--
CREATE DATABASE IF NOT EXISTS `bd_tales` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_tales`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `nomCategorie` varchar(50) NOT NULL,
  `urlImageCategorie` varchar(300) NOT NULL,
  `genre` enum('Action','Comédie','Drame','Fantastique','Horreur','Policier','Romance','Science-Fiction') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`, `urlImageCategorie`, `genre`) VALUES
(1, 'comptines', 'comptines.jpg', 'Fantastique');

-- --------------------------------------------------------

--
-- Structure de la table `estfavoris`
--

CREATE TABLE `estfavoris` (
  `idHistoire` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `estfavoris`
--

INSERT INTO `estfavoris` (`idHistoire`, `idUtilisateur`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE `evaluation` (
  `idEvaluation` int(11) NOT NULL,
  `style` enum('1','2','3','4','5') NOT NULL,
  `histoire` enum('1','2','3','4','5') NOT NULL,
  `orthographe` enum('1','2','3','4','5') NOT NULL,
  `originalite` enum('1','2','3','4','5') NOT NULL,
  `idHistoire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evaluation`
--

INSERT INTO `evaluation` (`idEvaluation`, `style`, `histoire`, `orthographe`, `originalite`, `idHistoire`) VALUES
(1, '2', '1', '5', '4', 1);

-- --------------------------------------------------------

--
-- Structure de la table `histoire`
--

CREATE TABLE `histoire` (
  `idHistoire` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `DateCreation` date NOT NULL,
  `histoire` text NOT NULL,
  `idImage` int(11) DEFAULT NULL,
  `idCategorie` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `histoire`
--

INSERT INTO `histoire` (`idHistoire`, `titre`, `DateCreation`, `histoire`, `idImage`, `idCategorie`, `idUtilisateur`) VALUES
(1, 'La Cigale et la Fourmi', '2019-04-03', 'La Cigale, ayant chanté\r\nTout l\'été,\r\nSe trouva fort dépourvue\r\nQuand la bise fut venue :\r\nPas un seul petit morceau\r\nDe mouche ou de vermisseau.\r\nElle alla crier famine\r\nChez la Fourmi sa voisine,\r\nLa priant de lui prêter\r\nQuelque grain pour subsister\r\nJusqu\'à la saison nouvelle.\r\n\"Je vous paierai, lui dit-elle,\r\nAvant l\'Oût, foi d\'animal,\r\nIntérêt et principal. \"\r\nLa Fourmi n\'est pas prêteuse :\r\nC\'est là son moindre défaut.\r\nQue faisiez-vous au temps chaud ?\r\nDit-elle à cette emprunteuse.\r\n- Nuit et jour à tout venant\r\nJe chantais, ne vous déplaise.\r\n- Vous chantiez ? j\'en suis fort aise.\r\nEh bien! dansez maintenant.', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `idImage` int(11) NOT NULL,
  `utlImageHistoire` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`idImage`, `utlImageHistoire`) VALUES
(1, 'CigaleEtLaFourmis.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motDePasse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `email`, `motDePasse`) VALUES
(1, 'Mariot', 'Mariot.Ggmail.com', '51609286fb7f6089e0a0a418355949c791e84870ae2523093ba00bb3ecff7f8e'),
(2, 'Christensen', 'Christensen.C@gmail.com', '943723cd5955a5316f4364f750e309b0a9582e939128ce09800d56f126649efb');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `estfavoris`
--
ALTER TABLE `estfavoris`
  ADD PRIMARY KEY (`idHistoire`,`idUtilisateur`),
  ADD KEY `idHistoire` (`idHistoire`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`idEvaluation`),
  ADD KEY `idHistoire` (`idHistoire`);

--
-- Index pour la table `histoire`
--
ALTER TABLE `histoire`
  ADD PRIMARY KEY (`idHistoire`),
  ADD KEY `idImage` (`idImage`),
  ADD KEY `idCategorie` (`idCategorie`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idImage`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `idEvaluation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `histoire`
--
ALTER TABLE `histoire`
  MODIFY `idHistoire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `estfavoris`
--
ALTER TABLE `estfavoris`
  ADD CONSTRAINT `estfavoris_ibfk_1` FOREIGN KEY (`idHistoire`) REFERENCES `histoire` (`idHistoire`) ON DELETE CASCADE,
  ADD CONSTRAINT `estfavoris_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`idHistoire`) REFERENCES `histoire` (`idHistoire`) ON DELETE CASCADE;

--
-- Contraintes pour la table `histoire`
--
ALTER TABLE `histoire`
  ADD CONSTRAINT `histoire_ibfk_1` FOREIGN KEY (`idImage`) REFERENCES `image` (`idImage`) ON DELETE CASCADE,
  ADD CONSTRAINT `histoire_ibfk_2` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE,
  ADD CONSTRAINT `histoire_ibfk_3` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
