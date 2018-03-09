<?php
namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The extension utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class ExtensionUtility {
  /**
   * Gets the extension identifier from an extension key.
   *
   * @param string $extensionKey The extension key
   * @return string The extension identifier
   */
  public static function extensionIdentifier($extensionKey) {
    $extensionKey = (string) $extensionKey;

    $extensionIdentifier = GeneralUtility::underscoredToUpperCamelCase($extensionKey);
    $extensionIdentifier = mb_strtolower($extensionIdentifier);

    return $extensionIdentifier;
  }

  /**
   * Gets the extension signature from a namespace and extension key.
   *
   * @param string $namespace The namespace
   * @param string $extensionKey The extension key
   * @return string The extension signature
   */
  public static function extensionSignature($namespace, $extensionKey) {
    $namespace    = (string) $namespace;
    $extensionKey = (string) $extensionKey;

    $extensionSignature = GeneralUtility::underscoredToUpperCamelCase($namespace . '.' . $extensionKey);

    return $extensionSignature;
  }
}