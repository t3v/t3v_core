<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use T3v\T3vCore\Utility\ContentObjectUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * The content object utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class ContentObjectUtilityTest extends UnitTestCase
{
    /**
     * Tests the `getSignature` function.
     *
     * @test
     */
    public function getSignature(): void
    {
        self::assertEquals(
            'ContentObject',
            ContentObjectUtility::getSignature('Content object')
        );

        self::assertEquals(
            'ContentObject',
            ContentObjectUtility::getSignature('Content Object')
        );

        self::assertEquals(
            'ContentObject',
            ContentObjectUtility::getSignature('content object')
        );

        self::assertEquals(
            'ContentObject',
            ContentObjectUtility::getSignature('content_object')
        );

        self::assertEquals(
            'ContentObject',
            ContentObjectUtility::getSignature('content-object')
        );

        self::assertEquals(
            'ContentObject',
            ContentObjectUtility::getSignature('ContentObject')
        );

        self::assertEquals(
            'ContentObject',
            ContentObjectUtility::getSignature('contentObject')
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
            't3vcore_contentobject',
            ContentObjectUtility::getIdentifier('t3vcore', 'contentobject')
        );

        self::assertEquals(
            't3vcore_contentobject',
            ContentObjectUtility::getIdentifier('T3v Core', 'Content Object')
        );
    }
}
