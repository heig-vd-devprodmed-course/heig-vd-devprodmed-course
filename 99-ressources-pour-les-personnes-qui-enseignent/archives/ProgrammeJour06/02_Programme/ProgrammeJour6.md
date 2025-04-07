# Jour 6

Aujourd'hui, nous allons nous occuper d'un cas qui se retrouve dans la plupart
des applications; à savoir la gestion des utilisateurs.

Au terme de ce cours, nous serons capables de :

- créer
- afficher
- modifier
- supprimer

des utilisateurs de notre base de données.

## Base de données

Créons pour commencer un nouveau projet `Laravel` vide avec comme SGBD Sqlite

La base de donnée `database.sqlite` existe déjà, et le fichier `.env` est déjà
configuré pour que `Laravel` puisse s'y connecter (Cf. cours précédant)

Pas besoin de lancer la commande d'initialisation de la base de données
(création de la table `migrations` de base nécessaire à `Laravel`) car c'est
déjà fait ;-)

> ```php
> php artisan migrate:install
> ```
>
> Le message suivant devrait apparaître :
>
> ```
> INFO  Migration table created successfully.
> ```

## Migration

Pour pouvoir stocker les données des utilisateurs, nous avons besoin d'une
table.

`Laravel` possède déjà un fichier de migration permettant de disposer d'une
table `users`.

Il s'agit du fichier :

​ `laravel\database\migrations\0001_01_01_000000_create_users_table.php`

La table `users` sera crée lorsque nous exécuterons ce fichier de migration.

Editons ce fichier pour y apporter quelques modifications.

Les modifications portent sur :

- L'identifiant que l'on aimerait qu'il soit défini automatiquement
- ajout d'un champ permettant de savoir si l'utilisateur est un administrateur

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('users', function (Blueprint $table) {
			//$table->id();
			$table->increments('id'); // <---
			$table->string('name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->boolean('is_admin')->default(false); // <---
			$table->rememberToken();
			$table->timestamps();
		});
		//...
	}
	//...
};
```

`Laravel 11` a déjà exécuté les migration et la table `users` existe dans déjà !
Il faut donc détruire les tables existantes.

```
php artisan migrate:rollback
```

Puis créer les tables à nouveau

```
php artisan migrate
```

```
0001_01_01_000000_create_users_table .................................................................. 25.57ms DONE
  0001_01_01_000001_create_cache_table ................................................................... 5.07ms DONE
  0001_01_01_000002_create_jobs_table ................................................................... 17.49ms DONE

```

Voilà, la table `users` (et d'autres ;-) ont été crées dans notre base de
donnée.

> Pour voir ces tables, nous pouvons lancer le client graphique
> `DB Browser for SQLite` >[DB Browser](https://sqlitebrowser.org/dl/)

## Modèle

Nous avons vu lors du dernier cours que `Laravel` avait besoin d'une classe
`modèle` pour pouvoir interagir avec une table.

On peut dire pour l'instant : **Une table => un modèle.**

`Laravel` a prévu la table `users`, donc a aussi prévu la classe `modèle` qui va
avec. Il s'agit du fichier : `\app\Models\User.php`

Comme nous avons apporté des modifications dans la table `users`, il faut
adapter la classe `modèle` en y ajoutant le champ `is_admin` dans la propriété
(tableau) `$fillable`

> La propriété `$fillable` est utilisée à l'intérieur du modèle. Elle permet de
> définir les champs à prendre en compte lorsque l'utilisateur insère ou met à
> jour des données. Seuls les champs marqués contenu dans la propriété
> `$fillable` seront utilisés lors de l'insertion ou la mise à jour des données.
> Les données sont donc mises en correspondance avec les champs défini dans
> `$fillable` avant d'être envoyées à la table.
>
> [Documentation officielle](https://laravel.com/docs/11.x/eloquent#mass-assignment)

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
	protected $fillable = ['name', 'email', 'password', 'is_admin'];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}
}
```

N'oublions pas de sauvegarder la modification

## Tinker (interpréteur de commandes Eloquent)

