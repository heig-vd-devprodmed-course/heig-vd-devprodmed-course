Exercice :
----------
On vous demande d'afficher un planning d'entrevues avec des personnes de votre choix.
sous la forme :	

![agenda](img\agenda.png)

Les personnes sont stockées dans un fichier sur le serveur.

```
Baur Ophélie
Benkais Leyla
Boumasmoud Yousra
Bourqui Jeremy
Crettaz Kilian
Fourel Nathan
Lam Larry
Luyet Jessica
Mertenat Martin
Mettraux Steve
Najjar Louka
Paiva Oliveira Kevin
Perroset Jade
Robert Thomas
Rodriguez Alan
Roulet Alexandre
Ruffieux Mikaël
Schaller Camille
Urfer Lionel
Vestergaard Mikkel
Wagnières Sébastien
Walpen Alison
Zerika Karim
Zweifel Nathan
Zweifel Robin
```

L'utilisateur doit pouvoir cocher les personnes qu'il désire entrevoir.
Il saisit ensuite :

- L'heure de début des entrevues (par ex : 08:30)
- L'heure de la fin des entrevues (par ex : 12:00)
- La durée entre les entrevues (par ex : 00:05)

Puis clique sur le bouton permettant d'envoyer ces informations au serveur.

![checkbox](img\checkbox.png)

Le serveur renvoie ensuite l'agenda des entrevues à l'utilisateur.

> Remarques : 
>
> - La durée des entrevues dépend du nombre de personnes sélectionnées et de la durée entre les entrevues.
> - L'ordre de passage des personnes dans l'agenda final doit être aléatoire.

> Indications :
>
> - Progressez par petits pas.
>   Commencez avec un formulaire statique ne contenant que deux cases à cocher (pour deux personnes)
>   Lorsque vous êtes capables de savoir quelle(s) personne(s) ont été cochées, passez à la suite.
>
> - Les classes [`DateTime`](https://www.php.net/manual/fr/class.datetime.php), [`DateInterval`](https://www.php.net/manual/fr/class.dateinterval.php) de `php` permettent de gérer le temps.
>
> - ou, plus simplement la classe [`Carbon`](https://carbon.nesbot.com/docs/) faisant déjà partie de chaque application `Laravel` :wink:
