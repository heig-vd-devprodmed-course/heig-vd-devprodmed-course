---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: J. Hess et V. Guidoux, avec l'aide de GitHub Copilot
title: HEIG-VD DévProdMéd - Cours Laravel
description: Quiz pour le cours DévProdMéd à la HEIG-VD, Suisse
header: "**Quiz 2**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Quiz 2 - Blade et contrôleur

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> **Qu'est ce qu'un `template` Blade et à quoi cela sert-il ?**

## Question 1 - Réponse

Cela correspond à un modèle que l'on peut réutiliser. Cela permet d'éviter de
répéter du code (d'où moins d'erreur et gain de temps).

Documentation :
[Directives Blade](https://laravel.com/docs/9.x/blade#blade-directives)

## Question 2 - Donnée

> **Comment se nomme le "tag" permettant d'injecter du code dans un `template`
> ?**

## Question 2 - Réponse

`@yield`

## Question 3 - Donnée

> **Qu'est-ce qu'un contrôleur ?**

## Question 3 - Réponse

Un contrôleur est une classe contenant des méthodes.

## Question 4 - Donnée

> **A quoi sert le contrôleur ?**

## Question 4 - Réponse

Un contrôleur permet de préparer les données devant être affichée par une vue et
de centraliser le traitement de données provenant de formulaires.

## Question 5 - Donnée

> **Quelle commande artisan permet de créer un contrôleur ?**

## Question 5 - Réponse

`php artisan make:controller NomDuControlleur`

## Question 6 - Donnée

> **Comment "lier" une route à une méthode d'un contrôleur ?**

---

`\routes\web.php`

```php
Route::get('/contacts/{contactId}', [ContactController::class, 'getContacts']);
```

`\app\Http\Controllers\ContactController.php`

```php
class ContactController extends Controller {
    public function getContacts($contactId) {
        return view('contact', ['id' => $contactId]);
```

`\resources\views\contact.blade.php`

```php
<h1>Contact n° {{$id}}</h1>
```

## Question 7 - Donnée

> **Est-ce que le nom des paramètres de la méthode du contrôleur doit être le
> même que celui de la route ?**

---

Non. C'est l'ordre des paramètres qui compte. Comme dans cette exemple :
`\routes\web.php`

```php
Route ::get('/teams/{teamId}/players/{playerId}', [TeamController::class, 'show']);
```

`\app\Http\Controllers\TeamController.php`

```php
class TeamController extends Controller {
    public function show($teamNumber, $playerNumber) {
        return view('team', ['equipeId' => $teamNumber, 'joueuseId' => $playerNumber]);
```

`\resources\views\team.blade.php`

```html
<h1>Équipe {{$equipeId}} - Joueuse {{$joueuseId}}</h1>
```

## Question 8 - Donnée

> **Pourquoi devons-nous créer un lien entre `\storage\app\public` et
> `\public\storage` et comment ?**

## Question 8 - Réponse

Pour que les fichiers stockés dans `\storage\app\public` soient accessibles
depuis le navigateur. Cela se fait avec la commande :

```bash
php artisan storage:link
```

[Sources](https://laravel.com/docs/8.x/filesystem#the-public-disk)
