#!/usr/bin/env sh

# === Variables ===

BASE_PATH=$(dirname "$0")

# === Commands ===

"$BASE_PATH/Tests/Unit.sh"
"$BASE_PATH/Tests/Functional.sh"
