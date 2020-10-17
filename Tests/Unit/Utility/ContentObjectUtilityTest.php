<?php
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
     * Tests the identifier function.
     *
     * @test
     */
    public function identifier(): void
    {
        $this->assertEquals(
            'Button',
            ContentObjectUtility::identifier('Button')
        );
    }

    /**
     * Tests the signature function.
     *
     * @test
     */
    public function signature(): void
    {
        $this->assertEquals(
            't3vbase_button',
            ContentObjectUtility::signature('t3vbase', 'button')
        );
    }
}
