<?php
namespace T3v\T3vCore\Utility;

/**
 * The string utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class StringUtility {
  /**
   * Camelizes an input.
   *
   * @param string $input The input
   * @param string $separator The optional separator, defaults to `_`
   * @param boolean $capitalizeFirstCharacter If the first character should be capitalized, defaults to `false`
   * @return string The camelized output
   */
  public static function camelize($input, $separator = '_', $capitalizeFirstCharacter = false) {
    $output                   = (string)  $input;
    $separator                = (string)  $separator;
    $capitalizeFirstCharacter = (boolean) $capitalizeFirstCharacter;

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