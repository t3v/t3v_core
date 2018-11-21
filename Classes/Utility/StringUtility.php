<?php
namespace T3v\T3vCore\Utility;

use Stringy\StaticStringy as S;

/**
 * The string utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class StringUtility {
  /**
   * Returns an ASCII version of the input.
   *
   * @param string $input The input
   * @param string $language The optional language, defaults to `en`
   * @param bool $removeUnsupported Remove unsupported characters , defaults to `true`
   * @return string The asciified input
   */
  public static function asciify(string $input, string $language = 'en', bool $removeUnsupported = true): string {
    $output = S::toAscii($input, $language, $removeUnsupported);

    return $output;
  }

  /**
   * Camelizes an input.
   *
   * @param string $input The input
   * @param string $separator The optional separator, defaults to `_`
   * @param bool $capitalizeFirstCharacter If the first character should be capitalized, defaults to `false`
   * @return string The camelized input
   */
  public static function camelize(string $input, string $separator = '_', bool $capitalizeFirstCharacter = false): string {
    $output = $input;

    if (ctype_upper($output)) {
      $output = mb_strtolower($output);
    }

    if (strpos($output, $separator) || strpos($output, ' ')) {
      $output = mb_strtolower($input);
      $output = str_replace(' ', '', ucwords(str_replace($separator, ' ', $output)));
    }

    if ($output[0] && !$capitalizeFirstCharacter) {
      $output[0] = mb_strtolower($output[0]);
    }

    return $output;
  }
}