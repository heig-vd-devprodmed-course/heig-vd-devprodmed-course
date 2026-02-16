---
marp: true
theme: 'custom-marp-theme'
size: '16:9'
paginate: 'true'
author: "L. Delafontaine, avec l'aide de GitHub Copilot"
description:
  'Vues, Blade et Tailwind CSS pour le cours DévProdMéd enseigné à la HEIG-VD,
  Suisse'
lang: 'fr'
url: 'https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/presentation.html'
header: '[**Vues, Blade et Tailwind CSS**][contenu-complet-sur-github]'
footer:
  '[**HEIG-VD**](https://heig-vd.ch) - [DévProdMéd
  2025-2026](https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course)
  - [CC BY-SA 4.0][licence]'
headingDivider: 6
---

# Vues, Blade et Tailwind CSS

<!--
_class: lead
_paginate: false
-->

<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course>

Visualiser le contenu complet sur GitHub [à cette
adresse][contenu-complet-sur-github].

<small>L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).</small>

<small>Ce travail est sous licence [CC BY-SA 4.0][licence].</small>

![bg opacity:0.1][illustration-principale]

## Plus de détails sur GitHub

<!-- _class: lead -->

_Cette présentation est un résumé du contenu complet disponible sur GitHub._

_Pour plus de détails, consulter le [contenu complet sur
GitHub][contenu-complet-sur-github] ou en cliquant sur l'en-tête de ce
document._

## Objectifs (1)

- Décrire la partie "vue" du patron de conception MVC.
- Décrire le concept de moteur de template et son intérêt.
- Utiliser Blade pour créer des vues dans une application Laravel.
- Utiliser les directives de Blade pour structurer les vues et afficher des
  données.

![bg right:40%][illustration-objectifs]

## Objectifs (2)

- Utiliser Blade pour créer des layouts réutilisables.
- Utiliser les slots (par défaut et nommés) pour passer du contenu aux
  composants.
- Utiliser Blade pour créer des composants réutilisables.
- Utiliser les layouts et les composants Blade pour structurer une application
  Laravel.

![bg right:40%][illustration-objectifs]

## Objectifs (3)

- Installer et configurer des dépendances externes avec Composer.
- Mettre en place l'internationalisation (i18n) dans une application Laravel.
- Utiliser les fichiers de traduction pour supporter plusieurs langues.

![bg right:40%][illustration-objectifs]

## Objectifs (4)

- Utiliser les variables d'environnement pour adapter l'application.
- Décrire la différence entre du CSS "classique" et un framework CSS utilitaire
  comme Tailwind CSS.
- Utiliser Tailwind CSS pour styliser les interfaces utilisateur.

![bg right:40%][illustration-objectifs]

## Introduction aux vues dans le patron MVC

Le patron MVC (Model-View-Controller) sépare une application en trois composants
principaux :

- **Model** : données et logique métier (séance précédente).
- **View** : présentation des données à l'utilisateur.
- **Controller** : logique de contrôle (prochaine séance).

Dans cette séance, nous allons étudier les **vues**.

## Les moteurs de templates

Un moteur de template permet de générer du HTML dynamique en combinant des
données avec des templates prédéfinis.

Sans moteur de template, il faudrait mélanger du code PHP directement dans le
HTML.

**Problèmes** : syntaxe verbeuse, échappement manuel, difficulté de maintenance.

---

```php
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <ul>
    <?php foreach ($posts as $post): ?>
        <li><?php echo htmlspecialchars($post->title); ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
```

### Avantages d'un moteur de template

- **Syntaxe concise** : directives courtes et expressives.
- **Échappement automatique** : protection contre les failles XSS.
- **Héritage de templates** : layouts réutilisables.
- **Composants** : éléments d'interface réutilisables.
- **Compilation** : templates compilés en PHP pur pour de meilleures
  performances.

## Blade : le moteur de templates de Laravel

