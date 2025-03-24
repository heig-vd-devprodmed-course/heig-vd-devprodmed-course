# Questionnaire 3

1.) En quoi consiste une attaque de type `CSRF` ?

> [Explications détaillées](https://fr.wikipedia.org/wiki/Cross-site_request_forgery)

2.) Que doit-on mettre dans un formulaire pour se protéger contre les attaques
de type `CSRF` ?

> Il faut insérer le tag Blade `@csrf` juste après l'entête d'un formulaire
>
> ```php
> <form action="{{ url('traiteFormulaire') }}" method="post" accept-charset="UTF-8">
>     @csrf
>     <label for="nom">Entrez votre nom : </label>
>     <input name="nom" type="text" id="nom">
>     <input type="submit" name="submit" value="Envoyer"/>
> </form>
> ```

3.) Comment fonctionne cette protection ?

> Le moteur Blade "injecte" dans le formulaire un champ caché contenant un jeton
> (`token`) dont la valeur est une chaîne de caractère aléatoire unique.
>
> ​ Remarque : Pour voir ce jeton, il suffit de demander au navigateur
> d'afficher le code source de la page lorsque le formulaire est affiché.
>
> ```html
> <form
> 	action="http://localhost:8000/.../traiteFormulaire"
> 	method="post"
> 	accept-charset="UTF-8"
> >
> 	/////////////////////////////////////////////////////////////////
> 	<input
> 		type="hidden"
> 		name="_token"
> 		value="AKUEadiLLClgLuc4fZzyzdTu0uSfJFZXhPuLNi8q"
> 	/>
> 	/////////////////////////////////////////////////////////////////
>
> 	<label for="nom">Entrez votre nom : </label>
> 	<input name="nom" type="text" id="nom" />
> 	<input type="submit" name="submit" value="Envoyer" />
> </form>
> ```
>
> Une fois que les données du formulaires sont envoyées au serveur, celui-ci
> peut contrôler que le champ caché contient bien le jeton qu'il a injecté
> précédemment.

4.) Quelle différence y-a-t'il entre une route commençant par :
`Route::get(...)` et une `Route::post(...)`

> La méthode `GET` permet de récupérer les informations contenues dans l'URL du
> navigateur.
>
> La méthode `POST` permet de récupérer les informations provenant d'un
> formulaire.
>
> ###### Table de comparaison
>
> | GET                                                                                                                                                                              | POST                                                                                                                                         |
> | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | :------------------------------------------------------------------------------------------------------------------------------------------- |
> | Dans le cas d’une requête GET, seule une quantité limitée de données peut être envoyée car les données sont envoyées dans l’en-tête.                                             | En cas de requête POST, une grande quantité de données peut être envoyée car les données sont envoyées dans le corps.                        |
> | La requête GET n’est pas sécurisée car les données sont exposées dans la barre d’URL.                                                                                            | La requête POST est sécurisée car les données ne sont pas exposées dans la barre d’URL.                                                      |
> | La requête GET est plus efficace et utilisé plus que POST.                                                                                                                       | La requête POST est moins efficace et utilisée moins que GET.                                                                                |
> | Les paramètres restent dans l’historique du navigateur car ils font partie de l’URL                                                                                              | Les paramètres ne sont pas enregistrés dans l’historique du navigateur.                                                                      |
> | Les requêtes GET sont ré-exécutées mais ne peuvent pas être soumises au serveur si le code HTML est stocké dans la mémoire cache du navigateur.                                  | Le navigateur prévient généralement l’utilisateur que les données devront être soumises à nouveau                                            |
> | Seuls les caractères ASCII sont autorisés.                                                                                                                                       | Pas de restrictions. Les données binaires sont également autorisées.                                                                         |
> | GET est moins sécurisé que POST car les données envoyées font partie de l’URL. Donc, il est enregistré dans l’historique du navigateur et les journaux du serveur en texte brut. | POST est un peu plus sûr que GET car les paramètres ne sont pas stockés dans l’historique du navigateur ou dans les journaux du serveur Web. |
> | La méthode GET ne doit pas être utilisée lors de l’envoi de mots de passe ou d’autres informations sensibles.                                                                    | Méthode POST utilisée lors de l’envoi de mots de passe ou d’autres informations sensibles.                                                   |
> | La méthode GET est visible par tout le monde (elle sera affichée dans la barre d’adresse du navigateur) et limite le nombre d’informations à envoyer.                            | Les variables de méthode POST ne sont pas visibles dans l’URL.                                                                               |
> | Peut être mis en cache                                                                                                                                                           | Ne peut être mis en cache                                                                                                                    |

5.) Comment se nomme l'objet permettant de récupérer les données d'un formulaire
?

> L'objet est de type `Request` et on peut nommer la variable (qui y fait
> référence) comme on veut :wink: (Dans les exemples réalisés, il se nomme :
> `$request`)

6.) Quelle instruction permet de récupérer la valeur du champ `"prenom"` d'un
formulaire ?

> A l'aide d'un `getter`
>
> ```
> $request->input('prenom');
> ```
>
> ou directement via la propriété
>
> ```
> $request->prenom;
> ```

7.) Peut-on récupérer les informations d'un formulaire dans une route ? (Si oui,
comment ?, Si non, pourquoi ?)

> Oui, c'est possible. Il suffit d'utiliser un paramètre de type `Request` pour
> récupérer la requête (données des champs du formulaire) de l'utilisateur.
>
> Exemple :
>
> ```php
> use Illuminate\Http\Request; // ne pas oublier d'indiquer où est la classe Request !
>
> Route::post('traiteFormulaire', function (Request $request) {
> 	dd($request->all()); // P.S. On voit notre jeton :-) (token)
> });
> ```
