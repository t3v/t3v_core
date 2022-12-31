<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Functional\Service;

use Doctrine\DBAL\DBALException;
use T3v\T3vCore\Service\SettingsService;
use TYPO3\CMS\Extbase\Object\Exception;
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
     * @throws Exception
     */
    public function runningInStrictMode(): void
    {
        self::assertEquals(true, $this->subject->runningInStrictMode());
    }

    /**
     * Tests the `runningInFallbackMode` function.
     *
     * @test
     * @throws Exception
     */
    public function runningInFallbackMode(): void
    {
        self::assertEquals(false, $this->subject->runningInFallbackMode());
    }

    /**
     * Setup before running tests.
     *
     * @throws DBALException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new SettingsService();
    }
}
