# Jour 2

## Objectifs

À l'issue de ce cours, les personnes qui étudient devraient être capables de :

- Concevoir et structurer des vues avec Blade en utilisant des templates
  réutilisables.
- Créer des vues dynamiques basées sur des templates et transmettre des
  paramètres aux vues.
- Expliquer le rôle d’un contrôleur dans une application Laravel et
  l’implémenter pour organiser la logique métier.
- Configurer des routes pour diriger les requêtes HTTP vers les contrôleurs
  appropriés.
- Manipuler des données dans un contrôleur et les transmettre à une vue.
- Utiliser les directives Blade, comme `@foreach`, pour afficher dynamiquement
  des données dans une vue.
- Gérer des ressources (comme les images) en les stockant et en les intégrant
  dans une application Laravel.

## Création d'une nouvelle application

Je vous propose de créer une nouvelle application Laravel à l'aide de la
commande :

```php
laravel new MonApp2/laravel
```

Puis exécutez l'application pour s'assurer que tout fonctionne correctement.

> php artisan serve (dans le bon répertoire , puis dans votre browser)

Nous avons vu au cours précédent que `Laravel` possède un outil de templating
nommé [Blade](https://laravel.com/docs/11.x/blade#introduction). Pour que Blade
soit activé il faut que nos vues possèdent l'extension `.blade.php`.

## Template (Blade)

Créons sans plus attendre notre premier `template`. Un template est un modèle de
base pour une vue que l'on peut faire varier facilement. Voici comment procéder
:

Il s'agit de créer un fichier texte : `\resources\views\monTemplate.blade.php`
avec le contenu suivant :

```html
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>@yield('titre')</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		@yield('contenu')
	</body>
</html>
```

Remarquez au passage le tag de Blade : `@yield` Ce tag permet d'être remplacé
par une section de code portant le nom indiqué entre les parenthèses.

Une fois que le template est prêt, nous n'avons plus qu'à l'utiliser pour créer
notre première vue "customisée"

## Vue basée sur un template

Créons le fichier texte : `\resources\views\maVue.blade.php` basé sur le
template que nous venons de créer.

```php
@extends('monTemplate')

@section('titre')
Template Laravel
@endsection

@section('contenu')
<p>Excellent choix !</p>
<p>L&apos;article {{$numero}} de couleur {{$couleur}} est tout simplement magnifique</p>

@endsection
```

Le `@extends(...nom_d_un_template...)` fait référence au template qui doit être
utilisé.

`@yield('titre')` sera remplacé par :

```html
Template Laravel
```

et

`@yield('contenu')` sera remplacé par :

```php
<p>Excellent choix !</p>
<p>L&apos;article {{$numero}} de couleur {{$couleur}} est tout simplement magnifique</p>
```

Voilà notre vue est prête.

## Route pour accéder à une vue (transmission de paramètres)

Préparons une route pour accéder à cette vue dans le fichier `/routes/web.php`

```php
Route::get('/article/{n}/couleur/{c}', function ($n, $c) {
	return view('maVue')->with('numero', $n)->with('couleur', $c);
})->where(['n' => '[0-9]+', 'c' => 'rouge|vert|bleu']);
```

Testons maintenant pour voir si tout cela fonctionne !

Dans votre navigateur préféré taper l'url suivante :
`.../article/3/couleur/rouge`

Vous devriez voir apparaître le message suivant dans le navigateur :

```bash
Excellent choix !

L'article 3 de couleur rouge est tout simplement magnifique.
```

Bravo !

Maintenant que les notions :

- routes
- vues

sont en place, passons maintenant à la notion de :

## [Contrôleur](https://laravel.com/docs/11.x/controllers)

Pour l'instant nous avons construit des routes qui mènent à des vues. Nous
allons maintenant intercaler des contrôleurs entre les routes et les vues.

Les routes vont servir à aiguiller les requêtes qui arrivent sur le serveur et
les diriger vers les contrôleurs. Les contrôleurs vont s'occuper de traiter les
requêtes "filtrées" et de passer le/les résultat(s) vers les vues appropriées.

Voici comment créer un contrôleur (rdv dans la console de commande, placé dans
le répertoire `\laravel`)

```bash
 php artisan make:controller MonPremierControleur
```

Vous devriez avoir maintenant un nouveau fichier dans le répertoire
`/app/Http/Controllers` nommé `MonPremierControleur.php` contenant le code
suivant :

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonPremierControleur extends Controller
{
	//
}
```

Ajoutons dans ce contrôleur une méthode nommée :

​ `maMethodeDansControleur()`

qui nous amènera à la vue `welcome`,

vous devriez avoir maintenant les lignes suivantes :

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonPremierControleur extends Controller
{
	public function maMethodeDansControleur()
	{
		return view('welcome');
	}
}
```

## Appel d'un contrôleur depuis une route

Il ne reste plus qu'à modifier la route principale pour qu'elle nous mène vers
le contrôleur. Modifiez la route :

```php
Route::get('/', function () {
	return view('welcome');
});
```

Pour qu'elle ressemble à ceci :

```php
Route::get('/', [MonPremierControleur::class, 'maMethodeDansControleur']);
```

Pour pouvoir utiliser cette classe, il faut ajouter la directive
`use ...nomDuNamespaceEtNomDeLaClasse...;`

> En haut du fichier `web.php`, ajoutons :

```php
use App\Http\Controllers\MonPremierControleur;
```

Voilà qui est fait.

La route nous mène vers une méthode du contrôleur qui nous mène vers une vue.

Testons pour voir...

Comment être sûr que cela a fonctionné, puisque rien n'a vraiment changé
d'apparence ?

Une solution simple consiste a afficher un message directement depuis le
contrôleur.

```php
public function maMethodeDansControleur() {
    return "YES !"; //return view('welcome');
}
```

Maintenant que nous avons compris, occupons nous de la route concernant le
numéro d'article et sa couleur.

```php
Route::get('/article/{n}/couleur/{c}', function ($n, $c) {
	return view('maVue')->with('numero', $n)->with('couleur', $c);
})->where(['n' => '[0-9]+', 'c' => 'rouge|vert|bleu']);
```

Nous sommes confrontés à un petit problème... comment envoyer des informations
`$n` et `$c` de la vue au contrôleur ?

Rien de plus simple, il suffit de paramétrer la méthode dans le contrôleur.

Voici comment procéder :

Ajoutons la méthode suivante dans le contrôleur (`MonPremierControleur.php`) :

```php
...
public function test($n, $c) {   // $n et $c pour récupérer les paramètres du même nom de la route
    return $n . " : " .$c;       // Pour tester si tout s'est bien passé
}
...
```

Puis ajoutons une nouvelle route :

```php
...
Route::get('/articleTest/{n}/couleur/{c}', [MonPremierControleur::class,'test'])->where(['n' => '[0-9]+', 'c' => 'rouge|vert|bleu']);
...
```

Voilà c'est fonctionnel, il ne suffit plus qu'à tester :
`.../articleTest/2/couleur/rouge`

Si votre navigateur affiche :

```bash
2 : rouge
```

C'est que tout fonctionne !

C'est aussi simple que cela. Les paramètres sont transmis directement de la vue
au contrôleur.

Maintenant que nous avons compris l'articulation entre route, vue et contrôleur,
il est temps d'approfondir un peu nos connaissances de Blade (le moteur de
templating) pour voir comment afficher toutes les lignes d'un tableau à l'aide
d'une boucle `foreach` dans une vue.

