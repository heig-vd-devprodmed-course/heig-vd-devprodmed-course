Exercice :
----------
Créer un formulaire permettant de saisir :

- Une date de début
- Une date de fin
- Lieu

La première date défini le début d'une manifestation.
La seconde date, la fin de la manifestation.
Le lieu est le nom de la ville où la manifestation à Lieu

Remarques : 

- Les dates doivent être valides et doivent être dans le futur.
  Si aujourd'hui nous sommes le 13 mars 2024, la date de début doit au moins être le 14 mars 2024

- La manifestation doit durer au moins 3 jours, mais pas plus de 5.

- Le lieu débute avec une majuscule, suivi de minuscules, au moins trois lettres)

- Une fois que les trois champs sont valides, il faut envoyer un mail, au responsable de la manifestation, contenant le message suivant :

  ```
  La prochaine manifestation aura lieu du :
  
  	21 mars au 24 mars 2024 à Paris.
  
  Avec nos meilleures salutations.
  
  Le comité.
  
  ```

- Une fois que le mail a été envoyé, l'utilisateur du formulaire doit en être informé.

  ```
  Merci. Votre message concernant la prochaine manifestation a été envoyé au responsable
  ```

[Documentation officielle](https://laravel.com/docs/11.x/validation)

[Liste des validateurs prédéfinis](https://laravel.com/docs/11.x/validation#available-validation-rules)

Conseils : Procédez par étapes, commencer par une contrainte puis ajouter les suivantes.

> <u>Challenge :</u>
>
> Le défi est de pouvoir définir des contraintes basées sur plusieurs champs.
>
> Indications : Une des solutions est de créer une classe ```Rule``` contenant le code puis valider la requête dans le contrôleur. (voir la documentation officielle [Personnaliser une validation](https://laravel.com/docs/11.x/validation#custom-validation-rules)