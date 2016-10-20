<?php
namespace T3v\T3vCore\ViewHelpers;

use \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Array View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class ArrayViewHelper extends AbstractViewHelper {
  /**
   * The View Helper render function.
   *
   * @param array $array The array
   * @param string $array The array
   * @return mixed The value
   */
  public function render($array, $key) {
    if (is_array($array)) {
      return $array[$key];
    }
  }
}