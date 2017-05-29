<?php
namespace T3v\T3vCore\Utility;

use \TYPO3\CMS\Core\SingletonInterface;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Abstract Utility Class
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
   * The constructor function.
   *
   * @return void
   */
  public function __construct() {
    $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
  }
}