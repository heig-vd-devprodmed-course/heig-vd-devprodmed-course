---
marp: true
theme: "custom-marp-theme"
size: "16:9"
paginate: "true"
author: "L. Delafontaine, avec l'aide de GitHub Copilot"
description:
  "Architecture RESTful pour le cours DévProdMéd enseigné à la HEIG-VD, Suisse"
lang: "fr"
url: "https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/presentation.html"
header: "[**Architecture RESTful**][contenu-complet-sur-github]"
footer:
  "[**HEIG-VD**](https://heig-vd.ch) - [DévProdMéd
  2025-2026](https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course)
  - [CC BY-SA 4.0][licence]"
headingDivider: 6
---

# Architecture RESTful

<!--
_class: lead
_paginate: false
-->

<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course>

Visualiser le contenu complet sur GitHub [à cette
adresse][contenu-complet-sur-github].

<small>L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).</small>

<small>Ce travail est sous licence [CC BY-SA 4.0][licence].</small>

![bg opacity:0.1][illustration-principale]

## Plus de détails sur GitHub

<!-- _class: lead -->

_Cette présentation est un résumé du contenu complet disponible sur GitHub._

_Pour plus de détails, consulter le [contenu complet sur
GitHub][contenu-complet-sur-github] ou en cliquant sur l'en-tête de ce
document._

## Objectifs (1)

- Décrire les principes fondamentaux d'une architecture REST.
- Différencier les architectures REST et RESTful.
- Décrire quand et pourquoi utiliser une architecture RESTful pour développer
  des services web.

![bg right:40%][illustration-objectifs]

## Objectifs (2)

- Mettre en œuvre une architecture RESTful dans une application web avec le
  framework Laravel.

![bg right:40%][illustration-objectifs]

## MVC, REST et RESTful

![bg right:40%][illustration-objectifs]

### Jusqu'à présent... architecture MVC

- Architecture MVC : routes, contrôleurs, vues, modèles, authentification.
- Adaptée pour les applications web classiques avec interface graphique.
- Retourne du HTML complet, gère les sessions via cookies.
- Pas adaptée pour des clients légers (applications mobiles, SPA JavaScript) qui
  ne peuvent pas gérer facilement les sessions via cookies.

### Dans le futur peut-être... architecture REST (1)

Une application **REST** respecte ces principes :

1. **Client-serveur** : un client consomme les services d'un serveur.
2. **Sans état** : chaque requête contient toutes les informations nécessaires.
3. **Cacheable** : les réponses peuvent être mises en cache.
4. **Interface uniforme** : l'interface entre client et serveur est standardisée
   (= qui suit les standards : URL, méthodes HTTP, ...).

### Dans le futur peut-être... architecture REST (2)

5. **Système en couches** : plusieurs couches (base de données, logique métier,
   authentification, etc.).
6. **Code à la demande** (optionnel) : le serveur peut envoyer du code
   exécutable au client.

### Architectures REST/RESTful

- Respecter parfaitement REST peut être difficile, voire impossible.
- On parle donc d'**architecture RESTful** : proche des principes REST, mais de
  manière approximative.
- Laravel permet de développer des applications RESTful via une API.

![bg right:40%][illustration-objectifs]

## API

- Une **API** (_application programming interface_) est un ensemble de règles
  permettant à différentes applications de communiquer.
- Elle fournit des fonctionnalités ou des données de manière standardisée.
- Utilisée par des applications mobiles ou JavaScript côté client.
- Format de données le plus courant : **JSON**.

### Structure d'une API RESTful (1)

Conventions d'une API RESTful :

- Les ressources sont identifiées par des **URL uniques**.
- Les opérations utilisent les **méthodes HTTP** standard.
- Les réponses sont en **JSON**.
- L'authentification utilise des **tokens** (JWT, tokens d'API, etc.).
- Les erreurs utilisent des **codes d'état HTTP** appropriés.

### Structure d'une API RESTful (2)

Exemple pour une ressource `posts` :

