# Tailwind CSS, Blade et vues - Mini-projet

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
- [Prérequis](#prérequis)
- [Template de départ](#template-de-départ)
- [Installer et configurer Tailwind CSS](#installer-et-configurer-tailwind-css)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche)
  - [Installer Tailwind CSS](#installer-tailwind-css)
  - [Configurer Tailwind CSS](#configurer-tailwind-css)
  - [Importer Tailwind dans le CSS](#importer-tailwind-dans-le-css)
  - [Compiler les assets](#compiler-les-assets)
  - [Tester l'installation](#tester-linstallation)
  - [Valider et pousser les modifications](#valider-et-pousser-les-modifications)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement)
- [Configurer l'internationalisation](#configurer-linternationalisation)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-1)
  - [Créer les fichiers de traduction](#créer-les-fichiers-de-traduction)
  - [Configurer la locale par défaut](#configurer-la-locale-par-défaut)
  - [Tester les traductions](#tester-les-traductions)
  - [Valider et pousser les modifications](#valider-et-pousser-les-modifications-1)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche-1)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request-1)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement-1)
- [Créer le layout principal](#créer-le-layout-principal)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-2)
  - [Créer le fichier de layout](#créer-le-fichier-de-layout)
  - [Créer le composant navbar](#créer-le-composant-navbar)
  - [Créer le composant footer](#créer-le-composant-footer)
  - [Valider et pousser les modifications](#valider-et-pousser-les-modifications-2)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche-2)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request-2)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement-2)
- [Créer les composants réutilisables](#créer-les-composants-réutilisables)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-3)
  - [Créer le composant post-card](#créer-le-composant-post-card)
  - [Créer le composant user-avatar](#créer-le-composant-user-avatar)
  - [Valider et pousser les modifications](#valider-et-pousser-les-modifications-3)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche-3)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request-3)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement-3)
- [Créer la page d'accueil](#créer-la-page-daccueil)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-4)
  - [Créer la route](#créer-la-route)
  - [Créer la vue](#créer-la-vue)
  - [Tester la page](#tester-la-page)
  - [Valider et pousser les modifications](#valider-et-pousser-les-modifications-4)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche-4)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request-4)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement-4)
- [Créer la page de feed](#créer-la-page-de-feed)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-5)
  - [Créer la route](#créer-la-route-1)
  - [Créer la vue](#créer-la-vue-1)
  - [Tester la page](#tester-la-page-1)
  - [Valider et pousser les modifications](#valider-et-pousser-les-modifications-5)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche-5)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request-5)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement-5)
- [Créer la page de profil](#créer-la-page-de-profil)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-6)
  - [Créer la route](#créer-la-route-2)
  - [Créer la vue](#créer-la-vue-2)
  - [Tester la page](#tester-la-page-2)
  - [Valider et pousser les modifications](#valider-et-pousser-les-modifications-6)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche-6)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request-6)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement-6)
- [Créer la page de visualisation d'un post](#créer-la-page-de-visualisation-dun-post)
  - [Créer l'issue et la branche pour suivre cette tâche](#créer-lissue-et-la-branche-pour-suivre-cette-tâche-7)
  - [Créer la route](#créer-la-route-3)
  - [Créer la vue](#créer-la-vue-3)
  - [Tester la page](#tester-la-page-3)
  - [Valider et pousser les modifications](#valider-et-pousser-les-modifications-7)
  - [Créer la pull request pour cette tâche](#créer-la-pull-request-pour-cette-tâche-7)
  - [Valider et fusionner la pull request](#valider-et-fusionner-la-pull-request-7)
  - [Récupérer les modifications localement](#récupérer-les-modifications-localement-7)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Créer les vues nécessaires pour le réseau social en utilisant Tailwind CSS,
Blade et l'internationalisation avec Laravel.

À l'issue de ce mini-projet, vous devriez avoir :

- Installé et configuré Tailwind CSS dans votre projet Laravel.
- Configuré l'internationalisation (i18n) avec des fichiers PHP utilisant des
  clés de traduction.
- Créé un layout principal avec des composants réutilisables (navbar, footer).
- Créé des composants Blade pour afficher les posts et les avatars.
- Créé 4 pages fonctionnelles : accueil, feed, profil et visualisation d'un
  post.
- Intégré les modèles Eloquent avec les vues Blade pour afficher des données
  réelles.

Les pages de création, modification et suppression de posts seront réalisées
dans une prochaine séance lorsque nous aborderons les routes, les contrôleurs et
les formulaires.

## Prérequis

Avant de commencer ce mini-projet, assurez-vous d'avoir :

- Complété le mini-projet de la séance "Bases de données, Eloquent et modèles".
- Les modèles `User`, `Post` et `Like` créés avec leurs relations.
- Des données factices dans la base de données (seeders).
- Node.js et npm installés sur votre machine (pour compiler les assets).

## Template de départ

Pour ce mini-projet, un template de départ vous est fourni. Ce template contient
:

- La configuration de base de Tailwind CSS.
- Un layout principal avec navbar et footer.
- Des composants Blade de base (post-card, user-avatar).
- Les fichiers de traduction avec quelques clés d'exemple.
- Les routes de base pour les 4 pages à créer.

Ce template vous permettra de vous concentrer sur l'apprentissage de Blade et
l'intégration avec Eloquent plutôt que sur la configuration initiale.

> [!NOTE]
>
> Le template sera fourni par votre enseignant.e au début de la séance. Si vous
> souhaitez réaliser ce mini-projet en autonomie, vous pouvez suivre les
> instructions de ce document pour tout créer depuis zéro.

## Installer et configurer Tailwind CSS

Tailwind CSS est un framework CSS utilitaire qui permet de créer rapidement des
interfaces utilisateur personnalisées sans écrire de CSS traditionnel.

### Créer l'issue et la branche pour suivre cette tâche

Créez une nouvelle issue sur GitHub pour suivre cette tâche :

- **Titre** : Installer et configurer Tailwind CSS
- **Description** : Installer Tailwind CSS et le configurer pour le projet
  Laravel.
- **Labels** : `enhancement`, `setup`

Créez ensuite une nouvelle branche pour cette tâche :

```bash
git checkout -b feature/setup-tailwind
```

### Installer Tailwind CSS

Pour installer Tailwind CSS dans votre projet Laravel, exécutez la commande
suivante :

```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

Cette commande installe Tailwind CSS, PostCSS et Autoprefixer, puis crée les
fichiers de configuration `tailwind.config.js` et `postcss.config.js`.

### Configurer Tailwind CSS

Modifiez le fichier `tailwind.config.js` pour indiquer à Tailwind où trouver vos
fichiers de templates :

```javascript
/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
	theme: {
		extend: {},
	},
	plugins: [],
};
```

### Importer Tailwind dans le CSS

Modifiez le fichier `resources/css/app.css` pour importer les directives de
Tailwind :

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### Compiler les assets

Pour compiler les assets (CSS et JavaScript), exécutez la commande suivante :

```bash
npm run dev
```

Cette commande lance Vite en mode développement. Laissez cette commande
s'exécuter en arrière-plan pendant que vous travaillez sur votre projet.

### Tester l'installation

Pour tester que Tailwind CSS fonctionne correctement, créez une vue de test avec
quelques classes Tailwind.

Créez un fichier `resources/views/test.blade.php` :

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Tailwind</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold text-blue-600">
            Tailwind CSS fonctionne !
        </h1>
        <p class="mt-4 text-gray-700">
            Si vous voyez du texte bleu et un fond gris, Tailwind est bien installé.
        </p>
    </div>
</body>
</html>
```

Créez une route de test dans `routes/web.php` :

```php
Route::get('/test-tailwind', function () {
    return view('test');
});
```

Visitez `http://localhost:8000/test-tailwind` dans votre navigateur. Si vous
voyez le texte stylé, Tailwind CSS est correctement installé.

Une fois testé, supprimez le fichier de test et la route.

### Valider et pousser les modifications

Validez et poussez vos modifications :

```bash
git add .
git commit -m "Installer et configurer Tailwind CSS"
git push origin feature/setup-tailwind
```

### Créer la pull request pour cette tâche

Créez une pull request sur GitHub pour fusionner votre branche
`feature/setup-tailwind` dans la branche `main`.

- **Titre** : Installer et configurer Tailwind CSS
- **Description** : Installation et configuration de Tailwind CSS pour le projet
  Laravel.
- **Lien vers l'issue** : #[numéro de l'issue]

### Valider et fusionner la pull request

Une fois la pull request créée, validez-la et fusionnez-la dans la branche
`main`.

### Récupérer les modifications localement

Récupérez les modifications localement :

```bash
git checkout main
git pull origin main
```

## Configurer l'internationalisation

L'internationalisation (i18n) permet de créer des applications multilingues.
Laravel offre un système simple pour gérer les traductions.

### Créer l'issue et la branche pour suivre cette tâche

Créez une nouvelle issue sur GitHub pour suivre cette tâche :

- **Titre** : Configurer l'internationalisation
- **Description** : Créer les fichiers de traduction pour le français et
  l'anglais.
- **Labels** : `enhancement`, `i18n`

Créez ensuite une nouvelle branche pour cette tâche :

```bash
git checkout -b feature/setup-i18n
```

### Créer les fichiers de traduction

Laravel utilise des fichiers PHP pour les traductions. Créez la structure de
dossiers suivante :

```
resources/
  lang/
    fr/
      messages.php
    en/
      messages.php
```

Créez le fichier `resources/lang/fr/messages.php` avec le contenu suivant :

```php
<?php

return [
    // Navigation
    'nav.home' => 'Accueil',
    'nav.feed' => 'Fil d\'actualité',
    'nav.profile' => 'Profil',

    // Home page
    'home.title' => 'Bienvenue sur le réseau social',
    'home.subtitle' => 'Partagez vos pensées avec le monde',
    'home.cta' => 'Voir le fil d\'actualité',

    // Feed page
    'feed.title' => 'Fil d\'actualité',
    'feed.empty' => 'Aucun post pour le moment.',

    // Profile page
    'profile.title' => 'Profil de :name',
    'profile.posts' => 'Posts de :name',
    'profile.empty' => ':name n\'a pas encore publié de post.',

    // Post
    'post.by' => 'Par :author',
    'post.at' => 'le :date',
    'post.view' => 'Voir le post',
    'post.likes' => ':count j\'aime|:count j\'aime',

    // Post detail
    'post.detail.title' => 'Post de :author',
    'post.detail.back' => 'Retour au fil',

    // Common
    'common.loading' => 'Chargement...',
    'common.error' => 'Une erreur est survenue.',
];
```

Créez le fichier `resources/lang/en/messages.php` avec le contenu suivant :

```php
<?php

return [
    // Navigation
    'nav.home' => 'Home',
    'nav.feed' => 'Feed',
    'nav.profile' => 'Profile',

    // Home page
    'home.title' => 'Welcome to the social network',
    'home.subtitle' => 'Share your thoughts with the world',
    'home.cta' => 'View feed',

    // Feed page
    'feed.title' => 'Feed',
    'feed.empty' => 'No posts yet.',

    // Profile page
    'profile.title' => ':name\'s profile',
    'profile.posts' => ':name\'s posts',
    'profile.empty' => ':name hasn\'t posted anything yet.',

    // Post
    'post.by' => 'By :author',
    'post.at' => 'on :date',
    'post.view' => 'View post',
    'post.likes' => ':count like|:count likes',

    // Post detail
    'post.detail.title' => 'Post by :author',
    'post.detail.back' => 'Back to feed',

    // Common
    'common.loading' => 'Loading...',
    'common.error' => 'An error occurred.',
];
```

### Configurer la locale par défaut

Modifiez le fichier `config/app.php` pour définir la locale par défaut :

```php
'locale' => 'fr', // ou 'en' selon votre préférence

'fallback_locale' => 'en',

'available_locales' => ['fr', 'en'],
```

### Tester les traductions

Pour tester les traductions, créez une route de test dans `routes/web.php` :

```php
Route::get('/test-i18n', function () {
    return __('messages.home.title');
});
```

Visitez `http://localhost:8000/test-i18n` dans votre navigateur. Vous devriez
voir le titre traduit.

Pour changer la langue dynamiquement, vous pouvez utiliser :

```php
Route::get('/test-i18n/{locale}', function ($locale) {
    App::setLocale($locale);
    return __('messages.home.title');
});
```

Une fois testé, supprimez la route de test.

### Valider et pousser les modifications

Validez et poussez vos modifications :

```bash
git add .
git commit -m "Configurer l'internationalisation"
git push origin feature/setup-i18n
```

### Créer la pull request pour cette tâche

Créez une pull request sur GitHub pour fusionner votre branche
`feature/setup-i18n` dans la branche `main`.

### Valider et fusionner la pull request

Une fois la pull request créée, validez-la et fusionnez-la dans la branche
`main`.

### Récupérer les modifications localement

Récupérez les modifications localement :

```bash
git checkout main
git pull origin main
```

## Créer le layout principal

Le layout principal est le template de base qui sera utilisé par toutes les
pages de l'application. Il contient la structure HTML commune, la navbar et le
footer.

### Créer l'issue et la branche pour suivre cette tâche

Créez une nouvelle issue sur GitHub pour suivre cette tâche :

- **Titre** : Créer le layout principal
- **Description** : Créer le layout principal avec navbar et footer.
- **Labels** : `enhancement`, `views`

Créez ensuite une nouvelle branche pour cette tâche :

```bash
git checkout -b feature/create-layout
```

### Créer le fichier de layout

Créez le fichier `resources/views/layouts/app.blade.php` :

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Social Network')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <x-navbar />

    <!-- Main content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />
</body>
</html>
```

### Créer le composant navbar

Créez le fichier `resources/views/components/navbar.blade.php` :

```blade
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">
                Social Network
            </a>

            <!-- Navigation links -->
            <div class="flex space-x-6">
                <a href="{{ url('/') }}"
                   class="text-gray-700 hover:text-blue-600 transition">
                    {{ __('messages.nav.home') }}
                </a>
                <a href="{{ url('/feed') }}"
                   class="text-gray-700 hover:text-blue-600 transition">
                    {{ __('messages.nav.feed') }}
                </a>
            </div>

            <!-- Language switcher -->
            <div class="flex space-x-2">
                <a href="{{ url()->current() }}?lang=fr"
                   class="px-3 py-1 rounded {{ app()->getLocale() === 'fr' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    FR
                </a>
                <a href="{{ url()->current() }}?lang=en"
                   class="px-3 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    EN
                </a>
            </div>
        </div>
    </div>
</nav>
```

> [!NOTE]
>
> Le sélecteur de langue est une implémentation simple pour cette séance. Une
> implémentation plus robuste sera vue dans une prochaine séance avec les
> middlewares et les sessions.

### Créer le composant footer

Créez le fichier `resources/views/components/footer.blade.php` :

```blade
<footer class="bg-white shadow-md mt-auto">
    <div class="container mx-auto px-4 py-6">
        <div class="text-center text-gray-600">
            <p>&copy; {{ date('Y') }} Social Network. All rights reserved.</p>
            <p class="mt-2 text-sm">
                Made with ❤️ using Laravel and Tailwind CSS
            </p>
        </div>
    </div>
</footer>
```

### Valider et pousser les modifications

Validez et poussez vos modifications :

```bash
git add .
git commit -m "Créer le layout principal avec navbar et footer"
git push origin feature/create-layout
```

### Créer la pull request pour cette tâche

Créez une pull request sur GitHub pour fusionner votre branche
`feature/create-layout` dans la branche `main`.

### Valider et fusionner la pull request

Une fois la pull request créée, validez-la et fusionnez-la dans la branche
`main`.

### Récupérer les modifications localement

Récupérez les modifications localement :

```bash
git checkout main
git pull origin main
```

## Créer les composants réutilisables

Les composants Blade permettent de créer des éléments réutilisables pour éviter
la duplication de code.

### Créer l'issue et la branche pour suivre cette tâche

Créez une nouvelle issue sur GitHub pour suivre cette tâche :

- **Titre** : Créer les composants réutilisables
- **Description** : Créer les composants post-card et user-avatar.
- **Labels** : `enhancement`, `views`

Créez ensuite une nouvelle branche pour cette tâche :

```bash
git checkout -b feature/create-components
```

### Créer le composant post-card

Créez le fichier `resources/views/components/post-card.blade.php` :

```blade
@props(['post'])

<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
    <!-- Post header -->
    <div class="flex items-center mb-4">
        <x-user-avatar :user="$post->user" size="sm" />
        <div class="ml-3">
            <a href="{{ url('/@' . $post->user->username) }}"
               class="font-semibold text-gray-800 hover:text-blue-600">
                {{ $post->user->name }}
            </a>
            <p class="text-sm text-gray-500">
                {{ __('messages.post.at', ['date' => $post->created_at->format('d/m/Y H:i')]) }}
            </p>
        </div>
    </div>

    <!-- Post content -->
    <div class="mb-4">
        <p class="text-gray-800">{{ Str::limit($post->content, 200) }}</p>
    </div>

    <!-- Post footer -->
    <div class="flex items-center justify-between">
        <div class="text-sm text-gray-600">
            {{ trans_choice('messages.post.likes', $post->likes->count(), ['count' => $post->likes->count()]) }}
        </div>
        <a href="{{ url('/' . $post->id) }}"
           class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
            {{ __('messages.post.view') }} →
        </a>
    </div>
</div>
```

### Créer le composant user-avatar

Créez le fichier `resources/views/components/user-avatar.blade.php` :

```blade
@props(['user', 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'w-10 h-10 text-sm',
        'md' => 'w-16 h-16 text-xl',
        'lg' => 'w-24 h-24 text-3xl',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div class="{{ $sizeClass }} bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
    {{ strtoupper(substr($user->name, 0, 1)) }}
</div>
```

### Valider et pousser les modifications

Validez et poussez vos modifications :

```bash
git add .
git commit -m "Créer les composants post-card et user-avatar"
git push origin feature/create-components
```

### Créer la pull request pour cette tâche

Créez une pull request sur GitHub pour fusionner votre branche
`feature/create-components` dans la branche `main`.

### Valider et fusionner la pull request

Une fois la pull request créée, validez-la et fusionnez-la dans la branche
`main`.

### Récupérer les modifications localement

Récupérez les modifications localement :

```bash
git checkout main
git pull origin main
```

## Créer la page d'accueil

La page d'accueil est la première page que les visiteurs verront. Elle doit
présenter le réseau social et inviter à explorer le contenu.

### Créer l'issue et la branche pour suivre cette tâche

Créez une nouvelle issue sur GitHub pour suivre cette tâche :

- **Titre** : Créer la page d'accueil
- **Description** : Créer la page d'accueil du réseau social.
- **Labels** : `enhancement`, `views`

Créez ensuite une nouvelle branche pour cette tâche :

```bash
git checkout -b feature/create-home-page
```

### Créer la route

Modifiez le fichier `routes/web.php` pour définir la route de la page d'accueil
:

```php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
```

### Créer la vue

Créez le fichier `resources/views/home.blade.php` :

```blade
@extends('layouts.app')

@section('title', __('messages.home.title'))

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Hero section -->
    <div class="text-center py-16">
        <h1 class="text-5xl font-bold text-gray-800 mb-4">
            {{ __('messages.home.title') }}
        </h1>
        <p class="text-xl text-gray-600 mb-8">
            {{ __('messages.home.subtitle') }}
        </p>
        <a href="{{ url('/feed') }}"
           class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
            {{ __('messages.home.cta') }}
        </a>
    </div>

    <!-- Features section -->
    <div class="grid md:grid-cols-3 gap-8 mt-16">
        <div class="text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Connect</h3>
            <p class="text-gray-600">Connect with people around the world</p>
        </div>

        <div class="text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Share</h3>
            <p class="text-gray-600">Share your thoughts and ideas</p>
        </div>

        <div class="text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Engage</h3>
            <p class="text-gray-600">Like and interact with posts</p>
        </div>
    </div>
</div>
@endsection
```

### Tester la page

Démarrez le serveur de développement :

```bash
php artisan serve
```

Visitez `http://localhost:8000` dans votre navigateur. Vous devriez voir la page
d'accueil avec le hero section et les features.

### Valider et pousser les modifications

Validez et poussez vos modifications :

```bash
git add .
git commit -m "Créer la page d'accueil"
git push origin feature/create-home-page
```

### Créer la pull request pour cette tâche

Créez une pull request sur GitHub pour fusionner votre branche
`feature/create-home-page` dans la branche `main`.

### Valider et fusionner la pull request

Une fois la pull request créée, validez-la et fusionnez-la dans la branche
`main`.

### Récupérer les modifications localement

Récupérez les modifications localement :

```bash
git checkout main
git pull origin main
```

## Créer la page de feed

La page de feed affiche tous les posts de tous les utilisateurs du réseau
social.

### Créer l'issue et la branche pour suivre cette tâche

Créez une nouvelle issue sur GitHub pour suivre cette tâche :

- **Titre** : Créer la page de feed
- **Description** : Créer la page de feed pour afficher tous les posts.
- **Labels** : `enhancement`, `views`

Créez ensuite une nouvelle branche pour cette tâche :

```bash
git checkout -b feature/create-feed-page
```

### Créer la route

Modifiez le fichier `routes/web.php` pour définir la route de la page de feed :

```php
use App\Models\Post;

Route::get('/feed', function () {
    $posts = Post::with(['user', 'likes'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('feed', ['posts' => $posts]);
});
```

> [!NOTE]
>
> Nous utilisons ici une closure (fonction anonyme) dans la route pour
> simplifier le code. Dans une prochaine séance, nous verrons comment utiliser
> des contrôleurs pour gérer la logique de manière plus structurée.

### Créer la vue

Créez le fichier `resources/views/feed.blade.php` :

```blade
@extends('layouts.app')

@section('title', __('messages.feed.title'))

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            {{ __('messages.feed.title') }}
        </h1>
    </div>

    <!-- Posts list -->
    @if($posts->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-600">{{ __('messages.feed.empty') }}</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
    @endif
</div>
@endsection
```

### Tester la page

Visitez `http://localhost:8000/feed` dans votre navigateur. Vous devriez voir la
liste de tous les posts créés par vos seeders.

Si vous n'avez pas encore de posts, assurez-vous d'avoir exécuté les seeders :

```bash
php artisan db:seed
```

### Valider et pousser les modifications

Validez et poussez vos modifications :

```bash
git add .
git commit -m "Créer la page de feed"
git push origin feature/create-feed-page
```

### Créer la pull request pour cette tâche

Créez une pull request sur GitHub pour fusionner votre branche
`feature/create-feed-page` dans la branche `main`.

### Valider et fusionner la pull request

Une fois la pull request créée, validez-la et fusionnez-la dans la branche
`main`.

### Récupérer les modifications localement

Récupérez les modifications localement :

```bash
git checkout main
git pull origin main
```

## Créer la page de profil

La page de profil affiche les informations d'un utilisateur spécifique et ses
posts.

### Créer l'issue et la branche pour suivre cette tâche

Créez une nouvelle issue sur GitHub pour suivre cette tâche :

- **Titre** : Créer la page de profil
- **Description** : Créer la page de profil pour afficher un utilisateur et ses
  posts.
- **Labels** : `enhancement`, `views`

Créez ensuite une nouvelle branche pour cette tâche :

```bash
git checkout -b feature/create-profile-page
```

### Créer la route

Modifiez le fichier `routes/web.php` pour définir la route de la page de profil
:

```php
use App\Models\User;

Route::get('/@{username}', function ($username) {
    $user = User::where('username', $username)->firstOrFail();
    $posts = $user->posts()->with('likes')->orderBy('created_at', 'desc')->get();

    return view('profile', [
        'user' => $user,
        'posts' => $posts
    ]);
});
```

> [!NOTE]
>
> Le `@` dans l'URL est une convention commune pour les profils d'utilisateurs
> (comme Twitter/X ou Instagram). Laravel permet d'utiliser ce caractère dans
> les routes.

### Créer la vue

Créez le fichier `resources/views/profile.blade.php` :

```blade
@extends('layouts.app')

@section('title', __('messages.profile.title', ['name' => $user->name]))

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Profile header -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <div class="flex items-center">
            <x-user-avatar :user="$user" size="lg" />
            <div class="ml-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                <p class="text-gray-600">{{ '@' . $user->username }}</p>
                @if($user->bio)
                    <p class="mt-2 text-gray-700">{{ $user->bio }}</p>
                @endif
                <div class="mt-4 flex space-x-6 text-sm text-gray-600">
                    <div>
                        <span class="font-semibold text-gray-800">{{ $user->posts->count() }}</span>
                        {{ Str::plural('post', $user->posts->count()) }}
                    </div>
                    <div>
                        <span class="font-semibold text-gray-800">
                            {{ $user->posts->sum(fn($post) => $post->likes->count()) }}
                        </span>
                        {{ Str::plural('like', $user->posts->sum(fn($post) => $post->likes->count())) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User's posts -->
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('messages.profile.posts', ['name' => $user->name]) }}
        </h2>
    </div>

    @if($posts->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-600">
                {{ __('messages.profile.empty', ['name' => $user->name]) }}
            </p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
    @endif
</div>
@endsection
```

### Tester la page

Visitez `http://localhost:8000/@[username]` dans votre navigateur (remplacez
`[username]` par un nom d'utilisateur de votre base de données). Vous devriez
voir le profil de l'utilisateur et ses posts.

Par exemple, si vous avez un utilisateur avec le username `alice`, visitez
`http://localhost:8000/@alice`.

### Valider et pousser les modifications

Validez et poussez vos modifications :

```bash
git add .
git commit -m "Créer la page de profil"
git push origin feature/create-profile-page
```

### Créer la pull request pour cette tâche

Créez une pull request sur GitHub pour fusionner votre branche
`feature/create-profile-page` dans la branche `main`.

### Valider et fusionner la pull request

Une fois la pull request créée, validez-la et fusionnez-la dans la branche
`main`.

### Récupérer les modifications localement

Récupérez les modifications localement :

```bash
git checkout main
git pull origin main
```

## Créer la page de visualisation d'un post

La page de visualisation d'un post affiche un post spécifique avec tous ses
détails.

### Créer l'issue et la branche pour suivre cette tâche

Créez une nouvelle issue sur GitHub pour suivre cette tâche :

- **Titre** : Créer la page de visualisation d'un post
- **Description** : Créer la page pour afficher un post spécifique.
- **Labels** : `enhancement`, `views`

Créez ensuite une nouvelle branche pour cette tâche :

```bash
git checkout -b feature/create-post-page
```

### Créer la route

Modifiez le fichier `routes/web.php` pour définir la route de la page de
visualisation :

```php
Route::get('/{post}', function (Post $post) {
    $post->load(['user', 'likes.user']);

    return view('post', ['post' => $post]);
});
```

> [!NOTE]
>
> Nous utilisons ici le **route model binding** de Laravel. Laravel récupère
> automatiquement le post depuis la base de données en utilisant l'ID dans
> l'URL. Si le post n'existe pas, Laravel renvoie automatiquement une
> erreur 404.

### Créer la vue

Créez le fichier `resources/views/post.blade.php` :

```blade
@extends('layouts.app')

@section('title', __('messages.post.detail.title', ['author' => $post->user->name]))

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back button -->
    <div class="mb-6">
        <a href="{{ url('/feed') }}"
           class="text-blue-600 hover:text-blue-800 flex items-center">
            ← {{ __('messages.post.detail.back') }}
        </a>
    </div>

    <!-- Post detail -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <!-- Post header -->
        <div class="flex items-center mb-6">
            <x-user-avatar :user="$post->user" size="md" />
            <div class="ml-4">
                <a href="{{ url('/@' . $post->user->username) }}"
                   class="font-semibold text-xl text-gray-800 hover:text-blue-600">
                    {{ $post->user->name }}
                </a>
                <p class="text-gray-500">
                    {{ __('messages.post.at', ['date' => $post->created_at->format('d/m/Y H:i')]) }}
                </p>
            </div>
        </div>

        <!-- Post content -->
        <div class="mb-6">
            <p class="text-gray-800 text-lg leading-relaxed">{{ $post->content }}</p>
        </div>

        <!-- Post stats -->
        <div class="border-t pt-4">
            <div class="text-gray-600">
                {{ trans_choice('messages.post.likes', $post->likes->count(), ['count' => $post->likes->count()]) }}
            </div>

            <!-- Likes list -->
            @if($post->likes->isNotEmpty())
                <div class="mt-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">
                        Liked by:
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->likes as $like)
                            <a href="{{ url('/@' . $like->user->username) }}"
                               class="text-sm text-blue-600 hover:text-blue-800">
                                {{ $like->user->name }}
                            </a>
                            @if(!$loop->last)
                                <span class="text-gray-400">,</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
```

### Tester la page

Visitez `http://localhost:8000/[id]` dans votre navigateur (remplacez `[id]` par
l'ID d'un post de votre base de données). Vous devriez voir les détails complets
du post.

Par exemple, si vous avez un post avec l'ID `1`, visitez
`http://localhost:8000/1`.

### Valider et pousser les modifications

Validez et poussez vos modifications :

```bash
git add .
git commit -m "Créer la page de visualisation d'un post"
git push origin feature/create-post-page
```

### Créer la pull request pour cette tâche

Créez une pull request sur GitHub pour fusionner votre branche
`feature/create-post-page` dans la branche `main`.

### Valider et fusionner la pull request

Une fois la pull request créée, validez-la et fusionnez-la dans la branche
`main`.

### Récupérer les modifications localement

Récupérez les modifications localement :

```bash
git checkout main
git pull origin main
```

## Conclusion

Félicitations ! Vous avez terminé le mini-projet de la séance "Tailwind CSS,
Blade et vues".

Vous avez :

- ✅ Installé et configuré Tailwind CSS.
- ✅ Configuré l'internationalisation avec des clés de traduction.
- ✅ Créé un layout principal avec navbar et footer.
- ✅ Créé des composants Blade réutilisables.
- ✅ Créé 4 pages fonctionnelles intégrant les modèles Eloquent.
- ✅ Utilisé les directives Blade (@extends, @section, @foreach, @if, etc.).
- ✅ Appris à passer des données des routes aux vues.

Dans la prochaine séance, vous apprendrez à :

- Gérer les routes de manière plus structurée.
- Créer des contrôleurs pour séparer la logique.
- Gérer les paramètres de requêtes.
- Créer des formulaires pour le CRUD complet.
- Valider les données saisies par les utilisateurs.

## Solution

Une solution complète de ce mini-projet est disponible dans le dossier
[`solution/`](./solution/README.md).

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé le mini-projet.

Quelques idées pour aller plus loin :

1. **Pagination** : Ajouter la pagination sur la page de feed pour afficher les
   posts par groupes de 10.
   - Documentation : <https://laravel.com/docs/12.x/pagination>

2. **Recherche** : Ajouter une barre de recherche pour filtrer les posts par
   contenu ou par auteur.
   - Documentation : <https://laravel.com/docs/12.x/queries#where-clauses>

3. **Dark mode** : Ajouter un thème sombre avec Tailwind CSS.
   - Documentation : <https://tailwindcss.com/docs/dark-mode>

4. **Composants avancés** : Créer d'autres composants (modal, dropdown, tabs).
   - Documentation : <https://laravel.com/docs/12.x/blade#components>

5. **Animations** : Ajouter des animations avec les classes Tailwind CSS.
   - Documentation : <https://tailwindcss.com/docs/animation>

6. **Optimisation** : Utiliser le lazy loading pour les relations Eloquent.
   - Documentation :
     <https://laravel.com/docs/12.x/eloquent-relationships#lazy-eager-loading>

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
