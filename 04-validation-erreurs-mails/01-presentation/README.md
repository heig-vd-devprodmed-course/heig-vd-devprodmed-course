---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: Validation de Formulaire et Envoi d'Emails avec Laravel
description: Introduction aux concepts de validation et d'envoi d'emails dans Laravel
header: "**Validation et Envoi d'Emails**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Validation de Formulaire et Envoi d'Emails

<!--
_class: lead
_paginate: false
-->

<small>Vincent Guidoux</small>

<small>Ce travail est sous licence CC BY-SA 4.0.</small>

## Plus de détails dans le support de cours

<!-- _class: lead -->

Ce document est une introduction. Consultez le support de cours pour une
explication détaillée et les exercices pratiques.

## Objectifs (1/2)

À la fin de cette séance, vous devriez être capable de :

- Lister les étapes nécessaires pour valider un formulaire dans Laravel.
- Décrire le fonctionnement des messages d'erreur et leur affichage dynamique.
- Identifier comment Laravel gère la validation des champs via FormRequest.

## Objectifs (2/2)

- Appliquer une validation sur un formulaire en respectant les bonnes pratiques.
- Énumérer les étapes pour ajouter une nouvelle langue et traduire les messages
  d'erreur.
- Configurer et tester l'envoi d'e-mails dans Laravel à l’aide de Mailpit.

## Pourquoi valider un formulaire ?

La validation des formulaires est essentielle pour garantir l'intégrité des
données et la sécurité des applications web. Laravel propose un système de
validation robuste qui permet de contrôler chaque champ du formulaire avant de
traiter les données.

> Exemple : Vérifier qu'une adresse e-mail est valide avant de l’enregistrer en
> base de données.

## Principaux concepts abordés

- **Les méthodes HTTP :** Différences entre `GET` et `POST`.
- **Validation des formulaires :** Implémentation avec Laravel `FormRequest`.
- **Gestion des erreurs :** Affichage des messages d'erreur personnalisés.
- **Persistances des données :** Utilisation de `old()` pour conserver les
  valeurs saisies.
- **Envoi d’e-mails :** Configuration et utilisation de `Mail::send()`.
- **Test d’envoi d’e-mails :** Utilisation de Mailpit pour simuler une boîte
  mail.

## La validation dans Laravel (1/2)

Laravel propose plusieurs méthodes pour valider un formulaire :

- **Validation directe dans le contrôleur :**

  ```php
  $request->validate([
      'nom' => 'required|min:3|max:20|alpha',
      'email' => 'required|email',
      'message' => 'required|max:250'
  ]);
  ```

## La validation dans Laravel (2/2)

- **Utilisation d’une `FormRequest` dédiée :**
  ```php
  class ContactRequest extends FormRequest {
      public function rules(): array {
          return [
              'nom' => 'required|min:3|max:20|alpha',
              'email' => 'required|email',
              'message' => 'required|max:250'
          ];
      }
  }
  ```

## Envoi d’e-mails avec Laravel

Laravel simplifie l’envoi d’e-mails grâce à son API `Mail::send()` :

```php
Mail::send('view_contenu_email', $request->all(), function($message) {
    $message->to('admin@example.com')->subject('Nouveau message via formulaire');
});
```

> ⚠ Il est recommandé d'utiliser une solution comme Mailpit pour tester les
> e-mails en développement.

## Configuration et test avec Mailpit

Mailpit est un outil léger qui permet de capturer et afficher les e-mails
envoyés localement.

- Installation sous Mac :
  ```bash
  brew install mailpit
  ```
- Démarrage de Mailpit :
  ```bash
  mailpit
  ```
- Accès à l’interface : `http://localhost:8025/`

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- Prendre connaissance du support de cours
- Poser des questions si nécessaire

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
