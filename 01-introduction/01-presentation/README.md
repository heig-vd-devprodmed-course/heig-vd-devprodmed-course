---
marp: true
---

<!--
theme: custom-marp-theme
size: 16:9
paginate: true
author: L. Delafontaine et V. Guidoux, avec l'aide de GitHub Copilot
title: HEIG-VD DévProdMéd - Cours Laravel
description: Introduction, motivation et organisation de l'unité pour le cours DévProdMéd à la HEIG-VD, Suisse
header: "**Introduction, motivation et organisation de l'unité**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
headingDivider: 6
-->

# Introduction, motivation et organisation de l'unité

<!--
_class: lead
_paginate: false
-->

<small>Vincent Guidoux avec l'aide de GitHub Copilot</small>

<small>Ce travail est sous licence CC BY-SA 4.0.</small>

## Bienvenue au cours DévProdMéd

<!-- _class: lead -->

## Qui suis-je

<!-- _class: lead -->

Vincent Guidoux

!w:200

🎭🌿📖🛠️🌀

<vincent.guidoux1@heig-vd.ch> · <https://github.com/Nortalle>

## Comment me contacter

Selon vos préférences, vous pouvez utiliser l'un des canaux de communication
suivants pour toute question relative au cours :

- En personne
- Teams
- Par e-mail : <vincent.guidoux1@heig-vd.ch>

## Plus de détails dans le support de cours

<!-- _class: lead -->

Cette présentation est un résumé du support de cours.

## Objectifs

- Lister les objectifs du cours
- Décrire ce qu'est Laravel
- Être capable d'initier un projet Laravel

