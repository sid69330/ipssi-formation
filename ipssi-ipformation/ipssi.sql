-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 13 Septembre 2016 à 16:48
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ipssi`
--

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_actualite`
--

CREATE TABLE IF NOT EXISTS `ipssi_actualite` (
  `id_actualite` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `titre_actualite` varchar(100) NOT NULL,
  `texte_actualite` text NOT NULL,
  `date_actualite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url_photo_actualite` varchar(250) NOT NULL,
  `date_validite_actualite` datetime DEFAULT NULL,
  `actif_actualite` tinyint(1) NOT NULL,
  `front` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_actualite`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_adresse`
--

CREATE TABLE IF NOT EXISTS `ipssi_adresse` (
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
-- Contenu de la table `ipssi_adresse`
--

INSERT INTO `ipssi_adresse` (`id_adresse`, `libelle_adresse`, `numero_adresse`, `adresse_adresse`, `supplement_adresse`, `code_postal_adresse`, `ville_adresse`, `pays_adresse`, `telephone_adresse`, `fax_adresse`) VALUES
(1, 'IPSSI Paris', '25 ', 'rue Claude Tillier\r\n\r\n', '2ème étage', '75012 ', 'Paris', 'France', '01 55 43 26 65', '01 55 43 26 64'),
(2, 'IPSSI Lyon', '6', 'Place Charles Hernu', NULL, '69100', 'Villeurbanne', 'France', '0811 692 888', '01 55 43 26 64'),
(3, 'IPSSI Brest', '1 Bis ', 'rue Bossuet ', NULL, '29200', 'Brest', 'France', '07 81 26 13 40', '');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_candidature`
--

CREATE TABLE IF NOT EXISTS `ipssi_candidature` (
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
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `cle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_candidature`),
  KEY `id_poste_candidature` (`id_poste_candidature`),
  KEY `id_sexe` (`id_sexe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ipssi_candidature`
--

INSERT INTO `ipssi_candidature` (`id_candidature`, `id_poste_candidature`, `id_sexe`, `nom_candidature`, `prenom_candidature`, `adresse_candidature`, `cp_candidature`, `ville_candidature`, `pays_candidature`, `email_candidature`, `telephone_candidature`, `date_naissance`, `url_cv_candidature`, `url_lettre_candidature`, `etat`, `cle`) VALUES
(1, NULL, 3, 'MOSSON', 'Romane', '16 rue des Erables', '69330', 'Pusignan', 'France', 'romane.mosson@gmail.com', '0777360290', '1993-05-07', NULL, NULL, 1, 'qJW678aziF1vqngfEZ1TUXwjSxQ8Wdg0Odm4oxU0mTY69hkborwzylm8MJop16qPo0YXSTmbC4CB38yzOPIHSFoRSRE0KTKVavgN'),
(2, 3, 1, 'JULIEN', 'Alexandre', '16 rue des Erables', '69330', 'Pusignan', 'France', 'alexandre.julien.91@gmail.com', '0676799436', '1992-01-04', NULL, NULL, 1, '3buDy0s4CpuTqF7LSVCxEVAjGDMXCjK6opOxGburo870erGL5D30CVcViPYrg4qNq6OnuFILmLUlIDWHsL9HMn1t7rSlAdMXab10');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_conges`
--

CREATE TABLE IF NOT EXISTS `ipssi_conges` (
  `id_conges` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL COMMENT 'clé étrangère',
  `id_type_conges` int(11) NOT NULL COMMENT 'Clé étrangère',
  `id_etat` int(11) NOT NULL DEFAULT '1' COMMENT 'clé étrangère',
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nb_jour` int(11) DEFAULT NULL,
  `date_demande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_conges`),
  KEY `id_type_conges` (`id_type_conges`),
  KEY `id_etat` (`id_etat`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_contact`
--

CREATE TABLE IF NOT EXISTS `ipssi_contact` (
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
-- Contenu de la table `ipssi_contact`
--

INSERT INTO `ipssi_contact` (`id_contact`, `id_contact_type`, `id_contact_demande`, `id_sexe`, `nom_contact`, `prenom_contact`, `fonction_contact`, `societe_contact`, `email_contact`, `telephone_contact`, `message_contact`, `date_creation`) VALUES
(4, 2, 1, 3, 'MOSSON', 'Romane', NULL, '', 'romane.mosson@gmail.com', '0777360290', 'Ceci est un test', '2016-04-05 13:53:20');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_contact_demande`
--

CREATE TABLE IF NOT EXISTS `ipssi_contact_demande` (
  `id_contact_demande` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_contact_demande` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_contact_demande`),
  KEY `id_contact_demande` (`id_contact_demande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ipssi_contact_demande`
--

INSERT INTO `ipssi_contact_demande` (`id_contact_demande`, `libelle_contact_demande`) VALUES
(1, 'Demande de renseignements généraux'),
(2, 'Demande de renseignements sur l''école'),
(3, 'Demande de renseignements sur les cours');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_contact_type`
--

CREATE TABLE IF NOT EXISTS `ipssi_contact_type` (
  `id_contact_type` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_contact_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_contact_type`),
  KEY `id_contact_type` (`id_contact_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ipssi_contact_type`
--

INSERT INTO `ipssi_contact_type` (`id_contact_type`, `libelle_contact_type`) VALUES
(1, 'Professionnel'),
(2, 'Particulier');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_droit`
--

CREATE TABLE IF NOT EXISTS `ipssi_droit` (
  `id_droit` int(11) NOT NULL AUTO_INCREMENT,
  `code_droit` varchar(1) NOT NULL,
  `libelle_droit` varchar(100) NOT NULL,
  PRIMARY KEY (`id_droit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ipssi_droit`
--

INSERT INTO `ipssi_droit` (`id_droit`, `code_droit`, `libelle_droit`) VALUES
(1, 'T', 'Tous les droits'),
(2, 'M', 'Modification et visualisation N et N-'),
(3, 'P', 'Vue et modification personnelle'),
(4, 'V', 'Visualisation N et N-');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_droit_sous_menu_groupe`
--

CREATE TABLE IF NOT EXISTS `ipssi_droit_sous_menu_groupe` (
  `id_droit` int(11) DEFAULT NULL,
  `id_sous_menu` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`id_sous_menu`,`id_groupe`),
  KEY `id_sous_menu` (`id_sous_menu`),
  KEY `id_groupe` (`id_groupe`),
  KEY `id_droit` (`id_droit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_droit_sous_menu_groupe`
--

INSERT INTO `ipssi_droit_sous_menu_groupe` (`id_droit`, `id_sous_menu`, `id_groupe`) VALUES
(NULL, 8, 5),
(NULL, 9, 6),
(NULL, 10, 6),
(NULL, 11, 6),
(NULL, 12, 5),
(NULL, 12, 6),
(NULL, 13, 5),
(NULL, 13, 6),
(NULL, 14, 5),
(NULL, 14, 6),
(NULL, 15, 5),
(NULL, 15, 6),
(NULL, 16, 4),
(NULL, 16, 5),
(NULL, 17, 4),
(NULL, 17, 5),
(NULL, 18, 3),
(NULL, 18, 4),
(NULL, 18, 5),
(NULL, 18, 6),
(NULL, 19, 3),
(NULL, 19, 4),
(NULL, 19, 5),
(NULL, 19, 6),
(NULL, 20, 3),
(NULL, 20, 4),
(NULL, 20, 5),
(NULL, 20, 6),
(NULL, 21, 3),
(NULL, 21, 4),
(NULL, 21, 5),
(NULL, 21, 6),
(NULL, 22, 3),
(NULL, 22, 4),
(NULL, 22, 5),
(1, 8, 1),
(1, 8, 2),
(1, 8, 6),
(1, 9, 1),
(1, 9, 2),
(1, 9, 4),
(1, 10, 1),
(1, 10, 2),
(1, 10, 4),
(1, 11, 1),
(1, 11, 2),
(1, 11, 4),
(1, 12, 1),
(1, 12, 2),
(1, 12, 4),
(1, 13, 1),
(1, 13, 2),
(1, 13, 4),
(1, 14, 1),
(1, 14, 2),
(1, 14, 4),
(1, 15, 1),
(1, 15, 2),
(1, 15, 4),
(1, 16, 1),
(1, 16, 2),
(1, 17, 1),
(1, 17, 2),
(1, 18, 1),
(1, 18, 2),
(1, 19, 1),
(1, 19, 2),
(1, 20, 1),
(1, 21, 1),
(1, 22, 1),
(1, 22, 2),
(1, 22, 6),
(2, 9, 3),
(2, 11, 3),
(2, 12, 3),
(2, 14, 3),
(2, 16, 6),
(2, 17, 6),
(3, 9, 5),
(3, 10, 3),
(3, 10, 5),
(3, 11, 5),
(4, 8, 3),
(4, 8, 4),
(4, 13, 3),
(4, 15, 3),
(4, 16, 3),
(4, 17, 3),
(4, 20, 2),
(4, 21, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_etat`
--

CREATE TABLE IF NOT EXISTS `ipssi_etat` (
  `id_etat` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_etat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_etat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ipssi_etat`
--

INSERT INTO `ipssi_etat` (`id_etat`, `libelle_etat`) VALUES
(1, 'En attente'),
(2, 'Validé'),
(3, 'Refusé');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_groupe`
--

CREATE TABLE IF NOT EXISTS `ipssi_groupe` (
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_groupe` varchar(100) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `ipssi_groupe`
--

INSERT INTO `ipssi_groupe` (`id_groupe`, `libelle_groupe`, `ordre`) VALUES
(1, 'Administrateur', 6),
(2, 'Superviseur', 5),
(3, 'Manager', 4),
(4, 'RH', 3),
(5, 'Collaborateur', 2),
(6, 'Rédacteur', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_groupe_utilisateur`
--

CREATE TABLE IF NOT EXISTS `ipssi_groupe_utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_groupe`),
  KEY `id_groupe` (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ipssi_groupe_utilisateur`
--

INSERT INTO `ipssi_groupe_utilisateur` (`id_utilisateur`, `id_groupe`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_menu`
--

CREATE TABLE IF NOT EXISTS `ipssi_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_menu` varchar(100) NOT NULL,
  `url_menu` varchar(100) NOT NULL,
  `tri_menu` int(11) NOT NULL,
  `date_menu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `front` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `ipssi_menu`
--

INSERT INTO `ipssi_menu` (`id_menu`, `libelle_menu`, `url_menu`, `tri_menu`, `date_menu`, `front`) VALUES
(1, 'Accueil', 'accueil', 1, '2016-02-29 08:25:10', 1),
(2, 'Le groupe', 'le-groupe', 2, '2016-02-29 07:27:42', 1),
(3, 'L''activité', 'l-activite', 3, '2016-02-29 07:27:53', 1),
(4, 'Actualités', 'actualites', 1, '2016-07-08 08:01:04', 0),
(5, 'Ressources humaines', 'ressources-humaines', 2, '2016-07-08 08:02:11', 0),
(6, 'Boîte à outils', 'boite-a-outils', 3, '2016-07-08 08:02:11', 0),
(7, 'Paramétrage', 'parametrage', 4, '2016-07-08 08:02:49', 0),
(8, 'Administration', 'administration', 5, '2016-07-08 08:02:49', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_notes_frais`
--

CREATE TABLE IF NOT EXISTS `ipssi_notes_frais` (
  `id_note_frais` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL COMMENT 'clé étrangère',
  `id_type_note_frais` int(11) NOT NULL COMMENT 'clé étrangère',
  `id_etat` int(11) NOT NULL DEFAULT '1' COMMENT 'clé étrangère',
  `id_type_paiement_note_frais` int(11) DEFAULT NULL COMMENT 'clé étrangère',
  `date_note_frais` datetime NOT NULL,
  `description_note_frais` text NOT NULL,
  `montant_note_frais` float NOT NULL,
  `trajet_note_frais` varchar(250) DEFAULT NULL,
  `km_parcouru_note_frais` float DEFAULT NULL,
  `montant_km_note_frais` float DEFAULT NULL,
  `date_creation_note_frais` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_paiement_note_frais` datetime DEFAULT NULL,
  `motif_refus` text,
  PRIMARY KEY (`id_note_frais`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_type_note_frais` (`id_type_note_frais`),
  KEY `id_etat` (`id_etat`),
  KEY `id_utilisateur_2` (`id_utilisateur`),
  KEY `id_type_note_frais_2` (`id_type_note_frais`),
  KEY `id_etat_2` (`id_etat`),
  KEY `id_type_paiement_note_frais` (`id_type_paiement_note_frais`),
  KEY `id_type_paiement_note_frais_2` (`id_type_paiement_note_frais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ipssi_notes_frais`
--

INSERT INTO `ipssi_notes_frais` (`id_note_frais`, `id_utilisateur`, `id_type_note_frais`, `id_etat`, `id_type_paiement_note_frais`, `date_note_frais`, `description_note_frais`, `montant_note_frais`, `trajet_note_frais`, `km_parcouru_note_frais`, `montant_km_note_frais`, `date_creation_note_frais`, `date_paiement_note_frais`, `motif_refus`) VALUES
(1, 1, 2, 1, NULL, '2016-08-19 00:00:00', 'Ceci est ma premiere note de frais', 49.52, NULL, NULL, NULL, '2016-08-25 10:08:47', NULL, NULL),
(2, 2, 4, 1, NULL, '2016-09-05 00:00:00', 'Déplacement chez le client', 25, 'Lyon -> Mâcon (aller-retour)', 0, NULL, '2016-09-13 14:19:39', NULL, NULL),
(3, 2, 3, 1, NULL, '2016-09-05 00:00:00', 'Déplacement chez le client', 25, 'Lyon -> Mâcon (aller-retour)', 250, NULL, '2016-09-13 14:20:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_page_contenu`
--

CREATE TABLE IF NOT EXISTS `ipssi_page_contenu` (
  `id_page_contenu` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL COMMENT 'clé étrangère',
  `id_sous_menu` int(11) DEFAULT NULL COMMENT 'clé étrangère',
  `date_page_contenu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre_page_contenu` varchar(100) NOT NULL,
  `texte_page_contenu` text NOT NULL,
  PRIMARY KEY (`id_page_contenu`),
  KEY `id_menu` (`id_menu`),
  KEY `id_sous_menu` (`id_sous_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ipssi_page_contenu`
--

INSERT INTO `ipssi_page_contenu` (`id_page_contenu`, `id_menu`, `id_sous_menu`, `date_page_contenu`, `titre_page_contenu`, `texte_page_contenu`) VALUES
(2, 1, 2, '2016-09-13 10:15:51', '', '<h1 style="text-align: center;"><strong><img src="http://www.ecole-ipssi.com/images/panoramique/pano3.jpg" alt="" width="1024" height="260" /></strong></h1>\r\n<h1 style="text-align: center;">&nbsp;</h1>\r\n<h1 style="text-align: center;">&nbsp;</h1>\r\n<h1 style="text-align: center;"><strong>Bonjour,&nbsp;</strong></h1>\r\n<p>&nbsp;</p>\r\n<p><em>Voici les chiffres cl&eacute;s</em></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>'),
(4, 3, 7, '2016-09-13 10:18:13', '', '<div class="titrePage center">Les partenaires IPSSI</div>\r\n<p class="titrePage"><img src="http://www.ecole-ipssi.com/images/log_etudiant.jpg" alt="" width="230" height="73" /></p>\r\n<p>Log''Etudiant : le site de logement &eacute;tudiant 100% ind&eacute;pendant et gratuit : <a href="www.log-etudiant.com" target="_blank">www.log-etudiant.com</a></p>\r\n<p class="titrePage">Microsoft IT-Academy</p>\r\n<p>Le partenariat avec Microsoft nous permet de fournir &agrave; nos &eacute;tudiants un acc&egrave;s &agrave; la logith&egrave;que Microsoft. Celui-ci donne la possibilit&eacute; d''obtenir gratuitement tous les outils n&eacute;cessaires &agrave; la formation et &agrave; la veille technologique personnelle, comme Windows 7, Windows 8, Windows Server 2012, SQL Server, Exchange Server, Forefront, Project, Visio, ... Cet accord apporte &eacute;galement &agrave; nos &eacute;tudiants des tarifs pr&eacute;f&eacute;rentiels pour le passage de certifications et l''obtention de supports de cours officiels.</p>\r\n<p class="titrePage">Centre PROMETRIC</p>\r\n<p>ipssi poss&egrave;de une salle de test PROMETRIC, permettant &agrave; nos &eacute;tudiants le passage de certifications d''&eacute;diteurs (comme les certifications Microsoft). Ce centre reste ouvert &agrave; nos anciens apprenants, qui souhaiteraient mettre &agrave; jour leurs comp&eacute;tences et les valider par de nouvelles certifications. D&eacute;couvrez ici tous les avantages qu''ipssi vous octroie gr&acirc;ce aux partenariats et &agrave; la confiance de ces partenaires.</p>\r\n<p>&nbsp;</p>\r\n<p><img src="http://www.ecole-ipssi.com/images/entreprise/eurosport.jpg" alt="" width="400" height="59" /><img src="http://www.ecole-ipssi.com/images/entreprise/fnac.png" alt="" width="51" height="51" />&nbsp;<img src="http://www.ecole-ipssi.com/images/entreprise/alphamedia2.png" alt="" width="300" height="65" /></p>\r\n<p><img src="http://www.ecole-ipssi.com/images/entreprise/becpg_a.png" alt="" width="200" height="48" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="http://www.ecole-ipssi.com/images/entreprise/econocom.jpg" alt="" width="422" height="68" />&nbsp; &nbsp;&nbsp;<img src="http://www.ecole-ipssi.com/images/entreprise/edael_c.png" alt="" width="234" height="74" /></p>'),
(5, 3, 5, '2016-09-13 10:18:44', '', '<h1 style="text-align: center;">L''&Eacute;COLE IPSSI DU GROUPE IP-FORMATION, SP&Eacute;CIALISTE DE LA FORMATION INFORMATIQUE EN ALTERNANCE&nbsp;!</h1>\r\n<p>&nbsp;</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://www.ecole-ipssi.com/images/menu/bacplusquatre.jpg" width="701" height="261" /></p>\r\n<p>Depuis 1998, ip-formation est une &eacute;cole informatique reconnue pour la qualit&eacute; de ses formations informatiques en alternance (1 formation gratuite + 1 emploi r&eacute;mun&eacute;r&eacute;).</p>\r\n<p>Notre &eacute;cole s''adresse aux passionn&eacute;s d''informatique d&eacute;sireux de poursuivre leurs &eacute;tudes tout en d&eacute;marrant une carri&egrave;re de <strong>Chef de Projet</strong> en&nbsp;administration syst&egrave;mes et r&eacute;seaux, en d&eacute;veloppement ou de Directeur Artistique web.</p>\r\n<p id="lastp">Les fili&egrave;res informatiques d''ip-formation pr&eacute;parent au dipl&ocirc;me du BTS SIO (Services Informatiques aux Organisations), ASI : titre RNCP de niveau 2 et ESI : titre RNCP de niveau 1. Ainsi qu''aux certifications techniques d''&eacute;diteurs (Microsoft, Zend PHP, ...).</p>\r\n<p>&nbsp;</p>\r\n<p>une phase de pr&eacute;-recrutement est assur&eacute;e par l''&eacute;cole ipssi du groupe ip-formation afin d''optimiser votre recherche de collaborateur.</p>\r\n<p>Quelques-uns de nos crit&egrave;res de recrutement :</p>\r\n<ul>\r\n<li>Passion pour l''informatique et les nouvelles technologies</li>\r\n<li>Ambition professionnelle</li>\r\n<li>Niveau technique avanc&eacute;</li>\r\n<li>Disponibilit&eacute;</li>\r\n<li>...</li>\r\n</ul>\r\n<h1 style="text-align: center;">PR&Eacute;SENTATION DES LOCAUX DE L''&Eacute;COLE IPSSI</h1>\r\n<p><img id="imgsalles" src="http://www.ecole-ipssi.com/images/salles/salles.jpg" alt="" /></p>\r\n<h3>Des locaux adapt&eacute;s et facilement accessibles</h3>\r\n<p>Les locaux de l''&eacute;cole ipssi &agrave; Paris sont situ&eacute;s &agrave; 5 minutes &agrave; pied de la Place de la Nation et &agrave; 150 m&egrave;tres du m&eacute;tro Reuilly-Diderot (lignes 1 et 8).</p>\r\n<p>Les locaux de l''&eacute;cole ipssi &agrave; Lyon sont siut&eacute;s au pied du m&eacute;tro Charpennes (lignes A et B, tramway T1).</p>\r\n<p>Nos salles de formation sont spacieuses, lumineuses, avec un espace de repos d&eacute;di&eacute; aux stagiaires avec distributeurs de boissons et pourvues des &eacute;quipements p&eacute;dagogiques n&eacute;cessaires : une station de travail par &eacute;tudiant, vid&eacute;oprojecteur, serveurs, h&eacute;bergement pour projets,...</p>\r\n<p>L''&eacute;cole ipssi met tout en oeuvre pour accueillir ses &eacute;tudiants dans des conditions d''apprentissage optimales.</p>\r\n<h3>Equipements des salles</h3>\r\n<p>Nous disposons de <strong>8 salles</strong> enti&egrave;rement &eacute;quip&eacute;es :</p>\r\n<ul>\r\n<li>Intel Core i7</li>\r\n<li>8 Go RAM</li>\r\n<li>Disques durs en RAID-0</li>\r\n<li>Ecran plat de 19" wide</li>\r\n<li>Vid&eacute;oprojecteur</li>\r\n</ul>'),
(6, 2, 1, '2016-09-13 10:19:09', '', '<h1 style="text-align: center;">IPSSI, L''&Eacute;COLE D&rsquo;ING&Eacute;NIERIE INFORMATIQUE ET DESIGN GRAPHIQUE</h1>\r\n<div id="gmapcontact">&nbsp;</div>\r\n<p><strong>L''&eacute;cole IPSSI, du groupe IP-Formation est un &eacute;tablissement sp&eacute;cialis&eacute; dans le domaine de l&rsquo;ing&eacute;nierie informatique et d&eacute;livre des dipl&ocirc;mes ou Titres inscrits au RNCP du BTS SIO au BAC +5. Nos cursus se font dans le cadre de l''alternance ou de l''initial.</strong></p>\r\n<p>&nbsp;</p>\r\n<h3 class="titredescription">Des locaux &agrave; la pointe de la technologie au sein de nos 4 campus</h3>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://www.ecole-ipssi.com/images/panoramique/pano3.jpg" alt="" width="910" height="231" /></p>\r\n<p>&nbsp;</p>\r\n<p class="evenementintro">Le campus de <strong>Paris</strong> forme plus de 500 informaticiens chaque ann&eacute;e du BTS SIO au BAC +5. En Septembre 2015, la Web Digital School a ouvert ses portes &agrave; <strong>Brest</strong>.</p>\r\n<p class="evenementintro">&nbsp;</p>\r\n<h3 class="titredescription">Entrez dans l''&egrave;re num&eacute;rique &agrave; travers nos salles multi-connect&eacute;es!</h3>\r\n<h3 class="titredescription"><img style="display: block; margin-left: auto; margin-right: auto;" src="http://www.ecole-ipssi.com/images/panoramique/pano4.jpg" alt="" width="908" height="196" /></h3>\r\n<p>&nbsp;Nos &eacute;quipements vous permettent d''acc&eacute;dez aux nouveaux m&eacute;tiers digitaux : chef de projet sp&eacute;cialis&eacute;, administrateur r&eacute;seaux, d&eacute;veloppeur web, IT Manager, responsable marketing digital&hellip; Les d&eacute;bouch&eacute;s sont nombreux ! L''informatique et le num&eacute;rique demeurent des secteurs o&ugrave; l''employabilit&eacute; est l''une des plus fortes.&nbsp;</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td><img src="http://www.ecole-ipssi.com/images/photos_jobdating/vignette/img-1.jpg" alt="photos du job dating" /></td>\r\n<td>\r\n<h3>Votre objectif professionnel est au coeur de nos pr&eacute;occupations !</h3>\r\n<p>&nbsp;</p>\r\n<p>Votre formation &agrave; ipssi vous permettra d&rsquo;acqu&eacute;rir de v&eacute;ritables comp&eacute;tences techniques, &ecirc;tre op&eacute;rationnel et employable rapidement ! Nos programmes de formation s''adaptent aux &eacute;volutions technologiques et aux tendances m&eacute;tiers. Cela vous assure un positionnement coh&eacute;rent face aux entreprises.</p>\r\n<p>&nbsp;</p>\r\n<h3 class="titredescription">&nbsp;</h3>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3 class="evenementintro">&nbsp;L&rsquo;alternance</h3>\r\n<p class="evenementintro">IPSSI vous propose un accompagnement personnalis&eacute;, vers l''emploi en alternance, et vous aide dans vos recherches d&rsquo;entreprises d&rsquo;accueil. Une fois admis au sein d''IPSSI, nos conseillers de formation vous assurent une mise en relation avec nos entreprises partenaires. En moyenne, un candidat est plac&eacute; en entreprise sous 15 jours. Vous serez coach&eacute;s par nos collaborateurs afin d''optimiser votre candidature. 90% de nos &eacute;tudiants poursuivent leur carri&egrave;re dans leur entreprise d''accueil en CDD ou CDI. Votre &eacute;cole devient v&eacute;ritablement votre "career launcher" !&nbsp;</p>\r\n<h1 style="text-align: center;">IPSSI DEVIENT L''&Eacute;COLE LEADER DE L''ACTIVE LEARNING !</h1>\r\n<p>&nbsp;</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://www.ecole-ipssi.com/images/panoramique/pano1.jpg" alt="" width="900" height="327" /></p>\r\n<table style="width: 1101px;">\r\n<tbody>\r\n<tr>\r\n<td style="width: 225px;"><img class="imageecole floatleft" style="display: block; margin-left: auto; margin-right: auto;" src="http://www.ecole-ipssi.com/images/prometean200X300.jpg" alt="&eacute;cran g&eacute;ant tactile" /></td>\r\n<td style="width: 227px;"><img class="imageecole floatleft" style="display: block; margin-left: auto; margin-right: auto;" src="http://www.ecole-ipssi.com/images/chaise200X300.jpg" alt="&eacute;cran g&eacute;ant tactile" /></td>\r\n<td style="width: 633px;">\r\n<h3>Des &eacute;crans g&eacute;ants tactiles&nbsp;</h3>\r\n<p class="evenementintro">Nos r&eacute;cents investissements en mat&eacute;riels p&eacute;dagogiques dernier cri ont permis d&rsquo;&eacute;quiper l&rsquo;&eacute;cole avec des &eacute;crans g&eacute;ants tactiles <strong>Promothean</strong> (mesurant 2 m&egrave;tres de diagonale) qui permettent des <strong>interactions fluides</strong>, simples et naturelles gr&acirc;ce &agrave; la <strong>surface tactile multi-utilisateur</strong>. Ces &eacute;crans sont dot&eacute;s d&rsquo;une r<strong>&eacute;solution 4K exceptionnelle</strong>, et mont&eacute;s sur un pied motoris&eacute; permettant une mobilit&eacute; totale dans les salles de cours.</p>\r\n<h3 class="titredescription">Une mobilit&eacute; accrue</h3>\r\n<p class="evenementintro">Les salles sont d&eacute;sormais &eacute;quip&eacute;es de <strong>si&egrave;ges design mobiles Steel Case</strong> qui facilitent les <strong>d&eacute;placements</strong> lors des travaux de groupes et permettent aux &eacute;tudiants de porter leur regard sur l&rsquo;ensemble de la salle. La tablette, pivotant avec le si&egrave;ge, fait en sorte que les livres, ordinateurs portables et autres outils de travail restent <strong>toujours &agrave; port&eacute;e de main.</strong></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3>&nbsp;Un enseignement dynamique</h3>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td><img src="http://www.ecole-ipssi.com/images/photos-locaux/vignettes/img_ip_07.jpg" alt="photos &eacute;cole ipssi" /></td>\r\n<td>\r\n<p class="evenementintro">Les &eacute;tudiants de l&rsquo;&eacute;cole IPSSI peuvent profiter du <strong>WiFi tr&egrave;s haut d&eacute;bit,</strong> ou encore d&rsquo;une <strong>plate-forme vid&eacute;o de cours en ligne</strong> qui leur permet d''acc&eacute;der &agrave; des m&eacute;thodes d''enseignement <strong>dynamique, collaboratives et participatives</strong> facilitant grandement <strong>l''apprentissage.</strong> Ces outils p&eacute;dagogiques d''un nouveau genre, augmentent l''efficience de nos &eacute;tudiants en mati&egrave;re d''assimilation de contenu.</p>\r\n<h3 class="titredescription">Des connaissances techniques</h3>\r\n<p class="evenementintro">Nos &eacute;tudiants <strong>gagnent en efficacit&eacute;</strong> en se concentrant sur l''essentiel : s''approprier et assimiler de mani&egrave;re durable les m&eacute;thodologies de travail en &eacute;quipe, utilis&eacute;es en milieu professionnel. Les connaissances techniques sont acquises rapidement gr&acirc;ce &agrave; l''interaction entre notre corps enseignant et nos &eacute;tudiants.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p class="evenementintro">&nbsp;</p>\r\n<h4 class="titredescription">&nbsp;</h4>'),
(7, 2, 3, '2016-09-13 10:19:42', '', '<h1 style="text-align: center;">POURQUOI CHOISIR IPSSI ?</h1>\r\n<h4>Le savoir-faire ipssi</h4>\r\n<ul>\r\n<li>ipssi s''efforce d''assurer une pr&eacute;selection rigoureuse des candidats &agrave; travers :\r\n<ul>\r\n<li>des tests informatiques sp&eacute;cifiques &agrave; chaque fili&egrave;re</li>\r\n<li>des tests psychotechniques</li>\r\n<li>3 entretiens de motivation avec nos : responsable recrutement, relation entreprise et p&eacute;dagogique.</li>\r\n</ul>\r\n</li>\r\n<li>N&eacute;e en 1998, ipssi vous fait b&eacute;n&eacute;ficier aujourd''hui de plus de 15 ans d''exp&eacute;rience dans la formation informatique.</li>\r\n<li>L&rsquo;implication de l''&eacute;quipe p&eacute;dagogique</li>\r\n<li>Les comp&eacute;tences techniques des formateurs (qui sont tous certifi&eacute;s et exp&eacute;riment&eacute;s).</li>\r\n<li>La qualit&eacute; des cours dispens&eacute;s.</li>\r\n<li>La qualit&eacute; des &eacute;quipements des salles de formation.</li>\r\n<li>Le seul organisme de formation en France &agrave; pr&eacute;parer les certifications Zend PHP et MySQL Developer en alternance</li>\r\n<li>ipssi se diff&eacute;rencie par un souci de qualit&eacute; et des m&eacute;thodes de travail exigeantes.</li>\r\n</ul>\r\n<h4>Notre accompagnement est votre valeur ajout&eacute;e&nbsp;</h4>\r\n<ul>\r\n<li>Depuis la pr&eacute;selection des candidats jusqu&rsquo;&agrave; leur pr&eacute;sentation en entreprise mais &eacute;galement pendant toute la dur&eacute;e de leur contrat de professionnalisation (r&eacute;solutions de litiges, rupture&hellip;).</li>\r\n<li>Pendant la formation, gr&acirc;ce &agrave; un encadrement et un suivi p&eacute;dagogique rigoureux de votre salari&eacute;.</li>\r\n<li>Suivi en ligne via l''extranet d''ipssi de l''avanc&eacute;e de l''apprentissage de votre apprenant.</li>\r\n</ul>\r\n<h4>Des partenaires de r&eacute;f&eacute;rence</h4>\r\n<ul>\r\n<li>Pearson VUE</li>\r\n<li>Prometric</li>\r\n<li>MySQL</li>\r\n<li>Microsoft, ipssi &eacute;tant agr&eacute;&eacute;e IT ACADEMY, votre &eacute;tudiant a acc&egrave;s :\r\n<ul>\r\n<li>&agrave; des prix pr&eacute;f&eacute;rentiel aux examens MCP</li>\r\n<li>&agrave; un acc&egrave;s aux supports de cours officiels MOC</li>\r\n<li>&agrave; l&rsquo;acquisition gratuite d&rsquo;une offre logicielle MICROSOFT compl&egrave;te : (Windows 7/8, Server 2012, ...) et logiciels d&rsquo;infrastructure r&eacute;seau, Exchange, ForeFront, SQL Server...</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<h4>13 sessions de formation par an</h4>\r\n<ul>\r\n<li>L''oportunit&eacute; pour vous, employeur, d''embaucher en fonction des fluxuations de votre activit&eacute;.</li>\r\n</ul>\r\n<h4>Un suivi pr&eacute;cis et au jour le jour</h4>\r\n<ul>\r\n<li>Gr&acirc;ce &agrave; un acc&egrave;s d&eacute;di&eacute;, chaque entreprise peut suivre le suivi des cours de son apprenant au jour le jour et b&eacute;n&eacute;ficier d''un tableau de bord permettant la gestion quotidienne de son jeune salari&eacute; : retard, absence, &eacute;valuation, planning de formation , dates d''examen, ...&nbsp;</li>\r\n</ul>\r\n<h1 id="formations" style="text-align: center;">FORMATIONS</h1>\r\n<h4>La fonction tutoriale</h4>\r\n<p>La d&eacute;finition du tutorat permet de mettre en &eacute;vidence la fonction cl&eacute; du tuteur dans l''articulation entre l''entreprise et l''organisme de formation.</p>\r\n<p>Il doit favoriser la compl&eacute;mentarit&eacute; entre le syst&egrave;me formatif et l''appareil productif en d&eacute;veloppant des situations formatives sur le lieu de travail.</p>\r\n<p>La fonction tutorale rev&ecirc;t donc un caract&egrave;re dynamique et p&eacute;dagogique pour transf&eacute;rer des &eacute;l&eacute;ments de savoir en situation professionnelle.</p>\r\n<p>Les missions du tuteur sont :</p>\r\n<ul>\r\n<li><strong>Transmettre un m&eacute;tier</strong> par l''acquisition de comp&eacute;tences professionnelles.</li>\r\n<li>Faciliter <strong>l''int&eacute;gration dans le milieu professionnel</strong></li>\r\n</ul>\r\n<h4>La formation tuteur</h4>\r\n<p>Afin de faciliter l''int&eacute;gration de ses apprenants, ipssi propose aux tuteurs une formation de deux jours qui leur permettra d''acqu&eacute;rir les bases de la fonction tutorale. Cette formation s''articule sur les points suivants :</p>\r\n<ul>\r\n<li>L''accueil et l''accompagnement de l''apprenant</li>\r\n<li>Organisation de la progression dans l''apprentissage</li>\r\n<li>Formation sur le poste de travail</li>\r\n<li>Appr&eacute;ciation des progr&egrave;s et &eacute;valuation des acquis</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_poste_candidature`
--

CREATE TABLE IF NOT EXISTS `ipssi_poste_candidature` (
  `id_poste` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_poste` int(11) NOT NULL,
  `titre_poste` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `accroche_poste` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `entreprise_poste` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_depot` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_debut_poste` timestamp NOT NULL,
  `remuneration_poste` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `niveau_experience` varchar(250) CHARACTER SET latin1 NOT NULL,
  `supprime` bigint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_poste`),
  KEY `id_type_poste` (`id_type_poste`),
  KEY `id_poste` (`id_poste`),
  KEY `id_type_poste_2` (`id_type_poste`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ipssi_poste_candidature`
--

INSERT INTO `ipssi_poste_candidature` (`id_poste`, `id_type_poste`, `titre_poste`, `accroche_poste`, `entreprise_poste`, `date_depot`, `description`, `date_debut_poste`, `remuneration_poste`, `niveau_experience`, `supprime`) VALUES
(1, 1, 'Développeur PHP', 'Développeur PHP en alternance', 'Dalkia Infracom', '2015-05-29 10:34:57', 'Recherche d''un développeur spécialisé en PHP. \r\nnécessaire : HTML, PHP, CSS, Javascript\r\nplus : Ajax, Bootstrap', '0000-00-00 00:00:00', '32 000', 'BAc+2 à Bac+3', 1),
(2, 3, 'Développeur VB.Net', 'Développeur Microsoft VisualBasic en alternance', 'Exelis', '2015-05-29 10:35:07', 'Recherche d''un développeur spécialisé en VisualBasic. \nnécessaire : VB.Net, SQL Server\nplus : SSIS', '2014-11-11 22:00:00', '920', 'BAc+2 à Bac+3', 0),
(3, 4, 'Administrateur Base de Données', 'Administrateur base de données sur SQL Server', '1000Mercis', '2015-05-29 10:38:47', 'Nous cherchons actuellement un alternant pour un poste d''administrateur de base de données.\r\nRequis : SQL, SQL Server\r\nplus : C#, SSIS', '2015-11-29 23:00:00', '1000', 'BAc+4', 0),
(4, 1, 'support niveau 2', 'Support niveau 2', 'UTI Group', '2016-09-13 13:31:50', 'Support niveau 2\r\nGestion bug BDD', '0000-00-00 00:00:00', '29 000', 'Bac +3', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_sexe`
--

CREATE TABLE IF NOT EXISTS `ipssi_sexe` (
  `id_sexe` int(11) NOT NULL AUTO_INCREMENT,
  `raccourci_sexe` varchar(4) NOT NULL,
  `sexe` varchar(250) NOT NULL,
  PRIMARY KEY (`id_sexe`),
  KEY `id_sexe` (`id_sexe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ipssi_sexe`
--

INSERT INTO `ipssi_sexe` (`id_sexe`, `raccourci_sexe`, `sexe`) VALUES
(1, 'M.', 'Monsieur'),
(2, 'Mme', 'Madame'),
(3, 'Mlle', 'Mademoiselle');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_sous_menu`
--

CREATE TABLE IF NOT EXISTS `ipssi_sous_menu` (
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
-- Contenu de la table `ipssi_sous_menu`
--

INSERT INTO `ipssi_sous_menu` (`id_sous_menu`, `id_menu`, `libelle_sous_menu`, `url_sous_menu`, `date_sous_menu`, `tri_sous_menu`) VALUES
(1, 2, 'Présentation', 'presentation', '2016-02-29 07:39:57', 1),
(2, 2, 'Chiffres clés', 'chiffres-cles', '2016-02-29 07:40:13', 2),
(3, 2, 'Notre expertise', 'notre-expertise', '2016-02-29 07:40:23', 3),
(4, 2, 'Les valeurs du groupe', 'les-valeurs-du-groupe', '2016-02-29 07:40:43', 4),
(5, 3, 'Nos métiers', 'nos-metiers', '2016-02-29 07:51:06', 1),
(6, 3, 'Nos secteurs d''activités', 'nos-secteurs-d-activites', '2016-02-29 07:51:29', 2),
(7, 3, 'Ils nous font confiance', 'ils-nous-font-confiance', '2016-02-29 07:51:56', 3),
(8, 4, 'Liste des actualités', 'gestion-actualites', '2016-07-08 08:04:00', 1),
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
(20, 8, 'Gestion des droits', 'gestion-des-droits', '2016-07-08 08:07:30', 1),
(21, 8, 'Application', 'application', '2016-07-08 08:07:45', 2),
(22, 8, 'Rédaction des pages', 'redaction-pages', '2016-07-08 09:20:20', 3);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_sous_sous_menu`
--

CREATE TABLE IF NOT EXISTS `ipssi_sous_sous_menu` (
  `id_sous_sous_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_sous_menu` int(11) NOT NULL COMMENT 'clé étrangère',
  `libelle_sous_sous_menu` varchar(100) NOT NULL,
  `ancrage` varchar(100) NOT NULL,
  `date_sous_sous_menu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tri_sous_sous_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_sous_sous_menu`),
  KEY `id_sous_menu` (`id_sous_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `ipssi_sous_sous_menu`
--

INSERT INTO `ipssi_sous_sous_menu` (`id_sous_sous_menu`, `id_sous_menu`, `libelle_sous_sous_menu`, `ancrage`, `date_sous_sous_menu`, `tri_sous_sous_menu`) VALUES
(1, 3, 'Présentation des expertises', '', '2016-02-29 09:39:45', 1),
(2, 3, 'Assistance technique', '', '2016-02-29 09:41:18', 2),
(3, 3, 'Formation', 'formations', '2016-02-29 09:41:30', 3),
(4, 3, 'Forfait', '', '2016-02-29 09:41:42', 4),
(5, 6, 'Présentation des secteurs', '', '2016-02-29 09:42:03', 1),
(6, 6, 'Energie', '', '2016-02-29 09:42:14', 2),
(7, 6, 'Défense', '', '2016-02-29 09:42:24', 3),
(8, 6, 'Chimie, Pétrochimie, Pharmacie', '', '2016-02-29 09:42:47', 4),
(9, 6, 'Industrie lourde', '', '2016-02-29 09:43:02', 5),
(10, 6, 'Transports', '', '2016-02-29 09:43:14', 6);

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_type_conges`
--

CREATE TABLE IF NOT EXISTS `ipssi_type_conges` (
  `id_type_conges` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) NOT NULL,
  PRIMARY KEY (`id_type_conges`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `ipssi_type_conges`
--

INSERT INTO `ipssi_type_conges` (`id_type_conges`, `libelle`) VALUES
(1, 'Congé Payé'),
(2, 'Congé Maternité'),
(3, 'Congé Paternité'),
(4, 'RTT'),
(5, 'Congé sans solde'),
(6, 'Congé exceptionnel');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_type_notes_frais`
--

CREATE TABLE IF NOT EXISTS `ipssi_type_notes_frais` (
  `id_type_note_frais` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type_note_frais` varchar(100) NOT NULL,
  PRIMARY KEY (`id_type_note_frais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `ipssi_type_notes_frais`
--

INSERT INTO `ipssi_type_notes_frais` (`id_type_note_frais`, `libelle_type_note_frais`) VALUES
(1, 'Train'),
(2, 'Avion'),
(3, 'Taxi'),
(4, 'Parking'),
(5, 'Péage'),
(6, 'Hôtel'),
(7, 'Restaurant'),
(8, 'Métro'),
(9, 'Frais kilométriques');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_type_paiement_notes_frais`
--

CREATE TABLE IF NOT EXISTS `ipssi_type_paiement_notes_frais` (
  `id_type_paiement_note_frais` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_paiement_note_frais` varchar(100) NOT NULL,
  PRIMARY KEY (`id_type_paiement_note_frais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ipssi_type_paiement_notes_frais`
--

INSERT INTO `ipssi_type_paiement_notes_frais` (`id_type_paiement_note_frais`, `libelle_paiement_note_frais`) VALUES
(1, 'Chèque'),
(2, 'Virement Bancaire'),
(3, 'Feuille de Paie'),
(4, 'Espèces');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_type_poste`
--

CREATE TABLE IF NOT EXISTS `ipssi_type_poste` (
  `id_type_poste` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type_poste`),
  KEY `id_type_poste` (`id_type_poste`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `ipssi_type_poste`
--

INSERT INTO `ipssi_type_poste` (`id_type_poste`, `libelle`) VALUES
(1, 'CDI'),
(2, 'CDD'),
(3, 'Contrat d''alternance'),
(4, 'Contrat de professionalisation'),
(5, 'Intérim');

-- --------------------------------------------------------

--
-- Structure de la table `ipssi_utilisateur`
--

CREATE TABLE IF NOT EXISTS `ipssi_utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `id_sexe` int(11) NOT NULL COMMENT 'clé étrangère',
  `nom_utilisateur` varchar(50) NOT NULL,
  `prenom_utilisateur` varchar(50) NOT NULL,
  `mail_utilisateur` varchar(200) NOT NULL,
  `telephone_utilisateur` varchar(20) NOT NULL,
  `mdp_utilisateur` varchar(150) NOT NULL,
  `date_mdp_utilisateur` datetime DEFAULT NULL,
  `cle_mdp_utilisateur` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mdp_utilisateur_change` tinyint(1) NOT NULL DEFAULT '1',
  `entreprise_utilisateur` varchar(100) NOT NULL,
  `photo_profil` varchar(255) DEFAULT NULL,
  `supprime` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `mail_utilisateur` (`mail_utilisateur`),
  KEY `id_sexe` (`id_sexe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ipssi_utilisateur`
--

INSERT INTO `ipssi_utilisateur` (`id_utilisateur`, `id_sexe`, `nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `telephone_utilisateur`, `mdp_utilisateur`, `date_mdp_utilisateur`, `cle_mdp_utilisateur`, `mdp_utilisateur_change`, `entreprise_utilisateur`, `photo_profil`, `supprime`) VALUES
(1, 3, 'MOSSON', 'Romane', 'romane.mosson@gmail.com', '0777360290', '0b6d666907634a18c00d4c71b854ffeded6d636f8b0f1eb348eb7e2dd974e8c6', '2016-09-12 16:44:28', '7PC4qr1LEFQx7lkBiBSr3hENSv5078OfMfi4cJcjoHsvavIn5fopoNcjcf1BgZ3vEBaZEX7NOFKVq6MB3P7jsJqhIrEZCNWbITeR', 0, 'EXELIS', NULL, 0),
(2, 1, 'JULIEN', 'Alexandre', 'alexandre.julien.91@gmail.com', '0676799437', '0b6d666907634a18c00d4c71b854ffeded6d636f8b0f1eb348eb7e2dd974e8c6', '2016-08-26 10:29:01', 'zORTuK8KtO4eM7jh7tehYU7DCdhBMrFb4mTnVQVcvNe8JneDGgJtYFUrH2Sjglj0w1khG5jZHoVgzXK55jlSM60hUQp22yYno0sS', 0, 'Dalkia', 'photo-de-profil-de-julien-alexandre-1470231068.jpg', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ipssi_conges`
--
ALTER TABLE `ipssi_conges`
  ADD CONSTRAINT `ipssi_conges_ibfk_3` FOREIGN KEY (`id_utilisateur`) REFERENCES `ipssi_utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `ipssi_conges_ibfk_1` FOREIGN KEY (`id_type_conges`) REFERENCES `ipssi_type_conges` (`id_type_conges`),
  ADD CONSTRAINT `ipssi_conges_ibfk_2` FOREIGN KEY (`id_etat`) REFERENCES `ipssi_etat` (`id_etat`);

--
-- Contraintes pour la table `ipssi_contact`
--
ALTER TABLE `ipssi_contact`
  ADD CONSTRAINT `ipssi_contact_ibfk_1` FOREIGN KEY (`id_contact_type`) REFERENCES `ipssi_contact_type` (`id_contact_type`),
  ADD CONSTRAINT `ipssi_contact_ibfk_2` FOREIGN KEY (`id_contact_demande`) REFERENCES `ipssi_contact_demande` (`id_contact_demande`),
  ADD CONSTRAINT `ipssi_contact_ibfk_3` FOREIGN KEY (`id_sexe`) REFERENCES `ipssi_sexe` (`id_sexe`);

--
-- Contraintes pour la table `ipssi_droit_sous_menu_groupe`
--
ALTER TABLE `ipssi_droit_sous_menu_groupe`
  ADD CONSTRAINT `ipssi_droit_sous_menu_groupe_ibfk_4` FOREIGN KEY (`id_droit`) REFERENCES `ipssi_droit` (`id_droit`),
  ADD CONSTRAINT `ipssi_droit_sous_menu_groupe_ibfk_2` FOREIGN KEY (`id_sous_menu`) REFERENCES `ipssi_sous_menu` (`id_sous_menu`),
  ADD CONSTRAINT `ipssi_droit_sous_menu_groupe_ibfk_3` FOREIGN KEY (`id_groupe`) REFERENCES `ipssi_groupe` (`id_groupe`);

--
-- Contraintes pour la table `ipssi_groupe_utilisateur`
--
ALTER TABLE `ipssi_groupe_utilisateur`
  ADD CONSTRAINT `ipssi_groupe_utilisateur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `ipssi_utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `ipssi_groupe_utilisateur_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `ipssi_groupe` (`id_groupe`);

--
-- Contraintes pour la table `ipssi_notes_frais`
--
ALTER TABLE `ipssi_notes_frais`
  ADD CONSTRAINT `ipssi_notes_frais_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `ipssi_utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `ipssi_notes_frais_ibfk_2` FOREIGN KEY (`id_type_note_frais`) REFERENCES `ipssi_type_notes_frais` (`id_type_note_frais`),
  ADD CONSTRAINT `ipssi_notes_frais_ibfk_3` FOREIGN KEY (`id_etat`) REFERENCES `ipssi_etat` (`id_etat`),
  ADD CONSTRAINT `ipssi_notes_frais_ibfk_4` FOREIGN KEY (`id_type_paiement_note_frais`) REFERENCES `ipssi_type_paiement_notes_frais` (`id_type_paiement_note_frais`);

--
-- Contraintes pour la table `ipssi_page_contenu`
--
ALTER TABLE `ipssi_page_contenu`
  ADD CONSTRAINT `ipssi_page_contenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `ipssi_menu` (`id_menu`),
  ADD CONSTRAINT `ipssi_page_contenu_ibfk_2` FOREIGN KEY (`id_sous_menu`) REFERENCES `ipssi_sous_menu` (`id_sous_menu`);

--
-- Contraintes pour la table `ipssi_poste_candidature`
--
ALTER TABLE `ipssi_poste_candidature`
  ADD CONSTRAINT `ipssi_poste_candidature_ibfk_1` FOREIGN KEY (`id_type_poste`) REFERENCES `ipssi_type_poste` (`id_type_poste`);

--
-- Contraintes pour la table `ipssi_sous_menu`
--
ALTER TABLE `ipssi_sous_menu`
  ADD CONSTRAINT `ipssi_sous_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `ipssi_menu` (`id_menu`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `ipssi_sous_sous_menu`
--
ALTER TABLE `ipssi_sous_sous_menu`
  ADD CONSTRAINT `ipssi_sous_sous_menu_ibfk_1` FOREIGN KEY (`id_sous_menu`) REFERENCES `ipssi_sous_menu` (`id_sous_menu`);

--
-- Contraintes pour la table `ipssi_utilisateur`
--
ALTER TABLE `ipssi_utilisateur`
  ADD CONSTRAINT `ipssi_utilisateur_ibfk_1` FOREIGN KEY (`id_sexe`) REFERENCES `ipssi_sexe` (`id_sexe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
