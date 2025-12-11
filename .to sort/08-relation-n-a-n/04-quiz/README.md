---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: HEIG-VD DévProdMéd - Cours Laravel
description: Quiz - Database
header: "**Quiz 5**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Quiz 5 - Database

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> Qu'est ce qu'une relation de type `n:n` dans le domaine de la base de donnée ?
> (Veuillez donner un exemple)

## Réponse 1 - Réponse

Une relation n:n signifie qu'un enregistrement d'une table (T1) peut être
référencé par plusieurs enregistrements d'une autre table (T2) et réciproquement
un enregistrement de la table (T2) peut être référencé par plusieurs
enregistrement de la table (T1) Exemple : Une personne peut être employée par
plusieurs entreprises. Une entreprise peut employer plusieurs personnes. Pour
pouvoir disposer d'une relation n:n il faut une table supplémentaire nommée
table pivot

## Question 2 - Donnée

> Combien de tables sont impliquées dans une relation `n-n` ?

## Réponse 2 - Réponse

Trois tables sont impliquées

- Table 1
- Table 2
- Table pivot

## Question 3 - Donnée

> Comment doit se nommer la table pivot dans `Laravel` ?

## Réponse 3 - Réponse

Le nom de la table pivot doit contenir le nom des deux tables (au singulier !)
et par ordre alphabétique

> Exemple :

- table1 => personnes => singulier : personne
- table2 => entreprises => singulier : entreprise
- entreprise vient avant personne (ordre alphabétique)
- donc la table pivot doit se nommer `entreprise_personne`

> [Documentation officielle](https://laravel.com/docs/9.x/eloquent-relationships#many-to-many)

## Question 4 - Donnée

> Comment définit-on une relation `n-n` dans les `classes-modèles` ?

## Réponse 4 - Réponse

Si on se base sur les tables de la question 1, il faut compléter deux
`classes-modèles` (`Personne.php` et `Entreprise.php`) Dans la classe `Personne`

```php
...
public function entreprises() {
    return $this->belongsToMany(Entreprise::class);
}
...
```

Dans la classe `Entreprise`

```php
...
public function personnes() {
    return $this->belongsToMany(Personne::class);
}
...
```

## Question 5 - Donnée

Dans la méthode du contrôleur qui met à jour la table pivot (question 5), quelle
instruction permet d'ajouter une relation entre un article et un mot-clé dans la
table pivot ?

## Réponse 5 - Réponse

Il s'agit de la méthode `->attach()` L'instruction est la suivante :

```php
$article->motcles()->attach($mot_ref->id);
```

## Question 6 - Donnée

> Quelle commande artisan permet de créer une migration pour une table pivot
> entre deux modèles `voiture` et `accessoire` ?

## Réponse 6 - Réponse

```bash
php artisan make:migration create_accessoire_voiture_table
```

> ✅ Respecter le format `create_nomTable_table` (au singulier et par ordre
> alphabétique).

## Question 7 - Donnée

> Quelle méthode Eloquent permet d’ajouter un modèle existant à une relation
> many-to-many **sans dupliquer les relations existantes** ?

## Réponse 7 - Réponse

```php
$article->motcles()->syncWithoutDetaching([$motcle->id]);
```

> Cette méthode ajoute la relation **seulement si elle n’existe pas déjà**.

## Question 8 - Donnée

> Que se passe-t-il si la table pivot n’est pas nommée selon les conventions
> Laravel (`ordre alphabétique` et `singulier`) ?

## Réponse 8 - Réponse

Laravel ne reconnaîtra pas automatiquement la table pivot.  
Il faudra alors la spécifier manuellement avec :

```php
return $this->belongsToMany(...)->usingTable('nom_personnalisé');
```

## Question 9 - Donnée

> Quelle méthode du modèle permet de **supprimer toutes les relations** entre un
> enregistrement et la table liée (dans la table pivot) ?

## Réponse 9 - Réponse

```php
$article->motcles()->detach();
```

> Cette instruction vide toutes les lignes de la table pivot pour cet article.

## Question 10 - Donnée

> Comment Laravel associe-t-il les modèles à leurs tables par défaut ? (ex:
> `Article`, `Motcle`)

## Réponse 10 - Réponse

Laravel utilise une convention :  
**Nom du modèle au pluriel et en snake_case** :

- `Article` → `articles`
- `Motcle` → `motcles`

## Question 11 - Donnée

> Peut-on ajouter des colonnes supplémentaires dans une table pivot ? Comment
> les exploiter dans Laravel ?

## Réponse 11 - Réponse

Oui, on peut ajouter des colonnes comme `ordre`, `created_by`, etc.

Dans ce cas :

- Créer un **modèle dédié** pour la table pivot
- Et utiliser la méthode `withPivot(...)` :

```php
return $this->belongsToMany(...)->withPivot('ordre');
```

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?
