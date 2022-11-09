<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\Exception;

/**
 * The extension utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class ExtensionUtility extends AbstractUtility
{
    /**
     * Gets a signature from an extension key.
     *
     * @param string $extensionKey The extension key
     * @return string The extension signature
     */
    public static function getSignature(string $extensionKey): string
    {
        $signature = GeneralUtility::underscoredToUpperCamelCase($extensionKey);

        return mb_strtolower($signature);
    }

    /**
     * Gets an identifier from a namespace and extension key.
     *
     * @param string $namespace The namespace
     * @param string $extensionKey The extension key
     * @param string $separator The optional separator, defaults to `.`
     * @return string The extension identifier
     */
    public static function getIdentifier(string $namespace, string $extensionKey, string $separator = '.'): string
    {
        $namespace = GeneralUtility::underscoredToUpperCamelCase($namespace);
        $extensionKey = GeneralUtility::underscoredToUpperCamelCase($extensionKey);

        return $namespace . $separator . $extensionKey;
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
        $languageFolder = self::getLanguageFolder($extensionKey, $prefix);

        return $languageFolder . '/' . $fileName . $separator;
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
        return $prefix . $extensionKey . '/Configuration';
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

        return $configurationFolder . '/FlexForms';
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

        return $configurationFolder . '/TCA';
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

        return $configurationFolder . '/TSconfig';
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

        return $configurationFolder . '/TypoScript';
    }

    /**
     * Gets the resources' folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension resources folder
     */
    public static function getResourcesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        return $prefix . $extensionKey . '/Resources';
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

        return $resourcesFolder . '/Private';
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

        return $privateFolder . '/Language';
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
     * Gets the layouts' folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension layouts folder
     */
    public static function getLayoutsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $privateFolder = self::getPrivateFolder($extensionKey, $prefix);

        return $privateFolder . '/Layouts';
    }

    /**
     * Gets the partials' folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension partials folder
     */
    public static function getPartialsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $privateFolder = self::getPrivateFolder($extensionKey, $prefix);

        return $privateFolder . '/Partials';
    }

    /**
     * Gets the templates' folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension templates folder
     */
    public static function getTemplatesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $privateFolder = self::getPrivateFolder($extensionKey, $prefix);

        return $privateFolder . '/Templates';
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

        return $resourcesFolder . '/Public';
    }

    /**
     * Gets the assets' folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension assets folder
     */
    public static function getAssetsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::getPublicFolder($extensionKey, $prefix);

        return $publicFolder . '/Assets';
    }

    /**
     * Gets the icons' folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension icons folder
     */
    public static function getIconsFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::getPublicFolder($extensionKey, $prefix);

        return $publicFolder . '/Icons';
    }

    /**
     * Gets the placeholders' folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension placeholders folder
     */
    public static function getPlaceholdersFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::getPublicFolder($extensionKey, $prefix);

        return $publicFolder . '/Placeholders';
    }

    /**
     * Gets the samples' folder from an extension key.
     *
     * @param string $extensionKey The extension key
     * @param string $prefix The optional prefix, defaults to `EXT:`
     * @return string The extension samples folder
     */
    public static function getSamplesFolder(string $extensionKey, string $prefix = 'EXT:'): string
    {
        $publicFolder = self::getPublicFolder($extensionKey, $prefix);

        return $publicFolder . '/Samples';
    }

    /**
     * Gets settings by extension name.
     *
     * @param string $extensionName The extension name
     * @return array|null The settings
     * @throws Exception
     */
    public static function getSettingsByExtensionName(string $extensionName): array
    {
        $identifier = GeneralUtility::underscoredToUpperCamelCase($extensionName);
        $identifier = mb_strtolower($identifier);

        return (array)self::getTypoScriptByPath('plugin.tx_' . $identifier . '.settings');
    }

    /**
     * Gets TypoScript by a path.
     *
     * @param string $path The path
     * @param ConfigurationManagerInterface|null $configurationManager The configuration manager
     * @return array|mixed|null The TypoScript
     * @throws Exception
     */
    public static function getTypoScriptByPath(string $path, ConfigurationManagerInterface $configurationManager = null)
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

        return $result;
    }
}
