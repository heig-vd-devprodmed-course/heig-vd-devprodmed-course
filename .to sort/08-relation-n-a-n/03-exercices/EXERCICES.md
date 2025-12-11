# Exercice : Gérer des voitures et leurs accessoires

## Objectif pédagogique

À l'issue de cet exercice, vous devriez être capables de :

- Modéliser une relation many-to-many dans Laravel.
- Créer les **migrations**, **modèles**, **seeders** et **contrôleurs**
  associés.
- Attacher ou détacher dynamiquement des accessoires à une voiture.
- Afficher les relations dans une vue Blade.
- Valider un champ de type "liste d’éléments séparés par des virgules".

## Contexte

Vous développez un module de gestion de flotte automobile. Chaque voiture peut
avoir plusieurs accessoires (autoradio, GPS, caméra de recul…), et chaque
accessoire peut être partagé par plusieurs voitures (en location ou stock
tournant).

## Modèle de données attendu

- Table `voitures`
- Table `accessoires`
- Table pivot `accessoire_voiture`

## Étapes à réaliser

### 1. Migrations

- Créez une migration pour la table `voitures` avec les champs :  
  `id`, `marque`, `modele`, `annee`, `created_at`, `updated_at`
- Créez une migration pour la table `accessoires` avec les champs :  
  `id`, `nom`, `slug`, `created_at`, `updated_at`
- Créez une table pivot `accessoire_voiture` avec les champs : `id`,
  `voiture_id`, `accessoire_id`, `timestamps`, et les clés étrangères.

> Respectez les conventions Laravel : noms **au singulier**, **ordre
> alphabétique**.

### 2. Modèles Eloquent

- Créez les modèles `Voiture` et `Accessoire`.
- Ajoutez les relations `belongsToMany(...)` dans chaque modèle.

### 3. Seeders

- Créez un `VoitureSeeder` avec 10 voitures aléatoires.
- Créez un `AccessoireSeeder` avec 5 accessoires.
- Créez un `AccessoireVoitureSeeder` pour lier chaque voiture à 2 ou 3
  accessoires aléatoires.

> Pensez à la méthode `attach()` ou `sync()` dans la boucle du seeder.

### 4. Contrôleur

Créez un `VoitureController` :

- `index()` : liste des voitures + leurs accessoires.
- `create()` : formulaire pour créer une voiture (optionnel).
- `store()` : traitement du formulaire.
- `attachAccessoires()` : méthode pour attacher un ou plusieurs accessoires à
  une voiture.

### 5. Formulaire de création

Dans la vue `create.blade.php` :

- Champ texte : marque, modèle, année
- Champ texte (optionnel) : accessoires séparés par des virgules
  (`gps,radio,camera`)
- Validez ce champ avec une expression régulière personnalisée.

> Inspirez-vous du champ `motcles` dans le support de cours.

### 6. Visualisation

Dans la vue `index.blade.php` :

- Affichez une table avec :
  - Voiture (marque, modèle, année)
  - Accessoires associés (boutons pour les détacher)

## Bonus

- Ajouter un bouton « Supprimer » sur chaque accessoire ou voiture.
- Ajouter un bouton « Voir toutes les voitures qui utilisent cet accessoire ».

## Aide-mémoire (raccourci de commandes)

```bash
php artisan make:model Voiture -m
php artisan make:model Accessoire -m
php artisan make:migration create_accessoire_voiture_table
php artisan make:seeder VoitureSeeder
php artisan make:controller VoitureController
php artisan migrate --seed
php artisan tinker
```
