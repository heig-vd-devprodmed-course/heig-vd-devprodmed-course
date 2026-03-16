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
  - [Créer les vues](#créer-les-vues)
  - [Créer les contrôleurs et les routes](#créer-les-contrôleurs-et-les-routes)
  - [Protéger les ressources précédemment créées](#protéger-les-ressources-précédemment-créées)
- [Utiliser la personne authentifiée dans le reste de l'application](#utiliser-la-personne-authentifiée-dans-le-reste-de-lapplication)
  - [Associer la personne authentifiée aux posts](#associer-la-personne-authentifiée-aux-posts)
  - [Associer la personne authentifiée aux likes](#associer-la-personne-authentifiée-aux-likes)
- [N'autoriser que l'auteur.trice à modifier ses propres posts](#nautoriser-que-lauteurtrice-à-modifier-ses-propres-posts)
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

- TODO

</details>

## Créer le nécessaire pour s'inscrire et se connecter

Dans cette section, nous allons mettre en place les mécanismes nécessaires pour
permettre aux utilisateur.trice.s de se créer un compte et se connecter.

Pour cela, nous allons devoir :

1. Modifier la base de données et les modèles pour ajouter les champs
   nécessaires à l'authentification.
2. Créer les vues pour l'inscription et la connexion.
3. Créer les contrôleurs et les routes pour gérer l'inscription et la connexion.
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

### Créer les vues et les contrôleurs pour l'inscription

Pour permettre aux utilisateur.trice.s de se créer un compte nous allons devoir
créer des vues et les contrôleurs pour l'inscription.

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
un formulaire d'inscription. Voici un exemple de code que vous pouvez utiliser
comme point de départ :

```php
TODO
```

Mettons à jour les traductions pour les champs du formulaire d'inscription dans
le fichier `lang/fr/ui.php` :

```php
TODO
```

#### Créer le contrôleur d'inscription

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

Nous allons maintenant remplir le contrôleur `AuthController` avec les méthodes
nécessaires pour afficher le formulaire d'inscription et gérer la soumission du
formulaire :

```php

```

#### Lier le contrôleur aux routes

Maintenant que nous avons créé le contrôleur d'inscription, nous allons devoir
le lier aux routes pour que les utilisateur.trice.s puissent accéder au
formulaire d'inscription et soumettre leurs informations.

Ouvrez le fichier `routes/web.php` et ajoutez les routes suivantes pour
l'inscription :

```php

```

### Créer les vues et les contrôleurs pour la connexion

Pour permettre aux utilisateur.trice.s de se connecter, nous allons devoir créer
des vues et les contrôleurs pour la connexion.

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
TODO
```

### Créer les contrôleurs et les routes

### Protéger les ressources précédemment créées

Mettre en place les middlewares et les redirections

## Utiliser la personne authentifiée dans le reste de l'application

### Associer la personne authentifiée aux posts

### Associer la personne authentifiée aux likes

## N'autoriser que l'auteur.trice à modifier ses propres posts

Mettre en place les autorisations

## Conclusion

Dans cette partie, nous avons vu comment TODO.

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

- TODO

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé les exercices et le mini-projet.

- TODO

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

````

```

```
````