<!-- _class: lead -->

Blade est le moteur de template inclus avec Laravel.

- Fichiers avec l'extension `.blade.php`.
- Permet d'utiliser du PHP pur si nécessaire.
- Compilation en PHP pur pour de meilleures performances.
- Directives simples pour les opérations courantes.

### Lien avec les routes

Les vues sont rendues depuis les routes (ou contrôleurs) :

```php
// routes/web.php
Route::get('/about', function () {
    return view('about');
});
```

Quand l'utilisateur accède à `/about`, Laravel rend la vue
`resources/views/about.blade.php`.

La fonction `view()` prend le nom de la vue (sans `.blade.php`) et
optionnellement un tableau de données.

### Passage et affichage de données

Les données sont passées aux vues via un tableau associatif :

```php
Route::get('/profile', function () {
    $user = User::find(1);
    return view('profile', [
        'title' => 'Profil utilisateur',
        'user' => $user,
    ]);
});
```

Affichage dans la vue :

```php
<h1>{{ $title }}</h1>
<div class="profile">
    <p>Nom : {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
</div>
```

La syntaxe `{{ }}` échappe automatiquement les données (protection XSS).

### Syntaxe de base et directives (1)

**Conditions** :

```php
@if ($user->isAdmin())
    <p>Vous êtes administrateur.</p>
@elseif ($user->isModerator())
    <p>Vous êtes modérateur.</p>
@else
    <p>Vous êtes un utilisateur standard.</p>
@endif
```

**Directives raccourcies** :

```php
@auth
    <p>Vous êtes connecté.</p>
@endauth

@guest
    <p>Veuillez vous connecter.</p>
@endguest
```

### Syntaxe de base et directives (2)

**Boucles** :

```php
@foreach ($posts as $post)
    <article>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->excerpt }}</p>
    </article>
@endforeach
```

**Boucle avec gestion du cas vide** :

```php
@forelse ($posts as $post)
    <article>{{ $post->title }}</article>
@empty
    <p>Aucun post trouvé.</p>
@endforelse
```

### Syntaxe de base et directives (3)

**Variable `$loop`** dans les boucles :

```php
@foreach ($posts as $post)
    <article class="@if($loop->first) first @endif">
        <p>Post {{ $loop->iteration }} sur {{ $loop->count }}</p>
        <h2>{{ $post->title }}</h2>
    </article>
@endforeach
```

Propriétés utiles : `$loop->first`, `$loop->last`, `$loop->iteration`,
`$loop->count`.

**Documentation complète** :
<https://laravel.com/docs/12.x/blade#blade-directives>

### Création de vues avec Artisan

Laravel fournit une commande pour créer rapidement des vues :

```bash
php artisan make:view profile
```

Crée `resources/views/profile.blade.php`.

**Vues dans des sous-répertoires** :

```bash
php artisan make:view users.profile
```

Crée `resources/views/users/profile.blade.php`.

## Layout Blade

<!-- _class: lead -->

Un layout définit la structure de base d'une page (HTML, head, body, navigation,
footer) réutilisable sur plusieurs pages.

Évite la duplication de code et facilite la maintenance.

### Approche avec les composants

Laravel recommande d'utiliser des composants Blade pour créer des layouts :

```bash
php artisan make:component DefaultLayout
```

Crée deux fichiers :

- `app/View/Components/DefaultLayout.php` : classe du composant.
- `resources/views/components/default-layout.blade.php` : vue du composant.

### Structure d'un layout

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <nav><!-- Navigation --></nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer><!-- Footer --></footer>
</body>
</html>
```

`{{ $slot }}` : emplacement où le contenu spécifique sera inséré.

### Utilisation du layout

Pour utiliser le layout dans une vue :

```php
<x-default-layout>
    <h1>Page d'accueil</h1>
    <p>Bienvenue sur notre site !</p>
