<?php
namespace T3v\T3vCore\Utility;

use \TYPO3\CMS\Core\SingletonInterface;

/**
 * Abstract Utility Class
 *
 * @package T3v\T3vCore\Utility
 */
abstract class AbstractUtility implements SingletonInterface {
  /**
   * The constructor function.
   */
  public function __construct() {
    // ...
  }
}