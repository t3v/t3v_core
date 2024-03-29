#!/usr/bin/env sh

# === Variables ===

TYPO3_VERSION="^11.5"
TYPO3_VERSION_DIGITS=${TYPO3_VERSION//[^[:digit:]]/}
TYPO3_MAJOR_VERSION="${TYPO3_VERSION_DIGITS::1}"

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
unset TYPO3_VERSION TYPO3_VERSION_DIGITS TYPO3_MAJOR_VERSION
