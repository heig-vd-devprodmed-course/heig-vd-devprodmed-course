# Jour 4 - Validation de Formulaire et Envoi d'Emails avec Laravel

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Rappel `GET` et `POST`](#rappel-get-et-post)
  - [GET](#get)
  - [POST](#post)
- [Scénario](#scénario)
- [Création du projet](#création-du-projet)
- [Structure du Projet](#structure-du-projet)
- [Création du Template](#création-du-template)
  - [Explications](#explications)
- [Création de la Vue du Formulaire](#création-de-la-vue-du-formulaire)
  - [Explications](#explications-1)
- [Déclaration des Routes](#déclaration-des-routes)
- [Création du Contrôleur](#création-du-contrôleur)
- [Classe pour validation des champs d'un formulaire](#classe-pour-validation-des-champs-dun-formulaire)
  - [Création de la Classe de Validation](#création-de-la-classe-de-validation)
  - [Contenu Initial de `ContactRequest.php`](#contenu-initial-de-contactrequestphp)
  - [Activation de la Classe et Ajout des Règles de Validation](#activation-de-la-classe-et-ajout-des-règles-de-validation)
  - [Affichage des Messages d'Erreur](#affichage-des-messages-derreur)
- [Vue (Contenu Email)](#vue-contenu-email)
  - [Création de la Vue `view_contenu_email.blade.php`](#création-de-la-vue-view_contenu_emailbladephp)
- [Vue (Confirmation de réception des informations)](#vue-confirmation-de-réception-des-informations)
  - [Création de la Vue `view_confirmation.blade.php`](#création-de-la-vue-view_confirmationbladephp)
  - [Pourquoi afficher une page de confirmation ?](#pourquoi-afficher-une-page-de-confirmation-)
- [Configuration de l'Envoi d'Email](#configuration-de-lenvoi-demail)
  - [Installation et Configuration de Mailpit](#installation-et-configuration-de-mailpit)
- [Récapitulatif](#récapitulatif)
- [Résolution des Erreurs Possibles](#résolution-des-erreurs-possibles)
  - [Erreur `View [view_contenu_email] not found`](#erreur-view-view_contenu_email-not-found)
  - [Erreur `View [view_confirmation] not found`](#erreur-view-view_confirmation-not-found)
  - [Erreur après modification des vues](#erreur-après-modification-des-vues)
- [Testez](#testez)
- [Ajout d'une Nouvelle Langue pour les Messages d'Erreur](#ajout-dune-nouvelle-langue-pour-les-messages-derreur)
  - [Publier les fichiers de langue](#publier-les-fichiers-de-langue)
  - [Installer la Bibliothèque `laravel-lang`](#installer-la-bibliothèque-laravel-lang)
  - [Modifier le fichier `.env` pour définir le français](#modifier-le-fichier-env-pour-définir-le-français)
  - [Résultat : Laravel affiche désormais les messages en français](#résultat--laravel-affiche-désormais-les-messages-en-français)

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

## Rappel `GET` et `POST`

Les méthodes `GET` et `POST` sont utilisées pour envoyer des données à un
serveur web. Elles sont utilisées dans les formulaires HTML pour envoyer des
données saisies par l'utilisateur.

### GET

- Seule une quantité limitée de données peut être envoyée, car elles transitent
  dans l’en-tête de la requête.
- Moins sécurisé : les données envoyées sont visibles dans la barre d’URL.
- Plus efficace et plus utilisé que POST pour récupérer des ressources.
- Les paramètres restent dans l’historique du navigateur et peuvent être mis en
  cache.
- Seuls les caractères ASCII sont autorisés.
- Ne doit pas être utilisé pour l’envoi de mots de passe ou d’informations
  sensibles.
- Visible par tout le monde dans la barre d’adresse du navigateur.
- Peut être mis en cache.

### POST

- Permet d’envoyer une grande quantité de données via le corps de la requête.
- Plus sécurisé : les données ne sont pas exposées dans l’URL.
- Moins efficace que GET pour récupérer des ressources, mais adapté à l’envoi de
  données sensibles.
- Les paramètres ne sont pas enregistrés dans l’historique du navigateur.
- Aucun problème avec les caractères binaires ou spéciaux.
- Recommandé pour l’envoi de mots de passe ou d’informations sensibles.
- Les variables ne sont pas visibles dans l’URL.
- Ne peut pas être mis en cache.

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

> [!TIP]
>
> Vous n'avez pas besoin de créer un nouveau projet si vous avez déjà suivi les
> étapes précédentes. Vous pouvez continuer avec le projet existant.

Créons une nouvelle application `Laravel` à l'aide de la commande :

```bash
# Terminal (dans le dossier de votre choix)
laravel new cours-4
```

Sélectionnez les options suivantes :

```bash
Would you like to install a starter kit?

> No starter kit

Which testing framework would you like to use?

> Pest

Which database will your application use?

> SQLite # Si vous êtes à l'aise avec MySQL, vous pouvez choisir MySQL

Would you like to run the default database migrations?

> Yes
```

## Structure du Projet

Voici un aperçu des fichiers et dossiers que nous allons manipuler :

```txt
app/
    Http/
        Controllers/
            ContactController.php  # Contrôleur du formulaire
        Requests/
            ContactRequest.php     # Classe de validation du formulaire

resources/
    views/
        template_contact.blade.php    # Template principal
        view_formulaire_contact.blade.php  # Vue du formulaire
        view_contenu_email.blade.php  # Vue du mail envoyé
        view_confirmation.blade.php  # Vue de confirmation

routes/
    web.php  # Routes de l'application
```

## Création du Template

Nous allons créer un template Blade pour uniformiser l'affichage de nos vues.

```php
<!-- resources/views/template_contact.blade.php -->
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >
        <title>Mon Joli Formulaire</title>
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
        >
        <style> textarea { resize: none } </style>
    </head>
    <body>
        <div class="container mt-4">
            @yield('contenu')
        </div>
    </body>
</html>
```

### Explications

- `@yield('contenu')` : Permet d'insérer le contenu spécifique de chaque vue.
- `<style> textarea { resize: none } </style>` : Empêche le redimensionnement
  des zones de texte.
- `https://cdn.jsdelivr.net/npm/bootstrap@5.3.0...` : Charge le CSS de Bootstrap
  pour un affichage plus agréable.

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
            <form
                method="POST"
                action="{{ url('contact') }}"
                accept-charset="UTF-8"
            >
                @csrf
                <div class="mb-3">
                    <input
                        class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                        placeholder="Votre nom"
                        name="nom"
                        type="text"
                        value="{{ old('nom') }}"
                    >
                    {!! $errors->first(
                        'nom',
                        '<div class="invalid-feedback">:message</div>'
                    ) !!}
                </div>
                <div class="mb-3">
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="Votre email"
                           name="email"
                           type="email"
                           value="{{ old('email') }}"
                    >
                    {!! $errors->first(
                        'email',
                        '<div class="invalid-feedback">:message</div>'
                        ) !!}
                </div>
                <div class="mb-3">
                    <textarea class="form-control {{ $errors->has('texte') ? 'is-invalid' : '' }}"
                              placeholder="Votre message"
                              name="texte"
                              rows="4"
                    >{{ old('texte') }}</textarea>
                    {!! $errors->first(
                        'texte',
                        '<div class="invalid-feedback">:message</div>'
                        ) !!}
                </div>
                <button class="btn btn-info float-end" type="submit">Envoyer !</button>
            </form>
        </div>
    </div>
</div>
@endsection
```

### Explications

- `@csrf` : Génère un jeton CSRF pour protéger le formulaire.
- `{{ $errors->has('nom') ? 'is-invalid' : '' }}` : Ajoute la classe
  `is-invalid` si une erreur est détectée.
- `{{ old('nom') }}` : Récupère la valeur précédemment saisie.
- `{!!` et `!!}` : Permettent d'insérer du code HTML dans une vue.
- `{!! $errors->first() !!}` : Affiche le message d'erreur si le champ `nom`
  n'est pas valide.
- Gestion des erreurs pour chaque champ du formulaire. Si une erreur est
  détectée, un message s'affiche à côté du champ concerné. `$errors->first()`
  permet d'afficher le premier message d'erreur pour un champ donné.

## Déclaration des Routes

Nous allons déclarer les routes pour afficher le formulaire et traiter les
données.

```php
// routes/web.php
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'rendFormulaire']);
Route::post('/contact', [
    ContactController::class,
    'valideEtTraiteFormulaire'
]);
```

## Création du Contrôleur

Si le contrôleur n'existe pas, créez-le avec la commande :

```bash
# Terminal (à la racine du projet)
php artisan make:controller ContactController
```

Dans le contrôleur, nous allons ajouter deux méthodes `rendFormulaire()` et
`valideEtTraiteFormulaire()`.

```php
// app/Http/Controllers/ContactController.php
<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest; // Import de la classe de validation
use Illuminate\Support\Facades\Mail; // Import de la classe Mail

class ContactController extends Controller {

    public function rendFormulaire() {
        return view('view_formulaire_contact');
    }

    public function valideEtTraiteFormulaire(ContactRequest $request) {
        Mail::send(
            'view_contenu_email',
            $request->all(),
            function($message) {
            $message->to('admin@example.com')
            ->subject('Nouveau message via formulaire de contact');
        });

        return view('view_confirmation');
    }
}
```

- `rendFormulaire()` : Affiche le formulaire de contact.
- `valideEtTraiteFormulaire()` : Valide les données du formulaire et les traite
  si elles sont correctes. Nous allons voir plus en détail son fonctionnement
  dans la section suivante.

Si vous allez sur `http://localhost:8000/contact`, vous devriez voir le
formulaire de contact.

Il nous reste à construire la partie permettant de traiter les données provenant
du formulaire.

## Classe pour validation des champs d'un formulaire

Lorsque nous envoyons un formulaire, il est essentiel de vérifier que les
informations fournies du côté client sont correctes avant de les traiter.  
Laravel propose un moyen structuré de gérer ces validations en utilisant des
**FormRequests**.

### Création de la Classe de Validation

Laravel nous permet de générer une classe de validation avec la commande
suivante :

```bash
# Terminal (à la racine du projet)
php artisan make:request ContactRequest
```

Cela crée un fichier dans le dossier `app/Http/Requests/` :

```txt
app/
     Http/
         Requests/
             ContactRequest.php  # Classe de validation du formulaire
```

### Contenu Initial de `ContactRequest.php`

```php
// app/Http/Requests/ContactRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool {
        return false; // Par défaut, l'accès est refusé.
    }

    /**
     * Définit les règles de validation des champs du formulaire.
     */
    public function rules(): array {
        return [
            //
        ];
    }
}
```

### Activation de la Classe et Ajout des Règles de Validation

Nous devons maintenant autoriser l'utilisation de cette classe et définir les
contraintes pour chaque champ.

```php
// app/Http/Requests/ContactRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool {
        return true; // On autorise l'utilisation de la classe.
    }

    /**
     * Définit les règles de validation des champs du formulaire.
     */
    public function rules(): array {
        return [
            'nom' => 'bail|required|min:3|max:20|alpha',
            'email' => 'required|email',
            'texte' => 'required|max:250'
        ];
    }
}
```

- `bail` : Arrête la validation dès la première erreur pour un champ.
- `required` : Le champ est obligatoire.
- `min:3` : Le champ `nom` doit contenir au moins 3 caractères.
- `max:20` : Le champ `nom` ne peut pas dépasser 20 caractères.
- `alpha` : Le champ `nom` ne doit contenir que des lettres.
- `email` : Vérifie que le champ `email` contient une adresse valide.
- `max:250` : Le champ `texte` est limité à 250 caractères.

Donc, lorsque nous regardons le contrôleur, nous pouvons voir que la méthode
`valideEtTraiteFormulaire()` prend un objet de type `ContactRequest` en
paramètre. grâce à cela, Laravel appliquera automatiquement la validation :

- Laravel appliquera **automatiquement** la validation définie dans
  `ContactRequest.php` **avant** d'exécuter la méthode
  `valideEtTraiteFormulaire()`.
- Si des erreurs sont détectées, Laravel **redirigera l'utilisateur** vers le
  formulaire avec les messages d'erreur appropriés.

> [!TIP]
>
> La documentation officielle de Laravel fournit une liste complète des règles
> de validation disponibles :
> [https://laravel.com/docs/12.x/validation#available-validation-rules](https://laravel.com/docs/12.x/validation#available-validation-rules)

### Affichage des Messages d'Erreur

Dans la vue du formulaire (`view_formulaire_contact.blade.php`), nous avons déjà
prévu l'affichage des erreurs :

```php
<input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
       name="nom" type="text" value="{{ old('nom') }}">
{!! $errors->first('nom', '<div class="invalid-feedback">:message</div>') !!}
```

Avec cette approche, **l'expérience utilisateur est améliorée**, et les erreurs
sont clairement affichées à côté des champs concernés.

## Vue (Contenu Email)

Une fois le formulaire soumis et validé, nous envoyons un email contenant les
informations saisies.  
Laravel nous permet de créer une **vue dédiée au contenu de l'email**, qui sera
utilisée par `Mail::send()` dans le contrôleur.

Laravel fournit une API simple pour envoyer des e-mails.

```php
        Mail::send(
            'view_contenu_email',
            $request->all(),
            function($message) {
            $message->to('admin@example.com')
            ->subject('Nouveau message via formulaire de contact');
        });
```

- `Mail::send()` : Envoie un email.
- `'view_contenu_email'` : Vue utilisée pour le contenu de l'email.
  `view_contenu_email.blade.php` dans `resources/views/`.
- `$request->all()` : Récupère toutes les données du formulaire.
- `function($message)` : Fonction de rappel pour configurer l'email.
- `$message->to('admin@example.com')` : Destinataire de l'email.
- `->subject('Nouveau message via formulaire de contact')` : Objet de l'email.

### Création de la Vue `view_contenu_email.blade.php`

Ajoutez ce fichier dans `resources/views/` :

```php
<!-- resources/views/view_contenu_email.blade.php -->
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h2>Prise de contact</h2>
        <p>Voici les informations reçues :</p>
        <ul>
            <li><strong>Nom</strong> : {{ $nom }}</li>
            <li><strong>Email</strong> : {{ $email }}</li>
            <li><strong>Message</strong> : {{ $texte }}</li>
        </ul>
    </body>
</html>
```

> [!TIP]
>
> - Permet de **structurer** l'email avec du HTML.
> - Facilement **modifiable** sans toucher au code du contrôleur.
> - Assure un **meilleur rendu** sur les clients de messagerie.

## Vue (Confirmation de réception des informations)

Après l'envoi de l'email, l'utilisateur doit être informé du succès de son
action.  
Nous allons créer une **vue de confirmation** qui s'affichera après validation
du formulaire.

### Création de la Vue `view_confirmation.blade.php`

Ajoutez ce fichier dans `resources/views/` :

```php
<!-- resources/views/view_confirmation.blade.php -->
@extends('template_contact')

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading">Information</div>
        <div class="panel-body">Merci, vos informations ont bien été transmises à l'administrateur.</div>
    </div>
</div>
@endsection
```

### Pourquoi afficher une page de confirmation ?

- Évite que l'utilisateur soumette plusieurs fois le formulaire.
- Confirme que l'action a bien été prise en compte.
- Améliore l'**expérience utilisateur**.

## Configuration de l'Envoi d'Email

Il faut compléter le fichier `.env` (qui se trouve à la racine) de l'application
pour que `Laravel` puisse utiliser la messagerie de votre choix. (Dans notre cas
nous utiliserons [mailpit](https://github.com/axllent/mailpit/wiki))

> [!WARNING]
>
> Attention à ne pas laisser ce fichier n'importe où ! (Ex : `Github`)

Modifier ces paramètres dans `.env` :

```txt
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1 # Adresse locale, parce que nous utilisons Mailpit localement
MAIL_PORT=1025 # Port par défaut de Mailpit
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="contact@example.com"
MAIL_FROM_NAME="Laravel App"
```

### Installation et Configuration de Mailpit

- **Mac** :

```bash
# Terminal (n'importe où)
brew tap axllent/apps
brew install mailpit
```

- **Windows** :  
  Téléchargez la version correspondante ici :  
  [https://github.com/axllent/mailpit/releases](https://github.com/axllent/mailpit/releases)

Démarrez Mailpit :

```bash
# Terminal (n'importe où)
mailpit
```

Accessible à `http://localhost:8025`. Allez sur `http://localhost:8025/` pour
voir la boîte mail fictive.

## Récapitulatif

- Création d'un formulaire et affichage des erreurs de validation
- Validation des champs avec `FormRequest`
- Conservation des valeurs après erreur
- Configuration et envoi d'e-mails avec `Mail::send`
- Utilisation de `Mailpit` pour tester l'envoi d'e-mails
- Ajout d'une nouvelle langue pour les messages d'erreur
- Tests unitaires pour vérifier le bon fonctionnement

  **Tout est prêt ! Il ne vous reste plus qu'à tester et expérimenter !**

## Résolution des Erreurs Possibles

### Erreur `View [view_contenu_email] not found`

Si vous rencontrez cette erreur, **vérifiez que le fichier
`view_contenu_email.blade.php` existe bien** dans `resources/views/`.

### Erreur `View [view_confirmation] not found`

Assurez-vous d'avoir bien créé `view_confirmation.blade.php` dans
`resources/views/`.

### Erreur après modification des vues

Laravel met en cache les vues pour améliorer les performances.  
Si une vue ne semble pas être prise en compte, **vide le cache avec ces
commandes** :

```bash
php artisan view:clear
php artisan cache:clear
```

## Testez

Pour tester que la validation des champs fonctionne, il suffit de cliquer sur le
bouton "Envoyer" sans remplir de champs. Sur `http://localhost:8000/contact`,
vous devriez voir les messages d'erreur s'afficher.

Le traitement des informations (envoi du mail et affichage de la confirmation)
ne se fera que lorsque tous les champs seront corrects.

## Ajout d'une Nouvelle Langue pour les Messages d'Erreur

Par défaut, Laravel affiche les messages d'erreur en anglais. Ces messages
proviennent du fichier
`\vendor\laravel\framework\src\Illuminate\Translation\lang\en\validation.php`
Nous allons voir comment ajouter le français.

### Publier les fichiers de langue

Exécutez la commande suivante pour générer les fichiers de traduction dans
`lang/` :

```bash
# Terminal (à la racine du projet)
php artisan lang:publish
```

Cela crée une structure comme celle-ci :

```txt
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
# Terminal (à la racine du projet)
composer require laravel-lang/common --dev
```

Une fois installée, ajoutez la langue française avec :

```bash
# Terminal (à la racine du projet)
php artisan lang:add fr
php artisan lang:update
```

Cela ajoutera le dossier `/fr` dans `lang/` :

```txt
lang/
    fr/
        actions.php
        auth.php
        http-statuses.php
        pagination.php
        passwords.php
        validation.php
    en/
        ...

```

### Modifier le fichier `.env` pour définir le français

Dans le fichier `.env`, changez cette ligne :

```txt
APP_LOCALE=en
```

Par :

```txt
APP_LOCALE=fr
```

### Résultat : Laravel affiche désormais les messages en français

Vous pouvez tester en soumettant un formulaire avec des erreurs et voir les
nouveaux messages en français.
