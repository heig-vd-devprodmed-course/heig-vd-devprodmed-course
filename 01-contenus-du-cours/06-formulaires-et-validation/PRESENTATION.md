---
marp: true
theme: "custom-marp-theme"
size: "16:9"
paginate: "true"
author: "L. Delafontaine, avec l'aide de GitHub Copilot"
description:
  "Formulaires et validation pour le cours DévProdMéd enseigné à la HEIG-VD,
  Suisse"
lang: "fr"
url: "https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/06-formulaires-et-validation/presentation.html"
header: "[**Formulaires et validation**][contenu-complet-sur-github]"
footer:
  "[**HEIG-VD**](https://heig-vd.ch) - [DévProdMéd
  2025-2026](https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course)
  - [CC BY-SA 4.0][licence]"
headingDivider: 6
---

# Formulaires et validation

<!--
_class: lead
_paginate: false
-->

<https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course>

Visualiser le contenu complet sur GitHub [à cette
adresse][contenu-complet-sur-github].

<small>L. Delafontaine, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).</small>

<small>Ce travail est sous licence [CC BY-SA 4.0][licence].</small>

![bg opacity:0.1][illustration-principale]

## Plus de détails sur GitHub

<!-- _class: lead -->

_Cette présentation est un résumé du contenu complet disponible sur GitHub._

_Pour plus de détails, consulter le [contenu complet sur
GitHub][contenu-complet-sur-github] ou en cliquant sur l'en-tête de ce
document._

## Objectifs (1)

- Comprendre les concepts liés aux formulaires et à la validation dans le
  développement d'applications web.
- Comprendre comment les formulaires et les sessions interagissent dans une
  application web.

![bg right:40%][illustration-objectifs]

## Objectifs (2)

- Comprendre les implications de sécurité liées à la gestion des formulaires et
  des sessions, et comment s'en protéger.
- Comprendre comment gérer les fichiers téléversés via des formulaires.
- Implémenter ces concepts avec Laravel pour réaliser le petit réseau social du
  mini-projet.

![bg right:40%][illustration-objectifs]

## Les formulaires, un rappel

Un formulaire est un élément HTML qui permet de collecter des données auprès des
utilisateur.trice.s et de les envoyer au serveur pour traitement.

Les formulaires sont essentiels pour permettre aux utilisateur.trice.s
d'interagir avec une application web.

![bg right:40%][illustration-objectifs]

### Structure d'un formulaire

<div class="two-columns">
<div>

Un formulaire se compose de plusieurs éléments : champs de texte, boutons de
soumission, cases à cocher, listes déroulantes, etc.

Chaque champ est associé à un label pour améliorer l'accessibilité.

</div>
<div>

```php
<form action="/posts" method="POST">
    <label for="title">Titre</label>
    <input
      type="text"
      name="title"
      id="title"
      placeholder="Titre du post" />

    <label for="content">Contenu</label>
    <textarea
        name="content"
        id="content"
        placeholder="Contenu du post"
        required
        minlength="10"
    ></textarea>

    <button type="submit">Créer le post</button>
</form>
```

</div>

### Les attributs d'un formulaire

- `action` et `method` définissent l'URL de destination et la méthode HTTP.
- Attributs de validation HTML5 : `required`, `minlength`, etc.
- L'attribut `name` définit la clé pour accéder aux données côté serveur.

La validation HTML5 est une première ligne de défense, mais la validation côté
serveur est essentielle.

### Envoyer les données d'un formulaire

- L'attribut `action` définit l'URL vers laquelle les données seront envoyées.
- L'attribut `method` définit la méthode HTTP (`GET` ou `POST` par défaut).
- L'attribut `name` permet d'accéder aux données côté serveur.

![bg right:40%][illustration-objectifs]

### Recevoir les données d'un formulaire

Les données sont accessibles via des objets ou tableaux associatifs.

En PHP : superglobales `$_GET` et `$_POST`.

Les données doivent être validées côté serveur pour assurer la sécurité.

![bg right:40%][illustration-objectifs]

## Les sessions, un rappel

Une session permet de stocker des données spécifiques à un.e utilisateur.trice
sur le serveur, associées via un cookie de session.

