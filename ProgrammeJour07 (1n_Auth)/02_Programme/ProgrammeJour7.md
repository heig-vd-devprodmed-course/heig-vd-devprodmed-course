# Jour 7 (Relation 1:N)

Aujourd'hui, nous allons créer deux tables dans une base de données et les
mettre en relation.

Il existe plusieurs type de relations, la plus répandue et la plus simple
consiste à faire correspondre un enregistrement d'une table à plusieurs
enregistrements d'une autre table.

Ce type de relation est appelé : relation `1:N`

Voici quelques exemples :

- Une personne peut avoir plusieurs voitures, mais une voiture n'appartient qu'a
  un seul propriétaire.
- Une personne peut avoir plusieurs numéros de téléphones, un numéro correspond
  à une personne.
- Une personne peut rédiger plusieurs articles, un article a été rédigé par une
  personne.

## Blog

L'exemple que nous allons implémenter aujourd'hui est un blog dont voici les
caractéristiques :

- Les utilisateurs de notre application pourront se connecter, rédiger des
  articles puis se déconnecter.
- Les visiteurs de notre site pourrons consulter tous les articles.
- Les administrateurs auront le droit de supprimer des articles.

Commençons par la création d'un nouveau projet `Laravel`.

```
laravel new app_un_n/laravel
```

Pour développer rapidement, nous allons utiliser le SGBD `Sqlite` qui ne
nécessite pas de serveur. (cf. dernier cours)

Le fichier `.env`devrait donc être configuré pour l'utilisation de `Sqlite`

```
DB_CONNECTION=sqlite
```

Les migrations de bases ont déjà été faites et le fichier `database.sqlite`
contient déjà les tables de bases.

> Remarque : Si une erreur s'est produite, c'est peut-être que vous avez oublié
> d'activer l'extension correspondante à `Sqlite` dans le fichier php.ini. Pour
> savoir quel fichier php.ini modifier, il faut taper la commande :
>
> ```
> php --ini
> ```
>
> qui retourne par exemple :
>
> ```
> Configuration File (php.ini) Path: C:\WINDOWS
> Loaded Configuration File:         C:\php\php-8.2.3\php.ini
> Scan for additional .ini files in: (none)
> Additional .ini files parsed:      (none)
> ```
>
> Il suffit d'éditer le fichier `php.ini` et d'activer l'extension (en enlevant
> le point virgule ;-)
>
> ```
> ...
> extension=pdo_sqlite
> ...
> ```

Malheureusement, la table `users` présente de base dans `Laravel` ne correspond
pas tout à fait à nos besoins..., nous allons la modifier.

Déplaçons nous dans le répertoire `database\migrations` et éditons le fichier
`0001_01_01_000000_create_users_table.php` et adaptons le contenu des méthodes
`up()` (avec le même contenu que lors du dernier cours) pour que le champ `id`
s'incrémente automatiquement et pour disposer d'un champ supplémentaire `admin`

> ```php
> <?php
>
> use Illuminate\Database\Migrations\Migration;
> use Illuminate\Database\Schema\Blueprint;
> use Illuminate\Support\Facades\Schema;
>
> return new class extends Migration
> {
>     /**
>      * Run the migrations.
>      */
>     public function up(): void
>     {
>         Schema::create('users', function (Blueprint $table) {
>             $table->increments('id');   // <---
>             $table->string('name');
>             $table->string('email')->unique();
>             $table->timestamp('email_verified_at')->nullable();
>             $table->string('password');
>             $table->boolean('admin')->default(false); // <---
>             $table->rememberToken();
>             $table->timestamps();
>         });
>
>         Schema::create('password_reset_tokens', function (Blueprint $table) {
>             $table->string('email')->primary();
>             $table->string('token');
>             $table->timestamp('created_at')->nullable();
>         });
>
>         Schema::create('sessions', function (Blueprint $table) {
>             $table->string('id')->primary();
>             $table->foreignId('user_id')->nullable()->index();
>             $table->string('ip_address', 45)->nullable();
>             $table->text('user_agent')->nullable();
>             $table->longText('payload');
>             $table->integer('last_activity')->index();
>         });
>     }
>
>     /**
>      * Reverse the migrations.
>      */
>     public function down(): void
>     {
>         Schema::dropIfExists('users');
>         Schema::dropIfExists('password_reset_tokens');
>         Schema::dropIfExists('sessions');
>     }
> };
> ```

Créons à présent un nouveau fichier de migration (code qui va permettre de
créer/supprimer une nouvelle table dans la bd) nommé `create_articles_table` à
l'aide de la commande :

```
 php artisan make:migration create_articles_table
```

Et ajoutons le code nécessaire pour les différents champs :

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('titre',80);
            $table->text('contenu');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
```

Nous devons maintenant supprimer toutes les tables dans notre base de donnée à
l'aide de la commande :

```
php artisan migrate:rollback
```

=> le message suivant :

```
 INFO  Rolling back migrations.
  0001_01_01_000002_create_jobs_table .................................. 18.31ms DONE
  0001_01_01_000001_create_cache_table .................................. 5.16ms DONE
  0001_01_01_000000_create_users_table .................................. 7.82ms DONE
```

Et les créer pour que les modifications que nous avons apporté prennent effet.

```
php artisan migrate
```

Ce qui devrait afficher :

```
 INFO  Running migrations.
  0001_01_01_000000_create_users_table ................................ 24.05ms DONE
  0001_01_01_000001_create_cache_table ................................. 5.32ms DONE
  0001_01_01_000002_create_jobs_table ................................. 17.19ms DONE
  2024_04_14_122846_create_articles_table .............................. 2.68ms DONE
```

Pour visualiser ces tables nous pouvons utiliser le programme
`DB Browser for Sqlite`

## Relation 1:N dans les classes-modèles

Nous l'avons vu lors du dernier cours : chaque table nécessite une classe
modèle. La classe User est existe déjà par défaut dans `Laravel`. Par contre il
faudra créer la classe modèle `Article` qui n'existe pas.

La relation 1:N se définit dans les deux classes "modèle" impliquées
(`User.php`, `Article.php`)

Dans la classe `User.php` nous devons indiquer qu'un utilisateur peut posséder
plusieurs articles.

Dans la classe `Articles.php` nous devons indiquer qu'un article appartient à un
utilisateur.

Reprenons les modifications que nous avions apporté lors du dernier cours à la
classe `\laravel\app\Models\User.php` et ajoutons la méthode `articles()`

```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // DEFINITON DE LA RELATION x:N
    public function articles() {                 // NOUVEAU !!!!!!!!
        return $this->hasMany(Article::class);   // Relation (1:)N
    }                                            // NOUVEAU !!!!!!!!
}
```

Créons la classe "modèle" Article et complétons la avec les instructions
suivantes :

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // sans rien indiquer de plus, Laravel rattache automatiquement
    // ce modèle à la table "articles"
    // Il cherche une table nommée comme la classe mais en rajoutant un 's'
    // => nom de la classe Article => recherche la table "articles" dans la bd

    protected $fillable=['titre','contenu','user_id'];  // pour plus tard ;-)

    public function user() {			        // NOUVEAU !!!!!!!!!!
        return $this->belongsTo(User::class);    // Relation 1(:N)
    }                                            // NOUVEAU !!!!!!!!!!
}
```

En résumé, pour `Eloquent` la relation 1:N se traduit par les deux méthodes :

```php
// au singulier dans la classe "modèle" Article.php
public function user() {						  // NOUVEAU !!!!!!!!!!
	return $this->belongsTo(User::class);           // Relation 1(:N)
}   											// NOUVEAU !!!!!!!!!!
```

```php
// au pluriel dans la classe "modèle" User.php
public function articles() {                  // NOUVEAU !!!!!!!!
	return $this->hasMany(Article::class);    // Relation (1:)N
}                                             // NOUVEAU !!!!!!!!
```

## Peuplement des tables `users` et `articles`

Pour faciliter nos tests nous allons créer des enregistrements (aléatoires) dans
nos tables.

Pour ajouter des enregistrements dans une table, il nous faut des instructions.
Les instructions se mettent dans une méthode. Une méthode doit se trouver dans
une classe. Il nous faut donc une nouvelle classe.

## Seeder

Dans `Laravel`, une classe qui permet le peuplement d'une table se nomme un
`seeder`.

Pour créer un `seeder` nous avons la commande
`php artisan make:seeder NomNouvelleClasse`

Comme nous voulons des enregistrements dans la table `user` et dans la table
`articles`, il nous faut deux classes `seeder` :

- `UsersTableSeeder`
- `ArticlesTableSeeder`

Lançons les commandes suivantes pour créer ces classes :

```
php artisan make:seeder UsersTableSeeder
```

```
php artisan make:seeder ArticlesTableSeeder
```

