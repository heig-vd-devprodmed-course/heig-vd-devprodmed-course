# Marche à suivre

## Créer un projet vide avec `Laravel 11` permettant l'authentification (`breeze avec blade`) et `Sqlite` comme SGBD

> La base de données `database.sqlite` contient déjà un certain nombre de tables
> car l'exécution des migrations a déjà été faite.

Comme nous allons modifier la table `users` supprimons là de la base de données.

```
php artisan migrate:rollback
```

## Mise à jour de la table `users`

Dans la donnée, il est spécifié qu'il y a un administrateur doit être avertir
lors d'une mise à jour du tableau des trois meilleurs scores. Il existe déjà une
migration pour la table `users` dans `Laravel`, mais celle-ci ne comporte pas de
champ pour spécifier qu'un utilisateur peut être un administrateur. Il faut donc
ajouter un champ `admin` de type booléen. De plus, l'`id` d'un `user` ne
s'incrémente pas par défaut et nous n'utiliserons pas les deux champs
`timestamps`

Editons le fichier
`database\migrations\0001_01_01_000000_create_users_table.php` pour apporter les
modifications suivantes.

```php
...
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // L'id s'incrémente automatiquement
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('admin')->default(false); // Par défaut pas administrateur
            $table->rememberToken();
        });
    }
...
```

## Ajout d'une nouvelle table `scores`

Si l'utilisateur est authentifié, on doit pouvoir afficher ses différents
scores.

Comme un utilisateur peut avoir plusieurs scores, il faut donc implémenter une
relation `1:n`

Il faut une nouvelle table "scores" contenant :

- la date à laquelle a été effectué le score
- le pourcentage de bonnes réponses,
- le temps effectué
- et enfin l'identifiant de l'utilisateur à qui correspond le score

```
php artisan make:migration create_scores_table
```

Editer le fichier qui vient d'être créé et l'adapter à nos besoins :

```php
...
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->dateTime('effectue_le');
            $table->float('pourcentageBonnesReponses');
            $table->float('nbSecondes');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
        });
    }
...
```

## Créations des nouvelles tables dans le SGBD

```
php artisan migrate
```

## Implémentation des classes-"modèles"

Pour qu'Eloquent puisse fonctionner avec la table "scores", il faut ajouter le
modèle `Score` et y implémenter la relation `1:n`

```
php artisan make:model Score
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Score extends Model {

    use HasFactory;

    protected $table = 'scores';
    public $timestamps = false;
    protected $fillable = ['effectue_le', 'pourcentageBonnesReponses', 'nbSecondes', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
```

Il faut aussi adapter la classe modèle `User` pour mettre à jour la propriété
`$fillable` et terminer l'implémentation de la relation `1:n`

```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Score;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

	public function scores() {
        return $this->hasMany(Score::class);
    }
}
```

## Peuplement des tables pour faciliter les tests (`Seed`)

Pour tester que nos tables correspondent à nos besoins, peuplons la table
`users` et la table `scores` avec quelques données :

```
php artisan make:seeder UsersTableSeeder
```

```php
...
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        // Il n'y a qu'un admin
        DB::table('users')->insert([
            'name' => 'Nom1',
            'email' => 'email1@gmx.ch',
            'password' => 'password1',
            'admin' => 1]);
        for ($i = 2; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name' => 'Nom' . $i,
                'email' => 'email' . $i . '@gmx.ch',
                'password' => 'password' . $i,
                'admin' => 0]);
        }
    }
}
```

```
php artisan make:seeder ScoresTableSeeder
```

```php
...
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScoresTableSeeder extends Seeder
{
    private function randDate() {
        return Carbon::createFromDate(2022, rand(1,12), rand(1,28));
    }

    public function run(): void
    {
        DB::table('scores')->delete();
        for ($i=1; $i<=3; $i++) {
            $date=$this->randDate();
            DB::table('scores')->insert([
                'effectue_le'=>$date,
                'pourcentageBonnesReponses'=>100,
                'nbSecondes'=>rand(44,500),
                'user_id'=>rand(1,3),
            ]);
        }
    }
}
```

Remarque : Il ne faut pas oublier de définir l'ordre d'exécution des `Seeders`
dans le fichier existant `DatabaseSeeder.php`