Les sessions maintiennent l'état entre les requêtes HTTP. Elles permettent de
garder un annuaire des utilisateur.trices connecté.es avec leurs données

![bg right:40%][illustration-objectifs]

### Créer une session

Le serveur démarre une session (ex : `session_start()` en PHP).

Génère un identifiant unique stocké dans un cookie envoyé au navigateur.

Le navigateur renvoie ce cookie avec chaque requête ultérieure.

![bg right:40%][illustration-objectifs]

### Accéder aux données de session

Les données sont accessibles via des objets ou tableaux (ex : `$_SESSION` en
PHP).

Exemple : `$_SESSION['username'] = 'Alice';`

![bg right:40%][illustration-objectifs]

### Supprimer une session

Utiliser une fonction dédiée (ex : `session_destroy()` en PHP).

Supprimer également le cookie de session côté client pour éviter toute
confusion.

![bg right:40%][illustration-objectifs]

## Les formulaires et les sessions

Les formulaires et les sessions travaillent ensemble :

- Les sessions maintiennent l'état de l'utilisateur.trice entre les requêtes.
- Les données de formulaire peuvent être stockées en session pour les réutiliser
  (erreurs de validation, données saisies, etc.).

![bg right:40%][illustration-objectifs]

## Les formulaires dans Laravel

Laravel fournit des fonctionnalités supplémentaires pour faciliter la gestion
des formulaires :

- Validation des données intégrée.
- Protection contre les attaques CSRF.
- Routes et contrôleurs pour traiter les requêtes.

![bg right:40%][illustration-objectifs]

### Actions et méthodes HTTP des formulaires

L'attribut `action` doit correspondre à une route définie dans Laravel.

L'attribut `method` spécifie la méthode HTTP (`POST`, `GET`).

Laravel permet de simuler d'autres méthodes HTTP (`PUT`, `PATCH`, `DELETE`) avec
`@method()`.

### Se protéger contre les attaques CSRF

Laravel fournit une protection intégrée contre les attaques CSRF.

Un token CSRF unique est généré pour chaque session et doit être inclus dans
chaque formulaire avec `@csrf`.

#### Attaque CSRF - Comment ça marche ?

Un.e attaquant.e fait exécuter une action non désirée par un.e utilisateur.trice
authentifié.e.

Exemple : transfert d'argent depuis le compte bancaire d'Alice vers celui de
l'attaquant.e via un formulaire caché sur un site malveillant.

![bg right:40%][illustration-objectifs]

---

![bg h:90%](./images/csrf-attack-01.svg)

---

![bg h:90%](./images/csrf-attack-02.svg)

---

![bg h:90%](./images/csrf-attack-03.svg)

---

![bg h:90%](./images/csrf-attack-04.svg)

#### Protection CSRF - La solution avec un token

Laravel génère un token CSRF unique pour chaque session.

Le token est vérifié à chaque soumission de formulaire.

Si les tokens ne correspondent pas, la requête est rejetée.

![bg right:40%][illustration-objectifs]

---

![bg h:90%](./images/csrf-protection-01.svg)

---

![bg h:90%](./images/csrf-protection-02.svg)

---

![bg h:90%](./images/csrf-protection-03.svg)

---

![bg h:90%](./images/csrf-protection-04.svg)

### Le rôle de l'APP_KEY dans les sessions et la protection CSRF

La clé d'application (`APP_KEY`) est générée avec `php artisan key:generate`.

Elle chiffre les données de session et génère les tokens CSRF.

Ne jamais partager cette clé ou la rendre publique.

### Validation des données de formulaire

Laravel fournit un système de validation intégré.

Les règles de validation peuvent être définies dans les contrôleurs ou dans des
classes dédiées (Form Requests).

Exemple : `'title' => 'nullable|string|max:255'`

### Validation des données de formulaire (2)

Si la validation échoue, Laravel redirige automatiquement vers le formulaire
précédent avec les erreurs.

De nombreuses règles de validation prédéfinies : `required`, `string`, `max`,
`email`, `unique`, etc.

#### Messages d'erreur de validation

Laravel génère automatiquement des messages d'erreur pour chaque champ qui
échoue.

