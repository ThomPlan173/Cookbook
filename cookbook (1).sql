-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 05 mai 2023 à 13:17
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cookbook`
--

-- --------------------------------------------------------

--
-- Structure de la table `attribuer`
--

DROP TABLE IF EXISTS `attribuer`;
CREATE TABLE IF NOT EXISTS `attribuer` (
  `idAttribution` int(11) NOT NULL AUTO_INCREMENT,
  `idRecette` int(11) NOT NULL,
  `idTag` int(11) NOT NULL,
  PRIMARY KEY (`idAttribution`),
  KEY `attribuer_ibfk_1` (`idRecette`),
  KEY `attribuer_ibfk_2` (`idTag`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `attribuer`
--

INSERT INTO `attribuer` (`idAttribution`, `idRecette`, `idTag`) VALUES
(1, 3, 3),
(2, 3, 4),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `idContenir` int(11) NOT NULL AUTO_INCREMENT,
  `idRecette` int(11) DEFAULT NULL,
  `idIngredient` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `unite` enum('Cuill?re ? caf?','Cuill?re ? soupe','mL','L','g') DEFAULT NULL,
  PRIMARY KEY (`idContenir`),
  KEY `contenir_ibfk_1` (`idRecette`),
  KEY `contenir_ibfk_2` (`idIngredient`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idContenir`, `idRecette`, `idIngredient`, `quantite`, `unite`) VALUES
(1, 3, 2, 1, NULL),
(2, 3, 4, 50, 'g'),
(3, 3, 5, 10, 'g'),
(8, 1, 3, 1, NULL),
(9, 1, 1, 100, 'g');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `idIngredient` int(11) NOT NULL AUTO_INCREMENT,
  `nomIngredient` varchar(50) NOT NULL,
  `imgIngredient` varchar(50) NOT NULL,
  PRIMARY KEY (`idIngredient`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`idIngredient`, `nomIngredient`, `imgIngredient`) VALUES
(1, 'oignon', 'images/oignon.jpg'),
(2, 'tablette de chocolat', 'images/chocolat.jpg'),
(3, 'tomate', 'images/tomate.jpg'),
(4, 'sucre', 'images/sucre.jpg'),
(5, 'farine', 'images/farine.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `idRecette` int(11) NOT NULL AUTO_INCREMENT,
  `nomRecette` varchar(50) NOT NULL,
  `imgRecette` varchar(50) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Preparation` varchar(2000) NOT NULL,
  PRIMARY KEY (`idRecette`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`idRecette`, `nomRecette`, `imgRecette`, `Description`, `Preparation`) VALUES
(1, 'Spaghettis ', 'images/spaghettis.jpg', 'Une recette facile et rapide de spaghettis en 10 minutes !', 'Faites cuire les spaghetti dans une grande casserole d&#039;eau salée en suivant le temps indiqué sur le paquet.Égouttez et émiettez le thon dans un saladier. Épluchez et hachez l’ail. Mélangez le thon avec l&#039;ail, ajoutez la crème.Faites chauffer le mélange à feu doux pendant 3 minutes à la poêle. Salez, poivrez.Dans un saladier, mettez les spaghetti égouttés et versez dessus la sauce au thon. Mélangez et servez chaud.'),
(3, 'Cookies', 'images\\cookies.jpg', 'Une recette très recherchée : comment avoir ces fameux cookies authentiques qui sont bien moelleux au centre et dorés sur les bords? (comme au Subway disent certains…). Il faut bien respecter les ingrédients sans quoi cela peut modifier la texture du cookie.', 'Préchauffez votre four à 140°C. Sortez la grille.\r\nMélangez le beurre mou avec les sucres, et l’oeuf, jusqu’à une pâte souple et homogène.\r\nA part, mélangez la farine, la levure, le bicarbonate, la pincée de sel et la vanille.\r\nAjoutez ce dernier mélange au premier. Bien mélangez pour avoir une pâte épaisse et qui sera malléable à la main.\r\nAjoutez 1/3 des pépites.\r\nSur la grille du four déjà sortie, mettez du papier cuisson.\r\n\r\nFormez des boules de pâte juste légèrement aplaties et disposez-les bien espacées les unes des autres.\r\nRépartissez sur chaque boule les pépites restantes\r\nEnfournez pour 15 minutes, 17 max. IMPORTANT : En fin de cuisson, les cookies n’ont pas l’air cuit, c’est normal ! Ne tombez pas dans la piège de les remettre. Le bord doit être à peine doré, et le centre tout mou.\r\nIl faut les laisser refroidir et ça va durcir. Ils seront parfaits. Refroidir une demi-heure au moins. Enjoy ! Mais notez que c’est 450 calories les 100 grammes, donc plutôt au petit déj si vous en faites des gros. Le chocolat, sortant du frigo, le casser en pépites, dans un sac congélation, lui-même entouré d’un torchon, en frappant avec le rouleau à pâtisserie. C’est meilleur et ça défoule. Les pépites déjà achetées toutes prêtes n’ont pas très bon goût et sont faites avec du faux chocolat (beaucoup de sucre, peu de cacao, et du colorant, bref, pas bon)');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `idTag` int(11) NOT NULL AUTO_INCREMENT,
  `nomTag` varchar(50) NOT NULL,
  PRIMARY KEY (`idTag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`idTag`, `nomTag`) VALUES
(1, 'healthy'),
(2, 'sans sucres'),
(3, 'recette facile'),
(4, 'rapide à cuisiner');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attribuer`
--
ALTER TABLE `attribuer`
  ADD CONSTRAINT `attribuer_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attribuer_ibfk_2` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`idIngredient`) REFERENCES `ingredient` (`idIngredient`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
