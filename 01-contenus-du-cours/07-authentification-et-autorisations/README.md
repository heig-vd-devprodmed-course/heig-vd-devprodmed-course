# Authentification et autorisations

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
>   · [Présentation (PDF)][presentation-pdf].
> - Exercices : [Accéder au contenu](./01-exercices/README.md).
> - Mini-projet : [Accéder au contenu](./02-mini-projet/README.md).
>
> **Objectifs**
>
> À l'issue de cette séance, les personnes qui étudient devraient être capables
> de :
>
> - Comprendre les concepts d'authentification et d'autorisation.
> - Stocker et vérifier les mots de passe de manière sécurisée.
> - Utiliser les facades `Auth` et `Hash` de Laravel.
> - Implémenter un système d'inscription, de connexion et de déconnexion.
> - Définir et utiliser des gates et des policies pour gérer les autorisations.
> - Protéger des routes avec des middlewares d'authentification.
> - Associer les ressources (posts, likes) aux personnes authentifiées.
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
- [Avertissement](#avertissement)
- [Authentification et autorisations, un rappel](#authentification-et-autorisations-un-rappel)
  - [Authentification](#authentification)
  - [Autorisation](#autorisation)
  - [Stocker les mots de passe de manière sécurisée](#stocker-les-mots-de-passe-de-manière-sécurisée)
  - [Liens avec les sessions](#liens-avec-les-sessions)
- [Les classes Auth et Hash](#les-classes-auth-et-hash)
  - [Auth](#auth)
  - [Hash](#hash)
- [Gates, policies et middlewares d'autorisation](#gates-policies-et-middlewares-dautorisation)
  - [Gates](#gates)
  - [Policies](#policies)
  - [Middlewares](#middlewares)
  - [Combiner middlewares et policies](#combiner-middlewares-et-policies)
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [Questions d'évaluation](#questions-dévaluation)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs de permettre aux personnes qui étudient de
maîtriser les concepts liés à l'authentification et à l'autorisation dans le
développement d'applications web avec Laravel.

Ce contenu repose sur la documentation officielle suivante :

- <https://laravel.com/docs/12.x/authentication> et ses sous-sections.
- <https://laravel.com/docs/12.x/authorization> et ses sous-sections.
- <https://laravel.com/docs/12.x/hashing> et ses sous-sections.
- <https://laravel.com/docs/12.x/middleware> et ses sous-sections.
- <https://laravel.com/docs/12.x/session> et ses sous-sections.
- <https://laravel.com/docs/12.x/encryption> et ses sous-sections.

La liste complète des objectifs est disponible dans la section _"Objectifs"_ du
bloc d'information en haut de ce contenu.

## Avertissement

Il existe de multiples solutions pour implémenter l'authentification et
l'autorisation dans une application Laravel, entre autres en utilisant des
dépendances tierces telles que :

- [Laravel Fortify](https://laravel.com/docs/12.x/fortify).
- [Laravel Passport](https://laravel.com/docs/12.x/passport).
- [Laravel Sanctum](https://laravel.com/docs/12.x/sanctum).
- [Laravel Socialite](https://laravel.com/docs/12.x/socialite).

Par le passé, il était également possible d'utiliser des packages tiers tels que
Laravel Breeze et Laravel Jetstream, mais ces deux solutions ne sont plus
maintenues depuis la version 12 de Laravel (source :
<https://laravel.com/docs/12.x/releases#new-application-starter-kits>).

Toutes ces solutions ont pour but de faciliter l'implémentation de
l'authentification et de l'autorisation dans une application Laravel, mais elles
peuvent être complexes à comprendre et à utiliser pour les personnes qui
débutent dans le développement web ou qui souhaitent comprendre les concepts
fondamentaux de l'authentification et de l'autorisation avec Laravel.

De ce fait, dans ce contenu, nous allons utiliser les briques de base fournies
par Laravel pour implémenter l'authentification et l'autorisation, afin de
permettre aux personnes qui étudient de comprendre les concepts fondamentaux et
de maîtriser les outils de base avant d'utiliser des solutions plus complexes.

Lorsque vous aurez plus d'expérience avec Laravel et que vous serez à l'aise
avec les concepts fondamentaux, vous pourrez explorer les solutions tierces
mentionnées ci-dessus pour voir comment elles peuvent faciliter l'implémentation
de l'authentification et de l'autorisation dans vos applications Laravel.

## Authentification et autorisations, un rappel

Avant de plonger dans l'implémentation de l'authentification et des
autorisations avec Laravel, il est important de rappeler les concepts
fondamentaux de ces deux mécanismes de sécurité.

### Authentification

L'**authentification** est le processus qui permet de vérifier l'identité d'une
personne qui accède à un système. C'est la réponse à la question _"Qui êtes-vous
?"_.

Dans le contexte d'une application web, l'authentification permet de vérifier
que la personne qui tente de se connecter est bien celle qu'elle prétend être.

Pour ce faire, la personne doit fournir des informations d'identification
(credentials), généralement un nom d'utilisateur ou une adresse e-mail et un mot
de passe.

Le processus d'authentification typique dans une application web se déroule
comme suit :

1. La personne saisit ses informations d'identification dans un formulaire de
   connexion.
2. L'application vérifie que les informations fournies correspondent à un compte
   utilisateur existant dans la base de données.
3. Si les informations sont correctes, l'application crée une session pour la
   personne et la considère comme authentifiée.
4. La personne peut alors accéder aux ressources protégées de l'application tant
   que sa session est active.

L'authentification ne concerne que l'identité de la personne, pas ses droits
d'accès ou ses permissions. Une fois qu'une personne est authentifiée, elle est
simplement reconnue par le système, mais cela ne signifie pas qu'elle a le droit
d'accéder à toutes les ressources.

### Autorisation

L'**autorisation** est le processus qui permet de déterminer si une personne
authentifiée a le droit d'accéder à une ressource ou d'effectuer une action
spécifique. C'est la réponse à la question _"Qu'avez-vous le droit de faire ?"_.

L'autorisation intervient après l'authentification : une fois que le système
sait qui vous êtes, il détermine ce que vous pouvez faire en fonction de vos
permissions, rôles ou règles métier.

Par exemple :

- Une personne peut être authentifiée (elle s'est connectée avec succès), mais
  elle n'est pas autorisée à modifier un post qu'elle n'a pas créé.
- Une personne peut voir la liste de tous les posts (autorisation de lecture),
  mais seulement modifier ses propres posts (autorisation de modification
  conditionnelle).
- Une personne avec le rôle d'administrateur peut supprimer n'importe quel post,
  tandis qu'une personne avec le rôle d'utilisateur ne peut supprimer que ses
  propres posts.

Laravel fournit plusieurs outils pour implémenter l'autorisation, notamment les
**gates** (portes) et les **policies** (politiques), que nous verrons plus loin
dans ce contenu.

### Stocker les mots de passe de manière sécurisée

Stocker les mots de passe en clair (en texte brut) dans une base de données est
une pratique dangereuse et inappropriée. Si la base de données est compromise,
toutes les informations d'identification des personnes sont exposées et peuvent
être utilisées pour accéder à leurs comptes, non seulement sur votre
application, mais potentiellement aussi sur d'autres services si elles utilisent
le même mot de passe.

Pour protéger les mots de passe, il est essentiel de les **hacher** avant de les
stocker. Le hachage est une fonction à sens unique qui transforme une chaîne de
caractères (le mot de passe) en une chaîne de caractères de longueur fixe (le
hash) de manière irréversible. Cela signifie qu'il est théoriquement impossible
de retrouver le mot de passe original à partir du hash.

Voici les principes clés du hachage sécurisé des mots de passe :

1. **Fonction de hachage adaptée** : utiliser une fonction de hachage conçue
   spécifiquement pour les mots de passe, comme bcrypt ou Argon2 (toutes deux
   supportées par Laravel). Ces fonctions sont lentes par conception, ce qui
   rend les attaques par force brute très coûteuses en temps et en ressources.
2. **Salt (sel)** : ajouter une valeur aléatoire unique (salt) à chaque mot de
   passe avant de le hacher. Cela garantit que deux personnes avec le même mot
   de passe auront des hashes différents. Laravel utilise automatiquement les
   sels, donc vous n'avez pas à vous en soucier.
3. **Jamais de déchiffrement** : contrairement au chiffrement, le hachage est
   irréversible. Lors de la connexion, on ne compare jamais le mot de passe en
   clair stocké, mais on hache le mot de passe saisi et on compare les hashes.

**Exemple de cycle de vie d'un mot de passe** :

1. **Inscription** : la personne saisit un mot de passe → l'application le hache
   → le hash est stocké dans la base de données.
2. **Connexion** : la personne saisit son mot de passe → l'application récupère
   le hash stocké → l'application hache le mot de passe saisi → l'application
   compare les deux hashes → si les hashes correspondent, la connexion est
   réussie.

Laravel utilise par défaut bcrypt pour hacher les mots de passe, ce qui est une
excellente pratique de sécurité. La classe `Hash` de Laravel fournit des
méthodes simples pour hacher et vérifier les mots de passe de manière sécurisée.

### Liens avec les sessions

L'authentification et les sessions sont étroitement liées dans le développement
d'applications web. Une **session** est un mécanisme qui permet de maintenir
l'état d'une personne entre différentes requêtes HTTP.

HTTP est un protocole sans état (stateless), ce qui signifie que chaque requête
est indépendante et que le serveur ne se souvient pas des requêtes précédentes.
Pour pallier cette limitation et permettre à une personne de rester connectée
entre plusieurs pages ou requêtes, les applications web utilisent des sessions.

Voici comment fonctionnent les sessions dans le contexte de l'authentification :

1. **Création de session** : lorsqu'une personne se connecte avec succès,
   l'application crée une session et génère un identifiant de session unique
   (session ID).
2. **Stockage du session ID** : cet identifiant est généralement stocké dans un
   cookie sur le navigateur de la personne. À chaque requête ultérieure, le
   navigateur envoie automatiquement ce cookie au serveur.
3. **Identification de la personne** : le serveur utilise le session ID pour
   récupérer les données de session associées, y compris l'identifiant de la
   personne authentifiée, ce qui lui permet de savoir qui effectue la requête.
4. **Persistance de l'authentification** : tant que la session est active, la
   personne est considérée comme authentifiée et peut accéder aux ressources
   protégées sans avoir à se reconnecter à chaque requête.
5. **Expiration et déconnexion** : la session peut expirer après une période
   d'inactivité, ou la personne peut se déconnecter explicitement, ce qui
   détruit la session et supprime le cookie.

Laravel gère automatiquement les sessions et fournit des mécanismes pour stocker
les informations d'authentification dans la session. La classe `Auth` de Laravel
simplifie considérablement la gestion de l'authentification basée sur les
sessions.

## Les classes Auth et Hash

Laravel fournit plusieurs classes pour simplifier la gestion de
l'authentification et du hachage des mots de passe. Les deux principales classes
que nous allons utiliser sont `Auth` et `Hash`.

### Auth

La façade `Auth` est l'interface principale pour gérer l'authentification dans
Laravel. Elle fournit des méthodes pour connecter et déconnecter les personnes,
vérifier si une personne est authentifiée, et accéder aux informations de la
personne actuellement connectée.

Nous allons en explorer les méthodes les plus courantes pour gérer
l'authentification dans une application Laravel.

#### Vérifier si une personne est authentifiée

```php
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    // La personne est authentifiée
}
```

La méthode `check()` retourne `true` si une personne est actuellement
authentifiée, `false` sinon.

#### Obtenir la personne authentifiée

```php
$user = Auth::user();

if ($user) {
    echo "Bonjour, " . $user->username;
}
```

La méthode `user()` retourne l'instance du modèle `User` de la personne
actuellement authentifiée, ou `null` si aucune personne n'est connectée.

#### Connecter une personne

```php
use App\Models\User;

$user = User::find(1);
Auth::login($user);
```

La méthode `login()` connecte la personne en créant une session. Vous pouvez
également passer un second paramètre booléen pour activer la fonctionnalité "se
souvenir de moi" :

```php
Auth::login($user, $remember = true);
```

La fonctionnalité "se souvenir de moi" permet de maintenir la session active
même après la fermeture du navigateur, en utilisant un cookie persistant. Sans
cette option, la session expire lorsque le navigateur est fermé.

#### Tenter une connexion avec des informations d'identification

```php
$credentials = [
    'email' => 'john.doe@example.com',
    'password' => 'password123',
];

if (Auth::attempt($credentials)) {
    // La connexion a réussi
} else {
    // Les informations d'identification sont incorrectes
}
```

La méthode `attempt()` tente de connecter la personne avec les informations
d'identification fournies. Elle hache automatiquement le mot de passe et le
compare avec le hash stocké dans la base de données.

Vous pouvez également inclure la fonctionnalité "se souvenir de moi" :

```php
if (Auth::attempt($credentials, $remember = true)) {
    // Connexion réussie avec "se souvenir de moi"
}
```

Si la connexion réussit, la session est créée et la personne est considérée
comme authentifiée. Si les informations d'identification sont incorrectes, la
méthode retourne `false`.

#### Déconnecter une personne

```php
Auth::logout();
```

La méthode `logout()` déconnecte la personne en supprimant les informations de
session.

Lorsqu'une personne se déconnecte, il est également important de s'assurer que
les cookies de session sont invalidés pour éviter tout risque de réutilisation
de la session par un.e attaquant.e.

Pour cela, il est recommandé de régénérer l'identifiant de session après la
déconnexion :

```php
Auth::logout();

$request->session()->invalidate();
$request->session()->regenerateToken();
```

De cette manière, même si un cookie de session est volé après la déconnexion, il
ne pourra pas être utilisé pour accéder au compte de la personne.

#### Accéder à la personne via la requête

Dans les contrôleurs, vous pouvez également accéder à la personne authentifiée
via l'objet `Request` :

```php
public function update(Request $request)
{
    $user = $request->user();
    // ...
}
```

Cette méthode est équivalente à `Auth::user()` mais peut être plus pratique dans
le contexte d'un contrôleur.

### Hash

La classe `Hash` fournit des méthodes pour hacher et vérifier les mots de passe
de manière sécurisée. Laravel utilise par défaut bcrypt, mais vous pouvez
configurer d'autres algorithmes comme Argon2 (source :
<https://laravel.com/docs/12.x/hashing#hash-algorithm-verification>).

#### Hacher un mot de passe

```php
use Illuminate\Support\Facades\Hash;

$hashedPassword = Hash::make('password123');
```

La méthode `make()` hache le mot de passe en utilisant l'algorithme configuré
(bcrypt par défaut). Chaque appel à `make()` génère un hash différent pour le
même mot de passe grâce au salt aléatoire.

#### Vérifier un mot de passe

```php
if (Hash::check('password123', $hashedPassword)) {
    // Le mot de passe correspond
} else {
    // Le mot de passe ne correspond pas
}
```

La méthode `check()` compare un mot de passe en clair avec un hash et retourne
`true` s'ils correspondent, `false` sinon.

En utilisant la classe `Auth` mentionnée précédemment, vous n'avez généralement
pas besoin d'appeler `Hash::check()` directement, car `Auth::attempt()` s'en
charge automatiquement lors de la tentative de connexion.

## Gates, policies et middlewares d'autorisation

Maintenant que nous avons vu comment gérer l'authentification avec Laravel, nous
allons voir comment implémenter l'autorisation, c'est-à-dire comment contrôler
ce que les personnes authentifiées ont le droit de faire.

Laravel fournit trois mécanismes principaux pour gérer l'autorisation :

- **Gates (portes)** : des fonctions simples qui déterminent si une personne est
  autorisée à effectuer une action donnée.
- **Policies (politiques)** : des classes qui regroupent la logique
  d'autorisation pour un modèle spécifique. Il s'agit de la solution recommandée
  par Laravel.
- **Middlewares** : des filtres qui peuvent bloquer l'accès à des routes
  entières en fonction de l'authentification ou d'autres critères.

### Gates

Les **gates** sont des fonctions anonymes qui déterminent si une personne est
autorisée à effectuer une action particulière. Ils sont utiles pour des règles
d'autorisation simples qui ne sont pas nécessairement liées à un modèle
spécifique.

#### Définir un gate

Voici un exemple de gate simple qui vérifie si une personne est un.e
administrateur.trice :

```php
use Illuminate\Support\Facades\Gate;

Gate::define('admin', function ($user) {
    return $user->is_admin === true;
});
```

Ce gate nommé `'admin'` retourne `true` si la personne a l'attribut `is_admin`
défini à `true`, et `false` sinon.

#### Utiliser un gate

Une fois défini, vous pouvez vérifier un gate de plusieurs manières :

**Dans un contrôleur** :

```php
use Illuminate\Support\Facades\Gate;

if (Gate::allows('admin')) {
    // La personne est autorisée
}

if (Gate::denies('admin')) {
    // La personne n'est pas autorisée
}
```

**Autoriser ou interdire avec une exception** :

```php
Gate::authorize('admin'); // Lance une exception si non autorisé
```

Si la personne n'est pas autorisée, Laravel lance une exception
`AuthorizationException` qui génère automatiquement une réponse HTTP 403
(Forbidden).

**Dans une vue Blade** :

```php
@can('admin')
    <a href="/admin">Administration</a>
@endcan

@cannot('admin')
    <p>Vous n'avez pas accès à l'administration.</p>
@endcannot
```

### Policies

Les **policies** sont des classes qui organisent la logique d'autorisation
autour d'un modèle particulier. Elles sont particulièrement utiles lorsque vous
avez plusieurs règles d'autorisation liées au même modèle (par exemple, créer,
lire, mettre à jour, supprimer un post).

#### Créer une policy

Vous pouvez créer une policy avec la commande Artisan suivante :

```bash
php artisan make:policy PostPolicy --model=Post
```

Cette commande génère une classe `PostPolicy` dans le dossier `app/Policies/`
avec des méthodes pour les actions CRUD courantes.

En spécifiant `--model=Post`, Laravel pré-remplit la policy avec des méthodes
qui prennent une instance du modèle `Post` en paramètre, ce qui facilite la
définition de règles d'autorisation basées sur les propriétés du modèle.

#### Définir les règles dans une policy

Voici un exemple de `PostPolicy` qui autorise uniquement l'auteur.trice d'un
post à le modifier ou le supprimer :

```php
namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine if the given post can be updated by the user.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine if the given post can be deleted by the user.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
```

Chaque méthode de la policy reçoit deux paramètres :

1. `$user` : la personne qui tente d'effectuer l'action.
2. `$post` : le modèle sur lequel l'action est effectuée.

La méthode retourne `true` si l'action est autorisée, `false` sinon.

#### Utiliser une policy

Une fois la policy définie, vous pouvez l'utiliser de plusieurs manières :

**Dans un contrôleur** :

```php
public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);

    // Le code ici ne sera exécuté que si l'autorisation réussit
    $post->update($request->validated());

    return redirect('/posts/' . $post->id);
}
```

La méthode `authorize()` lance une exception `AuthorizationException` si la
personne n'est pas autorisée, ce qui génère automatiquement une réponse
HTTP 403.

**Avec Gate** :

```php
use Illuminate\Support\Facades\Gate;

if (Gate::allows('update', $post)) {
    // La personne peut modifier ce post
}
```

**Dans une vue Blade** :

```php
@can('update', $post)
    <a href="/posts/{{ $post->id }}/edit">Modifier</a>
@endcan

@can('delete', $post)
    <form method="POST" action="/posts/{{ $post->id }}">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
@endcan
```

### Middlewares

Les **middlewares** sont des filtres qui s'exécutent avant ou après une requête
HTTP. Ils sont particulièrement utiles pour protéger des routes entières en
fonction de l'authentification ou d'autres critères.

Laravel fournit plusieurs middlewares d'authentification et d'autorisation par
défaut. Nous allons voir comment utiliser le middleware `auth` pour protéger des
routes et s'assurer que seules les personnes authentifiées peuvent y accéder.

#### Le middleware `auth`

Le middleware `auth` vérifie que la personne est authentifiée avant d'autoriser
l'accès à une route. Si la personne n'est pas connectée, elle est redirigée vers
la page de connexion.

**Appliquer le middleware à une route** :

```php
Route::get('/my-profile', function () {
    // Accessible uniquement aux personnes authentifiées
})->middleware('auth');
```

**Appliquer le middleware à un groupe de routes** :

```php
Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [MyProfileController::class, 'show']);
    Route::get('/my-profile/edit', [MyProfileController::class, 'edit']);
    Route::put('/my-profile', [MyProfileController::class, 'update']);
});
```

**Appliquer le middleware dans un contrôleur** :

```php
Route::singleton('my-profile', MyProfileController::class)->destroyable()->middleware('auth');
```

### Combiner middlewares et policies

Vous pouvez combiner les middlewares et les policies pour une sécurité
renforcée. Par exemple, le middleware `auth` s'assure que la personne est
connectée, et la policy vérifie qu'elle a les permissions nécessaires pour
effectuer une action spécifique :

```php
Route::middleware('auth')->group(function () {
    Route::put('/posts/{post}', function (Post $post) {
        Gate::authorize('update', $post);
        // ...
    });
});
```

## Conclusion

Dans cette séance, nous avons exploré les concepts fondamentaux de
l'authentification et de l'autorisation dans le développement d'applications web
avec Laravel.

Nous avons vu que :

- L'**authentification** permet de vérifier l'identité d'une personne (_"Qui
  êtes-vous ?"_), tandis que l'**autorisation** détermine ce qu'elle peut faire
  (_"Qu'avez-vous le droit de faire ?"_).
- Les mots de passe doivent toujours être **hachés** avant d'être stockés dans
  la base de données pour des raisons de sécurité, et jamais stockés en clair.
- Les **sessions** permettent de maintenir l'état d'authentification d'une
  personne entre différentes requêtes HTTP.
- Laravel fournit des outils puissants pour gérer l'authentification et
  l'autorisation, notamment les facades `Auth` et `Hash`, les gates, les
  policies et les middlewares.
- Les **gates** sont des fonctions simples pour des règles d'autorisation
  générales, tandis que les **policies** organisent la logique d'autorisation
  autour de modèles spécifiques.
- Les **middlewares** permettent de protéger des routes entières en fonction de
  l'authentification ou d'autres critères.

Ces concepts sont essentiels pour construire des applications web sécurisées qui
protègent les données des personnes et garantissent que seules les personnes
autorisées peuvent effectuer certaines actions.

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

- Quelle est la différence entre authentification et autorisation ?
- Pourquoi ne doit-on jamais stocker les mots de passe en clair dans une base de
  données ?
- Comment Laravel maintient-il l'état d'authentification entre différentes
  requêtes HTTP ?
- Quelle est la différence entre `Auth::user()` et `$request->user()` ?
- Comment hacher un mot de passe avant de le stocker dans la base de données ?
- Quelle est la différence entre un gate et une policy ? En quoi une policy est
  plus flexible qu'un gate ?
- Quel middleware utiliser pour protéger une route et s'assurer que seules les
  personnes authentifiées peuvent y accéder ?
- Comment afficher un élément dans une vue Blade uniquement si la personne
  authentifiée a une permission spécifique ?
- Pourquoi est-il important de régénérer le session ID après une connexion
  réussie ?
- Pourquoi est-il important de régénérer le session ID après une déconnexion ?

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
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/07-authentification-et-autorisations/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/07-authentification-et-autorisations/07-authentification-et-autorisations-presentation.pdf
