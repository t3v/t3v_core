<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use T3v\T3vCore\Utility\IconUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * The icon utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class IconUtilityTest extends UnitTestCase
{
    /**
     * Tests the `getSignature` function.
     *
     * @test
     */
    public function getSignature(): void
    {
        self::assertEquals(
            'spacer_content_element',
            IconUtility::getSignature('Spacer Content Element')
        );

        self::assertEquals(
            'spacer_content_element',
            IconUtility::getSignature('spacer content element')
        );

        self::assertEquals(
            'spacer_content_element',
            IconUtility::getSignature('Spacer Content element')
        );

        self::assertEquals(
            'spacer-content-element',
            IconUtility::getSignature('Spacer Content Element', '-')
        );

        // === Deprecated ===

        self::assertEquals(
            'spacer_content_element',
            IconUtility::signature('Spacer Content Element')
        );

        self::assertEquals(
            'spacer_content_element',
            IconUtility::iconSignature('Spacer Content Element')
        );
    }

    /**
     * Tests the `getIdentifier` function.
     *
     * @test
     */
    public function getIdentifier(): void
    {
        self::assertEquals(
            't3v_core-spacer_content_element',
            IconUtility::getIdentifier('t3v_core', 'spacer_content_element')
        );

        self::assertEquals(
            't3v_core_spacer_content_element',
            IconUtility::getIdentifier('t3v_core', 'spacer_content_element', '_')
        );

        // === Deprecated ===

        self::assertEquals(
            't3v_core-spacer_content_element',
            IconUtility::identifier('t3v_core', 'spacer_content_element')
        );

        self::assertEquals(
            't3v_core-spacer_content_element',
            IconUtility::iconIdentifier('t3v_core', 'spacer_content_element')
        );
    }
}
