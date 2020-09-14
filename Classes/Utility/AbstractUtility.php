<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
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
     */
    protected static function getConfigurationManager(): ConfigurationManagerInterface
    {
        return self::getObjectManager()->get(ConfigurationManagerInterface::class);
    }

    /**
     * Gets the content object renderer.
     *
     * @return ContentObjectRenderer The content object renderer
     */
    protected static function getContentObject(): ContentObjectRenderer
    {
        return self::getObjectManager()->get(ContentObjectRenderer::class);
    }
}