Ces deux classes sont maintenant disponibles dans le répertoire :
`\laravel\database\seeders`

Modifions la classe `UsersTableSeeder.php` pour créer 10 utilisateurs :

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Utilisation de la classe "Modèle" ;-)

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        for ($i = 1; $i <= 10; $i++) {
            User::create(['name' => 'Nom' . $i,
                             'email' => 'email' . $i . '@gmx.ch',
                             'password' => 'password' . $i,
                             'admin' => rand(0, 1)]);
        }
    }
}
```

Puis la classe `ArticlesTableSeeder.php` qui va créer 100 articles produits par
des utilisateurs (déterminé aléatoirement)

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Article; // Utilisation de la classe "Modèle" ;-)

class ArticlesTableSeeder extends Seeder
{
    private function randDate() {
        $nbJours = rand(-2800, 0);
        return Carbon::now()->addDays($nbJours);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        for ($i = 1; $i <= 100; $i++) {
            $date = $this->randDate();
            Article::create(['titre'=> 'Titre' .$i,
                             'contenu' => 'Contenu ' . $i . ' Lorem ipsum dolor sit amet, consectetur ' .
                                                     'adipiscing elit. Proin vel auctor libero, quis venenatis ' .
                                                     'augue. Curabitur a pulvinar tortor, vitae condimentum ' .
                                                     'libero. Cras eu massa sed lorem mattis lacinia. ' .
                                                     'Vestibulum id feugiat turpis. Proin a lorem ligula.',
                              'user_id' => rand(1, 10),
                              'created_at' => $date,
                              'updated_at' => $date,
                            ]);
        }
    }
}
```

## Ordre du peuplement des tables (`DatabaseSeeder`)

L'ordre du peuplement des tables est très important.

Comme les articles sont rattachés à des utilisateurs (`users`), il est important
de créer d'abord les utilisateurs puis les articles.

Cet ordre (`users` puis `articles`) se définit dans la méthode `run()` de la
classe existante : `\laravel\database\seeds\DatabaseSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
    }
}
```

## Création des enregistrements

Lançons le peuplement de nos deux tables :

```
php artisan db:seed
```