Avant de se lancer dans la suite de la production de notre application (création
de Template, Vues, Contrôleur) nous pouvons tester que ce que nous avons mis en
place grâce à un outil de `Laravel` qui s'appelle `tinker`.

`Tinker` est un outil (en ligne de commande) qui nous permet de tester les
commandes (que nous ferons dans le contrôleur) de création, affichage,
modification et/ou suppression des utilisateurs dans notre base de données.

Pour "lancer" `tinker`, lancer la commande :

```
php artisan tinker
```

Pour créer un nouvel utilisateur il faut créer un nouvel objet `User` (notre
classe `modèle`) :

```php
$unUser = new App\Models\User();
```

Nous devons maintenant renseigner chaque champ de notre objet :

```php
$unUser->name = 'Joe';
```

puis appuyer sur la touche `return`

```php
$unUser->email = 'joe@gmail.com';
```

puis appuyer sur la touche `return`

```php
$unUser->password = 'heyjoe';
```

Nous sommes prêts pour envoyer notre objet dans notre base de données :

```php
$unUser->save();
```

Si le message `=> true` s'affiche, c'est que notre utilisateur a été crée !

Pour quitter `tinker` , il suffit de taper : `quit`

Retournons dans DB Browser pour voir si notre nouvel utilisateur s'y trouve :

![DB Browser Joe](img\DB Browser Joe.png)

Plutôt que de passer de `tinker` à `DB Browser`, nous aurions pu rester dans
`tinker`, pour voir que notre utilisateur a bien été créé.

Relançons `tinker`

```
php artisan tinker
```

Pour voir tous les utilisateurs nous pouvons lancer la commande `Eloquent`
suivante :

```php
App\Models\User::all();
```

```php
> App\Models\User::all();
= Illuminate\Database\Eloquent\Collection {#5835
    all: [
      App\Models\User {#5785
        id: 1,
        name: "Joe",
        email: "joe@gmail.com",
        email_verified_at: null,
        #password: "$2y$12$DkL3CG6hqIgPcbtuW/TUserm0xHDQL.JKX07pbD7rD8PRYSzJ9S8S",
        is_admin: 0,
        #remember_token: null,
        created_at: "2024-03-21 15:19:38",
        updated_at: "2024-03-21 15:19:38",
      },
    ],
  }
```

Pour modifier un utilisateur en particulier (pour nous celui qui a l'identifiant
: 1)

```php
$unUser = App\Models\User::findOrFail(1);
```

```php
$unUser->email = 'joe@msn.com';
```

```php
$unUser->save();
```

Facile non ?

Pour supprimer un utilisateur, il faut taper la commande suivante :

```php
$userASupprimer = App\Models\User::findOrFail(1);
```

```php
$userASupprimer->delete();
```

ou nous aurions pu plus simplement taper :

```php
App\Models\User::findOrFail(1)->delete();
```

Pour ajouter un nouvel utilisateur dans la base de données nous pouvons utiliser
une seule commande, il suffit de mettre les différentes données dans un tableau

```
App\Models\User::create(['name'=> "Test", 'email'=> "test@test.ch",'password'=>"testpassword"]);
```

Pour éviter à chaque fois de devoir retaper le `namespace` de la classe, nous
pouvons informer `tinker` de la manière suivante :

```
use App\Models\User;
```

```
User::all();
```

C'est aussi simple que cela.

