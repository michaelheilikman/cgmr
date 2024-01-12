# cgmr
<img src="https://cgmr.fr/img/ebeniste.png" width="300" alt="Image text">

## Table des matières :
1. [Informations Générales](#informations-generales)
2. [Technologies](#technologies)
3. [Installation](#installation)
4. [Environnement](#environnement)


### Informations Générales
***
Ce site est réalisé en PHP / SCSS / JS sans framework spécifique.

### Technologies
***
A list of technologies used within the project:
* [PHP](https://windows.php.net/download#php-8.1): Version 8.1 
* [JQUERY](https://jquery.com/): Version 3.6.4
* [SASS](https://sass-lang.com/): Version 1.69.7

### Installation
***
L'installation se fait très simplement en faisant un clone des fichiers ou en cliquant sur download. 
```
$ git clone https://github.com/michaelheilikman/cgmr.git
npm install jquery
npm install bootstrap
npm i jquery-ui
composer require phpmailer/phpmailer
```

### Environnement
***
#### Les variables d'environnement
La connexion à la base de données se fait *via* des variables d'environnement. Ici elles ont été créées grâce à un fichier **.env** et possible avec la commande suivante :
```
composer require vlucas/phpdotenv
```
et définies de la manière suivante :
```
DB_HOST=localhost
DB_USER=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
DB_NAME=votre_base_de_donnees

```
et dans le fichier ```config.php``` :
```
<?php
require __DIR__ . '/vendor/autoload.php'; // Charge Composer autoloader
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Utilisez les variables d'environnement comme d'habitude
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];


```
#### la base de données
```
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `Nom de votre base`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `from_site` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `dateAction` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `from_site` varchar(255) CHARACTER SET latin1 NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `eventStart` varchar(65) CHARACTER SET latin1 DEFAULT NULL,
  `eventEnd` varchar(65) CHARACTER SET latin1 DEFAULT NULL,
  `embededFiles` longtext CHARACTER SET latin1,
  `authors` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` longtext CHARACTER SET latin1,
  `blogDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `from_site` varchar(60) NOT NULL,
  `cat_name` mediumtext NOT NULL,
  `cat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chatbox`
--

CREATE TABLE `chatbox` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `texte` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `docs`
--

CREATE TABLE `docs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `toolDesc` longtext,
  `toolProd` longtext,
  `toolType` longtext,
  `toolTarget` longtext,
  `toolLink` longtext,
  `imgBase64` longtext,
  `folderType` varchar(255) DEFAULT NULL,
  `fileDate` varchar(255) DEFAULT NULL,
  `fileDoc` varchar(255) DEFAULT NULL,
  `typeDoc` varchar(100) DEFAULT NULL,
  `sizeDoc` int(11) DEFAULT NULL,
  `from_site` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fileUpdate` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `item_order` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(11) NOT NULL,
  `from_site` varchar(255) NOT NULL,
  `entreprise` varchar(255) NOT NULL,
  `gouvernance` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `num_TVA` varchar(255) DEFAULT NULL,
  `dateDebut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `eventDate` varchar(60) NOT NULL,
  `eventTexte` longtext NOT NULL,
  `from_site` varchar(255) NOT NULL,
  `eventTime` varchar(50) NOT NULL,
  `eventTimeEnd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `keywords`
--

CREATE TABLE `keywords` (
  `key_id` int(11) NOT NULL,
  `from_site` varchar(60) DEFAULT NULL,
  `key_name` mediumtext,
  `key_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `from_site` varchar(60) NOT NULL,
  `news_prenom` varchar(255) DEFAULT NULL,
  `news_nom` varchar(255) DEFAULT NULL,
  `news_mail` text,
  `news_tel` varchar(60) DEFAULT NULL,
  `news_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `online`
--

CREATE TABLE `online` (
  `visitor_id` int(11) NOT NULL,
  `from_site` varchar(60) NOT NULL,
  `visitor_ip` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `countryCode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `pageView` longtext,
  `pageReferer` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `visitor_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `from_site` varchar(60) NOT NULL,
  `page_type` varchar(255) DEFAULT NULL,
  `page_category` mediumtext,
  `titre` longtext,
  `page_url` longtext,
  `photo` longtext,
  `authors` varchar(60) DEFAULT NULL,
  `embededFiles` longtext,
  `active` int(2) DEFAULT '0',
  `page_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `page_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `page_tools`
--

CREATE TABLE `page_tools` (
  `tool_id` int(11) NOT NULL,
  `from_site` varchar(60) DEFAULT NULL,
  `tool_type` varchar(255) DEFAULT NULL,
  `tool_content` longtext,
  `page_id` int(11) NOT NULL,
  `item_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

CREATE TABLE `recuperation` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` int(11) NOT NULL,
  `confirme` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(3) NOT NULL,
  `name` varchar(60) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `level` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `from_site` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `fonction` varchar(255) NOT NULL,
  `role_projet` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `passwordCheck` varchar(255) DEFAULT NULL,
  `type` varchar(60) NOT NULL,
  `entreprise` varchar(255) NOT NULL,
  `gouvernance` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `telFix` varchar(60) DEFAULT NULL,
  `telMob` varchar(60) DEFAULT NULL,
  `dateDebut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `entreprise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `views`
--

CREATE TABLE `views` (
  `visitor_id` int(11) NOT NULL,
  `from_site` varchar(60) NOT NULL,
  `visitor_ip` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `countryCode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `pageView` longtext,
  `pageReferer` varchar(255) NOT NULL,
  `visitor_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `visitors`
--

CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `from_site` varchar(60) NOT NULL,
  `visitor_ip` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `countryCode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `pageView` longtext,
  `pageReferer` varchar(255) NOT NULL,
  `visitor_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



```