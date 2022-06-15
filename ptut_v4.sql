-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 15 juin 2022 à 10:26
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
-- Base de données : `ptut_v3`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `Nom` varchar(50) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`Nom`, `Value`) VALUES
('VTT', 1),
('Running', 2),
('Nage (Mer)', 3),
('Nage (Rivière / Lac) ', 4),
('Kayak', 5),
('Randonnée', 6),
('Piscine', 27);

-- --------------------------------------------------------

--
-- Structure de la table `fichier`
--

CREATE TABLE `fichier` (
  `Id_Fichier` int(11) NOT NULL,
  `Id_Parcours` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `Distance` float NOT NULL,
  `Date_parcours` datetime NOT NULL,
  `Ville_depart` varchar(50) DEFAULT NULL,
  `Type_activite` varchar(50) DEFAULT NULL,
  `Meteo` varchar(50) DEFAULT NULL,
  `Denivele` float DEFAULT NULL,
  `Duree` time NOT NULL,
  `home_Trainer` tinyint(1) NOT NULL,
  `Groupe` tinyint(1) NOT NULL,
  `Nom` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déclencheurs `fichier`
--
DELIMITER $$
CREATE TRIGGER `insertActivite` AFTER INSERT ON `fichier` FOR EACH ROW BEGIN
    IF (SELECT COUNT(*) FROM activite WHERE Nom = NEW.type_activite) = 0 THEN
        INSERT INTO activite (Nom) VALUES (NEW.type_activite);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertVille` AFTER INSERT ON `fichier` FOR EACH ROW BEGIN
    IF (SELECT COUNT(*) FROM ville WHERE Nom = NEW.Ville_Depart) = 0 THEN
        INSERT INTO ville (Nom) VALUES (NEW.Ville_Depart);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateActivite` AFTER UPDATE ON `fichier` FOR EACH ROW BEGIN
    IF (SELECT COUNT(*) FROM activite WHERE Nom = NEW.type_activite) = 0 THEN
        INSERT INTO activite (Nom) VALUES (NEW.type_activite);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateVille` AFTER UPDATE ON `fichier` FOR EACH ROW BEGIN
    IF (SELECT COUNT(*) FROM ville WHERE Nom = NEW.Ville_Depart) = 0 THEN
        INSERT INTO ville (Nom) VALUES (NEW.Ville_Depart);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `meteo`
--

CREATE TABLE `meteo` (
  `Nom` varchar(50) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `meteo`
--

INSERT INTO `meteo` (`Nom`, `Value`) VALUES
('soleil', 1),
('nuage', 2),
('pluie', 3);

-- --------------------------------------------------------

--
-- Structure de la table `point_gpx`
--

CREATE TABLE `point_gpx` (
  `TIMECODE` datetime NOT NULL,
  `Altitude` int(11) DEFAULT NULL,
  `Latitude` decimal(10,8) DEFAULT NULL,
  `Longitude` decimal(11,8) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `Id_Fichier` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `repertoire`
--

CREATE TABLE `repertoire` (
  `Id_Parcours` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Login` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `tokeninit` char(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Login`, `Password`, `Mail`, `tokeninit`) VALUES
('admin', 'PTUT2022', 'agence.2bcl@gmail.com', '37852552');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `Nom` varchar(50) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`Nom`, `Value`) VALUES
('Toulouse', 1),
('Blagnac', 2),
('Montauban', 3),
('Albi', 4),
('Castres', 5),
('Castelnaudary', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`Nom`),
  ADD UNIQUE KEY `Value` (`Value`);

--
-- Index pour la table `fichier`
--
ALTER TABLE `fichier`
  ADD PRIMARY KEY (`Id_Fichier`),
  ADD KEY `FK_COND` (`Id_Parcours`),
  ADD KEY `Fk_activite` (`Type_activite`),
  ADD KEY `Fk_fichier` (`Meteo`);

--
-- Index pour la table `meteo`
--
ALTER TABLE `meteo`
  ADD PRIMARY KEY (`Nom`),
  ADD UNIQUE KEY `Value` (`Value`);

--
-- Index pour la table `point_gpx`
--
ALTER TABLE `point_gpx`
  ADD PRIMARY KEY (`TIMECODE`,`Id_Fichier`),
  ADD KEY `Id_Fichier` (`Id_Fichier`);

--
-- Index pour la table `repertoire`
--
ALTER TABLE `repertoire`
  ADD PRIMARY KEY (`Id_Parcours`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Login`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`Nom`),
  ADD UNIQUE KEY `Value` (`Value`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `Value` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `fichier`
--
ALTER TABLE `fichier`
  MODIFY `Id_Fichier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `meteo`
--
ALTER TABLE `meteo`
  MODIFY `Value` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `repertoire`
--
ALTER TABLE `repertoire`
  MODIFY `Id_Parcours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `Value` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
