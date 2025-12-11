# Présentation

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Présentation de `Laravel`](#présentation-de-laravel)
  - [Qu’est-ce que `Laravel` ?](#quest-ce-que-laravel-)
  - [Pourquoi utiliser `Laravel` ?](#pourquoi-utiliser-laravel-)
  - [Que fait `Laravel` ?](#que-fait-laravel-)
  - [Voici quelques-unes des fonctionnalités les plus importantes](#voici-quelques-unes-des-fonctionnalités-les-plus-importantes)
  - [Résumé](#résumé)
- [Installation sur `Mac`](#installation-sur-mac)
  - [Installation de `Xcode`](#installation-de-xcode)
  - [Installation de Homebrew](#installation-de-homebrew)
  - [Installation de `php`, `composer`et un éditeur de texte `macVim`](#installation-de-php-composeret-un-éditeur-de-texte-macvim)
- [Installation sur `Windows`](#installation-sur-windows)
  - [Installation de `php` 8](#installation-de-php-8)
  - [Installation de `Composer`](#installation-de-composer)
- [Pratique](#pratique)
  - [Installation](#installation)
  - [Création d'un squelette d'application `Laravel` (`Windows` et `Mac`)](#création-dun-squelette-dapplication-laravel-windows-et-mac)
  - [Repérer les répertoires et fichiers de bases de `Laravel`](#repérer-les-répertoires-et-fichiers-de-bases-de-laravel)
  - [Changer le comportement d'une application `Laravel`](#changer-le-comportement-dune-application-laravel)
  - [Résumé](#résumé-1)

Le développement d’applications web et de sites est devenu de plus en plus
simple ces dernières années. Même les plus novices en matière de technologie
sont devenus assez habiles avec des produits tels que `WordPress` et `Wix`.

Pour les développeurs plus avancés, il existe une multitude d’outils permettant
de simplifier le processus de développement. L’un de ces outils les plus utiles
est `Laravel`.

## Objectifs

À l'issue de ce cours, les personnes qui étudient devraient être capables de :

- Installer un environnement de développement Laravel.
- Créer un squelette d'application Laravel à l'aide de la ligne de commande.
- Repérer et comprendre l'organisation des répertoires et fichiers de base de
  Laravel.
- Modifier le comportement d'une application Laravel en manipulant les routes.
- Comprendre et appliquer le motif d'architecture MVC utilisé par Laravel.
- Gérer la création et l'affichage des vues avec le moteur de template Blade.
- Transmettre et exploiter des données entre les routes et les vues.
- Utiliser les fonctionnalités de base de Laravel pour simplifier le
  développement web.

De plus, les personnes qui étudient devraient avoir pu :

- Installer un environnement de développement Laravel
- Créer un squelette d'application Laravel à l'aide de la ligne de commande

## Présentation de `Laravel`

### Qu’est-ce que `Laravel` ?

#### `Laravel` est un `framework PHP` multi-plateforme permettant de créer des applications web

`Laravel` permet à un développeur de tirer parti d’une vaste bibliothèque de
fonctionnalités pré-programmées (telles que l’authentification, le routage et la
création de modèles HTML). L’accès à cette bibliothèque simplifie la création
rapide d’applications web robustes tout en minimisant la quantité de code
nécessaire.

`Laravel` offre un environnement de développement très fonctionnel, ainsi que
des interfaces de ligne de commande intuitives et expressives. En outre,
`Laravel` utilise le mapping objet-relationnel (ORM) pour simplifier l’accès et
la manipulation des données.

> Le **mapping objet-relationnel** (en anglais **object-relational mapping** ou
> **ORM**) est un type de programme informatique qui se place en interface entre
> un programme applicatif et une
> [base de données relationnelle](https://fr.wikipedia.org/wiki/Base_de_données_relationnelle)
> pour simuler une
> [base de données orientée objet](https://fr.wikipedia.org/wiki/Base_de_données_orientée_objet).

Les applications `Laravel` sont hautement évolutives et leur base de code est
facile à maintenir. Les développeurs peuvent également ajouter des
fonctionnalités à leurs applications de manière transparente, grâce au système
de packaging modulaire de `Laravel` et à la gestion robuste des dépendances.

#### `Laravel` est un `framework` PHP basé sur les principes de la programmation orientée objet (POO)

Un `framework` fournit un ensemble de bibliothèques de code contenant des
modules préprogrammés qui permettent à un utilisateur de construire des
applications plus rapidement. Il offre aux développeurs web un certain nombre
d’avantages, notamment un développement plus rapide, un besoin réduit d’écrire
du code et une sécurité renforcée. Il aide également les développeurs novices à
acquérir de bonnes pratiques de code, car ils exigent une organisation
spécifique du code. Les `frameworks` nécessitent généralement moins de
maintenance que les applications créées de toutes pièces. Comme `Laravel` est un
`framework` PHP orientés objet, il est utile d’avoir une compréhension de base
des concepts tels que les classes, les objets, l’héritage, le polymorphisme
avant de se plonger dedans.

#### PHP est un langage de script

PHP (acronyme récursif de `PHP Hypertext Preprocessor`) est un langage de script
open source, côté serveur, largement utilisé pour le développement web. (Selon
les données de [W3Techs](https://w3techs.com/), au début de l’année 2021, près
de 80 % des sites web utilisaient PHP.) Les applications créées à l’aide de
langages de script sont compilées au moment de l’exécution, ce qui signifie que
chaque instruction est interprétée individuellement au moment de l’exécution, ce
qui rend l’application plus lente qu’une application pré-compilée. La
compilation au moment de l’exécution entraîne également l’arrêt ou la fermeture
de l’application si elle rencontre une erreur au moment de l’exécution; en
revanche, les applications pré-compilées effectuent un contrôle des erreurs
pendant la compilation, ce qui les rend plus robustes au moment de l’exécution.
Pour de nombreux utilisateurs, cependant, les inconvénients des langages de
script sont plus que compensés par leur facilité d’utilisation.

#### `Laravel` est-il Frontend ou Backend ?

`Laravel` est principalement un `framework` de développement Backend, bien qu’il
offre quelques fonctionnalités Frontend.

#### `Laravel` utilise le motif d'architecture logicielle MVC (Modèle-Vue-Contrôleur)

Le modèle est constitué des données de l’application, ainsi que de toute la
logique associée. (Ex : Une liste d’abonnés) La vue fournit un point
d’interaction avec un utilisateur, où les données du modèle peuvent être
visualisées et modifiées. Le contrôleur est un conduit entre la vue et le
modèle. En d’autres termes, le contrôleur prend les requêtes de l’utilisateur,
récupère les informations requises dans le modèle, les traite et les renvoie à
la vue.

![mvc](./images/mvc.png)

### Pourquoi utiliser `Laravel` ?

Voici quelques-uns des avantages spécifiques de `Laravel` :

- #### `Laravel` est facile à apprendre

  > pour qui possède :
  >
  > - Compréhension générale des concepts de Programmation Orientée Objet (POO)
  > - Notions de HTML.
  > - Compréhension des systèmes de gestion de bases de données relationnelles
  >   (MySQL, PostgreSQL)

- #### `Laravel` simplifie le processus de développement

  `Laravel` a été conçu pour simplifier les tâches communes à de nombreux
  projets de développement web, comme le routage, l’authentification, la
  migration, la mise en cache, etc. `Laravel` permet d’intégrer facilement des
  modules préfabriqués dans une application, à l’aide d’interfaces intuitives et
  expressives de la ligne de commande et du gestionnaire de dépendances
  [Composer](https://getcomposer.org/).

  `Laravel` dispose également d’une
  [documentation en ligne](https://laravel.com/docs/11.x), qui constitue un bon
  point de départ pour les développeurs plus expérimentés. Une grande variété de
  ressources d’apprentissage en ligne destinées à tous les niveaux de compétence
  est également disponible.

- #### `Laravel` dispose d’outils pour les développeurs de tous les niveaux

  `Laravel` est un `framework` progressif, ce qui signifie qu’il inclut une
  variété de fonctionnalités que les utilisateurs de tous niveaux trouveront
  utiles. Par exemple, les débutants ont accès à des kits de démarrage pour des
  modules tels que les fonctions d’authentification de base. Les utilisateurs
  plus expérimentés peuvent tirer parti des moteurs sous-jacents aux kits de
  démarrage pour construire leurs propres processus d’authentification et les
  intégrer à leur Frontend préféré.

- #### `Laravel` évolue facilement

  `Laravel` est hautement évolutif. Grâce à la prise en charge intégrée de
  systèmes de cache rapides et distribués, les applications `Laravel` sont
  capables de traiter des millions de requêtes par mois. `Laravel` propose
  également une plateforme de déploiement sans serveur, `Vapor`, qui est basée
  sur AWS (Amazon Web Service) et offre un haut degré d’évolutivité.

- #### `Laravel` dispose d’un écosystème et d’une communauté massive

  `Laravel` dispose d’un formidable écosystème soutenu par une vaste communauté
  de développeurs.

  `Laravel` étant l’un des `frameworks` PHP les plus utilisés, la bibliothèque
  d’applications et de paquets `Laravel` disponibles est importante. Les paquets
  officiels `Laravel` et les paquets tiers sont facilement disponibles.

  Les paquets officiels de `Laravel` comprennent l’authentification, la gestion
  des serveurs, la facturation des abonnements, les tests et l’automatisation
  des navigateurs, etc. Des packages tiers sont disponibles sur un certain
  nombre de sites, notamment [`Packalyst`](https://packalyst.com/) et
  [`Laravel News`](https://laravel-news.com/category/packages).

  Les développeurs qui ont des questions trouveront certainement une réponse en
  visitant l’un des nombreux forums :

  - [`Laravel.io`](https://laravel.io/)
  - [`Reddit`](https://www.reddit.com/r/laravel/)
  - [`Laracasts`](https://laracasts.com/)

- #### `Laravel` est largement utilisé

  De nombreuses entreprises utilisent `Laravel` pour créer des sites web
  hautement fonctionnels :

  - [`Vacations by Rail`](https://www.vacationsbyrail.com/) est un site de
    planification de voyages en train.
  - [`Setapp`](https://setapp.com/), qui propose des applications pour Mac et
    iOS.
  - [`Restaurants.com`](https://www.restaurants.com/) très intuitif à utiliser.

### Que fait `Laravel` ?

### Voici quelques-unes des fonctionnalités les plus importantes

#### Traitement des routes

`Laravel` offre une gestion des routes simple et intuitive, en utilisant des
noms simples pour identifier les routes plutôt que de longs noms de chemin.
L’utilisation d’identificateurs de route facilite également la maintenance des
applications, car le nom de la route peut être modifié à un seul endroit plutôt
que de devoir le changer partout. Toutes les routes de l’interface web d’une
application `Laravel` sont enregistrées dans le fichier `routes/web.php`.

#### Sécurité

`Laravel` comprend un
[certain nombre de fonctions de sécurité](https://iwconnect.com/laravel-security-features/),
notamment l’authentification des utilisateurs, l’autorisation des rôles des
utilisateurs, la vérification des e-mails, les services de cryptage, le hachage
des mots de passe et les fonctions de réinitialisation des mots de passe.

#### Migration

`Laravel` fournit un contrôle de version pour les bases de données
d’applications en utilisant les migrations. Les migrations permettent de suivre
la façon dont une base de données a été modifiée au fil du temps, ce qui
facilite la destruction ou la recréation de la base de données si nécessaire.

#### Templating

Blade est le moteur de templating PHP de `Laravel`. Les moteurs de modèles PHP
[permettent de séparer la logique métier](https://kinsta.com/fr/base-de-connaissances/qu-est-ce-que-php/)
des modèles HTML, ce qui permet d’obtenir une base de code plus facile à
maintenir. De nombreuses fonctionnalités de `Laravel` reposent sur les modèles
Blade. Blade offre plus de fonctionnalités que les autres moteurs de création de
modèles car il permet d’utiliser du code PHP simple, ce que les autres ne font
pas.

#### Sessions

`Laravel` utilise des sessions pour stocker des informations sur l’utilisateur à
travers plusieurs requêtes.

#### Validation des données

`Laravel` simplifie la
[validation des données utilisateur entrantes](https://en.wikipedia.org/wiki/Data_validation).
`Laravel` comprend un certain nombre de règles de validation des données, avec
des messages d’erreur personnalisables.

#### Traitement du cache

`Laravel` prend en charge la mise en cache des données afin de minimiser les
temps de traitement des tâches applicatives. L’API de mise en cache de `Laravel`
prend en charge une variété de backends de cache tiers tels que
[`Memcached`](https://memcached.org/) et
[`Redis`](https://redis.io/topics/introduction).

#### Traitement des erreurs

La gestion des erreurs est automatiquement configurée au démarrage d’un nouveau
projet `Laravel`. Les applications `Laravel` peuvent être
[exécutées en mode débogage](https://pineco.de/debugging-in-laravel/), générant
des messages d’erreur détaillés pour toutes les erreurs qui se produisent.

#### Tests

`Laravel` offre d’emblée d’importantes fonctionnalités de test. `Laravel` prend
en charge les tests unitaires, qui testent de petites sections isolées du code
de l’application, ainsi que les tests de fonctionnalités, qui testent des
sections plus importantes du code et des fonctionnalités de plus haut niveau.

#### Stockage et gestion des fichiers

`Laravel` utilise le paquetage
[`Flysystem`](https://flysystem.thephpleague.com/docs/) pour fournir des pilotes
permettant de travailler avec une variété de systèmes de fichiers, depuis les
systèmes de fichiers locaux jusqu’au stockage sur le cloud comme
[Amazon S3](https://kinsta.com/fr/base-de-connaissances/amazon-s3-wordpress/).
`Laravel` permet également le transfert de fichiers avec le protocole de
transfert de fichiers SSH (SFTP).

#### E-mail

`Laravel` comprend une API d’e-mail basée sur la bibliothèque `SwiftMailer`, qui
permet d’envoyer des e-mails via le service de son choix. `Laravel` prend en
charge les pièces jointes et la mise en file d’attente des e-mails.

#### Notifications

`Laravel` prend en charge l’envoi de notifications via un certain nombre de
canaux, qu’il s’agisse de canaux connus tels que SMS ou Slack, ou de canaux
développés par la communauté `Laravel`.

### Résumé

`Laravel` fournit un ensemble étendu et robuste de ressources qui simplifient le
processus de développement en éliminant la nécessité de coder de nombreuses
tâches courantes.

Que vous soyez débutant-e ou expert-e en développement d'application web,
`Laravel` est un `framework` de choix.

## Installation sur `Mac`

### Installation de `Xcode`

Se rendre dans l'`App Store` et installer `Xcode`

> Remarque : Prévoir du temps...

Lancer `Xcode`, qui va installer les derniers composants nécessaires. Fermer
`Xcode`. Redémarrer.

### Installation de Homebrew

Se rendre à l'url <https://brew.sh/fr/>

Lancer un `terminal` sur mac.

> Pour lancer un `terminal` vous avez différentes options :
>
> - Si vous avez activé `Spotlight` (ou un programme similaire `Alfred`),
>   appuyez sur `COMMAND` + `ESPACE` puis tapez `terminal`
> - Lancez le `Finder`, puis dans le menu `Aller` choisissez l'option
>   `Utilitaires`, puis cliquez sur le programme `Terminal`
> - Dans `Application`, ouvrir le répertoire nommé `Utilitaires`, puis cliquez
>   sur le programme `Terminal`
> - Dans `Application`, ouvrir le répertoire nommé `Utilitaires`,
>   glissez-déposez le programme `Terminal` dans le `Dock`. Du coup, il suffira
>   de cliquez sur l'icône dans le `Dock`
> - Ouvrir `Lauchpad` et dans la partie recherche tapez `Terminal`, puis cliquez
>   sur le programme `Terminal`
> - Demandez à `Siri` de lancer le `Terminal`

Une fois dans le `Terminal` lancez la commande (!!!!!! le tout sur 1 seule ligne
:

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Entrez votre mot de passe et patientez durant l'installation (cela prend un peu
de temps)

### Installation de `php`, [`composer`](https://getcomposer.org/doc/00-intro.md)et un éditeur de texte [`macVim`](https://www.vim.org/)

Toujours depuis le `terminal`, installez `php`, `composer` et `macvim` à l'aide
de la commande :

```bash
brew install php composer macvim
```

Patientez durant l'installation de ces trois outils.

Pour vous assurer que `php` est installé correctement tapez :

```bash
php --version
```

ou

```bash
php -v
```

> PHP est installé dans `/usr/bin/` pour y accéder depuis le `finder` : Aller
> dans le menu "Aller" puis "Aller au dossier..." puis taper `/usr/bin/`)

Pour savoir où est le fichier `php.ini`

```bash
php --ini
```

Pour s'assurer que `Composer` est installé, taper :

```bash
composer
```

#### Installation de [`Valet`](https://laravel.com/docs/10.x/valet#:~:text=Laravel%20Valet%20is%20a%20development,background%20when%20your%20machine%20starts.&text=In%20other%20words%2C%20Valet%20is,roughly%207%20MB%20of%20RAM.) à l'aide de `Composer`

```bash
composer global require laravel/valet
```

#### Installation du générateur de squelette d'application `Laravel`

```bash
composer global require laravel/installer
```

Les commandes :

```bash
laravel
```

et

```bash
valet
```

ne répondent peut-être pas... (c'est normal !)

Il reste à indiquer à notre `Mac` dans quels répertoires il doit chercher ces
commandes. Afin de pouvoir configurer correctement note `Mac`, il faut savoir
quel est le terminal utilisé.

> Le mac peut utiliser deux type de terminal :
>
> - `z shell (zsh)` utilisé par défaut sur les `Mac` les plus récents.
> - `bash` utilisé par défaut sur les anciens `Mac`
>
> Pour connaître le terminal utilisé, il suffit de lancer une commande que le
> `mac`ne connaît pas et de jeter un œil au message d'erreur
>
> tapons :
>
> ```bash
> whoareyou
> ```
>
> Si on obtient le message :
>
> ```bash
> zsh : command not found : whoareyou
> ```
>
> C'est que le terminal est `zsh` .
>
> Si par contre on obtient le message suivant :
>
> ```bash
> -bash: whoareyou: command not found
> ```
>
> c'est que le terminal est `bash`.
>
> Pour simplifier la configuration du `Mac`, nous allons utiliser `zsh`
>
> Si le terminal utilisé est un `bash`, voici la commande permettant de passer à
> `zsh`
>
> ```bash
> chsh -s $(which zsh)
> ```

Pour indiquer à notre `Mac` dans quel répertoire il doit chercher les commandes
`laravel` et `valet`, il faut éditer (ou créer) un fichier nommé `.zprofile`
dans notre répertoire de base (maison). Or, les fichiers commençant par un point
(.) sont par cachés par défaut par notre `Mac`. Pour pouvoir visualiser ces
fichiers, lancez la commande suivante :

```bash
defaults write com.apple.finder AppleShowAllFiles TRUE
```

Puis, pour fermer tous les `Finder` qui seraient ouvert, lancez la commande

```bash
killall Finder
```

Ouvrez maintenant un nouveau `Finder`, et déplacez vous dans le répertoire de
base (icône maison) qui porte normalement votre nom.

> Sinon, dans le menu du haut choisissez `Aller` puis `Allez au dossier...` et
> tapez :
>
> ```bash
> ~/
> ```
>
> Le tilde (~) s'obtient à l'aide de la combinaison de touche `OPTION` et `N`
> puis espace.

Les fichiers cachés sont maintenant visibles

Pour éditer ou créer le fichier
`.zprofile nous allons utiliser l'éditeur de texte`macvim`fraîchement installé. Dans un`terminal`,
lancez la commande :

```bash
mvim ~/.zprofile
```

> Le tilde (~) s'obtient toujours à l'aide de la combinaison de touche `OPTION`
> et `N`

Un carré noir clignote. Pour passer en mode `insertion`, tapez la touche `i` de
votre clavier.

Ajoutez la ligne suivante (export...) :

```bash
export PATH="$HOME/.composer/vendor/bin:$PATH"
```

Pour quitter le mode `insertion` tapez la touche `ESC` (Le carré noir devrait à
nouveau clignoter), puis pour sauver et quitter, tapez les 3 (TROIS) lettres
suivantes :

```bash
:wq
```

Pour que notre `Mac` puisse "voir" le nouveau chemin, il faut fermer la fenêtre
du `terminal` puis ouvrir un nouveau `terminal`.

La commande :

```bash
laravel
```

devrait maintenant fonctionner.

Ainsi que la commande :

```bash
valet
```

> Cette commande nécessite votre mot de passe (ou taper `CTRL` et `C` pour
> quitter `valet`.

Voilà, tout est prêt.

## Installation sur `Windows`

### Installation de `php` 8

Téléchargez (<https://www.php.net/downloads.php>) la dernière version stable de
`php 8`

Dézippez le fichier et ajoutez le répertoire `php-8.x` dans un dossier nommé
`PHP` à la racine de votre disque `c:\` ou dans `program files`

> Exemple :
>
> ```bash
> C:\PHP\PHP-8.x
> ```
>
> ou
>
> ```bash
> C:\Program Files\PHP\PHP-8.x
> ```

### Installation de `Composer`

Téléchargez la dernière version du gestionnaire de libraire `Composer`
(<https://getcomposer.org/download/>)

Suivez les étapes et veillez à choisir la bonne version de `php`

> Remarques :
>
> - Ne cochez pas la case `Developer mode`
> - Cochez la case `Add this PHP to your path`
> - Ne cochez pas la case `Use a proxy server to connect to Internet`

#### Configuration du fichier php.ini

Pour savoir où est le fichier `php.ini`

```bash
php --ini
```

Ouvrez le fichier `php.ini` et :

- Mettre la variable `display_errors` à `On` (ligne ~503)

```bash
display_errors = On
```

et activez les extensions suivantes : (ligne ~923)

- fileinfo
- intl
- pdo_mysql
- pdo_sqlite

#### Installation du créateur de squelette d'application `Laravel`

Dans une fenêtre de type `invite de commande` (Cliquez sur l'icône `windows` en
bas à gauche de votre écran et tapez : cmd ) Lancez la commande :

```bash
composer global require "laravel/installer"
```

> Remarque :
>
> - Les fichiers seront installés dans
>   c:\\users\\VOTRE_NOM\\AppData\\Roaming\\Composer\\...

Voilà, tout le nécessaire a été installé.

## Pratique

Objectifs du jour :

- Installer le nécessaire pour pouvoir créer des applications `Laravel`.
  - Installation de PHP (8.x)
  - [`Composer`](https://getcomposer.org/doc/00-intro.md) (gestionnaire de
    paquet)
  - `laravel/installer` (Pour créer le squelette d'une application `Laravel`)
- Créer un squelette d'application `Laravel` à l'aide de la ligne de commande.
- Repérer les répertoires et fichiers de bases de `Laravel` (`routes\web.php`,
  `resources\views\`)
- Changer le comportement d'une application `Laravel`.

### Installation

- Mac : Exécutez la marche à suivre indiquée dans le fichier :
  `01_Install_Laravel_Mac`

- Windows : Exécutez la marche à suivre indiquée dans le fichier :
  `01_Install_Laravel_Windows`

### Création d'un squelette d'application `Laravel` (`Windows` et `Mac`)

A l'aide du `terminal` (Mac) ou de l'invite de commande `cmd` (Windows) se
déplacer dans le répertoire désiré

> Voici deux liens pour accéder aux aides mémoires pour les commandes de base
> des différents terminaux :
>
> - [Windows](https://github.com/draperjames/windows-cmd-cheat-sheet)
> - [Mac](https://github.com/0nn0/terminal-mac-cheatsheet/tree/master/Fran%C3%A7ais)

puis taper :

```bash
laravel new monApp1/laravel
```

L'installeur vous demande alors de répondre à quelques questions :

```bash
Would you like to install a starter kit? [No starter kit]:
  [none     ] No starter kit
  [breeze   ] Laravel Breeze
  [jetstream] Laravel Jetstream
```

Tapez sur la touche "return" pour indiquer qu'on ne désire pas de "starter kit".

```bash
Which testing framework do you prefer? [Pest]:
  [0] Pest
  [1] PHPUnit
```

Tapez sur la touche "return" pour indiquer qu'on désire utiliser `Pest` comme
outil de `testing`.

```bash
Would you like to initialize a Git repository? (yes/no) [no]:
```

Tapez sur la touche "return" pour indiquer qu'on ne désire pas utiliser `Git`
pour l'instant.

```bash
Which database will your application use? [MySQL]:
  [mysql  ] MySQL
  [mariadb] MariaDB
  [pgsql  ] PostgreSQL
  [sqlite ] SQLite
  [sqlsrv ] SQL Server
```

Tapez sur la touche "return" pour indiquer qu'on désire utiliser `MySQL` comme
SGBD.

Voilà, le squelette d'une nouvelle application `Laravel` a été créé

Concrètement, il s'agit d'un répertoire `monApp1` contenant un sous-répertoire
`laravel` qui contient tous les répertoires et fichiers constituant le squelette
d'une application de base qui fonctionne.

Pour rendre l'application disponible via un browser, il suffit de se déplacer en
ligne de commande dans le répertoire `monApp1/laravel` et taper la commande :

```bash
php artisan serve
```

> Remarque : Si besoin, on peut choisir le port
>
> ```bash
> php artisan serve --port=8080
> ```
>
> (Le port par défaut est le port : 8000)

Un message nous indique que l'application est disponible :
<http://127.0.0.1:8000>

Il suffit de lancer un browser et de taper comme adresse :

```bash
localhost:8000
```

ou

```bash
127.0.0.1:8000
```

> `localhost` est l'équivalent de l'adresse IP : 127.0.0.1

Pour stopper l'application, il suffit de faire `CRTL` + `C` dans la fenêtre
correspondante à la ligne de commande ou simplement fermer la fenêtre.

### Repérer les répertoires et fichiers de bases de `Laravel`

Liste des répertoires :

- `app` : Modèles, contrôleurs, gestionnaires d'application, d'exceptions, etc.
- `bootstrap` : Scripts d'initialisation de l'application.
- `config` : Toutes les configurations (base de données, authentification,
  emails, sessions, etc.)
- `database` : Migrations et populations.
- `public` : Dossier public du site (images, `css`, scripts, fichier :
  `index.php`)
- `resources` : Vues, fichiers de traductions (langues)
- `routes` : Point d'entrée de l'application.
- `storage` : Données temporaires de l'application (vues compilées, clés de
  session, etc.)
- `tests` : Fichiers de tests unitaires
- `vendor` : tous les composants `Laravel` et ses dépendances

Le fichier de base se trouve dans le répertoire "routes", il s'agit du fichier
`web.php`

Voici son contenu :

```php
Route::get('/', function () {
	return view('welcome');
});
```

La vue `welcome` se trouve dans le répertoire `resources/views`, il s'agit du
fichier `welcome.blade.php`

### Changer le comportement d'une application `Laravel`

Familiarisons-nous d'abord avec le concept de routes.

Créons d'autres routes :

```php
Route::get('/', function () {
	return view('welcome');
});

Route::get('/1', function () {
	return 'page 1';
});
Route::get('/2', function () {
	return 'page 2';
});
Route::get('/3', function () {
	return 'page 3';
});
```

et testons-les !

Lançons l'application et ajoutons /1 à l'URL de notre navigateur.

​ `http://localhost:8000/1`

Le texte `page 1` devrait être maintenant visible dans le browser.

Répétons l'opération pour voir la page 2 et 3.

Remplaçons les trois routes précédentes par celle-ci :

```php
Route::get('/', function () {
	return view('welcome');
});

//...

Route::get('/{n}', function ($n) {
	return "page $n";
})->where('n', '[1-3]');
```

Pour contrôler la validité du paramètre 'n' on passe par une
[expression régulière](https://fr.wikipedia.org/wiki/Expression_r%C3%A9guli%C3%A8re)
[1-3] qui signifie 1,2 ou 3.

> Voici un lien vous permettant de vous familiariser avec les expressions
> régulières :
> [regex](https://zestedesavoir.com/tutoriels/3651/les-expressions-regulieres-1/)

Attention à la syntaxe qui est particulière ! {n}, $n et n... Il y a de quoi
s'embrouiller au début. ;-)

Nous pouvons ajouter quelques commande `php` dans la fonction :

```php
Route::get('/', function () {
	return view('welcome');
});

//...

Route::get('/afficheDate', function () {
	$date = now();
	echo 'Voici le détail de la variable $date : ' . '<br>';
	echo '<br>';
	var_dump($date);
	echo '<br><br>';
	echo "Aujourd'hui, nous sommes le " . $date;
});
```

Pour afficher le contenu d'une variable la commande dd(...) est très pratique :

```php
Route::get('/', function () {
	return view('welcome');
});

//...

Route::get('/afficheDate2', function () {
	$date = now();
	dd($date);
});
```

> Remarque : `dd(...)` signifie dump and die, c'est à dire que tout s'arrête
> après la commande ;-)

Il est possible de rediriger une route sur une url. Voici comment procéder :

```php
//...

Route::get('/cff', function () {
	return redirect('https://www.sbb.ch/fr/');
});
```

Il est possible de donner un nom à une route.

> Cela s'avèrera très pratique pour pouvoir rediriger l'utilisateur sur la page
> de login s'il essaye d'accéder à une `url` nécessitant d'être authentifié.

```php
Route::get('/', function () {
	return view('welcome');
})->name('home');
```

et voici comment rediriger sur une route nommée :

```php
Route::get('/maison', function () {
	return redirect()->route('home');
});
```

Retenons juste pour l'instant qu'il est possible de donner un nom à une route .

Il est possible de transformer les informations relatives à une route en
paramètres. Voici comment procéder :

```php
Route::get('/uneRoute/{param1}/{param2}/{param3?}', function (
	$param1,
	$param2,
	$param3 = 'Laravel'
) {
	return $param1 . ' ' . $param2 . ' ' . $param3;
});
```

> Le point d'interrogation (?) correspond à un paramètre optionnel. Il est donc
> important de mettre une valeur par défaut à la variable correspondante.

Ainsi l'adresse : `http://localhost:8000/uneRoute/trop/bien/laravel` retournera

`trop bien laravel`

et

L'adresse : `http://localhost:8000/uneRoute/trop/bien` retournera

`trop bien laravel`

Maintenant que nous avons compris le rôle des routes, passons maintenant à celui
des vues.

Créons une vue `article.php` dans le répertoire `resources/views` :

```html
<html>
	<head>
		<title>TODO supply a title</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<div>Ma première vue</div>
	</body>
</html>
```

et changeons la route crée précédemment pour y accéder.

```php
Route::get('/{n}', function ($n) {
	return view('article');
})->where('n', '[1-3]');
```

Et testons pour voir si cela fonctionne :

```bash
localhost:8000/1
```

```bash
localhost:8000/2
```

```bash
localhost:8000/3
```

> Ne vous inquiétez pas, c'est normal que le trois `urls` ont le même
> comportement.

Voyons maintenant comment envoyer une donnée à une vue. Nous allons envoyer le
numéro $n à la vue.

Voici comment procéder :

```php
Route::get('/{n}', function ($n) {
	return view('article')->with('n', $n);
})->where('n', '[1-3]');
```

Et voici comment récupérer la donnée $n dans la vue :

```php
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>Ma première vue</div>
        <div>article : <?php echo $n; ?></div>
    </body>
</html>
```

Testons nos modifications

```bash
localhost:8000/1
```

```bash
localhost:8000/2
```

```bash
localhost:8000/3
```

#### Template Blade

`Laravel` possède un moteur de `template` nommé Blade qui va nous simplifier
l'écriture. Mettons-le en œuvre.

Pour activer le moteur de `template` il suffit de nommer nos vues avec
l'extension `.blade.php`

Renommons notre vue `article.php` en `article.blade.php` et apportons la
modification suivante :

```php
<html>

    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <div>Ma première vue</div>
        <div>article : {{$n}}</div>
    </body>
</html>
```

### Résumé

Le fichier `routes\web.php` permet de configurer les `urls` auxquelles notre
application répondra. Nous pouvons récupérer les différentes parties de nos
`urls` en les plaçant dans des variables. Nous pouvons appliquer des règles de
nommage sur des parties de nos `urls` grâce aux expressions régulières. Nous
pouvons créer des vues (`resources\view`) Nous pouvons envoyer des données
depuis une route à une vue Nous pouvons récupérer les données envoyées par une
route et les exploiter dans une vue. Nous pouvons simplifier la syntaxe PHP dans
une vue grâce au moteur de `template` Blade.
