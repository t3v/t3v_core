<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use T3v\T3vCore\Utility\UrlUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * The URL utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class UrlUtilityTest extends UnitTestCase
{
    /**
     * Tests if the URL gets encoded.
     *
     * @test
     */
    public function urlGetsEncoded(): void
    {
        self::assertEquals('https%3A%2F%2Fwww.t3v.com', UrlUtility::encodeUrl('https://www.t3v.com'));
    }

    /**
     * Tests if the URL gets decoded.
     *
     * @test
     */
    public function urlGetsDecoded(): void
    {
        self::assertEquals('https://www.t3v.com', UrlUtility::decodeUrl('https%3A%2F%2Fwww.t3v.com'));
    }
}
