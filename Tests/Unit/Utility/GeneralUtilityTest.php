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
    $this->assertEquals(GeneralUtility::getIdentifier('Spacer Content Element'),      'spacer_content_element');
    $this->assertEquals(GeneralUtility::getIdentifier('Spacer Content element'),      'spacer_content_element');
    $this->assertEquals(GeneralUtility::getIdentifier('Spacer Content Element'),      'spacer_content_element');
    $this->assertEquals(GeneralUtility::getIdentifier('Spacer Content Element', '-'), 'spacer-content-element');
  }
}