<?php
declare(strict_types=1);

namespace T3v\T3vCore\DataProcessing;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * The abstract processor class.
 *
 * @package T3v\T3vCore\DataProcessing
 */
abstract class AbstractProcessor implements DataProcessorInterface
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
}
