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
url: "https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/03-bases-de-donnees-eloquent-et-modeles/presentation.html"
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
- Décrire le concept de "query builder" de Laravel.

![bg right:40%][illustration-objectifs]

## Objectifs (2)

- Décrire le concept de "seeders" dans Laravel.
- Décrire la partie "modèle" du patron de conception MVC.
- Implémenter ces concepts avec Laravel pour réaliser le petit réseau social du
  mini-projet.

![bg right:40%][illustration-objectifs]

## Laravel et les bases de données

Laravel supporte plusieurs systèmes de gestion de bases de données (SGBD) :

- MySQL / MariaDB.
- PostgreSQL.
- SQLite.
- Et bien d'autres.

Configuration via le fichier `.env` pour faciliter le changement de SGBD sans
modifier le code de l'application.

## Migrations

Les migrations sont des fichiers qui décrivent la structure de la base de
données ainsi que son évolution au fil du temps.

Avantages :

- Versionner la structure de la base de données.
- Collaborer facilement sur les modifications de la base de données.
- Déployer la même structure sur plusieurs environnements.
- Séparer la logique de gestion des données de la logique de structure.

### Structure d'une migration

Chaque migration contient deux méthodes principales :

1. `up()` : définit les modifications à apporter à la base de données.
2. `down()` : définit comment annuler les modifications effectuées par `up()`.

Utilisation des classes `Schema` et `Blueprint` de Laravel pour définir les
tables et leurs colonnes.

### Créer une nouvelle migration

Pour créer une nouvelle migration :

```bash
php artisan make:migration create_demo_table
```

Laravel génère automatiquement un fichier avec un horodatage pour garantir
l'ordre d'exécution des migrations.

### Modifier une migration

Modifiez les méthodes `up()` et `down()` pour correspondre à la structure de la
table souhaitée.

> [!WARNING] Ne modifiez jamais une migration qui a déjà été appliquée en
> production. Créez une nouvelle migration si besoin.

### Appliquer les migrations

Pour appliquer les migrations à la base de données :

```bash
php artisan migrate
```

Cette commande exécute tous les fichiers de migration qui n'ont pas encore été
exécutés.

### Annuler les migrations

Pour annuler la dernière migration appliquée :

```bash
php artisan migrate:rollback
```

> [!WARNING] Annuler une migration en production peut entraîner des pertes de
> données. Soyez très prudent.e.

## Le concept d'ORM

Un ORM (Object-Relational Mapping) permet de lier les tables de la base de
données à des classes et les enregistrements à des objets.

Au lieu d'écrire du SQL :

```sql
SELECT * FROM users WHERE id = 1;
```

On utilise des objets :

```php
$user = User::find(1);
```

### Avantages d'un ORM

Les avantages d'un ORM :

- **Abstraction** : pas besoin de connaître SQL en détail.
- **Sécurité** : protection contre les injections SQL.
- **Maintenabilité** : code plus lisible et facile à modifier.
- **Portabilité** : changer de SGBD ne nécessite pas de modifier le code.

### Inconvénients d'un ORM

Les inconvénients d'un ORM :

- **Performance** : peut être moins performant que des requêtes SQL optimisées.
- **Abstraction** : peut masquer les détails de la base de données, ce qui peut
  être problématique pour le débogage.
- **Spécificité** : peut être spécifique à un framework ou un langage, limitant
  la portabilité du code.

### Quand utiliser un ORM ?

Un ORM est recommandé pour la plupart des applications car il permet de
développer plus rapidement et de manière plus sécurisée.

Pour des cas très spécifiques où la performance est critique, il peut être
nécessaire d'écrire des requêtes SQL personnalisées.

## Eloquent : l'ORM de Laravel

Eloquent est l'ORM inclus dans Laravel. Un modèle Eloquent représente une table
de la base de données.

Par convention, Laravel suppose que :

- Le modèle `User` correspond à la table `users`.
- Les clés primaires s'appellent `id`.
- Les timestamps sont gérés automatiquement.

### Créer un modèle

Pour créer un modèle Eloquent :

```bash
php artisan make:model User
```

