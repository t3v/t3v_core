<?php
namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;

use T3v\T3vCore\Utility\IconUtility;

/**
 * The icon utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class IconUtilityTest extends UnitTestCase {
  /**
   * Tests the identifier function.
   *
   * @test
   */
  public function identifier() {
    $this->assertEquals('spacer_content_element', IconUtility::identifier('Spacer Content Element'));
    $this->assertEquals('spacer_content_element', IconUtility::identifier('spacer content element'));
    $this->assertEquals('spacer_content_element', IconUtility::identifier('Spacer Content element'));
    $this->assertEquals('spacer-content-element', IconUtility::identifier('Spacer Content Element', '-'));
  }

  /**
   * Tests the signature function.
   *
   * @test
   */
  public function signature() {
    $this->assertEquals(
      't3v_core-spacer_content_element',
      IconUtility::signature('t3v_core', 'spacer_content_element')
    );

    $this->assertEquals(
      't3v_core_spacer_content_element',
      IconUtility::signature('t3v_core', 'spacer_content_element', '_')
    );
  }
}
