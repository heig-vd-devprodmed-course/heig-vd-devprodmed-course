---
marp: true
---

<!--
theme: gaia
size: 16:9
paginate: true
author: V. Guidoux, avec l'aide de GitHub Copilot
title: HEIG-VD DévProdMéd - Cours Laravel
description: Blade et contrôleur pour le cours DévProdMéd à la HEIG-VD, Suisse
header: "**Blade et contrôleur**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
style: |
    :root {
        --color-background: #fff;
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
    th:first-child {
        width: 15%;
    }
    h1, h2, h3, h4, h5, h6 {
        color: var(--color-headings);
    }
    h2, h3, h4, h5, h6 {
        font-size: 1.5rem;
    }
    h1 a:link, h2 a:link, h3 a:link, h4 a:link, h5 a:link, h6 a:link {
        text-decoration: none;
    }
    section:not(.lead) > p, blockquote {
        text-align: justify;
    }
    section:has(h1) {
        padding: 50px;
    }
    section:has(h1) > header {
        display: none;
    }
    section > header {
        font-size: 50%;
    }
    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .center {
        text-align: center;
    }
headingDivider: 6
-->

# Blade et contrôleur

<!--
_class: lead
_paginate: false
-->

<small>Vincent Guidoux avec l'aide de GitHub Copilot</small>

<small>Ce travail est sous licence CC BY-SA 4.0.</small>

## Objectifs

- Découvrir de nouvelles fonctionnalités de Blade (outil de templating)
- Découvrir la notion de "contrôleur"
- Gérer des ressources (images, ...)

![bg right:40%](https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720)

## Templating avec Blade

- Blade est un moteur de templating intégré à Laravel
- Il permet de créer des vues plus facilement
- Il permet d'insérer des données dynamiques dans les vues

## `\resources\views\template.blade.php`

```html
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Mon contact</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<header>
			<h1>Mon contact</h1>
		</header>
		@yield('content')
		<!-- content -->
		@include('footer')
	</body>
</html>
```

## Exemple de @yield (suite) `\resources\views\contacts.blade.php`

```html
@extends('template')
<!-- Hérite de template.blade.php -->
@section('content')
<!-- Définit la section content -->
<main>
	<p>Nom : {{ $nom }}</p>
	<p>Prénom : {{ $prenom }}</p>
	<p>Email : {{ email }}</p>
</main>
@endsection
<!-- Fin de la section content -->
```

## Exemple de @include (suite) `\resources\views\footer.blade.php`

```html
<footer>
	<p>HEIG-VD</p>
</footer>
```

## Exemple de @include (suite) `\resources\views\template.blade.php`

```html
<!DOCTYPE html>
<html lang="fr">
	<!-- ... -->
	<body>
		<header>
			<h1>Mon contact</h1>
		</header>
		@yield('content')
		<!-- content -->
		@include('footer')
	</body>
</html>
```

## Exemple de @if

```html
<main>
	<p>Nom : Despentes</p>
	<p>
		Email : @if ($email) {{
		<!-- $email est une variable passée à la vue -->
		$email
		<!-- Affiche $email si défini -->
		}} @else
		<!-- Si $email n'est pas défini -->
		Pas d'email
		<!-- Affiche "Pas d'email" -->
		@endif
	</p>
</main>
```

## Contrôleur

- Nos vues sont simples, mais elles peuvent être plus complexes
- Pour cela, on peut utiliser un contrôleur
- Un contrôleur est une classe PHP qui contient des méthodes qui renvoient des
  vues

## Exemple de contrôleur `\app\Http\Controllers\ContactController.php`

```php
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    public function show()
    {
        return view('contacts');
    }
}
```

---

`\app\Http\Controllers\ContactController.php`

```php
class ContactController extends Controller
{
    public function show()
    {
        return view('contacts');
```

`\routes\web.php`

```php
use App\Http\Controllers\ContactController;

Route::get('/contacts', [ContactController::class, 'show']);
```

## Paramètres dans les contrôleurs

`\app\Http\Controllers\ContactController.php`

```php
class ContactController extends Controller {
    public function show($id, $office) {
        return view('contacts', ['id' => $id, 'office' => $office]);
```

`\routes\web.php`

```php
Route::get('/contacts/{id}/{office}', [ContactController::class, 'show']);
```

---

`\app\Http\Controllers\ContactController.php`

```php
class ContactController extends Controller {
    public function list() {
        $contactsModel = [
            ['id' => 1, 'office' => 'Lausanne'],
            ['id' => 2, 'office' => 'Yverdon']
        ];
        return view('contactsView', ['contactArray' => $contactsModel]);
```

`\resources\views\contactsView.blade.php`

```html
@foreach ($contactArray as $contact)
<p>{{ $contact['id'] }} - {{ $contact['office'] }}</p>
@endforeach
```

## Ajout de ressource(s) à une application `Laravel` (Image)

Pour ajouter une image à notre application `Laravel`

1. Créer un dossier `images` dans le dossier `\storage\app\public`
2. Copier l'image dans le dossier `images`
3. Créer un lien symbolique vers le dossier `public` avec la commande
   `php artisan storage:link`

```html
<img src="{{ asset('storage/images/photo.jpg') }}" alt="Photo de profil" />
```

## Questions ?

<!-- _class: lead -->
