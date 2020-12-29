<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use T3v\T3vCore\Utility\ExtensionUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * The extension utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class ExtensionUtilityTest extends UnitTestCase
{
    /**
     * Tests the `getIdentifier` function.
     *
     * @test
     */
    public function getIdentifier(): void
    {
        self::assertEquals(
            't3vcore',
            ExtensionUtility::getIdentifier('t3v_core')
        );

        self::assertEquals(
            't3vdummyext',
            ExtensionUtility::getIdentifier('t3v_dummy_ext')
        );

        self::assertEquals(
            't3vcore',
            ExtensionUtility::getIdentifier('T3vCore')
        );

        self::assertEquals(
            't3vcore',
            ExtensionUtility::getIdentifier('T3v Core')
        );

        // === Deprecated ===

        self::assertEquals(
            't3vcore',
            ExtensionUtility::identifier('t3v_core')
        );

        self::assertEquals(
            't3vcore',
            ExtensionUtility::extensionIdentifier('t3v_core')
        );
    }

    /**
     * Tests the `getSignature` function.
     *
     * @test
     */
    public function getSignature(): void
    {
        self::assertEquals(
            'T3v.T3vCore',
            ExtensionUtility::getSignature('t3v', 't3v_core')
        );

        self::assertEquals(
            'T3v.T3vCore',
            ExtensionUtility::getSignature('T3v', 't3v_core')
        );

        self::assertEquals(
            'T3v_T3vCore',
            ExtensionUtility::getSignature('T3v', 't3v_core', '_')
        );

        // === Deprecated ===

        self::assertEquals(
            'T3v.T3vCore',
            ExtensionUtility::signature('t3v', 't3v_core')
        );

        self::assertEquals(
            'T3v.T3vCore',
            ExtensionUtility::extensionSignature('t3v', 't3v_core')
        );
    }

    /**
     * Tests the `getLocallang` function.
     *
     * @test
     */
    public function getLocallang(): void
    {
        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:',
            ExtensionUtility::getLocallang('t3v_core')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
            ExtensionUtility::getLocallang('t3v_core', 'locallang_tca.xlf')
        );

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf:',
            ExtensionUtility::getLocallang('t3v_core', 'locallang_tca.xlf', 'EXT:')
        );

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf|',
            ExtensionUtility::getLocallang('t3v_core', 'locallang_tca.xlf', 'EXT:', '|')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang_tca.xlf',
            ExtensionUtility::getLocallang('t3v_core', 'locallang_tca.xlf', 'LLL:EXT:', '')
        );

        // === Deprecated ===

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:',
            ExtensionUtility::locallang('t3v_core')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language/locallang.xlf:',
            ExtensionUtility::lll('t3v_core')
        );
    }

    /**
     * Tests the `getConfigurationFolder` function.
     *
     * @test
     */
    public function getConfigurationFolder(): void
    {
        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration',
            ExtensionUtility::getConfigurationFolder('t3v_core')
        );

        self::assertEquals(
            'EXT:t3v_core/Configuration',
            ExtensionUtility::getConfigurationFolder('t3v_core', 'EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration',
            ExtensionUtility::configurationFolder('t3v_core')
        );
    }

    /**
     * Tests the `getFlexFormsFolder` function.
     *
     * @test
     */
    public function getFlexFormsFolder(): void
    {
        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/FlexForms',
            ExtensionUtility::getFlexFormsFolder('t3v_core')
        );

        self::assertEquals(
            'EXT:t3v_core/Configuration/FlexForms',
            ExtensionUtility::getFlexFormsFolder('t3v_core', 'EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/FlexForms',
            ExtensionUtility::flexFormsFolder('t3v_core')
        );
    }

    /**
     * Tests the `getTCAFolder` function.
     *
     * @test
     */
    public function getTCAFolder(): void
    {
        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/TCA',
            ExtensionUtility::getTCAFolder('t3v_core')
        );

        self::assertEquals(
            'EXT:t3v_core/Configuration/TCA',
            ExtensionUtility::getTCAFolder('t3v_core', 'EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/TCA',
            ExtensionUtility::tcaFolder('t3v_core')
        );
    }

    /**
     * Tests the `getTSConfigFolder` function.
     *
     * @test
     */
    public function getTSConfigFolder(): void
    {
        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/TSconfig',
            ExtensionUtility::getTSConfigFolder('t3v_core')
        );

        self::assertEquals(
            'EXT:t3v_core/Configuration/TSconfig',
            ExtensionUtility::getTSConfigFolder('t3v_core', 'EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/TSconfig',
            ExtensionUtility::tsConfigFolder('t3v_core')
        );
    }

    /**
     * Tests the `getTypoScriptFolder` function.
     *
     * @test
     */
    public function getTypoScriptFolder(): void
    {
        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/TypoScript',
            ExtensionUtility::getTypoScriptFolder('t3v_core')
        );

        self::assertEquals(
            'EXT:t3v_core/Configuration/TypoScript',
            ExtensionUtility::getTypoScriptFolder('t3v_core', 'EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'FILE:EXT:t3v_core/Configuration/TypoScript',
            ExtensionUtility::typoscriptFolder('t3v_core')
        );
    }

    /**
     * Tests the `getResourcesFolder` function.
     *
     * @test
     */
    public function getResourcesFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources',
            ExtensionUtility::getResourcesFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources',
            ExtensionUtility::getResourcesFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources',
            ExtensionUtility::resourcesFolder('t3v_core')
        );
    }

    /**
     * Tests the `getPrivateFolder` function.
     *
     * @test
     */
    public function getPrivateFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Private',
            ExtensionUtility::getPrivateFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private',
            ExtensionUtility::getPrivateFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Private',
            ExtensionUtility::privateFolder('t3v_core')
        );
    }

    /**
     * Tests the `getLanguageFolder` function.
     *
     * @test
     */
    public function getLanguageFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::getLanguageFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::getLanguageFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::languageFolder('t3v_core')
        );
    }

    /**
     * Tests the `getLocallangFolder` function.
     *
     * @test
     */
    public function getLocallangFolder(): void
    {
        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::getLocallangFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::getLocallangFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::locallangFolder('t3v_core')
        );

        self::assertEquals(
            'LLL:EXT:t3v_core/Resources/Private/Language',
            ExtensionUtility::lllFolder('t3v_core')
        );
    }

    /**
     * Tests the `getLayoutsFolder` function.
     *
     * @test
     */
    public function getLayoutsFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Layouts',
            ExtensionUtility::getLayoutsFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private/Layouts',
            ExtensionUtility::getLayoutsFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Layouts',
            ExtensionUtility::layoutsFolder('t3v_core')
        );
    }

    /**
     * Tests the `getPartialsFolder` function.
     *
     * @test
     */
    public function getPartialsFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Partials',
            ExtensionUtility::getPartialsFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private/Partials',
            ExtensionUtility::getPartialsFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Partials',
            ExtensionUtility::partialsFolder('t3v_core')
        );
    }

    /**
     * Tests the `getTemplatesFolder` function.
     *
     * @test
     */
    public function getTemplatesFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Templates',
            ExtensionUtility::getTemplatesFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Private/Templates',
            ExtensionUtility::getTemplatesFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Private/Templates',
            ExtensionUtility::templatesFolder('t3v_core')
        );
    }

    /**
     * Tests the `getPublicFolder` function.
     *
     * @test
     */
    public function getPublicFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public',
            ExtensionUtility::getPublicFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public',
            ExtensionUtility::getPublicFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Public',
            ExtensionUtility::publicFolder('t3v_core')
        );
    }

    /**
     * Tests the `getAssetsFolder` function.
     *
     * @test
     */
    public function getAssetsFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Assets',
            ExtensionUtility::getAssetsFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public/Assets',
            ExtensionUtility::getAssetsFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Assets',
            ExtensionUtility::assetsFolder('t3v_core')
        );
    }

    /**
     * Tests the `getIconsFolder` function.
     *
     * @test
     */
    public function getIconsFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Icons',
            ExtensionUtility::getIconsFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public/Icons',
            ExtensionUtility::getIconsFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Icons',
            ExtensionUtility::iconsFolder('t3v_core')
        );
    }

    /**
     * Tests the `getPlaceholdersFolder` function.
     *
     * @test
     */
    public function getPlaceholdersFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Placeholders',
            ExtensionUtility::getPlaceholdersFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public/Placeholders',
            ExtensionUtility::getPlaceholdersFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Placeholders',
            ExtensionUtility::placeholdersFolder('t3v_core')
        );
    }

    /**
     * Tests the `getSamplesFolder` function.
     *
     * @test
     */
    public function getSamplesFolder(): void
    {
        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Samples',
            ExtensionUtility::getSamplesFolder('t3v_core')
        );

        self::assertEquals(
            'FILE:EXT:t3v_core/Resources/Public/Samples',
            ExtensionUtility::getSamplesFolder('t3v_core', 'FILE:EXT:')
        );

        // === Deprecated ===

        self::assertEquals(
            'EXT:t3v_core/Resources/Public/Samples',
            ExtensionUtility::samplesFolder('t3v_core')
        );
    }
}
