# Introduction - Solutions

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
Route::get('livret/{table}', function($table) {
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
Route::get('livret/{table}', function($table) {
    for ($i = 1; $i <= 12; $i++) {
        echo "$i * $table = " . $i * $table . "<br>";
    }
})->where('table', '[2-9]|1[0-2]');
```

## Exercice 2 - Donnée

Ecrire le code permettant aux `urls` :

```php
.../page1
```

```php
.../Page1
```

d'accéder au même contenu.

## Exercice 2 - Solution

```php
Route::get('page1', function() {
    return "Page 1";
});

Route::get('Page1', function() {
    return redirect('page1');
});
```

ou avec une seule route :

```php
Route::get('{page}', function($page) {
    if (strtolower($page) === 'page1') {
        return "Page 1";
    }
    return redirect('page1');
});
```

ou avec `where` :

```php
Route::get('{page}', function($page) {
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
Route::get('cff/{depart}/{heure}/{arrivee}/{date?}', function($depart, $heure, $arrivee, $date = null) {
    if ($date === null) {
        $date = date('d.m.Y');
    }
    return redirect(
        "https://www.sbb.ch/fr/acheter/pages/fahrplan/fahrplan.xhtml" .
        "?von=$depart&nach=$arrivee&datum=$date&zeit=$heure&suche=true"
    );
});
```
