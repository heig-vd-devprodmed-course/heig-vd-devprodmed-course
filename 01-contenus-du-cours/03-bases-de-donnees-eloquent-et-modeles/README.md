# Bases de données, Eloquent et modèles

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Voici quelques informations relatives à ce contenu.
>
> **Ressources annexes**
>
> - Autres formats du support de cours : [Présentation (web)][presentation-web]
>   · [Présentation (PDF)][presentation-pdf].
> - Exercices : [Accéder au contenu](./01-exercices/README.md).
> - Mini-projet : [Accéder au contenu](./02-mini-projet/README.md).
>
> **Objectifs**
>
> À l'issue de cette séance, les personnes qui étudient devraient être capables
> de :
>
> - Décrire comment Laravel peut interagir avec plusieurs types de bases de
>   données.
> - Décrire le concept de migrations avec Laravel.
> - Décrire le concept d'un ORM tel qu'Eloquent.
> - Décrire la partie "modèle" du patron de conception MVC.
> - Utiliser Eloquent avec Laravel.
> - Implémenter ces concepts avec Laravel pour réaliser le petit réseau social
>   du mini-projet.
>
> **Méthodes d'enseignement et d'apprentissage**
>
> Les méthodes d'enseignement et d'apprentissage utilisées pour animer la séance
> sont les suivantes :
>
> - Présentation magistrale.
> - Discussions collectives.
> - Travail en autonomie.
>
> **Méthodes d'évaluation**
>
> L'évaluation prend la forme d'exercices et d'un mini-projet à réaliser en
> autonomie en classe ou à la maison.
>
> L'évaluation se fait en utilisant les critères suivants :
>
> - Capacité à répondre avec justesse.
> - Capacité à argumenter.
> - Capacité à réaliser les tâches demandées.
> - Capacité à s'approprier les exemples de code.
> - Capacité à appliquer les exemples de code à des situations similaires.
>
> Les retours se font de la manière suivante :
>
> - Corrigé des exercices.
> - Corrigé du mini-projet.
>
> L'évaluation ne donne pas lieu à une note.

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Laravel et les bases de données](#laravel-et-les-bases-de-données)
- [Migrations](#migrations)
  - [Structure d'une migration](#structure-dune-migration)
  - [Créer une nouvelle migration](#créer-une-nouvelle-migration)
  - [Modifier une migration existante](#modifier-une-migration-existante)
  - [Appliquer les migrations](#appliquer-les-migrations)
  - [Annuler les migrations](#annuler-les-migrations)
- [Le concept d'ORM](#le-concept-dorm)
  - [Avantages d'un ORM](#avantages-dun-orm)
  - [Inconvénients d'un ORM](#inconvénients-dun-orm)
- [Eloquent : l'ORM de Laravel](#eloquent--lorm-de-laravel)
  - [Créer un modèle](#créer-un-modèle)
  - [Opérations CRUD avec Eloquent](#opérations-crud-avec-eloquent)
  - [Gérer les relations entre modèles](#gérer-les-relations-entre-modèles)
- [Requêtes et query builder](#requêtes-et-query-builder)
- [Seeders](#seeders)
- [Le modèle dans le patron de conception MVC](#le-modèle-dans-le-patron-de-conception-mvc)
- [Utiliser Artisan pour gérer les modèles](#utiliser-artisan-pour-gérer-les-modèles)
- [Aller plus loin](#aller-plus-loin)
  - [Les transactions](#les-transactions)
  - [Les factories](#les-factories)
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs de permettre aux personnes qui étudient de
comprendre et d'appliquer les bases de données, les migrations et l'ORM Eloquent
de Laravel.

Ce contenu repose sur la documentation officielle suivante :

- <https://laravel.com/docs/12.x/database>
- <https://laravel.com/docs/12.x/eloquent>

De façon plus concise, à l'issue de cette séance, les personnes qui étudient
devraient être capables de :

- Décrire comment Laravel peut interagir avec plusieurs types de bases de
  données.
- Décrire le concept de migrations avec Laravel.
- Décrire le concept d'un ORM tel qu'Eloquent.
- Décrire la partie "modèle" du patron de conception MVC.
- Utiliser Eloquent avec Laravel.
- Implémenter ces concepts avec Laravel pour réaliser le petit réseau social du
  mini-projet.

## Laravel et les bases de données

Laravel supporte plusieurs systèmes de gestion de bases de données (SGBD) :

- MySQL / MariaDB.
- PostgreSQL.
- SQLite.
- Et bien d'autres.

Cette intégration est facilitée par l'utilisation de pilotes de base de données
PHP et du fichier de configuration `.env`.

Le fichier de configuration `.env` permet de définir les paramètres de connexion
à la base de données de manière simple et sécurisée.

> [!CAUTION]
>
> Pour rappel, ce fichier `.env` ne doit jamais être partagé publiquement car il
> peut contenir des informations sensibles comme des mots de passe ou des clés
> d'API. Vous devez toujours garder ce fichier privé et sécurisé.

Grâce à ce fichier, vous pouvez facilement changer de SGBD sans modifier le code
de l'application.

Par défaut, Laravel utilise SQLite pour le développement local avec la
configuration suivante dans `.env` :

```text
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Les lignes commençant par `#` sont des commentaires et ne sont pas prises en
compte.

Si vous avez le souhait d'utiliser MySQL, vous pouvez modifier le fichier `.env`
comme suit

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base_de_donnees
DB_USERNAME=utilisateur
DB_PASSWORD=mot_de_passe
```

Dans le contexte de ce cours, nous allons rester sur SQLite pour la simplicité
de configuration. Mais si dans le futur vous souhaitez utiliser un autre SGBD ou
lors du déploiement sur un serveur de production, vous pourrez facilement
adapter la configuration.

Grâce à ces variables d'environnement, Laravel abstrait les détails de connexion
à la base de données, ce qui facilite le développement et le déploiement des
applications.

Il n'est donc plus nécessaire d'utiliser des fichiers de configuration INI comme
étudié en ProgServ2, Laravel gère cela de manière plus moderne.

## Migrations

Les migrations sont des fichiers qui décrivent la structure de la base de
données ainsi que son évolution au fil du temps.

Les migrations offrent plusieurs avantages. Elles permettent de :

- Versionner la structure de la base de données.
- Collaborer facilement sur les modifications de la base de données.
- Déployer la même structure sur plusieurs environnements.
- Séparer la logique de gestion des données de la logique de structure de la
  base de données. Il est ainsi plus facile de maintenir et d'évoluer la base de
  données de façon indépendante du code applicatif.

### Structure d'une migration

Laravel utilise des classes PHP pour définir les migrations.

Lors de l'initialisation d'un projet Laravel, un dossier `database/migrations/`
est créé pour stocker les fichiers de migration.

Ce dossier contient déjà des migrations de base pour les aspects suivants :

- Gestion des utilisateur.trices.
- Réinitialisation des mots de passe.
- Gestion des sessions.
- Gestion du cache (configuration avancée de Laravel qui ne sera pas abordée
  dans ce cours).
- Gestion des files d'attente (configuration avancée de Laravel qui ne sera pas
  abordée dans ce cours).

Étudions maintenant la structure d'une migration typique :

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
```

Cette migration est la première des migrations créées automatiquement lors de
l'initialisation d'un projet Laravel.

Chaque migration contient deux méthodes principales :

1. `up()` : définit les modifications à apporter à la base de données
   (création/modification de tables, colonnes, index, etc.).
2. `down()` : définit comment annuler les modifications effectuées par `up()`.

Vous remarquerez peut-être que cette classe utilise des classes et des méthodes
spécifiques de Laravel, telles que `Schema` et `Blueprint`, pour faciliter la
définition de la structure de la base de données. Elles sont automatiquement
importées par l'autoloader de Composer.

Ces classes fournissent une API fluide pour définir les tables et leurs
colonnes.

Par exemple, dans la méthode `up()`, nous créons une table `users` avec les
colonnes suivantes :

- `id` : clé primaire auto-incrémentée.
- `name` : chaîne de caractères pour le nom de l'utilisateur.
- `email` : chaîne de caractères unique pour l'adresse e-mail.
- `email_verified_at` : timestamp nullable pour la vérification de l'e-mail.
- `password` : chaîne de caractères pour le mot de passe.
- `remember_token` : token pour la fonctionnalité "se souvenir de moi".
- `timestamps` : colonnes `created_at` et `updated_at` pour suivre la création
  et la mise à jour des enregistrements.

La création de cette table utilise la méthode `Schema::create()` qui prend le
nom de la table à créer et une fonction avec l'argument `Blueprint $table` pour
définir les colonnes.

### Créer une nouvelle migration

Pour créer une nouvelle migration, vous pouvez utiliser la commande Artisan
suivante dans le terminal à la racine de votre projet Laravel :

```bash
php artisan make:migration create_demo_table
```

Pour rappel, Artisan est l'interface en ligne de commande de Laravel qui permet
d'exécuter diverses tâches liées au développement d'applications Laravel.

Le résultat devrait ressembler à ceci :

```text
   INFO  Migration [database/migrations/2026_01_28_144030_create_demo_table.php] created successfully.
```

Cela crée un fichier de migration dans `database/migrations/`. Notez que le nom
du fichier inclut un horodatage pour garantir l'ordre d'exécution des
migrations.

Le contenu de ce nouveau fichier de migration ressemblera à ceci :

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demo');
    }
};
```

Les méthodes `up()` et `down()` sont déjà définies, mais vous devrez les
modifier pour correspondre à la structure de la table que vous souhaitez créer
ou modifier.

Laravel a réussi à identifier que vous souhaitiez créer une nouvelle table
nommée `demo` en se basant sur le nom de la migration `create_demo_table`. De ce
fait, Laravel a automatiquement généré le code de création et de suppression de
cette table que vous pourrez modifier selon vos besoins.

### Modifier une migration existante

Imaginons que nous souhaitons modifier cette migration pour ajouter un champ
`username` à la table `users` existante. Nous pourrions modifier la méthode
`up()` comme suit :

```php
public function up(): void
{
}
```

> [!WARNING]
>
> Ne modifiez jamais une migration qui a déjà été appliquée en production. Si
> vous avez besoin de modifier la structure de la base de données qui a été
> appliquée en production, créez une nouvelle migration.
>
> Sans quoi, des inconsistances pourraient apparaître entre les environnements
> de développement et de production qui sont difficiles à résoudre.

### Appliquer les migrations

```bash
php artisan migrate
```

Cette commande exécute tous les fichiers de migration qui n'ont pas encore été
exécutés.

### Annuler les migrations

```bash
php artisan migrate:rollback
```

## Le concept d'ORM

Un ORM (Object-Relational Mapping) est une technique qui permet de mapper les
tables de la base de données à des classes et les enregistrements à des objets.

Au lieu d'écrire des requêtes SQL :

```sql
SELECT * FROM users WHERE id = 1;
```

Avec un ORM, on utilise des objets :

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

TODO

## Eloquent : l'ORM de Laravel

Eloquent est l'ORM inclus dans Laravel. Un modèle Eloquent représente une table
de la base de données.

### Créer un modèle

```bash
php artisan make:model User
```

Cela crée un fichier `app/Models/User.php` :

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
}
```

Par convention, Laravel suppose que :

- Le modèle `User` correspond à la table `users`.
- Les clés primaires s'appellent `id`.
- Les timestamps sont gérés automatiquement.

#### Attributs à assigner en masse

Par défaut, Eloquent protège contre l'assignation de masse. Il faut expliciter
quels attributs peuvent être assignés :

```php
class User extends Model
{
    protected $fillable = ['name', 'email', 'password'];
}
```

#### Timestamps automatiques

Eloquent gère automatiquement `created_at` et `updated_at` :

```php
$user = User::find(1);
echo $user->created_at; // Date et heure de création
echo $user->updated_at; // Date et heure de dernière modification
```

### Opérations CRUD avec Eloquent

#### Créer

```php
$user = new User();
$user->name = 'Alice';
$user->email = 'alice@example.com';
$user->save();

// Ou en une seule ligne
User::create([
    'name' => 'Bob',
    'email' => 'bob@example.com',
]);
```

#### Lire

```php
// Récupérer un utilisateur par ID
$user = User::find(1);

// Récupérer tous les utilisateurs
$users = User::all();

// Récupérer avec une condition
$users = User::where('email', 'like', '%example.com')->get();
```

#### Mettre à jour

```php
$user = User::find(1);
$user->name = 'Alice Updated';
$user->save();

// Ou directement
User::where('id', 1)->update(['name' => 'Alice Updated']);
```

#### Supprimer

```php
$user = User::find(1);
$user->delete();

// Ou directement
User::destroy(1);
```

### Gérer les relations entre modèles

TODO

## Requêtes et query builder

```php
// Chaîner plusieurs conditions
$users = User::where('active', true)
    ->where('created_at', '>', now()->subDays(7))
    ->orderBy('name')
    ->get();

// Compter
$count = User::where('active', true)->count();

// Première correspond
$user = User::where('email', 'alice@example.com')->first();
```

## Seeders

## Le modèle dans le patron de conception MVC

Le modèle est la première partie du patron Model-View-Controller (MVC) :

- **Modèle** : représente les données et la logique métier.
- **Vue** : affiche les données à l'utilisateur.
- **Contrôleur** : gère les requêtes et coordonne le modèle et la vue.

Le modèle Eloquent encapsule la logique d'accès aux données et peut contenir des
méthodes métier :

```php
class User extends Model
{
    // Accesseur : formate le nom en majuscules
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
        );
    }

    // Méthode métier
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
```

## Utiliser Artisan pour gérer les modèles

TODO

https://laravel.com/docs/12.x/eloquent#generating-model-classes

## Aller plus loin

### Les transactions

### Les factories

Laravel propose également un concept de "factories" pour générer des données
factices pour les tests et le développement.

TODO

## Conclusion

Les migrations, Eloquent et Artisan sont des outils puissants pour gérer les
bases de données dans Laravel. Ils permettent de travailler avec les données de
manière orientée objet, tout en gardant une abstraction sur le SGBD utilisé.

## Exercices

Nous vous invitons maintenant à réaliser les exercices de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les exercices et leur corrigé ici :
[Exercices](./01-exercices/README.md).

## Mini-projet

Nous vous invitons maintenant à réaliser le mini-projet de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les détails du mini-projet ici :
[Mini-projet](./02-mini-projet/README.md).

## À faire pour la prochaine séance

Chaque personne est libre de gérer son temps comme elle le souhaite. Cependant,
il est recommandé pour la prochaine séance de :

- Relire le support de cours si nécessaire.
- Finaliser les exercices qui n'ont pas été terminés en classe.
- Finaliser la partie du mini-projet qui n'a pas été terminée en classe.

<!-- URLs -->

[presentation-web]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/02-bases-de-donnees-eloquent-et-modeles/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/02-bases-de-donnees-eloquent-et-modeles/02-bases-de-donnees-eloquent-et-modeles-presentation.pdf
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
