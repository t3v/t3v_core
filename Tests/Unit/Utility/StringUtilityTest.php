<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;
use T3v\T3vCore\Utility\StringUtility;

/**
 * The string utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class StringUtilityTest extends UnitTestCase
{
    /**
     * Tests if the input gets asciified.
     *
     * @test
     */
    public function inputGetsAsciified(): void
    {
        self::assertEquals('Foobar', StringUtility::asciify('Fòôbàř'));
        self::assertEquals('FooBar', StringUtility::asciify('FööBär'));
        self::assertEquals('FoeoeBaer', StringUtility::asciify('FööBär', 'de'));
    }

    /**
     * Tests if the input gets camelized.
     *
     * @test
     */
    public function inputGetsCamelized(): void
    {
        self::assertEquals('foobar', StringUtility::camelize('foobar'));
        self::assertEquals('fooBar', StringUtility::camelize('fooBar'));
        self::assertEquals('foobar', StringUtility::camelize('FOOBAR'));
        self::assertEquals('fooBar', StringUtility::camelize('foo bar'));
        self::assertEquals('fooBar', StringUtility::camelize('foo Bar'));
        self::assertEquals('fooBar', StringUtility::camelize('Foo Bar'));
        self::assertEquals('fooBar', StringUtility::camelize('foo bar', ' '));
        self::assertEquals('FooBar', StringUtility::camelize('foo bar', ' ', true));
        self::assertEquals('fooBar', StringUtility::camelize('foo-bar', '-'));
        self::assertEquals('FooBar', StringUtility::camelize('foo-bar', '-', true));
    }
}