</x-default-layout>
```

Le contenu entre les balises est automatiquement inséré à l'emplacement de
`{{ $slot }}`.

Syntaxe : `<x-nom-du-composant>` (Laravel convertit automatiquement
`DefaultLayout` en `default-layout`).

## Slots par défaut et slots nommés

<!-- _class: lead -->

**Slot par défaut** : `{{ $slot }}` reçoit tout le contenu entre les balises.

**Slots nommés** : pour passer plusieurs sections de contenu à un composant.

### Définition de slots nommés

```php
{{-- Composant card --}}
<div class="card">
    <div class="card-header">
        {{ $header }}
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset
</div>
```

### Utilisation de slots nommés

```php
<x-card>
    <x-slot:header>
        <h2>Titre de la carte</h2>
    </x-slot:header>

    <p>Contenu principal de la carte.</p>

    <x-slot:footer>
        <button>Action</button>
    </x-slot:footer>
</x-card>
```

Syntaxe : `<x-slot:nom>` pour définir un slot nommé.

## Composants Blade

<!-- _class: lead -->

Les composants Blade sont des éléments d'interface réutilisables.

Évitent la duplication de code et facilitent la maintenance.

### Création d'un composant

```bash
php artisan make:component Alert
```

Crée deux fichiers :

- `app/View/Components/Alert.php` : classe du composant.
- `resources/views/components/alert.blade.php` : vue du composant.

### Vue du composant

Exemple de composant d'alerte (`resources/views/components/alert.blade.php`) :

```php
<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>
```

Définit la structure HTML avec une classe dynamique basée sur `$type`.

### Classe du composant

La classe définit les propriétés acceptées (`app/View/Components/Alert.php`) :

```php
<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{
    public function __construct(
        public string $type = 'info',
    ) {}

    public function render(): View
    {
        return view('components.alert');
    }
}
```

Propriété `$type` avec valeur par défaut `'info'`.

### Utilisation du composant et passage de propriétés

Utilisation du composant :

```php
<x-alert type="success">
    Votre profil a été mis à jour avec succès !
</x-alert>

<x-alert type="error">
    Une erreur s'est produite lors de l'enregistrement.
</x-alert>

<x-alert>
    Information générale (type par défaut : info).
</x-alert>
```

La propriété `public string $type` dans le constructeur permet de passer
l'attribut `type` au composant.

### Passer des variables à des composants

Pour passer des variables PHP (et non des chaînes) :

```php
@foreach ($posts as $post)
    <x-post-card :post="$post" :show-author="true" />
@endforeach
```

**Préfixe `:`** devant l'attribut indique une variable PHP.

Sans `:`, Laravel traite la valeur comme une chaîne littérale :

```php
{{-- Passe la chaîne "$post" au lieu de la variable --}}
<x-post-card post="$post" />

{{-- Passe la variable $post --}}
<x-post-card :post="$post" />
```

## Internationalisation (i18n)

<!-- _class: lead -->

L'internationalisation (i18n) est le processus de conception d'une application
pour qu'elle puisse être facilement adaptée à différentes langues et régions.

18 lettres entre le `i` et le `n` de _"internationalization"_.

### Pourquoi l'internationalisation est importante

Même pour une seule langue initialement :

- **Évolutivité** : facilite l'ajout de nouvelles langues.
- **Maintenance** : centralise tous les textes.
- **Professionnalisme** : sépare le code de la présentation.
- **Réutilisabilité** : permet de changer les textes sans toucher au code.

### Vocabulaire

- **Locale** : code langue + région (ex : `fr`, `fr_CH`, `en_US`).
- **Clé de traduction** : identifiant unique pour un texte traduisible.
- **Fichier de traduction** : fichier contenant les traductions pour une locale.
- **Fallback locale** : langue de secours si traduction manquante.

### Configuration de la locale

Configuration dans le fichier `.env` :

```text
APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
APP_FAKER_LOCALE=fr_FR
```

Référencées dans `config/app.php` :

```php
'locale' => env('APP_LOCALE', 'en'),
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),
```

### Fichiers de traduction

Organisés par langue dans `lang/` :

```text
lang/
├── fr/
│   ├── auth.php
│   ├── pagination.php
│   ├── passwords.php
│   ├── validation.php
│   └── ui.php
└── en/
    └── ...
