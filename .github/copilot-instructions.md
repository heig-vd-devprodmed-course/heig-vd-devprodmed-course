---
description: Instructions for GitHub Copilot in this repository.
applyTo: '**/*'
---

# Project guidelines

When working in this repository, please follow these guidelines to ensure
consistency and readability across all documents.

## Who am I?

I am a lecturer at a university of applied sciences (HES-SO) in Switzerland,
teaching Bachelor degree courses. This repository contains the materials for my
course.

I specialize in programming and software development, with a focus on teaching
how to code effectively. My goal is to help students not only learn programming
languages, but also develop problem-solving skills and a solid understanding of
software design principles.

I am organized and detail-oriented, striving to create clear and well-structured
course materials. I value open communication and collaboration, and I am always
looking for ways to improve my teaching methods and materials.

I speak French and English fluently. My requests will generally be in English,
but you have to follow the instructions below regarding language to use in
course materials.

I might sometimes make my requests in French, especially when referring to
specific course content or terminology that is best expressed in French, but
always respond in English. When making changes to course materials, ensure that
the language used is the one specified in the material itself (French or
English), regardless of the language of the request.

I might make mistakes or provide incomplete information in my requests. If you
notice any errors or inconsistencies, please point them out and suggest
corrections. I like people to critically reflect on information rather than
blindly accepting it.

## Who is this for?

My main audience is students enrolled in my programming course. They are
typically beginners to intermediate level with little to no prior programming
experience.

The students should feel supported and encouraged throughout the course. The
materials should be accessible and easy to understand, with clear explanations
and examples.

All the objectives, exercises, and examples should be tailored to the needs and
interests of beginner students learning programming for the first time.

## Teaching philosophy

This course follows key pedagogical principles:

- **Straight to the point**: Quick, efficient and useful content without wasting
  time.
- **Open**: Content can be improved, changed, and discussed openly.
- **Resilient**: Materials should be understandable and maintainable by others.
- **Freedom**: Students should pursue topics they find interesting and engaging.
- **Shit happens**: Create a safe space where mistakes are acceptable and
  students can openly discuss challenges.

### Learning approach

- **Self-directed learning**: Give students tools to learn independently.
- **Big picture first**: Short presentations provide overview, then students
  explore deeper through hands-on materials.
- **Flexible pace**: Students can choose their own path: theory first, practical
  first, or mixed.
- **Hybrid-friendly**: All materials available for on-site or remote learning.
- **Real-world relevance**: Focus on practical skills used in industry, not just
  academic exercises.
- **_"Teach them to fish"_**: Guide students to find solutions rather than
  giving direct answers.

### Pedagogical foundations

- Bloom's taxonomy for learning objectives.
- _"L'intelligence ce n'est pas ce que l'on sait mais ce que l'on fait quand on
  ne sait pas."_ - Jean Piaget
- Competency-based learning: mobilizing and combining resources to solve real
  problems.

## Course objectives

Deduce the main learning objectives and language for the course based on the
main [README](../README.md) file of the repository.

## Course structure

The course is organized into modules, each covering a specific topic in the
course.

### Files and folders structure

The repository is organized as follows:

```txt
./
├── 01-course-materials/
│   ├── 01-this-is-course-01-with-its-own-title/
│   │   ├── _images/
│   │   │   └── ...
│   │   ├── PRESENTATION.md
│   │   └── README.md
│   ├── 02-this-is-course-02-with-its-own-title/
│   │   ├── _images/
│   │   │   └── ...
│   │   ├── PRESENTATION.md
│   │   ├── QUIZ.md
│   │   └── README.md
│   ├── 03-this-is-course-03-with-its-own-title/
│   │   ├── 01-code-examples/
│   │   │   └── ...
│   │   ├── 02-exercises/
│   │   │   └── ...
│   │   ├── _images/
│   │   │   └── ...
│   │   ├── PRESENTATION.md
│   │   ├── QUIZ.md
│   │   └── README.md
│   ├── ...
│   ├── xy-this-is-course-xy-with-its-own-title/
│   │   ├── PRESENTATION.md
│   │   ├── QUIZ.md
│   │   └── README.md
│   └── README.md
├── 02-practical-works/
│   ├── 01-practical-work-1/
│   │   ├── _images/
│   │   │   └── ...
│   │   ├── PRESENTATION.md
│   │   └── README.md
│   ├── 02-practical-work-2/
│   │   ├── PRESENTATION.md
│   │   └── README.md
│   ├── ...
│   ├── xy-practical-work-xy/
│   │   ├── PRESENTATION.md
│   │   └── README.md
│   └── README.md
├── 03-final-evaluation/
│   ├── 01-archives/
│   │   ├── 2024-2025-final-evaluation/
│   │   │   └── README.md
│   │   └── README.md
│   ├── PRESENTATION.md
│   └── README.md
├── 04-other-resources/
│   ├── 01-resources-for-teachers/
│   │   └── README.md
│   └── README.md
├── build-all-presentations.sh*
├── LICENSE.md
└── README.md
```

Some of these terms might be translated into French in course materials written
in French. Here is a table with the translations:

| English                | French                                       |
| :--------------------- | :------------------------------------------- |
| Course materials       | Matériel de cours                            |
| Practical works        | Travaux pratiques                            |
| Final evaluation       | Évaluation finale                            |
| Other resources        | Autres ressources                            |
| Resources for teachers | Ressources pour les personnes qui enseignent |

Each modules are organized into folders named with a two-digit prefix followed
by a descriptive title, separated by hyphens (e.g.,
`01-introduction-to-programming`), to ensure proper ordering. Each module folder
may contain:

- A README file (`README.md`) that contains detailed explanations, examples, and
  exercises related to the topic.
- A presentation file (`PRESENTATION.md`) that provides an overview of the
  topic.
- A quiz file (`QUIZ.md`) that contains questions to test students' knowledge
  and understanding of the topic.

The main README file at the root of the repository provides an overview of the
course, including its objectives, structure, and any prerequisites.

### Main README file guidelines

The main README file at the root of the repository should include:

### Course material guidelines

Course materials are located in the `01-course-contents` directory. Most of the
time, a course material contains a `README.md` file with the main content, a
`PRESENTATION.md` file with a summary presentation, and sometimes a `QUIZ.md`
file with quiz questions.

### Code example guidelines

### Exercise guidelines

### Quiz guidelines

### Project-related guidelines

The structure

All course materials must include:

```markdown
V. Guidoux, avec l'aide de
[GitHub Copilot](https://github.com/features/copilot).

Ce travail est sous licence [CC BY-SA 4.0][licence].
```
