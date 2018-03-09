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
   * Test the extension identifier function.
   *
   * @test
   */
  public function extensionIdentifier() {
    $this->assertEquals(ExtensionUtility::extensionIdentifier('t3v_core'), 't3vcore');
    $this->assertEquals(ExtensionUtility::extensionIdentifier('t3v_dummy_ext'), 't3vdummyext');
  }

  /**
   * Test the extension signature function.
   *
   * @test
   */
  public function extensionSignature() {
    $this->assertEquals(ExtensionUtility::extensionSignature('t3v', 't3v_core'),      'T3v.T3vCore');
    $this->assertEquals(ExtensionUtility::extensionSignature('T3v', 't3v_core'),      'T3v.T3vCore');
    $this->assertEquals(ExtensionUtility::extensionSignature('T3v', 't3v_core', '_'), 'T3v_T3vCore');
  }

  /**
   * Test the configuration folder function.
   *
   * @test
   */
  public function configurationFolder() {
    $this->assertEquals(ExtensionUtility::configurationFolder('t3v_core'),         'FILE:EXT:t3v_core/Configuration');
    $this->assertEquals(ExtensionUtility::configurationFolder('t3v_core', 'EXT:'), 'EXT:t3v_core/Configuration');
  }

  /**
   * Test the FlexForms folder function.
   *
   * @test
   */
  public function flexFormsFolder() {
    $this->assertEquals(ExtensionUtility::flexFormsFolder('t3v_core'),         'FILE:EXT:t3v_core/Configuration/FlexForms');
    $this->assertEquals(ExtensionUtility::flexFormsFolder('t3v_core', 'EXT:'), 'EXT:t3v_core/Configuration/FlexForms');
  }

  /**
   * Test the resources folder function.
   *
   * @test
   */
  public function resourcesFolder() {
    $this->assertEquals(ExtensionUtility::resourcesFolder('t3v_core'),              'EXT:t3v_core/Resources');
    $this->assertEquals(ExtensionUtility::resourcesFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources');
  }
}