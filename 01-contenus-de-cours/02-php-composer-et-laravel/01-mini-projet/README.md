# PHP, Composer et Laravel - Mini-projet

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Trouvez d'autres informations relatives à ce contenu dans le
> [contenu parent](../README.md).

## Table des matières

- [Table des matières](#table-des-matières)
- [Mini-projet](#mini-projet)
  - [Objectifs](#objectifs)
  - [Prérequis](#prérequis)
  - [Étapes](#étapes)
  - [Critères de validation](#critères-de-validation)
  - [En cas de problème](#en-cas-de-problème)
- [Solution](#solution)

## Mini-projet

### Objectifs

Ce mini-projet a pour but de mettre en place votre environnement de
développement pour le cours. À la fin de ce mini-projet, vous devriez avoir :

- PHP installé sur votre machine.
- Composer installé sur votre machine.
- Un projet Laravel fonctionnel.

### Installation de Composer

#### Sur Linux/macOS

```bash
# Télécharger l'installateur
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Installer Composer globalement
php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Supprimer l'installateur
php -r "unlink('composer-setup.php');"

# Vérifier l'installation
composer --version
```

#### Sur Windows

Téléchargez et exécutez l'installateur Windows depuis
[getcomposer.org](https://getcomposer.org/download/).

### Prérequis

- Un ordinateur avec un système d'exploitation récent (Windows, macOS ou Linux).
- Un accès administrateur pour installer des logiciels.
- Un éditeur de code (Visual Studio Code recommandé).

### Étapes

#### Étape 1 : Installer PHP

##### Sur Windows

1. Téléchargez PHP depuis [windows.php.net](https://windows.php.net/download/).
   Choisissez la version "VS16 x64 Thread Safe" (ZIP).
2. Extrayez l'archive dans `C:\php`.
3. Ajoutez `C:\php` à la variable d'environnement PATH.
4. Copiez `php.ini-development` en `php.ini`.
5. Éditez `php.ini` et décommentez les extensions nécessaires :
   - `extension=curl`
   - `extension=fileinfo`
   - `extension=mbstring`
   - `extension=openssl`
   - `extension=pdo_mysql` (ou `pdo_sqlite`)

##### Sur macOS

PHP est préinstallé sur macOS. Vous pouvez également utiliser Homebrew :

```bash
brew install php
```

##### Sur Linux (Ubuntu/Debian)

```bash
sudo apt update
sudo apt install php php-cli php-mbstring php-xml php-curl php-zip unzip
```

##### Vérification

```bash
php --version
```

Vous devriez voir quelque chose comme :

```
PHP 8.x.x (cli) ...
```

#### Étape 2 : Installer Composer

##### Sur Windows

Téléchargez et exécutez l'installateur depuis
[getcomposer.org](https://getcomposer.org/download/).

##### Sur macOS/Linux

```bash
# Télécharger l'installateur
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Installer Composer globalement
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Supprimer l'installateur
php -r "unlink('composer-setup.php');"
```

##### Vérification

```bash
composer --version
```

Vous devriez voir quelque chose comme :

```
Composer version 2.x.x ...
```

#### Étape 3 : Créer un projet Laravel

1. Ouvrez un terminal et naviguez vers le dossier où vous souhaitez créer votre
   projet.

2. Créez un nouveau projet Laravel :

```bash
composer create-project laravel/laravel mon-premier-projet
```

3. Attendez que Composer télécharge et installe toutes les dépendances.

#### Étape 4 : Lancer le serveur de développement

1. Naviguez dans le dossier du projet :

```bash
cd mon-premier-projet
```

2. Lancez le serveur de développement :

```bash
php artisan serve
```

3. Ouvrez votre navigateur et accédez à `http://localhost:8000`.

4. Vous devriez voir la page d'accueil de Laravel.

#### Étape 5 : Explorer le projet

Prenez le temps d'explorer la structure du projet dans votre éditeur de code :

- Ouvrez le dossier `mon-premier-projet` dans Visual Studio Code.
- Parcourez les différents dossiers : `app/`, `config/`, `resources/views/`,
  `routes/`.
- Ouvrez le fichier `routes/web.php` et observez la définition de la route
  principale.
- Ouvrez le fichier `resources/views/welcome.blade.php` et observez le template
  de la page d'accueil.

### Critères de validation

Votre mini-projet est validé si :

- [ ] PHP est installé et accessible depuis le terminal (`php --version`).
- [ ] Composer est installé et accessible depuis le terminal
      (`composer --version`).
- [ ] Un projet Laravel a été créé avec succès.
- [ ] Le serveur de développement se lance sans erreur.
- [ ] La page d'accueil de Laravel s'affiche dans le navigateur.

### En cas de problème

Si vous rencontrez des difficultés :

1. Vérifiez les messages d'erreur dans le terminal.
2. Consultez la [documentation officielle de Laravel](https://laravel.com/docs).
3. Recherchez l'erreur sur [Stack Overflow](https://stackoverflow.com/).
4. Demandez de l'aide à vos collègues ou à l'enseignant.

## Solution

Vous pouvez trouver la solution du mini-projet à l'adresse suivante :
[Solution](./solution/README.md).

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
