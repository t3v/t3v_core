<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Functional\Frontend\Traits;

use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The setup trait.
 *
 * @package T3v\T3vCore\Tests\Functional\Frontend\Traits
 */
trait SetupTrait
{
    /**
     * Setup the frontend for testing.
     *
     * @param int $rootPageId The optional root page ID, defaults to `1`
     * @param string $websiteTitle The optional website title, defaults to `Testing`
     *
     */
    protected function setUpFrontend(int $rootPageId = 1, string $websiteTitle = 'Testing'): void
    {
        $configuration = [
            'base' => '/',
            // 'errorHandling' => [
            //     'errorCode' => '404',
            //     'errorHandler' => 'Page',
            //     'errorContentSource' => 't3://page?uid=5'
            // ],
            'languages' => [
                [
                    'title' => 'Global: English',
                    'enabled' => true,
                    'base' => '/',
                    'typo3Language' => 'default',
                    'locale' => 'en_GB.utf8',
                    'iso-639-1' => 'en',
                    'navigationTitle' => 'Global',
                    'hreflang' => 'x-default',
                    'direction' => '',
                    'flag' => 'global',
                    'languageId' => '0'
                ],

                [
                    'title' => 'Germany: Deutsch',
                    'enabled' => true,
                    'base' => '/de/',
                    'typo3Language' => 'de',
                    'locale' => 'de_DE.utf8',
                    'iso-639-1' => 'de',
                    'navigationTitle' => 'DE',
                    'hreflang' => 'de-de',
                    'direction' => '',
                    'flag' => 'de',
                    'languageId' => '1'
                ]
            ],
            'rootPageId' => $rootPageId,
            'routes' => [],
            'websiteTitle' => $websiteTitle
        ];

        $instancePath = $this->instancePath;

        GeneralUtility::mkdir_deep("{$instancePath}/typo3conf/sites/testing/");
        $fileName = "{$instancePath}/typo3conf/sites/testing/config.yaml";
        $content = Yaml::dump($configuration, 99, 2);
        GeneralUtility::writeFile($fileName, $content);
    }
}
