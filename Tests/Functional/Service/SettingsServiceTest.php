<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Functional\Service;

use Nimut\TestingFramework\TestCase\FunctionalTestCase;
use T3v\T3vCore\Service\SettingsService;

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
    protected $coreExtensionsToLoad = ['fluid'];

    /**
     * The test extensions to load.
     *
     * @var array
     */
    protected $testExtensionsToLoad = ['typo3conf/ext/t3v_core'];

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
     * @throws \Nimut\TestingFramework\Exception\Exception
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->importDataSet(__DIR__ . '/../Fixtures/Database/Pages.xml');

        $this->setUpFrontendRootPage(1, ['EXT:t3v_core/Configuration/TypoScript/Base/setup.typoscript']);

        $this->subject = new SettingsService;
    }
}
