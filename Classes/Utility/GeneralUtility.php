<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

use Cocur\Slugify\Slugify;

/**
 * The general utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class GeneralUtility extends AbstractUtility
{
    /**
     * Gets an identifier from a name.
     *
     * @param string $name The name
     * @param string $separator The optional separator, defaults to `_`
     * @return string The identifier
     */
    public static function getIdentifier(string $name, string $separator = '_'): string
    {
        $slugify = new Slugify(['separator' => $separator]);

        return $slugify->slugify($name);
    }

    /**
     * Gets an identifier from a name.
     *
     * @param string $name The name
     * @param string $separator The optional separator, defaults to `_`
     * @return string The identifier
     * @deprecated Use the `getIdentifier` function instead
     */
    public static function identifier(string $name, string $separator = '_'): string
    {
        return self::getIdentifier($name, $separator);
    }
}
