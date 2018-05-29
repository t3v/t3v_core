<?php
namespace T3v\T3vCore\ViewHelpers;

use T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * The array view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class ArrayViewHelper extends AbstractViewHelper {
  /**
   * The view helper render function.
   *
   * @param array $array The array
   * @param string $key The key
   * @return object|null The value for the key or null if the key does not exist
   */
  public function render(array $array, string $key) {
    $result = null;

    if (is_array($array) && $key) {
      if (array_key_exists($key, $array)) {
        $result = $array[$key];
      }
    }

    return $result;
  }
}