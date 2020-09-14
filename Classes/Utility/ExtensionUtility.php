<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * The extension utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class ExtensionUtility extends AbstractUtility
{
    /**
     * Gets an identifier from an extension key.
     *
     * @param string $extensionKey The extension key
     * @return string The identifier
     */
    public static function identifier(string $extensionKey): string
    {
        $identifier = GeneralUtility::underscoredToUpperCamelCase($extensionKey);
        $identifier = mb_strtolower($identifier);

        return $identifier;
    }

    /**
     * Gets an identifier from an extension key.
     *
     * @param string $extensionKey The extension key
     * @return string The identifier
     * @deprecated Use `identifier` instead
     */
    public static function extensionIdentifier(string $extensionKey): string
    {
        return self::identifier($extensionKey);
    }

    /**
     * Gets a signature from a namespace and extension key.
     *
     * @param string $namespace The namespace
     * @param string $extensionKey The extension key
     * @param string $separator The optional separator, defaults to `.`
     * @return string The signature
     */
    public static function signature(string $namespace, string $extensionKey, string $separator = '.'): string
    {
        $namespace = GeneralUtility::underscoredToUpperCamelCase($namespace);
        $extensionKey = GeneralUtility::underscoredToUpperCamelCase($extensionKey);

        return "${namespace}${separator}${extensionKey}";
    }

    /**
     * Gets a signature from a namespace and extension key.
     *
     * @param string $namespace The namespace
     * @param string $extensionKey The extension key
     * @param string $separator The optional separator, defaults to `.`
     * @return string The signature
     * @deprecated Use `signature` instead
     */
    public static function extensionSignature(string $namespace, string $extensionKey, string $separator = '.'): string
    {
        return self::signature($namespace, $extensionKey, $separator);
    }

    /**
     * Gets the locallang file from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $fileName The optional file name of the locallang file, defaults to `locallang.xlf`
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @param string $separator The optional separator, defaults to `:`
     * @return string The locallang file
     */
    public static function locallang(
        string $extensionKey,
        string $fileName = 'locallang.xlf',
        string $prefix = 'LLL:EXT:',
        string $separator = ':'
    ): string {
        $languageFolder = self::languageFolder($extensionKey, $prefix);

        return "${languageFolder}/${fileName}${separator}";
    }

    /**
     * Alias for the `locallang` function.
     *
     * @param string $extensionKey The extension key
     * @param string $fileName The optional file name of the locallang file, defaults to `locallang.xlf`
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @param string $separator The optional separator, defaults to `:`
     * @return string The locallang file
     */
    public static function lll(
        string $extensionKey,
        string $fileName = 'locallang.xlf',
        string $prefix = 'LLL:EXT:',
        string $separator = ':'
    ): string {
        return self::locallang($extensionKey, $fileName, $prefix, $separator);
    }

    /**
     * Gets the configuration folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The configuration folder
     */
    public static function configurationFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        return "${prefix}${extensionKey}/Configuration";
    }

    /**
     * Gets the FlexForms folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The FlexForms folder
     */
    public static function flexFormsFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        $configurationFolder = self::configurationFolder($extensionKey, $prefix);

        return "${configurationFolder}/FlexForms";
    }

    /**
     * Gets the TSconfig folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The TSconfig folder
     */
    public static function tsConfigFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        $configurationFolder = self::configurationFolder($extensionKey, $prefix);

        return "${configurationFolder}/TSconfig";
    }

    /**
     * Gets the resources folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The resources folder
     */
    public static function resourcesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return "${prefix}${extensionKey}/Resources";
    }

    /**
     * Gets the private folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The private folder
     */
    public static function privateFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
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
    public static function languageFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $privateFolder = self::privateFolder($extensionKey, $prefix);

        return "${privateFolder}/Language";
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
    public static function locallangFolder(string $extensionKey, string $prefix = 'LLL:EXT:'): string
    {
        return self::languageFolder($extensionKey, $prefix);
    }

    /**
     * Alias for the `locallangFolder` function.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @return string The locallang folder
     */
    public static function lllFolder(string $extensionKey, string $prefix = 'LLL:EXT:'): string
    {
        return self::locallangFolder($extensionKey, $prefix);
    }

    /**
     * Gets the public folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The public folder
     */
    public static function publicFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $resourcesFolder = self::resourcesFolder($extensionKey, $prefix);

        return "${resourcesFolder}/Public";
    }

    /**
     * Gets the assets folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The assets folder
     */
    public static function assetsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::publicFolder($extensionKey, $prefix);

        return "${publicFolder}/Assets";
    }

    /**
     * Gets the icons folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The icons folder
     */
    public static function iconsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::publicFolder($extensionKey, $prefix);

        return "${publicFolder}/Icons";
    }

    /**
     * Gets the placeholders folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The placeholders folder
     */
    public static function placeholdersFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::publicFolder($extensionKey, $prefix);

        return "${publicFolder}/Placeholders";
    }

    /**
     * Gets the samples folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The samples folder
     */
    public static function samplesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::publicFolder($extensionKey, $prefix);

        return "${publicFolder}/Samples";
    }

    /**
     * Gets settings by extension name.
     * *
     * @param string $extensionName The extension name
     * @return array|null The settings
     */
    public static function getSettingsByExtensionName($extensionName): array
    {
        $identifier = GeneralUtility::underscoredToUpperCamelCase($extensionName);
        $identifier = mb_strtolower($identifier);

        return (array)self::getTypoScriptByPath('plugin.tx_' . $identifier . '.settings');
    }

    /**
     * Gets TypoScript by a path.
     *
     * @param string $path The path
     * @param ConfigurationManagerInterface $configurationManager The configuration manager
     * @return array|mixed|null The TypoScript
     */
    public static function getTypoScriptByPath($path, $configurationManager = null)
    {
        static $cache = [];

        if (isset($cache[$path])) {
            return $cache[$path];
        }

        if ($configurationManager === null) {
            $configurationManager = self::getConfigurationManager();
        }

        $all = (array)$configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
        );

        $value = &$all;
        $segments = explode('.', $path);

        foreach ($segments as $segment) {
            $value = ($value[$segment . '.'] ?? $value[$segment] ?? null);

            if ($value === null) {
                break;
            }
        }

        $result = $value;

        if (is_array($value)) {
            $result = GeneralUtility::removeDotsFromTS($value);
        }

        $cache[$path] = $result;

        return $result;
    }
}
