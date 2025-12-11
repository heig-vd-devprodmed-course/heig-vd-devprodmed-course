---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: Relation many-to-many (n:n) avec Laravel
description: Présentation courte - HEIG-VD - DévProdMéd Course
header: "Relation n:n avec Laravel"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Database : Relation many-to-many (n:n)

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

- Identifier les situations nécessitant une relation many-to-many.
- Créer une table pivot dans Laravel avec les bonnes conventions.
- Définir correctement les relations `belongsToMany` dans les modèles.

## Objectifs (2/2)

- Attacher et détacher dynamiquement des relations (ex : `attach`, `detach`,
  `sync`).
- Créer un champ texte pour entrer des mots-clés séparés par des virgules.
- Valider ce champ avec une expression régulière personnalisée.

## Rappel : c’est quoi une relation n:n ?

- Chaque élément de la table A peut être lié à **plusieurs** éléments de la
  table B, et inversement.
- Exemples :
  - Articles et mots-clés
  - Utilisatrices et rôles
- Requiert une **table pivot** qui joue le rôle de lien.

## Convention Laravel : nom de la table pivot

- Format : `singulier_table1_singulier_table2`
- En **ordre alphabétique**
- Exemple :
  - Tables : `articles`, `keyword`
  - Pivot : `article_keyword`

## Table pivot : que doit-elle contenir ?

- En général :
  - `id`, `timestamps`
  - `table1_id`, `table2_id`
  - **Clés étrangères** avec `foreign()` et `onDelete()`
- Optionnel : autres colonnes (ex : `status`, `created_by`)

## Modèle Eloquent

Dans les deux modèles :

```php
// Article.php
public function motcles()
{
    return $this->belongsToMany(Motcle::class);
}

// Motcle.php
public function articles()
{
    return $this->belongsToMany(Article::class);
}
```

## Attacher / détacher dynamiquement

```php
// Attacher un mot-clé à un article
$article->motcles()->attach($motcle_id);

// Supprimer toutes les associations
$article->motcles()->detach();

// Ajouter et créer si besoin
$article->motcles()->save($motcle);
```

## Attention lors de la suppression

Avant de supprimer un article, détacher ses mots-clés :

```php
$article->motcles()->detach();
$article->delete();
```

Sinon Laravel lève une erreur à cause des contraintes de clé étrangère.

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
