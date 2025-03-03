---
marp: true
---

<!--
theme: gaia
size: 16:9
paginate: true
author: J. Hess et V. Guidoux, avec l'aide de GitHub Copilot
title: HEIG-VD DévProdMéd - Cours Laravel
description: Quiz pour le cours DévProdMéd à la HEIG-VD, Suisse
header: "**Quiz 1**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
style: |
  :root {
      --color-background: #fff;
      --color-foreground: #333;
      --color-highlight: #f96;
      --color-dimmed: #888;
      --color-headings: #7d8ca3;
  }
  blockquote {
      font-style: italic;
  }
  table {
      width: 100%;
  }
  h1, h2, h3, h4, h5, h6 {
      color: var(--color-headings);
  }
  h2, h3, h4, h5, h6 {
      font-size: 1.5rem;
  }
  section:not(.lead) > p, blockquote {
      text-align: justify;
  }
  .two-columns {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
  }
  .center {
      text-align: center;
  }
  section.small  {
      font-size: 1.5rem;
  }
  section.small h2 {
      font-size: 2rem;
  }
headingDivider: 6
-->

# Quiz 1 - Laravel

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> **Où se trouvent les fichiers définissant les routes dans Laravel ?**

Indice : Laravel organise ses fichiers par responsabilité. Les routes sont
stockées dans un dossier spécifique.

## Question 1 - Réponse

Le répertoire contenant les routes est : `/routes`

```bash
.
├── app
├── bootstrap
├── config
├── database
├── public
├── resources
├── routes
.
```