```php
...
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ScoresTableSeeder::class);
    }
...

```

Il faut maintenant exécuter ces différents codes à l'aide de la commande :

```
php artisan db:seed
```

## Tests pour déterminer si la relation `1:n` fonctionne

A l'aide de l'outil `tinker` nous pouvons faire quelques requêtes Eloquent pour
contrôler que l'implémentation que nous avons effectué fonctionne. Pour lancer
`tinker` :

```
php artisan tinker
```

Pour récupérer les données de l'admin :

```
App\Models\User::where('admin', 1)->first();
```

Pour récupérer les données des utilisateurs qui ne sont pas admin :

```
App\Models\User::where('admin', 0)->get();
```

Pour récupérer tous les scores :

```
App\Models\Score::get();
```

Pour récupérer tous les scores de la personne ayant l'identifiant 3 :

```
App\Models\User::find(3)->scores;
```

Pour récupérer tous les scores triés par nombre de secondes :

```
App\Models\Score::orderBy('nbSecondes','ASC')->get();
```

Pour récupérer les trois meilleurs scores triés par nombre de secondes :

```
App\Models\Score::orderBy('nbSecondes','ASC')->take(3)->get();
```

Pour récupérer les scores de l'utilisateur ayant l'identifiant 3 trié par nombre
de secondes :

```
App\Models\Score::where('user_id','3')->orderBy('nbSecondes','ASC')->get();
```

Pour récupérer les noms des utilisateurs dont l'identifiant est 1,3 ou 5 :

```php
App\Models\User::whereIn('id', array(1, 3, 5))->get('/name');
```

Pour récupérer les trois meilleurs scores des utilisateurs ayant répondu juste à
toutes les questions (100%) : (Avec les différentes étapes pour y arriver)

```
App\Models\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->get();
```

```
App\Models\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->get('/user_id');
```

```
App\Models\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->get(['user_id','nbSecondes']);
```

```
App\Models\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->with('user')->get();
```

```
App\Models\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->with('user')->join('users', 'users.id', '=', 'scores.user_id')->get(['effectue_le','users.name','nbSecondes']);
```

## Création des `routes` et du contrôleur :

Tout est prêt au niveau des données, il faut maintenant passer aux traitements.

Pour créer un nouveau contrôleur :

```
php artisan make:controller ScoreController --resource
```

Pour accéder aux différentes méthodes de notre contrôleur nous pouvons créer des
routes dans le fichier `web.php`

```php
...
use App\Http\Controllers\ScoreController;
...

Route::get('/', [ScoreController::class, 'index']);
Route::resource('score', ScoreController::class, ['except'=>['show','edit','update','delete','create']]);

...
```

Remarque : Nous n'utiliserons pas les méthodes
`show, edit, update, delete et create`, nous pouvons donc les enlever du
contrôleur. (Nous aurions pu créer un contrôleur "conventionnel" et y ajouter
deux routes )

Ajoutons maintenant la logique dans notre contrôleur :

