# Jour 5

Aujourd'hui, nous allons aborder le thème des bases de données.

Pour nous faciliter le travail de développement nous allons utiliser SGBD le
plus utilisé au monde `SQLite`.

## [SQLite](https://www.sqlite.org/index.html)

`SQLite` est une bibliothèque écrite en langage C qui propose un moteur de base
de données relationnelle accessible par le langage SQL.

Contrairement aux serveurs de bases de données traditionnels, comme `MySQL` ou
`PostgreSQL`, sa particularité est de ne pas reproduire le schéma habituel
client-serveur mais d'être directement intégrée aux programmes. L'intégralité de
la base de données (déclarations, tables, index et données) est stockée dans un
fichier indépendant de la plateforme.

D. Richard Hipp, le créateur de `SQLite`, a choisi de mettre cette bibliothèque
ainsi que son code source en domaine public, ce qui permet son utilisation sans
restriction aussi bien dans les projets open source que dans les projets
propriétaires. Le créateur ainsi qu'une partie des développeurs principaux de
`SQLite` sont employés par la société américaine `Hwaci`.

`SQLite` est le moteur de base de données le plus utilisé au monde, grâce à son
utilisation dans de nombreux logiciels grand public comme `Firefox`, `Skype`,
`Google Gears`, dans certains produits d'`Apple`, d'`Adobe` et de `McAfee`, dans
les bibliothèques standards de nombreux langages comme `PHP` ou `Python`.

De par son extrême légèreté (moins de 600 Ko), il est également très populaire
sur les systèmes embarqués, notamment sur la plupart des smartphones et
tablettes modernes : les systèmes d'exploitation mobiles `iOS`, `Android` et
`Symbian` l'utilisent comme base de données embarquée. Au total, on peut
dénombrer plus d'un milliard de copies connues et déclarées de la bibliothèque.

## Scénario Application `Laravel`

Nous allons offrir la possibilité à un utilisateur de s'inscrire à une
newsletter. L'utilisateur sera invité à saisir son adresse mail via un
formulaire, puis `Laravel` traitera ce formulaire et stockera l'adresse mail
saisie par l'utilisateur dans notre base de donnée.

## Configuration

Avant de pouvoir utiliser `Laravel` avec une base de données, il faut :

- Configurer `Laravel`

  - Créons tout d'abord le fichier dans lequel la base de données sera stockée.
    Pour ce faire, le suffit de créer un fichier texte vide nommé
    `database.sqlite` dans le répertoire `\laravel\database` de notre
    application.

  - Indiquons maintenant à `Laravel` quel gestionnaire de base de données
    utiliser.

    Ceci se fait dans le dans le fichier `.env` que nous connaissons déjà
    (`c.f.` Configuration serveur messagerie) Editons le fichier `.env` et
    rechercher les lignes suivantes :

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```

    Une fois que nous avons trouvé ces lignes, modifions les ainsi :

    ```
    DB_CONNECTION=sqlite
    // A EFFACER DB_HOST=
    // A EFFACER DB_PORT=
    // A EFFACER DB_DATABASE=
    // A EFFACER DB_USERNAME=
    // A EFFACER DB_PASSWORD=
    ```

La configuration est terminée

## Création de la base de données `Sqlite`

Pour créer une base de données `Sqlite`, il nous suffit de créer un fichier
texte vide.

Créons un fichier texte nommé `database.sqlite` (nom que `Laravel` cherchera par
défaut) et plaçons ce fichier dans le répertoire `/database` de notre
application.

```
/database/
    	factories
    	migrations
    	seeders
    .gitignore
    database.sqlite          <===   voici notre base de données
