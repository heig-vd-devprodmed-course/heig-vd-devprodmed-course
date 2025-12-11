# Templates

This directory contains templates for various course resources:

- [`support-de-cours`](./support-de-cours/): Template for a complete course
  session, including presentation, quiz, code examples, exercises and solution.
- [`evaluation`](./evaluation/): Template for final evaluation resources,
  including instructions and archives.

These templates can be used as a starting point for creating new course
materials, ensuring consistency and quality across different courses and
sessions.

## Course metadata

Use the following metadata for your course materials, replacing the example
values with those specific to your course:

- GitHub repository URL (`GITHUB_REPOSITORY_URL`):
  <https://github.com/heig-vd-devprodmed-course/heig-vd-devprodmed-course>
- GitHub Pages URL (`GITHUB_PAGES_URL`):
  <https://heig-vd-devprodmed-course.github.io/heig-vd-devprodmed-course>
- Course title (`COURSE_TITLE`): Développement de produits médias
- Course code (`COURSE_CODE`): DévProdMéd
- Course author (`COURSE_AUTHOR`): L. Delafontaine, avec l'aide de
  [GitHub Copilot](https://github.com/features/copilot)
- Institution (`INSTITUTION`): HEIG-VD
- Institution URL (`INSTITUTION_URL`): <https://heig-vd.ch>
- Academic year (`ACADEMIC_YEAR`): 2025-2026
- License (`LICENSE_NAME`): CC BY-SA 4.0
- License URL (`LICENSE_LINK`): `{GITHUB_REPOSITORY_URL}/blob/main/LICENSE.md`

## Course structure

The course structure should follow the following organization:

```txt
./
├── 01-supports-de-cours/
│   └── ...
├── 02-evaluations/
│   └── ...
├── 03-autres-ressources/
│   └── ...
├── build-all-presentations.sh*
├── LICENSE.md
└── README.md
```

The folders and subfolders are named with a two-digit prefix followed by a
descriptive title, all in lowercase without any special characters, separated by
hyphens (e.g., `01-introduction-to-programming`), to ensure proper ordering.

### Course materials structure

The directory `01-course-materials/` (`COURSE_MATERIAL_FOLDER`) contains all
course materials, organized into subdirectories for each topic.

Each topic folder may contain:

- A README file (`README.md`) that contains detailed explanations and examples
  related to the topic to be covered.
- A presentation file (`PRESENTATION.md`) that provides an overview of the
  topic, a summarized version of the main points issued from the README file.
- A directory for code examples (`01-code-examples/`) that contains code
  snippets and examples related to the topic for students to explore and learn
  from.
- A directory for exercises (`02-exercises/`) that contains practical exercises
  related to the topic with their answers.
- A directory for the solution (`03-solution`) that contains the complete
  solution to the course material when applicable.
- Images, PlantUML diagrams, and other multimedia elements to enhance
  understanding are stored in a `_images/` subdirectory within the topic folder.

Use the [`course-session`](./course-session/) template to create new course
materials.

### Evaluations structure

The directory `02-evaluations/` (`EVALUATION_FOLDER`) contains all evaluation
resources, organized into subdirectories for each evaluation.

- A README file (`README.md`) that contains detailed explanations and examples
  related to the topic to be covered.
- A presentation file (`PRESENTATION.md`) that provides an overview of the
  topic, a summarized version of the main points issued from the README file.

Use the [`evaluation`](./evaluation/) template to create new evaluation
resources.

### Other resources structure

The directory `03-other-resources/` (`OTHER_RESOURCES_FOLDER`) contains any
additional resources that may be useful for the course, such as templates,
reference materials, or supplementary readings.

This directory is mostly used by the teaching staff and does not usually contain
materials for students.
