<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

/**
 * The content object utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class ContentObjectUtility extends AbstractUtility
{
    /**
     * Gets a signature from a content object name.
     *
     * @param string $contentObjectName The content object name
     * @return string The content object signature
     */
    public static function getSignature(string $contentObjectName): string
    {
        return GeneralUtility::getSignature($contentObjectName);
    }

    /**
     * Gets a signature from a content object name.
     *
     * Alias for the `getSignature` function.
     *
     * @param string $contentObjectName The content object name
     * @return string The content object signature
     * @deprecated Use the `getSignature` function instead
     */
    public static function signature(string $contentObjectName): string
    {
        return self::getSignature($contentObjectName);
    }

    /**
     * Gets a content object signature from a content object name.
     *
     * Alias for the `getSignature` function.
     *
     * @param string $contentObjectName The content object name
     * @return string The content object signature
     * @deprecated Use the `getSignature` function instead
     */
    public static function contentObjectSignature(string $contentObjectName): string
    {
        return self::getSignature($contentObjectName);
    }

    /**
     * Gets an identifier from an extension and content object name.
     *
     * @param string $extensionName The extension name
     * @param string $contentObjectName The content object name
     * @return string The content object identifier
     */
    public static function getIdentifier(string $extensionName, string $contentObjectName): string
    {
        $extensionSignature = GeneralUtility::getSignature($extensionName);
        $contentElementSignature = GeneralUtility::getSignature($contentObjectName);

        return mb_strtolower($extensionSignature . '_' . $contentElementSignature);
    }

    /**
     * Gets an identifier from an extension and content object name.
     *
     * Alias for the `getIdentifier` function.
     *
     * @param string $extensionName The extension name
     * @param string $contentObjectName The content object name
     * @return string The content object identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function identifier(string $extensionName, string $contentObjectName): string
    {
        return self::getIdentifier($extensionName, $contentObjectName);
    }

    /**
     * Gets a content object identifier from an extension and content object name.
     *
     * Alias for the `getIdentifier` function.
     *
     * @param string $extensionName The extension name
     * @param string $contentObjectName The content object name
     * @return string The content object identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function contentObjectIdentifier(string $extensionName, string $contentObjectName): string
    {
        return self::getIdentifier($extensionName, $contentObjectName);
    }
}