[Documentation officielle](https://laravel.com/docs/10.x/routing)

## Question 2 - Donnée

> **Quel est le fichier principal qui gère les routes web dans Laravel ?**

Indice : Il s'agit du fichier dans lequel vous définissez vos routes pour le
web.

## Question 2 - Réponse

Le fichier est : `web.php`

```bash
.
├── routes
│   ├── web.php
```

[Documentation officielle](https://laravel.com/docs/10.x/routing)

## Question 3 - Donnée

> **Quelle est la route par défaut lors d’une installation de Laravel ?**

Indice : Cette route affiche une page de bienvenue si vous n’avez rien modifié
après l’installation.

## Question 3 - Réponse

La route par défaut est `/` (la racine du site).

Exemple dans `web.php` :

```php
Route::get('/', function () {
    return '<h1>Bienvenue sur Laravel</h1>';
});
```

## Question 4 - Donnée

> **Vous devez créer une page "contact" accessible via `/contact`. Comment
> définir cette route dans Laravel ?**

Indice : Utilisez `Route::get()` et retournez du HTML.

## Question 4 - Réponse

La route doit être définie dans `web.php` :

```php
Route::get('/contact', function () {
    return '<h1>Contactez-nous</h1>';
});
```

## Question 5 - Donnée

> **Comment ajouter des paramètres dynamiques dans une route ?**

Indice : Les paramètres permettent de rendre une route flexible, comme
`/article/1` ou `/article/2`.

## Question 5 - Réponse

Une route avec un paramètre dynamique se définit ainsi :

```php
Route::get('/article/{id}', function ($id) {
    return 'Article numéro ' . $id;
});
```

## Question 6 - Donnée

> **Comment restreindre un paramètre de route avec une expression régulière ?**

## Question 6 - Réponse (1/2)

​ Avec des
[expressions régulières](https://fr.wikipedia.org/wiki/Expression_régulière).

> Les expressions régulières doivent se mettre dans la clause `where`. `$id`
> doit être : compris dans l'intervalle [0-9] le + signifie (doit être présent
> une ou plusieurs fois) `$color` doit être soit rouge, soit vert, soit bleu.

```php
    Route::get('user/{id}/{color}', function($id, $color) {
        // action(s) à effectuer
    })->where(['id' => '[0-9]+', 'color' => 'rouge|vert|bleu']);
```

## Question 6 - Réponse (2/2)

​ Avec du code.

```php
    Route::get('user/{id}/{color}', function($id, $color) {
        if (preg_match('/[0-9]+/', $id) && in_array($color, ['rouge', 'vert', 'bleu'])) {
            // action(s) à effectuer
        }
    });
```

[preg_match](https://www.php.net/manual/en/function.preg-match.php)

## Question 7 - Donnée

> **Pourquoi utiliser une route nommée et comment la définir ?**

## Question 7 - Réponse

Une route nommée facilite les redirections et les liens. Définition d’une route
nommée :

```php
Route::get('/', function() {
    return '<h1>Accueil</h1>';
})->name('home');
```

Redirection vers une route nommée :

```php
Route::get('redirect/', function() {
    return redirect()->route('home');
});
```

## Question 8 - Donnée

> **Quelle est la différence entre une redirection vers une route nommée et une
> URL ?**

## Question 8 - Réponse

Redirection vers une route nommée :

```php
	Route ::get('redirect/', function() {
		return redirect()->route('home') ;
	}) ;
```

​ Redirection vers une URL :

```php
	Route ::get('redirect/2', function() {
		return redirect('https://example.com');
	})
```

## Question 9 - Donnée

> **Qu’est-ce qu’une vue dans Laravel ?**

## Question 9 - Réponse

Une vue est un fichier qui contient le code HTML affiché aux utilisateurs. Les
vues sont stockées dans :

```bash
.
├── resources
│   ├── views
│   │   ├── welcome.blade.php
│   │   ├── contact.blade.php
.
```

[Documentation Views](https://laravel.com/docs/10.x/views)

## Question 10 - Donnée

> **Comment associer une route à une vue ?**

## Question 10 - Réponse

> Accéder à l'url `/article` permet d'afficher la vue `article.php`

```php
Route ::get('article', function() {
    return view('article') ;
}) ;
```

## Question 11 - Donnée

> Dans quel répertoire se trouvent les vues ?

## Question 11 - Réponse

> ​ Dans le répertoire `/resources/views`

```bash
.
├── resources
│   ├── views
│   │   ├── article.php
│   │   ├── contact.php
.
```

[Documentation Views](https://laravel.com/docs/10.x/views)

## Question 12 - Donnée

**Quel est le moteur de templating utilisé par Laravel et à quoi sert-il ?**

Indice : Il permet d’écrire du HTML dynamique.

## Question 12 - Réponse

Blade, le moteur de templating de Laravel, permet d'écrire du HTML dynamique.

Exemple :

```blade
<h1>Bonjour, {{ $nom }}</h1>
```

[Documentation Blade](https://laravel.com/docs/10.x/blade)

## Question 13 - Donnée

> Comment met-on en œuvre Blade ?

## Question 13 - Réponse

> Il suffit de changer l'extension d'une vue de `.php` à `.blade.php` Une fois
> ce renommage effectué, Blade sera actif. Simple non ? Exemple : `article.php`
> => `article.blade.php`

## Question 14 - Donnée

**Comment transmettre un paramètre à une vue depuis une route ?**

Dans la vue `article.blade.php` :

```html
<p>Article numéro : {{ $id }}</p>
```

## Question 14 - Réponse

Avec `with()` :

```php
Route::get('/article/{id}', function ($id) {
    return view('article')->with('id', $id);
});
```

Avec un tableau associatif :

```php
Route::get('/article/{id}', function ($id) {
    return view('article', ['id' => $id]);
});
```

## Question 15 - Donnée

**Comment transmettre plusieurs paramètres à une vue ?**

## Question 15 - Réponse

1. Enchaînement de `with()` :

```php
return view('article')->with('id', $id)->with('color', $color);
```

1. Passage d’un tableau associatif :

```php
return view('article', ['id' => $id, 'color' => $color]);
```

[Documentation](https://laravel.com/docs/10.x/views#passing-data-to-views)
