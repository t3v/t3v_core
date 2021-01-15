<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Functional\Service;

use T3v\T3vCore\Service\SettingsService;
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
     * The paths to link in the test instance.
     *
     * @var array
     */
    protected $pathsToLinkInTestInstance = [
    ];

    /**
     * The subject.
     *
     * @var \T3v\T3vCore\Service\SettingsService
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected $subject;

    /**
     * Tests the `runningInStrictMode` function.
     *
     * @test
     */
    public function runningInStrictMode(): void
    {
        self::assertEquals(true, $this->subject->runningInStrictMode());
    }

    /**
     * Tests the `runningInFallbackMode` function.
     *
     * @test
     */
    public function runningInFallbackMode(): void
    {
        self::assertEquals(false, $this->subject->runningInFallbackMode());
    }

    /**
     * Setup before running tests.
     *
     * @throws \Doctrine\DBAL\DBALException
     * @throws \TYPO3\TestingFramework\Core\Exception
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new SettingsService;
    }
}
