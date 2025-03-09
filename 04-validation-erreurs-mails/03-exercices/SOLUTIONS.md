# Formulaire : Exercices et solutions

## Table des matières

- [Table des matières](#table-des-matières)
- [Nouvelle solution](#nouvelle-solution)
  - [Créer le formulaire de base](#créer-le-formulaire-de-base)
  - [Déclarer la route](#déclarer-la-route)
  - [Créer le contrôleur](#créer-le-contrôleur)
  - [Créer la validation avec `FormRequest`](#créer-la-validation-avec-formrequest)
  - [Créer la règle personnalisée](#créer-la-règle-personnalisée)
  - [Créer l'email et la confirmation](#créer-lemail-et-la-confirmation)
- [Ancienne solution](#ancienne-solution)
  - [Routes (`web.php`)](#routes-webphp)
  - [Contrôleur (`ManifController.php`)](#contrôleur-manifcontrollerphp)
  - [Validateur de formulaire (`ManifRequest.php`)](#validateur-de-formulaire-manifrequestphp)
  - [Validateur de champs personnalisé (`ManifRuleV10.php`) Laravel v.10](#validateur-de-champs-personnalisé-manifrulev10php-laravel-v10)
  - [Message(s) customisé(s)](#messages-customisés)
  - [Template + Vues](#template--vues)

## Nouvelle solution

### Créer le formulaire de base

Ajoutez une vue `resources/views/form_manifestation.blade.php` :

```php
<!-- resources/views/form_manifestation.blade.php -->
@extends('template_contact')

@section('contenu')
<br>
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-header bg-info text-white">Nouvelle Manifestation</div>
        <div class="card-body">
            <form method="POST" action="{{ url('manifestation') }}">
                @csrf
                <div class="mb-3">
                    <label>Date de début :</label>
                    <input class="form-control {{ $errors->has('date_debut') ? 'is-invalid' : '' }}"
                           type="date" name="date_debut" value="{{ old('date_debut') }}">
                    {!! $errors->first('date_debut', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="mb-3">
                    <label>Date de fin :</label>
                    <input class="form-control {{ $errors->has('date_fin') ? 'is-invalid' : '' }}"
                           type="date" name="date_fin" value="{{ old('date_fin') }}">
                    {!! $errors->first('date_fin', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="mb-3">
                    <label>Lieu :</label>
                    <input class="form-control {{ $errors->has('lieu') ? 'is-invalid' : '' }}"
                           type="text" name="lieu" value="{{ old('lieu') }}">
                    {!! $errors->first('lieu', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <button class="btn btn-info float-end" type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</div>
@endsection
```

### Déclarer la route

Ajoutez dans `routes/web.php` :

```php
// routes/web.php
use App\Http\Controllers\ManifestationController;

Route::get('/manifestation', [ManifestationController::class, 'create']);
Route::post('/manifestation', [ManifestationController::class, 'store']);
```

### Créer le contrôleur

Ajoutez le contrôleur avec :

```bash
# Terminal (dans le dossier de votre projet)
php artisan make:controller ManifestationController
```

Puis dans `app/Http/Controllers/ManifestationController.php` :

```php
// app/Http/Controllers/ManifestationController.php
namespace App\Http\Controllers;

use App\Http\Requests\ManifestationRequest;
use Illuminate\Support\Facades\Mail;

class ManifestationController extends Controller {
    public function create() {
        return view('form_manifestation');
    }

    public function store(ManifestationRequest $request) {
        $data = $request->validated();

        // Envoi du mail
        Mail::send('email_manifestation', $data, function ($message) {
            $message->to('responsable@example.com')->subject('Nouvelle Manifestation');
        });

        return view('confirmation_manifestation');
    }
}
```

### Créer la validation avec `FormRequest`

Générez une **classe de validation** avec :

```bash
# Terminal (dans le dossier de votre projet)
php artisan make:request ManifestationRequest
```

Modifiez `app/Http/Requests/ManifestationRequest.php` :

```php
// app/Http/Requests/ManifestationRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManifestationRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'date_debut' => ['required', 'date', 'after:today'],
            'date_fin' => ['required', 'date', 'after:date_debut', new \App\Rules\DureeManifestation],
            'lieu' => ['required', 'regex:/^[A-Z][a-z]{2,}$/']
        ];
    }
}
```

### Créer la règle personnalisée

Générez une règle personnalisée pour valider la durée avec :

```bash
# Terminal (dans le dossier de votre projet)
php artisan make:rule DureeManifestation
```

Modifiez `app/Rules/DureeManifestation.php` :

```php
// app/Rules/DureeManifestation.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class DureeManifestation implements Rule {
    public function passes($attribute, $value): bool {
        $dateDebut = request()->input('date_debut');
        if (!$dateDebut) return false;

        $debut = Carbon::parse($dateDebut);
        $fin = Carbon::parse($value);
        $diff = $debut->diffInDays($fin);

        return $diff >= 3 && $diff <= 5;
    }

    public function message(): string {
        return "La manifestation doit durer entre 3 et 5 jours.";
    }
}
```

### Créer l'email et la confirmation

Dans `resources/views/email_manifestation.blade.php` :

```php
<!-- resources/views/email_manifestation.blade.php -->
<!doctype html>
<html lang='fr'>
<head><meta charset="UTF-8"></head>
<body>
    <p>La prochaine manifestation aura lieu du :</p>
    <p><strong>{{ $date_debut }} au {{ $date_fin }} à {{ $lieu }}.</strong></p>
    <p>Avec nos meilleures salutations.</p>
    <p>Le comité.</p>
</body>
</html>
```

Dans `resources/views/confirmation_manifestation.blade.php` :

```php
@extends('template_contact')

@section('contenu')
<br>
<div class="alert alert-success">
    Merci. Votre message concernant la prochaine manifestation a été envoyé au responsable.
</div>
@endsection
```

## Ancienne solution

### Routes (`web.php`)

```php
use App\Http\Controllers\ManifController;
//...
Route::get('/manif', [ManifController::class,'rendFormManif']);
Route::post('/manif', [ManifController::class,'traiteFormManif']);
```

### Contrôleur (`ManifController.php`)

```bash
# Terminal (dans le dossier de votre projet)
php artisan make:controller ManifController
```

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManifRequest;
//use App\Rules\ManifRule;
use App\Rules\ManifRuleV10;
use Mail;

class ManifController extends Controller {

    public function rendFormManif() {
        return view('view_manif_form');
    }

    public function traiteFormManif(ManifRequest $request) {

		$request->validate(['fin' => [new ManifRuleV10($request->debut)]]);
		//$request->validate(['fin' => new ManifRule($request->debut)]);

		// Envoi d'un mail
		Mail::send('view_manif_mail', $request->all(), function($message){
			$message->to('admin@supermanif.ch')->subject('Prochaine manifestation');
        });

        return view('view_manif_confirm');
    }
}
```

### Validateur de formulaire (`ManifRequest.php`)

```bash
# Terminal (dans le dossier de votre projet)
php artisan make:request ManifRequest
```

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManifRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'debut' => 'required|after_or_equal:tomorrow',
            'fin' => 'required|after:debut',
            'lieu' => 'required|min:3|regex:[^[A-Z].*]'
        ];
    }
}
```

### Validateur de champs personnalisé (`ManifRuleV10.php`) Laravel v.10

```bash
# Terminal (dans le dossier de votre projet)
php artisan make:rule ManifRule
```

`\laravel\app\Rules\ManifRulesV10.php`

```php
<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ManifRuleV10 implements ValidationRule
{

	protected $debut;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($debut) {
		//dd("yes !");
        $this->debut = $debut;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         //dd($attribute);
         //dd($value);
		$value = date('Y-m-d', strtotime($value));
         $dateAuMinimum = date('Y-m-d', strtotime($this->debut . ' + 3 days'));
         $dateAuMaximum = date('Y-m-d', strtotime($this->debut . ' + 5 days'));
		if (!($value >= $dateAuMinimum && $value <= $dateAuMaximum)) {
		   // va chercher le message correspondant à `wongperiod`
            // dans le fichier \lang\en\validation2.php
            // ou              \lang\fr\validation2.php
            // en fonction de la langue configurée dans \config\app.php
            $fail(__('validation2.wrongperiod')); // https://laravel.com/docs/11.x/localization
		}
    }
}
```

> ### Validateur de champs personnalisé (`ManifRule.php`) avant la version 10
>
> ```bash
> # Terminal (dans le dossier de votre projet)
> php artisan make:rule ManifRule
> ```
>
> `\laravel\app\Rules\ManifRules.php`
>
> ```php
> <?php
>
> namespace App\Rules;
>
> use Illuminate\Contracts\Validation\Rule;
>
> class ManifRule implements Rule {
>
>     protected $debut;
>
>     /**
>      * Create a new rule instance.
>      *
>      * @return void
>      */
>     public function __construct($debut) {
>         $this->debut = $debut;
>     }
>
>     /**
>      * Determine if the validation rule passes.
>      *
>      * @param  string  $attribute
>      * @param  mixed  $value
>      * @return bool
>      */
>     public function passes($attribute, $value) {
>         $value = date('Y-m-d', strtotime($value));
>         $dateAuMinimum = date('Y-m-d', strtotime($this->debut . ' + 3 days'));
>         $dateAuMaximum = date('Y-m-d', strtotime($this->debut . ' + 5 days'));
>         return $value >= $dateAuMinimum && $value <= $dateAuMaximum;
>     }
>
>     /**
>      * Get the validation error message.
>      *
>      * @return string
>      */
>     public function message() {
>         // va chercher le message correspondant à `wongperiod`
>         // dans le fichier \lang\en\validation2.php
>         // ou              \lang\fr\validation2.php
>         // en fonction de la langue configurée dans \config\app.php
>         return __('validation2.wrongperiod'); // https://laravel.com/docs/11.x/localization
>     }
> }
> ```

### Message(s) customisé(s)

`\lang\en\validation2.php`

```php
<?php

return [
    'wrongperiod' => 'The event must last at least 3 days and at most 5 days.',
];
```

`\lang\fr\validation2.php`

```php
<?php

return [
    'wrongperiod' => 'La manifestation doit durer au moins 3 jours et au maximum 5 jours.',
];
```

### Template + Vues

`template.blade.php`

```html
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width" />
		<title>Mon joli formulaire</title>
		<link
			media="all"
			type="text/css"
			rel="stylesheet"
			href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
		/>
		<link
			media="all"
			type="text/css"
			rel="stylesheet"
			href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
		/>
		<style>
			textarea {
				resize: none;
			}
		</style>
	</head>
	<body>
		@yield('contenu')
	</body>
</html>
```

`view_manif_form.blade.php`

```php+HTML
@extends('template')

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading">Quand et où aura lieu la prochaine manifestation : </div>
        <div class="panel-body">
            <form method="POST" action="{{ url('manif') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group {!! $errors->has('debut') ? 'has-error' : '' !!}">
                    <label for="lbDebut">Date du d&eacute;but </label>
                    <input class="form-control" name="debut" type="date" value="{{old('debut')}}">
                    {!! $errors->first('debut', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('fin') ? 'has-error' : '' !!}">
                    <label for="lbFin">Date de fin </label>
                    <input class="form-control" name="fin" type="date" value="{{old('fin')}}">
                    {!! $errors->first('fin', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('lieu') ? 'has-error' : '' !!}">
                    <label for="lbLieu">Lieu </label>
                    <input class="form-control" name="lieu" type="text" value="{{old('lieu')}}">
                    {!! $errors->first('lieu', '<small class="help-block">:message</small>') !!}
                </div>
                <input class="btn btn-info pull-right" type="submit" value="Envoyer !">
            </form>
        </div>
    </div>
</div>
@endsection
```

`view_manif_mail.blade.php`

```html
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h2>Manifestation</h2>
		<p>
			La prochaine manifestation aura lieu du {{date('d.m.Y',
			strtotime($debut))}} au {{date('d.m.Y', strtotime($fin))}} à {{$lieu}}.
		</p>
		<p>Avec nos meilleures salutations.</p>
		<p>Le comité</p>
	</body>
</html>
```

`view_manif_confirm.blade.php`

```php+HTML
@extends('template')

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading">Information</div>
        <div class="panel-body"> Merci. Votre message concernant la manifestation a été tansmis à l'admin</div>
    </div>
</div>
@endsection
```

Pour contrôler les mails qui ont été envoyés il suffit d'aller consulter le
serveur mail `Mailpit` à l'aide d'un navigateur à l'adresse : `localhost:8025`
