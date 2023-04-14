-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 14 avr. 2023 à 06:23
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
  KEY `idRecette` (`idRecette`),
  KEY `idTag` (`idTag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `attribuer`
--

INSERT INTO `attribuer` (`idAttribution`, `idRecette`, `idTag`) VALUES
(1, 3, 3),
(2, 3, 4),
(3, 1, 4),
(4, 4, 4);

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
  KEY `idRecette` (`idRecette`),
  KEY `idIngredient` (`idIngredient`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idContenir`, `idRecette`, `idIngredient`, `quantite`, `unite`) VALUES
(1, 3, 2, 1, NULL),
(2, 3, 4, 50, 'g'),
(3, 3, 5, 10, 'g'),
(4, 5, 3, 3, NULL),
(6, 2, 2, 200, NULL),
(7, 1, 3, 2, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`idRecette`, `nomRecette`, `imgRecette`, `Description`, `Preparation`) VALUES
(1, 'Spaghettis façon bolognaise', 'images\\spaghettis.jpg', 'Une recette facile et rapide de spaghettis en 10 minutes !', 'Faites cuire les spaghetti dans une grande casserole d\'eau salée en suivant le temps indiqué sur le paquet.\r\nÉgouttez et émiettez le thon dans un saladier. Épluchez et hachez l’ail. Mélangez le thon avec l\'ail, ajoutez la crème.\r\nFaites chauffer le mélange à feu doux pendant 3 minutes à la poêle. Salez, poivrez.\r\nDans un saladier, mettez les spaghetti égouttés et versez dessus la sauce au thon. Mélangez et servez chaud.'),
(2, 'Fondant au chocolat', 'images\\fondant.jpg', 'Découvrez la recette de Fondants au chocolat en ramequins. Une recette facile à faire qui peut être préparée plusieurs jours avant l\'arrivée de vos invités !', 'Passer le beurre au micro-ondes une dizaine de secondes.\r\nFaire fondre le chocolat en morceaux. au bain-marie avec 3 cuillères à soupe d\'eau\r\nDans un saladier, travailler le beurre mou, ajouter le sucre en poudre et mélanger. Puis ajouter les œufs un à un en alternance avec la farine.\r\nIncorporer le chocolat fondu, remuer et verser la préparation dans des ramequins beurrés.\r\nMettre les ramequins dans le congélateur pendant une heure.\r\nPréchauffer le four à 150°C et mettre les ramequins à cuire 20 minutes pas plus.\r\n'),
(3, 'Cookies', 'images\\cookies.jpg', 'Une recette très recherchée : comment avoir ces fameux cookies authentiques qui sont bien moelleux au centre et dorés sur les bords? (comme au Subway disent certains…). Il faut bien respecter les ingrédients sans quoi cela peut modifier la texture du cookie.', 'Préchauffez votre four à 140°C. Sortez la grille.\r\nMélangez le beurre mou avec les sucres, et l’oeuf, jusqu’à une pâte souple et homogène.\r\nA part, mélangez la farine, la levure, le bicarbonate, la pincée de sel et la vanille.\r\nAjoutez ce dernier mélange au premier. Bien mélangez pour avoir une pâte épaisse et qui sera malléable à la main.\r\nAjoutez 1/3 des pépites.\r\nSur la grille du four déjà sortie, mettez du papier cuisson.\r\n\r\nFormez des boules de pâte juste légèrement aplaties et disposez-les bien espacées les unes des autres.\r\nRépartissez sur chaque boule les pépites restantes\r\nEnfournez pour 15 minutes, 17 max. IMPORTANT : En fin de cuisson, les cookies n’ont pas l’air cuit, c’est normal ! Ne tombez pas dans la piège de les remettre. Le bord doit être à peine doré, et le centre tout mou.\r\nIl faut les laisser refroidir et ça va durcir. Ils seront parfaits. Refroidir une demi-heure au moins. Enjoy ! Mais notez que c’est 450 calories les 100 grammes, donc plutôt au petit déj si vous en faites des gros. Le chocolat, sortant du frigo, le casser en pépites, dans un sac congélation, lui-même entouré d’un torchon, en frappant avec le rouleau à pâtisserie. C’est meilleur et ça défoule. Les pépites déjà achetées toutes prêtes n’ont pas très bon goût et sont faites avec du faux chocolat (beaucoup de sucre, peu de cacao, et du colorant, bref, pas bon)'),
(4, 'Cookies', 'images/', 'Une  recherchÃ©e : comment avoir ces fameux cookies authentiques qui sont bien moelleux au centre et dorÃ©s sur les bords? (comme au Subway disent certainsÂ…). Il faut bien respecter les ingrÃ©dients sans quoi cela peut modifier la texture du cookie.', 'PrÃ©chaufur Ã  140Â°C. Sortez la grille.MÃ©langez le beurre mou avec les sucres, et lÂ’oeuf, jusquÂ’Ã  une pÃ¢te souple et homogÃ¨ne.A part, mÃ©langez la farine, la levure, le bicarbonate, la pincÃ©e de sel et la vanille.Ajoutez ce dernier mÃ©lange au premier. Bien mÃ©langez pour avoir une pÃ¢te Ã©paisse et qui sera mallÃ©able Ã  la main.Ajoutez 1/3 des pÃ©pites.Sur la grille du four dÃ©jÃ  sortie, mettez du papier cuisson.Formez des boules de pÃ¢te juste lÃ©gÃ¨rement aplaties et disposez-les bien espacÃ©es les unes des autres.RÃ©partissez sur chaque boule les pÃ©pites restantesEnfournez pour 15 minutes, 17 max. IMPORTANT : En fin de cuisson, les cookies nÂ’ont pas lÂ’air cuit, cÂ’est normal ! Ne tombez pas dans la piÃ¨ge de les remettre. Le bord doit Ãªtre Ã  peine dorÃ©, et le centre tout mou.Il faut les laisser refroidir et Ã§a va durcir. Ils seront parfaits. Refroidir une demi-heure au moins. Enjoy ! Mais notez que cÂ’est 450 calories les 100 grammes, donc plutÃ´t au petit dÃ©j si vous en faites des gros. Le chocolat, sortant du frigo, le casser en pÃ©pites, dans un sac congÃ©lation, lui-mÃªme entourÃ© dÂ’un torchon, en frappant avec le rouleau Ã  pÃ¢tisserie. CÂ’est meilleur et Ã§a dÃ©foule. Les pÃ©pites dÃ©jÃ  achetÃ©es toutes prÃªtes nÂ’ont pas trÃ¨s bon goÃ»t et sont faites avec du faux chocolat (beaucoup de sucre, peu de cacao, et du colorant, bref, pas bon)'),
(5, '$nom', '$img', '$description', '$preparation');

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
  ADD CONSTRAINT `attribuer_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`),
  ADD CONSTRAINT `attribuer_ibfk_2` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`),
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`idIngredient`) REFERENCES `ingredient` (`idIngredient`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
