# Jour 5

Aujourd'hui, nous allons aborder le thème des bases de données avec Laravel, en
utilisant SQLite comme exemple pratique.

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Présentation complète de SQLite](#présentation-complète-de-sqlite)
- [Présentation de l'ORM (Eloquent)](#présentation-de-lorm-eloquent)
- [Scénario](#scénario)
- [Configuration de SQLite avec Laravel](#configuration-de-sqlite-avec-laravel)
- [Migrations Laravel](#migrations-laravel)
- [Création d'un modèle Eloquent](#création-dun-modèle-eloquent)
- [Formulaire pour la newsletter](#formulaire-pour-la-newsletter)
- [Validation des données avec FormRequest](#validation-des-données-avec-formrequest)
- [Contrôleur NewsletterController](#contrôleur-newslettercontroller)
- [Routes](#routes)
- [Tester et vérifier les données](#tester-et-vérifier-les-données)
- [Récapitulatif](#récapitulatif)
- [Ressources complémentaires](#ressources-complémentaires)

## Objectifs

À la fin de cette séance, vous devriez être capable de :

- Lister les étapes nécessaires pour intégrer SQLite avec Laravel.
- Décrire comment configurer Laravel pour utiliser une base de données SQLite.
- Identifier les étapes de création et d'utilisation des migrations Laravel.
- Appliquer le modèle Eloquent pour manipuler simplement une base de données.
- Énumérer les étapes pour créer, valider et traiter un formulaire.
- Vérifier les données avec l'outil DB Browser for SQLite.

## Présentation complète de SQLite

[SQLite](https://www.sqlite.org/index.html) est une bibliothèque logicielle
écrite en langage C, qui propose un moteur de base de données relationnelle
accessible via le langage SQL.

Contrairement aux serveurs classiques comme MySQL ou PostgreSQL, SQLite
n'utilise pas un schéma client-serveur mais est directement intégrée aux
applications qui l'utilisent. La totalité de la base de données est stockée dans
un fichier indépendant, compatible avec toutes les plateformes.

Son auteur, D. Richard Hipp, a placé SQLite dans le domaine public, ce qui
permet une utilisation libre sans aucune restriction, aussi bien pour des
projets open-source que des projets commerciaux.

SQLite est extrêmement populaire grâce à son intégration dans de nombreux
logiciels grand public (Firefox, Skype, applications Apple et Android, etc.) et
est particulièrement adaptée aux systèmes embarqués et applications mobiles du
fait de sa légèreté (moins de 600 Ko).

Points clés :

- **Léger** (moins de 600 Ko)
- **Intégré** directement dans les applications
- **Stockage** dans un seul fichier
- **Très utilisé** (Firefox, Chrome, iOS, Android, etc.)

## Présentation de l'ORM (Eloquent)

Un **ORM (Object-Relational Mapping)** est un outil de programmation qui permet
de manipuler une base de données relationnelle à travers une représentation en
objets.

Autrement dit, un ORM permet aux développeurs d'interagir avec une base de
données sans écrire directement du code SQL. Les interactions (comme créer,
lire, modifier, ou supprimer des données) se font via des objets et des méthodes
en langage de programmation orienté objet, ce qui facilite la gestion des
données et la maintenance du code.

Dans Laravel, l'ORM utilisé est appelé **Eloquent**. Il offre une syntaxe simple
et intuitive pour manipuler les données de la base. Chaque table de la base de
données est représentée par une classe (modèle) et chaque ligne de la table
devient une instance de cette classe.

**Exemple sans ORM (SQL direct) :**

```sql
INSERT INTO emails (email) VALUES ('exemple@exemple.com');
```

Avec Eloquent :

```php
// Avec le modèle Email (Eloquent)
Email::create(['email' => 'exemple@exemple.com']);
```

La deuxième version est beaucoup plus simple à lire, à maintenir, et évite les
erreurs SQL courantes.

Documentation officielle :
[Laravel Eloquent ORM](https://laravel.com/docs/eloquent)

## Scénario

Nous allons permettre à un utilisateur de s'inscrire à une newsletter.
L'utilisateur saisira son email via un formulaire, que Laravel enregistrera
ensuite dans une base SQLite.

## Configuration de SQLite avec Laravel

Créez un fichier texte vide nommé `database.sqlite` dans :

```
/database/database.sqlite
```

Modifiez ensuite votre fichier `.env` :

```env
DB_CONNECTION=sqlite
# Supprimez ou commentez toutes les autres lignes DB_
```

Vérifiez que l’extension SQLite est activée dans votre fichier `php.ini` :

```
extension=pdo_sqlite
extension=sqlite3
```

## Migrations Laravel

Les migrations facilitent la création et la gestion de tables en Laravel.

Créons la migration pour la table `emails` :

```bash
# Terminal (dans le dossier racine de votre projet)
php artisan make:migration creation_table_emails
```

Modifiez la migration ainsi créée :

```php
// database/migrations/2024_03_18_creation_table_emails.php
public function up(): void
{
    Schema::create('emails', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email', 100)->unique(); // chaque email doit être unique
    });
}

public function down(): void
{
    Schema::dropIfExists('emails');
}
```

Lancez la migration :

```bash
# Terminal (dans le dossier racine de votre projet)
php artisan migrate
```

## Création d'un modèle Eloquent

Créez le modèle Eloquent correspondant à la table `emails` :

```bash
# Terminal (dans le dossier racine de votre projet)
php artisan make:model Email
```

Complétez ce modèle ainsi :

```php
// app/Models/Email.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';
    public $timestamps = false;
    protected $fillable = ['email'];
}
```

## Formulaire pour la newsletter

Créez un template Blade nommé `template_newsletter.blade.php` :

```html
<!-- resources/views/template_newsletter.blade.php -->
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>@yield('titre')</title>
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
		/>
	</head>
	<body>
		<div class="container">@yield('contenu')</div>
	</body>
</html>
```

Créez la vue pour le formulaire d'inscription :

```blade
<!-- resources/views/view_newsletter_formulaire.blade.php -->
@extends('template_newsletter')

@section('titre') Inscription Newsletter @endsection

@section('contenu')
<form method="POST" action="{{ url('newsletter') }}">
    @csrf
    <input name="email" type="email" placeholder="Votre email" value="{{ old('email') }}" required>
    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
    <button type="submit">Envoyer</button>
</form>
@endsection
```

Créez également la vue de confirmation d'inscription :

```html
<!-- resources/views/view_newsletter_confirm_inscription.blade.php -->
@extends('template_newsletter') @section('titre') Confirmation d'inscription
@endsection @section('contenu')
<div class="alert alert-success">
	Merci ! Vous êtes bien inscrit à la newsletter.
</div>
@endsection
```

## Validation des données avec FormRequest

Créez la classe de validation :

```bash
# Terminal (dans le dossier racine de votre projet)
php artisan make:request NewsletterRequest
```

Définissez vos règles :

```php
// app/Http/Requests/NewsletterRequest.php
public function authorize(): bool {
    return true;
}

public function rules(): array {
    return ['email'=>'required|email|unique:emails'];
}
```

## Contrôleur NewsletterController

Créez votre contrôleur :

```bash
# Terminal (dans le dossier racine du projet)
php artisan make:controller NewsletterController
```

Complétez votre contrôleur :

```php
// app/Http/Controllers/NewsletterController.php
use App\Models\Email;
use App\Http\Requests\NewsletterRequest;

public function rendFormulaire() {
    return view('view_newsletter_formulaire');
}

public function traiteFormulaire(NewsletterRequest $request) {
    Email::create(['email' => $request->email]);
    return view('view_newsletter_confirm_inscription');
}
```

## Routes

Définissez vos routes dans `web.php` :

```php
// routes/web.php
use App\Http\Controllers\NewsletterController;

Route::get('/newsletter', [NewsletterController::class, 'rendFormulaire']);
Route::post('/newsletter', [NewsletterController::class, 'traiteFormulaire']);
```

## Tester et vérifier les données

Installez [DB Browser for SQLite](https://sqlitebrowser.org/dl/) pour visualiser
facilement le contenu de votre base `database.sqlite`.

- Lancez l'outil
- Ouvrez votre fichier `database.sqlite`
- Vérifiez la présence et le contenu de la table `emails`

## Récapitulatif

- Configuration de SQLite avec Laravel
- Création et gestion de bases de données via migrations
- Manipulation simplifiée des données avec Eloquent
- Validation rigoureuse des données utilisateur
- Vérification avec un outil graphique simple (DB Browser for SQLite)

## Ressources complémentaires

- [Documentation officielle Laravel Database](https://laravel.com/docs/database)
- [Eloquent ORM - Laravel](https://laravel.com/docs/eloquent)
- [DB Browser for SQLite](https://sqlitebrowser.org/dl/)