Cela crée un fichier `app/Models/User.php` qui encapsule la logique d'accès aux
données et peut contenir des méthodes métier.

### Utiliser un modèle

Pour créer un nouvel enregistrement dans la table `users` :

```php
$user = new User();

$user->name = 'Alice';
$user->email = 'alice@example.com';

$user->save();
```

### Opérations CRUD avec Eloquent

Créer, lire, mettre à jour et supprimer des enregistrements :

```php
// Créer
$user = new User();
$user->name = 'Alice';
$user->save();

// Lire
$user = User::find(1);
$users = User::all();

// Mettre à jour
$user->name = 'Alice Updated';
$user->save();

// Supprimer
$user->delete();
```

### Gérer les relations entre modèles

Eloquent permet de définir des relations entre les modèles :

- **One-to-One** : un.e utilisateur.trice a un profil.
- **One-to-Many** : un.e utilisateur.trice a plusieurs posts.
- **Many-to-Many** : un.e utilisateur.trice peut avoir plusieurs rôles.

Exemple :

```php
class User extends Model {
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
```

## Requêtes et query builder

Eloquent utilise un _"query builder"_ pour construire les requêtes SQL de
manière fluide et orientée objet.

```php
// Chaîner plusieurs conditions
$users = User::where('active', true)
    ->where('created_at', '>', now()->subDays(7))
    ->orderBy('name')
    ->get();

// Compter
$count = User::where('active', true)->count();

// Première correspondance
$user = User::where('email', 'alice@example.com')->first();
```

## Seeders

Les seeders sont des classes qui permettent de remplir la base de données avec
des données prédéfinies.

Utilisations :

- Données factices pour tester les fonctionnalités de l'application.
- Données de référence (rôles d'utilisateur, catégories prédéfinies).
- Utilisateur.trices qui pourront administrer l'application.

Pour créer un seeder :

```bash
php artisan make:seeder UserSeeder
```

## Le modèle dans le patron de conception MVC

Le modèle est la première partie du patron Model-View-Controller (MVC) :

- **Modèle** : représente les données et la logique métier.
- **Vue** : affiche les données à l'utilisateur.
- **Contrôleur** : gère les requêtes et coordonne le modèle et la vue.

Le modèle est responsable de la gestion des données, de la validation, des
règles métier et de l'interaction avec la base de données.

### Pourquoi commencer par le modèle ?

Il est recommandé de commencer par le modèle lors du développement d'une
application, car cela permet de définir clairement les données et la logique
métier avant de se préoccuper de l'affichage ou de la gestion des requêtes.

Dans toute application, les technologies peuvent évoluer, mais les données sont
au cœur de l'application. Une approche centrée sur le modèle permet de
construire une base solide.

## Utiliser Artisan pour gérer les modèles

Laravel propose des commandes Artisan pour créer et gérer les modèles Eloquent
de manière rapide et efficace.

Pour créer un modèle et sa migration associée, consulter la documentation
officielle de Laravel :

<https://laravel.com/docs/12.x/eloquent#generating-model-classes>

## Conclusion

Les migrations, Eloquent et Artisan sont des outils puissants pour gérer les
bases de données dans Laravel.

Ils permettent de travailler avec les données de manière orientée objet, tout en
gardant une abstraction sur le SGBD utilisé.

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- (Re)lire le contenu de cours.
- Faire les exercices.
- Faire le mini-projet.
- Poser des questions si nécessaire.

➡️ [Visualiser le contenu complet sur GitHub.][contenu-complet-sur-github]

**N'hésitez pas à vous entraidez si vous avez des difficultés !**

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration principale][illustration-principale] par
  [Richard Jacobs](https://unsplash.com/@rj2747) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-elephants-drinking-water-8oenpCXktqQ).
- [Illustration][illustration-objectifs] par
  [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  [Unsplash](https://unsplash.com/photos/low-angle-view-of-ball-shoots-in-the-ring-j6brni7fpvs).
- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM).

<!-- URLs -->

[contenu-complet-sur-github]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/tree/main/01-contenus-du-cours/02-bases-de-donnees-eloquent-et-modeles/README.md
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
