# Travail pratique : Créer une fiction interactive multi-plateforme (Laravel + Vue.js)

## Table des matières

- [Table des matières](#table-des-matières)
- [Introduction](#introduction)
- [Objectifs pédagogiques](#objectifs-pédagogiques)
- [Consignes générales](#consignes-générales)
- [Évaluation](#évaluation)
  - [Critères côté Laravel](#critères-côté-laravel)
  - [Critères côté Vue.js](#critères-côté-vuejs)
  - [Critères transversaux (collaboration, présentation, qualité)](#critères-transversaux-collaboration-présentation-qualité)
- [Contraintes techniques](#contraintes-techniques)
- [Conseils](#conseils)
- [Livrables et rendu](#livrables-et-rendu)
- [Présentation orale](#présentation-orale)
- [Feedback](#feedback)

## Introduction

Ce projet vous invite à créer une application complète mêlant **backend
Laravel** et **frontend Vue.js**, sous forme d’une fiction interactive où les
choix du·de la joueur·se influencent le récit.

L'objectif est de concevoir un système de navigation dynamique, stocké en base
de données, et rendu disponible à travers une API REST que le frontend
consommera.

## Objectifs pédagogiques

À l’issue de ce travail pratique, les personnes qui étudient devraient être
capables de :

- Concevoir et développer une application web complète de type SPA.
- Implémenter un backend Laravel structuré avec des routes RESTful.
- Créer une API versionnée avec validation, middleware, et relations Eloquent.
- Gérer un frontend Vue.js pour naviguer dans une histoire à choix multiples.
- Interagir avec une API (GET, POST, etc.) et afficher dynamiquement les
  contenus.

## Consignes générales

Vous développerez une application web en deux parties :

- **Backend Laravel** : responsable de la gestion des histoires, chapitres,
  choix et authentification.
- **Frontend Vue.js** : responsable de l’affichage interactif de la fiction,
  utilisable sur navigateur et mobile.

Le thème « livre dont vous êtes le héros » est recommandé mais non obligatoire.
Si vous avez une idée de projet plus personnel, validez-la avec l’équipe
enseignante.

## Évaluation

Chaque partie du projet sera évaluée selon plusieurs catégories. Le barème
repose sur plusieurs critères, chacun valant 0,2 point.

### Critères côté Laravel

| #   | Critère                                                                              | Points |
| --- | ------------------------------------------------------------------------------------ | ------ |
| 1   | Migrations, modèles et relations correctement définis (`Story`, `Chapter`, `Choice`) | 0.2    |
| 2   | Validation via `FormRequest` pour les opérations de création/modification            | 0.2    |
| 3   | API RESTful versionnée (`/api/v1/...`) avec routes bien nommées                      | 0.2    |
| 4   | Contrôleurs correctement structurés, logique métier claire                           | 0.2    |
| 5   | Authentification Laravel (sanctum ou JWT) implémentée                                | 0.2    |
| 6   | Middleware protègent les routes d’édition/ajout                                      | 0.2    |
| 8   | Gestion des erreurs API (404, 422, etc.)                                             | 0.2    |
| 9   | Réponses structurées (JSON clair, status code adaptés)                               | 0.2    |

### Critères côté Vue.js

| #   | Critère                                                                | Points |
| --- | ---------------------------------------------------------------------- | ------ |
| 10  | Affichage d’une liste d’histoires (récupérées via l’API)               | 0.2    |
| 11  | Navigation dynamique entre les chapitres selon les choix               | 0.2    |
| 12  | Affichage lisible, clair et réactif du contenu                         | 0.2    |
| 13  | Interface responsive (mobile/desktop)                                  | 0.2    |
| 14  | Affichage conditionnel ou sauvegarde de progression (bonus si présent) | 0.2    |

### Critères transversaux (collaboration, présentation, qualité)

| #   | Critère                                                                   | Points |
| --- | ------------------------------------------------------------------------- | ------ |
| 15  | README structuré expliquant le projet et son installation                 | 0.2    |
| 16  | Utilisation du contrôle de version (commits clairs, branches si possible) | 0.2    |
| 18  | Présentation claire et structurée, temps respecté                         | 0.2    |
| 19  | Réponses précises et complètes lors des questions                         | 0.2    |
| 20  | Code lisible, commenté, structuré (backend et frontend)                   | 0.2    |
| 21  | Le projet est fonctionnel de bout en bout                                 | 0.2    |
| 23  | Qualité de l’expérience utilisateur (design, fluidité)                    | 0.2    |
| 24  | Gestion correcte des erreurs utilisateur côté frontend (choix invalides)  | 0.2    |

**Note finale = (somme des points \* 0.2)**

## Contraintes techniques

- Backend Laravel >= 10.x
- Frontend Vue.js >= 3.x
- Base de données relationnelle (SQLite, MySQL ou PostgreSQL)
- Projet disponible sur GitHub
- Une documentation minimale (`README.md`) doit permettre de tester facilement
  l'application

## Conseils

- Ne cherchez pas à faire complexe : commencez simple, itérez ensuite.
- Travaillez de manière incrémentale et validez chaque étape.
- Testez tôt et souvent.
- Un bug non corrigé vaut moins de points qu’une fonctionnalité simple mais
  fonctionnelle.

## Livrables et rendu

Vous devez fournir :

- L’URL du dépôt GitHub (backend + frontend)
- Un fichier `README.md` clair pour expliquer l'installation et les choix
  techniques
- Une démonstration du projet (vidéo ou présentation en direct)

**Rendu final** : date à déterminer.

## Présentation orale

Chaque personne dispose de **?? minutes** pour présenter son projet, suivies de
?? minutes de questions. Préparez une démonstration fonctionnelle et claire.

## Feedback

Les notes et remarques vous seront envoyées via Teams.  
Pour toute question ou réclamation, contactez l’équipe enseignante. Chaque
personne est encouragée à proposer des améliorations ou poser des questions sur
le projet via Teams.
