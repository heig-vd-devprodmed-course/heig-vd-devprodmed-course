# Routes, paramètres et contrôleurs - Mini-projet

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
- [Supprimer les routes de tests des séances précédentes](#supprimer-les-routes-de-tests-des-séances-précédentes)
- [Créer le contrôleur pour gérer les Posts](#créer-le-contrôleur-pour-gérer-les-posts)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche)
  - [Créer le contrôleur](#créer-le-contrôleur)
  - [Lier les routes au contrôleur](#lier-les-routes-au-contrôleur)
  - [Méthode `index`](#méthode-index)
  - [Méthode `show`](#méthode-show)
  - [Méthode `create`](#méthode-create)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request)
- [Créer le contrôleur pour gérer les Users](#créer-le-contrôleur-pour-gérer-les-users)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-1)
  - [Créer le contrôleur](#créer-le-contrôleur-1)
  - [Lier les routes au contrôleur](#lier-les-routes-au-contrôleur-1)
  - [Définir les méthodes du contrôleur pour gérer les différentes actions](#définir-les-méthodes-du-contrôleur-pour-gérer-les-différentes-actions)
  - [Lier les controllers aux vues correspondantes](#lier-les-controllers-aux-vues-correspondantes)
  - [Tester les routes de votre application](#tester-les-routes-de-votre-application)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-1)
- [Créer le contrôleur pour gérer les Likes](#créer-le-contrôleur-pour-gérer-les-likes)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-2)
  - [Créer le contrôleur](#créer-le-contrôleur-2)
  - [Lier les routes au contrôleur](#lier-les-routes-au-contrôleur-2)
  - [Définir les méthodes du contrôleur pour gérer les différentes actions](#définir-les-méthodes-du-contrôleur-pour-gérer-les-différentes-actions-1)
  - [Lier les controllers aux vues correspondantes](#lier-les-controllers-aux-vues-correspondantes-1)
  - [Tester les routes de votre application](#tester-les-routes-de-votre-application-1)
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

## Supprimer les routes de tests des séances précédentes

Lors des séances précédentes, nous avons créé des routes de test pour vérifier
que notre application Laravel fonctionnait correctement.

Maintenant que nous avons une meilleure compréhension de Laravel et que nous
avons identifié les routes et les contrôleurs nécessaires pour notre application
de réseau social, il est temps de supprimer les routes de test que nous avons
créées précédemment.

Comme pour les séances précédentes, nous allons suivre les bonnes pratiques de
développement en créant une branche dédiée à cette tâche, en créant une pull
request pour suivre les modifications, et en fusionnant la pull request une fois
que les modifications sont terminées.

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis modifiez ensuite le
fichier `routes/web.php` pour ne garder que le contenu suivant :

```php
<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::orderBy('created_at', 'desc')->with('user')->with('likes')->get();

    return view('home', ['posts' => $posts]);
});

Route::get('/about', function () {
    return view('about');
});
```

Une fois que vous avez supprimé le contrôleur de base et que vous n'ayez gardé
que les routes nécessaires, validez les modifications dans Git, puis vous pouvez
créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

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

Dans un premier temps, nous allons uniquement implémenter les actions `index`,
`create`, `show`, `edit`, car ce sont toutes des actions de lecture (affichage
de pages) qui ne nécessitent pas encore de logique métier complexe (comme la
validation des données ou la gestion des relations entre les modèles).

Dans un second temps, nous implémenterons les actions `store`, `update` et
`destroy`, qui nécessitent une logique métier plus complexe pour gérer la
création, la mise à jour et la suppression des posts, notamment à l'aide de
formulaires et de requêtes HTTP spécifiques (POST, PUT/PATCH, DELETE).

### Méthode `index`

Dans cette section, nous allons implémenter la méthode `index` du contrôleur
`PostController` pour afficher la liste de tous les posts de notre application
de réseau social.

#### Créer la vue

Pour créer la vue `index` pour afficher la liste de tous les posts, utilisez la
commande Artisan suivante dans votre terminal :

```bash
php artisan make:view posts.index
```

Le résultat devrait ressembler à ceci :

```text
   INFO  View [resources/views/posts/index.blade.php] created successfully.
```

En utilisant la notation `posts.index`, Laravel va créer un fichier
`index.blade.php` dans le dossier `resources/views/posts/`. Cette vue sera
utilisée pour afficher la liste de tous les posts.

Modifiez ensuite le fichier `resources/views/posts/index.blade.php` avec le
contenu suivant pour afficher la liste des posts :

```php
<x-default-layout>
    <x-slot:title>
        {{ __('ui.posts.index.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.posts.index.description', ['app_name' => config('app.name')]) }}
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">
        {{ __('ui.posts.index.title') }}
    </h1>

    <p class="mt-4 dark:text-gray-300">
        {{ __('ui.posts.index.description', ['app_name' => config('app.name')]) }}
    </p>

    <div class="mt-8 space-y-6">
        @foreach ($posts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>
</x-default-layout>
```

Vous remarquerez peut-être que le contenu de ce fichier est similaire à celui du
fichier `resources/views/home.blade.php`.

En effet, les fonctionnalités de ces deux pages sont similaires, car elles
affichent toutes les deux la liste de tous les posts.

Dans le futur, nous allons ajouter des fonctionnalités spécifiques à la page
d'accueil (par exemple, afficher les posts les plus populaires, ou les posts les
plus récents), ce qui justifie la création de deux vues distinctes pour la page
d'accueil et la page des posts.

#### Mettre à jour l'action du contrôleur

La méthode `index` du contrôleur `PostController` est responsable d'afficher la
liste de tous les posts. Voici un exemple d'implémentation de la méthode `index`
dans le contrôleur `PostController` :

> [!NOTE]
>
> N'oubliez pas d'importer le modèle `Post`.

```php
public function index()
{
    $posts = Post::orderBy('created_at', 'desc')->with('user')->with('likes')->get();

    return view('posts.index', ['posts' => $posts]);
}
```

Vous remarquerez l'utilisation de la vue `posts.index` pour afficher la liste de
tous les posts. Cela va automatiquement chercher la vue dans le dossier
`resources/views/posts/index.blade.php` pour afficher la liste des posts.

#### Mettre à jour les traductions

Comme nous avons créé une nouvelle vue associée à la ressource `posts`, nous
devons également mettre à jour les traductions pour les différentes chaînes de
caractères utilisées dans les vues liées à cette ressource (par exemple, les
titres et les descriptions).

Pour cela, ouvrez le fichier `resources/lang/fr/ui.php` et ajoutez les
traductions suivantes pour les différentes chaînes de caractères utilisées dans
la vue `posts.index` :

> [!TIP]
>
> Il n'y a pas de structure standard pour organiser les traductions dans les
> fichiers de langue de Laravel. Vous pouvez organiser les traductions de la
> manière qui vous semble la plus logique et la plus facile à maintenir pour
> votre projet.
>
> Je (Ludovic) vous propose la structure suivante pour organiser les traductions
> de votre application dans le fichier `resources/lang/fr/ui.php` :
>
> - Les traductions sont liées à chaque ressource de votre application (par
>   exemple, `posts`, `users`, `likes`, etc.) - chaque ressource a une section
>   dédiée dans le fichier de langue (par exemple, `'posts' => [ ... ]` pour les
>   traductions liées aux posts)).
> - Les traductions sont organisées par action (par exemple, `index`, `show`,
>   `create`, `edit`, etc. - chaque action a une section dédiée dans la section
>   de la ressource correspondante (par exemple, `'index' => [ ... ]` pour les
>   traductions liées à l'action `index` de la ressource `posts`)).
>
> De mon expérience, cela permet de garder une cohérence au sein de toute
> l'application (la base de données et les modèles définissent les ressources,
> les contrôleurs définissent les actions liées à ces ressources, et les
> fichiers de langue organisent les traductions en fonction des ressources et
> des actions. Les vues suivent cette définition également).

```php
// ...les autres traductions...
    'posts' => [
        // ...les autres traductions liées aux posts...
        'index' => [
            'title' => 'Tous les posts',
            'description' => 'Tous les posts de :app_name.',
        ],
        // ...les autres traductions liées aux posts...
    ],
// ...les autres traductions...
```

#### Tester la route

Sauvegardez toutes les modifications que vous avez effectuées, puis ouvrez votre
navigateur et accédez à l'URL `http://localhost:8000/posts` pour tester la route
qui affiche la liste de tous les posts.

La page devrait s'afficher correctement avec la liste de tous les posts, le
titre "Tous les posts" et la description "Tous les posts de :app_name." (où
`:app_name` est remplacé par le nom de votre application défini dans le fichier
`.env`/`.env.example`).

### Méthode `show`

Dans cette section, nous allons implémenter la méthode `show` du contrôleur
`PostController` pour afficher les détails d'un post spécifique de notre
application de réseau social.

#### Créer la vue

Pour créer la vue `show` pour afficher les détails d'un post spécifique,
utilisez la commande Artisan suivante dans votre terminal :

```bash
php artisan make:view posts.show
```

Le résultat devrait ressembler à ceci :

```text
   INFO  View [resources/views/posts/show.blade.php] created successfully.
```

En utilisant la notation `posts.show`, Laravel va créer un fichier
`show.blade.php` dans le dossier `resources/views/posts/`. Cette vue sera
utilisée pour afficher les détails d'un post spécifique.

Modifiez ensuite le fichier `resources/views/posts/show.blade.php` avec le
contenu suivant pour afficher les détails d'un post spécifique :

```php
<x-default-layout>
    <x-slot:title>
        {{ $post->title }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.posts.show.description', ['post_title' => $post->title]) }}
    </x-slot>

    <x-post-card :post="$post" />
</x-default-layout>
```

Cette vue utilise un composant `x-post-card` pour afficher les détails du post
de manière stylisée. Vous pouvez personnaliser le contenu de ce composant pour
afficher les informations que vous souhaitez (par exemple, le titre du post, le
contenu du post, l'auteur du post, les likes du post, etc.).

#### Mettre à jour l'action du contrôleur

#### Mettre à jour les traductions

#### Tester la route

### Méthode `create`

#### Créer la vue

#### Mettre à jour l'action du contrôleur

#### Mettre à jour les traductions

#### Tester la route

#### Méthode `edit`

#### Créer la vue

#### Mettre à jour l'action du contrôleur

#### Mettre à jour les traductions

#### Tester la route

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
