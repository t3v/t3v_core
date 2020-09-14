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
     * Gets an identifier from an content object key.
     *
     * @param string $contentObjectKey The content object key
     * @return string The content object identifier
     */
    public static function identifier(string $contentObjectKey): string
    {
        $contentObjectIdentifier = $contentObjectKey;

        if (strpos($contentObjectIdentifier, '_') ||
            strpos($contentObjectIdentifier, '-') ||
            strpos($contentObjectIdentifier, ' ')) {
            $contentObjectIdentifier = mb_strtolower($contentObjectKey);
            $contentObjectIdentifier = str_replace(array('_', '-'), ' ', $contentObjectIdentifier);
            $contentObjectIdentifier = str_replace(' ', '', ucwords($contentObjectIdentifier));
        }

        if ($contentObjectIdentifier[0]) {
            $contentObjectIdentifier[0] = mb_strtoUpper($contentObjectIdentifier[0]);
        }

        return $contentObjectIdentifier;
    }

    /**
     * Gets a signature from an extension and content object identifier.
     *
     * @param string $extensionIdentifier The extension identifier
     * @param string $contentObjectIdentifier The content object identifier
     * @return string The content object signature
     */
    public static function signature(string $extensionIdentifier, string $contentObjectIdentifier): string
    {
        return mb_strtolower($extensionIdentifier . '_' . $contentObjectIdentifier);
    }
}
