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
[GitHub Copilot](https://github.com/features/copilot)</small>

<small>Ce travail est sous licence [CC BY-SA 4.0][licence]</small>

![bg opacity:0.1][illustration-principale]

## Plus de détails sur GitHub

<!-- _class: lead -->

_Cette présentation est un résumé du contenu complet disponible sur GitHub._

_Pour plus de détails, consulter le [contenu complet sur
GitHub][contenu-complet-sur-github] ou en cliquant sur l'en-tête de ce
document._

## Objectifs

- Décrire la différence entre l'écriture de code PHP (vanilla) et l'utilisation
  de librairies externes.
- Utiliser Composer pour gérer des librairies externes.
- Décrire les principes de base de Laravel.
- Lister où trouver des ressources et de l'aide sur Laravel.
- Décrire la différence entre PHP, Composer et des frameworks comme Laravel.
- Décrire le lien entre PHP, JavaScript, Composer et npm.

![bg right:40%][illustration-objectifs]

## PHP vanilla vs librairies externes

<!-- _class: lead -->

## Qu'est-ce que PHP vanilla ?

- Utilisation de PHP sans librairie ou framework externe.
- Tout le code est écrit à partir de zéro.
- Uniquement les fonctions natives de PHP.

```php
<?php
echo "Hello, World!";
```

Valable pour des scripts simples ou pour apprendre les bases.

## Limites de tout écrire soi-même

- **Temps** : réinventer la roue pour chaque fonctionnalité.
- **Risques** : bugs et failles de sécurité.
- **Maintenance** : code à maintenir et mettre à jour soi-même.
- **Documentation** : code à documenter soi-même.

## Avantages des librairies externes

- **Réutilisabilité** : code déjà écrit et testé.
- **Support communautaire** : aide disponible en cas de problème.
- **Code testé** : librairies populaires bien testées et sécurisées.
- **Documentation** : librairies souvent bien documentées.
- **Mises à jour** : corrections de bugs et nouvelles fonctionnalités.

## Exemple : mail() vs PHPMailer

<!-- _class: lead -->

## Avec la fonction native mail()

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

## Avec PHPMailer

```php
<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.example.com';
$mail->SMTPAuth = true;
$mail->Username = 'utilisateur@example.com';
$mail->Password = 'mot_de_passe';
$mail->setFrom('expediteur@example.com');
$mail->addAddress('destinataire@example.com');
$mail->isHTML(true);
$mail->Subject = 'Sujet';
$mail->Body = '<h1>Bonjour !</h1>';
$mail->send();
```

## Avantages de PHPMailer

- Support SMTP avec authentification.
- Envoi d'emails HTML.
- Gestion des pièces jointes.
- Gestion des erreurs.
- Meilleure délivrabilité.

## Composer

<!-- _class: lead -->

## Qu'est-ce que Composer ?

Le gestionnaire de dépendances standard pour PHP.

- Déclarer les librairies dont le projet dépend.
- Télécharger et installer ces librairies.
- Gérer les versions et les mises à jour.
- Charger automatiquement les classes (autoloading).

Composer est à PHP ce que npm est à JavaScript ou pip à Python.

## Concepts clés de Composer

| Élément         | Description                                      |
| :-------------- | :----------------------------------------------- |
| `composer.json` | Configuration du projet et liste des dépendances |
| `composer.lock` | Versions exactes installées (à versionner)       |
| `vendor/`       | Dossier des dépendances (ne pas versionner)      |
| `autoload.php`  | Chargement automatique des classes               |

## Commandes de base

| Commande           | Description                              |
| :----------------- | :--------------------------------------- |
| `composer init`    | Créer un nouveau `composer.json`         |
| `composer require` | Ajouter une dépendance                   |
| `composer install` | Installer les dépendances depuis le lock |
| `composer update`  | Mettre à jour les dépendances            |

## Packagist

[Packagist](https://packagist.org/) : le dépôt principal de paquets PHP.

Quelques librairies populaires :

- `phpmailer/phpmailer` : Envoi d'emails.
- `guzzlehttp/guzzle` : Client HTTP.
- `monolog/monolog` : Logging.
- `carbon/carbon` : Manipulation de dates.

## PHP/Composer vs JavaScript/npm

| PHP                | JavaScript          | Description                    |
| :----------------- | :------------------ | :----------------------------- |
| PHP                | JavaScript/Node.js  | Langage de programmation       |
| Composer           | npm                 | Gestionnaire de dépendances    |
| `composer.json`    | `package.json`      | Configuration du projet        |
| `composer.lock`    | `package-lock.json` | Versions exactes               |
| `vendor/`          | `node_modules/`     | Dossier des dépendances        |
| Packagist          | npmjs.com           | Dépôt de paquets               |

Les concepts sont les mêmes d'un écosystème à l'autre.

## PHP vs Composer vs Laravel

<!-- _class: lead -->

## Comparaison

| Élément  | Rôle                        | Analogie                        |
| :------- | :-------------------------- | :------------------------------ |
| PHP      | Le langage de programmation | La langue française             |
| Composer | Le gestionnaire de paquets  | Le dictionnaire/la bibliothèque |
| Laravel  | Le framework                | Les règles de grammaire/style   |

## Relation entre les trois

```text
PHP (langage)
    └── Composer (gestionnaire)
            └── Laravel (framework)
                    └── Votre application
```

Laravel est un framework PHP installé via Composer.

## Introduction à Laravel

<!-- _class: lead -->

## Qu'est-ce que Laravel ?

- Framework PHP open-source créé par Taylor Otwell (2011).
- L'un des frameworks PHP les plus populaires.
- Structure de projet organisée.
- Outils pour les tâches courantes.
- Syntaxe élégante et expressive.
- Documentation complète et communauté active.

## Pourquoi utiliser un framework ?

- **Productivité** : fonctionnalités communes déjà implémentées.
- **Sécurité** : protection contre les failles courantes.
- **Maintenabilité** : structure de code standardisée.
- **Communauté** : support, tutoriels, packages.
- **Bonnes pratiques** : encouragées par le framework.

## Principes clés de Laravel

### Convention over configuration

Si vous suivez les conventions de Laravel, tout fonctionne automatiquement.

Exemple : un modèle `User` cherche automatiquement une table `users`.

### Architecture MVC

- **Model** : données et logique métier.
- **View** : affichage des données.
- **Controller** : gestion des requêtes.

## Ecosystème Laravel

Outils intégrés (vus dans les prochaines séances) :

- **Artisan** : interface en ligne de commande.
- **Blade** : moteur de templates.
- **Eloquent** : ORM pour la base de données.
- **Migrations** : gestion du schéma de base de données.
- **Middleware** : filtrage des requêtes HTTP.

## Ressources et aide

**Documentation officielle**

- [Documentation Laravel](https://laravel.com/docs) : documentation complète.
- [Laravel News](https://laravel-news.com/) : actualités et tutoriels.
- [Laracasts](https://laracasts.com/) : vidéos tutoriels.

**Communauté**

- [Laravel.io](https://laravel.io/) : forum officiel.
- [Reddit r/laravel](https://www.reddit.com/r/laravel/) : discussions.
- [Discord Laravel](https://discord.gg/laravel) : discussions en temps réel.

## Installation de Laravel

```bash
# Créer un nouveau projet Laravel
composer create-project laravel/laravel mon-projet

# Lancer le serveur de développement
cd mon-projet
php artisan serve
```

Application accessible à `http://localhost:8000`.

## Structure d'un projet Laravel

```text
mon-projet/
├── app/                 # Code de l'application
│   ├── Http/Controllers/
│   └── Models/
├── config/              # Configuration
├── database/            # Migrations
├── public/              # Point d'entrée web
├── resources/views/     # Templates Blade
├── routes/web.php       # Routes web
├── .env                 # Variables d'environnement
└── artisan              # CLI Laravel
```

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- (Re)lire le support de cours.
- Réaliser le mini-projet (installation de l'environnement).
- Faire les exercices.
- Poser des questions si nécessaire.

Accéder au contenu complet sur GitHub : [contenu-complet-sur-github].

**N'hésitez pas à vous entraidez si vous avez des difficultés !**

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration principale][illustration-principale] par
  [Richard Jacobs](https://unsplash.com/@rj2747) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-elephants-drinking-water-8oenpCXktqQ)
- [Illustration][illustration-objectifs] par
  [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  [Unsplash](https://unsplash.com/photos/low-angle-view-of-ball-shoots-in-the-ring-j6brni7fpvs)

---

- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

<!-- URLs -->

[contenu-complet-sur-github]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/tree/main/01-contenus-de-cours/02-php-composer-et-laravel/README.md
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720

---

[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
