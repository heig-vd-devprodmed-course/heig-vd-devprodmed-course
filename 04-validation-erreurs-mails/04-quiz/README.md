---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: V. Guidoux
title: HEIG-VD DévProdMéd - Cours Laravel
description: Quiz - Validation des formulaires et envoi d'emails
header: "**Quiz 4**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Quiz 4 - Validation et Envoi d'Emails

<!--
_class: lead
_paginate: false
-->

## Question 1 - Donnée

> **Pourquoi est-il important de valider un formulaire côté serveur ?**

## Réponse 1 - Réponse

- Empêcher les utilisateurs malveillants d’envoyer des données incorrectes.
- Garantir l’intégrité des informations stockées.
- Améliorer la sécurité en bloquant les attaques XSS et injections SQL.

## Question 2 - Donnée

> **Quels sont les deux moyens principaux de valider un formulaire dans Laravel
> ?**

## Réponse 2 - Réponse (1/2)

1. **Dans le contrôleur (validation rapide)**

   ```php
   $request->validate([
   	'email' => 'required|email',
   	'password' => 'required|min:8',
   ]);
   ```

## Réponse 2 - Réponse (2/2)

2. **Avec une `FormRequest` dédiée (validation avancée)**
   ```php
   class RegisterRequest extends FormRequest
   {
   	public function rules(): array
   	{
   		return [
   			'email' => 'required|email',
   			'password' => 'required|min:8',
   		];
   	}
   }
   ```

## Question 3 - Donnée

> **Que fait la fonction `old()` dans une vue Blade ?**

## Réponse 3 - Réponse

Elle permet de conserver la valeur d’un champ après soumission du formulaire en
cas d’erreur ou de rechargement de la page.

Exemple :

```blade
<input type="text" name="nom" value="{{ old('nom') }}" />
```

## Question 4 - Donnée

> **Quelle directive Blade ajoutons-nous dans un formulaire pour protéger contre
> les attaques CSRF ?**

## Réponse 4 - Réponse

`@csrf`, qui génère un jeton CSRF unique et protège contre les attaques de type
**Cross-Site Request Forgery**.

Exemple :

```blade
<form method="POST" action="/submit">
	@csrf
	<input type="text" name="nom" />
</form>
```

## Question 5 - Donnée

> **Quelle est la classe que l'on doit créer pour valider les champs d'un
> formulaire ?**

## Réponse 5 - Réponse

C’est une classe de type `FormRequest`, qui doit hériter de
`Illuminate\Foundation\Http\FormRequest`.

Exemple :

```php
class RegisterRequest extends FormRequest {
   public function rules(): array { ... }
}
```

## Question 6 - Donnée

> **Quelle commande artisan permet de créer une classe de validation
> (`FormRequest`) ?**

## Réponse 6 - Réponse

```bash
php artisan make:request NomDeMaRequest
```

## Question 7 - Donnée

> **Quelles sont les modifications à apporter dans `FormRequest` pour qu'elle
> fonctionne ?**

## Réponse 7 - Réponse (1/2)

1. **Autoriser l'utilisation de la requête** en modifiant `authorize()` :
   ```php
   public function authorize(): bool {
       return true;
   }
   ```

## Réponse 7 - Réponse (2/2)

2. **Définir les règles de validation** dans `rules()` :
   ```php
   public function rules(): array {
       return [
           'nom' => 'required|min:3|max:20|alpha',
           'email' => 'required|email',
           'message' => 'required|max:250'
       ];
   }
   ```

## Question 8 - Donnée

> **Quel est l’objet utilisé dans une vue pour afficher les erreurs de
> validation ?**

## Réponse 8 - Réponse

L’objet `$errors`, qui permet d’accéder aux erreurs de validation.

Exemple :

```blade
@if ($errors->has('email'))
	<p class="error">{{ $errors->first('email') }}</p>
@endif
```

## Question 9 - Donnée

> **Quel est le fichier à modifier pour configurer l'envoi d'email dans Laravel
> ?**

## Réponse 9 - Réponse

Le fichier `.env` :

```env
MAIL_MAILER=smtp
MAIL_HOST=mail.example.com
MAIL_PORT=587
MAIL_USERNAME=monUser
MAIL_PASSWORD=monMotDePasse
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="admin@example.com"
MAIL_FROM_NAME="Laravel App"
```

## Question 10 - Donnée

> **Quelle est la classe permettant d'envoyer un email ?**

## Réponse 10 - Réponse

Il s’agit de la classe `Mail`, fournie par Laravel.

## Question 11 - Donnée

> **Quelle est la méthode principale utilisée pour envoyer un email ?**

## Réponse 11 - Réponse

`send()`, utilisée avec `Mail::send()` :

```php
Mail::send('view_email', $data, function ($message) {
	$message->to('user@example.com')->subject('Bienvenue');
});
```

## Question 12 - Donnée

> **Quels sont les trois paramètres de `Mail::send()` et leur fonction ?**

## Réponse 12 - Réponse

1. **La vue Blade** contenant le contenu de l’email (ex. `'view_email'`).
2. **Un tableau de données** envoyé à la vue (ex. `$request->all()`).
3. **Une fonction de callback** pour définir les paramètres de l'email :
   - `to('destinataire@example.com')` → définit le destinataire.
   - `subject('Objet du mail')` → définit l’objet.

Cela permet de tester l’envoi sans réellement envoyer d’email.

## Question 13 - Donnée

> **Comment tester un email sans utiliser un vrai serveur SMTP ?**

## Réponse 13 - Réponse

Utiliser **Mailpit** pour capturer les emails en local.

Accessible sur `http://localhost:8025/`.

## Question 14 - Donnée

> **Pourquoi est-il recommandé d’utiliser une `FormRequest` au lieu d’une
> validation dans un contrôleur ?**

## Réponse 14 - Réponse

- **Séparation des responsabilités** → Le contrôleur reste clair.
- **Réutilisation** → Facilement applicable à plusieurs routes.
- **Lisibilité** → Regroupe les règles de validation en un seul endroit.

## Questions

<!-- _class: lead -->

Est-ce que vous avez des questions ?
