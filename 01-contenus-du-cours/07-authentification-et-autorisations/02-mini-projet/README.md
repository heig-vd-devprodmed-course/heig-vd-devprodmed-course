# Authentification et autorisations - Mini-projet

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
- [Identifier les tâches à réaliser](#identifier-les-tâches-à-réaliser)
- [Créer le nécessaire pour s'inscrire et se connecter](#créer-le-nécessaire-pour-sinscrire-et-se-connecter)
  - [Modifier la base de données et les modèles](#modifier-la-base-de-données-et-les-modèles)
  - [Gérer l'inscription](#gérer-linscription)
  - [Gérer la connexion](#gérer-la-connexion)
  - [Gérer la déconnexion](#gérer-la-déconnexion)
  - [Mettre à jour la barre de navigation principale](#mettre-à-jour-la-barre-de-navigation-principale)
- [Utiliser la personne authentifiée dans le reste de l'application](#utiliser-la-personne-authentifiée-dans-le-reste-de-lapplication)
  - [Associer la personne authentifiée aux posts](#associer-la-personne-authentifiée-aux-posts)
  - [Associer la personne authentifiée aux likes](#associer-la-personne-authentifiée-aux-likes)
  - [Associer la personne authentifiée à son propre profil](#associer-la-personne-authentifiée-à-son-propre-profil)
- [N'autoriser que l'auteur.trice à modifier ses propres posts](#nautoriser-que-lauteurtrice-à-modifier-ses-propres-posts)
  - [Créer une politique d'autorisation](#créer-une-politique-dautorisation)
  - [Mettre à jour la politique d'autorisation](#mettre-à-jour-la-politique-dautorisation)
  - [Utiliser la politique d'autorisation dans le contrôleur](#utiliser-la-politique-dautorisation-dans-le-contrôleur)
  - [Tester les autorisations](#tester-les-autorisations)
- [Restreindre l'accès aux routes pour les personnes non authentifiées](#restreindre-laccès-aux-routes-pour-les-personnes-non-authentifiées)
  - [Utiliser le middleware d'authentification](#utiliser-le-middleware-dauthentification)
  - [Tester les restrictions d'accès](#tester-les-restrictions-daccès)
- [Masquer les éléments de l'interface utilisateur pour les personnes non authentifiées ou non autorisées](#masquer-les-éléments-de-linterface-utilisateur-pour-les-personnes-non-authentifiées-ou-non-autorisées)
  - [Masquer les fonctionnalités de modification et de suppression des posts](#masquer-les-fonctionnalités-de-modification-et-de-suppression-des-posts)
- [Tester les fonctionnalités d'authentification](#tester-les-fonctionnalités-dauthentification)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Mettre en place tous les mécanismes nécessaires pour permettre aux
utilisateur.trice.s de se créer un compte, se connecter, et gérer leur compte
avec leurs propres posts.

Nous allons donc devoir toucher à tous les aspects que nous avons étudié
jusqu'ici : base de données, modèles, vues, contrôleurs, etc.

## Identifier les tâches à réaliser

Maintenant que nous avons une bonne compréhension du patron de conception MVC
(modèles, vues et contrôleurs), nous allons pouvoir mettre en place les
mécanismes nécessaires pour permettre aux utilisateur.trice.s de se créer un
compte, se connecter, et gérer leur compte avec leurs propres posts.

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

- Modifier la base de données et les modèles pour ajouter les champs nécessaires
  à l'authentification.
- Créer les vues pour l'inscription et la connexion.
- Créer les contrôleurs et les routes pour gérer l'inscription, la connexion et
  la déconnexion.
- Associer les posts, les likes et les profils à la personne authentifiée.
- N'autoriser que l'auteur.trice d'un post à le modifier ou le supprimer.
- Restreindre l'accès aux routes pour les personnes non authentifiées.
- Modifier l'interface utilisateur pour masquer les éléments de l'interface
  utilisateur pour les personnes non authentifiées ou non autorisées.

</details>

## Créer le nécessaire pour s'inscrire et se connecter

Dans cette section, nous allons mettre en place les mécanismes nécessaires pour
permettre aux utilisateur.trice.s de se créer un compte et se connecter.

Pour cela, nous allons devoir :

1. Modifier la base de données et les modèles pour ajouter les champs
   nécessaires à l'authentification.
2. Créer les vues pour l'inscription et la connexion.
3. Créer les contrôleurs et les routes pour gérer l'inscription, la connexion et
   la déconnexion.
4. Protéger les ressources précédemment créées pour que seules les personnes
   authentifiées puissent y accéder.

### Modifier la base de données et les modèles

#### Créer la migration

Comme nous allons modifier la base de données, nous allons devoir créer une
nouvelle migration pour ajouter les champs nécessaires à l'authentification.

Pour créer une migration, vous pouvez utiliser la commande suivante dans votre
terminal à la racine de votre projet Laravel :

```bash
php artisan make:migration add_authentication_fields_to_users_table
```

Le résultat devrait ressembler à ceci :

```bash
   INFO  Migration [database/migrations/2026_03_16_112655_add_authentication_fields_to_users_table.php] created successfully.
```

Laravel devrait avoir identifié la table `users` à modifier et avoir généré une
migration avec les méthodes `up` et `down` prêtes à être remplies.

Vous pouvez maintenant remplir les méthodes `up` et `down` de la migration pour
ajouter les champs nécessaires à l'authentification :

```php
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->after('email');
            $table->rememberToken()->after('password');
        });
    }
```

```php
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropRememberToken();
        });
    }
```

Cette migration ajoute deux champs à la table `users` :

1. Un champ `password` pour stocker le mot de passe de l'utilisateur.trice.
2. Un champ `remember_token` pour gérer la fonctionnalité "se souvenir de moi"
   lors de la connexion. Ce mécanisme permet de garder l'utilisateur.trice
   connecté.e même après la fermeture du navigateur.

#### Appliquer la migration

Une fois que vous avez rempli les méthodes `up` et `down`, vous pouvez exécuter
la migration pour appliquer les modifications à la base de données :

```bash
php artisan migrate
```

Une erreur peut survenir lors de l'exécution de la migration si vous avez déjà
des données dans la table `users` qui ne respectent pas les nouvelles
contraintes (par exemple, des utilisateur.trices sans mot de passe). Si c'est le
cas, vous pouvez soit supprimer les données existantes, soit modifier la
migration pour ajouter des valeurs par défaut ou rendre les champs nullable
temporairement.

Je (Ludovic) vous recommande de supprimer les données existantes pour éviter les
complications, surtout si vous êtes en phase de développement et que vous n'avez
pas encore de données importantes dans la base de données :

```bash
php artisan migrate:refresh
```

La commande `migrate:refresh` va supprimer toutes les tables de la base de
données et les recréer en appliquant toutes les migrations depuis le début, ce
qui vous permettra de repartir sur une base propre avec les nouvelles
modifications (source :
<https://laravel.com/docs/12.x/migrations#roll-back-migrate-using-a-single-command>).

Une fois que la migration est exécutée avec succès, vous pouvez vérifier que les
nouveaux champs ont été ajoutés à la table `users` en utilisant un outil de
gestion de base de données.

#### Mettre à jour le seeder

Comme nous avons modifié la structure de la table `users`, nous allons également
devoir mettre à jour le seeder pour ajouter des mots de passe aux
utilisateur.trice.s que nous avons créés précédemment. Vous pouvez le faire en
modifiant le fichier `database/seeders/DatabaseSeeder.php` pour inclure des mots
de passe hachés lors de la création des utilisateur.trice.s :

```diff
diff --git a/database/seeders/DatabaseSeeder.php b/database/seeders/DatabaseSeeder.php
index 040349d..6e3655d 100644
--- a/database/seeders/DatabaseSeeder.php
+++ b/database/seeders/DatabaseSeeder.php
@@ -4,6 +4,7 @@

 use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;
+use Illuminate\Support\Facades\Hash;

 class DatabaseSeeder extends Seeder
 {
@@ -21,6 +22,7 @@ function () {
                     'last_name' => 'Doe',
                     'username' => 'johndoe',
                     'email' => 'john.doe@example.com',
+                    'password' => Hash::make('password'),
                     'created_at' => new \DateTime('2026-02-09 10:00:00'),
                     'updated_at' => new \DateTime('2026-02-09 10:00:00'),
                 ]);
@@ -32,6 +34,7 @@ function () {
                     'last_name' => 'Doe',
                     'username' => 'janedoe',
                     'email' => 'jane.doe@example.com',
+                    'password' => Hash::make('password'),
                     'created_at' => new \DateTime('2026-02-09 11:00:00'),
                     'updated_at' => new \DateTime('2026-02-09 11:00:00'),
                 ]);
```

La classe `Hash` de Laravel fournit une méthode `make` qui permet de hacher les
mots de passe de manière sécurisée avant de les stocker dans la base de données.
Il est important de ne jamais stocker les mots de passe en clair dans la base de
données pour des raisons de sécurité.

#### Appliquer le seeder

Une fois que vous avez mis à jour le seeder, vous pouvez l'exécuter pour ajouter
les utilisateur.trice.s avec les mots de passe hachés à la base de données :

```bash
php artisan db:seed
```

Vous pouvez valider que les utilisateur.trice.s ont été ajoutés avec des mots de
passe hachés en vérifiant la table `users` dans votre base de données.

#### Mettre à jour les modèles

Maintenant que nous avons modifié la structure de la table `users`, nous allons
également devoir mettre à jour le modèle `User` pour refléter ces changements.
Ouvrez le fichier `app/Models/User.php` et modifiez-le pour qu'il étende la
classe `Authenticatable` de Laravel, qui fournit les fonctionnalités nécessaires
pour l'authentification :

```diff
diff --git a/app/Models/User.php b/app/Models/User.php
index eeaf385..1e640a5 100644
--- a/app/Models/User.php
+++ b/app/Models/User.php
@@ -2,11 +2,11 @@

 namespace App\Models;

-use Illuminate\Database\Eloquent\Model;
+use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Database\Eloquent\Relations\BelongsToMany;
 use Illuminate\Database\Eloquent\Relations\HasMany;

-class User extends Model
+class User extends Authenticatable
 {
     /**
      * Get the posts for the user.
```

En étendant la classe `Authenticatable`, le modèle `User` hérite de toutes les
fonctionnalités nécessaires pour l'authentification, telles que la gestion des
mots de passe, la gestion des tokens de "se souvenir de moi", etc. Cela nous
permettra de gérer l'authentification de manière plus simple et sécurisée dans
le reste de l'application.

Nous avons maintenant tous les éléments nécessaires en place pour permettre aux
utilisateur.trice.s de se créer un compte et se connecter. Nous allons pouvoir
passer à la création des vues pour l'inscription et la connexion.

### Gérer l'inscription

Pour permettre aux utilisateur.trice.s de se créer un compte nous allons devoir
créer la vue et le contrôleur pour l'inscription.

#### Créer la vue d'inscription

Nous allons commencer par créer la vue d'inscription. Pour cela, utilisez la
commande suivante pour créer un nouveau fichier de vue dans le dossier
`resources/views/auth` :

```bash
php artisan make:view auth.register
```

Le résultat devrait ressembler à ceci :

```bash
   INFO  View [resources/views/auth/register.blade.php] created successfully.
```

Vous pouvez maintenant remplir le fichier
`resources/views/auth/register.blade.php` avec le code nécessaire pour afficher
un formulaire d'inscription :

```php
<x-default-layout>
    <x-slot:title>
        {{ __('ui.auth.register.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.auth.register.description', ['app_name' => config('app.name')]) }}
    </x-slot>

    <article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6 max-w-md mx-auto">
        <header class="mb-6">
            <h1 class="text-3xl font-bold dark:text-white mb-2">
                {{ __('ui.auth.register.title') }}
            </h1>

            <p class="mt-4 dark:text-gray-300">
                {{ __('ui.auth.register.description', ['app_name' => config('app.name')]) }}
            </p>
        </header>

        <form method="POST" action="{{ url('/auth/register') }}">
            @csrf

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.auth.register.form.fields.username.label') }}
                </label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                    placeholder="{{ __('ui.auth.register.form.fields.username.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('username') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('username')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.auth.register.form.fields.email.label') }}
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    placeholder="{{ __('ui.auth.register.form.fields.email.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('email') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.auth.register.form.fields.first_name.label') }}
                </label>
                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required
                    placeholder="{{ __('ui.auth.register.form.fields.first_name.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('first_name') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('first_name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.auth.register.form.fields.last_name.label') }}
                </label>
                <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required
                    placeholder="{{ __('ui.auth.register.form.fields.last_name.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('last_name') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('last_name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.auth.register.form.fields.password.label') }}
                </label>
                <input id="password" type="password" name="password" required
                    placeholder="{{ __('ui.auth.register.form.fields.password.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('password') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.auth.register.form.fields.password_confirmation.label') }}
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    placeholder="{{ __('ui.auth.register.form.fields.password_confirmation.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500">
            </div>

            <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-col gap-4">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 cursor-pointer">
                        {{ __('ui.auth.register.form.actions.submit') }}
                    </button>

                    <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                        {{ __('ui.auth.register.already_have_account') }}
                        <a href="{{ url('/auth/login') }}" class="text-teal-600 dark:text-purple-400 hover:underline">
                            {{ __('ui.auth.register.login') }}
                        </a>
                    </p>
                </div>
            </footer>
        </form>
    </article>
</x-default-layout>
```

Cette vue affiche un formulaire d'inscription avec les champs suivants :

- `username` : le nom d'utilisateur de l'utilisateur.trice.
- `email` : l'adresse e-mail de l'utilisateur.trice.
- `first_name` : le prénom de l'utilisateur.trice.
- `last_name` : le nom de famille de l'utilisateur.trice.
- `password` : le mot de passe de l'utilisateur.trice.
- `password_confirmation` : la confirmation du mot de passe de
  l'utilisateur.trice.

Les champs respectent les mêmes règles de validation que celles que nous avons
mises en place précédemment pour les posts et les profils. Les erreurs de
validation sont affichées sous les champs correspondants.

Un lien vers la page de connexion est également inclus pour les
utilisateur.trice.s qui ont déjà un compte.

Mettons à jour les traductions pour les champs du formulaire d'inscription dans
le fichier `lang/fr/ui.php` :

```php
<?php

declare(strict_types=1);

return [
    // ... autres traductions ...
    'auth' => [
        'register' => [
            'title' => 'Inscription',
            'description' => 'Créez votre compte sur :app_name pour commencer à partager vos idées.',
            'form' => [
                'fields' => [
                    'username' => [
                        'label' => "Nom d'utilisateur",
                        'placeholder' => "Choisissez votre nom d'utilisateur",
                    ],
                    'email' => [
                        'label' => 'Adresse e-mail',
                        'placeholder' => 'Entrez votre adresse e-mail',
                    ],
                    'first_name' => [
                        'label' => 'Prénom',
                        'placeholder' => 'Entrez votre prénom',
                    ],
                    'last_name' => [
                        'label' => 'Nom',
                        'placeholder' => 'Entrez votre nom',
                    ],
                    'password' => [
                        'label' => 'Mot de passe',
                        'placeholder' => 'Choisissez un mot de passe sécurisé',
                    ],
                    'password_confirmation' => [
                        'label' => 'Confirmation du mot de passe',
                        'placeholder' => 'Confirmez votre mot de passe',
                    ],
                ],
                'actions' => [
                    'submit' => "S'inscrire",
                ],
            ],
            'already_have_account' => 'Vous avez déjà un compte ?',
            'login' => 'Se connecter',
        ],
    ],
    // ... autres traductions ...
];
```

Le formulaire d'inscription est maintenant prêt. Nous allons pouvoir passer à la
création du contrôleur pour gérer l'inscription.

#### Créer le contrôleur d'authentification

Maintenant que nous avons créé la vue d'inscription, nous allons devoir créer le
contrôleur pour gérer l'inscription. Utilisez la commande suivante pour créer un
nouveau contrôleur dans le dossier `app/Http/Controllers` :

```bash
php artisan make:controller AuthController
```

Le résultat devrait ressembler à ceci :

```bash
   INFO  Controller [app/Http/Controllers/AuthController.php] created successfully.
```

Ce contrôleur va contenir les méthodes nécessaires pour gérer
l'authentification, notamment l'inscription, la connexion et la déconnexion.
Nous allons commencer par implémenter la méthode d'inscription.

Mettez à jour le contrôleur `AuthController` avec les méthodes nécessaires pour
afficher le formulaire d'inscription et gérer la soumission du formulaire :

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'alpha_dash:ascii', 'min:2', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Password::min(12)],
        ]);

        $user = new User();
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        Auth::login($user);

        return redirect('/');
    }
}
```

Le contrôleur `AuthController` contient deux méthodes :

1. `showRegister` : cette méthode affiche la vue d'inscription lorsque
   l'utilisateur.trice accède à la page d'inscription.
2. `register` : cette méthode gère la soumission du formulaire d'inscription.
   Elle valide les données soumises, crée un nouvel utilisateur.trice avec les
   données validées, hache le mot de passe, et enregistre l'utilisateur.trice
   dans la base de données. Elle connecte ensuite l'utilisateur.trice et
   redirige vers la page d'accueil.

Notons les règles de validation utilisées pour les champs du formulaire
d'inscription :

- `alpha_dash:ascii` : cette règle permet uniquement les caractères
  alphanumériques, les tirets et les underscores dans le champ `username`, et
  limite les caractères à l'ASCII pour éviter les problèmes d'encodage.
- `unique:users` : cette règle assure que les valeurs du champ `username` et
  `email` sont uniques dans la table `users`, empêchant ainsi la création de
  comptes avec des noms d'utilisateur ou des adresses e-mail déjà utilisés.
- `confirmed` : cette règle vérifie que le champ `password` a un champ de
  confirmation correspondant (dans ce cas, `password_confirmation`) et que les
  deux champs ont la même valeur, assurant ainsi que l'utilisateur.trice a
  correctement confirmé son mot de passe.
- `Password::min(12)` : cette règle impose que le mot de passe doit comporter au
  moins 12 caractères, encourageant ainsi les utilisateur.trice.s à choisir des
  mots de passe plus sécurisés (idéalement, tout le monde devrait utiliser des
  gestionnaires de mots de passe pour générer et stocker des mots de passe
  forts, mais cette règle est un bon point de départ pour encourager de
  meilleures pratiques de sécurité).

Le mot de passe est ensuite haché à l'aide de la classe `Hash` de Laravel avant
d'être stocké dans la base de données, garantissant ainsi la sécurité des
informations d'authentification des utilisateur.trice.s.

Ue fois l'inscription réussie, l'utilisateur.trice est redirigé.e vers la page
de connexion pour se connecter avec les informations qu'il.elle vient de
fournir.

Vous pourriez afficher un message de succès à l'utilisateur.trice après
l'inscription en utilisant la session pour stocker un message flash. Si c'est
votre souhait, vous pouvez jeter un œil à la section
[Aller plus loin](#aller-plus-loin) pour voir comment faire cela.

La classe `Auth` de Laravel est utilisée pour connecter automatiquement
l'utilisateur.trice après l'inscription, ce qui lui évite d'avoir à se connecter
manuellement après avoir créé son compte.

#### Lier le contrôleur aux routes

Maintenant que nous avons créé le contrôleur d'inscription, nous allons devoir
le lier aux routes pour que les utilisateur.trice.s puissent accéder au
formulaire d'inscription et soumettre leurs informations.

Ouvrez le fichier `routes/web.php` et ajoutez les routes suivantes pour
l'inscription :

```php
Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/register', 'showRegister');
    Route::post('/auth/register', 'register');
});
```

Ici, nous groupons les routes liées à l'authentification sous un même contrôleur
`AuthController` pour une meilleure organisation/lisibilité.

La première route affiche le formulaire d'inscription lorsque
l'utilisateur.trice accède à `/auth/register` avec une requête GET, tandis que
la seconde route gère la soumission du formulaire d'inscription lorsque
l'utilisateur.trice envoie une requête POST à la même URL.

#### Tester l'inscription

Vous pouvez maintenant tester le processus d'inscription en accédant à
<http://localhost:8000/auth/register> dans votre navigateur. Remplissez le
formulaire d'inscription avec des données valides et soumettez-le. Si tout
fonctionne correctement, vous devriez être redirigé.e vers la page de connexion
et un.e nouvel.le utilisateur.trice devrait être créé.e dans la base de données
avec les informations que vous avez fournies.

Testez également les différentes règles de validation en soumettant des données
invalides (par exemple, un nom d'utilisateur.trice déjà utilisé, une adresse
e-mail invalide, un mot de passe trop court, etc.) pour vous assurer que les
erreurs de validation sont correctement affichées.

### Gérer la connexion

Maintenant que nous avons mis en place le processus d'inscription, nous allons
mettre en place le processus de connexion pour permettre aux utilisateur.trice.s
de se connecter à leur compte.

#### Créer la vue de connexion

Nous allons commencer par créer la vue de connexion. Pour cela, utilisez la
commande suivante pour créer un nouveau fichier de vue dans le dossier
`resources/views/auth` :

```bash
php artisan make:view auth.login
```

Le résultat devrait ressembler à ceci :

```bash
   INFO  View [resources/views/auth/login.blade.php] created successfully.
```

Vous pouvez maintenant remplir le fichier `resources/views/auth/login.blade.php`
avec le code nécessaire pour afficher un formulaire de connexion. Voici un
exemple de code que vous pouvez utiliser comme point de départ :

```php
<x-default-layout>
    <x-slot:title>
        {{ __('ui.auth.login.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.auth.login.description', ['app_name' => config('app.name')]) }}
    </x-slot>

    <article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6 max-w-md mx-auto">
        <header class="mb-6">
            <h1 class="text-3xl font-bold dark:text-white mb-2">
                {{ __('ui.auth.login.title') }}
            </h1>

            <p class="mt-4 dark:text-gray-300">
                {{ __('ui.auth.login.description', ['app_name' => config('app.name')]) }}
            </p>
        </header>

        @if (session('success'))
            <div
                class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/auth/login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.auth.login.form.fields.email.label') }}
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="{{ __('ui.auth.login.form.fields.email.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('email') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('ui.auth.login.form.fields.password.label') }}
                </label>
                <input id="password" type="password" name="password" required
                    placeholder="{{ __('ui.auth.login.form.fields.password.placeholder') }}"
                    class="w-full px-3 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:border-transparent @error('password') border-red-500 focus:ring-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-teal-500 dark:focus:ring-purple-500 @enderror">
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                        class="rounded border-gray-300 dark:border-gray-600 text-teal-600 dark:text-purple-500 focus:ring-teal-500 dark:focus:ring-purple-500">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                        {{ __('ui.auth.login.form.fields.remember.label') }}
                    </span>
                </label>
            </div>

            <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-col gap-4">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 cursor-pointer">
                        {{ __('ui.auth.login.form.actions.submit') }}
                    </button>

                    <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                        {{ __('ui.auth.login.no_account') }}
                        <a href="{{ url('/auth/register') }}"
                            class="text-teal-600 dark:text-purple-400 hover:underline">
                            {{ __('ui.auth.login.register') }}
                        </a>
                    </p>
                </div>
            </footer>
        </form>
    </article>
</x-default-layout>
```

Cette vue affiche un formulaire de connexion avec les champs suivants :

- `email` : l'adresse e-mail de l'utilisateur.trice.
- `password` : le mot de passe de l'utilisateur.trice.
- `remember` : une case à cocher pour la fonctionnalité "se souvenir de moi".
- Un bouton de soumission pour se connecter.

Un lien vers la page d'inscription est également inclus pour les
utilisateur.trice.s qui n'ont pas encore de compte.

Mettons à jour les traductions pour les champs du formulaire d'inscription dans
le fichier `lang/fr/ui.php` :

```php
<?php

declare(strict_types=1);

return [
    // ... autres traductions ...
    'auth' => [
        'login' => [
            'title' => 'Connexion',
            'description' => 'Connectez-vous à votre compte :app_name.',
            'form' => [
                'fields' => [
                    'email' => [
                        'label' => 'Adresse e-mail',
                        'placeholder' => 'Entrez votre adresse e-mail',
                    ],
                    'password' => [
                        'label' => 'Mot de passe',
                        'placeholder' => 'Entrez votre mot de passe',
                    ],
                    'remember' => [
                        'label' => 'Se souvenir de moi',
                    ],
                ],
                'actions' => [
                    'submit' => 'Se connecter',
                ],
            ],
            'no_account' => 'Pas encore de compte ?',
            'register' => "S'inscrire",
        ],
        // ... autres traductions ...
    ],
    // ... autres traductions ...
];
```

Le formulaire de connexion est maintenant prêt. Nous allons pouvoir passer à la
création du contrôleur pour gérer la connexion.

#### Mettre à jour le contrôleur d'authentification

Maintenant que nous avons créé la vue de connexion, nous allons devoir mettre à
jour le contrôleur pour gérer la connexion.

Nous allons utiliser le même contrôleur `AuthController` que nous avons créé
pour l'inscription, mais nous allons ajouter de nouvelles méthodes pour gérer la
connexion.

Ouvrez le fichier `app/Http/Controllers/AuthController.php` et ajoutez les
méthodes suivantes pour afficher le formulaire de connexion et gérer la
soumission du formulaire :

```php
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->onlyInput('email');
    }
```

La méthode `showLogin` affiche la vue de connexion lorsque l'utilisateur.trice
accède à la page de connexion, tandis que la méthode `login` gère la soumission
du formulaire de connexion. Elle valide les données soumises, tente de connecter
l'utilisateur.trice avec les informations d'identification fournies.

Si la connexion est réussie, elle régénère la session pour des raisons de
sécurité et redirige l'utilisateur.trice vers la page d'accueil ou vers la page
qu'il.elle essayait d'accéder avant d'être redirigé.e vers la page de connexion.

En effet, si la personne a essayé d'accéder à une page protégée avant de se
connecter, Laravel stocke l'URL de cette page dans la session. La méthode
`redirect()->intended()` redirige l'utilisateur.trice vers cette URL après une
connexion réussie, ou vers la page d'accueil si aucune URL n'est stockée.

Si une erreur se produit lors de la tentative de connexion (par exemple, si les
informations d'identification sont incorrectes), la méthode redirige
l'utilisateur.trice vers la page de connexion avec un message d'erreur.

La méthode `withErrors` est utilisée pour ajouter des messages d'erreur à la
session, qui peuvent ensuite être affichés dans la vue de connexion. Dans ce
cas, nous ajoutons un message d'erreur générique pour le champ `email` si la
tentative de connexion échoue.

Pour cela, nous utilisons la traduction `auth.failed` qui est une clé de
traduction standard dans Laravel pour les erreurs d'authentification. Vous
pouvez personnaliser ce message dans le fichier de traduction `lang/fr/auth.php`
si vous le souhaitez.

#### Lier le contrôleur aux routes

Maintenant que nous avons ajouté les méthodes pour gérer la connexion dans le
contrôleur `AuthController`, nous allons devoir les lier aux routes pour que les
utilisateur.trice.s puissent accéder au formulaire de connexion et soumettre
leurs informations.

Ouvrez le fichier `routes/web.php` et ajoutez les routes suivantes pour la
connexion :

```php
Route::controller(AuthController::class)->group(function () {
    // ... autres routes ...
    Route::get('/auth/login', 'showLogin')
    Route::post('/auth/login', 'login');
});
```

La première route affiche le formulaire de connexion lorsque l'utilisateur.trice
accède à `/auth/login` avec une requête GET, tandis que la seconde route gère la
soumission du formulaire de connexion lorsque l'utilisateur.trice envoie une
requête POST à la même URL.

#### Tester la connexion

Vous pouvez maintenant tester le processus de connexion en accédant à
<http://localhost:8000/auth/login> dans votre navigateur.

Essayez de vous connecter avec les informations d'identification d'un
utilisateur.trice que vous avez créé.e précédemment. Si tout fonctionne
correctement, vous devriez être redirigé.e vers la page d'accueil et être
connecté.e à votre compte.

Testez également les différentes règles de validation en soumettant des données
invalides (par exemple, une adresse e-mail invalide, un mot de passe incorrect,
etc.) pour vous assurer que les erreurs de validation sont correctement
affichées.

### Gérer la déconnexion

Pour permettre aux utilisateur.trice.s de se déconnecter de leur compte, nous
allonsajouter une méthode de déconnexion dans le contrôleur `AuthController` et
la lier à une route.

#### Mettre à jour le contrôleur d'authentification

Ouvrez le fichier `app/Http/Controllers/AuthController.php` et ajoutez la
méthode suivante pour gérer la déconnexion :

```php
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
```

Cette méthode utilise la classe `Auth` de Laravel pour déconnecter
l'utilisateur.trice, invalide la session pour des raisons de sécurité, régénère
le token CSRF, et redirige l'utilisateur.trice vers la page d'accueil.

#### Lier le contrôleur aux routes

Ouvrez le fichier `routes/web.php` et ajoutez la route suivante pour la
déconnexion :

```php
Route::controller(AuthController::class)->group(function () {
    // ... autres routes ...
    Route::post('/auth/logout', 'logout');
});
```

Cette route gère la soumission du formulaire de déconnexion lorsque
l'utilisateur.trice envoie une requête POST à `/auth/logout`.

#### Ajouter un bouton de déconnexion dans le profil utilisateur.trice

Maintenant que nous avons mis en place la route pour la déconnexion, nous allons
pouvoir ajouter un bouton de déconnexion dans le profil de l'utilisateur.trice
pour lui permettre de se déconnecter facilement.

Ouvrez le fichier `resources/views/profile/show.blade.php` et ajoutez le code
suivant pour afficher un bouton de déconnexion :

```diff
diff --git a/resources/views/my-profile/show.blade.php b/resources/views/my-profile/show.blade.php
index 9061d11..265b889 100644
--- a/resources/views/my-profile/show.blade.php
+++ b/resources/views/my-profile/show.blade.php
@@ -45,6 +45,13 @@ class="px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-t
                 class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                 {{ __('ui.my_profile.show.actions.view_public') }}
             </a>
+            <form method="POST" action="{{ url('/auth/logout') }}" class="inline">
+                @csrf
+                <button type="submit"
+                    class="px-4 py-2 bg-red-600 dark:bg-red-800 text-white rounded-md hover:bg-red-700 dark:hover:bg-red-900 cursor-pointer">
+                    {{ __('ui.my_profile.show.actions.logout') }}
+                </button>
+            </form>
         </div>
     </article>
 </x-default-layout>
```

Ce code ajoute un formulaire de déconnexion avec un bouton rouge dans le profil
de l'utilisateur.trice. Lorsque la personne clique sur ce bouton, elle envoie
une requête POST à la route de déconnexion que nous avons créée précédemment, ce
qui la déconnecte de son compte et la redirige vers la page d'accueil.

### Mettre à jour la barre de navigation principale

Maintenant que nous avons mis en place les fonctionnalités d'inscription, de
connexion et de déconnexion, nous allons mettre à jour la barre de navigation
principale de l'application pour afficher les liens appropriés en fonction de
l'état de connexion de l'utilisateur.trice :

```diff
diff --git a/resources/views/components/default-layout.blade.php b/resources/views/components/default-layout.blade.php
index 5fba57e..b2339d9 100644
--- a/resources/views/components/default-layout.blade.php
+++ b/resources/views/components/default-layout.blade.php
@@ -31,9 +31,31 @@ class="block bg-teal-700 dark:bg-purple-900 px-3 py-1 rounded-md hover:bg-teal-8
                         {{ __('ui.posts.index.title') }}
                     </a>
                 </div>
-                <a href="{{ url('/my-profile') }}" class="block hover:opacity-80 transition">
-                    <img src="/icons/profile.svg" alt="{{ __('ui.profile.title') }}" class="h-8 w-8 rounded-full" />
-                </a>
+
+                @auth
+                    <a href="{{ url('/my-profile') }}" class="block hover:opacity-80 transition">
+                        <div
+                            class="h-8 w-8 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
+                            @if (Auth::user()->profile_picture)
+                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
+                                    alt="{{ Auth::user()->username }}" class="w-full h-full object-cover">
+                            @else
+                                <img src="/icons/profile.svg" alt="{{ Auth::user()->username }}" class="h-8 w-8">
+                            @endif
+                        </div>
+                    </a>
+                @else
+                    <div class="flex items-center gap-2">
+                        <a href="{{ url('/auth/login') }}"
+                            class="block px-3 py-1 rounded-md hover:bg-teal-700 dark:hover:bg-slate-700 transition">
+                            {{ __('ui.auth.login.title') }}
+                        </a>
+                        <a href="{{ url('/auth/register') }}"
+                            class="block bg-teal-700 dark:bg-purple-900 px-3 py-1 rounded-md hover:bg-teal-800 dark:hover:bg-purple-800 transition">
+                            {{ __('ui.auth.register.title') }}
+                        </a>
+                    </div>
+                @endauth
             </div>
         </nav>
     </header>
```

Dans ce code, nous utilisons la directive Blade `@auth` pour vérifier si
l'utilisateur.trice est connecté.e.

Si c'est le cas, nous affichons un lien vers son profil avec sa photo de profil
(ou une icône par défaut si aucune photo n'est définie). Grâce à la classe
`Auth::user()`, nous pouvons accéder aux informations de l'utilisateur.trice
connecté.e, comme son nom d'utilisateur et sa photo de profil.

Si l'utilisateur.trice n'est pas connecté.e, nous affichons des liens vers les
pages de connexion et d'inscription.

## Utiliser la personne authentifiée dans le reste de l'application

Les personnes ont maintenant la possibilité de s'inscrire, de se connecter et de
se déconnecter de leur compte.

Nous allons maintenant utiliser les informations de la personne authentifiée
pour associer les posts et les likes à cette personne au lieu de les associer à
des utilisateurs.trice.s écrit.es en dur dans le code.

### Associer la personne authentifiée aux posts

Pour associer les posts à la personne authentifiée, nous allons devoir mettre à
jour le contrôleur `PostController` pour utiliser les informations de
l'utilisateur.trice connecté.e lors de la création d'un post.

Pour cela, ouvrez le fichier `app/Http/Controllers/PostController.php` et
mettez-le à jour comme suit :

```diff
diff --git a/app/Http/Controllers/PostController.php b/app/Http/Controllers/PostController.php
index 64b9796..385263a 100644
--- a/app/Http/Controllers/PostController.php
+++ b/app/Http/Controllers/PostController.php
@@ -1,12 +1,12 @@
 <?php

 namespace App\Http\Controllers;

 use App\Models\Post;
-use App\Models\User;
 use Illuminate\Http\Request;
+use Illuminate\Support\Facades\Auth;

 class PostController extends Controller
 {
     /**
      * Display a listing of the resource.
@@ -34,11 +34,11 @@ public function store(Request $request)
         $validated = $request->validate([
             'title' => 'nullable|string|max:255',
             'content' => 'required|string|max:5000',
         ]);

-        $user = User::where('username', 'janedoe')->first();
+        $user = $request->user();
         $post = new Post();

         $post->title = $validated['title'];
         $post->content = $validated['content'];
         $post->user()->associate($user);
@@ -53,18 +53,21 @@ public function store(Request $request)
      */
     public function show(string $id)
     {
         $post = Post::with('user')->with('likes')->findOrFail($id);

-        // Get current user's reaction if exists
-        $user = User::find(2);
-        $reaction = $post->likes()->where('user_id', $user->id)->first();
+        $user = Auth::user();
+        $reaction = null;

-        // Vérifie si la personne a déjà liké ce post
-        if ($reaction) {
-            // Récupère la réaction au post
-            $reaction = $reaction->pivot->reaction;
+        if ($user) {
+            $reaction = $post->likes()->where('user_id', $user->id)->first();
+
+            // Vérifie si la personne a déjà liké ce post
+            if ($reaction) {
+                // Récupère la réaction au post
+                $reaction = $reaction->pivot->reaction;
+            }
         }

         return view('posts.show', ['post' => $post, 'reaction' => $reaction]);
     }
```

Dans ce code, nous avons remplacé l'utilisateur.trice écrit.e en dur par
l'utilisateur.trice actuellement connecté.e en utilisant la méthode `user()` de
la requête, qui retourne l'utilisateur.trice authentifié.e. Une autre manière de
récupérer l'utilisateur.trice connecté.e est d'utiliser la classe `Auth` de
Laravel avec la méthode `user()`.

Nous avons également mis à jour la méthode `show` pour récupérer la réaction de
l'utilisateur.trice connecté.e au post, si elle existe.

De cette manière, les posts créés seront automatiquement associés à la personne
authentifiée, et nous pourrons également afficher la réaction de cette personne
aux posts si elle a déjà liké un post spécifique.

### Associer la personne authentifiée aux likes

Mettons à jour le contrôleur `LikeController` pour associer les likes à la
personne authentifiée.

Ouvrez le fichier `app/Http/Controllers/LikeController.php` et mettez-le à jour
comme suit :

```diff
diff --git a/app/Http/Controllers/LikeController.php b/app/Http/Controllers/LikeController.php
index 39a0633..1817145 100644
--- a/app/Http/Controllers/LikeController.php
+++ b/app/Http/Controllers/LikeController.php
@@ -1,11 +1,10 @@
 <?php

 namespace App\Http\Controllers;

 use App\Models\Post;
-use App\Models\User;
 use Illuminate\Http\Request;

 class LikeController extends Controller
 {
     public function update(Request $request, string $id)
@@ -13,11 +12,11 @@ public function update(Request $request, string $id)
         $validated = $request->validate([
             'reaction' => ['required', 'in:like,love,haha,wow,sad,angry'],
         ]);

         $post = Post::findOrFail($id);
-        $user = User::where('id', 2)->first();
+        $user = $request->user();
         $reaction = $validated['reaction'];

         // Vérifie si la personne avait déjà liké ce post
         $existingLike = $post->likes()->where('user_id', $user->id)->first();
```

Dans ce code, nous avons remplacé l'utilisateur.trice écrit.e en dur par
l'utilisateur.trice actuellement connecté.e en utilisant la méthode `user()` de
la requête.

De cette manière, les likes seront automatiquement associés à la personne
authentifiée, et nous pourrons gérer les réactions de chaque utilisateur.trice
de manière individuelle.

### Associer la personne authentifiée à son propre profil

Mettons à jour le contrôleur `MyProfileController` pour associer le profil à la
personne authentifiée.

Ouvrez le fichier `app/Http/Controllers/MyProfileController.php` et mettez-le à
jour comme suit :

```diff
diff --git a/app/Http/Controllers/MyProfileController.php b/app/Http/Controllers/MyProfileController.php
index cc1c19b..570a4cc 100644
--- a/app/Http/Controllers/MyProfileController.php
+++ b/app/Http/Controllers/MyProfileController.php
@@ -2,8 +2,8 @@

 namespace App\Http\Controllers;

-use App\Models\User;
 use Illuminate\Http\Request;
+use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Validation\Rule;

@@ -30,7 +30,7 @@ public function store(Request $request): never
      */
     public function show()
     {
-        $user = User::where('id', 2)->first();
+        $user = Auth::user();

         return view('my-profile.show', ['user' => $user]);
     }
@@ -40,7 +40,7 @@ public function show()
      */
     public function edit()
     {
-        $user = User::where('id', 2)->first();
+        $user = Auth::user();

         return view('my-profile.edit', ['user' => $user]);
     }
@@ -50,7 +50,7 @@ public function edit()
      */
     public function update(Request $request)
     {
-        $user = User::where('id', 2)->first();
+        $user = $request->user();

         $validated = $request->validate([
             'username' => ['required', 'string', 'alpha_dash:ascii', 'min:2', 'max:255', Rule::unique('users')->ignore($user->id)],
@@ -97,7 +97,7 @@ public function update(Request $request)
      */
     public function destroy()
     {
-        $user = User::where('id', 2)->first();
+        $user = Auth::user();

         if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
             Storage::disk('public')->delete($user->profile_picture);
```

De cette manière, le profil affiché et modifié sera automatiquement associé à la
personne authentifiée, et chaque utilisateur.trice pourra accéder à son propre
profil et le modifier sans affecter les profils des autres utilisateur.trice.s.

## N'autoriser que l'auteur.trice à modifier ses propres posts

Dans l'état actuel de l'application, n'importe quel utilisateur.trice peut
modifier les posts de n'importe quel autre utilisateur.trice, ce qui n'est pas
idéal du point de vue de la sécurité et de la confidentialité.

Nous allons mettre en place une vérification pour n'autoriser que l'auteur.trice
d'un post à le modifier.

### Créer une politique d'autorisation

Laravel fournit un système de politiques d'autorisation qui permet de définir
des règles d'accès pour les différentes actions sur les modèles (source :
<https://laravel.com/docs/12.x/authorization#creating-policies>). Nous allons
créer une politique d'autorisation pour le modèle `Post` afin de définir les
règles d'accès pour la modification des posts.

Pour cela, utilisez la commande suivante pour créer une nouvelle politique
d'autorisation pour le modèle `Post` :

```bash
php artisan make:policy PostPolicy --model=Post
```

Le résultat devrait ressembler à ceci :

```bash
   INFO  Policy [app/Policies/PostPolicy.php] created successfully.
```

En utilisant l'option `--model=Post`, Laravel génère automatiquement une
politique avec des méthodes pré-remplies pour les actions courantes (view,
create, update, delete, etc.) sur le modèle `Post`.

Ouvrez le fichier `app/Policies/PostPolicy.php` et prenez quelques minutes pour
examiner le code généré puis répondez aux questions suivantes :

- Quelles sont les méthodes générées par Laravel dans cette politique
  d'autorisation ?
- Que contient chaque méthode par défaut ? Pourquoi ?

### Mettre à jour la politique d'autorisation

Mettons à jour la politique `PostPolicy` pour n'autoriser que l'auteur.trice
d'un post à le gérer :

> [!NOTE]
>
> Certaines de ces actions (notamment `restore` et `forceDelete`) n'ont pas été
> étudiées dans ce cours, mais elles sont générées par défaut par Laravel pour
> couvrir tous les cas d'utilisation possibles offerts par le framework et nous
> les mettons à jour pour que la politique soit complète.

```php
diff --git a/app/Policies/PostPolicy.php b/app/Policies/PostPolicy.php
index 61e8275..7186fee 100644
--- a/app/Policies/PostPolicy.php
+++ b/app/Policies/PostPolicy.php
@@ -4,24 +4,23 @@

 use App\Models\Post;
 use App\Models\User;
-use Illuminate\Auth\Access\Response;

 class PostPolicy
 {
     /**
      * Determine whether the user can view any models.
      */
-    public function viewAny(User $user): bool
+    public function viewAny(?User $user): bool
     {
-        return false;
+        return true;
     }

     /**
      * Determine whether the user can view the model.
      */
-    public function view(User $user, Post $post): bool
+    public function view(?User $user, Post $post): bool
     {
-        return false;
+        return true;
     }

     /**
@@ -29,7 +28,7 @@ public function view(User $user, Post $post): bool
      */
     public function create(User $user): bool
     {
-        return false;
+        return true;
     }

     /**
@@ -37,7 +36,7 @@ public function create(User $user): bool
      */
     public function update(User $user, Post $post): bool
     {
-        return false;
+        return $user->id === $post->user_id;
     }

     /**
@@ -45,7 +44,7 @@ public function update(User $user, Post $post): bool
      */
     public function delete(User $user, Post $post): bool
     {
-        return false;
+        return $user->id === $post->user_id;
     }

     /**
@@ -53,7 +52,7 @@ public function delete(User $user, Post $post): bool
      */
     public function restore(User $user, Post $post): bool
     {
-        return false;
+        return $user->id === $post->user_id;
     }

     /**
@@ -61,6 +60,6 @@ public function restore(User $user, Post $post): bool
      */
     public function forceDelete(User $user, Post $post): bool
     {
-        return false;
+        return $user->id === $post->user_id;
     }
 }
```

Dans ce code, nous avons mis à jour les méthodes `update`, `delete`, `restore`
et `forceDelete` pour n'autoriser que l'auteur.trice d'un post à effectuer ces
actions.

Nous vérifions si l'identifiant de l'utilisateur.trice connecté.e correspond à
l'identifiant de l'auteur.trice du post (stocké dans la colonne `user_id` de la
table `posts`).

Si les identifiants correspondent, cela signifie que l'utilisateur.trice est
l'auteur.trice du post et est autorisé.e à le modifier, sinon il.elle n'est pas
autorisé.e.

Ces différentes méthodes seront utilisées par Laravel pour vérifier les
autorisations avant d'exécuter les actions correspondantes sur les posts.

### Utiliser la politique d'autorisation dans le contrôleur

Maintenant que nous avons créé la politique d'autorisation pour le modèle
`Post`, nous allons devoir l'utiliser dans le contrôleur `PostController` pour
appliquer les règles d'accès que nous avons définies.

Ouvrez le fichier `app/Http/Controllers/PostController.php` et mettez-le à jour
comme suit :

```diff
diff --git a/app/Http/Controllers/PostController.php b/app/Http/Controllers/PostController.php
index 385263a..5d17805 100644
--- a/app/Http/Controllers/PostController.php
+++ b/app/Http/Controllers/PostController.php
@@ -5,6 +5,7 @@
 use App\Models\Post;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
+use Illuminate\Support\Facades\Gate;

 class PostController extends Controller
 {
@@ -78,6 +79,8 @@ public function edit(string $id)
     {
         $post = Post::findOrFail($id);

+        Gate::authorize('update', $post);
+
         return view('posts.edit', ['post' => $post]);
     }

@@ -93,6 +96,8 @@ public function update(Request $request, string $id)

         $post = Post::findOrFail($id);

+        Gate::authorize('update', $post);
+
         $post->title = $validated['title'];
         $post->content = $validated['content'];

@@ -106,7 +111,11 @@ public function update(Request $request, string $id)
      */
     public function destroy(string $id)
     {
-        Post::destroy($id);
+        $post = Post::findOrFail($id);
+
+        Gate::authorize('delete', $post);
+
+        $post->delete();

         return redirect("/posts");
     }
```

Dans ce code, nous avons utilisé la classe `Gate` de Laravel pour vérifier les
autorisations avant d'exécuter les actions de modification et de suppression des
posts (source :
<https://laravel.com/docs/12.x/authorization#via-the-gate-facade>).

En effet, la méthode `authorize` de la classe `Gate` vérifie si
l'utilisateur.trice connecté.e est autorisé.e à effectuer l'action spécifiée
(par exemple, `update` ou `delete`) sur le modèle donné (dans ce cas, le post).

Si l'utilisateur.trice n'est pas autorisé.e, Laravel génère automatiquement une
exception `AuthorizationException` qui est gérée par défaut pour afficher une
page d'erreur 403 (Forbidden).

### Tester les autorisations

Vous pouvez maintenant tester les autorisations que nous avons mises en place
pour la modification et la suppression des posts.

Essayez de modifier ou de supprimer un post que vous avez créé avec votre compte
pour vérifier que vous êtes autorisé.e à le faire.

Essayez ensuite de modifier ou de supprimer un post créé par un autre
utilisateur.trice pour vérifier que vous n'êtes pas autorisé.e à le faire et que
vous obtenez une erreur 403.

Les autorisations sont maintenant correctement mises en place pour que seul.e
l'auteur.trice d'un post puisse le modifier ou le supprimer.

## Restreindre l'accès aux routes pour les personnes non authentifiées

Maintenant que nous avons mis en place les fonctionnalités d'authentification et
les autorisations pour la modification des posts, nous allons restreindre
l'accès aux routes pour les personnes non authentifiées.

### Utiliser le middleware d'authentification

Pour cela, nous allons utiliser le middleware `auth` de Laravel qui vérifie si
une personne est connectée avant de lui permettre d'accéder à certaines routes
(source : <https://laravel.com/docs/12.x/middleware#authentication-middleware>).
Nous allons appliquer ce middleware aux routes qui nécessitent une
authentification pour s'assurer que seules les personnes connectées peuvent
accéder à ces routes.

Ouvrez le fichier `routes/web.php` et mettez-le à jour comme suit pour appliquer
le middleware `auth` aux routes qui nécessitent une authentification :

```diff
diff --git a/routes/web.php b/routes/web.php
index 27568b5..ee9e3cb 100644
--- a/routes/web.php
+++ b/routes/web.php
@@ -20,16 +20,17 @@

 Route::get('/@{username}', [ProfileController::class, 'show'])->where('username', '[A-Za-z0-9-_]+');

-Route::resource('posts', PostController::class);
+Route::resource('posts', PostController::class)->except(['index', 'show'])->middleware('auth');
+Route::resource('posts', PostController::class)->only(['index', 'show']);

-Route::singleton('my-profile', MyProfileController::class)->destroyable();
+Route::singleton('my-profile', MyProfileController::class)->destroyable()->middleware('auth');

-Route::match(['put', 'patch'], '/likes/{post}', [LikeController::class, 'update']);
+Route::match(['put', 'patch'], '/likes/{post}', [LikeController::class, 'update'])->middleware('auth');

 Route::controller(AuthController::class)->group(function () {
     Route::get('/auth/register', 'showRegister');
     Route::post('/auth/register', 'register');
-    Route::get('/auth/login', 'showLogin');
+    Route::get('/auth/login', 'showLogin')->name('login');
     Route::post('/auth/login', 'login');
-    Route::post('/auth/logout', 'logout');
+    Route::post('/auth/logout', 'logout')->middleware('auth');
 });
```

Ici, nous avons appliqué le middleware `auth` à toutes les routes qui
nécessitent une authentification.

Pour cela, nous avons utilisé la méthode `middleware('auth')` sur les routes
concernées. Cela garantit que seules les personnes connectées peuvent accéder à
ces routes.

Il est possible de sélectionner la ou les actions spécifiques d'une ressource à
protéger avec le middleware `auth` en utilisant les méthodes `only` ou `except`
lors de la définition des routes de ressources.

Par exemple, pour la ressource `posts`, nous avons appliqué le middleware `auth`
à toutes les actions sauf `index` et `show`, qui sont accessibles à tous les
utilisateur.trices, qu'ils soient connectés ou non. Les actions `create`,
`store`, `edit`, `update` et `destroy` sont, elles, protégées par le middleware
`auth` et nécessitent une authentification pour y accéder.

Nous avons également appliqué le middleware `auth` à la route de déconnexion
pour s'assurer que seules les personnes connectées peuvent se déconnecter.

Vous avez peut-être remarqué que nous avons également ajouté la méthode
`name('login')` à la route de connexion.

Jusqu'à présent dans le cours, lorsque nous souhaitons accéder à une autre page
après une action (par exemple, après une connexion réussie), nous avons utilisé
la fonction `redirect()` avec une URL spécifique (par exemple, `redirect('/')`
pour rediriger vers la page d'accueil) ou directement dans les vues avec la
fonction `url()` (par exemple, `url('/posts')` pour générer l'URL de la page des
posts).

Cependant, Laravel fournit également une fonction `route()` qui permet de
générer des URLs à partir des noms de routes définis dans le fichier
`routes/web.php` (source :
<https://laravel.com/docs/12.x/routing#named-routes>).

La plupart des contrôleurs mettent à disposition des routes nommées
automatiquement pour les actions courantes (index, show, create, store, edit,
update, destroy) lorsqu'on utilise les ressources, ce qui nous permet de les
utiliser avec la fonction `route()` pour générer des URLs de manière plus
flexible et maintenable (par exemple, `route('posts.index')` pour générer l'URL
de la page des posts).

Par défaut, le middleware `auth` redirige les personnes non authentifiées vers
la route nommée `login` lorsqu'elles essaient d'accéder à une route protégée. En
ajoutant `name('login')` à la route de connexion, nous nous assurons que le
middleware `auth` sait où rediriger les personnes non authentifiées.

Cela permet à Laravel de rediriger automatiquement les personnes non
authentifiées vers la page de connexion lorsqu'elles essaient d'accéder à une
route protégée par le middleware `auth`.

### Tester les restrictions d'accès

Vous pouvez maintenant tester les restrictions d'accès que nous avons mises en
place pour les personnes non authentifiées.

Assurez-vous d'être déconnecté.e de votre compte, puis essayez d'accéder à une
route protégée (par exemple, la page de création d'un post à l'URL
`/posts/create`). Vous devriez être redirigé.e vers la page de connexion et
connectez-vous avec un compte utilisateur.trice.

Une fois connecté.e, vous devriez être redirigé.e vers la page que vous essayiez
d'accéder initialement (par exemple, la page de création d'un post) et pouvoir y
accéder sans problème (grâce à la méthode `intended()` utilisée dans la méthode
de connexion du contrôleur d'authentification).

## Masquer les éléments de l'interface utilisateur pour les personnes non authentifiées ou non autorisées

Maintenant que nous avons mis en place les fonctionnalités d'authentification et
les autorisations pour la modification des posts, nous allons améliorer
l'expérience utilisateur en masquant les éléments de l'interface utilisateur qui
ne sont pas pertinents pour les personnes non authentifiées ou non autorisées.

Nous l'avons déjà fait pour la barre de navigation principale en affichant des
liens différents en fonction de l'état de connexion de l'utilisateur.trice, mais
nous allons maintenant appliquer ce principe à d'autres parties de l'application
pour rendre l'interface plus intuitive et éviter de montrer des actions que les
utilisateur.trice.s ne peuvent pas effectuer.

Par exemple, nous pouvons masquer les boutons de modification et de suppression
des posts pour les personnes qui ne sont pas l'auteur.trice du post, ou masquer
le lien vers le profil de l'utilisateur.trice pour les personnes qui ne sont pas
connectées.

### Masquer les fonctionnalités de modification et de suppression des posts

Blade permet de vérifier les autorisations directement dans les vues en
utilisant la directive `@can` (source :
<https://laravel.com/docs/12.x/authorization#via-blade-templates>). Nous allons
utiliser cette directive pour masquer le lien de modification des posts pour les
personnes qui ne sont pas l'auteur.trice du post.

De plus, nous allons également masquer le formulaire de suppression des posts
pour les personnes qui ne sont pas l'auteur.trice du post grâce à la directive
`@auth` qui vérifie si une personne est connectée (source :
<https://laravel.com/docs/12.x/blade#authentication-directives>).

Ouvrez le fichier `resources/views/posts/show.blade.php` et mettez-le à jour
comme suit :

```diff
diff --git a/resources/views/posts/show.blade.php b/resources/views/posts/show.blade.php
index 0911b47..474045d 100644
--- a/resources/views/posts/show.blade.php
+++ b/resources/views/posts/show.blade.php
@@ -48,10 +48,12 @@
                 <span title="{{ $post->created_at->isoFormat('LLLL') }}">
                     {{ $post->created_at->diffForHumans() }}
                 </span>
-                ·
-                <a href="{{ url('/posts/' . $post->id . '/edit') }}">
-                    {{ __('ui.posts.edit.title_without_post_title') }}
-                </a>
+                @can('update', $post)
+                    ·
+                    <a href="{{ url('/posts/' . $post->id . '/edit') }}">
+                        {{ __('ui.posts.edit.title_without_post_title') }}
+                    </a>
+                @endcan
                 ·
                 <span class="font-semibold">
                     {{ trans_choice('ui.posts.likes_count', count($post->likes)) }}
@@ -66,36 +68,38 @@
         </div>

         <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
-            <form method="POST" action="{{ url('/likes/' . $post->id) }}" class="mb-4">
-                @csrf
-                @method('PUT')
-                <div class="flex flex-wrap justify-between gap-2">
-                    <button type="submit" name="reaction" value="like"
-                        class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'like' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
-                        👍
-                    </button>
-                    <button type="submit" name="reaction" value="love"
-                        class="w-12 h-12 rounded-full cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 {{ $reaction === 'love' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
-                        ❤️
-                    </button>
-                    <button type="submit" name="reaction" value="haha"
-                        class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'haha' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
-                        😂
-                    </button>
-                    <button type="submit" name="reaction" value="wow"
-                        class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'wow' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
-                        😮
-                    </button>
-                    <button type="submit" name="reaction" value="sad"
-                        class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'sad' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
-                        😢
-                    </button>
-                    <button type="submit" name="reaction" value="angry"
-                        class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'angry' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
-                        😡
-                    </button>
-                </div>
-            </form>
+            @auth
+                <form method="POST" action="{{ url('/likes/' . $post->id) }}" class="mb-4">
+                    @csrf
+                    @method('PUT')
+                    <div class="flex flex-wrap justify-between gap-2">
+                        <button type="submit" name="reaction" value="like"
+                            class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'like' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
+                            👍
+                        </button>
+                        <button type="submit" name="reaction" value="love"
+                            class="w-12 h-12 rounded-full cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 {{ $reaction === 'love' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
+                            ❤️
+                        </button>
+                        <button type="submit" name="reaction" value="haha"
+                            class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'haha' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
+                            😂
+                        </button>
+                        <button type="submit" name="reaction" value="wow"
+                            class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'wow' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
+                            😮
+                        </button>
+                        <button type="submit" name="reaction" value="sad"
+                            class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'sad' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
+                            😢
+                        </button>
+                        <button type="submit" name="reaction" value="angry"
+                            class="w-12 h-12 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer {{ $reaction === 'angry' ? 'ring-2 ring-teal-600 dark:ring-purple-900' : '' }}">
+                            😡
+                        </button>
+                    </div>
+                </form>
+            @endauth
             <ul class="flex flex-wrap gap-2">
                 @forelse ($post->likes as $user)
                     <li class="flex items-center gap-1 text-sm text-gray-600 dark:text-gray-400">
```

Ce code utilise la directive `@can` pour vérifier si l'utilisateur.trice
connecté.e est autorisé.e à modifier le post. Si c'est le cas, le lien pour
modifier le post est affiché, sinon il est masqué.

Dans la seconde partie du code, nous avons utilisé la directive `@auth` pour
vérifier si l'utilisateur.trice est connecté.e avant d'afficher le formulaire de
réaction. Si l'utilisateur.trice n'est pas connecté.e, le formulaire de réaction
est masqué.

Dans la vue `resources/views/posts/index.blade.php`, vous pouvez faire de même
pour masquer le bouton de création de post si la personne n'en a pas
l'autorisation :

```diff
diff --git a/resources/views/posts/index.blade.php b/resources/views/posts/index.blade.php
index 3647e83..a8b0a0f 100644
--- a/resources/views/posts/index.blade.php
+++ b/resources/views/posts/index.blade.php
@@ -15,10 +15,12 @@
         {{ __('ui.posts.index.description', ['app_name' => config('app.name')]) }}
     </p>

-    <a href="{{ url('/posts/create') }}"
-        class="mt-6 block w-full px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 text-center">
-        {{ __('ui.posts.create.title') }}
-    </a>
+    @can('create', App\Models\Post::class)
+        <a href="{{ url('/posts/create') }}"
+            class="mt-6 block w-full px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 text-center">
+            {{ __('ui.posts.create.title') }}
+        </a>
+    @endcan

     <div class="mt-8 space-y-6">
         @foreach ($posts as $post)
```

Ici, nous utilisons la directive `@can` pour vérifier si l'utilisateur.trice
connecté.e est autorisé.e à créer un post. Si c'est le cas, le bouton de
création de post est affiché, sinon il est masqué.

Comme il n'y a pas d'objet `$post` spécifique à vérifier pour la création d'un
post, nous passons la classe `App\Models\Post::class` à la directive `@can` pour
vérifier les autorisations au niveau de la classe.

Une alternative à cela serait d'utiliser la directive `@auth` pour vérifier
simplement si l'utilisateur.trice est connecté.e avant d'afficher le bouton de
création de post, mais l'utilisation de la directive `@can` est plus précise car
elle vérifie les autorisations spécifiques définies dans la politique
d'autorisation. Si la politique d'autorisation est mise à jour à l'avenir pour
restreindre davantage la création de posts, le bouton sera automatiquement
masqué pour les utilisateur.trice.s qui ne sont pas autorisé.e.s, même s'ils
sont connecté.e.s.

## Tester les fonctionnalités d'authentification

Vous pouvez maintenant tester les fonctionnalités d'authentification que nous
avons mises en place.

Essayez de tester les différentes fonctionnalités d'inscription, de connexion et
de déconnexion pour vous assurer que tout fonctionne correctement.

Essayez également de créer des posts et de les associer à différents
utilisateur.trice.s pour vérifier que les associations fonctionnent
correctement.

Essayez de liker des posts avec différents utilisateur.trice.s pour vérifier que
les réactions sont correctement associées à chaque utilisateur.trice.

Essayez de modifier les posts des autres utilisateur.trices pour vérifier que
les autorisations sont correctement mises en place.

## Conclusion

Dans cette partie, nous avons vu comment implémenter des fonctionnalités
d'authentification et d'autorisation dans une application Laravel.

Nous avons mis en place un système d'inscription, de connexion et de déconnexion
pour permettre aux utilisateur.trice.s de créer un compte et de se connecter à
l'application.

Nous avons également créé une politique d'autorisation pour le modèle `Post`
afin de n'autoriser que l'auteur.trice d'un post à le modifier ou le supprimer.

Enfin, nous avons amélioré l'expérience utilisateur en masquant les éléments de
l'interface utilisateur qui ne sont pas pertinents pour les personnes non
authentifiées ou non autorisées.

L'authentification et l'autorisation sont des aspects essentiels de la plupart
des applications web, et Laravel fournit des outils puissants pour les
implémenter de manière sécurisée et efficace.

Il existe de nombreuses autres fonctionnalités d'authentification et
d'autorisation que vous pouvez explorer et implémenter dans votre application,
comme la vérification de l'adresse e-mail, la réinitialisation du mot de passe,
les rôles et permissions, etc. N'hésitez pas à expérimenter et à ajouter ces
fonctionnalités à votre mini-projet personnel pour approfondir vos connaissances
sur ce sujet.

## Solution

La solution du mini-projet est accessible dans un dépôt GitHub dédié à l'adresse
suivante :
<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-mini-projet/tree/mini-projet-6>.

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

- Demander aux utilisateur.trice.s de confirmer leur adresse e-mail avant de
  pouvoir se connecter.
- Permettre aux utilisateur.trice.s de réinitialiser leur mot de passe en cas
  d'oubli.
- Mettre en place des profils publics et privés.
- Suivre d'autres utilisateur.trice.s et voir leurs posts dans un fil
  d'actualité personnalisé.
- Ajouter un rôle d'administrateur.trice/modérateur.trice pour gérer les
  utilisateur.trice.s et les contenus de l'application.

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé les exercices et le mini-projet.

- Seriez-vous capable d'ajouter le bouton de déconnexion dans la barre de
  navigation principale de l'application au lieu de le laisser uniquement dans
  le profil de l'utilisateur.trice ? Pour cela, vous pouvez créer un composant
  Blade le bouton de déconnexion. Ensuite, utilisez ce bouton dans la barre de
  navigation et le profil selon si la personne est connectée ou non.
- Seriez-vous capable d'afficher un message de succès après l'inscription d'un.e
  utilisateur.trice (par exemple, _"Votre compte a été créé avec succès. Vous
  pouvez maintenant vous connecter."_). Pour cela, vous pouvez utiliser les
  messages flash de Laravel pour stocker un message dans la session qui sera
  affiché à l'utilisateur.trice après la redirection vers la page de connexion.
  Vous pouvez consulter la documentation de Laravel sur les messages flash pour
  voir comment faire cela : <https://laravel.com/docs/12.x/session#flash-data>.
- Seriez-vous capable de mettre en place des pages personnalisées pour les
  erreurs 403, 404 et 500 dans votre application Laravel ? Pour cela, vous
  pouvez vous aider de la documentation officielle de Laravel sur les pages
  d'erreur personnalisées :
  <https://laravel.com/docs/12.x/errors#custom-http-error-pages>.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

````

```

```
````
