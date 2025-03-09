# Formulaire : Exercices

**Consigne** : Créer un formulaire pour l’enregistrement d’une manifestation.

Votre formulaire doit permettre de saisir :

- Une date de début de la manifestation.
- Une date de fin de la manifestation.
- Le lieu (ville où l’événement se déroule).

**Contraintes à respecter**

Dates :

- La date de début doit être dans le futur (au moins demain).
- La manifestation doit durer entre 3 et 5 jours.

Lieu :

- Doit contenir au moins 3 lettres.
- Doit commencer par une majuscule, suivie de minuscules.

Une fois les champs valides :

Un e-mail est envoyé au responsable.

Le message contient :

> La prochaine manifestation aura lieu du : 21 mars au 24 mars 2024 à Paris.
>
> Avec nos meilleures salutations.
>
> Le comité.

Un message de confirmation s'affiche :

> Merci. Votre message concernant la prochaine manifestation a été envoyé au
> responsable.

**Ressources utiles**

- [Documentation Laravel - Validation](https://laravel.com/docs/11.x/validation)
- [Liste des règles de validation](https://laravel.com/docs/11.x/validation#available-validation-rules)
- [Règles personnalisées (Rule)](https://laravel.com/docs/11.x/validation#custom-validation-rules)