> Si la commande précédente génère une erreur, c'est que `Laravel` n'a pas "vu"
> nos nouvelles classes. (Il faut mettre à jour la classe qui permet
> l'`autoload`)
>
> Pour s'assurer que `Laravel` prenne en compte nos deux nouvelles classes
> (`UsersTableSeeder`, `ArticlesTableSeeder`) lançons la commande :
>
> ```
> composer dump-autoload
> ```

Lorsque tout s'est bien passé, le message suivant s'affiche :

```
INFO  Seeding database.
  Database\Seeders\UsersTableSeeder ................................................. RUNNING
  Database\Seeders\UsersTableSeeder ........................................... 2,107 ms DONE
  Database\Seeders\ArticlesTableSeeder .............................................. RUNNING
  Database\Seeders\ArticlesTableSeeder .......................................... 299 ms DONE
```

A l'aide de l'outil `DB Browser for Sqlite` nous pouvons constater que nos
tables sont bien remplies :slightly_smiling_face:

Voici les enregistrements de la table `users` :

![Users](img\Users.png)

Voici quelques enregistrements (16/100) de la table articles :

![Articles](img\Articles.png)

Nous pouvons bien sûr aussi utiliser l'outil `tinker` pour s'assurer de la
présence des enregistrements dans nos deux tables (`users` et `articles`)

```
php artisan tinker
```

```
>>> use App\Models\User;
>>> User::limit(10)->get();
```

Qui nous retourne :

```php
= Illuminate\Database\Eloquent\Collection {#6071
    all: [
      App\Models\User {#6073
        id: 1,
        name: "Nom1",
        email: "email1@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$4dw2LcnBF8G0.NQA2.AbTuBwizG8Bic6yaOWOKIyzTqcMGAhZ5rUO",
        admin: 1,
        #remember_token: null,
        created_at: "2024-04-14 13:58:24",
        updated_at: "2024-04-14 13:58:24",
      },
      App\Models\User {#6074
        id: 2,
        name: "Nom2",
        email: "email2@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$J5zhIQ4czDpLJqAkwNTAlO/hgqHGQC31YPGVCG1QwlWVGkjlUW2zC",
        admin: 1,
        #remember_token: null,
        created_at: "2024-04-14 13:58:24",
        updated_at: "2024-04-14 13:58:24",
      },
      App\Models\User {#6075
        id: 3,
        name: "Nom3",
        email: "email3@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$tLpdTZOBQWTwReCmOfz.qOLJYQ7XC6eYuv3nr4IdEiWXNrXnakPxS",
        admin: 1,
        #remember_token: null,
        created_at: "2024-04-14 13:58:24",
        updated_at: "2024-04-14 13:58:24",
      },
      App\Models\User {#6076
        id: 4,
        name: "Nom4",
        email: "email4@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$PmcJ7Y4PON3TM9dHOAFAg.5309mo8E87uSgufCy3gqSOSh5GsfYB6",
        admin: 1,
        #remember_token: null,
        created_at: "2024-04-14 13:58:25",
        updated_at: "2024-04-14 13:58:25",
      },
      App\Models\User {#6077
        id: 5,
        name: "Nom5",
        email: "email5@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$v/0ESpKRbfqb/5OnLn/pFeY/1PVMm.wVrD9UyXfiNQ00yZkNlTDQq",
        admin: 0,
        #remember_token: null,
        created_at: "2024-04-14 13:58:25",
        updated_at: "2024-04-14 13:58:25",
      },
      App\Models\User {#6078
        id: 6,
        name: "Nom6",
        email: "email6@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$/23.cjSF3ObTnkbqg.7SH.XvigncXBf2TjHnkgopfSfQnXb3uEEc.",
        admin: 1,
        #remember_token: null,
        created_at: "2024-04-14 13:58:25",
        updated_at: "2024-04-14 13:58:25",
      },
      App\Models\User {#6079
        id: 7,
        name: "Nom7",
        email: "email7@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$6ZjmTm6mIZ68kjkRfGbdW.gPjYzfirs4bK19GwAFMPvxSPqdzVOeK",
        admin: 1,
        #remember_token: null,
        created_at: "2024-04-14 13:58:25",
        updated_at: "2024-04-14 13:58:25",
      },
      App\Models\User {#6080
        id: 8,
        name: "Nom8",
        email: "email8@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$6x6YtkmEB4b8tky9Fq7M4ecsvb/ufHGBuVR2NGyxTaRnWy2PUFbHq",
        admin: 1,
        #remember_token: null,
        created_at: "2024-04-14 13:58:25",
        updated_at: "2024-04-14 13:58:25",
      },
      App\Models\User {#6081
        id: 9,
        name: "Nom9",
        email: "email9@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$HqyBB9FjH47lxMdbujkXe.naL4vxKzrEGyAOITYaaZOu00k1t4g8m",
        admin: 0,
        #remember_token: null,
        created_at: "2024-04-14 13:58:26",
        updated_at: "2024-04-14 13:58:26",
      },
      App\Models\User {#6082
        id: 10,
        name: "Nom10",
        email: "email10@gmx.ch",
        email_verified_at: null,
        #password: "$2y$12$E4JgOYiou1NEThCzieTDJ.Do2gB28/Fyo0gxtto0pKQFsP4ULIghG",
        admin: 0,
        #remember_token: null,
        created_at: "2024-04-14 13:58:26",
        updated_at: "2024-04-14 13:58:26",
      },
    ],
  }
```

Demandons maintenant (à `tinker`) de nous afficher les articles appartenant à
l'utilisateur ayant l'identifiant : 1

```
>>> App\Models\User::findOrFail(1)->articles
```

`Tinker` nous affiche alors :

```php
= Illuminate\Database\Eloquent\Collection {#6134
    all: [
      App\Models\Article {#6132
        id: 3,
        created_at: "2018-09-04 13:58:26",
        updated_at: "2018-09-04 13:58:26",
        titre: "Titre3",
        contenu: "Contenu 3 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel auctor libero, quis venenatis augue. Curabitur a pulvinar tortor, vitae condimentum libero. Cras eu massa sed lorem mattis lacinia. Vestibulum id feugiat turpis. Proin a lorem ligula.",
        user_id: 1,
      },
      App\Models\Article {#6131
        id: 48,
        created_at: "2018-12-31 13:58:26",
        updated_at: "2018-12-31 13:58:26",
        titre: "Titre48",
        contenu: "Contenu 48 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel auctor libero, quis venenatis augue. Curabitur a pulvinar tortor, vitae condimentum libero. Cras eu massa sed lorem mattis lacinia. Vestibulum id feugiat turpis. Proin a lorem ligula.",
        user_id: 1,
      },
      App\Models\Article {#6130
        id: 60,
        created_at: "2023-06-07 13:58:26",
        updated_at: "2023-06-07 13:58:26",
        titre: "Titre60",
        contenu: "Contenu 60 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel auctor libero, quis venenatis augue. Curabitur a pulvinar tortor, vitae condimentum libero. Cras eu massa sed lorem mattis lacinia. Vestibulum id feugiat turpis. Proin a lorem ligula.",
        user_id: 1,
      },
      App\Models\Article {#6129
        id: 63,
        created_at: "2017-09-25 13:58:26",
        updated_at: "2017-09-25 13:58:26",
        titre: "Titre63",
        contenu: "Contenu 63 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel auctor libero, quis venenatis augue. Curabitur a pulvinar tortor, vitae condimentum libero. Cras eu massa sed lorem mattis lacinia. Vestibulum id feugiat turpis. Proin a lorem ligula.",
        user_id: 1,
      },
      App\Models\Article {#6126
        id: 100,
        created_at: "2022-08-12 13:58:26",
        updated_at: "2022-08-12 13:58:26",
        titre: "Titre100",
        contenu: "Contenu 100 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel auctor libero, quis venenatis augue. Curabitur a pulvinar tortor, vitae condimentum libero. Cras eu massa sed lorem mattis lacinia. Vestibulum id feugiat turpis. Proin a lorem ligula.",
        user_id: 1,
      },
    ],
  }
```

Le résultat diffère un peu chez vous car le peuplement des tables s'est fait de
manière aléatoire. (Voir le code des `Seeders` ci-dessus) Il y a peut-être plus
ou peut être moins d'articles. (N articles)

Nous pouvons maintenant demander à tinker à qui appartient l'article ayant
l'identifiant : 10

```
App\Models\Article::findOrFail(10)->user
```

Tinker nous répond :

```php
= App\Models\User {#6087
    id: 2,
    name: "Nom2",
    email: "email2@gmx.ch",
    email_verified_at: null,
    #password: "$2y$12$J5zhIQ4czDpLJqAkwNTAlO/hgqHGQC31YPGVCG1QwlWVGkjlUW2zC",
    admin: 1,
    #remember_token: null,
    created_at: "2024-04-14 13:58:24",
    updated_at: "2024-04-14 13:58:24",
  }
```

L'identifiant de l'utilisateur est surement différent chez vous ! Par contre ce
qui est sûr, c'est qu'il y a qu'un seul utilisateur (1 utilisateur)

Relation 1:N => 1 utilisateur : N articles :slightly_smiling_face:

Tout est en place au niveau des données. Nous pouvons maintenant implémenter
notre application.

## Contrôleur

Créons notre contrôleur. (Ce sera comme lors du dernier cours un contrôleur de
type ressource)

```
php artisan make:controller ArticleController --resource
```

Par défaut, ce contrôleur possède les méthodes suivantes :

- index()
- create()
- store(Request $request)
- show($id)
- edit($id)
- update(Request $request, $id)
- destroy()

Mais cela ne veut pas dire que nous devons toutes les avoir.

Nous pouvons supprimer celles que nous n'utiliserons pas. (`show`, `edit`,
`update`)

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
```

## Route

```php
Route::resource('articles', ArticleController::class, ['except'=>['show','edit','update']]);
```

> N'oublions pas le `use` pour la classe `ArticleController`

Comme nous n'utiliserons pas les trois méthodes (`show`, `edit`, `update`) nous
avons supprimé les routes qui y mènent (`['except'=>['show','edit','update']]`)

> Rappel : Pour voir toutes les routes et leur méthodes associées dans le
> contrôleur il y a la commande que nous avons vu lors du dernier cours :
>
> ```
> php artisan route:list
> ```

## Template

Voici le template Blade `\resources\view\template.blade.php`

```php+HTML
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>
            Mon blog
        </title>
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <style> textarea {resize:none} </style>
    </head>
    <body>
        <header class="jumbotron">
            <div class="container">
                <h1 class="page-header"><a href="{{route('articles.index')}}">Mon blog</a></h1>
                @yield('header')
            </div>
        </header>
        <div class="container">
            @yield('contenu')
        </div>
    </body>
