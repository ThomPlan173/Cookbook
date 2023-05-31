-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : mer. 31 mai 2023 à 23:40
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

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

CREATE TABLE `attribuer` (
  `idAttribution` int(11) NOT NULL,
  `idRecette` int(11) NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `attribuer`
--

INSERT INTO `attribuer` (`idAttribution`, `idRecette`, `idTag`) VALUES
(13, 3, 4),
(14, 3, 3),
(17, 1, 1),
(18, 1, 4),
(19, 18, 1),
(20, 18, 4);

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `idContenir` int(11) NOT NULL,
  `idRecette` int(11) DEFAULT NULL,
  `idIngredient` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `unite` enum('Cuill?re ? caf?','Cuill?re ? soupe','mL','L','g') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idContenir`, `idRecette`, `idIngredient`, `quantite`, `unite`) VALUES
(19, 3, 4, 50, 'g'),
(20, 3, 2, 1, ''),
(24, 1, 7, 1, ''),
(25, 1, 1, 50, 'g'),
(26, 1, 3, 150, 'g'),
(27, 18, 7, 1, ''),
(28, 18, 1, 1, ''),
(29, 18, 4, 2, ''),
(30, 18, 3, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `idIngredient` int(11) NOT NULL,
  `nomIngredient` varchar(50) NOT NULL,
  `imgIngredient` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`idIngredient`, `nomIngredient`, `imgIngredient`) VALUES
(1, 'oignon', 'images/Ingredient/oignon.jpg'),
(2, 'tablette de chocolat', 'images/Ingredient/chocolat.jpg'),
(3, 'tomate', 'images/Ingredient/tomate.jpg'),
(4, 'sucre', 'images/Ingredient/sucre.jpg'),
(7, 'épice', 'images/Ingredient/épice.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `idRecette` int(11) NOT NULL,
  `nomRecette` varchar(50) NOT NULL,
  `imgRecette` varchar(50) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Preparation` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`idRecette`, `nomRecette`, `imgRecette`, `Description`, `Preparation`) VALUES
(1, 'Spaghettis ', 'images/Recette/spaghettis.jpg', 'Une recette très facile et rapide de spaghettis en 10 minutes !', 'Faites cuire les spaghetti dans une grande casserole d&#039;eau salée en suivant le temps indiqué sur le paquet.Égouttez et émiettez le thon dans un saladier. Épluchez et hachez l’ail. Mélangez le thon avec l&#039;ail, ajoutez la crème.Faites chauffer le mélange à feu doux pendant 3 minutes à la poêle. Salez, poivrez.Dans un saladier, mettez les spaghetti égouttés et versez dessus la sauce au thon. Mélangez et servez chaud.'),
(3, 'Cookies', 'images/Recette/cookies.jpg', 'Une recette très recherchée : comment avoir ces fameux cookies authentiques qui sont bien moelleux au centre et dorés sur les bords? (comme au Subway disent certains…). Il faut bien respecter les ingrédients sans quoi cela peut modifier la texture du cookie.\r\nUne recette très recherchée : comment avoir ces fameux cookies authentiques qui sont bien moelleux au centre et dorés sur les bords? (comme au Subway disent certains…). Il faut bien respecter les ingrédients sans quoi cela peut modifier la ', 'Préchauffez votre four à 140°C. Sortez la grille.\r\nMélangez le beurre mou avec les sucres, et l’oeuf, jusqu’à une pâte souple et homogène.\r\nA part, mélangez la farine, la levure, le bicarbonate, la pincée de sel et la vanille.\r\nAjoutez ce dernier mélange au premier. Bien mélangez pour avoir une pâte épaisse et qui sera malléable à la main.\r\nAjoutez 1/3 des pépites.\r\nSur la grille du four déjà sortie, mettez du papier cuisson.\r\n\r\nFormez des boules de pâte juste légèrement aplaties et disposez-les bien espacées les unes des autres.\r\nRépartissez sur chaque boule les pépites restantes\r\nEnfournez pour 15 minutes, 17 max. IMPORTANT : En fin de cuisson, les cookies n’ont pas l’air cuit, c’est normal ! Ne tombez pas dans la piège de les remettre. Le bord doit être à peine doré, et le centre tout mou.\r\nIl faut les laisser refroidir et ça va durcir. Ils seront parfaits. Refroidir une demi-heure au moins. Enjoy ! Mais notez que c’est 450 calories les 100 grammes, donc plutôt au petit déj si vous en faites des gros. Le chocolat, sortant du frigo, le casser en pépites, dans un sac congélation, lui-même entouré d’un torchon, en frappant avec le rouleau à pâtisserie. C’est meilleur et ça défoule. Les pépites déjà achetées toutes prêtes n’ont pas très bon goût et sont faites avec du faux chocolat (beaucoup de sucre, peu de cacao, et du colorant, bref, pas bon)'),
(18, 'Soupe à la tomate', 'images/Recette/soupe_tomate.jpg', 'La soupe à la tomate est une soupe dont l&#039;ingrédient de base est la tomate. Elle est souvent utilisée pour préparer des plats plus complexes et, à la différence de la plupart des soupes, elle peut être servie chaude ou froide. Elle peut être faite à partir de tomates en morceaux ou sous forme de purée.', 'ÉTAPE 1 :\r\nDans une cocotte minute (ou marmite) verser de l&#039;huile d&#039;olive et chauffer un peu, couper très grossièrement tous les légumes et les verser dans l&#039;huile chaude. Remuer quelques minutes, couvrir d&#039;eau, fermer la cocotte et laisser cuire 10 minutes.\r\n\r\nÉTAPE 2 :\r\nEnsuite ouvrir la cocotte, mixer le tout (avec un bras mixeur par ex).\r\n\r\nÉTAPE 3 :\r\nVérifier l&#039;assaisonnement et ajouter les vermicelles, laisser bouillir 3 minutes. C&#039;est prêt !\r\n\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `idTag` int(11) NOT NULL,
  `nomTag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`idTag`, `nomTag`) VALUES
(1, 'healthy'),
(2, 'sans sucres'),
(3, 'recette facile'),
(4, 'rapide à cuisiner');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attribuer`
--
ALTER TABLE `attribuer`
  ADD PRIMARY KEY (`idAttribution`),
  ADD KEY `attribuer_ibfk_1` (`idRecette`),
  ADD KEY `attribuer_ibfk_2` (`idTag`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`idContenir`),
  ADD KEY `contenir_ibfk_1` (`idRecette`),
  ADD KEY `contenir_ibfk_2` (`idIngredient`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`idIngredient`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`idRecette`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`idTag`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attribuer`
--
ALTER TABLE `attribuer`
  MODIFY `idAttribution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `contenir`
--
ALTER TABLE `contenir`
  MODIFY `idContenir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `idIngredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `idRecette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `idTag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
