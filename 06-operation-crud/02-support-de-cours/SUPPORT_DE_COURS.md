# Support de cours Laravel - Jour 6 : Opérations CRUD REST avec API et vues

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Présentation](#présentation)
- [Introduction à CRUD et REST](#introduction-à-crud-et-rest)
  - [Que signifie CRUD ?](#que-signifie-crud-)
  - [Qu'est-ce qu'une API REST ?](#quest-ce-quune-api-rest-)
- [Préparation du projet](#préparation-du-projet)
- [Architecture REST et bonnes pratiques](#architecture-rest-et-bonnes-pratiques)
  - [Endpoints (API)](#endpoints-api)
  - [Méthodes Laravel côté API](#méthodes-laravel-côté-api)
- [Modèle et Migration Newsletter](#modèle-et-migration-newsletter)
- [Contrôleurs Vue et API](#contrôleurs-vue-et-api)
- [FormRequest pour validation](#formrequest-pour-validation)
- [Routes web (Vue) et api (JSON)](#routes-web-vue-et-api-json)
- [Vues Blade (interface HTML)](#vues-blade-interface-html)
- [Contrôleur Vue : NewsletterViewController](#contrôleur-vue--newsletterviewcontroller)
- [Contrôleur API : NewsletterApiController](#contrôleur-api--newsletterapicontroller)
- [Tester l'API avec curl](#tester-lapi-avec-curl)
  - [Obtenir la liste des newsletters](#obtenir-la-liste-des-newsletters)
  - [Créer une nouvelle newsletter](#créer-une-nouvelle-newsletter)
  - [Voir une newsletter](#voir-une-newsletter)
  - [Mettre à jour une newsletter](#mettre-à-jour-une-newsletter)
  - [Supprimer une newsletter](#supprimer-une-newsletter)
- [Synthèse et bonnes pratiques REST](#synthèse-et-bonnes-pratiques-rest)
  - [Annexe sur les conventions REST + DDD](#annexe-sur-les-conventions-rest--ddd)
- [Ajouter une Formulaire de Suppression](#ajouter-une-formulaire-de-suppression)
  - [Exemple de Formulaire Blade (Supprimer une Newsletter)](#exemple-de-formulaire-blade-supprimer-une-newsletter)
  - [Explication de chaque partie :](#explication-de-chaque-partie-)
  - [Définition de la route (pour plus de clarté)](#définition-de-la-route-pour-plus-de-clarté)
  - [Méthode du contrôleur (Destruction)](#méthode-du-contrôleur-destruction)

## Objectifs

À l'issue de ce cours, les personnes qui étudient devraient être capables de :

- Identifier les différentes opérations CRUD dans une architecture REST.
- Appliquer les bonnes pratiques de nommage REST pour les routes et les
  méthodes.
- Différencier un contrôleur orienté Vue d'un contrôleur API.
- Implémenter chaque opération CRUD en Laravel avec Eloquent.
- Valider les données côté Vue et API avec les `FormRequest`.
- Utiliser `curl` pour tester une API Laravel.

## Présentation

Ce cours approfondit l'usage de Laravel pour créer une interface Vue + API REST
permettant de gérer une ressource courante : des inscriptions à une newsletter.

Il repose sur des pratiques professionnelles (REST, DDD, validation déportée,
réponses API claires) pour vous rendre autonomes sur un projet web moderne.

Ce cours repose sur le cours du jour 5 (base de données et ORM Eloquent).
N’hésitez pas à le relire avant d’aller plus loin.

Nous allons enrichir notre projet Laravel existant avec la gestion complète des
newsletters :

- En HTML (Vues Blade)
- En API REST (retours JSON)

Nous allons distinguer :

- `NewsletterViewController` pour le rendu des pages web.
- `NewsletterApiController` pour l'accès programmé via API REST.

## Introduction à CRUD et REST

### Que signifie CRUD ?

CRUD est un acronyme pour :

- **C**reate : Créer une ressource
- **R**ead : Lire (afficher) une ressource ou une liste de ressources
- **U**pdate : Mettre à jour une ressource existante
- **D**elete : Supprimer une ressource

Ces 4 opérations couvrent 90 % des interactions dans une application web : créer
un compte, afficher des articles, modifier une info, supprimer une ligne, etc.

### Qu'est-ce qu'une API REST ?

REST (Representational State Transfer) est un style d'architecture qui repose
sur :

- Des **URI** claires (ex: `/api/newsletters/42`)
- Des **verbes HTTP** bien définis :
  - `GET` : Lire
  - `POST` : Créer
  - `PUT` ou `PATCH` : Mettre à jour
  - `DELETE` : Supprimer
- Des réponses **stateless** (sans mémoire entre les appels)
- Des retours **JSON** standardisés (avec codes HTTP, données claires, messages)

Laravel propose nativement cette approche via ses routes `api.php` et ses
contrôleurs.

**Pour en savoir plus :**

- [REST sur MDN Web Docs](https://developer.mozilla.org/fr/docs/Glossary/REST)
- [Liste des codes HTTP](https://developer.mozilla.org/fr/docs/Web/HTTP/Status)

## Préparation du projet

Si vous avez suivi le jour 5, vous disposez déjà de :

- La base SQLite configurée dans `.env`
- Le modèle `Newsletter`

Et assurez-vous que votre base SQLite est créée dans `database/database.sqlite`.

## Architecture REST et bonnes pratiques

Un point clé de ce cours est le respect de la nomenclature REST.

### Endpoints (API)

- `GET /api/newsletters` => Liste des newsletters
- `POST /api/newsletters` => Création
- `GET /api/newsletters/{id}` => Détails
- `PUT /api/newsletters/{id}` => Mise à jour
- `DELETE /api/newsletters/{id}` => Suppression

### Méthodes Laravel côté API

- `getNewsletters()`
- `getNewsletter($id)`
- `createNewsletter(Request $request)`
- `updateNewsletter(Request $request, $id)`
- `deleteNewsletter($id)`

Côté Vue, les noms des méthodes suivent la même logique.

## Modèle et Migration Newsletter

Assurez-vous que le modèle `Newsletter.php` contient la bonne configuration :

```php
// app/Models/Newsletter.php
class Newsletter extends Model
{
	protected $fillable = ['email'];
}
```

Et que la migration contient au minimum :

```php
// database/migrations/xxxx_create_newsletters_table.php
Schema::create('newsletters', function (Blueprint $table) {
	$table->id();
	$table->string('email')->unique();
	$table->timestamps();
});
```

## Contrôleurs Vue et API

Nous créons deux contrôleurs :

```bash
php artisan make:controller NewsletterViewController
php artisan make:controller NewsletterApiController
```

## FormRequest pour validation

```bash
php artisan make:request NewsletterStoreRequest
php artisan make:request NewsletterUpdateRequest
```

**NewsletterStoreRequest**

```php
public function rules(): array
{
    return [
        'email' => 'required|email|unique:newsletters,email',
    ];
}
```

N'oubliez la méthode `authorize()` pour définir les permissions, elle doit
retourner `true` pour autoriser la validation.

**NewsletterUpdateRequest**

```php
public function rules(): array
{
    $id = $this->route('newsletter');
    return [
        'email' => 'required|email|unique:newsletters,email,' . $id,
    ];
}
```

## Routes web (Vue) et api (JSON)

**Fichier : routes/web.php**

```php
use App\Http\Controllers\NewsletterViewController;

Route::get('/newsletters', [NewsletterViewController::class, 'index'])->name(
	'newsletters.index'
);
Route::get('/newsletters/create', [
	NewsletterViewController::class,
	'create',
])->name('newsletters.create');
Route::post('/newsletters', [NewsletterViewController::class, 'store'])->name(
	'newsletters.store'
);
Route::get('/newsletters/{id}/edit', [
	NewsletterViewController::class,
	'edit',
])->name('newsletters.edit');
Route::delete('/newsletters/{id}/delete', [
	NewsletterViewController::class,
	'delete',
])->name('newsletters.delete');
```

**Fichier : routes/api.php**

Une `API`, ou `interface de programmation d’application`, permet de transmettre
des données entre des applications logicielles d’une manière standardisée. De
nombreux services offrent des `API` publiques qui permettent à quiconque
d’envoyer et de recevoir du contenu issu de ces services. Les `API` qui
fonctionnent sur Internet en utilisant des URL `http://` sont appelées des
`API web`. Donc grâce au Web, on peut envoyer une "demande" à une `API` pour
obtenir des informations.

Par exemple une `API` peut :

- mettre à disposition une carte géographique d'après des coordonnées
- mettre à disposition les prévisions météo d'après un nom de ville
- stocker des informations GPS en vue d'afficher une localisation sur une carte
- rendre le nom, prénom et téléphone du responsable

L'avantage d'une `API` c'est que cela permet l'interopérabilité entre
différentes plateformes et différents langages. Une `API` peut-être avoir été
écrit à l'aide d'un langage X (par exemple `php` sur une plateforme mac) et peut
être consommé par un langage Y (par exemple java sur une plateforme `windows`)

On s'affranchi ainsi des problèmes de compatibilités (de plateformes et
langages) :slightly_smiling_face:

Dans les versions précédente à `Lavarel 11` tout ce qui était nécessaire pour la
création d'une `API` était installé par défaut. Ce n'est plus le cas depuis
`Laravel 11` (ce qui permet d'alléger l'installation de base).

La commande suivante permet d'installer tout ce dont nous avons besoin :

```bash
php artisan install:api
```

Nous allons maintenant créer une route, mais cette fois-ci nous n'allons pas la
créer dans le fichier `web.php`, mais dans le fichier `api.php` qui vient d'être
installé et qui se trouve dans le même répertoire (`/routes`)

> Remarque :
>
> - Les routes pour les applications-web => `web.php`
> - Les routes pour les `API` => `api.php`

Voici le fichier `\routes\api.php` tel qu'il est par défaut :

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');
```

Nous allons le modifier pour y ajouter nos routes :

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterApiController;

Route::get('newsletters', [NewsletterApiController::class, 'getNewsletters']);
Route::get('newsletters/{id}', [
	NewsletterApiController::class,
	'getNewsletter',
]);
Route::post('newsletters', [
	NewsletterApiController::class,
	'createNewsletter',
]);
Route::put('newsletters/{id}', [
	NewsletterApiController::class,
	'updateNewsletter',
]);
Route::delete('newsletters/{id}', [
	NewsletterApiController::class,
	'deleteNewsletter',
]);
```

## Vues Blade (interface HTML)

Voir les exemples du **Jour 5** pour :

- `resources/views/newsletters/index.blade.php`
- `.../create.blade.php`
- `.../edit.blade.php`

Ajoutez un layout commun `resources/views/template.blade.php` avec Bootstrap.

## Contrôleur Vue : NewsletterViewController

```php
public function index() {
    $newsletters = Newsletter::all();
    return view('newsletters.index', compact('newsletters'));
}

public function create() {
    return view('newsletters.create');
}

public function store(NewsletterStoreRequest $request) {
    Newsletter::create($request->validated());
    return redirect()->route('newsletters.index')->with('success', 'Newsletter ajoutée.');
}

public function edit($id) {
    $newsletter = Newsletter::findOrFail($id);
    return view('newsletters.edit', compact('newsletter'));
}

public function update(NewsletterUpdateRequest $request, $id) {
    $newsletter = Newsletter::findOrFail($id);
    $newsletter->update($request->validated());
    return redirect()->route('newsletters.index')->with('success', 'Newsletter mise à jour.');
}

public function destroy($id) {
    Newsletter::findOrFail($id)->delete();
    return redirect()->route('newsletters.index')->with('success', 'Newsletter supprimée.');
}
```

## Contrôleur API : NewsletterApiController

```php
public function getNewsletters() {
    return response()->json(Newsletter::all());
}

public function getNewsletter($id) {
    return response()->json(Newsletter::findOrFail($id));
}

public function createNewsletter(NewsletterStoreRequest $request) {
    $newsletter = Newsletter::create($request->validated());
    return response()->json($newsletter, 201);
}

public function updateNewsletter(NewsletterUpdateRequest $request, $id) {
    $newsletter = Newsletter::findOrFail($id);
    $newsletter->update($request->validated());
    return response()->json($newsletter);
}

public function deleteNewsletter($id) {
    Newsletter::findOrFail($id)->delete();
    return response()->json(null, 204);
}
```

## Tester l'API avec curl

Pour tester une API, vous avez plusieurs outils :

- **Postman** (application graphique avec historique et collections)
- **Hoppscotch** (anciennement Postwoman, alternative en ligne légère)
- **curl** (en ligne de commande, idéal pour apprendre les bases)

Nous utiliserons ici `curl`, qui fonctionne dans tout terminal (Mac, Linux,
Windows avec WSL ou Git Bash).

### Obtenir la liste des newsletters

```bash
curl http://localhost:8000/api/newsletters
```

### Créer une nouvelle newsletter

```bash
curl -X POST http://localhost:8000/api/newsletters \
  -H "Content-Type: application/json" \
  -d '{"email": "test@example.com"}'
```

### Voir une newsletter

```bash
curl http://localhost:8000/api/newsletters/1
```

### Mettre à jour une newsletter

```bash
curl -X PUT http://localhost:8000/api/newsletters/1 \
  -H "Content-Type: application/json" \
  -d '{"email": "updated@example.com"}'
```

### Supprimer une newsletter

```bash
curl -X DELETE http://localhost:8000/api/newsletters/1
```

> Astuce : Si votre API renvoie un code d'erreur comme `422`, cela signifie
> souvent que la validation a échoué. Assurez-vous de respecter les contraintes
> définies dans le `FormRequest`.

## Synthèse et bonnes pratiques REST

- Utilisez **des noms de ressources au pluriel** dans vos routes
  (`/newsletters`)
- Utilisez les **bons verbes HTTP**
- Retournez toujours des **codes de statut HTTP explicites** (`200`, `201`,
  `204`, `404`, `422`)
- Distinguez clairement **API** et **vues** (deux contrôleurs)
- Centralisez la **validation avec des FormRequest**
- Testez en `curl` ou avec des outils comme Postman ou Hoppscotch
- Ajoutez systématiquement une **gestion des erreurs** propre (ex :
  `findOrFail`)
- Le retour JSON des API inclut toujours un code HTTP explicite
- Les contrôleurs sont spécialisés (Vue vs API)
- Les `FormRequest` centralisent la validation des données

### Annexe sur les conventions REST + DDD

Un tableau récapitulatif pourrait synthétiser :

| Verbe HTTP | URI                   | Action    | Méthode Laravel       |
| ---------- | --------------------- | --------- | --------------------- |
| GET        | /api/newsletters      | Lire tout | getNewsletters()      |
| GET        | /api/newsletters/{id} | Lire un   | getNewsletter($id)    |
| POST       | /api/newsletters      | Créer     | createNewsletter()    |
| PUT        | /api/newsletters/{id} | Modifier  | updateNewsletter($id) |
| DELETE     | /api/newsletters/{id} | Supprimer | deleteNewsletter($id) |

## Ajouter une Formulaire de Suppression

Dans Laravel, la suppression d'une ressource via un formulaire implique de
spécifier la méthode HTTP DELETE via le spoofing de formulaire. Voici comment
vous pouvez l'implémenter de manière claire et efficace.

### Exemple de Formulaire Blade (Supprimer une Newsletter)

Voici un exemple de formulaire Blade pour supprimer une ressource de newsletter
:

```blade
<form
	method="POST"
	action="{{ route('newsletters.delete', ['id' => $newsletter->id]) }}"
>
	@csrf
	<!-- Protects against Cross-Site Request Forgery -->
	@method('DELETE')
	<!-- Specifies the HTTP DELETE method -->

	<input
		type="submit"
		value="Delete"
		class="btn btn-danger btn-block"
		onclick="return confirm('Are you sure you want to delete this newsletter?');"
	/>
</form>
```

### Explication de chaque partie :

- **`method="POST"`** : Les formulaires HTML ne supportent que les méthodes GET
  et POST directement. Pour utiliser DELETE (ou PUT/PATCH), Laravel utilise le
  spoofing de méthode.
- **`action="{{ route('newsletters.delete', ['id' => $newsletter->id]) }}"`** :
- Cela génère une URL vers la route Laravel responsable de la suppression
  (`DELETE /newsletters/{id}/delete`). Assurez-vous que la route existe et
  pointe vers la méthode correcte (`destroy`) dans votre contrôleur Vue
  (`NewsletterViewController`).
- **`@csrf`** : Directive intégrée de Laravel qui génère un jeton pour prévenir
  les attaques de falsification de requête inter-sites (CSRF).
- **`@method('DELETE')`** : Cette directive indique à Laravel d'interpréter la
  soumission du formulaire comme une requête DELETE, même si elle est
  techniquement envoyée en tant que POST.
- **`onclick="return confirm('Are you sure...?');"`** : Fournit une invite de
  confirmation pour éviter les suppressions accidentelles.

### Définition de la route (pour plus de clarté)

Assurez-vous que votre route dans `routes/web.php` est définie clairement :

```php
Route::delete('/newsletters/{id}/delete', [
	NewsletterViewController::class,
	'destroy',
])->name('newsletters.delete');
```

### Méthode du contrôleur (Destruction)

La méthode correspondante dans votre contrôleur pourrait ressembler à ceci :

```php
public function destroy($id)
{
    Newsletter::findOrFail($id)->delete();

    return redirect()->route('newsletters.index')->with('success', 'Newsletter deleted successfully.');
}
```

Cette approche fournit un flux de travail complet, de la soumission du
