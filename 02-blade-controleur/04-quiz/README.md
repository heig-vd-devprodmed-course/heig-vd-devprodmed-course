---
marp: true
---

<!--
theme: gaia
size: 16:9
paginate: true
author: J. Hess et V. Guidoux, avec l'aide de GitHub Copilot
title: HEIG-VD DévProdMéd - Cours Laravel
description: Quiz pour le cours DévProdMéd à la HEIG-VD, Suisse
header: "**Quiz 2**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
style: |
  :root {
      --color-background: #fff;
      --color-foreground: #333;
      --color-highlight: #f96;
      --color-dimmed: #888;
      --color-headings: #7d8ca3;
  }
  blockquote {
      font-style: italic;
  }
  table {
      width: 100%;
  }
  h1, h2, h3, h4, h5, h6 {
      color: var(--color-headings);
  }
  h2, h3, h4, h5, h6 {
      font-size: 1.5rem;
  }
  section:not(.lead) > p, blockquote {
      text-align: justify;
  }
  .two-columns {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
  }
  .center {
      text-align: center;
  }
  section.small  {
      font-size: 1.5rem;
  }
  section.small h2 {
      font-size: 2rem;
  }
headingDivider: 6
-->

# Quiz 1 - Blade et contrôleur

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> **Qu'est ce qu'un `template` Blade et à quoi cela sert-il ?**

## Question 1 - Réponse

Cela correspond à un modèle que l'on peut réutiliser. Cela permet d'éviter de
répéter du code (d'où moins d'erreur et gain de temps).

## Question 2 - Donnée

> **Comment se nomme le "tag" permettant d'injecter du code dans un `template`
> ?**

## Question 2 - Réponse

`@yield`

## Question 3 - Donnée

> **Qu'est-ce qu'un contrôleur ?**

## Question 3 - Réponse

Un contrôleur est une classe contenant des méthodes.

## Question 4 - Donnée

> **A quoi sert le contrôleur ?**

## Question 4 - Réponse

Un contrôleur permet de préparer les données devant être affichée par une vue et
de centraliser le traitement de données provenant de formulaires.

## Question 5 - Donnée

> **Quelle commande artisan permet de créer un contrôleur ?**

## Question 5 - Réponse

`php artisan make:controller NomDuControlleur`

## Question 6 - Donnée

> **Que doit-on ajouter dans le contrôleur pour qu'il fonctionne ?**

## Question 6 - Réponse

Il faut lui ajouter des méthodes (appelées par les routes)

## Question 7 - Donnée

> **Comment "lier" une route à une méthode d'un contrôleur ?**

## Question 7 - Réponse

```php
Route::get('afficheForm', [NomController::class, 'afficheForm']);
```

Remarque : Attention à ne pas oublier la clause `use` pour la classe
`NomController`

## Question 8 - Donnée

> **Comment envoie-t-on des paramètres de la route au contrôleur ?**

## Question 8 - Réponse

Cela se fait automatiquement (Il n'y a rien a faire ;-)

## Question 9 - Donnée

> \*\*Comment récupère-t-on les paramètres envoyés par la route dans le
> contrôleur

## Question 9 - Réponse

Grâce aux paramètres de la méthode. Remarque : Il ne doivent pas forcément se
nommer de la même manière que dans la route !

Exemple de route appelant la méthode `test` du contrôleur `MonController`

```php
Route ::get('article/{n}/couleur/{c}', [MonController::class, 'test']);
```

Méthode `test(...)` du contrôleur `MonController` :

```php
//...

// $n reçoit la première valeur envoyée (celle de {n})
// $a reçoit la seconde valeur envoyée (celle de {c})
public function test($n, $a) {
    return $n . " : " .$a;
}

//...
```

## Question 10 - Donnée

> **Comment envoie-t-on des paramètres du contrôleur à la vue ?**

## Question 10 - Réponse

Avec

```php
->with('nomDuParametreDansVue', $nomDuParametreAEnvoyer)
```

Ex :

```php
return view('maVue2')->with('artistes', $artistes);
```

Remarque : `nomDuParametreDansVue` peut être différent de
`$nomDuParametreAEnvoyer` Ex :

```php
return view('maVue2')->with('lesArtistes', $artistes);
```

## Question 11 - Donnée

> **Comment récupère-t-on les paramètres envoyés par le contrôleur dans la vue
> ?**

## Question 11 - Réponse

Avec :

```php
{{$nomDuParametreDansVue}}
```

## Question 12 - Donnée

> **A l'aide de quelles instructions peut-on construire dynamiquement une vue
> ?**

## Question 12 - Réponse

A l'aide des directives Blade : Avec `@foreach` `@for` `@if` `@...`

Documentation :

[Directives Blade](https://laravel.com/docs/9.x/blade#blade-directives)
