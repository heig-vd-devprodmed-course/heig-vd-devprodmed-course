Questionnaire 5
---------------

1.) Quel fichier de `Laravel` permet la configuration de la connexion à un Système de Gestion de Base de Données ?

> Le fichier `.env`
>
> ```
> DB_CONNECTION=sqlite
> ```

2.) A quoi sert la commande : `php artisan migrate:install` ?

> A créer une table 'migrations' dans la base de donnée permettant à ` Laravel` de gérer nos différentes tables.

3.) A quoi sert la commande : `php artisan make:migration ...create_unNomTable_table...` ?

> A créer un fichier dans le répertoire `\database\migrations\...date..._create_unNomTable_table.php`

4.) A quoi sert le contenu du fichier créé au point précédant.

> Il sert à créer / supprimer la table `...unNomTable...` de la base de données. Il contient deux méthodes :
>
> 	- La méthode up() qui permet de définir les champs, type, contraintes de la nouvelle table.
> 	- La méthode down() permet de supprimer la table.

5.) Quelles commandes `php artisan` permettent de créer / supprimer des tables dans la base de donnée ?

> - Pour créer toutes les tables définies dans le répertoire `laravel\databases\`
>
>   ```
>   php artisan migrate
>   ```
>
> - Pour supprimer toutes les tables définies dans le répertoire `laravel\databases\`
>
>   ```
>   php artisan migrate:rollback
>   ```

6.) A quoi sert `Eloquent` dans `Laravel` ?

> ```Eloquent``` est un ORM (`Object-Relational-Mapping`).
> Tous les éléments de la base de données ont une représentation sous forme d'objets.
> Cela simplifie grandement les opérations CRUD (`Create, Read, Update, Delete`) sur la base de données.

7.) Comment appelle-t-on les classes permettant à `Eloquent` de fonctionner ?

> On appelle ces classes des `classe-modèle`.

8.) Comment crée-t-on une `classe-modèle` ?

> ```
> php artisan make:model ...nomClasseModele...
> ```

9.) Dans quel répertoire se trouvent les `classes-modèles` ?

> Les classes modèles se trouvent dans le répertoire `\app\Models`

10.) Que doit-on mettre dans une `classe-modèle` ?

> On y met le nom de la table de la base de donnée auquel se réfère le modèle.
> Si on ne met pas le nom d'une table, `Laravel` cherchera automatiquement une table nommée comme la ```classe-modèle``` mais avec un 's' à la fin.
> Exemple : Si la classe s'appelle ```Commande.php```, `Laravel` l'associera par défaut à la table `commandes`
> https://laravel.com/docs/11.x/eloquent#generating-model-classes

11.) Quelle méthode permet la sauvegarde les informations d'un `objet-modèle` dans le base de données

> `unObjet->save();`

12.) La commande : `php artisan migrate:install` crée 2 tables dans la base de données :

- la table `migrations` et 
- la table `sqlite_sequence`

​	Combien de migrations y-a-t'il dans le répertoire `database/migrations` ?

> 3 de base + toutes celles que nous avons ajoutées. 

​	Combien de tables pensez-vous que la commande : `php artisan migrate` va créer ?

> Le bon sens nous fait penser que cela créera 3 tables de base + les nôtres.

​	Combien de tables crée la commande : `php artisan migrate` ?

> Bien plus qu'attendu !

​	Pourquoi y a-t-il plus de tables qu'attendu ?

> A priori :
> 1 migration => 1 table, mais : 
> 1 migration => peut s'occuper de plusieurs tables ! 
> (Pour vous en rendre compte, il suffit d'ouvrir la migration (fichier) :
> `0001_01_01_000000_create_users_table.php` qui elle seule s'occupe déjà trois tables ;-)