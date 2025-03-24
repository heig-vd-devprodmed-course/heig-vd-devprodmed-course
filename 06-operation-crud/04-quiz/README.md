---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: HEIG-VD DévProdMéd - Cours Laravel
description: Quiz 6 - Laravel CRUD, API et vues
header: "**Quiz 6** - Laravel CRUD, API et vues"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Quiz 6 - Laravel CRUD, API et vues

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> **Pourquoi deux contrôleurs pour un même domaine (ex: `NewsletterController`
> et `NewsletterApiController`) ?**

## Réponse 1 - Réponse

Pour respecter la séparation des responsabilités : l'un gère les vues HTML
(interface humaine), l'autre l'API JSON (interface machine).

## Question 2 - Donnée

> **Quelle est la différence entre `PUT` et `PATCH` ?**

## Réponse 2 - Réponse

`PUT` remplace toute la ressource, `PATCH` ne met à jour que certains champs. En
REST, `PUT` est plus courant pour la mise à jour complète.

## Question 3 - Donnée

> **Pourquoi utiliser `FormRequest` ?**

## Réponse 3 - Réponse

Pour centraliser la validation, la rendre testable, claire et séparée de la
logique métier du contrôleur.

## Question 4 - Donnée

> **`api.php` fonctionne-t-il sans configuration ?**

## Réponse 4 - Réponse

Oui ! Laravel charge automatiquement `routes/api.php` avec le middleware `api`.
Les routes sont préfixées avec `/api` par défaut, et les réponses sont formatées
en JSON.

## Question 5 - Donnée

> **Quels sont les verbes HTTP utilisés dans REST ?**

## Réponse 5 - Réponse

- `GET` → Lire des données
- `POST` → Créer une ressource
- `PUT` ou `PATCH` → Mettre à jour une ressource
- `DELETE` → Supprimer une ressource

## Question 6 - Donnée

> **Quel est l'intérêt d'utiliser des routes au pluriel (ex: `/newsletters`) ?**

## Réponse 6 - Réponse

Cela suit la convention REST : une ressource est toujours désignée au pluriel.
Cela clarifie que l'on agit sur une collection de ressources.

## Question 7 - Donnée

> **Quel code HTTP indique que la ressource a été créée avec succès ?**

## Réponse 7 - Réponse

Le code **`201 Created`**.

```php
return response()->json($newsletter, 201);
```

## Question 8 - Donnée

> **Pourquoi `findOrFail()` est-il recommandé dans un contrôleur API ?**

## Réponse 8 - Réponse

Il permet de retourner automatiquement une erreur 404 si la ressource n'existe
pas. Cela évite des bugs ou retours vides.

```php
$newsletter = Newsletter::findOrFail($id);
```

## Question 9 - Donnée

> **Comment tester une API Laravel sans interface graphique ?**

## Réponse 9 - Réponse

En utilisant `curl` dans un terminal. Par exemple :

```bash
curl http://localhost:8000/api/newsletters
```

> D’autres outils existent comme Postman ou Hoppscotch.

## Questions ?

<!-- _class: lead -->

Est-ce que vous avez des questions ?
