# Corrigé ExerciceJour4 (Manifestation) :

## Config Mail (`.env`)

Puis lancer le serveur mail `mailpit`
[source](https://github.com/axllent/mailpit)

Une fois que le serveur mail est lancé (sur localhost), nous pouvons configurer
le fichier `.env`

```none
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=laravel@laravel_heig.ch
MAIL_FROM_NAME="${APP_NAME}"
```

## Routes (`web.php`) :

```php
use App\Http\Controllers\ManifController;
//...
Route::get('manif', [ManifController::class, 'rendFormManif']);
Route::post('manif', [ManifController::class, 'traiteFormManif']);
```

## Contrôleur (`ManifController.php`) :

```
php artisan make:controller ManifController
```

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManifRequest;
//use App\Rules\ManifRule;
use App\Rules\ManifRuleV10;
use Mail;

class ManifController extends Controller
{
	public function rendFormManif()
	{
		return view('view_manif_form');
	}

	public function traiteFormManif(ManifRequest $request)
	{
		$request->validate(['fin' => [new ManifRuleV10($request->debut)]]);
		//$request->validate(['fin' => new ManifRule($request->debut)]);

		// Envoi d'un mail
		Mail::send('view_manif_mail', $request->all(), function ($message) {
			$message->to('admin@supermanif.ch')->subject('Prochaine manifestation');
		});

		return view('view_manif_confirm');
	}
}
```

## Validateur de formulaire (`ManifRequest.php`) :

```
php artisan make:request ManifRequest
```

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManifRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'debut' => 'required|after_or_equal:tomorrow',
			'fin' => 'required|after:debut',
			'lieu' => 'required|min:3|regex:[^[A-Z].*]',
		];
	}
}
```

## Validateur de champs personnalisé (`ManifRuleV10.php`) Laravel v.10

```
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
	public function __construct($debut)
	{
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

> ## Validateur de champs personnalisé (`ManifRule.php`) avant la version 10
>
> ```
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
> class ManifRule implements Rule
> {
> 	protected $debut;
>
> 	/**
> 	 * Create a new rule instance.
> 	 *
> 	 * @return void
> 	 */
> 	public function __construct($debut)
> 	{
> 		$this->debut = $debut;
> 	}
>
> 	/**
> 	 * Determine if the validation rule passes.
> 	 *
> 	 * @param  string  $attribute
> 	 * @param  mixed  $value
> 	 * @return bool
> 	 */
> 	public function passes($attribute, $value)
> 	{
> 		$value = date('Y-m-d', strtotime($value));
> 		$dateAuMinimum = date('Y-m-d', strtotime($this->debut . ' + 3 days'));
> 		$dateAuMaximum = date('Y-m-d', strtotime($this->debut . ' + 5 days'));
> 		return $value >= $dateAuMinimum && $value <= $dateAuMaximum;
> 	}
>
> 	/**
> 	 * Get the validation error message.
> 	 *
> 	 * @return string
> 	 */
> 	public function message()
> 	{
> 		// va chercher le message correspondant à `wongperiod`
> 		// dans le fichier \lang\en\validation2.php
> 		// ou              \lang\fr\validation2.php
> 		// en fonction de la langue configurée dans \config\app.php
> 		return __('validation2.wrongperiod'); // https://laravel.com/docs/11.x/localization
> 	}
> }
> ```

## Message(s) customisé(s)

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
	'wrongperiod' =>
		'La manifestation doit durer au moins 3 jours et au maximum 5 jours.',
];
```

## Template + Vues

`template.blade.php`

```html
<!doctype html>
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
<!doctype html>
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
