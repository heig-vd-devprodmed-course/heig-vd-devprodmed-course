# Database : Exercices et solutions

## Table des matières

- [Table des matières](#table-des-matières)
- [Exercice - Gestion des voitures en base de données avec Laravel](#exercice---gestion-des-voitures-en-base-de-données-avec-laravel)
- [Solution - Gestion des voitures en base de données avec Laravel](#solution---gestion-des-voitures-en-base-de-données-avec-laravel)
  - [1. Création du modèle et de la migration](#1-création-du-modèle-et-de-la-migration)
  - [2. Définition du modèle Car](#2-définition-du-modèle-car)
  - [3. Création du contrôleur](#3-création-du-contrôleur)
  - [4. Définition des routes](#4-définition-des-routes)
  - [5. Création des vues](#5-création-des-vues)
  - [6. Tester l'application](#6-tester-lapplication)

## Exercice - Gestion des voitures en base de données avec Laravel

1. Écrire un code permettant d'ajouter des voitures dans une base de données.
   Une voiture est définie par :

   - Un identifiant unique
   - Une marque (brand)
   - Un type (type)
   - Une couleur (color)
   - Une cylindrée (en litres) (engine_size)

La saisie d'une voiture se fait via un formulaire

## Solution - Gestion des voitures en base de données avec Laravel

### 1. Création du modèle et de la migration

```bash
# Terminal (dans le dossier racine du projet)
php artisan make:model Car --migration --controller
```

Le modèle `Car` est créé dans `app/Models/Car.php` et la migration associée dans
`database/migrations/`. Le contrôleur `CarController` est créé dans
`app/Http/Controllers/`.

Modifions la migration pour ajouter les champs nécessaires :

```php
// database/migrations/aaaa_mm_jj_hhmmss_create_cars_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('cars', function (Blueprint $table) {
			$table->id();
			$table->string('brand');
			$table->string('type');
			$table->string('color');
			$table->decimal('engine_size', 3, 1); // Ex: 1.6L
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('cars');
	}
};
```

Lançons la migration :

```bash
# Terminal (dans le dossier racine du projet)
php artisan migrate
```

### 2. Définition du modèle Car

```php
// app/Models/Car.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	protected $fillable = ['brand', 'type', 'color', 'engine_size'];
}
```

### 3. Création du contrôleur

Ajoutons les méthodes nécessaires :

```php
// app/Http/Controllers/CarController.php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
	public function form()
	{
		return view('cars.form');
	}

	public function create(Request $request)
	{
		$validated = $request->validate([
			'brand' => 'required|string|max:50',
			'type' => 'required|string|max:50',
			'color' => 'required|string|max:30',
			'engine_size' => 'required|numeric|min:0.5|max:6.0',
		]);

		Car::create($validated);

		return redirect()
			->route('cars.index')
			->with('success', 'Car added successfully!');
	}

	public function index()
	{
		$cars = Car::all();
		return view('cars.index', compact('cars'));
	}
}
```

### 4. Définition des routes

```php
// routes/web.php
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/cars/form', [CarController::class, 'form'])->name('cars.form');
Route::post('/cars', [CarController::class, 'create'])->name('cars.create');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
```

### 5. Création des vues

#### Template principal

```bash
# Terminal (dans le dossier racine du projet)
php artisan make:view template
```

```php
<!-- resources/views/template.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">@yield('content')</div>
</body>
</html>
```

#### Formulaire d’ajout d’une voiture

```bash
# Terminal (dans le dossier racine du projet)
php artisan make:view cars.form
```

```php
<!-- resources/views/cars/form.blade.php -->
@extends('template')

@section('title', 'Add a Car')

@section('content')
    <h2>Add a new Car</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('cars.store') }}">
        @csrf
        <label>Brand:</label>
        <input type="text" name="brand" required>
        <label>Type:</label>
        <input type="text" name="type" required>
        <label>Color:</label>
        <input type="text" name="color" required>
        <label>Engine Size (L):</label>
        <input type="number" name="engine_size" step="0.1" min="0.5" max="6.0" required>
        <button type="submit">Add Car</button>
    </form>
@endsection
```

#### Affichage des voitures enregistrées

```bash
# Terminal (dans le dossier racine du projet)
php artisan make:view cars.index
```

```php
<!-- resources/views/cars/index.blade.php -->
@extends('template')

@section('title', 'Car List')

@section('content')
    <h2>Car List</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Color</th>
                <th>Engine Size (L)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->type }}</td>
                    <td>{{ $car->color }}</td>
                    <td>{{ $car->engine_size }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('cars.form') }}" class="btn btn-primary">Add a Car</a>
@endsection
```

### 6. Tester l'application

```bash
# Terminal (dans le dossier racine du projet)
php artisan serve
```

Accédez à `http://localhost:8000/cars` pour voir la liste des voitures
enregistrées.
