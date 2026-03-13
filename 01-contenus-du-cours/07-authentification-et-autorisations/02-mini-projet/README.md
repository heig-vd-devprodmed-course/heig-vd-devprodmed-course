# Authentification et autorisations - Mini-projet

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Toutes les informations relatives à ce contenu sont décrites dans le
> [contenu principal](../README.md).

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Identifier les tâches à réaliser](#identifier-les-tâches-à-réaliser)
- [Créer le nécessaire pour s'inscrire et se connecter](#créer-le-nécessaire-pour-sinscrire-et-se-connecter)
  - [Modifier la base de données et les modèles](#modifier-la-base-de-données-et-les-modèles)
  - [Créer les vues](#créer-les-vues)
  - [Créer les contrôleurs et les routes](#créer-les-contrôleurs-et-les-routes)
  - [Protéger les ressources précédemment créées](#protéger-les-ressources-précédemment-créées)
- [Utiliser la personne authentifiée dans le reste de l'application](#utiliser-la-personne-authentifiée-dans-le-reste-de-lapplication)
  - [Associer la personne authentifiée aux posts](#associer-la-personne-authentifiée-aux-posts)
  - [Associer la personne authentifiée aux likes](#associer-la-personne-authentifiée-aux-likes)
- [N'autoriser que l'auteur.trice à modifier ses propres posts](#nautoriser-que-lauteurtrice-à-modifier-ses-propres-posts)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Mettre en place tous les mécanismes nécessaires pour permettre aux
utilisateur.trice.s de se créer un compte, se connecter, et gérer leur compte
avec leurs propres posts.

Nous allons donc devoir toucher à tous les aspects que nous avons étudié
jusqu'ici : base de données, modèles, vues, contrôleurs, etc.

## Identifier les tâches à réaliser

Maintenant que nous avons une bonne compréhension du patron de conception MVC
(modèles, vues et contrôleurs), nous allons pouvoir mettre en place les
mécanismes nécessaires pour permettre aux utilisateur.trice.s de se créer un
compte, se connecter, et gérer leur compte avec leurs propres posts.

Ces différentes tâchent requièrent de toucher à tous les aspects de
l'application : base de données, vue, composants, etc. Prenez quelques minutes
pour lister les tâches que vous allez devoir réaliser pour cette partie avec
leurs implications.

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir aux tâches que vous allez devoir faire.
>
> N'hésitez pas à proposer d'autres tâches que celles mentionnées dans cet
> exemple.

- TODO

</details>

## Créer le nécessaire pour s'inscrire et se connecter

### Modifier la base de données et les modèles

### Créer les vues

### Créer les contrôleurs et les routes

### Protéger les ressources précédemment créées

Mettre en place les middlewares et les redirections

## Utiliser la personne authentifiée dans le reste de l'application

### Associer la personne authentifiée aux posts

### Associer la personne authentifiée aux likes

## N'autoriser que l'auteur.trice à modifier ses propres posts

Mettre en place les autorisations

## Conclusion

Dans cette partie, nous avons vu comment TODO.

## Solution

La solution du mini-projet est accessible dans un dépôt GitHub dédié à l'adresse
suivante :
<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-mini-projet/tree/mini-projet-6>.

> [!NOTE]
>
> La solution est fournie à titre indicatif uniquement. Il est fortement
> recommandé de développer votre propre version du mini-projet avant de
> consulter la solution.
>
> De plus, cette solution référence un commit spécifique. Des modifications
> peuvent avoir été apportées au dépôt depuis ce commit.
>
> Pour accéder à la version exacte de la solution correspondant à ce commit/tag,
> vous pouvez cloner le dépôt et utiliser la commande Git suivante pour basculer
> sur le commit/tag spécifique :
>
> ```bash
> git checkout <commit-hash> # ou git checkout <tag>
> ```
>
> Remplacez `<commit-hash>` ou `<tag>` par l'identifiant du commit ou du tag
> correspondant à la solution.

## Idées pour le mini-projet personnel

> [!TIP]
>
> Plus tard dans le cours, vous aurez l'occasion de rajouter des fonctionnalités
> à votre mini-projet personnel. Voici quelques idées de fonctionnalités que
> vous pourriez implémenter.

- TODO

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé les exercices et le mini-projet.

- TODO

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