| Méthode     | URL               | Description       |  Réponse |
| :---------- | :---------------- | :---------------- | -------: |
| `GET`       | `/api/posts`      | Liste des posts   |      200 |
| `POST`      | `/api/posts`      | Créer un post     | 201, 400 |
| `GET`       | `/api/posts/{id}` | Détails d'un post | 200, 404 |
| `PUT/PATCH` | `/api/posts/{id}` | Modifier un post  | 200, 404 |
| `DELETE`    | `/api/posts/{id}` | Supprimer un post | 204, 404 |

### Versionner une API RESTful

- Il est recommandé de **versionner** une API RESTful.
- Permet aux clients de continuer à utiliser une version stable pendant le
  développement de nouvelles fonctionnalités.
- Convention : inclure la version dans l'URL.

```bash
# Version 1
GET /api/v1/posts

# Version 2
GET /api/v2/posts
```

### Tester une API RESTful

Pas d'interface graphique → outils spécifiques nécessaires :

- [Bruno](https://www.usebruno.com/) (recommandé).
- [curl](https://curl.se/).
- [Insomnia](https://insomnia.rest/).
- [Postman](https://www.postman.com/).

```bash
curl -s -H "Authorization: Bearer <token>" \
  http://localhost:8000/api/posts
```

## Développer une API RESTful avec Laravel

### Différencier les routes MVC et les routes API

|            | Routes MVC            | Routes API                   |
| :--------- | :-------------------- | :--------------------------- |
| Fichier    | `routes/web.php`      | `routes/api.php`             |
| Préfixe    | _(aucun)_             | `/api`                       |
| Usage      | Interface utilisateur | Consommation par des clients |
| Middleware | `web`                 | `api`                        |

### Laravel Sanctum pour l'authentification des API RESTful

[Laravel Sanctum](https://laravel.com/docs/12.x/sanctum) :

- Génère des **tokens d'authentification** pour les utilisateur.trices.
- Gère les **permissions et les rôles** associés aux tokens.
- Permet de **révoquer** ou **renouveler** les tokens.

### Créer les tokens pour les utilisateur.trices

- Proposer une interface pour que les utilisateur.trices génèrent des tokens.
- Nouveau domaine/ressource dans l'application : **gestion des tokens**.
- Nécessite des vues, routes et contrôleurs dédiés.

### Utiliser les tokens pour authentifier les requêtes API

Inclure le token dans l'en-tête `Authorization` :

```bash
curl -s \
  -H "Authorization: Bearer <token>" \
  http://localhost:8000/api/posts
```

- Sanctum vérifie automatiquement la validité du token.
- Si valide : la requête est authentifiée.
- Sanctum associe automatiquement la personne authentifiée à la requête.

### Gérer les permissions et les rôles des utilisateur.trices avec les tokens d'authentification

- Des **permissions** (_abilities_/scopes) sont associées à chaque token.
- Permet de contrôler l'accès aux différentes fonctionnalités de l'API.
- Exemples : `posts:read`, `posts:create`, `posts:update`, `posts:delete`.

```php
// Vérifier si le token a la permission "posts:create"
$request->user()->tokenCan('posts:create');
```

## Conclusion

- L'architecture **RESTful** est adaptée pour des services web consommés par des
  clients légers (mobiles, SPA).
- Laravel permet de développer des API RESTful facilement.
- **Laravel Sanctum** gère l'authentification via des tokens.
- Les tokens peuvent porter des **permissions** pour contrôler l'accès à l'API.

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- (Re)lire le contenu de cours.
- Faire les exercices.
- Faire le mini-projet.
- Poser des questions si nécessaire.

➡️ [Visualiser le contenu complet sur GitHub.][contenu-complet-sur-github]

**N'hésitez pas à vous entraidez si vous avez des difficultés !**

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration principale][illustration-principale] par
  [Richard Jacobs](https://unsplash.com/@rj2747) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-elephants-drinking-water-8oenpCXktqQ)
- [Illustration][illustration-objectifs] par
  [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  [Unsplash](https://unsplash.com/photos/low-angle-view-of-ball-shoots-in-the-ring-j6brni7fpvs)

---

- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

<!-- URLs -->

[contenu-complet-sur-github]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/tree/main/01-contenus-du-cours/04-vues-blade-et-tailwind-css/README.md
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
