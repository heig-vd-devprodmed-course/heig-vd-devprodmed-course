---
description:
  Instructions when working with Marp presentations in this repository.
applyTo: '**/PRESENTATION.md, **/QUIZ.md'
---

# Marp guidelines

## General guidelines

- If needed, you can split the slide's content into multiple slides by using the
  following principle:

  ```markdown
  # My presentation

  ## Content slide 1 (1)

  _Content of the first slide._

  ## Content slide 1 (2)

  _Content of the second slide, which is a continuation of the first slide._
  ```

## Presentation from a course content

- When creating a presentation from a course content, always keep the same
  headings with the same structure as the original content (titles and levels).
  This will help to keep a clear structure and make it easier to navigate
  between the original content and the presentation:

  ```markdown
  <!-- README.md -->

  # My course content

  ## Introduction

  ### Subsection 1

  #### Subsection 1.1

  ## Another section
  ```

  ```markdown
  <!-- PRESENTATION.md -->

  # My course content

  ## Introduction

  ### Subsection 1

  #### Subsection 1.1

  ## Another section
  ```

- When creating a presentation from a course content, also keep all the
  objectives from the original content. This will help to keep a clear structure
  and make it easier to navigate between the original content and the
  presentation:

  ```markdown
  <!-- README.md -->

  # My course content

  ## Objectives

  - Objective 1
  - Objective 2
  ```

  ```markdown
  <!-- PRESENTATION.md -->

  # My course content

  ## Objectives

  - Objective 1
  - Objective 2
  ```
