# Architecture RESTful

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
>   · [Présentation (PDF)][presentation-pdf]
> - Exercices : [Accéder au contenu](./01-exercices/README.md)
> - Mini-projet : [Accéder au contenu](./02-mini-projet/README.md)
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
- [Introduction aux contrôleurs dans le patron MVC](#introduction-aux-contrôleurs-dans-le-patron-mvc)
- [Rappels sur le protocole HTTP](#rappels-sur-le-protocole-http)
  - [Ressources](#ressources)
  - [Requêtes et réponses HTTP](#requêtes-et-réponses-http)
  - [Méthodes HTTP](#méthodes-http)
  - [En-têtes HTTP](#en-têtes-http)
  - [Corps de requête/réponse](#corps-de-requêteréponse)
- [Routes](#routes)
- [Paramètres de route](#paramètres-de-route)
- [Contrôleurs](#contrôleurs)
  - [Créer un contrôleur](#créer-un-contrôleur)
  - [Associer une route à un contrôleur](#associer-une-route-à-un-contrôleur)
  - [Gérer les requêtes HTTP dans un contrôleur](#gérer-les-requêtes-http-dans-un-contrôleur)
  - [Retourner des réponses HTTP depuis un contrôleur](#retourner-des-réponses-http-depuis-un-contrôleur)
- [Tester les routes et les contrôleurs](#tester-les-routes-et-les-contrôleurs)
- [Gérer les erreurs dans les contrôleurs](#gérer-les-erreurs-dans-les-contrôleurs)
- [Le patron MVC : récapitulatif](#le-patron-mvc--récapitulatif)
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [Questions d'évaluation](#questions-dévaluation)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs de permettre aux personnes qui étudient de
maîtriser la création de routes avec des paramètres et l'utilisation de
contrôleurs dans Laravel afin de gérer les requêtes HTTP et de retourner des
réponses appropriées, en coordination avec les modèles et les vues.

Ce contenu repose sur la documentation officielle suivante :

- <https://laravel.com/docs/12.x/routing> et ses sous-sections.
- <https://laravel.com/docs/12.x/requests> et ses sous-sections.
- <https://laravel.com/docs/12.x/responses> et ses sous-sections.
- <https://laravel.com/docs/12.x/controllers> et ses sous-sections.
- <https://laravel.com/docs/12.x/errors> et ses sous-sections.

La liste complète des objectifs est disponible dans la section _"Objectifs"_ du
bloc d'information en haut de ce contenu.

## Introduction aux contrôleurs dans le patron MVC

Le patron de conception MVC (Model-View-Controller) sépare une application en
trois composants principaux. Lors d'une séance précédentes, nous avons déjà
abordé les modèles (Model) - qui représentent les données et la logique métier
de l'application - ainsi que les vues (View) - qui sont responsables de la
présentation des données à la personne qui utilise l'application. Dans cette
séance, nous allons nous concentrer sur les contrôleurs (Controller), qui sont
responsables de la gestion des requêtes HTTP et du flux de l'application.

Dans le patron MVC, les contrôleurs ont pour responsabilité de :

- Recevoir les requêtes HTTP.
- Interagir avec les modèles pour récupérer ou manipuler des données.
- Appeler les vues pour afficher les résultats.
- Retourner des réponses HTTP appropriées.

Les contrôleurs agissent comme un pont entre les vues et les modèles, en gérant
les interactions entre ces deux composants.

## Rappels sur le protocole HTTP

Le protocole HTTP est le protocole de communication utilisé pour les
applications web. Ce protocole utilise plusieurs termes clés, notamment :

- Les ressources.
- Les requêtes et réponses HTTP.
- Les méthodes HTTP.
- Les en-têtes HTTP.
- Les corps de requête/réponse.

### Ressources

Une ressource est une entité identifiable dans une application web, généralement
représentée par une URL.

Par exemple, la fiche d'unité de ce cours sur GAPS à l'adresse suivante :
<https://gaps.heig-vd.ch/consultation/fiches/uv/uv.php?id=6082>.

Cette URL représente une ressource spécifique à l'aide de :

- Un protocole (`https://`).
- Un nom de domaine (`gaps.heig-vd.ch`).
- Un chemin d'accès (`/consultation/fiches/uv/uv.php`).
- Des paramètres de requête (`?id=6082`).

Cette URL permet d'accéder à une ressource spécifique, qui est la fiche de
l'unité d'enseignement "Développement de produit média (DévProdMéd)". Lorsque
quelqu'un accède à cette URL, une requête HTTP est envoyée au serveur, qui
traite la requête et retourne une réponse contenant les données de la fiche de
l'unité d'enseignement.

Autre exemple, dans notre application de réseau social, les ressources
pourraient être les utilisateur.trices, les publications, les commentaires, etc.
Chaque ressource peut être manipulée à l'aide de différentes méthodes HTTP.

La structure des ressources sont souvent conçue à partir de la base de données
et des modèles Laravel pour refléter cette organisation des ressources, ce qui
facilite la gestion des données et la création de routes correspondantes.

Les ressources sont généralement organisées de manière hiérarchique dans les
URL. Par exemple, une URL pour accéder à une publication spécifique pourrait
ressembler à `/posts/123`, où `123` est l'identifiant de la publication.

Les ressources sont parfois appelées "endpoints" ou "routes" dans le contexte
des applications web, mais il est important de comprendre que les ressources
font référence aux entités manipulées par l'application, tandis que les routes
font référence aux chemins d'URL qui permettent d'accéder à ces ressources.

### Requêtes et réponses HTTP

HTTP est basé sur un modèle de requête-réponse, où le client envoie une requête
au serveur, et le serveur répond avec une réponse. Le corps de la requête ou de
la réponse contient les données envoyées par le client ou le serveur.

Par exemple, lors de la création d'une nouvelle publication, les données de la
publication seraient incluses dans le corps de la requête `POST`.

Ainsi, lorsqu'une personne qui utilise l'application effectue une action (comme
cliquer sur un lien ou soumettre un formulaire), une requête HTTP est envoyée au
serveur, qui est ensuite traitée par un contrôleur pour déterminer la réponse
appropriée à retourner.

La réponse peut être une page HTML, des données JSON, une redirection vers une
autre URL, ou tout autre type de réponse HTTP.

### Méthodes HTTP

Les méthodes HTTP sont des verbes qui indiquent l'action à effectuer sur une
ressource. Les méthodes les plus courantes sont :

- **`GET`** : Récupérer une ressource ou une collection de ressources.
- **`POST`** : Créer une nouvelle ressource.
- **`PUT`** ou **`PATCH`** : Mettre à jour une ressource.
- **`DELETE`** : Supprimer une ressource.

Par exemple, pour récupérer une publication spécifique, on utiliserait une
requête `GET` sur l'URL `/posts/123`. Pour créer une nouvelle publication, on
utiliserait une requête `POST` sur l'URL `/posts` avec les données de la
publication dans le corps de la requête.

Pour rappel, un navigateur web envoie des requêtes `GET` lorsqu'on accède à une
URL, et des requêtes `POST` lorsqu'on soumet un formulaire par défaut.

Si l'on souhaite utiliser les autres méthodes HTTP (`PUT`, `PATCH`, `DELETE`),
il est nécessaire de configurer les formulaires HTML pour simuler ces requêtes
ou passer par du JavaScript.

### En-têtes HTTP

Les en-têtes HTTP sont des paires clé-valeur qui fournissent des informations
supplémentaires sur la requête ou la réponse. Par exemple, les en-têtes peuvent
indiquer le type de contenu, les informations d'authentification, les
préférences de langue, etc.

Par exemple, un en-tête `Content-Type: application/json` indique que le corps de
la requête ou de la réponse est au format JSON.

### Corps de requête/réponse

Le corps de la requête ou de la réponse contient les données envoyées par le
client ou le serveur. Par exemple, lors de la création d'une nouvelle
publication, le corps de la requête `POST` pourrait contenir les données de la
publication au format JSON ou en tant que données de formulaire.

## Routes

Comme évoqué précédemment, les routes sont les chemins d'URL qui permettent
d'accéder à des ressources spécifiques dans une application web. Dans Laravel,
les routes sont généralement définies dans les fichiers de routes situés dans le
répertoire `routes/`, avec `web.php` pour les routes web et `api.php` pour les
routes d'API (que nous étudierons plus tard dans le cours).

Les routes permettent de définir les URL de l'application et de les associer à
des actions spécifiques à l'aide des méthodes HTTP.

Par exemple, issu du dernier contenu, nous avions défini une route pour afficher
un profil d'utilisateur :

```php
Route::get('/profile', function () {
    $user = User::where('username', 'janedoe')->first();

    $posts = Post::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->with(['user', 'likes'])
        ->get();

    return view('profile', ['user' => $user, 'posts' => $posts]);
});
```

La route ci-dessus répond à une requête GET sur l'URL `/profile` et exécute une
fonction anonyme qui récupère les données nécessaires et retourne une vue.

Nous pouvons également définir des routes pour d'autres actions, comme la
création d'une nouvelle publication, la récupération d'une publication
spécifique, la mise à jour d'une publication, etc.

## Paramètres de route

Les routes peuvent également inclure des paramètres, qui sont des parties
dynamiques de l'URL. Par exemple, une route pour afficher un profil spécifique
pourrait ressembler à ceci :

```php
Route::get('/profile/{username}', function ($username) {
    $user = User::where('username', $username)->first();

    $posts = Post::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->with(['user', 'likes'])
        ->get();

    return view('profile', ['user' => $user, 'posts' => $posts]);
});
```

Dans cet exemple, `{username}` est un paramètre de route qui capture la partie
de l'URL correspondant au nom d'utilisateur. Lorsque quelqu'un accède à une URL
comme `/profile/janedoe`, la valeur `janedoe` est capturée et passée à la
fonction anonyme en tant que variable `$username`.

Lors de la requête HTTP GET de l'URL `/profile/janedoe`, la fonction anonyme
récupère l'utilisateur avec le nom d'utilisateur `janedoe` et les publications
associées à cet utilisateur, puis retourne la vue `profile` avec ces données en
tant que réponse HTTP.

La réponse HTTP contiendra alors une page HTML affichant le profil de
l'utilisateur.trice avec le nom d'utilisateur.trice correspondant à la valeur du
paramètre de route ainsi que les publications associées à cet utilisateur.trice.

Il est possible de valider les paramètres de route en utilisant des expressions
régulières et/ou des fonctions spécifiques pour s'assurer qu'ils correspondent à
un format spécifique. Par exemple, pour s'assurer que le paramètre `username` ne
contient que des lettres, des chiffres et des tirets, on pourrait ajouter une
contrainte à la route :

```php
Route::get('/profile/{username}', function ($username) {
    // ...
})->where('username', '[A-Za-z0-9\-]+');
```

Ici, la méthode `where` est utilisée pour définir une contrainte sur le
paramètre `username`, indiquant qu'il doit correspondre à l'expression régulière
spécifiée.

Si une URL ne correspond pas à la route définie (par exemple, si le paramètre
`username` contient des caractères interdits), Laravel retournera une réponse
404 Not Found.

Cela permet de s'assurer que les routes sont utilisées de manière appropriée et
que les données reçues sont valides avant de les traiter dans le contrôleur.

La documentation officielle de Laravel fournit plus de détails sur les routes et
les paramètres de route, y compris la possibilité d'utiliser des paramètres
optionnels, des groupes de routes, des préfixes de route, etc. :
<https://laravel.com/docs/12.x/routing#route-parameters>.

## Contrôleurs

Bien qu'il serait possible de gérer toutes les routes/requêtes de cette manière,
cela peut rapidement devenir difficile à maintenir et à organiser. C'est là que
les contrôleurs entrent en jeu.

Cependant, dans une application plus complexe, il est préférable de déléguer la
logique de gestion des requêtes à des contrôleurs dédiés plutôt que d'utiliser
des fonctions anonymes dans les fichiers de routes. Cela permet de mieux
organiser le code et de respecter le patron MVC.

De cette manière, chaque contrôleur peut être responsable d'un ensemble de
fonctionnalités liées à une ressource spécifique (par exemple, un
`PostController` pour gérer les publications, un `UserController` pour gérer les
utilisateurs, etc.), ce qui facilite la maintenance et la compréhension du code.

### Créer un contrôleur

TODO

### Associer une route à un contrôleur

TODO

### Gérer les requêtes HTTP dans un contrôleur

TODO

### Retourner des réponses HTTP depuis un contrôleur

TODO

## Tester les routes et les contrôleurs

Il est important de tester les routes et les contrôleurs pour s'assurer qu'ils
fonctionnent correctement.

Laravel fournit des outils pour faciliter les tests, notamment la possibilité de
simuler des requêtes HTTP et de vérifier les réponses. Les tests peuvent être
écrits en utilisant PHPUnit, qui est intégré à Laravel.

La documentation officielle de Laravel fournit une section détaillée sur les
tests, y compris comment tester les routes et les contrôleurs :
<https://laravel.com/docs/12.x/testing>.

Bien que les tests soient un sujet important, ils ne sont pas abordés en détail
dans ce cours. Dans un premier temps, nous allons tester nos routes et
contrôleurs manuellement à l'aide d'outils spécifiques, tels que :

- [Bruno](https://www.usebruno.com/), [curl](https://curl.se/),
  [Insomnia](https://insomnia.rest/), [Postman](https://www.postman.com/) ou
  tout autre outil de test d'API pour tester les routes.
- Le navigateur web pour tester les routes web (**uniquement pour les méthodes
  `GET` et `POST` au travers de formulaires**).

## Gérer les erreurs dans les contrôleurs

Il est également important de gérer les erreurs dans les contrôleurs pour
s'assurer que l'application réagit de manière appropriée en cas de problèmes,
tels que des données manquantes, des ressources non trouvées, des erreurs de
validation, etc.

Laravel fournit des mécanismes pour gérer les erreurs, notamment la possibilité
de lancer des exceptions et de les gérer à l'aide de gestionnaires d'exceptions
personnalisés. La documentation officielle de Laravel fournit une section
détaillée sur la gestion des erreurs : <https://laravel.com/docs/12.x/errors>.

## Le patron MVC : récapitulatif

Le patron de conception MVC (Model-View-Controller) est une architecture
logicielle qui sépare une application en trois composants principaux :

- **Modèle (Model)** : représente les données et la logique métier de
  l'application. Il interagit avec la base de données et contient les règles de
  validation, les relations entre les données, etc.
- **Vue (View)** : responsable de la présentation des données à la personne qui
  utilise l'application. Elle affiche les données fournies par les contrôleurs
  et présente l'interface utilisateur de manière claire et attractive.
- **Contrôleur (Controller)** : responsable de la gestion des requêtes HTTP et
  du flux de l'application. Il reçoit les requêtes, interagit avec les modèles
  pour récupérer ou manipuler des données, appelle les vues pour afficher les
  résultats, et retourne des réponses HTTP appropriées.

Dans Laravel, ces composants sont organisés dans des dossiers spécifiques :

- Les modèles sont généralement situés dans le dossier `app/Models`. Les
  migrations associées aux modèles sont situées dans le dossier
  `database/migrations`.
- Les vues sont situées dans les dossiers `app/View` et `resources/views`.
- Les contrôleurs sont situés dans le dossier `app/Http/Controllers`.

Grâce à cette organisation, il est plus facile de maintenir une séparation
claire entre la logique métier, la logique de présentation et la logique de
contrôle, ce qui facilite la maintenance, la réutilisabilité, la testabilité et
la collaboration dans le développement de l'application.

En suivant les conventions de Laravel pour l'organisation des fichiers et des
dossiers, les développeur.euses peuvent rapidement comprendre où trouver les
différents composants de l'application et comment ils interagissent entre eux.

## Conclusion

Dans cette séance, nous avons exploré les contrôleurs dans le contexte du patron
MVC et appris à créer des contrôleurs dans Laravel. Voici les points clés à
retenir :

- Les **contrôleurs** sont responsables de la gestion des requêtes HTTP et du
  flux de l'application dans le patron MVC.
- Ils interagissent avec les **modèles** pour récupérer ou manipuler des
  données.
- Ils appellent les **vues** pour afficher les résultats.
- Ils retournent des **réponses HTTP** appropriées. (View), qui sont
  responsables de la présentation des données à la personne qui utilise
  l'application.

Dans le patron MVC, les vues ont pour responsabilité de :

- Afficher les données fournies par les contrôleurs (que nous verrons plus en
  détail dans une prochaine séance).
- Présenter l'interface utilisateur de manière claire et attractive.
- Structurer le contenu HTML de manière logique et sémantique.
- Ne pas contenir de logique métier (cette responsabilité appartient aux modèles
  et contrôleurs).

Les vues ne doivent pas accéder directement à la base de données ni effectuer de
calculs complexes. Elles reçoivent des données déjà préparées et se contentent
de les afficher de manière appropriée.

Cette séparation entre la logique métier (modèles), la logique de présentation
(vues) et la logique de contrôle (contrôleurs) offre plusieurs avantages :

- **Maintenabilité** : les modifications de l'interface utilisateur n'affectent
  pas la logique métier.
- **Réutilisabilité** : les mêmes données peuvent être affichées de différentes
  manières (web, mobile, API).
- **Testabilité** : chaque composant peut être testé indépendamment.
- **Collaboration** : les personnes qui développent peuvent se spécialiser dans
  différents aspects de l'application.

Vous avez maintenant de solides bases pour comprendre et développer des
applications avec Laravel en utilisant le patron MVC.

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
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/04-vues-blade-et-tailwind-css-presentation.pdf