## [Directives Blade](https://laravel.com/docs/11.x/blade#blade-directives) (cliquez sur le titre ;-)

Blade propose différentes directives permettant de faire des conditions et/ou
des boucles. Chaque directive correspond à un tag `@nomDuTag`

Créons tout d'abord une route qui nous mène à une méthode d'un contrôleur.

```php
Route::get('/afficheTab', [MonPremierControleur::class, 'afficheTab']);
```

Puis, créons dans le contrôleur une méthode contenant un tableau que nous
passerons ensuite à une vue.

Voici la méthode du contrôleur :

```php
    public function afficheTab() {
        $artistes = array(
            array(
                "nom" => "Amy",
                "prenom" => "Winehouse",
                "dateNaissance" => new DateTime('14-09-1983')
            ),
            array(
                "nom" => "Janis",
                "prenom" => "Joplin",
                "dateNaissance" => new DateTime('19-01-1943')
            ),
            array(
                "nom" => "Jo",
                "prenom" => "Bar",
                "dateNaissance" => new DateTime('19-01-1943')
            ),
            array(
                "nom" => "Janis",
                "prenom" => "Siegel",
                "dateNaissance" => new DateTime('12-01-1990')
            ),);
        return view('maVue2')->with('artistes', $artistes);
    }
```

