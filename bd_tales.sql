-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Mer. 17 avr. 2019 à 16:32
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
  `urlImageCategorie` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`, `urlImageCategorie`) VALUES
(1, 'Action', 'Action.jpg'),
(2, 'Comedie', 'Comedie.jpg'),
(3, 'Drame', 'Drame.jpg'),
(4, 'Fantastique', 'Fantastique.jpg'),
(5, 'Horreur', 'Horreur.jpg'),
(6, 'Policier', 'Policier.jpg'),
(7, 'Romance', 'Romance.jpg'),
(8, 'Science-Fiction', 'Science-Fiction.jpg');

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
(3, 1);

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
(1, '2', '5', '5', '2', 2),
(2, '3', '1', '4', '3', 2),
(3, '5', '5', '2', '3', 1),
(4, '2', '3', '4', '2', 3),
(5, '1', '2', '5', '4', 3);

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
(1, 'Martien a marseille', '2019-04-16', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tincidunt dictum suscipit. Aliquam vel luctus dolor. Integer augue risus, molestie non tortor vel, varius sollicitudin tortor. Mauris vitae iaculis leo. Praesent pharetra est sed tellus euismod blandit. Nam mattis erat dolor, sit amet ullamcorper sem iaculis a. Maecenas nec odio quis diam fermentum molestie. Nullam sagittis ligula vel nulla pretium, ac pharetra est rhoncus.\r\n\r\nQuisque gravida mi in augue suscipit vulputate. Curabitur ante lorem, tempus a consectetur tincidunt, pharetra ut mi. Aliquam placerat nisi quis ornare semper. Maecenas nec nisi rutrum, commodo neque ac, mollis augue. Vestibulum vehicula accumsan ante ut tristique. Aenean auctor id massa a volutpat. Pellentesque porta nec nisl eget cursus. Mauris consequat lectus ex, eget malesuada sem sagittis quis. Morbi id nunc iaculis turpis pulvinar efficitur. Sed commodo, sem aliquet mollis pretium, lectus massa tempus enim, at bibendum libero sapien id leo. Maecenas pharetra odio ac nisl vestibulum sagittis.', 1, 2, 1),
(2, 'Perdu dans la montagne', '2019-04-15', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tincidunt dictum suscipit. Aliquam vel luctus dolor. Integer augue risus, molestie non tortor vel, varius sollicitudin tortor. Mauris vitae iaculis leo. Praesent pharetra est sed tellus euismod blandit. Nam mattis erat dolor, sit amet ullamcorper sem iaculis a. Maecenas nec odio quis diam fermentum molestie. Nullam sagittis ligula vel nulla pretium, ac pharetra est rhoncus.\r\n\r\nQuisque gravida mi in augue suscipit vulputate. Curabitur ante lorem, tempus a consectetur tincidunt, pharetra ut mi. Aliquam placerat nisi quis ornare semper. Maecenas nec nisi rutrum, commodo neque ac, mollis augue. Vestibulum vehicula accumsan ante ut tristique. Aenean auctor id massa a volutpat. Pellentesque porta nec nisl eget cursus. Mauris consequat lectus ex, eget malesuada sem sagittis quis. Morbi id nunc iaculis turpis pulvinar efficitur. Sed commodo, sem aliquet mollis pretium, lectus massa tempus enim, at bibendum libero sapien id leo. Maecenas pharetra odio ac nisl vestibulum sagittis.', 2, 1, 1),
(3, 'La grenouille bleue', '2019-04-18', 'Ut ultricies ornare neque, ac convallis tortor vulputate at. Duis eleifend lacus at mauris imperdiet, nec eleifend enim rhoncus. Etiam eu mattis sapien. Integer fermentum ante orci, nec interdum sem maximus placerat. Donec mattis consectetur tempus. Morbi justo urna, suscipit ac augue quis, iaculis lobortis justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nIn nec mollis erat. Quisque lectus risus, finibus sit amet porttitor et, mollis vel ex. Vestibulum varius cursus tincidunt. Praesent laoreet lorem sit amet ligula lobortis, non auctor ligula posuere. Integer ut cursus ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris dictum pellentesque dolor sed rhoncus. Sed ullamcorper, nisl sed finibus suscipit, lorem magna faucibus erat, at suscipit nunc lectus id est. Fusce eget velit vitae risus maximus lobortis a sed purus. Vestibulum venenatis scelerisque tellus quis facilisis. Aliquam erat volutpat.', NULL, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `idImage` int(11) NOT NULL,
  `urlImageHistoire` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`idImage`, `urlImageHistoire`) VALUES
(1, '5cb70a3243ab0yuliya-kosolapova-1289810-unsplash.jpg'),
(2, '5cb7094531e80luke-jackson-115570-unsplash.jpg');

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
(1, 'Lopes Raphael', 'Lopes.Raphael@gmail.com', 'd866f0c7d40f0a7139e58b9909e14d52c9512d37d3ed343a3441b5b26f68a248'),
(2, 'Gael Mariot', 'Gael.Mariot@gmail.com', '1d719dfc333a5c5b6f455766b8992c5f796163a8354f3ea2f1efb4e24f037c16');

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
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `idEvaluation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `histoire`
--
ALTER TABLE `histoire`
  MODIFY `idHistoire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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

GRANT USAGE ON *.* TO 'AdminTalesTPI'@'localhost';

GRANT ALL PRIVILEGES ON `bd\_tales`.* TO 'AdminTalesTPI'@'localhost' WITH GRANT OPTION;

GRANT USAGE ON *.* TO 'TalesTPI'@'localhost';

GRANT SELECT, INSERT, UPDATE, DELETE ON `bd\_tales`.* TO 'TalesTPI'@'localhost';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
