# Exercice

Veuillez implémenter une application `Laravel` permettant de s'entraîner aux
tables de multiplications.

L'utilisateur doit répondre le plus vite possible à deux questions tirées
aléatoirement dans les tables de 2 à 12, soit un total de 22 questions.

Si l'utilisateur s'authentifie, il peut :

- voir la liste de ses propres résultats.
- faire partie du tableau des trois meilleurs scores. (S'il a répondu à 100% des
  réponses justes et que son temps fait partie des 3 plus rapides)

A chaque fois que le tableau des trois meilleurs scores change, l'administrateur
de l'application doit en être informé par mail.

```
Voici le nouveau tableau des trois meilleurs scores :
03.05.2020 21:05 GTZ 1 m 4 s
03.05.2020 21:05 JUS 1 m 6 s
14.08.2019 21:08 LRE 2 m 49 s
```

---

Voici un exemple des interfaces pour l'interaction avec l'utilisateur.

## Sans authentification :

![Page1](img\Page1.png)

Après avoir cliqué sur le bouton `GO`, l'utilisateur découvre les 22 questions
auxquelles il doit répondre :

![Page2](img\Page2.png)

Après avoir répondu à toutes les questions, il appuie sur le bouton `Soumettre`
pour obtenir le résultat :

![Page3](img\Page3.png)

L'utilisateur peut, s'il le désire, recommencer une nouvelle fois en cliquant
sur le bouton `Recommencer`.

---

## Avec authentification :

Si l'utilisateur le désire, il peut s'inscrire pour pouvoir obtenir un suivi de
ses résultats : Remarque : La page 1 et la page 2 ne différent pas.

---

![Page1_bis](img\Page1_bis.png)

Après avoir cliqué sur le bouton `GO`, l'utilisateur découvre les 22 questions
auxquelles il doit répondre :

![Page2_bis](img\Page2_bis.png)

Et enfin, il peut obtenir les résultats et l'historique de ses essais :

![Page3_bis](img\Page3_bis.png)

Idéalement, les scores doivent êtres triés d'abord par pourcentages, puis par
temps réalisés (si le pourcentage est le même)

Remarque : Les trois lettres dans le tableau des 3 meilleurs scores sont obtenus
d'après le nom de famille. Il s'agit de la première lettre, la lettre du milieu
(...) et de la dernière lettre du nom de famille. Exemple : Dupond => DPD (...)
Chauvet => CUT

---

## Exemples de requêtes :

​

    Pour récupérer les données de l'admin :
    App\User::where('admin', 1)->first();

    Pour récupérer les données des utilisateurs qui ne sont pas admin :
    App\User::where('admin', 0)->get();

    Pour récupérer tous les scores :
    App\Score::get();

    Pour récupérer tous les scores de la personne ayant l'id = 10 :
    App\User::find(10)->scores;

    Pour récupérer tous les scores triés par nbSecondes :
    App\Score::orderBy('nbSecondes','ASC')->get();

    Pour récupérer les trois meilleurs scores triés par nbSecondes :
    App\Score::orderBy('nbSecondes','ASC')->take(3)->get();

    Pour récupérer les scores de l'utilisateur ayant l'id = 10 trié par 'nbSecondes' :
    App\Score::where('user_id','10')->orderBy('nbSecondes','ASC')->get();

    Pour récupérer les noms des utilisateurs dont l'id est 1,3 ou 5 :
    App\User::whereIn('id', array(1, 3, 5))->get('/name');

    Développemet de la requête pour récupérer les trois meilleurs scores des utilisateurs ayant répondu juste à toutes les questions (100%) :

    App\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->get();

    App\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->get('/user_id');

    App\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->get(['user_id','nbSecondes']);

    App\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->with('user')->get();

    App\Score::where('pourcentageBonnesReponses',100)->orderBy('nbSecondes','ASC')->take(3)->with('user')->join('users', 'users.id', '=', 'scores.user_id')->get(['effectue_le','users.name','nbSecondes']);

---

Bon travail :sun_with_face:
