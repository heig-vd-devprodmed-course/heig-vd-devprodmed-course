# Introduction - Exercices et solutions

## Exercice 1 - Donnée

Ecrire le code permettant d'afficher la table de multiplication de son choix :

url : ...../livret/5 => affiche le livret 5

affiche :

```php
1 * 5 = 5
2 * 5 = 10
3 * 5 = 15
...
12 * 5 = 60
```

url : ...../livret/7 => affiche le livret 7

> Remarque : Les tables de multiplication vont de 2 à 12

## Exercice 1 - Challenge

Ecrire l'expression régulière permettant de contrôler que la table de
multiplication entrée par l'utilisateur est comprise entre 2 et 12 (valeurs
comprises).

## Exercice 1 - Solution

```php
<!-- routes/web.php -->
Route::get('/livret/{table}', function($table) {
    if ($table < 2 || $table > 12) {
        return "La table de multiplication doit être comprise entre 2 et 12";
    }
    for ($i = 1; $i <= 12; $i++) {
        echo "$i * $table = " . $i * $table . "<br>";
    }
});
```

Ou avec `where` :

```php
<!-- routes/web.php -->
Route::get('/livret/{table}', function($table) {
    for ($i = 1; $i <= 12; $i++) {
        echo "$i * $table = " . $i * $table . "<br>";
    }
})->where('table', '[2-9]|1[0-2]');
```

ou avec des vues

```php
<!-- routes/web.php -->
Route::get('/livretVue/{n}', function ($n) {
    return view('livret')->with("n",$n);
})->where(['n' => '[2-9]|1[0-2]']);
```

```html
<!-- resources/views/livret.blade.php -->
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Livret {{$n}}</title>
		<link rel="stylesheet" href="style.css" />
		<script src="script.js"></script>
	</head>
	<body>
		<?php
	for ($mult = 1; $mult <= 12; $mult++) {
		echo $mult . ' * ' . $n . ' = ' . $mult * $n, '<br>'; } ?>
	</body>
</html>
```

## Exercice 2 - Donnée Ecrire le code permettant aux `urls` : ```php .../page1

```php
.../Page1
```

d'accéder au même contenu.

## Exercice 2 - Solution

```php
<!-- routes/web.php -->
Route::get('/page1', function() {
    return "Page 1";
});

Route::get('/Page1', function() {
    return redirect('page1');
});
```

ou avec `where` :

```php
<!-- routes/web.php -->
Route::get('/{p}age1', function ($p) {
    return "Bien joué";
})->where('p', '[P|p]');
```

```php
Route::get('/{page}', function($page) {
    return "Page 1";
})->where('page', 'page1|Page1');
```

## Exercice 3 - Donnée

Ecrire le code permettant de rediriger l'utilisateur sur le site suivant :

```bash
    url : .../cff/Lausanne/8:30/Yverdon       => redirige vers
    https://www.sbb.ch/fr/acheter/pages/fahrplan/fahrplan.xhtml ?von=Lausanne&nach=Yverdon&datum=19.02.2024&zeit=08:30&suche=true
```

> Remarques :
>
> - La gare de départ, l'heure de départ ainsi que la gare d'arrivée doivent
>   être définie dans l'url.
>
> - La date doit être celle du jour

## Exercice 3 - Challenge

Définir un paramètre optionnel dans l'url permettant de choisir ou non la date
du voyage.

## Exercice 3 - Solution

```php
<!-- routes/web.php -->
Route::get('/cff/{dep}/{hm}/{arr}/{strDate?}', function ($dep, $hm, $arr, $strDate = 0) {
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
```

```php
<!-- routes/web.php -->
use Illuminate\Support\Facades\Route;
use DateTime;

Route::get('/cff/{dep}/{hm}/{arr}/{strDate?}', function ($dep, $hm, $arr, $strDate = null) {

    // Vérifie et formate la date fournie, sinon utilise la date du jour
    $strDate = validateAndFormatDate($strDate) ?? (new DateTime())->format("d.m.Y");

    // Génération de l'URL de redirection
    $url = sprintf(
        'https://www.sbb.ch/fr/acheter/pages/fahrplan/fahrplan.xhtml?von=%s&nach=%s&datum=%s&zeit=%s&suche=true',
        urlencode($dep),
        urlencode($arr),
        urlencode($strDate),
        urlencode($hm)
    );

    return redirect($url);
});

/**
 * Valide et formate une date au format "dd.mm.yyyy".
 *
 * @param string|null $strDate
 * @return string|null Retourne la date formatée si valide, sinon null.
 */
function validateAndFormatDate(?string $strDate): ?string {
    if (!$strDate || strlen($strDate) !== 10) {
        return null;
    }

    // Extraction des composantes jour, mois, année
    [$jour, $mois, $annee] = sscanf($strDate, "%2d.%2d.%4d");

    // Vérification de la validité de la date
    return checkdate($mois, $jour, $annee) ? sprintf('%02d.%02d.%04d', $jour, $mois, $annee) : null;
}
```