```php
...
use App\Http\Requests\ScoreRequest;
use Carbon\Carbon;
use App\Models\Score;

class ScoreController extends Controller
{
    public function index() {
        return view('view_page1')->with('tableauMeilleursScores',
                $this->rendTableauMeilleursScores());
    }

    public function store(ScoreRequest $request) {
        $resultats = $this->traiteReponses($request);
        if (\Auth::check()) {
            $dateTime = Carbon::now()->toDateTimeString();
            $inputs = array_merge($request->all(), [
                'user_id' => $request->user()->id,
                'effectue_le' => $dateTime,
                'pourcentageBonnesReponses' => $resultats['pourcentage'],
                'nbSecondes' => $resultats['nbSecondes']]);
            $ancienTableauScores = $this->rendTableauMeilleursScores();
            Score::create($inputs);
            $nouveauTableauScores = $this->rendTableauMeilleursScores();
            $this->envoieMailSiNecessaire($ancienTableauScores,
                    $nouveauTableauScores);
            $scores = $this->rendListeScores($request);
            return view('view_page3')->with(['resultats' => $resultats,
                                        'scores' => $scores]);
        } else {
            $scores = [];
            return view('view_page3')->with('resultats', $resultats);
        }
    }

    public function rendPage2() {
        $questions = $this->rendQuestions();
        $tempsDepart = Carbon::now();
        return view('view_page2')->with(['questions' => $questions, 'tempsDepart' => $tempsDepart]);
    }

    private function traiteReponses(ScoreRequest $request): array {
        $reponses = $request->input('reponses');
        $questions = $request->input('questions');

        $tempsDepart = $request->input('tempsDepart');
        $tempsFin = Carbon::now();
        $nbSecondes = number_format($tempsFin->diffInMilliseconds($tempsDepart) / 1000, 2, '.', '');

        $nbQuestions = 0;
        $nbReponsesCorrectes = 0;
        foreach ($reponses as $cle => $valeur) {
            $reponseJuste = eval('return ' . $questions[$cle] . ';');
            $correction = ($valeur == $reponseJuste) ? 'juste' : 'faux';
            if ($valeur == $reponseJuste) {
                $nbReponsesCorrectes++;
            } else {
                $reponseFausse = $valeur;
            }
            $nbQuestions++;
            $resultat = ['question' => $questions[$cle],
                'reponse' => $valeur,
                'correction' => $correction,
                'reponseJuste' => $reponseJuste];
            $resultatsQR[] = $resultat;
        }

        $pourcentageBonnesReponses = round($nbReponsesCorrectes / $nbQuestions * 100);
        $ratio = $nbReponsesCorrectes . '/' . $nbQuestions;
        $texte = "Vous avez répondu correctement à $pourcentageBonnesReponses% des questions ($ratio) en $nbSecondes secondes";
        $resultats = ['QR' => $resultatsQR, 'pourcentage' => $pourcentageBonnesReponses, 'ratio' => $ratio, 'nbSecondes' => $nbSecondes, 'synthese' => $texte];
        return $resultats;
    }

    private function rendTableauMeilleursScores() {
        $meilleursScores = Score::where('pourcentageBonnesReponses', 100)->orderBy('nbSecondes', 'ASC')->take(3)->with('user')->join('users', 'users.id', '=', 'scores.user_id')->get(['effectue_le', 'users.name', 'nbSecondes']);
        $tableau = [];
        foreach ($meilleursScores as $score) {
            $date = Carbon::parse($score->effectue_le)->format('d.m.Y H:m');
            $user = $this->rendTroisLettres($score->name);
            $nbSecondes = $score->nbSecondes;
            $nbMin = intdiv($nbSecondes, 60);
            $nbSec = $nbSecondes % 60;
            $temps = $nbMin . ' m ' . $nbSec . ' s';
            $ligne = ['date' => $date, 'user' => $user, 'temps' => $temps];
            $tableau[] = $ligne;
        }
        return $tableau;
    }

    private function rendListeScores(ScoreRequest $request) {
        $userId = $request->user()->id;
        //$userId = 10;
        $scores = Score::where('user_id', $userId)->orderBy('pourcentageBonnesReponses', 'DESC')->orderBy('nbSecondes')->get();

        $listeScores = [];
        foreach ($scores as $score) {
            $date = Carbon::parse($score->effectue_le)->format('d.m.Y H:m');
            $nbSecondes = $score->nbSecondes;
            $nbMin = intdiv($nbSecondes, 60);
            $nbSec = $nbSecondes % 60;
            $temps = $nbMin . ' m ' . $nbSec . ' s';
            $pourcentage = $score->pourcentageBonnesReponses . '%';
            $listeScores[] = ['date' => $date, 'temps' => $temps, 'pourcentage' => $pourcentage];
        }
        return $listeScores;
    }

    private function envoieMailSiNecessaire($ancienTableauScores, $nouveauTableauScores) {
        if ($ancienTableauScores !== $nouveauTableauScores) {
            Mail::send('view_mail', ['tableauMeilleursScores' => $nouveauTableauScores], function($message) {
                $message->to('jean-pierre.hess@bluewin.ch')->subject('Laravel (Contact)');
            });
        }
    }

    private function rendTroisLettres($nom): string {
        return strtoupper($nom[0] . $nom[intdiv(strlen($nom), 2) - 1] . substr($nom, -1));
    }

    private function rendQuestions(): array {
        $questions = [];
        for ($table = 2; $table <= 12; $table++) {
            $questionsTable = [];
            for ($multi = 1; $multi <= 12; $multi++) {
                $question = "$multi * $table";
                $questionsTable[] = $question;
            }
            $indexs = array_rand($questionsTable, 2);
            $question1 = $questionsTable[$indexs[0]];
            $question2 = $questionsTable[$indexs[1]];
            $questions[] = $question1;
            $questions[] = $question2;
        }
        shuffle($questions);
        $noQuestion = 1;
        foreach ($questions as $question) {
            $questionsARendre [] = ['no' => $noQuestion, 'libelle' => $question];
            $noQuestion++;
        }
        return $questionsARendre;
    }
}
```

