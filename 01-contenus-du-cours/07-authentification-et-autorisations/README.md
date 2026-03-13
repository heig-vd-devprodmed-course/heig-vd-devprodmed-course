# Authentification et autorisations

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Voici quelques informations relatives à ce contenu.
>
> **Ressources annexes**
>
> - Autres formats du support de cours : [Présentation (web)][presentation-web]
>   · [Présentation (PDF)][presentation-pdf].
> - Exercices : [Accéder au contenu](./01-exercices/README.md).
> - Mini-projet : [Accéder au contenu](./02-mini-projet/README.md).
>
> **Objectifs**
>
> À l'issue de cette séance, les personnes qui étudient devraient être capables
> de :
>
> - TODO
>
> **Méthodes d'enseignement et d'apprentissage**
>
> Les méthodes d'enseignement et d'apprentissage utilisées pour animer la séance
> sont les suivantes :
>
> - Présentation magistrale.
> - Discussions collectives.
> - Travail en autonomie.
>
> **Méthodes d'évaluation**
>
> L'évaluation prend la forme d'exercices et d'un mini-projet à réaliser en
> autonomie en classe ou à la maison.
>
> L'évaluation se fait en utilisant les critères suivants :
>
> - Capacité à répondre avec justesse.
> - Capacité à argumenter.
> - Capacité à réaliser les tâches demandées.
> - Capacité à s'approprier les exemples de code.
> - Capacité à appliquer les exemples de code à des situations similaires.
>
> Les retours se font de la manière suivante :
>
> - Corrigé des exercices.
> - Corrigé du mini-projet.
>
> L'évaluation ne donne pas lieu à une note.

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Avertissement](#avertissement)
- [Authentification et autorisations, un rappel](#authentification-et-autorisations-un-rappel)
  - [Authentification](#authentification)
  - [Autorisation](#autorisation)
  - [Stocker les mots de passe de manière sécurisée](#stocker-les-mots-de-passe-de-manière-sécurisée)
  - [Liens avec les sessions](#liens-avec-les-sessions)
- [Les classes Auth, Hash et Session](#les-classes-auth-hash-et-session)
  - [Auth](#auth)
  - [Hash](#hash)
- [](#)
- [Les middlewares d'authentification et d'autorisation](#les-middlewares-dauthentification-et-dautorisation)
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [Questions d'évaluation](#questions-dévaluation)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs de permettre aux personnes qui étudient de
maîtriser les concepts liés à l'authentification et à l'autorisation dans le
développement d'applications web avec Laravel.

Ce contenu repose sur la documentation officielle suivante :

- <https://laravel.com/docs/12.x/authentication> et ses sous-sections.
- <https://laravel.com/docs/12.x/authorization> et ses sous-sections.
- <https://laravel.com/docs/12.x/hashing> et ses sous-sections.
- <https://laravel.com/docs/12.x/middleware> et ses sous-sections.
- <https://laravel.com/docs/12.x/session> et ses sous-sections.
- <https://laravel.com/docs/12.x/encryption> et ses sous-sections.

La liste complète des objectifs est disponible dans la section _"Objectifs"_ du
bloc d'information en haut de ce contenu.

## Avertissement

Il existe de multiples solutions pour implémenter l'authentification et
l'autorisation dans une application Laravel, entre autres en utilisant des
dépendances tierces telles que :

- [Laravel Fortify](https://laravel.com/docs/12.x/fortify).
- [Laravel Passport](https://laravel.com/docs/12.x/passport).
- [Laravel Sanctum](https://laravel.com/docs/12.x/sanctum).
- [Laravel Socialite](https://laravel.com/docs/12.x/socialite).

Par le passé, il était également possible d'utiliser des packages tiers tels que
Laravel Breeze et Laravel Jetstream, mais ces deux solutions ne sont plus
maintenues depuis la version 12 de Laravel (source :
<https://laravel.com/docs/12.x/releases#new-application-starter-kits>).

Toutes ces solutions ont pour but de faciliter l'implémentation de
l'authentification et de l'autorisation dans une application Laravel, mais elles
peuvent être complexes à comprendre et à utiliser pour les personnes qui
débutent dans le développement web ou qui souhaitent comprendre les concepts
fondamentaux de l'authentification et de l'autorisation avec Laravel.

De ce fait, dans ce contenu, nous allons utiliser les briques de base fournies
par Laravel pour implémenter l'authentification et l'autorisation, afin de
permettre aux personnes qui étudient de comprendre les concepts fondamentaux et
de maîtriser les outils de base avant d'utiliser des solutions plus complexes.

Lorsque vous aurez plus d'expérience avec Laravel et que vous serez à l'aise
avec les concepts fondamentaux, vous pourrez explorer les solutions tierces
mentionnées ci-dessus pour voir comment elles peuvent faciliter l'implémentation
de l'authentification et de l'autorisation dans vos applications Laravel.

## Authentification et autorisations, un rappel

### Authentification

### Autorisation

### Stocker les mots de passe de manière sécurisée

### Liens avec les sessions

## Les classes Auth et Hash

### Auth

### Hash

## Gates, policies et middlewares d'autorisation

### Gates

### Policies

### Middlewares

## Conclusion

Dans cette séance, nous avons vu comment TODO.

## Exercices

Nous vous invitons maintenant à réaliser les exercices de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les exercices et leur corrigé ici :
[Exercices](./01-exercices/README.md).

## Mini-projet

Nous vous invitons maintenant à réaliser le mini-projet de la séance afin de
mettre en pratique les concepts abordés.

Vous trouverez les détails du mini-projet ici :
[Mini-projet](./02-mini-projet/README.md).

## Questions d'évaluation

> [!NOTE]
>
> Les questions d'évaluation sont destinées à vous aider à vérifier votre
> compréhension des concepts abordés dans le cours. Elles ne sont pas destinées
> à être utilisées comme une liste de contrôle exhaustive des compétences à
> maîtriser.
>
> Il est recommandé de les utiliser comme un guide pour vous aider à identifier
> les domaines dans lesquels vous pourriez avoir besoin de renforcer vos
> connaissances ou de pratiquer davantage.

- TODO

## À faire pour la prochaine séance

Chaque personne est libre de gérer son temps comme elle le souhaite. Cependant,
il est recommandé pour la prochaine séance de :

- Relire le support de cours si nécessaire.
- Finaliser les exercices qui n'ont pas été terminés en classe.
- Finaliser la partie du mini-projet qui n'a pas été terminée en classe.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
[presentation-web]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/07-authentification-et-autorisations/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/07-authentification-et-autorisations/07-authentification-et-autorisations-presentation.pdf
