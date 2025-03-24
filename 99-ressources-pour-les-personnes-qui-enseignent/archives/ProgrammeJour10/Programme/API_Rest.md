# `API (Application Programming Interface)`

Nous allons voir aujourd'hui comment créer une `API`et comment générer des
données fictives mais réalistes dans une base de données.

---

Une `API`, ou `interface de programmation d’application`, permet de transmettre
des données entre des applications logicielles d’une manière standardisée. De
nombreux services offrent des `API` publiques qui permettent à quiconque
d’envoyer et de recevoir du contenu issu de ces services. Les `API` qui
fonctionnent sur Internet en utilisant des URL `http://` sont appelées des
`API web`. Donc grâce au Web, on peut envoyer une "demande" à une `API` pour
obtenir des informations.

Par exemple une `API` peut :

- mettre à disposition une carte géographique d'après des coordonnées
- mettre à disposition les prévisions météo d'après un nom de ville
- stocker des informations GPS en vue d'afficher une localisation sur une carte
- rendre le nom, prénom et téléphone du responsable

L'avantage d'une `API` c'est que cela permet l'interopérabilité entre
différentes plateformes et différents langages. Une `API` peut-être avoir été
écrit à l'aide d'un langage X (par exemple `php` sur une plateforme mac) et peut
être consommé par un langage Y (par exemple java sur une plateforme `windows`)

On s'affranchi ainsi des problèmes de compatibilités (de plateformes et
langages) :slightly_smiling_face:

## Notre première `API`

Nous allons créer une `API` qui va retourner les données d'une personne.

Commençons par créer une application vierge à l'aide de la commande :

```
laravel new appApiRest/laravel
```

Dans les versions précédente à `Lavarel 11` tout ce qui était nécessaire pour la
création d'une `API` était installé par défaut. Ce n'est plus le cas depuis
`Laravel 11` (ce qui permet d'alléger l'installation de base).

La commande suivante permet d'installer tout ce dont nous avons besoin :

```
php artisan install:api
```

Nous allons maintenant créer une route, mais cette fois-ci nous n'allons pas la
créer dans le fichier `web.php`, mais dans le fichier `api.php` qui vient d'être
installé et qui se trouve dans le même répertoire (`/routes`)

> Remarque :
>
> - Les routes pour les applications-web => `web.php`
> - Les routes pour les `API` => `api.php`

Voici le fichier `\routes\api.php` tel qu'il est par défaut :

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');
```

Ajoutons maintenant notre route qui va nous retourner les données d'une personne
:

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/personne', function () {
	$personne = [
		'prenom' => 'Joe',
		'nom' => 'Bar',
	];
	return $personne;
});
```

Voilà c'est tout ! Notre première `API` est fonctionnelle !

Mettons notre application à disposition :

```
php artisan serve
```

Pour tester que notre `API` fonctionne, il suffit d'appeler la route. Mais
attention, pour que cela fonctionne il faut mettre l'url `/api/` devant le nom
nom de la route.

```
http://localhost:8000/api/personne
```

Ce qui nous retourne :

```
{"prenom":"Joe","nom":"Bar"}
```

`Youpee`, ça marche !

Coder l'information en dur au niveau de la route nous a permis de tester que
cela fonctionne. Passons maintenant à la mise en place "réelle" avec les données
provenant d'une base de données.

Créons une `classe-modèle` `Personne` ainsi qu'une `migration` et une `factory`
(nous allons découvrir son rôle ci-dessous) à l'aide de la commande :

```
php artisan make:model Personne -mf
```

(`m`: pour créer une `migration`, `f`: pour une `factory`
:slightly_smiling_face:)

Pour définir les champs de la table `personnes` éditions le fichier
`\database\migration\....create_personnes_table.php`

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
		Schema::create('personnes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('prenom');
			$table->string('nom');
			$table->string('tel');
			$table->string('email');
			$table->string('ville');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('personnes');
	}
};
```

Comme son nom l'indique une `factory` est une fabrique. La `factory` que nous
avons créé se trouve dans le répertoire
`\database\factories\PersonneFactory.php` Editons ce fichier et modifions-le
pour pouvoir créer facilement des personnes avec des données fictives mais
réalistes !

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personne>
 */
class PersonneFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'prenom' => $this->faker->firstName,
			'nom' => $this->faker->lastName,
			'tel' => $this->faker->phoneNumber,
			'email' => $this->faker->safeEmail,
			'ville' => $this->faker->city,
		];
	}
}
```

