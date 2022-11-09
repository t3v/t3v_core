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
     * Gets a signature from an icon name.
     *
     * @param string $iconName The icon name
     * @param string $separator The optional separator, defaults to `_`
     * @return string The icon signature
     */
    public static function getSignature(string $iconName, string $separator = '_'): string
    {
        return (new Slugify(['separator' => $separator]))->slugify($iconName);
    }

    /**
     * Gets an identifier from an extension key and icon signature.
     *
     * @param string $extensionKey The extension key
     * @param string $iconSignature The icon signature
     * @param string $separator The optional separator, defaults to `-`
     * @return string The icon identifier
     */
    public static function getIdentifier(string $extensionKey, string $iconSignature, string $separator = '-'): string
    {
        return mb_strtolower($extensionKey . $separator . $iconSignature);
    }
}
