# Solutions - Jour 6 : Laravel CRUD, API et vues

Ce fichier propose des pistes de correction pour les exercices du support de
cours Jour 6.

## Table des matières

- [Table des matières](#table-des-matières)
- [A. Ajouter un champ "prénom" au modèle Newsletter](#a-ajouter-un-champ-prénom-au-modèle-newsletter)
  - [Migration](#migration)
  - [Modèle](#modèle)
  - [FormRequest (ajouté aux deux classes)](#formrequest-ajouté-aux-deux-classes)
  - [Vues + API :](#vues--api-)
- [B. Ajouter un système de confirmation](#b-ajouter-un-système-de-confirmation)
  - [Migration](#migration-1)
  - [Modèle](#modèle-1)
  - [Nouvelle route API](#nouvelle-route-api)
  - [Méthode dans NewsletterApiController](#méthode-dans-newsletterapicontroller)
- [C. Créer une nouvelle entité : Subscriber](#c-créer-une-nouvelle-entité--subscriber)
  - [Modèle et migration](#modèle-et-migration)
  - [Relation](#relation)
- [D. Ajouter une recherche (bonus)](#d-ajouter-une-recherche-bonus)
  - [Route API avec filtre](#route-api-avec-filtre)
  - [Méthode avec filtre](#méthode-avec-filtre)

## A. Ajouter un champ "prénom" au modèle Newsletter

### Migration

```php
// database/migrations/xxxx_add_firstname_to_newsletters_table.php
Schema::table('newsletters', function (Blueprint $table) {
	$table->string('firstname')->nullable();
});
```

### Modèle

```php
// app/Models/Newsletter.php
protected $fillable = ['firstname', 'email'];
```

### FormRequest (ajouté aux deux classes)

```php
'firstname' => 'nullable|string|max:50',
```

### Vues + API :

- Ajouter un champ `<input name="firstname">` dans le formulaire HTML
- Ajouter `firstname` dans les données du JSON si nécessaire

## B. Ajouter un système de confirmation

### Migration

```php
Schema::table('newsletters', function (Blueprint $table) {
	$table->timestamp('confirmed_at')->nullable();
});
```

### Modèle

```php
protected $casts = [
    'confirmed_at' => 'datetime',
];
```

### Nouvelle route API

```php
Route::post('/newsletters/{id}/confirm', [
	NewsletterApiController::class,
	'confirmNewsletter',
]);
```

### Méthode dans NewsletterApiController

```php
public function confirmNewsletter($id) {
    $newsletter = Newsletter::findOrFail($id);
    $newsletter->confirmed_at = now();
    $newsletter->save();

    return response()->json(['message' => 'Confirmation enregistrée']);
}
```

## C. Créer une nouvelle entité : Subscriber

### Modèle et migration

```bash
php artisan make:model Subscriber -m
```

Dans la migration :

```php
$table->id();
$table->string('email');
$table->foreignId('newsletter_id')->constrained()->onDelete('cascade');
$table->timestamps();
```

### Relation

```php
// Newsletter.php
public function subscribers() {
    return $this->hasMany(Subscriber::class);
}

// Subscriber.php
public function newsletter() {
    return $this->belongsTo(Newsletter::class);
}
```

Puis créer :

- Un contrôleur pour gérer CRUD Subscriber (via Vue ou API)
- Des vues simples ou endpoints REST

## D. Ajouter une recherche (bonus)

### Route API avec filtre

```php
Route::get('/newsletters', [NewsletterApiController::class, 'getNewsletters']);
```

### Méthode avec filtre

```php
public function getNewsletters(Request $request) {
    $search = $request->query('search');

    $query = Newsletter::query();

    if ($search) {
        $query->where('email', 'like', "%$search%")
              ->orWhere('firstname', 'like', "%$search%");
    }

    return response()->json($query->get());
}
```

Appel possible avec curl :

```bash
curl http://localhost:8000/api/newsletters?search=gmail
```
