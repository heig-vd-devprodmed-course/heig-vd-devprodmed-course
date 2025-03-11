# `Laravel` - La construction d’applications web pour tous

[Source](https://kinsta.com/fr/base-de-connaissances/qu-est-ce-que-laravel/)

Le développement d’applications web et de sites est devenu de plus en plus
simple ces dernières années. Même les plus novices en matière de technologie
sont devenus assez habiles avec des produits tels que `WordPress` et `Wix`.

Pour les développeurs plus avancés, il existe une multitude d’outils permettant
de simplifier le processus de développement. L’un de ces outils les plus utiles
est `Laravel`.

## Qu’est-ce que `Laravel` ?

### `Laravel` est un `framework PHP` multi-plateforme permettant de créer des applications web.

`Laravel` permet à un développeur de tirer parti d’une vaste bibliothèque de
fonctionnalités pré-programmées (telles que l’authentification, le routage et la
création de modèles HTML). L’accès à cette bibliothèque simplifie la création
rapide d’applications web robustes tout en minimisant la quantité de code
nécessaire.

`Laravel` offre un environnement de développement très fonctionnel, ainsi que
des interfaces de ligne de commande intuitives et expressives. En outre,
`Laravel` utilise le mapping objet-relationnel (ORM) pour simplifier l’accès et
la manipulation des données.

> Le **mapping objet-relationnel** (en anglais **object-relational mapping** ou
> **ORM**) est un type de programme informatique qui se place en interface entre
> un programme applicatif et une
> [base de données relationnelle](https://fr.wikipedia.org/wiki/Base_de_données_relationnelle)
> pour simuler une
> [base de données orientée objet](https://fr.wikipedia.org/wiki/Base_de_données_orientée_objet).

Les applications `Laravel` sont hautement évolutives et leur base de code est
facile à maintenir. Les développeurs peuvent également ajouter des
fonctionnalités à leurs applications de manière transparente, grâce au système
de packaging modulaire de `Laravel` et à la gestion robuste des dépendances.

### `Laravel` est un `framework` PHP basé sur les principes de la programmation orientée objet (POO)

Un `framework` fournit un ensemble de bibliothèques de code contenant des
modules préprogrammés qui permettent à un utilisateur de construire des
applications plus rapidement. Il offre aux développeurs web un certain nombre
d’avantages, notamment un développement plus rapide, un besoin réduit d’écrire
du code et une sécurité renforcée. Il aide également les développeurs novices à
acquérir de bonnes pratiques de code, car ils exigent une organisation
spécifique du code. Les `frameworks` nécessitent généralement moins de
maintenance que les applications créées de toutes pièces. Comme `Laravel` est un
`framework` PHP orientés objet, il est utile d’avoir une compréhension de base
des concepts tels que les classes, les objets, l’héritage, le polymorphisme
avant de se plonger dedans.

### PHP est un langage de script

PHP (acronyme récursif de `PHP Hypertext Preprocessor`) est un langage de script
open source, côté serveur, largement utilisé pour le développement web. (Selon
les données de [W3Techs](https://w3techs.com/), au début de l’année 2021, près
de 80 % des sites web utilisaient PHP.) Les applications créées à l’aide de
langages de script sont compilées au moment de l’exécution, ce qui signifie que
chaque instruction est interprétée individuellement au moment de l’exécution, ce
qui rend l’application plus lente qu’une application pré-compilée. La
compilation au moment de l’exécution entraîne également l’arrêt ou la fermeture
de l’application si elle rencontre une erreur au moment de l’exécution; en
revanche, les applications pré-compilées effectuent un contrôle des erreurs
pendant la compilation, ce qui les rend plus robustes au moment de l’exécution.
Pour de nombreux utilisateurs, cependant, les inconvénients des langages de
script sont plus que compensés par leur facilité d’utilisation.

### `Laravel` est-il Frontend ou Backend ?

`Laravel` est principalement un `framework` de développement Backend, bien qu’il
offre quelques fonctionnalités Frontend.

### `Laravel` utilise le motif d'architecture logicielle MVC (Modèle-Vue-Contrôleur)

Le modèle est constitué des données de l’application, ainsi que de toute la
logique associée. (Ex : Une liste d’abonnés) La vue fournit un point
d’interaction avec un utilisateur, où les données du modèle peuvent être
visualisées et modifiées. Le contrôleur est un conduit entre la vue et le
modèle. En d’autres termes, le contrôleur prend les requêtes de l’utilisateur,
récupère les informations requises dans le modèle, les traite et les renvoie à
la vue.

![mvc](img\mvc.png)

## Pourquoi utiliser `Laravel` ?

Voici quelques-uns des avantages spécifiques de `Laravel` :

- ### `Laravel` est facile à apprendre;

  > pour qui possède :
  >
  > - Compréhension générale des concepts de Programmation Orientée Objet (POO)
  > - Notions de HTML.
  > - Compréhension des systèmes de gestion de bases de données relationnelles
  >   (MySQL, PostgreSQL)

- ### `Laravel` simplifie le processus de développement

  `Laravel` a été conçu pour simplifier les tâches communes à de nombreux
  projets de développement web, comme le routage, l’authentification, la
  migration, la mise en cache, etc. `Laravel` permet d’intégrer facilement des
  modules préfabriqués dans une application, à l’aide d’interfaces intuitives et
  expressives de la ligne de commande et du gestionnaire de dépendances
  [Composer](https://getcomposer.org/).

  `Laravel` dispose également d’une
  [documentation en ligne](https://laravel.com/docs/11.x), qui constitue un bon
  point de départ pour les développeurs plus expérimentés. Une grande variété de
  ressources d’apprentissage en ligne destinées à tous les niveaux de compétence
  est également disponible.

- ### `Laravel` dispose d’outils pour les développeurs de tous les niveaux

  `Laravel` est un `framework` progressif, ce qui signifie qu’il inclut une
  variété de fonctionnalités que les utilisateurs de tous niveaux trouveront
  utiles. Par exemple, les débutants ont accès à des kits de démarrage pour des
  modules tels que les fonctions d’authentification de base. Les utilisateurs
  plus expérimentés peuvent tirer parti des moteurs sous-jacents aux kits de
  démarrage pour construire leurs propres processus d’authentification et les
  intégrer à leur Frontend préféré.

- ### `Laravel` évolue facilement

  `Laravel` est hautement évolutif. Grâce à la prise en charge intégrée de
  systèmes de cache rapides et distribués, les applications `Laravel` sont
  capables de traiter des millions de requêtes par mois. `Laravel` propose
  également une plateforme de déploiement sans serveur, `Vapor`, qui est basée
  sur AWS (Amazon Web Service) et offre un haut degré d’évolutivité.

- ### `Laravel` dispose d’un écosystème et d’une communauté massive

  `Laravel` dispose d’un formidable écosystème soutenu par une vaste communauté
  de développeurs.

  `Laravel` étant l’un des `frameworks` PHP les plus utilisés, la bibliothèque
  d’applications et de paquets `Laravel` disponibles est importante. Les paquets
  officiels `Laravel` et les paquets tiers sont facilement disponibles.

  Les paquets officiels de `Laravel` comprennent l’authentification, la gestion
  des serveurs, la facturation des abonnements, les tests et l’automatisation
  des navigateurs, etc. Des packages tiers sont disponibles sur un certain
  nombre de sites, notamment [`Packalyst`](https://packalyst.com/) et
  [`Laravel News`](https://laravel-news.com/category/packages).

  Les développeurs qui ont des questions trouveront certainement une réponse en
  visitant l’un des nombreux forums :

  - [`Laravel.io`](https://laravel.io/)
  - [`Reddit`](https://www.reddit.com/r/laravel/)
  - [`Laracasts`](https://laracasts.com/).

- ### `Laravel` est largement utilisé

  De nombreuses entreprises utilisent `Laravel` pour créer des sites web
  hautement fonctionnels :

  - [`Vacations by Rail`](https://www.vacationsbyrail.com/) est un site de
    planification de voyages en train.
  - [`Setapp`](https://setapp.com/), qui propose des applications pour Mac et
    iOS.
  - [`Restaurants.com`](https://www.restaurants.com/) très intuitif à utiliser.

## Que fait `Laravel` ?

## Voici quelques-unes des fonctionnalités les plus importantes :

### Traitement des routes

`Laravel` offre une gestion des routes simple et intuitive, en utilisant des
noms simples pour identifier les routes plutôt que de longs noms de chemin.
L’utilisation d’identificateurs de route facilite également la maintenance des
applications, car le nom de la route peut être modifié à un seul endroit plutôt
que de devoir le changer partout. Toutes les routes de l’interface web d’une
application `Laravel` sont enregistrées dans le fichier `routes/web.php`.

### Sécurité

`Laravel` comprend un
[certain nombre de fonctions de sécurité](https://iwconnect.com/laravel-security-features/),
notamment l’authentification des utilisateurs, l’autorisation des rôles des
utilisateurs, la vérification des e-mails, les services de cryptage, le hachage
des mots de passe et les fonctions de réinitialisation des mots de passe.

### Migration

`Laravel` fournit un contrôle de version pour les bases de données
d’applications en utilisant les migrations. Les migrations permettent de suivre
la façon dont une base de données a été modifiée au fil du temps, ce qui
facilite la destruction ou la recréation de la base de données si nécessaire.

### Templating

Blade est le moteur de templating PHP de `Laravel`. Les moteurs de modèles PHP
[permettent de séparer la logique métier](https://kinsta.com/fr/base-de-connaissances/qu-est-ce-que-php/)
des modèles HTML, ce qui permet d’obtenir une base de code plus facile à
maintenir. De nombreuses fonctionnalités de `Laravel` reposent sur les modèles
Blade. Blade offre plus de fonctionnalités que les autres moteurs de création de
modèles car il permet d’utiliser du code PHP simple, ce que les autres ne font
pas.

### Sessions

`Laravel` utilise des sessions pour stocker des informations sur l’utilisateur à
travers plusieurs requêtes.

### Validation des données

`Laravel` simplifie la
[validation des données utilisateur entrantes](https://en.wikipedia.org/wiki/Data_validation).
`Laravel` comprend un certain nombre de règles de validation des données, avec
des messages d’erreur personnalisables.

### Traitement du cache

`Laravel` prend en charge la mise en cache des données afin de minimiser les
temps de traitement des tâches applicatives. L’API de mise en cache de `Laravel`
prend en charge une variété de backends de cache tiers tels que
[`Memcached`](https://memcached.org/) et
[`Redis`](https://redis.io/topics/introduction).

### Traitement des erreurs

La gestion des erreurs est automatiquement configurée au démarrage d’un nouveau
projet `Laravel`. Les applications `Laravel` peuvent être
[exécutées en mode débogage](https://pineco.de/debugging-in-laravel/), générant
des messages d’erreur détaillés pour toutes les erreurs qui se produisent.

### Tests

`Laravel` offre d’emblée d’importantes fonctionnalités de test. `Laravel` prend
en charge les tests unitaires, qui testent de petites sections isolées du code
de l’application, ainsi que les tests de fonctionnalités, qui testent des
sections plus importantes du code et des fonctionnalités de plus haut niveau.

### Stockage et gestion des fichiers

`Laravel` utilise le paquetage
[`Flysystem`](https://flysystem.thephpleague.com/docs/) pour fournir des pilotes
permettant de travailler avec une variété de systèmes de fichiers, depuis les
systèmes de fichiers locaux jusqu’au stockage sur le cloud comme
[Amazon S3](https://kinsta.com/fr/base-de-connaissances/amazon-s3-wordpress/).
`Laravel` permet également le transfert de fichiers avec le protocole de
transfert de fichiers SSH (SFTP).

### E-mail

`Laravel` comprend une API d’e-mail basée sur la bibliothèque `SwiftMailer`, qui
permet d’envoyer des e-mails via le service de son choix. `Laravel` prend en
charge les pièces jointes et la mise en file d’attente des e-mails.

### Notifications

`Laravel` prend en charge l’envoi de notifications via un certain nombre de
canaux, qu’il s’agisse de canaux connus tels que SMS ou Slack, ou de canaux
développés par la communauté `Laravel`.

## Résumé

`Laravel` fournit un ensemble étendu et robuste de ressources qui simplifient le
processus de développement en éliminant la nécessité de coder de nombreuses
tâches courantes.

Que vous soyez débutant-e ou expert-e en développement d'application web,
`Laravel` est un `framework` de choix.
