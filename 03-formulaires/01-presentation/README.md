---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux, avec l'aide de GitHub Copilot
title: HEIG-VD DévProdMéd - Cours Formulaires
description: Formulaires pour le cours DévProdMéd à la HEIG-VD, Suisse
header: "**Formulaires**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"

headingDivider: 6
-->

# Formulaires

<!--
_class: lead
_paginate: false
-->

## Objectifs

- Être capable de créer un formulaire HTML (vue) pour pouvoir saisir des
  informations.
- Envoyer les informations du formulaire (requête) à une route
- Rediriger le traitement de la requête (de la route vers le contrôleur)
- Déléguer le traitement de l'affichage du résultat à une vue (du contrôleur à
  une vue)
- Se prémunir contre les attaques de type CSRF (`Cross-Site Request Forgery`)

---

`\routes\web.php`

```php
Route ::get('/teams/{teamId}/players/{playerId}', [TeamController::class, 'show']);
```

`\app\Http\Controllers\TeamController.php`

```php
class TeamController extends Controller {
    public function show($teamId, $playerId) {
        return view('team', ['equipeId' => $teamId, 'joueuseId' => $playerId]);
```

`\resources\views\team.blade.php`

```html
<h1>Équipe {{$equipeId}} - Joueuse {{$joueuseId}}</h1>
```

## Formulaire HTML

```html
<form action="/forms/submit" method="post" accept-charset="UTF-8">
  <label for="nom">Entrez votre nom : </label>
  <input name="nom" type="text" id="nom" />
  <input type="submit" name="submit" value="Envoyer" />
</form>
```

Résulat :

<form>
    <label for="nom">Entrez votre nom : </label>
    <input name="nom" type="text" id="nom" />
    <input type="submit" name="submit" value="Envoyer" />
</form>

## Attaque Cross-Site Request Forgery (CSRF)

- Attaque qui consiste à forcer un utilisateur à exécuter des actions non
  voulues sur un site auquel il est authentifié.
- `Laravel` protège contre ce type d'attaque en ajoutant un jeton (`token`)
  d'identification dans le formulaire.
- Lorsque le formulaire est posté, `Laravel` vérifie que ce jeton soit le même
  que celui enregistré en session.
- Si ce n'est pas le cas, `Laravel` ne traitera pas le formulaire.
