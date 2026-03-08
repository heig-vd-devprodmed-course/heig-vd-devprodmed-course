# Formulaires et validation

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
> - Décrire la partie "contrôleur" du patron de conception MVC.
> - Lister les différentes méthodes HTTP et leur utilisation.
> - Décrire le concept de routes dans une application Laravel.
> - Définir des routes avec des paramètres dans Laravel.
> - Créer des contrôleurs dans Laravel.
> - Utiliser les contrôleurs pour gérer les requêtes HTTP et retourner des
>   réponses.
> - Résumer les concepts du patron MVC, leur rôle dans une application web et
>   les dossiers où les trouver dans une application Laravel.
> - Implémenter ces concepts avec Laravel pour réaliser le petit réseau social
>   du mini-projet.
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
- [Conclusion](#conclusion)
- [Exercices](#exercices)
- [Mini-projet](#mini-projet)
- [Questions d'évaluation](#questions-dévaluation)
- [À faire pour la prochaine séance](#à-faire-pour-la-prochaine-séance)

## Objectifs

Ce contenu de cours a pour objectifs de permettre aux personnes qui étudient de
maîtriser la création de routes avec des paramètres et l'utilisation de
contrôleurs dans Laravel afin de gérer les requêtes HTTP et de retourner des
réponses appropriées, en coordination avec les modèles et les vues.

Ce contenu repose sur la documentation officielle suivante :

- <https://laravel.com/docs/12.x/csrf> et ses sous-sections.
- <https://laravel.com/docs/12.x/validation> et ses sous-sections.
- <https://laravel.com/docs/12.x/session> et ses sous-sections.
- <https://laravel.com/docs/12.x/filesystem> et ses sous-sections.

TODO

- <https://laravel.com/docs/12.x/routing> et ses sous-sections.
- <https://laravel.com/docs/12.x/requests> et ses sous-sections.
- <https://laravel.com/docs/12.x/responses> et ses sous-sections.
- <https://laravel.com/docs/12.x/controllers> et ses sous-sections.
- <https://laravel.com/docs/12.x/errors> et ses sous-sections.

La liste complète des objectifs est disponible dans la section _"Objectifs"_ du
bloc d'information en haut de ce contenu.

## Conclusion

Dans cette séance, nous avons exploré les contrôleurs dans le contexte du patron
MVC et appris à créer des contrôleurs dans Laravel. Voici les points clés à
retenir :

- Les **contrôleurs** sont responsables de la gestion des requêtes HTTP et du
  flux de l'application dans le patron MVC.
- Ils interagissent avec les **modèles** pour récupérer ou manipuler des
  données.
- Ils appellent les **vues** pour afficher les résultats.
- Ils retournent des **réponses HTTP** appropriées. (View), qui sont
  responsables de la présentation des données à la personne qui utilise
  l'application.

Dans le patron MVC, les vues ont pour responsabilité de :

- Afficher les données fournies par les contrôleurs (que nous verrons plus en
  détail dans une prochaine séance).
- Présenter l'interface utilisateur de manière claire et attractive.
- Structurer le contenu HTML de manière logique et sémantique.
- Ne pas contenir de logique métier (cette responsabilité appartient aux modèles
  et contrôleurs).

Les vues ne doivent pas accéder directement à la base de données ni effectuer de
calculs complexes. Elles reçoivent des données déjà préparées et se contentent
de les afficher de manière appropriée.

Cette séparation entre la logique métier (modèles), la logique de présentation
(vues) et la logique de contrôle (contrôleurs) offre plusieurs avantages :

- **Maintenabilité** : les modifications de l'interface utilisateur n'affectent
  pas la logique métier.
- **Réutilisabilité** : les mêmes données peuvent être affichées de différentes
  manières (web, mobile, API).
- **Testabilité** : chaque composant peut être testé indépendamment.
- **Collaboration** : les personnes qui développent peuvent se spécialiser dans
  différents aspects de l'application.

Vous avez maintenant de solides bases pour comprendre et développer des
applications avec Laravel en utilisant le patron MVC.

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

- Quel est le rôle des vues dans le patron de conception MVC ?
- Quels sont les avantages d'utiliser un moteur de template par rapport à du PHP
  pur dans le HTML ?
- Pourquoi est-il important de mettre en place l'internationalisation dès le
  début du développement, même pour une application monolingue ?
- Comment créer une vue Blade avec la commande Artisan ?
- Comment passe-t-on du contenu à un composant Blade ?
- Quelle est la différence entre un slot par défaut et un slot nommé ?
- Comment créer un composant Blade avec Artisan ?
- Pourquoi utilise-t-on le préfixe `:` devant certains attributs de composants
  (ex : `:post="$post"`) ?
- À quoi servent les variables `APP_LOCALE` et `APP_FALLBACK_LOCALE` ?
- Quelle est la différence entre un fichier de traduction PHP et un fichier JSON
  ?
- Comment accède-t-on à une traduction dans une vue Blade ?
- Comment gère-t-on les formes plurielles dans les traductions Laravel ?
- Quelle est la différence entre les fichiers `.env` et `.env.example` ?
- Pourquoi ne doit-on jamais commiter le fichier `.env` dans Git ?
- Quelle fonction doit-on utiliser pour accéder aux configurations dans le code
  de l'application (en dehors des fichiers de configuration) ?
- Quelle est la différence entre l'approche CSS classique et l'approche
  utility-first de Tailwind ?

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
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/06-formulaires-et-validation/presentation.html
[presentation-pdf]:
	https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/06-formulaires-et-validation/06-formulaires-et-validation-presentation.pdf
