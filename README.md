# cgmr
<img src="https://cgmr.fr/img/ebeniste.png" width="300" alt="Image text">

## Table des matières :
1. [General Info](#general-info)
2. [Technologies](#technologies)
3. [Installation](#installation)
4. [Environnement](#environnement)
5. [FAQs](#faqs)


### General Info
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
```
Attention : la base de données ```n'est pas fournie``` avec le code.

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
+------------------------+          +------------------------+          +------------------------+
|        actions         |          |          blog          |          |        category        |
+------------------------+          +------------------------+          +------------------------+
| id                     |<-------->| id                     |          | cat_id                 |
| from_site              |          | from_site              |          | from_site              |
| action                 |          | title                  |          | cat_name               |
| dateAction             |          | url                    |          | cat_date               |
+------------------------+          | description            |          +------------------------+
                                   | eventStart              |
                                   | eventEnd                |
                                   | embededFiles            |
                                   | authors                |
                                   | photo                  |
                                   | blogDate                |
                                   | creator                |
                                   +------------------------+

+------------------------+          +------------------------+          +------------------------+
|       chatbox          |          |          docs          |          |      entreprises      |
+------------------------+          +------------------------+          +------------------------+
| id                     |<-------->| id                     |          | id                     |
| author                 |          | name                   |          | from_site              |
| texte                  |          | toolDesc               |          | entreprise             |
| date                   |          | toolProd               |          | gouvernance            |
| doc_id                 |          | toolType               |          | adresse                |
+------------------------+          | toolTarget             |          | cp                     |
                                   | toolLink               |          | ville                  |
                                   | imgBase64              |          | num_TVA                |
                                   | folderType             |          | dateDebut              |
                                   | fileDate               |          +------------------------+
                                   | fileDoc                |
                                   | typeDoc                |
                                   | sizeDoc                |
                                   | date                   |
                                   | fileUpdate             |
                                   | created_by             |
                                   | active                 |
                                   | parent_id              |
                                   | item_order             |
                                   +------------------------+

+------------------------+          +------------------------+          +------------------------+
|        events          |          |        keywords        |          |      newsletter       |
+------------------------+          +------------------------+          +------------------------+
| id                     |          | key_id                 |          | id                     |
| eventDate              |          | from_site              |          | from_site              |
| eventTexte             |          | key_name               |          | news_prenom            |
| from_site              |          | key_date               |          | news_nom               |
| eventTime              |          +------------------------+          | news_mail              |
| eventTimeEnd           |                                              | news_date              |
+------------------------+                                              +------------------------+

+------------------------+          +------------------------+          +------------------------+
|       online           |          |         pages          |          |      page_tools       |
+------------------------+          +------------------------+          +------------------------+
| visitor_id             |<-------->| page_id                |          | tool_id                |
| from_site              |          | from_site              |          | from_site              |
| visitor_ip             |          | page_type              |          | tool_type              |
| country                |          | page_category          |<-------->| tool_content           |
| countryCode            |          | titre                  |          | page_id                |
| city                   |          | page_url               |          | item_order             |
| latitude               |          | photo                  |<-------->+------------------------+
| longitude              |          | authors                |
| pageView               |          | embededFiles           |
| pageReferer            |          | active                 |
| time                   |          | page_update            |
| visitor_date           |          | page_date              |
+------------------------+          +------------------------+

+------------------------+          +------------------------+          +------------------------+
|     participants       |          |   product_rating       |          |     recuperation      |
+------------------------+          +------------------------+          +------------------------+
| pid                    |          | id                     |          | id                     |
| from_site              |          | from_site              |          | mail                   |
| civilite               |          | user_id                |          | code                   |
| prenom                 |<-------->| product_id             |          | confirme               |
| nom                    |          | rating                 |          +------------------------+
| entreprise             |          | rating_date            |
| adresse                |          +------------------------+
| cp                     |
| ville                  |
| telFix                 |
| email                  |
| ordinal                |
| tva                    |
| adherent               |
| participation          |
| cotisation             |
| soiree                 |
| paiement               |
| date_inscription       |
+------------------------+

+------------------------+          +------------------------+          +------------------------+
|  product_rating        |          |     recuperation       |          |         roles          |
+------------------------+          +------------------------+          +------------------------+
| id                     |          | id                     |          | id                     |
| from_site              |          | mail                   |          | name                   |
| user_id                |          | code                   |          | slug                   |
| product_id             |          | confirme               |          | level                  |
| rating                 |          +------------------------+          +------------------------+
| rating_date            |
+------------------------+

+------------------------+          +------------------------+          +------------------------+
|        roles           |          |         users          |          |         views          |
+------------------------+          +------------------------+          +------------------------+
| id                     |<-------->| id                     |          | visitor_id             |
| name                   |          | from_site              |          | from_site              |
| slug                   |          | prenom                 |<-------->| visitor_ip             |
| level                  |          | nom                    |          | country                |
+------------------------+          | fonction               |          | countryCode            |
                                    | role_projet            |          | city                   |
                                   | mail                   |          | latitude               |
                                   | password               |          | longitude              |
                                   | passwordCheck          |          | pageView               |
                                   | type                   |          | pageReferer            |
                                   | entreprise             |          | visitor_date           |
                                   | gouvernance            |          +------------------------+
                                   | adresse                |
                                   | cp                     |
                                   | ville                  |
                                   | telFix                 |
                                   | telMob                 |
                                   | dateDebut              |
                                   | active                 |
                                   | role_id               |
                                   | entreprise_id          |
                                   +------------------------+

+------------------------+          +------------------------+          +------------------------+
|         views          |          |       visitors         |          |        newsletter       |
+------------------------+          +------------------------+          +------------------------+
| visitor_id             |<-------->| visitor_id             |          | id                     |
| from_site              |          | from_site              |          | from_site              |
| visitor_ip             |          | visitor_ip             |          | news_prenom            |
| country                |          | country                |          | news_nom               |
| countryCode            |          | countryCode            |          | news_mail              |
| city                   |          | city                   |          | news_date              |
| latitude               |          | latitude               |          +------------------------+
| longitude              |          | longitude              |
| pageView               |          | pageView               |
| pageReferer            |          | pageReferer            |
| visitor_date           |          | visitor_date           |
+------------------------+          +------------------------+

```


### FAQs
***
A list of frequently asked questions
1. **This is a question in bold**
Answer of the first question with _italic words_. 
2. __Second question in bold__ 
To answer this question we use an unordered list:
* First point
* Second Point
* Third point
3. **Third question in bold**
Answer of the third question with *italic words*.
4. **Fourth question in bold**
| Headline 1 in the tablehead | Headline 2 in the tablehead | Headline 3 in the tablehead |
|:--------------|:-------------:|--------------:|
| text-align left | text-align center | text-align right |