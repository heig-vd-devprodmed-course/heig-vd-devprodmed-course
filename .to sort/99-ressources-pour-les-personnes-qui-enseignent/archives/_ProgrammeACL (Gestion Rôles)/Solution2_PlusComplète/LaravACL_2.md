# ACL (Access Control List)

Pour gérer les droits d'accès aux fonctionnalités, il nous faut tout d'abord un
certain nombre de fonctionnalités

## Création de fonctionnalités

Ajoutons quelques fonctionnalités à notre application grâce à un contrôleur de
type `resource` qui contient automatiquement sept fonctionnalités.

```
php artisan make:controller UnControleur --resource
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnControleur extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return 'Fonctionnalité index';
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return 'Fonctionnalité create';
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		return 'Fonctionnalité store';
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		return 'Fonctionnalité show';
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		return 'Fonctionnalité edit';
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		return 'Fonctionnalité update';
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		return 'Fonctionnalité destroy';
	}
}
```

Ajoutons maintenant les routes pour nos fonctionnalités (en fait, il n'en faut
qu'une pour ce type de contrôleur )

```php
Route::resource('tests', UnControleur::class);
```

> Sans oublier le `use` ...

Pour voir nos différentes routes :

```
php artisan route:list
```

```
GET|HEAD     / ............................................................................
POST         _ignition/execute-solution ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionContr…
GET|HEAD     _ignition/health-check ....... ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
POST         _ignition/update-config .... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
GET|HEAD     api/user ...........................................................................................
GET|HEAD     confirm-password ........................ password.confirm › Auth\ConfirmablePasswordController@show
POST         confirm-password .......................................... Auth\ConfirmablePasswordController@store
GET|HEAD     dashboard ................................................................................ dashboard
POST         email/verification-notification verification.send › Auth\EmailVerificationNotificationController@st…
GET|HEAD     forgot-password ......................... password.request › Auth\PasswordResetLinkController@create
POST         forgot-password ............................ password.email › Auth\PasswordResetLinkController@store
GET|HEAD     login ........................................... login › Auth\AuthenticatedSessionController@create
POST         login .................................................... Auth\AuthenticatedSessionController@store
POST         logout ........................................ logout › Auth\AuthenticatedSessionController@destroy
PUT          password .......................................... password.update › Auth\PasswordController@update
GET|HEAD     profile ...................................................... profile.edit › ProfileController@edit
PATCH        profile .................................................. profile.update › ProfileController@update
DELETE       profile ................................................ profile.destroy › ProfileController@destroy
GET|HEAD     register ........................................... register › Auth\RegisteredUserController@create
POST         register ....................................................... Auth\RegisteredUserController@store
POST         reset-password ................................... password.store › Auth\NewPasswordController@store
GET|HEAD     reset-password/{token} .......................... password.reset › Auth\NewPasswordController@create
GET|HEAD     sanctum/csrf-cookie .............. sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show
GET|HEAD     tests ............................................................. tests.index › UnControleur@index
POST         tests ............................................................. tests.store › UnControleur@store
GET|HEAD     tests/create .................................................... tests.create › UnControleur@create
GET|HEAD     tests/{test} ........................................................ tests.show › UnControleur@show
PUT|PATCH    tests/{test} .................................................... tests.update › UnControleur@update
DELETE       tests/{test} .................................................. tests.destroy › UnControleur@destroy
GET|HEAD     tests/{test}/edit ................................................... tests.edit › UnControleur@edit
GET|HEAD     verify-email .......................... verification.notice › Auth\EmailVerificationPromptController
GET|HEAD     verify-email/{id}/{hash} .......................... verification.verify › Auth\VerifyEmailController
```

Nous pouvons sans autre tester certaines de nos routes (les routes GET), à
savoir :

- `/tests` qui nous envoie vers la méthode `index()` de notre contrôleur

  > ```
  > localhost:8000/tests
  > ```

- `/tests/create` qui nous envoie vers la méthode `create()` de notre contrôleur

  > ```
  > localhost:8000/tests/create
  > ```

- `/tests/xxx` qui nous envoie vers la méthode `show()`

  > ```
  > localhost:8000/tests/xxx
  > ```

- `/tests/xxx/edit` qui nous envoie vers la méthode edit()

  > ```
  > localhost:8000/tests/xxx/edit
  > ```

## Création des différents rôles

Nous allons définir trois rôles pour notre application :

- un rôle `BASIC` pour les fonctionnalités (index(), show() ))
- un rôle `EDITEUR` permettant en plus la création, l'édition et la sauvegarde
  (create(), edit(), store())
