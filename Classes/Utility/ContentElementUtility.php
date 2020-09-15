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
    public static function identifier(string $contentElementKey): string
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
     * Gets an identifier from an content element key.
     *
     * @param string $contentElementKey The content element key
     * @return string The content element identifier
     * @deprecated Use `identifier` instead
     */
    public static function contentElementIdentifier(string $contentElementKey): string
    {
        return self::identifier($contentElementKey);
    }

    /**
     * Gets a signature from an extension and content element identifier.
     *
     * @param string $extensionIdentifier The extension identifier
     * @param string $contentElementIdentifier The content element identifier
     * @return string The content element signature
     */
    public static function signature(string $extensionIdentifier, string $contentElementIdentifier): string
    {
        $contentElementSignature = mb_strtolower($extensionIdentifier . '_' . $contentElementIdentifier);

        return $contentElementSignature;
    }

    /**
     * Gets a signature from an extension and content element identifier.
     *
     * @param string $extensionIdentifier The extension identifier
     * @param string $contentElementIdentifier The content element identifier
     * @return string The content element signature
     * @deprecated Use `signature` instead
     */
    public static function contentElementSignature(string $extensionIdentifier, string $contentElementIdentifier): string
    {
        return self::signature($extensionIdentifier, $contentElementIdentifier);
    }
}