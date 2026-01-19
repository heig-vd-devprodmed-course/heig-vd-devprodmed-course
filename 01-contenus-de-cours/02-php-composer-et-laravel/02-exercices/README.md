# PHP, Composer et Laravel - Exercices

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Toutes les informations relatives à ce contenu sont décrites dans le
> [contenu principal](../README.md).

## Table des matières

- [Table des matières](#table-des-matières)
- [Exercices](#exercices)
  - [Exercice 1 : Explorer la structure du projet](#exercice-1--explorer-la-structure-du-projet)
  - [Exercice 2 : Modifier la page d'accueil](#exercice-2--modifier-la-page-daccueil)
  - [Exercice 3 : Créer une nouvelle route](#exercice-3--créer-une-nouvelle-route)
  - [Exercice 4 : Créer une vue pour la route](#exercice-4--créer-une-vue-pour-la-route)
  - [Exercice 5 : Utiliser Artisan](#exercice-5--utiliser-artisan)
  - [Exercice 6 : Créer un contrôleur](#exercice-6--créer-un-contrôleur)
- [Pour aller plus loin](#pour-aller-plus-loin)

## Exercices

Ces exercices vous permettront de mettre en pratique les concepts vus dans le
cours. Assurez-vous d'avoir complété le mini-projet (installation de
l'environnement) avant de commencer.

### Exercice 1 : Explorer la structure du projet

#### Objectif

Comprendre l'organisation d'un projet Laravel.

#### Instructions

1. Ouvrez votre projet Laravel dans Visual Studio Code.
2. Répondez aux questions suivantes :

#### Questions

1. Dans quel dossier se trouvent les contrôleurs ?
2. Dans quel dossier se trouvent les vues (templates Blade) ?
3. Dans quel fichier sont définies les routes web ?
4. Quel est le rôle du fichier `.env` ?
5. Pourquoi le dossier `vendor/` ne doit-il pas être versionné avec Git ?

<details>
<summary>Afficher la solution</summary>

1. Les contrôleurs se trouvent dans `app/Http/Controllers/`.
2. Les vues se trouvent dans `resources/views/`.
3. Les routes web sont définies dans `routes/web.php`.
4. Le fichier `.env` contient les variables d'environnement (configuration de la
   base de données, clés API, etc.). Il permet de configurer l'application sans
   modifier le code.
5. Le dossier `vendor/` contient les dépendances installées par Composer. Il ne
   doit pas être versionné car il peut être régénéré avec `composer install` et
   il est souvent volumineux.

</details>

### Exercice 2 : Modifier la page d'accueil

#### Objectif

Modifier le contenu d'une vue Blade existante.

#### Instructions

1. Ouvrez le fichier `resources/views/welcome.blade.php`.
2. Remplacez le titre "Laravel" par "Bienvenue sur mon application".
3. Ajoutez un paragraphe avec votre nom sous le titre.
4. Rafraîchissez la page dans votre navigateur pour voir les changements.

<details>
<summary>Afficher la solution</summary>

Dans le fichier `resources/views/welcome.blade.php`, trouvez la section
contenant le titre et modifiez-la. L'emplacement exact dépend de la version de
Laravel, mais cherchez le texte "Laravel" et remplacez-le.

Exemple de modification :

```html
<h1>Bienvenue sur mon application</h1>
<p>Créée par [Votre Nom]</p>
```

</details>

### Exercice 3 : Créer une nouvelle route

#### Objectif

Comprendre le système de routage de Laravel.

#### Instructions

1. Ouvrez le fichier `routes/web.php`.
2. Ajoutez une nouvelle route `/about` qui retourne le texte "Page À propos".
3. Testez la route en accédant à `http://localhost:8000/about`.

<details>
<summary>Afficher la solution</summary>

Dans `routes/web.php`, ajoutez :

```php
Route::get('/about', function () {
    return 'Page À propos';
});
```

</details>

### Exercice 4 : Créer une vue pour la route

#### Objectif

Associer une vue à une route.

#### Instructions

1. Créez un nouveau fichier `resources/views/about.blade.php`.
2. Ajoutez du contenu HTML dans ce fichier (titre, paragraphe de description).
3. Modifiez la route `/about` pour qu'elle affiche cette vue au lieu d'un simple
   texte.

<details>
<summary>Afficher la solution</summary>

1. Créez le fichier `resources/views/about.blade.php` :

```html
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>À propos</title>
	</head>
	<body>
		<h1>À propos</h1>
		<p>Cette application a été créée dans le cadre du cours DévProdMéd.</p>
		<a href="/">Retour à l'accueil</a>
	</body>
</html>
```

2. Modifiez la route dans `routes/web.php` :

```php
Route::get('/about', function () {
    return view('about');
});
```

</details>

### Exercice 5 : Utiliser Artisan

#### Objectif

Découvrir l'interface en ligne de commande de Laravel.

#### Instructions

1. Ouvrez un terminal dans le dossier de votre projet.
2. Exécutez les commandes suivantes et observez les résultats :

```bash
# Lister toutes les commandes disponibles
php artisan list

# Afficher les routes définies
php artisan route:list

# Afficher la version de Laravel
php artisan --version

# Obtenir de l'aide sur une commande
php artisan help make:controller
```

3. Répondez aux questions suivantes :

#### Questions

1. Combien de routes sont définies par défaut dans un nouveau projet Laravel ?
2. Quelle commande permet de créer un nouveau contrôleur ?
3. Quelle commande permet de vider le cache de l'application ?

<details>
<summary>Afficher la solution</summary>

1. Par défaut, il y a généralement 1 route (la route `/` vers la page
   d'accueil), plus éventuellement quelques routes supplémentaires selon la
   version de Laravel.
2. La commande pour créer un contrôleur est `php artisan make:controller`.
3. La commande pour vider le cache est `php artisan cache:clear`. Il existe
   aussi `php artisan config:clear`, `php artisan route:clear` et
   `php artisan view:clear` pour vider des caches spécifiques.

</details>

### Exercice 6 : Créer un contrôleur

#### Objectif

Utiliser un contrôleur au lieu d'une fonction anonyme dans les routes.

#### Instructions

1. Créez un contrôleur nommé `PageController` avec Artisan :

```bash
php artisan make:controller PageController
```

2. Ouvrez le fichier créé dans `app/Http/Controllers/PageController.php`.
3. Ajoutez une méthode `about()` qui retourne la vue `about`.
4. Modifiez la route `/about` pour utiliser ce contrôleur.

<details>
<summary>Afficher la solution</summary>

1. Après avoir créé le contrôleur, éditez
   `app/Http/Controllers/PageController.php` :

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }
}
```

2. Modifiez `routes/web.php` :

```php
use App\Http\Controllers\PageController;

Route::get('/about', [PageController::class, 'about']);
```

</details>

## Pour aller plus loin

Si vous avez terminé tous les exercices, voici quelques pistes pour approfondir
:

- Explorez la documentation officielle de Laravel :
  [laravel.com/docs](https://laravel.com/docs).
- Suivez le tutoriel Laravel Bootcamp :
  [bootcamp.laravel.com](https://bootcamp.laravel.com/).
- Créez d'autres routes et vues pour pratiquer.
- Explorez les autres commandes Artisan disponibles.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