```

## [Migration](https://laravel.com/docs/11.x/migrations)

Dans `Laravel`, une **migration** permet de créer et mettre à jour des tables
dans la base de données.

Nous allons pourvoir créer des tables, des colonnes, créer des index, etc. Tout
ce qui concerne la maintenance des tables d'une base de donnée peut être pris en
charge par une migration.

Nous allons maintenant lancer une commande qui va permettre à `Laravel` de créer
une nouvelle table nommée `migrations`.

> Cette table est nécessaire à `Laravel`. Nous n'interagirons pas directement
> avec cette table. C'est `Laravel`qui gère cette table. Notre job se limite à
> la créer.

Cette commande va permettre de vérifier que tout est configuré correctement.
Plaçons nous dans le bon répertoire ( `\laravel` ) puis tapons la commande :

```
php artisan migrate:install
```

Si tout s'est bien passé, le message suivant devrait s'afficher :

```
Migration table created successfully.
```

> Si tel n'est pas le cas, voici quelques pistes :
>
> - Tapez la commande :
>
>   ```
>   php artisan config:clear
>   ```
>
> - Est-ce que l'extension correspondant à `SQLite` dans le fichier `php.ini`
>   est-elle active ?
>
>   ```
>   extension=pdo_sqlite    //pas de ; devant cette ligne
>   extension=sqlite3       //pas de ; devant cette ligne
>   ```
>
> - La table 'migrations' est-elle déjà présente dans la base de données ?
>
>   Si oui, vous pouvez l'enlever. Il faut ouvrir le fichier texte
>   `database.sqlite` et supprimer son contenu, sauver et quitter.
>
> Remarque : La commande `php artisan migrate:install` ne se lance qu'une seule
> fois ! (Elle crée un table dans la base de données. Il ne faut donc créer à
> nouveau cette table)

### Création de la table 'emails'

Nous allons maintenant créer un fichier de `migration` qui permettra de créer la
table qui va contenir les adresses mail des utilisateurs qui désirent recevoir
notre newsletter.

Créons ce fichier à l'aide de la commande :

    php artisan make:migration creation_table_emails

Nous obtenons un nouveau fichier qui se trouve dans le répertoire

​ `\database\migrations\`

> Remarque : Dans ce répertoire il existe par défaut déjà trois autres
> `migrations` :
>
> - `0001_01_000000_create_users_table.php`
> - `0001_01_000001_create_cache_table.php`
> - `0001_01_000002_create_jobs_table.php`

```php
`2024_03_18_......_creation_table_emails.php` // celle que nous venons de créer
```

Editions le fichier que nous venons de créer : `..._creation_table_emails`

La méthode `up()` permet de créer la table `emails` ainsi que ses champs La
méthode `down()` permet de supprimer la table `emails`

Indiquons dans la méthode `up()` que nous désirons deux champs dans la table
`emails` :

- id (auto-incrémenté)
- email (de type texte et de longueur 100)

> [Liste des types disponibles](https://laravel.com/docs/11.x/migrations#available-column-types)

Indiquons dans la méthode `down()` que nous désirons supprimer la table `emails`
:

Voilà le code correspondant :

```php+HTML
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
```

Pour créer cette table (et d'autres) dans la base de données, il suffit exécuter
la migration à l'aide de la commande :

    php artisan migrate

> Cette commande effectue la méthode `up()` de toutes les migrations du
> répertoire. (En commençant par les plus anciennes !)

Le message suivant devrait s'afficher :

```
2024_03_18_......_creation_table_emails ............................................. 5.34ms DONE
```

> Pour revenir en arrière (lors d'erreurs par exemple) il suffit de lancer la
> commande :
>
> (Ceci effectuera la méthode `down()` )
>
> ```
> php artisan migrate:rollback
> ```

Voilà, notre base de données a été construite avec (entre autre) une table
`emails` contenant les deux champs :

- id (qui s'incrémentera automatiquement)
- email (pouvant contenir 100 caractères)

## [Création d'un modèle](https://laravel.com/docs/11.x/eloquent#generating-model-classes)

Nous allons maintenant créer une classe `modèle` et utiliser `Eloquent` qui est
un `ORM` (`Object-Relational Mapping`) intégré à `Laravel`.

Cette classe `modèle` va nous permettre de simplifier grandement les opérations
CRUD (`create`, `read`, `update`, `delete`) sur notre table `emails` en nous
affranchissant de devoir passer par le langage SQL.

Créons notre classe modèle à l'aide de la commande :

    php artisan make:model Email

Notre classe `Email.php` se trouve dans le répertoire ( `\app\Models` )

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
}
```

Complétons cette classe ainsi :

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $table='emails';
    public $timestamps=false;
}
```

On indique ici :

- le nom de la table associée à ce modèle. ( `protected $table='emails';` )
- que cette table ne possède pas de champs `created_at` et `updated_at` (
  `public $timestamps=false;` )

Le reste des opérations à effectuer nous est déjà familier.

Nous allons :

- créer une vue qui fournira un formulaire permettant de saisir un email,
- créer une classe (requête) permettant de valider le champ `email` du
  formulaire,
- créer une contrôleur pour fournir le formulaire et pour sauvegarder l'email
  dans la base de données,
- et enfin ajouter deux routes.

Créons tout d'abord le `template`. `template_newsletter.blade.php :`

```html
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width" />
		<title>@yield('titre')</title>
		<link
			media="all"
			type="text/css"
			rel="stylesheet"
			href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
		/>
		<link
			media="all"
			type="text/css"
			rel="stylesheet"
			href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
		/>
		<style>
			textarea {
				resize: none;
			}
		</style>
	</head>
	<body>
		@yield('contenu')
	</body>
