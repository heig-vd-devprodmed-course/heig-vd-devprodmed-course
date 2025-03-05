# Jour 3

## Objectifs

- Créer un formulaire HTML (vue) pour pouvoir saisir des informations.
- Envoyer les informations du formulaire (requête) à une route
- Rediriger le traitement de la requête (de la route vers le contrôleur)
- Déléguer le traitement de l'affichage du résultat à une vue (du contrôleur à
  une vue)
- Se prémunir contre les attaques de type CSRF (`Cross-Site Request Forgery`)

## Création d'une nouvelle application

Créons une nouvelle application `Laravel` à l'aide de la commande :

```bash
# Terminal
laravel new MonApp3/laravel
```

## <a name="1">Création d'un formulaire (Requête)</a>

Occupons nous maintenant de la création du formulaire HTML basée sur un template
Blade.

Etape 1 : Créer le template (`template_form.blade.php`) sur lequel sera basé
notre vue.

```php
<!-- resources/views/template_form.blade.php -->
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        @yield('contenu')
    </body>
</html>
```

Etape 2 : Créer la vue (`view_form.blade.php`) qui hérite de notre `template`

```php
<!-- resources/views/view_form.blade.php -->
@extends('template_form')

@section('contenu')
<form action="{{ url('traiteFormulaire') }}" method="post" accept-charset="UTF-8">
    @csrf
    <label for="nom">Entrez votre nom : </label>
    <input name="nom" type="text" id="nom">
    <input type="submit" name="submit" value="Envoyer"/>
</form>
@endsection
```

> Remarques : Notez la présence du tag `@csrf` (Nous verrons son rôle plus bas)
> Ainsi que l'attribut `action` du tag `form` : `url('traiteFormulaire')`

Créons une nouvelle route (dans le fichier `\routes\web.php`) pour accéder à
notre formulaire.

```php
<!-- routes/web.php -->
Route::get('/afficheFormulaire', function () {
    return view('view_form');
});
```

