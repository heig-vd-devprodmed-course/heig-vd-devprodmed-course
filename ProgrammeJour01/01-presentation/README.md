---
marp: true
---

<!--
theme: gaia
size: 16:9
paginate: true
author: L. Delafontaine et V. Guidoux, avec l'aide de GitHub Copilot
title: HEIG-VD DévProdMéd - Cours Laravel
description: Introduction, motivation et organisation de l'unité pour le cours DévProdMéd à la HEIG-VD, Suisse
header: "**Introduction, motivation et organisation de l'unité**"
footer: "**HEIG-VD** - DévProdMéd Course 2024-2025 - CC BY-SA 4.0"
style: |
    :root {
        --color-background: #fff;
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
    th:first-child {
        width: 15%;
    }
    h1, h2, h3, h4, h5, h6 {
        color: var(--color-headings);
    }
    h2, h3, h4, h5, h6 {
        font-size: 1.5rem;
    }
    h1 a:link, h2 a:link, h3 a:link, h4 a:link, h5 a:link, h6 a:link {
        text-decoration: none;
    }
    section:not(.lead) > p, blockquote {
        text-align: justify;
    }
    section:has(h1) {
        padding: 50px;
    }
    section:has(h1) > header {
        display: none;
    }
    section > header {
        font-size: 50%;
    }
    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .center {
        text-align: center;
    }
headingDivider: 6
-->

# Introduction, motivation et organisation de l'unité

<!--
_class: lead
_paginate: false
-->

<small>Vincent Guidoux avec l'aide de GitHub Copilot</small>

<small>Ce travail est sous licence CC BY-SA 4.0.</small>

## Bienvenue au cours DévProdMéd !

<!-- _class: lead -->

## Qui suis-je

<!-- _class: lead -->

Vincent Guidoux

!w:200

🎭🌿📖🛠️🌀

vincent.guidoux1@heig-vd.ch · https://github.com/Nortalle

## Comment me contacter

Selon vos préférences, vous pouvez utiliser l'un des canaux de communication
suivants pour toute question relative au cours :

- En personne
- Teams
- Par e-mail : vincent.guidoux1@heig-vd.ch

## Plus de détails dans le support de cours

<!-- _class: lead -->

Cette présentation est un résumé du support de cours.

## Objectifs

- Lister les objectifs du cours
- Décrire ce qu'est Laravel
- Être capable d'initier un projet Laravel

!bg right:40%

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

!bg right:40%

## Qu'est-ce que Laravel ?

<!-- _class: lead -->

### Un framework PHP multi-plateforme permettant de créer des applications web

Permet de créer des applications web rapidement grâce à une vaste bibliothèque
de fonctionnalités pré-programmées.

![bg
