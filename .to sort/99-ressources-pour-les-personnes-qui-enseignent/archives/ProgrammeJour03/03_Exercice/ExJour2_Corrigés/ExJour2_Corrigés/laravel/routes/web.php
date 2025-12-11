<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistesController;
use App\Http\Controllers\ProverbesController;

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

Route::get('/', function () {
	return view('welcome');
});

Route::get('artistes/{premiereLettre?}', [
	ArtistesController::class,
	'afficheArtistes',
])->where(['premiereLettre' => '[a-zA-Z]']);

Route::get('proverbesV1', [
	ProverbesController::class,
	'afficheDixProverbesV1',
]);
Route::get('proverbesV2', [
	ProverbesController::class,
	'afficheDixProverbesV2',
]);
