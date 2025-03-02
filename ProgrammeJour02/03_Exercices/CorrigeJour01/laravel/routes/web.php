<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/livret/{n}', function ($n) {
    for ($mult = 1; $mult <= 12; $mult++) {
    	echo $mult . ' * ' . $n . ' = ' . $mult * $n, '<br>';
	}
})->where(['n' => '[2-9]|1[0-2]']);

Route::get('/livretVue/{n}', function ($n) {
    return view('livret')->with("n",$n);
})->where(['n' => '[2-9]|1[0-2]']);

Route::get('/livretVueBlade/{n}', function ($n) {
    return view('livretb')->with("n",$n);
})->where(['n' => '[2-9]|1[0-2]']);

Route::get('cff/{dep}/{hm}/{arr}/{strDate?}', function ($dep, $hm, $arr, $strDate = 0) {
	if ($strDate) {
        // Il est impératif que la date soit sur 10 caractères 
        // Ex1 : 31.01.2020
        // Ex2 : 01.02.2020
        // Le caractère de séparation (.) n'a pas d'importance
        if (strlen($strDate) == 10) {
            $jour = substr($strDate, 0, 2);
            $mois = substr($strDate, 3, 2);
            $annee = substr($strDate, 6, 4);
            if (!checkdate($mois, $jour, $annee)) {
                $strDate = 0;
            }
        } else {
            $strDate = 0;
        }
    }
    if (!$strDate) {
        $date = new DateTime();
        $strDate = $date->format("d.m.Y");
    } else {
		$strDate = $jour . "." . $mois . "." . $annee;
	}
    return redirect('https://www.sbb.ch/fr/acheter/pages/fahrplan/fahrplan.xhtml?' .
            'von=' . $dep .
            '&nach=' . $arr .
            '&datum=' . $strDate .
            '&zeit=' . $hm . '&suche=true');
});