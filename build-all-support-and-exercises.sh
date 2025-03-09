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
        dir_path=$(dirname "$file")
        image_path="$dir_path/images"
        '"$PANDOC_CMD"' -o "$dir_path/SUPPORT_DE_COURS.pdf" --resource-path="$dir_path:$image_path:/data" "$file"
    done
' sh {} +

# Convert exercices to PDF
echo "Converting exercices to PDF..."
find . -mindepth 3 -maxdepth 3 -type f -name "EXERCICES.md" -exec sh -c '
    for file in "$@"; do
        echo "Processing $file..."
        dir_path=$(dirname "$file")
        image_path="$dir_path/images"
        '"$PANDOC_CMD"' -o "$dir_path/EXERCICES.pdf" --resource-path="$dir_path:$image_path:/data" "$file"
    done
' sh {} +

# Convert solutions to PDF
echo "Converting solutions to PDF..."
find . -mindepth 3 -maxdepth 3 -type f -name "SOLUTIONS.md" -exec sh -c '
    for file in "$@"; do
        echo "Processing $file..."
        dir_path=$(dirname "$file")
        image_path="$dir_path/images"
        '"$PANDOC_CMD"' -o "$dir_path/SOLUTIONS.pdf" --resource-path="$dir_path:$image_path:/data" "$file"
    done
' sh {} +

# Renommer les fichiers générés
echo "Renaming generated PDFs..."
find . -mindepth 3 -maxdepth 3 -type f \( -name "EXERCICES.pdf" -o -name "SUPPORT_DE_COURS.pdf" -o -name "SOLUTIONS.pdf" \) -exec sh -c '
    for file in "$@"; do
        chapter_dir=$(dirname "$(dirname "$file")")
        chapter_name=$(basename "$chapter_dir")
        short_chapter_name=$(echo "$chapter_name" | cut -c1-2)  # Garde seulement les 2 premiers caractères
        clean_chapter_name=$(echo "$chapter_name" | cut -c4-)  # Supprime les 3 premiers caractères

        case "$file" in
            *SUPPORT_DE_COURS.pdf)
                new_name="${short_chapter_name}-02-support-de-cours-${clean_chapter_name}.pdf"
                ;;
            *EXERCICES.pdf)
                new_name="${short_chapter_name}-03-exercices-${clean_chapter_name}.pdf"
                ;;
            *SOLUTIONS.pdf)
                new_name="${short_chapter_name}-03-solutions-${clean_chapter_name}.pdf"
                ;;
        esac

        mv "$file" "$(dirname "$file")/$new_name"
    done
' sh {} +

echo "All support de cours, exercices and solutions processed successfully!"
