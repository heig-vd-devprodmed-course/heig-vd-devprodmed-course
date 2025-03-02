# Jour 5

Aujourd'hui, nous allons aborder le thème des bases de données.

## Démarrage du serveur de bases de données MySql

#### Windows : 

​	Avant de démarrer le serveur MySql, il faut ajouter une ligne à la fin du fichier de configuration ```my.ini```  	qui se trouve dans le répertoire : ```C:\ProgramData\MySQL\MySQL Server 8.0```	

```
default-time-zone = '+01:00'
```

​	Démarrons maintenant le serveur de base de données MySql.
​	Pour ce faire, nous allons démarrer le service correspondant de windows.
​	Cliquer sur l'icône Windows (En bas à droite de votre écran) et tapez : ```services``` puis la touche ```Enter```

​	La fenêtre suivante s'ouvre :![Services](img/Services.png)

​	Touche de droite de la souris sur ```MySQL80``` (ou le nom que vous lui avez donné lors de l'installation) puis
 	```Démarrer```

> ​	Remarque : Pour arrêter le serveur MySql, il faudra procéder de la même manière, 
> ​						  mais choisir l'option ```Arrêter```  (ne pas le faire maintenant ;-)

#### MacOs : 

​	Pour démarrer le serveur, il faut lancer la fenêtre du terminal puis taper : 
​		```brew services restart mysql```

> ​	Remarque : Pour arrêter le serveur 'MySql', taper :
>    ​						 ```brew services stop mysql``` (ne pas le faire maintenant ;-)



## Scénario

Nous allons offrir la possibilité à un utilisateur de s'inscrire à une newsletter.
L'utilisateur sera invité à saisir son adresse mail via un formulaire, puis Laravel traitera ce formulaire et stockera l'adresse mail saisie par l'utilisateur dans notre base de donnée.

## Configurations (MySql et Laravel)

Avant de pouvoir utiliser Laravel avec une base de données, il faut :

- Préparer le système de gestion de base de données (MySql)
  - Créer un nouvel utilisateur (laravel)
  - Créer une base de donnée vide
  - Donner tous les droits à l'utilisateur (laravel) sur cette nouvelle base de données
- Configurer Laravel 
  - Quel gestionnaire de base de données utiliser (MySql)
  - Quelle base de donnée doit-il utiliser
  - Quel utilisateur doit-il simuler (utiliser)

### Configuration de MySql

- Lancer en ligne de commande l'outil permettant de dialoguer avec le serveur de base de donnée MySql

  ```
  mysql -u root -p
  ```

  puis d'entrer le mot de passe administrateur.

 - Créer un nouvel utilisateur (correspondant à notre application Laravel)

   ```
   CREATE USER 'laravel'@'localhost'; 
   ```

- Attribuer un mot de passe à l'utilisateur ```laravel```

  ```
  ALTER USER 'laravel'@'localhost' IDENTIFIED WITH mysql_native_password BY 'laravelPsw';
  ```

 - Créer une nouvelle base de donnée dédiée à Laravel

   ```
   CREATE DATABASE dbLaravel;
   ```

 - Attribuer tous les droits à Laravel pour cette base de donnée

   ```
   GRANT ALL PRIVILEGES ON dbLaravel.* TO 'laravel'@'localhost';
   ```

- Quitter l'outil de dialogue mysql>

  ```
  exit
  ```

### Configuration de Laravel

La configuration du système de gestion de base de données utilisé par Laravel se fait dans le fichier ```.env``` que nous connaissons déjà (configuration du serveur de messagerie).

Il faut ouvrir celui-ci est rechercher les lignes suivantes :

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Une fois que nous avons trouvé ces lignes, il faut les compléter/modifier avec nos paramètres.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbLaravel
DB_USERNAME=laravel
DB_PASSWORD=laravelPsw
```

Les configurations sont terminées :smiley:

Il est maintenant temps d'aborder une nouvelle notion de Laravel : Les migrations

## Migration

Dans Laravel, une **migration** permet de créer et mettre à jour des tables dans la base de données.

Nous allons pourvoir créer des tables, des colonnes, créer des index, etc.
Tout ce qui concerne la maintenance des tables d'une base de donnée peut être pris en charge par une migration.

Nous allons maintenant lancer une commande qui va permettre à Laravel de créer une nouvelle table nommée 'migrations' dans MySql.

Cette commande va permettre de vérifier que tout est configuré correctement. Placer vous en ligne de commande dans le répertoire ( \laravel ) puis taper la commande :

```
php artisan migrate:install
```

Si tout se passe bien le message suivant devrait s'afficher :

```
Migration table created successfully.
```

> Si tel n'est pas le cas, voici quelques pistes :
>
> - Le serveur de base de données est-il en fonction ? (Il doit avoir été démarré ;-)
>
> - Est-ce que l'extension correspondant à MySql dans le fichier "php.ini" est-elle active ?
>
>   ```
>   extension=pdo_mysql		//il ne doit pas y avoir de ; devant cette ligne
>   ```
>
> - La table 'migrations' est-elle déjà présente dans la base de données dbLaravel ? 
>
>   Si oui, vous pouvez l'enlever
>
>   ```
>   mysql -u root -p
>   use dbLaravel;
>   show tables;
>   DROP table migrations;
>   exit
>   ```
>
> Remarque :  La commande ```php artisan migrate:install``` ne se lance qu'une seule fois !



## Configuration de netBeans pour MySQL Server

Il est possible de connecter le SGBD MySql à netBeans.

Pour faire ceci, il faut tout d'abord installer le driver JDBC de MySql Serveur ```mysql-connector-java-8.0.19.jar```  dans le répertoire ```C:\Program Files\NetBeans-11.2\netbeans\ide\modules\ext```

Après avoir lancé netBeans se rendre dans l'onglet ```Services```

![ServicesNetBeans](img/ServicesNetBeans.png)

Touche de droite de la souris sur "Databases" et choisir "New connection..."

Sélectionner le driver que l'on vient d'installer ( ```mysql-connector-java-8.0.19.jar``` ) puis renseigner les champs suivants : 

![NewConnectionWizard](img/NewConnectionWizard.png)

puis enfin sur le bouton "Finish"

Notre bases de données est disponible et nous pouvons constater que la table 'migration' s'y trouve

![Migrations](img/Migrations.png)

### Création de la table 'emails'

Nous allons maintenant créer un fichier de 'migration' qui permettra de créer la table qui va contenir les adresses mail des utilisateurs qui désirent recevoir notre 'newsletter'.

Créons ce fichier à l'aide de la commande :

	php artisan make:migration creation_table_emails

Nous obtenons un nouveau fichier qui se trouve dans le répertoire

​	```\database\migrations\```

Dans ce répertoire nous trouvons deux autres migrations qui sont là par défaut.

- 2014_10_12_000000_create_users_table			// par défaut
- 2019_08_19_000000_create_failed_jobs_table   // par défaut
- 2020_03_10_174243_creation_table_emails       // celle que nous venons de créer 

La méthode ```up()``` permet d'indiquer ce que l'on veut lors de la création de la table ```emails```
La méthode ```down()``` permet elle d'indiquer ce que l'on veut lors de la suppression de la table ```emails```

Indiquons dans la méthode ```up()``` que nous désirons deux champs dans la table ```emails``` :
 - id (auto-incrémenté)
 - email (de type texte et de longueur 100)

Indiquons dans la méthode ```down()``` que nous désirons supprimer la table ```emails``` :

Voilà le code correspondant :

```php+HTML
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreationTableEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}

