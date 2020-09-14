<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

use Cocur\Slugify\Slugify;

/**
 * The icon utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class IconUtility extends AbstractUtility
{
    /**
     * Gets a signature from an extension key and icon identifier.
     *
     * @param string $extensionKey The extension key
     * @param string $iconIdentifier The icon identifier
     * @param string $separator The optional separator, defaults to `-`
     * @return string The icon signature
     */
    public static function signature(string $extensionKey, string $iconIdentifier, string $separator = '-'): string
    {
        return mb_strtolower("${extensionKey}${separator}${iconIdentifier}");
    }

    /**
     * Gets a signature from an extension key and icon identifier.
     *
     * @param string $extensionKey The extension key
     * @param string $iconIdentifier The icon identifier
     * @param string $separator The optional separator, defaults to `-`
     * @return string The icon signature
     * @deprecated Use `signature` instead
     */
    public static function iconSignature(string $extensionKey, string $iconIdentifier, string $separator = '-'): string
    {
        return self::signature($extensionKey, $iconIdentifier, $separator);
    }

    /**
     * Gets an identifier from an icon key.
     *
     * @param string $iconKey The icon key
     * @param string $separator The optional separator, defaults to `_`
     * @return string The icon identifier
     */
    public static function identifier(string $iconKey, string $separator = '_'): string
    {
        $slugify = new Slugify(['separator' => $separator]);

        return $slugify->slugify($iconKey);
    }

    /**
     * Gets an identifier from an icon key.
     *
     * @param string $iconKey The icon key
     * @param string $separator The optional separator, defaults to `_`
     * @return string The icon identifier
     * @deprecated Use `identifier` instead
     */
    public static function iconIdentifier(string $iconKey, string $separator = '_'): string
    {
        return self::identifier($iconKey, $separator);
    }
}
