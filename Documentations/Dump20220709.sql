-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 09 juil. 2022 à 10:53
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `WebVysionSport`
--

-- --------------------------------------------------------

--
-- Structure de la table `bodymember`
--

DROP TABLE IF EXISTS `bodymember`;
CREATE TABLE `bodymember` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Types';

--
-- Déchargement des données de la table `bodymember`
--

INSERT INTO `bodymember` (`id`, `code`, `name`, `elemstate`, `timestamp`) VALUES
(1, 'HEAD', 'Head', 0, 0),
(2, 'NECK', 'Neck', 0, 0),
(3, 'BACK', 'Back', 0, 0),
(4, 'TRUNK', 'Trunk', 0, 0),
(5, 'SHOULDER', 'Shoulder', 0, 0),
(6, 'ARM', 'Arm', 0, 0),
(7, 'FOREARM', 'Forearm', 0, 0),
(8, 'HAND', 'Hand', 0, 0),
(9, 'HIP', 'Hip', 0, 0),
(10, 'THIGH', 'Thigh', 0, 0),
(11, 'CALF', 'Calf', 0, 0),
(12, 'FOOT', 'Foot', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bodymembername`
--

DROP TABLE IF EXISTS `bodymembername`;
CREATE TABLE `bodymembername` (
  `id` int(10) UNSIGNED NOT NULL,
  `idbodymember` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Type Names';

--
-- Déchargement des données de la table `bodymembername`
--

INSERT INTO `bodymembername` (`id`, `idbodymember`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 2, 'Head', 0, 0),
(2, 2, 2, 'Neck', 0, 0),
(3, 3, 2, 'Back', 0, 0),
(4, 4, 2, 'Trunk', 0, 0),
(5, 5, 2, 'Shoulder', 0, 0),
(6, 6, 2, 'Arm', 0, 0),
(7, 7, 2, 'Forearm', 0, 0),
(8, 8, 2, 'Hand', 0, 0),
(9, 9, 2, 'Hip', 0, 0),
(10, 10, 2, 'Thigh', 0, 0),
(11, 11, 2, 'Calf', 0, 0),
(12, 12, 2, 'Foot', 0, 0),
(13, 1, 1, 'Tête', 0, 0),
(14, 2, 1, 'Cou', 0, 0),
(15, 3, 1, 'Dos', 0, 0),
(16, 4, 1, 'Tronc', 0, 0),
(17, 5, 1, 'Epaule', 0, 0),
(18, 6, 1, 'Bras', 0, 0),
(19, 7, 1, 'Avant-Bras', 0, 0),
(20, 8, 1, 'Main', 0, 0),
(21, 9, 1, 'Hanche', 0, 0),
(22, 10, 1, 'Cuisse', 0, 0),
(23, 11, 1, 'Mollet', 0, 0),
(24, 12, 1, 'Pied', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bodymuscle`
--

DROP TABLE IF EXISTS `bodymuscle`;
CREATE TABLE `bodymuscle` (
  `id` int(10) UNSIGNED NOT NULL,
  `idbodymember` int(10) UNSIGNED NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Types';

--
-- Déchargement des données de la table `bodymuscle`
--

INSERT INTO `bodymuscle` (`id`, `idbodymember`, `code`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 'MESSETER', 'Masséter', 0, 0),
(2, 1, 'ZYGOMATIQUE', 'Zygomatique', 0, 0),
(3, 1, 'OCCIPITO', 'Occipito des lèvres', 0, 0),
(4, 1, 'CORUGATOR', 'Corugator', 0, 0),
(5, 2, 'TRAPEZE', 'Trapèze', 0, 0),
(6, 3, 'GRAND_DORSAL', 'Grand dorsal', 0, 0),
(7, 3, 'INTERCOSTAUX', 'Muscles intercostaux', 0, 0),
(8, 3, 'LOMBES', 'Muscle carré des lombes', 0, 0),
(9, 3, 'ERECTEURS_RACHIS', 'Muscles érecteurs du rachis', 0, 0),
(10, 4, 'GRAND_PECTORAL', 'Le grand pectoral', 0, 0),
(11, 4, 'DELTOIDES', 'Deltoïdes', 0, 0),
(12, 4, 'BICEPS', 'Biceps', 0, 0),
(13, 4, 'TRICEPS', 'Triceps', 0, 0),
(14, 6, 'BICEPS_BRACHIAL', 'Biceps brachial', 0, 0),
(15, 6, '_BRACHIAL_ANTERIEUR', 'Brachial antérieur', 0, 0),
(16, 6, 'TRICEPS_BRACHIAL', 'Triceps brachial', 0, 0),
(17, 7, 'SOUPINATEUR', 'Long soupinateur', 0, 0),
(18, 7, 'GRAND_PALMAIRE', 'Grand palmaire', 0, 0),
(19, 7, 'CUBITAL_ANTERIEUR', 'Cubital antérieur', 0, 0),
(20, 8, 'THENARIEN', 'Muscle thénarien', 0, 0),
(21, 8, 'MUSCLE_DOIGTS', 'Muscles des doigts', 0, 0),
(22, 9, 'FESSIERS', 'Les fessiers', 0, 0),
(23, 9, 'ABDUCTEURS', 'Les abducteurs', 0, 0),
(24, 9, 'ADDUCTEURS', 'Les adducteurs', 0, 0),
(25, 10, 'MUSCLES_ANTERIEUR', 'Muscles antérieurs', 0, 0),
(26, 10, 'MOYENS_ADDUCTEUR', 'Moyens adducteur', 0, 0),
(27, 10, 'QUADRICEPS', 'Quadriceps', 0, 0),
(28, 10, 'ISCHIO_JAMBIERS', 'Ischio-jambiers', 0, 0),
(29, 11, 'JAMBIER_ANTERIEUR', 'Jambier antérieur', 0, 0),
(30, 11, 'JUMEAUX_EXTERNE', 'Jumeaux externe', 0, 0),
(31, 11, 'JUMEAUX_INTERNE', 'Jumeaux interne', 0, 0),
(32, 11, 'SOLEAIRE', 'Soléaire', 0, 0),
(33, 12, 'MUSCLES_PIEDS', 'Muscles des pieds', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bodymusclename`
--

DROP TABLE IF EXISTS `bodymusclename`;
CREATE TABLE `bodymusclename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idbodymuscle` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Type Names';

--
-- Déchargement des données de la table `bodymusclename`
--

INSERT INTO `bodymusclename` (`id`, `idbodymuscle`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Masséter', 0, 0),
(2, 2, 1, 'Zygomatique', 0, 0),
(3, 3, 1, 'Occipito des lèvres', 0, 0),
(4, 4, 1, 'Corugator', 0, 0),
(5, 5, 1, 'Trapèze', 0, 0),
(6, 6, 1, 'Grand dorsal', 0, 0),
(7, 7, 1, 'Muscles intercostaux', 0, 0),
(8, 8, 1, 'Muscle carré des lombes', 0, 0),
(9, 9, 1, 'Muscles érecteurs du rachis', 0, 0),
(10, 10, 1, 'Le grand pectoral', 0, 0),
(11, 11, 1, 'Deltoïdes', 0, 0),
(12, 12, 1, 'Biceps', 0, 0),
(13, 13, 1, 'Triceps', 0, 0),
(14, 14, 1, 'Biceps brachial', 0, 0),
(15, 15, 1, 'Brachial antérieur', 0, 0),
(16, 16, 1, 'Triceps brachial', 0, 0),
(17, 17, 1, 'Long soupinateur', 0, 0),
(18, 18, 1, 'Grand palmaire', 0, 0),
(19, 19, 1, 'Cubital antérieur', 0, 0),
(20, 20, 1, 'Muscle thénarien', 0, 0),
(21, 21, 1, 'Muscles des doigts', 0, 0),
(22, 22, 1, 'Les fessiers', 0, 0),
(23, 23, 1, 'Les abducteurs', 0, 0),
(24, 24, 1, 'Les adducteurs', 0, 0),
(25, 25, 1, 'Muscles antérieurs', 0, 0),
(26, 26, 1, 'Moyens adducteur', 0, 0),
(27, 27, 1, 'Quadriceps', 0, 0),
(28, 28, 1, 'Ischio-jambiers', 0, 0),
(29, 29, 1, 'Jambier antérieur', 0, 0),
(30, 30, 1, 'Jumeaux externe', 0, 0),
(31, 31, 1, 'Jumeaux interne', 0, 0),
(32, 32, 1, 'Soléaire', 0, 0),
(33, 33, 1, 'Muscles des pieds', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food';

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`id`, `code`, `name`, `linktopicture`, `size`, `type`, `elemstate`, `timestamp`) VALUES
(1, 'CRISTALINE', 'Cristaline', 'T0xfQHOt8vguzvC8PREx2RclzdSyFzMZRrsDOLAoUxH', 8, 'image/png', 0, 3),
(2, 'LU', 'Lu', 'lkOhgK9NgsllsYHez1y7lFWR5eLEinbcqnpbu8eHAkyL', 8, 'image/jpeg', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `categoryfoodtype`
--

DROP TABLE IF EXISTS `categoryfoodtype`;
CREATE TABLE `categoryfoodtype` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(150) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Category Food types';

--
-- Déchargement des données de la table `categoryfoodtype`
--

INSERT INTO `categoryfoodtype` (`id`, `code`, `name`, `elemstate`, `timestamp`) VALUES
(1, 'WATERS', 'EAUX', 0, 0),
(2, 'SOURCE WATERS', 'EAUX DE SOURCES', 0, 0),
(3, 'MINERAL WATERS', 'EAUX MINERALES', 0, 0),
(4, 'SNACKS', 'GATEAUX', 0, 0),
(5, 'SWEET SNACKS', 'BISCUITS SUCRES', 0, 0),
(6, 'COOKIES_CAKE', 'GATEAUX AUX BISCUITS', 0, 0),
(7, 'BISCUITS', 'BISCUITS', 0, 0),
(8, 'CHOCOLATE_COOKIES', 'GATEAUX AUX CHOCOLATS', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categoryfoodtypename`
--

DROP TABLE IF EXISTS `categoryfoodtypename`;
CREATE TABLE `categoryfoodtypename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcategoryfoodtype` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Category Food types Names';

--
-- Déchargement des données de la table `categoryfoodtypename`
--

INSERT INTO `categoryfoodtypename` (`id`, `idcategoryfoodtype`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Eaux', 0, 0),
(2, 2, 1, 'Eaux de sources', 0, 0),
(3, 3, 1, 'Eaux minérales', 0, 0),
(4, 4, 1, 'Gâteaux', 0, 0),
(5, 5, 1, 'Biscuits sucrés', 0, 0),
(6, 6, 1, 'Gâteaux aux biscuits', 0, 0),
(7, 7, 1, 'Biscuits', 0, 0),
(8, 8, 1, 'Gâteaux aux chocolats', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `circuittype`
--

DROP TABLE IF EXISTS `circuittype`;
CREATE TABLE `circuittype` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Circuit Types';

--
-- Déchargement des données de la table `circuittype`
--

INSERT INTO `circuittype` (`id`, `code`, `name`, `elemstate`, `timestamp`) VALUES
(1, 'BISET', 'Biset', 0, 0),
(2, 'TRISET', 'Triset', 0, 0),
(3, 'TABATA', 'Tabata', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `circuittypename`
--

DROP TABLE IF EXISTS `circuittypename`;
CREATE TABLE `circuittypename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcircuittype` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Circuit Type Names';

--
-- Déchargement des données de la table `circuittypename`
--

INSERT INTO `circuittypename` (`id`, `idcircuittype`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Biset', 0, 0),
(2, 2, 1, 'Triset', 0, 0),
(3, 3, 1, 'Tabata', 0, 0),
(4, 1, 2, 'Biset', 0, 0),
(5, 2, 2, 'Triset', 0, 0),
(6, 3, 2, 'Tabata', 0, 0),
(7, 1, 3, 'Biset', 0, 0),
(8, 2, 3, 'Triset', 0, 0),
(9, 3, 3, 'Tabata', 0, 0),
(10, 1, 4, 'Biset', 0, 0),
(11, 2, 4, 'Triset', 0, 0),
(12, 3, 4, 'Tabata', 0, 0),
(13, 1, 5, 'Biset', 0, 0),
(14, 2, 5, 'Triset', 0, 0),
(15, 3, 5, 'Tabata', 0, 0),
(16, 1, 6, 'Biset', 0, 0),
(17, 2, 6, 'Triset', 0, 0),
(18, 3, 6, 'Tabata', 0, 0),
(19, 1, 7, 'Biset', 0, 0),
(20, 2, 7, 'Triset', 0, 0),
(21, 3, 7, 'Tabata', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `coachuser`
--

DROP TABLE IF EXISTS `coachuser`;
CREATE TABLE `coachuser` (
  `id` int(10) UNSIGNED NOT NULL,
  `styidusercoach` int(10) UNSIGNED NOT NULL,
  `styiduser` int(10) UNSIGNED NOT NULL,
  `datestart` int(10) UNSIGNED NOT NULL,
  `dateend` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='All user assigned User coach';

--
-- Déchargement des données de la table `coachuser`
--

INSERT INTO `coachuser` (`id`, `styidusercoach`, `styiduser`, `datestart`, `dateend`, `elemstate`, `timestamp`) VALUES
(1, 1, 2, 20220101, 20221231, 0, 0),
(2, 1, 3, 20220101, 20221231, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `diet`
--

DROP TABLE IF EXISTS `diet`;
CREATE TABLE `diet` (
  `id` int(10) UNSIGNED NOT NULL,
  `idusercoach` int(10) UNSIGNED NOT NULL,
  `iduserstudent` int(10) UNSIGNED NOT NULL,
  `iddiettemplate` int(10) UNSIGNED NOT NULL,
  `datestart` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Diets';

--
-- Déchargement des données de la table `diet`
--

INSERT INTO `diet` (`id`, `idusercoach`, `iduserstudent`, `iddiettemplate`, `datestart`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 1, 20220520, 0, 2),
(2, 1, 2, 1, 20220610, 0, 0),
(3, 2, 1, 2, 20220520, 0, 0),
(4, 1, 3, 1, 19700101, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `dietmeal`
--

DROP TABLE IF EXISTS `dietmeal`;
CREATE TABLE `dietmeal` (
  `id` int(10) UNSIGNED NOT NULL,
  `iddiet` int(10) UNSIGNED NOT NULL,
  `iddietrecipe` int(10) UNSIGNED NOT NULL,
  `daynumber` int(10) UNSIGNED NOT NULL,
  `idmealtype` int(10) UNSIGNED NOT NULL,
  `weight` int(10) UNSIGNED NOT NULL,
  `idweighttype` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Diets meals';

--
-- Déchargement des données de la table `dietmeal`
--

INSERT INTO `dietmeal` (`id`, `iddiet`, `iddietrecipe`, `daynumber`, `idmealtype`, `weight`, `idweighttype`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 1, 1, 100, 2, 0, 0),
(2, 1, 1, 1, 2, 100, 2, 0, 0),
(3, 1, 1, 1, 3, 100, 2, 0, 0),
(4, 1, 1, 1, 4, 100, 2, 0, 0),
(5, 1, 1, 2, 1, 100, 2, 0, 0),
(6, 1, 1, 2, 2, 100, 2, 0, 0),
(7, 1, 1, 2, 3, 100, 2, 0, 0),
(8, 1, 1, 2, 4, 100, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `dietstudent`
--

DROP TABLE IF EXISTS `dietstudent`;
CREATE TABLE `dietstudent` (
  `id` int(10) UNSIGNED NOT NULL,
  `iddiet` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Diets Students';

--
-- Déchargement des données de la table `dietstudent`
--

INSERT INTO `dietstudent` (`id`, `iddiet`, `iduser`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 0, 0),
(2, 1, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `diettemplate`
--

DROP TABLE IF EXISTS `diettemplate`;
CREATE TABLE `diettemplate` (
  `id` int(10) UNSIGNED NOT NULL,
  `idusercoach` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `duration` int(10) UNSIGNED NOT NULL,
  `tags` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Diet Template';

--
-- Déchargement des données de la table `diettemplate`
--

INSERT INTO `diettemplate` (`id`, `idusercoach`, `name`, `duration`, `tags`, `elemstate`, `timestamp`) VALUES
(1, 1, 'Diète 1', 7, 'Essai', 0, 7),
(2, 1, 'Diète 2', 14, 'Sèche,PDM', 0, 0),
(3, 1, 'Diète 3', 21, 'Débutant,confirmé', 0, 0),
(4, 1, 'Diète 4', 28, 'Débutant,confirmé', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE `exercise` (
  `id` int(10) UNSIGNED NOT NULL,
  `idusercoach` int(10) UNSIGNED NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idexercisetype` int(10) UNSIGNED NOT NULL,
  `isaudio` int(10) UNSIGNED NOT NULL,
  `isvideo` int(10) UNSIGNED NOT NULL,
  `playertype` varchar(20) DEFAULT NULL,
  `playerid` varchar(20) DEFAULT NULL,
  `linktopicture` varchar(150) DEFAULT NULL,
  `linktomedia` varchar(150) DEFAULT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Exercise';

--
-- Déchargement des données de la table `exercise`
--

INSERT INTO `exercise` (`id`, `idusercoach`, `code`, `name`, `idexercisetype`, `isaudio`, `isvideo`, `playertype`, `playerid`, `linktopicture`, `linktomedia`, `size`, `type`, `description`, `elemstate`, `timestamp`) VALUES
(1, 1, 'EXO1', 'Exercise 1', 1, 0, 1, '', '', 'videoExercice.png', 'videoExercice.mp4', 13, 'video/mp4', 'Desc Exo. 1', 0, 0),
(2, 1, 'EXO2', 'Exercise 2', 2, 0, 1, 'youtube', 'bTqVqk7FSmY', '', '', 0, '', 'Desc Exo. 2', 0, 0),
(3, 1, 'EXO3', 'Exercise 3', 3, 0, 1, 'vimeo', '143418951', '', '', 0, '', 'Desc Exo. 3', 0, 0),
(4, 1, 'EXO4', 'Exercise 4', 4, 1, 0, '', '', '', 'videoExercice.mp3', 14, 'audio/mp3', 'Desc Exo. 4', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `exercisemuscle`
--

DROP TABLE IF EXISTS `exercisemuscle`;
CREATE TABLE `exercisemuscle` (
  `id` int(10) UNSIGNED NOT NULL,
  `idexercise` int(10) UNSIGNED NOT NULL,
  `idbodymuscle` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Exercise Muscles';

--
-- Déchargement des données de la table `exercisemuscle`
--

INSERT INTO `exercisemuscle` (`id`, `idexercise`, `idbodymuscle`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 0, 0),
(2, 1, 2, 0, 0),
(3, 1, 3, 0, 0),
(4, 1, 4, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `exercisetype`
--

DROP TABLE IF EXISTS `exercisetype`;
CREATE TABLE `exercisetype` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Exercise Types';

--
-- Déchargement des données de la table `exercisetype`
--

INSERT INTO `exercisetype` (`id`, `code`, `name`, `elemstate`, `timestamp`) VALUES
(1, 'CARDIO', 'Cardiovascular exercise', 0, 0),
(2, 'STRENGTH', 'Strength Training Exercise', 0, 0),
(3, 'ENDURANCE', 'Endurance exercise', 0, 0),
(4, 'BALANCE', 'Balance exercise', 0, 0),
(5, 'STRETCHING', 'Stretching exercise', 0, 0),
(6, 'MENTAL', 'Mental exercise', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `exercisetypename`
--

DROP TABLE IF EXISTS `exercisetypename`;
CREATE TABLE `exercisetypename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idexercisetype` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Exercise Type Names';

--
-- Déchargement des données de la table `exercisetypename`
--

INSERT INTO `exercisetypename` (`id`, `idexercisetype`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Exercice cardiovasculaire', 0, 0),
(2, 2, 1, 'Exercice de musculation', 0, 0),
(3, 3, 1, 'Exercice d\'Endurance', 0, 0),
(4, 4, 1, 'Exercice d\'équilibre', 0, 0),
(5, 5, 1, 'Exercice d\'étirement', 0, 0),
(6, 6, 1, 'Exercice mentale', 0, 0),
(7, 1, 2, 'Cardiovascular exercise', 0, 0),
(8, 2, 2, 'Strength Training Exercise', 0, 0),
(9, 3, 2, 'Endurance exercise', 0, 0),
(10, 4, 2, 'Balance exercise', 0, 0),
(11, 5, 2, 'Stretching Exercise', 0, 0),
(12, 6, 2, 'Mental Exercise', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `idbrand` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `idscorenutri` int(10) UNSIGNED NOT NULL,
  `idscorenova` int(10) UNSIGNED NOT NULL,
  `idscoreeco` int(10) UNSIGNED NOT NULL,
  `description` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food';

--
-- Déchargement des données de la table `food`
--

INSERT INTO `food` (`id`, `idbrand`, `code`, `name`, `idscorenutri`, `idscorenova`, `idscoreeco`, `description`, `elemstate`, `timestamp`) VALUES
(1, 1, '112233445566778899', 'Spring water', 2, 2, 2, 'Spring water', 0, 0),
(2, 2, '998877665544332211', 'Prince Chocolate', 5, 5, 6, 'Prince Chocolate', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `foodcategory`
--

DROP TABLE IF EXISTS `foodcategory`;
CREATE TABLE `foodcategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `idfood` int(10) UNSIGNED NOT NULL,
  `idcategory` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Category';

--
-- Déchargement des données de la table `foodcategory`
--

INSERT INTO `foodcategory` (`id`, `idfood`, `idcategory`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 0, 0),
(2, 1, 2, 0, 0),
(3, 1, 3, 0, 0),
(4, 2, 4, 0, 0),
(5, 2, 5, 0, 0),
(6, 2, 6, 0, 0),
(7, 2, 7, 0, 0),
(8, 2, 8, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `foodlabel`
--

DROP TABLE IF EXISTS `foodlabel`;
CREATE TABLE `foodlabel` (
  `id` int(10) UNSIGNED NOT NULL,
  `idfood` int(10) UNSIGNED NOT NULL,
  `idlabel` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Label';

--
-- Déchargement des données de la table `foodlabel`
--

INSERT INTO `foodlabel` (`id`, `idfood`, `idlabel`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 0, 20),
(2, 1, 2, 0, 0),
(3, 1, 3, 0, 0),
(4, 1, 4, 1, 5),
(5, 1, 5, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `foodname`
--

DROP TABLE IF EXISTS `foodname`;
CREATE TABLE `foodname` (
  `id` int(10) UNSIGNED NOT NULL,
  `idfood` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Name';

--
-- Déchargement des données de la table `foodname`
--

INSERT INTO `foodname` (`id`, `idfood`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Eaux de sources', 0, 0),
(2, 2, 1, 'Prince Chocolat', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `foodnutritional`
--

DROP TABLE IF EXISTS `foodnutritional`;
CREATE TABLE `foodnutritional` (
  `id` int(10) UNSIGNED NOT NULL,
  `idfood` int(10) UNSIGNED NOT NULL,
  `idnutritional` int(10) UNSIGNED NOT NULL,
  `idweighttype` int(10) UNSIGNED NOT NULL,
  `idweighttypebase` int(10) UNSIGNED NOT NULL,
  `nutritional` float UNSIGNED NOT NULL,
  `weighttypebase` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Nutritional';

--
-- Déchargement des données de la table `foodnutritional`
--

INSERT INTO `foodnutritional` (`id`, `idfood`, `idnutritional`, `idweighttype`, `idweighttypebase`, `nutritional`, `weighttypebase`, `elemstate`, `timestamp`) VALUES
(1, 1, 6, 2, 7, 0.021, 100, 0, 0),
(2, 1, 8, 4, 7, 100, 100, 0, 0),
(3, 1, 9, 3, 7, 2.6, 100, 0, 0),
(4, 1, 10, 3, 7, 3.3, 100, 0, 0),
(5, 1, 11, 3, 7, 1.9, 100, 0, 0),
(6, 1, 12, 3, 7, 2.2, 100, 0, 0),
(7, 1, 13, 3, 7, 2.6, 100, 0, 0),
(8, 1, 14, 3, 7, 2.6, 100, 0, 0),
(9, 1, 15, 3, 7, 0.1, 100, 0, 0),
(10, 1, 16, 3, 7, 1.9, 100, 0, 0),
(11, 1, 18, 3, 7, 2, 100, 0, 0),
(12, 1, 19, 3, 7, 6, 100, 0, 0),
(13, 2, 1, 13, 2, 1962, 100, 0, 0),
(14, 2, 2, 2, 2, 17.6, 100, 0, 0),
(15, 2, 3, 2, 2, 69, 100, 0, 0),
(16, 2, 20, 2, 2, 32.6, 100, 0, 0),
(17, 2, 4, 2, 2, 6, 100, 0, 0),
(18, 2, 6, 2, 2, 6, 100, 0, 0),
(19, 2, 0, 2, 2, 49, 100, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `foodtype`
--

DROP TABLE IF EXISTS `foodtype`;
CREATE TABLE `foodtype` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Types';

--
-- Déchargement des données de la table `foodtype`
--

INSERT INTO `foodtype` (`id`, `code`, `name`, `elemstate`, `timestamp`) VALUES
(1, 'FEC', 'Féculents', 0, 0),
(2, 'LEGU', 'Légumes', 0, 0),
(3, 'VIANDE', 'Viande', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `foodtypename`
--

DROP TABLE IF EXISTS `foodtypename`;
CREATE TABLE `foodtypename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idfoodtype` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Type Names';

--
-- Déchargement des données de la table `foodtypename`
--

INSERT INTO `foodtypename` (`id`, `idfoodtype`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Féculents', 0, 0),
(2, 2, 1, 'Légumes', 0, 0),
(3, 3, 1, 'Viande', 0, 0),
(4, 1, 2, 'Starches', 0, 0),
(5, 2, 2, 'Vegetables', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `foodweight`
--

DROP TABLE IF EXISTS `foodweight`;
CREATE TABLE `foodweight` (
  `id` int(10) UNSIGNED NOT NULL,
  `idfood` int(10) UNSIGNED NOT NULL,
  `idweighttype` int(10) UNSIGNED NOT NULL,
  `weight` float(6,2) UNSIGNED NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Weight';

--
-- Déchargement des données de la table `foodweight`
--

INSERT INTO `foodweight` (`id`, `idfood`, `idweighttype`, `weight`, `linktopicture`, `size`, `type`, `elemstate`, `timestamp`) VALUES
(1, 1, 12, 1.00, '8IM4FPmJiLmIaH4OAfXAC9crf4i9QRFP3cdL0AIS1r9Uqg', 8, 'image/jpeg', 0, 7),
(2, 1, 12, 1.50, 'Z2ix2BgaBCfdUQPSbEvhmVJUEXl2q2LgBCeIQwVvM', 8, 'image/jpeg', 0, 1),
(3, 2, 2, 300.00, '', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `label`
--

DROP TABLE IF EXISTS `label`;
CREATE TABLE `label` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Labels';

--
-- Déchargement des données de la table `label`
--

INSERT INTO `label` (`id`, `code`, `name`, `linktopicture`, `size`, `type`, `elemstate`, `timestamp`) VALUES
(1, 'BIO', 'Bio', 'FxXGBH0rNc9VpcWyREcPLMMl3HDhxPLodvQgE3Gl8N', 8, 'image/png', 0, 1),
(2, 'ECOCERT', 'Ecocert', '', 0, '', 0, 0),
(3, 'BIO EUROPEEN', 'Bio européen', 'YYm3CytRAA3IX2jpM8Hy4zTljHYHKeh6Hmk9sQQ0tM', 8, 'image/png', 0, 1),
(4, 'FR-BIO-01', 'FR-BIO-01', '', 0, '', 0, 0),
(5, 'MADE_IN_FRANCE', 'Fabriqué en France', '', 0, '', 0, 0),
(6, 'AB AGRICULTURE BIOLOGIQUE', 'AB Agriculture Biologique', 'df8abqMoy81lAEIyvdBzYEJwH3FcbRhTLbDo4TbR4N', 8, 'image/png', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(10) UNSIGNED NOT NULL,
  `codeshort` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `name` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Languages';

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`id`, `codeshort`, `code`, `name`, `linktopicture`, `size`, `type`, `elemstate`, `timestamp`) VALUES
(1, 'FR', 'FRANCAIS', 'Français', 'aQhlmcEXwaNEUFkd3QscutcTlkmD1wpDVt', 8, 'image/png', 0, 15),
(2, 'EN', 'ENGLISH', 'English', 'RXJKB9waQboGxoi2XHIftQpPnaPTOp5000oEea', 8, 'image/png', 0, 3),
(3, 'ES', 'ESPAGNOL', 'Espagnol', 'ZIeniLryXlJdAEE4ru2j1BKWoM5uFUYcYiCvuc0OG7m', 8, 'image/png', 0, 4),
(4, 'IT', 'ITALIEN', 'Italien', 'WvPNiVjzzoqGQusCFVtBKxgbyFDBn46sJxGzjTM', 8, 'image/png', 0, 2),
(5, 'PO', 'PORTUGAIS', 'Portugais', 'V1TgtmVLxg6GvkMGdp6vUZNsjo88Mx1PJBtvAmFexoC1g', 8, 'image/png', 0, 3),
(6, 'BR', 'BRESILIEN', 'Brésilien', 'W6yLXKILitxzaDcFTVPivNX7jG9DYx1sqzpRRjbg1b', 8, 'image/png', 0, 2),
(7, 'US', 'AMERICAIN', 'Américain', 'W4QMtjAnmlSjMqMw1pbn2gNfLQ3uSC64TqXqMGkktaLc', 8, 'image/png', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `mealtype`
--

DROP TABLE IF EXISTS `mealtype`;
CREATE TABLE `mealtype` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(150) NOT NULL,
  `name` varchar(200) NOT NULL,
  `displayorder` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Meals types';

--
-- Déchargement des données de la table `mealtype`
--

INSERT INTO `mealtype` (`id`, `code`, `name`, `displayorder`, `elemstate`, `timestamp`) VALUES
(1, 'PETIT_DEJEUNER', 'Petit-déjeuner', 1, 0, 0),
(2, 'DEJEUNER', 'Déjeuner', 2, 0, 0),
(3, 'COLLATION', 'Collations', 3, 0, 0),
(4, 'DINER', 'Dîner', 4, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `mealtypename`
--

DROP TABLE IF EXISTS `mealtypename`;
CREATE TABLE `mealtypename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idmealtype` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Meals types Names';

--
-- Déchargement des données de la table `mealtypename`
--

INSERT INTO `mealtypename` (`id`, `idmealtype`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Petit-déjeuner', 0, 0),
(2, 2, 1, 'Déjeuner', 0, 0),
(3, 3, 1, 'Collation', 0, 0),
(4, 4, 1, 'Dîner', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `nutritional`
--

DROP TABLE IF EXISTS `nutritional`;
CREATE TABLE `nutritional` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(150) NOT NULL,
  `name` varchar(200) NOT NULL,
  `iscalorie` tinyint(3) UNSIGNED NOT NULL,
  `isproetin` tinyint(3) UNSIGNED NOT NULL,
  `isglucide` tinyint(3) UNSIGNED NOT NULL,
  `islipid` tinyint(3) UNSIGNED NOT NULL,
  `isvitamin` tinyint(3) UNSIGNED NOT NULL,
  `istraceelement` tinyint(3) UNSIGNED NOT NULL,
  `ismineral` tinyint(3) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Nutritional';

--
-- Déchargement des données de la table `nutritional`
--

INSERT INTO `nutritional` (`id`, `code`, `name`, `iscalorie`, `isproetin`, `isglucide`, `islipid`, `isvitamin`, `istraceelement`, `ismineral`, `elemstate`, `timestamp`) VALUES
(1, 'ENERGIE', 'Énergie', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'MATIERES_GRASSES', 'Matières grasses', 1, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'GLUCIDES', 'Glucides', 0, 0, 1, 0, 0, 0, 0, 0, 0),
(4, 'FIBRES_ALIMENTAIRES', 'Fibres alimentaires', 0, 0, 0, 1, 0, 0, 0, 0, 0),
(5, 'PROTEINES', 'Protéines', 0, 1, 0, 0, 0, 0, 0, 0, 0),
(6, 'SEL', 'Sel', 0, 0, 0, 0, 0, 0, 1, 0, 0),
(7, 'ALCOOL', 'Alcool', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'BIOTINE', 'Biotine - Vitamine B8', 0, 0, 0, 0, 1, 0, 0, 0, 0),
(9, 'SILICE', 'Silice', 0, 0, 0, 0, 0, 0, 1, 0, 0),
(10, 'BICARBONATE', 'Bicarbonate', 0, 0, 0, 0, 0, 0, 1, 0, 0),
(11, 'POTASSIUM', 'Potassium', 0, 0, 0, 0, 0, 0, 1, 0, 0),
(12, 'CHLORURE', 'Chlorure', 0, 0, 0, 0, 0, 0, 1, 0, 0),
(13, 'CALCIUM', 'Calcium', 0, 0, 0, 0, 0, 0, 1, 0, 0),
(14, 'MAGNESIUM', 'Magnésium', 0, 0, 0, 0, 0, 1, 0, 0, 0),
(15, 'FLUORURE', 'Fluorure', 0, 0, 0, 0, 0, 0, 1, 0, 0),
(16, 'CAFEINE', 'Caféine', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'FRUITS_LEGUMES_NOIX', 'Fruits‚ légumes‚ noix et huiles de colza‚ noix et olive', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 'NITRATE', 'Nitrate', 0, 0, 0, 0, 0, 0, 1, 0, 0),
(19, 'SULFATE', 'Sulfate', 0, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `nutritionalname`
--

DROP TABLE IF EXISTS `nutritionalname`;
CREATE TABLE `nutritionalname` (
  `id` int(10) UNSIGNED NOT NULL,
  `idnutritional` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Nutritional Names';

--
-- Déchargement des données de la table `nutritionalname`
--

INSERT INTO `nutritionalname` (`id`, `idnutritional`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Énergie', 0, 0),
(2, 2, 1, 'Matières grasses', 0, 0),
(3, 3, 1, 'Glucides', 0, 0),
(4, 4, 1, 'Fibres alimentaires', 0, 0),
(5, 5, 1, 'Protéines', 0, 0),
(6, 6, 1, 'Sel', 0, 0),
(7, 7, 1, 'Alcool', 0, 0),
(8, 8, 1, 'Biotine - Vitamine B8', 0, 0),
(9, 9, 1, 'Silice', 0, 0),
(10, 10, 1, 'Bicarbonate', 0, 0),
(11, 11, 1, 'Potassium', 0, 0),
(12, 12, 1, 'Chlorure', 0, 0),
(13, 13, 1, 'Calcium', 0, 0),
(14, 14, 1, 'Magnésium', 0, 0),
(15, 15, 1, 'Fluorure', 0, 0),
(16, 16, 1, 'Caféine', 0, 0),
(17, 17, 1, 'Fruits‚ légumes‚ noix et huiles de colza‚ noix et olive', 0, 0),
(18, 18, 1, 'Nitrate', 0, 0),
(19, 19, 1, 'Sulfate', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE `recipe` (
  `id` int(10) UNSIGNED NOT NULL,
  `idusercoach` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Recipes';

--
-- Déchargement des données de la table `recipe`
--

INSERT INTO `recipe` (`id`, `idusercoach`, `code`, `name`, `description`, `linktopicture`, `size`, `type`, `rating`, `elemstate`, `timestamp`) VALUES
(1, 1, 'RECIPE1', 'Recette 1', '', '', 0, '', 4, 0, 3),
(2, 1, 'RECIPE2', 'Recette 2', 'Recette numéro 2', '', 0, '', 3, 0, 0),
(3, 0, 'RECIPE1', 'Recette 1', '', '', 0, '', 3, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `recipefood`
--

DROP TABLE IF EXISTS `recipefood`;
CREATE TABLE `recipefood` (
  `id` int(10) UNSIGNED NOT NULL,
  `idrecipe` int(10) UNSIGNED NOT NULL,
  `idfood` int(10) UNSIGNED NOT NULL,
  `weight` int(10) UNSIGNED NOT NULL,
  `idweighttype` int(10) UNSIGNED NOT NULL,
  `calorie` int(10) UNSIGNED NOT NULL,
  `proetin` int(10) UNSIGNED NOT NULL,
  `glucide` int(10) UNSIGNED NOT NULL,
  `lipid` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Recipes food';

--
-- Déchargement des données de la table `recipefood`
--

INSERT INTO `recipefood` (`id`, `idrecipe`, `idfood`, `weight`, `idweighttype`, `calorie`, `proetin`, `glucide`, `lipid`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 100, 2, 20, 30, 40, 50, 0, 2),
(2, 1, 2, 800, 2, 10, 20, 30, 40, 0, 0),
(5, 2, 1, 50, 2, 0, 0, 0, 0, 0, 2),
(6, 2, 2, 200, 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `scoreeco`
--

DROP TABLE IF EXISTS `scoreeco`;
CREATE TABLE `scoreeco` (
  `id` int(10) UNSIGNED NOT NULL,
  `letter` varchar(2) NOT NULL,
  `color` varchar(10) NOT NULL,
  `description` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Eco scores';

--
-- Déchargement des données de la table `scoreeco`
--

INSERT INTO `scoreeco` (`id`, `letter`, `color`, `description`, `linktopicture`, `size`, `type`, `elemstate`, `timestamp`) VALUES
(1, '?', '#b3b3b3', '?', 'UVA3ytuPNC5H2foRk8mhOeYCOz0dHagqntFnllaMwkEuU', 8, 'image/png', 0, 7),
(2, 'A', '#208E51', 'A', 't9MraT6lhXh84P9Z4dEl1eEbxLJSyZtUm5U0xHv', 8, 'image/png', 0, 1),
(3, 'B', '#5FAE31', 'B', 'b1JehxVBG9YIqrfGJEFdDsFvtCegHSmiot0nGxcE', 8, 'image/png', 0, 1),
(4, 'C', '#E7B40B', 'C', '6bWrk9LiDkrCdfps3McViXNn1E4gPDa5Pt5ykHbSC2R', 8, 'image/png', 0, 1),
(5, 'D', '#E47323', 'D', 'Vt8NzX0MNg5LgUFZfYxFg3m8pPORMdUjvEEKmSHC', 8, 'image/png', 0, 1),
(6, 'E', '#EF131F', 'E', 'Chafe4FL5JVIpTMATDp2K0sR7N4xi6eUQqz1', 8, 'image/png', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `scorenova`
--

DROP TABLE IF EXISTS `scorenova`;
CREATE TABLE `scorenova` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(2) NOT NULL,
  `color` varchar(10) NOT NULL,
  `description` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Nova scores';

--
-- Déchargement des données de la table `scorenova`
--

INSERT INTO `scorenova` (`id`, `number`, `color`, `description`, `linktopicture`, `size`, `type`, `elemstate`, `timestamp`) VALUES
(1, '?', '#B3B3B3', '?', '', 0, '', 0, 0),
(2, '1', '#00A501', '', '5LFlMNFmHNsjt4YRSpMxvoII9hJyc1kLtCkM4WPE4aVwRM', 8, 'image/png', 0, 1),
(3, '2', '#F7C600', '', 'hQTHXtFL40Fks5uRBZ60sEVUlwigo8VoQIPdjITokb', 8, 'image/png', 0, 1),
(4, '3', '#F76300', '', '8050wsK6X5keLO61OAoUeKmPzwIKa7Ho0EbI8vTEisVr', 8, 'image/png', 0, 1),
(5, '4', '#F60000', '', 'zANb2oVdPyVm5xktuY266rrrO6J6ZGgfC0nRll', 8, 'image/png', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `scorenutri`
--

DROP TABLE IF EXISTS `scorenutri`;
CREATE TABLE `scorenutri` (
  `id` int(10) UNSIGNED NOT NULL,
  `letter` varchar(2) NOT NULL,
  `color` varchar(10) NOT NULL,
  `description` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Nutri scores';

--
-- Déchargement des données de la table `scorenutri`
--

INSERT INTO `scorenutri` (`id`, `letter`, `color`, `description`, `linktopicture`, `size`, `type`, `elemstate`, `timestamp`) VALUES
(1, '?', '#B3B3B3', '', 'jIOhkwpg16AjuJbfjkZL7bz3Ie3y4qTSjnCXMyn893Nb', 8, 'image/png', 0, 3),
(2, 'A', '#0A8E45', '', 'm1UyHwBAeF2ohp3XSLUK29QHPVrBvuhtbbewzj', 8, 'image/png', 0, 1),
(3, 'B', '#7AC547', '', 'ImyANrdFSILTVTCd96BYmTuAi4WrUFDcrvKjAiYH6s', 8, 'image/png', 0, 1),
(4, 'C', '#FFC734', '', 'K2uZdR5HHQwj4n4XWSmATmvWh3vElblIhoyS1XO5', 8, 'image/png', 0, 1),
(5, 'D', '#FF7D24', '', 'BZuLDmZ6dTvZ7KMOfKewLuaj4jCTCnrSK4W3gTkPj', 8, 'image/png', 0, 1),
(6, 'E', '#FF421A', '', 'By6qmju9OnPcssmH5v5CupHxLrgViEgT4HoBcqud', 8, 'image/png', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sociallink`
--

DROP TABLE IF EXISTS `sociallink`;
CREATE TABLE `sociallink` (
  `id` int(10) UNSIGNED NOT NULL,
  `color` varchar(255) NOT NULL,
  `colorbg` varchar(255) NOT NULL,
  `iconfa` varchar(160) NOT NULL,
  `linksocial` varchar(255) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Social Link';

--
-- Déchargement des données de la table `sociallink`
--

INSERT INTO `sociallink` (`id`, `color`, `colorbg`, `iconfa`, `linksocial`, `linktopicture`, `size`, `type`, `timestamp`) VALUES
(1, '#ffffff', '#3b5998', 'fa-facebook', 'www.facebook.fr', '', 0, '', 0),
(2, '#ffffff', '#1da1f2', 'fa-twitter', 'www.twitter.fr', '', 0, '', 0),
(3, '#ffffff', '#007bb5', 'fa-linkedin', 'www.linkedin.fr', '', 0, '', 0),
(4, '#ffffff', '#f46f30', 'fa-instagram', 'www.instagram.fr', '', 0, '', 0),
(5, '#ffffff', '#c32361', 'fa-dribbble', 'www.dribbble.fr', '', 0, '', 0),
(6, '#ffffff', '#3d464d', 'fa-dropbox', 'www.dropbox.fr', '', 0, '', 0),
(7, '#ffffff', '#db4437', 'fa-google', 'www.google.fr', '', 0, '', 0),
(8, '#ffffff', '#bd081c', 'fa-pinterest', 'www.pinterest.fr', '', 0, '', 0),
(9, '#ffffff', '#00aff0', 'fa-skype', 'www.skype.fr', '', 0, '', 0),
(10, '#ffffff', '#00b489', 'fa-vine', 'www.vine.fr', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `styapplication`
--

DROP TABLE IF EXISTS `styapplication`;
CREATE TABLE `styapplication` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Applications';

--
-- Déchargement des données de la table `styapplication`
--

INSERT INTO `styapplication` (`id`, `code`, `description`, `statut`, `timestamp`) VALUES
(1, 'WEBVYSION_SPORT', 'WebVysion Sport', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `stycoatchuser`
--

DROP TABLE IF EXISTS `stycoatchuser`;
CREATE TABLE `stycoatchuser` (
  `id` int(10) UNSIGNED NOT NULL,
  `idusercoatch` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `datestart` int(10) UNSIGNED NOT NULL,
  `dateend` int(10) UNSIGNED NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='All user assigned User Coatch';

--
-- Déchargement des données de la table `stycoatchuser`
--

INSERT INTO `stycoatchuser` (`id`, `idusercoatch`, `iduser`, `datestart`, `dateend`, `statut`, `timestamp`) VALUES
(1, 1, 2, 20220101, 20221231, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styenterpisewhitemarking`
--

DROP TABLE IF EXISTS `styenterpisewhitemarking`;
CREATE TABLE `styenterpisewhitemarking` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyenterprise` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `logo1` varchar(100) NOT NULL,
  `logo2` varchar(100) NOT NULL,
  `color1` varchar(10) NOT NULL,
  `color2` varchar(10) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Enterpise white Marking';

--
-- Déchargement des données de la table `styenterpisewhitemarking`
--

INSERT INTO `styenterpisewhitemarking` (`id`, `idstyenterprise`, `name`, `url`, `logo1`, `logo2`, `color1`, `color2`, `elemstate`, `timestamp`) VALUES
(1, 1, 'WebVysion Sport Fr', 'http://localhost/WebVysionSportV2', '', '', '#9bc8db', '#69a7c5', 0, 0),
(2, 2, 'WebVysion Sport En', 'http://localhost/WebVysionSportV2', '', '', '#198754', '#ffc107', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styenterprise`
--

DROP TABLE IF EXISTS `styenterprise`;
CREATE TABLE `styenterprise` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `co` varchar(80) NOT NULL,
  `street` varchar(80) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `city` varchar(60) NOT NULL,
  `logoimagehtmlname` varchar(180) NOT NULL,
  `logoimagename` varchar(180) NOT NULL,
  `logosize` int(10) UNSIGNED NOT NULL,
  `logotype` varchar(255) NOT NULL DEFAULT '',
  `idregion` int(10) UNSIGNED NOT NULL,
  `idcountry` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `idusermanager` int(10) UNSIGNED NOT NULL,
  `idstyenterpriseparent` int(10) UNSIGNED NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='StyEnterprises';

--
-- Déchargement des données de la table `styenterprise`
--

INSERT INTO `styenterprise` (`id`, `code`, `name`, `email`, `phone`, `mobile`, `co`, `street`, `zipcode`, `city`, `logoimagehtmlname`, `logoimagename`, `logosize`, `logotype`, `idregion`, `idcountry`, `idlanguage`, `idusermanager`, `idstyenterpriseparent`, `statut`, `timestamp`) VALUES
(1, 'WEBVYSION', 'WEBVYSION', 'contact@webvysion.fr', '1', '1', '', '7 Distrix Street', '77777', 'DistriX City', '', '', 0, ' ', 1, 77, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styenterprisepos`
--

DROP TABLE IF EXISTS `styenterprisepos`;
CREATE TABLE `styenterprisepos` (
  `id` int(10) UNSIGNED NOT NULL,
  `styidenterprise` int(10) UNSIGNED NOT NULL,
  `idpos` int(10) UNSIGNED NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='StyEnterprise POS';

--
-- Déchargement des données de la table `styenterprisepos`
--

INSERT INTO `styenterprisepos` (`id`, `styidenterprise`, `idpos`, `statut`, `timestamp`) VALUES
(1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styfunctionality`
--

DROP TABLE IF EXISTS `styfunctionality`;
CREATE TABLE `styfunctionality` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstymodule` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Module Functionalities';

--
-- Déchargement des données de la table `styfunctionality`
--

INSERT INTO `styfunctionality` (`id`, `idstymodule`, `code`, `description`, `statut`, `timestamp`) VALUES
(1, 1, 'ADMIN_ENTERPRISE', 'ADMIN_ENTERPRISE', 0, 0),
(2, 1, 'ADMIN_USER', 'ADMIN_USER', 0, 0),
(3, 1, 'ADMIN_USER_TYPE', 'ADMIN_USER_TYPE', 0, 0),
(4, 1, 'SECURITY_APPLICATION', 'SECURITY_APPLICATION', 0, 0),
(5, 1, 'SECURITY_MODULE', 'SECURITY_MODULE', 0, 0),
(6, 1, 'SECURITY_FUNCTIONALITY', 'SECURITY_FUNCTIONALITY', 0, 0),
(7, 1, 'SECURITY_ROLE', 'SECURITY_ROLE', 0, 0),
(8, 1, 'SECURITY_RIGHT', 'SECURITY_RIGHT', 0, 0),
(9, 1, 'FOOD_FOOD', 'FOOD_FOOD', 0, 0),
(10, 1, 'FOOD_BRAND', 'FOOD_BRAND', 0, 0),
(11, 1, 'FOOD_ECO_SCORE', 'FOOD_ECO_SCORE', 0, 0),
(12, 1, 'FOOD_NOVA_SCORE', 'FOOD_NOVA_SCORE', 0, 0),
(13, 1, 'FOOD_NUTRI_SCORE', 'FOOD_NUTRI_SCORE', 0, 0),
(14, 1, 'FOOD_LABEL', 'FOOD_LABEL', 0, 0),
(15, 1, 'CODE_TABLE_WEIGHT_TYPE', 'CODE_TABLE_WEIGHT_TYPE', 0, 0),
(16, 1, 'CODE_TABLE_LANGUES', 'CODE_TABLE_LANGUES', 0, 0),
(17, 1, 'CODE_TABLE_FOOD_CATEGORY', 'CODE_TABLE_FOOD_CATEGORY', 0, 0),
(18, 1, 'CODE_TABLE_NUTRITIONAL', 'CODE_TABLE_NUTRITIONAL', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stylanguage`
--

DROP TABLE IF EXISTS `stylanguage`;
CREATE TABLE `stylanguage` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security languages';

--
-- Déchargement des données de la table `stylanguage`
--

INSERT INTO `stylanguage` (`id`, `code`, `description`, `linktopicture`, `size`, `type`, `statut`, `timestamp`) VALUES
(1, 'FR', 'Français', 'RJsUuveRc4qF11eQxFZHYA1xN2guopPK41FGTfrT8Ixz', 8, 'image/png', 0, 1),
(2, 'EN', 'English', 'tLDcblpqbIFEMIqBlbMgWGvzApnoZWd6qFY9PEzY5', 8, 'image/png', 0, 5);

-- --------------------------------------------------------

--
-- Structure de la table `stymodule`
--

DROP TABLE IF EXISTS `stymodule`;
CREATE TABLE `stymodule` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyapplication` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Modules';

--
-- Déchargement des données de la table `stymodule`
--

INSERT INTO `stymodule` (`id`, `idstyapplication`, `code`, `description`, `statut`, `timestamp`) VALUES
(1, 1, 'SECURITY', 'SECURITY', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styright`
--

DROP TABLE IF EXISTS `styright`;
CREATE TABLE `styright` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(10) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Rights';

--
-- Déchargement des données de la table `styright`
--

INSERT INTO `styright` (`id`, `code`, `name`, `description`, `statut`, `timestamp`) VALUES
(1, 1, 'View', '', 0, 0),
(2, 2, 'Change', '', 0, 0),
(3, 4, 'Add', '', 0, 0),
(4, 8, 'Remove', '', 0, 0),
(5, 16, 'Delete', '', 0, 0),
(6, 32, 'Print', '', 0, 0),
(7, 64, 'List', '', 0, 0),
(8, 128, 'Follow', '', 0, 0),
(9, 256, 'Security', '', 0, 0),
(10, 512, 'Publish', '', 0, 0),
(11, 1024, 'Restore', '', 0, 0),
(12, 2048, 'Duplicate', '', 0, 0),
(13, 4096, 'Agenda', '', 0, 0),
(14, 2147483648, 'Manage', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styrole`
--

DROP TABLE IF EXISTS `styrole`;
CREATE TABLE `styrole` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Roles';

--
-- Déchargement des données de la table `styrole`
--

INSERT INTO `styrole` (`id`, `code`, `name`, `description`, `statut`, `timestamp`) VALUES
(1, 'SEC_MAN', 'Security Manager', 'Security Manager', 0, 0),
(2, 'WEB_MAN', 'WebVysion Manager', 'WebVysion Manager', 0, 0),
(3, 'WEB_USER', 'WebVysion User', 'WebVysion User', 0, 0),
(4, 'ENT_MAN', 'Enterprise Manager', 'Enterprise Manager', 0, 0),
(5, 'COATCH_MAN', 'Coatch Manager', 'Coatch Manager', 0, 0),
(6, 'COATCH', 'Coatch', 'Coatch', 0, 0),
(7, 'STUDENT', 'Elève', 'Elève', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styroleright`
--

DROP TABLE IF EXISTS `styroleright`;
CREATE TABLE `styroleright` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyrole` int(10) UNSIGNED NOT NULL,
  `idstyapplication` int(10) UNSIGNED NOT NULL,
  `idstymodule` int(10) UNSIGNED NOT NULL,
  `idstyfunctionality` int(10) UNSIGNED NOT NULL,
  `sumofrights` int(10) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Role Rights';

--
-- Déchargement des données de la table `styroleright`
--

INSERT INTO `styroleright` (`id`, `idstyrole`, `idstyapplication`, `idstymodule`, `idstyfunctionality`, `sumofrights`, `timestamp`) VALUES
(1, 1, 1, 1, 1, 2147483648, 0),
(2, 1, 1, 1, 2, 2147483648, 0),
(3, 1, 1, 1, 3, 2147483648, 0),
(4, 1, 1, 1, 4, 2147483648, 0),
(5, 1, 1, 1, 5, 2147483648, 0),
(6, 1, 1, 1, 6, 2147483648, 0),
(7, 1, 1, 1, 7, 2147483648, 0),
(8, 1, 1, 1, 8, 2147483648, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stytemporarycode`
--

DROP TABLE IF EXISTS `stytemporarycode`;
CREATE TABLE `stytemporarycode` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyuserpazzi` int(10) UNSIGNED NOT NULL,
  `idstyapplication` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `validitydate` int(10) UNSIGNED NOT NULL,
  `validitytime` int(10) UNSIGNED NOT NULL,
  `used` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Forget Password Temporary Code';

-- --------------------------------------------------------

--
-- Structure de la table `styuser`
--

DROP TABLE IF EXISTS `styuser`;
CREATE TABLE `styuser` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyusertype` tinyint(3) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `name` varchar(80) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `emailbackup` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `initpass` tinyint(3) UNSIGNED DEFAULT NULL,
  `idlanguage` int(10) UNSIGNED DEFAULT NULL,
  `idstyenterprise` int(10) UNSIGNED NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security Users';

--
-- Déchargement des données de la table `styuser`
--

INSERT INTO `styuser` (`id`, `idstyusertype`, `login`, `firstname`, `name`, `linktopicture`, `size`, `type`, `pass`, `email`, `emailbackup`, `phone`, `mobile`, `initpass`, `idlanguage`, `idstyenterprise`, `statut`, `timestamp`) VALUES
(1, 1, 'One', 'One', 'User1', 'zEZHMoYs2048gmFkWooCO0MqJUWJLmZMC1Q5id8uQn', 8, 'image/jpeg', 'f', 'one.user1@distrix.org', '', '', '', 0, 1, 1, 0, 16),
(2, 2, 'Two', 'Two', 'User2', '', 0, '', 'f', 'two.user2@distrix.org', '', '', '', 0, 1, 1, 0, 0),
(3, 2, 'Three', 'Three', 'User3', '', 0, '', 'f', 'three.user3@distrix.org', ' ', ' ', ' ', 0, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styuserright`
--

DROP TABLE IF EXISTS `styuserright`;
CREATE TABLE `styuserright` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyuser` int(10) UNSIGNED NOT NULL,
  `idstyapplication` int(10) UNSIGNED NOT NULL,
  `idstymodule` int(10) UNSIGNED NOT NULL,
  `idstyfunctionality` int(10) UNSIGNED NOT NULL,
  `sumofrights` int(10) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security User Rights';

--
-- Déchargement des données de la table `styuserright`
--

INSERT INTO `styuserright` (`id`, `idstyuser`, `idstyapplication`, `idstymodule`, `idstyfunctionality`, `sumofrights`, `timestamp`) VALUES
(1, 1, 1, 1, 1, 2147483648, 0),
(2, 1, 1, 1, 2, 2147483648, 0),
(3, 1, 1, 1, 3, 2147483648, 0),
(4, 1, 1, 1, 4, 2147483648, 0),
(5, 1, 1, 1, 5, 2147483648, 0),
(6, 1, 1, 1, 6, 2147483648, 0),
(7, 1, 1, 1, 7, 2147483648, 0),
(8, 1, 1, 1, 8, 2147483648, 0),
(9, 1, 1, 1, 9, 2147483648, 0),
(10, 1, 1, 1, 10, 2147483648, 0),
(11, 1, 1, 1, 11, 2147483648, 0),
(12, 1, 1, 1, 12, 2147483648, 0),
(13, 1, 1, 1, 13, 2147483648, 0),
(14, 1, 1, 1, 14, 2147483648, 0),
(15, 1, 1, 1, 15, 2147483648, 0),
(16, 1, 1, 1, 16, 2147483648, 0),
(17, 1, 1, 1, 17, 2147483648, 0),
(18, 1, 1, 1, 18, 2147483648, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styuserrole`
--

DROP TABLE IF EXISTS `styuserrole`;
CREATE TABLE `styuserrole` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyuser` int(10) UNSIGNED NOT NULL,
  `idstyrole` int(10) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security User Roles';

--
-- Déchargement des données de la table `styuserrole`
--

INSERT INTO `styuserrole` (`id`, `idstyuser`, `idstyrole`, `timestamp`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styusersociallink`
--

DROP TABLE IF EXISTS `styusersociallink`;
CREATE TABLE `styusersociallink` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyuser` int(10) UNSIGNED NOT NULL,
  `idsociallink` int(10) UNSIGNED NOT NULL,
  `sociallink` varchar(255) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security User Roles';

--
-- Déchargement des données de la table `styusersociallink`
--

INSERT INTO `styusersociallink` (`id`, `idstyuser`, `idsociallink`, `sociallink`, `timestamp`) VALUES
(1, 1, 1, 'http://www.socialnetwork1.fr', 0),
(2, 1, 2, 'http://www.socialnetwork2.fr', 0),
(3, 1, 3, 'http://www.socialnetwork3.fr', 0),
(4, 1, 4, 'http://www.socialnetwork4.fr', 0),
(5, 1, 5, 'http://www.socialnetwork5.fr', 0),
(6, 1, 6, 'http://www.socialnetwork6.fr', 0),
(7, 1, 7, 'http://www.socialnetwork7.fr', 0),
(8, 1, 8, 'http://www.socialnetwork8.fr', 0),
(9, 1, 9, 'http://www.socialnetwork9.fr', 0),
(10, 1, 10, 'http://www.socialnetwork10.fr', 0);

-- --------------------------------------------------------

--
-- Structure de la table `styusertype`
--

DROP TABLE IF EXISTS `styusertype`;
CREATE TABLE `styusertype` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `name` varchar(80) NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Security User Types';

--
-- Déchargement des données de la table `styusertype`
--

INSERT INTO `styusertype` (`id`, `code`, `name`, `statut`, `timestamp`) VALUES
(1, 'INTERNAL', 'Internal', 0, 0),
(2, 'EXTERNAL', 'External', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `styusertypename`
--

DROP TABLE IF EXISTS `styusertypename`;
CREATE TABLE `styusertypename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idstyusertype` int(10) UNSIGNED NOT NULL,
  `idcountry` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Sty User Type Names';

--
-- Déchargement des données de la table `styusertypename`
--

INSERT INTO `styusertypename` (`id`, `idstyusertype`, `idcountry`, `idlanguage`, `code`, `name`, `statut`, `timestamp`) VALUES
(1, 1, 77, 1, 'INTERNAL', 'Interne', 0, 0),
(2, 1, 77, 2, 'INTERNAL', 'Internal', 0, 0),
(3, 2, 77, 1, 'EXTERNAL', 'Externe', 0, 0),
(4, 2, 77, 2, 'EXTERNAL', 'external', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `subscriptionpackage`
--

DROP TABLE IF EXISTS `subscriptionpackage`;
CREATE TABLE `subscriptionpackage` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(150) NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Subscription Package';

--
-- Déchargement des données de la table `subscriptionpackage`
--

INSERT INTO `subscriptionpackage` (`id`, `code`, `price`, `elemstate`, `timestamp`) VALUES
(1, 'FREE', 0, 0, 0),
(2, 'LIGHT', 4.9, 0, 0),
(3, 'WHITE_MARKING', 9.9, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `subscriptionpackagename`
--

DROP TABLE IF EXISTS `subscriptionpackagename`;
CREATE TABLE `subscriptionpackagename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idsubscriptionpackage` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Subscription Package Name';

--
-- Déchargement des données de la table `subscriptionpackagename`
--

INSERT INTO `subscriptionpackagename` (`id`, `idsubscriptionpackage`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Gratuit', 0, 0),
(2, 2, 1, 'Formule limitée', 0, 0),
(3, 3, 1, 'Formule en marque blanche', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int(10) UNSIGNED NOT NULL,
  `idusercreate` int(10) UNSIGNED NOT NULL,
  `iduserassign` int(10) UNSIGNED NOT NULL,
  `idtickettype` int(10) UNSIGNED NOT NULL,
  `idticketstatus` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `descmessage` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Ticket';

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id`, `idusercreate`, `iduserassign`, `idtickettype`, `idticketstatus`, `title`, `descmessage`, `date`, `time`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 1, 1, 'Premier ticket', 'Desc Premier ticket', 20220611, 90600, 0, 0),
(2, 1, 1, 1, 1, 'Deuxième ticket', 'Desc Deuxième ticket', 20220611, 100600, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ticketadvancement`
--

DROP TABLE IF EXISTS `ticketadvancement`;
CREATE TABLE `ticketadvancement` (
  `id` int(10) UNSIGNED NOT NULL,
  `idticket` int(10) UNSIGNED NOT NULL,
  `idticketstatus` int(10) UNSIGNED NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Ticket Comment';

--
-- Déchargement des données de la table `ticketadvancement`
--

INSERT INTO `ticketadvancement` (`id`, `idticket`, `idticketstatus`, `date`, `time`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 20220611, 90600, 0, 0),
(2, 1, 2, 20220611, 100600, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ticketcomment`
--

DROP TABLE IF EXISTS `ticketcomment`;
CREATE TABLE `ticketcomment` (
  `id` int(10) UNSIGNED NOT NULL,
  `idticket` int(10) UNSIGNED NOT NULL,
  `iduser` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `descmessage` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Food Name';

--
-- Déchargement des données de la table `ticketcomment`
--

INSERT INTO `ticketcomment` (`id`, `idticket`, `iduser`, `title`, `descmessage`, `date`, `time`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Premier message du ticket', 'Desc du premier message du ticket', 20220611, 100600, 0, 0),
(2, 1, 2, 'Deuxième message du ticket', 'Desc du deuxième message du ticket', 20220611, 100600, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ticketpicture`
--

DROP TABLE IF EXISTS `ticketpicture`;
CREATE TABLE `ticketpicture` (
  `id` int(10) UNSIGNED NOT NULL,
  `idticket` int(10) UNSIGNED NOT NULL,
  `idticketcomment` int(10) UNSIGNED NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Ticket picture';

-- --------------------------------------------------------

--
-- Structure de la table `ticketstatus`
--

DROP TABLE IF EXISTS `ticketstatus`;
CREATE TABLE `ticketstatus` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Ticket status';

--
-- Déchargement des données de la table `ticketstatus`
--

INSERT INTO `ticketstatus` (`id`, `code`, `name`, `elemstate`, `timestamp`) VALUES
(1, 'NEW', 'New', 0, 0),
(2, 'IN_PROGRESS', 'In progress', 0, 0),
(3, 'ON_HOLD', 'On hol', 0, 0),
(4, 'RESOLVED', 'Resolved', 0, 0),
(5, 'CLOSED', 'closed', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ticketstatusname`
--

DROP TABLE IF EXISTS `ticketstatusname`;
CREATE TABLE `ticketstatusname` (
  `id` int(10) UNSIGNED NOT NULL,
  `idticketstatus` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Ticket status name';

--
-- Déchargement des données de la table `ticketstatusname`
--

INSERT INTO `ticketstatusname` (`id`, `idticketstatus`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Nouveau', 0, 0),
(2, 2, 1, 'En cours', 0, 0),
(3, 3, 1, 'En attente', 0, 0),
(4, 4, 1, 'Résolu', 0, 0),
(5, 5, 1, 'Fermé', 0, 1),
(6, 5, 2, 'Closed', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tickettype`
--

DROP TABLE IF EXISTS `tickettype`;
CREATE TABLE `tickettype` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Ticket type';

--
-- Déchargement des données de la table `tickettype`
--

INSERT INTO `tickettype` (`id`, `code`, `name`, `elemstate`, `timestamp`) VALUES
(1, 'BUGS', 'Bugs', 0, 0),
(2, 'DEFECTS', 'Défauts', 0, 0),
(3, 'IMPROVEMENTS', 'Améliorations', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tickettypename`
--

DROP TABLE IF EXISTS `tickettypename`;
CREATE TABLE `tickettypename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idtickettype` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Ticket type name';

--
-- Déchargement des données de la table `tickettypename`
--

INSERT INTO `tickettypename` (`id`, `idtickettype`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Bugs', 0, 0),
(2, 2, 1, 'Défauts', 0, 0),
(3, 3, 1, 'Améliorations', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `weighttype`
--

DROP TABLE IF EXISTS `weighttype`;
CREATE TABLE `weighttype` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `abbreviation` varchar(20) NOT NULL,
  `issolid` tinyint(3) UNSIGNED NOT NULL,
  `isliquid` tinyint(3) UNSIGNED NOT NULL,
  `isother` tinyint(3) UNSIGNED NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Weight Type';

--
-- Déchargement des données de la table `weighttype`
--

INSERT INTO `weighttype` (`id`, `code`, `name`, `abbreviation`, `issolid`, `isliquid`, `isother`, `elemstate`, `timestamp`) VALUES
(1, 'KG', 'Kilogramme', 'kg', 1, 0, 0, 0, 0),
(2, 'G', 'Gramme', 'g', 1, 0, 0, 0, 0),
(3, 'MG', 'Miligramme', 'mg', 1, 0, 0, 0, 0),
(4, 'UG', 'Microgramme', 'μg', 1, 0, 0, 0, 0),
(5, 'LIBRA', 'Pound', 'lb', 1, 0, 0, 0, 0),
(6, 'ONZA', 'Ounce', 'oz', 1, 0, 0, 0, 0),
(7, 'ML', 'Mililitre', 'ml', 0, 1, 0, 0, 0),
(8, 'CL', 'Centilitre', 'cl', 0, 1, 0, 0, 0),
(9, 'DL', 'Décilitre', 'dl', 0, 1, 0, 0, 0),
(10, 'DAL', 'Décalitre', 'dal', 0, 1, 0, 0, 0),
(11, 'HL', 'Hectolitre', 'hl', 0, 1, 0, 0, 0),
(12, 'L', 'Litre', 'l', 0, 1, 0, 0, 0),
(13, 'KCAL', 'Kilocalorie', 'kcal', 0, 0, 1, 0, 0),
(14, 'CAL', 'Calorie', 'calorie', 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `weighttypename`
--

DROP TABLE IF EXISTS `weighttypename`;
CREATE TABLE `weighttypename` (
  `id` int(10) UNSIGNED NOT NULL,
  `idweighttype` int(10) UNSIGNED NOT NULL,
  `idlanguage` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `elemstate` tinyint(3) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Weight Type Name';

--
-- Déchargement des données de la table `weighttypename`
--

INSERT INTO `weighttypename` (`id`, `idweighttype`, `idlanguage`, `name`, `elemstate`, `timestamp`) VALUES
(1, 1, 1, 'Kilogramme', 0, 0),
(2, 2, 1, 'Gramme', 0, 0),
(3, 3, 1, 'Miligramme', 0, 0),
(4, 4, 1, 'Microgramme', 0, 0),
(5, 5, 1, 'Pound', 0, 0),
(6, 6, 1, 'Ounce', 0, 0),
(7, 7, 1, 'Mililitre', 0, 0),
(8, 8, 1, 'Centilitre', 0, 0),
(9, 9, 1, 'Décilitre', 0, 0),
(10, 10, 1, 'Décalitre', 0, 0),
(11, 11, 1, 'Hectolitre', 0, 0),
(12, 12, 1, 'Litre', 0, 0),
(13, 13, 1, 'Kilocalorie', 0, 0),
(14, 14, 1, 'Calorie', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bodymember`
--
ALTER TABLE `bodymember`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `bodymembername`
--
ALTER TABLE `bodymembername`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indbodymemberunique` (`idbodymember`,`idlanguage`) USING BTREE,
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `bodymuscle`
--
ALTER TABLE `bodymuscle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `bodymusclename`
--
ALTER TABLE `bodymusclename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indbodymuscleunique` (`idbodymuscle`,`idlanguage`) USING BTREE,
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `categoryfoodtype`
--
ALTER TABLE `categoryfoodtype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `categoryfoodtypename`
--
ALTER TABLE `categoryfoodtypename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcategoryfoodtypeunique` (`idcategoryfoodtype`,`idlanguage`) USING BTREE,
  ADD KEY `indcategoryfoodtype` (`idcategoryfoodtype`),
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `circuittype`
--
ALTER TABLE `circuittype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `circuittypename`
--
ALTER TABLE `circuittypename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcircuittypeunique` (`idcircuittype`,`idlanguage`) USING BTREE,
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `coachuser`
--
ALTER TABLE `coachuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcoachuserunique` (`styidusercoach`,`styiduser`) USING BTREE,
  ADD KEY `indusercoach` (`styidusercoach`),
  ADD KEY `induser` (`styiduser`);

--
-- Index pour la table `diet`
--
ALTER TABLE `diet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inddietunique` (`idusercoach`,`iduserstudent`,`iddiettemplate`,`datestart`) USING BTREE,
  ADD KEY `inddiettemplate` (`iddiettemplate`),
  ADD KEY `inddiettusercoach` (`idusercoach`),
  ADD KEY `inddiettuserstudent` (`iduserstudent`);

--
-- Index pour la table `dietmeal`
--
ALTER TABLE `dietmeal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inddietunique` (`iddiet`,`iddietrecipe`,`daynumber`,`idmealtype`) USING BTREE,
  ADD KEY `inddiet` (`iddiet`),
  ADD KEY `inddiettrecipe` (`iddietrecipe`),
  ADD KEY `indidmealtype` (`idmealtype`);

--
-- Index pour la table `dietstudent`
--
ALTER TABLE `dietstudent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inddietunique` (`iddiet`,`iduser`) USING BTREE,
  ADD KEY `inddiet` (`iddiet`),
  ADD KEY `induser` (`iduser`);

--
-- Index pour la table `diettemplate`
--
ALTER TABLE `diettemplate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inddietunique` (`idusercoach`,`name`,`duration`) USING BTREE,
  ADD KEY `inddiettemplate` (`idusercoach`);

--
-- Index pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`idusercoach`,`code`) USING BTREE;

--
-- Index pour la table `exercisemuscle`
--
ALTER TABLE `exercisemuscle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indidexerciseidbodymuscle` (`idexercise`,`idbodymuscle`) USING BTREE;

--
-- Index pour la table `exercisetype`
--
ALTER TABLE `exercisetype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `exercisetypename`
--
ALTER TABLE `exercisetypename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indexercisetypeunique` (`idexercisetype`,`idlanguage`) USING BTREE,
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indfoodunique` (`idbrand`,`code`) USING BTREE,
  ADD KEY `indbrand` (`idbrand`),
  ADD KEY `indscorenutri` (`idscorenutri`),
  ADD KEY `indscorenova` (`idscorenova`),
  ADD KEY `indscoreeco` (`idscoreeco`),
  ADD KEY `indcode` (`code`);

--
-- Index pour la table `foodcategory`
--
ALTER TABLE `foodcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indfoodcategoryunique` (`idfood`,`idcategory`) USING BTREE,
  ADD KEY `indcategory` (`idcategory`);

--
-- Index pour la table `foodlabel`
--
ALTER TABLE `foodlabel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indfoodlabelunique` (`idfood`,`idlabel`) USING BTREE,
  ADD KEY `indlabel` (`idlabel`);

--
-- Index pour la table `foodname`
--
ALTER TABLE `foodname`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indfoodunique` (`idfood`,`idlanguage`) USING BTREE,
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `foodnutritional`
--
ALTER TABLE `foodnutritional`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indfoodnutritionalunique` (`idfood`,`idnutritional`,`idweighttypebase`) USING BTREE,
  ADD KEY `indnutritional` (`idnutritional`);

--
-- Index pour la table `foodtype`
--
ALTER TABLE `foodtype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `foodtypename`
--
ALTER TABLE `foodtypename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indfoodtypeunique` (`idfoodtype`,`idlanguage`) USING BTREE,
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `foodweight`
--
ALTER TABLE `foodweight`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indfoodweightunique` (`idfood`,`idweighttype`,`weight`) USING BTREE,
  ADD KEY `indweighttype` (`idweighttype`);

--
-- Index pour la table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `mealtype`
--
ALTER TABLE `mealtype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `mealtypename`
--
ALTER TABLE `mealtypename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indmealtypeunique` (`idmealtype`,`idlanguage`) USING BTREE,
  ADD KEY `indmealtype` (`idmealtype`),
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `nutritional`
--
ALTER TABLE `nutritional`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `nutritionalname`
--
ALTER TABLE `nutritionalname`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indnutritionalunique` (`idnutritional`,`idlanguage`) USING BTREE,
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indrcodeidusercoach` (`code`,`idusercoach`) USING BTREE,
  ADD KEY `indcode` (`code`),
  ADD KEY `indidusercoach` (`idusercoach`);

--
-- Index pour la table `recipefood`
--
ALTER TABLE `recipefood`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indrecipefoodunique` (`idrecipe`,`idfood`) USING BTREE,
  ADD KEY `indrecipe` (`idrecipe`),
  ADD KEY `indfood` (`idfood`),
  ADD KEY `indrecipefood` (`idrecipe`,`idfood`);

--
-- Index pour la table `scoreeco`
--
ALTER TABLE `scoreeco`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indletterunique` (`letter`) USING BTREE;

--
-- Index pour la table `scorenova`
--
ALTER TABLE `scorenova`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indnumberunique` (`number`) USING BTREE;

--
-- Index pour la table `scorenutri`
--
ALTER TABLE `scorenutri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indletterunique` (`letter`) USING BTREE;

--
-- Index pour la table `sociallink`
--
ALTER TABLE `sociallink`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indiconfa` (`iconfa`);

--
-- Index pour la table `styapplication`
--
ALTER TABLE `styapplication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indcode` (`code`);

--
-- Index pour la table `stycoatchuser`
--
ALTER TABLE `stycoatchuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indstycoatchuserunique` (`idusercoatch`,`iduser`,`statut`) USING BTREE,
  ADD KEY `indusercoatch` (`idusercoatch`),
  ADD KEY `induser` (`iduser`);

--
-- Index pour la table `styenterpisewhitemarking`
--
ALTER TABLE `styenterpisewhitemarking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indidstyenterpriseunique` (`idstyenterprise`) USING BTREE,
  ADD KEY `indenterprise` (`idstyenterprise`);

--
-- Index pour la table `styenterprise`
--
ALTER TABLE `styenterprise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indupdate` (`id`,`timestamp`) USING BTREE,
  ADD UNIQUE KEY `indcode` (`code`) USING BTREE,
  ADD KEY `indname` (`name`) USING BTREE;

--
-- Index pour la table `styenterprisepos`
--
ALTER TABLE `styenterprisepos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indupdate` (`id`,`timestamp`) USING BTREE,
  ADD UNIQUE KEY `indenterprisepos` (`styidenterprise`,`idpos`) USING BTREE,
  ADD UNIQUE KEY `indposenterprise` (`idpos`,`styidenterprise`) USING BTREE;

--
-- Index pour la table `styfunctionality`
--
ALTER TABLE `styfunctionality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indcode` (`code`);

--
-- Index pour la table `stylanguage`
--
ALTER TABLE `stylanguage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE,
  ADD KEY `indcode` (`code`);

--
-- Index pour la table `stymodule`
--
ALTER TABLE `stymodule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indcode` (`code`);

--
-- Index pour la table `styright`
--
ALTER TABLE `styright`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indcode` (`code`);

--
-- Index pour la table `styrole`
--
ALTER TABLE `styrole`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indcode` (`code`);

--
-- Index pour la table `styroleright`
--
ALTER TABLE `styroleright`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indrole` (`idstyrole`),
  ADD KEY `indroleapp` (`idstyrole`,`idstyapplication`),
  ADD KEY `indroleappmodule` (`idstyrole`,`idstyapplication`,`idstymodule`),
  ADD KEY `indroleappmodulefunc` (`idstyrole`,`idstyapplication`,`idstymodule`,`idstyfunctionality`);

--
-- Index pour la table `stytemporarycode`
--
ALTER TABLE `stytemporarycode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `induser` (`idstyuserpazzi`),
  ADD KEY `induserapp` (`idstyuserpazzi`,`idstyapplication`);

--
-- Index pour la table `styuser`
--
ALTER TABLE `styuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indlogin` (`login`),
  ADD KEY `indenterpise` (`idstyenterprise`);

--
-- Index pour la table `styuserright`
--
ALTER TABLE `styuserright`
  ADD PRIMARY KEY (`id`),
  ADD KEY `induser` (`idstyuser`),
  ADD KEY `induserapp` (`idstyuser`,`idstyapplication`),
  ADD KEY `induserappmodule` (`idstyuser`,`idstyapplication`,`idstymodule`),
  ADD KEY `induserappmodulefunc` (`idstyuser`,`idstyapplication`,`idstymodule`,`idstyfunctionality`);

--
-- Index pour la table `styuserrole`
--
ALTER TABLE `styuserrole`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `induserrole` (`idstyuser`,`idstyrole`),
  ADD UNIQUE KEY `indroleuser` (`idstyrole`,`idstyuser`);

--
-- Index pour la table `styusersociallink`
--
ALTER TABLE `styusersociallink`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indroleuser` (`idstyuser`,`idsociallink`),
  ADD KEY `indstyuser` (`idstyuser`),
  ADD KEY `indsociallink` (`idsociallink`);

--
-- Index pour la table `styusertype`
--
ALTER TABLE `styusertype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcode` (`code`),
  ADD UNIQUE KEY `indname` (`name`);

--
-- Index pour la table `styusertypename`
--
ALTER TABLE `styusertypename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indstyusertypecode` (`idstyusertype`,`idcountry`,`idlanguage`,`code`) USING BTREE;

--
-- Index pour la table `subscriptionpackage`
--
ALTER TABLE `subscriptionpackage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `subscriptionpackagename`
--
ALTER TABLE `subscriptionpackagename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indsubscriptionpackageunique` (`idsubscriptionpackage`,`idlanguage`) USING BTREE,
  ADD KEY `indsubscriptionpackage` (`idsubscriptionpackage`),
  ADD KEY `indlanguage` (`idlanguage`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indticketunique` (`idusercreate`,`iduserassign`,`date`,`time`) USING BTREE,
  ADD KEY `indidusercreate` (`idusercreate`),
  ADD KEY `indiduserassign` (`iduserassign`);

--
-- Index pour la table `ticketadvancement`
--
ALTER TABLE `ticketadvancement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indticketunique` (`idticket`,`idticketstatus`,`date`,`time`) USING BTREE,
  ADD KEY `indidticket` (`idticket`),
  ADD KEY `indidticketstatus` (`idticketstatus`);

--
-- Index pour la table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indticketunique` (`idticket`,`iduser`,`date`,`time`) USING BTREE,
  ADD KEY `indidticket` (`idticket`),
  ADD KEY `indiduser` (`iduser`);

--
-- Index pour la table `ticketpicture`
--
ALTER TABLE `ticketpicture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indticketunique` (`idticket`,`idticketcomment`,`date`,`time`) USING BTREE,
  ADD KEY `indidticket` (`idticket`),
  ADD KEY `indidticketcomment` (`idticketcomment`);

--
-- Index pour la table `ticketstatus`
--
ALTER TABLE `ticketstatus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `ticketstatusname`
--
ALTER TABLE `ticketstatusname`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indticketstatusunique` (`idticketstatus`,`idlanguage`) USING BTREE,
  ADD KEY `indidticketstatus` (`idticketstatus`),
  ADD KEY `indidlanguage` (`idlanguage`);

--
-- Index pour la table `tickettype`
--
ALTER TABLE `tickettype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `tickettypename`
--
ALTER TABLE `tickettypename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indtickettypeunique` (`idtickettype`,`idlanguage`) USING BTREE,
  ADD KEY `indidtickettype` (`idtickettype`),
  ADD KEY `indidlanguage` (`idlanguage`);

--
-- Index pour la table `weighttype`
--
ALTER TABLE `weighttype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indcodeunique` (`code`) USING BTREE;

--
-- Index pour la table `weighttypename`
--
ALTER TABLE `weighttypename`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indweighttypenameunique` (`idweighttype`,`idlanguage`) USING BTREE,
  ADD KEY `indlanguage` (`idlanguage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bodymember`
--
ALTER TABLE `bodymember`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `bodymembername`
--
ALTER TABLE `bodymembername`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `bodymuscle`
--
ALTER TABLE `bodymuscle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `bodymusclename`
--
ALTER TABLE `bodymusclename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categoryfoodtype`
--
ALTER TABLE `categoryfoodtype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `categoryfoodtypename`
--
ALTER TABLE `categoryfoodtypename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `circuittype`
--
ALTER TABLE `circuittype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `circuittypename`
--
ALTER TABLE `circuittypename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `coachuser`
--
ALTER TABLE `coachuser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `diet`
--
ALTER TABLE `diet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `dietmeal`
--
ALTER TABLE `dietmeal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `dietstudent`
--
ALTER TABLE `dietstudent`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `diettemplate`
--
ALTER TABLE `diettemplate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `exercisemuscle`
--
ALTER TABLE `exercisemuscle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `exercisetype`
--
ALTER TABLE `exercisetype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `exercisetypename`
--
ALTER TABLE `exercisetypename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `foodcategory`
--
ALTER TABLE `foodcategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `foodlabel`
--
ALTER TABLE `foodlabel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `foodname`
--
ALTER TABLE `foodname`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `foodnutritional`
--
ALTER TABLE `foodnutritional`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `foodtype`
--
ALTER TABLE `foodtype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `foodtypename`
--
ALTER TABLE `foodtypename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `foodweight`
--
ALTER TABLE `foodweight`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `label`
--
ALTER TABLE `label`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `mealtype`
--
ALTER TABLE `mealtype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `mealtypename`
--
ALTER TABLE `mealtypename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `nutritional`
--
ALTER TABLE `nutritional`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `nutritionalname`
--
ALTER TABLE `nutritionalname`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `recipefood`
--
ALTER TABLE `recipefood`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `scoreeco`
--
ALTER TABLE `scoreeco`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `scorenova`
--
ALTER TABLE `scorenova`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `scorenutri`
--
ALTER TABLE `scorenutri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `sociallink`
--
ALTER TABLE `sociallink`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `styapplication`
--
ALTER TABLE `styapplication`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `stycoatchuser`
--
ALTER TABLE `stycoatchuser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `styenterpisewhitemarking`
--
ALTER TABLE `styenterpisewhitemarking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `styenterprise`
--
ALTER TABLE `styenterprise`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `styenterprisepos`
--
ALTER TABLE `styenterprisepos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `styfunctionality`
--
ALTER TABLE `styfunctionality`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `stylanguage`
--
ALTER TABLE `stylanguage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `stymodule`
--
ALTER TABLE `stymodule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `styright`
--
ALTER TABLE `styright`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `styrole`
--
ALTER TABLE `styrole`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `styroleright`
--
ALTER TABLE `styroleright`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `stytemporarycode`
--
ALTER TABLE `stytemporarycode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `styuser`
--
ALTER TABLE `styuser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `styuserright`
--
ALTER TABLE `styuserright`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `styuserrole`
--
ALTER TABLE `styuserrole`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `styusersociallink`
--
ALTER TABLE `styusersociallink`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `styusertype`
--
ALTER TABLE `styusertype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `styusertypename`
--
ALTER TABLE `styusertypename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `subscriptionpackage`
--
ALTER TABLE `subscriptionpackage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `subscriptionpackagename`
--
ALTER TABLE `subscriptionpackagename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ticketadvancement`
--
ALTER TABLE `ticketadvancement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ticketpicture`
--
ALTER TABLE `ticketpicture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ticketstatus`
--
ALTER TABLE `ticketstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ticketstatusname`
--
ALTER TABLE `ticketstatusname`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `tickettype`
--
ALTER TABLE `tickettype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tickettypename`
--
ALTER TABLE `tickettypename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `weighttype`
--
ALTER TABLE `weighttype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `weighttypename`
--
ALTER TABLE `weighttypename`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
