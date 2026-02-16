# Vues, Blade et Tailwind CSS

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Voici quelques informations relatives à ce contenu.
>
> **Ressources annexes**
>
> - Autres formats du support de cours : [Présentation (web)][presentation-web]
>   · [Présentation (PDF)][presentation-pdf]
> - Exercices : [Accéder au contenu](./01-exercices/README.md)
> - Mini-projet : [Accéder au contenu](./02-mini-projet/README.md)
>
> **Objectifs**
>
> À l'issue de cette séance, les personnes qui étudient devraient être capables
> de :
>
> - Décrire la partie "vue" du patron de conception MVC.
> - Décrire le concept de moteur de template et son intérêt.
> - Utiliser Blade pour créer des vues dans une application Laravel.
> - Utiliser les directives de Blade pour structurer les vues et afficher des
>   données.
> - Utiliser Blade pour créer des layouts réutilisables.
> - Utiliser les slots (par défaut et nommés) pour passer du contenu aux
>   composants.
> - Utiliser Blade pour créer des composants réutilisables.
> - Utiliser les layouts et les composants Blade pour structurer une application
>   Laravel.
> - Installer et configurer des dépendances externes avec Composer.
> - Mettre en place l'internationalisation (i18n) dans une application Laravel.
> - Utiliser les fichiers de traduction pour supporter plusieurs langues.
> - Utiliser les variables d'environnement pour adapter l'application.
> - Décrire la différence entre du CSS "classique" et un framework CSS
>   utilitaire comme Tailwind CSS.
> - Utiliser Tailwind CSS pour styliser les interfaces utilisateur.
>
> **Méthodes d'enseignement et d'apprentissage**
>
> Les méthodes d'enseignement et d'apprentissage utilisées pour animer la séance
> sont les suivantes :
>
> - Présentation magistrale.
> - Discussions collectives.
> - Travail en autonomie.
>
> **Méthodes d'évaluation**
>
> L'évaluation prend la forme d'exercices et d'un mini-projet à réaliser en
> autonomie en classe ou à la maison.
>
> L'évaluation se fait en utilisant les critères suivants :
>
> - Capacité à répondre avec justesse.
> - Capacité à argumenter.
> - Capacité à réaliser les tâches demandées.
> - Capacité à s'approprier les exemples de code.
> - Capacité à appliquer les exemples de code à des situations similaires.
>
> Les retours se font de la manière suivante :
>
> - Corrigé des exercices.
> - Corrigé du mini-projet.
>
> L'évaluation ne donne pas lieu à une note.

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Introduction aux vues dans le patron MVC](#introduction-aux-vues-dans-le-patron-mvc)
- [Les moteurs de templates](#les-moteurs-de-templates)
- [Blade : le moteur de templates de Laravel](#blade--le-moteur-de-templates-de-laravel)
  - [Lien avec les routes](#lien-avec-les-routes)
  - [Passage et affichage de données](#passage-et-affichage-de-données)
  - [Syntaxe de base et directives](#syntaxe-de-base-et-directives)
  - [Création de vues avec Artisan](#création-de-vues-avec-artisan)
- [Layout Blade](#layout-blade)
  - [Approche avec les composants](#approche-avec-les-composants)
  - [Structure d'un layout](#structure-dun-layout)
  - [Utilisation du layout](#utilisation-du-layout)
- [Slots par défaut et slots nommés](#slots-par-défaut-et-slots-nommés)
- [Composants Blade](#composants-blade)
  - [Création d'un composant](#création-dun-composant)
  - [Vue du composant](#vue-du-composant)
  - [Classe du composant](#classe-du-composant)
  - [Utilisation du composant et passage de propriétés](#utilisation-du-composant-et-passage-de-propriétés)
  - [Passer des variables à des composants](#passer-des-variables-à-des-composants)
- [Internationalisation (i18n)](#internationalisation-i18n)
  - [Pourquoi l'internationalisation est importante](#pourquoi-linternationalisation-est-importante)
  - [Vocabulaire](#vocabulaire)
  - [Configuration de la locale](#configuration-de-la-locale)
  - [Fichiers de traduction](#fichiers-de-traduction)
  - [Utilisation des traductions dans les vues](#utilisation-des-traductions-dans-les-vues)
  - [Traductions au pluriel](#traductions-au-pluriel)
- [Gestion des dépendances avec Composer](#gestion-des-dépendances-avec-composer)
  - [Installation d'une dépendance](#installation-dune-dépendance)
  - [Librairie `laravel-lang/lang`](#librairie-laravel-langlang)
- [Variables d'environnement](#variables-denvironnement)
  - [Le fichier `.env`](#le-fichier-env)
  - [Le fichier `.env.example`](#le-fichier-envexample)
  - [Bonnes pratiques](#bonnes-pratiques)
- [Tailwind CSS](#tailwind-css)
  - [Approche CSS classique](#approche-css-classique)
  - [Approche avec Tailwind CSS](#approche-avec-tailwind-css)
  - [Comparaison](#comparaison)
  - [Intégration avec Laravel et Vite](#intégration-avec-laravel-et-vite)
  - [Aller plus loin avec Tailwind CSS](#aller-plus-loin-avec-tailwind-css)
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [Questions d'évaluation](#questions-dévaluation)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs de permettre aux personnes qui étudient de
maîtriser la création d'interfaces utilisateur avec Blade et Tailwind CSS dans
le contexte d'une application Laravel. Les personnes qui étudient apprendront à
structurer leurs vues de manière réutilisable, à mettre en place
l'internationalisation, et à styliser leurs applications avec Tailwind CSS.

De façon plus concise, à l'issue de cette séance, les personnes qui étudient
devraient être capables de :

- Décrire la partie "vue" du patron de conception MVC.
- Décrire le concept de moteur de template et son intérêt.
- Utiliser Blade pour créer des vues dans une application Laravel.
- Utiliser les directives de Blade pour structurer les vues et afficher des
  données.
- Utiliser Blade pour créer des layouts réutilisables.
- Utiliser les slots (par défaut et nommés) pour passer du contenu aux
  composants.
- Utiliser Blade pour créer des composants réutilisables.
- Utiliser les layouts et les composants Blade pour structurer une application
  Laravel.
- Installer et configurer des dépendances externes avec Composer.
- Mettre en place l'internationalisation (i18n) dans une application Laravel.
- Utiliser les fichiers de traduction pour supporter plusieurs langues.
- Utiliser les variables d'environnement pour adapter l'application.
- Décrire la différence entre du CSS "classique" et un framework CSS utilitaire
  comme Tailwind CSS.
- Utiliser Tailwind CSS pour styliser les interfaces utilisateur.

## Introduction aux vues dans le patron MVC

Le patron de conception MVC (Model-View-Controller) sépare une application en
trois composants principaux. Nous avons déjà abordé les modèles (Model) lors de
la séance précédente, qui représentent les données et la logique métier de
l'application. Dans cette séance, nous allons nous concentrer sur les vues
(View), qui sont responsables de la présentation des données à la personne qui
utilise l'application.

Dans le patron MVC, les vues ont pour responsabilité de :

- Afficher les données fournies par les contrôleurs (que nous verrons plus en
  détail dans une prochaine séance).
- Présenter l'interface utilisateur de manière claire et attractive.
- Structurer le contenu HTML de manière logique et sémantique.
- Ne pas contenir de logique métier (cette responsabilité appartient aux modèles
  et contrôleurs).

Les vues ne doivent pas accéder directement à la base de données ni effectuer de
calculs complexes. Elles reçoivent des données déjà préparées et se contentent
de les afficher de manière appropriée.

Cette séparation entre la logique métier (modèles), la logique de présentation
(vues) et la logique de contrôle (contrôleurs) offre plusieurs avantages :

- **Maintenabilité** : les modifications de l'interface utilisateur n'affectent
  pas la logique métier.
- **Réutilisabilité** : les mêmes données peuvent être affichées de différentes
  manières (web, mobile, API).
- **Testabilité** : chaque composant peut être testé indépendamment.
- **Collaboration** : les personnes qui développent peuvent se spécialiser dans
  différents aspects de l'application.

Dans Laravel, les vues sont stockées dans le répertoire `resources/views` et
utilisent l'extension `.blade.php` pour indiquer qu'elles utilisent le moteur de
template Blade.

## Les moteurs de templates

Un moteur de template (template engine) est un outil qui permet de générer du
contenu HTML dynamique en combinant des données avec des templates prédéfinis.

Sans moteur de template, il faudrait mélanger du code PHP directement dans le
HTML, ce qui peut rapidement devenir difficile à maintenir :

```php
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <?php if (isset($user)): ?>
        <p>Bienvenue, <?php echo htmlspecialchars($user->name); ?> !</p>
    <?php else: ?>
        <p>Veuillez vous connecter.</p>
    <?php endif; ?>

    <ul>
    <?php foreach ($items as $item): ?>
        <li><?php echo htmlspecialchars($item->name); ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
```

Ce code fonctionne, mais il présente plusieurs problèmes :

- Syntaxe verbeuse et répétitive.
- Nécessité de penser à échapper les données avec `htmlspecialchars()` pour
  éviter les failles XSS (Cross-Site Scripting).
- Difficulté à distinguer le code PHP du HTML.
- Pas de réutilisation facile de structures communes (en-tête, pied de page).

Un moteur de template moderne comme Blade résout ces problèmes en offrant :

- **Syntaxe concise** : des directives courtes et expressives pour les
  opérations courantes.
- **Échappement automatique** : protection automatique contre les failles XSS.
- **Héritage de templates** : possibilité de créer des layouts réutilisables.
- **Composants** : création d'éléments d'interface réutilisables.
- **Compilation** : les templates sont compilés en PHP pur pour des performances
  optimales.

**Autres moteurs de templates**

Blade n'est pas le seul moteur de template disponible. D'autres exemples
incluent :

- **Twig** (PHP) : utilisé par Symfony, syntaxe similaire à Blade.
- **Smarty** (PHP) : l'un des plus anciens moteurs de template PHP.
- **Thymeleaf** (Java) : utilisé dans les applications Spring.
- **Jinja2** (Python) : utilisé par Flask et Django.
- **EJS** (JavaScript) : populaire dans l'écosystème Node.js.
- **Handlebars** (JavaScript) : populaire dans l'écosystème Node.js.
- **ERB** (Ruby) : le moteur de template par défaut de Ruby on Rails.

Laravel a choisi de développer son propre moteur de template (Blade) pour offrir
une intégration parfaite avec le framework et une syntaxe optimisée pour les
besoins courants du développement web.

## Blade : le moteur de templates de Laravel

Blade est le moteur de template puissant et élégant inclus avec Laravel. Il
permet de créer des vues dynamiques tout en gardant le code propre et lisible.

Les caractéristiques principales de Blade incluent :

- Les fichiers Blade utilisent l'extension `.blade.php`.
- Blade ne vous empêche pas d'utiliser du PHP pur dans vos vues si nécessaire.
- Les templates Blade sont compilés en PHP pur et mis en cache pour de
  meilleures performances.
- Blade offre des directives simples pour les opérations courantes (boucles,
  conditions, etc.).

### Lien avec les routes

Nous étudierons les routes et les contrôleurs plus en détail dans une prochaine
séance, mais il est important de noter que les données affichées dans les vues
sont généralement passées depuis les routes ou les contrôleurs. Par exemple, une
route peut ressembler à ceci :

```php
// routes/web.php

// ... autres routes ...

Route::get('/about', function () {
    return view('about');
});

// ... autres routes ...
```

Avec la route ci-dessus, lorsque la personne qui utilise accède à l'URL
`/about`, Laravel rendra la vue `resources/views/about.blade.php`.

La méthode `view()` prend en paramètre le nom de la vue (sans l'extension
`.blade.php`) et un tableau associatif de données à passer à la vue (optionnel).

### Passage et affichage de données

Les données sont passées aux vues depuis les routes (ou les contrôleurs) sous
forme de tableaux associatifs passés à la fonction `view()`. Par exemple :

```php
Route::get('/profile', function () {
    $user = User::find(1);

    return view('profile', [
        'user' => $user,
        'title' => 'Profil utilisateur'
    ]);
});
```

Il est ensuite possible d'afficher ces données dans la vue Blade correspondante
:

```php
<h1>{{ $title }}</h1>

<div>
    <p>Nom : {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
</div>
```

### Syntaxe de base et directives

Blade utilise une syntaxe claire et concise pour afficher des données et
structurer les templates et propose plusieurs directives (= fonctions) pour les
opérations courantes.

#### Affichage de données

Pour afficher des données, Blade utilise la syntaxe `{{ }}` :

```php
<h1>{{ $title }}</h1>
<p>Bienvenue, {{ $user->name }} !</p>
```

Cette syntaxe échappe automatiquement les données pour prévenir les attaques XSS
(Cross-Site Scripting). C'est équivalent à utiliser `htmlspecialchars()` en PHP
pur.

#### Appel de fonctions

Vous pouvez appeler des fonctions PHP et des méthodes d'objets directement dans
les templates Blade :

```php
<p>Membre depuis : {{ $user->created_at->format('d/m/Y') }}</p>
<p>Nombre d'articles : {{ count($user->posts) }}</p>
<p>Nom en majuscules : {{ strtoupper($user->name) }}</p>
```

#### Structures de contrôle

Blade offre des directives élégantes pour les structures de contrôle courantes.

```php
@if ($user->isAdmin())
    <p>Vous êtes administrateur.</p>
@elseif ($user->isModerator())
    <p>Vous êtes modérateur.</p>
@else
    <p>Vous êtes un utilisateur standard.</p>
@endif
```

```php
@foreach ($posts as $post)
    <article>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
    </article>
@endforeach
```

Blade offre aussi d'autres types de boucles :

```php
@for ($i = 0; $i < 10; $i++)
    <p>Itération {{ $i }}</p>
@endfor

@while ($condition)
    <p>En cours...</p>
@endwhile

@forelse ($posts as $post)
    <article>{{ $post->title }}</article>
@empty
    <p>Aucun post trouvé.</p>
@endforelse
```

La directive `@forelse` est particulièrement utile car elle combine une boucle
`foreach` avec une gestion du cas où la collection est vide.

La documentation officielle de Laravel offre une liste extrêmement complète des
directives Blade disponibles, que vous pouvez consulter à l'adresse suivante :
<https://laravel.com/docs/12.x/blade#blade-directives>.

Nous utiliserons de nombreuses directives Blade tout au long du cours, et il est
important de se familiariser avec la documentation pour découvrir les
différentes options à votre disposition.

### Création de vues avec Artisan

Laravel fournit une commande Artisan pour créer rapidement de nouvelles vues :

```bash
php artisan make:view profile
```

Cette commande crée un nouveau fichier `resources/views/profile.blade.php` avec
une structure de base.

Vous pouvez aussi créer des vues dans des sous-répertoires :

```bash
php artisan make:view users.profile
```

Cela créera le fichier `resources/views/users/profile.blade.php`.

## Layout Blade

Les layouts permettent de créer des structures réutilisables pour éviter la
duplication de code et faciliter la maintenance.

Un layout définit la structure de base d'une page (HTML, head, body, navigation,
footer) qui peut être réutilisée sur plusieurs pages.

### Approche avec les composants

Laravel recommande d'utiliser des composants Blade pour créer des layouts. Un
composant de layout est créé avec la commande Artisan :

```bash
php artisan make:component DefaultLayout
```

Cette commande crée deux fichiers :

- `app/View/Components/DefaultLayout.php` : la classe du composant.
- `resources/views/components/default-layout.blade.php` : la vue du composant.

### Structure d'un layout

Voici un exemple de layout de base :

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @isset($title)
            {{ $title }} - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endisset
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">Accueil</a>
            <a href="{{ url('/about') }}">À propos</a>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
    </footer>
</body>
</html>
```

La variable `{{ $slot }}` représente l'endroit où le contenu spécifique à chaque
page sera inséré.

### Utilisation du layout

Pour utiliser ce layout dans une vue, vous utilisez le composant avec la syntaxe
`<x-nom-du-composant>` :

```php
<x-default-layout>
    <h1>Page d'accueil</h1>
    <p>Bienvenue sur notre site !</p>
</x-default-layout>
```

Le contenu entre les balises du composant sera automatiquement inséré à
l'emplacement de `{{ $slot }}` dans le layout.

## Slots par défaut et slots nommés

Les slots permettent de passer du contenu aux layouts ou aux composants.

Le slot par défaut est représenté par `{{ $slot }}` dans le composant et reçoit
tout le contenu entre les balises du composant :

```php
<x-card>
    <p>Ceci est le contenu du slot par défaut.</p>
</x-card>
```

Pour passer plusieurs sections de contenu à un composant, utilisez des slots
nommés :

```php
<article>
    <header>
        {{ $header }}
    </header>
    <div>
        {{ $slot }}
    </div>
    @isset($footer)
        <footer>
            {{ $footer }}
        </footer>
    @endisset
</article>
```

Afin d'utiliser les slots nommés, vous devez les définir lors de l'utilisation
du composant en utilisant la syntaxe `<x-slot:nom>` :

```php
<x-card>
    <x-slot:header>
        <h2>Titre de la carte</h2>
    </x-slot:header>

    <p>Contenu principal de la carte.</p>

    <x-slot:footer>
        <button>En savoir plus</button>
    </x-slot:footer>
</x-card>
```

Les slots nommés utilisent la syntaxe `<x-slot:nom>` pour être définis lors de
l'utilisation du composant.

## Composants Blade

Les composants Blade sont des éléments d'interface réutilisables qui peuvent
être utilisés dans plusieurs vues.

### Création d'un composant

```bash
php artisan make:component Alert
```

Cela crée :

- `app/View/Components/Alert.php`
- `resources/views/components/alert.blade.php`

Ces deux fichiers représentent respectivement la classe du composant et sa vue.

### Vue du composant

Exemple de composant d'alerte (`resources/views/components/alert.blade.php`) :

```php
<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>
```

Ce fichier définit la structure HTML de l'alerte, avec une classe dynamique
basée sur la propriété `type` et un slot pour le contenu de l'alerte.

### Classe du composant

La classe permet de définir les propriétés acceptées par le composant
(`app/View/Components/Alert.php`) :

```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{
    public function __construct(
        public string $type = 'info'
    ) {}

    public function render(): View
    {
        return view('components.alert');
    }
}
```

Ce fichier définit une classe `Alert` qui accepte une propriété `type` avec une
valeur par défaut de `info`.

### Utilisation du composant et passage de propriétés

Le fait d'avoir déclaré `public string $type` dans le constructeur du composant
permet de passer une propriété `type` lors de l'utilisation du composant, qui
sera ensuite disponible dans la vue du composant :

```php
<x-alert type="success">
    Votre profil a été mis à jour avec succès !
</x-alert>

<x-alert type="error">
    Une erreur s'est produite lors de l'enregistrement.
</x-alert>
```

### Passer des variables à des composants

Les composants peuvent recevoir des données via leurs attributs. Par exemple,
pour un composant de carte de post, vous pourriez avoir une classe comme
celle-ci :

```php
<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;
use Illuminate\View\View;

class PostCard extends Component
{
    public function __construct(
        public Post $post,
        public bool $showAuthor = true
    ) {}

    public function render(): View
    {
        return view('components.post-card');
    }
}
```

La vue associée (`resources/views/components/post-card.blade.php`) pourrait
ressembler à ceci :

```php
<article>
    <h2>{{ $post->title }}</h2>
    <div>{{ $post->content }}</div>

    @if ($showAuthor)
        <p>Par {{ $post->user->name }}</p>
    @endif
</article>
```

Puis, dans une vue, vous pouvez utiliser ce composant pour afficher une liste de
posts :

```php
@foreach ($posts as $post)
    <x-post-card :post="$post" :show-author="true" />
@endforeach
```

Notez l'utilisation du préfixe `:` devant les attributs pour indiquer qu'il
s'agit de variables PHP et non de chaînes de caractères. Sans le `:`, Laravel
traiterait la valeur comme une chaîne littérale.

## Internationalisation (i18n)

L'internationalisation (souvent abrégée i18n, car il y a 18 lettres entre le `i`
et le `n` de _"internationalization"_) est le processus de conception d'une
application pour qu'elle puisse être facilement adaptée à différentes langues et
régions.

### Pourquoi l'internationalisation est importante

Même si votre application n'est initialement destinée qu'à une seule langue, il
est recommandé de mettre en place l'internationalisation dès le début du
développement pour plusieurs raisons :

- **Évolutivité** : facilite l'ajout de nouvelles langues à l'avenir.
- **Maintenance** : centralise tous les textes dans des fichiers dédiés.
- **Professionnalisme** : sépare clairement le code de la présentation.
- **Réutilisabilité** : permet de changer tous les textes sans toucher au code.

### Vocabulaire

- **Locale** : code identifiant une langue et éventuellement une région (ex :
  `fr` pour français, `fr_CH` pour français de Suisse, `en_US` pour anglais
  américain).
- **Clé de traduction** : identifiant unique pour un texte traduisible.
- **Fichier de traduction** : fichier contenant les traductions pour une locale
  donnée.
- **Fallback locale** : langue de secours utilisée si une traduction n'est pas
  trouvée dans la langue principale.

### Configuration de la locale

La configuration de la langue se fait dans le fichier `.env` avec les variables
suivantes :

```text
APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
APP_FAKER_LOCALE=fr_FR
```

- `APP_LOCALE` : langue par défaut de l'application.
- `APP_FALLBACK_LOCALE` : langue de secours si une traduction est manquante.
- `APP_FAKER_LOCALE` : locale utilisée par Faker pour générer des données
  factices.

Ces variables sont ensuite référencées dans `config/app.php` :

```php
'locale' => env('APP_LOCALE', 'en'),
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),
```

### Fichiers de traduction

Laravel prend en charge deux formats pour les fichiers de traduction : les
fichiers PHP (étudiés et utilisés dans ce cours) et les fichiers JSON (plus
simples, mais moins structurés - pas étudiés dans ce cours mais la documentation
officielle offre des ressources supplémentaires).

Les fichiers de traduction PHP sont organisés par langue dans le répertoire
`lang` :

```text
lang/
├── fr/
│   ├── auth.php
│   ├── pagination.php
│   ├── passwords.php
│   ├── validation.php
│   └── ui.php
└── en/
    ├── auth.php
    └── ...
```

Exemple de fichier `lang/fr/ui.php` :

```php
<?php

declare(strict_types=1);

return [
    'home' => [
        'title' => 'Accueil',
        'welcome' => 'Bienvenue sur :appName !',
    ],
    'profile' => [
        'title' => 'Profil',
        'edit' => 'Modifier le profil',
    ],
    'posts' => [
        'title' => 'Publications',
        'likes_count' => "{0} Aucun like|{1} :count like|[2,*] :count likes",
    ],
];
```

Les traductions sont organisées en tableaux associatifs imbriqués pour une
meilleure structure.

### Utilisation des traductions dans les vues

La fonction `__()` (ou son alias `trans()`) permet de récupérer une traduction :

```php
<h1>{{ __('ui.home.title') }}</h1>
<p>{{ __('ui.home.welcome', ['appName' => config('app.name')]) }}</p>
```

La notation point permet de naviguer dans la structure des fichiers de
traduction : `fichier.clé.sous-clé`.

Les paramètres sont passés dans un tableau associatif et référencés dans la
traduction avec la syntaxe `:nom`.

### Traductions au pluriel

Laravel gère automatiquement les formes plurielles avec `trans_choice()` :

```php
<p>{{ trans_choice('ui.posts.likes_count', $likesCount, ['count' => $likesCount]) }}</p>
```

Dans le fichier de traduction, utilisez `|` pour séparer les formes singulière
et plurielle :

```php
'likes_count' => "{0} Aucun like|{1} :count like|[2,*] :count likes",
```

Laravel choisira automatiquement la forme appropriée selon le nombre fourni.
Ici, une expression régulière est utilisée pour gérer les cas de 0, 1 et 2 ou
plus.

## Gestion des dépendances avec Composer

Composer est le gestionnaire de dépendances de PHP, similaire à npm pour
JavaScript ou pip pour Python. Nous pouvons l'utiliser pour installer des
librairies externes qui facilitent le développement de notre application, tel
que la gestion de l'internationalisation.

### Installation d'une dépendance

Pour installer une librairie externe, utilisez la commande `composer require` :

```bash
composer require laravel-lang/lang --dev
```

L'option `--dev` indique que cette dépendance est uniquement nécessaire en
développement et ne sera pas installée en production.

Pour rappel, les fichiers liés à Composer sont les suivants :

- `composer.json` : liste les dépendances du projet et leurs versions.
- `composer.lock` : fige les versions exactes installées pour garantir la
  reproductibilité.
- `vendor/` : répertoire contenant toutes les dépendances installées.

### Librairie `laravel-lang/lang`

La librairie [`laravel-lang/lang`](https://laravel-lang.com/packages-lang.html)
fournit des traductions prêtes à l'emploi pour Laravel dans plus de 80 langues :

```bash
# Installer la librairie
composer require laravel-lang/lang --dev

# Ajouter une langue
php artisan lang:add fr

# Mettre à jour les traductions
php artisan lang:update
```

Cela génère automatiquement les fichiers de traduction pour Laravel (auth,
pagination, passwords, validation) dans la langue choisie, vous évitant de
devoir tout traduire manuellement.

## Variables d'environnement

Les variables d'environnement permettent de configurer une application
différemment selon l'environnement (développement, test, production) sans
modifier le code.

### Le fichier `.env`

Le fichier `.env` à la racine du projet contient les variables d'environnement
spécifiques à votre machine locale :

```text
APP_NAME="My Social Network"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
APP_FAKER_LOCALE=fr_FR
```

- Ce fichier n'est **jamais** ajouté dans Git (il est dans le fichier
  `.gitignore`).
- Chaque personne qui développe a son propre fichier `.env` avec ses
  configurations locales.
- Les valeurs sensibles (clés API, mots de passe) doivent rester dans ce fichier
  et ne jamais être versionnées.

### Le fichier `.env.example`

Le fichier `.env.example` est un modèle de fichier `.env` qui, lui, est ajouté
dans Git :

```text
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Le rôle de ce fichier est de :

- Documenter toutes les variables d'environnement nécessaires au projet.
- Fournir des valeurs par défaut ou des exemples pour chaque variable.
- Faciliter la configuration initiale pour les nouvelles personnes sur le
  projet.

Lorsqu'une nouvelle personne clone le projet, elle doit copier `.env.example`
vers `.env` et adapter les valeurs à son environnement local.

### Bonnes pratiques

- Mettez à jour `.env.example` chaque fois que vous ajoutez une nouvelle
  variable d'environnement dans votre `.env`.
- Utilisez des valeurs génériques dans `.env.example`, jamais de valeurs
  sensibles réelles.
- Documentez les variables avec des commentaires si nécessaire.

## Tailwind CSS

Tailwind CSS est un framework CSS utilitaire qui permet de construire des
interfaces modernes rapidement en utilisant des classes CSS prédéfinies
directement dans le HTML.

### Approche CSS classique

Avec du CSS classique, vous écrivez des règles CSS personnalisées pour styliser
vos éléments :

```html
<div class="card">
	<h2 class="card-title">Titre</h2>
	<p class="card-content">Contenu de la carte.</p>
</div>
```

```css
.card {
	background-color: white;
	border-radius: 8px;
	padding: 20px;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-title {
	font-size: 24px;
	font-weight: bold;
	margin-bottom: 12px;
}

.card-content {
	color: #666;
	line-height: 1.6;
}
```

### Approche avec Tailwind CSS

Avec Tailwind, vous utilisez des classes utilitaires directement dans le HTML :

```html
<div class="bg-white rounded-lg p-5 shadow-md">
	<h2 class="text-2xl font-bold mb-3">Titre</h2>
	<p class="text-gray-600 leading-relaxed">Contenu de la carte.</p>
</div>
```

### Comparaison

Nous n'allons pas aller trop dans les détails de Tailwind CSS dans ce cours,
mais voici un tableau comparatif des deux approches :

| Aspect                 | CSS classique                                                     | Tailwind CSS                                  |
| :--------------------- | :---------------------------------------------------------------- | :-------------------------------------------- |
| Nomenclature           | Nécessite d'inventer des noms de classes                          | Classes utilitaires prédéfinies               |
| Fichiers CSS           | Fichiers CSS séparés qui grossissent                              | CSS minimal généré automatiquement            |
| Maintenance            | Recherche entre HTML et CSS                                       | Tout au même endroit                          |
| Cohérence              | Risque de valeurs incohérentes                                    | Système de design unifié                      |
| Lisibilité             | HTML plus propre, CSS plus verbeux                                | HTML plus verbeux, pas de CSS custom          |
| Courbe d'apprentissage | Connaissance CSS standard                                         | Apprendre les conventions Tailwind            |
| Pérennité              | Plus de code personnalisé à maintenir en fonction des navigateurs | Moins de code personnalisé, classes éprouvées |

### Intégration avec Laravel et Vite

Vite est une technologie liée à l'environnement Node.js, mais elle est
parfaitement intégrée dans Laravel pour gérer les dépendances et les processus
de build pour transformer du code CSS ou JavaScript dans une application
Laravel.

Vite est utilisé pour compiler les fichiers CSS et JavaScript, y compris ceux de
Tailwind CSS, et pour les servir de manière efficace pendant le développement.

C'est entre autres grâce à Vite que Tailwind CSS est intégré dans Laravel,
permettant de bénéficier de toutes les fonctionnalités de Tailwind tout en
profitant d'un processus de développement fluide et performant.

Vite offre également le hot module replacement (HMR) pour un rafraîchissement
instantané des changements dans le navigateur, ce qui améliore considérablement
l'expérience de développement.

Pour inclure les assets compilés par Vite dans vos vues Blade :

```php
<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Votre contenu -->
</body>
</html>
```

La directive `@vite` génère automatiquement les bonnes balises `<link>` et
`<script>` pour charger les assets.

Il n'est pas nécessaire d'apprendre les détails de Vite pour ce cours, mais il
est important de comprendre que Vite est l'outil qui permet à Tailwind CSS de
fonctionner efficacement dans Laravel.

### Aller plus loin avec Tailwind CSS

Comme le contenu du cours ne repose pas sur Tailwind CSS, nous n'allons pas
entrer dans les détails de son utilisation, mais voici un aperçu des concepts
clés et des classes utilitaires de base pour vous donner une idée de ce que
Tailwind offre.

**Ce contenu est optionnel est n'est là que pour vous aider à démarrer avec
Tailwind CSS si vous souhaitez aller plus loin.**

#### Design system intégré

Tailwind fournit un système cohérent pour :

- Les espacements (margin, padding) : `m-4`, `p-2`, `mx-auto`.
- Les couleurs : `bg-blue-500`, `text-red-600`, `border-gray-300`.
- La typographie : `text-xl`, `font-bold`, `leading-relaxed`.
- Les ombres : `shadow-sm`, `shadow-md`, `shadow-lg`.
- Les bordures : `border`, `rounded-lg`, `border-2`.

#### Purge du CSS inutilisé

Tailwind génère automatiquement un fichier CSS minimal contenant uniquement les
classes que vous utilisez réellement dans votre application, ce qui résulte en
des fichiers CSS très légers en production.

#### Layout et espacement

```html
<!-- Display -->
<div class="block">...</div>
<div class="flex">...</div>
<div class="grid">...</div>
<div class="hidden">...</div>

<!-- Flexbox -->
<div class="flex items-center justify-between">...</div>

<!-- Padding et margin -->
<div class="p-4 m-2">...</div>
<!-- padding: 1rem, margin: 0.5rem -->
<div class="px-4 py-2">...</div>
<!-- padding horizontal/vertical -->
<div class="mt-4 mb-6">...</div>
<!-- margin top/bottom -->

<!-- Width et height -->
<div class="w-full h-screen">...</div>
<!-- 100% width, 100vh height -->
<div class="w-1/2 h-64">...</div>
<!-- 50% width, 16rem height -->
```

#### Typographie

```html
<!-- Taille de texte -->
<p class="text-sm">Petit texte</p>
<p class="text-base">Texte normal</p>
<p class="text-xl">Grand texte</p>
<p class="text-4xl">Très grand texte</p>

<!-- Graisse et style -->
<p class="font-light">Léger</p>
<p class="font-normal">Normal</p>
<p class="font-bold">Gras</p>
<p class="italic">Italique</p>

<!-- Alignement -->
<p class="text-left">Aligné à gauche</p>
<p class="text-center">Centré</p>
<p class="text-right">Aligné à droite</p>
```

#### Couleurs

```html
<!-- Couleur de texte -->
<p class="text-gray-900">Texte très foncé</p>
<p class="text-blue-500">Texte bleu</p>
<p class="text-red-600">Texte rouge</p>

<!-- Couleur de fond -->
<div class="bg-white">Fond blanc</div>
<div class="bg-gray-100">Fond gris clair</div>
<div class="bg-blue-500">Fond bleu</div>

<!-- Couleur de bordure -->
<div class="border border-gray-300">Bordure grise</div>
```

Les couleurs vont de 50 (très clair) à 950 (très foncé) pour la plupart des
teintes.

#### Bordures et arrondis

```html
<!-- Bordures -->
<div class="border">Bordure simple</div>
<div class="border-2">Bordure épaisse</div>
<div class="border-t">Bordure en haut seulement</div>

<!-- Arrondis -->
<div class="rounded">Coins arrondis légers</div>
<div class="rounded-lg">Coins bien arrondis</div>
<div class="rounded-full">Complètement rond (cercle)</div>
```

#### Ombres

```html
<div class="shadow-sm">Ombre légère</div>
<div class="shadow-md">Ombre moyenne</div>
<div class="shadow-lg">Ombre prononcée</div>
```

#### Responsive design

Tailwind utilise des préfixes pour appliquer des styles à différentes tailles
d'écran :

```html
<!-- Pile sur mobile, grille sur desktop -->
<div class="flex flex-col md:flex-row">
	<div class="w-full md:w-1/2">Colonne 1</div>
	<div class="w-full md:w-1/2">Colonne 2</div>
</div>

<!-- Texte petit sur mobile, grand sur desktop -->
<h1 class="text-2xl md:text-4xl lg:text-5xl">Titre responsive</h1>
```

#### Dark mode

Tailwind facilite l'implémentation du mode sombre avec le préfixe `dark:` :

```html
<div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
	<h1>Titre qui s'adapte au thème</h1>
	<p class="text-gray-600 dark:text-gray-300">
		Texte qui reste lisible en mode sombre.
	</p>
</div>
```

#### États interactifs

Tailwind gère aussi les états hover, focus, active, etc. :

```html
<!-- Changement de couleur au survol -->
<button class="bg-blue-500 hover:bg-blue-700 text-white">Survolez-moi</button>

<!-- Style au focus -->
<input class="border focus:border-blue-500 focus:ring-2 focus:ring-blue-200" />

<!-- Styles combinés -->
<a class="text-blue-500 hover:text-blue-700 hover:underline"> Lien </a>
```

## Conclusion

Dans cette séance, nous avons exploré les vues dans le contexte du patron MVC et
appris à créer des interfaces utilisateur avec Blade et Tailwind CSS. Voici les
points clés à retenir :

- Les **vues** sont responsables de la présentation des données dans le patron
  MVC, sans contenir de logique métier.
- Les **moteurs de templates** comme Blade facilitent la création de vues
  dynamiques avec une syntaxe concise et des fonctionnalités avancées.
- **Blade** offre des directives puissantes (`@if`, `@foreach`, `{{ }}`) pour
  structurer les vues et afficher des données de manière sécurisée.
- Les **layouts et composants** Blade permettent de créer des structures
  réutilisables et d'éviter la duplication de code.
- Les **slots** (par défaut et nommés) offrent une flexibilité pour passer du
  contenu aux composants.
- L'**internationalisation (i18n)** doit être mise en place dès le début du
  développement pour faciliter l'ajout de nouvelles langues et la maintenance.
- Les **variables d'environnement** permettent de configurer l'application
  différemment selon les environnements sans modifier le code.
- **Tailwind CSS** adopte une approche utility-first qui permet de construire
  des interfaces rapidement avec des classes utilitaires prédéfinies.
- L'intégration de Tailwind avec **Laravel et Vite** offre un workflow de
  développement moderne avec rechargement instantané.

## Exercices

Nous vous invitons maintenant à réaliser les exercices de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les exercices et leur corrigé ici :
[Exercices](./01-exercices/README.md).

## Mini-projet

Nous vous invitons maintenant à réaliser le mini-projet de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les détails du mini-projet ici :
[Mini-projet](./02-mini-projet/README.md).

## Questions d'évaluation

> [!NOTE]
>
> Les questions d'évaluation sont destinées à vous aider à vérifier votre
> compréhension des concepts abordés dans le cours. Elles ne sont pas destinées
> à être utilisées comme une liste de contrôle exhaustive des compétences à
> maîtriser.
>
> Il est recommandé de les utiliser comme un guide pour vous aider à identifier
> les domaines dans lesquels vous pourriez avoir besoin de renforcer vos
> connaissances ou de pratiquer davantage.

- Quel est le rôle des vues dans le patron de conception MVC ?
- Quels sont les avantages d'utiliser un moteur de template par rapport à du PHP
  pur dans le HTML ?
- Pourquoi est-il important de mettre en place l'internationalisation dès le
  début du développement, même pour une application monolingue ?
- Comment créer une vue Blade avec la commande Artisan ?
- Comment passe-t-on du contenu à un composant Blade ?
- Quelle est la différence entre un slot par défaut et un slot nommé ?
- Comment créer un composant Blade avec Artisan ?
- Pourquoi utilise-t-on le préfixe `:` devant certains attributs de composants
  (ex : `:post="$post"`) ?
- À quoi servent les variables `APP_LOCALE` et `APP_FALLBACK_LOCALE` ?
- Quelle est la différence entre un fichier de traduction PHP et un fichier JSON
  ?
- Comment accède-t-on à une traduction dans une vue Blade ?
- Comment gère-t-on les formes plurielles dans les traductions Laravel ?
- Quelle est la différence entre les fichiers `.env` et `.env.example` ?
- Pourquoi ne doit-on jamais commiter le fichier `.env` dans Git ?
- Quelle fonction doit-on utiliser pour accéder aux configurations dans le code
  de l'application (en dehors des fichiers de configuration) ?
- Quelle est la différence entre l'approche CSS classique et l'approche
  utility-first de Tailwind ?

## À faire pour la prochaine séance

Chaque personne est libre de gérer son temps comme elle le souhaite. Cependant,
il est recommandé pour la prochaine séance de :

- Relire le support de cours si nécessaire.
- Finaliser les exercices qui n'ont pas été terminés en classe.
- Finaliser la partie du mini-projet qui n'a pas été terminée en classe.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
[presentation-web]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/04-vues-blade-et-tailwind-css-presentation.pdf
