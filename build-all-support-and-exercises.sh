#!/usr/bin/env sh

## Variables
WORKDIR=$(pwd)
PANDOC_DOCKER_IMAGE="pandoc/extra"

## Script

echo "Removing all previous generated presentations and quizzes..."
rm -f **/*/*-support-de-cours.pdf || true
rm -f **/*/*-exercices.pdf || true
rm -f **/*/*-solutions.pdf || true

# Check if Pandoc is installed locally
if command -v "pandoc" > /dev/null 2>&1; then
    echo "Pandoc installed locally, using it..."
    PANDOC_CMD="pandoc --from=gfm --template eisvogel -V linkcolor=blue --highlight-style tango -V monofont='Courier New'"
else
    echo "Pandoc not installed, using its Docker image..."
    PANDOC_CMD="docker run --rm --volume \"$WORKDIR:/data\" --user $(id -u):$(id -g) $PANDOC_DOCKER_IMAGE --from=gfm --template eisvogel -V linkcolor=blue --highlight-style tango -V monofont='Courier New'"
fi

# Convert support de cours to PDF
echo "Converting support de cours to PDF..."
find . -mindepth 3 -maxdepth 3 -type f -name "SUPPORT_DE_COURS.md" -exec sh -c '
    for file in "$@"; do
        echo "Processing $file..."
        '"$PANDOC_CMD"' -o "$(dirname "$file")/SUPPORT_DE_COURS.pdf" "$file"
    done
' sh {} +

# Convert exercices to PDF
echo "Converting exercices to PDF..."
find . -mindepth 3 -maxdepth 3 -type f -name "EXERCICES.md" -exec sh -c '
    for file in "$@"; do
        echo "Processing $file..."
        '"$PANDOC_CMD"' -o "$(dirname "$file")/EXERCICES.pdf" "$file"
    done
' sh {} +

# Convert solutions to PDF
echo "Converting solutions to PDF..."
find . -mindepth 3 -maxdepth 3 -type f -name "SOLUTIONS.md" -exec sh -c '
    for file in "$@"; do
        echo "Processing $file..."
        '"$PANDOC_CMD"' -o "$(dirname "$file")/SOLUTIONS.pdf" "$file"
    done
' sh {} +

# Rename files
echo "Renaming generated PDFs..."
find . -mindepth 3 -maxdepth 3 -type f \( -name "EXERCICES.pdf" -o -name "SUPPORT_DE_COURS.pdf" -o -name "SOLUTIONS.pdf" \) -exec sh -c '
    for file in "$@"; do
        chapter_name=$(basename "$(dirname "$(dirname "$file")")")
        case "$file" in
            *EXERCICES.pdf) mv "$file" "$(dirname "$file")/$chapter_name-exercices.pdf" ;;
            *SUPPORT_DE_COURS.pdf) mv "$file" "$(dirname "$file")/$chapter_name-support-de-cours.pdf" ;;
            *SOLUTIONS.pdf) mv "$file" "$(dirname "$file")/$chapter_name-solutions.pdf" ;;
        esac
    done
' sh {} +


echo "All support de cours, exercices and solutions processed successfully!"

