# Corrigé Exercice (Agenda)

## Fichier : `\storage\app\personnes.txt`

```
Baur Ophélie
Benkais Leyla
Boumasmoud Yousra
Bourqui Jeremy
Crettaz Kilian
Fourel Nathan
Kanga Andy
Lam Larry
Luyet Jessica
Mertenat Martin
Mettraux Steve
Najjar Louka
Paiva Oliveira Kevin
Perroset Jade
Pouly Laurie
Robert Thomas
Rodriguez Alan
Roulet Alexandre
Ruffieux Mikaël
Schaller Camille
Urfer Lionel
Vestergaard Mikkel
Wagnières Sébastien
Walpen Alison
Zerika Karim
Zweifel Nathan
Zweifel Robin
```

## Routes `\routes\web.php`

```php
use App\Http\Controllers\AgendaController;

...

Route::get('/agenda', [AgendaController::class,'afficheFormulaire']);
Route::post('/agenda', [AgendaController::class,'traiteFormulaire']);
```

> Remarque : N'oubliez pas le `use` pour la classe `AgendaController` (qui
> n'existe encore pas ;-)

## Contrôleur `\app\Http\Controllers\AgendaController.php`

(Créé avec la commande `php artisan ...` adéquate)

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateInterval;

class AgendaController extends Controller
{
	private function rendListePersonnes()
	{
		$path = storage_path('app' . DIRECTORY_SEPARATOR . 'personnes.txt');
		$personnes = file($path);
		return $personnes;
	}

	public function afficheFormulaire()
	{
		$personnes = $this->rendListePersonnes();
		return view('view_form_checkbox')->with('personnes', $personnes);
	}

	public function traiteFormulaire(Request $request)
	{
		if (
			$request->input('personnes') !== null &&
			$request->input('heureDebut') !== null &&
			$request->input('heureFin') != null
		) {
			$personnes = $request->input('personnes');
			$debut = $request->input('heureDebut');
			$fin = $request->input('heureFin');
			$dureePause = $request->input('dureePause');
			if ($dureePause !== null) {
				list($heures, $minutes) = explode(':', $dureePause);
				$deltaTsecPause = $heures * 3600 + $minutes * 60;
			} else {
				$deltaTsecPause = 0;
			}

			$plages = [];
			$plages[] = count($personnes);
			// calcul du nombre de secondes total entre $debut et $fin
			$dtDebut = new DateTime($debut);
			$dtFin = new DateTime($fin);
			if ($dtDebut > $dtFin) {
				$dtTmp = $dtFin;
				$dtFin = $dtDebut;
				$dtDebut = $dtFin;
				$tmp = $fin;
				$fin = $debut;
				$debut = $tmp;
			}
			$deltaT = $dtFin->diff($dtDebut); //Retourne un intervalle !
			// echo $deltaT->format('%h %i %s'),'<br>';
			list($heures, $minutes, $secondes) = explode(
				' ',
				$deltaT->format('%h %i %s')
			); // Format pour objet DateInterval
			$deltaTsec = $heures * 3600 + $minutes * 60 + $secondes;
			$nbPersonnes = count($personnes);
			$deltaTrdv =
				($deltaTsec - $deltaTsecPause * ($nbPersonnes - 1)) / $nbPersonnes; // Le temps en seconde de chaque rdv
			$deltaTrdvArrondi = round($deltaTrdv);

			shuffle($personnes); // on mélange les noms
			$plagesDebut = [];
			$plagesFin = [];
			for ($i = 0; $i < $nbPersonnes; $i++) {
				$dtTmp = new DateTime($debut); // Pour ne pas cumuler les erreurs de virgules on repart du début
				$deltaTdepuisDebut = $i * ($deltaTrdv + $deltaTsecPause);
				$deltaTdepuisDebutArrondi = round($deltaTdepuisDebut);
				$dtTmp->add(
					DateInterval::createFromDateString(
						"$deltaTdepuisDebutArrondi seconds"
					)
				); // ne prend pas les virgule !!!!
				$plageDebut = $dtTmp->format('H:i');
				$plagesDebut[] = $plageDebut;
				$dtTmp->add(
					DateInterval::createFromDateString("$deltaTrdvArrondi seconds")
				);
				$plageFin = $dtTmp->format('H:i');
				$plagesFin[] = $plageFin;
			}
		} else {
			return redirect('agenda');
		}
		return view('view_affiche_agenda')->with([
			'personnes' => $personnes,
			'plagesDebut' => $plagesDebut,
			'plagesFin' => $plagesFin,
		]);
	}
}
```

## Template `\resources\views\template.blade.php`

```php+HTML
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width" initial-scale="1">
        <title>
            @yield('titre')
        </title>
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <style> textarea {resize:none} </style>
    </head>
    <body>
        @yield('contenu')
    </body>
</html>
```

## Vue Formulaire `\resources\views\view_form_checkbox.blade.php`

```php+HTML
@extends('template')

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div>
            Veuillez choisir les personnes concernées par les entrevues :
        </div>
        <form method="POST" action="{{ url('agenda') }}" accept-charset="UTF-8">
            @csrf
            @foreach ($personnes as $personne)
            <input name="personnes[]" type="checkbox" value="{{$personne}}"> {{$personne}}
            <br>
            @endforeach
            <div>
                <label for="heureDebut">Entrez une heure de d&eacute;but : </label>
                <input name="heureDebut" type="time" id="heureDebut">
            </div>
            <div>
                <label for="heureFin">Entrez une heure de fin : </label>
                <input name="heureFin" type="time" id="heureFin">
            </div>
            <div>
                <label for="pause">Entrez un temps de pause : </label>
                <input name="dureePause" type="time">
            </div>
            <div>
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</div>
@endsection
```

## Vue Agenda `\resources\views\view_affiche_agenda.blade.php`

```php+HTML
@extends('template')

@section('titre')
Agenda (Exercice Jour 3)
@endsection

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading"> Agenda des rdv : </div><br>
        <div class="panel-body">
            <table width=80%>
                <th width=65%>Personnes</th>
                <th width=15%>Debut</th>
                <th width=5%></th>
                <th width=15%>Fin</th>
                @for ($i = 0; $i < count($personnes); $i++)
                <tr>
                    <td>{{$personnes[$i]}}</td>
                    <td>{{$plagesDebut[$i]}}</td>
                    <td>-</td>
                    <td>{{$plagesFin[$i]}}</td>
                </tr>
                @endfor
            </table>
        </div>
    </div>
</div>
@endsection
```
