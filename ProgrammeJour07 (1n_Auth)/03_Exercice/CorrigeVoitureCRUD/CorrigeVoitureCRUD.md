# Corrigé Exercice Voiture CRUD

pour que le projet fonctionne, il faut :
   - créer une nouvelle app `Laravel`
   - déplacer les fichiers dans les répertoires de l'app `Laravel`
    - faire les commandes suivantes : 
        - `php artisan migrate:install`
    - `php artisan migrate`

Voilà l'application est prête à fonctionner !



--------------------------------------------

Marche à suivre
===============

1.) Configurer le fichier `.env` pour travailler avec SQLite

2.) Créer le fichier `database.sqlite` dans `\laravel\database\`

3.) Contrôler que tout fonctionne :
    `php artisan migrate:install`

4.) Création d'une migration
    `php artisan make:migration create_voitures_table`
	=> crée un nouveau fichier dans le répertoire `\laravel\database\migrations`

5.) Mise à jour de la méthode up() dans la migration
    

	public function up()
	{
	    Schema::create('voitures', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('marque', 30);
	        $table->string('type', 30);
	        $table->string('couleur', 30);
	        $table->decimal('cylindree', 3, 1);
	    });
	}

6.) Création des nouvelles tables dans `database.sqlite`
    `php artisan migrate`
	
7.) Création du fichier Model pour la table voitures
	`php artisan make:model Voiture`
	=> crée un nouveau fichier `\laravel\app\Models`
	
8.) Mise à jour du fichier `\laravel\app\Models\Voiture.php`

	<?php
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class Voiture extends Model	{
		use HasFactory;
	
		protected $table='voitures';
	
		protected $fillable = [
			'marque', 'type', 'couleur', 'cylindree', 
		];
	
		public $timestamps=false;
	}

> Remarque : L'attribut `$fillable` est nécessaire pour pouvoir faire une "assignation de masse"
>                     lors du `create` dans le contrôleur ;-) [doc](https://laravel.com/docs/9.x/eloquent#mass-assignment)

9.) Test que la classe modèle fonctionne bien

```
php artisan tinker
	>>> $voiture = new App\Models\Voiture
	=> App\Voiture {#3014}
	>>> $voiture->marque = 'Toyota';
	=> "Toyota"
	>>> $voiture->type = 'Limousine';
	=> "Limousine"
	>>> $voiture->couleur = 'Verte';
	=> "verte"
	>>> $voiture->cylindree = 1.2;
	=> 1.2
	>>> $voiture->save();
	=> true
	>>> 
```

10.) Maintenant que tout est prêt au niveau de la base de données, on peut créer un contrôleur
     `php artisan make:controller VoitureController --resource`
	 => crée un fichier dans le répertoire `\laravel\app\Http\Controllers`
	 
11.) Créons maintenant les "sept" routes pour les sept méthodes du contrôleur
     `Route::resource('voiture', VoitureController::class);`
      sans oublier le use ;-)
      `use App\Http\Controllers\VoitureController;`
	 
12.) Pour contrôler que les routes existent
     `php artisan route:list`
	 

```
...
GET|HEAD        voiture ............... voiture.index › VoitureController@index
POST            voiture ............... voiture.store › VoitureController@store
GET|HEAD        voiture/create ........ voiture.create › VoitureController@create
GET|HEAD        voiture/{voiture} ..... voiture.show › VoitureController@show
PUT|PATCH       voiture/{voiture} ..... voiture.update › VoitureController@update
DELETE          voiture/{voiture} ..... voiture.destroy › VoitureController@destroy
GET|HEAD        voiture/{voiture}/edit. voiture.edit › VoitureController@edit
```

 13.) Création d'un fichier `...Request` pour la validation du formulaire
      `php artisan make:request VoitureRequest`
	  => création d'un fichier dans le répertoire `\laravel\app\Http\Request`
	 

 14.) mise à jour de la méthode `authorize()` à `true`
      mise à jour du tableau permettant les validations
	 

```php
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
        'marque'=>'required|min:2|max:30|alpha',
        'type'=>'required|min:2|max:30',
        'couleur'=>'required|min:2|max:30|alpha',
        'cylindree'=>'required|regex:/^[0-9]+(\.[0-9]?)?$/',
    ];
  }
```

 15.) Mise à jour des sept méthodes du contrôleur
     // sans oublier les "use" pour la classe modèle et `VoitureRequest`
	 `use App\Models\Voiture;`
     `use App\Http\Requests\VoitureRequest;`


```php
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $voitures=Voiture::paginate(4);	// permet de voir quatre utilisateurs à la fois
    $links=$voitures->render();    // permet de créer une "barre de navigation"
    return view('view_liste_voitures', compact('voitures','links'));
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view('view_creation_voiture');
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(VoitureRequest $request)
{
    $voiture = Voiture::create($request->all());
    return redirect('voiture')->withOk("La " . $voiture->marque . " a été ajoutée.");
}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id)
{
    $voiture = Voiture::findOrFail($id);
    return view('view_detail_voiture', compact('voiture'));
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $voiture=Voiture::findOrFail($id);
    return view('view_modification_voiture', compact('voiture'));
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(VoitureRequest $request, $id)
{
    Voiture::findOrFail($id)->update($request->all());
    return redirect('voiture')->withOk("La voiture a été modifiée");
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    Voiture::findOrFail($id)->delete();
    return redirect()->back();
}
```

 16.) création du `template` et des `vues` (voir le répertoire `\laravel\resources\views`)