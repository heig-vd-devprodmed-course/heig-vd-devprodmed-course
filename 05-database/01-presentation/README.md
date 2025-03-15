---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: Bases de données avec Laravel
description: Introduction à l'utilisation de bases de données avec SQLite et Eloquent ORM
header: "**Bases de données avec Laravel**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Bases de données avec Laravel

<!--
_class: lead
_paginate: false
-->

<small>Vincent Guidoux</small>

<small>Ce travail est sous licence CC BY-SA 4.0.</small>

## Plus de détails dans le support de cours

<!-- _class: lead -->

Ce document est une introduction. Consultez le support de cours pour une
explication détaillée et les exercices pratiques.

## Objectifs (1/2)

- Lister les étapes nécessaires pour intégrer SQLite avec Laravel.
- Décrire comment configurer Laravel pour utiliser une base de données.
- Identifier les étapes de création et d'utilisation des migrations Laravel.
- Appliquer le modèle Eloquent ORM pour manipuler une base de données.
- Énumérer les étapes pour créer, valider et traiter un formulaire.
- Vérifier les données avec DB Browser for SQLite.

## Qu'est-ce que SQLite ?

- Système de Gestion de Bases de Données (SGBD).
- Contrairement à MySQL ou PostgreSQL, pas besoin de serveur.
- Base stockée dans un simple fichier (`database.sqlite`).
- Léger (~600 Ko) et utilisé dans de nombreux logiciels et applications mobiles.

## ORM : Object-Relational Mapping

Exemple d'utilisation :

```sql
INSERT INTO newsletters (email) VALUES ('exemple@exemple.com');
```

Avec Laravel et Eloquent :

```php
Newsletter::create(['email' => 'exemple@exemple.com']);
```

## Eloquent ORM : Manipuler une base en PHP

**Eloquent** est l’ORM de Laravel qui permet d’utiliser une base **sans écrire
du SQL**.

Chaque table est représentée par une **classe modèle**.

Exemple :

```php
class Newsletter extends Model
{
	protected $fillable = ['email'];
}
```

## Exemples d'utilisation

Ajouter un enregistrement :

```php
Newsletter::create(['email' => 'test@example.com']);
```

Récupérer des données :

```php
$newsletters = Newsletter::all();
```

## Création du projet Laravel avec SQLite

```bash
laravel new cours-5-database --database=sqlite --pest --no-interaction
```

**Options importantes** :

- `--database=sqlite` : Définit SQLite comme base de données.
- `--pest` : Ajoute le framework de test **Pest**.
- `--no-interaction` : Lance l’installation **sans prompts**.

## Migrations : Définir la structure de la base

**Créer une migration et un modèle :**

```bash
php artisan make:model Newsletter --migration --controller
```

**Fichier de migration généré :**

```php
Schema::create('newsletters', function (Blueprint $table) {
	$table->id();
	$table->string('email')->unique();
	$table->timestamps();
});
```

### `up()` : Création de la table

La méthode `up()` est exécutée lorsque lors d'une migration avec :

```bash
php artisan migrate
```

```php
public function up() {
    Schema::create('newsletters', function (Blueprint $table) {
        $table->id();
        $table->string('email')->unique();
        $table->timestamps();
    });
}
```

### `down()` : Suppression de la table

La méthode `down()` est exécutée lorsque l’on annule une migration avec :

```bash
php artisan migrate:rollback
```

```php
public function down() {
    Schema::dropIfExists('newsletters');
    // Permet de revenir à un état antérieur en cas d’erreur.
    // Facilite la gestion des migrations dans un environnement de développement.
}
```

### Commandes utiles

- Appliquer une migration :

  ```bash
  php artisan migrate
  ```

- Annuler la dernière migration :

  ```bash
  php artisan migrate:rollback
  ```

## Validation des données

**Création d’une validation avec `FormRequest`**

```bash
php artisan make:request NewsletterRequest
```

**Ajout des règles de validation (`NewsletterRequest.php`)** :

```php
public function rules(): array {
    return ['email' => 'required|email|unique:newsletters'];
}
```

## Routes

**Déclaration des routes dans `web.php`** :

```php
Route::get('/newsletters/form', [NewsletterController::class, 'form'])->name(
	'newsletters.form'
);
Route::post('/newsletters', [NewsletterController::class, 'create'])->name(
	'newsletters.create'
);
Route::get('/newsletters', [NewsletterController::class, 'index'])->name(
	'newsletters.index'
);
```

## Vérification des données

**Méthodes pour visualiser la base SQLite** :

1. **Avec DB Browser for SQLite**

   - Ouvrir `database.sqlite`.
   - Vérifier la table `newsletters`.

2. **Avec une extension VS Code** (`qwtel.sqlite-viewer`)
   - Permet d’afficher les données directement dans l'éditeur.

## Ressources complémentaires

- **[Documentation Laravel Database](https://laravel.com/docs/database)**
- **[Eloquent ORM - Laravel](https://laravel.com/docs/eloquent)**

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- Prendre connaissance du support de cours
- Poser des questions si nécessaire

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration][illustration-a-vous-de-jouer] par
  [Erik Mclean](https://unsplash.com/@introspectivedsgn) sur
  [Unsplash](https://unsplash.com/photos/person-holding-red-and-white-playing-card-8tNQnMXDK7A)

[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1620336655174-32ccc95d0e2d?fit=crop&h=720
