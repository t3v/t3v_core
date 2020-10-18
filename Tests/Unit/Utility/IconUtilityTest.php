<?php
namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;
use T3v\T3vCore\Utility\IconUtility;

/**
 * The icon utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class IconUtilityTest extends UnitTestCase
{
    /**
     * Tests the get identifier function.
     *
     * @test
     */
    public function getIdentifier(): void
    {
        self::assertEquals(
            'spacer_content_element',
            IconUtility::getIdentifier('Spacer Content Element')
        );

        self::assertEquals(
            'spacer_content_element',
            IconUtility::getIdentifier('spacer content element')
        );

        self::assertEquals(
            'spacer_content_element',
            IconUtility::getIdentifier('Spacer Content element')
        );

        self::assertEquals(
            'spacer-content-element',
            IconUtility::getIdentifier('Spacer Content Element', '-')
        );

        // === Deprecated ===

        self::assertEquals(
            'spacer_content_element',
            IconUtility::identifier('Spacer Content Element')
        );

        self::assertEquals(
            'spacer_content_element',
            IconUtility::iconIdentifier('Spacer Content Element')
        );
    }

    /**
     * Tests the get signature function.
     *
     * @test
     */
    public function getSignature(): void
    {
        self::assertEquals(
            't3v_core-spacer_content_element',
            IconUtility::getSignature('t3v_core', 'spacer_content_element')
        );

        self::assertEquals(
            't3v_core_spacer_content_element',
            IconUtility::getSignature('t3v_core', 'spacer_content_element', '_')
        );

        // === Deprecated ===

        self::assertEquals(
            't3v_core-spacer_content_element',
            IconUtility::signature('t3v_core', 'spacer_content_element')
        );

        self::assertEquals(
            't3v_core-spacer_content_element',
            IconUtility::iconSignature('t3v_core', 'spacer_content_element')
        );
    }
}
