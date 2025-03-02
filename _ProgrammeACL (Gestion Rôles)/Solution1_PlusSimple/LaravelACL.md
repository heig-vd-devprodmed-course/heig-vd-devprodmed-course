# ACL - Attribution d'un rôle à un utilisateur.

Hello et bienvenue pour cette partie qui consiste à mettre en œuvre un contrôle d'accès dans `Laravel`.

Grâce à ce que nous allons voir ci-dessous, il sera possible :

- Dans les vues :

  - Afficher des parties dédiées à certains rôles. (Administrateur, modérateur, etc.)

  

- Dans les contrôleurs :

  - Autoriser l'accès aux méthodes qu'à certains rôles.

## Partie 1

Implémentons tout d'abord l'authentification

```
composer require laravel/breeze --dev
```

```
php artisan breeze:install blade
```

Pour rediriger l'utilisateur après son identification nous pouvons modifier deux contrôleurs qui ont été ajouté lors de la mise en place de l'authentification.

Il s'agit d'abord du contrôleur `app/Http/Controllers/Auth/RegisteredUserController.php`
Il suffit de changer la ligne 49 :

```
return redirect(RouteServiceProvider::HOME);
```

en

```
return redirect('/');
```

et celle du contrôleur `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
Changer la ligne 32 :

```
return redirect()->intended(RouteServiceProvider::HOME);
```

en 

```
return redirect()->intended('/');
```

Il ne reste plus qu'à gérer la déconnexion (`logout`).

Ajoutons une nouvelle route et sa méthode associée.

```php
Route::get('logout', [LoginController::class, 'logout']);
```

> Remarques : 
>
> - Ne pas oublier le `use` de la classe `App\Http\Controllers\Auth\LoginController`
> - Lors de la mise en place de l'authentification quelques nouvelles routes ont été ajoutée.

Créons un nouveau contrôleur `LoginController.php` dans `\app\Http\Controllers\Auth` et  ajoutons la méthode `logout()` (sans oublier le `use` pour la classe `Auth.php`)

```php
<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{   
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
```

## Partie 2

Ajoutons un champ supplémentaire `user_type` dans la migration de la table `users`pour pouvoir attribuer un rôle à un utilisateur.

```php
...
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_type')->default('PasEncoreDeRole');        //<------- ici
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
...
```

Puisqu'on a ajouté un champ dans la table `users`, il faut adapter la classe modèle `User.php` correspondant à cette table en rajoutant une entrée (`user_type`) dans le tableau de la propriété `$fillable`

```php
...

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',        // <- ici
    ];
...
```

Ajoutons maintenant deux utilisateurs avec des rôles différents pour faire nos tests grâce à un `seeder`

```
php artisan make:seeder UsersTableSeeder
```

```php
...
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
                'name' => 'Nom1',
                'email' => 'email1@gmx.ch',
                'password' => Hash::make('password1'),
                'user_type' => 'Role1']);
        DB::table('users')->insert([
                'name' => 'Nom2',
                'email' => 'email2@gmx.ch',
                'password' => Hash::make('password2'),
                'user_type' => 'Role2']);
    }
...
```

> Remarque : N'oubliez pas le use des la classe DB et Hash :wink:

Ajouter le seeder que l'on vient de créer dans le fichier `app\database\seeders\DatabaseSeeder.php`

```php
...
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
    }
...
```

Créons un fichier `database.sqlite` vide dans le répertoire `app\database\`

Mettons à jour le fichier `.env`

```
...
DB_CONNECTION=sqlite
...
```

Ajoutons les tables dans la base de données

```
php artisan migrate:install
```

```
php artisan migrate
```

Ajoutons les données dans les tables de la base de données

```
php artisan db:seed
```

## Partie 3 - Informer `Laravel` de l'existence des rôles

Modifions le fichier (existant) `laravel\app\Providers\AuthServiceProvider.php`
(ajoutons un `use` et modifions la méthode `boot()`)

```php
...
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        
        /**
         * Rend true si l'utilisateur a le rôle "Role1"
         */
        Gate::define('isRole1', function (User $user) {
        	return $user->user_type == 'Role1';
        });
    
        /**
         * Rend true si l'utilisateur a le rôle "Role2"
         */
        Gate::define('isRole2', function(User $user) {
            return $user->user_type == 'Role2';
        });
	}
...
```

> Remarque : N'oubliez pas les use :
>
> - `use App\Models\User;`
> - `use Illuminate\Support\Facades\Gate;`

## Partie 4 - Ajout du tag Blade @can dans une vue

Nous allons utiliser un nouveau tag de `Blade` : @can  [voir doc. officielle](https://laravel.com/docs/10.x/authorization#via-blade-templates)

Pour cette partie nous allons simplement modifier la vue existante `welcome.blade.php` et ajouter une partie avant la partie finale de la page :

```html
...
<div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

en

```html
<div class="text-center text-sm text-gray-500 sm:text-center">
                        @can('isRole1')
                            Tu as le rôle : Role1
                        @elsecan('isRole2')
                            Tu as le rôle : Role2
                        @else
                            Tu n'a pas encore le rôle Role1 ou Role2
                        @endcan
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
```

Voilà, c'est fait. Nous n'avons plus qu'à tester que tout est fonctionnel :slightly_smiling_face:

Lançons l'application

![Welcome](img\Welcome.png)

 Authentifions nous avec :

```
email1@gmx.ch
password1
```

Ce qui nous donne :

![WelcomeRole1](img\WelcomeRole1.png)

Avec l'autre utilisateur, nous aurions eu :

```
email2@gmx.ch
password2
```

![WelcomeRole2](img\WelcomeRole2.png)

## Partie 5 - Limiter l'accès aux méthodes d'un contrôleur

Créons un contrôleur

```
php artisan make:controller MyController
```

et ajoutons une méthode à notre contrôleur avec le code suivant :

```php
...
    public function myMethod() {
        if (!Gate::allows('isRole1')) {
            abort(403,"Tu n'est pas autorisé à faire cette action");
        }
        return "Vous avez bien le 'Role1' (Il n'y a que le rôle 'Role1' qui a le droit d'utiliser cette méthode)";
    }
...
```

> Remarque : Ne pas oubliez le use de la bonne classe `Gate` 
>                     (Il y plusieurs classes `Gate` !!) :
>
> ```php
> use Illuminate\Support\Facades\Gate;
> ```

puis ajoutons une nouvelle route dans le fichier `\route\web.php`

```php
...
Route::get('/myMethod', [MyController::class, 'myMethod']);
...
```

Nous pouvons passer aux tests :slightly_smiling_face:

 Lançons l'application est authentifions nous avec :

```
email1@gmx.ch
password1
```

et entrons l'url suivante :

```
http://localhost:8000/myMethod
```

Vous pouvons voir :

![MyMethodRole1](img\MyMethodRole1.png)

Avec l'autre utilisateur, nous aurions eu :

```
email2@gmx.ch
password2
```



![MyMethodRole2](img\MyMethodRole2.png)



Voilà, nous sommes au terme de cette partie.

Nous avons vu comment implémenter un contrôle d'accès simple dans `Laravel` et sommes capables d'ajouter dans notre application des fonctionnalités réservées à certains rôles.