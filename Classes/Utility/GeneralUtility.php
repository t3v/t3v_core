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
   * Gets identifier from a name.
   *
   * @param string $name The name
   * @param string $separator The optional separator, defaults to `_`
   * @return string The identifier
   */
  public static function getIdentifier(string $name, string $separator = '_'): string {
    $slugify    = new Slugify(['separator' => $separator]);
    $identifier = $slugify->slugify($name);

    return $identifier;
  }
}