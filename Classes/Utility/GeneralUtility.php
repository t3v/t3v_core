<?php
namespace T3v\T3vCore\Utility;

use Cocur\Slugify\Slugify;

/**
 * The general utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class GeneralUtility {
  /**
   * Gets an identifier from a name.
   *
   * @param string $name The name
   * @param string $separator The optional separator, defaults to `_`
   * @return string The identifier
   */
  public static function getIdentifier($name, $separator = '_') {
    $name       = (string) $name;
    $separator  = (string) $separator;
    $slugify    = new Slugify(['separator' => $separator]);
    $identifier = $slugify->slugify($name);

    return $identifier;
  }
}