# Exercices

Voici quelques pistes pour aller plus loin :

## A. Ajouter un champ "prénom" au modèle Newsletter

- Mettre à jour la migration
- Modifier les vues et les requêtes API pour gérer ce champ

## B. Ajouter un système de confirmation

- Ajouter un champ `confirmed_at` (datetime)
- Créer une route `POST /api/newsletters/{id}/confirm` qui le remplit

## C. Créer une nouvelle entité : `Subscriber`

- Reproduire tout le cycle CRUD pour une ressource secondaire
- Créer un lien `Newsletter -> hasMany(Subscriber)`

## D. Ajouter une recherche (bonus)

- Route GET `/api/newsletters?search=...`
- Utiliser la méthode `when()` d'Eloquent pour filtrer
