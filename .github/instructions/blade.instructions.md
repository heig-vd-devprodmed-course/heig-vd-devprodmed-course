---
description:
  Instructions when working with Blade files (Laravel) in this repository.
applyTo: "**/*.blade.php"
---

# Blade guidelines

- Follow HTML5 standards and best practices when writing Blade templates
  (semantic tags, accessibility, etc.).
- Never hardcode strings in Blade templates. Use localization files for all
  user-facing text to support multiple languages.
- Create components for reusable pieces of UI. This promotes code reusability
  and maintainability.
- Use Blade directives (e.g., `@if`, `@foreach`, `@include`) to keep your
  templates clean and readable.
- Try to minimize the amount of Tailwind CSS classes in Blade templates. Stay
  simple and consistent.
- Mobile-first: start by writing styles for mobile devices, then use responsive
  utilities to adapt the layout for larger screens.
- Support for dark mode: use the `dark:` prefix to apply styles for dark mode.
