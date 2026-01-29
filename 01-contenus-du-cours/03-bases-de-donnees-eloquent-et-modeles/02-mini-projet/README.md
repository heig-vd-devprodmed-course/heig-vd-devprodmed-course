# Bases de données, Eloquent et modèles - Mini-projet

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Trouvez d'autres informations relatives à ce contenu dans le
> [contenu parent](../README.md).

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Réinitialiser le projet Laravel](#réinitialiser-le-projet-laravel)
  - [Créer une issue pour suivre cette tâche](#créer-une-issue-pour-suivre-cette-tâche)
  - [Restaurer la base de données à son état initial](#restaurer-la-base-de-données-à-son-état-initial)
  - [Supprimer les fichiers de migration de base créés par Laravel](#supprimer-les-fichiers-de-migration-de-base-créés-par-laravel)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche)
  - [Supprimer les modèles et les fichiers associés créés par Laravel](#supprimer-les-modèles-et-les-fichiers-associés-créés-par-laravel)
  - [Ajouter les migrations nécessaires à Laravel](#ajouter-les-migrations-nécessaires-à-laravel)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement)
- [Réaliser le design de la base de données](#réaliser-le-design-de-la-base-de-données)
  - [Identifier les entités et leurs attributs](#identifier-les-entités-et-leurs-attributs)
  - [Réaliser le modèle conceptuel des données (MCD)](#réaliser-le-modèle-conceptuel-des-données-mcd)
  - [Réaliser le modèle logique des données (MLD)](#réaliser-le-modèle-logique-des-données-mld)
  - [Réaliser le modèle physique des données (MPD)](#réaliser-le-modèle-physique-des-données-mpd)
- [Créer les modèles Eloquent et les migrations associées](#créer-les-modèles-eloquent-et-les-migrations-associées)
  - [Créer le modèle User](#créer-le-modèle-user)
  - [Créer le modèle Post](#créer-le-modèle-post)
  - [Créer le modèle Like](#créer-le-modèle-like)
- [Populer la base de données avec des données factices](#populer-la-base-de-données-avec-des-données-factices)
- [Tester les modèles Eloquent](#tester-les-modèles-eloquent)
  - [Récupérer les utilisateur.trices](#récupérer-les-utilisateurtrices)
  - [Récupérer les posts](#récupérer-les-posts)
  - [Récupérer les likes](#récupérer-les-likes)
  - [Récupérer les posts d'un.e utilisateur.trice](#récupérer-les-posts-dune-utilisateurtrice)
  - [Récupérer les posts likés par un.e utilisateur.trice](#récupérer-les-posts-likés-par-une-utilisateurtrice)
  - [Récupérer les utilisateur.trices ayant liké un post](#récupérer-les-utilisateurtrices-ayant-liké-un-post)
  - [Créer un nouveau post](#créer-un-nouveau-post)
  - [Liker un post](#liker-un-post)
- [Conclusion](#conclusion)
- [Solution](#solution)

## Objectifs

Mettre en place la structure de base de données et les modèles Eloquent pour le
petit réseau social.

## Réinitialiser le projet Laravel

Lors de l'initialisation d'un projet Laravel, certains fichiers de base sont
créés automatiquement.

Ces fichiers peuvent être utilisés tels quels, mais pour ce mini-projet, nous
allons les supprimer afin de créer nos propres modèles et migrations à partir de
zéro.

### Créer une issue pour suivre cette tâche

Comme il s'agit d'une nouvelle tâche à effectuer sur le projet Laravel, nous
allons créer une nouvelle issue dans le dépôt GitHub du projet pour suivre cette
tâche.

Créez une nouvelle issue intitulée _"Réinitialiser le projet Laravel"_, comme
étudié dans la séance précédente.

De cette issue, créez une nouvelle branche Git et basculez dessus localement
pour effectuer les modifications nécessaires.

La commande utilisée pour créer et basculer sur une nouvelle branche Git donnée
par GitHub devrait ressembler à ceci :

```bash
git fetch origin
git checkout 3-réinitialiser-le-projet-laravel
```

### Restaurer la base de données à son état initial

Lors de l'initialisation du projet Laravel, une base de données SQLite a été
créée et les migrations initiales ont été appliquées.

Comme nous utilisons une base de données SQLite, il suffirait de supprimer le
fichier `database/database.sqlite` pour réinitialiser la base de données.

Mais pour des raisons de complétude, nous allons utiliser la commande Artisan
pour réinitialiser la base de données en annulant toutes les migrations
appliquées. Cette manière est plus générale et fonctionnerait également avec
d'autres types de bases de données.

Pour restaurer la base de données à son état initial, exécuter la commande
suivante dans le terminal à la racine du projet Laravel :

```bash
php artisan migrate:rollback
```

Cette commande annulera la dernière "batch" de migrations appliquées. Un batch
correspond à un groupe de migrations appliquées ensemble lors d'une exécution de
la commande `php artisan migrate`.

Comme lors de l'initialisation du projet Laravel, plusieurs migrations ont été
appliquées en une seule fois, lors de l'exécution de la commande
`php artisan migrate`, le résultat devrait être similaire à ceci :

```txt
   INFO  Rolling back migrations.

  0001_01_01_000002_create_jobs_table ............... 13.52ms DONE
  0001_01_01_000001_create_cache_table ............... 5.81ms DONE
  0001_01_01_000000_create_users_table ............... 8.33ms DONE
```

Ce batch correspond aux trois migrations créant les tables `users`, `cache` et
`jobs` initiales de Laravel.

Si plusieurs "batches" ont été appliquées, il faudra exécuter cette commande
plusieurs fois jusqu'à ce que toutes les migrations soient annulées. Une autre
commande permet de tout annuler en une seule fois :

```bash
php artisan migrate:reset
```

Cette commande annulera toutes les migrations appliquées et réinitialisera la
base de données à son état initial.

Les commandes `php artisan migrate:rollback` et `php artisan migrate:reset` ont
appelé les méthodes `down` des migrations pour annuler les modifications
apportées à la base de données.

Si vous ouvrez le fichier `database/database.sqlite`, vous verrez qu'il est
maintenant vide, sans aucune table.

### Supprimer les fichiers de migration de base créés par Laravel

Les commandes `php artisan migrate:rollback` et `php artisan migrate:reset`
n'effacent pas les fichiers de migration eux-mêmes.

Cela permet de les conserver pour référence future, les modifier et les
réappliquer, mais dans ce mini-projet, nous allons les supprimer pour repartir
de zéro.

Supprimez tous les fichiers du dossier `database/migrations/`.

A l'aide de la commande Git, vérifiez que les fichiers ont bien été supprimés :

```bash
git status
```

Le résultat devrait ressembler à ceci :

```txt
On branch 3-réinitialiser-le-projet-laravel
Your branch is up to date with 'origin/3-réinitialiser-le-projet-laravel'.

Changes not staged for commit:
  (use "git add/rm <file>..." to update what will be committed)
  (use "git restore <file>..." to discard changes in working directory)
        deleted:    database/migrations/0001_01_01_000000_create_users_table.php
        deleted:    database/migrations/0001_01_01_000001_create_cache_table.php
        deleted:    database/migrations/0001_01_01_000002_create_jobs_table.php

no changes added to commit (use "git add" and/or "git commit -a")
```

Ceci indique que les fichiers de migration ont bien été supprimés, mais que les
modifications n'ont pas encore été validées (_"commit"_) dans Git.

Ajoutez ces suppressions à l'index Git avec la commande suivante :

```bash
git add database/migrations/
```

Puis, validez ces modifications avec un message de commit approprié :

```bash
git commit -m "Supprimer les fichiers de migration de base"
```

Puis, poussez les modifications vers le dépôt distant sur GitHub :

```bash
git push
```

### Créer la pull request pour cette tâche

Une fois les modifications poussées vers le dépôt distant, créez une pull
request depuis la branche `3-réinitialiser-le-projet-laravel` vers la branche
principale `main`, comme étudié dans la séance précédente.

Revoyez les modifications, spécifiez son titre _"Réinitialiser le projet
Laravel"_, ajoutez une description si nécessaire, puis créez la pull request,
**mais ne la fusionnez pas encore**. D'autres modifications seront apportées à
cette branche dans les étapes suivantes.

### Supprimer les modèles et les fichiers associés créés par Laravel

Lors de l'initialisation du projet Laravel, un modèle `User` a été créé
automatiquement dans le dossier `app/Models/` ainsi que plusieurs fichiers
associés, tels que des factories et des seeders.

Pour repartir de zéro, nous allons supprimer le modèle `User` et les fichiers
associés.

Supprimez les fichiers suivants dans le dossier `app/Models/`,
`database/factories/` et `database/seeders/` :

- `app/Models/User.php`.
- `database/factories/UserFactory.php`.
- `database/seeders/DatabaseSeeder.php`.

À l'aide de la commande Git, vérifiez que les fichiers ont bien été supprimés :

```bash
git status
```

Le résultat devrait ressembler à ceci :

```txt
On branch 3-réinitialiser-le-projet-laravel
Your branch is up to date with 'origin/3-réinitialiser-le-projet-laravel'.

Changes not staged for commit:
  (use "git add/rm <file>..." to update what will be committed)
  (use "git restore <file>..." to discard changes in working directory)
        deleted:    app/Models/User.php
        deleted:    database/factories/UserFactory.php
        deleted:    database/seeders/DatabaseSeeder.php

no changes added to commit (use "git add" and/or "git commit -a")
```

Ceci indique que les fichiers ont bien été supprimés, mais que les modifications
n'ont pas encore été validées (_"commit"_) dans Git.

Ajoutez ces suppressions à l'index Git avec la commande suivante :

```bash
git add app/Models/ database/factories/ database/seeders/
```

ou simplement pour rajouter tous les fichiers :

```bash
git add .
```

Puis, validez ces modifications avec un message de commit approprié :

```bash
git commit -m "Supprimer les modèles et fichiers associés de base"
```

Puis, poussez les modifications vers le dépôt distant sur GitHub :

```bash
git push
```

La pull request créée précédemment sera automatiquement mise à jour avec ces
nouvelles modifications.

### Ajouter les migrations nécessaires à Laravel

Lorsque nous avons supprimé les fichiers de migration de base créés par Laravel,
nous avons également supprimé certaines migrations nécessaires au bon
fonctionnement de Laravel.

Pourquoi avoir supprimé ces migrations si elles sont nécessaires au bon
fonctionnement de Laravel ?

Parce que certaines de ces migrations couplaient plusieurs fonctionnalités
avancées en une seule migration, mélangeant des fonctionnalités que nous
souhaitons modifier et d'autres que nous n'allons pas utiliser dans ce
mini-projet.

De ce fait, il était donc plus simple de tout supprimer et de ne rétablir que
les migrations nécessaires. Cela permet aussi de mieux séparer les migrations
nécessaires à Laravel et les migrations spécifiques au mini-projet.

Pour rétablir les migrations nécessaires au bon fonctionnement de Laravel, nous
allons utiliser les commandes Artisan suivantes :

```bash
php artisan make:session-table
```

```bash
php artisan make:cache-table
```

```bash
php artisan make:queue-table
```

Ces trois commandes vont créer les fichiers de migration nécessaires dans le
dossier `database/migrations/`.

Appliquez ensuite ces migrations à la base de données en exécutant la commande
suivante dans le terminal à la racine du projet Laravel :

```bash
php artisan migrate
```

Le résultat devrait ressembler à ceci :

```txt
   INFO  Running migrations.

  2026_01_29_142851_create_sessions_table ........... 12.98ms DONE
  2026_01_29_142857_create_cache_table .............. 13.05ms DONE
  2026_01_29_142954_create_jobs_table ................ 6.29ms DONE
```

Les migrations ont été appliquées avec succès et les tables nécessaires ont été
créées dans la base de données.

Pour le moment, ces migrations ne sont pas importantes pour la réalisation du
mini-projet, mais elles sont nécessaires au bon fonctionnement de Laravel.

La documentation nécessaire pour comprendre ces fonctionnalités avancées de
Laravel est disponible aux adresses suivantes :

- <https://laravel.com/docs/12.x/session#driver-prerequisites>.
- <https://laravel.com/docs/12.x/cache#driver-prerequisites>.
- <https://laravel.com/docs/12.x/queues#driver-prerequisites>.

Si le temps le permet, nous pourrons explorer leur utilité/fonctionnement dans
une future séance.

Validez que l'application fonctionne toujours correctement en exécutant la
commande suivante dans le terminal à la racine du projet Laravel :

```bash
composer run dev
```

Puis accédez à l'URL <http://localhost:8000> dans votre navigateur web pour
vérifier que la page d'accueil s'affiche correctement.

### Valider et fusionner la pull request

Une fois les modifications poussées vers le dépôt distant, revenez à la pull
request créée précédemment sur GitHub.

Revoyez les modifications puis validez la pull request.

Si une quelconque modification est nécessaire, effectuez-la localement,
poussez-la vers le dépôt distant.

Une fois satisfait.e des modifications, fusionnez la pull request dans la
branche principale `main`.

### Récupérer les modifications localement

Une fois la pull request fusionnée, n'oubliez pas de récupérer les modifications
dans votre dépôt local en basculant sur la branche principale `main` et en
exécutant la commande suivante :

```bash
git pull
```

Cela permet de s'assurer que votre dépôt local est à jour avec les dernières
modifications apportées dans la branche principale `main`.

Ce flux de travail avec les issues, les branches Git et les pull requests peut
paraître long et fastidieux au début, mais il permet de séquencer et d'organiser
le travail de manière efficace, surtout dans un contexte de développement
collaboratif.

## Réaliser le design de la base de données

Maintenant que le projet Laravel a été réinitialisé, nous allons concevoir la
structure de la base de données pour le petit réseau social.

### Identifier les entités et leurs attributs

De façon simple et non-formelle, prenez un moment pour identifier les entités
principales du petit réseau social et leurs attributs.

Pour cela, vous pouvez utiliser un bloc-notes, un diagramme, ou tout autre outil
de votre choix.

De quelles entités avons-nous besoin pour réaliser un petit réseau social où les
utilisateur.trices peuvent créer des posts et liker les posts des autres
utilisateur.trices ?

Quels attributs chaque entité devrait-elle avoir pour stocker les informations
nécessaires ?

Prenez quelques minutes pour réfléchir à ces questions avant de passer à l'étape
suivante. Entraidez-vous si nécessaire et n'hésitez pas à poser des questions si
vous avez des doutes.

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir à la structure de la base de données.
>
> N'hésitez pas à proposer d'autres entités ou attributs si vous le souhaitez.

De haut niveau, nous aurions besoin des entités suivantes :

- Utilisateur.trice (`User`).
- Publication (`Post`).
- J'aime (`Like`).

Chaque entité aurait les attributs suivants :

- Entité `User` (utilisateur.trice) :
  - Attributs : `id`, `firstName`, `lastName`, `username`, `email`, `password`,
    `created_at`, `updated_at`.
- Entité `Post` (publication) :
  - Attributs : `id`, `user_id`, `content`, `created_at`, `updated_at`.
- Entité `Like` (j'aime) :
  - Attributs : `id`, `user_id`, `post_id`, `created_at`.

Si vous avez proposé une entité `Profile` en plus de l'entité `User`, c'est tout
à fait acceptable mais cela ne sera pas forcément nécessaire. Un profil peut
être intégré directement dans l'entité `User` pour simplifier la structure de la
base de données. Finalement, un profil est simplement la mise à jour de son/sa
propre utilisateur.trice `User`.

Si vous avez proposé d'autres entités ou attributs, c'est tout à fait
acceptable. L'important est de réfléchir à la structure de la base de données et
de s'assurer qu'elle répond aux besoins du petit réseau social.

</details>

### Réaliser le modèle conceptuel des données (MCD)

Avec un simple papier et un crayon, ou un outil de modélisation de votre choix,
réalisez le modèle conceptuel des données (MCD) pour le petit réseau social.

Cela vous permettra de mettre à plat les idées que vous avez eues dans l'étape
précédente.

Pour rappel, un MCD est une représentation graphique des entités, de leurs
attributs et de leurs relations. Il s'agit surtout d'un diagramme orienté
"business" illustrant les entités et leurs relations sans se soucier des détails
techniques de la base de données.

> [!NOTE]
>
> Je (Ludovic) ne me considère pas comme un expert en modélisation de données à
> l'aide d'un MCD. D'autres personnes pourraient proposer des modèles différents
> et plus complets. L'objectif est de réfléchir à la structure de la base de
> données et de s'assurer qu'elle répond aux besoins du petit réseau social.

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir à la structure de la base de données.
>
> N'hésitez pas à proposer d'autres entités ou attributs si vous le souhaitez.

![Modèle conceptuel des données pour le mini-réseau social](./images/conceptual-data-model.svg)

</details>

### Réaliser le modèle logique des données (MLD)

Avec un simple papier et un crayon, ou un outil de modélisation de votre choix,
réalisez le modèle logique des données (MLD) pour le petit réseau social.

Cela vous permettra de mettre à plat les idées que vous avez eues dans l'étape
précédente.

Pour rappel, un MLD est une représentation graphique des tables, de leurs
colonnes, et de leurs relations. Il s'agit d'un diagramme plus technique
illustrant la structure de la base de données mais qui n'est pas encore
spécifique à un SGBD particulier.

> [!NOTE]
>
> Je (Ludovic) ne me considère pas comme un expert en modélisation de données à
> l'aide d'un MLD. D'autres personnes pourraient proposer des modèles différents
> et plus complets. L'objectif est de réfléchir à la structure de la base de
> données et de s'assurer qu'elle répond aux besoins du petit réseau social.

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir à la structure de la base de données.
>
> N'hésitez pas à proposer d'autres entités ou attributs si vous le souhaitez.

![Modèle logique des données pour le mini-réseau social](./images/logical-data-model.svg)

</details>

### Réaliser le modèle physique des données (MPD)

Avec un simple papier et un crayon, ou un outil de modélisation de votre choix,
réalisez le modèle physique des données (MPD) pour le petit réseau social.

Cela vous permettra de mettre à plat les idées que vous avez eues dans l'étape
précédente.

Pour rappel, un MPD est une représentation graphique des tables, de leurs
colonnes, de leurs types de données, de leurs contraintes, et de leurs
relations. Il s'agit d'un diagramme très technique illustrant la structure de la
base de données spécifique à un SGBD particulier.

> [!NOTE]
>
> Je (Ludovic) ne me considère pas comme un expert en modélisation de données à
> l'aide d'un MPD. D'autres personnes pourraient proposer des modèles différents
> et plus complets. L'objectif est de réfléchir à la structure de la base de
> données et de s'assurer qu'elle répond aux besoins du petit réseau social.

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir à la structure de la base de données.
>
> N'hésitez pas à proposer d'autres entités ou attributs si vous le souhaitez.

![Modèle physique des données pour le mini-réseau social](./images/physical-data-model.svg)

</details>

## Créer les modèles Eloquent et les migrations associées

Maintenant que le design de la base de données a été réalisé, nous allons créer
les modèles Eloquent et les migrations associées pour le petit réseau social.

### Créer le modèle User

Dans cette section, nous allons créer le modèle Eloquent `User` ainsi que la
migration associée pour la table `users`.

#### Créer l'issue et la branche pour suivre cette tâche

Comme il s'agit d'une nouvelle tâche à effectuer sur le projet Laravel, nous
allons créer une nouvelle issue dans le dépôt GitHub du projet pour suivre cette
tâche.

Créez une nouvelle issue et sa branche associée intitulée _"Créer le modèle User
et la migration associée"_, comme étudié dans la séance précédente.

Basculez localement sur cette nouvelle branche pour effectuer les modifications
nécessaires.

#### Créer le modèle et la migration

A l'aide de la commande Artisan, créez le modèle Eloquent `User` avec la
migration associée :

```bash
php artisan make:model User --migration
```

Cela créera le fichier `app/Models/User.php` pour le modèle Eloquent `User`
ainsi que le fichier de migration dans le dossier `database/migrations/`.

Le résultat devrait ressembler à ceci :

```txt
   INFO  Model [app/Models/User.php] created successfully.

   INFO  Migration [database/migrations/2026_01_29_143919_create_users_table.php] created successfully.
```

#### Définir la migration

Ouvrez le fichier de migration créé dans le dossier `database/migrations/` et
définissez la structure de la table `users` en ajoutant les colonnes
correspondantes aux attributs du modèle `User`.

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('first_name');
    $table->string('last_name');
    $table->string('username')->unique();
    $table->string('email')->unique();
    $table->string('password');
    $table->timestamps();
});
```

Il est de convention dans les bases de données relationnelles d'utiliser le
format `snake_case` pour les noms de colonnes. Ainsi, les colonnes sont nommées
`first_name` et `last_name` dans la table `users`.

#### Appliquer la migration

Une fois les modifications apportées au fichier de migration, appliquez la
migration à la base de données en exécutant la commande suivante dans le
terminal à la racine du projet Laravel :

```bash
php artisan migrate
```

Le résultat devrait ressembler à ceci :

```txt
   INFO  Running migrations.

  2026_01_29_143919_create_users_table ................................. 11.13ms DONE
```

La migration a été appliquée avec succès et la table `users` a été créée dans la
base de données.

Pour rappel, une fois une migration appliquée, il est fortement déconseillé de
modifier le fichier de migration. Si des modifications sont nécessaires, il faut
créer une nouvelle migration pour apporter ces modifications ou annuler la
migration existante avec la commande `php artisan migrate:rollback` puis la
modifier avant de la réappliquer. Cela peut entraîner la perte de données si la
table contient déjà des données.

Ouvrez le fichier `database/database.sqlite` pour vérifier que la table `users`
a bien été créée avec les colonnes définies dans la migration.

Vous remarquerez que la base de données contient aussi une table `migrations`
qui est utilisée par Laravel pour suivre les migrations appliquées. C'est grâce
à cette table que les commandes `php artisan migrate`,
`php artisan migrate:rollback` et `php artisan migrate:reset` fonctionnent
correctement.

#### Définir les attributs du modèle

Ouvrez le fichier `app/Models/User.php` et définissez les attributs du modèle
`User` en ajoutant la propriété `$fillable` pour spécifier les attributs
modifiables en masse.

```php
protected $fillable = [
    'firstName',
    'lastName',
    'username',
    'email',
    'password',
];
```

#### Valider et pousser les modifications

À l'aide de la commande Git, ajoutez les nouveaux fichiers à l'index Git :

```bash
git add .
```

Puis, validez ces modifications avec un message de commit approprié :

```bash
git commit -m "Créer le modèle User et la migration associée"
```

Puis, poussez les modifications vers le dépôt distant sur GitHub :

```bash
git push
```

#### Créer, valider et fusionner la pull request

Une fois les modifications poussées vers le dépôt distant, créez une pull
request depuis la branche créée pour cette tâche vers la branche principale
`main`, comme étudié dans la séance précédente.

Revoyez les modifications, spécifiez son titre _"Créer le modèle User et la
migration associée"_, ajoutez une description si nécessaire, puis créez la pull
request, puis fusionnez-la dans la branche principale `main`.

### Créer le modèle Post

TODO

#### Créer l'issue et la branche pour suivre cette tâche

TODO

#### Créer le modèle et la migration

TODO

#### Définir la migration

TODO

#### Appliquer la migration

TODO

#### Définir les attributs du modèle

TODO

#### Valider et pousser les modifications

TODO

#### Créer, valider et fusionner la pull request

TODO

### Créer le modèle Like

TODO

#### Créer l'issue et la branche pour suivre cette tâche

TODO

#### Créer le modèle et la migration

TODO

#### Définir la migration

TODO

#### Appliquer la migration

TODO

#### Définir les attributs du modèle

TODO

#### Valider et pousser les modifications

TODO

#### Créer, valider et fusionner la pull request

TODO

## Populer la base de données avec des données factices

TODO

## Tester les modèles Eloquent

TODO

### Récupérer les utilisateur.trices

TODO

### Récupérer les posts

TODO

### Récupérer les likes

TODO

### Récupérer les posts d'un.e utilisateur.trice

TODO

### Récupérer les posts likés par un.e utilisateur.trice

TODO

### Récupérer les utilisateur.trices ayant liké un post

TODO

### Créer un nouveau post

TODO

### Liker un post

TODO

## Conclusion

Ce mini-projet met en place les fondations de la base de données pour le petit
réseau social. Les migrations et les modèles Eloquent permettront de gérer les
posts et les likes de manière simple et sécurisée.

Dans les futures étapes, nous pourrions ajouter des fonctionnalités qui
demanderont des modifications à la structure de la base de données.

Dans ce cas, nous pourrions créer de nouvelles migrations pour modifier la
structure existante sans perdre les données déjà présentes.

Grâce à la mise en place de cette source de vérité (_"source of truth"_), nous
pourrons désormais développer les fonctionnalités du petit réseau social en
s'appuyant sur une base de données solide et bien conçue.

## Solution

La solution du mini-projet est accessible dans un dépôt GitHub dédié à l'adresse
suivante :
<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-mini-projet/tree/mini-projet-2>.

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

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
