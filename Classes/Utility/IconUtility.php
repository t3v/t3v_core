<?php
namespace T3v\T3vCore\Utility;

use Cocur\Slugify\Slugify;

/**
 * The icon utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class IconUtility {
  /**
   * Gets an icon identifier from an icon key.
   *
   * @param string $iconKey The icon key
   * @param string $separator The optional separator, defaults to `_`
   * @return string The icon identifier
   */
  public static function iconIdentifier(string $iconKey, string $separator = '_'): string {
    $slugify        = new Slugify(['separator' => $separator]);
    $iconIdentifier = $slugify->slugify($iconKey);

    return $iconIdentifier;
  }

  /**
   * Alias for the `iconIdentifier` function.
   *
   * @param string $iconKey The icon key
   * @param string $separator The optional separator, defaults to `_`
   * @return string The icon identifier
   */
  public static function getIconIdentifier(string $iconKey, string $separator = '_'): string {
    return self::iconIdentifier($iconKey, $separator);
  }

  /**
   * Gets an icon signature from an extension key and icon identifier.
   *
   * @param string $extensionKey The extension key
   * @param string $iconIdentifier The icon identifier
   * @param string $separator The optional separator, defaults to `-`
   * @return string The icon signature
   */
  public static function iconSignature(string $extensionKey, string $iconIdentifier, string $separator = '-'): string {
    $iconSignature = mb_strtolower("${extensionKey}${separator}${iconIdentifier}");

    return $iconSignature;
  }

  /**
   * Alias for the `iconSignature` function.
   *
   * @param string $extensionKey The extension key
   * @param string $iconIdentifier The icon identifier
   * @param string $separator The optional separator, defaults to `-`
   * @return string The icon signature
   */
  public static function getIconSignature(string $extensionKey, string $iconIdentifier, string $separator = '-'): string {
    return self::iconSignature($extensionKey, $iconIdentifier, $separator);
  }
}