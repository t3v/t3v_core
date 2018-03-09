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
   * Test if the input gets camelized.
   *
   * @test
   */
  public function inputGetsCamelized() {
    $this->assertEquals(StringUtility::camelize('foobar'),             'foobar');
    $this->assertEquals(StringUtility::camelize('fooBar'),             'fooBar');
    $this->assertEquals(StringUtility::camelize('foo bar'),            'fooBar');
    $this->assertEquals(StringUtility::camelize('foo Bar'),            'fooBar');
    $this->assertEquals(StringUtility::camelize('Foo Bar'),            'fooBar');
    $this->assertEquals(StringUtility::camelize('foo bar', ' '),       'fooBar');
    $this->assertEquals(StringUtility::camelize('foo bar', ' ', true), 'FooBar');
    $this->assertEquals(StringUtility::camelize('foo-bar', '-'),       'fooBar');
    $this->assertEquals(StringUtility::camelize('foo-bar', '-', true), 'FooBar');
  }
}