```

Exemple `lang/fr/ui.php` :

```php
<?php
return [
    'home' => [
        'title' => 'Accueil',
        'welcome' => 'Bienvenue sur :appName',
    ],
];
```

### Utilisation des traductions dans les vues

Fonction `__()` pour récupérer une traduction :

```php
<h1>{{ __('ui.home.title') }}</h1>
<p>{{ __('ui.home.welcome', ['appName' => config('app.name')]) }}</p>
```

Notation point : `fichier.clé.sous-clé`.

Paramètres passés dans un tableau et référencés avec `:nom`.

Alternative : directive `@lang` :

```php
<h1>@lang('ui.home.title')</h1>
```

### Traductions au pluriel

Laravel gère automatiquement les formes plurielles :

```php
<p>{{ trans_choice('ui.posts.likes_count', $likesCount,
    ['count' => $likesCount]) }}</p>
```

Dans le fichier de traduction :

```php
'likes_count' => "{0} Aucun like|{1} :count like|[2,*] :count likes",
```

Laravel choisit automatiquement la forme appropriée selon le nombre.

## Gestion des dépendances avec Composer

<!-- _class: lead -->

Composer est le gestionnaire de dépendances de PHP (similaire à npm pour
JavaScript).

Permet d'installer des librairies externes pour faciliter le développement.

### Installation d'une dépendance

Commande `composer require` :

```bash
composer require laravel-lang/lang --dev
```

Option `--dev` : dépendance uniquement nécessaire en développement.

**Fichiers Composer** :

- `composer.json` : liste des dépendances et leurs versions.
- `composer.lock` : versions exactes installées (reproductibilité).
- `vendor/` : répertoire contenant toutes les dépendances.

### Librairie `laravel-lang/lang`

Fournit des traductions prêtes à l'emploi pour Laravel (80+ langues) :

```bash
# Installer la librairie
composer require laravel-lang/lang --dev

# Ajouter une langue
php artisan lang:add fr

# Mettre à jour les traductions
php artisan lang:update
```

Génère automatiquement les fichiers de traduction Laravel (auth, pagination,
passwords, validation).

Évite de tout traduire manuellement.

## Variables d'environnement

<!-- _class: lead -->

Les variables d'environnement permettent de configurer une application
différemment selon l'environnement (développement, test, production) sans
modifier le code.

### Le fichier `.env`

Contient les variables spécifiques à votre machine locale :

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

**Important** : jamais ajouté dans Git (`.gitignore`). Chaque développeur a son
propre `.env`.

### Le fichier `.env.example`

Modèle de fichier `.env` ajouté dans Git :

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

**Rôle** : documenter les variables nécessaires, fournir des exemples, faciliter
la configuration initiale.

### Bonnes pratiques

**Accès aux variables** :

```php
// Fonction env() - uniquement dans config/*.php
$appName = env('APP_NAME', 'Laravel');

// Fonction config() - dans le reste de l'application
$appName = config('app.name');
```

```php
{{-- Dans les vues Blade --}}
<title>{{ config('app.name') }}</title>
```

**Bonnes pratiques** :

- Mettre à jour `.env.example` quand vous ajoutez une variable.
- Utiliser des valeurs génériques dans `.env.example`.
- Ne jamais versionner `.env`.

## Tailwind CSS

<!-- _class: lead -->

Tailwind CSS est un framework CSS utilitaire qui permet de construire des
interfaces modernes rapidement en utilisant des classes CSS prédéfinies
directement dans le HTML.

### Approche CSS classique

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
```

