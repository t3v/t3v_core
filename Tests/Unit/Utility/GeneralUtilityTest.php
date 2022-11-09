<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use T3v\T3vCore\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * The general utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class GeneralUtilityTest extends UnitTestCase
{
    /**
     * Tests the `getSignature` function.
     *
     * @test
     */
    public function getSignature(): void
    {
        self::assertEquals(
            'ContentElement',
            GeneralUtility::getSignature('Content element')
        );

        self::assertEquals(
            'ContentElement',
            GeneralUtility::getSignature('Content Element')
        );

        self::assertEquals(
            'ContentElement',
            GeneralUtility::getSignature('content element')
        );

        self::assertEquals(
            'ContentElement',
            GeneralUtility::getSignature('content_element')
        );

        self::assertEquals(
            'ContentElement',
            GeneralUtility::getSignature('content-element')
        );

        self::assertEquals(
            'ContentElement',
            GeneralUtility::getSignature('ContentElement')
        );

        self::assertEquals(
            'ContentElement',
            GeneralUtility::getSignature('contentElement')
        );

        // === Deprecated ===

        self::assertEquals(
            'ContentElement',
            GeneralUtility::signature('Content element')
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
            'content_element',
            GeneralUtility::getIdentifier('Content Element')
        );

        self::assertEquals(
            'content_element',
            GeneralUtility::getIdentifier('content element')
        );

        self::assertEquals(
            'content_element',
            GeneralUtility::getIdentifier('Content element')
        );

        self::assertEquals(
            'content-element',
            GeneralUtility::getIdentifier('Content Element', '-')
        );

        // === Deprecated ===

        self::assertEquals(
            'content_element',
            GeneralUtility::identifier('Content Element')
        );
    }
}
