# Blade et contrôleur - Exercices et solutions

## Table des matières

- [Table des matières](#table-des-matières)
- [Exercice 1 - Donnée](#exercice-1---donnée)
- [Exercice 1 - Solution](#exercice-1---solution)
  - [Création d'une nouvelle app](#création-dune-nouvelle-app)
  - [Contrôleur](#contrôleur)
  - [Route](#route)
  - [Vue](#vue)
- [Exercice 2 - Donnée](#exercice-2---donnée)
  - [Route](#route-1)
  - [Contrôleur](#contrôleur-1)
  - [Vue](#vue-1)
  - [Structuration du code](#structuration-du-code)
  - [Contrôleur V2](#contrôleur-v2)
  - [Route V2](#route-v2)
  - [Vue V2](#vue-v2)

## Exercice 1 - Donnée

Reprendre le code du contrôleur permettant d'afficher le tableau
multidimensionnel (Voir : `02-blade-controleur-support-de-cours`) et le modifier
pour pouvoir n'afficher que les artistes commençant par une lettre définie.

```bash
Ex : .../artistes/j		: n'affiche que les artistes dont le nom commence par J
```

## Exercice 1 - Solution

### Création d'une nouvelle app

```bash
# Terminal (dans le dossier où vous voulez créer votre app)
laravel new ExercicesJour2/laravel
```

Se mettre dans le dossier `\laravel` pour contrôler que tout fonctionne

```bash
# Terminal (dans le dossier \laravel)
php artisan serve
```

Lancer un navigateur web sur l'url : `localhost:8000`

Le serveur devrait répondre et le navigateur devrait afficher la page de
bienvenue (vue `welcome`)

### Contrôleur

Nous allons maintenant crée un contrôleur pour y placer la logique permettant de
récupérer les artistes commençant par la lettre du choix de l'utilisateur.

Pour créer un contrôleur, on passe par la ligne de commande. (Toujours se mettre
dans le dossier où se trouve notre app `...\laravel`)

```bash
# Terminal (dans le dossier \laravel)
php artisan make:controller ArtistesController
```

La commande a généré un fichier `ArtistesController.php` dans le répertoire

`\app\Http\Controllers\ArtistesController.php`

Nous allons maintenant éditer ce fichier et y ajouter la logique

(Contenu du fichier `\app\Http\Controllers\ArtistesController.php`)

```php
<!-- app/Http/Controllers/ArtistesController.php -->
<?php namespace App\Http\Controllers;

// use Illuminate\Http\Request; // pas encore utilisé
use DateTime;

class ArtistesController extends Controller
{
	public function afficheArtistes($premiereLettre = false)
	{
		$artistes = $this->rendArtistes();

		// S'il y a une premiere lettre
		if ($premiereLettre) {
			$selectionArtistes = [];
			foreach ($artistes as $artiste) {
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

	private function rendArtistes()
	{
		$artistes = [
			[
				'prenom' => 'Amy',
				'nom' => 'Winehouse',
				'dateNaissance' => new DateTime('14-09-1983'),
			],
			[
				'prenom' => 'Janis',
				'nom' => 'Joplin',
				'dateNaissance' => new DateTime('19-01-1943'),
			],
			[
				'prenom' => 'Jo',
				'nom' => 'Bar',
				'dateNaissance' => new DateTime('19-01-1943'),
			],
			[
				'prenom' => 'Janis',
				'nom' => 'Siegel',
				'dateNaissance' => new DateTime('12-01-1990'),
			],
		];
		return $artistes;
	}
}
```

Ajoutons maintenant une route qui nous mènera à la méthode `afficheArtistes` du
contrôleur

### Route

Contenu du fichier `\routes\web.php`

```php
<!-- routes/web.php -->
Route::get('/artistes/{premiereLettre?}', [ArtistesController::class,'afficheArtistes'])->where(['premiereLettre' => '[a-zA-Z]']);
```

Cette route permet de rediriger vers la méthode `afficheArtistes` du contrôleur
`ArtistesController`

> Remarque : Ne pas oublier `use App\Http\Controllers\ArtistesController;`

### Vue

Dans le contrôleur la dernière ligne de la méthode `afficheArtistes()` nous
envoie vers la vue `view_artistes.blade.php` qui n'existe encore pas. Nous
allons donc la créer.

Pour commencer nous allons factoriser tout les détails de notre vue dans un
`template`Blade. Notre vue n'aura donc plus qu'à se focaliser sur l'affichage
des artistes.

> Remarque : Le fichier `template` ainsi que le fichier pour la `vue` se créent
> à la main (via un éditeur de code)

Contenu du fichier "`template`" `\resources\views\template.blade.php`

```php
<!-- resources/views/template.blade.php -->
<!doctype html>
<html lang="fr">
    <head>
        <title>@yield('titre')</title>
       	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        @yield('contenu')
    </body>
</html>
```

Contenu de la vue `\resources\views\view_artistes.blade.php` basée sur le
template ci-dessus.

```php
<!-- resources/views/view_artistes.blade.php -->
@extends('template')

@section('titre')
Artistes
@endsection

@section('contenu')
<table>
    @foreach($artistes as $artiste)
    <tr><td> {{$artiste['nom']}} </td>
        <td> {{$artiste['prenom']}} </td>
        <td> {{$artiste["dateNaissance"]->format("d-m-Y")}} </td>
    </tr>
    @endforeach
</table>
@endsection
```

Voilà, nous avons terminé.

Nous pouvons maintenant tester que tout fonctionne à l'aide de notre navigateur.

`localhost:8000/artistes/J`

## Exercice 2 - Donnée

Ecrire le code permettant d'afficher aléatoirement dix proverbes différents.
[Liste de proverbes](https://fr.wiktionary.org/wiki/Annexe:Liste_de_proverbes_français)

Veuillez utiliser les notions :

- route
- contrôleur
- vue (Blade)

La route doit rediriger sur un contrôleur, le contrôleur doit contenir une
méthode qui va choisir aléatoirement les dix proverbes à afficher, les mettre
dans un tableau et transmettre le tableau à une vue qui va s'occuper de les
afficher à l'aide d'une [boucle for](https://laravel.com/docs/10.x/blade#loops)
de Blade.

1. Commencer par `hardcoder` la liste complète des proverbes dans un tableau
   puis d'en tirer dix aléatoirement.
2. Stocker la liste des proverbes dans un fichier texte, les charger dans un
   tableau puis en tirer dix aléatoirement.
3. [Challenge] Récupérer tous les proverbes proposés par le lien
   [Liste de proverbes](https://fr.wiktionary.org/wiki/Annexe:Liste_de_proverbes_français)
   à l'aide d'un objet

[`DOMDocument()`](https://www.php.net/manual/fr/class.domdocument.php)
(`c.f. ->loadHTMLFile(...)`, `->getElementsByTagName(...)` puis en choisir dix
aléatoirement.

​## Exercice 2 - Solution

### Route

Contenu du fichier `\routes\web.php`

```php
<!-- routes/web.php -->
Route::get('/proverbesV1', [ProverbesController::class,'afficheDixProverbes'])
```

Cette route permet de rediriger vers la méthode `afficheProverbes` du contrôleur
`ProverbesController`

> Remarque : Ne pas oublier `use App\Http\Controllers\ProverbesController;`

### Contrôleur

Contenu du fichier `\app\Http\Controllers\ProverbesController.php`

```php
<!-- app/Http/Controllers/ProverbesController.php -->
<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gestionnaires\GestionnaireProverbesFichierTexte;
use App\Gestionnaires\GestionnaireProverbesHardcode;
use App\Gestionnaires\GestionnaireProverbesWikipedia;

class ProverbesController extends Controller
{
	public function afficheDixProverbesV1()
	{
		$dixProverbes = [
			'beaucoup de bruit pour rien',
			'ce qui doit être sera',
			'diseur de bons mots, mauvais caractère',
			'eau trouble ne fait pas miroir',
			'gober des mouches',
			'jamais deux sans trois',
			'mieux vaut être seul que mal accompagné',
			'ni vu ni connu',
			'Paris ne s’est pas fait en un jour',
			'rien ne sert de courir, il faut partir à temps',
		];

		// on transmet les dix proverbes à la vue qui va les afficher
		return view('view_proverbesV1')->with('proverbes', $dixProverbes);
	}
}
```

### Vue

Nous avons déjà un fichier `template`, il ne reste qu'à créer une vue

Contenu de la vue `\resources\views\view_proverbesV1.blade.php`

```php
<!-- resources/views/view_proverbesV1.blade.php -->
@extends('template')

@section('titre')
    Dix Proverbes
@endsection

@section('contenu')
  <table>
    <th>Liste des proverbes</th>
    @foreach($proverbes as $proverbe)
    <tr>
        <td> {{$proverbe}} </td>
    </tr>
    @endforeach
  </table>
@endsection
```

Voilà, notre première partie est terminée.

Il ne reste plus qu'à tester. Sur l'url : `localhost:8000/proverbesV1`

---

Pour la suite, nous allons utiliser les concepts de la POO pour structurer notre
code.

Les proverbes peuvent provenir de plusieurs sources :

- Soit ils sont hardcodés (comme dans notre 1<sup>e</sup> version)
- Soit ils proviennent d'un fichier texte
- Soit ils proviennent d'internet (`Wikipedia`)

### Structuration du code

Nous allons créer nos propres classes que nous allons mettre dans un nouveau
répertoire.

Créons tout d'abord le répertoire : `\Gestionnaires` dans le répertoire `\app`
de notre application.

Ce qui nous donne : `\app\Gestionnaires`

Quelque soit la source des proverbes (codé en dur, fichier, on-line), il nous
faut des proverbes que nous mettrons chaque fois dans un tableau. Il nous faudra
aussi connaître la source de nos proverbes. Créons pour ceci une interface au
sens POO du terme.

```php
<!-- app/Gestionnaires/IGestionnaireProverbes.php -->
<?php namespace App\Gestionnaires;

/**
 * Tous les gestionnaires de proverbes doivent :
 *      - Rendre des proverbes
 *      - Indiquer d'où proviennent ces proverbes
 */
interface IGestionnaireProverbes
{
	/**
	 * Doit rendre un tableau de proverbes
	 */
	public function rendProverbes();

	/**
	 * Doit indiquer d'où proviennent les proverbes (chaîne de caractère)
	 */
	public function rendSource();
}
```

Créons maintenant un gestionnaire par source de donnée et spécialisons le code.

Voici le gestionnaire pour les proverbes codés en dur.

```php
<!-- app/Gestionnaires/GestionnaireProverbesHardcode.php -->
<?php namespace App\Gestionnaires;

/**
 * Rend une série de proverbes.
 * Remarque : les proverbes sont hardcodés
 */
class GestionnaireProverbesHardcode implements IGestionnaireProverbes
{
	/**
	 * Rend une série de proverbes.
	 * @return type Un tableau contenant tous les proverbes
	 */
	public function rendProverbes()
	{
		$proverbes = [
			'à bon entendeur salut',
			'beaucoup de bruit pour rien',
			'ce qui doit être sera',
			'diseur de bons mots, mauvais caractère',
			'eau trouble ne fait pas miroir',
			'fagot bien lié est à moitié porté',
			'gober des mouches',
			'herbe connue soit bienvenue',
			'il faut se méfier de l’eau qui dort',
			'jamais deux sans trois',
			'l’amour est aveugle',
			'mieux vaut être seul que mal accompagné',
			'ni vu ni connu',
			'œil pour œil, dent pour dent',
			'Paris ne s’est pas fait en un jour',
			'quand le chat n’est pas là, les souris dansent',
			'rien ne sert de courir, il faut partir à temps',
			'si jeunesse savait, si vieillesse pouvait',
			'tomber pour mieux se relever',
		];
		return $proverbes;
	}

	/**
	 * Permet de savoir d'où proviennent les proverbes
	 * @return string "Source : Proverbes hardcodés"
	 */
	public function rendSource()
	{
		return 'Source : Proverbes hardcodés';
	}
}
```

Plutôt que de coder en dur les proverbes, nous pouvons les mettre dans un
fichier texte. Ainsi, il sera plus facile d'ajouter ou de supprimer des
proverbes dans notre application. Créons le fichier contenant les proverbes :

```txt
<!-- storage/app/proverbes.txt -->
à bon entendeur salut
beaucoup de bruit pour rien
ce qui doit être sera
diseur de bons mots, mauvais caractère
eau trouble ne fait pas miroir
fagot bien lié est à moitié porté
gober des mouches
herbe connue soit bienvenue
il faut se méfier de l’eau qui dort
jamais deux sans trois
l’amour est aveugle
mieux vaut être seul que mal accompagné
ni vu ni connu
œil pour œil, dent pour dent
Paris ne s’est pas fait en un jour
quand le chat n’est pas là, les souris dansent
rien ne sert de courir, il faut partir à temps
si jeunesse savait, si vieillesse pouvait
tomber pour mieux se relever
```

Créons maintenant le gestionnaire correspondant.

```php
<!-- app/Gestionnaires/GestionnaireProverbesFichierTexte.php -->
<?php namespace App\Gestionnaires;

/**
 * Rend une série de proverbes.
 * Remarque : les proverbes proviennent du fichier : \storage\app\proverbes.txt
 */
class GestionnaireProverbesFichierTexte implements IGestionnaireProverbes
{
	/**
	 * Récupere tous les proverbes du fichier : \storage\app\proverbes.txt
	 * @return type Un tableau contenant tous les proverbes
	 */
	public function rendProverbes()
	{
		$path = storage_path('app/proverbes.txt');
		$proverbes = file($path);
		return $proverbes;
	}

	/**
	 * Permet de savoir d'où proviennent les proverbes
	 * @return string "Source : Proverbes provenant d'un fichier texte"
	 */
	public function rendSource()
	{
		return "Source : Proverbes provenant d'un fichier texte";
	}
}
```

Plutôt que de mettre les proverbes dans un fichier, nous pouvons aller les
chercher sur un site on-line (`wikipedia` par exemple). Voici le gestionnaire
correspondant :

```php
<!-- app/Gestionnaires/GestionnaireProverbesWikipedia.php -->
<?php namespace App\Gestionnaires;

use DOMDocument;

/**
 * Rend une série de proverbes.
 * Remarque : les proverbes proviennent de wikipédia (online)
 */
class GestionnaireProverbesWikipedia implements IGestionnaireProverbes
{
	// Récupère le contenu (texte) des tags li de l'url spécifiée
	// La fonction retourne un tableau de chaînes de caractères
	private function recupereTagsLi($url)
	{
		$doc = new DOMDocument();
		// On récupère le contenu html
		libxml_use_internal_errors(true);
		$doc->loadHTMLFile($url);
		libxml_use_internal_errors(false);
		// On récupère tous les éléments <li> du code html
		// car les proverbes y figurent
		$tagsLi = $doc->getElementsByTagName('li');
		// On met le contenu texte (des tags li) dans un tableau
		$tagsTexte = [];
		for ($i = 0; $i < $tagsLi->length; $i++) {
			$tagLi = $tagsLi->item($i);
			$tagsTexte[] = $tagLi->nodeValue;
		}
		return $tagsTexte;
	}

	// Le contenu texte des tags li ne contiennent pas tous des proverbes.
	// Du coup il faut "nettoyer" un peu.
	private function recupereUniquementProverbes($tagsTexte)
	{
		//dd($tagsTexte);
		$proverbes = [];
		$trouveDeclancheurEnregistrement = false;
		$pos = -1;
		$fin = false;
		// parcours de tous les tags <li> pour ne garder que les bons
		do {
			$pos++;
			$tagTexte = $tagsTexte[$pos];
			if (!$trouveDeclancheurEnregistrement) {
				if ($pos == 71) {
					$trouveDeclancheurEnregistrement = true;
					$proverbes[] = $tagTexte;
				}
			} else {
				// on s'arrête lorsqu'on a trouvé le mot Wiktionnaire
				if (str_contains($tagTexte, 'Wiktionnaire')) {
					$fin = true;
				} else {
					$proverbes[] = $tagTexte;
				}
			}
		} while (!$fin && $pos < count($tagsTexte));
		return $proverbes;
	}

	/**
	 * Récupere tous les proverbes français de wikipedia online
	 * @return type Un tableau contenant tous les proverbes
	 */
	public function rendProverbes()
	{
		$url =
			'https://fr.wiktionary.org/wiki/Annexe:' .
			'Liste_de_proverbes_fran%C3%A7ais';
		$tagsLiTexte = $this->recupereTagsLi($url);
		$proverbes = $this->recupereUniquementProverbes($tagsLiTexte);
		return $proverbes;
	}

	/**
	 * Permet de savoir d'où proviennent les proverbes
	 * @return string "Source : Proverbes provenant de wikipédia"
	 */
	public function rendSource()
	{
		return 'Source : Proverbes provenant de wikipédia';
	}
}
```

### Contrôleur V2

Il nous faut maintenant une nouvelle méthode dans le contrôleur.

```php
<!-- app/Http/Controllers/ProverbesController.php -->
...
public function afficheDixProverbesV2() {
        //$gestionnaire = new GestionnaireProverbesHardcode();
		//$gestionnaire = new GestionnaireProverbesFichierTexte();
        $gestionnaire = new GestionnaireProverbesWikipedia();
        $proverbes = $gestionnaire->rendProverbes();
        //        On "pêche" dix proverbes au hasard en codant nous même ...
        //        for ($i = 1; $i <= 10; $i++) {
        //            $taille = sizeof($proverbes);
        //            do {
        //                $index =random_int(0,$taille-1);
        //            } while (!isset($proverbes[$index]));
        //            $proverbe = $proverbes[$index];
        //            unset($proverbes[$index]);
        //            array_push($dixProverbes, $proverbe);
        //        }
        //
        // ou on pêche dix proverbes au hasard à l'aide des fonctions php
        $dixProverbes = array_map(function($index) use ($proverbes) {
            return $proverbes[$index];
        }, array_rand($proverbes, 10));

        // on transmet les dix proverbes à la vue qui va les afficher
        return view('view_proverbesV2', ['source' => $gestionnaire->rendSource(),
            'proverbes' => $dixProverbes]);
    }
...
```

### Route V2

Pour pouvoir exécuter notre nouvelle méthode, il nous faut une nouvelle route

```php
<!-- routes/web.php -->
...
Route::get('/proverbesV2', [ProverbesController::class,'afficheDixProverbesV2']);
...
```

### Vue V2

Enfin, puisque nous avons trois sources de données possibles, il serait bien de
savoir d'où proviennent les données.

Contenu de la vue `\resources\views\view_proverbesV2.blade.php`

```php
<!-- resources/views/view_proverbesV2.blade.php -->
@extends('template')

@section('titre')
    Dix Proverbes
@endsection

@section('contenu')
  <table>
    <th>{{$source}}</th>
    @foreach($proverbes as $proverbe)
    <tr>
        <td> {{$proverbe}} </td>
    </tr>
    @endforeach
  </table>
@endsection
```

Voilà, il ne reste plus qu'à tester

`http://localhost:8000/proverbesV2`

> Pour changer la source de données, il suffit de commenter, décommenter les
> lignes de votre choix dans le contrôleur.
>
> ```php
> //$gestionnaire = new GestionnaireProverbesHardcode();
> //$gestionnaire = new GestionnaireProverbesFichierTexte();
> $gestionnaire = new GestionnaireProverbesWikipedia();
> ```
