#!/usr/bin/env sh

## Variables
WORKDIR=$(pwd)
MARP_DOCKER_IMAGE="marpteam/marp-cli:v4.1.1"

## Script

echo "Removing all previous generated presentations and quizzes..."
rm -f **/*/*-presentation.pdf || true
rm -f **/*/*-quiz.pdf || true
rm -f **/*/index.html || true


# Check if Marp is installed locally
if command -v "marp-cli.js" > /dev/null 2>&1; then
    echo "Marp installed locally, using it..."
    MARP_CMD="marp-cli.js"
else
    echo "Marp not installed, using its Docker image..."
    MARP_CMD="docker run --rm --entrypoint=\"marp-cli.js\" --volume=\"$WORKDIR\":/home/marp/app $MARP_DOCKER_IMAGE"
fi

# Convert presentations
echo "Converting presentations, quiz, and feedbacks to HTML..."
eval "$MARP_CMD --config-file .marp/config.yaml --parallel $(nproc) **/*-presentation/README.md **/*-quiz/README.md **/*-feedbacks/README.md"

echo "Converting presentations, quiz, and feedbacks to PDF..."
eval "$MARP_CMD --config-file .marp/config.yaml --parallel $(nproc) --pdf **/*-presentation/README.md **/*-quiz/README.md **/*-feedbacks/README.md"

# Rename files
echo "Renaming HTML files to 'index.html'..."
find . -mindepth 3 -maxdepth 3 -type f -name "README.html" -exec sh -c '
    mv "$1" "$(dirname "$1")/index.html"
' sh {} \;

echo "Renaming presentation files..."
find . -mindepth 3 -maxdepth 3 -path "*-presentation/README.pdf" -exec sh -c '
    for file; do
        chapter_dir=$(dirname "$(dirname "$file")")
        chapter_name=$(basename "$chapter_dir")
        short_chapter_name=$(echo "$chapter_name" | cut -c1-2)  # Garde seulement les 2 premiers caractères
        clean_chapter_name=$(echo "$chapter_name" | cut -c4-)  # Supprime les 3 premiers caractères
        mv "$file" "$(dirname "$file")/${short_chapter_name}-01-presentation-${clean_chapter_name}.pdf"
    done
' sh {} +

echo "Renaming quiz files..."
find . -mindepth 3 -maxdepth 3 -path "*-quiz/README.pdf" -exec sh -c '
    for file; do
        chapter_dir=$(dirname "$(dirname "$file")")
        chapter_name=$(basename "$chapter_dir")
        short_chapter_name=$(echo "$chapter_name" | cut -c1-2)  # Garde seulement les 2 premiers caractères
        clean_chapter_name=$(echo "$chapter_name" | cut -c4-)  # Supprime les 3 premiers caractères
        mv "$file" "$(dirname "$file")/${short_chapter_name}-04-quiz-${clean_chapter_name}.pdf"
    done
' sh {} +

echo "Renaming feedbacks files..."
find . -mindepth 3 -maxdepth 3 -path "*-feedbacks/README.pdf" -exec sh -c '
    for file; do
        chapter_dir=$(dirname "$(dirname "$file")")
        chapter_name=$(basename "$chapter_dir")
        short_chapter_name=$(echo "$chapter_name" | cut -c1-2)  # Garde seulement les 2 premiers caractères
        clean_chapter_name=$(echo "$chapter_name" | cut -c4-)  # Supprime les 3 premiers caractères
        mv "$file" "$(dirname "$file")/${short_chapter_name}-05-feedbacks-${clean_chapter_name}.pdf"
    done
' sh {} +

echo "All presentations and quizzes processed successfully!"
