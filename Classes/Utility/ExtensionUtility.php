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
  public static function extensionIdentifier(string $extensionKey): string {
    $extensionIdentifier = GeneralUtility::underscoredToUpperCamelCase($extensionKey);
    $extensionIdentifier = mb_strtolower($extensionIdentifier);

    return $extensionIdentifier;
  }

  /**
   * Alias for the `extensionIdentifier` function.
   *
   * @param string $extensionKey The extension key
   * @return string The extension identifier
   */
  public static function getExtensionIdentifier(string $extensionKey): string {
    return self::extensionIdentifier($extensionKey);
  }

  /**
   * Gets an extension signature from a namespace and extension key.
   *
   * @param string $namespace The namespace
   * @param string $extensionKey The extension key
   * @param string $separator The optional separator, defaults to `.`
   * @return string The extension signature
   */
  public static function extensionSignature(string $namespace, string $extensionKey, string $separator = '.'): string {
    $namespace    = GeneralUtility::underscoredToUpperCamelCase($namespace);
    $extensionKey = GeneralUtility::underscoredToUpperCamelCase($extensionKey);

    return "${namespace}${separator}${extensionKey}";
  }

  /**
   * Alias for the `extensionSignature` function.
   *
   * @param string $namespace The namespace
   * @param string $extensionKey The extension key
   * @param string $separator The optional separator, defaults to `.`
   * @return string The extension signature
   */
  public static function getExtensionSignature(string $namespace, string $extensionKey, string $separator = '.'): string {
    return self::extensionSignature($namespace, $extensionKey, $separator);
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
  public static function locallang(string $extensionKey, string $fileName = 'locallang.xlf', string $prefix = 'LLL:EXT:', string $separator = ':'): string {
    $languageFolder = self::languageFolder($extensionKey, $prefix);

    return "${languageFolder}/${fileName}${separator}";
  }

  /**
   * Alias for the `locallang` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional file name of the locallang file, defaults to `locallang.xlf`
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @param string $separator The optional separator, defaults to `:`
   * @return string The locallang file
   */
  public static function getLocallang(string $extensionKey, string $fileName = 'locallang.xlf', string $prefix = 'LLL:EXT:', string $separator = ':'): string {
    return self::locallang($extensionKey, $fileName, $prefix, $separator);
  }

  /**
   * Alias for the `locallang` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional file name of the locallang file, defaults to `locallang.xlf`
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @param string $separator The optional separator, defaults to `:`
   * @return string The locallang file
   */
  public static function lll(string $extensionKey, string $fileName = 'locallang.xlf', string $prefix = 'LLL:EXT:', string $separator = ':'): string {
    return self::locallang($extensionKey, $fileName, $prefix, $separator);
  }

  /**
   * Gets the configuration folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
   * @return string The configuration folder
   */
  public static function configurationFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string {
    return "${prefix}${extensionKey}/Configuration";
  }

  /**
   * Alias for the `configurationFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
   * @return string The configuration folder
   */
  public static function getConfigurationFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string {
    return self::configurationFolder($extensionKey, $prefix);
  }

  /**
   * Gets the FlexForms folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
   * @return string The FlexForms folder
   */
  public static function flexFormsFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string {
    $configurationFolder = self::configurationFolder($extensionKey, $prefix);

    return "${configurationFolder}/FlexForms";
  }

  /**
   * Alias for the `flexFormsFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
   * @return string The FlexForms folder
   */
  public static function getFlexFormsFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string {
    return self::flexFormsFolder($extensionKey, $prefix);
  }

  /**
   * Gets the resources folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The resources folder
   */
  public static function resourcesFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return "${prefix}${extensionKey}/Resources";
  }

  /**
   * Alias for the `resourcesFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The resources folder
   */
  public static function getResourcesFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return self::resourcesFolder($extensionKey, $prefix);
  }

  /**
   * Gets the private folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The private folder
   */
  public static function privateFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    $resourcesFolder = self::resourcesFolder($extensionKey, $prefix);

    return "${resourcesFolder}/Private";
  }

  /**
   * Alias for the `privateFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The private folder
   */
  public static function getPrivateFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return self::privateFolder($extensionKey, $prefix);
  }

  /**
   * Gets the language folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The language folder
   */
  public static function languageFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    $privateFolder = self::privateFolder($extensionKey, $prefix);

    return "${privateFolder}/Language";
  }

  /**
   * Alias for the `languageFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The language folder
   */
  public static function getLanguageFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return self::languageFolder($extensionKey, $prefix);
  }

  /**
   * Gets the locallang folder from an extension key.
   *
   * Alias for the `languageFolder` function with `LLL:EXT:` as prefix.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @return string The locallang folder
   */
  public static function locallangFolder(string $extensionKey, string $prefix = 'LLL:EXT:'): string {
    return self::languageFolder($extensionKey, $prefix);
  }

  /**
   * Alias for the `locallangFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @return string The locallang folder
   */
  public static function getLocallangFolder(string $extensionKey, string $prefix = 'LLL:EXT:'): string {
    return self::locallangFolder($extensionKey, $prefix);
  }

  /**
   * Alias for the `locallangFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
   * @return string The locallang folder
   */
  public static function lllFolder(string $extensionKey, string $prefix = 'LLL:EXT:'): string {
    return self::locallangFolder($extensionKey, $prefix);
  }

  /**
   * Gets the public folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The public folder
   */
  public static function publicFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    $resourcesFolder = self::resourcesFolder($extensionKey, $prefix);

    return "${resourcesFolder}/Public";
  }

  /**
   * Alias for the `publicFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The public folder
   */
  public static function getPublicFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return self::publicFolder($extensionKey, $prefix);
  }

  /**
   * Gets the assets folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The assets folder
   */
  public static function assetsFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    $publicFolder = self::publicFolder($extensionKey, $prefix);

    return "${publicFolder}/Assets";
  }

  /**
   * Alias for the `assetsFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The assets folder
   */
  public static function getAssetsFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return self::assetsFolder($extensionKey, $prefix);
  }

  /**
   * Gets the icons folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The icons folder
   */
  public static function iconsFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    $publicFolder = self::publicFolder($extensionKey, $prefix);

    return "${publicFolder}/Icons";
  }

  /**
   * Alias for the `iconsFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The icons folder
   */
  public static function getIconsFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return self::iconsFolder($extensionKey, $prefix);
  }

  /**
   * Gets the placeholders folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The placeholders folder
   */
  public static function placeholdersFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    $publicFolder = self::publicFolder($extensionKey, $prefix);

    return "${publicFolder}/Placeholders";
  }

  /**
   * Alias for the `placeholdersFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The placeholders folder
   */
  public static function getPlaceholdersFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return self::placeholdersFolder($extensionKey, $prefix);
  }

  /**
   * Gets the samples folder from an extension key.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The samples folder
   */
  public static function samplesFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    $publicFolder = self::publicFolder($extensionKey, $prefix);

    return "${publicFolder}/Samples";
  }

  /**
   * Alias for the `samplesFolder` function.
   *
   * @param string $extensionKey The extension key
   * @param string $prefix The optional prefix, defaults to `EXT:`
   * @return string The samples folder
   */
  public static function getSamplesFolder(string $extensionKey, string $prefix = 'EXT:'): string {
    return self::samplesFolder($extensionKey, $prefix);
  }
}