- un rôle `ADMIN` pour toutes les autres fonctionnalités (update(), destroy())

Nous allons stocker ces rôles dans la classe-modèle `User` dans des constantes

```php
const ROLE_BASIC = 'ROLE_BASIC';
const ROLE_EDITEUR = 'ROLE_EDITEUR';
const ROLE_ADMIN = 'ROLE_ADMIN';
const ROLES = [User::ROLE_BASIC, User::ROLE_EDITEUR, User::ROLE_ADMIN];
```

```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	const ROLE_BASIC = 'ROLE_BASIC';
	const ROLE_EDITEUR = 'ROLE_EDITEUR';
	const ROLE_ADMIN = 'ROLE_ADMIN';
	const ROLES = [User::ROLE_BASIC, User::ROLE_EDITEUR, User::ROLE_ADMIN];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
}
```

## Attributions d'un rôle à un utilisateur

Pour pouvoir attribuer un rôle à un utilisateur nous allons ajouter le `role`
champ dans la table `users`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration {
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
			$table->enum('role', User::ROLES)->default(User::ROLE_BASIC); // <- Ajout d'un rôle par défaut
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
```

Modifions aussi la propriété `$fillable` de la `classe-modèle` `User.php`

```php
...
protected $fillable = [
    	'name',
    	'email',
    	'password',
		'role',
    ];
...
```

## Attributions des fonctionnalités aux différents rôles

Il va nous falloir une table dédiée dans la base de données. Cette table
indiquera quel rôle a le droit à quelle fonctionnalité. Qui dit table dit
`classe-modèle`. Créons la `classe-modèle` ainsi que le fichier migration
simultanément grâce à la commande :

```
php artisan make:model Acl -m
```

> Remarque : Le `-m` indique que l'on aimerait aussi créer le fichier
> `migration` correspondant

Editons le fichier `database\migrations\...._.._.._......_create_acls_table.php`
et ajoutons les champs `fonctionnalite`, `role` pour déterminer quel rôle a
droit à quelle fonctionnalité. (les `timestamps` ne sont pas nécessaires)

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('acls', function (Blueprint $table) {
			$table->id();
			$table->string('fonctionnalite');
			$table->string('role');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('acls');
	}
};
```

`app\Models\Acl.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acl extends Model
{
	use HasFactory;
	protected $fillable = ['fonctionnalite', 'role'];
}
```

Maintenant que la table est prête, il nous faut un seeder pour la remplir. (Qui
a droit à quelle fonctionnalité)

```
php artisan make:seeder AclTableSeeder
```

`\database\seeds\AclTableSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AclTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('acls')->delete();

		DB::table('acls')->insert([
			'role' => User::ROLE_BASIC,
			'fonctionnalite' => 'UnControleur@index',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_BASIC,
			'fonctionnalite' => 'UnControleur@show',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_EDITEUR,
			'fonctionnalite' => 'UnControleur@index',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_EDITEUR,
			'fonctionnalite' => 'UnControleur@show',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_EDITEUR,
			'fonctionnalite' => 'UnControleur@create',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_EDITEUR,
			'fonctionnalite' => 'UnControleur@edit',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_EDITEUR,
			'fonctionnalite' => 'UnControleur@store',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_ADMIN,
			'fonctionnalite' => 'UnControleur@index',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_ADMIN,
			'fonctionnalite' => 'UnControleur@show',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_ADMIN,
			'fonctionnalite' => 'UnControleur@create',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_ADMIN,
			'fonctionnalite' => 'UnControleur@edit',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_ADMIN,
			'fonctionnalite' => 'UnControleur@store',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_ADMIN,
			'fonctionnalite' => 'UnControleur@update',
		]);
		DB::table('acls')->insert([
			'role' => User::ROLE_ADMIN,
			'fonctionnalite' => 'UnControleur@destroy',
		]);
	}
}
```

## Ajout d'utilisateurs ayant différents rôles

Il nous faut maintenant au moins trois utilisateurs pour pouvoir tester les
différentes possibilités.

```
php artisan make:seeder UserTableSeeder
```

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();

		DB::table('users')->insert([
			'name' => 'joe',
			'email' => 'joe@email.ch',
			'password' => Hash::make('mdp_joe'),
		]); // avec le role par défaut ;-)

		DB::table('users')->insert([
			'name' => 'lea',
			'email' => 'lea@email.ch',
			'password' => Hash::make('mdp_lea'),
			'role' => User::ROLE_EDITEUR,
		]);

		DB::table('users')->insert([
			'name' => 'dom',
			'email' => 'dom@email.ch',
			'password' => Hash::make('mdp_dom'),
			'role' => User::ROLE_ADMIN,
		]);
	}
}
```

Avant de pouvoir "peupler" les tables, il nous faut définir l'ordre dans lequel
doivent s'exécuter les `seeders`.

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
		$this->call(AclTableSeeder::class);
		$this->call(UserTableSeeder::class);
	}
}
```

