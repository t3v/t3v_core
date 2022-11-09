<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

/**
 * The content element utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class ContentElementUtility extends AbstractUtility
{
    /**
     * Gets a signature from a content element name.
     *
     * @param string $contentElementName The content element name
     * @return string The content element signature
     */
    public static function getSignature(string $contentElementName): string
    {
        return GeneralUtility::getSignature($contentElementName);
    }

    /**
     * Gets a signature from a content element name.
     *
     * Alias for the `getSignature` function.
     *
     * @param string $contentElementName The content element name
     * @return string The content element signature
     * @deprecated Use the `getSignature` function instead
     */
    public static function signature(string $contentElementName): string
    {
        return self::getSignature($contentElementName);
    }

    /**
     * Gets a content element signature from a content element name.
     *
     * Alias for the `getSignature` function.
     *
     * @param string $contentElementName The content element name
     * @return string The content element signature
     * @deprecated Use the `getSignature` function instead
     */
    public static function contentElementSignature(string $contentElementName): string
    {
        return self::getSignature($contentElementName);
    }

    /**
     * Gets an identifier from an extension and content element name.
     *
     * @param string $extensionName The extension name
     * @param string $contentElementName The content element name
     * @return string The content element identifier
     */
    public static function getIdentifier(string $extensionName, string $contentElementName): string
    {
        $extensionSignature = GeneralUtility::getSignature($extensionName);
        $contentElementSignature = GeneralUtility::getSignature($contentElementName);

        return mb_strtolower($extensionSignature . '_' . $contentElementSignature);
    }

    /**
     * Gets an identifier from an extension and content element name.
     *
     * Alias for the `getIdentifier` function.
     *
     * @param string $extensionName The extension name
     * @param string $contentElementName The content element name
     * @return string The content element identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function identifier(string $extensionName, string $contentElementName): string
    {
        return self::getIdentifier($extensionName, $contentElementName);
    }

    /**
     * Gets a content element identifier from an extension and content element name.
     *
     * Alias for the `getIdentifier` function.
     *
     * @param string $extensionName The extension name
     * @param string $contentElementName The content element name
     * @return string The content element identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function contentElementIdentifier(string $extensionName, string $contentElementName): string
    {
        return self::getIdentifier($extensionName, $contentElementName);
    }
}
