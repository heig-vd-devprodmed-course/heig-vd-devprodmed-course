# Bases de données, Eloquent et modèles - Exercices

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Toutes les informations relatives à ce contenu sont décrites dans le
> [contenu principal](../README.md).

## Table des matières

- [Table des matières](#table-des-matières).
- [Exercices](#exercices).
  - [Exercice 1](#exercice-1).
  - [Exercice 2](#exercice-2).
  - [Exercice 3](#exercice-3).
  - [Exercice 4](#exercice-4).

## Exercices

> [!NOTE]
>
> Bien que ces exercices puissent paraître simples et que leur solution est
> disponible dans ce même document, il est fortement recommandé de les réaliser
> sans consulter les solutions au préalable.
>
> Ils ont pour but de vous former et de pratiquer les concepts vus dans le
> contenu de cours.
>
> Il est donc important de les faire par vous-même avant de vérifier vos
> réponses avec les solutions fournies.

### Exercice 1

Où peut-on trouver dans la documentation officielle de Laravel la documentation
sur les bases de données et Eloquent ?

<details>
<summary>Afficher la solution</summary>

La documentation officielle de Laravel sur les bases de données et Eloquent se
trouve aux adresses suivantes :

- <https://laravel.com/docs/12.x/database>
- <https://laravel.com/docs/12.x/eloquent>

</details>

### Exercice 2

Créez une migration pour une table `animals` avec les colonnes suivantes :

- `id` (clé primaire).
- `name` (chaîne de caractères, max 255).
- `species` (texte long).
- `owner_id` (entier, clé étrangère vers la table `users`).
- `created_at` et `updated_at` (timestamps).

<details>
<summary>Afficher la solution</summary>

Exécutez la commande :

```bash
php artisan make:migration create_posts_table
```

Puis éditez le fichier de migration :

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->longText('content');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

Enfin, exécutez :

```bash
php artisan migrate
```

</details>

### Exercice 2

Créez un modèle Eloquent `Post` et configurez-le pour que les attributs `title`
et `content` puissent être assignés en masse.

<details>
<summary>Afficher la solution</summary>

Créez le modèle avec :

```bash
php artisan make:model Post
```

Puis éditez `app/Models/Post.php` :

```php
class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];
}
```

</details>

### Exercice 3

Écrivez le code Eloquent pour :

1. Créer un nouveau post avec le titre "Mon premier post" et le contenu "Ceci
   est mon premier post." pour l'utilisateur avec l'ID 1.
2. Récupérer tous les posts de l'utilisateur avec l'ID 1.
3. Mettre à jour le titre du post avec l'ID 1 en "Titre mis à jour".
4. Supprimer le post avec l'ID 1.

<details>
<summary>Afficher la solution</summary>

```php
// 1. Créer
Post::create([
    'title' => 'Mon premier post',
    'content' => 'Ceci est mon premier post.',
    'user_id' => 1,
]);

// 2. Récupérer
$posts = Post::where('user_id', 1)->get();

// 3. Mettre à jour
$post = Post::find(1);
$post->update(['title' => 'Titre mis à jour']);

// 4. Supprimer
Post::destroy(1);
```

</details>

### Exercice 4

Ajoutez une méthode `excerpt()` au modèle `Post` qui retourne les 100 premiers
caractères du contenu suivi de "...".

<details>
<summary>Afficher la solution</summary>

Éditez `app/Models/Post.php` :

```php
class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    public function excerpt(): string
    {
        return substr($this->content, 0, 100) . '...';
    }
}
```

Utilisation :

```php
$post = Post::find(1);
echo $post->excerpt();
```

</details>

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
