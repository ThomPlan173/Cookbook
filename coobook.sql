-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 avr. 2023 à 06:40
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
-- Base de données : `coobook`
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `attribuer`
--

INSERT INTO `attribuer` (`idAttribution`, `idRecette`, `idTag`) VALUES
(1, 3, 3),
(2, 3, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idContenir`, `idRecette`, `idIngredient`, `quantite`, `unite`) VALUES
(1, 3, 2, 1, NULL),
(2, 3, 4, 50, 'g'),
(3, 3, 5, 10, 'g');

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
(1, 'Spaghettis façon carbonara', 'images\\spaghettis.jpg', 'Une recette facile et rapide de spaghettis en 10 minutes !', 'Faites cuire les spaghetti dans une grande casserole d\'eau salée en suivant le temps indiqué sur le paquet.\r\nÉgouttez et émiettez le thon dans un saladier. Épluchez et hachez l’ail. Mélangez le thon avec l\'ail, ajoutez la crème.\r\nFaites chauffer le mélange à feu doux pendant 3 minutes à la poêle. Salez, poivrez.\r\nDans un saladier, mettez les spaghetti égouttés et versez dessus la sauce au thon. Mélangez et servez chaud.'),
(2, 'Fondant au chocolat', 'images\\fondant.jpg', 'Découvrez la recette de Fondants au chocolat en ramequins. Une recette facile à faire qui peut être préparée plusieurs jours avant l\'arrivée de vos invités !', 'Passer le beurre au micro-ondes une dizaine de secondes.\r\nFaire fondre le chocolat en morceaux. au bain-marie avec 3 cuillères à soupe d\'eau\r\nDans un saladier, travailler le beurre mou, ajouter le sucre en poudre et mélanger. Puis ajouter les œufs un à un en alternance avec la farine.\r\nIncorporer le chocolat fondu, remuer et verser la préparation dans des ramequins beurrés.\r\nMettre les ramequins dans le congélateur pendant une heure.\r\nPréchauffer le four à 150°C et mettre les ramequins à cuire 20 minutes pas plus.\r\n'),
(3, 'Cookies', 'images\\cookies.jpg', 'Une recette très recherchée : comment avoir ces fameux cookies authentiques qui sont bien moelleux au centre et dorés sur les bords? (comme au Subway disent certains…). Il faut bien respecter les ingrédients sans quoi cela peut modifier la texture du cookie.', 'Préchauffez votre four à 140°C. Sortez la grille.\r\nMélangez le beurre mou avec les sucres, et l’oeuf, jusqu’à une pâte souple et homogène.\r\nA part, mélangez la farine, la levure, le bicarbonate, la pincée de sel et la vanille.\r\nAjoutez ce dernier mélange au premier. Bien mélangez pour avoir une pâte épaisse et qui sera malléable à la main.\r\nAjoutez 1/3 des pépites.\r\nSur la grille du four déjà sortie, mettez du papier cuisson.\r\n\r\nFormez des boules de pâte juste légèrement aplaties et disposez-les bien espacées les unes des autres.\r\nRépartissez sur chaque boule les pépites restantes\r\nEnfournez pour 15 minutes, 17 max. IMPORTANT : En fin de cuisson, les cookies n’ont pas l’air cuit, c’est normal ! Ne tombez pas dans la piège de les remettre. Le bord doit être à peine doré, et le centre tout mou.\r\nIl faut les laisser refroidir et ça va durcir. Ils seront parfaits. Refroidir une demi-heure au moins. Enjoy ! Mais notez que c’est 450 calories les 100 grammes, donc plutôt au petit déj si vous en faites des gros. Le chocolat, sortant du frigo, le casser en pépites, dans un sac congélation, lui-même entouré d’un torchon, en frappant avec le rouleau à pâtisserie. C’est meilleur et ça défoule. Les pépites déjà achetées toutes prêtes n’ont pas très bon goût et sont faites avec du faux chocolat (beaucoup de sucre, peu de cacao, et du colorant, bref, pas bon)'),
(4, 'Soupe à l\'oignon gratinée à l\'ancienne', 'images\\soupe_oignon.jpg', 'Découvrez la recette traditionnelle de la soupe gratinée à l\'oignon. Ce grand classique de la gastronomie française est très facile à préparer. N\'hésitez pas à le déguster bien chaud les soirs d\'hiver.', 'Porter à ebullition 1 litre d\'eau. Quand elle bout, ajouter le cube et demi de bouillon et remuer pour le diluer. Éplucher et émincer les oignons. Dans un faitout, faire fondre le beurre. Puis ajouter les oignons. Les faire revenir 10 minutes environ jusqu\'à ce qu\'ils soient légèrement dorés. Mélanger régulièrement.\r\nSaupoudrer les oignons de farine et mélanger sans cesse à feu moyen jusqu\'à coloration. Ajouter ensuite le bouillon, le vin et le bouquet garni (vous pouvez utiliser du bouquet garni déshydraté, dans cas 1 cuillère à café suffit). Saler et poivrer et laisser cuire 25 minutes environ avec un couvercle et à feu doux.\r\n\r\nPréchauffer le four à 240°C, thermostat 8. À la fin de la cuisson du faitout, retirer le bouquet garni et verser la soupe dans 4 bols pouvant aller au four. .\r\nDéposer 1 à 2 tranches de pain (en fonction de la taille) par bol sur le dessus de la soupe\r\nParsemer de gruyère râpé et mettre au four 7 à 8 minutes. Servir aussitôt.'),
(5, 'Soupe à la tomate', 'images\\soupe_tomate.jpg', 'une délicieuse soupe de tomate', '-mixer les tomates dans un mixeur\r\n-verser dans un bol\r\n-mettez le bol 1 minute au micro-ondes\r\n-Dégustez !');

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
