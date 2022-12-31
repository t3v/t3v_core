<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * The abstract service class.
 *
 * @package T3v\T3vCore\Service
 */
abstract class AbstractService implements SingletonInterface
{
    /**
     * Gets the object manager.
     *
     * @return ObjectManager The object manager
     * @deprecated `ObjectManager` is deprecated since TYPO3 10.4 and will be removed in version 12
     */
    protected static function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * Gets the configuration manager.
     *
     * @return ConfigurationManager The configuration manager
     */
    protected static function getConfigurationManager(): ConfigurationManager
    {
        return GeneralUtility::makeInstance(ConfigurationManager::class);
    }

    /**
     * Gets the content object renderer.
     *
     * @return ContentObjectRenderer The content object renderer
     */
    protected static function getContentObjectRenderer(): ContentObjectRenderer
    {
        return GeneralUtility::makeInstance(ContentObjectRenderer::class);
    }

    /**
     * Gets the content object.
     *
     * Alias for the `getContentObjectRenderer` function.
     *
     * @return ContentObjectRenderer The content object, respectively the renderer
     */
    protected static function getContentObject(): ContentObjectRenderer
    {
        return self::getContentObjectRenderer();
    }
}
