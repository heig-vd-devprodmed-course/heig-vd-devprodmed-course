# Jour 4

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Scénario](#scénario)
- [Vue Formulaire](#vue-formulaire)
- [Route Formulaire](#route-formulaire)
- [Contrôleur](#contrôleur)
- [Route Traite Formulaire](#route-traite-formulaire)
- [Classe pour validation des champs d'un formulaire](#classe-pour-validation-des-champs-dun-formulaire)
- [Configuration messagerie](#configuration-messagerie)
- [Vue (Contenu Email)](#vue-contenu-email)
- [Vue (Confirmation de réception des informations)](#vue-confirmation-de-réception-des-informations)
- [Ajout d'une nouvelle langue](#ajout-dune-nouvelle-langue)
- [Récupération des anciennes valeurs entrées dans le formulaire](#récupération-des-anciennes-valeurs-entrées-dans-le-formulaire)
- [Résumé des compétences du jour](#résumé-des-compétences-du-jour)

## Objectifs

- Validation de champs de formulaire
- Affichage d'un message d'erreur (si un des champs n'est pas correctement
  rempli)
- Ajout d'une nouvelle langue pour les messages d'erreur
- Récupération des valeurs déjà saisies lors d'erreurs durant la validation d'un
  formulaire
- Envoi de mail

## Scénario

Voici le scénario de ce que nous allons mettre en place.

Le client demande un formulaire. Le serveur retourne le formulaire demandé au
client. Le client remplit le formulaire et le soumet au serveur. Tant que les
champs du formulaire ne sont pas remplis correctement, le serveur retourne le
formulaire avec des messages invitant l'utilisateur à saisir correctement les
informations. Une fois que les champs ont été remplis correctement, le serveur
traite les données reçues. Le serveur envoie ensuite un mail (p.ex. à un
administrateur) avec les données reçues, puis informe l'utilisateur que les
informations qu'il a envoyées ont été traitées.

---

Créons un template (qui utilise Bootstrap pour le rendu graphique)

## Vue Formulaire

Voici le contenu du template ( `template_contact.blade.php` ) :

```php+HTML
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>
            Mon joli formulaire
        </title>
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css">
        <style> textarea {resize:none} </style>
    </head>
    <body>
        @yield('contenu')
    </body>
</html>
```

Et voici la vue basée sur le template ( `view_formulaire_contact.blade.php` )

```php+HTML
@extends('template_contact')

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading">Contactez-moi</div>
        <div class="panel-body">
            <form method="POST" action="{{ url('contact') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group ">
                    <input class="form-control" placeholder="Votre nom" name="nom" type="text">
                    {!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group ">
                    <input class="form-control" placeholder="Votre email" name="email" type="email">
                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group ">
                    <textarea class="form-control" placeholder="Votre message" name="texte" cols="50" rows="10"></textarea>
                    {!! $errors->first('texte', '<small class="help-block">:message</small>') !!}
                </div>
                <input class="btn btn-info pull-right" type="submit" value="Envoyer !">
            </form>
        </div>
    </div>
</div>
@endsection
```

## Route Formulaire

Créons maintenant la route (`get`) `contact` pour obtenir notre formulaire (
`web.php` )

```php
use App\Http\Controllers\ContactController;
//...
Route::get('/contact', [ContactController::class,'rendFormulaire']);
```

## Contrôleur

Puis la méthode `rendFormulaire` dans le contrôleur ( `ContactController.php` )

```php
 public function rendFormulaire() {
	return view('view_formulaire_contact');
 }
```

Voilà qui termine la première étape.

Il nous suffit de compléter l'adresse :

```
http://localhost...    .../contact
```

et de la soumettre à notre navigateur pour obtenir le résultat suivant :

![formulaire](img/formulaire.png)

Il nous reste à construire la partie permettant de traiter les données provenant
du formulaire.

Créons une nouvelle route (post) `contact`

## Route Traite Formulaire

```php
Route::post('/contact', [ContactController::class,'valideEtTraiteFormulaire']);
```

## Classe pour validation des champs d'un formulaire

Avant d'implémenter la méthode `valideEtTraiteFormulaire` nous allons introduire
la nouveauté du jour. Il s'agit d'une classe personnalisée basée sur la classe
`FormRequest`.

Créons cette nouvelle classe qui va contenir le code permettant de valider les
champs du formulaire.

Voici la commande permettant de créer cette classe :

```
php artisan make:request ContactRequest
```

Cette commande nous a créé un nouveau fichier (`ContactRequest.php`) dans le
répertoire `app/Http/Requests/` avec le contenu suivant :

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
```

Modifions ce fichier pour indiquer à `Laravel` que l'utilisateur est autorisé
d'utiliser cette classe (`ContactRequest`) en passant la valeur de retour de la
méthode `authorize()` à `true` et ajoutons les contraintes sur les différents
champs de notre formulaire (méthode `rules()`).

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() {
        return [
            'nom' => 'required|min:3|max:20|alpha_dash',
            'email' => 'required|email',
            'texte' => 'required|max:250'
        ];
    }
}
```

Nous indiquons ici, que le champ `nom` est requis et doit comporter enter 3 et
20 caractères alphanumériques, que `email` est nécessaire et doit être valide et
enfin que le champ `texte`, obligatoire, doit contenir au maximum 250
caractères.

Nous pouvons maintenant ajouter la méthode `valideEtTraiteFormulaire` au
contrôleur : notez au passage le type du paramètre de la méthode ;-) Remarque :
Il faut changer l'adresse email avec la votre dans ce code ci-dessous ;-)

```php
public function valideEtTraiteFormulaire(ContactRequest $request) {

    // Envoi d'un mail
    Mail::send('view_contenu_email', $request->all(), function($message){
		$message->to('uneAdresseMail@unSite.com')->subject('Laravel (Contact)');
         //            ^^^^^^^^^^^^^^^^^^^^^^^^^
         //     mettre l'adresse email du destinataire !!!
    });

    // Confirmation de réception
    return view('view_confirmation');
}
```

Attention à bien ajouter les `use` suivants dans le contrôleur (sans quoi cela
ne fonctionnerait pas !)

```php
use App\Http\Requests\ContactRequest;
use Mail;
```

- `use App\Http\Requests\ContactRequest;` // pour pouvoir utiliser notre
  nouvelle classe de validation
- `use Mail;` // pour pouvoir envoyer un mail

Voici donc le contenu de notre contrôleur ( `ContactController` ) :

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Mail;

class ContactController extends Controller {

    public function rendFormulaire() {
		return view('view_formulaire_contact');
	}

    public function valideEtTraiteFormulaire(ContactRequest $request) {

    	// Envoi d'un mail
    	Mail::send('view_contenu_email', $request->all(), function($message){
			$message->to('uneAdresseMail@unSite.com')->subject('Laravel (Contact)');
             //            ^^^^^^^^^^^^^^^^^^^^^^^^^
             //     mettre l'adresse email du destinataire !!!
   	 	});

        // Confirmation de réception
        return view('view_confirmation');
	}
}
```

La méthode `valideEtTraiteFormulaire` va récupérer les données du formulaire
grâce à `$request` et les envoyer toutes `$request->all()` à la vue
`view_contenu_email`

## Configuration messagerie

Pour que l'envoi d' e-mail fonctionne, il faut que `Laravel` soit configuré
correctement.

Il faut compléter le fichier `.env` (qui se trouve à la racine) de l'application
pour que `Laravel` puisse utiliser la messagerie de votre choix. (Dans notre cas
nous utiliserons [mailpit](https://github.com/axllent/mailpit/wiki))

> Remarque importante :
>
> Attention à ne pas laisser ce fichier n'importe où ! (Ex : `Github`)

Nous allons changer les lignes suivantes (~ligne 31) :

```
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

```

en :

```php

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="monServeurMail@monSuperSite.ch"
MAIL_FROM_NAME="${APP_NAME}"

```

Maintenant que nous avons configuré `laravel` pour l'utilisation du serveur
`smtp mailpit`, il nous faut télécharger et lancer le serveur de messagerie
`mailpit`.

> Pour l'installation sur `mac` nous utiliserons `homebrew` :
>
> ```
> brew tap axllent/apps
> brew install mailpit
> ```

> Pour l'installation sur `windows`, il suffit de télécharger le fichier
> correspondant processeur de l'ordinateur à l'adresse suivante :
> [download mailpit](https://github.com/axllent/mailpit/releases/tag/v1.4.0)
>
> [windows amd64](https://github.com/axllent/mailpit/releases/download/v1.4.0/mailpit-windows-amd64.zip) >
> [windows arm64](https://github.com/axllent/mailpit/releases/download/v1.4.0/mailpit-windows-arm64.zip)

Une fois que le serveur est installé, il suffit de le démarrer en ligne de
commande (ou terminal) :

```
mailpit
```

![mailpit](img\mailpit.png)

> Le serveur `smtp` est disponible sur `localhost:1025` c.f. configuration du
> fichier `.env`
>
> ```
> MAIL_HOST=127.0.0.1
> MAIL_PORT=1025
> ```

Pour consulter les mails reçus nous irons sur le serveur `http` disponible sur
`localhost:8025`

---

Il ne nous reste plus qu'à construire :

- une vue pour le contenu de l'e-mail,
- une vue pour informer le client que les données ont bien été traitées.

## Vue (Contenu Email)

Commençons par la vue destinée au contenu de l'e-mail
(`view_contenu_email.blade.php`) :

```php+HTML
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h2>Prise de contact</h2>
        <p>Voici les informations reçues :</p>
        <ul>
            <li><strong>Nom</strong> : {{$nom}}</li>
            <li><strong>Email</strong> : {{$email}}</li>
            <li><strong>Message</strong> : {{$texte}}</li>
        </ul>
    </body>
</html>
```

## Vue (Confirmation de réception des informations)

Créons maintenant la vue de confirmation de réception des informations
(`view_confirmation.blade.php`)

```php+HTML
@extends('template_contact')

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading">Information</div>
        <div class="panel-body">Merci, vos informations ont bien été transmises à l'administrateur</div>
    </div>
</div>
@endsection

```

Nous avons terminé l'implémentation. Il ne nous reste plus qu'à tester le tout.

```
localhost:8000/contact
```

Pour tester que la validation des champs fonctionne, il suffit de cliquer sur le
bouton "Envoyer" sans remplir de champs.

Le traitement des informations (envoi du mail et affichage de la confirmation)
ne se fera que lorsque tous les champs seront corrects.

> Remarque : Si une erreur survient lors de l'envoi du mail, tapez les commandes
> suivantes en ligne de commande puis réessayez.
>
> ```
> php artisan route:clear
> php artisan config:cache
> ```

## Ajout d'une nouvelle langue

Ce que nous pouvons observer, c'est que les messages d'erreurs retournés par
`Laravel` sont en anglais.

Ces messages proviennent du fichier
`\vendor\laravel\framework\src\Illuminate\Translation\lang\en\validation.php`

Nous allons voir maintenant comment ajouter une nouvelle langue pour avoir des
messages d'erreurs en français `\lang\fr\...`

Pour simplifier la gestion d'une nouvelle langue nous allons créer un nouveau
répertoire `\lang` dans notre application et y copier les fichiers contenant les
messages (dont le fichier `validation.php`). Le tout se fait à l'aide de la
commande :

```
php artisan lang:publish
```

Nous avons maintenant un nouveau dossier `/lang` dans le répertoire `laravel`
avec la structure suivante :

```
/lang
    /en
        auth.php
        pagination.php
        passwords.php
        validation.php
```

Pour ajouter une nouvelle langue, nous allons ajouter une librairie de gestion
des langues à notre application
[laravel-lang](https://packagist.org/packages/laravel-lang/lang)

L'installation de cette librairie se fait en ligne de commande (dans le
répertoire `\laravel` de notre application)

```
composer require laravel-lang/common --dev
```

> Veuillez patienter durant la génération du fichier autoload

Nous pouvons maintenant ajouter une nouvelle langue à notre application

```
php artisan lang:add fr
php artisan lang:update
```

Nous disposons maintenant d'un répertoire `/fr` (ainsi que de quelques fichiers
supplémentaire) dans le dossier `/lang`

```
/lang
    /en
        actions.php
        auth.php
        http-statuses.php
        pagination.php
        passwords.php
        validation.php
     /fr
        actions.php
     	auth.php
        http-statuses.php
        pagination.php
        passwords.php
        validation.php
     en.json
     fr.json

```

Maintenant que les fichiers contenant les messages en français sont disponibles,
il faut indiquer à `Laravel` la langue à utiliser

Toujours dans le fichier `.env` (à la racine de notre application) :

Modifions la ligne ~8

```
APP_LOCALE=en
```

en

```
APP_LOCALE=fr
```

Notre application affiche désormais les messages en français.
:slightly_smiling_face:

![frValidation](img\frValidation.png)

## Récupération des anciennes valeurs entrées dans le formulaire

Pour l'instant, si un ou plusieurs champs sont correctement rempli mais qu'il
subsiste une erreur de saisie dans le formulaire, nous perdons les informations
entrées. `Laravel` possède une solution pour récupérer les anciennes valeurs
saisies à l'aide de : `old('nom_du_champ_du_formulaire')`

Voici une nouvelle version de la vue `view_formulaire_contact.blade.php`

```html
@extends('template_contact') @section('contenu')
<br />
<div class="col-sm-offset-3 col-sm-6">
	<div class="panel panel-info">
		<div class="panel-heading">Contactez-moi</div>
		<div class="panel-body">
			<form method="POST" action="{{ url('contact') }}" accept-charset="UTF-8">
				@csrf
				<div class="form-group ">
					<input
						class="form-control"
						placeholder="Votre nom"
						name="nom"
						type="text"
						value="{{old('nom')}}"
					/>
					{!! $errors->first('nom', '<small class="help-block">:message</small
					>') !!}
				</div>
				<div class="form-group ">
					<input
						class="form-control"
						placeholder="Votre email"
						name="email"
						type="email"
						value="{{old('email')}}"
					/>
					{!! $errors->first('email', '<small class="help-block">:message</small
					>') !!}
				</div>
				<div class="form-group ">
					<textarea
						class="form-control"
						placeholder="Votre message"
						name="texte"
						cols="50"
						rows="10"
					>
{{old('texte')}}</textarea
					>
					{!! $errors->first('texte', '<small class="help-block">:message</small
					>') !!}
				</div>
				<input
					class="btn btn-info pull-right"
					type="submit"
					value="Envoyer !"
				/>
			</form>
		</div>
	</div>
</div>
@endsection
```

Notre formulaire récupère maintenant les anciennes valeurs des champs saisis au
cas où un des champs ne contient pas ce qui est attendu.

## Résumé des compétences du jour

- Nous savons comment valider les champs d'un formulaire
  [Validateur de champ de formulaire](https://laravel.com/docs/11.x/validation#creating-form-requests)
  [Liste des règles de validation](https://laravel.com/docs/11.x/validation#available-validation-rules)
- Nous savons comment afficher des messages d'erreurs (dans la langue de notre
  choix)
- Nous savons comment récupérer les anciennes valeurs d'un formulaire si la
  validation ne s'est pas bien passée.
- Nous savons comment envoyer des e-mails.
