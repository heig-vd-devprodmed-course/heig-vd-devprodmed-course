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

# Validation, erreurs et mails

<!--
_class: lead
_paginate: false
-->

## Objectifs

À la fin de cette séance, vous devriez être capable de :

- Lister les étapes nécessaires pour valider un formulaire dans Laravel.
- Décrire le fonctionnement des messages d'erreur et leur affichage dynamique.
- Identifier comment Laravel gère la validation des champs via FormRequest.
- Appliquer une validation sur un formulaire en respectant les bonnes pratiques.
- Énumérer les étapes pour ajouter une nouvelle langue et traduire les messages
  d'erreur.
- Utiliser la fonction old() pour conserver les valeurs saisies en cas d'erreur.
- Configurer et tester l'envoi d'e-mails dans Laravel à l’aide de Mailpit.
