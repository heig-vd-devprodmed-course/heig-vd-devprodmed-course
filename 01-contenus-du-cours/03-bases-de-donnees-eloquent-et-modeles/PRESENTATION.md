---
marp: true
theme: "custom-marp-theme"
size: "16:9"
paginate: "true"
author: "L. Delafontaine, avec l'aide de GitHub Copilot"
description:
  "Bases de données, Eloquent et modèles pour le cours DévProdMéd enseigné à la
  HEIG-VD, Suisse"
lang: "fr"
header:
  "[**Bases de données, Eloquent et modèles**][contenu-complet-sur-github]"
footer:
  "[**HEIG-VD**](https://heig-vd.ch) - [DévProdMéd
  2025-2026](https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course)
  - [CC BY-SA 4.0][licence]"
headingDivider: 6
---

# Bases de données, Eloquent et modèles

<!--
_class: lead
_paginate: false
-->

<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course>

Visualiser le contenu complet sur GitHub [à cette
adresse][contenu-complet-sur-github].

<small>L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).</small>

<small>Ce travail est sous licence [CC BY-SA 4.0][licence].</small>

![bg opacity:0.1][illustration-principale]

## Plus de détails sur GitHub

<!-- _class: lead -->

_Cette présentation est un résumé du contenu complet disponible sur GitHub._

_Pour plus de détails, consulter le [contenu complet sur
GitHub][contenu-complet-sur-github] ou en cliquant sur l'en-tête de ce
document._

## Objectifs (1)

- Décrire comment Laravel peut interagir avec plusieurs types de bases de
  données.
- Décrire le concept de migrations avec Laravel.
- Décrire le concept d'un ORM tel qu'Eloquent.

![bg right:40%][illustration-objectifs]

## Objectifs (2)

- Décrire la partie "modèle" du patron de conception MVC.
- Utiliser Eloquent avec Laravel.
- Implémenter ces concepts avec Laravel pour réaliser le petit réseau social du
  mini-projet.

![bg right:40%][illustration-objectifs]

## Laravel et les bases de données

Laravel supporte plusieurs SGBD :

- MySQL / MariaDB.
- PostgreSQL.
- SQLite.
- SQL Server.

Configuration dans `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_base
DB_USERNAME=user
DB_PASSWORD=password
```

**Laravel abstrait les détails de connexion.**

![bg right:40%][illustration-databases]

## Migrations

Migrations = fichiers décrivant la structure de la base de données.

Avantages :

- Versionner la structure.
- Collaborer facilement.
- Déployer la même structure partout.

```bash
php artisan make:migration create_users_table
php artisan migrate
```

![bg right:40%][illustration-migrations]

