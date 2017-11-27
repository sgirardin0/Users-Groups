-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 27 nov. 2017 à 01:21
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `choosit`
--

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `g_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`g_name`) VALUES
('GROUP_1'),
('GROUP_2'),
('GROUP_3');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_firstname` varchar(25) DEFAULT NULL,
  `u_lastname` varchar(25) DEFAULT NULL,
  `u_email` varchar(25) DEFAULT NULL,
  `u_birthdate` date DEFAULT NULL,
  `u_group` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`u_id`, `u_firstname`, `u_lastname`, `u_email`, `u_birthdate`, `u_group`) VALUES
(1, 'Yoann', 'Legrand', 'y.legrand@gmail.com', '1994-11-08', 'GROUP_1'),
(3, 'Pierre', 'Serret', 'p.serret@gmail.com', '1989-07-14', 'GROUP_2'),
(4, 'Jacque', 'Lafont', 'j.lafont@gmail.com', '1996-04-23', 'GROUP_2'),
(5, 'Mathieu', 'Roux', 'm.roux@gmail.com', '1969-02-14', 'GROUP_3'),
(6, 'Arnaud', 'Durand', 'a.durand@gmai.com', '1993-05-17', 'GROUP_3'),
(19, 'Charles', 'Dumont', 'c.dumont@gmail.com', '1991-12-05', 'GROUP_1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`g_name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `FK_users_g_name` (`u_group`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_g_name` FOREIGN KEY (`u_group`) REFERENCES `groups` (`g_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
