# Formulaires et validation

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Voici quelques informations relatives à ce contenu.
>
> **Ressources annexes**
>
> - Autres formats du support de cours : [Présentation (web)][presentation-web]
>   · [Présentation (PDF)][presentation-pdf].
> - Exercices : [Accéder au contenu](./01-exercices/README.md).
> - Mini-projet : [Accéder au contenu](./02-mini-projet/README.md).
>
> **Objectifs**
>
> À l'issue de cette séance, les personnes qui étudient devraient être capables
> de :
>
> - Décrire la partie "contrôleur" du patron de conception MVC.
> - Lister les différentes méthodes HTTP et leur utilisation.
> - Décrire le concept de routes dans une application Laravel.
> - Définir des routes avec des paramètres dans Laravel.
> - Créer des contrôleurs dans Laravel.
> - Utiliser les contrôleurs pour gérer les requêtes HTTP et retourner des
>   réponses.
> - Résumer les concepts du patron MVC, leur rôle dans une application web et
>   les dossiers où les trouver dans une application Laravel.
> - Implémenter ces concepts avec Laravel pour réaliser le petit réseau social
>   du mini-projet.
>
> **Méthodes d'enseignement et d'apprentissage**
>
> Les méthodes d'enseignement et d'apprentissage utilisées pour animer la séance
> sont les suivantes :
>
> - Présentation magistrale.
> - Discussions collectives.
> - Travail en autonomie.
>
> **Méthodes d'évaluation**
>
> L'évaluation prend la forme d'exercices et d'un mini-projet à réaliser en
> autonomie en classe ou à la maison.
>
> L'évaluation se fait en utilisant les critères suivants :
>
> - Capacité à répondre avec justesse.
> - Capacité à argumenter.
> - Capacité à réaliser les tâches demandées.
> - Capacité à s'approprier les exemples de code.
> - Capacité à appliquer les exemples de code à des situations similaires.
>
> Les retours se font de la manière suivante :
>
> - Corrigé des exercices.
> - Corrigé du mini-projet.
>
> L'évaluation ne donne pas lieu à une note.

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Les formulaires, un rappel](#les-formulaires-un-rappel)
  - [Structure d'un formulaire](#structure-dun-formulaire)
  - [Les attributs d'un formulaire](#les-attributs-dun-formulaire)
  - [Envoyer les données d'un formulaire](#envoyer-les-données-dun-formulaire)
  - [Recevoir les données d'un formulaire](#recevoir-les-données-dun-formulaire)
- [Les sessions, un rappel](#les-sessions-un-rappel)
- [Les formulaires dans Laravel](#les-formulaires-dans-laravel)
  - [Actions et méthodes HTTP des formulaires](#actions-et-méthodes-http-des-formulaires)
  - [Se protéger contre les attaques CSRF](#se-protéger-contre-les-attaques-csrf)
  - [Le rôle du token CSRF](#le-rôle-du-token-csrf)
  - [Le rôle de l'APP\_KEY dans les sessions et la protection CSRF](#le-rôle-de-lapp_key-dans-les-sessions-et-la-protection-csrf)
  - [Validation des données de formulaire](#validation-des-données-de-formulaire)
  - [Accéder aux données de formulaire dans les contrôleurs](#accéder-aux-données-de-formulaire-dans-les-contrôleurs)
  - [Gérer les fichiers téléchargés via un formulaire](#gérer-les-fichiers-téléchargés-via-un-formulaire)
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [Questions d'évaluation](#questions-dévaluation)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs de permettre aux personnes qui étudient de
maîtriser les concepts liés aux formulaires et à la validation dans le
développement d'applications web avec Laravel.

Ce contenu repose sur la documentation officielle suivante :

- <https://laravel.com/docs/12.x/csrf> et ses sous-sections.
- <https://laravel.com/docs/12.x/validation> et ses sous-sections.
- <https://laravel.com/docs/12.x/session> et ses sous-sections.
- <https://laravel.com/docs/12.x/encryption> et ses sous-sections.
- <https://laravel.com/docs/12.x/filesystem> et ses sous-sections.

La liste complète des objectifs est disponible dans la section _"Objectifs"_ du
bloc d'information en haut de ce contenu.

## Les formulaires, un rappel

Un formulaire est un élément HTML qui permet de collecter des données auprès des
utilisateur.trice.s et de les envoyer au serveur pour traitement.

Les formulaires sont essentiels pour permettre aux utilisateur.trice.s
d'interagir avec une application web, que ce soit pour créer du contenu, mettre
à jour des informations, ou effectuer des actions spécifiques.

### Structure d'un formulaire

Un formulaire se compose généralement de plusieurs éléments, tels que des champs
de texte, des boutons de soumission, des cases à cocher, des listes déroulantes,
etc. :

```html
<form action="/posts" method="POST">
	<label for="title">Titre du post</label>
	<input type="text" name="title" id="title" placeholder="Titre du post" />

	<label for="content">Contenu du post</label>
	<textarea
		name="content"
		id="content"
		placeholder="Contenu du post"
		required
		minlength="10"
	></textarea>

	<button type="submit">Créer le post</button>
</form>
```

Ici, le formulaire est composé des éléments suivants :

- Un champ de texte `<input type="text">` pour le titre du post.
- Un champ de texte multiligne `<textarea>` pour le contenu du post.
- Un bouton de soumission `<button type="submit">` pour envoyer les données au
  serveur.

La liste des différents types de champs de formulaire est disponible dans la
documentation officielle de MDN :
<https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input>.

### Les attributs d'un formulaire

Les formulaires peuvent comporter différents attributs pour définir leur
comportement et leurs contraintes. Par exemple :

- Des attributs tels que `action` et `method` qui définissent respectivement
  l'URL de destination des données et la méthode HTTP utilisée pour l'envoi.
- Des attributs de validation HTML5 tels que `required` et `minlength` pour
  indiquer que le champ est obligatoire et a une longueur minimale.
- Chaque champ est associé à un label `<label>` pour améliorer l'accessibilité
  et la compréhension du formulaire. L'attribut `for` du label doit correspondre
  à l'attribut `id` du champ de formulaire pour établir une association claire
  entre eux.

Il est important de noter que les attributs de validation HTML5 sont une
première ligne de défense pour garantir que les données envoyées par les
utilisateur.trice.s sont conformes aux attentes. Cependant, ils ne sont pas
suffisants pour assurer la sécurité et la robustesse de l'application. C'est
pourquoi il est essentiel de mettre en place une validation côté serveur.

### Envoyer les données d'un formulaire

L'attribut `action` d'un formulaire définit l'URL vers laquelle les données du
formulaire seront envoyées lorsque l'utilisateur soumet le formulaire.

L'attribut `method` définit la méthode HTTP utilisée pour envoyer les données,
généralement `POST`. Par défaut, les navigateurs n'envoient que les méthodes
`GET` et `POST` via les formulaires HTML.

L'attribut `name` de chaque champ de formulaire est crucial, car il définit la
clé sous laquelle les données seront accessibles côté serveur. Par exemple, si
un champ a `name="title"`, alors la valeur saisie dans ce champ sera accessible
côté serveur via la clé `title`.

### Recevoir les données d'un formulaire

Lorsque les données d'un formulaire sont envoyées au serveur, elles sont
généralement accessibles dans le code de l'application via des objets ou des
tableaux associatifs.

En Programmation serveur 1 et 2, nous avons vu comment accéder aux données d'un
formulaire en utilisant les superglobales PHP `$_GET` et `$_POST`.

Lorsque les données d'un formulaire sont envoyées au serveur, il faut également
les valider pour s'assurer qu'elles sont conformes aux attentes de l'application
et les protéger contre les attaques potentielles (ex : injection SQL, XSS,
etc.).

Nous étudierons dans cette séance comment accéder aux données d'un formulaire
dans le contexte d'une application Laravel, en utilisant les objets de requête
et les méthodes de validation intégrées.

## Les sessions, un rappel

Une session est un mécanisme qui permet de stocker des données spécifiques à
un.e utilisateur.trice sur le serveur, et de les associer à une session unique
via un cookie de session.

Les sessions sont utilisées pour maintenir l'état de l'utilisateur.trice entre
les différentes requêtes HTTP, qui sont par nature sans état (stateless). Elles
permettent de stocker des informations telles que les données
d'authentification, les préférences de l'utilisateur.trice.trice, ou les
messages flash.

## Les formulaires dans Laravel

Les formulaires dans Laravel ressemblent à des formulaires HTML classiques, mais
Laravel fournit des fonctionnalités supplémentaires pour faciliter leur gestion,
notamment la validation des données et la protection contre les attaques CSRF.

Ils sont gérés à l'aide de plusieurs concepts clés, notamment les routes, les
contrôleurs, la validation des données, et la protection contre les attaques
CSRF. Nous allons explorer chacun de ces concepts en détail.

### Actions et méthodes HTTP des formulaires

Lors de la création d'un formulaire, l'action (attribut `action`) permet de
spécifier l'URL vers laquelle les données du formulaire seront envoyées. Cette
URL doit correspondre à une route définie dans Laravel. Par exemple, si nous
avons un formulaire pour créer un post, l'action pourrait être définie comme
suit :

```html
<form action="/posts" method="POST">
	<!-- Champs du formulaire -->
</form>
```

Dans cet exemple, les données du formulaire seront envoyées à l'URL `/posts`.

En plus de l'URL, il est également important de spécifier la méthode HTTP
utilisée pour envoyer les données du formulaire (attribut `method`). La méthode
la plus courante pour les formulaires de création est `POST`, qui indique que
les données doivent être envoyées au serveur pour créer une nouvelle ressource,
comme présenté dans l'exemple précédent.

Il est important de noter que les navigateurs n'envoient que les méthodes `GET`
et `POST` via les formulaires HTML. Cependant, Laravel permet de simuler
d'autres méthodes HTTP (comme `PUT`, `PATCH`, ou `DELETE`) en utilisant un champ
caché `_method` dans le formulaire. Par exemple, pour simuler une requête
`DELETE`, nous pourrions faire :

```html
<form action="/posts/1" method="POST">
	<input type="hidden" name="_method" value="DELETE" />
	<button type="submit">Supprimer le post</button>
</form>
```

Dans cet exemple, même si la méthode du formulaire est `POST`, Laravel traitera
la requête comme une requête `DELETE` grâce au champ caché `_method`.
L'utilisation du type de champ `hidden` permet de masquer ce champ aux
utilisateur.trice.s, tout en permettant à Laravel de détecter la méthode HTTP
souhaitée.

Afin de ne pas devoir ajouter manuellement ce champ caché à chaque formulaire,
Laravel propose une directive Blade `@method` qui génère automatiquement ce
champ pour simuler la méthode HTTP souhaitée. Par exemple, pour simuler une
requête `DELETE`, nous pourrions faire :

```html
<form action="/posts/1" method="POST">
	@method('DELETE')

	<button type="submit">Supprimer le post</button>
</form>
```

Dans cet exemple, la directive `@method('DELETE')` génère automatiquement le
champ caché nécessaire pour que Laravel traite la requête comme une requête
`DELETE`.

Il est donc nécessaire de faire correspondre l'action du formulaire à une route
définie dans Laravel, et de spécifier la méthode HTTP appropriée pour que les
données du formulaire soient traitées correctement par l'application.

En utilisant l'exemple précédent, si nous avons une route définie comme suit
dans Laravel :

```php
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
```

Alors, lorsque le formulaire est soumis, Laravel traitera la requête comme une
requête `DELETE` vers l'URL `/posts/1`, et exécutera la méthode `destroy` du
`PostController` pour supprimer le post avec l'ID 1.

Le corps de la méthode `destroy` pourrait ressembler à ceci :

```php
public function destroy(string $id)
{
    Post::destroy($id);

    return to_route('posts.index');
}
```

Dans cet exemple, la méthode `destroy` utilise la méthode statique `destroy` du
modèle `Post` pour supprimer le post avec l'ID spécifié, puis redirige
l'utilisateur.trice vers la liste des posts.

### Se protéger contre les attaques CSRF

Les attaques CSRF (Cross-Site Request Forgery) sont des attaques où un.e
attaquant.e tente de faire exécuter une action non désirée sur une application
web par un utilisateur.trice authentifié.e.

Imaginons la situation suivante : un.e utilisateur.trice est connecté.e à une
application web et visite un site malveillant dans un autre onglet de son
navigateur. Ce site malveillant contient un formulaire caché qui envoie une
requête pour supprimer le compte de l'utilisateur.trice sur l'application web.
Si l'utilisateur.trice soumet ce formulaire (même involontairement), la requête
sera envoyée à l'application web avec les cookies d'authentification de
l'utilisateur.trice, ce qui pourrait entraîner la suppression de son compte.

### Le rôle du token CSRF

### Le rôle de l'APP_KEY dans les sessions et la protection CSRF

### Validation des données de formulaire

#### Messages d'erreur et traductions

### Accéder aux données de formulaire dans les contrôleurs

### Gérer les fichiers téléchargés via un formulaire

## Conclusion

TODO

## Exercices

Nous vous invitons maintenant à réaliser les exercices de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les exercices et leur corrigé ici :
[Exercices](./01-exercices/README.md).

## Mini-projet

Nous vous invitons maintenant à réaliser le mini-projet de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les détails du mini-projet ici :
[Mini-projet](./02-mini-projet/README.md).

## Questions d'évaluation

> [!NOTE]
>
> Les questions d'évaluation sont destinées à vous aider à vérifier votre
> compréhension des concepts abordés dans le cours. Elles ne sont pas destinées
> à être utilisées comme une liste de contrôle exhaustive des compétences à
> maîtriser.
>
> Il est recommandé de les utiliser comme un guide pour vous aider à identifier
> les domaines dans lesquels vous pourriez avoir besoin de renforcer vos
> connaissances ou de pratiquer davantage.

- Quel est le rôle des vues dans le patron de conception MVC ?
- Quels sont les avantages d'utiliser un moteur de template par rapport à du PHP
  pur dans le HTML ?
- Pourquoi est-il important de mettre en place l'internationalisation dès le
  début du développement, même pour une application monolingue ?
- Comment créer une vue Blade avec la commande Artisan ?
- Comment passe-t-on du contenu à un composant Blade ?
- Quelle est la différence entre un slot par défaut et un slot nommé ?
- Comment créer un composant Blade avec Artisan ?
- Pourquoi utilise-t-on le préfixe `:` devant certains attributs de composants
  (ex : `:post="$post"`) ?
- À quoi servent les variables `APP_LOCALE` et `APP_FALLBACK_LOCALE` ?
- Quelle est la différence entre un fichier de traduction PHP et un fichier JSON
  ?
- Comment accède-t-on à une traduction dans une vue Blade ?
- Comment gère-t-on les formes plurielles dans les traductions Laravel ?
- Quelle est la différence entre les fichiers `.env` et `.env.example` ?
- Pourquoi ne doit-on jamais commiter le fichier `.env` dans Git ?
- Quelle fonction doit-on utiliser pour accéder aux configurations dans le code
  de l'application (en dehors des fichiers de configuration) ?
- Quelle est la différence entre l'approche CSS classique et l'approche
  utility-first de Tailwind ?

## À faire pour la prochaine séance

Chaque personne est libre de gérer son temps comme elle le souhaite. Cependant,
il est recommandé pour la prochaine séance de :

- Relire le support de cours si nécessaire.
- Finaliser les exercices qui n'ont pas été terminés en classe.
- Finaliser la partie du mini-projet qui n'a pas été terminée en classe.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
[presentation-web]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/06-formulaires-et-validation/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/06-formulaires-et-validation/06-formulaires-et-validation-presentation.pdf
