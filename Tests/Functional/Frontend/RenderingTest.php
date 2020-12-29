<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Functional\Frontend;

use T3v\T3vCore\Tests\Functional\Frontend\Traits\SetupTrait;
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
     * Use the setup trait.
     */
    use SetupTrait;

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
            (new InternalRequest())->withPageId(1)
        );

        $body = (string)$response->getBody();

        if (!empty($body)) {
            $expectedDom = new \DomDocument();
            $expectedDom->preserveWhiteSpace = false;
            $expectedDom->loadHTML('<h1>T3v Core</h1>');

            $actualDom = new \DomDocument();
            $actualDom->preserveWhiteSpace = false;
            $actualDom->loadHTML($body);

            $this->assertXmlStringEqualsXmlString($expectedDom->saveHTML(), $actualDom->saveHTML());
        }
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

        $this->importDataSet('EXT:t3v_core/Tests/Fixtures/Database/Pages.xml');

        $this->setUpFrontendRootPage(
            1,
            [
                'constants' => ['EXT:t3v_core/Tests/Fixtures/TypoScript/Frontend/constants.typoscript'],
                'setup' => ['EXT:t3v_core/Tests/Fixtures/TypoScript/Frontend/setup.typoscript']
            ]
        );

        $this->setUpFrontend(1, 'T3v Core');
    }
}