Mais qu'est ce qu'un `faker` ? Un `faker` est une classe qui produit des données
`fake` (Fictives, mais réalistes)

Maintenant que notre fabrique est prête, il nous faut un `seeder` pour peupler
notre table :

```
php artisan make:seeder PersonnesTableSeeder
```

Nous allons ajouter le code permettant de créer 20 personnes à l'aide de notre
`factory` :

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Personne;

class PersonnesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('personnes')->delete(); // :-)
		Personne::factory()->count(20)->create();
	}
}
```

N'oublions pas d'ajouter la ligne dans le fichier
`\database\seeds\DatabaseSeeder.php` qui permet l'exécution du `Seeder` pour le
peuplement de notre table dans la base de données.

```php
<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call(PersonnesTableSeeder::class);
	}
}
```

N'oublions pas de mettre à jour la classe-modèle `\app\Models\Personne.php` pour
permettre l'assignation de masse.
[Voir la documentation officielle](https://laravel.com/docs/11.x/eloquent#mass-assignment)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
	use HasFactory;

	protected $fillable = ['prenom', 'nom', 'email', 'tel', 'ville'];
}
```

Pour simplifier le développement de notre `API` nous allons utiliser le SGBD
`sqlite` (La configuration se fait dans le fichier `.env` :wink:)

Voilà, nous sommes prêts pour créer les différentes tables (migrations,
personnes, ...) et y ajouter les données

```
php artisan migrate
```

```
php artisan db:seed
```

Allons voir si nos données sont bien présentes :

```
php artisan tinker
```

```
App\Models\Personne::find(1)
```

Qui nous retourne :

```php
App\Models\Personne {#5452
    id: 1,
    prenom: "Haskell",
    nom: "Lemke",
    tel: "475-690-6982",
    email: "willis39@example.org",
    ville: "Bergnaumstad",
    created_at: "2024-04-23 12:06:59",
    updated_at: "2024-04-23 12:06:59",
  }
```

Plutôt sympa non ? C'est mieux que `Lorem ipsum dolor sit amet` !

Pour plus d'info sur le [`Faker`](https://github.com/fzaninotto/Faker)

Ajoutons une nouvelle route dans le fichier `\routes\api.php`

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Personne;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');

//Route::get('/personne', function() {
//    $personne = [
//        'prenom' => 'Joe',
//        'nom' => 'Bar',
//    ];
//    return $personne;
//});

Route::get('/personnes/{id}', function (int $id) {
	return Personne::findOrFail($id);
});
```

Et testons pour voir que tout fonctionne :

```
http://localhost:8000/api/personnes/1
```

Qui nous retourne :

```
{"id":1,"prenom":"Haskell","nom":"Lemke","tel":"475-690-6982","email":"willis39@example.org","ville":"Bergnaumstad","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"}
```

Il est temps de structurer un peu notre code, car ce n'est pas à la route de
nous retourner le résultat. Le rôle appartient au contrôleur.

Créons un nouveau contrôleur :

```
php artisan make:controller PersonneController
```

Editons notre contrôleur : ``app\Http\Controllers\PersonneController.php` et
ajoutons une méthode

```php
<?php

namespace App\Http\Controllers;

use App\Models\Personne;

class PersonneController extends Controller
{
	public function rendPersonne(int $id)
	{
		return Personne::findOrFail($id);
	}
}
```

et adaptons notre route :

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Personne;
use App\Http\Controllers\PersonneController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

//Route::get('/personne', function() {
//    $personne = [
//        'prenom' => 'Joe',
//        'nom' => 'Bar',
//    ];
//    return $personne;
//});