Comme le code utilise la classe `DateTime` il est nécessaire d'ajouter
l'instruction :

```php
use DateTime;
```

sous (ou au dessus) de l'instruction :

```php
use Illuminate\Http\Request;
```

dans le contrôleur, sinon cela provoquerait une erreur lors de l'exécution.

Créons maintenant la vue `maVue2.blade.php`

et tapons le code suivant :

```php
@extends('monTemplate')

@section('titre')
  Mon super tableau de tableau
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

Ce code contient la directive `@foreach ... @endforeach` permettant de faire une
boucle permettant de construire le tableau `html` contenant tous les artistes.

L'exécution du code devrait vous afficher ce qui suit :

```bash
    Amy     Winehouse  14-09-1983
    Janis   Joplin     19-01-1943
    Jo      Bar        19-01-1943
    Janis   Siegel     12-01-1990
```

## Ajout de ressource(s) à une application `Laravel` (Image)

Voyons maintenant comment gérer une ressource, plus particulièrement une image.

Créons un répertoire `images` dans le répertoire `\storage\app\public`, comme le
spécifie la documentation officielle de `Laravel`
([Où placer les ressources : images, `css`, scripts, sons, vidéos](https://laravel.com/docs/11.x/filesystem#the-public-disk))
Plaçons dans celui-ci une image par exemple : `image.png`

![image.png](https://images.unsplash.com/photo-1586810146927-6503e5eb48fd?fit=crop&h=720)

Comme indiqué dans la documentation, il est nécessaire de faire une lien virtuel
à l'aide de la commande :

```bash
php artisan storage:link
```

Voici le résultat de la commande :

```bash
The [...\laravel\public\storage] link has been connected to [...\laravel\storage\app\public].
The links have been created.
```

Ce lien permet de rendre le contenu du répertoire `\storage\app\public`
accessible depuis le répertoire `\public` de notre application.

Pour s'en rendre compte, il faut ouvrir un explorateur de fichier (ou un finder)
et aller dans le répertoire `/public`. Nous y trouvons le fameux lien virtuel.

Pour obtenir les chemins physiques des différentes répertoires de `Laravel` il
existe différentes fonctions mises à dispositions :

- [Documentation concernant les chemins physiques](https://laravel.com/docs/11.x/helpers#paths-method-list)
  (En particulier : `storage_path()`)

De même pour les `URLs` :

- [Documentation concernant les URLs](https://laravel.com/docs/11.x/helpers#urls-method-list)
  (En particulier : `asset(...)`)

Créons maintenant la vue permettant de l'afficher. Voici son contenu :

```php
@extends('monTemplate')

@section('titre')
  Ma belle image
@endsection

@section('contenu')
  <p>
    Voici ma première image :<br><br>
    <img src="{{ asset('storage/images/image.png') }}" alt="Mon image" />
  </p>
@endsection
```

Il ne reste plus qu'à créer une route, une nouvelle méthode dans le contrôleur
et d'appeler la vue.

Bravo !

## Résumé

En résumé, voici ce que nous savons faire :

- Concevoir et définir un template
- Réutiliser un template pour simplifier la création de nouvelles vues.
- Créer des routes (dont ont peut récupérer des informations pour les
  exploiter).
- Créer des contrôleurs contenant de la logique (méthodes).
- Mener les informations provenant d'une route vers une méthode d'un contrôleur
  en vue de les traiter.
- Envoyer des informations depuis une méthode d'un contrôleur vers une vue.
- Récupérer les informations envoyées par une méthode d'un contrôleur afin de
  les afficher dans une vue.
- Exploiter les données d'un tableau et les mettre en forme dans une vue grâce à
  Blade.
- Ajouter des ressources (image) et les exploiter.
