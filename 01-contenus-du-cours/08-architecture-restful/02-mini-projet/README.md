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
- [Installer un outil capable d'effectuer des requêtes HTTP pour tester l'API de votre application](#installer-un-outil-capable-deffectuer-des-requêtes-http-pour-tester-lapi-de-votre-application)
- [TODO](#todo)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

## Installer un outil capable d'effectuer des requêtes HTTP pour tester l'API de votre application

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

## TODO

```bash
php artisan install:api
```

```text
./composer.json has been updated
Running composer update laravel/sanctum
Loading composer repositories with package information
Updating dependencies
Lock file operations: 1 install, 0 updates, 0 removals
  - Locking laravel/sanctum (v4.3.1)
Writing lock file
Installing dependencies from lock file (including require-dev)
Package operations: 1 install, 0 updates, 0 removals
  - Downloading laravel/sanctum (v4.3.1)
  - Installing laravel/sanctum (v4.3.1): Extracting archive
Generating optimized autoload files
> Illuminate\Foundation\ComposerScripts::postAutoloadDump
> @php artisan package:discover --ansi

   INFO  Discovering packages.

  laravel-lang/config ................................................... DONE
  laravel-lang/lang ..................................................... DONE
  laravel-lang/locales .................................................. DONE
  laravel-lang/publisher ................................................ DONE
  laravel/pail .......................................................... DONE
  laravel/sail .......................................................... DONE
  laravel/sanctum ....................................................... DONE
  laravel/tinker ........................................................ DONE
  nesbot/carbon ......................................................... DONE
  nunomaduro/collision .................................................. DONE
  nunomaduro/termwind ................................................... DONE
  pestphp/pest-plugin-laravel ........................................... DONE

97 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
> @php artisan vendor:publish --tag=laravel-assets --ansi --force

   INFO  No publishable resources for tag [laravel-assets].

> @php artisan lang:update

   INFO  Collecting translations...

  LaravelLang\Lang\Plugin ........................................ 6.07ms DONE

   INFO  Storing changes...

  fr.json ........................................................ 0.30ms DONE
  fr/auth.php .................................................... 0.61ms DONE
  fr/pagination.php .............................................. 0.20ms DONE
  fr/passwords.php ............................................... 0.17ms DONE
  fr/validation.php .............................................. 1.83ms DONE

Found 5 security vulnerability advisories affecting 4 packages.
Run "composer audit" for a full list of advisories.

   INFO  Published API routes file.

 One new database migration has been published. Would you like to run all pending database migrations? (yes/no) [yes]:
 > yes

   INFO  Running migrations.

  2026_03_23_125948_create_personal_access_tokens_table ..................................................................... 13.97ms DONE


   INFO  API scaffolding installed. Please add the [Laravel\Sanctum\HasApiTokens] trait to your User model.
```

```bash
php artisan make:controller TokenController --resource
```

```text
   INFO  Controller [app/Http/Controllers/TokenController.php] created successfully.
```

```bash
php artisan make:view tokens.index
```

```text
   INFO  View [resources/views/tokens/index.blade.php] created successfully.
```

```bash
php artisan make:view tokens.create
```

```text
   INFO  View [resources/views/tokens/create.blade.php] created successfully.
```

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