</html>
```

Ensuite la vue qui fourni le formulaire. `view_newsletter_formulaire.blade.php`
:

```php+HTML
@extends('template_newsletter')

@section('titre')
Formulaire de saisie d'email
@endsection

@section('contenu')
<div class="col-sm-offset-4 col-sm-4">
  <div class="panel panel-info">
    <div class="panel-heading">Inscription à la lettre d'information</div>
    <div class="panel-body">
      <form method="POST" action="{{ url('newsletter') }}"
              accept-charset="UTF-8">
        @csrf
        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
          <input class="form-control"
                 placeholder="Entrez votre email" name="email" type="email" value="{{old('email')}}">
          {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>
        <input class="btn btn-info pull-right" type="submit" value="Envoyer !">
      </form>
    </div>
  </div>
<div>
@endsection
```

Puis celle qui indique que l'email a été traité.
`view_newsletter_confirm_inscription.blade.php`

```html
@extends('template_newsletter') @section('titre') Confirmation réception et
stockage email @endsection @section('contenu')
<br />
<div class="col-sm-offset-3 col-sm-6">
	<div class="panel panel-info">
		<div class="panel-heading">Inscription à la lettre d'information</div>
		<div class="panel-body">
			Merci. Vous allez prochainement recevoir de nos nouvelles
		</div>
	</div>
</div>
@endsection
```

Créons le fichier de validation pour le champ du formulaire (
`app\Http\Request\NewsletterRequest.php` ) à l'aide de la commande que vous
connaissez déjà et complétons le :

```php
//...

public function authorize(): bool {
	return true; // !!!!!!!!!!!!!!!!! NE PAS OUBLIER !!!!!!!!!!!!!!!!!!!!!
}

//...

public function rules(): array {
	return ['email'=>'required|email|unique:emails'];
}
```

> Remarquons au passage, la règle qui indique de l'email doit être unique dans
> la table 'emails'.

Créons maintenant le contrôleur ( `app\Http\Controllers\NewsletterController`)
et ajoutons les méthodes :

- `rendFormulaire()`
- `traiteformulaire()`

```php
//...

public function rendFormulaire() {
	return view('view_newsletter_formulaire');
}

public function traiteFormulaire(NewsletterRequest $request) {
    // sauvegarde de l'email dans la base de données
    $unModeleEmail = new Email();
	$unModeleEmail->email = $request->input('email');
	$unModeleEmail->save();

	return view('view_newsletter_confirm_inscription');
}

//...
```

> N'oublions pas les `uses` dans le contrôleur pour que `Laravel` sache où se
> trouvent les classes.
>
> - Un `use` pour la classe `NewsletterRequest`
> - Un `use` pour la classe `Email`

Il ne manque plus que les deux routes :

```php
Route::get('/newsletter', [NewsletterController::class, 'rendFormulaire']);
Route::post('newsletter', [NewsletterController::class, 'traiteFormulaire']);
```

Voilà, notre application est terminée.

Nous disposons maintenant d'un gestionnaire de newsletter fonctionnel

L'email saisi dans le formulaire a été stocké dans la base de données, mais
comment contrôler ???

Une des solutions (nous en verrons une autre lors du prochain cours) consiste à
installer le client graphique `DB Browser for SQLite`
[DB Browser](https://sqlitebrowser.org/dl/)

Une fois que le logiciel est installé, il suffit de le lancer et d'ouvrir la
base de donnée `database.sqlite` pour pouvoir visualiser toutes les tables qui
ont été créées

![DbBrowserForSqlite](img\DbBrowserForSqlite.png)

Le logiciel permet aussi de parcourir le contenu des différents champs des
tables (Exemple : table `emails`)

![tableEmails](img\tableEmails.png)

---

Petites réflexions :thinking:

- Que se passe-t-il si on soumet au serveur une adresse email déjà existante ?

---

Récapitulons les nouveautés du jour :

- Le fichier `.env` permet de configurer `Laravel` pour accéder au SGBD de notre
  choix. Attention à ne pas laisser ce fichier n'importe où (`Github` par
  exemple)
- La migration a permis de définir une nouvelle table et ses champs dans notre
  base de donnée.
- Le modèle `Email.php` est une classe qui fait le lien avec une table de la
  base de données.
- La méthode `save()` héritée de la classe (
  `Illuminate\Database\Eloquent\Model` ) par notre classe modèle `Email` permet
  de sauvegarder les données de notre objet dans la base de données sans avoir à
  utiliser le langage SQL.
