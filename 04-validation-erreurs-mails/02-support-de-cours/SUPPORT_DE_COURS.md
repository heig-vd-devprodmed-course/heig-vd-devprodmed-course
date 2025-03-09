# Jour 4 - Validation de Formulaire et Envoi d'Emails avec Laravel

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Scénario](#scénario)
- [Création du projet](#création-du-projet)
- [Structure du Projet](#structure-du-projet)
- [Création du Template](#création-du-template)
- [Création de la Vue du Formulaire](#création-de-la-vue-du-formulaire)
- [Déclaration des Routes](#déclaration-des-routes)
- [Création du Contrôleur](#création-du-contrôleur)
- [Validation des Champs](#validation-des-champs)
- [Configuration de l'Envoi d'Email](#configuration-de-lenvoi-demail)
  - [Installation et Configuration de Mailpit](#installation-et-configuration-de-mailpit)
- [Tests PHPUnit](#tests-phpunit)
- [Récapitulatif](#récapitulatif)
- [Ajout d'une Nouvelle Langue pour les Messages d'Erreur](#ajout-dune-nouvelle-langue-pour-les-messages-derreur)
  - [Publier les fichiers de langue](#publier-les-fichiers-de-langue)
  - [Installer la Bibliothèque `laravel-lang`](#installer-la-bibliothèque-laravel-lang)
  - [Modifier le fichier `.env` pour définir le français](#modifier-le-fichier-env-pour-définir-le-français)
  - [Résultat : Laravel affiche désormais les messages en français !](#résultat--laravel-affiche-désormais-les-messages-en-français-)
- [Récupération des Anciennes Valeurs dans le Formulaire](#récupération-des-anciennes-valeurs-dans-le-formulaire)
  - [Mise à jour de la Vue du Formulaire](#mise-à-jour-de-la-vue-du-formulaire)
  - [Résultat : Meilleure Expérience Utilisateur](#résultat--meilleure-expérience-utilisateur)

## Objectifs

À la fin de cette séance, vous devriez être capable de :

- Lister les étapes nécessaires pour valider un formulaire dans Laravel.
- Décrire le fonctionnement des messages d'erreur et leur affichage dynamique.
- Identifier comment Laravel gère la validation des champs via FormRequest.
- Appliquer une validation sur un formulaire en respectant les bonnes pratiques.
- Énumérer les étapes pour ajouter une nouvelle langue et traduire les messages
  d'erreur.
- Utiliser la fonction old() pour conserver les valeurs saisies en cas d'erreur.
- Configurer et tester l'envoi d'e-mails dans Laravel à l’aide de Mailpit.

## Scénario

Nous allons mettre en place un formulaire avec les étapes suivantes :

1. Le client demande un formulaire.
2. Le serveur retourne le formulaire au client.
3. Le client remplit le formulaire et le soumet au serveur.
4. Si des erreurs sont détectées, le serveur renvoie le formulaire avec des
   messages d'erreur.
5. Une fois le formulaire correctement rempli, le serveur traite les données.
6. Le serveur envoie un e-mail avec les informations soumises.
7. Le client est informé que ses données ont été bien envoyées.

## Création du projet

Créons une nouvelle application `Laravel` à l'aide de la commande :

```bash
# Terminal
laravel new cours-4
```

Sélectionnez les options suivantes :

```bash
Would you like to install a starter kit?

> No starter kit

Which testing framework would you like to use?

> Pest

Which database will your application use?

> SQLite

Would you like to run the default database migrations?

> Yes
```

## Structure du Projet

Voici un aperçu des fichiers et dossiers que nous allons manipuler :

```txt
 app/
 ├──  Http/
 │   ├──  Controllers/
 │   │   ├── ContactController.php  # Contrôleur du formulaire
 │   ├──  Requests/
 │   │   ├── ContactRequest.php     # Classe de validation du formulaire
 │
 resources/
 ├──  views/
 │   ├── template_contact.blade.php    # Template principal
 │   ├── view_formulaire_contact.blade.php  # Vue du formulaire
 │   ├── view_contenu_email.blade.php  # Vue du mail envoyé
 │   ├── view_confirmation.blade.php  # Vue de confirmation
 │
 routes/
 ├── web.php  # Routes de l'application
```

## Création du Template

Nous allons créer un template Blade pour uniformiser l'affichage de nos vues.

```php
<!-- resources/views/template_contact.blade.php -->
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mon Joli Formulaire</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style> textarea { resize: none } </style>
    </head>
    <body>
        <div class="container mt-4">
            @yield('contenu')
        </div>
    </body>
</html>
```

## Création de la Vue du Formulaire

```php
<!-- resources/views/view_formulaire_contact.blade.php -->
@extends('template_contact')

@section('contenu')
<br>
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-header bg-info text-white">Contactez-moi</div>
        <div class="card-body">
            <form method="POST" action="{{ url('contact') }}" accept-charset="UTF-8">
                @csrf
                <div class="mb-3">
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                           placeholder="Votre nom" name="nom" type="text" value="{{ old('nom') }}">
                    {!! $errors->first('nom', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="Votre email" name="email" type="email" value="{{ old('email') }}">
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    <textarea class="form-control {{ $errors->has('texte') ? 'is-invalid' : '' }}"
                              placeholder="Votre message" name="texte" rows="4">{{ old('texte') }}</textarea>
                    {!! $errors->first('texte', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <button class="btn btn-info float-end" type="submit">Envoyer !</button>
            </form>
        </div>
    </div>
</div>
@endsection
```

## Déclaration des Routes

```php
// routes/web.php
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'rendFormulaire']);
Route::post('/contact', [ContactController::class, 'valideEtTraiteFormulaire']);
```

## Création du Contrôleur

Si le contrôleur n'existe pas, créez-le avec la commande :

```bash
php artisan make:controller ContactController
```

```php
// app/Http/Controllers/ContactController.php
<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {

    public function rendFormulaire() {
        return view('view_formulaire_contact');
    }

    public function valideEtTraiteFormulaire(ContactRequest $request) {
        Mail::send('view_contenu_email', $request->all(), function($message) {
            $message->to('admin@example.com')->subject('Nouveau message via formulaire de contact');
        });

        return view('view_confirmation');
    }
}
```

## Validation des Champs

```php
// app/Http/Requests/ContactRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'nom' => 'bail|required|min:3|max:20|alpha',
            'email' => 'required|email',
            'texte' => 'required|max:250'
        ];
    }
}
```

## Configuration de l'Envoi d'Email

Ajoutez ces paramètres dans `.env` :

```
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="contact@example.com"
MAIL_FROM_NAME="Laravel App"
```

### Installation et Configuration de Mailpit

- **Mac** :
  ```
  brew tap axllent/apps
  brew install mailpit
  ```
- **Windows** :  
  Téléchargez la version correspondante ici :  
  [https://github.com/axllent/mailpit/releases](https://github.com/axllent/mailpit/releases)

Démarrez Mailpit :

```
mailpit
```

Accessible à `http://localhost:8025`

## Tests PHPUnit

```php
// tests/Feature/ContactFormTest.php
namespace Tests\Feature;

use Tests\TestCase;

class ContactFormTest extends TestCase {
    public function test_validation_du_formulaire() {
        $response = $this->post('/contact', [
            'nom' => '',
            'email' => 'invalid-email',
            'texte' => ''
        ]);

        $response->assertSessionHasErrors(['nom', 'email', 'texte']);
    }
}
```

## Récapitulatif

- Création d'un formulaire et affichage des erreurs de validation
- Validation des champs avec `FormRequest`
- Conservation des valeurs après erreur
- Configuration et envoi d'e-mails avec `Mail::send`
- Utilisation de `Mailpit` pour tester l'envoi d'e-mails
- Ajout d'une nouvelle langue pour les messages d'erreur
- Tests unitaires pour vérifier le bon fonctionnement

  **Tout est prêt ! Il ne vous reste plus qu'à tester et expérimenter !** 🎉

## Ajout d'une Nouvelle Langue pour les Messages d'Erreur

Par daut, Laravel affiche les messages d'erreur en anglais. Nous allons voir
comment ajouter le français.

### Publier les fichiers de langue

Exécutez la commande suivante pour générer les fichiers de traduction dans
`lang/` :

```bash
php artisan lang:publish
```

Cela crée une structure comme celle-ci :

```
 lang/
     en/
        auth.php
        pagination.php
        passwords.php
        validation.php
```

### Installer la Bibliothèque `laravel-lang`

Nous allons utiliser une bibliothèque pour gérer facilement plusieurs langues.

```bash
composer require laravel-lang/common --dev
```

Une fois installée, ajoutez la langue française avec :

```bash
php artisan lang:add fr
php artisan lang:update
```

Cela ajoutera le dossier `/fr` dans `lang/` :

```
 lang/
     en/
        validation.php
     fr/
        validation.php
    en.json
    fr.json
```

### Modifier le fichier `.env` pour définir le français

Dans le fichier `.env`, changez cette ligne :

```
APP_LOCALE=en
```

Par :

```
APP_LOCALE=fr
```

### Résultat : Laravel affiche désormais les messages en français !

Vous pouvez tester en soumettant un formulaire avec des erreurs et voir les
nouveaux messages en français.

## Récupération des Anciennes Valeurs dans le Formulaire

Actuellement, si un utilisateur remplit le formulaire avec certaines erreurs, il
doit tout ressaisir.  
Laravel propose une solution simple avec la fonction `old('nom_du_champ')`.

### Mise à jour de la Vue du Formulaire

Modifions la vue `view_formulaire_contact.blade.php` pour récupérer les
anciennes valeurs.

```php
<!-- resources/views/view_formulaire_contact.blade.php -->
@extends('template_contact')

@section('contenu')
<br>
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-header bg-info text-white">Contactez-moi</div>
        <div class="card-body">
            <form method="POST" action="{{ url('contact') }}" accept-charset="UTF-8">
                @csrf
                <div class="mb-3">
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                           placeholder="Votre nom" name="nom" type="text" value="{{ old('nom') }}">
                    {!! $errors->first('nom', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="Votre email" name="email" type="email" value="{{ old('email') }}">
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    <textarea class="form-control {{ $errors->has('texte') ? 'is-invalid' : '' }}"
                              placeholder="Votre message" name="texte" rows="4">{{ old('texte') }}</textarea>
                    {!! $errors->first('texte', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <button class="btn btn-info float-end" type="submit">Envoyer !</button>
            </form>
        </div>
    </div>
</div>
@endsection
```

### Résultat : Meilleure Expérience Utilisateur

- Si une erreur est détectée dans le formulaire, les champs précédemment remplis
  sont conservés.
- L'utilisateur ne doit pas tout ressaisir.
