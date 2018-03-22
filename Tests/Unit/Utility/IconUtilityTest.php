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
   * Test the icon identifier function.
   *
   * @test
   */
  public function iconIdentifier() {
    $this->assertEquals(IconUtility::iconIdentifier('Spacer Content Element'),      'spacer_content_element');
    $this->assertEquals(IconUtility::iconIdentifier('spacer content element'),      'spacer_content_element');
    $this->assertEquals(IconUtility::iconIdentifier('Spacer Content element'),      'spacer_content_element');
    $this->assertEquals(IconUtility::iconIdentifier('Spacer Content Element', '-'), 'spacer-content-element');
  }

  /**
   * Test the icon signature function.
   *
   * @test
   */
  public function iconSignature() {
    $this->assertEquals(
      IconUtility::iconSignature('t3v_core', 'spacer_content_element'),
      't3v_core-spacer_content_element'
    );

    $this->assertEquals(
      IconUtility::iconSignature('t3v_core', 'spacer_content_element', '_'),
      't3v_core_spacer_content_element'
    );
  }
}