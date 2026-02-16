---
marp: true
theme: 'custom-marp-theme'
size: '16:9'
paginate: 'true'
author: "L. Delafontaine, avec l'aide de GitHub Copilot"
description:
  'Vues, Blade et Tailwind CSS pour le cours DévProdMéd enseigné à la HEIG-VD,
  Suisse'
lang: 'fr'
url: 'https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course/01-contenus-du-cours/04-vues-blade-et-tailwind-css/presentation.html'
header: '[**Vues, Blade et Tailwind CSS**][contenu-complet-sur-github]'
footer:
  '[**HEIG-VD**](https://heig-vd.ch) - [DévProdMéd
  2025-2026](https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course)
  - [CC BY-SA 4.0][licence]'
headingDivider: 6
---

# Vues, Blade et Tailwind CSS

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

## Objectifs

- Décrire la partie "vue" du patron de conception MVC.
- Décrire le concept de moteur de template et son intérêt.
- Utiliser Blade pour créer des vues dans une application Laravel.
- Utiliser les directives de Blade pour structurer les vues et afficher des
  données.
- Utiliser Blade pour créer des layouts réutilisables.
- Utiliser les slots (par défaut et nommés) pour passer du contenu aux
  composants.
- Utiliser Blade pour créer des composants réutilisables.
- Utiliser les layouts et les composants Blade pour structurer une application
  Laravel.
- Installer et configurer des dépendances externes avec Composer.
- Mettre en place l'internationalisation (i18n) dans une application Laravel.
- Utiliser les fichiers de traduction pour supporter plusieurs langues.
- Utiliser les variables d'environnement pour adapter l'application.
- Décrire la différence entre du CSS "classique" et un framework CSS utilitaire
  comme Tailwind CSS.
- Utiliser Tailwind CSS pour styliser les interfaces utilisateur.

![bg right:40%][illustration-objectifs]

## Introduction aux vues dans le patron MVC

## Les moteurs de templates

## Blade : le moteur de templates de Laravel

### Lien avec les routes

### Passage et affichage de données

### Syntaxe de base et directives

### Création de vues avec Artisan

## Layout Blade

### Approche avec les composants

### Structure d'un layout

### Utilisation du layout

## Slots par défaut et slots nommés

## Composants Blade

### Création d'un composant

### Vue du composant

### Classe du composant

### Utilisation du composant et passage de propriétés

### Passer des variables à des composants

## Internationalisation (i18n)

### Pourquoi l'internationalisation est importante

### Vocabulaire

### Configuration de la locale

### Fichiers de traduction

### Utilisation des traductions dans les vues

### Traductions au pluriel

## Gestion des dépendances avec Composer

### Installation d'une dépendance

### Librairie `laravel-lang/lang`

## Variables d'environnement

### Le fichier `.env`

### Le fichier `.env.example`

### Bonnes pratiques

## Tailwind CSS

### Approche CSS classique

### Approche avec Tailwind CSS

### Comparaison

### Intégration avec Laravel et Vite

### Aller plus loin avec Tailwind CSS

## Conclusion

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
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/tree/main/01-contenus-du-cours/04-vues-blade-et-tailwind-css/README.md
[licence]:
	https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course/blob/main/LICENSE.md

<!-- Illustrations -->

[illustration-principale]:
	https://images.unsplash.com/photo-1517486430290-35657bdcef51?fit=crop&h=720
[illustration-objectifs]:
	https://images.unsplash.com/photo-1516389573391-5620a0263801?fit=crop&h=720
[illustration-a-vous-de-jouer]:
	https://images.unsplash.com/photo-1509198397868-475647b2a1e5?fit=crop&h=720
