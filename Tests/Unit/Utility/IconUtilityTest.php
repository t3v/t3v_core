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
   * Tests the icon identifier function.
   *
   * @test
   */
  public function iconIdentifier() {
    $this->assertEquals('spacer_content_element', IconUtility::iconIdentifier('Spacer Content Element'));
    $this->assertEquals('spacer_content_element', IconUtility::iconIdentifier('spacer content element'));
    $this->assertEquals('spacer_content_element', IconUtility::iconIdentifier('Spacer Content element'));
    $this->assertEquals('spacer-content-element', IconUtility::iconIdentifier('Spacer Content Element', '-'));
  }

  /**
   * Tests the icon signature function.
   *
   * @test
   */
  public function iconSignature() {
    $this->assertEquals(
      't3v_core-spacer_content_element',
      IconUtility::iconSignature('t3v_core', 'spacer_content_element')
    );

    $this->assertEquals(
      't3v_core_spacer_content_element',
      IconUtility::iconSignature('t3v_core', 'spacer_content_element', '_')
    );
  }
}