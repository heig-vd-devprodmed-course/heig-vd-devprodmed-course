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
				[$heures, $minutes] = explode(':', $dureePause);
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
			[$heures, $minutes, $secondes] = explode(
				' ',
				$deltaT->format('%h %i %s'),
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
						"$deltaTdepuisDebutArrondi seconds",
					),
				); // ne prend pas les virgule !!!!
				$plageDebut = $dtTmp->format('H:i');
				$plagesDebut[] = $plageDebut;
				$dtTmp->add(
					DateInterval::createFromDateString("$deltaTrdvArrondi seconds"),
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
