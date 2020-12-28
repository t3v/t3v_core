#!/usr/bin/env sh

# === Variables ===

BASE_PATH=$(dirname "$0")
ROOT_PATH="$BASE_PATH/../.."

# === Exports ===

export BUILD_PATH="$ROOT_PATH/.build"
export BIN_PATH="$BUILD_PATH/bin"
export VENDOR_PATH="$BUILD_PATH/vendor"
export TYPO3_PATH_WEB="$BUILD_PATH/web"
export TESTING_FRAMEWORK_PATH="$VENDOR_PATH/nimut/testing-framework/res/Configuration";

# === Commands ===

"$BIN_PATH/phpunit" --colors --configuration "$TESTING_FRAMEWORK_PATH/UnitTests.xml" "$ROOT_PATH/Tests/Unit"

# find "Tests/Unit" -wholename "*Test.php" | parallel --gnu "$BIN_PATH/phpunit --colors --configuration $TESTING_FRAMEWORK_PATH/UnitTests.xml {}"

# Try to keep environment pollution down, EPA loves us
unset BASE_PATH ROOT_PATH
