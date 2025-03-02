<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoitureRequest;
use App\Models\Voiture;

class VoitureController extends Controller
{
    public function rendFormulaire() {
        return view('view_rend_formulaire_voiture');
    }
	
	public function traiteFormulaire(VoitureRequest $request) {
    
        $unModeleVoiture = new Voiture;
        $unModeleVoiture->marque = $request->input('marque');
        $unModeleVoiture->type = $request->input('type');
        $unModeleVoiture->couleur = $request->input('couleur');
        $unModeleVoiture->cylindree = $request->input('cylindree');
        $unModeleVoiture->save();
    
        return view('view_confirmation_voiture');
    }
}