Il faut ajouter encore les routes suivantes dans le fichier `web.php`

```
...
Route::get('/page2', [ScoreController::class, 'rendPage2']);
Route::post('/page2', [ScoreController::class, 'rendPage2']);
...
```

## Contrôle des champs pour le formulaire de soumission des réponses aux questions sur les livrets :

Pour valider les réponses données par l'utilisateur nous pouvons implémenter un
contrôle à l'aide d'une classe (`Request`) Pour créer cette classe, lançons la
commande :

```
php artisan make:request ScoreRequest
```

​ et complétons son contenu :

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "reponses.*" => [
                'required',
                'numeric',
                'min:2',
                'max:144',
            ]
        ];
    }
}
```

## Redirection après login et `logout`

Pour rediriger l'utilisateur après son identification ou son inscription nous
pouvons modifier deux contrôleurs qui ont été ajouté lors de la mise en place de
l'authentification.

Il s'agit d'abord du contrôleur
`app/Http/Controllers/Auth/RegisteredUserController.php` Il suffit de changer la
ligne 48 :

```
return redirect(route('dashboard', absolute: false));
```

en

```
return redirect('/');
```

et celle du contrôleur
`app/Http/Controllers/Auth/AuthenticatedSessionController.php` Changer la ligne
31 :

```
return redirect()->intended(route('dashboard', absolute: false));
```

en

```
return redirect()->intended('/');
```

Et pour rediriger l'utilisateur après son `logout`, il n'y a rien a faire
puisqu'on va directement à la racine

## Création des vues nécessaires (`view_page1`, `view_page2`, `view_page3` et `view_email`)

Commençons par factoriser tout le nécessaire dans le fichier
`template.blade.php` :

```php
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>
            Entraînement aux tables de multiplications
        </title>
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <style> textarea {resize:none} </style>
    </head>
    <body>
        <header class="jumbotron">
            <div class="container">
                Entraînement aux tables de multiplications
                @if(Auth::check())
                <div class="btn-group pull-right">
                    <a href="{{url('logout')}}" class="btn btn-warning">Logout</a>
                </div>
                @else
                <div class="btn-group pull-right">
                    <a href="{{url('login')}}" class="btn btn-info pull-right">Login</a>
                </div>
                @endif
            </div>
        </header>
        <div class="container">
            @yield('contenu')
        </div>
    </body>
</html>
```

Puis la `view_page1.blade.php`

```php+HTML
@extends('template')

@section('contenu')
<pre>
    Voici votre challenge :

    Répondre le plus rapidement possible à 22 questions sur les livrets 2 à 12
    (Deux questions au hasard par table de multiplication)

    Pour pouvoir faire partie du tableau des scores, il faut vous authentifier
    et avoir répondu juste à toutes les questions.

    Tapez sur le bouton Go dès que vous êtes prêts.
    <form method="POST" action="{{url('page2')}}" accept-charset="UTF-8">
        @csrf
        <input type="submit" value="Go">
    </form>
    <u>Tableau des 3 meilleurs scores :</u>
    @foreach($tableauMeilleursScores as $score)
{{$score['date']}}   {{$score['user']}}   {{$score['temps']}}
    @endforeach
</pre>
@endsection
```

Passons à la `view_page2.blade.php` (Affichage des 22 questions)

```php+HTML
@extends('template')

@section('contenu')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
Une ou/des réponse(s) n'étaient pas valide ! Voici de nouvelles questions :
@endif
<div class="panel-body">

    <form method="POST" action="{{route('score.store')}}" accept-charset="UTF-8">
        @csrf
        <pre>
