# Bases de données, Eloquent et modèles - Exercices

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Toutes les informations relatives à ce contenu sont décrites dans le
> [contenu principal](../README.md).

## Table des matières

- [Table des matières](#table-des-matières)
- [Exercices](#exercices)
  - [Exercice 1](#exercice-1)
  - [Exercice 2](#exercice-2)
  - [Exercice 3](#exercice-3)
  - [Exercice 4](#exercice-4)
  - [Exercice 5](#exercice-5)
  - [Exercice 6](#exercice-6)
  - [Exercice 7](#exercice-7)
  - [Exercice 8](#exercice-8)

## Exercices

> [!NOTE]
>
> Bien que ces exercices puissent paraître simples et que leur solution est
> disponible dans ce même document, il est fortement recommandé de les réaliser
> sans consulter les solutions au préalable.
>
> Ils ont pour but de vous former et de pratiquer les concepts vus dans le
> contenu de cours.
>
> Il est donc important de les faire par vous-même avant de vérifier vos
> réponses avec les solutions fournies.

### Exercice 1

Où peut-on trouver dans la documentation officielle de Laravel la documentation
sur les bases de données et Eloquent ?

<details>
<summary>Afficher la solution</summary>

La documentation officielle de Laravel sur les bases de données et Eloquent se
trouve aux adresses suivantes :

- <https://laravel.com/docs/12.x/database>
- <https://laravel.com/docs/12.x/eloquent>

</details>

### Exercice 2

Où peut-on trouver dans la documentation officielle de Laravel la documentation
sur les migrations de base de données ?

<details>
<summary>Afficher la solution</summary>

La documentation officielle de Laravel sur les migrations de base de données se
trouve à l'adresse suivante : <https://laravel.com/docs/12.x/migrations>.

</details>

### Exercice 3

Où peut-on trouver dans la documentation officielle de Laravel la documentation
sur les seeders de base de données ?

<details>
<summary>Afficher la solution</summary>

La documentation officielle de Laravel sur les seeders de base de données se
trouve à l'adresse suivante : <https://laravel.com/docs/12.x/seeding>.

</details>

### Exercice 4

Où peut-on trouver dans la documentation officielle de Laravel la documentation
sur le query builder de Laravel ?

<details>
<summary>Afficher la solution</summary>

La documentation officielle de Laravel sur le query builder se trouve à
l'adresse suivante : <https://laravel.com/docs/12.x/database#query-builder>.

</details>

### Exercice 5

Quelle est la commande pour créer un modèle Eloquent avec sa migration associée
dans Laravel ? Où peut-on trouver cette information dans la documentation
officielle de Laravel ?

<details>
<summary>Afficher la solution</summary>

La commande pour créer un modèle Eloquent avec sa migration associée dans
Laravel est la suivante :

```bash
php artisan make:model NomDuModel --migration
```

Vous pouvez trouver cette information dans la documentation officielle de
Laravel à l'adresse suivante :
<https://laravel.com/docs/12.x/eloquent#generating-models>.

</details>

### Exercice 6

Quelle est la commande pour appliquer les migrations de base de données dans
Laravel ? Quelle est la commande pour annuler la dernière migration appliquée ?
Où peut-on trouver ces informations dans la documentation officielle de Laravel
?

<details>
<summary>Afficher la solution</summary>

La commande pour appliquer les migrations de base de données dans Laravel est la
suivante :

```bash
php artisan migrate
```

La commande pour annuler la dernière migration appliquée est la suivante :

```bash
php artisan migrate:rollback
```

Vous pouvez trouver ces informations dans la documentation officielle de Laravel
à l'adresse suivante :
<https://laravel.com/docs/12.x/migrations#running-migrations> et
<https://laravel.com/docs/12.x/migrations#rolling-back-migrations>.

</details>

### Exercice 7

Quelle est la commande pour créer un seeder de base de données dans Laravel ? Où
peut-on trouver cette information dans la documentation officielle de Laravel ?

<details>
<summary>Afficher la solution</summary>

La commande pour créer un seeder de base de données dans Laravel est la suivante
:

```bash
php artisan make:seeder NomDuSeeder
```

Vous pouvez trouver cette information dans la documentation officielle de
Laravel à l'adresse suivante :
<https://laravel.com/docs/12.x/seeding#generating-seeders>.

</details>

### Exercice 8

Quelle est la commande pour exécuter les seeders de base de données dans Laravel
? S'il faut vider la base de données avant d'exécuter les seeders, quelle est la
commande à utiliser ? Où peut-on trouver ces informations dans la documentation
officielle de Laravel ?

<details>
<summary>Afficher la solution</summary>

La commande pour exécuter les seeders de base de données dans Laravel est la
suivante :

```bash
php artisan db:seed
```

Si vous souhaitez vider la base de données avant d'exécuter les seeders, vous
pouvez utiliser la commande suivante :

```bash
php artisan migrate:fresh --seed
```

Vous pouvez trouver ces informations dans la documentation officielle de Laravel
à l'adresse suivante : <https://laravel.com/docs/12.x/seeding#running-seeders>.

</details>

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
