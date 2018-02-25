<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * The abstract service class.
 *
 * @package T3v\T3vCore\Service
 */
abstract class AbstractService implements SingletonInterface {
  /**
   * The object manager.
   *
   * @var \TYPO3\CMS\Extbase\Object\ObjectManager
   */
  protected $objectManager;

  /**
   * The constructor.
   */
  public function __construct() {
    $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
  }
}