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
}
