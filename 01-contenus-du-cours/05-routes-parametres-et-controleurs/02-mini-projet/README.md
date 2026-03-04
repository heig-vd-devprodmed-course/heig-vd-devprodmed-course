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
- [Mettre à jour le composant `PostCard` pour accéder au profil de l'auteur.trice du post ainsi qu'à la page de détails du post](#mettre-à-jour-le-composant-postcard-pour-accéder-au-profil-de-lauteurtrice-du-post-ainsi-quà-la-page-de-détails-du-post)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche)
  - [Mettre à jour le composant `PostCard`](#mettre-à-jour-le-composant-postcard)
  - [Mettre à jour les traductions](#mettre-à-jour-les-traductions)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request)
- [Créer le contrôleur pour visualiser les profils](#créer-le-contrôleur-pour-visualiser-les-profils)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-1)
  - [Créer le contrôleur](#créer-le-contrôleur)
  - [Définir la méthode du contrôleur pour afficher le profil d'un.e utilisateur.trice spécifique](#définir-la-méthode-du-contrôleur-pour-afficher-le-profil-dune-utilisateurtrice-spécifique)
  - [Lier les routes au contrôleur](#lier-les-routes-au-contrôleur)
  - [Tester les routes de votre application](#tester-les-routes-de-votre-application)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-1)
- [Créer le contrôleur pour gérer les posts](#créer-le-contrôleur-pour-gérer-les-posts)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-2)
  - [Créer le contrôleur](#créer-le-contrôleur-1)
  - [Lier les routes au contrôleur](#lier-les-routes-au-contrôleur-1)
  - [Méthode `index`](#méthode-index)
  - [Méthode `show`](#méthode-show)
  - [Méthode `create`](#méthode-create)
  - [Méthode `edit`](#méthode-edit)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-2)
- [Mettre à jour la page d'accueil pour pointer vers la page de tous les posts](#mettre-à-jour-la-page-daccueil-pour-pointer-vers-la-page-de-tous-les-posts)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-3)
  - [Mettre à jour la route de la page d'accueil](#mettre-à-jour-la-route-de-la-page-daccueil)
  - [Mettre à jour la vue de la page d'accueil](#mettre-à-jour-la-vue-de-la-page-daccueil)
  - [Mettre à jour les traductions](#mettre-à-jour-les-traductions-5)
  - [Tester la page d'accueil](#tester-la-page-daccueil)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-3)
- [Mettre à jour l'entête du layout par défaut pour ajouter un lien vers la page de tous les posts](#mettre-à-jour-lentête-du-layout-par-défaut-pour-ajouter-un-lien-vers-la-page-de-tous-les-posts)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-4)
  - [Mettre à jour l'entête du layout par défaut](#mettre-à-jour-lentête-du-layout-par-défaut)
  - [Tester l'entête du layout par défaut](#tester-lentête-du-layout-par-défaut)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-4)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Mettre en place l'interface utilisateur du petit réseau social en utilisant
Tailwind CSS et Blade.

> [!IMPORTANT]
>
> Nous allons étudier différentes manières de créer des routes et des
> contrôleurs dans Laravel, en fonction des besoins de votre application.
>
> Toutes les méthodes que nous allons voir sont valides et peuvent être
> utilisées dans votre application.
>
> Dans une application réelle, nous éviterions probablement d'utiliser plusieurs
> méthodes différentes pour créer des routes et des contrôleurs, afin de garder
> une certaine cohérence dans notre code.
>
> Mais ici, à des fins d'apprentissage, nous allons utiliser différentes
> méthodes pour créer les routes et les contrôleurs de notre application de
> réseau social, chacune ayant ses avantages et ses inconvénients en fonction du
> contexte d'utilisation.

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

Utilisez les méthodes HTTP appropriées pour chaque action (par exemple, `GET`
pour afficher des pages, `POST` pour créer des ressources, `PUT/PATCH` pour
mettre à jour des ressources, `DELETE` pour supprimer des ressources).

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

**Pages principales**

- `GET /` : page d'accueil. Dans un premier temps, elle pourra simplement
  afficher la liste des posts. Plus tard, d'autres fonctionnalités pourront être
  ajoutées à cette page.
- `GET /about` : page "À propos" pour présenter l'application et son objectif.

**Profils utilisateur.trices**

- `GET /@{username}` : page pour afficher le profil d'un.e utilisateur.trice
  spécifique. **Note** : cette page aurait pu être accessible via une URL du
  type `/profile/{username}`, `/profiles/{username}` ou `/users/{username}`,
  mais j'ai (Ludovic) choisi d'utiliser le format `@{username}` pour les
  profils, car c'est un format couramment utilisé sur les réseaux sociaux.

**Posts**

- `GET /posts` : page pour afficher la liste de tous les posts.
- `GET /posts/{post}` : page pour afficher les détails d'un post spécifique.
- `GET /posts/{post}/edit` : page pour afficher le formulaire d'édition d'un
  post existant.
- `GET /posts/create` : page pour afficher le formulaire de création d'un
  nouveau post.
- `POST /posts` : action pour traiter la soumission du formulaire de création
  d'un nouveau post.
- `PUT/PATCH /posts/{post}` : action pour traiter la soumission du formulaire de
  mise à jour d'un post existant.
- `DELETE /posts/{post}` : action pour supprimer un post spécifique.

**Likes**

- `PATCH/PUT /posts/{post}/likes` : action pour créer ou retirer un like sur un
  post spécifique.

**Authentification**

> [!NOTE]
>
> Si vous avez omis les routes d'authentification dans votre réponse, ce n'est
> pas grave. Nous allons les ajouter plus tard dans le cours. L'objectif de
> cette question est de se concentrer sur les routes liées aux posts et aux
> profils, qui sont les fonctionnalités principales de notre application de
> réseau social.

- `GET /auth/login` : page pour afficher le formulaire de connexion.
- `POST /auth/login` : action pour traiter la soumission du formulaire de
  connexion.
- `POST /auth/logout` : action pour déconnecter l'utilisateur.
- `GET /auth/register` : page pour afficher le formulaire d'inscription.
- `POST /auth/register` : action pour traiter la soumission du formulaire
  d'inscription.
- `GET /auth/my-profile` : page pour afficher son propre profil (le profil de
  l'utilisateur.trice connecté.e).
- `GET /auth/my-profile/edit` : page pour afficher le formulaire d'édition de
  son propre profil (le profil de l'utilisateur.trice connecté.e().

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

## Mettre à jour le composant `PostCard` pour accéder au profil de l'auteur.trice du post ainsi qu'à la page de détails du post

Dans cette section, nous allons mettre à jour le composant `PostCard` pour
permettre aux utilisateur.trice.s de cliquer sur le nom de l'auteur.trice du
post pour accéder à son profil, ainsi que de cliquer sur le titre du post pour
accéder à la page de détails du post.

### Créer l'issue et la branche pour suivre cette tâche

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place l'internationalisation dans votre application
Laravel.

### Mettre à jour le composant `PostCard`

Ouvrez le fichier `resources/views/components/post-card.blade.php` et modifiez
le contenu pour ajouter des liens vers le profil de l'auteur.trice du post et la
page de détails du post :

```php
<article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
    <header class="mb-4">
        <div class="flex items-center gap-3 mb-3">
            <a href="{{ url('@' . $post->user->username) }}">
                <div
                    class="h-10 w-10 rounded-full bg-teal-600 dark:bg-purple-900 flex items-center justify-center text-white font-semibold hover:bg-teal-700 dark:hover:bg-purple-800">
                    {{ strtoupper(substr($post->user->first_name, 0, 1) . substr($post->user->last_name, 0, 1)) }}
                </div>
            </a>
            <div>
                <a href="{{ url('@' . $post->user->username) }}" class="hover:underline">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        {{ $post->user->first_name }} {{ $post->user->last_name }}
                    </p>
                </a>
                <p class="text-sm text-gray-500 dark:text-gray-400" title="{{ $post->created_at->isoFormat('LLLL') }}">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        @if ($post->title)
            <a href="{{ url('/posts/' . $post->id) }}">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    {{ $post->title }}
                </h2>
            </a>
        @endif
    </header>

    <div class="mb-4">
        <a href="{{ url('/posts/' . $post->id) }}">
            <p class="text-gray-700 dark:text-gray-300">
                {{ $post->content }}
            </p>
        </a>
    </div>

    <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
            <a href="{{ url('/posts/' . $post->id) }}" class="font-semibold">
                {{ trans_choice('ui.posts.likes_count', count($post->likes)) }}
            </a>
            <a href="{{ url('/posts/' . $post->id) }}"
                class="px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800">
                {{ __('ui.posts.view_post') }}
            </a>
        </div>
    </footer>
</article>
```

Notez l'ajout de différents liens dans ce composant :

- Le nom de l'auteur.trice du post est maintenant un lien qui mène à son profil
  (par exemple, <http://localhost:8000/@john_doe>).
- L'avatar de l'auteur.trice du post est également un lien qui mène à son profil
  (par exemple, <http://localhost:8000/@john_doe>).
- Le titre du post est maintenant un lien qui mène à la page de détails du post
  (par exemple, <http://localhost:8000/posts/1>).
- Le contenu du post est également un lien qui mène à la page de détails du post
  (par exemple, <http://localhost:8000/posts/1>).
- Le nombre de likes du post est également un lien qui mène à la page de détails
  du post (par exemple, <http://localhost:8000/posts/1>).
- Un bouton "Voir le post" a été ajouté pour permettre aux utilisateur.trice.s
  de cliquer dessus pour accéder à la page de détails du post (par exemple,
  <http://localhost:8000/posts/1>).

Tous ces liens mènent à la page de détails du post, qui affichera les
informations détaillées du post, y compris le nom de l'auteur.trice du post, le
contenu du post, les likes du post, etc.

Si vous sauvez les modifications et que vous accédez à la page d'accueil de
votre application (par exemple, <http://localhost:8000>), vous devriez voir que
les liens ont été ajoutés au composant `PostCard`.

Pour le moment, les liens mènent à des pages qui n'existent pas encore, mais
nous allons les créer dans les sections suivantes.

### Mettre à jour les traductions

Ouvrez le fichier `resources/lang/fr/ui.php` et ajoutez les traductions
suivantes pour les nouveaux textes que nous avons ajoutés dans le composant
`PostCard` :

```php
// ...les autres traductions...
    'posts' => [
        // ...les autres traductions liées aux posts...
        'view_post' => 'Voir le post',
        // ...les autres traductions liées aux posts...
    ],
// ...les autres traductions...
```

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Créer le contrôleur pour visualiser les profils

Dans cette section, nous allons créer le contrôleur pour visualiser les profils
des utilisateur.trice.s de notre application de réseau social. Ce contrôleur
sera responsable de la logique métier liée à l'affichage des profils, comme la
récupération des informations de l'utilisateur.trice et de ses posts.

### Créer l'issue et la branche pour suivre cette tâche

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place l'internationalisation dans votre application
Laravel.

### Créer le contrôleur

Pour créer un contrôleur dans Laravel, vous pouvez utiliser la commande Artisan
suivante dans votre terminal :

```bash
php artisan make:controller ProfileController
```

Le résultat devrait ressembler à ceci :

```text
   INFO  Controller [app/Http/Controllers/ProfileController.php] created successfully.
```

Le contrôleur `ProfileController` a été créé dans le dossier
`app/Http/Controllers/` de votre projet Laravel. Dans un premier temps, celui-ci
ne devrait contenir que le code de base généré par la commande Artisan :

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;

class ProfileController extends Controller
{
    //
}
```

### Définir la méthode du contrôleur pour afficher le profil d'un.e utilisateur.trice spécifique

Nous allons uniquement implémenter la méthode `show`, car c'est la seule action
de lecture (affichage de page) qui est nécessaire pour afficher le profil d'un.e
utilisateur.trice spécifique.

Pour cela, ouvrez le fichier `app/Http/Controllers/ProfileController.php` et
modifiez le avec le contenu suivant pour implémenter la méthode `show` :

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(string $username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with(['user', 'likes'])
            ->get();

        return view('profile', ['user' => $user, 'posts' => $posts]);
    }
}
```

Ce code est quasi similaire à celui que nous avons utilisé pour afficher un
profil d'utilisateur.trice spécifique lors de la séance précédente.

Pour rappel, ce code fait les choses suivantes :

1. Le nom d'utilisateur est passé en tant que paramètre à la méthode `show` du
   contrôleur `ProfileController` (grâce à la route que nous avons définie
   précédemment).
2. La méthode `show` utilise le modèle `User` pour rechercher
   l'utilisateur.trice correspondant au nom d'utilisateur fourni. Si aucun
   utilisateur.trice n'est trouvé.e, une exception `ModelNotFoundException` est
   levée (grâce à la méthode `firstOrFail`), ce qui entraîne l'affichage d'une
   page d'erreur 404.
3. Si un.e utilisateur.trice est trouvé.e, la méthode `show` utilise le modèle
   `Post` pour récupérer tous les posts de cet utilisateur.trice, triés par date
   de création (du plus récent au plus ancien), et en incluant les relations
   `user` et `likes`.
4. Enfin, la méthode `show` retourne la vue `profile` en lui passant les données
   de l'utilisateur.trice et de ses posts pour les afficher dans la vue. Pour le
   moment, cette vue n'existe pas encore, mais nous allons la créer dans la
   section suivante.

### Lier les routes au contrôleur

Maintenant que le contrôleur `ProfileController` a été créé avec sa méthode
`show`, nous devons lier la ou les routes correspondantes à ce contrôleur pour
que la ou les différentes actions soient accessibles via des URL spécifiques.

Pour cela, ouvrez le fichier `routes/web.php` et ajoutez les lignes suivantes
pour les profils :

```php
use App\Http\Controllers\ProfileController;

// ...les autres imports et routes...

Route::get('/@{username}', [ProfileController::class, 'show'])->where('username', '[A-Za-z0-9-_]+');
```

Cette ligne de code définit une route pour afficher le profil d'un.e
utilisateur.trice spécifique en utilisant la méthode `show` du contrôleur
`ProfileController`.

La partie `where('username', '[A-Za-z0-9-_]+')` est une contrainte de route qui
permet de s'assurer que le paramètre `username` ne contient que des lettres, des
chiffres et des tirets ou des underscores (ce qui correspond à un format de nom
d'utilisateur typique).

Si une personne accède à une URL correspondant à ce format (par exemple,
<http://localhost:8000/@john_doe>), la méthode `show` du contrôleur
`ProfileController` sera appelée avec le paramètre `username` égal à `john_doe`.

Si une personne accède à une URL qui ne correspond pas à ce format (par exemple,
<http://localhost:8000/@𝓶𝓸𝓷_𝓾𝓼𝓮𝓻𝓷𝓪𝓶𝓮>), Laravel ne trouvera pas de route
correspondante et affichera une page d'erreur 404.

### Tester les routes de votre application

Maintenant que nous avons créé le contrôleur `ProfileController` et que nous
avons lié la route pour afficher le profil d'un.e utilisateur.trice spécifique à
la méthode `show` de ce contrôleur, nous pouvons tester cette fonctionnalité en
accédant à une URL correspondant au format défini dans la route (par exemple,
<http://localhost:8000/@john_doe>).

Si tout fonctionne correctement, vous devriez voir la page de profil de
l'utilisateur.trice `john_doe` s'afficher, avec la liste de tous ses posts.

Tentez d'accéder au profil d'un.e utilisateur.trice qui n'existe pas (par
exemple, <http://localhost:8000/@𝓶𝓸𝓷_𝓾𝓼𝓮𝓻𝓷𝓪𝓶𝓮>). Une page 404 devrait
s'afficher, indiquant que le profil de cet.te utilisateur.trice n'existe pas.

Notez au passage que le message d'erreur 404 est lui aussi internationalisé, car
nous avons mis en place l'internationalisation dans notre application Laravel
dans la séance précédente avec la librairie
[`laravel-lang/lang`](https://laravel-lang.com/packages-lang.html).

Retournez à la page d'accueil de votre application (par exemple,
<http://localhost:8000>) et cliquez sur le nom d'un.e auteur.trice de post pour
accéder à son profil. Vous devriez être redirigé.e vers la page de profil de
cet.te utilisateur.trice, où vous pourrez voir la liste de tous ses posts.

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Créer le contrôleur pour gérer les posts

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
gérer les différentes actions liées à une ressource (source :
<https://laravel.com/docs/12.x/controllers#actions-handled-by-resource-controllers>)
:

- `index` : pour afficher une liste de tous les éléments de la ressource.
- `show` : pour afficher un élément spécifique de la ressource.
- `create` : pour afficher un formulaire de création d'un nouvel élément de la
  ressource.
- `store` : pour traiter la soumission du formulaire de création d'un nouvel
  élément de la ressource.
- `edit` : pour afficher un formulaire d'édition d'un élément existant de la
  ressource.
- `update` : pour traiter la soumission du formulaire de mise à jour d'un
  élément existant de la ressource.
- `destroy` : pour supprimer un élément spécifique de la ressource.

Cela permet de gagner du temps lors de la création d'un contrôleur, car les
méthodes de base sont déjà générées pour vous, et vous n'avez plus qu'à les
remplir avec la logique métier spécifique à votre application.

### Lier les routes au contrôleur

Maintenant que le contrôleur `PostController` a été créé, nous pouvons lier les
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

    <a href="{{ url('/posts/create') }}"
        class="mt-6 block w-full px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 text-center">
        {{ __('ui.posts.create.title') }}
    </a>

    <div class="mt-8 space-y-6">
        @foreach ($posts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>
</x-default-layout>
```

Cette page affiche la liste de tous les posts en utilisant le composant
`PostCard` que nous avons créé précédemment. Elle affiche également un titre,
une description et un bouton pour créer un nouveau post.

#### Mettre à jour l'action du contrôleur

La méthode `index` du contrôleur `PostController` est responsable d'afficher la
liste de tous les posts. Voici un exemple d'implémentation de la méthode `index`
dans le contrôleur `PostController` :

> [!NOTE]
>
> N'oubliez pas d'importer le modèle `Post`.

```php
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with('user')->with('likes')->get();

        return view('posts.index', ['posts' => $posts]);
    }
```

Ce code fait les choses suivantes :

1. Il utilise le modèle `Post` pour récupérer tous les posts de la base de
   données, triés par date de création (du plus récent au plus ancien), et en
   incluant les relations `user` et `likes`.
2. Il retourne la vue `posts.index` en lui passant les données des posts pour
   les afficher dans la vue.

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

Ces traductions sont utilisées dans la vue que nous venons de créer.

#### Tester la route

Sauvegardez toutes les modifications que vous avez effectuées, puis ouvrez votre
navigateur et accédez à l'URL <http://localhost:8000/posts> pour tester la route
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
        @if ($post->title)
            {{ __('ui.posts.show.title', [
                'post_title' => $post->title,
                'first_name' => $post->user->first_name,
                'last_name' => $post->user->last_name,
            ]) }}
        @else
            {{ __('ui.posts.show.title_without_post_title', [
                'first_name' => $post->user->first_name,
                'last_name' => $post->user->last_name,
            ]) }}
        @endif
    </x-slot>

    <x-slot:description>
        @if ($post->title)
            {{ __('ui.posts.show.description', [
                'post_title' => $post->title,
                'first_name' => $post->user->first_name,
                'last_name' => $post->user->last_name,
            ]) }}
        @else
            {{ __('ui.posts.show.description_without_post_title', [
                'first_name' => $post->user->first_name,
                'last_name' => $post->user->last_name,
            ]) }}
        @endif
    </x-slot>

    <article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
        <header class="mb-6">
            @if ($post->title)
                <h1 class="text-3xl font-bold dark:text-white mb-2">
                    {{ $post->title }}
                </h1>
            @endif

            <p class="text-sm text-gray-600 dark:text-gray-400">
                <a href="{{ url('@' . $post->user->username) }}">
                    {{ __('ui.posts.show.author', [
                        'first_name' => $post->user->first_name,
                        'last_name' => $post->user->last_name,
                    ]) }}
                </a>
                ·
                <span title="{{ $post->created_at->isoFormat('LLLL') }}">
                    {{ $post->created_at->diffForHumans() }}
                </span>
                ·
                <a href="{{ url('/posts/' . $post->id . '/edit') }}">
                    {{ __('ui.posts.edit.title_without_post_title') }}
                </a>
                ·
                <span class="font-semibold">
                    {{ trans_choice('ui.posts.likes_count', count($post->likes)) }}
                </span>
            </p>
        </header>

        <div class="mb-4">
            <p class="mt-4 dark:text-gray-300">
                {{ $post->content }}
            </p>
        </div>

        <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap gap-2">
                @forelse ($post->likes as $user)
                    <li class="flex items-center gap-1 text-sm text-gray-600 dark:text-gray-400">
                        <a href="{{ url('@' . $user->username) }}" class="font-semibold hover:underline">
                            {{ '@' . $user->username }}
                        </a>
                        <span>
                            @if ($user->pivot->reaction === 'like')
                                👍
                            @elseif($user->pivot->reaction === 'love')
                                ❤️
                            @elseif($user->pivot->reaction === 'haha')
                                😂
                            @elseif($user->pivot->reaction === 'wow')
                                😮
                            @elseif($user->pivot->reaction === 'sad')
                                😢
                            @elseif($user->pivot->reaction === 'angry')
                                😡
                            @endif
                        </span>
                    </li>
                @empty
                    <span class="text-sm text-gray-600 dark:text-gray-400">Aucune réaction</span>
                @endforelse
            </ul>
        </footer>
    </article>
</x-default-layout>
```

Cette vue affiche les détails du post avec le titre du post, le nom de
l'auteur.trice du post, la date de création du post, le nombre de likes du post,
le contenu du post, ainsi que la liste des utilisateur.trice.s qui ont aimé le
post avec leur réaction (like (👍), love (❤️), haha (😂), wow (😮), sad (😢),
angry (😡)).

De plus, un lien pour modifier le post a été ajouté, qui mène à la page
d'édition du post (par exemple, <http://localhost:8000/posts/1/edit>).

Chaque utilisateur.trice qui a aimé le post est affiché.e avec son nom
d'utilisateur et sa réaction. Il est possible de cliquer sur le nom
d'utilisateur pour accéder au profil de cet.te utilisateur.trice.

Selon si le post a un titre ou pas, la vue utilise différentes traductions pour
le titre et la description de la page, afin d'afficher des messages plus
pertinents pour les posts sans titre.

#### Mettre à jour l'action du contrôleur

La méthode `show` du contrôleur `PostController` est responsable d'afficher les
détails d'un post spécifique. Voici un exemple d'implémentation de la méthode
`show` dans le contrôleur `PostController` :

```php
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('user')->with('likes')->findOrFail($id);

        return view('posts.show', ['post' => $post]);
    }
```

Ce code fait les choses suivantes :

1. Il utilise le modèle `Post` pour rechercher le post correspondant à
   l'identifiant fourni en paramètre. Si aucun post n'est trouvé, une exception
   `ModelNotFoundException` est levée (grâce à l'utilisation de `findOrFail`),
   ce qui entraîne l'affichage d'une page d'erreur 404.
2. Si un post est trouvé, la méthode `show` retourne la vue `posts.show` en lui
   passant les données du post pour les afficher dans la vue.

Vous remarquerez l'utilisation de la vue `posts.show` pour afficher les détails
du post. Cela va automatiquement chercher la vue dans le dossier
`resources/views/posts/show.blade.php` pour afficher les détails du post.

#### Mettre à jour les traductions

Mettons à jour les traductions pour les différentes chaînes de caractères
utilisées dans la vue `posts.show`.

Ouvrez le fichier `resources/lang/fr/ui.php` et ajoutez les traductions
suivantes pour les différentes chaînes de caractères utilisées dans la vue
`posts.show` :

```php
// ...les autres traductions...
    'posts' => [
        // ...les autres traductions liées aux posts...
        'show' => [
            'title' => '":post_title" par :first_name :last_name',
            'title_without_post_title' => 'Post par :first_name :last_name',
            'description' => '":post_title" par :first_name :last_name.',
            'description_without_post_title' => 'Post de :first_name :last_name.',
            'author' => 'Publié par :first_name :last_name',
        ],
        // ...les autres traductions liées aux posts...
    ],
// ...les autres traductions...
```

Ces traductions sont utilisées dans la vue que nous venons de créer.

#### Tester la route

Sauvegardez toutes les modifications que vous avez effectuées, puis ouvrez votre
navigateur et accédez à une URL correspondant au format
`http://localhost:8000/posts/{id}` (par exemple,
<http://localhost:8000/posts/1>) pour tester la route qui affiche les détails
d'un post spécifique.

La page devrait s'afficher correctement avec les détails du post, y compris le
titre du post, le nom de l'auteur.trice du post, la date de création du post, le
nombre de likes du post, le contenu du post, ainsi que la liste des
utilisateur.trice.s qui ont aimé le post avec leur réaction (like (👍), love
(❤️), haha (😂), wow (😮), sad (😢), angry (😡)).

Si vous accédez à la page <http://localhost:8000/posts> et que vous cliquez sur
le titre ou le contenu d'un post, vous devriez être redirigé.e vers la page de
détails de ce post, où vous pourrez voir toutes les informations détaillées du
post.

### Méthode `create`

Dans cette section, nous allons implémenter la méthode `create` du contrôleur
`PostController` pour afficher le formulaire de création d'un nouveau post dans
notre application de réseau social.

Pour le moment, nous allons uniquement implémenter l'affichage de la page sans
avoir le formulaire de création d'un nouveau post. Le formulaire sera créé lors
d'une future séance.

#### Créer la vue

Pour créer la vue `create` pour afficher le formulaire de création d'un nouveau
post, utilisez la commande Artisan suivante dans votre terminal :

```bash
php artisan make:view posts.create
```

Le résultat devrait ressembler à ceci :

```text
   INFO  View [resources/views/posts/create.blade.php] created successfully.
```

En utilisant la notation `posts.create`, Laravel va créer un fichier
`create.blade.php` dans le dossier `resources/views/posts/`. Cette vue sera
utilisée pour afficher le formulaire de création d'un nouveau post.

Modifiez ensuite le fichier `resources/views/posts/create.blade.php` avec le
contenu suivant pour afficher le formulaire de création d'un nouveau post :

```php
<x-default-layout>
    <x-slot:title>
        {{ __('ui.posts.create.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.posts.create.description', ['app_name' => config('app.name')]) }}
    </x-slot>

    <article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-bold dark:text-white mb-2">
                {{ __('ui.posts.create.title') }}
            </h1>

            <p class="mt-4 dark:text-gray-300">
                {{ __('ui.posts.create.description', ['app_name' => config('app.name')]) }}
            </p>
        </header>

        {{-- Formulaire à venir... --}}
    </article>
</x-default-layout>
```

Cette vue affiche un titre et une description pour la page de création d'un
nouveau post. Le formulaire de création d'un nouveau post sera ajouté
ultérieurement.

#### Mettre à jour l'action du contrôleur

La méthode `create` du contrôleur `PostController` est responsable d'afficher le
formulaire de création d'un nouveau post. Voici un exemple d'implémentation de
la méthode `create` dans le contrôleur `PostController` :

```php
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }
```

Cette méthode retourne simplement la vue `posts.create` pour afficher le
formulaire de création d'un nouveau post.

#### Mettre à jour les traductions

Ouvrez le fichier `resources/lang/fr/ui.php` et ajoutez les traductions
suivantes pour les différentes chaînes de caractères utilisées dans la vue
`posts.create` :

```php
// ...les autres traductions...
    'posts' => [
        // ...les autres traductions liées aux posts...
        'create' => [
            'title' => 'Créer un nouveau post',
            'description' => 'Créez un nouveau post pour partager vos pensées avec le monde sur :app_name.',
        ],
        // ...les autres traductions liées aux posts...
    ],
```

#### Tester la route

Sauvegardez toutes les modifications que vous avez effectuées, puis ouvrez votre
navigateur et accédez à l'URL <http://localhost:8000/posts/create> pour tester
la route qui affiche le formulaire de création d'un nouveau post.

La page devrait s'afficher correctement avec le titre "Créer un nouveau post" et
la description "Créez un nouveau post pour partager vos pensées avec le monde
sur :app_name." (où `:app_name` est remplacé par le nom de votre application
défini dans le fichier `.env`/`.env.example`).

En passant par la page <http://localhost:8000/posts> et en cliquant sur le
bouton "Créer un nouveau post", vous devriez également être redirigé.e vers la
page de création d'un nouveau post.

### Méthode `edit`

Dans cette section, nous allons implémenter la méthode `edit` du contrôleur
`PostController` pour afficher le formulaire d'édition d'un post existant dans
notre application de réseau social.

Pour le moment, nous allons uniquement implémenter l'affichage de la page sans
avoir le formulaire d'édition d'un post existant. Le formulaire sera créé lors
d'une future séance.

#### Créer la vue

Pour créer la vue `edit` pour afficher le formulaire d'édition d'un post
existant, utilisez la commande Artisan suivante dans votre terminal :

```bash
php artisan make:view posts.edit
```

Le résultat devrait ressembler à ceci :

```text
   INFO  View [resources/views/posts/edit.blade.php] created successfully.
```

En utilisant la notation `posts.edit`, Laravel va créer un fichier
`edit.blade.php` dans le dossier `resources/views/posts/`. Cette vue sera
utilisée pour afficher le formulaire d'édition d'un post existant.

Modifiez ensuite le fichier `resources/views/posts/edit.blade.php` avec le
contenu suivant pour afficher le formulaire d'édition d'un post existant :

```php
<x-default-layout>
    <x-slot:title>
        @if ($post->title)
            {{ __('ui.posts.edit.title', ['post_title' => $post->title]) }}
        @else
            {{ __('ui.posts.edit.title_without_post_title') }}
        @endif
    </x-slot>

    <x-slot:description>
        @if ($post->title)
            {{ __('ui.posts.edit.description', ['post_title' => $post->title]) }}
        @else
            {{ __('ui.posts.edit.description_without_post_title') }}
        @endif
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">
        @if ($post->title)
            {{ __('ui.posts.edit.title', ['post_title' => $post->title]) }}
        @else
            {{ __('ui.posts.edit.title_without_post_title') }}
        @endif
    </h1>

    <p class="mt-4 dark:text-gray-300">
        @if ($post->title)
            {{ __('ui.posts.edit.description', ['post_title' => $post->title]) }}
        @else
            {{ __('ui.posts.edit.description_without_post_title') }}
        @endif
    </p>

    {{-- Formulaire à venir... --}}
</x-default-layout>
```

#### Mettre à jour l'action du contrôleur

La méthode `edit` du contrôleur `PostController` est responsable d'afficher le
formulaire d'édition d'un post existant. Voici un exemple d'implémentation de la
méthode `edit` dans le contrôleur `PostController` :

```php
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', ['post' => $post]);
    }
```

Cette méthode utilise le modèle `Post` pour rechercher le post correspondant à
l'identifiant fourni en paramètre. Si aucun post n'est trouvé, une exception
`ModelNotFoundException` est levée, ce qui entraîne l'affichage d'une page
d'erreur 404. Si un post est trouvé, la méthode `edit` retourne la vue
`posts.edit` en lui passant les données du post pour les afficher dans la vue.

Ici, comme nous souhaitons mettre à jour un post existant, nous n'avons besoin
que de récupérer les données du post. Il n'est pas nécessaire de récupérer les
données de l'utilisateur.trice ou des likes du post, car ces informations ne
sont pas affichées dans la vue `posts.edit` (du moins pour le moment, nous
pourrons les ajouter ultérieurement si nécessaire).

#### Mettre à jour les traductions

Ouvrez le fichier `resources/lang/fr/ui.php` et ajoutez les traductions
suivantes pour les différentes chaînes de caractères utilisées dans la vue
`posts.edit` :

```php
// ...les autres traductions...
    'posts' => [
        // ...les autres traductions liées aux posts...
        'edit' => [
            'title' => 'Modifier le post ":post_title"',
            'title_without_post_title' => 'Modifier le post',
            'description' => 'Modifiez le post ":post_title" pour mettre à jour son contenu.',
            'description_without_post_title' => 'Modifiez le post pour mettre à jour son contenu.',
        ],
        // ...les autres traductions liées aux posts...
    ],
```

#### Tester la route

Sauvegardez toutes les modifications que vous avez effectuées, puis ouvrez votre
navigateur et accédez à une URL correspondant au format
`http://localhost:8000/posts/{id}/edit` (par exemple,
<http://localhost:8000/posts/1/edit>) pour tester la route qui affiche le
formulaire d'édition d'un post existant.

La page devrait s'afficher correctement avec le titre "Modifier le post
":post_title"" (où `:post_title` est remplacé par le titre du post) ou "Modifier
le post" si le post n'a pas de titre, et la description "Modifiez le post
":post_title" pour mettre à jour son contenu." (où `:post_title` est remplacé
par le titre du post) ou "Modifiez le post pour mettre à jour son contenu." si
le post n'a pas de titre).

Il est également possible d'accéder à la page d'édition d'un post en cliquant
sur le lien "Modifier" dans la page de détails du post (par exemple,
<http://localhost:8000/posts/1>), qui redirige vers la page d'édition du post
(par exemple, <http://localhost:8000/posts/1/edit>).

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Mettre à jour la page d'accueil pour pointer vers la page de tous les posts

Dans cette section, nous allons mettre à jour la page d'accueil de notre
application de réseau social pour améliorer la navigation et permettre aux
utilisateur.trice.s d'accéder facilement à la page de tous les posts.

### Créer l'issue et la branche pour suivre cette tâche

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place l'internationalisation dans votre application
Laravel.

### Mettre à jour la route de la page d'accueil

Ouvrez le fichier `routes/web.php` et mettez à jour la route de la page
d'accueil avec le contenu suivant :

```php
Route::get('/', function () {
    $posts = Post::orderBy('created_at', 'desc')->with('user')->with('likes')->limit(3)->get();

    return view('home', ['posts' => $posts]);
});
```

La différence avec la version précédente de la route de la page d'accueil est
l'ajout de l'argument `limit(3)` à la requête pour récupérer uniquement les 3
posts les plus récents de la base de données.

Cela permettra d'encourager les utilisateur.trice.s à cliquer sur le lien "Voir
tous les posts" pour accéder à la page de tous les posts, plutôt que d'afficher
tous les posts directement sur la page d'accueil, ce qui pourrait être trop
chargé et moins incitatif à la navigation.

De plus, dans le futur, la page d'accueil pourrait être améliorée pour afficher
d'autres types de contenu (par exemple, les profiles les plus populaires, les
posts recommandés pour l'utilisateur.trice connecté.e, etc.), ce qui rendrait
encore plus important de limiter le nombre de posts affichés sur la page
d'accueil pour éviter de la surcharger.

### Mettre à jour la vue de la page d'accueil

Ouvrez le fichier `resources/views/home.blade.php` et mettez à jour le contenu
de la page d'accueil avec le contenu suivant :

```php
<x-default-layout>
    <x-slot:title>
        {{ __('ui.home.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.home.description') }}
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">
        {{ config('app.name') }}
    </h1>

    <p class="mt-4 dark:text-gray-300">
        {{ __('ui.home.introduction', ['app_name' => config('app.name')]) }}
    </p>

    <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-8">
        {{ __('ui.home.recent_posts') }}
    </h2>

    <div class="mt-8 space-y-6">
        @foreach ($posts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>

    <a href="{{ url('/posts') }}"
        class="mt-6 block w-full px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 text-center">
        {{ __('ui.home.see_all_posts') }}
    </a>
</x-default-layout>
```

La différence avec la version précédente de la page d'accueil est l'ajout d'un
lien "Voir tous les posts" à la fin de la page, qui redirige vers la page de
tous les posts (par exemple, <http://localhost:8000/posts>).

Comme la limitation de trois posts a été gérée dans la route de la page
d'accueil, il n'est pas nécessaire de faire des modifications supplémentaires
dans la vue pour gérer cette limitation. La vue de la page d'accueil affichera
automatiquement les trois posts les plus récents récupérés par la route.

### Mettre à jour les traductions

Ouvrez le fichier `resources/lang/fr/ui.php` et ajoutez les traductions
suivantes pour les différentes chaînes de caractères utilisées dans la vue de la
page d'accueil :

```php
// ...les autres traductions...
    'home' => [
        // ...les autres traductions liées à la page d'accueil...
        'recent_posts' => 'Posts récents',
        'see_all_posts' => 'Voir tous les posts',
    ],
// ...les autres traductions...
```

### Tester la page d'accueil

Sauvegardez toutes les modifications que vous avez effectuées, puis ouvrez votre
navigateur et accédez à l'URL <http://localhost:8000> pour tester la page
d'accueil de votre application de réseau social.

La page d'accueil devrait s'afficher correctement avec les trois posts les plus
récents, ainsi qu'un lien "Voir tous les posts" qui redirige vers la page de
tous les posts.

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Mettre à jour l'entête du layout par défaut pour ajouter un lien vers la page de tous les posts

Dans cette section, nous allons mettre à jour l'entête du layout par défaut de
notre application de réseau social pour ajouter un lien vers la page de tous les
posts, afin d'améliorer la navigation et permettre aux utilisateur.trice.s
d'accéder facilement à la page de tous les posts depuis n'importe quelle page de
l'application.

### Créer l'issue et la branche pour suivre cette tâche

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place l'internationalisation dans votre application
Laravel.

### Mettre à jour l'entête du layout par défaut

Ouvrez le fichier `resources/views/components/default-layout.blade.php` et
mettez à jour le contenu de l'entête du layout par défaut avec le contenu
suivant pour ajouter un lien vers la page de tous les posts :

> [!TIP]
>
> Cet affichage est ce qu'on appelle un "diff" (différence) entre la version
> précédente du fichier et la nouvelle version du fichier après les
> modifications.
>
> Le diff met en évidence les lignes qui ont été ajoutées, modifiées ou
> supprimées dans le fichier. Les lignes précédées d'un signe "+" sont les
> lignes ajoutées, les lignes précédées d'un signe "-" sont les lignes
> supprimées, et les lignes sans signe sont les lignes qui n'ont pas été
> modifiées. Cela permet de visualiser rapidement les changements apportés au
> fichier.
>
> Il s'agit d'une des multiples fonctionnalités de Git pour suivre les
> modifications dans les fichiers à l'aide de la commande `git diff`.
>
> La documentation officielle de Git sur la commande `git diff` est disponible à
> l'adresse suivante : <https://git-scm.com/docs/git-diff>.

```diff
diff --git a/resources/views/components/default-layout.blade.php b/resources/views/components/default-layout.blade.php
index c69bbc4..bce1a48 100644
--- a/resources/views/components/default-layout.blade.php
+++ b/resources/views/components/default-layout.blade.php
@@ -1,53 +1,59 @@
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     @isset($description)
         <meta name="description" content="{{ $description }}">
     @endisset
     <meta name="viewport" content="width=device-width, initial-scale=1">

     @isset($title)
         <title>{{ $title }} - {{ config('app.name') }}</title>
     @else
         <title>{{ config('app.name') }}</title>
     @endisset

     <!-- Styles / Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
 </head>

 <body class="flex min-h-screen flex-col bg-slate-50 dark:bg-slate-9
00">
     <header class="bg-teal-600 text-white dark:bg-slate-800">
         <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
             <div class="h-16 flex items-center justify-between">
-                <a href="{{ url('/') }}" class="block hover:opacity
-80 transition">
-                    {{ config('app.name') }}
-                </a>
+                <div class="flex items-center gap-4">
+                    <a href="{{ url('/') }}" class="block hover:opa
city-80 transition">
+                        {{ config('app.name') }}
+                    </a>
+                    <a href="{{ url('/posts') }}"
+                        class="block bg-teal-700 dark:bg-purple-900
 px-3 py-1 rounded-md hover:bg-teal-800 dark:hover:bg-purple-800">
+                        {{ __('ui.posts.index.title') }}
+                    </a>
+                </div>
                 <a href="{{ url('/profile') }}" class="block hover:
opacity-80 transition">
                     <img src="/icons/profile.svg" alt="{{ __('ui.pr
ofile.title') }}" class="h-8 w-8 rounded-full" />
                 </a>
             </div>
         </nav>
     </header>

     <main class="container mx-auto px-4 py-8 sm:px-6 lg:px-8 flex-g
row dark:text-white max-w-2xl">
         {{ $slot }}
     </main>

     <footer class="bg-teal-600 text-white text-sm dark:bg-slate-800
">
         <div class="container mx-auto px-4 py-6 sm:px-6 lg:px-8">
             <div class="h-16 flex flex-col items-center justify-bet
ween gap-4 sm:flex-row">
                 <p class="text-center sm:text-left">
                     {{ __('ui.about.copyright', ['year' => date('Y'
)]) }}
                 </p>
                 <a href="{{ url('/about') }}" class="block hover:op
acity-80 transition">
                     {{ __('ui.about.title') }}
                 </a>
             </div>
         </div>
     </footer>
 </body>

 </html>
```

Grâce à Tailwind CSS, le lien vers la page de tous les posts est stylisé pour se
démarquer dans l'entête du layout par défaut, ce qui facilite la navigation pour
les utilisateur.trice.s.

### Tester l'entête du layout par défaut

Sauvegardez toutes les modifications que vous avez effectuées, puis ouvrez votre
navigateur et accédez à l'URL <http://localhost:8000> pour tester la page
d'accueil de votre application de réseau social.

La page d'accueil devrait s'afficher correctement avec un lien vers la page de
tous les posts dans l'entête du layout par défaut. En cliquant sur ce lien, vous
devriez être redirigé.e vers la page de tous les posts (par exemple,
<http://localhost:8000/posts>).

Cet entête sera également affiché sur toutes les autres pages de l'application
qui utilisent le layout par défaut, ce qui permettra aux utilisateur.trice.s
d'accéder facilement à la page de tous les posts depuis n'importe quelle page de
l'application.

L'utilisation du layout par défaut permet de garantir une cohérence dans
l'apparence et la navigation de l'application, tout en facilitant la maintenance
du code en centralisant les éléments communs à toutes les pages (comme l'entête
et le pied de page) dans un seul fichier.

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Conclusion

Dans ce mini-projet, nous avons mise en place l'utilisation de routes et de
contrôleurs dans notre application Laravel pour gérer les différentes
fonctionnalités liées aux posts, telles que l'affichage des détails d'un post
spécifique, l'affichage du formulaire de création d'un nouveau post, et
l'affichage du formulaire d'édition d'un post existant.

Cette approche nous permet de mieux organiser notre code en séparant les
différentes responsabilités entre les routes, les contrôleurs et les vues, ce
qui facilite la maintenance et l'évolution de notre application à mesure que
nous ajoutons de nouvelles fonctionnalités.

Grâce à ces contrôleurs, nous pouvons facilement gérer les différentes actions
liées aux posts, telles que la création, l'affichage, la modification et la
suppression des posts, tout en gardant notre code propre et organisé.

Les routes et les contrôleurs sont les points d'entrée de notre application.
C'est eux qui gérent les requêtes HTTP entrantes, exécutent la logique métier
nécessaire pour traiter ces requêtes, et retournent les réponses appropriées
(par exemple, en affichant une vue, en redirigeant vers une autre page, etc.).
Ils sont essentiels pour le bon fonctionnement de notre application et pour
offrir une expérience utilisateur fluide et cohérente.

## Solution

La solution du mini-projet est accessible dans un dépôt GitHub dédié à l'adresse
suivante :
<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-mini-projet/tree/mini-projet-4>.

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

- Ajouter une page pour visualiser tous les profils des utilisateur.trices de
  votre application, avec la possibilité de cliquer sur un profil pour voir les
  détails de ce profil (par exemple, les posts de l'utilisateur.trice, les
  informations de profil, etc.).
- Ajouter une fonctionnalité de recherche pour permettre aux utilisateur.trice.s
  de rechercher des posts ou des profils d'utilisateur.trice.s en fonction de
  différents critères (par exemple, par mot-clé, par nom d'utilisateur, etc.).
- Ajouter une fonctionnalité de commentaires pour permettre aux
  utilisateur.trice.s de commenter les posts, avec la possibilité de répondre
  aux commentaires pour créer des discussions.
- Ajouter une fonctionnalité de notifications pour informer les
  utilisateur.trice.s des nouvelles activités liées à leurs posts ou à leurs
  profils (par exemple, lorsqu'un post reçoit un nouveau like, lorsqu'un
  utilisateur.trice commence à suivre un autre utilisateur.trice, etc.).

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé les exercices et le mini-projet.

- Seriez-vous capable de transformer la page de détails d'un post pour utiliser
  un composant `PostDetail` dédié, de manière similaire à ce que nous avons fait
  pour le composant `PostCard` ?
- Seriez-vous capable de mettre en place des tests automatisés pour les routes
  et les contrôleurs de votre application Laravel ? Pour cela, vous pouvez vous
  aider de la documentation officielle de Laravel sur les tests :
  <https://laravel.com/docs/10.x/testing>, et plus particulièrement la page
  <https://laravel.com/docs/12.x/http-tests>.
- Seriez-vous capable de mettre en place des pages personnalisées pour les
  erreurs 403, 404 et 500 dans votre application Laravel ? Pour cela, vous
  pouvez vous aider de la documentation officielle de Laravel sur les pages
  d'erreur personnalisées :
  <https://laravel.com/docs/12.x/errors#custom-http-error-pages>.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