<table>
<tr>
@foreach($questions as $question)
   <td align="right">
    <label for='reponses[{{$question['no']}}]'>{{$question['libelle']}}</label>
   </td>
   <td>
    <input name='reponses[{{$question['no']}}]' type='text' id='reponses[{{$question['no']}}]'>
   </td>
   @if ($question['no']%3 === 0)
   </tr><tr>
   @endif
   <input type="hidden" name='questions[{{$question['no']}}]' value='{{$question['libelle']}}'>
@endforeach
 </tr>
</table>
        </pre>
        <input type="hidden" name='tempsDepart' value='{{$tempsDepart}}'>
        <input type="submit" value="Soumettre">
    </form>
</div>
@endsection
```

Passons maintenant à la `view_page3.blade.php` (Affichage les résultats)

```php+HTML
@extends('template')

@section('contenu')
<div>
    <table>
            <?php $no = 1 ?>
    <tr>
    @foreach($resultats['QR'] as $resultat)
        <td align="right">{{$resultat['question']}}</td>
        <td style="padding: 10px;"> = </td>
        <td>{{$resultat['reponse']}}</td>
        @if ($resultat['correction']==='juste')
            <td><img src="{{Storage::url('img/juste.png')}}" alt="juste"></td>
        @else
            <td><img src="{{Storage::url('img/faux.png')}}" alt="faux">({{$resultat['reponseJuste']}})</td>
        @endif
        <td style="padding: 10px;">
        </td>
        @if ($no%3 === 0)
          </tr><tr>
        @endif
                <?php $no++ ?>
    @endforeach
    </tr>
    </table>
    <div class="btn-group pull-left">
        {{$resultats['synthese']}}
    </div>
    <div class="btn-group">
      <a href="{{url('/')}}" class="btn btn-success pull-left">Recommencer</a>
    </div>
@if(Auth::check())
<br>
<u>Vos scores :</u>
<table>
    @foreach($scores as $score)
    <tr>
        <td>{{$score['date']}}</td><td style="margin: 10px; padding: 5px;"></td><td>{{$score['temps']}}</td><td style="margin: 10px; padding: 5px;"></td><td>{{$score['pourcentage']}}</td>
    </tr>
    @endforeach
</table>
@endif
</div>
@endsection
```

Avant de créer un répertoire `img` et copier les images `faux.png` et
`juste.png` dedans, il faut créer un lien virtuel entre le répertoire `\public`
et le répertoire `\storage\app\public`

```
php artisan storage:link
```

Créons maintenant le répertoire `\img` dans `\storage\app\public` et ajoutons
les images `faux.png` et `juste.png` dedans.

Il ne reste plus que la vue pour la mise en forme du mail `view_mail.blade.php`

```php+HTML
<!doctype html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <ul>
            <u>Voici le nouveau tableau des trois meilleurs scores :</u><br>
            @foreach($tableauMeilleursScores as $score)
                {{$score['date']}}   {{$score['user']}}   {{$score['temps']}}<br>
            @endforeach
        </ul>
    </body>
</html>
```

## Mise à jour du fichier `.env` pour configuration d'une messagerie

Pour que l'envoi du mail fonctionne, il ne faut pas oublier de mettre les champs
à jour dans le fichier `.env`

> Attention à ne pas le laisser traîner n'importe où... (dans le cas où vous
> utilisez une vraie messagerie ;-)

Dans le cas de l'utilisation de `mailpit` :

```php
...
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025				// port SMTP ;-)
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="email_emetteur@monSuperSite.ch"
MAIL_FROM_NAME="${APP_NAME}"
...
```

- Télécharger le serveur SMTP/HTTP correspondant à votre OS à l'adresse suivante
  (si besoin) : [`mailpit`](https://github.com/axllent/mailpit)
- lancer les serveurs SMTP et HTTP

  ```
  mailpit
  ```

Voilà, notre application est fonctionnelle :slightly_smiling_face:

Pour voir les mails qui ont été envoyés par `Laravel` (s'il y en a), il suffit
d'interroger le serveur HTTP (port 8025 à ne pas confondre avec le port 1025 du
serveur SMTP) de `mailpit`

```
localhost:8025
```
