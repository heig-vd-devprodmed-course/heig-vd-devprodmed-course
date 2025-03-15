# Exercice 1

## Donnée :

```
Ecrire le code permettant d'afficher la table de multiplication de son choix :

	url : .../livret/5      => affiche le livret 5

		affiche :

		1 * 5 = 5
		2 * 5 = 10
		...
  		12 * 5 = 60

	url : ...../livret/7      => affiche le livret 7
```

## Corrigé version 1 :

Dans le fichier `\routes\web.php` il faut une nouvelle route :

```php
Route::get('livret/{n}', function ($n) {
	for ($mult = 1; $mult <= 12; $mult++) {
		echo $mult . ' * ' . $n . ' = ' . $mult * $n, '<br>';
	}
})->where(['n' => '[2-9]|1[0-2]']);
```

Voilà c'est tout.

## Corrigé version 2 :

Est-ce vraiment à la partie qui s'occupe des routes de s'occuper de l'affichage
du livret ?

Non, pas vraiment. C'est la raison pour la quelle on va créer une nouvelle vue.

`\resources\view\livret.php`

```php+HTML
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Livret <?php echo $n ?></title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <?php
	for ($mult = 1; $mult <= 12; $mult++) {
		echo $mult . ' * ' . $n . ' = ' . $mult * $n, '<br>';
	}
  ?>
</body>
</html>
```

et pour accéder à cette vue, il nous faut une nouvelle route

```php
Route::get('/livretVue/{n}', function ($n) {
	return view('livret')->with('n', $n);
})->where(['n' => '[2-9]|1[0-2]']);
```

Le code est ainsi mieux structuré.

---

# Exercice 2

## Donnée :

Ecrire le code permettant aux urls :

```
.../page1
```

```
.../Page1
```

d'accéder au même contenu.

## Corrigé :

Dans le fichier `\routes\web.php` il faut une nouvelle route :

```php
Route::get('{p}age1', function ($p) {
	return 'Bien joué';
})->where('p', '[P|p]');
```

---

# Exercice 3

## Donnée :

```
Ecrire le code permettant de rediriger l'utilisateur sur le site suivant :

	url : .../cff/Lausanne/8:30/Yverdon/       => redirige vers
	https://www.sbb.ch/fr/acheter/pages/fahrplan/fahrplan.xhtml?von=Lausanne&nach=Yverdon&datum=23.02.2021&zeit=08:30&suche=true

Remarques :

- La gare de départ, l'heure de départ ainsi que la gare d'arrivée sont définie dans l'url.
- La date (23.02.2021) doit être celle du jour.

Challenge : Définir un paramètre optionnel dans l'url permettant de choisir ou non la date du voyage.
```

## Corrigé :

```php
Route::get('cff/{dep}/{hm}/{arr}/{strDate?}', function (
	$dep,
	$hm,
	$arr,
	$strDate = 0
) {
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
		$strDate = $date->format('d.m.Y');
	} else {
		$strDate = $jour . '.' . $mois . '.' . $annee;
	}
	return redirect(
		'https://www.sbb.ch/fr/acheter/pages/fahrplan/fahrplan.xhtml?' .
			'von=' .
			$dep .
			'&nach=' .
			$arr .
			'&datum=' .
			$strDate .
			'&zeit=' .
			$hm .
			'&suche=true'
	);
});
```
