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
  - [Créer le composant pour le layout commun](#créer-le-composant-pour-le-layout-commun)
  - [Balises HTML de base](#balises-html-de-base)
  - [Tester le layout commun avec une vue de test](#tester-le-layout-commun-avec-une-vue-de-test)
  - [Titre de la page](#titre-de-la-page)
  - [Nom de l'application](#nom-de-lapplication)
  - [En-tête et menu de navigation](#en-tête-et-menu-de-navigation)
  - [Pied de page](#pied-de-page)
  - [Ajouter les styles CSS avec Tailwind CSS](#ajouter-les-styles-css-avec-tailwind-css)
  - [Visualiser les résultats dans le navigateur](#visualiser-les-résultats-dans-le-navigateur-1)
  - [Ajouter une icône pour le profil](#ajouter-une-icône-pour-le-profil)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-1)
- [Créer des vues pour les différentes pages](#créer-des-vues-pour-les-différentes-pages)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-2)
  - [Page "à propos"](#page-à-propos)
  - [Page d'accueil (feed)](#page-daccueil-feed)
  - [Page de profil](#page-de-profil)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-2)
- [Créer un composant pour les posts](#créer-un-composant-pour-les-posts)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-3)
  - [Créer le composant pour les posts](#créer-le-composant-pour-les-posts)
  - [Définir la vue du composant pour les posts](#définir-la-vue-du-composant-pour-les-posts)
  - [Définir les données à passer au composant pour les posts](#définir-les-données-à-passer-au-composant-pour-les-posts)
  - [Passer les données au composant pour les posts](#passer-les-données-au-composant-pour-les-posts)
  - [Voir le résultat dans le navigateur](#voir-le-résultat-dans-le-navigateur)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-3)
- [Supprimer la page de test](#supprimer-la-page-de-test)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-4)
  - [Supprimer la vue pour la page de test](#supprimer-la-vue-pour-la-page-de-test)
  - [Supprimer la route pour la page de test](#supprimer-la-route-pour-la-page-de-test)
  - [Pousser les modifications et fusionner la pull request](#pousser-les-modifications-et-fusionner-la-pull-request-4)
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
cette nouvelle dépendance. La librairie `laravel-lang/lang` et ses dépendances
seront téléchargées et installées dans le répertoire `vendor` de votre projet
Laravel.

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
        'introduction' => 'Bienvenue sur :app_name !',
    ],
    'profile' => [
        'title' => 'Profil de :username',
        'description' => 'Page de profil pour :username.',
        'number_of_posts' => '{0} Aucune publication|{1} :count publication|[2,*] :count publications',
    ],
    'about' => [
        'title' => 'À propos',
        'description' => 'Page à propos de notre réseau social.',
        'introduction' => 'Ce réseau social a été créé pour permettre aux utilisateur.trices de partager leurs pensées et leurs idées avec le monde entier.',
        'disclaimer' => "Ce réseau social est un projet réalisé dans le cadre d'un cours de la HEIG-VD, Suisse.",
        'copyright' => '© :year Tous droits réservés.',
    ],
    'posts' => [
        'no_posts' => 'Aucun post à afficher.',
        'likes_count' => '{0} Aucun like|{1} :count like|[2,*] :count likes',
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

Comme pour les tâches précédentes, commencez par créer l'issue sur GitHub pour
suivre cette tâche, puis créez la branche correspondante à partir de la branche
principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour créer un layout commun pour votre application de réseau social en
utilisant Blade.

### Créer le composant pour le layout commun

Un layout commun peut être créé en utilisant un composant Blade (source :
<https://laravel.com/docs/12.x/blade#layouts-using-components>).

Les composants Blade permettent de créer des éléments réutilisables dans vos
vues, ce qui est idéal pour créer un layout commun pour votre application.

Pour créer un composant pour le layout commun, vous pouvez utiliser la commande
suivante dans votre terminal à la racine de votre projet Laravel :

```bash
php artisan make:component DefaultLayout
```

Le résultat de cette commande devrait être similaire à celui-ci :

```text
   INFO  Component [app/View/Components/DefaultLayout.php] created successfully.

   INFO  View [resources/views/components/default-layout.blade.php] created successfully.
```

Cette commande va créer un nouveau composant Blade appelé `DefaultLayout`. Le
fichier du composant sera créé dans le répertoire `app/View/Components` et la
vue associée au composant sera créée dans le répertoire
`resources/views/components`.

Le premier fichier `DefaultLayout.php` contient la classe du composant. Cela
permet à Laravel de trouver la classe du composant lorsque nous l'utilisons dans
nos vues, et de lui passer des données si nécessaire.

Le second fichier `default-layout.blade.php` contient la vue du composant. C'est
dans ce fichier que nous pouvons définir la structure HTML du composant (ici, le
layout commun pour notre application de réseau social).

Nous n'aurons pas à modifier la classe du composant pour le moment, mais nous
allons modifier la vue du composant pour y ajouter la structure de base de notre
layout commun.

### Balises HTML de base

Le layout commun doit contenir les balises HTML de base, telles que le doctype,
les balises `html`, `head`, et `body`. Ces balises définissent la structure de
base de toutes les pages de notre application.

Remplacez le contenu du fichier
`resources/views/components/default-layout.blade.php` par le code suivant pour
ajouter les balises HTML de base à notre layout commun :

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        @isset($description)
        <meta name="description" content="{{ $description }}" />
        @endisset
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @isset($title)
        <title>{{ $title }} - {{ config('app.name') }}</title>
        @else
        <title>{{ config('app.name') }}</title>
        @endisset

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <main>{{ $slot }}</main>
    </body>
</html>
```

Ce code définit les balises HTML de base pour notre layout commun.

La directive Blade `{{ }}` est utilisée pour afficher des données dynamiques
dans les vues. Dans ce cas, nous utilisons
`{{ str_replace('_', '-', app()->getLocale()) }}` pour définir la langue de la
page en fonction de la locale configurée dans l'application.

La fonction `app()->getLocale()` est utilisée pour définir la langue de la page
en fonction de la langue actuellement configurée dans l'application, en
utilisant la locale définie dans les variables d'environnement que nous avons
configurées précédemment.

La directive Blade `@isset` est utilisée pour vérifier si les variables
`$description` et `$title` sont définies avant de les utiliser dans les balises
`meta` et `title`.

Si la variable `$description` est définie, elle sera utilisée pour remplir la
balise `meta` de description de la page. Si elle n'est pas définie, la balise
`meta` de description ne sera pas incluse dans le code HTML de la page.

Si la variable `$title` est définie, elle sera utilisée pour remplir la balise
`title` de la page, en affichant le titre personnalisé suivi du nom de
l'application. Si la variable `$title` n'est pas définie, la balise `title`
affichera simplement le nom de l'application.

La fonction `config('app.name')` est utilisée pour récupérer le nom de
l'application à partir du fichier de variables d'environnement et/ou du fichier
de configuration `config/app.php`, ce qui permet d'afficher le nom de
l'application dans le titre de la page de manière dynamique. Cela permet de
centraliser la configuration du nom de l'application et de faciliter sa
modification à long terme sans avoir à modifier manuellement le code dans les
vues.

Le layout inclut les liens vers les fichiers CSS et JavaScript générés par Vite,
ce qui nous permet d'intégrer Tailwind CSS et d'ajouter des fonctionnalités
JavaScript à notre application si besoin.

Enfin, la variable `$slot` est utilisée pour afficher le contenu spécifique à
chaque page qui utilisera ce layout commun. Le contenu de chaque page sera passé
au composant et affiché à l'endroit où la variable `$slot` est utilisée dans la
vue du composant.

### Tester le layout commun avec une vue de test

Avant de créer les vues pour les différentes pages de notre application, nous
allons créer une vue de test pour vérifier que notre layout commun fonctionne
correctement.

#### Créer la vue de test

Afin de créer une vue de test, nous pouvons utiliser la commande suivante dans
votre terminal à la racine de votre projet Laravel (source :
<https://laravel.com/docs/12.x/views#creating-and-rendering-views>) :

```bash
php artisan make:view test
```

Le résultat de cette commande devrait être similaire à celui-ci :

```text
   INFO  View [resources/views/test.blade.php] created successfully.
```

Cette commande va créer un nouveau fichier de vue appelé `test.blade.php` dans
le répertoire `resources/views`. Ce fichier de vue contiendra le code HTML de
notre vue de test.

Ouvrez le fichier `resources/views/test.blade.php` et ajoutez le code suivant
pour utiliser notre layout commun et afficher un message de test :

```php
<x-default-layout>
    <h1>Ceci est une vue de test</h1>

    <p>
        Si vous voyez ce message, cela signifie que le layout commun fonctionne
        correctement !
    </p>
</x-default-layout>
```

Vous noterez l'utilisation du composant `x-default-layout` pour utiliser notre
layout commun dans cette vue de test. Le contenu entre les balises d'ouverture
et de fermeture du composant sera passé au composant et affiché à l'endroit où
le composant utilise la variable `$slot`. Cela permet de réutiliser le layout
commun pour différentes vues en passant simplement le contenu spécifique à
chaque vue dans le slot du composant.

#### Créer la route pour la vue de test

Maintenant que nous avons créé la vue de test, nous allons créer une route pour
cette vue afin de pouvoir la visualiser dans le navigateur.

A nouveau, nous reviendrons plus en détail sur les routes dans une future
séance, mais pour l'instant, nous allons créer une route de base pour notre vue
de test.

Ouvrez le fichier `routes/web.php` et ajoutez la route suivante pour la vue de
test :

```php
Route::get('/test-view', function () {
    return view('test');
});
```

Cette route va permettre d'accéder à la vue de test en visitant l'URL
<http://localhost:8000/test-view> dans le navigateur. Lorsque vous visiterez
cette URL, la vue de test sera rendue en utilisant notre layout commun, et vous
devriez voir le message de test s'afficher correctement.

#### Visualiser les résultats dans le navigateur

Maintenant que nous avons créé la vue de test et la route correspondante, nous
pouvons visualiser les résultats dans le navigateur pour vérifier que notre
layout commun fonctionne correctement.

Pour cela, assurez-vous que votre serveur de développement Laravel est en cours
d'exécution (en utilisant la commande `composer run dev`), puis ouvrez votre
navigateur et visitez l'URL <http://localhost:8000/test-view>.

La vue de test devrait s'afficher correctement, avec le message de test et la
structure définie dans notre layout commun.

Si vous inspectez le code source de la page dans le navigateur à l'aide des
outils de développement de votre navigateur, vous devriez voir que les balises
HTML de base sont présentes, ainsi que les liens vers les fichiers CSS et
JavaScript générés par Vite.

### Titre de la page

Vous remarquerez que le titre de la page dans l'onglet du navigateur affiche le
nom de l'application _"Laravel"_, ce qui est le comportement par défaut défini
dans notre layout commun. Si vous souhaitez afficher un titre de page
personnalisé pour la vue de test, il est possible de spécifier un titre
personnalisé en passant par un slot nommé `title`.

En effet, lors de la création du layout commun, nous avons ajouté une logique
conditionnelle pour afficher un titre de page personnalisé si la variable
`$title` est définie. Pour définir cette variable `$title` dans notre vue de
test, nous pouvons utiliser un slot nommé `title` lors de l'utilisation du
composant `x-default-layout`.

Voici comment vous pouvez modifier la vue de test pour spécifier un titre de
page personnalisé (source :
<https://laravel.com/docs/12.x/blade#applying-the-layout-component>) :

```php
<x-default-layout>
    <x-slot:title>
        Vue de test
    </x-slot>

    <h1>Ceci est une vue de test</h1>

    <p>
        Si vous voyez ce message, cela signifie que le layout commun fonctionne
        correctement !
    </p>
</x-default-layout>
```

Sauvez les modifications et actualisez la page dans le navigateur. Vous devriez
maintenant voir que le titre de la page dans l'onglet du navigateur affiche "Vue
de test - Laravel" au lieu de simplement "Laravel". Cela montre que le titre de
la page est maintenant personnalisé pour cette vue de test, tout en utilisant le
layout commun que nous avons créé.

Ceci sera utile pour afficher des titres de page personnalisés pour les
différentes pages de notre application de réseau social, tout en réutilisant le
même layout commun.

De la même manière, nous pourrions également utiliser un slot nommé
`description` pour afficher une description personnalisée de la page dans les
balises meta, ce qui peut être utile pour le référencement (SEO) de notre
application.

### Nom de l'application

Profitons de cette occasion pour modifier le nom de l'application qui s'affiche
dans le titre de la page et dans le reste de l'application.

Ouvrez le fichier `.env.example` et modifiez la variable `APP_NAME` pour lui
donner un nom plus approprié pour notre projet de réseau social.

Vous êtes libre de donner le nom que vous souhaitez à votre application, mais
voici un exemple de nom que vous pourriez utiliser pour votre réseau social pour
les plus nostalgiques d'entre nous :

```text
APP_NAME="My Social Network (MSN)"
```

N'oubliez pas de faire la même modification dans le fichier `.env` pour que le
nom de l'application soit correctement configuré sur votre machine locale.

### En-tête et menu de navigation

Passer d'une page à l'autre dans une application web se fait généralement en
cliquant sur des liens de navigation. Ces liens sont généralement regroupés dans
un menu de navigation qui est présent sur toutes les pages de l'application.

Dans notre layout commun, nous allons ajouter un en-tête qui contient le nom de
l'application et un menu de navigation avec des liens vers les différentes pages
de notre application de réseau social :

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        @isset($description)
        <meta name="description" content="{{ $description }}" />
        @endisset
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @isset($title)
        <title>{{ $title }} - {{ config('app.name') }}</title>
        @else
        <title>{{ config('app.name') }}</title>
        @endisset

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <header>
            <nav>
                <div>
                    <a href="{{ url('/') }}"> {{ config('app.name') }} </a>
                    <a href="{{ url('/profile') }}"> {{ __('ui.profile.title') }} </a>
                </div>
            </nav>
        </header>

        <main>{{ $slot }}</main>
    </body>
</html>
```

Sauvez les modifications et actualisez la page dans le navigateur. Vous devriez
maintenant voir un en-tête avec le nom de l'application et un menu de navigation
avec des liens vers la page d'accueil et la page de profil.

L'utilisation de la fonction `url()` permet de générer les URL des liens de
navigation, ce qui permet de créer des liens dynamiques qui s'adaptent à la
configuration de l'application. Les liens auront automatiquement le préfixe de
base de l'application (par exemple, `http://localhost:8000`) suivi du chemin
spécifié (par exemple, `/profile`).

L'utilisation de la fonction `__()` permet d'afficher les textes des liens de
navigation en utilisant les clés de traduction que nous avons définies
précédemment dans le fichier `fr/ui.php`. Cela permet d'afficher les textes dans
la langue configurée pour l'application, ce qui est essentiel pour une
application multilingue. Dans le futur, lorsque vous ajouterez le support
d'autres langues, les textes des liens de navigation seront automatiquement
affichés dans la langue sélectionnée par l'utilisateur.trice grâce à
l'utilisation de ces clés de traduction.

### Pied de page

L'entête et le menu de navigation sont des éléments importants pour permettre
aux utilisateur.trices de naviguer facilement dans votre application, mais un
pied de page peut également être utile pour afficher des informations
supplémentaires, telles que des informations de copyright, des liens vers
d'autres ressources (politique de confidentialité, conditions d'utilisation,
etc.), ou tout autre contenu que vous souhaitez afficher en bas de chaque page.

Ajoutons le pied de page suivant à notre layout commun pour afficher des
informations de copyright et un lien vers la licence du projet :

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        @isset($description)
        <meta name="description" content="{{ $description }}" />
        @endisset
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @isset($title)
        <title>{{ $title }} - {{ config('app.name') }}</title>
        @else
        <title>{{ config('app.name') }}</title>
        @endisset

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <header>
            <nav>
                <div>
                    <a href="{{ url('/') }}"> {{ config('app.name') }} </a>
                    <a href="{{ url('/profile') }}"> {{ __('ui.profile.title') }} </a>
                </div>
            </nav>
        </header>

        <main>{{ $slot }}</main>

        <footer>
            <div>
                <div>
                    <p>{{ __('ui.about.copyright', ['year' => date('Y')]) }}</p>
                    <a href="{{ url('/about') }}"> {{ __('ui.about.title') }} </a>
                </div>
            </div>
        </footer>
    </body>
</html>
```

La structure de base du layout commun est maintenant en place, avec les balises
HTML de base, un en-tête avec le nom de l'application et un menu de navigation,
et un pied de page avec des informations de copyright et un lien vers la page à
propos.

Notez l'utilisation couplée des fonction `__()` et `date('Y')` pour afficher
l'année en cours dans le message de copyright, ce qui permet de garder cette
information à jour automatiquement sans avoir à modifier manuellement le code
chaque année.

En effet, la fonction d'internationalisation `__()` peut prendre des paramètres
pour remplacer des parties dynamiques du texte, ce qui est très utile pour
afficher des informations qui peuvent changer au fil du temps, comme l'année en
cours dans ce cas. Les clés de traduction dans le fichier `fr/ui.php` sont
définies de manière à permettre l'insertion de ces paramètres dynamiques, ce qui
rend le texte de copyright à la fois dynamique et traduit dans la langue
configurée pour l'application (la notation `:year` dans la clé de traduction
`© :year Tous droits réservés.` indique l'emplacement où le paramètre dynamique
doit être inséré).

### Ajouter les styles CSS avec Tailwind CSS

Notre structure actuelle est fonctionnelle et respecte la sémantique HTML5 mais
elle n'est pas très jolie. Nous allons ajouter des styles CSS pour améliorer
l'apparence de notre application de réseau social.

Grâce à l'intégration de Tailwind CSS offerte par défaut par Laravel, nous
pouvons facilement ajouter des classes CSS de Tailwind à notre layout commun
pour styliser les différents éléments de notre application.

Nous n'allons pas rentrer dans les détails de l'utilisation de Tailwind CSS dans
ce mini-projet, mais vous pouvez consulter la documentation officielle de
Tailwind CSS pour en savoir plus sur les différentes classes disponibles et
comment les utiliser pour styliser votre application :
<https://tailwindcss.com/docs>.

Mettons à jour notre layout commun pour ajouter des classes CSS de Tailwind et
améliorer l'apparence de notre application de réseau social :

> [!NOTE]
>
> Je (Ludovic) ne me considère pas comme un expert en UI/UX, et je ne prétends
> pas que le design que je propose ici soit particulièrement réussi ou adapté à
> une application de réseau social.
>
> Comme le cœur du cours n'est pas l'UI/UX, j'ai généré la base de ce design à
> l'aide de GitHub Copilot, et je l'ai ensuite largement modifié pour l'adapter
> à notre projet.
>
> N'hésitez pas à le modifier davantage pour l'améliorer ou pour l'adapter à vos
> goûts personnels !

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        @isset($description)
        <meta name="description" content="{{ $description }}" />
        @endisset
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @isset($title)
        <title>{{ $title }} - {{ config('app.name') }}</title>
        @else
        <title>{{ config('app.name') }}</title>
        @endisset

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="flex min-h-screen flex-col bg-slate-50 dark:bg-slate-900">
        <header class="bg-teal-600 text-white dark:bg-slate-800">
            <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-16 flex items-center justify-between">
                    <a href="{{ url('/') }}" class="block hover:opacity-80 transition">
                        {{ config('app.name') }}
                    </a>
                    <a
                        href="{{ url('/profile') }}"
                        class="block hover:opacity-80 transition"
                    >
                        {{ __('ui.profile.title') }}
                    </a>
                </div>
            </nav>
        </header>

        <main
            class="container mx-auto px-4 py-8 sm:px-6 lg:px-8 flex-grow dark:text-white max-w-2xl"
        >
            {{ $slot }}
        </main>

        <footer class="bg-teal-600 text-white text-sm dark:bg-slate-800">
            <div class="container mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div
                    class="h-16 flex flex-col items-center justify-between gap-4 sm:flex-row"
                >
                    <p class="text-center sm:text-left">
                        {{ __('ui.about.copyright', ['year' => date('Y')]) }}
                    </p>
                    <a
                        href="{{ url('/about') }}"
                        class="block hover:opacity-80 transition"
                    >
                        {{ __('ui.about.title') }}
                    </a>
                </div>
            </div>
        </footer>
    </body>
</html>
```

Plutôt que d'écrire du code CSS à la main, nous avons utilisé les classes
utilitaires de Tailwind CSS pour styliser les différents éléments de notre
layout commun. Cela nous permet d'ajouter des styles rapidement et facilement
sans avoir à écrire du CSS personnalisé.

### Visualiser les résultats dans le navigateur

Sauvez les modifications et actualisez la page dans le navigateur. Vous devriez
maintenant voir une version stylisée de votre application de réseau social, avec
un en-tête coloré, un menu de navigation avec des liens stylisés, et un pied de
page avec des informations de copyright et un lien vers la page à propos.

#### Mode desktop

En ouvrant les outils de développement de votre navigateur et en simulant un
affichage sur un écran de bureau (desktop), vous devriez voir que le layout
s'adapte correctement à la taille de l'écran, avec une mise en page centrée et
des éléments bien espacés.

Ceci est possible grâce à l'utilisation des classes de Tailwind CSS qui offrent
des fonctionnalités de responsive design pour créer des mises en page
adaptatives qui fonctionnent bien sur différents types d'appareils, par exemple
:

- `container mx-auto` : cette classe crée un conteneur centré avec des marges
  automatiques sur les côtés, ce qui permet de centrer le contenu sur l'écran.
- `px-4 sm:px-6 lg:px-8` : cette classe ajoute des marges intérieures (padding)
  horizontales de 1rem (4 unités de Tailwind) sur les petits écrans, 1.5rem (6
  unités de Tailwind) sur les écrans moyens, et 2rem (8 unités de Tailwind) sur
  les grands écrans, ce qui permet d'ajuster l'espacement en fonction de la
  taille de l'écran.

#### Mode mobile

En simulant un affichage sur un écran de mobile, vous devriez voir que le layout
s'adapte également à la taille de l'écran, avec une mise en page plus compacte
et des éléments qui s'empilent verticalement pour s'adapter à la largeur réduite
de l'écran.

Ceci est possible grâce à l'utilisation des classes de Tailwind CSS qui offrent
des fonctionnalités de responsive design pour créer des mises en page
adaptatives qui fonctionnent bien sur différents types d'appareils, par exemple
:

- `flex flex-col sm:flex-row` : cette classe indique que les éléments à
  l'intérieur du conteneur doivent, par défaut, être disposés en colonne
  (verticalement à l'aide de la notation `flex-col`) sur les petits écrans, et
  en ligne (horizontalement à l'aide de la notation `sm:flex-row`) sur les
  écrans moyens et plus grands. Cela permet d'adapter la disposition des
  éléments en fonction de la taille de l'écran.

Les notions de breakpoints et de responsive design sont essentielles pour créer
des applications web modernes qui offrent une bonne expérience utilisateur sur
tous les types d'appareils, du mobile au desktop. La documentation de Tailwind
CSS offre une excellente ressource pour en apprendre davantage sur ces concepts
et comment les utiliser dans vos projets :
<https://tailwindcss.com/docs/responsive-design>.

#### Light mode et dark mode

En utilisant les fonctionnalités de votre système d'exploitation pour basculer
entre le mode clair (light mode) et le mode sombre (dark mode) (ou directement
avec les outils de développement de votre navigateur), vous devriez voir que les
couleurs de votre application s'adaptent en conséquence grâce à l'utilisation
des classes de Tailwind CSS pour le dark mode.

### Ajouter une icône pour le profil

Vous pouvez également ajouter une icône pour le lien vers la page de profil dans
le menu de navigation pour améliorer l'apparence de votre application.

Il existe de nombreuses bibliothèques d'icônes que vous pouvez utiliser pour
cela, telles que Font Awesome, Heroicons, ou encore les icônes Material Design
de Google.

Nous allons utiliser les icônes Lucide pour ajouter une icône de profil à notre
lien de navigation vers la page de profil. Vous pouvez consulter la
documentation des icônes Lucide pour en savoir plus sur les différentes icônes
disponibles et comment les utiliser : <https://lucide.dev/>.

Pour l'image de profil, nous allons utiliser l'icône suivante de la bibliothèque
Lucide : <https://lucide.dev/icons/circle-user-round>.

Vous pouvez personnaliser l'apparence de l'icône à l'aide du menu de
personnalisation disponible sur le site des icônes Lucide de la manière suivante
:

- Color : `#ffffffff` (blanc).
- Stroke width : `1.25px` (épaisseur du trait).
- Size : `24` (taille par défaut).

Une fois que vous avez personnalisé l'icône selon vos préférences, copiez ou
téléchargez le code SVG généré pour l'icône personnalisée, puis ajoutez ce code
SVG dans le dossier `public/icons/profile.svg` de votre projet Laravel pour
pouvoir l'utiliser dans votre application.

Pour rappel, le dossier `public` est le dossier racine pour les ressources
statiques de votre application Laravel, ce qui signifie que les fichiers placés
dans ce dossier sont accessibles directement via une URL. En plaçant l'icône SVG
dans le dossier `public/icons`, vous pouvez y accéder via l'URL
`/icons/profile.svg` dans votre application.

Ensuite, vous pouvez modifier le lien vers la page de profil dans le menu de
navigation pour inclure l'icône SVG que vous venez d'ajouter. Voici comment vous
pouvez faire cela dans votre layout commun :

```php
<a href="{{ url('/profile') }}" class="block hover:opacity-80 transition">
    <img
        src="/icons/profile.svg"
        alt="{{ __('ui.profile.title') }}"
        class="h-8 w-8 rounded-full"
    />
</a>
```

Notez l'utilisation de la source `/icons/profile.svg` pour l'attribut `src` de
l'élément `img`, ce qui permet de charger l'icône SVG que vous avez ajoutée dans
le dossier `public/icons`. Vous pouvez également ajouter des classes CSS de
Tailwind pour styliser l'icône, par exemple en lui donnant une taille de
`h-8 w-8` et en la rendant ronde avec la classe `rounded-full`.

Sauvez les modifications et actualisez la page dans le navigateur. Vous devriez
maintenant voir l'icône de profil à côté du lien vers la page de profil dans le
menu de navigation, ce qui améliore l'apparence de votre application de réseau
social.

Vous avez maintenant un layout commun fonctionnel et stylisé pour votre
application de réseau social, avec un en-tête, un menu de navigation, et un pied
de page. Vous pouvez réutiliser ce layout commun pour les différentes pages de
votre application en utilisant le composant `x-default-layout` et en passant le
contenu spécifique à chaque page dans le slot du composant.

De plus, vous avez appris à utiliser des ressources statiques à l'aide du
dossier publique dans Laravel en ajoutant une icône SVG personnalisée pour le
lien vers la page de profil, ce qui vous permet d'améliorer l'apparence de votre
application de réseau social.

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Créer des vues pour les différentes pages

Maintenant que nous avons créé un layout commun pour notre application de réseau
social, nous allons créer des vues pour les différentes pages de notre
application en utilisant ce layout commun. Nous allons créer des vues pour les
pages suivantes :

- Page "à propos" : cette page contiendra des informations sur l'application,
  telles que le nom de l'application, une description, etc.
- Page d'accueil (feed) : cette page affichera les publications des
  utilisateur.trices de l'application.
- Page de profil : cette page affichera les informations du profil de
  l'utilisateur.trice connecté.e, ainsi que ses publications.

Les autres pages de l'application (page de connexion, page d'inscription, etc.)
seront créées plus tard dans le cours, lorsque nous aborderons les
fonctionnalités d'authentification et de gestion des utilisateurs.

### Créer l'issue et la branche pour suivre cette tâche

Nous pourrions créer une issue et une branche pour chaque page que nous allons
créer, ou nous pourrions créer une seule issue et une seule branche pour toutes
les pages. C'est à vous de décider comment vous souhaitez organiser votre
travail.

Dans tous les cas, commencez par créer l'issue sur GitHub pour suivre cette
tâche, puis créez la branche correspondante à partir de la branche principale
`main`.

### Page "à propos"

Cette section est consacrée à la création de la page "à propos" de notre
application de réseau social.

#### Créer la vue pour la page "à propos"

A la racine de votre projet Laravel, créez un nouveau fichier de vue à l'aide de
la commande suivante dans votre terminal :

```bash
php artisan make:view about
```

Le résultat de cette commande devrait être similaire à celui-ci :

```text
   INFO  View [resources/views/homepage.blade.php] created successfully.
```

Cette commande va créer un nouveau fichier de vue appelé `about.blade.php` dans
le répertoire `resources/views`. Ce fichier de vue contiendra le code HTML de la
page "à propos" de notre application de réseau social.

#### Créer la route pour la page "à propos"

Ouvrez le fichier `routes/web.php` et ajoutez la route suivante pour la page "à
propos" :

```php
Route::get('/about', function () {
    return view('about');
});
```

Cette route va permettre d'accéder à la page "à propos" en visitant l'URL
<http://localhost:8000/about> dans le navigateur.

La fonction `view('about')` est utilisée pour rendre la vue `about.blade.php`
que nous avons créée précédemment, ce qui permet d'afficher le contenu de la
page "à propos" en utilisant le layout commun que nous avons défini.

Lorsque vous visiterez cette URL, la page "à propos" sera rendue en utilisant
notre layout commun, et vous devriez voir les informations sur l'application
s'afficher correctement.

#### Ajouter le contenu à la page "à propos"

Ouvrez le fichier `resources/views/about.blade.php` et ajoutez le code suivant
pour utiliser notre layout commun et afficher des informations sur l'application
:

```php
<x-default-layout>
    <x-slot:title>
        {{ __('ui.about.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.about.description') }}
    </x-slot>

    <h1 class="text-2xl font-bold">
    {{ __('ui.about.title') }}
    </h1>

    <p class="mt-4">
        {{ __('ui.about.introduction') }}
    </p>

    <p class="mt-4">
        {{ __('ui.about.disclaimer') }}
    </p>
</x-default-layout>
```

Cette page utilise notre layout commun `x-default-layout` et remplit les slots
`title` et `description` pour afficher un titre de page personnalisé et une
description de la page dans les balises meta.

Le contenu de la page "à propos" est structuré avec un titre principal et deux
paragraphes d'introduction et de disclaimer, avec des classes CSS de Tailwind
pour styliser le texte.

Le tout est également traduit en utilisant les clés de traduction définies dans
le fichier `fr/ui.php`, ce qui permet d'afficher le contenu dans la langue
configurée pour l'application.

#### Visualiser la page "à propos" dans le navigateur

Sauvez les modifications et actualisez la page dans le navigateur en visitant
l'URL <http://localhost:8000/about>. Vous devriez maintenant voir la page "à
propos" de votre application de réseau social, avec le titre de la page, la
description dans les balises meta, et le contenu de la page affiché correctement
en utilisant le layout commun que nous avons créé.

### Page d'accueil (feed)

Cette section est consacrée à la création de la page d'accueil (feed) de notre
application de réseau social.

#### Créer la vue pour la page d'accueil

A la racine de votre projet Laravel, créez un nouveau fichier de vue à l'aide de
la commande suivante dans votre terminal :

```bash
php artisan make:view home
```

Le résultat de cette commande devrait être similaire à celui-ci :

```text
   INFO  View [resources/views/home.blade.php] created successfully.
```

Cette commande va créer un nouveau fichier de vue appelé `home.blade.php` dans
le répertoire `resources/views`. Ce fichier de vue contiendra le code HTML de la
page d'accueil de notre application de réseau social.

#### Créer la route pour la page d'accueil

Ouvrez le fichier `routes/web.php` et ajoutez la route suivante pour la page
d'accueil :

```php
Route::get('/', function () {
    $posts = Post::orderBy('created_at', 'desc')->with('user')->with('likes')->get();

    return view('home', ['posts' => $posts]);
});
```

Cette route va permettre d'accéder à la page d'accueil en visitant l'URL
<http://localhost:8000> dans le navigateur.

Avant de rendre la vue `home.blade.php`, nous récupérons les posts des
utilisateur.trices de l'application depuis la base de données en utilisant le
modèle `Post`.

Nous ordonnons les posts par date de création décroissante (du plus récent au
plus ancien) à l'aide de la méthode `orderBy()`, et nous incluons les relations
`user` et `likes` à l'aide des méthodes `with()`, ce qui nous permettra
d'afficher les informations sur l'auteur du post et le nombre de likes pour
chaque post dans la vue.

La fonction `with()` permet de charger les relations associées aux posts de
manière efficace.

La fonction `get()` est utilisée pour exécuter la requête et récupérer les posts
depuis la base de données, ce qui nous donne une collection de posts que nous
pouvons ensuite passer à la vue.

La fonction `view('home', ['posts' => $posts])` est utilisée pour rendre la vue
`home.blade.php` que nous avons créée précédemment, en passant les posts
récupérés depuis la base de données. Cela permet d'afficher le contenu de la
page d'accueil en utilisant le layout commun que nous avons défini, et
d'afficher les posts des utilisateur.trices de l'application.

Lorsque vous visiterez cette URL, la page d'accueil sera rendue en utilisant
notre layout commun, et vous devriez voir les informations sur l'application
s'afficher correctement.

#### Ajouter le contenu à la page d'accueil

Ouvrez le fichier `resources/views/home.blade.php` et ajoutez le code suivant
pour utiliser notre layout commun et afficher des informations sur l'application
:

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

    <div class="mt-8 space-y-6">
        @foreach ($posts as $post)
            <article>
                <h3>{{ $post->user->first_name }} {{ $post->user->last_name }} ({{ $post->created_at }})</h3>

                @if ($post->title)
                    <h2>{{ $post->title }}</h2>
                @endif

                <p>{{ $post->content }}</p>

                <p>{{ trans_choice('ui.posts.likes_count', count($post->likes)) }}</p>
            </article>
        @endforeach
    </div>
</x-default-layout>
```

Cette page utilise notre layout commun `x-default-layout` et remplit les slots
`title` et `description` pour afficher un titre de page personnalisé et une
description de la page dans les balises meta.

Le contenu de la page d'accueil est structuré avec un titre principal et un
paragraphe d'introduction, avec des classes CSS de Tailwind pour styliser le
texte.

Nous affichons ensuite les posts récupérés depuis la base de données en
utilisant la directive Blade `@foreach` pour itérer sur la collection de posts
et afficher chaque post. Dans la structure de chaque post, nous affichons le nom
de l'auteur du post, la date de création du post, le titre du post (s'il existe
à l'aide de la directive `@if`), le contenu du post, et le nombre de likes pour
chaque post.

La méthode `trans_choice()` est utilisée pour afficher le nombre de likes en
utilisant les clés de traduction définies dans le fichier `fr/ui.php`, ce qui
permet d'afficher le texte correctement en fonction du nombre de likes (par
exemple, "0 like", "1 like", "2 likes", etc.) et dans la langue configurée pour
l'application.

Nous pouvons accéder aux différentes informations sur chaque post grâce aux
modèles Eloquent et aux relations que nous avons définies entre les modèles
`Post`, `User`, et `Like`. Par exemple, nous pouvons accéder au nom de l'auteur
du post en utilisant la relation `user` définie dans le modèle `Post`, et nous
pouvons accéder au nombre de likes pour chaque post en utilisant la relation
`likes`.

#### Visualiser la page d'accueil dans le navigateur

Sauvez les modifications et actualisez la page dans le navigateur en visitant
l'URL <http://localhost:8000>. Vous devriez maintenant voir la page d'accueil de
votre application de réseau social, avec le titre de la page, la description
dans les balises meta, et le contenu de la page affiché correctement en
utilisant le layout commun que nous avons créé.

### Page de profil

Cette section est consacrée à la création de la page de profil de notre
application de réseau social.

#### Créer la vue pour la page de profil

A la racine de votre projet Laravel, créez un nouveau fichier de vue à l'aide de
la commande suivante dans votre terminal :

```bash
php artisan make:view profile
```

Le résultat de cette commande devrait être similaire à celui-ci :

```text
   INFO  View [resources/views/profile.blade.php] created successfully.
```

Cette commande va créer un nouveau fichier de vue appelé `profile.blade.php`
dans le répertoire `resources/views`. Ce fichier de vue contiendra le code HTML
de la page de profil de notre application de réseau social.

#### Créer la route pour la page de profil

Ouvrez le fichier `routes/web.php` et ajoutez la route suivante pour la page de
profil :

```php
Route::get('/profile', function () {
    $user   = User::where('username', 'janedoe')->first();

    $posts = Post::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->with(['user', 'likes'])
        ->get();

    return view('profile', ['user' => $user, 'posts' => $posts]);
});
```

Cette route va permettre d'accéder à la page de profil en visitant l'URL
<http://localhost:8000/profile> dans le navigateur.

Avant de rendre la vue `profile.blade.php`, nous récupérons l'utilisateur.trice
dont le nom d'utilisateur est `janedoe` depuis la base de données en utilisant
le modèle `User`. La méthode `where()` est utilisée pour filtrer les
utilisateurs.trices par nom d'utilisateur.trice. Comme cette requête pourrait
retourner plusieurs résultat, la méthode `first()` est utilisée pour récupérer
le premier résultat de la requête, ce qui nous donne l'utilisateur.trice
correspondant.e à ce nom d'utilisateur.

Nous récupérons ensuite les posts de cet utilisateur.trice depuis la base de
données en utilisant le modèle `Post`, en filtrant les posts par l'ID de
l'utilisateur.trice, en les ordonnant par date de création décroissante, et en
incluant les relations `user` et `likes` pour pouvoir afficher les informations
sur l'auteur du post et le nombre de likes pour chaque post dans la vue.

La fonction `view('profile', ['posts' => $posts, 'user' => $user])` est utilisée
pour rendre la vue `profile.blade.php` que nous avons créée précédemment, en
passant les posts récupérés depuis la base de données et l'utilisateur.trice
concerné.e. Cela permet d'afficher le contenu de la page de profil en utilisant
le layout commun que nous avons défini, et d'afficher les posts des
utilisateur.trices de l'application.

Lorsque vous visiterez cette URL, la page de profil sera rendue en utilisant
notre layout commun, et vous devriez voir les informations sur
l'utilisateur.trice et ses posts s'afficher correctement.

#### Ajouter le contenu à la page de profil

Ouvrez le fichier `resources/views/profile.blade.php` et ajoutez le code suivant
pour utiliser notre layout commun et afficher des informations sur l'application
:

```php
<x-default-layout>
    <x-slot:title>
        {{ __('ui.profile.title', ['username' => $user->username]) }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.profile.description', ['username' => $user->username]) }}
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">
        {{ __('ui.profile.title', ['username' => $user->username]) }}
    </h1>

    <p class="mt-4 dark:text-gray-300">
        {{ trans_choice('ui.profile.number_of_posts', count($posts)) }}
    </p>

    <div class="mt-8 space-y-6">
        @foreach ($posts as $post)
            <article>
                <h3>{{ $post->user->first_name }} {{ $post->user->last_name }} ({{ $post->created_at }})</h3>

                @if ($post->title)
                    <h2>{{ $post->title }}</h2>
                @endif

                <p>{{ $post->content }}</p>

                <p>{{ trans_choice('ui.posts.likes_count', count($post->likes)) }}</p>
            </article>
        @endforeach
    </div>
</x-default-layout>
```

Cette page utilise notre layout commun `x-default-layout` et remplit les slots
`title` et `description` pour afficher un titre de page personnalisé et une
description de la page dans les balises meta.

Le contenu de la page de profil est structuré avec un titre principal et un
paragraphe d'introduction, avec des classes CSS de Tailwind pour styliser le
texte.

Nous affichons ensuite les posts récupérés depuis la base de données en
utilisant la directive Blade `@foreach` pour itérer sur la collection de posts
et afficher chaque post.

Le tout est également traduit en utilisant les clés de traduction définies dans
le fichier `fr/ui.php`, ce qui permet d'afficher le contenu dans la langue
configurée pour l'application, même pour les textes dynamiques qui incluent des
paramètres (par exemple, le nombre de posts de l'utilisateur.trice).

#### Visualiser la page de profil dans le navigateur

Sauvez les modifications et actualisez la page dans le navigateur en visitant
l'URL <http://localhost:8000/profile>. Vous devriez maintenant voir la page de
profil de votre application de réseau social, avec le titre de la page, la
description dans les balises meta, et le contenu de la page affiché correctement
en utilisant le layout commun que nous avons créé.

Seuls les posts de l'utilisateur.trice dont le nom d'utilisateur est `janedoe`
sont affichés sur cette page de profil, ce qui permet de différencier les posts
affichés sur la page d'accueil (feed) et les posts affichés sur la page de
profil.

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Créer un composant pour les posts

Vous avez peut-être remarqué que le code pour afficher les posts dans la page
d'accueil et la page de profil est très similaire, ce qui signifie que nous
avons du code dupliqué dans ces deux vues. Pour éviter cette duplication de
code, nous pouvons créer un composant Blade pour afficher les posts, ce qui nous
permettra de réutiliser ce composant dans les différentes vues de notre
application.

### Créer l'issue et la branche pour suivre cette tâche

Comme pour les tâches précédentes, commencez par créer l'issue sur GitHub pour
suivre cette tâche, puis créez la branche correspondante à partir de la branche
principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour créer le composant pour les posts et l'utiliser dans les
différentes vues de votre application.

### Créer le composant pour les posts

Ouvrez votre terminal et utilisez la commande suivante pour créer un nouveau
composant Blade appelé `PostCard` :

```bash
php artisan make:component PostCard
```

Le résultat de cette commande devrait être similaire à celui-ci :

```text
   INFO  Component [app/View/Components/PostCard.php] created successfully.
   INFO  View [resources/views/components/post-card.blade.php] created successfully.
```

Cette commande va créer deux fichiers : `app/View/Components/PostCard.php`, qui
contient la classe du composant, et
`resources/views/components/post-card.blade.php`, qui contient le template Blade
du composant.

### Définir la vue du composant pour les posts

Les composants Blade sont composés de deux parties : la classe du composant, qui
contient la logique du composant, et le template Blade du composant, qui
contient le code HTML pour afficher le composant. Nous allons commencer par
définir le template Blade du composant pour les posts dans le fichier
`resources/views/components/post-card.blade.php` comme suit :

> [!NOTE]
>
> Je (Ludovic) ne me considère pas comme un expert en UI/UX, et je ne prétends
> pas que le design que je propose ici soit particulièrement réussi ou adapté à
> une application de réseau social.
>
> Comme le cœur du cours n'est pas l'UI/UX, j'ai généré la base de ce design à
> l'aide de GitHub Copilot, et je l'ai ensuite largement modifié pour l'adapter
> à notre projet.
>
> N'hésitez pas à le modifier davantage pour l'améliorer ou pour l'adapter à vos
> goûts personnels !

```php
<article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
    <header class="mb-4">
        <div class="flex items-center gap-3 mb-3">
            <div
                class="h-10 w-10 rounded-full bg-teal-600 dark:bg-purple-900 flex items-center justify-center text-white font-semibold">
                {{ strtoupper(substr($post->user->first_name, 0, 1) . substr($post->user->last_name, 0, 1)) }}
            </div>
            <div>
                <p class="font-semibold text-gray-900 dark:text-white">
                    {{ $post->user->first_name }} {{ $post->user->last_name }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400" title="{{ $post->created_at->isoFormat('LLLL') }}">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        @if ($post->title)
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                {{ $post->title }}
            </h2>
        @endif
    </header>

    <div class="mb-4">
        <p class="text-gray-700 dark:text-gray-300">
            {{ $post->content }}
        </p>
    </div>

    <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">
                {{ trans_choice('ui.posts.likes_count', count($post->likes)) }}
            </span>
        </div>
    </footer>
</article>
```

Plusieurs choses sont à noter :

- Nous utilisons les structures sémantiques HTML5 pour structurer le contenu du
  post, avec les balises `article`, `header`, `div`, et `footer`.
- Nous utilisons des classes CSS de Tailwind pour styliser le composant, en lui
  donnant une apparence de carte avec un fond blanc, des coins arrondis, une
  ombre, et un espacement intérieur (padding). Nous utilisons également des
  classes pour styliser le texte et les couleurs en fonction du mode clair ou
  sombre.
- Nous affichons les informations sur l'auteur du post, la date de création du
  post, le titre du post (s'il existe), le contenu du post, et le nombre de
  likes pour chaque post en utilisant les données passées au composant.
- Les directives Blade sont utilisées pour afficher conditionnellement le titre
  du post et pour afficher le nombre de likes en utilisant les clés de
  traduction définies dans le fichier `fr/ui.php`.
- Nous utilisons la méthode `diffForHumans()` pour afficher la date de création
  du post de manière relative (par exemple, "il y a 2 heures", "il y a 3 jours",
  etc.), ce qui offre une meilleure expérience utilisateur. Cette méthode est
  disponible grâce à la bibliothèque Carbon utilisée par Laravel pour gérer les
  dates. Plus d'informations sur la gestion des dates avec Carbon dans Laravel
  sont disponibles dans la documentation officielle de Laravel :
  <https://laravel.com/docs/10.x/helpers#dates>.

### Définir les données à passer au composant pour les posts

Maintenant que nous avons défini le template Blade du composant pour les posts,
nous devons passer les données nécessaires au composant pour qu'il puisse
afficher les informations sur chaque post.

Nous avions vu avec le layout commun que nous pouvions passer des données à un
composant Blade en utilisant des slots ou en passant des variables directement
au composant. Dans ce cas, nous allons passer les données du post directement au
composant en utilisant des variables.

Pour cela, nous allons modifier le fichier `app/View/Components/PostCard.php`
pour définir les propriétés du composant et le constructeur qui permettra de
passer les données du post au composant. Voici comment vous pouvez faire cela :

```php
<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Post $post,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-card');
    }
}
```

Nous avons défini une propriété publique `$post` dans la classe du composant,
qui est de type `Post`. Le constructeur du composant prend un argument `$post`
et l'assigne à la propriété du composant, ce qui nous permet de passer les
données du post au composant lorsque nous l'utilisons dans nos vues.

Le simple fait de définir la propriété `$post` dans la classe du composant et de
l'initialiser dans le constructeur nous permet de passer les données du post au
composant de manière simple et efficace, ce qui nous permet d'afficher les
informations sur chaque post dans le template Blade du composant que nous avons
défini précédemment.

Vous pourriez appliquer la même approche pour passer d'autres données au layout
commun que nous avons créé précédemment, par exemple pour le titre de la page,
la description de la page, ou d'autres informations spécifiques à chaque page,
par exemple :

```php
<x-default-layout :title="__('ui.home.title')" :description="__('ui.home.description')">

// ...

</x-default-layout>
```

Cela vous permettrait de rendre votre layout commun encore plus simple à
utiliser et à personnaliser pour les différentes pages de votre application.

### Passer les données au composant pour les posts

Maintenant que nous avons défini la classe du composant pour les posts et que
nous avons défini le template Blade du composant, nous pouvons utiliser ce
composant dans nos vues pour afficher les posts de manière réutilisable.

Ouvrez le fichier `resources/views/home.blade.php` et remplacez le code qui
affiche les posts par l'utilisation du composant `x-post-card` que nous avons
créé, en passant les données du post au composant. Voici comment vous pouvez
faire cela :

```php
@foreach ($posts as $post)
    <x-post-card :post="$post" />
@endforeach
```

Nous utilisons la syntaxe `:post="$post"` pour passer la variable `$post` à la
propriété `$post` du composant `PostCard`, ce qui permet au composant d'accéder
aux données du post et de les afficher dans le template Blade du composant.

Faites de même pour le fichier `resources/views/profile.blade.php` en remplaçant
le code qui affiche les posts par l'utilisation du composant `x-post-card` de la
même manière.

### Voir le résultat dans le navigateur

Sauvez les modifications et actualisez la page dans le navigateur en visitant
les URLs de la page d'accueil et de la page de profil. Vous devriez maintenant
voir les posts affichés en utilisant le composant `x-post-card`, ce qui permet
d'avoir un code plus propre et réutilisable pour afficher les posts dans
différentes vues de votre application.

Grâce à l'utilisation du composant pour les posts, nous avons éliminé la
duplication de code dans les différentes vues, ce qui rend notre code plus
propre et plus facile à maintenir. De plus, si nous souhaitons apporter des
modifications à l'apparence ou au comportement des posts, nous pouvons le faire
dans un seul endroit (le template Blade du composant), ce qui rend les
modifications plus faciles à gérer et à propager dans toute l'application.

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Supprimer la page de test

Dans cette section, nous allons supprimer la page de test que nous avions créée
précédemment pour vérifier que notre application fonctionnait correctement.
Cette page de test n'est plus nécessaire maintenant que nous avons créé les
différentes pages de notre application de réseau social, et il est important de
garder notre code propre et organisé en supprimant les éléments qui ne sont plus
utilisés.

### Créer l'issue et la branche pour suivre cette tâche

Comme pour les tâches précédentes, commencez par créer l'issue sur GitHub pour
suivre cette tâche, puis créez la branche correspondante à partir de la branche
principale `main`.

Basculez sur la branche que vous venez de créer, puis suivez les étapes
suivantes pour supprimer la page de test de votre application.

### Supprimer la vue pour la page de test

Supprimez le fichier de vue `resources/views/test.blade.php` que nous avions
créé précédemment pour la page de test.

### Supprimer la route pour la page de test

Ouvrez le fichier `routes/web.php` et supprimez la route suivante qui correspond
à la page de test :

```php
Route::get('/test-view', function () {
    return view('test');
});
```

### Pousser les modifications et fusionner la pull request

Une fois les modifications terminées, validez les modifications dans Git, puis
vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

N'oubliez pas de récupérer les modifications localement après la fusion de la
pull request.

## Conclusion

Dans cette session de mini-projet, nous avons exploré le concept des vues offert
par Laravel, qui nous permet de séparer la logique de notre application de la
présentation de notre application.

Nous avons créé un layout commun pour notre application de réseau social, que
nous avons utilisé pour créer des vues pour les différentes pages de notre
application, telles que la page "à propos", la page d'accueil (feed), et la page
de profil. Nous avons également créé un composant pour les posts, ce qui nous a
permis d'afficher les posts de manière réutilisable dans différentes vues de
notre application.

Grâce à l'internationalisation (i18n) de notre application, nous avons pu
afficher le contenu de nos pages dans la langue configurée pour l'application,
ce qui permettra de facilement traduire notre application dans d'autres langues
à l'avenir si nous le souhaitons.

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

- Permettre de changer la langue de l'interface utilisateur (i18n) en ajoutant
  un sélecteur de langue dans le menu de navigation.
- Ajouter une fonctionnalité de recherche pour permettre aux utilisateur.trices
  de rechercher des posts ou des utilisateur.trices dans l'application.
- Ajouter une fonctionnalité de pagination pour les pages d'accueil et de profil
  afin de limiter le nombre de posts affichés par page.

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé les exercices et le mini-projet.

- Seriez-vous capable d'ajouter du contenu à la page "à propos" de votre
  application pour présenter les fonctionnalités de votre application de réseau
  social ?
- Seriez-vous capable de changer le thème de votre application avec Tailwind CSS
  ?

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
