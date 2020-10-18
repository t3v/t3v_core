<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;
use T3v\T3vCore\Utility\ExtensionUtility;

/**
 * The extension utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class ExtensionUtilityTest extends UnitTestCase
{
    /**
     * Tests the get identifier function.
     *
     * @test
     */
    public function getIdentifier(): void
    {
        self::assertEquals('t3vcore', ExtensionUtility::identifier('t3v_core'));
        self::assertEquals('t3vdummyext', ExtensionUtility::identifier('t3v_dummy_ext'));
        self::assertEquals('t3vcore', ExtensionUtility::identifier('T3vCore'));
        self::assertEquals('t3vcore', ExtensionUtility::identifier('T3v Core'));
    }

    /**
     * Tests the get signature function.
     *
     * @test
     */
    public function getSignature(): void
    {
        self::assertEquals('T3v.T3vCore', ExtensionUtility::signature('t3v', 't3v_core'));
        self::assertEquals('T3v.T3vCore', ExtensionUtility::signature('T3v', 't3v_core'));
        self::assertEquals('T3v_T3vCore', ExtensionUtility::signature('T3v', 't3v_core', '_'));
    }

    /**
     * Tests the get locallang function.
     *
     * @test
     */
    public function getLocallang(): void
    {
        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:',
            ExtensionUtility::locallang('t3v_core')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
            ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf')
        );

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
            ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'EXT:')
        );

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf|',
            ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'EXT:', '|')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf',
            ExtensionUtility::locallang('t3v_core', 'locallang_tca.xlf', 'LLL:EXT:', '')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:',
            ExtensionUtility::lll('t3v_core')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
            ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf')
        );

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
            ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'EXT:')
        );

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf|',
            ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'EXT:', '|')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf',
            ExtensionUtility::lll('t3v_core', 'locallang_tca.xlf', 'LLL:EXT:', '')
        );
    }

    /**
     * Tests the get configuration folder function.
     *
     * @test
     */
    public function getConfigurationFolder(): void
    {
        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration',
            ExtensionUtility::configurationFolder('t3v_core')
        );

        self::assertEquals(
            'EXT:t3v_core/Configuration',
            ExtensionUtility::configurationFolder('t3v_core', 'EXT:')
        );
    }

    /**
     * Tests the get FlexForms folder function.
     *
     * @test
     */
    public function getFlexFormsFolder(): void
    {
        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/FlexForms',
            ExtensionUtility::flexFormsFolder('t3v_core')
        );

        self::assertEquals(
            'EXT:t3v_core/Configuration/FlexForms',
            ExtensionUtility::flexFormsFolder('t3v_core', 'EXT:')
        );
    }

    /**
     * Tests the get TSconfig folder function.
     *
     * @test
     */
    public function getTSConfigFolder(): void
    {
        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/TSconfig',
            ExtensionUtility::tsConfigFolder('t3v_core')
        );

        self::assertEquals(
            'EXT:t3v_core/Configuration/TSconfig',
            ExtensionUtility::tsConfigFolder('t3v_core', 'EXT:')
        );
    }

    /**
     * Tests the get resources folder function.
     *
     * @test
     */
    public function getResourcesFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources',
            ExtensionUtility::resourcesFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources',
            ExtensionUtility::resourcesFolder('t3v_core', 'FILE:EXT:')
        );
    }

    /**
     * Tests the get private folder function.
     *
     * @test
     */
    public function getPrivateFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Private',
            ExtensionUtility::privateFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private',
            ExtensionUtility::privateFolder('t3v_core', 'FILE:EXT:')
        );
    }

    /**
     * Tests the get language folder function.
     *
     * @test
     */
    public function getLanguageFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::languageFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::languageFolder('t3v_core', 'FILE:EXT:')
        );
    }

    /**
     * Tests the get locallang folder function.
     *
     * @test
     */
    public function getLocallangFolder(): void
    {
        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::locallangFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::locallangFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::lllFolder('t3v_core')
        );
    }

    /**
     * Tests the get public folder function.
     *
     * @test
     */
    public function getPublicFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public',
            ExtensionUtility::publicFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public',
            ExtensionUtility::publicFolder('t3v_core', 'FILE:EXT:')
        );
    }

    /**
     * Tests the get assets folder function.
     *
     * @test
     */
    public function getAssetsFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Assets',
            ExtensionUtility::assetsFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public/Assets',
            ExtensionUtility::assetsFolder('t3v_core', 'FILE:EXT:')
        );
    }

    /**
     * Tests the get icons folder function.
     *
     * @test
     */
    public function getIconsFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Icons',
            ExtensionUtility::iconsFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public/Icons',
            ExtensionUtility::iconsFolder('t3v_core', 'FILE:EXT:')
        );
    }

    /**
     * Tests the get placeholders folder function.
     *
     * @test
     */
    public function getPlaceholdersFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Placeholders',
            ExtensionUtility::placeholdersFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public/Placeholders',
            ExtensionUtility::placeholdersFolder('t3v_core', 'FILE:EXT:')
        );
    }

    /**
     * Tests the get samples folder function.
     *
     * @test
     */
    public function getSamplesFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Samples',
            ExtensionUtility::samplesFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public/Samples',
            ExtensionUtility::samplesFolder('t3v_core', 'FILE:EXT:')
        );
    }
}
