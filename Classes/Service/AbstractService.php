<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;

/**
 * The abstract service class.
 *
 * @package T3v\T3vCore\Service
 */
abstract class AbstractService implements SingletonInterface {
  /**
   * The object manager.
   *
   * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
   */
  protected $objectManager;

  /**
   * Injects the object manager.
   *
   * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
   */
  public function injectObjectManager(ObjectManagerInterface $objectManager) {
    $this->objectManager = $objectManager;
  }
}
