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
   * Test the get identifier function.
   *
   * @test
   */
  public function getIdentifier() {
    $this->assertEquals('spacer_content_element', GeneralUtility::getIdentifier('Spacer Content Element'));
    $this->assertEquals('spacer_content_element', GeneralUtility::getIdentifier('spacer content element'));
    $this->assertEquals('spacer_content_element', GeneralUtility::getIdentifier('Spacer Content element'));
    $this->assertEquals('spacer-content-element', GeneralUtility::getIdentifier('Spacer Content Element', '-'));
  }
}