Nous pouvons maintenant créer nos tables et les peupler à l'aide des commandes
suivantes :

```
php artisan migrate:install
```

```
php artisan migrate
```

```
php artisan db:seed
```

Pour que `Laravel` puisse "voir" les nouvelles classes :

```
composer dumpautoload
```

Pour s'assurer que tout fonctionne, nous pouvons lancer l'outil `tinker`

```
php artisan tinker
```

Pour connaître les fonctionnalités qui sont autorisées pour le rôle
`ROLE_EDITEUR` : (à l'aide d'un select, c'est aussi possible ;-)

```
>>> Acl::select('fonctionnalite')->where('Role',User::ROLE_EDITEUR)->get();
```

```
=> Illuminate\Database\Eloquent\Collection {#4291
     all: [
       App\Models\Acl {#4292
         fonctionnalite: "UnControleur@index",
       },
       App\Models\Acl {#4293
         fonctionnalite: "UnControleur@show",
       },
       App\Models\Acl {#4294
         fonctionnalite: "UnControleur@create",
       },
       App\Models\Acl {#4295
         fonctionnalite: "UnControleur@edit",
       },
       App\Models\Acl {#4296
         fonctionnalite: "UnControleur@store",
       },
     ],
   }
```

Pour voir nos trois utilisateurs :

```
>>>  User::all();
```

```
=> Illuminate\Database\Eloquent\Collection {#4289
     all: [
       App\Models\User {#4290
         id: "1",
         name: "joe",
         email: "joe@email.ch",
         #password: "$2y$10$5mzG2UQJEhoBZKDvf5/91.RKZ/QrTYHXILSdtW/o2Sdc7Y.xGC8Xi",
         role: "ROLE_BASIC",
         #remember_token: null,
       },
       App\Models\User {#4291
         id: "2",
         name: "lea",
         email: "lea@email.ch",
         #password: "$2y$10$MaH8w95mc99SdfI7uCnqbOVYx9p7ZJxEJXghcHRiiqXus8DUUXbvm",
         role: "ROLE_EDITEUR",
         #remember_token: null,
       },
       App\Models\User {#4292
         id: "3",
         name: "dom",
         email: "dom@email.ch",
         #password: "$2y$10$5uy70QYCt7YupZ7SxIi0auTEAWgr/CTohw1e3dXg2PVWA8KttBkOy",
         role: "ROLE_ADMIN",
         #remember_token: null,
       },
     ],
   }
```

Comme nous avons implémenté l'authentification, il nous est possible de nous
`logger` dans l'application, mais aucune de nos fonctionnalités est protégée.
Pour s'en apercevoir il suffit de taper l'URL suivante :

```
http://localhost:8000/tests
```

Comment faire ?

Il suffit d'utiliser le middleware `auth` prévu à cet effet. Pour "activer" un
middleware, nous devons l'intercaler entre une route et un contrôleur. Nous
avons deux possibilités :

- soit le faire depuis le constructeur du contrôleur (qu'il faut ajouter)

  ```php
  ...
  class UnControleur extends Controller
  {

      public function __construct() {
          $this->middleware('auth');
      }
  ...
  ```

- soit le faire depuis une route

  ```php
  Route::resource('tests', UnControleur::class)->middleware('auth');
  ```

Il suffit de choisir une des possibilités et de retaper l'URL :

```
http://localhost:8000/tests
```

Cette fois-ci nous sommes obligés de nous authentifier

Comment autoriser les utilisateurs à accéder aux fonctionnalités auxquelles ils
ont droit ?

Et bien nous allons créer notre propre `middleware`.

## Mise en place de la gestion des droits d'accès aux fonctionnalités.

Lançons la commande de création d'un `middleware`

```
php artisan make:middleware AclMiddleware
```

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Acl;

class AclMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		// Pour que notre middleware fonctionne, il faut que l'utilisateur soit authentifié
		if (is_null(auth()->user())) {
			return redirect()->route('login');
		}

		// On récupère le rôle de l'utilisateur
		$role = auth()->user()->getAttributes()['role'];

		// On récupère le nom de la fonctionnalité que l'utilisateur essaye d'accéder
		// (après un peu de nettoyage; la fonctionnalité se trouve après le dernier \)
		// $request->route()->getActionName() : "App\Http\Controllers\UnControleur@index"
		// $fonctionnalite : "UnControleur@index"
		$fonctionnalite = substr(
			$request->route()->getActionName(),
			strrpos($request->route()->getActionName(), '\\') + 1
		);
		// On contrôle que le rôle de l'utilisateur a accès à cette fonctionnalité
		$aAccesA =
			Acl::where('role', $role)
				->where('fonctionnalite', $fonctionnalite)
				->count() != 0;

		// Si il n'a pas accès à cette fonctionnalité, on arrête le traitement
		if (!$aAccesA) {
			abort(403);
			//return response()->json(['message' => 'Forbidden'], 403);
		}

		// On passe la requête plus loin
		// (soit au middleware suivant, soit au contrôleur)
		return $next($request);
	}
}
```

Une fois que le middleware existe, il faut encore l'enregistrer dans la liste
des middleware disponibles par l'application et lui donner un nom (`acl`) (Il
s'agit de compléter le tableau pointé par la propriété `$middlewareAliases` du
fichier `\app\Http\Kernel.php`

```php
...
protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'acl' => \App\Http\Middleware\AclMiddleware::class,      //  <-- Ici :-)
    ];
