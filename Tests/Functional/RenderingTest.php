<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Functional;

use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * The rendering test class.
 *
 * @package T3v\T3vCore\Tests\Functional
 */
class RenderingTest extends FunctionalTestCase
{
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
     * The paths to link in test instance.
     *
     * @var array
     */
    //protected $pathsToLinkInTestInstance = [
    //    'typo3/sysext/core/Tests/Functional/Fixtures/Frontend/AdditionalConfiguration.php' => 'typo3conf/AdditionalConfiguration.php'
    //];

    /**
     * Tests if the template is rendered.
     *
     * @test
     */
    public function templateIsRendered(): void
    {
        //$expectedDom = new \DomDocument();
        //$expectedDom->preserveWhiteSpace = false;
        //$expectedDom->loadHTML('<h1>T3v Core</h1>');
        //
        //$actualDom = new \DomDocument();
        //$actualDom->preserveWhiteSpace = false;
        //$actualDom->loadHTML($this->executeFrontendRequest(->body());
        //
        //self::assertXmlStringEqualsXmlString($expectedDom->saveHTML(), $actualDom->saveHTML());

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

        $fixturesPath = __DIR__ . '/Fixtures';

        $this->importDataSet("{$fixturesPath}/Database/Pages.xml");
        $this->setUpFrontendRootPage(1, ["{$fixturesPath}/Frontend/Basic.typoscript"]);
        $this->setUpFrontend(1, 'T3v Core');
    }

    /**
     * Setup the frontend for testing.
     *
     * @param int $rootPageId The optional root page ID, defaults to `1`
     * @param string $websiteTitle The optional website title, defaults to `TYPO3voilà`
     *
     */
    protected function setUpFrontend(int $rootPageId = 1, string $websiteTitle = 'TYPO3voilà'): void
    {
        $configuration = [
            'rootPageId' => $rootPageId,
            'base' => '/',
            'websiteTitle' => $websiteTitle,
            'languages' => [
                [
                    'title' => 'English',
                    'enabled' => true,
                    'languageId' => '0',
                    'base' => '/',
                    'typo3Language' => 'default',
                    'locale' => 'en_US.UTF-8',
                    'iso-639-1' => 'en',
                    'websiteTitle' => '',
                    'navigationTitle' => '',
                    'hreflang' => '',
                    'direction' => '',
                    'flag' => 'us'
                ]
            ],
            'errorHandling' => [],
            'routes' => []
        ];

        GeneralUtility::mkdir_deep($this->instancePath . '/config/sites/testing/');
        $yamlFileContents = Yaml::dump($configuration, 99, 2);
        $fileName = $this->instancePath . '/config/sites/testing/config.yaml';
        GeneralUtility::writeFile($fileName, $yamlFileContents);
    }
}
