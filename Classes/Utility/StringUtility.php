<?php
namespace T3v\T3vCore\Utility;

use \T3v\T3vCore\Utility\AbstractHelper;

/**
 * String Utility Class
 *
 * @package T3v\T3vCore\Utility
 */
class StringUtility extends AbstractUtility {
  /**
   * Function to camelize a input.
   *
   * @param string $input The input
   * @param string $separator The optional separator, defaults to `_`
   * @param boolean $capitalizeFirstCharacter If the first character should be capitalized, defaults to `false`
   * @return string The camelize input
   */
  public static function camelize($input, $separator = '_', $capitalizeFirstCharacter = false) {
    $output = strtolower($input);
    $output = str_replace(' ', '', ucwords(str_replace($separator, ' ', $output)));

    if (!$capitalizeFirstCharacter) {
      $output[0] = strtolower($output[0]);
    }

    return $output;
  }
}