Et testons pour voir que tout fonctionne. (Déployons l'application, puis à
l'aide d'un navigateur accédons à l'url `.../afficheFormulaire`)

Un formulaire devrait s'afficher.

## Redirection du traitement de la requête

Nous avons vu lors du dernier cours que ce n'était pas à la route de faire les
traitements mais à un contrôleur. Déléguons cette tâche à un nouveau contrôleur
(`FormController.php`)

Rappel : Pour créer un nouveau contrôleur, il faut taper en ligne de commande :

```bash
# Terminal (à la racine de votre dossier du cours)
php artisan make:controller FormController
```

Le fichier `FormController.php` est disponible dans le répertoire :
`\app\Http\Controllers\`

Ajoutons au contrôleur (`FormController.php`) une nouvelle méthode permettant
d'afficher le formulaire :

```php
<!-- app/Http/Controllers/FormController.php -->
public function afficheForm() {
   return view('view_form');
}
```

Pour que notre code soit fonctionnel, il faut modifier la route `afficheForm`
pour la rediriger vers notre contrôleur.

```php
<!-- routes/web.php -->
use App\Http\Controllers\FormController;
Route::get('/afficheFormulaire', [FormController::class,'afficheForm']);
```

> Attention à ne pas oublier le `use` de `FormController` avec le bon
> `namespace`

Et testons pour voir que tout fonctionne. (Dans votre navigateur tapons l'url
`.../afficheFormulaire`)

L'affichage est le même qu'avant mais notre code est bien mieux structuré.

## Traitement d'un formulaire (Requête)

La partie que nous allons voir maintenant consiste à traiter les informations
d'un formulaire.

Analysons le code de notre formulaire :

```php
<!-- resources/views/view_form.blade.php -->
@extends('template_form')

@section('contenu')
<form action="{{ url('traiteFormulaire') }}" method="post" accept-charset="UTF-8">
    @csrf
    <label for="nom">Entrez votre nom : </label>
    <input name="nom" type="text" id="nom">
    <input type="submit" name="submit" value="Envoyer"/>
</form>
@endsection
```

Dans l'attribut `action` de la balise `form` nous avons le nom de la route à
laquelle nous transmettons les informations du formulaire `traiteFormulaire`, et
l'attribut `method="post"` nous informe sur la manière dont nous transmettons
les informations à la route.

Ajoutons une nouvelle route pour pouvoir récupérer les informations.

```php
<!-- routes/web.php -->
Route::post('traiteFormulaire', [FormController::class,'traiteForm']);
```

C'est bien `Route::post` et non `Route::get` qu'il faut taper !

Ajoutons maintenant une nouvelle méthode dans le contrôleur qui a pour rôle de
traiter les données du formulaire :

```php
<!-- app/Http/Controllers/FormController.php -->
// L'objet $request contiendra les données du formulaire.
public function traiteForm(Request $request) {
   // dd($request); // pour observer le contenu de $request
   return 'Le nom que vous avez saisi est ' . $request->input('nom');
}
```

> Remarque : avec l'instruction `dd($request);` on peut consulter le détail de
> l'objet. (Evidemment, il faut enlever les // pour voir la fonction à œuvre )

Testons maintenant que la soumission du formulaire fonctionne à l'aide de notre
navigateur.

`localhost:3000/afficheFormulaire`

Maintenant que nous savons comment récupérer les informations d'un formulaire,
vous pouvons envoyer l'objet `$request` à une vue.

Modifions le code de la méthode `traiteForm(...)`

```php
<!-- app/Http/Controllers/FormController.php -->
//Remarque : request devient requete (pour une compréhension du méchanisme)
return view('view_resultat')->with('requete', $request);
```

Créons une nouvelle vue (`view_resultat.blade.php`) avec le code suivant :

```php
<!-- resources/views/view_resultat.blade.php -->
@extends('template_form')

@section('contenu')
<div>
    Le nom que vous avez saisi est {{$requete->input('nom')}}
</div>
@endsection
```

Voilà le tour est joué, il n'y a plus qu'à tester le tout.

## Tag Blade @CSRF

Il ne reste plus qu'un petit détail mais qui a son importance, il s'agit du rôle
du tag Blade : `@csrf`

Vous avez peut-être remarqué sa présence dans le formulaire :

```html
<!-- resources/views/view_form.blade.php -->
<form
	action="{{ url('traiteFormulaire') }}"
	method="post"
	accept-charset="UTF-8"
>
	@csrf
	<label for="nom">Entrez votre nom : </label>
	<input name="nom" type="text" id="nom" />
	<input type="submit" name="submit" value="Envoyer" />
</form>
```

Ce tag permet de se prémunir contre les attaques de type
[CSRF](https://fr.wikipedia.org/wiki/Cross-site_request_forgery)

Le tag (`@csrf`) ajoute un jeton (`token`) d’identification dans le formulaire.
Lorsque le formulaire est posté, `Laravel` vérifie que ce jeton soit le même que
celui enregistrée en session. Si ça n’est pas le cas, cela signifie que
quelqu’un a essayé de soumettre le formulaire depuis un autre site. Si tel est
le cas, `Laravel` ne traitera simplement pas ce formulaire.

Pour visualiser ce jeton, il suffit d'afficher le code source de la page du
formulaire (depuis le navigateur, lancer l'app, entrer l'url correspondant au
formulaire, puis demander au navigateur d'afficher le code source de la page.
Nous pouvons maintenant visualiser le `token` (jeton)) :

```html
<!-- Code source de la page -->
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<form
			action="http://.../traiteFormulaire"
			method="post"
			accept-charset="UTF-8"
		>
			<input
				type="hidden"
				name="_token"
				value="4kqZjXOBHo46TALah8zyrhu2v0s6dfScw6nBM5uw"
			/>

			<label for="nom">Entrez votre nom : </label>
			<input name="nom" type="text" id="nom" />
			<input type="submit" name="submit" value="Envoyer" />
		</form>
	</body>
</html>
```

Chaque formulaire que nous créerons devra contenir le tag `@csrf` pour pouvoir
fonctionner correctement.

Nous serons ainsi protégés

## Récapitulatif de ce que nous savons faire

- Concevoir et définir un template.

- Réutiliser un template pour simplifier la création de nouvelles vues.
- Créer des routes pour envoyer les requêtes vers les bonnes méthodes des bons
  contrôleurs.
- Créer des contrôleurs contenant de la logique (méthodes) pour traiter des
  requêtes.
- Envoyer le résultat du traitement d'une requête depuis une méthode d'un
  contrôleur vers une vue.
- Récupérer les informations envoyées par une méthode d'un contrôleur afin de
  les afficher dans une vue.
- Protéger notre site contre les attaques CSRF (`Cross-Site Request Forgery`) à
  l'aide du tag `@csrf`
