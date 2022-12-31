<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Functional\Service;

use Doctrine\DBAL\DBALException;
use T3v\T3vCore\Service\SettingsService;
use TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException;
use TYPO3\TestingFramework\Core\Exception;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * The settings service test class.
 *
 * @package T3v\T3vCore\Tests\Functional\Service
 */
class SettingsServiceTest extends FunctionalTestCase
{
    /**
     * The core extensions to load.
     *
     * @var array
     */
    protected $coreExtensionsToLoad = [
        'core'
    ];

    /**
     * The test extensions to load.
     *
     * @var array
     */
    protected $testExtensionsToLoad = [
        'typo3conf/ext/t3v_testing',
        'typo3conf/ext/t3v_core'
    ];

    /**
     * The subject.
     *
     * @var SettingsService
     */
    protected SettingsService $subject;

    /**
     * Tests the `runningInStrictMode` function.
     *
     * @test
     * @throws InvalidConfigurationTypeException
     */
    public function runningInStrictMode(): void
    {
        self::assertEquals(true, $this->subject->runningInStrictMode());
    }

    /**
     * Tests the `runningInFallbackMode` function.
     *
     * @test
     * @throws InvalidConfigurationTypeException
     */
    public function runningInFallbackMode(): void
    {
        self::assertEquals(false, $this->subject->runningInFallbackMode());
    }

    /**
     * Tests the `runningInFreeMode` function.
     *
     * @test
     * @throws InvalidConfigurationTypeException
     */
    public function runningInFreeMode(): void
    {
        self::assertEquals(false, $this->subject->runningInFreeMode());
    }

    /**
     * Setup before running tests.
     *
     * @throws DBALException
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->importDataSet('EXT:t3v_testing/Tests/Functional/Fixtures/Database/Pages.xml');

        $this->setUpFrontendRootPage(
            1,
            [
                'constants' => [
                    'EXT:t3v_core/Configuration/TypoScript/constants.typoscript'
                ],
                'setup' => [
                    'EXT:t3v_core/Configuration/TypoScript/setup.typoscript'
                ]
            ]
        );

        $this->subject = new SettingsService();
    }
}
