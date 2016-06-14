<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\SingletonInterface;
use \TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Class AbstractService
 *
 * @package T3v\T3vCore\Service
 */
abstract class AbstractService implements SingletonInterface {
  /**
   * @var \TYPO3\CMS\Extbase\Object\ObjectManager
   * @inject
   */
  protected $objectManager;

  /**
   * The constructor function.
   */
  public function __construct() {
    // ...
  }
}