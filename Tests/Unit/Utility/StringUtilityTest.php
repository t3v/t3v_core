<?php
namespace T3v\T3vCore\Tests\Unit\Utility;

use \Nimut\TestingFramework\TestCase\UnitTestCase;

use \T3v\T3vCore\Utility\StringUtility;

/**
 * String Utility Test Class
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
    $this->assertEquals(StringUtility::camelize('foo_bar'),            'fooBar');
    $this->assertEquals(StringUtility::camelize('foo-bar', '-'),       'fooBar');
    $this->assertEquals(StringUtility::camelize('foo-bar', '-', true), 'FooBar');
  }
}