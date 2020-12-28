<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;
use T3v\T3vCore\Utility\GeneralUtility;

/**
 * The general utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class GeneralUtilityTest extends UnitTestCase
{
    /**
     * Tests the `getIdentifier` function.
     *
     * @test
     */
    public function getIdentifier(): void
    {
        self::assertEquals(
            'spacer_content_element',
            GeneralUtility::getIdentifier('Spacer Content Element')
        );

        self::assertEquals(
            'spacer_content_element',
            GeneralUtility::getIdentifier('spacer content element')
        );

        self::assertEquals(
            'spacer_content_element',
            GeneralUtility::getIdentifier('Spacer Content element')
        );

        self::assertEquals(
            'spacer-content-element',
            GeneralUtility::getIdentifier('Spacer Content Element', '-')
        );

        // === Deprecated ===

        self::assertEquals(
            'spacer_content_element',
            GeneralUtility::identifier('Spacer Content Element')
        );
    }
}
