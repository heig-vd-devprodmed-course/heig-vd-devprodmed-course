# Jour Bonus - Ressources pour les personnes apprenantes

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs pédagogiques](#objectifs-pédagogiques)
- [Projet Laravel](#projet-laravel)
	- [Collaboration \& Pérennité](#collaboration--pérennité)
	- [Librairies et dépendances](#librairies-et-dépendances)
	- [FAQ — Questions fréquentes](#faq--questions-fréquentes)
- [Workflow et Git](#workflow-et-git)
- [Mettre en place un pipeline de CI/CD pour la livraison/le déploiement continu d'applications](#mettre-en-place-un-pipeline-de-cicd-pour-la-livraisonle-déploiement-continu-dapplications)
- [Ressources](#ressources)

## Objectifs pédagogiques

À l'issue de ce cours, les personnes qui étudient devraient être capables de :

- Identifier les fichiers clés d’un projet Laravel.
- Mettre en place un environnement de développement cohérent en équipe.
- Expliquer le rôle des fichiers `.gitignore`, `.gitattributes`, `.env` et
  `.prettierrc`.
- Appliquer les bonnes pratiques pour l'installation et la gestion des
  dépendances Composer et npm.
- Mettre en place un formateur de code dans VSCode.
- Comprendre le rôle des fichiers `.lock` pour la reproductibilité.
- Distinguer les rôles des fichiers de configuration dans `.vscode/`.

## Projet Laravel

Voici un projet Laravel :

```bash
.
├── .vscode
│   ├── extensions.json
│   └── settings.json
├── app
│   ├── Http
│   ├── Models
│   └── Providers
├── artisan
├── bootstrap
│   ├── app.php
│   ├── cache
│   └── providers.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   └── session.php
├── database
│   ├── database.sqlite
│   ├── factories
│   ├── migrations
│   └── seeders
├── LICENSE
├── node_modules
│   └── ...
├── package.json
├── package-lock.json
├── phpunit.xml
├── public
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── README.md
├── resources
│   ├── css
│   ├── js
│   └── views
├── routes
│   ├── api.php
│   ├── console.php
│   └── web.php
├── storage
│   ├── app
│   ├── framework
│   └── logs
├── tests
│   ├── Feature
│   ├── Pest.php
│   ├── TestCase.php
│   └── Unit
├── vendor
│   └── ...
├── .gitattributes
├── .gitignore
├── .prettierrc
└── vite.config.js
```

### Collaboration & Pérennité

**`.vscode`** : Ce dossier contient des fichiers de configuration pour Visual
Studio Code, notamment les extensions recommandées et les paramètres spécifiques
au projet.

**`.vscode/extensions.json`** : Ce fichier contient une liste d'extensions
recommandées pour le projet. Il est utile pour les personnes qui développent qui
utilisent Visual Studio Code, car il leur permet d'installer facilement les
extensions nécessaires.

```json
{
	"extensions": [
		"DavidAnson.vscode-markdownlint", // Linting pour Markdown
		"esbenp.prettier-vscode", // Formattage de code
		"streetsidesoftware.code-spell-checker", // Vérification orthographique
		"streetsidesoftware.code-spell-checker-french", // Vérification orthographique en français
		"yzhang.markdown-all-in-one" // Outils Markdown
	]
}
```

**`.vscode/settings.json`** : Ce fichier contient des paramètres spécifiques au
projet pour Visual Studio Code. Il peut inclure des configurations pour le
formatage de code, le linting, et d'autres outils.

```json
{
	"[blade]": {
		"editor.defaultFormatter": "esbenp.prettier-vscode"
	},
	"prettier.documentSelectors": [
		"**/*.{sh,js,jsx,ts,tsx,vue,html,css,scss,less,json,md,mdx,graphql,yaml,yml,blade.php,php}"
	],
	"[php]": {
		"editor.defaultFormatter": "esbenp.prettier-vscode"
	},

	"cSpell.language": "fr,en",
	"editor.defaultFormatter": "esbenp.prettier-vscode",
	"editor.formatOnPaste": true,
	"editor.formatOnSave": true,
	"editor.renderWhitespace": "all",
	"editor.rulers": [80],
	"files.encoding": "utf8",
	"files.eol": "\n",
	"files.insertFinalNewline": true,
	"markdown.extension.toc.levels": "2..3",
	"markdownlint.config": {
		"no-duplicate-heading": {
			"siblings_only": true
		},
		"no-emphasis-as-heading": false,
		"no-hard-tabs": false,
		"no-inline-html": false
	},
	"prettier.configPath": ".prettierrc"
}
```

**`.gitignore`** : Ce fichier indique à Git quels fichiers ou dossiers ne
doivent pas être suivis. Par exemple, les fichiers générés par Composer ou npm,
comme `vendor/` et `node_modules/`, ne doivent pas être inclus dans le dépôt
Git.

```gitignore
## Linux

# Temporary files
*~

## macOS

# Files created by macOS Finder
.DS_Store

## Windows

# Windows thumbnail cache files
Thumbs.db

# Folder config file
[Dd]esktop.ini

# node_modules
node_modules/

# Laravel
... # Généré par Laravel
```

**`.gitattributes`** : Ce fichier permet de définir des attributs spécifiques
pour les fichiers dans le dépôt Git. Par exemple, il peut être utilisé pour
spécifier comment traiter les fichiers de texte, les fichiers binaires, ou
définir des règles de fusion pour certains fichiers.

```gitattributes
## .gitattributes - https://rehansaeed.com/gitattributes-best-practices/

# Set default behavior to automatically normalize line endings.
* text=auto eol=lf

# Force batch scripts to always use CRLF line endings so that if a repo is accessed
# in Windows via a file share from Linux, the scripts will work.
*.{cmd,[cC][mM][dD]} text eol=crlf
*.{bat,[bB][aA][tT]} text eol=crlf

# Force bash scripts to always use LF line endings so that if a repo is accessed
# in Unix via a file share from Windows, the scripts will work.
*.sh text eol=lf
```

**`.prettierrc`** : Ce fichier contient la configuration pour Prettier, un outil
de formatage de code. Il permet de définir des règles de style pour le code,
comme l'indentation, les espaces, et d'autres préférences de formatage.

```json
{
	"endOfLine": "lf",
	"printWidth": 80,
	"proseWrap": "always",
	"tabWidth": 2,
	"singleQuote": true,
	"useTabs": true,
	"plugins": ["prettier-plugin-blade", "@prettier/plugin-php"],
	"overrides": [
		{
			"files": ["*.php"],
			"options": {
				"parser": "php",
				"phpVersion": "8.2"
			}
		},
		{
			"files": ["*.blade.php"],
			"options": {
				"parser": "blade"
			}
		}
	]
}
```

Pourquoi utiliser des tabs ? Voici la vraie raison :
<https://www.reddit.com/r/javascript/comments/c8drjo/nobody_talks_about_the_real_reason_to_use_tabs/?utm_medium=android_app&utm_source=share>

**`.env` et `.env.example`** : Ces fichiers contiennent des informations de
configuration pour l'application. Le fichier `.env` contient les informations
sensibles, comme les clés API et les mots de passe, tandis que le fichier
`.env.example` sert de modèle pour les autres développeurs. Ils doivent créer
leur propre fichier `.env` à partir de ce modèle. Il est important de ne pas
versionner le fichier `.env` car il contient des informations sensibles. Par
contre, nous pouvons avoir le fichier `.env.example` dans le dépôt Git pour que
les autres personnes du projet puissent savoir quelles variables d'environnement
sont nécessaires pour faire fonctionner l'application.

Pourquoi utiliser des variables d'environnement ? Voici une chouette ressource :
<https://12factor.net/fr/>

**`README.md`** : Ce fichier contient des informations sur le projet, comme
comment l'installer, comment l'utiliser, et d'autres informations utiles. Il est
important de le garder à jour pour que les autres développeurs puissent
comprendre le projet rapidement.

````markdown
# Template Laravel

Ce projet est un template Laravel pour démarrer un projet rapidement, il sera
utilisé pour tous les exercices et support de cours de DévProdMéd.

## Installation pour le développement local

### Prérequis

Les prérequis suivants sont nécessaires pour lancer le projet en local :

- [PHP](https://www.php.net/downloads) (version 8.4.4 ou supérieure)
- [Laravel](https://laravel.com/docs/12.x/installation) (version 12.0 ou
  supérieure)
- [Composer](https://getcomposer.org/download/) (version 2.8.6 ou supérieure)

### Démarer l'application pour le développement en local

Ouvrez un terminal et exécutez les commandes suivantes :

```bash
# Installez les dépendances du projet
composer install

# Copiez le fichier .env.example et renommez-le en .env

## Unix
cp .env.example .env

## Windows
copy .env.example .env

# Exécutez les migrations
php artisan migrate

# Générez une clé d'application
php artisan key:generate

# Démarrez le serveur de développement
php artisan serve
```

Une fois le serveur démarré, vous pouvez accéder à l'application à l'adresse
`http://localhost:8000`.

## Mettre un formatteur de code en place dans VSCode

### Prérequis

Les prérequis suivants sont nécessaires pour mettre en place un formateur de
code dans VSCode :

- [Visual Studio Code](https://code.visualstudio.com/download) must be
  installed.
- [Node.js](https://nodejs.org/en/download/) (version 18 ou supérieure)

### Mettre en place un formateur de code dans VSCode

- Installez l'extension `esbenp.prettier-vscode` dans VSCode
- Mettez à jour les dépendances du projet avec la commande suivante :

  ```bash
  # Installez les dépendances de développement
  npm install
  ```

Si ça fonctionne, c'est grace aux fichiers `.prettierrc` et
`.vscode/settings.json` qui sont déjà configurés pour le projet.
````

### Librairies et dépendances

Quand on travaille sur un projet Laravel (ou un projet Node.js), on utilise
souvent des **bibliothèques** (aussi appelées **librairies** ou **dépendances**)
pour gagner du temps : au lieu de tout coder soi-même, on installe des outils
déjà faits pour gérer les mails, les formulaires, les validations, etc.

Mais pour que tout fonctionne bien **chez tout le monde**, il faut comprendre
**comment ces dépendances sont gérées**. C’est là que deux fichiers sont très
importants :

#### Laravel (PHP + Composer)

- **`composer.json`** : liste les dépendances nécessaires pour faire fonctionner
  votre application Laravel. Par exemple : `laravel/framework`,
  `laravel/sanctum`, `fakerphp/faker`, etc.
- **`composer.lock`** : enregistre **les versions exactes** de chaque dépendance
  installée. Grâce à ce fichier, tout le monde aura exactement les **mêmes
  versions**, ce qui évite les bugs imprévus.

**Exemple :** Quand on fait :

```bash
composer install
```

Composer lit le fichier `composer.lock` et installe exactement ce qui est
indiqué, garantissant la stabilité du projet.

> ⚠️ **À ne jamais supprimer** : le fichier `composer.lock` est crucial pour la
> pérennité et la reproductibilité du projet.

#### Node.js (npm)

- **`package.json`** : joue le même rôle que `composer.json`. Il décrit votre
  projet et indique quelles bibliothèques JavaScript sont nécessaires (`vite`,
  `tailwindcss`, `vue`, etc.).
- **`package-lock.json`** : équivalent du `composer.lock`. Il fige les versions
  exactes des bibliothèques utilisées.

> Si ces fichiers ne sont pas présents, ou mal configurés, alors votre projet
> peut marcher chez vous... mais planter chez quelqu’un d’autre !

#### Mauvaise pratique fréquente

Beaucoup de personnes débutantes installent des dépendances **en global** sur
leur machine :

```bash
npm install -g ejs sqlite3
```

Cela **fonctionne chez vous**, mais personne ne verra ces dépendances dans votre
projet. Si vous poussez votre code sur GitHub, puis quelqu’un fait :

```bash
git clone mon-projet
cd mon-projet
npm install
```

… alors le projet **plantera** car `ejs` ou `sqlite3` ne sont pas mentionnés
dans le `package.json`.

#### Bonnes pratiques pour tous les projets Laravel ou Node

- Toujours utiliser :

  ```bash
  composer require nom-du-paquet
  # ou
  npm install nom-du-module
  ```

  (sans le `-g`)

- Toujours versionner (committer) :

  - `composer.json` + `composer.lock`
  - `package.json` + `package-lock.json`

- Ne jamais supprimer les fichiers `.lock`
- Ne jamais ajouter `vendor/` ou `node_modules/` à Git (ce sont des fichiers
  générés)
- Vérifier que `.gitignore` contient bien ces répertoires

### FAQ — Questions fréquentes

**Pourquoi y a-t-il deux fichiers (`.json` et `.lock`) ?**

- Le `.json` dit **quelles dépendances** on veut.
- Le `.lock` dit **exactement quelles versions** ont été installées (y compris
  les dépendances des dépendances).

**Pourquoi ne faut-il pas supprimer `composer.lock` ou `package-lock.json` ?**

Parce que ce sont eux qui assurent que **tout le monde a exactement la même
version** du projet. Sans eux, une personne pourrait avoir une version
différente d’une bibliothèque... et tout casser sans le savoir.

**Pourquoi `vendor/` et `node_modules/` ne sont jamais dans Git ?**

Parce que ce sont des dossiers générés automatiquement à partir des fichiers
`.lock`. Les mettre sur Git rend le dépôt énorme et inutilement compliqué.

## Workflow et Git

Que vos projets soient petits ou grands, il est essentiel d'avoir un bon
workflow de développement. Cela vous aide à rester organisé et à documenter
votre travail.

Dès que vous avez une idée ou une tache à réaliser, créez une **issue** sur
GitHub. Cela vous permet de garder une trace de ce que vous devez faire et
d'éviter de perdre des idées. Une fois que vous avez créé une issue, créez une
**branche** pour travailler dessus. Cela vous permet de garder votre code
organisé et de ne pas mélanger différentes tâches.

Une fois que vous avez terminé votre tâche, ouvrez une **pull request**. Cela
vous permet de demander à une personne d'examiner votre code avant de l'ajouter
au projet principal. Cela permet de s'assurer que le code est de bonne qualité
et qu'il ne casse rien. Une fois que la pull request est approuvée, vous pouvez
la fusionner dans la branche principale.

Voici un exemple de workflow de développement :

1. Créez une issue sur GitHub pour la tâche que vous devez réaliser.
2. Créez une branche pour travailler sur cette tâche.
3. Travaillez sur la tâche et faites des commits réguliers.
4. Ouvrez une pull request pour demander à une personne d'examiner votre code.
5. Une fois que la pull request est approuvée, fusionnez-la dans la branche
   principale.
6. Supprimez la branche une fois la pull request fusionnée.

Plus de détails sur le workflow GitFlow :
<https://www.atlassian.com/fr/git/tutorials/comparing-workflows/gitflow-workflow>

## Mettre en place un pipeline de CI/CD pour la livraison/le déploiement continu d'applications

Je vous invite à regarder le support de cours suivants :
[MVP - Mettre en place un pipeline de CI/CD pour la livraison/le déploiement continu d'applications](https://github.com/heig-vd-mvp-course/heig-vd-mvp-course/blob/main/10-cours-hebergement-et-deploiement-de-services/02-support-de-cours/README.md#mettre-en-place-un-pipeline-de-cicd-pour-la-livraisonle-d%C3%A9ploiement-continu-dapplications)

> 🔍 **Glossaire**
>
> - **Prettier** : outil de formatage automatique du code.
> - **.lock** : fichier qui verrouille les versions exactes des dépendances.
> - **CI/CD** : Intégration et Déploiement Continus.
> - **VSCode** : éditeur de texte très utilisé dans le développement web.
> - **Git** : système de contrôle de version pour suivre les modifications du
>   code.
> - **GitHub** : plateforme de gestion de code source et de collaboration.
> - **Composer** : gestionnaire de dépendances pour PHP.
> - **npm** : gestionnaire de paquets pour JavaScript.
> - **Laravel** : framework PHP pour le développement d'applications web.
> - **Node.js** : environnement d'exécution JavaScript côté serveur.
> - **Docker** : outil pour créer et gérer des conteneurs d'applications.
> - **Devcontainer** : environnement de développement isolé et reproductible.
> - **Markdown** : langage de balisage léger pour formater du texte.
> - **Blade** : moteur de templates pour Laravel.
> - **SQLite** : base de données légère et intégrée.
> - **PHP** : langage de programmation côté serveur.
> - **HTML** : langage de balisage pour créer des pages web.
> - **CSS** : langage de style pour mettre en forme les pages web.
> - **JavaScript** : langage de programmation pour le développement web.

## Ressources

Projets montrés dans cette présentation :

- [Spotin.ch](https://github.com/spotin/spotin)
