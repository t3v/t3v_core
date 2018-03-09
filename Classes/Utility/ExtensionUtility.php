<?php
namespace T3v\T3vCore\Utility;

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
    $extensionKey        = (string) $extensionKey;
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
    $namespace    = GeneralUtility::underscoredToUpperCamelCase($namespace);
    $extensionKey = GeneralUtility::underscoredToUpperCamelCase($extensionKey);

    return "${namespace}${separator}${extensionKey}";
  }

  /**
   * Gets the locallang file from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional file name of the locallang file, defaults to `locallang.xlf`
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @param string $separator The optional separator, defaults to `:`
   * @return string The locallang file
   */
  public static function locallang($extensionKey, $fileName = 'locallang.xlf', $prefix = 'LLL:EXT:', $separator = ':') {
    $extensionKey   = (string) $extensionKey;
    $fileName       = (string) $fileName;
    $prefix         = (string) $prefix;
    $separator      = (string) $separator;
    $languageFolder = self::languageFolder($extensionKey, $prefix);

    return "${languageFolder}/${fileName}${separator}";
  }

  /**
   * Alias for `locallang`.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional file name of the locallang file, defaults to `locallang.xlf`
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @param string $separator The optional separator, defaults to `:`
   * @return string The locallang file
   */
  public static function lll($extensionKey, $fileName = 'locallang.xlf', $prefix = 'LLL:EXT:', $separator = ':') {
    $extensionKey   = (string) $extensionKey;
    $fileName       = (string) $fileName;
    $prefix         = (string) $prefix;
    $separator      = (string) $separator;

    return self::locallang($extensionKey, $fileName, $prefix, $separator);
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

    return "${prefix}${extensionKey}/Configuration";
  }

  /**
   * Gets the FlexForms folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
   * @return string The FlexForms folder
   */
  public static function flexFormsFolder($extensionKey, $prefix = 'FILE:EXT:') {
    $extensionKey        = (string) $extensionKey;
    $prefix              = (string) $prefix;
    $configurationFolder = self::configurationFolder($extensionKey, $prefix);

    return "${configurationFolder}/FlexForms";
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

    return "${prefix}${extensionKey}/Resources";
  }

  /**
   * Gets the private folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The private folder
   */
  public static function privateFolder($extensionKey, $prefix = 'EXT:') {
    $extensionKey    = (string) $extensionKey;
    $prefix          = (string) $prefix;
    $resourcesFolder = self::resourcesFolder($extensionKey, $prefix);

    return "${resourcesFolder}/Private";
  }

  /**
   * Gets the language folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The language folder
   */
  public static function languageFolder($extensionKey, $prefix = 'EXT:') {
    $extensionKey  = (string) $extensionKey;
    $prefix        = (string) $prefix;
    $privateFolder = self::privateFolder($extensionKey, $prefix);

    return "${privateFolder}/Language";
  }

  /**
   * Gets the public folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The public folder
   */
  public static function publicFolder($extensionKey, $prefix = 'EXT:') {
    $extensionKey    = (string) $extensionKey;
    $prefix          = (string) $prefix;
    $resourcesFolder = self::resourcesFolder($extensionKey, $prefix);

    return "${resourcesFolder}/Public";
  }

  /**
   * Gets the icons folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The icons folder
   */
  public static function iconsFolder($extensionKey, $prefix = 'EXT:') {
    $extensionKey = (string) $extensionKey;
    $prefix       = (string) $prefix;
    $publicFolder = self::publicFolder($extensionKey, $prefix);

    return "${publicFolder}/Icons";
  }
}