#!/usr/bin/env bash

# === Variables ===

TYPO3_VERSION="^11.5"

# === Commands ===

# Removes the Composer lock file if available:
if [ -f composer.lock ]; then
  rm composer.lock
fi

# Requires the core library of TYPO3:
composer require typo3/cms-core="$TYPO3_VERSION"

# Resets the changes:
git checkout composer.json

# Try to keep environment pollution down, EPA loves us:
unset TYPO3_VERSION
