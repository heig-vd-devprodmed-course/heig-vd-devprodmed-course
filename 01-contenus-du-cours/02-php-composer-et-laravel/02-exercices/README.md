# PHP, Composer et Laravel - Exercices

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Toutes les informations relatives à ce contenu sont décrites dans le
> [contenu principal](../README.md).

## Table des matières

- [Table des matières](#table-des-matières)
- [Exercices](#exercices)
  - [Exercice 1](#exercice-1)
  - [Exercice 2](#exercice-2)
  - [Exercice 3](#exercice-3)
  - [Exercice 4](#exercice-4)
  - [Exercice 5](#exercice-5)
  - [Exercice 6 - Bonus](#exercice-6---bonus)

## Exercices

> [!NOTE]
>
> Bien que ces exercices puissent paraître simples et que leur solution est
> disponible dans ce même document, il est fortement recommandé de les réaliser
> sans consulter les solutions au préalable.
>
> Ils ont pour but de vous former et de pratiquer les concepts vus dans le
> contenu de cours.
>
> Il est donc important de les faire par vous-même avant de vérifier vos
> réponses avec les solutions fournies.

### Exercice 1

Où peut-on trouver la documentation officielle de Laravel ?

<details>
<summary>Afficher la solution</summary>

- La documentation officielle de Laravel se trouve à l'adresse suivante :
  <https://laravel.com/docs>.

</details>

### Exercice 2

Où peut-on trouver des vidéos de formation officielles sur Laravel ?

<details>
<summary>Afficher la solution</summary>

- Les vidéos de formation officielles sur Laravel sont disponibles sur
  [Laracasts](https://laracasts.com).

</details>

### Exercice 3

Répondez aux questions suivantes :

1. Où peut-on trouver dans la documentation officielle la ou les commandes qui
   permettent de créer et lancer un nouveau projet Laravel ?
2. Lesquelles sont-elles ? Décrivez-les étape par étape.
3. À quelle adresse devons-nous nous rendre pour voir le projet Laravel
   fonctionner une fois lancé ?

<details>
<summary>Afficher la solution</summary>

- La documentation officielle de Laravel indique les étapes pour créer un
  nouveau projet Laravel à l'adresse suivante :
  <https://laravel.com/docs/12.x#creating-an-application>.
- Les commandes pour créer un nouveau projet Laravel sont :

  ```bash
  # Créer un nouveau projet Laravel dans le dossier `example-app`
  laravel new example-app

  # Se déplacer dans le dossier du projet
  cd example-app

  # Installer les dépendances JavaScript et compiler les assets nécessaires à Laravel
  npm install && npm run build

  # Lancer le serveur de développement
  composer run dev
  ```

- Une fois le projet lancé, nous devons nous rendre à l'adresse
  <http://localhost:8000> pour voir le projet Laravel fonctionner.

</details>

### Exercice 4

Quel est le nom du fichier utilisé par Composer pour gérer les dépendances d'un
projet PHP ? Que contient-il ?

<details>
<summary>Afficher la solution</summary>

- Le fichier utilisé par Composer pour gérer les dépendances d'un projet PHP est
  `composer.json`.
- Ce fichier contient des informations sur le projet, telles que son nom, sa
  description, les dépendances requises, les scripts à exécuter, et d'autres
  métadonnées liées au projet. Il contient notamment le script `dev` qui permet
  de lancer le serveur de développement Laravel utilisé préalablement.

</details>

### Exercice 5

Créez un nouveau projet Laravel nommé `devprodmed-exercices` à l'aide de tout ce
que vous avez appris jusqu'à présent. Stockez ce projet dans un endroit où vous
pourrez le retrouver facilement pour les prochaines séances du cours.

> [!IMPORTANT]
>
> Ce projet sera utilisé pour les exercices pratiques dans les prochaines
> séances du cours.
>
> Assurez-vous de bien suivre les étapes et de noter toute difficulté rencontrée
> afin de pouvoir en discuter en classe.

### Exercice 6 - Bonus

Si vous le souhaitez, vous pouvez également initialiser un dépôt Git/GitHub pour
ce nouveau projet Laravel sur votre compte GitHub personnel.

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
