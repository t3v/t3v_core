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
   * Gets an extension identifier from an extension key.
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
   * Gets an extension signature from a namespace and extension key.
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
   * Gets a locallang file from an extension key.
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
   * Gets a configuration folder from an extension key.
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
   * Gets a FlexForms folder from an extension key.
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
   * Gets a resources folder from an extension key.
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
   * Gets a private folder from an extension key.
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
   * Gets a language folder from an extension key.
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
   * Gets a locallang folder from an extension key.
   *
   * Alias for `languageFolder` with `LLL:EXT:` as prefix.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @return string The locallang folder
   */
  public static function locallangFolder($extensionKey, $prefix = 'LLL:EXT:') {
    $extensionKey  = (string) $extensionKey;
    $prefix        = (string) $prefix;

    return self::languageFolder($extensionKey, $prefix);
  }

  /**
   * Alias for `locallangFolder`.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @return string The locallang folder
   */
  public static function lllFolder($extensionKey, $prefix = 'LLL:EXT:') {
    $extensionKey  = (string) $extensionKey;
    $prefix        = (string) $prefix;

    return self::locallangFolder($extensionKey, $prefix);
  }

  /**
   * Gets a public folder from an extension key.
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
   * Gets an assets folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The assets folder
   */
  public static function assetsFolder($extensionKey, $prefix = 'EXT:') {
    $extensionKey = (string) $extensionKey;
    $prefix       = (string) $prefix;
    $publicFolder = self::publicFolder($extensionKey, $prefix);

    return "${publicFolder}/Assets";
  }

  /**
   * Gets an icons folder from an extension key.
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

  /**
   * Gets a placeholders folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The placeholders folder
   */
  public static function placeholdersFolder($extensionKey, $prefix = 'EXT:') {
    $extensionKey = (string) $extensionKey;
    $prefix       = (string) $prefix;
    $publicFolder = self::publicFolder($extensionKey, $prefix);

    return "${publicFolder}/Placeholders";
  }

  /**
   * Gets a samples folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The samples folder
   */
  public static function samplesFolder($extensionKey, $prefix = 'EXT:') {
    $extensionKey = (string) $extensionKey;
    $prefix       = (string) $prefix;
    $publicFolder = self::publicFolder($extensionKey, $prefix);

    return "${publicFolder}/Samples";
  }
}