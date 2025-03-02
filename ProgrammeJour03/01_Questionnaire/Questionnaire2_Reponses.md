Questionnaire 2
---------------

1.)	Qu'est ce qu'un `template` Blade et à quoi cela sert-il ?

> Cela correspond à un modèle que l'on peut réutiliser.
> ​Cela permet d'éviter de répéter du code (d'où moins d'erreur et gain de temps).

2.)	Comment se nomme le "tag" permettant d'injecter du code dans un `template` ?

> `@yield`

3.)	Qu'est-ce qu'un contrôleur ?

> Un contrôleur est une classe contenant des méthodes.

4.)	A quoi sert le contrôleur ?

> Un contrôleur permet de préparer les données devant être affichée par une vue et de centraliser le traitement de données provenant de formulaires.

5.)	Quelle commande artisan permet de créer un contrôleur ?

> `php artisan make:controller NomDuControlleur`

6.)	Que doit-on ajouter dans le contrôleur pour qu'il fonctionne ?

> Il faut lui ajouter des méthodes (appelées par les routes)

7.)	Comment "lier" une route à une méthode d'un contrôleur ?

> `Route::get('afficheForm', [NomController::class, 'afficheForm']);`
> 				                 	         `         ^ contrôleur ^          ^ méthode ^`
>
> Remarque : Attention à ne pas oublier la clause `use` pour la classe `NomController`

8.)	Comment envoie-t-on des paramètres de la route au contrôleur ?

> Cela se fait automatiquement (Il n'y a rien a faire ;-)

9.)	Comment récupère-t-on les paramètres envoyés par la route dans le contrôleur ?

> Grâce aux paramètres de la méthode. 
> Remarque : Il ne doivent pas forcément se nommer de la même manière que dans la route !
>
> ​		Exemple de route appelant la méthode `test` du contrôleur `MonController` 	
>
> ```php
> Route ::get('article/{n}/couleur/{c}', [MonController::class, 'test']);
> ```
>
> ​		Méthode `test(...)` du contrôleur `MonController` : 
>
> ```php
> //...	
> 
> // $n reçoit la première valeur envoyée (celle de {n})
> // $a reçoit la seconde valeur envoyée (celle de {c})
> public function test($n, $a) {
> 	return $n . " : " .$a;
> }
> 
> //...
> ```

10.)  Comment envoie-t-on des paramètres du contrôleur à la vue ?

> Avec
>
> ```php
> ->with('nomDuParametreDansVue', $nomDuParametreAEnvoyer)
> ```
>
> Ex :
>
> ```php
> return view('maVue2')->with('artistes', $artistes);
> ```
>
> 
>
> Remarque : 
> `nomDuParametreDansVue` peut être différent de `$nomDuParametreAEnvoyer`
> Ex :
>
> ```php
> return view('maVue2')->with('lesArtistes', $artistes);
> ```



11.). Comment récupère-t-on les paramètres envoyés par le contrôleur dans la vue ?

> ​		Avec :
>
> ```php
> 	{{$nomDuParametreDansVue}}
> ```

12.)  A l'aide de quelles instructions peut-on construire dynamiquement une vue ?

> A l'aide des directives Blade : 
> 	 Avec	 `@foreach`
> 	      		`@for`
> 		  		`@if`
> 		  		`@...`
>
> Documentation : [Directives Blade](https://laravel.com/docs/9.x/blade#blade-directives)

