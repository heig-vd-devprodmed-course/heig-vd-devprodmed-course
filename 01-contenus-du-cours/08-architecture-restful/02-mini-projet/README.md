# Architecture RESTful - Mini-projet

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Toutes les informations relatives à ce contenu sont décrites dans le
> [contenu principal](../README.md).

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Identifier les routes et les contrôleurs nécessaires pour l'application](#identifier-les-routes-et-les-contrôleurs-nécessaires-pour-lapplication)
- [Supprimer les routes et les contrôleurs de base créés par Laravel](#supprimer-les-routes-et-les-contrôleurs-de-base-créés-par-laravel)
- [Installer un outil capable d'effectuer des requêtes HTTP pour tester les routes de votre application](#installer-un-outil-capable-deffectuer-des-requêtes-http-pour-tester-les-routes-de-votre-application)
- [Créer le contrôleur pour gérer les Posts](#créer-le-contrôleur-pour-gérer-les-posts)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche)
  - [Créer le contrôleur](#créer-le-contrôleur)
  - [Lier les routes au contrôleur](#lier-les-routes-au-contrôleur)
  - [Définir les méthodes du contrôleur pour gérer les différentes actions](#définir-les-méthodes-du-contrôleur-pour-gérer-les-différentes-actions)
  - [Lier les controllers aux vues correspondantes](#lier-les-controllers-aux-vues-correspondantes)
  - [Tester les routes de votre application](#tester-les-routes-de-votre-application)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request)
- [Créer le contrôleur pour gérer les Users](#créer-le-contrôleur-pour-gérer-les-users)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-1)
  - [Créer le contrôleur](#créer-le-contrôleur-1)
  - [Lier les routes au contrôleur](#lier-les-routes-au-contrôleur-1)
  - [Définir les méthodes du contrôleur pour gérer les différentes actions](#définir-les-méthodes-du-contrôleur-pour-gérer-les-différentes-actions-1)
  - [Lier les controllers aux vues correspondantes](#lier-les-controllers-aux-vues-correspondantes-1)
  - [Tester les routes de votre application](#tester-les-routes-de-votre-application-1)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-1)
- [Créer le contrôleur pour gérer les Likes](#créer-le-contrôleur-pour-gérer-les-likes)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-2)
  - [Créer le contrôleur](#créer-le-contrôleur-2)
  - [Lier les routes au contrôleur](#lier-les-routes-au-contrôleur-2)
  - [Définir les méthodes du contrôleur pour gérer les différentes actions](#définir-les-méthodes-du-contrôleur-pour-gérer-les-différentes-actions-2)
  - [Lier les controllers aux vues correspondantes](#lier-les-controllers-aux-vues-correspondantes-2)
  - [Tester les routes de votre application](#tester-les-routes-de-votre-application-2)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-2)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Mettre en place l'interface utilisateur du petit réseau social en utilisant
Tailwind CSS et Blade.

## Identifier les routes et les contrôleurs nécessaires pour l'application

Avant de commencer à coder, il est important d'identifier les différentes routes
et contrôleurs nécessaires pour notre application de réseau social.

Cela nous permettra de structurer notre application de manière efficace et de
savoir quelles fonctionnalités nous devons implémenter.

En vous basant sur les réflexions de la base de données et des modèles que vous
avez réalisés précédemment, essayez d'identifier les différentes ressources de
votre application et les actions que vous souhaitez permettre pour chaque
ressource (par exemple : afficher la liste des posts, afficher un post
spécifique, créer un post, etc.).

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir aux ressources et aux actions associées à
> chaque ressource de votre application.
>
> N'hésitez pas à proposer d'autres ressources ou actions que celles mentionnées
> dans cet exemple.

TODO

</details>

## Supprimer les routes et les contrôleurs de base créés par Laravel

Comme lors de la séance précédente, lors de l'initialisation d'un projet
Laravel, certains fichiers de base sont créés automatiquement.

Ces fichiers peuvent être utilisés tels quels, mais pour ce mini-projet, nous
allons les supprimer afin de créer nos propres vues et routes à partir de zéro.

Comme pour les séances précédentes, nous allons suivre les bonnes pratiques de
développement en créant une branche dédiée à cette tâche, en créant une pull
request pour suivre les modifications, et en fusionnant la pull request une fois
que les modifications sont terminées.

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis supprimez le fichier
`app/Http/Controllers/Controller.php`.

Modifiez ensuite le fichier `routes/web.php` pour ne garder que le contenu
suivant :

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/about', function () {
    return view('about');
});
```

Une fois que vous avez supprimé le contrôleur de base et la route pour affiche
la page "À propos", validez les modifications dans Git, puis vous pouvez créer
la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

## Installer un outil capable d'effectuer des requêtes HTTP pour tester les routes de votre application

Afin de tester les différentes routes de votre application, il est recommandé
d'utiliser un outil capable d'effectuer des requêtes HTTP.

Pour cela, il existe de nombreux outils disponibles. Parmi les plus populaires,
on peut citer :

- [Bruno](https://www.usebruno.com/).
- [curl](https://curl.se/).
- [Insomnia](https://insomnia.rest/).
- [Postman](https://www.postman.com/).

Si vous avez déjà un outil de ce type installé sur votre ordinateur, vous pouvez
l'utiliser pour tester les routes de votre application.

Sinon, vous pouvez en installer un parmi ceux mentionnés ci-dessus. Nous
recommandons d'utiliser Bruno, un des derniers outils gratuits et open source
disponibles sur le marché, qui offre une interface utilisateur moderne et facile
à utiliser pour tester votre application.

## Créer le contrôleur pour gérer les Posts

Dans cette section, nous allons créer le contrôleur pour gérer les posts de
notre application de réseau social. Ce contrôleur sera responsable de la logique
métier liée aux posts, comme la création, la lecture, la mise à jour et la
suppression des posts.

### Créer l'issue et la branche pour suivre cette tâche

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place l'internationalisation dans votre application
Laravel.

### Créer le contrôleur

Pour créer un contrôleur dans Laravel, vous pouvez utiliser la commande Artisan
suivante dans votre terminal :

> [!IMPORTANT]
>
> Assurez-vous d'avoir le dossier `app/Http/Controllers/` dans votre projet
> Laravel. Si le dossier `app/Http/Controllers/` n'existe pas, créez-le
> manuellement avant d'exécuter la commande suivante.
>
> Sans ce dossier, Laravel créera le contrôleur `Controller` dans le dossier
> `app/` au lieu de `app/Http/Controllers/`, ce qui n'est pas la convention
> recommandée pour les contrôleurs dans Laravel.

```bash
php artisan make:controller PostController --resource
```

Le résultat devrait ressembler à ceci :

```text
   INFO  Controller [app/Http/Controllers/PostController.php] created successfully.
```

L'argument `--resource` indique à Laravel de générer un contrôleur avec des
méthodes (au sens programmation orientée objet (POO) du terme) prédéfinies pour
les actions courantes suivantes :

- `index` : affiche une liste de tous les posts.
- `create` : affiche un formulaire pour créer un nouveau post.
- `store` : traite la soumission du formulaire de création d'un nouveau post.
- `show` : affiche un post spécifique.
- `edit` : affiche un formulaire pour éditer un post existant.
- `update` : traite la soumission du formulaire de mise à jour d'un post
  existant.
- `destroy` : supprime un post spécifique.

### Lier les routes au contrôleur

Maintenant que le contrôleur `PostController` a été créé, nous devons lier les
routes correspondantes à ce contrôleur pour que les différentes actions soient
accessibles via des URL spécifiques.

Pour cela, ouvrez le fichier `routes/web.php` et ajoutez la ligne suivante pour
les posts :

```php
use App\Http\Controllers\PostController;

// ...les autres imports et routes...

Route::resource('posts', PostController::class);
```

Cette ligne de code utilise la méthode `Route::resource` pour lier
automatiquement les routes pour le contrôleur `PostController` :

- `GET /posts` : pour afficher la liste de tous les posts (action `index`).
- `GET /posts/create` : pour afficher le formulaire de création d'un nouveau
  post (action `create`).
- `POST /posts` : pour traiter la soumission du formulaire de création d'un
  nouveau post (action `store`).
- `GET /posts/{post}` : pour afficher un post spécifique (action `show`).
- `GET /posts/{post}/edit` : pour afficher le formulaire d'édition d'un post
  existant (action `edit`).
- `PUT/PATCH /posts/{post}` : pour traiter la soumission du formulaire de mise à
  jour d'un post existant (action `update`).
- `DELETE /posts/{post}` : pour supprimer un post spécifique (action `destroy`).

### Définir les méthodes du contrôleur pour gérer les différentes actions

### Lier les controllers aux vues correspondantes

### Tester les routes de votre application

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Créer le contrôleur pour gérer les Users

### Créer l'issue et la branche pour suivre cette tâche

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place l'internationalisation dans votre application
Laravel.

### Créer le contrôleur

### Lier les routes au contrôleur

### Définir les méthodes du contrôleur pour gérer les différentes actions

### Lier les controllers aux vues correspondantes

### Tester les routes de votre application

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Créer le contrôleur pour gérer les Likes

### Créer l'issue et la branche pour suivre cette tâche

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place l'internationalisation dans votre application
Laravel.

### Créer le contrôleur

### Lier les routes au contrôleur

### Définir les méthodes du contrôleur pour gérer les différentes actions

### Lier les controllers aux vues correspondantes

### Tester les routes de votre application

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Conclusion

TODO

## Solution

La solution du mini-projet est accessible dans un dépôt GitHub dédié à l'adresse
suivante :
<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-mini-projet/tree/mini-projet-3>.

> [!NOTE]
>
> La solution est fournie à titre indicatif uniquement. Il est fortement
> recommandé de développer votre propre version du mini-projet avant de
> consulter la solution.
>
> De plus, cette solution référence un commit spécifique. Des modifications
> peuvent avoir été apportées au dépôt depuis ce commit.
>
> Pour accéder à la version exacte de la solution correspondant à ce commit/tag,
> vous pouvez cloner le dépôt et utiliser la commande Git suivante pour basculer
> sur le commit/tag spécifique :
>
> ```bash
> git checkout <commit-hash> # ou git checkout <tag>
> ```
>
> Remplacez `<commit-hash>` ou `<tag>` par l'identifiant du commit ou du tag
> correspondant à la solution.

## Idées pour le mini-projet personnel

> [!TIP]
>
> Plus tard dans le cours, vous aurez l'occasion de rajouter des fonctionnalités
> à votre mini-projet personnel. Voici quelques idées de fonctionnalités que
> vous pourriez implémenter.

- TODO

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé les exercices et le mini-projet.

- Seriez-vous capable de mettre en place des tests automatisés pour les routes
  et les contrôleurs de votre application Laravel ? Pour cela, vous pouvez vous
  aider de la documentation officielle de Laravel sur les tests :
  <https://laravel.com/docs/10.x/testing>, et plus particulièrement la page
  <https://laravel.com/docs/12.x/http-tests>.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