Route::get('/personnes/{id}', [PersonneController::class, 'rendPersonne']);
```

Testons pour voir que tout fonctionne :

```
http://localhost:8000/api/personnes/1
```

Qui nous retourne :

```
{"id":1,"prenom":"Haskell","nom":"Lemke","tel":"475-690-6982","email":"willis39@example.org","ville":"Bergnaumstad","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"}
```

C'est bien la même résultat, mais avec un code mieux structuré.

Pour être compatible avec l'état de l'art des API nous allons encapsuler les
données d'une personne dans une structure nommée `data`. Pour ce faire, nous
allons créer une nouvelle classe à l'aide de la commande :

```
php artisan make:resource PersonneResource
```

La nouvelle classe est accessible ici :
`\app\Http\Resources\PersonneResource.php`

Nous n'avons pas à faire de modifications dans cette classe :hand: il nous faut
juste adapter notre contrôleur :thumbsup:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use App\Http\Resources\PersonneResource;

class PersonneController extends Controller
{
	public function rendPersonne(int $id)
	{
		return new PersonneResource(Personne::findOrFail($id));
	}
}
```

Voyons ce qui a changé :

```
http://localhost:8000/api/personnes/1
```

Ce qui nous retourne :

```
{"data":{"id":1,"prenom":"Haskell","nom":"Lemke","tel":"475-690-6982","email":"willis39@example.org","ville":"Bergnaumstad","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"}}
```

Nous découvrons la `clé` : `data` contenant la `valeur : une personne`

Nous savons qu'une route `Route::resource(...)` permet d'accéder à sept méthodes
d'un contrôleur. Qu'en est-il du type de route : `Route::apiResource(...)` ?

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Models\Personne;
use App\Http\Controllers\PersonneController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

//Route::get('/personne', function() {
//    $personne = [
//        'prenom' => 'Joe',
//        'nom' => 'Bar',
//    ];
//    return $personne;
//});

//Route::get('/personnes/{id}', [PersonneController::class, 'rendPersonne']);

Route::apiResource('/personnes', PersonneController::class);
```

Découvrons le à l'aide de la commande :

```
php artisan route:list
```

```
...
GET|HEAD        api/personnes ....................... personnes.index › PersonneController@index
POST            api/personnes ....................... personnes.store › PersonneController@store
GET|HEAD        api/personnes/{personne} ............ personnes.show › PersonneController@show
PUT|PATCH       api/personnes/{personne} ............ personnes.update › PersonneController@update
DELETE          api/personnes/{personne} ............ personnes.destroy › PersonneController@destroy
...
```

Ce type de route nous "génère" cinq routes dont une `Get`: `api/personnes` pour
retourner toutes les personnes.

Créons une nouvelle classe `resource` pour encapsuler la liste (collection) de
toutes les personnes

```
php artisan make:resource PersonneResourceCollection --collection
```

Nous pouvons ajouter les méthodes `show() et index()` dans notre contrôleur :

```php
<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use App\Http\Resources\PersonneResource;
use App\Http\Resources\PersonneResourceCollection;

class PersonneController extends Controller
{
	//public function rendPersonne(int $id): PersonneResource {
	//    return new PersonneResource(Personnes::findOrFail($id));
	//}

	public function show(int $id): PersonneResource
	{
		return new PersonneResource(Personne::findOrFail($id));
	}

