---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: HEIG-VD DévProdMéd - Cours Laravel
description: Quiz - middleware et relation 1:n
header: "**Quiz 7**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Quiz 7 - middleware et relation 1:n

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> **Qu'est ce qu'une relation de type 1:n dans le domaine de la base de donnée
> ?**

## Réponse 1 - Réponse

Une relation 1:n signifie qu'un enregistrement d'une table (T1) peut être
référencée par plusieurs enregistrements d'une autre table (T2) Une personne
peut avoir plusieurs voitures. Le lien entre la personne et la voiture est
définie dans la table voiture par la clé étrangère id_personne

```txt
personnes           voitures
═════════           ════════
id ───────────>     id_personne
nom                 marque
prénom              prix
                    id
```

## Question 2 - Donnée

> **Comment définit-on une clé étrangère dans une migration ?**

## Réponse 2 - Réponse

La clé étrangère se définit avec la méthode `foreign(...)` Ex :

```php
$table->foreign('id_personne')->references('id')->on('personnes');
```

## Question 3 - Donnée

> **Quel est le rôle d'un 'seeder' dans `Laravel` ?**

## Réponse 3 - Réponse

Un seeder une classe qui permet de peupler une table d'une base de donnée.

```php
public function run(): void {
    for ($i = 1; $i <= 10; $i++) {
     	User::create(['name' => 'Nom' . $i,
                         'email' => 'email' . $i . '@gmx.ch',
                         'password' => 'password' . $i,
                         'admin' => rand(0, 1)]);
     }
}
```

## Question 4 - Donnée

> **Lorsque l'on a plusieurs fichiers dans le répertoire `database\seeders`,
> comment définit-on l'ordre d'exécution ?**

## Réponse 4 - Réponse

L'ordre est à définir dans la classe `app\database\seeders\DatabaseSeeder` dans
la méthode `run()` Ex :

```php
class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call(UsersTableSeeder::class);
		$this->call(ArticlesTableSeeder::class);
	}
}
```

## Question 5 - Donnée

> **Eloquent (l'outil ORM) a besoin de classe(s) modèle(s) pour pouvoir
> interagir avec la base de données. Comment définit-on la relation `1:n` dans
> les deux classes modèles (Un User peut créer plusieurs Article) ?**

## Réponse 5 - Réponse (1/2)

La classe modèle correspondant au 1: doit contenir une méthode portant le nom de
la table correspondant au :n au pluriel Ex :

```php
public function articles() {   // dans la classe modèle User
    return $this->hasMany(App\Models\Article::class);
}
```

## Réponse 5 - Réponse (2/2)

La classe modèle correspondant au :n doit contenir une méthode portant le nom de
la table correspondant au 1: au singulier Ex :

```php
public function user() {    // dans la classe modèle Article
    return $this->belongsTo(App\Models\User::class);
}
```

## Question 6 - Donnée

> **A quoi sert l'outil `tinker` dans `Laravel` ?**

## Réponse 6 - Réponse

Il sert à pouvoir exécuter directement des commandes Eloquent

## Question 7 - Donnée

> **Quelle commande permet de lancer l'outil `tinker` ?**

## Réponse 7 - Réponse

```bash
php artisan tinker
```

## Question 8 - Donnée

> **Quelle commande Eloquent permet de récupérer tous les articles de
> l'utilisateur ayant l'identifiant : 12 ?**

## Réponse 8 - Réponse

```php
App\Models\User::find(12)->articles;
```

## Question 9 - Donnée

> **Comment quitte-t-on l'outil `tinker` ?**

## Réponse 9 - Réponse

Il suffit de taper :

```bash
quit
```

## Question 10 - Donnée

> **Qu'est ce qu'un `middelware` ?**

## Réponse 10 - Réponse

Un middleware permet d'effectuer un traitement à l'arrivée ou au départ d'une
requête. [Documentation](https://laravel.com/docs/11.x/middleware)

## Question 11 - Donnée

> **Quelle commande permet de créer un nouveau middleware ?**

## Réponse 11 - Réponse

```bash
php artisan make:middleware nom_du_middleware
```

## Question 12 - Donnée

> **Quelle méthode doit-on implémenter dans le `middleware` pour que celui-ci
> fonctionne correctement ?**

## Réponse 12 - Réponse

Il s'agit de la méthode `handle(...)`

## Question 13 - Donnée

> **Comment gère-t-on l'authentification dans `Laravel` ?**

## Réponse 13 - Réponse

Il existe différentes solutions :
[Documentation](https://laravel.com/docs/11.x/authentication) En voici une :
(Une fois que `NodeJs` est installé) Il faut taper la commande :
`composer require laravel/breeze --dev` (qui télécharge et installe la nouvelle
libraire) puis la commande : `php artisan breeze:install blade` Crée/modifie les
fichiers nécessaires (vues, contrôleurs, routes, middleware) dans notre
application pour pouvoir faire une authentification. Tout est prêt !

## Question 14 - Donnée

> **Après le login, on se retrouve sur une vue par défaut (`dashboard`)
> indiquant que l'on est connecté. Comment changer la destination après le login
> ?**

## Réponse 14 - Réponse (1/2)

Il faut changer les instructions de redirection dans deux classes :

- `app/Http/Controllers/Auth/RegisteredUserController.php`

  Changer la ligne 49 :

  ```php
  return redirect(route('dashboard', absolute: false));
  ```

  en

  ```php
  return redirect('/urlCheminDesire');
  ```

## Réponse 14 - Réponse (2/2)

- `app/Http/Controllers/Auth/AuthenticatedSessionController.php` :

  ```php
  return redirect()->intended(route('dashboard', absolute: false));
  ```

  en

  ```php
  return redirect()->intended('/urlCheminDesire');
  ```

## Question 15 - Donnée

> **Idem 14.) mais après le `logout` ?**

## Réponse 15 - Réponse

Changer la ligne (46) du fichier
`app/Http/Controllers/Auth/AuthenticatedSessionController.php` :

```php
return redirect('/');
```

en

```php
return redirect('/urlCheminDesire');
```

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?
