Questionnaire 8
---------------

01.)	Qu'est ce qu'une relation de type `n:n` dans le domaine de la base de donnée ? (Veuillez donner un exemple)

> Une relation n:n signifie qu'un enregistrement d'une table (T1) peut être référencé par plusieurs enregistrements d'une autre table (T2) et réciproquement un enregistrement de la table (T2) peut être référencé par plusieurs enregistrement de la table (T1)
>
> Exemple :
> Une personne peut être employée par plusieurs entreprises.
> Une entreprise peut employer plusieurs personnes.
>
> Pour pouvoir disposer d'une relation n:n il faut une table supplémentaire nommée table pivot
>
> ```
>                     (table pivot)
> personnes           entreprise_personne			 entreprises
> ═════════           ═══════════════════			 ═══════════
> id ──────────────┐  id                         ┌──id_entreprise
> nom              │  id_entreprise ─────────────┘  nom
> prénom           └─ id_personne									
> 
> ```

02.)	Combien de tables sont impliquées dans une relation `n-n` ?

> Trois tables sont impliquées

03.)	Comment doit se nommer la table pivot dans `Laravel` ?

> Le nom de la table pivot doit contenir le nom des deux tables (au singulier !) et par ordre alphabétique
>
> Exemple :
>
> - table1 => personnes => singulier : personne
> - table2 => entreprises => singulier : entreprise
> - entreprise vient avant personne (ordre alphabétique)
> - donc la table pivot doit se nommer `entreprise_personne`
>
> [Documentation officielle](https://laravel.com/docs/9.x/eloquent-relationships#many-to-many)

04.)	Comment définit-on une relation `n-n` dans les `classes-modèles` ?

> Si on se base sur les tables de la question 1, il faut compléter deux `classes-modèles` (`Personne.php` et `Entreprise.php`)
> Dans la classe `Personne`
>
> ```php
> ...
> public function entreprises() {
> 	return $this->belongsToMany(Entrepise::class);
> }
> ...
> ```
>
> Dans la classe `Entreprise`
>
> ```php
> ...
> public function personnes() {
> 	return $this->belongsToMany(Personne::class);  
> }
> ...
> ```

05.)	Dans l'exemple (vu au dernier cours) qui implémente une relation `n-n`, 
			quelle méthode du contrôleur ajoute les relations entre les articles et les mots-clés dans la table pivot ?

> Il s'agit de la méthode `store`
>
> ```php
> public function store(ArticleRequest $request) {
>      $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);
>      $article = Article::create($inputs);
>      if (isset($inputs['motcles'])) {
>          $tabMotcles = explode(',', $inputs['motcles']);
>          foreach ($tabMotcles as $motcle) {
>              // trim(...) enlève les espaces superflux en début et en fin de chaîne
>              $motcle = trim($motcle);
>              // Str::slug génère une chaîne similaire à $motcle mais adaptée aus urls
>              // adaptation des caractères accentués et/ou caractères spéciaux
>              $mot_url = Str::slug($motcle);
>              $mot_ref = Motcle::where('mot_url', $mot_url)->first();
>              if (is_null($mot_ref)) {
>                  $mot_ref = new Motcle([
>                      'mot' => $motcle,
>                      'mot_url' => $mot_url
>                  ]);
>                  $article->motcles()->save($mot_ref);
>              } else {
>                  $article->motcles()->attach($mot_ref->id);
>              }
>          }
>      }
>      return redirect(route('articles.index'));
>  }
> ```

06.)	Dans la méthode du contrôleur qui met à jour la table pivot (question 5), 
			quelle instruction permet d'ajouter une relation entre un article et un mot-clé dans la table pivot ?

> Il s'agit de la méthode `->attach()`
>
> L'instruction est la suivante : 
>
> ```php
> $article->motcles()->attach($mot_ref->id);
> ```