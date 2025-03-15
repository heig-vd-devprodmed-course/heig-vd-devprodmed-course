## Questionnaire 7 (réponses)

01.) Qu'est ce qu'une relation de type 1:n dans le domaine de la base de donnée
?

> Une relation 1:n signifie qu'un enregistrement d'une table (T1) peut être
> référencée par plusieurs enregistrements d'une autre table (T2) Une personne
> peut avoir plusieurs voitures. Le lien entre la personne et la voiture est
> définie dans la table voiture par la clé étrangère id_personne
>
> ```
> personnes           voitures
> ═════════           ════════
> id ───────────┐     id
> nom           |     marque
> prénom        |     prix
>                  └───> id_personne
> ```

02.) Comment définit-on une clé étrangère dans une migration ?

> La clé étrangère se définit avec la méthode `foreign(...)` Ex :
>
> ```php
> $table->foreign('id_personne')->references('id')->on('personnes');
> ```

03.) Quel est le rôle d'un 'seeder' dans `Laravel` ?

> Un seeder une classe qui permet de peupler une table d'une base de donnée.
>
> ```php
> public function run(): void {
> 	for ($i = 1; $i <= 10; $i++) {
>      	User::create(['name' => 'Nom' . $i,
>                          'email' => 'email' . $i . '@gmx.ch',
>                          'password' => 'password' . $i,
>                          'admin' => rand(0, 1)]);
>        }
>    }
> ```
>
> pour exécuter la méthode run il faut lancer la commande :
>
> ```
> php artisan db:seed
> ```

04.) Lorsque l'on a plusieurs fichiers dans le répertoire `database\seeders`,
comment définit-on l'ordre d'exécution ?

> L'ordre est à définir dans la classe `app\database\seeders\DatabaseSeeder`
> dans la méthode `run()` Ex :
>
> ```php
> <?php
>
> namespace Database\Seeders;
>
> use App\Models\User;
> // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
> use Illuminate\Database\Seeder;
>
> class DatabaseSeeder extends Seeder
> {
> 	/**
> 	 * Seed the application's database.
> 	 */
> 	public function run(): void
> 	{
> 		$this->call(UsersTableSeeder::class);
> 		$this->call(ArticlesTableSeeder::class);
> 	}
> }
> ```

05.) Eloquent (l'outil ORM) a besoin de classe(s) modèle(s) pour pouvoir
interagir avec la base de données. Comment définit-on la relation `1:n` dans les
deux classes modèles (Un User peut créer plusieurs Article) ?

> La classe modèle correspondant au 1: doit contenir une méthode portant le nom
> de la table correspondant au :n au pluriel Ex :
>
> ```php
> public function articles() {   // dans la classe modèle User
> 	return $this->hasMany(App\Models\Article::class);
> }
> ```
>
> La classe modèle correspondant au :n doit contenir une méthode portant le nom
> de la table correspondant au 1: au singulier Ex :
>
> ```php
> public function user() {    // dans la classe modèle Article
> 	return $this->belongsTo(App\Models\User::class);
> }
> ```

06.) A quoi sert l'outil `tinker` dans `Laravel` ?

> Il sert à pouvoir exécuter directement des commandes Eloquent

07.) Quelle commande permet de lancer l'outil `tinker` ?

    php artisan tinker

08.) Quelle commande Eloquent permet de récupérer tous les articles de
l'utilisateur ayant l'identifiant : 12 ?

    App\Models\User::find(12)->articles

09.) Comment quitte-t-on l'outil `tinker` ?

> Il suffit de taper :
>
> ```
> quit
> ```

10.) Qu'est ce qu'un `middelware` ?

> Un middleware permet d'effectuer un traitement à l'arrivée ou au départ d'une
> requête. https://laravel.com/docs/11.x/middleware

11.) Quelle commande permet de créer un nouveau middleware ?

    php artisan make:middleware nom_du_middleware

12.) Quelle méthode doit-on implémenter dans le `middleware` pour que celui-ci
fonctionne correctement ?

> Il s'agit de la méthode `handle(...)`

13.) Comment gère-t-on l'authentification dans `Laravel` ?

> Il existe différentes solutions :
> [Documentation](https://laravel.com/docs/11.x/authentication)
>
> En voici une :
>
> (Une fois que `NodeJs` est installé)
>
> Il faut taper la commande : `composer require laravel/breeze --dev` (qui
> télécharge et installe la nouvelle libraire)
>
> puis la commande : `php artisan breeze:install blade` Crée/modifie les
> fichiers nécessaires (vues, contrôleurs, routes, middleware) dans notre
> application pour pouvoir faire une authentification. Tout est prêt !

14.) Après le login, on se retrouve sur une vue par défaut (`dashboard`)
indiquant que l'on est connecté. Comment changer la destination après le login ?

> Il faut changer les instructions de redirection dans deux classes :
>
> - `app/Http/Controllers/Auth/RegisteredUserController.php`
>
>   Changer la ligne 49 :
>
>   ```
>   return redirect(route('dashboard', absolute: false));
>   ```
>
>   en
>
>   ```
>   return redirect('/urlCheminDesire');
>   ```
>
> - `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
>
>   Changer la ligne 31 :
>
>   ```
>   return redirect()->intended(route('dashboard', absolute: false));
>   ```
>
>   en
>
>   ```
>   return redirect()->intended('/urlCheminDesire');
>   ```

15.) Idem 14.) mais après le `logout` ?

> Changer la ligne 46 du fichier
> `app/Http/Controllers/Auth/AuthenticatedSessionController.php` :
>
> ```
> return redirect('/');
> ```
>
> en
>
> ```
> return redirect('/urlCheminDesire');
> ```
