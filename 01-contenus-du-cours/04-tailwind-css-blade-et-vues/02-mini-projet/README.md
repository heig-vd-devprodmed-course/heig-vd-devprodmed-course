# Tailwind CSS, Blade et vues - Mini-projet

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
- [Identifier les pages de l'interface utilisateur et leur structure](#identifier-les-pages-de-linterface-utilisateur-et-leur-structure)
- [Supprimer les vues et les routes de base créées par Laravel](#supprimer-les-vues-et-les-routes-de-base-créées-par-laravel)
- [Créer un layout commun](#créer-un-layout-commun)
  - [Créer l'issue et la branche pour cette tâche](#créer-lissue-et-la-branche-pour-cette-tâche)
  - [Balises HTML de base](#balises-html-de-base)
  - [En-tête et menu de navigation](#en-tête-et-menu-de-navigation)
  - [Pied de page](#pied-de-page)
  - [Valider les modifications et fusionner la pull request](#valider-les-modifications-et-fusionner-la-pull-request)
- [Créer notre première vue de test](#créer-notre-première-vue-de-test)
  - [Créer l'issue et la branche pour cette tâche](#créer-lissue-et-la-branche-pour-cette-tâche-1)
  - [Créer la vue de test](#créer-la-vue-de-test)
  - [Créer la route pour la vue de test](#créer-la-route-pour-la-vue-de-test)
  - [Visualiser les résultats dans le navigateur](#visualiser-les-résultats-dans-le-navigateur)
  - [Valider les modifications et fusionner la pull request](#valider-les-modifications-et-fusionner-la-pull-request-1)
- [Mettre en place l'internationalisation (i18n)](#mettre-en-place-linternationalisation-i18n)
  - [Installer une librairie externe pour les clés de traduction](#installer-une-librairie-externe-pour-les-clés-de-traduction)
  - [Ajouter les clés de traduction pour la langue française](#ajouter-les-clés-de-traduction-pour-la-langue-française)
  - [Configurer la langue par défaut et de la langue de secours](#configurer-la-langue-par-défaut-et-de-la-langue-de-secours)
  - [Intégrer les traductions dans les vues](#intégrer-les-traductions-dans-les-vues)
  - [Valider les modifications et fusionner la pull request](#valider-les-modifications-et-fusionner-la-pull-request-2)
- [Créer des vues pour les différentes pages](#créer-des-vues-pour-les-différentes-pages)
  - [Page d'accueil (feed)](#page-daccueil-feed)
  - [Page de profil](#page-de-profil)
  - [Page de visualisation d'une publication](#page-de-visualisation-dune-publication)
- [Créer un composant de publication](#créer-un-composant-de-publication)
- [Conclusion](#conclusion)
- [Solution](#solution)
- [Idées pour le mini-projet personnel](#idées-pour-le-mini-projet-personnel)
- [Aller plus loin](#aller-plus-loin)

## Objectifs

Mettre en place l'interface utilisateur du petit réseau social en utilisant
Tailwind CSS et Blade.

## Identifier les pages de l'interface utilisateur et leur structure

Avant de commencer à coder, il est important d'identifier les différentes pages
et leur structure que nous allons devoir créer pour notre application de réseau
social.

A l'aide d'un outil de prototypage ou simplement d'un dessin sur papier, essayez
d'identifier les différentes pages de l'interface utilisateur et leur structure
que vous allez devoir créer pour votre application de réseau social.

<details>
<summary>Exemple de réponse</summary>

> [!NOTE]
>
> Ceci est un exemple de réponse possible. D'autres réponses sont possibles et
> valides. L'objectif est de réfléchir aux pages de l'interface utilisateur et à
> leur structure.
>
> N'hésitez pas à proposer d'autres pages ou structures que celles mentionnées
> dans cet exemple.

Je (Ludovic) n'ai pas pris le temps de réaliser des esquisses (wireframes) ou
des maquettes (mockups) pour ce projet, mais voici une liste non exhaustive des
pages et des structures que je pense qu'il est important d'avoir pour
l'interface utilisateur d'un réseau social.

**Pages**

- Page d'accueil (feed) : affiche les publications des utilisateur.trices.
- Page de profil : affiche les informations d'un utilisateur.trice et ses
  publications.
- Page de création de publication : permet à un utilisateur.trice de créer une
  nouvelle publication.
- Page de détails d'une publication : affiche les détails d'une publication.
- Page de modification d'une publication : permet à un.e utilisateur.trice de
  modifier une publication qu'il/elle a créée.
- Page de suppression d'une publication : permet à un.e utilisateur.trice de
  supprimer une publication qu'il/elle a créée.

De façon plus large, il y a aussi des pages liées à la gestion du compte
utilisateur qui sont importantes à avoir pour un réseau social, telles que :

- Page d'inscription : Permet à un.e nouvel.le utilisateur.trice de créer un
  compte.
- Page de connexion : Permet à un.e utilisateur.trice de se connecter à son
  compte.
- Page de déconnexion : Permet à un.e utilisateur.trice de se déconnecter de son
  compte.
- Page de modification de profil : permet à un.e utilisateur.trice de modifier
  ses informations personnelles (mot de passe y compris).
- Page de suppression de compte : permet à un.e utilisateur.trice de supprimer
  son compte.
- Page de réinitialisation du mot de passe : Permet à un.e utilisateur.trice de
  réinitialiser son mot de passe en cas d'oubli.

Une majorité de ces pages supplémentaires seront créées plus tard dans le cours.

**Structure des pages**

Le réseau social étant une application relativement simple, toutes les pages
devraient avoir une structure de base commune.

Cette structure comporte (entre autres) :

- Un en-tête (header) avec les balises HTML de base (doctype, html, head, body).
- Un menu de navigation permettant d'accéder aux différentes pages du site.
- Un contenu principal (main content) qui affiche les informations spécifiques à
  chaque page.
- Un pied de page (footer) avec des informations de copyright et éventuellement
  des liens vers d'autres ressources (politique de confidentialité, conditions
  d'utilisation, etc.).

**Composants réutilisables**

Pour aller plus loin, il est aussi possible d'identifier des composants
réutilisables qui pourraient être utilisés sur plusieurs pages de l'application.
Par exemple :

- Un layout commun qui définit la structure de base de toutes les pages
  (en-tête, menu de navigation, pied de page).
- Un composant de publication qui affiche les informations d'une publication
  (auteur, contenu, date de création, etc.) et qui peut être utilisé sur la page
  d'accueil, la page de profil, la page de détails d'une publication, etc.
- Un composant de formulaire de publication qui permet à un.e utilisateur.trice
  de créer ou de modifier une publication et qui peut être utilisé sur la page
  de création de publication et la page de modification de publication.

</details>

## Supprimer les vues et les routes de base créées par Laravel

Comme lors de la séance précédente, lors de l'initialisation d'un projet
Laravel, certains fichiers de base sont créés automatiquement.

Ces fichiers peuvent être utilisés tels quels, mais pour ce mini-projet, nous
allons les supprimer afin de créer nos propres vues et routes à partir de zéro.

Comme pour les séances précédentes, nous allons suivre les bonnes pratiques de
développement en créant une branche dédiée à cette tâche, en créant une pull
request pour suivre les modifications, et en fusionnant la pull request une fois
que les modifications sont terminées.

Commencez par créer l'issue sur GitHub pour suivre cette tâche, puis créez la
branche correspondante à partir de la branche principale `main`.

Basculez sur la branche que vous venez de créer, puis supprimez le fichier
`resources/views/welcome.blade.php`.

Modifiez ensuite le fichier `routes/web.php` pour supprimer la route de base qui
affiche la vue `welcome` :

```php
Route::get('/', function () {
    return view('welcome');
});
```

Une fois que vous avez supprimé la vue et la route de base, valider les
modifications dans Git, puis vous pouvez créer la pull request.

Validez la pull request et fusionnez-la une fois que les modifications sont
terminées. Vous pouvez ensuite supprimer la branche que vous avez créée pour
cette tâche.

## Créer un layout commun

Blade permet de créer des layouts communs pour les différentes pages de votre
application. Cela permet de définir une structure de base pour votre site et de
réutiliser cette structure sur toutes les pages.

Dans cette section, nous allons créer un layout commun pour notre application de
réseau social. Ce layout contiendra les éléments suivants :

- Les balises HTML de base (doctype, html, head, body).
- Un en-tête avec le nom de l'application et un menu de navigation.
- Un pied de page avec des informations de copyright et éventuellement des liens
  vers d'autres ressources (politique de confidentialité, conditions
  d'utilisation, etc.).

### Créer l'issue et la branche pour cette tâche

### Balises HTML de base

### En-tête et menu de navigation

Passer d'une page à l'autre dans une application web se fait généralement en
cliquant sur des liens de navigation. Ces liens sont généralement regroupés dans
un menu de navigation qui est présent sur toutes les pages de l'application.

### Pied de page

### Valider les modifications et fusionner la pull request

## Créer notre première vue de test

Avant de créer les vues pour les différentes pages de notre application, nous
allons créer une vue de test pour vérifier que notre layout commun fonctionne
correctement.

### Créer l'issue et la branche pour cette tâche

### Créer la vue de test

### Créer la route pour la vue de test

### Visualiser les résultats dans le navigateur

#### Mode desktop

#### Mode mobile

#### Light mode et dark mode

### Valider les modifications et fusionner la pull request

## Mettre en place l'internationalisation (i18n)

### Installer une librairie externe pour les clés de traduction

### Ajouter les clés de traduction pour la langue française

### Configurer la langue par défaut et de la langue de secours

### Intégrer les traductions dans les vues

### Valider les modifications et fusionner la pull request

## Créer des vues pour les différentes pages

### Page d'accueil (feed)

### Page de profil

### Page de visualisation d'une publication

A voir ?

## Créer un composant de publication

## Conclusion

TODO

## Solution

La solution du mini-projet est accessible dans un dépôt GitHub dédié à l'adresse
suivante : <TODO>.

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

- Permettre de changer la langue de l'interface utilisateur (i18n) en ajoutant
  un sélecteur de langue dans le menu de navigation.

## Aller plus loin

> [!TIP]
>
> Cette section est optionnelle.
>
> Vous pouvez y revenir si vous avez du temps ou si vous souhaitez approfondir
> vos connaissances après avoir terminé les exercices et le mini-projet.

- Seriez-vous capable de ... ?

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
