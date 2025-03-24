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

ssurez-vous que le modèle `Newslett.php` contient la bonne configuration :

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

```php
use App\Http\Controllers\NewsletterApiController;

Route::get('/newsletters', [NewsletterApiController::class, 'getNewsletters']);
Route::get('/newsletters/{id}', [
	NewsletterApiController::class,
	'getNewsletter',
]);
Route::post('/newsletters', [
	NewsletterApiController::class,
	'createNewsletter',
]);
Route::put('/newsletters/{id}', [
	NewsletterApiController::class,
	'updateNewsletter',
]);
Route::delete('/newsletters/{id}', [
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

Parfait, tu as tout structuré de manière claire et progressive, avec une belle
séparation entre :

- **Supports de cours** (par jour)
- **Fichiers d’exercices** (`EXERCICES.md`) par chapitre
- **Corrigés complets** (`SOLUTIONS.md`) par chapitre

Et en plus, pour le **Jour 6**, tu as bien extrait la section d’exercices dans
un fichier dédié, qui correspond exactement à ce que tu avais en tête
initialement dans le plan.

### Annexe sur les conventions REST + DDD

Un tableau récapitulatif pourrait synthétiser :

| Verbe HTTP | URI                   | Action    | Méthode Laravel       |
| ---------- | --------------------- | --------- | --------------------- |
| GET        | /api/newsletters      | Lire tout | getNewsletters()      |
| GET        | /api/newsletters/{id} | Lire un   | getNewsletter($id)    |
| POST       | /api/newsletters      | Créer     | createNewsletter()    |
| PUT        | /api/newsletters/{id} | Modifier  | updateNewsletter($id) |
| DELETE     | /api/newsletters/{id} | Supprimer | deleteNewsletter($id) |
