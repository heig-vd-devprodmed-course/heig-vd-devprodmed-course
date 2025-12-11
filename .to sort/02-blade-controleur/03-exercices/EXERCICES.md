# Blade et contrôleur - Exercices

## Exercice 1 - Donnée

Reprendre le code du contrôleur permettant d'afficher le tableau
multidimensionnel (Voir : `02-blade-controleur-support-de-cours`) et le modifier
pour pouvoir n'afficher que les artistes commençant par une lettre définie.

```bash
Ex : .../artistes/j		: n'affiche que les artistes dont le nom commence par J
```

## Exercice 2 - Donnée

Ecrire le code permettant d'afficher aléatoirement dix proverbes différents.
[Liste de proverbes](https://fr.wiktionary.org/wiki/Annexe:Liste_de_proverbes_français)

Veuillez utiliser les notions :

- route
- contrôleur
- vue (Blade)

La route doit rediriger sur un contrôleur, le contrôleur doit contenir une
méthode qui va choisir aléatoirement les dix proverbes à afficher, les mettre
dans un tableau et transmettre le tableau à une vue qui va s'occuper de les
afficher à l'aide d'une [boucle for](https://laravel.com/docs/10.x/blade#loops)
de Blade.

1. Commencer par `hardcoder` la liste complète des proverbes dans un tableau
   puis d'en tirer dix aléatoirement.
2. Stocker la liste des proverbes dans un fichier texte, les charger dans un
   tableau puis en tirer dix aléatoirement.
3. [Challenge] Récupérer tous les proverbes proposés par le lien
   [Liste de proverbes](https://fr.wiktionary.org/wiki/Annexe:Liste_de_proverbes_français)
   à l'aide d'un objet

[`DOMDocument()`](https://www.php.net/manual/fr/class.domdocument.php)
(`c.f. ->loadHTMLFile(...)`, `->getElementsByTagName(...)` puis en choisir dix
aléatoirement.

​
