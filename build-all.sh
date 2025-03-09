#!/usr/bin/env sh

rm -f **/*/*.pdf || true

./build-all-presentations-and-quiz.sh
./build-all-support-and-exercises.sh
