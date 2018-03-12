<?php
namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

use Cocur\Slugify\Slugify;

/**
 * The icon utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class IconUtility {
  /**
   * Gets the icon identifier from an icon key.
   *
   * @param string $iconKey The icon key
   * @param string $separator The optional separator, defaults to `_`
   * @return string The icon identifier
   */
  public static function iconIdentifier($iconKey, $separator = '_') {
    $iconKey        = (string) $iconKey;
    $slugify        = GeneralUtility::makeInstance(Slugify::class);
    $iconIdentifier = $slugify->slugify($iconKey, $separator);

    return $iconIdentifier;
  }

  /**
   * Gets the icon signature from an extension key and icon identifier.
   *
   * @param string $extensionKey The extension key
   * @param string $iconIdentifier The icon identifier
   * @param string $separator The optional separator, defaults to `-`
   * @return string The icon signature
   */
  public static function iconSignature($extensionKey, $iconIdentifier, $separator = '-') {
    $extensionKey   = (string) $extensionKey;
    $iconIdentifier = (string) $iconIdentifier;
    $separator      = (string) $separator;
    $iconSignature  = mb_strtolower("${extensionKey}${separator}${iconIdentifier}");

    return $iconSignature;
  }
}