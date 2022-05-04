<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\Exception;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * The abstract utility class.
 *
 * @package T3v\T3vCore\Service
 */
abstract class AbstractUtility implements SingletonInterface
{
    /**
     * Gets the object manager.
     *
     * @return ObjectManager The object manager
     */
    protected static function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * Gets the configuration manager.
     *
     * @return ConfigurationManagerInterface The configuration manager
     * @throws Exception
     */
    protected static function getConfigurationManager(): ConfigurationManagerInterface
    {
        return self::getObjectManager()->get(ConfigurationManagerInterface::class);
    }

    /**
     * Gets the content object renderer.
     *
     * @return ContentObjectRenderer The content object renderer
     * @throws Exception
     */
    protected static function getContentObjectRenderer(): ContentObjectRenderer
    {
        return self::getObjectManager()->get(ContentObjectRenderer::class);
    }

    /**
     * Gets the content object.
     *
     * @return ContentObjectRenderer The content object, respectively renderer
     * @throws Exception
     * @deprecated Use `getContentObjectRenderer` function instead
     */
    protected static function getContentObject(): ContentObjectRenderer
    {
        return self::getContentObjectRenderer();
    }
}
