-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 04 déc. 2020 à 18:19
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `label`) VALUES
(1, 'Petit_Filtre'),
(2, 'Tuyaux'),
(3, 'Medium_Filtre'),
(4, 'Large_Filtre'),
(5, 'Filtre_raw');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `createdAt`, `product_id`) VALUES
(30, 'Troop cool une expérience hors du commun !', '2020-12-02 17:29:18', 1),
(34, 'juste génial !', '2020-12-02 17:42:13', 3),
(35, 'Motif très beau !', '2020-12-03 10:15:09', 2);

-- --------------------------------------------------------

--
-- Structure de la table `creators`
--

CREATE TABLE `creators` (
  `id` int(11) NOT NULL,
  `shop_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `creators`
--

INSERT INTO `creators` (`id`, `shop_name`) VALUES
(1, 'Raw'),
(2, 'Pyragreen'),
(3, 'Zamnésia');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `stock` smallint(6) NOT NULL,
  `cateroy_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `picture`, `price`, `stock`, `cateroy_id`, `creator_id`) VALUES
(1, 'Filtre Raw', 'Se filtre en verre de la marque raw  va vous faire mieux appréciez l\'expérience de fumer !', 'product4.jpg', 9, 17, 5, 1),
(2, 'Petit Filtre avec motif', 'Ce filtre en verre perso mettre de la couleur sur cone que vous roulerez !', 'product2.jpg', 6, 15, 1, 3),
(3, 'Filtre personnalisé ', 'Ce filtre personnalisé fait mains sera très adapter pour toute type de session enter pote !', 'product1.jpg', 14, 7, 3, 2),
(4, 'Filre King !', 'Ces filtres personnalisé avec une courone montrera que vous êtes le king du roulage !', 'product3.jpg', 12, 14, 3, 1),
(5, 'Tuyaux personnalisé', 'Ce tuyaux fait office de filtre en verre géant ! Il sera idéal pour les connes assez long !', 'product5.jpg', 18, 15, 2, 2),
(6, 'Filtre Large !', 'Ce filtre avec une grosse embouchure pour faire passer une fumer plus dense et compact sa vous brulez !', 'product6.jpg', 20, 6, 4, 3),
(7, 'Petit Filtre', 'Petit filtre très appréciables qui se transporte de partout !', 'product7.jpg', 6, 17, 1, 1),
(8, 'Tuyaux de couleur', 'Ce tuyaux de couleur ne pourra se confondre avec aucun autre ! Vous pouvez le personnalisé avec votre si vous le souhaitez !', 'product8.jpg', 15, 14, 2, 1),
(9, 'Filtro+ Large', 'Très gros filtre pour les des personne expérimenter un filtre qui fait tout passer et qui risque de vous faire toussez !', 'product9.jpg', 7.99, 8, 4, 2),
(10, 'Filtre élégant ', 'Ce petit filtre transportable de partout ! Est très jolie par son design épurer et sombre et il passe partout pour tout type de session !', 'product10.jpg', 9.99, 5, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `firstname`, `lastname`, `createdAt`) VALUES
(36, 'test@gmail.com', '12345678', 'Stollpy', 'test', '2020-12-04 14:19:55');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `creators`
--
ALTER TABLE `creators`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cateroy_id` (`cateroy_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `creators`
--
ALTER TABLE `creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
