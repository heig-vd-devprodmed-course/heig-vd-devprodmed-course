## Questionnaire 01 `Laravel`

1.) Dans quel répertoire se trouve le fichier contenant les routes ?

> Le répertoire est : /routes
> [Documentation Routes](https://laravel.com/docs/10.x/routing)

2.) Comment se nomme le fichier contenant la route par défaut ?

> Le fichier se nomme : `web.php`

3.) Quelle est la route par défaut lorsqu’on installe `Laravel` ?

> La route se nomme « / ». C’est la racine du site.

```php
Route::get('/', function () {
	return view('welcome');
});
```

4.) Comment définit-on une nouvelle route ?

```php
	Route::get('nomRoute'), function () {
		// ...
	}
```

5.) Comment paramètre-t-on une route ?

> En mettant le(s) paramètre(s) de l'url entre accolades {}, puis en les passant
> dans les parenthèses de la fonction. Attention à ne pas oublier le signe `$`

```php
Route::get('article/{n}/couleur/{c}', function ($n, $c) {
	return 'article : ' . $n . ' de couleur ' . $c;
});
```

6.) Comment forcer le paramètre d’une route à respecter certaines règles ?

​ Avec des
[expressions régulières](https://fr.wikipedia.org/wiki/Expression_régulière).

> Les expressions régulières doivent se mettre dans la clause `where` `$n` doit
> être : compris dans l'intervalle [0-9] le + signifie (doit être présent une ou
> plusieurs fois) `$c` doit être soit rouge, soit vert, soit bleu.

```php
Route::get('article/{n}/couleur/{c}', function ($n, $c) {
	return view('vue1');
})->where(['n' => '[0-9]+', 'c' => 'rouge|vert|bleu']);
```

​ Avec du code.

```php
	Route::get('user/{id}', function($id) {
    	if (...condition...) {   // $id == ...
        	// action(s) à effectuer
       	}
	});
```

7.) Qu’est-ce qu’une route nommée ? A quoi cela sert-il ?

> Le fait de nommer une route permet de rediriger facilement dessus. (Voir
> question suivante)

```php
Route::get('/', function () {
	return 'La route / est nommée home';
})->name('home');
```

8.) Quelle est la syntaxe de la commande permettant de rediriger : a.) sur une
route nommée ? b.) sur une url ?

​ a.)

```php
Route::get('testRedirection', function () {
	return redirect()->route('home');
});
```

​ b.)

```php
Route::get('testRedirection2', function () {
	return redirect('uneUrl');
});
```

9.) Qu’est-ce qu’une vue ?

> Une vue correspond à une page web qui affiche quelque chose
> [Documentation Views](https://laravel.com/docs/10.x/views)

10.) Comment lie-t-on une route à une vue ?

> L'url `/article` permet d'accéder à la page (vue) `vue1`

```php
Route::get('article', function () {
	return view('vue1');
});
```

11.) Dans quel répertoire se trouvent les vues ?

> ​ Dans le répertoire `/resources/views`

12.) A quoi sert l’outil Blade dans `Laravel` ?

> C'est un outil de templating permettant la mise en forme de page web de
> manière aisée et facilement réutilisable.
> [Documentation Blade](https://laravel.com/docs/10.x/blade)

13.) Comment met-on en œuvre Blade ?

> Il suffit de changer l'extension d'une vue de `.php` à `.blade.php` Une fois
> ce renommage effectué, Blade sera actif. Simple non ? Exemple : `vue1.php` =>
> `vue1.blade.php`

14.) Comment transfère-t-on un paramètre d’une route à une vue ?

> avec `->with('nomParametreDansVue', $nomParametreFonction)`

```php
Route::get('article/{n}', function ($n) {
	return view('maVue')->with('numero', $n);
});
```

15.) Comment récupère-t-on un paramètre dans la vue ?

> ​ avec `{{$nomParametreDansVue}}`

```php+HTML
	<p> {{ $numero }} </p>
```

16.) Comment transfère-t-on plusieurs paramètres d'une route à une vue ?

> En chaînant les `->with(...)`

```php
Route::get('article/{n}/couleur/{c}', function ($n, $c) {
	return view('maVue')->with('numero', $n)->with('couleur', $c);
});
```

> ou en passant un tableau :

```php
Route::get('article/{n}/couleur/{c}', function ($n, $c) {
	return view('maVue', ['numero' => $n, 'couleur' => $c]);
});
```

> [Documentation Transmission Données](https://laravel.com/docs/10.x/views#passing-data-to-views)
