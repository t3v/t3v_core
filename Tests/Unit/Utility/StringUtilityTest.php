<?php
namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;

use T3v\T3vCore\Utility\StringUtility;

/**
 * The string utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class StringUtilityTest extends UnitTestCase {
  /**
   * Tests if the input gets asciified.
   *
   * @test
   */
  public function inputGetsAsciified() {
    $this->assertEquals('Foobar', StringUtility::asciify('Fòôbàř'));
    $this->assertEquals('FooBar', StringUtility::asciify('FööBär'));
    $this->assertEquals('FoeoeBaer', StringUtility::asciify('FööBär', 'de'));
  }

  /**
   * Tests if the input gets camelized.
   *
   * @test
   */
  public function inputGetsCamelized() {
    $this->assertEquals('foobar', StringUtility::camelize('foobar'));
    $this->assertEquals('fooBar', StringUtility::camelize('fooBar'));
    $this->assertEquals('foobar', StringUtility::camelize('FOOBAR'));
    $this->assertEquals('fooBar', StringUtility::camelize('foo bar'));
    $this->assertEquals('fooBar', StringUtility::camelize('foo Bar'));
    $this->assertEquals('fooBar', StringUtility::camelize('Foo Bar'));
    $this->assertEquals('fooBar', StringUtility::camelize('foo bar', ' '));
    $this->assertEquals('FooBar', StringUtility::camelize('foo bar', ' ', true));
    $this->assertEquals('fooBar', StringUtility::camelize('foo-bar', '-'));
    $this->assertEquals('FooBar', StringUtility::camelize('foo-bar', '-', true));
  }
}
