#!/usr/bin/env sh

## Variables
WORKDIR=$(pwd)
MARP_DOCKER_IMAGE="marpteam/marp-cli:v4.1.1"
PANDOC_DOCKER_IMAGE="pandoc/extra"

## Script

echo "Removing all previous generated presentations and quizzes..."
rm -f **/*/*-presentation.pdf || true
rm -f **/*/*-support-de-cours.pdf || true
rm -f **/*/*-exercices.pdf || true
rm -f **/*/*-solutions.pdf || true
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

PANDOC_CMD="docker run --rm --volume \"$WORKDIR:/data\" --user $(id -u):$(id -g) $PANDOC_DOCKER_IMAGE --from=gfm --template eisvogel --listings -V linkcolor=blue --highlight-style espresso"

# Convert support de cours to PDF
echo "Converting support de cours to PDF..."
find . -mindepth 3 -maxdepth 3 -type f -name "SUPPORT_DE_COURS.md"  -exec sh -c '
    for file in "$@"; do
        echo "Processing $file..."
        '"$PANDOC_CMD"' -o "$(dirname "$file")/SUPPORT_DE_COURS.pdf" "$file"
    done
' sh {} +
# Convert exercices to PDF
echo "Converting exercices to PDF..."
find . -mindepth 3 -maxdepth 3 -type f -name "EXERCICES.md" -exec sh -c "
    echo 'Processing \$1...' && \
    $PANDOC_CMD -o \"\$(dirname \"\$1\")/EXERCICES.pdf\" \"\$1\"
" bash {} +

# Convert solutions to PDF
echo "Converting solutions to PDF..."
find . -mindepth 3 -maxdepth 3 -type f -name "SOLUTIONS.md" -exec sh -c "
    echo 'Processing \$1...' && \
    $PANDOC_CMD -o \"\$(dirname \"\$1\")/SOLUTIONS.pdf\" \"\$1\"
" bash {} +

# Convert presentations
echo "Converting presentations to HTML..."
eval "$MARP_CMD --parallel $(nproc) **/*-presentation/README.md **/*-quiz/README.md"

echo "Converting presentations to PDF..."
eval "$MARP_CMD --parallel $(nproc) --pdf **/*-presentation/README.md **/*-quiz/README.md"

# Rename files
echo "Renaming EXERCICES files to match grandparent directory with 'exercices' suffix..."
find . -mindepth 3 -maxdepth 3 -type f -name "EXERCICES.pdf" -exec sh -c '
    chapter_name=$(basename "$(dirname "$(dirname "$1")")")
    mv "$1" "$(dirname "$1")/$chapter_name-exercices.pdf"
' sh {} \;

echo "Renaming SUPPORT_DE_COURS files to match grandparent directory with 'support-de-cours' suffix..."
find . -mindepth 3 -maxdepth 3 -type f -name "SUPPORT_DE_COURS.pdf" -exec sh -c '
    chapter_name=$(basename "$(dirname "$(dirname "$1")")")
    mv "$1" "$(dirname "$1")/$chapter_name-support-de-cours.pdf"
' sh {} \;

echo "Renaming SOLUTIONS files to match grandparent directory with 'solutions' suffix..."
find . -mindepth 3 -maxdepth 3 -type f -name "SOLUTIONS.pdf" -exec sh -c '
    chapter_name=$(basename "$(dirname "$(dirname "$1")")")
    mv "$1" "$(dirname "$1")/$chapter_name-solutions.pdf"
' sh {} \;

echo "Renaming HTML files to 'index.html'..."
find . -mindepth 3 -maxdepth 3 -type f -name "README.html" -exec sh -c '
    mv "$1" "$(dirname "$1")/index.html"
' sh {} \;

echo "Renaming presentation files to match parent directory..."
find . -mindepth 3 -maxdepth 3 -path "*-presentation/README.pdf" -exec sh -c '
    for file; do
        chapter_name=$(basename "$(dirname "$(dirname "$file")")")
        mv "$file" "$(dirname "$file")/$chapter_name-presentation.pdf"
    done
' sh {} +

echo "Renaming quiz files to match parent directory..."
find . -mindepth 3 -maxdepth 3 -path "*-quiz/README.pdf" -exec sh -c '
    for file; do
        chapter_name=$(basename "$(dirname "$(dirname "$file")")")
        mv "$file" "$(dirname "$file")/$chapter_name-quiz.pdf"
    done
' sh {} +

echo "All presentations and quizzes processed successfully!"

