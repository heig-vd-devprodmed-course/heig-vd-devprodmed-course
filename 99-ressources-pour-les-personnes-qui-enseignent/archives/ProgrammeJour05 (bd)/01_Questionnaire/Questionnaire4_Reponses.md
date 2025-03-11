# Questionnaire 4

1.) Comment se nomme la classe que l'on doit créer pour pouvoir valider les
champs d'un formulaire ?

> ​ `...Request...`

2.) Quelle est la commande `php artisan` permettant de créer cette classe ?

> ​ `php artisan make:request ...nomDuFichierRequest...`

3.) Quelles sont les modifications à apporter dans cette classe pour qu'elle
fonctionne correctement ?

> - (pour l'instant) faire que la méthode `authorize()` retourne `true`
> - faire que la méthode `rules()` retourne un tableau contenant les contraintes
>   pour le(s) champ(s) du formulaire.
>
> Ex :
> `return [            'nom'=>'required|min:3|max:20|alpha',            'email'=>'required|email',            'texte'=>'required|max:250'       ];`

4.) Quelles sont les modifications à apporter dans le contrôleur pour que la
validation des champs d'un formulaire prenne effet ?

> ​ Il faut que la méthode qui traite le formulaire accepte en paramètre un
> objet de type ​ `...Request...`

5.) Comment se nomme l'objet impliqué lors de la validation de formulaire dans
une vue ?

> ​ Il s'agit de l'objet `$errors`

6.) Quel est le fichier que l'on doit modifier pour que l'envoi d'email
fonctionne dans Laravel ?

> ​ Le fichier à configurer est le fichier `.env` ​ Il faut renseigner les
> champs permettant la connexion à une ​ messagerie. ​ Exemple :
>
> ```
> ...
> MAIL_MAILER=smtp
> MAIL_HOST=!!! nom_serveur_mail !!!
> MAIL_PORT=!!! port_du_serveur_mail !!!
> MAIL_USERNAME= !!! votre_username !!!
> MAIL_PASSWORD= !!! votre_mot_de_passe !!!
> MAIL_ENCRYPTION=!!! type_d_encryption !!!
> MAIL_FROM_ADDRESS= !!! votre_adresse_email !!!
> MAIL_FROM_NAME="${APP_NAME}"
> ...
> ```

7.) Comment se nomme la classe permettant l'envoi d'un email ?

> ​ Il s'agit de la classe `Mail`
>
> ​ `\laravel\vendor\laravel\framework\src\Illuminate\Support\Facades\Mail.php`

8.) Comment se nomme la méthode permettant l'envoi d'un email ?

> ​ La méthode se nomme `send(...)`
>
> ​ La classe `Mail` utilise un objet de la classe `MailFake` (`c.f.` use) qui
> implémente la méthode ​ `send(...)` ​
> `\laravel\vendor\laravel\framework\src\Illuminate\Support\Testing\Fakes\MailFake.php`

9.) Combien de paramètres nécessite la méthode d'envoi d'email pour pouvoir
fonctionner ?

> ​ La méthode nécessite trois paramètres.

10.) Décrivez ces paramètres et donnez leur fonctions ?

> ​ Les trois paramètres sont :
>
> - La vue (permet la mise en forme du message) Ex : `view_email_contact`
> - Un tableau des données provenant du formulaire accessible par l'objet
>   `$request` (qui va être utilisée par la vue) Ex : `$request->all()` // tous
>   les champs de la requête
> - La fonction de callback permettant de définir :
>
>   - L'adresse où envoyer le message
>   - Le sujet du message.
>
>   Ex :
>
>   ```php
>   function($message) {
>      $message->to('...une_adresse_email...')->subject('...un_sujet...');
>   );
>   ```
