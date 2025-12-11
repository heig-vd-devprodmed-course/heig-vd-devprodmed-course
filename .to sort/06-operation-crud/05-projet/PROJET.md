# Projet commun : Une fiction numérique guidée par vos choix (Laravel + Vue.js (Web & mobile UI))

## Objectif pédagogique

> À l’issue du projet, les personnes doivent **concevoir et développer une
> application complète** mêlant :
>
> - Backend Laravel (routes, base de données, API REST)
> - Frontend Vue.js (navigation, affichage dynamique)
>
> Ce projet permet d’atteindre le niveau **« Créer »** de la taxonomie de Bloom.

## Contexte du projet

Vous allez créer ensemble un jeu narratif interactif, de type **« Livre dont
vous êtes le héros »**, dans lequel les choix de la personne influencent le
déroulement de l’histoire.

L'application se découpe en deux grandes parties :

- Le **backend Laravel** expose une API REST permettant de gérer les histoires,
  les chapitres, et les choix possibles.
- Le **frontend Vue.js** interagit avec cette API pour afficher l’histoire et
  permettre à la personne de faire des choix.

Bien sûr, si ce sujet ne vous inspire pas, vous pouvez proposer un autre projet
qui vous tient à cœur, tant que vous respectez les contraintes techniques
imposées et que les deux personnes qui enseignent le Web & mobile UI et le
développement backend sont d’accord.

## Modèle de données proposé

- `Story` (une histoire) : titre, résumé, personne qui l’a écrite
- `Chapter` (un chapitre) : contenu, n° du chapitre, appartient à une `Story`
- `Choice` (un choix possible dans un chapitre) : texte, lien vers un autre
  chapitre (`next_chapter_id`), appartient à un `Chapter`

Relations :

- `Story` a plusieurs `Chapter`
- `Chapter` a plusieurs `Choice`
- `Choice` pointe vers un autre `Chapter` (relation à soi-même via
  `next_chapter_id`)

## Étapes proposées (Laravel côté backend)

### Étapes déjà couvertes dans le cours

- Créer les migrations + modèles : `Story`, `Chapter`, `Choice`
- CRUD via API pour ces entités
- Validation avec `FormRequest`
- Tester les endpoints avec `curl`

### Étapes à introduire dans les prochains cours

- Authentification (à partir du cours 7) => permettre aux personnes de créer
  leurs propres histoires
- Relation 1-n et n-n : `Story` appartient à une personne, les `Choices`
  pointent vers un `Chapter`
- Ajout d’un middleware pour protéger certaines routes (édition de sa propre
  histoire)
- Versionnée via `/api`

## Étapes côté Vue.js (vue par la personne qui enseigne le Web & mobile UI)

- Récupérer la liste des `Story` via l’API (`GET /api/stories`)
- Afficher le chapitre de départ
- Afficher dynamiquement les choix possibles
- Naviguer vers le prochain chapitre selon le choix effectué
- (bonus) Afficher la progression ou revenir en arrière

## Extensions possibles (bonus)

- Historique des choix
- Système de sauvegarde (via session ou token)
- Choix conditionnels (ex : ajouter un champ `condition`)
- Multi-utilisateur avec authentification via JWT ou sanctum
- Illustrations ou sons liés à chaque chapitre
