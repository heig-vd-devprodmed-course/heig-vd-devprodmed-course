<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request; // pas utilisé
use DateTime;

class ArtistesController extends Controller {

    public function afficheArtistes($premiereLettre = false) {
        $artistes = $this->rendArtistes();
        
        // S'il y a une premiere lettre
        if ($premiereLettre) {
            $selectionArtistes = [];
            foreach ($artistes as $artiste) {
                //if (substr($artiste['nom'], 0, 1) === $premiereLettre) {
                if ($artiste['nom'][0] === $premiereLettre) {
					$selectionArtistes[] = $artiste;
                }
            }
        } else {
            // on récupère tous les artistes
            $selectionArtistes = $artistes;
        }
        
        // On transmet les artistes à la vue pour l'affichage
        return view('view_artistes')->with('artistes', $selectionArtistes);
    }
    
    private function rendArtistes() {    
        $artistes = array(
            array(
                "prenom" => "Amy",
                "nom" => "Winehouse",
                "dateNaissance" => new DateTime('14-09-1983')
            ),
            array(
                "prenom" => "Janis",
                "nom" => "Joplin",
                "dateNaissance" => new DateTime('19-01-1943')
            ),
            array(
                "prenom" => "Jo",
                "nom" => "Bar",
                "dateNaissance" => new DateTime('19-01-1943')
            ),
            array(
                "prenom" => "Janis",
                "nom" => "Siegel",
                "dateNaissance" => new DateTime('12-01-1990')
            ));
        return $artistes;
    }
}