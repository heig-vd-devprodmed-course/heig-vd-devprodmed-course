---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: HEIG-VD - Quiz Bases de données avec Laravel
header: "**Quiz - Bases de données avec Laravel**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Quiz - Bases de données avec Laravel

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> Quel fichier de `Laravel` permet la configuration de la connexion à un Système
> de Gestion de Base de Données ?

## Réponse 1 - Réponse

Le fichier `.env` :

```env
DB_CONNECTION=sqlite
```

## Question 2 - Donnée

> À quoi sert la commande `php artisan migrate` ?

## Réponse 2 - Réponse

Cette commande crée une table `migrations` dans la base de données permettant à
Laravel de gérer les différentes tables.

## Question 3 - Donnée

> À quoi sert la commande `php artisan make:migration create_unNomTable_table` ?

## Réponse 3 - Réponse

Elle permet de créer un fichier dans le répertoire :

```bash
/database/migrations/0000_00_00_000000_create_unNomTable_table.php
```

## Question 4 - Donnée

> À quoi sert le fichier de migration généré par la commande précédente ?

## Réponse 4 - Réponse

Ce fichier permet de créer et supprimer la table `unNomTable` dans la base de
données. Il contient deux méthodes :

- **`up()`** : définit les champs, types et contraintes de la table.
- **`down()`** : supprime la table.

## Question 5 - Donnée

> Quelles commandes `php artisan` permettent de créer ou supprimer des tables
> dans la base de données ?

## Réponse 5 - Réponse

- **Créer toutes les tables définies** :
  ```bash
  php artisan migrate
  ```
- **Supprimer toutes les tables définies** :
  ```bash
  php artisan migrate:rollback
  ```

## Question 6 - Donnée

> À quoi sert `Eloquent` dans Laravel ?

## Réponse 6 - Réponse

`Eloquent` est un ORM (`Object-Relational-Mapping`). Il permet de représenter
les données sous forme d’objets et simplifie les opérations **CRUD**
(`Create, Read, Update, Delete`) sur la base de données.

## Question 7 - Donnée

> Comment appelle-t-on les classes permettant à `Eloquent` de fonctionner ?

## Réponse 7 - Réponse

On appelle ces classes des **modèles** (`Model`).

## Question 8 - Donnée

> Comment crée-t-on un modèle `Eloquent` en Laravel ?

## Réponse 8 - Réponse

```bash
php artisan make:model NomDuModele
```

## Question 9 - Donnée

> Dans quel répertoire se trouvent les classes-modèles ?

## Réponse 9 - Réponse

Les classes-modèles se trouvent dans :

```bash
/app/Models
```

## Question 10 - Donnée

> Que doit-on définir dans une classe-modèle ?

## Réponse 10 - Réponse

Le nom de la table associée au modèle. Si le nom n’est pas défini, Laravel
utilisera automatiquement un nom au **pluriel**.

Exemple :

```php
class Commande extends Model {}
// Laravel l’associe par défaut à la table `commandes`
```

## Question 11 - Donnée

> La commande `php artisan migrate` crée deux tables dans la base de données :
> `migrations` et `sqlite_sequence`. Combien de migrations y a-t-il dans le
> répertoire `database/migrations` par défaut ?

## Réponse 11 - Réponse

Il y a **3 migrations de base**, plus celles ajoutées par l’utilisateur.

## Question 12 - Donnée

> Combien de tables crée la commande `php artisan migrate` par défaut ?

## Réponse 12 - Réponse

Plus que prévu ! Une migration peut gérer **plusieurs tables** en une seule
exécution.

Exemple :

```bash
0001_01_01_000000_create_users_table.php  # Crée 3 tables en réalité !
```

## Fin du quiz

Merci pour votre participation !