### Structure d'une migration

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->timestamps();
});
```

![bg right:40%][illustration-migrations]

## Le concept d'ORM

ORM = Object-Relational Mapping.

**Sans ORM (SQL)** :

```sql
SELECT * FROM users WHERE id = 1;
```

**Avec ORM (Eloquent)** :

```php
$user = User::find(1);
```

Avantages :

- Abstraction sur SQL.
- Protection contre injections SQL.
- Code plus lisible.
- Portabilité.

![bg right:40%][illustration-orm]

## Eloquent : l'ORM de Laravel

```bash
php artisan make:model User
```

Crée `app/Models/User.php` :

```php
class User extends Model
{
    // Par convention :
    // - table 'users'
    // - clé primaire 'id'
    // - timestamps auto
}
```

![bg right:40%][illustration-eloquent]

## Opérations CRUD avec Eloquent

**Créer** :

```php
User::create(['name' => 'Alice', 'email' => 'alice@example.com']);
```

**Lire** :

```php
$user = User::find(1);
$users = User::all();
$users = User::where('email', 'like', '%example.com')->get();
```

**Mettre à jour** :

```php
$user->update(['name' => 'Bob']);
```

**Supprimer** :

```php
$user->delete();
User::destroy(1);
```

![bg right:40%][illustration-crud]

## Le modèle dans le MVC

Le modèle représente les données et la logique métier.

```php
class User extends Model
{
    // Logique métier
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
```

Eloquent encapsule l'accès aux données et la logique associée.

![bg right:40%][illustration-mvc]

## Attributs à assigner en masse

```php
class User extends Model
{
    protected $fillable = ['name', 'email', 'password'];
}
```

Protège contre l'assignation non intentionnelle d'attributs.

![bg right:40%][illustration-eloquent]

## Requêtes avancées

```php
$users = User::where('active', true)
    ->where('created_at', '>', now()->subDays(7))
    ->orderBy('name')
    ->get();

$count = User::where('active', true)->count();
$user = User::where('email', 'alice@example.com')->first();
```

![bg right:40%][illustration-crud]

## À vous de jouer !

- Créer une migration pour une table.
- Créer un modèle Eloquent.
- Implémenter les opérations CRUD.
- Ajouter de la logique métier au modèle.

➡️ [Visualiser le contenu complet sur GitHub.][contenu-complet-sur-github]

![bg right:40%][illustration-a-vous-de-jouer]

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## Sources

- [Illustration principale][illustration-principale] par
  [Mulyadi](https://unsplash.com/@mullyadii) sur
  [Unsplash](https://unsplash.com/photos/photo-of-turned-on-laptop-computer-yzmmvnpHiN4).
- [Illustration objectifs][illustration-objectifs] par
  [Markus Spiske](https://unsplash.com/@markusspiske) sur
  [Unsplash](https://unsplash.com/photos/turned-on-laptop-computer-RwHv7LgeC7s).
- [Illustration databases][illustration-databases] par
  [Alain Pham](https://unsplash.com/@alain_pham) sur
  [Unsplash](https://unsplash.com/photos/server-racks-in-data-center-OHJMCh0qmsU).
- [Illustration migrations][illustration-migrations] par
  [Sigmund](https://unsplash.com/@sigmund) sur
  [Unsplash](https://unsplash.com/photos/computer-codes-KPJHfL3E5Iw).
- [Illustration ORM et autres][illustration-orm] par
  [Christopher Burns](https://unsplash.com/@christopher__burns) sur
  [Unsplash](https://unsplash.com/photos/man-holding-gray-binoculars-lENITfvw-WQ).
- [Illustration Eloquent, CRUD, MVC][illustration-eloquent] par
  [AltumCode](https://unsplash.com/@altumcode) sur
  [Unsplash](https://unsplash.com/photos/laptop-with-code-IGT1TsKuqMw).
- [Illustration CRUD][illustration-crud] par
  [Pankaj Patel](https://unsplash.com/@pankajpatel) sur
  [Unsplash](https://unsplash.com/photos/person-holding-black-smartphone-eOqKH8tg-aY).
- [Illustration MVC][illustration-mvc] par
  [Luca Bravo](https://unsplash.com/@lucabravo) sur
  [Unsplash](https://unsplash.com/photos/laptop-on-table-pyIwzcdqMss).
- [Illustration à vous de jouer][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM).

<!-- URLs -->

[contenu-complet-sur-github]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/tree/main/01-contenus-du-cours/02-bases-de-donnees-eloquent-et-modeles/README.md
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1516534775068-bb4d260a7c4d?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1519389950473-47ba0277781c?fit=crop&h=720
[illustration-databases]:
	https://images.unsplash.com/photo-1558618666-fcd25c85cd64?fit=crop&h=720
[illustration-migrations]:
	https://images.unsplash.com/photo-1517694712202-14dd9538aa97?fit=crop&h=720
[illustration-orm]:
	https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?fit=crop&h=720
[illustration-eloquent]:
	https://images.unsplash.com/photo-1517694712089-e3ecc1e33a65?fit=crop&h=720
[illustration-crud]:
	https://images.unsplash.com/photo-1517694712202-14dd9538aa97?fit=crop&h=720
[illustration-mvc]:
	https://images.unsplash.com/photo-1504384308090-c894fdcc538d?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
