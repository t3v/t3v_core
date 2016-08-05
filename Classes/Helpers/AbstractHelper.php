<?php
namespace T3v\T3vCore\Helpers;

use \TYPO3\CMS\Core\SingletonInterface;

/**
 * Abstract Helper Class
 *
 * @package T3v\T3vCore\Helpers
 */
abstract class AbstractHelper implements SingletonInterface {
  /**
   * The constructor function.
   */
  public function __construct() {
    // ...
  }
}