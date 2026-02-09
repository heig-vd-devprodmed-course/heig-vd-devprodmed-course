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
>   · [Présentation (PDF)][presentation-pdf]
> - Exercices : [Accéder au contenu](./01-exercices/README.md)
> - Mini-projet : [Accéder au contenu](./02-mini-projet/README.md)
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
> - Décrire le concept de "query builder" de Laravel.
> - Décrire le concept de "seeders" dans Laravel.
> - Décrire la partie "modèle" du patron de conception MVC.
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
  - [Modifier une migration](#modifier-une-migration)
  - [Appliquer les migrations](#appliquer-les-migrations)
  - [Annuler les migrations](#annuler-les-migrations)
- [Le concept d'ORM](#le-concept-dorm)
  - [Avantages d'un ORM](#avantages-dun-orm)
  - [Inconvénients d'un ORM](#inconvénients-dun-orm)
  - [Quand utiliser un ORM ?](#quand-utiliser-un-orm-)
- [Eloquent : l'ORM de Laravel](#eloquent--lorm-de-laravel)
  - [Créer un modèle](#créer-un-modèle)
  - [Utiliser un modèle](#utiliser-un-modèle)
  - [Opérations CRUD avec Eloquent](#opérations-crud-avec-eloquent)
  - [Gérer les relations entre modèles](#gérer-les-relations-entre-modèles)
- [Requêtes et query builder](#requêtes-et-query-builder)
- [Seeders](#seeders)
- [Le modèle dans le patron de conception MVC](#le-modèle-dans-le-patron-de-conception-mvc)
  - [Pourquoi commencer par le modèle ?](#pourquoi-commencer-par-le-modèle-)
- [Utiliser Artisan pour gérer les modèles](#utiliser-artisan-pour-gérer-les-modèles)
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [Questions d'évaluation](#questions-dévaluation)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Dans ce contenu, nous allons explorer comment Laravel gère les bases de données,
les migrations, les modèles Eloquent et les seeders. Nous verrons également
comment utiliser Artisan pour créer et gérer les migrations et les modèles.

Ce contenu repose sur la documentation officielle suivante :

- <https://laravel.com/docs/12.x/database> et ses sous-sections.
- <https://laravel.com/docs/12.x/eloquent> et ses sous-sections.

De façon plus concise, à l'issue de cette séance, les personnes qui étudient
devraient être capables de :

- Décrire comment Laravel peut interagir avec plusieurs types de bases de
  données.
- Décrire le concept de migrations avec Laravel.
- Décrire le concept d'un ORM tel qu'Eloquent.
- Décrire le concept de "query builder" de Laravel.
- Décrire le concept de "seeders" dans Laravel.
- Décrire la partie "modèle" du patron de conception MVC.
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
étudié en ProgServ2 ; Laravel gère cela de manière plus moderne à l'aide des
fichiers de variables d'environnement.

## Migrations

Les migrations sont des fichiers qui décrivent la structure de la base de
données ainsi que son évolution au fil du temps.

Les migrations offrent plusieurs avantages. Elles permettent de :

- Versionner la structure de la base de données.
- Collaborer facilement sur les modifications de la base de données.
- Déployer la même structure sur plusieurs environnements.
- Séparer la logique de gestion des données de la logique de structure de la
  base de données.

Il est ainsi plus facile de maintenir et d'évoluer la base de données de façon
indépendante du code applicatif.

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

Ces classes permettent de définir les tables et leurs colonnes.

Par exemple, dans la méthode `up()`, nous créons une table `users` avec les
colonnes suivantes :

- `id` : clé primaire auto-incrémentée.
- `name` : chaîne de caractères pour le nom de l'utilisateur.
- `email` : chaîne de caractères unique pour l'adresse e-mail.
- `email_verified_at` : timestamp _"nullable"_ (= qui peut être nul/optionnel)
  pour la vérification de l'e-mail.
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
du fichier inclut un horodatage (= une date/un timestamp) pour garantir l'ordre
d'exécution des migrations. En effet, les migrations sont exécutées dans l'ordre
de leur horodatage, ce qui permet de gérer les dépendances entre les différentes
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

### Modifier une migration

Imaginons que nous souhaitons modifier cette migration pour ajouter une colonne
`this_is_demo` à la table `demo` existante. Nous pourrions modifier la méthode
`up()` comme suit :

```php
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demo', function (Blueprint $table) {
            $table->id();
            $table->string('this_is_demo', 100)->nullable();
            $table->timestamps();
        });
    }
```

Cette migration ajoute une colonne `this_is_demo` de type chaîne de caractères à
la table `demo`. Cette colonne est définie comme _"nullable"_ (optionnelle) et a
une longueur maximale de 100 caractères.

> [!WARNING]
>
> Ne modifiez jamais une migration qui a déjà été appliquée en production. Si
> vous avez besoin de modifier la structure de la base de données qui a été
> appliquée en production, créez une nouvelle migration.
>
> Sans quoi, des inconsistances pourraient apparaître entre les environnements
> de développement et de production qui sont difficiles à résoudre.

### Appliquer les migrations

Une fois les migrations créées ou modifiées, vous pouvez les appliquer à la base
de données en utilisant la commande suivante :

```bash
php artisan migrate
```

Cette commande exécute tous les fichiers de migration qui n'ont pas encore été
exécutés. Les migrations sont appliquées dans l'ordre de leur horodatage, ce qui
garantit que les modifications sont appliquées de manière cohérente.

> [!WARNING]
>
> Ne modifiez jamais une migration qui a déjà été appliquée en production. Si
> vous avez besoin de modifier la structure de la base de données qui a été
> appliquée en production, créez une nouvelle migration.
>
> Sans quoi, des inconsistances pourraient apparaître entre les environnements
> de développement et de production qui sont difficiles à résoudre.

### Annuler les migrations

Si vous souhaitez annuler la dernière migration appliquée car vous avez fait une
erreur ou souhaitez revenir en arrière, vous pouvez utiliser la commande
suivante :

```bash
php artisan migrate:rollback
```

Cette commande annule la dernière migration appliquée en exécutant la méthode
`down()` de la ou des migrations correspondantes.

> [!WARNING]
>
> Annuler une migration qui a été appliquée en production peut entraîner des
> pertes de données. Soyez très prudent.e lorsque vous utilisez cette commande,
> surtout en production.

## Le concept d'ORM

Un ORM (Object-Relational Mapping) est une technique qui permet de lier les
tables de la base de données à des classes et les enregistrements à des objets.

Au lieu d'écrire des requêtes SQL :

```sql
SELECT * FROM users WHERE id = 1;
```

Avec un ORM, on utilise des objets :

```php
$user = User::find(1);
```

Laravel inclut un ORM appelé Eloquent qui facilite la manipulation des données
de la base de données de manière orientée objet.

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

De manière générale, un ORM est recommandé pour la plupart des applications car
il permet de développer plus rapidement et de manière plus sécurisée. Cependant,
pour des cas très spécifiques où la performance est critique, il peut être
nécessaire d'écrire des requêtes SQL personnalisées.

## Eloquent : l'ORM de Laravel

Eloquent est l'ORM inclus dans Laravel. Un modèle Eloquent représente une table
de la base de données.

### Créer un modèle

Pour créer un modèle Eloquent, vous pouvez utiliser la commande Artisan suivante
:

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

Le modèle Eloquent encapsule la logique d'accès aux données et peut contenir des
méthodes métier :

```php
class User extends Model
{
    // Méthode métier
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
```

### Utiliser un modèle

Lorsqu'un modèle Eloquent est créé, il peut être utilisé pour interagir avec la
table correspondante dans la base de données.

Pour créer un nouvel enregistrement dans la table `users` :

```php
$user = new User();

$user->name = 'Alice';
$user->email = 'alice@example.com';

$user->save();
```

### Opérations CRUD avec Eloquent

Eloquent facilite les opérations CRUD sur les modèles :

- **Create** : créer un nouvel enregistrement.
- **Read** : lire des enregistrements existants.
- **Update** : mettre à jour des enregistrements existants.
- **Delete** : supprimer des enregistrements existants.

#### Créer

```php
$user = new User();

$user->name = 'Alice';
$user->email = 'alice@example.com';

$user->save();
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
```

#### Supprimer

```php
$user = User::find(1);

$user->delete();

// Ou directement
User::destroy(1);
```

### Gérer les relations entre modèles

Eloquent permet de définir des relations entre les modèles, telles que :

- **One-to-One** : un.e utilisateur.trice a un profil.
- **One-to-Many** : un.e utilisateur.trice a plusieurs posts.
- **Many-to-Many** : un.e utilisateur.trice peut avoir plusieurs rôles et un
  rôle peut être attribué à plusieurs utilisateur.trice.s.

Il existe quelques autres types de relations, mais nous ne les aborderons pas
dans ce cours.

Lors de l'utilisation d'Eloquent, vous pouvez définir ces relations dans les
modèles pour faciliter l'accès aux données liées. Ceci implique de créer des
méthodes dans les modèles qui utilisent les fonctions d'Eloquent pour définir la
nature de la relation.

Par exemple, pour une relation One-to-Many entre `User` et `Post`, vous pourriez
définir les méthodes suivantes :

```php
// app/Models/User.php
class User extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

// app/Models/Post.php
class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

Ceci permet de récupérer facilement les posts d'un utilisateur ou l'utilisateur
d'un post :

```php
// Récupérer un.e utilisateur.trice avec l'ID 1
$user = User::find(1);

// Récupérer les posts de l'utilisateur.trice
$posts = $user->posts;

// Récupérer un post avec l'ID 1
$post = Post::find(1);

// Récupérer l'utilisateur du post
$user = $post->user;
```

## Requêtes et query builder

Eloquent utilise un "query builder" pour construire les requêtes SQL de manière
fluide (= chaîner plusieurs méthodes les unes après les autres) et orientée
objet.

Un query builder permet d’interagir avec la base de données sans écrire de SQL
brut et sans passer par les modèles Eloquent. Il est souvent utilisé pour des
requêtes plus complexes ou lorsque vous souhaitez une meilleure performance.

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

La documentation officielle est **très** exhaustive et contient de nombreux
exemples : <https://laravel.com/docs/12.x/queries>.

## Seeders

Les seeders sont des classes qui permettent de remplir la base de données avec
des données prédéfinies.

Ces données factices peuvent être utilisées pour tester les fonctionnalités de
l'application sans avoir à entrer manuellement des données réelles.

Les seeders permettent également d'insérer des données de référence dans la base
de données, comme des rôles d'utilisateur, des catégories prédéfinies ainsi que
les utilisateur.trices qui pourront administrer l'application.

Pour créer un seeder, vous pouvez utiliser la commande Artisan suivante :

```bash
php artisan make:seeder UserSeeder
```

Cela crée un fichier `database/seeders/UserSeeder.php` :

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}
```

Vous pouvez ensuite remplir la méthode `run()` avec des instructions pour
insérer des données dans la base de données. Par exemple :

```php
public function run(): void
{
    DB::table('users')->insert([
        'name' => 'Alice',
        'email' => 'alice@example.com',
    ]);
}
```

Dans cet exemple, nous utilisons la façade `DB` pour insérer un nouvel
enregistrement dans la table `users`. Vous pouvez également utiliser les modèles
Eloquent pour insérer des données de manière orientée objet.

Pour exécuter les seeders, vous pouvez utiliser la commande suivante :

```bash
php artisan db:seed
```

Ou encore cette commande pour réinitialiser la base de données et exécuter les
seeders :

```bash
php artisan migrate:fresh --seed
```

## Le modèle dans le patron de conception MVC

Un patron de conception (_"design pattern"_ en anglais) est une solution
réutilisable à un problème de conception courant. Le patron MVC est largement
utilisé dans le développement d'applications web pour séparer les préoccupations
et faciliter la maintenance du code.

Le modèle est la première partie du patron Model-View-Controller (MVC) :

- **Modèle** : représente les données et la logique métier.
- **Vue** : affiche les données à l'utilisateur.
- **Contrôleur** : gère les requêtes et coordonne le modèle et la vue.

Le modèle est responsable de la gestion des données, de la validation, des
règles métier et de l'interaction avec la base de données. C'est la partie
centrale du patron MVC, car elle encapsule la logique métier et les données de
l'application.

### Pourquoi commencer par le modèle ?

Il est souvent recommandé de commencer par le modèle lors du développement d'une
application, car cela permet de définir clairement les données et la logique
métier avant de se préoccuper de l'affichage (vue) ou de la gestion des requêtes
(contrôleur).

En définissant d'abord le modèle, vous pouvez vous assurer que la structure de
vos données est solide et que les règles métier sont correctement implémentées.
Cela facilite ensuite la création de vues et de contrôleurs qui interagissent
avec ce modèle de manière cohérente.

Dans toute application, les technologies peut être amenées à évoluer, mais les
données, elles, sont au cœur de l'application. En adoptant une approche centrée
sur le modèle, vous pouvez construire une base solide pour votre application qui
peut évoluer au fil du temps sans compromettre la structure des données ou la
logique métier.

La façon d'accéder aux données et de les manipuler peut changer, mais tant que
le modèle est bien conçu, les autres parties de l'application peuvent s'adapter
sans nécessiter de refonte majeure.

## Utiliser Artisan pour gérer les modèles

Laravel propose des commandes Artisan pour créer et gérer les modèles Eloquent
de manière rapide et efficace.

Pour utiliser Artisan pour créer un modèle et sa migration associée, vous pouvez
voir la documentation officielle de Laravel à ce sujet :
<https://laravel.com/docs/12.x/eloquent#generating-model-classes>.

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

## Questions d'évaluation

> [!NOTE]
>
> Les questions d'évaluation sont destinées à vous aider à vérifier votre
> compréhension des concepts abordés dans le cours. Elles ne sont pas destinées
> à être utilisées comme une liste de contrôle exhaustive des compétences à
> maîtriser.
>
> Il est recommandé de les utiliser comme un guide pour vous aider à identifier
> les domaines dans lesquels vous pourriez avoir besoin de renforcer vos
> connaissances ou de pratiquer davantage.

- Qu'est-ce qu'une migration dans Laravel et quels sont ses avantages ?
- Comment créer une nouvelle migration avec Artisan ?
- Comment appliquer et annuler les migrations ?
- Qu'est-ce qu'un ORM et quels sont ses avantages et inconvénients ?
- Comment créer un modèle Eloquent et interagir avec la base de données à l'aide
  de ce modèle ?
- Comment gérer les relations entre les modèles Eloquent ?
- Qu'est-ce que le query builder de Laravel et quand l'utiliser ?
- Qu'est-ce qu'un seeder et comment l'utiliser pour remplir la base de données
  avec des données factices ?
- Quel est le rôle du modèle dans le patron de conception MVC et pourquoi est-il
  recommandé de commencer par le modèle lors du développement d'une application
  ?

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