```

Pour créer cette table dans la base de données, il suffit exécuter la migration à l'aide de la commande :

(Ceci effectuera la méthode ````up()```` )

	php artisan migrate

Le message suivant devrait s'afficher :

```
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (0.04 seconds)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (0.02 seconds)
Migrating: 2020_03_10_174243_creation_table_emails
Migrated:  2020_03_10_174243_creation_table_emails (0.03 seconds)
```

> Remarque : Il est possible qu'un message du style s'affiche : 
>
> ```
> Syntax error or access violation : 1071
> Specified key was too long; key length is 767 bytes.
> ```
>
> Il est alors nécessaire d'éditer le fichier (``` app/Providers/AppServiceProvider.php ``` ) et d'y ajouter :
>
> ```php
> use Illuminate\Support\Facades\Schema;
> 
> // ...
> 
> public function boot() {
> 	Schema::defaultStringLength(191);
> }
> ```

> Pour revenir en arrière (lors d'erreurs par exemple) il suffit de lancer la commande :
>
> (Ceci effectuera la méthode ```down()``` )
>
> ```
> php artisan migrate:rollback
> ```
>



## Création d'un modèle

Nous allons maintenant créer une classe ```modèle``` et utiliser Eloquent qui est un ORM (Object-Relational Mapping) intégré à Laravel.

Cette classe ```modèle``` va nous permettre de simplifier grandement les opérations CRUD (create, read, update, delete) sur notre table ```emails``` en nous affranchissant de devoir passer par le langage SQL.

Créons notre classe modèle à l'aide de la commande :

	php artisan make:model Email

Notre classe ```Email.php``` se trouve dans le répertoire ( ```\app``` )

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    //
}
```

