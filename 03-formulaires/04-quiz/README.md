---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: J. Hess et V. Guidoux, avec l'aide de GitHub Copilot
title: HEIG-VD DévProdMéd - Cours Laravel
description: Quiz pour le cours DévProdMéd à la HEIG-VD, Suisse
header: "**Quiz 3**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Quiz 3 - Sécurité et Formulaires

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> **En quoi consiste une attaque de type CSRF ?**

## Question 1 - Réponse

Une attaque CSRF (Cross-Site Request Forgery) consiste à forcer un utilisateur à
exécuter des actions non désirées sur un site web sur lequel il est authentifié.

[Explications détaillées](https://fr.wikipedia.org/wiki/Cross-site_request_forgery)

## Question 2 - Donnée

> **Que doit-on mettre dans un formulaire pour se protéger contre les attaques
> CSRF ?**

## Question 2 - Réponse

Il faut insérer le tag Blade `@csrf` juste après l'entête d'un formulaire :

```php
<form action="{{ url('traiteFormulaire') }}" method="post">
    @csrf
    <label for="nom">Entrez votre nom : </label>
    <input name="nom" type="text" id="nom">
    <input type="submit" name="submit" value="Envoyer"/>
</form>
```

## Question 3 - Donnée

> **Comment fonctionne cette protection ?**

## Question 3 - Réponse (1/2)

Le moteur Blade injecte un champ caché contenant un jeton unique (`token`), qui
sera contrôlé côté serveur. Exemple de code source généré :

```html
<input
	type="hidden"
	name="_token"
	value="AKUEadiLLClgLuc4fZzyzdTu0uSfJFZXhPuLNi8q"
/>
```

Le serveur vérifie que ce jeton est valide avant de traiter le formulaire.

## Question 3 - Réponse (2/2)

> ​ Remarque : Pour voir ce jeton, il suffit de demander au navigateur
> d'afficher le code source de la page lorsque le formulaire est affiché.

## Question 4 - Donnée

> **Quelle différence y a-t-il entre une route commençant par `Route::get(...)`
> et une `Route::post(...)` ?**

---

| GET                                                   | POST                                                 |
| ----------------------------------------------------- | ---------------------------------------------------- |
| Envoie des données via l’URL                          | Envoie des données via le corps de la requête        |
| Visible dans la barre d’adresse                       | Invisible dans la barre d’adresse                    |
| Limité en taille                                      | Permet d’envoyer de grandes quantités de données     |
| Stocke les paramètres dans l’historique du navigateur | Ne stocke pas les paramètres dans l’historique       |
| Moins sécurisé                                        | Plus sécurisé pour transmettre des données sensibles |

## Question 5 - Donnée

> **Comment récupérer les données d'un formulaire dans Laravel ?**

## Question 5 - Réponse

Laravel utilise un objet de type `Request` :

```php
use Illuminate\Http\Request;

Route::post('/traiteFormulaire', function (Request $request) {
    return $request->input('prenom');
});
```

Ou plus simplement :

```php
$prenom = $request->prenom;
```

## Question 6 - Donnée

> **Peut-on récupérer les informations d'un formulaire directement dans une
> route ? Si oui, comment ?**

## Question 6 - Réponse

Oui, en utilisant `Request` comme paramètre de la fonction de la route :

```php
use Illuminate\Http\Request;

Route::post('/traiteFormulaire', function (Request $request) {
    echo $request->input('prenom');
});
```

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?
