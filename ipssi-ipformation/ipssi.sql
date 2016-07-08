-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2016 at 04:19 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipssi`
--

-- --------------------------------------------------------

--
-- Table structure for table `actualite`
--

CREATE TABLE IF NOT EXISTS `actualite` (
  `id_actualite` int(11) NOT NULL AUTO_INCREMENT,
  `titre_actualite` varchar(100) NOT NULL,
  `texte_actualite` text NOT NULL,
  `date_actualite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url_photo_actualite` varchar(250) NOT NULL,
  `date_validite_actualite` datetime NOT NULL,
  PRIMARY KEY (`id_actualite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `actualite`
--

INSERT INTO `actualite` (`id_actualite`, `titre_actualite`, `texte_actualite`, `date_actualite`, `url_photo_actualite`, `date_validite_actualite`) VALUES
(1, 'Actualité 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel risus at dolor placerat pretium. Vestibulum lobortis neque eget dolor auctor, vel vestibulum nisl interdum. Aliquam risus arcu, dictum in mauris vitae, luctus elementum quam. Donec at accumsan velit. Interdum et malesuada fames ac ante ipsum primis in faucibus.', '2016-07-08 12:39:31', 'actualite1.jpg', '2016-07-08 11:00:00'),
(2, 'Actualité 2', 'Aliquam eget libero massa. Nam eget molestie velit. Pellentesque interdum quam lectus, nec molestie neque tincidunt vitae. Curabitur in interdum metus. Aliquam erat volutpat. Praesent mi magna, ullamcorper sit amet imperdiet non, consectetur quis velit.', '2016-07-08 12:55:57', 'actualite2.jpg', '2016-07-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_adresse` varchar(250) NOT NULL,
  `numero_adresse` varchar(250) NOT NULL,
  `adresse_adresse` varchar(250) NOT NULL,
  `supplement_adresse` varchar(250) DEFAULT NULL,
  `code_postal_adresse` varchar(250) NOT NULL,
  `ville_adresse` varchar(250) NOT NULL,
  `pays_adresse` varchar(250) NOT NULL,
  `telephone_adresse` varchar(250) DEFAULT NULL,
  `fax_adresse` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `libelle_adresse`, `numero_adresse`, `adresse_adresse`, `supplement_adresse`, `code_postal_adresse`, `ville_adresse`, `pays_adresse`, `telephone_adresse`, `fax_adresse`) VALUES
(1, 'IPSSI Paris', '25 ', 'rue Claude Tillier\r\n\r\n', '2ème étage', '75012 ', 'Paris', 'France', '01 55 43 26 65', '01 55 43 26 64'),
(2, 'IPSSI Lyon', '6', 'Place Charles Hernu', NULL, '69100', 'Villeurbanne', 'France', '0811 692 888', '01 55 43 26 64'),
(3, 'IPSSI Brest', '1 Bis ', 'rue Bossuet ', NULL, '29200', 'Brest', 'France', '07 81 26 13 40', '');

-- --------------------------------------------------------

--
-- Table structure for table `candidature`
--

CREATE TABLE IF NOT EXISTS `candidature` (
  `id_candidature` int(11) NOT NULL AUTO_INCREMENT,
  `id_poste_candidature` int(11) DEFAULT NULL,
  `id_sexe` int(11) NOT NULL,
  `nom_candidature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_candidature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_candidature` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cp_candidature` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ville_candidature` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `pays_candidature` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email_candidature` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_candidature` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_naissance` date NOT NULL,
  `url_cv_candidature` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_lettre_candidature` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `cle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_candidature`),
  KEY `id_poste_candidature` (`id_poste_candidature`),
  KEY `id_sexe` (`id_sexe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `candidature`
--

INSERT INTO `candidature` (`id_candidature`, `id_poste_candidature`, `id_sexe`, `nom_candidature`, `prenom_candidature`, `adresse_candidature`, `cp_candidature`, `ville_candidature`, `pays_candidature`, `email_candidature`, `telephone_candidature`, `date_naissance`, `url_cv_candidature`, `url_lettre_candidature`, `etat`, `cle`) VALUES
(1, NULL, 3, 'MOSSON', 'Romane', '16 rue des Erables', '69330', 'Pusignan', 'France', 'romane.mosson@gmail.com', '0777360290', '1993-05-07', NULL, NULL, 0, 'qJW678aziF1vqngfEZ1TUXwjSxQ8Wdg0Odm4oxU0mTY69hkborwzylm8MJop16qPo0YXSTmbC4CB38yzOPIHSFoRSRE0KTKVavgN'),
(2, 3, 3, 'MOSSON', 'Romane', '16 rue des Erables', '69330', 'Pusignan', 'France', 'romane.mosson@gmail.com', '0777360290', '1993-05-07', NULL, NULL, 0, '3buDy0s4CpuTqF7LSVCxEVAjGDMXCjK6opOxGburo870erGL5D30CVcViPYrg4qNq6OnuFILmLUlIDWHsL9HMn1t7rSlAdMXab10');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `id_contact_type` int(11) NOT NULL,
  `id_contact_demande` int(11) NOT NULL,
  `id_sexe` int(11) NOT NULL,
  `nom_contact` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_contact` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fonction_contact` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `societe_contact` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_contact` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_contact` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message_contact` text COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_contact`),
  KEY `id_type_contact` (`id_contact_type`),
  KEY `id_type_demande` (`id_contact_demande`),
  KEY `id_sexe` (`id_sexe`),
  KEY `id_contact_type` (`id_contact_type`),
  KEY `id_contact_demande` (`id_contact_demande`),
  KEY `id_sexe_2` (`id_sexe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `id_contact_type`, `id_contact_demande`, `id_sexe`, `nom_contact`, `prenom_contact`, `fonction_contact`, `societe_contact`, `email_contact`, `telephone_contact`, `message_contact`, `date_creation`) VALUES
(4, 2, 1, 3, 'MOSSON', 'Romane', NULL, '', 'romane.mosson@gmail.com', '0777360290', 'Ceci est un test', '2016-04-05 13:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `contact_demande`
--

CREATE TABLE IF NOT EXISTS `contact_demande` (
  `id_contact_demande` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_contact_demande` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_contact_demande`),
  KEY `id_contact_demande` (`id_contact_demande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contact_demande`
--

INSERT INTO `contact_demande` (`id_contact_demande`, `libelle_contact_demande`) VALUES
(1, 'Demande de renseignements généraux'),
(2, 'Demande de renseignements sur l''école'),
(3, 'Demande de renseignements sur les cours');

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE IF NOT EXISTS `contact_type` (
  `id_contact_type` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_contact_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_contact_type`),
  KEY `id_contact_type` (`id_contact_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id_contact_type`, `libelle_contact_type`) VALUES
(1, 'Professionnel'),
(2, 'Particulier');

-- --------------------------------------------------------

--
-- Table structure for table `droit`
--

CREATE TABLE IF NOT EXISTS `droit` (
  `id_droit` int(11) NOT NULL AUTO_INCREMENT,
  `code_droit` varchar(1) NOT NULL,
  `libelle_droit` varchar(100) NOT NULL,
  PRIMARY KEY (`id_droit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `droit`
--

INSERT INTO `droit` (`id_droit`, `code_droit`, `libelle_droit`) VALUES
(1, 'T', 'Tous les droits'),
(2, 'M', 'Modification et visualisation N et N-'),
(3, 'P', 'Vue et modification personnelle'),
(4, 'V', 'Visualisation N et N-');

-- --------------------------------------------------------

--
-- Table structure for table `droit_sous_menu_groupe`
--

CREATE TABLE IF NOT EXISTS `droit_sous_menu_groupe` (
  `id_droit` int(11) NOT NULL,
  `id_sous_menu` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`id_droit`,`id_sous_menu`,`id_groupe`),
  KEY `id_sous_menu` (`id_sous_menu`),
  KEY `id_groupe` (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `droit_sous_menu_groupe`
--

INSERT INTO `droit_sous_menu_groupe` (`id_droit`, `id_sous_menu`, `id_groupe`) VALUES
(1, 8, 1),
(1, 8, 2),
(1, 8, 6),
(4, 8, 3),
(4, 8, 4),
(1, 9, 1),
(1, 9, 2),
(1, 9, 4),
(2, 9, 3),
(3, 9, 5),
(1, 10, 1),
(1, 10, 2),
(1, 10, 4),
(3, 10, 3),
(3, 10, 5),
(1, 11, 1),
(1, 11, 2),
(1, 11, 4),
(2, 11, 3),
(3, 11, 5),
(1, 12, 1),
(1, 12, 2),
(1, 12, 4),
(2, 12, 3),
(1, 13, 1),
(1, 13, 2),
(1, 13, 4),
(4, 13, 3),
(1, 14, 1),
(1, 14, 2),
(1, 14, 4),
(2, 14, 3),
(1, 15, 1),
(1, 15, 2),
(1, 15, 4),
(4, 15, 3),
(1, 16, 1),
(1, 16, 2),
(2, 16, 6),
(4, 16, 3),
(1, 17, 1),
(1, 17, 2),
(2, 17, 6),
(4, 17, 3),
(1, 18, 1),
(1, 18, 2),
(1, 19, 1),
(1, 19, 2),
(1, 20, 1),
(4, 20, 2),
(1, 21, 1),
(4, 21, 2),
(1, 22, 1),
(1, 22, 2),
(1, 22, 6);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_groupe` varchar(100) NOT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `libelle_groupe`) VALUES
(1, 'Administrateur'),
(2, 'Superviseur'),
(3, 'Manager'),
(4, 'RH'),
(5, 'Collaborateur'),
(6, 'Rédacteur');

-- --------------------------------------------------------

--
-- Table structure for table `groupe_utilisateur`
--

CREATE TABLE IF NOT EXISTS `groupe_utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_groupe`),
  KEY `id_groupe` (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupe_utilisateur`
--

INSERT INTO `groupe_utilisateur` (`id_utilisateur`, `id_groupe`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_menu` varchar(100) NOT NULL,
  `url_menu` varchar(100) NOT NULL,
  `tri_menu` int(11) NOT NULL,
  `date_menu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `front` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `libelle_menu`, `url_menu`, `tri_menu`, `date_menu`, `front`) VALUES
(1, 'Accueil', '', 1, '2016-02-29 08:25:10', 1),
(2, 'Le groupe', 'le-groupe', 2, '2016-02-29 07:27:42', 1),
(3, 'L''activité', 'l-activite', 3, '2016-02-29 07:27:53', 1),
(4, 'Actualités', 'actualites', 1, '2016-07-08 08:01:04', 0),
(5, 'Ressources humaines', 'ressources-humaines', 2, '2016-07-08 08:02:11', 0),
(6, 'Boîte à outils', 'boite-a-outils', 3, '2016-07-08 08:02:11', 0),
(7, 'Paramétrage', 'parametrage', 4, '2016-07-08 08:02:49', 0),
(8, 'Administration', 'administration', 5, '2016-07-08 08:02:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `page_contenu`
--

CREATE TABLE IF NOT EXISTS `page_contenu` (
  `id_page_contenu` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL COMMENT 'clé étrangère',
  `id_sous_menu` int(11) DEFAULT NULL COMMENT 'clé étrangère',
  `date_page_contenu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre_page_contenu` varchar(100) NOT NULL,
  `texte_page_contenu` text NOT NULL,
  PRIMARY KEY (`id_page_contenu`),
  KEY `id_menu` (`id_menu`),
  KEY `id_sous_menu` (`id_sous_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `page_contenu`
--

INSERT INTO `page_contenu` (`id_page_contenu`, `id_menu`, `id_sous_menu`, `date_page_contenu`, `titre_page_contenu`, `texte_page_contenu`) VALUES
(1, 2, 1, '2016-02-29 10:03:04', 'test titre', 'test contenu');

-- --------------------------------------------------------

--
-- Table structure for table `poste_candidature`
--

CREATE TABLE IF NOT EXISTS `poste_candidature` (
  `id_poste` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_poste` int(11) NOT NULL,
  `titre_poste` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `accroche_poste` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `entreprise_poste` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_depot` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_debut_poste` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remuneration_poste` varchar(50) DEFAULT NULL,
  `niveau_experience` varchar(250) NOT NULL,
  PRIMARY KEY (`id_poste`),
  KEY `id_type_poste` (`id_type_poste`),
  KEY `id_poste` (`id_poste`),
  KEY `id_type_poste_2` (`id_type_poste`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `poste_candidature`
--

INSERT INTO `poste_candidature` (`id_poste`, `id_type_poste`, `titre_poste`, `accroche_poste`, `entreprise_poste`, `date_depot`, `description`, `date_debut_poste`, `remuneration_poste`, `niveau_experience`) VALUES
(1, 1, 'Développeur PHP', 'Développeur PHP en alternance', 'Dalkia Infracom', '2015-05-29 10:34:57', 'Recherche d''un développeur spécialisé en PHP. \r\nnécessaire : HTML, PHP, CSS, Javascript\r\nplus : Ajax, Bootstrap', '2014-10-18 20:00:00', '820', 'BAc+2 à Bac+3'),
(2, 3, 'Développeur VB.Net', 'Développeur Microsoft VisualBasic en alternance', 'Exelis', '2015-05-29 10:35:07', 'Recherche d''un développeur spécialisé en VisualBasic. \nnécessaire : VB.Net, SQL Server\nplus : SSIS', '2014-11-11 22:00:00', '920', 'BAc+2 à Bac+3'),
(3, 4, 'Administrateur Base de Données', 'Administrateur base de données sur SQL Server', '1000Mercis', '2015-05-29 10:38:47', 'Nous cherchons actuellement un alternant pour un poste d''administrateur de base de données.\r\nRequis : SQL, SQL Server\r\nplus : C#, SSIS', '2013-09-07 20:00:00', '850', 'BAc+4');

-- --------------------------------------------------------

--
-- Table structure for table `sexe`
--

CREATE TABLE IF NOT EXISTS `sexe` (
  `id_sexe` int(11) NOT NULL AUTO_INCREMENT,
  `raccourci_sexe` varchar(4) NOT NULL,
  `sexe` varchar(250) NOT NULL,
  PRIMARY KEY (`id_sexe`),
  KEY `id_sexe` (`id_sexe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sexe`
--

INSERT INTO `sexe` (`id_sexe`, `raccourci_sexe`, `sexe`) VALUES
(1, 'M.', 'Monsieur'),
(2, 'Mme', 'Madame'),
(3, 'Mlle', 'Mademoiselle');

-- --------------------------------------------------------

--
-- Table structure for table `sous_menu`
--

CREATE TABLE IF NOT EXISTS `sous_menu` (
  `id_sous_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL COMMENT 'clé étrangère',
  `libelle_sous_menu` varchar(100) NOT NULL,
  `url_sous_menu` varchar(100) NOT NULL,
  `date_sous_menu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tri_sous_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_sous_menu`),
  KEY `id_menu` (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `sous_menu`
--

INSERT INTO `sous_menu` (`id_sous_menu`, `id_menu`, `libelle_sous_menu`, `url_sous_menu`, `date_sous_menu`, `tri_sous_menu`) VALUES
(1, 2, 'Présentation', 'presentation', '2016-02-29 07:39:57', 1),
(2, 2, 'Chiffres clés', 'chiffres-cles', '2016-02-29 07:40:13', 2),
(3, 2, 'Notre expertise', 'notre-expertise', '2016-02-29 07:40:23', 3),
(4, 2, 'Les valeurs du groupe', 'les-valeurs-du-groupe', '2016-02-29 07:40:43', 4),
(5, 3, 'Nos métiers', 'nos-metiers', '2016-02-29 07:51:06', 1),
(6, 3, 'Nos secteurs d''activités', 'nos-secteurs-d-activites', '2016-02-29 07:51:29', 2),
(7, 3, 'Ils nous font confiance', 'ils-nous-font-confiance', '2016-02-29 07:51:56', 3),
(8, 4, 'Liste des actualités', 'liste-actualites', '2016-07-08 08:04:00', 1),
(9, 5, 'CRA', 'cra', '2016-07-08 08:04:19', 1),
(10, 5, 'Notes de frais', 'note-frais', '2016-07-08 08:04:33', 2),
(11, 5, 'Demande de congés', 'demande-conges', '2016-07-08 08:04:54', 3),
(12, 5, 'CVthèque', 'cvtheque', '2016-07-08 08:05:32', 4),
(13, 5, 'Offre de poste', 'offre-poste', '2016-07-08 08:05:52', 5),
(14, 5, 'Candidatures', 'candidatures', '2016-07-08 08:06:07', 6),
(15, 5, 'Collaborateurs', 'collaborateurs', '2016-07-08 08:06:21', 7),
(16, 6, 'Certifications', 'certifications', '2016-07-08 08:06:35', 1),
(17, 6, 'Documents de travail', 'documents-travail', '2016-07-08 08:06:53', 2),
(18, 7, 'RH', 'rh', '2016-07-08 08:07:02', 1),
(19, 7, 'CRM', 'crm', '2016-07-08 08:07:10', 2),
(20, 8, 'Gestion des utilisateurs', 'gestion-utilisateurs', '2016-07-08 08:07:30', 1),
(21, 8, 'Application', 'application', '2016-07-08 08:07:45', 2),
(22, 8, 'Rédaction des pages', 'redaction-pages', '2016-07-08 09:20:20', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sous_sous_menu`
--

CREATE TABLE IF NOT EXISTS `sous_sous_menu` (
  `id_sous_sous_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_sous_menu` int(11) NOT NULL COMMENT 'clé étrangère',
  `libelle_sous_sous_menu` varchar(100) NOT NULL,
  `date_sous_sous_menu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tri_sous_sous_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_sous_sous_menu`),
  KEY `id_sous_menu` (`id_sous_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sous_sous_menu`
--

INSERT INTO `sous_sous_menu` (`id_sous_sous_menu`, `id_sous_menu`, `libelle_sous_sous_menu`, `date_sous_sous_menu`, `tri_sous_sous_menu`) VALUES
(1, 3, 'Présentation des expertises', '2016-02-29 09:39:45', 1),
(2, 3, 'Assistance technique', '2016-02-29 09:41:18', 2),
(3, 3, 'Formation', '2016-02-29 09:41:30', 3),
(4, 3, 'Forfait', '2016-02-29 09:41:42', 4),
(5, 6, 'Présentation des secteurs', '2016-02-29 09:42:03', 1),
(6, 6, 'Energie', '2016-02-29 09:42:14', 2),
(7, 6, 'Défense', '2016-02-29 09:42:24', 3),
(8, 6, 'Chimie, Pétrochimie, Pharmacie', '2016-02-29 09:42:47', 4),
(9, 6, 'Industrie lourde', '2016-02-29 09:43:02', 5),
(10, 6, 'Transports', '2016-02-29 09:43:14', 6);

-- --------------------------------------------------------

--
-- Table structure for table `type_poste`
--

CREATE TABLE IF NOT EXISTS `type_poste` (
  `id_type_poste` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type_poste`),
  KEY `id_type_poste` (`id_type_poste`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `type_poste`
--

INSERT INTO `type_poste` (`id_type_poste`, `libelle`) VALUES
(1, 'CDI'),
(2, 'CDD'),
(3, 'Contrat d''alternance'),
(4, 'Contrat de professionalisation'),
(5, 'Intérim');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) NOT NULL,
  `prenom_utilisateur` varchar(50) NOT NULL,
  `mail_utilisateur` varchar(200) NOT NULL,
  `telephone_utilisateur` varchar(20) NOT NULL,
  `pseudo_utilisateur` varchar(50) NOT NULL,
  `mdp_utilisateur` varchar(150) NOT NULL,
  `entreprise_utilisateur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `telephone_utilisateur`, `pseudo_utilisateur`, `mdp_utilisateur`, `entreprise_utilisateur`) VALUES
(1, 'MOSSON', 'Romane', 'romane.mosson@gmail.com', '07.77.36.01.90', 'roro71', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'EXELIS'),
(2, 'JULIEN', 'Alexandre', 'alexandre.julien.91@gmail.com', '0676799436', 'sid', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'Dalkia');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`id_contact_type`) REFERENCES `contact_type` (`id_contact_type`),
  ADD CONSTRAINT `contact_ibfk_2` FOREIGN KEY (`id_contact_demande`) REFERENCES `contact_demande` (`id_contact_demande`),
  ADD CONSTRAINT `contact_ibfk_3` FOREIGN KEY (`id_sexe`) REFERENCES `sexe` (`id_sexe`);

--
-- Constraints for table `droit_sous_menu_groupe`
--
ALTER TABLE `droit_sous_menu_groupe`
  ADD CONSTRAINT `droit_sous_menu_groupe_ibfk_3` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`),
  ADD CONSTRAINT `droit_sous_menu_groupe_ibfk_1` FOREIGN KEY (`id_droit`) REFERENCES `droit` (`id_droit`),
  ADD CONSTRAINT `droit_sous_menu_groupe_ibfk_2` FOREIGN KEY (`id_sous_menu`) REFERENCES `sous_menu` (`id_sous_menu`);

--
-- Constraints for table `groupe_utilisateur`
--
ALTER TABLE `groupe_utilisateur`
  ADD CONSTRAINT `groupe_utilisateur_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`),
  ADD CONSTRAINT `groupe_utilisateur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Constraints for table `page_contenu`
--
ALTER TABLE `page_contenu`
  ADD CONSTRAINT `page_contenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `page_contenu_ibfk_2` FOREIGN KEY (`id_sous_menu`) REFERENCES `sous_menu` (`id_sous_menu`);

--
-- Constraints for table `poste_candidature`
--
ALTER TABLE `poste_candidature`
  ADD CONSTRAINT `poste_candidature_ibfk_1` FOREIGN KEY (`id_type_poste`) REFERENCES `type_poste` (`id_type_poste`);

--
-- Constraints for table `sous_menu`
--
ALTER TABLE `sous_menu`
  ADD CONSTRAINT `sous_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON UPDATE CASCADE;

--
-- Constraints for table `sous_sous_menu`
--
ALTER TABLE `sous_sous_menu`
  ADD CONSTRAINT `sous_sous_menu_ibfk_1` FOREIGN KEY (`id_sous_menu`) REFERENCES `sous_menu` (`id_sous_menu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
