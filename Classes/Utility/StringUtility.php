<?php
namespace T3v\T3vCore\Utility;

use T3v\T3vCore\Utility\AbstractUtility;

/**
 * The string utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class StringUtility extends AbstractUtility {
  /**
   * Camelizes an input.
   *
   * @param string $input The input
   * @param string $separator The optional separator, defaults to `_`
   * @param boolean $capitalizeFirstCharacter If the first character should be capitalized, defaults to `false`
   * @return string The camelized output
   */
  public static function camelize($input, $separator = '_', $capitalizeFirstCharacter = false) {
    $input                    = (string) $input;
    $separator                = (string) $separator;
    $capitalizeFirstCharacter = (boolean) $capitalizeFirstCharacter;

    $output = mb_strtolower($input);
    $output = str_replace(' ', '', ucwords(str_replace($separator, ' ', $output)));

    if (!$capitalizeFirstCharacter) {
      $output[0] = mb_strtolower($output[0]);
    }

    return $output;
  }
}