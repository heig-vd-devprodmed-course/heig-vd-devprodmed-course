---
marp: true
theme: "custom-marp-theme"
size: "16:9"
paginate: "true"
author: "L. Delafontaine, avec l'aide de GitHub Copilot"
description:
  "PHP, Composer et Laravel pour le cours DévProdMéd enseigné à la HEIG-VD,
  Suisse"
lang: "fr"
header: "[**PHP, Composer et Laravel**][contenu-complet-sur-github]"
footer:
  "[**HEIG-VD**](https://heig-vd.ch) - [DévProdMéd
  2025-2026](https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course)
  - [CC BY-SA 4.0][licence]"
headingDivider: 6
---

# PHP, Composer et Laravel

<!--
_class: lead
_paginate: false
-->

<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course>

Visualiser le contenu complet sur GitHub [à cette
adresse][contenu-complet-sur-github].

<small>L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).</small>

<small>Ce travail est sous licence [CC BY-SA 4.0][licence].</small>

![bg opacity:0.1][illustration-principale]

## Plus de détails sur GitHub

<!-- _class: lead -->

_Cette présentation est un résumé du contenu complet disponible sur GitHub._

_Pour plus de détails, consulter le [contenu complet sur
GitHub][contenu-complet-sur-github] ou en cliquant sur l'en-tête de ce
document._

## Objectifs (1)

- Décrire la différence entre l'écriture de code PHP (vanilla) et l'utilisation
  de librairies externes.
- Utiliser Composer pour gérer des librairies externes.
- Décrire les principes de base de Laravel.
- Lister où trouver des ressources et de l'aide sur Laravel.

![bg right:40%][illustration-objectifs]

## Objectifs (2)

- Décrire la différence entre PHP, Composer et des frameworks comme Laravel.
- Décrire le lien entre PHP, JavaScript, Composer et npm.

![bg right:40%][illustration-objectifs]

## PHP vanilla vs librairies externes

<!-- _class: lead -->

### Qu'est-ce que PHP vanilla ?

- "PHP vanilla" fait référence à l'utilisation de PHP sans librairie ou
  framework externe.
- Tout le code est écrit à partir de zéro.
- Uniquement les fonctions natives offertes par PHP.

```php
<?php
echo "Hello, World!";
```

Valable pour des scripts simples ou pour apprendre les bases, mais vite limité.

### Limites de tout écrire soi-même

- **Temps** : réinventer la roue pour chaque fonctionnalité.
- **Risques** : bugs et failles de sécurité.
- **Maintenance** : code à maintenir et mettre à jour soi-même.
- **Documentation** : code à documenter soi-même.

![bg right:40%][illustration-limites-de-tout-ecrire-soi-meme]

---

<!-- _class: lead -->

Vous l'avez expérimenté avec _"Programmation serveur 1 (ProgServ1)"_ et
_"Programmation serveur 2 (ProgServ2)"_ : faire correctement tout soi-même est
long et fastidieux.

### Avantages des librairies externes (1)

- **Réutilisabilité** : code déjà écrit et testé.
- **Support** : aide(s) disponible(s) en cas de problème(s).
- **Code testé** : librairies populaires bien testées et sécurisées.
- **Documentation** : librairies souvent bien documentées.

![bg right:40%][illustration-avantages-des-libraries-externes]

### Avantages des librairies externes (2)

- **Mises à jour** : corrections de bugs et nouvelles fonctionnalités.

**Les développeur.euses peuvent se concentrer sur la création de fonctionnalités
spécifiques à leur application plutôt que de réécrire des fonctionnalités de
base.**

![bg right:40%][illustration-avantages-des-libraries-externes]

### Exemple : mail() vs PHPMailer

<!-- _class: lead -->

#### Avec la fonction native mail()

```php
<?php
$to = "destinataire@example.com";
$subject = "Sujet du message";
$message = "Ceci est le contenu du message.";
$headers = "From: expediteur@example.com";

mail($to, $subject, $message, $headers);
```

**Limitations** : configuration SMTP complexe, pas de pièces jointes, pas de
HTML riche, emails souvent marqués comme spam.

#### Avec PHPMailer (1)

```php
<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

// Configuration SMTP
$mail->isSMTP();
$mail->Host = 'smtp.example.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
```

---

```php
$mail->Username = 'utilisateur@example.com';
$mail->Password = 'mot_de_passe';
$mail->CharSet = "UTF-8";
$mail->Encoding = "base64";

// Expéditeur et destinataire
$mail->setFrom($from_email, $from_name);
$mail->addAddress('CHANGE_ME', 'CHANGE WITH YOUR NAME');

// Contenu du mail
$mail->isHTML(true);
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

// Envoi du mail
$mail->send();
```

#### Avec PHPMailer (2)

**Avantages** :

- Support SMTP avec authentification.
- Envoi HTML riche.
- Pièces jointes.
- Gestion des erreurs
- Meilleure délivrabilité.