</html>
```

## Vue (Liste des articles)

Voici la vue Blade `\resources\view\view_articles.blade.php`

```php+HTML
@extends('template')

@section('header')
@endsection

@section('contenu')
{!!$links!!}
@foreach($articles as $article)
<article class="row bg-primary">
    <div class="col-md-12">
        <header>
            <h1>{{$article->titre}}</h1>
        </header>
        <hr>
        <section>
            <p>{{$article->contenu}}</p>
            <em class="pull-right">
                <span class="gliphicon glyphicon-pencil"></span>
                {{$article->user->name}} le {!! $article->created_at->format('d-m-Y') !!}
            </em>
        </section>
    </div>
</article>
<br>
@endforeach
{!! $links !!}
@endsection
```

## Mise à jour du contrôleur

Nous pouvons ajouter les instructions permettant d'obtenir la liste des articles

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    protected $nbArticlesParPage = 4;

    public function index() {
        $articles=Article::with('user')
                ->orderBy('articles.created_at','desc')
                ->paginate($this->nbArticlesParPage);
        $links=$articles->render();
        return view('view_articles', compact('articles','links'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function destroy($id) {}
}
```

Nous pouvons tester l'état actuel de notre application en lançant notre
application :

```
http://localhost:8000/articles
```

Pour obtenir une navigation plus aisée entre les différentes pages, nous pouvons
configurer `Laravel` pour l'utilisation de `bootstrap` pour le rendu.
[Documentation](https://laravel.com/docs/11.x/pagination#using-bootstrap)

`app\Providers\AppServiceProvider.php`

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
    }
}
```

Voici ce que l'on obtient :

![](img\ListeArticles.png)

Pour qu'un utilisateur puisse créer des articles, il doit se connecter.

Nous allons nous occuper maintenant de l'authentification.

## Authentification

Pour implémenter une authentification dans Laravel, il nous faut l'outil `npm`.
(Pour plus d'info : [npm](https://www.npmjs.com/get-npm))

Pour savoir si `npm` est installé sur votre ordinateur, il suffit de taper la
commande suivante :

```
npm
```

Si rien ne se passe, il faut l'installer.

`npm` fait partie de Node.js. En installant Node.js, `npm` sera installé
automatiquement.

```
https://nodejs.org/fr/download/
```

Vous pouvez validez toutes les options proposées par défaut.

Une fois l'installation terminée, il faut fermer la fenêtre de la ligne de
commande, puis l'ouvrir à nouveau.

En tapant la commande :

```
npm
```

Celle-ci retournera :

```
npm <command>