`tinker` est l'outil qui nous permet de tester des commandes `Eloquent`.
`Eloquent` est l'outil
[ORM](https://fr.wikipedia.org/wiki/Mapping_objet-relationnel)
(`Object-Relational-Mapping`) de `Laravel` qui permet de travailler en mode
objet pour interagir avec la base de données plutôt que de devoir faire des
commandes SQL.

Pour en savoir plus sur les commandes :
[`Eloquent`](https://laravel.com/docs/11.x/eloquent)

# Application

Nous pouvons maintenant nous atteler à la construction de :

- template
- vues
- requête
- contrôleur
- route

Nous allons maintenant créer un contrôleur un peu particulier.

Un contrôleur de type `resource`.

Un contrôleur de type `resource` est un contrôleur qui contient par défaut un
certain nombre de méthodes permettant de faire des traitement "classiques" dans
la base de données.

La commande pour créer un contrôleur de type `resource` est :

```
php artisan make:controller UserController --resource
```

Un fichier `UserController.php` se trouve maintenant dans le répertoire que nous
connaissons bien : `app\Http\Controllers\`

Editons-le et découvrons ce qu'il contient :

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
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
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
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

Nous pouvons découvrir sept méthodes qui vont nous permettre la gestion complète
de la table `users`

- index() : pour nous permettre d'afficher la liste des utilisateurs
- create() : pour pouvoir renvoyer un formulaire permettant de créer un nouvel
  utilisateur
- store() : pour sauvegarder les données d'un nouvel utilisateur
- show() : pour afficher toutes les données d'un utilisateur
- pour pouvoir renvoyer un formulaire permettant de modifier les données d'un
  utilisateur
- update() : pour pouvoir modifier les données d'un utilisateur
- destroy() : et enfin pour pouvoir supprimer les données d'un utilisateur

Une seule route suffit (`web.php`) pour pouvoir accéder à toutes les méthodes de
notre contrôleur-`resource` :point_up:, il s'agit de la route :

```
Route::resource('user', UserController::class);
```

Pour pouvoir visualiser toutes les routes proposées par notre projet `Laravel`,
il existe la commande suivante

```
php artisan route:list
```

Voici ce que devrait vous retourner l'exécution de cette commande.

> Si une erreur du genre
> `...ReflectionException::("Class "UserController" does not exist")` se
> produit, c'est que vous avez oublié le `use` du contrôleur dans le fichier
> `web.php`

```
...
  GET|HEAD        / ..................................................................................................
  POST            _ignition/execute-solution ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionContr…
  GET|HEAD        _ignition/health-check ....... ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST            _ignition/update-config .... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD        up .................................................................................................
  GET|HEAD        user ............................................................. user.index › UserController@index
  POST            user ............................................................. user.store › UserController@store
  GET|HEAD        user/create .................................................... user.create › UserController@create
  GET|HEAD        user/{user} ........................................................ user.show › UserController@show
  PUT|PATCH       user/{user} .................................................... user.update › UserController@update
  DELETE          user/{user} .................................................. user.destroy › UserController@destroy
  GET|HEAD        user/{user}/edit ................................................... user.edit › UserController@edit

                                                                                                   Showing [12] routes
```

On y retrouve, entre autres, les sept url qui pointent sur les sept méthodes de
notre contrôleur

## Template

Créons maintenant le `template` (`template.blade.php`)

```php
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width", initial-scale="1">
        <title>
            Gestion des utilisateurs
        </title>
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <style> textarea {resize:none} </style>
    </head>
    <body>
        @yield('contenu')
    </body>
</html>
```

Il nous faut maintenant la vue permettant de visualiser la liste de tous les
utilisateurs (`view_index.blade.php`)

## Liste de tous les utilisateurs

```php
@extends('template')

@section('contenu')
<br>
<div class="col-sm-offset-4 col-sm-4">
    @if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible">
        {!! session('ok') !!}
    </div>
    @endif
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Liste des utilisateurs</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{!! $user->id !!}</td>
                    <td class="text-primary"><strong>{!! $user->name !!}</strong></td>
                    <td><a href="{{route('user.show', [$user->id])}}" class="btn btn-success btn-block">Voir</a></td>
                    <td><a href="{{route('user.edit', [$user->id])}}" class="btn btn-warning btn-block">Modifier</a></td>
                    <td>
                        <form method="POST" action="{{route('user.destroy', [$user->id])}}" >
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Supprimer" class="btn btn-danger btn-block" onclick="return confirm('Vraiment supprimer cet utilisateur ?')">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{route('user.create')}}" class="btn btn-info pull-right">Ajouter un utilisateur</a>
    {!! $links !!}
</div>
@endsection
```

Avant de pouvoir tester notre vue, il nous faut ajouter le code nécessaire dans
la méthode `index()` du contrôleur :

```php
    public function index()
    {
        $users=User::paginate(4);   // permet de voir quatre utilisateurs à la fois
		$links=$users->render();    // permet de créer une "barre de navigation"
									// Remarque : La barre n'est visible que lorsqu'il y
									//            a plus de quatre utilisateurs !
		return view('view_index', compact('users','links'));
    }
```

> Remarque : Attention de ne pas oublier le `use` pour la classe `User` !

```
use App\Models\User;
```

Pour tester notre vue, nous pouvons lancer notre application et choisir la route
`/user`

```
localhost:8000/user
```

Nous découvrons le résultat (dont le contenu dépend des tests effectués avec
tinker ou DB Browser ;-) :

![VueIndex](img\VueIndex.png)

Nous pouvons maintenant passer à la vue permettant de créer un nouvel
utilisateur (`view_create.blade.php`)

## Création d'un utilisateur

```php
@extends('template')

@section('contenu')
<div class="col-sm-offset-4 col-sm-4">
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">Création d'un utilisateur</div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form method="POST" action="{{route('user.store')}}" accept-charset="UTF-8" class="form-horizontalpanel">
                    @csrf
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        <input type="text" name="name" placeholder="Nom" class="form-control">
                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        <input type="email" name="email" placeholder="Email" class="form-control">
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                        Mot de passe : <input name="password" type="password" value="" class="form-control">
                        {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group">
                        Confirmation mot de passe <input name="password_confirmation" type="password" value="" class="form-control">
                        {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input name="is_admin" type="checkbox" value="1">Administrateur
                            </label>
                        </div>
                    </div>
                    <input class="btn btn-primary pull-right" type="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>Retour
    </a>
</div>
@endsection
```

Il nous faut maintenant créer la classe de validation des champs du formulaire
de création d'un utilisateur (`UserCreateRequest.php`)

```
php artisan make:request UserCreateRequest
```

Ce qui crée le fichier `laravel\app\Http\Requests\UserCreateRequest.php`

Dans ce fichier nous passons le retour de la méthode `authorize` à `true` et
complétons la méthode `rules()` avec les contraintes pour chaque champs du
formulaire. Ce qui nous donne :

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'name' => 'required|max:255|unique:users', // champ obligatoire et unique dans la table 'users'
			'email' => 'required|email|max:255|unique:users', // champ obligatoire, de type email, max 255 caractères, et unique dans la table 'users'
			'password' => 'required|confirmed|min:6', // champ obligatoire et qui doit correspondre à ce qui est entré dans le champ de confirmation.
			// Le champ doit se nommer comme le champ password avec _confirmation à la fin ;-)
		];
	}
}
```

Avant de tester la création d'un nouvel utilisateur nous devons modifier
quelques points dans notre contrôleur :

- compléter la méthode `create()`

  ```php
  public function create() {
  	return view('view_create');
  }
  ```

- ajouter une méthode `setIsAdmin` pour la gestion de la case à cocher (car si
  la case n'est pas cochée le champ n'apparaît pas dans `$request` donc il nous
  faut l'ajouter)

  ```php
  private function setIsAdmin(Request $request) {
      if (!$request->has('is_admin')) {
          $request->merge(['is_admin' => 0]);
      }
  }
  ```

- compléter la méthode `store(...)` de notre contrôleur

  ```php
  public function store(UserCreateRequest $request) {
      $this->setIsAdmin($request); // permet la gestion de la case à cocher (champ is_admin)
      $user = User::create($request->all());
      return redirect('user')->withOk("L'utilisateur " . $user->name . " a été créé.");
  }
  ```

  > Remarque : Attention, le type du paramètre `$request` à changé ! Il faut
  > donc ajouter le `use` correspondant :
  > `use App\Http\Requests\UserCreateRequest;`

Pour tester notre vue de création d'un utilisateur, nous pouvons lancer notre
application et choisir la route `/user` et cliquer sur le bouton
`Ajouter un utilisateur`

![AjouterUtilisateur](img\AjouterUtilisateur.png)

Nous découvrons notre formulaire de saisie d'un nouvel utilisateur :

![NouvelUtilisateur](img\NouvelUtilisateur.png)

Nous pouvons sans autre le remplir et cliquer sur le bouton `Envoyer`

Un message de confirmation nous informe que l'utilisateur a été créé :

![Confirmation](img\Confirmation.png)

Pour découvrir une fonctionnalité que nous avons implémenté, il faut que nous
disposions de plus de quatre utilisateurs. Ajoutons autant d'utilisateurs que
nécessaire pour découvrir la barre de navigation !

![BarreNavigation](img\BarreNavigation.png)

C'est chouette non ?

# Visualisation des données d'un utilisateur

Passons maintenant à la visualisation des données d'un utilisateur.

Pour ce faire, il nous faut une nouvelle vue (`view_show.blade.php`)

```php
@extends('template')

@section('contenu')
<div class="col-sm-offset-4 col-sm-4">
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">Fiche d'utilisateur</div>
        <div class="panel-body">
            <p>Nom : {{$user->name}}</p>
            <p>Email : {{$user->email}}</p>
            @if($user->is_admin)
              Administrateur
            @endif
        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>Retour
    </a>
</div>
@endsection
```

Puis, il nous faut compléter la méthode `show()` de notre contrôleur :

```php
public function show(string $id) {
    $user = User::findOrFail($id);
    return view('view_show', compact('user'));
}
```

Nous sommes prêts pour tester la nouvelle fonctionnalité !

Pour accéder plus rapidement à notre vue globale des utilisateur, il suffit de
changer la route principale de notre fichier `web.php` en :

```php
Route::get('/', function () {
	return redirect('user');
});
```

Lançons l'application et cliquons sur un des boutons verts `Voir` pour découvrir
le détail d'un utilisateur :

![FicheUtilisateur](img\FicheUtilisateur.png)

## Modification d'un utilisateur

Passons maintenant à la vue permettant la modification des données d'un
utilisateur : (`view_edit.blade.php`)

```php

@extends('template')

@section('contenu')
<br>
<div class="col-sm-offset-4 col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Modification d'un utilisateur</div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form method="POST" action="{{route('user.update', [$user->id])}}" accept-charset="UTF-8" class="form-horizontalpanel">
                    @csrf
                    @method('PUT')
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        <input type="text" name="name" value="{{$user->name}}" placeholder="Nom" class="form-control">
                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        <input type="email" name="email" value="{{$user->email}}" placeholder="Email" class="form-control">
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                @if($user->is_admin)
                                   <input name="is_admin" value="1" type="checkbox" checked>
                                @else
                                   <input name="is_admin" value="1" type="checkbox">
                                @endif
                                Administrateur
                            </label>
                        </div>
                    </div>
                    <input class="btn btn-primary pull-right" type="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>Retour
    </a>
</div>
@endsection
```

Ajoutons une nouvelle classe pour la validation de notre formulaire de
modification des données d'un utilisateur (`UserUpdateRequest.php`)

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		$id = $this->user; // on récupère l'identifiant de l'utilisateur
		return [
			'name' => 'required|max:255|unique:users,name,' . $id, // . $id est une option qui permet d'exclure l'id de la règle unique
			'email' => 'required|email|max:255|unique:users,email,' . $id,
		];
	}
}
```

Complétons la méthode `edit(...)` de notre contrôleur :

```php
	public function edit(string $id)
	{
		$user=User::findOrFail($id);
		return view('view_edit', compact('user'));
	}
```

Complétons la méthode `update(...)` de notre contrôleur :

```php
	public function update(UserUpdateRequest $request, string $id)
	{
		$this->setIsAdmin($request);
		User::findOrFail($id)->update($request->all());
		return redirect('user')->withOk("L'utilisateur " . $request->input('name') . " a été modifié");
	}
```

Sans oublier (`use App\Http\Requests\UserUpdateRequest;`)

C'est bon, nous pouvons tester la modification d'un utilisateur.

![ModificationUtilisateur](img\ModificationUtilisateur.png)

## Suppression d'un utilisateur

Il ne reste plus qu'à compléter la méthode `destroy(...)` dans notre contrôleur

```php
	public function destroy($id) {
		User::findOrFail($id)->delete();
		return redirect()->back();
	}
```

Voilà, notre application est entièrement fonctionnelle !