**➡️ Il n'a pas été nécessaire de réécrire toute la logique d'envoi d'emails :
gain de temps et qualité du code augmentée.**

## Composer

<!-- _class: lead -->

### Qu'est-ce que Composer ? (1)

[Composer](https://getcomposer.org/) est le gestionnaire de dépendances standard
pour PHP. Il permet de :

- Déclarer les librairies dont votre projet dépend.
- Télécharger et installer ces librairies automatiquement.

![bg right:40% contain][illustration-quest-ce-que-composer]

### Qu'est-ce que Composer ? (2)

- Gérer les versions et les mises à jour.
- Charger automatiquement les classes (autoloading).

Composer est à PHP ce que npm est à JavaScript, pip à Python, Maven à Java ou
encore Cargo à Rust.

![bg right:40% contain][illustration-quest-ce-que-composer]

### Concepts clés de Composer

| Élément               | Description                                      |
| :-------------------- | :----------------------------------------------- |
| `composer.json`       | Configuration du projet et liste des dépendances |
| `composer.lock`       | Versions exactes installées (à versionner)       |
| `vendor/`             | Dossier des dépendances (ne pas versionner)      |
| `vendor/autoload.php` | Chargement automatique des classes               |

### Commandes de base

| Commande           | Description                              |
| :----------------- | :--------------------------------------- |
| `composer init`    | Créer un nouveau `composer.json`         |
| `composer require` | Ajouter une dépendance                   |
| `composer install` | Installer les dépendances depuis le lock |
| `composer update`  | Mettre à jour les dépendances            |
| `composer remove`  | Supprimer une dépendance                 |

### Packagist

[Packagist](https://packagist.org/) est le dépôt principal de paquets PHP.

Composer utilise Packagist pour rechercher et télécharger les librairies.

Il n'est plus nécessaire de télécharger manuellement les librairies comme en
ProgServ2 !

![bg right:40% contain][illustration-packagist]

## Introduction à Laravel

<!-- _class: lead -->

### Qu'est-ce que Laravel ?

- Framework PHP open-source créé par Taylor Otwell (2011).
- L'un des frameworks PHP les plus populaires.
- Structure de projet organisée.
- Outils pour les tâches courantes.
- Documentation complète
- Communauté (extrêmement) active.

![bg right:40% contain][illustration-laravel]

### Pourquoi utiliser un framework ?

- **Productivité** : fonctionnalités communes déjà implémentées.
- **Sécurité** : protection contre les failles courantes.
- **Maintenabilité** : structure de code standardisée.
- **Communauté** : support, tutoriels, packages.
- **Bonnes pratiques** : encouragées par le framework.

**Vous vous concentrez sur la logique métier de votre application plutôt que sur
les détails techniques.**

### Principes clés

Laravel repose sur plusieurs principes clés qui facilitent le développement web
:

- Architecture MVC.
- Convention over configuration.
- Système de routing.

![bg right:40% contain][illustration-laravel]

#### Architecture MVC

Laravel utilise l'architecture Model-View-Controller (MVC) :

- **Model** : représente les données et la logique métier.
- **View** : affiche les données à l'utilisateur.
- **Controller** : gère les requêtes (entrées/sorties) et coordonne Model et
  View.

![bg right:40% contain][illustration-laravel]

#### Convention over configuration

Si vous suivez les conventions de Laravel, tout fonctionne automatiquement.

Exemple : un modèle `User` cherche automatiquement une table `users`.

![bg right:40% contain][illustration-laravel]

### Ecosystème Laravel

Outils intégrés (vus dans les prochaines séances) :

- **Artisan** : interface en ligne de commande de laravel.
- **Blade** : moteur de templates.
- **Eloquent** : ORM pour la base de données.
- **Middleware** : filtrage des requêtes HTTP.
- Et plus encore !

![bg right:30% contain][illustration-laravel]

### Ressources et aide

Laravel dispose d'un riche écosystème de ressources pour apprendre et obtenir de
l'aide :

- Documentation officielle.
- Communauté active.
- Dépôts GitHub.

Durant le cours, ces différentes ressources seront utilisées pour approfondir
vos connaissances.

#### Documentation officielle

- [Documentation Laravel](https://laravel.com/docs) : documentation complète.
- [Laravel News](https://laravel-news.com/) : actualités et tutoriels.
- [Laracasts](https://laracasts.com/) : vidéos tutoriels.

![bg right:40% contain][illustration-laravel]

#### Communauté

- [Laravel.io](https://laravel.io/) : forum officiel.
- [Reddit r/laravel](https://www.reddit.com/r/laravel/) : discussions.
- [Discord Laravel](https://discord.gg/laravel) : discussions en temps réel.

![bg right:40% contain][illustration-laravel]

#### Dépôts GitHub

- [laravel/laravel](https://github.com/laravel/laravel) : le dépôt principal du
  framework.
- [Awesome Laravel](https://github.com/chiraggude/awesome-laravel) : liste de
  ressources Laravel.

![bg right:40% contain][illustration-laravel]

### Laravel, des briques LEGO parfois un peu magiques

- Laravel peut être intimidant pour les débutant.es.
- Parfois, les fonctionnalités peuvent sembler "magiques".
- Pas besoin de tout comprendre en détail au début.
- Nous allons aborder chaque concept progressivement.

![bg right:30% contain][illustration-laravel]

### Installation de Laravel

```bash
# Installe l'installateur Laravel globalement avec Composer
composer global require laravel/installer
```

Créer un nouveau projet Laravel :

```bash
# Crée un nouveau projet Laravel nommé "mon-projet"
laravel new mon-projet
```

### Structure d'un projet Laravel

```text
./
├── app/            # Code principal de l'application
├── bootstrap/      # Fichiers de démarrage
├── config/         # Fichiers de configuration
├── database/       # Migrations et seeds
├── node_modules/   # Dépendances JavaScript (si utilisées)
├── public/         # Point d'entrée public (index.php)
├── resources/      # Vues et ressources front-end
├── routes/         # Définitions des routes
├── storage/        # Fichiers générés (logs, cache, etc.)
├── tests/          # Tests unitaires et fonctionnels
└── vendor/         # Dépendances gérées par Composer
```

### Lancer le serveur de développement

Laravel inclut un serveur de développement intégré :

```bash
# Se placer dans le dossier du projet
cd mon-projet

# Lancer le serveur de développement
composer run dev
```

Composer démarrera le serveur de développement et l'application sera alors
accessible à l'adresse <http://localhost:8000>.

## PHP vs Composer vs Laravel

<!-- _class: lead -->

### PHP vs Composer vs Laravel

| Élément  | Rôle                        |
| :------- | :-------------------------- |
| PHP      | Le langage de programmation |
| Composer | Le gestionnaire de paquets  |
| Laravel  | Le framework                |

```text
PHP (langage)
    └── Composer (gestionnaire)
            └── Laravel (framework)
                    └── Votre application
```

## Lien avec JavaScript et npm (1)

| Concept                   | PHP              | JavaScript          |
| :------------------------ | :--------------- | :------------------ |
| Gestionnaire de paquets   | Composer         | npm                 |
| Dépôt de paquets          | Packagist        | npmjs.com           |
| Frameworks web populaires | Laravel, Symfony | Express, React      |
| Fichier de configuration  | `composer.json`  | `package.json`      |
| Fichier de verrouillage   | `composer.lock`  | `package-lock.json` |
| Dossier des dépendances   | `vendor/`        | `node_modules/`     |

## Lien avec JavaScript et npm (2)

Nous allons éviter de mélanger les deux écosystèmes dans ce cours, mais il est
utile de comprendre les parallèles.

Il n'est pas impossible que nous utilisions occasionnellement des outils
JavaScript pour le front-end dans les projets Laravel.

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- (Re)lire le support de cours.
- Faire le mini-projet.
- Faire les exercices.
- Poser des questions si nécessaire.

➡️ [Visualiser le contenu complet sur GitHub.][contenu-complet-sur-github]

**N'hésitez pas à vous entraidez si vous avez des difficultés !**

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration principale][illustration-principale] par
  [Richard Jacobs](https://unsplash.com/@rj2747) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-elephants-drinking-water-8oenpCXktqQ)
- [Illustration][illustration-objectifs] par
  [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  [Unsplash](https://unsplash.com/photos/low-angle-view-of-ball-shoots-in-the-ring-j6brni7fpvs)
- [Illustration][illustration-limites-de-tout-ecrire-soi-meme] par
  [Heather Zabriskie](https://unsplash.com/@heatherz) sur
  [Unsplash](https://unsplash.com/photos/vintage-brown-and-white-watch-lot-yBzrPGLjMQw)
- [Illustration][illustration-avantages-des-libraries-externes] par
  [Lorin Both](https://unsplash.com/@lorinboth) sur
  [Unsplash](https://unsplash.com/photos/a-clock-hanging-from-the-ceiling-of-a-building-GJ_3j24tT1w)
- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

<!-- URLs -->

[contenu-complet-sur-github]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/tree/main/01-contenus-du-cours/02-php-composer-et-laravel/README.md
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-limites-de-tout-ecrire-soi-meme]:
	https://images.unsplash.com/photo-1455651512878-0ddbb4c4d0a5?fit=crop&h=720
[illustration-avantages-des-libraries-externes]:
	https://images.unsplash.com/photo-1675186402285-0f94e35d03d7?fit=crop&h=720
[illustration-quest-ce-que-composer]:
	https://getcomposer.org/img/logo-composer-transparent3.png
[illustration-packagist]: https://packagist.org/img/logo.png
[illustration-laravel]:
	https://raw.githubusercontent.com/laravel/art/refs/heads/master/laravel-logo.svg
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
