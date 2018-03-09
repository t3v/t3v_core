<?php
namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;

use T3v\T3vCore\Utility\ExtensionUtility;

/**
 * The extension utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class ExtensionUtilityTest extends UnitTestCase {
  /**
   * Test extension identifier function.
   *
   * @test
   */
  public function extensionIdentifier() {
    $this->assertEquals(ExtensionUtility::extensionIdentifier('t3v_core'), 't3vcore');
    $this->assertEquals(ExtensionUtility::extensionIdentifier('t3v_dummy_ext'), 't3vdummyext');
  }

  /**
   * Test extension signature function.
   *
   * @test
   */
  public function extensionSignature() {
    $this->assertEquals(ExtensionUtility::extensionSignature('t3v', 't3v_core'), 'T3v.t3vCore');
    $this->assertEquals(ExtensionUtility::extensionSignature('T3v', 't3v_core'), 'T3v.t3vCore');
  }
}