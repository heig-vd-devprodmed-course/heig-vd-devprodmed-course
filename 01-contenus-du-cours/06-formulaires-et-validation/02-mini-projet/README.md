# Formulaires et validation - Mini-projet

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
- [Identifier les étapes à suivre](#identifier-les-étapes-à-suivre)
- [TODO](#todo)
- [Mettre en place les formulaires pour gérer les posts](#mettre-en-place-les-formulaires-pour-gérer-les-posts)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche)
  - [Formulaire de création](#formulaire-de-création)
  - [Formulaire d'édition](#formulaire-dédition)
  - [Formulaire de suppression](#formulaire-de-suppression)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request)
- [Mettre en place les formulaires pour gérer le profil utilisateur.trice](#mettre-en-place-les-formulaires-pour-gérer-le-profil-utilisateurtrice)
  - [Améliorer la page de profil utilisateur.trice](#améliorer-la-page-de-profil-utilisateurtrice)
- [Mettre en place le formulaire pour liker un post](#mettre-en-place-le-formulaire-pour-liker-un-post)
- [Utiliser des Form Requests pour valider les formulaires](#utiliser-des-form-requests-pour-valider-les-formulaires)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Mettre en place tous les formulaires nécessaires pour permettre aux
utilisateur.trice.s de créer, éditer et supprimer des posts, ainsi que de gérer
leur profil utilisateur.trice.

## Identifier les étapes à suivre

Maintenant que nous avons une bonne compréhension du patron de conception MVC
(modèles, vues et contrôleurs), nous allons pouvoir mettre en place les
formulaires nécessaires pour permettre aux utilisateur.trice.s de créer, éditer
et supprimer des posts, ainsi que de gérer leur profil utilisateur.trice.

Ces différentes tâchent requièrent de toucher à tous les aspects de
l'application : base de données, vue, composants, etc. Prenez quelques minutes
pour lister les tâches que vous allez devoir réaliser pour cette partie avec
leurs implications.

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir aux tâches que vous allez devoir faire.
>
> N'hésitez pas à proposer d'autres tâches que celles mentionnées dans cet
> exemple.

- Créer les formulaires de création, d'édition et de suppression de posts.
- Mettre à jour les routes et les méthodes de contrôleur pour gérer la création,
  la mise à jour et la suppressions des posts associés.
- Mettre à jour les vues pour gérer les posts.
- Mettre à jour les traductions pour la gestion des posts.
- Créer une migration pour rajouter un champ pour l'image de profil de la
  personne.
- Créer les formulaires de mise à jour et de suppression du profil.
- Mettre à jour les routes et les méthodes de contrôleur pour gérer la création,
  la mise à jour et la suppressions du profil.
- Mettre à jour les vues pour gérer le profil.
- Mettre à jour les traductions pour la gestion du profil.

</details>

## TODO

```bash
php artisan make:controller --singleton MyProfileController

php artisan make:view my-profile.show

php artisan make:view my-profile.edit

php artisan make:migration add_profile_picture_to_users_table

php artisan migrate

php artisan storage:link

php artisan make:request StorePostRequest

php artisan make:request UpdatePostRequest

php artisan make:request UpdateMyProfileRequest

php artisan make:request UpdateLikeRequest

```

```text
   INFO  Controller [app/Http/Controllers/MyProfileController.php] created successfully.

   INFO  View [resources/views/my-profile/show.blade.php] created successfully.

   INFO  View [resources/views/my-profile/edit.blade.php] created successfully.


   INFO  Migration [database/migrations/2026_03_04_143945_add_profile_picture_to_users_table.php] created successfully.

   INFO  Running migrations.

  2026_03_04_143945_add_profile_picture_to_users_table ........................... 8.14ms DONE


   INFO  The [public/storage] link has been connected to [storage/app/public].

   INFO  Request [app/Http/Requests/StorePostRequest.php] created successfully.

   INFO  Request [app/Http/Requests/UpdatePostRequest.php] created successfully.

   INFO  Request [app/Http/Requests/UpdateMyProfileRequest.php] created successfully.

   INFO  Request [app/Http/Requests/UpdateLikeRequest.php] created successfully.
```

## Mettre en place les formulaires pour gérer les posts

Dans cette section, nous allons mettre en place les formulaires nécessaires pour
permettre aux utilisateur.trice.s de créer, éditer et supprimer des posts.

### Créer l'issue et la branche pour suivre cette tâche

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place les formulaires pour gérer les posts.

### Formulaire de création

#### Mettre à jour la vue

Dans le fichier `resources/views/posts/create.blade.php`, rajoutez le formulaire
suivant pour créer un nouveau post :

```php
        <form method="POST" action="{{ url('/posts') }}">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.posts.form.fields.title.label') }}
                </label>
                <input id="title" type="text" name="title" value="{{ old('title') }}"
                    placeholder="{{ __('ui.posts.form.fields.title.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('title') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.posts.form.fields.content.label') }}
                </label>
                <textarea id="content" name="content" rows="5"
                    placeholder="{{ __('ui.posts.form.fields.content.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('content') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <a href="{{ url('/posts') }}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                        {{ __('ui.posts.form.actions.cancel') }}
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 cursor-pointer">
                        {{ __('ui.posts.form.actions.submit') }}
                    </button>
                </div>
            </footer>
        </form>
```

Prenez quelques minutes pour comprendre ce bout de code et essayez de répondre
aux questions suivantes :

- Comment est structuré le formulaire ? Quels éléments le composent ?
- Vers quelle URL les données sont envoyées ? Avec quelle méthode HTTP ?
- Est-ce que le formulaire est protégé contre les attaques CSRF ? Si oui,
  comment ?
- Quels sont les mécanismes mis en place pour afficher les erreurs de
  validations ?
- Est-ce que les données sont préservées en cas d'erreur de validation ? Comment
  cela s'articule ?
- Comment sont utilisées les traductions dans ce formulaire ? Comment sont-elles
  structurées ?

Vous pouvez vous aider de la [théorie](../README.md) pour répondre à chacune de
ces questions.

#### Mettre à jour les traductions

Ouvrez le fichier `lang/fr/ui.php` et rajoutez les lignes suivantes au fichier :

```php
<?php

declare(strict_types=1);

return [
    // Autres traductions liées aux autres pages...
    'posts' => [
        // Autres traductions liées aux posts...
        'form' => [
            'fields' => [
                'title' => [
                    'label' => 'Titre (optionnel)',
                    'placeholder' => 'Entrez un titre pour votre post (optionnel)',
                ],
                'content' => [
                    'label' => 'Contenu',
                    'placeholder' => 'Exprimez-vous librement dans votre post...',
                ],
            ],
            'actions' => [
                'submit' => 'Sauvegarder',
                'cancel' => 'Annuler',
            ],
        ],
        // Autres traductions liées aux posts...
    ],
    // Autres traductions liées aux autres pages...
];
```

Comme les données du formulaire seront utilisées autant pour la création d'un
post que sa mise à jour, tous les champs communs sont mis au même niveau que les
autres pages/vues propres aux posts (`posts.create`, `posts.index`,
`posts.edit`, `posts.show`).

Ouvrez maintenant le fichier `lang/fr/validation.php` que la libraire
[`laravel-lang/lang`](https://laravel-lang.com/packages-lang.html) a créé dans
une précédente séance.

Vous noterez que ce fichier contient déjà plusieurs traductions liées à la
validation utilisée par Laravel.

Rajoutez les lignes suivantes au fichier :

```php
<?php

declare(strict_types=1);

return [
    // Autres traductions liées à la validation...
    'attributes' => [
        'content'         => 'contenu',
        'title'           => 'titre',
    ],
    // Autres traductions liées à la validation...
];
```

Ces quelques lignes permettront de traduire correctement les attributs dans les
erreurs de validation.

Par exemple, plutôt que d'afficher _"Le texte de title doit contenir au moins 3
caractères."_ (notez le terme _"title"_, issue de l'attribut `name` donné au
champ `input` du formulaire), l'attribut sera correctement traduit avec le texte
_"Le texte de titre doit contenir au moins 3 caractères."_

#### Mettre à jour les routes et le contrôleur

Ouvrez maintenant le fichier `app/Http/Controllers/PostController.php`. Mettez à
jour la fonction `store` du contrôleur avec le code suivant :

```php
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:5000',
        ]);

        $user = User::where('username', 'janedoe')->first();
        $post = new Post();

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user()->associate($user);

        $post->save();

        return redirect("/posts/$post->id");
    }
```

En effet, selon les conventions de Laravel, cette méthode est appelée lors de la
soumission d'un formulaire avec la méthode HTTP POST pour la création d'une
nouvelle ressource (un nouveau post).

Lors de la création du post, pour le moment, nous associons ce nouveau post à
l'utilisatrice Jane Doe (username `janedoe`). Dans une future séance, nous
gérerons les utilisateur.trices authentifiées et nous pourrons mettre à jour le
code pour associer le post à la personne actuellement connectée.

Prenez quelques minutes pour comprendre ce bout de code et essayez de répondre
aux questions suivantes :

- Y-a-t-il des règles de validation appliquées sur la requête ? Si oui,
  lesquelles ?
- Si des erreurs de validation se produisent, que se passe-t-il ?
- Comment ce nouveau post est-il lié à l'utilisatrice Jane Doe ?
- Comment ce nouveau post est-il sauvegardé en base de données ?
- Vers quelle page la personne est redirigée une fois le post sauvegardé ? Pour
  quelle raison ?

#### Tester le formulaire

Sauvegardez tous les fichiers mis à jour et accédez à la page de création d'un
nouveau post.

Un formulaire devrait maintenant être présent, vous permettant de créer un
nouveau post avec un titre et un contenu !

Essayez de créer de nouveaux posts ainsi que des posts qui ne respectent pas les
règles de validation (vous pouvez utiliser la ressource
<https://www.lipsum.com/> pour générer une grande quantité de texte si besoin).

Lorsqu'un nouveau post a été créé avec succès, vous devriez avoir accès à la
page de détail du post fraîchement créé !

Essayez maintenant de rajouter une règle de validation pour que le contenu soit
de minimum trois (3) caractères. Que devriez-vous faire pour proposer cette
nouvelle règle de validation ? Testez votre solution. Le message d'erreur de
validation devrait s'afficher correctement.

<details>
<summary>Afficher la réponse</summary>

Afin de rajouter cette règle de validation, il suffit d'ajouter la règle `min:3`
au contenu du post :

```php
$validated = $request->validate([
    'title' => 'nullable|string|max:255',
    'content' => 'required|string|min:3|max:5000',
]);
```

</details>

### Formulaire d'édition

#### Mettre à jour la vue

Dans le fichier `resources/views/posts/edit.blade.php`, rajoutez le formulaire
suivant pour mettre à jour un post :

```php

        <form method="POST" action="{{ url('/posts/' . $post->id) }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.posts.form.fields.title.label') }}
                </label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                    placeholder="{{ __('ui.posts.form.fields.title.placeholder') }}"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 dark:focus:ring-purple-500 focus:border-transparent @error('title') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.posts.form.fields.content.label') }}
                </label>
                <textarea id="content" name="content" rows="5"
                    placeholder="{{ __('ui.posts.form.fields.content.placeholder') }}"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 dark:focus:ring-purple-500 focus:border-transparent @error('content') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex gap-2">
                        <a href="{{ url('/posts/' . $post->id) }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                            {{ __('ui.posts.form.actions.cancel') }}
                        </a>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 cursor-pointer">
                        {{ __('ui.posts.form.actions.submit') }}
                    </button>
                </div>
            </footer>
        </form>
```

Prenez quelques minutes pour comprendre ce bout de code et essayez de répondre
aux questions suivantes :

> [!NOTE]
>
> Prenez le temps de comparer avec le précédent formulaire et d'identifier les
> différences.

- Comment est structuré le formulaire ? Quels éléments le composent ?
- Vers quelle URL les données sont envoyées ? Avec quelle méthode HTTP ?
- Comment le post spécifique est utilisé dans le formulaire ?
- Est-ce que le formulaire est protégé contre les attaques CSRF ? Si oui,
  comment ?
- Quels sont les mécanismes mis en place pour afficher les erreurs de
  validations ?
- Est-ce que les données sont préservées en cas d'erreur de validation ? Comment
  cela s'articule ? Est-ce qu'il y a une différence avec le précédent formulaire
  ? Si oui, laquelle ?
- Comment sont utilisées les traductions dans ce formulaire ? Comment sont-elles
  structurées ?

Vous pouvez vous aider de la [théorie](../README.md) pour répondre à chacune de
ces questions.

#### Mettre à jour les traductions

Comme toutes les traduction du formulaire ont déjà été créées dans la section
précédente, il n'y a rien à faire ici pour le moment.

#### Mettre à jour les routes et le contrôleur

Ouvrez maintenant le fichier `app/Http/Controllers/PostController.php`. Mettez à
jour la fonction `store` du contrôleur avec le code suivant :

```php
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:5000',
        ]);

        $post = Post::findOrFail($id);

        $post->title = $validated['title'];
        $post->content = $validated['content'];

        $post->save();

        return redirect("/posts/$post->id");
    }
```

En effet, selon les conventions de Laravel, cette méthode est appelée lors de la
soumission d'un formulaire avec la méthode HTTP PATCH ou PUT pour la mise à jour
d'une ressource (un post existant).

Prenez quelques minutes pour comprendre ce bout de code et essayez de répondre
aux questions suivantes :

- Comment le post spécifique est utilisé dans le contrôleur ?
- Y-a-t-il des règles de validation appliquées sur la requête ? Si oui,
  lesquelles ?
- Si des erreurs de validation se produisent, que se passe-t-il ?
- Comment ce post est-il lié à l'utilisatrice Jane Doe ?
- Comment ce post est-il sauvegardé en base de données ?
- Vers quelle page la personne est redirigée une fois le post mis à jour ? Pour
  quelle raison ?

#### Tester le formulaire

Sauvegardez tous les fichiers mis à jour et accédez à la page de mise à jour
d'un post. Pour rappel, vous pouvez y accéder depuis la page de visualisation
d'un post, dans l'entête.

Un formulaire devrait maintenant être présent, vous permettant de modifier un
post avec un titre et un contenu !

Essayez de créer de mettre à jour des posts ainsi que des posts qui ne
respectent pas les règles de validation (vous pouvez utiliser la ressource
<https://www.lipsum.com/> pour générer une grande quantité de texte si besoin).

Lorsqu'un post a été mis à jour avec succès, vous devriez avoir accès à la page
de détail du post mis à jour !

### Formulaire de suppression

#### Mettre à jour la vue

Afin de supprimer le post, nous allons rajouter un bouton de suppression dans la
page d'édition du post.

Dans le fichier `resources/views/posts/edit.blade.php`, rajoutez le formulaire
suivant pour supprimer un post :

> [!NOTE]
>
> Comme présenté dans le cours précédent, l'affiche ci-dessous est un "diff"
> généré avec la commande `git diff`.
>
> Cela permet de mettre en avant les différences entre deux versions de
> fichiers.
>
> Prenez le temps d'identifier où dans le fichier le nouveau code doit se
> placer.

```diff
diff --git a/resources/views/posts/edit.blade.php b/resources/views/posts/edit.blade.php
index a7bac65..b2854be 100644
--- a/resources/views/posts/edit.blade.php
+++ b/resources/views/posts/edit.blade.php
@@ -69,6 +69,11 @@ class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md b
                             class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                             {{ __('ui.posts.form.actions.cancel') }}
                         </a>
+                        <button type="submit" form="delete-post-form"
+                            onclick="return confirm('{{ __('ui.posts.form.actions.delete_confirm') }}')"
+                            class="px-4 py-2 bg-red-600 dark:bg-red-900 text-white rounded-md hover:bg-red-700 dark:hover:bg-red-800 cursor-pointer">
+                            {{ __('ui.posts.form.actions.delete') }}
+                        </button>
                     </div>
                     <button type="submit"
                         class="px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 cursor-pointer">
@@ -77,5 +82,10 @@ class="px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-t
                 </div>
             </footer>
         </form>
+
+        <form id="delete-post-form" method="POST" action="{{ url('/posts/' . $post->id) }}" class="hidden">
+            @csrf
+            @method('DELETE')
+        </form>
     </article>
 </x-default-layout>
```

Le formulaire de suppression est un cas un peu différent des formulaires que
nous avons créé jusqu'ici. En effet, selon la spécification HTML, il n'est pas
possible d'avoir des formulaires imbriqués les uns dans les autres.

Or, dans notre cas, nous souhaitons avoir un bouton de suppression à côté du
bouton d'annulation, lui-même situé dans le premier formulaire de la page
d'édition du post.

Heureusement pour nous, il est possible de créer des formulaires séparés et
d'indiquer à un bouton de soumission de formulaire (`type="submit"`) pour quel
formulaire la soumission doit avoir lieu (`form="delete-post-form"`) !

Nous utilisons également une alerte JavaScript pour demander la confirmation de
suppression à l'utilisateur.trice à l'aide de l'attribut `onclick`
(`onclick="return confirm('{{ __('ui.posts.form.actions.delete_confirm') }}')"`).

Ce bout de code fonctionne de la manière suivante :

- La fonction JavaScript `confirm` ouvre une boîte de dialogue avec un message
  de confirmation.
- La personne a le choix entre accepter ou refuser l'action.
- Si la personne accepte, la fonction `confirm` retourne `true` et la soumission
  du formulaire a lieu.
- Si la personne refuse, la fonction `confirm` retourne `false` et la soumission
  du formulaire n'a simplement pas lieu.

De plus, le formulaire est caché (grâce à la classe CSS `hidden`), ce qui permet
de ne pas montrer ce formulaire à l'utilisateur.trice final.e mais pourquoi
bénéficier de son utilisation.

Prenez quelques minutes pour comprendre ce bout de code et essayez de répondre
aux questions suivantes :

- Où est situé le formulaire de suppression dans la page ? Pourquoi selon vous ?
- Vers quelle URL les données sont envoyées ? Avec quelle méthode HTTP ?
- Est-ce que le formulaire est protégé contre les attaques CSRF ? Si oui,
  comment ?
- Quels sont les mécanismes mis en place pour afficher les erreurs de
  validations ?
- Est-ce que les données sont préservées en cas d'erreur de validation ? Comment
  cela s'articule ?
- Comment sont utilisées les traductions dans ce formulaire ? Comment sont-elles
  structurées ?

Vous pouvez vous aider de la [théorie](../README.md) pour répondre à chacune de
ces questions.

#### Mettre à jour les traductions

Ouvrez le fichier `lang/fr/ui.php` et rajoutez les lignes suivantes au fichier :

```php
<?php

declare(strict_types=1);

return [
    // Autres traductions liées aux autres pages...
    'posts' => [
        // Autres traductions liées aux posts...
        'form' => [
            // Autres traductions liées au(x) formulaire(s) des posts...
            'actions' => [
                // Autres traductions liées aux actions des formulaires des posts...
                'delete' => 'Supprimer',
                'delete_confirm' => 'Souhaitez-vous vraiment supprimer ce post ? Cette action est irréversible.',
                // Autres traductions liées aux actions des formulaires des posts...
            ],
            // Autres traductions liées au(x) formulaire(s) des posts...
        ],
        // Autres traductions liées aux posts...
    ],
    // Autres traductions liées aux autres pages...
];
```

Ici, nous ajoutons simplement les actions propres à la suppression d'un post
avec le nom donné au bouton de suppression et le message de confirmation.

#### Mettre à jour les routes et le contrôleur

Ouvrez maintenant le fichier `app/Http/Controllers/PostController.php`. Mettez à
jour la fonction `destroy` du contrôleur avec le code suivant :

```php
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);

        return redirect("/posts");
    }
```

En effet, selon les conventions de Laravel, cette méthode est appelée lors de la
soumission d'un formulaire avec la méthode HTTP DELETE pour la suppression d'une
ressource (un post).

Prenez quelques minutes pour comprendre ce bout de code et essayez de répondre
aux questions suivantes :

- Y-a-t-il des règles de validation appliquées sur la requête ? Si oui,
  lesquelles ?
- Si des erreurs de validation se produisent, que se passe-t-il ?
- Comment ce nouveau post est-il modifié en base de données ?
- Vers quelle page la personne est redirigée une fois le post supprimé ? Pour
  quelle raison ?

#### Tester le formulaire

Sauvegardez tous les fichiers mis à jour et accédez à la page d'édition d'un
post.

Un nouveau bouton de suppression devrait maintenant être présent, vous
permettant de supprimer un post ! Le formulaire associé devrait être invisible.

Essayez de supprimer certains posts.

Lorsqu'un nouveau post a été supprimé avec succès, vous devriez avoir accès à la
page contenant tous les posts restants !

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Mettre en place les formulaires pour gérer le profil utilisateur.trice

### Améliorer la page de profil utilisateur.trice

## Mettre en place le formulaire pour liker un post

## Utiliser des Form Requests pour valider les formulaires

## Conclusion

TODO

## Solution

La solution du mini-projet est accessible dans un dépôt GitHub dédié à l'adresse
suivante :
<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-mini-projet/tree/mini-projet-5>.

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

- Seriez-vous capable de transformer l'entête du profil pour utiliser un
  composant `ProfileHeader` dédié, de manière similaire à ce que nous avons fait
  pour le composant `PostCard` ?
- Seriez-vous capable de transformer les formulaires en composants dédiés, de
  manière similaire à ce que nous avons fait pour le composant `PostCard` ?

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