```

Passons à l'activation du `middleware`.

- soit par la route (où l'on peut chaîner les middleware)

  ```php
  Route::resource('tests', UnControleur::class)
  	->middleware('auth')
  	->middleware('acl');
  ```

- soit par le contrôleur

  ```php
  ...
  public function __construct() {
      $this->middleware('auth');
      $this->middleware('acl');
  }
  ...
  ```

Pour aider `Laravel` à "voir" notre `middleware`.

```
composer dumpautoload
```

Il ne reste plus qu'à tester

Dans notre navigateur accédons à l'URL suivante :

```
http://localhost:8000/tests
```

Comme le middleware `auth` est actif, nous sommes obligés de nous authentifier.

Authentifions nous avec l'utilisateur ayant le rôle ROLE_BASIC

```
email : joe@email.ch
password : mdp_joe
```

Joe étant un utilisateur avec le ROLE_BASIC, il a accès à la méthode `index()`.
Le navigateur affichera donc :

```
Fonctionnalité index
```

Par contre Joe n'a pas accès à la méthode `create()` (qui s'accède grâce à l'URL
suivante : `http://localhost:8000/tests/create`)

Le navigateur affichera donc :

```
403 | Forbidden
```

Nous pouvons maintenant faire un `loggout` (depuis `http://localhost:8000`) et
nous connecter avec un utilisateur ayant un peu plus de droits.

```
email : lea@email.ch
password : mdp_lea
```

Cette fois-ci l'URL : `http://localhost:8000/tests/create` affichera :

```
Fonctionnalité create
```

YES !

Bravo, être arrivés au terme de cette mise en place de la gestion d'accès à des
fonctionnalités d'une application `Laravel`