Usage:

npm install        install all the dependencies in your project
npm install <foo>  add the <foo> dependency to your project
npm test           run this project's tests
npm run <foo>      run the script named <foo>
npm <command> -h   quick help on <command>
npm -l             display usage info for all commands
npm help <term>    search for help on <term> (in a browser)
npm help npm       more involved overview (in a browser)

All commands:

    access, adduser, audit, bugs, cache, ci, completion,
    config, dedupe, deprecate, diff, dist-tag, docs, doctor,
    edit, exec, explain, explore, find-dupes, fund, get, help,
    help-search, hook, init, install, install-ci-test,
    install-test, link, ll, login, logout, ls, org, outdated,
    owner, pack, ping, pkg, prefix, profile, prune, publish,
    query, rebuild, repo, restart, root, run-script, sbom,
    search, set, shrinkwrap, star, stars, start, stop, team,
    test, token, uninstall, unpublish, unstar, update, version,
    view, whoami

Specify configs in the ini-formatted file:
    C:\Users\jeanpier.hess\.npmrc
or on the command line via: npm <command> --key=value

More configuration info: npm help config
Configuration fields: npm help 7 config
```

Ce qui nous indique que `npm` est installé.

Nous pouvons donc passer à l'implémentation de l'authentification.

Demandons maintenant à `Laravel` d'installer la libraire `Breeze` pour faciliter
l'authentification.

```
composer require laravel/breeze --dev
```

Une fois que la libraire a été téléchargée, nous pouvons installer les vues
d'authentification `blade` à l'aide de la commande :

```
php artisan breeze:install blade
```

Patientez ! jusqu'au message :

```
 INFO  Breeze scaffolding installed successfully.
