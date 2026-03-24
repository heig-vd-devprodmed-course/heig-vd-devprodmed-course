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
>   · [Présentation (PDF)][presentation-pdf].
> - Exercices : [Accéder au contenu](./01-exercices/README.md).
> - Mini-projet : [Accéder au contenu](./02-mini-projet/README.md).
>
> **Objectifs**
>
> À l'issue de cette séance, les personnes qui étudient devraient être capables
> de :
>
> - Décrire les principes fondamentaux d'une architecture REST.
> - Différencier les architectures REST et RESTful.
> - Décrire quand et pourquoi utiliser une architecture RESTful pour développer
>   des services web.
> - Mettre en œuvre une architecture RESTful dans une application web avec le
>   framework Laravel.
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
- [MVC, REST et RESTful](#mvc-rest-et-restful)
  - [Jusqu'à présent... architecture MVC](#jusquà-présent-architecture-mvc)
  - [Dans le futur peut-être... architecture REST](#dans-le-futur-peut-être-architecture-rest)
  - [Architectures REST/RESTful](#architectures-restrestful)
- [API](#api)
  - [Structure d'une API RESTful](#structure-dune-api-restful)
  - [Versionner une API RESTful](#versionner-une-api-restful)
- [Développer une API RESTful avec Laravel](#développer-une-api-restful-avec-laravel)
  - [Différencier les routes MVC et les routes API](#différencier-les-routes-mvc-et-les-routes-api)
  - [Laravel Sanctum pour l'authentification des API RESTful](#laravel-sanctum-pour-lauthentification-des-api-restful)
  - [Créer les tokens pour les utilisateur.trices](#créer-les-tokens-pour-les-utilisateurtrices)
  - [Utiliser les tokens pour authentifier les requêtes API](#utiliser-les-tokens-pour-authentifier-les-requêtes-api)
  - [Gérer les permissions et les rôles des utilisateur.trices avec les tokens d'authentification](#gérer-les-permissions-et-les-rôles-des-utilisateurtrices-avec-les-tokens-dauthentification)
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [Questions d'évaluation](#questions-dévaluation)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs d'être capable de mettre en place une
architecture RESTful dans une application web avec le framework Laravel.

Ce contenu repose sur la documentation officielle suivante :

- <https://laravel.com/docs/12.x/sanctum> et ses sous-sections.
- <https://laravel.com/docs/12.x/eloquent-serialization#hiding-attributes-from-json>.

La liste complète des objectifs est disponible dans la section _"Objectifs"_ du
bloc d'information en haut de ce contenu.

## MVC, REST et RESTful

### Jusqu'à présent... architecture MVC

Jusqu'à présent, nous avons vu comment développer une application web avec le
framework Laravel en utilisant une architecture _"model–view–controller (MVC)"_.
Nous avons vu comment créer des routes, des contrôleurs, des vues, des modèles,
ainsi que gérer l'authentification et les autorisations dans une application
Laravel.

Cette architecture MVC est très adaptée pour développer des applications web
classiques, souvent adaptée pour interagir avec des utilisateurs via une
interface graphique (leur navigateur web).

Cette architecture retourne habituellement un HTML complet au client qui
l'affiche dans le navigateur et gère les sessions à l'aide de cookies.

Cependant, elle n'est pas adaptée pour développer des services web qui doivent
être consommés (= interagir avec notre application/utiliser les données de notre
application) par d'autres applications ou par des clients légers comme des
applications mobiles ou des applications JavaScript côté client (qui ne peuvent
pas gérer facilement les sessions à l'aide de cookies).

Heureusement pour nous, Laravel permet de développer des services web en
utilisant une architecture REST(ful), qui est une architecture adaptée pour
développer des services web qui doivent être consommés par d'autres applications
ou par des clients légers.

Cela est particulièrement utile pour les applications mobiles ou les
applications JavaScript _"single-page applications (SPA)"_ à l'aide de Vue.js,
React ou Angular.

### Dans le futur peut-être... architecture REST

Un jour peut-être, vous aurez le besoin de mettre à disposition des
fonctionnalités de votre application à d'autres applications ou à des clients
légers (applications mobiles, applications JavaScript côté client, etc.).

Dans ce cas, il est probable que vous aurez besoin de mettre en place une
architecture _"representational state transfer (REST)"_ dans votre application
Laravel.

Une application REST est une application qui suit les principes de
l'architecture REST, qui sont les suivants (source :
<https://en.wikipedia.org/wiki/REST#Architectural_constraints>) :

1. Client-serveur : l'application est composée d'un client qui consomme les
   services d'un serveur.
2. Sans état : le serveur ne stocke aucune information sur l'état du client
   entre les différentes requêtes. Chaque requête doit contenir toutes les
   informations nécessaires pour que le serveur puisse la traiter.
3. Cacheable : les réponses du serveur peuvent être mises en cache par le client
   pour améliorer les performances.
4. Interface uniforme : l'interface entre le client et le serveur doit être
   uniforme et standardisée.
5. Système en couches : l'architecture peut être composée de plusieurs couches
   (par exemple, une couche pour accéder à la base de données, une couche pour
   la logique métier, une couche pour l'interface utilisateur, une couche pour
   le traitement des requêtes, une couche pour l'authentification/autorisations,
   etc.)
6. Code à la demande (optionnel) : le serveur peut envoyer du code exécutable au
   client pour qu'il l'exécute.

Au travers de la structure et des conventions mises à disposition par Laravel,
il est possible de respecter ces principes pour développer des services web qui
suivent l'architecture REST/RESTful.

### Architectures REST/RESTful

Développer une application web qui suit parfaitement les principes de
l'architecture REST peut être difficile, voire impossible dans certains cas.

C'est pourquoi on parle souvent d'architecture RESTful, qui est une architecture
qui suit les principes de l'architecture REST de manière approximative, mais qui
est suffisamment proche pour être considérée comme une architecture REST.

Laravel permet de développer des applications RESTful, c'est-à-dire des
applications qui suivent les principes de l'architecture REST au travers d'une
API.

## API

Une _"application programming interface (API)"_ est un ensemble de règles et de
protocoles qui permettent à différentes applications de communiquer entre elles.

Une API permet à une application de fournir des fonctionnalités ou des données à
d'autres applications de manière standardisée et contrôlée.

Les API sont souvent utilisées pour permettre à des applications mobiles ou à
des applications JavaScript côté client de consommer les fonctionnalités ou les
données d'une application web.

Le format de données le plus couramment utilisé pour les API RESTful est le
format JSON, mais d'autres formats comme XML peuvent également être utilisés.

### Structure d'une API RESTful

Une API RESTful est généralement structurée autour de ressources, qui sont des
entités ou des objets qui représentent des données ou des fonctionnalités de
l'application et suit généralement les conventions suivantes :

- Les ressources sont identifiées par des URL uniques.
- Les opérations sur les ressources sont effectuées à l'aide de méthodes HTTP
  standard (GET, POST, PUT, DELETE, etc.).
- Les réponses du serveur sont généralement au format JSON.
- L'authentification et les autorisations sont gérées à l'aide de tokens (par
  exemple, des tokens JWT ou des tokens d'API).
- Les erreurs sont gérées de manière standardisée (par exemple, en utilisant des
  codes d'état HTTP appropriés et en fournissant des messages d'erreur clairs).

Chaque ressource est accessible via une URL unique et peut être manipulée à
l'aide de méthodes HTTP standard (GET, POST, PUT, DELETE, etc.) pour effectuer
des opérations de lecture, de création, de mise à jour ou de suppression sur la
ressource.

Ainsi, une ressource "posts" pourrait être accessible via l'URL `/api/posts` et
pourrait être manipulée à l'aide des méthodes HTTP suivantes :

- `GET /api/posts` : pour récupérer la liste des posts.
  - Réponse(s) possible(s) : 200 (OK).
- `POST /api/posts` : pour créer un nouveau post.
  - Requêtes attendues : les données du post à créer (par exemple, le titre, le
    contenu, etc.) au format JSON dans le corps de la requête.
  - Réponse(s) possible(s) : 201 (Created) en cas de succès avec les données du
    post créé, 400 (Bad Request) en cas de données invalides avec les attributs
    d'erreur, etc.
- `GET /api/posts/{id}` : pour récupérer les détails d'un post spécifique.
  - Réponse(s) possible(s) : 200 (OK) en cas de succès avec les données du post,
    404 (Not Found) si le post n'existe pas, etc.
- `PUT/PATCH /api/posts/{id}` : pour mettre à jour un post spécifique.
  - Entrées attendues : les données du post à mettre à jour (par exemple, le
    titre, le contenu, etc.) au format JSON dans le corps de la requête.
  - Réponse(s) possible(s) : 200 (OK) en cas de succès avec les données du post
    mis à jour, 404 (Not Found) si le post n'existe pas, etc.
- `DELETE /api/posts/{id}` : pour supprimer un post spécifique.
  - Réponse(s) possible(s) : 204 (No Content) en cas de succès, 404 (Not Found)
    si le post n'existe pas, etc.

La liste complète des codes d'état HTTP et de leur signification est disponible
sur le site de Mozilla Developer Network (MDN) à l'adresse suivante :
<https://developer.mozilla.org/en-US/docs/Web/HTTP/Status>.

### Versionner une API RESTful

Il est souvent recommandé de versionner une API RESTful pour permettre aux
clients de continuer à utiliser une version stable de l'API pendant que de
nouvelles fonctionnalités sont développées ou que des modifications sont
apportées à l'API.

Pour cela, il est courant d'inclure la version de l'API dans l'URL (par exemple,
`/api/v1/posts` pour la version 1 de l'API) ou dans les en-têtes de la requête.

A l'avenir, si de nouvelles fonctionnalités sont ajoutées à l'API ou si des
modifications sont apportées à l'API qui pourraient casser la compatibilité avec
les clients existants, une nouvelle version de l'API pourrait être créée (par
exemple, `/api/v2/posts`) pour permettre aux clients de continuer à utiliser la
version stable de l'API pendant que les nouvelles fonctionnalités sont
développées ou que les modifications sont apportées.

## Développer une API RESTful avec Laravel

Au travers du mini-projet réalisé jusqu'à présent, nous avons développé une
application web avec le framework Laravel qui suit une architecture MVC
classique mais dont la structure et les conventions mises à disposition par
Laravel permettent de respecter facilement les principes de l'architecture
REST/RESTful.

En effet, nous avons déjà mis en place une structure de routes, de contrôleurs
et de modèles qui suit les conventions de Laravel et qui permet de développer
des services web RESTful.

C'est entre autres grâce à la méthodologie de développement que nous avons
adoptée, qui consiste à construire notre application depuis la base de données
(modèles et migrations) jusqu'à l'interface utilisateur (vues), en passant par
les contrôleurs et les routes, que nous avons pu mettre en place une structure
qui respecte les principes de l'architecture REST/RESTful.

Déjà aujourd'hui, notre application web suit une architecture RESTful (les
contrôleurs gèrent des aspects spécifiques de l'application comme les Posts, les
Likes, les Users, etc.), même si nous n'avons pas encore mis en place de routes
spécifiques pour l'API.

### Différencier les routes MVC et les routes API

Dans une application Laravel, il est possible de différencier les routes qui
sont destinées à être utilisées pour l'interface utilisateur (routes MVC) et les
routes qui sont destinées à être utilisées pour l'API (routes API).

Les routes MVC sont généralement définies dans le fichier `routes/web.php` et
sont destinées à être utilisées pour l'interface utilisateur de l'application.

Les routes API sont généralement définies dans le fichier `routes/api.php` et
sont destinées à être utilisées pour l'API de l'application. Elles sont
généralement préfixées par `/api` et utilisent un middleware spécifique pour
gérer l'authentification et les autorisations.

### Laravel Sanctum pour l'authentification des API RESTful

Laravel Sanctum est un package Laravel qui permet de gérer l'authentification
des API RESTful de manière simple et sécurisée.

Il permet de générer des tokens d'authentification pour les utilisateurs de
l'application, qui peuvent être utilisés pour authentifier les requêtes API.

Il offre également des fonctionnalités pour gérer les permissions et les rôles
des utilisateurs, ainsi que pour gérer les tokens d'authentification (par
exemple, pour les révoquer ou les renouveler).

### Créer les tokens pour les utilisateur.trices

Au travers de Laravel Sanctum, il est possible de créer des tokens
d'authentification pour les utilisateur.trices de l'application, qui peuvent
être utilisés pour authentifier les requêtes API.

Cela peut être fait en proposant une interface dans l'application pour que les
utilisateur.trices puissent générer des tokens d'authentification.

Nous aurons donc un nouveau domaine/une nouvelle ressource/une nouvelle section
dans notre application pour gérer les tokens d'authentification, qui permettra
aux utilisateur.trices de générer des tokens d'authentification pour leur
compte.

Cela nécessite de créer les vues associées pour permettre aux utilisateur.trices
de générer des tokens d'authentification, ainsi que les routes et les
contrôleurs associés pour gérer la logique de génération des tokens
d'authentification.

Une fois ces éléments mis en place, les utilisateur.trices pourront générer des
tokens d'authentification pour leur compte et les utiliser avec l'API.

### Utiliser les tokens pour authentifier les requêtes API

Une fois que les utilisateur.trices auront généré un ou des tokens
d'authentification pour leur compte, ils pourront utiliser ces tokens pour
authentifier les requêtes API en les incluant dans les en-têtes de la requête
(par exemple, `Authorization: Bearer <token>`).

Laravel Sanctum gère automatiquement l'authentification des requêtes API en
vérifiant les tokens d'authentification inclus dans les en-têtes de la requête.
Si le token est valide, la requête est authentifiée et le serveur peut traiter
la requête en fonction des permissions et des rôles de l'utilisateur associé au
token d'authentification.

### Gérer les permissions et les rôles des utilisateur.trices avec les tokens d'authentification

Laravel Sanctum permet également de gérer les permissions et les rôles des
utilisateur.trices en associant des permissions et des rôles aux tokens
d'authentification.

Cela permet de contrôler l'accès aux différentes fonctionnalités de l'API en
fonction des permissions et des rôles associés aux tokens d'authentification
utilisés pour authentifier les requêtes API.

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
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/04-vues-blade-et-tailwind-css-presentation.pdf
