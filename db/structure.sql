-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 27 Octobre 2015 à 00:50
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `microstore`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
`idCommande` int(11) NOT NULL,
  `idMembreCo` int(11) NOT NULL,
  `prixTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fabricant`
--

CREATE TABLE IF NOT EXISTS `fabricant` (
`idFabricant` int(11) NOT NULL,
  `nomFabricant` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `fabricant`
--



-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

CREATE TABLE IF NOT EXISTS `lignecommande` (
  `idTelCo` int(50) NOT NULL,
  `idCommandeLi` int(50) NOT NULL,
  `qte` int(50) NOT NULL,
  `prixTTC` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
`idMembre` int(11) NOT NULL,
  `pseudoMembre` varchar(200) NOT NULL,
  `mdpMembre` varchar(200) NOT NULL,
  `mailMembre` varchar(200) NOT NULL,
  `nomMembre` varchar(50) DEFAULT NULL,
  `prenomMembre` varchar(50) DEFAULT NULL,
  `adresseMembre` varchar(200) DEFAULT NULL,
  `villeMembre` varchar(200) DEFAULT NULL,
  `CPMembre` varchar(200) DEFAULT NULL,
  `niveauMembre` int(10) DEFAULT NULL,
  `salt` varchar(23) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `membre`
--


-- --------------------------------------------------------

--
-- Structure de la table `telephonemobile`
--

CREATE TABLE IF NOT EXISTS `telephonemobile` (
`idTel` int(11) NOT NULL,
  `libelleTel` varchar(200) NOT NULL,
  `idFabricantTel` int(11) NOT NULL,
  `OS` varchar(50) DEFAULT NULL,
  `prixUnitaire` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
 ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `fabricant`
--
ALTER TABLE `fabricant`
 ADD PRIMARY KEY (`idFabricant`);

--
-- Index pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
 ADD PRIMARY KEY (`idTelCo`,`idCommandeLi`), ADD KEY `idCommandeLi` (`idCommandeLi`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
 ADD PRIMARY KEY (`idMembre`);

--
-- Index pour la table `telephonemobile`
--
ALTER TABLE `telephonemobile`
 ADD PRIMARY KEY (`idTel`), ADD KEY `idFabricantTel` (`idFabricantTel`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fabricant`
--
ALTER TABLE `fabricant`
MODIFY `idFabricant` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
MODIFY `idMembre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `telephonemobile`
--
ALTER TABLE `telephonemobile`
MODIFY `idTel` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
ADD CONSTRAINT `lignecommande_ibfk_1` FOREIGN KEY (`idTelCo`) REFERENCES `telephonemobile` (`idTel`),
ADD CONSTRAINT `lignecommande_ibfk_2` FOREIGN KEY (`idCommandeLi`) REFERENCES `commande` (`idCommande`);

--
-- Contraintes pour la table `telephonemobile`
--
ALTER TABLE `telephonemobile`
ADD CONSTRAINT `telephonemobile_ibfk_1` FOREIGN KEY (`idFabricantTel`) REFERENCES `fabricant` (`idFabricant`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
