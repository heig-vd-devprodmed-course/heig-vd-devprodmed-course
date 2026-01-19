# PHP, Composer et Laravel - Mini-projet

L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].

> [!TIP]
>
> Trouvez d'autres informations relatives à ce contenu dans le
> [contenu parent](../README.md).

## Table des matières

- [Table des matières](#table-des-matières)
- [Objectifs](#objectifs)
- [Avertissements et alertes](#avertissements-et-alertes)
- [Mettre en place l'environnement de développement](#mettre-en-place-lenvironnement-de-développement)
  - [Installer et configurer Laravel Herd](#installer-et-configurer-laravel-herd)
  - [Installer et configurer Visual Studio Code](#installer-et-configurer-visual-studio-code)
  - [Valider l'installation et la configuration de l'environnement de développement](#valider-linstallation-et-la-configuration-de-lenvironnement-de-développement)
- [Démarrer le mini-projet](#démarrer-le-mini-projet)
  - [Initialiser le projet Laravel](#initialiser-le-projet-laravel)
  - [Démarrer le serveur de développement Laravel](#démarrer-le-serveur-de-développement-laravel)
  - [Naviguer dans la structure du projet](#naviguer-dans-la-structure-du-projet)
- [Conclusion](#conclusion)
- [Solution](#solution)

## Objectifs

Bienvenue dans la première session du mini-projet qui va vous accompagner durant
toute la durée du cours _"Développement de produit média (DévProdMéd)"_ !

Lors du cours
_"[Programmation serveur 1 (ProgServ1)](https://github.com/heig-vd-progserv-course/heig-vd-progserv1-course)"_,
vous avez appris les bases de PHP et de la programmation serveur à l'aide d'un
mini-projet pour créer un gestionnaire d'animaux de compagnie.

Lors du cours
_"[Programmation serveur 2 (ProgServ2)](https://github.com/heig-vd-progserv-course/heig-vd-progserv2-course)"_,
vous avez approfondi vos connaissances en programmation serveur à l'aide d'un
projet libre.

Dans ce cours _"Développement de produit média (DévProdMéd)"_, vous allez créer
une application web complète en utilisant le framework Laravel. Le mini-projet
reprendra le concept autour d'animaux de compagnie, mais cette fois-ci en
utilisant Laravel pour structurer et simplifier le développement.

Au travers de Laravel, vous retrouverez des concepts vus préalablement, mais
aussi de nouveaux concepts tels que le modèle MVC, les migrations de base de
données, les formulaires, l'authentification, et bien plus encore.

Le mini-projet du cours est un petit réseau social autour des animaux de
compagnie. Vous allez créer une application web qui permettra aux personnes
d'effectuer les actions suivantes sur celle-ci :

- Se créer un compte sur la plateforme.
- Se connecter et se déconnecter.
- Modifier son profil utilisateur.
- Visualiser une liste d'animaux de compagnie partagés par toutes les personnes
  qui utilisent l'application.
- Gérer une liste personnelle d'animaux de compagnie (ajouter, modifier,
  supprimer).
- Créer et partager des posts autour de la thématique des animaux de compagnie.
- Interagir avec les posts des autres personnes qui utilisent l'application
  (aimer, commenter).

L'objectif est de construire une application web complète pour remplir ces
fonctionnalités en utilisant Laravel.

Nous construirons cette application web ensemble durant la durée du cours en
plusieurs étapes. Dans cette séance, nous allons mettre en place l'environnement
de développement et initialiser le projet PHP pour le mini-projet.

De façon plus concise, à l'issue de cette séance, les personnes qui étudient
devraient avoir pu :

- Mettre en place un environnement de développement PHP pour Laravel.
- Initialiser un projet Laravel.
- Lancer le serveur de développement Laravel.
- Explorer la structure d'un projet Laravel.
- Comprendre les étapes à venir pour construire l'application web.

## Avertissements et alertes

En lisant les contenus préparés pour les sessions de mini-projet, vous trouverez
peut-être ce que l'on appelle des _"avertissements"_ ou des _"alertes"_.

Elles se présentent comme suit :

> [!NOTE]
>
> Hé ! Je suis une note ! Merci de m'avoir lue !

Elles sont là pour mettre en évidence des informations importantes dont vous
devez tenir compte.

Voici les différents types d'avertissements que vous pourriez trouver et leur
signification :

> [!NOTE]
>
> Met en évidence les informations que vous devriez prendre en compte.

> [!TIP]
>
> Informations facultatives pour vous aider à mieux réussir avec des conseils,
> des astuces, ou encore des suggestions.

> [!IMPORTANT]
>
> Informations cruciales nécessaires à la réussite des actions que vous devriez
> effectuer.

> [!WARNING]
>
> Contenu critique exigeant votre attention immédiate en raison des risques
> potentiels.

> [!CAUTION]
>
> Conséquences négatives potentielles d'une action que vous devriez éviter.

Nous pourrions vous rediriger vers de la documentation officielle ou des
ressources externes à suivre pour configurer votre environnement ou en savoir
plus sur un sujet spécifique.

Ces ressources externes sont là pour vous aider. Nous vous redirigeons vers
elles pour éviter de répéter ce qui est déjà bien maintenu et expliqué ailleurs.

Ce que vous voyez et faites dans une session actuelle peut être utilisé dans une
session future.

C'est pourquoi il est important de suivre les étapes et de comprendre ce que
vous faites. Vous devez conserver le code que vous écrivez pour les sessions
futures.

Cependant, si _quoi que ce soit_ n'est pas clair, ne fonctionne pas ou nécessite
une amélioration, n'hésitez pas à poser des questions ou nous le signaler.

C'est parti !

## Mettre en place l'environnement de développement

Laravel se reposant sur PHP, tout ce que vous avez appris dans les cours de
_"Programmation serveur 1 (ProgServ1)"_ et _"Programmation serveur 2
(ProgServ2)"_ reste valable.

Il est donc toujours nécessaire d'avoir un environnement de développement PHP
fonctionnel comportant, entre autres :

- Un serveur web (Apache, Nginx, ou le serveur de développement PHP intégré).
- Un interpréteur PHP (version 8.0 ou supérieure recommandée).
- Une base de données (MySQL, PostgreSQL, SQLite, etc.).

[MAMP](https://www.mamp.info/en/) (macOS/Windows) pourrait être une bonne
solution mais nous allons profiter de ce que nous offre Laravel pour simplifier
la configuration.

> [!NOTE]
>
> Si vous souhaitez désinstaller un environnement PHP existant (comme XAMPP,
> MAMP, WAMP, etc.), assurez-vous de sauvegarder vos projets et bases de données
> avant de procéder à la désinstallation.
>
> Vous pouvez utiliser MAMP pour ce cours, mais nous recommandons d'utiliser
> Laravel Herd pour simplifier la configuration pour Laravel.

### Installer et configurer Laravel Herd

Laravel propose des instructions pour installer les dépendances nécessaires à
développer des applications Laravel dans sa documentation officielle :
<https://laravel.com/docs/12.x/installation>.

Cependant, pour simplifier la configuration de l'environnement de développement,
nous allons utiliser [Laravel Herd](https://laravel.com/docs/12.x/herd), un
outil développé par l'équipe de Laravel pour Windows et macOS.

Laravel Herd installe et configure automatiquement PHP, Composer, et d'autres
dépendances nécessaires pour développer avec Laravel.

Suivez les instructions suivantes en fonction de votre système d'exploitation :

- [Installer et configurer Laravel Herd sur Windows](#installer-et-configurer-laravel-herd-sur-windows).
- [Installer et configurer Laravel Herd sur macOS](#installer-et-configurer-laravel-herd-sur-macos).
- [Installer et configurer Laravel Herd sur Linux](#installer-et-configurer-laravel-herd-sur-linux).

#### Installer et configurer Laravel Herd sur Windows

1. Rendez-vous sur la page de téléchargement de Laravel Herd :
   <https://herd.laravel.com/windows> :

   ![Laravel Herd pour Windows (1)](./images/laravel-herd-windows-01.png)

2. Téléchargez la dernière version de Laravel Herd pour Windows.
3. Exécutez le fichier téléchargé. Laravel Herd va automatiquement s'installer.
4. Une fois l'installation terminée, ouvrez Laravel Herd.

   > [!WARNING]
   >
   > J'ai (Ludovic) été confronté à un problème lors de la rédaction de ce
   > contenu. J'ai dû exécuter Laravel Herd en tant qu'administrateur la
   > première fois pour que l'installation se finalise correctement.
   >
   > Par précaution, je vous recommande d'exécuter Laravel Herd en tant
   > qu'administrateur la première fois que vous l'ouvrez (clic droit sur
   > l'icône > "Exécuter en tant qu'administrateur").

5. Une alerte du pare-feu Windows peut apparaître. Assurez-vous d'autoriser
   l'accès pour que Laravel Herd puisse fonctionner correctement :

   ![Laravel Herd pour Windows (2)](./images/laravel-herd-windows-02.png)

   ![Laravel Herd pour Windows (3)](./images/laravel-herd-windows-03.png)

6. Laissez les options par défaut et n'utilisez pas "Laravel Herd Pro" :

   ![Laravel Herd pour Windows (4)](./images/laravel-herd-windows-04.png)

   ![Laravel Herd pour Windows (5)](./images/laravel-herd-windows-05.png)

   ![Laravel Herd pour Windows (6)](./images/laravel-herd-windows-06.png)

   ![Laravel Herd pour Windows (7)](./images/laravel-herd-windows-07.png)

7. Une fois l'installation terminée, ouvrez le tableau de bord de Laravel Herd.
   Celui-ci devrait ressembler à ceci :

   ![Laravel Herd pour Windows (8)](./images/laravel-herd-windows-08.png)

Une fois l'installation terminée, vous pouvez passer à la section
[Valider l'installation de Laravel Herd](#valider-linstallation-de-laravel-herd).

#### Installer et configurer Laravel Herd sur macOS

1. Rendez-vous sur la page de téléchargement de Laravel Herd :
   <https://herd.laravel.com>.
2. Téléchargez la dernière version de Laravel Herd pour macOS.
3. Ouvrez le fichier téléchargé et faites glisser l'icône de Laravel Herd dans
   le dossier _"Applications"_.
4. Ouvrez Laravel Herd depuis le dossier _"Applications"_.

Une fois l'installation terminée, vous pouvez passer à la section
[Valider l'installation de Laravel Herd](#valider-linstallation-de-laravel-herd).

#### Installer et configurer Laravel Herd sur Linux

Laravel Herd n'est pas disponible pour Linux. Cependant, vous pouvez suivre les
instructions officielles de Laravel pour installer PHP, Composer, et les autres
dépendances nécessaires à Laravel sur Linux
:<https://laravel.com/docs/12.x/installation>.

Une fois l'installation terminée, vous pouvez passer à la section
[Valider l'installation de Laravel Herd](#valider-linstallation-de-laravel-herd).

#### Valider l'installation de Laravel Herd

Maintenant que Laravel Herd est installé, nous allons vérifier que tout
fonctionne correctement.

Ouvrez un terminal (_"Invite de commandes"_, _"PowerShell"_, ou _"Windows
Terminal"_ sous Windows ; _"Terminal"_ sous macOS ou Linux).

Dans le terminal, exécutez la commande suivante pour vérifier que PHP est
installé correctement :

```sh
php --version
```

Le résultat devrait ressembler à ceci :

```text
PHP 8.4.16 (cli) (built: ...)
```

Cela indique que PHP est installé et prêt à être utilisé.

Ensuite, vérifiez que Composer est installé correctement en exécutant la
commande suivante :

```sh
composer --version
```

Le résultat devrait ressembler à ceci :

```text
Composer version 2.9.1 ...
```

Cela indique que Composer est installé et prêt à être utilisé.

Dans le terminal, exécutez la commande suivante pour vérifier que Laravel est
installé correctement :

```sh
laravel --version
```

Le résultat devrait ressembler à ceci :

```text
Laravel Installer 5.23.0
```

Cela indique que l'outil de ligne de commande Laravel est installé et prêt à
être utilisé.

Dans le terminal, exécutez la commande suivante pour vérifier que npm est
installé correctement :

```sh
npm --version
```

Le résultat devrait ressembler à ceci :

```text
11.6.2
```

Cela indique que npm est installé et prêt à être utilisé.

### Installer et configurer Visual Studio Code

#### Installer Visual Studio Code

Si vous n'avez pas encore installé Visual Studio Code, suivez les instructions
officielles pour l'installer sur votre système d'exploitation :
<https://code.visualstudio.com/docs/setup/setup-overview>.

#### Installer l'extension Laravel pour Visual Studio Code

Ensuite, installez l'extension
[Laravel for Visual Studio Code](https://marketplace.visualstudio.com/items?itemName=laravel.vscode-laravel)
pour améliorer votre expérience de développement avec Laravel.

#### Ouvrir un terminal intégré dans Visual Studio Code

Afin de ne pas avoir à basculer entre plusieurs applications, nous allons
utiliser le terminal intégré de Visual Studio Code.

1. Ouvrez Visual Studio Code.
2. Ouvrez le terminal intégré en allant dans le menu _"Terminal"_ > _"New
   Terminal"_.
3. Le terminal devrait s'ouvrir en bas de la fenêtre de Visual Studio Code.

Cela vous permettra d'exécuter des commandes directement depuis Visual Studio
sans avoir à ouvrir une application de terminal séparée.

### Valider l'installation et la configuration de l'environnement de développement

- [x] PHP est installé et fonctionne correctement.
- [x] Composer est installé et fonctionne correctement.
- [x] Laravel est installé et fonctionne correctement.
- [x] npm est installé et fonctionne correctement.
- [x] Visual Studio Code est installé et fonctionne correctement.
- [x] L'extension Laravel pour Visual Studio Code est installée.
- [x] Le terminal intégré de Visual Studio Code est fonctionnel.

## Démarrer le mini-projet

### Initialiser le projet Laravel

A présent que l'environnement de développement est prêt, nous allons initialiser
le mini-projet avec Laravel.

Dans le terminal intégré de Visual Studio Code, naviguez vers le dossier où vous
souhaitez créer le projet Laravel pour le mini-projet, par exemple le dossier
`Documents`.

Ensuite, exécutez la commande suivante pour créer un nouveau projet Laravel
nommé `devprodmed-mini-projet` :

```sh
laravel new devprodmed-mini-projet
```

Un menu interactif peut apparaître pour vous demander de choisir certaines
options. Choisissez les options suivantes à l'aide des flèches du clavier et
appuyez sur la touche _Entrée_ pour valider vos choix :

```text
   _                               _
  | |                             | |
  | |     __ _ _ __ __ ___   _____| |
  | |    / _` |  __/ _` \ \ / / _ \ |
  | |___| (_| | | | (_| |\ V /  __/ |
  |______\__,_|_|  \__,_| \_/ \___|_|


 ┌ Which starter kit would you like to install? ────────────────┐
 │ › ● None                                                     │
 │   ○ React                                                    │
 │   ○ Vue                                                      │
 │   ○ Livewire                                                 │
 └──────────────────────────────────────────────────────────────┘

 ┌ Which testing framework do you prefer? ──────────────────────┐
 │ › ● Pest                                                     │
 │   ○ PHPUnit                                                  │
 └──────────────────────────────────────────────────────────────┘

 ┌ Do you want to install Laravel Boost to improve AI assisted coding? ┐
 │ ○ Yes / ● No                                                        │
 └─────────────────────────────────────────────────────────────────────┘

 ┌ Which database will your application use? ───────────────────┐
 │ › ● SQLite                                                   │
 │   ○ MySQL                                                    │
 │   ○ MariaDB                                                  │
 │   ○ PostgreSQL                                               │
 │   ○ SQL Server                                               │
 └──────────────────────────────────────────────────────────────┘

 ┌ Would you like to run npm install and npm run build? ────────┐
 │ ● Yes / ○ No                                                 │
 └──────────────────────────────────────────────────────────────┘
```

Cette commande va créer un nouveau dossier `devprodmed-mini-projet` contenant la
structure de base d'un projet Laravel.

### Démarrer le serveur de développement Laravel

Dans le terminal intégré de Visual Studio Code, naviguez dans le dossier du
projet Laravel que vous venez de créer :

```sh
cd devprodmed-mini-projet
```

Ensuite, exécutez la commande suivante pour démarrer le serveur de développement
Laravel :

```sh
composer run dev
```

### Naviguer dans la structure du projet

## Conclusion

Félicitations ! Vous avez mis en place votre environnement de développement et
initialisé votre projet Laravel pour le mini-projet.

Vous êtes maintenant prêt à commencer à développer votre application web autour
des animaux de compagnie en utilisant Laravel.

## Solution

Vous pouvez trouver la solution du mini-projet à l'adresse suivante :
[Solution](./solution/README.md).

<!-- URLs -->

[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md
