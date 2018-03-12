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
    $this->assertEquals(ExtensionUtility::extensionIdentifier('t3v_core'),      't3vcore');
    $this->assertEquals(ExtensionUtility::extensionIdentifier('t3v_dummy_ext'), 't3vdummyext');
    $this->assertEquals(ExtensionUtility::extensionIdentifier('T3vCore'),       't3vcore');
    $this->assertEquals(ExtensionUtility::extensionIdentifier('T3v Core'),      't3vcore');
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
   * Test the locallang function.
   *
   * @test
   */
  public function locallang() {
    $this->assertEquals(
      ExtensionUtility::locallang('t3v_core'),
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:'
    );

    $this->assertEquals(
      ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf'),
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:'
    );

    $this->assertEquals(
      ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'EXT:'),
      'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:'
    );

    $this->assertEquals(
      ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'EXT:', '|'),
      'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf|'
    );

    $this->assertEquals(
      ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'LLL:EXT:', null),
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf'
    );

    $this->assertEquals(
      ExtensionUtility::lll('t3v_core'),
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:'
    );

    $this->assertEquals(
      ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf'),
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:'
    );

    $this->assertEquals(
      ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'EXT:'),
      'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:'
    );

    $this->assertEquals(
      ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'EXT:', '|'),
      'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf|'
    );

    $this->assertEquals(
      ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'LLL:EXT:', null),
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf'
    );
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

  /**
   * Test the private folder function.
   *
   * @test
   */
  public function privateFolder() {
    $this->assertEquals(ExtensionUtility::privateFolder('t3v_core'),              'EXT:t3v_core/Resources/Private');
    $this->assertEquals(ExtensionUtility::privateFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Private');
  }

  /**
   * Test the language folder function.
   *
   * @test
   */
  public function languageFolder() {
    $this->assertEquals(ExtensionUtility::languageFolder('t3v_core'),              'EXT:t3v_core/Resources/Private/Language');
    $this->assertEquals(ExtensionUtility::languageFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Private/Language');
  }

  /**
   * Test the locallang folder function.
   *
   * @test
   */
  public function locallangFolder() {
    $this->assertEquals(ExtensionUtility::locallangFolder('t3v_core'),              'LLL:EXT:t3v_core/Resources/Private/Language');
    $this->assertEquals(ExtensionUtility::locallangFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Private/Language');

    $this->assertEquals(ExtensionUtility::lllFolder('t3v_core'),              'LLL:EXT:t3v_core/Resources/Private/Language');
    $this->assertEquals(ExtensionUtility::lllFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Private/Language');
  }

  /**
   * Test the public folder function.
   *
   * @test
   */
  public function publicFolder() {
    $this->assertEquals(ExtensionUtility::publicFolder('t3v_core'),              'EXT:t3v_core/Resources/Public');
    $this->assertEquals(ExtensionUtility::publicFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Public');
  }

  /**
   * Test the assets folder function.
   *
   * @test
   */
  public function assetsFolder() {
    $this->assertEquals(ExtensionUtility::assetsFolder('t3v_core'),              'EXT:t3v_core/Resources/Public/Assets');
    $this->assertEquals(ExtensionUtility::assetsFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Public/Assets');
  }

  /**
   * Test the icons folder function.
   *
   * @test
   */
  public function iconsFolder() {
    $this->assertEquals(ExtensionUtility::iconsFolder('t3v_core'),              'EXT:t3v_core/Resources/Public/Icons');
    $this->assertEquals(ExtensionUtility::iconsFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Public/Icons');
  }

  /**
   * Test the placeholders folder function.
   *
   * @test
   */
  public function placeholdersFolder() {
    $this->assertEquals(ExtensionUtility::placeholdersFolder('t3v_core'),              'EXT:t3v_core/Resources/Public/Placeholders');
    $this->assertEquals(ExtensionUtility::placeholdersFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Public/Placeholders');
  }

  /**
   * Test the samples folder function.
   *
   * @test
   */
  public function samplesFolder() {
    $this->assertEquals(ExtensionUtility::samplesFolder('t3v_core'),              'EXT:t3v_core/Resources/Public/Samples');
    $this->assertEquals(ExtensionUtility::samplesFolder('t3v_core', 'FILE:EXT:'), 'FILE:EXT:t3v_core/Resources/Public/Samples');
  }
}