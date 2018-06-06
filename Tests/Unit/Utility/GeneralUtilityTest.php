<?php
namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;

use T3v\T3vCore\Utility\GeneralUtility;

/**
 * The general utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class GeneralUtilityTest extends UnitTestCase {
  /**
   * Tests the identifier function.
   *
   * @test
   */
  public function identifier() {
    $this->assertEquals('spacer_content_element', GeneralUtility::identifier('Spacer Content Element'));
    $this->assertEquals('spacer_content_element', GeneralUtility::identifier('spacer content element'));
    $this->assertEquals('spacer_content_element', GeneralUtility::identifier('Spacer Content element'));
    $this->assertEquals('spacer-content-element', GeneralUtility::identifier('Spacer Content Element', '-'));
  }
}