	public function index(): PersonneResourceCollection
	{
		return new PersonneResourceCollection(Personne::paginate(10)); // les 10 premières
		//return new PersonneResourceCollection(Personne::all()); // toutes les personnes
	}
}
```

Testons pour voir que cela fonctionne :

```
http://localhost:8000/api/personnes/
```

Qui nous retourne :

```php
{"data":[{"id":1,"prenom":"Haskell","nom":"Lemke","tel":"475-690-6982","email":"willis39@example.org","ville":"Bergnaumstad","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":2,"prenom":"Nyasia","nom":"Moore","tel":"+1-831-413-8772","email":"reva.pfannerstill@example.net","ville":"Cecilebury","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":3,"prenom":"Millie","nom":"Jast","tel":"272.232.8184","email":"desmond.lynch@example.com","ville":"Wilfredfurt","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":4,"prenom":"Odell","nom":"Sanford","tel":"+1-341-740-5712","email":"loconner@example.org","ville":"Emeryborough","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":5,"prenom":"Tristian","nom":"Windler","tel":"660-413-7915","email":"leonor22@example.org","ville":"South Jermain","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":6,"prenom":"Everardo","nom":"Predovic","tel":"1-661-862-1946","email":"kobe.nienow@example.com","ville":"Rogermouth","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":7,"prenom":"Kristina","nom":"Bartoletti","tel":"+18284627040","email":"elmira78@example.org","ville":"Mayertborough","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":8,"prenom":"Kellen","nom":"Braun","tel":"1-954-535-3725","email":"enrique.fahey@example.com","ville":"Abigailtown","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":9,"prenom":"Bethel","nom":"Halvorson","tel":"+1.239.525.1691","email":"reinger.thad@example.com","ville":"South Corneliusview","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":10,"prenom":"Royal","nom":"Reinger","tel":"+17174354213","email":"charlie33@example.com","ville":"Millsburgh","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"}],"links":{"first":"http:\/\/localhost:8000\/api\/personnes?page=1","last":"http:\/\/localhost:8000\/api\/personnes?page=2","prev":null,"next":"http:\/\/localhost:8000\/api\/personnes?page=2"},"meta":{"current_page":1,"from":1,"last_page":2,"links":[{"url":null,"label":"&laquo; Previous","active":false},{"url":"http:\/\/localhost:8000\/api\/personnes?page=1","label":"1","active":true},{"url":"http:\/\/localhost:8000\/api\/personnes?page=2","label":"2","active":false},{"url":"http:\/\/localhost:8000\/api\/personnes?page=2","label":"Next &raquo;","active":false}],"path":"http:\/\/localhost:8000\/api\/personnes","per_page":10,"to":10,"total":20}}
```

C'est bien les dix premières personnes.

Et voici comment faire pour obtenir les dix suivantes :

```
http://localhost:8000/api/personnes?page=2
```

```php
{"data":[{"id":11,"prenom":"Liliana","nom":"Franecki","tel":"667-366-0445","email":"wiegand.vivienne@example.net","ville":"West Brady","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":12,"prenom":"Salma","nom":"Feeney","tel":"1-934-418-0047","email":"dparisian@example.org","ville":"Dooleyborough","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":13,"prenom":"Maryse","nom":"Batz","tel":"708.906.0078","email":"vince.toy@example.net","ville":"Abshiremouth","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":14,"prenom":"Osborne","nom":"Medhurst","tel":"(279) 883-8659","email":"gleichner.krystel@example.com","ville":"North Alicia","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":15,"prenom":"Preston","nom":"Schowalter","tel":"385.976.1872","email":"silas.west@example.com","ville":"New Isaiasland","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":16,"prenom":"Sophie","nom":"Williamson","tel":"(929) 501-2933","email":"jamel.leffler@example.net","ville":"Homenickchester","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":17,"prenom":"Kitty","nom":"Dooley","tel":"(475) 377-1149","email":"orie.wilderman@example.com","ville":"Braunport","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":18,"prenom":"Shania","nom":"Fay","tel":"+1-352-507-1430","email":"jschamberger@example.net","ville":"Brandobury","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":19,"prenom":"Uriah","nom":"Bosco","tel":"+1.385.489.0041","email":"elise.mitchell@example.org","ville":"Lake Keyonmouth","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"},{"id":20,"prenom":"Amari","nom":"Weissnat","tel":"1-325-304-3283","email":"braxton.kautzer@example.net","ville":"Lake Erikhaven","created_at":"2024-04-23T12:06:59.000000Z","updated_at":"2024-04-23T12:06:59.000000Z"}],"links":{"first":"http:\/\/localhost:8000\/api\/personnes?page=1","last":"http:\/\/localhost:8000\/api\/personnes?page=2","prev":"http:\/\/localhost:8000\/api\/personnes?page=1","next":null},"meta":{"current_page":2,"from":11,"last_page":2,"links":[{"url":"http:\/\/localhost:8000\/api\/personnes?page=1","label":"&laquo; Previous","active":false},{"url":"http:\/\/localhost:8000\/api\/personnes?page=1","label":"1","active":false},{"url":"http:\/\/localhost:8000\/api\/personnes?page=2","label":"2","active":true},{"url":null,"label":"Next &raquo;","active":false}],"path":"http:\/\/localhost:8000\/api\/personnes","per_page":10,"to":20,"total":20}}
```

Trop chouette non ?

En fait c'est presque hyper chouette... mais les données fictives sont en
anglais...

Ce serait hyper trop chouette si on pouvait les générer en français non ?

Eh bien oui, la personne qui a développé le `Faker` a pensé à tout... Pour
"franciser" les données, il suffit de changer un paramètre, mais le tout c'est
de savoir où :slightly_smiling_face:

On se rappelle que c'est le fichier `.env` qui contient les différents
paramètres de notre application.

Il suffit de changer la ligne :

```
'faker_locale' => 'en_US',
```

en

```
 'faker_locale' => 'fr_CH',
