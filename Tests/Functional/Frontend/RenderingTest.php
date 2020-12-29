<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Functional\Frontend;

use T3v\T3vCore\Tests\Functional\Frontend\Traits\FrontendTrait;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * The rendering test class.
 *
 * @package T3v\T3vCore\Tests\Functional\Frontend
 */
class RenderingTest extends FunctionalTestCase
{
    /**
     * Use the frontend trait.
     */
    use FrontendTrait;

    /**
     * The core extensions to load.
     *
     * @var array
     */
    protected $coreExtensionsToLoad = ['core', 'frontend'];

    /**
     * The test extensions to load.
     *
     * @var array
     */
    protected $testExtensionsToLoad = ['typo3conf/ext/t3v_core'];

    /**
     * The paths to link in the test instance.
     *
     * @var array
     */
    protected $pathsToLinkInTestInstance = [
    ];

    /**
     * Tests if the template is rendered.
     *
     * @test
     */
    public function templateIsRendered(): void
    {
        $response = $this->executeFrontendRequest(
            (new InternalRequest())->withQueryParameters(
                [
                    'id' => 1
                ]
            )
        );

        $content = (string)$response->getBody();

        var_dump($content);
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

        $fixturesPath = __DIR__ . '/../Fixtures';

        $this->importDataSet("{$fixturesPath}/Database/Pages.xml");
        $this->setUpFrontendRootPage(1, ["{$fixturesPath}/Frontend/Basic.typoscript"]);
        $this->setUpFrontend(1, 'T3v Core');
    }
}
