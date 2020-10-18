<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;
use T3v\T3vCore\Utility\ContentObjectUtility;

/**
 * The content object utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class ContentObjectUtilityTest extends UnitTestCase
{
    /**
     * Tests the get identifier function.
     *
     * @test
     */
    public function getIdentifier(): void
    {
        self::assertEquals(
            'Button',
            ContentObjectUtility::getIdentifier('Button')
        );

        // === Deprecated ===

        self::assertEquals(
            'Button',
            ContentObjectUtility::identifier('Button')
        );

        self::assertEquals(
            'Button',
            ContentObjectUtility::contentObjectIdentifier('Button')
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
            't3vbase_button',
            ContentObjectUtility::getSignature('t3vbase', 'button')
        );

        // === Deprecated ===

        self::assertEquals(
            't3vbase_button',
            ContentObjectUtility::signature('t3vbase', 'button')
        );

        self::assertEquals(
            't3vbase_button',
            ContentObjectUtility::contentObjectSignature('t3vbase', 'button')
        );
    }
}
