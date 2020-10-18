<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

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
     * @return string The extension identifier
     */
    public static function getIdentifier(string $extensionKey): string
    {
        $identifier = GeneralUtility::underscoredToUpperCamelCase($extensionKey);
        $identifier = mb_strtolower($identifier);

        return $identifier;
    }

    /**
     * Gets an identifier from an extension key.
     *
     * @param string $extensionKey The extension key
     * @return string The extension identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function identifier(string $extensionKey): string
    {
        return self::getIdentifier($extensionKey);
    }

    /**
     * Gets an identifier from an extension key.
     *
     * @param string $extensionKey The extension key
     * @return string The extension identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function extensionIdentifier(string $extensionKey): string
    {
        return self::getIdentifier($extensionKey);
    }

    /**
     * Gets a signature from a namespace and extension key.
     *
     * @param string $namespace The namespace
     * @param string $extensionKey The extension key
     * @param string $separator The optional separator, defaults to `.`
     * @return string The extension signature
     */
    public static function getSignature(string $namespace, string $extensionKey, string $separator = '.'): string
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
     * @return string The extension signature
     * @deprecated Use the `getSignature` function instead
     */
    public static function signature(string $namespace, string $extensionKey, string $separator = '.'): string
    {
        return self::getSignature($namespace, $extensionKey, $separator);
    }

    /**
     * Gets a signature from a namespace and extension key.
     *
     * @param string $namespace The namespace
     * @param string $extensionKey The extension key
     * @param string $separator The optional separator, defaults to `.`
     * @return string The extension signature
     * @deprecated Use the `getSignature` function instead
     */
    public static function extensionSignature(string $namespace, string $extensionKey, string $separator = '.'): string
    {
        return self::getSignature($namespace, $extensionKey, $separator);
    }

    /**
     * Gets a locallang file from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $fileName The optional file name of the locallang file, defaults to `locallang.xlf`
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @param string $separator The optional separator, defaults to `:`
     * @return string The extension locallang file
     */
    public static function getLocallang(
        string $extensionKey,
        string $fileName = 'locallang.xlf',
        string $prefix = 'LLL:EXT:',
        string $separator = ':'
    ): string {
        $languageFolder = self::languageFolder($extensionKey, $prefix);

        return "${languageFolder}/${fileName}${separator}";
    }

    /**
     * Gets a locallang file from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $fileName The optional file name of the locallang file, defaults to `locallang.xlf`
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @param string $separator The optional separator, defaults to `:`
     * @return string The extension locallang file
     * @deprecated Use the `getLocallang` function instead
     */
    public static function locallang(
        string $extensionKey,
        string $fileName = 'locallang.xlf',
        string $prefix = 'LLL:EXT:',
        string $separator = ':'
    ): string {
        return self::getLocallang($extensionKey, $fileName, $prefix, $separator);
    }

    /**
     * Gets a locallang file from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $fileName The optional file name of the locallang file, defaults to `locallang.xlf`
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @param string $separator The optional separator, defaults to `:`
     * @return string The extension locallang file
     * @deprecated Use the `getLocallang` function instead
     */
    public static function lll(
        string $extensionKey,
        string $fileName = 'locallang.xlf',
        string $prefix = 'LLL:EXT:',
        string $separator = ':'
    ): string {
        return self::getLocallang($extensionKey, $fileName, $prefix, $separator);
    }

    /**
     * Gets the configuration folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension configuration folder
     */
    public static function getConfigurationFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        return "${prefix}${extensionKey}/Configuration";
    }

    /**
     * Gets the configuration folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension configuration folder
     * @deprecated Use the `getConfigurationFolder` function instead
     */
    public static function configurationFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        return self::getConfigurationFolder($extensionKey, $prefix);
    }

    /**
     * Gets the FlexForms folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension FlexForms folder
     */
    public static function getFlexFormsFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        $configurationFolder = self::getConfigurationFolder($extensionKey, $prefix);

        return "${configurationFolder}/FlexForms";
    }

    /**
     * Gets the FlexForms folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension FlexForms folder
     * @deprecated Use the `getFlexFormsFolder` function instead
     */
    public static function flexFormsFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        return self::getFlexFormsFolder($extensionKey, $prefix);
    }

    /**
     * Gets the TCA folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension TCA folder
     */
    public static function getTCAFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        $configurationFolder = self::getConfigurationFolder($extensionKey, $prefix);

        return "${configurationFolder}/TCA";
    }

    /**
     * Gets the TCA folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension TCA folder
     * @deprecated Use the `getTCAFolder` function instead
     */
    public static function tcaFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        return self::getTCAFolder($extensionKey, $prefix);
    }

    /**
     * Gets the TSconfig folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension TSconfig folder
     */
    public static function getTSConfigFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        $configurationFolder = self::getConfigurationFolder($extensionKey, $prefix);

        return "${configurationFolder}/TSconfig";
    }

    /**
     * Gets the TSconfig folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension TSconfig folder
     * @deprecated Use the `getTSConfigFolder` function instead
     */
    public static function tsConfigFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        return self::getTSConfigFolder($extensionKey, $prefix);
    }

    /**
     * Gets the TypoScript folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension TypoScript folder
     */
    public static function getTypoScriptFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        $configurationFolder = self::getConfigurationFolder($extensionKey, $prefix);

        return "${configurationFolder}/TypoScript";
    }

    /**
     * Gets the TypoScript folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `FILE:EXT:`
     * @return string The extension TypoScript folder
     * @deprecated Use the `getTypoScriptFolder` function instead
     */
    public static function typoscriptFolder(string $extensionKey, string $prefix = 'FILE:EXT:'): string
    {
        return self::getTypoScriptFolder($extensionKey, $prefix);
    }

    /**
     * Gets the resources folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension resources folder
     */
    public static function getResourcesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return "${prefix}${extensionKey}/Resources";
    }

    /**
     * Gets the resources folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension resources folder
     * @deprecated Use the `getResourcesFolder` function instead
     */
    public static function resourcesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getResourcesFolder($extensionKey, $prefix);
    }

    /**
     * Gets the private folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension private folder
     */
    public static function getPrivateFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $resourcesFolder = self::getResourcesFolder($extensionKey, $prefix);

        return "${resourcesFolder}/Private";
    }

    /**
     * Gets the private folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension private folder
     * @deprecated Use the `getPrivateFolder` function instead
     */
    public static function privateFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getPrivateFolder($extensionKey, $prefix);
    }

    /**
     * Gets the language folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension language folder
     */
    public static function getLanguageFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $privateFolder = self::getPrivateFolder($extensionKey, $prefix);

        return "${privateFolder}/Language";
    }

    /**
     * Gets the language folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension language folder
     * @deprecated Use the `getLanguageFolder` function instead
     */
    public static function languageFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getLanguageFolder($extensionKey, $prefix);
    }

    /**
     * Gets the locallang folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @return string The extension locallang folder
     */
    public static function getLocallangFolder(string $extensionKey, string $prefix = 'LLL:EXT:'): string
    {
        return self::getLanguageFolder($extensionKey, $prefix);
    }

    /**
     * Gets the locallang folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @return string The extension locallang folder
     * @deprecated Use the `getLocallangFolder` function instead
     */
    public static function locallangFolder(string $extensionKey, string $prefix = 'LLL:EXT:'): string
    {
        return self::getLocallangFolder($extensionKey, $prefix);
    }

    /**
     * Gets the locallang folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `LLL:EXT:`
     * @return string The extension locallang folder
     * @deprecated Use the `getLocallangFolder` function instead
     */
    public static function lllFolder(string $extensionKey, string $prefix = 'LLL:EXT:'): string
    {
        return self::getLocallangFolder($extensionKey, $prefix);
    }

    /**
     * Gets the layouts folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension layouts folder
     */
    public static function getLayoutsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $privateFolder = self::getPrivateFolder($extensionKey, $prefix);

        return "${privateFolder}/Layouts";
    }

    /**
     * Gets the layouts folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension layouts folder
     * @deprecated Use the `getLayoutsFolder` function instead
     */
    public static function layoutsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getLayoutsFolder($extensionKey, $prefix);
    }

    /**
     * Gets the partials folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension partials folder
     */
    public static function getPartialsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $privateFolder = self::getPrivateFolder($extensionKey, $prefix);

        return "${privateFolder}/Partials";
    }

    /**
     * Gets the partials folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension partials folder
     * @deprecated Use the `getPartialsFolder` function instead
     */
    public static function partialsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getPartialsFolder($extensionKey, $prefix);
    }

    /**
     * Gets the templates folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension templates folder
     */
    public static function getTemplatesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $privateFolder = self::getPrivateFolder($extensionKey, $prefix);

        return "${privateFolder}/Templates";
    }

    /**
     * Gets the templates folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension templates folder
     * @deprecated Use the `getTemplatesFolder` function instead
     */
    public static function templatesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getTemplatesFolder($extensionKey, $prefix);
    }

    /**
     * Gets the public folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension public folder
     */
    public static function getPublicFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $resourcesFolder = self::getResourcesFolder($extensionKey, $prefix);

        return "${resourcesFolder}/Public";
    }

    /**
     * Gets the public folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension public folder
     * @deprecated Use the `getPublicFolder` function instead
     */
    public static function publicFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getPublicFolder($extensionKey, $prefix);
    }

    /**
     * Gets the assets folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension assets folder
     */
    public static function getAssetsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::getPublicFolder($extensionKey, $prefix);

        return "${publicFolder}/Assets";
    }

    /**
     * Gets the assets folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension assets folder
     * @deprecated Use the `getAssetsFolder` function instead
     */
    public static function assetsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getAssetsFolder($extensionKey, $prefix);
    }

    /**
     * Gets the icons folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension icons folder
     */
    public static function getIconsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::getPublicFolder($extensionKey, $prefix);

        return "${publicFolder}/Icons";
    }

    /**
     * Gets the icons folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension icons folder
     * @deprecated Use the `getIconsFolder` function instead
     */
    public static function iconsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getIconsFolder($extensionKey, $prefix);
    }

    /**
     * Gets the placeholders folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension placeholders folder
     */
    public static function getPlaceholdersFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::getPublicFolder($extensionKey, $prefix);

        return "${publicFolder}/Placeholders";
    }

    /**
     * Gets the placeholders folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension placeholders folder
     * @deprecated Use the `getPlaceholdersFolder` function instead
     */
    public static function placeholdersFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getPlaceholdersFolder($extensionKey, $prefix);
    }

    /**
     * Gets the samples folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension samples folder
     */
    public static function getSamplesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::getPublicFolder($extensionKey, $prefix);

        return "${publicFolder}/Samples";
    }

    /**
     * Gets the samples folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension samples folder
     * @deprecated Use the `getSamplesFolder` function instead
     */
    public static function samplesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return self::getSamplesFolder($extensionKey, $prefix);
    }

    /**
     * Gets settings by extension name.
     *
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
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface|null $configurationManager The configuration manager
     * @return array|mixed|null The TypoScript
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    public static function getTypoScriptByPath(string $path, $configurationManager = null)
    {
        static $cache = [];

        if (isset($cache[$path])) {
            return $cache[$path];
        }

        if ($configurationManager === null) {
            $configurationManager = self::getConfigurationManager();
        }

        $all = $configurationManager->getConfiguration(
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