![bg right:40%](https://images.unsplash.com/photo-1619261530623-2171166909e8?fit=crop&h=720)

## Objectifs du cours (1/2)

Selon la fiche d'unité, à la fin de ce cours, vous devriez être capable de :

> - Mettre en œuvre des architectures client-serveur en suivant des design
>   patterns
> - Maîtriser un framework de développement web
> - Maîtriser les concepts avancés de la programmation serveur
> - Comprendre et utiliser les fondamentaux de sécurité dans le développement
>   d'applications web

## Objectifs du cours (2/2)

> - Mettre en œuvre une couche de mapping objet-relationnel (ORM) pour la
>   gestion d'une base de données
> - Réaliser des Web Services simples utilisant une architecture REST-like

En résumé, à la fin de ce cours, vous devriez être capable de développer une
application web complète en utilisant Laravel.

## Modalités d'organisation du cours

- En présentiel
- De la théorie sera abordée, mais surtout de la pratique
- Espace de discussion pour poser des questions et obtenir de l'aide/des retours

## Modalités d'évaluation

Le cours sera évalué sur plusieurs aspects :

- deux évaluations écrites
- ... ?

### Évaluation écrite

- Évaluation sur les connaissances théoriques acquises sur tout le semestre
- Durée minimale de 45 minutes
- Devrait utiliser la plateforme d'évaluation en ligne de la HEIG-VD

## Qu'est-ce que Laravel ?

<!-- _class: lead -->

### Un framework PHP multi-plateforme permettant de créer des applications web

Permet de créer des applications web rapidement grâce à une vaste bibliothèque
de fonctionnalités pré-programmées.

![bg right:40%](https://images.unsplash.com/photo-1585569695919-db237e7cc455?fit=crop&h=720)

<!-- https://unsplash.com/photos/black-and-red-tool-box-EcE9dFfXwwE -->

### Un framework PHP basé sur les principes de la programmation orientée objet (POO)

Utilise des concepts de POO comme les classes, les objets, l’héritage et le
polymorphisme pour structurer le code.

![bg right:40%](https://images.unsplash.com/photo-1619261530623-2171166909e8?fit=crop&h=720)

<!-- https://unsplash.com/photos/brown-wooden-blocks-on-black-surface-ANIqg7a7u1g -->

### Langage de script

PHP est un langage de script open source, côté serveur, utilisé pour le
développement web. Il est interprété au moment de l’exécution.

![bg right:40%](https://images.unsplash.com/reserve/LJIZlzHgQ7WPSh5KVTCB_Typewriter.jpg?fit=crop&h=720)

<!-- https://images.unsplash.com/reserve/LJIZlzHgQ7WPSh5KVTCB_Typewriter.jpg?q=80&w=1992&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D -->

### Frontend ou Backend ?

Principalement un framework de développement Backend, mais offre quelques
fonctionnalités Frontend.

![bg right:40%](https://images.unsplash.com/photo-1571786256017-aee7a0c009b6?fit=crop&h=720)

<!-- https://unsplash.com/photos/photo-of-gray-building-9drS5E_Rguc -->

### Architecture logicielle MVC (Modèle-Vue-Contrôleur)

Le modèle gère les données, la vue affiche les données et le contrôleur gère les
interactions entre le modèle et la vue.

![bg right:40%](https://images.unsplash.com/photo-1610389051254-64849803c8fd?fit=crop&h=720)

<!-- https://unsplash.com/photos/man-in-black-and-white-checkered-dress-shirt-drinking-from-brown-and-white-ceramic-mug-T42j_xLOqw0 -->

## Pourquoi utiliser Laravel ?

<!-- _class: lead -->

### Facile à apprendre

Accessible pour ceux qui ont des notions de POO, HTML et des systèmes de gestion
de bases de données relationnelles.

![bg right:40%](https://images.unsplash.com/photo-1610471512331-02a5d7d2532f?fit=crop&h=720)

<!-- https://unsplash.com/photos/brown-wooden-bridge-over-river-qlheiI2e_ec -->

### Simplifie le processus de développement

Simplifie les tâches courantes comme le routage, l’authentification, la
migration et la mise en cache.

![bg right:40%](https://images.unsplash.com/photo-1586810146927-6503e5eb48fd?fit=crop&h=720)

<!-- simple -->

### Outils pour tous les niveaux

Propose des kits de démarrage pour les personnes débutantes et des
fonctionnalités avancées pour les plus expérimentées.

![bg right:40%](https://images.unsplash.com/photo-1728207056108-18b04ad24e1e?fit=crop&h=720)

<!-- https://unsplash.com/photos/a-train-station-with-escalators-and-stairs-6yAq97HGxjU -->

### Évolue facilement

Hautement évolutif et peut traiter des millions de requêtes par mois grâce à des
systèmes de cache rapides et distribués.

![bg right:40%](https://images.unsplash.com/photo-1612753666134-2792aa809104?fit=crop&h=720)

<!-- darwin -->

### Écosystème et communauté massive

Vaste communauté et une bibliothèque d’applications et de paquets disponibles.

![bg right:40%](https://images.unsplash.com/photo-1520627977056-c307aeb9a625?fit=crop&h=720)

<!-- forum -->

### Largement utilisé

De nombreuses entreprises utilisent ce framework pour créer des sites web
fonctionnels et intuitifs.

![bg right:40%](https://images.unsplash.com/photo-1462212210333-335063b676bc?fit=crop&h=720)

<!-- used -->

## Que fait Laravel ? (1/2)

- Routing
- Authentification
- Migration
- Templating
- Sessions
- Validation des données

![bg right:40%](https://images.unsplash.com/photo-1619261530623-2171166909e8?fit=crop&h=720)

## Que fait Laravel ? (2/2)

- Cache
- Traitement des erreurs
- Tests
- Stockage et gestion des fichiers (Flysystem, Cloud)
- E-mail
- Notifications (SMS/Slack)

![bg right:40%](https://images.unsplash.com/photo-1619261530623-2171166909e8?fit=crop&h=720)

<!-- ## Sources (1/3)

- Illustration principale par Annie Spratt (https://unsplash.com/@anniespratt)
  sur Unsplash
  (https://unsplash.com/photos/white-wall-tiles-in-close-up-photography-OZ2BNYfF_xM)
- Illustration par [Aline de Nadai](https://unsplash.com/@alinedenadai) sur
  Unsplash (https://unsplash.com/photos/j6brni7fpvs)
- Illustration par Marvin Meyer (https://unsplash.com/@marvelous) sur Unsplash
  (https://unsplash.com/photos/people-sitting-down-near-table-with-assorted-laptop-computers-SYTO3xs06fU)
- Illustration par Nguyen Dang Hoang Nhu (https://unsplash.com/@nguyendhn) sur
  Unsplash
  (https://unsplash.com/photos/person-writing-on-white-paper-qDgTQOYk6B8)
- Illustration par Alex Litvin (https://unsplash.com/@alexlitvin) sur Unsplash
  (https://unsplash.com/photos/turned-on-led-projector-on-table-MAYsdoYpGuk)
- Illustration par Annie Spratt (https://unsplash.com/@anniespratt) sur Unsplash
  (https://unsplash.com/photos/white-and-black-paper-lot-_dAnK9GJvdY)
- Illustration par Rachit Tank (https://unsplash.com/@rachitank) sur Unsplash
  (https://unsplash.com/photos/round-white-watch-with-white-band-2cFZ_FB08UM)
- Illustration par Lance Anderson (https://unsplash.com/@lanceanderson) sur
  Unsplash
  (https://unsplash.com/photos/white-and-black-architectural-building-diagram-oSZzkAqIRIM)

## Sources (2/3)

- Illustration par Alvaro Reyes (https://unsplash.com/@alvarordesign) sur
  Unsplash
  (https://unsplash.com/photos/person-working-on-blue-and-white-paper-on-board-qWwpHwip31M)
- Illustration par Jason Goodman
  (https://unsplash.com/@jasongoodman_youxventures) sur Unsplash
  (https://unsplash.com/photos/man-standing-behind-flat-screen-computer-monitor-bzqU01v-G54)
- Illustration par John Arano (https://unsplash.com/@johnarano) sur Unsplash
  (https://unsplash.com/photos/three-people-holding-glass-bottles-while-talking-_qADvinJi20)
- Illustration par Faizur Rehman (https://unsplash.com/@fazurrehman) sur
  Unsplash
  (https://unsplash.com/photos/person-holding-black-ipad-with-green-plant-dJpupM4LiS4)
- Illustration par Mark König (https://unsplash.com/@markkoenig) sur Unsplash
  (https://unsplash.com/photos/blue-and-white-wooden-house-on-green-grass-field-during-daytime-1UMrSoItdDE)
- Illustration par Niklas Tidbury (https://unsplash.com/@ntidbury) sur Unsplash
  (https://unsplash.com/photos/brown-and-gray-wooden-house-near-mountain-valley-during-daytime-tc3SyHYF_4s)
- Illustration par Nikita Kachanovsky (https://unsplash.com/@nkachanovskyyy) sur
  Unsplash
  (https://unsplash.com/photos/white-sony-ps4-dualshock-controller-over-persons-palm-FJFPuE1MAOM)
- Illustration par Randy Fathe (https://unsplash.com/@randyfath) sur Unsplash
  (https://unsplash.com/photos/selective-focus-photography-of-chess-pieces-G1yhU1Ej-9A)

## Sources (3/3)

- Illustration par Brooke Cagle (https://unsplash.com/@brookecagle) sur Unsplash
  (https://unsplash.com/photos/a-group-of-friends-at-a-coffee-shop--uHVRvDr7pg)
- Illustration par Steven Wright (https://unsplash.com/@stevenwright) sur
  Unsplash (https://unsplash.com/photos/magnifying-glass-mq8QogEBy00)
- Illustration par Jakub Żerdzicki (https://unsplash.com/@jakubzerdzicki) sur
  Unsplash
  (https://unsplash.com/photos/a-pink-and-purple-phone-sitting-on-top-of-a-purple-and-pink-background-Z-vPf7KBuT8)

[^1]:
    Unsplash
    (https://unsplash.com/photos/white-wall-tiles-in-close-up-photography-OZ2BNYfF_xM) -->