### Approche avec Tailwind CSS

Classes utilitaires directement dans le HTML :

```html
<div class="bg-white rounded-lg p-5 shadow-md">
	<h2 class="text-2xl font-bold mb-3">Titre</h2>
	<p class="text-gray-600 leading-relaxed">Contenu de la carte.</p>
</div>
```

**Avantages** :

- Pas besoin d'inventer des noms de classes.
- Tout au même endroit.
- Système de design unifié.
- CSS minimal généré automatiquement.

### Comparaison

| Aspect       | CSS classique                  | Tailwind CSS                       |
| :----------- | :----------------------------- | :--------------------------------- |
| Nomenclature | Inventer des noms de classes   | Classes utilitaires prédéfinies    |
| Fichiers CSS | Fichiers CSS séparés           | CSS minimal généré automatiquement |
| Maintenance  | Recherche entre HTML et CSS    | Tout au même endroit               |
| Cohérence    | Risque de valeurs incohérentes | Système de design unifié           |
| Lisibilité   | HTML plus propre               | HTML plus verbeux                  |
| Courbe       | CSS standard                   | Apprendre les conventions          |

### Intégration avec Laravel et Vite

Vite est intégré dans Laravel pour gérer les dépendances et les processus de
build.

Compile les fichiers CSS et JavaScript (dont Tailwind CSS).

**Hot Module Replacement (HMR)** : rafraîchissement instantané des changements.

Inclure les assets dans les vues :

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

Pas besoin d'apprendre Vite en détail, mais important de comprendre son rôle.

### Aller plus loin avec Tailwind CSS (1)

**Contenu optionnel pour démarrer avec Tailwind CSS.**

**Design system intégré** :

- Espacements : `m-4`, `p-2`, `mx-auto`.
- Couleurs : `bg-blue-500`, `text-red-600`.
- Typographie : `text-xl`, `font-bold`.
- Ombres : `shadow-sm`, `shadow-md`, `shadow-lg`.
- Bordures : `border`, `rounded-lg`, `border-2`.

**Purge du CSS inutilisé** : génère un fichier CSS minimal contenant uniquement
les classes utilisées.

### Aller plus loin avec Tailwind CSS (2)

**Layout et espacement** :

```html
<!-- Display -->
<div class="block">...</div>
<div class="flex">...</div>
<div class="grid">...</div>

<!-- Flexbox -->
<div class="flex items-center justify-between">...</div>

<!-- Padding et margin -->
<div class="p-4 m-2">...</div>
<!-- padding: 1rem, margin: 0.5rem -->
```

**Documentation complète** : <https://tailwindcss.com/docs>

## Conclusion

<!-- _class: lead -->

Vous maîtrisez maintenant :

- Le rôle des vues dans le patron MVC.
- La création de vues avec Blade et ses directives.
- Les layouts et composants pour structurer vos applications.
- L'internationalisation pour supporter plusieurs langues.
- Les variables d'environnement pour configurer vos applications.
- Tailwind CSS pour styliser vos interfaces.

**Prochaine séance** : routes, paramètres et contrôleurs.

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- (Re)lire le contenu de cours.
- Faire les exercices.
- Faire le mini-projet.
- Poser des questions si nécessaire.

➡️ [Visualiser le contenu complet sur GitHub.][contenu-complet-sur-github]

**N'hésitez pas à vous entraidez si vous avez des difficultés !**

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration principale][illustration-principale] par
  [Richard Jacobs](https://unsplash.com/@rj2747) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-elephants-drinking-water-8oenpCXktqQ)
- [Illustration][illustration-objectifs] par
  [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  [Unsplash](https://unsplash.com/photos/low-angle-view-of-ball-shoots-in-the-ring-j6brni7fpvs)

---

- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

<!-- URLs -->

[contenu-complet-sur-github]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/tree/main/01-contenus-du-cours/04-vues-blade-et-tailwind-css/README.md
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
