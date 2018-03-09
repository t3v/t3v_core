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
   * @param string $separator The optional separator, defaults to `.`
   * @return string The extension signature
   */
  public static function extensionSignature($namespace, $extensionKey, $separator = '.') {
    $namespace    = (string) $namespace;
    $extensionKey = (string) $extensionKey;
    $separator    = (string) $separator;

    $namespace          = GeneralUtility::underscoredToUpperCamelCase($namespace);
    $extensionKey       = GeneralUtility::underscoredToUpperCamelCase($extensionKey);
    $extensionSignature = $namespace . $separator . $extensionKey;

    return $extensionSignature;
  }

  /**
   * Gets the configuration folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
   * @return string The configuration folder
   */
  public static function configurationFolder($extensionKey, $prefix = 'FILE:EXT:') {
    $extensionKey = (string) $extensionKey;
    $prefix       = (string) $prefix;

    return $prefix . $extensionKey . '/Configuration';
  }

  /**
   * Gets the FlexForms folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
   * @return string The FlexForms folder
   */
  public static function flexFormsFolder($extensionKey, $prefix = 'FILE:EXT:') {
    $extensionKey = (string) $extensionKey;
    $prefix       = (string) $prefix;

    $configurationFolder = self::configurationFolder($extensionKey, $prefix);

    return $configurationFolder . '/FlexForms';
  }

  /**
   * Gets the resources folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The resources folder
   */
  public static function resourcesFolder($extensionKey, $prefix = 'EXT:') {
    $extensionKey = (string) $extensionKey;
    $prefix       = (string) $prefix;

    return $prefix . $extensionKey . '/Resources';
  }
}