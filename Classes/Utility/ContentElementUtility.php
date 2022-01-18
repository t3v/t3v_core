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
     * Gets an identifier from an content element key.
     *
     * @param string $contentElementKey The content element key
     * @return string The content element identifier
     */
    public static function getIdentifier(string $contentElementKey): string
    {
        $contentElementIdentifier = $contentElementKey;

        if (strpos($contentElementIdentifier, '_') ||
            strpos($contentElementIdentifier, '-') ||
            strpos($contentElementIdentifier, ' ')) {
            $contentElementIdentifier = mb_strtolower($contentElementKey);
            $contentElementIdentifier = str_replace(array('_', '-'), ' ', $contentElementIdentifier);
            $contentElementIdentifier = str_replace(' ', '', ucwords($contentElementIdentifier));
        }

        if ($contentElementIdentifier[0]) {
            $contentElementIdentifier[0] = mb_strtoUpper($contentElementIdentifier[0]);
        }

        return $contentElementIdentifier;
    }

    /**
     * Gets an identifier from a content element key.
     *
     * @param string $contentElementKey The content element key
     * @return string The content element identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function identifier(string $contentElementKey): string
    {
        return self::getIdentifier($contentElementKey);
    }

    /**
     * Gets an identifier from a content element key.
     *
     * @param string $contentElementKey The content element key
     * @return string The content element identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function contentElementIdentifier(string $contentElementKey): string
    {
        return self::getIdentifier($contentElementKey);
    }

    /**
     * Gets a signature from an extension and content element identifier.
     *
     * @param string $extensionIdentifier The extension identifier
     * @param string $contentElementIdentifier The content element identifier
     * @return string The content element signature
     */
    public static function getSignature(string $extensionIdentifier, string $contentElementIdentifier): string
    {
        return mb_strtolower($extensionIdentifier . '_' . $contentElementIdentifier);
    }

    /**
     * Gets a signature from an extension and content element identifier.
     *
     * @param string $extensionIdentifier The extension identifier
     * @param string $contentElementIdentifier The content element identifier
     * @return string The content element signature
     * @deprecated Use the `getSignature` function instead
     */
    public static function signature(string $extensionIdentifier, string $contentElementIdentifier): string
    {
        return self::getSignature($extensionIdentifier, $contentElementIdentifier);
    }

    /**
     * Gets a signature from an extension and content element identifier.
     *
     * @param string $extensionIdentifier The extension identifier
     * @param string $contentElementIdentifier The content element identifier
     * @return string The content element signature
     * @deprecated Use the `getSignature` function instead
     */
    public static function contentElementSignature(string $extensionIdentifier, string $contentElementIdentifier): string
    {
        return self::getSignature($extensionIdentifier, $contentElementIdentifier);
    }
}
