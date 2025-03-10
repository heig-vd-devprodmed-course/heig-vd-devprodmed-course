# Jour 5 – Bases de données avec Laravel (SQLite)

## Table des matières

- [Objectifs](#objectifs)
- [Présentation complète de SQLite](#présentation-complète-de-sqlite)
- [Scénario](#scénario)
- [Configuration de SQLite avec Laravel](#configuration-de-sqlite-avec-laravel)
- [Création de la base de données SQLite](#création-de-la-base-de-données-sqlite)
- [Migrations Laravel](#migrations)
- [Création d'un modèle Eloquent](#création-dun-modèle-eloquent)
- [Formulaire pour la newsletter](#formulaire-pour-la-newsletter)
- [Validation des données avec FormRequest](#validation-des-données-avec-formrequest)
- [Contrôleur NewsletterController](#contrôleur-newslettercontroller)
- [Routes](#routes)
- [Tester et vérifier les données](#tester-et-vérifier-les-données)
- [Récapitulatif](#récapitulatif)
- [Ressources complémentaires](#ressources-complémentaires)

---

## Objectifs

À la fin de cette séance, vous devriez être capable de :

- Lister les étapes pour intégrer SQLite avec Laravel.
- Décrire précisément comment configurer Laravel avec une base SQLite.
- Identifier les étapes de création et d'utilisation des migrations Laravel.
- Appliquer le modèle Eloquent pour manipuler simplement une base de données.
- Énumérer et appliquer les étapes pour créer, valider et traiter un formulaire.
- Vérifier les données avec l'outil DB Browser for SQLite.

---

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

---

## Scénario

Nous allons permettre à un utilisateur de s'inscrire à une newsletter.
L'utilisateur saisira son email via un formulaire, que Laravel enregistrera
ensuite dans une base SQLite.

---

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

---

## Création de la base de données SQLite

Pour créer votre base, Laravel se chargera automatiquement du reste dès que vous
lancerez une migration. Pour vérifier que tout fonctionne, exécutez dans votre
terminal :

```bash
php artisan migrate:install
```

---

## Migrations

Les migrations permettent de gérer facilement la structure de votre base de
données.

Créez une migration :

```bash
# Terminal
php artisan make:migration creation_table_emails
```

Éditez le fichier généré pour créer la table `emails` :

```php
// database/migrations/2024_xx_xx_creation_table_emails.php
public function up(): void
{
    Schema::create('emails', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email', 100);
    });
}

public function down(): void
{
    Schema::dropIfExists('emails');
}
```

Exécutez ensuite :

```bash
php artisan migrate
```

---

## Création d'un modèle Eloquent

Utilisez Eloquent, l'ORM intégré à Laravel, pour simplifier vos interactions
avec la base de données.

```bash
php artisan make:model Email
```

Complétez votre modèle :

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

---

## Formulaire pour la newsletter

Créez un template Blade `template_newsletter.blade.php` :

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

Créez ensuite une vue `view_newsletter_formulaire.blade.php` :

```html
<!-- resources/views/view_newsletter_formulaire.blade.php -->
@extends('template_newsletter') @section('titre') Formulaire d'inscription
@endsection @section('contenu')
<form method="POST" action="{{ url('newsletter') }}">
	@csrf
	<input
		name="email"
		type="email"
		placeholder="Votre email"
		value="{{ old('email') }}"
	/>
	{!! $errors->first('email', '<small>:message</small>') !!}
	<button type="submit">Envoyer</button>
</form>
@endsection
```

---

## Validation des données avec FormRequest

Créez une classe de validation :

```bash
php artisan make:request NewsletterRequest
```

```php
// app/Http/Requests/NewsletterRequest.php
public function authorize(): bool {
    return true;
}

public function rules(): array {
    return ['email'=>'required|email|unique:emails'];
}
```

---

## Contrôleur NewsletterController

Créez un contrôleur :

```bash
php artisan make:controller NewsletterController
```

Ajoutez ces méthodes :

```php
// app/Http/Controllers/NewsletterController.php

public function rendFormulaire() {
    return view('view_newsletter_formulaire');
}

public function traiteFormulaire(NewsletterRequest $request) {
    Email::create(['email' => $request->email]);
    return view('view_newsletter_confirm_inscription');
}
```

---

## Routes

Ajoutez ces routes :

```php
// routes/web.php
use App\Http\Controllers\NewsletterController;

Route::get('/newsletter', [NewsletterController::class, 'rendFormulaire']);
Route::post('/newsletter', [NewsletterController::class, 'traiteFormulaire']);
```

---

## Ressources complémentaires

- [Laravel SQLite](https://laravel.com/docs/database)
- [Laravel Eloquent](https://laravel.com/docs/eloquent)
- [DB Browser for SQLite](https://sqlitebrowser.org/)
