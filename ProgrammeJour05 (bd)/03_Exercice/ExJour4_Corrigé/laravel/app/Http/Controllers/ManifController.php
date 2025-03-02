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