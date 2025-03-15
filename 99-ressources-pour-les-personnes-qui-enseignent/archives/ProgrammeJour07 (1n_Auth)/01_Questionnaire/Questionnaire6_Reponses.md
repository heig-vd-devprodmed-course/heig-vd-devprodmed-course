# Questionnaire 6

1.) Comment crée-t-on un contrôleur de type ressource ?

> ```
> php artisan make:controller UserController --resource
> ```

2.) Quelles méthodes se trouvent dans ce type de contrôleur ?

> - `index()`
> - `create()`
> - `store()`
> - `show()`
> - `edit()`
> - `update()`
> - `destroy()`

3.) Quel est le rôle de chacune de ces méthodes ?

> - `index()` : pour nous permettre d'afficher toutes les données
> - `create()` : pour renvoyer un formulaire permettant la saisie de données
> - `store()` : pour sauvegarder les données
> - `show()` : pour afficher des données
> - `edit()` : pour pouvoir renvoyer un formulaire permettant de modifier les
>   données
> - `update()` : pour pouvoir modifier des données
> - `destroy()` : pour pouvoir détruire des données

4.) Combien de routes (au minimum) doit-on créer pour accéder aux méthodes du
contrôleur ?

> ​ une seule route !
>
> ```
> Route::resource('nomRoute', NomDuControleur::class);
> ```

5.) Quelle commande `php artisan` permet de lister toutes les routes d'un projet
`Laravel` ?

> ```
> php artisan route:list
> ```

6.) Quelle méthode de quelle classe permet d'encoder un mot de passe pour qu'on
ne puisse pas le lire en clair dans la base de donnée ?

> La méthode : `make()` La classe : `Hash`
>
> (Voir la classe `app\Http\Models\User.php`)

7.) Dans les vues que nous avons créé lors du dernier cours, à quoi sert
l'instruction : {!! $links !!}

> A afficher une barre permettant d'accéder aux autres données.
> ([Données paginées](https://laravel.com/docs/11.x/pagination)) Ne s'affiche
> que s'il y a plus de quatre utilisateurs dans notre cas ;-)

8.) Quelle modification doit-on apporter et dans quel fichier pour que chaque
`page` contienne 5 utilisateurs au lieu de 4 ?

> C'est dans le fichier `UserController`, il suffit de modifier la ligne :
> ​`User::paginate(4);` ​par ​`User::paginate(5);`

9.) A quoi doit-on veiller lors de la gestion d'une case à cocher ?

> Comme l'information n'est transmise que si la case est cochée, il faut faire
> un traitement spécial. (Voir la classe `UserController` méthode
> `private function setAdmin()`)
