---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: HEIG-VD DévProdMéd - Cours Laravel
description: CRUD, API et vues avec Laravel
header: "**CRUD, API et vues avec Laravel**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# CRUD, API et vues avec Laravel

<!--
_class: lead
_paginate: false
-->

<small>Vincent Guidoux</small>

<small>Ce travail est sous licence CC BY-SA 4.0.</small>

## Objectifs

- Identifier les opérations CRUD
- Comprendre ce qu’est une API REST
- Distinguer contrôleur Vue et API
- Implémenter une ressource REST avec Laravel
- Tester une API avec `curl`
- Appliquer les bonnes pratiques REST

## Qu'est-ce que CRUD ?

CRUD = 4 opérations de base :

- **C**reate : Créer une ressource
- **R**ead : Lire une ou plusieurs ressources
- **U**pdate : Modifier une ressource
- **D**elete : Supprimer une ressource

![bg right:40%](https://images.unsplash.com/photo-1605379399642-870262d3d051?fit=crop&h=720)

## Qu'est-ce qu'une API REST ?

Une API REST utilise :

- Des **URI** claires : `/api/newsletters/1`
- Des **verbes HTTP** (`GET`, `POST`, `PUT`, `DELETE`)
- Des réponses **stateless** et en **JSON**
- Des **codes HTTP** explicites (`200`, `201`, `404`, etc.)

> Objectif : permettre à des machines d’interagir avec vos données, pas
> seulement des humains !

## Exemple d’endpoint REST

| Méthode | URL                  | Action                   |
| ------- | -------------------- | ------------------------ |
| GET     | `/api/newsletters`   | Liste des newsletters    |
| GET     | `/api/newsletters/1` | Détail d’une newsletter  |
| POST    | `/api/newsletters`   | Créer une newsletter     |
| PUT     | `/api/newsletters/1` | Modifier une newsletter  |
| DELETE  | `/api/newsletters/1` | Supprimer une newsletter |

## Contrôleurs Vue vs API

<!-- _class: lead -->

### Vue

- Renvoie des vues HTML (`Blade`)
- S’adresse à une personne

### API

- Renvoie du **JSON**
- S’adresse à un programme ou frontend JavaScript

**Laravel permet de séparer ces rôles dans 2 contrôleurs différents.**

## Créer les contrôleurs

```bash
php artisan make:controller NewsletterViewController
php artisan make:controller NewsletterApiController
```

## Exemple méthode Vue

```php
// NewsletterViewController
public function index() {
  $newsletters = Newsletter::all();
  return view('newsletters.index', compact('newsletters'));
}
```

## Exemple méthode API

```php
// NewsletterApiController
public function getNewsletters() {
  return response()->json(Newsletter::all());
}
```

## Routes API (`routes/api.php`)

```php
use App\Http\Controllers\NewsletterApiController;

Route::get('/newsletters', [NewsletterApiController::class, 'getNewsletters']);
Route::post('/newsletters', [
	NewsletterApiController::class,
	'createNewsletter',
]);
// etc.
```

> Ces routes sont automatiquement préfixées par `/api`

## Routes Vue (`routes/web.php`)

```php
use App\Http\Controllers\NewsletterViewController;

Route::get('/newsletters', [NewsletterViewController::class, 'index']);
```

## Validation avec FormRequest

```bash
php artisan make:request NewsletterStoreRequest
```

```php
public function rules(): array {
  return [
    'email' => 'required|email|unique:newsletters,email',
  ];
}
```

## Tester l’API avec `curl`

```bash
# Lister les newsletters
curl http://localhost:8000/api/newsletters

# Ajouter une newsletter
curl -X POST http://localhost:8000/api/newsletters \
  -H "Content-Type: application/json" \
  -d '{"email": "
```

> Alternative : Postman, Hoppscotch

## Bonnes pratiques REST

- URI au **pluriel** : `/newsletters`
- **Verbes HTTP** explicites
- **Codes HTTP** cohérents : `200`, `201`, `404`, `422`, etc.
- Contrôleurs **spécialisés** (Vue vs API)
- Validation via `FormRequest`

# Projet final : Une fiction numérique guidée par vos choix

<!--
_class: lead
-->

## Objectif pédagogique

> Concevoir et développer une application web complète
>
> - Backend Laravel (API REST)
> - Frontend Vue.js (interface interactive)

## Contexte du projet

Développer un jeu narratif interactif : **Une fiction numérique guidée par vos
choix**.

- Une personne suit une histoire
- À chaque chapitre, des **choix** influencent la suite du récit
- La personne navigue dans l’histoire via une interface Vue.js

## Objectifs techniques

- Concevoir et modéliser une base de données relationnelle
- Créer une API REST (Laravel) pour exposer les données
- Développer une interface utilisateur (Vue.js) consommant l’API
- Implémenter les relations entre entités
- Sécuriser certaines actions avec authentification et middleware

## Modèle de données

- `Story` : titre, résumé, personne qui l’a écrite
- `Chapter` : texte, n° du chapitre, appartient à une `Story`
- `Choice` : texte du choix, `chapter_id`, `next_chapter_id`

Relations :

- `Story` a plusieurs `Chapter`
- `Chapter` a plusieurs `Choice`
- `Choice` mène à un autre `Chapter` (relation à soi-même)

## Étapes Laravel (backend)

1. Créer les migrations et modèles
2. Implémenter les relations Eloquent
3. Créer les API CRUD : `stories`, `chapters`, `choices`
4. Ajouter validation avec `FormRequest`
5. Tester les routes avec `curl`
6. (Protéger les routes avec middleware (`auth`, `can`))
7. (Lier les stories à une personne)

## Étapes Vue.js (frontend)

Sous réserve de modifications et de la personne qui enseigne le cours.

1. Afficher la liste des histoires (page d’accueil)
2. Charger le premier chapitre via l’API
3. Afficher les choix disponibles
4. Naviguer vers le chapitre suivant selon le choix
5. (Optionnel) Afficher l’historique de navigation
6. (Optionnel) Créer une interface de création d’histoire

## Extensions possibles

- Système de sauvegarde de partie (session, token)
- Choix conditionnels
- Illustrations ou sons dans les chapitres
- Classement ou système de fin multiple
- Traductions multilingues

## Organisation

- Le projet peut commencer dès le cours 6
- Soutien croisé possible entre les deux personnes qui enseignent
- Présentation ou démonstration finale au cours 10

## À vous de jouer !

- Implémenter une ressource REST simple
- Ajouter la partie Vue
- Tester avec `curl`
- Lire le support de cours complet !
- Commencer à réfléchir à votre histoire

![bg right:40%][illustration-a-vous-de-jouer]

[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1620336655174-32ccc95d0e2d?fit=crop&h=720

## Questions ?

<!-- _class: lead -->

Est-ce que vous avez des questions ?
