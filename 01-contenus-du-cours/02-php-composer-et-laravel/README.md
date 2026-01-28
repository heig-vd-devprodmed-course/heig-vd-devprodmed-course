# PHP, Composer et Laravel

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Voici quelques informations relatives à ce contenu.
>
> **Ressources annexes**
>
> - Autres formats du support de cours : [Présentation (web)][presentation-web]
>   · [Présentation (PDF)][presentation-pdf]
> - Mini-projet : [Accéder au contenu](./01-mini-projet/README.md)
> - Exercices : [Accéder au contenu](./02-exercices/README.md)
>
> **Objectifs**
>
> À l'issue de cette séance, les personnes qui étudient devraient être capables
> de :
>
> - Décrire la différence entre l'écriture de code PHP (vanilla) et
>   l'utilisation de librairies externes.
> - Utiliser Composer pour gérer des librairies externes.
> - Décrire les principes de base de Laravel.
> - Lister où trouver des ressources et de l'aide sur Laravel.
> - Décrire la différence entre PHP, Composer et des frameworks comme Laravel.
> - Décrire le lien entre PHP, JavaScript, Composer et npm.
>
> **Méthodes d'enseignement et d'apprentissage**
>
> Les méthodes d'enseignement et d'apprentissage utilisées pour animer la séance
> sont les suivantes :
>
> - Présentation magistrale.
> - Discussions collectives.
> - Travail en autonomie.
>
> **Méthodes d'évaluation**
>
> L'évaluation prend la forme d'exercices et d'un mini-projet à réaliser en
> autonomie en classe ou à la maison.
>
> L'évaluation se fait en utilisant les critères suivants :
>
> - Capacité à répondre avec justesse.
> - Capacité à argumenter.
> - Capacité à réaliser les tâches demandées.
> - Capacité à s'approprier les exemples de code.
> - Capacité à appliquer les exemples de code à des situations similaires.
>
> Les retours se font de la manière suivante :
>
> - Corrigé du mini-projet.
> - Corrigé des exercices.
>
> L'évaluation ne donne pas lieu à une note.

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [PHP vanilla vs librairies externes](#php-vanilla-vs-librairies-externes)
  - [Qu'est-ce que PHP vanilla ?](#quest-ce-que-php-vanilla-)
  - [Limites de tout écrire soi-même](#limites-de-tout-écrire-soi-même)
  - [Avantages des librairies externes](#avantages-des-librairies-externes)
  - [Exemple : mail() vs PHPMailer](#exemple--mail-vs-phpmailer)
- [Composer](#composer)
  - [Qu'est-ce que Composer ?](#quest-ce-que-composer-)
  - [Concepts clés](#concepts-clés)
  - [Commandes de base](#commandes-de-base)
  - [Packagist](#packagist)
- [Introduction à Laravel](#introduction-à-laravel)
  - [Qu'est-ce que Laravel ?](#quest-ce-que-laravel-)
  - [Pourquoi utiliser un framework ?](#pourquoi-utiliser-un-framework-)
  - [Principes clés](#principes-clés)
  - [Écosystème Laravel](#écosystème-laravel)
  - [Ressources et aide](#ressources-et-aide)
  - [Laravel, des briques LEGO parfois un peu magiques](#laravel-des-briques-lego-parfois-un-peu-magiques)
  - [Installation de Laravel](#installation-de-laravel)
  - [Structure d'un projet Laravel](#structure-dun-projet-laravel)
  - [Lancer le serveur de développement](#lancer-le-serveur-de-développement)
- [PHP vs Composer vs Laravel](#php-vs-composer-vs-laravel)
  - [PHP : le langage](#php--le-langage)
  - [Composer : le gestionnaire de dépendances](#composer--le-gestionnaire-de-dépendances)
  - [Laravel : le framework](#laravel--le-framework)
- [Lien avec JavaScript et npm](#lien-avec-javascript-et-npm)
- [Conclusion](#conclusion)
- [Mini-projet](#mini-projet)
- [Exercices](#exercices)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs de permettre aux personnes qui étudient de
comprendre les bases de PHP, Composer et Laravel, ainsi que le lien avec
l'écosystème JavaScript et npm.

De façon plus concise, à l'issue de cette séance, les personnes qui étudient
devraient être capables de :

- Décrire la différence entre l'écriture de code PHP (vanilla) et l'utilisation
  de librairies externes.
- Utiliser Composer pour gérer des librairies externes.
- Décrire les principes de base de Laravel.
- Lister où trouver des ressources et de l'aide sur Laravel.
- Décrire la différence entre PHP, Composer et des frameworks comme Laravel.
- Décrire le lien entre PHP, JavaScript, Composer et npm.

## PHP vanilla vs librairies externes

> [!TIP]
>
> Des difficultés à comprendre certains concepts présentés dans ce contenu de
> cours ? Consultez les contenus de cours pour les cours _"Programmation serveur
> 1 (ProgServ1)"_ et _"Programmation serveur 2 (ProgServ2)"_ pour vous aider :
>
> - <https://github.com/heig-vd-progserv-course/heig-vd-progserv1-course>.
> - <https://github.com/heig-vd-progserv-course/heig-vd-progserv2-course>.
>
> N'hésitez pas à poser des questions si besoin !

### Qu'est-ce que PHP vanilla ?

Le terme "vanilla" fait référence à l'utilisation de PHP sans aucune librairie
ou framework externe. Cela signifie que tout le code est écrit à partir de zéro,
en utilisant uniquement les fonctions natives de PHP.

Par exemple, pour afficher "Hello, World!" en PHP vanilla :

```php
<?php
echo "Hello, World!";
```

Cette approche est parfaitement valable pour des scripts simples ou pour
apprendre les bases du langage. Cependant, elle présente des limites lorsque les
projets deviennent plus complexes.

### Limites de tout écrire soi-même

Écrire tout le code soi-même présente plusieurs inconvénients :

- **Temps de développement** : réinventer la roue pour chaque fonctionnalité
  prend du temps.
- **Risques d'erreurs** : le code écrit rapidement peut contenir des bugs ou des
  failles de sécurité.
- **Maintenance** : le code personnalisé doit être maintenu et mis à jour par
  vous-même.
- **Documentation** : vous devez documenter votre propre code pour que d'autres
  (ou vous-même plus tard) puissent le comprendre.

### Avantages des librairies externes

Les librairies externes offrent de nombreux avantages :

- **Réutilisabilité** : le code est déjà écrit et testé, prêt à être utilisé.
- **Support communautaire** : une large communauté peut aider en cas de
  problème.
- **Code testé** : les librairies populaires sont généralement bien testées et
  sécurisées.
- **Documentation** : les librairies sont souvent bien documentées.
- **Mises à jour** : les mainteneurs de la librairie corrigent les bugs et
  ajoutent des fonctionnalités.

En se reposant sur des librairies externes, les développeur.euses peuvent se
concentrer sur la création de fonctionnalités spécifiques à leur application
plutôt que de réécrire des fonctionnalités de base.

### Exemple : mail() vs PHPMailer

Un exemple concret de la différence entre PHP vanilla et l'utilisation d'une
librairie externe est l'envoi d'emails, comme déjà étudié dans le cours
_"[Programmation serveur 2 (ProgServ2)](https://github.com/heig-vd-progserv-course/heig-vd-progserv2-course)"_.

#### Avec la fonction native mail()

PHP dispose d'une fonction native `mail()` pour envoyer des emails :

```php
<?php
$to = "destinataire@example.com";
$subject = "Sujet du message";
$message = "Ceci est le contenu du message.";
$headers = "From: expediteur@example.com";

mail($to, $subject, $message, $headers);
```

Cette approche fonctionne, mais présente plusieurs limitations :

- Configuration du serveur SMTP souvent complexe.
- Pas de support natif pour les pièces jointes.
- Pas de support pour le HTML riche.
- Difficile de gérer l'authentification SMTP.
- Emails souvent marqués comme spam.

#### Avec PHPMailer

PHPMailer est une librairie populaire qui simplifie l'envoi d'emails :

```php
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuration du serveur
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'utilisateur@example.com';
    $mail->Password   = 'mot_de_passe';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Destinataires
    $mail->setFrom('expediteur@example.com', 'Expéditeur');
    $mail->addAddress('destinataire@example.com', 'Destinataire');

    // Contenu
    $mail->isHTML(true);
    $mail->Subject = 'Sujet du message';
    $mail->Body    = '<h1>Bonjour !</h1><p>Ceci est un email HTML.</p>';
    $mail->AltBody = 'Ceci est la version texte pour les clients non-HTML.';

    // Pièce jointe (optionnel)
    $mail->addAttachment('/chemin/vers/fichier.pdf');

    $mail->send();
    echo 'Message envoyé avec succès';
} catch (Exception $e) {
    echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
}
```

Bien que le code soit plus long, PHPMailer offre :

- Support SMTP avec authentification.
- Envoi d'emails HTML avec version texte alternative.
- Gestion des pièces jointes.
- Gestion des erreurs.
- Meilleure délivrabilité des emails.

Il n'a pas été nécessaire de réécrire toute la logique d'envoi d'emails, ce qui
permet de gagner du temps et d'améliorer la qualité du code.

## Composer

### Qu'est-ce que Composer ?

Composer est le gestionnaire de dépendances standard pour PHP. Il permet de :

- Déclarer les librairies dont votre projet dépend.
- Télécharger et installer ces librairies automatiquement.
- Gérer les versions et les mises à jour.
- Charger automatiquement les classes (autoloading).

Composer est à PHP ce que npm est à JavaScript, pip à Python, Maven à Java ou
encore Cargo à Rust.

### Concepts clés

#### composer.json

Le fichier `composer.json` est le fichier de configuration de votre projet. Il
contient :

- Les métadonnées du projet (nom, description, auteur).
- Les dépendances du projet.
- La configuration de l'autoloading.

Exemple de `composer.json` :

```json
{
	"name": "mon-utilisateur/mon-projet",
	"description": "Description de mon projet",
	"type": "project",
	"require": {
		"php": "^8.1",
		"phpmailer/phpmailer": "^6.8"
	},
	"autoload": {
		"psr-4": {
			"App\\": "src/"
		}
	}
}
```

#### composer.lock

Le fichier `composer.lock` enregistre les versions exactes de toutes les
dépendances installées. Il garantit que tous les toutes les personnes qui
développent sur votre projet et environnements utilisent les mêmes versions.

Ce fichier doit être versionné avec Git.

#### Le dossier vendor/

Le dossier `vendor/` contient toutes les dépendances téléchargées par Composer.
Ce dossier ne doit pas être versionné (ajoutez-le au fichier `.gitignore`).

#### Autoloading

Composer génère un fichier `vendor/autoload.php` qui charge automatiquement
toutes les classes de vos dépendances et de votre projet.

```php
<?php
require 'vendor/autoload.php';

// Toutes les classes sont maintenant disponibles
use PHPMailer\PHPMailer\PHPMailer;
```

### Commandes de base

| Commande           | Description                                       |
| :----------------- | :------------------------------------------------ |
| `composer init`    | Crée un nouveau fichier `composer.json`.          |
| `composer require` | Ajoute une dépendance au projet.                  |
| `composer install` | Installe les dépendances depuis `composer.lock`.  |
| `composer update`  | Met à jour les dépendances et le `composer.lock`. |
| `composer remove`  | Supprime une dépendance du projet.                |

Exemples d'utilisation :

```bash
# Initialiser un nouveau projet
composer init

# Ajouter PHPMailer comme dépendance
composer require phpmailer/phpmailer

# Installer les dépendances (après un git clone par exemple)
composer install

# Mettre à jour toutes les dépendances
composer update
```

### Packagist

[Packagist](https://packagist.org/) est le dépôt principal de paquets PHP. C'est
là que Composer recherche les librairies par défaut.

Vous pouvez y rechercher des librairies, consulter leur documentation, voir leur
popularité et leurs statistiques de téléchargement.

Quelques librairies populaires :

- [`phpmailer/phpmailer`](https://packagist.org/packages/phpmailer/phpmailer) :
  Envoi d'emails.
- [`guzzlehttp/guzzle`](https://packagist.org/packages/guzzlehttp/guzzle) :
  Client HTTP.
- [`monolog/monolog`](https://packagist.org/packages/monolog/monolog) : Logging.
- [`carbon/carbon`](https://packagist.org/packages/carbon/carbon) : Manipulation
  de dates.
- [`phpunit/phpunit`](https://packagist.org/packages/phpunit/phpunit) : Tests
  unitaires.

Grâce à Packagist et Composer, il est facile d'ajouter des fonctionnalités
complexes à vos projets PHP en quelques commandes seulement.

Nous l'avions fait à la main dans le cours _"Programmation serveur 2
(ProgServ2)"_ en téléchargeant PHPMailer manuellement. Composer automatise ce
processus.

## Introduction à Laravel

### Qu'est-ce que Laravel ?

Laravel est un framework PHP open-source créé par Taylor Otwell en 2011. C'est
aujourd'hui l'un des frameworks PHP les plus populaires.

Laravel fournit :

- Une structure de projet organisée.
- Des outils pour les tâches courantes (authentification, base de données,
  emails, etc.).
- Une documentation complète.
- Une communauté (extrêmement) active.

### Pourquoi utiliser un framework ?

Un framework comme Laravel offre plusieurs avantages :

- **Productivité** : les fonctionnalités communes sont déjà implémentées.
- **Sécurité** : protection contre les failles courantes (XSS, CSRF, injection
  SQL).
- **Maintenabilité** : structure de code standardisée et organisée.
- **Communauté** : support, tutoriels, packages additionnels.
- **Bonnes pratiques** : le framework encourage les bonnes pratiques de
  développement.

Vous vous concentrez sur la logique métier de votre application plutôt que sur
les détails techniques.

### Principes clés

Laravel repose sur plusieurs principes clés qui facilitent le développement web
:

- Architecture MVC.
- Convention over configuration.
- Système de routing.

#### Architecture MVC

Laravel utilise l'architecture MVC (Model-View-Controller) :

- **Model** : représente les données et la logique métier.
- **View** : affiche les données à l'utilisateur.
- **Controller** : gère les requêtes (entrées/sorties) et coordonne Model et
  View.

Cette architecture sera approfondie dans les séances suivantes.

#### Convention over configuration

Laravel suit le principe de "convention plutôt que configuration". Cela signifie
que si vous suivez les conventions de nommage et de structure de Laravel, tout
fonctionne automatiquement sans configuration supplémentaire.

Par exemple, un modèle `User` cherchera automatiquement une table `users` dans
la base de données.

### Écosystème Laravel

Laravel dispose d'un riche écosystème d'outils (qui seront vus dans les séances
suivantes) :

- **Artisan** : l'interface en ligne de commande de Laravel.
- **Blade** : le moteur de templates pour les vues.
- **Eloquent** : l'ORM (Object-Relational Mapping) pour la base de données.
- **Middleware** : filtrage des requêtes HTTP.
- Et plus encore !

Nous aborderons ces outils en détail dans les prochaines séances.

### Ressources et aide

Laravel dispose d'un riche écosystème de ressources pour apprendre et obtenir de
l'aide :

- Documentation officielle.
- Communauté active.
- Dépôts GitHub.

Durant le cours, ces différentes ressources seront utilisées pour approfondir
vos connaissances.

#### Documentation officielle

- [Documentation Laravel](https://laravel.com/docs) : la documentation
  officielle, complète et régulièrement mise à jour.
- [Laravel News](https://laravel-news.com/) : actualités, tutoriels et packages
  de la communauté.
- [Laracasts](https://laracasts.com/) : plateforme de vidéos tutoriels (certains
  gratuits).

#### Communauté

- [Laravel.io](https://laravel.io/) : forum officiel de la communauté Laravel.
- [Reddit r/laravel](https://www.reddit.com/r/laravel/) : discussions et
  partages de la communauté.
- [Discord Laravel](https://discord.gg/laravel) : serveur Discord officiel pour
  discussions en temps réel.

#### Dépôts GitHub

- [laravel/laravel](https://github.com/laravel/laravel) : le dépôt principal du
  framework.
- [Awesome Laravel](https://github.com/chiraggude/awesome-laravel) : liste de
  ressources Laravel.

### Laravel, des briques LEGO parfois un peu magiques

Laravel (ou tout autre framework web) fournit de nombreuses fonctionnalités qui
simplifient le développement, mais qui peuvent parfois dérouter les débutant.es
et sembler "magiques".

A votre niveau, il n'est pas nécessaire de comprendre en détail le
fonctionnement interne de chaque fonctionnalité de Laravel. Cependant, il est
important de savoir où trouver des informations et de la documentation pour
approfondir vos connaissances au besoin.

De plus, au fur et à mesure que vous progresserez dans le cours, nous
expliquerons le fonctionnement de certaines de ces fonctionnalités "magiques"
pour mieux comprendre ce qui se passe en coulisses.

Il se peut que certains aspects de Laravel restent obscurs au début (voir même à
la fin du cours). C'est normal et fait partie de l'apprentissage. Avec le temps
et la pratique, vous gagnerez en compréhension et en maîtrise de ce puissant
framework.

Si tout n'est pas clair immédiatement, ne vous inquiétez pas : l'important est
de savoir où chercher l'information et comment apprendre par vous-même.

### Installation de Laravel

Laravel s'installe via Composer :

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

Voici les principaux dossiers d'un projet Laravel :

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

Nous aborderons la structure en détail au fur et à mesure du cours. Pour
l'instant, retenez que le dossier `app/` contient le code principal de
l'application, le dossier `routes/` contient les définitions des routes (les
entrées/sorties de l'application) et le dossier `resources/` contient les vues
et les ressources front-end.

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

Il est important de comprendre les rôles distincts de PHP, Composer et Laravel :

| Élément  | Rôle                        |
| :------- | :-------------------------- |
| PHP      | Le langage de programmation |
| Composer | Le gestionnaire de paquets  |
| Laravel  | Le framework                |

### PHP : le langage

PHP (PHP: Hypertext Preprocessor) est un langage de programmation côté serveur.
Il permet d'exécuter du code sur le serveur et de générer du contenu dynamique.

### Composer : le gestionnaire de dépendances

Composer gère les librairies externes. Il n'exécute pas de code, il organise et
télécharge les dépendances de votre projet.

### Laravel : le framework

Laravel est un framework PHP complet qui fournit une structure et des outils
pour développer des applications web. Il est lui-même installé via Composer et
utilise de nombreuses librairies gérées par Composer.

```text
PHP (langage)
    └── Composer (gestionnaire)
            └── Laravel (framework)
                    └── Votre application
```

## Lien avec JavaScript et npm

Si vous avez déjà travaillé avec JavaScript et Node.js, vous remarquerez de
nombreuses similitudes avec l'écosystème PHP.

De plus, Laravel intègre et s'intègre souvent avec des outils JavaScript (comme
Webpack/Vite) pour la gestion de certains aspects front-end.

Cette section résume les parallèles entre les deux mondes pour faciliter votre
apprentissage.

| Concept                       | PHP                | JavaScript          |
| :---------------------------- | :----------------- | :------------------ |
| Gestionnaire de paquets       | Composer           | npm                 |
| Dépôt de paquets              | Packagist          | npmjs.com           |
| Frameworks web populaires     | Laravel, Symfony   | Express, React      |
| Fichier de configuration      | `composer.json`    | `package.json`      |
| Fichier de verrouillage       | `composer.lock`    | `package-lock.json` |
| Dossier des dépendances       | `vendor/`          | `node_modules/`     |
| Ajouter une dépendance        | `composer require` | `npm install`       |
| Installer les dépendances     | `composer install` | `npm install`       |
| Mettre à jour les dépendances | `composer update`  | `npm update`        |

Nous allons éviter de mélanger les deux écosystèmes dans ce cours, mais il est
utile de comprendre les parallèles.

Il n'est pas impossible que nous utilisions occasionnellement des outils
JavaScript pour le front-end dans les projets Laravel.

## Conclusion

Dans cette séance, nous avons vu :

- La différence entre PHP vanilla et l'utilisation de librairies externes, avec
  l'exemple de `mail()` vs PHPMailer.
- Comment Composer permet de gérer les dépendances d'un projet PHP.
- Les principes de base de Laravel et sa structure de projet.
- Les rôles distincts de PHP (langage), Composer (gestionnaire) et Laravel
  (framework).
- Le lien entre l'écosystème PHP/Composer et l'écosystème JavaScript/npm.

Ces fondamentaux sont essentiels pour la suite du cours, où nous approfondirons
l'architecture MVC, le système de templating Blade, et l'ORM Eloquent.

## Mini-projet

Nous vous invitons maintenant à réaliser le mini-projet de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les détails du mini-projet ici :
[Mini-projet](./01-mini-projet/README.md).

## Exercices

Nous vous invitons maintenant à réaliser les exercices de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les exercices et leur corrigé ici :
[Exercices](./02-exercices/README.md).

## À faire pour la prochaine séance

Chaque personne est libre de gérer son temps comme elle le souhaite. Cependant,
il est recommandé pour la prochaine séance de :

- Relire le support de cours si nécessaire.
- Finaliser les exercices qui n'ont pas été terminés en classe.
- Finaliser la partie du mini-projet qui n'a pas été terminée en classe.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
[presentation-web]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/02-php-composer-et-laravel/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/02-php-composer-et-laravel/02-php-composer-et-laravel-presentation.pdf
