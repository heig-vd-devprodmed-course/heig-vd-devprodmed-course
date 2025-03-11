# Jour 1

Objectifs du jour :

- Installer le nécessaire pour pouvoir créer des applications `Laravel`.
  - Installation de PHP (8.x)
  - [`Composer`](https://getcomposer.org/doc/00-intro.md) (gestionnaire de
    paquet)
  - `laravel/installer` (Pour créer le squelette d'une application `Laravel`)
- Créer un squelette d'application `Laravel` à l'aide de la ligne de commande.
- Repérer les répertoires et fichiers de bases de `Laravel` (`routes\web.php`,
  `resources\views\`)
- Changer le comportement d'une application `Laravel`.

## Installation

- Mac : Exécutez la marche à suivre indiquée dans le fichier :
  `01_Install_Laravel_Mac`

- Windows : Exécutez la marche à suivre indiquée dans le fichier :
  `01_Install_Laravel_Windows`

## Création d'un squelette d'application `Laravel` (`Windows` et `Mac`)

A l'aide du `terminal` (Mac) ou de l'invite de commande `cmd` (Windows) se
déplacer dans le répertoire désiré

> Voici deux liens pour accéder aux aides mémoires pour les commandes de base
> des différents terminaux :
>
> - [Windows](https://github.com/draperjames/windows-cmd-cheat-sheet)
> - [Mac](https://github.com/0nn0/terminal-mac-cheatsheet/tree/master/Fran%C3%A7ais)

puis taper :

```
laravel new monApp1/laravel
```

L'installeur vous demande alors de répondre à quelques questions :

```
Would you like to install a starter kit? [No starter kit]:
  [none     ] No starter kit
  [breeze   ] Laravel Breeze
  [jetstream] Laravel Jetstream
```

Tapez sur la touche "return" pour indiquer qu'on ne désire pas de "starter kit".

```
Which testing framework do you prefer? [Pest]:
  [0] Pest
  [1] PHPUnit
```

Tapez sur la touche "return" pour indiquer qu'on désire utiliser `Pest` comme
outil de `testing`.

```
Would you like to initialize a Git repository? (yes/no) [no]:
```

Tapez sur la touche "return" pour indiquer qu'on ne désire pas utiliser `Git`
pour l'instant.

```
Which database will your application use? [MySQL]:
  [mysql  ] MySQL
  [mariadb] MariaDB
  [pgsql  ] PostgreSQL
  [sqlite ] SQLite
  [sqlsrv ] SQL Server
```

Tapez sur la touche "return" pour indiquer qu'on désire utiliser `MySQL` comme
SGBD.

Voilà, le squelette d'une nouvelle application `Laravel` a été créé :smiley:

Concrètement, il s'agit d'un répertoire `monApp1` contenant un sous-répertoire
`laravel` qui contient tous les répertoires et fichiers constituant le squelette
d'une application de base qui fonctionne.

Pour rendre l'application disponible via un browser, il suffit de se déplacer en
ligne de commande dans le répertoire `monApp1/laravel` et taper la commande :

```
php artisan serve
```

> Remarque : Si besoin, on peut choisir le port
>
> ```
> php artisan serve --port=8080
> ```
>
> (Le port par défaut est le port : 8000)

Un message nous indique que l'application est disponible : http://127.0.0.1:8000

Il suffit de lancer un browser et de taper comme adresse :

```
localhost:8000
```

ou

```
127.0.0.1:8000
```

> `localhost` est l'équivalent de l'adresse IP : 127.0.0.1

Pour stopper l'application, il suffit de faire `CRTL` + `C` dans la fenêtre
correspondante à la ligne de commande ou simplement fermer la fenêtre.

## Repérer les répertoires et fichiers de bases de `Laravel`.

Liste des répertoires :

- `app` : Modèles, contrôleurs, gestionnaires d'application, d'exceptions, etc.
- `bootstrap` : Scripts d'initialisation de l'application.
- `config` : Toutes les configurations (base de données, authentification,
  emails, sessions, etc.)
- `database` : Migrations et populations.
- `public` : Dossier public du site (images, `css`, scripts, fichier :
  `index.php`)
- `resources` : Vues, fichiers de traductions (langues)
- `routes` : Point d'entrée de l'application.
- `storage` : Données temporaires de l'application (vues compilées, clés de
  session, etc.)
- `tests` : Fichiers de tests unitaires
- `vendor` : tous les composants `Laravel` et ses dépendances

Le fichier de base se trouve dans le répertoire "routes", il s'agit du fichier
`web.php`

Voici son contenu :

```php
Route::get('/', function () {
	return view('welcome');
});
```

La vue `welcome` se trouve dans le répertoire `resources/views`, il s'agit du
fichier `welcome.blade.php`

## Changer le comportement d'une application `Laravel`.

Familiarisons-nous d'abord avec le concept de routes.

Créons d'autres routes :

```php
Route::get('/', function () {
	return view('welcome');
});

Route::get('1', function () {
	return 'page 1';
});
Route::get('2', function () {
	return 'page 2';
});
Route::get('3', function () {
	return 'page 3';
});
```

et testons-les !

Lançons l'application et ajoutons /1 à l'URL de notre navigateur.

​ `http://localhost:8000/1`

Le texte `page 1` devrait être maintenant visible dans le browser.

Répétons l'opération pour voir la page 2 et 3.

Remplaçons les trois routes précédentes par celle-ci :

```php
Route::get('/', function () {
	return view('welcome');
});

//...

Route::get('{n}', function ($n) {
	return "page $n";
})->where('n', '[1-3]');
```

Pour contrôler la validité du paramètre 'n' on passe par une
[expression régulière](https://fr.wikipedia.org/wiki/Expression_r%C3%A9guli%C3%A8re)
[1-3] qui signifie 1,2 ou 3.

> Voici un lien vous permettant de vous familiariser avec les expressions
> régulières :
> [regex](https://zestedesavoir.com/tutoriels/3651/les-expressions-regulieres-1/)

Attention à la syntaxe qui est particulière ! {n}, $n et n... Il y a de quoi
s'embrouiller au début. ;-)

Nous pouvons ajouter quelques commande `php` dans la fonction :

```php
Route::get('/', function () {
	return view('welcome');
});

//...

Route::get('afficheDate', function () {
	$date = now();
	echo 'Voici le détail de la variable $date : ' . '<br>';
	echo '<br>';
	var_dump($date);
	echo '<br><br>';
	echo "Aujourd'hui, nous sommes le " . $date;
});
```

Pour afficher le contenu d'une variable la commande dd(...) est très pratique :

```php
Route::get('/', function () {
	return view('welcome');
});

//...

Route::get('afficheDate2', function () {
	$date = now();
	dd($date);
});
```

> Remarque : `dd(...)` signifie dump and die, c'est à dire que tout s'arrête
> après la commande ;-)

Il est possible de rediriger une route sur une url. Voici comment procéder :

```php
//...

Route::get('cff', function () {
	return redirect('https://www.sbb.ch/fr/');
});
```

Il est possible de donner un nom à une route.

> Cela s'avèrera très pratique pour pouvoir rediriger l'utilisateur sur la page
> de login s'il essaye d'accéder à une `url` nécessitant d'être authentifié.

```php
Route::get('/', function () {
	return view('welcome');
})->name('home');
```

et voici comment rediriger sur une route nommée :

```php
Route::get('maison', function () {
	return redirect()->route('home');
});
```

Retenons juste pour l'instant qu'il est possible de donner un nom à une route
:wink:.

Il est possible de transformer les informations relatives à une route en
paramètres. Voici comment procéder :

```php
Route::get('uneRoute/{param1}/{param2}/{param3?}', function (
	$param1,
	$param2,
	$param3 = 'Laravel'
) {
	return $param1 . ' ' . $param2 . ' ' . $param3;
});
```

> Le point d'interrogation (?) correspond à un paramètre optionnel. Il est donc
> important de mettre une valeur par défaut à la variable correspondante.

Ainsi l'adresse : `http://localhost:8000/uneRoute/trop/bien/laravel` retournera

`trop bien laravel`

et

L'adresse : `http://localhost:8000/uneRoute/trop/bien` retournera

`trop bien laravel`

Maintenant que nous avons compris le rôle des routes, passons maintenant à celui
des vues.

Créons une vue `article.php` dans le répertoire `resources/views` :

```html
<html>
	<head>
		<title>TODO supply a title</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<div>Ma première vue</div>
	</body>
</html>
```

et changeons la route crée précédemment pour y accéder.

```php
Route::get('{n}', function ($n) {
	return view('article');
})->where('n', '[1-3]');
```

Et testons pour voir si cela fonctionne :

```
localhost:8000/1
```

```
localhost:8000/2
```

```
localhost:8000/3
```

> Ne vous inquiétez pas, c'est normal que le trois `urls` ont le même
> comportement.

Voyons maintenant comment envoyer une donnée à une vue. Nous allons envoyer le
numéro $n à la vue.

Voici comment procéder :

```php
Route::get('{n}', function ($n) {
	return view('article')->with('n', $n);
})->where('n', '[1-3]');
```

Et voici comment récupérer la donnée $n dans la vue :

```php+HTML
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>Ma première vue</div>
        <div>article : <?php echo $n ?></div>
    </body>
</html>
```

Testons nos modifications

```
localhost:8000/1
```

```
localhost:8000/2
```

```
localhost:8000/3
```

### Template Blade

`Laravel` possède un moteur de `template` nommé Blade qui va nous simplifier
l'écriture. Mettons-le en œuvre.

Pour activer le moteur de `template` il suffit de nommer nos vues avec
l'extension `.blade.php`

Renommons notre vue `article.php` en `article.blade.php` et apportons la
modification suivante :

```php+HTML
<html>

    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <div>Ma première vue</div>
        <div>article : {{$n}}</div>
    </body>
</html>
```

## Résumé :

Le fichier `routes\web.php` permet de configurer les `urls` auxquelles notre
application répondra. Nous pouvons récupérer les différentes parties de nos
`urls` en les plaçant dans des variables. Nous pouvons appliquer des règles de
nommage sur des parties de nos `urls` grâce aux expressions régulières. Nous
pouvons créer des vues (`resources\view`) Nous pouvons envoyer des données
depuis une route à une vue Nous pouvons récupérer les données envoyées par une
route et les exploiter dans une vue. Nous pouvons simplifier la syntaxe PHP dans
une vue grâce au moteur de `template` Blade.