```

Voilà, c'est installé.

> Remarque importante ! : L'installation a modifié le fichier `web.php` en y
> ajouter des routes et a SUPPRIME NOS routes... et les `use` !
>
> Il est donc important de les rajouter !
>
> ```
> ...
> Route::resource('articles', ArticleController::class, ['except'=>['show','edit','update']]);
> ...
> ```

Dans le répertoire `/resources/views` nous pouvons voir (entre autre) un nouveau
répertoire `/auth` contenant des vues supplémentaires.

Pour voir que l'authentification est fonctionnelle, il suffit de lancer notre
application.

![Authentification](img\Authentification.png)

Nous pouvons observer en haut à droite de la fenêtre, deux nouveaux liens
`Log in` et `Register`

Cliquons sur `Log In` et identifions nous avec les informations suivantes :

- `E-Mail Address` : `email1@gmx.ch`
- `Password` : `password1`

Nous obtenons le résultat suivant :

![Logged](img\Logged.png)

Pour rediriger l'utilisateur après son identification ou son inscription nous
pouvons modifier deux contrôleurs qui ont été ajouté lors de la mise en place de
l'authentification.

Il s'agit d'abord du contrôleur
`app/Http/Controllers/Auth/RegisteredUserController.php` Il suffit de changer la
ligne 48 :

```
return redirect(route('dashboard', absolute: false));
```

en

```
return redirect('/articles');
```

et celle du contrôleur
`app/Http/Controllers/Auth/AuthenticatedSessionController.php` Changer la ligne
31 :

```
return redirect()->intended(route('dashboard', absolute: false));
```

en

```
return redirect()->intended('/articles');
```

Et pour rediriger l'utilisateur après son `logout` Changer la ligne 46 du
fichier `app/Http/Controllers/Auth/AuthenticatedSessionController.php` :

```
return redirect('/');
```

en

```
return redirect('/articles');
```

[Voir documentation](https://laraveldaily.com/post/change-redirect-login-register-laravel-breeze)

## Middleware

Nous allons maintenant configurer un `middleware` pour la gestion des droits.

Un `middleware` effectue un traitement à l'arrivée d'une requête ou à son
départ. Par exemple, la gestion des sessions ou des cookies se fait dans un
middleware. Nous pouvons avoir autant de `middleware` que l'on veut. Les
`middleware` se chaînent les uns à la suite des autres. Chacun effectue son
traitement et transmet la requête ou la réponse au suivant. Un `middleware`
n'est rien d'autre qu'une classe.
[Voir documentation](https://laravel.com/docs/11.x/middleware)

Créons notre `middleware` `Admin.php` à l'aide de la commande :

```
php artisan make:middleware Admin
```

Nous pouvons éditer notre classe `Admin.php` qui se trouve dans le répertoire :
`app\Http\Middleware\`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
```

Modifions la méthode `handle(...)` pour indiquer à Laravel que si l'utilisateur
n'est pas un administrateur, on le redirige sur l'affichage des articles du
blog.

```php
	public function handle(Request $request, Closure $next): Response
    {
		if ($request->user()->admin) {
			return $next($request);
		}
		return new RedirectResponse(url('articles'));
	}
```

Une fois le `middleware` créé, il faut l'enregistrer dans `Laravel`.

