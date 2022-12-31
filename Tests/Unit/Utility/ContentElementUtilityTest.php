<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use T3v\T3vCore\Utility\ContentElementUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * The content element utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class ContentElementUtilityTest extends UnitTestCase
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
            ContentElementUtility::getSignature('Content element')
        );

        self::assertEquals(
            'ContentElement',
            ContentElementUtility::getSignature('Content Element')
        );

        self::assertEquals(
            'ContentElement',
            ContentElementUtility::getSignature('content element')
        );

        self::assertEquals(
            'ContentElement',
            ContentElementUtility::getSignature('content_element')
        );

        self::assertEquals(
            'ContentElement',
            ContentElementUtility::getSignature('content-element')
        );

        self::assertEquals(
            'ContentElement',
            ContentElementUtility::getSignature('ContentElement')
        );

        self::assertEquals(
            'ContentElement',
            ContentElementUtility::getSignature('contentElement')
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
            't3vcore_contentelement',
            ContentElementUtility::getIdentifier('t3vcore', 'contentelement')
        );

        self::assertEquals(
            't3vcore_contentelement',
            ContentElementUtility::getIdentifier('T3v Core', 'Content Element')
        );
    }
}
