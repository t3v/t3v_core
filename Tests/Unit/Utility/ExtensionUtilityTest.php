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
   * Tests the extension identifier function.
   *
   * @test
   */
  public function extensionIdentifier() {
    $this->assertEquals('t3vcore',     ExtensionUtility::extensionIdentifier('t3v_core'));
    $this->assertEquals('t3vdummyext', ExtensionUtility::extensionIdentifier('t3v_dummy_ext'));
    $this->assertEquals('t3vcore',     ExtensionUtility::extensionIdentifier('T3vCore'));
    $this->assertEquals('t3vcore',     ExtensionUtility::extensionIdentifier('T3v Core'));
  }

  /**
   * Tests the extension signature function.
   *
   * @test
   */
  public function extensionSignature() {
    $this->assertEquals('T3v.T3vCore', ExtensionUtility::extensionSignature('t3v', 't3v_core'));
    $this->assertEquals('T3v.T3vCore', ExtensionUtility::extensionSignature('T3v', 't3v_core'));
    $this->assertEquals('T3v_T3vCore', ExtensionUtility::extensionSignature('T3v', 't3v_core', '_'));
  }

  /**
   * Tests the locallang function.
   *
   * @test
   */
  public function locallang() {
    $this->assertEquals(
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:',
      ExtensionUtility::locallang('t3v_core')
    );

    $this->assertEquals(
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
      ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf')
    );

    $this->assertEquals(
      'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
      ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'EXT:')
    );

    $this->assertEquals(
      'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf|',
      ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'EXT:', '|')
    );

    $this->assertEquals(
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf',
      ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'LLL:EXT:', '')
    );

    $this->assertEquals(
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:',
      ExtensionUtility::lll('t3v_core')
    );

    $this->assertEquals(
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
      ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf')
    );

    $this->assertEquals(
      'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
      ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'EXT:')
    );

    $this->assertEquals(
      'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf|',
      ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'EXT:', '|')
    );

    $this->assertEquals(
      'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf',
      ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'LLL:EXT:', '')
    );
  }

  /**
   * Tests the configuration folder function.
   *
   * @test
   */
  public function configurationFolder() {
    $this->assertEquals('FILE:EXT:t3v_core/Configuration', ExtensionUtility::configurationFolder('t3v_core'));
    $this->assertEquals('EXT:t3v_core/Configuration',      ExtensionUtility::configurationFolder('t3v_core', 'EXT:'));
  }

  /**
   * Tests the FlexForms folder function.
   *
   * @test
   */
  public function flexFormsFolder() {
    $this->assertEquals('FILE:EXT:t3v_core/Configuration/FlexForms', ExtensionUtility::flexFormsFolder('t3v_core'));
    $this->assertEquals('EXT:t3v_core/Configuration/FlexForms',      ExtensionUtility::flexFormsFolder('t3v_core', 'EXT:'));
  }

  /**
   * Tests the resources folder function.
   *
   * @test
   */
  public function resourcesFolder() {
    $this->assertEquals('EXT:t3v_core/Resources',      ExtensionUtility::resourcesFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources', ExtensionUtility::resourcesFolder('t3v_core', 'FILE:EXT:'));
  }

  /**
   * Tests the private folder function.
   *
   * @test
   */
  public function privateFolder() {
    $this->assertEquals('EXT:t3v_core/Resources/Private',      ExtensionUtility::privateFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Private', ExtensionUtility::privateFolder('t3v_core', 'FILE:EXT:'));
  }

  /**
   * Tests the language folder function.
   *
   * @test
   */
  public function languageFolder() {
    $this->assertEquals('EXT:t3v_core/Resources/Private/Language',      ExtensionUtility::languageFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Private/Language', ExtensionUtility::languageFolder('t3v_core', 'FILE:EXT:'));
  }

  /**
   * Tests the locallang folder function.
   *
   * @test
   */
  public function locallangFolder() {
    $this->assertEquals('LLL:EXT:t3v_core/Resources/Private/Language',  ExtensionUtility::locallangFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Private/Language', ExtensionUtility::locallangFolder('t3v_core', 'FILE:EXT:'));

    $this->assertEquals('LLL:EXT:t3v_core/Resources/Private/Language',  ExtensionUtility::lllFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Private/Language', ExtensionUtility::lllFolder('t3v_core', 'FILE:EXT:'));
  }

  /**
   * Tests the public folder function.
   *
   * @test
   */
  public function publicFolder() {
    $this->assertEquals('EXT:t3v_core/Resources/Public',      ExtensionUtility::publicFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Public', ExtensionUtility::publicFolder('t3v_core', 'FILE:EXT:'));
  }

  /**
   * Tests the assets folder function.
   *
   * @test
   */
  public function assetsFolder() {
    $this->assertEquals('EXT:t3v_core/Resources/Public/Assets',      ExtensionUtility::assetsFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Public/Assets', ExtensionUtility::assetsFolder('t3v_core', 'FILE:EXT:'));
  }

  /**
   * Tests the icons folder function.
   *
   * @test
   */
  public function iconsFolder() {
    $this->assertEquals('EXT:t3v_core/Resources/Public/Icons',      ExtensionUtility::iconsFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Public/Icons', ExtensionUtility::iconsFolder('t3v_core', 'FILE:EXT:'));
  }

  /**
   * Tests the placeholders folder function.
   *
   * @test
   */
  public function placeholdersFolder() {
    $this->assertEquals('EXT:t3v_core/Resources/Public/Placeholders',      ExtensionUtility::placeholdersFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Public/Placeholders', ExtensionUtility::placeholdersFolder('t3v_core', 'FILE:EXT:'));
  }

  /**
   * Tests the samples folder function.
   *
   * @test
   */
  public function samplesFolder() {
    $this->assertEquals('EXT:t3v_core/Resources/Public/Samples',      ExtensionUtility::samplesFolder('t3v_core'));
    $this->assertEquals('FILE:EXT:t3v_core/Resources/Public/Samples', ExtensionUtility::samplesFolder('t3v_core', 'FILE:EXT:'));
  }
}