Cela se fait dans le fichier `/bootstrap/app.php`
[Voir documentation](https://laravel.com/docs/11.x/middleware#registering-middleware)

L'enregistrement d'un `middleware` se fait à l'aide de la méthode
`->withMiddleware(...)`

Voici la valeur par défaut (ligne 13) :

```php
->withMiddleware(function (Middleware $middleware) {
        //
})
```

et voici sa nouvelle valeur (on y ajoute un alias afin de simplifier son appel)
:

```php
->withMiddleware(function (Middleware $middleware) {
      $middleware->alias([
        'admin' => \App\Http\Middleware\Admin::class,
    ]);
})
```

Nous pouvons maintenant utiliser notre `middleware`

Adaptons maintenant notre application.

Modifions notre contrôleur :

- activation des deux middleware (1 existant `auth` + celui que l'on vient de
  créer `admin`) dans une méthode de classe
- redirection vers le formulaire pour la création d'un nouvel article
- enregistrement des données d'un nouvel article
- suppression d'un article d'après si identifiant

```php
<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Routing\Controllers\HasMiddleware; // ne pas oublier
use Illuminate\Routing\Controllers\Middleware; // ne pas oublier

class ArticleController extends Controller implements HasMiddleware // ne pas oublier
{
    protected $nbArticlesParPage = 4;

    // NE PAS OUBLIER D'INDIQUER QUE LA CLASSE IMPLEMENTS HasMiddleware
    // Et le use correspondant !!!
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index']),
            new Middleware('admin', only: ['destroy']),
        ];
    }

    public function index() {
        $articles=Article::with('user')
                ->orderBy('articles.created_at','desc')
                ->paginate($this->nbArticlesParPage);
        $links=$articles->render();
        return view('view_articles', compact('articles','links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('view_ajoute_article');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request) {
       $inputs=array_merge($request->all(), ['user_id'=>$request->user()->id]);
       Article::create($inputs);
       return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        Article::findOrFail($id)->delete();
        return redirect()->back();
    }
}
```

Modifions notre vue permettant d'afficher la liste des articles
`\resources\view\view_articles.blade.php`

```php+HTML
@extends('template')

@section('header')
@if(Auth::check())
<div class="btn-group pull-right">
    <a href='{{route("articles.create")}}' class='btn btn-info'>Cr&eacute;er un article</a>
    <a href='{{url("logout")}}' class='btn btn-warning'>Deconnexion</a>
</div>
@else
<a href='{{url("login")}}' class='btn btn-info pull-right'>Se connecter</a>
@endif
@endsection

@section('contenu')
@if(isset($info))
<div class='row alert alert-info'> {{$info}}</div>
@endif
{!!$links!!}
@foreach($articles as $article)
<article class="row bg-primary">
    <div class="col-md-12">
        <header>
            <h1>{{$article->titre}}</h1>
        </header>
        <hr>
        <section>
            <p>{{$article->contenu}}</p>
            @if(Auth::check() and Auth::user()->admin)
            <form method="POST" action="{{route('articles.destroy', [$article->id])}}" accept-charset="UTF-8">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger btn-xs" onclick="return confirm('Vraiment supprimer cet article ?')" type="submit" value="Supprimer cet article">
            </form>
            @endif
            <em class="pull-right">
                <span class="gliphicon glyphicon-pencil"></span>
                {{$article->user->name}} le {!! $article->created_at->format('d-m-Y') !!}
            </em>
        </section>
    </div>
</article>
<br>
@endforeach
{!! $links !!}
@endsection
```

Comme nous avons ajouté une possibilité de se déconnecter ( `logout` en méthode
`get` (`a href..`) , il nous faut une dernière route :

```
...
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
```

Ajout d'une nouvelle vue pour le formulaire de création d'un nouvel article
(`\resources\views\view_ajoute_article.blade.php`) :

```php+HTML
@extends('template')

@section('contenu')
<BR>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading">Ajout d'un article</div>
        <div class="panel-body">
            <form method="POST" action="{{route('articles.store')}}" accept-charset="UTF-8">
            @csrf
            <div class="form-group {!! $errors->has('titre') ? 'has-error' : '' !!}">
                <input class="form-control" placeholder="Titre" name="titre" type="text">
                {!! $errors->first('titre', '<small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('contenu') ? 'has-error' : '' !!}">
                <textarea class="form-control" placeholder="Contenu" name="contenu" cols="50" rows="10"></textarea>
                {!! $errors->first('contenu', '<small class="help-block">:message</small>') !!}
            </div>
            <input class="btn btn-info pull-right" type="submit" value="Envoyer">
            </form>
        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span>Retour</a>
</div>
@endsection
```

Classe de validation des champs du formulaire de création d'un nouvel article :

```
php artisan make:request ArticleRequest
```

Mise à jour du fichier de validation (`app\Http\Requests\ArticleRequest`) :

```php+HTML
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'titre'=>'required|max:80',
            'contenu'=>'required'
        ];
    }
}
```

Voilà notre application est fonctionnelle :slightly_smiling_face:

> Remarques :
>
> Pour voir les différentes possibilités à œuvre, il est nécessaire de se
> connecter avec différents rôles :
>
> - admin
> - utilisateur normal
>
> Comme les rôles ont été attribués aléatoirement lors du `seed`, il faut aller
> voir dans la table `users` à l'aide de `tinker` ou de `DB Browser for SQLite`

Voici un résumé de ce que nous avons appris aujourd'hui :

- Nous savons comment ajouter rapidement des enregistrement dans une base de
  donnée grâce aux `Seeders`.
- Nous savons implémenter une relation 1:N dans `Laravel` à l'aide des méthodes
  :
  - `->belongsTo(...)`
  - `->hasMany(...)`
- Nous savons mettre en place une authentification.
- Nous avons mis en place un `middleware` pour pouvoir accéder à différentes
  fonctionnalités (si on est admin ou pas)
- Nous savons comment rediriger l'utilisateur après son identification,
  enregistrement ou `logout`