Affichage dans les vues avec `@error('field_name')` et `$message`.

Possibilité d'afficher tous les messages avec `$errors->all()`.

### Traduire les messages d'erreur de validation

Les messages d'erreur sont définis dans les fichiers de traduction de Laravel.

Fichier : `resources/lang/fr/validation.php`.

Personnaliser les noms des champs avec la clé `attributes`.

### Conserver les données de formulaire en cas d'erreur de validation

La directive Blade `old()` permet de récupérer les anciennes valeurs.

Exemple : `value="{{ old('title') }}"`.

Les données sont stockées en session après une erreur de validation.

### Accéder aux données de formulaire dans les contrôleurs

Les données validées sont accessibles via `$validated`.

Exemple : `$validated = $request->validate([...]);`.

Utiliser ces données pour créer ou mettre à jour des ressources en base de
données.

### Rediriger après la soumission d'un formulaire

Laravel fournit plusieurs fonctions de redirection :

- `redirect()->action([Controller::class, 'method'], [...])`.
- `to_route('route.name')`.
- `back()`.

### Réutiliser les règles de validation dans plusieurs contrôleurs

Créer des classes de validation dédiées (Form Requests) avec
`php artisan make:request`.

Les règles sont définies dans la méthode `rules()`.

Injecter la classe dans le contrôleur pour valider automatiquement les données.

## Gérer les fichiers d'un formulaire

Laravel fournit des fonctionnalités pour gérer les fichiers téléversés.

### Le type de champ `file`

Utiliser `<input type="file">` dans le formulaire.

Ajouter `enctype="multipart/form-data"` à l'attribut du formulaire.

### Validation des fichiers

Règles spécifiques : `file`, `image`, `mimes`, `max`, etc.

Exemple : `'profile_picture' => 'nullable|image|max:2048'`.

La règle `image` accepte : jpg, jpeg, png, bmp, gif, webp.

### Stocker les fichiers téléversés

Laravel fournit un système de stockage intégré avec différents disques.

Utiliser la façade `Storage` pour déplacer les fichiers.

Exemple : `Storage::disk('public')->put('profile-pictures', $file)`.

### Stocker les fichiers téléversés (2)

Stocker le chemin du fichier en base de données, pas le fichier lui-même.

Supprimer l'ancien fichier si nécessaire avant d'en stocker un nouveau.

### Gérer les disques de stockage

Configurer différents disques : local, cloud (S3, Google Cloud), etc.

Créer un lien symbolique avec `php artisan storage:link` pour rendre les
fichiers du disque `public` accessibles.

Accéder aux fichiers avec `asset('storage/filename')`.

## Conclusion

Les formulaires et la validation sont essentiels pour interagir avec les
utilisateur.trice.s.

Laravel fournit des outils puissants pour gérer les formulaires (validation,
fichiers, précédentes saisies, etc.).

La protection CSRF et la validation côté serveur sont indispensables pour la
sécurité de l'application.

![bg right:40%][illustration-principale]

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?

## À vous de jouer !

- (Re)lire le contenu de cours.
- Faire les exercices.
- Faire le mini-projet.
- Poser des questions si nécessaire.

➡️ [Visualiser le contenu complet sur GitHub.][contenu-complet-sur-github]

**N'hésitez pas à vous entraidez si vous avez des difficultés !**

![bg right:40%][illustration-a-vous-de-jouer]

## Sources

- [Illustration principale][illustration-principale] par
  [Richard Jacobs](https://unsplash.com/@rj2747) sur
  [Unsplash](https://unsplash.com/photos/grayscale-photo-of-elephants-drinking-water-8oenpCXktqQ)
- [Illustration][illustration-objectifs] par
  [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  [Unsplash](https://unsplash.com/photos/low-angle-view-of-ball-shoots-in-the-ring-j6brni7fpvs)

---

- [Illustration][illustration-a-vous-de-jouer] par
  [Nikita Kachanovsky](https://unsplash.com/@nkachanovskyyy) sur
  [Unsplash](https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)

<!-- URLs -->

[contenu-complet-sur-github]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/tree/main/01-contenus-du-cours/06-formulaires-et-validation/README.md
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
