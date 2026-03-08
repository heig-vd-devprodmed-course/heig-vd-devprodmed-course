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
- [TODO](#todo)
- [Mettre en place les formulaires pour gérer les posts](#mettre-en-place-les-formulaires-pour-gérer-les-posts)
- [Mettre en place les formulaires pour gérer le profil utilisateur.trice](#mettre-en-place-les-formulaires-pour-gérer-le-profil-utilisateurtrice)
- [Mettre en place le formulaire pour liker un post](#mettre-en-place-le-formulaire-pour-liker-un-post)
- [Améliorer la page de profil utilisateur.trice](#améliorer-la-page-de-profil-utilisateurtrice)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Mettre en place tous les formulaires nécessaires pour permettre aux
utilisateur.trice.s de créer, éditer et supprimer des posts, ainsi que de gérer
leur profil utilisateur.trice.

## TODO

```bash
php artisan make:controller --singleton MyProfileController

php artisan make:view my-profile.show

php artisan make:view my-profile.edit

php artisan make:migration add_profile_picture_to_users_table

php artisan migrate

php artisan storage:link
```

```text
   INFO  Controller [app/Http/Controllers/MyProfileController.php] created successfully.

   INFO  View [resources/views/my-profile/show.blade.php] created successfully.

   INFO  View [resources/views/my-profile/edit.blade.php] created successfully.


   INFO  Migration [database/migrations/2026_03_04_143945_add_profile_picture_to_users_table.php] created successfully.

   INFO  Running migrations.

  2026_03_04_143945_add_profile_picture_to_users_table ........................... 8.14ms DONE


   INFO  The [public/storage] link has been connected to [storage/app/public].

```

## Mettre en place les formulaires pour gérer les posts

## Mettre en place les formulaires pour gérer le profil utilisateur.trice

## Mettre en place le formulaire pour liker un post

## Améliorer la page de profil utilisateur.trice

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

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
