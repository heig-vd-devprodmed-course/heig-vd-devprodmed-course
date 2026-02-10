# Vues, Blade et Tailwind CSS - Mini-projet

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
- [Identifier les pages de l'interface utilisateur et leur structure](#identifier-les-pages-de-linterface-utilisateur-et-leur-structure)
- [Supprimer les vues et les routes de base créées par Laravel](#supprimer-les-vues-et-les-routes-de-base-créées-par-laravel)
- [Mettre en place l'internationalisation (i18n)](#mettre-en-place-linternationalisation-i18n)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche)
  - [Installer une librairie externe pour les clés de traduction](#installer-une-librairie-externe-pour-les-clés-de-traduction)
  - [Ajouter les clés de traduction de base pour la langue française](#ajouter-les-clés-de-traduction-de-base-pour-la-langue-française)
  - [Ajouter des clés de traduction personnalisées pour la langue française](#ajouter-des-clés-de-traduction-personnalisées-pour-la-langue-française)
  - [Configurer la langue par défaut et de la langue de secours](#configurer-la-langue-par-défaut-et-de-la-langue-de-secours)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request)
  - [Traduire en d'autres langues](#traduire-en-dautres-langues)
- [Créer un layout commun](#créer-un-layout-commun)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-1)
  - [Balises HTML de base](#balises-html-de-base)
  - [En-tête et menu de navigation](#en-tête-et-menu-de-navigation)
  - [Pied de page](#pied-de-page)
  - [Tester le layout commun avec une vue de test](#tester-le-layout-commun-avec-une-vue-de-test)
  - [Ajouter les styles CSS avec Tailwind CSS](#ajouter-les-styles-css-avec-tailwind-css)
  - [Visualiser les résultats dans le navigateur](#visualiser-les-résultats-dans-le-navigateur-1)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-1)
- [Créer un composant de publication](#créer-un-composant-de-publication)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-2)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-2)
- [Créer des vues pour les différentes pages](#créer-des-vues-pour-les-différentes-pages)
  - [Page d'accueil (feed)](#page-daccueil-feed)
  - [Page de profil](#page-de-profil)
  - [Page "à propos"](#page-à-propos)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Mettre en place l'interface utilisateur du petit réseau social en utilisant
Tailwind CSS et Blade.

## Identifier les pages de l'interface utilisateur et leur structure

Avant de commencer à coder, il est important d'identifier les différentes pages
et leur structure que nous allons devoir créer pour notre application de réseau
social.

A l'aide d'un outil de prototypage ou simplement d'un dessin sur papier, essayez
d'identifier les différentes pages de l'interface utilisateur et leur structure
que vous allez devoir créer pour votre application de réseau social.

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir aux pages de l'interface utilisateur et à
> leur structure.
>
> N'hésitez pas à proposer d'autres pages ou structures que celles mentionnées
> dans cet exemple.

Je (Ludovic) n'ai pas pris le temps de réaliser des esquisses (wireframes) ou
des maquettes (mockups) pour ce projet, mais voici une liste non exhaustive des
pages et des structures que je pense qu'il est important d'avoir pour
l'interface utilisateur d'un réseau social.

**Pages**

- Page d'accueil (feed) : affiche les publications des utilisateur.trices.
- Page de profil : affiche les informations d'un utilisateur.trice et ses
  publications.
- Page de création de publication : permet à un utilisateur.trice de créer une
  nouvelle publication.
- Page de détails d'une publication : affiche les détails d'une publication.
- Page de modification d'une publication : permet à un.e utilisateur.trice de
  modifier une publication qu'il/elle a créée.
- Page de suppression d'une publication : permet à un.e utilisateur.trice de
  supprimer une publication qu'il/elle a créée.

De façon plus large, il y a aussi des pages liées à la gestion du compte
utilisateur qui sont importantes à avoir pour un réseau social, telles que :

- Page d'inscription : Permet à un.e nouvel.le utilisateur.trice de créer un
  compte.
- Page de connexion : Permet à un.e utilisateur.trice de se connecter à son
  compte.
- Page de déconnexion : Permet à un.e utilisateur.trice de se déconnecter de son
  compte.
- Page de réinitialisation du mot de passe : Permet à un.e utilisateur.trice de
  réinitialiser son mot de passe en cas d'oubli.
- Page de modification de profil : permet à un.e utilisateur.trice de modifier
  ses informations personnelles (mot de passe y compris).
- Page de suppression de compte : permet à un.e utilisateur.trice de supprimer
  son compte.

Une majorité de ces pages supplémentaires seront créées dans de futures séances.

**Structure des pages**

Le réseau social étant une application relativement simple, toutes les pages
devraient avoir une structure de base commune.

Cette structure comporte (entre autres) :

- Un en-tête (header) avec les balises HTML de base (doctype, html, head, body).
- Un menu de navigation permettant d'accéder aux différentes pages du site.
- Un contenu principal (main content) qui affiche les informations spécifiques à
  chaque page.
- Un pied de page (footer) avec des informations de copyright et éventuellement
  des liens vers d'autres ressources (politique de confidentialité, conditions
  d'utilisation, etc.).

**Composants réutilisables**

Pour aller plus loin, il est aussi possible d'identifier des composants
réutilisables qui pourraient être utilisés sur plusieurs pages de l'application.
Par exemple :

- Un layout commun qui définit la structure de base de toutes les pages
  (en-tête, menu de navigation, pied de page).
- Un composant de publication qui affiche les informations d'une publication
  (auteur, contenu, date de création, etc.) et qui peut être utilisé sur la page
  d'accueil, la page de profil, la page de détails d'une publication, etc.
- Un composant de formulaire de publication qui permet à un.e utilisateur.trice
  de créer ou de modifier une publication et qui peut être utilisé sur la page
  de création de publication et la page de modification de publication.

</details>

## Supprimer les vues et les routes de base créées par Laravel

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
`resources/views/welcome.blade.php`.

Modifiez ensuite le fichier `routes/web.php` pour supprimer la route de base qui
affiche la vue `welcome` :

```php
Route::get('/', function () {
    return view('welcome');
});
```

Une fois que vous avez supprimé la vue et la route de base, valider les
modifications dans Git, puis vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

## Mettre en place l'internationalisation (i18n)

L'internationalisation (i18n) est le processus de conception d'une application
de manière à ce qu'elle puisse être facilement adaptée à différentes langues et
régions sans nécessiter de modifications de code.

Laravel fournit un support intégré pour l'internationalisation, ce qui facilite
la création d'applications multilingues (source :
<https://laravel.com/docs/12.x/localization>).

Par défaut, Laravel est configuré pour utiliser la langue anglaise (en) comme
langue par défaut. Cependant, pour notre mini-projet de réseau social, nous
allons configurer l'application pour utiliser la langue française (fr) comme
langue par défaut.

Dans le contexte de ce cours, nous allons n'utiliser que la langue française.
Même si nous n'avons pas l'intention de supporter d'autres langues pour ce
projet, il est important de mettre en place l'internationalisation dès le début
du développement de l'application. Cela permet de faciliter l'ajout de nouvelles
langues à l'avenir si nécessaire et de ne pas devoir refactoriser une grande
partie du code pour ajouter le support de nouvelles langues, comme vous aviez dû
l'expérimenter en ProgServ2.

### Créer l'issue et la branche pour suivre cette tâche

Nouvelle tâche, nouvelle branche ! Commencez par créer l'issue sur GitHub pour
suivre cette tâche, puis créez la branche correspondante à partir de la branche
principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour mettre en place l'internationalisation dans votre application
Laravel.

### Installer une librairie externe pour les clés de traduction

Bien que Laravel fournisse un support intégré pour l'internationalisation, il ne
fournit pas de clés de traduction pour les différentes langues. Cela signifie
que vous devez créer vos propres fichiers de traduction et y ajouter les clés de
traduction pour les différentes langues que vous souhaitez supporter.

Heureusement, il existe des librairies externes qui fournissent des clés de
traduction pour différentes langues, ce qui facilite grandement la mise en place
de l'internationalisation dans votre application Laravel.

Cela sera l'occasion d'ajouter une librairie externe à notre projet Laravel en
utilisant Composer, le gestionnaire de dépendances de PHP.

Pour cela, nous allons utiliser la librairie
[`laravel-lang/lang`](https://laravel-lang.com/packages-lang.html) qui fournit
des clés de traduction pour différents aspects de Laravel pour plus de 80
langues différentes, y compris le français.

Pour installer cette librairie, vous pouvez utiliser la commande suivante dans
votre terminal à la racine de votre projet Laravel :

```bash
composer require laravel-lang/lang --dev
```

Le résultat de cette commande devrait être similaire à celui-ci :

```text
./composer.json has been updated
Running composer update laravel-lang/lang
Loading composer repositories with package information
Updating dependencies
Lock file operations: 14 installs, 0 updates, 0 removals
  - Locking archtechx/enums (v1.1.2)
  - Locking composer/semver (3.4.4)
  - Locking dragon-code/contracts (2.24.0)
  - Locking dragon-code/pretty-array (4.2.0)
  - Locking dragon-code/support (6.16.0)
  - Locking laravel-lang/config (1.16.0)
  - Locking laravel-lang/lang (15.28.3)
  - Locking laravel-lang/locale-list (1.7.0)
  - Locking laravel-lang/locales (2.10.0)
  - Locking laravel-lang/native-country-names (1.7.0)
  - Locking laravel-lang/native-currency-names (1.8.0)
  - Locking laravel-lang/native-locale-names (2.7.0)
  - Locking laravel-lang/publisher (16.7.1)
  - Locking symfony/polyfill-php81 (v1.33.0)
Writing lock file
Installing dependencies from lock file (including require-dev)
Package operations: 14 installs, 0 updates, 0 removals
  - Installing dragon-code/contracts (2.24.0): Extracting archive
  - Installing symfony/polyfill-php81 (v1.33.0): Extracting archive
  - Installing dragon-code/support (6.16.0): Extracting archive
  - Installing laravel-lang/native-locale-names (2.7.0): Extracting archive
  - Installing laravel-lang/native-currency-names (1.8.0): Extracting archive
  - Installing laravel-lang/native-country-names (1.7.0): Extracting archive
  - Installing archtechx/enums (v1.1.2): Extracting archive
  - Installing laravel-lang/locale-list (1.7.0): Extracting archive
  - Installing laravel-lang/config (1.16.0): Extracting archive
  - Installing laravel-lang/locales (2.10.0): Extracting archive
  - Installing dragon-code/pretty-array (4.2.0): Extracting archive
  - Installing composer/semver (3.4.4): Extracting archive
  - Installing laravel-lang/publisher (16.7.1): Extracting archive
  - Installing laravel-lang/lang (15.28.3): Extracting archive
3 package suggestions were added by new dependencies, use `composer suggest` to see details.

[...]

Using version ^15.28 for laravel-lang/lang
```

Ceci va installer la librairie `laravel-lang/lang` en tant que dépendance de
développement dans votre projet Laravel. L'option `--dev` indique que cette
dépendance est uniquement nécessaire pour le développement et ne sera pas
incluse dans l'environnement de production.

Les fichiers `composer.json` et `composer.lock` seront mis à jour pour refléter
cette nouvelle dépendance.

> [!TIP]
>
> **Optionnel** : la documentation officielle de la librairie
> `laravel-lang/lang` recommande d'ajouter un script dans le fichier
> `composer.json` pour faciliter la publication des fichiers de traduction. Vous
> pouvez ajouter le script suivant dans la section `scripts` de votre fichier
> `composer.json` :
>
> ```json
> {
> 	"scripts": {
> 		// Other scripts...
> 		"post-update-cmd": [
> 			"@php artisan vendor:publish --tag=laravel-assets --ansi --force",
> 			"@php artisan lang:update"
> 		]
> 		// Other scripts...
> 	}
> }
> ```
>
> Cela permettra de publier automatiquement les fichiers de traduction de la
> librairie `laravel-lang/lang` après chaque mise à jour des dépendances avec
> Composer.

Vous avez maintenant installé la librairie `laravel-lang/lang` dans votre projet
Laravel. Ceci met en avant la force de Composer pour gérer les dépendances dans
les projets PHP, et plus largement la force de l'écosystème PHP qui offre une
multitude de librairies pour faciliter le développement d'applications web.

### Ajouter les clés de traduction de base pour la langue française

Maintenant que la librairie `laravel-lang/lang` est installée, nous allons
pouvoir ajouter les clés de traduction pour la langue française dans notre
projet Laravel.

Pour cela, vous pouvez utiliser la commande suivante dans votre terminal à la
racine de votre projet Laravel :

```bash
php artisan lang:add fr
```

Le résultat de cette commande devrait être similaire à celui-ci :

```text

   INFO  Collecting translations...

  LaravelLang\Lang\Plugin ........................... 3.15ms DONE

   INFO  Storing changes...

  fr.json ........................................... 0.44ms DONE
  fr/auth.php ....................................... 0.69ms DONE
  fr/pagination.php ................................. 0.21ms DONE
  fr/passwords.php .................................. 0.44ms DONE
  fr/validation.php ................................. 1.22ms DONE
```

Cette commande va ajouter les clés de traduction pour la langue française dans
votre projet Laravel. Les fichiers de traduction seront ajoutés dans le
répertoire `lang`.

Ce dossier contiendra les fichiers de traduction pour la langue française, tels
que `fr.json`, `fr/auth.php`, `fr/pagination.php`, `fr/passwords.php`, et
`fr/validation.php`. Ces fichiers contiennent les clés de traduction pour les
différentes parties de Laravel, telles que l'authentification, la pagination,
les mots de passe, et la validation.

Ces clés de traduction offrent des traductions pour les messages d'erreur et les
autres textes de base utilisés par Laravel, ce qui facilite la création d'une
application multilingue.

Si vous ouvrez les fichiers de traduction `.php`, vous verrez que les clés de
traduction sont organisées en tableaux associatifs, où la clé est le texte
original en anglais et la valeur est la traduction en français.

### Ajouter des clés de traduction personnalisées pour la langue française

Afin d'éviter de mélanger les clés de traduction de base fournies par Laravel
avec les clés de traduction personnalisées que nous allons créer pour notre
application, nous allons créer un nouveau fichier de traduction pour la langue
française.

Pour cela, vous pouvez créer un nouveau fichier `fr/ui.php` dans le répertoire
`lang` de votre projet Laravel. Ce fichier contiendra les clés de traduction
personnalisées pour la langue française.

Voici un exemple de contenu pour le fichier `fr/ui.php` :

```php
<?php

declare(strict_types=1);

return [
    'home' => [
        'title' => 'Accueil',
        'description' => "Page d'accueil du réseau social.",
        'welcome_message' => 'Bienvenue sur :app_name !',
    ],
    'profile' => [
        'title' => 'Profil',
        'description' => 'Page de profil pour :username.',
        'number_of_posts' => '{0} Aucune publication|{1} :count publication|[2,*] :count publications',
    ],
    'about' => [
        'title' => 'À propos',
        'description' => 'Page à propos de notre réseau social.',
        'introduction' => 'Ce réseau social a été créé pour permettre aux utilisateur.trices de partager leurs pensées et leurs idées avec le monde entier.',
        'disclaimer' => "Ce réseau social est un projet réalisé dans le cadre d'un cours de la HEIG-VD, Suisse.",
    ],
];
```

Ce fichier de traduction contient des clés de traduction personnalisées pour les
différentes pages de notre application de réseau social, telles que la page
d'accueil, la page de profil, et la page à propos. Ces clés de traduction
peuvent être utilisées dans les vues de notre application pour afficher les
textes dans la langue française.

Nous reviendrons sur quelques-unes de ces clés de traduction personnalisées plus
tard dans ce mini-projet lorsque nous créerons les vues pour les différentes
pages de notre application.

N'hésitez pas à ajouter d'autres clés de traduction personnalisées pour la
langue française dans ce fichier `fr/ui.php` au fur et à mesure que vous
développez votre application de réseau social.

Il est tout à fait possible de créer de nouveaux fichiers pour d'autres aspects
de l'application, tels que les mails (`mail.php` par exemple). Les noms sont
arbitraires, mais il est recommandé de choisir des noms explicites pour
faciliter la maintenance du code à long terme.

### Configurer la langue par défaut et de la langue de secours

Maintenant que nous avons ajouté les clés de traduction pour la langue française
dans notre projet Laravel, nous allons configurer l'application pour utiliser la
langue française comme langue par défaut.

Pour cela, nous allons modifier le fichier de variables d'environnement
`.env.example` à la racine de votre projet Laravel. Ouvrez ce fichier et
recherchez les variables suivantes :

```text
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US
```

Modifiez ces variables pour qu'elles soient comme ceci :

```text
APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
APP_FAKER_LOCALE=fr_FR
```

- `APP_LOCALE` : cette variable définit la langue par défaut de l'application.
  En la mettant à `fr`, nous configurons l'application pour utiliser la langue
  française par défaut.
- `APP_FALLBACK_LOCALE` : cette variable définit la langue de secours à utiliser
  si une clé de traduction n'est pas trouvée dans la langue par défaut. En la
  mettant à `fr`, nous configurons l'application pour utiliser la langue
  française comme langue de secours également. Si une future langue et qu'elle
  n'incorporait pas toutes les clés de traduction, cela permettrait d'utiliser
  les traductions françaises pour les clés manquantes.
- `APP_FAKER_LOCALE` : cette variable définit la locale utilisée par la
  librairie Faker pour générer des données factices (fake data) dans les seeders
  et les factories. En la mettant à `fr_FR`, nous configurons Faker pour générer
  des données factices en français (noms, adresses, etc.). - Ceci n'est pas une
  fonctionnalité que nous allons utiliser dans ce mini-projet, mais c'est une
  bonne pratique de la configurer dès le début pour éviter d'avoir des données
  factices en anglais si nous décidons de les utiliser plus tard.

En modifiant le fichier `.env.example` pour configurer la langue par défaut et
la langue de secours, nous avons modifier les valeurs d'exemple pour ces
variables d'environnement. Cela permet à toute nouvelle personne qui clonerait
le projet de commencer avec la langue française configurée par défaut, sans
avoir à modifier manuellement les variables d'environnement.

Cependant, pour que ces modifications soient prises en compte par l'application
sur votre machine locale, vous devez également modifier le fichier `.env` qui
est utilisé par l'application.

Effectuez les mêmes modifications dans le fichier `.env` pour que les variables
d'environnement soient correctement configurées sur votre machine locale.

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

### Traduire en d'autres langues

Comme évoqué précédemment, nous n'allons pas supporter d'autres langues que le
français pour ce projet.

Mais si vous souhaitiez ajouter le support d'autres langues à votre application,
vous pourriez créer de nouveaux fichiers de traduction pour ces langues en
suivant la même structure que celle utilisée pour la langue française.

Une fois que vous avez créé les fichiers de traduction pour les différentes
langues, vous pouvez utiliser les mêmes clés de traduction dans vos vues pour
afficher les textes dans la langue sélectionnée par l'utilisateur.trice.

Il suffirait ensuite de créer un sélecteur de langue dans votre application pour
permettre à l'utilisateur.trice de choisir la langue qu'il/elle souhaite
utiliser, et de configurer l'application pour utiliser la langue sélectionnée.

Une librairie qui semble adaptée à cela est la suivante :
<https://github.com/akaunting/laravel-language>.

## Créer un layout commun

Blade permet de créer des layouts communs pour les différentes pages de votre
application. Cela permet de définir une structure de base pour votre site et de
réutiliser cette structure sur toutes les pages.

Dans cette section, nous allons créer un layout commun pour notre application de
réseau social. Ce layout contiendra les éléments suivants :

- Les balises HTML de base (doctype, html, head, body).
- Un en-tête avec le nom de l'application et un menu de navigation.
- Un pied de page avec des informations de copyright et éventuellement des liens
  vers d'autres ressources (politique de confidentialité, conditions
  d'utilisation, etc.).

### Créer l'issue et la branche pour suivre cette tâche

### Balises HTML de base

### En-tête et menu de navigation

Passer d'une page à l'autre dans une application web se fait généralement en
cliquant sur des liens de navigation. Ces liens sont généralement regroupés dans
un menu de navigation qui est présent sur toutes les pages de l'application.

### Pied de page

### Tester le layout commun avec une vue de test

Avant de créer les vues pour les différentes pages de notre application, nous
allons créer une vue de test pour vérifier que notre layout commun fonctionne
correctement.

#### Créer la vue de test

#### Créer la route pour la vue de test

#### Visualiser les résultats dans le navigateur

### Ajouter les styles CSS avec Tailwind CSS

### Visualiser les résultats dans le navigateur

#### Mode desktop

#### Mode mobile

#### Light mode et dark mode

### Pousser les modifications et fusionner la pull request

## Créer un composant de publication

### Créer l'issue et la branche pour suivre cette tâche

### Pousser les modifications et fusionner la pull request

## Créer des vues pour les différentes pages

### Page d'accueil (feed)

### Page de profil

### Page "à propos"

## Conclusion

TODO

## Solution

La solution du mini-projet est accessible dans un dépôt GitHub dédié à l'adresse
suivante : <TODO>.

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

- Permettre de changer la langue de l'interface utilisateur (i18n) en ajoutant
  un sélecteur de langue dans le menu de navigation.

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé les exercices et le mini-projet.

- Seriez-vous capable de ... ?

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