Complétons cette classe ainsi :

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table='emails';
    public $timestamps=false;
}

```


On indique ici :

 - le nom de la table associée à ce modèle. ( protected $table='emails'; )
 - que cette table ne possède pas de champs  ```created_at``` et ```updated_at``` ( public $timestamps=false; )

Le reste des opérations à effectuer nous est déjà familier.

Nous allons :

 - créer une vue qui fournira un formulaire permettant de saisir un email,
 - créer une classe (requête) permettant de valider le champ ```email``` du formulaire, 
 - créer une contrôleur pour fournir le formulaire et pour sauvegarder l'email dans la base de données,
 - et enfin ajouter deux routes.

Créons tout d'abord le template ( templateEmail.blade.php ) :

```html
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width" initial-scale="1">
        <title>
            $yield('titre')
        </title>
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <style> textarea {resize:none} </style>
    </head>
    <body>
        @yield('contenu')
    </body>
</html>
```

Ensuite la vue qui fourni le formulaire ( vueRendFormulaireEmail.blade.php ) :

```php+HTML
@extends('templateEmail')

@section('titre')
Formulaire de saisie d'email
@endsection

@section('contenu')
<div class="col-sm-offset-4 col-sm-4">
  <div class="panel panel-info">
    <div class="panel-heading">Inscription à la lettre d'information</div>
    <div class="panel-body">
      <form method="POST" action="{{ url('email') }}" 
              accept-charset="UTF-8">
        @csrf
        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
          <input class="form-control" 
                 placeholder="Entrez votre email" name="email" type="email">
          {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>
        <input class="btn btn-info pull-right" type="submit" value="Envoyer !">
      </form>        
    </div>
  </div>
<div>
@endsection
```

Puis celle qui indique que l'email a été traité ( vueConfirmationInscription.blade.php )

```html
@extends('templateEmail')

@section('titre')
Confirmation réception et stockage email
@endsection

@section('contenu')
    <br>
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

Créons le fichier de validation pour le champ du formulaire ( app\Http\Request\EmailRequest.php ) à l'aide de la commande que vous connaissez déjà et complétons le :

```php
//...

public function authorize() {
	return true;
}

//...

public function rules() {
	return ['email'=>'required|email|unique:emails'];
}
```

> Remarquons au passage, la règle qui indique de l'email doit être unique dans la table 'emails'.
>

Créons maintenant le contrôleur ( app\Http\Controllers\EmailController ) et ajoutons les méthodes rendFormulaire() et traiteformulaire()

```php
//...

public function rendFormulaire() {
	return view('vueRendFormulaireEmail');
}

//...

public function traiteFormulaire(EmailRequest $request) {

	$unModeleEmail = new Email;
    $unModeleEmail->email = $request->input('email');
    $unModeleEmail->save();

    return view('vueConfirmationInscription');
}

//...
```

> N'oublions pas les ```uses``` dans le contrôleur pour que Laravel sache où se trouvent les classes.

Il ne manque plus que les deux routes :

```php
Route::get('email', 'EmailController@rendFormulaire');
Route::post('email','EmailController@traiteFormulaire');
```

Voilà, notre application est terminée.

Nous disposons maintenant d'un gestionnaire de 'newsletter' fonctionnel :-) 

Récapitulons les nouveautés du jour :

- Le fichier .env permet de configurer Laravel pour accéder à un SGBD.
- La migration a permis de définir une nouvelle table dans notre base de donnée.
- Le modèle Email.php est une classe qui fait le lien avec note nouvelle table.
- La méthode ```save()``` de la classe héritée ( Illuminate\Database\Eloquent\Model ) par notre classe modèle ```Email``` permet de sauvegarder les données de notre objet dans la base de données sans avoir à utiliser le langage SQL.