```

On efface toutes les tables

```
php artisan migrate:rollback
```

On recrée les tables

```
php artisan migrate
```

On repeuple les tables à l'aide de la commande :

```
php artisan db:seed
```

et le tour est joué ! Nos données correspondent mieux à nos besoins :thumbsup:

```
http://localhost:8000/api/personnes
```

=>

```
{"data":[{"id":1,"prenom":"Fernando","nom":"Bruchez","tel":"+41 (0)72 158 96 56","email":"jennifer.martin@example.net","ville":"Soleure","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":2,"prenom":"Rui","nom":"Gilli\u00e9ron","tel":"+41 01 605 38 97","email":"lara20@example.net","ville":"Del\u00e9mont","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":3,"prenom":"Michael","nom":"Chappuis","tel":"+41 14 405 81 86","email":"roland.baeriswyl@example.com","ville":"Cully","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":4,"prenom":"Laurence","nom":"Demierre","tel":"0021924236","email":"gillieron.raymonde@example.net","ville":"Croglio","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":5,"prenom":"Dani\u00e8le","nom":"Grosjean","tel":"+41 08 975 45 93","email":"claudia.dubois@example.com","ville":"Losone","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":6,"prenom":"Pierrette","nom":"Dubois","tel":"+41 (0)31 853 75 05","email":"afournier@example.com","ville":"Ilanz","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":7,"prenom":"Paulo","nom":"Neuhaus","tel":"+41(0)216598791","email":"aline.genoud@example.org","ville":"Payerne","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":8,"prenom":"Pierre","nom":"Kunz","tel":"0399612912","email":"eric.huguenin@example.com","ville":"Romainm\u00f4tier","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":9,"prenom":"Jo\u00eblle","nom":"Fellay","tel":"032 150 30 94","email":"eperrenoud@example.net","ville":"Zoug","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"},{"id":10,"prenom":"Eva","nom":"Roy","tel":"+41 (0)37 551 37 83","email":"ferreira.michael@example.net","ville":"Bulle","created_at":"2024-04-23T12:54:46.000000Z","updated_at":"2024-04-23T12:54:46.000000Z"}],"links":{"first":"http:\/\/localhost:8000\/api\/personnes?page=1","last":"http:\/\/localhost:8000\/api\/personnes?page=2","prev":null,"next":"http:\/\/localhost:8000\/api\/personnes?page=2"},"meta":{"current_page":1,"from":1,"last_page":2,"links":[{"url":null,"label":"&laquo; Previous","active":false},{"url":"http:\/\/localhost:8000\/api\/personnes?page=1","label":"1","active":true},{"url":"http:\/\/localhost:8000\/api\/personnes?page=2","label":"2","active":false},{"url":"http:\/\/localhost:8000\/api\/personnes?page=2","label":"Next &raquo;","active":false}],"path":"http:\/\/localhost:8000\/api\/personnes","per_page":10,"to":10,"total":20}}
```

Ça c'est vraiment hyper trop chouette !

Pour terminer nous allons juste encore peaufiner notre `Route::apiResource(...)`
car nous n'avons implémenté que deux des cinq méthodes...

```php
...
Route::apiResource('/personnes', PersonneController::class)->only(['index', 'show']);
...
```

---

Voici en résumé ce que nous avons appris aujourd'hui :

- nous savons comment générer des données fictives (mais réaliste) dans nos
  tables grâce aux :
  - `faker`
  - `factory`
- nous savons comment "personnaliser" ces données en fonction du pays ou l'on se
  trouve
- nous savons comment implémenter une api dans `Laravel`
