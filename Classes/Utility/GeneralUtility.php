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
     * Gets a signature from a name.
     *
     * @param string $name The name
     * @return string The signature
     */
    public static function getSignature(string $name): string
    {
        $signature = $name;

        if (strpos($signature, '_') || strpos($signature, '-') || strpos($signature, ' ')) {
            $signature = mb_strtolower($name);
            $signature = str_replace(['_', '-'], ' ', $signature);
            $signature = str_replace(' ', '', ucwords($signature));
        }

        if ($signature[0]) {
            $signature[0] = mb_strtoUpper($signature[0]);
        }

        return $signature;
    }

    /**
     * Gets an identifier from a name.
     *
     * @param string $name The name
     * @param string $separator The optional separator, defaults to `_`
     * @return string The identifier
     */
    public static function getIdentifier(string $name, string $separator = '_'): string
    {
        return (new Slugify(['separator' => $separator]))->slugify($name);
    }
}
