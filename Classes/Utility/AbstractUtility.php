<?php
namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * The abstract utility class.
 *
 * @package T3v\T3vCore\Utility
 */
abstract class AbstractUtility implements SingletonInterface {
  /**
   * The object manager.
   *
   * @var \TYPO3\CMS\Extbase\Object\ObjectManager
   */
  protected $objectManager;

  /**
   * Constructs a new abstract utility.
   */
  public function __construct() {
    $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
  }
}
